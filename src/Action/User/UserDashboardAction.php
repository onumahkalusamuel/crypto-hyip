<?php

namespace App\Action\User;

use App\Domain\User\Service\User;
use App\Domain\Deposits\Service\Deposits;
use App\Domain\TrailLog\Service\TrailLog;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Slim\Views\PhpRenderer as View;

final class UserDashboardAction
{
    protected $user;
    protected $session;
    protected $deposits;
    protected $trailLog;
    protected $view;

    public function __construct(
        Session $session,
        User $user,
        Deposits $deposits,
        TrailLog $trailLog,
        View $view
    ) {
        $this->user = $user;
        $this->session = $session;
        $this->deposits = $deposits;
        $this->trailLog = $trailLog;
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
        $deposits = $this->deposits->readAll(['params' => ['userId' => $ID]]);
        // trx 
        $trailLog = $this->trailLog->readAll([]);
        $trx = $this->processTrx($trailLog);

        // Build the HTTP response
        unset($user->password);

        $user->accountBalance = "";
        $user->earnedTotal = "";
        $user->pendingWithdrawal = "";

        $return['userInfo'] = $user;
        $return['overview'] = [
            [
                'title' => 'Active Deposit',
                'body' => $this->getActiveDeposit($deposits)
            ],
            [
                'title' => 'Total Deposits',
                'body' => $trx['deposits']
            ],
            [
                'title' => 'Total Withdrawals',
                'body' => $trx['withdrawals']
            ]
        ];

        $data = $return;

        return $this->view->render($response, 'user/dashboard.php', ['data'=>$data]);

    }

    public function getActiveDeposit(array $deposits): float
    {
        $return = 0;
        if (!empty($deposits)) {
            foreach ($deposits as $d) {
                if ($d->isActive && $d->depositStatus == "approved") $return += $d->amount;
            }
        }
        return (float) number_format($return, 2);
    }
    public function processTrx(array $trx): array
    {
        $return['withdrawals']  = 0;
        $return['deposits']  = 0;

        foreach ($trx as $t) {
            if ($t->logType == "withdrawal")  $return['withdrawals'] += $t->amount;
            if ($t->logType == "deposit")  $return['deposits'] += $t->amount;
        }

        return $return;
    }
}
