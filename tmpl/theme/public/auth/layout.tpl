<!DOCTYPE html>
<html lang="en" class="js">

<head>
    <meta charset="utf-8">
    <base href="{$basePath}/" />
    <meta name="author" content="Crypto HYIP Pro">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{block name=description}{$siteInfo.description}{/block}">
    <meta name="keywords" content="{block name=keywords}{$siteInfo.keywords}{/block}">
    <title>{block name=title}Welcome{/block} | {$siteInfo.name}</title>

    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link rel="stylesheet" href="assets/css/apps.css">
    {if $sysSettings.googleTrackId}
        <script async src="https://www.googletagmanager.com/gtag/js?id={$sysSettings.googleTrackId}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
                } gtag('js', new Date()); gtag('config', "{$sysSettings.googleTrackId}");
        </script>
    {/if}
    {if $sysSettings.headerCode ne ""}
        {$sysSettings.headerCode}
    {/if}
</head>

<body class="nk-body npc-cryptlite pg-auth is-dark">
    <div class="nk-app-root">
        <div class="nk-wrap">
            <div class="nk-block nk-block-middle nk-auth-body wide-xs">

                <div class="brand-logo text-center mb-2 pb-4">
                    <a class="logo-link" href="{$route->urlFor('home')}">
                        <img class="logo-img logo-light logo-img-lg" src="assets/images/logo-light.png"
                            alt="{$siteInfo.name}">
                    </a>
                </div>

                {block name=body}{/block}

            </div>

            <div class="nk-footer nk-auth-footer-full">
                <div class="container wide-lg">
                    <div class="row g-3">
                        <div class="col-lg-6 order-lg-last">
                            <ul class="nav nav-sm justify-content-center justify-content-lg-end">

                                <li class="nav-item">
                                    <a class="nav-link" href="{$route->urlFor('page',['page' => 'faqs'])}">FAQs</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{$route->urlFor('page',['page' => 'terms'])}">Terms
                                        and
                                        Condition</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{$route->urlFor('page',['page' => 'privacy-policy'])}">Privacy
                                        Policy</a>
                                </li>

                            </ul>

                        </div>
                        <div class="col-lg-6">
                            <div class="nk-block-content text-center text-lg-left">
                                <p class="text-soft">{$siteInfo.name} &copy; {"Y"|@date}. All Rights Reserved.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/script.js"></script>
    <script src="assets/js/bundle.js"></script>
    <script src="assets/js/app.js"></script>
    {if $sysSettings.footerCode ne ""}
        {$sysSettings.footerCode}
    {/if}
</body>

</html>