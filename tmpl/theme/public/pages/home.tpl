{extends file="theme/public/layout.tpl"}

{block name=body}
    <!--====== BANNER PART START ======-->
    <section class="banner_v1 bg_cover hide-overflow d-block" id="bgndVideo" style="background-image: url(assets/images/homepage-bg.jpg);">
        <div class="banner_overlay"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="banner_content text-center">
                        <span>Fast-track your success</span>
                        <h1>Tight spreads – the fast lane to maximising your profit.</h1>
                        <h1>EVERYTHING YOU NEED TO PUT YOU IN CONTROL</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="creative_strategic section_padding bg_cover" style="background-image: url('assets/images/2.jpg');">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="cutclub_content_box">
                        <h2>THE ONLINE INVESTMENT TOOL BUILT JUST FOR YOU.
                        </h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="cutclub_content_box">
                        <p>Optional Trading Binary (OTB) is committed to creating a fair, stable & secure digital currency
                            investment platform. Our experts are available at any and all times to answer your queries and
                            help you out with any questions or problems you may be having when it comes to investing.</p>
                        <p>The one tool you need to track every detail of your portfolio, and your financial health.
                            Accessing the platform through a personal account, you can follow your investments 24/7, every
                            single day of the year. </p>
                        <a href="{$route->urlFor('home')}" class="main-btn">More About Us</a>
                    </div>
                </div>
            </div>
            <div class="row pt-30 justify-content-center">
                <div class="col-lg-4 col-md-7 col-sm-8">
                    <div class="service_box mt-30">
                        <div class="icon_box">
                            <div class="icon">
                                <img src="assets/images/icon/icon_9.png" alt="">
                            </div>
                            <div class="count">1</div>
                        </div>
                        <h4>Sign up</h4>
                        <p>Create an account for free using your email address</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-7 col-sm-8">
                    <div class="service_box mt-30">
                        <div class="icon_box">
                            <div class="icon">
                                <img src="assets/images/icon/icon_10.png" alt="">
                            </div>
                            <div class="count">2</div>
                        </div>
                        <h4>Open Deposit</h4>
                        <p>We offer versatile investment plans to suit your financial benefits. Pick a plan and make
                            deposit.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-7 col-sm-8">
                    <div class="service_box mt-30">
                        <div class="icon_box">
                            <div class="icon">
                                <img src="assets/images/icon/icon_11.png" alt="">
                            </div>
                            <div class="count">3</div>
                        </div>
                        <h4>Smart Earnings</h4>
                        <p>Watch your earnings grow continuously on your dashboard</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cutclub_story section_padding bg_image" style="background-image: url(assets/images/story_bg.png);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section_title-2 text-center">
                        <h2></h2>
                        <p></p>
                        <i class="fa fa-times"></i>
                    </div>
                </div>
            </div>
            <div class="single_stroy">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="cutclub_img_box">
                            <img src="assets/images/story_1.jpg" class="img-fluid" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="cutclub_content_box">
                            <span></span>
                            <h3>Wealth Management made easy with OTB Capital</h3>
                            <p>Rather than trying to track your investments across various institutions, each with their own
                                dealing processes, paperwork and charging structures, you and your refrrals can manage them
                                all efficiently, securely and cost-effectively on the OTB Capital platform.</p>
                            <a href="#" class="main-btn">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single_stroy">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="cutclub_img_box">
                            <img src="assets/images/story_2.jpg" class="img-fluid" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="cutclub_content_box">
                            <span></span>
                            <h3>What is a wealth platform?</h3>
                            <p>At its heart, our platform is a secure online location where all your investments can be held
                                and viewed in one place.
                                With up-to-date valuations and a birds-eye of your whole portfolio, it’s easy for you and
                                your Financial referrals to review and monitor your investments. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="qoute_box bg_image" style="background-image: url(assets/images/1.jpg);background-size: cover;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="cutclub_content_box">
                        <span>Affiliate Program</span>
                        <h2>Earn 6% Referral Commission</h2>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="button_box">
                        <a href="assets/images/otb.pdf" class="main-btn">View Certificate</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cutclub_team team_v1 hide-overflow bg-white">
        <div class="container-full">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section_title-2 text-center">
                        <h2>OUR INVESTMENT PLANS</h2>
                        <i class="fa fa-times"></i>
                    </div>
                </div>
            </div>
            <section class="cutclub_pricing pricing_v1 pricing-page">
                <div class="container">
                    <div class="row justify-content-center">
                        {getInvestmentPlans out=investment_plans}
                        {foreach from=$investment_plans item=ivp key=key}
                            <div class="col-lg-4 col-md-7 col-sm-9">
                                <div class="pricing_box box_{($key + 1)} text-center">
                                    <div class="plan_title">
                                        <h4>{$ivp->title}</h4>
                                    </div>
                                    <div class="pricing_wrap">
                                        <div class="pricing_head">
                                            <h2><span>{$ivp->percentage}</span>%</h2>
                                            <p>ROI Interest</p>
                                        </div>
                                        <div class="pricing_body">
                                            <ul>
                                                <li>Min Deposit :
                                                    ${$ivp->minimum}</li>
                                                <li>Max Deposit :
                                                    {if $ivp->maximum == "0"}Unlimited{else}${$ivp->maximum}{/if}
                                                </li>
                                                <li>Withdrawal: Instantly</li>
                                                <li>Duration: {$ivp->duration}
                                                    {$ivp->durationType|capitalize}{if $ivp->duration gt '1'}s{/if}</li>
                                                <li>Capital Return :
                                                    {if $ivp->profitFrequency eq 'end'}
                                                        End of Plan
                                                    {else}
                                                        {$ivp->profitFrequency|capitalize} Each Term
                                                    {/if}
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="button_box">
                                            <a href="{$route->urlFor('page', ['page' => 'register'])}"
                                                class="pricing_btn">Invest Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {/foreach}
                    </div>
                </div>
            </section>

            <!--====== CUTCLUB TEAM PART ENDS ======-->

            <!--====== PROJECT 1 PART START ======-->

            <div class="area-heading text-center mb-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="area-heading text-center">
                                <h2 class="mb-3 area-title">cryptocurrency live price table</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div
                                style="height:433px; background-color: #FFFFFF; overflow:hidden; box-sizing: border-box; border: 1px solid #56667F; border-radius: 4px; text-align: right; line-height:14px; font-size: 12px; box-sizing:content-box; font-feature-settings: normal; text-size-adjust: 100%; box-shadow: inset 0 -20px 0 0 #56667F; padding: 0px; margin: 0px; width: 99%;">
                                <div style="height:413px;">
                                    {include file="theme/public/components/coinlib-widget.tpl"}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
{/block}