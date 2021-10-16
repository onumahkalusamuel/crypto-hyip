{include file='admin/header.tpl' pageTitle='Newsletter'}

<script type="text/javascript" src="assets/nicEdit.js"></script>
<script type="text/javascript">
    bkLib.onDomLoaded(function() { nicEditors.allTextAreas({ fullPanel: true }) });
</script>

<table class="forTexts" width="100%" height="100%" cellspacing="0" cellpadding="10" border="0">
    <tbody>
        <tr>
            <td width="100%" valign="top" height="100%">
                <h3>Send Newsletter to Users:</h3>
                <script language="javascript">
                    function showHideUsernameField() {
                        var check = document.getElementById('changeRecipient').value;

                        if (check === 'user') {
                            document.getElementById('userNameRow').style.display = "table-row";
                        } else {
                            document.getElementById('userNameRow').style.display = "none";
                        }
                    }
                </script>
                <form method="post" action="{$route->urlFor('admin-newsletter')}">
                    <input type="hidden" name="form_token" value="{$form_token}">
                    <table class="form">
                        <tbody>
                            <tr>
                                <th>Receipient(s):</th>
                                <td> <select id="changeRecipient" name="to" class="inpts"
                                        onchange="showHideUsernameField()">
                                        <option value="user">One user (type a username below) </option>
                                        <option value="all">All users </option>
                                        <option value="active">All users which have made a deposit </option>
                                        <option value="inactive">All users which haven't made a deposit </option>
                                        {foreach from=$plans item=plan}
                                        <option value="plan_{$plan->ID}">
                                            All users which have made a deposit to
                                            {$plan->title|lower|capitalize}
                                        </option>
                                        {/foreach}
                                    </select> </td>
                            </tr>
                            <tr id="userNameRow">
                                <th>Username:</th>
                                <td><input type="text" name="userName" value="" class="inpts" size="30">
                                </td>
                            </tr>
                            <tr>
                                <th>Subject:</th>
                                <td><input type="text" name="subject" value="" class="inpts" required /></td>
                            </tr>
                            <tr>
                                <th>Message:<br></th>
                                <td><textarea name="message" class="inpts" rows="10" required></textarea> </td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>
                                    <input type="submit" value="Send Newsletter" class="btn btn-success sbmt">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
                <div class="alert alert-warning"> Send a newsletter:<br> This form helps you to send a newsletter to one
                    or several users.<br> Select a user or a user group, type a subject and a message text. Click on the
                    'send newsletter' button once! If you selected a user, the email will be sent immediately. But if it
                    is a user group, it will be added to the email queue. All emails on queue will be sent in the
                    background so you can continue what you are doing. 200 emails will be sent every 5 minutes; if you
                    have a very long list, it will take a while to complete.<br>
                    <br> Personalization:<br> You can use the following variables to personalize the newsletter:<br>
                    #name# - user's full name<br> #username# - user's login<br> #email# - user's e-mail
address<br> #date_register# - user's
                    registration date<br>
                </div>
            </td>
        </tr>
    </tbody>
</table>

{include file='admin/footer.tpl'}