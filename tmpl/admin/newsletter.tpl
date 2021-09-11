{include file='admin/header.tpl' pageTitle='Expiring Deposits'}


<table class="forTexts" width="100%" height="100%" cellspacing="0" cellpadding="10" border="0">
    <tbody>
        <tr>
            <td width="100%" valign="top" height="100%">
                <h3>Send a newsletter to users:</h3>
                <div class="alert alert-warning"> <b>Demo version restriction!</b><br> You cannot send newsletters!
                </div>
                <script language="javascript">
                    var u = Array(0, 17, 56, -39, 15, 15);

                    function checkform() { if (document.formb.to.selectedIndex == 0) { if (document.formb.username
                                .value == "") { alert(
                            "Please enter a username!"); return false; } } else { return confirm(
                                    "Are you sure you want to send the newsletter to " + u[document.formb.to
                                        .selectedIndex] + " users?"); } return true; }
                </script>
                <script>
                    function send_test() { open("", "test_email", "width=300, height=100");
                        document.formb.target = "test_email";
                        document.formb.action.value = "test_email";
                        document.formb.submit();
                        document.formb.target = "_self";
                        document.formb.action.value = "newsletter"; }

                    function send_mail() { open("", "send_email", "width=500, height=300");
                        document.formb.target = "send_email";
                        document.formb.submit(); }
                </script>
                <form method="post" onsubmit="return checkform();" name="formb"><input type="hidden" name="form_id"
                        value="16312751659325"><input type="hidden" name="form_token"
                        value="d5a242769254e6bda562b634d0efc9b7"> <input type="hidden" name="a" value="newsletter">
                    <input type="hidden" name="action" value="newsletter">
                    <table class="form">
                        <tbody>
                            <tr>
                                <th>Being sent to:</th>
                                <td> <select name="to" class="inpts">
                                        <option value="user">One user (type a username below) </option>
                                        <option value="all">All users </option>
                                        <option value="active">All users which have made a deposit </option>
                                        <option value="passive">All users which haven't made a deposit </option>
                                        <option value="plan_1">All users which have made a deposit to 1 year 2.4% daily
                                        </option>
                                        <option value="plan_2">All users which have made a deposit to 100 days 3.4%
                                            daily</option>
                                    </select> </td>
                            </tr>
                            <tr>
                                <th>Username:</th>
                                <td><input type="text" name="username" value="" class="inpts" size="30"></td>
                            </tr>
                            <tr>
                                <th>Subject:</th>
                                <td><input type="text" name="subject" value="" class="inpts"></td>
                            </tr>
                            <tr>
                                <th>Use Presets?</th>
                                <td> <select name="use_presets" class="inpts">
                                        <option value="1">Yes</option>
                                        <option value="0" selected="">No</option>
                                    </select> </td>
                            </tr>
                            <tr>
                                <th>Text Message:</th>
                                <td><textarea name="text" class="inpts" rows="10"></textarea></td>
                            </tr>
                            <tr>
                                <th>HTML Message:<br><input type="checkbox" name="use_html" value="1"> Use it?</th>
                                <td> <textarea name="html" class="inpts " rows="10"></textarea> </td>
                            </tr>
                            <tr>
                                <th></th>
                                <td><input type="submit" value="Send Newsletter" class="sbmt" onclick="send_mail()">
                                    <input type="button" value="Send Test E-mail" class="sbmt" onclick="send_test()">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
                <div class="alert alert-warning"> Send a newsletter:<br> This form helps you to send a newsletter to one
                    or several users.<br> Select a user or a user group, type a subject and a message text. Click on the
                    'send newsletter' button once! It may take a time for a huge list.<br><br> Personalization:<br> You
                    can use the following variables to personalize the newsletter:<br> #name# - user's first and last
name<br> #username# - user's login<br> #email# - user's e-mail address<br> #date_register# - user's
                    registration date<br> </div>
            </td>
        </tr>
    </tbody>
</table>

{include file='admin/footer.tpl'}