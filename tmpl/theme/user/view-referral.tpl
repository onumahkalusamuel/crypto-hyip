{assign var="active" value="referrals"}
{extends file="theme/user/layout.tpl"}
{block name=title}Referral{/block}

{assign var=referral value=$data.referral}
{assign var=transactions value=$data.trailLog}

{block name="body"}
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Referral #{$referral->referredUserName}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Referral details</h4>
                        <p class="card-description">
                            Here are the details of this deposit.
                        </p>
                        <div>
                            <div class="form-group">
                                <label>Referrer</label>
                                <input class="form-control" readonly value="{$referral->referralUserName}" />
                            </div>
                            <div class="form-group">
                                <label>Referred</label>
                                <input class="form-control" readonly value="{$referral->referredUserName}" />
                            </div>
                            <div class="form-group">
                                <label>Referral Bonus</label>
                                <input class="form-control" readonly value="{$referral->referralBonus}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Referral #{$referral->referredUserName} logs</h4>
                        <p class="card-description">
                            Below is a log of transactions related to this referral.
                        </p>
                        {include file="theme/user/components/account-logs-table-only.tpl" transactions=$transactions}
                    </div>
                </div>
            </div>
        </div>
    </div>
{/block}