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
    .input_length3
    {
        width: 12%;
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
                        <div class="modal fade" id="AddFixedAssetCreation" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="AddAssetCreation" data_fill="false">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Depreciation Calculation</h5>
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
                                                                        <label for="basicInput" class="form-label">Account Head</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <select class="form-select account_head_select account_head_clz" name="cfs_account_head"  required></select>
                                                                        
                                                                    </div>

                                                                </div> 

                                                            </div>


                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->

                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
        
                                                                        <label for="basicInput" class="form-label">Date</label>
    
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="cfs_acquired_date" class="form-control mr_date datepicker" required>
                                                                    </div>


   

                                                                </div> 

                                                            </div>    

                                                            <!-- ### -->


                                                           


                                                            <!-- Single Row Start -->

                                                          
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basiInput" class="form-label">Current Balance</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="" class="form-control  " readonly required>
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
                                                                        
                                                                        <label for="basicInput" class="form-label">Debit Account</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <select class="form-select add_assigned_to debit_account_select" name="cfs_debit_account"  required>
                                                                            <option value="" selected disabled>Debit Account</option>
                                                                            <?php
                                                                                foreach($charts_of_account as $chart_account)
                                                                                {
                                                                            ?>
                                                                                <option value="<?php echo $chart_account->ca_id; ?>"><?php echo $chart_account->ca_name;?></option>
                                                                            <?php         
                                                                                }
                                                                            ?>
                                                                    
                                                                        </select>
                                                                    </div>  

                                                                </div> 

                                                            </div>

                                                            <!-- ### --> 

                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Credit Account</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <select class="form-select add_assigned_to debit_account_select" name="cfs_credit_account"  required>
                                                                            <option value="" selected disabled>Credit Account</option>
                                                                            <?php
                                                                                foreach($charts_of_account as $chart_account)
                                                                                {
                                                                            ?>
                                                                                <option value="<?php echo $chart_account->ca_id; ?>"><?php echo $chart_account->ca_name;?></option>
                                                                            <?php         
                                                                                }
                                                                            ?>
                                                                    
                                                                        </select>
                                                                    </div>  

                                                                </div> 

                                                            </div>    
                                                            <!-- ### --> 

                                                            
                                                            
                                                            
                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Depreciation</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="cfs_depreciation" class="form-control add_payment_term" value="" required>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 





                                                        </div>

                                                    </div>
                                                   


                                                </div>


                                                


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
                                        <h4 class="card-title mb-0 flex-grow-1">View Fixed Asset Creation</h4>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#AddFixedAssetCreation" class="btn btn-primary py-1 add_model_btn">Add</button>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <table id="DataTable" class="table table-bordered table-striped delTable display dataTable">
                                            
                                            <thead>
                                                <tr>
                                                    <th class="no-sort">Sl no</th>
                                                    <th>Description</th>
                                                    <th>Debit Account</th>
                                                    <th>Credit Account</th>
                                                    <th>Acquired Date</th>
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
                                        <td>Invoice Ref</td>
                                        <td>Amount</td>
                                        <td>Adjustment</td>
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




<!---view modal start--->

<div class="modal fade" id="ViewModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
        <form  class="Dashboard-form class" id="">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Purchase Return</h5>
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
                                                <label for="basicInput" class="form-label">Vendor Inv Ref</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                
                                                <input type="text" name="" class="form-control view_vendor_inv_ref" readonly>
                                                
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
                                                <label for="basicInput" class="form-label">Lpo Ref</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                
                                                <input type="text" name="" class="form-control view_lpo_ref" readonly>
                                            
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
                                                
                                                <input type="text" name="" class="form-control view_contact_person" readonly>
                                                
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
                                                <input type="text" name="" class="form-control view_payment_term" readonly>
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
                                        <td>Credit A/C</td>
                                        <td>Qty</td>
                                        <td>Unit</td>
                                        <td>Rate</td>
                                        <td>Discount</td>
                                        <td>Amount</td>
                                       
                                    </tr>
                                    
                                    
                                </thead>
                                
                                <tbody  class="travelerinfo view_prod_data"></tbody>

                                <tbody>
                                    <tr>
                                        
                                        <td colspan="6" class=""></td>
                                        <td>Total</td>
                                        <td><input type="text" name="" class="view_total_prod form-control" readonly=""></td>
                                    </tr>

                                </tbody>

                                
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

<!--view modal end-->


<script>

    document.addEventListener("DOMContentLoaded", function(event) { 
    
        /*add section start*/  
 
        /*add form*/
        $(function() {
            var form = $('#AddAssetCreation');
            
            form.validate({
                rules: {
                    required: 'required',
                },
                messages: {
                    required: 'This field is required',
                },
                errorPlacement: function(error, element) {} , // To Hide Validation Messages
                submitHandler: function(currentForm) {
                     
                        var formData = new FormData(currentForm);

                        // Submit the form for the current tab
                        $.ajax({
                            url: "<?php echo base_url(); ?>Procurement/FixedAssetCreation/Add",
                            method: "POST",
                            data: formData,
                            processData: false, // Don't process the data
                            contentType: false, // Don't set content type
                            //data: $(currentForm).serialize(),
                            success: function(data) {
                               
                                $('#AddFixedAssetCreation').modal('hide');

                                alertify.success('Data Added Successfully').delay(3).dismissOthers();
                            
                                datatable.ajax.reload(null, false);

                            }
                        });

                    
                }
            });
        });


        /*#####*/

        

       
       /* account head  search droup drown start*/
        
       $(".account_head_select").select2({
            placeholder: "Select Account Name",
            theme : "default form-control-",
            dropdownParent: $('#AddFixedAssetCreation'),
            ajax: {
                url: "<?= base_url(); ?>Procurement/DepreciationCalculation/FetchTypes",
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
                        results: $.map(data.result, function (item) { return {id: item.ah_id, text: item.ah_account_name}}),
                        pagination: {
                        // THE `10` SHOULD BE SAME AS `$resultCount FROM PHP, it is the number of records to fetch from table` 
                            more: (page * 10) <= data.total_count
                        }
                    };
                },              
            }
        })

        /*###*/
        $(".debit_account_select").select2({
            placeholder: "Select Account Name",
            theme: "default form-control-",
            dropdownParent: $('#AddFixedAssetCreation'),
            ajax: {
                url: "<?= base_url(); ?>Procurement/DepreciationCalculation/FetchDebitAcc",
                dataType: 'json',
                delay: 250,
                cache: false,
                minimumInputLength: 1,
                allowClear: true,
                data: function(params) {
                    return {
                        term: params.term,
                        page: params.page || 1,
                    };
                },
                processResults: function(data, params) {

                    var page = params.page || 1;
                    return {
                        results: $.map(data.result, function(item) {
                            return {
                                id: item.ca_id,
                                text: item.ca_name
                            }
                        }),
                        pagination: {
                            // THE `10` SHOULD BE SAME AS `$resultCount FROM PHP, it is the number of records to fetch from table` 
                            more: (page * 10) <= data.total_count
                        }
                    };
                },
            }
        })




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

         
        //  $("body").on('change', '.mr_date', function(){ 
	        
        //     var date = $(this).val();
 
            
 
        //     $.ajax({
 
        //         url : "<?php echo base_url(); ?>Procurement/MaterialRequisition/Date",
 
        //         method : "POST",
 
        //         data: {Date: date},
 
        //         success:function(data)
        //         {   
        //             var data = JSON.parse(data);
                 
        //             $('.time_frame_date').val(data.increment_date_date)
                 
                     
        //         }
 
 
        //     });
 
 
        // });
 
      
 
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
                'url': "<?php echo base_url(); ?>Procurement/FixedAssetCreation/FetchData",
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
                { data: 'cfs_id'},
                { data: 'cfs_description'},
                { data: 'cfs_account_head'},
                { data: 'cfs_account_id'},
                { data: 'cfs_acquired_date'},
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

                url : "<?php echo base_url(); ?>Procurement/PurchaseReturn/FetchReference",

                method : "GET",

                success:function(data)
                {

                    $('#pr_id').val(data);

                }
            });

        });

        /*####*/


        /*customer droup drown search*/
        $(".select_vendor").select2({
            placeholder: "Select Vendor Name",
            theme : "default form-control- customer_width input_length3",
            dropdownParent: $('#AddPurchaseReturn'),
            ajax: {
                url: "<?= base_url(); ?>Procurement/PurchaseReturn/FetchTypes",
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


        /*$("body").on('click', '.cust_more_modal', function()
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
            formData.append('pr_file', image); // Append the file to FormData object

           

            $.ajax({
                        url: "<?php echo base_url(); ?>Procurement/PurchaseReturn/Add",
                        method: "POST",
                        data: formData,
                        processData: false, // Don't process the data
                        contentType: false, // Don't set content type
                        success: function(data) {

                            var data = JSON.parse(data);

                            var purchase_voucher_id = data.purchase_voucher_id;

                            $('.hidden_purchase_voucher_id').val(purchase_voucher_id);

                            var purchase_id = data.purchase_order;

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

        });*/


        /*#######*/


        /*prod modal submit start*/

        $("body").on('click', '.prod_modal_submit', function(){ 

            var selectId = $('#select_prod_id').val();

            $.ajax({

                url : "<?php echo base_url(); ?>Procurement/PurchaseReturn/SelectedProduct",

                method : "POST",

                data: {ID: selectId},

                success:function(data)
                {
                
                    var data = JSON.parse(data);

                    $('.product-more2').html(data.product_detail);

                    $('#SelectProduct').modal("hide");

                    $('#AddPurchaseReturn').modal("show");

                    $('.selected_table').show();
                        
                    checkedIds.length = 0; 

                    $('#purchase_form').attr('data_fill','true');

                }

            });
        });


        /*prod modal submit end*/

        /*calculation section start*/

	    $("body").on('keyup', '.add_discount', function(){ 

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

                url : "<?php echo base_url(); ?>Procurement/PurchaseReturn/VendorInv",

                method : "POST",

                data: {ID: Id},

                success:function(data)
                {
                
                    var data = JSON.parse(data);

                    console.log(data.vendor_inv)

                    $('.vendor_inv_ref').html(data.vendor_inv);
                  
                }

            });
        });
       
       /*###*/



        /*fetch data by vendor inv */

       $("body").on('change', '.vendor_inv_ref', function(){ 

            var id = $('.vendor_inv_ref').val();

           

            $.ajax({

                url : "<?php echo base_url(); ?>Procurement/PurchaseReturn/FetchContact",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {
                
                    var data = JSON.parse(data);

                    $('.add_contact_person').val(data.contact_person);

                    $('.add_payment_term').val(data.payment_term);
                  
                }

            });
        });
       
       /*###*/



        /*add product start*/

        $("body").on('click', '.add_more_icon', function()
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
                        url: "<?php echo base_url(); ?>Procurement/PurchaseReturn/Add",
                        method: "POST",
                        data: formData,
                        processData: false, // Don't process the data
                        contentType: false, // Don't set content type
                        success: function(data) {

                            var data = JSON.parse(data);

                            var purchase_return_id = data.purchase_return_id;

                            $('.hidden_purchase_return_id').val(purchase_return_id);

                            var vendor_inv_ref = data.vendor_inv_ref;

                            $('#AddPurchaseReturn').modal('hide');

                            $('#SelectProduct').modal('show');

                           
                            $.ajax({

                                url : "<?php echo base_url(); ?>Procurement/PurchaseReturn/FetchProduct",

                                method : "POST",

                                data: {ID: vendor_inv_ref},
                                
                                success:function(data)
                                {   
                                    var data = JSON.parse(data);

                                    $(".select_prod_add").html(data.product_detail);
                         
                                }  

                            });
 
                            
                        }

                    });

        });


       /*#####*/




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

                    $('.mr_ref').val(data.mr_reff);

                    
                }

            });
        });


       /*####*/

       



        /*add section end*/



        
        /*view section start*/

        $("body").on('click', '.view_btn', function(){ 

            var id = $(this).data('id');

            $.ajax({

                url : "<?php echo base_url(); ?>Procurement/PurchaseReturn/View",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {
                
                    var data = JSON.parse(data);
                                    
                    $('.view_ref').val(data.reffer_id);

                    $('.view_date').val(data.date);

                    $('.view_vendor_name').val(data.vendor_name);

                    $('.view_vendor_inv_ref').val(data.vendor_inv);

                    $('.view_lpo_ref').val(data.lpo);

                    $('.view_contact_person').val(data.contact_person);

                    $('.view_payment_term').val(data.payment_term);

                    $('.view_prod_data').html(data.purchase_return);

                    $('#ViewModal').modal("show");
                    
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