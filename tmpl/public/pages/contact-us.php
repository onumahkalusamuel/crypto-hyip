<?php $this->addAttribute('pageTitle', 'Contact Us'); ?>
<?php $this->setLayout('public/layout.php'); ?>

<div class="main-content">

    <?php echo $this->fetch('public/components/page-inner-header.php');?>
    
    <?php echo $this->fetch('public/components/section-contact-us.php'); ?>
    <!-- Divider: Google Map -->
    <section>
        <?php echo $this->fetch('public/components/google-map-widget.php'); ?>
    </section>

</div>