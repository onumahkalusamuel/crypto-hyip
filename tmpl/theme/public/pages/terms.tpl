{extends file="theme/public/layout.tpl"}
{block name=title}Terms{/block}
{block name=body}
    <section class="page-title-area bg_cover hide-overflow" style="background-image: url(assets/images/page-title-bg.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-title-content text-center">
                        <h3 class="title">Terms</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{$route->urlFor('home')}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Terms</li>
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
            <h4>Terms and condition</h4>
            <p>&nbsp;</p>
            <p>Welcome to {$siteInfo.name}!</p>
            <p>These terms and conditions outline the rules and regulations for the use of {$siteInfo.name}'s Website.</p>
            <p>By accessing this website we assume you accept these terms and conditions. Do not continue to use
                {$siteInfo.name} if you do not agree to take all of the terms and conditions stated on this page.</p>
            <p>If you have additional questions or require more information, do not hesitate to contact us through email at
            {$siteInfo.email}.</p>
        </div>
    </section>

{/block}