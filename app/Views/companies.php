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







<!--View Modal section start-->

<div class="modal fade" id="ViewModal" tabindex="-1">

    <div class="modal-dialog modal-lg">
       
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Company Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                
                                <div class="card-body">
                                    <div class="live-preview">
                                        
                                            <div class="row align-items-center">


                                            <table class="table table-bordered">

                                                <tr>

                                                <th>Company Name</th>

                                                <td id="cname_view"></td>

                                                </tr>


                                                <tr>

                                                <th>CR No</th>

                                                <td id="crno_view"></td>

                                                </tr>



                                                <tr>

                                                <th>Trade Licence Number</th>

                                                <td id="trade_licence_view"></td>

                                                </tr>



                                                <tr>

                                                <th>Tax Card No</th>

                                                <td id="tax_card_no_view"></td>

                                                </tr>


                                                <tr>

                                                <th>Paid Up Capital</th>

                                                <td id="paid_up_capital_view"></td>

                                                </tr>


                                                <tr>

                                                <th>City</th>

                                                <td id="city_view"></td>

                                                </tr>

                                                <tr>

                                                <th>Country</th>

                                                <td id="country_view"></td>

                                                </tr>


                                                <tr>
                                                
                                                <td>

                                                <h4>Partner Details</h4>

                                                </td>
                                                
                                                </tr>


                                                <tr>

                                                <th>Name</th>

                                                <th>Nationality</th>

                                                <th>Passport/QID</th>

                                                <th>Signature</th>

                                                </tr>
                                                

                                                <tbody class="part_view">


                                                </tbody>


                                            </table>

                                                
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
                <!-- <button type="submit" name="" class="btn btn btn-success">Save</button> -->
            </div>
        

    </div>
</div>

</div>

<!--View modal section end-->






<!--View Modal section start-->

<div class="modal fade" id="EditCompanyModal" tabindex="-1">

    <div class="modal-dialog modal-lg">
       <form id="update_company" method="POST">
        <input id="company_id_edit" name="company_id" type="hidden" value="">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Company Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                
                                <div class="card-body">
                                    <div class="live-preview">
                                        
                                            <div class="row align-items-center">


                                            <table class="table table-bordered">


                                                <tr>

                                                    <th>Company Name</th>

                                                    <td colspan="4">
                                                    <input type="text" name="comp_name" class="form-control" id="cname_edit">
                                                    </td>

                                                </tr>


                                                <tr>

                                                <th>CR No</th>

                                                <td colspan="4">
                                                <input type="text" name="comp_cr_no" class="form-control" id="crno_edit">
                                                </td>

                                                </tr>


                                                <tr>

                                                <th>Est ID</th>

                                                <td colspan="4">
                                                <input type="text" name="comp_est_id" class="form-control" id="estid_edit">
                                                </td>

                                                </tr>

                                                
                                                <tr>

                                                <th>Trade Licence Number</th>

                                                <td colspan="4">

                                                <input type="text" name="comp_trade_licence_number" class="form-control" id="trade_licence_edit">

                                                </td>

                                                </tr>



                                                <tr>

                                                <th>Tax Card No</th>

                                                <td colspan="4">

                                                <input type="text" name="comp_tax_card_no" class="form-control" id="tax_card_no_edit">

                                                </td>

                                                </tr>


                                                <tr>

                                                <th>Paid Up Capital</th>

                                                <td colspan="4">

                                                <input type="text" name="comp_paid_up_cap" class="form-control" id="paid_up_capital_edit">

                                                </td>

                                                </tr>


                                                <tr>

                                                <th>City</th>

                                                <td colspan="4">

                                                <input type="text" name="comp_city" class="form-control" id="city_edit">

                                                </td>

                                                </tr>

                                                
                                                <tr>

                                                <th>Country</th>

                                                <td colspan="4">
                                                    
                                                    <input type="text" name="comp_country" class="form-control" id="country_edit">
                                                </td>

                                                </tr>


                                                <tr>

                                                    <th>

                                                    <h4>Partner Details</h4>

                                                    </th>

                                                </tr>



                                                <tbody class="part_edit_view">


                                                </tbody>


                                                </table>


                                                <table class="table table-bordered">


                                                <tr class="part_row">

                                                <td>
                                                    <label for="">Name</label>
                                                    <input type="text" placeholder="" name="part_name[]" class="form-control">
                                                </td>

                                                
                                                <td>
                                                    <label for="">Nationality</label>
                                                    <input type="text" placeholder="" name="part_nationality[]" class="form-control">
                                                </td>


                                                <td>
                                                    <label for="">QID/Passport</label>
                                                    <input type="file" placeholder="" name="part_qid[]" class="form-control" accept="image/png,image/jpeg,image/jpg">
                                                </td>


                                                <td>
                                                    <label for="">Signature</label>
                                                    <input type="file" placeholder="Signature" name="part_signature[]" class="form-control" accept="image/png,image/jpeg,image/jpg">
                                                </td>



                                                <td>

                                                <label></label>
                                                <a class="btn btn-danger del_part" style="display:none">X</a>

                                                </td>



                                                </tr>


                                                <!--

                                                <tr>

                                                <td>
                                                <a href="javascript:void(0);" type="button" class="btn btn-primary add_more" >Add More</a>
                                                </td>

                                                </tr> -->


                                            </table>

                                                
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
                                <button type="submit" name="" class="btn btn btn-success">Update</button> 
                            </div>
                        

                    </div>
                </div>
</form>
                </div>

                <!--View modal section end-->

























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

                          

                            <?php } ?>


                            <a href="javascript:void(0);" data-id="<?= $company->comp_id; ?>" class="edit_btn mr-1"><i class="ri-pencil-line"></i> Edit</a>

                            <a href="javascript:void(0);" data-id="<?= $company->comp_id; ?>" class="view_btn mr-1"><i class="ri-eye-line"></i> View</a>

                            


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
                            //datatable.ajax.reload(null,false);
                        }
                    });
                    return false; // prevent the form from submitting
                }
                });
            });




            $('.edit_btn').click(function(){

            var id = $(this).data(id);

            $.ajax({

                        url: "<?php echo base_url(); ?>Companies/Edit",

                        method: "POST",

                        data: {id:id},

                        success: function(data) {

                        var data = JSON.parse(data);

                        $('#cname_edit').val(data.company.comp_name);

                        $('#crno_edit').val(data.company.comp_cr_no);

                        $('#estid_edit').val(data.company.comp_est_id);

                        $('#trade_licence_edit').val(data.company.comp_trade_licence_number);

                        $('#tax_card_no_edit').val(data.company.comp_tax_card_no);

                        $('#paid_up_capital_edit').val(data.company.comp_paid_up_cap);

                        $('#city_edit').val(data.company.comp_city);

                        $('#country_edit').val(data.company.comp_country);

                        $('#company_id_edit').val(data.company.comp_id);

                        $('.part_edit_view').html(data.partners);

                        $('#EditCompanyModal').modal('show');
                 
                        }
            });




            });



            $('#update_company').submit(function(e){

                e.preventDefault();

                var formData = new FormData($(this)[0]);

                $.ajax({
                        url: "<?php echo base_url(); ?>Companies/Update",
                        method: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            
                            $('#EditCompanyModal').modal('hide');

                            alertify.success('Updated').dismissOthers(3);

                        }
                    });



            });






            $('.view_btn').click(function(){


            var id = $(this).data(id);


        $.ajax({
                        url: "<?php echo base_url(); ?>Companies/View",
                        method: "POST",
                        data: {id:id},
                        success: function(data) {

                        var data = JSON.parse(data);

                        $('#cname_view').html(data.company.comp_name);

                        $('#crno_view').html(data.company.comp_cr_no);

                        $('#trade_licence_view').html(data.company.comp_trade_licence_number);

                        $('#tax_card_no_view').html(data.company.comp_tax_card_no);

                        $('#paid_up_capital_view').html(data.company.comp_paid_up_cap);

                        $('#city_view').html(data.company.comp_city);

                        $('#country_view').html(data.company.comp_country);

                        $('.part_view').html(data.partners);

                        $('#ViewModal').modal('show');
                 
                        }

                });


                });




                $("body").on('click', '.add_more', function() {

                var cc = $('.part_row').length;

                if (cc < 5) {

                var $clone = $('.part_row:first').clone();

                $clone.find("input").val("");

                $clone.find(".del_part").show();

                $clone.insertAfter('.part_row:last');

                }


                });



                $("body").on('click', '.del_part', function() {

                var parent = $(this).closest('.part_row');

                parent.remove();


                });






                $("body").on('click', '.delete_partner', function() {

                var id = $(this).data('id');

                $.ajax({
                        url: "<?php echo base_url(); ?>Companies/DeletePartner",
                        method: "POST",
                        data: {id:id},
                        success: function() {
                        $('#EditCompanyModal').modal('hide');
                        alertify.success('Partner deleted').dismissOthers(3);
                        }
                });



                });


                


            </script>






<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.5/css/lightbox.min.css" integrity="sha512-xtV3HfYNbQXS/1R1jP53KbFcU9WXiSA1RFKzl5hRlJgdOJm4OxHCWYpskm6lN0xp0XtKGpAfVShpbvlFH3MDAA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.5/js/lightbox.min.js" integrity="sha512-KbRFbjA5bwNan6DvPl1ODUolvTTZ/vckssnFhka5cG80JVa5zSlRPCr055xSgU/q6oMIGhZWLhcbgIC0fyw3RQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



	
	
</body>



</html>