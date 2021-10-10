{extends file="theme/public/layout.tpl"}
{block name=title}About Us{/block}
{block name=body}
    <section class="page-title-area bg_cover hide-overflow" style="background-image: url(assets/images/page-title-bg.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-title-content text-center">
                        <h3 class="title">About Us</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{$route->urlFor('home')}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">About Us</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="about-area mb-10 pt-120 hide-overflow">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-9">
                    <div class="about-content">
                        <h3 class="title">Making Investments Easier</h3>
                        <p>The company opened its doors to the public as a cryptocurrency investment company, offering one
                            of the most comprehensive opportunities for Bitcoin enthusiasts to invest in the future of the
                            world&rsquo;s most famous cryptocurrency. Whether you are looking to invest in bitcoin stock or
                            want to invest in bitcoin mining, feel free to contact us. Otb Capital Limited offers a highly
                            profitable investment for everyone. Years of trading experience in the crypto-currency markets
                            provide a stable income not only for the company but also for numerous clients around the world.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bussiness-area bg_cover d-flex align-items-center hide-overflow"
        style="background-image: url(assets/images/bussiness-bg.jpg);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="bussiness-content text-center">
                        <h3 class="title">&ldquo;Bitcoin has the potential to radically transform our concepts of money,
                            store of value, and the means by which assets are exchanged the world over.&rdquo;</h3>
                        <a class="main-btn" href="{$route->urlFor('page', ['page' => 'register'])}">Get Started</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
{/block}