<?php

namespace App\Action;

use App\Domain\User\Service\User;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Smarty as View;
use Symfony\Component\HttpFoundation\Session\Session;

class ResetUpdateAction
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

        $return['success'] = false;
        $return['message'] = "An error occured";

        $data = (array) $request->getParsedBody();

        $newPassword = $data['newPassword'];
        $token = $args['token'];
        $email = $args['email'];
        $csrf = $this->session->get('csrf');
        $tokenConfirm = $this->session->get('token');
        $emailConfirm = $this->session->get('email');
        $ID = $this->session->get('ID');

        if ($email !== $emailConfirm || empty($newPassword)) {
            $message = "An error occured. Please try again later.";
        }

        if ($token !== $tokenConfirm) {
            $message = "Unable to verify details. Please try again later.";
        }

        if ($csrf !== $data['csrf']) {
            $message = "An error occured verifying your details. Please try again later.";
        }

        if (empty($message)) {
            $update = $this->user->update([
                'ID' => $ID,
                'data' => [
                    'token' => null,
                    'password' => password_hash($data['newPassword'], PASSWORD_BCRYPT)
                ]
            ]);

            if ($update) {
                $return['success'] = true;
                $return['message'] = "Password changed successfully. You can login now.";
                $return['hide_form'] = true;
                $this->session->clear();
            }
        }

        // return 
        $this->view->assign('data', $return);
        $this->view->display("theme/public/pages/reset-update.tpl");
        return $response;
    }
}
