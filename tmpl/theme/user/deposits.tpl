{assign var="active" value="deposits"}
{extends file="theme/user/layout.tpl"}
{block name=title}Deposits{/block}
{block name=body}
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Deposits</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Make a deposit</h4>
                        <p class="card-description">
                            Fill out the form below to make a new deposit now.
                        </p>
                        <form id="new_deposit" class="forms-sample" action="{$route->urlFor('user-deposits')}" method="post"
                            onsubmit="return ajaxPost('new_deposit')">
                            <div class="form-group">
                                <label for="planID">Plan</label>
                                <select id="planID" name="planID" class="form-control">
                                    {foreach $data.plans as $plan}
                                        <option value="{$plan->ID}">
                                            {$plan->title}: ${$plan->minimum} -
                                            {if empty($plan->maximum)}above{else}${$plan->maximum}{/if}
                                        </option>
                                    {/foreach}
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="amount">Deposit Amount</label>
                                <input class="form-control" id="amount" type="number" name="amount" required />
                            </div>
                            <div class="form-group">
                                <label for="cryptoCurrency">Payment Method</label>
                                <select id="cryptoCurrency" name="cryptoCurrency" class="form-control">
                                    {foreach $data.activeCurrencies as $currency}
                                        <option value="{$currency}">
                                            {$currency|upper}
                                        </option>
                                    {/foreach}
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Make Deposit</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Deposit history</h4>
                        <p class="card-description">
                            Below is a list of deposits you've made so far and their statuses.
                        </p>
                        {include file="theme/user/components/deposits-table.tpl" localData=$data.deposits.data totalRows=$data.deposits.total_rows}
                    </div>
                </div>
            </div>
        </div>
    </div>
{/block}