<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteCollectorProxy;

return function (RouteCollectorProxy $app) {

    $app->group('/', function (RouteCollectorProxy $group) {
        //auth
        $group->post('register', \App\Action\RegisterAction::class);
        $group->post('reset-password', \App\Action\ResetPasswordAction::class);
        $group->post('reset[/]', \App\Action\ResetUpdateAction::class);
        $group->post('login', \App\Action\LoginAction::class);
        $group->get('logout', \App\Action\LogoutAction::class)->setName('logout');

        //ref
        $group->get('ref/{referralUserName}', \App\Action\AffiliatesAction::class)->setName('ref');
        //contact
        $group->post('contact-us', \App\Action\ContactUsAction::class)->setName('contact-us-form');
        // news
        $group->get('news', \App\Action\Api\NewsAction::class);
        //plans
        $group->get('investment-plans', \App\Action\Api\InvestmentPlansAction::class);

        //get active currencies
        $group->get('active-currencies', function (ServerRequestInterface $req, ResponseInterface $res) {
            $res->getBody()->write(json_encode($GLOBALS['activeCurrencies']));
            return $res;
        });

        //get deposit addresses
        $group->get('deposit-addresses', function (ServerRequestInterface $req, ResponseInterface $res) {
            $res->getBody()->write(json_encode($GLOBALS['depositAddresses']));
            return $res;
        });

        //last tranx
        $group->get('last-transactions[/{type}[/]]', \App\Action\Api\LastTransactionsAction::class);

        //admin
        //bonus confirm and penalty confirm links
        $group->get('admin/add-bonus-confirm/{confirmation_code}', [\App\Action\Admin\AddBonusAction::class, 'confirmTransaction'])->setName('admin-add-bonus-confirm');
        $group->get('admin/add-penalty-confirm/{confirmation_code}', [\App\Action\Admin\AddPenaltyAction::class, 'confirmTransaction'])->setName('admin-add-penalty-confirm');
    });
};
