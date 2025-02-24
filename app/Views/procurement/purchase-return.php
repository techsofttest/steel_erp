<style>
    
    .select2.select2-container 
    {
        width: 95% !important;
    }
    .cust_more_modal
    {
        /*position: absolute;
        left: 471px;
        padding: 0px 23px;
        z-index: 999;
        border: 1px solid black;
        border: 1px solid #0000003b;*/

        position: absolute;
        right: 32px;
        top: -16px;
        font-size: 25px;
        color: #ff0000b5;

    }
    span.select2.select_width
    {
        width: 70% !important;
    }
    .prod_add_more
    {
        position: absolute;
        left: 340px;
        padding: 4px 27px;
        z-index: 999;
        border: 1px solid black;
        border: 1px solid #0000003b;
    }
    .row_align
    {
        display: flex;
        align-items: center;
        justify-content: unset !important;
    }
  
  
    .add_contact{
        position: absolute;
        right: 8px;
        top: -8px;
        font-size: 25px;
        color: #ff0000b5;
    }
    
</style>

<div class="tab-content text-muted">
								
    <div class="tab-pane active" id="nav-crm-top-1-1" role="tabpanel">
                    
        <div class="row">
            
            <div class="col-lg-12">
                
                <!-- Tab panes -->
                <div class="tab-content text-muted">
                    <!--product head tab--> 
                    <div class="tab-pane active" id="arrow-1" role="tabpanel">
                        
                        <!--add enquiry modal start-->
                        <div class="modal fade" id="AddPurchaseReturn" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="purchase_form" data_fill="false">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Purchase Return</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

				                        <div class="modal-body">

                                            <div class="live-preview">
                                                
                                                <div class="row row_padding">
                                                 
                                                    <div class="col-lg-6">

                                                        <div class="row">
                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2 margin_zero">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basiInput" class="form-label">Referance</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="pr_reffer_id" id="uid" class="form-control input_length" value="" required readonly>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->

                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2 margin_zero">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basiInput" class="form-label">Date</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="pr_date" class="form-control mr_date datepicker_ap input_length" required readonly>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->

                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2 margin_zero">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        
                                                                        <label for="basicInput" class="form-label">Vendor Name</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        
                                                                        <select class="form-select select_vendor add_vendor vendor_data input_length" name="pr_vendor_name" id=""  required>
                                                                            
                                                                            <option value="" selected disabled>Select Customer</option>
                                                                           
                                                                        </select>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->

                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2 margin_zero">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        
                                                                        <label for="basicInput" class="form-label">Vendor Inv Ref <span class="add_more_icon add_contact ri-add-line"></span></label>
                                                                    
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        
                                                                        <select class="form-select vendor_inv_ref input_length" name="pr_vendor_inv" id="" required></select>
                                                                    
                                                                    </div>


                                                                   

                                                                </div> 

                                                            </div>    

                                                            <!-- ### -->



                                                        </div>

                                                    </div>


                                                    <div class="col-lg-6">

                                                        <div class="row">



                                                            <!-- Single Row Start -->

                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2 margin_zero">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        
                                                                        <label for="basicInput" class="form-label">Lpo Ref</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        
                                                                        <input type="text" name="pr_lpo" class="form-control input_length" value="" required>   

                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 

                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2 margin_zero">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Contact Person</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="pr_contact_person" class="form-control  add_contact_person input_length" value="" required>
                                                                    </div>

                                                                </div> 

                                                            </div>    
                                                            <!-- ### --> 

                                                            
                                                            
                                                            
                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2 margin_zero">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Payment Term</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="pr_payment_term" class="form-control add_payment_term input_length" value="" required>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 

                                                            

                                                            


                                                            <input type="hidden" class="hidden_purchase_return_id" name="pr_id">



                                                        </div>

                                                    </div>
                                                   


                                                </div>


                                                <!--table section start-->
                                                <div class="mt-4 content_table">
                                                    <table class="table table-bordered table-striped delTable selected_table add_table" style="display:none;">
                                                        <thead class="travelerinfo">
                                                            
                                                            <tr>
                                                                <td style="width:4%">SI</td>
                                                                <td style="width:11%">Sales Order</td>
                                                                <td>Product Description</td>
                                                                <td style="width:11%">Debit A/C</td>
                                                                <td style="width:6%">Qty</td>
                                                                <td style="width:6%">Unit</td>
                                                                <td style="width:6%">Rate</td>
                                                                <td style="width:7%">Discount</td>
                                                                <td style="width:9%">Amount</td>
                                                            </tr>
                                                            
                                                            
                                                        </thead>

                                                        <tbody  class="travelerinfo product-more2"></tbody>

                                                        <tbody>
                                                            <tr>
                                                               
                                                                <td colspan="7" class="sales_order_amount_in_word"></td>
                                                                <input type="hidden" name="so_amount_total_in_words" class="sales_order_amount_in_word_val">
                                                                <td class="text-center" style="padding:10px 10px;">Total</td>
                                                                <td><input type="text" name="pr_total_amount" class="amount_total form-control text-end" readonly=""></td>
                                                            </tr>

                                                        </tbody>
                                                        
                                                    </table>
                                                </div>


                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        
                                                        <div class="row row_align mb-4" style="display:none;">
                                                            
                                                            <div class="col-lg-2">
                                                                <label for="basicInput" class="form-label">Attach</label>
                                                            </div>

                                                            <div class="col-lg-4">
                                                                <input type="file" name="pr_file" Class="image_file"  class="form-control">
                                                            </div>

                                                        </div>

                                                        
                                                    </div>
                                                    
                                                    <div class="col-lg-6"></div>
                                                    
                                                </div>


                                                

                                                <!--table section end-->


                                            </div>  
                                            
                                            
						                    
				                        </div>


                                        <div class="modal-footer justify-content-center">
                                            <button class="btn btn btn-success" type="submit">Save</button>
                                        </div>


                                        
			                        </div>
		                        </form>

	                        </div>
                        </div>


                        <!--####-->


                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">View Material Received Note</h4>
                                        <button type="button"   class="btn btn-primary py-1 add_model_btn">Add</button>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <table id="DataTable" class="table table-bordered table-striped delTable display dataTable">
                                            
                                            <thead>
                                                <tr>
                                                    <th class="no-sort">Sl no</th>
                                                    <th>Reference</th>
                                                    <th>Vendor Name</th>
                                                    <th>Date</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            
                                            <tbody></tbody>

                                        </table>
                
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                    </div>
                    <!--###-->


                   

                    
                </div>
                    
                    
                    
            </div>
                    
        </div>
                    
                    
    </div>
                    
    
                        
</div>

<!--select modal section start-->

<div class="modal fade" id="SelectProduct" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<form  class="Dashboard-form class" id="selected_prod_form">
			<div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

				<div class="modal-body">

                    <div class="live-preview">
                                                
                        <div class="mt-4 content_table">
                            
                            <table class="table table-bordered table-striped delTable add_table">
                                
                                <thead class="travelerinfo contact_tbody">
                                    
                                    <tr>
                                        <td style="width:4%;">SI</td>
                                        <td>Product Description</td>
                                        <td style="width:6%;">Qty</td>
                                        <td style="width:4%;">Tick</td>
                                    </tr>
                                                            
                                                           
                                </thead>
                                                        
                                <tbody  class="travelerinfo select_prod_add"></tbody>

                               



                            </table>
                            
                        </div>




                    </div>  
                                            
                                            
                </div>

                <div class="modal-footer justify-content-center">
                    
                    <input type="hidden" id="select_prod_id" name="select_prod_id" value="">                                
                    <span class="btn btn btn-success prod_modal_submit">Save</span>

                </div>




                                        
			</div>
		</form>

	</div>

</div>



<!--select  modal section end-->



<!--payment modal start-->


<div class="modal fade" id="paymentModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<form  class="Dashboard-form class" id="">
			<div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

				<div class="modal-body">

                    <div class="live-preview">
                                                
                        <div class="mt-4 content_table">
                            
                            <table class="table table-bordered table-striped delTable add_table">
                                
                                <thead class="travelerinfo contact_tbody">
                                    
                                    <tr>
                                        <td>Serial No.</td>
                                        <td>Date</td>
                                        <td>Invoice Ref</td>
                                        <td>Amount</td>
                                        <td>Adjustment</td>
                                        <td>Tick</td>
                                    </tr>
                                                            
                                                           
                                </thead>
                                                        
                                <tbody  class="travelerinfo payment_prod">
                                    
                                </tbody>


                            </table>
                            
                        </div>




                    </div>  
                                            
                                            
                </div>

                <div class="modal-footer justify-content-center">
                    
                                               
                    <span class="btn btn btn-success payment_modal_submit" data-bs-dismiss="modal" aria-label="Close">Save</span>

                </div>




                                        
			</div>
		</form>

	</div>

</div>



<!--payment modal end-->




<!--vendor modal start-->

<?= $this->include('procurement/add_vendor') ?>

<!--vendor modal end-->


<!--contact modal start-->

<?= $this->include('procurement/add_vendor_contact') ?>

<!--contact modal end-->


  <!---view modal start--->

<div class="modal fade" id="ViewModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
        <form  class="Dashboard-form class" id="">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Purchase Return</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="live-preview">
                        
                        <div class="row row_padding">
                            
                            <div class="col-lg-6">

                                <div class="row">

                                        
                                    <!-- Single Row Start -->
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2 margin_zero">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basiInput" class="form-label">Referance</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="text" name="" id="" class="form-control view_ref input_length" readonly>
                                            </div>

                                        </div> 

                                    </div>    

                                    <!-- ### -->


                                    <!-- Single Row Start -->
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2 margin_zero">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basiInput" class="form-label">Date</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="text" name="" class="form-control view_date input_length" readonly>
                                            </div>

                                        </div> 

                                    </div>    

                                    <!-- ### --> 


                                    <!-- Single Row Start -->

                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2 margin_zero">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Vendor Name</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                            
                                                <input type="text" name="" class="form-control view_vendor_name input_length" readonly>
                                        
                                            </select>
                                            </div>

                                        </div> 

                                    </div>    

                                    <!-- ### --> 

                                    

                                    <!-- Single Row Start -->
                                    
                                    
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2 margin_zero">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Vendor Inv Ref</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                
                                                <input type="text" name="" class="form-control view_vendor_inv_ref input_length" readonly>
                                                
                                            </div>

                                        </div> 

                                    </div>    

                                    
                                    <!-- ### --> 


                                    

                                </div>

                            </div>


                            <div class="col-lg-6">

                                <div class="row">
                                    

                                    

                                    <!-- Single Row Start -->
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2 margin_zero">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Lpo Ref</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                
                                                <input type="text" name="" class="form-control view_lpo_ref input_length" readonly>
                                            
                                            </div>

                                        </div> 

                                    </div>    

                                    <!-- ### --> 
                                    


                                    <!-- Single Row Start -->
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2 margin_zero">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Contact Person</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                
                                                <input type="text" name="" class="form-control view_contact_person input_length" readonly>
                                                
                                            </div>

                                        </div> 

                                    </div>    

                                    <!-- ### -->

                                    


                                    <!-- Single Row Start -->
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2 margin_zero">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Payment Term</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="text" name="" class="form-control view_payment_term input_length" readonly>
                                            </div>

                                        </div> 

                                    </div>    

                                    <!-- ### --> 




                                </div>

                            </div>
                                                                    

                        </div>


                        <!--table section start-->
                        <div class="mt-4 content_table">
                            <table class="table table-bordered table-striped delTable add_table">
                                <thead class="travelerinfo contact_tbody">
                                    <tr>
                                        
                                        <td class="text-center" style="width: 4%;">SI</td>
                                        <td class="text-center" style="width: 10%;">Sales Order</td>
                                        <td class="text-center">Product Description</td>
                                        <td class="text-center" style="width: 8%;">Credit A/C</td>
                                        <td class="text-center" style="width: 6%;">Qty</td>
                                        <td class="text-center" style="width: 6%;">Unit</td>
                                        <td class="text-center" style="width: 6%;">Rate</td>
                                        <td class="text-center" style="width: 7%;">Discount</td>
                                        <td class="text-center" style="width: 9%;">Amount</td>
                                       
                                    </tr>
                                    
                                    
                                </thead>
                                
                                <tbody  class="travelerinfo view_prod_data"></tbody>

                                <tbody>
                                    <tr>
                                        
                                        <td colspan="7" class=""></td>
                                        <td class="text-center" style="padding:10px 10px;">Total</td>
                                        <td><input type="text" name="" class="view_total_prod form-control text-end" readonly=""></td>
                                    </tr>

                                </tbody>

                                
                            </table>
                        </div>



                        <div class="row">
                            <div class="col-lg-6">
                                
                                <div class="card-body view_image_table" style="float: inline-start;"></div>

                                
                            </div>
                            <div class="col-lg-6"></div>
                            
                        </div>

                        <!--table section end-->


                    </div>  
                        
                    
                </div>


                
            </div>
        </form>

	</div>
</div>

<!--view modal end-->



<!--edit modal start-->

<div class="modal fade" id="EditModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
        <form  class="Dashboard-form class" id="edit_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Purchase Return</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="live-preview">
                        
                        <div class="row row_padding">
                            
                            <div class="col-lg-6">

                                <div class="row">

                                        
                                    <!-- Single Row Start -->
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2 margin_zero">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basiInput" class="form-label">Referance</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="text" name="" id="" class="form-control edit_ref input_length" readonly>
                                            </div>

                                        </div> 

                                    </div>    

                                    <!-- ### -->


                                    <!-- Single Row Start -->
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2 margin_zero">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basiInput" class="form-label">Date</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="text" name="" class="form-control edit_date input_length" readonly>
                                            </div>

                                        </div> 

                                    </div>    

                                    <!-- ### --> 


                                    <!-- Single Row Start -->

                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2 margin_zero">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Vendor Name</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                            
                                                <input type="text" name="" class="form-control edit_vendor_name input_length" readonly>
                                        
                                            </select>
                                            </div>

                                        </div> 

                                    </div>    

                                    <!-- ### --> 

                                    

                                    <!-- Single Row Start -->
                                    
                                    
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2 margin_zero">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Vendor Inv Ref</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                
                                                <input type="text" name="" class="form-control edit_vendor_inv_ref input_length" readonly>
                                                
                                            </div>

                                        </div> 

                                    </div>    

                                    
                                    <!-- ### --> 


                                    

                                </div>

                            </div>


                            <div class="col-lg-6">

                                <div class="row">
                                    

                                    

                                    <!-- Single Row Start -->
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2 margin_zero">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Lpo Ref</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                
                                                <input type="text" name="edit_lpo_ref" class="form-control edit_lpo_ref input_length" >
                                            
                                            </div>

                                        </div> 

                                    </div>    

                                    <!-- ### --> 
                                    


                                    <!-- Single Row Start -->
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2 margin_zero">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Contact Person</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                
                                                <input type="text" name="" class="form-control edit_contact_person input_length" readonly>
                                                
                                            </div>

                                        </div> 

                                    </div>    

                                    <!-- ### -->

                                    


                                    <!-- Single Row Start -->
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2 margin_zero">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Payment Term</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="text" name="edit_payment_term" class="form-control edit_payment_term input_length" >
                                            </div>

                                        </div> 

                                    </div>    

                                    <!-- ### --> 




                                </div>

                            </div>
                                                                    

                        </div>


                        <!--table section start-->
                        <div class="mt-4 content_table">
                            <table class="table table-bordered table-striped delTable add_table">
                                <thead class="travelerinfo contact_tbody">
                                    <tr>
                                        
                                        <td style="width: 4%;">SI</td>
                                        <td style="width: 10%;">Sales Order</td>
                                        <td>Product Description</td>
                                        <td style="width: 8%;">Credit A/C</td>
                                        <td style="width: 6%;">Qty</td>
                                        <td style="width: 6%;">Unit</td>
                                        <td style="width: 6%;">Rate</td>
                                        <td style="width: 7%;">Discount</td>
                                        <td style="width: 9%;">Amount</td>
                                       
                                    </tr>
                                    
                                    
                                </thead>
                                
                                <tbody  class="travelerinfo edit_prod_data"></tbody>

                                <tbody>
                                    <tr>
                                        
                                        <td colspan="7" class=""></td>
                                        <td class="text-center" style="padding:10px 10px;">Total</td>
                                        <td><input type="text" name="" class="edit_total_prod form-control text-end" readonly=""></td>
                                    </tr>

                                </tbody>

                                
                            </table>
                        </div>



                        <!--<div class="row">
                            <div class="col-lg-6">
                                
                                <div class="card-body view_image_table" style="float: inline-start;"></div>

                                
                            </div>
                            <div class="col-lg-6"></div>
                            
                        </div>--->

                        <!--table section end-->


                    </div>  
                        
                    
                </div>

                <div class="modal-footer justify-content-center">
                    <input type="hidden" name="pr_id" class="edit_pr_id">
                    <button class="btn btn btn-success" type="submit">Save</button>
                </div>


                
            </div>
        </form>

	</div>
</div>

<!--edit modal end-->

<script>

    document.addEventListener("DOMContentLoaded", function(event) { 
    
        /*add section start*/  
 
        /*add form*/
        $(function() {
            var form = $('#purchase_form');
            
            form.validate({
                rules: {
                    required: 'required',
                },
                messages: {
                    required: 'This field is required',
                },
                errorPlacement: function(error, element) {} , // To Hide Validation Messages
                submitHandler: function(currentForm) {
                    if($('#purchase_form').attr('data_fill')=="true"){   

                        // Submit the form for the current tab
                        $.ajax({
                            url: "<?php echo base_url(); ?>Procurement/PurchaseReturn/Add",
                            method: "POST",
                            data: $(currentForm).serialize(),
                            success: function(data) {
                                var data = JSON.parse(data);

                                $('#AddPurchaseReturn').modal('hide');

                                $('#paymentModal').modal('show');
                            
                                alertify.success('Data Added Successfully').delay(3).dismissOthers();
                            
                                datatable.ajax.reload(null, false);

                                var vendorID = data.vendor_id;

                                $.ajax({

                                    url : "<?php echo base_url(); ?>Procurement/PurchaseReturn/FetchInvoice",

                                    method : "POST",

                                    data: {ID: vendorID},
                                    
                                    success: function(data) {
                                         
                                        var data = JSON.parse(data);

                                        $('.payment_prod').html(data.product_detail);

                                        

                                    }
                                    

                                });
                            
                                
                            }
                        });

                    }
                    else
                    {
                        alertify.error('Please Select Products').delay(3).dismissOthers();

                        
                        $('#blink').each(function() {
                            var elem = $(this);
                            refreshIntervalId = setInterval(function() {
                                if (elem.css('visibility') == 'hidden') {
                                    elem.css('visibility', 'visible');
                                } else {
                                    elem.css('visibility', 'hidden');
                                }    
                            }, 200);
                        });

                        setTimeout(function(){
                            clearInterval(refreshIntervalId);
                            
                        }, 1000)
                    }
                   
                }
            });
        });


        /*#####*/

        

       





       /*Product Drop Down*/
       function InitSelect2(){
          $(".ser_product_det:last").select2({
            placeholder: "Select Product",
            theme : "default form-control- select_width",
            dropdownParent: $('#AddPurchaseOrder'),
            ajax: {
                url: "<?= base_url(); ?>Procurement/MaterialRequisition/FetchProdDes",
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
                        results: $.map(data.result, function (item) { return {id: item.product_id, text: item.product_details}}),
                        pagination: {
                        // THE `10` SHOULD BE SAME AS `$resultCount FROM PHP, it is the number of records to fetch from table` 
                            more: (page * 10) <= data.total_count
                        }
                    };
                },              
            }
        })
        }

        InitSelect2();

        /*###*/



        /*Time Frame section start*/

         
         $("body").on('change', '.mr_date', function(){ 
	        
            var date = $(this).val();
 
            
 
            $.ajax({
 
                url : "<?php echo base_url(); ?>Procurement/MaterialRequisition/Date",
 
                method : "POST",
 
                data: {Date: date},
 
                success:function(data)
                {   
                    var data = JSON.parse(data);
                 
                    $('.time_frame_date').val(data.increment_date_date)
                 
                     
                }
 
 
            });
 
 
        });
 
      
 
        /*Time Frame section end*/



        /*material recived not section start*/


        /*$("body").on('change', '.material_received_note', function(){ 
	        
            var date = $(this).val();
 
 
            $.ajax({
 
                url : "<?php echo base_url(); ?>Procurement/PurchaseVoucher/FetchPurchase",
 
                method : "POST",
 
                data: {Date: date},
 
                success:function(data)
                {   
                    var data = JSON.parse(data);
                 
                    $('.time_frame_date').val(data.increment_date_date)
                 
                     
                }
 
 
            });
 
 
        });*/


        /*material receivec not section end*/


        /*reset reff no*/

        $('.add_mr_form').click(function(){
           
            $('#add_enquiry_form')[0].reset();
            $('.ser_product_det').val('').trigger('change');
            $('.add_assigned_to').val('').trigger('change');
            $('.add_sales_order').val('').trigger('change');
            $('.mr_remove').remove();

            $.ajax({

                url : "<?php echo base_url(); ?>Procurement/MaterialRequisition/FetchReference",

                method : "GET",

                success:function(data)
                {  
                    $('#mr_id').val(data);
                
                }

            });

        });

        /*####*/


        /*serial no correction section start*/

        function slno(){

            var pp =1;

            $('body .prod_row').each(function() {

                $(this).find('.si_no').html(pp);
                
                
                
                pp++;

            });
        }

        /*###*/


        /*add section end*/




        /*data table start*/ 

        function initializeDataTable() {

            datatable = $('#DataTable').DataTable({
            'stateSave': true,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': 
            {
                'url': "<?php echo base_url(); ?>Procurement/PurchaseReturn/FetchData",
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
                { data: 'pr_id'},
                { data: 'pr_reffer_id'},
                { data: 'pr_vendor_name'},
                { data: 'pr_date'},
                { data: 'action'},
                
               ]
    
            });
        }

        $(document).ready(function () {
            initializeDataTable();
        });


        /*###*/


        /*reset reffer no*/ 
        $('.add_model_btn').click(function(){

            $('#purchase_form')[0].reset();
            $('.add_vendor').val('').trigger('change');
            $('#AddPurchaseOrder').modal('hide');
            $('.add_prod_remove').remove();
            $('.hidden_recived_id').val("");
            $('.hidden_purchase_return_id').val("");
            
            $.ajax({

                url : "<?php echo base_url(); ?>Procurement/PurchaseReturn/AddAccess",

                method : "POST",

                success:function(data)
                {

                    var data = JSON.parse(data);

                    if(data.status === 0){
                    
                        alertify.error(data.msg).delay(3).dismissOthers();

                    }
                    else{

                        $('#AddPurchaseReturn').modal('show');

                    }
                    

                }

            });

            $.ajax({

                url : "<?php echo base_url(); ?>Procurement/PurchaseReturn/FetchReference",

                method : "GET",

                success:function(data)
                {

                    $('#uid').val(data);

                }
            });

        });

        /*####*/


        /*customer droup drown search*/
        $(".select_vendor").select2({
            placeholder: "Select Vendor Name",
            theme : "default form-control- customer_width input_length3",
            dropdownParent: $('#AddPurchaseReturn'),
            ajax: {
                url: "<?= base_url(); ?>Procurement/PurchaseReturn/FetchTypes",
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
                        results: $.map(data.result, function (item) { return {id: item.cc_id, text: item.cc_customer_name}}),
                        pagination: {
                        // THE `10` SHOULD BE SAME AS `$resultCount FROM PHP, it is the number of records to fetch from table` 
                            more: (page * 10) <= data.total_count
                        }
                    };
                },              
            }
         
        })
        /*###*/



       




        /*add selected product*/


        /*$("body").on('click', '.cust_more_modal', function()
        { 
            if(!$("#purchase_form").valid())
            {
                alertify.error('Fill required fields!').delay(3).dismissOthers();
                return false;
            }

            if($('#purchase_form').attr('data-submit')=='false')
            {

             $('#purchase_form').submit();

                if(!$("#purchase_form").valid())
                {
                alertify.error('Fill required fields!').delay(3).dismissOthers();
                return false;
                }

            }

            var formData = new FormData($('#purchase_form')[0]);
            var image = $('.image_file').prop('files')[0]; // Get the file from input field
            formData.append('pr_file', image); // Append the file to FormData object

           

            $.ajax({
                        url: "<?php echo base_url(); ?>Procurement/PurchaseReturn/Add",
                        method: "POST",
                        data: formData,
                        processData: false, // Don't process the data
                        contentType: false, // Don't set content type
                        success: function(data) {

                            var data = JSON.parse(data);

                            var purchase_voucher_id = data.purchase_voucher_id;

                            $('.hidden_purchase_voucher_id').val(purchase_voucher_id);

                            var purchase_id = data.purchase_order;

                            $('#AddPurchaseVoucher').modal('hide');

                            $('#SelectProduct').modal('show');

                           
                            $.ajax({

                                url : "<?php echo base_url(); ?>Procurement/PurchaseVoucher/FetchProduct",

                                method : "POST",

                                data: {ID: purchase_id},
                                
                                success:function(data)
                                {   
                                    var data = JSON.parse(data);

                                    $(".select_prod_add").html(data.product_detail);
                         
                                }  

                            });
 
                            
                        }

                    });

        });*/


        /*#######*/


        /*prod modal submit start*/

        $("body").on('click', '.prod_modal_submit', function(){ 

            var selectId = $('#select_prod_id').val();

            $.ajax({

                url : "<?php echo base_url(); ?>Procurement/PurchaseReturn/SelectedProduct",

                method : "POST",

                data: {ID: selectId},

                success:function(data)
                {
                
                    var data = JSON.parse(data);

                    $('.product-more2').html(data.product_detail);

                    $('.amount_total').val(data.total_amount);

                    $('#SelectProduct').modal("hide");

                    $('#AddPurchaseReturn').modal("show");

                    $('.selected_table').show();
                        
                    checkedIds.length = 0; 

                    $('#purchase_form').attr('data_fill','true');

                }

            });
        });


        /*prod modal submit end*/

        /*calculation section start*/

	    $("body").on('keyup', '.add_discount', function(){ 

            var $discountSelect = $(this);

            var discount = parseInt($discountSelect.closest('.add_prod_row').find('.add_discount').val())||0;

            var $discountSelectElement = $discountSelect.closest('.add_prod_row').find('.add_prod_rate');

            var rate = $discountSelectElement.val();

            var $quantitySelectElement = $discountSelect.closest('.add_prod_row').find('.add_prod_qty');

            var quantity = parseInt($quantitySelectElement.val())||0;

            var parsedRate = parseFloat(rate);

            var parsedQuantity = quantity; 

            var multipliedTotal = parsedRate * parsedQuantity;

            var per_amount = (discount/100)*multipliedTotal;

            var orginalPrice = multipliedTotal - per_amount;

            var orginalPrice = orginalPrice.toFixed(2); //For showing 1000.00 instead of 1000 if no decimal present

            var $amountElement = $discountSelect.closest('.add_prod_row').find('.add_prod_amount');

            $amountElement.val(orginalPrice);

        });

        /*####*/



        /*add current delivery start*/

        $("body").on('keyup', '.add_current_qty', function(){ 


            var dataSelect = $(this);

            var deliverySelectElement = dataSelect.closest('.add_prod_row').find('.add_delivery_qty');

            var delivery = parseFloat(deliverySelectElement.val()) || 0; // Convert to number, default to 0 if NaN

            var currentSelectElement = dataSelect.closest('.add_prod_row').find('.add_current_qty');

            var current = parseFloat(currentSelectElement.val()) || 0; // Convert to number, default to 0 if NaN
            
            var total = delivery + current;

            var orderSelectElement = dataSelect.closest('.add_prod_row').find('.add_order_qty');

            var order = orderSelectElement.val();

            //var order = parseFloat(orderSelectElement.val()) || 0;

            


            if(total > order)
            {   
   
                /*var currencyNull = currentSelectElement.val("");

                console.log(currencyNull);

                var $currencyNullElement = dataSelect.closest('.add_prod_row').find('.add_current_qty');

                $currencyNullElement.val(currencyNull);*/

                /**/

                currentSelectElement.val(""); // Set the value to an empty string
                var currencyNull = currentSelectElement.val(); // Get the current (now empty) value
                
                var $currencyNullElement = dataSelect.closest('.add_prod_row').find('.add_current_qty');
                $currencyNullElement.val(currencyNull); // Set the value of $currencyNullElement to the empty string


                /**/


                alertify.error('Delivery Qty + Current Delivery Should Not Exceed The Order Qty').delay(3).dismissOthers();
                
            }

        });


        /*add current delivery end*/


        /*vendor new modal start*/
        
        $("body").on('click', '.vendor_new_modal', function(){ 
            
            $('#AddPurchaseOrder').modal('hide');

            $('#AddVendor').modal('show');

           
        });

        /*vendor new modal end*/


        //trigger when form is submitted

        $("#add_office_form").submit(function(e){

            $('#AddPurchaseOrder').modal('show');

            return false;

        });

        /*#####*/


        /*contact new modal start*/

        $("body").on('click', '.contact_new_modal', function(){
           
            var vendor = $('.add_vendor').val();

            if(vendor === null)
            {
                alertify.error('Please Select Vendor Name').delay(2).dismissOthers();
            }
            else
            {
                $('#AddNewContact').modal('show');

                $('#AddPurchaseOrder').modal('hide');

                $('.new_pro_con_vendor').val(vendor);
            }
            
          
        });


        /*contact new modal end*/

        
       /*fetch purchase order by vendor name*/

       $("body").on('change', '.vendor_data', function(){ 

            var Id = $('.vendor_data').val();

            $.ajax({

                url : "<?php echo base_url(); ?>Procurement/PurchaseReturn/VendorInv",

                method : "POST",

                data: {ID: Id},

                success:function(data)
                {
                
                    var data = JSON.parse(data);

                    console.log(data.vendor_inv)

                    $('.vendor_inv_ref').html(data.vendor_inv);
                  
                }

            });
        });
       
       /*###*/



        /*fetch data by vendor inv */

       $("body").on('change', '.vendor_inv_ref', function(){ 

            var id = $('.vendor_inv_ref').val();

           

            $.ajax({

                url : "<?php echo base_url(); ?>Procurement/PurchaseReturn/FetchContact",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {
                
                    var data = JSON.parse(data);

                    $('.add_contact_person').val(data.contact_person);

                    $('.add_payment_term').val(data.payment_term);
                  
                }

            });
        });
       
       /*###*/



        /*add product start*/

        $("body").on('click', '.add_more_icon', function()
        { 
            if(!$("#purchase_form").valid())
            {
                alertify.error('Fill required fields!').delay(3).dismissOthers();
                return false;
            }

            if($('#purchase_form').attr('data-submit')=='false')
            {

                $('#purchase_form').submit();

                if(!$("#purchase_form").valid())
                {
                    alertify.error('Fill required fields!').delay(3).dismissOthers();
                    return false;
                }

            }

            var formData = new FormData($('#purchase_form')[0]);
            var image = $('.image_file').prop('files')[0]; // Get the file from input field
            formData.append('image', image); // Append the file to FormData object

            $.ajax({
                        url: "<?php echo base_url(); ?>Procurement/PurchaseReturn/Add",
                        method: "POST",
                        data: formData,
                        processData: false, // Don't process the data
                        contentType: false, // Don't set content type
                        success: function(data) {

                            var data = JSON.parse(data);

                            var purchase_return_id = data.purchase_return_id;

                            $('.hidden_purchase_return_id').val(purchase_return_id);

                            var vendor_inv_ref = data.vendor_inv_ref;

                            $('#AddPurchaseReturn').modal('hide');

                            $('#SelectProduct').modal('show');

                           
                            $.ajax({

                                url : "<?php echo base_url(); ?>Procurement/PurchaseReturn/FetchProduct",

                                method : "POST",

                                data: {ID: vendor_inv_ref},
                                
                                success:function(data)
                                {   
                                    var data = JSON.parse(data);

                                    $(".select_prod_add").html(data.product_detail);
                         
                                }  

                            });
 
                            
                        }

                    });

        });


       /*#####*/




        /*fetch purchase voucher start*/


        $("body").on('change', '.material_received_note', function(){ 

            var Id = $('.material_received_note').val();
 
            $.ajax({

                url : "<?php echo base_url(); ?>Procurement/PurchaseVoucher/FetchPurchase",

                method : "POST",

                data: {ID: Id},

                success:function(data)
                {
                
                    var data = JSON.parse(data);

                    $('.select_purchase').val(data.purchase_order);

                    $('.delivery_note_clz').val(data.delivery_note);

                    $('.add_payment_term').val(data.payment_term);
                   
                    
                }

            });

        });


       /*########*/


       /*fetch data by purchase order*/

       $("body").on('change', '.select_purchase', function(){ 

            var Id = $('.select_purchase').val();

            $.ajax({

                url : "<?php echo base_url(); ?>Procurement/PurchaseVoucher/FetchPayment",

                method : "POST",

                data: {ID: Id},

                success:function(data)
                {
                
                    var data = JSON.parse(data);

                    $('.add_payment_term').val(data.payment_term);

                    $('.mr_ref').val(data.mr_reff);

                    
                }

            });
        });


       /*####*/

       



        /*add section end*/



        
        /*view section start*/

        $("body").on('click', '.view_btn', function(){ 

            var id = $(this).data('id');

            $.ajax({

                url : "<?php echo base_url(); ?>Procurement/PurchaseReturn/View",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {
                
                    var data = JSON.parse(data);
                                    
                    $('.view_ref').val(data.reffer_id);

                    $('.view_date').val(data.date);

                    $('.view_vendor_name').val(data.vendor_name);

                    $('.view_vendor_inv_ref').val(data.vendor_inv);

                    $('.view_lpo_ref').val(data.lpo);

                    $('.view_contact_person').val(data.contact_person);

                    $('.view_payment_term').val(data.payment_term);

                    $('.view_total_prod').val(data.total_amount);

                    $('.view_prod_data').html(data.purchase_return);

                    $('#ViewModal').modal("show");
                    
                }

            });

        });


        /*view section end*/



        /*edit section start*/
        
        $("body").on('click', '.edit_btn', function(){ 

            var id = $(this).data('id');

            $.ajax({

                url : "<?php echo base_url(); ?>Procurement/PurchaseReturn/Edit",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {
                
                    var data = JSON.parse(data);

                    if(data.status === 0){

                        alertify.error(data.msg).delay(3).dismissOthers();

                    }else{
                      
                        $('.edit_ref').val(data.reffer_id);

                        $('.edit_pr_id').val(data.pr_id);

                        $('.edit_date').val(data.date);

                        $('.edit_vendor_name').val(data.vendor_name);

                        $('.edit_vendor_inv_ref').val(data.vendor_inv);

                        $('.edit_lpo_ref').val(data.lpo);

                        $('.edit_contact_person').val(data.contact_person);

                        $('.edit_payment_term').val(data.payment_term);

                        $('.edit_total_prod').val(data.total_amount);

                        $('.edit_prod_data').html(data.purchase_return);

                        $('#EditModal').modal("show");
                    

                    }
                                    
                    
                }

            });

        });


        $(function() {
            var form = $('#edit_form');
            
            form.validate({
                rules: {
                    required: 'required',
                },
                messages: {
                    required: 'This field is required',
                },
                errorPlacement: function(error, element) {} , // To Hide Validation Messages
                submitHandler: function(currentForm) {
                    //if($('#purchase_form').attr('data_fill')=="true"){   

                        // Submit the form for the current tab
                        $.ajax({
                            url: "<?php echo base_url(); ?>Procurement/PurchaseReturn/Update",
                            method: "POST",
                            data: $(currentForm).serialize(),
                            success: function(data) {
                                
                                $('#EditModal').modal('hide');
                            
                                alertify.success('Data Updated Successfully').delay(3).dismissOthers();
                            
                                datatable.ajax.reload(null, false);
                             
                            }
                        });

                }
            });
        });

        /*edit section end*/



        /*delete section start*/

        $("body").on('click', '.delete_btn', function(){ 
            
            if (!confirm('Are you absolutely sure you want to delete?')) return false;
            
            var id = $(this).data('id'); 

            var rowToDelete = $(this).closest('tr');

            $.ajax({

                url : "<?php echo base_url(); ?>Procurement/PurchaseReturn/Delete",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {   
                    var data = JSON.parse(data);

                    if(data.status === 1){

                        rowToDelete.fadeOut(500, function() {
                            $(this).remove();
                            alertify.success(data.msg).delay(3).dismissOthers();
                            datatable.ajax.reload(null,false);
                        });
                    }else{

                        alertify.error(data.msg).delay(2).dismissOthers();
                    }
                    
                    
                     

                }

            });

        });

        /*delete section end*/


        /**/

        $('.datepicker_ap').change(function(){

            var date = $(this).val();

            $.ajax({

                url: "<?php echo base_url(); ?>Procurement/PurchaseReturn/FetchReference/r/"+date+"",

                method: "POST",

                success: function(data) {
                    
                    $('#uid').val(data);

                }
                
            });


        })

        /**/



    });



    /*checkbox section start*/

     var checkedIds = [];

    //checkedIds.splice(0)

    checkedIds.length = 0;

    
    // Check All function

    function checkAll(checkbox) 
    {
        var checkboxes = document.getElementsByClassName('prod_checkmark');

        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = checkbox.checked;
            handleCheckboxChange(checkboxes[i]); // Update the array and modal form
        }
    }

    // Handle individual checkbox change
    function handleCheckboxChange(checkbox) 
    {   
        //checkedIds.length = 0;

        if (checkbox.checked) {
            // Add the ID to the array if checked
            checkedIds.push(checkbox.id);
        } else {
            // Remove the ID from the array if unchecked
            checkedIds = checkedIds.filter(id => id !== checkbox.id);
        }

        // Log the current state of checked IDs
        //console.log('Checked IDs: ', checkedIds);
        document.getElementById('select_prod_id').value = checkedIds.join(',');
    }


/*checkbox section end*/



</script>