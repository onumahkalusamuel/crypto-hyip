<?php

namespace App\Action\Deposits;

use App\Domain\Deposits\Service\Deposits;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

final class UpdateAction
{
    private $deposits;

    public function __construct(Deposits $deposits)
    {
        $this->deposits = $deposits;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $data = (array)$request->getParsedBody();

        if (!empty($args['id']) && !empty($data)) {
            if ($this->deposits->updateDeposit($args['id'], $data)) {
                $response->getBody()->write(json_encode(['message' => 'Deposit updated successfully.']));
            } else {
                \http_response_code(404);
            }
            return $response;
        }

        \http_response_code(400);
        return $response;
    }
}
