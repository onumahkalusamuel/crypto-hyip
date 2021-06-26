<?php

use Slim\App;
use Slim\Routing\RouteCollectorProxy;
use App\Middleware\JsonResponseMiddleware;

return function (App $app) {

    $app->group('/', function (RouteCollectorProxy $group) {

        // page views
        $group->get('', \App\Action\HomeView::class)->setName('home');

        // ajax calls
        $group->group('', function (RouteCollectorProxy $group) {
            $group->post('page/register[/]', \App\Action\RegisterAction::class);
            $group->post('page/reset-password[/]', \App\Action\ResetPasswordAction::class);
        })->addMiddleware(new JsonResponseMiddleware);

        $group->post('page/login[/]', \App\Action\LoginAction::class);

        $group->get('logout[/]', \App\Action\LogoutAction::class)->setName('logout');

        $group->get('ref/{referralUserName}[/]', \App\Action\AffiliatesAction::class)->setName('ref');

        $group->post('reset[/]', \App\Action\ResetAction::class);
        $group->post('reset/update[/]', \App\Action\ResetUpdateAction::class);
        $group->get('reset/{token}[/]', \App\Action\ResetConfirmAction::class);
        $group->post('contact-us[/]', \App\Action\ContactUsAction::class);

        //catch-all page
        $group->get('page/{page}', \App\Action\PageView::class)->setName('page');

        $group->get('trxlog[/]', \App\Action\TrailLog\TrxLogAction::class);

        $group->get('token[/]', \App\Action\User\TokenCheckAction::class);


        // cronjobs
        $group->get('/calculate_interests', \App\Action\Deposits\CalculateInterestsAction::class);
    });
};
