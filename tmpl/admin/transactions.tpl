{include file='admin/header.tpl' pageTitle='Transactions'}


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
                <script language="javascript">
                    function go(p) { document.trans.p.value = p;
                        document.trans.submit(); }
                </script>
                <form method="post" name="trans"><input type="hidden" name="form_id" value="16312742436877"><input
                        type="hidden" name="form_token" value="ce4292fcccd8038c7c56ae43fc829232"> <input type="hidden"
                        name="a" value="transactions"> <input type="hidden" name="userid" value="0"> <input
                        type="hidden" name="p">
                    <table class="form controls nosize">
                        <tbody>
                            <tr>
                                <td> <select name="ttype" class="inpts" onchange="document.trans.submit()">
                                        <option value="">All Transactions</option>
                                        <option value="withdraw_pending">Withdrawal request</option>
                                        <option value="add_funds">Transfer from external processings</option>
                                        <option value="deposit">Deposit</option>
                                        <option value="bonus">Bonus</option>
                                        <option value="penalty">Penalty</option>
                                        <option value="earning">Earning</option>
                                        <option value="withdrawal">Withdrawal</option>
                                        <option value="commissions">Referral commission</option>
                                        <option value="exchange">Exchange</option>
                                        <option value="internal_transaction">Internal Transaction</option>
                                        <option value="rcb">RCB</option>
                                    </select><br> <select name="ec" class="inpts" onchange="document.trans.submit()">
                                        <option value="-1">All eCurrencies</option>
                                        <option value="18">PerfectMoney</option>
                                        <option value="48">Bitcoin</option>
                                        <option value="16"></option>
                                        <option value="28"></option>
                                    </select> </td>
                                <td style="text-align:right"> From: <select name="from_Day" class="inpts nosize">
                                        <option value="1">01</option>
                                        <option value="2">02</option>
                                        <option value="3">03</option>
                                        <option value="4">04</option>
                                        <option value="5">05</option>
                                        <option value="6">06</option>
                                        <option value="7">07</option>
                                        <option value="8">08</option>
                                        <option value="9">09</option>
                                        <option value="10">10</option>
                                        <option value="11" selected="selected">11</option>
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
                                    <select name="from_Month" class="inpts nosize">
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08" selected="selected">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                    <select name="from_Year" class="inpts nosize">
                                        <option value="2010">2010</option>
                                        <option value="2011">2011</option>
                                        <option value="2012">2012</option>
                                        <option value="2013">2013</option>
                                        <option value="2014">2014</option>
                                        <option value="2015">2015</option>
                                        <option value="2016">2016</option>
                                        <option value="2017">2017</option>
                                        <option value="2018">2018</option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021" selected="selected">2021</option>
                                    </select> <br> To: <select name="to_Day" class="inpts nosize">
                                        <option value="1">01</option>
                                        <option value="2">02</option>
                                        <option value="3">03</option>
                                        <option value="4">04</option>
                                        <option value="5">05</option>
                                        <option value="6">06</option>
                                        <option value="7">07</option>
                                        <option value="8">08</option>
                                        <option value="9">09</option>
                                        <option value="10" selected="selected">10</option>
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
                                    <select name="to_Month" class="inpts nosize">
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09" selected="selected">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                    <select name="to_Year" class="inpts nosize">
                                        <option value="2010">2010</option>
                                        <option value="2011">2011</option>
                                        <option value="2012">2012</option>
                                        <option value="2013">2013</option>
                                        <option value="2014">2014</option>
                                        <option value="2015">2015</option>
                                        <option value="2016">2016</option>
                                        <option value="2017">2017</option>
                                        <option value="2018">2018</option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021" selected="selected">2021</option>
                                    </select>
                                </td>
                                <td> Per Page: <select name="onpage" class="inpts nosize"
                                        onchange="document.trans.submit()">
                                        <option value="20" selected="">20 </option>
                                        <option value="50">50 </option>
                                        <option value="100">100 </option>
                                    </select> <br> <input type="submit" value="Go" class="sbmt"> <button type="submit"
                                        name="action" value="csv" class="sbmt">CSV</button> </td>
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
                        <tr class="row1">
                            <td class="trn_user"> <b>demo</b> <a class="badge badge-danger" target="_blank"
                                    href="?a=user_edit&amp;id=2">edit</a> <a class="badge badge-info" target="_blank"
                                    href="?a=user_details&amp;id=2">manage</a> <br> <small
                                    style="color:gray"><b>Earning:</b> &nbsp;
                                    y7y60esgeqqacbm6zl2hihh89b2htylrbrshh</small> </td>
                            <td nowrap="" align="right"><b style="color:green">$0.32</b> <img src="images/48.gif"
                                    hspace="1" height="17" align="absmiddle"></td>
                            <td align="center"><small>Sep-10-2021<br>11:00:56 AM</small></td>
                        </tr>
                        <tr class="row2">
                            <td class="trn_user"> <b>demo</b> <a class="badge badge-danger" target="_blank"
                                    href="?a=user_edit&amp;id=2">edit</a> <a class="badge badge-info" target="_blank"
                                    href="?a=user_details&amp;id=2">manage</a> <br> <small
                                    style="color:gray"><b>Earning:</b> &nbsp; Earning from deposit $10.00 - 2.20
                                    %</small> </td>
                            <td nowrap="" align="right"><b style="color:green">$0.22</b> <img src="images/48.gif"
                                    hspace="1" height="17" align="absmiddle"></td>
                            <td align="center"><small>Sep-10-2021<br>11:00:54 AM</small></td>
                        </tr>
                        <tr class="row1">
                            <td class="trn_user"> <b>demo</b> <a class="badge badge-danger" target="_blank"
                                    href="?a=user_edit&amp;id=2">edit</a> <a class="badge badge-info" target="_blank"
                                    href="?a=user_details&amp;id=2">manage</a> <br> <small
                                    style="color:gray"><b>Earning:</b> &nbsp;
                                    y7y60esgeqqacbm6zl2hihh89b2htylrbrshh</small> </td>
                            <td nowrap="" align="right"><b style="color:green">$1.60</b> <img src="images/48.gif"
                                    hspace="1" height="17" align="absmiddle"></td>
                            <td align="center"><small>Sep-10-2021<br>10:50:09 AM</small></td>
                        </tr>
                        <tr class="row2">
                            <td class="trn_user"> <b>demo</b> <a class="badge badge-danger" target="_blank"
                                    href="?a=user_edit&amp;id=2">edit</a> <a class="badge badge-info" target="_blank"
                                    href="?a=user_details&amp;id=2">manage</a> <br> <small
                                    style="color:gray"><b>Earning:</b> &nbsp; Earning from deposit $123.00 - 2.30
                                    %</small> </td>
                            <td nowrap="" align="right"><b style="color:green">$2.82</b> <img src="images/48.gif"
                                    hspace="1" height="17" align="absmiddle"></td>
                            <td align="center"><small>Sep-10-2021<br>10:06:52 AM</small></td>
                        </tr>
                        <tr class="row1">
                            <td class="trn_user"> <b>demo</b> <a class="badge badge-danger" target="_blank"
                                    href="?a=user_edit&amp;id=2">edit</a> <a class="badge badge-info" target="_blank"
                                    href="?a=user_details&amp;id=2">manage</a> <br> <small
                                    style="color:gray"><b>Earning:</b> &nbsp;
                                    y7y60esgeqqacbm6zl2hihh89b2htylrbrshh</small> </td>
                            <td nowrap="" align="right"><b style="color:green">$3.20</b> <img src="images/48.gif"
                                    hspace="1" height="17" align="absmiddle"></td>
                            <td align="center"><small>Sep-10-2021<br>10:05:42 AM</small></td>
                        </tr>
                        <tr class="row2">
                            <td class="trn_user"> <b>demo</b> <a class="badge badge-danger" target="_blank"
                                    href="?a=user_edit&amp;id=2">edit</a> <a class="badge badge-info" target="_blank"
                                    href="?a=user_details&amp;id=2">manage</a> <br> <small
                                    style="color:gray"><b>Earning:</b> &nbsp; Earning from deposit $333.00 - 2.30
                                    %</small> </td>
                            <td nowrap="" align="right"><b style="color:green">$7.65</b> <img src="images/48.gif"
                                    hspace="1" height="17" align="absmiddle"></td>
                            <td align="center"><small>Sep-10-2021<br>09:20:48 AM</small></td>
                        </tr>
                        <tr class="row1">
                            <td class="trn_user"> <b>demo</b> <a class="badge badge-danger" target="_blank"
                                    href="?a=user_edit&amp;id=2">edit</a> <a class="badge badge-info" target="_blank"
                                    href="?a=user_details&amp;id=2">manage</a> <br> <small
                                    style="color:gray"><b>Earning:</b> &nbsp;
                                    y7y60esgeqqacbm6zl2hihh89b2htylrbrshh</small> </td>
                            <td nowrap="" align="right"><b style="color:green">$0.32</b> <img src="images/48.gif"
                                    hspace="1" height="17" align="absmiddle"></td>
                            <td align="center"><small>Sep-10-2021<br>08:59:45 AM</small></td>
                        </tr>
                        <tr class="row2">
                            <td class="trn_user"> <b>demo</b> <a class="badge badge-danger" target="_blank"
                                    href="?a=user_edit&amp;id=2">edit</a> <a class="badge badge-info" target="_blank"
                                    href="?a=user_details&amp;id=2">manage</a> <br> <small
                                    style="color:gray"><b>Earning:</b> &nbsp;
                                    y7y60esgeqqacbm6zl2hihh89b2htylrbrshh</small> </td>
                            <td nowrap="" align="right"><b style="color:green">$33.00</b> <img src="images/48.gif"
                                    hspace="1" height="17" align="absmiddle"></td>
                            <td align="center"><small>Sep-10-2021<br>08:41:24 AM</small></td>
                        </tr>
                        <tr class="row1">
                            <td class="trn_user"> <b>demo</b> <a class="badge badge-danger" target="_blank"
                                    href="?a=user_edit&amp;id=2">edit</a> <a class="badge badge-info" target="_blank"
                                    href="?a=user_details&amp;id=2">manage</a> <br> <small
                                    style="color:gray"><b>Earning:</b> &nbsp; Earning from deposit $0.00 - 2.20
                                    %</small> </td>
                            <td nowrap="" align="right"><b style="color:black">$0.00</b> <img src="images/48.gif"
                                    hspace="1" height="17" align="absmiddle"></td>
                            <td align="center"><small>Sep-10-2021<br>08:19:11 AM</small></td>
                        </tr>
                        <tr class="row2">
                            <td class="trn_user"> <b>demo</b> <a class="badge badge-danger" target="_blank"
                                    href="?a=user_edit&amp;id=2">edit</a> <a class="badge badge-info" target="_blank"
                                    href="?a=user_details&amp;id=2">manage</a> <br> <small
                                    style="color:gray"><b>Earning:</b> &nbsp; Earning from deposit $15.00 - 2.20
                                    %</small> </td>
                            <td nowrap="" align="right"><b style="color:green">$0.33</b> <img src="images/48.gif"
                                    hspace="1" height="17" align="absmiddle"></td>
                            <td align="center"><small>Sep-10-2021<br>07:24:58 AM</small></td>
                        </tr>
                        <tr class="row1">
                            <td class="trn_user"> <b>demo</b> <a class="badge badge-danger" target="_blank"
                                    href="?a=user_edit&amp;id=2">edit</a> <a class="badge badge-info" target="_blank"
                                    href="?a=user_details&amp;id=2">manage</a> <br> <small
                                    style="color:gray"><b>Earning:</b> &nbsp;
                                    y7y60esgeqqacbm6zl2hihh89b2htylrbrshh</small> </td>
                            <td nowrap="" align="right"><b style="color:green">$3.20</b> <img src="images/48.gif"
                                    hspace="1" height="17" align="absmiddle"></td>
                            <td align="center"><small>Sep-10-2021<br>06:27:51 AM</small></td>
                        </tr>
                        <tr class="row2">
                            <td class="trn_user"> <b>demo</b> <a class="badge badge-danger" target="_blank"
                                    href="?a=user_edit&amp;id=2">edit</a> <a class="badge badge-info" target="_blank"
                                    href="?a=user_details&amp;id=2">manage</a> <br> <small
                                    style="color:gray"><b>Earning:</b> &nbsp;
                                    y7y60esgeqqacbm6zl2hihh89b2htylrbrshh</small> </td>
                            <td nowrap="" align="right"><b style="color:green">$0.32</b> <img src="images/48.gif"
                                    hspace="1" height="17" align="absmiddle"></td>
                            <td align="center"><small>Sep-10-2021<br>06:09:41 AM</small></td>
                        </tr>
                        <tr class="row1">
                            <td class="trn_user"> <b>demo</b> <a class="badge badge-danger" target="_blank"
                                    href="?a=user_edit&amp;id=2">edit</a> <a class="badge badge-info" target="_blank"
                                    href="?a=user_details&amp;id=2">manage</a> <br> <small
                                    style="color:gray"><b>Earning:</b> &nbsp;
                                    y7y60esgeqqacbm6zl2hihh89b2htylrbrshh</small> </td>
                            <td nowrap="" align="right"><b style="color:green">$0.35</b> <img src="images/48.gif"
                                    hspace="1" height="17" align="absmiddle"></td>
                            <td align="center"><small>Sep-10-2021<br>03:57:28 AM</small></td>
                        </tr>
                        <tr class="row2">
                            <td class="trn_user"> <b>demo</b> <a class="badge badge-danger" target="_blank"
                                    href="?a=user_edit&amp;id=2">edit</a> <a class="badge badge-info" target="_blank"
                                    href="?a=user_details&amp;id=2">manage</a> <br> <small
                                    style="color:gray"><b>Earning:</b> &nbsp;
                                    y7y60esgeqqacbm6zl2hihh89b2htylrbrshh</small> </td>
                            <td nowrap="" align="right"><b style="color:green">$0.32</b> <img src="images/48.gif"
                                    hspace="1" height="17" align="absmiddle"></td>
                            <td align="center"><small>Sep-10-2021<br>03:57:11 AM</small></td>
                        </tr>
                        <tr class="row1">
                            <td class="trn_user"> <b>demo</b> <a class="badge badge-danger" target="_blank"
                                    href="?a=user_edit&amp;id=2">edit</a> <a class="badge badge-info" target="_blank"
                                    href="?a=user_details&amp;id=2">manage</a> <br> <small
                                    style="color:gray"><b>Earning:</b> &nbsp; Earning from deposit $0.00 - 2.20
                                    %</small> </td>
                            <td nowrap="" align="right"><b style="color:black">$0.00</b> <img src="images/48.gif"
                                    hspace="1" height="17" align="absmiddle"></td>
                            <td align="center"><small>Sep-10-2021<br>03:42:20 AM</small></td>
                        </tr>
                        <tr class="row2">
                            <td class="trn_user"> <b>demo</b> <a class="badge badge-danger" target="_blank"
                                    href="?a=user_edit&amp;id=2">edit</a> <a class="badge badge-info" target="_blank"
                                    href="?a=user_details&amp;id=2">manage</a> <br> <small
                                    style="color:gray"><b>Earning:</b> &nbsp;
                                    y7y60esgeqqacbm6zl2hihh89b2htylrbrshh</small> </td>
                            <td nowrap="" align="right"><b style="color:green">$0.32</b> <img src="images/48.gif"
                                    hspace="1" height="17" align="absmiddle"></td>
                            <td align="center"><small>Sep-10-2021<br>03:03:59 AM</small></td>
                        </tr>
                        <tr class="row1">
                            <td class="trn_user"> <b>demo</b> <a class="badge badge-danger" target="_blank"
                                    href="?a=user_edit&amp;id=2">edit</a> <a class="badge badge-info" target="_blank"
                                    href="?a=user_details&amp;id=2">manage</a> <br> <small
                                    style="color:gray"><b>Earning:</b> &nbsp;
                                    y7y60esgeqqacbm6zl2hihh89b2htylrbrshh</small> </td>
                            <td nowrap="" align="right"><b style="color:green">$0.32</b> <img src="images/48.gif"
                                    hspace="1" height="17" align="absmiddle"></td>
                            <td align="center"><small>Sep-10-2021<br>02:58:55 AM</small></td>
                        </tr>
                        <tr class="row2">
                            <td class="trn_user"> <b>demo</b> <a class="badge badge-danger" target="_blank"
                                    href="?a=user_edit&amp;id=2">edit</a> <a class="badge badge-info" target="_blank"
                                    href="?a=user_details&amp;id=2">manage</a> <br> <small
                                    style="color:gray"><b>Earning:</b> &nbsp; Earning from deposit $50.00 - 2.20
                                    %</small> </td>
                            <td nowrap="" align="right"><b style="color:green">$1.10</b> <img src="images/48.gif"
                                    hspace="1" height="17" align="absmiddle"></td>
                            <td align="center"><small>Sep-10-2021<br>01:22:17 AM</small></td>
                        </tr>
                        <tr class="row1">
                            <td class="trn_user"> <b>demo</b> <a class="badge badge-danger" target="_blank"
                                    href="?a=user_edit&amp;id=2">edit</a> <a class="badge badge-info" target="_blank"
                                    href="?a=user_details&amp;id=2">manage</a> <br> <small
                                    style="color:gray"><b>Earning:</b> &nbsp;
                                    y7y60esgeqqacbm6zl2hihh89b2htylrbrshh</small> </td>
                            <td nowrap="" align="right"><b style="color:green">$0.32</b> <img src="images/48.gif"
                                    hspace="1" height="17" align="absmiddle"></td>
                            <td align="center"><small>Sep-10-2021<br>12:05:57 AM</small></td>
                        </tr>
                        <tr class="row2">
                            <td class="trn_user"> <b>demo</b> <a class="badge badge-danger" target="_blank"
                                    href="?a=user_edit&amp;id=2">edit</a> <a class="badge badge-info" target="_blank"
                                    href="?a=user_details&amp;id=2">manage</a> <br> <small
                                    style="color:gray"><b>Earning:</b> &nbsp;
                                    y7y60esgeqqacbm6zl2hihh89b2htylrbrshh</small> </td>
                            <td nowrap="" align="right"><b style="color:green">$0.32</b> <img src="images/48.gif"
                                    hspace="1" height="17" align="absmiddle"></td>
                            <td align="center"><small>Sep-9-2021<br>10:13:17 PM</small></td>
                        </tr>
                        <tr>
                            <td><b>Total for selected options:</b></td>
                            <td nowrap="" align="right"> $2858.94 <img src="images/18.gif"
                                    align="absmiddle"><br>$1203.07 <img src="images/48.gif" align="absmiddle"><br> </td>
                            <td></td>
                        </tr>
                    </tbody>
                </table> <br>
                <center>
                    <ul class="pagination">
                        <li class="page-item"><a class="prev page-link disabled">&lt;&lt;</a></li>
                        <li class="page-item active"><a class="page-link">1</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:go(2)">2</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:go(3)">3</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:go(4)">4</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:go(5)">5</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:go(6)">6</a></li>
                        <li class="page-item"><a class="next page-link" href="javascript:go(2)">&gt;&gt;</a></li>
                        <li class="page-item"><a class="last page-link" href="javascript:go(65)">&gt;&gt;&gt;</a></li>
                    </ul>
                </center>
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
                    <div class="panel-title"> <a class="active font-24 pt-0 pb-0 text-capitalize" data-toggle="collapse"
                            href="#accordion1" aria-expanded="true">Transactions</a> </div>
                </div>
                <div id="accordion1" class="panel-collapse collapse in">
                    <div class="panel-body">
                        {include file='admin/components/transactions.tpl' transactions=$data.transactions}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{include file='admin/footer.tpl'}