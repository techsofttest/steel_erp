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
                                                                <td>1</td>
                                                                <td>Shihab</td>
                                                                <td>Yes</td>
                                                                <td>Yes</td>
                                                                <td>Yes</td>
                                                                <td>Yes</td>
                                                                <td>Yes</td>
                                                                <td>Yes</td>
                                                                <td>Yes</td>
                                                                <td><a  href="javascript:void(0)" class="view view-color" data-toggle="tooltip" data-placement="top" title="FullPower" data-original-title="View"><i class="ri-eye-fill"></i></a></td>
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
                                                                <td><a  href="javascript:void(0)" class="view view-color" data-toggle="tooltip" data-placement="top" title="Can add & edit all transaction & view all reports" data-original-title="View"><i class="ri-eye-fill"></i></a></td>
                                                            
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
                                                                <td><a  href="javascript:void(0)" class="view view-color" data-toggle="tooltip" data-placement="top" title="Only view report from CRM & Procurement" data-original-title="View"><i class="ri-eye-fill"></i></a></td>
                                                            
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
                                                                <td><a  href="javascript:void(0)" class="view view-color" data-toggle="tooltip" data-placement="top" title="Can add & edit all transaction & view all CRM reports" data-original-title="View"><i class="ri-eye-fill"></i></a></td>
                                                            
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
                                                                <td><a  href="javascript:void(0)" class="view view-color" data-toggle="tooltip" data-placement="top" title="Can add & edit all transaction & view all CRM reports" data-original-title="View"><i class="ri-eye-fill"></i></a></td>
                                                            
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
                                                                <td><a  href="javascript:void(0)" class="view view-color" data-toggle="tooltip" data-placement="top" title="Can add & edit Receipts from Accounts,can add  and edit all CRM Transactions & view all CRM  Transaction  & view all CRM reports  &  edit Material received note from Procurement" data-original-title="View"><i class="ri-eye-fill"></i></a></td>
                                                            
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
                                                                <td><a  href="javascript:void(0)" class="view view-color" data-toggle="tooltip" data-placement="top" title="Can add & edit Receipts, Payments & Petty Cash from Accounts,can add and edit  all CRM  Transaction & view all CRM reports & can add & edit all Procurement transactions except Material received note & view Procurement report" data-original-title="View"><i class="ri-eye-fill"></i></a></td>
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
                                                                <td><a  href="javascript:void(0)" class="view view-color" data-toggle="tooltip" data-placement="top" title="Can add & edit Enquiry & Quotation & view all CRM reports" data-original-title="View"><i class="ri-eye-fill"></i></a></td>
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
    
        
        /*data table start*/ 

        /*function initializeDataTable() {

        datatable = $('#DataTable').DataTable({
        'stateSave': true,
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': 
        {
            'url': "<?php echo base_url(); ?>User/FetchData",
            'data': function (data) {
                // CSRF Hash
                var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
                var csrfHash = $('.txt_csrfname').val(); // CSRF hash

                return {
                    data: data,
                    [csrfName]: csrfHash, // CSRF Token
                };
            },
            dataSrc: function (data) {
                // Update token hash
                $('.txt_csrfname').val(data.token);
                // Datatable data
                return data.aaData;
            }
        },
        'columns': [
            { data: 'user_id'},
            { data: 'user_name'},
            { data: 'action'}
            
        ],
        "initComplete": function () {

            var dataId = '<?php echo isset($_GET['view_po']) ? $_GET['view_po'] : ''; ?>';

            $('#DataTable').dataTable().fnFilter(dataId);

        },

        "drawCallback": function() {

            $('.view_btn[data-id="<?php echo isset($_GET['view_po']) ? $_GET['view_po'] : ''; ?>"]').trigger('click');

        }

    });
}*/

/*$(document).ready(function () {
    initializeDataTable();
});*/


/*###*/


/**/

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

          /* $(".add_contact_person").prop('required',true);

           $('.delivery_note_clz').prop('required',true);*/

           
        }

    });

    $('#viewModal').modal('show');


});


/**/


    });

</script>







</body>



</html>




        