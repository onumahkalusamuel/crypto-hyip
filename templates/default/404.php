<html dir="ltr" lang="en">

<head>
    <base href="<?= $basePath; ?>/" />
    <!-- Meta Tags -->
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="description" content="Consulting Finance Corporate Business - ConsultingPro HTML Template">
    <meta name="keywords" content="consulting,finance,advisor,consultant,business,service,insurance,agency">
    <meta name="author" content="ThemeMascot">

    <!-- Page Title -->
    <title>Not Found - <?php echo $siteSettings['site_name']; ?></title>

    <!-- Favicon and Touch Icons -->
    <link href="assets/images/favicon.png" rel="shortcut icon" type="image/png">
    <link href="assets/images/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="assets/images/apple-touch-icon-72x72.png" rel="apple-touch-icon" sizes="72x72">
    <link href="assets/images/apple-touch-icon-114x114.png" rel="apple-touch-icon" sizes="114x114">
    <link href="assets/images/apple-touch-icon-144x144.png" rel="apple-touch-icon" sizes="144x144">

    <!-- Stylesheet -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/jquery-ui.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/animate.css" rel="stylesheet" type="text/css">
    <link href="assets/css/css-plugin-collections.css" rel="stylesheet">
    <!-- CSS | menuzord megamenu skins -->
    <link href="assets/css/menuzord-megamenu.css" rel="stylesheet">
    <link id="menuzord-menu-skins" href="assets/css/menuzord-skins/menuzord-boxed.css" rel="stylesheet">
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

    <!-- CSS | Theme Color -->
    <link href="assets/css/colors/theme-skin-color-set8.css" rel="stylesheet" type="text/css">

    <!-- external javascripts -->
    <script src="assets/js/jquery-2.2.4.min.js"></script>
    <script src="assets/js/jquery-ui.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- JS | jquery plugin collection for this theme -->
    <script src="assets/js/jquery-plugin-collection.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="">
    <div id="wrapper" class="clearfix">
        <!-- Start main-content -->
        <div class="main-content">
            <!-- Section: home -->
            <section id="home" class="fullscreen bg-lightest">
                <div class="display-table text-center">
                    <div class="display-table-cell">
                        <div class="container pt-0 pb-0">
                            <div class="row">
                                <div class="col-md-7 mb-sm-60">
                                    <h1 class="font-200 line-height-1em mt-0 mb-0 text-theme-colored2">404!</h1>
                                    <h2 class="mt-0">Oops! Page Not Found</h2>
                                    <p>The page you were looking for could not be found.</p>
                                    <a class="btn btn-border btn-lg btn-theme-colored smooth-scroll-to-target" href="<?= $route->urlFor('home'); ?>">Return Home
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <h3>Some Useful Links</h3>
                                    <div class="widget">
                                        <div class="clearfix">
                                            <div class="col-md">
                                                <a class="useful-link" href="<?= $route->urlFor('home'); ?>">Home</a>
                                                <?php foreach ($siteSettings['secondary_menu'] as $menu) : ?>
                                                    <a class="useful-link" href="<?= $route->urlFor('page', ['page' => $menu]); ?>"><?= (ucwords(str_replace("-", " ", $menu))); ?></a>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>

</html>