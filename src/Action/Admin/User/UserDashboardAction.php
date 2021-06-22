<?php

namespace App\Action\User;

use App\Domain\User\Service\User;
use App\Helpers\ApiRequest;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class UserDashboardAction
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
    ): ResponseInterface {
        // Collect args
        $auth = $request->getAttribute("token")['data'];
        $apiRequest = new ApiRequest($request->getHeader('Authorization'));

        // users
        $user = $this->user->readUser($auth->ID);

        // deposits
        $deposits = $apiRequest->get("deposits/{$auth->ID}")->deposits;
        // trx 
        $trx = $this->processTrx($apiRequest->get("traillog/?userID={$auth->ID}")->traillog);

        // Build the HTTP response
        unset($user['password']);

        $user['registrationDate'] = date("d M, Y", strtotime($user['createdAt']));
        $user['lastLogin'] = date("d M, Y", strtotime($user['createdAt']));
        $user['accountBalance'] = "";
        $user['earnedTotal'] = "";
        $user['pendingWithdrawal'] = "";

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
        $response->getBody()->write(json_encode($return));

        return $response;
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
