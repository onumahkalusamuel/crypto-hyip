{extends file="theme/public/layout.tpl"}
{block name=title}Contact Us{/block}
{block name=body}

    <div class="banner-area" id="banner-area" style="background-image:url(assets/images/banner/banner5.jpg);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col">
                    <div class="banner-heading">
                        <h1 class="banner-title">Contact Us</h1>
                        <ol class="breadcrumb">
                            <li><a href="{$route->urlFor('home')}">Home</a></li>
                            <li>Contact Us</li>
                        </ol>
                    </div>
                </div>
                <!-- Col end-->
            </div>
            <!-- Row end-->
        </div>
        <!-- Container end-->
    </div>
    <!-- Banner area end-->


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