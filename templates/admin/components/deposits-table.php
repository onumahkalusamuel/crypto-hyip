<?php
$default = ['data' => [], 'total_rows' => 0];

[
    'data' => $localData,
    'total_rows' => $totalRows
] = $deposits + $default;
?>
<div class="pb-40 pt-sm-5">
    <div class="section-content">
        <div class="">
            <form class="row" action="" method="get">
                <!-- set other parameters -->
                <?php
                foreach ($_GET as $key => $value) {
                    if (!in_array($key, ['logType', 'from', 'to', 'rpp'])) {
                        echo "<input name='$key' value='$value' hidden />";
                    }
                }
                ?>
                <div class="form-group col-sm-4 col-md-3">
                    <label for="depositStatus">Deposit Status:</label>
                    <select id="depositStatus" name="depositStatus" class="form-control">
                        <option <?= ($_GET['depositStatus'] == '' ? 'selected' : null); ?> value="">Show All</option>
                        <option <?= ($_GET['depositStatus'] == 'approved' ? 'selected' : null); ?> value="approved">Approved</option>
                        <option <?= ($_GET['depositStatus'] == 'pending' ? 'selected' : null); ?> value="pending">Pending</option>
                        <option <?= ($_GET['depositStatus'] == 'released' ? 'selected' : null); ?> value="released">Released</option>
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
                                    <?= $trans->planTitle; ?>
                                </strong>&nbsp;
                                <small class="badge <?= $trans->depositStatus; ?>"><?= $trans->depositStatus; ?></small><br />
                                <small>
                                    <strong>Username: </strong><?=$trans->userName;?>
                                </small><br />
                                <?php if ($trans->depositStatus !== "pending") : ?>
                                    <small>
                                        <strong>Start Date:</strong>
                                        <?= $getTimeAgo($trans->depositApprovalDate); ?><br />
                                        <strong>End Date:</strong>
                                        <?= $trans->finalInterestDate; ?><br />
                                        <strong>ROI:</strong>
                                        $<?= number_format($trans->interestBalance, 2); ?>
                                    </small>
                                <?php endif; ?>
                            </td>
                            <td>
                                $<?= number_format($trans->amount, 2); ?><br />
                                <img src="assets/images/currencies/<?= $trans->cryptoCurrency; ?>.gif" alt="<?= $trans->cryptoCurrency; ?>" />
                            </td>
                            <td class="">
                                <a href="<?= $route->urlFor('admin-view-deposit', ['id' => $trans->ID]) ?>" class="btn btn-dark btn-theme-colored btn-sm btn-flat mb-5">VIEW</i></a><br />
                                <?php if ($trans->depositStatus === "pending") : ?>
                                    <a href="<?=$route->urlFor('admin-approve-deposit', ['id'=> $trans->ID]);?>" class="btn btn-success btn-sm btn-flat mb-5" onclick="return confirmAction('Are you sure you want to approve this deposit? Once approved, the user will start receiving interests according to the plan selected. Continue?')">APPROVE</i></a><br/>
                                    <a href="<?=$route->urlFor('admin-delete-deposit', ['id'=> $trans->ID]);?>" class="btn btn-dark btn-theme-colored2 btn-sm btn-flat mb-5" onclick="return deleteRecord()">DELETE</i></a>
                                <?php endif; ?>
                                <?php if ($trans->depositStatus === "approved") : ?>
                                    <a href="<?=$route->urlFor('admin-release-deposit', ['id'=> $trans->ID]);?>" class="btn btn-success btn-sm btn-flat mb-5" onclick="return confirmAction('Are you sure you want to release this deposit? The user can then withdraw the funds. It cannot be undone.')">RELEASE</i></a>
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