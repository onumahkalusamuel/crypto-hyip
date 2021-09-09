<nav>
<div class="menu-title">Menu</div>
<a class="first" href="{$route->urlFor('admin-plans')}">Investment Packages</a>
<a href="{$route->urlFor('admin-plans')}">Expiring Deposits</a>

<span class="nav-divider"></span>

<a class="first" href="{$route->urlFor('admin-users')}">Users</a>
{* <a href="{$route->urlFor('admin-users')}">Accounts Blacklist</a> *}
{* <a href="{$route->urlFor('admin-users')}">Top Referral Earnings</a> *}

<span class="nav-divider"></span>

<a class="first" href="{$route->urlFor('admin-withdrawals')}">Withdrawal Requests</a>
<a href="{$route->urlFor('admin-deposits')}">Pending Deposits</a>
<a href="{$route->urlFor('admin-referrals')}">Referrals</a>

<span class="nav-divider"></span>

<a class="first" href="{$route->urlFor('admin-transactions')}">Transactions</a>
<a href="{$route->urlFor('admin-transactions',[],['logType'=>'deposit'])}">Deposits</a>
<a href="{$route->urlFor('admin-transactions',[],['logType'=>'withdrawal'])}">Withdrawals</a>
<a href="{$route->urlFor('admin-transactions',[],['logType'=>'earning'])}">Earnings</a>
<a href="{$route->urlFor('admin-transactions',[],['logType'=>'referral'])}">Referrals</a>
<a href="{$route->urlFor('admin-transactions',[],['logType'=>'bonus'])}">Bonuses</a>
<a href="{$route->urlFor('admin-transactions',[],['logType'=>'penalty'])}">Penalties</a>

<span class="nav-divider"></span>

<a class="first" href="{$route->urlFor('admin-settings')}">Settings</a>
<a href="{$route->urlFor('admin-settings')}">Auto-Withdrawals Settings</a>
<a href="{$route->urlFor('admin-settings')}">Referral Settings</a>
<a href="{$route->urlFor('admin-settings')}">Email Templates</a>
<a href="{$route->urlFor('admin-settings')}">Links Replacement</a>
<a href="{$route->urlFor('admin-settings')}">Security</a>
<a href="{$route->urlFor('admin-settings')}">Earning Holidays</a>
<a href="{$route->urlFor('admin-settings')}">Info Box Settings</a>

<span class="nav-divider"></span>

<a class="first" href="#">IPs Check</a>
<a href="#">Send a Newsletter</a>
<a href="#">Custom Pages</a>
<a href="#">News</a>
<a href="#">User Notices</a>
<a href="#">Maintenance Page</a>
<a href="#">Tell A Friend</a>

<span class="nav-divider"></span>

<a class="first" href="{$route->urlFor('logout')}" onclick="return logoutUser()">Logout</a>

</nav>


