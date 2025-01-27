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
                <h5 class="modal-title" id="exampleModalLabel">View Vacation Pay</h5>
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


                            <table id="view_vt_table" class="table table-bordered">

                                <tbody id="view_vt_body">


                                <tr>

                                <td>Debit Account</td>

                                <td id="debit_account_view"></td>


                                <td>Credit Account</td>

                                <td id="credit_account_view"></td>

                                </tr>



                                <tr>

                                <td>Current Balance</td>

                                <td id="current_balance_view"></td>


                                <td>Date</td>

                                <td id="date_view"></td>

                                </tr>
                                
                                </tbody>


                            </table>




                            <table class="table table-bordered">

                            <thead>

                            <tr>

                            <th class="text-end">Sl No</th>

                            <th class="text-end">Emp Id</th>

                            <th class="text-end">Name</th>

                            <th class="text-end">Date Of Joining</th>

                            <th class="text-end">Vacation Due From</th>

                            <th class="text-end">Basic Salary</th>

                            <th class="text-end">Days/Year</th>

                            <th class="text-end">Entitlement</th>

                            <th class="text-end">Amount</th>

                            </tr>

                            </thead>

                            <tbody id="emp_rows_view">



                            </tbody>




                            <tfoot>


                            <tr>

                            <th class="text-end" colspan="8"><b>Total</b></th>

                            <th class="text-end" id="total_vp_view"></th>

                            </tr>



                            </tfoot>


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
                <h5 class="modal-title" id="exampleModalLabel">Add Vacation Pay</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


    <div class="row">


<div class="col-lg-12">
    
    <div class="card">
       
        <div class="card-body">

            <div class="live-preview">


                    <form  class="Dashboard-form class add_form" data-empid="" id="add_form">
                    

                    <div class="row align-items-start form_sec">

                    <!-- Section 1 -->

                    <div class="col-lg-6">


                    <div class="row align-items-center mb-2">


                    <div class="col-col-md-4 col-lg-4">
                       
                    <label>Debit Account</label>
                        
                    </div>


                    <div class="col-col-md-8 col-lg-8">
                       
                    <select id="debit_account" class="account_select2" name="debit_account" required>


                    </select>
                    
                    </div>


                    </div> 

                    </div>




                    <div class="col-lg-6">



<div class="row align-items-center mb-2" >


<div class="col-col-md-4 col-lg-4">

<label>Date</label>
    
</div>


<div class="col-col-md-4 col-lg-4">

<input id="date" type="text" name="date" class="form-control datepicker" readonly required>

</div>



<div class="col-col-md-4 col-lg-4">

<button class="btn btn-success generate_vp" type="button">Generate</button>

</div>



</div>


</div>


                   







                    <div class="col-lg-6">


                    <div class="row align-items-center mb-2">


                    <div class="col-col-md-4 col-lg-4">
                    
                    <label>Credit Account</label>
                        
                    </div>


                    <div class="col-col-md-8 col-lg-8">
                    
                    <select id="credit_account" class="account_select2" name="credit_account" required>


                    </select>

                    </div>


                    </div> 

                    </div>





                    <div class="col-lg-6">



<div class="row align-items-center mb-2" >


<div class="col-col-md-4 col-lg-4">

<label>Current Balance</label>
    
</div>


<div class="col-col-md-8 col-lg-8">

<input id="current_balance" type="number" step="0.01" class="form-control" readonly>

</div>


</div>


</div>





                   
                    


       
                    </div>




                    <div class="row align-items-start generated_sec" id="employee_sec" style="display:none;">


                    
                    <table class="table table-bordered">


                    <thead>
                    
                    <tr>
                        <td class="text-end">Sl No</td>
                        <td class="text-end">Employee ID</td>
                        <td class="text-end">Name</td>
                        <td class="text-end">Date Of Joining</td>
                        <td class="text-end">Vacation Due From</td>
                        <td class="text-end">Basic Salary</td>
                        <td class="text-end">Days/Year</td>
                        <td class="text-end">Entitlement</td>
                        <td class="text-end">Amount</td>
                    </tr>

                    </thead>



                    <tbody id="emp_rows">


                    </tbody>


                    <tfoot>


                    <td colspan="8" class="text-end">Total</td>

                    <input type="hidden" id="total_amount_input" name="" value="" required>

                    <td id="total_amount_view" class="text-end"></td>

                    </tfoot>


                    </table>




                    </div>




                    <div class="row generated_sec" style="display:none;">



                    <div class="col-lg-12 text-center">


                    <button class="submit_btn btn btn-success" type="button" id="save_to_jv_btn">Generate JV</button>
                                                       
                          
                    </div>


                    </div>






                    </form>






                        
                        
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
                    <h4 class="card-title mb-0 flex-grow-1">View Indemnity</h4>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#AddModal" class="btn btn-primary py-1 add_model_btn">Add</button>
                </div><!-- end card header -->
                <div class="card-body" id="">
                        <!-- CSRF token --> 
                    <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <table id="datatable" class="table table-bordered table-striped delTable display dataTable">
                        <thead>
                            <tr>
                                <th class="no-sort">Sl no</th>
                                <th>Date</th>
                                <th>Debit Account</th>
                                <th>Credit Account</th>
                                <th>Total</th>
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




            $('.generate_vp').click(function(){

                
                if (! $('#debit_account')[0].checkValidity()) {
                    $('#add_form')[0].reportValidity()
                    return false;
                }

                if (! $('#credit_account')[0].checkValidity()) {
                    $('#add_form')[0].reportValidity()
                    return false;
                }

                if($('#date').val()=="")
                {
                alertify.error('Enter date').delay('5').dismissOthers();
                return false;
                }

                var credit_account = $('#credit_account').val();

                var debit_account = $('#debit_account').val();

                var date = $('#date').val();

                $.ajax({
                        url: "<?php echo base_url(); ?>HR/VacationPay/FetchEmployees",
                        method: "POST",
                        data : {account:credit_account,debit_account:debit_account,date:date},
                        success: function(data) 
                        {

                            var data = JSON.parse(data);

                            if(data.status=="1")
                            {

                            $('#current_balance').val(data.current_balance);

                            $('#emp_rows').html(data.emp_row);

                            $('#total_amount_input').val(data.total_amount);

                            $('#total_amount_view').html(data.total_amount);

                            $('#jv_rows').html(data.jv_rows);

                            $('#total_amount_debit').val(data.total_amount);
                            $('#total_amount_debit_disp').html(data.total_amount);

                            $('#total_amount_credit').val(data.total_amount);
                            $('#total_amount_credit_disp').html(data.total_amount);

                            $('.generated_sec').show();

                            }
                            else
                            {

                            

                            }

                            //datatable.ajax.reload( null, false)


                        }
                       
                    });


        });



                        //$(".account_select2").select2({
                        $('.account_select2').each(function() {
                        $(this).select2({   
                        placeholder: "Select Account",
                        theme : "default form-control-",
                        dropdownParent: $(this).closest('.add_form'),
                        ajax: {
                                url: "<?= base_url(); ?>Accounts/ChartsOfAccounts/FetchAccounts",
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
                                    console.log(data.result);
                                    var page = params.page || 1;
                                    return {
                                        results: $.map(data.result, function (item) { return {id: item.ca_id, text: item.ca_name}}),
                                        pagination: {
                                        // THE `10` SHOULD BE SAME AS `$resultCount FROM PHP, it is the number of records to fetch from table` 
                                            more: (page * 10) <= data.total_count
                                        }
                                    };
                                },              
                            }
                        })

                    });


       

       




        
        $('#add_journal_form').submit(function(e){

            e.preventDefault();

            var journal_form = $(this).serialize();

            var credit_account = $('#credit_account').val();

            var debit_account = $('#debit_account').val();

            var date = $('#date').val();

            $.ajax({
                        url: "<?php echo base_url(); ?>HR/VacationPay/AddJournal",
                        method: "POST",
                        data: {journal_form:journal_form,credit_account:credit_account,debit_account:debit_account,date:date},
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

                            $('.generated_sec').hide();

                            }

                            //datatable.ajax.reload( null, false)

                        }
                       
                    });





        });



        $("body").on('click', '.view_btn', function () {

        var id = $(this).data('id');

        $.ajax({
        url: "<?php echo base_url(); ?>HR/VacationPay/View",
        method: "POST",
        data: { vp_id: id },
        success: function (data) {
            try {

                var data = JSON.parse(data);

                // Insert rows into the table

                $('#debit_account_view').html(data.debit_account_name);

                $('#credit_account_view').html(data.credit_account_name);

                $('#current_balance_view').html(data.vp_current_balance);

                $('#date_view').html(data.vp_date);

                $('#total_vp_view').html(data.vp_total);

                $('#emp_rows_view').html(data.vp_employees);

                $('#ViewModal').modal('show');

            } catch (e) {
                console.error("Error parsing  data:", e);
                alert("An error occurred while fetching  data.");
            }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", status, error);
                alert("Failed to fetch  data.");
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

            

            $('#AddModal').modal('hide');

            $('#AddToJournalModal').modal('show');


        })

       
        /* Save to jv button click end */





       





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
                    'url': "<?php echo base_url(); ?>HR/VacationPay/FetchData",
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
                    { data: 'vp_id' },
                    { data : "vp_date"},
                    { data : "vp_debit_account" },
                    { data : "vp_credit_account" },
                    { data : "vp_total" },
                    { data: 'action' },
                ]
                
           });
        }

        $(document).ready(function () {
            initializeDataTable();
        });
        /*###*/




        $('.add_model_btn').click(function(){


            $('#add_form')[0].reset();

            $('.add_form')[0].reset();

            $('.account_select2').val('').trigger('change');

            $('#emp_rows').html('');

            $('.generated_sec').hide();

            //$('#save_to_jv_btn').hide();


        });


          
        /*###*/



        
       
        $("body").on('click', '.delete_btn', function() {

        if (!confirm('Are you absolutely sure you want to delete?')) return;
        var id = $(this).data('id');
        $.ajax({

            url: "<?php echo base_url(); ?>HR/VacationPay/Delete",

            method: "POST",

            data: {
                id: id
            },

            success: function(data) {

                alertify.success('Data Deleted Successfully').delay(8).dismissOthers();

                datatable.ajax.reload(null, false)
            }


        });

        });







    
    });



</script>



	
</body>



</html>









            
