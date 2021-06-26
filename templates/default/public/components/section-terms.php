<!-- Section: Pricing -->
<section id="pricing">
    <div class="container pb-40 pb-sm-20">
        <div class="section-title text-center">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h2 class="text-uppercase title">Terms <span class="text-theme-colored2">Of Use</span></h2>
                    <div class="line-bottom-double-line-centered"></div>
                    <p>By using our site, you agree to our Terms of Use as is on this page. These terms are also subject to change.</p>
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