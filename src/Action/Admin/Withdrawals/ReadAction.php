<?php

namespace App\Action\Withdrawals;

use App\Domain\Withdrawals\Service\Withdrawals;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ReadAction
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
        if ($args['id']) $params['ID'] = $args['id'];
        if ($args['user_id']) $params['userID'] = $args['user_id'];

        $auth = $request->getAttribute("token")['data'];

        if ($auth->userType !== "admin") {
            $params['userID'] = $auth->ID;
        }

        // Invoke the Domain with inputs and retain the result
        $withdrawals = $this->withdrawals->read($params);
        // Transform the result into the JSON representation
        // Build the HTTP response
        \http_response_code(empty($withdrawals) ? 404 : 200);
        $response->getBody()->write(json_encode($withdrawals));

        return $response;
    }
}
