<?php

namespace App\Action\Admin\User;

use App\Domain\User\Service\User;
use App\Domain\Referrals\Service\Referrals;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Smarty as View;

final class ViewAll
{
    protected $user;
    protected $view;
    protected $referrals;

    public function __construct(
        User $user,
        View $view,
        Referrals $referrals
    ) {
        $this->user = $user;
        $this->view = $view;
        $this->referrals = $referrals;
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
        $users = $this->user->readPaging([
            'params' => $params,
            'filters' => $filters,
            'order_by' => 'createdAt',
            'order' => 'DESC'
        ]);

        foreach ($users['data'] as &$user) {
            // find upline
            $user->upliner = "";
            $ref = $this->referrals->find(['params' => ['referredUserID' => $user->ID]]);
            if (!empty($ref->referralUserName)) $user->upliner = $ref->referralUserName;
        }
        // prepare the return data
        $data = [
            'users' => $users
        ];

        $this->view->assign('data', $data);
        $this->view->display('admin/users.tpl');

        return $response;
    }
}
