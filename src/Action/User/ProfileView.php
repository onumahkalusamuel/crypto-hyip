<?php

namespace App\Action\User;

use App\Domain\User\Service\User;
use App\Domain\Settings\Service\Settings;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Slim\Views\PhpRenderer as View;

final class ProfileView
{
    protected $user;
    protected $session;
    protected $settings;
    protected $view;

    public function __construct(
        Session $session,
        User $user,
        Settings $settings,
        View $view
    ) {
        $this->session = $session;
        $this->user = $user;
        $this->settings = $settings;
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
            'select' => ['ID', 'fullName', 'userName', 'email', 'btcAddress', 'ethAddress', 'dogeAddress', 'ltcAddress']
        ]);

        $data['profile'] = $user;
        $data['activeCurrencies'] = explode(',', $this->settings->activeCurrencies);

        return $this->view->render($response, 'user/profile.php', ['data' => $data]);
    }
}
