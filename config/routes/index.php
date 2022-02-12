<?php

use Psr\Http\Message\ResponseInterface;
use Slim\App;

return function (App $app) {
    // get admin
    (require __DIR__ . '/admin.php')($app);
    // get api
    (require __DIR__ . '/api.php')($app);

    // login mainly admin login
    $app->get('/admin-login', \App\Action\Admin\LoginAction::class)->setName('login');


    // catchall - for 404 - Not Found
    $app->map(['GET', 'POST', 'PUT', 'DELETE'], '{routes:.+}', function ($request, ResponseInterface $response) {
        $response->getBody()->write('Not found');
        return $response;
    });
};
