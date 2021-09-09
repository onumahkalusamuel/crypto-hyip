<?php
/* Smarty version 3.1.39, created on 2021-09-09 08:00:52
  from '/home/ssa/arena/crypto-hyip/tmpl/admin/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6139b124f30356_12118021',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '317e8b1d6c02d207eb9d7e473e31af5053fa68fd' => 
    array (
      0 => '/home/ssa/arena/crypto-hyip/tmpl/admin/index.tpl',
      1 => 1631170851,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6139b124f30356_12118021 (Smarty_Internal_Template $_smarty_tpl) {
?>Hello <?php echo $_smarty_tpl->tpl_vars['data']->value;?>
, how are you

<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value, 'item', false, 'key', 'name', array (
));
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
?>
    <?php echo $_smarty_tpl->tpl_vars['key']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['name']->value;?>

<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
