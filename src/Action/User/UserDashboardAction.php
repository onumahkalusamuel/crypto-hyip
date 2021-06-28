<?php

namespace App\Action\User;

use App\Domain\User\Service\User;
use App\Domain\Deposits\Service\Deposits;
use App\Domain\Withdrawals\Service\Withdrawals;
use App\Domain\Referrals\Service\Referrals;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Slim\Views\PhpRenderer as View;

final class UserDashboardAction
{
    protected $user;
    protected $session;
    protected $deposits;
    protected $withdrawals;
    protected $referrals;
    protected $view;

    public function __construct(
        Session $session,
        User $user,
        Deposits $deposits,
        Withdrawals $withdrawals,
	Referrals $referrals,
        View $view
    ) {
        $this->user = $user;
        $this->session = $session;
        $this->deposits = $deposits;
        $this->withdrawals = $withdrawals;
	$this->referrals = $referrals;
        $this->view = $view;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {

        $ID = $this->session->get('ID');
        // users
        $user = $this->user->readSingle(['ID'=>$ID]);

        // deposits
       //'where' => ['userID' => $ID]

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


        // Build the HTTP response
        unset($user->password);
	unset($user->secretQuestion);
	unset($user->secretAnswer);

        $return['user'] = $user;

        return $this->view->render($response, 'user/dashboard.php', ['data'=>$return]);

    }

}
