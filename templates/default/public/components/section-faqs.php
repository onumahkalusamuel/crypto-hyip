<!-- Section: Pricing -->
<section id="pricing">
    <div class="container pb-40 pb-sm-20">
        <div class="section-title text-center">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h2 class="text-uppercase title">Frequently <span class="text-theme-colored2">Asked Questions</span></h2>
                    <div class="line-bottom-double-line-centered"></div>
                    <p>We know you have questions. We have answered the most frequently asked questions. If you need further assistance, please use any of our contact channels.</p>
                </div>
            </div>
        </div>
        <div class="section-content">
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