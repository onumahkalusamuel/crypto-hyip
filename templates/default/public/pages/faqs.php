<?php $this->addAttribute('pageTitle', 'Faqs'); ?>
<?php $this->setLayout('public/layout.php'); ?>

<div class="main-content">

    <?php echo $this->fetch('public/components/page-inner-header.php'); ?>
    <section class="mt-30 mt-sm-10">
        <div class="container">
            <div class="">
                <div id="faqsAccordion" class="panel-group toggle accordion-classic accordion-classic-theme-colored2 accordion-flat">
                    <?php foreach ($siteSettings['faqs'] as $key => $faq) : ?>
                        <?php echo $this->fetch(
                            'public/components/faq.php',
                            ['faq' => $faq, 'key' => $key]
                        ); ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <?php echo $this->fetch('public/components/section-live-table.php'); ?>

</div>