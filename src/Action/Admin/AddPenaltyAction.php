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

final class AddPenaltyAction
{

    private $mail;
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
    	$currencies = explode(',', $this->settings->activeCurrencies);

	$this->view->assign('user', $user);
        $this->view->assign('currencies',$currencies);
        $this->view->display('admin/add-penalty.tpl');

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
            
            $penaltyUrl = $routeParser->fullUrlFor($request->getUri(), 'admin-add-penalty-confirm', ['confirmation_code' => $token]);
    
            $sendMail = $this->mail->sendPenaltyConfirmToken($penaltyUrl, $data['fullName'], $data['userName'], $data['amount'], $data['cryptoCurrency']);
            
            if(empty($sendMail)) {
                $message = "An error occured. Please try again later.";
            }
        }
        

        $url = $routeParser->urlFor('admin-add-penalty-view', ['user_id' => $data['ID']]);


        if (empty($message)) {
            $flash->set('success', "Penalty confirmation link sent to admin email. Click on the link to confirm action. Link will expire in 10 minutes.");
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
        
        // subtract from balance
        $wallet = $d->cryptoCurrency . "Balance";
        $cd = $this->user->update(['ID'=>$d->ID, 'data'=> [
            $wallet => $user->$wallet - $d->amount,
        ]]);
       
        if (empty($cd)) {
            $response->getBody()->write("Unable to process request at the moment.");
            return $response;
        }

        // traillog it
        $this->traillog->create(['data' =>
            [
                'userID' => $d->ID,
                'userName' => $d->userName,
                'logType' => 'penalty',
                'transactionDetails' => "Penalty of $ $d->amount ({$d->cryptoCurrency}) subtracted from {$d->userName}",
                'transactionID' => $d->ID,
                'amount' => $d->amount,
                'cryptoCurrency' => $d->cryptoCurrency
            ]
            ]
        );

        // check if you can send notification 
        if (!empty($d->notifyUserByEmail)) {
            // check the notification type
            $this->mail->sendPenaltySubtractedMail(
                $user->email,
                $user->fullName,
                $d->amount,
                $d->cryptoCurrency,
                $d->reason
            );
        }

        // always notify admin
        $this->mail->sendPenaltySubtractedMailToAdmin(
            $user->userName,
            $user->fullName,
            $d->amount,
            $d->cryptoCurrency,
            $d->reason
        );

        $response->getBody()->write("Penalty processed successfully.");
        return $response;

    }
}
