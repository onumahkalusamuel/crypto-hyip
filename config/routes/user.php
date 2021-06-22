<?php

use App\Middleware\UserAuthMiddleware;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {

    $app->group('/user/', function (RouteCollectorProxy $group) {
        //dashboard
        $group->get('dashboard[/]', \App\Action\User\UserDashboardAction::class);
    })
        ->add(UserAuthMiddleware::class);
};
