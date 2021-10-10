{assign var="active" value="withdrawals"}
{extends file="theme/user/layout.tpl"}
{block name=title}Withdrawal{/block}

{assign var=withdrawal value=$data.withdrawal}
{block name="body"}
    <div class="nk-block">
        <div class="container p-0">
            <div class="content-container">
                <div class="item">
                    <div class="title">Withdrawal Request Date:</div>
                    <div class="content">{$withdrawal->createdAt}</div>
                </div>
                <div class="item">
                    <div class="title">Username:</div>
                    <div class="content">{$withdrawal->userName}</div>
                </div>
                <div class="item">
                    <div class="title">Payment Method:</div>
                    <div class="content">{$withdrawal->cryptoCurrency|upper}&nbsp;
                        <img src="currencies/{$withdrawal->cryptoCurrency}.gif" alt="{$withdrawal->cryptoCurrency|upper}" />
                    </div>
                </div>
                <div class="item">
                    <div class="title">Withdrawal Address:</div>
                    <div class="content">{$withdrawal->withdrawalAddress}</div>
                </div>

                <div class="item">
                    <div class="title">Amount Requested:</div>
                    <div class="content">
                        {$withdrawal->amount}
                    </div>
                </div>

                <div class="item">
                    <div class="title">Withdrawal Status:</div>
                    <div class="content">
                        <small class="badge text-uppercase {$withdrawal->withdrawalStatus}">
                            {$withdrawal->withdrawalStatus}
                        </small>
                    </div>
                </div>

                <div class="item">
                    <div class="title">Message From Admin:</div>
                    <div class="content">
                        {$withdrawal->messageFromAdmin}
                    </div>
                </div>

            </div>
        </div>
    </div>
{/block}