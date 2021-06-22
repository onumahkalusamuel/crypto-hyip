<?php

namespace App\Action\User;

use App\Domain\User\Service\User;
use App\Helpers\SendMail;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Firebase\JWT\JWT;

class LoginAction
{

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
    ): ResponseInterface {

        // $key = "bexFinanceSuperSecret##212";

        // Collect data from request
        $data = $request->getParsedBody();

        if (empty($data['userName']) || empty($data['password'])) {
            \http_response_code(400);
            return $response;
        }

        $loginUser = $this->user->loginUser($data['userName']);
        // return $response;
        if (!empty($loginUser) && $loginUser['isActive']) {

            if (password_verify($data['password'], $loginUser['password'])) {
                // return;
                // generate token
                $token = [
                    "iss" => $_SERVER['HTTP_HOST'],
                    "aud" => $_SERVER['HTTP_HOST'],
                    "iat" => time(),
                    "exp" => time() + 86400,
                    "data" => [
                        "ID" => $loginUser['ID'],
                        "userType" => $loginUser['userType'],
                        "userName" => $loginUser['userName'],
                    ]
                ];
                $jwt = JWT::encode($token, JWT::$key);
                $response->getBody()->write(json_encode([
                    "success" => true,
                    "message" => "Login successful",
                    "jwt" => $jwt,
                    "userType" => $loginUser['userType'],
                ]));
                // run other processes
                if ($loginUser['userType'] == "admin") {
                    $mail = new SendMail();
                    $mail->sendAdminLoggedIn();
                }
            } else {
                \http_response_code(404);
                $response->getBody()->write(json_encode([
                    "success" => false,
                    "message" => "Invalid Username or Password Combination"
                ]));
            }
        } else {
            \http_response_code(404);
            $response->getBody()->write(json_encode([
                "success" => false,
                "message" => "Invalid Username or Password Combination"
            ]));
        }

        return $response;
    }
}
