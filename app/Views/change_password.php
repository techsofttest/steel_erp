<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">



<head>

    <meta charset="utf-8" />
    <title><?php echo site_title//Defined in app/constants ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />
    <meta content="" name="author" />
    
       
    <!--header section start-->

    <?php echo view('includes/header');?>

    <!--header section end-->



    <!--alertify css-->
    <link href="<?php echo base_url(); ?>public/assets/css/alertify.min.css" rel="stylesheet">
    
    <link href="<?php echo base_url(); ?>public/assets/css/alertify.default.min.css" rel="stylesheet">


        
    <!--sidebar section start-->

    <?php echo view('includes/sidebar'); ?>

    <!--sidebar section end-->

    
    <!-- Vertical Overlay-->
    <div class="vertical-overlay"></div>



     <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col">

                            <div class="h-100">

                                
                                <!--end row-->
								<div class="row project-wrapper">



                                <div class="row mx-3 my-4">

                                    <div class="col-lg-12 text-center">

                                    <h4>Change Password</h4>

                                    </div>
                                
                                </div>

                        

                                <form method="POST">


                                <div class="row mx-3 my-4">


                                    <div class="col-lg-3">

                                    <label for="old_pass">Old Password</label>

                                    </div>


                                    <div class="col-lg-9">

                                    <input type="password" class="form-control" name="old_pass" id="old_pass" required>

                                    </div>


                                </div>



                                <div class="row mx-3 my-4">


                                <div class="col-lg-3">

                                <label for="new_pass">New Password</label>

                                </div>

                                <div class="col-lg-9">

                                <input type="password" class="form-control" name="new_pass" id="new_pass" required>

                                </div>


                                </div>



                                <div class="col-lg-12 text-center">

                                <button  type="submit" class="btn btn-primary"> Update </button>



                                </div>





                                </form>


                                </div> <!-- end col -->


                            </div>

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
   

            <!--footer section start-->

            <?php echo view('includes/footer'); ?>

            <!--footer section end-->

            <script src="<?php echo base_url(); ?>public/assets/libs/swiper/swiper-bundle.min.js"></script>

                <!-- Dashboard init -->
            <script src="<?php echo base_url(); ?>public/assets/js/pages/dashboard-ecommerce.init.js"></script>


            <script src="<?php echo base_url(); ?>public/assets/js/alertify.min.js"></script> 

    
            <script>alertify.set('notifier','position', 'top-center');</script>

            <?php
            
            if(session()->getFlashdata('error'))
            {

            ?>

            <script>alertify.error('<?php echo session()->getFlashdata('error'); ?>').delay(3).dismissOthers();</script>

            <?php } 

            if(session()->getFlashdata('success'))
            {

            ?>

            <script>alertify.success('<?php echo session()->getFlashdata('success'); ?>').delay(3).dismissOthers();</script>

            <?php } ?>

    


	
	
</body>



</html>