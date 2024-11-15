<!--Start Account head -->

<style>

    .cheque_sec
    {
        display:flex;
    }

    .cheque_sec_view
    {
        display:none;
    }


</style>





									
<div class="tab-pane active" id="border-nav-1" role="tabpanel">


    <!-- Add Modal -->


    <div class="modal fade" id="AddModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
            <form  class="Dashboard-form class" data-brid="" id="add_form">
                <input id="added_id" type="hidden" name="br_id" value="" autocomplete="off">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Bank Reconciliation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


    <div class="row">




    <div id="add_sec1" class="col-lg-12">
    
    <div class="card">

       
        <div class="card-body">


            <div class="live-preview">
            
                    <div class="row align-items-start">

                        <div class="col-lg-6">

                        <div class="row align-items-center mb-2">

                        <div class="col-col-md-3 col-lg-3">

                        <label for="basiInput" class="form-label">Account</label>

                        </div>

                        <div class="col-col-md-9 col-lg-9 select2_parent">

                        <select id="add_account_select" class="form-control" name="br_account" required>

                        </select>

                        </div>



                        </div>

                    </div>
                    </div>




                    <div class="row align-items-start">

                        <div class="col-lg-6">

                        <div class="row align-items-center mb-2">

                        <div class="col-col-md-3 col-lg-3">

                        <label for="basiInput" class="form-label">Date</label>

                        </div>

                        <div class="col-col-md-9 col-lg-9">

                      <input id="add_date_input" class="form-control datepicker"  readonly>

                        </div>



                    </div>

                    </div>
                    </div>


            <div class="row align-items-center mb-2">

                <button id="proceed_btn" class="btn btn-primary w-25" type="button">Proceed</button>

            </div>


        </div>
        
    </div>

    </div>

    </div>
    







<div id="add_sec2" class="col-lg-12" style="display:none">
    
    <div class="card">
       
        <div class="card-body">

            <div class="live-preview">
            
                    <div class="row align-items-start">

                    <!-- Section 1 -->

                    <div class="col-lg-6">

                    <div class="row align-items-center mb-2">

                    <div class="col-col-md-3 col-lg-3">

                    <label for="basiInput" class="form-label">Account</label>

                    </div>

                    <div class="col-col-md-9 col-lg-9">

                    <input type="text" id="add_account_name" name=""  class="form-control" readonly required>

                    </div>

                    </div>



                    <div class="row align-items-center mb-2">

                    <div class="col-col-md-3 col-lg-3">
                           
                            <label for="basiInput" class="form-label">Date</label>

                    </div>

                        <div class="col-col-md-9 col-lg-9">

                        <input type="text" id="add_br_date" name="add_br_date" value="<?= date('d-F-Y') ?>" class="form-control datepicker" required readonly>

                        </div>

                        </div>



                        <div class="row align-items-center mb-2">

                        <div class="col-col-md-3 col-lg-3">

                            <label for="basiInput" class="form-label">GL Balance</label>
                            <!--<input type="text"  name="r_debit_account" class="form-control" required>-->

                        </div>


                        <div class="col-col-md-9 col-lg-9 select2_parent">

                        <input type="text" id="add_gl_balance" class="form-control" name="gl_balance" value="" readonly>

                        </select>

                        </div>

                        </div> 




                         <div class="row align-items-center mb-2">

                            <div class="col-col-md-3 col-lg-3">

                            <label for="basiInput" class="form-label">Bank Balance</label>
                            
                         </div>

                        <div class="col-col-md-9 col-lg-9">

                        <input type="text" id="add_bank_balance"  name="bank_balance" class="form-control" required>

                        </div>

                        </div>



                    </div> <!-- Section 1 end -->






                    <div class="col-lg-6">


                    <div class="row align-items-center mb-2">

                    <div class="col-col-md-3 col-lg-3">

                        <label for="basiInput" class="form-label">Total Debit</label>

                    </div>
                        

                    <div class="col-col-md-9 col-lg-9">

                    <input type="text" id="add_total_debit" name="total_debit" class="form-control" value="" readonly>

                    </div>

                    </div>




                    <div class="row align-items-center mb-2">

                    <div class="col-col-md-3 col-lg-3">

                        <label for="basiInput" class="form-label">Total Credit</label>

                    </div>
                        

                    <div class="col-col-md-9 col-lg-9">

                       <input type="text" id="add_total_credit" name="total_credit" class="form-control" value="" readonly>

                    </div>

                    </div>






                    <div class="row align-items-center mb-2">

                    <div class="col-col-md-3 col-lg-3">

                        <label for="basiInput" class="form-label">Unreconciled Difference</label>

                    </div>
                        

                    <div class="col-col-md-9 col-lg-9">

                    <input type="text" id="rec_diff" class="form-control" name="rec_diff" value="" readonly>

                    </div>

                    </div>


                    </div>






                        <div class="col-col-md-12 col-lg-12">


                        <table class="table table-bordered" style="overflow-y:scroll;">

                                    <thead>
                                        <tr>
                                        <th>Sl No</th>
                                        <th>Date</th>
                                        <th>Reference</th>
                                        <th>Account Details</th>
                                        <th>Debit Amount</th>
                                        <th>Credit Amount</th>
                                        <th>Status</th>
                                        <th>Tick</th>
                                        <th>Clearance Date</th>
                                        </tr>
                                    </thead>


                                    <tbody id="transactions_rows">


                                    </tbody>




                        </table>


                        </div>



                        <div class="row">


                        <div class="col-lg-6">


                        </div>






                        <div class="col-lg-6">


                        <div style="float: right;">
                                                    <table class="table table-bordered table-striped enq_tab_submit menu">
                                                        <tr>
                                                            <td><button class="submit_btn">Print</button></td>
                                                            <td><button class="submit_btn">Email</button></td>
                                                        </tr>
                                                        <tr>
                                                            <td><button class="submit_btn" type="submit">Save</button></td>
                                                            <td><button class="submit_btn">PDF</button></td>
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
            <!--                                    
            <div class="modal-footer justify-content-center">
                <button  class="btn btn btn-success">Save</button>
            </div>
            -->

        </div>
        </form>

    </div>
</div>






    <!-- ### -->

    
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">View Bank Reconcilitation</h4>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#AddModal" class="btn btn-primary py-1 add_model_btn">Add</button>
                </div><!-- end card header -->
                <div class="card-body" id="account_type_id">
                        <!-- CSRF token --> 
                    <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <table id="accountTable" class="table table-bordered table-striped delTable display dataTable">
                        <thead>
                            <tr>
                                 <th class="no-sort">Sl No</th>
                                 <th>Added On</th>
                                 <th>Account</th>
                                 <th>Rec Date</th>
                                 <th>Bank Balance</th>
                                 <th>Debit</th>
                                 <th>Credit</th>
                                 <th>Difference</th>
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
    <div class="modal-dialog modal-xl">
        <form id="edit_form" class="Dashboard-form">
            <input type="hidden" id="br_id_edit" name="br_id" value="" />
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Bank Reconcilitation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                    <div class="row">



                    <div class="col-lg-12">
    



                    <div class="card">
       
       <div class="card-body">

           <div class="live-preview">
           
                   <div class="row align-items-start">

                   <!-- Section 1 -->

                   <div class="col-lg-6">

                   <div class="row align-items-center mb-2">

                   <div class="col-col-md-3 col-lg-3">

                   <label for="basiInput" class="form-label">Account</label>

                   </div>

                   <div class="col-col-md-9 col-lg-9">

                   <input type="text" id="edit_account_name" name="br_account"  class="form-control" readonly required>

                   </div>

                   </div>



                   <div class="row align-items-center mb-2">

                   <div class="col-col-md-3 col-lg-3">
                          
                           <label for="basiInput" class="form-label">Date</label>

                   </div>

                       <div class="col-col-md-9 col-lg-9">

                       <input type="text" id="edit_br_date" name="br_date" value="<?= date('d-F-Y') ?>" class="form-control datepicker" required readonly>

                       </div>

                       </div>



                       <div class="row align-items-center mb-2">

                       <div class="col-col-md-3 col-lg-3">

                           <label for="basiInput" class="form-label">GL Balance</label>
                           <!--<input type="text"  name="r_debit_account" class="form-control" required>-->

                       </div>


                       <div class="col-col-md-9 col-lg-9 select2_parent">

                       <input type="text" id="edit_gl_balance" class="form-control" name="gl_balance" value="" readonly>

                       </select>

                       </div>

                       </div> 




                        <div class="row align-items-center mb-2">

                           <div class="col-col-md-3 col-lg-3">

                           <label for="basiInput" class="form-label">Bank Balance</label>
                           
                        </div>

                       <div class="col-col-md-9 col-lg-9">

                       <input type="text" id="edit_bank_balance"  name="bank_balance" class="form-control" required>

                       </div>

                       </div>



                   </div> <!-- Section 1 end -->






                   <div class="col-lg-6">


                   <div class="row align-items-center mb-2">

                   <div class="col-col-md-3 col-lg-3">

                       <label for="basiInput" class="form-label">Total Debit</label>

                   </div>
                       

                   <div class="col-col-md-9 col-lg-9">

                   <input type="text" id="edit_total_debit" name="total_debit" class="form-control" value="" readonly>

                   </div>

                   </div>




                   <div class="row align-items-center mb-2">

                   <div class="col-col-md-3 col-lg-3">

                       <label for="basiInput" class="form-label">Total Credit</label>

                   </div>
                       

                   <div class="col-col-md-9 col-lg-9">

                      <input type="text" id="edit_total_credit" name="total_credit" class="form-control" value="" readonly>

                   </div>

                   </div>






                   <div class="row align-items-center mb-2">

                   <div class="col-col-md-3 col-lg-3">

                       <label for="basiInput" class="form-label">Unreconciled Difference</label>

                   </div>
                       

                   <div class="col-col-md-9 col-lg-9">

                   <input type="text" id="edit_rec_diff" class="form-control" name="rec_diff" value="" readonly>

                   </div>

                   </div>


                   </div>






                       <div class="col-col-md-12 col-lg-12">


                       <table class="table table-bordered" style="overflow-y:scroll;">

                                   <thead>
                                       <tr>
                                       <th>Sl No</th>
                                       <th>Date</th>
                                       <th>Reference</th>
                                       <th>Account Details</th>
                                       <th>Debit Amount</th>
                                       <th>Credit Amount</th>
                                       <th>Status</th>
                                       <th>Clearance Date</th>
                                       </tr>
                                   </thead>


                                   <tbody id="edit_transactions_rows">


                                   </tbody>




                       </table>


                       </div>



                       <div class="row">


                       <div class="col-lg-6">


                       </div>



                       <div class="col-lg-6">


                       <div style="float: right;">
                                                   <table class="table table-bordered table-striped enq_tab_submit menu">
                                                       <tr>
                                                           <td><button class="submit_btn">Print</button></td>
                                                           <td><button class="submit_btn">Email</button></td>
                                                       </tr>
                                                       <tr>
                                                           <td><button class="submit_btn" type="submit">Save</button></td>
                                                           <td><button class="submit_btn">PDF</button></td>
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



        </div>
      

    </div>
</div>

<!--Edit modal section end-->



<!--
<script src="<?php echo base_url(); ?>public/assets/js/jquery.num2words.js"></script>
-->            

<script>

     document.addEventListener("DOMContentLoaded", function(event) { 



        //Add Total rec Calculation

        $("body").on('keyup', '#add_bank_balance', function(){ 

            var gl_balance = parseInt($('#add_gl_balance').val(),10);

            var total_debits = parseInt($('#add_total_debit').val(),10);

            var total_credits = parseInt($('#add_total_credit').val(),10);

            var bank_balance = parseInt($(this).val(),10);

            var rec_diff = bank_balance - (gl_balance-total_debits+total_credits);

            $('#rec_diff').val(rec_diff);

        });



        //Edit Total Rec Calculation

        $("body").on('keyup', '#edit_bank_balance', function(){ 

        var gl_balance = parseInt($('#edit_gl_balance').val(),10);

        var total_debits = parseInt($('#edit_total_debit').val(),10);

        var total_credits = parseInt($('#edit_total_credit').val(),10);

        var bank_balance = parseInt($(this).val(),10);

        var rec_diff = bank_balance - (gl_balance-total_debits+total_credits);

        $('#edit_rec_diff').val(rec_diff);

        });





        $("body").on('click', '.status_tick', function(){ 

            parent = $(this).closest('.tran_row');

            status_elem = parent.find('.status');

            if($(this).is(':checked'))
            {
            status_elem.html('<span class="btn btn-success">Cleared</span>');
            parent.find('.datepicker').attr('required',true);
            parent.find('.datepicker').attr('disabled',false);
            parent.find('.datepicker').attr('href',false);
            }
            else
            {
            status_elem.html('<span class="btn btn-warning">Outstanding</span>');   
            parent.find('.datepicker').removeAttr('required');
            parent.find('.datepicker').attr('disabled',true);
            parent.find('.datepicker').val('');
            }

        })



        $('#proceed_btn').click(function(){ 

        if( ($('#add_account_select').val()=="") || ($('#add_date_input').val()=="") ) 

        {


        alertify.error('Fill the details to proceed').delay(3).dismissOthers();

        return false;

        }

        else
        {
        
            var id = $('#add_account_select').val();    

            var date = $('#add_date_input').val();
        
            $.ajax({

                    url: "<?php echo base_url(); ?>Accounts/BankRec/AccountFetch",
                    method: "POST",
                    data:{account_id:id,add_date:date},
                    success: function(data) 
                    {

                    var data = JSON.parse(data);

                    $('#add_account_name').val(data.account.account);

                    $('#add_gl_balance').val(data.gl_balance);

                    $('#add_total_debit').val(data.total_debit);

                    $('#add_total_credit').val(data.total_credit);

                    $('#transactions_rows').html(data.transactions);

                    //console.log(data.account.account);

                    }
                       
            });



        $('#add_sec2').show();

        //$('#add_sec1').hide();


        }

        })




    
        /*account head add section*/    
   
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
                        url: "<?php echo base_url(); ?>Accounts/BankRec/Add",
                        method: "POST",
                        data: $(form).serialize(),
                        success: function(data) 
                        {

                            alertify.success('Data Added Successfully').delay(3).dismissOthers();
                            $('#add_form').attr('data-submit','true');
                            $('#add_form').attr('data-brid',data);
                            $('#added_id').val(data);
                            datatable.ajax.reload( null, false)

                        }
                       
                    });
                    return false; // prevent the form from submitting
                }
            });
        });

        /*###*/




        /*account head modal start*/ 
        $("body").on('click', '.edit_btn', function(){ 

            $("#EditModal :input").prop("disabled", false);

            $('#EditModal .submit_btn').show();

            $('#EditModal .edit_invoice').show();

            $('#EditModal .view_linked').show();

            var id = $(this).data('id');

            $.ajax({

                url : "<?php echo base_url(); ?>Accounts/BankRec/Edit",

                method : "POST",

                data: {id: id},

                success:function(data)
                {   
                    if(data)
                    {
                    //console.log(data);

                    var data = JSON.parse(data);

                    $('#br_id_edit').val(data.br.br_id);

                    $('#edit_br_date').val(data.br.br_date);

                    $('#edit_account_name').val(data.br.ca_name);

                    $('#edit_gl_balance').val(data.br.br_gl_balance);

                    $('#edit_bank_balance').val(data.br.br_bank_balance);

                    $('#edit_total_debit').val(data.br.br_total_debit);

                    $('#edit_total_credit').val(data.br.br_total_credit);

                    $('#edit_rec_diff').val(data.br.br_unrec_diff);

                    $('#edit_transactions_rows').html(data.transactions);

                    /*
                    $('#edit_br_date').val(data.rc.r_date);

                    $('#edit_gl_balance').val(data.rc.ca_name);

                    $('#r_no_edit').val(data.rc.r_number);

                    $('#r_method_edit').val(data.rc.r_method);

                    $('#r_bank_edit').val(data.rc.r_bank);

                    $('#r_collected_by_edit').val(data.rc.r_collected_by);

                    $('#total_amount_edit').html(data.rc.r_amount);

                    $('#sel_invoices_edit').html(data.invoices);

                    */

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



        /* Edit Invoice Start */

        $("body").on('click', '.edit_invoice', function(){

         var id = $(this).data('id'); 
         
         $('#view'+id+'').find('.edit').fadeIn(200);

         $('#view'+id+'').find('.view').hide();

         $('#ri_id_edit').val(id);
        
         $.ajax({

            url : "<?php echo base_url(); ?>Accounts/Receipts/EditInvoice",

            method : "POST",

            data: {inv_id: id},

            success:function(data)
            {   
                var data = JSON.parse(data);

                $('#ri_date_edit').val(data.ri.ri_date);

                $('#ri_credit_account_edit').val(data.ri.ri_credit_account);

                $('#ri_amount_edit').val(data.ri.ri_amount);

                $('#ri_remarks_edit').val(data.ri.ri_remarks);

            }

        });

        //$('#EditModal').modal('hide');

        //$('#InvoiceEditModal').modal('show');

        });




        $("body").on('click', '.edit_invoice', function(){

        var id = $(this).data('id'); 

        });



        $("body").on('click', '.del_credit', function(){

        if( !confirm('Delete this credit?')) {
             return false;
        }

        var id = $(this).data('id'); 

        $.ajax({

        url : "<?php echo base_url(); ?>Accounts/Receipts/DeleteCredit",

        method : "POST",

        data: {id: id},

        success:function(data)
        {   
           
        var data = JSON.parse(data);

        $('#view'+id+'').fadeOut(300).remove();

        $('#total_amount_edit').html(data.total);

        alertify.error('Data Deleted Successfully').delay(3).dismissOthers();

        }

        });
        

        });





        /* Edit Invoice End */





        /* Sales Order  */

        $("body").on('click', '.so_add_more', function(){

            var cc = $('.so_row').length;

			if(cc < 30){ 

            cc++;
           
            var $clone =  $('.so_row:first').clone();

            $clone.find("input").val("");

            $clone.find("select").val("");

            $clone.find(".so_slno").html(cc);

            $clone.find(".so_del_elem").show();

            $clone.find('.tick_check').prop('checked',false);

            $clone.insertAfter('.so_row:last');

			}

	    });


        $(document).on("click", ".so_del_elem", function() 
        {
            $(this).closest('.so_row').remove();
            cc--;
            //totalCalcutate();                                                                           
            //grossCalculate();
        });

        /**/

        function so_slno(){

        var pp =1;

        $('body .so_row').each(function() {

        $(this).find('.so_slno').html('<td class="si_no">' + pp + '</td>');

        pp++;

        });

        }


        /* ### */








        /*cost calculation add more*/

        var max_fieldcost = 30;

        var cc = $('.invoice_row').length;

        $("body").on('click', '.add_more', function(){

            var cc = $('.invoice_row').length;

			if(cc < max_fieldcost){ 

            //$(".cost_cal").append("<div class='row cost_cal_row'><div class='col-md-3 col-lg-3'><label for='basicInput' class='form-label'>Material / Services</label><select id='quotation_material' class='form-control quotation_material_clz'><option value='' selected disabled>Select Material / Services</option></select></div><div class='col-md-3 col-lg-3'><label for='basiInput' class='form-label'>Qty</label><input type='number' name='qd_qty' class='form-control cost_qty' required></div><div class='col-md-3 col-lg-3'><label for='basicInput' class='form-label'>Rate</label><input type='number' name='qd_rate' class='form-control cost_rate' required></div><div class='col-md-3 col-lg-3'><label for='basicInput' class='form-label'>Amount</label><input readonly type='number' name='qd_amount' class='form-control cost_amount' required style='width:95%'></div><div class='remove-cost'><div class='remainpass cost_remove'><i class='ri-close-line'></i></div></div></div>");
          
            var $clone =  $('.invoice_row:first').clone();

            $clone.find("input").val("");

            $clone.find(".credit_account_select2").val('');

            $clone.find(".credit_account_select2").removeAttr('data-select2-id');

            $clone.find('.select2').remove();


            //$clone.find(".sl_no").html(cc);

            $clone.find(".del_elem").show();

            //$clone.find('.credit_sl_no').val(cc);

            $clone.insertAfter('.invoice_row:last');

            slno();

			}

            InitAccountsSelect2('.credit_account_select2','.invoice_row');

	    });



        $(document).on("click", ".del_elem", function() 
        {
            $(this).closest('.invoice_row').remove();
            cc--;
            //totalCalcutate();                                                                           
            //grossCalculate();
            slno();
        });

        /**/


        function slno(){

        var pp =1;

        $('body .invoice_row').each(function() {

        $(this).find('.credit_sl_no').val(pp);

        pp++;

        });

        }





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
                        var data = JSON.parse(data);

                        $('#ruid_edit').val(data.rc.r_ref_no);

                        $('#id_edit').val(data.rc.r_id);

                        $('#r_date_edit').val(data.rc.r_date);

                        console.log();

                        $('#r_debit_account_edit').val(data.rc.ca_name);

                        $('#r_no_edit').val(data.rc.r_number);

                        $('#r_method_edit').val(data.rc.r_method);


                        if(data.rc.r_method=="1")
                        {
                    
                        $('.cheque_sec').removeClass("d-none");

                        $('.cheque_file_sec').removeClass("d-none");
            
                        $('#EditModal input[name=r_cheque_no]').val(data.rc.r_cheque_no);

                        $('#EditModal input[name=r_cheque_date]').val(FormatDate(data.rc.r_cheque_date));

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


                        $("#EditModal :input").prop("disabled", true);

                        $('#EditModal .btn-close').prop("disabled",false);

                        $('#EditModal .cheque_file_edit_sec').addClass('d-none');

                        $('#EditModal .submit_btn').hide();

                        $('#EditModal .edit_invoice').hide();

                        $('#EditModal .view_linked').hide();

                        $('.edit_copy').css('display','none');

                        $('.view_copy').css('display','flex');

                        $('#EditModal .edit_add_credit').hide();


                        $('#EditModal').modal('show');
                    
                        }
                        else
                        {
                        alertify.error('Something went wrong!').delay(8).dismissOthers();  
                        }
                        
                    }


                });




                /*

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

                    $('#r_ref_view').val(data.receipt.r_ref_no);

                    $('#r_date').val(data.receipt.r_date);

                    $('#r_debit_acc').val(data.receipt.ca_account_id);

                    $('#r_no').val(data.receipt.r_number);

                    $('#r_method_view').val(data.receipt.rm_name);

                    $('#r_bank_view').val(data.receipt.bank_name);

                    $('#r_collected_by_view').val(data.receipt.col_name);

                    $('#r_credit_account_view').val('Customer1');

                    $('#total_amount_view').html(data.receipt.r_amount);

                    if(data.receipt.rm_name=="Cheque")
                    {
                    $('.cheque_sec_view').show();
                    $('#cheque_no_view').val(data.receipt.r_cheque_no);
                    $('#cheque_date_view').val(data.receipt.r_cheque_date);
                    }
                    else
                    {
                    $('.cheque_sec_view').hide();
                    }

                    $('#invoice_sec_view').html(data.invoices);

                    $('#ViewModal').modal('show');
                  
                    }
                    else
                    {
                    alertify.error('Something went wrong!').delay(8).dismissOthers();  
                    }
                    
                }


            });

            */
            
            
        });
        /*####*/




        /*account head update*/
        $(document).ready(function(){
            $('#invoices_update').submit(function(e){

                e.preventDefault();
                
                $.ajax({

                    url : "<?php echo base_url(); ?>Accounts/Receipts/UpdateInvoice",

                    method : "POST",

                    data : $('#invoices_update').serialize(),

                    success:function(data)
                    {
                        
                        $('#InvoiceEditModal').modal('hide');

                        $('#EditModal').modal('show');

                        alertify.success('Data Updated Successfully').delay(8).dismissOthers();

                        datatable.ajax.reload( null, false );
                    }


                });
            });
        });
        /*###*/













        /*account head update*/
        $(document).ready(function(){
            $('#edit_form').submit(function(e){

                e.preventDefault();
                
                $.ajax({

                    url : "<?php echo base_url(); ?>Accounts/BankRec/Update",

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

                url : "<?php echo base_url(); ?>Accounts/BankRec/Delete",

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
                    'url': "<?php echo base_url(); ?>Accounts/BankRec/FetchData",
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
                    { data: 'br_id' },
                    { data : "add_date"},
                    { data : "account" },
                    { data: 'br_date' },
                    { data : 'balance'},
                    { data: 'debit' },
                    { data: 'credit' },
                    { data: 'difference' },
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
            $('.cheque_sec').removeClass("d-none");
            }
            else
            {
            $('.cheque_sec').addClass("d-none");
            }

        });


        /* ### */





        $('.add_model_btn').click(function(){


            $('#added_id').val('');

            $('#add_form')[0].reset();

            $('#add_sec2').hide();

            $('#transactions_rows').html('');


            /*
            $.ajax({

            url : "<?php echo base_url(); ?>Accounts/Receipts/FetchReference",

            method : "GET",

            success:function(data)
            {

            $('#ruid').val(data);

            }

            });
            */


        });





        

        $('body').on('click','.tick_check',function(){

            parent = $(this).closest('.so_row');

            if($(this).prop('checked')==true)

            {
            total = parent.find('.so_amount_input').val();

            parent.find('.so_receipt_input').val(total);
            }

            else
            {
            
            parent.find('.so_receipt_input').val('0.00');

            }

        });




                /* Accounts Init Select 2 */

                function InitAccountsSelect2(classname,parent){

                    $('body '+classname+':last').select2({
                        placeholder: "Select Account",
                        theme : "default form-control-",
                        dropdownParent: $($(''+classname+':last').closest(''+parent+'')),
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
                            
                                var page = params.page || 1;
                                return {
                                    results: $.map(data.result, function (item) { return {id: item.ca_id, text: item.ca_name}}),
                                    pagination: {
                                        more: (page * 10) <= data.total_count
                                    }
                                };
                            },              
                        }
                    })
                }

                InitAccountsSelect2('#add_account_select','.select2_parent');

                //InitAccountsSelect2('.credit_account_select2','.invoice_row');

                /* ### */




                /* Select 2 Remove Validation On Change */
                $(".debit_account_select2").on("change",function(e) {
                    $(this).parent().find(".error").removeClass("error");         
                });
                /*###*/

     
            });



</script>






            
