<?php

namespace App\Action;

use App\Domain\User\Service\User;
use App\Helpers\SendMail;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Firebase\JWT\JWT;
use Psr\Container\ContainerInterface;

class LoginAction
{
    protected $user;
    protected $container;
    protected $sendMail;

    public function __construct(ContainerInterface $container, User $user, SendMail $sendMail)
    {
        $this->user = $user;
        $this->container = $container;
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
        $message = '';

        // attempt login by email
        $loginUser = $this->user->find(['params' => ['userName' => $email, 'userType' => 'user']]);

        // then by email
        if (empty($loginUser->ID)) {
            $loginUser = $this->user->find(['params' => ['email' => $email, 'userType' => 'user']]);
        }

        if (password_verify($password, $loginUser->password)) {
            if (empty($loginUser->isActive)) {
                $message = "Sorry, it looks like your account is not active. Please chat with support for assistance.";
            } else {
                $loggedIn = true;
            }
        }


        if (empty($message) && $loggedIn) {
            // Login successfully
            $token = [
                "iss" => $_SERVER['HTTP_HOST'],
                "aud" => $_SERVER['HTTP_REFERER'],
                "iat" => time(),
                "exp" => time() + 86400,
                "data" => [
                    "ID" => $loginUser->ID,
                    "userType" => "user",
                    "userName" => $loginUser->userName,
                    "email" => $loginUser->email
                ]
            ];

            $jwt = JWT::encode($token, $this->container->get('settings')['jwt_key']);
            $response->getBody()->write(json_encode([
                "success" => true,
                "message" => "Login successful.",
                "jwt" => $jwt,
                "userType" => "user"
            ]));

            return $response;
        }

        // it was a missed login
        if (empty($message)) {
            $message = 'Invalid Login Details!';
        }

        $response->getBody()->write(json_encode([
            'success' => "false",
            'message' => $message
        ]));

        return $response;
    }
}
