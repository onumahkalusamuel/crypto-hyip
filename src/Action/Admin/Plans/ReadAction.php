<?php

namespace App\Action\Plans;

use App\Domain\Plans\Service\Plans;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ReadAction
{
    private $plans;

    public function __construct(Plans $plans)
    {
        $this->plans = $plans;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
    ): ResponseInterface {
        // Collect args
        if ($args['id']) $params['ID'] = $args['id'];

        // Invoke the Domain with inputs and retain the result
        $plans = $this->plans->read($params);

        // Transform the result into the JSON representation
        // Build the HTTP response
        $response->getBody()->write(json_encode($plans));

        return $response;
    }
}
