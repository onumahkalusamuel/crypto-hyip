<?php

namespace App\Action\User;

use App\Domain\User\Service\User;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ReadAction
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
        $userId = $args['id'] ?? null;
        $auth = $request->getAttribute("token")['data'];

        if ($auth->userType != "admin") {
            if (empty($userId) || $auth->ID !== $userId) {
                \http_response_code(403);
                return $response;
            }
        }

        // Invoke the Domain with inputs and retain the result
        $user = $this->user->readUser($userId);
        // Transform the result into the JSON representation
        // Build the HTTP response
        \http_response_code(empty($user) ? 404 : 200);
        $response->getBody()->write(json_encode($user));

        return $response;
    }
}
