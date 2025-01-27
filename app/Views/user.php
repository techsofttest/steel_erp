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

    <style>

    .view_table th {

        border: 1px solid #0000006e;
        padding: 15px 15px;
        text-align: center;

    }

    .view_table td {

        border: 1px solid #0000006e;
        padding: 15px 15px;
        text-align: center;
    }

    .view_body td{
        
        text-align: center;

    }

    .view_head th{
        
        text-align: center !important;
        
    }
    

    /* Tooltip container */
    .custom-tooltip {
        position: relative;
        display: inline-block;
        cursor: pointer;
    }

    /* Tooltip text */
    .custom-tooltip::after {
        content: attr(data-tooltip); /* Use the `data-tooltip` attribute value */
        position: absolute;
        bottom: 125%; /* Position above the element */
        left: 50%;
        transform: translateX(-50%);
        background-color: #333; /* Tooltip background color */
        color: #fff; /* Tooltip text color */
        padding: 10px; /* Inner padding for better spacing */
        border-radius: 8px; /* Rounded corners */
        min-width: 150px; /* Minimum width to keep it readable */
        min-height: 50px; /* Minimum height to maintain a rectangular or square feel */
        text-align: center; /* Center align the text */
        white-space: pre-wrap; /* Preserve spaces and line breaks */
        display: inline-block; /* Ensure content determines size */
        opacity: 0;
        visibility: hidden;
        z-index: 10;
        transition: opacity 0.3s, visibility 0.3s;
        font-size: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Optional shadow */
        overflow: hidden; /* Prevent overflowing text */
    }

    /* Tooltip arrow */
    .custom-tooltip::before {
        content: '';
        position: absolute;
        bottom: 115%; /* Position above the tooltip text */
        left: 50%;
        transform: translateX(-50%);
        border-width: 6px;
        border-style: solid;
        border-color: transparent transparent #333 transparent;
        opacity: 0;
        visibility: hidden;
        z-index: 10;
        transition: opacity 0.3s, visibility 0.3s;
    }

    /* Show the tooltip text */
    .custom-tooltip:hover::after,
    .custom-tooltip:hover::before {
        opacity: 1;
        visibility: visible;
    }
   
    </style>

    
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
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-header align-items-center d-flex">
                                                    <h4 class="card-title mb-0 flex-grow-1">View Users</h4>
                    
                                                </div><!-- end card header -->
                                                <div class="card-body" id="">
                                                    <!-- CSRF token --> 
                                                    <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                                                    <table id="DataTable" class="table table-bordered table-striped delTable display dataTable">
                                                        
                                                        <thead class="view_head">
                                                            <tr>
                                                                <th>SI</th>
                                                                <th>UserName</th>
                                                                <th>Account</th>
                                                                <th>CRM</th>
                                                                <th>Procurement</th>
                                                                <th>Hr</th>
                                                                <th>Add</th>
                                                                <th>Edit</th>
                                                                <th>Delete</th>
                                                                <th>Action</th>
                                                                
                                                            </tr>
                                                        </thead>

                                                        <tbody class="view_body">

                                                            <tr>
                                                                <td style="width:10px">1</td>
                                                                <td>Shihab</td>
                                                                <td style="width:50px">Yes</td>
                                                                <td style="width:50px">Yes</td>
                                                                <td style="width:50px">Yes</td>
                                                                <td style="width:50px">Yes</td>
                                                                <td style="width:50px">Yes</td>
                                                                <td style="width:50px">Yes</td>
                                                                <td style="width:50px">Yes</td>
                                                                <td>
                                                                    <a href="javascript:void(0)" class="view view-color custom-tooltip" data-tooltip="Can add & edit all transaction & view all reports"><i class="ri-eye-fill"></i></a>
                                                                    <a href="javascript:void(0)" data-id = "1" class="change_pass"> Change Password</a>
                                                                </td>
                                                            
                                                            </tr>

                                                            <tr>
                                                                <td>2</td>
                                                                <td>Raply</td>
                                                                <td>Yes</td>
                                                                <td>Yes</td>
                                                                <td>Yes</td>
                                                                <td>Yes</td>
                                                                <td>Yes</td>
                                                                <td>Yes</td>
                                                                <td>No</td>
                                                                <td>
                                                                    <a href="javascript:void(0)" class="view view-color custom-tooltip" data-tooltip="Can add & edit all transaction & view all reports"><i class="ri-eye-fill"></i></a>
                                                                    <a href="javascript:void(0)" data-id = "2" class="change_pass"> Change Password</a>
                                                               </td>
                                                            
                                                            </tr>


                                                            <tr>
                                                                <td>3</td>
                                                                <td>Justin</td>
                                                                <td>No</td>
                                                                <td>Yes</td>
                                                                <td>Yes</td>
                                                                <td>No</td>
                                                                <td>No</td>
                                                                <td>No</td>
                                                                <td>No</td>
                                                                <td>
                                                                    <a href="javascript:void(0)" class="view view-color custom-tooltip" data-tooltip="Only view report from CRM & Procurement"><i class="ri-eye-fill"></i></a>
                                                                    <a href="javascript:void(0)" data-id = "3" class="change_pass"> Change Password</a>
                                                                </td>
                                                            
                                                            </tr>


                                                            <tr>
                                                                <td>4</td>
                                                                <td>Antony</td>
                                                                <td>No</td>
                                                                <td>Yes</td>
                                                                <td>No</td>
                                                                <td>No</td>
                                                                <td>Yes</td>
                                                                <td>Yes</td>
                                                                <td>No</td>
                                                                <td>
                                                                    <a href="javascript:void(0)" class="view view-color custom-tooltip" data-tooltip="Can add & edit all transaction & view all CRM reports"><i class="ri-eye-fill"></i></a>
                                                                    <a href="javascript:void(0)" data-id = "4" class="change_pass"> Change Password</a>
                                                                </td>
                                                            
                                                            </tr>


                                                            <tr>
                                                                <td>5</td>
                                                                <td>Goutham</td>
                                                                <td>No</td>
                                                                <td>Yes</td>
                                                                <td>No</td>
                                                                <td>No</td>
                                                                <td>Yes</td>
                                                                <td>Yes</td>
                                                                <td>No</td>
                                                                <td>
                                                                    <a href="javascript:void(0)" class="view view-color custom-tooltip" data-tooltip="Can add & edit all transaction & view all CRM reports"><i class="ri-eye-fill"></i></a>
                                                                    <a href="javascript:void(0)" data-id = "5" class="change_pass"> Change Password</a>
                                                                </td>
                                                            
                                                            </tr>
                                                            

                                                            <tr>
                                                                <td>6</td>
                                                                <td>Sharad</td>
                                                                <td>Yes</td>
                                                                <td>Yes</td>
                                                                <td>Yes</td>
                                                                <td>No</td>
                                                                <td>Yes</td>
                                                                <td>Yes</td>
                                                                <td>No</td>
                                                                <td>
                                                                   <a href="javascript:void(0)" class="view view-color custom-tooltip" data-tooltip="Can add & edit Receipts from Accounts,can add  and edit all CRM Transactions & view all CRM  Transaction  & view all CRM reports  &  edit Material received note from Procurement"><i class="ri-eye-fill"></i></a>
                                                                    <a href="javascript:void(0)" data-id = "6" class="change_pass"> Change Password</a>
                                                                </td>
                                                            
                                                            </tr>


                                                            <tr>
                                                                <td>7</td>
                                                                <td>Ubais</td>
                                                                <td>Yes</td>
                                                                <td>Yes</td>
                                                                <td>Yes</td>
                                                                <td>No</td>
                                                                <td>Yes</td>
                                                                <td>Yes</td>
                                                                <td>No</td>
                                                                <td>
                                                                    <a href="javascript:void(0)" class="view view-color custom-tooltip" data-tooltip="Can add & edit Receipts, Payments & Petty Cash from Accounts,can add and edit  all CRM  Transaction & view all CRM reports & can add & edit all Procurement transactions except Material received note & view Procurement report"><i class="ri-eye-fill"></i></a>
                                                                    <a href="javascript:void(0)" data-id = "7" class="change_pass"> Change Password</a>
                                                                </td>
                                                            </tr>


                                                            <tr>
                                                                <td>8</td>
                                                                <td>Ganesh</td>
                                                                <td>No</td>
                                                                <td>Yes</td>
                                                                <td>No</td>
                                                                <td>No</td>
                                                                <td>Yes</td>
                                                                <td>Yes</td>
                                                                <td>No</td>
                                                                <td>
                                                                    <a href="javascript:void(0)" class="view view-color custom-tooltip" data-tooltip="Can add & edit Enquiry & Quotation & view all CRM reports"><i class="ri-eye-fill"></i></a>
                                                                    <a href="javascript:void(0)" data-id = "8" class="change_pass"> Change Password</a>
                                                                </td>
                                                            </tr>


                                                        </tbody>

                                                    </table>
                    
                                                </div>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>

                                </div>

                            </div>
                            <!-- container-fluid -->

                        </div>
                        <!-- End Page-content -->


                    </div>

                    

                </div>
            </div>
        </div>


        <!--Edit Modal section start-->
        <div class="modal fade" id="changePassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="#" id="change_pass_form" class="Dashboard-form">
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
                                                    <input type="hidden" name="user_id" class="user_id"  value="">
                                                
                                            
                                                
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
    document.addEventListener("DOMContentLoaded", function(event) { 
    
        $("body").on('click', '.view_btn', function(){ 

            var id = $(this).data('id');

            $.ajax({

                url : "<?php echo base_url(); ?>User/FetchDetails",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {
                
                    var data = JSON.parse(data);

                $('.user_data').html(data.user_details);

                

                
                }

            });

            $('#viewModal').modal('show');

        });


        $("body").on('click', '.change_pass', function(){ 
            
           
            var id = $(this).data('id');

            $('.user_id').val(id);

            $('#changePassword').modal('show');

        });

        
        $(function() {
            $('#change_pass_form').validate({
                rules: {
                    required: 'required',
                    
                },
                messages: {
                    required: 'This field is required',
                    
                },
                submitHandler: function(form) {
                    $.ajax({
                        url: "<?php echo base_url(); ?>User/ChangePassword",
                        method: "POST",
                        data: $(form).serialize(),
                        success: function(data) {
                            
                            alertify.success('Password Updated Successfully').delay(2).dismissOthers();
                            $('#changePassword').modal('hide');
                            
                        }
                    });
                    return false; // prevent the form from submitting
                }
            });
        });
        




    });

</script>







</body>



</html>




        