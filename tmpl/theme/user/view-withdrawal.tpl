{assign var="active" value="withdrawals"}
{extends file="theme/user/layout.tpl"}
{block name=title}Withdrawal{/block}

{assign var=withdrawal value=$data.withdrawal}
{block name="body"}

    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Withdrawal #{$withdrawal->ID}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Withdrawal details</h4>
                        <p class="card-description">
                            Here are the details of this withdrawal.
                        </p>
                        <div>
                            <div class="form-group">
                                <label>Withdrawal Request Date</label>
                                <input class="form-control" readonly value="{$withdrawal->createdAt}" />
                            </div>
                            <div class="form-group">
                                <label>User Name</label>
                                <input class="form-control" readonly value="{$withdrawal->userName}" />
                            </div>
                            <div class="form-group">
                                <label>Payment Method</label>
                                <input class="form-control" readonly value="{$withdrawal->cryptoCurrency|upper}" />
                            </div>
                            <div class="form-group">
                                <label>Withdrawal Address</label>
                                <input class="form-control" readonly value="{$withdrawal->withdrawalAddress}" />
                            </div>
                            <div class="form-group">
                                <label>Amount Requested</label>
                                <input class="form-control" readonly value="{$withdrawal->amount}" />
                            </div>
                            <div class="form-group">
                                <label>Withdrawal Status</label>
                                <input class="form-control" readonly value="{$withdrawal->withdrawalStatus}" />
                            </div>
                            <div class="form-group">
                                <label>Message from Admin</label>
                                <input class="form-control" readonly value="{$withdrawal->messageFromAdmin}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{/block}