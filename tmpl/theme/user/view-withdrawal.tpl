{include file='theme/user/header.tpl' pageTitle='Withdrawals' active="withdrawals"}

{assign var=withdrawal value=$data.withdrawal}

<section id="page-title" class="page-title bg-overlay bg-overlay-dark bg-parallax">
    <div class="bg-section">
        <img src="assets/images/page-titles/18.jpg" alt="Background" />
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="title title-6 text-center" style="padding:150px 0 50px">
                    <div class="title--heading">
                        <h1 style="font-size:4em">Withdrawal</h1>
                    </div>
                    <div class="clearfix"></div>
                    <ol class="breadcrumb">
                        <li><a href="{$route->urlFor('user-dashboard')}">Dashboard</a></li>
                        <li class="active">Withdrawal</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row mb-60">
            <h3 class="section-title">Withdrawal #{$withdrawal->ID}</h3>
            <div class="container">
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
                        <div class="title">Crypto Currency:</div>
                        <div class="content">{$withdrawal->cryptoCurrency}&nbsp;
                            <img src="currencies/{$withdrawal->cryptoCurrency}.gif"
                                alt="{$withdrawal->cryptoCurrency|upper}" />
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
    </div>
</section>
{include file='theme/user/footer.tpl'}