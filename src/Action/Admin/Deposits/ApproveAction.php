<?php

namespace App\Action\Deposits;

use App\Domain\Deposits\Service\Deposits;
use App\Helpers\ApiRequest;
use App\Helpers\SendMail;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

final class ApproveAction
{
    private $deposits;

    public function __construct(Deposits $deposits)
    {
        $this->deposits = $deposits;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $args)
    {

        $data = [
            "depositStatus" => "approved",
            "interestPaid" => "0",
        ];

        $auth = $request->getAttribute('token')['data'];

        if ($auth->userType != "admin") {
            return $response;
        }

        $apiRequest = new ApiRequest('internalOverride');

        if (!empty($args['id'])) {

            $dep = $this->deposits->readDeposit(['ID' => $args['id']])['deposits'][0];

            if ($dep->depositStatus != "pending") {
                return $response;
            }

            if ($this->deposits->updateDeposit($args['id'], $data)) {
                // get user
                $user = $apiRequest->get('users/' . $dep->userID);

                // add to deposit wallet balance
                $apiRequest->put('users/' . $dep->userID, [
                    'depositWalletBalance' => $user->depositWalletBalance + $dep->amount
                ]);

                // then log it
                $apiRequest->post('traillog/', [
                    'userID' => $dep->userID,
                    'userName' => $dep->userName,
                    'logType' => 'deposit',
                    'transactionDetails' => "Deposit for " . $dep->planTitle . " Approved",
                    'transactionAdminID' => $request->getAttribute('token')['data']->ID,
                    'amount' => $dep->amount,
                ]);

                // verify if can pay referral commission
                $sett = $apiRequest->get('/settings');

                if (!empty($sett->payReferral)) {
                    // check for referral commission
                    $ref = $apiRequest->get('referrals?referredUserID=' . $dep->userID)->referrals;

                    if (!empty($ref)) {

                        //calculate
                        $referralPercentage = $sett->referralPercentage;

                        $referralBonus = round($referralPercentage / 100 * $dep->amount, 2);

                        // update referral table
                        $rr = $apiRequest->put('/referrals/' . $ref[0]->ID, [
                            'referralPaid' => 1,
                            'referralBonus' => $ref[0]->referralBonus + $referralBonus
                        ]);

                        if ($rr) {
                            // get user 
                            $user = $apiRequest->get('/users/' . $ref[0]->referralUserID);

                            if (!empty($user)) {
                                $mail = new SendMail();
                                $m = $mail->sendDirectReferralCommissionEmail(
                                    $user->email,
                                    $user->fullName,
                                    $referralBonus,
                                    $ref[0]->referredUserName,
                                    $user->userName
                                );
                            }

                            // add to interest wallet balance
                            $apiRequest->put('/users/' . $user->ID, [
                                'interestWalletBalance' => $user->interestWalletBalance + $referralBonus,
                            ]);

                            // log
                            $logData = [
                                'userID' => $user->ID,
                                'userName' => $user->userName,
                                'logType' => 'referral',
                                'transactionDetails' => "Received Referral Commission of \${$referralBonus} - {$referralPercentage}%",
                                'transactionAdminID' => $request->getAttribute('token')['data']->ID,
                                'amount' => $referralBonus,
                            ];

                            $apiRequest->post('traillog/', $logData);
                        }
                    }
                }

                $response->getBody()->write(json_encode(['message' => 'Deposit approved successfully.']));
            } else {
                \http_response_code(404);
            }
            return $response;
        }

        \http_response_code(400);
        return $response;
    }
}
