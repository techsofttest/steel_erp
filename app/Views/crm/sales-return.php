<style>

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

.select2.select2-container{
    width: 95% !important;
}
.disabled-span{
    pointer-events: none;
    opacity: 0.5;
    cursor: not-allowed;
}
.content_table table {
    width: 100%;
    border-collapse: collapse;
    border: 1px solid black;
}
.add_table {
    margin-bottom: 0px;
}
.total_table {
    width: 22% !important;
   
}
span.select2.customer_width, span.select2 {
  
    align-items: center;
    display: flex;
}
.select_prod_add td{

    padding:10px 10px;
}
.prod_row td{

    padding:10px 10px;

}
.view_product td{

    padding:10px 10px;
}
.edit_product td{
 
    padding:10px 10px;

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
                        
                        <!--cash invoice modal content start-->
                        
                        <div class="modal fade" id="SalesReturn" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" data-product="false" id="add_form1">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Sales Return</h5>
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
                                                                        <input type="text" name="sr_reffer_no" id="uid" value="" class="form-control input_length" required readonly>
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
                                                                        <input type="text" name="sr_date" autocomplete="off" class="form-control datepicker_ap input_length" required readonly>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->

                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2 margin_zero">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Customer Name</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        

                                                                        <select class="form-select customer_sel customer_id input_length" name="sr_customer" required></select>

                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 

                                                            

                                                            <!-- Single Row Start -->
                                                            
                                                            
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2 margin_zero">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Invoice No <span class="add_more_icon cust_more_modal ri-add-line" id="blink"></span></label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                      
                                                                        

                                                                        <select class="form-select sales_order_add_clz input_length" name="sr_cash_invoice" id="sales_order_add" required>

                                                                            <option value="" selected disabled>Select Invoice No</option>
                                                                
                                                                        </select>
                                                                        
                                                                    </div>


                                                                    

                                                                </div> 

                                                            </div>    

                                                           
                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->
                                                            
                                                            
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2 margin_zero">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Debit Account</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                      
                                                                        <input type="text" name="sr_credit_account"  class="form-control credit_account input_length" required readonly>
                                                                        
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
                                                                        <label for="basicInput" class="form-label">LPO Reference</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        
                                                                    <input type="text" name="sr_lpo_reff" class="form-control lpo_ref input_length" required>
                                                                    
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
                                                                    
                                                                        <select class="form-select cont_person input_length" name="sr_contact_person" id="" required></select>
                                                                     
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### -->

                                                            


                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2 margin_zero">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Payment Terms</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="sr_payment_term" class="form-control payment_terms input_length" required>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                         

                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2 margin_zero">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Project</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="sr_project"  class="form-control project_clz input_length" required>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 

                                                            <input type="hidden" class="hidden_sales_return" name="sr_id">

                                                            <input type="hidden" class="sales_order_hidden" name="sales_order">
                                                             



                                                        </div>

                                                    </div>
                                                                                          

                                                </div>


                                                <!--table section start-->
                                                <div class="mt-4 content_table">
                                                    <table class="table table-bordered table-striped delTable selected_table add_table" style="display:none;">
                                                        <thead class="travelerinfo contact_tbody">
                                                            <tr>
                                                                <td style="width: 4%;">SI</td>
                                                                <td>Product Description</td>
                                                                <td style="width: 6%;">Unit</td>
                                                                <td style="width: 6%;">Qty</td>
                                                                <td style="width: 6%;">Rate</td>
                                                                <td style="width: 7%;">Discount</td>
                                                                <td style="width: 9%;">Amount</td>
                                                               
                                                            </tr>
                                                         
                                                        </thead>
                                                        
                                                        <tbody  class="travelerinfo product-more2"></tbody>

                                                        
                                                    </table>
                                                    <table class="total_table" style="display:none;">
                                                        <tbody>
                                                            <tr>
                                                                
                                                                
                                                                <input type="hidden" name="pf_total_amount_in_words" class="performa_amount_in_word_val">
                                                                <td align="right" class="total_label">Total</td>
                                                                <td><input type="text" name="sr_total" class="amount_total form-control text-end" readonly></td>
                                                            </tr>
                                                            
                                                          
                                                        </tbody>
                                                    </table>
                                                </div>

                                                
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        
                                                        
                                                        <div class="row row_align mb-4" style="display:none;">
                                                            <div class="col-lg-3">
                                                                <label for="basicInput" class="form-label">Attach</label>
                                                            </div>

                                                            <div class="col-lg-4">
                                                                <input type="file" name="ci_file"  class="form-control image_file">
                                                            </div>

                                                        </div>


                                                        
                                                    </div>
                                                    <div class="col-lg-6">
                                                    <div class="modal-footer justify-content-center">
                                                        <button class="btn btn btn-success" type="submit">Save</button>
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


                        <!--modal content end-->



                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">Sales Returns</h4>
                                        <button type="button"   class="btn btn-primary py-1 add_model_btn">Add</button>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <table id="DataTable" class="table table-bordered table-striped delTable display dataTable">
                                            <thead>
                                                <tr>
                                                    <th class="no-sort">Sl no</th>
                                                    <th>Reference</th>
                                                    <th>Date</th>
                                                    <th>Customer</th>
                                                    <th>Sales Order</th>
                                                    <th>Invoice No</th>
                                                    <th>Amount</th>
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
                    <button type="button" class="btn-close select_modal_close" aria-label="Close"></button>
                </div>

				<div class="modal-body">

                    <div class="live-preview">
                                                
                        <div class="mt-4 content_table">
                            
                            <table class="table table-bordered table-striped delTable add_table">
                                
                                <thead class="travelerinfo contact_tbody">
                                    
                                    <tr>
                                        <td style="width: 4%;">SI</td>
                                        <td>Product Description</td>
                                        <td style="width: 6%;">Qty</td>
                                        <td style="width: 4%;">Tick</td>
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


<!--save modal section start-->

<div class="modal fade" id="SaveModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<form  class="Dashboard-form class" id="">
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
                                        <td>Date</td>
                                        <td>Invoice Ref</td>
                                        <td>Amount</td>
                                        <td>Adjust</td>
                                        <td>Tick</td>
                                    </tr>
                                                            
                                                           
                                </thead>
                                                        
                                <tbody  class="travelerinfo adjustment_table">
                                    
                                    <!---<tr>
                                        <td>1</td>
                                        <td><input type="date" name="" value="30-01-2024" class="form-control" required></td>
                                        <td><input type="text" name="" value="RF567" class="form-control" required></td>
                                        <td><input type="text" name="" value="420" class="form-control" required></td>
                                        <td><input type="text" name="" value="2" class="form-control" required></td>
                                        <td><input type="checkbox" name="" value="" class="" required></td>
                                    </tr>--->
                                    
                                    
                                </tbody>

                                

                            </table>
                            
                        </div>


                    </div>  
                                            
                                            
                </div>


                <div class="modal-footer justify-content-center">
                    
                    <input type="hidden" id="" name="" value="">                                
                    <span class="btn btn btn-success adjustment_close">Save</span>

                </div>





                                        
			</div>
		</form>

	</div>

</div>

<!--save modal section end-->



<!--view section start-->

<div class="modal fade" id="ViewsalesReturns" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<form  class="Dashboard-form class" id="">
			<div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sales Returns</h5>
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
                                                <input type="text" class="form-control view_reff input_length" readonly>
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
                                                <input type="text" class="form-control view_date input_length" readonly>
                                            </div>

                                        </div> 

                                    </div>    

                                    <!-- ### --> 


                                    <!-- Single Row Start -->

                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2 margin_zero">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Customer Name</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                
                                                <input type="text" class="form-control view_customer input_length" readonly>

                                            </div>

                                        </div> 

                                    </div>    

                                    <!-- ### --> 

                                                            

                                    <!-- Single Row Start -->
                                    
                                    
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2 margin_zero">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label ">Invoice No</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                
                                                

                                              

                                                <input type="text" class="form-control view_sales_order input_length" readonly>
                                                
                                            </div>

                                        </div> 

                                    </div>    

                                    
                                    <!-- ### --> 


                                    <!-- Single Row Start -->
                                    
                                    
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2 margin_zero">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Debit Account</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                
                                                <input type="text" name=""  class="form-control view_credit_account input_length" required readonly>
                                                
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
                                                <label for="basicInput" class="form-label">LPO Reference</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                
                                            <input type="text" class="form-control view_lpo input_length" readonly>
                                            
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
                                            
                                                <input type="text" class="form-control view_contact input_length" readonly>

                                            </div>

                                        </div> 

                                    </div>    

                                    <!-- ### -->

                                                            


                                    <!-- Single Row Start -->
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2 margin_zero">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Payment Terms</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="text" class="form-control view_payment_terms input_length" readonly>
                                            </div>

                                        </div> 

                                    </div>    

                                    <!-- ### --> 


                                                         

                                    <!-- Single Row Start -->
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2 margin_zero">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Project</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="text" class="form-control view_project input_length" readonly>
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
                                        <td class="text-center">Product Description</td>
                                        <td class="text-center" style="width: 6%;">Unit</td>
                                        <td class="text-center" style="width: 6%;">Qty</td>
                                        <td class="text-center" style="width: 6%;">Rate</td>
                                        <td class="text-center" style="width: 7%;">Discount</td>
                                        <td style="width: 9%;">Amount</td>
                                    </tr>
                                    
                                </thead>
                                
                                <tbody  class="travelerinfo view_product"></tbody>

                                
                          
                            </table>
                        </div>

                                                
                        <div class="row">
                            <div class="col-lg-6">
                                
                                <div class="row row_align mb-4">
                                    
                                    <!--<div class="col-lg-3">
                                        <label for="basicInput" class="form-label">Credit Account</label>
                                    </div>

                                    <div class="col-lg-4">
                                        
                                        
                                        <input type="text" class="form-control view_credit_account" readonly>

                                        
                                                
                                    </div>-->

                                </div>

                                <!--<div class="row row_align mb-4">
                                    <div class="col-lg-3">
                                        <label for="basicInput" class="form-label">Attach</label>
                                    </div>

                                    <div class="col-lg-4">
                                        <input type="file" name="ci_file"  class="form-control image_file">
                                    </div>

                                </div>--->

                                <div class="card-body view_image_table" style="float: inline-start";></div>


                                
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


<!--view section  end-->


<!--edit section start-->

<div class="modal fade" id="EditSalesReturn" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<form  class="Dashboard-form class" id="edit_cash_invoice">
			<div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sales Return</h5>
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
                                                <input type="text" name="ci_reffer_no"  class="form-control edit_reff input_length" readonly>
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
                                                <input type="text" autocomplete="off" name="ci_date" class="form-control datepicker edit_date input_length" required readonly>
                                            </div>
                                        </div> 
                                    </div>    

                                    <!-- ### --> 


                                    <!-- Single Row Start -->
                                    <div class="col-lg-12">
                                        <div class="row align-items-center mb-2 margin_zero">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Customer Name</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                

                                                <select class="form-select edit_customer input_length" name="ci_customer" required></select>

                                            </div>

                                        </div> 

                                    </div>    
                                    <!-- ### --> 

                                                            

                                    <!-- Single Row Start -->
                                                            
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2 margin_zero">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Invoice No</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                
                                                <!--<select class="form-select edit_sales_order" name="ci_sales_order" id="sales_order_add" required></select>-->
                                                <input type="text" name="ci_sales_order" id="sales_order_add" class="form-control edit_sales_order input_length" required readonly>
                                            </div>

                                        </div> 

                                    </div>    
                                                          
                                    <!-- ### --> 


                                    <!-- Single Row Start -->
                                                            
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2 margin_zero">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Debit Account</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                              
                                                <input type="text" name="ci_credit_account"  class="form-control edit_charts_account input_length" readonly>
                                                
                                              
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
                                                <label for="basicInput" class="form-label">LPO Reference</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                
                                            <input type="text" name="ci_lpo_reff" class="form-control edit_lpo_reff input_length" required>
                                            
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
                                            
                                                <select class="form-select edit_contact_person input_length" name="ci_contact_person" id="" required></select>
                                                
                                            </div>

                                        </div> 

                                    </div>    

                                    <!-- ### -->

                                                            
                                    <!-- Single Row Start -->
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2 margin_zero">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Payment Terms</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="text" name="ci_payment_term" class="form-control edit_payment_terms input_length" required>
                                            </div>

                                        </div> 

                                    </div>    

                                    <!-- ### --> 


                                    
                                    <!-- Single Row Start -->
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2 margin_zero">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Project</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="text" name="ci_project"  class="form-control edit_project input_length" required>
                                            </div>

                                        </div> 

                                    </div>    

                                    <!-- ### --> 

                                    <input type="hidden" class="edit_cash_invoice_id" name="ci_id">
                                                             
                                </div>

                            </div>
                                                                                          
                        </div>


                        <!--table section start-->
                        <div class="mt-4 content_table">
                            <table class="table table-bordered table-striped delTable add_table">
                                <thead class="travelerinfo contact_tbody">
                                    <tr>
                                        <td style="width: 4%;">SI</td>
                                        <td>Product Description</td>
                                        <td style="width: 6%;">Unit</td>
                                        <td style="width: 6%;">Qty</td>
                                        <td style="width: 6%;">Rate</td>
                                        <td style="width: 7%;">Discount</td>
                                        <td style="width: 9%;">Amount</td>
                                        <!--<td>Action</td>->(action all ready done - remove comment)-->
                                        
                                    </tr>
                                    
                                </thead>
                                
                                <tbody  class="travelerinfo edit_product"></tbody>

                                <tbody class="add_more_class"></tbody>   
                                
                            </table>
                        </div>

                                                
                        <div class="row">
                            <div class="col-lg-6">
                                                        
                                <div class="card-body edit_image_table" style="float: inline-start";></div>

                            </div>
                            
                            <div class="col-lg-6">

                                <div class="modal-footer justify-content-center">
                                    <button class="btn btn btn-success" type="submit">Save</button>
                                </div>
                               
                            </div>
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

                <!--<div class="modal-footer justify-content-center">
                    <button class="btn btn btn-success" type="submit">Save</button>
                </div>--->

              


			</div>
		</form>

	</div>
</div>

<!--edit section end-->



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
                                        <td> Qty</td>
                                        <td>Tick</td>
                                    </tr>
                                                            
                                                           
                                </thead>
                                                        
                                <tbody  class="travelerinfo edit_select_prod_add"></tbody>


                            </table>
                            
                        </div>




                    </div>  
                                            
                                            
                </div>

                <div class="modal-footer justify-content-center">
                    
                                               
                    <button class="btn btn btn-success">Save</button>

                </div>




                                        
			</div>
		</form>

	</div>

</div>

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
                    var formData = new FormData(currentForm);
                    // Submit the form for the current tab
                    if($('#add_form1').attr('data-product')=="true")
                    {
                        $.ajax({
                            url: "<?php echo base_url(); ?>Crm/SalesReturn/Add",
                            method: "POST",
                            data: formData,
                            processData: false, // Don't process the data
                            contentType: false, // Don't set content type
                            success: function(data) {
                                
                                var data = JSON.parse(data);


                                $('#add_form1')[0].reset();

                                //$('select').empty();

                                $('.sales_return_remove').remove();

                                $('.customer_id').val('').trigger('change');

                                $('.cont_person').val('').trigger('change');

                                $('#SalesReturn').modal('hide');

                                

                                $('.adjustment_table').html(data.adjustment_data);

                                $('.hidden_sales_return').val("");

                                alertify.success('Data Added Successfully').delay(3).dismissOthers();

                                checkedIds.length = 0;

                                datatable.ajax.reload(null, false);

                                if(data.advance_status ==="true")
                                {
                                    $('#SaveModal').modal('show');
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
                'url': "<?php echo base_url(); ?>Crm/SalesReturn/FetchData",
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
                { data: 'sr_id' },
                { data: 'sr_reffer_no' },
                { data: 'sr_date'},
                { data: 'sr_customer'},
                { data: 'sr_sales_order'},
                { data: 'sr_invoice'},
                { data: 'sr_total'},
                { data: 'action'},
                
               ],

                "initComplete": function() {

                    var dataId = '<?php echo isset($_GET['view_rut']) ? $_GET['view_rut'] : ''; ?>';

                    $('#Datatable').dataTable().fnFilter(dataId);

                },

                "drawCallback": function() {

                    $('.view_btn[data-id="<?php echo isset($_GET['view_rut']) ? $_GET['view_rut'] : ''; ?>"]').trigger('click');

                }
    
            });
        }

        $(document).ready(function () {
            initializeDataTable();
        });
        /*###*/


        $("body").on('change', '.customer_id', function(){ 

            var id = $(this).val();

            if(id!=null){
 
                //Fetch Contact Person
                $.ajax({

                    url : "<?php echo base_url(); ?>Crm/SalesReturn/SalesOrder",

                    method : "POST",

                    data: {ID: id},

                    success:function(data)
                    {   
                        var data = JSON.parse(data);

                        $(".sales_order_add_clz").html(data.invoice_no);

                        $(".cont_person").html(data.contact_person);

                        $(".payment_term_clz").val(data.payment_term);

                    }


                });

            }

        });

        /**/
        $("body").on('change', '.sales_order_add_clz', function(){ 

            $('.cash_invoice_remove').remove();

            var id = $(this).val();

            var cust_id = $('.customer_id').val();

            //Fetch Contact Person
            $.ajax({

                url : "<?php echo base_url(); ?>Crm/SalesReturn/FetchSalesData",

                method : "POST",

                data: {ID: id,
                       custID:cust_id
                },

                success:function(data)
                {   
                    var data = JSON.parse(data);

                
                    $(".lpo_ref").val(data.ci_lpo);

                    $(".project_clz").val(data.ci_project);

                    $(".payment_terms").val(data.ci_payment_term);

                    $(".cont_person").html(data.contact_detail);

                    $(".credit_account").val(data.debit_account);

                    $(".sales_order_hidden").val(data.sales_order);

                    $(".lpo_ref").removeClass("error");

                    $(".project_clz").removeClass("error");

                    $(".payment_terms").removeClass("error");

                    $(".cont_person").removeClass("error");

                    $(".credit_account").removeClass("error");

                    slno();
                   
                }


            });

        });
        
        /**/

        


        /*product edit start*/

        $("body").on('click', '.product_edit', function(){ 

            $("#EditSalesReturn").modal("hide");

            $("#EditProduct").modal("show");

            var id = $(this).data('id');

            var invoice_no = $('.edit_sales_order').val();

            //console.log(id);

            $.ajax({

                url : "<?php echo base_url(); ?>Crm/SalesReturn/EditProduct",

                method : "POST",

                data:{ID: id,invoiceNo: invoice_no},

                success:function(data)
                {   
                    
                    var data = JSON.parse(data);

                    $(".edit_product_table").html(data.prod_details);

                
                }


            });

        });


        /*#####*/


        /***/

        $("body").on('keyup', '.edit_prod_qty', function(){ 

            var qty = $(this).val()

            var prod_id =$('.edit_prod_id').val();

            $.ajax({

                url : "<?php echo base_url(); ?>Crm/SalesReturn/CheckQty",

                method : "POST",

                data:{qty: qty,prodId: prod_id},

                success:function(data)
                {   
                    
                    var data = JSON.parse(data);


                   if(qty > data.srp_quantity)
                   {
                        alertify.error('Quanity should be less than '+data.srp_quantity+'').delay(3).dismissOthers();

                        $('.edit_prod_qty').val("");
                   }

                
                }


            });

        });


        $("body").on('keyup', '.qtn_clz_id', function(){ 

            var $dataSelect = $(this);

            var $qtySelectElement = $dataSelect.closest('.prod_row').find('.qtn_clz_id');

            var qty = $qtySelectElement.val();

            var $refferIdSelectElement = $dataSelect.closest('.prod_row').find('.ret_cash_inv_reff');

            var reffer_id = $refferIdSelectElement.val();


            $.ajax({

                url : "<?php echo base_url(); ?>Crm/SalesReturn/ProdQty",

                method : "POST",

                data:{refferID: reffer_id},

                success:function(data)
                {   
                    
                    var data = JSON.parse(data);

                    console.log(data); 

                    if(qty > data.total_qty)
                    {        
                            
                        alertify.error('Quanity should be less than '+data.total_qty+'').delay(3).dismissOthers();

                        var qtyNull = $qtySelectElement.val("");

                        var $qtyElement = $dataSelect.closest('.prod_row').find('.qtn_clz_id');

                        $currencyNullElement.val(qtyNull);
                    }


                }


            });

           

        });

        /*####*/


        /* Select 2 Remove Validation On Change */
        $("select[name=sr_customer]").on("change",function(e) {
            $(this).parent().find(".error").removeClass("error");         
        });
        /*###*/


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
                        url: "<?php echo base_url(); ?>Crm/SalesReturn/UpdateProduct",
                        method: "POST",
                        data: $(currentForm).serialize(),
                        success: function(data) {

                            var responseData = JSON.parse(data);

                            var returnId = responseData.srp_sales_return
                            
                            $('#EditProduct').modal('hide');

                            $('#EditSalesReturn').modal('show');

                            $('.edit_btn[data-id="'+returnId+'"]').trigger('click');

                            alertify.success('Data update Successfully').delay(3).dismissOthers();

                            datatable.ajax.reload(null,false)
                            
                        }
                    });
                }
            });
        });

        /*#####*/


        /*edit calculation section start*/

        $("body").on('keyup', '.edit_prod_discount, .edit_prod_qty, .edit_prod_rate', function()
        { 

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


        /*delete section start*/
         
        $("body").on('click', '.product_delete', function(){ 

            var id = $(this).data('id');

            var rowToDelete = $(this).closest('tr');

            $.ajax({

                url : "<?php echo base_url(); ?>Crm/SalesReturn/DeleteProdDet",

                method : "POST",

                data:{ID: id},

                success:function(data)
                {   
                    var responseData = JSON.parse(data);

                    rowToDelete.fadeOut(500, function() {
                        $(this).remove();
                        alertify.success('Data Delete Successfully').delay(3).dismissOthers();
                        deleteSlno();
                        EditProdTotal()
                        
                    }); 

                    if(responseData.return_status === "true")
                    {
                        $('#EditSalesReturn').modal('hide');
                        alertify.success('Data Delete Successfully').delay(3).dismissOthers();
                        
                        datatable.ajax.reload(null,false)

                    }

                
                }


            });
        });

        /*delete section end*/

       

       


       
        /*customer droup drown search*/
        $(".customer_sel").select2({
            placeholder: "Select Customer",
            theme : "default form-control- customer_width",
            dropdownParent: $('#SalesReturn'),
            ajax: {
                url: "<?= base_url(); ?>Crm/SalesReturn/FetchCustomers",
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
                   
                    //  NO NEED TO PARSE DATA `processResults` automatically parse it
                    //var c = JSON.parse(data);
                   
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








        /*delete*/ 
        $("body").on('click', '.delete_btn', function(){ 
            
            if (!confirm('Are you absolutely sure you want to delete?')) return false;

            var id = $(this).data('id');

            $.ajax({

                url : "<?php echo base_url(); ?>Crm/SalesReturn/Delete",

                method : "POST",

                data: {ID: id},

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


        /**/

        $('.adjustment_close').click(function(){ 
           
            $('#SaveModal').modal('hide');

            alertify.success('Data added Successfully').delay(2).dismissOthers();

            datatable.ajax.reload(null,false);
   
        });

        /****/



        /*close select modal start*/

        $("body").on('click', '.select_modal_close', function(){ 
            
            $('#SelectProduct').modal('hide');

            $('#CashInvoice').modal('show');

        });

        $("body").on('click', '.edit_close_sub_modal', function(){ 
            
            $('#EditProduct').modal('hide');

            $('#EditSalesReturn').modal('show');

        });

        /*close select modal end*/





        /*product section start*/

        var max_fieldspp      = 30;

        var pp = 1;

        $("body").on('click', '.add_product2', function(){
        
            var pp = $('.prod_row').length

            if(pp < max_fieldspp){ 
            
                pp++;
                
                $(".product-more2").append("<tr class='prod_row'><td class='si_no'>"+pp+"</td><td style='width:20%'><select class='form-select add_prod' name='cipd_prod_det[]' required=''><option value='' selected disabled>Select Product Description</option><?php foreach($products as $prod){?><option value='<?php echo $prod->product_id;?>'><?php echo addslashes($prod->product_details);?></option><?php } ?></select></td><td><input type='text'   name='cipd_unit[]' class='form-control ' required=''></td><td><input type='number' name='cipd_qtn[]' class='form-control qtn_clz_id' required=''></td><td><input type='number' name='cipd_rate[]' class='form-control rate_clz_id' required=''></td><td><input type='number' name='cipd_discount[]' class='form-control discount_clz_id' required=''></td><td><input type='number' name='cipd_amount[]' class='form-control amount_clz_id' required=''></td><td class='remove-btnpp' colspan='6'><div class='remainpass'><i class='ri-close-line'></i>Remove</div></td></tr>");

            }

            slno();

            InitProductSelect2();

        });


        $(document).on("click", ".remove-btnpp", function() 
        {

            $(this).parent().remove();
            slno();

        });



        /*serial no correction section start*/

        function slno(){

            var pp =1;

            $('body .prod_row').each(function() {

                $(this).find('.si_no').html('<td class="si_no">' + pp + '</td>');

                pp++;
            });

        }

        /*###*/

        /*product section end*/


        /* Product Init Select 2 */


         function InitProductSelect2(){
          $(".add_prod:last").select2({
            placeholder: "Select Product",
            theme : "default form-control-",
            dropdownParent: $($('.add_prod:last').closest('.prod_row')),
            ajax: {
                url: "<?= base_url(); ?>Crm/CashInvoice/FetchProducts",
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

        /*select modal section start*/ 
        /*$("body").on('click', '.cust_more_modal', function(){ 
            
            $('#SelectProduct').modal('show');
 
            $('#CashInvoice').modal('hide');

         });*/

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
                        url: "<?php echo base_url(); ?>Crm/SalesReturn/Add",
                        method: "POST",
                        data: formData,
                        processData: false, // Don't process the data
                        contentType: false, // Don't set content type
                        success: function(data) {

                            var data = JSON.parse(data);

                            var cash_invoice = data.cash_invoice;

                           // var cash_invoice = data.cash_invoice;
                         
                            $('.hidden_sales_return').val(data.cash_return_id);
  
                            $('#SelectProduct').modal('show');

                            $('#SalesReturn').modal('hide');

                            $('#add_form1').attr('data-product','true');

                            $.ajax({

                                url : "<?php echo base_url(); ?>Crm/SalesReturn/AddProduct",

                                method : "POST",

                                data: {cashInvoice: cash_invoice},
                                
                                success:function(data)
                                {   
                                    var data = JSON.parse(data);
                                    
                                    $(".select_prod_add").html(data.product_detail);
                                    
                                    
                                }   

                            });
    
                        }
                        
                    });

        });


         /*###*/


         /*product detail calculation*/
        
        $("body").on('keyup', '.discount_clz_id , .qtn_clz_id , .rate_clz_id', function(){ 
           
           var $discountSelect = $(this);

           var discount = parseInt($discountSelect.closest('.prod_row').find('.discount_clz_id').val())||0;
           
           var $discountSelectElement = $discountSelect.closest('.prod_row').find('.rate_clz_id');

           var rate = $discountSelectElement.val();

           var $quantitySelectElement = $discountSelect.closest('.prod_row').find('.qtn_clz_id');

           var quantity = parseInt($quantitySelectElement.val())||0;

           var parsedRate = parseFloat(rate);

           var parsedQuantity = quantity; 

           var multipliedTotal = parsedRate * parsedQuantity;

           var per_amount = (discount/100)*multipliedTotal;
          
           var orginalPrice = multipliedTotal - per_amount;

           var orginalPrice = orginalPrice.toFixed(2); //For showing 1000.00 instead of 1000 if no decimal present

           var $amountElement = $discountSelect.closest('.prod_row').find('.amount_clz_id');

           $amountElement.val(orginalPrice);

           TotalAmount();

       });

       
     

      

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

          //var resultSalesOrder= numberToWords.toWords(total);

           //$(".performa_amount_in_word").text(resultSalesOrder);

           //$(".performa_amount_in_word_val").val(resultSalesOrder);
           
           //currentClaim()
       }

       /*total amount calculation end*/


       /*prod modal submit start*/

       $("body").on('click', '.prod_modal_submit', function(){ 

            var selectId = $('#select_prod_id').val();

            checked = $("input[type=checkbox]:checked").length;

            if(!checked) {
                alert("You must check at least one checkbox.");
                return false;
            }

            $.ajax({

                url : "<?php echo base_url(); ?>Crm/SalesReturn/SelectedProduct",

                method : "POST",

                data: {ID: selectId},

                success:function(data)
                {
                
                    var data = JSON.parse(data);
                                    
                    $('.product-more2').html(data.product_detail);

                    $('#SelectProduct').modal("hide");

                    $('#SalesReturn').modal("show");

                    $('.selected_table').show();

                    $('.total_table').show();


                    checkedIds.length = 0;

                    $('.amount_total').val(data.total_amount);

                    console.log(data.total_amount);
                }

            });

        });


    /*prod modal submit end*/


    /*reset reffer no*/ 
    $('.add_model_btn').click(function(){

        $('.sales_return_remove').remove();

        $('#add_form1')[0].reset();

        $('.customer_sel').val('').trigger('change');

        $('.sales_order_add_clz option').remove();

        $('.cont_person  option').remove();

        $(".cust_more_modal").removeClass("disabled-span");

        $.ajax({

            url : "<?php echo base_url(); ?>Crm/SalesReturn/AddAccess",

            method : "POST",

            success:function(data)
            {

                var data = JSON.parse(data);

                if(data.status === 0){
                
                    alertify.error(data.msg).delay(3).dismissOthers();

                }
                else{

                    $('#SalesReturn').modal('show');

                }
                

            }

        });

        $.ajax({

            url : "<?php echo base_url(); ?>Crm/SalesReturn/FetchReference",

            method : "GET",

            success:function(data)
            {

                $('#uid').val(data);

            }
        });

    });

    /*####*/


    /*view section start*/
     
  
    $("body").on('click', '.view_btn', function(){ 
            
        $('#ViewsalesReturns').modal('show');

        var id = $(this).data('id'); 

        $.ajax({

            url : "<?php echo base_url(); ?>Crm/SalesReturn/View",

            method : "POST",

            data: {ID: id},

            success:function(data)
            {

                var data = JSON.parse(data);
                
                $('.view_reff').val(data.reffer_no);

                $('.view_date').val(data.date);

                $('.view_customer').val(data.customer);

                $('.view_sales_order').val(data.sales_order);

                $('.view_lpo').val(data.lpo_reff);

                $('.view_contact').val(data.contact_person);

                $('.view_payment_terms').val(data.payment_term);

                $('.view_project').val(data.project);

                $('.view_credit_account').val(data.credit_account);

                

                $('.view_product').html(data.prod_details);
                
                $('.view_image_table').html(data.image_table);
              
            
            }

        });

        
    });

    /*view section end*/



    /*edit section start*/
    
    $("body").on('click', '.edit_btn', function(){ 
            
            
    
            var id = $(this).data('id'); 

            if(id!=null){
    
                $.ajax({
        
                    url : "<?php echo base_url(); ?>Crm/SalesReturn/Edit",
        
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

                            $('.edit_customer').html(data.customer);

                            $('.edit_sales_order').val(data.invoice_no);

                            $('.edit_lpo_reff').val(data.lpo_reff);

                            $('.edit_contact_person').html(data.contact_person);

                            $('.edit_payment_terms').val(data.payment_term);

                            $('.edit_project').val(data.project);

                            $('.edit_project').val(data.project);

                            $('.edit_product').html(data.prod_details);

                            $('.edit_cash_invoice_id').val(data.cash_invoice_id);

                            $('.edit_charts_account').val(data.credit_account);

                            $('.add_more_class').html(data.add_more);

                            $('#EditSalesReturn').modal('show');

                        }
                        
                       
                        
                    
                    }
        
                });

            }
    
            
        });


        $("body").on('click', '.edit_customer', function(){ 
            
            $('#EditSalesReturn').modal('show');
    
            var id = $(this).data('id'); 

            if(id!=null){
    
                $.ajax({
        
                    url : "<?php echo base_url(); ?>Crm/CashInvoice/Edit",
        
                    method : "POST",
        
                    data: {ID: id},
        
                    success:function(data)
                    {
        
                        var data = JSON.parse(data);
                        
                        $('.edit_reff').val(data.reffer_no);
        
                        $('.edit_date').val(data.date);
        
                        $('.edit_customer').html(data.customer);
        
                        $('.edit_sales_order').html(data.sales_order);
        
                        $('.edit_lpo_reff').val(data.lpo_reff);
        
                        $('.edit_contact_person').html(data.contact_person);
        
                        $('.edit_payment_terms').val(data.payment_term);
        
                        $('.edit_project').val(data.project);

                    }
        
                });

            }
    
            
        });


        /*update section start*/


        $(function() {
            var form = $('#edit_cash_invoice');
            
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
                        url: "<?php echo base_url(); ?>Crm/SalesReturn/Update",
                        method: "POST",
                        data: formData,
                        processData: false, // Don't process the data
                        contentType: false, // Don't set content type
                        success: function(data) {
                     
                            /*$('#add_form1')[0].reset();

                            $('select').empty();

                            $('.cash_invoice_remove').remove();

                            $('#CashInvoice').modal('hide');

                            $('#SaveModal').modal('show');*/

                            $('#EditSalesReturn').modal('hide');

                            alertify.success('Data update Successfully').delay(3).dismissOthers();

                            datatable.ajax.reload(null, false);
                           
                        }
                    });
                }
            });
        });



        /*#####*/


        /*add more product*/


        $("body").on('click', '.add_more_product', function(){ 
             
            var order_id = $('.edit_sales_order').val();
 
            var prod_id = $('.edit_ci_prod_id').val();
 
            var cash_invoice_id = $('.edit_cash_invoice_id').val();
             
            //alert(prod_id);
 
             $.ajax({
 
                 url : "<?php echo base_url(); ?>Crm/CashInvoice/EditAddProduct",
 
                 method : "POST",
 
                 data: {orderID: order_id,
                     prodID: prod_id,
                     cashInvoiceId: cash_invoice_id
                 },
 
                success:function(data)
                {   
                     var data = JSON.parse(data);
                     
                     $(".edit_select_prod_add").html(data.product_detail);
 
                     $('#EditSelectProduct').modal('show');
                     
                     $('#EditSalesReturn').modal('hide');
 
                 } 
 
             });
 
             
         });
 
 
         /*####*/


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
                        url: "<?php echo base_url(); ?>Crm/CashInvoice/UpdatedProduct",
                        method: "POST",
                        data: $(currentForm).serialize(),
                        success: function(data) {

                            var data = JSON.parse(data);

                            var cashInvoiceId = data.cash_invoice_id;


                            $('#edit_select_prod_form')[0].reset();

                            $('#EditSelectProduct').modal('hide');

                            $('.edit_btn[data-id="'+cashInvoiceId+'"]').trigger('click');

                            $('.add_more_class').html(data.add_more);

                           
                       
                        }
                    });
                }
            });
        });

        /*update product end*/


        /*delete prod section start*/


        $("body").on('click', '.del_prod_remove', function(){ 

            var dataSelect = $(this);
            
            var cashSelectElement = dataSelect.closest('.delete_cash_invoice').find('.hidden_cash_prod_id');

            var prod_id = parseFloat(cashSelectElement.val()) 

            var rowToDelete = $(this).closest('tr');

            $.ajax({

                url : "<?php echo base_url(); ?>Crm/CashInvoice/DeleteProduct",

                method : "POST",

                data: {ProdID: prod_id},

                success:function(data)
                {
                    var data = JSON.parse(data);


                    if(data.status === "True")
                    {
                    $('#EditSalesReturn').modal('hide');

                    datatable.ajax.reload(null,false);
                    }


                    var deliverID = data.delivery_id;

                    $('.add_more_class').html(data.add_more);

                    //$('.edit_btn[data-id="'+deliveryID+'"]').trigger('click');

                    //alertify.success('Data Delete Successfully').delay(3).dismissOthers();

                    rowToDelete.fadeOut(500, function() {
                        $(this).remove();
                        alertify.success('Data Delete Successfully').delay(3).dismissOthers();
                       // $('.edit_btn[data-id="'+deliveryID+'"]').trigger('click');



                    }); 
                    
                
                    
                }

            });
        });

        /*delete  prod section end*/




    /*edit section end*/

    $('.datepicker_ap').change(function(){

        var date = $(this).val();

        $.ajax({

        url: "<?php echo base_url(); ?>Crm/SalesReturn/FetchReference/r/"+date+"",

        method: "POST",

            success: function(data) {
                
                $('#uid').val(data);

            }
            
        });


    })


    


    });


    /*checkbox section start*/

    var checkedIds = [];

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
       
        if (checkbox.checked) {
            // Add the ID to the array if checked
            checkedIds.push(checkbox.id);
        } else {
            // Remove the ID from the array if unchecked
            checkedIds = checkedIds.filter(id => id !== checkbox.id);
        }

        // Log the current state of checked IDs
       
        document.getElementById('select_prod_id').value = checkedIds.join(',');
    }

    // Update modal form function
    /*function updateModalForm() 
    {
        // Update the value of the hidden input in the modal form with the checked IDs
        document.getElementById('select_prod_id').value = checkedIds.join(',');


        // Log the checked IDs in the modal form
       
    }*/


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