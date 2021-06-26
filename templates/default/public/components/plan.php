 <div class="col-xs-12 col-sm-6 col-md-3 hvr-float-shadow mb-sm-30">
     <div class="pricing-table style2 bg-white border-1px text-center">
         <div class="pt-0 pb-40">
             <div class="bg-theme-colored position-relative overflow-hidden pt-15 pb-20">
                 <h2 class="package-type text-uppercase line-bottom-centered text-white font-24 mb-0"><?= $plan->title; ?></h2>
                 <div class="package-icon"><i class="fa fa-cubes"></i></div>
                 <?php if (!empty($plan->hasBadge)) : ?>
                     <div class="pricing-ribbon">
                         <h5>featured</h5>
                     </div>
                 <?php endif; ?>
             </div>
             <h1 class="price font-25 font-weight-600 text-theme-colored bg-white line-height-1 font-opensans m-0 pt-15 pb-15">
                 <span class="font-15 text-theme-colored font-raleway font-weight-600 currency">$</span><?= number_format($plan->minimum ?? 1); ?>
                 -
                 <span class="font-15 text-theme-colored font-raleway font-weight-600 currency"><?= !empty($plan->maximum) ? '$' : null; ?></span><?= empty($plan->maximum) ? 'above' : number_format($plan->maximum); ?>
             </h1>
             <ul class="table-list pt-0 pl-0">
                 <!-- Duration -->
                 <li>
                     <?= $plan->duration . ' ' .
                            ucwords($plan->durationType) .
                            ($plan->durationType > 1 ? 's' : ''); ?> Duration</li>
                 <!-- Profit Frequency -->
                 <li><strong><?= $plan->percentage . '% ' .
                            ($plan->profitFrequency === 'end'
                                ? " ROI at End of Plan"
                                : ucwords($plan->profitFrequency) . ' ROI'); ?></strong></li>
                 <li><?= $plan->referralPercentage; ?>% Referral Commission</li>
                 <?php foreach ($plan->features as $feature) : ?>
                     <li><?= $feature; ?></li>
                 <?php endforeach; ?>
             </ul>
             <a class="btn btn-lg btn-theme-colored text-uppercase btn-block pt-20 pb-20 btn-flat" href="<?= $route->urlFor('page', ['page' => 'register']); ?>">Register</a>
         </div>
     </div>
 </div>

 <?php

    ['Min Deposit: $20','Max Deposit: $999','Profit (%) 15.00%','Min Withdrawal: $23','Investment Method: Bitcoin',"<strong style='color:green'>Instant Withdrawal</strong>","<strong>No withdrawal charges</strong>","<strong style='color:green'>No hidden fees</strong>","<strong>Deposits reflect immediately</strong>","<strong style='color:green'>Principal back on maturity</strong>","<strong>24/7 Customer Support</strong>"];
