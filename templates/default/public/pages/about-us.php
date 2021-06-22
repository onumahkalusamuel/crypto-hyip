<?php $this->addAttribute('pageTitle', 'About Us'); ?>
<?php $this->setLayout('public/layout.php'); ?>

<div class="main-content">

    <?php echo $this->fetch('public/components/page-inner-header.php'); ?>
    <div class="mt-30 mt-sm-10">
        <?php echo $this->fetch('public/components/section-about.php'); ?>
    </div>

    <?php echo $this->fetch('public/components/section-services.php'); ?>

    <?php echo $this->fetch('public/components/section-referral.php'); ?>

</div>