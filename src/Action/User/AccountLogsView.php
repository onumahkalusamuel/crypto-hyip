<?php

namespace App\Action\User;

use App\Domain\TrailLog\Service\TrailLog;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Smarty as View;

final class AccountLogsView
{
    protected $trailLog;
    protected $view;

    public function __construct(
        TrailLog $trailLog,
        View $view
    ) {
        $this->trailLog = $trailLog;
        $this->view = $view;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {

        $ID = $request->getAttribute('token')['data']->ID;

        $filters = $params = [];

        // where
        $params['where']['userID'] = $ID;
        $params['where']['to'] = $_GET['to'] ?? date("Y-m-d", strtotime("+1 day"));
        // $params['where']['from'] = $_GET['from'] ?? date("Y-m-d", strtotime("-3 month"));
        $params['where']['logType'] = $_GET['logType'] ?? 'all';

        // paging
        $filters['page'] = !empty($_GET['page']) ? $_GET['page'] : 1;
        $filters['rpp'] = isset($_GET['rpp']) ? (int) $_GET['rpp'] : 20;

        // trailLog
        $trailLog = $this->trailLog->readPaging([
            'params' => $params,
            'filters' => $filters
        ]);

        $response->getBody()->write(json_encode([
            'success' => true,
            'data' => $trailLog
        ]));

        return $response;
    }
}
