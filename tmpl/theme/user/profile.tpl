{assign var="active" value="profile"}
{extends file="theme/user/layout.tpl"}
{block name=title}Profile{/block}
{block name="body"}
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Profile</h3>
                    </div>
                </div>
            </div>
            <div class="container">
                {include file="theme/public/components/flash-bag.tpl"}
            </div>
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Update profile</h4>
                        <p class="card-description">
                            Make changes to your profile using the form below.
                        </p>
                        <form id="profile" action="{$route->urlFor('user-profile')}" method="post">
                            <div class="form-group">
                                <label for="userName">Username</label>
                                <input id="userName" class="form-control" readonly disabled
                                    value="{$data.profile->userName}" />
                            </div>
                            <div class="form-group">
                                <label for="fullName">Full Name</label>
                                <input id="fullName" name="fullName" value="{$data.profile->fullName}"
                                    class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" name="email" value="{$data.profile->email}"
                                    class="form-control" />
                            </div>
                            {foreach $data.activeCurrencies as $currency}
                                <div class="form-group">
                                    <label for="{$currency}">{$currency|upper} Address</label>
                                    {assign var=address value=$currency|cat:"Address"}
                                    <input id="{$currency}" class="form-control" name="{$address}"
                                        value="{$data.profile->$address}" />
                                </div>
                            {/foreach}
                            <div class="form-group">
                                <label for="email">New Password</label>
                                <input class="form-control" type="text" name="password" />
                                <small>
                                    <em>Only fill new password if you want to change password.</em>
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="email">Confirm New Password</label>
                                <input class="form-control" type="text" name="confirmPassword" />
                                <small>
                                    <em>Only fill new password if you want to change password.</em>
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="email">Old Password</label>
                                <input class="form-control" type="password" name="oldPassword" required />
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Update Profile</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
{/block}