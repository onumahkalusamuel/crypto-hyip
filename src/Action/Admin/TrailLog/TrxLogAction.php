<?php

namespace App\Action\TrailLog;

use App\Domain\TrailLog\Service\TrailLog;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class TrxLogAction
{
    private $trailLog;

    public function __construct(TrailLog $trailLog)
    {
        $this->trailLog = $trailLog;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
    ): ResponseInterface {
        // Collect args
        // Invoke the Domain with inputs and retain the result
        $inv = $this->trailLog->read(['type' => 'deposit', 'rpp' => 8]);
        $with = $this->trailLog->read(['type' => 'withdrawal', 'rpp' => 8]);

        $return['investments'] = $inv['traillog'];
        $return['withdrawals'] = $with['traillog'];
        // Transform the result into the JSON representation
        $response->getBody()->write(json_encode($return));

        return $response;
    }
}
