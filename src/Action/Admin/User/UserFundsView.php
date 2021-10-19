<?php

namespace App\Action\Admin\User;

use App\Domain\User\Service\User;
use App\Domain\Deposits\Service\Deposits;
use App\Domain\Withdrawals\Service\Withdrawals;
use App\Domain\Referrals\Service\Referrals;
use App\Domain\TrailLog\Service\TrailLog;
use App\Domain\Settings\Service\Settings;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Smarty as View;

final class UserFundsView
{
    private $user;
    private $deposits;
    private $referrals;
    private $withdrawals;
    private $trailLog;
    private $settings;
    protected $view;

    public function __construct(
        User $user,
        Deposits $deposits,
        Referrals $referrals,
        Withdrawals $withdrawals,
        TrailLog $trailLog,
        Settings $settings,
        View $view
    ) {
        $this->user = $user;
        $this->deposits = $deposits;
        $this->referrals = $referrals;
        $this->withdrawals = $withdrawals;
        $this->trailLog = $trailLog;
        $this->settings = $settings;
        $this->view = $view;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
    ): ResponseInterface {

        $ID = $args['id'];

        $data = [];

        if ($ID === 'new') $data['user']['ID'] = "new";

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

        if ($ID !== 'new') {

            // deposits
            $d = $this->deposits->readAll([
                'params' => ['where' => ['userID' => $ID, 'depositStatus' => 'approved']],
                'select' => ['depositStatus as status'],
                'select_raw' => ['SUM(amount) as amount'],
                'group_by' => 'status',
                'order_by' => 'status'
            ]);

            $data['active_deposit'] = $d[0]->amount;


            // withdrawals
            $w = $this->withdrawals->readAll([
                'params' => ['where' => ['userID' => $ID, 'withdrawalStatus' => 'pending']],
                'select' => ['withdrawalStatus as status'],
                'select_raw' => ['SUM(amount) as amount'],
                'group_by' => 'status',
                'order_by' => 'status'
            ]);

            $data['pending_withdrawal'] = $d[0]->amount;

            // referrals
            $referrals = $this->referrals->readAll([
                'params' => ['where' => ['referralUserID' => $ID]],
                'select' => ['referralUserID'],
                'select_raw' => ['COUNT(*) as total', 'SUM(referralBonus) as amount'],
                'group_by' => 'referralUserID',
                'order_by' => 'referralUserID'
            ]);

            if (!empty($referrals)) {
                $data['referral'] = $referrals[0]->total;
                $data['referral_commission'] = $referrals[0]->amount;
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

                if ($dd->type == 'bonus') $data['total_bonus'] = $dd->amount;
                if ($dd->type == 'deposit') $data['total_deposit'] = $dd->amount;
                if ($dd->type == 'withdrawal') $data['total_withdrawal'] = $dd->amount;
                if ($dd->type == 'penalty') $data['total_penalty'] = $dd->amount;
                if ($dd->type == 'referral') $data['total_referral'] = $dd->amount;
                if ($dd->type == 'deposit-earning') $data['total_earning'] = $dd->amount;
            }

            // find the user
            $user = $this->user->readSingle(['ID' => $ID]);

            $data['user']['ID'] = $user->ID;
            $data['user']['userName'] = $user->userName;
            $data['user']['fullName'] = $user->fullName;
            $data['user']['email'] = $user->email;

            // fetch the wallet addresses
            foreach ($GLOBALS['activeCurrencies'] as $c) {
                $data['user'][$c . 'Address'] = $user->{$c . 'Address'};
                $data['user'][$c . 'Balance'] = $user->{$c . 'Balance'};
                $data['total_balance'] += $user->{$c . 'Balance'};
            }

            // get upline
            $ref = $this->referrals->find([
                'params' => ['referredUserID' => $ID],
                'select' => ['referralUserID as ID', 'referralUserName as userName']
            ]);

            if (!empty($ref->ID)) {
                $data['user']['upline_id'] = $ref->ID;
                $data['user']['upline_username'] = $ref->userName;
            }
        }

        $this->view->assign('data', $data);
        $this->view->display('admin/view-user-profile.tpl');

        return $response;
    }
}
