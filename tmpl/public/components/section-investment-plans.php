<?php if (!empty($investment_plans)) : ?>
        <!-- Section: Pricing -->
        <section id="pricing">
            <div class="container pb-40 pb-sm-20">
                <div class="section-title text-center">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <h2 class="text-uppercase title">Investment <span class="text-theme-colored2">Plans</span></h2>
                            <div class="line-bottom-double-line-centered"></div>
                            <p>It is now easy for anyone to get onboard. Our wide range of investment plans are tailored to make you maximum profits.</p>
                        </div>
                    </div>
                </div>
                <div class="section-content">
                    <div class="row" style="display: flex;flex-wrap:wrap;justify-content: center;">
                        <?php foreach ($investment_plans as $plan) : ?>
                            <?php echo $this->fetch('public/components/plan.php', ['plan' => $plan]); ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>