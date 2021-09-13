<?php

namespace App\Action;

use App\Domain\User\Service\User;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Smarty as View;
use Symfony\Component\HttpFoundation\Session\Session;

class ResetUpdateView
{

    private $view;
    private $user;
    private $session;

    public function __construct(
        User $user,
        View $view,
        Session $session
    ) {

        $this->user = $user;
        $this->view = $view;
        $this->session = $session;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
    ): ResponseInterface {

        $data = [];

        $token = $args['token'];
        $email = $args['email'];

        // attempt login by email
        $user = $this->user->find([
            'params' => [
                'email' => $email,
                'token' => $token
            ],
            'select' => ['ID', 'userName', 'fullName']
        ]);

        if (empty($user->ID)) {
            $data['success'] = false;
            $data['message'] = "Account not found or token already expired.";
        } else {
            $data['message'] = "Token verified. Please set a new password for your account.";
            $data['success'] = true;
            $this->user->update([
                'ID' => $user->ID,
                'data' => ['token' => null]
            ]);

            $csrf = sha1(uniqid());
            $this->session->set('csrf', $csrf);
            $this->session->set('token', $token);
            $this->session->set('email', $email);
            $this->session->set('ID', $user->ID);

            $data['csrf'] = $csrf;
        }

        // return 
        $this->view->assign('data', $data);
        $this->view->display("theme/public/pages/reset-update.tpl");
        return $response;
    }
}
