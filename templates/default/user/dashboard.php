<?php $this->addAttribute('pageTitle', 'Dashboard'); ?>
<?php $this->setLayout('user/layout.php'); ?>
<?php

$user = $data['user'];
$referrals = $data['referrals'];
$deposits = $data['deposits'];
$withdrawals = $data['withdrawals'];

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
                        <h5> Welcome back, <?= $user->fullName; ?></h5>
			<hr />
			<h3 class="heading-line-bottom">Balances</h3>
			<div class="row">
			    <div class="col-sm-6 col-md-3 p-5"><div class="help">
                                <h3 class="m-0">$<?=number_format($user->btcBalance,2);?></h3>
                                <h6 class="m-0 text-uppercase">BTC BALANCE</h6></div>
                            </div>
                        </div>

			<h3 class="heading-line-bottom">Deposits</h3>
			<div class="row">
			<?php foreach($deposits as $d):?>
			    <div class="col-sm-6 col-md-3 p-5"><div class="help">
				<h3 class="m-0">$<?=number_format($d->amount,2);?></h3>
				<h6 class="m-0 text-uppercase"><?=$d->status;?></h6></div>
			    </div>
			<?php endforeach;?>
			</div>

			<h3 class="heading-line-bottom">Withdrawals</h3>
                        <div class="row">
                        <?php foreach($withdrawals as $d):?>
                            <div class="col-sm-6 col-md-3 p-5"><div class="help">
                                <h3 class="m-0">$<?=number_format($d->amount,2);?></h3>
                                <h6 class="m-0 text-uppercase"><?=$d->status;?></h6></div>
                            </div>
                        <?php endforeach;?>
                        </div>

			<h3 class="heading-line-bottom">Referrals</h3>
                        <div class="row">
                            <div class="col-sm-6 col-md-3 p-5"><div class="help">
                                <h3 class="m-0">$<?=number_format($referrals->amount,2);?></h3>
                                <h6 class="m-0 text-uppercase">Earned so far</h6></div>
                            </div>
			    <div class="col-sm-6 col-md-3 p-5"><div class="help">
                                <h3 class="m-0"><?=number_format($referrals->total);?></h3>
                                <h6 class="m-0 text-uppercase">Total Referrals</h6></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $this->fetch('public/components/section-live-table.php');
    ?>
</div>
