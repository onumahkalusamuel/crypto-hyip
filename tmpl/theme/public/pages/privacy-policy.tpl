{extends file="theme/public/layout.tpl"}
{block name=title}Privacy Policy{/block}
{block name=body}
    <section class="page-title-area bg_cover hide-overflow" style="background-image: url(assets/images/page-title-bg.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-title-content text-center">
                        <h3 class="title">Privacy Policy</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{$route->urlFor('home')}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Privary Policy</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="what-we-do-area bg_cover pb-120 hide-overflow"
        style="background-image: url('assets/images/what-we-do-bg.jpg');">
        <div class="container">
            <h4>Privacy Policy for {$siteInfo.name}.</h4>
            <p>&nbsp;</p>
            <p>At <strong>{$siteInfo.name}</strong>, one of our main priorities is the privacy of our visitors. This Privacy
                Policy document contains types of information that is collected and recorded by
                <strong>{$siteInfo.name}</strong> and how we use it.
            </p>
            <p>If you have additional questions or require more information about our Privacy Policy, do not hesitate to
                contact us through email at {$siteInfo.email}.</p>
        </div>
    </section>

{/block}