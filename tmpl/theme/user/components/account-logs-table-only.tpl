<style>
    .penalty {
        background-color: #dc3545;
    }

    .bonus {
        background-color: #6c757d;
    }

    .deposit {
        background-color: #ffc107;
    }

    .withdrawal {
        background-color: #28a745;
    }

    .referral {
        background-color: #17a2b8;
    }

    .earning {
        background-color: #007bff;
    }
</style>

<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Details</th>
                <th>Amount</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            {if !empty($transactions)}
                {foreach from=$transactions item=$trans}
                    <tr>
                        <td>
                            <strong>
                                {$trans->userName}
                            </strong>&nbsp;
                            <small class="badge
                                {if $trans->logType === "penalty"}badge-danger{/if}
                                {if $trans->logType === "bonus"}badge-info{/if}
                                {if $trans->logType === "deposit"}badge-success{/if}
                                {if $trans->logType === "withdrawal"}badge-secondary{/if}
                                {if $trans->logType === "referral"}badge-badge-warning{/if}
                                {if $trans->logType === "earning"}badge-success{/if}
                            ">{$trans->logType}</small><br />
                            <small>{$trans->transactionDetails}</small>
                        </td>
                        <td>
                            ${$trans->amount}<br class="d-none d-lg-inline" />
                            <img style="width: unset; height:unset; border-radius:unset"
                                src="currencies/{$trans->cryptoCurrency}.gif" alt="{$trans->cryptoCurrency|upper}" />
                        </td>
                        <td>
                            <small> {$trans->createdAt}</small>
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