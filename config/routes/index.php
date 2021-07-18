<?php

use Slim\App;
use Slim\Views\PhpRenderer;

return function (App $app) {
    // get public
    (require __DIR__ . '/public.php')($app);
    // get user
    (require __DIR__ . '/user.php')($app);
    // get admin
    (require __DIR__ . '/admin.php')($app);
    // get api
    (require __DIR__ . '/api.php')($app);

    // catchall - for 404 - Not Found
    $app->map(['GET', 'POST', 'PUT', 'DELETE'], '{routes:.+}', function ($request, $response) {
        $view = $this->get(PhpRenderer::class);
        return $view->render($response, "404.php");
    });
};
