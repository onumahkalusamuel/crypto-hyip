<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    {if !isset($pageTitle) }
        {assign var="pageTitle" value="Welcome"}
    {/if}
    <base href="{$basePath}/" />
    <!-- Meta Tags -->
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta name="description" content="{$pageTitle} - {$siteSettings.site_name}" />
    <meta name="keywords" content="cryptocurrency,bitcoin,finance,investment,referral,affiliate,news,insurance,agency" />
    <meta name="author" content="{$siteSettings.site_name}" />

    <!-- Page Title -->
    <title>{$pageTitle} - {$siteSettings.site_name}</title>

    <!-- Favicon and Touch Icons -->
    <link href="assets/images/favicon.png" rel="shortcut icon" type="image/png">

    <!-- Import the chat providers here -->
    {include file="theme/crisp.tpl"}
    {include file="theme/tawkto.tpl"}
</head>

<body class="">
        <!-- Header -->
        <header id="header" class="">
            <div class="">
                <div class="">
                    <div class="">
                        <nav>
                            <a class="" href="{$route->urlFor('home')}">
                                <img src="theme/assets/logo.png" alt="logo">
                            </a>
                            {include file="theme/public/navigation.tpl"}
                        </nav>
                    </div>
                </div>
            </div>
        </header>
