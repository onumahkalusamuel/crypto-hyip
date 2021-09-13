<?php

namespace App\Action\User;

use App\Domain\Withdrawals\Service\Withdrawals;
use App\Domain\TrailLog\Service\TrailLog;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Smarty as View;

final class SingleWithdrawalView
{
    protected $session;
    protected $withdrawals;
    protected $trailLog;
    protected $view;

    public function __construct(
        Session $session,
        Withdrawals $withdrawals,
        TrailLog $trailLog,
        View $view
    ) {
        $this->session = $session;
        $this->withdrawals = $withdrawals;
        $this->trailLog = $trailLog;
        $this->view = $view;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
    ): ResponseInterface {

        $userID = $this->session->get('ID');
        $ID = $args['id'];
        $params = [];

        // params
        $params['userID'] = $userID;
        $params['ID'] = $ID;

        // find the deposit
        $withdrawal = $this->withdrawals->find(['params' => $params]);

        // trailLog of Deposit
        $trailLog = $this->trailLog->readAll([
            'params' => [
                'where' => [
                    'userID' => $userID,
                    'transactionID' => $ID,
                    'logType' => 'withdrawal'
                ]
            ]
        ]);

        // prepare the return data
        $data = [
            'withdrawal' => $withdrawal,
            'trailLog' => $trailLog
        ];

        $this->view->assign('data', $data);
        $this->view->display('theme/user/view-withdrawal.tpl');

        return $response;
    }
}
