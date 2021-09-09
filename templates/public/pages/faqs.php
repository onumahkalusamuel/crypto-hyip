<?php $this->addAttribute('pageTitle', 'Faqs'); ?>
<?php $this->setLayout('public/layout.php'); ?>

<div class="main-content">

    <?php echo $this->fetch('public/components/page-inner-header.php'); ?>

    <?php echo $this->fetch('public/components/section-faqs.php'); ?>
    
    <?php echo $this->fetch('public/components/section-live-table.php'); ?>

</div>