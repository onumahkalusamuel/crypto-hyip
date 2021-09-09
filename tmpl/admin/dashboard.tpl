{include file='admin/header.tpl' pageTitle='Dashboard'}


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
                                    <td><?= number_format($data['users']['active']); ?></td>
                                </tr>
                                <tr>
                                    <th>Total Users:</th>
                                    <td><?= number_format($data['users']['total']); ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-uppercase font-18">Referrals</td>
                                </tr>
                                <tr>
                                    <th>Total:</th>
                                    <td><?= number_format($data['referrals']['total']); ?></td>
                                </tr>
                                <tr>
                                    <th>Bonus Earned:</th>
                                    <td>$<?= number_format($data['referrals']['amount'], 2); ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-uppercase font-18">Deposits</td>
                                </tr>
                                <?php foreach ($data['deposits'] as $deposit) : ?>
                                    <tr>
                                        <th>
                                            <?= strtoupper($deposit->status); ?>
                                        </th>
                                        <td class="">
                                            Currency: <img src="assets/images/currencies/<?= $deposit->currency; ?>.gif" alt="<?= $deposit->currency; ?>" /><br />
                                            Amount: $<?= number_format($deposit->amount, 2); ?> <br />
                                            Total: <?= number_format($deposit->total); ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td colspan="2" class="text-uppercase font-18">Withdrawals</td>
                                </tr>
                                <?php foreach ($data['withdrawals'] as $withdrawal) : ?>
                                    <tr>
                                        <th>
                                            <?= strtoupper($withdrawal->status); ?>
                                        </th>
                                        <td class="">
                                            Currency: <img src="assets/images/currencies/<?= $withdrawal->currency; ?>.gif" alt="<?= $withdrawal->currency; ?>" /><br />
                                            Amount: $<?= number_format($withdrawal->amount, 2); ?> <br />
                                            Total: <?= number_format($withdrawal->total); ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td colspan="2" class="text-uppercase font-18">Transaction Logs</td>
                                </tr>
                                <?php foreach ($data['transactions'] as $transaction) : ?>
                                    <tr>
                                        <th>
                                            <?= strtoupper($transaction->type); ?>
                                        </th>
                                        <td class="">
                                            Currency: <img src="assets/images/currencies/<?= $transaction->currency; ?>.gif" alt="<?= $transaction->currency; ?>" /><br />
                                            Amount: $<?= number_format($transaction->amount, 2); ?> <br />
                                            Total: <?= number_format($transaction->total); ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{include file='admin/footer.tpl'}