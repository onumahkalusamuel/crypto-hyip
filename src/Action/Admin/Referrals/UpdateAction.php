<?php

namespace App\Action\Referrals;

use App\Domain\Referrals\Service\Referrals;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

final class UpdateAction
{
    private $referrals;

    public function __construct(Referrals $referrals)
    {
        $this->referrals = $referrals;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $data = (array)$request->getParsedBody();

        if (!empty($args['id']) && !empty($data)) {
            if ($this->referrals->update($args['id'], $data)) {
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
