<?php

namespace App\Action\Deposits;

use App\Domain\Deposits\Service\Deposits;
use App\Helpers\ApiRequest;
use App\Helpers\SendMail;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

final class ReleaseDepositAction
{
    private $deposits;

    public function __construct(Deposits $deposits)
    {
        $this->deposits = $deposits;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $auth = $request->getAttribute('token')['data'];
        $apiRequest = new ApiRequest('internalOverride');

        if (empty($args['id'])) {
            \http_response_code(400);
            return $response;
        }

        if ($auth->userType != "admin") {
            \http_response_code(403);
            return $response;
        }

        $dep = $this->deposits->readDeposit(['ID' => $args['id']])['deposits'][0];

        if (empty($dep)) {
            \http_response_code(404);
            return $response;
        }

        // get user
        $user = $apiRequest->get('/users/' . $dep->userID);

        if (empty($user)) {
            \http_response_code(404);
            return $response;
        }

        if ($dep->depositStatus != "approved") {\http_response_code(400); return $response;}

        // subtract money from deposit balance, add it to interest wallet balance
        $update = $apiRequest->put('/users/' . $user->ID, [
            'interestWalletBalance' => $user->interestWalletBalance + $dep->amount,
            'depositWalletBalance' => $user->depositWalletBalance - $dep->amount,
        ]);

        if (!$update) {
            $response->getBody()->write(json_encode(['success' => false, 'message' => 'Unable to release deposit at the moment.']));
            \http_response_code(400);
            return $response;
        }

        // delete 
        $delete = $this->deposits->deleteDeposit(['ID' => $dep->ID]);

        if (!$delete) {
            $response->getBody()->write(json_encode(['success' => false, 'message' => 'Unable to release deposit at the moment.']));
            \http_response_code(400);
            return $response;
        }

        $mail = new SendMail();
        $mail->sendDepositReleaseEmail(
            $user->email,
            $user->fullName,
            $user->userName,
            $dep->amount
        );

        // then log it
        $apiRequest->post('traillog/', [
            'userID' => $dep->userID,
            'userName' => $dep->userName,
            'logType' => 'earning',
            'transactionDetails' => "Deposit amount \${$dep->amount} released",
            'transactionAdminID' => $request->getAttribute('token')['data']->ID,
            'amount' => $dep->amount,
        ]);

        $response->getBody()->write(json_encode(['message' => 'Deposit released successfully.']));

        return $response;
    }
}
