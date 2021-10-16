{include file='admin/header.tpl' pageTitle='User'}
{assign var=user value=$data.user}
{assign var=activeCurrencies value=$data.activeCurrencies}

<script type="text/javascript" src="assets/nicEdit.js"></script>
<script type="text/javascript">
    bkLib.onDomLoaded(function() { nicEditors.allTextAreas({ fullPanel: true }) });
</script>

<table class="forTexts" width="100%" height="100%" cellspacing="0" cellpadding="10" border="0">
    <tbody>
        <tr>
            <td width="100%" valign="top" height="100%">
                <h3>Edit User:</h3>
                <form method="post">
                    <input type="hidden" name="ID" value="{$user->ID}">
                    <table class="form">
                        <tbody>
                            <tr>
                                <th>Full Name:</th>
                                <td><input type="text" name="fullName" value="{$user->fullName}" class="inpts"
                                        size="30"></td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td><select name="isActive" class="inpts">
                                        <option {if $user->isActive==1}selected{/if} value="1">Active </option>
                                        <option {if $user->isActive==0}selected{/if} value="0">Disabled </option>
                                    </select> </td>
                            </tr>
                            <tr>
                                <th>Username:</th>
                                <td><input type="text" name="userName" value="{$user->userName}" class="inpts"
                                        size="30"></td>
                            </tr>
                            <tr>
                                <th>E-mail:</th>
                                <td><input type="text" name="email" value="{$user->email}" class="inpts" size="30">
                                </td>
                            </tr>
                            <tr>
                                <th>Password:</th>
                                <td><input type="password" name="password" value="" class="inpts" size="30"></td>
                            </tr>
                            <tr>
                                <th>Retype password:</th>
                                <td><input type="password" name="password2" value="" class="inpts" size="30"></td>
                            </tr>
                            {foreach $activeCurrencies as $currency}
                                <tr>
                                    <th>Wallet Address: <img src="currencies/{$currency}.gif" alt="{$currency|upper}"
                                            width="44" height="17" align="absmiddle"></th>
                                    {assign var=wallet value=$currency|cat:"Address" }
                                    <td><input type="text" name="{$wallet}" value="{$user->$wallet}" class="inpts"
                                            size="30"></td>
                                </tr>
                            {/foreach}
                            <tr>
                                <th>Secret Question:</th>
                                <td><input type="text" name="secretQuestion" value="{$user->secretQuestion}"
                                        class="inpts"></td>
                            </tr>
                            <tr>
                                <th>Secret Answer:</th>
                                <td><input type="text" name="secretAnswer" value="{$user->secretAnswer}" class="inpts">
                                </td>
                            </tr>
                            <tr>
                                <th>Auto-withdrawal Enabled:</th>
                                <td> <select name="auto_withdraw" class="inpts">
                                        <option value="0" selected>No</option>
                                        <option value="1" disabled>Yes</option>
                                    </select> </td>
                            </tr>
                            <tr>
                                <th>Admin Note:</th>
                                <td><textarea name="adminNotice" disabled class="inpts"></textarea></td>
                            </tr>
                        </tbody>
                    </table> <br>
                    <center> <input type="submit" value="Save" class="btn btn-success sbmt"> </center>
                </form>
            </td>
        </tr>
    </tbody>
</table>

{include file='admin/footer.tpl'}