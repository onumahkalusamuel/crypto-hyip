 <?php $this->addAttribute('pageTitle', 'Reset Update'); ?>
 <?php $this->setLayout('public/layout.php'); ?>

 <div class="main-content">

     <?php echo $this->fetch('public/components/page-inner-header.php'); ?>

     <section>
         <div class="container">
             <div class="row">
                 <div class="col-md-6 col-md-offset-3">
                     <?php if ($data['success'] == true) : ?>
                         <?php if (!empty($data['message'])) : ?>
                             <div class="col-md-12">
                                 <strong class="alert alert-success text-center display-block text-uppercase">
                                     <?php echo $data['message']; ?>
                                 </strong>
                             </div>
                             <?php if (empty($data['hide_form'])) : ?>

                                 <form id="reset_password" name="login-form" class="register-form" method="post">
                                     <input type="hidden" name="csrf" value="<?= $data['csrf']; ?>" />
                                     <div class="icon-box mb-0 p-0">
                                         <a href="#" class="icon icon-bordered icon-rounded icon-sm pull-left mb-0 mr-10">
                                             <i class="pe-7s-users"></i>
                                         </a>
                                         <h4 class="text-gray pt-10 mt-0 mb-30">Set New <span class="text-theme-colored2">Password</span></h4>
                                     </div>
                                     <hr>
                                     <div class="row">
                                         <div class="form-group col-md-12">
                                             <label>New Password</label>
                                             <input name="newPassword" class="form-control" type="newPassword" required />
                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <button class="btn btn-theme-colored2 btn-dark btn-lg btn-block mt-15" type="submit" data-loading-text="Please wait...">Update</button>
                                     </div>
                                     <div class="form-group" style="display: flex;justify-content: space-between;">
                                         <span>
                                             <a href="<?= $route->urlFor('page', ['page' => 'login']); ?>" class="heading-line-bottom m-0">Log into Account
                                             </a>
                                         </span>
                                         <span>
                                             <a href="<?= $route->urlFor('page', ['page' => 'register']); ?>" class="heading-line-bottom m-0">Register New Account
                                             </a>
                                         </span>
                                     </div>
                                 </form>
                             <?php endif; ?>
                         <?php endif; ?>
                     <?php else : ?>
                         <?php if (empty($data['message'])) : ?>
                             <strong class="alert alert-danger text-center display-block text-uppercase">
                                 <?php echo $data['message']; ?>
                             </strong>
                         <?php endif; ?>
                     <?php endif; ?>
                 </div>
             </div>
         </div>
     </section>

     <script type="text/javascript">
         $("#reset_password").validate();
     </script>

 </div>