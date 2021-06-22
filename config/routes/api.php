<?php

use App\Middleware\JsonResponseMiddleware;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {

    // api routes
    $app->group('/api/', function (RouteCollectorProxy $group) {

        // cors
        $group->options('{routes:.+}', function ($req, $res, $args) {
            return $res;
        });

        // catch-all
        $group->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '{routes:.+}', function ($request, $response) {
            $response->getBody()->write(json_encode([
                'success' => false,
                'message' => 'The requested resource was not found.'
            ]));
            return $response->withStatus(404);
        });
    })->addMiddleware(new JsonResponseMiddleware);
};
