<html dir="ltr" lang="en">

<head>
    <base href="{$basePath}/" />
    <!-- Meta Tags -->
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">

    <!-- Page Title -->
    <title>Internal Server Error - {$siteSettings.site_name}</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
            display: table;
            width: 100%;
            padding: 0;
            margin: 0%;
            height: 100vh;
            color: #555;
            padding-left: 5px;
            padding-right: 5px;
            box-sizing: border-box;
        }

        div.container {
            display: table-cell;
            vertical-align: middle;
        }

        h1 {
            font-size: 6em;
            font-weight: lighter;
            margin-bottom: 0;
        }

        h2 {
            margin-bottom: 0;
            font-weight: lighter;
        }

        p {
            margin-top: 1em;
            margin-bottom: 2em;
            font-size: 0.95em;
        }

        a.button {
            text-decoration: none;
            color: #555;
            border: 1px solid #555;
            padding: 10px 15px;
            display: inline-block;
            box-sizing: border-box;
        }

        a.button-alt {
            text-decoration: none;
            color: #fff;
            background-color: #555;
            border: 1px solid #555;
            padding: 10px 15px;
            display: inline-block;
            box-sizing: border-box;
        }
    </style>

</head>

<body>
    <div class="container">
        <h1 class="">5.oh.oh</h1>
        <h2 class="">Oops! An Error Occured.</h2>
        <p>Unable to process your request at the moment.</p>
        <a class="button" href="{$route->urlFor('home')}">Return Home</a>
        <a class="button-alt"
            href="mailto:admin@{$smarty.server.HTTP_HOST}?{'subject=An Error Occured. Page -> '|escape}{$smarty.server.HTTP_HOST|escape}{$smarty.server.REQUEST_URI}">Contact
            Support</a>
        {if $message ne ''}
            <div style="max-width:500px; padding:10px; margin:auto">
            {$message}
            </div>
        {/if}
    </div>
</body>

</html>