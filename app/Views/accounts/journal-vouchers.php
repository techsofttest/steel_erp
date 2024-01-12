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
                <h5 class="modal-title" id="exampleModalLabel">View Journal Voucher</h5>
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
                                <label for="basiInput" class="form-label">Voucher Number</label>
                                <input type="text"  id="p_ref_view" class="form-control" value="" disabled>
                            </div>
                        </div>


                        <div class="col-col-md-4 col-lg-4">
                            <div>
                                <label for="basiInput" class="form-label">Date</label>
                                <input type="text"  id="p_date_view" class="form-control" value="" disabled>
                            </div>
                        </div>


                        <h3 class="my-2 text-center">Invoices</h3>

                        <div class="col-col-md-12 col-lg-12">

                        <table class="table table-bordered" style="overflow-y:scroll;">

                                    <thead>
                                        <tr>
                                        <th>Sl No</th>
                                        <th>Sales Order No</th>
                                        <th>Account</th>
                                        <th>Debit</th>
                                        <th>Credit</th>
                                        <th>Narration</th>
                                        </tr>
                                    </thead>

                                    <tbody id="jv_invoices_view" >

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




									
<div class="tab-pane active" id="border-nav-1" role="tabpanel">


    <!-- Add Modal -->


    <div class="modal fade" id="AddModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
            <form  class="Dashboard-form class" id="add_form">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Journal Voucher</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


    <div class="row">


<div class="col-lg-12">
    <div class="card">
       
        <div class="card-body">
            <div class="live-preview">
            
                    <div class="row align-items-end">


                        <div class="col-col-md-4 col-lg-4 text-center mx-auto">
                            <div>
                                <label for="basiInput" class="form-label">Date</label>
                                <input type="date"  name="jv_date" class="form-control" required>
                            </div>
                        </div>



                        <input type="hidden" name="jv_total" class="form-control" value="1000">

                          
                        <div class="col-col-md-12 col-lg-12">


                        <table class="table table-bordered" style="overflow-y:scroll;">

                                    <thead>
                                        <tr>    
                                        <th>Sl No</th>
                                        <th>Sales Order No</th>
                                        <th>Account</th>
                                        <th>Debit</th>
                                        <th>Credit</th>
                                        <th>Narration</th>
                                        </tr>
                                    </thead>

                                    <tbody id="sel_invoices">


                                    <tr class="so_row">

                                        <th class="sl_no">1</th>
                                        
                                        <th>

                                        <select name="jv_sale_invoice[]" class="form-control">

                                        <option value="0">None</option>

                                        <?php foreach($sales_orders as $sorder){ ?>

                                        <option value="<?php echo $sorder->so_id; ?>"><?php echo $sorder->so_order_no; ?></option>

                                        <?php } ?>

                                        </select>

                                        </th>


                                        <th> <select name="jv_account[]" class="form-control">

                                        <option value="">Select Account</option>

                                        <?php foreach($accounts as $account){ ?>

                                        <option value="<?php echo $account->ca_id; ?>"><?= $account->ca_name; ?></option>

                                        <?php } ?>
                                        
                                        </select>

                                        </th>
                                        
                                        <th><input name="jv_debit[]" type="number" class="form-control debit_amount" ></th>

                                        <th><input name="jv_credit[]" type="number" class="form-control credit_amount" ></th>

                                        <th><input name="jv_remarks[]" type="text" class="form-control" ></th>

                                        <th> <a href="javascript:void(0);" class="del_elem"><i class='ri-close-line'></i></a></th>

                                    </tr>


                                    </tbody>

                                    <tr>

                                    <td colspan="3">Total</td>
                                   

                                    <td id="total_amount_debit_disp">0</td>

                                    <th  id="total_amount_credit_disp">0</th>
                                    
                                    <input type="hidden" id="total_amount_inp" name="total_amount">

                                    <input type="hidden" id="total_amount_debit" name="total_debit">

                                    <input type="hidden" id="total_amount_credit" name="total_credit">
                                    

                                    </tr>


                        </table>



                        </div>


                        <div class="col-lg-12 text-center">
                                                            
                            <a class="add_more" href="javascript:void(0);"><span class=""><i class="ri-add-circle-line"></i>Add More</span></a>

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
                    <h4 class="card-title mb-0 flex-grow-1">View Journal Vouchers</h4>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#AddModal" class="btn btn-primary py-1">Add</button>
                </div><!-- end card header -->
                <div class="card-body" id="account_type_id">
                        <!-- CSRF token --> 
                    <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <table id="accountTable" class="table table-bordered table-striped delTable display dataTable">
                        <thead>
                            <tr>
                                <th class="no-sort">Sl no</th>
                                <th>Date</th>
                                <th>Voucher Number</th>
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

			}

	    });



        $(document).on("click", ".del_elem", function() 
        {
            $(this).closest('.so_row').remove();
            cc--;
            totalCalcutate();                                                                           
            grossCalculate();
        });

        /**/





    
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
        /*
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
        */
        /*####*/





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

        d_total += parseInt(sub_tot)||0;

        });


        $('body .credit_amount').each(function()
        {

        var sub_tot = $(this).val();

        c_total += parseInt(sub_tot)||0;

        });

        $('#total_amount_debit').val(d_total);

        $('#total_amount_debit_disp').html(d_total);

        $('#total_amount_credit').val(c_total);

        $('#total_amount_credit_disp').html(c_total);


        }


        $('input[name=qd_gross_profit]').on("keyup change",function(){

        grossCalculate();

        });







           /*account head modal start*/ 
           $("body").on('click', '.view_btn', function(){ 
            
            var id = $(this).data('id');

            $.ajax({

                url : "<?php echo base_url(); ?>Accounts/Payments/View",

                method : "POST",

                data: {id: id},

                success:function(data)
                {   
                    if(data)
                    {
                    var data = JSON.parse(data);

                    $('#p_ref_view').val(data.pay_ref_no);

                    $('#p_date_view').val(data.pay_date);

                    $('#p_credit_acc_view').val('Customer Name');

                    $('#p_pay_method_view').val(data.rm_name);

                    $('#p_bank_view').val(data.bank_name);

                    $('#p_debit_acc_view').val(data.ca_account_id);

                    $('#total_amount_view').html(data.pay_total);

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

                url : "<?php echo base_url(); ?>Accounts/Payments/Delete",

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
                    { data: 'pcv_id' },
                    { data: 'jv_voucher_date'},
                    { data: 'jv_voucher_no' },
                    { data: 'action' },
                ]
                
           });
        }

        $(document).ready(function () {
            initializeDataTable();
        });
        /*###*/




        /* If Cheque  */
        

        $('select[name=p_method]').change(function(){

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

                url : "<?php echo base_url(); ?>Accounts/Payments/FetchInvoices",

                method : "POST",

                data: {id: id},

                dataType: "json",

                success:function(data)
                {

                    //console.log(data);
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

url : "<?php echo base_url(); ?>Accounts/Payments/SelectedInvoices",

method : "POST",

data: form.serialize(),

success:function(data)
{

var data = JSON.parse(data);

$.each(data.html, function(key,value) {

tbody.append('<tr><td>'+value.invoice_id+'</td><td>'+value.account+'</td><td>'+value.date+'</td><td><input class="form-control" name="" type="text"></td><td>'+value.amount+'</td></tr>');

}); 

$('#total_amount').html(data.total);

$('input[name=p_amount]').val(data.total);

}

});

$('#AddModal').modal('show');

$('#InvoicesModal').modal('hide');


});




     

    });


</script>




            
