{include file="theme/user/header.tpl" pageTitle="Dashboard" active="dashboard"}

<section id="page-title" class="page-title bg-overlay bg-overlay-dark bg-parallax">
    <div class="bg-section">
        <img src="assets/images/page-titles/18.jpg" alt="Background" />
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="title title-6 text-center" style="padding:150px 0 50px">
                    <div class="title--heading">
                        <h1>Dashboard</h1>
                    </div>
                    <div class="clearfix"></div>
                    <ol class="breadcrumb">
                        <li><a href="{$route->urlFor('user-dashboard')}">Dashboard</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row mb-60">
            <h3 class="section-title">Overview</h3>
            <div class="container">
                <div class="content-container">
                    <div class="item">
                        <div class="title">Username:</div>
                        <div class="content">{$data.user_name}</div>
                    </div>
                    <div class="item">
                        <div class="title">Full Name:</div>
                        <div class="content">{$data.full_name}</div>
                    </div>
                    <div class="item">
                        <div class="title">Registration Date:</div>
                        <div class="content">{$data.registration_date}</div>
                    </div>
                    <div class="item">
                        <div class="title">Account Balance:</div>
                        <div class="content">
                            {foreach from=$data.account_balance item=item key=key name=name}
                                {$key|upper}: ${$item} <img src="currencies/{$key}.gif" alt="{$key}" /><br />
                            {/foreach}
                            <strong>Total Balance: ${$data.total_balance}</strong>
                        </div>
                    </div>
                    <div class="item">
                        <div class="title">Total Deposit Earnings:</div>
                        <div class="content">${$data.total_earning}</div>
                    </div>
                    <div class="item">
                        <div class="title">Pending Withdrawals:</div>
                        <div class="content">${$data.pending_withdrawal}</div>
                    </div>
                    <div class="item">
                        <div class="title">Total Withdrawn:</div>
                        <div class="content">${$data.total_withdrawal}</div>
                    </div>
                    <div class="item">
                        <div class="title">Active Deposits:</div>
                        <div class="content">${$data.active_deposit}</div>
                    </div>
                    <div class="item">
                        <div class="title">Total Deposits:</div>
                        <div class="content">${$data.total_deposit}</div>
                    </div>
                    <div class="item">
                        <div class="title">Total Referrals Earnings:</div>
                        <div class="content">${$data.referral_commission}</div>
                    </div>

                    <div class="item">
                        <div class="title">No. of Referrals:</div>
                        <div class="content">{$data.referral}</div>
                    </div>

                    <div class="item">
                        <div class="title">Total Bonuses:</div>
                        <div class="content">${$data.total_bonus}</div>
                    </div>
                    <div class="item">
                        <div class="title">Total Penalties:</div>
                        <div class="content">${$data.total_penalty}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{include file="theme/user/footer.tpl"}