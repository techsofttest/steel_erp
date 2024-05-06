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
                        <div class="modal fade" id="AddMaterialRequisition" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="add_mr_form">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Material Requisition</h5>
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
                                                                        <input type="text" name="mr_reffer_no" id="mr_id" class="form-control" value="<?php echo $material_requisition; ?>" required readonly>
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
                                                                        <input type="text" name="mr_date" class="form-control mr_date datepicker" required>
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
                                                                        <label for="basicInput" class="form-label">Time Frame</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="mr_time_frame" class="form-control time_frame_date datepicker" value="" required>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Assigned To</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                    <select class="form-select add_assigned_to" name="mr_assigned_to"  required>
                                                                        <option value="" selected disabled>Assigned To</option>
                                                                        <?php foreach($employees as $employ){?> 
                                                                            <option value="<?php echo $employ->employees_id;?>"><?php echo $employ->employees_name;?></option>
                                                                        <?php } ?>
                                                                
                                                                     </select>
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
                                                                <td>sales Order Ref</td>
                                                                <td>Product Description</td>
                                                                <td>Unit</td>
                                                                <td>Qty</td>
                                                                <td>Action</td>
                                                            </tr>
                                                            <tr class="prod_row">
                                                                <td style="width: 10%;"class="si_no">1</td>
                                                                <td>
                                                                    <select class="form-select add_sales_order" name="mrp_sales_order[]" required>
                                                                         <option value="" selected disabled>Select Sales Order Ref</option>
                                                                         <?php foreach($sales_orders as $sales_order){?> 
                                                                         <option value="<?php echo $sales_order->so_id;?>"><?php echo $sales_order->so_reffer_no;?></option>
                                                                         <?php } ?>
                                                                    </select>
                                                                </td>
                                                                <td style="width:28%">
                                                               
                                                                    <select class="form-select  ser_product_det" name="mrp_product_desc[]" required>
                                                                        <option value="" selected disabled>Select Product Description</option>
                                                                        
                                                                    </select>
                                                                </td>
                                                                <td><input type="text" name="mrp_unit[]" class="form-control" required></td>
                                                                <td><input type="number" name="mrp_qty[]" class="form-control" required></td>
                                                                <td><div class="tecs"><span id="add_product" class="add_icon"><i class="ri-add-circle-line"></i>Add </span></div></td>
                                                            </tr>
                                                        </tbody>
                                                        <tbody id="product-more" class="travelerinfo"></tbody>
                                                    </table>
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
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#AddMaterialRequisition" class="btn btn-primary py-1 add_model_btn">Add</button>
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







<script>

    document.addEventListener("DOMContentLoaded", function(event) { 
    
        /*add section start*/  

        
        /*add form*/
        $(function() {
            var form = $('#add_mr_form');
            
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
                        url: "<?php echo base_url(); ?>Procurement/MaterialRequisition/Add",
                        method: "POST",
                        data: $(currentForm).serialize(),
                        success: function(data) {
                           
                            $('#add_mr_form')[0].reset();
                            $('.ser_product_det').val('').trigger('change');
                            $('.add_assigned_to').val('').trigger('change');
                            $('.add_sales_order').val('').trigger('change');
                            $('#AddMaterialRequisition').modal('hide');
                            $('.mr_remove').remove();
                           
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
            dropdownParent: $('#AddMaterialRequisition'),
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
                'url': "<?php echo base_url(); ?>Procurement/MaterialRequisition/FetchData",
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
                { data: 'mr_id'},
                { data: 'mr_reffer_no'},
                { data: 'mr_date'},
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

            $('#add_mr_form')[0].reset();
            $('.ser_product_det').val('').trigger('change');
            $('.add_assigned_to').val('').trigger('change');
            $('.add_sales_order').val('').trigger('change');
            $('#AddMaterialRequisition').modal('hide');
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

        


        




    });



</script>