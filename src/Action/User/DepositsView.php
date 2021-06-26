<?php

namespace App\Action\User;

use App\Domain\Deposits\Service\Deposits;
use App\Domain\Plans\Service\Plans;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Slim\Views\PhpRenderer as View;

final class DepositsView
{
    protected $session;
    protected $deposits;
    protected $plans;
    protected $view;

    public function __construct(
        Session $session,
        Deposits $deposits,
        Plans $plans,
        View $view
    ) {
        $this->session = $session;
        $this->deposits = $deposits;
        $this->plans = $plans;
        $this->view = $view;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {

        $ID = $this->session->get('ID');

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

        // plans
        $plans = $this->plans->readAll([
            'params' => ['isActive' => 1],
            'select' => ['ID', 'title', 'minimum', 'maximum', 'percentage', 'durationType', 'profitFrequency', 'duration']
        ]);

        // prepare the return data
        $data = [
            'deposits' => $deposits,
            'plans' => $plans
        ];

        return $this->view->render($response, 'user/deposits.php', ['data' => $data]);
    }
}
