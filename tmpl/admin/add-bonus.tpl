{include file='admin/header.tpl' pageTitle='Add Bonus'}

<table class="forTexts" width="100%" height="100%" cellspacing="0" cellpadding="10" border="0">
    <tbody>
        <tr>
            <td width="100%" valign="top" height="100%">
                <h3>Add Bonus:</h3>

                <form method="post" action="{$route->urlFor('admin-add-bonus',  ['user_id'=> $user->ID])}">
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
                                <th>Bonus Usage:</th>
                                <td>
                                    <select id="bonusUsage" name="bonusUsage" class="inpts">
                                        <option value="toBalance" selected>Add to available balance</option>
                                        <option value="toDeposit">Use as new investment</option>
                                    </select>
                                </td>
                            </tr>
                            <tr id="planContainer" style="display:none">
                                <th>Investment:</th>
                                <td>
                                    <select name="planID" class="inpts">
                                        {foreach $plans as $plan}
                                            <option value="{$plan->ID}">
                                                {$plan->title} (${$plan->minimum} - {if $plan->maximum ne 0}
                                                ${$plan->maximum}{else}above
                                                {/if})
                                            </option>
                                        {/foreach}
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>
                                    <label><input type="checkbox" name="notifyUserByEmail"> Notify user by email for
                                        this transaction.</label><br />
                                    <label id="payReferralCheckbox" style="display:none"><input type="checkbox"
                                            name="payReferralCommission"> Pay referral commission to upliner if
                                        transaction is eligible and referral bonus payment is turned on in
                                        settings.</label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="alert alert-warning"> Active Currencies: The available currencies are
                                        <strong>btc, eth, doge and ltc.</strong> When entering these values, separate
                                        them with comma
                                        only. <strong>and without spaces.</strong><br>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <center> <input type="submit" value="add bonus" class="btn btn-success sbmt"> </center>
                </form>
            </td>
        </tr>
    </tbody>
</table>

<script type="text/javascript">
    function bonusUsageMonitor() {
        var bonusUsage = document.querySelector('#bonusUsage').value;

        if (bonusUsage == "toDeposit") {
            document.querySelector('#planContainer').style.display = "contents";
            document.querySelector('#payReferralCheckbox').style.display = "contents";
        } else {
            document.querySelector('#planContainer').style.display = "none";
            document.querySelector('#payReferralCheckbox').style.display = "none";
        }
    }

    document.querySelector('#bonusUsage').addEventListener('change', bonusUsageMonitor);
</script>


{include file='admin/footer.tpl'}