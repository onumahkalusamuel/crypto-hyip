<?php

namespace App\Action\Admin\Plans;

use App\Domain\Plans\Service\Plans;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;
use Symfony\Component\HttpFoundation\Session\Session;

final class DeleteAction
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

        $delete = $this->plans->delete(['ID'=>$ID]);

        // Clear all flash messages
        $flash = $this->session->getFlashBag();
        $flash->clear();

        // Get RouteParser from request to generate the urls
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();

        $url = $routeParser->urlFor('admin-plans');


        if (!empty($delete)) {
            $flash->set('success', "Plan deleted successfully");
        } else {
            $flash->set('error', "Unable to delete plan at the moment. Please try again later.");
        }

        return $response->withStatus(302)->withHeader('Location', $url);
    }
}
