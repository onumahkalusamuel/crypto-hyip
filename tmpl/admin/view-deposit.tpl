{include file='admin/header.tpl' pageTitle='Deposit'}

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

<table class="forTexts" width="100%" height="100%" cellspacing="0" cellpadding="10" border="0">
    <tbody>
        <tr>
            <td width="100%" valign="top" height="100%">
                <h3>View Deposit:</h3>

                <table class="form settings">
                    <tbody>
                        <tr>
                            <th></th>
                            <td>
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
                                        <p class="desc mb-20">Payment received and processed.</p>
                                    {/if}

                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Transaction ID:</th>
                            <td>
                                {$deposit->transactionID}
                            </td>
                        </tr>
                        <tr>
                            <th>Username:</th>
                            <td>
                                {$deposit->userName}
                            </td>
                        </tr>
                        <tr>
                            <th>Plan:</th>
                            <td>{$deposit->planTitle}</td>
                        </tr>


                        <tr>
                            <th>Principal Return:</th>
                            <td>Yes</td>
                        </tr>


                        <tr>
                            <th>Principal Withdraw</th>
                            <td>On maturity</td>
                        </tr>

                        <tr>
                            <th>Credit Amount:</th>
                            <td>${$deposit->amount|string_format:"%.2f"}</td>
                        </tr>

                        <tr>
                            <th>Deposit Fee</th>
                            <td>0.00% + $0.00 (min. $0.00 max. $0.00)</td>
                        </tr>



                        <tr>
                            <th>Deposit Amount:</th>
                            <td>${$deposit->amount|string_format:"%.2f"}</td>
                        </tr>

                        <tr>
                            <th>Payment Method:</th>
                            <td>{$deposit->cryptoCurrency|upper} &nbsp; <img src="currencies/{$deposit->cryptoCurrency}.gif"></td>
                        </tr>

                        <tr>
                            <th>Payment Amount:</th>
                            <td>{if $deposit->cryptoCurrency eq "pm"}${/if}{$deposit->cryptoAmount}</td>
                        </tr>
                        <tr>
                            <th>Deposit Status:</th>
                            <td><small class="badge badge-{$deposit->depositStatus}">{$deposit->depositStatus}</small>
                            </td>
                        </tr>


                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>

{include file='admin/footer.tpl'}