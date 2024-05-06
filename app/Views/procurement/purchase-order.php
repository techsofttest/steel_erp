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
    span.select2.select_width
    {
        width: 70% !important;
    }
    .prod_add_more
    {
        position: absolute;
        left: 340px;
        padding: 4px 27px;
        z-index: 999;
        border: 1px solid black;
        border: 1px solid #0000003b;
    }
    .row_align
    {
        display: flex;
        align-items: center;
        justify-content: unset !important;
    }
    .add_new{
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
                        <div class="modal fade" id="AddPurchaseOrder" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="add_po_form">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Purchase Order</h5>
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
                                                                        <input type="text" name="po_reffer_no" id="po_id" class="form-control" value="" required readonly>
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
                                                                        <input type="text" name="po_date" class="form-control mr_date datepicker" required>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->

                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        
                                                                        <label for="basicInput" class="form-label">Vendor Name<span class="add_more_icon add_new vendor_new_modal">New</span></label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        
                                                                        <select class="form-select select_vendor add_vendor" name="po_vendor_name" id="" style="width:80%;" required>
                                                                            
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
                                                                        
                                                                        <label for="basicInput" class="form-label">Contact Person<span class="add_more_icon add_new contact_new_modal">New</span></label>
                                                                    
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        
                                                                        <select class="form-select add_contact_person" name="po_contact_person" id="" style="width:80%;" required></select>
                                                                    
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
                                                                        
                                                                        <label for="basicInput" class="form-label">MRN Ref<span class="add_more_icon cust_more_modal">Select</span></label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        
                                                                        <select class="form-select " name="po_mrn_reff" id="" style="width:80%;" required>
                                                                            
                                                                            <option value="" selected disabled>Select MRN Ref</option>

                                                                            <?php foreach($material_reqisition as $mat_req){?> 
                                                                                <option value="<?php echo $mat_req->mr_id; ?>"><?php echo $mat_req->mr_reffer_no;?></option>
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
                                                                        <label for="basicInput" class="form-label">Payment Term</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text " name="po_payment_term" class="form-control add_payment_term" value="" required>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Delivery Date</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="po_delivery_date" class="form-control time_frame_date datepicker" value="" required>
                                                                    </div>

                                                                </div> 

                                                            </div>    
                                                            <!-- ### --> 



                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Vendor Ref</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="po_vendor_ref" class="form-control" value="" required>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 

                                                            <input type="hidden" class="hidden_purchase_id" name="po_id">



                                                        </div>

                                                    </div>
                                                   


                                                </div>


                                                <!--table section start-->
                                                <div class="mt-4">
                                                    <table class="table table-bordered table-striped delTable selected_table" style="display:none;">
                                                        <tbody class="travelerinfo">
                                                            <tr>
                                                                <td>Serial No.</td>
                                                                <td>Sales Order Ref</td>
                                                                <td>Product Description</td>
                                                                <td>Unit</td>
                                                                <td>Qty</td>
                                                                <td>Rate</td>
                                                                <td>Discount</td>
                                                                <td>Amount</td>
                                                                
                                                            </tr>
                                                            
                                                        </tbody>

                                                        <tbody  class="travelerinfo product-more2"></tbody>
                                                        <!--<tbody id="product-more" class="travelerinfo"></tbody>--->
                                                    </table>
                                                </div>


                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        
                                                        <div class="row row_align mb-4">
                                                            <div class="col-lg-2">
                                                                <label for="basicInput" class="form-label">Attach</label>
                                                            </div>

                                                            <div class="col-lg-4">
                                                                <input type="file" name="po_file" Class="image_file"  class="form-control">
                                                            </div>

                                                        </div>

                                                        
                                                    </div>
                                                    <div class="col-lg-6"></div>
                                                    
                                                </div>


                                                

                                                <!--table section end-->


                                            </div>  
                                            
                                            
						                    
				                        </div>


                                        <div class="modal-footer justify-content-center">
                                            <button class="btn btn btn-success" type="submit">Save</button>
                                        </div>


                                        
			                        </div>
		                        </form>

	                        </div>
                        </div>


                        <!--####-->


                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">View Material Requisition</h4>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#AddPurchaseOrder" class="btn btn-primary py-1 add_model_btn">Add</button>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <table id="DataTable" class="table table-bordered table-striped delTable display dataTable">
                                            
                                            <thead>
                                                <tr>
                                                    <th class="no-sort">Sl no</th>
                                                    <th>Reffer Number</th>
                                                    <th>Date</th>
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

<!--select modal section start-->

<div class="modal fade" id="SelectProduct" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<form  class="Dashboard-form class" id="selected_prod_form">
			<div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

				<div class="modal-body">

                    <div class="live-preview">
                                                
                        <div class="mt-4">
                            
                            <table class="table table-bordered table-striped delTable">
                                
                                <thead class="travelerinfo contact_tbody">
                                    
                                    <tr>
                                        <td>Serial No.</td>
                                        <td>Product Description</td>
                                        <td>Unit</td>
                                        <td>Qty</td>
                                        <td>Tick</td>
                                    </tr>
                                                            
                                                           
                                </thead>
                                                        
                                <tbody  class="travelerinfo select_prod_add"></tbody>


                            </table>
                            
                        </div>




                    </div>  
                                            
                                            
                </div>

                <div class="modal-footer justify-content-center">
                    
                    <input type="hidden" id="select_prod_id" name="select_prod_id" value="">                                
                    <span class="btn btn btn-success prod_modal_submit">Save</span>

                </div>




                                        
			</div>
		</form>

	</div>

</div>



<!--select  modal section end-->


<!--vendor modal start-->

<?= $this->include('procurement/add_vendor') ?>

<!--vendor modal end-->


<!--contact modal start-->

<?= $this->include('procurement/add_vendor_contact') ?>

<!--contact modal end-->


<script>

    document.addEventListener("DOMContentLoaded", function(event) { 
    
        /*add section start*/  

        
        /*add form*/
        $(function() {
            var form = $('#add_po_form');
            
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
                        url: "<?php echo base_url(); ?>Procurement/PurchaseOrder/Add",
                        method: "POST",
                        data: $(currentForm).serialize(),
                        success: function(data) {
                           
                            /*$('#add_mr_form')[0].reset();
                            $('.ser_product_det').val('').trigger('change');
                            $('.add_assigned_to').val('').trigger('change');
                            $('.add_sales_order').val('').trigger('change');
                             $('.mr_remove').remove();*/
                            $('#AddPurchaseOrder').modal('hide');
                           
                           
                            alertify.success('Data Added Successfully').delay(3).dismissOthers();
                           
                            datatable.ajax.reload(null, false);
                           
                            
                        }
                    });
                   
                }
            });
        });


        /*#####*/

        

        /*add more product section start*/
        var max_fieldspp  = 30;
        var pp = 1;
        $("#add_product").click(function(){

			if(pp < max_fieldspp){ 
			    pp++;
	           
                
               $("#product-more").append(
                    "<tr class='prod_row mr_remove'>" +
                    "<td class='si_no'><input type='number' value='" + pp + "' name='pd_serial_no[]' class='form-control' required='' readonly></td>" +
                    "<td>" +
                    "<select class='form-select add_sales_order' name='mrp_sales_order[]' required>" +
                    "<option value='' selected disabled>Select Sales Order Ref</option>" +
                    "<?php foreach($sales_orders as $sales_order): ?>" +
                    "<option value='<?php echo $sales_order->so_id; ?>'><?php echo $sales_order->so_reffer_no; ?></option>" +
                    "<?php endforeach; ?>" +
                    "</select>" +
                    "</td>" +
                    "<td style='width: 28%;'>" +
                    "<select class='form-select ser_product_det' name='mrp_product_desc[]' required>" +
                    "<option value='' selected disabled>Select Product Description</option>" +
                    "<?php foreach($products as $prod): ?>" +
                    "<option value='<?php echo $prod->product_id; ?>'><?php echo $prod->product_details; ?></option>" +
                    "<?php endforeach; ?>" +
                    "</select>" +
                    "</td>" +
                    "<td><input type='text' name='mrp_unit[]' class='form-control' required></td>" +
                    "<td><input type='number' name='mrp_qty[]' class='form-control' required></td>" +
                    "<td class='remove-btnpp' colspan='6'><div class='remainpass'><i class='ri-close-line'></i>Remove</div></td>" +
                    "</tr>"
                );

                slno();
                /*customer droup drown search*/
                 InitSelect2();
			}
	    });

        $(document).on("click", ".remove-btnpp", function() 
        {
	        $(this).parent().remove();

	        slno();
        });

        /*#####*/





       /*Product Drop Down*/
       function InitSelect2(){
          $(".ser_product_det:last").select2({
            placeholder: "Select Product",
            theme : "default form-control- select_width",
            dropdownParent: $('#AddPurchaseOrder'),
            ajax: {
                url: "<?= base_url(); ?>Procurement/MaterialRequisition/FetchProdDes",
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



        /*Time Frame section start*/

         
         $("body").on('change', '.mr_date', function(){ 
	        
            var date = $(this).val();
 
            
 
            $.ajax({
 
                url : "<?php echo base_url(); ?>Procurement/MaterialRequisition/Date",
 
                method : "POST",
 
                data: {Date: date},
 
                success:function(data)
                {   
                    var data = JSON.parse(data);
                 
                    $('.time_frame_date').val(data.increment_date_date)
                 
                     
                }
 
 
            });
 
 
        });
 
      
 
        /*Time Frame section end*/


        /*reset reff no*/

        $('.add_mr_form').click(function(){
           
            $('#add_enquiry_form')[0].reset();
            $('.ser_product_det').val('').trigger('change');
            $('.add_assigned_to').val('').trigger('change');
            $('.add_sales_order').val('').trigger('change');
            $('.mr_remove').remove();

            $.ajax({

                url : "<?php echo base_url(); ?>Procurement/MaterialRequisition/FetchReference",

                method : "GET",

                success:function(data)
                {  
                    $('#mr_id').val(data);
                
                }

            });

        });

        /*####*/


        /*serial no correction section start*/

        function slno(){

            var pp =1;

            $('body .prod_row').each(function() {

                $(this).find('.si_no').html(pp);
                
                
                
                pp++;

            });
        }

        /*###*/


        /*add section end*/




        /*data table start*/ 

        function initializeDataTable() {

            datatable = $('#DataTable').DataTable({
            'stateSave': true,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': 
            {
                'url': "<?php echo base_url(); ?>Procurement/PurchaseOrder/FetchData",
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
                { data: 'po_id'},
                { data: 'po_reffer_no'},
                { data: 'po_date'},
                { data: 'action'},
                
               ]
    
            });
        }

        $(document).ready(function () {
            initializeDataTable();
        });


        /*###*/


        /*reset reffer no*/ 
        $('.add_model_btn').click(function(){

            $('#add_po_form')[0].reset();
            $('.add_vendor').val('').trigger('change');
            $('#AddPurchaseOrder').modal('hide');
            $('.add_prod_remove').remove();

            $.ajax({

                url : "<?php echo base_url(); ?>Procurement/PurchaseOrder/FetchReference",

                method : "GET",

                success:function(data)
                {

                    $('#po_id').val(data);

                }
            });

        });

        /*####*/


        /*customer droup drown search*/
        $(".select_vendor").select2({
            placeholder: "Select Vendor Name",
            theme : "default form-control- customer_width",
            dropdownParent: $('#AddPurchaseOrder'),
            ajax: {
                url: "<?= base_url(); ?>Procurement/PurchaseOrder/FetchTypes",
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
                    //console.log(data);
                    var page = params.page || 1;
                    return {
                        results: $.map(data.result, function (item) { return {id: item.ven_id, text: item.ven_name}}),
                        pagination: {
                        // THE `10` SHOULD BE SAME AS `$resultCount FROM PHP, it is the number of records to fetch from table` 
                            more: (page * 10) <= data.total_count
                        }
                    };
                },              
            }
         
        })
        /*###*/



        /*fetch data by vendor name*/
        
        $("body").on('change', '.add_vendor', function(){ 
	        
            var id = $(this).val();
 
            
 
            $.ajax({
 
                url : "<?php echo base_url(); ?>Procurement/PurchaseOrder/vendorFetch",
 
                method : "POST",
 
                data: {ID: id},
 
                success:function(data)
                {   
                    var data = JSON.parse(data);
                 
                    $('.add_payment_term').val(data.payment_term)

                    $('.add_contact_person').html(data.condact_data)
                 
                    
                }
 
 
            });
 
 
        });
 
        /*Time Frame section end*/


        /*add selected product*/


        $("body").on('click', '.cust_more_modal', function()
        { 
            if(!$("#add_po_form").valid())
            {
                alertify.error('Fill required fields!').delay(3).dismissOthers();
                return false;
            }

            if($('#add_po_form').attr('data-submit')=='false')
            {

             $('#add_po_form').submit();

                if(!$("#add_po_form").valid())
                {
                alertify.error('Fill required fields!').delay(3).dismissOthers();
                return false;
                }

            }

            var formData = new FormData($('#add_po_form')[0]);
            var image = $('.image_file').prop('files')[0]; // Get the file from input field
            formData.append('image', image); // Append the file to FormData object

            $.ajax({
                        url: "<?php echo base_url(); ?>Procurement/PurchaseOrder/Add",
                        method: "POST",
                        data: formData,
                        processData: false, // Don't process the data
                        contentType: false, // Don't set content type
                        success: function(data) {

                            var data = JSON.parse(data);

                            var mrn_reff_id = data.mrn_reff_id;

                            var purchase_id = data.purchase_id;


                           $('.hidden_purchase_id').val(purchase_id);
  
                            $('#SelectProduct').modal('show');

                            $('#AddPurchaseOrder').modal('hide');

                            $.ajax({

                                url : "<?php echo base_url(); ?>Procurement/PurchaseOrder/FetchProduct",

                                method : "POST",

                                data: {ID: mrn_reff_id},
                                
                                success:function(data)
                                {   
                                    var data = JSON.parse(data);
                                    
                                    $(".select_prod_add").html(data.product_detail);

                                    
                                }   

                            });

                           
                            
                        }
                    });

        });


        /*#######*/


        /*prod modal submit start*/

        $("body").on('click', '.prod_modal_submit', function(){ 

            var selectId = $('#select_prod_id').val();

            $.ajax({

                url : "<?php echo base_url(); ?>Procurement/PurchaseOrder/SelectedProduct",

                method : "POST",

                data: {ID: selectId},

                success:function(data)
                {
                
                    var data = JSON.parse(data);
                    
                    //$('body').find('.delivery_note_remove').remove();
                
                    $('.product-more2').html(data.product_detail);

                    $('#SelectProduct').modal("hide");

                    $('#AddPurchaseOrder').modal("show");

                    $('.selected_table').show();
                    
                    checkedIds.length = 0; 

                    //console.log(data.product_detail);

                    
                }

            });
        });


        /*prod modal submit end*/

        /*calculation section start*/

	    $("body").on('keyup', '.add_discount, .add_prod_qty, .add_prod_rate', function(){ 

            var $discountSelect = $(this);

            var discount = parseInt($discountSelect.closest('.add_prod_row').find('.add_discount').val())||0;

            var $discountSelectElement = $discountSelect.closest('.add_prod_row').find('.add_prod_rate');

            var rate = $discountSelectElement.val();

            var $quantitySelectElement = $discountSelect.closest('.add_prod_row').find('.add_prod_qty');

            var quantity = parseInt($quantitySelectElement.val())||0;

            var parsedRate = parseFloat(rate);

            var parsedQuantity = quantity; 

            var multipliedTotal = parsedRate * parsedQuantity;

            var per_amount = (discount/100)*multipliedTotal;

            var orginalPrice = multipliedTotal - per_amount;

            var orginalPrice = orginalPrice.toFixed(2); //For showing 1000.00 instead of 1000 if no decimal present

            var $amountElement = $discountSelect.closest('.add_prod_row').find('.add_prod_amount');

            $amountElement.val(orginalPrice);

        });

        /*####*/


        /*vendor new modal start*/
        
        $("body").on('click', '.vendor_new_modal', function(){ 
            
            $('#AddPurchaseOrder').modal('hide');

            $('#AddVendor').modal('show');

           
        });

        /*vendor new modal end*/


        /*contact new modal start*/

        $("body").on('click', '.contact_new_modal', function(){
           
            var vendor = $('.add_vendor').val();

            if(vendor === null)
            {
                alertify.error('Please Select Vendor Name').delay(2).dismissOthers();
            }
            else
            {
                $('#AddNewContact').modal('show');

                $('#AddPurchaseOrder').modal('hide');

                $('.new_pro_con_vendor').val(vendor);
            }
            
          
        });


        /*contact new modal end*/



    });



    /*checkbox section start*/

     var checkedIds = [];

    //checkedIds.splice(0)

    checkedIds.length = 0;

    
    // Check All function

    function checkAll(checkbox) 
    {
        var checkboxes = document.getElementsByClassName('prod_checkmark');

        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = checkbox.checked;
            handleCheckboxChange(checkboxes[i]); // Update the array and modal form
        }
    }

    // Handle individual checkbox change
    function handleCheckboxChange(checkbox) 
    {   
        //checkedIds.length = 0;

        if (checkbox.checked) {
            // Add the ID to the array if checked
            checkedIds.push(checkbox.id);
        } else {
            // Remove the ID from the array if unchecked
            checkedIds = checkedIds.filter(id => id !== checkbox.id);
        }

        // Log the current state of checked IDs
        //console.log('Checked IDs: ', checkedIds);
        document.getElementById('select_prod_id').value = checkedIds.join(',');
    }


/*checkbox section end*/



</script>