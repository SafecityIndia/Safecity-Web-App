<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Safecity Forgot Password</title>
      <!-- Tell the browser to be responsive to screen width -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <meta name="description" content="">
      <meta name="author" content="Safe City"> 
      <meta name="generator" content="Safe City">
      <link href="<?php echo base_url(); ?>application/modules/auth/assets/images/favicon.png" rel="icon" type="image/png" />

      <!-- icheck bootstrap -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>application/modules/auth/assets/css/bootstrap.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>application/modules/auth/assets/css/login.css">
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <!-- /.login-logo -->

            <div class="card">
                <div class="card-body login-card-body">
                    <div class="login-logo">
                        <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>application/modules/auth/assets/images/safecity-logo.png" class="img-fluid" alt="Safecity" ></a>
                    </div>
                    <form action="<?php echo base_url('auth/forgot_pwd'); ?>" method="post">
                        <div class="forgot-screen">
                            <p class="login-box-msg text-center">Forgot Password</p>
                            <div class="input-group mb-4">
                              <div class="input-group">
                                  <div class="input-group-append">
                                      <div class="input-group-text border-right-0">
                                        <span><img src="<?php echo base_url(); ?>application/modules/auth/assets/images/feather-user.svg" alt="user"  class="img-fluid"></span>
                                      </div>
                                  </div>
                                  <input type="text" name="email" class="form-control border-left-0" placeholder="Enter Registered Email">
                              </div>
                              <!-- <?php echo form_error('email');?> -->
                              <div id="infoMessage" class="text-danger"><?php echo $message;?></div>
                            </div>
                           
                            <div class="row">
                                <!-- /.col -->
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-block purple-btn text-uppercase">Send Link</button>
                                </div>
                                <!-- /.col -->
                            </div>
                            <p class="mb-1 theme-color fog-pass mt-3 text-center">
                                <a href="<?php echo base_url('auth/login'); ?>" class="back-to-login">Back to Login</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.login-card-body -->
        </div>
        <!-- /.login-box -->

        <!-- jQuery -->
        <script src="<?php echo base_url(); ?>application/modules/auth/assets/js/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="<?php echo base_url(); ?>application/modules/auth/assets/js/bootstrap.min.js"></script>

        <script>
            $(document).ready(function(){
              $(".forgot-screen").show();
            });
        </script>
    </body>
</html>