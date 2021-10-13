<?php

namespace App\Action\Admin\User;

use App\Domain\User\Service\User;
use App\Helpers\CryptoHelper;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;
use Symfony\Component\HttpFoundation\Session\Session;

final class UpdateAction
{
    private $user;
    private $session;
    private $cryptoHelper;

    public function __construct(User $user, Session $session, CryptoHelper $cryptoHelper)
    {
        $this->user = $user;
        $this->session = $session;
        $this->cryptoHelper = $cryptoHelper;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
    ): ResponseInterface {

        $message = false;
        $ID = $args['id'];
        $data = (array) $request->getParsedBody();
        $newData = [];

        // validate password if any
        if (!empty($data['password'])) {
            $newData['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        }

        // validate addresses
        // BTC
        if (empty($message) && !empty($data['btcAddress'])) {
            if (!$this->cryptoHelper->validate('btc', $data['btcAddress'])) {
                $message = "Invalid BTC Address entered.";
            } else {
                $newData['btcAddress'] = $data['btcAddress'];
            }
        }
        //ETH
        if (empty($message) && !empty($data['ethAddress'])) {
            if (!$this->cryptoHelper->validate('eth', $data['ethAddress'])) {
                $message = "Invalid ETH Address entered.";
            } else {
                $newData['ethAddress'] = $data['ethAddress'];
            }
        }
        // DOGE
        if (empty($message) && !empty($data['dogeAddress'])) {
            if (!$this->cryptoHelper->validate('doge', $data['dogeAddress'])) {
                $message = "Invalid DOGE Address entered.";
            } else {
                $newData['dogeAddress'] = $data['dogeAddress'];
            }
        }
        // LTC
        if (empty($message) && !empty($data['ltcAddress'])) {
            if (!$this->cryptoHelper->validate('ltc', $data['ltcAddress'])) {
                $message = "Invalid LTC Address entered.";
            } else {
                $newData['ltcAddress'] = $data['ltcAddress'];
            }
        }

        // PM
        if (empty($message) && !empty($data['pmAddress'])) {
            if (substr(strtoupper($data['pmAddress']), 0, 1) !== "U") {
                $message = "Invalid PM Address entered.";
            } else {
                $newData['pmAddress'] = $data['pmAddress'];
            }
        }

        // validate email
        if (empty($message) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            if (empty($verify)) $message = "Invalid Email Address";
        }

        // continue
        if (empty($message)) {
            $newData['fullName'] = $data['fullName'];
            $newData['userName'] = $data['userName'];
            $newData['email'] = $data['email'];

            if ($ID === "new") {
                $update = $this->user->create([
                    'data' => $newData
                ]);
                $ID = $update;
            } else {
                $update = $this->user->update([
                    'ID' => $ID,
                    'data' => $newData
                ]);
            }
        }

        // Clear all flash messages
        $flash = $this->session->getFlashBag();
        $flash->clear();

        // Get RouteParser from request to generate the urls
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();

        $url = $routeParser->urlFor('admin-view-user', ['id' => $ID]);

        if (empty($message) && !empty($update)) {
            $flash->set('success', "User info saved successfully.");
        } else {
            $flash->set('error', $message);
        }

        return $response->withStatus(302)->withHeader('Location', $url);
    }
}
