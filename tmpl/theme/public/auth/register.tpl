{extends file="theme/public/auth/layout.tpl"}
{block name=title}Register{/block}
{block name=body}
    <div class="card card-bordered">
        <div class="card-inner card-inner-lg">
            <div class="nk-block-head">
                <div class="nk-block-head-content">
                    <h4 class="nk-block-title">Create an Account</h4>
                    <div class="nk-block-des mt-2">
                        <p>Sign up with your email and get started with your free account.</p>
                    </div>
                </div>
            </div>

            <form action="{$route->urlFor('register')}" autocomplete="off" method="POST" id="registerForm"
                class="form-validate is-alter" onsubmit="return ajaxPost('registerForm');">
                <div class="form-group">
                    <label class="form-label" for="full-name">Full Name<span class="text-danger">
                            &nbsp;*</span></label>
                    <div class="form-control-wrap">
                        <input type="text" id="full-name" name="fullName" value="" class="form-control form-control-lg"
                            minlength="3" data-msg-minlength="At least 3 chars." required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="username">Username<span class="text-danger">
                            &nbsp;*</span></label>
                    <div class="form-control-wrap">
                        <input type="text" id="username" name="userName" class="form-control form-control-lg"
                            autocomplete="off" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="email-address">Email Address<span class="text-danger">
                            &nbsp;*</span></label>
                    <div class="form-control-wrap">
                        <input type="email" id="email-address" name="email" class="form-control form-control-lg"
                            autocomplete="off" required>
                    </div>
                </div>
                {foreach from=$activeCurrencies item=currency}
                    <div class="form-group">
                        <label class="form-label" for="{$currency}-address"> {$currency|upper} Address<span class="text-default"
                                style="font-size: 12px;"> (optional)</span></label>
                        <div class="form-control-wrap">
                            <input id="{$currency}-address" name="{$currency}Address" class="form-control form-control-lg"
                                autocomplete="off">
                        </div>
                    </div>
                {/foreach}

                <div class="form-group">
                    <label class="form-label" for="passcode">Password<span class="text-danger">
                            &nbsp;*</span></label>
                    <div class="form-control-wrap">
                        <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch" data-target="passcode">
                            <em class="passcode-icon icon-show icon ni ni-eye-off"></em>
                            <em class="passcode-icon icon-hide icon ni ni-eye"></em>
                        </a>
                        <input name="password" id="passcode" type="text" autocomplete="new-password"
                            class="form-control form-control-lg" minlength="6" required>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
                </div>
            </form>
            <div class="form-note-s2 text-center pt-4">
                Already have an account? <a href="{$route->urlFor('login')}"><strong>Sign in instead.</strong></a>
            </div>
        </div>
    </div>

{/block}