<style>
    span.select2.customer_width {
        width: 100% !important;
    } 
    .contact_more_modal
    {
        position: absolute;
        left: 471px;
        padding: 2px 27px;
        z-index: 999;
        border: 1px solid black;
        border: 1px solid #0000003b;
    }
    .cust_more_modal
    {
        /*position: absolute;
        left: 471px;
        padding: 2px 27px;
        z-index: 999;
        border: 1px solid black;
        border: 1px solid #0000003b;*/
        position: absolute;
        right: 35px;
        font-size: 25px;
        top: -15px;
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
    .add_new
    {
        /*position: absolute;
        left: 471px;
        padding: 2px 27px;
        z-index: 999;
        border: 1px solid black;
        border: 1px solid #0000003b;*/
        font-size: 25px;
        color: #ff0000b5;
        position: absolute;
        right: 34px;
        top: -16px;
    }
    .input_length 
    {
        width: 95%;
    }
    .input_length2 
    {
        width: 93%;
    }
    .disabled-span
    {
        pointer-events: none;
        opacity: 0.5;
        cursor: not-allowed;
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
                        
                        <!--add purchase order modal start-->
                        <div class="modal fade" id="AddPurchaseOrder" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="add_po_form" data_fill="false">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Purchase Order</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

				                        <div class="modal-body">

                                            <div class="live-preview">
                                                
                                                <div class="row">
                                                 
                                                    <div class="col-lg-6">

                                                        <div class="row">
                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basiInput" class="form-label">Referance</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="po_reffer_no" id="po_id" class="form-control input_length" value="" required readonly>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->

                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basiInput" class="form-label">Date</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="po_date" class="form-control mr_date datepicker input_length" required readonly>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->

                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        
                                                                        <label for="basicInput" class="form-label">Vendor Name</label>
                                                                    </div>

                                                                    <div class="col-col-md-8 col-lg-8">
                                                                        
                                                                        <select class="form-select select_vendor add_vendor" name="po_vendor_name" id=""  required>
                                                                            
                                                                            <option value="" selected disabled>Select Customer</option>
                                                                           
                                                                        </select>
                                                                    </div>

                                                                    <div class="col-col-md-1 col-lg-1">
                                                                        <span class="add_more_icon add_new vendor_new_modal  ri-add-box-fill"></span>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->

                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        
                                                                        <label for="basicInput" class="form-label">Contact Person</label>
                                                                    
                                                                    </div>

                                                                    <div class="col-col-md-8 col-lg-8">
                                                                        
                                                                        <select class="form-select add_contact_person" name="po_contact_person" id="" required></select>
                                                                    
                                                                    </div>


                                                                    <div class="col-col-md-1 col-lg-1">
                                                                        <span class="add_more_icon add_new contact_new_modal ri-add-box-fill"></span>
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

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        
                                                                        <label for="basicInput" class="form-label">MRN Ref<!--<span class="add_more_icon cust_more_modal">Select</span>--></label>
                                                                    </div>

                                                                    <div class="col-col-md-8 col-lg-8">
                                                                        
                                                                        <select class="form-select" name="po_mrn_reff" id="po_mrn_reff_id" required>
                                                                            
                                                                            <option value="" selected disabled>Select MRN Ref</option>
                                                                            
                                                                            
                                                                            <?php foreach($material_reqisition as $mat_req){?> 
                                                                                <option value="<?php echo $mat_req->mr_id; ?>"><?php echo $mat_req->mr_reffer_no;?></option>
                                                                            <?php } ?>
                                                                           
                                                                        </select>

                                                                    </div>


                                                                    <div class="col-col-md-1 col-lg-1">
                                                                        <span class="add_more_icon cust_more_modal ri-add-box-fill" id="blink"></span>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 
                                                            
                                                            
                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Payment Term</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text " name="po_payment_term" class="form-control add_payment_term input_length2 " value="" required>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Delivery Date</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="po_delivery_date" class="form-control time_frame_date datepicker input_length2 " value="" required>
                                                                    </div>

                                                                </div> 

                                                            </div>    
                                                            <!-- ### --> 



                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Vendor Ref</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="po_vendor_ref" class="form-control input_length2 " value="" required>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 

                                                            <input type="hidden" class="hidden_purchase_id" name="po_id">



                                                        </div>

                                                    </div>
                                                   


                                                </div>


                                                <!--table section start-->
                                                <div class="mt-4">
                                                    <table class="table table-bordered table-striped delTable selected_table" style="display:none;">
                                                        <tbody class="travelerinfo">
                                                            <tr>
                                                                <td>Serial No.</td>
                                                                <td>Sales Order Ref</td>
                                                                <td>Product Description</td>
                                                                <td>Unit</td>
                                                                <td>Qty</td>
                                                                <td>Rate</td>
                                                                <td>Discount</td>
                                                                <td>Amount</td>
                                                                
                                                            </tr>
                                                            
                                                        </tbody>

                                                        <tbody  class="travelerinfo product-more2"></tbody>
                                                        
                                                        <tbody>
                                                            <tr>
		                                                       
		                                                        <td colspan="6" class=""></td>
		                                                        
		                                                        <td>Total</td>
		                                                        <td><input type="text" name="po_amount" class="amount_total form-control" readonly=""></td>
	                                                        </tr>
	                                                    </tbody>

                                                        <!--<tbody id="product-more" class="travelerinfo"></tbody>--->
                                                    </table>
                                                </div>


                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        
                                                        <div class="row row_align mb-4">
                                                            <div class="col-lg-2">
                                                                <label for="basicInput" class="form-label">Attach</label>
                                                            </div>

                                                            <div class="col-lg-4">
                                                                <input type="file" name="po_file" Class="image_file"  class="form-control">
                                                            </div>

                                                        </div>

                                                        
                                                    </div>
                                                    <div class="col-lg-6"></div>
                                                    
                                                </div>


                                                

                                                <!--table section end-->


                                            </div>  
                                            
                                            
						                    
				                        </div>


                                        <div class="modal-footer justify-content-center">
                                            <button class="btn btn btn-success once_form_submit" type="submit">Save</button>
                                        </div>


                                        
			                        </div>
		                        </form>

	                        </div>
                        </div>

                        <!--####-->



                        <!---view modal start--->

                        <div class="modal fade" id="ViewModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Purchase Order</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

				                        <div class="modal-body">

                                            <div class="live-preview">
                                                
                                                <div class="row">
                                                 
                                                    <div class="col-lg-6">

                                                        <div class="row">

                                                             
                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basiInput" class="form-label">Referance</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="" id="" class="form-control view_ref" readonly>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### -->


                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basiInput" class="form-label">Date</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="" class="form-control view_date" readonly>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->

                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Vendor Name</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                    
                                                                     <input type="text" name="" class="form-control view_vendor_name" readonly>
                                                               
                                                                    </select>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 

                                                            

                                                            <!-- Single Row Start -->
                                                            
                                                            
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Contact Person</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                      
                                                                        <input type="text" name="" class="form-control view_contact_person" readonly>
                                                                        
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

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">MRN Ref</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        
                                                                        <input type="text" name="" class="form-control view_mrn_ref" readonly>
                                                                    
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 
                                                           


                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                    <label for="basicInput" class="form-label">Payment Term</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                       
                                                                       <input type="text" name="" class="form-control view_payment_term" readonly>
                                                                       
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### -->

                                                            


                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Delivery Date</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="" class="form-control view_delivery_date" readonly>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                         

                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Vendor Ref</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name=""  class="form-control view_vendor_ref" readonly>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 



                                                        </div>

                                                    </div>
                                                                                          

                                                </div>


                                                <!--table section start-->
                                                <div class="mt-4">
                                                    <table class="table table-bordered table-striped delTable">
                                                        <thead class="travelerinfo contact_tbody">
                                                            <tr>
                                                                
                                                                <td>Serial No.</td>
                                                                <td>Sales Order</td>
                                                                <td>Product Description</td>
                                                                <td>Unit</td>
                                                                <td>Qty</td>
                                                                <td>Rate</td>
                                                                <td>Discount</td>
                                                                <td style="text-align: center;">Amount</td>
                                                               
                                                            </tr>
                                                            
                                                           
                                                        </thead>
                                                        
                                                        <tbody  class="travelerinfo view_prod_data"></tbody>

                                                        <tbody>
                                                            <tr>
                                                                
                                                                <td colspan="6" class=""></td>
                                                                <td>Total</td>
                                                                <td><input type="text" name="" class="view_total_prod form-control" style="text-align: right;" readonly=""></td>
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


                         <!---edit modal start--->

                         <div class="modal fade" id="EditModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="edit_modal_form">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Purchase Order</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

				                        <div class="modal-body">

                                            <div class="live-preview">
                                                
                                                <div class="row">
                                                 
                                                    <div class="col-lg-6">

                                                        <div class="row">
                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basiInput" class="form-label">Referance</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="po_reffer_no"  class="form-control edit_reff"  required readonly>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->

                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basiInput" class="form-label">Date</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="po_date" class="form-control edit_date datepicker" required readonly>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Vendor Name</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">

                                                                    
                                                                    <select class="form-select edit_vendor" name="po_vendor_name" required="" aria-required="true"></select>

                                                                    </div>

                                                                </div> 

                                                            </div>  

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->

                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Contact Person</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">

                                                                    
                                                                    <select class="form-select edit_contact" name="po_contact_person" required="" aria-required="true"></select>

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

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">MRN Ref</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">

                                                                        <input type="text" name="" class="form-control  edit_mrn_ref" value="" readonly>

                                                                    </div>

                                                                </div> 

                                                            </div>  

                                                            <!-- ### --> 

                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Payment Term</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="po_payment_term" class="form-control  edit_payment_term" value="" required>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->

                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basiInput" class="form-label">Delivery Date</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="po_delivery_date" class="form-control  datepicker edit_delivery_date" required>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### -->


                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Vendor Ref</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="po_vendor_ref" class="form-control edit_vendor_ref" value="" required>
                                                                    </div>

                                                                </div> 

                                                            </div>    
                                                            
                                                            <input type="hidden" name="po_id"  class="edit_purchase_id">

                                                            <input type="hidden"   class="edit_mrn_reff_id">

                                                            <!-- ### --> 




                                                        </div>

                                                    </div>
                                                   



                                                   

                                                </div>


                                                <!--table section start-->
                                                <div class="mt-4">
                                                    <table class="table table-bordered table-striped delTable">
                                                        <tbody class="travelerinfo">
                                                            
                                                            <tr>
                                                                <td>Serial No.</td>
                                                                <td>sales Order Ref</td>
                                                                <td>Product Description</td>
                                                                <td>Unit</td>
                                                                <td>Qty</td>
                                                                <td>Rate</td>
                                                                <td>Discount</td>
                                                                <td style="text-align: center;">Amount</td>
                                                                <td>Actions</td>
                                                                
                                                            </tr>
                                                            
                                                        </tbody>
                                                        <tbody class="edit_products"></tbody>

                                                        <tbody>

                                                            <tr>
                                                                <td colspan="6" class=""></td>
                                                                <td>Total</td>
                                                                <td><input type="text" name="" class="edit_total_prod form-control" readonly="" style="text-align: right;"></td>
                                                            </tr>
                                                            
                                                        </tbody>
	
                                                        
                                                        
                                                    </table>
                                                </div>

                                                <!--table section end-->


                                                <!--image section start--->


                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="card-body edit_image_table"></div>
                                                    </div>
                                                    <div class="col-lg-6"></div>
                                                    
                                                </div>


                                                <!--image section end-->


                                            </div>  
                                            
                                            
						                    
				                        </div>


                                        <div class="modal-footer justify-content-center">
                                            <button class="btn btn btn-success" type="submit">Save</button>
                                        </div>


                                        
			                        </div>
		                        </form>

	                        </div>
                        </div>



                        <!----edit modal end--->


                        <!--add single sales order start-->

                        <div class="modal fade" id="SingleAddSales" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="edit_add_sales_form">
			                        <div class="modal-content">
                    
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Sales Order Details</h5>
                                            <button type="button" class="btn-close edit_modal_close"  aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">

                                            <div class="card-seprate_divider"></div>

                                            <div class="live-preview">
                                                <table  class="table table-bordered table-striped delTable">
                                                    <tbody class="travelerinfo">
                                                        <tr>
                                                            
                                                            <td>Sales Order</td>
                                                            <td>Product Description</td>
                                                            <td>Unit</td>
                                                            <td>Qty</td>
                                                            
                                                        </tr>
                                                        
                                                    </tbody>

                                                    <tbody class="" class="travelerinfo">
                                                        
                                                        <tr>
           
                                                            <td>
                                                                <select class="form-select edit_add_sales_order" name="mrp_sales_order" required>
                                                                    <option value="" selected disabled>Select Sales Order Ref</option>
                                                                    <?php foreach($sales_orders as $sales_order){?> 
                                                                    <option value="<?php echo $sales_order->so_id;?>"><?php echo $sales_order->so_reffer_no;?></option>
                                                                    <?php } ?>
                                                                </select>

                                                            </td>
                                                            <td>
                                                                <select class="form-select edit_add_prod_desc" name="mrp_product_desc"  required>
                                                                    
                                                                </select>
                                                            </td>
                                                            <td><input type="text" name="mrp_unit"  value="" class="form-control" required></td>
                                                            <td> <input type="number" name="mrp_qty" value="" class="form-control" required></td>
                                                            <input type="hidden" name="mrp_mr_id" class="mrp_mr_clz_id">
                                                        </tr>

                                                    </tbody>
                                                         
                                                   
                                                
                                                </table>
                                                    
                                                
                                                <div class="modal-footer justify-content-center">
                                                
                                                    <button class="btn btn btn-success">Save</button>

                                                </div>
                                            </div>   
                                                                    
                                        </div>
                                        
			                        </div>

		                        </form>

	                        </div>

                        </div>

                        <!--add single sales order  end-->



                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">View Purchase Order</h4>
                                        <button type="button"  class="btn btn-primary py-1 add_model_btn">Add</button>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <table id="DataTable" class="table table-bordered table-striped delTable display dataTable">
                                            
                                            <thead>
                                                <tr>
                                                    <th class="no-sort">Sl no</th>
                                                    <th>Reference</th>
                                                    <th>Material Requisition</th>
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
                                                
                        <div class="mt-4">
                            
                            <table class="table table-bordered table-striped delTable">
                                
                                <thead class="travelerinfo contact_tbody">
                                    
                                    <tr>
                                        <td>Serial No.</td>
                                        <td>Product Description</td>
                                        <td>Unit</td>
                                        <td>Qty</td>
                                        <td>Tick</td>
                                    </tr>
                                                            
                                                           
                                </thead>
                                                        
                                <tbody  class="travelerinfo select_prod_add"></tbody>


                            </table>
                            
                        </div>




                    </div>  
                                            
                                            
                </div>

                <div class="modal-footer justify-content-center">
                    
                    <input type="hidden" id="select_prod_id" name="select_prod_id" value="">                                
                    <span class="btn btn btn-success prod_modal_submit" id="select_prod_btn">Save</span>

                </div>




                                        
			</div>
		</form>

	</div>

</div>



<!--select  modal section end-->



<!--edit product single modal start--->

<div class="modal fade" id="EditProdModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<form  class="Dashboard-form class" id="update_single_prod">
			<div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close close_single_prod" data-bs-dismiss="modal"  aria-label="Close"></button>
                </div>

				<div class="modal-body">

                    <div class="live-preview">
                                                
                        <div class="mt-4">
                            
                            <table class="table table-bordered table-striped delTable">
                                
                                <thead class="travelerinfo contact_tbody">
                                    
                                    <tr>
                                        <td>Sales Order Ref</td>
                                        <td>Product Description</td>
                                        <td>Unit</td>
                                        <td>Qty</td>
                                        <td>Rate</td>
                                        <td>Discount</td>
                                        <td>Amount</th>
                                       
                                    </tr>
                                                            
                                                           
                                </thead>
                                                        
                                <tbody  class="travelerinfo edit_single_prod"></tbody>


                            </table>
                            
                        </div>




                    </div>  
                                            
                                            
                </div>

                <div class="modal-footer justify-content-center">
                    
                                                  
                    <button class="btn btn btn-success" type="submit" name="single_prod_sub" >Save</button>

                </div>




                                        
			</div>
		</form>

	</div>

</div>


<!--edit product single modal end--->



<!--vendor modal start-->

<?= $this->include('procurement/add_vendor') ?>

<!--vendor modal end-->


<!--contact modal start-->

<?= $this->include('procurement/add_vendor_contact') ?>

<!--contact modal end-->


<script>

    document.addEventListener("DOMContentLoaded", function(event) { 
    


        /*add section start*/  

        
        /*add form*/
        $(function() {
            var form = $('#add_po_form');
            
            form.validate({
                rules: {
                    required: 'required',
                },
                messages: {
                    required: 'This field is required',
                },
                errorPlacement: function(error, element) {} , // To Hide Validation Messages
                submitHandler: function(currentForm) {
                    if($('#add_po_form').attr('data_fill')=="true"){   

                        var formData = new FormData($('#add_po_form')[0]);
                        var image = $('.image_file').prop('files')[0]; // Get the file from input field
                        formData.append('image', image); // Append the file to FormData object
                        
                        $('.once_form_submit').attr('disabled', true); // Disable this input.
                        
                        // Submit the form for the current tab
                        $.ajax({
                            url: "<?php echo base_url(); ?>Procurement/PurchaseOrder/Add",
                            method: "POST",
                            data: formData,
                            processData: false, // Don't process the data
                            contentType: false, // Don't set content type
                            success: function(data) {
                                
                                $('#AddPurchaseOrder').modal('hide');
                            
                                alertify.success('Data Added Successfully').delay(3).dismissOthers();
                            
                                datatable.ajax.reload(null, false);

                                $('#po_mrn_reff_id option').remove();
                                
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

        

        /*add more product section start*/
        var max_fieldspp  = 30;
        var pp = 1;
        $("#add_product").click(function(){

			if(pp < max_fieldspp){ 
			    pp++;
	           
                
               $("#product-more").append(
                    "<tr class='prod_row mr_remove'>" +
                    "<td class='si_no'><input type='number' value='" + pp + "' name='pd_serial_no[]' class='form-control' required='' readonly></td>" +
                    "<td>" +
                    "<select class='form-select add_sales_order' name='mrp_sales_order[]' required>" +
                    "<option value='' selected disabled>Select Sales Order Ref</option>" +
                    "<?php foreach($sales_orders as $sales_order): ?>" +
                    "<option value='<?php echo $sales_order->so_id; ?>'><?php echo $sales_order->so_reffer_no; ?></option>" +
                    "<?php endforeach; ?>" +
                    "</select>" +
                    "</td>" +
                    "<td style='width: 28%;'>" +
                    "<select class='form-select ser_product_det' name='mrp_product_desc[]' required>" +
                    "<option value='' selected disabled>Select Product Description</option>" +
                    "<?php foreach($products as $prod): ?>" +
                    "<option value='<?php echo $prod->product_id; ?>'><?php echo $prod->product_details; ?></option>" +
                    "<?php endforeach; ?>" +
                    "</select>" +
                    "</td>" +
                    "<td><input type='text' name='mrp_unit[]' class='form-control' required></td>" +
                    "<td><input type='number' name='mrp_qty[]' class='form-control' required></td>" +
                    "<td class='remove-btnpp' colspan='6'><div class='remainpass'><i class='ri-close-line'></i>Remove</div></td>" +
                    "</tr>"
                );

                slno();
                /*customer droup drown search*/
                 InitSelect2();
			}
	    });

        $(document).on("click", ".remove-btnpp", function() 
        {
	        $(this).parent().remove();

	        slno();
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


        /*reset reff no*/

        /*$('.add_mr_form').click(function(){
           
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

        });*/

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


        /*check modal closed*/


        $('.cust_close_modal').click(function(){
           
            $('#AddPurchaseOrder').modal('show');
       });

        

        /*####*/


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
                'url': "<?php echo base_url(); ?>Procurement/PurchaseOrder/FetchData",
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
                { data: 'po_id'},
                { data: 'po_reffer_no'},
                { data: 'po_mrn_reff'},
                { data: 'po_date'},
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

            $('#add_po_form')[0].reset();

            $('.add_vendor').val('').trigger('change');

            $('#AddPurchaseOrder').modal('hide');

            $('.add_prod_remove').remove();

            $('.hidden_purchase_id').val("");

            $('#po_mrn_reff_id ').trigger("reset");

            $(".cust_more_modal").removeClass("disabled-span");

            $('.once_form_submit').attr('disabled', false); // Disable this input.

            $.ajax({

                url : "<?php echo base_url(); ?>Procurement/PurchaseOrder/AddAccess",

                method : "POST",

                success:function(data)
                {

                    var data = JSON.parse(data);

                    if(data.status === 0){
                    
                        alertify.error(data.msg).delay(3).dismissOthers();

                    }
                    else{

                        $('#AddPurchaseOrder').modal('show');

                    }
                    

                }

            });

            $.ajax({

                url : "<?php echo base_url(); ?>Procurement/PurchaseOrder/FetchReference",

                method : "GET",

                success:function(data)
                {
                    //var data = JSON.parse(data);

                    //console.log(data);
              
                    
                    $('#po_id').val(data);

                    
                        $.ajax({

                            url : "<?php echo base_url(); ?>Procurement/PurchaseOrder/FetchMR",

                            method : "GET",

                            success:function(data)
                            {
                                var data = JSON.parse(data);
                               
                                $('#po_mrn_reff_id').html(data.mrn);

                                console.log(data.mrn);

                            }

                        });

                    /*$('#po_mrn_reff_id').html(data.mrn);

                    console.log(data.mrn);*/

                }
                
            });

        });

        /*####*/


        /*customer droup drown search*/
        $(".select_vendor").select2({
            placeholder: "Select Vendor Name",
            theme : "default form-control- customer_width",
            dropdownParent: $('#AddPurchaseOrder'),
            ajax: {
                url: "<?= base_url(); ?>Procurement/PurchaseOrder/FetchTypes",
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
                    //NO NEED TO PARSE DATA `processResults` automatically parse it
                    //var c = JSON.parse(data);
                    //console.log(data);
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



        /*fetch data by vendor name*/
        
        $("body").on('change', '.add_vendor', function(){ 
	        
            var id = $(this).val();

            if(id!=null){

                $.ajax({
    
                    url : "<?php echo base_url(); ?>Procurement/PurchaseOrder/vendorFetch",
    
                    method : "POST",
    
                    data: {ID: id},
    
                    success:function(data)
                    {   
                        var data = JSON.parse(data);
                    
                        $('.add_payment_term').val(data.payment_term)

                        $('.add_contact_person').html(data.condact_data)
                    
                    }
    
    
                });
            }
 
 
 
        });
 
        /*Time Frame section end*/


        /*add selected product*/


        $("body").on('click', '.cust_more_modal', function()
        { 
            if(!$("#add_po_form").valid())
            {
                alertify.error('Fill required fields!').delay(3).dismissOthers();
                return false;
            }

            if($('#add_po_form').attr('data-submit')=='false')
            {

             $('#add_po_form').submit();

                if(!$("#add_po_form").valid())
                {
                alertify.error('Fill required fields!').delay(3).dismissOthers();
                return false;
                }

            }

            var formData = new FormData($('#add_po_form')[0]);
            var image = $('.image_file').prop('files')[0]; // Get the file from input field
            formData.append('image', image); // Append the file to FormData object

            $(".cust_more_modal").addClass("disabled-span");

            $.ajax({
                        url: "<?php echo base_url(); ?>Procurement/PurchaseOrder/Add",
                        method: "POST",
                        data: formData,
                        processData: false, // Don't process the data
                        contentType: false, // Don't set content type
                        success: function(data) 
                        {

                            var data = JSON.parse(data);

                            var mrn_reff_id = data.mrn_reff_id;

                            var purchase_id = data.purchase_id;

                           $('.hidden_purchase_id').val(purchase_id);
  
                            $('#SelectProduct').modal('show');

                            $('#AddPurchaseOrder').modal('hide');

                            $.ajax({

                                url : "<?php echo base_url(); ?>Procurement/PurchaseOrder/FetchProduct",

                                method : "POST",

                                data: {ID: mrn_reff_id},
                                
                                success:function(data)
                                {   
                                    var data = JSON.parse(data);
                                    
                                    $(".select_prod_add").html(data.product_details);
                                   
                                }   

                            });
 
                        }
                    });

        });


        /*#######*/


        /*prod modal submit start*/

        $("body").on('click', '.prod_modal_submit', function(){ 

            var selectId = $('#select_prod_id').val();

            checked = $("input[type=checkbox]:checked").length;

            if(!checked) {
                alert("You must check at least one checkbox.");
                return false;
            }

            $.ajax({

                url : "<?php echo base_url(); ?>Procurement/PurchaseOrder/SelectedProduct",

                method : "POST",

                data: {ID: selectId},

                success:function(data)
                {
                    var data = JSON.parse(data);
                    
                    $('.product-more2').html(data.product_detail);

                    $('#SelectProduct').modal("hide");

                    $('#AddPurchaseOrder').modal("show");

                    $('.selected_table').show();
                    
                    checkedIds.length = 0; 

                    $('#add_po_form').attr('data_fill','true');

                }

            });
            
        });


        /*prod modal submit end*/

        /*calculation section start*/

	    $("body").on('keyup', '.add_discount, .add_prod_qty, .add_prod_rate', function(){ 

            var $discountSelect = $(this);

            var discount = parseInt($discountSelect.closest('.add_prod_row').find('.add_discount').val())||0;

            var $discountSelectElement = $discountSelect.closest('.add_prod_row').find('.add_prod_rate');

            var rate = $discountSelectElement.val();

            var $quantitySelectElement = $discountSelect.closest('.add_prod_row').find('.add_prod_qty');

            var quantity = parseInt($quantitySelectElement.val())||0;

            var $totalqtySelectElement = $discountSelect.closest('.add_prod_row').find('.check_total_qty');

            var total_qty = parseInt($totalqtySelectElement.val())||0;

            var $deliveredqtySelectElement = $discountSelect.closest('.add_prod_row').find('.check_delivered_qty');

            var delivered_qty = parseInt($deliveredqtySelectElement.val())||0;

            var parsedRate = parseFloat(rate);

            var parsedQuantity = quantity; 

            var multipliedTotal = parsedRate * parsedQuantity;

            var per_amount = (discount/100)*multipliedTotal;

            var orginalPrice = multipliedTotal - per_amount;

            var orginalPrice = orginalPrice.toFixed(2); //For showing 1000.00 instead of 1000 if no decimal present

            var $amountElement = $discountSelect.closest('.add_prod_row').find('.add_prod_amount');

            $amountElement.val(orginalPrice);

            var current_qty = total_qty -  delivered_qty;

           

            if(quantity > current_qty)
            {   
                

                var currencyNull = $quantitySelectElement.val("");

                var $currencyNullElement = $discountSelect.closest('.add_prod_row').find('.add_prod_qty');

                $currencyNullElement.val(currencyNull);  

                alertify.error('Quantity should not be greater than ' + current_qty).delay(3).dismissOthers();
                
                

            }


            TotalAmount();

        });


        function TotalAmount()
        {

            var total= 0;

            $('body .add_prod_amount').each(function()
            {
                var sub_tot = parseFloat($(this).val());

                total += parseFloat(sub_tot.toFixed(2))||0;
               
            });

           total = total.toFixed(2);

           $('.amount_total').val(total);

          
            

        }
		

        /*####*/


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


        /*modal close section start*/

        $("body").on('click', '.vendor_con_close', function(){
           
          $('#AddNewContact').modal("hide");

          $('#AddVendor').modal("hide");

          $('#AddPurchaseOrder').modal("show")
           
         
        });


        /*modal close section end*/






        /*view section start*/

        $("body").on('click', '.view_btn', function(){ 

            var id = $(this).data('id');

            $.ajax({

                url : "<?php echo base_url(); ?>Procurement/PurchaseOrder/View",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {
                
                    var data = JSON.parse(data);
                                    
                    $('.view_ref').val(data.reffer_no);

                    $('.view_date').val(data.date);

                    $('.view_vendor_name').val(data.vendor_name);

                    $('.view_contact_person').val(data.contact_person);

                    $('.view_mrn_ref').val(data.mrn_reff);

                    $('.view_payment_term').val(data.payment_term);

                    $('.view_delivery_date').val(data.delivery_date);

                    $('.view_vendor_ref').val(data.vendor_ref);

                    $('.view_total_prod').val(data.total_amount);

                    $('.view_prod_data').html(data.sales_order);

                    $('.view_image_table').html(data.image_table)

                    $('#ViewModal').modal("show");
                    
                }

            });

        });


        /*view section end*/





        /*edit section start*/

        $("body").on('click', '.edit_btn', function(){ 

            var id = $(this).data('id');

            $.ajax({

                url : "<?php echo base_url(); ?>Procurement/PurchaseOrder/Edit",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {
                
                    var data = JSON.parse(data);

                    if(data.status === 0){

                        alertify.error(data.msg).delay(3).dismissOthers();

                    }else{

                        $('.edit_reff').val(data.reffer_no);

                        $('.edit_date').val(data.date);

                        $('.edit_vendor').html(data.vendor_name);

                        $('.edit_contact').html(data.contact_person);

                        $('.edit_mrn_ref').val(data.material_req);

                        $('.edit_payment_term').val(data.payment_term);

                        $('.edit_delivery_date').val(data.delivery_date);

                        $('.edit_vendor_ref').val(data.vendor_ref);

                        $('.edit_mrn_reff_id').val(data.mrn_reff_id);

                        $('.edit_purchase_id').val(data.purchase_id);

                        $('.edit_total_prod').val(data.po_amount);

                        $('.edit_image_table').html(data.image_table);

                        $('.edit_products').html(data.sales_order)

                        $('.add_more_class').html(data.add_more);

                        $('#EditModal').modal("show");


                    }
                                    
                    
  
                }

            });

        });


        $("body").on('click', '.edit_prod_btn', function(){ 

            var id = $(this).data('id');

            $.ajax({

                url : "<?php echo base_url(); ?>Procurement/PurchaseOrder/EditSingleProd",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {
                
                    var data = JSON.parse(data);
                                    
                    $('.edit_single_prod').html(data.sales_order);

                    $('#EditProdModal').modal("show");

                    $('#EditModal').modal("hide");

                    

                }

            });

           

        });




        $('.close_single_prod').click(function(){

          $('#EditModal').modal('show');   

        });


       

       


        /*single product calculation start*/

        $("body").on('keyup', '.edit_prod_discount, .edit_prod_qty, .edit_prod_rate', function(){ 

            var $discountSelect = $(this);

            var discount = parseInt($discountSelect.closest('.edit_single_prod_row').find('.edit_prod_discount').val())||0;

            var $discountSelectElement = $discountSelect.closest('.edit_single_prod_row').find('.edit_prod_rate');

            var rate = $discountSelectElement.val();

            var $quantitySelectElement = $discountSelect.closest('.edit_single_prod_row').find('.edit_prod_qty');

            var quantity = parseInt($quantitySelectElement.val())||0;

            var $totalqtySelectElement = $discountSelect.closest('.edit_single_prod_row').find('.edit_total_qty');

            var total_qty = parseInt($totalqtySelectElement.val())||0;

            var $deliveredqtySelectElement = $discountSelect.closest('.edit_single_prod_row').find('.edit_delivered_qty');

            var delivered_qty = parseInt($deliveredqtySelectElement.val())||0;

            var $actqtySelectElement = $discountSelect.closest('.edit_single_prod_row').find('.edit_actual_qty');

            var act_qty = parseInt($actqtySelectElement.val())||0;

            var parsedRate = parseFloat(rate);

            var parsedQuantity = quantity; 

            var multipliedTotal = parsedRate * parsedQuantity;

            var per_amount = (discount/100)*multipliedTotal;

            var orginalPrice = multipliedTotal - per_amount;

            var orginalPrice = orginalPrice.toFixed(2); 

            var $amountElement = $discountSelect.closest('.edit_single_prod_row').find('.edit_prod_amount');

            $amountElement.val(orginalPrice);

            if(act_qty === delivered_qty){
               
                current_qty =  total_qty;

            }
            else{
               
                var qty =  delivered_qty - act_qty;
                                
                var current_qty = total_qty -  qty;             

               
            }


           

            if(quantity > current_qty)
            {   
               
                var $currencyNullElement = $discountSelect.closest('.edit_single_prod_row').find('.edit_prod_qty');

                $currencyNullElement.val("");  

                alertify.error('Quantity should not be greater than ' + current_qty).delay(3).dismissOthers();
             
            }


        });


       


        /*single product calculation end*/



        
        /*fetch contact by vendor start*/

        $("body").on('change', '.edit_vendor', function(){ 

            var id = $(this).val();

            $.ajax({

                url : "<?php echo base_url(); ?>Procurement/PurchaseOrder/vendorFetch",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {
                
                    var data = JSON.parse(data);
                                    
                    $('.edit_contact').html(data.condact_data);

                    $('.edit_payment_term').val(data.payment_term);

                }

            });

        })


        /*fetch contact by vendor end*/


        /*update form start*/
        $(function() {

            var form = $('#edit_modal_form');
            
            form.validate({
                rules: {
                    required: 'required',
                },
                messages: {
                    required: 'This field is required',
                },
                errorPlacement: function(error, element) {} , // To Hide Validation Messages
                submitHandler: function(currentForm) {

                    var formData = new FormData(currentForm);

                    // Submit the form for the current tab
                    $.ajax({
                        url: "<?php echo base_url(); ?>Procurement/PurchaseOrder/Update",
                        method: "POST",
                        data: formData,
                        processData: false, // Don't process the data
                        contentType: false, // Don't set content type
                        success: function(data) {
                            
                            $('#EditModal').modal('hide');
                        
                            alertify.success('Data Added Successfully').delay(3).dismissOthers();
                        
                            datatable.ajax.reload(null, false);

                            
                            
                        }
                    });

                   
                }
            });
        });


        /*#####*/


        /*update single prod  start*/


        $(function() {

            var form = $('#update_single_prod');


            form.validate({
                rules: {
                    required: 'required',
                },
                messages: {
                    required: 'This field is required',
                },
                errorPlacement: function(error, element) {} , // To Hide Validation Messages
                submitHandler: function(currentForm) {

                    var formData = new FormData(currentForm);

                    // Submit the form for the current tab
                    $.ajax({
                        url: "<?php echo base_url(); ?>Procurement/PurchaseOrder/UpdateSingleProd",
                        method: "POST",
                        data: formData,
                        processData: false, // Don't process the data
                        contentType: false, // Don't set content type
                        success: function(data) {
                            
                            $('#EditProdModal').modal('hide');
                        
                            alertify.success('Data Update Successfully').delay(3).dismissOthers();
                        
                            datatable.ajax.reload(null, false);

                            
                            
                        }
                    });

                
                }
            });
        });


        /*update single prod end*/



        /*delete section start*/

        $("body").on('click', '.sales_delete', function(){ 

            var id = $(this).data('id'); 

            var rowToDelete = $(this).closest('tr');

            $.ajax({

                url : "<?php echo base_url(); ?>Procurement/PurchaseOrder/DeleteSales",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {   
                    var data = JSON.parse(data);

                    /*if(data.status == "true")
                    {
                        $('#EditModal').modal('hide');
                    }*/

                    $('.edit_total_prod').val(data.total_amount);

                    rowToDelete.fadeOut(500, function() {
                       
                        $(this).remove();

                        deleteSlno();
                       
                        alertify.success('Data Delete Successfully').delay(3).dismissOthers();
                        
                        if(data.status === "true")
                        {
                            $('#EditModal').modal('hide');
                        }

                        datatable.ajax.reload(null,false);
                    }); 

                    
                   

                }

            });

        });


        function deleteSlno()
	    {
          
		    var pp =1;

            $('body.edit_product_row').each(function() {

                $(this).find('.delete_sino').html('<td class="delete_sino">' + pp + '</td>');

                pp++;
                
            });

          
        }


        /*delete section end*/





        /*edit section end*/



        /*delete section start*/

        $("body").on('click', '.delete_btn', function(){ 
            
            if (!confirm('Are you absolutely sure you want to delete?')) return false;
            
            var id = $(this).data('id'); 

            var rowToDelete = $(this).closest('tr');

            $.ajax({

                url : "<?php echo base_url(); ?>Procurement/PurchaseOrder/Delete",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {   
                    var data = JSON.parse(data);

                    if(data.status == 1)
		            {
			            rowToDelete.fadeOut(500, function() {
                            $(this).remove();
                            alertify.success(data.msg).delay(3).dismissOthers();
                            datatable.ajax.reload(null,false);
                        });
                        
                        
		            }
                    else
                    {
                        alertify.error(data.msg).delay(3).dismissOthers();
                    }
                   

                    
                        

                }

            });

        });





        /*delete section end*/





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


        $(document).ajaxSend(function(event, jqXHR, ajaxSettings) {
            if ((!isDataTableRequest(ajaxSettings)) && (!isSelect2Request(ajaxSettings)) && (!isSelect2Search(ajaxSettings))) {
                $("#overlay").fadeIn(300);
            }
        });


        $(document).ajaxComplete(function(event, jqXHR, ajaxSettings) {
            if ((!isDataTableRequest(ajaxSettings)) && (!isSelect2Request(ajaxSettings)) && (!isSelect2Search(ajaxSettings))) {
                $("#overlay").fadeOut(300);
            }
        });



        $(document).ajaxError(function() {
            if(!isSelect2Request)
            {   
                alertify.error('Something went wrong. Please try again later').delay(3).dismissOthers();
            }
        });


    });





   


</script>