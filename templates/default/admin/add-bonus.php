<?php $this->addAttribute('pageTitle', 'Add Bonus'); ?>
 <?php $this->setLayout('admin/layout.php'); ?>
 <?php

    $user = $data['user'];
    $plans = $data['plans'];
    $currencies = $data['currencies'];

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
                     <div class="panel-title"> <a class="active font-24 pt-0 pb-0 text-capitalize" data-toggle="collapse" href="#profileAccordion">Add Bonus </a> </div>
                 </div>
                 <div id="profileAccordion" class="panel-collapse collapse in">
                     <div class="panel-body">
                         <div class="">
                             <form class="row" action="<?=$route->urlFor('admin-add-bonus', ['user_id'=> $user->ID]);?>" method="POST">
                             <input type="hidden" name="ID" value="<?=$user->ID;?>"/>
                                 <div class="col-md-12">
                                     <table class="table">
                                         <tr>
                                             <td>
                                                 <strong>Full Name:</strong><br />
                                                 <?= ucwords($user->fullName); ?>
                                                 <input type="hidden" name="fullName" value="<?=$user->fullName;?>"/>
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>
                                                 <strong>Username:</strong><br />
                                                 <?= $user->userName; ?>
                                                 <input type="hidden" name="userName" value="<?=$user->userName;?>"/>
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>
                                                 <strong>Email:</strong><br />
                                                 <?= $user->email; ?>
                                                 <input type="hidden" name="email" value="<?=$user->email;?>"/>
                                             </td>
                                         </tr>
                                         <tr>
                                             <td><strong>Crypto Currency:</strong><br />
                                                 <select name="cryptoCurrency" class="form-control">
                                                 	<?php foreach($currencies as $currency):?>
                                                 	    <option value="<?=$currency;?>"><?=strtoupper($currency);?></option>
                                                 	<?php endforeach;?>
                                                 </select>
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>
                                                 <strong>Amount in Dollars:</strong><br />
                                                 <input name="amount" class="form-control" />
                                             </td>
                                         </tr>
                                         <tr>
                                             <td><strong>Usage</strong><br />
                                                 <select id="bonusUsage" name="bonusUsage" class="form-control">
                                                     <option value="toBalance" selected>Add to available balance</option>
                                                     <option value="toDeposit">Use as new investment</option>
                                                 </select>
                                             </td>
                                         </tr>
                                         <tr id="planContainer" style="display:none">
                                             <td><strong>Investment Plans</strong><br />
                                                 <select name="planID" class="form-control">
                                                     <?php foreach($plans as $plan):?>
                                                     	<option value="<?=$plan->ID;?>">
                                                     	    <?=$plan->title;?> ($<?=$plan->minimum;?> - <?=!empty($plan->maximum) ? '$' . $plan->maximum : 'above';?>)
                                                     	</option>
                                                      <?php endforeach;?>
                                                 </select>
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>
                                                 <label><input type="checkbox" name="notifyUserByEmail"> Notify user by email for this transaction.</label><br/>
                                                 <label id="payReferralCheckbox" style="display:none"><input type="checkbox" name="payReferralCommission"> Pay referral commission to upliner if transaction is eligible and referral bonus payment is turned on in settings.</label>
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>
                                                 <div>
                                                     <h3 class="heading-title">
                                                         <button type="submit" class="btn btn-dark btn-theme-colored btn-flat mb-5 text-uppercase">Add Bonus</i></button></h3>
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
         </div>
     </div>
 </div>
 
 
 <script type="text/javascript">
 
 function bonusUsageMonitor(){
 var bonusUsage = document.querySelector('#bonusUsage').value;
 
 if(bonusUsage == "toDeposit") {
     document.querySelector('#planContainer').style.display = "contents";
     document.querySelector('#payReferralCheckbox').style.display = "contents";
 }
 else {
     document.querySelector('#planContainer').style.display = "none";
     document.querySelector('#payReferralCheckbox').style.display = "none";
 }
 }
 
 document.querySelector('#bonusUsage').addEventListener('change', bonusUsageMonitor);
 </script>