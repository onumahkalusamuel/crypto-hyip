<?php

namespace App\Action\User;

use App\Domain\User\Service\User;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class CreateAction
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        // Collect input from the HTTP request
        $override = false;
        $data = (array)$request->getParsedBody();
        $auth = $request->getAttribute("token")['data'];
        if ($auth->userType == "admin") $override = true;

        $data['userType'] = "user";

        // Invoke the Domain with inputs and retain the result
        $userId = $this->user->createUser($data, $override);

        // Transform the result into the JSON representation
        $result = [
            'user_id' => $userId
        ];

        // Build the HTTP response
        $response->getBody()->write((string)json_encode($result));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
    }
}
