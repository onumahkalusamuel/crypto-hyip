<?php

namespace App\Action\User;

use App\Domain\Withdrawals\Service\Withdrawals;
use App\Domain\User\Service\User;
use App\Domain\Settings\Service\Settings;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class WithdrawalsView
{
    protected $withdrawals;
    protected $user;
    protected $settings;

    public function __construct(
        Withdrawals $withdrawals,
        User $user,
        Settings $settings
    ) {
        $this->withdrawals = $withdrawals;
        $this->user = $user;
        $this->settings = $settings;
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

        $response->getBody()->write(json_encode([
            'success' => true,
            'data' => $data
        ]));

        return $response;
    }

    public function getAvailableWallets($ID): array
    {

        $wallets = [];
        $user = $this->user->readSingle(['ID' => $ID]);
        foreach ($GLOBALS['activeCurrencies'] as $currency)
            $wallets[] = $this->genWallet($currency, $user->{$currency . 'Balance'}, (bool) $user->{$currency . 'Address'});

        return $wallets;
    }

    private function genWallet($ID, $balance, $addressIsSet)
    {
        $title = strtoupper($ID);
        return compact('ID', 'title', 'balance', 'addressIsSet');
    }
}
