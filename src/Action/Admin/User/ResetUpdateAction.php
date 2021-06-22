<?php

namespace App\Action\User;

use App\Domain\User\Service\User;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

final class ResetUpdateAction
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $data = (array)$request->getParsedBody();
        if (
            empty($data['ID']) ||
            empty($data['email']) ||
            empty($data['token']) ||
            empty($data['newPassword']) ||
            empty($data['newPasswordAgain']) ||
            ($data['newPassword'] !==
                $data['newPasswordAgain']) ||
            empty($this->user->findUser(['ID' => $data['ID']]))
        ) {
            $response->getBody()->write(json_encode(['success' => false, 'message' => 'Something went wrong, Please contact support.']));
            \http_response_code(400);
            return $response;
        }

        // update
        $this->user->updateUser($data['ID'], ['password' => $data['newPassword'], "token" => ""]);

        $response->getBody()->write(json_encode(['success' => true, 'message' => 'Password changed successfully.']));

        return $response;
    }
}
