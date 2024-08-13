<div class="tab-content text-muted">
								
    <div class="tab-pane active" id="nav-crm-top-1-1" role="tabpanel">
                    
        <div class="row">
            
            <div class="col-lg-12">
                
                <!-- Tab panes -->
                <div class="tab-content text-muted">
                    <!--product head tab--> 
                    <div class="tab-pane active" id="arrow-1" role="tabpanel">
                        
                        <!--Customer Creation modal content start-->
                        
                        <?= $this->include('crm/add_modal_customer') ?>

                        <!--Customer Creation content end-->


                        

                        

                        <!--view customer cretion start-->

                        <div class="modal fade" id="ViewCustomerCreation" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Customer Creation</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
				                        <div class="modal-body">

                                            <div class="sub_heading">
                                                <a href="javascript:void(0)" class="sub_heading_text sub_heading_btn view_cust_det_modal">Customer Details</a>
                                                <a href="javascript:void(0)" class="sub_heading_text sub_heading_btn view_cont_det_modal">Contact Details</a>
                                                <a href="javascript:void(0)" class="sub_heading_text sub_heading_btn view_offical_doc_modal">Official Documents</a>
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
                                                                        <input type="text"  class="form-control view_customer_name" readonly>
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
                                                                        <input type="text" class="form-control view_account_head" readonly>
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
                                                                        <input type="text" class="form-control view_account_id" readonly>
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
                                                                        <input type="number"  class="form-control view_post_box" readonly>
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
                                                                        <input type="text"  class="form-control view_telephone" readonly>
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
                                                                        <input type="text" class="form-control view_fax" readonly>
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
                                                                        <input type="email" class="form-control view_email" readonly>
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
                                                                        <input type="text" class="form-control view_credit_term" readonly>
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
                                                                        <input type="number"  class="form-control view_credit_period" readonly>
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
                                                                        <input type="number" class="form-control view_credit_limit" readonly>
                                                                    </div>

                                                                </div>
                                                            </div> 

                                                            <!-- ### -->

                                                          
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>   
					                           
						                       
					
					                        
				                        </div>
                                        
			                        </div>
		                        </form>

	                        </div>
                        </div>


                        <!--view customer creation end-->


                        <!--view contact detail start-->

                        <div class="modal fade" id="ViewContactDeatils" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="add_cond_detail">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Customer Creation</h5>
                                            <button type="button" class="btn-close view_modal_close"  aria-label="Close"></button>
                                        </div>
				                        <div class="modal-body">

                                          
                                            <div class="card-seprate_divider"></div>

                                            <div class="live-preview">
                                                <table  class="table table-bordered table-striped delTable">
                                                    <tbody class="travelerinfo">
                                                        <tr>
                                                            <td>No</td>
                                                            <td>Contact Person</td>
                                                            <td>Designation</td>
                                                            <td>Mobile</td>
                                                            <td>Email</td>
                                                            
                                                        </tr>
                                                        
                                                    </tbody>

                                                    <tbody class="view_contact_data" class="travelerinfo"></tbody>
                
                                                </table>
                                                
                                            </div>   
					                       
					                        
				                        </div>
                                        
			                        </div>
		                        </form>

	                        </div>
                        </div>



                        <!--view contact detail end-->


                        <!--view office document start-->

                        <div class="modal fade" id="ViewOfficalDocument" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog">
		                        <form  class="Dashboard-form class">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Official Documents</h5>
                                            <button type="button" class="btn-close view_modal_close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                                                <input type="number"   class="form-control view_cr_no" required>
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
                                                                <input type="text"  class="form-control view_cr_expiry" required>
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
                                                                <input type="number" class="form-control view_est_id" required>
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
                                                                <input type="text" class="form-control view_est_id_expery" required>
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
                                                                <input type="text"  class="form-control view_signature_name" required>
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
                                                                <input type="number" class="form-control view_qid_num" required>
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
                                                                <input type="text" class="form-control view_qid_expiry" required>
                                                            </div>
                                                        </div>
                                                      
                                                    </div>
                                                    

                                                    <!--####-->


                                                </div>
                                                    
                                            </div> 
                                            
                                            
                                            <!--image section start-->

                                            <div class="card-body">
                                                <table id="" class="table table-bordered table-striped delTable display dataTable" style="border: 1px solid #9E9E9E;">
                                                    <thead>
                                                        <tr>
                                                            
                                                            <th class="cust_img_rgt_border">CR No Attach</th>
                                                            <th class="cust_img_rgt_border">Est.ID Attach</th>
                                                            <th>QID Number</th>
                                                            
                                                        </tr>
                                                    </thead>
                                            
                                                    <tbody>
                                                        <tr>
                                                            <td class="cust_img_rgt_border view_cr_no_att" ></td>
                                                            <td class="cust_img_rgt_border view_est_id_att"></td>
                                                            <td class="view_qid_num_att"></td>
                                                        </tr>
                                                    </tbody>

                                                </table>
                
                                            </div>

                                            <!--image section end-->
					                           
						                       
					
					                        
				                        </div>
                                        
			                        </div>

		                        </form>

	                        </div>
                        </div>




                        <!--view office document ned-->



                        <!--edit customer creation start-->
                         
                        <div class="modal fade" id="EditCustomerCreation" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="edit_cust_creation">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Customer Creation</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
				                        <div class="modal-body">

                                            <div class="sub_heading">
                                                <a href="javascript:void(0)" class="sub_heading_text sub_heading_btn edit_customer_detail_modal">Customer Details</a>
                                                <a href="javascript:void(0)" class="sub_heading_text sub_heading_btn edit_contact_detail_modal">Contact Details</a>
                                                <a href="javascript:void(0)" class="sub_heading_text sub_heading_btn edit_offical_document_modal">Official Documents</a>
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
                                                                        <input type="text" name="cc_customer_name" class="form-control edit_customer_name" required>
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
                                                                        <select class="form-select edit_account_head_select account_head_clz edit_account_head" name="cc_account_head"  required>


                                                                        </select>
                                                                       
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
                                                                        <input type="text" name="cc_account_id" class="form-control edit_account_id" required readonly>
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
                                                                        <input type="number" name="cc_post_box" class="form-control edit_post_box" required>
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
                                                                        <input type="text" name="cc_telephone" id=""  class="form-control edit_telephone"  required>
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
                                                                        <input type="text" name="cc_fax" id="" class="form-control edit_fax" required>
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
                                                                        <input type="email" name="cc_email" class="form-control edit_email" required>
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
                                                                        <input type="text" name="cc_credit_term" class="form-control edit_credit_term" required>
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
                                                                        <input type="number" name="cc_credit_period" class="form-control edit_credit_period" required>
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
                                                                        <input type="number" name="cc_credit_limit" class="form-control edit_credit_limit" required>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            
                                                            <input type="hidden" class="edit_cc_id" name="cc_id">

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





                        <!--edit customer creation end-->


                        <!--edit contact details start-->


                        <div class="modal fade" id="EditContactDeatils" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="edit_cond_detail">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Contact Details</h5>
                                            <button type="button" class="btn-close edit_modal_close"  aria-label="Close"></button>
                                        </div>
				                        <div class="modal-body">

                                            <div class="card-seprate_divider"></div>

                                            <div class="live-preview">
                                                <table  class="table table-bordered table-striped delTable">
                                                    <tbody class="travelerinfo">
                                                        <tr>
                                                            <td >No</td>
                                                            <td>Contact Person</td>
                                                            <td>Designation</td>
                                                            <td>Mobile</td>
                                                            <td>Email</td>
                                                            <td>Action</td>
                                                            <td></td>
                                                        </tr>
                                                       
                                                    </tbody>
                                                    
                                                    <tbody class="edit_product-more" class="travelerinfo"></tbody>

                                                    <tr>
                                                        <td colspan="8" align="center" class="tecs">
                                                            <span class="add_icon edit_add_prod"><i class="ri-add-circle-line"></i>Add </span>
                                                        </td>
                                                    </tr>
                
                                                </table>
                                                
                                            </div>   
					                        
				                        </div>
                                        
			                        </div>
		                        </form>

	                        </div>
                        </div>


                        <!--edit single contact modal start-->

                        <div class="modal fade" id="EditSingleContact" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="edit_single_contact">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Contact Details</h5>
                                            <button type="button" class="btn-close sub_modal_close" ></button>
                                        </div>
				                        <div class="modal-body">

                                            <div class="card-seprate_divider"></div>

                                            <div class="live-preview">
                                                <table  class="table table-bordered table-striped delTable">
                                                    <tbody class="travelerinfo">
                                                        <tr>
                                                            <td >No</td>
                                                            <td>Contact Person</td>
                                                            <td>Designation</td>
                                                            <td>Mobile</td>
                                                            <td>Email</td>
                                                            
                                                            
                                                        </tr>
                                                       
                                                    </tbody>
                                                    
                                                    <tbody class="single_contact_edit" class="travelerinfo">
                                                        
                                                    </tbody>

                                                   
                
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


                        <!--edit single contact modal end-->


                        <!--edit add single contact modal start-->


                        <div class="modal fade" id="EditAddContact" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="edit_add_contact">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Contact Details</h5>
                                            <button type="button" class="btn-close  sub_modal_close"></button>
                                        </div>
				                        <div class="modal-body">

                                            <div class="card-seprate_divider"></div>

                                            <div class="live-preview">
                                                <table  class="table table-bordered table-striped delTable">
                                                    <tbody class="travelerinfo">
                                                        <tr>
                                                            <td >No</td>
                                                            <td>Contact Person</td>
                                                            <td>Designation</td>
                                                            <td>Mobile</td>
                                                            <td>Email</td>
                                                           
                                                        </tr>
                                                       
                                                    </tbody>
                                                    
                                                    <tbody class="" class="travelerinfo">

                                                        <tr>
                                                            <td>1</td>
                                                            <td><input type="text" name="contact_person" class="form-control" required></td>
                                                            <td><input type="text" name="contact_designation" class="form-control" required></td>
                                                            <td><input type="text" name="contact_mobile" class="form-control cond_telephone" required></td>
                                                            <td> <input type="email" name="contact_email" class="form-control" required></td>
                                                            <input type="hidden" name="contact_customer_creation" class="contact_add_cust">
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


                        <!--edit add single contact modal end-->




                        <!--edit contact details end-->



                        <!--edit office document start-->

                        <div class="modal fade" id="EditOfficalDocument" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog">
		                        <form  class="Dashboard-form class" id="edit_office_doc">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Official Documents</h5>
                                            <button type="button" class="btn-close edit_modal_close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                                                <input type="number" name="cc_cr_number" class="form-control edit_cr_no">
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
                                                                <input type="text" name="cc_cr_expiry" autocomplete="off" placeholder="dd-mm-yy" class="form-control datepicker edit_cr_expiry" >
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
                                                                <input type="number" name="cc_est_id" class="form-control edit_est_id" >
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
                                                                <input type="text" name="cc_est_id_expery" autocomplete="off" placeholder="dd-mm-yy" class="form-control datepicker edit_est_id_expery">
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
                                                                <input type="text" name="cc_signatory_name" class="form-control edit_signature_name" >
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
                                                                <input type="number" name="cc_qid_number" class="form-control edit_qid_number" >
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
                                                                <input type="text" name="cc_qid_expiry" autocomplete="off" placeholder="dd-mm-yy" class="form-control datepicker edit_qid_expiry" >
                                                            </div>
                                                        </div>
                                                      
                                                    </div>
                                                    

                                                    <!--####-->

                                                    <!--image section start-->

                                                    <div class="card-body">
                                                        <table id="" class="table table-bordered table-striped delTable display dataTable" style="border: 1px solid #9E9E9E;">
                                                            <thead>
                                                                
                                                                <tr>
                                                                    
                                                                    <th class="cust_img_rgt_border cust_img_text_stl" style="width:50%">Name</th>
                                                                    <th class="cust_img_rgt_border cust_img_text_stl" style="width:40%">View</th>
                                                                    <th class="cust_img_text_stl">Edit</th>
                                                                    
                                                                </tr>

                                                            </thead>
                                                    
                                                            <tbody>

                                                                <tr>
                                                                    <td class="cust_img_rgt_border  cust_img_text_stl" >CR Attach</td>
                                                                    <td class="cust_img_rgt_border edit_cr_attach"></td>
                                                                    <td class=""><input type="file" name="cc_attach_cr"></td>
                                                                </tr>

                                                                <tr>
                                                                    <td class="cust_img_rgt_border  cust_img_text_stl" >Est.ID Attach</td>
                                                                    <td class="cust_img_rgt_border edit_est_id_attach"></td>
                                                                    <td class=""><input type="file" name="cc_est_id_attach"></td>
                                                                </tr>

                                                                <tr>
                                                                    <td class="cust_img_rgt_border  cust_img_text_stl" >QID Attach</td>
                                                                    <td class="cust_img_rgt_border edit_qid_attach"></td>
                                                                    <td class=""><input type="file" name="cc_qid_attach"></td>
                                                                </tr>


                                                            </tbody>

                                                        </table>
                        
                                                    </div>

                                                    <!--image section end-->

                                                    <input type="hidden" class="edit_cc_id" name="cc_id">

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

                         

                        <!--edit office document end-->



                        
                        <!--view datatable section start-->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">View Customer Creation</h4>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#AddCustomerCreation" class="btn btn-primary py-1 add_model_btn">Add</button>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <table id="DataTable" class="table table-bordered table-striped delTable display dataTable">
                                            <thead>
                                                <tr>
                                                    <th class="no-sort">Sl no</th>
                                                    <th>Customer Name</th>
                                                    <th>Post Box</th>
                                                    <th>Phone Number</th>
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

                        <!--view datatable section end-->



                    </div>
                    <!--###-->


                </div>
                   
                    
            </div>
                    
        </div>
                    
                    
    </div>
                    
    
                        
</div>







<script>

    document.addEventListener("DOMContentLoaded", function(event) { 
        
       

        /*view customer creation start*/

         
        /*view*/

        $("body").on('click', '.view_btn', function(){ 
            
            var id = $(this).data('id');
           
            $.ajax({

                url : "<?php echo base_url(); ?>Crm/CustomerCreation/View",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {   
                    var data = JSON.parse(data);
                    
                    $('.view_customer_name').val(data.customer_name);

                    $('.view_account_head').val(data.account_name);

                    $('.view_account_id').val(data.account_id);

                    $('.view_post_box').val(data.post_box);

                    $('.view_telephone').val(data.phone);

                    $('.view_fax').val(data.fax);

                    $('.view_email').val(data.email);

                    $('.view_credit_term').val(data.credit_term);

                    $('.view_credit_period').val(data.credit_period);

                    $('.view_credit_limit').val(data.credit_limit);

                    $('.view_contact_data').html(data.contact);

                    $('.view_cr_no').val(data.cr_num);

                    $('.view_cr_expiry').val(data.cr_expiry);

                    $('.view_est_id').val(data.est_id);

                    $('.view_est_id_expery').val(data.est_id_expery);

                    $('.view_signature_name').val(data.signatory_name);

                    $('.view_qid_num').val(data.qid_number);

                    $('.view_qid_expiry').val(data.qid_expiry);

                    $('.view_cr_no_att').html(data.cc_attach_cr);

                    $('.view_est_id_att').html(data.cc_est_id_attach);

                    $('.view_qid_num_att').html(data.cc_qid_attach);

                    $('#ViewCustomerCreation').modal('show');
 
                 
                }


            });
            
            
        });

        /*####*/



        /* show view contact detail modal*/ 
         
        $('.view_cont_det_modal').on('click', function() {
          
          $('#ViewCustomerCreation').modal('hide');

          $('#ViewContactDeatils').modal('show');
          
          
       });

       /*####*/


       /*show view offical document  modal*/

       $('.view_offical_doc_modal').on('click', function() {
          
          $('#ViewContactDeatils').modal('hide');

          $('#ViewCustomerCreation').modal('hide');

          $('#ViewOfficalDocument').modal('show');
          
          
       });

       /*####*/
       

       /*view modal close section start*/

       $('.view_modal_close').on('click', function() {
          
          $('#ViewCustomerCreation').modal('show');

          $('#ViewContactDeatils').modal('hide');
          
          
       });

       /*###*/





        /*view customer creation end*/



        /*edit customer creation start*/


         
        /*Edit Section start*/


        $("body").on('click', '.edit_btn', function(){ 

            var id = $(this).data('id');

            $.ajax({

                url : "<?php echo base_url(); ?>Crm/CustomerCreation/Edit",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {   
                    var data = JSON.parse(data);
                    
                    $('.edit_customer_name').val(data.customer_name);

                    $('.edit_account_id').val(data.account_id);

                    $('.edit_post_box').val(data.post_box);

                    $('.edit_telephone').val(data.telephone);

                    $('.edit_fax').val(data.fax);

                    $('.edit_email').val(data.email);

                    $('.edit_credit_term').val(data.credit_term);

                    $('.edit_credit_period').val(data.credit_period);

                    $('.edit_credit_limit').val(data.credit_limit);

                    $('.edit_account_head').html(data.account_head);

                    $('.edit_cc_id').val(data.cust_id);

                    
                    //contact details

                    $('.edit_product-more').html(data.contact);


                    //official document

                    $('.edit_cr_no').val(data.cr_no);

                    $('.edit_cr_expiry').val(data.cr_expiry);

                    $('.edit_est_id').val(data.est_id);

                    $('.edit_est_id_expery').val(data.est_id_expery);

                    $('.edit_signature_name').val(data.signatory_name);

                    $('.edit_qid_number').val(data.qid_number);

                    $('.edit_qid_expiry').val(data.qid_expiry);

                    $('.edit_cr_attach').html(data.cc_attach_cr);

                    $('.edit_est_id_attach').html(data.cc_est_id_attach);

                    $('.edit_qid_attach').html(data.cc_qid_attach);
                  
                   $('#EditCustomerCreation').modal('show');
                
                }


            });


        });

        /*####*/


        /*edit create account id by account head*/ 
         
        $('.edit_account_head').on('change', function() {
          

           var id = $(this).val();

           var cust_id = $('.edit_cc_id').val();

            $.ajax({

               url : "<?php echo base_url(); ?>Crm/CustomerCreation/Code",

               method : "POST",

               data: {ID: id,
                      custID: cust_id,
                },

               success:function(data)
               {   
                   var data = JSON.parse(data);
                  
                  $(".edit_account_id").val(data.account_id);
                  
                   
               }


           });
         
           
        });

      /*####*/



      /*delete single contact section start*/


        
        $("body").on('click','.delete_contact', function(){  
          
           var id = $(this).data('id');

           
           var rowToDelete = $(this).closest('tr');

            $.ajax({

                url : "<?php echo base_url(); ?>Crm/CustomerCreation/DeleteContact",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {   
                    rowToDelete.fadeOut(500, function(){
                        $(this).remove();
                        slno1();
                        alertify.success('Data Delete Successfully').delay(3).dismissOthers();
                    }); 

                }


            });
        
          
        });


      /*delete single contact section end*/


        /*edit droup drown*/
        
        $(".edit_account_head_select1").select2({
        //placeholder: "Select Account Name",
        theme : "default form-control-",
        dropdownParent: $('#EditCustomerCreation'),
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
                        results: $.map(data.result, function (item) { return {id: item.ah_id, text: item.ah_account_name}}),
                        pagination: {
                        // THE `10` SHOULD BE SAME AS `$resultCount FROM PHP, it is the number of records to fetch from table` 
                            more: (page * 10) <= data.total_count
                        }
                    };
                },              
            }
        })

        /*###*/

        /*edit customer creation*/    
        $(function() {
            var form = $('#edit_cust_creation');
            
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
                        url: "<?php echo base_url(); ?>Crm/CustomerCreation/UpdateTab1",
                        method: "POST",
                        data: $(currentForm).serialize(),
                        success: function(data) {
                            var responseData = JSON.parse(data);

                            var custID = responseData.customer_creation_id;

                            $('#EditCustomerCreation').modal('hide')

                            //$('.view_btn[data-id="'+custID+'"]').trigger('click');

                            alertify.success('Data updated Successfully').delay(3).dismissOthers();

                            datatable.ajax.reload(null, false);
                           

                        }
                    });
                }
            });
        });
        /*####*/


        /*edit contact details*/

        $(function() {
            var form = $('#edit_single_contact');
            
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
                        url: "<?php echo base_url(); ?>Crm/CustomerCreation/UpdateSingleContact",
                        method: "POST",
                        data: $(currentForm).serialize(),
                        success: function(data) {

                            var responseData = JSON.parse(data);

                            var custID = responseData.customer_creation_id;

                            $('#EditSingleContact').modal('hide');

                            $('.view_btn[data-id="'+custID+'"]').trigger('click');

                           

                            alertify.success('Data updated Successfully').delay(3).dismissOthers();

                            datatable.ajax.reload(null, false);
                           

                        }
                    });
                }
            });
        });

        /*edit contact details*/


        $(function() {
            
            var form = $('#edit_add_contact');
            
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
                        url: "<?php echo base_url(); ?>Crm/CustomerCreation/AddSingleContact",
                        method: "POST",
                        data: $(currentForm).serialize(),
                        success: function(data) {

                            var responseData = JSON.parse(data);

                            var custID = responseData.cust_id;

                            $('#EditAddContact').modal('hide');
                              
                            $('#edit_add_contact')[0].reset();
                           
                            alertify.success('Data Added Successfully').delay(3).dismissOthers();

                            datatable.ajax.reload(null, false);
                           

                        }
                    });
                }
            });
        });



        /*edit add contact details*/


        /*edit offical document start*/
        
        $(function() {
            var form = $('#edit_office_doc');
            
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
                        url: "<?php echo base_url(); ?>Crm/CustomerCreation/UpdateTab3",
                        method: "POST",
                        data: formData,
                        processData: false, // Don't process the data
                        contentType: false, // Don't set content type
                        success: function(data) {
                            $('#add_cust_creation')[0].reset();
                            $('#add_cond_detail')[0].reset();
                            $('#add_office_doc')[0].reset();
                            $('#EditOfficalDocument').modal('hide');
                           
                            alertify.success('Data Added Successfully').delay(3).dismissOthers();
                            datatable.ajax.reload(null, false);
                        }
                    });
                }
            });
        });

        /*####*/


        /*show contact modal*/

        $('.edit_contact_detail_modal').on('click', function() {
          
            $('#EditContactDeatils').modal('show');

            $('#EditCustomerCreation').modal('hide');


        });
        
        /*####*/



        /*serial no correction section start*/

        


        function slno1(){
            
            var pp =1;
            
            $('body .edit_prod_row').each(function() {

                $(this).find('.si_no1').html('<td class="si_no1">' + pp + '</td>');

                pp++;

            });
        }

        /*###*/


        /*show single modal start*/

      
        $("body").on('click', '.row_contact_edit', function(){

          
            $('#EditContactDeatils').modal('hide');

            $('#EditSingleContact').modal('show');

            var id = $(this).data("id");

            $.ajax({

                url : "<?php echo base_url(); ?>Crm/CustomerCreation/FetchSingleContact",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {   
                    var data = JSON.parse(data);

                    $(".single_contact_edit").html(data.single_contact);
                   
                }


            });

         

        });
      
        /*####*/



        /*show edit add product modal*/

        $("body").on('click', '.edit_add_prod', function(){

            $('#EditContactDeatils').modal('hide');

            $('#EditAddContact').modal('show');

            var contact_cust = $('.contact_cust').val();

            $('.contact_add_cust').val(contact_cust);

            
        });


        /*####*/


        /*edit modal close to main modal*/

        $('.edit_modal_close').on('click',function(){

            $('#EditContactDeatils').modal('hide');

            $('#EditCustomerCreation').modal('show');

          

        });


        /**####*/



        /*edit sub modal close to main modal*/

        $('.sub_modal_close').on('click',function(){

            $('#EditContactDeatils').modal('show');

            $('#EditSingleContact').modal('hide');

            $('#EditAddContact').modal('hide');

        });


        /*########*/



        /*office document modal show*/
        
        $('.edit_offical_document_modal').on('click',function(){

            $('#EditCustomerCreation').modal('hide');

            $('#EditOfficalDocument').modal('show');

           
        });

        /*#######*/






       // $('.cond_telephone').on('input', function() {
          $("body").on('input','.cond_telephone',function(){
            
            $(this).val($(this).val().replace(/[^0-9+\- ]/g, ''));
        });
        
       

        $('.edit_fax').on('input', function() {
            
            $(this).val($(this).val().replace(/[^0-9+\- ]/g, ''));

           

        });


        /*edit cutsomer creation end*/



        /*delete customer creation start*/

        
        $('body').on('click','.delete_btn',function(){
            
            var id = $(this).data('id');

            if (!confirm('Are you absolutely sure you want to delete?')) return false;

            $.ajax({

            url : "<?php echo base_url(); ?>Crm/CustomerCreation/Delete",

            method : "POST",

            data: {ID: id},

            success:function(data)
            {   
                var data = JSON.parse(data);

                if(data.status=='true'){

                    alertify.success('Data Delete Successfully').delay(3).dismissOthers();
                    datatable.ajax.reload(null, false);
                }
                else{

                    alertify.error("Customer In Use Cant't Delete").delay(3).dismissOthers();
                }
            }


            });


        });
        
        /*delete customer creation end*/


        /*data table start*/ 

        function initializeDataTable() {

            datatable = $('#DataTable').DataTable({
                'stateSave': true,
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': 
                {
                    'url': "<?php echo base_url(); ?>Crm/CustomerCreation/FetchData",
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
                    { data: 'cc_id' },
                    { data: 'cc_customer_name' },
                    { data: 'cc_post_box'},
                    { data: 'cc_telephone'},
                    { data: 'action'},
                    
                ]

            });
        }

        $(document).ready(function () {
            initializeDataTable();
        });

        /*###*/


        /*####*/

        $('.add_model_btn').click(function(){

            $('#add_cust_creation')[0].reset();

            $('#add_cond_detail')[0].reset();

            $('#add_office_doc')[0].reset();

            $('.account_head_clz').val('').trigger('change');

           

        });


        /*####*/
});
        


</script>