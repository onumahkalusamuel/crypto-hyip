{include file='admin/header.tpl' pageTitle='Plan'}

{assign var=plan value=$data.plan}


<table class="forTexts" width="100%" height="100%" cellspacing="0" cellpadding="10" border="0">
    <tbody>
        <tr>
            <td width="100%" valign="top" height="100%">
                <h3>Plan</h3>
                <form method="post" action="">
                    <table class="form settings">
                        <tbody>
                            <tr>
                                <th colspan="2"></th>
                            </tr>
                            <tr>
                                <th>Title:</th>
                                <td><input type="text" name="title" value="{$plan->title}" class="inpts" style="width:98%"></td>
                            </tr>

                            <tr>
                                <th>Featured Plan:</th>
                                <td> <select name="hasBadge" class="inpts">
                                        <option {if $plan->hasBadge == 0}selected{/if} value="0">No
                                        </option>
                                        <option {if $plan->hasBadge == 1}selected{/if} value="1">Yes
                                        </option>
                                    </select>
                                    <div class="alert alert-warning">If set to YES, the plan will receive a FEATURED
                                        badge on the listing pages.</div>
                                </td>
                            </tr>
                            <tr>
                                <th>Minimum Deposit Amount:</th>
                                <td><input type="number" name="minimum" value="{$plan->minimum}" class="inpts"
                                        style="width:98%">
                                </td>
                            </tr>
                            <tr>
                                <th>Maximum Deposit Amount:</th>
                                <td><input type="number" name="maximum" value="{$plan->maximum}" class="inpts"
                                        style="width:98%">
                                    <div class="alert alert-warning">Set to 0 if there is no maximum</div>
                                </td>
                            </tr>
                            <tr>
                                <th>Referral Percentage:</th>
                                <td><input type="number" name="referralPercentage" value="{$plan->referralPercentage}"
                                        class="inpts" style="width:98%">
                                    <div class="alert alert-warning">Percentage an upline will be paid when referral
                                        pays for this plan.</div>
                                </td>
                            </tr>
                            <tr>
                                <th>Interest (percentage/frequency)</th>
                                <td>
                                    <div style="display: flex; padding-bottom:5px;">
                                        <input type="number" name="percentage" value="{$plan->percentage}"
                                            class="inpts">
                                        &nbsp;&nbsp;/&nbsp;&nbsp;
                                        <select name="profitFrequency" class="inpts">
                                            <option {if $plan->profitFrequency == 'end'}selected{/if} value="end">End of
                                                Plan
                                            </option>
                                            <option {if $plan->profitFrequency == 'hourly'}selected{/if} value="hourly">
                                                Hourly
                                            </option>
                                            <option {if $plan->profitFrequency == 'daily'}selected{/if} value="daily">
                                                Daily
                                            </option>
                                            <option {if $plan->profitFrequency == 'weekly'}selected{/if} value="weekly">
                                                Weekly
                                            </option>
                                            <option {if $plan->profitFrequency == 'monthly'}selected{/if}
                                                value="monthly">
                                                Monthly
                                            </option>
                                            <option {if $plan->profitFrequency == 'yearly'}selected{/if} value="yearly">
                                                Yearly
                                            </option>
                                        </select>
                                    </div>
                                    <div class="alert alert-warning">Example: If interest is 10% daily, enter 10 in the
                                        first field, and select daily from the second field
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Plan lifespan:</th>
                                <td>
                                    <div style="display: flex; padding-bottom:5px;">
                                        <input type="number" name="duration" value="{$plan->duration}" class="inpts">
                                        &nbsp;&nbsp;/&nbsp;&nbsp;
                                        <select name="durationType" class="inpts">
                                            <option {if $plan->durationType == 'hour'}selected{/if} value="hour">Hour(s)
                                            </option>
                                            <option {if $plan->durationType == 'day'}selected{/if} value="day">Day(s)
                                            </option>
                                            <option {if $plan->durationType == 'month'}selected{/if} value="month">
                                                Month(s)
                                            </option>
                                            <option {if $plan->durationType == 'year'}selected{/if} value="year">Year(s)
                                            </option>
                                        </select>
                                    </div>
                                    <div class="alert alert-warning"> This is the total lifespan of the plan before the
                                        deposit is automatically released. For example, if plan will last for 3 days,
                                        enter 3 in the first field and select Day(s) from second field
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <center> <input type="submit" value="Submit" class="btn btn-success sbmt"> </center>
                </form>
            </td>
        </tr>
    </tbody>
</table>

{include file='admin/footer.tpl'}