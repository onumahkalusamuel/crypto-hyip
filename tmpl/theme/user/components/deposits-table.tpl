<form action="" class="row container" method="get">
    <div class="form-group col-sm-4 col-md-3">
        <label for="depositStatus">Deposit Status:</label>
        <select id="depositStatus" name="depositStatus" class="form-control">
            <option {if $smarty.get.depositStatus==''}selected{/if} value="">Show All</option>
            <option {if $smarty.get.depositStatus=='approved'}selected{/if} value="approved">Approved
            </option>
            <option {if $smarty.get.depositStatus=='pending'}selected{/if} value="pending">Pending
            </option>
            <option {if $smarty.get.depositStatus=='released'}selected{/if} value="released">Released
            </option>
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
        <br class="hidden-xs hidden-sm" />
        <button type="submit" class="btn btn-warning btn-block">Go</button>
    </div>
</form>
<style>
    .pending {
        background-color: #ffc107;
    }

    .approved {
        background-color: #28a745;
    }

    .released {
        background-color: #007bff;
    }
</style>

<div class="container">
    <div class="content-container">
        <div class="item">
            <div class="title content">Details</div>
            <div class="title content text-center text-sm-left">Amount</div>
            <div class="title content">Action</div>
        </div>

        {if !empty($localData)}
            {foreach from=$localData key=$index item=$trans}
                <div class="item">
                    <div class="content text-uppercase">
                        <strong>
                            {$trans->planTitle}
                        </strong>&nbsp;
                        <small class="badge {$trans->depositStatus}">
                            {$trans->depositStatus}
                        </small><br />
                        {if $trans->depositStatus !== "pending"}
                            <small>
                                <strong>Start Date:</strong>
                                {$trans->depositApprovalDate}<br />
                                <strong>End Date:</strong>
                                {$trans->lastInterestDate}<br />
                                <strong>ROI:</strong>
                                ${$trans->interestBalance}
                            </small>
                        {/if}
                    </div>
                    <div class="content text-center text-sm-left">${$trans->amount}<br />
                        <img src="currencies/{$trans->cryptoCurrency}.gif" alt="{$trans->cryptoCurrency|upper}" />
                    </div>
                    <div class="content">
                        <a href="{$route->urlFor('user-view-deposit', ['id' => $trans->ID])}"
                            class="btn btn-primary btn-sm btn-flat mb-5">VIEW</i></a><br />
                    </div>
                </div>
            {/foreach}
        {else}
            <div class="item">
                <div class="content">
                    No data found.
                </div>
            </div>
        {/if}
    </div>
</div>
{include file="theme/user/components/pagination.tpl" total_rows=$totalRows total_retrieved=$localData|@count}