<?php

namespace App\Action\User;

use App\Domain\Deposits\Service\Deposits;
use App\Domain\TrailLog\Service\TrailLog;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Smarty as View;

final class SingleDepositView
{
    protected $session;
    protected $deposits;
    protected $trailLog;
    protected $view;

    public function __construct(
        Session $session,
        Deposits $deposits,
        TrailLog $trailLog,
        View $view
    ) {
        $this->session = $session;
        $this->deposits = $deposits;
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
        $deposit = $this->deposits->find(['params' => $params]);

        // trailLog of Deposit
        $trailLog = $this->trailLog->readAll([
            'params' => [
                'where' => [
                    'userID' => $userID,
                    'transactionID' => $ID
                ],
                'like' => ['logType' => 'deposit'],
            ]
        ]);

        // prepare the return data
        $data = [
            'deposit' => $deposit,
            'trailLog' => $trailLog
        ];

        $this->view->assign('data', $data);
        $this->view->display('theme/user/view-deposit.tpl');

        return $response;
    }
}
