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
.cust_more_modal {
    
        position: absolute;
        right: 32px;
        top: -16px;
        font-size: 25px;
        color: #ff0000b5;

}

.select2.select2-container{
    width: 95% !important;
}
.disabled-span{
    pointer-events: none;
    opacity: 0.5;
    cursor: not-allowed;
}
.cust_more_modal{

    right: 18px;
    top: -7px;
}
.btn-success{
    background: #00AF50;
}

.once_form_submit {
    
    padding: 8px 16px;
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
    width: 28% !important;
   
   
}
span.select2.customer_width, span.select2 {
    
    display: flex;
    align-items: center;
}
.select_prod_add td{

    padding: 10px 10px !important;
    vertical-align: middle;
    text-align: center;
}

.total_table td{
    
    border: 1px solid black !important;
   
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
                        
                        <!--credit invoice section start-->

                        <div class="modal fade" id="CreditInvoice" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" data-product="false" id="add_form1">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Credit Invoice</h5>
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
                                                                        <input type="text" name="cci_reffer_no" id="uid" value="" class="form-control input_length" required>
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
                                                                        <input type="text" name="cci_date" autocomplete="off" class="form-control datepicker_ap input_length" required readonly>
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
                                                                        
                                                                        <select class="form-select customer_sel customer_id input_length" name="cci_customer" required></select>
                                                               
                                                                        
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 



                                                            <!--Single Row Start-->


                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2 margin_zero">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Credit Account</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                      
                                                                        <select class="form-select input_length credit_select input_length" name="ci_credit_account" id="" required></select>
                                                                        
                                                                    </div>

                                                                </div> 

                                                            </div> 


                                                            <!--####-->

                                                            

                                                            <!-- Single Row Start -->
                                                            
                                                            
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2 margin_zero">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Sales Order <span class="add_more_icon cust_more_modal  ri-add-line" id="blink"></span></label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                      
                                                                        <select class="form-select sales_order_add_clz input_length" name="cci_sales_order" id="sales_order_add" required>

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

                                                                <div class="row align-items-center mb-2 margin_zero">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">LPO Reference</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        
                                                                        <input type="text" name="cci_lpo_reff" class="form-control lpo_ref input_length" required>
                                                                    
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
                                                                        
                                                                   
                                                                        <select class="form-select cont_person input_length" name="cci_contact_person" id="" required></select>
                                                                   
                                                                    
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
                                                                        <input type="text" name="cci_payment_term" class="form-control payment_term_clz input_length" required>
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
                                                                        <input type="text" name="cci_project"  class="form-control project_clz input_length" required>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 

                                                            <input type ="hidden" name="cci_id" class="hidden_credit_invoice_id">


                                                             



                                                        </div>

                                                    </div>
                                                                                          

                                                </div>


                                                <!--table section start-->
                                                <div class="mt-4 content_table">
                                                    <table class="table table-bordered table-striped delTable add_table">
                                                        <thead class="travelerinfo contact_tbody">
                                                            <tr>
                                                                <td style="width:10%">DN No.</td>
                                                                <td>Product Description</td>
                                                                <td style="width:6%">Unit</td>
                                                                <td style="width:6%">Qty</td>
                                                                <td style="width:6%">Rate</td>
                                                                <td style="width:7%">Discount</td>
                                                                <td style="width:9%">Amount</td>
                                                                

                                                            </tr>
                                                         
                                                        </thead>
                                                        
                                                        <tbody  class="travelerinfo product_more2"></tbody>
                                                        <!--<tbody>
                                                            <tr>
                                                                <td colspan="8" align="center" class="tecs">
                                                                    <span class="add_icon add_product2"><i class="ri-add-circle-line"></i>Add </span>
                                                                </td>
                                                            </tr>
                                                        </tbody>--->
                                                        
                                                       
                                                    </table>

                                                    <table class="total_table">
                                                        <tbody>
                                                            <tr>
                                                                
                                                                
                                                                <input type="hidden" name="pf_total_amount_in_words" class="performa_amount_in_word_val">
                                                                <td align="right" class="total_label">Total</td>
                                                                <td><input type="text" name="cci_total_amount" class="amount_total form-control text-end" readonly></td>
                                                            </tr>

                                                            <tr>
                                                                
                                                                <td align="right" class="total_label">Advance Paid</td>
                                                                <td><input type="text" name="cci_advance_amount" class="amount_advance form-control text-end" readonly></td>
                                                            </tr>


                                                            <!--<tr>
                                                                
                                                                
                                                                <input type="hidden" name="pf_total_amount_in_words" class="performa_amount_in_word_val">
                                                                <td align="right" class="total_label">Total</td>
                                                                <td><input type="text" name="cci_total_amount" class="amount_total form-control text-end" readonly></td>
                                                            </tr>-->
                                                            
                                                          
                                                        </tbody>
                                                    </table>
                                                </div>

                                                
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        
                                                        

                                                        <div class="row row_align mb-4">
                                                            <div class="col-lg-3">
                                                                <label for="basicInput" class="form-label" style="display:none">Attach</label>
                                                            </div>

                                                            <div class="col-lg-4">
                                                                <input type="file" name="" style="display:none"  class="form-control image_file">
                                                            </div>

                                                        </div>


                                                        
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="modal-footer justify-content-center">
                                                            <button class="btn btn btn-success once_form_submit" type="submit">Save</button>
                                                            <span class="print_btn_clz " style="display:none"><button class="btn btn btn-success"  name="print_btn" type="submit" value="1">Print</button></span>
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

                                                    </div>-->
                                                </div>
                                                
                                                
                                             

                                                <!--table section end-->


                                            </div>  
                                            
                                            
                                             


					                           
						                    
				                        </div>


                                        
			                        </div>
		                        </form>

	                        </div>
                        </div>


                        
                        <!--credit invoice section  end-->



                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">Credit Invoice</h4>
                                        <button type="button" class="btn btn-primary py-1 add_model_btn">Add</button>
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
                                                    <th>Total Amount</th>
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
                                                
                        <div class="mt-4 content_table">
                            
                            <table class="table table-bordered table-striped delTable add_table">
                                
                                <thead class="travelerinfo contact_tbody">
                                    
                                    <tr>
                                        <td style="width: 4%;">SI</td>
                                        <td>Product Description</td>
                                        <td style="width: 10%;">Delivery Note</td>
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



<!--edit section start-->

<div class="modal fade" id="EditCreditInvoice" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<form  class="Dashboard-form class" id="edit_credit_invoice">
			<div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Credit Invoice</h5>
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
                                                <input type="text" name="cci_reffer_no" id=""  class="form-control edit_reff input_length" required readonly>
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
                                                <input type="text" name="cci_date" autocomplete="off" class="form-control datepicker edit_data input_length" required readonly>
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
                                                
                                                <select class="form-select edit_customer input_length" name="cci_customer"  required></select>
                                        
                                                
                                            </div>

                                        </div> 

                                    </div>    

                                    <!-- ### --> 

                                                            

                                    <!-- Single Row Start -->
                                    
                                    
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2 margin_zero">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Sales Order</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                
                                                <!--<select class="form-select edit_sales_order" name="cci_sales_order"  id="sales_order_add" style="width:80%;" required>

                                                    <option value="" selected disabled>Select Sales Order</option>

                                                </select>--->

                                                <input type="text" name="cci_sales_order" class="form-control edit_sales_order input_length" required readonly>

                                                
                                            </div>

                                        </div> 

                                    </div>    

                                    
                                    <!-- ### --> 


                                    <!-- Single Row Start -->
                                    
                                    
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2 margin_zero">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Credit Account</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                
                                                <select class="form-select edit_charts_account input_length" name="ci_credit_account" id="" required></select>

                                                
                                                
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

                                            <input type="text" name="cci_lpo_reff" class="form-control edit_lpo_reff input_length" required>

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
                                            
                                        
                                        <select class="form-select edit_cont_person input_length" name="cci_contact_person" id="" required></select>
                                        
                                        
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
                                            <input type="text" name="cci_payment_term" class="form-control edit_payment_term_clz input_length" required>
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
                                            <input type="text" name="cci_project"  class="form-control edit_project_clz input_length" required>
                                        </div>

                                    </div> 

                                </div>    

                                <!-- ### --> 

                                <input type ="hidden" name="cci_id" class="edit_credit_invoice_id">


                            </div>

                        </div>
                    
                    </div>


                    <!--table section start-->
                    <div class="mt-4 content_table">
                        <table class="table table-bordered table-striped delTable" style="margin:0px">
                            <thead class="travelerinfo contact_tbody">
                                <tr>
                                    <td style="width: 4%;">SI</td>
                                    <td style="width: 11%;">DN NO</td>
                                    <td>Product Description</td>
                                    <td style="width: 6%;">Unit</td>
                                    <td style="width: 6%;">Qty</td>
                                    <td style="width: 8%;">Rate</td>
                                    <td style="width: 7%;">Discount</td>
                                    <td style="width: 9%;">Amount</td>
                                    
                                    

                                </tr>
                                
                            </thead>
                            
                            <tbody  class="travelerinfo edit_product_table"></tbody>

                            
                           
                            
                        </table>
                        <table class="total_table">
                            <tbody  class="travelerinfo edit_total_amount"></tbody>
                        </table>
                    </div>

                                                
                    <div class="row">
                        <div class="col-lg-6">
                                                        
                            
                            <div class="row row_align mb-4">
                                <div class="col-lg-3">
                                    <label for="basicInput" class="form-label" style="display:none">Attach</label>
                                </div>

                                <div class="col-lg-4">
                                    <input type="file" name="" style="display:none"  class="form-control image_file">
                                </div>

                            </div>
                        </div>
                        
                        <div class="col-lg-12">

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



<!--edit setion end-->



<!---view section start-->

<div class="modal fade" id="ViewCreditInvoice" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
		<form  class="Dashboard-form class" id="">
			<div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Credit Invoice</h5>
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
                                                <input type="text" name="" id=""  class="form-control view_reff" required readonly>
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
                                                <input type="text" name="" class="form-control view_date" required readonly>
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
                                                
                                                <!--<select class="form-select view_customer" name="" required></select>-->
                                                <input type="text" name="" class="form-control view_customer" required readonly>
                                        
                                                
                                            </div>

                                        </div> 

                                    </div>    

                                    <!-- ### --> 

                                                            

                                    <!-- Single Row Start -->
                                    
                                    
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2 margin_zero">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Sales Order</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                
                                                <!--<select class="form-select view_sales_order" name="" id=""  required>

                                                    <option value="" selected disabled>Select Sales Order</option>

                                                </select>--->

                                                <input type="text" name="" class="form-control view_sales_order" required readonly>
                                                
                                            </div>

                                        </div> 

                                    </div>    

                                    
                                    <!-- ### --> 

                                    <!-- Single Row Start -->
                                    
                                    
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2 margin_zero">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Credit Account</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                
                                                <input type="text" name=""  class="form-control view_credit_account" required readonly>

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
                                                
                                                <input type="text" name="" class="form-control view_lpo_reff" required readonly>

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
                                                
                                            
                                           
                                            <input type="text" name="" class="form-control view_contact_person" required readonly>
                                            
                                            
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
                                                <input type="text" name="" class="form-control view_payment_term" required readonly>
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
                                                <input type="text" name=""  class="form-control view_project" required readonly>
                                            </div>

                                        </div> 

                                    </div>    

                                    <!-- ### --> 

                                    


                                </div>

                            </div>
                                                                                          

                        </div>


                        <!--table section start-->
                        <div class="mt-4 content_table">
                            <table class="table table-bordered table-striped delTable " style="margin:0px;">
                                <thead class="travelerinfo contact_tbody">
                                    <tr>
                                        <td class="text-center" style="width: 4%;">SI</td>
                                        <td class="text-center" style="width: 11%;">Delivery Reffer</td>
                                        <td class="text-center">Product Description</td>
                                        <td class="text-center" style="width: 6%;">Unit</td>
                                        <td class="text-center" style="width: 6%;">Qty</td>
                                        <td class="text-center" style="width: 6%;">Rate</td>
                                        <td class="text-center" style="width: 7%;">Discount</td>
                                        <td class="text-center" style="width: 9%;">Amount</td>
                                        

                                    </tr>
                                                         
                                </thead>
                                                        
                                <tbody  class="travelerinfo view_prod_table"></tbody>


                               
                                                       
                                
                                                       
                            </table>

                            <table class="total_table">
                                 
                                <tbody  class="travelerinfo view_total_amount" ></tbody>

                            </table>
                            
                        </div>

                                                
                        <div class="row">
                            <div class="col-lg-6">
                                                        
                                

                                <div class="row row_align mb-4">
                                    <div class="col-lg-3">
                                        <label for="basicInput" class="form-label" style="display:none">Attach</label>
                                    </div>

                                    <!--<div class="col-lg-4">
                                        <input type="file" name="" style="display:none"  class="form-control image_file">
                                    </div>-->

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


<!--view section end-->


<!--adjustment modal section start-->


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
                                                        
                                <tbody  class="travelerinfo adjustment_table">
                                    
                                    <!--<tr>
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


<!--adjustment modal section end-->




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

                    if($('#add_form1').attr('data-product')=="true")
                    {   
                        $('.once_form_submit').attr('disabled', true); // Disable this input.
                        $.ajax({
                            url: "<?php echo base_url(); ?>Crm/CreditInvoice/Add",
                            method: "POST",
                            data: $(currentForm).serialize(),
                            success: function(data) {

                                var data = JSON.parse(data);

                                $('#add_form1')[0].reset();
                            
                                $('#CreditInvoice').modal('hide');

                                $('.delivery_note_remove').remove();

                                $('.hidden_credit_invoice_id').val("");

                                $('.customer_id').val('').trigger('change');

                                $('.adjustment_table').html(data.adjustment_data);

                                alertify.success('Data Added Successfully').delay(3).dismissOthers();

                                datatable.ajax.reload(null, false);

                                checkedIds.length = 0;

                                if(data.advance_status ==="true")
                                {
                                    $('#SaveModal').modal('show');
                                }

                                if(data.print!="")
                                {
                                   // window.open(data.print, '_blank');

                                   id = data.print;
                                   // Open the PDF generation script in a new window

                                    var pdfWindow = window.open('<?= base_url()?>Crm/CreditInvoice/Pdf/'+id, '_blank');

                                    // Automatically print when the PDF is loaded
                                    pdfWindow.onload = function() {
                                        pdfWindow.print();
                                    };
                                }


                                TotalAmount();
                            
                            
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




        $(function() {
            var form = $('#add_form3');
            
            form.validate({
                rules: {
                    required: 'required',
                },
                messages: {
                    required: 'This field is required',
                },
                errorPlacement: function(error, element) {} ,
                submitHandler: function(currentForm) {
                    // Create FormData object to handle file uploads
                    var formData = new FormData(currentForm);

                    // Submit the form for the current tab
                    $.ajax({
                        url: "<?php echo base_url(); ?>Crm/CreditInvoice/AddTab3",
                        method: "POST",
                        data: formData,
                        processData: false, // Don't process the data
                        contentType: false, // Don't set content type
                        success: function(data) {
                            $('#add_form1')[0].reset();
                            $('#add_form2')[0].reset();
                            $('#add_form3')[0].reset();
                            $('#AddModal').modal('hide');
                            alertify.success('Data Added Successfully').delay(3).dismissOthers();
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
                'url': "<?php echo base_url(); ?>Crm/CreditInvoice/FetchData",
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
                { data: 'cci_id' },
                { data: 'cci_reffer_no'},
                { data: 'cci_date'},
                { data: 'cci_customer'},
                { data: 'cci_sales_order'},
                { data: 'cci_total_amount'},
                { data: 'action'},
                
               ],

               "initComplete": function () {

                    var dataId = '<?php echo isset($_GET['view_crn']) ? $_GET['view_crn'] : ''; ?>';

                    $('#DataTable').dataTable().fnFilter(dataId);

                },

                "drawCallback": function() {

                $('.view_btn[data-id="<?php echo isset($_GET['view_crn']) ? $_GET['view_crn'] : ''; ?>"]').trigger('click');

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

                url : "<?php echo base_url(); ?>Crm/CreditInvoice/SalesOrder",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {   
                    var data = JSON.parse(data);
  
                    $(".sales_order_add_clz").html(data.sales_order);

                    $(".cont_person").html(data.contact_person);
                    
                }


            });



        });



        /*fetch other data with sales order*/

        $("body").on('change', '.sales_order_add_clz', function(){ 
            
            $('.credit_invoice_remove').remove();

            var id = $(this).val();

            var cust_id = $('.customer_id').val();

            $.ajax({

                url : "<?php echo base_url(); ?>Crm/CreditInvoice/FetchSalesData",

                method : "POST",

                data: {ID: id,
                       custID: cust_id,
                },

                success:function(data)
                {   
                    var data = JSON.parse(data);

                    $(".lpo_ref").val(data.so_lpo);

                    $(".project_clz").val(data.so_project);

                    $(".payment_term_clz").val(data.so_payment_term);

                    $(".cont_person").html(data.contact_person);

                    $('.amount_advance').val(data.sales_order_advance);

                    console.log(data.sales_order_advance);

                    $(".lpo_ref").removeClass("error")

                    $(".cont_person").removeClass("error")

                    $(".payment_term_clz").removeClass("error")

                    $(".project_clz").removeClass("error")

                    //$(".product_more2").append(data.product_detail);

                    TotalAmount();
                    
                }


            });

        });

        /*###*/






        /**/
        /*$("body").on('change', '.delivery_note', function(){ 
            
          
            
            var id = $(this).val();
            
            //Fetch Contact Person
            $.ajax({

                url : "<?php echo base_url(); ?>Crm/CreditInvoice/FetchSalesData",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {   
                    var data = JSON.parse(data);
                
                    $(".sales_order_add_clz").html(data.sales_order);

                    $(".lpo_ref").val(data.dn_lpo_reference);

                    //$(".so_contact_person").val(data.so_lpo);

                    $(".cont_person").val(data.dn_conact_person);

                    $(".project_clz").val(data.dn_project);

                    $(".prod_table_clz").html(data.product_detail);
                    
                    
                }


            });

        });*/
        /**/



        /*delete*/ 
        $("body").on('click', '.delete_btn', function(){ 
            
            if (!confirm('Are you absolutely sure you want to delete?')) return false;
            var id = $(this).data('id');
            $.ajax({

                url : "<?php echo base_url(); ?>Crm/CreditInvoice/Delete",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {
                    var data = JSON.parse(data);

                    if(data.status === 1)
                    {
                        alertify.success(data.msg).delay(2).dismissOthers();
                        datatable.ajax.reload(null,false);
                    }
                    else
                    {
                        alertify.error(data.msg).delay(2).dismissOthers();
                    }
                    
                }


            });

        });
        /*###*/


       
       



        /*customer droup drown search*/
        $(".customer_sel").select2({
            placeholder: "Select Customer",
            theme : "default form-control- customer_width",
            dropdownParent: $('#CreditInvoice'),
            ajax: {
                url: "<?= base_url(); ?>Crm/CreditInvoice/FetchCustomers",
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



        /* Fetch Sales Orders */



        /*onchange function Sales Order Number*/

        /*$('#sales_order_add').change(function(){

            var id = $(this).val();

            $.ajax({

            url : "<?php echo base_url(); ?>Crm/ProFormaInvoice/FetchSalesOrder",

            method : "POST",

            data : {id:id},

            success:function(data)
            {
                var data = JSON.parse(data);
                
                $('#product_detail_table').html(data.saleorder_output);

            }


            });


        });*/

        /**/


        /*product edit start*/

        $("body").on('click', '.product_edit', function(){ 

            $("#EditCreditInvoice").modal("hide");

            $("#EditProduct").modal("show");

            var id = $(this).data('id');

            $.ajax({

                url : "<?php echo base_url(); ?>Crm/CreditInvoice/EditProduct",

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




        /*product detail calculation*/
        
        $("body").on('keyup', '.discount_clz_id , .qtn_clz_id , .rate_clz_id', function(){ 
            
           
            var discount = $(this).val();

            var discountSelect = $(this);

            var rateSelectElement = discountSelect.closest('.prod_row').find('.rate_clz_id');

            var rate = rateSelectElement.val();

            var quantitySelectElement = discountSelect.closest('.prod_row').find('.qtn_clz_id');

            var quantity = quantitySelectElement.val();

            var discountSelectElement = discountSelect.closest('.prod_row').find('.discount_clz_id');

            var dicount_data = discountSelectElement.val();

            var parsedRate = parseFloat(rate);

            var parsedQuantity = parseFloat(quantity); 

            var multipliedTotal = parsedRate * parsedQuantity;

            var result = dicount_data / 100;

            var orginalPrice = multipliedTotal * result

            var $amountElement = discountSelect.closest('.prod_row').find('.amount_clz_id');

            $amountElement.val(orginalPrice);

            TotalAmount();

        });

        /*###*/

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
            

        }

        /*total amount calculation end*/


        /*delete product detail row*/

        $("body").on('click', '.row_remove', function(){ 
	   
            var id = $(this).data('id');

            $('#' + id).fadeOut('fast', function() {
        
                $(this).remove();

            });

          
        });

        /**/

        
        /*product section start*/

        var max_fieldspp      = 30;

        var pp = 1;

        $("body").on('click', '.add_product2', function(){
        
            var pp = $('.prod_row').length

            if(pp < max_fieldspp){ 
            
                pp++;
                
                $(".product_more2").append("<tr class='prod_row'><td class='si_no'>"+pp+"</td><td style='width:20%'><select class='form-select add_prod' name='ipd_prod_detl[]' required=''><option value='' selected disabled>Select Product Description</option><?php foreach($products as $prod){?><option value='<?php echo $prod->product_id;?>'><?php echo addslashes($prod->product_details);?></option><?php } ?></select></td><td><input type='text' name='ipd_unit[]' class='form-control ' required=''></td><td><input type='number' name='ipd_quantity[]' class='form-control qtn_clz_id' required=''></td><td><input type='number' name='ipd_rate[]' class='form-control rate_clz_id' required=''></td><td><input type='number' name='ipd_discount[]' class='form-control discount_clz_id' required=''></td><td><input type='number' name='ipd_amount[]' class='form-control amount_clz_id' required=''></td><td class='remove-btnpp' colspan='6'><div class='remainpass'><i class='ri-close-line'></i>Remove</div></td></tr>");

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


        /*InitProductSelect2*/
        
            function InitProductSelect2(){
            $(".add_prod:last").select2({
                placeholder: "Select Product",
                theme : "default form-control-",
                dropdownParent: $($('.add_prod:last').closest('.prod_row')),
                ajax: {
                    url: "<?= base_url(); ?>Crm/ProFormaInvoice/FetchProducts",
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

        /**/





        /*credit account droup drown search*/
        $(".credit_select").select2({
            placeholder: "Select Credit Account",
            theme : "default form-control- customer_width",
            dropdownParent: $('#CreditInvoice'),
            ajax: {
                url: "<?= base_url(); ?>Crm/CreditInvoice/CreditAccount",
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
                        results: $.map(data.result, function (item) { return {id: item.ca_id, text: item.ca_name}}),
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
                        url: "<?php echo base_url(); ?>Crm/CreditInvoice/Add",
                        method: "POST",
                        data: formData,
                        processData: false, // Don't process the data
                        contentType: false, // Don't set content type
                        success: function(data) {

                            var data = JSON.parse(data);

                            var id = data.sales_order;

                            var credit_invoice_id = data.credit_invoice_id;


                           $('.hidden_credit_invoice_id').val(data.credit_invoice_id);
  
                            $('#SelectProduct').modal('show');

                            $('#CreditInvoice').modal('hide');

                            $('#add_form1').attr('data-product','true');

                            $.ajax({

                                url : "<?php echo base_url(); ?>Crm/CreditInvoice/AddProduct",

                                method : "POST",

                                data: {ID: id,CreditInvoiceID :credit_invoice_id},
                                
                                success:function(data)
                                {   
                                    var data = JSON.parse(data);
                                    
                                    $(".select_prod_add").html(data.product_detail);
                                    
                                    if(data.prod_status === "false")
                                    {   
                                        $('#SelectProduct').modal('hide');

                                        alertify.error('Please Create Delivery Note').delay(4).dismissOthers();

                                        return false;
                                    }

                                    
		                            ProductsSelect2Edit();

                                    
                                }   

                            });

                           
                            
                        }
                    });

         });


        /*#######*/



        /*prod modal submit start*/

        $("body").on('click', '.prod_modal_submit', function(){ 

            var selectId = $('#select_prod_id').val();

            $('.print_btn_clz').css('display', 'block');

            checked = $("input[type=checkbox]:checked").length;

            if(!checked) {
                alert("You must check at least one checkbox.");
                return false;
            }


            $.ajax({

                url : "<?php echo base_url(); ?>Crm/CreditInvoice/SelectedProduct",

                method : "POST",

                data: {ID: selectId},

                success:function(data)
                {
                
                    var data = JSON.parse(data);
                                    
                    $('.product_more2').html(data.product_detail);

                    $('#SelectProduct').modal("hide");

                    $('#CreditInvoice').modal("show");

                    $('.selected_table').show();

                    checkedIds.length = 0;

                    TotalAmount();

                    ProductsSelect2Edit();
                }

            });
        });


        /* Select 2 Remove Validation On Change */
        $("select[name=cci_customer]").on("change",function(e) {
            $(this).parent().find(".error").removeClass("error");         
        });
        /*###*/


        /*prod modal submit end*/



        /*edit section start*/

        $("body").on('click', '.edit_btn', function(){ 

            //var selectId = $('#select_prod_id').val();

            var id = $(this).data('id');

            

            $.ajax({

                url : "<?php echo base_url(); ?>Crm/CreditInvoice/Edit",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {

                    var data = JSON.parse(data);
                    
                    if(data.status === 0){

                        alertify.error(data.msg).delay(3).dismissOthers();

                    }else
                    {
                        $('.edit_reff').val(data.reffer_no);

                        $('.edit_data').val(data.date);

                        $('.edit_customer').html(data.customer);

                        $('.edit_sales_order').val(data.sales_order);

                        $('.edit_lpo_reff').val(data.lpo_reff);

                        $('.edit_cont_person').html(data.contact_person);

                        $('.edit_payment_term_clz').val(data.payment_term);

                        $('.edit_project_clz').val(data.project);

                        $('.edit_credit_invoice_id').val(data.credit_invoice_id);

                        $('.edit_product_table').html(data.product_detail);

                        $('.edit_charts_account').html(data.charts_account);

                        $('.edit_total_amount').html(data.total_amount);

                        $('#EditCreditInvoice').modal('show')
                    }
                    


                }

            });
        });


        /*update section start*/
        
        $(function() {
            var form = $('#edit_credit_invoice');
            
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
                        url: "<?php echo base_url(); ?>Crm/CreditInvoice/Update",
                        method: "POST",
                        data: $(currentForm).serialize(),
                        success: function(data) {

                            //TotalAmount();

                            /*$('#add_form1')[0].reset();
                           
                            $('#CreditInvoice').modal('hide');

                            alertify.success('Data Added Successfully').delay(3).dismissOthers();

                            datatable.ajax.reload(null, false);*/

                            $('#EditCreditInvoice').modal('hide');

                            alertify.success('Data Update Successfully').delay(3).dismissOthers();

                            datatable.ajax.reload(null, false);
                           
                           
                        }
                    });
                }
            });
        });
        

        /*####*/


       




        /*edit section end*/



        /*view section start*/
        
        $("body").on('click', '.view_btn', function(){ 

            var id = $(this).data('id');

            

            $.ajax({

                url : "<?php echo base_url(); ?>Crm/CreditInvoice/View",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {

                    var data = JSON.parse(data);
                                    
                    //console.log(data.customer);

                    $('.view_reff').val(data.reffer_no);

                    $('.view_date').val(data.date);

                    $('.view_customer').val(data.customer);

                    $('.view_sales_order').val(data.sales_order);

                    $('.view_lpo_reff').val(data.lpo_reff);

                    $('.view_contact_person').val(data.contact_person);

                    $('.view_payment_term').val(data.payment_term);

                    $('.view_project').val(data.project);

                    $('.view_credit_account').val(data.charts_account);

                    $('.view_prod_table').html(data.product_detail);

                    $('.view_total_amount').html(data.total_amount);
                    
                    
                    /*$('.edit_credit_invoice_id').val(data.credit_invoice_id);

                    $('.edit_product_table').html(data.product_detail);

                    $('.edit_charts_account').html(data.charts_account);

                    console.log(data.charts_account);*/

                    $('#ViewCreditInvoice').modal('show')

                }

            });
        });

        /*view section end*/


        /*reset reffer id*/

        $('.add_model_btn').click(function(){

            $('#add_form1')[0].reset();

            $('.print_btn_clz').css('display', 'none');
                                
            $('#CreditInvoice').modal('hide');

            $('.delivery_note_remove').remove();

            $('.hidden_credit_invoice_id').val("");

            $('.customer_id').val('').trigger('change');

            $('.sales_order_add_clz   option').remove();

            $('.cont_person  option').remove();

            $('#add_form1').attr('data-product','false');

            $('.once_form_submit').attr('disabled', false); // Disable this input.

            $(".cust_more_modal").removeClass("disabled-span");

            $.ajax({

                url : "<?php echo base_url(); ?>Crm/CreditInvoice/AddAccess",

                method : "POST",

                success:function(data)
                {

                    var data = JSON.parse(data);

                    if(data.status === 0){
                    
                        alertify.error(data.msg).delay(3).dismissOthers();

                    }
                    else{

                        $('#CreditInvoice').modal('show');

                    }
                    

                }

            });

            $.ajax({

                url : "<?php echo base_url(); ?>Crm/CreditInvoice/FetchReference",

                method : "GET",

                success:function(data)
                {

                    $('#uid').val(data);

                }

            });
        });

        /*######*/


        $('.adjustment_close').click(function(){ 
           
           $('#SaveModal').modal('hide');
   
           alertify.success('Data added Successfully').delay(2).dismissOthers();
   
           datatable.ajax.reload(null,false);
   
       });


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
                        url: "<?php echo base_url(); ?>Crm/CreditInvoice/UpdateProduct",
                        method: "POST",
                        data: $(currentForm).serialize(),
                        success: function(data) {

                            var responseData = JSON.parse(data);

                            var salesId = responseData.credit_invoice
                            
                            $('#EditProduct').modal('hide');

                            $('#EditCreditInvoice').modal('show');

                            $('.edit_btn[data-id="'+salesId+'"]').trigger('click');

                            alertify.success('Data update Successfully').delay(3).dismissOthers();

                            datatable.ajax.reload(null,false)
                            
                        }
                    });
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


        $('body').on('click','.print_color',function(e){
    
            id = $(this).attr('data-id');
            // Open the PDF generation script in a new window

            var pdfWindow = window.open('<?= base_url()?>Crm/CreditInvoice/Pdf/'+id, '_blank');

            // Automatically print when the PDF is loaded
            pdfWindow.onload = function() {
                pdfWindow.print();
            };

        });


        $('.datepicker_ap').change(function(){

            var date = $(this).val();

            $.ajax({

                url: "<?php echo base_url(); ?>Crm/CreditInvoice/FetchReference/r/"+date+"",

                method: "POST",

                success: function(data) {
                    
                    $('#uid').val(data);

                }
            });


        })


        /**/
        function ProductsSelect2Edit() {
            $('body .product_select2_edit').each(function() {
                $(this).select2({
                    placeholder: "Select Product",
                    theme: "default form-control- select_width",
                    dropdownParent: $($(this).closest('.prod_row')),
                    ajax: {
                        url: "<?= base_url(); ?>Crm/CreditInvoice/FetchProducts",
                        dataType: 'json',
                        delay: 250,
                        cache: false,
                        minimumInputLength: 1,
                        allowClear: false,
                        data: function(params) {
                            return {
                                term: params.term,
                                page: params.page || 1,
                            };
                        },
                        processResults: function(data, params) {

                            var page = params.page || 1;
                            return {
                                results: $.map(data.result, function(item) {
                                    return {
                                        id: item.product_id,
                                        text: item.product_details
                                    }
                                }),
                                pagination: {
                                    more: (page * 10) <= data.total_count
                                }
                            };
                        },
                    }
                })

            });


        }
        /**/



       


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