<?php
$transactions = $transactions ?? [];
?>

<div class="table-responsive border-theme-colored">
    <table class="table table-striped table-hover">
        <tr>
            <th>Details</th>
            <th>Amount</th>
            <th>Date</th>
        </tr>
        <?php if (!empty($transactions)) : ?>
            <?php foreach ($transactions as $index => $trans) : ?>
                <tr>
                    <td class="text-uppercase">
                        <strong>
                            <?= $trans->userName; ?>
                        </strong>&nbsp;
                        <small class="badge <?= $trans->logType; ?>"><?= $trans->logType; ?></small><br />
                        <small><?= $trans->transactionDetails; ?></small>
                    </td>
                    <td>
                        <?= number_format($trans->amount, 2); ?><br />
                        <img src="assets/images/bitcoin.gif" alt="bitcoin" />
                    </td>
                    <td class="">
                        <small><?= $getTimeAgo($trans->createdAt); ?></small>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="5">
                    No transactions found.
                </td>
            </tr>
        <?php endif; ?>
    </table>
</div>