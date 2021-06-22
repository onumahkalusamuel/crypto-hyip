<?php

namespace App\Action\User;

use App\Domain\Deposits\Service\Deposits;
use App\Domain\Referrals\Service\Referrals;
use App\Domain\TrailLog\Service\TrailLog;
use App\Domain\User\Service\User;
use App\Domain\Withdrawals\Service\Withdrawals;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class DeleteAction
{
    private $user;
    public function __construct(
        User $user,
        Deposits $deposits,
        TrailLog $traillog,
        Withdrawals $withdrawals,
        Referrals $referrals
    ) {
        $this->user = $user;
        $this->deposits = $deposits;
        $this->traillog = $traillog;
        $this->withdrawals = $withdrawals;
        $this->referrals = $referrals;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $auth = $request->getAttribute('token')['data'];

        if ($auth->userType != "admin") {
            \http_response_code(403);
            return $response;
        }

        if (!empty($args['id'])) {

            // delete user's records everywhere
            $this->deposits->deleteDeposit(['userID' => $args['id']]);
            $this->traillog->delete(['userID' => $args['id']]);
            $this->withdrawals->delete(['userID' => $args['id']]);
            $this->referrals->delete(['referralUserID' => $args['id']]);
            // then delete user
            if ($this->user->deleteUser($args['id'])) {
                $response->getBody()->write((string)json_encode(['message' => 'User deleted.']));
            } else {
                \http_response_code(404);
            }
        } else {
            \http_response_code(400);
        }

        return $response;
    }
}
