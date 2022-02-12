<?php

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Response;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Middleware for checking if current user is an admin or not
 */
final class UserAuthMiddleware implements MiddlewareInterface
{
    /**
     * @var Session
     */
    private $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {



        //check if there is a school id in header
        $usertype = $request->getAttribute('token')['data']->userType;

        if ($usertype  === 'user') {
            return $handler->handle($request);
        }

        $return['success'] = false;
        $return['message'] = 'Unauthorized Access';
        $response = new Response;
        $response->getBody()->write(json_encode($return, JSON_PRETTY_PRINT));

        return $response;
    }
}
