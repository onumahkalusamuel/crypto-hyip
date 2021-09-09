 <?php $this->addAttribute('pageTitle', 'Login'); ?>
 <?php $this->setLayout('public/layout.php'); ?>

 <div class="main-content">

     <?php echo $this->fetch('public/components/page-inner-header.php'); ?>

     <section>
         <div class="container">
             <div class="row">
                 <div class="col-md-6 col-md-offset-3">
                     <?php echo $this->fetch('public/components/flash-bag.php'); ?>
                     <form id="login_form" name="login-form" class="register-form" method="post">
                         <div class="icon-box mb-0 p-0">
                             <a href="#" class="icon icon-bordered icon-rounded icon-sm pull-left mb-0 mr-10">
                                 <i class="pe-7s-users"></i>
                             </a>
                             <h4 class="text-gray pt-10 mt-0 mb-30">Login <span class="text-theme-colored2">Now</span></h4>
                         </div>
                         <hr>
                         <div class="row">
                             <div class="form-group col-md-12">
                                 <label>Username or Email Address</label>
                                 <input name="email" class="form-control" type="text" required />
                             </div>
                         </div>
                         <div class="row">
                             <div class="form-group col-md-12">
                                 <label for="form_choose_password">Password</label>
                                 <input id="form_choose_password" name="password" type="password" class="form-control" required />
                             </div>
                         </div>
                         <div class="form-group">
                             <button class="btn btn-theme-colored2 btn-lg btn-block mt-15" type="submit">Login Now</button>
                         </div>
                         <div class="form-group" style="display: flex;justify-content: space-between;">
                             <span>
                                 <a href="<?= $route->urlFor('page', ['page' => 'register']); ?>" class="heading-line-bottom m-0">Register New Account
                                 </a>
                             </span>
                             <span>
                                 <a href="<?= $route->urlFor('page', ['page' => 'reset-password']); ?>" class="heading-line-bottom m-0">Reset Password
                                 </a>
                             </span>
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

 </div>