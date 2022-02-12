<?php

use App\Middleware\AppAuthMiddleware;
use App\Middleware\UserAuthMiddleware;
use Slim\Routing\RouteCollectorProxy;

return function (RouteCollectorProxy $app) {

    $app->group('/user/', function (RouteCollectorProxy $group) {

        //account logs===trx
        $group->get('account-logs', \App\Action\User\AccountLogsView::class);

        //dashboard
        $group->get('dashboard', \App\Action\User\UserDashboardAction::class);

        // user profile
        $group->get('profile', \App\Action\User\ProfileView::class);
        $group->post('profile', \App\Action\User\ProfileAction::class);

        // deposits
        $group->get('deposits', \App\Action\User\DepositsView::class);
        $group->get('deposits/{id}', \App\Action\User\SingleDepositView::class);
        $group->post('deposits', \App\Action\User\DepositsAction::class);


        // withdrawals
        $group->get('withdrawals', \App\Action\User\WithdrawalsView::class);
        $group->get('withdrawals/{id}', \App\Action\User\SingleWithdrawalView::class);
        $group->get('withdrawals/{id}/delete', \App\Action\User\WithdrawalDeleteAction::class);
        $group->post('withdrawals', \App\Action\User\WithdrawalsAction::class);

        // referrals
        $group->get('referrals', \App\Action\User\ReferralsView::class);
        $group->get('referrals/{id}', \App\Action\User\SingleReferralView::class);
    })
        ->add(UserAuthMiddleware::class)
        ->add(AppAuthMiddleware::class);
};
