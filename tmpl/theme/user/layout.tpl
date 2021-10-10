<!DOCTYPE html>
<html lang="en" class="js">

<head>
    <meta charset="utf-8">
    <base href="{$basePath}/" />
    <meta name="author" content="Crypto HYIP Pro">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{block name=description}{$siteInfo.description}{/block}">
    <meta name="keywords" content="{block name=keywords}{$siteInfo.keywords}{/block}">
    <title>{block name=title}Dashboard{/block} | {$siteInfo.name}</title>
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <link rel="stylesheet" href="assets/css/apps.css">
    <style>
        div.content-container {
            border: 1px solid #3335;
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
            width: 40%;
            text-transform: uppercase;
        }

        div.item .content {
            width: 100%;
        }

        .form-control {
            width: 100%;
            border: 1px solid;
            color: unset !important;

        }

        div.item:nth-of-type(even) {
            background-color: #002fff22;
        }

        @media screen and (max-width: 1020px) {
            div.item {
                flex-wrap: wrap;
            }

            div.item .title {
                width: 100%;
                display: block;
            }

            .text-sm-left {
                text-align: left;
            }
        }
    </style>
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

<body class="nk-body npc-cryptlite has-sidebar has-sidebar-fat">
    <div class="nk-app-root">
        <div class="nk-main">

            <div class="nk-sidebar nk-sidebar-fat nk-sidebar-fixed is-light" data-content="sidebarMenu">

                <div class="nk-sidebar-element nk-sidebar-head">

                    <div class="nk-sidebar-brand">
                        <a class="logo-link nk-sidebar-logo" href="{$route->urlFor('user-dashboard')}">
                            <img class="logo-img logo-img-md" src="assets/images/logo-dark.png" alt="{$siteInfo.name}">
                        </a>
                    </div>

                    <div class="nk-menu-trigger mr-n2">
                        <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none toggle-active"
                            data-target="sidebarMenu">
                            <em class="icon ni ni-arrow-left"></em>
                        </a>
                    </div>
                </div>

                <div class="nk-sidebar-element">
                    <div class="nk-sidebar-body" data-simplebar="init">
                        <div class="simplebar-wrapper" style="margin: 0px;">
                            <div class="simplebar-height-auto-observer-wrapper">
                                <div class="simplebar-height-auto-observer"></div>
                            </div>
                            <div class="simplebar-mask">
                                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                    <div class="simplebar-content-wrapper"
                                        style="height: auto; overflow: hidden scroll;">
                                        <div class="simplebar-content" style="padding: 0px;">
                                            <div class="nk-sidebar-content">
                                                <div class="nk-sidebar-widget nk-sidebar-widget-full d-xl-none pt-0">
                                                    <a class="nk-profile-toggle toggle-expand"
                                                        data-target="sidebarProfile"
                                                        href="{$route->urlFor('user-profile')}">
                                                        <div class="user-card-wrap">
                                                            <div class="user-card">
                                                                <div class="user-avatar">
                                                                    <span>
                                                                        <div class="user-avatar bg-primary">
                                                                            <span>{$session->get('userName')|upper|@substr:"0":"2"}</span>
                                                                        </div>
                                                                    </span>
                                                                </div>
                                                                <div class="user-info">
                                                                    <span
                                                                        class="lead-text">{$session->get('userName')}</span>
                                                                    <span
                                                                        class="sub-text">{$session->get('email')}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>

                                                <div class="nk-sidebar-menu">
                                                    <ul class="nk-menu">
                                                        <li class="nk-menu-heading">
                                                            <h6 class="overline-title">Menu</h6>
                                                        </li>
                                                        <li class="nk-menu-item {if $active=="dashboard"}active{/if}">
                                                            <a href="{$route->urlFor('user-dashboard')}"
                                                                class="nk-menu-link">
                                                                <span class="nk-menu-icon"><em
                                                                        class="icon ni ni-dashboard"></em></span>
                                                                <span class="nk-menu-text">Dashboard</span>
                                                            </a>
                                                        </li>
                                                        <li class="nk-menu-item {if $active=="deposits"}active{/if}">
                                                            <a href="{$route->urlFor('user-deposits')}"
                                                                class="nk-menu-link">
                                                                <span class="nk-menu-icon"><em
                                                                        class="icon ni ni-invest"></em></span>
                                                                <span class="nk-menu-text">Deposits</span>
                                                            </a>
                                                        </li>
                                                        <li class="nk-menu-item {if $active=="withdrawals"}active{/if}">
                                                            <a href="{$route->urlFor('user-withdrawals')}"
                                                                class="nk-menu-link">
                                                                <span class="nk-menu-icon"><em
                                                                        class="icon ni ni-tranx"></em></span>
                                                                <span class="nk-menu-text">Withdrawals</span>
                                                            </a>
                                                        </li>
                                                        <li class="nk-menu-item {if $active=="referrals"}active{/if}">
                                                            <a href="{$route->urlFor('user-referrals')}"
                                                                class="nk-menu-link">
                                                                <span class="nk-menu-icon"><em
                                                                        class="icon ni ni-share"></em></span>
                                                                <span class="nk-menu-text">Referrals</span>
                                                            </a>
                                                        </li>
                                                        <li
                                                            class="nk-menu-item {if $active=="transactions"}active{/if}">
                                                            <a href="{$route->urlFor('user-account-logs')}"
                                                                class="nk-menu-link">
                                                                <span class="nk-menu-icon"><em
                                                                        class="icon ni ni-tranx"></em></span>
                                                                <span class="nk-menu-text">Transactions</span>
                                                            </a>
                                                        </li>
                                                        <li class="nk-menu-item {if $active=="profile"}active{/if}">
                                                            <a href="{$route->urlFor('user-profile')}"
                                                                class="nk-menu-link">
                                                                <span class="nk-menu-icon"><em
                                                                        class="icon ni ni-account-setting"></em></span>
                                                                <span class="nk-menu-text">My Profile</span>
                                                            </a>
                                                        </li>
                                                        <li class="nk-menu-heading">
                                                            <h6 class="overline-title">Additional</h6>
                                                        </li>

                                                        <li class="nk-menu-item">
                                                            <a href="{$route->urlFor('logout')}" class="nk-menu-link"
                                                                onclick="return confirm('Are you sure you want to logout?');">
                                                                <span class="nk-menu-text">Logout</span>
                                                            </a>
                                                        </li>
                                                        <li class="nk-menu-item">
                                                            <a href="{$route->urlFor('home')}" class="nk-menu-link">
                                                                <span class="nk-menu-text">Go to Website</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div class="nk-sidebar-footer">
                                                    <ul class="nk-menu nk-menu-footer">
                                                        <li class="nk-menu-item">
                                                            <a href="{$route->urlFor('page', ['page' => 'contact-us'])}"
                                                                class="nk-menu-link">
                                                                <span class="nk-menu-icon"><em
                                                                        class="icon ni ni-question"></em></span>
                                                                <span class="nk-menu-text">Contact</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="simplebar-placeholder" style="width: auto; height: 605px;"></div>
                        </div>
                        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                            <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                        </div>
                        <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                            <div class="simplebar-scrollbar"
                                style="height: 605px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="nk-wrap">
                <div class="nk-header nk-header-fluid nk-header-fixed is-light">
                    <div class="container-fluid">
                        <div class="nk-header-wrap">
                            <div class="nk-menu-trigger d-xl-none ml-n1">
                                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em
                                        class="icon ni ni-menu"></em></a>
                            </div>

                            <div class="nk-header-brand d-xl-none"><a class="logo-link"
                                    href="{$route->urlFor('user-dashboard')}">
                                    <img class="logo-img" src="assets/images/logo-dark.png" alt="{$siteInfo.name}">
                                </a>
                            </div>

                            <div class="nk-header-tools">
                                <ul class="nk-quick-nav">
                                    <li class="">
                                        <a href="{$route->urlFor('logout')}" class="btn btn-primary"
                                            onclick="return confirm('Are you sure you want to logout?');">
                                            LOGOUT
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nk-content nk-content-fluid">
                    <div class="container-xl wide-lg">
                        <div class="nk-content-body">
                            {include file="theme/public/components/flash-bag.tpl"}

                            <div class="nk-block-head">
                                <div class="nk-block-between-md g-4">
                                    <div class="nk-block-head-content">
                                        <h2 class="nk-block-title fw-normal">{block name=title}Dashboard{/block}</h2>
                                    </div>
                                </div>
                            </div>

                            {block name=body}{/block}
                        </div>
                    </div>
                </div>

                <div class="nk-footer">
                    <div class="container-fluid">
                        <div class="nk-footer-wrap">
                            <div class="nk-footer-copyright">{$siteInfo.name} &copy; {"Y"|@date}. All Rights Reserved.
                            </div>
                            <div class="nk-footer-links">

                                <ul class="nav nav-sm">

                                    <li class="nav-item">
                                        <a class="nav-link" href="{$route->urlFor('page',['page' => 'faqs'])}">FAQs</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{$route->urlFor('page',['page' => 'terms'])}">Terms
                                            and
                                            Condition</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="{$route->urlFor('page',['page' => 'privacy-policy'])}">Privacy
                                            Policy</a>
                                    </li>

                                </ul>

                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/script.js"></script>
    <script src="assets/js/bundle.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/charts.js"></script>

    {if $sysSettings.footerCode ne ""}
        {$sysSettings.footerCode}
    {/if}
</body>

</html>