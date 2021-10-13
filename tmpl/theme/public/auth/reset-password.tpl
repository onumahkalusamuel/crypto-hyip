{extends file="theme/public/layout.tpl"}
{block name=title}Reset Password{/block}
{block name=body}
    <div class="banner-area" id="banner-area" style="background-image:url(assets/images/banner/banner5.jpg);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col">
                    <div class="banner-heading">
                        <h1 class="banner-title">Reset Password</h1>
                        <ol class="breadcrumb">
                            <li><a href="{$route->urlFor('home')}">Home</a></li>
                            <li>Reset Password</li>
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
    <div class="card card-bordered container col-md-6 col-lg-4 my-5">
        <div class="card-inner card-inner-lg mb-5">
            <div class="nk-block-head">
                <div class="nk-block-head-content">
                    <h4 class="nk-block-title mt-5">Reset Password</h4>
                    <div class="nk-block-des mt-2">
                        <p>If you forgot your password, well, then we’ll email you instructions to reset your password.</p>
                    </div>
                </div>
            </div>

            {include file="theme/public/components/flash-bag.tpl"}

            <form id="reset-password" action="{$route->urlFor('reset-password')}" method="POST" id="forgotPassword"
                class="form-validate is-alter mb-5" onsubmit="return ajaxPost('reset-password');">
                <div class="form-group">
                    <div class="form-label-group">
                        <label class="form-label" for="user-email">Email<span class="text-danger"> &nbsp;*</span></label>
                    </div>
                    <div class="form-control-wrap">
                        <input name="email" type="text" class="form-control form-control-lg" id="user-email"
                            placeholder="Enter your email address" required>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-lg btn-primary btn-block">Send Reset Link
                    </button>
                </div>
            </form>
            <div class="form-note-s2 text-center">
                <a href="{{$route->urlFor('login')}}"><strong>Return to login</strong></a>
            </div>
        </div>
    </div>
{/block}