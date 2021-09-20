{getInvestmentPlans out=investment_plans}
{if !empty($investment_plans)}
    <style>
        .pricing--footer ul {
            list-style: none;
            padding: 0;
            color: #555;
        }

        .pricing--footer ul.white {
            color: #fff;
        }

        .pricing--footer ul li {
            padding: 15px 0px;
            border-bottom: 1px solid #ccc;
        }

        .pricing--footer ul.white li {
            border-bottom: 1px solid #eee;
        }

        .pricing--footer ul li:last-child {
            border-bottom: none;
        }
    </style>
    <!-- Section: Pricing -->
    <section id="pricing1" class="pricing pricing-1 bg-gray pb-90">
        <div class="container">
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3">
                    <div class="heading heading-1 text--center mb-70">
                        <p class="heading--subtitle">Invest Now!</p>
                        <h2 class="heading--title">Our Investment Plans</h2>
                        <p class="heading--desc mb-0">Invest now with us to earn every day and forever in your wallet. We
                            accept Investment from all over the world.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                {foreach from=$investment_plans item=$investment_plan key=$key}
                    {include file="theme/public/components/plan.tpl" plan=$investment_plan key=($key+1)}
                {/foreach}
            </div>
        </div>
    </section>
{/if}