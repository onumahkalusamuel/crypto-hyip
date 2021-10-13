<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <base href="{$basePath}/" />
    <meta name="author" content="Crypto HYIP Pro">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="{block name=description}{$siteInfo.description}{/block}">
    <meta name="keywords" content="{block name=keywords}{$siteInfo.keywords}{/block}">
    <title>{block name=title}Welcome{/block} | {$siteInfo.name}</title>

    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Bootstrap-->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Animation-->
    <link rel="stylesheet" href="assets/css/animate.css">
    <!-- Morris Css -->
    {* <link rel="stylesheet" href="assets/css/morris.css"> *}
    <!-- FontAwesome-->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <!-- Icon font-->
    <link rel="stylesheet" href="assets/css/icon-font.css">
    <!-- Owl Carousel-->
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <!-- Owl Theme -->
    <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
    <!-- Colorbox-->
    <link rel="stylesheet" href="assets/css/colorbox.css">
    <!-- Template styles-->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Responsive styles-->
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" type="text/css" href="assets/css/sop.css">

    <!-- google translate -->
    <style type="text/css">
        .goog-logo-link {
            display: none !important;
        }

        .goog-te-gadget {
            color: transparent !important;
        }

        .goog-te-gadget .goog-te-combo {
            color: blue !important;
        }

        .goog-te-banner-frame.skiptranslate {
            display: none !important;
        }

        body {
            top: 0px !important;
        }
    </style>

    <script>
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en'
            }, 'google_translate_element');
        }
    </script>
    <script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    {if $sysSettings.googleTrackId ne ""}
        <script async src="https://www.googletagmanager.com/gtag/js?id={$sysSettings.googleTrackId}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
                } gtag('js', new Date()); gtag('config', "{$sysSettings.googleTrackId}");
        </script>
    {/if}
    {if $sysSettings.headerCode ne ""}
        {$sysSettings.headerCode}
    {/if}
</head>

<body>

    <div class="body-inner">
        <div class="site-top">
            <div class="topbar-transparent" id="top-bar">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <ul class="top-info">

                                <li><span class="info-icon"><i class="icon icon-envelope"></i></span>
                                    <div class="info-wrapper">
                                        <p class="info-title">{$siteInfo.email}</p>
                                    </div>
                                </li>
                                <li class="last"><span class="info-icon"><i class="icon icon-map-marker2"></i></span>
                                    <div class="info-wrapper">
                                        <p class="info-title">{$siteInfo.address}</p>
                                    </div>
                                </li>
                            </ul>
                            <!-- Ul end-->
                        </div>
                        <!--Top info end-->
                        <div class="col-lg-3 col-md-3 col-sm-12 text-lg-right text-md-center">

                            <!-- Top Social End -->
                        </div>
                        <!--Col end-->
                    </div>
                    <!--Content row end-->
                </div>
                <!--Container end-->
            </div>
            <!--Top bar end-->

            <header class="header-standard header-boxed header-light" id="header">
                <div class="container">
                    <div class="site-nav-inner">
                        <nav class="navbar navbar-expand-lg">
                            <div class="navbar-brand navbar-header">
                                <div class="logo">
                                    <a href="{$route->urlFor('home')}">
                                        <img src="assets/images/logo-large-dark.png" alt="">
                                    </a>
                                </div>
                                <!-- logo end-->
                            </div>
                            <!-- Navbar brand end-->
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation"><span
                                    class="navbar-toggler-icon"><i class="icon icon-menu"></i></span></button>
                            <!-- End of Navbar toggler-->
                            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                                <ul class="navbar-nav" style="padding-right: unset!important;">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{$route->urlFor('home')}">Home</a>
                                    </li>
                                    <!-- li end-->
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="{$route->urlFor('page', ['page' => 'about-us'])}">About us</a>
                                    </li>
                                    <!-- li end-->
                                    <li class="nav-item">
                                        <a class="nav-link" href="{$route->urlFor('page', ['page' => 'faqs'])}">FaQs</a>
                                    </li>
                                    <!-- li end-->
                                    <li class="nav-item">
                                        <a class="nav-link" href="{$route->urlFor('login')}">
                                            Login
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{$route->urlFor('register')}">
                                            Register
                                        </a>
                                    </li>
                                    <li class="nav-item" style="display:table">
                                        <div style="display:table-cell; vertical-align:middle" class="nav-link" id="google_translate_element"></div> 
                                    </li>
                                </ul>
                                <!--Nav ul end-->
                            </div>
                        </nav>
                    </div>
                    <!-- Site nav inner end-->
                </div>
                <!-- Container end-->
            </header>
            <!-- Header end-->
        </div>

        {block name=body}{/block}

        <!-- Footer start-->
        <footer class="footer" id="footer">
            <div class="footer-top">
                <div class="container">
                    <div class="footer-top-bg row">
                        <div class="col-lg-6 footer-box"><i class="icon icon-map-marker2"></i>
                            <div class="footer-box-content">
                                <h3>Head Office</h3>
                                <p>{$siteInfo.address} </p>
                            </div>
                        </div>
                        <!-- Box 1 end-->

                        <!-- Box 2 end-->
                        <div class="col-lg-6 footer-box"><i class="icon icon-envelope"></i>
                            <div class="footer-box-content">
                                <h3>Mail Us</h3>
                                <p>{$siteInfo.email}</p>
                            </div>
                        </div>
                        <!-- Box 3 end-->
                    </div>
                    <!-- Content row end-->
                </div>
                <!-- Container end-->
            </div>
            <!-- Footer top end-->
            <div class="footer-main bg-overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-12 footer-widget footer-about">
                            <div class="footer-logo">
                                <a href="{$route->urlFor('home')}">
                                    <img src="assets/images/logo-large-light.png" alt="">
                                </a>
                            </div>
                            <p>We are an award winning multinational company. We believe in quality and standard
                                worldwide.</p>

                            <!-- Footer social end-->
                        </div>
                        <!-- About us end-->
                        <div class="col-lg-4 col-md-12 footer-widget">
                            <h3 class="widget-title">Useful Links</h3>
                            <ul class="list-dash">
                                <li><a href="{$route->urlFor('page', ['page'=> 'about-us'])}">About Us</a></li>
                                <li><a href="{$route->urlFor('login')}">Login</a></li>
                                <li><a href="{$route->urlFor('register')}">Register</a></li>
                                <li><a href="{$route->urlFor('page', ['page'=> 'faqs'])}">FAQs</a></li>
                                <li><a href="{$route->urlFor('page', ['page'=> 'terms'])}">Terms of service</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-4 col-md-12 footer-widget">
                            <h3 class="widget-title">QUICK LINKS BUY BITCOIN</h3>
                            <ul class="list-dash">
                                <li><a href="https://coinmama.com/" target="_blank">Coin Mama</a></li>
                                <li><a href="https/paybis.html" target="_blank">PayBis</a></li>
                                <li><a href="https://coinbase.com/" target="_blank">Coin Base</a></li>
                                <li><a href="https://luno.com/" target="_blank">Luno</a></li>
                                <li><a href="https://xcoin.com/" target="_blank">Xcoin</a></li>
                                <li><a href="https://kraken.com/" target="_blank">kraken</a></li>
                                <li><a href="https://binance.com/" target="_blank">Binance</a></li>
                                <li><a href="https://bit2me.com/" target="_blank">Bit2me</a></li>
                                <li><a href="https://indodax.com/" target="_blank">Indodax</a></li>
                                <li><a href="https/coinhako.html" target="_blank">Coinhako</a></li>
                                <li><a href="https://wazirx.com/" target="_blank">Wazirx</a></li>
                                <li><a href="https://zebpay.com/" target="_blank">Zebpay</a></li>

                            </ul>
                        </div>
                        <div class="col-12 footer-widget">
                            <div class="newsletter-introtext"><small>The information on this website does not convey an
                                    offer of any type and is not intended to be, and should not be construed as, an
                                    offer to sell, or the solicitation of an offer to buy, any securities, commodities,
                                    or other financial products. In addition, the information on this website does not
                                    constitute the provision of investment advice.No assurances can be made that any
                                    aims, assumptions, expectations, strategies, and/or goals expressed or
                                    implied herein were or will be realized or that the activities or any performance
                                    described did or will continue at all or in the same manner as is described on this
                                    website.</small>.</div>

                        </div>
                        <!-- Content row end-->
                    </div>
                    <!-- Container end-->
                </div>
                <!-- Footer Main-->
                <div class="copyright">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="copyright-info">
                                    <span>Copyright © 2017 {$siteInfo.name}. All Rights Reserved.</span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="footer-menu">
                                    <ul class="nav unstyled">
                                        <li><a href="{$route->urlFor('page', ['page' => 'about-us'])}">About</a></li>
                                        <li><a href="{$route->urlFor('page', ['page' => 'terms'])}">Privacy
                                                Policy</a></li>
                                        <li><a href="{$route->urlFor('page', ['page' => 'terms'])}">Legals</a></li>
                                        <li><a href="{$route->urlFor('page', ['page' => 'contact-us'])}">Contact</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Row end-->
                    </div>
                    <!-- Container end-->
                </div>
                <!-- Copyright end-->
        </footer>
        <!-- Footer end-->

        <div class="back-to-top affix" id="back-to-top" data-spy="affix" data-offset-top="10">
            <button class="btn btn-primary" title="Back to Top"><i class="fa fa-angle-double-up"></i>
                <!-- icon end-->
            </button>
            <!-- button end-->
        </div>
        <!-- End Back to Top-->

        <!--
      Javascript Files
      ==================================================
      -->
        <!-- initialize jQuery Library-->
        <script type="text/javascript" src="assets/js/jquery.js"></script>
        <!-- Popper-->
        <script type="text/javascript" src="assets/js/popper.min.js"></script>
        <!-- Bootstrap jQuery-->
        <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
        <!-- Owl Carousel-->
        <script type="text/javascript" src="assets/js/owl.carousel.min.js"></script>
        <!-- Counter-->
        <script type="text/javascript" src="assets/js/jquery.counterup.min.js"></script>
        <!-- Waypoints-->
        <script type="text/javascript" src="assets/js/waypoints.min.js"></script>
        <!-- Color box-->
        <script type="text/javascript" src="assets/js/jquery.colorbox.js"></script>
        <!-- Smoothscroll-->
        <script type="text/javascript" src="assets/js/smoothscroll.js"></script>
        <script src="assets/js/spop.js"></script>
        <!-- Template custom-->

        <script src="assets/js/spop.js"></script>

        <script type="text/javascript" src="assets/js/custom.js"></script>
        <script type="text/javascript" src="assets/js/script.js"></script>

        <script type="text/javascript">
            var country_list = ["Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Anguilla",
                "Antigua & Barbuda", "Argentina", "Armenia", "Australia", "Austria", "Azerbaijan", "Bahamas",
                "Bahrain", "Bangladesh", "Belarus", "Belgium", "Benin", "Bermuda", "Bhutan", "Bolivia",
                "Bosnia & Herzegovina", "Botswana", "Brazil", "British Virgin Islands", "Brunei", "Bulgaria",
                "Burundi", "Cambodia", "Cameroon", "Cape Verde", "Chad", "Chile", "China", "Colombia", "Congo",
                "Costa Rica", "Cote D Ivoire", "Croatia", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti",
                "Dominica", "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Estonia",
                "Ethiopia", "Falkland Islands", "Faroe Islands", "Finland", "France", "French Polynesia",
                "French West Indies", "Gabon", "Gambia", "Georgia", "Germany", "Gibraltar", "Greece", "Greenland",
                "Grenada", "Guatemala", "Guinea", "Haiti", "Honduras", "Hong Kong", "Hungary", "Iceland", "India",
                "Indonesia", "Iran", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jersey", "Jordan",
                "Kazakhstan", "Kenya", "Kuwait", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya",
                "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia", "Madagascar", "Malawi",
                "Malaysia", "Maldives", "Mali", "Malta", "Mauritania", "Mauritius", "Mexico", "Moldova", "Monaco",
                "Mongolia", "Montenegro", "Montserrat", "Morocco", "Mozambique", "Namibia", "Nepal", "Netherlands",
                "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Norway", "Oman", "Pakistan",
                "Palestine", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Poland", "Portugal",
                "Puerto Rico", "Qatar", "Reunion", "Romania", "Russia", "Rwanda", "Saint Pierre & Miquelon",
                "San Marino", "Saudi Arabia", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore",
                "Slovakia", "Slovenia", "South Africa", "South Korea", "Spain", "Sri Lanka", "Sudan", "Suriname",
                "Swaziland", "Sweden", "Switzerland", "Syria", "Taiwan", "Tajikistan", "Tanzania", "Thailand",
                "Togo", "Tonga", "Trinidad & Tobago", "Tunisia", "Turkey", "Turkmenistan", , "Ukraine",
                "United Arab Emirates", "United Kingdom", "Uruguay", "Uzbekistan", "Venezuela", "Vietnam",
                "Virgin Islands (US)", "Yemen"
            ];

            function choice(array) {
                return array[Math.floor(Math.random() * array.length)];
            }

            function randomNumber(min, max) {
                return Math.random() * (max - min) + min;
            }


            function payinout() {
                var nu = Math.floor(randomNumber(100, 3500));
                var con = choice(country_list);
                var mode = choice(['deposited', 'withdrew']);

                spop({
                    template: "An Investor from " + con + " " + mode + " $" + nu + " ...",

                    position: 'bottom-center',
                    style: 'success',
                    autoclose: 4000,
                });

            }

            setInterval(payinout, 7000);
        </script>
    </div>
    <!--Body Inner end-->

    {if $sysSettings.footerCode ne ""}
        {$sysSettings.footerCode}
    {/if}

</body>

</html>