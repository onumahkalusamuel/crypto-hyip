<?php

namespace App\Action\Admin\Withdrawals;

use App\Domain\Withdrawals\Service\Withdrawals;
use App\Domain\User\Service\User;
use App\Helpers\SendMail;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Slim\Routing\RouteContext;

final class DeclineAction
{
    private $withdrawals;
    private $user;
    private $session;
    private $sendMail;

    public function __construct(
        Withdrawals $withdrawals,
        User $user,
        Session $session,
        SendMail $sendMail
    ) {
        $this->withdrawals = $withdrawals;
        $this->user = $user;
        $this->session = $session;
        $this->sendMail = $sendMail;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $message = false;

        // fettch withdrawal
        $withdrawal = $this->withdrawals->readSingle(['ID' => $args['id']]);

        if (empty($withdrawal->ID)) {
            $message = "Withdrawal not found.";
        }

        // check for status
        if (empty($message) && $withdrawal->withdrawalStatus !== "pending") {
            $message = "You can only decline a pending withdrawal";
        }

        // get user
        if (empty($message)) {
            $user = $this->user->readSingle(['ID' => $withdrawal->userID]);
            if (empty($user->ID)) $message = "User not found";
        }

        if (empty($message)) {
            $this->withdrawals->beginTransaction();

            try {
                // mark withdrawal as declined
                $this->withdrawals->update([
                    'ID' => $withdrawal->ID,
                    'data' => [
                        'withdrawalStatus' => 'declined'
                    ]
                ]);

                // notify user
                $this->sendMail->sendWithdrawalDeclinedEmail(
                    $user->email,
                    $user->fullName,
                    $user->userName,
                    $_GET['message']
                );

                $this->withdrawals->commit();
            } catch (\Exception $e) {
                $this->withdrawals->rollback();
                $message = "Unable to process request at the moment. Please try again later";
                $user->password = null;
                \file_put_contents(__DIR__ . '/error-' . $user->ID . $withdrawal->ID . ".json", json_encode([$user, $withdrawal, $e]));
            }
        }

        // Clear all flash messages
        $flash = $this->session->getFlashBag();
        $flash->clear();

        // Get RouteParser from request to generate the urls
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();

        $url = $routeParser->urlFor('admin-withdrawals');


        if (empty($message)) {
            $flash->set('success', "Withdrawal declined successfully");
        } else {
            $flash->set('error', $message);
        }

        return $response->withStatus(302)->withHeader('Location', $url);
    }
}
