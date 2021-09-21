<form action="" method="get">
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
                    <br class="hidden-xs hidden-sm" />
                    <button type="submit" class="btn btn-warning">Go</button>
                </div>
            </form>
        
        <div class="row">
            <div class="content-container">
                <div class="item">
                    <div class="title content">Details</div>
                    <div class="title content">Amount</div>
                    <div class="title content">Action</div>
                </div>

                {if !empty($localData) }
                    {foreach from=$localData key=index item=trans}
                        <div class="item">
                            <div class="content">
                                <strong>
                                    {$trans->userName}
                                </strong>&nbsp;
                                <small class="badge  {$trans->withdrawalStatus}">{$trans->withdrawalStatus}</small>
                            </div>
                            <div class="content">
                                ${$trans->amount}<br />
                                <img src="currencies/{$trans->cryptoCurrency}.gif" alt="{$trans->cryptoCurrency|upper}" />
                            </div>
                            <div class="content">
                                <a href="{$route->urlFor('user-view-withdrawal', ['id' => $trans->ID])}" class="btn btn-primary mb-5">VIEW</i></a><br />
                                {if $trans->withdrawalStatus === "pending"}
                                    <a href="{$route->urlFor('user-delete-withdrawal', ['id'=> $trans->ID])}" class="btn btn-danger mb-5" onclick="return confirmAction('Are you sure you want to cancel this withdrawal request?')">CANCEL</i></a>
                                {/if}
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
