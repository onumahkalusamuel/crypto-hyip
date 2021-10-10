{extends file="theme/public/auth/layout.tpl"}
{block name=title}Login{/block}
{block name=body}
    <div class="card card-bordered">
        <div class="card-inner card-inner-lg">
            <div class="nk-block-head">
                <div class="nk-block-head-content">
                    <h4 class="nk-block-title">Login into Account</h4>
                    <div class="nk-block-des mt-2">
                        <p>Sign in into your account using your email and passcode.</p>
                    </div>
                </div>
            </div>

            {include file="theme/public/components/flash-bag.tpl"}

            <form action="{$route->urlFor('login')}" autocomplete="off" method="POST" id="loginForm"
                class="form-validate is-alter">
                <div class="form-group">
                    <div class="form-label-group">
                        <label class="form-label" for="username">Username / Email<span class="text-danger">*</span></label>
                    </div>
                    <div class="form-control-wrap">
                        <input name="email" type="text" class="form-control form-control-lg" id="username"
                            placeholder="Enter your Username or Email" autocomplete="off" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <label class="form-label" for="passcode">Password<span class="text-danger">*</span></label>
                    </div>
                    <div class="form-control-wrap">
                        <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch" data-target="passcode">
                            <em class="passcode-icon icon-show icon ni ni-eye-off"></em>
                            <em class="passcode-icon icon-hide icon ni ni-eye"></em>
                        </a>
                        <input name="password" autocomplete="new-password" type="password"
                            class="form-control form-control-lg" id="passcode" placeholder="Enter your password" required>
                    </div>
                    <div class="form-control-group d-flex justify-between mt-2 mb-gs">
                        <div class="form-control-wrap">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="remember" id="remember-me">
                                <label class="custom-control-label text-soft" for="remember-me">Remember Me</label>
                            </div>
                        </div>
                        <div class="form-control-link">
                            <a tabindex="5" class="link link-primary" href="{$route->urlFor('reset-password')}">Forgot
                                Code?</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-lg btn-primary btn-block">Login</button>
                    </div>
                </div>
            </form>
            <div class="form-note-s2 text-center pt-4">New on our platform?
                <a href="{$route->urlFor('register')}"><strong>Create an account</strong></a>
            </div>
        </div>
    </div>
{/block}