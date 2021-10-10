{assign var="active" value="transactions"}
{extends file="theme/user/layout.tpl"}
{block name=title}Transactions{/block}

{block name="body"}
    <div class="nk-block">
        <div class="container p-0">
            
                <h4>Account Logs</h4>
                {include file="theme/user/components/account-logs-table.tpl" localData=$data.data totalRows=$data.total_rows}
            
        </div>
    </div>
{/block}