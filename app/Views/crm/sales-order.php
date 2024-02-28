<style>

.cust_more_modal
{
        
    position: absolute;
    left: 470px;
    padding: 1px 27px;
    z-index: 999;
    border: 1px solid black;
    border: 1px solid #0000003b;

}
 .contact_more_modal
    {
        position: absolute;
        left: 471px;
        padding: 1px 27px;
        z-index: 999;
        border: 1px solid black;
        border: 1px solid #0000003b;
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
</style>


<div class="tab-content text-muted">
								
    <div class="tab-pane active" id="nav-crm-top-1-1" role="tabpanel">
                    
        <div class="row">
            
            <div class="col-lg-12">
                
                <!-- Tab panes -->
                <div class="tab-content text-muted">
                    <!--product head tab--> 
                    <div class="tab-pane active" id="arrow-1" role="tabpanel">
                        
                        <!--sales order section start-->
                        <div class="modal fade" id="AddSalesOrder" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="add_sales_order_form">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Sales Orders</h5>
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
                                                                        <input type="text" name="so_reffer_no" id="" value="<?php echo $sales_order_id;?>" class="form-control" required readonly>
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
                                                                        <input type="text" name="so_date" id="" class="form-control datepicker" required>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->

                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Customer Name<span class="add_more_icon cust_more_modal">New</span></label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <select class="form-select droup_customer_id" name="so_customer" id="customer_id" style="width:80%;" required>
                                                                            <option value="" selected disabled>Select Customer</option>
                                                                           
                                                                        </select>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 

                                                            

                                                            <!-- Single Row Start -->
                                                            
                                                            
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Quot Ref</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        
                                                                        <select class="form-select quotation_ref" name="so_quotation_ref" id="">
                                                                            <option value="" selected disabled>Quotation Ref</option>
                                                               
                                                                        </select>
                                                                        
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                           
                                                            <!-- ### --> 

                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basiInput" class="form-label">LPO Ref</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="so_lpo" id="qd_quotation_number_id" class="form-control" required>
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
                                                                        <label for="basicInput" class="form-label">Sales Executive</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <select class="form-select enqinput sales_executive_clz" name="so_sales_executive"  required>
                                                                            <option value="" selected disabled>Sales Executive</option>
                                                                            <?php foreach($sales_executive as $sale_exc){?> 
                                                                                <option value="<?php echo $sale_exc->se_id;?>"><?php echo $sale_exc->se_name;?></option>
                                                                            <?php } ?>
                                                                            
                                                                
                                                                        </select>
                                                                       
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Contact Person<span class="add_more_icon contact_more_modal">New</span></label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <select class="form-select contact_person_clz" name="so_contact_person" style="width: 80%;" required>
                                                                            <option value="" selected disabled>Contact Person</option>
                                                                            <!--<?php foreach($contacts as $cont){?> 
                                                                            
                                                                                <option value="<?php echo $cont->contact_id; ?>"><?php echo $cont->contact_person;?></option>
                                                                                
                                                                            <?php } ?>--->
                                                                
                                                                        </select>
                                                                       
                                                                       
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
                                                                        <input type="text" name="so_payment_term"  class="form-control payment_term" required>
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
                                                                      
                                                                        <input type="text" name="so_delivery_term" id="delivery_term" class="form-control datepicker" required>
                                                            
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
                                                                        <input type="text" name="so_project"  class="form-control project" required>
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
                                                                <td>Qty</td>
                                                                <td>Rate</td>
                                                                <td>Discount</td>
                                                                <td>Amount</td>
                                                                <td>Action</td>
                                                            </tr>
                                                            
                                                           
                                                        </thead>
                                                        
                                                        <tbody  class="travelerinfo product-more2"></tbody>
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="8" align="center" class="tecs">
                                                                    <span class="add_icon add_product2"><i class="ri-add-circle-line"></i>Add </span>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="2">Amount in words</td>
                                                                <td colspan="3" class="sales_order_amount_in_word"></td>
                                                                <input type="hidden" name="so_amount_total_in_words" class="sales_order_amount_in_word_val">
                                                                <td>Total</td>
                                                                <td><input type="text" name="so_amount_total" class="amount_total form-control" readonly></td>
                                                            </tr>
                                                            
                                                          
                                                        </tbody>
                                                    </table>
                                                </div>


                                               

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        

                                                        <div class="row row_align mb-4">
                                                            <div class="col-lg-3">
                                                                <label for="basicInput" class="form-label">Attach</label>
                                                            </div>

                                                            <div class="col-lg-4">
                                                                <input type="file" name=""  class="form-control">
                                                            </div>

                                                        </div>


                                                        
                                                    </div>
                                                    <div class="col-lg-6">
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
                                                

                                                <!--table section end-->


                                            </div>  
                                            
                                            
                                             


					                           
						                    
				                        </div>


                                        
			                        </div>
		                        </form>

	                        </div>
                        </div>

                        <!--sales order section end-->



                        <!--sales order edit section start-->

                        <div class="modal fade" id="EditSalesOrder" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="add_sales_order_form">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Sales Orders</h5>
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
                                                                        <input type="text" name="so_reffer_no" id="" value="" class="form-control edit_reff" required readonly>
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
                                                                        <input type="text" name="so_date" id="" class="form-control datepicker edit_date" required>
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
                                                                        <select class="form-select edit_customer" name="so_customer" id="customer_id" required>
                                                                            <option value="" selected disabled>Select Customer</option>
                                                                           
                                                                        </select>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 

                                                            

                                                            <!-- Single Row Start -->
                                                            
                                                            
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Quot Ref</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        
                                                                        <select class="form-select quotation_ref edit_quot" name="so_quotation_ref" id="">
                                                                            <option value="" selected disabled>Quotation Ref</option>
                                                               
                                                                        </select>
                                                                        
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                           
                                                            <!-- ### --> 

                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basiInput" class="form-label">LPO Ref</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="so_lpo" id="qd_quotation_number_id" class="form-control edit_lpo" required>
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
                                                                        <label for="basicInput" class="form-label">Sales Executive</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <select class="form-select enqinput sales_executive_clz edit_executive" name="so_sales_executive"  required>
                                                                            <option value="" selected disabled>Sales Executive</option>
                                                                            <?php foreach($sales_executive as $sale_exc){?> 
                                                                                <option value="<?php echo $sale_exc->se_id;?>"><?php echo $sale_exc->se_name;?></option>
                                                                            <?php } ?>
                                                                            
                                                                
                                                                        </select>
                                                                       
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label edit_contact_person">Contact Person<span class="add_more_icon contact_more_modal">New</span></label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <select class="form-select contact_person_clz" name="so_contact_person" style="width: 80%;" required>
                                                                            <option value="" selected disabled>Contact Person</option>
                                                                            <!--<?php foreach($contacts as $cont){?> 
                                                                            
                                                                                <option value="<?php echo $cont->contact_id; ?>"><?php echo $cont->contact_person;?></option>
                                                                                
                                                                            <?php } ?>--->
                                                                
                                                                        </select>
                                                                       
                                                                       
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### -->

                                                            


                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label edit_payment_term">Payment Term</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="so_payment_term"  class="form-control payment_term" required>
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
                                                                        
                                                                       
                                                                        <input type="text" name="so_delivery_term" id="delivery_term" class="form-control datepicker edit_delivery_date" required>
                                                            
                                                                        
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
                                                                        <input type="text" name="so_project"  class="form-control project edit_project" required>
                                                                    </div>

                                                                </div> 

                                                            </div>   
                                                            
                                                            <input type="hidden" name="" class="edit_so_id">

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
                                                                <td>Qty</td>
                                                                <td>Rate</td>
                                                                <td>Discount</td>
                                                                <td>Amount</td>
                                                                <td>Action</td>
                                                            </tr>
                                                            
                                                           
                                                        </thead>
                                                        
                                                        <tbody  class="travelerinfo"></tbody>
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="8" align="center" class="tecs">
                                                                    <span class="add_icon edit_add_prod"><i class="ri-add-circle-line"></i>Add </span>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="2">Amount in words</td>
                                                                <td colspan="3" class="sales_order_amount_in_word"></td>
                                                                <input type="hidden" name="so_amount_total_in_words" class="sales_order_amount_in_word_val">
                                                                <td>Total</td>
                                                                <td><input type="text" name="so_amount_total" class="amount_total form-control" readonly></td>
                                                            </tr>
                                                            
                                                          
                                                        </tbody>
                                                    </table>
                                                </div>


                                               

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        

                                                        <div class="row row_align mb-4">
                                                            <div class="col-lg-3">
                                                                <label for="basicInput" class="form-label">Attach</label>
                                                            </div>

                                                            <div class="col-lg-4">
                                                                <input type="file" name=""  class="form-control">
                                                            </div>

                                                        </div>


                                                        
                                                    </div>
                                                    <div class="col-lg-6">
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
                                                

                                                <!--table section end-->


                                            </div>  
                                            
                                            
                                             


					                           
						                    
				                        </div>


                                        
			                        </div>
		                        </form>

	                        </div>
                        </div>


                        <!--edit add section start-->

                        
                        <div class="modal fade" id="EditAddProduct" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="edit_add_prod_form">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Product Details</h5>
                                            <button type="button" class="btn-close edit_close_sub_modal" aria-label="Close"></button>
                                        </div>

				                        <div class="modal-body">

                                            <div class="live-preview">
                                                
                                                
                                                <!--table section start-->
                                                <div class="mt-4">
                                                    <table class="table table-bordered table-striped delTable">
                                                        <tbody class="travelerinfo">
                                                            
                                                            <tr>
                                                                <td>Serial No.</td>
                                                                <td>Product Description</td>
                                                                <td>Unit</td>
                                                                <td>Qty</td>
                                                                <td>Rate</td>
                                                                <td>Discount</td>
                                                                <td>Amount</td>
                                                                
                                                            </tr>

                                                            <tr class="edit_prod_row">
                                                                <td style="width: 10%;" class="">1</td>
                                                                <td>
                                                                    <select class="form-select  edit_product_det spd_product_details" name="spd_product_details" required>
                                                                        <option selected>Select Product Description</option>
                                                                       
                                                                    </select>
                                                                </td>

                                                                <td><input type="text"   name="spd_unit" class="form-control" required></td>
                                                                <td><input type="number" name="spd_quantity" class="form-control" required></td>
                                                                <td><input type="number" name="spd_rate" class="form-control" required></td>
                                                                <td><input type="number" name="spd_discount" class="form-control" required></td>
                                                                <td><input type="number" name="spd_amount" class="form-control" required></td>
                                                                
                                                                <input type="hidden" name="spd_id" class="edit_hidden_sales_id">

                                                            </tr>
                                                           
                                                        </tbody>
                                                       
                                                       
                                                    </table>
                                                </div>


                                                <div class="modal-footer justify-content-center">
                                                    
                                                    <button class="btn btn btn-success">Save</button>

                                                </div>

                                                <!--table section end-->


                                            </div>  
                                            
                                            
					                           
						                    
				                        </div>

                                        
			                        </div>
		                        </form>

	                        </div>
                        </div>

                        <!--edit add section end-->



                        <!---###sales order edit section end####-->



                        <!--view sales order start-->


                        <div class="modal fade" id="ViewSalesOrder" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Sales Orders</h5>
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
                                                                        <input type="text" name="so_reffer_no" id="" value="" class="form-control view_reff" required readonly>
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
                                                                        <input type="text" name="so_date" id="" class="form-control view_date" readonly>
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
                                                                        <!--<select class="form-select view_customer" name="so_customer" id="customer_id" readonly>
                                                                            <option value="" selected disabled>Select Customer</option>
                                                                           
                                                                        </select>-->
                                                                        <input type="text" name="so_customer" id="customer_id" class="form-control view_customer" readonly>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 

                                                            

                                                            <!-- Single Row Start -->
                                                            
                                                            
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Quot Ref</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        
                                                                        <!--<select class="form-select quotation_ref view_quot" name="so_quotation_ref" id="" readonly>
                                                                            <option value="" selected disabled>Quotation Ref</option>
                                                               
                                                                        </select>--->

                                                                        <input type="text" name="so_quotation_ref" id="" class="form-control quotation_ref view_quot" readonly>
                                                                        
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                           
                                                            <!-- ### --> 

                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basiInput" class="form-label">LPO Ref</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="so_lpo" id="qd_quotation_number_id" class="form-control view_lpo" readonly>
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
                                                                        <label for="basicInput" class="form-label">Sales Executive</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                       
                                                                        <input type="text" name="so_sales_executive"  class="form-control enqinput sales_executive_clz view_executive" readonly>
                                                                       
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label edit_contact_person">Contact Person</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                       

                                                                        <input type="text" name="so_contact_person"  class="form-control contact_person_clz view_contact_person" readonly>
                                                                       
                                                                       
                                                                       
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### -->

                                                            


                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label edit_payment_term">Payment Term</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="so_payment_term"  class="form-control payment_term view_payment_term" readonly>
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
                                                                        
                                                                       
                                                                        <input type="text" name="so_delivery_term" id="delivery_term" class="form-control datepicker view_delivery_date" readonly>
                                                            
                                                                        
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
                                                                        <input type="text" name="so_project"  class="form-control project view_project" readonly>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                             

                                                        </div>

                                                    </div>
                                                                                          

                                                </div>


                                                <!--attachment section start-->

                                                <div class="card-body">
                                                    <table id="" class="table table-bordered table-striped delTable display dataTable" style="border: 1px solid #9E9E9E;width: 50%">
                                                        <thead>
                                                            <tr>
                                                                
                                                                <th class="cust_img_rgt_border">File Name</th>
                                                                <th class="cust_img_rgt_border">Download</th>
                                                               
                                                            </tr>
                                                        </thead>
                                                
                                                        <tbody>
                                                            <tr>
                                                                <td class="cust_img_rgt_border view_cr_no_att" ></td>
                                                                <td class="cust_img_rgt_border view_est_id_att"></td>
                                                                
                                                            </tr>
                                                        </tbody>

                                                    </table>
                
                                                </div>


                                                <!--#######-->


                                                <!--table section start-->
                                                <div class="mt-4">
                                                    <table class="table table-bordered table-striped delTable">
                                                        <thead class="travelerinfo contact_tbody">
                                                            <tr>
                                                                <td>Serial No.</td>
                                                                <td>Product Description</td>
                                                                <td>Unit</td>
                                                                <td>Qty</td>
                                                                <td>Rate</td>
                                                                <td>Discount</td>
                                                                <td>Amount</td>
                                                               
                                                            </tr>
                                                            
                                                           
                                                        </thead>
                                                        
                                                        <tbody  class="travelerinfo view_product_data"></tbody>
                                                        
                                                       
                                                    </table>
                                                </div>


                                                <!--table section end-->

                                              

                                            </div>  
                                            
                                            
                                             


					                           
						                    
				                        </div>


                                        
			                        </div>
		                        </form>

	                        </div>
                        </div>

                        <!--########-->


                        <!--Customer Creation modal content start-->

                        <?= $this->include('crm/add_modal_customer') ?>
                         

                        <!--Customer Creation content end-->



                        <!--contact detail modal section start-->
                         
                        <?= $this->include('crm/add_contact_person') ?>

                        <!--contact detail modal section end-->


                      
                        <!--second contact detail modal section start-->
                         
                        

                        <!--contact detail modal section end-->


                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">View Sales Order</h4>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#AddSalesOrder" class="btn btn-primary py-1">Add</button>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <table id="DataTable" class="table table-bordered table-striped delTable display dataTable">
                                            <thead>
                                                <tr>
                                                    <th class="no-sort">Sl no</th>
                                                    <th>Sales Order No</th>
                                                    <th>Date</th>
                                                    <th>Customer</th>
                                                    <th>Quotation Ref</th>
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





<script>

    document.addEventListener("DOMContentLoaded", function(event) { 
    
        /*add section*/    
         
        $(function() {
            var form = $('#add_sales_order_form');
            
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
                        url: "<?php echo base_url(); ?>Crm/SalesOrder/Add",
                        method: "POST",
                        data: $(currentForm).serialize(),
                        success: function(data) {
                         
                            $('#add_sales_order_form')[0].reset();
                           
                            $('#SalesOrder').modal('hide');

                            $('#customer_id').val('').trigger('change');

                            $('.quotation_ref').val('').trigger('change');

                            $('.sales_executive_clz').val('').trigger('change');

                            $('.contact_person_clz').val('').trigger('change');

                            $('.sales_remove').remove();

                            alertify.success('Data Added Successfully').delay(3).dismissOthers();
                            datatable.ajax.reload(null, false);
                           
                            
                        }
                    });
                }
            });
        });




        /*product modal submit start*/

        $(function() {
            var form = $('#ProductForm');
            
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
                        url: "<?php echo base_url(); ?>Crm/Products/Add",
                        method: "POST",
                        data: $(currentForm).serialize(),
                        success: function(data) {
                            //$('#add_form')[0].reset();
                            //$('#AddModal').modal('hide');

                            $.ajax({
                                url: "<?php echo base_url(); ?>Crm/SalesOrder/FetchProduct",
                                method: "POST",
                                //data: { key: 'value' },
                                success: function(secondData) {
                                    // Handle the response of the second AJAX call
                                    var secdata = JSON.parse(secondData);
                                    console.log(secdata);
                                    $(".add_prod").html(secdata.product_head_out);
                                }
                            });

                            $('#AddModal').modal('show');
                            $('#ProductModal').modal('hide');
                            alertify.success('Data Added Successfully').delay(3).dismissOthers();
                            datatable.ajax.reload( null, false )
                        }
                    });
                }
            });
        });

        /*product modal submit end*/



        
        /*customer droup drown search*/
        $(".droup_customer_id").select2({
            placeholder: "Select Customer",
            theme : "default form-control- customer_width",
            dropdownParent: $('#AddSalesOrder'),
            ajax: {
                url: "<?= base_url(); ?>Crm/SalesOrder/FetchTypes",
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
                    //NO NEED TO PARSE DATA `processResults` automatically parse it
                    //var c = JSON.parse(data);
                    console.log(data);
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


       


        /*product modal start*/

        $("body").on('click', '.product_modal', function(){ 
	   
            $('#AddModal').modal('hide');

            $('#ProductModal').modal('show');

        });

        /*product modal end*/


       
        //trigger when form is submitted

        $("#add_office_doc").submit(function(e){

            $('#AddSalesOrder').modal('show');

            return false;

        });

        /*#####*/


        


        /*close product modal (open enquiry modal)*/

        $('#ContactDeatils2').on('hidden.bs.modal', function () {

            $('#AddSalesOrder').modal('show')
        })

        /*#####*/


        /*add customer contact person section start*/
         
        $("body").on('click', '.contact_more_modal', function(){ 
	        
            var customer_id = $('#customer_id').val();

            if(customer_id === null)
            {
                
                alertify.success('Please Select Customer').delay(2).dismissOthers();
            
            }
            else{
                
              
                $('#ContactDeatils2').modal('show');

                $('.customer_creation_id2').val(customer_id);

                $('.droup_customer_id').val('').trigger('change');

                $('.contact_person_clz').val('').trigger('change');

            }

        });

     
        /*####*/




        /*customer creation modal show start*/

        $("body").on('click', '.cust_more_modal', function(){ 
	   
            $('#AddSalesOrder').modal('hide');

            $('#AddCustomerCreation').modal('show');

        });

        /*###### */
        



        /*data table start*/ 

        function initializeDataTable() {

            datatable = $('#DataTable').DataTable({
            'stateSave': true,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': 
            {
                'url': "<?php echo base_url(); ?>Crm/SalesOrder/FetchData",
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
                { data: 'so_id'},
                { data: 'so_reffer_no' },
                { data: 'so_date'},
                { data: 'so_customer'},
                { data: 'so_quotation_ref'},
                { data: 'action'},
                
               ]
    
            });
        }

        $(document).ready(function () {
            initializeDataTable();
        });
        /*###*/



        $("body").on('change', '#customer_id', function(){ 
            var id = $(this).val();
           
            $.ajax({

                url : "<?php echo base_url(); ?>Crm/SalesOrder/ContactPerson",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {   
                    var data = JSON.parse(data);

                    $(".contact_person_clz").html(data.customer_name);

                    $(".quotation_ref").html(data.quotation_det);

                    $(".payment_term").val(data.credit_term);
                   
                }


            });
        });





        $("body").on('change', '.quotation_ref', function(){ 

            $(".sales_remove").remove();

            var id = $(this).val();
           
            var quot_id = $('#customer_id').val();

            $.ajax({

                url : "<?php echo base_url(); ?>Crm/SalesOrder/QuotationRef",

                method : "POST",

                //data: {ID: id},
                data:{
                    ID: id,
                    quotID: quot_id
                },

                success:function(data)
                {   
                    var data = JSON.parse(data);

                    console.log(data.prod_details);
                   
                    $(".contact_person_clz").html(data.contact_person);

                    $(".sales_executive_clz").html(data.qd_sales_executive);

                    $(".project").val(data.qd_project);

                    $(".product-more2").append(data.prod_details);

                }


            });
        });


        /*product section start*/

        var max_fieldspp      = 30;

        var pp = 1;
        
        $("body").on('click', '.add_product2', function(){
            
            var pp = $('.prod_row2').length
            
            
			if(pp < max_fieldspp){ 
                
                pp++;
                
                $(".product-more2").append("<tr class='prod_row2'><td class='si_no2'><input type='number' value="+pp+" name='qpd_serial_no[]' class='form-control non_border_input' required=''></td><td style='width:20%'><select class='form-select add_prod' name='spd_product_details[]' required=''><option value='' selected disabled>Select Product Description</option><?php foreach($products as $prod){?><option value='<?php echo $prod->product_id;?>'><?php echo $prod->product_details;?></option><?php } ?></select></td><td><input type='text' name='spd_unit[]' class='form-control ' required=''></td><td><input type='number' name='spd_quantity[]' class='form-control qtn_clz_id' required=''></td><td><input type='number' name='spd_rate[]' class='form-control rate_clz_id' required=''></td><td><input type='number' name='spd_discount[]' class='form-control discount_clz_id' required=''></td><td><input type='number' name='spd_amount[]' class='form-control amount_clz_id' readonly></td><td class='remove-btnpp' colspan='6'><div class='remainpass'><i class='ri-close-line'></i>Remove</div></td></tr>");

			}

            slno2();

           // InitProductSelect2();

	    });

        $(document).on("click", ".remove-btnpp", function() 
        {
	 
            $(this).parent().remove();
            slno2();
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

        function slno2(){

            var pp =1;

            $('body .prod_row2').each(function() {

                $(this).find('.si_no2').html('<td class="si_no2">' + pp + '</td>');

                pp++;
            });

        }

        /*###*/




        /*product detail calculation*/
        
        $("body").on('keyup', '.discount_clz_id , .qtn_clz_id , .rate_clz_id', function(){ 

          //  var discount = $(this).val();

            var $discountSelect = $(this);

            var discount = parseInt($discountSelect.closest('.prod_row2').find('.discount_clz_id').val())||0;

            var $discountSelectElement = $discountSelect.closest('.prod_row2').find('.rate_clz_id');

            var rate = $discountSelectElement.val();

            var $quantitySelectElement = $discountSelect.closest('.prod_row2').find('.qtn_clz_id');

            var quantity = parseInt($quantitySelectElement.val())||0;

            var parsedRate = parseFloat(rate);

            var parsedQuantity = quantity; 

            var multipliedTotal = parsedRate * parsedQuantity;

            var per_amount = (discount/100)*multipliedTotal;

            var orginalPrice = multipliedTotal - per_amount;

            var orginalPrice = orginalPrice.toFixed(2); //For showing 1000.00 instead of 1000 if no decimal present
           
            //alert(orginalPrice);

            var $amountElement = $discountSelect.closest('.prod_row2').find('.amount_clz_id');

            $amountElement.val(orginalPrice);

            TotalAmount();

        });

        /**/


        /*total amount calculation start*/

        function TotalAmount()
        {

            var total= 0;

            $('body .amount_clz_id').each(function()
            {
                var sub_tot = parseFloat($(this).val());

                total += parseFloat(sub_tot.toFixed(2))||0;
               //total = Number(total).toFixed(2)
            });

           total = total.toFixed(2);

           $('.amount_total').val(total);

           var resultSalesOrder= numberToWords.toWords(total);

            $(".sales_order_amount_in_word").text(resultSalesOrder);

            $(".sales_order_amount_in_word_val").val(resultSalesOrder);
            

        }

        /*total amount calculation end*/



       


        /**/
        $("body").on('click', '.delete_btn', function(){ 
            
            if (!confirm('Are you absolutely sure you want to delete?')) return false;
            var id = $(this).data('id');
            $.ajax({

                url : "<?php echo base_url(); ?>Crm/SalesOrder/Delete",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {
                    alertify.success('Data Deleted Successfully').delay(2).dismissOthers();

                    datatable.ajax.reload(null,false);
                }


            });

        });

        /*add section end*/


        /*edit section start*/


        $("body").on('click', '.edit_btn', function(){ 

            var id = $(this).data('id');
            
           
            
            $.ajax({

                url : "<?php echo base_url(); ?>Crm/SalesOrder/Edit",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {
                    var data = JSON.parse(data);

                    $(".edit_reff").val(data.reff_no);

                    $(".edit_date").val(data.date);

                    $(".edit_customer").html(data.customer_creation);

                    $(".edit_quot").html(data.quotation);

                    $(".edit_lpo").val(data.lpo);

                    $(".edit_executive").val(data.sales_executive);

                    $(".contact_person_clz").val(data.contact_person);
                    
                    $(".payment_term").val(data.payment_term);

                    $(".edit_delivery_date").val(data.delivery_term);

                    $(".edit_project").val(data.project);

                    $(".edit_so_id").val(data.so_id);

                    $('#EditSalesOrder').modal("show");
                   
                    
                }


            });

        });


        $("body").on('click', '.edit_add_prod', function(){ 
             
          
             $('#EditAddProduct').modal('show');

             $('#EditSalesOrder').modal('hide');

             var sales_id = $('.edit_so_id').val();

             $('.edit_hidden_sales_id').val(sales_id);

        });


        function InitProductSelect2(){
            $(".edit_product_det:last").select2({
                placeholder: "Select Product",
                theme : "default form-control-",
                dropdownParent: $($('.edit_product_det:last').closest('.edit_prod_row')),
                ajax: {
                    url: "<?= base_url(); ?>Crm/SalesOrder/FetchProducts",
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


        $(function() {
            var form = $('#edit_add_prod_form');
            
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
                        url: "<?php echo base_url(); ?>Crm/SalesOrder/AddProduct",
                        method: "POST",
                        data: $(currentForm).serialize(),
                        success: function(data) {
                         
                           /* $('#add_sales_order_form')[0].reset();
                           
                            $('#SalesOrder').modal('hide');

                            $('#customer_id').val('').trigger('change');

                            $('.quotation_ref').val('').trigger('change');

                            $('.sales_executive_clz').val('').trigger('change');

                            $('.contact_person_clz').val('').trigger('change');

                            $('.sales_remove').remove();

                            alertify.success('Data Added Successfully').delay(3).dismissOthers();
                            datatable.ajax.reload(null, false);*/
                           
                            
                        }
                    });
                }
            });
        });




        /*edit section end*/



        /*view section start*/

        $("body").on('click', '.view_btn', function(){ 
	        
            var id = $(this).data("id");

            $.ajax({

                url : "<?php echo base_url(); ?>Crm/SalesOrder/View",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {
                    var data = JSON.parse(data);

                    $(".view_reff").val(data.reff_no);
                    
                    $(".view_date").val(data.date);

                    $(".view_customer").val(data.customer);

                    $(".view_quot").val(data.quot_ref);

                    $(".view_lpo").val(data.lpo);

                    $(".view_executive").val(data.sales_exec);

                    $(".view_contact_person").val(data.contact_person);

                    $(".view_payment_term").val(data.payment_term);

                    $(".view_delivery_date").val(data.delivery_term);

                    $(".view_project").val(data.project);

                    $(".view_product_data").html(data.prod_details);

                    $('#ViewSalesOrder').modal('show');
                
                    
                }


            });

            

        });

        /*view section end*/




       
    });



</script>