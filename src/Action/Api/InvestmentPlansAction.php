<?php

namespace App\Action\Api;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use App\Domain\Plans\Service\Plans;

class InvestmentPlansAction
{
    protected $plans;

    public function __construct(Plans $plans)
    {
        $this->plans = $plans;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ) {
        $plans = $this->plans->readAll([]);
        $response->getBody()->write(json_encode($plans));
        return $response;
    }
}
