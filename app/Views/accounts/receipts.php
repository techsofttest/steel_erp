<!--Start Account head -->

<style>

    .cheque_sec
    {
        display:none;
    }

    .cheque_sec_view
    {
        display:none;
    }

</style>





<!-- View Modal -->


<div class="modal fade" id="ViewModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">View Receipt</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


    <div class="row">


<div class="col-lg-12">
    <div class="card">
       
        <div class="card-body">
            <div class="live-preview">
            
                    <div class="row align-items-end">



                    <div class="col-col-md-4 col-lg-4">
                            <div>
                                <label for="basiInput" class="form-label">Reference No</label>
                                <input type="text"  id="r_ref_view" class="form-control" value="" disabled>
                            </div>
                        </div>



                        <div class="col-col-md-4 col-lg-4">
                            <div>
                                <label for="basiInput" class="form-label">Date</label>
                                <input type="text"  id="r_date" class="form-control" value="" disabled>
                            </div>
                        </div>


                        <div class="col-col-md-4 col-lg-4">

                            <div>

                                <label for="basiInput" class="form-label">Debit Account</label>
                               
                                <input type="text"  id="r_debit_acc" class="form-control" value="" disabled>

                            </div>

                        </div>


                        <div class="col-col-md-4 col-lg-4">
                            <div>
                                <label for="basiInput" class="form-label">Receipt No</label>
                                <input type="text"  id="r_no" class="form-control" value="" disabled>
                            </div>
                        </div>


                        <div class="col-col-md-4 col-lg-4">

                            <div>

                                <label for="basiInput" class="form-label">Receipt Method</label>
                                
                                <input type="text"  id="r_method_view" class="form-control" value="" disabled>

                            </div>

                        </div>



                        <div class="col-col-md-4 col-lg-4 cheque_sec_view">
                            <div>
                                <label for="basiInput" class="form-label">Cheque Number</label>
                                <input type="text"  id="cheque_no_view" class="form-control" disabled>
                            </div>
                        </div>


                        <div class="col-col-md-4 col-lg-4 cheque_sec_view">
                            <div>
                                <label for="basiInput" class="form-label">Cheque Date</label>
                                <input type="text" id="cheque_date_view" class="form-control" disabled>
                            </div>
                        </div>


                        <div class="col-col-md-4 col-lg-4 cheque_sec_view">
                            <div>
                                <label for="basiInput" class="form-label">Cheque Copy</label>
                                <span class="form-control"></span>
                            </div>
                        </div>


                        <div class="col-col-md-4 col-lg-4">

                            <div>

                                <label for="basiInput" class="form-label">Bank</label>
                              
                                <input type="text"  id="r_bank_view" class="form-control" value="" disabled>

                            </div>

                        </div>



                        <div class="col-col-md-4 col-lg-4">

                        <div>

                        <label for="basiInput" class="form-label">Collected By</label>
                        
                        <input type="text"  id="r_collected_by_view" class="form-control" value="" disabled>

                        </div>

                    </div>


                        <div class="col-col-md-4 col-lg-4">

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
                                        <th>Sl No</th>
                                        <th>Account</th>
                                        <th>Reference</th>
                                        <th>Remarks</th>
                                        <th>Amount</th>
                                        </tr>
                                    </thead>

                                    <tbody >

                                        <tr>

                                            <td>1</td>

                                            <td>Al Fuzail</td>

                                            <td>INV123456</td>

                                            <td>Balance Pay On 19</td>

                                            <td>1000</td>


                                        </tr>


                                        <tr>

                                            <td>1</td>

                                            <td>Al Fuzail</td>

                                            <td>INV123456</td>

                                            <td>Balance Pay On 19</td>

                                            <td>1000</td>

                                        </tr>



                                        <tr>

                                            <td>1</td>

                                            <td>Al Fuzail</td>

                                            <td>INV123456</td>

                                            <td>Balance Pay On 19</td>

                                            <td>1000</td>

                                        </tr>


                                    </tbody>
                                    

                                    <tr>

                                    <td colspan="4" align="right">Total</td>

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














<!-- Invoices Seletion Modal -->


<div class="modal fade" id="InvoicesModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
            <form action="#" method="POST" class="Dashboard-form class" id="invoices_add">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Select Invoices</h5>
                <button type="button" class="btn-close" data-bs-target="#AddModal" data-bs-toggle="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

    <div class="row">


<div class="col-lg-12">

    <div class="card">
       
        <div class="card-body">

            <div class="live-preview">
            
                    <div class="row align-items-end">


                        <div class="col-col-md-12 col-lg-12">


                        <table class="table table-bordered">


                                    <thead>
                                        <tr>
                                        <th></th>
                                        <th>Sl No</th>
                                        <th>Account</th>
                                        <th>Amount</th>
                                        <th>Reference</th>
                                        </tr>
                                    </thead>


                                    <tbody id="invoices_sec">

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
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-target="#AddModal" data-bs-toggle="modal">Cancel</button>
                <button type="submit" class="btn btn btn-success">Add</button>
            </div>

        </div>
        </form>

    </div>
</div>





<!-- ### -->









									
<div class="tab-pane active" id="border-nav-1" role="tabpanel">


    <!-- Add Modal -->


    <div class="modal fade" id="AddModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
            <form  class="Dashboard-form class" id="add_form">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Receipt</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


    <div class="row">


<div class="col-lg-12">
    <div class="card">
       
        <div class="card-body">
            <div class="live-preview">
            
                    <div class="row align-items-end">


                        <div class="col-col-md-4 col-lg-4">
                            <div>
                                <label for="basiInput" class="form-label">Date</label>
                                <input type="date"  name="r_date" class="form-control" required>
                            </div>
                        </div>


                        <div class="col-col-md-4 col-lg-4">

                            <div>

                                <label for="basiInput" class="form-label">Debit Account</label>
                                <!--<input type="text"  name="r_debit_account" class="form-control" required>-->

                                <select class="form-control" name="r_debit_account">

                                <option value="">Select Account</option>

                                <?php foreach($accounts as $a_ac){ ?>

                                    <option value="<?php echo $a_ac->ca_id; ?>"><?php echo $a_ac->ca_name; ?></option>

                                <?php } ?>

                                </select>

                            </div>

                        </div>


                        <div class="col-col-md-4 col-lg-4">
                            <div>
                                <label for="basiInput" class="form-label">Receipt No</label>
                                <input type="text"  name="r_receipt_no" class="form-control" required>
                            </div>
                        </div>


                        <div class="col-col-md-4 col-lg-4">

                            <div>

                                <label for="basiInput" class="form-label">Receipt Method</label>
                                
                                <select name="r_method" class="form-control" required>

                                <option value="">Select Receipt Method</option>

                                <?php foreach($r_methods as $r_method){ ?>

                                <option value="<?= $r_method->rm_id; ?>"><?= $r_method->rm_name; ?></option>

                                <?php } ?>

                                </select>

                            </div>

                        </div>



                        <div class="col-col-md-4 col-lg-4 cheque_sec">
                            <div>
                                <label for="basiInput" class="form-label">Cheque Number</label>
                                <input type="text"  name="r_cheque_no" class="form-control" required>
                            </div>
                        </div>


                        <div class="col-col-md-4 col-lg-4 cheque_sec">
                            <div>
                                <label for="basiInput" class="form-label">Cheque Date</label>
                                <input type="date"  name="r_cheque_date" class="form-control" required>
                            </div>
                        </div>


                        <div class="col-col-md-4 col-lg-4 cheque_sec">
                            <div>
                                <label for="basiInput" class="form-label">Cheque Copy</label>
                                <input type="file"  name="r_cheque_copy" class="form-control" required>
                            </div>
                        </div>


                        <div class="col-col-md-4 col-lg-4">

                            <div>

                                <label for="basiInput" class="form-label">Bank</label>
                                
                                <select name="r_bank" class="form-control" required>
                                
                                <option value="">Select Bank</option>

                                <?php foreach($banks as $a_bank){ ?>
                                <option value="<?= $a_bank->bank_id ?>"><?= $a_bank->bank_name ?></option>
                                <?php } ?>

                                </select>

                            </div>

                        </div>



                        <div class="col-col-md-4 col-lg-4">

                        <div>

                        <label for="basiInput" class="form-label">Collected By</label>
                        
                        <select name="r_collected_by" class="form-control" required>

                        <option value="">Select Collector</option>

                        <?php 
                        foreach($collectors as $col_add){
                        ?>

                        <option value="<?php echo $col_add->col_id; ?>"><?php echo $col_add->col_name; ?></option>

                        <?php } ?>

                        </select>

                        </div>

                    </div>


                        <div class="col-col-md-4 col-lg-4">

                            <div>
                                
                                <label for="basiInput" class="form-label">Credit Account</label>
                                
                                <select name="r_credit_account" class="form-control" required>

                                <option value="">Select Credit Account</option>

                                <option value="1">Customer 1</option>

                                </select>

                            </div>

                        </div>



                        <input type="hidden" name="r_amount" value="">



                        <div class="col-col-md-12 col-lg-12">


                        <table class="table table-bordered" style="overflow-y:scroll;">

                                    <thead>
                                        <tr>
                                        <th>Invoice No</th>
                                        <th>Account</th>
                                        <th>Reference</th>
                                        <th>Remarks</th>
                                        <th>Amount</th>
                                        </tr>
                                    </thead>

                                    <tbody id="sel_invoices">

                                    </tbody>


                                    <tr>

                                    <td align="right" colspan="4">Total</td>

                                    <th  id="total_amount">0</th>


                                    </tr>


                        </table>



                        </div>


                         <div class="col-col-md-12 col-lg-12 text-center">

                         <a href="javascript:void(0);" data-bs-target="#InvoicesModal" data-bs-toggle="modal" class="btn btn-primary add_invoices">Add Invoices</a>
                         
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
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button  class="btn btn btn-success">Save</button>
            </div>

        </div>
        </form>

    </div>
</div>






    <!-- ### -->




   
    
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">View Reciepts</h4>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#AddModal" class="btn btn-primary py-1">Add</button>
                </div><!-- end card header -->
                <div class="card-body" id="account_type_id">
                        <!-- CSRF token --> 
                    <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <table id="accountTable" class="table table-bordered table-striped delTable display dataTable">
                        <thead>
                            <tr>
                                <th class="no-sort">Sl no</th>
                                <th>Receipt No</th>
                                <th>Reference</th>
                                <th>Date</th>
                                <th>Receipt Method</th>
                                <th>Bank</th>
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




<!--Edit Modal section start-->
<div class="modal fade" id="EditModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="#" id="edit_form" class="Dashboard-form">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Charts Of Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                
                                <div class="card-body">
                                    <div class="live-preview">
                                        
                                            <div class="row align-items-end">
                                                <div class="col-col-md-6 col-lg-12">

                                                    <div>
                                                        <label for="basiInput" class="form-label">Account ID</label>
                                                        <input type="text" id="edit_account_id" value="" name="ca_account_id" class="form-control">
                                                    </div>

                                                    <div>
                                                        <label for="basiInput" class="form-label">Account Name</label>
                                                        <input type="text" id="edit_account_name" value="" name="ca_name" class="form-control">
                                                    </div>

                                                    <div>
                                                        <label for="basiInput" class="form-label">Account Type</label>
                                                        
                                                        <select id="edit_account_type" class="form-control account_type_select_edit" name="ca_account_type">

                                                      

                                                        </select>

                                                    </div>



                                                </div>

                                                <!--end col-->

                                                <input type="hidden" name="id" id="ca_id" value="">
                                                
                                                
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
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="submit" class="btn btn btn-success">Submit</button>
            </div>
        </div>
        </form>

    </div>
</div>

<!--Edit modal section end-->




<script src="<?php echo base_url(); ?>public/assets/js/jquery.num2words.js"></script>
            

<script>

    document.addEventListener("DOMContentLoaded", function(event) { 
    
        /*account head add section*/    
   
        $(function() {
            $('#add_form').validate({
                rules: {
                    required: 'required',
                    
                },
                messages: {
                    required: 'This field is required',
                    
                },
                submitHandler: function(form) {
                    $.ajax({
                        url: "<?php echo base_url(); ?>Accounts/Receipts/Add",
                        method: "POST",
                        data: $(form).serialize(),
                        success: function(data) {
                            $('#add_form')[0].reset();
                            $('#AddModal').modal('hide');
                            alertify.success('Data Added Successfully').delay(3).dismissOthers();
                            datatable.ajax.reload( null, false )
                        }
                       
                    });
                    return false; // prevent the form from submitting
                }
            });
        });

        /*###*/




        /*account head modal start*/ 
        $("body").on('click', '.edit_btn', function(){ 
            var id = $(this).data('id');

            $.ajax({

                url : "<?php echo base_url(); ?>Accounts/ChartsOfAccounts/Edit",

                method : "POST",

                data: {id: id},

                success:function(data)
                {   
                    if(data)
                    {
                    var data = JSON.parse(data);

                    $("#edit_account_id").val(data.ca_account_id);

                    $("#edit_account_name").val(data.ca_name);

                    $('#edit_account_type').val(data.ca_account_type);

                    $('#EditModal').modal('show');
                    
                    $("#ca_id").val(id);
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

                url : "<?php echo base_url(); ?>Accounts/Receipts/View",

                method : "POST",

                data: {id: id},

                success:function(data)
                {   
                    if(data)
                    {
                    var data = JSON.parse(data);

                    //console.log(data);

                    $('#r_ref_view').val(data.r_ref_no);

                    $('#r_date').val(data.r_date);

                    $('#r_debit_acc').val(data.ca_account_id);

                    $('#r_no').val(data.r_number);

                    $('#r_method_view').val(data.rm_name);

                    $('#r_bank_view').val(data.bank_name);

                    $('#r_collected_by_view').val(data.col_name);

                    $('#r_credit_account_view').val('Customer1');

                    $('#total_amount_view').html(data.r_amount);

                    if(data.rm_name=="Cheque")
                    {
                    $('.cheque_sec_view').show();
                    $('#cheque_no_view').val(data.r_cheque_no);
                    $('#cheque_date_view').val(data.r_cheque_date);


                    }
                    else
                    {
                    $('.cheque_sec_view').hide();
                    }

                    $('#ViewModal').modal('show');
                  
                    }
                    else
                    {
                    alertify.error('Something went wrong!').delay(8).dismissOthers();  
                    }
                    
                }


            });
            
            
        });
        /*####*/









        /*account head update*/
        $(document).ready(function(){
            $('#edit_form').submit(function(e){

                e.preventDefault();
                
                $.ajax({

                    url : "<?php echo base_url(); ?>Accounts/ChartsOfAccounts/Update",

                    method : "POST",

                    data : $('#edit_form').serialize(),

                    success:function(data)
                    {
                        
                        $('#EditModal').modal('hide');

                        alertify.success('Data Updated Successfully').delay(8).dismissOthers();

                        datatable.ajax.reload( null, false );
                    }


                });
            });
        });
        /*###*/




        /*account head delete*/ 
        $("body").on('click', '.delete_btn', function(){ 
            
            if (!confirm('Are you absolutely sure you want to delete?')) return;
            var id = $(this).data('id');
            $.ajax({

                url : "<?php echo base_url(); ?>Accounts/Receipts/Delete",

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
                    'url': "<?php echo base_url(); ?>Accounts/Receipts/FetchData",
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
                    { data: 'r_id' },
                    { data : "receipt_no"},
                    { data : "reference" },
                    { data: 'date' },
                    { data : 'receipt_method'},
                    { data: 'bank' },
                    { data: 'action' },
                ]
                
           });
        }

        $(document).ready(function () {
            initializeDataTable();
        });
        /*###*/





        /* If Cheque  */

        $('select[name=r_method]').change(function(){

            if($(this).children(':selected').text()=="Cheque")
            {
            $('.cheque_sec').fadeIn(200);
            }
            else
            {
            $('.cheque_sec').fadeOut(200);
            }

        });


        /* ### */



        /* Show Invoices after reference */


        $('input[name=amount]').focusout(function(){


            $('#AddModal').modal('hide');
            $('#InvoicesModal').modal('show');


        });


        /* ### */





        /* Fetch Invoices */

     
        $("body").on('click', '.add_invoices', function(){ 
            
            var id = 1;

            $.ajax({

                url : "<?php echo base_url(); ?>Accounts/Receipts/FetchInvoices",

                method : "POST",

                data: {id: id},

                dataType: "json",

                success:function(data)
                {

                    $('#invoices_sec').hide().html(data).fadeIn(200);

                }


            });

        });

        /*##*/


        $("body").on('submit', '#invoices_add', function(e){ 

        e.preventDefault();

        $('#sel_invoices').html('');

        var form = $(this);

        var tbody =  $('#sel_invoices');
        
        $.ajax({

        url : "<?php echo base_url(); ?>Accounts/Receipts/SelectedInvoices",

        method : "POST",

        data: form.serialize(),

        success:function(data)
        {
        
        var data = JSON.parse(data);

        $.each(data.html, function(key,value) {

        tbody.append('<tr><td>'+value.invoice_id+'</td><td>'+value.account+'</td><td>'+value.date+'</td><td><input class="form-control" name="" type="text"></td><td>'+value.amount+'</td></tr>');

        }); 

        $('#total_amount').html(data.total);

        $('input[name=r_amount]').val(data.total);

        }

        });

       

        $('#AddModal').modal('show');



        $('#InvoicesModal').modal('hide');


        });




     

    });


</script>




            
