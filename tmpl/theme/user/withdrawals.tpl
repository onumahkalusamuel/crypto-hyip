{assign var="active" value="withdrawals"}
{extends file="theme/user/layout.tpl"}
{block name=title}Withdrawals{/block}
{block name=body}

    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Withdrawals</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Place a withdrawal request.</h4>
                        <p class="card-description">
                            Fill out the form below to place a new withdrawal request. Mininum withrawal amount is
                            <strong>${$data.min_withdrawal}</strong> Only balances that are up to the minimum will be
                            available from the dropdown below.
                        </p>
                        <form id="new_withdrawal" class="forms-sample" action="{$route->urlFor('user-withdrawals')}"
                            method="post" onsubmit="return ajaxPost('new_withdrawal')">
                            <div class="form-group">
                                <label for="planID">Select Wallet</label>
                                <select id="cryptoCurrency" name="cryptoCurrency" class="form-control" required>
                                    {foreach $data.wallets as $wa}
                                        <option {if $wa.balance lt $data.min_withdrawal || $wa.addressIsSet ne 'true'}disabled
                                            {/if} value="{$wa.ID}">
                                            {$wa.title} (${$wa.balance})
                                        </option>
                                    {/foreach}
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="amount">Withdrawal Amount</label>
                                <input class="form-control" id="amount" type="number" name="amount"
                                    min="{$data.min_withdrawal}" required />
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Make Withdrawal</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Withdrawals history</h4>
                        <p class="card-description">
                            Below is a list of your withdrawals so far.
                        </p>
                        {include file="theme/user/components/withdrawals-table.tpl" localData=$data.withdrawals.data totalRows=$data.withdrawals.total_rows}
                    </div>
                </div>
            </div>
        </div>
    </div>

{/block}