<?php

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {

    $app->group('/', function (RouteCollectorProxy $group) {

        // page views
        $group->get('', \App\Action\HomeView::class)->setName('home');
        $group->get('page/{page}', \App\Action\PageView::class)->setName('page');

        $group->get('login[/]', \App\Action\LoginAction::class)->setName('login');
        $group->post('login[/]', \App\Action\LoginAction::class);

        $group->post('register[/]', \App\Action\RegisterAction::class);
        $group->post('reset[/]', \App\Action\ResetAction::class);
        $group->post('reset/update[/]', \App\Action\ResetUpdateAction::class);
        $group->get('reset/{token}[/]', \App\Action\ResetConfirmAction::class);
        $group->post('contact-us[/]', \App\Action\ContactUsAction::class);
        $group->get('trxlog[/]', \App\Action\TrailLog\TrxLogAction::class);

        $group->get('token[/]', \App\Action\User\TokenCheckAction::class);


        // cronjobs
        $group->get('/calculate_interests', \App\Action\Deposits\CalculateInterestsAction::class);

    });
};
