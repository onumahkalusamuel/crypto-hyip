<?php

namespace App\Action\User;

use App\Domain\Withdrawals\Service\Withdrawals;
use App\Domain\User\Service\User;
use App\Domain\Settings\Service\Settings;
use App\Helpers\SendMail;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;
use Symfony\Component\HttpFoundation\Session\Session;

final class WithdrawalsAction
{
    private $withdrawals;
    private $user;
    private $settings;
    private $session;
    private $sendMail;

    public function __construct(
        Withdrawals $withdrawals,
        User $user,
        Settings $settings,
        Session $session,
        SendMail $sendMail
    ) {
        $this->withdrawals = $withdrawals;
        $this->user = $user;
        $this->settings = $settings;
        $this->session = $session;
        $this->sendMail = $sendMail;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {

        // used to track progress
        $message = false;

        // Collect input from the HTTP request
        $data = (array) $request->getParsedBody();

        $ID = $this->session->get('ID');
        $data['userID'] = $ID;
        $data['userName'] = $this->session->get('userName');
        $data['transactionID'] = strtoupper(uniqid());
        $data['amount'] = (float) $data['amount'];

        if (empty($message) && empty($data['amount'])) {
            $message = "Withdrawal amount is needed.";
        }

        // check if amount is lower than minimum
        if (empty($message) && $data['amount'] < $this->settings->minWithdrawal) {
            $message = "Withdrawal amount of $".$data['amount']." is lower than minimum deposit of $" . $this->settings->minWithdrawal;
        }

        // fetch user
        if (empty($message)) {
            $user = $this->user->readSingle(['ID' => $ID]);

            if (empty($user->ID)) $message = "User not found";

            // interestWalletBalance needs to be smaller than amount
            $balance = $data['cryptoCurrency'] . 'Balance';
            if (empty($message) && $user->$balance < $data['amount']) {
                $message = "Insufficient funds. Wallet Balance: \$" . number_format($user->$balance, 2);
            }
        }

        if (empty($message)) {
            $data['userID'] = $user->ID;
            $data['userName'] = $user->userName;
            $address = $data['cryptoCurrency'] . 'Address';
            $data['withdrawalAddress'] = $user->$address;

            // Invoke the Domain with inputs and retain the result
            $withdrawalId = $this->withdrawals->create(['data' => $data]);
        }

        // responses
        if (empty($message) && !empty($withdrawalId)) {

            // send mail
            $this->sendMail->sendWithdrawalRequestEmail($user->email, $data['cryptoCurrency'], $data['amount'], $user->fullName, $user->userName);

            // Clear all flash messages
            $flash = $this->session->getFlashBag();
            $flash->clear();

            $flash->set('success', "The withdrawal has been saved. It will become approved when the administrator checks statistics");

            // Get RouteParser from request to generate the urls
            $routeParser = RouteContext::fromRequest($request)->getRouteParser();

            $url = $routeParser->urlFor("user-view-withdrawal", ['id' => $withdrawalId]);

            $response->getBody()->write(json_encode([
                'success' => true,
                'message' => "Successful",
                'redirect' => $url
            ]));

            // Redirect to protected page
            return $response;
        }

        $message = $message ?? 'Unable to process request at the moment. Please try again later';

        $response->getBody()->write(json_encode([
            'success' => false,
            'message' => $message
        ]));

        return $response->withStatus(400);
    }
}
