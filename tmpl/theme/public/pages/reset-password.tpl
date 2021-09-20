{include file="theme/public/header.tpl" pageTitle="Reset Password"}

<section id="page-title" class="page-title bg-overlay bg-overlay-dark bg-parallax">
    <div class="bg-section">
        <img src="assets/images/page-titles/18.jpg" alt="Background" />
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="title title-6 text-center">
                    <div class="title--heading">
                        <h1>Reset Password</h1>
                    </div>
                    <div class="clearfix"></div>
                    <ol class="breadcrumb">
                        <li><a href="{$route->urlFor('home')}">Home</a></li>
                        <li class="active">Reset Password</li>
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
                    <h2 class="heading--title">Reset Account Password</h2>
                    <div class="divider--line divider--center"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3">
                <div class="contact-form">
                    <form id="form" class="mb-0" action="{$route->urlFor('page', ['page' => 'reset-password'])}"
                        method="post" onsubmit="return ajaxPost();">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email:"
                                    required>
                            </div>
                            <div class="col-md-12">
                                <input type="submit" value="Send Reset Link" name="submit"
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
            </div>
        </div>
    </div>
</section>

{include file="theme/public/footer.tpl"}