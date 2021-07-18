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
            // components data (news, faqs, etc) to be implemented later
            $group->get('components/news[/]', \App\Action\Components\NewsAction::class);
            $group->get('components/investment-plans[/]', \App\Action\Components\InvestmentPlansAction::class);
            $group->get('components/last-transactions[/]', \App\Action\Components\LastTransactionsAction::class);
        })->addMiddleware(new JsonResponseMiddleware);

        $group->get('reset/{token}/{email}[/]', \App\Action\ResetUpdateView::class);
        $group->post('reset/{token}/{email}[/]', \App\Action\ResetUpdateAction::class);

        $group->post('page/login[/]', \App\Action\LoginAction::class);

        $group->get('logout[/]', \App\Action\LogoutAction::class)->setName('logout');

        $group->get('ref/{referralUserName}[/]', \App\Action\AffiliatesAction::class)->setName('ref');

        $group->post('contact-us[/]', \App\Action\ContactUsAction::class)->setName('contact-us-form');

        //catch-all page
        $group->get('page/{page}', \App\Action\PageView::class)->setName('page');

    });
};
