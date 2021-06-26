<?php
$default = ['data' => [], 'total_rows' => 0];

[
    'data' => $localData,
    'total_rows' => $totalRows
] = $referrals + $default;
?>
<div class="pb-40 pt-sm-5">
    <div class="section-content">
        <div class="">
            <form class="row" action="" method="get">
                <div class="form-group col-sm-4 col-md-3">
                    <label for="query">Enter Referral Username:</label>
                    <input class="form-control" type="text" id="query" name="query" value="<?= $esc->escapeHtml($_GET['query']); ?>" />
                </div>
                <div class="form-group col-sm-4 col-md-3">
                    <label for="from">From:</label>
                    <input class="form-control" type="date" id="from" name="from" value="<?= $esc->escapeHtml($_GET['from']); ?>" />
                </div>
                <div class="form-group col-sm-4 col-md-3">
                    <label for="to">To:</label>
                    <input class="form-control" type="date" id="to" name="to" value="<?= $esc->escapeHtml($_GET['to']); ?>" />
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
                    <th>Earned</th>
                    <th>Action</th>
                </tr>

                <?php if (!empty($localData)) : ?>
                    <?php foreach ($localData as $index => $trans) : ?>
                        <tr>
                            <td class="text-uppercase">
                                <strong>
                                    <?= $trans->referredUserName; ?>
                                </strong><br />
                                <small>
                                    <strong>by:</strong>
                                    <?= $trans->referralUserName; ?><br />
                                    <strong>Date:</strong>
                                    <?= $getTimeAgo($trans->createdAt); ?><br />
                                </small>
                            </td>
                            <td>
                                $<?= number_format($trans->referralBonus, 2); ?><br />
                            </td>
                            <td class="">
                                <a href="<?= $route->urlFor('user-view-referral', ['id' => $trans->ID]) ?>" class="btn btn-dark btn-theme-colored btn-sm btn-flat mb-5">VIEW</i></a><br />
                                <?php if ($trans->referralstatus === "approved") : ?>
                                    <a href="" class="btn btn-dark btn-theme-colored2 btn-sm btn-flat mb-5" onclick="return releaseDeposit(<?= $esc->escapeJs($trans->ID); ?>)">RELEASE</i></a>
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