<?php

namespace App\Action\User;

use App\Domain\User\Service\User;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Helpers\CryptoHelper;

class ProfileAction
{

    protected $user;
    protected $session;
    protected $cryptoHelper;

    public function __construct(Session $session, User $user, CryptoHelper $cryptoHelper)
    {
        $this->user = $user;
        $this->session = $session;
        $this->cryptoHelper = $cryptoHelper;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {

        $message = false;

        $data = (array) $request->getParsedBody();
        $ID = $this->session->get('ID');

        $email = filter_var($data['email'], FILTER_VALIDATE_EMAIL);
        $oldPassword = $data['oldPassword'];

        // validate email
        if (empty($email)) {
            $message = "Invalid email address";
        }

        // fetch user info
        $user = $this->user->readSingle(['ID' => $ID]);

        if (empty($message) && empty($user->ID)) {
            $message = "Your account seems to need attention. Contact admin.";
        }

        if (empty($message) && !password_verify($oldPassword, $user->password)) {
            $message = "Invalid Old Password";
        }

        // check for wallet addresses and vailidate
        //BTC
        if (empty($message) && !empty($data['btcAddress'])) {
            if (!$this->cryptoHelper->validate('btc', $data['btcAddress'])) {
                $message = "Invalid BTC Address entered.";
            }
        }
        //ETH
        if (empty($message) && !empty($data['ethAddress'])) {
            if (!$this->cryptoHelper->validate('eth', $data['ethAddress'])) {
                $message = "Invalid ETH Address entered.";
            }
        }
        // DOGE
        if (empty($message) && !empty($data['dogeAddress'])) {
            if (!$this->cryptoHelper->validate('doge', $data['dogeAddress'])) {
                $message = "Invalid DOGE Address entered.";
            }
        }
        // LTC
        if (empty($message) && !empty($data['ltcAddress'])) {
            if (!$this->cryptoHelper->validate('ltc', $data['ltcAddress'])) {
                $message = "Invalid LTC Address entered.";
            }
        }

        if (empty($message) && !empty($data['password']) && $data['password'] !== $data['confirmPassword']) {
            $message = "New password and Confirm Password do not match";
        }

        if (empty($message) && !empty($data['password'])) {
            $data['password'] = password_hash($data['database'], PASSWORD_BCRYPT);
        }

        if (empty($message)) {
            $updateData = [
                'fullName' => $data['fullName'],
                'email' => $data['email'],
                'btcAddress' => $data['btcAddress'],
                'ethAddress' => $data['ethAddress'] ?? null,
                'dogeAddress' => $data['dogeAddress'] ?? null,
                'ltcAddress' => $data['ltcAddress'] ?? null
            ];

            if (!empty($data['password'])) {
                $updateData['password'] = $data['password'];
            }

            $update = $this->user->update(['ID' => $ID, 'data' => $updateData]);
        }

        // Clear all flash messages
        $flash = $this->session->getFlashBag();
        $flash->clear();

        // Get RouteParser from request to generate the urls
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $url = $routeParser->urlFor("user-profile");

        if (empty($message) && !empty($update)) {
            $flash->set('success', 'Profile updated successfully!');
        } else {
            $flash->set('error', !empty($message) ? $message : 'Unable to update details at the moment!');
        }

        return $response->withStatus(302)->withHeader('Location', $url);
    }
}
