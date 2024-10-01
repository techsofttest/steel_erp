<!--Start Petty cash voucher  col-->
<div class="tab-pane" id="border-nav-6" role="tabpanel">




 <!-- Add Modal -->


 <div class="modal fade" id="AddModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
            <form  class="Dashboard-form class" id="add_form">
             <input id="added_id" type="hidden" name="pcv_id" value="" autocomplete="off">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Petty Cash Voucher</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


    <div class="row">


<div class="col-lg-12">
    <div class="card">



    <div class="card-body">
                    <div class="live-preview">

                            <div class="row align-items-start">


                                <div class="col-lg-6">


                                <div class="row align-items-center mb-2">

                                <div class="col-col-md-3 col-lg-3">

                                <label for="basiInput" class="form-label">Reference</label>

                                </div>

                                <div class="col-col-md-9 col-lg-9">

                                <input type="text" id="pcvid"  class="form-control" readonly required>

                                </div>

                                </div>



                                <div class="row align-items-center mb-2">

                                    <div class="col-col-md-3 col-lg-3">
                                        <label for="basiInput" class="form-label">Date</label>
                                    </div>
                                        
                                <div class="col-col-md-9 col-lg-9">
                                        <input type="text"  name="pcv_date" class="form-control datepicker" required readonly>
                                    </div>
                                </div>


								<!--end col-->
                                <div class="row align-items-center mb-2">

                                <div class="col-col-md-3 col-lg-3">

                                    <label for="basiInput" class="form-label">Credit Account</label>

                                </div>


                                <div class="col-col-md-9 col-lg-9 select2_parent">

                                        <select class="form-select add_credit_account_select2" name="pcv_credit_account" required>
                                           

                                        </select>

                                    </div>
                                </div>





                                <div class="row align-items-center mb-2 cheque_sec d-none">

                                    
                                    <div class="col-col-md-3 col-lg-3">

                                        <label for="basiInput" class="form-label">Attach</label>

                                    </div>


                                <div class="col-col-md-9 col-lg-9">

                                    <input type="file"  name="" class="form-control ">

                                </div>




                                 </div>






                                </div>




                            <div class="col-lg-6">




                            <div class="row align-items-center mb-2">

                                <div class="col-col-md-3 col-lg-3">

                                    <label for="basiInput" class="form-label">Payment Method</label>

                                </div>
                                    

                                <div class="col-col-md-9 col-lg-9">

                                    <select name="pcv_pay_method" class="form-control" required>

                                    <option value="">Select Payment Method</option>

                                    <?php foreach($r_methods as $r_method){ ?>

                                    <option value="<?= $r_method->rm_id; ?>"><?= $r_method->rm_name; ?></option>

                                    <?php } ?>

                                    </select>

                                </div>

                                </div>



                                <div class="row align-items-center mb-2 cheque_sec d-none">

                                <div class="col-col-md-3 col-lg-3">
                                        <label for="basiInput" class="form-label">Cheque Number</label>
                                        </div>

                                        <div class="col-col-md-9 col-lg-9">
                                        <input type="text"  name="p_cheque_no" class="form-control" required>
                                    </div>
                                </div>


                                <div class="row align-items-center mb-2 cheque_sec d-none">
                                    

                                    <div class="col-col-md-3 col-lg-3">

                                        <label for="basiInput" class="form-label">Cheque Date</label>
                                    
                                    </div>


                                    <div class="col-col-md-9 col-lg-9">

                                    <input type="text"  name="p_cheque_date" class="form-control datepicker" required readonly>

                                    </div>

                                </div>












                            </div>









                                <div class="col-col-md-12 col-lg-12">


<table class="table table-bordered" style="overflow-y:scroll;">

            <thead>
                <tr>    
                <th>Sl No</th>
                <th>Sales Order No</th>
                <th>Debit Account</th>
                <th>Amount</th>
                <th>Link</th>
                <th>Narration</th>
                <th></th>
                </tr>
            </thead>

            <tbody id="sel_invoices">


            <tr class="so_row">

                <th class="sl_no">1</th> 
                
                <th>

                <select name="pcv_sale_invoice[]" class="form-control sales_order_add">

                <option value="0">None</option>

                <?php foreach($sales_orders as $sorder){ ?>

                <option value="<?php echo $sorder->so_id; ?>"><?php echo $sorder->so_reffer_no; ?></option>

                <?php } ?>

                </select>

                </th>


                <th> 
                
                <select name="pcv_account[]" class="form-control inv_account debit_account_select2_add">

                </select>

                </th>
                
                <th><input name="pcv_debit[]" type="number" class="form-control pcv_amount" ></th>

                <th>
                    <a class="btn btn-primary add_invoices disabled" href="javascript:void(0);">Click</a>
                </th>

                <th><input name="pcv_remarks[]" type="text" class="form-control" ></th>

                <th> <a href="javascript:void(0);" class="del_elem" style="display:none;"><i class='ri-close-line'></i></a></th>

            </tr>


            </tbody>


            <!--
            <tr>
            <td colspan="3">Total</td>

            <td id="total_amount_disp">0</td>
            
            <input type="hidden" id="total_amount_inp" name="total_amount">

            </tr>
            -->


            <tr>

            <td colspan="1"></td>

            <td colspan="3" align="left" class="sales_quotation_amount_in_word_disabled"></td>

            <td align="right" colspan="3">Total</td>

            <th  id="total_amount_disp">0</th>

            <input type="hidden" id="total_amount_add" name="total_amount" value="">

            </tr>


</table>



</div>


<div class="col-lg-12 text-center">
                                    
    <a class="add_more" href="javascript:void(0);"><span class=""><i class="ri-add-circle-line"></i>Add More</span></a>

</div>



                                <div>

                                <div style="float: right;">
                                                            <table class="table table-bordered table-striped enq_tab_submit menu">
                                                                <tr>
                                                                    <td><button>Print</button></td>
                                                                    <td><button>Email</button></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><button type="submit">Save</button></td>
                                                                    <td><button>PDF</button></td>
                                                                </tr>
                                                            </table>
                                </div>

                                </div>





                            </div>
                        <!--end row-->
						</form>
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




    <!--Edit Modal section start-->
<div class="modal fade" id="EditModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form id="edit_form" class="Dashboard-form">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Petty Cash Voucher</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                    <div class="row">



                    <div class="col-lg-12">
    <div class="card">



    <div class="card-body">
                    <div class="live-preview">
					
                            <div class="row align-items-start">


                                <div class="col-lg-6">



                                <div class="row align-items-center mb-2">

                                <input type="hidden" id="pcv_id_edit" name="pcv_id" value="">

                                    <div class="col-col-md-3 col-lg-3">
                                        <label for="basiInput" class="form-label">Date</label>
                                    </div>
                                        
                                <div class="col-col-md-9 col-lg-9">
                                        <input id="pcv_date_edit" type="date" onclick="this.showPicker()"  name="pcv_date" class="form-control " required>
                                    </div>
                                </div>


								<!--end col-->
                                <div class="row align-items-center mb-2">

                                <div class="col-col-md-3 col-lg-3">

                                    <label for="basiInput" class="form-label">Credit Account</label>

                                </div>


                                <div class="col-col-md-9 col-lg-9 select2_parent">

                                        <!--
                                        <select id="pcv_credit_edit" class="form-select debit_account_select2" name="pcv_credit_account" required>
                                        </select>
                                        -->

                                        <input class="form-control" id="pcv_credit_edit" value="" readonly>

                                    </div>
                                </div>





                                <div class="row align-items-center mb-2 cheque_sec d-none">

                                    
                                    <div class="col-col-md-3 col-lg-3">

                                        <label for="basiInput" class="form-label">Attach</label>

                                    </div>


                                <div class="col-col-md-9 col-lg-9">

                                    <input type="file"  name="" class="form-control ">

                                </div>




                                 </div>






                                </div>




                            <div class="col-lg-6">




                            <div class="row align-items-center mb-2">

                                <div class="col-col-md-3 col-lg-3">

                                    <label for="basiInput" class="form-label">Payment Method</label>

                                </div>
                                    

                                <div class="col-col-md-9 col-lg-9">

                                    <select name="pcv_pay_method" id="pcv_pay_method" class="form-control" required>

                                    <option value="">Select Payment Method</option>

                                    <?php foreach($r_methods as $r_method){ ?>

                                    <option value="<?= $r_method->rm_id; ?>"><?= $r_method->rm_name; ?></option>

                                    <?php } ?>

                                    </select>

                                </div>

                                </div>



                                <div class="row align-items-center mb-2 cheque_sec d-none">

                                <div class="col-col-md-3 col-lg-3">
                                    <label for="basiInput" class="form-label">Cheque Number</label>
                                </div>

                                        <div class="col-col-md-9 col-lg-9">
                                        <input type="text"  name="p_cheque_no" class="form-control">
                                    </div>
                                </div>


                                <div class="row align-items-center mb-2 cheque_sec d-none">
                                    

                                    <div class="col-col-md-3 col-lg-3">

                                        <label for="basiInput" class="form-label">Cheque Date</label>
                                    
                                    </div>


                                    <div class="col-col-md-9 col-lg-9">

                                    <input type="date"  name="p_cheque_date" class="form-control">

                                    </div>

                                </div>




                            </div>




                            <div class="col-lg-6">


                            <div style="float: right;">

                                    <table class="table table-bordered table-striped enq_tab_submit menu">
                                                        
                                    <tr>
                                           <td><button class="submit_btn" type="submit">Update</button></td>
                                    </tr>

                                    </table>
                            </div>


                            </div>




                        <div class="col-col-md-12 col-lg-12">


<table class="table table-bordered" style="overflow-y:scroll;">

            <thead>
                <tr>
                    
                <th>Sales Order No</th>
                <th>Debit Account</th>
                <th>Amount</th>
                <th>Narration</th>
                <th>Actions</th>
                </tr>
            </thead>


            <tbody id="sel_invoices_edit">

         
            <tr>

            <td colspan="6">

            <div class="col-lg-12 text-center">
                                    
              <a class="add_more" href="javascript:void(0);"><span class=""><i class="ri-add-circle-line"></i>Add More</span></a>
        
            </div>
            
            </td>

            </tr>


            </tbody>



            <tr>

            <td colspan="1"></td>

            <td colspan="3" align="left" class="sales_quotation_amount_in_word"></td>

            <td align="right" colspan="3">Total</td>

            <th  id="total_amount_edit">0</th>


            </tr>




</table>


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






















    
<!-- Invoices Seletion Modal -->


<div class="modal fade" id="InvoicesModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
            <form method="POST" class="Dashboard-form class" id="invoices_add">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Select Invoices</h5>
                <button type="button" class="btn-close" data-bs-target="#AddModal" data-bs-toggle="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            <input type="hidden" name="credit_id" value="">

    <div class="row">


<div class="col-lg-12">

    <div class="card">
       
        <div class="card-body">

            <div class="live-preview">
            
                    <div class="row align-items-end">

                        <div class="col-col-md-12 col-lg-12">

                        <div class="row align-items-center">

                        <div class="col-lg-10"> 

                        <table class="table table-bordered">


                                    <thead>
                                        <tr>
                                        <th>Sl No</th>
                                        <th>Date</th>
                                        <th>Invoice No</th>
                                        <th>LPO Ref</th>
                                        <th>Amount</th>
                                        <th>Receipt</th>
                                        <th>Tick</th>
                                        </tr>
                                    </thead>


                                    <tbody id="invoices_sec">


                                    </tbody>


                                    <!--
                                    <tr>

                                    <td>Total Receipt</td>

                                    <td></td>

                                    <td>Adjusted</td>

                                    <td></td>


                                    <td>Balance</td>

                                    <td></td>

                                    </tr>
                                    -->


                        </table>

                        </div>



                        <div class="col-lg-2">

                        
                        <button type="button" class="w-100" data-bs-toggle="modal" data-bs-target="#SalesOrderModal">Advance</button>

                        <button class="w-100">FIFO</button>

                        <button class="w-100" type="submit">Save</button>



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
                <button type="button" class="btn btn-secondary" data-bs-target="#AddModal" data-bs-toggle="modal">Cancel</button>
                <button type="submit" class="btn btn btn-success">Add</button>
            </div> -->

        </div>
        </form>

    </div>
</div>



<!-- ### -->





  
<!-- View Modal -->


<div class="modal fade" id="SalesOrderModal" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-xl">

    <form class="" id="sales_order_add">

        <div class="modal-content">
            <div class="modal-header">
                <!--<h5 class="modal-title" id="exampleModalLabel">Sales Orders</h5>-->
                <button type="button" class="btn-close" data-bs-toggle="modal" data-bs-target="#InvoicesModal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


    <div class="row">


<div class="col-lg-12">
    <div class="card">
       
        <div class="card-body">
            <div class="live-preview">
            
                    <div class="row align-items-end">


                        <div class="col-col-md-12 col-lg-12">

                        <table class="table table-bordered" style="overflow-y:scroll;">

                                    <thead>
                                        <tr>
                                        <th>Sl No</th>
                                        <th>Vendor</th>
                                        <th>LPO Ref</th>
                                        <th>Amount</th>
                                        <th>Receipt</th>
                                        <th>Tick</th>
                                        <th></th>
                                        </tr>
                                    </thead>


                                    <tbody id="lpo_body">

                                        <tr class="lpo_row">

                                        <td class="lpo_slno">1</td>

                                        <td>

                                        <select class="form-control" name="lpo_select">

                                        <option value="">Select Vendor</option>



                                        </select>
                                        
                                        </td>

                                        <td>LPO12345</td>
                                        <td>10000</td>
                                        <td><input class="form-control" type="number" name="lpo_reciept[]"></td>
                                        <td><input type="checkbox" name="lpo_selected[]"></td>

                                        
                                        <th> <a href="javascript:void(0);" class="lpo_del_elem" style="display:none;"><i class='ri-close-line'></i></a></th>


                                        </tr>



                                    </tbody>

                                    <tr>

                                    <td colspan="6">

                                    <div class="col-lg-12 text-center">
                                                            
                                    <a class="lpo_add_more" href="javascript:void(0);"><span class=""><i class="ri-add-circle-line"></i>Add More</span></a>

                                    </div>

                                    </td>

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


   <div class="modal-footer justify-content-center">
    
                <button type="submit" class="btn btn btn-success">Save</button>
    </div>
           

        </div>
     
</form>

    </div>
</div>


<!-- ## -->















    		
					
	<div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">View Petty Cash Vouchers</h4>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#AddModal" class="btn btn-primary py-1 add_model_btn">Add</button>
                </div><!-- end card header -->
                <div class="card-body">
                    <table id="datatable" class="table table-bordered table-striped delTable">
                        
                        <thead>
                            <tr>
                                <th class="no-sort">Sl no</th>
                                <th>Date</th>
                                <th>Voucher No</th>
                                <th>Credit Account</th>
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
										
										
<!--end Petty cash voucher col-->

<script>

    document.addEventListener("DOMContentLoaded", function(event){




        $("body").on('change', '.debit_account_select2_add', function(){

        parent = $(this).closest('.so_row');

        parent.find('.add_invoices').removeClass('disabled');

        });

        
        $('.add_model_btn').click(function(){


        $('#added_id').val('');

        $('#add_form')[0].reset();

        $('.so_row').not(':first').remove();

        InitAccountsSelect2('.debit_account_select2_add','.so_row');

        $.ajax({

        url : "<?php echo base_url(); ?>Accounts/PettyCashVoucher/FetchReference",

        method : "GET",

        success:function(data)
        {

        $('#pcvid').val(data);

        }

        });

        });




       


        /* Start Add Petty Cash Voucher */


        //Add Function 
        $(function() {
            $('#add_form').validate({
                
                rules: {
                    required: 'required',
                },
                messages: {
                    required: 'This field is required',
                },
                errorPlacement: function(error, element) {} ,
                submitHandler: function(form){
                    $.ajax({
                        url: "<?php echo base_url(); ?>Accounts/PettyCashVoucher/Add",
                        method: "POST",
                        data: $(form).serialize(),
                        success: function(data){
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

        //###



          /*Add More Debit*/

            var max_fieldcost = 30;

            $("body").on('click', '.add_more', function(){

            var cc = $('.so_row').length;

            if(cc < max_fieldcost){ 

            cc++;

            //$(".cost_cal").append("<div class='row cost_cal_row'><div class='col-md-3 col-lg-3'><label for='basicInput' class='form-label'>Material / Services</label><select id='quotation_material' class='form-control quotation_material_clz'><option value='' selected disabled>Select Material / Services</option></select></div><div class='col-md-3 col-lg-3'><label for='basiInput' class='form-label'>Qty</label><input type='number' name='qd_qty' class='form-control cost_qty' required></div><div class='col-md-3 col-lg-3'><label for='basicInput' class='form-label'>Rate</label><input type='number' name='qd_rate' class='form-control cost_rate' required></div><div class='col-md-3 col-lg-3'><label for='basicInput' class='form-label'>Amount</label><input readonly type='number' name='qd_amount' class='form-control cost_amount' required style='width:95%'></div><div class='remove-cost'><div class='remainpass cost_remove'><i class='ri-close-line'></i></div></div></div>");

            var $clone =  $('.so_row:first').clone();

            $clone.find("input").val("");

            //$clone.find("select").val("");

            $clone.find(".debit_account_select2_add").val('');

            $clone.find(".debit_account_select2_add").removeAttr('data-select2-id');

            $clone.find('.select2').remove();

            $clone.find(".sl_no").html(cc);

            $clone.find(".del_elem").show();

            $clone.find('.add_invoices').addClass('disabled');

            $clone.insertAfter('.so_row:last');

            InitAccountsSelect2('.debit_account_select2_add','.so_row');

            }

            });

            // ####





              /*account head delete*/ 
        $("body").on('click', '.delete_btn', function(){ 
            
            if (!confirm('Are you absolutely sure you want to delete?')) return;
            var id = $(this).data('id');
            $.ajax({

                url : "<?php echo base_url(); ?>Accounts/PettyCashVoucher/Delete",

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




            // Delete Add More Field

            $(document).on("click", ".del_elem", function() 
            {

            $(this).closest('.so_row').remove();

            var sl_no =1;

            $('body .so_row').each(function()
            {

            $(this).find('.sl_no').html(sl_no);

            sl_no++;

            });

            totalCalcutate();  

            });

            //#####



            //Calcuate Total On Amount Keyup

            $("body").on('keyup', '.pcv_amount', function(){ 

            totalCalcutate();    

            });

            //#######




             /* Show Cheque Fields  */

            $('select[name=pcv_pay_method]').change(function(){

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





        /* End Add Petty Cash Voucher */


          


        /*
        function totalCalcutate()
        {
 
        var total = 0;
        
        $('body .pcv_amount').each(function()
        {

        var sub_tot = $(this).val();

        total += parseInt(sub_tot)||0;

        });

        $('#total_amount_inp').val(total);

        $('#total_amount_disp').html(total);


        }
        */

        
        

    /* Start Edit Petty Cash Voucher */


    //Onclick Edit Show And Populate Modal
    $("body").on('click', '.edit_btn', function(){ 

    var id = $(this).data('id');


    $("#EditModal :input").prop("disabled", false);

    $('#EditModal .submit_btn').show();

    $('#EditModal .edit_invoice').show();

    $('#EditModal .view_linked').show();



    $.ajax({

    url : "<?php echo base_url(); ?>Accounts/PettyCashVoucher/Edit",

    method : "POST",

    data: {id: id},

    success:function(data)
    {   
        if(data)
        {

        var data = JSON.parse(data);

        $('#pcv_id_edit').val(data.pcv.pcv_id);

        $('#pcv_date_edit').val(data.pcv.pcv_date);

        $('#pcv_credit_edit').val(data.pcv.ca_name);

        $('#pcv_pay_method').val(data.pcv.pcv_pay_method);

        $('#total_amount_edit').html(data.pcv.pcv_total);

        $('#sel_invoices_edit').html(data.debit);

        $('#EditModal').modal('show');
        
        }
        else
        {
        alertify.error('Something went wrong!').delay(8).dismissOthers();  
        }
        
        }


        });


        });

        //######



        //Update Petty Cash Voucher

        $(document).ready(function(){
            $('#edit_form').submit(function(e){

                e.preventDefault();
                
                $.ajax({

                    url : "<?php echo base_url(); ?>Accounts/PettyCashVoucher/Update",

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




        /* End Edit Petty Cash Voucher*/






        //Onclick Edit Show And Populate Modal
    $("body").on('click', '.view_btn', function(){ 

var id = $(this).data('id');


$.ajax({

url : "<?php echo base_url(); ?>Accounts/PettyCashVoucher/Edit",

method : "POST",

data: {id: id},

success:function(data)
{   
    if(data)
    {

    var data = JSON.parse(data);

    $('#pcv_id_edit').val(data.pcv.pcv_id);

    $('#pcv_date_edit').val(data.pcv.pcv_date);

    $('#pcv_credit_edit').val(data.pcv.pcv_credit_account);

    $('#pcv_pay_method').val(data.pcv.pcv_pay_method);

    $('#total_amount_edit').html(data.pcv.pcv_total);

    $('#sel_invoices_edit').html(data.debit);


    $("#EditModal :input").prop("disabled", true);

    $('#EditModal .btn-close').prop("disabled",false);

    $('#EditModal .submit_btn').hide();

    $('#EditModal .edit_invoice').hide();

    $('#EditModal .view_linked').hide();


    $('#EditModal').modal('show');
    
    }
    else
    {
    alertify.error('Something went wrong!').delay(8).dismissOthers();  
    }
    
    }


    });


    });

    //######




    $("body").on('click', '.add_invoices', function(e){ 

    alertify.error('No invoices found!').delay(8).dismissOthers();

    });

    




        /* Start Debit Section */



        //Add 
        
        $("body").on('submit', '#invoices_add', function(e){ 

        e.preventDefault();

        /*
        $('#sel_invoices').html('');

        var form = $(this);

        var tbody =  $('#sel_invoices');

        $.ajax({

        url : "<?php echo base_url(); ?>Accounts/Payments/SelectedInvoices",

        method : "POST",

        data: form.serialize(),

        processData: false,

        success:function(data)
        {

        var data = JSON.parse(data);

        //console.log(data);

        $.each(data.html, function(key,value) {
        //alert(value.so_o);
        tbody.append('<tr><td>'+value['pf_date']+'</td><td><input type="hidden" name="pf_id[]" value="'+value['pf_id']+'">'+value['pf_uid']+'</td><td><input class="form-control" name="pf_remarks[]" type="text"></td><td>'+value['pf_total_cost']+'</td></tr>');

        }); 

        $('#total_amount').html(data.total);

        $('input[name=p_amount]').val(data.total);


        }

        });

        */



        $('#AddModal').modal('show');

        $('#InvoicesModal').modal('hide');

        alertify.success('Saved!').delay(8).dismissOthers();


        });





    /* Edit Invoice Start */

     $("body").on('click', '.edit_invoice', function(){

    var id = $(this).data('id'); 

    $('#view'+id+'').find('.edit').show();

    $('#view'+id+'').find('.view').hide();

    $('#pd_id_edit').val(id);

    $.ajax({

    url : "<?php echo base_url(); ?>Accounts/PettyCashVoucher/EditInvoice",

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




    //Cancel Credit Edit

    $('body').on('click','.cancel_invoice_btn',function(){

        var id = $(this).data('id'); 

        $('#view'+id+'').find('.edit').hide();

        $('#view'+id+'').find('.view').show();

        });


        //





        //Update Invoices

        $('body').on('click','.update_invoice_btn',function(){

        var id = $(this).data('id'); 

        parent = $(this).closest('.view_debit');

        var debit_id = parent.find('input[name=debit_id]').val();

        var date = parent.find('input[name=date]').val();

        var debit_account = parent.find('select[name=c_name]').val();

        var amount = parent.find('input[name=amount]').val();

        var narration = parent.find('input[name=remarks]').val();

        $.ajax({

        url : "<?php echo base_url(); ?>Accounts/PettyCashVoucher/UpdateDebitDetails",

        method : "POST",

        data: {d_id:debit_id,d_date:date,d_account:debit_account,d_amount:amount,d_narration:narration},

        success:function(data)
        {

        var data = JSON.parse(data);

        $('#view'+data.inv_id+'').html(data.debit);

        $('#total_amount_edit').html(data.total);

        $('#view'+data.inv_id+'').find('.edit').hide();

        $('#view'+data.inv_id+'').find('.view').fadeIn(200);

        }
        }); 

        });

        //#########


        //Cancel Credit Edit

        $('body').on('click','.cancel_invoice_btn',function(){

        var id = $(this).data('id'); 

        $('#view'+id+'').find('.edit').hide();

        $('#view'+id+'').find('.view').fadeIn(200);

        });


        //











        /* End Debit Section */

















        /*sales order  droupdrown*/
         $(".order_select").select2({
        placeholder: "Sales order No",
        theme : "default form-control-",
        ajax: {
                url: "<?= base_url(); ?>Accounts/PettyCashVoucher/FetchTypes",
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
                processResults: function(data, params){
                    //console.log(data);
                    //  NO NEED TO PARSE DATA `processResults` automatically parse it
                    //var c = JSON.parse(data);
                    console.log(data);
                    var page = params.page || 1;
                    return {
                        results: $.map(data.result, function (item) { return {id: item.so_id, text: item.so_order_no}}),
                        pagination: {
                        // THE `10` SHOULD BE SAME AS `$resultCount FROM PHP, it is the number of records to fetch from table` 
                            more: (page * 10) <= data.total_count
                        }
                    };
                },              
            }
        })
        /*###*/






         /*data table start*/ 


         function initializeDataTable() {

            datatable = $('#datatable').DataTable({
                'stateSave': true,
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url': "<?php echo base_url(); ?>Accounts/PettyCashVoucher/FetchData",
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
                    { data: 'pcv_date'},
                    { data: 'pcv_voucher_no' },
                    { data :'pcv_credit_account'},
                    { data: 'action' },
                ]
                
            });
            }

            $(document).ready(function () {
            initializeDataTable();
            });

            /*###*/




                /* Fetch Invoices */

     







      /* Sales Order  */

      $("body").on('click', '.lpo_add_more', function(){

var cc = $('.lpo_row').length;

if(cc < 30){ 

cc++;

var $clone =  $('.lpo_row:first').clone();

$clone.find("input").val("");

$clone.find("select").val("");

$clone.find(".lpo_slno").html(cc);

$clone.find(".lpo_del_elem").show();

$clone.insertAfter('.lpo_row:last');

}

});


$(document).on("click", ".lpo_del_elem", function() 
{
$(this).closest('.lpo_row').remove();
cc--;
//totalCalcutate();                                                                           
//grossCalculate();
});

/**/

function lpo_slno(){

var pp =1;

$('body .lpo_row').each(function() {

$(this).find('.lpo_slno').html('<td class="si_no">' + pp + '</td>');

pp++;

});

}


/* ### */












$('#sales_order_add').submit(function(e){

e.preventDefault();

alertify.success('Saved!').delay(3).dismissOthers();   

$('#SalesOrderModal').modal('hide');

$('#AddModal').modal('show');

    

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

                
                InitAccountsSelect2('.add_credit_account_select2','.select2_parent');

                InitAccountsSelect2('.edit_credit_account_select2','.select2_parent');

                InitAccountsSelect2('.debit_account_select2','.so_row');

                /* ### */
                
            //


             /* Select 2 Remove Validation On Change */
             $(".add_credit_account_select2").on("change",function(e) {
                    $(this).parent().find(".error").removeClass("error");         
                });
                /*###*/



});




        function totalCalcutate()
        {

            var total= 0;

            $('body .pcv_amount').each(function()
            {
            var sub_tot = parseFloat($(this).val());
            total += parseFloat(sub_tot.toFixed(2))||0;
               //total = Number(total).toFixed(2)
            });

           total = total.toFixed(2);

           $('#total_amount_inp').val(total);

           $('#total_amount_add').val(total);

           $('#total_amount_disp').html(total);
           
           var resultQuotation = numberToWords.toWords(total);

            $(".sales_quotation_amount_in_word").text(resultQuotation);

            $(".sales_quotation_amount_in_word_val").val(resultQuotation);
           

        }




</script>

