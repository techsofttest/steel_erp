<style>
    
    .select2.select2-container 
    {
        width: 95% !important;
    }
    .cust_more_modal
    {
        /*position: absolute;
        left: 471px;
        padding: 0px 23px;
        z-index: 999;
        border: 1px solid black;
        border: 1px solid #0000003b;*/

        position: absolute;
        right: 32px;
        top: -16px;
        font-size: 25px;
        color: #ff0000b5;

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
  
    .input_length {
        width: 95% !important;
    }
    .add_contact{
        position: absolute;
        right: 32px;
        top: -16px;
        font-size: 25px;
        color: #ff0000b5;
    }
    .input_length2
    {
        width: 93%;
    }
    .input_length4
    {
        width: 18%;
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
                        
                        <!--add purchse voucher modal start-->
                        <div class="modal fade" id="AddPurchaseVoucher" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="purchase_form" data_fill="false">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Purchase Voucher</h5>
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
                                                                        <input type="text" name="purchase_reffer_no" id="pv_id" class="form-control input_length" value="" required readonly>
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
                                                                        <input type="text" name="purchase_date" class="form-control mr_date datepicker input_length" required>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->

                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        
                                                                        <label for="basicInput" class="form-label">Vendor Name</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        
                                                                        <select class="form-select select_vendor add_vendor vendor_data" name="purchase_vendor_name" id=""  required>
                                                                            
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
                                                                        
                                                                        <label for="basicInput" class="form-label">Contact Person</label>
                                                                    
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        
                                                                        <select class="form-select add_contact_person input_length" name="purchase_contact_person" id="" required></select>
                                                                    
                                                                    </div>


                                                                   

                                                                </div> 

                                                            </div>    

                                                            <!-- ### -->



                                                            <!-- Single Row Start -->

                                                            <!--<div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        
                                                                        <label for="basicInput" class="form-label">MRN</label>
                                                                    
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        
                                                                        <select class="form-select input_length material_received_note" name="pruchase_mrn" id="" required>

                                                                        <option value='' selected disabled>Select Material Received Note</option>

                                                                        <?php //foreach($material_received as $mat_rec){?>
                                                                            
                                                                            <option value="<?php //echo $mat_rec->mrn_id;?>"><?php //echo $mat_rec->mrn_reffer; ?></option>

                                                                        <?php //} ?>

                                                                        </select>

                                                                    </div>

                                                                   

                                                                </div> 

                                                            </div>--->    

                                                            <!-- ### -->
                                                            
                                                            




                                                        </div>

                                                    </div>


                                                    <div class="col-lg-6">

                                                        <div class="row">


                                                           <!-- Single Row Start -->

                                                           <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        
                                                                        <label for="basicInput" class="form-label">Purchase Order</label>
                                                                        
                                                                    </div>

                                                                    <div class="col-col-md-8 col-lg-8">
                                                                        
                                                                        <select class="form-select select_purchase" name="purchase_order" id=""  required="" aria-required="true">
                                                                            
                                                                            <option value="" selected="" disabled="">Select Purchase Order</option>

                                                                            <?php foreach($material_received as $material_rec){?>
                                                                                
                                                                                <option value="<?php echo $material_rec->po_id;?>"><?php echo $material_rec->po_reffer_no; ?></option>

                                                                            <?php } ?>

                                                                        </select>

                                                                        <!--<input type="text" name="purchase_order" class="form-control select_purchase input_length" required>-->

                                                                    </div>

                                                                    <div class="col-col-md-1 col-lg-1">

                                                                        <span class="add_more_icon cust_more_modal ri-add-box-fill" id="blink"></span>

                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->

                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        
                                                                        <label for="basicInput" class="form-label">Vendor Inv Ref</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        
                                                                        <input type="text" name="purchase_vendor" class="form-control input_length2" value="" required>   

                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 

                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Delivery Note</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="purchase_delivery_note" class="form-control input_length2 delivery_note_clz" value="" required>
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
                                                                        <input type="text " name="purchase_payment_term" class="form-control add_payment_term input_length2" value="" required>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            


                                                            <input type="hidden" class="hidden_purchase_voucher_id" name="purchase_voucher_id">



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
                                                                <td>Debit A/C</td>
                                                                <td>Qty</td>
                                                                <td>Unit</td>
                                                                <td>Rate</td>
                                                                <td>Discount</td>
                                                                <td>Amount</td>
                                                            </tr>
                                                            
                                                        </tbody>

                                                        <tbody  class="travelerinfo product-more2"></tbody>

                                                        <tbody>

                                                            <tr>
                                                                <td colspan="7" class=""></td>
                                                                <td>Total</td>
                                                                <td><input type="text" name="total_vou_amount" class="total_prod_amount form-control" readonly=""></td>
                                                             </tr>
                                                        
                                                        </tbody>
	
                                                        
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



                        <!--view modal section start--->
                        <div class="modal fade" id="ViewModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <form class="Dashboard-form class" id="">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Purchase Voucher</h5>
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
                                                                        <input type="text" name="" id="" class="form-control view_ref" readonly>
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
                                                                        <input type="text" name="" class="form-control view_date" readonly>
                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <!-- ### -->


                                                            <!-- Single Row Start -->

                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Vendor Name</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">

                                                                        <input type="text" name="" class="form-control view_vendor_name" readonly>

                                                                        </select>
                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <!-- ### -->



                                                            <!-- Single Row Start -->


                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Purchase Order</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">

                                                                        <input type="text" name="" class="form-control view_contact_person" readonly>

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
                                                                        <label for="basicInput" class="form-label">Delivery Note</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">

                                                                        <input type="text" name="" class="form-control view_mrn_ref" readonly>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <!-- ### -->



                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">
                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">MR Ref</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">

                                                                        <input type="text" name="" class="form-control view_payment_term" readonly>

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
                                                                        <input type="text" name="" class="form-control view_delivery_date" readonly>
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
                                                        <thead class="travelerinfo contact_tbody">
                                                            <tr>
                                                                <td>Serial No.</td>
                                                                <td>Sales Order</td>
                                                                <td>Product Description</td>
                                                                <td>Unit</td>
                                                                <td>Qty</td>
                                                                <td>Rate</td>



                                                            </tr>


                                                        </thead>

                                                        <tbody class="travelerinfo view_prod_data"></tbody>




                                                    </table>
                                                </div>



                                                <div class="row">
                                                    <div class="col-lg-6">

                                                        <div class="card-body view_image_table" style="float: inline-start;"></div>


                                                    </div>
                                                    <div class="col-lg-6"></div>

                                                </div>

                                                <!--table section end-->

                                            </div>

                                        </div>

                                    </div>
                                </form>

                            </div>
                        </div>

                        


                        <!--view modal section end-->


                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">View Purchase Voucher</h4>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#AddPurchaseVoucher" class="btn btn-primary py-1 add_model_btn">Add</button>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <table id="DataTable" class="table table-bordered table-striped delTable display dataTable">
                                            
                                            <thead>
                                                <tr>
                                                    <th class="no-sort">Sl no</th>
                                                    <th>Reffer Number</th>
                                                    <th>Purchase Order</th>
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



<!--payment modal start-->


<div class="modal fade" id="paymentModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<form  class="Dashboard-form class" id="">
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
                                        <td>Date</td>
                                        <td>Payment Ref</td>
                                        <td>Amount</td>
                                        <td>Adjust</td>
                                        <td>Tick</td>
                                    </tr>
                                                            
                                                           
                                </thead>
                                                        
                                <tbody  class="travelerinfo">
                                    <tr class="" id="">
                                            
                                        <td class="">1</td>
                                        <td><input type="text" name="" value="" class="form-control"  readonly></td>
                                        <td><input type="text" name="" value="" class="form-control" readonly></td>
                                        <td><input type="number" name="" value=""  class="form-control" readonly></td>
                                        <td><input type="number" name="" value=""  class="form-control" readonly></td>
                                        <td><input type="checkbox" name=""  onclick="handleCheckboxChange(this)" class="prod_checkmark"></td>
                                        
                                    </tr>
                                </tbody>


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



<!--payment modal end-->



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
            var form = $('#purchase_form');
            
            form.validate({
                rules: {
                    required: 'required',
                },
                messages: {
                    required: 'This field is required',
                },
                errorPlacement: function(error, element) {} , // To Hide Validation Messages
                submitHandler: function(currentForm) {
                    if($('#purchase_form').attr('data_fill')=="true"){   

                        // Submit the form for the current tab
                        $.ajax({
                            url: "<?php echo base_url(); ?>Procurement/PurchaseVoucher/Add",
                            method: "POST",
                            data: $(currentForm).serialize(),
                            success: function(data) {
                                
                                $('#AddPurchaseVoucher').modal('hide');

                                $('#paymentModal').modal('show');
                            
                                alertify.success('Data Added Successfully').delay(3).dismissOthers();
                            
                                datatable.ajax.reload(null, false);
                            
                                
                            }
                        });

                    }
                    else
                    {
                        alertify.error('Please Select Products').delay(3).dismissOthers();

                        
                        $('#blink').each(function() {
                            var elem = $(this);
                            refreshIntervalId = setInterval(function() {
                                if (elem.css('visibility') == 'hidden') {
                                    elem.css('visibility', 'visible');
                                } else {
                                    elem.css('visibility', 'hidden');
                                }    
                            }, 200);
                        });

                        setTimeout(function(){
                            clearInterval(refreshIntervalId);
                            
                        }, 1000)
                    }
                   
                }
            });
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



        /*material recived not section start*/


        /*$("body").on('change', '.material_received_note', function(){ 
	        
            var date = $(this).val();
 
 
            $.ajax({
 
                url : "<?php echo base_url(); ?>Procurement/PurchaseVoucher/FetchPurchase",
 
                method : "POST",
 
                data: {Date: date},
 
                success:function(data)
                {   
                    var data = JSON.parse(data);
                 
                    $('.time_frame_date').val(data.increment_date_date)
                 
                     
                }
 
 
            });
 
 
        });*/


        /*material receivec not section end*/


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
                'url': "<?php echo base_url(); ?>Procurement/PurchaseVoucher/FetchData",
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
                { data: 'pv_id'},
                { data: 'pv_reffer_id'},
                { data: 'pv_purchase_order'},
                { data: 'pv_date'},
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

            $('#purchase_form')[0].reset();
            $('.add_vendor').val('').trigger('change');
            $('#AddPurchaseOrder').modal('hide');
            $('.add_prod_remove').remove();
            $('.hidden_recived_id').val("");

            $.ajax({

                url : "<?php echo base_url(); ?>Procurement/PurchaseVoucher/FetchReference",

                method : "GET",

                success:function(data)
                {

                    $('#pv_id').val(data);

                }
            });

        });

        /*####*/


        /*customer droup drown search*/
        $(".select_vendor").select2({
            placeholder: "Select Vendor Name",
            theme : "default form-control- customer_width input_length4",
            dropdownParent: $('#AddPurchaseVoucher'),
            ajax: {
                url: "<?= base_url(); ?>Procurement/MaterialReceivedNote/FetchTypes",
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



       




        /*add selected product*/


        $("body").on('click', '.cust_more_modal', function()
        { 
            if(!$("#purchase_form").valid())
            {
                alertify.error('Fill required fields!').delay(3).dismissOthers();
                return false;
            }

            if($('#purchase_form').attr('data-submit')=='false')
            {

             $('#purchase_form').submit();

                if(!$("#purchase_form").valid())
                {
                alertify.error('Fill required fields!').delay(3).dismissOthers();
                return false;
                }

            }

            var formData = new FormData($('#purchase_form')[0]);
            var image = $('.image_file').prop('files')[0]; // Get the file from input field
            formData.append('image', image); // Append the file to FormData object

            $.ajax({
                        url: "<?php echo base_url(); ?>Procurement/PurchaseVoucher/Add",
                        method: "POST",
                        data: formData,
                        processData: false, // Don't process the data
                        contentType: false, // Don't set content type
                        success: function(data) {

                            var data = JSON.parse(data);

                            var purchase_voucher_id = data.purchase_voucher_id;

                            $('.hidden_purchase_voucher_id').val(purchase_voucher_id);

                            var purchase_id = data.purchase_order;

                            console.log(purchase_id);

                            $('#AddPurchaseVoucher').modal('hide');

                            $('#SelectProduct').modal('show');

                           
                            $.ajax({

                                url : "<?php echo base_url(); ?>Procurement/PurchaseVoucher/FetchProduct",

                                method : "POST",

                                data: {ID: purchase_id},
                                
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

                url : "<?php echo base_url(); ?>Procurement/PurchaseVoucher/SelectedProduct",

                method : "POST",

                data: {ID: selectId},

                success:function(data)
                {
                
                    var data = JSON.parse(data);

                    $('.total_prod_amount').val(data.final_amount);

                    $('.product-more2').html(data.product_detail);

                    $('#SelectProduct').modal("hide");

                    $('#AddPurchaseVoucher').modal("show");

                    $('.selected_table').show();
                        
                    checkedIds.length = 0; 

                    $('#purchase_form').attr('data_fill','true');

                }

            });
        });


        /*prod modal submit end*/

        /*calculation section start*/

	    /*$("body").on('keyup', '.add_discount','.add_prod_rate','.add_prod_qty', function(){ 

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

        });*/

        /*####*/



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

            TotalAmount();

        });


        function TotalAmount()
        {

            var total= 0;

            $('body .add_prod_amount').each(function()
            {
                var sub_tot = parseFloat($(this).val());

                total += parseFloat(sub_tot.toFixed(2))||0;
               
            });

           total = total.toFixed(2);

           $('.total_prod_amount').val(total);

          
            

        }
		



        /*calculation section end*/



        /*add current delivery start*/

        $("body").on('keyup', '.add_current_qty', function(){ 


            var dataSelect = $(this);

            var deliverySelectElement = dataSelect.closest('.add_prod_row').find('.add_delivery_qty');

            var delivery = parseFloat(deliverySelectElement.val()) || 0; // Convert to number, default to 0 if NaN

            var currentSelectElement = dataSelect.closest('.add_prod_row').find('.add_current_qty');

            var current = parseFloat(currentSelectElement.val()) || 0; // Convert to number, default to 0 if NaN
            
            var total = delivery + current;

            var orderSelectElement = dataSelect.closest('.add_prod_row').find('.add_order_qty');

            var order = orderSelectElement.val();

            //var order = parseFloat(orderSelectElement.val()) || 0;

            


            if(total > order)
            {   
   
                /*var currencyNull = currentSelectElement.val("");

                console.log(currencyNull);

                var $currencyNullElement = dataSelect.closest('.add_prod_row').find('.add_current_qty');

                $currencyNullElement.val(currencyNull);*/

                /**/

                currentSelectElement.val(""); // Set the value to an empty string
                var currencyNull = currentSelectElement.val(); // Get the current (now empty) value
                
                var $currencyNullElement = dataSelect.closest('.add_prod_row').find('.add_current_qty');
                $currencyNullElement.val(currencyNull); // Set the value of $currencyNullElement to the empty string


                /**/


                alertify.error('Delivery Qty + Current Delivery Should Not Exceed The Order Qty').delay(3).dismissOthers();
                
            }

        });


        /*add current delivery end*/


        /*vendor new modal start*/
        
        $("body").on('click', '.vendor_new_modal', function(){ 
            
            $('#AddPurchaseOrder').modal('hide');

            $('#AddVendor').modal('show');

           
        });

        /*vendor new modal end*/


        //trigger when form is submitted

        $("#add_office_form").submit(function(e){

            $('#AddPurchaseOrder').modal('show');

            return false;

        });

        /*#####*/


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

        
       /*fetch purchase order by vendor name*/

       $("body").on('change', '.vendor_data', function(){ 

            var Id = $('.vendor_data').val();

            $.ajax({

                url : "<?php echo base_url(); ?>Procurement/PurchaseVoucher/ContactPerson",

                method : "POST",

                data: {ID: Id},

                success:function(data)
                {
                
                    var data = JSON.parse(data);

                    $('.add_contact_person').html(data.condact_data);
                  
                }

            });
        });
       
       /*###*/



        /*fetch purchase voucher start*/


        $("body").on('change', '.material_received_note', function(){ 

            var Id = $('.material_received_note').val();
 
            $.ajax({

                url : "<?php echo base_url(); ?>Procurement/PurchaseVoucher/FetchPurchase",

                method : "POST",

                data: {ID: Id},

                success:function(data)
                {
                
                    var data = JSON.parse(data);

                    $('.select_purchase').val(data.purchase_order);

                    $('.delivery_note_clz').val(data.delivery_note);

                    $('.add_payment_term').val(data.payment_term);
                   
                    
                }

            });

        });


       /*########*/


       /*fetch data by purchase order*/

       $("body").on('change', '.select_purchase', function(){ 

            var Id = $('.select_purchase').val();

            $.ajax({

                url : "<?php echo base_url(); ?>Procurement/PurchaseVoucher/FetchPayment",

                method : "POST",

                data: {ID: Id},

                success:function(data)
                {
                
                    var data = JSON.parse(data);

                    $('.add_payment_term').val(data.payment_term);

                    $('.delivery_note_clz').val(data.delivery_date);

                    $('.mr_ref').val(data.mr_reff);

                    
                }

            });
        });


       /*####*/

       



        /*add section end*/


        
        /*view section start*/

       
        $("body").on('click', '.view_btn', function(){ 
            console.log("sucess");
            /*$('#purchase_form')[0].reset();
            $('.add_vendor').val('').trigger('change');
            $('#AddPurchaseOrder').modal('hide');
            $('.add_prod_remove').remove();
            $('.hidden_recived_id').val("");*/

            $('#ViewModal').modal('show');

            $.ajax({

                url : "<?php echo base_url(); ?>Procurement/PurchaseVoucher/View",

                method : "GET",

                success:function(data)
                {

                    //$('#pv_id').val(data);

                }
            });

        });
 

        /*view section end*/






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