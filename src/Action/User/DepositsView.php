<?php

namespace App\Action\User;

use App\Domain\Deposits\Service\Deposits;
use App\Domain\Plans\Service\Plans;
use App\Domain\Settings\Service\Settings;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Smarty as View;

final class DepositsView
{
    protected $session;
    protected $deposits;
    protected $plans;
    protected $view;
    private $settings;

    public function __construct(
        Session $session,
        Deposits $deposits,
        Plans $plans,
        Settings $settings,
        View $view
    ) {
        $this->session = $session;
        $this->deposits = $deposits;
        $this->plans = $plans;
        $this->view = $view;
        $this->settings = $settings;
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
            'plans' => $plans,
            'activeCurrencies' => explode(',', $this->settings->activeCurrencies)
        ];

        $this->view->assign('data', $data);
        $this->view->display('theme/user/deposits.tpl');

        return $response;
    }
}
