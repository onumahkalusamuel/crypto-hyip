<?php

namespace App\Action\Admin\TrailLog;

use App\Domain\TrailLog\Service\TrailLog;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\PhpRenderer as View;

final class ViewAll
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

        $filters = $params = [];

        // where
        if(!empty($_GET['userID'])) {
            $params['where']['userID'] = $_GET['userID'];
        }

        $params['where']['to'] = $_GET['to'] ?? '';
        $params['where']['from'] = $_GET['from'] ?? '';

        if (!empty($_GET['logType'])) {
            $params['where']['logType'] =  $_GET['logType'];
        }

        // paging
        $filters['page'] = !empty($_GET['page']) ? $_GET['page'] : 1;
        $filters['rpp'] = isset($_GET['rpp']) ? (int) $_GET['rpp'] : 20;

        // trailLog
        $data['transactions'] = $this->trailLog->readPaging([
            'params' => $params,
            'filters' => $filters
        ]);

        return $this->view->render($response, 'admin/transactions.php', ['data' => $data]);
    }
}
