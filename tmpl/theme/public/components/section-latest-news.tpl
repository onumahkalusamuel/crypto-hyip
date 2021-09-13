<?php if (!empty($latest_news)) : ?>
<!-- Section: latest news -->
    <section id="blog">
        <div class="container mb-40">
            <div class="section-title">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="text-uppercase title">Latest <span class="text-theme-colored2">News</span></h2>
                        <div class="diamond-line-left-theme-colored2"></div>
                        <p class="mt-10">Information is power! Get acquainted with recent happenings. Maximize your profit by expanding your knowledge</p>
                    </div>
                </div>
            </div>
            <div class="section-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="owl-carousel-3col owl-nav-top" data-nav="true">
                            <?php foreach ($latest_news as $news) : ?>
                                <?php echo $this->fetch('public/components/news.php', ['news' => $news]); ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>