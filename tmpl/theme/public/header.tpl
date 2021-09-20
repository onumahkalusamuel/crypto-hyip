<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    {if !isset($pageTitle) }
        {assign var="pageTitle" value="Welcome"}
    {/if}
    {if !isset($active) }
        {assign var="active" value="home"}
    {/if}
    <base href="{$basePath}/" />
    <!-- Meta Tags -->
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta name="keywords"
        content="cryptocurrency,bitcoin,finance,investment,referral,affiliate,news,insurance,agency" />
    <meta name="description" content="Bitcoin And Crypto Currency Investment Platform">
    <link href="assets/images/favicon/favicon.png" rel="shortcut icon" type="image/png">

    <link
        href="https://fonts.googleapis.com/css?family=Exo+2:300i,400,400i,500,500i,600,600i,700%7CRoboto:300i,400,400i,500,500i,700"
        rel="stylesheet" type="text/css">

    <link href="assets/css/external.css" rel="stylesheet">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="assets/revolution/css/settings.css">
    <link rel="stylesheet" type="text/css" href="assets/revolution/css/layers.css">
    <link rel="stylesheet" type="text/css" href="assets/revolution/css/navigation.css">

    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
      <script src="assets/js/respond.min.js"></script>
    <![endif]-->


    <!-- Page Title -->
    <title>{$pageTitle} - {$siteSettings.site_name}</title>

    <!-- Import the chat providers here -->
    {include file="theme/crisp.tpl"}
    {include file="theme/tawkto.tpl"}
</head>

<body class="">
    <div class="preloader">
        <div class="signal"></div>
    </div>
    <div id="wrapper" class="wrapper clearfix">
        <!-- Header -->
        <header id="navbar-spy" class="header header-1 header-transparent header-bordered header-fixed">
            <nav id="primary-menu" class="navbar navbar-fixed-top">
                <div class="container">

                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="logo" href="{$route->urlFor('home')}">
                            <img class="logo-light" src="assets/images/logo/logo-light.png" height="60px" alt="Enrmous Logo">
                            <img class="logo-dark" src="assets/images/logo/logo-dark.png" height="60px" alt="Enrmous Logo">
                        </a>
                    </div>
                    <div class="collapse navbar-collapse pull-right" id="navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-left nav-pos-right">

                            <li class="{if $active==="home"}active{/if}">
                                <a href="{$route->urlFor('home')}" class="menu-item">Home</a>
                            </li>

                            <li class="{if $active==="about_us"}active{/if}">
                                <a href="{$route->urlFor('page', ['page'=>'about-us'])}" class="menu-item">About Us</a>
                            </li>
                            <li class="{if $active==="investment_plans"}active{/if}">
                                <a href="{$route->urlFor('page', ['page'=>'investment-plans'])}"
                                    class="menu-item">Investment Plans</a>
                            </li>
                            <li class="{if $active==="faqs"}active{/if}">
                                <a href="{$route->urlFor('page', ['page'=>'faqs'])}" class="menu-item">FAQs</a>
                            </li>
                            <li class="{if $active==="contact_us"}active{/if}">
                                <a href="{$route->urlFor('page', ['page'=>'contact-us'])}" class="menu-item">Contact
                                    Us</a>
                            </li>
                            <li class="{if $active==="latest_news"}active{/if}">
                                <a href="{$route->urlFor('page', ['page'=>'latest-news'])}" class="menu-item">Latest
                                    News</a>
                            </li>
                        </ul>
                        <div class="module module-consultation pull-left">
                            <a href="{$route->urlFor('page', ['page'=>'register'])}"
                                class="btn btn--white btn--bordered btn--rounded">Register</a>
                        </div>
                        <div class="module module-signup pull-left">
                            <a class="btn-popup" href="{$route->urlFor('page', ['page'=>'login'])}">Login</a>
                        </div>
                    </div>
                </div>
            </nav>
</header>