    <!-- Section: About -->
    <section>
        <div class="container pt-50">
            <div class="section-content">
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="text-uppercasetext-theme-colored mt-0">
                            About <span class="text-theme-colored2">
                                <?= $siteSettings['site_name']; ?>
                            </span>
                        </h2>
                        <div class="diamond-line-left-theme-colored-2"></div>
                        <p><?= $siteSettings['company_about']; ?></p>
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="font-weight-600">Our Mission</h4>
                                <p><?= $siteSettings['company_mission']; ?></p>
                            </div>
                            <div class="col-md-6">
                                <h4 class="font-weight-600">Our Vision</h4>
                                <p><?= $siteSettings['company_vision']; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box-hover-effect play-button mt-sm-40">
                            <div class="effect-wrapper">
                                <div class="thumb">
                                    <img class="img-fullwidth" src="assets/images/photos/1.jpg" alt="project">
                                </div>
                                <div class="overlay-shade"></div>
                                <div class="text-holder text-holder-middle">
                                    <a href="<?=$siteSettings['about_youtube_video_link'];?>" data-lightbox-gallery="youtube-video" title="Youtube Video"><img alt="" src="assets/images/play-button/s1.png"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>