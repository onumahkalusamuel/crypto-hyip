{include file="theme/public/header.tpl" pageTitle="Register" active="register"}

<section id="page-title" class="page-title bg-overlay bg-overlay-dark bg-parallax">
    <div class="bg-section">
        <img src="assets/images/page-titles/18.jpg" alt="Background" />
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="title title-6 text-center">
                    <div class="title--heading">
                        <h1>Register</h1>
                    </div>
                    <div class="clearfix"></div>
                    <ol class="breadcrumb">
                        <li><a href="{$route->urlFor('home')}">Home</a></li>
                        <li class="active">Register</li>
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
                    <h2 class="heading--title">Register for an Account</h2>
                    <div class="divider--line divider--center"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3">
                <div class="contact-form">
                    <form id="register_form" class="mb-0" action="{$route->urlFor('page', ['page' => 'register'])}"
                        method="post" onsubmit="return ajaxPost('register_form');">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="fullName" id="fullName"
                                    placeholder="Full Name:" required>
                            </div>

                            <div class="col-md-12">
                                <input type="text" class="form-control" name="userName" id="userName"
                                    placeholder="Username: (optional)">
                            </div>

                            <div class="col-md-12">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email:"
                                    required>
                            </div>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="password" id="password"
                                    placeholder="Password:" required>
                            </div>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="btcAddress" id="btcAddress"
                                    placeholder="Bitcoin Deposit Address:" required>
                            </div>

                            <div class="col-md-12">
                                <input type="text" class="form-control" name="secretQuestion" id="secretQuestion"
                                    placeholder="Secret Question:" required>
                            </div>

                            <div class="col-md-12">
                                <input type="text" class="form-control" name="secretAnswer" id="secretAnswer"
                                    placeholder="Secret Answer:" required>
                            </div>

                            <div class="col-md-12">
                                <input type="submit" value="Register Now" name="submit"
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
                                        <a href="{$route->urlFor('page', ['page' => 'reset-password'])}"
                                            class="heading-line-bottom m-0">Reset Password
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