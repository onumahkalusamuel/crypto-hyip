<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    {if !isset($pageTitle) }
        {assign var="pageTitle" value="Welcome"}
    {/if}
    <base href="{$basePath}/" />
    <!-- Meta Tags -->
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <!-- Page Title -->
    <title>{$pageTitle} - {$siteInfo.name}</title>

    <!-- Favicon and Touch Icons -->
    <link href="ch-logo.png" rel="shortcut icon" type="image/png">

    <!--Stylesheet-->
    <link rel="stylesheet" href="adminstyle.css" type="text/css" />

    <style type="text/css">
        :root {
            --primary-color: #555;
            --secondary-color: blue;
            --dark-color: #333;
            --background-color: #FFFFF2;
            --info-background-color: #FFFFEE;
            --info-border-color: yellow;
            --info-text-color: #333300;
        }

        body {
            font-size: 0.9em;
            font-family: Arial;
        }

        .header,
        .footer {
            background-color: #f2f2f2;
            border: 1px solid var(--dark-color);
        }

        .header {
            border-bottom: none;
        }

        .footer {
            border-top: none;
        }

        .body {
            background-color: #fff;
            border-color: var(--primary-color);
            border-width: 1px;
            border-style: solid;
        }

        td {
            vertical-align: top;
        }

        nav div.menu-title {
            background-color: var(--primary-color);
            padding: 5px 0px;
            text-align: center;
            color: #fff;
            font-weight: bold
        }

        nav a {
            padding-top: 3px;
            padding-bottom: 3px;
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

        nav a:hover,
        nav a:active {
            background-color: var(--primary-color);
            color: #fff;
        }

        span.nav-divider {
            display: inline-block;
            height: 10px;
            width: 100%;
        }
    </style>
</head>

<body class="">
    <center>
        <table width="760" class="header" height="100">
            <tr>
                <td align="center">
                    <a class="link" href="{$route->urlFor('admin-dashboard')}">
                        <img src="ch-logo.png" alt="" style="height:50px;">
                        <h2>Admin Dashboard</h2>
                    </a>
                </td>
            </tr>
        </table>
        <table width="760" class="body">
            <tr>
                <td width="160" style="border-right:1px solid var(--primary-color)">
                    {include file='admin/navigation.tpl'}</td>
                <td>
{include file='admin/components/flash-bag.tpl'}