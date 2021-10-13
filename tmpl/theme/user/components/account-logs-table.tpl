<form action="" class="row p-0 mb-4" method="get">
    <div class="form-group col-sm-4 col-md-4">
        <label for="logType">Log Type:</label>
        <select id="logType" name="logType" class="form-control">
            <option {if $smarty.get.logType == 'all'}selected{/if} value="all">Show All Logs</option>
            <option {if $smarty.get.logType == 'deposit'}selected{/if} value="deposit">Deposits</option>
            <option {if $smarty.get.logType == 'withdrawal'}selected{/if} value="withdrawal">Withdrawals</option>
            <option {if $smarty.get.logType == 'deposit-earning'}selected{/if} value="deposit-earning">Deposit Earnings
            </option>
            <option {if $smarty.get.logType == 'bonus'}selected{/if} value="bonus">Bonus</option>
            <option {if $smarty.get.logType == 'penalty'}selected{/if} value="penalty">Penalty</option>
            <option {if $smarty.get.logType == 'referral'}selected{/if} value="referral">Referral Commission</option>
        </select>
    </div>
    <div class="form-group col-sm-4 col-md-2">
        <label for="from">From:</label>
        <input class="form-control" type="date" id="from" name="from" value="{$smarty.get.from}" />
    </div>
    <div class="form-group col-sm-4 col-md-2">
        <label for="to">To:</label>
        <input class="form-control" type="date" id="to" name="to" value="{$smarty.get.to}" />
    </div>
    <div class="form-group col-sm-4 col-md-2">
        <label for="rpp">Per Page:</label>
        <select id="rpp" name="rpp" class="form-control">
            <option {if $smarty.get.rpp == '20'} selected{/if}>20</option>
            <option {if $smarty.get.rpp == '50'} selected{/if}>50</option>
            <option {if $smarty.get.rpp == '100'} selected{/if}>100</option>
        </select>
    </div>
    <div class="form-group col-sm-4 col-md-2">
        <br class="d-flex d-sm-inline" />
        <button type="submit" class="btn btn-danger btn-block">Go</button>
    </div>
</form>

{include file="theme/user/components/account-logs-table-only.tpl" transactions=$localData}

{include file="theme/user/components/pagination.tpl" total_rows=$totalRows total_retrieved=$localData|@count
}