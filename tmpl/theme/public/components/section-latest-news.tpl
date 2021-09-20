{getNews out=latest_news count=3}
{if (!empty($latest_news))}
    <!-- Section: latest news -->

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
            <div class="row">
                {foreach from=$latest_news item=news key=key}
                    {include file="theme/public/components/news.tpl" news=$news key=$key}
                {/foreach}
            </div>

        </div>

    </section>

{/if}