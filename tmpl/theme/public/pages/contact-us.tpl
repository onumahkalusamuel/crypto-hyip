{extends file="theme/public/layout.tpl"}
{block name=title}Contact Us{/block}
{block name=body}
    <section class="page-title-area bg_cover hide-overflow" style="background-image: url(assets/images/page-title-bg.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-title-content text-center">
                        <h3 class="title">Contact Us</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{$route->urlFor('home')}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="what-we-do-area bg_cover pb-120 hide-overflow"
        style="background-image: url(assets/images/what-we-do-bg.jpg);">
        <div class="container">
            <h4>Get In Touch</h4>
            <p>If you need advice or have any question in mind or technical assistance, do not hesitate to contact our
                specialists.</p>
            <p><strong>Email Address:</strong> {$siteInfo.email}</p>
            <p>&nbsp;</p>
            <p><strong>Address:</strong> {$siteInfo.address}</p>
        </div>
    </section>

{/block}