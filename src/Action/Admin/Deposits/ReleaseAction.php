<?php

namespace App\Action\Admin\Deposits;

use App\Domain\Deposits\Service\Deposits;
use App\Domain\User\Service\User;
use App\Domain\TrailLog\Service\TrailLog;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Helpers\SendMail;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Routing\RouteContext;

final class ReleaseAction
{
    private $deposits;
    private $user;
    private $trailLog;
    private $session;
    private $mail;

    public function __construct(
        Deposits $deposits,
        User $user,
        TrailLog $trailLog,
        Session $session,
        SendMail $sendMail
    ) {
        $this->deposits = $deposits;
        $this->user = $user;
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

        // check for status
        if (empty($message) && $dep->depositStatus !== "approved") {
            $message = "You can only release an active deposit";
        }

        // get user
        if (empty($message)) {
            $user = $this->user->readSingle(['ID' => $dep->userID]);
            if (empty($user->ID)) $message = "User not found";
        }

        if (empty($message)) {
            $this->deposits->beginTransaction();

            try {
                // mark deposit as released
                $this->deposits->update(['ID' => $dep->ID, 'data' => ['depositStatus' => 'released']]);

                // add released deposit to user wallet
                $wallet = $dep->cryptoCurrency . 'Balance';
                
                $this->user->update([
                    'ID' => $dep->userID,
                    'data' => [
                        $wallet => $user->$wallet + $dep->amount
                    ]
                ]);

                // add record to traillog
                $this->trailLog->create([
                    'data' => [
                        'userID' => $dep->userID,
                        'userName' => $dep->userName,
                        'logType' => 'deposit-release',
                        'transactionDetails' => "Deposit amount \${$dep->amount} released",
                        'transactionID' => $dep->ID,
                        'amount' => "-" . $dep->amount,
                        'cryptoCurrency' => $dep->cryptoCurrency
                    ]
                ]);
                // send mail
                
                $this->mail->sendDepositReleaseEmail(
                    $user->email,
                    $user->fullName,
                    $user->userName,
                    $dep->amount
                );

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
            $flash->set('success', "Deposit released successfully");
        } else {
            $flash->set('error', $message);
        }

        return $response->withStatus(302)->withHeader('Location', $url);
    }
}
