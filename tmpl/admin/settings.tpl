{include file='admin/header.tpl' pageTitle='Settings'}

{assign var=settings value=$data.settings}

<table class="forTexts" width="100%" height="100%" cellspacing="0" cellpadding="10" border="0">
    <tbody>
        <tr>
            <td width="100%" valign="top" height="100%">
                <h3>Main Settings:</h3>
                <form style="display:none" method="post" action="{$route->urlFor('admin-settings')}">
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
                {* <br /><br /> *}
                <form method="post" action="{$route->urlFor('admin-update-settings')}">
                    <table class="form settings">
                        <tbody>
                            <tr>
                                <th colspan="2">Other Settings:</th>
                            </tr>
                            <tr>
                                <th>Active Currencies:</th>
                                <td>
                                    {foreach $activeCurrencies as $currency}
                                        <label>
                                            <input value="{$currency}" disabled type="checkbox" checked />
                                            {$currency|upper}
                                        </label>
                                    {/foreach}
                                </td>
                            </tr>
                            {foreach $activeCurrencies as $currency}
                                <tr>
                                    <th>{$currency|upper} Deposit Address:</th>
                                    <td>
                                        {assign var=wallet value=$currency}
                                        <input readonly disabled type="text" style="background-color:#0004"
                                            value="{$depositAddresses[$currency]}" class="inpts">
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
                                <th>Google Track ID:</th>
                                <td><input type="text" name="googleTrackId" value="{$settings.googleTrackId}"
                                        class="inpts"></td>
                            </tr>
                            <tr>
                                <th>Header Code:</th>
                                <td>
                                    <textarea rows=5 name="headerCode" class="inpts">{$settings.headerCode}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <th>Footer Code:</th>
                                <td>
                                    <textarea rows=5 name="footerCode" class="inpts">{$settings.footerCode}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <th>Enter Password:</th>
                                <td><input type="password" name="confirmPassword" class="inpts"></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="alert alert-warning">
                                        <strong>Active Currencies:</strong> The active currencies
                                        will be seen by the users when they want to make payment. Please make sure you
                                        fill the address of currencies you want to be active.<br />
                                        <strong>Google Track ID:</strong> ID for google analytics.<br />
                                        <strong>Header Code:</strong> Enter chat app codes that need to be in the head
                                        section of the page.<br />
                                        <strong>Footer Code:</strong> Enter chat app codes or any other code that needs
                                        to be before the closing html tag.
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