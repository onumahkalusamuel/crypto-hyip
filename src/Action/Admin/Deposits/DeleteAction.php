<?php

namespace App\Action\Admin\Deposits;

use App\Domain\Deposits\Service\Deposits;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;
use Symfony\Component\HttpFoundation\Session\Session;

final class DeleteAction
{

    private $deposits;
    private $session;

    public function __construct(Deposits $deposits, Session $session)
    {
        $this->deposits = $deposits;
        $this->session = $session;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
    ): ResponseInterface {

        $ID = $args['id'];

        $deposit = $this->deposits->readSingle(['ID'=>$ID]);

        if($deposit->depositStatus === "pending") {
            $delete = $this->deposits->delete(['ID'=>$ID]);
        }

        // Clear all flash messages
        $flash = $this->session->getFlashBag();
        $flash->clear();

        // Get RouteParser from request to generate the urls
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();

        $url = $routeParser->urlFor('admin-deposits');


        if (!empty($delete)) {
            $flash->set('success', "Deposit deleted successfully");
        } else {
            $flash->set('error', "Unable to delete record at the moment. Please try again later.");
        }

        return $response->withStatus(302)->withHeader('Location', $url);
    }
}
