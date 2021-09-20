{include file="theme/public/header.tpl" pageTitle="Investment Plans" active="investment_plans"}

<section id="page-title" class="page-title bg-overlay bg-overlay-dark bg-parallax">
    <div class="bg-section">
        <img src="assets/images/page-titles/7.jpg" alt="Background" />
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="title title-6 text-center">
                    <div class="title--heading">
                        <h1>Investment Plans</h1>
                    </div>
                    <div class="clearfix"></div>
                    <ol class="breadcrumb">
                        <li><a href="{$route->urlFor('home')}">Home</a></li>
                        <li class="active">Investment Plans</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

{include file="theme/public/components/section-investment-plans.tpl"}

{include file="theme/public/components/section-clients.tpl"}

{include file="theme/public/footer.tpl"}