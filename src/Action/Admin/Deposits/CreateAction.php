<?php

namespace App\Action\Deposits;

use App\Domain\Deposits\Service\Deposits;
use App\Helpers\ApiRequest;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class CreateAction
{
    private $deposits;
    private $btcURL = "https://blockchain.info/tobtc?currency=USD&value=%s";

    public function __construct(Deposits $deposits)
    {
        $this->deposits = $deposits;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        // Collect input from the HTTP request
        $data = (array)$request->getParsedBody();
        $auth = $request->getAttribute("token")['data'];
        $apiRequest = new ApiRequest('');

        if ($auth->userType != "admin") {
            $data['userID'] = $auth->ID;
            $data['userName'] = $auth->userName;
        } else {
            if (empty($data['userID']) || empty($data['userName'])) {
                \http_response_code(400);
                $response->getBody()->write(json_encode([
                    'success' => false,
                    'message' => 'Please specify the user you want to create deposit for.'
                ]));
                return $response;
            }
        }
        // $response->getBody()->write(json_encode($data));
        // return $response;
        $data['transactionID'] = strtoupper(uniqid());

        // send to api (coming soon)

        // get btc amount 
        $data['btcAmount'] = $apiRequest->getUrl(sprintf($this->btcURL, $data['amount']));

        // Invoke the Domain with inputs and retain the result
        $depositId = $this->deposits->createDeposit($data);

        // Transform the result into the JSON representation
        $result = [
            'deposit_id' => $depositId
        ];

        // Build the HTTP response
        $response->getBody()->write((string)json_encode($result));
        http_response_code(201);
        return $response;
    }
}
