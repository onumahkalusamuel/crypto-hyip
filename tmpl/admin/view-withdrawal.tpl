{include file='admin/header.tpl' pageTitle='Withdrawal'}

{assign var=withdrawal value=$data.withdrawal}



<table class="forTexts" width="100%" height="100%" cellspacing="0" cellpadding="10" border="0">
    <tbody>
        <tr>
            <td width="100%" valign="top" height="100%">
                <h3>View Withdrawal:</h3>
    
                    <table class="form settings">
                        <tbody>
                            <tr>
                                <th>Request Date:</th>
                                <td>
                                {$withdrawal->createdAt}
                                        </td>
                            </tr>
                            <tr>
                                <th>Username:</th>
                                <td>
                                {$withdrawal->userName}
                                        </td>
                            </td>
                            <tr>
                                <th>Crypto Currency:</th>
                                <td>
                                <img src="currencies/{$withdrawal->cryptoCurrency}.gif" alt="{$withdrawal->cryptoCurrency|upper}" />
                                </td>
                            </tr>
                            
                            <tr>
                                <th>Withdrawal Address:</th>
                 <td>{$withdrawal->withdrawalAddress}</td>
                            </tr>
                            <tr>
                                <th>Amount:</th>
                                <td>${$withdrawal->amount|string_format:"%.2f"}</td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td><small class="badge badge-{$withdrawal->withdrawalStatus}">{$withdrawal->withdrawalStatus}</small></td>
                            </tr>
                        </tbody>
                    </table>
            </td>
        </tr>
    </tbody>
</table>





{include file='admin/footer.tpl'}
