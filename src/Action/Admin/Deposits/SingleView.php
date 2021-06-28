<?php

namespace App\Action\Admin\Deposits;

use App\Domain\Deposits\Service\Deposits;
use App\Domain\TrailLog\Service\TrailLog;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\PhpRenderer as View;

final class SingleView
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

        $ID = $args['id'];

        // find the deposit
        $deposit = $this->deposits->readSingle(['ID' => $ID]);

        // trailLog of Deposit
        $trailLog = $this->trailLog->readAll([
            'params' => [
                'where' => [
                    'transactionID' => $ID,
                    'logType' => 'deposit'
                ]
            ]
        ]);

        // prepare the return data
        $data = [
            'deposit' => $deposit,
            'trailLog' => $trailLog
        ];

        return $this->view->render($response, 'admin/view-deposit.php', ['data' => $data]);
    }
}
