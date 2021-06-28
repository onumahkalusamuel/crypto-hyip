<?php

namespace App\Action\Admin\Deposits;

use App\Domain\Deposits\Service\Deposits;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\PhpRenderer as View;

final class ViewAll
{
    protected $deposits;
    protected $view;

    public function __construct(
        Deposits $deposits,
        View $view
    ) {
        $this->deposits = $deposits;
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

        if (!empty($_GET['depositStatus'])) {
            $params['where']['depositStatus'] =  $_GET['depositStatus'];
        }

        // paging
        $filters['page'] = !empty($_GET['page']) ? $_GET['page'] : 1;
        $filters['rpp'] = isset($_GET['rpp']) ? (int) $_GET['rpp'] : 20;

        // deposits
        $deposits = $this->deposits->readPaging([
            'params' => $params,
            'filters' => $filters
        ]);

        // prepare the return data
        $data = [
            'deposits' => $deposits
        ];

        return $this->view->render($response, 'admin/deposits.php', ['data' => $data]);
    }
}
