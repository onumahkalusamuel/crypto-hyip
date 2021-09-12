{include file='admin/header.tpl' pageTitle='User'}

{assign var=user value=$data.user}
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
                        {if $user['upline_id'] ne ''}
                            <tr>
                                <th>Upline:</th>
                                <td><a
                                        href="{$route->urlFor('admin-view-user', ['id' => $user['upline_id']] )}">{$user['upline_username']}</a>
                                </td>
                            </tr>
                        {/if}
                        <tr>
                            <th>Referral Link:</th>
                            <td><input class="inpts" style="width: 100%;"
                                    value="{$route->fullUrlFor($uri, 'ref', ['referralUserName'=> $user['userName']])}" />
                            </td>
                        </tr>
                    </tbody>
                </table> <br>
                <table class="list form">
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
                                <td> {if $user[$walletAddress]}
                                        {$user[$walletAddress]}
                                    {else}
                                        <a href="{$route->urlFor('admin-view-user', ['id' => $user['ID']])}"><em>not
                                                set</em></a>

                                    {/if}
                                </td>
                            </tr>
                        {/foreach}
                    </tbody>
                </table> <br>
                <table class="form">
                    <tbody>
                        <tr>
                            <th>Total Balance:</th>
                            <td>${$data.total_balance|string_format:"%.2f"}
                            </td>
                        </tr>
                        <tr>
                            <th>Total Deposit:</th>
                            <td>${$data.total_deposit|string_format:"%.2f"} <div class="sbmt-group"><a
                                        href="{$route->urlFor('admin-transactions', [], ['logType'=>'deposit', 'userID'=>$user['ID']])}"
                                        class="sbmt btn-sm btn-info" style="float:right">history</a></div>
                            </td>
                        </tr>
                        <tr>
                            <th>Active Deposit:</th>
                            <td>${$data.active_deposit|string_format:"%.2f"} <div class="sbmt-group"><a
                                        href="{$route->urlFor('admin-deposits', [], ['depositStatus'=>'approved', 'userID'=>$user['ID']])}"
                                        class="sbmt btn-sm btn-danger" style="float:right">manage deposits</a></div>
                            </td>
                        </tr>
                        <tr>
                            <th>Total Earning:</th>
                            <td>${$data.total_earning|string_format:"%.2f"} <div class="sbmt-group"><a
                                        href="{$route->urlFor('admin-transactions', [], ['logType'=>'earning', 'userID'=>$user['ID']])}"
                                        class="sbmt btn-sm btn-info">history</a></div>
                            </td>
                        </tr>
                        <tr>
                            <th>Total Withdrawal:</th>
                            <td>${$data.total_withdrawal|string_format:"%.2f"} <div class="sbmt-group"><a
                                        href="{$route->urlFor('admin-transactions', [], ['logType'=>'withdrawal', 'userID'=>$user['ID']])}"
                                        class="sbmt btn-sm btn-info">history</a></div>
                            </td>
                        </tr>
                        <tr>
                            <th>Pending Withdrawals:</th>
                            <td>${$data.pending_withdrawal|string_format:"%.2f"} <div class="sbmt-group"><a
                                        href="{$route->urlFor('admin-withdrawals', [], ['withdrawalStatus'=>'pending', 'userID'=>$user['ID']])}"
                                        class="sbmt btn-sm btn-danger">process withdrawals</a></div>
                            </td>
                        </tr>
                        <tr>
                            <th>Total Bonus:</th>
                            <td>${$data.total_bonus|string_format:"%.2f"} <div class="sbmt-group"> <a
                                        href="{$route->urlFor('admin-add-bonus-view', ['user_id'=>$user['ID']])}"
                                        class="sbmt btn-sm btn-danger">add a bonus</a>
                                    <a href="{$route->urlFor('admin-transactions', [], ['logType'=>'bonus', 'userID'=>$user['ID']])}"
                                        class="sbmt btn-sm btn-info">history</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Total Penalty:</th>
                            <td>${$data.total_penalty|string_format:"%.2f"} <div class="sbmt-group"> <a
                                        href="{$route->urlFor('admin-add-penalty-view', ['user_id'=>$user['ID']])}"
                                        class="sbmt btn-sm btn-danger">add a penalty</a> <a
                                        href="{$route->urlFor('admin-transactions', [], ['logType'=>'penalty', 'userID'=>$user['ID']])}"
                                        class="sbmt btn-sm btn-info">history</a></div>
                            </td>
                        </tr>
                        <tr>
                            <th>Referrals:</th>
                            <td>{$data.referral} <div class="sbmt-group"> <a
                                        href="{$route->urlFor('admin-referrals', [], ['referralUserID'=>$user['ID']])}"
                                        class="sbmt btn-sm btn-primary">referrals</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Referral Commissions:</th>
                            <td>${$data.referral_commission|string_format:"%.2f"} <div class="sbmt-group"><a
                                        href="{$route->urlFor('admin-transactions', [], ['logType'=>'referral', 'userID'=>$user['ID']])}"
                                        class="sbmt btn-sm btn-info">history</a></div>
                            </td>
                        </tr>
                    </tbody>
                </table> <br>
                <div class="alert alert-warning"> Manage user funds:<br> Account balance: how many funds can the user
                    withdraw from the system.<br> Total deposit: how many funds has the user ever deposited to your
                    system.<br> Total active deposit: the whole current deposit of this user.<br> Total earnings: how
                    many funds has the user ever earned with your system.<br> Total withdrawals: how many funds has the
                    user ever withdrawn from system.<br> Total bonus: how many funds has the administrator ever added to
                    the user account as a bonus.<br> Total penalty: how many funds has the administrator ever deleted
                    from the user account as a penalty.<br> Actions:<br> Transactions history - you can check the
                    transactions history for this user.<br> Active deposits/Transactions history - you can check the
                    deposits history for this user.<br> Earnings history - you can check the earnings history for this
                    user.<br> Withdrawals history - you can check the withdrawals history for this user.<br> Process
                    withdrawals - you can withdraw funds by clicking this link if a user asked you for a withdrawal.<br>
                    Bonuses history - you can check the bonuses history for this user.<br>
                    Penalties history - you can check the penalties history for this user.<br> Add a bonus and add a
                    penalty - add a bonus or a penalty to this user.<br> </div>
            </td>
        </tr>
    </tbody>
</table>



{include file='admin/footer.tpl'}