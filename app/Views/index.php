<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">



<head>

    <meta charset="utf-8" />
    <title><?php echo site_title//Defined in app/constants ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />
    <meta content="" name="author" />



    <style>


        .counter-value
        {
            font-size: 25px;
        }

        .avatar-sm {
            height: 2rem !important;
            width: 2rem !important;
        }

        .counter-title
        {

            font-size:13px;

        }

        .card {
            margin-bottom: 5px !important;
            margin-top: 5px !important;
        }

        .card-body
        {
            padding:1px 15px !important;
        }

        .form-card
        {
            background-color: #dddfdf !important;
        }


    </style>
    
       
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



                                <form method="GET" >


                                <div class="col-xl-12">

                                    
                                    <div class="">

                                        <div class="card-body p-2" style="">

                                        <div class="row">



                                        <div class="col-xl-5">
                                            

                                        <div class="row align-items-end">

                                            <div class="col-4">
                                            <label class="text-uppercase fw-medium text-black text-truncate mb-0 counter-title">Accounting Period</label>
                                            </div>

                                            <div class="col-2">

                                            <select class="form-control" name="ac_year" id="">

                                                <!--<option value="2023">2023</option>-->

                                                <?php $ap_year = $this->data['accounting_year']; ?>

                                                <option value="<?php echo $ap_year-1; ?>"><?php echo $ap_year-1; ?></option>

                                                <option value="<?php echo $ap_year; ?>" Selected><?php echo $ap_year; ?></option>
                                               
                                                <option value="<?php echo $ap_year+1; ?>"><?php echo $ap_year+1; ?></option>

                                            </select>


                                            </div>


                                            <div class="col-4">


                                            <select class="form-control" name="ap_month" id="months" required>
                                                <option value="">Select a month</option>
                                                <?php
                                                $months = [
                                                    "January", "February", "March", "April",
                                                    "May", "June", "July", "August",
                                                    "September", "October", "November", "December"
                                                ];
                                                
                                                foreach ($months as $index => $month) {
                                                    
                                                   

                                                    if($index == $this->data['accounting_month']-1) 
                                                    { 
                                                    $sel ="selected"; 
                                                    }
                                                    else{ 
                                                    $sel=""; 
                                                    }

                                                    echo '<option value="' . ($index + 1) . '" '.$sel.'>' . $month . '</option>';
                                                   
                                                
                                                }
                                                ?>
                                                </select>
                                                


                                            </div>


                                            </div>  

                                        </div>




                                    <div class="col-xl-2">

                                    <div class="row align-items-end justify-content-center">

                                        <div class="col-12">

                                        <button style="width: 60%;" class="btn btn-danger" name="action" value="save" type="submit" onclick="return confirm('Change accounting period & year?\nNo transactions can be posted prior to the accounting period!');"><i class="ri-lock-fill"></i> Lock</button>

                                        </div>

                                    </div> 

                                    </div>




                                <div class="col-xl-5">  

                                    
                                    <div class="row align-items-end">

                                    <div class="col-3">
                                    <label class="text-uppercase fw-medium text-black text-truncate mb-0 counter-title">User</label>
                                    </div>

                                    <div class="col-9">
                                    
                                    <?php echo !empty(session()->get('admin_name')) ? session()->get('admin_name') : "Admin" ?>

                                    </div>

                                    </div>


                                    <div class="row align-items-end">

                                    <div class="col-3">
                                    <label class="text-uppercase fw-medium text-black text-truncate mb-0 counter-title">Period</label>
                                    </div>

                                    <div class="col-9">

                                    <?php echo date("M Y",strtotime("{$this->data['accounting_year']}-{$this->data['accounting_month']}-1")); ?>

                                    </div>

                                    </div>

                                </div>



                                        </div>
                                           

                                        </div><!-- end card body -->
                                    </div>
                                </div><!-- end col -->





                                <div class="col-xl-12">


                                    
                                    <div class="">
                                        
                                        <div class="card-body p-2" style="">

                                        <div class="row">

                                        <div class="col-xl-5">


                                        <div class="row align-items-end">

                                            <div class="col-4">
                                            <label class="text-uppercase fw-medium text-black text-truncate mb-0 counter-title">Accounting Period</label>
                                            </div>

                                            <div class="col-6">


                                            <select class="form-control" name="ac_month" id="months">
                                                <option value="">Select a month</option>
                                                <?php
                                                $months = [
                                                    "January", "February", "March", "April",
                                                    "May", "June", "July", "August",
                                                    "September", "October", "November", "December"
                                                ];
                                                
                                                foreach ($months as $index => $month) {
                                                    
                                                    if(empty($_GET['ac_month']) && $month==date('F')) 
                                                    { 
                                                    $sel ="selected"; 
                                                    }
                                                    else if(!empty($_GET['ac_month']) && $_GET['ac_month']==$index+1)
                                                    {
                                                    $sel ="selected"; 
                                                    }
                                                    else{ 
                                                    $sel=""; 
                                                    }

                                                    echo '<option value="' . ($index + 1) . '" '.$sel.'>' . $month . '</option>';
                                                
                                                }
                                                ?>
                                                </select>


                                            </div>

                                            </div>  

                                        </div>




                                        <div class="col-xl-2">


                                        <div class="row align-items-end justify-content-center">

                                        
                                            <div class="col-12">

                                            <button style="width: 60%;" class="btn btn-success" name="action" value="search" type="submit"><i class="ri-search-line"></i> Search</button>


                                            </div>

                                            </div>  

                                        </div>



                                        <div class="col-xl-5">

                                          
                                           <div class="row align-items-end">

                                            <div class="col-3">
                                            <label class="text-uppercase fw-medium text-black text-truncate mb-0 counter-title">Date</label>
                                            </div>

                                            <div class="col-9">
                                            
                                            <?php echo date('d-F-Y'); ?>

                                            </select>
                                            </div>

                                            </div>

                                        </div>



                                        </div>
                                           

                                        </div><!-- end card body -->
                                    </div>
                                </div><!-- end col -->


                                </form>

                              


                                         





                            </div><!-- end row -->



            <!-- ROW 1 -->

                            <div class="row">


<div class="col-xl-6 col-md-6">
<!-- card -->
<div class="card card-animate">

<a href="javascript:void(0);" class="text-decoration-none">

    <div class="card-body py-1" style="background: cadetblue;">



        <div class="d-flex align-items-center justify-content-between">


           
        <span class="d-flex align-items-center justify-content-center avatar-sm bg-success-subtle rounded fs-3"> <i class="ri-line-chart-line"></i> </span>


        <p class="text-uppercase fw-medium text-white text-truncate mb-0 counter-title">Current Month Orders</p>
           
            <div>

                <h4 class="fs-22 fw-semibold ff-secondary m-0 text-white"><span class="counter-value" data-target="<?php echo $sales_orders_month; ?>">0</span></h4>
                
            </div>


           
        </div>
    </div><!-- end card body -->


    </a>

</div><!-- end card -->
</div><!-- end col -->


<div class="col-xl-6 col-md-6">
<!-- card -->
<div class="card card-animate">

<a href="javascript:void(0);" class="text-decoration-none">

    <div class="card-body py-1" style="background: #405189;">



        <div class="d-flex align-items-center justify-content-between">


           
        <span class="d-flex align-items-center justify-content-center avatar-sm bg-success-subtle rounded fs-3"> <i class="ri-line-chart-line"></i> </span>


        <p class="text-uppercase fw-medium text-white text-truncate mb-0 counter-title">Year To Date Orders</p>
           
            <div>

                <h4 class="fs-22 fw-semibold ff-secondary m-0 text-white"><span class="counter-value" data-target="<?php echo $sales_orders_year; ?>">0</span></h4>
                
            </div>

            
           
        </div>
    </div><!-- end card body -->


    </a>

</div><!-- end card -->
</div><!-- end col -->



</div>






<!-- ROW 2 -->

<div class="row">


<div class="col-xl-6 col-md-6">
<!-- card -->
<div class="card card-animate">

<a href="javascript:void(0);" class="text-decoration-none">

    <div class="card-body py-1" style="background: cadetblue;">



        <div class="d-flex align-items-center justify-content-between">


           
        <span class="d-flex align-items-center justify-content-center avatar-sm bg-success-subtle rounded fs-3"> <i class="ri-truck-line"></i> </span>


        <p class="text-uppercase fw-medium text-white text-truncate mb-0 counter-title">Current Month Delivery</p>
           
            <div>

                <h4 class="fs-22 fw-semibold ff-secondary m-0 text-white"><span class="counter-value" data-target="<?php echo $delivery_month; ?>">0</span></h4>
                
            </div>


           
        </div>
    </div><!-- end card body -->


    </a>

</div><!-- end card -->
</div><!-- end col -->


<div class="col-xl-6 col-md-6">
<!-- card -->
<div class="card card-animate">

<a href="javascript:void(0);" class="text-decoration-none">

    <div class="card-body py-1" style="background: #405189;">



        <div class="d-flex align-items-center justify-content-between">


           
        <span class="d-flex align-items-center justify-content-center avatar-sm bg-success-subtle rounded fs-3"> <i class="ri-truck-line"></i> </span>


        <p class="text-uppercase fw-medium text-white text-truncate mb-0 counter-title">Year To Date Delivery</p>
           
            <div>

                <h4 class="fs-22 fw-semibold ff-secondary m-0 text-white"><span class="counter-value" data-target="<?php echo $delivery_year; ?>">0</span></h4>
                
            </div>

            
           
        </div>
    </div><!-- end card body -->


    </a>

</div><!-- end card -->
</div><!-- end col -->



</div>


<!-- ##### -->








<!-- ROW 3 -->

<div class="row">


<div class="col-xl-6 col-md-6">
<!-- card -->
<div class="card card-animate">

<a href="javascript:void(0);" class="text-decoration-none">

    <div class="card-body py-1" style="background: cadetblue;">



        <div class="d-flex align-items-center justify-content-between">


           
        <span class="d-flex align-items-center justify-content-center avatar-sm bg-success-subtle rounded fs-3"> <i class="ri-box-3-line"></i> </span>


        <p class="text-uppercase fw-medium text-white text-truncate mb-0 counter-title">Current Month Sales</p>
           
            <div>

                <h4 class="fs-22 fw-semibold ff-secondary m-0 text-white"><span class="counter-value" data-target="<?php echo max($sales_month,0); ?>">0</span></h4>
                
            </div>


           
        </div>
    </div><!-- end card body -->


    </a>

</div><!-- end card -->
</div><!-- end col -->


<div class="col-xl-6 col-md-6">
<!-- card -->
<div class="card card-animate">

<a href="javascript:void(0);" class="text-decoration-none">

    <div class="card-body py-1" style="background: #405189;">



        <div class="d-flex align-items-center justify-content-between">


           
        <span class="d-flex align-items-center justify-content-center avatar-sm bg-success-subtle rounded fs-3"> <i class="ri-box-3-line"></i> </span>


        <p class="text-uppercase fw-medium text-white text-truncate mb-0 counter-title">Year To Date Sales</p>
           
            <div>

                <h4 class="fs-22 fw-semibold ff-secondary m-0 text-white"><span class="counter-value" data-target="<?php echo max($sales_year,0); ?>">0</span></h4>
                
            </div>

            
           
        </div>
    </div><!-- end card body -->


    </a>

</div><!-- end card -->
</div><!-- end col -->



</div>


<!-- ##### -->








           
                    


                               

                                <div class="row">


                                    <div class="col-xl-6">
                                        <div class="card">
                                            <div class="card-header align-items-center d-flex">
                                                <h4 class="card-title mb-0 flex-grow-1">Pending For Action - Quotation</h4>
                                               
                                            </div><!-- end card header -->

                                            <div class="card-body">
                                                <div class="table-responsive table-card m-1">
                                                    <table style="max-height: 380px;" class="table table-hover">


                                                        <thead>

                                                            <tr>

                                                            <th>Date</th>

                                                            <th>Customer</th>

                                                            <th>Enquiry Ref</th>


                                                            </tr>

                                                        </thead>


                                                        <tbody>

                                                            <?php 
                                                            if(!empty($pfa_quotations)){
                                                            foreach($pfa_quotations as $qs) { ?>
                                                            <tr>
                                                                <td>
                                                                <div class="d-flex align-items-center">
                                                                        <div class="flex-shrink-0 me-2">
                                                                   <?php echo date('d-F-Y',strtotime($qs->enquiry_date)); ?>
                                                                </div>
                                                            </div>
                                                                </td>
                                                                <td>
                                                                    <?php echo $qs->cc_customer_name; ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $qs->enquiry_reff; ?>
                                                                </td>


                                                            </tr>
                                                            <?php } } ?>
                                                           
                                                        </tbody>
                                                    </table>
                                                </div>

                                              
                                            </div>
                                        </div>
                                    </div>





                                    <div class="col-xl-6">
                                        <div class="card">
                                            <div class="card-header align-items-center d-flex">
                                                <h4 class="card-title mb-0 flex-grow-1">Pending For Action - Delivery</h4>
                                               
                                            </div><!-- end card header -->

                                            <div class="card-body">
                                                <div class="table-responsive table-card m-1">
                                                    <table style="max-height: 380px;" class="table table-hover">


                                                        <thead>

                                                            <tr>

                                                            <th>Sales Order</th>

                                                            <th>Customer</th>

                                                            <th>LPO Ref</th>


                                                            </tr>

                                                        </thead>


                                                        <tbody>

                                                            <?php 
                                                            if(!empty($pfa_delivery))
                                                            {
                                                            foreach($pfa_delivery as $dn) { ?>
                                                            <tr>
                                                                <td>
                                                                <div class="d-flex align-items-center">
                                                                        <div class="flex-shrink-0 me-2">
                                                                   <?php echo $dn->so_reffer_no; ?>
                                                            </div>
                                                            </div>
                                                                </td>
                                                                <td>
                                                                    <?php echo $dn->cc_customer_name; ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $dn->so_lpo; ?>
                                                                </td>
                                                                
                                                            </tr>   
                                                            <?php } } ?>


                                                            <?php 
                                                            if(!empty($pfa_delivery_due))
                                                            {
                                                            foreach($pfa_delivery_due as $dn) { ?>
                                                            <tr>
                                                                <td>
                                                                <div class="d-flex align-items-center">
                                                                        <div class="flex-shrink-0 me-2">
                                                                   <?php echo $dn->so_reffer_no; ?>
                                                            </div>
                                                            </div>
                                                                </td>
                                                                <td>
                                                                    <?php echo $dn->cc_customer_name; ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $dn->so_lpo; ?>
                                                                </td>
                                                                
                                                            </tr>   
                                                            <?php } } ?>


                                                          
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


          
                <?php
                
                if(session()->getFlashdata('error'))
                {

                ?>

                <script>alertify.error('<?php echo session()->getFlashdata('error'); ?>').delay(5).dismissOthers();</script>

                <?php } ?>



                <?php
                
                if(session()->getFlashdata('success'))
                {

                ?>

                <script>alertify.success('<?php echo session()->getFlashdata('success'); ?>').delay(5).dismissOthers();</script>

                <?php } ?>


	
	
</body>



</html>