 <?php $this->addAttribute('pageTitle', 'Reset Password'); ?>
 <?php $this->setLayout('public/layout.php'); ?>

 <div class="main-content">

     <?php echo $this->fetch('public/components/page-inner-header.php'); ?>

     <section>
         <div class="container">
             <div class="row">
                 <div class="col-md-6 col-md-offset-3">
                     <form id="reset_password" name="login-form" class="register-form" method="post">
                         <div class="icon-box mb-0 p-0">
                             <a href="#" class="icon icon-bordered icon-rounded icon-sm pull-left mb-0 mr-10">
                                 <i class="pe-7s-users"></i>
                             </a>
                             <h4 class="text-gray pt-10 mt-0 mb-30">Reset Password</h4>
                         </div>
                         <hr>
                         <div class="row">
                             <div class="form-group col-md-12">
                                 <label>Email Address</label>
                                 <input name="email" class="form-control" type="email" required />
                             </div>
                         </div>
                         <div class="form-group">
                             <button class="btn btn-dark btn-lg btn-block mt-15" type="submit">Send Reset Link</button>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     </section>

     <script type="text/javascript">
         $("#reset_password").validate({
             submitHandler: function(form) {
                 var form_btn = $(form).find('button[type="submit"]');
                 var form_result_div = '#form-result';
                 $(form_result_div).remove();
                 form_btn.before('<div id="form-result" class="alert alert-success" role="alert" style="display: none;"></div>');
                 var form_btn_old_msg = form_btn.html();
                 form_btn.html(form_btn.prop('disabled', true).data("loading-text"));
                 $(form).ajaxSubmit({
                     dataType: 'json',
                     success: function(data) {
                         if (data.status == 'true') {
                             $(form).find('.form-control').val('');
                         }
                         form_btn.prop('disabled', false).html(form_btn_old_msg);
                         $(form_result_div).html(data.message).fadeIn('slow');
                         setTimeout(function() {
                             $(form_result_div).fadeOut('slow')
                         }, 6000);
                     }
                 });
             }
         });
     </script>

     <?php echo $this->fetch('public/components/section-live-table.php'); ?>

 </div>