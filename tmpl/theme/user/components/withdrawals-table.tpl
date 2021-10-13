<form action="" class="row container p-0 mb-4" method="get">
    <div class="form-group col-sm-4 col-md-3">
        <label for="withdrawalStatus">Withdrawal Status:</label>
        <select id="withdrawalStatus" name="withdrawalStatus" class="form-control">
            <option {if $smarty.get.withdrawalStatus == ''}selected{/if} value="">Show All</option>
            <option {if $smarty.get.withdrawalStatus == 'approved'}selected{/if} value="approved">Approved</option>
            <option {if $smarty.get.withdrawalStatus == 'pending'}selected{/if} value="pending">Pending</option>
            <option {if $smarty.get.withdrawalStatus == 'declined'}selected{/if} value="declined">Declined</option>
        </select>
    </div>
    <div class="form-group col-sm-4 col-md-3">
        <label for="from">From:</label>
        <input class="form-control" type="date" id="from" name="from" value="{$smarty.get.from}" />
    </div>
    <div class="form-group col-sm-4 col-md-3">
        <label for="to">To:</label>
        <input class="form-control" type="date" id="to" name="to" value="{$smarty.get.to}" />
    </div>
    <div class="form-group col-sm-4 col-md-3">
        <br class="d-flex d-md-inline" />
        <button type="submit" class="btn btn-danger btn-block">Go</button>
    </div>
</form>

<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Details</th>
                <th>Amount</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            {if !empty($localData)}
                {foreach from=$localData key=$index item=$trans}
                    <tr>
                        <td>
                            <strong>
                                {$trans->userName}
                            </strong>&nbsp;
                            <small class="badge 
                                {if $trans->withdrawalStatus === "pending"}badge-warning{/if}
                                {if $trans->withdrawalStatus === "approved"}badge-success{/if}
                                {if $trans->withdrawalStatus === "declined"}badge-danger{/if}
                            ">{$trans->withdrawalStatus}</small>
                        </td>
                        <td>
                            ${$trans->amount|string_format:"%.2f"}<br class="d-none d-lg-inline" />
                            <img style="width: unset; height:unset; border-radius:unset"
                                src="currencies/{$trans->cryptoCurrency}.gif" alt="{$trans->cryptoCurrency|upper}" />
                        </td>
                        <td class="text-danger">
                            <a href="{$route->urlFor('user-view-withdrawal', ['id' => $trans->ID])}" title="View full details"
                                class="btn btn-primary btn-sm mb-1"><i class="icon-eye"></i></a>
                            {if $trans->withdrawalStatus === "pending"}
                                <a href="{$route->urlFor('user-delete-withdrawal', ['id'=> $trans->ID])}"
                                    class="btn btn-danger btn-sm mb-1" title="Delete record"
                                    onclick="return confirm('Are you sure you want to cancel this withdrawal request?')"><i
                                        class="icon-trash"></i></a>
                            {/if}
                        </td>
                    </tr>
                {/foreach}
            {else}
                <tr>
                    <td colspan="3">No data found.</td>
                </tr>
            {/if}
        </tbody>
    </table>
</div>

{include file="theme/user/components/pagination.tpl" total_rows=$totalRows total_retrieved=$localData|@count}