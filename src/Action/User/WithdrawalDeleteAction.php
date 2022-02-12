<?php

namespace App\Action\User;

use App\Domain\Withdrawals\Service\Withdrawals;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class WithdrawalDeleteAction
{

    private $withdrawals;

    public function __construct(Withdrawals $withdrawals)
    {
        $this->withdrawals = $withdrawals;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
    ): ResponseInterface {

        $ID = $args['id'];
        $userID = $request->getAttribute('token')['data']->ID;

        $withdrawal = $this->withdrawals->readSingle(['ID' => $ID]);

        if ($withdrawal->withdrawalStatus === "pending" && $withdrawal->userID == $userID) {
            $delete = $this->withdrawals->delete(['ID' => $ID]);
        }

        if (!empty($delete)) {
            $message = "Withdrawal deleted successfully";
            $success = true;
        } else {
            $message = "Unable to delete record at the moment. Please try again later.";
            $success = false;
        }
        $response->getBody()->write(json_encode(compact('success', 'message')));
        return $response;
    }
}
