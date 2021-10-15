{include file='admin/header.tpl' pageTitle='Settings'}

{assign var=settings value=$data.settings}
{assign var=activeCurrencies value=","|explode:$settings.activeCurrencies}

<table class="forTexts" width="100%" height="100%" cellspacing="0" cellpadding="10" border="0">
    <tbody>
        <tr>
            <td width="100%" valign="top" height="100%">
                <h3>Edit E-mail Templates:</h3>
                <form method="post">
                    <table class="list">
                        <tbody>
                            {foreach from=$templates item=item}
                                <tr class="row1">
                                    <td>{$item->title}</td>
                                    <td><a href="{$route->urlFor('admin-email-template', ['id' => $item->ID])}"
                                            class="sbmt btn-sm btn-success">edit</a></td>
                                </tr>
                            {/foreach}
                            <tr>
                                <td colspan="2"><input type="submit" value="Update" class="sbmt"></td>
                            </tr>
                        </tbody>
                    </table>
                </form>
                <h3>Template Presets</h3>
                <form method="post">
                    <table class="form">
                        <tbody>
                            <tr>
                                <th>General Email Header:</th>
                                <td>
                                    <textarea name="generalEmailHeader" class="inpts" cols="100" rows="20"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <th>General Email Footer:</th>
                                <td>
                                    <textarea name="generalEmailFooter" class="inpts" cols="100" rows="20"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <td><input type="submit" value="Update" class="sbmt"></td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </td>
        </tr>
    </tbody>
</table>

{include file='admin/footer.tpl'}