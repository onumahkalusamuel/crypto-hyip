<?php

namespace App\Action\User;

use App\Domain\User\Service\User;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

final class UpdateAction
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $data = (array)$request->getParsedBody();

        $auth = $request->getAttribute("token")['data'];

        //if a user requests update, update his/her profile
        if ($auth->userType !== "admin") {
            $args['id'] = $auth->ID;
            // if its an admin, then its expected to actually carry ID
        } elseif ($auth->userType == "admin" && empty($args['id'])) {
            $response->getBody()->write(json_encode(['success' => false, 'message' => 'User to be updated not specified.']));
            \http_response_code(400);
            return $response;
        }

        // check for password update
        if (!empty($data['newPassword'])) $data['password'] = $data['newPassword'];

        // update
        $this->user->updateUser($args['id'], $data);

        $response->getBody()->write(json_encode(['success' => true, 'message' => 'User updated successfully.']));

        return $response;
    }
}
