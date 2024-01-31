<style>
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
    .cust_more_modal
    {
        position: absolute;
        left: 471px;
        padding: 2px 27px;
        z-index: 999;
        border: 1px solid black;
        border: 1px solid #0000003b;
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
                        <div class="modal fade" id="Enquiry" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="add_form1">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Enquiry</h5>
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
                                                                        <input type="text" name="enquiry_reff" class="form-control" value="<?php echo $enquiry_id; ?>" required readonly>
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
                                                                        <input type="date" name="enquiry_date" class="form-control" required>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 

                                                            <!-- Single Row Start -->
                                                            
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Customer<span class="add_more_icon cust_more_modal">New</span></label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <select class="form-select ser_customer" name="enquiry_customer" id="customer_id" style="width:80%;" required>
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
                                                                        <label for="basicInput" class="form-label">Contact Person<span class="add_more_icon contact_more_modal">New</span></label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <select class="form-select" name="enquiry_contact_person" id="contact_person_id" style="width: 80%;" required>
                                                                            <option value="" selected disabled>Contact Person</option>
                                                                
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
                                                                        <label for="basicInput" class="form-label">Assigned To</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                    <select class="form-select" name="enquiry_assign_to" required>
                                                                        <option value="" selected disabled>Assigned To</option>
                                                                        <?php foreach($employees as $employ){?> 
                                                                            <option value="<?php echo $employ->employees_id;?>"><?php echo $employ->employees_name;?></option>
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
                                                                        <label for="basicInput" class="form-label">Source</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="enquiry_source" class="form-control" required>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 

                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Time Frame</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="date" name="enquiry_time_frame" class="form-control" value="<?php echo $increment_date_date;?>" required>
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
                                                                        <input type="text" name="enquiry_project" class="form-control" required>
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
                                                        <tbody class="travelerinfo">
                                                            <tr>
                                                                <td>Serial No.</td>
                                                                <td>Product Description</td>
                                                                <td>Unit</td>
                                                                <td>Quantity</td>
                                                                <td>Action</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 10%;">1</td>
                                                                <td>
                                                                    <select class="form-select ser_product_det" name="pd_product_detail[]" required>
                                                                        <option selected>Select Product Description</option>
                                                                        <?php foreach($products as $prod){?>
                                                                            <option value="<?php echo $prod->product_id;?>"><?php echo $prod->product_details;?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
                                                                <td><input type="text" name="pd_unit[]" class="form-control" required></td>
                                                                <td><input type="number" name="pd_quantity[]" class="form-control" required></td>
                                                                <td><div class="tecs"><span id="add_product" class="add_icon"><i class="ri-add-circle-line"></i>Add </span></div></td>
                                                            </tr>
                                                        </tbody>
                                                        <tbody id="product-more" class="travelerinfo"></tbody>
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


                        <!--Customer Creation modal content start-->
                        <div class="modal fade" id="CustomerCreation" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="add_cus_form1">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Customer Creation</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                            <h5 class="modal-title" id="exampleModalLabel">Customer Creation</h5>
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
                                        <h4 class="card-title mb-0 flex-grow-1">View Enquiry</h4>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#Enquiry" class="btn btn-primary py-1">Add</button>
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
                errorPlacement: function(error, element) {} , // To Hide Validation Messages
                submitHandler: function(currentForm) {
                    // Submit the form for the current tab
                    $.ajax({
                        url: "<?php echo base_url(); ?>Crm/Enquiry/Add",
                        method: "POST",
                        data: $(currentForm).serialize(),
                        success: function(data) {
                            $('#add_form1')[0].reset();
                            $('#Enquiry').modal('hide');
                            alertify.success('Data Added Successfully').delay(3).dismissOthers();
                            datatable.ajax.reload(null, false);
                            
                        }
                    });
                }
            });
        });


        /* Select 2 Remove Validation On Change */
        $("select[name=enquiry_customer]").on("change",function(e) {
            $(this).parent().find(".error").removeClass("error");         
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
                'url': "<?php echo base_url(); ?>Crm/Enquiry/FetchData",
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
                { data: 'enquiry_id' },
                { data: 'enquiry_reff' },
                { data: 'enquiry_date'},
                { data: 'enquiry_customer'},
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

                url : "<?php echo base_url(); ?>Crm/Enquiry/ContactPerson",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {   
                    var data = JSON.parse(data);
                
                    $("#contact_person_id").html(data.customer_name);

                  
                    
                }


            });
        });

        /*add new customer creation section start*/ 


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
                            $('.account_head_clz').val('').trigger('change');
                            $('#Enquiry').modal('show');
                            alertify.success('Data Added Successfully').delay(3).dismissOthers();
                            datatable.ajax.reload(null, false);
                            
                        }
                    });
                }
            });
        });
        /**/

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
                            
                            $("#contact_person_id").html(responseData.contact_person);
                            
                            $('#ContactDeatils2').modal('hide');
                            
                            $('#Enquiry').modal('show');

                            $('#add_cus_form4')[0].reset();

                        }
                    });
                }
            });
        });

        /*###*/


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
            // Allow digits, hyphens, and spaces
            //$(this).val($(this).val().replace(/[^0-9\- ]/g, ''));
            $(this).val($(this).val().replace(/[^0-9+\- ]/g, ''));
        });


        $('#cc_fax').on('input', function() {
            
            $(this).val($(this).val().replace(/[^0-9+\- ]/g, ''));
        });


        /*$('.contact_mobile_clz').on('input', function() {
            
            $(this).val($(this).val().replace(/[^0-9+\- ]/g, ''));
        });*/

        $("body").on('keyup', '.contact_mobile_clz', function(){
           
            $(this).val($(this).val().replace(/[^0-9+\- ]/g, ''));
            
       });



        $('#edit_telephone_id').on('input', function() {
            // Allow digits, hyphens, and spaces
            $(this).val($(this).val().replace(/[^0-9\- ]/g, ''));
        });




       /*customer creation section end*/


       

        var max_fieldspp  = 30;
        var pp = 1;
        $("#add_product").click(function(){

			if(pp < max_fieldspp){ 
			    pp++;
	            $("#product-more").append("<tr><td><input type='number' value="+pp+" name='pd_serial_no[]' class='form-control ' required='' readonly></td><td><select class='form-select ser_product_det' name='pd_product_detail[]' required=''><option value='' selected disabled>Select Product Description</option><?php foreach($products as $prod){?><option value='<?php echo $prod->product_id;?>'><?php echo $prod->product_details;?></option><?php } ?></select></td><td><input type='text' name='pd_unit[]' class='form-control ' required=''></td><td><input type='number' name='pd_quantity[]' class='form-control ' required=''></td><td class='remove-btnpp' colspan='6'><div class='remainpass'><i class='ri-close-line'></i>Remove</div></td></tr>");
                 /*customer droup drown search*/
                 InitSelect2();
			}
	    });

        $(document).on("click", ".remove-btnpp", function() 
        {
	        $(this).parent().remove();
	        pp--;
        });


        /*add customer section start*/
         
        $("body").on('click', '.cust_more_modal', function(){ 
	        
           
            $('#Enquiry').modal('hide');

            $('#CustomerCreation').modal('show');

        });

     
        /*####*/

        
        /*add customer contact person section start*/
         
        $("body").on('click', '.contact_more_modal', function(){ 
	        
            var customer_id = $('#customer_id').val();

           

            if(customer_id === null)
            {
             
                alertify.success('Please Select Customer').delay(2).dismissOthers();
            
            }
            else{

                $('#Enquiry').modal('hide');

                $('#ContactDeatils2').modal('show');

                $('.customer_creation_id2').val(customer_id);

            }

        });

     
        /*####*/



        /*customer droup drown search*/
        $(".ser_customer").select2({
            placeholder: "Select Customer",
            theme : "default form-control- customer_width",
            dropdownParent: $('#Enquiry'),
            ajax: {
                url: "<?= base_url(); ?>Crm/Enquiry/FetchCustomer",
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




        /*Edit customer droup drown search*/

        $(".edit_ser_customer").select2({
            placeholder: "Select Customer",
            theme : "default form-control-",
            dropdownParent: $('#EditModal'),
            ajax: {
                url: "<?= base_url(); ?>Crm/Enquiry/EditFetchCustomer",
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




          /*Product Drop Down*/
          function InitSelect2(){
          $(".ser_product_det:last").select2({
            placeholder: "Select Product",
            theme : "default form-control-",
            dropdownParent: $('#Enquiry'),
            ajax: {
                url: "<?= base_url(); ?>Crm/Enquiry/FetchProdDes",
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


        /**/

        $("body").on('click', '.delete_btn', function(){ 
            
            if (!confirm('Are you absolutely sure you want to delete?')) return false;
            var id = $(this).data('id');
            $.ajax({

                url : "<?php echo base_url(); ?>Crm/Enquiry/Delete",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {
                    alertify.success('Data Deleted Successfully').delay(2).dismissOthers();

                    datatable.ajax.reload(null,false);
                }


            });

        });

        /**/


       
     

    });



</script>