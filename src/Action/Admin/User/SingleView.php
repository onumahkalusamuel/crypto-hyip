<?php

namespace App\Action\Admin\User;

use App\Domain\User\Service\User;
use App\Domain\Settings\Service\Settings;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Smarty as View;

final class SingleView
{
    private $user;
    private $settings;
    protected $view;

    public function __construct(
        User $user,
        Settings $settings,
        View $view
    ) {
        $this->user = $user;
        $this->settings = $settings;
        $this->view = $view;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
    ): ResponseInterface {

        $ID = $args['id'];

        if ($ID === 'new') {
            $user = new \stdClass;
            $user->ID = "new";
            $data['user'] = $user;
        } else {

            // find the user
            $user = $this->user->readSingle(['ID' => $ID]);
            $user->password = null;

            //set the user to output
            $data['user'] = $user;
        }

        $this->view->assign('data', $data);
        $this->view->display('admin/edit-user.tpl');

        return $response;
    }
}
