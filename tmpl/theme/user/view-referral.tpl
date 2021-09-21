{include file='theme/user/header.tpl' pageTitle='Referrals' active="referrals"}

{assign var=referral value=$data.referral}
{assign var=transactions value=$data.trailLog}

<section id="page-title" class="page-title bg-overlay bg-overlay-dark bg-parallax">
    <div class="bg-section">
        <img src="assets/images/page-titles/18.jpg" alt="Background" />
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="title title-6 text-center" style="padding:150px 0 50px">
                    <div class="title--heading">
                        <h1 style="font-size:4em">Referral</h1>
                    </div>
                    <div class="clearfix"></div>
                    <ol class="breadcrumb">
                        <li><a href="{$route->urlFor('user-dashboard')}">Dashboard</a></li>
                        <li class="active">Referral</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row mb-60">
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

        <div class="row mb-60">
            <h3 class="section-title">Referral Logs</h3>
            {include file="theme/user/components/account-logs-table-only.tpl" transactions=$transactions}
        </div>

    </div>
</section>

{include file='theme/user/footer.tpl'}