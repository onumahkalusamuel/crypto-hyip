<div class="col-xs-12 col-sm-12 col-md-4 price-table {if $plan->hasBadge}pricing-active{/if} wow fadeInUp"
    data-wow-delay="{$key}00ms">
    <div class="pricing-panel">
        <div class="pricing--heading text--center">
            <div class="pricing--icon">
                {if $plan->hasBadge}
                    <img src="assets/images/icons/BitcoinIcon5.png" alt="Bitcoin Icon">
                {else}
                    <img src="assets/images/icons/BitcoinIcon4.png" alt="Bitcoin Icon">
                {/if}
            </div>
            <h4>{$plan->title}</h4>
            <p>{$plan->percentage}<span class="currency">%</span></p>
            <div class="pricing--desc">
                Enjoy your investment with Bitcoin, Ethereum, Litecoin or Dogecoin growing every day.
            </div>
            <a class="btn {if $plan->hasBadge}btn--white{else}btn--secondary{/if} btn--bordered btn--rounded"
                href="{$route->urlFor('page',['page'=>'login'])}">Invest Now</a>
            <div class="pricing--footer" style="margin-top:30px">
                <ul class="{if $plan->hasBadge}white{/if}">
                    <li style="font-size: 1.3em;">
                        ${$plan->minimum} - {if empty($plan->maximum)}above{else}${$plan->maximum}{/if}
                    </li>
                    <li>
                        {$plan->duration} {$plan->durationType|capitalize}{if $plan->duration gt '1'}s{/if} Duration
                    </li>
                    <li>
                        {$plan->percentage}%
                        {if $plan->profitFrequency eq 'end'}
                            ROI at End of Plan
                        {else}
                            {$plan->profitFrequency|capitalize} ROI
                        {/if}
                    </li>
                    <li>
                        {$plan->referralPercentage}% Referral Commission
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>