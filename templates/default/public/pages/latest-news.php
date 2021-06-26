<?php $this->addAttribute('pageTitle', 'Latest News'); ?>
<?php $this->setLayout('public/layout.php'); ?>

<div class="main-content">

    <?php echo $this->fetch('public/components/page-inner-header.php'); ?>

    <?php echo $this->fetch(
        'public/components/section-latest-news.php',
        ['latest_news' => $data['latest_news']]
    ); ?>

    <?php echo $this->fetch('public/components/section-referral.php'); ?>
</div>