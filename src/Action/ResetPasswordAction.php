<?php

namespace App\Action;

use App\Domain\User\Service\User;
use App\Helpers\SendMail;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;

final class ResetPasswordAction
{
    private $user;
    private $sendMail;

    public function __construct(
        User $user,
        SendMail $sendMail
    ) {
        $this->user = $user;
        $this->sendMail = $sendMail;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        // Collect args
        $data = (array) $request->getParsedBody();

        $message = false;
        $email = filter_var($data['email'], FILTER_VALIDATE_EMAIL);


        if (empty($message) && empty($email)) {
            $message = "Please enter a valid email address";
        }

        if (empty($message)) {
            $user = $this->user->find(['params' => $data]);
            if (empty($user->ID)) {
                $message = "Check your email for password reset link. You will get a message if you have an account with us.";
            }
        }

        if (empty($message)) {

            $resetToken = substr(sha1(uniqid()), 7, 15);

            $routeParser = RouteContext::fromRequest($request)->getRouteParser();

            $resetLink = $routeParser->fullUrlFor(
                $request->getUri(),
                'password-reset-link',
                [],
                ['token' => $resetToken, 'email' => $email]
            );

            // save to database 
            $update = $this->user->update(['ID' => $user->ID, 'data' => ['token' => $resetToken]]);

            if (empty($update)) {
                $message = 'Unable to reset password at the moment. Please contact support.';
            }

            if (empty($message)) {
                $this->sendMail->sendPasswordResetEmail($user->email, $user->fullName, $resetLink);

                $response->getBody()->write(json_encode([
                    'success' => true,
                    'message' => "Check your email for password reset link. You only get a message if you have an account with us."
                ]));

                // Redirect to protected page
                return $response;
            }
        }

        $message = $message ?? 'Unable to process request at the moment. Please try again later.';

        $response->getBody()->write(json_encode([
            'success' => false,
            'message' => $message
        ]));

        return $response->withStatus(400);
    }
}
