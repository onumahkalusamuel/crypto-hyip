<?php

namespace App\Action\Admin\User;

use App\Domain\User\Service\User;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Smarty as View;

final class ViewAll
{
    protected $user;
    protected $view;

    public function __construct(
        User $user,
        View $view
    ) {
        $this->user = $user;
        $this->view = $view;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {

        $filters = $params = [];

        // where
        $params['where']['userType'] = 'user';

        if (!empty($_GET['ID'])) {
            $params['where']['ID'] = $_GET['ID'];
        }

        if (!empty($_GET['query'])) {
            $params['like']['fullName'] =  $_GET['query'];
            $params['like']['userName'] =  $_GET['query'];
            $params['like']['email'] =  $_GET['query'];
        }

        // paging
        $filters['page'] = !empty($_GET['page']) ? $_GET['page'] : 1;
        $filters['rpp'] = isset($_GET['rpp']) ? (int) $_GET['rpp'] : 20;

        // user
        $user = $this->user->readPaging([
            'params' => $params,
            'filters' => $filters
        ]);

        // prepare the return data
        $data = [
            'users' => $user
        ];
        
        $this->view->assign('data', $data);
        $this->view->display('admin/users.tpl');

        return $response;
    }
}
