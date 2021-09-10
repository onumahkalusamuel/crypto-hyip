<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    {if !isset($pageTitle) }
    {assign var="pageTitle" value="Welcome"}
    {/if}
    <base href="{$basePath}/" />
    <!-- Meta Tags -->
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <!-- Page Title -->
    <title>{$pageTitle} - {$siteSettings['site_name']}</title>

    <!-- Favicon and Touch Icons -->
    <link href="assets/images/favicon.png" rel="shortcut icon" type="image/png">
    <link rel="apple-touch-icon" href="assets/images/apple-touch-icon-iphone-60x60.png">
    <link rel="apple-touch-icon" sizes="60x60" href="assets/images/apple-touch-icon-ipad-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="assets/images/apple-touch-icon-iphone-retina-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="assets/images/apple-touch-icon-ipad-retina-152x152.png">

    <!--Stylesheet-->
    <link rel="stylesheet" href="adminstyle.css" type="text/css"/>

    <style type="text/css">
        :root {
            --primary-color: #FF8D00;
            --secondary-color: blue;
            --background-color: #FFFFF2;
            --info-background-color: #FFFFEE;
            --info-border-color: yellow;
            --info-text-color:#333300;
        }
        body {
            font-size: 0.9em;
            font-family: Arial;
            background-color: var(--background-color);
        }
        .header {
            background-color: var(--primary-color)
        }
        .body{
            background-color:#fff;
            border-color: var(--primary-color);
            border-width: 1px;
            border-style:solid;
        }
        td {
            vertical-align: top;
        }

        nav div.menu-title {
            background-color: var(--primary-color);
            padding: 5px 0px;
            text-align:center;
            color: #fff;
            font-weight: bold
        }

        nav a {
            padding-top: 5px;
            padding-bottom: 5px;
            display: inline-block;
            border-bottom: 1px dotted var(--primary-color);
            width: 100%;
            padding-left: 10px;
            box-sizing: border-box;
            text-decoration: none;
            color: #333;
        }

        nav a.first {
            border-top: 1px dotted var(--primary-color);
        }

        nav a:hover, nav a:active {
            background-color:var(--primary-color);
        }
        span.nav-divider {
            display:inline-block;
            height:20px;
            width:100%;
        }
    </style>

</head>

<body class="">
<center>
<table width="760" class="header" height="100">
    <tr>
        <td>
            <a class="" href="{$route->urlFor('admin-dashboard')}">
                <img src="assets/images/logo-wide.png" alt="" style="max-width:300px;">
            </a>
        </td>
    </tr>
</table>
<table width="760" class="body">
    <tr>
        <td width="160" style="border-right:1px solid orange">{include file='admin/navigation.tpl'}</td>
        <td>
	    {include file='admin/components/flash-bag.tpl'}
