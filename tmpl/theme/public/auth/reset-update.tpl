{extends file="theme/public/auth/layout.tpl"}
{block name=title}Reset Update{/block}
{block name=body}
    <div class="card card-bordered">
        <div class="card-inner card-inner-lg">
            <div class="nk-block-head">
                <div class="nk-block-head-content">
                    <h4 class="nk-block-title">Reset Update</h4>
                </div>
            </div>

            {if $data.message === 'success'}
                {if !empty($data.message)}
                    <div class="alert alert-success text-center text-uppercase" style="font-weight: bolder;">
                        {$data.message}
                    </div>
                {/if}

                {if empty($data.hide_form)}

                    <form method="POST" action="" class="form-validate is-alter">

                        <input type="hidden" name="csrf" value="{$data.csrf}" />

                        <div class="form-group">
                            <div class="form-label-group">
                                <label class="form-label" for="password">New Password<span class="text-danger">
                                        &nbsp;*</span></label>
                            </div>
                            <div class="form-control-wrap">
                                <a href="#" class="form-icon form-icon-right passcode-switch" data-target="password">
                                    <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                    <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                </a>
                                <input type="password" name="newPassword" class="form-control form-control-lg" id="password"
                                    placeholder="Enter your passcode" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-lg btn-primary btn-block">Reset Password</button>
                        </div>
                    </form>
                {/if}
            {else}
                {if !empty($data.message)}
                    <div class="alert alert-danger text-center text-uppercase" style="font-weight: bolder;">
                        {$data.message}
                    </div>
                {/if}
            {/if}
        </div>
    </div>
{/block}

<section id="page-title" class="page-title bg-overlay bg-overlay-dark bg-parallax">
    <div class="bg-section">
        <img src="assets/images/page-titles/18.jpg" alt="Background" />
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="title title-6 text-center">
                    <div class="title--heading">
                        <h1>Update Password</h1>
                    </div>
                    <div class="clearfix"></div>
                    <ol class="breadcrumb">
                        <li><a href="{$route->urlFor('home')}">Home</a></li>
                        <li class="active">Update Password</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="contact1" class="contact contact-1 bg-gray">
    <div class="container">
        <div class="row mb-50">
            <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3">
                <div class="heading heading-3 text--center">
                    <h2 class="heading--title">Update Account Password</h2>
                    <div class="divider--line divider--center"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3">

                {if $data.message === 'success'}
                    {if !empty($data.message)}
                        <div class="alert alert-success text-center text-uppercase" style="font-weight: bolder;">
                            {$data.message}
                        </div>
                    {/if}

                    {if empty($data.hide_form)}
                        <div class="contact-form">
                            <form id="form" class="mb-0" method="post">
                                <input type="hidden" name="csrf" value="{$data.csrf}" />

                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" name="newPassword" id="newPassword"
                                            placeholder="New Password:" required>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="submit" value="Set New Password" name="submit"
                                            class="btn btn--secondary btn--block">
                                    </div>
                                    <div class="col-md-12" style="margin-top:30px; font-weight:bolder; font-size:1.2em">
                                        <div class="form-group" style="display: flex;justify-content: space-between;">
                                            <span>
                                                <a href="{$route->urlFor('page', ['page' => 'login'])}"
                                                    class="heading-line-bottom m-0">Login into Account
                                                </a>
                                            </span>
                                            <span>
                                                <a href="{$route->urlFor('page', ['page' => 'register'])}"
                                                    class="heading-line-bottom m-0">Register a new Account
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    {/if}

                {else}
                    {if !empty($data.message)}
                        <div class="alert alert-danger text-center text-uppercase" style="font-weight: bolder;">
                            {$data.message}
                        </div>
                    {/if}
                {/if}
            </div>
        </div>
    </div>
</section>

{include file="theme/public/footer.tpl"}