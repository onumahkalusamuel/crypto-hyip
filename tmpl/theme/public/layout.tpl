<!DOCTYPE html>
<html lang="en" class="js">

<head>
    <meta charset="utf-8">
    <base href="{$basePath}/" />
    <meta name="author" content="Crypto HYIP Pro">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{block name=description}{$siteInfo.description}{/block}">
    <meta name="keywords" content="{block name=keywords}{$siteInfo.keywords}{/block}">
    <title>{block name=title}Welcome{/block} | {$siteInfo.name}</title>

    <!--====== Bootstrap css ======-->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!--====== Fontawesome css ======-->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">

    <!--====== Magnific Popup css ======-->
    <link rel="stylesheet" href="assets/css/magnific-popup.css">

    <!--====== Slick css ======-->
    <link rel="stylesheet" href="assets/css/slick.css">

    <!--====== YTPlayer css ======-->
    <link rel="stylesheet" href="assets/css/jquery.mb.YTPlayer.min.css">

    <!--====== Default css ======-->
    <link rel="stylesheet" href="assets/css/default.css">

    <!--====== Style css ======-->
    <link rel="stylesheet" href="assets/css/style.css">

    <link rel="shortcut icon" href="assets/images/favicon.ico">

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

    <!--====== SIDEBAR MENU PART START ======-->

    <div class="body-overlay" id="body-overlay"></div>
    <div class="sidebar-menu" id="sidebar-menu">
        <button class="sidebar-menu-close"><i class="fa fa-times"></i></button>
        <div class="sidebar-inner">
            <div class="sidebar-logo">
                <a class="logo-link" href="{$route->urlFor('home')}">
                    <img height="50px" class="logo-img logo-dark" src="assets/images/logo-dark.png"
                        alt="{$siteInfo.name}">
                    <img height="50px" class="logo-img logo-light" src="assets/images/logo-light.png"
                        alt="{$siteInfo.name}"></a>
            </div><!-- sidebar logo -->
            <div class="sidemenu-text">
                <p>Financial experts are within reach to assist you in making your financial dreams a reality.</p>
            </div>
            <div class="sidebar-contact">
                <h4>Contact Us</h4>
                <ul>
                    <li><i class="fa fa-map-marker"></i>{$siteInfo.address}</li>
                    <li><i class="fa fa-envelope"></i>{$siteInfo.email}</li>
                    <!--<li><i class="fa fa-phone"></i></li>-->
                </ul>
            </div>
            <div class="sidebar-subscribe">
                <input type="text" placeholder="Email">
                <button><i class="fa fa-long-arrow-right"></i></button>
            </div>
        </div>
    </div>

    <!--====== SIDEBAR MENU PART ENDS ======-->

    <!--====== HEADER PART START ======-->

    <header class="header-area header-v1-area">
        <div class="header-nav">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="navigation">
                            <nav class="navbar navbar-expand-lg navbar-light ">
                                <div class="header-logo">
                                    <a class="logo-link" href="{$route->urlFor('home')}">
                                        <img height="50px" class="logo-img logo-dark" src="assets/images/logo-dark.png"
                                            alt="{$siteInfo.name}">
                                        <img height="50px" class="logo-img logo-light"
                                            src="assets/images/logo-light.png" alt="{$siteInfo.name}"></a>
                                </div>
                                <button class="navbar-toggler" type="button" data-toggle="collapse"
                                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="toggler-icon"></span>
                                    <span class="toggler-icon"></span>
                                    <span class="toggler-icon"></span>
                                </button> <!-- navbar toggler -->

                                <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                    <ul class="navbar-nav m-auto">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{$route->urlFor('home')}">Home</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{$route->urlFor('page', ['page' => 'about-us'])}"
                                                class="menu-link nav-link">
                                                <span class="menu-text">About</span>
                                            </a>
                                        </li>
                                        <li class="nav-item active">
                                            <a href="{$route->urlFor('page', ['page' => 'faqs'])}"
                                                class="menu-link nav-link">
                                                <span class="menu-text">FAQs</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{$route->urlFor('page', ['page' => 'contact-us'])}"
                                                class="menu-link nav-link">
                                                <span class="menu-text">Contact</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{$route->urlFor('login')}">Login</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{$route->urlFor('register')}">Register</a>
                                        </li>
                                    </ul>
                                </div> <!-- navbar collapse -->
                                <div class="navbar-btn d-none d-sm-flex">
                                    <span id="navigation-button" class="d-none d-lg-block"><i
                                            class="fa fa-bars"></i></span>
                                    <a class="main-btn" href="{$route->urlFor('register')}">Register</a>
                                </div>
                            </nav>
                        </div> <!-- navigation -->
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!--====== HEADER PART ENDS ======-->
    {block name=body}{/block}
    <!--====== GET IN TOUCH PART START ======-->

    <section class="get_in_touch bg_image" style="background-image: url(assets/images/touch_bg.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="cutclub_content_box">
                        <h3>Let’s Keep in Touch!</h3>
                        <p>Subscribe to keep up with fresh news and exciting updates.</p>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="subscribe_form">
                        <form method="GET" action="">
                            <input type="email" class="form_control" placeholder="Enter your email address....">
                            <button class="main-btn">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--====== GET IN TOUCH PART ENDS ======-->

    <!--====== Start cutclub_footer section ======-->

    <footer class="cutclub_footer footer_v1 bg_cover" style="background-image: url(assets/images/footer_bg.jpg);">
        <div class="container">
            <div class="widget_wrapper">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="widget about_widget">
                            <div class="logo">
                                <div class="header-logo">
                                    <a class="logo-link" href="{$route->urlFor('home')}">
                                        <img height="50px" class="logo-img logo-dark" src="assets/images/logo-dark.png"
                                            alt="{$siteInfo.name}">
                                        <img height="50px" class="logo-img logo-light"
                                            src="assets/images/logo-light.png" alt="{$siteInfo.name}">
                                    </a>
                                </div>
                            </div>
                            <div class="description text-white pb-4">
                                {$siteInfo.description}
                            </div>
                            {$siteInfo.name} &copy; {"Y"|@date}. All Rights Reserved.
                        </div>

                    </div>

                    <div class="col-lg-4 col-sm-6">
                        <div class="widget what_we_widget">
                            <h4 class="widget-title">Company</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul>
                                        <li><a href="{$route->urlFor('home')}">Home</a></li>
                                        <li><a href="{$route->urlFor('page',['page' => 'about-us'])}">About</a></li>
                                        <li><a href="{$route->urlFor('page',['page' => 'faqs'])}">FAQ's</a></li>
                                        <li><a href="assets/images/licence.jpeg" target="_blank">Our Licence</a></li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul>
                                        <li><a href="{$route->urlFor('page',['page' => 'terms'])}">Terms</a></li>
                                        <li><a href="{$route->urlFor('page',['page' => 'contact-us'])}">Contact Us</a>
                                        </li>
                                        <li><a href="{$route->urlFor('login')}">Login</a></li>
                                        <li><a href="{$route->urlFor('register')}">Register</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="widget contact_widget">
                            <h4 class="widget-title">Let’s talk.</h4>
                            {if $siteInfo.email ne ""}
                            <div class="single_info">
                                <div class="icon">
                                    <i class="fa fa-envelope-open"></i>
                                </div>
                                <div class="info">
                                    <p><a href="mailto:{$siteInfo.email}">{$siteInfo.email}</a></p>
                                </div>
                            </div>
                            {/if}
                            {if $siteInfo.phone ne ""}
                            <div class="single_info">
                                <div class="icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="info">
                                    <p>
                                        <a href="mailto:{$siteInfo.phone}">{$siteInfo.phone}</a>
                                    </p>
                                </div>
                            </div>
                            {/if}
                            {if $siteInfo.address ne ""}
                            <div class="single_info">
                                <div class="icon">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                <div class="info">
                                    <p>{$siteInfo.address}</p>
                                </div>
                            </div>
                            {/if}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!--====== End cutclub_footer section ======-->

    <!--====== GO TO TOP PART START ======-->

    <div class="go-top-area">
        <div class="go-top-wrap">
            <div class="go-top-btn-wrap">
                <div class="go-top go-top-btn">
                    <i class="fa fa-angle-double-up"></i>
                    <i class="fa fa-angle-double-up"></i>
                </div>
            </div>
        </div>
    </div>
    <!--====== jquery js ======-->
    <script src="assets/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="assets/js/vendor/jquery-1.12.4.min.js"></script>

    <!--====== Bootstrap js ======-->
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/popper.min.js"></script>

    <!--====== Slick js ======-->
    <script src="assets/js/slick.min.js"></script>

    <!--====== Isotope js ======-->
    <script src="assets/js/isotope.pkgd.min.js"></script>

    <!--====== counterup js ======-->
    <script src="assets/js/jquery.counterup.min.js"></script>

    <!--====== waypoints js ======-->
    <script src="assets/js/waypoints.min.js"></script>

    <!--====== Images Loaded js ======-->
    <script src="assets/js/imagesloaded.pkgd.min.js"></script>

    <!--====== syotimer js ======-->
    <script src="assets/js/jquery.syotimer.min.js"></script>

    <!--====== Magnific Popup js ======-->
    <script src="assets/js/jquery.magnific-popup.min.js"></script>

    <!--====== Ajax Contact js ======-->
    <script src="assets/js/ajax-contact.js"></script>

    <!--====== Main js ======-->
    <script src="assets/js/main.js"></script>
    {if $sysSettings.footerCode ne ""}
    {$sysSettings.footerCode}
    {/if}
</body>

</html>