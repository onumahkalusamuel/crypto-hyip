{include file='admin/header.tpl' pageTitle='Dashboard'}
{assign var=users value=$data.users}
{assign var=deposits value=$data.deposits}
{assign var=withdrawals value=$data.withdrawals}
{assign var=plans value=$data.plans}
{assign var=transactions value=$data.transactions}
<h3>Information</h3>

<table class="form">
    <tbody>
        <tr>
            <th>Users:</th>
            <td>
                <a data-hlp="Total users registered in the system" class="hlp badge badge-info">{$users.total}</a>
                <a data-hlp="How many active users does your system contain"
                    class="hlp badge badge-success">{$users.active}
                    {if $users.total !==0}
                        ({($users.active / $users.total * 100)|string_format:"%.2f"}%)
                    {/if}
                </a>
                <a data-hlp="How many users are disabled (cannot login and can not earn any funds from principal)"
                    class="hlp badge badge-danger">
                    {$users.blocked}
                    {if $users.total !==0}
                        ({($users.blocked / $users.total * 100)|string_format:"%.2f"}%)
                    {/if}
                </a>
            </td>
        </tr>
        <tr>
            <th>Investment Packages:</th>
            <td> <a data-hlp="Active investment packages number. Active users earn if they have deposited funds in these packages."
                    class="hlp badge badge-success">{$plans.total}</a> </td>
        </tr>
        <tr>
            <th>Withdrawals</th>
            <td>
                <table>
                    <tbody>
                        <tr>
                            <th>Currency</th>
                            <th style="text-align: left;">Status</th>
                            <th style="text-align: left;">Total</th>
                            <th style="text-align: left;">Amount</th>
                        </tr>
                        {foreach from=$withdrawals item=item key=key}
                            <tr class="{if $key % 2}row2{else}row1{/if}">
                                <th><img src="currencies/{$item->currency}.gif" /></th>
                                <td>
                                    <a class="link strong"
                                        href="{$route->urlFor('admin-withdrawals', [], ['withdrawalStatus'=>$item->status])}">
                                        {$item->status|capitalize}
                                    </a>
                                </td>
                                <td class="strong">{$item->total}</td>
                                <td class="strong text-{$item->status}">${$item->amount}</td>
                            </tr>
                        {/foreach}

                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <th>Deposits</th>
            <td>
                <table>
                    <tbody>
                        <tr>
                            <th>Currency</th>
                            <th style="text-align: left;">Status</th>
                            <th style="text-align: left;">Total</th>
                            <th style="text-align: left;">Amount</th>
                        </tr>
                        {foreach from=$deposits item=item key=key}
                            <tr class="{if $key % 2}row2{else}row1{/if}">
                                <th><img src="currencies/{$item->currency}.gif" /></th>
                                <td>
                                    <a class="link strong"
                                        href="{$route->urlFor('admin-deposits', [], ['depositStatus'=>$item->status])}">
                                        {$item->status|capitalize}
                                    </a>
                                </td>
                                <td class="strong">{$item->total}</td>
                                <td class="strong text-{$item->status}">${$item->amount}</td>
                            </tr>
                        {/foreach}

                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <th>Transactions</th>
            <td>
                <table>
                    <tbody>
                        <tr>
                            <th>Currency</th>
                            <th style="text-align: left;">Type</th>
                            <th style="text-align: left;">Total</th>
                            <th style="text-align: left;">Amount</th>
                        </tr>
                        {foreach from=$transactions item=item key=key}
                            <tr class="{if $key % 2}row2{else}row1{/if}">
                                <th><img src="currencies/{$item->currency}.gif" /></th>
                                <td>
                                    <a class="link strong text-{$item->type}"
                                        href="{$route->urlFor('admin-transactions', [], ['logType'=>$item->type])}">
                                        {$item->type|capitalize}
                                    </a>
                                </td>
                                <td class="strong">{$item->total}</td>
                                <td class="strong text-{$item->type}">${$item->amount}</td>
                            </tr>
                        {/foreach}

                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>


<div class="alert alert-warning">
    Welcome to the Crypto-HYIP Pro Admin Area!<br>
    You can see help messages on almost all pages of the admin area in this part.<br> <br>
    You can see how many members are registered in the system on this page.<br>
    System supports 2 types of users:<br>
    <li>Active users. These users can login to the members area and receive earnings.</li>
    <li>Disabled users. These users can not login to the members area and will not receive any earnings.</li> <br>
    User becomes active when registering and only administrator can change status of any registered user. You can see
    how many users are active and disabled in the system at the top of this page. <br> <br>
    Investment packages:<br> You can create unlimited sets of investment packages with any settings and payout
    options<br><br>
</div>

{include file='admin/footer.tpl'}