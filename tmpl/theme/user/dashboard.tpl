{assign var="active" value="dashboard"}
{extends file="theme/user/layout.tpl"}
{block name=title}Dashboard{/block}
{block name=body}

    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Welcome {$session->get('userName')|capitalize}</h3>
                        <h6 class="font-weight-normal mb-0">All systems are running smoothly!</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin transparent">
                <div class="row">
                    <div class="col-md-4 mb-4 stretch-card transparent">
                        <div class="card card-dark-blue">
                            <div class="card-body">
                                <p class="mb-4">Total Balance</p>
                                <p class="fs-30 mb-2">${$data.total_balance|string_format:"%.2f"}</p>
                                <p></p>
                            </div>
                        </div>
                    </div>

                    {foreach from=$data.account_balance item=item key=key name=name}
                        <div class="col-md-4 mb-4 stretch-card transparent">
                            <div class="card card-light-blue">
                                <div class="card-body">
                                    <p class="mb-4">{$key|upper} Balance</p>
                                    <p class="fs-30 mb-2">${$item|string_format:"%.2f"}</p>
                                    <p></p>
                                </div>
                            </div>
                        </div>
                    {/foreach}
                    <div class="col-md-4 mb-4 stretch-card transparent">
                        <div class="card card-light-blue">
                            <div class="card-body">
                                <p class="mb-4">Total Deposit Earnings</p>
                                <p class="fs-30 mb-2">${$data.total_earning|string_format:"%.2f"}</p>
                                <p></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4 stretch-card transparent">
                        <div class="card card-light-danger">
                            <div class="card-body">
                                <p class="mb-4">Pending Withdrawals</p>
                                <p class="fs-30 mb-2">${$data.pending_withdrawal|string_format:"%.2f"}</p>
                                <p></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4 stretch-card transparent">
                        <div class="card card-light-danger">
                            <div class="card-body">
                                <p class="mb-4">Total Withdrawn</p>
                                <p class="fs-30 mb-2">${$data.total_withdrawal|string_format:"%.2f"}</p>
                                <p></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4 stretch-card transparent">
                        <div class="card card-outline-danger">
                            <div class="card-body">
                                <p class="mb-4">Active Deposits</p>
                                <p class="fs-30 mb-2">${$data.active_deposit|string_format:"%.2f"}</p>
                                <p></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4 stretch-card transparent">
                        <div class="card card-tale">
                            <div class="card-body">
                                <p class="mb-4">Total Deposits</p>
                                <p class="fs-30 mb-2">${$data.total_deposit|string_format:"%.2f"}</p>
                                <p></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4 stretch-card transparent">
                        <div class="card card-outline-primary">
                            <div class="card-body">
                                <p class="mb-4">Total Referral Earnings</p>
                                <p class="fs-30 mb-2">${$data.referral_commission|string_format:"%.2f"}</p>
                                <p></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4 stretch-card transparent">
                        <div class="card card-light-danger">
                            <div class="card-body">
                                <p class="mb-4">No. of Referrals</p>
                                <p class="fs-30 mb-2">{$data.referral}</p>
                                <p></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4 stretch-card transparent">
                        <div class="card card-outline-success">
                            <div class="card-body">
                                <p class="mb-4">Total Bonuses</p>
                                <p class="fs-30 mb-2">${$data.total_bonus|string_format:"%.2f"}</p>
                                <p></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4 stretch-card transparent">
                        <div class="card card-faded">
                            <div class="card-body">
                                <p class="mb-4">Total Penalties</p>
                                <p class="fs-30 mb-2">${$data.total_penalty|string_format:"%.2f"}</p>
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{/block}