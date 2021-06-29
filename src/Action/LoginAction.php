<?php

namespace App\Action;

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
        if(empty($loginUser->ID)) {
            $loginUser = $this->user->find(['params' => ['email' => $email]]);
        }

        if (password_verify($password, $loginUser->password)) {
            if ($loginUser->isActive === 0) {
                $message = "Sorry, it looks like your account is not active. Please chat with support for assistance.";
            } else {
                $loggedIn = true;
            }
        }

        if (!empty($loginUser->userType)) $userType = $loginUser->userType;

        if ($userType === 'admin') $this->sendMail->sendAdminLoggedIn();

        // Clear all flash messages
        $flash = $this->session->getFlashBag();
        $flash->clear();

        // Get RouteParser from request to generate the urls
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();

        if ($loggedIn) {
            // Login successfully
            // Clears all session data and regenerates session ID
            $this->session->invalidate();
            $this->session->start();

            $this->session->set('ID', $loginUser->ID);
            $this->session->set('userType', $loginUser->userType);
            $this->session->set('userName', $loginUser->userName);
            $this->session->set('email', $loginUser->email);

            // Redirect to protected page
            $url = $routeParser->urlFor("{$userType}-dashboard");
        } else {
            $flash->set('error', !empty($message) ? $message : 'Invalid Login Details!');

            // Redirect back to the login page
            $url = $routeParser->urlFor('page', ['page' => 'login']);
        }

        return $response->withStatus(302)->withHeader('Location', $url);
    }
}
