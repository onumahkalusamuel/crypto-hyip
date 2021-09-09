<?php
/* Smarty version 3.1.39, created on 2021-09-09 11:19:05
  from '/home/ssa/arena/crypto-hyip/tmpl/admin/navigation.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6139df9953e950_68072891',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e32c0bbd8144cb0628345ca8e8399d8b4f1ab6fa' => 
    array (
      0 => '/home/ssa/arena/crypto-hyip/tmpl/admin/navigation.tpl',
      1 => 1631182693,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6139df9953e950_68072891 (Smarty_Internal_Template $_smarty_tpl) {
?><nav>
<div class="menu-title">Menu</div>
<a class="first" href="<?php echo $_smarty_tpl->tpl_vars['route']->value->urlFor('admin-plans');?>
">Investment Packages</a>
<a href="<?php echo $_smarty_tpl->tpl_vars['route']->value->urlFor('admin-plans');?>
">Expiring Deposits</a>

<span class="nav-divider"></span>

<a class="first" href="<?php echo $_smarty_tpl->tpl_vars['route']->value->urlFor('admin-users');?>
">Users</a>

<span class="nav-divider"></span>

<a class="first" href="<?php echo $_smarty_tpl->tpl_vars['route']->value->urlFor('admin-withdrawals');?>
">Withdrawal Requests</a>
<a href="<?php echo $_smarty_tpl->tpl_vars['route']->value->urlFor('admin-deposits');?>
">Pending Deposits</a>
<a href="<?php echo $_smarty_tpl->tpl_vars['route']->value->urlFor('admin-referrals');?>
">Referrals</a>

<span class="nav-divider"></span>

<a class="first" href="<?php echo $_smarty_tpl->tpl_vars['route']->value->urlFor('admin-transactions');?>
">Transactions</a>
<a href="<?php echo $_smarty_tpl->tpl_vars['route']->value->urlFor('admin-transactions',array(),array('logType'=>'deposit'));?>
">Deposits</a>
<a href="<?php echo $_smarty_tpl->tpl_vars['route']->value->urlFor('admin-transactions',array(),array('logType'=>'withdrawal'));?>
">Withdrawals</a>
<a href="<?php echo $_smarty_tpl->tpl_vars['route']->value->urlFor('admin-transactions',array(),array('logType'=>'earning'));?>
">Earnings</a>
<a href="<?php echo $_smarty_tpl->tpl_vars['route']->value->urlFor('admin-transactions',array(),array('logType'=>'referral'));?>
">Referrals</a>
<a href="<?php echo $_smarty_tpl->tpl_vars['route']->value->urlFor('admin-transactions',array(),array('logType'=>'bonus'));?>
">Bonuses</a>
<a href="<?php echo $_smarty_tpl->tpl_vars['route']->value->urlFor('admin-transactions',array(),array('logType'=>'penalty'));?>
">Penalties</a>

<span class="nav-divider"></span>

<a class="first" href="<?php echo $_smarty_tpl->tpl_vars['route']->value->urlFor('admin-settings');?>
">Settings</a>
<a href="<?php echo $_smarty_tpl->tpl_vars['route']->value->urlFor('admin-settings');?>
">Auto-Withdrawals Settings</a>
<a href="<?php echo $_smarty_tpl->tpl_vars['route']->value->urlFor('admin-settings');?>
">Referral Settings</a>
<a href="<?php echo $_smarty_tpl->tpl_vars['route']->value->urlFor('admin-settings');?>
">Email Templates</a>
<a href="<?php echo $_smarty_tpl->tpl_vars['route']->value->urlFor('admin-settings');?>
">Links Replacement</a>
<a href="<?php echo $_smarty_tpl->tpl_vars['route']->value->urlFor('admin-settings');?>
">Security</a>
<a href="<?php echo $_smarty_tpl->tpl_vars['route']->value->urlFor('admin-settings');?>
">Earning Holidays</a>
<a href="<?php echo $_smarty_tpl->tpl_vars['route']->value->urlFor('admin-settings');?>
">Info Box Settings</a>

<span class="nav-divider"></span>

<a class="first" href="#">IPs Check</a>
<a href="#">Send a Newsletter</a>
<a href="#">Custom Pages</a>
<a href="#">News</a>
<a href="#">User Notices</a>
<a href="#">Maintenance Page</a>
<a href="#">Tell A Friend</a>

<span class="nav-divider"></span>

<a class="first" href="<?php echo $_smarty_tpl->tpl_vars['route']->value->urlFor('logout');?>
" onclick="return logoutUser()">Logout</a>

</nav>


<?php }
}
