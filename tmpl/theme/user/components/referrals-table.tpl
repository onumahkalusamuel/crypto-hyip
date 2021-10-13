<form action="" class="row container p-0 mb-4" method="get">
    <div class="form-group col-sm-4 col-md-3">
        <label for="query">Referral Username:</label>
        <input class="form-control" type="text" id="query" name="query" value="{$smarty.get.query}" />
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
        <button type="submit" class="btn btn-block btn-danger">Go</button>
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
                {foreach from=$localData item=$trans}
                    <tr>
                        <td style="line-height:1.5">
                            <strong>
                                {$trans->referredUserName}
                            </strong><br />
                            <strong>Referred by:</strong>
                            {$trans->referralUserName}<br />
                            <strong>Date:</strong>
                            {$trans->createdAt}<br />
                        </td>
                        <td>
                            ${$trans->referralBonus|string_format:"%.2f"}<br />
                        </td>
                        <td>
                            <a href="{$route->urlFor('user-view-referral', ['id' => $trans->ID])}" title="View full details"
                                class="btn btn-primary btn-sm"><i class="icon-eye"></i></a><br />
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