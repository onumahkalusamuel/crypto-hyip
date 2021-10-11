<?php

namespace App\Action\Admin;

use App\Domain\User\Service\User;
use App\Domain\Plans\Service\Plans;
use App\Domain\Deposits\Service\Deposits;
use App\Domain\Withdrawals\Service\Withdrawals;
use App\Domain\Referrals\Service\Referrals;
use App\Domain\TrailLog\Service\TrailLog;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Smarty;

final class DashboardAction
{

    private $plans;
    private $user;
    private $deposits;
    private $referrals;
    private $withdrawals;
    private $trailLog;
    protected $smarty;

    public function __construct(
        User $user,
        Plans $plans,
        Deposits $deposits,
        Referrals $referrals,
        Withdrawals $withdrawals,
        TrailLog $trailLog,
        Smarty $smarty
    ) {
        $this->user = $user;
        $this->plans = $plans;
        $this->deposits = $deposits;
        $this->referrals = $referrals;
        $this->withdrawals = $withdrawals;
        $this->trailLog = $trailLog;
        $this->smarty = $smarty;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {

        // users
        $users = $this->user->readAll([
            'params' => ['where' => ['userType' => 'user']],
            'select' => ['isActive'],
            'select_raw' => ['COUNT(*) as total'],
            'group_by' => 'isActive',
            'order_by' => 'isActive'
        ]);

        $return['users']['total'] = 0;
        $return['users']['active'] = 0;
        foreach ($users as $user) {
            if (!empty($user->isActive)) {
                $return['users']['active'] = $user->total;
            } else {
                $return['users']['blocked'] = $user->total;
            }
            $return['users']['total'] += $user->total;
        }

        // deposits
        $return['deposits'] = $this->deposits->readAll([
            'select' => ['cryptoCurrency as currency', 'depositStatus as status'],
            'select_raw' => ['COUNT(*) as total', 'SUM(amount) as amount'],
            'group_by' => ['currency', 'status'],
            'order_by' => 'currency'
        ]);

        // withdrawals
        $return['withdrawals'] = $this->withdrawals->readAll([
            'select' => ['cryptoCurrency as currency', 'withdrawalStatus as status'],
            'select_raw' => ['COUNT(*) as total', 'SUM(amount) as amount'],
            'group_by' => ['currency', 'status'],
            'order_by' => 'currency'
        ]);

        // plans
        $plans = $this->plans->readAll([
            'select' => ['isActive'],
            'select_raw' => ['COUNT(*) as total'],
            'group_by' => 'isActive',
            'order_by' => 'isActive'
        ]);

        $return['plans'] = ['total' => $plans[0]->total];

        // referrals
        $referrals = $this->referrals->readAll([
            'select' => ['ID'],
            'select_raw' => ['COUNT(*) as total', 'SUM(referralBonus) as amount'],
            'group_by' => 'ID',
            'order_by' => 'ID'
        ]);

        $return['referrals'] = [];
        if (!empty($referrals)) $return['referrals'] = [
            'total' => $referrals[0]->total,
            'amount' => $referrals[0]->amount,

        ];

        // transactions
        $return['transactions'] = $this->trailLog->readAll([
            'select' => ['logType as type', 'cryptoCurrency as currency'],
            'select_raw' => ['COUNT(*) as total', 'SUM(amount) as amount'],
            'group_by' => ['type', 'currency'],
            'order_by' => 'currency'
        ]);

        $this->smarty->assign('data', $return);
        $this->smarty->display('admin/dashboard.tpl');

        return $response;
    }
}
