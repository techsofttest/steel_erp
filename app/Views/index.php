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
                        <div class="col-xxl-8">
                            <div class="row">
                                <div class="col-xl-4">
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-primary-subtle text-primary rounded-2 fs-2">
                                                        <i data-feather="briefcase" class="text-primary"></i>
                                                    </span>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden ms-3">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Sales</p>
                                                    <div class="d-flex align-items-center mb-3">
                                                        <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value" data-target="<?= $sales_count; ?>">0</span></h4>
                                                        <!-- <span class="badge bg-danger-subtle text-danger fs-12"><i class="ri-arrow-down-s-line fs-13 align-middle me-1"></i>5.02 %</span> -->
                                                    </div>
                                                    <p class="text-muted text-truncate mb-0">Sales this month</p>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div>
                                </div><!-- end col -->

                                <div class="col-xl-4">
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-warning-subtle text-warning rounded-2 fs-2">
                                                        <i data-feather="award" class="text-warning"></i>
                                                    </span>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <p class="text-uppercase fw-medium text-muted mb-3">Customers</p>
                                                    <div class="d-flex align-items-center mb-3">
                                                        <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value" data-target="<?= $customers_count; ?>">0</span></h4>
                                                        <!-- <span class="badge bg-success-subtle text-success fs-12"><i class="ri-arrow-up-s-line fs-13 align-middle me-1"></i>3.58 %</span> -->
                                                    </div>
                                                    <p class="text-muted mb-0">Added this month</p>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div>
                                </div><!-- end col -->

                                <div class="col-xl-4">
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-info-subtle text-info rounded-2 fs-2">
                                                        <i data-feather="clock" class="text-info"></i>
                                                    </span>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden ms-3">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Enquiries</p>
                                                    <div class="d-flex align-items-center mb-3">
                                                        <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value" data-target="<?= $enquiry_count; ?>">0</span></h4>
                                                        <!-- <span class="badge bg-danger-subtle text-danger fs-12"><i class="ri-arrow-down-s-line fs-13 align-middle me-1"></i>10.35 %</span> -->
                                                    </div>
                                                    <p class="text-muted text-truncate mb-0">Enquiries this month</p>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div>
                                </div><!-- end col -->
                            </div><!-- end row -->

                                <div class="row">
                                    <div class="col-xl-3 col-md-6">
                                        <!-- card -->
                                        <div class="card card-animate">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1 overflow-hidden">
                                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> Accounts Module</p>
                                                    </div>
                                                   
                                                </div>
                                                <div class="d-flex align-items-end justify-content-between mt-4">
                                                    <div>
                                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="559.25">0</span>k </h4>
                                                        <a href="#" class="text-decoration-underline">View All</a>
                                                    </div>
                                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title bg-success-subtle rounded fs-3">
                                                            <i class="bx bx-dollar-circle text-success"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div><!-- end card body -->
                                        </div><!-- end card -->
                                    </div><!-- end col -->

                                    <div class="col-xl-3 col-md-6">
                                        <!-- card -->
                                        <div class="card card-animate">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1 overflow-hidden">
                                                     <p class="text-uppercase fw-medium text-muted text-truncate mb-0">CRM Module</p>
                                                    </div>
                                                  
                                                </div>
                                                <div class="d-flex align-items-end justify-content-between mt-4">
                                                    <div>
                                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="36894">0</span></h4>
                                                        <a href="#" class="text-decoration-underline">View all </a>
                                                    </div>
                                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title bg-info-subtle rounded fs-3">
                                                            <i class="bx bx-shopping-bag text-info"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div><!-- end card body -->
                                        </div><!-- end card -->
                                    </div><!-- end col -->

                                    <div class="col-xl-3 col-md-6">
                                        <!-- card -->
                                        <div class="card card-animate">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1 overflow-hidden">
                                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Procurement Module</p>
                                                    </div>
                                                   
                                                </div>
                                                <div class="d-flex align-items-end justify-content-between mt-4">
                                                    <div>
                                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="183.35">0</span>M </h4>
                                                        <a href="#" class="text-decoration-underline">View All</a>
                                                    </div>
                                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title bg-warning-subtle rounded fs-3">
                                                            <i class="bx bx-user-circle text-warning"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div><!-- end card body -->
                                        </div><!-- end card -->
                                    </div><!-- end col -->

                                    <div class="col-xl-3 col-md-6">
                                        <!-- card -->
                                        <div class="card card-animate">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1 overflow-hidden">
                                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> Human Resource</p>
                                                    </div>
                                                 
                                                </div>
                                                <div class="d-flex align-items-end justify-content-between mt-4">
                                                    <div>
                                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="165.89">0</span>k </h4>
                                                        <a href="#" class="text-decoration-underline">View All</a>
                                                    </div>
                                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title bg-primary-subtle rounded fs-3">
                                                            <i class="bx bx-wallet text-primary"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div><!-- end card body -->
                                        </div><!-- end card -->
                                    </div><!-- end col -->
                                </div> <!-- end row-->

                               

                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="card">
                                            <div class="card-header align-items-center d-flex">
                                                <h4 class="card-title mb-0 flex-grow-1">New Customers</h4>
                                               
                                            </div><!-- end card header -->

                                            <div class="card-body">
                                                <div class="table-responsive table-card m-1">
                                                    <table class="table table-hover">


                                                        <thead>

                                                            <tr>

                                                            <th>Name</th>

                                                            <th>Email</th>

                                                            <th>Term</th>

                                                            <th>Period</th>

                                                            <th>Days</th>

                                                            </tr>

                                                        </thead>


                                                        <tbody>

                                                            <?php foreach($customers as $customer) { ?>
                                                            <tr>
                                                                <td>
                                                                <div class="d-flex align-items-center">
                                                                        <div class="flex-shrink-0 me-2">
                                                                   <?php echo $customer->cc_customer_name; ?>
                                                            </div>
                                                            </div>
                                                                </td>
                                                                <td>
                                                                    <?php echo $customer->cc_email; ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $customer->cc_credit_term; ?>
                                                                </td>
                                                                <td>
                                                                   <?php echo $customer->cc_credit_period; ?>
                                                                </td>
                                                                <td>
                                                                <?php echo $customer->cc_credit_limit; ?>
                                                                </td>
                                                            </tr>
                                                            <?php } ?>
                                                           
                                                        </tbody>
                                                    </table>
                                                </div>

                                              
                                            </div>
                                        </div>
                                    </div>





                                    <div class="col-xl-12">
                                        <div class="card">
                                            <div class="card-header align-items-center d-flex">
                                                <h4 class="card-title mb-0 flex-grow-1">New Products</h4>
                                               
                                            </div><!-- end card header -->

                                            <div class="card-body">
                                                <div class="table-responsive table-card m-1">
                                                    <table class="table table-hover">


                                                        <thead>

                                                            <tr>

                                                            <th>Code</th>

                                                            <th>Details</th>

                                                            <th>Added On</th>
                                                           
                                                            </tr>

                                                        </thead>


                                                        <tbody>

                                                            <?php foreach($products as $product) { ?>
                                                            <tr>
                                                                <td>
                                                                   <?php echo $product->product_code; ?>
                                                                </td>

                                                                <td>
                                                                    <?php echo $product->product_details; ?>
                                                                </td>

                                                                <td>
                                                                   <?php echo date('d-m-Y',strtotime($product->product_added_date)); ?>
                                                                </td>
                                                               
                                                            </tr>
                                                            <?php } ?>
                                                           
                                                        </tbody>
                                                    </table>
                                                </div>

                                              
                                            </div>
                                        </div>
                                    </div>

                                   



                                </div> <!-- end row-->

                             

                            </div> <!-- end .h-100-->

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



            <!---add account type section start-->

            <script>
                $(document).ready(function(){
                    $('#account_head_form').submit(function(e){
                        e.preventDefault();
                        if( ($('input[name="aname"]').val()==""))
                        {
                            alertify.error('Fill required fields').delay(4).dismissOthers();
                            return false;
                        }
                        $.ajax({

                            url : "<?php echo base_url(); ?>Accounts/AccountHead/Add",

                            method : "POST",

                            data : $('#account_head_form').serialize(),

                            success:function(data)
                            {
                                var data = JSON.parse(data);

                                $("#account_type_id").html(data.output);

                                $('#account_type_id').css('display', 'block');

                                $("#account_type_inp").val('');

                                alertify.success('Account Head Added Successfully').delay(8).dismissOthers();
                            }


                        });
                        
                    });
                });
            </script>

            <!--add account type section end-->


            <!--account type edit modal  section start--> 
            <script>

                
                $("body").on('click', '.acctype_edit', function(){ 
                    var acctype = $(this).data('acctype');
                    //alert(acctype);
                    $.ajax({

                        url : "<?php echo base_url(); ?>Accounts/AccountHead/HeadEdit",

                        method : "POST",

                        data: {account_id: acctype},

                        success:function(data)
                        {   
                            var data = JSON.parse(data);

                            $("#modal_account_type").val(data.account_type);

                            $('#EditModal').modal('show');
                            
                            $("#modal_acc_type_id").val(acctype);
                            
                        }


                    });
                   
                  
                });

            </script>
            <!--account type edit modal section end-->

            

            <!--account type edit section start-->

            <script>
                $(document).ready(function(){
                    $('#account_head_edit_form').submit(function(e){
                       
                        e.preventDefault();
                        
                        if( ($('input[name="edit_aname"]').val()==""))
                        {
                            alertify.error('Fill required fields').delay(4).dismissOthers();
                            return false;
                        }
                        $.ajax({

                            url : "<?php echo base_url(); ?>Accounts/AccountHead/Update",

                            method : "POST",

                            data : $('#account_head_edit_form').serialize(),

                            success:function(data)
                            {
                                var data = JSON.parse(data);

                                $("#account_type_id").html(data.output);

                                $('#account_type_id').css('display', 'block');

                                $('#EditModal').modal('hide');

                                alertify.success('Account Head Edit Successfully').delay(8).dismissOthers();
                            }


                        });
                    });
                });
            </script>

            <!--account type edit section end-->


            <!--account type delete section start-->

            <script>
                
                $("body").on('click', '.acctype_delete', function(){ 
                    
                    if (!confirm('Are you absolutely sure you want to delete?')) return;
                    var acctype = $(this).data('acctypedel');
                    $.ajax({

                        url : "<?php echo base_url(); ?>Accounts/AccountHead/Delete",

                        method : "POST",

                        data: {account_id: acctype},

                        success:function(data)
                        {
                            var data = JSON.parse(data);

                            $("#account_type_id").html(data.output);

                            $('#account_type_id').css('display', 'block');

                            alertify.success('Account Head Delete Successfully').delay(8).dismissOthers();
                        }


                    });

                });
            </script>

            <!--accoiunt type delete section end-->
            
	
	
	
</body>



</html>