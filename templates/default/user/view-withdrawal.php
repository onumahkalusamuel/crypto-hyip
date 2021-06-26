<?php $this->addAttribute('pageTitle', 'Withdrawals'); ?>
<?php $this->setLayout('user/layout.php'); ?>
<?php
$withdrawal = $data['withdrawal'];

if (empty($withdrawal->ID)) {
    header("Location: " . $route->urlFor('user-withdrawals'));
    exit();
}

?>

<div class="main-content">

    <div class="container pb-40 pt-20">

        <div id="accordion" class="panel-group toggle accordion-classic accordion-classic-theme-colored2 accordion-flat">
            <div class="panel panel-default mb-20">
                <div class="panel-heading">
                    <div class="panel-title"> <a class="active font-24 pt-0 pb-0 text-capitalize" data-toggle="collapse" href="#accordion1">Withdrawal Details </a> </div>
                </div>
                <div id="accordion1" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class=" heading-title heading-line-bottom text-capitalize">Full details</h3>
                                    <table class="table">
                                        <tr>
                                            <th>Withdrawal Request Date:</th>
                                            <td><?= $getTimeAgo($withdrawal->createdAt); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Username:</th>
                                            <td><?= $withdrawal->userName; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Crypto Currency:</th>
                                            <td>
                                                <?= strtoupper($withdrawal->cryptoCurrency); ?>&nbsp;<br />
                                                <img src="assets/images/currencies/<?= $withdrawal->cryptoCurrency; ?>.gif" alt="<?= $withdrawal->cryptoCurrency; ?>" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Withdrawal Address:</th>
                                            <td><?= $withdrawal->withdrawalAddress; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Amount Requested:</th>
                                            <td>$<?= number_format($withdrawal->amount, 2); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Deposit Status:</th>
                                            <td>
                                                <small class="badge text-uppercase <?= $withdrawal->withdrawalStatus; ?>"><?= $withdrawal->withdrawalStatus; ?></small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Message from Admin:</th>
                                            <td><?= $withdrawal->messageFromAdmin; ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <!-- Can be used for crypto fun facts later on -->
                                </div>
                            </div>
                        </div>
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

    .declined {
        background-color: #007bff;
    }
</style>