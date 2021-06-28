<?php

namespace App\Action\Admin\Plans;

use App\Domain\Plans\Service\Plans;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;
use Symfony\Component\HttpFoundation\Session\Session;

final class UpdateAction
{

    private $plans;
    private $session;

    public function __construct(Plans $plans, Session $session)
    {
        $this->plans = $plans;
        $this->session = $session;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
    ): ResponseInterface {

        $ID = $args['id'];
        
        $data = (array) $request->getParsedBody();

        if($ID === 'new') {
            $update = $this->plans->create(['data' => $data]);
        } else {
            $update = $this->plans->update(['ID' => $ID, 'data' => $data]);
        }

        // Clear all flash messages
        $flash = $this->session->getFlashBag();
        $flash->clear();

        // Get RouteParser from request to generate the urls
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();

        $url = $routeParser->urlFor('admin-plans');


        if (!empty($update)) {
            $flash->set('success', "Plan saved successfully...");
        } else {
            $flash->set('error', "Unable to save plan at the moment. Please try again later.");
        }

        return $response->withStatus(302)->withHeader('Location', $url);
    }
}
