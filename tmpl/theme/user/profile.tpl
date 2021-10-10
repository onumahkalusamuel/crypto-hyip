{assign var="active" value="profile"}
{extends file="theme/user/layout.tpl"}
{block name=title}Profile{/block}

{block name="body"}
    <div class="nk-block">
        <div class="mb-5">
            <h4>User Profile</h4>
            <form id="profile" class="container p-0" action="{$route->urlFor('user-profile')}" method="post">
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
                                    if you want to change password.</em></small>
                        </div>
                    </div>
                    <div class="item">
                        <div class="title">Confirm New Password:</div>
                        <div class="content">
                            <input class="form-control" type="text" name="confirmPassword" />
                            <small><em>Only fill new password if you want to change password.</em></small>
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
{/block}