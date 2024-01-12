<div class="tab-content text-muted">
								
    <div class="tab-pane active" id="nav-crm-top-1-1" role="tabpanel">
                    
        <div class="row">
            
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
        
                        <!-- Start Subtabs -->
                        <ul class="nav nav-pills arrow-navtabs nav-success bg-light mb-3" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url(); ?>Crm/DeliverNote" role="tab">
                                    <span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
                                    <span class="d-none d-sm-block">Delivery Note</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="<?= base_url(); ?>Crm/CashInvoice" role="tab">
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
                                        <h5 class="modal-title" id="exampleModalLabel">Cash Invoice</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs nav-border-top-primary" role="tablist" style="margin-bottom: 20px;">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link src-nav-link active" id="tab1-tab" data-bs-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">Cash Invoice</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link src-nav-link"  id="tab2-tab" data-bs-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false">Product Details</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link src-nav-link"  id="tab3-tab" data-bs-toggle="tab" href="#tab3" role="tab" aria-controls="tab3" aria-selected="false">Attachment</a>
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
                                                            <input type="date" name="ci_date" class="form-control" required>
                                                        </div>

                                                        <div class="col-md-2 col-lg-2">
                                                            <label for="basicInput" class="form-label">Customer Name</label>
                                                            
                                                            <select class="form-select customer_sel" name="ci_customer_number1" id="customer_id" required>
                                                               
                                                            </select>
                                                        </div>


                                                        <div class="col-md-2 col-lg-2">
                                                            <label for="basicInput" class="form-label">Sales Account</label>
                                                            <select class="form-select" name="ci_sale_account" required>
                                                                <option value="" selected disabled>Select Sales Account</option>
                                                                <?php foreach($charts_of_accounts as $chart_account){?> 
                                                                    <option value="<?php echo $chart_account->ca_id; ?>"><?php echo $chart_account->ca_name; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>


                                                        <div class="col-md-2 col-lg-2">

                                                            <label for="basicInput" class="form-label">Sales Order Number</label>

                                                            <select class="form-select sales_order_add_clz" name="ci_sales_order" id="sales_order_add" required>

                                                                <option value="" selected disabled>Select Sales Order</option>
                                                                
                                                            </select>

                                                        </div>


                                                        <div class="col-md-2 col-lg-2">
                                                            <label for="basicInput" class="form-label">LPO Reference</label>
                                                            <input type="text" name="ci_lpo_reff" class="form-control lpo_ref" required>
                                                        </div>




                                                        <div class="col-md-2 col-lg-2">
                                                            <label for="basicInput" class="form-label">Contact Person</label>
                                                            <input type="text" name="ci_contact_person" class="form-control cont_person" required>
                                                           
                                                        </div>

                                              


                                                        <div class="col-md-2 col-lg-2">
                                                            <label for="basicInput" class="form-label">Project</label>
                                                            <input type="text" name="ci_project"  class="form-control project_clz" required>
                                                        </div>


                                                        <div class="col-md-2 col-lg-2">
                                                            <label for="basicInput" class="form-label">Customer Name</label>
                                                            <select class="form-select" name="ci_customer_number2" required>
                                                                <option value="" selected disabled>Select Customer Name</option>
                                                                <?php foreach($customer_creation as $cust_creat){?> 
                                                                    <option><?php echo $cust_creat->cc_customer_name;?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>


                                                        
                                                       
                                                         
                                                    </div>
                                                    <div class="modal-footer justify-content-center">
                                                        <button class="btn btn btn-success">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                                
                                            
                                            
                                            <!---->
                                            <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                                                <form class="Dashboard-form class" id="add_form2">
                                                    <div class="product_det_clz"></div>
                                                    
                                                    <input type="hidden" class="dpd_del_clz" name="cipd_cash_invoice">
                                                    <div class="modal-footer justify-content-center">
                                                        <button class="btn btn btn-success">Submit</button>
                                                    </div>
                                                </form> 
                                            </div>   
                                            <!---->


                                            <!--tab3--->
                                             
                                            <div class="tab-pane fade" id="tab3" role="tabpane3" aria-labelledby="tab3-tab">
                                                <form class="Dashboard-form class" id="add_form3">
                                                    <!-- Tab 1 content goes here -->
                                                    <div class="row">
                                                        
                                                        <div class="col-md-2 col-lg-2">
                                                            
                                                            <label for="basiInput" class="form-label ">Update Cash Invoice Status</label>
                                                            
                                                            <select class="form-select" name="ci_cash_invoice_status" required>
                                                                <option value="" selected disabled>Select Cash Invoice Status</option>

                                                                <?php foreach($cash_invoice as $cash_inv){?> 

                                                                    <option value="<?php echo $cash_inv->cis_id; ?>"><?php echo $cash_inv->cis_cash_invoice_status;?></option>    

                                                                <?php } ?>

                                                            </select>

                                                        </div>

                                                        <div class="col-md-2 col-lg-2">
                                                            <label for="basiInput" class="form-label">Signed Cash Invoice</label>
                                                            <input type="file" name="ci_signed_cash_invoice" class="form-control" required>
                                                        </div>

                                                        <input type="hidden" class="dpd_del_clz" name="ci_id">

                                                    </div>

                                                    <div class="modal-footer justify-content-center">
                                                        <button class="btn btn btn-success">Save</button>
                                                    </div>
                                                </form>
                                            </div>


                                            <!--####-->

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
                                                    <th>Cash Invoice No</th>
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
                        url: "<?php echo base_url(); ?>Crm/CashInvoice/Add",
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
                        url: "<?php echo base_url(); ?>Crm/CashInvoice/AddTab2",
                        method: "POST",
                        data: $(currentForm).serialize(),
                        success: function(data) {
                            /*$('#add_form1')[0].reset();
                            $('#add_form2')[0].reset();
                          
                            $('#AddModal').modal('hide');
                            alertify.success('Data Added Successfully').delay(3).dismissOthers();
                            datatable.ajax.reload(null, false);*/

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
                        url: "<?php echo base_url(); ?>Crm/CashInvoice/AddTab3",
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
                'url': "<?php echo base_url(); ?>Crm/CashInvoice/FetchData",
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
                { data: 'ci_id' },
                { data: 'ci_reffer_no' },
                { data: 'ci_date'},
                { data: 'ci_customer_number1'},
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

            $('.sales_order').val('');
            
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

                url : "<?php echo base_url(); ?>Crm/CashInvoice/FetchSalesData",

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

                    $(".product_det_clz").html(data.product_detail);

                    $('.lpo_ref').addClass('sales_order');

                    $('.cont_person').addClass('sales_order');

                    $('.project_clz').addClass('sales_order');
                   
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
	           
                $(".product-more").append("<tr class='prod_row'><td>" + pp + "</td><td><select class='form-select ser_product_det' name='cipd_prod_det[]' required=''><option value='' selected disabled>Select Product Description</option><?php foreach($products as $prod){?><option value='<?php echo $prod->product_id;?>'><?php echo $prod->product_details;?></option><?php } ?></select></td><td><input type='text' name='cipd_unit[]' class='form-control ' required=''></td><td><input type='number' name='cipd_order_qtn[]' class='form-control real_qty' required=''></td><td><input type='number' name='cipd_qtn[]'  class='form-control qtn_limit qtn_clz_id' required></td><td><input type='number' name='cipd_rate[]' class='form-control rate_clz_id' required></td><td><input type='number' name='cipd_discount[]' class='form-control discount_clz_id' required></td><td><input type='number' name='cipd_amount[]' class='form-control amount_clz_id' required></td><td class='remove-btnpp' colspan='6'><div class='remainpass'><i class='ri-close-line'></i>Remove</div></td></tr>");

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
  
            $.ajax({

                url : "<?php echo base_url(); ?>Crm/CashInvoice/DeleteContact",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {   
                    alertify.success('Data Deleted Successfully').delay(2).dismissOthers();
                    $('#' + id).remove();
                    $('#' + id).fadeIn();
                }


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



        /**/

        $("body").on('change keyup', '.qtn_limit', function(){ 
            
            var id = $(this).val();

            var $totadaySelect = $(this);

            var parentDiv = $(this).closest('.prod_row');

            var realQuantityClass = parentDiv.find('.real_qty'); 

            var realQtyValue = realQuantityClass.val();

           

            if(id > realQtyValue)
            {
                alertify.error('Quantity should be less than Order Quantity').delay(3).dismissOthers();
                
                $(this).val("");

              
            }


        });

        /**/


        /*delete*/ 
        $("body").on('click', '.delete_btn', function(){ 
            alert("sucess");
            if (!confirm('Are you absolutely sure you want to delete?')) return false;
            var id = $(this).data('id');
            $.ajax({

                url : "<?php echo base_url(); ?>Crm/CashInvoice/Delete",

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