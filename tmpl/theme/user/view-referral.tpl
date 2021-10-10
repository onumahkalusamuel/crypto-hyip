{assign var="active" value="referrals"}
{extends file="theme/user/layout.tpl"}
{block name=title}Referral{/block}

{assign var=referral value=$data.referral}
{assign var=transactions value=$data.trailLog}

{block name="body"}
    <div class="nk-block">
        <div class="container p-0">
            <div class="row mb-5">
                <h3 class="section-title">Referral Details</h3>
                <div class="container">
                    <div class="content-container">
                        <div class="item">
                            <div class="title">Referrer:</div>
                            <div class="content">{$referral->referralUserName}</div>
                        </div>
                        <div class="item">
                            <div class="title">Referred:</div>
                            <div class="content">
                                {$referral->referredUserName}
                            </div>
                        </div>
                        <div class="item">
                            <div class="title">Referral Bonus Received:</div>
                            <div class="content">{$referral->referralBonus}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <h3 class="section-title">Referral Logs</h3>
                {include file="theme/user/components/account-logs-table-only.tpl" transactions=$transactions}
            </div>
        </div>
    </div>
{/block}