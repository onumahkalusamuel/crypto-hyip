{include file='admin/header.tpl' pageTitle='User Referrals'}

<table class="forTexts" width="100%" height="100%" cellspacing="0" cellpadding="10" border="0">
    <tbody>
        <tr>
            <td width="100%" valign="top" height="100%">
                <h3>User Referrals:</h3>
                <form method="post"><input type="hidden" name="form_id" value="16312748261542"><input type="hidden"
                        name="form_token" value="2a5f92785c27e11fdb78d7c7cf762952"> <input type="hidden" name="a"
                        value="user_refs"> <input type="hidden" name="action" value="change_upline"> <input
                        type="hidden" name="id" value="3256">
                    <table class="form">
                        <tbody>
                            <tr>
                                <th>Username:</th>
                                <td>wathkat</td>
                            </tr>
                            <tr>
                                <th>Upline:</th>
                                <td><input type="text" name="upline" value="" class="inpts" style="width:70%"> <input
                                        type="submit" value="Update" class="sbmt"></td>
                            </tr>
                            <tr>
                                <th>Direct Referrals:</th>
                                <td>Active: <b>0</b> / Total: <b>0</b></td>
                            </tr>
                            <tr>
                                <th>None Direct Referrals:</th>
                                <td>Active: <b>0</b> / Total: <b>0</b></td>
                            </tr>
                        </tbody>
                    </table>
                </form> <br><br>
                <table class="list">
                    <tbody>
                        <tr>
                            <th>User</th>
                            <th>Status</th>
                            <th>Stats</th>
                            <th>Action</th>
                        </tr>
                        <tr>
                            <td coslapn="5">No referrals found</td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>

{include file='admin/footer.tpl'}