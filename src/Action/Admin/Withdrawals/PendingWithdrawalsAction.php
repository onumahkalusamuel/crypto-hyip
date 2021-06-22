<?php

namespace App\Action\Withdrawals;

use App\Domain\Withdrawals\Service\Withdrawals;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class PendingWithdrawalsAction
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
        // Collect args
        if ($args['user_id']) $params['userID'] = $args['user_id'];

        $auth = $request->getAttribute("token")['data'];

        if ($auth->userType !== "admin") {
            $params['userID'] = $auth->ID;
        }

        $params['withdrawalStatus'] = "pending";

        // Invoke the Domain with inputs and retain the result
        $deposit = $this->withdrawals->read($params);
        // Transform the result into the JSON representation
        // Build the HTTP response

        $response->getBody()->write(json_encode($deposit));

        return $response;
    }
}
