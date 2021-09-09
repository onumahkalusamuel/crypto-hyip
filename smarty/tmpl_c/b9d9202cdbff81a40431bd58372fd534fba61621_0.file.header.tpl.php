<?php
/* Smarty version 3.1.39, created on 2021-09-09 11:19:23
  from '/home/ssa/arena/crypto-hyip/tmpl/admin/header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6139dfabb2a1d4_99898293',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b9d9202cdbff81a40431bd58372fd534fba61621' => 
    array (
      0 => '/home/ssa/arena/crypto-hyip/tmpl/admin/header.tpl',
      1 => 1631182762,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:admin/navigation.tpl' => 1,
  ),
),false)) {
function content_6139dfabb2a1d4_99898293 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <?php if (!(isset($_smarty_tpl->tpl_vars['pageTitle']->value))) {?>
    <?php $_smarty_tpl->_assignInScope('pageTitle', "Welcome");?>
    <?php }?>
    <base href="<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
/" />
    <!-- Meta Tags -->
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <!-- Page Title -->
    <title><?php echo $_smarty_tpl->tpl_vars['pageTitle']->value;?>
 - <?php echo $_smarty_tpl->tpl_vars['siteSettings']->value['site_name'];?>
</title>

    <!-- Favicon and Touch Icons -->
    <link href="assets/images/favicon.png" rel="shortcut icon" type="image/png">
    <link rel="apple-touch-icon" href="assets/images/apple-touch-icon-iphone-60x60.png">
    <link rel="apple-touch-icon" sizes="60x60" href="assets/images/apple-touch-icon-ipad-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="assets/images/apple-touch-icon-iphone-retina-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="assets/images/apple-touch-icon-ipad-retina-152x152.png">

    <style type="text/css">
        :root {
            --primary-color: #FF8D00;
            --secondary-color: blue;
            --background-color: #FFFFF2;
            --info-background-color: #FFFFEE;
            --info-border-color: yellow;
            --info-text-color:#333300;
        }
        body {
            font-size: 0.9em;
            font-family: Arial;
            background-color: var(--background-color);
        }
        .header {
            background-color: var(--primary-color)
        }
        .body{
            background-color:#fff;
            border-color: var(--primary-color);
            border-width: 1px;
            border-style:solid;
        }
        td {
            vertical-align: top;
        }

        nav div.menu-title {
            background-color: var(--primary-color);
            padding: 5px 0px;
            text-align:center;
            color: #fff;
            font-weight: bold
        }

        nav a {
            padding-top: 5px;
            padding-bottom: 5px;
            display: inline-block;
            border-bottom: 1px dotted var(--primary-color);
            width: 100%;
            padding-left: 10px;
            box-sizing: border-box;
            text-decoration: none;
            color: #333;
        }

        nav a.first {
            border-top: 1px dotted var(--primary-color);
        }

        nav a:hover, nav a:active {
            background-color:var(--primary-color);
        }
        span.nav-divider {
            display:inline-block;
            height:20px;
            width:100%;
        }
    </style>

</head>

<body class="">
<center>
<table width="998" class="header" height="100">
    <tr>
        <td>
            <a class="" href="<?php echo $_smarty_tpl->tpl_vars['route']->value->urlFor('admin-dashboard');?>
">
                <img src="assets/images/logo-wide.png" alt="" style="max-width:300px;">
            </a>
        </td>
    </tr>
</table>
<table width="998" class="body">
    <tr>
        <td width="198" style="border-right:1px solid orange"><?php $_smarty_tpl->_subTemplateRender('file:admin/navigation.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?></td>
        <td><?php }
}
