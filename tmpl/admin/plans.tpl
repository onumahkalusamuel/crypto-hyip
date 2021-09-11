{include file='admin/header.tpl' pageTitle='Plans'}
{assign var=plans value=$data.plans}

<h3>Plans</h3>

<table width="100%" cellspacing="1" cellpadding="2" border="0">
    <tbody>
        <tr>
            <td colspan="4"><b>Available Investment Packages:</b></td>
        </tr>
        <tr>
            <td bgcolor="FFC982" align="center"><b>Package name</b></td>
            <td bgcolor="FFC982" align="center"><b>Deposit (US$)</b></td>
            <td bgcolor="FFC982" align="center"><b>Details</b></td>
            <td bgcolor="FFC982" align="center"><b>-</b></td>
        </tr>
        {foreach from=$plans item=plan key=key}
            <tr class="{if $key % 2 == 0}row1{else}row2{/if}">
                <td><strong class="font-18">
                        {$plan->title}
                    </strong>
                    {if $plan->hasBadge == 1}
                        <small class="badge badge-approved">Featured</small>
                    {/if}
                </td>
                <td>
                    ${$plan->minimum} - {if $plan->maximum == 0}above{else}${$plan->maximum}{/if}
                </td>
                <td>
                    {$plan->percentage}%
                    {if $plan->profitFrequency === 'end'}
                        ROI at end of plan
                    {else}
                        {$plan->profitFrequency} ROI
                    {/if}
                    <br />
                    {$plan->duration} {$plan->durationType} duration
                    <br />
                    {$plan->referralPercentage}% referral commission
                </td>
                <td class="menutxt" bgcolor="FFF9B3" align="right">
                    <a href="{$route->urlFor('admin-view-plan', ['id'=> $plan->ID])}">[edit]</a>
                    <a href="{$route->urlFor('admin-delete-plan', ['id' => $plan->ID])}"
                        onclick="return deleteRecord()">[delete]</a>
                </td>
            </tr>
        {/foreach}
    </tbody>
</table>

<br />

<table width="100%" cellspacing="0" cellpadding="0" border="0">
    <tbody>
        <tr>
            <td>
                <form method="get" action="{$route->urlFor('admin-view-plan', ['id'=> 'new'])}">
                    <input type="submit" value="Add a new Investment Package" class="sbmt" size="15">
                </form>
            </td>
            <td align="right">
            </td>
        </tr>
    </tbody>
</table>

<br />

<div class="alert alert-warning"> Investment packages:<br>
    You can create unlimited sets of investment packages with any settings.<br><br>
    Here you can view, edit and delete your packages and plans.
</div>


{include file='admin/footer.tpl'}