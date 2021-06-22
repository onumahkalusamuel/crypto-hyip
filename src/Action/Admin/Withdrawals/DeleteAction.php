<?php

namespace App\Action\Withdrawals;

use App\Domain\Withdrawals\Service\Withdrawals;
use App\Helpers\ApiRequest;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class DeleteAction
{
    private $withdrawals;

    public function __construct(Withdrawals $withdrawals)
    {
        $this->withdrawals = $withdrawals;
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

            // verify the withdrawal is deletable
            $fetch = $apiRequest->get('withdrawals/' . $params['userID'] . '/' . $params['ID'])->withdrawals;
            // $response->getBody()->write((string)json_encode($fetch));
            // return $response;

            if (
                !empty($fetch) &&
                ($fetch[0]->withdrawalStatus == 'pending') &&
                $this->withdrawals->delete(['ID' => $params['ID']])
            ) {

                $response->getBody()->write((string)json_encode(['message' => 'Withdrawal request deleted.']));
            } else {
                \http_response_code(400);
                $response->getBody()->write((string)json_encode(['' => '', 'message' => 'Withdrawal request already approved or not found.']));
            }
        } else {

            \http_response_code(400);
        }

        return $response;
    }
}
