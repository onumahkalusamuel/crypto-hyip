<?php

namespace App\Action\User;

use App\Domain\Deposits\Service\Deposits;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class DepositsView
{
    protected $deposits;

    public function __construct(
        Deposits $deposits
    ) {
        $this->deposits = $deposits;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {

        $ID = $request->getAttribute('token')['data']->ID;

        $filters = $params = [];

        // where
        $params['where']['userID'] = $ID;
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

        $response->getBody()->write(json_encode([
            'success' => true,
            'data' => $deposits
        ]));

        return $response;
    }
}
