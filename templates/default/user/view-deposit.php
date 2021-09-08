<?php $this->addAttribute('pageTitle', 'Deposits'); ?>
<?php $this->setLayout('user/layout.php'); ?>
<?php

$deposit = $data['deposit'];
$transactions = $data['trailLog'];

if(empty($deposit->ID)) {
    header("Location: " . $route->urlFor('user-deposits'));
    exit();
}

switch ($deposit->cryptoCurrency) {
    case "btc": {
            $protocol = "bitcoin";
            break;
        }
    case "eth": {
            $protocol = "etherium";
            break;
        }
    case "doge": {
            $protocol = "dogecoin";
            break;
        }
    case "ltc": {
            $protocol = "litecoin";
            break;
        }
    default: {
            $protocol = "bitcoin";
            break;
        }
}

$paymentLink = "https://www.bitcoinqrcodemaker.com/api/?style={$protocol}&amount={$deposit->cryptoAmount}&address={$deposit->depositAddress}";

?>

<div class="main-content">

    <div class="container pb-40 pt-20">

        <div id="accordion" class="panel-group toggle accordion-classic accordion-classic-theme-colored2 accordion-flat">
            <div class="panel panel-default mb-20">
                <div class="panel-heading">
                    <div class="panel-title"> <a class="active font-24 pt-0 pb-0 text-capitalize" data-toggle="collapse" href="#accordion1">Deposit Details </a> </div>
                </div>
                <div id="accordion1" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="">
                            <div class="row">
                                <div class="col-md-6 row" style="justify-content: center;display: flex">
                                    <div class="col-sm-12 col-md-10 p-0 m-20 border-theme-colored2" style="border-style: solid;">
                                        <div class="image-box-thum text-center p-25">
                                            <img src="<?= $paymentLink; ?>" alt="QR CODE">
                                        </div>
                                        <div class="image-box-details text-center p-10 pt-30 pb-30 bg-lighter">

                                            <?php if ($deposit->depositStatus === "pending") : ?>
                                                <strong>Click on Address</strong>
                                                OR
                                                <strong>Scan QR-Code</strong>
                                                to make payment. If you do not have a supported
                                                wallet,
                                                <strong>Copy the address</strong>
                                                and complete payment from your wallet. Send exactly
                                                <strong><?= $deposit->cryptoAmount; ?></strong>
                                                <?= strtoupper($deposit->cryptoCurrency); ?> to
                                                <a class="heading-line-bottom font-14" href="<?= $protocol; ?>:<?= $deposit->depositAddress; ?>?amount=<?= $deposit->cryptoAmount; ?>?message=<?= $deposit->transactionID; ?>"><strong><?= $deposit->depositAddress; ?></strong></a>

                                            <?php else : ?>
                                                <p class="desc mb-20">Payment received and processed.</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h3 class=" heading-title heading-line-bottom text-capitalize">Full details</h3>
                                    <table class="table">
                                        <tr>
                                            <th>Transaction ID:</th>
                                            <td><?= $deposit->transactionID; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Username:</th>
                                            <td><?= $deposit->userName; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Plan:</th>
                                            <td><?= $deposit->planTitle; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Principal Return:</th>
                                            <td>Yes</td>
                                        </tr>
                                        <tr>
                                            <th>Principal Withdraw:</th>
                                            <td>Available on maturity or deposit release</td>
                                        </tr>
                                        <tr>
                                            <th>Credit Amount:</th>
                                            <td>$<?= number_format($deposit->amount, 2); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Deposit Fee:</th>
                                            <td>0.00% + $0.00 (min. $0.00 max. $0.00)</td>
                                        </tr>
                                        <tr>
                                            <th>Debit Amount:</th>
                                            <td>$<?= number_format($deposit->amount, 2); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Crypto Currency:</th>
                                            <td><?= strtoupper($deposit->cryptoCurrency); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Crypto Amount:</th>
                                            <td><?= $deposit->cryptoAmount; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Deposit Status:</th>
                                            <td>
                                                <small class="badge text-uppercase <?= $deposit->depositStatus; ?>"><?= $deposit->depositStatus; ?></small>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        <a class="active font-24 pt-0 pb-0 text-capitalize" data-toggle="collapse" href="#accordion2" aria-expanded="true">
                            Deposit Transactions
                        </a>
                    </div>
                </div>
                <div id="accordion2" class="panel-collapse collapse in ">
                    <div class="panel-body">
                        <h5>All earnings and transactions for this deposit will be listed here.</h5>
                        <?php echo $this->fetch(
                            'user/components/account-logs-table-only.php',
                            ['transactions' => $transactions ?? []]
                        ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .pending {
        background-color: #ffc107;
    }

    .approved {
        background-color: #28a745;
    }

    .released {
        background-color: #007bff;
    }
</style>