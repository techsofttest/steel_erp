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
                                        <h5 class="modal-title" id="exampleModalLabel">Sales Order</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs nav-border-top-primary" role="tablist" style="margin-bottom: 20px;">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link src-nav-link active" id="tab1-tab" data-bs-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">Sales Order Details</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link src-nav-link"  id="tab2-tab" data-bs-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false">Product Details</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link src-nav-link"  id="tab3-tab" data-bs-toggle="tab" href="#tab3" role="tab" aria-controls="tab3" aria-selected="false">More Details</a>
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
                                                            <input type="date" name="so_date" id="" class="form-control" required>
                                                        </div>
                                                        <div class="col-md-4 col-lg-4">
                                                            <label for="basicInput" class="form-label">Customer</label>
                                                            
                                                            <select class="form-select" name="so_customer" id="customer_id" required>
                                                                <option value="" selected disabled>Select Customer</option>
                                                                <?php foreach($customer_creation as $c_creation){?> 
                                                                    <option value="<?php echo $c_creation->cc_id;?>"><?php echo $c_creation->cc_customer_name;?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4 col-lg-4">
                                                            <label for="basiInput" class="form-label">LPO reference</label>
                                                            <input type="text" name="so_lpo" id="qd_quotation_number_id" class="form-control" required>
                                                        </div>
                                                        <div class="col-md-4 col-lg-4">
                                                            <label for="basicInput" class="form-label">Quotation Ref</label>
                                                            
                                                            <select class="form-select" name="so_quotation_ref" id="quotation_ref" required>
                                                                <option value="" selected disabled>Quotation Ref</option>
                                                               
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4 col-lg-4">
                                                            <label for="basicInput" class="form-label">Contact Person</label>
                                                            <input type="text" name="so_contact_person" id="contact_person" class="form-control" readonly>
                                                        
                                                           
                                                        </div>
                                                        <div class="col-md-4 col-lg-4">
                                                            <label for="basicInput" class="form-label">Sales Executive</label>
                                                            <input type="text" name="so_sales_executive" id="sales_executive" class="form-control" readonly>
                                                            
                                                        </div>
                                                        <div class="col-md-4 col-lg-4">
                                                            <label for="basicInput" class="form-label">Payment Term</label>
                                                            <input type="text" name="so_payment_term" id="payment_term" class="form-control" readonly>
                                                        </div>
                                                        <div class="col-md-4 col-lg-4">
                                                            <label for="basicInput" class="form-label">Delivery Term</label>
                                                            <input type="text" name="so_delivery_term" id="delivery_term" class="form-control" readonly>
                                                            
                                                        </div>

                                                      
                                                        <div class="col-md-4 col-lg-4">
                                                            <label for="basicInput" class="form-label">Project</label>
                                                            <input type="text" name="so_project" id="project" class="form-control" readonly>
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
                                                    <div class="product_detail_id"></div>
                                                    <!-- Tab 2 content goes here -->
                                                    
                                                    <input type="hidden" name="spd_sales_order"  class="spd_sales_order_id">
                                                    <div class="modal-footer justify-content-center"> 
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button> 
                                                        <button class="btn btn btn-success">Submit</button>
                                                    </div>
                                                </form>
                                            </div>

                                            <!---->

                                            <!---->
                                             
                                            <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
                                                <form class="Dashboard-form class" id="add_form3" enctype= multipart/form-data>
                                                    <!-- Tab 3 content goes here -->
                                                    <div class="row">
                                                        
                                                        <div class="col-md-4 col-lg-4">
                                                            <label for="basiInput" class="form-label">LPO & Drawings</label>
                                                            <input type="file" name="so_lpo_and_drawing" id="" class="form-control" required>
                                                        </div>
                                                        
                                                      
                                                       
                                                        <div class="col-md-4 col-lg-4">
                                                            <label for="basicInput" class="form-label">Scheduled date of delivery</label>
                                                            <input type="date" name="so_scheduled_date_of_delivery" id="" class="form-control" required>
                                                            
                                                        </div>
                                                        
                                                        <input type="hidden" name="so_id"  class="spd_sales_order_id">
                                                        
                                                        
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
                                        <h4 class="card-title mb-0 flex-grow-1">View Enquiry</h4>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#AddModal" class="btn btn-primary py-1">Add</button>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <table id="DataTable" class="table table-bordered table-striped delTable display dataTable">
                                            <thead>
                                                <tr>
                                                    <th class="no-sort">Sl no</th>
                                                    <th>Sales Order No</th>
                                                    <th>Date</th>
                                                    <th>Customer</th>
                                                    <th>Quotation Ref</th>
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
                                        <h5 class="modal-title" id="exampleModalLabel">Sales Order</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs nav-border-top-primary" role="tablist" style="margin-bottom: 20px;">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link src-nav-link active" id="tab1-tab" data-bs-toggle="tab" href="#tab4" role="tab" aria-controls="tab4" aria-selected="true">Sales Order Details</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link src-nav-link"  id="tab2-tab" data-bs-toggle="tab" href="#tab5" role="tab" aria-controls="tab5" aria-selected="false">Product Details</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link src-nav-link"  id="tab3-tab" data-bs-toggle="tab" href="#tab6" role="tab" aria-controls="tab6" aria-selected="false">More Details</a>
                                            </li>
                                          
                                            
                                            <!-- Add more tabs as needed -->
                                        </ul>

                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="tab4" role="tabpanel" aria-labelledby="tab4-tab">
                                                <form class="Dashboard-form class" id="">
                                                    <!-- Tab 1 content goes here -->
                                                    <div class="row">
                                                        <div class="col-md-4 col-lg-4">
                                                            <label for="basiInput" class="form-label">Sales Order No.</label>
                                                            <input type="text" name="" id="sales_order_no_id" class="form-control" required>
                                                        </div>
                                                        <div class="col-md-4 col-lg-4">
                                                            <label for="basiInput" class="form-label">Date</label>
                                                            <input type="date" name="" id="sales_order_date_id" class="form-control" required>
                                                        </div>
                                                        <div class="col-md-4 col-lg-4">
                                                            <label for="basicInput" class="form-label">Customer</label>
                                                            <input type="text" name="" id="sales_order_customer_id" class="form-control" required>
                                                            
                                                        </div>
                                                        <div class="col-md-4 col-lg-4">
                                                            <label for="basiInput" class="form-label">LPO reference</label>
                                                            <input type="text" name="" id="sales_order_lpo_id" class="form-control" required>
                                                        </div>
                                                        <div class="col-md-4 col-lg-4">
                                                            <label for="basicInput" class="form-label">Quotation Ref</label>
                                                            <input type="text" name="" id="sales_order_quot_ref_id" class="form-control" required>
                                                            
                                                        </div>
                                                        <div class="col-md-4 col-lg-4">
                                                            <label for="basicInput" class="form-label">Contact Person</label>
                                                            <input type="text" name="" id="sales_order_contact_person_id" class="form-control" readonly>
                                                        
                                                           
                                                        </div>
                                                        <div class="col-md-4 col-lg-4">
                                                            <label for="basicInput" class="form-label">Sales Executive</label>
                                                            <input type="text" name="" id="sales_order_executive" class="form-control" readonly>
                                                            
                                                        </div>
                                                        <div class="col-md-4 col-lg-4">
                                                            <label for="basicInput" class="form-label">Payment Term</label>
                                                            <input type="text" name="" id="sales_order_payment_term" class="form-control" readonly>
                                                        </div>
                                                        <div class="col-md-4 col-lg-4">
                                                            <label for="basicInput" class="form-label">Delivery Term</label>
                                                            <input type="text" name="" id="sales_order_delivery_term" class="form-control" readonly>
                                                            
                                                        </div>

                                                      
                                                        <div class="col-md-4 col-lg-4">
                                                            <label for="basicInput" class="form-label">Project</label>
                                                            <input type="text" name="" id="sales_order_project" class="form-control" readonly>
                                                        </div>
                                                        
                                                        
                                                    </div>
                                                    <div class="modal-footer justify-content-center">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        
                                                    </div>
                                                </form>
                                            </div>
                                                
                                            
                                            
                                            <!---->
                                            <div class="tab-pane fade" id="tab5" role="tabpanel" aria-labelledby="tab5-tab">
                                                <form class="Dashboard-form class" id="">
                                                    <div class="product_detail_id"></div>
                                                    <!-- Tab 2 content goes here -->
                                                    
                                                    <input type="hidden" name="spd_sales_order"  class="spd_sales_order_id">
                                                    <div class="modal-footer justify-content-center"> 
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button> 
                                                        
                                                    </div>
                                                </form>
                                            </div>

                                            <!---->

                                            <!---->
                                             
                                            <div class="tab-pane fade" id="tab6" role="tabpanel" aria-labelledby="tab6-tab">
                                                <form class="Dashboard-form class" id="" enctype= multipart/form-data>
                                                    <!-- Tab 3 content goes here -->
                                                    <div class="row">
                                                        
                                                       
                                                       
                                                        <div class="col-md-4 col-lg-4">
                                                            <label for="basicInput" class="form-label">Scheduled date of delivery</label>
                                                            <input type="date" name="" id="sales_order_delivery_id" class="form-control" required>
                                                            
                                                        </div>
                                                        
                                                        <div class="col-lg-12 tab_attachment_head">
                                                            <h5 class="">Attachments</h5>
                                                            <table  class="table table-bordered table-striped delTable view_tab_cond">
                                                                <tbody class="travelerinfo">
                                                                    <tr>
                                                                        <td >Label</td>
                                                                        <td>View</td>
                                                                    </tr>
                                                                    
                                                                    <tr>
                                                                        <td>LPO & Drawings</td>
                                                                        <td id="lpo_and_drawing_id"></td>
                                                                    </tr>

                                                                   



                                                                </tbody>


                                                            </table>

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
                        url: "<?php echo base_url(); ?>Crm/SalesOrder/Add",
                        method: "POST",
                        data: $(currentForm).serialize(),
                        success: function(data) {
                            var responseData = JSON.parse(data);
                           
                            $(".spd_sales_order_id").val(responseData.so_id);
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
                        url: "<?php echo base_url(); ?>Crm/SalesOrder/AddTab2",
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



        $(function () {
            var form = $('#add_form3');
            form.submit(function (e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: "<?php echo base_url(); ?>Crm/SalesOrder/AddTab3",
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    $('#add_form1')[0].reset();
                    $('#add_form2')[0].reset();
                    $('#add_form3')[0].reset();
                    $('#AddModal').modal('hide');
                    alertify.success('Data Added Successfully').delay(3).dismissOthers();
                    datatable.ajax.reload(null, false);
                }
            });
       });
    });



       



        /*view*/ 
        $("body").on('click', '.view_btn', function(){ 
            var id = $(this).data('id');
            
            $.ajax({

                url : "<?php echo base_url(); ?>Crm/SalesOrder/View",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {   
                    var data = JSON.parse(data);
                    
                    $("#sales_order_no_id").val(data.so_order_no);

                    $("#sales_order_date_id").val(data.so_date);

                    $("#sales_order_customer_id").val(data.cc_customer_name);

                    $("#sales_order_lpo_id").val(data.so_lpo);

                    $("#sales_order_quot_ref_id").val(data.qd_quotation_number);

                    $("#sales_order_contact_person_id").val(data.so_contact_person);

                    $("#sales_order_executive").val(data.so_sales_executive);

                    $("#sales_order_payment_term").val(data.so_payment_term);

                    $("#sales_order_delivery_term").val(data.so_delivery_term);

                    $("#sales_order_project").val(data.so_project);

                    $(".product_detail_id").html(data.prod_details);

                    $("#sales_order_delivery_id").val(data.so_scheduled_date_of_delivery);

                    $("#lpo_and_drawing_id").html(data.lpo_and_drawing);

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
                'url': "<?php echo base_url(); ?>Crm/SalesOrder/FetchData",
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
                { data: 'so_id'},
                { data: 'so_order_no' },
                { data: 'so_date'},
                { data: 'so_customer'},
                { data: 'so_quotation_ref'},
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

                url : "<?php echo base_url(); ?>Crm/SalesOrder/ContactPerson",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {   
                    var data = JSON.parse(data);
                
                    $("#contact_person_id").html(data.customer_name);

                    $("#quotation_ref").html(data.quotation_det);
                    
                    
                }


            });
        });




        $("body").on('change', '#quotation_ref', function(){ 
            var id = $(this).val();
           
            $.ajax({

                url : "<?php echo base_url(); ?>Crm/SalesOrder/QuotationRef",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {   
                    var data = JSON.parse(data);
                   
                    $("#contact_person_id").html(data.customer_name);

                    $("#quotation_ref").html(data.quotation_det);

                    $("#contact_person").val(data.qd_contact_person);

                    $("#sales_executive").val(data.qd_sales_executive);

                    $("#payment_term").val(data.qd_payment_term);

                    $("#delivery_term").val(data.qd_delivery_term);

                    $("#project").val(data.qd_project);

                    $(".product_detail_id").html(data.prod_details);

                    
                    
                    
                }


            });
        });


       

        var max_fieldspp      = 30;
        var pp = 1;
        $("#add_product2").click(function(){

			if(pp < max_fieldspp){ 
                pp++;
        
                $("#product-more2").append("<tr><td><input type='number' name='qpd_serial_no[]' class='form-control ' required=''></td><td><select class='form-select' name='qpd_product_description[]' required=''><option value='' selected disabled>Select Product Description</option><?php foreach($products as $prod){?><option value='<?php echo $prod->product_id;?>'><?php echo $prod->product_details;?></option><?php } ?></select></td><td><input type='number' name='qpd_unit[]' class='form-control ' required=''></td><td><input type='number' name='qpd_quantity[]' class='form-control ' required=''></td><td><input type='number' name='qpd_rate[]' class='form-control ' required=''></td><td><input type='number' name='qpd_discount[]' class='form-control ' required=''></td><td><input type='number' name='qpd_amount[]' class='form-control ' required=''></td><td class='remove-btnpp' colspan='6'><div class='remainpass'><i class='ri-close-line'></i>Remove</div></td></tr>");

			}
	    });

        $(document).on("click", ".remove-btnpp", function() 
        {
	 
            $(this).parent().remove();
                pp--;
        });




     

    });



</script>