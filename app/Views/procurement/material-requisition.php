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
    /*span.select2.select_width
    {
        width: 70% !important;
    }*/
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
                        
                        <!--add material requisition modal start-->
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
                                                                        <input type="text" name="mr_reffer_no" id="mr_id" class="form-control" value="" required readonly>
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
                                                            <tr class="prod_row prod_row_lenght">
                                                                <td style="width: 10%;"class="si_no">1</td>
                                                                <td>
                                                                    <select class="form-select add_sales_order" name="mrp_sales_order[0]" required>
                                                                         <option value="" selected disabled>Select Sales Order Ref</option>
                                                                         <?php foreach($sales_orders as $sales_order){?> 
                                                                         <option value="<?php echo $sales_order->so_id;?>"><?php echo $sales_order->so_reffer_no;?></option>
                                                                         <?php } ?>
                                                                    </select>
                                                                </td>
                                                                <td style="width:40%">
                                                               
                                                                    <select class="form-select  ser_product_det" name="mrp_product_desc[0]" required>
                                                                        <option value="" selected disabled>Select Product Description</option>
                                                                        
                                                                    </select>
                                                                </td>
                                                                <td><input type="text" name="mrp_unit[0]" class="form-control mrp_unit_clz" required></td>
                                                                <td><input type="number" name="mrp_qty[0]" class="form-control mrp_qty_clz" required></td>
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
                                            <button class="btn btn btn-success once_form_submit" type="submit">Save</button>
                                        </div>


                                        
			                        </div>
		                        </form>

	                        </div>
                        </div>


                        <!--####-->





                        <!---view modal start--->
                        <div class="modal fade" id="viewModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                        <input type="text" name="mr_reffer_no"  class="form-control view_reffer_no"  readonly>
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
                                                                        <input type="text" name="mr_date" class="form-control mr_date  view_date" readonly>
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
                                                                        <input type="text" name="mr_time_frame" class="form-control time_frame_date  view_time_frame" value="" readonly>
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

                                                                    <input type="text" name="mr_time_frame" class="form-control view_assigned_to" value="" readonly>

                                                               
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
                                                                
                                                            </tr>
                                                            
                                                        </tbody>
                                                        <tbody class="view_products"></tbody>
                                                        <tbody id="product-more" class="travelerinfo"></tbody>
                                                    </table>
                                                </div>

                                                <!--table section end-->


                                            </div>  
                                            
                                            
						                    
				                        </div>


                                       


                                        
			                        </div>
		                        </form>

	                        </div>
                        </div>


                        <!---view modal end--->



                        <!---edit modal start--->

                        <div class="modal fade" id="editModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="edit_modal_form">
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
                                                                        <input type="text" name="mr_reffer_no"  class="form-control edit_reffer_no"  required readonly>
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
                                                                        <input type="text" name="mr_date" class="form-control mr_date datepicker edit_date" required>
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
                                                                        <input type="text" name="mr_time_frame" class="form-control time_frame_date datepicker edit_time_frame" value="" required>
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

                                                                      <!--<input type="text" name="mr_time_frame" class="form-control edit_assigned_to" value="" required>--->
                                                                      <select class="form-select edit_assigned_to" name="mr_assigned_to" required="" aria-required="true"></select>
                                                               
                                                                    </div>

                                                                </div> 

                                                            </div>  
                                                            
                                                            <input type="hidden" name="mr_id"  class="edit_material_id">

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
                                                            
                                                        </tbody>
                                                        <tbody class="edit_products"></tbody>
                                                        <tbody id="product-more" class="travelerinfo">
                                                            <tr>
                                                                <td colspan="8" align="center" class="tecs">
                                                                    <span class="add_icon add_product2"><i class="ri-add-circle-line"></i>Add</span>
                                                                </td>
                                                                
                                                            </tr>

                                                        </tbody>
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



                        <!----edit modal end--->

                        <!--edit single sales order start-->

                        <div class="modal fade" id="SingleEditSales" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="edit_sales_form">
			                        <div class="modal-content">
                    
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Sales Order Details</h5>
                                            <button type="button" class="btn-close edit_modal_close"  aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">

                                            <div class="card-seprate_divider"></div>

                                            <div class="live-preview">
                                                <table  class="table table-bordered table-striped delTable">
                                                    <tbody class="travelerinfo">
                                                        <tr>
                                                            
                                                            <td>Sales Order</td>
                                                            <td>Product Description</td>
                                                            <td>Unit</td>
                                                            <td>Qty</td>
                                                            
                                                        </tr>
                                                        
                                                    </tbody>

                                                    <tbody class="person-more edit_single_sales_order" class="travelerinfo"></tbody>
                                                
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

                        <!--edit single sales order  end-->


                        <!--add single sales order start-->

                        <div class="modal fade" id="SingleAddSales" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="edit_add_sales_form">
			                        <div class="modal-content">
                    
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Sales Order Details</h5>
                                            <button type="button" class="btn-close edit_modal_close"  aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">

                                            <div class="card-seprate_divider"></div>

                                            <div class="live-preview">
                                                <table  class="table table-bordered table-striped delTable">
                                                    <tbody class="travelerinfo">
                                                        <tr>
                                                            
                                                            <td>Sales Order</td>
                                                            <td>Product Description</td>
                                                            <td>Unit</td>
                                                            <td>Qty</td>
                                                            
                                                        </tr>
                                                        
                                                    </tbody>

                                                    <tbody class="" class="travelerinfo">
                                                        
                                                        <tr>
           
                                                            <td>
                                                                <select class="form-select edit_add_sales_order" name="mrp_sales_order" required>
                                                                    <option value="" selected disabled>Select Sales Order Ref</option>
                                                                    <?php foreach($sales_orders as $sales_order){?> 
                                                                    <option value="<?php echo $sales_order->so_id;?>"><?php echo $sales_order->so_reffer_no;?></option>
                                                                    <?php } ?>
                                                                </select>

                                                            </td>
                                                            <td>
                                                                <select class="form-select edit_add_prod_desc" name="mrp_product_desc"  required>
                                                                    
                                                                </select>
                                                            </td>
                                                            <td><input type="text" name="mrp_unit"  value="" class="form-control" required></td>
                                                            <td> <input type="number" name="mrp_qty" value="" class="form-control" required></td>
                                                            <input type="hidden" name="mrp_mr_id" class="mrp_mr_clz_id">
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

                        <!--add single sales order  end-->





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
                    $('.once_form_submit').attr('disabled', true); // Disable this input.
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
        var jj = 0;
        $("#add_product").click(function(){

			if(pp < max_fieldspp){ 
			    pp++;
                jj++;
                
               $("#product-more").append(
                    "<tr class='prod_row mr_remove prod_row_lenght'>" +
                    "<td class='si_no'><input type='number' value='" + pp + "' name='pd_serial_no["+jj+"]' class='form-control' required='' readonly></td>" +
                    "<td>" +
                    "<select class='form-select add_sales_order' name='mrp_sales_order["+jj+"]' required>" +
                    "<option value='' selected disabled>Select Sales Order Ref</option>" +
                    "<?php foreach($sales_orders as $sales_order): ?>" +
                    "<option value='<?php echo $sales_order->so_id; ?>'><?php echo $sales_order->so_reffer_no; ?></option>" +
                    "<?php endforeach; ?>" +
                    "</select>" +
                    "</td>" +
                    "<td style='width: 40%;'>" +
                    "<select class='form-select ser_product_det' name='mrp_product_desc["+jj+"]' required>" +
                    "<option value='' selected disabled>Select Product Description</option>" +
                    "<?php foreach($products as $prod): ?>" +
                    "<option value='<?php echo $prod->product_id; ?>'><?php echo $prod->product_details; ?></option>" +
                    "<?php endforeach; ?>" +
                    "</select>" +
                    "</td>" +
                    "<td><input type='text' name='mrp_unit["+jj+"]' class='form-control mrp_unit_clz' required></td>" +
                    "<td><input type='number' name='mrp_qty["+jj+"]' class='form-control mrp_qty_clz' required></td>" +
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

            reName();
        });

        /*#####*/


        /*rename function start*/

        function reName(){
            
            var jj = 0;

            $('body .prod_row_lenght').each(function() {
                
                //var  rate =  $(this).closest('.quot_row_leng').find('.rate_clz_id').val();

                $(this).closest('.prod_row_lenght').find('.add_sales_order').attr('name', 'mrp_sales_order['+jj+']');

                $(this).closest('.prod_row_lenght').find('.ser_product_det').attr('name', 'mrp_product_desc['+jj+']');

                $(this).closest('.prod_row_lenght').find('.mrp_unit_clz').attr('name', 'mrp_unit['+jj+']');
                    
                $(this).closest('.prod_row_lenght').find('.mrp_qty_clz').attr('name', 'mrp_qty['+jj+']');

                jj++;

            });
        }


        /*rename function end*/





       /*Product Drop Down*/
        function InitSelect2(){
          $(".ser_product_det:last").select2({
            placeholder: "Select Product",
            theme : "default form-control- select_width",
            dropdownParent: $('#AddMaterialRequisition'),
            ajax: {
                url: "<?= base_url(); ?>Procurement/MaterialRequisition/FetchProd",
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


        /*fetch product by sales order*/

        $("body").on('change', '.add_sales_order', function(){ 

            var $salesSelect = $(this);
	        
            //var sales_order = $(this).val();
 
            $.ajax({
 
                 url : "<?php echo base_url(); ?>Procurement/MaterialRequisition/FetchProdDes",
 
                 method : "POST",
 
                 //data: {salesOrder: sales_order},
 
                 success:function(data)
                 {   
                    var data = JSON.parse(data);
                 
                    // Find the closest .prod_row and then find the .ser_product_det within it
                    var $closestProdRow = $salesSelect.closest('.prod_row');
                    var $productDetailElement = $closestProdRow.find('.ser_product_det');
            
                    // Update the HTML content of the product detail element
                    $productDetailElement.html(data.product);
                        
                     
                 }
 
 
             });
 
 
        });

        /**/


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
            $('.once_form_submit').attr('disabled', false); // Disable this input.

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



        /*view section start*/

        $("body").on('click', '.view_btn', function(){ 

            var id = $(this).data('id'); 

            $.ajax({

                url : "<?php echo base_url(); ?>Procurement/MaterialRequisition/View",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {

                    var data = JSON.parse(data);

                    $('.view_reffer_no').val(data.reffer_no);

                    $('.view_date').val(data.mr_date);

                    $('.view_time_frame').val(data.mr_time_frame);

                    $('.view_assigned_to').val(data.mr_assigned_to);

                    $('.view_products').html(data.sales_order);


                }

            });

            $('#viewModal').modal('show');

        });


        /*view section end*/





        /*edit section start*/

        $("body").on('click', '.edit_btn', function(){ 

            var id = $(this).data('id'); 

            $.ajax({

                url : "<?php echo base_url(); ?>Procurement/MaterialRequisition/Edit",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {

                    var data = JSON.parse(data);

                    $('.edit_reffer_no').val(data.reffer_no);

                    $('.edit_date').val(data.mr_date);

                    $('.edit_time_frame').val(data.mr_time_frame);

                    $('.edit_material_id').val(data.material_requisition_id);

                    $('.edit_assigned_to').html(data.mr_assigned_to);

                    $('.edit_products').html(data.sales_order);

                }

            });

            $('#editModal').modal('show');

        });


        $("body").on('click', '.edit_sales_btn', function(){ 

            var id = $(this).data('id'); 

            $.ajax({

                url : "<?php echo base_url(); ?>Procurement/MaterialRequisition/EditSalesOrder",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {

                    var data = JSON.parse(data);

                    $('.edit_single_sales_order').html(data.sales_order);


                }

            });

            $('#SingleEditSales').modal('show');

            $('#editModal').modal('hide');

        });


        /*update section start*/

        $(function() {
            var form = $('#edit_modal_form');
            
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
                        url: "<?php echo base_url(); ?>Procurement/MaterialRequisition/Update",
                        method: "POST",
                        data: $(currentForm).serialize(),
                        success: function(data) {
                           
                            /*$('#add_mr_form')[0].reset();
                            $('.ser_product_det').val('').trigger('change');
                            $('.add_assigned_to').val('').trigger('change');
                            $('.add_sales_order').val('').trigger('change');
                            $('.mr_remove').remove();*/
                           
                            $('#editModal').modal('hide');

                            alertify.success('Data Added Successfully').delay(3).dismissOthers();
                           
                            datatable.ajax.reload(null, false);
                           
                        }
                    });
                   
                }
            });
        });


        /*update section end*/





        /*edit sales order start*/

        $(function() {
            var form = $('#edit_sales_form');
            
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
                        url: "<?php echo base_url(); ?>Procurement/MaterialRequisition/UpdateSalesOrder",
                        method: "POST",
                        data: $(currentForm).serialize(),
                        success: function(data) {
                           
                            var data = JSON.parse(data);

                            var mrqID = data.material_requisition_id; 

                            $('#SingleEditSales').modal('hide');
                          
                            alertify.success('Data Added Successfully').delay(3).dismissOthers();
                           
                            datatable.ajax.reload(null, false);

                            $('.edit_btn[data-id="'+mrqID+'"]').trigger('click');
                           
                        }
                    });
                   
                }
            });
        });

        /*edit sales order end*/


        /*delete single sales order start*/


        $("body").on('click', '.delete_sales_btn', function(){ 

            var id = $(this).data('id'); 

            var rowToDelete = $(this).closest('tr');

            $.ajax({

                url : "<?php echo base_url(); ?>Procurement/MaterialRequisition/DeleteSalesOrder",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {
                    
                    rowToDelete.fadeOut(500, function() {
                        $(this).remove();
                        EditSlno();
                        alertify.success('Data Delete Successfully').delay(3).dismissOthers();
                    }); 
                        

                }

            });
 

        });


        /*delete single sales order end*/


        /*add single sales order start*/


        $(".add_product2").on('click',function(){ 

            var material_id = $('.edit_material_id').val(); 

            $('.mrp_mr_clz_id').val(material_id);

            $('#SingleAddSales').modal('show');

            $('#editModal').modal('hide');


        });


        /*add single sales order end*/


        /*add single sale form submit start*/

        $(function() {
            var form = $('#edit_add_sales_form');
            
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
                        url: "<?php echo base_url(); ?>Procurement/MaterialRequisition/InsertSalesOrder",
                        method: "POST",
                        data: $(currentForm).serialize(),
                        success: function(data) {

                            var data = JSON.parse(data);

                            var matID = data.mat_req_id;

                            $('#SingleAddSales').modal('hide');

                            $('#edit_add_sales_form')[0].reset();

                            $('.edit_add_sales_order').val('').trigger('change');

                            $('.edit_add_prod_desc').val('').trigger('change');

                            alertify.success('Data Added Successfully').delay(3).dismissOthers();
                           
                            datatable.ajax.reload(null, false);

                            $('.edit_btn[data-id="'+matID+'"]').trigger('click');
                           
                        }
                    });
                   
                }
            });
        });

        /*add single sale form submit end*/

        /*fetch product desc by saler order start*/
        $("body").on('change', '.edit_sales_order', function(){ 

            var id = $('.edit_sales_order').val();

            $.ajax({

            url : "<?php echo base_url(); ?>Procurement/MaterialRequisition/FetchProdDes",

                method : "POST",

                data: {salesOrder: id},

                success:function(data)
                {
                    var data = JSON.parse(data);

                    $('.edit_prod_desc').html(data.product);  
                    
                    console.log(data.product);

                
                }

            });



        });



        $("body").on('change', '.edit_add_sales_order', function(){ 

            var id = $('.edit_add_sales_order').val();

            $.ajax({

            url : "<?php echo base_url(); ?>Procurement/MaterialRequisition/FetchProdDes",

                method : "POST",

                data: {salesOrder: id},

                success:function(data)
                {
                    var data = JSON.parse(data);

                    $('.edit_add_prod_desc').html(data.product);  
                    
                    console.log(data.product);

                
                }

            });

        });

        /*fetch product desc by saler order end*/


        /*rearrange slno*/
       
        function EditSlno(){
        
            var pp =1;
            
            $('body .edit_prod_row').each(function() {

                $(this).find('.si_no_edit').html('<td class="edit_prod_row">' + pp + '</td>');

                pp++;

            });
        }

        /**/




        /*edit modal close section start*/

        $('.edit_modal_close').on('click', function() {

            $('#editModal').modal('show');

            $('#SingleAddSales').modal('hide');

            $('#SingleEditSales').modal('hide');

     
        });

        /*edit modal close section end*/






        /*edit section end*/



        /*delete section start*/

        $("body").on('click', '.delete_btn', function(){ 

            if (!confirm('Are you absolutely sure you want to delete?')) return false;

            var id = $(this).data('id'); 

            var rowToDelete = $(this).closest('tr');

            $.ajax({

                url : "<?php echo base_url(); ?>Procurement/MaterialRequisition/Delete",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {   
                    var data = JSON.parse(data);

                    if(data.status == "false")
                    {
                        alertify.error("Data in Use Can't Be Delete").delay(3).dismissOthers();
                    }
                    else
                    {
                        rowToDelete.fadeOut(500, function() {
                            $(this).remove();
                            alertify.error('Data Delete Successfully').delay(3).dismissOthers();
                            datatable.ajax.reload(null,false);
                        }); 
                    }
                    
                        

                }

            });

        });

        /*delect section end*/


        document.addEventListener("DOMContentLoaded", function(event) {

            function isDataTableRequest(ajaxSettings) {
                // Check for DataTables-specific URL or any other pattern
                return ajaxSettings.url && ajaxSettings.url.includes('/FetchData');
            }

            function isSelect2Request(ajaxSettings) {
                // Check for specific data or parameters in Select2 requests
                return ajaxSettings.url && ajaxSettings.url.includes('term='); // Adjust based on actual request data
            }


            function isSelect2Search(ajaxSettings) {
                // Check for specific data or parameters in Select2 requests
                return ajaxSettings.url && ajaxSettings.url.includes('page='); // Adjust based on actual request data
            }


            $(document).ajaxSend(function(event, jqXHR, ajaxSettings) {
                if ((!isDataTableRequest(ajaxSettings)) && (!isSelect2Request(ajaxSettings)) && (!isSelect2Search(ajaxSettings))) {
                    $("#overlay").fadeIn(300);
                }
            });


            $(document).ajaxComplete(function(event, jqXHR, ajaxSettings) {
                if ((!isDataTableRequest(ajaxSettings)) && (!isSelect2Request(ajaxSettings)) && (!isSelect2Search(ajaxSettings))) {
                    $("#overlay").fadeOut(300);
                }
            });



            $(document).ajaxError(function() {
                alertify.error('Something went wrong. Please try again later').delay(5).dismissOthers();
            });


        });

        


        




    });



</script>