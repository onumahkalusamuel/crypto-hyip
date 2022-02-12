<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
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
        $response->getBody()->write(json_encode(array('success' => true)));
        return $response;
    }
}
