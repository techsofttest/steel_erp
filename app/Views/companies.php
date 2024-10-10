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




        
<!--Edit Modal section start-->
<div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="#" id="update_form" class="Dashboard-form">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                
                                <div class="card-body">
                                    <div class="live-preview">
                                        
                                            <div class="row align-items-center">



                                            <div class="row">
                                            <div class="col-col-md-3 col-lg-3">
                                                    
                                                        <label for="basiInput" class="form-label">New Password</label>
                                            </div>
                                                    <div class="col-col-md-9 col-lg-9">
                                                        <input type="password" id="" value="" name="user_password" class="form-control " required>
                                                    </div>
                                                </div>
                                            


                                                <!--end col-->
                                                <input type="hidden" name="user_id" id="id" value="">
                                                
                                            
                                                
                                            </div>
                                            <!--end row-->
                                        
                                    </div>
                                        
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                
                    </div>
            <div class="modal-footer">
                <button type="submit" name="" class="btn btn btn-success">Save</button>
            </div>
        
        </form>

    </div>
</div>

</div>

<!--Edit modal section end-->









            <div class="page-content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col">

                            <div class="h-100">

                                
                                <!--end row-->
								<div class="row project-wrapper">




                                <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">View Companies</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <!-- CSRF token -->
                    <table  class="table table-bordered table-striped delTable display dataTable">
                        <thead>
                            <tr>
                                <th class="no-sort">Sl no</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                        <?php $i=1; foreach($companies as $company){ ?>

                            <tr>

                            <td><?= $i++; ?></td>

                            <td><?php echo $company->first_name." ".$company->last_name ?></td>

                            <td><?php echo $company->user_name; ?></td>

                            <td>

                            <?php 

                            if($company->user_id != session()->get('admin_id'))

                            {

                            ?>
                            <a href="javascript:void(0);" class="change_pass" data-id="<?php echo $company->user_id; ?>"><i class="ri-key-2-line"></i> Change Password</a>
                            
                            <?php }
                            else {
                            ?>

                            -

                            <?php } ?>

                            </td>

                            </tr>

                        <?php } ?>


                        </tbody>

                    </table>

                </div>
            </div>
        </div>
        <!--end col-->

                        


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



        <script>

            /*account head modal start*/ 
        $("body").on('click', '.change_pass', function(){ 

            var id = $(this).data('id');
            
            $('#EditModal').modal('show');
                    
            $("#id").val(id);
                    
            
        });
        /*####*/



        </script>




            <script>

            $(function() {
            $('#update_form').validate({
                rules: {
                    required: 'required',
                    
                },
                messages: {
                    required: 'This field is required',
                    
                },
                submitHandler: function(form) {
                    $.ajax({
                        url: "<?php echo base_url(); ?>Companies/ChangePassword",
                        method: "POST",
                        data: $(form).serialize(),
                        success: function(data) {
                            
                            alertify.success('Password Updated Successfully').delay(2).dismissOthers();
                            $('#EditModal').modal('hide');
                            datatable.ajax.reload(null,false);
                        }
                    });
                    return false; // prevent the form from submitting
                }
                });
            });


            </script>

    


	
	
</body>



</html>