<?php

namespace App\Action\TrailLog;

use App\Domain\TrailLog\Service\TrailLog;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ReadAction
{
    private $trailLog;

    public function __construct(TrailLog $trailLog)
    {
        $this->trailLog = $trailLog;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
    ): ResponseInterface {
        // Collect args

        foreach ($_GET as $k => $v) $params[$k] = $v;

        $auth = $request->getAttribute("token")['data'];

        if (!empty($auth) && $auth->userType != "admin") {
            $params['userID'] = $auth->ID;
        }

        // Invoke the Domain with inputs and retain the result
        $res = $this->trailLog->read($params);
        // Transform the result into the JSON representation
        $response->getBody()->write(json_encode($res));

        return $response;
    }
}
