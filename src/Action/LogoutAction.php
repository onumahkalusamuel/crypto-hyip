<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;
use Symfony\Component\HttpFoundation\Session\Session;

/** Logout a user */
final class LogoutAction
{
    /**
     * @var Session
     */
    private $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        // Logout user
        $this->session->invalidate();

        $routeParser = RouteContext::fromRequest($request)->getRouteParser();

        $url = $routeParser->urlFor('login');

        return $response->withStatus(302)->withHeader('Location', $url);
    }
}
