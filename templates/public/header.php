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

    <!-- Import the chat providers here -->
    <?php echo $this->fetch('crisp.php'); ?>
    <?php echo $this->fetch('tawkto.php'); ?>
</head>

<body class="">
    <div id="wrapper" class="clearfix">
        <!-- Header -->
        <header id="header" class="header header-floating header-floating-text-dark">
            <div class="header-top sm-text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="widget text-white">
                                <i class="fa fa-envelope-o text-theme-colored2"></i>
                                <?= $siteSettings['contact_email']; ?>
                            </div>
                        </div>
                        <div class="col-md-5">

                            <div class="widget">
                                <ul class="list-inline  text-right flip sm-text-center">
                                    <li class="m-0 pl-10"> <a href="<?= $route->urlFor('page', ['page' => 'login']); ?>" class="text-white"><i class="fa fa-user-o mr-5 text-theme-colored2"></i> Login /</a> </li>
                                    <li class="m-0 pl-0 pr-10">
                                        <a href="<?= $route->urlFor('page', ['page' => 'register']); ?>" class="text-white"><i class="fa fa-edit mr-5 text-theme-colored2"></i>Register</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-nav navbar-scrolltofixed navbar-sticky-animated">
                <div class="header-nav-wrapper">
                    <div class="container">
                        <nav id="menuzord-right" class="menuzord default pl-lg-15 pr-lg-15 pt-sm-5 pb-sm-5">
                            <a class="menuzord-brand pull-left flip mt-lg-20 mb-lg-15" href="<?= $route->urlFor('home'); ?>">
                                <img src="assets/images/logo-wide.png" alt="">
                            </a>
                            <ul class="menuzord-menu">
                                <!-- //home -->
                                <li class="<?= ('Home' == $page_title ? 'active' : null) ?>">
                                    <a href="<?= $route->urlFor('home'); ?>">Home</a>
                                </li>
                                <!-- others -->
                                <?php foreach ($siteSettings['primary_menu'] as $menu) : ?>
                                    <?php $menu_title = (ucwords(str_replace("-", " ", $menu))); ?>
                                    <li class="<?= ($menu_title == $page_title ? 'active' : null) ?>">
                                        <a href="<?= $route->urlFor('page', ['page' => $menu]); ?>">
                                            <?= $menu_title; ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
