{include file="theme/user/header.tpl" pageTitle="Profile" active="profile"}

<section id="page-title" class="page-title bg-overlay bg-overlay-dark bg-parallax">
    <div class="bg-section">
        <img src="assets/images/page-titles/18.jpg" alt="Background" />
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="title title-6 text-center" style="padding:150px 0 50px">
                    <div class="title--heading">
                        <h1 style="font-size:4em">Profile</h1>
                    </div>
                    <div class="clearfix"></div>
                    <ol class="breadcrumb">
                        <li><a href="{$route->urlFor('user-dashboard')}">Dashboard</a></li>
                        <li class="active">Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row mb-60">
            <h3 class="section-title">User Profile</h3>
            <div class="col-12">
                <div class="" style="padding:10px">
                    {include file="theme/public/components/flash-bag.tpl"}
                </div>
            </div>
            <form id="profile" class="container" action="{$route->urlFor('user-profile')}" method="post">
                <div class="content-container">
                    <div class="item">
                        <div class="title">Username:</div>
                        <div class="content"> {$data.profile->userName}</div>
                    </div>
                    <div class="item">
                        <div class="title">Full Name:</div>
                        <div class="content">
                            <input name="fullName" value="{$data.profile->fullName}" class="form-control" />
                        </div>
                    </div>
                    <div class="item">
                        <div class="title">Email:</div>
                        <div class="content">
                            <input name="email" value="{$data.profile->email}" class="form-control" />
                        </div>
                    </div>
                    {foreach $data.activeCurrencies as $currency}
                        <div class="item">
                            <div class="title">{$currency|upper} Address:</div>
                            <div class="content">
                                {assign var=address value=$currency|cat:"Address"}
                                <input class="form-control" name="{$address}" value="{$data.profile->$address}" />
                            </div>
                        </div>
                    {/foreach}
                    <div class="item">
                        <div class="title">New Password:</div>
                        <div class="content">
                            <input class="form-control" type="text" name="password" /><small><em>Only fill new password
                                    if you can change password.</em></small>
                        </div>
                    </div>
                    <div class="item">
                        <div class="title">Confirm New Password:</div>
                        <div class="content">
                            <input class="form-control" type="text" name="confirmPassword" />
                            <small><em>Only fill new password if you can change password.</em></small>
                        </div>
                    </div>
                    <div class="item">
                        <div class="title">Old Password:</div>
                        <div class="content">
                            <input class="form-control" type="password" name="oldPassword" required />
                        </div>
                    </div>
                    <div class="item">
                        <div class="title"></div>
                        <div class="content">
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

{include file="theme/user/footer.tpl"}