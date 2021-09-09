<?php
$default = ['data' => [], 'total_rows' => 0];

[
    'data' => $localData,
    'total_rows' => $totalRows
] = $users + $default;
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
                <div class="form-group col-sm-4 col-md-6">
                    <label for="query">Enter Search Term:</label>
                    <input class="form-control" type="text" id="query" name="query" value="<?= $esc->escapeHtml($_GET['query']); ?>" />
                </div>
                <div class="form-group col-sm-4 col-md-3">
                    <label for="rpp">Per Page:</label>
                    <select id="rpp" name="rpp" class="form-control">
                        <option <?= ($_GET['rpp'] == '20' ? 'selected' : null); ?>>20</option>
                        <option <?= ($_GET['rpp'] == '50' ? 'selected' : null); ?>>50</option>
                        <option <?= ($_GET['rpp'] == '100' ? 'selected' : null); ?>>100</option>
                    </select>
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
                    <th>Action</th>
                </tr>

                <?php if (!empty($localData)) : ?>
                    <?php foreach ($localData as $index => $trans) : ?>
                        <tr>
                            <td class="text-uppercase">
                                <strong>
                                    <?= $trans->userName; ?> <small class="badge <?= $trans->isActive ? 'active' : ''; ?>"><?= $trans->isActive ? 'active' : 'inactive'; ?></small>
                                </strong><br />
                                <small>
                                    <strong>Full Name:</strong>
                                    <?= $trans->fullName; ?><br />
                                    <strong>Available Balance:</strong>
                                    $<?= number_format($trans->btcBalance, 2); ?><br />
                                </small>
                            </td>
                            <td class="">
                                <a href="<?= $route->urlFor('admin-view-user', ['id' => $trans->ID]) ?>" class="btn btn-dark btn-theme-colored btn-sm btn-flat mb-5">VIEW</i></a><br />
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

<style>
    small.inactive {
        background-color: #ffc107;
    }

    small.active {
        background-color: #28a745;
    }
</style>