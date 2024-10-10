<style>
.cust_more_modal {
    
    position: absolute;
    right: 32px;
    top: -16px;
    font-size: 25px;
    color: #ff0000b5;
}
.left_input .row
{
    justify-content: unset;
   
}
.row_align
{
    display: flex;
    align-items: center;
    justify-content: unset !important;
}
.input_length
{
    width: 95% !important;
}
.select2.select2-container{
    width: 95% !important;
}
.disabled-span{
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
                        
                        <!--deliver note  modal content start-->


                        <div class="modal fade" id="DeliverNote"  aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog  modal-xl">
		                        <form  class="Dashboard-form class" id="add_form1" data-salesorder="false">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Deliver Note</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

				                        <div class="modal-body" style=" overflow-y: auto;">

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
                                                                        <input type="text" name="dn_reffer_no" id="dnid" value="<?php echo $delivery_note_id; ?>" class="form-control input_length" required readonly>
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
                                                                        <input type="text" name="dn_date" autocomplete="off" class="form-control datepicker input_length" required>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->

                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2 select_data">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Customer Name</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        

                                                                    <select class="form-select customer_sel customer_id" name="dn_customer"  required>
                                                               
                                                                    </select>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 

                                                            

                                                            <!-- Single Row Start -->
                                                            
                                                            
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Sales Order</label>
                                                                    </div>

                                                                    <div class="col-col-md-8 col-lg-8">
                                                                      
                                                                        <select class="form-select sales_order_add_clz" name="dn_sales_order_num" id="sales_order_add" required>

                                                                            <option value="" selected disabled>Select Sales Order</option>

                                                                        </select>
                                                                        
                                                                    </div>

                                                                    <div class="col-col-md-1 col-lg-1">

                                                                        <span class="add_more_icon cust_more_modal ri-add-box-fill" id="blink"></span>

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
                                                                        <label for="basicInput" class="form-label">LPO Ref</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        
                                                                        <input type="text" name="dn_lpo_reference" class="form-control lpo_ref " required>
                                                                    
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
                                                                        
                                                                       <select class="form-select cont_person" name="dn_conact_person" id="" required></select>
                                                                       
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### -->

                                                            


                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Payment Terms</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="dn_payment_terms" class="form-control payment_term_clz" required>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                         

                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Project</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="dn_project"  class="form-control project_clz" required>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 

                                                            <input type="hidden" class="hidden_delivery_id" name="dn_id">


                                                             



                                                        </div>

                                                    </div>
                                                                                          

                                                </div>


                                                <!--table section start-->
                                                <div class="mt-4">
                                                    <table class="table table-bordered table-striped delTable selected_table" style="display:none;">
                                                        <thead class="travelerinfo contact_tbody">
                                                            <tr>
                                                                <td>Serial No.</td>
                                                                <td>Product Description</td>
                                                                <td>Unit</td>
                                                                <td>Order Qty</td>
                                                                <td>Delivered Qty</td>
                                                                <td>Current Delivery</td>
                                                               
                                                            </tr>
                                                            
                                                           
                                                        </thead>
                                                        
                                                        <tbody  class="travelerinfo product-more2"></tbody>
                                                        
                                                    </table>
                                                </div>



                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        
                                                        <div class="row row_align mb-4">
                                                            <div class="col-lg-2">
                                                                <label for="basicInput" class="form-label">Attach</label>
                                                            </div>

                                                            <div class="col-lg-4">
                                                                <input type="file" name="dn_file" Class="image_file"  class="form-control">
                                                            </div>

                                                        </div>

                                                        
                                                    </div>
                                                    <div class="col-lg-6"></div>
                                                    <!---<div class="col-lg-6">
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

                                                    </div>--->
                                                </div>

                                                <!--table section end-->


                                            </div>  
                                            
                                           
					                           
						                    
				                        </div>


                                        <div class="modal-footer justify-content-center">
                                            <button class="btn btn btn-success once_form_submit" type="submit">Save</button>
                                            <span class="print_btn_clz once_form_submit" ><button class="btn btn btn-success"  name="print_btn" type="submit" value="1">Print</button></span>
                                        </div>



                                        
			                        </div>
		                        </form>

	                        </div>
                        </div>

                        
                        

                        <!--deliver note modal content end-->



                        <!--delivery view modal start-->


                        <div class="modal fade" id="ViewDeliverNote" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Deliver Note</h5>
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
                                                                        <label for="basicInput" class="form-label">Customer Name</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                    
                                                                     <input type="text" name="" class="form-control view_customer" readonly>
                                                               
                                                                    </select>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 

                                                            

                                                            <!-- Single Row Start -->
                                                            
                                                            
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Sales Order </label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                      
                                                                        <input type="text" name="" class="form-control view_sales" readonly>
                                                                        
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
                                                                        <label for="basicInput" class="form-label">LPO Ref</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        
                                                                        <input type="text" name="" class="form-control view_lpo" readonly>
                                                                    
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
                                                                       
                                                                       <input type="text" name="" class="form-control view_contact" readonly>
                                                                       
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### -->

                                                            


                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Payment Terms</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="" class="form-control view_payment" readonly>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                         

                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Project</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name=""  class="form-control view_project" readonly>
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
                                                                <td>Product Description</td>
                                                                <td>Unit</td>
                                                                <td>Order Qty</td>
                                                                <td>Delivered Qty</td>
                                                               
                                                                
                                                            </tr>
                                                            
                                                           
                                                        </thead>
                                                        
                                                        <tbody  class="travelerinfo view_prod_data"></tbody>
                                                        
                                                    </table>
                                                </div>



                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        
                                                        <div class="card-body view_image_table" style="float: inline-start;"></div>

                                                        
                                                    </div>
                                                    <div class="col-lg-6"></div>
                                                    <!---<div class="col-lg-6">
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

                                                    </div>--->
                                                </div>

                                                <!--table section end-->


                                            </div>  
                                            
                                            
                                             


					                           
						                    
				                        </div>


                                        
			                        </div>
		                        </form>

	                        </div>
                        </div>




                        <!--delivery view modal end-->




                        <!--delivery edit modal start-->

                        <div class="modal fade" id="EditDeliveryNote" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="edit_delivery_note">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Deliver Note</h5>
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
                                                                        <input type="text" name="dn_reffer_no" id="" class="form-control edit_reff"  readonly>
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
                                                                        <input type="text" name="dn_date" class="form-control datepicker edit_date" required>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->

                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Customer Name</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        

                                                                    <select class="form-select edit_customer" name="dn_customer"  required>
                                                               
                                                                    </select>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 

                                                            

                                                            <!-- Single Row Start -->
                                                            
                                                            
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Sales Order <!--<span class="add_more_icon cust_more_modal">Select</span>--></label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                      
                                                                       
                                                                        <input type="text" name="dn_sales_order_num" class="form-control  edit_sales_order" readonly>
                                                                        <input type="hidden" class="edit_sales_order_id">
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
                                                                        <label for="basicInput" class="form-label">LPO Ref</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        
                                                                        <input type="text" name="dn_lpo_reference" class="form-control edit_lpo_ref" required>
                                                                    
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
                                                                        
                                                                       <select class="form-select edit_contact_person" name="dn_conact_person" id="" required></select>
                                                                       
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### -->

                                                            


                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Payment Terms</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="dn_payment_terms" class="form-control edit_payment_term" required>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                         

                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Project</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="dn_project"  class="form-control edit_project" required>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 

                                                            <input type="hidden" class="edit_delivery_id" name="dn_id">


                                                             



                                                        </div>

                                                    </div>
                                                                                          

                                                </div>


                                                <!--table section start-->
                                                <div class="mt-4">
                                                    <table class="table table-bordered table-striped delTable selected_table">
                                                        <thead class="travelerinfo contact_tbody">
                                                            <tr>
                                                                <td>Serial No.</td>
                                                                <td>Product Description</td>
                                                                <td>Unit</td>
                                                                <td>Order Qty</td>
                                                                <td>Delivered Qty</td>
                                                                <td>Action</td>

                                                            </tr>
                                                            
                                                           
                                                        </thead>
                                                        
                                                        <tbody  class="travelerinfo edit_product_table"></tbody>

                                                        <tbody class="add_more_class"></tbody>        
                                                        
                                                    </table>
                                                </div>



                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        
                                                        <div class="card-body edit_image_table" style="float: inline-start;"></div>

                                                        
                                                    </div>
                                                    <div class="col-lg-6">
                                                   
                       
                                                    </div>
                                                    <!---<div class="col-lg-6">
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

                                                    </div>--->
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


                        <!--delivery edit modal end-->



                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">Delivery Note</h4>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#DeliverNote" class="btn btn-primary py-1 add_model_btn">Add</button>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <table id="DataTable" class="table table-bordered table-striped delTable display dataTable">
                                            <thead>
                                                <tr>
                                                    <th class="no-sort">Sl no</th>
                                                    <th>Delivery Note No</th>
                                                    <th>Date</th>
                                                    <th>Customer</th>
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
                    <span class="btn btn btn-success prod_modal_submit">Save</span>

                </div>




                                        
			</div>
		</form>

	</div>

</div>



<!--select  modal section end-->


<!--edit select modal section start-->

<div class="modal fade" id="EditSelectProduct" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<form  class="Dashboard-form class" id="edit_select_prod_form">
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
                                        <td>Order Qty</td>
                                        <td>Delivered Qty</td>
                                        <td>Current Delivery</td>
                                        <td>Tick</td>
                                    </tr>
                                                            
                                                           
                                </thead>
                                                        
                                <tbody  class="travelerinfo edit_select_prod_add"></tbody>


                            </table>
                            
                        </div>




                    </div>  
                                            
                                            
                </div>

                <div class="modal-footer justify-content-center">
                    
                    <!--<input type="hidden" id="edit_select_prod_id" name="edit_select_prod_id" value="">--->                                
                    <button class="btn btn btn-success">Save</button>

                </div>




                                        
			</div>
		</form>

	</div>

</div>

<!--edit select  modal section end-->




<script>

    document.addEventListener("DOMContentLoaded", function(event) { 
    
        /*add section*/    
        $(function() {
            var form = $('#add_form1');

            form.validate({
                rules: {
                    required: 'required',
                },
                messages: {
                    required: 'This field is required',
                },
                errorPlacement: function(error, element) {} ,
                submitHandler: function(currentForm) {

                    // Submit the form for the current tab
                    var formData = new FormData(currentForm);
                    if($('#add_form1').attr('data-salesorder')=="true")
                    {
                      
                        $.ajax({
                            url: "<?php echo base_url(); ?>Crm/DeliverNote/Add",
                            method: "POST",
                            data: formData,
                            processData: false, // Don't process the data
                            contentType: false, // Don't set content type
                        // data: $(currentForm).serialize(),
                            success: function(data) {
                                
                                var data = JSON.parse(data);

                                $('#add_form1')[0].reset();

                            // $('.delivery_note_remove').remove();
                            
                                $('body').find('.delivery_note_remove').remove();

                                $('.prod_checkmark').prop('checked', false); // Unchecks it

                                $('.sales_order_add_clz').val('').trigger('change');

                                $('.cont_person').val('').trigger('change');

                                $('.customer_id').val('').trigger('change');

                                $('.hidden_delivery_id').val("");
                            
                                $('#DeliverNote').modal('hide');

                                alertify.success('Data Added Successfully').delay(3).dismissOthers();

                                datatable.ajax.reload(null, false);

                                $('.modal-backdrop').remove();

                                //console.log(data.print);

                                if(data.print!="")
                                {
                                    window.open(data.print, '_blank');
                                }
                        
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




      

        /*data table start*/ 

        function initializeDataTable() {

            datatable = $('#DataTable').DataTable({
            'stateSave': true,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': 
            {
                'url': "<?php echo base_url(); ?>Crm/DeliverNote/FetchData",
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
                { data: 'dn_id' },
                { data: 'dn_reffer_no' },
                { data: 'dn_date'},
                { data: 'dn_customer'},
                { data: 'action'},
                
               ],

               "initComplete": function () {

                    var dataId = '<?php echo isset($_GET['view_so']) ? $_GET['view_so'] : ''; ?>';

                    $('#DataTable').dataTable().fnFilter(dataId);

                },

                "drawCallback": function() {

                $('.view_btn[data-id="<?php echo isset($_GET['view_so']) ? $_GET['view_so'] : ''; ?>"]').trigger('click');

                }
    
            });
        }

        $(document).ready(function () {
            initializeDataTable();
        });
        /*###*/


        $("body").on('change', '.customer_id', function(){ 

            var id = $(this).val();
            
            //Fetch Contact Person
            $.ajax({

                url : "<?php echo base_url(); ?>Crm/DeliverNote/SalesOrder",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {   
                    var data = JSON.parse(data);

                    $(".sales_order_add_clz").html(data.sales_order);

                    $(".cont_person").html(data.contact_person);

                    $(".payment_term_clz").val(data.payment_term);

                    $(".payment_term_clz").removeClass("error")
                   
                }


            });



        });

        /* Select 2 Remove Validation On Change */
        $("select[name=dn_customer]").on("change",function(e) {
            $(this).parent().find(".error").removeClass("error");         
        });
        /*###*/

        /**/
        $("body").on('change', '.sales_order_add_clz', function(){ 

            $('.delivery_note_remove').remove();

            var id = $(this).val();

            var cust_id = $('.customer_id').val();

           
            //Fetch Contact Person
            $.ajax({

                url : "<?php echo base_url(); ?>Crm/DeliverNote/FetchSalesData",

                method : "POST",

                data: {ID: id,
                       custID : cust_id,
                },
                

                success:function(data)
                {   
                    var data = JSON.parse(data);
                     
                    $(".lpo_ref").val(data.so_lpo);

                    $(".cont_person").html(data.contact_person);

                    $(".project_clz").val(data.so_project);

                     
                    if(data.so_lpo!=null)
                    {
                        $('.lpo_ref').removeClass("error");
                    }
                    
                    if(data.contact_person!=null)
                    {
                        $('.cont_person').removeClass("error");
                    }
                    
                    if(data.so_project!=null)
                    {
                        $('.project_clz').removeClass("error");
                    }

                    slno();
                  
                }


            });

        });
        /**/



        /*delete*/ 
        $("body").on('click', '.delete_btn', function(){ 
            
            if (!confirm('Are you absolutely sure you want to delete?')) return false;
            var id = $(this).data('id');
            $.ajax({

                url : "<?php echo base_url(); ?>Crm/DeliverNote/Delete",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {   
                    var data = JSON.parse(data);
                    
                    if(data.status === "false")
                    {
                        alertify.error('Delivery Note Cannot Be Deleted').delay(2).dismissOthers();
                    }
                    else
                    {
                        alertify.success('Data Deleted Successfully').delay(2).dismissOthers();

                        datatable.ajax.reload(null,false);
                    }
                   
                }


            });

        });
        /*###*/


        /*customer droup drown search*/
        $(".customer_sel").select2({
            placeholder: "Select Customer",
            theme : "default form-control- input_length",
            dropdownParent: $('.select_data'),
            ajax: {
                url: "<?= base_url(); ?>Crm/DeliverNote/FetchCustomers",
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
                    //console.log(data);
                    //  NO NEED TO PARSE DATA `processResults` automatically parse it
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



     

        /*product section start*/

        var max_fieldspp      = 30;

        var pp = 1;

        $("body").on('click', '.add_product2', function(){
          
            var pp = $('.prod_row').length
        
            if(pp < max_fieldspp){ 
            
                pp++;
                
                $(".product-more2").append("<tr class='prod_row'><td class='si_no'>"+pp+"</td><td style='width:20%'><select class='form-select add_prod' name='dpd_prod_det[]' required=''><option value='' selected disabled>Select Product Description</option><?php foreach($products as $prod){?><option value='<?php echo $prod->product_id;?>'><?php echo $prod->product_details;?></option><?php } ?></select></td><td><input type='text' name='dpd_unit[]' class='form-control ' required=''></td><td><input type='number' name='dpd_order_qty[]' class='form-control order_qty' required=''></td><td><input type='number' name='dpd_delivery_qty[]' class='form-control delivery_qty' required=''></td><td><input type='number' name='dpd_current_qty[]' class='form-control current_delivery' required=''></td><td class='remove-btnpp' colspan='6'><div class='remainpass'><i class='ri-close-line'></i>Remove</div></td></tr>");

            }

            slno();

            InitProductSelect2();

        });

        $(document).on("click", ".remove-btnpp", function() 
        {

            $(this).parent().remove();
            slno();
        });

        /**/


        /*serial no correction section start*/

        function slno(){

            var pp =1;

            $('body .prod_row').each(function() {

                $(this).find('.si_no').html('<td class="si_no">' + pp + '</td>');

                pp++;
            });

        }

        /*###*/



        /*product detail calculation*/


        /*limit quantity start*/


        $("body").on('keyup', '.delivery_qty , .current_delivery', function(){ 

            var dataSelect = $(this);

            var deliverySelectElement = dataSelect.closest('.prod_row').find('.delivery_qty');
            
            var delivery = parseFloat(deliverySelectElement.val()) || 0; // Convert to number, default to 0 if NaN

            var currentSelectElement = dataSelect.closest('.prod_row').find('.current_delivery');

            var current = parseFloat(currentSelectElement.val()) || 0; // Convert to number, default to 0 if NaN

            /**/

            var ratetSelectElement = dataSelect.closest('.prod_row').find('.rate_clz_id');

            var rate = parseFloat(ratetSelectElement.val()) || 0; // Convert to number, default to 0 if NaN
                 
            var orginalPrice = current *  rate;

            var orginalPrice = orginalPrice.toFixed(2); //For showing 1000.00 instead of 1000 if no decimal present
            
            var $amountElement = dataSelect.closest('.prod_row').find('.del_product_total');

            $amountElement.val(orginalPrice);

            /**/

            var total = delivery + current;

            var orderSelectElement = dataSelect.closest('.prod_row').find('.order_qty');

            var order = orderSelectElement.val();


           

            if(total > order)
            {   
               
                var currencyNull = currentSelectElement.val("");

                var $currencyNullElement = dataSelect.closest('.prod_row').find('.current_delivery');

                $currencyNullElement.val(currencyNull);  

                alertify.error('Delivery Qty + Current Delivery Should Not Exceed The Order Qty').delay(3).dismissOthers();
                
                

            }
            
            TotalAmount();
           

        });


        /*limit quantity end*/


        /*total amount calculation start*/

        function TotalAmount()
        {

            var total= 0;

            $('body .del_product_total').each(function()
            {
                var sub_tot = parseFloat($(this).val());

                total += parseFloat(sub_tot.toFixed(2))||0;
               
            });

           total = total.toFixed(2);

           $('.total_prod_amount').val(total);

           
            

        }

        /*total amount calculation end*/



        /* Product Init Select 2 */


        function InitProductSelect2(){

            $(".add_prod:last").select2({
                placeholder: "Select Product",
                theme : "default form-control-",
                dropdownParent: $($('.add_prod:last').closest('.prod_row')),
                ajax: {
                    url: "<?= base_url(); ?>Crm/DeliverNote/FetchProducts",
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

        InitProductSelect2();


        /* ### */


       
        


        /*add selected product*/


        $("body").on('click', '.cust_more_modal', function()
        { 
            if(!$("#add_form1").valid())
            {
                alertify.error('Fill required fields!').delay(3).dismissOthers();
                return false;
            }

            if($('#add_form1').attr('data-submit')=='false')
            {

             $('#add_form1').submit();

                if(!$("#add_form1").valid())
                {
                    alertify.error('Fill required fields!').delay(3).dismissOthers();
                    return false;
                }

            }

            var formData = new FormData($('#add_form1')[0]);
            var image = $('.image_file').prop('files')[0]; // Get the file from input field
            formData.append('image', image); // Append the file to FormData object

            $(".cust_more_modal").addClass("disabled-span");

            $.ajax({
                        url: "<?php echo base_url(); ?>Crm/DeliverNote/Add",
                        method: "POST",
                        data: formData,
                        processData: false, // Don't process the data
                        contentType: false, // Don't set content type
                        success: function(data) {

                            var data = JSON.parse(data);

                            var id = data.sales_order;

                            var delivery_id = data.delivery_id;


                           $('.hidden_delivery_id').val(delivery_id);
  
                            $('#SelectProduct').modal('show');

                            $('#DeliverNote').modal('hide');

                            $('#add_form1').attr('data-salesorder','true');

                            $.ajax({

                                url : "<?php echo base_url(); ?>Crm/DeliverNote/AddProduct",

                                method : "POST",

                                data: {ID: id},
                                
                                success:function(data)
                                {   
                                    var data = JSON.parse(data);
                                    
                                    $(".select_prod_add").html(data.product_detail);

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

                url : "<?php echo base_url(); ?>Crm/DeliverNote/SelectedProduct",

                method : "POST",

                data: {ID: selectId},

                success:function(data)
                {
                   
                    var data = JSON.parse(data);
                    
                    //$('body').find('.delivery_note_remove').remove();
                   
                    $('.product-more2').html(data.product_detail);

                    $('#SelectProduct').modal("hide");

                    $('#DeliverNote').modal("show");

                    var modal = new bootstrap.Modal(document.getElementById('DeliverNote'));
                    
                    modal.show();

                    modal.handleUpdate();

                    $('.selected_table').show();

                    $('.print_btn_clz').css('display', 'block');
                      
                    checkedIds.length = 0; 
                    //console.log(data.product_detail);

                    
                }

            });
        });


    /*prod modal submit end*/


    /*reset reffer id*/

    $('.add_model_btn').click(function(){

        $('#add_form1')[0].reset();

        //$('.print_btn_clz').css('display', 'none');

        $('.customer_id').val('').trigger('change');

        $('.sales_order_add_clz  option').remove();

        $('.cont_person  option').remove();

        $('.delivery_note_remove').remove();

        $('.once_form_submit').attr('disabled', false); // Disable this input.

        $('#add_form1').attr('data-salesorder','false')

        $(".cust_more_modal").removeClass("disabled-span");

        $.ajax({

            url : "<?php echo base_url(); ?>Crm/DeliverNote/FetchReference",

            method : "GET",

            success:function(data)
            {

                $('#dnid').val(data);

            }

        });

    });


    /*######*/


    /*view section start*/
    
    $("body").on('click', '.view_btn', function(){ 

        var id = $(this).data('id');

        $('#DeliverNote').modal("hide");

        

        $.ajax({

            url : "<?php echo base_url(); ?>Crm/DeliverNote/View",

            method : "POST",

            data: {ID: id},

            success:function(data)
            {
            
                var data = JSON.parse(data);
                                
                $('.view_ref').val(data.reffer_no);

                $('.view_date').val(data.date);

                $('.view_customer').val(data.customer);

                $('.view_sales').val(data.sales_order);

                $('.view_lpo').val(data.lpo_reff);

                $('.view_contact').val(data.contact_person);

                $('.view_payment').val(data.payment_term);

                $('.view_project').val(data.project);

                $('.view_prod_data').html(data.product_detail);

                $('.view_image_table').html(data.image_table);

                $('#ViewDeliverNote').modal("show");
                
            }

        });

    });

    /*view section en*/


    /*edit section start*/

    $("body").on('click', '.edit_btn', function(){ 

        var id = $(this).data('id');

        

        $.ajax({

            url : "<?php echo base_url(); ?>Crm/DeliverNote/Edit",

            method : "POST",

            data: {ID: id},

            success:function(data)
            {
            
                var data = JSON.parse(data);
                                
                //console.log(data.customer);

                if(data.status === "false")
                {
                    alertify.error('Delivery Note Cant Be Edit').delay(3).dismissOthers();
                
                }
                else
                {
                    
                    $('.edit_reff').val(data.reffer_no);

                    $('.edit_date').val(data.date);

                    $('.edit_customer').html(data.customer);

                    $('.edit_sales_order').val(data.sales_order);

                    $('.edit_lpo_ref').val(data.lpo_reff);

                    $('.edit_contact_person').html(data.contact_person);

                    $('.edit_payment_term').val(data.payment_term);

                    $('.edit_project').val(data.project);

                    $('.edit_delivery_id').val(data.dn_id);

                    $('.edit_product_table').html(data.product_detail);

                    $('.edit_image_table').html(data.image_table);

                    $('.add_more_class').html(data.add_more);

                    $('.edit_sales_order_id').val(data.sales_order_id);

                    $('#EditDeliveryNote').modal("show");

                }

                
            }

        });

    });


    //fetch data by customer
    $("body").on('change', '.edit_customer', function(){ 

        var id = $(this).val();

      //  var delivery_id= $('.edit_delivery_id').val();
        

        $.ajax({

            url : "<?php echo base_url(); ?>Crm/DeliverNote/SalesOrder",

            method : "POST",

            data: {ID: id},

            success:function(data)
            {
            
                var data = JSON.parse(data);

                //$('.edit_sales_order').html(data.orders);

                $('.edit_contact_person').html(data.contact_person);

                $('.edit_payment_term').val(data.payment_term);

                
            }

        });

    });


    /*####*/


    //form update

    $(function() {
            var form = $('#edit_delivery_note');
            
            form.validate({
                rules: {
                    required: 'required',
                },
                messages: {
                    required: 'This field is required',
                },
                errorPlacement: function(error, element) {} ,
                submitHandler: function(currentForm) {
                    var formData = new FormData(currentForm);
                    // Submit the form for the current tab
                    $.ajax({
                        url: "<?php echo base_url(); ?>Crm/DeliverNote/Update",
                        method: "POST",
                        //data: $(currentForm).serialize(),
                        data: formData,
                        processData: false, // Don't process the data
                        contentType: false, // Don't set content type
                        success: function(data) {
                          
                            $('#EditDeliveryNote').modal('hide');

                            alertify.success('Data Update Successfully').delay(3).dismissOthers();
                            datatable.ajax.reload(null, false);
                       
                        }
                    });
                }
            });
        });
        
        
        /*edit product remove start*/
        

        $("body").on('click', '.del_prod_remove', function(){ 

            

            var dataSelect = $(this);

            var deliverySelectElement = dataSelect.closest('.delete_delivery_data').find('.hidden_del_prod_id');

            var prod_id = parseFloat(deliverySelectElement.val()) 
            
           
            var rowToDelete = $(this).closest('tr');

            $.ajax({

                url : "<?php echo base_url(); ?>Crm/DeliverNote/DeleteProduct",

                method : "POST",

                data: {ProdID: prod_id},

                success:function(data)
                {
                    var data = JSON.parse(data);


                    if(data.status === "True")
                    {
                      $('#EditDeliveryNote').modal('hide');

                      datatable.ajax.reload(null,false);
                    }


                    var deliverID = data.delivery_id;

                    $('.add_more_class').html(data.add_more);

                    //$('.edit_btn[data-id="'+deliveryID+'"]').trigger('click');

                    //alertify.success('Data Delete Successfully').delay(3).dismissOthers();

                    rowToDelete.fadeOut(500, function() {
                        $(this).remove();
                        alertify.success('Data Delete Successfully').delay(3).dismissOthers();
                        $('.edit_btn[data-id="'+deliveryID+'"]').trigger('click');



                    }); 
                    
                   
                    
                }

            });

        });


        /*edit product remove end*/


        /*add more product*/


        $("body").on('click', '.add_more_product', function(){ 
             
            var order_id = $('.edit_sales_order_id').val();

            var prod_id = $('.hidden_del_prod_id').val();

            var delivery_id = $('.edit_delivery_id').val();
            
            //alert(prod_id);

            $.ajax({

                url : "<?php echo base_url(); ?>Crm/DeliverNote/EditAddProduct",

                method : "POST",

                data: {orderID: order_id,
                    prodID: prod_id,
                    deliveryID: delivery_id
                },

                success:function(data)
                {   
                    var data = JSON.parse(data);
                    
                    $(".edit_select_prod_add").html(data.product_detail);

                    $('#EditSelectProduct').modal('show');
                    
                    $('#EditDeliveryNote').modal('hide');

                } 

            });

            
        });


        /*####*/


        /*prod modal submit start*/

        /*$("body").on('click', '.edit_prod_modal_submit', function(){ 

            var selectId = $('#edit_select_prod_id').val();

 
            $.ajax({

                url : "<?php echo base_url(); ?>Crm/DeliverNote/UpdatedProduct",

                method : "POST",

                data: {ID: selectId},

                success:function(data)
                {
                
                    
                    
                    
                }

            }); 
        });*/

        /*prod modal submit end*/

        
        /*update product start*/
         
        $(function() {
            var form = $('#edit_select_prod_form');

            //alert("sucess");
            
            form.validate({
                rules: {
                    required: 'required',
                },
                messages: {
                    required: 'This field is required',
                },
                errorPlacement: function(error, element) {} ,
                submitHandler: function(currentForm) {
                    // Submit the form for the current tab
                   
                    $.ajax({
                        url: "<?php echo base_url(); ?>Crm/DeliverNote/UpdatedProduct",
                        method: "POST",
                        data: $(currentForm).serialize(),
                        success: function(data) {

                            var data = JSON.parse(data);

                            var deliveryID = data.delivery_id;


                            $('#edit_select_prod_form')[0].reset();

                            $('#EditSelectProduct').modal('hide');

                            $('.edit_btn[data-id="'+deliveryID+'"]').trigger('click');

                            $('.add_more_class').html(data.add_more);

                           
                       
                        }
                    });
                }
            });
        });

        /*update product end*/



        /*edit limit quantity start*/


        $("body").on('keyup', '.edit_delivery_qty , .edit_current_qty', function(){ 

            var dataSelect = $(this);

            var deliverySelectElement = dataSelect.closest('.edit_select_div').find('.edit_delivery_qty');

            var delivery = parseFloat(deliverySelectElement.val()) || 0; // Convert to number, default to 0 if NaN

            var currentSelectElement = dataSelect.closest('.edit_select_div').find('.edit_current_qty');

            var current = parseFloat(currentSelectElement.val()) || 0; // Convert to number, default to 0 if NaN

            /**/

            var ratetSelectElement = dataSelect.closest('.edit_select_div').find('.edit_prod_rate');

            var rate = parseFloat(ratetSelectElement.val()) || 0;

            var orginalPrice = current *  rate;

            

            var orginalPrice = orginalPrice.toFixed(2); 

            var $amountElement = dataSelect.closest('.edit_select_div').find('.edit_prod_amount');

            $amountElement.val(orginalPrice);
                 
            /**/

            var total = delivery + current;

            var orderSelectElement = dataSelect.closest('.edit_select_div').find('.edit_prod_amount');

            var order = orderSelectElement.val();


            if(total > order)
            {   
            
                var currencyNull = currentSelectElement.val("");

                var $currencyNullElement = dataSelect.closest('.edit_select_div').find('.edit_current_qty');

                $currencyNullElement.val(currencyNull);  

                alertify.error('Delivery Qty + Current Delivery Should Not Exceed The Order Qty').delay(3).dismissOthers();
                
                

            }

            EditTotalAmount();

        });


        /*edit limit quantity end*/


        /*total amount calculation start*/

        function EditTotalAmount()
        {

            var total= 0;

            $('body .edit_prod_amount').each(function()
            {
                var sub_tot = parseFloat($(this).val());

                total += parseFloat(sub_tot.toFixed(2))||0;
               
            });

           total = total.toFixed(2);

           $('.edit_total_prod_amount').val(total);

           
            

        }

        /*total amount calculation end*/

       

    /*edit section end*/

        
        $('.modal').on('hidden.bs.modal', function () {

            $('body').addClass('modal-open');
            
        })

    

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

    // Update modal form function
    /*function updateModalForm() 
    {
        // Update the value of the hidden input in the modal form with the checked IDs
        document.getElementById('select_prod_id').value = checkedIds.join(',');


        // Log the checked IDs in the modal form
        //console.log('Checked IDs in modal: ', checkedIds);
    }*/
    
    function editHandleCheckboxChange(checkbox) 
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
        document.getElementById('edit_select_prod_id').value = checkedIds.join(',');
    }

    /*checkbox section end*/







    


  
    



</script>