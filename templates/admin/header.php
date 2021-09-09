<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <?php $page_title = $pageTitle ?? 'Welcome'; ?>
    <base href="<?= $basePath; ?>/" />
    <!-- Meta Tags -->
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <!-- Page Title -->
    <title><?= $page_title; ?> - <?= $siteSettings['site_name']; ?></title>

    <!-- Favicon and Touch Icons -->
    <link href="assets/images/favicon.png" rel="shortcut icon" type="image/png">
    <link rel="apple-touch-icon" href="assets/images/apple-touch-icon-iphone-60x60.png">
    <link rel="apple-touch-icon" sizes="60x60" href="assets/images/apple-touch-icon-ipad-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="assets/images/apple-touch-icon-iphone-retina-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="assets/images/apple-touch-icon-ipad-retina-152x152.png">

    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
</head>

<body class="">
    <div id="wrapper" class="clearfix">
        <!-- Header -->
        <header id="header" class="header">
            <div class="header-nav navbar-scrolltofixed">
                <div class="header-nav-wrapper">
                    <div class="container">
                        <nav id="" class="">
                            <a class="" href="<?= $route->urlFor('admin-dashboard'); ?>">
                                <img src="assets/images/logo-wide.png" alt="">
                            </a>
                            <ul class="">
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
