{include file='admin/header.tpl' pageTitle='Blacklist'}

<table class="forTexts" width="100%" height="100%" cellspacing="0" cellpadding="10" border="0">
    <tbody>
        <tr>
            <td width="100%" valign="top" height="100%">
                <h3>Accounts Blacklist:</h3>
                <form method="post"><input type="hidden" name="form_id" value="16312737396666"><input type="hidden"
                        name="form_token" value="4f6b1d9b375d4809fe4d0daacf4c95b6"> <input type="hidden" name="a"
                        value="ext_accounts_blacklist"> <input type="hidden" name="action" value="add">
                    <table class="form nosize">
                        <tbody>
                            <tr>
                                <th style="width:20%">Add Account:</th>
                                <td><input type="text" name="account" value="" class="inpts"></td>
                                <td> <select name="ec" class="inpts">
                                        <option value="18">PerfectMoney</option>
                                        <option value="43">Payeer</option>
                                        <option value="56">AdvCash</option>
                                        <option value="6">PayPal</option>
                                        <option value="20">Webmoney</option>
                                        <option value="22">SolidTrustPay</option>
                                        <option value="42">NixMoney</option>
                                        <option value="46">QIWI</option>
                                        <option value="51">ePayCore</option>
                                        <option value="52">GoCoin</option>
                                        <option value="53">Entromoney</option>
                                        <option value="58">Skrill</option>
                                        <option value="59">Nitronpay</option>
                                        <option value="61">SaliPay</option>
                                        <option value="8">eeeCurrency</option>
                                        <option value="64">epay.com</option>
                                        <option value="65">S-Pay</option>
                                        <option value="48">Bitcoin</option>
                                        <option value="68">Litecoin</option>
                                        <option value="79">Dogecoin</option>
                                        <option value="69">Ethereum</option>
                                        <option value="77">Bitcoin Cash</option>
                                        <option value="71">Dash</option>
                                        <option value="80">Bitcoin Gold</option>
                                    </select> </td>
                                <td><input type="submit" value="Add" class="sbmt"></td>
                            </tr>
                        </tbody>
                    </table>
                </form> <br>
                <hr>
                <form method="get"><input type="hidden" name="form_id" value="16312737396666"><input type="hidden"
                        name="form_token" value="4f6b1d9b375d4809fe4d0daacf4c95b6"> <input type="hidden" name="a"
                        value="ext_accounts_blacklist">
                    <table class="form nosize">
                        <tbody>
                            <tr>
                                <th style="width:20%">Search Account: </th>
                                <td><input type="text" name="account" value="" class="inpts"></td>
                                <td> <select name="ec" class="inpts">
                                        <option value="-1">--Any--</option>
                                        <option value="18">PerfectMoney</option>
                                        <option value="43">Payeer</option>
                                        <option value="56">AdvCash</option>
                                        <option value="6">PayPal</option>
                                        <option value="20">Webmoney</option>
                                        <option value="22">SolidTrustPay</option>
                                        <option value="42">NixMoney</option>
                                        <option value="46">QIWI</option>
                                        <option value="51">ePayCore</option>
                                        <option value="52">GoCoin</option>
                                        <option value="53">Entromoney</option>
                                        <option value="58">Skrill</option>
                                        <option value="59">Nitronpay</option>
                                        <option value="61">SaliPay</option>
                                        <option value="8">eeeCurrency</option>
                                        <option value="64">epay.com</option>
                                        <option value="65">S-Pay</option>
                                        <option value="48">Bitcoin</option>
                                        <option value="68">Litecoin</option>
                                        <option value="79">Dogecoin</option>
                                        <option value="69">Ethereum</option>
                                        <option value="77">Bitcoin Cash</option>
                                        <option value="71">Dash</option>
                                        <option value="80">Bitcoin Gold</option>
                                    </select> </td>
                                <td><input type="submit" value="Search" class="sbmt"></td>
                            </tr>
                        </tbody>
                    </table> <br>
                    <form method="post"><input type="hidden" name="form_id" value="16312737396666"><input type="hidden"
                            name="form_token" value="4f6b1d9b375d4809fe4d0daacf4c95b6"> <input type="hidden" name="a"
                            value="ext_accounts_blacklist"> <input type="hidden" name="action" value="delete">
                        <table class="list">
                            <tbody>
                                <tr>
                                    <th>#</th>
                                    <th>Account</th>
                                    <th>Payment System</th>
                                </tr>
                                <tr>
                                    <td colspan="3" align="center">No Accounts found.</td>
                                </tr>
                            </tbody>
                        </table> <br> <input type="submit" value="Delete" class="sbmt">
                    </form>
                </form>
            </td>
        </tr>
    </tbody>
</table>

{include file='admin/footer.tpl'}