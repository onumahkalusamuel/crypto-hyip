<?php

namespace App\Action\Deposits;

use App\Domain\Deposits\Service\Deposits;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ReadAction
{
    private $deposits;

    public function __construct(Deposits $deposits)
    {
        $this->deposits = $deposits;
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
        $deposit = $this->deposits->readDeposit($params);
        // Transform the result into the JSON representation
        // Build the HTTP response
        \http_response_code(empty($deposit) ? 404 : 200);
        $response->getBody()->write(json_encode($deposit));

        return $response;
    }
}
