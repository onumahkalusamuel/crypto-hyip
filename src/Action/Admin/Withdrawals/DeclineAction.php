<?php

namespace App\Action\Withdrawals;

use App\Domain\Withdrawals\Service\Withdrawals;
use App\Helpers\ApiRequest;
use App\Helpers\SendMail;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

final class DeclineAction
{
    private $withdrawals;

    public function __construct(Withdrawals $withdrawals)
    {
        $this->withdrawals = $withdrawals;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        \http_response_code(400);

        $apiRequest = new ApiRequest($request->getHeader('Authorization'));

        $data = (array) $request->getParsedBody();

        $ID = $args['id'];

        $withdrawal = $this->withdrawals->read(['ID' => $ID])['withdrawals'][0];

        if ($withdrawal->withdrawalStatus != "pending") {
            $response->getBody()->write(json_encode([
                'success' => false,
                'message' => 'Withdrawal seems to have been declined or approved previously.'
            ]));
            return $response;
        }

        // update withdrawal table
        $update = $this->withdrawals->update($ID, [
            'messageFromAdmin' => $data['messageFromAdmin'],
            'withdrawalStatus' => 'declined'
        ]);

        if (!$update) {
            $response->getBody()->write(json_encode([
                'success' => false,
                'message' => 'Unable to decline withdrawal at the moment.'
            ]));
            return $response;
        }

        $user = $apiRequest->get("users/" . $withdrawal->userID);

        // send mail

        $mail = new SendMail();
        $mail->sendWithdrawalDeclinedEmail(
            $user->email,
            $user->fullName,
            $user->userName,
            $data['messageFromAdmin']
        );

        $response->getBody()->write(json_encode(['message' => 'Withdrawal declined successfully.']));
        \http_response_code(200);

        return $response;
    }
}
