{extends file="theme/public/layout.tpl"}
{block name=title}Login{/block}
{block name=body}

    <div class="banner-area" id="banner-area" style="background-image:url(assets/images/banner/banner5.jpg);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col">
                    <div class="banner-heading">
                        <h1 class="banner-title">Login</h1>
                        <ol class="breadcrumb">
                            <li><a href="{$route->urlFor('home')}">Home</a></li>
                            <li>Login</li>
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

    {include file="theme/public/components/flash-bag.tpl"}

    <!-- Banner area end-->
    <div class="card card-bordered container col-md-6 col-lg-4 my-5">
        <div class="card-inner card-inner-lg mb-5">
            <div class="nk-block-head">
                <div class="nk-block-head-content">
                    <h4 class="nk-block-title mt-5">Login</h4>
                    <div class="nk-block-des mt-2">
                        <p>Enter your login details to access your account.</p>
                    </div>
                </div>
            </div>

            {include file="theme/public/components/flash-bag.tpl"}

            <form action="{$route->urlFor('login')}" method="POST" class="form-validate is-alter mb-5">
                <div class="form-group">
                    <div class="form-label-group">
                        <label class="form-label" for="user-email">Email<span class="text-danger"> &nbsp;*</span></label>
                    </div>
                    <div class="form-control-wrap">
                        <input name="email" type="text" class="form-control form-control-lg" id="user-email"
                            autofocus="autofocus" placeholder="username or email" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <label class="form-label" for="password">Password<span class="text-danger"> &nbsp;*</span></label>
                    </div>
                    <div class="form-control-wrap">
                        <input name="password" type="password" class="form-control form-control-lg" id="password"
                            autofocus="autofocus" placeholder="password" required>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-lg btn-primary btn-block">Login</button>
                </div>
            </form>
            <div class="form-note-s2 text-center">
                {* <a href="{{$route->urlFor('login')}}"><strong>Return to login</strong></a> *}
                Forgot your password?
                <a href="{$route->urlFor('reset-password')}">click here to reset. </a>
                <div>
                    Don't have account?
                <a href="{$route->urlFor('register')}">Signup here</a>
                </div>
            </div>
        </div>
    </div>


{/block}