<?php

namespace App\Action\Admin\Withdrawals;

use App\Domain\Withdrawals\Service\Withdrawals;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\PhpRenderer as View;

final class ViewAll
{
    protected $withdrawals;
    protected $view;

    public function __construct(
        Withdrawals $withdrawals,
        View $view
    ) {
        $this->withdrawals = $withdrawals;
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

        if (!empty($_GET['withdrawalStatus'])) {
            $params['where']['withdrawalStatus'] =  $_GET['withdrawalStatus'];
        }

        // paging
        $filters['page'] = !empty($_GET['page']) ? $_GET['page'] : 1;
        $filters['rpp'] = isset($_GET['rpp']) ? (int) $_GET['rpp'] : 20;

        // withdrawals
        $withdrawals = $this->withdrawals->readPaging([
            'params' => $params,
            'filters' => $filters
        ]);

        // prepare the return data
        $data = [
            'withdrawals' => $withdrawals
        ];

        return $this->view->render($response, 'admin/withdrawals.php', ['data' => $data]);
    }
}
