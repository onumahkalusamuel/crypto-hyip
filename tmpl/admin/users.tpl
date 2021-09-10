{include file='admin/header.tpl' pageTitle='Users'}


<table class="forTexts" width="100%" height="100%" cellspacing="0" cellpadding="10" border="0">
    <tbody>
        <tr>
            <td width="100%" valign="top" height="100%">
                <script>
                    function reverce() { d = document.users; for (i = 0; i < d.elements.length; i++) { if (d.elements[i]
                                .type == "checkbox") { d.elements[i].checked = !d.elements[i].checked; } } }

                    function sort(obj) { document.users.p.value = 1;
                        s = obj.options[obj.selectedIndex].value.split(/\-/, 2);
                        document.users.o.value = s[0];
                        document.users.d.value = s[1];
                        document.users.submit(); }

                    function go(p) { document.users.p.value = p;
                        document.users.submit(); }
                </script>
                <h3>Users: <a class="sbmt btn btn-success" href="?a=user_edit">Add User</a> </h3>
                <form method="get" name="users"><input type="hidden" name="form_id" value="16312737331908"><input
                        type="hidden" name="form_token" value="14e6e0ef151b9f394a9081a2eb3ba88e"> <input type="hidden"
                        name="a" value="users"> <input type="hidden" name="action"> <input type="hidden" name="p">
                    <input type="hidden" name="o" value=""> <input type="hidden" name="d" value="0">
                    <table class="form controls nosize">
                        <tbody>
                            <tr>
                                <td>Search:</td>
                                <td> <input type="text" name="q" value="" class="inpts nosize" size="30"> </td>
                                <td> Order: <select name="order" class="inpts nosize" onchange="sort(this)">
                                        <option value="username-0">Username ↑</option>
                                        <option value="username-1">Username ↓</option>
                                        <option value="datereg-1">Registration ↑</option>
                                        <option value="datereg-0">Registration ↓</option>
                                        <option value="balance-1">Balance ↑</option>
                                        <option value="balance-0">Balance ↓</option>
                                        <option value="funded-1">Funded ↑</option>
                                        <option value="funded-0">Funded ↓</option>
                                        <option value="withdrawal-1">Withdrew ↑</option>
                                        <option value="withdrawal-0">Withdrew ↓</option>
                                        <option value="commissions-1">Commissions ↑</option>
                                        <option value="commissions-0">Commissions ↓</option>
                                    </select> </td>
                                <td> Per Page: <select name="onpage" class="inpts nosize"
                                        onchange="document.users.submit()">
                                        <option value="20" selected="">20 </option>
                                        <option value="50">50 </option>
                                        <option value="100">100 </option>
                                    </select> </td>
                            </tr>
                            <tr>
                                <td>Status:</td>
                                <td> <select name="status" class="inpts nosize">
                                        <option value="">--All--</option>
                                        <option value="on">Active</option>
                                        <option value="off">Disabled</option>
                                        <option value="suspended">Suspended</option>
                                        <option value="blocked">Blocked</option>
                                        <option value="not_confirmed">Not Confirmed</option>
                                    </select> </td>
                                <td></td>
                                <td style="text-align:right"> <input type="submit" value="Apply" class="sbmt"> </td>
                            </tr>
                        </tbody>
                    </table> <br>
                    <table class="list">
                        <tbody>
                            <tr>
                                <th>User</th>
                                <th>Amounts</th>
                                <th>Actions</th>
                            </tr>
                            <tr id="user_3256" class="row1">
                                <td valign="top">
                                    <table class="list sub" width="100%">
                                        <tbody>
                                            <tr>
                                                <td> <input type="checkbox" name="users[3256]" value="1"> <b
                                                        class="username">wathkat</b> <span
                                                        class="badge badge-success">Active</span> <br> </td>
                                            </tr>
                                            <tr>
                                                <td>Name: <i>fatoma mami</i></td>
                                            </tr>
                                            <tr>
                                                <td>Since: Sep-9-2021</td>
                                            </tr>
                                            <tr>
                                                <td> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>
                                    <table class="list sub" width="100%">
                                        <tbody>
                                            <tr>
                                                <td style="width:50%">Balance:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Funded:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Withdraw:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Commission:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td> <a href="?a=user_edit&amp;id=3256" class="sbmt btn-sm btn-success"
                                        style="margin-bottom:2px;">edit</a><br> <a href="?a=user_details&amp;id=3256"
                                        class="sbmt btn-sm btn-info" style="margin-bottom:2px;">funds</a> </td>
                            </tr>
                            <tr>
                                <td colspan="4"> </td>
                            </tr>
                            <tr id="user_3255" class="row2">
                                <td valign="top">
                                    <table class="list sub" width="100%">
                                        <tbody>
                                            <tr>
                                                <td> <input type="checkbox" name="users[3255]" value="1"> <b
                                                        class="username">Wael123</b> <span
                                                        class="badge badge-success">Active</span> <br> </td>
                                            </tr>
                                            <tr>
                                                <td>Name: <i>wael saleh</i></td>
                                            </tr>
                                            <tr>
                                                <td>Since: Sep-9-2021</td>
                                            </tr>
                                            <tr>
                                                <td> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>
                                    <table class="list sub" width="100%">
                                        <tbody>
                                            <tr>
                                                <td style="width:50%">Balance:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Funded:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Withdraw:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Commission:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td> <a href="?a=user_edit&amp;id=3255" class="sbmt btn-sm btn-success"
                                        style="margin-bottom:2px;">edit</a><br> <a href="?a=user_details&amp;id=3255"
                                        class="sbmt btn-sm btn-info" style="margin-bottom:2px;">funds</a> </td>
                            </tr>
                            <tr>
                                <td colspan="4"> </td>
                            </tr>
                            <tr id="user_3254" class="row1">
                                <td valign="top">
                                    <table class="list sub" width="100%">
                                        <tbody>
                                            <tr>
                                                <td> <input type="checkbox" name="users[3254]" value="1"> <b
                                                        class="username">maecayen</b> <span
                                                        class="badge badge-success">Active</span> <br> </td>
                                            </tr>
                                            <tr>
                                                <td>Name: <i>mae cayen</i></td>
                                            </tr>
                                            <tr>
                                                <td>Since: Sep-9-2021</td>
                                            </tr>
                                            <tr>
                                                <td> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>
                                    <table class="list sub" width="100%">
                                        <tbody>
                                            <tr>
                                                <td style="width:50%">Balance:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Funded:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Withdraw:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Commission:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td> <a href="?a=user_edit&amp;id=3254" class="sbmt btn-sm btn-success"
                                        style="margin-bottom:2px;">edit</a><br> <a href="?a=user_details&amp;id=3254"
                                        class="sbmt btn-sm btn-info" style="margin-bottom:2px;">funds</a> </td>
                            </tr>
                            <tr>
                                <td colspan="4"> </td>
                            </tr>
                            <tr id="user_3253" class="row2">
                                <td valign="top">
                                    <table class="list sub" width="100%">
                                        <tbody>
                                            <tr>
                                                <td> <input type="checkbox" name="users[3253]" value="1"> <b
                                                        class="username">Life</b> <span
                                                        class="badge badge-success">Active</span> <br> </td>
                                            </tr>
                                            <tr>
                                                <td>Name: <i>Bit</i></td>
                                            </tr>
                                            <tr>
                                                <td>Since: Sep-7-2021</td>
                                            </tr>
                                            <tr>
                                                <td> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>
                                    <table class="list sub" width="100%">
                                        <tbody>
                                            <tr>
                                                <td style="width:50%">Balance:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Funded:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Withdraw:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Commission:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td> <a href="?a=user_edit&amp;id=3253" class="sbmt btn-sm btn-success"
                                        style="margin-bottom:2px;">edit</a><br> <a href="?a=user_details&amp;id=3253"
                                        class="sbmt btn-sm btn-info" style="margin-bottom:2px;">funds</a> </td>
                            </tr>
                            <tr>
                                <td colspan="4"> </td>
                            </tr>
                            <tr id="user_3252" class="row1">
                                <td valign="top">
                                    <table class="list sub" width="100%">
                                        <tbody>
                                            <tr>
                                                <td> <input type="checkbox" name="users[3252]" value="1"> <b
                                                        class="username">ejecutar1</b> <span
                                                        class="badge badge-danger">Suspended</span> <br> </td>
                                            </tr>
                                            <tr>
                                                <td>Name: <i>Juan carlos Hernandez</i></td>
                                            </tr>
                                            <tr>
                                                <td>Since: Aug-30-2021</td>
                                            </tr>
                                            <tr>
                                                <td> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>
                                    <table class="list sub" width="100%">
                                        <tbody>
                                            <tr>
                                                <td style="width:50%">Balance:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Funded:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Withdraw:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Commission:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td> <a href="?a=user_edit&amp;id=3252" class="sbmt btn-sm btn-success"
                                        style="margin-bottom:2px;">edit</a><br> <a href="?a=user_details&amp;id=3252"
                                        class="sbmt btn-sm btn-info" style="margin-bottom:2px;">funds</a> </td>
                            </tr>
                            <tr>
                                <td colspan="4"> </td>
                            </tr>
                            <tr id="user_3251" class="row2">
                                <td valign="top">
                                    <table class="list sub" width="100%">
                                        <tbody>
                                            <tr>
                                                <td> <input type="checkbox" name="users[3251]" value="1"> <b
                                                        class="username">Abdulsaboor</b> <span
                                                        class="badge badge-success">Active</span> <br> </td>
                                            </tr>
                                            <tr>
                                                <td>Name: <i>Juan carlos Hernandez</i></td>
                                            </tr>
                                            <tr>
                                                <td>Since: Aug-30-2021</td>
                                            </tr>
                                            <tr>
                                                <td> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>
                                    <table class="list sub" width="100%">
                                        <tbody>
                                            <tr>
                                                <td style="width:50%">Balance:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Funded:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Withdraw:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Commission:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td> <a href="?a=user_edit&amp;id=3251" class="sbmt btn-sm btn-success"
                                        style="margin-bottom:2px;">edit</a><br> <a href="?a=user_details&amp;id=3251"
                                        class="sbmt btn-sm btn-info" style="margin-bottom:2px;">funds</a> </td>
                            </tr>
                            <tr>
                                <td colspan="4"> </td>
                            </tr>
                            <tr id="user_3250" class="row1">
                                <td valign="top">
                                    <table class="list sub" width="100%">
                                        <tbody>
                                            <tr>
                                                <td> <input type="checkbox" name="users[3250]" value="1"> <b
                                                        class="username">ruhul92</b> <span
                                                        class="badge badge-danger">Disabled</span> <br> </td>
                                            </tr>
                                            <tr>
                                                <td>Name: <i>Md.Ruhul Amin</i></td>
                                            </tr>
                                            <tr>
                                                <td>Since: Aug-29-2021</td>
                                            </tr>
                                            <tr>
                                                <td> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>
                                    <table class="list sub" width="100%">
                                        <tbody>
                                            <tr>
                                                <td style="width:50%">Balance:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Funded:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Withdraw:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Commission:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td> <a href="?a=user_edit&amp;id=3250" class="sbmt btn-sm btn-success"
                                        style="margin-bottom:2px;">edit</a><br> <a href="?a=user_details&amp;id=3250"
                                        class="sbmt btn-sm btn-info" style="margin-bottom:2px;">funds</a> </td>
                            </tr>
                            <tr>
                                <td colspan="4"> </td>
                            </tr>
                            <tr id="user_3249" class="row2">
                                <td valign="top">
                                    <table class="list sub" width="100%">
                                        <tbody>
                                            <tr>
                                                <td> <input type="checkbox" name="users[3249]" value="1"> <b
                                                        class="username">alhajue2023</b> <span
                                                        class="badge badge-success">Active</span> <br> </td>
                                            </tr>
                                            <tr>
                                                <td>Name: <i>Баран</i></td>
                                            </tr>
                                            <tr>
                                                <td>Since: Aug-27-2021</td>
                                            </tr>
                                            <tr>
                                                <td> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>
                                    <table class="list sub" width="100%">
                                        <tbody>
                                            <tr>
                                                <td style="width:50%">Balance:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Funded:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Withdraw:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Commission:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td> <a href="?a=user_edit&amp;id=3249" class="sbmt btn-sm btn-success"
                                        style="margin-bottom:2px;">edit</a><br> <a href="?a=user_details&amp;id=3249"
                                        class="sbmt btn-sm btn-info" style="margin-bottom:2px;">funds</a> </td>
                            </tr>
                            <tr>
                                <td colspan="4"> </td>
                            </tr>
                            <tr id="user_3248" class="row1">
                                <td valign="top">
                                    <table class="list sub" width="100%">
                                        <tbody>
                                            <tr>
                                                <td> <input type="checkbox" name="users[3248]" value="1"> <b
                                                        class="username">Googboy</b> <span
                                                        class="badge badge-success">Active</span> <br> </td>
                                            </tr>
                                            <tr>
                                                <td>Name: <i>Good</i></td>
                                            </tr>
                                            <tr>
                                                <td>Since: Aug-25-2021</td>
                                            </tr>
                                            <tr>
                                                <td> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>
                                    <table class="list sub" width="100%">
                                        <tbody>
                                            <tr>
                                                <td style="width:50%">Balance:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Funded:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Withdraw:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Commission:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td> <a href="?a=user_edit&amp;id=3248" class="sbmt btn-sm btn-success"
                                        style="margin-bottom:2px;">edit</a><br> <a href="?a=user_details&amp;id=3248"
                                        class="sbmt btn-sm btn-info" style="margin-bottom:2px;">funds</a> </td>
                            </tr>
                            <tr>
                                <td colspan="4"> </td>
                            </tr>
                            <tr id="user_3247" class="row2">
                                <td valign="top">
                                    <table class="list sub" width="100%">
                                        <tbody>
                                            <tr>
                                                <td> <input type="checkbox" name="users[3247]" value="1"> <b
                                                        class="username">testims</b> <span
                                                        class="badge badge-success">Active</span> <br> </td>
                                            </tr>
                                            <tr>
                                                <td>Name: <i></i></td>
                                            </tr>
                                            <tr>
                                                <td>Since: Aug-21-2021</td>
                                            </tr>
                                            <tr>
                                                <td> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>
                                    <table class="list sub" width="100%">
                                        <tbody>
                                            <tr>
                                                <td style="width:50%">Balance:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Funded:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Withdraw:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Commission:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td> <a href="?a=user_edit&amp;id=3247" class="sbmt btn-sm btn-success"
                                        style="margin-bottom:2px;">edit</a><br> <a href="?a=user_details&amp;id=3247"
                                        class="sbmt btn-sm btn-info" style="margin-bottom:2px;">funds</a> </td>
                            </tr>
                            <tr>
                                <td colspan="4"> </td>
                            </tr>
                            <tr id="user_3246" class="row1">
                                <td valign="top">
                                    <table class="list sub" width="100%">
                                        <tbody>
                                            <tr>
                                                <td> <input type="checkbox" name="users[3246]" value="1"> <b
                                                        class="username">Chutandn</b> <span
                                                        class="badge badge-success">Active</span> <br> </td>
                                            </tr>
                                            <tr>
                                                <td>Name: <i>Chutan Debnath</i></td>
                                            </tr>
                                            <tr>
                                                <td>Since: Aug-20-2021</td>
                                            </tr>
                                            <tr>
                                                <td> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>
                                    <table class="list sub" width="100%">
                                        <tbody>
                                            <tr>
                                                <td style="width:50%">Balance:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Funded:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Withdraw:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Commission:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td> <a href="?a=user_edit&amp;id=3246" class="sbmt btn-sm btn-success"
                                        style="margin-bottom:2px;">edit</a><br> <a href="?a=user_details&amp;id=3246"
                                        class="sbmt btn-sm btn-info" style="margin-bottom:2px;">funds</a> </td>
                            </tr>
                            <tr>
                                <td colspan="4"> </td>
                            </tr>
                            <tr id="user_3245" class="row2">
                                <td valign="top">
                                    <table class="list sub" width="100%">
                                        <tbody>
                                            <tr>
                                                <td> <input type="checkbox" name="users[3245]" value="1"> <b
                                                        class="username">Chutandebnath4</b> <span
                                                        class="badge badge-success">Active</span> <br> </td>
                                            </tr>
                                            <tr>
                                                <td>Name: <i>Chutan Debnath</i></td>
                                            </tr>
                                            <tr>
                                                <td>Since: Aug-20-2021</td>
                                            </tr>
                                            <tr>
                                                <td> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>
                                    <table class="list sub" width="100%">
                                        <tbody>
                                            <tr>
                                                <td style="width:50%">Balance:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Funded:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Withdraw:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Commission:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td> <a href="?a=user_edit&amp;id=3245" class="sbmt btn-sm btn-success"
                                        style="margin-bottom:2px;">edit</a><br> <a href="?a=user_details&amp;id=3245"
                                        class="sbmt btn-sm btn-info" style="margin-bottom:2px;">funds</a> </td>
                            </tr>
                            <tr>
                                <td colspan="4"> </td>
                            </tr>
                            <tr id="user_3244" class="row1">
                                <td valign="top">
                                    <table class="list sub" width="100%">
                                        <tbody>
                                            <tr>
                                                <td> <input type="checkbox" name="users[3244]" value="1"> <b
                                                        class="username">Vicky</b> <span
                                                        class="badge badge-success">Active</span> <br> </td>
                                            </tr>
                                            <tr>
                                                <td>Name: <i>Victoria Adaora</i></td>
                                            </tr>
                                            <tr>
                                                <td>Since: Aug-18-2021</td>
                                            </tr>
                                            <tr>
                                                <td> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>
                                    <table class="list sub" width="100%">
                                        <tbody>
                                            <tr>
                                                <td style="width:50%">Balance:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Funded:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Withdraw:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Commission:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td> <a href="?a=user_edit&amp;id=3244" class="sbmt btn-sm btn-success"
                                        style="margin-bottom:2px;">edit</a><br> <a href="?a=user_details&amp;id=3244"
                                        class="sbmt btn-sm btn-info" style="margin-bottom:2px;">funds</a> </td>
                            </tr>
                            <tr>
                                <td colspan="4"> </td>
                            </tr>
                            <tr id="user_3243" class="row2">
                                <td valign="top">
                                    <table class="list sub" width="100%">
                                        <tbody>
                                            <tr>
                                                <td> <input type="checkbox" name="users[3243]" value="1"> <b
                                                        class="username">yasirkhan</b> <span
                                                        class="badge badge-success">Active</span> <br> </td>
                                            </tr>
                                            <tr>
                                                <td>Name: <i>yasir khan</i></td>
                                            </tr>
                                            <tr>
                                                <td>Since: Aug-15-2021</td>
                                            </tr>
                                            <tr>
                                                <td> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>
                                    <table class="list sub" width="100%">
                                        <tbody>
                                            <tr>
                                                <td style="width:50%">Balance:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Funded:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Withdraw:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Commission:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td> <a href="?a=user_edit&amp;id=3243" class="sbmt btn-sm btn-success"
                                        style="margin-bottom:2px;">edit</a><br> <a href="?a=user_details&amp;id=3243"
                                        class="sbmt btn-sm btn-info" style="margin-bottom:2px;">funds</a> </td>
                            </tr>
                            <tr>
                                <td colspan="4"> </td>
                            </tr>
                            <tr id="user_3242" class="row1">
                                <td valign="top">
                                    <table class="list sub" width="100%">
                                        <tbody>
                                            <tr>
                                                <td> <input type="checkbox" name="users[3242]" value="1"> <b
                                                        class="username">devsphere</b> <span
                                                        class="badge badge-success">Active</span> <br> </td>
                                            </tr>
                                            <tr>
                                                <td>Name: <i>Smolov Oleg Petrovich</i></td>
                                            </tr>
                                            <tr>
                                                <td>Since: Aug-14-2021</td>
                                            </tr>
                                            <tr>
                                                <td> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>
                                    <table class="list sub" width="100%">
                                        <tbody>
                                            <tr>
                                                <td style="width:50%">Balance:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Funded:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Withdraw:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Commission:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td> <a href="?a=user_edit&amp;id=3242" class="sbmt btn-sm btn-success"
                                        style="margin-bottom:2px;">edit</a><br> <a href="?a=user_details&amp;id=3242"
                                        class="sbmt btn-sm btn-info" style="margin-bottom:2px;">funds</a> </td>
                            </tr>
                            <tr>
                                <td colspan="4"> </td>
                            </tr>
                            <tr id="user_3241" class="row2">
                                <td valign="top">
                                    <table class="list sub" width="100%">
                                        <tbody>
                                            <tr>
                                                <td> <input type="checkbox" name="users[3241]" value="1"> <b
                                                        class="username">Solowise</b> <span
                                                        class="badge badge-success">Active</span> <br> </td>
                                            </tr>
                                            <tr>
                                                <td>Name: <i>Solowise</i></td>
                                            </tr>
                                            <tr>
                                                <td>Since: Aug-13-2021</td>
                                            </tr>
                                            <tr>
                                                <td> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>
                                    <table class="list sub" width="100%">
                                        <tbody>
                                            <tr>
                                                <td style="width:50%">Balance:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Funded:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Withdraw:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Commission:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td> <a href="?a=user_edit&amp;id=3241" class="sbmt btn-sm btn-success"
                                        style="margin-bottom:2px;">edit</a><br> <a href="?a=user_details&amp;id=3241"
                                        class="sbmt btn-sm btn-info" style="margin-bottom:2px;">funds</a> </td>
                            </tr>
                            <tr>
                                <td colspan="4"> </td>
                            </tr>
                            <tr id="user_2" class="row1">
                                <td valign="top">
                                    <table class="list sub" width="100%">
                                        <tbody>
                                            <tr>
                                                <td> <input type="checkbox" name="users[2]" value="1"> <b
                                                        class="username">demo</b> <span
                                                        class="badge badge-success">Active</span> <br> </td>
                                            </tr>
                                            <tr>
                                                <td>Name: <i>demo account</i></td>
                                            </tr>
                                            <tr>
                                                <td>Since: May-9-2017</td>
                                            </tr>
                                            <tr>
                                                <td>Upline: <a href="?a=user_refs&amp;id=2">demo</a></td>
                                            </tr>
                                            <tr>
                                                <td> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>
                                    <table class="list sub" width="100%">
                                        <tbody>
                                            <tr>
                                                <td style="width:50%">Balance:</td>
                                                <td> <b style="color:navy">$1281.62</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Funded:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Withdraw:</td>
                                                <td> <b style="color:red">$936.94</b> </td>
                                            </tr>
                                            <tr>
                                                <td>Commission:</td>
                                                <td> <b style="color:gray">$0.00</b> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td> <a href="?a=user_edit&amp;id=2" class="sbmt btn-sm btn-success"
                                        style="margin-bottom:2px;">edit</a><br> <a href="?a=user_details&amp;id=2"
                                        class="sbmt btn-sm btn-info" style="margin-bottom:2px;">funds</a> </td>
                            </tr>
                            <tr>
                                <td colspan="4"> </td>
                            </tr>
                        </tbody>
                    </table><br> <a href="javascript:reverce()" class="sbmt btn btn-primary">Select All</a> &nbsp;
                    <script>
                        function confirm_action(act, msg) { if (confirm(msg)) { document.users.action.value = act;
                                document.users.submit(); } return false; }
                    </script> <input type="button" value="Set Active" class="sbmt btn btn-success"
                        onclick="confirm_action('set_active', 'Do you really want set Active selected users?');"> &nbsp;
                    <input type="button" value="Set Disabled" class="sbmt btn btn-danger"
                        onclick="confirm_action('set_disabled', 'Do you really want set Disabled selected users?');">
                    &nbsp; <input type="button" value="Set Suspended" class="sbmt btn btn-warning"
                        onclick="confirm_action('set_suspended', 'Do you really want set Suspended selected users?');">
                    &nbsp; <input type="button" value="Delete" class="sbmt btn btn-danger"
                        onclick="confirm_action('delete', 'Do you really want delete selected users?\nNON REVERSIBLE!!! ');">
                    &nbsp; <br><br>
                    <center>
                        <ul class="pagination">
                            <li class="page-item"><a class="prev page-link disabled">&lt;&lt;</a></li>
                            <li class="page-item active"><a class="page-link">1</a></li>
                            <li class="page-item"><a class="next page-link disabled">&gt;&gt;</a></li>
                        </ul>
                    </center>
                </form> <a class="sbmt btn btn-success" href="?a=user_edit">Add User</a> <br> <br>
                <div class="alert alert-warning"> Members list:<br><br> Members list splits your members to 3 types:
                    Active, Suspended and Disabled.<br> Active: User can login and receive earnings if deposited in the
                    system.<br> Suspended: User can login, but cannot not receive any earnings from deposits.<br>
                    Disabled: User can not login and cannot receive any earnings.<br> <br> The top left search form
                    helps you to search a user by the nickname or e-mail. You can also enter a part of a nickname or
                    e-mail to search users.<br> The top right form helps you to navigate between the user types.<br> You
                    can see the following information in the members list:<br> Nickname, Registration date, Status,
                    Account, Deposit, Earned, Withdrew. You can see not confirmed users also if you use double opt-in
                    registration.<br> <br> Edit user information: click on the "Edit" button next to a user<br> Delete
                    user: click on the "delete" button and confirm this action;<br> Send e-mail to user: click on the
"e-mail" button and send e-mail to user.<br> "Manage funds" button will help you to check any user's
                    history and change his funds.<br> Add a new Member: click on the "Add a new member&amp; button.
                    You&amp;ll see the form for adding a new member. </div>
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
                            href="#accordion1" aria-expanded="true">Users</a> </div>
                </div>
                <div id="accordion1" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <h5 class="help">
                            <a class="btn text-uppercase btn-theme-colored btn-flat"
                                href="{$route->urlFor('admin-view-user', ['id' => 'new'])}">Add New User</a>
                        </h5>

                        {include file='admin/components/users-table.tpl' users=$data.users}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{include file='admin/footer.tpl'}