<style>

.cust_more_modal
{
        
    font-size: 25px;
    color: #ff0000b5;
    position: absolute;
    right: 34px;
    top: -16px;

}
 .contact_more_modal
    {
        position: absolute;
        right: 35px;
        font-size: 25px;
        top: -15px;
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
    width: 95%;
}

.input_length2
{
    width: 93%;
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
                                                                        <input type="text" name="so_reffer_no" id="soid" value="<?php echo $sales_order_id;?>" class="form-control input_length" required readonly>
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
                                                                        <input type="text" name="so_date" id="" autocomplete="off" class="form-control datepicker input_length" required>
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

                                                                    <div class="col-col-md-8 col-lg-8 zero_padding">
                                                                        <select class="form-select droup_customer_id" name="so_customer" id="customer_id" style="width:80%;" required>
                                                                            <option value="" selected disabled>Select Customer</option>
                                                                           
                                                                        </select>
                                                                    </div>


                                                                    <div class="col-col-md-1 col-lg-1 zero_padding">
                                                                        <span class="add_more_icon cust_more_modal ri-add-box-fill"></span>
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
                                                                        
                                                                        <select class="form-select quotation_ref input_length" name="so_quotation_ref" id="">
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
                                                                        <input type="text" name="so_lpo" id="qd_quotation_number_id" class="form-control input_length" required>
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
                                                                       
                                                                        <select class="form-select enqinput sales_executive_clz input_length2" name="so_sales_executive"  required>
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
                                                                        <label for="basicInput" class="form-label">Contact Person</label>
                                                                    </div>

                                                                    <div class="col-col-md-8 col-lg-8">
                                                                        <select class="form-select contact_person_clz" name="so_contact_person"  required>
                                                                            <option value="" selected disabled>Contact Person</option>
                                                                            <!--<?php foreach($contacts as $cont){?> 
                                                                            
                                                                                <option value="<?php echo $cont->contact_id; ?>"><?php echo $cont->contact_person;?></option>
                                                                                
                                                                            <?php } ?>--->
                                                                
                                                                        </select>
                                                                       
                                                                       
                                                                    </div>


                                                                    <div class="col-col-md-1 col-lg-1">
                                                                        <span class="add_more_icon contact_more_modal ri-add-box-fill"></span>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### -->

                                                            


                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label ">Payment Term</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="so_payment_term"  class="form-control payment_term input_length2" required>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label ">Delivery Date</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                      
                                                                        <input type="text" name="so_delivery_term" id="delivery_term" class="form-control datepicker input_length2" required>
                                                            
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 

                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label ">Project</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="so_project"  class="form-control project input_length2" required>
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
                                                                <input type="file" name="so_file"  class="form-control">
                                                            </div>

                                                        </div>


                                                        
                                                    </div>

                                                    <div class="col-lg-6"></div>
                                                    <!--<div class="col-lg-6">
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
                                            <span><button class="btn btn btn-success once_form_submit" name="print_btn" type="submit" value="1">Print</button></span>
                                        </div>

                                        
			                        </div>
		                        </form>

	                        </div>
                        </div>

                        <!--sales order section end-->



                        <!--sales order edit section start-->

                        <div class="modal fade" id="EditSalesOrder" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="edit_sales_order">
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
                                                                        <input type="text" name="so_date" id="" autocomplete="off" class="form-control datepicker edit_date" required>
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
                                                                        
                                                                        <select class="form-select  edit_quot" name="so_quotation_ref" id="">
                                                                            
                                                               
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
                                                                        <select class="form-select edit_contact_person" name="so_contact_person"  required>
                                                                            <option value="" selected disabled>Contact Person</option>
                                                                            
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
                                                                        
                                                                       
                                                                        <input type="text" name="so_delivery_term" id="" class="form-control datepicker edit_delivery_date" required>
                                                            
                                                                        
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
                                                            
                                                            <input type="hidden" name="so_id" class="edit_so_id">

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
                                                        
                                                        <tbody  class="travelerinfo edit_add_prod_det"></tbody>
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
                                                                <td><input type="text" name="so_amount_total" class="edit_amount_total form-control" readonly></td>
                                                            </tr>
                                                            
                                                          
                                                        </tbody>
                                                    </table>
                                                </div>


                                               

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        

                                                      
                                                        <div class="card-body edit_image_table"></div>



                                                        
                                                    </div>
                                                    <div class="col-lg-6"></div>
                                                    <!--<div class="col-lg-6">
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

                                                    </div>---->
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

                                                            <tr class="edit_add_prod_row">
                                                                <td style="width: 10%;" class="">1</td>
                                                                <td style="width:34%">
                                                                    <select class="form-select  edit_product_det" name="spd_product_details" required>
                                                                        
                                                                        <option value="" selected disabled>Select Product Description</option>
                                                                       
                                                                    </select>
                                                                </td>
                                                                <td><input type="text"   name="spd_unit" class="form-control" required></td>
                                                                <td><input type="number" name="spd_quantity" class="form-control edit_add_qty" required></td>
                                                                <td><input type="number" name="spd_rate" class="form-control edit_add_rate" required></td>
                                                                <td><input type="number" name="spd_discount" min="0" max="100" onkeyup="MinMax(this)" class="form-control edit_add_discount" required></td>
                                                                <td><input type="number" name="spd_amount" class="form-control edit_add_amount" ></td>
                                                                
                                                                <input type="hidden" name="spd_sales_order" class="edit_hidden_sales_id">

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


                        <!--edit product section start-->

                        <div class="modal fade" id="EditProduct" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="edit_product_form">
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
                                                        <thead class="travelerinfo">
                                                            
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

                                                        <tbody class="edit_product_table"></tbody>
                                                       
                                                       
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

                        <!--edit product section end-->



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
                                                                        <label for="basicInput" class="form-label ">Contact Person</label>
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

                                                        <tbody>
                                                            <tr>
                                                                <td colspan="2"></td>
                                                                <td colspan="3" class=""></td>
                                                                
                                                                <td>Total</td>
                                                                <td><input type="text" name="" class="view_total_amount form-control" readonly=""></td>
                                                            </tr>
                                                            
                                                          
                                                        </tbody>
                                                        
                                                       
                                                    </table>
                                                </div>


                                                <!--table section end-->


                                                <!--attachment section start-->

                                                <div class="card-body view_image_table" style="float: inline-start";></div>
                                                    
                
                                                <!--#######-->

                                              

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
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#AddSalesOrder" class="btn btn-primary py-1 add_model_btn">Add</button>
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
                    var formData = new FormData(currentForm);
                    $('.once_form_submit').attr('disabled', true); // Disable this input.
                    // Submit the form for the current tab
                    $.ajax({
                        url: "<?php echo base_url(); ?>Crm/SalesOrder/Add",
                        method: "POST",
                        data: formData,
                        processData: false, // Don't process the data
                        contentType: false, // Don't set content type
                        //data: $(currentForm).serialize(),
                        success: function(data) {
                            
                            var data = JSON.parse(data);

                            $('#add_sales_order_form')[0].reset();
                           
                            $('#AddSalesOrder').modal('hide');

                            $('#customer_id').val('').trigger('change');

                            $('.quotation_ref').val('').trigger('change');

                            $('.sales_executive_clz').val('').trigger('change');

                            $('.contact_person_clz').val('').trigger('change');

                            $('.sales_remove').remove();

                            $('.quotation_ref option').remove();

                            $('.contact_person_clz option').remove();

                            $('.prod_row2').remove();

                            alertify.success('Data Added Successfully').delay(3).dismissOthers();

                            datatable.ajax.reload(null, false);

                            if(data.print!="")
                            {
                                window.open(data.print, '_blank');
                            }
                           
                        }
                    });
                }
            });
        });


        /*customer  Remove Validation On Change */
	
         $("select[name=so_customer]").on("change",function(e) {
            $(this).parent().find(".error").removeClass("error");         
        });
		
        /*###*/






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
                          

                            $.ajax({
                                url: "<?php echo base_url(); ?>Crm/SalesOrder/FetchProduct",
                                method: "POST",
                                //data: { key: 'value' },
                                success: function(secondData) {
                                    // Handle the response of the second AJAX call
                                    var secdata = JSON.parse(secondData);
                                   
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

                    if(data.credit_term!==null)
                    {
                        $('.payment_term').removeClass("error")
                    }
                   
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

                data:{
                    ID: id,
                    quotID: quot_id
                },

                success:function(data)
                {   
                    var data = JSON.parse(data);

                   
                   
                    $(".contact_person_clz").html(data.contact_person);

                    $(".sales_executive_clz").html(data.qd_sales_executive);

                    $(".project").val(data.qd_project);

                    $(".product-more2").append(data.prod_details);

                    if(data.qd_project!=null)
                    {
                        $('.project').removeClass("error")
                    }

                    if(data.contact_person!=null)
                    {
                        $('.contact_person_clz').removeClass("error")
                    }

                    if(data.qd_sales_executive!=null)
                    {
                        $('.sales_executive_clz').removeClass("error")
                    }

                    slno2();

                    reName();

                }


            });
        });


        /*product section start*/

        var max_fieldspp      = 30;

        var pp = 1;
        
        $("body").on('click', '.add_product2', function(){
            
            var pp = $('.prod_row2').length

            var so  = $('.sales_row_leng').length
            
            
			if(pp < max_fieldspp){ 
                
                pp++;
                
                $(".product-more2").append("<tr class='prod_row2 sales_row_leng'><td class='si_no2'><input type='number' value="+pp+" name='qpd_serial_no[]' class='form-control non_border_input' required=''></td><td style='width:20%'><select class='form-select add_prod' name='spd_product_details["+so+"]' required=''><option value='' selected disabled>Select Product Description</option><?php foreach($products as $prod){?><option value='<?php echo $prod->product_id;?>'><?php echo $prod->product_details;?></option><?php } ?></select></td><td><input type='text' name='spd_unit["+so+"]' class='form-control unit_clz_id' required=''></td><td><input type='number' name='spd_quantity["+so+"]' class='form-control qtn_clz_id' required=''></td><td><input type='number' name='spd_rate["+so+"]' class='form-control rate_clz_id' required=''></td><td><input type='number' name='spd_discount["+so+"]' min='0' max='100' onkeyup='MinMax(this)' class='form-control discount_clz_id' required=''></td><td><input type='number' name='spd_amount["+so+"]' class='form-control amount_clz_id' readonly></td><td class='remove-btnpp' colspan='6'><div class='remainpass'><i class='ri-close-line'></i>Remove</div></td></tr>");

			}

            slno2();

           // InitProductSelect2();

	    });

        $(document).on("click", ".remove-btnpp", function() 
        {
	 
            $(this).parent().remove();
            
           /* var jj = 0;

            $('body .sales_row_leng').each(function() {
                
                $(this).closest('.sales_row_leng').find('.add_prod').attr('name', 'spd_product_details['+jj+']');
  
                $(this).closest('.sales_row_leng').find('.unit_clz_id').attr('name', 'spd_unit['+jj+']');
  
                $(this).closest('.sales_row_leng').find('.qtn_clz_id').attr('name', 'spd_quantity['+jj+']');
                        
                $(this).closest('.sales_row_leng').find('.rate_clz_id').attr('name', 'spd_rate['+jj+']');
  
                $(this).closest('.sales_row_leng').find('.discount_clz_id').attr('name', 'spd_discount['+jj+']');
  
                $(this).closest('.sales_row_leng').find('.amount_clz_id').attr('name', 'spd_amount['+jj+']');
  
                jj++;
  
            });*/
            
            reName();

            TotalAmount();

            slno2();
        });

        /**/


        /*rename product start*/
         
        function reName(){
            
            var jj = 0;

            $('body .sales_row_leng').each(function() {
                
                $(this).closest('.sales_row_leng').find('.add_prod').attr('name', 'spd_product_details['+jj+']');
  
                $(this).closest('.sales_row_leng').find('.unit_clz_id').attr('name', 'spd_unit['+jj+']');
  
                $(this).closest('.sales_row_leng').find('.qtn_clz_id').attr('name', 'spd_quantity['+jj+']');
                        
                $(this).closest('.sales_row_leng').find('.rate_clz_id').attr('name', 'spd_rate['+jj+']');
  
                $(this).closest('.sales_row_leng').find('.discount_clz_id').attr('name', 'spd_discount['+jj+']');
  
                $(this).closest('.sales_row_leng').find('.amount_clz_id').attr('name', 'spd_amount['+jj+']');
  
                jj++;
  
            });
        }

        /*rename product end*/



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
                
                //var lenght = $('.si_no2').val().length;

                //console.log(lenght);
                
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
                    var data = JSON.parse(data);

                    if(data.status === "false")
                    {

                        alertify.error('Sales Order Cannot Be Deleted').delay(2).dismissOthers();

                       

                    }
                    else
                    {
                        alertify.success('Data Deleted Successfully').delay(2).dismissOthers();

                        datatable.ajax.reload(null,false);
                    }
                }


            });

        });


        /*reset reffer number*/

        $('.add_model_btn').click(function(){

            $('#add_sales_order_form')[0].reset();

            $('#customer_id').val('').trigger('change');

            $('.quotation_ref').val('').trigger('change');

            $('.sales_executive_clz').val('').trigger('change');

            $('.contact_person_clz').val('').trigger('change');

            $('.quotation_ref option').remove();

            $('.contact_person_clz option').remove();

            $('.once_form_submit').attr('disabled', false); // Disable this input.

           // $('.sales_executive_clz option').remove();

            $.ajax({

                url : "<?php echo base_url(); ?>Crm/SalesOrder/FetchReference",

                method : "GET",

                success:function(data)
                {

                $('#soid').val(data);

                }

            });

        });


        /**/


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

                    $(".edit_executive").html(data.sales_executive);

                    $(".edit_contact_person").html(data.contact_person);

                    $(".payment_term").val(data.payment_term);

                    $(".edit_delivery_date").val(data.delivery_term);

                    $(".edit_project").val(data.project);

                    $(".edit_so_id").val(data.so_id);

                    $(".edit_add_prod_det").html(data.prod_details);

                    $(".edit_amount_total").val(data.amount_total);

                    $(".edit_file_name").html(data.file_name);

                    $(".edit_file_attach").html(data.file_attach);

                    $(".edit_image_table").html(data.image_table);

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
                dropdownParent: $($('.edit_product_det:last').closest('.edit_add_prod_row')),
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

        
        /* Select 2 Remove Validation On Change */
        $("select[name=spd_product_details]").on("change",function(e) {
            $(this).parent().find(".error").removeClass("error");         
        });
        /*###*/


        //fetch quotation by customer

        $("body").on('change', '.edit_customer', function(){ 
            var id = $(this).val();

           

            var sales_order = $('.edit_so_id').val();
           
            $.ajax({

                url : "<?php echo base_url(); ?>Crm/SalesOrder/EditQuotRef",

                method : "POST",

                data: {ID: id,
                       SalesOrder : sales_order
                },

                success:function(data)
                {   
                    var data = JSON.parse(data);
                    
                    $(".edit_quot").html(data.quotation_det);

                }


            });
        });


        $("body").on('click', '.edit_close_sub_modal', function(){ 


            $('#EditSalesOrder').modal("show");

            $('#EditAddProduct').modal("hide");

            $('#EditProduct').modal("hide");
          

        });




        //edit add product calculation start

        $("body").on('keyup', '.edit_add_discount, .edit_add_qty, .edit_add_rate', function(){ 

            var $discountSelect = $(this);

            var discount = parseInt($discountSelect.closest('.edit_add_prod_row').find('.edit_add_discount').val())||0;

            var $discountSelectElement = $discountSelect.closest('.edit_add_prod_row').find('.edit_add_rate');

            var rate = $discountSelectElement.val();

            var $quantitySelectElement = $discountSelect.closest('.edit_add_prod_row').find('.edit_add_qty');

            var quantity = parseInt($quantitySelectElement.val())||0;

            var parsedRate = parseFloat(rate);

            var parsedQuantity = quantity; 

            var multipliedTotal = parsedRate * parsedQuantity;

            var per_amount = (discount/100)*multipliedTotal;

            var orginalPrice = multipliedTotal - per_amount;

            var orginalPrice = orginalPrice.toFixed(2); //For showing 1000.00 instead of 1000 if no decimal present
            
            var $amountElement = $discountSelect.closest('.edit_add_prod_row').find('.edit_add_amount');

            $amountElement.val(orginalPrice);

            
        });

        

        /*####*/


        /*calculate total amount*/

        function EditProdTotal()
        {

            var total= 0;

            $('body .edit_product_amount').each(function()
            {
                var sub_tot = parseFloat($(this).val());

                total += parseFloat(sub_tot.toFixed(2))||0;
            
            });

            total = total.toFixed(2);

            $('.edit_amount_total').val(total);
   

        }


        /*####*/



        /*edit add form submit*/

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
                        url: "<?php echo base_url(); ?>Crm/SalesOrder/EditAddProd",
                        method: "POST",
                        data: $(currentForm).serialize(),
                        success: function(data) {

                            var responseData = JSON.parse(data);

                            var saleID= (responseData.sales_order_id);

                           
                            $('.edit_btn[data-id="'+saleID+'"]').trigger('click');

                            $('#EditAddProduct').modal('hide');

                            $('#edit_add_prod_form')[0].reset();

                            $('.edit_product_det').val('').trigger('change');
                            
                           
                        }
                    });
                }
            });
        });

        /*####*/


        /*update form*/

        $(function() {
            var form = $('#edit_sales_order');
            
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
                        url: "<?php echo base_url(); ?>Crm/SalesOrder/Update",
                        method: "POST",
                        data: formData,
                        processData: false, // Don't process the data
                        contentType: false, // Don't set content type
                        //data: $(currentForm).serialize(),
                        success: function(data) {
                         
                           
                            $('#EditSalesOrder').modal('hide');

                            alertify.success('Data update Successfully').delay(3).dismissOthers();

                            datatable.ajax.reload(null, false);
                           
                            
                        }
                    });
                }
            });
        });



        /*#####*/


        /*fetch data by customer*/

        $("body").on('change', '.edit_customer', function(){ 
            var id = $(this).val();
           
            $.ajax({

                url : "<?php echo base_url(); ?>Crm/SalesOrder/ContactPerson",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {   
                    var data = JSON.parse(data);

                    $(".edit_contact_person").html(data.customer_name);

                    $(".edit_quot").html(data.quotation_det);

                    $(".payment_term").val(data.credit_term);
                   
                }

            });
        });

        /*###*/


        /*fetch data by quot ref*/

        $("body").on('change', '.edit_quot', function(){ 

            //$(".sales_remove").remove();

            var id = $(this).val();

            var quot_id = $('.edit_customer').val();

            $.ajax({

                url : "<?php echo base_url(); ?>Crm/SalesOrder/QuotationRef",

                method : "POST",

                
                data:{
                    ID: id,
                    quotID: quot_id
                },

                success:function(data)
                {   
                    var data = JSON.parse(data);

                    
                    $(".edit_contact_person").html(data.contact_person);

                    $(".edit_executive").html(data.qd_sales_executive);

                    $(".edit_project").val(data.qd_project);

                  

                }


            });
        });

        /*####*/


        /*product edit start*/

        $("body").on('click', '.product_edit', function(){ 

            $("#EditSalesOrder").modal("hide");

            $("#EditProduct").modal("show");

            var id = $(this).data('id');

            $.ajax({

                url : "<?php echo base_url(); ?>Crm/SalesOrder/EditProduct",

                method : "POST",

                data:{ID: id},

                success:function(data)
                {   
                    
                    var data = JSON.parse(data);

                    $(".edit_product_table").html(data.prod_details);

                   
                }


            });

        });


        /*#####*/


        /*edit calculation section start*/

        $("body").on('keyup', '.edit_prod_discount, .edit_prod_qty, .edit_prod_rate', function(){ 

            var $discountSelect = $(this);

            var discount = parseInt($discountSelect.closest('.edit_prod_row').find('.edit_prod_discount').val())||0;

            var $discountSelectElement = $discountSelect.closest('.edit_prod_row').find('.edit_prod_rate');

            var rate = $discountSelectElement.val();

            var $quantitySelectElement = $discountSelect.closest('.edit_prod_row').find('.edit_prod_qty');

            var quantity = parseInt($quantitySelectElement.val())||0;

            var parsedRate = parseFloat(rate);

            var parsedQuantity = quantity; 

            var multipliedTotal = parsedRate * parsedQuantity;

            var per_amount = (discount/100)*multipliedTotal;

            var orginalPrice = multipliedTotal - per_amount;

            var orginalPrice = orginalPrice.toFixed(2); //For showing 1000.00 instead of 1000 if no decimal present

            var $amountElement = $discountSelect.closest('.edit_prod_row').find('.edit_prod_amount');

            $amountElement.val(orginalPrice);

        });


        /*####*/


        /*#####*/

        $("body").on('keyup', '.edit_prod_rate', function(){ 
          
            var prod_id = $('.edit_prod_id').val();

            $.ajax({

                url : "<?php echo base_url(); ?>Crm/SalesOrder/CheckPrice",

                method : "POST",

                data:{prodID: prod_id},

                success:function(data)
                {   
                    /*var data = JSON.parse(data);

                    $(".edit_product_table").html(data.prod_details);*/

                }

            });
            

        });

        /*#####*/


        /*update product*/
        
        $(function() {
            var form = $('#edit_product_form');
            
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
                        url: "<?php echo base_url(); ?>Crm/SalesOrder/UpdateProduct",
                        method: "POST",
                        data: $(currentForm).serialize(),
                        success: function(data) {

                            var responseData = JSON.parse(data);

                            var salesId = responseData.sales_order_id
                            
                            $('#EditProduct').modal('hide');

                            $('#EditSalesOrder').modal('show');

                            $('.edit_btn[data-id="'+salesId+'"]').trigger('click');

                            alertify.success('Data update Successfully').delay(3).dismissOthers();

                            datatable.ajax.reload(null,false)
                            
                        }
                    });
                }
            });
        });

        /*#####*/


        /*edit product detail (qty keyup)*/


        $("body").on('keyup', '.edit_prod_qty', function(){ 

            var qty = $(this).val();

            var prod_id = $('.edit_prod_id').val();

            $.ajax({

                url : "<?php echo base_url(); ?>Crm/SalesOrder/GetProd",

                method : "POST",

                data:{prodID: prod_id},

                success:function(data)
                {   
                    
                    var data = JSON.parse(data);

                    console.log(data.status);

                    if(data.status==="true")
                    {
                        if(data.old_qty > qty)
                        {
                            $('.edit_prod_qty').val("");

                            alertify.error('Quantity cannont be decrease').delay(3).dismissOthers();
                
                        }
                    }

                    

                
                }
            });

        });

        /*#####*/


        /*edit product detail(rate keyup)*/

        $("body").on('keyup', '.edit_prod_rate', function(){ 

            var prod_rate = $(this).val();

            var prod_id = $('.edit_prod_id').val();

            //alert(prod_id);

            $.ajax({

                url : "<?php echo base_url(); ?>Crm/SalesOrder/GetProdRate",

                method : "POST",

                data:{prodID: prod_id},

                success:function(data)
                {   
                    
                    var data = JSON.parse(data);

                    if(data.product_status==="false")
                    {
                        $('.edit_prod_rate').val(data.prod_rate);

                        alertify.error('Price Cannnot Be Edit').delay(3).dismissOthers();
                
                    }
 
                }

            });

        });


        /*######*/



        /*edit section end*/




        /*delete section start*/
         
        $("body").on('click', '.product_delete', function(){ 

            var id = $(this).data('id');

            var rowToDelete = $(this).closest('tr');

            $.ajax({

                url : "<?php echo base_url(); ?>Crm/SalesOrder/DeleteProdDet",

                method : "POST",

                data:{ID: id},

                success:function(data)
                {   
                    
                    rowToDelete.fadeOut(500, function() {
                        $(this).remove();
                        deleteSlno();
                        EditProdTotal()
                        alertify.success('Data Delete Successfully').delay(3).dismissOthers();
                    }); 

                
                }


            });
        });

        /*delete section end*/


        function deleteSlno()
	    {

		    var pp =1;

            $('body .edit_product_row').each(function() {

                $(this).find('.delete_sino').html('<td class="delete_sino">' + pp + '</td>');

                pp++;
            });

        }





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

                    $(".view_total_amount").val(data.total_amount);

                    $(".view_product_data").html(data.prod_details);

                    $(".view_image_table").html(data.image_table);

                   

                    $('#ViewSalesOrder').modal('show');
                
                    
                }


            });

          
        });

        /*view section end*/




       
    });



</script>