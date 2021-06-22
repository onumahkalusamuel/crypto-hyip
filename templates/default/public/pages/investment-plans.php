<?php $this->addAttribute('pageTitle', 'Investment Plans'); ?>
<?php $this->setLayout('public/layout.php'); ?>

<div class="main-content">

    <?php echo $this->fetch('public/components/page-inner-header.php'); ?>

    <!-- Section: Pricing -->
    <section id="pricing" class="mt-30 mt-sm-10">
        <div class="container pb-40 pb-sm-20">
            <div class="section-content">
                <?php $plans = $data['investment_plans'] ?? [[], [], [], []]; ?>
                <div class="row" style="display: flex;flex-wrap:wrap;justify-content: center;">
                    <?php foreach ($plans as $plan) : ?>
                        <?php echo $this->fetch('public/components/plan.php', ['plan' => $plan]); ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <?php echo $this->fetch('public/components/section-referral.php'); ?>

    <?php echo $this->fetch('public/components/section-latest-news.php'); ?>
</div>