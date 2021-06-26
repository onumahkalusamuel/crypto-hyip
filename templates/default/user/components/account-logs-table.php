<?php
$default = ['data' => [], 'total_rows' => 0];

[
    'data' => $transactions,
    'total_rows' => $totalRows
] = $logs + $default;
?>

<div class="section-content">
    <div class="">
        <form class="row" action="" method="get">
            <div class="form-group col-sm-4 col-md-3">
                <label for="logType">Log Type:</label>
                <select id="logType" name="logType" class="form-control">
                    <option <?= ($_GET['logType'] == 'all' ? 'selected' : null); ?> value="all">Show All Logs</option>
                    <option <?= ($_GET['logType'] == 'deposit' ? 'selected' : null); ?> value="deposit">Deposits</option>
                    <option <?= ($_GET['logType'] == 'withdrawal' ? 'selected' : null); ?> value="withdrawal">Withdrawals</option>
                    <option <?= ($_GET['logType'] == 'earning' ? 'selected' : null); ?> value="earning">Earnings</option>
                    <option <?= ($_GET['logType'] == 'bonus' ? 'selected' : null); ?> value="bonus">Bonus</option>
                    <option <?= ($_GET['logType'] == 'penalty' ? 'selected' : null); ?> value="penalty">Penalty</option>
                    <option <?= ($_GET['logType'] == 'referral' ? 'selected' : null); ?> value="referral">Referral Commission</option>
                </select>
            </div>
            <div class="form-group col-sm-4 col-md-3">
                <label for="from">From:</label>
                <input class="form-control" type="date" id="from" name="from" value="<?= $_GET['from'] ?? date("Y-m-d", strtotime("-3 month")); ?>" />
            </div>
            <div class="form-group col-sm-4 col-md-3">
                <label for="to">To:</label>
                <input class="form-control" type="date" id="to" name="to" value="<?= $_GET['to'] ?? date("Y-m-d", strtotime("+1 day")); ?>" />
            </div>
            <div class="form-group col-sm-4 col-md-2">
                <label for="rpp">Per Page:</label>
                <select id="rpp" name="rpp" class="form-control">
                    <option <?= ($_GET['rpp'] == '20' ? 'selected' : null); ?>>20</option>
                    <option <?= ($_GET['rpp'] == '50' ? 'selected' : null); ?>>50</option>
                    <option <?= ($_GET['rpp'] == '100' ? 'selected' : null); ?>>100</option>
                </select>
            </div>
            <div class="form-group col-sm-4 col-md-1">
                <br class="hidden-xs hidden-sm" />
                <button type="submit" class="form-control btn btn-dark btn-theme-colored2">Go</button>
            </div>
        </form>
    </div>

    <?php echo $this->fetch(
        'user/components/account-logs-table-only.php',
        ['transactions' => $transactions ?? []]
    ); ?>

    <?php echo $this->fetch(
        'user/components/pagination.php',
        ['total_rows' => $totalRows, 'total_retrieved' => count($transactions)]
    ); ?>

</div>