<style>
.cust_more_modal {
    position: absolute;
    left: 470px;
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
                        
                        <!--cash invoice modal content start-->
                        
                        <div class="modal fade" id="CashInvoice" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="add_form1">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Cash Invoice</h5>
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
                                                                        <input type="text" name="ci_reffer_no" id="ciid" value="<?php echo $cash_invoice_id; ?>" class="form-control" required readonly>
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
                                                                        <input type="text" name="ci_date" class="form-control datepicker" required>
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
                                                                        

                                                                        <select class="form-select customer_sel customer_id" name="ci_customer" required></select>

                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 

                                                            

                                                            <!-- Single Row Start -->
                                                            
                                                            
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Sales Order <span class="add_more_icon cust_more_modal">Select</span></label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                      
                                                                        

                                                                        <select class="form-select sales_order_add_clz" name="ci_sales_order" id="sales_order_add" style="width:80%;" required>

                                                                            <option value="" selected disabled>Select Sales Order</option>
                                                                
                                                                        </select>
                                                                        
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
                                                                        <label for="basicInput" class="form-label">LPO Reference</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        
                                                                    <input type="text" name="ci_lpo_reff" class="form-control lpo_ref" required>
                                                                    
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
                                                                    
                                                                        <select class="form-select cont_person" name="ci_contact_person" id="" required></select>
                                                                     
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
                                                                        <input type="text" name="ci_payment_term" class="form-control payment_terms" required>
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
                                                                        <input type="text" name="ci_project"  class="form-control project_clz" required>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 

                                                            <input type="hidden" class="hidden_cash_invoice" name="ci_id">
                                                             



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
                                                                <td>Qty</td>
                                                                <td>Rate</td>
                                                                <td>Discount</td>
                                                                <td>Amount</td>
                                                               
                                                            </tr>
                                                         
                                                        </thead>
                                                        
                                                        <tbody  class="travelerinfo product-more2"></tbody>
                                                        
                                                    </table>
                                                </div>

                                                
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        
                                                        <div class="row row_align mb-4">
                                                            
                                                            <div class="col-lg-3">
                                                                <label for="basicInput" class="form-label">Credit Account</label>
                                                            </div>

                                                            <div class="col-lg-4">
                                                               
                                                                <select class="form-select" name="ci_credit_account" id="" required>
                                                                    
                                                                    <option value="" selected disabled>Select Credit Account</option>

                                                                    <?php foreach($charts_of_accounts as $chart_account){?> 
                                                                         <option value="<?php echo $chart_account->ca_id; ?>"><?php echo $chart_account->ca_name;?></option>
                                                                    <?php } ?>

                                                                </select>
                                                                     
                                                            </div>

                                                        </div>

                                                        <div class="row row_align mb-4">
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


                                       


			                        </div>
		                        </form>

	                        </div>
                        </div>


                        <!--modal content end-->



                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">Cash Invoice</h4>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#CashInvoice" class="btn btn-primary py-1 add_model_btn">Add</button>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <table id="DataTable" class="table table-bordered table-striped delTable display dataTable">
                                            <thead>
                                                <tr>
                                                    <th class="no-sort">Sl no</th>
                                                    <th>Cash Invoice No</th>
                                                    <th>Date</th>
                                                    <th>Customer</th>
                                                    <th>Sales Order</th>
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
                                        <td>Recipt Ref</td>
                                        <td>Amount</td>
                                        <td>Adjust</td>
                                        <td>Tick</td>
                                    </tr>
                                                            
                                                           
                                </thead>
                                                        
                                <tbody  class="travelerinfo">
                                    
                                    <tr>
                                        <td>1</td>
                                        <td><input type="date" name="" value="30-01-2024" class="form-control" required></td>
                                        <td><input type="text" name="" value="RF567" class="form-control" required></td>
                                        <td><input type="text" name="" value="420" class="form-control" required></td>
                                        <td><input type="text" name="" value="2" class="form-control" required></td>
                                        <td><input type="checkbox" name="" value="" class="" required></td>
                                    </tr>
                                    
                                </tbody>

                                

                            </table>
                            
                        </div>


                    </div>  
                                            
                                            
                </div>


                                        
			</div>
		</form>

	</div>

</div>

<!--save modal section end-->



<!--view section start-->

<div class="modal fade" id="ViewCashInvoice" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<form  class="Dashboard-form class" id="">
			<div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cash Invoice</h5>
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
                                                <input type="text" class="form-control view_reff" readonly>
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
                                                <input type="text" class="form-control view_date" readonly>
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
                                                
                                                <input type="text" class="form-control view_customer" readonly>

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

                                            <div class="col-col-md-9 col-lg-9">
                                                
                                                

                                              

                                                <input type="text" class="form-control view_sales_order" readonly>
                                                
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
                                                <label for="basicInput" class="form-label">LPO Reference</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                
                                            <input type="text" class="form-control view_lpo" readonly>
                                            
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
                                            
                                                <input type="text" class="form-control view_contact" readonly>

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
                                                <input type="text" class="form-control view_payment_terms" readonly>
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
                                                <input type="text" class="form-control view_project" readonly>
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
                                
                                <tbody  class="travelerinfo view_product"></tbody>
                          
                            </table>
                        </div>

                                                
                        <div class="row">
                            <div class="col-lg-6">
                                
                                <div class="row row_align mb-4">
                                    
                                    <div class="col-lg-3">
                                        <label for="basicInput" class="form-label">Credit Account</label>
                                    </div>

                                    <div class="col-lg-4">
                                        
                                        
                                        <input type="text" class="form-control view_credit_account" readonly>

                                        </select>
                                                
                                    </div>

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

<div class="modal fade" id="EditCashInvoice" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<form  class="Dashboard-form class" id="edit_cash_invoice">
			<div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cash Invoice</h5>
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
                                                <input type="text" name="ci_reffer_no"  class="form-control edit_reff" readonly>
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
                                                <input type="text" name="ci_date" class="form-control datepicker edit_date" required>
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
                                                

                                                <select class="form-select edit_customer" name="ci_customer" required></select>

                                            </div>

                                        </div> 

                                    </div>    
                                    <!-- ### --> 

                                                            

                                    <!-- Single Row Start -->
                                                            
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Sales Order <span class="add_more_icon ">Select</span></label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                
                                                

                                                <select class="form-select edit_sales_order" name="ci_sales_order" id="sales_order_add" style="width:80%;" required>

                                                    <option value="" selected disabled>Select Sales Order</option>
                                        
                                                </select>
                                                
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
                                                <label for="basicInput" class="form-label">LPO Reference</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                
                                            <input type="text" name="ci_lpo_reff" class="form-control edit_lpo_reff" required>
                                            
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
                                            
                                                <select class="form-select edit_contact_person" name="ci_contact_person" id="" required></select>
                                                
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
                                                <input type="text" name="ci_payment_term" class="form-control edit_payment_terms" required>
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
                                                <input type="text" name="ci_project"  class="form-control edit_project" required>
                                            </div>

                                        </div> 

                                    </div>    

                                    <!-- ### --> 

                                    <input type="hidden" class="edit_cash_invoice_id" name="ci_id">
                                                             
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
                                
                                <tbody  class="travelerinfo edit_product"></tbody>

                                <tbody class="add_more_class"></tbody>   
                                
                            </table>
                        </div>

                                                
                        <div class="row">
                            <div class="col-lg-6">
                                                        
                                <div class="row row_align mb-4">
                                                            
                                    <div class="col-lg-3">
                                        <label for="basicInput" class="form-label">Credit Account</label>
                                    </div>

                                    <div class="col-lg-4">
                                        
                                        <select class="form-select edit_charts_account" name="ci_credit_account" id="" required>
                                            
                                            

                                        </select>
                                                
                                    </div>

                                </div>

                                
                                <!--<div class="row row_align mb-4">
                                    <div class="col-lg-3">
                                        <label for="basicInput" class="form-label">Attach</label>
                                    </div>

                                    <div class="col-lg-4">
                                        <input type="file" name="ci_file"  class="form-control image_file">
                                    </div>

                                </div>--->

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
                    var formData = new FormData(currentForm);
                    // Submit the form for the current tab
                    $.ajax({
                        url: "<?php echo base_url(); ?>Crm/CashInvoice/Add",
                        method: "POST",
                        data: formData,
                        processData: false, // Don't process the data
                        contentType: false, // Don't set content type
                        success: function(data) {
                     
                            $('#add_form1')[0].reset();

                            //$('select').empty();

                            $('.cash_invoice_remove').remove();

                            //$('.cash_invoice_remove').val('').trigger('change');

                            $('#CashInvoice').modal('hide');

                            $('#SaveModal').modal('show');

                            alertify.success('Data Added Successfully').delay(3).dismissOthers();

                            checkedIds.length = 0;

                            datatable.ajax.reload(null, false);
                           
                        }
                    });
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
                'url': "<?php echo base_url(); ?>Crm/CashInvoice/FetchData",
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
                { data: 'ci_id' },
                { data: 'ci_reffer_no' },
                { data: 'ci_date'},
                { data: 'ci_customer'},
                { data: 'ci_sales_order'},
                { data: 'action'},
                
               ]
    
            });
        }

        $(document).ready(function () {
            initializeDataTable();
        });
        /*###*/


        $("body").on('change', '.customer_id', function(){ 

            var id = $(this).val();

           alert(id)
            
            //Fetch Contact Person
            $.ajax({

                url : "<?php echo base_url(); ?>Crm/CashInvoice/SalesOrder",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {   
                    var data = JSON.parse(data);

                    $(".sales_order_add_clz").html(data.sales_order);

                    $(".cont_person").html(data.contact_details);

                    $(".payment_terms").val(data.credit_term);

   
                }


            });

        });



        /**/
        $("body").on('change', '.sales_order_add_clz', function(){ 

            $('.cash_invoice_remove').remove();

            var id = $(this).val();

            var cust_id = $('.customer_id').val();
            
            //Fetch Contact Person
            $.ajax({

                url : "<?php echo base_url(); ?>Crm/CashInvoice/FetchSalesData",

                method : "POST",

                data: {ID: id,
                       custID:cust_id
                },

                success:function(data)
                {   
                    var data = JSON.parse(data);

                
                    $(".lpo_ref").val(data.so_lpo);

                    $(".project_clz").val(data.so_project);

                    //$(".product-more2").append(data.product_detail);

                    $(".cont_person").html(data.contact_detail);

                    $(".contactProduct3").html(data.select_table);
                    
                    slno();
                   
                }


            });

        });
        
        /**/



       


       
        /*customer droup drown search*/
        $(".customer_sel").select2({
            placeholder: "Select Customer",
            theme : "default form-control-",
            dropdownParent: $('#CashInvoice'),
            ajax: {
                url: "<?= base_url(); ?>Crm/CashInvoice/FetchCustomers",
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








        /*delete*/ 
        $("body").on('click', '.delete_btn', function(){ 
            
            if (!confirm('Are you absolutely sure you want to delete?')) return false;
            var id = $(this).data('id');
            $.ajax({

                url : "<?php echo base_url(); ?>Crm/CashInvoice/Delete",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {
                    alertify.success('Data Deleted Successfully').delay(2).dismissOthers();

                    datatable.ajax.reload(null,false);
                }


            });

        });
        /*###*/



        /*close select modal start*/

        $("body").on('click', '.select_modal_close', function(){ 
            
            $('#SelectProduct').modal('hide');

            $('#CashInvoice').modal('show');

        });

        /*close select modal end*/





        /*product section start*/

        var max_fieldspp      = 30;

        var pp = 1;

        $("body").on('click', '.add_product2', function(){
        
            var pp = $('.prod_row').length

            if(pp < max_fieldspp){ 
            
                pp++;
                
                $(".product-more2").append("<tr class='prod_row'><td class='si_no'>"+pp+"</td><td style='width:20%'><select class='form-select add_prod' name='cipd_prod_det[]' required=''><option value='' selected disabled>Select Product Description</option><?php foreach($products as $prod){?><option value='<?php echo $prod->product_id;?>'><?php echo $prod->product_details;?></option><?php } ?></select></td><td><input type='text'   name='cipd_unit[]' class='form-control ' required=''></td><td><input type='number' name='cipd_qtn[]' class='form-control qtn_clz_id' required=''></td><td><input type='number' name='cipd_rate[]' class='form-control rate_clz_id' required=''></td><td><input type='number' name='cipd_discount[]' class='form-control discount_clz_id' required=''></td><td><input type='number' name='cipd_amount[]' class='form-control amount_clz_id' required=''></td><td class='remove-btnpp' colspan='6'><div class='remainpass'><i class='ri-close-line'></i>Remove</div></td></tr>");

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

            $.ajax({
                        url: "<?php echo base_url(); ?>Crm/CashInvoice/Add",
                        method: "POST",
                        data: formData,
                        processData: false, // Don't process the data
                        contentType: false, // Don't set content type
                        success: function(data) {

                            var data = JSON.parse(data);

                            var id = data.sales_order;

                            var cash_invoice = data.cash_invoice;
                         
                            $('.hidden_cash_invoice').val(cash_invoice);
  
                            $('#SelectProduct').modal('show');

                            $('#CashInvoice').modal('hide');

                            $.ajax({

                                url : "<?php echo base_url(); ?>Crm/CashInvoice/AddProduct",

                                method : "POST",

                                data: {ID: id,cashInvoice: cash_invoice},
                                
                                success:function(data)
                                {   
                                    var data = JSON.parse(data);
                                    
                                    $(".select_prod_add").html(data.product_detail);
                                    
                                    //console.log(data.product_detail);

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

       /*function TotalAmount()
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

           $(".performa_amount_in_word").text(resultSalesOrder);

           $(".performa_amount_in_word_val").val(resultSalesOrder);
           
           currentClaim()
       }*/

       /*total amount calculation end*/


       /*prod modal submit start*/

       $("body").on('click', '.prod_modal_submit', function(){ 

            var selectId = $('#select_prod_id').val();

            $.ajax({

                url : "<?php echo base_url(); ?>Crm/CashInvoice/SelectedProduct",

                method : "POST",

                data: {ID: selectId},

                success:function(data)
                {
                
                    var data = JSON.parse(data);
                                    
                    $('.product-more2').html(data.product_detail);

                    $('#SelectProduct').modal("hide");

                    $('#CashInvoice').modal("show");

                    $('.selected_table').show();
                }

            });

        });


    /*prod modal submit end*/


    /*reset reffer no*/ 
    $('.add_model_btn').click(function(){

        $.ajax({

            url : "<?php echo base_url(); ?>Crm/CashInvoice/FetchReference",

            method : "GET",

            success:function(data)
            {

                $('#ciid').val(data);

            }
        });

    });

    /*####*/


    /*view section start*/
     
  
    $("body").on('click', '.view_btn', function(){ 
            
        $('#ViewCashInvoice').modal('show');

        var id = $(this).data('id'); 

        $.ajax({

            url : "<?php echo base_url(); ?>Crm/CashInvoice/View",

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
                
                //console.log(data.prod_details);

            
            }

        });

        
    });

    /*view section end*/



    /*edit section start*/
    
    $("body").on('click', '.edit_btn', function(){ 
            
            $('#EditCashInvoice').modal('show');
    
            var id = $(this).data('id'); 
    
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

                    $('.edit_project').val(data.project);

    
                    /*$('.view_credit_account').val(data.credit_account);
    
                    $('.view_image_table').html(data.image_table)*/;

                    $('.edit_product').html(data.prod_details);

                    $('.edit_cash_invoice_id').val(data.cash_invoice_id);

                    $('.edit_charts_account').html(data.charts_of_account);

                    $('.add_more_class').html(data.add_more);
                    
                    //console.log(data.prod_details);
    
                
                }
    
            });
    
            
        });


        $("body").on('click', '.edit_customer', function(){ 
            
            $('#EditCashInvoice').modal('show');
    
            var id = $(this).data('id'); 
    
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

                    $('.edit_project').val(data.project);

    
                    /*$('.view_credit_account').val(data.credit_account);
    
                    $('.view_product').html(data.prod_details);
    
                    $('.view_image_table').html(data.image_table)*/;
                    
                    //console.log(data.sales_orders);
    
                
                }
    
            });
    
            
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
                        url: "<?php echo base_url(); ?>Crm/CashInvoice/Update",
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

                            $('#EditCashInvoice').modal('hide');

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
                     
                     $('#EditCashInvoice').modal('hide');
 
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
                    $('#EditCashInvoice').modal('hide');

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


    


    });


    /*checkbox section start*/

    var checkedIds = [];

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


    /*checkbox section end*/



</script>