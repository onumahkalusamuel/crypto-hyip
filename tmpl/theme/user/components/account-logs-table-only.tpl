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

<div class="container">
    <div class="content-container">
        <div class="item">
            <div class="title content">Details</div>
            <div class="title content text-sm-left text-center">Amount</div>
            <div class="title content">Date</div>
        </div>

        {if !empty($transactions)}
            {foreach from=$transactions  key=index item=trans}
                <div class="item">
                    <div class="content text-uppercase">
                        <strong>
                            {$trans->userName}
                        </strong>&nbsp;
                        <small class="badge {$trans->logType}">{$trans->logType}</small><br />
                        <small>{$trans->transactionDetails}</small>
                    </div>
                    <div class="content text-sm-left text-center">
                        ${$trans->amount}<br />
                        <img src="currencies/{$trans->cryptoCurrency}.gif" alt="{$trans->cryptoCurrency|upper}" />
                    </div>
                    <div class="content">
                        <small> {$trans->createdAt}</small>
                    </div>
                </div>
            {/foreach}
        {else}
            <div class="item">
                <div class="content">
                    No transactions found.
                </div>
            </div>
        {/if}
    </div>
</div>