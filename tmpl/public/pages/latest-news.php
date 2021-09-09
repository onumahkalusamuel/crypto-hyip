<?php $this->addAttribute('pageTitle', 'Latest News'); ?>
<?php $this->setLayout('public/layout.php'); ?>

<div class="main-content">

    <?php echo $this->fetch('public/components/page-inner-header.php'); ?>

    <section id="blog">
        <div class="container mb-40">
            <div class="section-title">
                <div class="row text-center">
                    <div class="col-md-12">
                        <h2 class="text-uppercase title">Latest <span class="text-theme-colored2">News</span></h2>
                        <div class="line-bottom-double-line-centered"></div>
                        <p class="mt-10">Information is power! Get acquainted with recent happenings. Maximize your profit by expanding your knowledge</p>
                    </div>
                </div>
            </div>
            <div class="section-content">
                <div class="row">
                    <div class="col-md-12">
                        <?php foreach ($data['latest_news'] as $news) : ?>
                            <div class="col-md-6 col-lg-4">
                                <?php echo $this->fetch('public/components/news.php', ['news' => $news]); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php echo $this->fetch('public/components/section-referral.php'); ?>
</div>