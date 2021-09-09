<?php $this->addAttribute('pageTitle', 'Terms'); ?>
<?php $this->setLayout('public/layout.php'); ?>

<div class="main-content">

    <?php echo $this->fetch('public/components/page-inner-header.php'); ?>

    <?php echo $this->fetch('public/components/section-terms.php'); ?>
    
    <?php echo $this->fetch('public/components/section-referral.php'); ?>

</div>