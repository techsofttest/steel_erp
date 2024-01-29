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


                    <div class="col-col-md-2 col-lg-2">
                            <div>
                                <label for="basiInput" class="form-label">Reference No</label>
                                <input type="text"  id="r_ref_view" class="form-control" value="" disabled>
                            </div>
                    </div>


                        <div class="col-col-md-2 col-lg-2">
                            <div>
                                <label for="basiInput" class="form-label">Date</label>
                                <input type="text"  id="r_date" class="form-control" value="" disabled>
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
                                        <th>Date</th>
                                        <th>Order No</th>
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




<!-- Advance Sales Order modal -->



<!-- View Modal -->


<div class="modal fade" id="SalesOrderModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sales Orders</h5>
                <button type="button" class="btn-close" data-bs-toggle="modal" data-bs-target="InvoicesModal" aria-label="Close"></button>
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
                                        <th>Sales Order</th>
                                        <th>Customer</th>
                                        <th>Amount</th>
                                        <th>Receipt</th>
                                        <th>Tick</th>
                                        <th></th>
                                        </tr>
                                    </thead>


                                    <tbody id="so_body">

                                        <tr class="so_row">

                                        <td class="so_slno">1</td>

                                        <td>
                                        <select class="form-control" name="so_select">

                                        <option value="">Select Sales Order</option>

                                        <option value="1">SO123456</option>

                                        <option value="2">SO123456</option>

                                        </select>
                                        
                                        </td>

                                        <td>Pixel Trading</td>
                                        <td>10000</td>
                                        <td><input class="form-control" type="number" name="so_reciept[]"></td>
                                        <td><input type="checkbox" name="so_selected[]"></td>

                                        
                                        <th> <a href="javascript:void(0);" class="so_del_elem" style="display:none;"><i class='ri-close-line'></i></a></th>


                                        </tr>



                                    </tbody>

                                    <tr>

                                    <td colspan="6">

                                    <div class="col-lg-12 text-center">
                                                            
                                    <a class="so_add_more" href="javascript:void(0);"><span class=""><i class="ri-add-circle-line"></i>Add More</span></a>

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
     

    </div>
</div>




<!-- ## -->









									
<div class="tab-pane active" id="border-nav-1" role="tabpanel">


    <!-- Add Modal -->


    <div class="modal fade" id="AddModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
            <form  class="Dashboard-form class" data-submit="false" data-rcid="" id="add_form">
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
            
                    <div class="row align-items-start">

                    <!-- Section 1 -->

                    <div class="col-lg-6">

                    <div class="row align-items-center mb-2">

                    <div class="col-col-md-3 col-lg-3">

                    <label for="basiInput" class="form-label">Reference</label>

                    </div>

                    <div class="col-col-md-9 col-lg-9">

                    <input type="text" id="ruid"  class="form-control" readonly required>

                    </div>

                    </div>



                    <div class="row align-items-center mb-2">

                    <div class="col-col-md-3 col-lg-3">
                           
                            <label for="basiInput" class="form-label">Date</label>

                    </div>

                        <div class="col-col-md-9 col-lg-9">

                        <input type="date"  name="r_date" value="<?= date('Y-m-d') ?>" class="form-control" required>

                        </div>

                        </div>



                        <div class="row align-items-center mb-2">

                        <div class="col-col-md-3 col-lg-3">

                            <label for="basiInput" class="form-label">Debit Account</label>
                            <!--<input type="text"  name="r_debit_account" class="form-control" required>-->

                        </div>


                        <div class="col-col-md-9 col-lg-9">

                        <select class="form-control" name="r_debit_account">

                        <option value="">Select Account</option>

                        <?php foreach($accounts as $a_ac){ ?>

                         <option value="<?php echo $a_ac->ca_id; ?>"><?php echo $a_ac->ca_name; ?></option>

                        <?php } ?>

                        </select>

                        </div>

                        </div> 




                         <div class="row align-items-center mb-2">

                            <div class="col-col-md-3 col-lg-3">

                            <label for="basiInput" class="form-label">Receipt No</label>
                            
                         </div>

                        <div class="col-col-md-9 col-lg-9">

                        <input type="text"  name="r_receipt_no" class="form-control" required>

                        </div>

                        </div>



                    </div> <!-- Section 1 end -->







                    <div class="col-lg-6">


                    <div class="row align-items-center mb-2">

                    <div class="col-col-md-3 col-lg-3">

                        <label for="basiInput" class="form-label">Receipt Method</label>

                    </div>
                        

                    <div class="col-col-md-9 col-lg-9">

                        <select name="r_method" class="form-control" required>

                        <option value="">Select Receipt Method</option>

                        <?php foreach($r_methods as $r_method){ ?>

                        <option value="<?= $r_method->rm_id; ?>"><?= $r_method->rm_name; ?></option>

                        <?php } ?>

                        </select>

                    </div>

                    </div>



                      <!--

                    <div class="row align-items-center mb-2">
                        
                        <div class="col-col-md-3 col-lg-3">
                                
                            <label for="basiInput" class="form-label">Credit Account</label>
                                
                        </div>


                      
                        <div class="col-col-md-9 col-lg-9">

                            <select name="r_credit_account" class="form-control" required>

                            <option value="">Select Credit Account</option>

                            <?php foreach($customers as $cus) { ?>

                            <option value="<?= $cus->cc_account_id; ?>"><?= $cus->cc_customer_name; ?></option>

                            <?php } ?>

                            </select>

                        </div>
                        

                    </div>

                    -->



                    <div class="row align-items-center mb-2">
                    <div class="col-col-md-3 col-lg-3">
                        <label for="basiInput" class="form-label">Bank</label>
                    </div>

                    <div class="col-col-md-9 col-lg-9">
                        <select name="r_bank" class="form-control" required>
                        <option value="">Select Bank</option>
                        <?php foreach($banks as $a_bank){ ?>
                        <option value="<?= $a_bank->bank_id ?>"><?= $a_bank->bank_name ?></option>
                        <?php } ?>
                        </select>
                    </div>
                    
                    </div>






                    <div class="row align-items-center mb-2 cheque_sec d-none">

                    <div class="col-col-md-3 col-lg-3">
                       
                        <label for="basiInput" class="form-label">Cheque Number</label>
                              
                    </div>

                    <div class="col-col-md-9 col-lg-9">

                      <input type="text"  name="r_cheque_no" class="form-control" required>

                    </div>

                    </div>




                    <div class="row align-items-center mb-2 cheque_sec d-none">

                    <div class="col-col-md-3 col-lg-3">
                            
                        <label for="basiInput" class="form-label">Cheque Date</label>

                    </div>

                    <div class="col-col-md-9 col-lg-9">

                    <input type="date"  name="r_cheque_date" class="form-control" required>

                    </div>

                    </div>

                    

                    </div>


                        <input type="hidden" name="r_amount" value="">


                        <div class="col-col-md-12 col-lg-12">


                        <table class="table table-bordered" style="overflow-y:scroll;">

                                    <thead>
                                        <tr>
                                        <th>Date</th>
                                        <th>Credit Account</th>
                                        <th>Amount</th>
                                        <th>Link</th>
                                        <th>Narration</th>
                                        </tr>
                                    </thead>


                                    <tbody id="sel_invoices">

                                    <tr class="invoice_row">


                                    <td>

                                    <input class="credit_sl_no" type="hidden" name="credit_sl_no[]" value="1">

                                    <input class="form-control" type="date" name="inv_date[]">
                                
                                    </td>


                                    <td> 

                                       <select class="form-control credit_account" name="r_credit_account[]">

                                       <option value="">Select Credit Account</option>

                                       <?php foreach($customers as $cus) { ?>

                                        <option value="<?= $cus->cc_id; ?>"><?= $cus->cc_customer_name; ?></option>

                                        <?php } ?>

                                       </select> 
                                    </td>


                                    <td>

                                        <input class="form-control" type="number" name="inv_amount[]">

                                    </td>


                                    <td>
                                      <a class="btn btn-primary add_invoices" href="javascript:void(0);">Click</a>
                                    </td>

                                    <td>

                                    <input class="form-control" type="text" name="narration[]"/>

                                    </td>


                                    <th> <a href="javascript:void(0);" class="del_elem" style="display:none;"><i class='ri-close-line'></i></a></th>


                                    </tr>



                                    
                                    <tr>

                                    <td colspan="6">

                                    <div class="col-lg-12 text-center">
                                                            
                                      <a class="add_more" href="javascript:void(0);"><span class=""><i class="ri-add-circle-line"></i>Add More</span></a>
                                
                                    </div>
                                    
                                    </td>

                                    </tr>


                                    </tbody>





                                    <tr>

                                    <td align="right" colspan="3">Total</td>

                                    <th  id="total_amount">0</th>


                                    </tr>




                        </table>


                        </div>



                        <div class="row">


                        <div class="col-lg-6">


                        <div class="row align-items-center justify-content-start mb-2">
                        
                        <div class="col-col-md-3 col-lg-3">
    
                            <label for="basiInput" class="form-label">Collected By</label>
                            
                        </div>
    
    
                        <div class="col-col-md-6 col-lg-6">
    
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




                        <div class="row align-items-center justify-content-start mb-2 cheque_sec d-none">

                        <div class="col-col-md-3 col-lg-3">
                            <label for="basiInput" class="form-label">Cheque Copy</label>
                        </div>

                        <div class="col-col-md-6 col-lg-6">
                            <input type="file"  name="r_cheque_copy" class="form-control" required>
                        </div>

                        </div>




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
                    <h4 class="card-title mb-0 flex-grow-1">View Reciepts</h4>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#AddModal" class="btn btn-primary py-1 add_model_btn">Add</button>
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



<!--
<script src="<?php echo base_url(); ?>public/assets/js/jquery.num2words.js"></script>
-->            

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
                errorPlacement: function(error, element) {} ,
                submitHandler: function(form) {

                    $.ajax({
                        url: "<?php echo base_url(); ?>Accounts/Receipts/Add",
                        method: "POST",
                        data: $(form).serialize(),
                        success: function(data) {
                            //$('#add_form')[0].reset();
                            $('#AddModal').modal('hide');
                            alertify.success('Data Added Successfully').delay(3).dismissOthers();
                            $('#add_form').attr('data-submit','true');
                            $('#add_form').attr('data-rcid',data);
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

        $("body").on('click', '.add_more', function(){

         
            var cc = $('.invoice_row').length;

			if(cc < max_fieldcost){ 

            cc++;
            //$(".cost_cal").append("<div class='row cost_cal_row'><div class='col-md-3 col-lg-3'><label for='basicInput' class='form-label'>Material / Services</label><select id='quotation_material' class='form-control quotation_material_clz'><option value='' selected disabled>Select Material / Services</option></select></div><div class='col-md-3 col-lg-3'><label for='basiInput' class='form-label'>Qty</label><input type='number' name='qd_qty' class='form-control cost_qty' required></div><div class='col-md-3 col-lg-3'><label for='basicInput' class='form-label'>Rate</label><input type='number' name='qd_rate' class='form-control cost_rate' required></div><div class='col-md-3 col-lg-3'><label for='basicInput' class='form-label'>Amount</label><input readonly type='number' name='qd_amount' class='form-control cost_amount' required style='width:95%'></div><div class='remove-cost'><div class='remainpass cost_remove'><i class='ri-close-line'></i></div></div></div>");
          
            var $clone =  $('.invoice_row:first').clone();

            $clone.find("input").val("");

            $clone.find("select").val("");

            $clone.find(".sl_no").html(cc);

            $clone.find(".del_elem").show();

            $clone.find('.credit_sl_no').val('2');

            $clone.insertAfter('.invoice_row:last');

			}

	    });



        $(document).on("click", ".del_elem", function() 
        {
            $(this).closest('.invoice_row').remove();
            cc--;
            //totalCalcutate();                                                                           
            //grossCalculate();
        });

        /**/





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
            $('.cheque_sec').removeClass("d-none");
            }
            else
            {
            $('.cheque_sec').addClass("d-none");
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
        
            /*
            if(!$("#add_form").valid())
            {
                alertify.error('Fill required fields!').delay(3).dismissOthers();
                return false;
            }
            */


            if($('#add_form').attr('data-submit')=='false')
            {
             $('#add_form').submit();

                if(!$("#add_form").valid())
                {
                alertify.error('Fill required fields!').delay(3).dismissOthers();
                return false;
                }

            }

            var parent = $(this).closest('tr');

            var c_account = parent.find('.credit_account');

            if( c_account.val() =="")
            {

            alertify.error('Select Credit Account!').delay(3).dismissOthers();   

            return false;

            }
            
            //var id=1;

            var id = c_account.val(); //Customer_ID

            $.ajax({

                url : "<?php echo base_url(); ?>Accounts/Receipts/FetchInvoices",

                method : "POST",

                data: {id: id},

                dataType: "json",

                success:function(data)
                {

                    
                    if(data.status==0)
                    {
                    alertify.error('No Invoices Found!').delay(3).dismissOthers();   

                    return false;
                    }
                    

                    $('#invoices_sec').hide().html(data.invoices).fadeIn(200);

                    $('#AddModal').modal('hide');

                    $('#InvoicesModal').modal('show');

                }


            });

        });

        /*##*/


        /*
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

        //console.log(data);
        $.each(data.html, function(key,value) {
        //alert(value.so_o);
        tbody.append('<tr><td>'+value['pf_date']+'</td><td><input type="hidden" name="pf_id[]" value="'+value['pf_id']+'">'+value['pf_uid']+'</td><td><input class="form-control" name="pf_remarks[]" type="text"></td><td>'+value['pf_total_cost']+'</td></tr>');

        }); 

        $('#total_amount').html(data.total);

        $('input[name=r_amount]').val(data.total);

        }

        });


        $('#AddModal').modal('show');



        $('#InvoicesModal').modal('hide');


        });
        */



        $('.add_model_btn').click(function(){


            $.ajax({

            url : "<?php echo base_url(); ?>Accounts/Receipts/FetchReference",

            method : "GET",

            success:function(data)
            {

            $('#ruid').val(data);

            }

            });

        });



        //Store in json array instead of db 

        $('#invoices_add').submit(function(e){

        e.preventDefault();



        });



     
    });



</script>






            
