<html dir="ltr" lang="en">

<head>
    <base href="{$basePath}/" />
    <!-- Meta Tags -->
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">

    <!-- Page Title -->
    <title>Not Found - {$siteInfo.name}</title>
    <style>
    body {
        font-family: Arial, Helvetica, sans-serif;
        text-align: center;
        display: table;
        width: 100%;
        padding: 0;
        margin:0%;
        height: 100vh;
        color: #333;
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
        color: #333;
        border: 1px solid #333;
        padding: 10px 15px;
        display: inline-block;
        box-sizing: border-box;
    }
    </style>

</head>

<body>
    <div class="container">
        <h1 class="">4.oh.4</h1>
        <h2 class="">Oops! Page Not Found.</h2>
        <p>The page you were looking for could not be found.</p>
        <a class="button" href="{$route->urlFor('home')}">Return Home
        </a>
    </div>
</body>

</html>