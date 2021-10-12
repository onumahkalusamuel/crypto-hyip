{extends file="theme/public/layout.tpl"}

{block name=body}
    <div class="carousel slide" id="main-slide" data-ride="carousel">
        <!-- Indicators-->
        <ol class="carousel-indicators visible-lg visible-md">
            <li class="active" data-target="#main-slide" data-slide-to="0"></li>
            <li data-target="#main-slide" data-slide-to="1"></li>
            <li data-target="#main-slide" data-slide-to="2"></li>
        </ol>
        <!-- Indicators end-->
        <!-- Carousel inner-->
        <div class="carousel-inner">
            <div class="carousel-item active" style="background-image:url(images/earn1.jpg);">
                <div class="container">
                    <div class="slider-content text-left">
                        <div class="col-md-12">
                            <h2 class="slide-title title-light">Your future is created by you</h2>
                            <h3 class="slide-sub-title">Welcome to Icg-financial</h3>
                            <p class="slider-description lead">We deliver excellence to every client, every time.
                                We value our relationship, and ensure we are exceeding expectations.</p>
                            <p>
                                <a class="slider btn btn-primary" href="{$route->urlFor('register')}">Get started
                                    now</a>
                                <a class="slider btn btn-border"
                                    href="{$route->urlFor('page', ['page' => 'about-us'])}">About us</a>
                            </p>
                        </div>
                        <!-- Col end-->
                    </div>
                    <!-- Slider content end-->
                </div>
                <!-- Container end-->
            </div>
            <!-- Carousel item 1 end-->
            <div class="carousel-item" style="background-image:url(images/earn2.jpg);">
                <div class="container">
                    <div class="slider-content text-center">
                        <div class="col-md-12">
                            <h3 class="slide-sub-title">We provide solutions to<br>Earn Passively</h3>
                            <p>
                                <a class="slider btn btn-primary"
                                    href="{$route->urlFor('page', ['page' => 'our-services'])}">Our Services</a>
                                <a class="slider btn btn-border" href="{$route->urlFor('login')}">Login</a>
                            </p>
                        </div>
                        <!-- Col end-->
                    </div>
                    <!-- Slider content end-->
                </div>
                <!-- Container end-->
            </div>
            <!-- Carousel item 1 end-->
            <div class="carousel-item" style="background-image:url(images/slider/bg1.jpg);">
                <div class="container">
                    <div class="slider-content text-right">
                        <div class="col-md-12">
                            <h2 class="slide-title title-light">Your future is created by you</h2>
                            <h3 class="slide-sub-title">Welcome to Icg-financial</h3>
                            <p class="slider-description lead">We deliver excellence to every client, every time.
                                We value our relationship, and ensure we are exceeding expectations.</p>
                            <p>
                                <a class="slider btn btn-primary" href="{$route->urlFor('register')}">Get started
                                    now</a>
                                <a class="slider btn btn-border"
                                    href="{$route->urlFor('page', ['page' => 'about-us'])}">About us</a>
                            </p>
                        </div>
                        <!-- Col end-->
                        <!-- Col end-->
                    </div>
                    <!-- Slider content end-->
                </div>
                <!-- Container end-->
            </div>
            <!-- Carousel item 1 end-->
        </div>
        <!-- Carousel inner end-->
        <!-- Controllers-->
        <a class="left carousel-control carousel-control-prev" href="#main-slide" data-slide="prev">
            <span><i class="fa fa-angle-left"></i></span>
        </a>
        <a class="right carousel-control carousel-control-next" href="#main-slide" data-slide="next">
            <span><i class="fa fa-angle-right"></i></span>
        </a>
    </div>
    <!-- Carousel end-->

    <section class="ts-about-intro" id="ts-about-intro">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <span style="background:blue !important; margin-top:-50px; display:block">

                        <script type="text/javascript">
                            baseUrl = "https://widgets.cryptocompare.com/";
                            var scripts = document.getElementsByTagName("script");
                            var embedder = scripts[scripts.length - 1];
                            var cccTheme = {
                                "General": {
                                    "background": "#2C4C76 !important",
                                    "priceText": "#fff"
                                },
                                "Currency": {
                                    "color": "#fff"
                                },
                                "Trend": {
                                    "colorDown": "#2C4C76"
                                }
                            };
                            (function() {
                                var appName = encodeURIComponent(window.location.hostname);
                                if (appName == "") {
                                    appName = "local";
                                }
                                var s = document.createElement("script");
                                s.type = "text/javascript";
                                s.async = true;
                                var theUrl = baseUrl +
                                    'serve/v1/coin/chartscroller?fsyms=BTC,ETH,XMR,LTC,DASH&tsyms=USD,EUR,CNY,GBP';
                                s.src = theUrl + (theUrl.indexOf("?") >= 0 ? "&" : "?") + "app=" +
                                    appName;
                                embedder.parentNode.appendChild(s);
                            })();
                        </script>




                    </span>
                    <h2 class="column-title title-small"><span>
                        </span>{$siteInfo.name}</h2>

                    <p>Remodel Your Living!!! {$siteInfo.name} is the World Leading Crypto Forex Trading Platform.
                        We
                        have affiliation with blockchain Trading pool and other major companies like Coinbase and
                        Coinmama. We are using new technology and artificial intelligence to build a better
                        Financial System. Our Platform have powered over 100M transactions and empowered Investors
                        in 140 countries across the globe to invest wisely and get their return on investment
                        without costly intermediaries or charges. We also offer tools for developers and real time
                        transaction data for users to analyze the burgeoning digital economy.
                        Join over 28,000 users from all over the world to enjoy our world class service. COMMITMENT
                        TO QUALITY, EXPERTISE AND CONTINUITY IN A FAST-PACED MARKET!!!.</p>
                    <div class="gap-15"></div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="ts-feature-box">
                                <div class="ts-feature-info">
                                    <img src="assets/images/pages/color_icon1.png" alt="">
                                    <h3 class="ts-feature-title">Best Finance Brand</h3>
                                    <p>Best Crypto Products & Solutions</p>

                                </div>
                            </div>
                            <!-- feature box-1 end-->
                        </div>
                        <!-- col-1 end-->
                        <div class="col-lg-6">
                            <div class="ts-feature-box">
                                <div class="ts-feature-info">
                                    <img src="assets/images/pages/color_icon2.png" alt="">
                                    <h3 class="ts-feature-title">ISO Certified</h3>
                                    <p>ISO certification ensures that an organization runs its business using
                                        international standards for products, services and processes. </p>
                                </div>
                            </div>
                            <!-- feature box-2 end-->
                        </div>
                        <!-- col-2 end-->
                    </div>
                    <!-- container row end-->
                </div>
                <!-- Col end-->
                <div class="col-lg-6">
                    <img class="img-fluid" src="assets/images/icg1.png" alt="">
                </div>
                <!-- Col end-->
            </div>
            <!-- Main row end-->
        </div>
    </section>

    <section class="ts-services solid-bg" id="ts-services">
        <div class="container">
            <div class="row text-left">
                <div class="col-lg-12">
                    <h2 class="section-title border-title-left">Our Best Services <span
                            class="section-title-tagline title-light">What We Do</span></h2>
                </div>
            </div>
            <!-- Title row end-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="featured-tab">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item"><a class="nav-link active animated fadeIn" href="#tab_one"
                                    data-toggle="tab"><span class="tab-head"><span><i
                                                class="icon icon-pie-chart2"></i></span><span class="tab-text-title">Best
                                            Consulting</span></span></a></li>
                            <!-- list 1 end-->
                            <li class="nav-item"><a class="nav-link animated fadeIn" href="#tab_two" data-toggle="tab"><span
                                        class="tab-head"><span><i class="icon icon-loan"></i></span><span
                                            class="tab-text-title">Market Growth</span></span></a></li>
                            <!-- list 2 end-->
                            <li class="nav-item"><a class="nav-link animated fadeIn" href="#tab_three"
                                    data-toggle="tab"><span class="tab-head"><span><i
                                                class="icon icon-savings"></i></span><span class="tab-text-title">Saving
                                            Strategy</span></span></a></li>
                            <!-- list 3 end-->
                            <li class="nav-item"><a class="nav-link animated fadeIn" href="#tab_four"
                                    data-toggle="tab"><span class="tab-head"><span><i
                                                class="icon icon-consult"></i></span><span class="tab-text-title">Best
                                            Consulting</span></span></a></li>
                            <!-- list 4 end-->
                        </ul>
                        <!-- Nav-tabs end-->
                        <div class="tab-content">
                            <div class="tab-pane active animated fadeInRight" id="tab_one">
                                <div class="row">
                                    <div class="col-lg-4 align-self-center">
                                        <div class="bg-contain-verticle"
                                            style="background-image:url(images/tabs/tab-shape.png);">
                                            <img class="img-center img-fluid" src="assets/images/tabs/img1.png" alt="">
                                        </div>
                                    </div>
                                    <!-- Col end-->
                                    <div class="col-lg-8">
                                        <div class="tab-content-info">
                                            <h3 class="tab-content-title">Our goals</h3>
                                            <p>The goal of {$siteInfo.name} is to provide its users a unique, safe
                                                and
                                                secured platform for their investments in the field of crypto
                                                currency. This is why we have used cutting-edge platform with
                                                extensive infrastructure intended to make things more convenient.

                                                Due to this technology, our platform is able to make possible of
                                                providing real and steady profits on an ongoing daily basis.</p>
                                        </div>
                                        <!-- Tab content info end-->
                                    </div>
                                    <!-- Col end-->
                                </div>
                                <!-- Row end-->
                            </div>
                            <!-- Tab pane 1 end-->
                            <div class="tab-pane animated fadeInRight" id="tab_two">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="tab-content-info">
                                            <h3 class="tab-content-title">Our mission</h3>
                                            <p>At {$siteInfo.name}, we commit to provide services we render to our
                                                clients. This is why we always try to expand our technical
                                                capabilities and financial turnover with the help of ASIC miners
                                                having hands-on experience guarantees for gaining profit by
                                                generating crypto currencies.
                                                {$siteInfo.name} envisions to widen the pool of investors by
                                                engaging
                                                in effective strategic mining and trading of crypto currencies.</p>
                                            <!-- Tab content info end-->
                                        </div>
                                        <!-- Col end-->
                                        <div class="col-lg-4 align-self-center">
                                            <div class="bg-contain-verticle align-self-center"
                                                style="background-image:url(images/tabs/tab-shape.png);">
                                                <img class="img-center img-fluid" src="assets/images/tabs/img2.png" alt="">
                                            </div>
                                        </div>
                                        <!-- Col end-->
                                    </div>
                                    <!-- Row end-->
                                </div>


                            </div>
                            <!-- tab content-->
                            <div class="gap-60"></div>
                            <div class="text-center"><a class="btn btn-primary" href="#"> Check More Services</a>
                            </div>
                        </div>
                        <!-- Schedule tab end-->
                    </div>
                    <!-- Col end-->
                </div>
                <!-- Content row end-->
            </div>
            <!-- Container end-->
    </section>
    <!-- Service end-->

    <section class="ts-features-col">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="ts-feature text-center box-primary">
                        <div class="ts-feature-info"><i class="icon icon-consut2"></i>
                            <h3 class="ts-feature-title">CHOOSE A PACKAGE</h3>
                            <p>{$siteInfo.name} has very flexible packages to accommodate all investors, no matter
                                their financial status.
                                We have made it easy for investors to grow their ranking with the company with our
                                four {$siteInfo.name} packages ...</p>
                        </div>
                    </div>
                    <!-- feature 1 end-->
                </div>
                <!-- Col end-->
                <div class="col-lg-4">
                    <div class="ts-feature text-center box-secondary">
                        <div class="ts-feature-info"><i class="icon icon-chart2"></i>
                            <h3 class="ts-feature-title">MAKE A DEPOSIT</h3>
                            <p>Before Trading is approved for the selected package, the investor is expected to fund
                                the package through the available modes of deposit.</p>
                        </div>
                    </div>
                    <!-- feature 2 end-->
                </div>
                <!-- Col end-->
                <div class="col-lg-4">
                    <div class="ts-feature text-center box-dark">
                        <div class="ts-feature-info"><i class="icon icon-clock3"></i>
                            <h3 class="ts-feature-title">WITHDRAWAL</h3>
                            <p>Once a Trading circle is completed, the investor is to request a withdrawal.
                                However, our system is programmed to automatically reinvest a portfolio to keep
                                Trading if a withdrawal request is not made after 48 hours.</p>
                        </div>
                    </div>
                    <!-- feature 3 end-->
                </div>
                <!-- Col end-->
            </div>
            <!-- Row end-->
        </div>
        <!-- Container end-->
    </section>

    <!-- Banner area end-->
    <section class="main-container" id="main-container">
        <div class="pricing-box-default">
            <div class="container">
                <div class="row text-center">
                    <div class="col-md-12">
                        <h2 class="section-title"><span>Buy Plan</span>Our Pricing</h2>
                    </div>
                    <!-- Col End -->
                </div>
                <!-- Row End -->
                <div class="row mrt-40">

                    {getInvestmentPlans out=investment_plans}
                    {foreach from=$investment_plans item=ivp key=key}
                        <div class="col-lg-4">
                            <div class="plan featured text-center">
                                <div class="price-icon-wrapper">
                                    <i class=""></i>
                                </div>
                                <h2 class="plan-name">{$ivp->title}</h2>
                                <h3 class="plan-price">
                                    <sup class="currency">$</sup>
                                    <strong>{$ivp->percentage}%</strong>

                                </h3>
                                <ul class="list-unstyled">
                                    <li>MIN: ${$ivp->minimum}.</li>
                                    <li>MAX: {if $ivp->maximum == "0"}<span
                                            style="font-size:50px;">∞</span>{else}${$ivp->maximum}
                                        {/if}</li>
                                    <li>duration: {$ivp->duration}
                                        {$ivp->durationType|capitalize}{if $ivp->duration gt '1'}s{/if} </li>
                                    <li>24/7 Customer Support</li>
                                    <li>{$ivp->referralPercentage}% Referral Commission</li>
                                </ul>
                                <div class="text-center ">
                                    <a target="_self" href="{$route->urlFor('register')}" class="btn btn-primary">Deposit
                                        now</a>
                                </div>
                            </div>
                        </div>
                    {/foreach}
                </div>
            </div>
            <!-- Container End -->
        </div>

        <div class="ts-price-box solid-bg">

        </div>
    </section>
    <!-- main Container End -->


    <section class="bg-overlay ts-chart">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-12">
                    <h2 class="column-title title-white"><span>REFERRAL BENEFITS</h2>
                    <p class="intro-desc">As a way of compensating investors who introduce friends and family into
                        the company, {$siteInfo.name} offers a generous 6% of the new investor initial deposit.

                        The commission is paid into the investors portfolio immediately the new investor's deposit
                    is confirmed.

                    This is our little way of saying THANK YOU FOR TRUSTING US!!.</p>

            </div>
            <!-- col end-->

            <div class="col-lg-7 col-md-12">
                <script type="text/javascript">
                    baseUrl = "https://widgets.cryptocompare.com/";
                    var scripts = document.getElementsByTagName("script");
                    var embedder = scripts[scripts.length - 1];
                    (function() {
                        var appName = encodeURIComponent(window.location.hostname);
                        if (appName == "") {
                            appName = "local";
                        }
                        var s = document.createElement("script");
                        s.type = "text/javascript";
                        s.async = true;
                        var theUrl = baseUrl + 'serve/v1/coin/histo_week?fsym=BTC&tsym=USD';
                        s.src = theUrl + (theUrl.indexOf("?") >= 0 ? "&" : "?") + "app=" + appName;
                        embedder.parentNode.appendChild(s);
                    })();
                </script>


            </div>
            <!-- Col end-->
        </div>
        <!-- Content row end-->
    </div>
    <!-- Container end-->
</section>
<!-- Section chart end-->

<section class="ts-team">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-12">
                <h2 class="section-title"><span>Our People</span>Best Team</h2>
            </div>
        </div>
        <!-- Title row end-->
        <div class="row">
            <div class="col-lg-3 col-md-12">
                <div class="ts-team-wrapper">
                    <div class="team-img-wrapper">
                        <img class="img-fluid" alt="" src="assets/images/team/team1.jpg">
                    </div>
                    <div class="ts-team-content">
                        <h3 class="team-name">Denise Brewer</h3>
                        <p class="team-designation">Marketing</p>
                    </div>
                    <!-- Team content end-->

                    <!-- social-icons-->
                </div>
                <!-- Team wrapper 1 end-->
            </div>
            <!-- Col end-->
            <div class="col-lg-3 col-md-12">
                <div class="ts-team-wrapper">
                    <div class="team-img-wrapper">
                        <img class="img-fluid" alt="" src="assets/images/team/team2.jpg">
                    </div>
                    <div class="ts-team-content">
                        <h3 class="team-name">Patrick Ryan</h3>
                        <p class="team-designation">Legal & Compliance
                            r</p>
                    </div>
                    <!-- Team content end-->

                </div>
                <!-- Team wrapper 1 end-->
            </div>
            <!-- Col end-->
            <div class="col-lg-3 col-md-12">
                <div class="ts-team-wrapper">
                    <div class="team-img-wrapper">
                        <img class="img-fluid" alt="" src="assets/images/team/team3.jpg">
                    </div>
                    <div class="ts-team-content">
                        <h3 class="team-name">Craig Robinson</h3>
                        <p class="team-designation">Broker</p>
                    </div>

                    <!-- social-icons-->
                </div>
                <!-- Team wrapper 1 end-->
            </div>
            <!-- Col end-->
            <div class="col-lg-3 col-md-12">
                <div class="ts-team-wrapper">
                    <div class="team-img-wrapper">
                        <img class="img-fluid" alt="" src="assets/images/team/team4.jpg">
                    </div>
                    <div class="ts-team-content">
                        <h3 class="team-name">Andrew Robinson</h3>
                        <p class="team-designation">Broker</p>
                    </div>
                    <!-- Team content end-->
                    <div class="team-social-icons">
                        <a target="_blank" href="#"><i class="fa fa-facebook"></i></a>
                        <a target="_blank" href="#"><i class="fa fa-twitter"></i></a>
                        <a target="_blank" href="#"><i class="fa fa-google-plus"></i></a>
                        <a target="_blank" href="#"><i class="fa fa-linkedin"></i></a>
                    </div>
                    <!-- social-icons-->
                </div>
                <!-- Team wrapper 1 end-->
            </div>
            <!-- Col end-->
        </div>
        <!-- Content row end-->
    </div>
    <!-- Container end-->
</section>
<!-- Section Team end-->

<section class="quote-area bg-overlay overlay-color" id="quote-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 qutoe-form-inner-left">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!4v1631354955003!6m8!1m7!1sVAaiSAGL2C6lmQKN1pyF7w!2m2!1d38.67938172540038!2d-90.37441944939471!3f155.28547314814654!4f2.968975602603308!5f0.7820865974627469"
                    width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy"></iframe>

            </div>
            <!-- Col end-->
            <div class="col-lg-6 align-self-center">
                <div class="owl-carousel owl-theme testimonial-slide owl-dark" id="testimonial-slide">
                    <div class="item">
                        <div class="quote-item quote-square"><span class="quote-text">Great company With great
                                investment services keep up the good work.</span>
                            <div class="quote-item-footer">
                                <img class="testimonial-thumb" src="assets/images/clients/testimonial1.png"
                                    alt="testimonial">
                                <div class="quote-item-info">
                                    <p class="quote-author">Jane Wagner
                                    </p><span class="quote-subtext">Investor</span>
                                </div>
                            </div>
                        </div>
                        <!-- Quote item end-->
                    </div>
                    <!-- Item 1 end-->
                    <div class="item">
                        <div class="quote-item quote-square"><span class="quote-text">Great company With great
                                investment services keep up the good work.</span>
                            <div class="quote-item-footer">
                                <img class="testimonial-thumb" src="assets/images/clients/testimonial2.png"
                                    alt="testimonial">
                                <div class="quote-item-info">
                                    <h3 class="quote-author">David reed
                                    </h3><span class="quote-subtext">Investor</span>
                                </div>
                            </div>
                        </div>
                        <!-- Quote item end-->
                    </div>
                    <!-- Item 2 end-->
                    <div class="item">
                        <div class="quote-item quote-square"><span class="quote-text">{$siteInfo.name} Invest is
                                one of the best performing fund management company
                                .</span>
                            <div class="quote-item-footer">
                                <img class="testimonial-thumb" src="assets/images/clients/testimonial3.png"
                                    alt="testimonial">
                                <div class="quote-item-info">
                                    <h3 class="quote-author">Niel elamir
                                    </h3><span class="quote-subtext">InvestorT</span>
                                </div>
                            </div>
                        </div>
                        <!-- Quote item end-->
                    </div>
                    <!-- Item 3 end-->
                </div>
                <!-- Testimonial carousel end-->
            </div>
            <!-- Col end-->
        </div>
        <!-- Content row end-->
    </div>
    <!-- Container end-->
</section>
<!-- Quote area end-->

<section class="bg-overlay ts-chart">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-12">
                <img src="assets/images/ICG.jpg" width="100%">
            </div>

            <div class="col-lg-5 col-md-12">
                <img src="assets/images/icgcert.png" width="100%">
            </div>

        </div>
        <!-- Content row end-->
    </div>
    <!-- Container end-->
</section>
<!-- Section chart end-->

<section class="news" id="news">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-12">
                <h2 class="section-title"><span>Don't Miss</span>Our Latest News</h2>
                </div>
            </div>
            <div class="row">
                <div class="colo-lg-12">


                    <script type="text/javascript">
                        baseUrl = "https://widgets.cryptocompare.com/";
                        var scripts = document.getElementsByTagName("script");
                        var embedder = scripts[scripts.length - 1];
                        var cccTheme = {
                            "Data": {
                                "borderColor": "#3d9400"
                            },
                            "Chart": {
                                "fillColor": "#3d9400",
                                "borderColor": "#3d9400"
                            }
                        };
                        (function() {
                            var appName = encodeURIComponent(window.location.hostname);
                            if (appName == "") {
                                appName = "local";
                            }
                            var s = document.createElement("script");
                            s.type = "text/javascript";
                            s.async = true;
                            var theUrl = baseUrl + 'serve/v1/coin/feed?fsym=BTC&tsym=USD';
                            s.src = theUrl + (theUrl.indexOf("?") >= 0 ? "&" : "?") + "app=" + appName;
                            embedder.parentNode.appendChild(s);
                        })();
                    </script>

                </div>
                <!-- Col small news end-->
            </div>
            <!-- Content row end-->
        </div>
        <!-- Container end-->
    </section>
    <!-- News end-->

    <section class="clients-area pab-120" id="clients-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 owl-carousel owl-theme text-center partners" id="partners-carousel">
                    <figure class="item partner-logo">
                        <a href="#">
                            <img class="img-fluid" src="assets/images/clients/client1.png" alt="">
                        </a>
                    </figure>
                    <figure class="item partner-logo">
                        <a href="#">
                            <img class="img-fluid" src="assets/images/clients/client2.png" alt="">
                        </a>
                    </figure>
                    <figure class="item partner-logo">
                        <a href="#">
                            <img class="img-fluid" src="assets/images/clients/client3.png" alt="">
                        </a>
                    </figure>
                    <figure class="item partner-logo">
                        <a href="#">
                            <img class="img-fluid" src="assets/images/clients/client4.png" alt="">
                        </a>
                    </figure>
                    <figure class="item partner-logo">
                        <a href="#">
                            <img class="img-fluid" src="assets/images/clients/client5.png" alt="">
                        </a>
                    </figure>
                    <figure class="item partner-logo last">
                        <a href="#">
                            <img class="img-fluid" src="assets/images/clients/client6.png" alt="">
                        </a>
                    </figure>
                    <figure class="item partner-logo last">
                        <a href="#">
                            <img class="img-fluid" src="assets/images/clients/client7.png" alt="">
                        </a>
                    </figure>
                </div>
                <!-- Owl carousel end-->
            </div>
            <!-- Content row end-->
        </div>
        <!-- Container end-->
    </section>
    <!-- Partners end-->

{/block}