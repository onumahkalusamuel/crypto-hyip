<?php $this->addAttribute('pageTitle', 'Dashboard'); ?>
<?php $this->setLayout('user/layout.php'); ?>
<?php

$user = $data['user'];
$referrals = $data['referrals'];
$deposits = $data['deposits'];
$withdrawals = $data['withdrawals'];
$earnings = $data['earnings'];

$depositsTotal = 0;
foreach ($deposits as $d) {
    if (in_array($d->status, ["approved", "released"])) {
        $depositsTotal += $d->amount;
    }
}

$withdrawalsTtotal = 0;
foreach ($withdrawals as $d) {
    if ($d->status == "approved") {
        $withdrawalsTtotal += $d->amount;
    }
}

$earningsTotal = 0;
foreach ($earnings as $e) {
    $earningsTotal += $e->amount;
}

$referralCount = $referrals->total;

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
                        <h3 class="heading-line-bottom">Overview</h3>
                        <div class="row">
                            <div class="col-sm-6 col-md-3 p-5">
                                <div class="help">
                                    <h3 class="m-0">$<?= number_format($depositsTotal, 2); ?></h3>
                                    <h6 class="m-0 text-uppercase">Investments</h6>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3 p-5">
                                <div class="help">
                                    <h3 class="m-0">$<?= number_format($earningsTotal, 2); ?></h3>
                                    <h6 class="m-0 text-uppercase">All Earnings</h6>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3 p-5">
                                <div class="help">
                                    <h3 class="m-0">$<?= number_format($withdrawalsTtotal, 2); ?></h3>
                                    <h6 class="m-0 text-uppercase">Withdrawals</h6>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3 p-5">
                                <div class="help">
                                    <h3 class="m-0">$<?= number_format($user->btcBalance, 2); ?></h3>
                                    <h6 class="m-0 text-uppercase">Balance</h6>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3 p-5">
                                <div class="help">
                                    <h3 class="m-0"><?= number_format($referrals->total); ?></h3>
                                    <h6 class="m-0 text-uppercase">Total Referrals</h6>
                                </div>
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