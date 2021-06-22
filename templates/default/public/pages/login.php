 <?php $this->addAttribute('pageTitle', 'Login'); ?>
 <?php $this->setLayout('public/layout.php'); ?>

 <div class="main-content">

     <?php echo $this->fetch('public/components/page-inner-header.php'); ?>

     <section>
         <div class="container">
             <div class="row">
                 <div class="col-md-6 col-md-offset-3">
                     <form id="login_form" name="login-form" class="register-form" method="post">
                         <div class="icon-box mb-0 p-0">
                             <a href="#" class="icon icon-bordered icon-rounded icon-sm pull-left mb-0 mr-10">
                                 <i class="pe-7s-users"></i>
                             </a>
                             <h4 class="text-gray pt-10 mt-0 mb-30">Login Now</h4>
                         </div>
                         <hr>
                         <div class="row">
                             <div class="form-group col-md-12">
                                 <label>Email Address</label>
                                 <input name="email" class="form-control" type="email" required />
                             </div>
                         </div>
                         <div class="row">
                             <div class="form-group col-md-12">
                                 <label for="form_choose_password">Password</label>
                                 <input id="form_choose_password" name="password" type="password" class="form-control" required />
                             </div>
                         </div>
                         <div class="form-group">
                             <button class="btn btn-dark btn-lg btn-block mt-15" type="submit">Login Now</button>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     </section>

     <!-- Login Form Validation-->
     <script type="text/javascript">
         $("#login_form").validate();
     </script>

     <?php echo $this->fetch('public/components/section-live-table.php'); ?>

 </div>