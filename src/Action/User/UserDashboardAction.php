<?php

namespace App\Action\User;

use App\Domain\User\Service\User;
use App\Domain\Deposits\Service\Deposits;
use App\Domain\Withdrawals\Service\Withdrawals;
use App\Domain\Referrals\Service\Referrals;
use App\Domain\TrailLog\Service\TrailLog;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class UserDashboardAction
{
    protected $user;
    protected $deposits;
    protected $withdrawals;
    protected $referrals;
    protected $trailLog;

    public function __construct(
        User $user,
        Deposits $deposits,
        Withdrawals $withdrawals,
        Referrals $referrals,
        TrailLog $trailLog
    ) {
        $this->user = $user;
        $this->deposits = $deposits;
        $this->withdrawals = $withdrawals;
        $this->referrals = $referrals;
        $this->trailLog = $trailLog;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {

        $ID = $request->getAttribute('token')['data']->ID;

        $data['user_name'] = "";
        $data['full_name'] = "";
        $data['registration_date'] = "";
        $data['account_balance'] = [];
        $data['activeCurrencies'] = $GLOBALS['activeCurrencies'];
        $data['total_balance'] = 0;
        $data['total_deposit'] = 0;
        $data['active_deposit'] = 0;
        $data['total_earning'] = 0;
        $data['total_withdrawal'] = 0;
        $data['pending_withdrawal'] = 0;
        $data['total_bonus'] = 0;
        $data['total_penalty'] = 0;
        $data['referral'] = 0;
        $data['referral_commission'] = 0;

        // users
        $user = $this->user->readSingle(['ID' => $ID]);

        // deposits
        $d = $this->deposits->readAll([
            'params' => ['where' => ['userID' => $ID, 'depositStatus' => 'approved']],
            'select' => ['depositStatus as status'],
            'select_raw' => ['SUM(amount) as amount'],
            'group_by' => 'status',
            'order_by' => 'status'
        ]);

        $data['active_deposit'] = (float) $d[0]->amount;

        // withdrawals
        $w = $this->withdrawals->readAll([
            'params' => ['where' => ['userID' => $ID, 'withdrawalStatus' => 'pending']],
            'select' => ['withdrawalStatus as status'],
            'select_raw' => ['SUM(amount) as amount'],
            'group_by' => 'status',
            'order_by' => 'status'
        ]);

        $data['pending_withdrawal'] = (float) $w[0]->amount;

        // referrals
        $referrals = $this->referrals->readAll([
            'params' => ['where' => ['referralUserID' => $ID]],
            'select' => ['referralUserID'],
            'select_raw' => ['COUNT(*) as total', 'SUM(referralBonus) as amount'],
            'group_by' => 'referralUserID',
            'order_by' => 'referralUserID'
        ]);

        if (!empty($referrals)) {
            $data['referral'] = (float) $referrals[0]->total;
            $data['referral_commission'] = (int) $referrals[0]->amount;
        }

        // transactions
        $d = $this->trailLog->readAll([
            'params' => ['where' => ['userID' => $ID]],
            'select' => ['logType as type'],
            'select_raw' => ['SUM(amount) as amount'],
            'group_by' => ['type'],
            'order_by' => 'type'
        ]);

        foreach ($d as $dd) {

            if ($dd->type == 'bonus') $data['total_bonus'] = (float) $dd->amount;
            if ($dd->type == 'deposit') $data['total_deposit'] = (float) $dd->amount;
            if ($dd->type == 'withdrawal') $data['total_withdrawal'] = (float) $dd->amount;
            if ($dd->type == 'penalty') $data['total_penalty'] = (float) $dd->amount;
            if ($dd->type == 'referral') $data['total_referral'] = (float) $dd->amount;
            if ($dd->type == 'deposit-earning') $data['total_earning'] = (float) $dd->amount;
        }

        // aggregate from user
        $data['user_name'] = $user->userName;
        $data['full_name'] = $user->fullName;
        $data['registration_date'] = $user->createdAt;

        // fetch the wallet balances
        foreach ($GLOBALS['activeCurrencies'] as $c) {
            $data['account_balance'][$c] = $user->{$c . 'Balance'};
            $data['total_balance'] += $user->{$c . 'Balance'};
        }

        $response->getBody()->write(json_encode([
            'success' => true,
            'data' => $data
        ]));

        return $response;
    }
}
