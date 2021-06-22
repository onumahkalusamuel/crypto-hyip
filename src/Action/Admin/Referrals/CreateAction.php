<?php

namespace App\Action\Referrals;

use App\Domain\Referrals\Service\Referrals;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class CreateAction
{
    private $referrals;

    public function __construct(Referrals $referrals)
    {
        $this->referrals = $referrals;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {

        // Collect input from the HTTP request
        $data = (array)$request->getParsedBody();

        if (empty($data)) return $response;

        // Invoke the Domain with inputs and retain the result
        $referralId = $this->referrals->create($data);

        // Transform the result into the JSON representation
        $result = [
            'referral_id' => $referralId
        ];

        // Build the HTTP response
        $response->getBody()->write((string)json_encode($result));
        http_response_code(201);
        return $response;
    }
}
