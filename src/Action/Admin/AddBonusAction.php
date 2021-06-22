<?php

namespace App\Action\Admin;

use App\Domain\Deposits\Service\Deposits;
use App\Domain\Plans\Service\Plans;
use App\Domain\Referrals\Service\Referrals;
use App\Domain\Settings\Service\Settings;
use App\Domain\TrailLog\Service\TrailLog;
use App\Domain\User\Service\User;
use App\Helpers\SendMail;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class AddBonusAction
{

    private $mail;
    private $plans;
    private $user;
    private $deposits;
    private $traillog;
    private $referrals;
    private $location;
    private $btcURL = "https://blockchain.info/tobtc?currency=USD&value=%s";

    public function __construct(
        SendMail $mail,
        Plans $plans,
        User $user,
        Deposits $deposits,
        TrailLog $traillog,
        Referrals $referrals,
        Settings $settings
    ) {
        $this->mail = $mail;
        $this->plans = $plans;
        $this->user = $user;
        $this->deposits = $deposits;
        $this->traillog = $traillog;
        $this->referrals = $referrals;
        $this->settings = $settings;
        $location = dirname(__FILE__) . "/tmp/";
        if (!is_dir($location)) mkdir($location);
        $this->location = $location;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
    ): ResponseInterface {
        // Collect args
        $auth = $request->getAttribute("token")['data'];
        if ($auth->userType != "admin") {
            \http_response_code(403);
            return $response;
        }

        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            if (empty($args['confirmation_code'])) {
                \http_response_code(400);
                return $response;
            }

            if ($this->verifyTokenAndAddBonus($args['confirmation_code']))
                $response->getBody()->write(json_encode(['success' => true, 'message' => "Bonus added successfully"]));
        }

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $data = (array) $request->getParsedBody();
            if ($this->setTokenAndSendMail($data))
                $response->getBody()->write(json_encode(['success' => true, 'message' => "Token sent successfully"]));
        }

        return $response;
    }

    private function setTokenAndSendMail($data)
    {
        if (empty($data['ID']) || empty($data['fullName']) || empty($data['userName']) || empty($data['amount'])) {
            \http_response_code(400);
            return false;
        }

        $token = substr(strtoupper(sha1(uniqid())), 5, 10);

        file_put_contents("$this->location/$token.json", json_encode($data, JSON_PRETTY_PRINT));

        return $this->mail->sendBonusConfirmToken($token, $data['fullName'], $data['userName'], $data['amount']);
    }

    private function verifyTokenAndAddBonus($token)
    {
        $file = "$this->location/$token.json";

        if (!is_file($file) || !is_readable($file)) {
            \http_response_code(400);
            return false;
        }

        $d = json_decode(file_get_contents($file));

        // fetch user
        $user = (object) $this->user->readUser($d->ID);
        if (empty($user)) \http_response_code(400);

        // check if bonus is to go as deposit
        if ($d->bonusType == "deposit") {
            if (!empty($d->investBonusPlanID)) {
                // get investment details
                $plan = $this->plans->read(['ID' => $d->investBonusPlanID])['plans'][0];
                if ($plan) {
                    $cd = $this->deposits->createDeposit([
                        'userID' => $d->ID,
                        'userName' => $d->userName,
                        'planID' => $plan->ID,
                        'planTitle' => $plan->title,
                        'transactionID' => strtoupper(uniqid()),
                        'amount' => $d->amount,
                        'btcAmount' => file_get_contents(sprintf($this->btcURL, $d->amount)),
                        'depositStatus' => 'approved'
                    ]);
                }
            }
        } else {
            // add to interest wallet balance
            $cd = $this->user->updateUser($d->ID, [
                'interestWalletBalance' => $user->interestWalletBalance + $d->amount,
            ]);
        }
        if (empty($cd)) {
            \http_response_code(400);
            return false;
        }

        // traillog it
        $this->traillog->create(
            [
                'userID' => $d->ID,
                'userName' => $d->userName,
                'logType' => $d->bonusType,
                'transactionDetails' => "Bonus {$d->bonusType} added to {$d->userName}",
                'transactionAdminID' => '',
                'amount' => $d->amount
            ]
        );

        // check if you can send notification 
        if (!empty($d->sendEmailNotification)) {
            // check the notification type
            $this->mail->sendBonusAddedMail(
                $user->email,
                $user->fullName,
                $d->amount,
                $d->bonusType
            );
        }

        // always notify admin
        $this->mail->sendBonusAddedMailToAdmin(
            $user->userName,
            $user->fullName,
            $d->amount,
            $d->bonusType
        );

        // check if you can pay referral commission on it
        if (!empty($d->addReferralCommission) && $d->bonusType == "deposit") {

            if (!empty($this->settings->read('payReferral')['settings'][0]->value)) {

                // check for referral commission
                $ref = $this->referrals->read(['referredUserID' => $d->ID])['referrals'][0];

                if (!empty($ref)) {

                    //calculate
                    $referralPercentage = $this->settings->read('referralPercentage')['settings'][0]->value;

                    $referralBonus = round($referralPercentage / 100 * $d->amount, 2);

                    // update referral table
                    $rr = $this->referrals->update($ref->ID, [
                        'referralPaid' => 1,
                        'referralBonus' => $ref->referralBonus + $referralBonus
                    ]);

                    if ($rr) {
                        // get the referrer himself

                        $referrer = (object) $this->user->readUser($ref->referralUserID);

                        $this->mail->sendDirectReferralCommissionEmail(
                            $referrer->email,
                            $referrer->fullName,
                            $referralBonus,
                            $d->userName,
                            $referrer->userName
                        );

                        // add to interest wallet balance
                        $this->user->updateUser($user->ID, [
                            'interestWalletBalance' => $referrer->interestWalletBalance + $referralBonus,
                        ]);

                        // log
                        $logData = [
                            'userID' => $referrer->ID,
                            'userName' => $referrer->userName,
                            'logType' => 'referral',
                            'transactionDetails' => "Received Referral Commission of \${$referralBonus} - {$referralPercentage}%",
                            'transactionAdminID' => '',
                            'amount' => $referralBonus,
                        ];

                        $this->traillog->create($logData);
                    }
                }
            }
        }

        // then traillog
        $this->traillog->create(
            [
                'userID' => $d->ID,
                'userName' => $d->userName,
                'logType' => 'bonus',
                'transactionDetails' => "Bonus {$d->bonusType} added to {$d->userName}",
                'transactionAdminID' => '',
                'amount' => $d->amount
            ]
        );

        unlink($file);

        return true;
    }
}
