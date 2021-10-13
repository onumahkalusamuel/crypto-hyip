{assign var="active" value="deposits"}
{extends file="theme/user/layout.tpl"}
{block name=title}Deposit{/block}

{assign var=deposit value=$data.deposit}
{assign var=transactions value=$data.trailLog}

{assign var=check value=$deposit->cryptoCurrency}

{if "btc" === $check}
    {assign var=protocol value="bitcoin"}
    {assign var=depositAddress value=$sysSettings.btcDepositAddress}
{elseif "eth" === $check}
    {assign var=protocol value="etherium"}
    {assign var=depositAddress value=$sysSettings.ethDepositAddress}
{elseif "ltc" === $check}
    {assign var=protocol value="litecoin"}
    {assign var=depositAddress value=$sysSettings.ltcDepositAddress}
{elseif "doge" === $check}
    {assign var=protocol value="dogecoin"}
    {assign var=depositAddress value=$sysSettings.dogeDepositAddress}
{else}
    {assign var=protocol value="bitcoin"}
    {assign var=depositAddress value=$sysSettings.btcDepositAddress}
{/if}

{assign var=paymentLink value="https://www.bitcoinqrcodemaker.com/api/?style={$protocol}&amount={$deposit->cryptoAmount}&address={$depositAddress}"}

{block name=body}
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Deposit #{$deposit->ID}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Deposit details</h4>
                        <p class="card-description">
                            Here are the details of this deposit.
                        </p>
                        <div>
                            <div class="form-group">
                                <label for="planID"></label>
                                {if $deposit->cryptoCurrency ne "pm"}
                                    <img src="{$paymentLink}" alt="QR CODE"><br />
                                {/if}
                                <p>
                                    {if $deposit->depositStatus === "pending"}
                                        {if $deposit->cryptoCurrency === "pm"}
                                            Make a payment of <strong>{$deposit->cryptoAmount} USD</strong> to
                                            <strong>{$deposit->depositAddress}</strong> to complete your deposit.
                                        {else}
                                            <strong>Click on Address</strong>
                                            OR
                                            <strong>Scan QR-Code</strong>
                                            to make payment. If you do not have a supported
                                            wallet,
                                            <strong>Copy the address</strong>
                                            and complete payment from your wallet. Send exactly
                                            <strong>{$deposit->cryptoAmount} {$deposit->cryptoCurrency|upper} </strong> to
                                            <a
                                                href="{$protocol}:{$deposit->depositAddress}?amount={$deposit->cryptoAmount}&message={$deposit->transactionID}"><strong
                                                    style="line-break: anywhere;">{$deposit->depositAddress}</strong></a>
                                        {/if}
                                    </p>
                                {else}
                                    <p class="desc mb-10">Payment received and processed.</p>
                                {/if}
                            </div>
                            <div class="form-group">
                                <label>Transaction ID</label>
                                <input class="form-control" readonly value="{$deposit->transactionID}" />
                            </div>
                            <div class="form-group">
                                <label>User Name</label>
                                <input class="form-control" readonly value="{$deposit->userName}" />
                            </div>
                            <div class="form-group">
                                <label>Plan</label>
                                <input class="form-control" readonly value="{$deposit->planTitle}" />
                            </div>
                            <div class="form-group">
                                <label>Principal Return</label>
                                <input class="form-control" readonly value="Yes" />
                            </div>
                            <div class="form-group">
                                <label>Principal Withdrawal</label>
                                <input class="form-control" readonly value="On Maturity" />
                            </div>
                            <div class="form-group">
                                <label>Credit Amount</label>
                                <input class="form-control" readonly value="${$deposit->amount|string_format:"%.2f"}" />
                            </div>
                            <div class="form-group">
                                <label>Deposit Fees</label>
                                <input class="form-control" readonly value="0.00% + $0.00 (min. $0.00 max. $0.00)" />
                            </div>
                            <div class="form-group">
                                <label>Deposit Amount</label>
                                <input class="form-control" readonly value="${$deposit->amount|string_format:"%.2f"}" />
                            </div>
                            <div class="form-group">
                                <label>Payment Method</label>
                                <input class="form-control" readonly value="{$deposit->cryptoCurrency|upper}" />
                            </div>
                            <div class="form-group">
                                <label>Payment Amount</label>
                                <input class="form-control" readonly
                                    value="{if $deposit->cryptoCurrency eq "pm"}${/if}{$deposit->cryptoAmount}" />
                            </div>
                            <div class="form-group">
                                <label>Deposit Status</label>
                                <input class="form-control" readonly value="{$deposit->depositStatus}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Deposit #{$deposit->ID} logs</h4>
                        <p class="card-description">
                            Below is a log of transactions related to this deposit.
                        </p>
                        {include file="theme/user/components/account-logs-table-only.tpl" transactions=$transactions}
                    </div>
                </div>
            </div>
        </div>
    </div>
{/block}