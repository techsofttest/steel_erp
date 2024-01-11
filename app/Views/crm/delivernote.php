<div class="tab-content text-muted">
								
    <div class="tab-pane active" id="nav-crm-top-1-1" role="tabpanel">
                    
        <div class="row">
            
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
        
                        <!-- Start Subtabs -->
                        <ul class="nav nav-pills arrow-navtabs nav-success bg-light mb-3" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="<?= base_url(); ?>Crm/DeliverNote" role="tab">
                                    <span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
                                    <span class="d-none d-sm-block">Delivery Note</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url(); ?>Crm/CashInvoice" role="tab">
                                    <span class="d-block d-sm-none"><i class="mdi mdi-account"></i></span>
                                    <span class="d-none d-sm-block">Cash Invoice</span>
                                </a>
                            </li>
                    
                        </ul>
                    </div>
                </div>
                
                <!-- Tab panes -->
                <div class="tab-content text-muted">
                    <!--product head tab--> 
                    <div class="tab-pane active" id="arrow-1" role="tabpanel">
                        
                        <!--modal content start-->
                        <div class="modal fade" id="AddModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Delivery Note</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs nav-border-top-primary" role="tablist" style="margin-bottom: 20px;">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link src-nav-link active" id="tab1-tab" data-bs-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">Delivery Note</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link src-nav-link"  id="tab2-tab" data-bs-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false">Product Details</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link src-nav-link"  id="tab3-tab" data-bs-toggle="tab" href="#tab3" role="tab" aria-controls="tab3" aria-selected="false">File Attachment</a>
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
                                                            <input type="date" name="dn_date" class="form-control" required>
                                                        </div>


                                                        <div class="col-md-2 col-lg-2">
                                                            <label for="basicInput" class="form-label">Customer Name</label>
                                                            
                                                            <select class="form-select customer_sel" name="dn_customer" id="customer_id" required>
                                                               
                                                            </select>
                                                        </div>


                                                        <div class="col-md-2 col-lg-2">

                                                            <label for="basicInput" class="form-label">Sales Order Number</label>

                                                            <select class="form-select sales_order_add_clz" name="dn_sales_order_num" id="sales_order_add" required>

                                                                <option value="" selected disabled>Select Sales Order</option>
                                                                
                                                            </select>

                                                        </div>


                                                        <div class="col-md-2 col-lg-2">
                                                            <label for="basicInput" class="form-label">LPO Reference</label>
                                                            <input type="text" name="dn_lpo_reference" class="form-control lpo_ref" required>
                                                        </div>




                                                        <div class="col-md-2 col-lg-2">
                                                            <label for="basicInput" class="form-label">Contact Person</label>
                                                            <input type="text" name="dn_conact_person" class="form-control cont_person" required>
                                                           
                                                        </div>

                                              


                                                        <div class="col-md-2 col-lg-2">
                                                            <label for="basicInput" class="form-label">Project</label>
                                                            <input type="text" name="dn_project"  class="form-control project_clz" required>
                                                        </div>
                                                       
                                                         
                                                    </div>

                                                    <div class="modal-footer justify-content-center">
                                                        <button class="btn btn btn-success">Submit</button>
                                                    </div>

                                                </form>
                                            </div>
                                                
                                            
                                            
                                            <!---->
                                            <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                                                <form class="Dashboard-form class" id="add_form2">
                                                    <div class="prod_table_clz"></div>
                                                    <!--<table class="table table-bordered table-striped delTable">
                                                        <tbody class="travelerinfo">
                                                            <tr>
                                                                <td>Serial No.</td>
                                                                <td>Product Description</td>
                                                                <td>Unit</td>
                                                                <td>Quantity</td>
                                                                <td>Action</td>
                                                            </tr>

                                                            <tr>
                                                                <td>1</td>
                                                                <td>
                                                                    <select class="form-select ser_product_det" name="dpd_prod_det[]" required>
                                                                        <option selected>Select Product Description</option>
                                                                        <?php foreach($products as $prod){?>
                                                                            <option value="<?php echo $prod->product_id;?>"><?php echo $prod->product_details;?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
                                                                <td><input type="text" name="dpd_prod_unit[]" class="form-control" required></td>
                                                                <td><input type="number" name="dpd_quantity[]" class="form-control" required></td>
                                                                <td><div class="tecs"><span id="add_product" class="add_icon"><i class="ri-add-circle-line"></i>Add </span></div></td>
                                                            </tr>
                                                            
                                                        </tbody>
                                                        <tbody id="product-more" class="travelerinfo"></tbody>
                                                    </table>--->
                                                    <input type="hidden" class="dpd_del_clz" name="dpd_delivery_id">
                                                    <div class="modal-footer justify-content-center">
                                                        <button class="btn btn btn-success">Submit</button>
                                                    </div>
                                                </form> 
                                            </div>   
                                            <!---->


                                            <!--tab 3-->

                                            <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
                                                <form class="Dashboard-form class" id="add_form3">
                                                    <!-- Tab 1 content goes here -->
                                                    <div class="row">
                                                        
                                                        <div class="col-md-2 col-lg-3">
                                                            <label for="basiInput" class="form-label">Signed delivery note</label>
                                                            <input type="file" name="dn_signed_delivery_note" class="form-control" required>
                                                        </div>

                                                        <input type="hidden" name="dn_id" class="dpd_del_clz">
                                
                                                    </div>

                                                    <div class="modal-footer justify-content-center">
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
                                        <h4 class="card-title mb-0 flex-grow-1">Delivery Note</h4>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#AddModal" class="btn btn-primary py-1">Add</button>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <table id="DataTable" class="table table-bordered table-striped delTable display dataTable">
                                            <thead>
                                                <tr>
                                                    <th class="no-sort">Sl no</th>
                                                    <th>Delivery Note No</th>
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
                <h5 class="modal-title" id="exampleModalLabel">Enquiry Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-border-top-primary" role="tablist" style="margin-bottom: 20px;">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link src-nav-link active" id="tab1-tab" data-bs-toggle="tab" href="#tab3" role="tab" aria-controls="tab1" aria-selected="true">Customer Details</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link src-nav-link"  id="tab2-tab" data-bs-toggle="tab" href="#tab4" role="tab" aria-controls="tab2" aria-selected="false">Product Details</a>
                    </li>
                    
                    <!-- Add more tabs as needed -->
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab3" role="tabpanel" aria-labelledby="tab1-tab">
                        <form class="Dashboard-form class" id="add_form1">
                            <!-- Tab 1 content goes here -->
                            <div class="row">
                                <div class="col-md-2 col-lg-2">
                                    <label for="basiInput" class="form-label">Enquiry Number</label>
                                    <input type="text" name="" id="enquiry_enq_number_id" class="form-control" readonly>
                                </div>
                                <div class="col-md-2 col-lg-2">
                                    <label for="basiInput" class="form-label">date</label>
                                    <input type="date" name="" id="enquiry_date_id" class="form-control" readonly>
                                </div>
                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Customer</label>
                                    <input type="text" name="" id="enquiry_customer_id" class="form-control" readonly>
                                </div>
                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Contact Person</label>
                                    <input type="text" name="" id="enquiry_contact_person_id" class="form-control" readonly>
                                    
                                   
                                </div>
                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Sales Executive</label>
                                    <input type="text" name="" id="enquiry_sales_executive_id" class="form-control" readonly>
                                    
                                </div>
                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Validity</label>
                                    <input type="text" name="" id="enquiry_validity_id" class="form-control" readonly>
                                </div>
                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Project</label>
                                    <input type="text" name="" id="enquiry_project_id" class="form-control" readonly>
                                </div>
                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Enquiry Reference</label>
                                    <input type="text" name="" id="enquiry_enq_referance_id" class="form-control" readonly>
                                </div>
                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Assigned To</label>
                                    <input type="text" name="" id="enquiry_employees" class="form-control" readonly>
                                </div>
                                    
                            </div>
                            <div class="modal-footer justify-content-center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                               
                            </div>
                        </form>
                    </div>
                                                
                    <!---->
                    <div class="tab-pane fade" id="tab4" role="tabpanel" aria-labelledby="tab2-tab">
                        <form class="Dashboard-form class" id="product_detail_id">
                            <!-- Tab 2 content goes here -->
                            
                            
                           
                        </form>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                               
                        </div>
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
                        url: "<?php echo base_url(); ?>Crm/DeliverNote/Add",
                        method: "POST",
                        data: $(currentForm).serialize(),
                        success: function(data) {
                            var responseData = JSON.parse(data);
                            
                            $(".dpd_del_clz").val(responseData.dn_id);
                            // Trigger a click event on the next tab
                            var nextTab = $('.nav-tabs .src-nav-link.active').parent().next().find("a");
                            if (nextTab.length > 0) {
                                nextTab.tab('show');
                            } else {
                                console.error("Next tab not found!");
                            }
                            totalCalcutate();
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
                        url: "<?php echo base_url(); ?>Crm/DeliverNote/AddTab2",
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
                        url: "<?php echo base_url(); ?>Crm/DeliverNote/AddTab3",
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

                url : "<?php echo base_url(); ?>Crm/Enquiry/View",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {   
                    var data = JSON.parse(data);
                   
                    $("#enquiry_enq_number_id").val(data.enquiry_enq_number);

                    $("#enquiry_date_id").val(data.enquiry_date);

                    $("#enquiry_validity_id").val(data.enquiry_validity);

                    $("#enquiry_project_id").val(data.enquiry_project);

                    $("#enquiry_enq_referance_id").val(data.enquiry_enq_referance);

                    $("#enquiry_sales_executive_id").val(data.sales_executive);
                    
                    $("#enquiry_customer_id").val(data.customer_creation);

                    $("#enquiry_contact_person_id").val(data.contact_details);

                    $("#enquiry_employees").val(data.enquiry_employees);

                    $("#product_detail_id").html(data.prod_details);
                   
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
                'url': "<?php echo base_url(); ?>Crm/DeliverNote/FetchData",
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
                { data: 'dn_id' },
                { data: 'dn_reffer_no' },
                { data: 'dn_date'},
                { data: 'dn_customer'},
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
            
            //Fetch Contact Person
            $.ajax({

                url : "<?php echo base_url(); ?>Crm/DeliverNote/SalesOrder",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {   
                    var data = JSON.parse(data);
                
                    $(".sales_order_add_clz").html(data.sales_order);
                    
                    
                }


            });



        });



        /**/
        $("body").on('change', '.sales_order_add_clz', function(){ 

            var id = $(this).val();
            
            //Fetch Contact Person
            $.ajax({

                url : "<?php echo base_url(); ?>Crm/DeliverNote/FetchSalesData",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {   
                    var data = JSON.parse(data);
                
                    $(".sales_order_add_clz").html(data.sales_order);

                    $(".lpo_ref").val(data.so_lpo);

                    $(".so_contact_person").val(data.so_lpo);

                    $(".cont_person").val(data.so_contact_person);

                    $(".project_clz").val(data.so_project);

                    $(".prod_table_clz").html(data.product_detail);
                    
                    
                }


            });

        });
        /**/


       
        /**/

        var max_fieldspp      = 30;
        var pp = 1;
        
        $("body").on('click', '.add_product', function(){
            var pp = $('.prod_row').length
			if(pp < max_fieldspp){ 
			    pp++;
	            $(".product-more").append("<tr class='prod_row'><td>" + pp + "</td><td><select class='form-select' name='dpd_prod_det[]' required=''><option value='' selected disabled>Select Product Description</option><?php foreach($products as $prod){?><option value='<?php echo $prod->product_id;?>'><?php echo $prod->product_details;?></option><?php } ?></select></td><td><input type='text' name='dpd_prod_unit[]' class='form-control ' required=''></td><td><input type='number' name='dpd_quantity[]' class='form-control ' required=''></td><td class='remove-btnpp' colspan='6'><div class='remainpass'><i class='ri-close-line'></i>Remove</div></td></tr>");

			}
	    });

        $(document).on("click", ".remove-btnpp", function() 
        {
	 
	        $(this).parent().remove();
	        pp--;
        });

        /**/





        /*customer droup drown search*/
        $(".customer_sel").select2({
            placeholder: "Select Customer",
            theme : "default form-control-",
            dropdownParent: $('#AddModal'),
            ajax: {
                url: "<?= base_url(); ?>Crm/ProFormaInvoice/FetchCustomers",
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
        /*###*/



        /* Fetch Sales Orders */



        /*onchange function Sales Order Number*/

        $('#sales_order_add').change(function(){

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


        });

        /**/




        /*product detail calculation*/
        
        $("body").on('keyup', '.discount_clz_id , .qtn_clz_id , .rate_clz_id', function(){ 

            var discount = $(this).val();

            var discountSelect = $(this);

            var discountSelectElement = discountSelect.closest('.prod_row').find('.rate_clz_id');

            var rate = discountSelectElement.val();

            var quantitySelectElement = discountSelect.closest('.prod_row').find('.qtn_clz_id');

            var quantity = quantitySelectElement.val();

            var parsedRate = parseFloat(rate);

            var parsedQuantity = parseFloat(quantity); 

            var multipliedTotal = parsedRate * parsedQuantity;

            var result = discount / 100;

            var orginalPrice = multipliedTotal * result

            var $amountElement = discountSelect.closest('.prod_row').find('.amount_clz_id');

            $amountElement.val(orginalPrice);

            totalCalcutate()

        });

        /*delete product detail row*/

        $("body").on('click', '.row_remove', function(){ 
	   
            var id = $(this).data('id');

            $('#' + id).fadeOut('fast', function() {
        
                $(this).remove();

            });

          
        });

        /**/


        function totalCalcutate()
        {  
            var total = 0;
            $('body .amount_clz_id').each(function()
            {
                var sub_tot = $(this).val();
                total += parseInt(sub_tot)||0;
                console.log(total);
            });

            $('input[name=pf_total_cost]').val(total);

           $("#total_cost_id").html('Grand Total:' + total);

        }

        /**/

       

       





    });



</script>