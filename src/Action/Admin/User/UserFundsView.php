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
    public $activeCurrencies;

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
        $this->activeCurrencies = explode(',', $this->settings->activeCurrencies);
        $this->view = $view;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
    ): ResponseInterface {

        $ID = $args['id'];

        if ($ID === 'new') {
            $user = new \stdClass;
            $user->ID = "new";
            $data['user'] = $user;
            $data['deposits'] = [];
            $data['withdrawals'] = [];
            $data['transactions'] = [];
            $data['referrals'] = [];
            $data['activeCurrencies'] = $this->activeCurrencies;
        } else {




            $data['total_balance'] = '';
            $data['Total Deposit'] = 0;
            $data['Active Deposit']=0;
            $data['Total Earning']=	0;
            $data['Total Withdrawal'] = 0;
            $data['Pending Withdrawals'] = 0.00;
            $data['Total Bonus']= 0;
            $data['Total Penalty']= 0;
            $data['Referrals'] =0;
            $data['Referral Commissions'] = 0;


            // deposits
            $data['deposits'] = $this->deposits->readAll([
                'params' => ['where' => ['userID' => $ID]],
                'select' => ['cryptoCurrency as currency', 'depositStatus as status'],
                'select_raw' => ['COUNT(*) as total', 'SUM(amount) as amount'],
                'group_by' => ['currency', 'status'],
                'order_by' => 'currency'
            ]);

            // withdrawals 
            $data['withdrawals'] = $this->withdrawals->readAll([
                'params' => ['where' => ['userID' => $ID]],
                'select' => ['cryptoCurrency as currency', 'withdrawalStatus as status'],
                'select_raw' => ['COUNT(*) as total', 'SUM(amount) as amount'],
                'group_by' => ['currency', 'status'],
                'order_by' => 'currency'
            ]);

            // referrals 
            $referrals = $this->referrals->readAll([
                'params' => ['where' => ['referralUserID' => $ID]],
                'select' => ['referralUserID'],
                'select_raw' => ['COUNT(*) as total', 'SUM(referralBonus) as amount'],
                'group_by' => 'referralUserID',
                'order_by' => 'referralUserID'
            ]);

            $data['referrals'] = [];
            if (!empty($referrals)) $data['referrals'] = [
                'total' => $referrals[0]->total,
                'amount' => $referrals[0]->amount,

            ];

            // bonuses
            $data['bonuses'] = $this->trailLog->readAll([
                'params' => ['where' => ['userID' => $ID, 'logType' => 'bonus']],
                'select' => ['logType as type', 'cryptoCurrency as currency'],
                'select_raw' => ['COUNT(*) as total', 'SUM(amount) as amount'],
                'group_by' => ['type', 'currency'],
                'order_by' => 'type'
            ]);

            // penalties
            $data['penalties'] = $this->trailLog->readAll([
                'params' => ['where' => ['userID' => $ID, 'logType' => 'penalty']],
                'select' => ['logType as type', 'cryptoCurrency as currency'],
                'select_raw' => ['COUNT(*) as total', 'SUM(amount) as amount'],
                'group_by' => ['type', 'currency'],
                'order_by' => 'currency'
            ]);

            // transactions
            $data['transactions'] = $this->trailLog->readAll([
                'params' => ['where' => ['userID' => $ID]],
                'select' => ['logType as type', 'cryptoCurrency as currency'],
                'select_raw' => ['COUNT(*) as total', 'SUM(amount) as amount'],
                'group_by' => ['type', 'currency'],
                'order_by' => 'currency'
            ]);

            // active currencieis
            $data['activeCurrencies'] = $this->activeCurrencies;

            // find the user
            $user = $this->user->readSingle(['ID' => $ID]);

            $data['user']['userName'] = $user->userName;
            $data['user']['fullName'] = $user->fullName;
            $data['user']['email'] = $user->email;

            // fetch the wallet addresses
            foreach ($this->activeCurrencies as $c) {
                $data['user'][$c . 'Address'] = $user->{$c . 'Address'};
                $data['user'][$c . 'Balance'] = $user->{$c . 'Balance'};
            }
        }

        $this->view->assign('data', $data);
        $this->view->display('admin/view-user-profile.tpl');

        return $response;
    }
}
