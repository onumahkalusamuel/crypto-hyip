<?php

namespace App\Action\Withdrawals;

use App\Domain\Withdrawals\Service\Withdrawals;
use App\Helpers\ApiRequest;
use App\Helpers\SendMail;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class CreateAction
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
        $apiRequest = new ApiRequest($request->getHeader('Authorization'));
        // Collect input from the HTTP request
        $data = (array)$request->getParsedBody();

        $auth = $request->getAttribute("token")['data'];

        if ($auth->userType !== "admin") {

            $data['userID'] = $auth->ID;
        }

        // userID is needed
        if (empty($data['userID'])) {
            \http_response_code(400);
            $response->getBody()->write(json_encode([
                'success' => false,
                'message' => 'User must be provided.'
            ]));
            return $response;
        }

        // amount is needed
        if (empty($data['amount'])) {
            \http_response_code(400);
            $response->getBody()->write(json_encode([
                'success' => false,
                'message' => 'Withdrawal amount is needed.'
            ]));
            return $response;
        }

        $user = $apiRequest->get("users/{$data['userID']}");
        // user needed
        if (empty($user)) {
            \http_response_code(400);
            return $response;
        }

        // interestWalletBalance needs to be smaller than amount
        if ($user->interestWalletBalance < $data['amount']) {
            \http_response_code(400);
            $response->getBody()->write(json_encode([
                'success' => false,
                'message' => "Insufficient funds. Wallet Balance: \$" . number_format($user->interestWalletBalance, 2)
            ]));
            return $response;
        }

        $data['userID'] = $user->ID;
        $data['userName'] = $user->userName;
        $data['bitcoinWalletAddress'] = $user->bitcoinWalletAddress;

        // Invoke the Domain with inputs and retain the result
        $withdrawal_id = $this->withdrawals->create($data);

        // send mail
        $mail = new SendMail();
        $mail->sendWithdrawalRequestEmail($user->email, $data['amount'], $user->fullName, $user->userName);

        // Transform the result into the JSON representation
        $result = [
            'withdrawal_id' => $withdrawal_id
        ];
        // Build the HTTP response
        $response->getBody()->write(json_encode($result));

        return $response;
    }
}
