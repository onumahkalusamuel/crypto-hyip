<?php

namespace App\Action\User;

use App\Domain\Withdrawals\Service\Withdrawals;
use App\Domain\TrailLog\Service\TrailLog;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Smarty as View;

final class SingleWithdrawalView
{
    protected $withdrawals;
    protected $trailLog;
    protected $view;

    public function __construct(
        Withdrawals $withdrawals,
        TrailLog $trailLog,
        View $view
    ) {
        $this->withdrawals = $withdrawals;
        $this->trailLog = $trailLog;
        $this->view = $view;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
    ): ResponseInterface {

        $userID = $request->getAttribute('token')['data']->ID;
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

        $response->getBody()->write(json_encode([
            'success' => true,
            'data' => $data
        ]));

        return $response;
    }
}
