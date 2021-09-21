<?php

namespace App\Action\Admin\Deposits;

use App\Domain\Deposits\Service\Deposits;
use App\Domain\User\Service\User;
use App\Domain\TrailLog\Service\TrailLog;
use App\Domain\Plans\Service\Plans;
use App\Domain\Referrals\Service\Referrals;
use App\Domain\Settings\Service\Settings;
use App\Helpers\SendMail;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Slim\Routing\RouteContext;

final class ApproveAction
{
    private $deposits;
    private $plans;
    private $user;
    private $settings;
    private $referrals;
    private $trailLog;
    private $session;
    private $mail;

    public function __construct(
        Deposits $deposits,
        Plans $plans,
        User $user,
        Settings $settings,
        Referrals $referrals,
        TrailLog $trailLog,
        Session $session,
        SendMail $sendMail
    ) {
        $this->deposits = $deposits;
        $this->plans = $plans;
        $this->user = $user;
        $this->settings = $settings;
        $this->referrals = $referrals;
        $this->trailLog = $trailLog;
        $this->session = $session;
        $this->mail = $sendMail;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $message = false;

        // fettch deposit
        $dep = $this->deposits->readSingle(['ID' => $args['id']]);

        if (empty($dep->ID)) {
            $message = "Deposit not found.";
        }

        $plan = $this->plans->readSingle(['ID' => $dep->planID]);
        if (empty($plan->ID)) {
            $message = "Corresponding plan not found.";
        }

        // check for status
        if (empty($message) && $dep->depositStatus !== "pending") {
            $message = "You can only approve a pending deposit";
        }

        // get user
        if (empty($message)) {
            $user = $this->user->readSingle(['ID' => $dep->userID]);
            if (empty($user->ID)) $message = "User not found";
        }

        if (empty($message)) {
            $this->deposits->beginTransaction();

            try {
                // mark deposit as approved
                $this->deposits->update([
                    'ID' => $dep->ID,
                    'data' => [
                        'depositStatus' => 'approved',
                        'depositApprovalDate' => date("Y-m-d H:i:s", time()),
                        'finalInterestDate' => date(
                            "Y-m-d H:i:s",
                            strtotime("+{$plan->duration} {$plan->durationType}s 1 hour")
                        ),
                    ]
                ]);

                // add record to traillog
                $this->trailLog->create([
                    'data' => [
                        'userID' => $dep->userID,
                        'userName' => $dep->userName,
                        'logType' => 'deposit',
                        'transactionDetails' => "Deposit for " . $dep->planTitle . " Approved",
                        'transactionID' => $dep->ID,
                        'amount' => $dep->amount,
                        'cryptoCurrency' => $dep->cryptoCurrency
                    ]
                ]);


                // verify if can pay referral commission

                if (!empty($this->settings->payReferral)) {
                    // check for referral commission
                    $ref = $this->referrals->find([
                        'params' => [
                            'referredUserID' => $dep->userID
                        ]
                    ]);

                    if (!empty($ref->ID)) {

                        //calculate
                        $referralPercentage = $plan->referralPercentage;

                        $referralBonus = round($referralPercentage / 100 * $dep->amount, 2);

                        // update referral table
                        $rr = $this->referrals->update([
                            'ID' => $ref->ID,
                            'data' => [
                                'referralPaid' => 1,
                                'referralBonus' => $ref->referralBonus + $referralBonus
                            ]
                        ]);

                        if ($rr) {
                            // get the referer
                            $referer = $this->user->readSingle(['ID' => $ref->referralUserID]);

                            if (!empty($referer->ID)) {
                                $this->mail->sendDirectReferralCommissionEmail(
                                    $referer->email,
                                    $referer->fullName,
                                    $referralBonus,
                                    $ref->referredUserName,
                                    $referer->userName,
                                    $dep->cryptoCurrency
                                );
                            }

                            // log
                            $logData = [
                                'userID' => $referer->ID,
                                'userName' => $referer->userName,
                                'logType' => 'referral',
                                'transactionDetails' => "Received Referral Commission of \${$referralBonus} - {$referralPercentage}%",
                                'transactionID' => $ref->ID,
                                'amount' => $referralBonus,
                                'cryptoCurrency' => $dep->cryptoCurrency
                            ];

                            $this->trailLog->create(['data' => $logData]);
                        }
                    }
                }

                $this->deposits->commit();
            } catch (\Exception $e) {
                $this->deposits->rollback();
                $message = "Unable to process request at the moment. Please try again later";
                $user->password = null;
                \file_put_contents(__DIR__ . '/error-' . $user->ID . $dep->ID . ".json", json_encode([$user, $dep, $e]));
            }
        }

        // Clear all flash messages
        $flash = $this->session->getFlashBag();
        $flash->clear();

        // Get RouteParser from request to generate the urls
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();

        $url = $routeParser->urlFor('admin-deposits');


        if (empty($message)) {
            $flash->set('success', "Deposit approved successfully");
        } else {
            $flash->set('error', $message);
        }

        return $response->withStatus(302)->withHeader('Location', $url);
    }
}
