<?php $this->addAttribute('pageTitle', 'Investment Plans'); ?>
<?php $this->setLayout('public/layout.php'); ?>

<div class="main-content">

    <?php echo $this->fetch('public/components/page-inner-header.php'); ?>

    <?php echo $this->fetch(
        'public/components/section-investment-plans.php',
        ['investment_plans' => $data['investment_plans']]
    ); ?>

    <?php echo $this->fetch('public/components/section-referral.php'); ?>

    <?php echo $this->fetch('public/components/section-latest-news.php'); ?>
</div>