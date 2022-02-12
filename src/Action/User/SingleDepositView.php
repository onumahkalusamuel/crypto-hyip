<?php

namespace App\Action\User;

use App\Domain\Deposits\Service\Deposits;
use App\Domain\TrailLog\Service\TrailLog;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Smarty as View;

final class SingleDepositView
{
    protected $deposits;
    protected $trailLog;
    protected $view;

    public function __construct(
        Deposits $deposits,
        TrailLog $trailLog,
        View $view
    ) {
        $this->deposits = $deposits;
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

        $response->getBody()->write(json_encode([
            'success' => true,
            'data' => $data
        ]));

        return $response;
    }
}
