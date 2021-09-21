<?php

namespace App\Action\User;

use App\Domain\Deposits\Service\Deposits;
use App\Domain\Plans\Service\Plans;
use App\Domain\Settings\Service\Settings;
use App\Helpers\CryptoHelper;
use App\Helpers\SendMail;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;
use Symfony\Component\HttpFoundation\Session\Session;

final class DepositsAction
{
    private $deposits;
    private $cryptoHelper;
    private $settings;
    private $session;
    private $plans;
    private $sendMail;

    public function __construct(
        Deposits $deposits,
        Settings $settings,
        CryptoHelper $cryptoHelper,
        Session $session,
        Plans $plans,
        SendMail $sendMail
    ) {
        $this->deposits = $deposits;
        $this->settings = $settings;
        $this->cryptoHelper = $cryptoHelper;
        $this->session = $session;
        $this->plans = $plans;
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

        $data['userID'] = $this->session->get('ID');
        $data['userName'] = $this->session->get('userName');
        $data['transactionID'] = strtoupper(uniqid());
        $data['amount'] = (float) $data['amount'];

        // send to api (coming soon)

        // get btc amount
        $data['cryptoAmount'] = $this->cryptoHelper->usdToCrypto($data['amount'], $data['cryptoCurrency']);

        if (empty($message) && empty($data['cryptoAmount'])) {
            $message = "One of our service providers seems to be busy at the moment. Please try again later.";
        }

        // get plan info 
        $plan = $this->plans->readSingle(['ID' => $data['planID']]);

        if (empty($message) && empty($plan->ID)) {
            $message = "Selected plan seems to be unavailable at the moment.";
        }

        // verify the amount is within range for selected plan
        if (empty($message) && $plan->minimum > $data['amount']) {
            // amount under
            $message = "Amount ($" .
                $data['amount'] .
                ") is lower than minimum deposit ($" .
                $plan->minimum .
                ") for this plan";
        }
        if (empty($message) && !empty($plan->maximum) && $plan->maximum < $data['amount']) {
            // amount over
            $message = "Amount ($" .
                $data['amount'] .
                ") is higher than maximum deposit ($" .
                $plan->maximum .
                ") for this plan";
        }

        if (empty($message)) {
            // fill up other details
            $data['planTitle'] = $plan->title;
            $data['percentage'] = $plan->percentage;
            $data['profitFrequency'] = $plan->profitFrequency;

            $depositAddress = $data['cryptoCurrency'] . "DepositAddress";

            $data['depositAddress'] = $this->settings->$depositAddress;

            if (empty($data['depositAddress'])) $message = "Unable to create payment link. Please try another Crypto Currency.";

            // Invoke the Domain with inputs and retain the result
            if (empty($message)) $depositId = $this->deposits->create(['data' => $data]);
        }

        // responses
        if (empty($message) && !empty($depositId)) {
            // Clear all flash messages
            $flash = $this->session->getFlashBag();
            $flash->clear();

            $flash->set('success', "The deposit has been saved. It will become active when the administrator checks statistics");
            // Get RouteParser from request to generate the urls
            $routeParser = RouteContext::fromRequest($request)->getRouteParser();

            $url = $routeParser->urlFor("user-view-deposit", ['id' => $depositId]);

            $response->getBody()->write(json_encode([
                'success' => true,
                'message' => "Successful",
                'redirect' => $url
            ]));

            // notify admin
            $this->sendMail->sendPendingDepositMailToAdmin($data['userName'], $data['amount']);

            // Redirect to protected page
            return $response;
        }

        $message = $message ?? 'Unable to generate deposit hash at the moment. Please try again later';

        $response->getBody()->write(json_encode([
            'success' => false,
            'message' => $message
        ]));

        return $response->withStatus(400);
    }
}
