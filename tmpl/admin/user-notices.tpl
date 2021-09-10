{include file='admin/header.tpl' pageTitle='Expiring Deposits'}


<table class="forTexts" width="100%" height="100%" cellspacing="0" cellpadding="10" border="0">
    <tbody>
        <tr>
            <td width="100%" valign="top" height="100%">
                <h3>User Notices:</h3>
                <div class="alert alert-warning"> <b>Demo version restriction!</b><br> You cannot add notices! </div>
                <div class="alert alert-warning"> Here you can send notices to your users.<br> You can specify list of
                    usernames and system will create notices for each user in the list.<br> </div>
                <h3>Add a Notice:</h3>
                <form method="post"><input type="hidden" name="form_id" value="16312751578641"><input type="hidden"
                        name="form_token" value="cba7e2d02a689e771ea3af759feedd08"> <input type="hidden" name="a"
                        value="user_notices"> <input type="hidden" name="action" value="add">
                    <table class="form">
                        <tbody>
                            <tr>
                                <th>Notice Title:</th>
                                <td><input type="text" name="title" value="" class="inpts"></td>
                            </tr>
                            <tr>
                                <th>Start Date:</th>
                                <td><input type="text" name="date" value="2021-09-10 11:59:17" class="inpts"></td>
                            </tr>
                            <tr>
                                <th>Expires in:</th>
                                <td><input type="text" name="expiration" value="0" class="inpts nosize" size="4"> days
                                    <small>(set 0 to skip limitation)</small></td>
                            </tr>
                            <tr>
                                <th>Users:</th>
                                <td><input type="text" name="user" value="" class="inpts" size="60"><br><small>Leave
                                        blank to show message to all users or enter usernames divided by comma</small>
                                </td>
                            </tr>
                            <tr>
                                <th>Notice:</th>
                                <td><textarea name="text" class="inpts" rows="3"></textarea></td>
                            </tr>
                            <tr>
                                <th></th>
                                <td><input type="submit" value="Add" class="sbmt"></td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </td>
        </tr>
    </tbody>
</table>

{include file='admin/footer.tpl'}