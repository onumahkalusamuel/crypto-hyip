<?php

namespace App\Action\User;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class TokenCheckAction
{
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        $auth = $request->getAttribute("token")['data'];
        $response->getBody()->write(json_encode(['userType' => $auth->userType]));
        return $response;
    }
}
