<?php

use Slim\App;
use Slim\Routing\RouteCollectorProxy;
use App\Middleware\JsonResponseMiddleware;

return function (App $app) {

    $app->group('/', function (RouteCollectorProxy $group) {

        // page views
        $group->get('', \App\Action\PageView::class)->setName('home');

        // ajax calls
        $group->group('', function (RouteCollectorProxy $group) {
            $group->post('register[/]', \App\Action\RegisterAction::class);
            $group->post('reset-password[/]', \App\Action\ResetPasswordAction::class);
        })->addMiddleware(new JsonResponseMiddleware);

        // Authentication pages
        $group->get('login[/]', function ($request, $response) {
            $this->get(Smarty::class)->display('theme/public/auth/login.tpl');
            return $response;
        })->setName('login');
        $group->get('register[/]', function ($request, $response) {
            $this->get(Smarty::class)->display('theme/public/auth/register.tpl');
            return $response;
        })->setName('register');
        $group->get('reset-password[/]', function ($request, $response) {
            $this->get(Smarty::class)->display('theme/public/auth/reset-password.tpl');
            return $response;
        })->setName('reset-password');

        $group->get('reset[/]', \App\Action\ResetUpdateView::class)->setName('password-reset-link');
        $group->post('reset[/]', \App\Action\ResetUpdateAction::class);

        $group->post('login[/]', \App\Action\LoginAction::class);

        $group->get('logout[/]', \App\Action\LogoutAction::class)->setName('logout');

        $group->get('ref/{referralUserName}[/]', \App\Action\AffiliatesAction::class)->setName('ref');

        $group->post('contact-us[/]', \App\Action\ContactUsAction::class)->setName('contact-us-form');

        // bonus confirm and penalty confirm links. brought the out to avoid asking for authentication at all times
        $group->get('admin/add-bonus-confirm/{confirmation_code}[/]', [\App\Action\Admin\AddBonusAction::class, 'confirmTransaction'])->setName('admin-add-bonus-confirm');
        $group->get('admin/add-penalty-confirm/{confirmation_code}[/]', [\App\Action\Admin\AddPenaltyAction::class, 'confirmTransaction'])->setName('admin-add-penalty-confirm');
        //catch-all page
        $group->get('page/{page}', \App\Action\PageView::class)->setName('page');
    });
};
