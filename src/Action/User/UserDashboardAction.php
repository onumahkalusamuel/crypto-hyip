<?php

namespace App\Action\User;

use App\Domain\User\Service\User;
use App\Domain\Deposits\Service\Deposits;
use App\Domain\Withdrawals\Service\Withdrawals;
use App\Domain\Referrals\Service\Referrals;
use App\Domain\TrailLog\Service\TrailLog;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Smarty as View;

final class UserDashboardAction
{
    protected $user;
    protected $session;
    protected $deposits;
    protected $withdrawals;
    protected $referrals;
    protected $trailLog;
    protected $view;

    public function __construct(
        Session $session,
        User $user,
        Deposits $deposits,
        Withdrawals $withdrawals,
        Referrals $referrals,
        TrailLog $trailLog,
        View $view
    ) {
        $this->user = $user;
        $this->session = $session;
        $this->deposits = $deposits;
        $this->withdrawals = $withdrawals;
        $this->referrals = $referrals;
        $this->trailLog = $trailLog;
        $this->view = $view;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {

        $ID = $this->session->get('ID');
        // users
        $user = $this->user->readSingle(['ID' => $ID]);

        // deposits
        $return['deposits'] = $this->deposits->readAll([
            'params' => ['where' => ['userID' => $ID]],
            'select' => ['cryptoCurrency as currency', 'depositStatus as status'],
            'select_raw' => ['COUNT(*) as total', 'SUM(amount) as amount'],
            'group_by' => ['currency', 'status']
        ]);

        // withdrawals
        $return['withdrawals'] = $this->withdrawals->readAll([
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

        $return['referrals'] = [];
        if (!empty($referrals)) $return['referrals'] = [
            'total' => $referrals[0]->total,
            'amount' => $referrals[0]->amount
        ];

        // earnings
        // deposit earnings 
        $return['earnings'] = $this->trailLog->readAll([
            'params' => [
                'where' => ['userID' => $ID],
                'like' => ['logType' => 'bonus|earning|referral']
            ],
            'select' => ['ID', 'cryptoCurrency'],
            'select_raw' => ['SUM(ABS(amount)) as amount'],
            'group_by' => ['cryptoCurrency']
        ]);

        // Build the HTTP response
        unset($user->password);
        unset($user->secretQuestion);
        unset($user->secretAnswer);

        $return['user'] = $user;

        $this->view->assign('data', $return);
        $this->view->display('theme/user/dashboard.tpl');

        return $response;
    }
}
