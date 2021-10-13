{extends file="theme/public/layout.tpl"}
{block name=title}FAQs{/block}
{block name=body}

    <div class="banner-area" id="banner-area" style="background-image:url(assets/images/banner/banner5.jpg);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col">
                    <div class="banner-heading">
                        <h1 class="banner-title">FAQs</h1>
                        <ol class="breadcrumb">
                            <li><a href="{$route->urlFor('home')}">Home</a></li>
                            <li>FAQs</li>
                        </ol>
                    </div>
                </div>
                <!-- Col end-->
            </div>
            <!-- Row end-->
        </div>
        <!-- Container end-->
    </div>
    <!-- Banner area end-->

    <section class="section_2">
        <div class="container">
            <div class="section-heading">
                <h4>Have Any Questions?</h4>
                <div class="section-heading-line-left"></div>
            </div>
            <div class="row mt-40">
                <div class="col-md-6 col-sm-6 col-12">
                    <div class="pr-30-md">
                        <div class="panel-group mt-10" id="accordion2" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-grey accordion">
                                <div class="panel-heading accordion-heading" role="tab" id="acc1">
                                    <h4 class="panel-title accordion-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion2" href="#ac_col1"
                                            aria-expanded="true" aria-controls="ac_col1">What is {$siteInfo.name}? </a>
                                    </h4>
                                </div>
                                <div id="ac_col1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="acc1">
                                    <div class="panel-body accordion-body">
                                        {$siteInfo.name} is founded by a team of professional Forex &amp; Crypto traders who
                                        know exactly what it takes to earn the most from capital market. Our company
                                        provides a full investment service focused on the Forex and cryptocurrency trading
                                        market. Each trader in our company has more than 7 years of trading experience and
                                        successful trading records, as we know that is the exact point that support our
                                        company stability and profitability.
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-grey accordion">
                                <div class="panel-heading accordion-heading" role="tab" id="acc2">
                                    <h4 class="panel-title accordion-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion2"
                                            href="#ac_col2" aria-expanded="false" aria-controls="ac_col2"> Is {$siteInfo.name}
                                            officially registered?</a>
                                    </h4>
                                </div>
                                <div id="ac_col2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="acc2">
                                    <div class="panel-body accordion-body">
                                        Yes. {$siteInfo.name} is a legally registered investment company incorporated and
                                        headquartered in London, England. <a href="assets/images/investorm-certificate.png" target="_blank">Click
                                            Here to view our registration.</a>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-grey accordion">
                                <div class="panel-heading accordion-heading" role="tab" id="acc3">
                                    <h4 class="panel-title accordion-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion2"
                                            href="#ac_col3" aria-expanded="false" aria-controls="ac_col3"> Who can create an
                                            account with {$siteInfo.name}? </a>
                                    </h4>
                                </div>
                                <div id="ac_col3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="acc3">
                                    <div class="panel-body accordion-body">
                                        Any individual or legitimate entity can avail our services. However, you need to be
                                        of legal age in your jurisdiction in order to create an account with us.
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-grey accordion">
                                <div class="panel-heading accordion-heading" role="tab" id="acc4">
                                    <h4 class="panel-title accordion-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion2"
                                            href="#ac_col4" aria-expanded="false" aria-controls="ac_col4"> How do I create
                                            my account with {$siteInfo.name}? </a>
                                    </h4>
                                </div>
                                <div id="ac_col4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="acc4">
                                    <div class="panel-body accordion-body">
                                        Registration process is very easy and will take a few moments to complete. Simply
                                        click "Register" button on the top right of our website and fill in all the required
                                        fields.
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-grey accordion">
                                <div class="panel-heading accordion-heading" role="tab" id="acc5">
                                    <h4 class="panel-title accordion-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion2"
                                            href="#ac_col5" aria-expanded="false" aria-controls="ac_col5"> Can I have more
                                            than one account with you?</a>
                                    </h4>
                                </div>
                                <div id="ac_col5" class="panel-collapse collapse" role="tabpanel" aria-labelledby="acc5">
                                    <div class="panel-body accordion-body">
                                        Yes, you can.
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-grey accordion">
                                <div class="panel-heading accordion-heading" role="tab" id="acc6">
                                    <h4 class="panel-title accordion-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion2"
                                            href="#ac_col6" aria-expanded="false" aria-controls="ac_col6">What do I need to
                                            start trading or investing with {$siteInfo.name}? </a>
                                    </h4>
                                </div>
                                <div id="ac_col6" class="panel-collapse collapse" role="tabpanel" aria-labelledby="acc6">
                                    <div class="panel-body accordion-body">
                                        First of all, you need to register a new account, make a deposit of at least $20
                                        through the popular payment systems before proceeding with option trading or
                                        investment.
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-grey accordion">
                                <div class="panel-heading accordion-heading" role="tab" id="acc7">
                                    <h4 class="panel-title accordion-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion2"
                                            href="#ac_col7" aria-expanded="false" aria-controls="ac_col7"> How many times
                                            can a user make deposits into their account? </a>
                                    </h4>
                                </div>
                                <div id="ac_col7" class="panel-collapse collapse" role="tabpanel" aria-labelledby="acc7">
                                    <div class="panel-body accordion-body">
                                        A user can make deposits in his or her account as and when they want. There is no
                                        limitation on the number of deposits that a user can make into their account.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-12">
                    <div class="pr-30-md">
                        <div class="panel-group mt-10" id="accordion2" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-grey accordion">
                                <div class="panel-heading accordion-heading" role="tab" id="acc8">
                                    <h4 class="panel-title accordion-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion2" href="#ac_col8"
                                            aria-expanded="true" aria-controls="ac_col8"> What payment methods can I use to
                                            make a deposit? </a>
                                    </h4>
                                </div>
                                <div id="ac_col8" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="acc8">
                                    <div class="panel-body accordion-body">
                                        Currently we accept Bitcoin, Ethereum and BitcoinCash.
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-grey accordion">
                                <div class="panel-heading accordion-heading" role="tab" id="acc9">
                                    <h4 class="panel-title accordion-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion2"
                                            href="#ac_col9" aria-expanded="false" aria-controls="ac_col9"> What is the
                                            Minimum / Maximum amount allowed to deposit? </a>
                                    </h4>
                                </div>
                                <div id="ac_col9" class="panel-collapse collapse" role="tabpanel" aria-labelledby="acc9">
                                    <div class="panel-body accordion-body">
                                        As for investment and contract plans, the minimum and maximum investment capital is
                                        specified on each plan.
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-grey accordion">
                                <div class="panel-heading accordion-heading" role="tab" id="acc10">
                                    <h4 class="panel-title accordion-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion2"
                                            href="#ac_col10" aria-expanded="false" aria-controls="ac_col10"> Can I make
                                            reinvestments? </a>
                                    </h4>
                                </div>
                                <div id="ac_col10" class="panel-collapse collapse" role="tabpanel" aria-labelledby="acc10">
                                    <div class="panel-body accordion-body">
                                        Yes, you can reinvest.
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-grey accordion">
                                <div class="panel-heading accordion-heading" role="tab" id="acc11">
                                    <h4 class="panel-title accordion-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion2"
                                            href="#ac_col11" aria-expanded="false" aria-controls="ac_col11"> Do I get my
                                            investment principal back? </a>
                                    </h4>
                                </div>
                                <div id="ac_col11" class="panel-collapse collapse" role="tabpanel" aria-labelledby="acc11">
                                    <div class="panel-body accordion-body">
                                        Yes, on expiration of the activated portfolio, the capital will be returned to your
                                        trading account.
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-grey accordion">
                                <div class="panel-heading accordion-heading" role="tab" id="acc12">
                                    <h4 class="panel-title accordion-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion2"
                                            href="#ac_col112" aria-expanded="false" aria-controls="ac_col112"> What is the
                                            minimum amount for withdrawal? </a>
                                    </h4>
                                </div>
                                <div id="ac_col112" class="panel-collapse collapse" role="tabpanel" aria-labelledby="acc12">
                                    <div class="panel-body accordion-body">
                                        The minimum withdrawal amount is $20.
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-grey accordion">
                                <div class="panel-heading accordion-heading" role="tab" id="acc13">
                                    <h4 class="panel-title accordion-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion2"
                                            href="#ac_col13" aria-expanded="false" aria-controls="ac_col13"> Are there any
                                            fees to withdraw my funds? </a>
                                    </h4>
                                </div>
                                <div id="ac_col13" class="panel-collapse collapse" role="tabpanel" aria-labelledby="acc13">
                                    <div class="panel-body accordion-body">
                                        There are no any hidden fees to withdraw your funds.
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-grey accordion">
                                <div class="panel-heading accordion-heading" role="tab" id="acc14">
                                    <h4 class="panel-title accordion-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion2"
                                            href="#ac_col14" aria-expanded="false" aria-controls="ac_col14"> Do you have an
                                            affiliate program? </a>
                                    </h4>
                                </div>
                                <div id="ac_col14" class="panel-collapse collapse" role="tabpanel" aria-labelledby="acc14">
                                    <div class="panel-body accordion-body">
                                        Yes, you will get 5% referral commission on your referrals.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
{/block}