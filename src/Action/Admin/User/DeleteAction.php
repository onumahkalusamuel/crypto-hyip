<?php

namespace App\Action\Admin\User;

use App\Domain\User\Service\User;
use App\Domain\TrailLog\Service\TrailLog;
use App\Domain\Deposits\Service\Deposits;
use App\Domain\Withdrawals\Service\Withdrawals;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;
use Symfony\Component\HttpFoundation\Session\Session;

final class DeleteAction
{
    private $user;
    private $session;
    private $deposits;
    private $trailLog;
    private $withdrawals;

    public function __construct(
        User $user,
        Session $session,
        TrailLog $trailLog,
        Deposits $deposits,
        Withdrawals $withdrawals
    ) {
        $this->user = $user;
        $this->session = $session;
        $this->trailLog = $trailLog;
        $this->deposits = $deposits;
        $this->withdrawals = $withdrawals;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
    ): ResponseInterface {

        $message = false;
        $ID = $args['id'];

        if ($ID == 1) {
            $message = "Cannot delete this user.";
        }

        // continue
        if (empty($message)) {
            $delete = $this->user->delete(['ID' => $ID]);

            if (!empty($delete)) {
                $this->deposits->delete(['params' => ['userID' => $ID]]);
                $this->withdrawals->delete(['params' => ['userID' => $ID]]);
                $this->trailLog->delete(['params' => ['userID' => $ID]]);
            }
        }

        // Clear all flash messages
        $flash = $this->session->getFlashBag();
        $flash->clear();

        // Get RouteParser from request to generate the urls
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();

        $url = $routeParser->urlFor('admin-users', ['id' => $ID]);

        if (empty($message) && !empty($delete)) {
            $flash->set('success', "User deleted successfully.");
        } else {
            $flash->set('error', $message);
        }

        return $response->withStatus(302)->withHeader('Location', $url);
    }
}
