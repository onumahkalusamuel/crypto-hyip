<?php

use App\Middleware\JsonResponseMiddleware;
use App\Middleware\AdminAuthMiddleware;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {

    $app->group('/admin/', function (RouteCollectorProxy $group) {

        //dashboard
        $group->get('dashboard[/]', \App\Action\Admin\DashboardAction::class)->setName('admin-dashboard');

        // users
        $group->get('users[/]', \App\Action\Admin\User\ViewAll::class)->setName('admin-users');
        $group->get('users/{id}[/]', \App\Action\Admin\User\SingleView::class)->setName('admin-view-user');
        $group->post('users/{id}[/]', \App\Action\Admin\User\UpdateAction::class)->setName('admin-view-user');

        // referrals
        $group->get('referrals[/]', \App\Action\Admin\Referrals\ViewAll::class)->setName('admin-referrals');
        $group->get('referrals/{id}[/]', \App\Action\Admin\Referrals\SingleView::class)->setName('admin-view-referral');

        // withdrawals 
        $group->get('withdrawals[/]', \App\Action\Admin\Withdrawals\ViewAll::class)->setName('admin-withdrawals');
        $group->get('withdrawals/{id}[/]', \App\Action\Admin\Withdrawals\SingleView::class)->setName('admin-view-withdrawal');
        $group->get('withdrawals/{id}/delete[/]', \App\Action\Admin\Withdrawals\DeleteAction::class)->setName('admin-delete-withdrawal');
        $group->get('withdrawals/{id}/approve[/]', \App\Action\Admin\Withdrawals\ApproveAction::class)->setName('admin-approve-withdrawal');

        // deposits 
        $group->get('deposits[/]', \App\Action\Admin\Deposits\ViewAll::class)->setName('admin-deposits');
        $group->get('deposits/{id}[/]', \App\Action\Admin\Deposits\SingleView::class)->setName('admin-view-deposit');
        $group->get('deposits/{id}/delete[/]', \App\Action\Admin\Deposits\DeleteAction::class)->setName('admin-delete-deposit');
        $group->get('deposits/{id}/release[/]', \App\Action\Admin\Deposits\ReleaseAction::class)->setName('admin-release-deposit');
        $group->get('deposits/{id}/approve[/]', \App\Action\Admin\Deposits\ApproveAction::class)->setName('admin-approve-deposit');
        
        // transactions
        $group->get('transactions[/]', \App\Action\Admin\TrailLog\ViewAll::class)->setName('admin-transactions');
        $group->get('transactions/{id}[/]', \App\Action\Admin\TrailLog\SingleView::class)->setName('admin-view-transactions');

        // plans
        $group->get('plans[/]', \App\Action\Admin\Plans\ViewAll::class)->setName('admin-plans');
        $group->get('plans/{id}[/]', \App\Action\Admin\Plans\SingleView::class)->setName('admin-view-plan');
        $group->post('plans/{id}[/]', \App\Action\Admin\Plans\UpdateAction::class);
        $group->get('plans/{id}/delete[/]', \App\Action\Admin\Plans\DeleteAction::class)->setName('admin-delete-plan');

        // settings
        $group->get('settings[/]', \App\Action\Admin\Settings\ViewAll::class)->setName('admin-settings');


        $group->post('approvewithdrawal[/[{id}[/]]]', \App\Action\Withdrawals\ApproveAction::class);
        $group->post('declinewithdrawal[/[{id}[/]]]', \App\Action\Withdrawals\DeclineAction::class);
        $group->get('approvedwithdrawals[/[{user_id}[/]]]', \App\Action\Withdrawals\ApprovedWithdrawalsAction::class);
        $group->get('pendingwithdrawals[/[{user_id}[/]]]', \App\Action\Withdrawals\PendingWithdrawalsAction::class);

        // bonus
        $group->post('add-bonus/{id}[/]', \App\Action\Admin\AddBonusAction::class)->setName('admin-add-bonus');
        $group->get('add-bonus[/{confirmation_code}]', \App\Action\Admin\AddBonusAction::class);
        // penalty
        $group->post('add-penalty/{id}[/]', \App\Action\Admin\AddPenaltyAction::class)->setName('admin-add-penalty');
        $group->post('block-user/{id}[/]', \App\Action\Admin\AddPenaltyAction::class)->setName('admin-block-user');
        $group->get('add-penalty[/{confirmation_code}]', \App\Action\Admin\AddPenaltyAction::class);

        // traillog
        $group->post('traillog[/]', \App\Action\TrailLog\CreateAction::class);
        $group->get('traillog[/]', \App\Action\TrailLog\ReadAction::class);

        // settings
        $group->post(
            'settings/update-settings[/]',
            \App\Action\Admin\Settings\UpdateSettingsAction::class
        )->setName('admin-update-settings');

        $group->post(
            'settings/update-admin[/]',
            \App\Action\Admin\Settings\UpdateAdminAction::class
        )->setName('admin-update-admin');

        $group->get(
            'settings/update-admin-otp[/]',
            \App\Action\Admin\Settings\UpdateAdminOTPAction::class
        )->setName('admin-update-admin-otp');
    })->add(AdminAuthMiddleware::class);
};
