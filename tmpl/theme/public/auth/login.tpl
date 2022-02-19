<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <base href="{$basePath}/" />
    <!-- Bootstrap-->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

</head>

<body style="padding: 20px;">
    <div
        style="max-width: 480px; margin: auto; width: 100%; padding: 15px;border-radius: 10px; box-shadow: 0px 0px 15px #555;">
        <div style="">
            <h4 style="margin:20px 0px; border-bottom: 3px solid #333; padding-bottom: 10px; text-transform: uppercase; font-weight: bold;"
                class="text-right">Admin Login</h4>
            <div class="w-100" style="">
                <div class="">
                    <form id="login" action="{$route->urlFor('login-action')}" method="POST"
                        onsubmit="return ajaxPost('login')">
                        <div class="form-group">
                            <div class="form-label-group">
                                <label class="form-label" for="user-email">Email<span class="text-danger">
                                        &nbsp;*</span></label>
                            </div>
                            <div class="form-control-wrap">
                                <input name="email" type="text" class="form-control form-control-lg" id="user-email"
                                    autofocus="autofocus" placeholder="username or email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-label-group">
                                <label class="form-label" for="password">Password<span class="text-danger">
                                        &nbsp;*</span></label>
                            </div>
                            <div class="form-control-wrap">
                                <input name="password" type="password" class="form-control form-control-lg"
                                    id="password" autofocus="autofocus" placeholder="password" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-lg btn-primary btn-block">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="assets/js/script.js"></script>
</body>

</html>