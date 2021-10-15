{include file='admin/header.tpl' pageTitle='Settings'}

{assign var=settings value=$data.settings}
{assign var=activeCurrencies value=","|explode:$settings.activeCurrencies}

<table class="forTexts" width="100%" height="100%" cellspacing="0" cellpadding="10" border="0">
    <tbody>
        <tr>
            <td width="100%" valign="top" height="100%">
                <h3>Edit Email Template "{$template->title}"</h3>
                <form method="post">
                    <input type="hidden" name="ID" value="{$template->ID}">
                    <table class="form">
                        <tbody>
                            <tr>
                                <th>Subject:</th>
                                <td><input type="text" name="subject" value="{$template->subject}" class="inpts"
                                        size="100"></td>
                            </tr>
                            <tr>
                                <th>Use Global Header?</th>
                                <td> <select name="useGlobalHeader" class="inpts">
                                        <option value="1" {if $template->useGlobalHeader == "1"}selected{/if}>Yes
                                        </option>
                                        <option value="0" {if $template->useGlobalHeader == "0"}selected{/if}>No
                                        </option>
                                    </select> </td>
                            </tr>
                            <tr>
                                <th>Use Global Footer?</th>
                                <td> <select name="useGlobalFooter" class="inpts">
                                        <option value="1" {if $template->useGlobalFooter == "1"}selected{/if}>Yes
                                        </option>
                                        <option value="0" {if $template->useGlobalFooter == "0"}selected{/if}>No
                                        </option>
                                    </select> </td>
                            </tr>
                            <tr>
                                <th>Message:</th>
                                <td><textarea name="content" cols="100" rows="20"
                                        class="inpts">{$template->content}</textarea></td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>
                                    <input type="submit" value="Update" class="btn-sm btn-success sbmt">
                                    <input type="button" value="Send Test E-mail" class="sbmt" onclick="send_test()">
                                    <a class="sbmt btn-sm btn-danger"
                                        href="{$route->urlFor('admin-email-templates')}">Cancel</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
                <div class="alert alert-warning">{$template->description}</div>
            </td>
        </tr>
    </tbody>
</table>

{include file='admin/footer.tpl'}