<style>
    .cust_more_modal{
        
        /*position: absolute;
        left: 532px;*/
        position: absolute;
        right: 32px;
        top: -16px;
        font-size: 25px;
        color: #ff0000b5;

    }
    /*span.select2.customer_width {

        width: 80% !important;
    }*/ 
    .contact_more_modal
    {
        /*position: absolute;
        left: 471px;
        padding: 2px 27px;
        z-index: 999;
        border: 1px solid black;
        border: 1px solid #0000003b;*/

        position: absolute;
        right: 32px;
        top: -16px;
        font-size: 25px;
        color: #ff0000b5;
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
    .zero_padding
    {
        padding: 0px 0px;
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
                        
                        <!--add sales quotation modal start-->
                        <div class="modal fade" id="AddSalesQuotation" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                        <input type="text" name="qd_reffer_no" id="sqid"  value="<?php echo $sales_quotation_id; ?>" class="form-control input_length" required readonly>
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
                                                                        <input type="text" name="qd_date" autocomplete="off"  class="form-control datepicker input_length" required>
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

                                                                    <div class="col-col-md-8 col-lg-8">
                                                                        <select class="form-select droup_customer_id" name="qd_customer" id="customer_id"  required>
                                                                           
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
                                                                        <label for="basicInput" class="form-label">Enquiry Ref</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        
                                                                        <select name="qd_enq_ref"  id="" class="form-select qd_enquiry_reference_clz input_length"></select>
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
                                                                        <input type="text" name="qd_validity" id="qd_validity_id" class="form-control enqinput input_length" required>
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
                                                                        <select class="form-select enqinput input_length2" name="qd_sales_executive" id="qd_sales_executive_id" required>
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
                                                                        <label for="basicInput" class="form-label">Contact Person<!--<span class="add_more_icon contact_more_modal">New</span>--></label>
                                                                    </div>

                                                                    <div class="col-col-md-8 col-lg-8">
                                                                        <select class="form-select contact_person_clz " name="qd_contact_person" id="" required>
                                                                            <option value="" selected disabled>Contact Person</option>
                                                                            
                                                                
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
                                                                        <label for="basicInput" class="form-label">Payment Term</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="qd_payment_term" id="qd_payment_term_id" class="form-control input_length2" required>
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
                                                                        
                                                                        <select id="qd_delivery_term_id" name="qd_delivery_term" class="delivery_term_clz input_length2" required>
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
                                                                        <input type="text" name="qd_project" id="" class="form-control enqinput project_clz input_length2" required>
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
                                                                <td colspan="2"></td>
                                                                <td colspan="3" class=""></td>
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


                                                <!--<div style="float: right;">
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
                                                </div>--->

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




                        <!--add cost calculation section start-->


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
                                                            <tr class="cost_cal_row cost_cal_row2">
                                                                <td style="width: 10%;" class="cost_ci_no">1</td>
                                                                <td style="width:40%">
                                                                    <select class="form-select cost_service_clz cost_product_det" name="qc_material[0]" required>
                                                                        <option value="" selected disabled>Select Product Description</option>
                                                                        <?php foreach($products as $prod){?>
                                                                            <option value="<?php echo $prod->product_id;?>"><?php echo $prod->product_details;?></option>
                                                                        <?php } ?>-
                                                                    </select>
                                                                </td>
                                                                <td><input type="text" name="qc_unit[0]"  class="form-control cost_unit_clz" required></td>
                                                                <td><input type="number" name="qc_qty[0]" class="form-control cost_qty_clz" required></td>
                                                                <td><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#CostClick">Click</a></td>
                                                                <td><input type="number" name="qc_rate[0]"  class="form-control cost_rate_clz" required></td>
                                                                
                                                                <td><input type="number" name="qc_amount[0]" class="form-control cost_amount_clz" readonly></td>
                                                                <td><div class="tecs"><span class="add_icon add_product3"><i class="ri-add-circle-line"></i>Add </span></div></td>
                                                                <input type="hidden" name="qc_quotation_id" class="quotation_hidden_id">
                                                            </tr>
                                                           
                                                        </tbody>
                                                        <tbody  class="travelerinfo product-more3"></tbody>
                                                        <tbody>
                                                            <tr>
                                                                <!--<td colspan="2">Amount in words</td>
                                                                <td colspan="3" class="cost_cal_amount_in_words"></td>
                                                                <input type="hidden" name="qd_cost_amount_in_words" value="" class="cost_cal_amount_in_words_val">--->


                                                                <td colspan="2"></td>
                                                                <td colspan="3" class="cost_cal_amount_in_words"></td>
                                                                                                   
                                                                
                                                                <td style="text-align: center;">Total</td>
                                                                <td><input type="text" name="qd_cost_amount" class="total_cost_cal form-control" readonly></td>
                                                                <input type="hidden" name="qd_percentage" value="" class="total_percent">
                                                            </tr>
                                                            
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>


                                               

                                                <!--table section end-->


                                            </div>  
                                            
                                            
                                             


					                           
						                    
				                        </div>


                                        <div class="modal-footer justify-content-center">
                                            <button class="btn btn btn-success once_form_submit2" type="submit">Save</button>
                                            
                                        </div>


                                        
			                        </div>
		                        </form>

	                        </div>
                        </div>



                        <!--addd cost calculation section end-->


                        <!--add cost calculation click section start-->

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

                        <!--add cost calculation click section end-->


                        <!--customer creation modal section start-->

                        <?= $this->include('crm/add_modal_customer') ?>


                        <!--#######-->


                        <!--contact person modal start-->


                        <?= $this->include('crm/add_contact_person') ?>


                        <!--contact person modal end-->



                        <!---edit section start-->

                        <div class="modal fade" id="EditSalesQuotation" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="edit_sales_quot_form">
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
                                                                        <input type="tex" name="qd_reffer_no"  class="form-control edit_ref" required readonly>
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
                                                                        <input type="text" name="qd_date" autocomplete="off"  class="form-control datepicker edit_date" required>
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
                                                                        <select class="form-select edit_customer" name="qd_customer" id=""  required>
                                                                           
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
                                                                        
                                                                        <select name="qd_enq_ref"  id="" class="form-select edit_enquiry"></select>
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
                                                                        <input type="text" name="qd_validity" id="" class="form-control edit_validity" required>
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
                                                                        <select class="form-select edit_sales_exce" name="qd_sales_executive" id="" required>
                                                                            
                                                                
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
                                                                        <select class="form-select edit_contact_person" name="qd_contact_person"  required>
                                                                            
                                                                            
                                                                
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
                                                                        <input type="text" name="qd_payment_term" id="" class="form-control edit_payment" required>
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
                                                                        
                                                                        <select id="qd_edit_delivery_term_id" name="qd_delivery_term" class="edit_delivery_term form-select" required></select>
                                                                        
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
                                                                        <input type="text" name="qd_project" id="" class="form-control edit_project" required>
                                                                    </div>

                                                                    <input type="hidden" class="quoat_id" name="qd_id">

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                             



                                                        </div>

                                                    </div>
                                                                                          

                                                </div>


                                                <!--table section start-->
                                                <div class="mt-4">
                                                <h5 class="modal-title text-center mb-3" id="exampleModalLabel">Product Detail</h5>
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

                                                        
                                                        <tbody  class="travelerinfo edit_product-more"></tbody>
                                                        <!--<tbody>-->
                                                            <tr>
                                                                <td colspan="8" align="center" class="tecs">
                                                                    <span class="add_icon edit_add_prod_det"><i class="ri-add-circle-line"></i>Add </span>
                                                                </td>
                                                            </tr>
                                                        <!--</tbody>--->
                                                        
                                                    </table>
                                                </div>

                                                <!--table section end-->


                                                <!--cost calculation table start-->


                                                <div class="mt-4">
                                                    
                                                    <h5 class="modal-title text-center mb-3" id="exampleModalLabel">Cost Calculation</h5>
                                                    <table class="table table-bordered table-striped delTable">
                                                        <thead class="travelerinfo contact_tbody">
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
                                                           
                                                        </thead>

                                                        
                                                        <tbody  class="travelerinfo edit_cost_cal"></tbody>
                                                        <!--<tbody>-->
                                                            <tr>
                                                                <td colspan="8" align="center" class="tecs">
                                                                    <span class="add_icon edit_add_cost_cal"><i class="ri-add-circle-line"></i>Add </span>
                                                                </td>
                                                            </tr>
                                                        <!--</tbody>--->

                                                        <tbody>
                                                            <tr>
                                                                <td colspan="2"></td>
                                                                <td colspan="3" class=""></td>
                                                                <!--<input type="hidden" name="qd_sales_quot_amount_in_words" class="sales_quotation_amount_in_word_val">-->
                                                                <td>Product</td>
                                                                <td><input type="text" name="" class="edit_total_prod form-control" readonly></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2"></td>
                                                                <td colspan="3"></td>
                                                                <td>Cost</td>
                                                                <td><input type="text" class="form-control edit_total_cost_cal" readonly></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2"></td>
                                                                <td colspan="3"></td>
                                                                <td>Percentage</td>
                                                                <td class="edit_total_percent"><input type="text" class="form-control edit_total_percent" readonly></td>
                                                            </tr>
                                                        </tbody>
                                                        
                                                    </table>
                                                </div>


                                                <!--const calculation table end-->


                                                


                                                


                                            </div>  
                                            
                                            
                                             


					                           
						                    
				                        </div>


                                        <div class="modal-footer justify-content-center">
                                            <button class="btn btn btn-success" type="submit">Save</button>
                                        </div>


                                        
			                        </div>
		                        </form>

	                        </div>
                        </div>



                        <!--edit single cost calculation start-->


                        <div class="modal fade" id="EditCostCalculation" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="edit_cost_cal_id">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Cost Calculation</h5>
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
                                                                <td>Cost Of Materials / Services</td>
                                                                <td>Unit</td>
                                                                <td>Qty</td>
                                                                <td>Price Check</td>
                                                                <td>Rate</td>
                                                                <td>Amount</td>
                                                                
                                                            </tr>
                                                            <tr class="edit_cost_cal_row">
                                                                <td style="width: 10%;" class="">1</td>
                                                                <td style="width:34%">
                                                                    <select class="form-select  edit_cost_product_det edit_cost_prod" name="qc_material" required>
                                                                        <option selected>Select Product Description</option>
                                                                       
                                                                    </select>
                                                                </td>
                                                                <td><input type="text" name="qc_unit"  class="form-control edit_cost_unit" required></td>
                                                                <td><input type="number" name="qc_qty" class="form-control edit_cost_qty" required></td>
                                                                <td><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#CostClick">Click</a></td>
                                                                <td><input type="number" name="qc_rate"  class="form-control edit_cost_rate" required></td>
                                                                
                                                                <td><input type="number" name="qc_amount" class="form-control edit_cost_amount" readonly></td>
                                                               
                                                                <input type="hidden" name="qc_id" class="edit_hidden_cost_id">
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




                        <!--edit single cost calculation end-->


                        <!--edit add single cost calculation start-->

                        <div class="modal fade" id="EditAddCostCal" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="edit_add_cost_cal_id">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Cost Calculation</h5>
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
                                                                <td>Cost Of Materials / Services</td>
                                                                <td>Unit</td>
                                                                <td>Qty</td>
                                                                <td>Price Check</td>
                                                                <td>Rate</td>
                                                                <td>Amount</td>
                                                                
                                                            </tr>
                                                            <tr class="edit_add_cost_cal_row">
                                                                <td style="width: 10%;" class="">1</td>
                                                                <td style="width: 23%">
                                                                    <select class="form-select cost_service_clz edit_add_prod_desc" name="qc_material" required>
                                                                        <option value=""  selected disabled>Select Product Description</option>
                                                                        <?php foreach($products as $prod){?>
                                                                            <option value="<?php echo $prod->product_id;?>"><?php echo $prod->product_details;?></option>
                                                                        <?php } ?>-
                                                                    </select>
                                                                </td>
                                                                <td><input type="text" name="qc_unit"  class="form-control " required></td>
                                                                <td><input type="number" name="qc_qty" class="form-control edit_add_qty" required></td>
                                                                <td><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#CostClick">Click</a></td>
                                                                <td><input type="number" name="qc_rate"  class="form-control edit_add_rate" required></td>
                                                                
                                                                <td><input type="number" name="qc_amount" class="form-control edit_add_amount" readonly></td>
                                                                <!--<td><div class="tecs"><span class="add_icon add_product3"><i class="ri-add-circle-line"></i>Add </span></div></td>-->
                                                                <input type="hidden" name="qc_quotation_id" class="edit_add_qtn_id">
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



                        <!--edit add single cost calculation end-->


                        <!--edit single product section start-->


                        <div class="modal fade" id="EditProdDet" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="edit_prod_det">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Product Detail</h5>
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

                                                        <tbody class="edit_prod_tbody"></tbody>
                                                       
                                                        
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


                        <!--######-->


                        <!--edit add product section start-->


                        <div class="modal fade" id="EditAddProd" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="edit_add_prod_form">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Product Detail</h5>
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
                                                            <tr class="edit_add_prod_det_row">
                                                                <td style="width: 10%;" class="">1</td>
                                                                <td style="width:40%">
                                                                    <select class="form-select  edit_add_quot_prod" name="qpd_product_description" required>
                                                                        <option value="" selected disabled>Select Product Description</option>
                                                                       
                                                                    </select>
                                                                </td>
                                                                <td><input type="text" name="qpd_unit"  class="form-control " required></td>
                                                                <td><input type="number" name="qpd_quantity" class="form-control edit_add_prod_qty" required></td>
                                                                <td><input type="number" name="qpd_rate" class="form-control edit_add_prod_rate" required></td>
                                                                <td><input type="number" name="qpd_discount" min="0" max="100"  onkeyup="MinMax(this)" class="form-control edit_add_prod_dis" required></td>
                                                                
                                                                <td><input type="number" name="qpd_amount" class="form-control edit_add_prod_amount" readonly></td>
                                                               
                                                                <input type="hidden" name="qpd_quotation_details" class="edit_add_quot_id">
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


                        <!--####-->




                        <!--edit section end-->




                        <!--view section start-->

                        <div class="modal fade" id="ViewSalesQuotation" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="">
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
                                                                        <input type="tex" name="qd_reffer_no"  class="form-control view_btn_ref" readonly>
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
                                                                        <input type="text" name="qd_date"  class="form-control datepicker view_btn_date" readonly>
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
                                                                       
                                                                        <input type="text" name="qd_customer"  class="form-control view_btn_customer" readonly>  
                                                                        
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
                                                                        
                                                                        <input type="text" name="qd_enq_ref"  class="form-control view_btn_enquiry" readonly>  

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
                                                                        <input type="text" name="qd_validity" id="" class="form-control view_btn_validity" readonly>
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
                                                                        
                                                                        <input type="text" name="qd_sales_executive" id="" class="form-control view_btn_sales_exce" readonly>
                                                                        
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
                                                                          
                                                                        <input type="text" name="qd_contact_person" id="" class="form-control view_btn_contact_person" readonly>
                                                                         
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
                                                                        <input type="text" name="qd_payment_term" id="" class="form-control view_btn_payment" readonly>
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
                                                                        
                                                                       
                                                                        <input type="text" name="qd_delivery_term" id="qd_edit_delivery_term_id" class="form-control view_btn_delivery_term" readonly>

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
                                                                        <input type="text" name="qd_project" id="" class="form-control view_btn_project" readonly>
                                                                    </div>

                                                                    <input type="hidden" class="quoat_id" name="qd_id">

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                             



                                                        </div>

                                                    </div>
                                                                                          

                                                </div>


                                                <!--table section start-->
                                                <div class="mt-4">
                                                <h5 class="modal-title text-center mb-3" id="exampleModalLabel">Product Detail</h5>
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

                                                        
                                                        <tbody  class="travelerinfo view_prod_det"></tbody>
                                                      
                                                        

                                                    </table>
                                                </div>

                                                <!---table section end-->


                                                <!--cost calculation table start-->


                                                <div class="mt-4">
                                                    
                                                    <h5 class="modal-title text-center mb-3" id="exampleModalLabel">Cost Calculation</h5>
                                                    <table class="table table-bordered table-striped delTable">
                                                        <thead class="travelerinfo contact_tbody">
                                                            <tr>
                                                                <td>Serial No.</td>
                                                                <td colspan="2">Cost Of Materials / Services</td>
                                                                <td>Unit</td>
                                                                <td>Qty</td>
                                                                <td>Rate</td>
                                                                <td>Amount</td>
                                                                
                                                            </tr>
                                                           
                                                        </thead>

                                                        
                                                        <tbody  class="travelerinfo view_cost_cal"></tbody>
                                                        
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="2"></td>
                                                                <td colspan="3" class=""></td>
                                                                
                                                                <td>Product</td>
                                                                <td><input type="text" name="" class="view_btn_total_prod form-control" readonly></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2"></td>
                                                                <td colspan="3"></td>
                                                                <td>Cost</td>
                                                                <td><input type="text" class="form-control view_btn_total_cost_cal" readonly></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2"></td>
                                                                <td colspan="3"></td>
                                                                <td>Percentage</td>
                                                                <td class="view_total_percent"><input type="text" class="form-control view_btn_total_percent" readonly></td>
                                                            </tr>
                                                        </tbody>
                                                        
                                                    </table>
                                                </div>


                                                <!--const calculation table end-->


                                                


                                               


                                            </div>  
                                            
                                            
                                             


					                           
						                    
				                        </div>


                                        
			                        </div>
		                        </form>

	                        </div>
                        </div>



                        <!--view section end-->





                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">View Sales Quotation</h4>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#AddSalesQuotation" class="btn btn-primary py-1 add_model_btn">Add</button>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <table id="DataTable" class="table table-bordered table-striped delTable display dataTable">
                                            <thead>
                                                <tr>
                                                    <th class="no-sort">Sl no</th>
                                                    <th>Quotation Number</th>
                                                    <th>Date</th>
                                                    <th>Customer</th>
                                                    <th>Enquiry Number</th>
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

                            <h5 class="modal-title text-center mb-3" id="exampleModalLabel">Product Description</h5>

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
                                
                                <tbody  class="travelerinfo product-more4"></tbody>


                                <!--<tbody  class="travelerinfo cost_data"></tbody>--->


                               
                            </table>
                        </div>



                        <div class="mt-4">
                                                    
                            <h5 class="modal-title text-center mb-3" id="exampleModalLabel">Cost Calculation</h5>
                            <table class="table table-bordered table-striped delTable">
                                <thead class="travelerinfo contact_tbody">
                                    <tr>
                                        <td>Serial No.</td>
                                        <td colspan="2">Cost Of Materials / Services</td>
                                        <td>Unit</td>
                                        <td>Qty</td>
                                        <td>Rate</td>
                                        <td>Amount</td>
                                        
                                    </tr>
                                    
                                </thead>

                                
                                <tbody  class="travelerinfo cost_data"></tbody>

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
                                        <td>Product</td>
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

 

                        <!--table section end-->

                    </div>  
                                            
                </div>
                
                <input type ="hidden" class="view_quot_id">

                <div class="modal-footer justify-content-center">
                    <a href="javascript:void(0)" class="btn btn btn-success   quotation_close_modal" data-bs-dismiss="modal">Finish</a>
                    <span class="print_pdf_btn"><a href="" class="btn btn btn-success " >Print</a></span>
                </div>


            </div>
		</form>

	</div>
</div>

<!--SalesQuotatuion view section end-->


<script>

    document.addEventListener("DOMContentLoaded", function(event) { 

        /*sale quotation add secxtion start*/


        /*####*/
        $("body").on('click', '.cust_close_modal', function(){ 

           
            $('#AddCustomerCreation').modal('hide');


            $('#AddSalesQuotation').modal('show');
 

        });
        
        
        /*customer  Remove Validation On Change */
	
        $("select[name=qd_customer]").on("change",function(e) {
            $(this).parent().find(".error").removeClass("error");         
        });
		
        /*###*/




        //trigger when form is submitted

        $("#add_office_doc").submit(function(e){

            $('#AddSalesQuotation').modal('show');

            return false;

        });


        $("#add_cus_form4").submit(function(e){

            e.preventDefault(); // don't submit multiple times

            $('#AddSalesQuotation').modal('show');

            $('#customer_id').val('').trigger('change');

           

            //return false;

        });
        
       
        /*#####*/


        /*new contact person section start*/

        $("body").on('click', '.contact_more_modal', function(){ 
	        
            var customer_id = $('#customer_id').val();

           

            if(customer_id === null)
            {
             
                alertify.success('Please Select Customer').delay(2).dismissOthers();
            
            }
            else{

                $('#AddSalesQuotation').modal('hide');

                $('#ContactDeatils2').modal('show');

                $('.customer_creation_id2').val(customer_id);

            }

        });

        /*#####*/



    
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

                    $('.once_form_submit').attr('disabled', true); // Disable this input.
                    // Submit the form for the current tab
                    $.ajax({
                        url: "<?php echo base_url(); ?>Crm/SalesQuotation/Add",
                        method: "POST",
                        data: $(currentForm).serialize(),
                        success: function(data) {
                            var responseData = JSON.parse(data);
                         
                            $(".quotation_hidden_id").val(responseData.quotation_id);

                            $('#AddSalesQuotation').modal('hide');

                            $('#CostCalculation').modal('show');

                            $('.prod_row').remove();
                        
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
                    $('.once_form_submit2').attr('disabled', true); // Disable this input.
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

                            $('.print_pdf_btn').html(responseData.print_pdf_btn);

                            console.log(responseData.print_pdf_btn);

                            $('.product-more4').html(responseData.view_product);

                            $('.cost_data').html(responseData.cost_details);

                            $('#SalesQuotView').modal('show');

                            $('#CostCalculation').modal('hide'); 

                            $('#add_form1')[0].reset();

                            $('#add_form2')[0].reset();

                            $('.cost_product_det').val('').trigger('change');

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
                { data: 'qd_reffer_no'},
                { data: 'qd_date'},
                { data: 'qd_customer'},
                { data: 'qd_enquiry'},
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

        $("body").on('change', '#customer_id', function(){ 
            
           
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

                    if(data.cc_credit_term!==null)
                    {
                        $('#qd_payment_term_id').removeClass("error");    
                    }
                 
                }

            });
        });

        /*reset refference number*/

        $('.add_model_btn').click(function(){
            
            $('#add_form1')[0].reset();
            
            $('.droup_customer_id').val('').trigger('change');

            $('.qd_enquiry_reference_clz').val('').trigger('change');
            
            $('.contact_person_clz').val('').trigger('change');

            $('.delivery_term_clz').val('').trigger('change');

            $('.enq_remove').remove();

            $('.once_form_submit').attr('disabled', false); // Disable this input.

            $('.once_form_submit2').attr('disabled', false); // Disable this input.

            $('.cost_cal_row2_remove').remove();

            

            $.ajax({

                url : "<?php echo base_url(); ?>Crm/SalesQuotation/FetchReference",

                method : "GET",

                success:function(data)
                {

                    $('#sqid').val(data);

                }

            });

        });


        /*####*/



        /*enquiry droup drown change (change table row)*/
        
       
        /*#####*/



        var max_fieldspp  = 30;

       // var pp = 1;
        
        $("body").on('click', '.add_product2', function(){
            
            var pp = $('.prod_row').length

            var qj  = $('.quot_row_leng').length
 
			if(pp < max_fieldspp){ 
              
            pp++; 

            $(".product-more2").append("<tr class='prod_row quot_row_leng'><td class='si_no'>"+pp+"</td><td><select class='form-select add_prod' name='qpd_product_description["+qj+"]' required=''><option value='' selected disabled>Select Product Description</option><?php foreach($products as $prod){?><option value='<?php echo $prod->product_id;?>'><?php echo $prod->product_details;?></option><?php } ?></select></td><td><input type='text' name='qpd_unit["+qj+"]' class='form-control unit_clz_id' required=''></td><td><input type='number' name='qpd_quantity["+qj+"]' class='form-control qtn_clz_id' required=''></td><td><input type='number' name='qpd_rate["+qj+"]' class='form-control rate_clz_id' required=''></td><td><input type='number' min='0' max='100' onkeyup=MinMax(this) name='qpd_discount["+qj+"]' class='form-control discount_clz_id' required=''></td><td><input type='number' name='qpd_amount["+qj+"]' class='form-control amount_clz_id' readonly></td><td class='remove-btnpp' colspan='6'><div class='remainpass'><i class='ri-close-line'></i>Remove</div></td></tr>");
                
			}
            
            slno();

            InitProductSelect2();

	    });


        $(document).on("click", ".remove-btnpp", function() 
        {
            
            $(this).parent().remove();

            /*var jj = 0;

            $('body .quot_row_leng').each(function(){
                  
                var  rate =  $(this).closest('.quot_row_leng').find('.rate_clz_id').val();

                $(this).closest('.quot_row_leng').find('.add_prod').attr('name', 'qpd_product_description['+jj+']');

                $(this).closest('.quot_row_leng').find('.unit_clz_id').attr('name', 'qpd_unit['+jj+']');

                $(this).closest('.quot_row_leng').find('.qtn_clz_id').attr('name', 'qpd_quantity['+jj+']');
                      
                $(this).closest('.quot_row_leng').find('.rate_clz_id').attr('name', 'qpd_rate['+jj+']');

                $(this).closest('.quot_row_leng').find('.discount_clz_id').attr('name', 'qpd_discount['+jj+']');

                $(this).closest('.quot_row_leng').find('.amount_clz_id').attr('name', 'qpd_amount['+jj+']');

                jj++;

            });*/

            reName();
            
            

            slno();

            TotalAmount();

            
        });
        
        

        function reName(){
            
            var jj = 0;

            $('body .quot_row_leng').each(function() {
                
                var  rate =  $(this).closest('.quot_row_leng').find('.rate_clz_id').val();

                $(this).closest('.quot_row_leng').find('.add_prod').attr('name', 'qpd_product_description['+jj+']');

                $(this).closest('.quot_row_leng').find('.unit_clz_id').attr('name', 'qpd_unit['+jj+']');

                $(this).closest('.quot_row_leng').find('.qtn_clz_id').attr('name', 'qpd_quantity['+jj+']');
                    
                $(this).closest('.quot_row_leng').find('.rate_clz_id').attr('name', 'qpd_rate['+jj+']');

                $(this).closest('.quot_row_leng').find('.discount_clz_id').attr('name', 'qpd_discount['+jj+']');

                $(this).closest('.quot_row_leng').find('.amount_clz_id').attr('name', 'qpd_amount['+jj+']');

                $(this).closest('.quot_row_leng').find('.rename_prod_id').attr('name', 'qpd_prod_id['+jj+']');

                $(this).closest('.quot_row_leng').find('.rename_enq_id').attr('name', 'enquiry_id['+jj+']');

                jj++;

            });
        }
       


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

        var sq  = $('.cost_cal_row2').length

            if(cc < max_fieldspp){ 
            
            cc++;    

                $(".product-more3").append("<tr class='cost_cal_row cost_cal_row2 cost_cal_row2_remove'><td class='cost_ci_no'>"+cc+"</td><td><select class='form-select cost_service_clz cost_product_det' name='qc_material["+sq+"]' required=''><option value='' selected disabled>Select Product Description</option><?php foreach($products as $prod){?><option value='<?php echo $prod->product_id;?>'><?php echo $prod->product_details;?></option><?php } ?></select></td><td><input type='text' name='qc_unit["+sq+"]' class='form-control cost_unit_clz' required=''></td><td><input type='number' name='qc_qty["+sq+"]' class='form-control cost_qty_clz' required=''></td><td><a href='javascript:void(0)' data-bs-toggle='modal' data-bs-target='#CostClick'>Click</a></td><td><input type='number' name='qc_rate["+sq+"]' class='form-control cost_rate_clz' required=''></td><td><input type='number' name='qc_amount["+sq+"]' class='form-control cost_amount_clz' readonly></td><td class='remove-btncc' colspan='6'><div class='remainpass'><i class='ri-close-line'></i>Remove</div></td></tr>");
                InitSelect2();
            }
        });

        $(document).on("click", ".remove-btncc", function() 
        {

            $(this).parent().remove();
                

            var cc =1;

            var cp = 0;

            $('body .cost_cal_row').each(function() {

                $(this).find('.cost_ci_no').html('<td class="cost_ci_no">' + cc + '</td>');

                $(this).find('.cost_product_det').attr("name", "qc_material["+cp+"]");

                $(this).find('.cost_unit_clz').attr("name", "qc_unit["+cp+"]");

                $(this).find('.cost_qty_clz').attr("name", "qc_qty["+cp+"]");

                $(this).find('.cost_rate_clz').attr("name", "qc_rate["+cp+"]");

                $(this).find('.cost_amount_clz').attr("name", "qc_amount["+cp+"]");

                
                cc++;

                cp++;
            });


            totalCalcutate();

                
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
                    
                    if(data.enquiry_project!== null)
                    {
                        $('.project_clz').removeClass("error"); 
                    }
                   

                    if(data.customer_person!== null)
                    {
                        $('.contact_person_clz').removeClass("error"); 
                    }
                    
                    slno();
                    
                    reName();

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

            //var formatted = formatCurrency(orginalPrice);

            //currency_format(orginalPrice);

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

            $('#AddSalesQuotation').modal('show');

           

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
            dropdownParent: $('#AddSalesQuotation'),

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
                        results: $.map(data.result, function (item) {return {id: item.cc_id, text: item.cc_customer_name}}),
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


        




       /*customer creation show  modal start*/
         
       $("body").on('click', '.cust_more_modal', function(){ 
	        
            $('#AddSalesQuotation').modal('hide');

            $('#AddCustomerCreation').modal('show');

        });

        /*####*/




      
        
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
                    var data = JSON.parse(data);
                    if(data.status == "true")
                    {
                        alertify.success('Data Deleted Successfully').delay(2).dismissOthers();

                        datatable.ajax.reload(null,false);
                    }
                    else
                    {
                        alertify.error("Sales Quotation In Use Cant't Delete").delay(2).dismissOthers();
                    }
                   
                }

            });

        });
        /*###*/




        /*edit section start*/


        $("body").on('click', '.edit_btn', function(){ 

	        var id = $(this).data('id');

            $('.quoat_id').val(id);

            $.ajax({

                url : "<?php echo base_url(); ?>Crm/SalesQuotation/Edit",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {
                    var responseData = JSON.parse(data);

                    $(".edit_ref").val(responseData.reffer_no);

                    $(".edit_date").val(responseData.date);

                    $(".edit_customer").html(responseData.customer_creation);

                    $(".edit_enquiry").html(responseData.enquiry_ref);

                    $(".edit_validity").val(responseData.validity);

                    $(".edit_sales_exce").html(responseData.sales_exec);

                    $(".edit_contact_person").html(responseData.contact_person);

                    $(".edit_payment").val(responseData.payment_term);

                    $(".edit_delivery_term").html(responseData.delivery_term);

                    $(".edit_project").val(responseData.project);

                    $(".edit_product-more").html(responseData.prod_details);

                    $(".edit_cost_cal").html(responseData.cost_prod_det);

                    $(".edit_total_cost_cal").val(responseData.cost_amount);

                    $(".edit_total_prod").val(responseData.quot_total_amount);

                    $(".edit_total_percent").val(responseData.quot_percentage);

                }

            });

            

            $('#EditSalesQuotation').modal('show');
            

        });

        /*fetch contact person  by customer craetion*/

        $("body").on('click', '.edit_customer', function(){ 

            var id = $('.edit_customer').val();

            var quoat_id = $('.quoat_id').val();
            
        
            $.ajax({

                url : "<?php echo base_url(); ?>Crm/SalesQuotation/EditContactPerson",

                method : "POST",

                //data: {ID: id},

                data: {ID: id,
                       QuotId: quoat_id,
                },

                success:function(data)
                {   
                    var data = JSON.parse(data);

                
                   // $(".edit_contact_person").html(data.contact_person);

                    //$(".edit_enquiry").html(data.enquiry_ref);

                    //$(".edit_payment").val(data.credit_term);

                  

                }

            });


        });


        /*edit cost calculation modal start*/

        $("body").on('click', '.edit_cost_cal_btn', function(){ 

            $('#EditCostCalculation').modal('show');

            $('#EditSalesQuotation').modal('hide');

            var cost_cal_id = $(this).data('id');

            $('.edit_hidden_cost_id').val(cost_cal_id);


            $.ajax({

                url : "<?php echo base_url(); ?>Crm/SalesQuotation/EditCostCal",

                method : "POST",

                //data: {ID: id},

                data: {ID: cost_cal_id,
                    
                },

                success:function(data)
                {   
                    var data = JSON.parse(data);

                    $(".edit_cost_prod").html(data.material);

                    $(".edit_cost_unit").val(data.unit);

                    $(".edit_cost_qty").val(data.qty);

                    $(".edit_cost_rate").val(data.rate);

                    $(".edit_cost_amount").val(data.amount);

                    

                }

            });


        });


        /*####*/


        /*cost calculation section start*/
        
        $("body").on('keyup', '.edit_cost_qty, .edit_cost_rate', function(){ 

            var valueSelect = $(this);

            var qtySelectElement = valueSelect.closest('.edit_cost_cal_row').find('.edit_cost_qty');

            var qty = qtySelectElement.val();

            var rateSelectElement = valueSelect.closest('.edit_cost_cal_row').find('.edit_cost_rate');

            var rate = rateSelectElement.val();

            var parsedRate = parseFloat(rate);

            var parsedQuantity = parseFloat(qty);

            var multipliedTotal = parsedRate * parsedQuantity;

            multipliedTotal = multipliedTotal.toFixed(2);

            var amountElement = valueSelect.closest('.edit_cost_cal_row').find('.edit_cost_amount');

            amountElement.val(multipliedTotal);

          // editTotalCalcutate();


        });

        /*cost calculation section end*/


        /*edit cost calculation selecet box section start*/
         
        function InitSelect2(){
          $(".edit_add_prod_desc:last").select2({
            placeholder: "Select Product",
            theme : "default form-control-",
            dropdownParent: $('#EditAddCostCal'),
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



        /*update cost calculation start*/

        $(function() {
            var form = $('#edit_cost_cal_id');
            
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
                        url: "<?php echo base_url(); ?>Crm/SalesQuotation/UpdateCostCal",
                        method: "POST",
                        data: $(currentForm).serialize(),
                        success: function(data) {
                            var responseData = JSON.parse(data);

                            $('#EditCostCalculation').modal('hide');

                            var quotID= (responseData.quot_id);

                            $('.edit_btn[data-id="'+quotID+'"]').trigger('click');

                            alertify.success('Data Added Successfully').delay(3).dismissOthers();

                            datatable.ajax.reload(null, false);
                         
                          
                        
                        }
                    });
                }
            });
        });



        /*####*/


        /* edit add cost calculation start*/

        $(function() {
            var form = $('#edit_add_cost_cal_id');
            
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
                        url: "<?php echo base_url(); ?>Crm/SalesQuotation/EditAddCostCal",
                        method: "POST",
                        data: $(currentForm).serialize(),
                        success: function(data) {
                            var responseData = JSON.parse(data);

                          

                            $('#EditAddCostCal').modal('hide');

                            $('#edit_add_cost_cal_id')[0].reset();

                            $('.edit_add_prod_desc').val('').trigger('change');

                            var quotID= (responseData.quot_id);

                            $('.edit_btn[data-id="'+quotID+'"]').trigger('click');

                            alertify.success('Data Added Successfully').delay(3).dismissOthers();

                            datatable.ajax.reload(null, false);
                         
                        
                        }
                    });
                }
            });
        });


        /*edit add cost calculation end*/


        /*cost calculation section start*/

        $("body").on('keyup', '.edit_add_qty, .edit_add_rate', function(){ 

            var valueSelect = $(this);

            var qtySelectElement = valueSelect.closest('.edit_add_cost_cal_row').find('.edit_add_qty');

            var qty = qtySelectElement.val();

            var rateSelectElement = valueSelect.closest('.edit_add_cost_cal_row').find('.edit_add_rate');

            var rate = rateSelectElement.val();

            var parsedRate = parseFloat(rate);

            var parsedQuantity = parseFloat(qty);

            var multipliedTotal = parsedRate * parsedQuantity;

            multipliedTotal = multipliedTotal.toFixed(2);

            var amountElement = valueSelect.closest('.edit_add_cost_cal_row').find('.edit_add_amount');

            amountElement.val(multipliedTotal);

            // editTotalCalcutate();

        });

        /*cost calculation section end*/



        
        /*edit add cost calculation modal*/

        $("body").on('click', '.edit_add_cost_cal', function(){ 
             
          

            $('#EditAddCostCal').modal('show');

            $('#EditSalesQuotation').modal('hide');

            var quot_id = $('.quoat_id').val();

            $('.edit_add_qtn_id').val(quot_id);

            

        });


        /*####*/


        /*edit const cal delete section start*/


        $("body").on('click', '.delete_cost_cal_btn', function(){ 

            id = $(this).data('id');

            var rowToDelete = $(this).closest('tr');

            $.ajax({

                url : "<?php echo base_url(); ?>Crm/SalesQuotation/DeleteCostCal",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {
                    var data = JSON.parse(data);

                    console.log(data)
                        
                        if(data.status == "false")
                        {   
                            alertify.error("Data Can't Be Delete").delay(3).dismissOthers();

                            
                        }   
                        else
                        {
                            rowToDelete.fadeOut(500, function(){
                                $(this).remove();
                                slno1();
                                EditCalTotal();
                                alertify.success('Data Delete Successfully').delay(3).dismissOthers();
                            }); 
                        }
                        
                    
                    
                   

                }

            });

            
        });
 
 
        /*####*/


        /*rearrange edit cost cal sl no*/


        function slno1(){

            var pp =1;

            $('body .edt_cost_row').each(function() {

                $(this).find('.edit_cost_si_no').html('<td class="si_no">' + pp + '</td>');

                pp++;

            });

        }


        /*####*/


        /*edit close sub modal start*/

        $("body").on('click', '.edit_close_sub_modal', function(){ 
	   
            $('#EditSalesQuotation').modal('show');
            
            $('#EditAddCostCal').modal('hide');

            $('#EditCostCalculation').modal('hide');

            $('#EditProdDet').modal('hide');

            $('#EditAddProd').modal('hide');

        });

        /*#####*/



        /*edit cost cal delete section end*/



        /*edit prod details*/
        $("body").on('click', '.edit_prod_btn', function(){ 
	   
            $('#EditSalesQuotation').modal('hide');

            $('#EditProdDet').modal('show');

            var id = $(this).data('id');

            $.ajax({

                url : "<?php echo base_url(); ?>Crm/SalesQuotation/EditProdDet",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {   
                    var data = JSON.parse(data);

                    $('.edit_prod_tbody').html(data.prod_details);

                }

            });
          

        });

        /*#####*/

        /*edit product detail calculation*/

        $("body").on('keyup', '.edit_prod_dis , .edit_prod_qty , .edit_prod_rate', function(){ 

            var $discountSelect = $(this);

            var discount = parseInt($discountSelect.closest('.edit_prod_row').find('.edit_prod_dis').val())||0;

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


        /*update product detail*/

        $(function() {
            var form = $('#edit_prod_det');
            
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
                        url: "<?php echo base_url(); ?>Crm/SalesQuotation/UpdateProd",
                        method: "POST",
                        data: $(currentForm).serialize(),
                        success: function(data) {
                            var responseData = JSON.parse(data);

                           

                            $('#EditProdDet').modal('hide');

                            var quotID= (responseData.quotation_id);

                            $('.edit_btn[data-id="'+quotID+'"]').trigger('click');

                            alertify.success('Data Added Successfully').delay(3).dismissOthers();

                            datatable.ajax.reload(null, false);
                         
                        
                        }
                    });
                }
            });
        });

        /*#####*/


        /*edit add prod detail*/

        $("body").on('click', '.edit_add_prod_det', function(){ 

            $('#EditSalesQuotation').modal('hide');

            $('#EditAddProd').modal('show');

            var quoat_id =  $('.quoat_id').val();

            $('.edit_add_quot_id').val(quoat_id);

        });

        /**/


        /*edit add  quotation prod det*/
        $(".edit_add_quot_prod").select2({
            placeholder: "Select Customer",
            theme : "default form-control- customer_width",
            dropdownParent: $('#EditAddProd'),

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


        /**/

        /*calculation of edit add product detail*/


        $("body").on('keyup', '.edit_add_prod_dis , .edit_add_prod_qty , .edit_add_prod_rate', function(){ 

            var $discountSelect = $(this);

            var discount = parseInt($discountSelect.closest('.edit_add_prod_det_row').find('.edit_add_prod_dis').val())||0;

            var $discountSelectElement = $discountSelect.closest('.edit_add_prod_det_row').find('.edit_add_prod_rate');

            var rate = $discountSelectElement.val();

            var $quantitySelectElement = $discountSelect.closest('.edit_add_prod_det_row').find('.edit_add_prod_qty');

            var quantity = parseInt($quantitySelectElement.val())||0;

            var parsedRate = parseFloat(rate);

            var parsedQuantity = quantity; 

            var multipliedTotal = parsedRate * parsedQuantity;

            var per_amount = (discount/100)*multipliedTotal;

            var orginalPrice = multipliedTotal - per_amount;

            var orginalPrice = orginalPrice.toFixed(2); //For showing 1000.00 instead of 1000 if no decimal present

            var $amountElement = $discountSelect.closest('.edit_add_prod_det_row').find('.edit_add_prod_amount');

            $amountElement.val(orginalPrice);


        });
       

        /*####*/



        /*edit add  quotation prod detail*/

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
                        url: "<?php echo base_url(); ?>Crm/SalesQuotation/EditAddProd",
                        method: "POST",
                        data: $(currentForm).serialize(),
                        success: function(data) {
                            var responseData = JSON.parse(data);

                           

                            $('#EditAddProd').modal('hide');

                            $('#edit_add_prod_form')[0].reset();

                            $('.edit_add_quot_prod').val('').trigger('change');

                            var quotID= (responseData.quotation_id);

                            $('.edit_btn[data-id="'+quotID+'"]').trigger('click');

                            alertify.success('Data Added Successfully').delay(3).dismissOthers();

                            datatable.ajax.reload(null, false);
                         
                        
                        }
                    });
                }
            });
        });

        /*#####*/


        /*delete quot product detail*/


        $("body").on('click', '.delete_prod_btn', function(){ 

            id = $(this).data('id');

            var rowToDelete = $(this).closest('tr');

            $.ajax({

                url : "<?php echo base_url(); ?>Crm/SalesQuotation/DeleteProdDet",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {
                    var responseData = JSON.parse(data);

                    console.log(responseData.status)

                    if(responseData.status =="true")
                    {
                        rowToDelete.fadeOut(500, function() {
                            $(this).remove();
                            slno2();
                            EditProdTotal()
                            alertify.success('Data Delete Successfully').delay(3).dismissOthers();
                        }); 
                    }
                    else
                    {
                        alertify.error("Data Can't Be Delete").delay(3).dismissOthers();
                    }

                }

            });


        });

        function slno2(){
            
            var pp =1;

            $('body .edit_add_prod_row').each(function() {

                $(this).find('.edit_add_prod_si_no').html('<td class="si_no">' + pp + '</td>');

                pp++;
            });

        }


        /*######*/


        /*update tab section start*/

        $(function() {
            var form = $('#edit_sales_quot_form');
            
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
                        url: "<?php echo base_url(); ?>Crm/SalesQuotation/UpdateTab",
                        method: "POST",
                        data: $(currentForm).serialize(),
                        success: function(data) {
                            var responseData = JSON.parse(data);


                            var quotID= (responseData.quotation_id);

                            $('#EditSalesQuotation').modal("hide");

                           // $('.edit_btn[data-id="'+quotID+'"]').trigger('click');

                            alertify.success('Data Updated Successfully').delay(3).dismissOthers();

                            datatable.ajax.reload(null, false);
                         
                        
                        }
                    });
                }
            });
        });


        /*update tab section end*/



        /*edit calculation start*/


        function EditProdTotal()
	    {
            var total= 0;

            $('body .edit_prod_total_amount').each(function()
            {
                var sub_tot = parseFloat($(this).val());

                total += parseFloat(sub_tot.toFixed(2))||0;
           
            });

            total = total.toFixed(2);

            $('.edit_total_prod').val(total);

            EditPercentage();
 
        }

        function EditCalTotal()
	    {

            var total = 0; 
            
            $('body .edit_cal_amount').each(function()
            {   
                var sub_tot = parseFloat($(this).val());

                console.log(sub_tot);

                total += parseFloat(sub_tot.toFixed(2))||0;

            });

            total = total.toFixed(2);


            $('.edit_total_cost_cal').val(total);
            
            var result = numberToWords.toWords(total);

            EditPercentage()

	    }


        function EditPercentage()
        {
            var cost_total = parseFloat($('.edit_total_cost_cal').val());

            var quotation_total = parseFloat($('.edit_total_prod').val());

            if ( (!isNaN(cost_total)) && (!isNaN(quotation_total)) && (quotation_total !== 0)) 
            {
                var result = cost_total / quotation_total;

                var percentage = result * 100

                var percent =  percentage.toFixed(2)

                $('.edit_total_percent').val(percent);
 
            }

        }


        /*fetch  data by  enquiry ref*/

        $("body").on('change', '.edit_enquiry', function(){ 

            var id = $(this).val();
	        
            var cust_id = $('.edit_customer').val();
 
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

                    $(".edit_project").val(data.enquiry_project);

                    $(".edit_contact_person").html(data.customer_person);

                //InitProductSelect2();

                    //slno();


                }


            });
 
        });

         /**/



        


        /*edit calculation end*/



        /*view section start*/

        $("body").on('click', '.view_btn', function(){ 

            var id = $(this).data('id');

            //$('.quoat_id').val(id);

            $.ajax({

                url : "<?php echo base_url(); ?>Crm/SalesQuotation/View",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {
                    var responseData = JSON.parse(data);

                    $(".view_btn_ref").val(responseData.reffer_no);

                    $(".view_btn_date").val(responseData.date);

                    $(".view_btn_customer").val(responseData.customer_name);

                    $(".view_btn_enquiry").val(responseData.enquiry_reference);

                    $(".view_btn_validity").val(responseData.validity);

                    $(".view_btn_sales_exce").val(responseData.sales_executive);

                    $(".view_btn_contact_person").val(responseData.contact_person);

                    $(".view_btn_payment").val(responseData.payment_term);

                    $(".view_btn_delivery_term").val(responseData.delivery_term);

                    $(".view_btn_project").val(responseData.project);

                    $(".view_cost_cal").html(responseData.cost_details);

                    $(".view_prod_det").html(responseData.prod_details);

                    $(".view_btn_total_prod").val(responseData.sales_amount);

                    $(".view_btn_total_cost_cal").val(responseData.cost_amount);

                    $(".view_btn_total_percent").val(responseData.percentage);

                }

            });

            $('#ViewSalesQuotation').modal('show');

        });

        /*#####*/



        /*edit section end*/


        /*print section start*/

        $("body").on('click', '.print_quotation', function(){ 
            
            var id = $('.view_quot_id').val();

            $.ajax({

                url : "<?php echo base_url(); ?>Crm/SalesQuotation/Print",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {
                   // var responseData = JSON.parse(data);


                }

            });

            
        });

        /*#####*/

        window.addEventListener("message", function(event) {
           

            // Check the action type and handle accordingly
            if (event.data.action === 'triggerClick') {

                const quotId = event.data.quot_id;
                console.log('Received quotId:', quotId);

                // Check if the button exists in the DOM
                setTimeout(() => {
                    const $button = $('body .view_btn[data-id="' + quotId + '"]');
                    if ($button.length) {
                        $button.trigger('click');
                        console.log('Button clicked');
                    } else {
                        console.log('Button with data-id="' + quotId + '" not found');
                    }
                }, 100); // Adjust the timeout as needed
            }

        });



        $('#ViewSalesQuotation').on('hidden.bs.modal', function (e) {
             
            window.location.replace("<?php echo base_url();?>Crm/SalesQuotation");

        })


       

     

       


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

            //$(".cost_cal_amount_in_words").text(result);

           // $(".cost_cal_amount_in_words_val").val(result);

            Percentage()
         
        }


      
        
         



</script>


