<?php

use App\Middleware\JsonResponseMiddleware;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {

    $app->group('/admin/', function (RouteCollectorProxy $group) {

        // users
        $group->get('/userslist[/[{page}[/[{rpp}[/]]]]]', \App\Action\User\ListAction::class);
        $group->get('/users[/]', \App\Action\Admin\User\ReadPagingAction::class);
        $group->post('/users[/]', \App\Action\Admin\User\CreateAction::class);
        $group->get('/user/{id}[/]', \App\Action\Admin\User\ReadAction::class);
        $group->post('/user/{id}[/]', \App\Action\Admin\User\UpdateAction::class);
        $group->post('/user/{id}/delete[/]', \App\Action\Admin\User\DeleteAction::class);

        // plans
        $group->get('/plans[/[{id}]]', \App\Action\Plans\ReadAction::class);
        $group->post('/plans[/]', \App\Action\Plans\CreateAction::class);
        $group->put('/plans[/[{id}[/]]]', \App\Action\Plans\UpdateAction::class);
        $group->delete('/plans/{id}[/]', \App\Action\Plans\DeleteAction::class);

        // deposits
        $group->get('/deposits[/[{user_id}[/[{id}]]]]', \App\Action\Deposits\ReadAction::class);
        $group->post('/deposits[/]', \App\Action\Deposits\CreateAction::class);
        $group->put('/deposits/{id}[/]', \App\Action\Deposits\UpdateAction::class);
        $group->delete('/deposits[/[{user_id}[/[{id}]]]]', \App\Action\Deposits\DeleteAction::class);

        $group->put('/approvedeposits/{id}[/]', \App\Action\Deposits\ApproveAction::class);
        $group->get('/approveddeposits[/[{user_id}[/]]]', \App\Action\Deposits\ApprovedDepositsAction::class);
        $group->get('/pendingdeposits[/[{user_id}[/]]]', \App\Action\Deposits\PendingDepositsAction::class);
        $group->get('/releasedeposit[/[{id}[/]]]', \App\Action\Deposits\ReleaseDepositAction::class);

        // withdrawals
        $group->get('/withdrawals[/[{user_id}[/[{id}]]]]', \App\Action\Withdrawals\ReadAction::class);
        $group->post('/withdrawals[/]', \App\Action\Withdrawals\CreateAction::class);
        $group->put('/withdrawals/{id}[/]', \App\Action\Withdrawals\UpdateAction::class);
        $group->delete('/withdrawals[/[{user_id}[/[{id}]]]]', \App\Action\Withdrawals\DeleteAction::class);

        $group->post('/approvewithdrawal[/[{id}[/]]]', \App\Action\Withdrawals\ApproveAction::class);
        $group->post('/declinewithdrawal[/[{id}[/]]]', \App\Action\Withdrawals\DeclineAction::class);
        $group->get('/approvedwithdrawals[/[{user_id}[/]]]', \App\Action\Withdrawals\ApprovedWithdrawalsAction::class);
        $group->get('/pendingwithdrawals[/[{user_id}[/]]]', \App\Action\Withdrawals\PendingWithdrawalsAction::class);

        // referrals
        $group->get('/refdashboard[/]', \App\Action\Referrals\RefDashboardAction::class);
        $group->get('/referrals[/[{user_id}[/[{id}]]]]', \App\Action\Referrals\ReadAction::class);
        $group->post('/referrals__[/]', \App\Action\Referrals\CreateAction::class);
        $group->put('/referrals/{id}[/]', \App\Action\Referrals\UpdateAction::class);
        $group->delete('/referrals[/[{referral_user_id}[/[{id}]]]]', \App\Action\Referrals\DeleteAction::class);

        // admin area
        $group->get('/admin/dashboard[/]', \App\Action\Admin\DashboardAction::class);
        $group->get('/userfunds/{id}[/]', \App\Action\Admin\UserFundsAction::class);
        // bonus
        $group->post('/addbonus[/]', \App\Action\Admin\AddBonusAction::class);
        $group->get('/addbonus[/{confirmation_code}]', \App\Action\Admin\AddBonusAction::class);
        // penalty
        $group->post('/addpenalty[/]', \App\Action\Admin\AddPenaltyAction::class);
        $group->get('/addpenalty[/{confirmation_code}]', \App\Action\Admin\AddPenaltyAction::class);

        // traillog
        $group->post('/traillog[/]', \App\Action\TrailLog\CreateAction::class);
        $group->get('/traillog[/]', \App\Action\TrailLog\ReadAction::class);

        // settings
        $group->get('/settings[/[{setting}[/]]]', \App\Action\Settings\ReadAction::class);
        $group->put('/settingsupdate[/]', \App\Action\Settings\UpdateAction::class);
    })->addMiddleware(new JsonResponseMiddleware);
};
