<?php

namespace App\Action\Deposits;

use App\Domain\Deposits\Service\Deposits;
use App\Helpers\ApiRequest;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class DeleteAction
{
    private $deposits;

    public function __construct(Deposits $deposits)
    {
        $this->deposits = $deposits;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $auth = $request->getAttribute("token")['data'];
        $apiRequest = new ApiRequest($request->getHeader('Authorization'));

        if (!empty($args['id'])) {

            $params['ID'] = $args['id'];

            if ($auth->userType != "admin") {

                $args['user_id'] = $auth->ID;
            }

            $params['userID'] = $args['user_id'];

            // verify the deposit is deletable
            $fetch = $apiRequest->get('deposits/' . $params['userID'] . '/' . $params['ID'])->deposits;
            // $response->getBody()->write((string)json_encode($fetch));
            // return $response;

            if (
                !empty($fetch) &&
                ($fetch[0]->depositStatus == 'pending') &&
                $this->deposits->deleteDeposit(['ID' => $params['ID']])
            ) {
                $response->getBody()->write((string)json_encode(['message' => 'Deposit deleted.']));
            } else {

                \http_response_code(404);
            }
        } else {

            \http_response_code(400);
        }

        return $response;
    }
}
