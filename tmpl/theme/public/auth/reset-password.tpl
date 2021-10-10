{extends file="theme/public/auth/layout.tpl"}
{block name=title}Reset Password{/block}
{block name=body}
    <div class="card card-bordered">
        <div class="card-inner card-inner-lg">
            <div class="nk-block-head">
                <div class="nk-block-head-content">
                    <h4 class="nk-block-title">{{ __('Reset password') }}</h4>
                    <div class="nk-block-des">
                        <p>{{ __('If you forgot your password, well, then we’ll email you instructions to reset your password.') }}
                        </p>
                    </div>
                </div>
            </div>
            {include file="theme/public/components/flash-bag.tpl"}
            <form action="{$route->urlFor('reset-password')}" method="POST" id="forgotPassword"
                class="form-validate is-alter" onsubmit="return ajaxPost('registerForm');">
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
            <div class="form-note-s2 text-center pt-4">
                <a href="{{$route->urlFor('login')}}"><strong>Return to login</strong></a>
            </div>
        </div>
    </div>
{/block}