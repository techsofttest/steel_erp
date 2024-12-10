<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">



<head>

    <meta charset="utf-8" />
    <title><?php echo site_title//Defined in app/constants ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />
    <meta content="" name="author" />
    
    
    
    <style>

.table td.fit, 
.table th.fit {
   white-space: nowrap;
   width: 1%;
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
                
                <!--tab menu section start--> 

                <?php echo view('hr/sub_header');?>  

				<!--tab menu section end-->			
                                    
                <div class="tab-content text-muted">
                                       

                
                
                <section id="ajax_container">


<!--Start Account head -->


<!-- View Modal -->


<div class="modal fade" id="ViewModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    
    <div class="modal-dialog modal-xl">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">View Timesheets</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


    <div class="row">


<div class="col-lg-12">
    <div class="card">
       
        <div class="card-body">
            <div class="live-preview">
            
                    <div class="row align-items-end">


                    <div class="col-col-md-2 col-lg-2">
                            <div>
                                <label for="basiInput" class="form-label">Reference No</label>
                                <input type="text"  id="r_ref_view" class="form-control" value="" disabled>
                            </div>
                    </div>


                        <div class="col-col-md-2 col-lg-2">
                            <div>
                                <label for="basiInput" class="form-label">Date</label>
                                <input type="text"  id="r_date" class="form-control datepicker" value="" disabled>
                            </div>
                        </div>


                        <div class="col-col-md-2 col-lg-2">

                            <div>

                                <label for="basiInput" class="form-label">Debit Account</label>
                               
                                <input type="text"  id="r_debit_acc" class="form-control" value="" disabled>

                            </div>

                        </div>


                        <div class="col-col-md-2 col-lg-2">
                            <div>
                                <label for="basiInput" class="form-label">Receipt No</label>
                                <input type="text"  id="r_no" class="form-control" value="" disabled>
                            </div>
                        </div>


                        <div class="col-col-md-2 col-lg-2">

                            <div>

                                <label for="basiInput" class="form-label">Receipt Method</label>
                                
                                <input type="text"  id="r_method_view" class="form-control" value="" disabled>

                            </div>

                        </div>



                        <div class="col-col-md-2 col-lg-2 cheque_sec_view">
                            <div>
                                <label for="basiInput" class="form-label">Cheque Number</label>
                                <input type="text"  id="cheque_no_view" class="form-control" disabled>
                            </div>
                        </div>


                        <div class="col-col-md-2 col-lg-2 cheque_sec_view">
                            <div>
                                <label for="basiInput" class="form-label">Cheque Date</label>
                                <input type="text" id="cheque_date_view" class="form-control" disabled>
                            </div>
                        </div>


                        <!--
                        <div class="col-col-md-4 col-lg-4 cheque_sec_view">
                            <div>
                                <label for="basiInput" class="form-label">Cheque Copy</label>
                                <span class="form-control"></span>
                            </div>
                        </div>
                        -->


                        <div class="col-col-md-4 col-lg-4">

                            <div>

                                <label for="basiInput" class="form-label">Bank</label>
                              
                                <input type="text"  id="r_bank_view" class="form-control" value="" disabled>

                            </div>

                        </div>




                      






                        <div class="col-col-md-2 col-lg-2">

                        <div>

                        <label for="basiInput" class="form-label">Collected By</label>
                        
                        <input type="text"  id="r_collected_by_view" class="form-control" value="" disabled>

                        </div>

                    </div>


                        <div class="col-col-md-2 col-lg-2">

                            <div>
                                
                                <label for="basiInput" class="form-label">Credit Account</label>
                                
                               <input type="text" id="r_credit_account_view" class="form-control" value="" disabled>

                            </div>

                        </div>


                        <h3 class="my-2 text-center">Invoices</h3>

                        <div class="col-col-md-12 col-lg-12">

                        <table class="table table-bordered" style="overflow-y:scroll;">

                                    <thead>
                                        <tr>
                                        <th>SL No</th>
                                        <th>Credit Account</th>
                                        <th>Remarks</th>
                                        <th>Amount</th>
                                        </tr>
                                    </thead>


                                    <tbody id="invoice_sec_view">

                                        

                                    </tbody>
                                    

                                    <tr>

                                    <td colspan="3" align="right">Total</td>

                                    <td id="total_amount_view" style="font-size: 17px;font-weight: 600;"></td>

                                    </tr>


                        </table>



                        </div>

                        
                        
                    </div>
                    <!--end row-->
                
            </div>
            
        </div>
    </div>
</div>

<!--end col-->
</div>

</div>
           

        </div>
     

    </div>
</div>



<!-- ######### -->






									
<div class="tab-pane active" id="border-nav-1" role="tabpanel">


    <!-- Add Modal -->


    <div class="modal fade" id="AddModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
            
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Payroll</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


    <div class="row">


<div class="col-lg-12">
    
    <div class="card">
       
        <div class="card-body">

            <div class="live-preview">


                    <form  class="Dashboard-form class add_form" data-empid="" id="add_form">
                    <input class="added_id" type="hidden" name="emp_id" value="" autocomplete="off">
            
                    <div class="row align-items-start form_sec" id="employee_sec">

                    <!-- Section 1 -->

                    <div class="col-lg-6">


                    <div class="row align-items-center mb-2" id="add_ah_parent">


                    <div class="col-col-md-6 col-lg-6">
                       
                    <select class="form-select " name="month"  required>
                    
                    <?php foreach($months as $key=>$month){ ?>
                    <option value="<?= $key ?>"><?= $month ?></option>
                    <?php } ?>

                    </select>
                        
                    </div>


                    <div class="col-col-md-6 col-lg-6">
                       
                    <select class="form-select " name="year"  required>


                    <?php for($m=2000;$m<=date('Y');$m++){ ?>

                    <option value="<?= $m ?>" <?php if($m==date('Y')) { echo "selected"; }  ?>><?= $m ?></option>

                    <?php } ?>


                    </select>

                        
                    </div>


                    </div> 
                    

                    </div> <!-- Section 1 end -->
                        


                        <div class="col-lg-12 text-center">


                        
                            <button class="submit_btn btn btn-success" type="submit">Record</button></td>
                               

                        </div>


                        </div>




       
                    </div>

                    </form>






                    
                    <form  class="Dashboard-form class add_form" data-empid="" id="timesheet_add_form">

                    <input class="" id="timesheet_emp_id" type="hidden" name="emp_id" value="" autocomplete="off">

                    <div class="row align-items-start form_sec" id="timesheet_sec" style="display:none;">

                    <div class="col-lg-12">


                        <table class="table table-bordered">

                        <tr>

                        <th>Name</th>

                        <th class="">Division</th>

                        <th class="text-end">Basic Salary</th>

                        <th class="text-end">Leave</th>

                        <th class="text-end">Overtime</th>

                        <th class="text-end">HRA</th>

                        <th class="text-end">Transport Allowance</th>

                        <th class="text-end">Telephone Allowance</th>

                        <th class="text-end">Food Allowance</th>

                        <th class="text-end">Other Allowance</th>

                        <th class="text-end">Total Salary</th>

                      

                        </tr>

                        <tbody id="timesheets_row">


                        </tbody>

                       

                        </table>




                        <div class="row">
                        <div class="col-lg-12">

                            <table class="table table-bordered">

                                <tr>

                                <td align="right">Staff Salary</td>

                                <th class="text-end" id="staff_salary_add"></th>

                                </tr>



                                <tr>

                                <td align="right">Salaries And Wages</td>

                                <th class="text-end"  id="salaries_and_wages_add"></th>

                                </tr>


                                <tr>

                                <td align="right">Overtime</td>

                                <th class="text-end"  id="overtime_add"></th>

                                </tr>



                                <tr>

                                <td align="right">House Rent Allowance</td>

                                <th class="text-end" id="hra_add"></th>

                                </tr>


                                <tr>

                                <td align="right">Transportation Allowance</td>

                                <th class="text-end" id="transport_allow_add"></th>

                                </tr>

                                <tr>

                                <td align="right">Telephone Allowance</td>

                                <th class="text-end" id="telephone_allow_add"></th>

                                </tr>


                                <tr>

                                <td align="right">Food Allowance</td>

                                <th class="text-end" id="food_allow_add"></th>

                                </tr>


                                <tr>

                                <td align="right">Other Allowance</td>

                                <th class="text-end" id="other_allow_add"></th>

                                </tr>



                                <tr>

                                <td align="right">Total Salary</td>

                                <th class="text-end" id="total_salary_add"></th>

                                </tr>
                                



                            </table>

                        </div>

                        </div>








                            <div class="row">



       


                            <div class="col-lg-12 text-center">


                              <button class="submit_btn btn btn-success" type="button" id="save_to_jv_btn">Save To JV</button>
                                                       
                          

                            </div>


                            </div>





                    </div>



                </form>


                <!-- Salary Section End  -->










                        
                        
                    </div>
                    <!--end row-->








                
            </div>
            
        </div>
    </div>
</div>

<!--end col-->
</div>

</div>
            <!--                                    
            <div class="modal-footer justify-content-center">
                <button  class="btn btn btn-success">Save</button>
            </div>
            -->

        </div>
        </form>

    </div>
</div>

 <!-- Add Modal End -->




 <!-- View Modal Start -->



 <!-- View Modal End -->





    <!-- ### -->

    
    <?php /*
    <div class="row">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">View Payroll</h4>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#AddModal" class="btn btn-primary py-1 add_model_btn">Add</button>
                </div><!-- end card header -->
                <div class="card-body" id="account_type_id">
                        <!-- CSRF token --> 
                    <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <table id="accountTable1" class="table table-bordered table-striped delTable display dataTable">
                        <thead>
                            <tr>
                                <th class="no-sort">Sl no</th>
                                <th>Month</th>
                                <th>Year</th>
                                <th>Staff Salary</th>
                                <th>Salaries And Wages</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            
                        
                        </tbody>

                    </table>
                    
                </div>
            </div>
        </div>

        */ ?>
       
        <!--end col-->


    </div>

                                          
</div>
							
<!--end Account  Head-->







</section>
						

										
										
</div>
       

</div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->




<!-- Journal Voucher Modal Start -->


  <!-- Add Modal -->


  <div class="modal fade" id="AddToJournalModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
            <form  class="Dashboard-form class" id="add_journal_form">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Generate Journal Voucher</h5>
                <button type="button" class="btn-close" data-bs-toggle="modal" data-bs-target="#AddModal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


    <div class="row">


<div class="col-lg-12">
    <div class="card">
       
        <div class="card-body">
            <div class="live-preview">
            
                    <div class="row align-items-start justify-content-start">

                    <div class="col-lg-6">

                    <div class="row align-items-center mb-2">
                            

                            <div class="col-col-md-3 col-lg-3">

                                <label for="basiInput" class="form-label">Reference</label>

                            </div>


                            <div class="col-col-md-9 col-lg-9">

                            <input type="text" id="uid"  class="form-control" readonly>

                            </div>

                        </div>


                        <div class="row align-items-center mb-2">
                            
                            <div class="col-col-md-3 col-lg-3">

                                <label for="basiInput" class="form-label">Date</label>

                            </div>

                            <div class="col-col-md-9 col-lg-9">

                            <input type="text"  name="jv_date" class="form-control datepicker_ap" value="<?= date('d M Y') ?>" required>

                            </div>

                        </div>

                        
                        </div>

                          
                        <div class="col-col-md-12 col-lg-12">


                        <table class="table table-bordered" style="overflow-y:scroll;">

                                    <thead>
                                        <tr>    
                                        <th>Sl No</th>
                                        <th>Account</th>
                                        <th>Narration</th>
                                        <th>Debit</th>
                                        <th>Credit</th>
                                        </tr>
                                    </thead>

                                    <tbody id="jv_rows">

                                    </tbody>


                                    <tr>

                                    <td colspan="3" align="right">Total</td>
                                   
                                    <th id="total_amount_debit_disp">0</th>

                                    <th  id="total_amount_credit_disp">0</th>
                                    
                                    <input type="hidden" id="total_amount_inp" name="total_amount">

                                    <input type="hidden" id="total_amount_debit" name="total_debit">

                                    <input type="hidden" id="total_amount_credit" name="total_credit">
                                    
                                    </tr>



                        </table>

                        
                        </div>


                        <div class="row">


<div class="col-lg-12 text-center">


    <div style="">
        <table class="table table-bordered table-striped enq_tab_submit menu">

            <!--
            <tr>
                <td><button class="submit_btn">Print</button></td>
                <td><button class="submit_btn">Email</button></td>
            </tr>
            -->
            <tr>

                <button class="btn btn-success submit_btn" name="main_submit" type="submit">Save</button>
                <!--<td><button class="submit_btn">PDF</button></td>-->
            </tr>
        </table>
    </div>


</div>


</div>


                        
                        
                    </div>
                    <!--end row-->
                
            </div>
            
        </div>



    </div>
</div>

<!--end col-->
</div>

</div>
            <!-- <div class="modal-footer justify-content-center">
                <button  class="btn btn btn-success">Save</button>
            </div> -->

        </div>
        </form>

    </div>
</div>



<!-- Journal Voucher End -->








<!--footer section start-->

<?php echo view('includes/footer'); ?>


<script src="<?= base_url(); ?>public/assets/js/differenceHours.js"></script>

<!--footer section end-->    

<script>


     document.addEventListener("DOMContentLoaded", function(event) { 


        $('#AddModal').modal('show');
    

        $('.sec_btn').click(function(){

        var sec = $(this).data('sec');

        $('.form_sec').hide();

        $('#'+sec+'').show();

        });




        $('.sal_calc').on('input', function() {

        let total = 0;
        $('.sal_calc').each(function() {
            // Parse the value as a float and add to total
            total += parseFloat($(this).val()) || 0;
        });
        // Set the total in the input with ID add_total_salary
        $('#add_total_salary').val(total.toFixed(2));


        });





        /* Main Add */     
   
        $(function() {
            $('#add_form').validate({
                rules: {
                    required: 'required',
                },
                messages: {
                    required: 'This field is required',
                },
                errorPlacement: function(error, element) {} ,
                submitHandler: function(form) {

                    var formData = new FormData(form);

                    $.ajax({
                        url: "<?php echo base_url(); ?>HR/Payroll/FetchTimesheets",
                        method: "POST",
                        data: $(form).serialize(),
                        success: function(data) 
                        {

                            var data = JSON.parse(data);

                            if(data.status=="1")
                            {
                       
                            alertify.success('Timesheets fetched').delay(3).dismissOthers();
                            // $('#add_form').attr('data-empid',data);
                            //$('.added_id').val(data);

                            $('#timesheets_row').html(data.table);

                            $('#staff_salary_add').html(data.staff_salary);

                            $('#salaries_and_wages_add').html(data.salaries_wages);

                            $('#overtime_add').html(data.total_ot);

                            $('#transport_allow_add').html(data.transport_allow);

                            $('#hra_add').html(data.hra);

                            $('#telephone_allow_add').html(data.tel_allow);

                            $('#food_allow_add').html(data.food_allow);

                            $('#other_allow_add').html(data.other_allow);

                            $('#total_salary_add').html(data.total_salary);

                            $('#timesheet_sec').show();

                            }
                            else
                            {

                            alertify.error('No timesheets found').delay(3).dismissOthers();

                            $('#timesheets_row').html('');

                            $('#timesheet_sec').hide();

                            }

                            //datatable.ajax.reload( null, false)


                        }
                       
                    });
                    return false; // prevent the form from submitting
                }
            });
        });

        /*###*/





        $(function() {
            $('#timesheet_add_form').validate({
                rules: {
                    required: 'required',
                },
                messages: {
                    required: 'This field is required',
                },
                errorPlacement: function(error, element) {} ,
                submitHandler: function(form) {

                    var formData = new FormData(form);

                    $.ajax({
                        url: "<?php echo base_url(); ?>HR/Timesheets/Add",
                        method: "POST",
                        //data: $(form).serialize(),
                        data:formData,
                        processData: false, 
                        contentType: false,
                        success: function(data) 
                        {

                            var data = JSON.parse(data);
                            
                            datatable.ajax.reload( null, false)

                        }
                       
                    });
                    return false; // prevent the form from submitting
                }
            });
        });

        /*###*/





        /* Save to jv button click start */


        $('#save_to_jv_btn').click(function(){


            $.ajax({

            url : "<?php echo base_url(); ?>Accounts/JournalVouchers/FetchReference",

            method : "GET",

            success:function(data)
            {

            $('#uid').val(data);

            }

            });


            var month = $('#payroll_month').val();

            var year = $('#payroll_year').val();


            $.ajax({

        url : "<?php echo base_url(); ?>HR/Payroll/AddToJvRows",

        method : "POST",

        data: {p_month: month,p_year:year},

        success:function(data)
        {   
            if(data)
            {
            var data = JSON.parse(data);

            $('#jv_rows').html(data.jv_rows);

            $('#total_amount_debit').val(data.total_debit);
            $('#total_amount_debit_disp').html(data.total_debit);

            $('#total_amount_credit').val(data.total_credit);
            $('#total_amount_credit_disp').html(data.total_credit);

            $('#AddModal').modal('hide');

            $('#AddToJournalModal').modal('show');

            }
        }

        })




        })






        /* Save to jv button click end */








        /*account head modal start*/ 
                                                    
        $("body").on('click', '.edit_btn', function(){ 

            $("#EditModal :input").prop("disabled", false);

            $('#EditModal .submit_btn').show();

            $('#EditModal .edit_invoice').show();

            $('#EditModal .view_linked').show();

            $('.edit_copy').css('display','flex');

            $('.view_copy').css('display','none');

            $('#EditModal .edit_add_credit').show();




            var id = $(this).data('id');

            $.ajax({

                url : "<?php echo base_url(); ?>Accounts/Receipts/Edit",

                method : "POST",

                data: {r_id: id},

                success:function(data)
                {   
                    if(data)
                    {
                    var data = JSON.parse(data);

                    $('#ruid_edit').val(data.rc.r_ref_no);

                    $('#id_edit').val(data.rc.r_id);

                    $('#r_date_edit').val(data.rc.r_date);

                    $('#r_debit_account_edit').val(data.rc.ca_name);

                    $('#r_no_edit').val(data.rc.r_number);

                    $('#r_method_edit').val(data.rc.r_method);

                    if(data.rc.r_method=="1")
                    {
                   
                    $('.cheque_sec').removeClass("d-none");

                    $('.cheque_file_sec').removeClass("d-none");

                    $('#EditModal .cheque_file_edit_sec').removeClass("d-none");
           
                    $('#EditModal input[name=r_cheque_no]').val(data.rc.r_cheque_no);

                    $('#EditModal input[name=r_cheque_date]').val(FormatDate(data.rc.r_cheque_date));

                    $('#EditModal #cheque_file_view').attr('href','<?= base_url();?>uploads/Receipts/'+data.rc.r_cheque_copy+'');

                    }
                    else
                    {

                    $('.cheque_sec').addClass("d-none");

                    $('.cheque_file_sec').addClass("d-none");

                    }

                    $('#r_bank_edit').val(data.rc.r_bank);

                    $('#r_collected_by_edit').val(data.rc.r_collected_by);

                    $('#total_amount_edit').html(data.rc.r_amount);

                    $('#sel_invoices_edit').html(data.invoices);

                    $('#EditModal').modal('show');
                
                    }
                    else
                    {
                    alertify.error('Something went wrong!').delay(8).dismissOthers();  
                    }
                    
                }


            });
            
            
        });
        /*####*/


           /*account head modal start*/ 
           $("body").on('click', '.view_btn', function(){

                var id = $(this).data('id');

                $.ajax({

                    url : "<?php echo base_url(); ?>Accounts/Receipts/Edit",

                    method : "POST",

                    data: {r_id: id},

                    success:function(data)
                    {   
                        if(data)
                        {
                       
                        
                    }

                }


                });
              
            
            
        });
        /*####*/


       



        /*account head delete*/ 
        $("body").on('click', '.delete_btn', function(){ 
            
            if (!confirm('Are you absolutely sure you want to delete?')) return;
            var id = $(this).data('id');
            $.ajax({

                url : "<?php echo base_url(); ?>HR/Timesheets/Delete",

                method : "POST",

                data: {id: id},

                success:function(data)
                {
                    alertify.success('Data Deleted Successfully').delay(8).dismissOthers();

                    datatable.ajax.reload( null, false )
                }


            });

        });
        /*###*/









        /*data table start*/ 


        function initializeDataTable() {

            /*
            if ($.fn.DataTable.isDataTable("#accountTable")) {
                $('#accountTable').DataTable().clear().destroy();
            }
            */

            datatable = $('#accountTable').DataTable({
                'stateSave': true,
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url': "<?php echo base_url(); ?>HR/Timesheets/FetchData",
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
                    { data: 'ts_id' },
                    { data : "employee_id"},
                    { data : "employee_name" },
                    { data: 'month' },
                    { data : 'year'},
                    { data : 'working_days'},
                    { data: 'total_salary'},
                    { data: 'action' },
                ]
                
           });
        }

        $(document).ready(function () {
            initializeDataTable();
        });
        /*###*/




        $('.add_model_btn').click(function(){


            $('.added_id').val('');

            $('#add_form')[0].reset();

            $('.add_form')[0].reset();

           

            });


          
        
        $(".add_te").select2({
        placeholder: "Select Employee",
        theme : "default form-control-",
        dropdownParent: $('#add_te_parent'),
        ajax: {
                url: "<?= base_url(); ?>HR/Timesheets/FetchEmployees",
                dataType: 'json',
                delay: 250,
                cache: false,
                minimumInputLength: 1,
                allowClear: true,
                data: function (params) {
                    return {
                        term: params.term,
                        page: params.page || 1,
                    };
                },
                processResults: function(data, params) {
                   
                    var page = params.page || 1;
                    return {
                        results: $.map(data.result, function (item) { return {id: item.emp_id, text: item.emp_name}}),
                        pagination: {
                        // THE `10` SHOULD BE SAME AS `$resultCount FROM PHP, it is the number of records to fetch from table` 
                            more: (page * 10) <= data.total_count
                        }
                    };
                },              
            }
        })

        /*###*/




      
        $("body").on('input', '.time_to1', function(){ 

        var parent = $(this).closest('.day_row');

        var time1 = parent.find(".time_from").val().split(':');
        
        var time2 = parent.find(".time_to").val().split(':');

        var hours1 = parseInt(time1[0], 10), 
             hours2 = parseInt(time2[0], 10),
             mins1 = parseInt(time1[1], 10),
             mins2 = parseInt(time2[1], 10);

        /*
         var hours = hours2 - hours1, mins = 0;
         if(hours < 0) hours = 24 + hours;
         if(mins2 >= mins1) {
             mins = mins2 - mins1;
         }
         else {
             mins = (mins2 + 60) - mins1;
             hours--;
         }
         mins = mins / 60; // take percentage in 60
         hours += mins;
         hours = hours.toFixed(2);
         //$(".Hours").val(hours);
         */

       // Get the values of time_from and time_to inputs
        var timeFrom = parent.find(".time_from").val();
        var timeTo = parent.find(".time_to").val();

        // Parse the time values into hours and minutes
        var fromHours = parseInt(timeFrom.split(':')[0]);
        var fromMinutes = parseInt(timeFrom.split(':')[1]);
        var toHours = parseInt(timeTo.split(':')[0]);
        var toMinutes = parseInt(timeTo.split(':')[1]);

        // Calculate the difference in minutes
        var diffMinutes = (toHours * 60 + toMinutes) - (fromHours * 60 + fromMinutes);

        // Convert minutes difference into hours and remaining minutes
        var hours = Math.floor(diffMinutes / 60);
        var minutes = diffMinutes % 60;

        var formattedHours = hours + (minutes / 60);

        // Display the total hours and minutes in the .total_hours input
        parent.find('.total_hours').val(formattedHours.toFixed(2));

         //console.log(hours);

        });



        $("body").on('input', '.time_to', function(){ 

            var parent = $(this).closest('.day_row');

            var time1 = parent.find(".time_from").val().split(':');

            var time2 = parent.find(".time_to").val().split(':');

            var elem = parent.find('.total_hours');

            let hours;
            let minute;

        if (parseInt(time1[0]) < parseInt(time2[0]) && parseInt(time1[1]) < parseInt(time2[1])) {

            //As for the addition, the subtraction is carried out separately, column by column.
            hours = parseInt(time2[0]) - parseInt(time1[0]);
            minute =   parseInt(time2[1]) - parseInt(time1[1]);

            // alert(time1[0]);

            // alert(time2[0]);

            let _hours = '';
            let _minute = '';

            if (hours < 10) {
                _hours ='0' + hours;
            } else {
                _hours = hours;
            }

            if (minute < 10) {
                _minute = '0' + minute;
            } else {
                _minute = minute;
            }

            elem.val(_hours +'.'+ _minute +'')


        }else if (parseInt(time2[0]) > parseInt(time1[0])) {
            if (parseInt(time2[1]) < parseInt(time1[1])) {

                // As before we subtract column by column ... and we realize that it's impossible because our minute in second hour is greater than our minute in first hour
                // We will transform 1 hour in 60 minutes
                let _hours = parseInt(time2[0]) - 1;
                let _minute = parseInt(time2[1]) + 60;
                let final_hours = '';
                let final_min = '';

                hours = _hours - parseInt(time1[0]);
                minute = _minute - parseInt(time1[1]);

                if (hours < 10) {
                    final_hours = '0' + hours;
                } else {
                    final_hours = hours;
                }

                if (minute < 10) {
                    final_min = '0' + minute;
                } else {
                    final_min = minute;
                }
                elem.val(final_hours + '.' + final_min)
            }

            if (parseInt(time2[1]) === parseInt(time1[1])) {
                hours = parseInt(time2[0]) - parseInt(time1[0]);
                let final_hours = '';

                if (hours < 10) {
                    final_hours = '0' + hours;
                } else {
                    final_hours = hours;
                }

                elem.val(final_hours + '.' + '00')
            }

        }else if (parseInt(time1[0]) > parseInt(time2[0])) {
            let first_hour_only_hour = parseInt(time1[0]);
            let second_hour_only_hour = parseInt(time2[0]);

            let first_hour_only_min = parseInt(time1[1]);
            let second_hour_only_min = parseInt(time2[1]);

            let tmp_hour = 24 - first_hour_only_hour;
            let tmp_ttl_hour = tmp_hour + second_hour_only_hour;

            let tmp_ttl_min = first_hour_only_min + second_hour_only_min;
            let tmp_new_hour = 0;
            let tmp_new_min_mod = 0;

            let _hours = '';
            let _min = '';

            if (tmp_ttl_min > 59) {
                tmp_new_hour = parseInt(tmp_ttl_min/60);
                tmp_new_min_mod = tmp_ttl_min%60;

                tmp_ttl_hour += tmp_new_hour;
            } else {
                tmp_new_min_mod = tmp_ttl_min
            }

            if (tmp_ttl_hour < 10) {
                _hours = '0' + tmp_ttl_hour;
            } else {
                _hours = tmp_ttl_hour
            }

            if (tmp_new_min_mod < 10) {
                _min = '0' + tmp_new_min_mod
            } else {
                _min = tmp_new_min_mod
            }

            elem.val(_hours + '.' + _min)
        } else if (parseInt(time1[0]) === parseInt(time2[0])) {
            hours = '00';
            let minute = 0;
            if (parseInt(time1[1]) < parseInt(time2[1])) {
                minute = parseInt(time2[1]) - parseInt(time1[1]);
            }

            if (minute < 10) {
                elem.val(hours + '.0' + minute)
            } else  {
                elem.val(hours + '.' + minute)
            }
        }else if (parseInt(time1[0]) === 0 && parseInt(time1[1]) === 0) {
            hours = parseInt(time2[0]);
            minute = parseInt(time2[1]);

            if (hours === 0) {
                elem.val('00.' + minute)
            }else if (minute === 0){
                if (hours < 10) {
                    elem.val('0' + hours + '.00');
                }else {
                    elem.val(hours + '.00');
                }
            }else {
                elem.val(hours + '.' + minute)
            }
        }



        });
       





        $("body").on('change', '.day_type', function(){
            
            parent = $(this).closest('.day_row');

            leave = 0;

            medical_leave = 0;

            public_holidays = 0;

            unpaid_leave = 0;

            working_days = 0;

            $('body .day_type').each(function(i, obj) {

                if($(this).val() ==1)
                {
                
                working_days++;

                parent.find('input').attr('required',true);

                //$(this).children("option").filter(":selected").text();
                }

                else
                {
                parent.find('input').removeAttr('required');
                }

                if($(this).val() ==2)
                {
                public_holidays++;
                }

                if($(this).val() ==3)
                {
                leave++;
                }

                if($(this).val() ==4)
                {
                unpaid_leave++;
                }

                if($(this).val() ==5)
                {

                medical_leave++;

                }

                
            });


            $('#working_days').val(working_days);

            $('#public_holiday').val(public_holidays);

            $('#leave').val(leave);

            $('#unpaid_leave').val(unpaid_leave);

            $('#medical_leave').val(medical_leave);


        });




        $("body").on('change', '.normal_ot', function(){

            var total_normal_ot_hours = 0;

            var total_normal_ot_days = 0;
            
            $('body .normal_ot').each(function(i, obj) {

            ot = parseFloat($(this).val())||0;

            if(ot>0)
            {

            total_normal_ot_days++;

            }

            total_normal_ot_hours = total_normal_ot_hours + ot;

            });

            $('#normal_ot').val(total_normal_ot_days);

            //salary_calc();


        });


        $("body").on('change', '.friday_ot', function(){

        var total_friday_ot_hours = 0;

        var total_friday_ot_days = 0;

        $('body .friday_ot').each(function(i, obj) {

        friday_ot = parseFloat($(this).val())||0;

        if(friday_ot>0)
            {

                total_friday_ot_days++;

            }

        total_friday_ot_hours = total_friday_ot_hours + friday_ot;

        });

        $('#friday_ot').val(total_friday_ot_days);

        //salary_calc();

        });





        /*
        $("body").on('change keyup', '.total_hours', function(){

            salary_calc();

        });
        */




        $("body").on('change keyup', '.normal_ot,.normal_hours,.friday_ot', function(){

         var parent = $(this).closest('.day_row');

         var total_hours = parent.find('.total_hours').val();

         if(total_hours<1)
         {

        alertify.error('Enter total hours first!').delay(3).dismissOthers();
        
        parent.find('.total_hours').focus();

        $(this).val('');

        return false;

         }

         else
         {

            var normal_hours = parseFloat(parent.find('.normal_hours').val())||0;

            var normal_ot = parseFloat(parent.find('.normal_ot').val())||0;

            var friday_ot = parseFloat(parent.find('.friday_ot').val())||0;

            //var entered_val = $(this).val();

            var total = normal_hours+normal_ot+friday_ot;

            if(total_hours<total)
            {
              alertify.error('Total Hours exceeded!').delay(3).dismissOthers();
              $(this).val('');
              return false;
            }
            

         }

         salary_calc();

    
        });







        function salary_calc()
        {

        var hourly_salary = parseFloat($('#add_hourly_salary').val())||0;

        var total_normal_ot = 0;

        var total_friday_ot= 0;

        var total_hours_month = 0;

        var total_salary_month = 0;


        //Normal Ot Calculation Start

        $('.normal_ot').each(function(){

        total_normal_ot+=parseFloat($(this).val())||0;

        });
        
        var total_normal_ot_salary = total_normal_ot*hourly_salary;

        $('#total_normal_ot_salary').val(total_normal_ot_salary.toFixed(2));

        //Normal OT Calculation End


        //Friday OT Calcualation Start

        $('.friday_ot').each(function(){

        total_friday_ot+=parseFloat($(this).val())||0;

        });

        total_friday_ot_salary = total_friday_ot*hourly_salary;

        $('#total_friday_ot_salary').val(total_friday_ot_salary.toFixed(2));

        //Friday OT Calculation End



         //Calculate Total Salary Start

         $('.total_hours').each(function(){

        total_hours_month+=parseFloat($(this).val())||0;

        });

        total_salary_month = total_hours_month*hourly_salary;


        $('#total_month_salary').val(total_salary_month.toFixed(2));

        //Calculate Total Salary End


        }


    
    });



</script>



	
</body>



</html>









            
