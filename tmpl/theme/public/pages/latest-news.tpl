{include file="theme/public/header.tpl" pageTitle="Latest News" active="latest_news"}

{getNews out=latest_news count=24}

<section id="page-title" class="page-title bg-overlay bg-overlay-dark bg-parallax">
    <div class="bg-section">
        <img src="assets/images/page-titles/10.jpg" alt="Background" />
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="title title-6 text-center">
                    <div class="title--heading">
                        <h1>Latest News</h1>
                    </div>
                    <div class="clearfix"></div>
                    <ol class="breadcrumb">
                        <li><a href="{$route->urlFor('home')}">Home</a></li>
                        <li class="active">Latest News</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="blog" class="blog blog-grid pb-60">
    <div class="container">
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3">
                <div class="heading heading-3 mb-50 text--center">
                    <p class="heading--subtitle">Don’t Miss Latest</p>
                    <h2 class="heading--title">News & Headlines</h2>
                    <p class="heading--desc mb-0">Follow our latest news and thoughts which focuses exclusively on
                        investment strategy guide, blockchain tech, crypto-trading and mining.</p>
                </div>
            </div>
        </div>
        {if (!empty($latest_news))}
            <div class="row">
                {foreach from=$latest_news item=news key=key}
                    {include file="theme/public/components/news.tpl" news=$news key=$key}
                {/foreach}
            </div>
        {/if}
    </div>

</section>


{include file="theme/public/footer.tpl"}