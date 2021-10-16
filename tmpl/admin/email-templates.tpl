{include file='admin/header.tpl' pageTitle='Settings'}

{assign var=settings value=$data.settings}
{assign var=activeCurrencies value=","|explode:$settings.activeCurrencies}

<script type="text/javascript" src="assets/nicEdit.js"></script>
<script type="text/javascript">
    bkLib.onDomLoaded(function() { nicEditors.allTextAreas({ fullPanel: true }) });
</script>

<table class="forTexts" width="100%" height="100%" cellspacing="0" cellpadding="10" border="0">
    <tbody>
        <tr>
            <td width="100%" valign="top" height="100%">
                <h3>Edit E-mail Templates:</h3>
                <table class="list">
                    <tbody>
                        {foreach from=$templates item=item}
                            <tr class="row1">
                                <td>{$item->title}</td>
                                <td><a href="{$route->urlFor('admin-email-template', ['id' => $item->ID])}"
                                        class="sbmt btn-sm btn-success">edit</a></td>
                            </tr>
                        {/foreach}
                    </tbody>
                </table>
                <h3>Template Presets:</h3>
                <form method="post" action="{$route->urlFor('admin-email-templates')}">
                    <table class="form">
                        <tbody>
                            <tr>
                                <th>General Email Header:</th>
                                <td>
                                    <textarea name="generalEmailHeader" class="inpts" cols="100"
                                        rows="20">{$generalEmailHeader}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <th>General Email Footer:</th>
                                <td>
                                    <textarea name="generalEmailFooter" class="inpts" cols="100"
                                        rows="20">{$generalEmailFooter}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <td><input type="submit" value="Update" class="sbmt btn-success"></td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </td>
        </tr>
    </tbody>
</table>

{include file='admin/footer.tpl'}