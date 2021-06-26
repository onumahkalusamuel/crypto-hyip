 <?php $this->addAttribute('pageTitle', 'Profile'); ?>
 <?php $this->setLayout('user/layout.php'); ?>
 <?php $profile = $data['profile']; ?>

 <div class="main-content">
     <div class="container pb-40 pt-20">
         <div id="accordion" class="panel-group toggle accordion-classic accordion-classic-theme-colored2 accordion-flat">
             <div class="panel panel-default mb-20">
                 <div class="panel-heading">
                     <div class="panel-title"> <a class="active font-24 pt-0 pb-0 text-capitalize" data-toggle="collapse" href="#accordion1" aria-expanded="true">Update Profile Info</a> </div>
                 </div>
                 <div id="accordion1" class="panel-collapse collapse in">
                     <div class="panel-body">
                         <div class="">
                             <form id="profile" class="row" action="" method="post">
                                 <div class="form-group col-md-12">
                                     <label for="userName">Username:</label>
                                     <input class="form-control" id="userName" value="<?= $esc->escapeHtml($profile->userName); ?>" readonly />
                                 </div>
                                 <div class="form-group col-md-12">
                                     <label for="fullName">Full Name:</label>
                                     <input class="form-control" id="fullName" name="fullName" value="<?= $esc->escapeHtml($profile->fullName); ?>" required />
                                 </div>
                                 <div class="form-group col-md-12">
                                     <label for="email">Email Address:</label>
                                     <input class="form-control" id="email" name="email" value="<?= $esc->escapeHtml($profile->email); ?>" required />
                                 </div>
                                 <div class="form-group col-md-12">
                                     <label for="btcAddress">Bitcoin Address:</label>
                                     <input class="form-control" id="btcAddress" name="btcAddress" value="<?= $esc->escapeHtml($profile->btcAddress); ?>" />
                                 </div>
                                 <div class="form-group col-md-12">
                                     <label for="password">New Password:</label>
                                     <input class="form-control" id="password" name="password" aria-describedby="newPasswordHelp" type="password" />
                                     <span id="newPasswordHelp" class="help-block">Leave blank if you do not wish to change your password</span>
                                 </div>
                                 <div class="form-group col-md-12">
                                     <label for="confirmPassword">Confirm New Password:</label>
                                     <input class="form-control" id="confirmPassword" name="confirmPassword" type="password" />
                                 </div>
                                 <div class="form-group col-md-12">
                                     <label for="oldPassword">Old Password:</label>
                                     <input class="form-control" id="oldPassword" name="oldPassword" aria-describedby="oldPasswordHelp" type="password" required />
                                     <span id="oldPasswordHelp" class="help-block">Enter old password to validate this update</span>
                                 </div>
                                 <div class="form-group col-md-3">
                                     <br class="hidden-xs hidden-sm" />
                                     <button type="submit" class="form-control btn btn-dark btn-theme-colored2">Update Profile</button>
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
     $("#profile").validate();
 </script>