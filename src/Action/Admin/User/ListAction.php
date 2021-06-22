<?php

namespace App\Action\User;

use App\Domain\User\Service\User;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ListAction
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
        $page = $args['page'] ?? 1;
        $rpp = $args['rpp'] ?? 10;
        $auth = $request->getAttribute("token")['data'];
        $userName = isset($_GET['userName']) ? $_GET['userName'] : '';

        if ($auth->userType !== "admin") {
            $userName = $auth->userName;
        }

        // Invoke the Domain with inputs and retain the result
        $user = $this->user->usersList($page, $rpp, $userName);
        // Transform the result into the JSON representation
        // Build the HTTP response
        \http_response_code(200);
        $response->getBody()->write(json_encode($user));

        return $response;
    }
}
