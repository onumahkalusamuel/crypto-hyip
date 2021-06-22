<?php

namespace App\Action\Admin;

use App\Domain\User\Service\User;
use App\Helpers\ApiRequest;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class DashboardAction
{

    private $plans;
    private $users;
    private $deposits;
    private $withdrawals;
    private $trx;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        // Collect args
        $auth = $request->getAttribute("token")['data'];
        $apiRequest = new ApiRequest($request->getHeader('Authorization'));

        if ($auth->userType != "admin") {
            \http_response_code(403);
            return $response;
        }
        // users
        $this->processUsers($apiRequest->get("users/")->users);
        // deposits
        $this->processDeposits($apiRequest->get("deposits/")->deposits);
        // withdrawals 
        $this->processWithdrawals($apiRequest->get("withdrawals/")->withdrawals);
        // plans 
        $this->processPlans($apiRequest->get("plans/")->plans);
        // referrals 
        $this->processReferrals($apiRequest->get("referrals/")->referrals);
        // transactions
        $this->processTransactions($apiRequest->get("traillog/")->traillog);

        $return['overview'] = [
            [
                'title' => 'Total Users',
                'body' => $this->users['totalCount'],
                'type' => 'count'
            ],
            [
                'title' => 'Active Users',
                'body' => $this->users['activeCount'],
                'type' => 'count'
            ],
            [
                'title' => 'Investment Plans',
                'body' => $this->plans['totalCount'],
                'type' => 'count'
            ],
            [
                'title' => 'Withdrawal Requests',
                'body' => $this->withdrawals['pendingAmount'],
                'type' => 'currency'
            ],
            [
                'title' => 'Withdrawals Paid Out',
                'body' => $this->trx['totalWithdrawal'],
                'type' => 'currency'
            ],
            [
                'title' => 'Total Earnings',
                'body' => $this->trx['totalEarning'],
                'type' => 'currency'
            ],
            [
                'title' => 'Active Deposits',
                'body' => $this->deposits['activeAmount'],
                'type' => 'currency'
            ],
            [
                'title' => 'Pending Deposits',
                'body' => $this->deposits['pendingAmount'],
                'type' => 'currency'
            ],
            [
                'title' => 'Total Deposits Amount',
                'body' => $this->trx['totalDeposit'],
                'type' => 'currency'

            ],
            [
                'title' => 'Total Referrals',
                'body' => $this->referrals['totalCount'],
                'type' => 'count'
            ],
            [
                'title' => 'Total Referral Commissions',
                'body' => $this->trx['referralCommissions'],
                'type' => 'currency'
            ],
        ];

        $response->getBody()->write(json_encode($return));

        return $response;
    }

    public function processUsers(array $users): void
    {
        $this->users['totalCount'] = 0;
        $this->users['activeCount'] = 0;
        if (!empty($users)) {
            foreach ($users as $u) {
                $this->users['totalCount']++;
                if ($u->isActive) $this->users['activeCount']++;
            }
        }
    }

    public function processDeposits(array $deposits): void
    {
        $this->deposits['pendingAmount'] = 0;
        $this->deposits['activeAmount'] = 0;
        if (!empty($deposits)) {
            foreach ($deposits as $d) {
                // active
                if ($d->depositStatus == "approved" && empty($d->interestPaid)) {
                    $this->deposits['activeAmount'] += $d->amount;
                }
                // pending
                if ($d->depositStatus == "pending") {
                    $this->deposits['pendingAmount'] += $d->amount;
                }
            }
        }
    }

    public function processWithdrawals(array $withdrawals): void
    {
        $this->withdrawals['pendingAmount'] = 0;

        foreach ($withdrawals as $w) {
            if ($w->withdrawalStatus == "pending") {
                $this->withdrawals['pendingAmount'] += $w->amount;
            }
        }
    }

    public function processPlans(array $plans): void
    {
        $this->plans['totalCount'] = count($plans);
    }

    public function processReferrals(array $referrals): void
    {
        $this->referrals['totalAmount'] = 0;
        $this->referrals['totalCount'] = 0;
        foreach ($referrals as $r) {
            $this->referrals['totalCount']++;
            $this->referrals['totalAmount'] += $r->amount;
        }
    }

    public function processTransactions(array $trx): void
    {
        $this->trx['totalDeposit'] = 0;
        $this->trx['totalEarning'] = 0;
        $this->trx['totalWithdrawal'] = 0;
        $this->trx['referralCommissions'] = 0;

        if (!empty($trx)) {
            foreach ($trx as $t) {
                if ($t->logType == "deposit") $this->trx['totalDeposit'] += $t->amount;
                if ($t->logType == "earning") $this->trx['totalEarning'] += $t->amount;
                if ($t->logType == "withdrawal") $this->trx['totalWithdrawal'] += $t->amount;
                if ($t->logType == "referral") $this->trx['referralCommissions'] += $t->amount;
            }
        }
    }
}
