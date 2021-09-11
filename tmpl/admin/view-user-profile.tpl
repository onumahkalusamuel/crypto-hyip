{include file='admin/header.tpl' pageTitle='User'}

{assign var=user value=$data.user}
{assign var=referrals value=$data.referrals}
{assign var=deposits value=$data.deposits}
{assign var=bonuses value=$data.bonuses}
{assign var=penalties value=$data.penalties}
{assign var=withdrawals value=$data.withdrawals}
{assign var=transactions value=$data.transactions}
{assign var=activeCurrencies value=$data.activeCurrencies}



<table class="forTexts" width="100%" height="100%" cellspacing="0" cellpadding="10" border="0">
    <tbody>
        <tr>
            <td width="100%" valign="top" height="100%">
                <style>
                    .sbmt-group {
                        display: inline-block;
                        float: right;
                    }
                </style>
                <h3>User Details:</h3>
                <table class="form">
                    <tbody>
                        <tr>
                            <th>Username:</th>
                            <td>{$user['userName']}</td>
                        </tr>
                        <tr>
                            <th>Full Name:</th>
                            <td>{$user['fullName']}</td>
                        </tr>
                        <tr>
                            <th>E-mail:</th>
                            <td><a href="mailto:{$user['email']}">{$user['email']}</a></td>
                        </tr>
                    </tbody>
                </table> <br>
                <table class="list">
                    <tbody>
                        <tr>
                            <th>Processing</th>
                            <th>Balance</th>
                            <th>Account</th>
                        </tr>
                        {foreach $activeCurrencies as $currency}
                            <tr>
                                <th style="text-align:right">{$currency|upper} <img src="currencies/{$currency}.gif"
                                        witdth="44" height="17" align="absmiddle"></th>
                                {assign var=walletAddress value=$currency|cat:'Address'}
                                {assign var=walletBalance value=$currency|cat:'Balance'}
                                <td>$ {$user[$walletBalance]|string_format:"%.2f"}</td>
                                <td> {if $user[$walletAddress]}{$user[$walletAddress]}{else} <em>not set</em>{/if} </td>
                            </tr>
                        {/foreach}
                    </tbody>
                </table> <br>
                <table class="form">
                    <tbody>
                        <tr>
                            <th>Total Balance:</th>
                            <td>$0.00 <div class="sbmt-group"><a href="?a=transactions&amp;userid=3256"
                                        class="sbmt btn-sm btn-info">history</a></div>
                            </td>
                        </tr>
                        <tr>
                            <th>Total Deposit:</th>
                            <td>$0.00 <div class="sbmt-group"><a
                                        href="?a=transactions&amp;userid=3256&amp;ttype=deposit"
                                        class="sbmt btn-sm btn-info" style="float:right">history</a></div>
                            </td>
                        </tr>
                        <tr>
                            <th>Active Deposit:</th>
                            <td>$0.00 <div class="sbmt-group"><a href="?a=user_deposits&amp;id=3256&amp;ttype=deposit"
                                        class="sbmt btn-sm btn-danger" style="float:right">manage deposits</a></div>
                            </td>
                        </tr>
                        <tr>
                            <th>Total Earning:</th>
                            <td>$0.00 <div class="sbmt-group"><a
                                        href="?a=transactions&amp;userid=3256&amp;ttype=earning"
                                        class="sbmt btn-sm btn-info">history</a></div>
                            </td>
                        </tr>
                        <tr>
                            <th>Total Withdrawal:</th>
                            <td>$0.00 <div class="sbmt-group"><a
                                        href="?a=transactions&amp;userid=3256&amp;ttype=withdrawal"
                                        class="sbmt btn-sm btn-info">history</a></div>
                            </td>
                        </tr>
                        <tr>
                            <th>Pending Withdrawals:</th>
                            <td>$0.00 <div class="sbmt-group"><a href="?a=withdrawal_requests&amp;userid=3256"
                                        class="sbmt btn-sm btn-danger">process withdrawals</a></div>
                            </td>
                        </tr>
                        <tr>
                            <th>Total Bonus:</th>
                            <td>$0.00 <div class="sbmt-group"> <a href="?a=add_transactions&amp;userid=3256"
                                        class="sbmt btn-sm btn-danger">add a bonus</a> <a
                                        href="?a=transactions&amp;userid=3256&amp;ttype=bonus"
                                        class="sbmt btn-sm btn-info">history</a></div>
                            </td>
                        </tr>
                        <tr>
                            <th>Total Penalty:</th>
                            <td>$0.00 <div class="sbmt-group"> <a
                                        href="?a=add_transactions&amp;userid=3256&amp;trans_type=penalty"
                                        class="sbmt btn-sm btn-danger">add a penalty</a> <a
                                        href="?a=transactions&amp;userid=3256&amp;ttype=penalty"
                                        class="sbmt btn-sm btn-info">history</a></div>
                            </td>
                        </tr>
                        <tr>
                            <th>Referrals:</th>
                            <td>0 <div class="sbmt-group"> <a href="?a=user_refs&amp;id=3256"
                                        class="sbmt btn-sm btn-primary">referrals</a> <a
                                        href="?a=user_traffic&amp;id=3256" class="sbmt btn-sm btn-success">traffic</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Referral Commissions:</th>
                            <td>$0.00 <div class="sbmt-group"><a
                                        href="?a=transactions&amp;userid=3256&amp;ttype=commissions"
                                        class="sbmt btn-sm btn-info">history</a></div>
                            </td>
                        </tr>
                    </tbody>
                </table> <br>
                <div class="alert alert-warning"> Manage user funds:<br> Account balance: how many funds can the user
                    deposit to any investment package or withdraw from the system.<br> Total deposit: how many funds has
                    the user ever deposited to your system.<br> Total active deposit: the whole current deposit of this
                    user.<br> Total earnings: how many funds has the user ever earned with your system.<br> Total
                    withdrawals: how many funds has the user ever withdrawn from system.<br> Total bonus: how many funds
                    has the administrator ever added to the user account as a bonus.<br> Total penalty: how many funds
                    has the administrator ever deleted from the user account as a penalty.<br> Actions:<br> Transactions
                    history - you can check the transactions history for this user.<br> Active deposits/Transactions
                    history - you can check the deposits history for this user.<br> Earnings history - you can check the
                    earnings history for this user.<br> Withdrawals history - you can check the withdrawals history for
                    this user.<br> Process withdrawals - you can withdraw funds by clicking this link if a user asked
                    you for a withdrawal.<br> Bonuses history - you can check the bonuses history for this user.<br>
                    Penalties history - you can check the penalties history for this user.<br> Add a bonus and add a
                    penalty - add a bonus or a penalty to this user.<br> </div>
            </td>
        </tr>
    </tbody>
</table>


<div class="main-content">

    <div class="container pb-40 pt-20">

        <div id="accordion"
            class="panel-group toggle accordion-classic accordion-classic-theme-colored2 accordion-flat">
            <div class="panel panel-default mb-20">
                <div class="panel-heading">
                    <div class="panel-title"> <a class="active font-24 pt-0 pb-0 text-capitalize" data-toggle="collapse"
                            href="#profileAccordion">Profile Details </a> </div>
                </div>
                <div id="profileAccordion" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <p class="help">
                            You can update user information from this form. After editing, click on <strong>UPDATE
                                USER</strong> button to submit.
                        </p>
                        <div class="">
                            <form class="row" action="" method="POST">
                                <div class="col-md-12">
                                    <table class="table">
                                        <tr>
                                            <td>
                                                <strong>Full Name:</strong><br />
                                                <input value="<?= ucwords($user->fullName); ?>" type="text"
                                                    name="fullName" class="form-control" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>Username:</strong><br />
                                                <input value="<?= $user->userName; ?>" type="text" name="userName"
                                                    class="form-control" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>Email:</strong><br />
                                                <input value="<?= $user->email; ?>" type="email" name="email"
                                                    class="form-control" />
                                            </td>
                                        </tr>
                                        <?php foreach($activeCurrencies as $currency):?>
                                        <tr>
                                            <td><strong>
                                                    <?=strtoupper($currency);?> Address:
                                                </strong><br />
                                                {* <input value="<?= $user->{$currency.'Address'}; ?>" *}
                                                name="
                                                <?=$currency;?>Address" type="text" class="form-control" />
                                            </td>
                                        </tr>
                                        <?php endforeach;?>
                                        <tr>
                                            <td><strong>New Password:</strong><br />
                                                <input value="" name="password" type="text" class="form-control" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>Actions:</strong><br />
                                                <div>
                                                    <h3 class="heading-title">
                                                        <button type="submit"
                                                            class="btn btn-dark btn-theme-colored btn-flat mb-5 text-uppercase">Update
                                                            User</i></button>
                                                    </h3>
                                                    <!--<a href="<?= $route->urlFor('admin-block-user', ['id' => $trans->ID]) ?>" class="btn btn-dark btn-sm btn-flat btn-theme-colored2 mb-5">Block User</i></a> -->
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {if $user->ID !== "new"}
                <div class="panel panel-default mb-20">
                    <div class="panel-heading">
                        <div class="panel-title"> <a class="active font-24 pt-0 pb-0 text-capitalize" data-toggle="collapse"
                                href="#balancesAccordion">Balances </a> </div>
                    </div>
                    <div id="balancesAccordion" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="">
                                <div class="col-md-12">
                                    <table class="table">
                                        {foreach $activeCurrencies as $currency}
                                            <tr>
                                                <td>
                                                    <strong>{$currency|upper} Balance:</strong><br />
                                                    $
                                                    {* <?= number_format($user->{$currency .'Balance'}, 2); ?> *}
                                                </td>
                                            </tr>
                                        {/foreach}
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default mb-20">
                    <div class="panel-heading">
                        <div class="panel-title"> <a class="collapsed font-24 pt-0 pb-0 text-capitalize"
                                data-toggle="collapse" href="#referralsAccordion">Referrals </a> </div>
                    </div>
                    <div id="referralsAccordion" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table">
                                            <tr>
                                                <td>
                                                    <strong>Total:</strong><br />
                                                    <?= number_format($referrals['total']); ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>Bonus Earned:</strong><br />
                                                    $
                                                    <?= number_format($referrals['amount'], 2); ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>Actions:</strong><br />
                                                    <h3 class="heading-title text-uppercase">
                                                        <a href="<?= $route->urlFor('admin-referrals', [], ['referralUserID' => $user->ID]) ?>"
                                                            class="btn btn-dark btn-flat btn-theme-colored">Full
                                                            Details</i></a>
                                                    </h3>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default mb-20">
                    <div class="panel-heading">
                        <div class="panel-title"> <a class="collapsed font-24 pt-0 pb-0 text-capitalize"
                                data-toggle="collapse" href="#depositsAccordion">Deposits </a> </div>
                    </div>
                    <div id="depositsAccordion" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table">
                                            <?php foreach ($deposits as $deposit) : ?>
                                            <tr>
                                                <td>
                                                    <strong>
                                                        <?= strtoupper($deposit->status); ?>
                                                    </strong><br />
                                                    Currency: <img
                                                        src="assets/images/currencies/<?= $deposit->currency; ?>.gif"
                                                        alt="<?= $deposit->currency; ?>" /><br />
                                                    Amount: $
                                                    <?= number_format($deposit->amount, 2); ?> <br />
                                                    Total:
                                                    <?= number_format($deposit->total); ?>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                            <tr>
                                                <td>
                                                    <strong>Actions</strong><br />
                                                    <h3 class="heading-title text-uppercase">
                                                        <a href="<?= $route->urlFor('admin-deposits', [], ['userID' => $user->ID]) ?>"
                                                            class="btn btn-dark btn-flat btn-theme-colored">Full
                                                            Details</i></a>
                                                    </h3>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default mb-20">
                    <div class="panel-heading">
                        <div class="panel-title"> <a class="collapsed font-24 pt-0 pb-0 text-capitalize"
                                data-toggle="collapse" href="#bonusAccordion">Bonus and Penalty </a> </div>
                    </div>
                    <div id="bonusAccordion" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table">
                                            <tr>
                                                <td><strong>BONUSES</strong><br /></td>
                                            </tr>
                                            <?php foreach ($bonuses as $bonus) : ?>
                                            <tr>
                                                <td>
                                                    Currency: <img
                                                        src="assets/images/currencies/<?= $bonus->currency; ?>.gif"
                                                        alt="<?= $bonus->currency; ?>" /><br />
                                                    Amount: $
                                                    <?= number_format($bonus->amount, 2); ?> <br />
                                                    Total:
                                                    <?= number_format($bonus->total); ?>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                            <tr>
                                                <td><strong>PENALTIES</strong><br /></td>
                                            </tr>
                                            <?php foreach ($penalties as $penalty) : ?>
                                            <tr>
                                                <td>
                                                    Currency: <img
                                                        src="assets/images/currencies/<?= $penalty->currency; ?>.gif"
                                                        alt="<?= $penalty->currency; ?>" /><br />
                                                    Amount: $
                                                    <?= number_format($penalty->amount, 2); ?> <br />
                                                    Total:
                                                    <?= number_format($penalty->total); ?>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                            <tr>
                                                <td>
                                                    <strong>Actions:</strong><br />
                                                    <h3 class="heading-title text-uppercase">
                                                        <a href="<?= $route->urlFor('admin-add-bonus-view', ['user_id' => $user->ID]) ?>"
                                                            class="btn btn-dark btn-flat btn-theme-colored2">Add
                                                            Bonus</i></a>
                                                        <a href="<?= $route->urlFor('admin-transactions', [], ['userID' => $user->ID, 'logType'=>'bonus']) ?>"
                                                            class="btn btn-dark btn-flat btn-theme-colored">Bonus
                                                            History</i></a>
                                                        <a href="<?= $route->urlFor('admin-add-penalty-view', ['user_id' => $user->ID]) ?>"
                                                            class="btn btn-dark btn-flat btn-theme-colored2">Add
                                                            Penalty</i></a>
                                                        <a href="<?= $route->urlFor('admin-transactions', [], ['userID' => $user->ID, 'logType'=>'penalty']) ?>"
                                                            class="btn btn-dark btn-flat btn-theme-colored">Penalty
                                                            History</i></a>
                                                    </h3>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default mb-20">
                    <div class="panel-heading">
                        <div class="panel-title"> <a class="collapsed font-24 pt-0 pb-0 text-capitalize"
                                data-toggle="collapse" href="#withdrawalsAccordion">Withdrawals </a> </div>
                    </div>
                    <div id="withdrawalsAccordion" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table">
                                            <?php foreach ($withdrawals as $withdrawal) : ?>
                                            <tr>
                                                <td>
                                                    <strong>
                                                        <?= strtoupper($withdrawal->status); ?>
                                                    </strong><br />
                                                    Currency: <img
                                                        src="assets/images/currencies/<?= $withdrawal->currency; ?>.gif"
                                                        alt="<?= $withdrawal->currency; ?>" /><br />
                                                    Amount: $
                                                    <?= number_format($withdrawal->amount, 2); ?> <br />
                                                    Total:
                                                    <?= number_format($withdrawal->total); ?>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                            <tr>
                                                <td>
                                                    <strong>Actions:</strong><br />
                                                    <h3 class="heading-title text-uppercase">
                                                        <a href="<?= $route->urlFor('admin-withdrawals', [], ['userID' => $user->ID]) ?>"
                                                            class="btn btn-dark btn-flat btn-theme-colored">Full
                                                            Details</i></a>
                                                    </h3>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default mb-20">
                    <div class="panel-heading">
                        <div class="panel-title"> <a class="collapsed font-24 pt-0 pb-0 text-capitalize"
                                data-toggle="collapse" href="#LogsAccordion">Transaction Logs </a> </div>
                    </div>
                    <div id="LogsAccordion" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table">
                                            <?php foreach ($transactions as $transaction) : ?>
                                            <tr>
                                                <td>
                                                    <strong>
                                                        <?= strtoupper($transaction->type); ?>
                                                    </strong><br />
                                                    Currency: <img
                                                        src="assets/images/currencies/<?= $transaction->currency; ?>.gif"
                                                        alt="<?= $transaction->currency; ?>" /><br />
                                                    Amount: $
                                                    <?= number_format($transaction->amount, 2); ?> <br />
                                                    Total:
                                                    <?= number_format($transaction->total); ?>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                            <tr>
                                                <td>
                                                    <strong>Actions:</strong><br />
                                                    <h3 class="heading-title text-uppercase">
                                                        <a href="<?= $route->urlFor('admin-transactions', [], ['userID' => $user->ID]) ?>"
                                                            class="btn btn-dark btn-flat btn-theme-colored">Full
                                                            Details</i></a>
                                                    </h3>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {/if}
        </div>
    </div>
</div>

{include file='admin/footer.tpl'}