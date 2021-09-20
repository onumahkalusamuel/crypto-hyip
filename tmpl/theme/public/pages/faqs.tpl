{include file="theme/public/header.tpl" pageTitle="FAQs" active="faqs"}

<section id="page-title" class="page-title bg-overlay bg-overlay-dark bg-parallax">
    <div class="bg-section">
        <img src="assets/images/page-titles/1.jpg" alt="Background" />
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1">
                <div class="title title-6 text-center">
                    <div class="title--heading">
                        <h1>Frequently Asked Questions</h1>
                    </div>
                    <div class="clearfix"></div>
                    <ol class="breadcrumb">
                        <li><a href="{$route->urlFor('home')}">Home</a></li>
                        <li class="active">FAQs</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>


<section id="faqs" class="bg-white">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12">
                <div class="accordion accordion-1" id="accordion01">
                    {foreach from=$siteSettings.faqs item=faq key=key}
                        <div class="panel">
                            <div class="panel--heading">
                                <a class="accordion-toggle {if $key !== 0}collapsed{/if}" data-toggle="collapse"
                                    data-parent="#accordion01" href="#collapse01-{$key}">{$faq.question}</a>
                            </div>
                            <div id="collapse01-{$key}" class="panel--body panel-collapse collapse {if $key === 0}in{/if}">
                                {$faq.answer}
                            </div>
                        </div>
                    {/foreach}
                </div>

            </div>
        </div>
    </div>
</section>

{include file="theme/public/components/section-clients.tpl"}

{include file="theme/public/footer.tpl"}