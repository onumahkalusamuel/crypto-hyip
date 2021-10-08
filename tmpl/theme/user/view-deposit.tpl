{include file='theme/user/header.tpl' pageTitle='Deposits' active="deposits"}

{assign var=deposit value=$data.deposit}
{assign var=transactions value=$data.trailLog}

{assign var=check value=$deposit->cryptoCurrency}

{if "btc" === $check}
    {assign var=protocol value="bitcoin"}
{elseif "eth" === $check}
    {assign var=protocol value="etherium"}
{elseif "ltc" === $check}
    {assign var=protocol value="litecoin"}
{elseif "doge" === $check}
    {assign var=protocol value="dogecoin"}
{else}
    {assign var=protocol value="bitcoin"}
{/if}

{assign var=paymentLink value="https://www.bitcoinqrcodemaker.com/api/?style={$protocol}&amount={$deposit->cryptoAmount}&address={$deposit->depositAddress}"}

<section id="page-title" class="page-title bg-overlay bg-overlay-dark bg-parallax">
    <div class="bg-section">
        <img src="assets/images/page-titles/18.jpg" alt="Background" />
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="title title-6 text-center" style="padding:150px 0 50px">
                    <div class="title--heading">
                        <h1 style="font-size:4em">Deposit</h1>
                    </div>
                    <div class="clearfix"></div>
                    <ol class="breadcrumb">
                        <li><a href="{$route->urlFor('user-dashboard')}">Dashboard</a></li>
                        <li class="active">Deposit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row mb-60">
            <h3 class="section-title">Deposit #{$deposit->ID}</h3>
            <div class="container">
                <div class="content-container">
                    <div class="item">
                        <div class="title"></div>
                        <div class="content">
                            {if $deposit->cryptoCurrency ne "pm"}
                                <img src="{$paymentLink}" alt="QR CODE">
                            {/if}
                            <div class="hlp">
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
                                        <strong>{$deposit->cryptoAmount}</strong>
                                        {$deposit->cryptoCurrency|upper} to
                                        <a class="heading-line-bottom font-14"
                                            href="{$protocol}:{$deposit->depositAddress}?amount={$deposit->cryptoAmount}&message={$deposit->transactionID}"><strong>{$deposit->depositAddress}</strong></a>
                                    {/if}
                                {else}
                                    <p class="desc mb-10">Payment received and processed.</p>
                                {/if}

                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="title">Transaction ID:</div>
                        <div class="content">{$deposit->transactionID}</div>
                    </div>
                    <div class="item">
                        <div class="title">Username:</div>
                        <div class="content">{$deposit->userName}</div>
                    </div>
                    <div class="item">
                        <div class="title">Plan:</div>
                        <div class="content">
                            {$deposit->planTitle}
                        </div>
                    </div>
                    <div class="item">
                        <div class="title">Principal Return:</div>
                        <div class="content">Yes</div>
                    </div>
                    <div class="item">
                        <div class="title">Principal Withdraw:</div>
                        <div class="content">On maturity or deposit release</div>
                    </div>
                    <div class="item">
                        <div class="title">Credit Amount:</div>
                        <div class="content">${$deposit->amount|string_format:"%.2f"}</div>
                    </div>
                    <div class="item">
                        <div class="title">Deposit Fee:</div>
                        <div class="content">0.00% + $0.00 (min. $0.00 max. $0.00)</div>
                    </div>
                    <div class="item">
                        <div class="title">Deposit Amount:</div>
                        <div class="content">${$deposit->amount|string_format:"%.2f"}</div>
                    </div>
                    <div class="item">
                        <div class="title">Payment Method:</div>
                        <div class="content">{$deposit->cryptoCurrency|upper}</div>
                    </div>

                    <div class="item">
                        <div class="title">Payment Amount:</div>
                        <div class="content">{if $deposit->cryptoCurrency eq "pm"}${/if}{$deposit->cryptoAmount}</div>
                    </div>

                    <div class="item">
                        <div class="title">Deposit Status:</div>
                        <div class="content"><small
                                class="badge badge-{$deposit->depositStatus}">{$deposit->depositStatus}</small></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-60">
            <h3 class="section-title">Deposit #{$deposit->ID} Logs</h3>
            {include file="theme/user/components/account-logs-table-only.tpl" transactions=$transactions}
        </div>

    </div>
</section>

{include file='theme/user/footer.tpl'}

<style>
    .pending {
        background-color: #ffc107;
    }

    .approved {
        background-color: #28a745;
    }

    .released {
        background-color: #007bff;
    }
</style>