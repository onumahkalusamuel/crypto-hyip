 <?php $this->addAttribute('pageTitle', 'Register'); ?>
 <?php $this->setLayout('public/layout.php'); ?>

 <div class="main-content">

     <?php echo $this->fetch('public/components/page-inner-header.php'); ?>

     <section>
         <div class="container">
             <div class="row">
                 <div class="col-md-6 col-md-offset-3">
                     <?php echo $this->fetch('public/components/flash-bag.php'); ?>
                     <form id="form" name="login-form" class="register-form" method="post">
                         <div class="icon-box mb-0 p-0">
                             <a href="#" class="icon icon-bordered icon-rounded icon-sm pull-left mb-0 mr-10">
                                 <i class="pe-7s-users"></i>
                             </a>
                             <h4 class="text-gray pt-10 mt-0 mb-30">Register <span class="text-theme-colored2">For a New Account</span></h4>
                         </div>
                         <hr>
                         <div class="row">
                             <div class="form-group col-md-12">
                                 <label>Full Name</label>
                                 <input name="fullName" class="form-control" type="text" required />
                             </div>
                             <div class="form-group col-md-12">
                                 <label>Username</label>
                                 <input name="userName" class="form-control" type="text" placeholder="(optional)" />
                             </div>
                             <div class="form-group col-md-12">
                                 <label>Email Address</label>
                                 <input name="email" class="form-control" type="email" required />
                             </div>
                             <div class="form-group col-md-12">
                                 <label for="form_choose_password">Password</label>
                                 <input id="form_choose_password" name="password" type="text" class="form-control" required />
                             </div>
                             <div class="form-group col-md-12">
                                 <label for="btcAddress">Bitcoin Deposit Address</label>
                                 <input id="btcAddress" name="btcAddress" type="text" class="form-control" />
                             </div>
                             <div class="form-group col-md-12">
                                 <label for="secretQuestion">Account Secret Question</label>
                                 <input id="secretQuestion" name="secretQuestion" type="text" class="form-control" required />
                             </div>
                             <div class="form-group col-md-12">
                                 <label for="secretAnswer">Account Secret Answer</label>
                                 <input id="secretAnswer" name="secretAnswer" type="text" class="form-control" required />
                             </div>
                             <div class="form-group col-md-12">
                                 <button class="btn btn-theme-colored2 btn-lg btn-block mt-15" type="submit" data-loading-text="Please wait...">Register Now</button>
                             </div>
                             <div class="form-group col-md-12" style="display: flex;justify-content: space-between;">
                                 <span>
                                     <a href="<?= $route->urlFor('page', ['page' => 'login']); ?>" class="heading-line-bottom m-0">Log into Account
                                     </a>
                                 </span>
                                 <span>
                                     <a href="<?= $route->urlFor('page', ['page' => 'reset-password']); ?>" class="heading-line-bottom m-0">Reset Password
                                     </a>
                                 </span>
                             </div>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     </section>

     <!-- Login Form Validation-->
     <script type="text/javascript">
         $("#form").validate({
             submitHandler: function(form) {
                 var form_btn = $(form).find('button[type="submit"]');
                 var form_result_div = '#form-result';
                 $(form_result_div).remove();
                 form_btn.before('<div id="form-result" class="alert" role="alert" style="display: none;"></div>');
                 var form_btn_old_msg = form_btn.html();
                 form_btn.html(form_btn.prop('disabled', true).data("loading-text"));
                 $(form).ajaxSubmit({
                     dataType: 'json',
                     success: function(data) {
                         if (data.success === true) {
                             $(form).find('.form-control').val('');
                             $(form_result_div).removeClass("alert-danger");
                             $(form_result_div).addClass("alert-success");
                             setTimeout(function() {
                                 window.location.assign(data.redirect)
                             }, 4000)
                         } else {
                             $(form_result_div).removeClass("alert-success");
                             $(form_result_div).addClass("alert-danger");
                         }
                         form_btn.prop('disabled', false).html(form_btn_old_msg);
                         $(form_result_div).html(data.message).fadeIn('slow');
                         setTimeout(function() {
                             $(form_result_div).fadeOut('slow')
                         }, 6000);
                     },
                     error: function(e) {
                         alert(e.responseJSON.message);
                         form_btn.prop('disabled', false).html(form_btn_old_msg);
                     }
                 });
             }
         });
     </script>

 </div>
