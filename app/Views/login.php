<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">



<head>

    <meta charset="utf-8" />
    <title>Al Fuzail Engineering Services WLL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>public/assets/images/favicon.png">

    <!-- Layout config Js -->
    <script src="<?php echo base_url(); ?>public/assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="<?php echo base_url(); ?>public/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?php echo base_url(); ?>public/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?php echo base_url(); ?>public/assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="<?php echo base_url(); ?>public/assets/css/custom.min.css" rel="stylesheet" type="text/css" />
    <!--alertify css-->
    <link href="<?php echo base_url(); ?>public/assets/css/alertify.min.css" rel="stylesheet">
    
    <link href="<?php echo base_url(); ?>public/assets/css/alertify.default.min.css" rel="stylesheet">



</head>

<body>

    <div class="auth-page-wrapper login-Main-sec">
        <!-- auth page bg -->
       

        <!-- auth page content -->
        <div class="auth-page-content login-f-sec">
            <div class="container">
               
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-6">
                        <div class="card ">

                            <div class="card-body p-4">
							
							    <div class="row align-items-center">
							        <div class="col-lg-5">
							            <div class="login-logo">
								 
								            <img src="<?php echo base_url(); ?>public/assets/images/logo.png" alt="">
								 
								        </div>
							
							        </div>
							
                                    <div class="col-lg-7">
                                    
                                        <div class="p-2 mt-4">
                                            <!--<form id="login_form">--->
                                            <?php echo form_open(base_url().'Check'); ?>

                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Username</label>
                                                    <input type="text" class="form-control" name="user_name" id="username" placeholder="Enter username" required>
                                                </div>

                                                <div class="mb-3">
                                                    
                                                    <label class="form-label" for="password-input">Password</label>
                                                    <div class="position-relative auth-pass-inputgroup mb-3">
                                                        <input type="password" class="form-control pe-5 password-input" name="password" placeholder="Enter password" id="password-input" required>
                                                        <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                                    </div>
                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="remember_me" value="" id="auth-remember-check">
                                                    <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                                </div>

                                                <div class="mt-4">
                                                    <button class="btn btn-success w-100" type="submit">Sign In</button>
                                                </div>

                                            
                                            </form>
                                        </div>
                                    
                                    </div>
							
							
							
							    </div>
							
							
							
							
                              
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                     

                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer lfooter">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-muted">&copy;
                                <script>document.write(new Date().getFullYear())</script> Al Fuzail Engineering Services WLL. Web Designed  by Techsoft
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="<?php echo base_url(); ?>public/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>public/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="<?php echo base_url(); ?>public/assets/libs/node-waves/waves.min.js"></script>
    <script src="<?php echo base_url(); ?>public/assets/libs/feather-icons/feather.min.js"></script>
    <script src="<?php echo base_url(); ?>public/assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="<?php echo base_url(); ?>public/assets/js/plugins.js"></script>

    
    <!-- particles js -->

    <script src="<?php echo base_url(); ?>public/assets/libs/particles.js/particles.js"></script>
    <!-- particles app js -->
    <script src="<?php echo base_url(); ?>public/assets/js/pages/particles.app.js"></script>
    <!-- password-addon init -->
    <script src="<?php echo base_url(); ?>public/assets/js/pages/password-addon.init.js"></script>
    <!--alertify css-->
    <script src="<?php echo base_url(); ?>public/assets/js/alertify.min.js"></script> 
    
    <script>alertify.set('notifier','position', 'bottom-center');</script>

    <?php
    
    if(session()->getFlashdata('error'))
    {

    ?>

    <script>alertify.error('<?php echo session()->getFlashdata('error'); ?>').delay(8).dismissOthers();</script>

    <?php } ?>

</body>




</html>