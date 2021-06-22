<?php

namespace App\Action\User;

use App\Domain\User\Service\User;
use App\Helpers\SendMail;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Psr7\Response;


final class ResetAction
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
        // Collect args
        $data = (array) $request->getParsedBody();

        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $response->getBody()->write(json_encode(['success' => false, 'message' => 'A valid email is required.']));
            \http_response_code(400);
            return $response;
        }

        $user = $this->user->findUser($data);

        // verify the user exists
        if (empty($user)) {
            $response->getBody()->write(json_encode(['success' => false, 'message' => 'Sorry, it seems like you do not have an account with us yet.']));
            \http_response_code(400);
            return $response;
        }

        // generate reset token 
        $resetToken = substr(sha1(uniqid()), 7, 15);

        // save to database 
        $update = $this->user->updateUser($user['ID'], ['token' => $resetToken]);

        if (!$update) {
            // $response->getBody()->write(json_encode(['success' => false, 'message' => 'Unable to reset password at the moment. Please contact support.']));
            // \http_response_code(400);
            // return $response;
        }

        $mail = new SendMail();

        $send = $mail->sendPasswordResetEmail($user['email'], $user['fullName'], $resetToken);

        if (!$send['success']) {
            \http_response_code(400);
            $response = new Response;
            $response->getBody()->write(json_encode(['success' => false, 'message' => 'Unable to reset password at the moment. Please contact support.']));
        } else {
            $response->getBody()->write(json_encode(['success' => true, 'message' => '']));
        }

        return $response;
    }
}
