{include file='admin/header.tpl' pageTitle='Settings'}

{assign var=settings value=$data.settings}
{assign var=activeCurrencies value=","|explode:$settings.activeCurrencies}

<div class="main-content">

     <div class="container pb-40 pt-20">

         <div id="accordion" class="panel-group toggle accordion-classic accordion-classic-theme-colored2 accordion-flat">
             <div class="panel panel-default mb-20">
                 <div class="panel-heading">
                     <div class="panel-title"> <a class="active font-24 pt-0 pb-0 text-capitalize" data-parent="#accordion" data-toggle="collapse" href="#profileAccordion">Settings </a> </div>
                 </div>
                 <div id="profileAccordion" class="panel-collapse collapse in">
                     <div class="panel-body">
                         <form method="POST" action="<?= $route->urlFor('admin-update-settings'); ?>">
                             
                            <div class="form-group row">
                                 <label for="activeCurrencies" class="col-sm-2 col-form-label">Active Currencies</label>
                                 <div class="col-sm-10">
                                     <input class="form-control" id="activeCurrencies" name="activeCurrencies" value="<?= $settings['activeCurrencies']; ?>">
                                     <span class="font-12 p-0 m-0">separate currencies by comma (,). do not add spaces. e.g. (ltc,btc,doge,eth)</span>
                                 </div>
                             </div>
                             
                             <?php foreach($activeCurrencies as $currency):?>
                             <div class="form-group row">
                                 <label for="<?=$currency;?>DepositAddress" class="col-sm-2 col-form-label"><?=strtoupper($currency);?> Deposit Address</label>
                                 <div class="col-sm-10">
                                     <input type="text" class="form-control" name="<?=$currency;?>DepositAddress" id="<?=$currency;?>DepositAddress" value="<?= $settings[$currency .'DepositAddress']; ?>">
                                 </div>
                             </div>
                             <?php endforeach;?>
                             <div class="form-group row">
                                 <label for="minWithdrawal" class="col-sm-2 col-form-label">Minimum Withdrawal Amount</label>
                                 <div class="col-sm-10">
                                     <input type="number" min="0" class="form-control" id="minWithdrawal" name="minWithdrawal" value="<?= $settings['minWithdrawal']; ?>">
                                 </div>
                             </div>
                             <div class="form-group row">
                                 <label for="payReferral" class="col-sm-2 col-form-label">Pay Referral Bonus?</label>
                                 <div class="col-sm-10">
                                     <select class="form-control" id="payReferral" name="payReferral" value="<?= $settings['payReferral']; ?>">
                                         <option value="1">Yes</option>
                                         <option value="0">No</option>
                                     </select>
                                 </div>
                             </div>
                             <div class="form-group row">
                                 <label for="confirmAction" class="col-sm-2 col-form-label">Enter Your Password</label>
                                 <div class="col-sm-10">
                                     <input type="password" class="form-control" name="confirmPassword" id="confirmAction" required />
                                 </div>
                             </div>
                             <div class="form-group row">
                                 <div class="col-sm-10">
                                     <button type="submit" class="btn btn-theme-colored2 btn-primary">Submit</button>
                                 </div>
                             </div>
                         </form>
                     </div>
                 </div>
             </div>
             <div class="panel panel-default mb-20">
                 <div class="panel-heading">
                     <div class="panel-title"> <a class="collapsed font-24 pt-0 pb-0 text-capitalize" data-parent="#accordion" data-toggle="collapse" href="#adminAccordion">Admin Password </a> </div>
                 </div>
                 <div id="adminAccordion" class="panel-collapse collapse">
                     <div class="panel-body">
                         <h5>To change admin password, generate OTP. The OTP will be sent to admin email and will expire in <strong>5 minutes</strong>.<br/> <a class="btn text-uppercase btn-theme-colored btn-flat" href="<?= $route->urlFor('admin-update-admin-otp'); ?>">Click here</a> to generate OTP now.</h5><br />
                         <form method="POST" action="<?= $route->urlFor('admin-update-admin'); ?>">
                             <div class="form-group row">
                                 <label for="newPassword" class="col-sm-2 col-form-label">Enter New Password</label>
                                 <div class="col-sm-10">
                                     <input type="password" class="form-control" name="newPassword" id="newPassword">
                                 </div>
                             </div>
                             <div class="form-group row">
                                 <label for="newPasswordAgain" class="col-sm-2 col-form-label">Enter New Password Again</label>
                                 <div class="col-sm-10">
                                     <input type="password" min="0" class="form-control" id="newPasswordAgain" name="newPasswordAgain">
                                 </div>
                             </div>
                             <div class="form-group row">
                                 <label for="oldPassword" class="col-sm-2 col-form-label">Enter Old Password</label>
                                 <div class="col-sm-10">
                                     <input type="password" class="form-control" id="oldPassword" name="oldPassword" />
                                 </div>
                             </div>
                             <div class="form-group row">
                                 <label for="oldPassword" class="col-sm-2 col-form-label">Enter Generated OTP</label>
                                 <div class="col-sm-10">
                                     <input type="text" class="form-control" id="OTP" name="OTP" />
                                 </div>
                             </div>
                             <div class="form-group row">
                                 <div class="col-sm-10">
                                     <button type="submit" class="btn btn-theme-colored2 btn-primary">Submit</button>
                                 </div>
                             </div>
                         </form>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>


{include file='admin/footer.tpl'}
