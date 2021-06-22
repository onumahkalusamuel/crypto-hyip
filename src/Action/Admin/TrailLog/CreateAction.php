<?php

namespace App\Action\TrailLog;

use App\Domain\TrailLog\Service\TrailLog;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class CreateAction
{
    private $trailLog;

    public function __construct(TrailLog $trailLog)
    {
        $this->trailLog = $trailLog;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        // Collect input from the HTTP request
        $data = (array)$request->getParsedBody();

        if (empty($data['userID']) || empty($data['userName']) || empty($data['transactionDetails'])) {
            \http_response_code(400);
            return $response;
        }
        // Invoke the Domain with inputs and retain the result
        $logId = $this->trailLog->create($data);

        // Transform the result into the JSON representation
        $result = [
            'log_id' => $logId
        ];

        // Build the HTTP response
        $response->getBody()->write((string)json_encode($result));

        return $response;
    }
}
