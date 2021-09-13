    <!-- Section: inner-header -->
    <section class="inner-header divider layer-overlay overlay-dark-4" data-bg-img="assets/images/bg/bg1.jpg" style="background-image: url(&quot;assets/images/bg/bg1.jpg&quot;);">
        <div class="container pt-30 pb-20">
            <!-- Section Content -->
            <div class="section-content">
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="text-theme-colored2 font-36"><?=$pageTitle;?></h2>
                        <ol class="breadcrumb text-left mt-10 white">
                            <li><a href="<?= $route->urlFor('user-dashboard'); ?>">Account</a></li>
                            <li class="active"><?=$pageTitle;?></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>