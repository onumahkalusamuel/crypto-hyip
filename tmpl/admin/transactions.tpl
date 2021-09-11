{include file='admin/header.tpl' pageTitle='Transactions'}
{assign var=localData value=$data.transactions.data}
{assign var=totalRows value=$data.transactions.total_rows}

<table class="forTexts" width="100%" height="100%" cellspacing="0" cellpadding="10" border="0">
    <tbody>
        <tr>
            <td width="100%" valign="top" height="100%">
                <h3>Transactions History:</h3>
                <style>
                    .trn_user a.badge {
                        display: none;
                        text-decoration: none;
                    }

                    .trn_user:hover a.badge {
                        display: inline;
                    }
                </style>
                <form method="get">
                    <table class="form controls nosize">
                        <tbody>
                            <tr>
                                <td>
                                    <select name="logType" class="inpts">
                                        <option {if $smarty.get.logType == ""}selected{/if} value="">All Transactions
                                        </option>
                                        <option {if $smarty.get.logType == "deposit"}selected{/if} value="deposit">
                                            Deposit</option>
                                        <option {if $smarty.get.logType == "deposit-earning"}selected{/if} value="deposit-earning">
                                            Deposit Earning</option>
                                        <option {if $smarty.get.logType == "deposit-release"}selected{/if} value="deposit-release">
                                            Deposit Release</option>
                                        <option {if $smarty.get.logType == "bonus"}selected{/if} value="bonus">Bonus
                                        </option>
                                        <option {if $smarty.get.logType == "penalty"}selected{/if} value="penalty">
                                            Penalty</option>
                                        <option {if $smarty.get.logType == "earning"}selected{/if} value="earning">
                                            Earning</option>
                                        <option {if $smarty.get.logType == "withdrawal"}selected{/if}
                                            value="withdrawal">Withdrawal</option>
                                        <option {if $smarty.get.logType == "referral"}selected{/if} value="referral">
                                            Referral commission</option>
                                    </select><br>
                                    <select name="cryptoCurrency" class="inpts">
                                        <option {if $smarty.get.cryptoCurrency == ""}selected{/if} value="">All
                                            eCurrencies</option>
                                        <option {if $smarty.get.cryptoCurrency == "btc"}selected{/if} value="btc">
                                            Bitcoin</option>
                                        <option {if $smarty.get.cryptoCurrency == "eth"}selected{/if} value="eth">
                                            Etherium</option>
                                        <option {if $smarty.get.cryptoCurrency == "doge"}selected{/if} value="doge">
                                            Dogecoin</option>
                                        <option {if $smarty.get.cryptoCurrency == "ltc"}selected{/if} value="ltc">
                                            Litecoin</option>
                                    </select>
                                </td>
                                <td style="text-align:right;">
                                    <div style="margin-bottom:5px;">From: <input name="from" type="date"
                                            class="inpts" /></div>
                                    To: <input name="to" type="date" class="inpts" />
                                </td>
                                <td style="text-align:right"> Per Page:
                                    <select name="rpp" class="inpts nosize">
                                        <option {if $smarty.get.rpp == 20}selected{/if}>20</option>
                                        <option {if $smarty.get.rpp == 50}selected{/if}>50</option>
                                        <option {if $smarty.get.rpp == 100}selected{/if}>100</option>
                                    </select> <br />
                                    <input type="submit" value="Go" class="sbmt">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
                <table class="list">
                    <tbody>
                        <tr>
                            <th>UserName</th>
                            <th>Amount</th>
                            <th>Date</th>
                        </tr>
                        {foreach from=$localData key=key item=item}
                            <tr class="{if $key%2==0}row2{else}row1{/if}">
                                <td class="trn_user">
                                    <b>{$item->userName}</b>
                                    <a class="badge badge-danger" target="_blank"
                                        href="{$route->urlFor('admin-view-user', ['id'=>$item->userID])}">edit</a>
                                    <a class="badge badge-info" target="_blank"
                                        href="{$route->urlFor('admin-view-user', ['id'=>$item->userID])}">manage</a>
                                    <br>
                                    <small style="color:gray"><b>{$item->logType|capitalize}:</b>
                                        &nbsp;{$item->transactionDetails}</small>
                                </td>
                                <td nowrap="" align="right" class="text-{$item->logType}">
                                    <b>${$item->amount}</b>
                                    <img src="currencies/{$item->cryptoCurrency}.gif" hspace="1" height="17"
                                        align="absmiddle">
                                </td>
                                <td align="center"><small>{$item->createdAt}</small></td>
                            </tr>
                        {/foreach}
                    </tbody>
                </table> <br>
                {include file="admin/components/pagination.tpl" total_rows=$totalRows total_retrieved=$localData|@count}
            </td>
        </tr>
    </tbody>
</table>

{include file='admin/footer.tpl'}