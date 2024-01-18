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
                                        <h5 class="modal-title" id="exampleModalLabel">Sales Quotation</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs nav-border-top-primary" role="tablist" style="margin-bottom: 20px;">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link src-nav-link active" id="tab1-tab" data-bs-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">Quotation Details</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link src-nav-link disabled"  id="tab2-tab" data-bs-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false">Product Details</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link src-nav-link disabled"  id="tab3-tab" data-bs-toggle="tab" href="#tab3" role="tab" aria-controls="tab3" aria-selected="false">Cost Calculation</a>
                                            </li>
                                            
                                            <!-- Add more tabs as needed -->
                                        </ul>

                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                                                <form class="Dashboard-form class" id="add_form1">
                                                    <!-- Tab 1 content goes here -->
                                                    <div class="row">
                                                        
                                                        <div class="col-md-2 col-lg-2">
                                                            <label for="basiInput" class="form-label">Date</label>
                                                            <input type="date" name="qd_date" id="qd_date_id" class="form-control" required>
                                                        </div>

                                                        <div class="col-md-3 col-lg-3">
                                                            <label for="basicInput" class="form-label">Customer</label>
                                                            
                                                            <select class="form-select droup_customer_id" name="qd_customer" id="customer_id" required>
                                                                <option value="" selected disabled>Select Customer</option>
                                                                <?php foreach($customer_creation as $c_creation){?> 
                                                                    <option value="<?php echo $c_creation->cc_id;?>"><?php echo $c_creation->cc_customer_name;?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>

                                                        

                                                        <div class="col-md-3 col-lg-2">
                                                            <label for="basicInput" class="form-label">Direct / Enquiry</label>
                                                            
                                                            <select class="form-select" name="qd_direct" id="direct_enquiry" required>
                                                                <option value="" selected disabled>Select Direct / Enquiry</option>
                                                                <option value="direct">Direct</option>
                                                                <option value="enquiry">Enquiry</option>
                                                            </select>

                                                        </div>



                                                        <div class="col-md-3 col-lg-3" id="enq_num_div" style="display:none;">
                                                            <label for="basicInput" class="form-label">Enquiry Number</label>
                                                            
                                                            <select class="form-select" name="qd_number" id="enquiry_numb" required>
                                                                <option value="" selected disabled>Select Enquiry Number</option>
                                                               
                                                               
                                                            </select>

                                                        </div>


                                                        <div class="col-md-2 col-lg-2">
                                                            <label for="basicInput" class="form-label">Contact Person</label>
                                                            
                                                            <select class="form-select enqinput" name="qd_contact_person" id="contact_person_id" required>
                                                                <option value="" selected disabled>Contact Person</option>
                                                                
                                                            </select>
                                                        </div>



                                                        <div class="col-md-2 col-lg-2">
                                                            <label for="basicInput" class="form-label">Sales Executive</label>
                                                            
                                                            <select class="form-select enqinput" name="qd_sales_executive" id="qd_sales_executive_id" required>
                                                                <option value="" selected disabled>Sales Executive</option>
                                                                <?php foreach($sales_executive as $sale_exc){?> 
                                                                    <option value="<?php echo $sale_exc->se_id;?>"><?php echo $sale_exc->se_name;?></option>
                                                                <?php } ?>
                                                                
                                                            </select>
                                                        </div>

                                                        <div class="col-md-2 col-lg-2">
                                                            <label for="basicInput" class="form-label">Payment Term</label>
                                                            <input type="text" name="qd_payment_term" id="qd_payment_term_id" class="form-control" required>
                                                        </div>


                                                        <div class="col-md-2 col-lg-2">
                                                            <label for="basicInput" class="form-label">Delivery Term</label>
                                                            
                                                            <select class="form-select" name="qd_delivery_term" id="qd_delivery_term_id" required>
                                                                <option value="" selected disabled>Delivery Term</option>
                                                                <?php foreach($delivery_term as $delv_term){?>
                                                                    <option value="<?php echo $delv_term->dt_id;?>"><?php echo $delv_term->dt_name;?></option>  
                                                                <?php } ?>
                                                                
                                                            </select>
                                                        </div>


                                                        <div class="col-md-2 col-lg-2">
                                                            <label for="basicInput" class="form-label">Validity</label>
                                                            <input type="text" name="qd_validity" id="qd_validity_id" class="form-control enqinput" required>
                                                        </div>


                                                        <div class="col-md-2 col-lg-2">
                                                            <label for="basicInput" class="form-label">Project</label>
                                                            <input type="text" name="qd_project" id="qd_project_id" class="form-control enqinput" required>
                                                        </div>


                                                        <div class="col-md-2 col-lg-2">
                                                            <label for="basicInput" class="form-label">Enquiry Reference</label>
                                                            <input type="text" name="qd_enquiry_reference" id="qd_enquiry_reference_id" class="form-control enqinput" required>
                                                        </div>
                                                        
                                                        
                                                    </div>
                                                    <div class="modal-footer justify-content-center">
                                                        <button class="btn btn btn-success">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                                
                                            
                                            
                                            <!---->
                                            <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                                                <form class="Dashboard-form class product_det_form" id="add_form2">
                                                   
                                                </form>
                                            </div>

                                            <!---->


                                            <!---->
                                            <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
                                                <form class="Dashboard-form class" id="add_form3">
                                                    <!-- Tab 1 content goes here -->
                                                    <div class="row">
                                                        
                                                        <div class="cost_cal_row">

                                                            <div class="row">

                                                                <div class="col-md-3 col-lg-3">
                                                                    <label for="basiInput" class="form-label">Material / Services</label>
                                                                    
                                                                    <select id="quotation_material" class="form-control quotation_material_clz" name="quotation_material[]" required>
                                                                        <option value="" selected disabled>Select Material / Services</option>
                                                                        <?php foreach($products as $prod){?> 
                                                                            <option value="<?php echo $prod->product_id?>"><?php echo $prod->product_details;?></option>    
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>

                                                                
                                                                <div class="col-md-3 col-lg-2">
                                                                    <label for="basiInput" class="form-label">Qty</label>
                                                                    <input type="number" name="qc_qty[]" class="form-control cost_qty" required>
                                                                </div>
                                                            
                                                                <div class="col-md-3 col-lg-3">
                                                                    <label for="basicInput" class="form-label">Rate</label>
                                                                    <input type="number" name="qc_rate[]" class="form-control cost_rate" required>
                                                                </div>
                                                            

                                                                <div class="col-md-3 col-lg-3">
                                                                    <label for="basicInput" class="form-label">Amount</label>
                                                                    <input type="number" name="qc_amount[]" readonly class="form-control cost_amount" required style="width:95%">
                                                                </div>


                                                                <div class="col-md-3 col-lg-1" style="margin-top: 29px;">

                                                                    <div class="edit_add_more_div"><span class="edit_add_more add_cost_more"><i class="ri-add-circle-line"></i>Add More</span></div>


                                                                </div>

                                                                <div></div>

                                                            </div>

                                                        </div>



                                                        
                                                        <div class="col-lg-12 cost_cal"></div>

                                                        <div class="divider"></div>  
                                                        
                                                        <!--<div class="col-lg-12">
                                                            
                                                            <div class="edit_add_more_div"><span class="edit_add_more add_cost_more"><i class="ri-add-circle-line"></i>Add More</span></div>

                                                        </div>-->



                                                        <div class="col-lg-12">
                                                            <div class="row">
                                                                <div class="col-lg-3"></div>

                                                                <div class="col-lg-3"></div>

                                                                <div class="col-md-2 col-lg-2">
                                                                    <label for="basicInput" class="form-label">Cost of Sales</label>
                                                                    <input type="number" name="qd_cost_of_sale" class="form-control" readonly required>
                                                                </div>

                                                                <div class="col-md-2 col-lg-2">
                                                                    <label for="basicInput" class="form-label">% of Gross Profit</label>
                                                                    <input type="number" name="qd_gross_profit" class="form-control" required>
                                                                </div>


                                                                <div class="col-md-2 col-lg-2">
                                                                    <label for="basicInput" class="form-label">Grand Total</label>
                                                                    <input type="number" name="qd_amount_total" class="form-control" required readonly>
                                                                </div>


                                                                

                                                            </div>
                                                        </div>
                                                      
                                                        
                                                        <input type="hidden" name="qd_id" class="quotation_details_id"> 
                                                    </div>
                                                    <div class="modal-footer justify-content-center">
                                                        <button class="btn btn btn-success">Save</button>
                                                    </div>
                                                </form>
                                            </div>

                                            <!---->

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
                                        <h4 class="card-title mb-0 flex-grow-1">View Sales Quotation</h4>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#AddModal" class="btn btn-primary py-1">Add</button>
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



<!--view modal section start-->

<div class="modal fade" id="ViewModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
                                
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sales Quotation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-border-top-primary" role="tablist" style="margin-bottom: 20px;">

                    <li class="nav-item" role="presentation">
                        <a class="nav-link src-nav-link active" id="tab1-tab" data-bs-toggle="tab" href="#tab4" role="tab" aria-controls="tab4" aria-selected="true">Quotation Details</a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a class="nav-link src-nav-link"  id="tab2-tab" data-bs-toggle="tab" href="#tab5" role="tab" aria-controls="tab5" aria-selected="false">Product Details</a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a class="nav-link src-nav-link"  id="tab3-tab" data-bs-toggle="tab" href="#tab6" role="tab" aria-controls="tab6" aria-selected="false">Cost Calculation</a>
                    </li>
                    
                <!-- Add more tabs as needed -->
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab4" role="tabpanel" aria-labelledby="tab4-tab">
                        <form class="Dashboard-form class" id="add_form1">
                            <!-- Tab 1 content goes here -->
                            <div class="row">
                                <div class="col-md-2 col-lg-2">
                                    <label for="basiInput" class="form-label">Quotation Number</label>
                                    <input type="text" name="" id="quotation_number_id" class="form-control" readonly>
                                </div>
                                <div class="col-md-2 col-lg-2">
                                    <label for="basiInput" class="form-label">Date</label>
                                    <input type="date" name="" id="quotation_date_id" class="form-control" readonly>
                                </div>
                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Customer</label>
                                    <input class="form-control" id="quotation_customer_id" name="" readonly>
                                    
                                </div>
                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Enquiry</label>
                                    <input class="form-control" id="quotation_enquiry_id" name="" readonly>
                                    
                                </div>
                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Contact Person</label>
                                    <input class="form-control" id="quotation_con_person_id" name="" readonly>
                                    
                                </div>
                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Sales Executive</label>
                                    <input class="form-control" id="quotation_sales_executive_id" name="" readonly>
                                    
                                </div>
                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Payment Term</label>
                                    <input type="text" name="" id="quotation_payment_term_id" class="form-control" readonly>
                                </div>
                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Delivery Term</label>
                                    <input class="form-control" id="quotation_delivery_term_id" name="" readonly>
                                    
                                </div>
                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Validity</label>
                                    <input type="text" name="" id="quotation_validity_id" class="form-control" readonly>
                                </div>
                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Project</label>
                                    <input type="text" name="" id="quotation_project_id" class="form-control" readonly>
                                </div>
                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Enquiry Reference</label>
                                    <input type="text" name="" id="quotation_enquiry_reference_id" class="form-control" readonly>
                                </div>
                                                            
                            </div>
                            <div class="modal-footer justify-content-center">
                                
                            </div>
                        </form>
                    </div>
                                                    
                                                
                    <!---->
                    <div class="tab-pane fade" id="tab5" role="tabpanel" aria-labelledby="tab5-tab">

                        <form class="Dashboard-form class" id="product_detail_table">
                            <!-- Tab 2 content goes here -->
                            
                            
                            
                        </form>

                        <div class="modal-footer justify-content-center">
                                
                        </div>

                    </div>

                    <!---->

                    <!---->
                    <div class="tab-pane fade" id="tab6" role="tabpanel" aria-labelledby="tab6-tab">
                        <form class="Dashboard-form class" id="add_form3">
                            <!-- Tab 1 content goes here -->
                            <div class="row">
                                <div class="col-md-2 col-lg-2">
                                    <label for="basiInput" class="form-label">Material / Services</label>
                                    <input type="text" id="quotation_material" class="form-control" readonly>
                                   
                                </div>
                                <div class="col-md-2 col-lg-2">
                                    <label for="basiInput" class="form-label">Qty</label>
                                    <input type="number"  id="quotation_qty" class="form-control" readonly>
                                </div>
                                
                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Rate</label>
                                    <input type="number" id="quotation_rate" class="form-control" readonly>
                                </div>
                                

                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Amount</label>
                                    <input type="number"  id="quotation_amount" class="form-control quotation_amount" readonly>
                                </div>

                                <div id=""></div>

                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Cost of Sales</label>
                                    <input type="number"  id="quotation_cost_of_sale" class="form-control" readonly>
                                </div>

                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">% of Gross profit</label>
                                    <input type="number" id="quotation_gross_profile" class="form-control" readonly>
                                </div>
                                
                            </div>
                            <div class="modal-footer justify-content-center">
                                
                            </div>
                        </form>
                    </div>

                    <!---->

                </div>

            </div>
                                    
        </div>
                                
    </div>

</div>


<!--view  modal section end-->






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
                            console.log(responseData.qd_id);
                            $(".quotation_details_id").val(responseData.qd_id);
                            // Trigger a click event on the next tab
                            var nextTab = $('.nav-tabs .src-nav-link.active').parent().next().find("a");
                            nextTab.removeClass("disabled");
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
                        url: "<?php echo base_url(); ?>Crm/SalesQuotation/AddTab2",
                        method: "POST",
                        data: $(currentForm).serialize(),
                        success: function(data) {
                            
                            // Trigger a click event on the next tab
                            var nextTab = $('.nav-tabs .src-nav-link.active').parent().next().find("a");
                            nextTab.removeClass("disabled");
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
                                url: "<?php echo base_url(); ?>Crm/SalesQuotation/FetchProduct",
                                method: "POST",
                                //data: { key: 'value' },
                                success: function(secondData) {
                                    // Handle the response of the second AJAX call
                                    var secdata = JSON.parse(secondData);
                                    console.log(secdata);
                                    $(".add_prod").html(secdata.product_head_out);
                                    
                                    /*$(".prod_row").each(function(index, row) {
                                        var addProdSelect = $(row).find('.add_prod');
                                        addProdSelect.html(secdata.product_head_out);
                                    });*/
                                   

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
                { data: 'qd_quotation_number' },
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
                
                    $("#contact_person_id").html(data.customer_name);

                    $("#qd_payment_term_id").val(data.cc_credit_term);
                    
                    
                }


            });
        });



        var max_fieldspp  = 30;

        var pp = 1;
        
        $("body").on('click', '.add_product2', function(){
            var pp = $('.prod_row').length
            
			if(pp < max_fieldspp){ 
                pp++;
        
                $(".product-more2").append("<tr class='prod_row'><td><input type='number' value="+pp+" name='qpd_serial_no[]' class='form-control non_border_input' required='' readonly></td><td><select class='form-select add_prod' name='qpd_product_description[]' required=''><option value='' selected disabled>Select Product Description</option><?php foreach($products as $prod){?><option value='<?php echo $prod->product_id;?>'><?php echo $prod->product_details;?></option><?php } ?></select></td><td><input type='text' name='qpd_unit[]' class='form-control ' required=''></td><td><input type='number' name='qpd_quantity[]' class='form-control qtn_clz_id' required=''></td><td><input type='number' name='qpd_rate[]' class='form-control rate_clz_id' required=''></td><td><input type='number' min='0' max='100' name='qpd_discount[]' class='form-control discount_clz_id' required=''></td><td><input type='number' name='qpd_amount[]' class='form-control amount_clz_id' readonly></td><td class='remove-btnpp' colspan='6'><div class='remainpass'><i class='ri-close-line'></i>Remove</div></td></tr>");

			}
	    });

        $(document).on("click", ".remove-btnpp", function() 
        {
	 
            $(this).parent().remove();
                pp--;
        });

        
        /*cost calculation add more*/

        var max_fieldcost = 30;
        var cc = 1;
        
        $("body").on('click', '.add_cost_more', function(){
           
            
			if(cc < max_fieldcost){ 
                cc++;
            
                    
                // $(".cost_cal").append("<div class='row cost_cal_row'><div class='col-md-3 col-lg-3'><label for='basicInput' class='form-label'>Material / Services</label><select id='quotation_material' class='form-control quotation_material_clz'><option value='' selected disabled>Select Material / Services</option><?php foreach($products as $prod){?> <option value='<?php echo $prod->product_id;?>'><?php echo $prod->product_details?></option><?php } ?></select></div><div class='col-md-3 col-lg-3'><label for='basiInput' class='form-label'>Qty</label><input type='number' name='qd_qty' class='form-control cost_qty' required></div><div class='col-md-3 col-lg-3'><label for='basicInput' class='form-label'>Rate</label><input type='number' name='qd_rate' class='form-control cost_rate' required></div><div class='col-md-3 col-lg-3'><label for='basicInput' class='form-label'>Amount</label><input readonly type='number' name='qd_amount' class='form-control cost_amount' required style='width:95%'></div><div class='remove-cost'><div class='remainpass cost_remove'><i class='ri-close-line'></i></div></div></div>");
                
                $(".cost_cal").append("<div class='row cost_cal_row'><div class='col-md-3 col-lg-3'><label for='basicInput' class='form-label'>Material / Services</label><select id='quotation_material' class='form-control quotation_material_clz'><option value='' selected disabled>Select Material / Services</option><?php foreach($products as $prod){?> <option value='<?php echo $prod->product_id;?>'><?php echo $prod->product_details?></option><?php } ?></select></div><div class='col-md-3 col-lg-2'><label for='basiInput' class='form-label'>Qty</label><input type='number' name='qd_qty' class='form-control cost_qty' required></div><div class='col-md-3 col-lg-3'><label for='basicInput' class='form-label'>Rate</label><input type='number' name='qd_rate' class='form-control cost_rate' required></div><div class='col-md-3 col-lg-3'><label for='basicInput' class='form-label'>Amount</label><input readonly type='number' name='qd_amount' class='form-control cost_amount' required style='width:95%'></div><div class='col-lg-1 remove-cost' style='margin-top: 32px;position: unset;'><div class='remainpass cost_remove'><i class='ri-close-line'></i>Remove</div></div></div>");
                

                // $(".cost_cal").append("<div class='row cost_cal_row'><div class='col-md-3 col-lg-3'><label for='basicInput' class='form-label'>Material / Services</label><select id='quotation_material' class='form-control quotation_material_clz'><option value='' selected disabled>Select Material / Services</option><?php foreach($products as $prod){?> <option value='<?php echo $prod->product_id;?>'><?php echo $prod->product_details?></option><?php } ?></select></div><div class='col-md-3 col-lg-2'><label for='basiInput' class='form-label'>Qty</label><input type='number' name='qd_qty' class='form-control cost_qty' required></div><div class='col-md-3 col-lg-3'><label for='basicInput' class='form-label'>Rate</label><input type='number' name='qd_rate' class='form-control cost_rate' required></div><div class='col-md-3 col-lg-3'><label for='basicInput' class='form-label'>Amount</label><input readonly type='number' name='qd_amount' class='form-control cost_amount' required style='width:95%'></div><div class='col-md-3 col-lg-1'><div class='remove-cost' style='margin-top: 33px;'><div class='remainpass cost_remove'><i class='ri-close-line'></i>Remove</div></div></div></div>");
                
                
			}

	    });
        

        $(document).on("click", ".remove-cost", function() 
        {
            $(this).parent().remove();
            cc--;
            totalCalcutate();
            grossCalculate();
        });

        /**/





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

                        // $("#direct_enquiry_div").css("display":block);

                        $('#enq_num_div').show();

                    }


                });


            }
            else
            {
                $('#enq_num_div').hide();
            }



        });

        //fetch data by Enquiry Number 
        $("body").on('change', '#enquiry_numb', function(){ 
            
            var id = $(this).val();

            $.ajax({

                url : "<?php echo base_url(); ?>Crm/SalesQuotation/FetchEnquiry",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {   
                    var data = JSON.parse(data);
                    
                    document.getElementById('contact_person_id').value=data.contact_person;
                    
                    document.getElementById('qd_sales_executive_id').value=data.sales_executive;

                    $("#qd_validity_id").val(data.enquiry_validity);

                    $("#qd_project_id").val(data.enquiry_project);

                    $("#qd_enquiry_reference_id").val(data.enquiry_enq_referance);
                    
                    $('#contact_person_id').addClass('enqinput');

                    $('#qd_sales_executive_id').addClass('enqinput');

                    $('#qd_validity_id').addClass('enqinput');

                    $('#qd_project_id').addClass('enqinput');

                    $('#qd_enquiry_reference_id').addClass('enqinput');

                    $('.product_det_form').html(data.product_detail);
                  
                }


            });


        });
        /**/


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

            var parsedQuantity = parseFloat(quantity); 

            var multipliedTotal = parsedRate * parsedQuantity;

            var per_amount = (discount/100)*multipliedTotal;
           
            var orginalPrice = multipliedTotal - per_amount;

            var $amountElement = $discountSelect.closest('.prod_row').find('.amount_clz_id');

            $amountElement.val(orginalPrice);

           
        });


        /**/

        /*delete product detail row*/

        $("body").on('click', '.row_remove', function(){ 
	   
            var id = $(this).data('id');
            
            $.ajax({

                url : "<?php echo base_url(); ?>Crm/SalesQuotation/DeleteContact",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {   
                    alertify.success('Data Deleted Successfully').delay(2).dismissOthers();
                    $('#'+id+'').remove();
                    $('#'+id+'').fadeIn();

                    
                    
                }


            });
        
        });

        /**/



        /*product modal start*/

        $("body").on('click', '.product_modal', function(){ 
	   
            $('#AddModal').modal('hide');

            $('#ProductModal').modal('show');
   
        });

        /*product modal end*/



        /* customer droup drown */
         $(".droup_customer_id").select2({
           placeholder: "Select Customer",
            theme : "default form-control-",
            dropdownParent: $('#AddModal'),

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
                    //console.log(data);
                    //  NO NEED TO PARSE DATA `processResults` automatically parse it
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
        /**/
 



        //$(".cost_qty").keyup(function(){
        
        $("body").on('keyup', '.cost_qty, .cost_rate', function(){ 
           
            var value = $(this).val();

            var $valueSelect = $(this);

            var $qtySelectElement = $valueSelect.closest('.cost_cal_row').find('.cost_qty');

            var qty = $qtySelectElement.val();

           
            var $rateSelectElement = $valueSelect.closest('.cost_cal_row').find('.cost_rate');

            var rate = $rateSelectElement.val();

            var parsedRate = parseFloat(rate);

            var parsedQuantity = parseFloat(qty);

            var multipliedTotal = parsedRate * parsedQuantity;

            var $amountElement = $valueSelect.closest('.cost_cal_row').find('.cost_amount');

            $amountElement.val(multipliedTotal);

            totalCalcutate();

            grossCalculate();
          
        });



        function totalCalcutate()
        {

        var total = 0; 
        
        $('body .cost_amount').each(function()
        {

        var sub_tot = $(this).val();


        total += parseInt(sub_tot)||0;

        });

        $('input[name=qd_cost_of_sale]').val(total);


        }


        $('input[name=qd_gross_profit]').on("keyup change",function(){

        grossCalculate();

        });



        function grossCalculate()
        {

        var percentage = parseInt($('input[name=qd_gross_profit]').val())||0;

        var total = parseInt($('input[name=qd_cost_of_sale]').val()) || 0;

        var per_amount = (percentage/100)*total;

        var grand_total = total+per_amount;

        $('input[name=qd_amount_total]').val(grand_total);

        }
         
        
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



</script>