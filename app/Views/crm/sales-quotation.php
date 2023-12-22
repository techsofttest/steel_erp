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
                                                <a class="nav-link src-nav-link"  id="tab2-tab" data-bs-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false">Product Details</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link src-nav-link"  id="tab3-tab" data-bs-toggle="tab" href="#tab3" role="tab" aria-controls="tab3" aria-selected="false">Cost Calculation</a>
                                            </li>
                                            
                                            <!-- Add more tabs as needed -->
                                        </ul>

                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                                                <form class="Dashboard-form class" id="add_form1">
                                                    <!-- Tab 1 content goes here -->
                                                    <div class="row">
                                                        
                                                        <div class="col-md-4 col-lg-4">
                                                            <label for="basiInput" class="form-label">Date</label>
                                                            <input type="date" name="qd_date" id="qd_date_id" class="form-control" required>
                                                        </div>
                                                        <div class="col-md-4 col-lg-4">
                                                            <label for="basicInput" class="form-label">Customer</label>
                                                            
                                                            <select class="form-select" name="qd_customer" id="customer_id" required>
                                                                <option value="" selected disabled>Select Customer</option>
                                                                <?php foreach($customer_creation as $c_creation){?> 
                                                                    <option value="<?php echo $c_creation->cc_id;?>"><?php echo $c_creation->cc_customer_name;?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4 col-lg-4">
                                                            <label for="basicInput" class="form-label">Contact Person</label>
                                                            
                                                            <select class="form-select" name="qd_contact_person" id="contact_person_id" required>
                                                                <option value="" selected disabled>Contact Person</option>
                                                                
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4 col-lg-4">
                                                            <label for="basicInput" class="form-label">Sales Executive</label>
                                                            
                                                            <select class="form-select" name="qd_sales_executive" id="qd_sales_executive_id" required>
                                                                <option value="" selected disabled>Sales Executive</option>
                                                                <?php foreach($sales_executive as $sale_exc){?> 
                                                                    <option value="<?php echo $sale_exc->se_id;?>"><?php echo $sale_exc->se_name;?></option>
                                                                <?php } ?>
                                                                
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4 col-lg-4">
                                                            <label for="basicInput" class="form-label">Payment Term</label>
                                                            <input type="text" name="qd_payment_term" id="qd_payment_term_id" class="form-control" readonly>
                                                        </div>
                                                        <div class="col-md-4 col-lg-4">
                                                            <label for="basicInput" class="form-label">Delivery Term</label>
                                                            
                                                            <select class="form-select" name="qd_delivery_term" id="qd_delivery_term_id" required>
                                                                <option value="" selected disabled>Delivery Term</option>
                                                                <?php foreach($delivery_term as $delv_term){?>
                                                                    <option name="<?php echo $delv_term->dt_id;?>"><?php echo $delv_term->dt_name;?></option>  
                                                                <?php } ?>
                                                                
                                                            </select>
                                                        </div>

                                                        <div class="col-md-4 col-lg-4">
                                                            <label for="basicInput" class="form-label">Validity</label>
                                                            <input type="text" name="qd_validity" id="qd_validity_id" class="form-control" required>
                                                        </div>
                                                        <div class="col-md-4 col-lg-4">
                                                            <label for="basicInput" class="form-label">Project</label>
                                                            <input type="text" name="qd_project" id="qd_project_id" class="form-control">
                                                        </div>
                                                        <div class="col-md-4 col-lg-4">
                                                            <label for="basicInput" class="form-label">Enquiry Reference</label>
                                                            <input type="text" name="qd_enquiry_reference" id="qd_enquiry_reference_id" class="form-control">
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="modal-footer justify-content-center">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <button class="btn btn btn-success">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                                
                                            
                                            
                                            <!---->
                                            <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                                                <form class="Dashboard-form class" id="add_form2">
                                                    <!-- Tab 2 content goes here -->
                                                    <table class="table table-bordered table-striped delTable">
                                                        <tbody class="travelerinfo">
                                                            <tr>
                                                                <td>Serial No.</td>
                                                                <td>Product Description</td>
                                                                <td>Unit</td>
                                                                <td>Quantity</td>
                                                                <td>Rate</td>
                                                                <td>Discount(%)</td>
                                                                <td>Amount</td>
                                                                <td>Action</td>
                                                            </tr>
                                                            <tr>
                                                                <td><input type="number" name="qpd_serial_no[]" class="form-control" required></td>
                                                                <td>
                                                                    <select class="form-select" name="qpd_product_description[]" required>
                                                                        <option selected>Select Product Description</option>
                                                                        <?php foreach($products as $prod){?>
                                                                            <option value="<?php echo $prod->product_id;?>"><?php echo $prod->product_details;?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
                                                                <td><input type="text" name="qpd_unit[]" class="form-control" required></td>
                                                                <td><input type="number" name="qpd_quantity[]" class="form-control" required></td>
                                                                <td><input type="number" name="qpd_rate[]" class="form-control" required></td>
                                                                <td><input type="number" name="qpd_discount[]" class="form-control" required></td>
                                                                <td><input type="number" name="qpd_amount[]" class="form-control" required></td>
                                                                <td><div class="tecs"><span id="add_product2" class="add_icon"><i class="ri-add-circle-line"></i>Add </span></div></td>
                                                            </tr>
                                                        </tbody>
                                                        <tbody id="product-more2" class="travelerinfo"></tbody>
                                                    </table>
                                                    <input type="hidden" name="qpd_quotation_details" class="quotation_details_id"> 
                                                    <div class="modal-footer justify-content-center">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <button class="btn btn btn-success">Submit</button>
                                                    </div>
                                                </form>
                                            </div>

                                            <!---->


                                            <!---->
                                            <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
                                                <form class="Dashboard-form class" id="add_form3">
                                                    <!-- Tab 1 content goes here -->
                                                    <div class="row">
                                                        <div class="col-md-4 col-lg-4">
                                                            <label for="basiInput" class="form-label">Material / Services</label>
                                                            <input type="text" name="qd_materials" class="form-control" required>
                                                        </div>
                                                        <div class="col-md-4 col-lg-4">
                                                            <label for="basiInput" class="form-label">Qty</label>
                                                            <input type="number" name="qd_qty" class="form-control" required>
                                                        </div>
                                                        
                                                        <div class="col-md-4 col-lg-4">
                                                            <label for="basicInput" class="form-label">Rate</label>
                                                            <input type="number" name="qd_rate" class="form-control" required>
                                                        </div>
                                                        

                                                        <div class="col-md-4 col-lg-4">
                                                            <label for="basicInput" class="form-label">Amount</label>
                                                            <input type="number" name="qd_amount" class="form-control" required>
                                                        </div>
                                                        <div class="col-md-4 col-lg-4">
                                                            <label for="basicInput" class="form-label">Cost of Sales</label>
                                                            <input type="number" name="qd_cost_of_sale" class="form-control" required>
                                                        </div>
                                                        <div class="col-md-4 col-lg-4">
                                                            <label for="basicInput" class="form-label">% of Gross profit</label>
                                                            <input type="number" name="qd_gross_profit" class="form-control" required>
                                                        </div>
                                                        <input type="hidden" name="qd_id" class="quotation_details_id"> 
                                                    </div>
                                                    <div class="modal-footer justify-content-center">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <button class="btn btn btn-success">Submit</button>
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
                                <div class="col-md-4 col-lg-4">
                                    <label for="basiInput" class="form-label">Quotation Number</label>
                                    <input type="text" name="" id="quotation_number_id" class="form-control" readonly>
                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <label for="basiInput" class="form-label">Date</label>
                                    <input type="date" name="" id="quotation_date_id" class="form-control" readonly>
                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <label for="basicInput" class="form-label">Customer</label>
                                    <input class="form-control" id="quotation_customer_id" name="" readonly>
                                    
                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <label for="basicInput" class="form-label">Contact Person</label>
                                    <input class="form-control" id="quotation_con_person_id" name="" readonly>
                                    
                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <label for="basicInput" class="form-label">Sales Executive</label>
                                    <input class="form-control" id="quotation_sales_executive_id" name="" readonly>
                                    
                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <label for="basicInput" class="form-label">Payment Term</label>
                                    <input type="text" name="" id="quotation_payment_term_id" class="form-control" readonly>
                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <label for="basicInput" class="form-label">Delivery Term</label>
                                    <input class="form-control" id="quotation_delivery_term_id" name="" readonly>
                                    
                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <label for="basicInput" class="form-label">Validity</label>
                                    <input type="text" name="" id="quotation_validity_id" class="form-control" readonly>
                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <label for="basicInput" class="form-label">Project</label>
                                    <input type="text" name="" id="quotation_project_id" class="form-control" readonly>
                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <label for="basicInput" class="form-label">Enquiry Reference</label>
                                    <input type="text" name="" id="quotation_enquiry_reference_id" class="form-control" readonly>
                                </div>
                                                            
                            </div>
                            <div class="modal-footer justify-content-center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                
                            </div>
                        </form>
                    </div>
                                                    
                                                
                    <!---->
                    <div class="tab-pane fade" id="tab5" role="tabpanel" aria-labelledby="tab5-tab">
                        <form class="Dashboard-form class" id="product_detail_table">
                            <!-- Tab 2 content goes here -->
                            
                            
                            
                        </form>
                        <div class="modal-footer justify-content-center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                
                        </div>
                    </div>

                    <!---->

                    <!---->
                    <div class="tab-pane fade" id="tab6" role="tabpanel" aria-labelledby="tab6-tab">
                        <form class="Dashboard-form class" id="add_form3">
                            <!-- Tab 1 content goes here -->
                            <div class="row">
                                <div class="col-md-4 col-lg-4">
                                    <label for="basiInput" class="form-label">Material / Services</label>
                                    <input type="text" id="quotation_material" class="form-control" readonly>
                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <label for="basiInput" class="form-label">Qty</label>
                                    <input type="number"  id="quotation_qty" class="form-control" readonly>
                                </div>
                                
                                <div class="col-md-4 col-lg-4">
                                    <label for="basicInput" class="form-label">Rate</label>
                                    <input type="number" id="quotation_rate" class="form-control" readonly>
                                </div>
                                

                                <div class="col-md-4 col-lg-4">
                                    <label for="basicInput" class="form-label">Amount</label>
                                    <input type="number"  id="quotation_amount" class="form-control" readonly>
                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <label for="basicInput" class="form-label">Cost of Sales</label>
                                    <input type="number"  id="quotation_cost_of_sale" class="form-control" readonly>
                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <label for="basicInput" class="form-label">% of Gross profit</label>
                                    <input type="number" id="quotation_gross_profile" class="form-control" readonly>
                                </div>
                                
                            </div>
                            <div class="modal-footer justify-content-center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                
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
                submitHandler: function(currentForm) {
                    // Submit the form for the current tab
                    $.ajax({
                        url: "<?php echo base_url(); ?>Crm/SalesQuotation/AddTab2",
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



        /*view*/ 
        $("body").on('click', '.view_btn', function(){ 
            var id = $(this).data('id');
            
            $.ajax({

                url : "<?php echo base_url(); ?>Crm/SalesQuotation/View",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {   
                    var data = JSON.parse(data);
                    
                    $("#quotation_number_id").val(data.qd_quotation_number);

                    $("#quotation_date_id").val(data.qd_date);

                    $("#quotation_payment_term_id").val(data.qd_payment_term);

                    $("#quotation_validity_id").val(data.qd_validity);

                    $("#quotation_project_id").val(data.qd_project);

                    $("#quotation_enquiry_reference_id").val(data.qd_enquiry_reference);

                    $("#quotation_customer_id").val(data.qd_customer);

                    $("#quotation_con_person_id").val(data.qd_contact_person);

                    $("#quotation_sales_executive_id").val(data.qd_sales_executive);

                    $("#quotation_delivery_term_id").val(data.qd_delivery_term);

                    $("#product_detail_table").html(data.prod_details);

                    $("#quotation_material").val(data.qd_materials);

                    $("#quotation_qty").val(data.qd_qty);

                    $("#quotation_rate").val(data.qd_rate);

                    $("#quotation_amount").val(data.qd_amount);

                    $("#quotation_cost_of_sale").val(data.qd_cost_of_sale);

                    $("#quotation_gross_profile").val(data.qd_gross_profit);
                    
                    $('#ViewModal').modal('show');
                    
                   
                    
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


        $("body").on('change', '#contact_person_id', function(){ 
            var id = $(this).val();
           
            $.ajax({

                url : "<?php echo base_url(); ?>Crm/SalesQuotation/ProjectEnquiry",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {   
                    var data = JSON.parse(data);
                
                    $("#qd_project_id").val(data.enquiry_project);

                    $("#qd_enquiry_reference_id").val(data.enquiry_enq_referance);
                    
                    
                }


            });
        });


       

        var max_fieldspp      = 30;
        var pp = 1;
        $("#add_product2").click(function(){

			if(pp < max_fieldspp){ 
                pp++;
        
                $("#product-more2").append("<tr><td><input type='number' name='qpd_serial_no[]' class='form-control ' required=''></td><td><select class='form-select' name='qpd_product_description[]' required=''><option value='' selected disabled>Select Product Description</option><?php foreach($products as $prod){?><option value='<?php echo $prod->product_id;?>'><?php echo $prod->product_details;?></option><?php } ?></select></td><td><input type='text' name='qpd_unit[]' class='form-control ' required=''></td><td><input type='number' name='qpd_quantity[]' class='form-control ' required=''></td><td><input type='number' name='qpd_rate[]' class='form-control ' required=''></td><td><input type='number' name='qpd_discount[]' class='form-control ' required=''></td><td><input type='number' name='qpd_amount[]' class='form-control ' required=''></td><td class='remove-btnpp' colspan='6'><div class='remainpass'><i class='ri-close-line'></i>Remove</div></td></tr>");

			}
	    });

        $(document).on("click", ".remove-btnpp", function() 
        {
	 
            $(this).parent().remove();
                pp--;
        });




     

    });



</script>