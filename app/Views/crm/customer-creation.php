<div class="tab-content text-muted">
								
    <div class="tab-pane active" id="nav-crm-top-1-1" role="tabpanel">
                    
        <div class="row">
            
            <div class="col-lg-12">
                
                <!-- Tab panes -->
                <div class="tab-content text-muted">
                    <!--product head tab--> 
                    <div class="tab-pane active" id="arrow-1" role="tabpanel">
                        
                        <!--modal content start-->
                        <div class="modal fade" id="AddModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Customer Creation</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs nav-border-top-primary" role="tablist" style="margin-bottom: 20px;">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link src-nav-link active" id="tab1-tab" data-bs-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">Customer Details</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link src-nav-link"  id="tab2-tab" data-bs-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false">Contact Details</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link src-nav-link" id="tab3-tab" data-bs-toggle="tab" href="#tab3" role="tab" aria-controls="tab3" aria-selected="false">Official Documents</a>
                                            </li>
                                            <!-- Add more tabs as needed -->
                                        </ul>

                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                                                <form class="Dashboard-form class" id="add_form1">
                                                    <!-- Tab 1 content goes here -->
                                                    <div class="row">

                                                        <div class="col-md-3 col-lg-3">
                                                            <label for="basiInput" class="form-label">Customer Name</label>
                                                            <input type="text" name="cc_customer_name" class="form-control" required>
                                                        </div>

                                                        <div class="col-md-2 col-lg-2">
                                                            <label for="basicInput" class="form-label">Account ID (Linked with GL)</label>
                                                            
                                                            <select class="form-select" name="cc_account_id" required>
                                                                <option value="" selected disabled>Select Account ID</option>
                                                                <?php foreach($charts_accounts as $chart_account){?> 
                                                                    <option value="<?php echo $chart_account->ca_id;?>"><?php echo $chart_account->ca_account_id;?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>

                                                        <div class="col-md-2 col-lg-2">
                                                            <label for="basicInput" class="form-label">Post Box</label>
                                                            <input type="text" name="cc_post_box" class="form-control" required>
                                                        </div>

                                                        <div class="col-md-2 col-lg-2">
                                                            <label for="basicInput" class="form-label">Telephone</label>
                                                            <input type="number" name="cc_telephone" class="form-control" required>
                                                        </div>

                                                        <div class="col-md-2 col-lg-2">
                                                            <label for="basicInput" class="form-label">Fax</label>
                                                            <input type="number" name="cc_fax" class="form-control" required>
                                                        </div>

                                                        <div class="col-md-2 col-lg-2">
                                                            <label for="basicInput" class="form-label">Email</label>
                                                            <input type="text" name="cc_email" class="form-control" required>
                                                        </div>

                                                        <div class="col-md-2 col-lg-2">
                                                            <label for="basicInput" class="form-label">Credit Term</label>
                                                            <input type="text" name="cc_credit_term" class="form-control" required>
                                                        </div>

                                                        <div class="col-md-2 col-lg-2">
                                                            <label for="basicInput" class="form-label">Credit Period (Days)</label>
                                                            <input type="text" name="cc_credit_period" class="form-control" required>
                                                        </div>

                                                        <div class="col-md-2 col-lg-2">
                                                            <label for="basicInput" class="form-label">Credit Limit</label>
                                                            <input type="text" name="cc_credit_limit" class="form-control" required>
                                                        </div>

                                                        <div class="col-md-2 col-lg-2">
                                                            <label for="basicInput" class="form-label">GL Account Type</label>
                                                            
                                                            <select class="form-select" name="cc_account_type" required>
                                                                <option value="" selected disabled>Select GL Account Type</option>
                                                                <?php foreach($accounts_type as $account_type){?> 
                                                                <option value="<?php echo $account_type->at_id;?>"><?php echo $account_type->at_name;?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>

                                                    </div>

                                                    <div class="modal-footer justify-content-center">
                                                        <button class="btn btn btn-success">Save</button>
                                                    </div>

                                                </form>
                                            </div>
                                                
                                            
                                            
                                            
                                            <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                                                <form class="Dashboard-form class" id="add_form2">
                                                        <!-- Tab 2 content goes here -->
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
                                                                <td><input type="number" name="contact_mobile[]" class="form-control " required></td>
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
                                                </form> 
                                            </div>


                                            <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
                                                <form class="Dashboard-form class" id="add_form3" enctype= multipart/form-data>
                                                    <!-- Tab 3 content goes here -->
                                                    <div class="row">

                                                        <div class="col-md-2 col-lg-2">
                                                            <label for="basiInput" class="form-label">CR Number</label>
                                                            <input type="text" name="cc_cr_number" class="form-control" required>
                                                        </div>

                                                        <div class="col-md-2 col-lg-2">
                                                            <label for="basicInput" class="form-label">Expiry Date</label>
                                                            <input type="date" name="cc_expiry_date" class="form-control" required>
                                                        </div>

                                                        <div class="col-md-2 col-lg-2">
                                                            <label for="basicInput" class="form-label">	Attach CR</label>
                                                            <input type="file" name="cc_attach_cr" class="form-control" required>
                                                        </div>

                                                        <div class="col-md-2 col-lg-2">
                                                            <label for="basicInput" class="form-label">Establishment Card No</label>
                                                            <input type="text" name="cc_est_card_no" class="form-control" required>
                                                        </div>

                                                        <div class="col-md-2 col-lg-2">
                                                            <label for="basicInput" class="form-label">Expiry Date</label>
                                                            <input type="date" name="cc_est_expiry_date" class="form-control" required>
                                                        </div>

                                                        <div class="col-md-2 col-lg-2">
                                                            <label for="basicInput" class="form-label">Attach Establishment Card</label>
                                                            <input type="file" name="cc_est_attach_card" class="form-control" required>
                                                        </div>

                                                        <div class="col-md-2 col-lg-2">
                                                            <label for="basicInput" class="form-label">Authorized Signatory Name</label>
                                                            <input type="text" name="cc_est_signatory_name" class="form-control" required>
                                                        </div>

                                                        <div class="col-md-2 col-lg-2">
                                                            <label for="basicInput" class="form-label">ID Card Number</label>
                                                            <input type="text" name="cc_card_number" class="form-control" required>
                                                        </div>

                                                        <div class="col-md-2 col-lg-2">
                                                            <label for="basicInput" class="form-label">ID Card Expiry</label>
                                                            <input type="date" name="cc_id_card_expiry_date" class="form-control" required>
                                                        </div>

                                                        <div class="col-md-2 col-lg-2">
                                                            <label for="basicInput" class="form-label">Attach ID Card</label>
                                                            <input type="file" name="cc_id_card" class="form-control" required>
                                                        </div>

                                                        <input type="hidden" class="customer_creation_id" name="customer_creation">
                                                        <div class="modal-footer justify-content-center">
                                                            <button class="btn btn btn-success">Save</button>
                                                        </div>

                                                    </div>
                                                </form>

                                            </div>



                                        </div>

                                    </div>
                                    
                                </div>
                                
                            </div>
                        </div>


                        <!--modal content end-->



                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">View Customer Creation</h4>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#AddModal" class="btn btn-primary py-1">Add</button>
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

<!--view modal section start-->

<div class="modal fade" id="ViewModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
                                
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Customer Creation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-border-top-primary" role="tablist" style="margin-bottom: 20px;">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link src-nav-link active" id="tab1-tab" data-bs-toggle="tab" href="#tab4" role="tab" aria-controls="tab1" aria-selected="true">Customer Details</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link src-nav-link"  id="tab2-tab" data-bs-toggle="tab" href="#tab5" role="tab" aria-controls="tab2" aria-selected="false">Contact Details</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link src-nav-link" id="tab3-tab" data-bs-toggle="tab" href="#tab6" role="tab" aria-controls="tab3" aria-selected="false">Official Documents</a>
                    </li>
                    <!-- Add more tabs as needed -->
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab4" role="tabpanel" aria-labelledby="tab1-tab">
                        <form class="Dashboard-form class" id="">
                            <!-- Tab 1 content goes here -->
                            <div class="row">
                                
                                <div class="col-md-2 col-lg-2">
                                    <label for="basiInput" class="form-label">Customer Name</label>
                                    <input type="text"  id="cc_customer_name_id" class="form-control" disabled>
                                </div>

                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Account ID (Linked with GL)</label>
                                    <input type="text"  id="cc_account_id_view" class="form-control" disabled>
                                   
                                </div>

                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Post Box</label>
                                    <input type="text"  id="cc_post_box_id" class="form-control" disabled>
                                </div>

                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Telephone</label>
                                    <input type="text" id="cc_telephone_id" class="form-control" disabled>
                                </div>

                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Fax</label>
                                    <input type="text"  id="cc_fax_id" class="form-control" disabled>
                                </div>

                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Email</label>
                                    <input type="text"  id="cc_email_id" class="form-control" disabled>
                                </div>

                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Credit Term</label>
                                    <input type="text"  id="cc_credit_term_id" class="form-control" disabled>
                                </div>

                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Credit Period (Days)</label>
                                    <input type="text"  id="cc_credit_period_id" class="form-control" disabled>
                                </div>

                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Credit Limit</label>
                                    <input type="text"  id="cc_credit_limit_id" class="form-control" disabled>
                                </div>

                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">GL Account Type</label>
                                    <input type="text"  id="cc_account_type_id" class="form-control" disabled>
                                </div>
                            </div>

                            <div class="modal-footer justify-content-center"></div>
                        </form>
                    </div>
                                                
                                            
                                            
                                            
                    <div class="tab-pane fade" id="tab5" role="tabpanel" aria-labelledby="tab2-tab">
                        <form class="Dashboard-form class" id="contact_details">
                                <!-- Tab 2 content goes here -->
                            
                            
                            <div class="modal-footer justify-content-center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                
                            </div>
                        </form> 
                    </div>


                    <div class="tab-pane fade" id="tab6" role="tabpanel" aria-labelledby="tab3-tab">
                        <form class="Dashboard-form class" id="" enctype= multipart/form-data>
                            <!-- Tab 3 content goes here -->
                            <div class="row">

                                <div class="col-md-2 col-lg-2">
                                    <label for="basiInput" class="form-label">CR Number</label>
                                    <input type="text" id="cc_cr_number_id" class="form-control" disabled>
                                </div>

                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Expiry Date</label>
                                    <input type="date" id="cc_expiry_date_id" class="form-control" disabled>
                                </div>
                                
                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Establishment Card No</label>
                                    <input type="text" id="cc_est_card_no_id" class="form-control" disabled>
                                </div>

                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Expiry Date</label>
                                    <input type="date" id="cc_est_expiry_date_id" class="form-control" disabled>
                                </div>
                                
                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Authorized Signatory Name</label>
                                    <input type="text" id="cc_est_signatory_name_id" class="form-control" disabled>
                                </div>

                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">ID Card Number</label>
                                    <input type="text" id="cc_card_number_id" class="form-control" disabled>
                                </div>

                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">ID Card Expiry</label>
                                    <input type="date" id="cc_id_card_expiry_date_id" class="form-control" disabled>
                                </div>

                                <div class="col-lg-12 tab_attachment_head">
                                    <h5 class="">Attachments</h5>
                                    <table  class="table table-bordered table-striped delTable view_tab_cond">
                                        <tbody class="travelerinfo">
                                            
                                            <tr>
                                                <td width="25%">Label</td>
                                                <td width="25%">View</td>

                                                <td width="25%">Attach CR</td>
                                                <td width="25%" id="attach_cr_id"></td>
                                            </tr>
                                            
                                            
                                            <tr>
                                                <td>Attach Establishment Card</td>
                                                <td id="attach_est_card"></td>
                                                <td>Attach ID Card</td>
                                                <td id="attach_id_card"></td>
                                            </tr>


                                        </tbody>


                                    </table>

                                </div>
                                
                                
                                <div class="modal-footer justify-content-center">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    
                                </div>
                            </div>
                        </form>

                    </div>


                </div>

            </div>
                                    
        </div>
                                
    </div>

</div>

<!--view  modal section end-->




<!--edit modal section start-->

<div class="modal fade" id="EditModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Customer Creation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-border-top-primary" role="tablist" style="margin-bottom: 20px;">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link src-nav-link active" id="tab7-tab" data-bs-toggle="tab" href="#tab7" role="tab" aria-controls="tab1" aria-selected="true">Customer Details</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link src-nav-link"  id="tab8-tab" data-bs-toggle="tab" href="#tab8" role="tab" aria-controls="tab2" aria-selected="false">Contact Details</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link src-nav-link" id="tab9-tab" data-bs-toggle="tab" href="#tab9" role="tab" aria-controls="tab3" aria-selected="false">Official Documents</a>
                    </li>
                    <!-- Add more tabs as needed -->
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab7" role="tabpanel" aria-labelledby="tab1-tab">
                        <form class="Dashboard-form class" id="">
                            <!-- Tab 1 content goes here -->
                            <div class="row">
                                <div class="col-md-2 col-lg-2">
                                    <label for="basiInput" class="form-label">Customer Name</label>
                                    <input type="text"  id="edit_customer_name_id" class="form-control" >
                                </div>

                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Account ID (Linked with GL)</label>
                                    <!--<input type="text"  id="edit_account_id_view" class="form-control">-->
                                    <select id="edit_account_id_view" class="form-control"></select>
                                   
                                </div>

                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Post Box</label>
                                    <input type="text"  id="edit_post_box_id" class="form-control">
                                </div>

                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Telephone</label>
                                    <input type="text" id="edit_telephone_id" class="form-control">
                                </div>

                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Fax</label>
                                    <input type="text"  id="edit_fax_id" class="form-control">
                                </div>

                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Email</label>
                                    <input type="text"  id="edit_email_id" class="form-control">
                                </div>

                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Credit Term</label>
                                    <input type="text"  id="edit_credit_term_id" class="form-control">
                                </div>

                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Credit Period (Days)</label>
                                    <input type="text"  id="edit_credit_period_id" class="form-control">
                                </div>

                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Credit Limit</label>
                                    <input type="text"  id="edit_credit_limit_id" class="form-control">
                                </div>

                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">GL Account Type</label>
                                    <select id="edit_account_type_id" class="form-select"></select>
                                </div>
                                
                            </div>
                            <div class="modal-footer justify-content-center">
                                <button class="btn btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                                                
                                            
                                            
                                            
                    <div class="tab-pane fade" id="tab8" role="tabpanel" aria-labelledby="tab2-tab">
                        <form class="Dashboard-form class" id="edit_contact_details">
                                <!-- Tab 2 content goes here -->
                            
                            
                            <div class="modal-footer justify-content-center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                
                            </div>
                        </form> 
                    </div>


                    <div class="tab-pane fade" id="tab9" role="tabpanel" aria-labelledby="tab3-tab">
                        <form class="Dashboard-form class" id="" enctype= multipart/form-data>
                            <!-- Tab 3 content goes here -->
                            <div class="row">

                                <div class="col-md-2 col-lg-2">
                                    <label for="basiInput" class="form-label">CR Number</label>
                                    <input type="text" id="cc_cr_number_id" class="form-control" disabled>
                                </div>

                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Expiry Date</label>
                                    <input type="date" id="cc_expiry_date_id" class="form-control" disabled>
                                </div>
                                
                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Establishment Card No</label>
                                    <input type="text" id="cc_est_card_no_id" class="form-control" disabled>
                                </div>

                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Expiry Date</label>
                                    <input type="date" id="cc_est_expiry_date_id" class="form-control" disabled>
                                </div>
                                
                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Authorized Signatory Name</label>
                                    <input type="text" id="cc_est_signatory_name_id" class="form-control" disabled>
                                </div>

                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">ID Card Number</label>
                                    <input type="text" id="cc_card_number_id" class="form-control" disabled>
                                </div>

                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">ID Card Expiry</label>
                                    <input type="date" id="cc_id_card_expiry_date_id" class="form-control" disabled>
                                </div>

                                <div class="col-lg-12 tab_attachment_head">
                                    <h5 class="">Attachments</h5>
                                    <table  class="table table-bordered table-striped delTable view_tab_cond">
                                        <tbody class="travelerinfo">
                                            
                                            <tr>
                                                <td width="25%">Label</td>
                                                <td width="25%">View</td>

                                                <td width="25%">Attach CR</td>
                                                <td width="25%" id="attach_cr_id"></td>
                                            </tr>
                                            
                                            
                                            <tr>
                                                <td>Attach Establishment Card</td>
                                                <td id="attach_est_card"></td>
                                                <td>Attach ID Card</td>
                                                <td id="attach_id_card"></td>
                                            </tr>


                                        </tbody>


                                    </table>

                                </div>
                                
                                
                                <div class="modal-footer justify-content-center">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    
                                </div>

                            </div>
                        </form>

                    </div>


                </div>

            </div>
                                    
        </div>
                                
    </div>

</div>

<!--edit  modal section end-->




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
                        url: "<?php echo base_url(); ?>Crm/CustomerCreation/Add",
                        method: "POST",
                        data: $(currentForm).serialize(),
                        success: function(data) {
                            var responseData = JSON.parse(data);
                            
                            $(".customer_creation_id").val(responseData.customer_creation_id);
                            // Trigger a click event on the next tab
                            var nextTab = $('.nav-tabs .src-nav-link.active').parent().next().find("a");
                            if (nextTab.length > 0) {
                                nextTab.tab('show');
                            } else {
                                console.error("Next tab not found!");
                            }
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
                        url: "<?php echo base_url(); ?>Crm/CustomerCreation/AddTab2",
                        method: "POST",
                        data: $(currentForm).serialize(),
                        success: function(data) {
                        
                            
                            // Trigger a click event on the next tab
                            var nextTab = $('.nav-tabs .src-nav-link.active').parent().next().find("a");
                            if (nextTab.length > 0) {
                                nextTab.tab('show');
                            } else {
                                console.error("Next tab not found!");
                            }
                        }
                    });
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
                        url: "<?php echo base_url(); ?>Crm/CustomerCreation/AddTab3",
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

        /*###*/


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
                    console.log(data.account_type_out);
                    $('#cc_customer_name_id').val(data.cc_customer_name);

                    $('#cc_account_id_view').val(data.ca_account_id);

                    //$('#cc_account_id_view').html(data.cc_account);

                    $('#cc_post_box_id').val(data.cc_post_box);

                    $('#cc_telephone_id').val(data.cc_telephone);

                    $('#cc_fax_id').val(data.cc_fax);

                    $('#cc_email_id').val(data.cc_email);

                    $('#cc_credit_term_id').val(data.cc_credit_term);

                    $('#cc_credit_period_id').val(data.cc_credit_period);

                    $('#cc_credit_limit_id').val(data.cc_credit_limit);

                    //$('#cc_account_type_id').html(data.acc_type);

                    $('#cc_account_type_id').val(data.cc_account_type);

                    $('#cc_cr_number_id').val(data.cc_cr_number);

                    $('#cc_expiry_date_id').val(data.cc_expiry_date);

                    $('#cc_est_card_no_id').val(data.cc_est_card_no);

                    $('#cc_est_expiry_date_id').val(data.cc_est_expiry_date);

                    $('#cc_est_signatory_name_id').val(data.cc_est_signatory_name);

                    $('#cc_card_number_id').val(data.cc_card_number);

                    $('#cc_id_card_expiry_date_id').val(data.cc_id_card_expiry_date);
                    
                    $('#contact_details').html(data.contact);

                    $('#attach_cr_id').html(data.attach_cr);

                    $('#attach_est_card').html(data.attach_est_card);

                    $('#attach_id_card').html(data.attach_id_card);

                    $('#edit_account_id_view').html(data.account_type_out);
                    
                    $('#ViewModal').modal('show');
                    
                   
                    
                }


            });
            
            
        });
        /*####*/



        /*account head modal start*/ 
        $("body").on('click', '.edit_btn', function(){ 
            var id = $(this).data('id');
           
            $.ajax({

                url : "<?php echo base_url(); ?>Crm/CustomerCreation/Edit",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {   
                    var data = JSON.parse(data);
                    
                    $("#edit_customer_name_id").val(data.cc_customer_name);

                    $("#edit_post_box_id").val(data.cc_post_box);

                    $("#edit_telephone_id").val(data.cc_telephone);

                    $("#edit_fax_id").val(data.cc_fax);

                    $("#edit_email_id").val(data.cc_email);

                    $("#edit_credit_term_id").val(data.cc_credit_term);

                    $("#edit_credit_period_id").val(data.cc_credit_period);

                    $("#edit_credit_limit_id").val(data.cc_credit_limit);

                    $("#edit_account_type_id").html(data.account_type_out);

                    $("#edit_account_id_view").html(data.chart_account_type);

                    $("#edit_contact_details").html(data.contact);

                    $('#EditModal').modal('show');
                    
                    $("#id").val(id);
                    
                }


            });
            
            
        });
        /*####*/





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


        var max_fieldss      = 30;
        var y = 1;

       // $(".add_person").click(function(){
        $("body").on('click', '.add_person', function(){
           
			if(y < max_fieldss){ //max input box allowed
				y++;
	            $(".person-more").append("<tr><td>"+y+"</td><td><input type='text' name='contact_person[]' class='form-control ' required></td><td><input type='text' name='contact_designation[]' class='form-control ' required></td><td><input type='number' name='contact_mobile[]' class='form-control ' required></td><td><input type='email' name='contact_email[]' class='form-control ' required></td><td class='remove-btnnp' colspan='6'><div class='remainpass'><i class='ri-close-line'></i>Remove</div></td>");
	 
			}
	    });
        

        $(document).on("click", ".remove-btnnp", function() {
	 
	        $(this).parent().remove();
	        y--;
        });

     

    });


</script>