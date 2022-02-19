<?php

namespace App\Action\Admin;

use App\Domain\User\Service\User;
use App\Helpers\SendMail;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;
use Symfony\Component\HttpFoundation\Session\Session;

class LoginAction
{
    protected $user;
    protected $session;
    protected $sendMail;

    public function __construct(Session $session, User $user, SendMail $sendMail)
    {
        $this->user = $user;
        $this->session = $session;
        $this->sendMail = $sendMail;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {

        $data = (array) $request->getParsedBody();

        $email = trim($data['email']);
        $password = $data['password'];

        // variables
        $loggedIn = false;
        $userType = '';
        $message = '';

        // attempt login by email
        $loginUser = $this->user->find(['params' => ['userName' => $email]]);

        // then by email
        if (empty($loginUser->ID)) {
            $loginUser = $this->user->find(['params' => ['email' => $email]]);
        }

        if (password_verify($password, $loginUser->password) && $loginUser->userType === 'admin') {
            $loggedIn = true;
        }

        if (empty($message) && $loggedIn) {
            $this->sendMail->sendAdminLoggedIn();
        }

        if (empty($message) && $loggedIn) {
            // Login successfully
            $this->session->invalidate();
            $this->session->start();

            $this->session->set('ID', $loginUser->ID);
            $this->session->set('userType', $loginUser->userType);
            $this->session->set('userName', $loginUser->userName);
            $this->session->set('email', $loginUser->email);
            $message = "Login successful.";

            $routeParser = RouteContext::fromRequest($request)->getRouteParser();

            $url = $routeParser->urlFor('admin-dashboard');
        }

        if (empty($message)) {
            $message = 'Invalid Login Details!';
        }

        $response->getBody()->write(json_encode([
            'success' => true,
            'message' => $message,
            'userType' => $userType,
            'redirect' => $url
        ]));

        return $response;
    }
}
