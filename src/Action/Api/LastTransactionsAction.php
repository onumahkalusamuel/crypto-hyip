<?php

namespace App\Action\Api;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use App\Domain\TrailLog\Service\TrailLog;

class LastTransactionsAction
{
    protected $trailLog;

    public function __construct(TrailLog $trailLog)
    {
        $this->trailLog = $trailLog;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
    ) {

        $type = $args['type'] ?? 'deposit';
        $count = $_GET['count'] ?? 5;
        $logs = [];

        if (in_array($type, ['deposit', 'earning', 'referral', 'withdrawal', 'bonus'])) {
            $logs = $this->trailLog->readPaging([
                'params' => ['where' => ['logType' => $type]],
                'select' => ['userName as user','logType as type', 'cryptoCurrency as currency', 'amount'],
                'filters' => ['rpp' => $count],
                'order_by' => 'createdAt',
                'order' => 'DESC'
            ])['data'];
        }

        $response->getBody()->write(json_encode($logs));

        return $response;
    }
}
