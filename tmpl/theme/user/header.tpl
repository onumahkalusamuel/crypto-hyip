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


    <style>
        div.content-container {
            border-radius: 5px;
            border: 1px solid #3335;
            margin-left: 20px;
            margin-right:20px;
            {* padding: 10px; *}

        }

        h3.section-title {
            padding: 0px 10px;
        }

        div.item {
            padding: 1em 0.8em;
            font-size: 1.2em;
            color: black;
            display: flex;
            border-bottom: 1px solid #333
        }

        div.item:last-child {
            border-bottom: none
        }

        div.item .title {
            font-weight: bold;
            width: 30%;
        }

        div.item .content {
            width: 100%;
        }

        .form-control {
            width:100%;
            border: 1px solid;
            color:unset!important;

        }

        div.item:nth-of-type(even) {
            background-color: #ffb40022;
        }

        @media screen and (max-width: 1020px) {
            div.item {
                flex-wrap: wrap;
            }

            div.item .title {
                width: 100%;
                display: block;
            }
        }
    </style>
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
                            <img class="logo-light" src="assets/images/logo/logo-light.png" height="60px"
                                alt="Site Logo">
                            <img class="logo-dark" src="assets/images/logo/logo-dark.png" height="60px"
                                alt="Site Logo">
                        </a>
                    </div>
                    <div class="collapse navbar-collapse pull-right" id="navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-left nav-pos-right">

                            <li class="{if $active==="dashboard"}active{/if}">
                                <a href="{$route->urlFor('user-dashboard')}" class="menu-item">Dashboard</a>
                            </li>

                            <li class="{if $active==="deposits"}active{/if}">
                                <a href="{$route->urlFor('user-deposits')}" class="menu-item">Deposits</a>
                            </li>
                            <li class="{if $active==="withdrawals"}active{/if}">
                                <a href="{$route->urlFor('user-withdrawals')}" class="menu-item">Withdrawals</a>
                            </li>
                            <li class="{if $active==="referrals"}active{/if}">
                                <a href="{$route->urlFor('user-referrals')}" class="menu-item">Referrals</a>
                            </li>
                            <li class="{if $active==="account_logs"}active{/if}">
                                <a href="{$route->urlFor('user-account-logs')}" class="menu-item">Account Logs</a>
                            </li>
                            <li class="{if $active==="profile"}active{/if}">
                                <a href="{$route->urlFor('user-profile')}" class="menu-item">Profile</a>
                            </li>
                            <li>
                                <a href="{$route->urlFor('logout')}" class="menu-item"
                                    onclick="return confirm('Are you sure you want to logout?');">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
</header>
