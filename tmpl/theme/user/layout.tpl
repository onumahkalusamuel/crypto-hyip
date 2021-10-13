<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <base href="{$basePath}/" />
    <meta charset="utf-8">
    <meta name="author" content="Crypto HYIP Pro">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{block name=description}{$siteInfo.description}{/block}">
    <meta name="keywords" content="{block name=keywords}{$siteInfo.keywords}{/block}">
    <title>{block name=title}Dashboard{/block} | {$siteInfo.name}</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/user/vendors/feather/feather.css">
    <link rel="stylesheet" href="assets/user/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="assets/user/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/user/vendors/ti-icons/css/themify-icons.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="assets/user/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" />
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
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo mr-5" href="{$route->urlFor('user-dashboard')}"><img
                        src="assets/images/logo-large-dark.png" class="mr-2" alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" href="{$route->urlFor('user-dashboard')}"><img
                        src="assets/images/logo-mini-dark.png" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-settings d-none d-lg-flex">
                        <a class="nav-link" href="{$route->urlFor('logout')}"
                            onclick="return confirm('Are you sure you want to logout?')">
                            <i class="icon-power"></i>
                        </a>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="icon-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item {if $active=="dashboard"}active{/if}">
                        <a class="nav-link" href="{$route->urlFor('user-dashboard')}">
                            <i class="icon-grid menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item {if $active=="deposits"}active{/if}">
                        <a class="nav-link" href="{$route->urlFor('user-deposits')}">
                            <i class="icon-bar-graph menu-icon"></i>
                            <span class="menu-title">Deposits</span>
                        </a>
                    </li>
                    <li class="nav-item {if $active=="withdrawals"}active{/if}">
                        <a class="nav-link" href="{$route->urlFor('user-withdrawals')}">
                            <i class="icon-grid menu-icon"></i>
                            <span class="menu-title">Withdrawals</span>
                        </a>
                    </li>
                    <li class="nav-item {if $active=="referrals"}active{/if}">
                        <a class="nav-link" href="{$route->urlFor('user-referrals')}">
                            <i class="icon-columns menu-icon"></i>
                            <span class="menu-title">Referrals</span>
                        </a>
                    </li>
                    <li class="nav-item {if $active=="transactions"}active{/if}">
                        <a class="nav-link" href="{$route->urlFor('user-account-logs')}">
                            <i class="icon-grid-2 menu-icon"></i>
                            <span class="menu-title">Transactions</span>
                        </a>
                    </li>
                    <li class="nav-item {if $active=="profile"}active{/if}">
                        <a class="nav-link" href="{$route->urlFor('user-profile')}">
                            <i class="icon-head menu-icon"></i>
                            <span class="menu-title">My Profile</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{$route->urlFor('logout')}"
                            onclick="return confirm('Are you sure you want to logout?');">
                            <i class="icon-power menu-icon"></i>
                            <span class="menu-title">Logout</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                {block name=body}{/block}
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.
                            {$siteInfo.name}. All rights reserved.</span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <script src="assets/user/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/user/js/off-canvas.js"></script>
    <script src="assets/user/js/hoverable-collapse.js"></script>
    <script src="assets/user/js/template.js"></script>
    <script src="assets/user/js/settings.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="assets/js/script.js"></script>
    <!-- End custom js for this page-->
</body>

</html>