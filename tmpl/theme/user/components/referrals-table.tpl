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


<div class="container p-0">
    <div class="content-container">
        <div class="item">
            <div class="title content">Details</div>
            <div class="title content text-left text-lg-center">Earned</div>
            <div class="title content">Action</div>
        </div>

        {if !empty($localData)}
            {foreach from=$localData key=index item=trans}
                <div class="item">
                    <div class="content">
                        <strong>
                            {$trans->referredUserName}
                        </strong><br />
                        <small>
                            <strong>Referred by:</strong>
                            {$trans->referralUserName}<br />
                            <strong>Date:</strong>
                            {$trans->createdAt}<br />
                        </small>
                    </div>
                    <div class="content text-left text-lg-center">
                        ${$trans->referralBonus}<br />
                    </div>
                    <div class="content">
                        <a href="{$route->urlFor('user-view-referral', ['id' => $trans->ID])}"
                            class="btn btn-primary">VIEW</i></a><br />
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