<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;
use Symfony\Component\HttpFoundation\Session\Session;

final class AffiliatesAction
{
    private $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
    ): ResponseInterface {

        // used to track progress
        $referralUserName = $args['referralUserName'] ?? '';

        // keep it in the session
        $this->session->set('referralUserName', $referralUserName);

        // Get RouteParser from request to generate the urls
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();

        // $url = $routeParser->urlFor("page", ['page' => "register"]);

        $url = $routeParser->urlFor("home");

        return $response->withStatus(302)->withHeader('Location', $url);
    }
}
