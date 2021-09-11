{include file='admin/header.tpl' pageTitle='Users'}

{assign var=localData value=$data.users.data}
{assign var=totalRows value=$data.users.total_rows}

<table class="forTexts" width="100%" height="100%" cellspacing="0" cellpadding="10" border="0">
    <tbody>
        <tr>
            <td width="100%" valign="top" height="100%">
                <h3>Users: <a class="sbmt btn btn-success" href="{$route->urlFor('admin-view-user', ['id'=>'new'])}">Add
                        User</a>
                </h3>
                <form method="get">
                    {foreach $smarty.get as $key => $value}
                        {if $key|in_array:['query', 'from', 'to', 'rpp']}
                            <input name='{$key}' value='{$value}' hidden />
                        {/if}
                    {/foreach}
                    <table class="form controls nosize">
                        <tbody>
                            <tr>
                                <td>Search:</td>
                                <td>
                                    <input type="text" name="query" value="{$smarty.get.query}" class="inpts nosize"
                                        size="30">
                                </td>
                                <td> Per Page: <select name="rpp" class="inpts nosize">
                                        <option {if $smarty.get.rpp == 20}selected{/if}>20</option>
                                        <option {if $smarty.get.rpp == 50}selected{/if}>50</option>
                                        <option {if $smarty.get.rpp == 100}selected{/if}>100</option>
                                    </select> </td>
                                <td style="text-align:right"> <input type="submit" value="Apply" class="sbmt"> </td>
                            </tr>
                        </tbody>
                    </table> <br>
                </form>
                <table class="list">
                    <tbody>
                        <tr>
                            <th>User</th>
                            <th>Balances</th>
                            <th>Actions</th>
                        </tr>
                        {foreach from=$localData item=user key=key}
                            <tr class="{if $key % 2 == 0}row2{else}row1{/if}">
                                <td valign="top">
                                    <table class="list sub" width="100%">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <b class="username">{$user->userName}</b>
                                                    <span class="badge badge-success">Active</span> <br>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Name: <i>{$user->fullName}</i></td>
                                            </tr>
                                            <tr>
                                                <td>Since: {$user->createdAt}</td>
                                            </tr>
                                            <tr>
                                                {* <td>Upline: <a href="?a=user_refs&amp;id=2">demo</a></td> *}
                                            </tr>
                                            <tr>
                                                <td> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>
                                    <table class="list sub" width="100%">
                                        <tbody>
                                            <tr>
                                                <td style="width:50%">BTC:</td>
                                                <td>
                                                    <b style="color:gray">${$user->btcBalance|string_format:"%.2f"}</b>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>ETH:</td>
                                                <td>
                                                    <b style="color:gray">${$user->ethBalance|string_format:"%.2f"}</b>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>DOGE:</td>
                                                <td> <b style="color:gray">${$user->dogeBalance|string_format:"%.2f"}</b> </td>
                                            </tr>
                                            <tr>
                                                <td>LTC:</td>
                                                <td> <b style="color:gray">${$user->ltcBalance|string_format:"%.2f"}</b> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>
                                    <a href="{$route->urlFor('admin-view-user', ['id' => $user->ID])}"
                                        class="sbmt btn-sm btn-success" style="margin-bottom:2px;">edit</a><br>
                                    <a href="{$route->urlFor('admin-view-user-funds', ['id' => $user->ID])}"
                                        class="sbmt btn-sm btn-info" style="margin-bottom:2px;">funds</a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4"> </td>
                            </tr>
                        {/foreach}
                    </tbody>
                </table><br>
                {include file='admin/components/pagination.tpl' total_rows=$totalRows total_retrieved=$localData|@count}


                <a class="sbmt btn btn-success" href="{$route->urlFor('admin-view-user', ['id'=>'new'])}">Add User</a>
                <br> <br>
                <div class="alert alert-warning">
                    Members list:<br><br> Members list splits your members to 2 types: Active and Disabled.<br>
                    Active: User can login and receive earnings if deposited in the system.<br>
                    Disabled: User can not login and cannot receive any earnings.<br> <br>

                    The top left search form
                    helps you to search a user by the nickname or e-mail. You can also enter a part of a nickname or
                    e-mail to search users.<br><br>
                    Edit user information: click on the "Edit" button next to a user<br>
                    Delete user: click on the "delete" button and confirm this action;<br>
                    Send e-mail to user: click on the "e-mail" button and send e-mail to user.<br>
"Manage funds": button will help you to check any user's history and change his funds.<br>
                    Add a new Member: click on the "Add a new member&amp; button.
                    You&amp;ll see the form for adding a new member. </div>
            </td>
        </tr>
    </tbody>
</table>

{include file='admin/footer.tpl'}
