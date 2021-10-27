<?php

namespace App\Action\User;

use App\Domain\User\Service\User;
use App\Domain\Settings\Service\Settings;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Smarty as View;

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
        $select = ['ID', 'fullName', 'userName', 'email'];
        foreach ($GLOBALS['activeCurrencies'] as $currency) {
            $select[] = $currency . 'Address';
            $select[] = $currency . 'Balance';
        }
        // users
        $user = $this->user->readSingle([
            'ID' => $ID,
            'select' => $select
        ]);

        $data['profile'] = $user;
        $data['activeCurrencies'] = $GLOBALS['activeCurrencies'];

        $this->view->assign('data', $data);
        $this->view->display('theme/user/profile.tpl');

        return $response;
    }
}
