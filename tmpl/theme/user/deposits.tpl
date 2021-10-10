{assign var="active" value="deposits"}
{extends file="theme/user/layout.tpl"}
{block name=title}Deposits{/block}
{block name=body}

    <div class="nk-block">
        <div class="container">
            <div class="row mb-5">
                <h4 class="section-title">Make Deposit</h4>
                <form id="new_deposit" class="container p-0" action="{$route->urlFor('user-deposits')}" method="post"
                    onsubmit="return ajaxPost('new_deposit')">
                    <div class="content-container">
                        <div class="item">
                            <div class="title">Plan:</div>
                            <div class="content"><select id="planID" name="planID" class="form-control">
                                    {foreach $data.plans as $plan}
                                        <option value="{$plan->ID}">
                                            {$plan->title}: ${$plan->minimum} -
                                            {if empty($plan->maximum)}above{else}${$plan->maximum}{/if}
                                        </option>
                                    {/foreach}
                                </select></div>
                        </div>
                        <div class="item">
                            <div class="title">Deposit Amount:</div>
                            <div class="content">
                                <input class="form-control" id="amount" type="number" name="amount" required />
                            </div>
                        </div>
                        <div class="item">
                            <div class="title">Payment Method:</div>
                            <div class="content">
                                <select id="cryptoCurrency" name="cryptoCurrency" class="form-control">
                                    {foreach $data.activeCurrencies as $currency}
                                        <option value="{$currency}">
                                            {$currency|upper}
                                        </option>
                                    {/foreach}
                                </select>
                            </div>
                        </div>
                        <div class="item">
                            <div class="title"></div>
                            <div class="content">
                                <button type="submit" class="btn btn-primary">Make Deposit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="row mb-5">
                <h4 class="section-title">Deposit History</h4>
                {include file="theme/user/components/deposits-table.tpl" localData=$data.deposits.data totalRows=$data.deposits.total_rows}
            </div>
        </div>
    </div>
{/block}