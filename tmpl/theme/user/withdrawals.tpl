{assign var="active" value="withdrawals"}
{extends file="theme/user/layout.tpl"}
{block name=title}Withdrawals{/block}
{block name=body}
    <div class="nk-block">
        <div class="container">
            <div class="row mb-5">
                <h4>Make Withdrawal</h4>
                <form id="new_withdrawal" class="container p-0" action="{$route->urlFor('user-withdrawals')}" method="post"
                    onsubmit="return ajaxPost('new_withdrawal')">
                    <div class="content-container">
                        <div class="item">
                            <div class="title">Minimum Withdrawal Amount:</div>
                            <div class="content"><strong>${$data.min_withdrawal}</strong>.<br />
                                <small><em>You must have the minimum withdrawal amount for withdrawal to be active.</em></small>
                            </div>
                        </div>

                        <div class="item">
                            <div class="title">Select Wallet Currency:</div>
                            <div class="content">
                                <select id="cryptoCurrency" name="cryptoCurrency" class="form-control" required>
                                    {foreach $data.wallets as $wa}
                                        <option
                                            {if $wa.balance lt $data.min_withdrawal || $wa.addressIsSet ne 'true'}disabled{/if}
                                            value="{$wa.ID}">
                                            {$wa.title} (${$wa.balance})
                                        </option>
                                    {/foreach}
                                </select>
                            </div>
                        </div>
                        <div class="item">
                            <div class="title">Withdrawal Amount</div>
                            <div class="content">
                                <input class="form-control" id="amount" type="number" name="amount"
                                    min="{$data.min_withdrawal}" required />
                            </div>
                        </div>
                        <div class="item">
                            <div class="title"></div>
                            <div class="content">
                                <button type="submit" class="btn btn-primary">Make Withdrawal</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="row mb-5">
                <h4>Withdrawal History</h4>
                {include file="theme/user/components/withdrawals-table.tpl" localData=$data.withdrawals.data totalRows=$data.withdrawals.total_rows}
            </div>
        </div>
    </div>
{/block}