<style>
    .cust_more_modal{
        
        position: absolute;
        left: 470px;
        padding: 1px 27px;
        z-index: 999;
        border: 1px solid black;
        border: 1px solid #0000003b;

    }
    span.select2.customer_width {

        width: 80% !important;
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
    .selectize-input
    {
        border: unset;
    }
    .selectize-input
    {
        margin-bottom: 5px;
        border: unset;
        border-bottom: 1px solid #0000003b;
        border-radius: 0px;
    }
    .selectize-control.single .selectize-input
    {
        background-color: unset;
        background-image: unset;
        background-repeat: unset;
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
                        
                        <!--sales quotation modal start-->
                        <div class="modal fade" id="SalesQuotation" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="add_form1">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Sales Quotation</h5>
                                            <button type="button" class="btn-close  quotation_close_modal" data-bs-dismiss="modal"></button>
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
                                                                        <input type="tex" name="qd_reffer_no" id="qd_date_id" value="<?php echo $sales_quotation_id; ?>" class="form-control" required readonly>
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
                                                                        <input type="date" name="qd_date" id="qd_date_id" class="form-control" required>
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
                                                                        <select class="form-select droup_customer_id" name="qd_customer" id="customer_id" style="width:80%;" required>
                                                                           
                                                                        </select>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 

                                                            

                                                            <!-- Single Row Start -->
                                                            
                                                            
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Enquiry Ref</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        
                                                                        <select name="qd_enq_ref"  id="" class="form-select qd_enquiry_reference_clz" required></select>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                           
                                                            <!-- ### --> 

                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Validity</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="qd_validity" id="qd_validity_id" class="form-control enqinput" required>
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
                                                                        <select class="form-select enqinput" name="qd_sales_executive" id="qd_sales_executive_id" required>
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
                                                                        <select class="form-select contact_person_clz" name="qd_contact_person" style="width: 80%;" id="" required>
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
                                                                        <label for="basicInput" class="form-label">Payment Term</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="qd_payment_term" id="qd_payment_term_id" class="form-control" required>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Delivery Term</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        
                                                                        <select id="qd_delivery_term_id" name="qd_delivery_term" class="delivery_term_clz" required>
                                                                            <option>Selected Disabled</option>
                                                                            <?php foreach($delivery_term as $delv_term){?> 
                                                                                <option value="<?php echo $delv_term->dt_id;?>"><?php echo $delv_term->dt_name;?></option> 
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
                                                                        <label for="basicInput" class="form-label">Project</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="qd_project" id="" class="form-control enqinput project_clz" required>
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
                                                        <!--<tbody>-->
                                                            <tr>
                                                                <td colspan="8" align="center" class="tecs">
                                                                    <span class="add_icon add_product2"><i class="ri-add-circle-line"></i>Add </span>
                                                                </td>
                                                            </tr>
                                                        <!--</tbody>--->
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="2">Amount in words</td>
                                                                <td colspan="3" class="sales_quotation_amount_in_word"></td>
                                                                <input type="hidden" name="qd_sales_quot_amount_in_words" class="sales_quotation_amount_in_word_val">
                                                                <td>Total</td>
                                                                <td><input type="text" name="qd_sales_amount" class="amount_total form-control" readonly></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2"></td>
                                                                <td colspan="3"></td>
                                                                <td>Cost</td>
                                                                <td><input type="text" class="form-control total_cost_cal" readonly></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2"></td>
                                                                <td colspan="3"></td>
                                                                <td>Percentage</td>
                                                                <td><input type="text" class="form-control total_percent" readonly></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>


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

                                                <!--table section end-->


                                            </div>  
                                            
                                            
                                             


					                           
						                    
				                        </div>


                                        
			                        </div>
		                        </form>

	                        </div>
                        </div>


                        <!--####-->




                        <!--cost calculation section start-->


                        <div class="modal fade" id="CostCalculation" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="add_form2">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Cost Calculation</h5>
                                            <button type="button" class="btn-close close_sub_modal" aria-label="Close"></button>
                                        </div>

				                        <div class="modal-body">

                                            <div class="live-preview">
                                                
                                                
                                                <!--table section start-->
                                                <div class="mt-4">
                                                    <table class="table table-bordered table-striped delTable">
                                                        <tbody class="travelerinfo">
                                                            <tr>
                                                                <td>Serial No.</td>
                                                                <td>Cost Of Materials / Services</td>
                                                                <td>Unit</td>
                                                                <td>Qty</td>
                                                                <td>Price Check</td>
                                                                <td>Rate</td>
                                                                <td>Amount</td>
                                                                <td>Action</td>
                                                            </tr>
                                                            <tr class="cost_cal_row">
                                                                <td style="width: 10%;" class="cost_ci_no">1</td>
                                                                <td>
                                                                    <select class="form-select cost_service_clz cost_product_det" name="qc_material[]" required>
                                                                        <option selected>Select Product Description</option>
                                                                        <?php foreach($products as $prod){?>
                                                                            <option value="<?php echo $prod->product_id;?>"><?php echo $prod->product_details;?></option>
                                                                        <?php } ?>-
                                                                    </select>
                                                                </td>
                                                                <td><input type="text" name="qc_unit[]"  class="form-control cost_unit_clz" required></td>
                                                                <td><input type="number" name="qc_qty[]" class="form-control cost_qty_clz" required></td>
                                                                <td><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#CostClick">Click</a></td>
                                                                <td><input type="number" name="qc_rate[]"  class="form-control cost_rate_clz" required></td>
                                                                
                                                                <td><input type="number" name="qc_amount[]" class="form-control cost_amount_clz" readonly></td>
                                                                <td><div class="tecs"><span class="add_icon add_product3"><i class="ri-add-circle-line"></i>Add </span></div></td>
                                                                <input type="hidden" name="qc_quotation_id" class="quotation_hidden_id">
                                                            </tr>
                                                           
                                                        </tbody>
                                                        <tbody  class="travelerinfo product-more3"></tbody>
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="2">Amount in words</td>
                                                                <td colspan="3" class="cost_cal_amount_in_words"></td>
                                                                <input type="hidden" name="qd_cost_amount_in_words" value="" class="cost_cal_amount_in_words_val">
                                                                
                                                                <td>Total</td>
                                                                <td><input type="text" name="qd_cost_amount" class="total_cost_cal form-control" readonly></td>
                                                                <input type="hidden" name="qd_percentage" value="" class="total_percent">
                                                            </tr>
                                                            
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>


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

                                                <!--table section end-->


                                            </div>  
                                            
                                            
                                             


					                           
						                    
				                        </div>


                                        
			                        </div>
		                        </form>

	                        </div>
                        </div>



                        <!--cost calculation section end-->


                        <!--cost calculation click section start-->

                        <div class="modal fade" id="CostClick" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            
                                            <button type="button" class="btn-close close_sub_modal2"  aria-label="Close"></button>
                                        </div>

				                        <div class="modal-body">

                                            <div class="live-preview">
                                                
                                                
                                                <!--table section start-->
                                                <div class="mt-4">
                                                    <table class="table table-bordered table-striped delTable">
                                                        <tbody class="travelerinfo contact_tbody">
                                                            <tr>
                                                                <td>Serial No.</td>
                                                                <td>Cost Of Materials / Services</td>
                                                                <td>Vendor</td>
                                                                <td>Date</td>
                                                                <td>Rate</td>
                                                                
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 10%;">1</td>
                                                                <td><input type="text" value="Fab & Supply Of Drip Tray" class="form-control" readonly></td>
                                                                   
                                                                
                                                                <td><input type="text" name="vendor[]" value="vendor1" class="form-control" readonly></td>
                                                                <td><input type="text" name="date[]"  value="03-01-2024" class="form-control qtn_clz_id" readonly></td>
                                                                
                                                                <td><input type="number" name="qpd_rate[]" value="500" class="form-control rate_clz_id" readonly></td>
                                                                
                                                             
                                                            </tr>

                                                            <tr>
                                                                <td style="width: 10%;">2</td>
                                                                <td><input type="text" value="MS Equal Angle 50mm X 50mm X 8.00mm X 6M" class="form-control" readonly></td>
                                                                   
                                                                
                                                                <td><input type="text" name="vendor[]" value="vendor2" class="form-control" readonly></td>
                                                                <td><input type="text" name="date[]"  value="04-01-2024" class="form-control qtn_clz_id" readonly></td>
                                                                
                                                                <td><input type="number" name="qpd_rate[]" value="1000" class="form-control rate_clz_id" readonly></td>
                                                                
                                                             
                                                            </tr>
                                                           
                                                        </tbody>
                                                        
                                                    </table>
                                                </div>


                                                <!--table section end-->


                                            </div>  
                                            
                                            
                                             


					                           
						                    
				                        </div>


                                        
			                        </div>
		                        </form>

	                        </div>
                        </div>

                        <!--cost calculation click section end-->




                        <!--Customer Creation modal content start-->
                        <div class="modal fade" id="CustomerCreation" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="add_cus_form1">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Customer Creation</h5>
                                            <button type="button" class="btn-close cust_prime_modal"  aria-label="Close"></button>
                                        </div>
				                        <div class="modal-body">

                                            <div class="sub_heading">
                                                <a href="javascript:void(0)" class="sub_heading_text sub_heading_btn customer_detail_modal">Customer Details</a>
                                                <a href="javascript:void(0)" class="sub_heading_text sub_heading_btn contact_detail_modal">Contact Details</a>
                                                <a href="javascript:void(0)" class="sub_heading_text sub_heading_btn offical_document_modal">Official Documents</a>
                                            </div>   
                                               
                                            
                                            <div class="card-seprate_divider"></div>

                                            <div class="live-preview">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="row">

                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basiInput" class="form-label">Customer Name</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="cc_customer_name" class="form-control" required>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Account Head</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <select class="form-select account_head_select account_head_clz" name="cc_account_head"  required></select>
                                                                        <!--<input type="text" class="form-control account_head_select account_head_clz" name="cc_account_head"  required>--->
                                                                    </div>

                                                                </div> 
                                                            </div>

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basiInput" class="form-label">Account ID</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="cc_account_id" class="form-control account_id" required>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### -->


                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Post Box</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="number" name="cc_post_box" class="form-control" required>
                                                                    </div>

                                                                </div> 
                                                            </div>

                                                            <!-- ### -->  


                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">
                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Telephone</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="cc_telephone" id="cc_telephone"  class="form-control"  required>
                                                                    </div>

                                                                </div> 
                                                            </div>

                                                            <!-- ### --> 


                                                             <!--Single Row Start-->
                                                             <div class="col-lg-12">
                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Fax</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="cc_fax" id="cc_fax" class="form-control" required>
                                                                    </div>

                                                                </div>
                                                            </div> 

                                                            <!-- ### -->  


                                                            <!--Single Row Start-->
                                                            <div class="col-lg-12">
                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Email</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="email" name="cc_email" class="form-control" required>
                                                                    </div>

                                                                </div> 
                                                            </div>

                                                            <!-- ### --> 

                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="row">
                                                            <!--Single Row Start-->
                                                            <div class="col-lg-12">
                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Credit Term</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="cc_credit_term" class="form-control" required>
                                                                    </div>

                                                                </div> 
                                                            </div>

                                                            <!-- ### --> 



                                                            <!--Single Row Start-->
                                                            <div class="col-lg-12">
                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Credit Period (Days)</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="number" name="cc_credit_period" class="form-control" required>
                                                                    </div>

                                                                </div> 
                                                            </div>

                                                            <!-- ### --> 



                                                            <!--Single Row Start-->
                                                            <div class="col-lg-12">
                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Credit Limit</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="number" name="cc_credit_limit" class="form-control" required>
                                                                    </div>

                                                                </div>
                                                            </div> 

                                                            <!-- ### -->

                                                            <div class="modal-footer justify-content-center">
                                                                <button  class="btn btn btn-success">Save</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>   
					                           
						                       
					
					                        
				                        </div>
                                        
			                        </div>
		                        </form>

	                        </div>
                        </div>


                        <!--Customer Creation content end-->



                         <!--contact detail modal section start-->
                         
                         <div class="modal fade" id="ContactDeatils" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="add_cus_form2">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Contact Details</h5>
                                            <button type="button" class="btn-close modal_close"  aria-label="Close"></button>
                                        </div>
				                        <div class="modal-body">

                                          
                                               
                                            
                                            <div class="card-seprate_divider"></div>

                                            <div class="live-preview">
                                            <table  class="table table-bordered table-striped delTable">
                                                        <tbody class="travelerinfo">
                                                            <tr>
                                                                <td >No</td>
                                                                <td>Contact Person </td>
                                                                <td>Designation</td>
                                                                <td>Mobile</td>
                                                                <td>Email</td>
                                                                <td>Action</td>
                                                            </tr>
                                                            <tr>
                                                                <td>1</td>
                                                                <td><input type="text" name="contact_person[]" class="form-control " required></td>
                                                                <td><input type="text" name="contact_designation[]" class="form-control " required></td>
                                                                <td><input type="text" name="contact_mobile[]"  class="form-control contact_mobile_clz" required></td>
                                                                <td> <input type="email" name="contact_email[]" class="form-control " required></td>
                                                                <td><div class="tecs"><span  class="add_person" class="add_icon"><i class="ri-add-circle-line"></i>Add </span></div></td>
                                                            </tr>
                                                        </tbody>
                                                        <tbody class="person-more" class="travelerinfo"></tbody>
                
                                                    </table>
                                                    <input type="hidden" class="customer_creation_id" name="contact_customer_creation">
                                                    <div class="modal-footer justify-content-center">
                                                      
                                                        <button class="btn btn btn-success">Save</button>
                                                    </div>
                                            </div>   
					                           
						                       
					
					                        
				                        </div>
                                        
			                        </div>
		                        </form>

	                        </div>
                        </div>


                        <!--contact detail modal section end-->


                        <!--official document modal section start-->

                         <div class="modal fade" id="OfficalDocument" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog">
		                        <form  class="Dashboard-form class" id="add_cus_form3">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Official Documents</h5>
                                            <button type="button" class="btn-close modal_close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
				                        <div class="modal-body">

                                          
                                               
                                            
                                            <div class="card-seprate_divider"></div>

                                            <div class="live-preview">
                                                
                                                <div class="row">

                                                    <!--Single Row Start-->
                                                    <div class="col-lg-12">
                                                        <div class="row align-items-center mb-2">
                                                            <div class="col-lg-3">
                                                                <label for="basiInput" class="form-label">CR No</label>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <input type="number" name="cc_cr_number" class="form-control" required>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                    </div>
                                                    <!--####-->

                                                    <!--Single Row Start-->
                                                    
                                                    <div class="col-lg-12">
                                                        <div class="row align-items-center mb-2">
                                                            <div class="col-lg-3">
                                                                <label for="basicInput" class="form-label">	CR Attach</label>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <input type="file" name="cc_attach_cr" class="form-control" required>
                                                            </div>
                                                        </div>
                                                      
                                                    </div>
                                                    

                                                    <!--####-->


                                                    <!--Single Row Start-->
                                                    
                                                     <div class="col-lg-12">
                                                        <div class="row align-items-center mb-2">
                                                            <div class="col-lg-3">
                                                                <label for="basicInput" class="form-label">	CR Expiry</label>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <input type="date" name="cc_cr_expiry" class="form-control" required>
                                                            </div>
                                                        </div>
                                                      
                                                    </div>
                                                    

                                                    <!--####-->


                                                    <!--Single Row Start-->
                                                    
                                                    <div class="col-lg-12">
                                                        <div class="row align-items-center mb-2">
                                                            <div class="col-lg-3">
                                                                <label for="basicInput" class="form-label">Est.ID</label>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <input type="number" name="cc_est_id" class="form-control" required>
                                                            </div>
                                                        </div>
                                                      
                                                    </div>
                                                    

                                                    <!--####-->


                                                    <!--Single Row Start-->
                                                    
                                                    <div class="col-lg-12">
                                                        <div class="row align-items-center mb-2">
                                                            <div class="col-lg-3">
                                                                <label for="basicInput" class="form-label">Est.ID Attach</label>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <input type="file" name="cc_est_id_attach" class="form-control" required>
                                                            </div>
                                                        </div>
                                                      
                                                    </div>
                                                    

                                                    <!--####-->


                                                    <!--Single Row Start-->
                                                    
                                                    <div class="col-lg-12">
                                                        <div class="row align-items-center mb-2">
                                                            <div class="col-lg-3">
                                                                <label for="basicInput" class="form-label">Est.ID Expery</label>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <input type="date" name="cc_est_id_expery" class="form-control" required>
                                                            </div>
                                                        </div>
                                                      
                                                    </div>
                                                    

                                                    <!--####-->


                                                    <!--Single Row Start-->
                                                    
                                                    <div class="col-lg-12">
                                                        <div class="row align-items-center mb-2">
                                                            <div class="col-lg-3">
                                                                <label for="basicInput" class="form-label">Signatory Name</label>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <input type="text" name="cc_signatory_name" class="form-control" required>
                                                            </div>
                                                        </div>
                                                      
                                                    </div>
                                                    

                                                    <!--####-->


                                                    <!--Single Row Start-->
                                                    
                                                     <div class="col-lg-12">
                                                        <div class="row align-items-center mb-2">
                                                            <div class="col-lg-3">
                                                                <label for="basicInput" class="form-label">QID Number</label>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <input type="number" name="cc_qid_number" class="form-control" required>
                                                            </div>
                                                        </div>
                                                      
                                                    </div>
                                                    

                                                    <!--####-->


                                                    <!--Single Row Start-->
                                                    
                                                     <div class="col-lg-12">
                                                        <div class="row align-items-center mb-2">
                                                            <div class="col-lg-3">
                                                                <label for="basicInput" class="form-label">QID Attach</label>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <input type="file" name="cc_qid_attach" class="form-control" required>
                                                            </div>
                                                        </div>
                                                      
                                                    </div>
                                                    

                                                    <!--####-->



                                                    <!--Single Row Start-->
                                                    
                                                    <div class="col-lg-12">
                                                        <div class="row align-items-center mb-2">
                                                            <div class="col-lg-3">
                                                                <label for="basicInput" class="form-label">QID Expiry</label>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <input type="date" name="cc_qid_expiry" class="form-control" required>
                                                            </div>
                                                        </div>
                                                      
                                                    </div>
                                                    

                                                    <!--####-->

                                                    <input type="hidden" class="customer_creation_id" name="cc_id">
                                                    <div class="modal-footer justify-content-center">
                                                        <button class="btn btn btn-success">Save</button>
                                                    </div>


                                                </div>
                                                    
                                            </div>   
					                           
						                       
					
					                        
				                        </div>
                                        
			                        </div>

		                        </form>

	                        </div>
                        </div>

                        <!--offical document modal section end-->


                        <!--second contact detail modal section start-->
                         
                        <div class="modal fade" id="ContactDeatils2" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="add_cus_form4">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Contact Details</h5>
                                            <button type="button" class="btn-close modal_close_2" aria-label="Close"></button>
                                        </div>
				                        <div class="modal-body">

                                          
                                               
                                            
                                            <div class="card-seprate_divider"></div>

                                            <div class="live-preview">
                                            <table  class="table table-bordered table-striped delTable">
                                                        <tbody class="travelerinfo">
                                                            <tr>
                                                                <td >No</td>
                                                                <td>Contact Person </td>
                                                                <td>Designation</td>
                                                                <td>Mobile</td>
                                                                <td>Email</td>
                                                                
                                                            </tr>
                                                            <tr>
                                                                <td>1</td>
                                                                <td><input type="text" name="contact_person" class="form-control " required></td>
                                                                <td><input type="text" name="contact_designation" class="form-control " required></td>
                                                                <td><input type="text" name="contact_mobile"  class="form-control contact_mobile_clz" required></td>
                                                                <td> <input type="email" name="contact_email" class="form-control " required></td>
                                                                
                                                            </tr>
                                                        </tbody>
                                                       
                
                                                    </table>
                                                    <input type="hidden" class="customer_creation_id2" name="contact_customer_creation">
                                                    <div class="modal-footer justify-content-center">
                                                      
                                                        <button class="btn btn btn-success">Save</button>
                                                    </div>
                                            </div>   
					                           
						                       
					
					                        
				                        </div>
                                        
			                        </div>
		                        </form>

	                        </div>
                        </div>


                        <!--contact detail modal section end-->



                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">View Sales Quotation</h4>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#SalesQuotation" class="btn btn-primary py-1">Add</button>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <table id="DataTable" class="table table-bordered table-striped delTable display dataTable">
                                            <thead>
                                                <tr>
                                                    <th class="no-sort">Sl no</th>
                                                    <th>Enquiry Number</th>
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


<!--product modal section start-->
<div class="modal fade" id="ProductModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form  class="Dashboard-form class" id="ProductForm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="live-preview">
                                        <div class="row align-items-end">
                                            <div class="col-col-md-3 col-lg-3">
                                                <div>
                                                    <label for="basiInput" class="form-label">Code</label>
                                                    <input type="text"   name="product_code" class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="col-col-md-4 col-lg-4">
                                                <div>
                                                    <label for="basiInput" class="form-label">Product Detail</label>
                                                    <input type="text"   name="product_details" class="form-control" required>
                                                </div>
                                            </div>

                                                                    
                                            <div class="col-col-md-5 col-lg-5">
                                                <div>
                                                    <label for="basiInput" class="form-label">Product Head</label>
                                                        <select class="form-select prod_head_clz" name="product_product_head" required>
                                                            <option>Select Product Head</option>
                                                            <?php foreach($product_head as $prod_head){?> 

                                                                <option value="<?php echo $prod_head->ph_id;?>"><?php echo $prod_head->ph_product_head;?></option>

                                                            <?php } ?>
                                                        </select>
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
                <div class="modal-footer justify-content-center">
                    <button  class="btn btn btn-success">Save</button>
                </div>
            </div>
        </form>

    </div>
</div>

<!--product modal section end-->


<!--SalesQuotation view section start-->

<div class="modal fade" id="SalesQuotView" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<form  class="Dashboard-form class">
			<div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sales Quotation</h5>
                    <button type="button" class="btn-close  quotation_close_modal" data-bs-dismiss="modal"></button>
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
                                                <input type="text"   class="form-control vew_ref"  readonly>
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
                                                <input type="date"  class="form-control view_date">
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
                                                <input type="text" class="form-control view_cust" readonly>
                                            </div>

                                        </div> 

                                    </div>    

                                    <!-- ### --> 

                                                            

                                    <!-- Single Row Start -->
                                    
                                    
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Enquiry Ref</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                
                                                <input type="text" class="form-control view_enq" readonly>
                                                
                                            </div>

                                        </div> 

                                    </div>    

                                    
                                    <!-- ### --> 

                                    <!-- Single Row Start -->
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Validity</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="text"  class="form-control view_validity" readonly>
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
                                                <input type="text"  class="form-control view_sales" readonly>
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
                                                <input type="text"  class="form-control view_contact" readonly>
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
                                                <input type="text" class="form-control view_payment" readonly>
                                            </div>

                                        </div> 

                                    </div>    

                                    <!-- ### --> 


                                    <!-- Single Row Start -->
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Delivery Term</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                
                                                <input type="text" class="form-control view_delivery" readonly>
                                                
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
                                        <!--<td>Product Description</td>--->
                                        <td>Unit</td>
                                        <td>Qty</td>
                                        <td>Rate</td>
                                        <td>Discount</td>
                                        <td>Amount</td>
                                       
                                    </tr>
                                    
                                    
                                </thead>
                                
                                <tbody  class="travelerinfo product-more4"></tbody>
                                <!--<tbody>-->
                                    <tr>
                                        <td colspan="8" align="center" class="tecs">
                                            <span class="add_icon add_product4"><i class="ri-add-circle-line"></i>Add </span>
                                        </td>
                                    </tr>
                                <!--</tbody>--->
                                <tbody>
                                    <tr>
                                        <td colspan="2">Amount in words</td>
                                        <td colspan="3" class="sales_quotation_amount_in_word"></td>
                                        <input type="hidden" name="qd_sales_quot_amount_in_words" class="sales_quotation_amount_in_word_val">
                                        <td>Total</td>
                                        <td><input type="text" name="qd_sales_amount" class="amount_total form-control" readonly></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="3"></td>
                                        <td>Cost</td>
                                        <td><input type="text" class="form-control total_cost_cal" readonly></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="3"></td>
                                        <td>Percentage</td>
                                        <td><input type="text" class="form-control total_percent" readonly></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


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

                        <!--table section end-->

                    </div>  
                                            
                </div>


            </div>
		</form>

	</div>
</div>

<!--SalesQuotatuion view section end-->





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
                    $.ajax({
                        url: "<?php echo base_url(); ?>Crm/SalesQuotation/Add",
                        method: "POST",
                        data: $(currentForm).serialize(),
                        success: function(data) {
                            var responseData = JSON.parse(data);
                         
                            $(".quotation_hidden_id").val(responseData.quotation_id);

                            $('#SalesQuotation').modal('hide');

                            $('#CostCalculation').modal('show');
                        
                        }
                    });
                }
            });
        });


        $(function() {
            var form = $('#add_form2');
            
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
                        url: "<?php echo base_url(); ?>Crm/SalesQuotation/AddTab2",
                        method: "POST",
                        data: $(currentForm).serialize(),
                        success: function(data) {

                            var responseData = JSON.parse(data);

                            $('.vew_ref').val(responseData.date);

                            $('.view_date').val(responseData.reffer_no);

                            $('.view_cust').val(responseData.customer);

                            $('.view_enq').val(responseData.enquiry_ref);

                            $('.view_validity').val(responseData.validity);

                            $('.view_sales').val(responseData.sales_executive);

                            $('.view_contact').val(responseData.contact_person);

                            $('.view_payment').val(responseData.payment_term);

                            $('.view_delivery').val(responseData.delivery_term);

                            $('.view_project').val(responseData.project);

                            $('.product-more4').html(responseData.view_product);

                            $('#SalesQuotView').modal('show');

                            $('#CostCalculation').modal('hide'); 

                            $('#add_form1')[0].reset();

                            $('.droup_customer_id').val('').trigger('change');

                            $('.qd_enquiry_reference_clz').val('').trigger('change');

                            $('.contact_person_clz').val('').trigger('change');

                            $('.delivery_term_clz')[0].selectize.clear();

                            datatable.ajax.reload(null, false);
                        
                        }
                    });
                }
            });
        });



        /*$(function() {

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
                        url: "<?php echo base_url(); ?>Crm/SalesQuotation/AddTab3",
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

        });*/


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
                                url: "<?php echo base_url(); ?>Crm/SalesQuotation/FetchProduct",
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



       


        /*data table start*/ 

        function initializeDataTable() {

            datatable = $('#DataTable').DataTable({
            'stateSave': true,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': 
            {
                'url': "<?php echo base_url(); ?>Crm/SalesQuotation/FetchData",
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
                { data: 'qd_id'},
                { data: 'qd_reffer_no' },
                { data: 'qd_date'},
                { data: 'qd_customer'},
                { data: 'action'},
                
               ]
    
            });
        }

        $(document).ready(function () {
            initializeDataTable();
        });
        /*###*/

        $("body").on('change', '#customer_id', function(){ 
            
            $("#direct_enquiry").val([]);

            $("#enquiry_numb").val([]);
            
            $("input.enqinput:text").val("");

            $('.enqinput').prop('selectedIndex',0);

            $(':text').removeClass('enqinput');

            $('select:has(option)').removeClass('enqinput');
            

            var id = $(this).val();

            $.ajax({

                url : "<?php echo base_url(); ?>Crm/SalesQuotation/ContactPerson",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {   
                    var data = JSON.parse(data);
                  
                    $(".contact_person_clz").html(data.customer_person);

                    $("#qd_payment_term_id").val(data.cc_credit_term);

                    $(".qd_enquiry_reference_clz").html(data.enquiry_customer);
                    
                    
                }


            });
        });


        /*enquiry droup drown change (change table row)*/
        
       
        /*#####*/



        var max_fieldspp  = 30;

       // var pp = 1;
        
        $("body").on('click', '.add_product2', function(){
            
            var pp = $('.prod_row').length
            
			if(pp < max_fieldspp){ 
            
            pp++; 
            
            $(".product-more2").append("<tr class='prod_row'><td class='si_no'>"+pp+"</td><td><select class='form-select add_prod' name='qpd_product_description[]' required=''><option value='' selected disabled>Select Product Description</option><?php foreach($products as $prod){?><option value='<?php echo $prod->product_id;?>'><?php echo $prod->product_details;?></option><?php } ?></select></td><td><input type='text' name='qpd_unit[]' class='form-control ' required=''></td><td><input type='number' name='qpd_quantity[]' class='form-control qtn_clz_id' required=''></td><td><input type='number' name='qpd_rate[]' class='form-control rate_clz_id' required=''></td><td><input type='number' min='0' max='100' onkeyup=MinMax(this) name='qpd_discount[]' class='form-control discount_clz_id' required=''></td><td><input type='number' name='qpd_amount[]' class='form-control amount_clz_id' readonly></td><td class='remove-btnpp' colspan='6'><div class='remainpass'><i class='ri-close-line'></i>Remove</div></td></tr>");
                
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

        /*serial no correction section end*/



        /*cost calculation add more section start*/

        var max_fieldspp  = 30;

       

        $("body").on('click', '.add_product3', function(){
        // var pp = $('.prod_row').length

        var cc = $('.cost_cal_row').length
           
            if(cc < max_fieldspp){ 
            
            cc++;    

                $(".product-more3").append("<tr class='cost_cal_row'><td class='cost_ci_no'>"+cc+"</td><td><select class='form-select cost_service_clz cost_product_det' name='qc_material[]' required=''><option value='' selected disabled>Select Product Description</option><?php foreach($products as $prod){?><option value='<?php echo $prod->product_id;?>'><?php echo $prod->product_details;?></option><?php } ?></select></td><td><input type='text' name='qc_unit[]' class='form-control cost_unit_clz' required=''></td><td><input type='number' name='qc_qty[]' class='form-control cost_qty_clz' required=''></td><td><a href='javascript:void(0)' data-bs-toggle='modal' data-bs-target='#CostClick'>Click</a></td><td><input type='number' name='qc_rate[]' class='form-control cost_rate_clz' required=''></td><td><input type='number' name='qc_amount[]' class='form-control cost_amount_clz' readonly></td><td class='remove-btncc' colspan='6'><div class='remainpass'><i class='ri-close-line'></i>Remove</div></td></tr>");
                InitSelect2();
            }
        });

        $(document).on("click", ".remove-btncc", function() 
        {

            $(this).parent().remove();
                

            var cc =1;

            $('body .cost_cal_row').each(function() {

                $(this).find('.cost_ci_no').html('<td class="cost_ci_no">' + cc + '</td>');

                //console.log('Updated content for cost_ci_no:', $(this).find('.cost_ci_no').html());


                cc++;
            });

                
        });

        /*cost calculation add more section end*/


        /*cost of materials selecet box section start*/
         
        function InitSelect2(){
          $(".cost_product_det:last").select2({
            placeholder: "Select Product",
            theme : "default form-control-",
            dropdownParent: $('#CostCalculation'),
            ajax: {
                url: "<?= base_url(); ?>Crm/SalesQuotation/FetchCostMetal",
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

        /*####*/




        /* Product Init Select 2 */


        function InitProductSelect2(){
          $(".add_prod:last").select2({
            placeholder: "Select Product",
            theme : "default form-control-",
            dropdownParent: $($('.add_prod:last').closest('.prod_row')),
            ajax: {
                url: "<?= base_url(); ?>Crm/SalesQuotation/FetchCostMetal",
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






        $("body").on('change', '#direct_enquiry', function(){ 
            
            $("input.enqinput:text").val("");

            $('.enqinput').prop('selectedIndex',0);

            $(':text').removeClass('enqinput');

            $('select:has(option)').removeClass('enqinput');

            var enquiry_direct =$("#direct_enquiry option:selected").val()

            if(enquiry_direct === "enquiry"){
               
                var id = $("#customer_id option:selected").val()

                
            
                $.ajax({

                    url : "<?php echo base_url(); ?>Crm/SalesQuotation/EnquiryId",

                    method : "POST",

                    data: {ID: id},

                    success:function(data)
                    {   
                        var data = JSON.parse(data);

                        $("#enquiry_numb").html(data.enquiry_output);

                        $('#enq_num_div').show();

                    }


                });


            }
            else
            {
                $('#enq_num_div').hide();
            }



        });


        /*fetch project using enquiry ref start*/

        $("body").on('change', '.qd_enquiry_reference_clz', function(){ 
            
             
            $(".enq_remove").remove();

            var id = $(this).val();

            var cust_id = $('#customer_id').val();

            
            $.ajax({

                url : "<?php echo base_url(); ?>Crm/SalesQuotation/FetchProject",

                method : "POST",

                data: {
                    ID: id,
                    custID: cust_id,
                },

                success:function(data)
                {   
                    var data = JSON.parse(data);

                    $(".project_clz").val(data.enquiry_project);

                    $(".product-more2").append(data.product_detail);

                    $(".contact_person_clz").html(data.customer_person);

                   //InitProductSelect2();

                    slno();


                }


            });



        });

        /*fetch project using enquiry ref end*/



       

        $(function() {
            $('#qd_delivery_term_id').selectize({
                create: true
            });
        });




      


        /*product detail calculation*/
        //$("body").on('keyup', '.discount_clz_id', function(){ 
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


        /**/

       



        /*product modal start*/

        $("body").on('click', '.product_modal', function(){ 
	   
            $('#AddModal').modal('hide');

            $('#ProductModal').modal('show');
   
        });

        /*product modal end*/




        /*sales quotaion sub modal section start*/

               
        $("body").on('click', '.close_sub_modal', function(){ 
	   
            $('#CostCalculation').modal('hide');

            $('#SalesQuotation').modal('show');

        });


        $("body").on('click', '.close_sub_modal2', function(){ 
	   
            $('#CostClick').modal('hide');

            $('#CostCalculation').modal('show');

        });




        /*sales quotation sub modal section end*/




        /* customer droup drown */
         $(".droup_customer_id").select2({
            placeholder: "Select Customer",
            theme : "default form-control- customer_width",
            dropdownParent: $('#SalesQuotation'),

            ajax: {
                url: "<?= base_url(); ?>Crm/SalesQuotation/FetchTypes",
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
        /**/
 



        /*cost calculation section start*/
        
        $("body").on('keyup', '.cost_qty_clz, .cost_rate_clz', function(){ 

            var valueSelect = $(this);

            var qtySelectElement = valueSelect.closest('.cost_cal_row').find('.cost_qty_clz');

            var qty = qtySelectElement.val();

            var rateSelectElement = valueSelect.closest('.cost_cal_row').find('.cost_rate_clz');

            var rate = rateSelectElement.val();

            var parsedRate = parseFloat(rate);

            var parsedQuantity = parseFloat(qty);

            var multipliedTotal = parsedRate * parsedQuantity;

            multipliedTotal = multipliedTotal.toFixed(2);

            var amountElement = valueSelect.closest('.cost_cal_row').find('.cost_amount_clz');

            amountElement.val(multipliedTotal);

            totalCalcutate();

          
        });

        /*cost calculation section end*/


        

       /*new customer creation section start*/


       /* account head  search droup drown start*/
        
       $(".account_head_select").select2({
            placeholder: "Select Account Id",
            theme : "default form-control-",
            dropdownParent: $('#CustomerCreation'),
            ajax: {
                url: "<?= base_url(); ?>Crm/CustomerCreation/FetchTypes",
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
                        results: $.map(data.result, function (item) { return {id: item.ah_id, text: item.ah_head_id}}),
                        pagination: {
                        // THE `10` SHOULD BE SAME AS `$resultCount FROM PHP, it is the number of records to fetch from table` 
                            more: (page * 10) <= data.total_count
                        }
                    };
                },              
            }
        })

        /*###*/


        /*create account id by account head*/ 
         
            $('.account_head_clz').on('change', function() {
          

            var id = $(this).val();

           $.ajax({

               url : "<?php echo base_url(); ?>Crm/CustomerCreation/Code",

               method : "POST",

               data: {ID: id},

               success:function(data)
               {   
                   var data = JSON.parse(data);
                  
                  $(".account_id").val(data.account_id);
                  
                   
               }


           });
         
           
        });

       /*####*/

       /*show contact detail modal*/ 
         
       $('.contact_detail_modal').on('click', function() {
          
          $('#CustomerCreation').modal('hide');

          $('#ContactDeatils').modal('show');
          
          
       });

       /*####*/


       /*show official documnet modal*/ 
        
       $('.offical_document_modal').on('click', function() {
         
         $('#ContactDeatils').modal('hide');

         $('#CustomerCreation').modal('hide');

         $('#OfficalDocument').modal('show');
         
         
      });

      /*####*/


      /*close contact details modal*/ 
         
       $('.modal_close').on('click', function() {
          

          $('#CustomerCreation').modal('show');

          $('#ContactDeatils').modal('hide');

          $('#OfficalDocument').modal('hide');
         
      });

      /*####*/

      /*customer creation primerary modal close section start*/

      $('.cust_prime_modal').on('click', function() {
          

          $('#CustomerCreation').modal('hide');

          $('#SalesQuotation').modal('show');

         
         
      });

      /*####*/


      /*close contact details modal*/ 
         
      $('.modal_close_2').on('click', function() {
          

        $('#ContactDeatils2').modal('hide');

        $('#Enquiry').modal('show');

         
      });

      /*####*/




      /*add customer creation*/    
      $(function() {
            var form = $('#add_cus_form1');
            
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
                        url: "<?php echo base_url(); ?>Crm/CustomerCreation/Add",
                        method: "POST",
                        data: $(currentForm).serialize(),
                        success: function(data) {

                            var responseData = JSON.parse(data);
                            
                            $(".customer_creation_id").val(responseData.customer_creation_id);
                            
                            $('#CustomerCreation').modal('hide');

                            $('#ContactDeatils').modal('show');

                        }
                    });
                }
            });
        });
        /*####*/


        /*add contact details*/
        $(function() {
            var form = $('#add_cus_form2');
           
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
                        url: "<?php echo base_url(); ?>Crm/CustomerCreation/AddTab2",
                        method: "POST",
                        data: $(currentForm).serialize(),
                        success: function(data) {
                           
                           $('#ContactDeatils').modal('hide');

                           $('#OfficalDocument').modal('show');
                            
                        }
                    });
                }
            });
        });
        /**/


        /*add oficial documents*/
        $(function() {
            var form = $('#add_cus_form3');
            
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
                        url: "<?php echo base_url(); ?>Crm/CustomerCreation/AddTab3",
                        method: "POST",
                        data: formData,
                        processData: false, // Don't process the data
                        contentType: false, // Don't set content type
                        success: function(data) {
                        
                            $('#add_cus_form1')[0].reset();
                            $('#add_cus_form2')[0].reset();
                            $('#add_cus_form3')[0].reset();
                            $('#OfficalDocument').modal('hide');
                            $('#SalesQuotation').modal('show');
                            $('.account_head_clz').val('').trigger('change');
                            alertify.success('Data Added Successfully').delay(3).dismissOthers();
                            datatable.ajax.reload(null, false);
                            
                        }
                    });
                }
            });
        });
        /**/

        


        /*add more contact details*/

         var max_fieldss      = 30;
        var y = 1;

       
        $("body").on('click', '.add_person', function(){
           
			if(y < max_fieldss){ //max input box allowed
				y++;
	            $(".person-more").append("<tr><td>"+y+"</td><td><input type='text' name='contact_person[]' class='form-control ' required></td><td><input type='text' name='contact_designation[]' class='form-control ' required></td><td><input type='text' name='contact_mobile[]' class='form-control contact_mobile_clz' required></td><td><input type='email' name='contact_email[]' class='form-control ' required></td><td class='remove-btnnp' colspan='6'><div class='remainpass'><i class='ri-close-line'></i>Remove</div></td>");
	 
			}
	    });


        $(document).on("click", ".remove-btnnp", function() {
	 
	        $(this).parent().remove();
	        y--;
        });

        /*####*/


        $('#cc_telephone').on('input', function() {
           
            $(this).val($(this).val().replace(/[^0-9+\- ]/g, ''));
        });


        $('#cc_fax').on('input', function() {
            
            $(this).val($(this).val().replace(/[^0-9+\- ]/g, ''));
        });


       

        $("body").on('keyup', '.contact_mobile_clz', function(){
           
            $(this).val($(this).val().replace(/[^0-9+\- ]/g, ''));
            
       });



        $('#edit_telephone_id').on('input', function() {
            
            $(this).val($(this).val().replace(/[^0-9\- ]/g, ''));

        });



        


       /*new customer creation end*/



       /*new contact person section start*/

        $("body").on('click', '.contact_more_modal', function(){ 
	        
            var customer_id = $('#customer_id').val();

           

            if(customer_id === null)
            {
             
                alertify.success('Please Select Customer').delay(2).dismissOthers();
            
            }
            else{

                $('#SalesQuotation').modal('hide');

                $('#ContactDeatils2').modal('show');

                $('.customer_creation_id2').val(customer_id);

            }

        });


        /*add second contact detail section start( with no add more)*/

        $(function() {
            var form = $('#add_cus_form4');
            
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
                        url: "<?php echo base_url(); ?>Crm/Enquiry/AddContactDetails",
                        method: "POST",
                        data: $(currentForm).serialize(),
                        success: function(data) {

                            var responseData = JSON.parse(data);
                            
                            $(".contact_person_clz").html(responseData.contact_person);
                            
                            $('#ContactDeatils2').modal('hide');
                            
                            $('#SalesQuotation').modal('show');

                            $('#add_cus_form4')[0].reset();

                        }
                    });
                }
            });
        });

        /*###*/


       /*new contact person section end*/



       /*customer creation show  modal start*/
         
       $("body").on('click', '.cust_more_modal', function(){ 
	        
            $('#SalesQuotation').modal('hide');

            $('#CustomerCreation').modal('show');

        });

        /*####*/


        /*quotation modal close*/

        /*$("body").on('click', '.quotation_close_modal', function(){ 
	        
            $('#add_form1')[0].reset();

        });

        var myModalEl = document.getElementById('SalesQuotation')

        myModalEl.addEventListener('hidden.bs.modal', function (event) {
                 
           

            $('.enq_tab_submit').show();

                
        })*/

        /**/


      
        
        /*delete*/ 
        $("body").on('click', '.delete_btn', function(){ 
            
            if (!confirm('Are you absolutely sure you want to delete?')) return false;
            var id = $(this).data('id');
            $.ajax({

                url : "<?php echo base_url(); ?>Crm/SalesQuotation/Delete",

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




    });





      /*total amount calculation section start*/


      function Percentage()
        {
           
           var cost_total = parseFloat($('.total_cost_cal').val());

           var quotation_total = parseFloat($('.amount_total').val());

           if ( (!isNaN(cost_total)) && (!isNaN(quotation_total)) && (quotation_total !== 0)) 
           {
                var result = cost_total / quotation_total;

                var percentage = result * 100

                var percent =  percentage.toFixed(2)

                $('.total_percent').val(percent);

              

            }
        }



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

           var resultQuotation = numberToWords.toWords(total);

            $(".sales_quotation_amount_in_word").text(resultQuotation);

            $(".sales_quotation_amount_in_word_val").val(resultQuotation);
            

        }
        
        /*total amount calculation section end*/




        function totalCalcutate()
        {

            var total = 0; 
            
            $('body .cost_amount_clz').each(function()
            {
                
                var sub_tot = parseFloat($(this).val());

                total += parseFloat(sub_tot.toFixed(2))||0;

                //
            });

            total = total.toFixed(2);

            $('.total_cost_cal').val(total);
            
            var result = numberToWords.toWords(total);

            $(".cost_cal_amount_in_words").text(result);

            $(".cost_cal_amount_in_words_val").val(result);

            Percentage()
         
        }
        
         



</script>


