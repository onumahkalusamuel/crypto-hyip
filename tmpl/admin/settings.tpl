{include file='admin/header.tpl' pageTitle='Settings'}

{assign var=settings value=$data.settings}
{assign var=activeCurrencies value=","|explode:$settings.activeCurrencies}


<table class="forTexts" width="100%" height="100%" cellspacing="0" cellpadding="10" border="0">
    <tbody>
        <tr>
            <td width="100%" valign="top" height="100%">
                <h3>Main Settings:</h3>
                <div class="alert alert-warning"> <b>Demo version restriction!</b><br> You cannot edit settings! </div>
                <script language="javascript">
                    var use_alternative_passphrase = 1; var alternative_passphrase_isset = 0; var ipvar = [];  ipvar[0] = "";  ipvar[1] = "";  ipvar[2] = "";  ipvar[3] = "";  ipvar[4] = "";  ipvar[5] = "";   function test_smtp() { if (document.mainform.smtp_host.value == "") { alert("SMTP Host is required"); document.mainform.smtp_host.focus(); return false; } if (document.mainform.smtp_port.value == "") { alert("SMTP Port is required"); document.mainform.smtp_port.focus(); return false; } win = window.open("", "testsmtp", "width=400, height=200, status=0"); document.testsmtp.target = "testsmtp"; document.testsmtp.smtp_secure.value = document.mainform.smtp_secure.options[document.mainform.smtp_secure.selectedIndex].value; document.testsmtp.smtp_host.value = document.mainform.smtp_host.value; document.testsmtp.smtp_port.value = document.mainform.smtp_port.value; document.testsmtp.smtp_user.value = document.mainform.smtp_user.value; document.testsmtp.smtp_pass.value = document.mainform.smtp_pass.value; document.testsmtp.submit(); win.focus(); } function check_form() { var d = document.mainform; if (use_alternative_passphrase && d.use_alternative_passphrase.options[d.use_alternative_passphrase.selectedIndex].value == 1 && d.new_alternative_passphrase.value == "") { alert("Please enter your New Alternative Passphrase!"); d.new_alternative_passphrase.focus(); return false; } if (d.new_alternative_passphrase.value != "" && d.new_alternative_passphrase.value != d.new_alternative_passphrase2.value) { alert("Please, check your Alternative Passphrase!"); d.new_alternative_passphrase2.focus(); return false; } if (alternative_passphrase_isset && d.alternative_passphrase.value == "") { alert("Please enter Alternative Passphrase"); d.alternative_passphrase.focus(); return false; } return true; } /* function setnew_pass(id) { document.getElementById(id+"_div_pass").style.display = "block"; document.getElementById(id+"_hide_link").style.display = "none"; } function setnew_pass_cancel(id) { document.getElementById(id+"_div_pass").style.display = "none"; document.getElementById(id+"_div_pass_reset").checked = false; document.getElementById(id+"_hide_link").style.display = "block"; } */ function ajax_get(url, fsuccess = null, ferror = null) { var xhr = new XMLHttpRequest(); xhr.open("GET", url); xhr.onload = function() { if (xhr.status === 200) { if (fsuccess) { fsuccess(xhr.responseText); } } else { if (ferror) { ferror(xhr.status); } } }; xhr.send(); } function check_proxy() { var ip = ""; document.getElementById("yourip").innerHTML = ""; ajax_get("https://www.goldcoders.com/ip.php?license={$settings.license}&domain="+window.location.hostname, function(ret) { _check_proxy(ret); });
                    }

                    function _check_proxy(ip) {
                        document.getElementById("yourip").innerHTML = "Your IP: <b>" + ip + "</b>";
                        ipidx = -1;
                        for (i in ipvar) { document.getElementById("ipopt" + i).style.background = "inherit"; if (ipvar[
                                    i] && ipvar[i] == ip) { document.getElementById("ipopt" + i).style.background =
                                    "#FF9999"; if (ipidx == -1) ipidx = i; } }
                        if (ipidx == -1) { // alert("Detection is failed");
                        } else { // document.mainform.ddos_type.selectedIndex = ipidx;
                            document.mainform.ddos_type[ipidx].checked = true;
                        }
                    }

                    function open_payment_settings(a, ii) { var id = "settings_" + a;
                        document.getElementById(id).style.display = document.getElementById(id).style.display ==
                            "table" ? "none" : "table"; }

                    function open_trs(a, ii) { for (i = 1; i <= ii; i++) { obj = document.getElementById(a + "_tr_" +
                            i); if (obj) obj.style.display = ""; } }

                    function close_trs(a, ii) { for (i = 1; i <= ii; i++) { obj = document.getElementById(a + "_tr_" +
                                i); if (obj) obj.style.display = "none"; } }
                </script>
                <script type="text/javascript" src="images/js/jscolor.js"></script>
                <form name="testsmtp" method="post"><input type="hidden" name="form_id" value="16312743221588"><input
                        type="hidden" name="form_token" value="dc1d92e2f7ec8deaeb09c8fc78f10d23"> <input type="hidden"
                        name="a" value="test_smtp"> <input type="hidden" name="smtp_secure"> <input type="hidden"
                        name="smtp_host"> <input type="hidden" name="smtp_port"> <input type="hidden" name="smtp_user">
                    <input type="hidden" name="smtp_pass"> </form>
                <form method="post" name="mainform" onsubmit="return check_form()"><input type="hidden" name="form_id"
                        value="16312743221588"><input type="hidden" name="form_token"
                        value="dc1d92e2f7ec8deaeb09c8fc78f10d23"> <input type="hidden" name="a" value="settings"> <input
                        type="hidden" name="action" value="save"> <input type="hidden" name="say" value="">
                    <table class="form settings">
                        <tbody>
                            <tr>
                                <th>Site name:</th>
                                <td><input type="text" name="site_name" value="Demo version." class="inpts" size="30">
                                </td>
                            </tr>
                            <tr>
                                <th>Site url:</th>
                                <td><input type="text" name="site_url" value="https://www.goldcoders.com/demo4"
                                        class="inpts" size="30"></td>
                            </tr>
                            <tr>
                                <th>Start day:</th>
                                <td> <select name="site_start_Day" class="inpts nosize">
                                        <option value="1" selected="selected">01</option>
                                        <option value="2">02</option>
                                        <option value="3">03</option>
                                        <option value="4">04</option>
                                        <option value="5">05</option>
                                        <option value="6">06</option>
                                        <option value="7">07</option>
                                        <option value="8">08</option>
                                        <option value="9">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                        <option value="21">21</option>
                                        <option value="22">22</option>
                                        <option value="23">23</option>
                                        <option value="24">24</option>
                                        <option value="25">25</option>
                                        <option value="26">26</option>
                                        <option value="27">27</option>
                                        <option value="28">28</option>
                                        <option value="29">29</option>
                                        <option value="30">30</option>
                                        <option value="31">31</option>
                                    </select>
                                    <select name="site_start_Month" class="inpts nosize">
                                        <option value="01" selected="selected">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                    <select name="site_start_Year" class="inpts nosize">
                                        <option value="2011" selected="selected">2011</option>
                                        <option value="2012">2012</option>
                                        <option value="2013">2013</option>
                                        <option value="2014">2014</option>
                                        <option value="2015">2015</option>
                                        <option value="2016">2016</option>
                                        <option value="2017">2017</option>
                                        <option value="2018">2018</option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Redirect to HTTPS:</th>
                                <td> <select name="redirect_to_https" class="inpts nosize">
                                        <option value="0" selected="">No</option>
                                        <option value="1">Yes</option>
                                    </select> <small>Do not change this option until you know how it works exactly. If
                                        you are using redirect from http:// to https:// you have set 'https://' into
                                        Site URL field above!</small>
                                </td>
                            </tr>
                            <tr>
                                <th>DDoS Protection:</th>
                                <td>
                                    <table class="list">
                                        <tbody>
                                            <tr>
                                                <th><input type="radio" name="ddos_type" value="0" checked=""></th>
                                                <td id="ipopt0">Default<br><b>167.114.101.141<p></p></b></td>
                                            </tr>
                                            <tr>
                                                <th><input type="radio" name="ddos_type" value="1"></th>
                                                <td id="ipopt1">Proxy (X-FORWARDED-FOR)<br><b>37.120.137.74<p></p></b>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th><input type="radio" name="ddos_type" value="2"></th>
                                                <td id="ipopt2">DDOS Proxy Protection (X-REAL-IP)<br><b>37.120.137.74<p>
                                                        </p></b></td>
                                            </tr>
                                            <tr>
                                                <th><input type="radio" name="ddos_type" value="3"></th>
                                                <td id="ipopt3">CloudFlare (CF-CONNECTING-IP)<br><i>N/A</i></td>
                                            </tr>
                                            <tr>
                                                <th><input type="radio" name="ddos_type" value="4"></th>
                                                <td id="ipopt4">Sucuri (X-SUCURI-CLIENTIP)<br><i>N/A</i></td>
                                            </tr>
                                            <tr>
                                                <th><input type="radio" name="ddos_type" value="5"></th>
                                                <td id="ipopt5">Proxy (CLIENT-IP)<br><i>N/A</i></td>
                                            </tr>
                                        </tbody>
                                    </table> <button type="button" onclick="check_proxy()" class="sbmt">Detect</button>
                                    <span id="yourip"></span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="alert alert-warning"> Site name: your site title.<br> Site url: your
                                        site url, without tailing slash (http://yoursite.com for example).<br>
                                        Start day: shows days online. Select the date you have launched your site
                                        here.<br> Redirect to HTTPS: Redirects users from HTTP to HTTPS. Use this option
                                        only if you can access your site using https. You should go to <a
                                            href="https://www.goldcoders.com/demo4"
                                            target="_blank">https://www.goldcoders.com/demo4</a> and your site will be
                                        displayed if the HTTPS is supported.<br> </div>
                                </td>
                            </tr>
                        </tbody>
                    </table> <br>
                    <table class="form settings">
                        <tbody>
                            <tr>
                                <th>Processings:</th>
                                <td class="alert alert-danger"><a href="?a=processings" targe="_blank">Processings setup
                                        is here</a></td>
                            </tr>
                        </tbody>
                    </table> <br><br>
                    <table class="form settings">
                        <tbody>
                            <tr>
                                <th colspan="2">Administrator login settings:</th>
                            </tr>
                            <tr>
                                <th>Login:</th>
                                <td><input type="text" name="admin_login" value="admin" class="inpts" size="30"></td>
                            </tr>
                            <tr>
                                <th>Password:</th>
                                <td><input type="password" name="admin_password" value="" class="inpts" size="30"></td>
                            </tr>
                            <tr>
                                <th>Retype password:</th>
                                <td><input type="password" name="admin_password2" value="" class="inpts" size="30"></td>
                            </tr>
                            <tr>
                                <th>Administrator E-Mail:</th>
                                <td><input type="text" name="admin_email" value="daniel@goldcoders.com" class="inpts"
                                        size="30"></td>
                            </tr>
                            <tr>
                                <th>Admin Area Charset:</th>
                                <td><input type="text" name="admin_charset" value="UTF-8" class="inpts" size="30"></td>
                            </tr>
                            <tr>
                                <th>Show Google Translator:</th>
                                <td> <select name="use_admin_translator" class="inpts">
                                        <option value="0" selected="">No</option>
                                        <option value="1">Yes</option>
                                    </select> </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="alert alert-warning"> Administrator login settings: type a new login and
                                        a password here to login the admin area.<br> </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="form settings">
                        <tbody>
                            <tr>
                                <th colspan="2">Other settings:</th>
                            </tr>
                            <tr>
                                <th>Reverse left and right columns:</th>
                                <td><select name="reverse_columns" class="inpts">
                                        <option value="0" selected="">No</option>
                                        <option value="1">Yes</option>
                                    </select> </td>
                            </tr>
                            <tr>
                                <th>Deny registrations:</th>
                                <td><select name="deny_registration" class="inpts">
                                        <option value="0" selected="">No</option>
                                        <option value="1">Yes</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <th>Double opt-in during registration:<br><small>Confirm email address on signup</small>
                                </th>
                                <td><select name="use_opt_in" class="inpts">
                                        <option value="0" selected="">No</option>
                                        <option value="1">Yes</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <th>System e-mail:</th>
                                <td><input type="text" name="system_email" value="daniel@goldcoders.com" class="inpts"
                                        size="30"></td>
                            </tr>
                            <tr>
                                <th>Support e-mail:</th>
                                <td><input type="text" name="support_email" value="" class="inpts" size="30"></td>
                            </tr>
                            <tr>
                                <th>Enable Calculator:</th>
                                <td><select name="enable_calculator" class="inpts">
                                        <option value="0">No</option>
                                        <option value="1" selected="">Yes</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <th>Use double entry accounting:</th>
                                <td><select name="use_history_balance_mode" class="inpts">
                                        <option value="0" selected="">No</option>
                                        <option value="1">Yes</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <th>After user logout move him to:</th>
                                <td><select name="redirect_logout" class="inpts">
                                        <option value="home">Home</option>
                                        <option value="login">Login</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="alert alert-warning"> Double opt-in when registering: Select 'yes' if a
                                        user has to confirm the registration. An E-mail with the confirmation code will
                                        be sent to the user after he had submitted the registration request.<br> Opt-in
                                        e-mail: Confirmation messages will be sent from this e-mail account.<br> System
                                        e-mail: All system messages will be sent from this e-mail account.<br> Use user
                                        location fields: Adds "Address", "City", "State", "Zip" and "Country" fields to
                                        user's profile.<br> Use double entry accounting: This mod is used for the
                                        transactions history screen in both users and admin areas. It shows three
                                        different columns - "Debit", "Credit" and "Balance" instead of one "Amount"
                                        field.<br> Reverse left and right columns. If the (this) box is unchecked, the
                                        user menu will be located on the left and news box on the right. If checked:
                                        news on the left, user menu on the right </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="form settings">
                        <tbody>
                            <tr>
                                <th colspan="2">E-mail Settings:</th>
                            </tr>
                            <tr>
                                <th>E-mail Charset:</th>
                                <td><input type="text" name="mail_charset" value="" class="inpts" size="30"></td>
                            </tr>
                            <tr>
                                <th>Send contact email from user's email:</th>
                                <td> <select name="user_from_on_contact" class="inpts">
                                        <option value="0" selected="">No</option>
                                        <option value="1">Yes</option>
                                    </select> <i style="font-size:10;">Your hoster can deny sending mails from your
                                        server with email address outside of your domain name - use this settings to No
                                        in this case</i> </td>
                            </tr>
                            <tr>
                                <th>E-mail throw:</th>
                                <td> <select name="mail_method" class="inpts"
                                        onchange="if (this.selectedIndex == 1){open_trs('SMTP', 4);}else{close_trs('SMTP', 4)}">
                                        <option value="0" selected="">PHP mail() function</option>
                                        <option value="1">SMTP</option>
                                    </select> </td>
                            </tr>
                            <tr id="SMTP_tr_1" style="display:none">
                                <th colspan="2">SMTP Settings:</th>
                            </tr>
                            <tr id="SMTP_tr_2" style="display:none">
                                <th>SMTP Server:</th>
                                <td><select name="smtp_secure" class="inpts nosize">
                                        <option value="" selected="">None</option>
                                        <option value="ssl">SSL</option>
                                        <option value="tls">TLS</option>
                                    </select> <input type="text" name="smtp_host" value="" class="inpts nosize"
                                        size="15"> <input type="text" name="smtp_port" value="0" class="inpts nosize"
                                        size="4"> <input type="button" class="sbmt" value="Test SMTP Settings"
                                        onclick="test_smtp()"> </td>
                            </tr>
                            <tr id="SMTP_tr_3" style="display:none">
                                <th>SMTP User:</th>
                                <td><input type="text" name="smtp_user" value="" class="inpts" size="30"></td>
                            </tr>
                            <tr id="SMTP_tr_4" style="display:none">
                                <th>SMTP Password:</th>
                                <td><input type="password" name="smtp_pass" value="" class="inpts" size="30"></td>
                            </tr>
                        </tbody>
                    </table> <br>
                    <table class="form settings">
                        <tbody>
                            <tr>
                                <th colspan="2">Deposit Settings:</th>
                            </tr>
                            <tr>
                                <th>Allow Topup Account Balance:</th>
                                <td><select name="use_add_funds" class="inpts">
                                        <option value="0" selected="">No</option>
                                        <option value="1">Yes</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <th>Deposit from Balance Fee (%):</th>
                                <td><input type="text" name="balance_deposit_fee_percent" value="" class="inpts"
                                        size="30"></td>
                            </tr>
                            <tr>
                                <th>Deposit Memo Template:</th>
                                <td><input type="text" name="payment_description"
                                        value="Deposit to #site_name# User #username#" class="inpts" size="30"></td>
                            </tr>
                            <tr>
                                <th colspan="2">Withdrawal Settings:</th>
                            </tr>
                            <tr>
                                <th>Withdraw Disabled:</th>
                                <td><select name="withdraw_disabled" class="inpts">
                                        <option value="0" selected="">No</option>
                                        <option value="1">Yes</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <th>User Payment Account Required:</th>
                                <td><select name="withdraw_force_account_filled" class="inpts">
                                        <option value="0" selected="">No</option>
                                        <option value="1">Yes</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <th>Withdrawal Fees:</th>
                                <td><a href="?a=processings" targe="_blank">Set withdrawal fees per processing</a></td>
                            </tr>
                            <tr>
                                <th>Max daily withdraw ($):</th>
                                <td><input type="text" name="max_daily_withdraw" class="inpts nosize" value="0.00"
                                        size="6"> <small>(set 0 to skip limits)</small></td>
                            </tr>
                            <tr>
                                <th>Limit Withdraw Period:</th>
                                <td> <input type="text" name="limit_withdraw_period_times" value="0"
                                        class="inpts nosize" size="6"> times per <select
                                        name="limit_withdraw_period_date" class="inpts nosize">
                                        <option value="n" selected="">none</option>
                                        <option value="day">day</option>
                                        <option value="week">week</option>
                                        <option value="month">month</option>
                                        <option value="year">year</option>
                                        <option value="ever">ever</option>
                                    </select> for <select name="limit_withdraw_period_pending_only"
                                        class="inpts nosize">
                                        <option value="0" selected="">Processed and Pending</option>
                                        <option value="1">Pending only</option>
                                    </select> </td>
                            </tr>
                            <tr>
                                <th>Withdraw Memo Template:</th>
                                <td><input type="text" name="withdraw_memo_string"
                                        value="Withdraw to #username# from #site_name#" class="inpts" size="30"></td>
                            </tr>
                            <tr>
                                <th colspan="2">Internal Transfer Settings:</th>
                            </tr>
                            <tr>
                                <th>Allow internal transfer:</th>
                                <td><select name="internal_transfer_enabled" class="inpts">
                                        <option value="0">No</option>
                                        <option value="1" selected="">Yes</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <th>Min Internal Transfer Amount ($):</th>
                                <td><input type="text" name="internal_transfer_min" value="0.00" class="inpts" size="6">
                                </td>
                            </tr>
                            <tr>
                                <th>Max Internal Transfer Amount ($):</th>
                                <td><input type="text" name="internal_transfer_max" value="0.00" class="inpts" size="6">
                                </td>
                            </tr>
                            <tr>
                                <th>Internal Transfer Fee (%):</th>
                                <td><input type="text" name="internal_transfer_fee" value="1" class="inpts" size="6">
                                </td>
                            </tr>
                            <tr>
                                <th>Minimal Internal Transfer Fee ($):</th>
                                <td><input type="text" name="minimum_internal_transfer_fee" value="0.00" class="inpts"
                                        size="6"></td>
                            </tr>
                            <tr>
                                <th>Internal Transfer Fee Payer:</th>
                                <td><select name="internal_transfer_fee_payer" class="inpts">
                                        <option value="1">Receiver</option>
                                        <option value="0" selected="">Payer</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <th>Limit Transfer Period:</th>
                                <td> <input type="text" name="limit_transfer_period_times" value="0"
                                        class="inpts nosize" size="6"> per <select name="limit_transfer_period_date"
                                        class="inpts nosize">
                                        <option value="n" selected="">none</option>
                                        <option value="day">day</option>
                                        <option value="week">week</option>
                                        <option value="month">month</option>
                                        <option value="year">year</option>
                                    </select> </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="form settings">
                        <tbody>
                            <tr>
                                <th colspan="2">User Settings:</th>
                            </tr>
                            <tr>
                                <th>Use user location fields:</th>
                                <td><select name="use_user_location" class="inpts">
                                        <option value="0" selected="">No </option>
                                        <option value="1">Yes Mandatory </option>
                                        <option value="2">Yes Optional </option>
                                    </select></td>
                            </tr>
                            <tr>
                                <th>Minimal user password length:</th>
                                <td><input type="text" name="min_user_password_length" value="0" class="inpts" size="6">
                                </td>
                            </tr>
                            <tr>
                                <th>Enable 2FA (Two Factor Authentification) for user:</th>
                                <td><select name="use_tfa" class="inpts">
                                        <option value="0" selected="">No</option>
                                        <option value="1">Yes</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <th>Users should use a transaction code to withdraw:</th>
                                <td><select name="use_transaction_code" class="inpts">
                                        <option value="0" selected="">No</option>
                                        <option value="1">Yes</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <th>Users should use a transaction code to edit account:</th>
                                <td><select name="use_transaction_code_edit_account" class="inpts">
                                        <option value="0" selected="">No</option>
                                        <option value="1">Yes</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <th>Use confirmation code when account update:</th>
                                <td><select name="account_update_confirmation" class="inpts">
                                        <option value="0" selected="">No</option>
                                        <option value="1">Yes</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <th>Change payment accounts:</th>
                                <td><select name="usercanchangeegoldacc" class="inpts">
                                        <option value="0">No</option>
                                        <option value="1" selected="">Yes</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <th>Change e-mail:</th>
                                <td><select name="usercanchangeemail" class="inpts">
                                        <option value="0">No</option>
                                        <option value="1" selected="">Yes</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <th>Notify user of his profile change:</th>
                                <td><select name="sendnotify_when_userinfo_changed" class="inpts">
                                        <option value="0">No</option>
                                        <option value="1" selected="">Yes</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="alert alert-warning"> Here you can specify whether user can change his
                                        own e-gold or e-mail account after registration.<br> Min user password length:
                                        Specifies the minimal user password and the transaction code length.<br> Also
                                        system can send e-mail to user when he changes his profile (for security
                                        reason).<br> Users should use transaction code to withdraw: Specifies an
                                        additional password which is needed to do the withdrawal. That password can be
                                        restored by the administrator only. It is stored in MySQL database in plain
                                        format. </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <script language="javascript">
                        function gen_test_validation_image() { var advanced_values = ""; if (document.mainform
                                .advanced_graph_validation) { if (document.mainform
                                    .advanced_graph_validation_min_font_size.value < 14) { document.mainform
                                        .advanced_graph_validation_min_font_size.style.backgroundColor =
                                        "red"; } else { document.mainform.advanced_graph_validation_min_font_size.style
                                        .backgroundColor = "white"; } if (document.mainform
                                    .advanced_graph_validation_min_font_size.value > document.mainform
                                    .advanced_graph_validation_max_font_size.value) { document.mainform
                                        .advanced_graph_validation_max_font_size.style.backgroundColor =
                                        "red"; } else { document.mainform.advanced_graph_validation_max_font_size.style
                                        .backgroundColor = "white"; } advanced_values += "&advanced_graph_validation=" +
                                    document.mainform.advanced_graph_validation.value;
                                advanced_values += "&advanced_graph_validation_min_font_size=" + document.mainform
                                    .advanced_graph_validation_min_font_size.value;
                                advanced_values += "&advanced_graph_validation_max_font_size=" + document.mainform
                                    .advanced_graph_validation_max_font_size.value;
                                advanced_values += "&advanced_graph_validation_noice=" + document.mainform
                                    .advanced_graph_validation_noice.value;
                                advanced_values += "&advanced_graph_validation_wave=" + document.mainform
                                    .advanced_graph_validation_wave.value; } if (document.mainform.graph_max_chars
                                .value > 10) { document.mainform.graph_max_chars.value = 10; } if (document.mainform
                                .graph_max_chars.value == 0) { document.mainform.graph_max_chars.value = 3; } img =
                                document.getElementById("test_validation_image");
                            img.src = "";
                            img.src = "?a=test_validation_image&graph_max_chars=" + document.mainform.graph_max_chars
                                .value + "&graph_bg_color=" + document.mainform.graph_bg_color.value +
                                "&graph_text_color=" + document.mainform.graph_text_color.value +
                                "&use_number_validation_number=" + (document.mainform.use_number_validation_number
                                    .value) + advanced_values + "&rand=" + Math.random(); }

                        function show_hide_sample_image() { idx = document.mainform.graph_validation.selectedIndex;
                            gv_opt = document.mainform.graph_validation.options[idx].value;
                            z = document.getElementById("tr_sample_image_id0"); if (z) z.style.display = (gv_opt > 0 ?
                                "table-row" : "none"); for (i = 1; i < 13; i++) { z = document.getElementById(
                                    "tr_sample_image_id" + i); if (z) z.style.display = (gv_opt == 1 ? "table-row" :
                                    "none"); } for (i = 0; i < 5; i++) { z = document.getElementById(
                                    "tr_sample_recaptcha_id" + i); if (z) z.style.display = (gv_opt == 2 ? "table-row" :
                                    "none"); } if (gv_opt == 1) { show_hide_advanced_image(); } }

                        function show_hide_advanced_image() { for (i = 8; i < 13; i++) { z = document.getElementById(
                                    "tr_sample_image_id" + i); if (z) z.style.display = (document.mainform
                                    .advanced_graph_validation.selectedIndex == 0 ? "none" : "table-row"); } }
                    </script> <br>
                    <table class="form settings">
                        <tbody>
                            <tr>
                                <th colspan="2">Turing verification:</th>
                            </tr>
                            <tr>
                                <th>Turing Verification:</th>
                                <td> <select name="graph_validation" class="inpts" onchange="show_hide_sample_image()">
                                        <option value="0" selected="">No</option>
                                        <option value="1">Image</option>
                                        <option value="2">reCaptcha</option>
                                    </select> </td>
                            </tr>
                            <tr id="tr_sample_image_id0" style="display: none;">
                                <td colspan="2"> &nbsp; <input type="checkbox" name="graph_validation_check[login]"
                                        value="1" id="ti_login" checked=""><label for="ti_login">Login</label><br>
                                    &nbsp; <input type="checkbox" name="graph_validation_check[signup]" value="1"
                                        id="ti_signup" checked=""><label for="ti_signup">Signup</label><br> &nbsp;
                                    <input type="checkbox" name="graph_validation_check[edit_account]" value="1"
                                        id="ti_edit_account"><label for="ti_edit_account">Edit Account</label><br>
                                    &nbsp; <input type="checkbox" name="graph_validation_check[support]" value="1"
                                        id="ti_support" checked=""><label for="ti_support">Support</label><br> &nbsp;
                                    <input type="checkbox" name="graph_validation_check[forgot_password]" value="1"
                                        id="ti_forgot_password"><label for="ti_forgot_password">Forgot
                                        Password</label><br> &nbsp; <input type="checkbox"
                                        name="graph_validation_check[withdrawal]" value="1" id="ti_withdrawal"><label
                                        for="ti_withdrawal">Withdrawal</label><br> &nbsp; <input type="checkbox"
                                        name="graph_validation_check[internal_transfer]" value="1"
                                        id="ti_internal_transfer"><label for="ti_internal_transfer">Internal
                                        Transfer</label><br> </td>
                            </tr>
                            <tr id="tr_sample_image_id1" style="display: none;">
                                <th>Sample:<div class="alert alert-danger"><small>Please be sure you can read sample
                                            before save settings</small></div>
                                </th>
                                <td><img src="?a=test_validation_image&amp;graph_max_chars=6&amp;graph_bg_color=FFFFFF&amp;graph_text_color=FF8D00&amp;use_number_validation_number=0&amp;rand=0.942354045150158"
                                        id="test_validation_image"
                                        style="min-width:20px;min-height:10px;border:solid 1px #FF8D00;"
                                        alt="Loading..." onclick="gen_test_validation_image()" align="absmiddle">
                                    <button type="button" onclick="gen_test_validation_image()" class="sbmt">↻</button>
                                </td>
                            </tr>
                            <!--tr id=tr_sample_image_id2>
 <td colspan=2><small>Please be sure you can read sample before save settings</small></td> </tr-->
                            <tr id="tr_sample_image_id3" style="display: none;">
                                <th>Number of characters in the turing image:</th>
                                <td> <select name="graph_max_chars" class="inpts"
                                        onchange="gen_test_validation_image()">
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6" selected="">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </select> </td>
                            </tr>
                            <tr id="tr_sample_image_id4" style="display: none;">
                                <th>Use numbers only</th>
                                <td> <select name="use_number_validation_number" class="inpts"
                                        onchange="gen_test_validation_image()">
                                        <option value="0" selected="">No</option>
                                        <option value="1">Yes</option>
                                    </select> </td>
                            </tr>
                            <tr id="tr_sample_image_id5" style="display: none;">
                                <th>Turing image text color:</th>
                                <td><input type="text" name="graph_text_color" value="FF8D00"
                                        onchange="gen_test_validation_image()" class="color"
                                        style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; border: 1px solid rgb(255, 141, 0); background-image: none; background-color: rgb(255, 141, 0); color: rgb(0, 0, 0);"
                                        size="10" autocomplete="off"></td>
                            </tr>
                            <tr id="tr_sample_image_id6" style="display: none;">
                                <th>Turing image bg color:</th>
                                <td><input type="text" name="graph_bg_color" value="FFFFFF"
                                        onchange="gen_test_validation_image()" class="color"
                                        style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; border: 1px solid rgb(255, 141, 0); background-image: none; background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);"
                                        size="10" autocomplete="off"></td>
                            </tr>
                            <tr id="tr_sample_recaptcha_id1" style="display: none;">
                                <th>ReCAPTCHA Version:</th>
                                <td> <select name="recaptcha_version" class="inpts">
                                        <option value="2">v2</option>
                                        <option value="3">v3</option>
                                    </select> </td>
                            </tr>
                            <tr id="tr_sample_recaptcha_id2" style="display: none;">
                                <th>ReCAPTCHA Site Key:</th>
                                <td><input type="text" name="recaptcha_site_key" value="" class="inpts" size="10"></td>
                            </tr>
                            <tr id="tr_sample_recaptcha_id3" style="display: none;">
                                <th>ReCAPTCHA Secret Key:</th>
                                <td><input type="text" name="recaptcha_secret_key" value="" class="inpts" size="10">
                                </td>
                            </tr>
                            <tr id="tr_sample_recaptcha_id4" style="display: none;">
                                <td colspan="2">
                                    <div class="alert alert-warning">
                                        <div class="alert alert-danger">You should update your templates to use
                                            reCaptcha. Please find captcha.tpl in the latest script archive and upload
                                            it to your script "tmpl" folder.</div>
                                        <div class="alert alert-danger">Next templates should be update to add
                                            {include file="e;captcha.tpl"e;} to use with reCpatcha:<br>
                                            internal_transfer.tpl<br> withdrawal.tpl<br> edit_account.tpl<br>
                                            support.tpl<br> signup.tpl<br> forgot_password.tpl<br> login.tpl<br> </div>
                                        Please visit <a href="https://www.google.com/recaptcha/" target="_blank">Google
                                            reCapatcha</a> page to create Site Key and Secret Key.
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="alert alert-warning"> You can use the turing image for verification when
                                        users login to the system. It will stop brute force scripts from hacking
                                        passwords.<br> </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <script>
                        gen_test_validation_image();
                    </script> <br>
                    <table class="form settings">
                        <tbody>
                            <tr>
                                <th colspan="2">Brute Force Protection: </th>
                            </tr>
                            <tr>
                                <th>Prevent Brute Force:</th>
                                <td><select name="brute_force_handler" class="inpts">
                                        <option value="0" selected="">No</option>
                                        <option value="1">Yes</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <th>Max Invalid Attempts:</th>
                                <td><input type="text" name="brute_force_max_tries" value="0" class="inpts" size="10">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="alert alert-warning"> Prevent Brute Force: Turns on the brute force
                                        prevention system.<br> Max Invalid Attempts: The number of invalid login tries.
                                        The login is being blocked if one tries to login more than specified here number
                                        of times with the invalid password. The e-mail message with an activation link
                                        is generated and being sent to a user. One cannot login even with a correct
                                        password before the account activation. </div>
                                </td>
                            </tr>
                        </tbody>
                    </table> <br>
                    <table class="form settings">
                        <tbody>
                            <tr>
                                <th colspan="2">Time settings:</th>
                            </tr>
                            <tr>
                                <th>Server time:</th>
                                <td>10th of September 2021 11:45:22 AM</td>
                            </tr>
                            <tr>
                                <th>System time:</th>
                                <td>10th of September 2021 11:45:22 AM</td>
                            </tr>
                            <tr>
                                <th>Difference:</th>
                                <td><input type="text" name="time_dif" value="0" class="inpts nosize" size="5"> hours
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="alert alert-warning"> Change your system time. You can set the system to
                                        show all dates for your time zone. </div>
                                </td>
                            </tr>
                            <tr> </tr>
                        </tbody>
                    </table> <br>
                    <table class="form settings">
                        <tbody>
                            <tr>
                                <th colspan="2">Administrator Alternative Passphrase: </th>
                            </tr>
                            <tr>
                                <th>Use admin alternative passphrase:</th>
                                <td><select name="use_alternative_passphrase" class="inpts">
                                        <option value="0" selected="">No</option>
                                        <option value="1">Yes</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <th>New alternative passphrase:</th>
                                <td><input type="password" name="new_alternative_passphrase" value="" class="inpts"
                                        size="30"></td>
                            </tr>
                            <tr>
                                <th>Confirm New alternative passphrase:</th>
                                <td><input type="password" name="new_alternative_passphrase2" value="" class="inpts"
                                        size="30"></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="alert alert-warning"> This feature raises the security level for the
                                        administrator area. If enabled Administrator can change 'Settings',
                                        'Proceessings', 'Auto-Withdrawal Settings' and 'Security' properties knowing the
                                        Alternative Passphrase only. </div>
                                </td>
                            </tr>
                        </tbody>
                    </table> <br>
                    <center> <input type="submit" value="Save Settings" class="btn btn-success sbmt"> </center>
                </form>
                <script language="JavaScript">
                    show_hide_sample_image();
                </script>
            </td>
        </tr>
    </tbody>
</table>


<div class="main-content">

    <div class="container pb-40 pt-20">

        <div id="accordion"
            class="panel-group toggle accordion-classic accordion-classic-theme-colored2 accordion-flat">
            <div class="panel panel-default mb-20">
                <div class="panel-heading">
                    <div class="panel-title"> <a class="active font-24 pt-0 pb-0 text-capitalize"
                            data-parent="#accordion" data-toggle="collapse" href="#profileAccordion">Settings </a>
                    </div>
                </div>
                <div id="profileAccordion" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <form method="POST" action="<?= $route->urlFor('admin-update-settings'); ?>">

                            <div class="form-group row">
                                <label for="activeCurrencies" class="col-sm-2 col-form-label">Active Currencies</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="activeCurrencies" name="activeCurrencies"
                                        value="<?= $settings['activeCurrencies']; ?>">
                                    <span class="font-12 p-0 m-0">separate currencies by comma (,). do not add spaces.
                                        e.g. (ltc,btc,doge,eth)</span>
                                </div>
                            </div>

                            <?php foreach($activeCurrencies as $currency):?>
                            <div class="form-group row">
                                <label for="<?=$currency;?>DepositAddress" class="col-sm-2 col-form-label">
                                    <?=strtoupper($currency);?> Deposit Address
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="<?=$currency;?>DepositAddress"
                                        id="<?=$currency;?>DepositAddress"
                                        value="<?= $settings[$currency .'DepositAddress']; ?>">
                                </div>
                            </div>
                            <?php endforeach;?>
                            <div class="form-group row">
                                <label for="minWithdrawal" class="col-sm-2 col-form-label">Minimum Withdrawal
                                    Amount</label>
                                <div class="col-sm-10">
                                    <input type="number" min="0" class="form-control" id="minWithdrawal"
                                        name="minWithdrawal" value="<?= $settings['minWithdrawal']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="payReferral" class="col-sm-2 col-form-label">Pay Referral Bonus?</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="payReferral" name="payReferral"
                                        value="<?= $settings['payReferral']; ?>">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="confirmAction" class="col-sm-2 col-form-label">Enter Your Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="confirmPassword"
                                        id="confirmAction" required />
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-theme-colored2 btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="panel panel-default mb-20">
                <div class="panel-heading">
                    <div class="panel-title"> <a class="collapsed font-24 pt-0 pb-0 text-capitalize"
                            data-parent="#accordion" data-toggle="collapse" href="#adminAccordion">Admin Password </a>
                    </div>
                </div>
                <div id="adminAccordion" class="panel-collapse collapse">
                    <div class="panel-body">
                        <h5>To change admin password, generate OTP. The OTP will be sent to admin email and will expire
                            in <strong>5 minutes</strong>.<br /> <a
                                class="btn text-uppercase btn-theme-colored btn-flat"
                                href="<?= $route->urlFor('admin-update-admin-otp'); ?>">Click here</a> to generate OTP
                            now.</h5><br />
                        <form method="POST" action="<?= $route->urlFor('admin-update-admin'); ?>">
                            <div class="form-group row">
                                <label for="newPassword" class="col-sm-2 col-form-label">Enter New Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="newPassword" id="newPassword">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="newPasswordAgain" class="col-sm-2 col-form-label">Enter New Password
                                    Again</label>
                                <div class="col-sm-10">
                                    <input type="password" min="0" class="form-control" id="newPasswordAgain"
                                        name="newPasswordAgain">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="oldPassword" class="col-sm-2 col-form-label">Enter Old Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="oldPassword" name="oldPassword" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="oldPassword" class="col-sm-2 col-form-label">Enter Generated OTP</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="OTP" name="OTP" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-theme-colored2 btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



{include file='admin/footer.tpl'}