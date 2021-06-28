 <?php $this->addAttribute('pageTitle', 'Plans'); ?>
 <?php $this->setLayout('admin/layout.php'); ?>
 <?php

    $plan = $data['plan'];

    if (empty($plan->ID)) {
        header("Location: " . $route->urlFor('admin-plans'));
        exit();
    }
    ?>

 <div class="main-content">

     <div class="container pb-40 pt-20">

         <div id="accordion" class="panel-group toggle accordion-classic accordion-classic-theme-colored2 accordion-flat">
             <div class="panel panel-default mb-20">
                 <div class="panel-heading">
                     <div class="panel-title"> <a class="active font-24 pt-0 pb-0 text-capitalize" data-toggle="collapse" href="#profileAccordion">Plan Details </a> </div>
                 </div>
                 <div id="profileAccordion" class="panel-collapse collapse in">
                     <div class="panel-body">
                         <h5 class="help">
                             Modify these records to change the plans on the homepage. Note that deposits already invested has their own copy of the plan they're working with. So changes here will only affect new deposits.
                         </h5>
                         <div class="">
                             <form id="form" class="row" action="" method="POST">
                                 <div class="col-md-12">
                                     <table class="table">
                                         <tr>
                                             <td>
                                                 <strong>Plan Title:</strong><br />
                                                 <input value="<?= $plan->title; ?>" type="text" name="title" class="form-control" />
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>
                                                 <strong>Is Plan Featured?</strong><br />
                                                 <select name="hasBadge" class="form-control">
                                                     <option <?= $plan->hasBadge == '0' ? 'selected' : ''; ?> value="1">No</option>
                                                     <option <?= $plan->hasBadge == '1' ? 'selected' : ''; ?> value="1">Yes</option>
                                                 </select>
                                                 <div class="help">If set to YES, the plan will receive a <strong>FEATURED</strong> badge on the listing pages</div>
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>
                                                 <strong>Minimum Deposit:</strong><br />
                                                 <input value="<?= $plan->minimum ?>" type="number" min="0" name="minimum" class="form-control" />
                                                 <div class="help">Enter the least amount someone can pay.</div>
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>
                                                 <strong>Maximum Deposit:</strong><br />
                                                 <input value="<?= $plan->maximum; ?>" type="number" name="maximum" min="0" class="form-control" />
                                                 <div class="help">Enter the maximum amount someone can pay. Set to 0 if there is no maximum</div>
                                             </td>
                                         </tr>
                                         <tr>
                                             <td><strong>How many percent will referrals be paid?</strong><br />
                                                 <input value="<?= $plan->referralPercentage; ?>" name="referralPercentage" type="number" min="0" class="form-control" />
                                             </td>
                                         </tr>

                                         <tr>
                                             <td><strong>How should the interest be calculated? (percentatge / frequency)</strong><br />
                                                 <span class="row">
                                                     <span class="col-md-6 p-0">
                                                         <input value="<?= $plan->percentage; ?>" name="percentage" type="number" min="0" class="form-control" />
                                                     </span>
                                                     <span class="col-md-6 p-0">
                                                         <select name="profitFrequency" class="form-control">
                                                             <option <?= $plan->profitFrequency == 'end' ? 'selected' : ''; ?> value="end">End of Plan</option>
                                                             <option <?= $plan->profitFrequency == 'hourly' ? 'selected' : ''; ?> value="hourly">Hourly</option>
                                                             <option <?= $plan->profitFrequency == 'daily' ? 'selected' : ''; ?> value="daily">Daily</option>
                                                             <option <?= $plan->profitFrequency == 'weekly' ? 'selected' : ''; ?> value="weekly">Weekly</option>
                                                             <option <?= $plan->profitFrequency == 'monthly' ? 'selected' : ''; ?> value="monthly">Monthly</option>
                                                             <option <?= $plan->profitFrequency == 'yearly' ? 'selected' : ''; ?> value="yearly">Yearly</option>
                                                         </select>
                                                     </span>
                                                 </span>
                                                 <div class="help">Example: If interest is 10% daily, enter 10 in the first field, and select daily from the second field</div>
                                             </td>
                                         </tr>
                                         <tr>
                                             <td><strong>How long will the plan run? (duration / period)</strong><br />
                                                 <span class="row">
                                                     <span class="col-md-6 p-0">
                                                         <input value="<?= $plan->duration; ?>" name="duration" type="number" min="1" class="form-control" />
                                                     </span>
                                                     <span class="col-md-6 p-0">
                                                         <select name="durationType" class="form-control">
                                                             <option <?= $plan->durationType == 'hour' ? 'selected' : ''; ?> value="hour">Hour(s)</option>
                                                             <option <?= $plan->durationType == 'day' ? 'selected' : ''; ?> value="day">Day(s)</option>
                                                             <option <?= $plan->durationType == 'month' ? 'selected' : ''; ?> value="month">Month(s)</option>
                                                             <option <?= $plan->durationType == 'year' ? 'selected' : ''; ?> value="year">Year(s)</option>
                                                         </select>
                                                     </span>
                                                 </span>
                                                 <div class="help">This is the total lifespan of the plan before the deposit is automatically released. For example, if plan will last for 3 days, enter 3 in the first field and select Day(s) from second field</div>
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>
                                                 <div>
                                                     <h3 class="heading-title">
                                                         <button type="submit" class="btn btn-dark btn-theme-colored btn-flat mb-5 text-uppercase">Submit</i></button></h3>
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


 <script>
     $("#form").validate();
 </script>