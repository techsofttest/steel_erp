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




									
<div class="tab-pane active" id="border-nav-1" role="tabpanel">


    <!-- Add Modal -->


    <div class="modal fade" id="AddModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
            <form  class="Dashboard-form class" id="add_form">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Journal Voucher</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


    <div class="row">


<div class="col-lg-12">
    <div class="card">
       
        <div class="card-body">
            <div class="live-preview">
            
                    <div class="row align-items-start justify-content-start no_margin_rows">

                    <div class="col-lg-6">

                    <div class="row align-items-center mb-2">
                            

                            <div class="col-col-md-3 col-lg-3">

                                <label for="basiInput" class="form-label">Reference</label>

                            </div>


                            <div class="col-col-md-9 col-lg-9">

                            <input type="text" id="uid" name="jv_voucher_no" class="form-control" required>

                            </div>

                        </div>


                        <div class="row align-items-center mb-2">
                            
                            <div class="col-col-md-3 col-lg-3">

                                <label for="basiInput" class="form-label">Date</label>

                            </div>

                            <div class="col-col-md-9 col-lg-9">

                            <input type="text"  name="jv_date" class="form-control datepicker_ap" value="" required>

                            </div>

                        </div>

                        
                        </div>

                          
                        <div class="col-col-md-12 col-lg-12 add_more_container">


                        <table class="table table-bordered" style="overflow-y:scroll;">

                                    <thead>
                                        <tr>    
                                        <th>Sl No</th>
                                        <th>Sales Order No</th>
                                        <th>Account</th>
                                        <th>Narration</th>
                                        <th>Debit</th>
                                        <th>Credit</th>
                                        <th></th>
                                        </tr>
                                    </thead>

                                    <tbody id="sel_invoices">


                                    <tr class="so_row so_row_add">

                                        <input type="hidden" name="jv_invoice[]" value="1">

                                        <th width="3%" class="sl_no px-0 text-center">1</th>

                                        
                                        <th class="so_select2_parent_add px-0" width="15%">

                                        <select name="jv_sale_invoice[]" class="form-control so_select_add so_select2_add">

                                        </select>

                                        </th>

                                        <th class="select2_parent px-0" width="35%"> 
                                            
                                        <select name="jv_account[]" class="form-control account_select2" required>

                                        </select>

                                        </th>
                                        
                                        <th class="px-0" width="20%"><input name="jv_remarks[]" type="text" class="form-control" ></th>

                                        <th width="10%" class="px-0"><input name="jv_debit[]" step="0.01" type="number" class="form-control debit_amount" ></th>

                                        <th width="10%" class="px-0"><input name="jv_credit[]" step="0.01" type="number" class="form-control credit_amount" ></th>

                                        <th width="5%"> <a href="javascript:void(0);" class="del_elem" style="display:none;"><i class='ri-close-line'></i></a></th>

                                    </tr>


                                    </tbody>

                                    <tr>

                                    <td colspan="7">

                                    <div class="col-lg-12 text-center">
                                                            
                                      <a class="add_more" href="javascript:void(0);"><span class=""><i class="ri-add-circle-line"></i>Add More</span></a>
                                
                                    </div>
                                    
                                    </td>

                                    </tr>


                                    <tr>

                                    <td colspan="4" align="right">Total</td>
                                   
                                    <th id="total_amount_debit_disp">0</th>

                                    <th  id="total_amount_credit_disp">0</th>
                                    
                                    <input type="hidden" id="total_amount_inp" name="total_amount">

                                    <input type="hidden" id="total_amount_debit" name="total_debit">

                                    <input type="hidden" id="total_amount_credit" name="total_credit">
                                    
                                    </tr>


                        </table>

                        
                        </div>


                        <div class="row">


<div class="col-lg-12 text-end">


    <div style="">
        <table class="table table-bordered table-striped enq_tab_submit menu">

            <!--
            <tr>
                <td><button class="submit_btn">Print</button></td>
                <td><button class="submit_btn">Email</button></td>
            </tr>
            -->
            <tr>

                <button class="btn btn-success submit_btn once_form_submit" name="main_submit" type="submit">Save</button>
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






    <!-- ### -->







    
    <!-- Add Modal -->


    <div class="modal fade" id="ViewModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Journal Voucher</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


    <div class="row">


<div class="col-lg-12">
    <div class="card">
       
        <div class="card-body">
            <div class="live-preview">
            
                    <div class="row align-items-start justify-content-start">

                          
                        <div class="col-col-md-12 col-lg-12">


                        <table class="table table-bordered" style="overflow-y:scroll;">


                        <tr>


                        <td>Reference</td>

                        <td id="reference_view"></td>


                        <td>Date</td>

                        <td id="date_view"></td>


                        </tr>



                        <tr>

                        <th>Sl No</th>

                        <th>Sales Order</th>

                        <th>Account</th>

                        <th>Narration</th>

                        <th class="text-end">Debit</th>

                        <th class="text-end">Credit</th>

                        </tr>


                        <tbody id="jv_rows">

                        </tbody>

                                 

                        </table>

                        
                        </div>


                        <div>

                        

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
        

    </div>
</div>


    <!-- ### -->
















   
    
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">View Journal Vouchers</h4>
                    <button type="button"   class="add_model_btn btn btn-primary py-1">Add</button>
                </div><!-- end card header -->
                <div class="card-body" id="account_type_id">
                        <!-- CSRF token --> 
                    <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <table id="accountTable" class="table table-bordered table-striped delTable display dataTable">
                        <thead>
                            <tr>
                                <th class="no-sort">Sl no</th>
                                <th>Reference</th>
                                <th>Date</th>
                                <th>Debit</th>
                                <th>Credit</th>
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
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Journal Voucher</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                    <div class="row no_margin_rows">
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

                            <input type="text" id="uid_edit"  class="form-control" readonly>

                            <input type="hidden" id="id_edit" name="jv_id" value="">

                            </div>

                    </div>



                        <div class="row align-items-center mb-2">
                            
                            <div class="col-col-md-3 col-lg-3">

                                <label for="basiInput" class="form-label">Date</label>

                            </div>

                            <div class="col-col-md-9 col-lg-9">

                            <input type="text" id="jv_date_edit"  name="jv_date" class="form-control datepicker_ap" value="" required>

                            </div>

                        </div>

                        
                        </div>

                          
                        <div class="col-col-md-12 col-lg-12 add_more_container">


                        <table class="table table-bordered" style="overflow-y:scroll;">

                                    <thead>
                                        <tr>    
                                        <th>Sl No</th>
                                        <th>Sales Order No</th>
                                        <th>Account</th>
                                        <th>Narration</th>
                                        <th>Debit</th>
                                        <th>Credit</th>
                                        <th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody id="jv_invoices_edit">
                                   


                                    </tbody>



                                    <tr>
                                        <td colspan="6">
                                    <div class="col-lg-12 text-center">
                                                            
                                        <a class="add_more_edit" href="javascript:void(0);"><span class=""><i class="ri-add-circle-line"></i>Add More</span></a>
                                                      
                                    </div>
                                        <td>
                                    </tr>


                                    <!--

                                    <tr>

                                    <td colspan="6">

                                    <div class="col-lg-12 text-center">
                                                            
                                      <a class="add_more" href="javascript:void(0);"><span class=""><i class="ri-add-circle-line"></i>Add More</span></a>
                                
                                    </div>
                                    
                                    </td>

                                    </tr>

                                    -->


                                    <tr>

                                    <td colspan="4" align="right">Total</td>
                                   
                                    <th id="total_amount_debit_disp_edit" class="text-end">0</th>

                                    <th  id="total_amount_credit_disp_edit" class="text-end">0</th>
                                    
                                    <input type="hidden" id="total_amount_debit_edit" name="total_debit">

                                    <input type="hidden" id="total_amount_credit_edit" name="total_credit">
                                    
                                    </tr>



                        </table>

                        
                        </div>


                        <div>

                        <div class="row">


                <div class="col-lg-12 text-end">


                <div style="">


                                                    
                                                       
                             <button type="submit" class="btn btn-success once_form_submit">Update</button>
                                                          
                                                        

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
        </form>

    </div>
</div>

<!--Edit modal section end-->

 


<script>


        document.addEventListener("DOMContentLoaded", function(event) { 


        //$("body").on('keypress','.credit_amount', function(e){ 
        $('.credit_amount').keypress(function (e) {
        var key = e.which;
        if(key == 13)  // the enter key code
        {
            $('.add_more').trigger('click');
            return false;  
        }
        });  




        /*cost calculation add more*/

        var max_fieldcost = 30;

        var cc = $('.so_row').length;
        
        $("body").on('click', '.add_more', function(){

			if(cc < max_fieldcost){ 

            cc++;
            //$(".cost_cal").append("<div class='row cost_cal_row'><div class='col-md-3 col-lg-3'><label for='basicInput' class='form-label'>Material / Services</label><select id='quotation_material' class='form-control quotation_material_clz'><option value='' selected disabled>Select Material / Services</option></select></div><div class='col-md-3 col-lg-3'><label for='basiInput' class='form-label'>Qty</label><input type='number' name='qd_qty' class='form-control cost_qty' required></div><div class='col-md-3 col-lg-3'><label for='basicInput' class='form-label'>Rate</label><input type='number' name='qd_rate' class='form-control cost_rate' required></div><div class='col-md-3 col-lg-3'><label for='basicInput' class='form-label'>Amount</label><input readonly type='number' name='qd_amount' class='form-control cost_amount' required style='width:95%'></div><div class='remove-cost'><div class='remainpass cost_remove'><i class='ri-close-line'></i></div></div></div>");
          
            var $clone =  $('.so_row:first').clone();

            $clone.find("input").val("");

            $clone.find("select").val(0);

            $clone.find(".sl_no").html(cc);

            $clone.find(".del_elem").show();

            $clone.insertAfter('.so_row:last');

            $clone.find(".account_select2").val('');

            $clone.find(".account_select2").removeAttr('data-select2-id');

            $clone.find('.select2').remove();

            $clone.find(".so_select2_add").val('');

            $clone.find(".so_select2_add").removeAttr('data-select2-id');

            $('.so_row:last').find('.so_select_add').focus();
            
			}

            SOSelect2();

            InitAccountsSelect2('.account_select2', '.select2_parent');



	    });



        $(document).on("click", ".del_elem", function() 
        {
            $(this).closest('.so_row').remove();
            cc--;
            totalCalcutate();    
        });

        /**/


        var tot_rows = $('body .so_row_edit').length;

        $("body").on('click', '.add_more_edit', function(){

        if(tot_rows < max_fieldcost){ 

        tot_rows++;

        var $clone =  $('.so_row_edit:first').clone();

        $clone.find("input").val("");

        $clone.find("select").val(0);

        $clone.find(".sl_no_edit").html(tot_rows);

        $clone.find(".del_elem_edit").show();

        $clone.insertAfter('.so_row_edit:last');

        $clone.find(".account_select2_edit").val('');

        $clone.find(".account_select2_edit").removeAttr('data-select2-id');

        $clone.find('.select2').remove();

        $clone.find(".so_select2_edit").val('');

        $clone.find(".so_select2_edit").removeAttr('data-select2-id');

        $('.so_row_edit:last').find('.so_select2_edit').focus();

        }

        SOSelect2Edit();

        AccountsSelect2Edit();

        });


        $(document).on("click", ".del_elem_edit", function() 
        {
            $(this).closest('.so_row_edit').remove();
            cc--;
            totalCalcutate();    
        });









    
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

                    var debit = parseInt($('#total_amount_debit').val())||0;

                    var credit = parseInt($('#total_amount_credit').val())||0;

                    if(debit==0 || credit==0)
                    {

                    alertify.error('Must be greater than 0!').delay(3).dismissOthers();

                    return false;

                    }

                    if(debit != credit)
                    {

                    alertify.error('Debit And Credit Must Be Same!').delay(3).dismissOthers();

                    return false;

                    }

                    $.ajax({
                        url: "<?php echo base_url(); ?>Accounts/JournalVouchers/Add",
                        method: "POST",
                        data: $(form).serialize(),
                        success: function(data) {

                            var data = JSON.parse(data);

                            if(data.status==0)
                            {

                            alertify.error(data.error).delay(3).dismissOthers();
                            return false;
                                
                            }

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




        /*Edit View*/
        
        $("body").on('click', '.edit_btn', function(){ 

            var id = $(this).data('id');


            $.ajax({

                url : "<?php echo base_url(); ?>Accounts/JournalVouchers/Edit",

                method : "POST",

                data: {jv_id: id},

                success:function(data)
                {  
                    
                    var data = JSON.parse(data);

                    if(data.status === 0){

                        alertify.error(data.msg).delay(3).dismissOthers();

                    }else{

                        $('#id_edit').val(data.jv.jv_id);

                        $('#uid_edit').val(data.jv.jv_voucher_no);

                        $('#jv_date_edit').val(FormatDate(data.jv.jv_date));

                        $('#jv_invoices_edit').html(data.invoices);

                        $('#total_amount_debit_disp_edit').html(data.jv.jv_debit_total);

                        $('#total_amount_credit_edit').val(data.jv.jv_credit_total);

                        $('#total_amount_debit_edit').val(data.jv.jv_debit_total);

                        $('#total_amount_credit_disp_edit').html(data.jv.jv_credit_total);

                        SOSelect2Edit();

                        AccountsSelect2Edit();

                        $('#EditModal').modal('show');


                    }

                   
                  
                    
                    
                }


            });
            
            
        });
       
        /*####*/





$("body").on('keyup', '.debit_amount_edit', function(){ 

totalCalcutateEdit();    

});


$("body").on('keyup', '.credit_amount_edit', function(){ 

totalCalcutateEdit();    

});


function totalCalcutateEdit()
{

var d_total = 0; 

var c_total = 0;

$('body .debit_amount_edit').each(function()
{

var sub_tot = $(this).val();

d_total += parseFloat(sub_tot)||0;

});


$('body .credit_amount_edit').each(function()
{

var sub_tot = $(this).val();

c_total += parseFloat(sub_tot)||0;

});


$('#total_amount_debit_disp_edit').html(d_total);

$('#total_amount_credit_edit').val(c_total);

$('#total_amount_debit_edit').val(d_total);

$('#total_amount_credit_disp_edit').html(c_total);


}



        $("body").on('keyup', '.debit_amount', function(){ 

        totalCalcutate();    

        });


        $("body").on('keyup', '.credit_amount', function(){ 

        totalCalcutate();    

        });


        function totalCalcutate()
        {

        var d_total = 0; 

        var c_total = 0;
        
        $('body .debit_amount').each(function()
        {

        var sub_tot = $(this).val();

        d_total += parseFloat(sub_tot)||0;

        });


        $('body .credit_amount').each(function()
        {

        var sub_tot = $(this).val();

        c_total += parseFloat(sub_tot)||0;

        });

        $('#total_amount_debit').val(d_total);

        $('#total_amount_debit_disp').html(d_total);

        $('#total_amount_credit').val(c_total);

        $('#total_amount_credit_disp').html(c_total);


        }


        $('input[name=qd_gross_profit]').on("keyup change",function(){

        //grossCalculate();

        });







           /*account head modal start*/ 
           $("body").on('click', '.jv_view', function(){ 
            
            var id = $(this).data('jvview');

            $.ajax({

            url : "<?php echo base_url(); ?>Accounts/JournalVouchers/View",

            method : "POST",

            data: {jv_id: id},

            success:function(data)
            {  
            if(data)
            {

            var data = JSON.parse(data);

            //$('#id_edit').val(data.jv.jv_id);

            $('#reference_view').html(data.jv.jv_voucher_no);

            $('#date_view').html(data.jv.jv_date);

            $('#jv_rows').html(data.invoices);

            $('#ViewModal').modal('show');
            }
            else
            {
            alertify.error('Something went wrong!').delay(8).dismissOthers();  
            }
            
            }


            });




            //id=20;


            /*

            $.ajax({

                url : "<?php echo base_url(); ?>Accounts/JournalVouchers/View",

                method : "POST",

                data: {jv_id: id},

                success:function(data)
                {   
                    if(data)
                    {
                    var data = JSON.parse(data);

                    $('#uid_view').val(data.jv.jv_voucher_no);

                    $('#date_view').val(data.jv.jv_date);
                    
                    $('#jv_invoices_view').html(data.invoices);

                    $('#total_debit_view').html(data.jv.jv_debit_total);

                    $('#total_credit_view').html(data.jv.jv_credit_total);

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
            
            $('#edit_form').submit(function(e){

                e.preventDefault();

                var debit = parseInt($('#total_amount_debit_edit').val())||0;

                    var credit = parseInt($('#total_amount_credit_edit').val())||0;

                    if(debit==0 || credit==0)
                    {

                    alertify.error('Must be greater than 0!').delay(3).dismissOthers();

                    return false;

                    }

                    if(debit != credit)
                    {

                    alertify.error('Debit And Credit Must Be Same!').delay(3).dismissOthers();

                    return false;

                    }
                
                $.ajax({

                    url : "<?php echo base_url(); ?>Accounts/JournalVouchers/Update",

                    method : "POST",

                    data : $('#edit_form').serialize(),

                    success:function(data)
                    {

                        var data = JSON.parse(data);


                        if(data.status==0)
                        {
                            alertify.error(data.error).delay(3).dismissOthers();
                            return false;  
                        }

                        
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

                url : "<?php echo base_url(); ?>Accounts/JournalVouchers/Delete",

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

            datatable = $('#accountTable').DataTable({
                'stateSave': true,
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url': "<?php echo base_url(); ?>Accounts/JournalVouchers/FetchData",
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
                    { data: 'jv_id' },
                    { data: 'jv_voucher_no'},
                    { data: 'jv_voucher_date'},
                    { data: 'jv_debit_total'},
                    { data: 'jv_credit_total'},
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
 
 $('#total_amount_credit_disp').html('0.00');
 
 $('#total_amount_debit_disp').html('0.00');
 
 $('.so_select2_add').val('').trigger('change');
 
 $('.account_select2').val('').trigger('change');
 
 $('.so_row_add').not(':first').remove();

 $.ajax({

url : "<?php echo base_url(); ?>Accounts/JournalVouchers/AddAccess",

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
 

$.ajax({

url : "<?php echo base_url(); ?>Accounts/JournalVouchers/FetchReference",

method : "GET",

success:function(data)
{

$('#uid').val(data);

}

});



});


                        function SOSelect2() {
                           
                            const element = $('.so_select2_add:last');

// Ensure the element exists
if (element.length === 0) {
    console.error('No element found for Select2 initialization.');
    return;
}


    element.select2({
        placeholder: "Select Sales Order", // Placeholder text
        theme: "default form-control-",
        dropdownParent: $($('.so_select2_parent_add:last').closest('.so_row_add')),
        allowClear: true, // Allows clearing the selection
        ajax: {
            url: "<?= base_url(); ?>Accounts/JournalVouchers/FetchSalesOrders",
            dataType: 'json',
            delay: 250,
            cache: false,
            minimumInputLength: 1,
            data: function(params) {
                return {
                    term: params.term,
                    page: params.page || 1,
                };
            }, 
            processResults: function(data, params) {
                const page = params.page || 1;

                // Log data for debugging
                console.log('Data:', data, 'Page:', page);

                return {
                    results: $.map(data.result, function(item) {
                        return {
                            id: item.so_id,
                            text: item.so_reffer_no,
                        };
                    }),
                    pagination: {
                        more: (page * 10) < data.total_count // Ensure accurate pagination
                    },
                };
            },
        },
    });

                           
                        }
                        SOSelect2();



                        /* Accounts Init Select 2 */

                        function InitAccountsSelect2(classname, parent) {

                    $('body ' + classname + ':last').select2({
                        placeholder: "Select Account",
                        theme: "default form-control-",
                        dropdownParent: $($('' + classname + ':last').closest('' + parent + '')),
                        ajax: {
                            url: "<?= base_url(); ?>Accounts/ChartsOfAccounts/FetchAccounts",
                            dataType: 'json',
                            delay: 250,
                            cache: false,
                            minimumInputLength: 1,
                            allowClear: true,
                            data: function(params) {
                                return {
                                    term: params.term,
                                    page: params.page || 1,
                                };
                            },
                            processResults: function(data, params) {

                                var page = params.page || 1;
                                return {
                                    results: $.map(data.result, function(item) {
                                        return {
                                            id: item.ca_id,
                                            text: item.ca_name
                                        }
                                    }),
                                    pagination: {
                                        more: (page * 10) <= data.total_count
                                    }
                                };
                            },
                        }
                    })
                    }

                    InitAccountsSelect2('.account_select2', '.select2_parent');




                    //Edit 

                    function SOSelect2Edit() {
                    $('.so_select2_edit').each(function() {
                        $(this).select2({
                            placeholder: "Select Sales Order", // Placeholder text
                            theme: "default form-control-", // Theme for styling
                            dropdownParent: $(this).closest('.so_row_edit'), // Correct parent for dropdown placement
                            allowClear: true, // Allow clearing the selection
                            ajax: {
                                url: "<?= base_url(); ?>Accounts/JournalVouchers/FetchSalesOrders",
                                dataType: 'json',
                                delay: 250,
                                cache: false,
                                minimumInputLength: 1, // Minimum characters to trigger search
                                data: function(params) {
                                    return {
                                        term: params.term, // User-typed term
                                        page: params.page || 1, // Pagination
                                    };
                                },
                                processResults: function(data, params) {
                                    var page = params.page || 1;
                                    return {
                                        results: [
                                            { id: null, text: "Select Sales Order" }, // Default null option
                                            ...$.map(data.result, function(item) {
                                                return {
                                                    id: item.so_id,
                                                    text: item.so_reffer_no
                                                };
                                            })
                                        ],
                                        pagination: {
                                            more: (page * 10) <= data.total_count // Pagination flag
                                        }
                                    };
                                }
                            }
                        });
                    });
                }





                function AccountsSelect2Edit() {
                $('body .account_select2_edit').each(function() {
                $(this).select2({
                    placeholder: "Select Account",
                    theme: "default form-control-",
                    dropdownParent: $($(this).closest('.so_row_edit')),
                    ajax: {
                        url: "<?= base_url(); ?>Accounts/ChartsOfAccounts/FetchAccounts",
                        dataType: 'json',
                        delay: 250,
                        cache: false,
                        minimumInputLength: 1,
                        allowClear: false,
                        data: function(params) {
                            return {
                                term: params.term,
                                page: params.page || 1,
                            };
                        },
                        processResults: function(data, params) {

                            var page = params.page || 1;
                            return {
                                results: $.map(data.result, function(item) {
                                    return {
                                        id: item.ca_id,
                                        text: item.ca_name
                                    }
                                }),
                                pagination: {
                                    more: (page * 10) <= data.total_count
                                }
                            };
                        },
                    }
                })

            });


                }










    });



</script>




            
