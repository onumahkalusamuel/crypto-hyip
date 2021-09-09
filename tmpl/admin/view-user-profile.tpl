 <?php $this->addAttribute('pageTitle', $data['user']->fullName); ?>
 <?php $this->setLayout('admin/layout.php'); ?>
 <?php

    $user = $data['user'];
    $referrals = $data['referrals'];
    $deposits = $data['deposits'];
    $bonuses = $data['bonuses'];
    $penalties = $data['penalties'];
    $withdrawals = $data['withdrawals'];
    $transactions = $data['transactions'];
    $activeCurrencies = $data['activeCurrencies'];

    if (empty($user->ID)) {
        header("Location: " . $route->urlFor('admin-users'));
        exit();
    }
    ?>

 <div class="main-content">

     <div class="container pb-40 pt-20">

         <div id="accordion" class="panel-group toggle accordion-classic accordion-classic-theme-colored2 accordion-flat">
             <div class="panel panel-default mb-20">
                 <div class="panel-heading">
                     <div class="panel-title"> <a class="active font-24 pt-0 pb-0 text-capitalize" data-toggle="collapse" href="#profileAccordion">Profile Details </a> </div>
                 </div>
                 <div id="profileAccordion" class="panel-collapse collapse in">
                     <div class="panel-body">
                         <p class="help">
                             You can update user information from this form. After editing, click on <strong>UPDATE USER</strong> button to submit.
                         </p>
                         <div class="">
                             <form class="row" action="" method="POST">
                                 <div class="col-md-12">
                                     <table class="table">
                                         <tr>
                                             <td>
                                                 <strong>Full Name:</strong><br />
                                                 <input value="<?= ucwords($user->fullName); ?>" type="text" name="fullName" class="form-control" />
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>
                                                 <strong>Username:</strong><br />
                                                 <input value="<?= $user->userName; ?>" type="text" name="userName" class="form-control" />
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>
                                                 <strong>Email:</strong><br />
                                                 <input value="<?= $user->email; ?>" type="email" name="email" class="form-control" />
                                             </td>
                                         </tr>
                                         <?php foreach($activeCurrencies as $currency):?>
                                             <tr>
                                                 <td><strong><?=strtoupper($currency);?> Address:</strong><br />
                                                     <input value="<?= $user->{$currency.'Address'}; ?>" name="<?=$currency;?>Address" type="text" class="form-control" />
                                                 </td>
                                             </tr>
                                        <?php endforeach;?>
                                         <tr>
                                             <td><strong>New Password:</strong><br />
                                                 <input value="" name="password" type="text" class="form-control" />
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>
                                                 <strong>Actions:</strong><br />
                                                 <div>
                                                     <h3 class="heading-title">
                                                         <button type="submit" class="btn btn-dark btn-theme-colored btn-flat mb-5 text-uppercase">Update User</i></button></h3>
                                                     <!--<a href="<?= $route->urlFor('admin-block-user', ['id' => $trans->ID]) ?>" class="btn btn-dark btn-sm btn-flat btn-theme-colored2 mb-5">Block User</i></a> -->
                                                 </div>
                                             </td>
                                         </tr>
                                     </table>
                                 </div>
                             </form>
                         </div>
                     </div>
                 </div>
             </div>
             <?php if ($user->ID !== "new") : ?>
                 <div class="panel panel-default mb-20">
                     <div class="panel-heading">
                         <div class="panel-title"> <a class="active font-24 pt-0 pb-0 text-capitalize" data-toggle="collapse" href="#balancesAccordion">Balances </a> </div>
                     </div>
                     <div id="balancesAccordion" class="panel-collapse collapse in">
                         <div class="panel-body">
                             <div class="">
                                     <div class="col-md-12">
                                         <table class="table">
                                             <?php foreach($activeCurrencies as $currency):?>
                                             <tr>
                                                 <td>
                                                     <strong><?=strtoupper($currency);?> Balance:</strong><br />
                                                     $<?= number_format($user->{$currency .'Balance'}, 2); ?>
                                                 </td>
                                             </tr>
                                             <?php endforeach;?>
                                         </table>
                                     </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="panel panel-default mb-20">
                     <div class="panel-heading">
                         <div class="panel-title"> <a class="collapsed font-24 pt-0 pb-0 text-capitalize" data-toggle="collapse" href="#referralsAccordion">Referrals </a> </div>
                     </div>
                     <div id="referralsAccordion" class="panel-collapse collapse">
                         <div class="panel-body">
                             <div class="">
                                 <div class="row">
                                     <div class="col-md-12">
                                         <table class="table">
                                             <tr>
                                                 <td>
                                                     <strong>Total:</strong><br />
                                                     <?= number_format($referrals['total']); ?>
                                                 </td>
                                             </tr>
                                             <tr>
                                                 <td>
                                                     <strong>Bonus Earned:</strong><br />
                                                     $<?= number_format($referrals['amount'], 2); ?>
                                                 </td>
                                             </tr>
                                             <tr>
                                                 <td>
                                                     <strong>Actions:</strong><br />
                                                     <h3 class="heading-title text-uppercase">
                                                         <a href="<?= $route->urlFor('admin-referrals', [], ['referralUserID' => $user->ID]) ?>" class="btn btn-dark btn-flat btn-theme-colored">Full Details</i></a>
                                                     </h3>
                                                 </td>
                                             </tr>
                                         </table>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="panel panel-default mb-20">
                     <div class="panel-heading">
                         <div class="panel-title"> <a class="collapsed font-24 pt-0 pb-0 text-capitalize" data-toggle="collapse" href="#depositsAccordion">Deposits </a> </div>
                     </div>
                     <div id="depositsAccordion" class="panel-collapse collapse">
                         <div class="panel-body">
                             <div class="">
                                 <div class="row">
                                     <div class="col-md-12">
                                         <table class="table">
                                             <?php foreach ($deposits as $deposit) : ?>
                                                 <tr>
                                                     <td>
                                                         <strong>
                                                             <?= strtoupper($deposit->status); ?>
                                                         </strong><br />
                                                         Currency: <img src="assets/images/currencies/<?= $deposit->currency; ?>.gif" alt="<?= $deposit->currency; ?>" /><br />
                                                         Amount: $<?= number_format($deposit->amount, 2); ?> <br />
                                                         Total: <?= number_format($deposit->total); ?>
                                                     </td>
                                                 </tr>
                                             <?php endforeach; ?>
                                             <tr>
                                                 <td>
                                                     <strong>Actions</strong><br />
                                                     <h3 class="heading-title text-uppercase">
                                                         <a href="<?= $route->urlFor('admin-deposits', [], ['userID' => $user->ID]) ?>" class="btn btn-dark btn-flat btn-theme-colored">Full Details</i></a>
                                                     </h3>
                                                 </td>
                                             </tr>
                                         </table>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>

                 <div class="panel panel-default mb-20">
                     <div class="panel-heading">
                         <div class="panel-title"> <a class="collapsed font-24 pt-0 pb-0 text-capitalize" data-toggle="collapse" href="#bonusAccordion">Bonus and Penalty </a> </div>
                     </div>
                     <div id="bonusAccordion" class="panel-collapse collapse">
                         <div class="panel-body">
                             <div class="">
                                 <div class="row">
                                     <div class="col-md-12">
                                         <table class="table">
                                             <tr><td><strong>BONUSES</strong><br /></td></tr>
                                             <?php foreach ($bonuses as $bonus) : ?>
                                                 <tr>
                                                     <td>
                                                         Currency: <img src="assets/images/currencies/<?= $bonus->currency; ?>.gif" alt="<?= $bonus->currency; ?>" /><br />
                                                         Amount: $<?= number_format($bonus->amount, 2); ?> <br />
                                                         Total: <?= number_format($bonus->total); ?>
                                                     </td>
                                                 </tr>
                                             <?php endforeach; ?>
                                             <tr><td><strong>PENALTIES</strong><br /></td></tr>
                                             <?php foreach ($penalties as $penalty) : ?>
                                                 <tr>
                                                     <td>
                                                     	Currency: <img src="assets/images/currencies/<?= $penalty->currency; ?>.gif" alt="<?= $penalty->currency; ?>" /><br />
                                                         Amount: $<?= number_format($penalty->amount, 2); ?> <br />
                                                         Total: <?= number_format($penalty->total); ?>
                                                     </td>
                                                 </tr>
                                             <?php endforeach; ?>
                                             <tr>
                                                 <td>
                                                     <strong>Actions:</strong><br />
                                                     <h3 class="heading-title text-uppercase">
                                                         <a href="<?= $route->urlFor('admin-add-bonus-view', ['user_id' => $user->ID]) ?>" class="btn btn-dark btn-flat btn-theme-colored2">Add Bonus</i></a>
                                                         <a href="<?= $route->urlFor('admin-transactions', [], ['userID' => $user->ID, 'logType'=>'bonus']) ?>" class="btn btn-dark btn-flat btn-theme-colored">Bonus History</i></a>
                                                         <a href="<?= $route->urlFor('admin-add-penalty-view', ['user_id' => $user->ID]) ?>" class="btn btn-dark btn-flat btn-theme-colored2">Add Penalty</i></a>
                                                         <a href="<?= $route->urlFor('admin-transactions', [], ['userID' => $user->ID, 'logType'=>'penalty']) ?>" class="btn btn-dark btn-flat btn-theme-colored">Penalty History</i></a>
                                                     </h3>
                                                 </td>
                                             </tr>
                                         </table>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                </div>
                
                <div class="panel panel-default mb-20">
                     <div class="panel-heading">
                         <div class="panel-title"> <a class="collapsed font-24 pt-0 pb-0 text-capitalize" data-toggle="collapse" href="#withdrawalsAccordion">Withdrawals </a> </div>
                     </div>
                     <div id="withdrawalsAccordion" class="panel-collapse collapse">
                         <div class="panel-body">
                             <div class="">
                                 <div class="row">
                                     <div class="col-md-12">
                                         <table class="table">
                                             <?php foreach ($withdrawals as $withdrawal) : ?>
                                                 <tr>
                                                     <td>
                                                         <strong>
                                                             <?= strtoupper($withdrawal->status); ?>
                                                         </strong><br />
                                                         Currency: <img src="assets/images/currencies/<?= $withdrawal->currency; ?>.gif" alt="<?= $withdrawal->currency; ?>" /><br />
                                                         Amount: $<?= number_format($withdrawal->amount, 2); ?> <br />
                                                         Total: <?= number_format($withdrawal->total); ?>
                                                     </td>
                                                 </tr>
                                             <?php endforeach; ?>
                                             <tr>
                                                 <td>
                                                     <strong>Actions:</strong><br />
                                                     <h3 class="heading-title text-uppercase">
                                                         <a href="<?= $route->urlFor('admin-withdrawals', [], ['userID' => $user->ID]) ?>" class="btn btn-dark btn-flat btn-theme-colored">Full Details</i></a>
                                                     </h3>
                                                 </td>
                                             </tr>
                                         </table>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="panel panel-default mb-20">
                     <div class="panel-heading">
                         <div class="panel-title"> <a class="collapsed font-24 pt-0 pb-0 text-capitalize" data-toggle="collapse" href="#LogsAccordion">Transaction Logs </a> </div>
                     </div>
                     <div id="LogsAccordion" class="panel-collapse collapse">
                         <div class="panel-body">
                             <div class="">
                                 <div class="row">
                                     <div class="col-md-12">
                                         <table class="table">
                                             <?php foreach ($transactions as $transaction) : ?>
                                                 <tr>
                                                     <td>
                                                         <strong>
                                                             <?= strtoupper($transaction->type); ?>
                                                         </strong><br />
                                                         Currency: <img src="assets/images/currencies/<?= $transaction->currency; ?>.gif" alt="<?= $transaction->currency; ?>" /><br />
                                                         Amount: $<?= number_format($transaction->amount, 2); ?> <br />
                                                         Total: <?= number_format($transaction->total); ?>
                                                     </td>
                                                 </tr>
                                             <?php endforeach; ?>
                                             <tr>
                                                 <td>
                                                     <strong>Actions:</strong><br />
                                                     <h3 class="heading-title text-uppercase">
                                                         <a href="<?= $route->urlFor('admin-transactions', [], ['userID' => $user->ID]) ?>" class="btn btn-dark btn-flat btn-theme-colored">Full Details</i></a>
                                                     </h3>
                                                 </td>
                                             </tr>
                                         </table>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             <?php endif;?>
         </div>
     </div>
 </div>