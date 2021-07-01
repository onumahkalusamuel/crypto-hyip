<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <?php $page_title = $pageTitle ?? 'Welcome'; ?>
    <base href="<?= $basePath; ?>/" />
    <!-- Meta Tags -->
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta name="description" content="<?= $page_title; ?> - <?= $siteSettings['site_name']; ?>" />
    <meta name="keywords" content="cryptocurrency,bitcoin,finance,investment,referral,affiliate,news,insurance,agency" />
    <meta name="author" content="<?= $siteSettings['site_name']; ?>" />

    <!-- Page Title -->
    <title><?= $page_title; ?> - <?= $siteSettings['site_name']; ?></title>

    <!-- Favicon and Touch Icons -->
    <link href="assets/images/favicon.png" rel="shortcut icon" type="image/png">
    <link rel="apple-touch-icon" href="assets/images/apple-touch-icon-iphone-60x60.png">
    <link rel="apple-touch-icon" sizes="60x60" href="assets/images/apple-touch-icon-ipad-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="assets/images/apple-touch-icon-iphone-retina-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="assets/images/apple-touch-icon-ipad-retina-152x152.png">

    <!-- Stylesheet -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/jquery-ui.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/animate.css" rel="stylesheet" type="text/css">
    <link href="assets/css/css-plugin-collections.css" rel="stylesheet" />
    <!-- CSS | menuzord megamenu skins -->
    <link href="assets/css/menuzord-megamenu.css" rel="stylesheet" />
    <link id="menuzord-menu-skins" href="assets/css/menuzord-skins/menuzord-boxed.css" rel="stylesheet" />
    <!-- CSS | Main style file -->
    <link href="assets/css/style-main.css" rel="stylesheet" type="text/css">
    <!-- CSS | Preloader Styles -->
    <link href="assets/css/preloader.css" rel="stylesheet" type="text/css">
    <!-- CSS | Custom Margin Padding Collection -->
    <link href="assets/css/custom-bootstrap-margin-padding.css" rel="stylesheet" type="text/css">
    <!-- CSS | Responsive media queries -->
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css">
    <!-- CSS | Style css. This is the file where you can place your own custom css code. Just uncomment it and use it. -->
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">

    <!-- Revolution Slider 5.x CSS settings -->
    <link href="assets/js/revolution-slider/css/settings.css" rel="stylesheet" type="text/css" />
    <link href="assets/js/revolution-slider/css/layers.css" rel="stylesheet" type="text/css" />
    <link href="assets/js/revolution-slider/css/navigation.css" rel="stylesheet" type="text/css" />

    <!-- CSS | Theme Color -->
    <link href="assets/css/colors/theme-skin-color-set8.css" rel="stylesheet" type="text/css">

    <!-- external javascripts -->
    <script src="assets/js/jquery-2.2.4.min.js"></script>
    <script src="assets/js/jquery-ui.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- JS | jquery plugin collection for this theme -->
    <script src="assets/js/jquery-plugin-collection.js"></script>

    <!-- Revolution Slider 5.x SCRIPTS -->
    <script src="assets/js/revolution-slider/js/jquery.themepunch.tools.min.js"></script>
    <script src="assets/js/revolution-slider/js/jquery.themepunch.revolution.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="">
    <div id="wrapper" class="clearfix">
        <!-- preloader -->
        <div id="preloader">
            <div id="spinner" class="pulse">
                <img alt="" src="assets/images/favicon.png">
            </div>
            <div id="disable-preloader" class="btn btn-default btn-sm">Disable Preloader</div>
        </div>

        <!-- Header -->
        <header id="header" class="header">
            <div class="header-nav navbar-scrolltofixed">
                <div class="header-nav-wrapper">
                    <div class="container">
                        <nav id="menuzord-right" class="menuzord default pl-lg-15 pr-lg-15 pt-sm-5 pb-sm-5">
                            <a class="menuzord-brand pull-left flip mt-lg-20 mb-lg-15" href="<?= $route->urlFor('admin-dashboard'); ?>">
                                <img src="assets/images/logo-wide.png" alt="">
                            </a>
                            <ul class="menuzord-menu">
                                <?php $userMenu = ['dashboard','users','plans','deposits','withdrawals','referrals', 'transactions', 'settings']; ?>
                                <!-- others -->
                                <?php foreach ($userMenu as $menu) : ?>
                                    <?php $menu_title = (ucwords(str_replace("-", " ", $menu))); ?>
                                    <li class="<?= ($menu_title == $page_title ? 'active' : null) ?>">
                                        <a href="<?= $route->urlFor("admin-" . $menu); ?>">
                                            <?= $menu_title; ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                                <li class="">
                                    <a href="<?= $route->urlFor("logout"); ?>" onclick="return logoutUser()">Logout</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <script>
            function logoutUser() {
                if (!confirm("Are you sure you want to logout?")) return false;
                this.click();
            }
        </script>
