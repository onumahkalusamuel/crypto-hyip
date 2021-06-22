<?php

namespace App\Action\User;

use App\Domain\User\Service\User;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ResetConfirmAction
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
        if (empty($args['token'])) {
            \http_response_code(400);
            return $response;
        }

        $user = $this->user->findUser($args);

        // verify the user exists
        if (empty($user)) {
            $response->getBody()->write(json_encode(['success' => false, 'message' => 'Unable to verify token. Please request for a new one.']));
            \http_response_code(400);
            return $response;
        }

        $response->getBody()->write(json_encode([
            'ID' => $user['ID'],
            'email' => $user['email']
        ]));

        return $response;
    }
}
