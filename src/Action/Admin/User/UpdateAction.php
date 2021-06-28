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
        if(!empty($data['password'])) {
            $newData['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        }

        // validate btc address
        if(!empty($data['btcAddress'])) {
            $verify = $this->cryptoHelper->validate('btc', $data['btcAddress']);
            if(empty($verify)) $message = "Invalid Bitcoin Address";
        }

        // validate email
        if(empty($message) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            if(empty($verify)) $message = "Invalid Email Address";
        }

        // continue
        if(empty($message)) {
            $newData['fullName'] = $data['fullName'];
            $newData['userName'] = $data['userName'];
            $newData['email'] = $data['email'];
            $newData['btcAddress'] = $data['btcAddress'];

            if($ID === "new") { 
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
