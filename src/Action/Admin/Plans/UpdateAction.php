<?php

namespace App\Action\Plans;

use App\Domain\Plans\Service\Plans;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

final class UpdateAction
{
    private $plans;

    public function __construct(Plans $plans)
    {
        $this->plans = $plans;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $auth = $request->getAttribute("token")['data'];
        $data = (array)$request->getParsedBody();

        if ($auth->userType != "admin") {
            \http_response_code(403);
            return $response;
        }

        if (!empty($args['id']) && empty($data['ID'])) {
            $data['ID'] = $args['id'];
        }

        if (!$this->plans->update($data['ID'], $data)) {
            $response->getBody()->write(json_encode(['success' => false, 'message' => 'unable to update Plan at the moment.']));
            http_response_code(400);
        } else {
            $response->getBody()->write(json_encode(['success' => true]));
        }

        return $response;
    }
}
