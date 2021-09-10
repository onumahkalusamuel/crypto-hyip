<?php

namespace App\Action\Admin;

use App\Domain\Deposits\Service\Deposits;
use App\Domain\Plans\Service\Plans;
use App\Domain\Referrals\Service\Referrals;
use App\Domain\Settings\Service\Settings;
use App\Domain\TrailLog\Service\TrailLog;
use App\Domain\User\Service\User;
use App\Helpers\SendMail;
use App\Helpers\CryptoHelper;
use Slim\Routing\RouteContext;
use Symfony\Component\HttpFoundation\Session\Session;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Smarty as View;

final class AddBonusAction
{

    private $mail;
    private $plans;
    private $user;
    private $deposits;
    private $traillog;
    private $referrals;
    private $cryptoHelper;
    private $session;
    private $view;
    private $location;

    public function __construct(
        SendMail $mail,
        Plans $plans,
        User $user,
        Deposits $deposits,
        TrailLog $traillog,
        Referrals $referrals,
        CryptoHelper $cryptoHelper,
        Session $session,
        View $view,
        Settings $settings
    ) {
        $this->mail = $mail;
        $this->plans = $plans;
        $this->user = $user;
        $this->deposits = $deposits;
        $this->traillog = $traillog;
        $this->referrals = $referrals;
        $this->cryptoHelper = $cryptoHelper;
        $this->session = $session;
        $this->view = $view;
        $this->settings = $settings;
        $location = dirname(__FILE__) . "/tmp/";
        if (!is_dir($location)) mkdir($location);
        $this->location = $location;
    }

    public function viewPage(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
    ): ResponseInterface {
    	$ID = $args['user_id'];
    	$user = $this->user->readSingle(['ID' => $ID]);
    	$plans = $this->plans->readAll([]);
    	$currencies = explode(',', $this->settings->activeCurrencies);

	$this->view->assign('user', $user);
	$this->view->assign('plans', $plans);
	$this->view->assign('currencies',$currencies);
	$this->view->display('admin/add-bonus.tpl');

    	return $response;

    }

    public function initTransaction(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {

    	$flash = $this->session->getFlashBag();
        $flash->clear();

        // Get RouteParser from request to generate the urls
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();

    	$data = (array) $request->getParsedBody();
    	$message = "";

        if (empty($data['ID']) || empty($data['fullName']) || empty($data['userName']) || empty($data['amount'])) {
            $message = "Please provide all required data.";
        }

        if(empty($message)) {

            $token = substr(strtoupper(sha1(uniqid())), 5, 10);

            file_put_contents("$this->location/$token.json", json_encode($data, JSON_PRETTY_PRINT));

            $bonusUrl = $routeParser->fullUrlFor($request->getUri(), 'admin-add-bonus-confirm', ['confirmation_code' => $token]);

            $sendMail = $this->mail->sendBonusConfirmToken($bonusUrl, $data['fullName'], $data['userName'], $data['amount'], $data['cryptoCurrency']);

            if(empty($sendMail)) {
                $message = "An error occured. Please try again later.";
            }
        }


        $url = $routeParser->urlFor('admin-add-bonus-view', ['user_id' => $data['ID']]);


        if (empty($message)) {
            $flash->set('success', "Bonus confirmation link sent to admin email. Click on the link to confirm action. Link will expire in 10 minutes.");
        } else {
            $flash->set('error', $message);
        }

        return $response->withStatus(302)->withHeader('Location', $url);

    }

    public function confirmTransaction(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
    ): ResponseInterface {

    	$token = $args['confirmation_code'];

        $file = "$this->location/$token.json";

        if (!is_file($file) || !is_readable($file)) {
            $response->getBody()->write("Invalid link clicked. Generate a fresh one.");
            return $response;
        }
        
        if (time() > filemtime($file) + 36000) {
            unlink($file);
            $response->getBody()->write("Token expired.");
            return $response;
        }

        $d = json_decode(file_get_contents($file));

        // discard file
        unlink($file);

        // fetch user
        $user = (object) $this->user->readSingle(['ID'=>$d->ID]);
        
        // get plan
        if(!empty($d->planID)) $plan = $this->plans->readSingle(['ID' => $d->planID]);

        // check if bonus is to go as deposit
        if ($d->bonusUsage == "toDeposit") {
            if (!empty($d->planID)) {
                
                $addr = $d->cryptoCurrency . "DepositAddress";
                $depositAddress = $this->settings->$addr;
                
                if ($plan->ID && !empty($depositAddress)) {
                    $cd = $this->deposits->create(['data'=> [
                        'userID' => $d->ID,
                        'userName' => $d->userName,
                        'planID' => $plan->ID,
                        'planTitle' => $plan->title,
                        'transactionID' => strtoupper(uniqid()),
                        'amount' => $d->amount,
                        'cryptoCurrency' => $d->cryptoCurrency,
                        'cryptoAmount' => $this->cryptoHelper->usdToCrypto($d->amount, $d->cryptoCurrency),
                        'percentage' => $plan->percentage,
                        'profitFrequency' => $plan->profitFrequency,
                        'depositApprovalDate' => date("Y-m-d H:i:s", time()),
                        'finalInterestDate' => date(
                            "Y-m-d H:i:s",
                            strtotime("+{$plan->duration} {$plan->durationType}s 1 hour")
                        ),
                        'depositAddress' => $depositAddress,
                        'depositStatus' => 'approved'
                    ]]);
                }
            }
        } else {
            // add to balance
            $wallet = $d->cryptoCurrency . "Balance";
            $cd = $this->user->update(['ID'=>$d->ID, 'data'=> [
                $wallet => $user->$wallet + $d->amount,
            ]]);
        }
        if (empty($cd)) {
            $response->getBody()->write("Unable to process request at the moment.");
            return $response;
        }

        // traillog it
        $this->traillog->create(['data' =>
            [
                'userID' => $d->ID,
                'userName' => $d->userName,
                'logType' => 'bonus',
                'transactionDetails' => "Bonus of $ $d->amount ({$d->cryptoCurrency}) added to {$d->userName} - {$d->bonusUsage}",
                'transactionID' => $d->ID,
                'amount' => $d->amount,
                'cryptoCurrency' => $d->cryptoCurrency
            ]
            ]
        );

        // check if you can send notification 
        if (!empty($d->notifyUserByEmail)) {
            // check the notification type
            $this->mail->sendBonusAddedMail(
                $user->email,
                $user->fullName,
                $d->amount,
                $d->cryptoCurrency
            );
        }

        // always notify admin
        $this->mail->sendBonusAddedMailToAdmin(
            $user->userName,
            $user->fullName,
            $d->amount,
            $d->cryptoCurrency
        );

        // check if you can pay referral commission on it
        if (!empty($d->payReferralCommission) && $d->bonusUsage == "toDeposit") {

            if (!empty($this->settings->payReferral)) {

                // check for referral commission
                $ref = $this->referrals->find(['referredUserID' => $d->ID]);

                if (!empty($ref->ID)) {

                    //calculate
                    $referralPercentage = $plan->referralPercentage;

                    $referralBonus = round($referralPercentage / 100 * $d->amount, 2);

                    // update referral table
                    $rr = $this->referrals->update(['ID'=> $ref->ID, 'data' => [
                        'referralPaid' => 1,
                        'referralBonus' => $ref->referralBonus + $referralBonus
                    ]]);

                    if ($rr) {
                        // get the referrer himself

                        $referrer = (object) $this->user->readSingle(['ID' => $ref->referralUserID]);

                        $this->mail->sendDirectReferralCommissionEmail(
                            $referrer->email,
                            $referrer->fullName,
                            $referralBonus,
                            $d->userName,
                            $referrer->userName,
                            $d->cryptoCurrency
                        );

                        // add to interest wallet balance
                        $wallet = $d->cryptoCurrency . "Balance";
                        $this->user->update(['ID'=>$referrer->ID, 'data' => [
                            $wallet => $referrer->$wallet + $referralBonus,
                        ]]);

                        // log
                        $logData = [
                            'userID' => $referrer->ID,
                            'userName' => $referrer->userName,
                            'logType' => 'referral',
                            'transactionDetails' => "Received Referral Commission of \${$referralBonus} ($d->cryptoCurrency) - {$referralPercentage}%",
                            'transactionID' => $d->ID,
                            'amount' => $referralBonus,
                            'cryptoCurrency' => $d->cryptoCurrency
                        ];

                        $this->traillog->create(['data'=>$logData]);
                    }
                }
            }
        }

        $response->getBody()->write("Bonus processed successfully.");
        return $response;

    }
}
