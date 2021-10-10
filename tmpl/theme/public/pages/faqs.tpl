{extends file="theme/public/layout.tpl"}
{block name=title}FAQs{/block}
{block name=body}
    <section class="page-title-area bg_cover hide-overflow" style="background-image: url(assets/images/page-title-bg.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-title-content text-center">
                        <h3 class="title">FAQs</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{$route->urlFor('home')}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">FAQs</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="what-we-do-area bg_cover pb-120 hide-overflow"
        style="background-image: url(assets/images/what-we-do-bg.jpg);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="section-title text-center">
                        <h3 class="title">FAQ's</h3>
                    <p>believe in creativity &ndash; pushing through the challenge</p>
                    <img src="assets/images/title-cross.png" alt="" />
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12">
                <div class="what-we-do-item text-center mt-30"><img src="assets/images/do-1.png" alt="" />
                    <h3 class="title">Frequently Asked Questions</h3>
                    <p style="text-align: justify;"><strong>How can I invest with {$siteInfo.name} ?</strong><br />To
                        make
                        a investment you must first become a member of {$siteInfo.name}. Once you are signed up, you
                        can
                        make your first deposit. All deposits must be made through the Members Area. You can login using
                        the member username and password you receive when signup. <br /><br /><strong>I wish to invest
                            with {$siteInfo.name} but I don't have an any ecurrency account. What should I
                                do?</strong><br />You can open a free PM account here: <a
                                style="display: inline !important;"
                                href="http://www.perfectmoney.is/">www.perfectmoney.is</a><br /><br /><strong>How do I open
                                my {$siteInfo.name} Account?</strong><br />It's quite easy and convenient. Follow this <a
                            style="display: inline !important;"
                            href="{$route->urlFor('page', ['page' => 'register'])}">link</a>, fill in the
                        registration form and then press "Register". <br /><br /><strong>Which e-currencies do you
                            accept?</strong><br />We accept e-currencies. <br /><br /><strong>How can I withdraw
                            funds?</strong><br />Login to your account using your username and password and check the
                        Withdraw section. <br /><br /><strong>How long does it take for my deposit to be added to my
                            account?</strong><br />Your account will be updated as fast, as you deposit.
                        <br /><br /><strong>How can I change my e-mail address or password?</strong><br />Log into your
                        {$siteInfo.name} account and click on the "Account Information". You can change your e-mail
                        address
                        and password there. <br /><br /><strong>What if I can't log into my account because I forgot my
                                password?</strong><br />Click <a style="display: inline !important;"
                                href="{$route->urlFor('page', ['page' => 'reset-password'])}">forgot password</a> link, type
                            your username or
                            e-mail and you'll receive your account information. <br /><br /><strong>Does a daily profit paid
                            directly to my currency account?</strong><br />No, profits are gathered on your
                        {$siteInfo.name} account and you can withdraw them anytime. <br /><br /><strong>How do you
                            calculate the interest on my account?</strong><br />Depending on each plan. Interest on your
                        {$siteInfo.name} account is acquired Daily, Weekly, Bi-Weekly, Monthly and Yearly and
                        credited to
                        your available balance at the end of each day. <br /><br /><strong>Can I do a direct deposit
                            from my account balance?</strong><br />Yes! To make a deposit from your {$siteInfo.name}
                        account balance. Simply login into your members account and click on Make Deposit ans select the
                        Deposit from Account Balance Radio button. <br /><br /><strong>Can I make an additional deposit
                            to {$siteInfo.name} account once it has been opened?</strong><br />Yes, you can but all
                        transactions are handled separately. <br /><br /><strong>After I make a withdrawal request, when
                            will the funds be available on my ecurrency account?</strong><br />Funds are usually
                        available instantly. <br /><br /><strong>How can I change my password?</strong><br />You can
                        change your password directly from your members area by editing it in your personal profile.
                        <br /><br /><strong>How can I check my account balances?</strong><br />You can access the
                        account information 24 hours, seven days a week over the Internet. <br /><br /><strong>May I
                            open several accounts in your program?</strong><br />No. If we find that one member has more
                        than one account, the entire funds will be frozen. <br /><br /><strong>How can I make a
                            spend?</strong><br />To make a spend you must first become a member of {$siteInfo.name} .
                        Once
                        you are signed up, you can make your first spend. All spends must be made through the Member
                        Area. You can login using the member username and password you received when signup.
                        <br /><br /><strong>Who manages the funds?</strong><br />These funds are managed by a team of
                        {$siteInfo.name} investment experts. <br /><br />
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

{/block}