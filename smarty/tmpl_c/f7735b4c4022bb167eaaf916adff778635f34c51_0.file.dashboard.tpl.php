<?php
/* Smarty version 3.1.39, created on 2021-09-09 09:19:05
  from '/home/ssa/arena/crypto-hyip/tmpl/admin/dashboard.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6139c3791572c4_94518193',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f7735b4c4022bb167eaaf916adff778635f34c51' => 
    array (
      0 => '/home/ssa/arena/crypto-hyip/tmpl/admin/dashboard.tpl',
      1 => 1631175234,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:admin/header.tpl' => 1,
    'file:admin/footer.tpl' => 1,
  ),
),false)) {
function content_6139c3791572c4_94518193 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:admin/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('pageTitle'=>'Dashboard'), 0, false);
?>


<div class="main-content">
    <div class="container pb-40 pt-20">
        <div id="accordion" class="panel-group toggle accordion-classic accordion-classic-theme-colored2 accordion-flat">
            <div class="panel panel-default mb-20">
                <div class="panel-heading">
                    <div class="panel-title"> <a class="active font-24 pt-0 pb-0 text-capitalize" data-toggle="collapse" href="#accordion1" aria-expanded="true">Account Dashboard</a> </div>
                </div>
                <div id="accordion1" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="col-md-12">
                            <h3 class=" heading-title heading-line-bottom text-capitalize">Overview</h3>
                            <table class="table">
                                <tr>
                                    <td colspan="2" class="text-uppercase font-18">Users</td>
                                </tr>
                                <tr>
                                    <th>Active Users:</th>
                                    <td><?php echo '<?=';?>
 number_format($data['users']['active']); <?php echo '?>';?>
</td>
                                </tr>
                                <tr>
                                    <th>Total Users:</th>
                                    <td><?php echo '<?=';?>
 number_format($data['users']['total']); <?php echo '?>';?>
</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-uppercase font-18">Referrals</td>
                                </tr>
                                <tr>
                                    <th>Total:</th>
                                    <td><?php echo '<?=';?>
 number_format($data['referrals']['total']); <?php echo '?>';?>
</td>
                                </tr>
                                <tr>
                                    <th>Bonus Earned:</th>
                                    <td>$<?php echo '<?=';?>
 number_format($data['referrals']['amount'], 2); <?php echo '?>';?>
</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-uppercase font-18">Deposits</td>
                                </tr>
                                <?php echo '<?php ';?>
foreach ($data['deposits'] as $deposit) : <?php echo '?>';?>

                                    <tr>
                                        <th>
                                            <?php echo '<?=';?>
 strtoupper($deposit->status); <?php echo '?>';?>

                                        </th>
                                        <td class="">
                                            Currency: <img src="assets/images/currencies/<?php echo '<?=';?>
 $deposit->currency; <?php echo '?>';?>
.gif" alt="<?php echo '<?=';?>
 $deposit->currency; <?php echo '?>';?>
" /><br />
                                            Amount: $<?php echo '<?=';?>
 number_format($deposit->amount, 2); <?php echo '?>';?>
 <br />
                                            Total: <?php echo '<?=';?>
 number_format($deposit->total); <?php echo '?>';?>

                                        </td>
                                    </tr>
                                <?php echo '<?php ';?>
endforeach; <?php echo '?>';?>

                                <tr>
                                    <td colspan="2" class="text-uppercase font-18">Withdrawals</td>
                                </tr>
                                <?php echo '<?php ';?>
foreach ($data['withdrawals'] as $withdrawal) : <?php echo '?>';?>

                                    <tr>
                                        <th>
                                            <?php echo '<?=';?>
 strtoupper($withdrawal->status); <?php echo '?>';?>

                                        </th>
                                        <td class="">
                                            Currency: <img src="assets/images/currencies/<?php echo '<?=';?>
 $withdrawal->currency; <?php echo '?>';?>
.gif" alt="<?php echo '<?=';?>
 $withdrawal->currency; <?php echo '?>';?>
" /><br />
                                            Amount: $<?php echo '<?=';?>
 number_format($withdrawal->amount, 2); <?php echo '?>';?>
 <br />
                                            Total: <?php echo '<?=';?>
 number_format($withdrawal->total); <?php echo '?>';?>

                                        </td>
                                    </tr>
                                <?php echo '<?php ';?>
endforeach; <?php echo '?>';?>

                                <tr>
                                    <td colspan="2" class="text-uppercase font-18">Transaction Logs</td>
                                </tr>
                                <?php echo '<?php ';?>
foreach ($data['transactions'] as $transaction) : <?php echo '?>';?>

                                    <tr>
                                        <th>
                                            <?php echo '<?=';?>
 strtoupper($transaction->type); <?php echo '?>';?>

                                        </th>
                                        <td class="">
                                            Currency: <img src="assets/images/currencies/<?php echo '<?=';?>
 $transaction->currency; <?php echo '?>';?>
.gif" alt="<?php echo '<?=';?>
 $transaction->currency; <?php echo '?>';?>
" /><br />
                                            Amount: $<?php echo '<?=';?>
 number_format($transaction->amount, 2); <?php echo '?>';?>
 <br />
                                            Total: <?php echo '<?=';?>
 number_format($transaction->total); <?php echo '?>';?>

                                        </td>
                                    </tr>
                                <?php echo '<?php ';?>
endforeach; <?php echo '?>';?>

                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $_smarty_tpl->_subTemplateRender('file:admin/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
