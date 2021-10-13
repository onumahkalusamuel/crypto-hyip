{extends file="theme/public/layout.tpl"}
{block name=title}About Us{/block}
{block name=body}


    <div class="banner-area" id="banner-area" style="background-image:url(assets/images/banner/banner5.jpg);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col">
                    <div class="banner-heading">
                        <h1 class="banner-title">About us</h1>
                        <ol class="breadcrumb">
                            <li><a href="{$route->urlFor('home')}">Home</a></li>
                            <li>About us</li>
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


    <section class="ts-about-intro" id="ts-about-intro">
        <div class="container">
            <div class="row">
                <div class="col">
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
                                s.src = theUrl + (theUrl.indexOf("?") >= 0 ? "&" : "?") + "app=" + appName;
                                embedder.parentNode.appendChild(s);
                            })();
                        </script>




                    </span>
                    <h2 class="column-title title-small"><span>
                        </span>{$siteInfo.name}</h2>

                    <p>Remodel Your Living!!! {$siteInfo.name} is the World Leading Crypto Forex Trading Platform. We have
                        affiliation with blockchain Trading pool and other major companies like Coinbase and Coinmama. We
                        are using new technology and artificial intelligence to build a better Financial System. Our
                        Platform have powered over 100M transactions and empowered Investors in 140 countries across the
                        globe to invest wisely and get their return on investment without costly intermediaries or charges.
                        We also offer tools for developers and real time transaction data for users to analyze the
                        burgeoning digital economy.
                        Join over 28,000 users from all over the world to enjoy our world class service. COMMITMENT TO
                        QUALITY, EXPERTISE AND CONTINUITY IN A FAST-PACED MARKET!!!.</p>
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
                                    <p>ISO certification ensures that an organization runs its business using international
                                        standards for products, services and processes. </p>
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

    <section class="bg-overlay ts-chart">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-12">
                    <h2 class="column-title title-white"><span>REFERRAL BENEFITS</h2>
                    <p class="intro-desc">As a way of compensating investors who introduce friends and family into the
                        company, {$siteInfo.name} offers a generous 10% of the new investor initial deposit.

                        The commission is paid into the investors portfolio immediately the new investor's deposit is
                    confirmed.

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
                        <div class="team-social-icons"><a target="_blank" href="#"><i class="fa fa-facebook"></i></a><a
                                target="_blank" href="#"><i class="fa fa-twitter"></i></a>
                            <a target="_blank" href="#"><i class="fa fa-google-plus"></i></a><a target="_blank" href="#"><i
                                    class="fa fa-linkedin"></i></a>
                        </div>
                        <!-- social-icons-->
                    </div>
                    <!-- Team wrapper 1 end-->
                </div>
                <!-- Col end-->

                <div class="col-lg-6 qutoe-form-inner-left">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!4v1631354955003!6m8!1m7!1sVAaiSAGL2C6lmQKN1pyF7w!2m2!1d38.67938172540038!2d-90.37441944939471!3f155.28547314814654!4f2.968975602603308!5f0.7820865974627469"
                        width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy"></iframe>

                </div>


            </div>
            <!-- Content row end-->
        </div>
        <!-- Container end-->
    </section>
    <!-- Section Team end-->
    <section class="bg-overlay ts-chart">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-12">
                    <img src="assets/images/investorm-certificate.png" width="100%">
                </div>

            </div>
            <!-- Content row end-->
        </div>
        <!-- Container end-->
    </section>
    <!-- Section chart end-->

{/block}