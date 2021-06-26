<?php

namespace App\Action\User;

use App\Domain\User\Service\User;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Slim\Views\PhpRenderer as View;

final class ProfileView
{
    protected $user;
    protected $session;
    protected $view;

    public function __construct(
        Session $session,
        User $user,
        View $view
    ) {
        $this->session = $session;
        $this->user = $user;
        $this->view = $view;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {

        $ID = $this->session->get('ID');
        // users
        $user = $this->user->readSingle([
            'ID' => $ID,
            'select' => ['ID', 'fullName', 'userName', 'email', 'btcAddress', 'ethAddress', 'dogeAddress']
        ]);

        $data['profile'] = $user;

        return $this->view->render($response, 'user/profile.php', ['data' => $data]);
    }
}
