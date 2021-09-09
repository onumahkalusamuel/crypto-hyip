<?php
$default = ['data' => [], 'total_rows' => 0];

[
    'data' => $localData,
    'total_rows' => $totalRows
] = $withdrawals + $default;
?>
<div class="pb-40 pt-sm-5">
    <div class="section-content">
        <div class="">
            <form class="row" action="" method="get">
                <div class="form-group col-sm-4 col-md-3">
                    <label for="withdrawalStatus">Withdrawal Status:</label>
                    <select id="withdrawalStatus" name="withdrawalStatus" class="form-control">
                        <option <?= ($_GET['withdrawalStatus'] == '' ? 'selected' : null); ?> value="">Show All</option>
                        <option <?= ($_GET['withdrawalStatus'] == 'approved' ? 'selected' : null); ?> value="approved">Active</option>
                        <option <?= ($_GET['withdrawalStatus'] == 'pending' ? 'selected' : null); ?> value="pending">Pending</option>
                        <option <?= ($_GET['withdrawalStatus'] == 'declined' ? 'selected' : null); ?> value="declined">Declined</option>
                    </select>
                </div>
                <div class="form-group col-sm-4 col-md-3">
                    <label for="from">From:</label>
                    <input class="form-control" type="date" id="from" name="from" value="<?= $_GET['from']; ?>" />
                </div>
                <div class="form-group col-sm-4 col-md-3">
                    <label for="to">To:</label>
                    <input class="form-control" type="date" id="to" name="to" value="<?= $_GET['to']; ?>" />
                </div>
                <div class="form-group col-sm-4 col-md-3">
                    <br class="hidden-xs hidden-sm" />
                    <button type="submit" class="form-control btn btn-dark btn-theme-colored2">Go</button>
                </div>
            </form>
        </div>
        <div class="table-responsive border-theme-colored">
            <table class="table table-striped table-hover">
                <tr>
                    <th>Details</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>

                <?php if (!empty($localData)) : ?>
                    <?php foreach ($localData as $index => $trans) : ?>
                        <tr>
                            <td class="text-uppercase">
                                <strong>
                                    <?= $trans->userName; ?>
                                </strong>&nbsp;
                                <small class="badge <?= $trans->withdrawalStatus; ?>"><?= $trans->withdrawalStatus; ?></small>
                            </td>
                            <td>
                                $<?= number_format($trans->amount, 2); ?><br />
                                <img src="assets/images/currencies/<?= $trans->cryptoCurrency; ?>.gif" alt="<?= $trans->cryptoCurrency; ?>" />
                            </td>
                            <td class="">
                                <a href="<?= $route->urlFor('user-view-withdrawal', ['id' => $trans->ID]) ?>" class="btn btn-dark btn-theme-colored btn-sm btn-flat mb-5">VIEW</i></a><br />
                                <?php if ($trans->withdrawalStatus === "pending") : ?>
                                    <a href="<?=$route->urlFor('user-delete-withdrawal', ['id'=> $trans->ID]);?>" class="btn btn-dark btn-theme-colored2 btn-sm btn-flat mb-5" onclick="return confirmAction('Are you sure you want to cancel this withdrawal request?')">CANCEL</i></a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="5">
                            No data found.
                        </td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
        <?php echo $this->fetch(
            'user/components/pagination.php',
            ['total_rows' => $totalRows, 'total_retrieved' => count($localData)]
        ); ?>
    </div>
</div>