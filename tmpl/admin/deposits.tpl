{include file='admin/header.tpl' pageTitle='Deposits'}

{assign var=localData value=$data.deposits.data}
{assign var=totalRows value=$data.deposits.total_rows}

<table class="forTexts" width="100%" height="100%" cellspacing="0" cellpadding="10" border="0">
    <tbody>
        <tr>
            <td width="100%" valign="top" height="100%">
                <h3>Deposits:</h3>
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
                    {foreach $smarty.get as $key => $value}
                        {if $key|in_array:['depositStatus', 'cryptoCurrency','from', 'to', 'rpp']}
                            <input name='{$key}' value='{$value}' hidden />
                        {/if}
                    {/foreach}
                    <table class="form controls nosize">
                        <tbody>
                            <tr>
                                <td>
                                    <select name="depositStatus" class="inpts">
                                        <option {if $smarty.get.depositStatus == ""}selected{/if} value="">All
                                            Deposits
                                        </option>
                                        <option {if $smarty.get.depositStatus == "approved"}selected{/if}
                                            value="approved">Approved</option>
                                        <option {if $smarty.get.depositStatus == "pending"}selected{/if}
                                            value="pending">
                                            Pending</option>
                                        <option {if $smarty.get.depositStatus == "released"}selected{/if}
                                            value="released">
                                            Released</option>
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
                            <th>-</th>
                        </tr>
                        {foreach from=$localData key=key item=item}
                            <tr class="{if $key%2==0}row2{else}row1{/if}">
                                <td class="trn_user">
                                    <b>{$item->userName}</b>
                                    <br>
                                    {$item->planTitle}<br />
                                    <small class="text-{$item->depositStatus}">
                                        <b>{$item->depositStatus|capitalize}</b>
                                    </small><br />
                                    <small>{$item->createdAt}</small>
                                </td>
                                <td nowrap="" align="right" class="text-{$item->depositStatus}">
                                    <b>${$item->amount}</b>
                                    <img src="currencies/{$item->cryptoCurrency}.gif" hspace="1" height="17"
                                        align="absmiddle">
                                </td>
                                <td align="right">
                                    <a href="{$route->urlFor('admin-view-deposit', ['id' => $item->ID])}"
                                        class="sbmt btn-sm btn-success" style="margin-bottom:2px;">view</a><br>
                                    {if $item->depositStatus == "pending"}
                                        <a href="{$route->urlFor('admin-approve-deposit', ['id'=> $item->ID])}"
                                            class="sbmt btn-sm btn-info" style="margin-bottom:2px;"
                                            onclick="return confirmAction('Are you sure you want to approve this deposit? You acknowledge that you have paid this user the requested amount. Continue?')">approve</a><br />
                                        <a href="{$route->urlFor('admin-delete-deposit', ['id'=> $item->ID])}"
                                            class="sbmt btn-sm btn-danger" style="margin-bottom:2px;"
                                            onclick="return deleteRecord()">delete</a>
                                    {/if}
                                </td>
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
