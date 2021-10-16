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
        $group->get('users/user-funds/{id}[/]', \App\Action\Admin\User\UserFundsView::class)->setName('admin-view-user-funds');
        $group->post('users/{id}[/]', \App\Action\Admin\User\UpdateAction::class);
        $group->get('users/{id}/delete[/]', \App\Action\Admin\User\DeleteAction::class)->setName('admin-delete-user');

        // referrals
        $group->get('referrals[/]', \App\Action\Admin\Referrals\ViewAll::class)->setName('admin-referrals');
        $group->get('referrals/{id}[/]', \App\Action\Admin\Referrals\SingleView::class)->setName('admin-view-referral');

        // withdrawals 
        $group->get('withdrawals[/]', \App\Action\Admin\Withdrawals\ViewAll::class)->setName('admin-withdrawals');
        $group->get('withdrawals/{id}[/]', \App\Action\Admin\Withdrawals\SingleView::class)->setName('admin-view-withdrawal');
        $group->get('withdrawals/{id}/delete[/]', \App\Action\Admin\Withdrawals\DeleteAction::class)->setName('admin-delete-withdrawal');
        $group->get('withdrawals/{id}/decline[/]', \App\Action\Admin\Withdrawals\DeclineAction::class)->setName('admin-decline-withdrawal');
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

        // bonus
        $group->get('add-bonus/{user_id}[/]', [\App\Action\Admin\AddBonusAction::class, 'viewPage'])->setName('admin-add-bonus-view');
        $group->post('add-bonus/{user_id}[/]', [\App\Action\Admin\AddBonusAction::class, 'initTransaction'])->setName('admin-add-bonus');

        // penalty
        $group->get('add-penalty/{user_id}[/]', [\App\Action\Admin\AddPenaltyAction::class, 'viewPage'])->setName('admin-add-penalty-view');
        $group->post('add-penalty/{user_id}[/]', [\App\Action\Admin\AddPenaltyAction::class, 'initTransaction'])->setName('admin-add-penalty');

        // block user
        $group->post('block-user[/]', \App\Action\Admin\BlockUserAction::class)->setName('admin-block-user');

        // newsletter
        $group->get('newsletter[/]', [\App\Action\Admin\NewsletterAction::class, 'viewPage'])->setName('admin-newsletter');
        $group->post('newsletter[/]', [\App\Action\Admin\NewsletterAction::class, 'addToQueue']);

        // newsletter
        $group->get('email-templates[/]', [\App\Action\Admin\EmailTemplates\Templates::class, 'viewPage'])->setName('admin-email-templates');
        $group->post('email-templates[/]', [\App\Action\Admin\EmailTemplates\Templates::class, 'updateHeaderFooter']);
        $group->get('email-templates/{id}[/]', [\App\Action\Admin\EmailTemplates\Templates::class, 'viewTemplate'])->setName('admin-email-template');
        $group->post('email-templates/{id}[/]', [\App\Action\Admin\EmailTemplates\Templates::class, 'updateTemplate']);

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
