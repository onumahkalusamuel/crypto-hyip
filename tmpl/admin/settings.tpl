{include file='admin/header.tpl' pageTitle='Settings'}

{assign var=settings value=$data.settings}
{assign var=activeCurrencies value=","|explode:$settings.activeCurrencies}

<table class="forTexts" width="100%" height="100%" cellspacing="0" cellpadding="10" border="0">
    <tbody>
        <tr>
            <td width="100%" valign="top" height="100%">
                <h3>Main Settings:</h3>
                <form method="post" action="{$route->urlFor('admin-update-admin')}">
                    <table class="form settings">
                        <tbody>
                            <tr>
                                <th colspan="2">Administrator login settings:</th>
                            </tr>
                            <tr>
                                <th>Generate OTP:</th>
                                <td><a href="{$route->urlFor('admin-update-admin-otp')}" class="link strong">Click here
                                        to generate OTP</a></td>
                            </tr>
                            <tr>
                                <th>New Password:</th>
                                <td><input type="password" name="newPassword" value="" class="inpts"></td>
                            </tr>
                            <tr>
                                <th>Retype New Password:</th>
                                <td><input type="password" name="newPasswordAgain" value="" class="inpts"></td>
                            </tr>
                            <tr>
                                <th>Old Password:</th>
                                <td><input type="password" name="oldPassword" value="" class="inpts"></td>
                            </tr>
                            <tr>
                                <th>OTP:</th>
                                <td><input type="password" name="OTP" value="" class="inpts"></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="alert alert-warning"> To change admin password, generate OTP by clicking
                                        on the blue button above. The OTP
                                        will be sent to admin email and will expire in <strong>5 minutes</strong>.<br>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <center> <input type="submit" value="Update" class="btn btn-success sbmt"> </center>
                </form>
                <br /><br />
                <form method="post" action="{$route->urlFor('admin-update-settings')}">
                    <table class="form settings">
                        <tbody>
                            <tr>
                                <th colspan="2">Other Settings:</th>
                            </tr>
                            <tr>
                                <th>Active Currencies:</th>
                                <td>
                                    {foreach $allCurrencies as $currency}
                                        <label>
                                            <input value="{$currency}" type="checkbox" name="activeCurrencies[{$currency}]"
                                                {if $currency|@in_array:$activeCurrencies} checked {/if} />
                                            {$currency|upper}
                                        </label>
                                    {/foreach}
                                </td>
                            </tr>
                            {foreach $allCurrencies as $currency}
                                <tr>
                                    <th>{$currency|upper} Deposit Address:</th>
                                    <td>
                                        {assign var=wallet value=$currency|cat:'DepositAddress'}
                                        <input type="text" name="{$wallet}" value="{$settings[$wallet]}" class="inpts">
                                    </td>
                                </tr>
                            {/foreach}

                            <tr>
                                <th>Minimum Withdraw Amount:</th>
                                <td><input type="text" name="minWithdrawal" value="{$settings.minWithdrawal}"
                                        class="inpts"></td>
                            </tr>
                            <tr>
                                <th>Pay Referral Bonus:</th>
                                <td>
                                    <select name="payReferral" class="inpts">
                                        <option {if $settings.payReferral == "0"}selected{/if}value="0">No</option>
                                        <option {if $settings.payReferral == "1"}selected{/if} value="1">Yes</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Enter Password:</th>
                                <td><input type="text" name="confirmPassword" class="inpts"></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="alert alert-warning"> Active Currencies: The currencies selected here
                                        will be seen by the users when they want to make payment. Please make sure you
                                        fill in their respective deposit addresses.<br>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <center> <input type="submit" value="Update" class="btn btn-success sbmt"> </center>
                </form>
            </td>
        </tr>
    </tbody>
</table>

{include file='admin/footer.tpl'}