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





<!-- ADD RECEIPT MODALS START -->






<!-- MAIN ADD MODAL START -->

<div class="modal fade" id="AddModal" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl">
            <form  class="Dashboard-form class" data-submit="false" data-rcid="" id="add_form">
                <input id="added_id" type="hidden" name="r_id" value="" autocomplete="off">
                <input id="add_saved" value="no" type="hidden">
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

                        <input type="text" name="r_date" value="<?= date('d-F-Y') ?>" class="form-control datepicker" required readonly>

                        </div>

                        </div>



                        <div class="row align-items-center mb-2">

                        <div class="col-col-md-3 col-lg-3">

                            <label for="basiInput" class="form-label">Debit Account</label>
                            <!--<input type="text"  name="r_debit_account" class="form-control" required>-->

                        </div>


                        <div class="col-col-md-9 col-lg-9 select2_parent">

                        <select class="form-control debit_account_select2" name="r_debit_account" required>

                        </select>

                        </div>

                        </div> 




                         <div class="row align-items-center mb-2">

                            <div class="col-col-md-3 col-lg-3">

                            <label for="basiInput" class="form-label">Receipt No</label>
                            
                         </div>

                        <div class="col-col-md-9 col-lg-9">

                        <input id="receipt_no" type="text"  name="r_receipt_no" class="form-control" autocomplete="off" required>

                        </div>

                        </div>



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



                    



                    <div class="row align-items-center mb-2" id="bank_sec_add">
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

                    <input type="text" name="r_cheque_date" class="form-control datepicker" required readonly>

                    </div>

                    </div>




                   




                        <div class="row align-items-center justify-content-start mb-2 cheque_sec d-none">

                        <div class="col-col-md-3 col-lg-3">
                            <label for="basiInput" class="form-label">Cheque Copy</label>
                        </div>

                        <div class="col-col-md-6 col-lg-6">
                            <input type="file"  name="r_cheque_copy" class="form-control">
                        </div>

                        </div>



                    

                    </div>



                        <div class="col-col-md-12 col-lg-12">


                        <table class="table table-bordered" style="overflow-y:scroll;">

                                    <thead>
                                        <tr>
                                        <th>Sl No</th>
                                        <th>Credit Account</th>
                                        <th>Amount</th>
                                        <th>Link</th>
                                        <th>Narration</th>
                                        </tr>
                                    </thead>


                                    <tbody id="sel_invoices">

                                    <tr class="invoice_row">


                                    <td>


                                    <input class="credit_sl_no form-control" type="number" name="credit_sl_no[]" value="1" readonly>


                                    
                                    </td>


                                    <td class="select2_parent"> 

                                       <select class="form-control credit_account credit_account_select2" name="r_credit_account[]" data-max="">

                                       </select> 
                                    </td>


                                    <td>

                                        <input class="form-control credit_amount" type="number" name="inv_amount[]">

                                    </td>


                                    <td>
                                      <a class="btn btn-primary add_invoices" href="javascript:void(0);">Click</a>
                                    </td>

                                    <td>

                                    <input class="form-control credit_narration" type="text" name="narration[]"/>

                                    </td>


                                    <th> <a href="javascript:void(0);" class="del_elem" style="display:none;"><i class='ri-close-line'></i></a></th>


                                    </tr>



                                    
                                    <tr>

                                    <td colspan="6">

                                    <div class="col-lg-12 text-end">
                                                            
                                      <a class="add_more" href="javascript:void(0);"><span class=""><i class="ri-add-circle-line"></i>Add More</span></a>
                                
                                    </div>
                                    
                                    </td>

                                    </tr>


                                    </tbody>



                                    <tr>

                                    <td colspan="1"></td>

                                    <td colspan="3" align="left" class="amount_in_words_add"></td>

                                    <td align="right" colspan="3">Total</td>

                                    <input type="hidden" id="total_amount_val" name="total_receipt_amount" val="">

                                    <th  id="total_amount">0</th>


                                    </tr>




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
                                                            <td><button class="submit_btn" name="main_submit" type="submit">Save</button></td>
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


<!-- MAIN ADD MODAL END -->





<!-- ADD INVOICES MODAL START -->



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

                        <table class="table table-bordered" id="add_invoice_data_sec">


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


                                   
                                    <tr>

                                    <td>Total Receipt</td>

                                    <td class="invoice_total"></td>

                                    <td>Adjusted</td>

                                    <td class="invoice_adjusted"></td>


                                    <td>Balance</td>

                                    <td class="invoice_balance"></td>

                                    </tr>

                        </table>



                        </div>



                        <div class="col-lg-2">

                        
                        <button type="button" class="w-100" id="add_so_advance_btn" >Advance</button>

                        <button class="w-100" id="fifo_add" type="button">FIFO</button>

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



<!-- ADD INVOICES MODAL END -->





<!-- ADD SALES ORDER ADVANCE MODAL START -->





<div class="modal fade" id="AddSOAdvanceModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">

    <form class="" id="add_sales_order_advance_form">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sales Orders</h5>
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
                                        <th>Sales Order</th>
                                        <th>Customer</th>
                                        <th>Amount</th>
                                        <th>Receipt</th>
                                        <th>Tick</th>
                                        <th></th>
                                        </tr>
                                    </thead>


                                    <tbody id="so_adv_body">


                                    </tbody>



                                        <tr>

                                    <td>Total Receipt</td>

                                    <td class="invoice_total"></td>

                                    <td>Adjusted</td>

                                    <td class="invoice_adjusted"></td>


                                    <td>Balance</td>

                                    <td class="invoice_balance"></td>

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



<!-- ADD SALES ORDER ADVANCE MODAL END -->





<!-- ADD MODALS END -->






<!-- EDIT MODALS START -->


            <!-- MAIN EDIT MODAL START -->


<div class="modal fade" id="EditModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form id="edit_form" class="Dashboard-form">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Receipt</h5>
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

                    <input type="text" id="ruid_edit"  class="form-control" readonly>

                    <input id="id_edit" name="r_id" type="hidden" value="">

                    </div>

                    </div>



                    <div class="row align-items-center mb-2">

                    <div class="col-col-md-3 col-lg-3">
                           
                            <label for="basiInput" class="form-label">Date</label>

                    </div>

                        <div class="col-col-md-9 col-lg-9">

                        <input type="text" id="r_date_edit"  name="r_date" value="<?= date('d-F-Y'); ?>" class="form-control datepicker" required readonly>

                        </div>

                        </div>



                        <div class="row align-items-center mb-2">

                        <div class="col-col-md-3 col-lg-3">

                            <label for="basiInput" class="form-label">Debit Account</label>
                            <!--<input type="text"  name="r_debit_account" class="form-control" required>-->

                        </div>


                        <div class="col-col-md-9 col-lg-9">

                        <input id="r_debit_account_edit" type="text"  name="r_debit_account" class="form-control" readonly>

                        <!--
                        <select id="r_debit_account_edit" class="form-control" name="r_debit_account">

                        </select>
                        -->

                        </div>

                        </div> 




                         <div class="row align-items-center mb-2">

                            <div class="col-col-md-3 col-lg-3">

                            <label for="basiInput" class="form-label">Receipt No</label>
                            
                         </div>

                        <div class="col-col-md-9 col-lg-9">

                        <input type="text" id="r_no_edit"  name="r_receipt_no" class="form-control" required>

                        </div>

                        </div>



                    </div> <!-- Section 1 end -->







                    <div class="col-lg-6">


                    <div class="row align-items-center mb-2">

                    <div class="col-col-md-3 col-lg-3">

                        <label for="basiInput" class="form-label">Receipt Method</label>

                    </div>
                        

                    <div class="col-col-md-9 col-lg-9">

                        <select id="r_method_edit" name="r_method" class="form-control" required>

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

                            </select>

                        </div>
                        

                    </div>

                    -->



                    <div class="row align-items-center mb-2 bank_sec_edit">
                    <div class="col-col-md-3 col-lg-3">
                        <label for="basiInput" class="form-label">Bank</label>
                    </div>

                    <div class="col-col-md-9 col-lg-9">
                        <select id="r_bank_edit" name="r_bank" class="form-control" required>
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

                      <input type="text" id="r_cheque_no_edit"  name="r_cheque_no" class="form-control r_cheque_edit" >

                    </div>

                    </div>




                    <div class="row align-items-center mb-2 cheque_sec d-none">

                    <div class="col-col-md-3 col-lg-3">
                            
                        <label for="basiInput" class="form-label">Cheque Date</label>

                    </div>

                    <div class="col-col-md-9 col-lg-9">

                    <input type="text" id="r_cheque_date_edit"  name="r_cheque_date" class="form-control datepicker r_cheque_edit">

                    </div>

                    </div>



                    <div class="row align-items-center justify-content-start mb-2 cheque_file_edit_sec cheque_sec d-none">

                    <div class="col-col-md-3 col-lg-3">
                        <label for="basiInput" class="form-label">Update Cheque Copy</label>
                    </div>

                    <div class="col-col-md-6 col-lg-6">
                        <input type="file" id="r_cheque_copy_edit"  name="r_cheque_copy" class="form-control">
                    </div>

                    </div>

                    

                    </div>


                        <input type="hidden" name="r_amount" value="">

                       

                        <div class="row">


                        <div class="col-lg-6 ps-0">


                        <div class="row align-items-center justify-content-start mb-2">
                        
                        <div class="col-col-md-3 col-lg-3">
    
                            <label for="basiInput" class="form-label">Collected By</label>
                            
                        </div>
    
    
                        <div class="col-col-md-6 col-lg-6">
    
                            <select id="r_collected_by_edit" name="r_collected_by" class="form-control" required>
    
                            <option value="">Select Collector</option>
    
                            <?php 
                            foreach($collectors as $col_add){
                            ?>
    
                            <option value="<?php echo $col_add->col_id; ?>"><?php echo $col_add->col_name; ?></option>
    
                            <?php } ?>
    
                            </select>
    
                        </div>
    
    
                        </div>



                       



                        <!--
                        <div class="row align-items-center justify-content-start mb-2 view_copy cheque_sec d-none">

                        <div class="col-col-md-3 col-lg-3">
                            <label for="basiInput" class="form-label">Cheque Copy</label>
                        </div>

                        <div class="col-col-md-6 col-lg-6" id="view_cheque_copy">
                            
                        </div>


                        </div>
                        -->




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


                        </form>




                <div class="col-col-md-12 col-lg-12">


           <table class="table table-bordered" style="overflow-y:scroll;">

            <thead>
                <tr>
                <th>Sl No</th>
                <th>Credit Account</th>
                <th>Amount</th>
                <th>Narration</th>
             
                </tr>
            </thead>


            <tbody id="sel_invoices_edit">



            </tbody>



            <tbody>


                <div class="text-center">

                <a href="javascript:void(0);" class="btn btn-success edit_invoice_add">Add</a>

                </div>

            
            </tbody>


            
            <?php /*
            <tbody>


                    <tr class="edit_add_credit invoice_row">

                                    <td>

                                    <input class="credit_sl_no" type="hidden" name="credit_sl_no[]" value="1">

                                    </td>


                                    <td > 

                                       <select class="form-control credit_account credit_account_select2" name="r_credit_account[]">

                                     
                                       </select> 

                                    </td>


                                    <td>

                                        <input class="form-control credit_amount" type="number" name="inv_amount[]">

                                    </td>


                                    <td>

                                    <input class="form-control credit_narration" type="text" name="narration[]"/>

                                    </td>


                                    <th> <a href="javascript:void(0);" class="btn btn-success edit_invoice_add" >Add</a></th>


                                    </tr>
                                    


            </tbody>

            */
            ?>

            


            <tr class="d-none">

            <td colspan="1"></td>

            <td colspan="3" align="left" class="amount_in_words_edit"></td>

            <td align="right" colspan="3">Total</td>

            <th id="total_amount_edit">0</th>


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

    </div>
</div>

            <!-- MAIN EDIT MODAL END -->




            <!-- INVOICE EDIT MODAL START -->

            

<div class="modal fade" id="EditInvoicesModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
            <form method="POST" class="Dashboard-form class" id="invoices_edit">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Select Invoices</h5>
                <button type="button" class="btn-close" data-bs-target="#EditModal" data-bs-toggle="modal" aria-label="Close"></button>
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

                        <table class="table table-bordered" id="edit_invoice_data_sec">

                                    <thead>
                                        <tr>
                                        <th>Sl No</th>
                                        <th>Credit Account</th>
                                        <th>Amount</th>
                                        <th>Link</th>
                                        <th>Narration</th>
                                        </tr>
                                    </thead>


                                    <tbody id="sel_invoices">

                                    <tr class="invoice_row_edit">


                                    <td>

                                    <input class="credit_sl_no form-control" type="number" name="credit_sl_no[]" value="1" readonly>

                                    </td>


                                    <td class="credit_account_edit_parent"> 

                                       <select class="form-control credit_account_edit" name="r_credit_account[]" data-max="">

                                       </select> 

                                    </td>


                                    <td>

                                        <input class="form-control credit_amount_edit" type="number" name="inv_amount[]">

                                    </td>


                                    <td>
                                      <a class="btn btn-primary add_invoices_edit" href="javascript:void(0);">Click</a>
                                    </td>

                                    <td>

                                    <input class="form-control credit_narration_edit" type="text" name="narration[]"/>

                                    </td>


                                    </tr>


                                    </tbody>


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
                <button type="button" class="btn btn-secondary" data-bs-target="#AddModal" data-bs-toggle="modal">Cancel</button>
                <button type="submit" class="btn btn btn-success">Add</button>
            </div> -->


        </div>
        </form>

    </div>
</div>



            <!-- INVOICE EDIT MODAL END -->




            <!-- INVOICE LINK ADD EDIT START-->



<div class="modal fade" id="InvoicesLinkEditModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
            <form method="POST" class="Dashboard-form class" id="invoices_edit_add">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Select Invoices</h5>
                <button type="button" class="btn-close" data-bs-target="#EditInvoicesModal" data-bs-toggle="modal" aria-label="Close"></button>
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

                        <table class="table table-bordered" id="edit_invoices_list">


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


                                    <tbody id="invoices_edit_sec">


                                    </tbody>


                                   
                                    

                                    <tr>

                                    <td>Total Receipt</td>

                                    <td class="invoice_total_edit"></td>

                                    <td>Adjusted</td>

                                    <td class="invoice_adjusted_edit"></td>


                                    <td>Balance</td>

                                    <td class="invoice_balance_edit"></td>

                                    </tr>

                                    



                        </table>



                        </div>



                        <div class="col-lg-2">

                        
                        <!--<button type="button" class="w-100" id="add_so_advance_edit_btn" >Advance</button>-->

                        <button class="w-100 d-none" id="fifo_edit" type="button">FIFO</button>

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


            <!-- INVOICE LINK ADD EDIT END -->






<!-- EDIT MODALS END -->
















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



                        <table class="table table-bordered">

                            
                            <tbody id="view_receipt_body">


                            <tr>


                            <td>Reference</td>

                            <th id="view_reference"></th>


                            <td>Receipt Method</td>

                            <th id="view_receipt_method"></th>


                            </tr>



                            <tr>

                            <td>Date</td>

                            <th id="view_date"></th>


                            <td>Bank</td>


                            <th id="view_bank"></th>


                            </tr>



                            <tr>

                            <td>Debit Account</td>

                            <th id="view_debit_account"></th>


                            <td>Receipt No</td>


                            <th id="view_receipt_no"></th>


                            </tr>



                            <tr>

                            <td>Collected By</td>

                            <th id="view_collected_by"></th>

                            <td class="view_cheque_sec">Cheque Number</td>

                            <th class="view_cheque_sec" id="view_cheque_no"></th>

                            </tr>

                            <tr class="view_cheque_sec">

                            <td>Cheque Date</td>

                            <th id="view_cheque_date"></th>

                            <td>Cheque File</td>

                            <th id="view_cheque_file">
                               
                            </th>

                            </tr>




                            </tbody>

                            <tr>

                            <th colspan="4" style="text-align: center;
    font-size: 15px;">Invoices</th>

                            </tr>


                            <tbody>


                            <tr>

                            <th>Sl No</th>

                            <th>Credit Account</th>

                            <th>Amount</th>

                            <th>Narration</th>

                            </tr>

                            </tbody>

                            <tbody id="view_receipt_invoices">


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






<!--
<script src="<?php echo base_url(); ?>public/assets/js/jquery.num2words.js"></script>
-->            

<script>


    var LinkTotal = 0;

    var LinkAdjusted = 0;

    var balance = 0;

     document.addEventListener("DOMContentLoaded", function(event) { 
    
       /* ADD Receipt Scripts Start*/  
   
        var added_id_var;


        /* Main Receipt Add STart */

        $(function() {
            $('#add_form').validate({
                rules: {
                    required: 'required',
                    r_receipt_no: {
                    required:true,
                    remote:{
                        url:"<?= base_url() ?>Accounts/Receipts/ReceiptNoCheck",
                        type:'POST',
                        async:true,
                        data:
                        {
                           receipt_no : function()
                          {
                            return $('#receipt_no').val();
                        }
                        },
                    }
                    }
                },
                messages: {
                    required: '',
                    r_receipt_no: {
                    remote:"Duplicate receipt number",
                    required:""
                    },
                },
                errorPlacement: function(error, element) {
                    if (element.attr("name") == "r_receipt_no") {
                    error.insertAfter(element);
                    }
                } ,
                submitHandler: function(form) {

                    var submitButtonName =  $(this.submitButton).attr("name");

                    var formData = new FormData(form);

                    $.ajax({
                        url: "<?php echo base_url(); ?>Accounts/Receipts/Add",
                        method: "POST",
                        //data: $(form).serialize(),
                        data:formData,
                        processData: false, 
                        contentType: false,
                        success: function(data) 
                        {
                            var data = JSON.parse(data);

                            //console.log(data.status);

                            if(data.status==0)
                            {

                            alertify.error(data.error).delay(3).dismissOthers();

                            return false;
                            
                            }

                            else 

                            {
                            
                            $('#add_form').attr('data-submit','true');
                            $('#add_form').attr('data-rcid',data);
                            $('#added_id').val(data.id);
                            added_id_var = data.id;

                            if(submitButtonName=="main_submit")
                            {
                            alertify.success('Saved').delay(3).dismissOthers();
                            //$('#add_saved').val("yes");
                            $('#AddModal').modal('hide');
                            }

                            datatable.ajax.reload( null, false)

                            }

                        }
                       
                    });
                    return false; // prevent the form from submitting
                }
            });
        });




        
        $('#AddModal .btn-close').click(function(){

            //$('#AddModal').on('hidden.bs.modal', function () {

            var stat =$('#AddModal #add_saved').val();

            if(stat=="no")
            {
                if($('#added_id').val() !="")
                {

                var id = $('#added_id').val();

                    $.ajax({

                        url : "<?php echo base_url(); ?>Accounts/Receipts/Delete",

                        method : "POST",

                        data: {id: id},

                        success:function(data)
                        {
                            //alertify.success('Data Deleted Successfully').delay(8).dismissOthers();

                            datatable.ajax.reload( null, false )
                        }
                    })

                }
            }

            })






            $('body').on('input','.credit_amount', function(){

            value = parseFloat($(this).val())||0;   

            max = parseFloat($(this).attr('data-max'))||0;

            if((max!="") && (value>max))
            {

            alertify.error('Cannot be greater than pending invoice amount!').delay(3).dismissOthers();  

            $(this).val(max);

            }



            if(max=="")
            {

            alertify.error('No pending amount to credit!').delay(3).dismissOthers();  

            $(this).val(max);

            }



            var total= 0;

            $('body .credit_amount').each(function()
            {
                var sub_tot = parseFloat($(this).val());

                total += parseFloat(sub_tot.toFixed(2))||0;
            //total = Number(total).toFixed(2)
            });

            total = total.toFixed(2);

            $('#total_amount').html(total);

            $('#total_amount_val').val(total);

            var resultQuotation = numberToWords.toWords(total);

            });



            /* Balance Adjust Calculaion */

            
        

        $("body").on('input change', '.invoice_receipt_amount', function(event){
            

            /*
            event.preventDefault(); 

            val = $(this).val();

            if(balance<val)
            {

                alertify.error('Cannot be greater than balance amount!').delay(3).dismissOthers();

                $(this).val(0);

                CalcBalance();

                return false;

            }

            else
            {

            $(this).val(val);

            */


            val = parseFloat($(this).val())||0;

            max = $(this).attr('maxlength');

            if(val>max)
            {

            $(this).val(max);

            $(this).trigger('change');

            }


            var invoice_total = 0;

            //var receipt_total = parseInt($('#fifo_add').attr('data-total'))||0;

            var receipt_total = parseInt($('#fifo_add').data('total'))||0;

            var max_receipt = parseInt(parent.find('.invoice_total_amount').val())||0;

            var receipt_amount = $(this).val();

            parent =  $(this).closest('tr');

            if(max_receipt!=receipt_amount)
            {
                parent.find('.invoice_add_check').prop('checked',false);
            }
            else
            {
                parent.find('.invoice_add_check').prop('checked',true);
            }

            // $('.invoice_receipt_amount').each(function(){

            // parent =  $(this).closest('tr');

            // invoice_total += parseInt(parent.find('.invoice_receipt_amount').val())||0;

            // })

            // balance = (parseFloat(receipt_total)||0) - (parseFloat(invoice_total)||0);

            // balance = Math.max(0,balance);

            // $('.invoice_balance').html(balance);

            // $('.invoice_adjusted').html(invoice_total);

           
            //}

            CalcBalance();


        });


            /* ## */




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






        /* Main Receipt Add End */



        
        


        /* Invoices Link Btn STart */


            
            
            $("body").on('click', '.add_invoices', function(){ 
            
                $('.invoice_receipt_amount').val('');

                $('.so_receipt_amount').val('');

                var parent = $(this).closest('tr');

                var c_account = parent.find('.credit_account');

                var c_amount = parent.find('.credit_amount');

                LinkTotal = parseFloat(c_amount.val())||0;

                if( c_account.val() =="")
                {

                alertify.error('Select Credit Account!').delay(3).dismissOthers();   

                c_account.focus();

                return false;

                }


                if( c_amount.val() =="")
                {

                alertify.error('Enter Amount!').delay(3).dismissOthers();   

                c_amount.focus();

                return false;

                }


                if(!$("#add_form").valid())
                {
                    alertify.error('Fill required fields!').delay(3).dismissOthers();
                    return false;
                }
                
                
                if($('#added_id').val()=='')
                {

                    $('#add_form').submit();

                    if(!$("#add_form").valid())
                    {
                    alertify.error('Fill required fields!').delay(3).dismissOthers();
                    return false;
                    }

                    /*
                    if($('#added_id').val()=='')
                    {
                    return false;
                    }
                    */

                }


                //var id=1;

                // Use a timeout-based polling approach
                var checkValueInterval = setInterval(function() {
                if ($('#added_id').val() !== '') {
                clearInterval(checkValueInterval); 

                var receipt = $('#added_id').val();
                
                var id = c_account.val(); //Customer_ID

                var credit_date = parent.find('.credit_date').val();

                var credit_amount = parent.find('.credit_amount').val();

                var credit_narration = parent.find('.credit_narration').val();


                $.ajax({
                    

                    url : "<?php echo base_url(); ?>Accounts/Receipts/FetchInvoices",

                    method : "POST",

                    data: {id: id,cdate:credit_date,camount:credit_amount,cnarration:credit_narration,rid:receipt},

                    dataType: "json",

                    success:function(data)
                    {

                        
                        if(data.status==0)
                        {
                        alertify.error(data.msg).delay(3).dismissOthers();   

                        $('#AddModal').modal('show'); 

                        return false;
                        }
                        

                        $('#invoices_sec').hide().html(data.invoices).fadeIn(200);

                        $('#add_form').attr('data-submit','true');
                        $('#add_form').attr('data-rcid',data);
                        datatable.ajax.reload( null, false)

                        $('#AddModal').modal('hide');


                        $('body #fifo_add').attr('data-total',credit_amount);

                        $('body #fifo_add').data('total',credit_amount);

                        $('.invoice_total').html(credit_amount);

                        $('.invoice_adjusted').html('0');

                        $('.invoice_balance').html('0');

                        $('#InvoicesModal').modal('show');

                    }


                });

            } else {
                //console.log('No'); // Logging for debugging purposes
                }
            }, 100);

            });


        /* Invoices Link Btn ENd */




        /* Sales Order Advance Btn Start */


        $("body").on('click', '#add_so_advance_btn', function(){

            var customer = $('#add_receipt_invoice_customer').val();

            var credit_id = $('#add_receipt_invoice_id').val();


            $.ajax({

            url : "<?php echo base_url(); ?>Accounts/Receipts/FetchSalesOrdersAdd",

            method : "POST",

            data: {c_id:customer,creditid:credit_id},

            dataType: "json",

            success:function(data)
            {

                if(data.status==0)
                {
                alertify.error('No Sales Orders Found!').delay(3).dismissOthers();   

                return false;
                }

                $('#InvoicesModal').modal('hide');
                
                $('#so_adv_body').html(data.so_rows);

                $('#AddSOAdvanceModal').modal('show');

            }


            });


            });


    /* Sales Order Advance Btn End */




    /* Check Total Balance For Invoices Start*/

    $("body").on('change input', '.so_receipt_amount', function(){

        var this_amount = parseFloat($(this).val())||0;
        /*
        if(this_amount>balance)
        {
            alertify.error('Cannot be greater than balance amount!').delay(3).dismissOthers();  

            $(this).val(balance);

            return false;
        }

        else
        {

            $('.so_receipt_amount').each(function(){

            //LinkTotal = LinkTotal+=parseFloat($(this).val())||0;

            });


        }
        */

        CalcBalance();

        //Sales Order Total

    });
    


   /* Check Total Balance For Invoices End*/    



   /* Check Balance ADjustable Start */

    
   function CalcBalance()
   {

    LinkAdjusted = 0;

    balance = 0;

    $('body .invoice_receipt_amount').each(function(){

    LinkAdjusted += parseFloat($(this).val())||0;

    });


    $('body .so_receipt_amount').each(function(){

    LinkAdjusted += parseFloat($(this).val())||0;

    });

    balance = LinkTotal-LinkAdjusted;

    balance = Math.max(0,balance);

    $('.invoice_balance').html(balance);

    if(LinkAdjusted>LinkTotal)
    {
    
    LinkAdjusted=LinkTotal;

    }

    $('.invoice_adjusted').html(LinkAdjusted);

   }

   if(balance<LinkAdjusted)
   {

    //return false;

   }
   else
   {

    //return true;    

   }
    
   

   /* Check Balance ADjustable End */




    /* Check Balance ADjustable Start */

    
    function CalcBalanceEdit()
   {

    LinkAdjusted = 0;

    balance = 0;

    $('#InvoicesLinkEditModal .invoice_receipt_amount').each(function(){

    LinkAdjusted += parseFloat($(this).val())||0;

    });


    $('body .so_receipt_amount').each(function(){

    LinkAdjusted += parseFloat($(this).val())||0;

    });

    balance = LinkTotal-LinkAdjusted;


    balance = Math.max(0,balance);

    $('.invoice_balance_edit').html(balance);

    $('.invoice_adjusted_edit').html(LinkAdjusted);

   }

   if(LinkTotal<LinkAdjusted)
   {

    alert('Cannot be greater');

    return false;

   }
   else
   {

    //return true;    

   }
    
   

   /* Check Balance ADjustable End */


        







        
        /* ADD Receipt Scripts End*/






        /* EDIT Receipt Script Start */



        /* Main Receipt Edit Start */



        $("body").on('click', '.edit_btn', function(){ 

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

                    if(data.rc.r_method="2")
                    {

                    $('#EditModal .bank_sec_edit').addClass("d-none");
                    
                    $('#r_bank_edit').removeAttr("required");

                    }

                    else
                    {

                    $('#EditModal .bank_sec_edit').removeClass("d-none");
                    
                    $('#r_bank_edit').attr("required",true);

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


            //Change Receipt Method 

            $("body").on('change', '#r_method_edit', function(){

                var method = $(this).val();

                if(method==2)
                    {

                    $('#EditModal .bank_sec_edit').addClass("d-none");

                    $('#r_bank_edit').removeAttr("required");

                    }

                    else
                    {

                    $('#EditModal .bank_sec_edit').removeClass("d-none");

                    $('#r_bank_edit').attr("required",true);

                    }


                if(method=="1")
                {

                $('.cheque_sec').removeClass("d-none");

                $('.cheque_file_sec').removeClass("d-none");

                $('#EditModal .cheque_file_edit_sec').removeClass("d-none");

                $('.r_cheque_edit').attr("required",true);

                }
                else
                {

                $('.cheque_sec').addClass("d-none");

                $('.cheque_file_sec').addClass("d-none");

                $('.r_cheque_edit').removeAttr("required");

                }

                    


                });

                //###




                /* Edit Invoices ADD Start */

            $("body").on('click', '.add_invoices_edit', function(){ 
                
                $('.invoice_receipt_amount').val('');

                $('.so_receipt_amount').val('');

                var parent = $(this).closest('tr');

                var c_account = parent.find('.credit_account_edit');

                var c_amount = parent.find('.credit_amount_edit');

                LinkTotal_edit = c_amount;

                if( c_account.val() =="")
                {

                alertify.error('Select Credit Account!').delay(3).dismissOthers();   

                c_account.focus();

                return false;

                }


                if( c_amount.val() =="")
                {

                alertify.error('Enter Amount!').delay(3).dismissOthers();   

                c_amount.focus();

                return false;

                }
                

                //var id=1;

                // Use a timeout-based polling approach
                
                var receipt = $('#id_edit').val();
                
                var id = c_account.val(); //Customer_ID

                var credit_date = parent.find('.credit_date').val();

                var credit_amount = parent.find('.credit_amount_edit').val();

                var credit_narration = parent.find('.credit_narration_edit').val();


                $.ajax({
                    

                    url : "<?php echo base_url(); ?>Accounts/Receipts/FetchInvoices",

                    method : "POST",
 
                    data: {id: id,cdate:credit_date,camount:credit_amount,cnarration:credit_narration,rid:receipt},

                    dataType: "json",

                    success:function(data)
                    {

                        
                        if(data.status==0)
                        {
                        alertify.error(data.msg).delay(3).dismissOthers();   

                        return false;
                        }
                        
                        //console.log(data.invoices);

                        $('#invoices_edit_sec').html(data.invoices);

                        $('#EditInvoicesModal').modal('hide');

                        $('#InvoicesLinkEditModal').modal('show');

                        $('body #fifo_edit').attr('data-total',credit_amount);

                        $('.invoice_total_edit').html(credit_amount);

                        $('.invoice_adjusted_edit').html('0');

                        $('.invoice_balance_edit').html('0');

                    }

                });

            });



                /* Edit Invoices Add End */










        /* Main Receipt Edit END */





        







        /* EDIT Receipt Script End */






        /*account head modal start*/

       



        // Make 

       



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

        





           /*account head modal start*/ 
           $("body").on('click', '.view_btn', function(){

                var id = $(this).data('id');

                $.ajax({

                    url : "<?php echo base_url(); ?>Accounts/Receipts/View",

                    method : "POST",

                    data: {r_id: id},

                    success:function(data)
                    {   
                        if(data)
                        {
                        var data = JSON.parse(data);

                        $('#view_reference').html(data.rc.r_ref_no);

                        //$('#id_edit').val(data.rc.r_id);

                        $('#view_date').html(data.rc.r_date);

                        $('#view_debit_account').html(data.rc.ca_name);

                        $('#view_receipt_no').html(data.rc.r_number);
                        
                        $('#view_receipt_method').html(data.rc.rm_name);


                        if(data.rc.r_method=="1")
                        {
                    
                        $('.view_cheque_sec').removeClass("d-none");

                        if(data.rc.r_cheque_copy != "")
                        {
                        $('#view_cheque_file').html('<a href="<?= base_url();?>uploads/Receipts/'+data.rc.r_cheque_copy+'" target="_blank">View </a>');
                        }
                        else
                        {
                        $('#view_cheque_file').html("-");  
                        }

                        $('#view_cheque_no').html(data.rc.r_cheque_no);

                        $('#view_cheque_date').html(data.rc.cheque_date);

                        }
                        else
                        {
                        $('.view_cheque_sec').addClass("d-none");
  
                        }

                        if(data.rc.r_method=="2")
                        {
                        $('#view_bank').html('-');
                        }
                        else
                        {
                        $('#view_bank').html(data.rc.bank_name);    
                        }

                        $('#view_collected_by').html(data.rc.col_name);

                        $('#view_receipt_invoices').html(data.invoices);

                        //$('#total_amount_edit').html(data.rc.r_amount);

                        

                        $('#ViewModal').modal('show');
                    
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

                var file_data = $('#r_cheque_copy_edit').prop('files')[0];   

                var form = $('#edit_form')[0];

                var form_data = new FormData(form);

                form_data.append('r_cheque_copy', file_data);
                
                $.ajax({

                    url : "<?php echo base_url(); ?>Accounts/Receipts/Update",

                    method : "POST",

                    cache: false,

                    contentType: false,

                    processData: false,

                    data: form_data,  

                    success:function(data)
                    {

                        var data = JSON.parse(data);

                        if(data.status==0)
                        {

                        alertify.error(data.msg).delay(3).dismissOthers();

                        return false;
                            
                        }
                        
                        $('#EditModal').modal('hide');

                        alertify.success('Data Updated Successfully').delay(3).dismissOthers();

                        datatable.ajax.reload( null, false );
                    }


                });
            });
        });
        /*###*/





        /*Delete Invoice Receipt Edit*/ 

        $("body").on('click', '.invoice_delete_btn', function(){ 
            
            if (!confirm('Are you absolutely sure you want to delete?')) return;

            var id = $(this).data('id');

            var receipt_id = $('#id_edit').val();

            $.ajax({

                url : "<?php echo base_url(); ?>Accounts/Receipts/DeleteInvoiceOnly",

                method : "POST",

                data: {inv_id: id,rid:receipt_id},

                success:function(data)
                {
                    var data = JSON.parse(data);

                    alertify.success('Invoice Deleted Successfully').delay(3).dismissOthers();

                    $('#sel_invoices_edit').html(data.invoices);

                    $('#total_amount_edit').html(data);

                    datatable.ajax.reload( null, false )
                }


            });

        });
        
        /*###*/



        /* Add Invoices Receipt Edit */




        /* Insert Invoices Edit STart */



        $('#invoices_edit_add').submit(function(e){

            e.preventDefault();

            var total = parseInt($('#fifo_edit').attr('data-total'))||0;

            var invoice_total = 0;

            $('#invoices_edit_add .invoice_receipt_amount').each(function(){

            parent =  $(this).closest('tr');

            //alert(parent);

            invoice_total += parseInt(parent.find('.invoice_receipt_amount').val())||0;

            })

            if(invoice_total>total)
            {

            alertify.error('Amount should not be greater than credit amount!').delay(3).dismissOthers();     

            return false;

            }


            if(invoice_total<total)
            {

            alertify.error('Total receipt amount should be adjusted!').delay(3).dismissOthers();      

            return false;

            }



            $.ajax({


            url : "<?php echo base_url(); ?>Accounts/Receipts/AddInvoices",

            method : "POST",

            data: $(this).serialize(),

            success:function(data)
            {

            alertify.success('Saved!').delay(3).dismissOthers();   

            $('#InvoicesLinkEditModal').modal('hide');

            $('#EditInvoicesModal').modal('show');

            //$('#EditModal').modal('show');

            //$('#sel_invoices_edit').html();

            }

            });

                
            });





        /* Insert Invoices Edit End */







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
                ],
                "initComplete": function () {

                var dataId = '<?php echo isset($_GET['view']) ? $_GET['view'] : ''; ?>';

                $('#accountTable').dataTable().fnFilter(dataId);

                },

                "drawCallback": function() {

                $('.view_btn[data-id="<?php echo isset($_GET['view']) ? $_GET['view'] : ''; ?>"]').trigger('click');

                }
                                
           });

           

        }

        $(document).ready(function () {
            initializeDataTable();
        });
        /*###*/





        /* If Cheque  */

        $('#AddModal select[name=r_method]').change(function(){

            if($(this).children(':selected').text()=="Cheque")
            {
            $('.cheque_sec').removeClass("d-none");
            }
            else
            {
            $('.cheque_sec').addClass("d-none");
            }

            if($(this).children(':selected').text()=="Cash")
            {
            $('#bank_sec_add').addClass("d-none");
            $('.bank_sec_edit').addClass("d-none");
            }
            else
            {
            $('#bank_sec_add').removeClass("d-none"); 
            $('.bank_sec_edit').removeClass("d-none");   
            }



        });


        /* ### */



        /* Show Invoices after reference */


        $('input[name=amount]').focusout(function(){


            $('#AddModal').modal('hide');
            $('#InvoicesModal').modal('show');


        });


        /* ### */







        
        /*
        $("body").on('click', '.add_invoices_1', function(){ 
        

        var parent = $(this).closest('tr');

        var c_account = parent.find('.credit_account');

        var c_amount = parent.find('.credit_amount');

        LinkTotal = c_amount;

        if( c_account.val() =="")
        {

        alertify.error('Select Credit Account!').delay(3).dismissOthers();   

        c_account.focus();

        return false;

        }


        if( c_amount.val() =="")
        {

        alertify.error('Enter Amount!').delay(3).dismissOthers();   

        c_amount.focus();

        return false;

        }


        if(!$("#add_form").valid())
        {
            alertify.error('Fill required fields!').delay(3).dismissOthers();
            return false;
        }
        
        
        if($('#added_id').val()=='')
        {

            $('#add_form').submit();

            if(!$("#add_form").valid())
            {
            alertify.error('Fill required fields!').delay(3).dismissOthers();
            return false;
            }

            /*
            if($('#added_id').val()=='')
            {
            return false;
            }
            */

        //}


       //var id=1;

       // Use a timeout-based polling approach

       /*
       var checkValueInterval = setInterval(function() {
        if ($('#added_id').val() !== '') {
        clearInterval(checkValueInterval); 

        var receipt = $('#added_id').val();
        
        var id = c_account.val(); //Customer_ID

        var credit_date = parent.find('.credit_date').val();

        var credit_amount = parent.find('.credit_amount').val();

        var credit_narration = parent.find('.credit_narration').val();


        $.ajax({
            

            url : "<?php echo base_url(); ?>Accounts/Receipts/FetchInvoices",

            method : "POST",

            data: {id: id,cdate:credit_date,camount:credit_amount,cnarration:credit_narration,rid:receipt},

            dataType: "json",

            success:function(data)
            {

                
                if(data.status==0)
                {
                alertify.error(data.msg).delay(3).dismissOthers();   

                $('#AddModal').modal('show'); 

                return false;
                }
                

                $('#invoices_sec').hide().html(data.invoices).fadeIn(200);

                $('#add_form').attr('data-submit','true');
                $('#add_form').attr('data-rcid',data);
                datatable.ajax.reload( null, false)

                $('#AddModal').modal('hide');

                $('body #fifo_add').attr('data-total',credit_amount);

                $('#invoice_total').html(credit_amount);

                $('#invoice_adjusted').html('0');

                $('#invoice_balance').html('0');

                $('#InvoicesModal').modal('show');

            }


            });

            } else {
                //console.log('No'); // Logging for debugging purposes
                }
            }, 100);

            });

            */











        $('#add_sales_order_advance_form').submit(function(e){

            e.preventDefault();


            //var total = parseInt($('#fifo_add').attr('data-total'))||0;

            var total = parseInt($('#fifo_add').data('total'))||0;

            var invoice_total = 0;

            $('.invoice_receipt_amount').each(function(){

            parent =  $(this).closest('tr');

            invoice_total += parseInt(parent.find('.invoice_receipt_amount').val())||0;

            })

            $('#AddSOAdvanceModal .so_receipt_amount').each(function(){

            parent =  $(this).closest('tr');

            invoice_total += parseInt(parent.find('.so_receipt_amount').val())||0;

            })

            if(invoice_total>total)
            {

            alertify.error('Amount should not be greater than credit amount!').delay(3).dismissOthers();     

            return false;
            
            }


            if(invoice_total<total)
            {

            alertify.error('Total receipt amount should be adjusted!').delay(3).dismissOthers();      

            return false;
            
            }


            $.ajax({

            url : "<?php echo base_url(); ?>Accounts/Receipts/AddSalesOrderAdvance",

            method : "POST",

            data : $('#add_sales_order_advance_form').serialize(),

            success:function(data)
            {

             $('#AddSOAdvanceModal').modal('hide');

             $('#InvoicesModal').modal('show');
                
             datatable.ajax.reload( null, false );

            }

            });

            //}


        });





        $("body").on('click', '.edit_linked', function(){ 

            var id = $(this).data('id');

            var rid = $(this).data('rid');

            $.ajax({

            url : "<?php echo base_url(); ?>Accounts/Receipts/EditLinked",

            method : "POST",

            data: {id: id,r_id:rid},

            dataType: "json",

            success:function(data)
            {

                if(data.status==0)
                {
                alertify.error('No Invoices Found!').delay(3).dismissOthers();   

                return false;
                }
                
                $('#edit_invoices_sec').hide().html(data.invoices).fadeIn(200);

                $('#EditModal').modal('hide');

                $('#InvoicesEditModal').modal('show');

            }


            });





        });



        //Add Adjust Amount

       





















        $("body").on('change', '.so_select', function(){ 

        order_id = $(this).val();

        parent_tr = $(this).closest('.so_row');

        $.ajax({

            url : "<?php echo base_url(); ?>Accounts/Receipts/FetchSalesOrders",

            method : "POST",

            data : {so_id:order_id},

            success:function(data)
            {
            
            var data = JSON.parse(data);

            parent_tr.find('.so_name_input').val(data.cc_customer_name);

            parent_tr.find('.so_amount_input').val(data.so_amount_total);

            }


        });


        });




        $('#sales_order_advance').submit(function(e){

        e.preventDefault();

        $.ajax({

        url : "<?php echo base_url(); ?>Accounts/Receipts/AddAdvanceSalesOrder",

        method : "POST",

        data: $(this).serialize(),

        success:function(data)
        {

        alertify.success('Saved!').delay(3).dismissOthers();   

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


            $('#added_id').val('');

            $('#add_saved').val("no");

            $('#add_form')[0].reset();

            $('#total_amount').html('0.00');

            $('.debit_account_select2').val('').trigger('change');

            $('.credit_account_select2').val('').trigger('change');

            $('#total_amount_val').val('0.00');

            $('.invoice_row').not(':first').remove();

            InitAccountsSelect2('.credit_account_select2','.invoice_row');

            $.ajax({

            url : "<?php echo base_url(); ?>Accounts/Receipts/FetchReference",

            method : "GET",

            success:function(data)
            {

            $('#ruid').val(data);

            }

            });

        });




        //Update PF Invoices

        $("body").on('click', '.edit_pf_invoice', function(){

        var id = $(this).data('id'); 

        $('#edit_pf'+id+'').find('.edit').fadeIn(200);

        $('#edit_pf'+id+'').find('.view').hide();

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








        $('body').on('click','.update_pf_invoice_btn',function(){

        var id = $(this).data('id'); 

        parent = $(this).closest('.view_pf_invoice');

        var lpo_ref = parent.find('input[name=lpo_ref]').val();

        var receipt_amount = parent.find('input[name=inv_receipt_amount]').val();

        $.ajax({

        url : "<?php echo base_url(); ?>Accounts/Receipts/UpdatePfdetails",

        method : "POST",

        data: {id:id,lpo_ref:lpo_ref,receipt_amount:receipt_amount},

        success:function(data)
        {

        var data = JSON.parse(data);

        $('#edit_pf'+data.inv_id+'').html(data.invoices);

        $('#edit_pf'+data.inv_id+'').find('.edit').hide();

        $('#edit_pf'+data.inv_id+'').find('.view').fadeIn(200);

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

        $('body').on('click','.cancel_pf_invoice_btn',function(){

        var id = $(this).data('id'); 

        $('#edit_pf'+id+'').find('.edit').hide();

        $('#edit_pf'+id+'').find('.view').fadeIn(200);

        });


        //





        //Linked Edit View


        /*
        
        $('body').on('click','.edit_invoice_add',function(){

        var rid = $('#id_edit').val();

        var parent = $(this).closest('.edit_add_credit');

        var date = parent.find('.credit_date').val();

        var credit_account = parent.find('.credit_account').val();

        var credit_amount = parent.find('.credit_amount').val();

        var narration = parent.find('.credit_narration').val();

        if((date=="") || (credit_account=="") || (credit_amount=="") )
        {

        alertify.error('Fill required fields').delay(3).dismissOthers();  

        return false;

        }


        $.ajax({

        url : "<?php echo base_url(); ?>Accounts/Receipts/EditAddCredit",

        method : "POST",

        data: {receipt_id:rid,credit_date:date,credit_account:credit_account,credit_amount:credit_amount,narration:narration},

        success:function(data)
        {

        var data = JSON.parse(data);

        $('#sel_invoices_edit').append(data.invoices);

        $('#total_amount_edit').html(data.total);

        parent.find(':input').val('');

        }
        }); 

        });

        */




        $('body').on('click','.edit_invoice_add',function(){

            $('.credit_account_edit').val('').trigger('change');

            $('.credit_amount_edit').val('');

            $('.credit_narration_edit').val('');

            $('#EditModal').modal('hide');

           $('#EditInvoicesModal').modal('show');


        });






        $('body').on('click','.view_linked',function(){

        var id = $(this).data('id');

        $.ajax({

        url : "<?php echo base_url(); ?>Accounts/Receipts/EditPfInvoice",

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
            

            $('#invoice_detail_edit').hide().html(data.invoices).fadeIn(200);

            $('#EditModal').modal('hide');

            $('#EditInvoiceModal').modal('show');

        }


        });


        });



        //Pf Invoice Edit

        $('body').on('click','.update_invoice_btn',function(){

        var id = $(this).data('id'); 

        parent = $(this).closest('.view_credit');

        var credit_id = id;

        var date = parent.find('input[name=date]').val();

        var credit_account = parent.find('select[name=c_name]').val();

        var amount = parent.find('input[name=amount]').val();

        var narration = parent.find('input[name=remarks]').val();

        $.ajax({

        url : "<?php echo base_url(); ?>Accounts/Receipts/UpdateCreditDetails",

        method : "POST",

        data: {c_id:credit_id,c_date:date,c_account:credit_account,c_amount:amount,c_narration:narration},

        success:function(data)
        {

        //console.log(data);

        var data = JSON.parse(data);

        $('#view'+data.inv_id+'').html(data.invoices);

        $('#total_amount_edit').html(data.total);

        $('#view'+data.inv_id+'').find('.edit').hide();

        $('#view'+data.inv_id+'').find('.view').fadeIn(200);

        }
        }); 

        });

        //#########


        //Cancel Credit Edit

        $('body').on('click','.cancel_pf_invoice_btn',function(){

        var id = $(this).data('id'); 

        $('#view'+id+'').find('.edit').hide();

        $('#view'+id+'').find('.view').fadeIn(200);

        });


        //














        //Store in json array instead of db  

        //var invoice_total=0;

        $('#invoices_add').submit(function(e){

        e.preventDefault();

        //var total = parseInt($('#fifo_add').attr('data-total'))||0;

        var total = parseInt($('#fifo_add').data('total'))||0;

        var invoice_total = 0;

        $('.invoice_receipt_amount').each(function(){

        parent =  $(this).closest('tr');

        invoice_total += parseInt(parent.find('.invoice_receipt_amount').val())||0;

        })

        $('#AddSOAdvanceModal .so_receipt_amount').each(function(){

        parent =  $(this).closest('tr');

        invoice_total += parseInt(parent.find('.so_receipt_amount').val())||0;

        })

        if(invoice_total>total)
        {

        alertify.error('Amount should not be greater than credit amount!').delay(3).dismissOthers();     

        return false;
        
        }


        if(invoice_total<total)
        {

        alertify.error('Total receipt amount should be adjusted!').delay(3).dismissOthers();      

        return false;
        
        }



        $.ajax({


        url : "<?php echo base_url(); ?>Accounts/Receipts/AddInvoices",

        method : "POST",

        data: $(this).serialize(),

        success:function(data)
        {

        alertify.success('Saved!').delay(3).dismissOthers();   

        $('#InvoicesModal').modal('hide');

        $('#AddModal').modal('show');

        }

        });
        
             
        });



        $('#sales_order_add').submit(function(e){

        e.preventDefault();

        alertify.success('Saved!').delay(3).dismissOthers();   

        $('#SalesOrderModal').modal('hide');

        $('#AddModal').modal('show');

            
        });



        $("body").on('keyup', '.credit_amount', function(){ 

            TotalAmount();

        });




        
        /*
        $('body').on('change','.so_row',function(){

        var so_parent = $(this).closest('.so_row');

            var so_id = $(this).val();

            $.ajax({

            url : "<?php echo base_url(); ?>Receipts/FetchSoDetails",


            });

            });

        */


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





        
        $("body").on('change','.invoice_add_check',function(){

        parent = $(this).closest('tr');

        var total = $('#fifo_add').data('total');

        var total_amount = parent.find('.invoice_total_amount').val();

        if(total<total_amount)
        {
        return false;
        }

        // LinkTotal

        if($(this).prop('checked')==true)

        {

        

        var fill_amount = Math.min(total,total_amount);

        parent.find('.invoice_receipt_amount').val(fill_amount);

        parent.find('.invoice_receipt_amount').trigger('change');

        }

        else
        {

        parent.find('.invoice_receipt_amount').val(0);   

        parent.find('.invoice_receipt_amount').trigger('change');

        }




        });






        $('body').on('click','#fifo_add',function(){

            var total = $('#fifo_add').data('total');

            //alert(total);

            $('.invoice_receipt_amount').each(function(){

               parent =  $(this).closest('tr');

               invoice_total = parent.find('.invoice_total_amount').val();

               var fill_amount = Math.min(total,invoice_total);

               parent.find('.invoice_receipt_amount').val(fill_amount);

               total -= fill_amount;
               
               $(this).trigger('change');

            });


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

                InitAccountsSelect2('.debit_account_select2','.select2_parent');

                InitAccountsSelect2('.credit_account_select2','.invoice_row');

                /* ### */




                /* Select 2 Remove Validation On Change */
                $(".debit_account_select2").on("change",function(e) {
                    $(this).parent().find(".error").removeClass("error");         
                });
                /*###*/




                /*
                $('body').on('change','.debit_account_select2', function(){

                var account_id = $(this).val();

                //var parent = $(this).closest('.invoice_row');

                    $.ajax({

                    url : "<?php echo base_url(); ?>Accounts/Receipts/CreditTotal",

                    method : "POST",

                    data: {account:account_id},

                    success:function(data)
                    {

                    
                    $('body').find('.credit_amount').attr('data-max',data);

                    //console.log(data);

                    //alertify.success(data).delay(3).dismissOthers();   


                    }

                    });

                });
                */



                /* Add Receipt Credit Amount Check Start */

                $('body').on('change','.credit_account_select2', function(){

                var account_id = $(this).val();

                parent = $(this).closest('.invoice_row');

                parent.find('.credit_amount').val('0');

                //var parent = $(this).closest('.invoice_row');

                    $.ajax({

                    url : "<?php echo base_url(); ?>Accounts/Receipts/CreditTotal",

                    method : "POST",

                    data: {account:account_id},

                    success:function(data)
                    {

                    if(data!="")
                    {
                    parent.find('.credit_amount').attr('data-max',data);
                    }
                    else
                    {
                    parent.find('.credit_amount').attr('data-max',0);
                    }

                    //console.log(data);

                    //alertify.success(data).delay(3).dismissOthers();   


                    }

                    });

                });


                /* Add Receipt Invoice Credit Check ENd */





                /* Edit Receipt Credit Amount CHeck Start */


                    $('body').on('change','.credit_account_edit', function(){

                        var account_id = $(this).val();

                        parent = $(this).closest('.invoice_row_edit');

                        parent.find('.credit_amount_edit').val('0');

                        //var parent = $(this).closest('.invoice_row');

                            $.ajax({

                            url : "<?php echo base_url(); ?>Accounts/Receipts/CreditTotal",

                            method : "POST",

                            data: {account:account_id},

                            success:function(data)
                            {

                            if(data!="")
                            {
                            parent.find('.credit_amount_edit').attr('data-max',data);
                            }
                            else
                            {
                            parent.find('.credit_amount_edit').attr('data-max',0);
                            }

                            //console.log(data);

                            //alertify.success(data).delay(3).dismissOthers();   


                            }

                            });

                        });




                        $('body').on('input','.credit_amount_edit', function(){

                        value = parseFloat($(this).val())||0;

                        max = parseFloat($(this).attr('data-max'))||0;

                        if((max!="") && (value>max))
                        {

                        alertify.error('Cannot be greater than pending invoice amount!').delay(3).dismissOthers();  

                        $(this).val(max);

                        }



                        if(max=="")
                        {

                        alertify.error('No pending amount to credit!').delay(3).dismissOthers();  

                        $(this).val(max);

                        }



                        var total= 0;

                        $('body .credit_amount').each(function()
                        {
                            var sub_tot = parseFloat($(this).val());

                            total += parseFloat(sub_tot.toFixed(2))||0;
                        //total = Number(total).toFixed(2)
                        });

                        total = total.toFixed(2);

                        $('#total_amount').html(total);

                        $('#total_amount_val').val(total);

                        var resultQuotation = numberToWords.toWords(total);

                        });









                /* Edit Receipt Credit Amount ENd */

                
                /*

                $('body').on('input','.invoice_receipt_amount', function(){

                val = parseFloat($(this).val())||0;

                max = $(this).attr('maxlength');

                if(val>max)
                {

                $(this).val(max);

                $(this).trigger('change');

                }


                });

                */




                $('body').on('input','.so_receipt_amount', function(){

                val = parseFloat($(this).val())||0;

                max = $(this).attr('maxlength');

                if(val>max)
                {

                $(this).val(max);

                $(this).trigger('change');

                }

                //if()


                });





                /* Invoice Edit ADD */


                $('body .credit_account_edit').select2({
                        placeholder: "Select Account",
                        theme : "default form-control-",
                        dropdownParent: $('.credit_account_edit_parent'),
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



                    /* ###### */




                

                $('body').on('input','.currency-format', function(){



                });
                







     
    });





    
    function formatCurrency(amount, currency = 'QAR') {
            return new Intl.NumberFormat('en-US', {
            //style: 'currency',
            //currency: currency,[
            minimumFractionDigits: 2,
            }).format(amount);
        }
        






    function TotalAmount()
        {

            var total= 0;

            $('body .credit_amount').each(function()
            {
                var sub_tot = parseFloat($(this).val());

                total += parseFloat(sub_tot.toFixed(2))||0;
               //total = Number(total).toFixed(2)
            });

           total = total.toFixed(2);

           total = total;

           $('#total_amount').html(total);

           $('#total_amount_val').val(total);

           var resultQuotation = numberToWords.toWords(total);

            $(".amount_in_words_add .amount_in_words_edit").text(resultQuotation);

            $(".amount_in_words_val").val(resultQuotation);
           

        }



        document.addEventListener("DOMContentLoaded", function(event) { 

function isDataTableRequest(ajaxSettings) {
// Check for DataTables-specific URL or any other pattern
return ajaxSettings.url && ajaxSettings.url.includes('/FetchData');
}

function isSelect2Request(ajaxSettings) {
// Check for specific data or parameters in Select2 requests
return ajaxSettings.url && ajaxSettings.url.includes('term='); // Adjust based on actual request data
}


function isSelect2Search(ajaxSettings) {
// Check for specific data or parameters in Select2 requests
return ajaxSettings.url && ajaxSettings.url.includes('page='); // Adjust based on actual request data
}


$(document).ajaxSend(function(event, jqXHR, ajaxSettings){
    if ((!isDataTableRequest(ajaxSettings)) && (!isSelect2Request(ajaxSettings)) && (!isSelect2Search(ajaxSettings)) ) {
    $("#overlay").fadeIn(300);
    }
});


$(document).ajaxComplete(function(event, jqXHR, ajaxSettings){
    if ((!isDataTableRequest(ajaxSettings)) && (!isSelect2Request(ajaxSettings))  && (!isSelect2Search(ajaxSettings)) ) {
    $("#overlay").fadeOut(300);
    }
});



$(document).ajaxError(function(){
    //alertify.error('Something went wrong. Please try again later').delay(5).dismissOthers();
});


});

      


</script>






            
