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

final class SingleView
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

        if ($ID === 'new') {
            $user = new \stdClass;
            $user->ID = "new";
            $data['user'] = $user;
            $data['deposits'] = [];
            $data['withdrawals'] = [];
            $data['transactions'] = [];
            $data['referrals'] = [];
            $data['activeCurrencies'] = [];
        } else {

            // find the user
            $user = $this->user->readSingle(['ID' => $ID]);
            $user->password = null;

            //set the user to output
            $data['user'] = $user;

            // deposits
            $data['deposits'] = $this->deposits->readAll([
                'params' => ['where' => ['userID' => $ID]],
                'select' => ['cryptoCurrency as currency', 'depositStatus as status'],
                'select_raw' => ['COUNT(*) as total', 'SUM(amount) as amount'],
                'group_by' => ['currency', 'status']
            ]);

            // withdrawals 
            $data['withdrawals'] = $this->withdrawals->readAll([
                'params' => ['where' => ['userID' => $ID]],
                'select' => ['cryptoCurrency as currency', 'withdrawalStatus as status'],
                'select_raw' => ['COUNT(*) as total', 'SUM(amount) as amount'],
                'group_by' => ['currency', 'status']
            ]);

            // referrals 
            $referrals = $this->referrals->readAll([
                'params' => ['where' => ['referralUserID' => $ID]],
                'select' => ['ID'],
                'select_raw' => ['COUNT(*) as total', 'SUM(referralBonus) as amount']
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
                'group_by' => ['type', 'currency']
            ]);

            // penalties
            $data['penalties'] = $this->trailLog->readAll([
                'params' => ['where' => ['userID' => $ID, 'logType' => 'penalty']],
                'select' => ['logType as type', 'cryptoCurrency as currency'],
                'select_raw' => ['COUNT(*) as total', 'SUM(amount) as amount'],
                'group_by' => ['type', 'currency']
            ]);

            // transactions
            $data['transactions'] = $this->trailLog->readAll([
                'params' => ['where' => ['userID' => $ID]],
                'select' => ['logType as type', 'cryptoCurrency as currency'],
                'select_raw' => ['COUNT(*) as total', 'SUM(amount) as amount'],
                'group_by' => ['type', 'currency']
            ]);

            $data['activeCurrencies'] = explode(',', $this->settings->activeCurrencies);
        }

	$this->view->assign('data', $data);
        $this->view->display('admin/view-user-profile.tpl');

        return $response;
    }
}
