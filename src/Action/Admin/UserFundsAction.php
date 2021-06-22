<?php

namespace App\Action\Admin;

use App\Domain\User\Service\User;
use App\Helpers\ApiRequest;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class UserFundsAction
{

    private $trx;
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

        if (empty($args['id'])) {
            return $response;
        }

        if ($auth->userType != "admin") {
            $args['id'] = $auth->ID;
        }

        // deposits
        $this->processDeposits($apiRequest->get("deposits/" . $args['id'])->deposits);
        // withdrawals 
        $this->processWithdrawals($apiRequest->get("withdrawals/" . $args['id'])->withdrawals);
        // referrals 
        $this->processReferrals($apiRequest->get("referrals/" . $args['id'])->referrals);

        // transactions
        $this->processTransactions($apiRequest->get("traillog/?userID=" . $args['id'])->traillog);

        $user = $this->user->readUser($args['id']);
        unset($user['password']);

        $return['userdetails'] = $user;

        $return['userfunds'] = [
            'totalDeposit' => $this->trx['totalDeposit'],
            'activeDeposit' => $this->trx['activeDeposit'],
            'totalEarning' => $this->trx['totalEarning'],
            'totalWithdrawal' => $this->trx['totalWithdrawal'],
            'pendingWithdrawal' => $this->trx['pendingWithdrawal'],
            'totalReferrals' => $this->trx['totalReferrals'],
            'totalBonus' => $this->trx['totalBonus'],
            'totalPenalty' => $this->trx['totalPenalty'],
            'referralCommissions' => $this->trx['referralCommissions']
        ];

        $response->getBody()->write(json_encode($return));

        return $response;
    }

    public function processTransactions(array $trx): void
    {
        $this->trx['totalDeposit'] = 0;
        $this->trx['totalEarning'] = 0;
        $this->trx['totalWithdrawal'] = 0;
        $this->trx['totalBonus'] = 0;
        $this->trx['totalPenalty'] = 0;
        $this->trx['referralCommissions'] = 0;

        if (!empty($trx)) {
            foreach ($trx as $t) {
                if ($t->logType == "deposit") $this->trx['totalDeposit'] += $t->amount;
                if ($t->logType == "earning") $this->trx['totalEarning'] += $t->amount;
                if ($t->logType == "withdrawal") $this->trx['totalWithdrawal'] += $t->amount;
                if ($t->logType == "bonus") $this->trx['totalBonus'] += $t->amount;
                if ($t->logType == "penalty") $this->trx['totalPenalty'] += $t->amount;
                if ($t->logType == "referral") $this->trx['referralCommissions'] += $t->amount;
            }
        }
    }

    public function processDeposits(array $deposits): void
    {
        $this->trx['activeDeposit'] = 0;
        foreach ($deposits as $d) {
            // active deposits
            if ($d->isActive && $d->depositStatus == "approved" && empty($d->interestPaid)) {
                $this->trx['activeDeposit'] += $d->amount;
            }
        }
    }

    public function processWithdrawals(array $withdrawals): void
    {
        $this->trx['pendingWithdrawal'] = 0;

        foreach ($withdrawals as $w) {
            // pending
            if ($w->withdrawalStatus == "pending") {
                $this->trx['pendingWithdrawal'] += $w->amount;
            }
        }
    }

    public function processReferrals(array $referrals): void
    {
        $this->trx['totalReferrals'] = 0;

        foreach ($referrals as $r) {
            // total withdrawal
            $this->trx['totalReferrals']++;
        }
    }
}
