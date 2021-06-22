<?php

namespace App\Action\Referrals;

use App\Domain\Referrals\Service\Referrals;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ReadAction
{
    private $referrals;

    public function __construct(Referrals $referrals)
    {
        $this->referrals = $referrals;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
    ): ResponseInterface {
        // Collect args
        if ($args['id']) $params['ID'] = $args['id'];
        if ($args['user_id']) $params['referralUserID'] = $args['user_id'];
        if ($_GET['referredUserID']) $params['referredUserID'] = $_GET['referredUserID'];

        $auth = $request->getAttribute("token")['data'];

        if ($auth->userType !== "admin") {
            $params['referralUserID'] = $auth->ID;
        }

        // Invoke the Domain with inputs and retain the result
        $deposit = $this->referrals->read($params);
        // Transform the result into the JSON representation
        // Build the HTTP response
        \http_response_code(empty($deposit) ? 404 : 200);
        $response->getBody()->write(json_encode($deposit));

        return $response;
    }
}
