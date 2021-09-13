<?php

namespace App\Action\User;

use App\Domain\Withdrawals\Service\Withdrawals;
use App\Domain\User\Service\User;
use App\Domain\Settings\Service\Settings;
use App\Domain\Plans\Service\Plans;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Smarty as View;

final class WithdrawalsView
{
    protected $session;
    protected $withdrawals;
    protected $user;
    protected $plans;
    protected $settings;
    protected $view;

    public function __construct(
        Session $session,
        Withdrawals $withdrawals,
        User $user,
        Plans $plans,
        Settings $settings,
        View $view
    ) {
        $this->session = $session;
        $this->withdrawals = $withdrawals;
        $this->user = $user;
        $this->plans = $plans;
        $this->settings = $settings;
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

        // wallets
        $wallets = $this->getAvailableWallets($ID);

        // minimum withdrawal from settings
        $minWithdrawal = $this->settings->minWithdrawal;

        // prepare the return data
        $data = [
            'withdrawals' => $withdrawals,
            'wallets' => $wallets,
            'min_withdrawal' => $minWithdrawal
        ];

        $this->view->assign('data', $data);
        $this->view->display('theme/user/withdrawals.tpl');

        return $response;
    }

    public function getAvailableWallets($ID): array
    {

        $wallets = [];
        $activeCurrencies = explode(',', $this->settings->activeCurrencies);
        $user = $this->user->readSingle(['ID' => $ID]);
        foreach ($activeCurrencies as $currency)
            $wallets[] = $this->genWallet($currency, $user->{$currency . 'Balance'}, (bool) $user->{$currency . 'Address'});

        return $wallets;
    }

    private function genWallet($ID, $balance, $addressIsSet)
    {
        $title = strtoupper($ID);
        return compact('ID', 'title', 'balance', 'addressIsSet');
    }
}
