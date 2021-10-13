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
                            <tr class="{if $key % 2 == 0}row1{else}row2{/if}">
                                <td valign="top">
                                    <table class="list sub" width="100%">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <b class="username">
                                                        <a href="{$route->urlFor('admin-view-user-funds', ['id' => $user->ID])}"
                                                            class="link" style="margin-bottom:2px;">{$user->userName}</a>
                                                    </b>
                                                    <span class="badge badge-success">Active</span> <br>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Name: <i>{$user->fullName}</i></td>
                                            </tr>
                                            <tr>
                                                <td>Since: {$user->createdAt}</td>
                                            </tr>
                                            {if $user->upliner ne ""}
                                                <tr>
                                                    <td style="color:blue">Upline: <i>{$user->upliner}</i></td>
                                                </tr>
                                            {/if}
                                        </tbody>
                                    </table>
                                </td>
                                <td>
                                    <table class="list sub" width="100%">
                                        <tbody>
                                            {foreach from=$activeCurrencies item=currency}
                                                <tr>
                                                    <td style="width:50%">{$currency|upper}:</td>
                                                    <td>
                                                        {assign var=balance value=$currency|cat:'Balance'}
                                                        <b style="color:gray">${$user->$balance|string_format:"%.2f"}</b>
                                                    </td>
                                                </tr>
                                            {/foreach}
                                        </tbody>
                                    </table>
                                </td>
                                <td>
                                    <a href="{$route->urlFor('admin-view-user', ['id' => $user->ID])}"
                                        class="sbmt btn-sm btn-success" style="margin-bottom:2px;">edit</a><br>
                                    <a href="{$route->urlFor('admin-view-user-funds', ['id' => $user->ID])}"
                                        class="sbmt btn-sm btn-info" style="margin-bottom:2px;">funds</a><br>
                                    <a href="{$route->urlFor('admin-delete-user', ['id' => $user->ID])}"
                                        onclick="return confirm('Delete this user? This action cannot be undone.');"
                                        class="sbmt btn-sm btn-danger" style="margin-bottom:2px;">delete</a>
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