<?php

namespace App\Action\Admin\Withdrawals;

use App\Domain\Withdrawals\Service\Withdrawals;
use App\Domain\TrailLog\Service\TrailLog;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\PhpRenderer as View;

final class SingleView
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

        $ID = $args['id'];

        // find the deposit
        $withdrawal = $this->withdrawals->readSingle(['ID' => $ID]);

        // trailLog of Deposit
        $trailLog = $this->trailLog->readAll([
            'params' => [
                'where' => [
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

        return $this->view->render($response, 'admin/view-withdrawal.php', ['data' => $data]);
    }
}
