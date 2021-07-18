<?php

use App\Middleware\UserAuthMiddleware;
use App\Middleware\JsonResponseMiddleware;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {

    $app->group('/user/', function (RouteCollectorProxy $group) {

        //account logs= == trx
        $group->get('account-logs[/]', \App\Action\User\AccountLogsView::class)->setName('user-account-logs');

        //dashboard
        $group->get('dashboard[/]', \App\Action\User\UserDashboardAction::class)->setName('user-dashboard');

        // user profile
        $group->get('profile[/]', \App\Action\User\ProfileView::class)->setName('user-profile');
        $group->post('profile[/]', \App\Action\User\ProfileAction::class);

        // deposits
        $group->get('deposits[/]', \App\Action\User\DepositsView::class)->setName('user-deposits');
        $group->get('deposits/{id}[/]', \App\Action\User\SingleDepositView::class)->setName('user-view-deposit');

        // withdrawals
        $group->get('withdrawals[/]', \App\Action\User\WithdrawalsView::class)->setName('user-withdrawals');
        $group->get('withdrawals/{id}[/]', \App\Action\User\SingleWithdrawalView::class)->setName('user-view-withdrawal');
        $group->get('withdrawals/{id}/delete[/]', \App\Action\User\WithdrawalDeleteAction::class)->setName('user-delete-withdrawal');

        // referrals
        $group->get('referrals[/]', \App\Action\User\ReferralsView::class)->setName('user-referrals');
        $group->get('referrals/{id}[/]', \App\Action\User\SingleReferralView::class)->setName('user-view-referral');

        // ajax calls
        $group->group('', function (RouteCollectorProxy $group) {
            $group->post('deposits[/]', \App\Action\User\DepositsAction::class);
            $group->post('withdrawals[/]', \App\Action\User\WithdrawalsAction::class);
        })->addMiddleware(new JsonResponseMiddleware);

    })
        ->add(UserAuthMiddleware::class);
};
