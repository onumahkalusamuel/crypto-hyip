{include file='admin/header.tpl' pageTitle='Add Penalty'}

<table class="forTexts" width="100%" height="100%" cellspacing="0" cellpadding="10" border="0">
    <tbody>
        <tr>
            <td width="100%" valign="top" height="100%">
                <h3>Subtract Penalty:</h3>

                <form method="post" action="{$route->urlFor('admin-add-penalty',  ['user_id'=> $user->ID])}">
                    <input type="hidden" name="ID" value="{$user->ID}" />
                    <table class="form settings">
                        <tbody>
                            <tr>
                                <th>Full Name:</th>
                                <td>
                                    {$user->fullName}
                                    <input type="hidden" name="fullName" value="{$user->fullName}" />

                                </td>
                            </tr>
                            <tr>
                                <th>Username:</th>
                                <td>
                                    {$user->userName}
                                    <input type="hidden" name="userName" value="{$user->userName}" />

                                </td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td>
                                    {$user->email}
                                    <input type="hidden" name="email" value="{$user->email}" />

                                </td>
                            </tr>
                            <tr>
                                <th>Amount:</th>
                                <td>$ <input type="number" name="amount" class="inpts"></td>
                            </tr>
                            <tr>
                                <th>Crypto Currency:</th>
                                <td>
                                    <select name="cryptoCurrency" class="inpts">
                                        {foreach $currencies as $currency}
                                            <option value="{$currency}">{$currency|upper}</option>
                                        {/foreach}
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Reason for Penalty</th>
                                <td>
                                    <textarea name="reason" class="inpts"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>
                                    <label><input type="checkbox" name="notifyUserByEmail"> Notify user by email for
                                        this transaction.</label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="alert alert-warning"> Subtract Penalty: Enter the details of the penalty. A link
                                        will be sent to admin email to confirm transaction.<br>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <center> <input type="submit" value="subtract penalty" class="btn btn-success sbmt"> </center>
                </form>
            </td>
        </tr>
    </tbody>
</table>

{include file='admin/footer.tpl'}