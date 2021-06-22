<?php

namespace App\Action\User;

use App\Domain\User\Service\User;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class DeleteAction
{
    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        if (!empty($args['id'])) {

            if ($this->user->deleteUser($args['id'])) {
                $response->getBody()->write((string)json_encode(['message' => 'User deleted.']));
            } else {
                \http_response_code(404);
            }
        } else {
            \http_response_code(400);
        }

        return $response;
    }
}
