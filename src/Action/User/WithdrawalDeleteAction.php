<?php

namespace App\Action\User;

use App\Domain\Withdrawals\Service\Withdrawals;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;
use Symfony\Component\HttpFoundation\Session\Session;

final class WithdrawalDeleteAction
{

    private $withdrawals;
    private $session;

    public function __construct(Withdrawals $withdrawals, Session $session)
    {
        $this->withdrawals = $withdrawals;
        $this->session = $session;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
    ): ResponseInterface {

        $ID = $args['id'];
        $userID = $this->session->get('ID');

        $withdrawal = $this->withdrawals->readSingle(['ID'=>$ID]);

        if($withdrawal->withdrawalStatus === "pending" && $withdrawal->userID == $userID) {
            $delete = $this->withdrawals->delete(['ID'=>$ID]);
        }

        // Clear all flash messages
        $flash = $this->session->getFlashBag();
        $flash->clear();

        // Get RouteParser from request to generate the urls
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();

        $url = $routeParser->urlFor('user-withdrawals');


        if (!empty($delete)) {
            $flash->set('success', "Withdrawal deleted successfully");
        } else {
            $flash->set('error', "Unable to delete record at the moment. Please try again later.");
        }

        return $response->withStatus(302)->withHeader('Location', $url);
    }
}
