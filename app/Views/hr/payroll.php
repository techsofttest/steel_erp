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


    #view_payroll_table td.text-end {
    text-align: right;          /* Right-align the text */
    padding-right: 25%;        /* Add padding for space between the value and the edge */
    max-width: 150px;           /* Limit the width to avoid excessive space */
    word-wrap: break-word;      /* Ensure the text wraps if it's too long */
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
                <h5 class="modal-title" id="exampleModalLabel">View Payroll</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


    <div class="row">


<div class="col-lg-12">
    <div class="card">
       
        <div class="card-body">
            <div class="live-preview">
            

                    <div class="row ">


                        <div class="col-lg-12">


                            <table id="view_payroll_table" class="table table-bordered">

                                <tbody id="view_payroll_body">


                                
                                </tbody>

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

                        <th>ID</th>

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

    
    
    <div class="row">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">View Payroll</h4>
                    <button type="button"  class="btn btn-primary py-1 add_model_btn">Add</button>
                </div><!-- end card header -->
                <div class="card-body" id="">
                        <!-- CSRF token --> 
                    <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <table id="datatable" class="table table-bordered table-striped delTable display dataTable">
                        <thead>
                            <tr>
                                <th class="no-sort">Sl no</th>
                                <th>Month</th>
                                <th>Total Salary</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            
                        
                        </tbody>

                    </table>
                    
                </div>
            </div>
        </div>
      
       
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

                <button class="btn btn-success submit_btn" name="" type="submit">Save</button>
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


        //$('#AddModal').modal('show');
    

        $('.sec_btn').click(function(){

        var sec = $(this).data('sec');

        $('.form_sec').hide();

        $('#'+sec+'').show();

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

                                alertify.error(data.msg).delay(3).dismissOthers();

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




        $('#add_journal_form').submit(function(e){

            e.preventDefault();

            $.ajax({
                        url: "<?php echo base_url(); ?>HR/Payroll/AddPayrollJournal",
                        method: "POST",
                        data: $(this).serialize(),
                        success: function(data) 
                        {
                            var data = JSON.parse(data);

                            if(data.status==0)
                            {
                             
                            alertify.error(data.msg).delay(3).dismissOthers();

                            return false;
                                
                            }

                            if(data.status==1)
                            {
                             
                            alertify.success(data.msg).delay(3).dismissOthers();

                            datatable.ajax.reload( null, false);

                            $('#AddToJournalModal').modal('hide');

                            }

                            //datatable.ajax.reload( null, false)

                        }
                       
                    });

        });



        $("body").on('click', '.view_btn', function () {
    var id = $(this).data('id');

    $.ajax({
        url: "<?php echo base_url(); ?>HR/Payroll/View",
        method: "POST",
        data: { pr_id: id },
        success: function (data) {
            try {
                var payroll = JSON.parse(data);

                // Generate table rows
                var rows = `
                    <tr><td class="text-center">Added Date</td> <td class="text-end">${payroll.pr_added_date}</td></tr>
                    <tr><td class="text-center">Journal ID</td> <td class="text-end">${payroll.pr_journal_id || "N/A"}</td></tr>
                    <tr><td class="text-center">Month</td> <td class="text-end">${payroll.pr_month}</td></tr>
                    <tr><td class="text-center">Year</td> <td class="text-end">${payroll.pr_year}</td></tr>
                    <tr><td class="text-center">Basic Salary</td> <td class="text-end">${payroll.pr_basic_salary}</td></tr>
                    <tr><td class="text-center">Leave</td> <td class="text-end">${payroll.pr_leave}</td></tr>
                    <tr><td class="text-center">Overtime</td> <td class="text-end">${payroll.pr_overtime}</td></tr>
                    <tr><td class="text-center">HRA</td> <td class="text-end">${payroll.pr_hra}</td></tr>
                    <tr><td class="text-center">Transport Allowance</td> <td class="text-end">${payroll.pr_transport_allow}</td></tr>
                    <tr><td class="text-center">Telephone Allowance</td> <td class="text-end">${payroll.pr_telephone_allow}</td></tr>
                    <tr><td class="text-center">Food Allowance</td> <td class="text-end">${payroll.pr_food_allow}</td></tr>
                    <tr><td class="text-center">Other Allowance</td> <td class="text-end">${payroll.pr_other_allow}</td></tr>
                    <tr><td class="text-center">Total Salary</td> <td class="text-end">${payroll.pr_total_salary}</td></tr>
                    

                    
                `;

                // Insert rows into the table
                $('#view_payroll_body').html(rows);

                $('#ViewModal').modal('show');

            } catch (e) {
                console.error("Error parsing payroll data:", e);
                alert("An error occurred while fetching payroll data.");
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", status, error);
            alert("Failed to fetch payroll data.");
        }
    });
});





        
        $(function() {
            $('#add_journal_form0').validate({
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
                    var data = JSON.parse(data);
                    
                    if(data.status === 1){
                        
                        alertify.success(data.msg).delay(2).dismissOthers();

                        datatable.ajax.reload(null,false);
 
                    } else{

                        alertify.error(data.msg).delay(2).dismissOthers();
                    } 
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

            datatable = $('#datatable').DataTable({
                'stateSave': true,
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url': "<?php echo base_url(); ?>HR/Payroll/FetchData",
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
                    { data: 'pr_id' },
                    { data : "pr_month"},
                    { data : "total_salary" },
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

            $('#timesheet_sec').hide();

            $('#timesheets_row').html('');

            $.ajax({

                url : "<?php echo base_url(); ?>HR/Payroll/AddAccess",

                method : "POST",

                success:function(data)
                {

                    var data = JSON.parse(data);

                    if(data.status === 0){
                    
                        alertify.error(data.msg).delay(3).dismissOthers();

                    }
                    else{

                        $('#AddModal').modal('show');

                    }
                    

                }

            });


        });


          
        /*###*/



        
       
        $("body").on('click', '.delete_btn', function() {

            //if (!confirm('Are you absolutely sure you want to delete?')) return;
            var id = $(this).data('id');
            $.ajax({

                url: "<?php echo base_url(); ?>HR/Payroll/Delete",

                method: "POST",

                data: {
                    id: id
                },

                success: function(data) {

                    var data = JSON.parse(data);
                        
                        if(data.status === 1){
                            
                            alertify.success(data.msg).delay(2).dismissOthers();

                            datatable.ajax.reload(null,false);
    
                        } else{

                            alertify.error(data.msg).delay(2).dismissOthers();
                        } 
                }


            });

        });







    
    });



</script>



	
</body>



</html>









            
