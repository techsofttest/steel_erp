<style>
.cust_more_modal {
    position: absolute;
    left: 470px;
    padding: 1px 27px;
    z-index: 999;
    border: 1px solid black;
    border: 1px solid #0000003b;
}
.left_input .row
{
    justify-content: unset;
   
}
.row_align
{
    display: flex;
    align-items: center;
    justify-content: unset !important;
}


</style>


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
                        
                        <!--deliver note  modal content start-->


                        <div class="modal fade" id="DeliverNote" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="add_form1">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Deliver Note</h5>
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
                                                                        <input type="text" name="dn_reffer_no" id="" value="<?php echo $delivery_note_id; ?>" class="form-control" required readonly>
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
                                                                        <input type="date" name="dn_date" class="form-control" required>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->

                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Customer Name</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        

                                                                    <select class="form-select customer_sel customer_id" name="dn_customer"  required>
                                                               
                                                                    </select>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 

                                                            

                                                            <!-- Single Row Start -->
                                                            
                                                            
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Sales Order <span class="add_more_icon cust_more_modal">Select</span></label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                      
                                                                        <select class="form-select sales_order_add_clz" name="dn_sales_order_num" id="sales_order_add" style="width:80%;" required>

                                                                            <option value="" selected disabled>Select Sales Order</option>

                                                                        </select>
                                                                        
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
                                                                        <label for="basicInput" class="form-label">LPO Ref</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        
                                                                        <input type="text" name="dn_lpo_reference" class="form-control lpo_ref" required>
                                                                    
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
                                                                        
                                                                       <select class="form-select cont_person" name="dn_conact_person" id="" required></select>
                                                                       
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### -->

                                                            


                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Payment Terms</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="dn_payment_terms" class="form-control payment_term_clz" required>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                         

                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Project</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="dn_project"  class="form-control project_clz" required>
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
                                                                <td>Product Description</td>
                                                                <td>Unit</td>
                                                                <td>Order Qty</td>
                                                                <td>Delivered Qty</td>
                                                                <td>Current Delivery</td>
                                                                <td>Action</td>
                                                            </tr>
                                                            
                                                           
                                                        </thead>
                                                        
                                                        <tbody  class="travelerinfo product-more2"></tbody>
                                                        <!--<tbody>
                                                            <tr>
                                                                <td colspan="8" align="center" class="tecs">
                                                                    <span class="add_icon add_product2"><i class="ri-add-circle-line"></i>Add </span>
                                                                </td>
                                                            </tr>
                                                        </tbody>-->
                                                       
                                                    </table>
                                                </div>



                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        
                                                        <div class="row row_align mb-4">
                                                            <div class="col-lg-2">
                                                                <label for="basicInput" class="form-label">Attach</label>
                                                            </div>

                                                            <div class="col-lg-4">
                                                                <input type="file" name=""  class="form-control" required>
                                                            </div>

                                                        </div>

                                                        
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div style="float: right;">
                                                            <table class="table table-bordered table-striped enq_tab_submit menu">
                                                                <tr>
                                                                    <td><button>Print</button></td>
                                                                    <td><button>Email</button></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><button type="submit">Save</button></td>
                                                                    <td><button>PDF</button></td>
                                                                </tr>
                                                            </table>
                                                        </div>

                                                    </div>
                                                </div>

                                                <!--table section end-->


                                            </div>  
                                            
                                            
                                             


					                           
						                    
				                        </div>


                                        
			                        </div>
		                        </form>

	                        </div>
                        </div>

                        
                        

                        <!--deliver note modal content end-->



                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">Delivery Note</h4>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#DeliverNote" class="btn btn-primary py-1">Add</button>
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

<!--select modal section start-->


<div class="modal fade" id="SelectModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<form  class="Dashboard-form class" id="add_form1">
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
                                                        
                                <tbody  class="travelerinfo">
                                    
                                    <tr>
                                        <td class="si_no">1</td>
                                        <td><input type="text" name="dpd_unit[]"  class="form-control" required></td>
                                        <td><input type="text" name="dpd_unit[]"  class="form-control" required></td>
                                        <td><input type="text" name="dpd_unit[]"  class="form-control" required></td>
                                        <td><input type="checkbox" name="dpd_unit[]"  class="form-control" required></td>
                                      
                                    </tr>

                                </tbody>

                                

                            </table>
                            
                        </div>


                    </div>  
                                            
                                            
                </div>


                                        
			</div>
		</form>

	</div>

</div>



<!--select  modal section end-->




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
                          
                            $('#add_form1')[0].reset();

                            $('.delivery_note_remove').remove();

                            $('.sales_order_add_clz').val('').trigger('change');

                            $('.cont_person').val('').trigger('change');

                            $('.customer_id').val('').trigger('change');
                           
                            $('#DeliverNote').modal('hide');
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


        $("body").on('change', '.customer_id', function(){ 

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

                    $(".cont_person").html(data.contact_person);
                    
                    
                }


            });



        });



        /**/
        $("body").on('change', '.sales_order_add_clz', function(){ 

            $('.delivery_note_remove').remove();

            var id = $(this).val();

            var cust_id = $('.customer_id').val();

           
            //Fetch Contact Person
            $.ajax({

                url : "<?php echo base_url(); ?>Crm/DeliverNote/FetchSalesData",

                method : "POST",

                data: {ID: id,
                       custID : cust_id,
                },
                

                success:function(data)
                {   
                    var data = JSON.parse(data);
                     
                    $(".lpo_ref").val(data.so_lpo);

                    $(".cont_person").html(data.contact_person);

                    $(".project_clz").val(data.so_project);

                    $(".payment_term_clz").val(data.so_payment_term);

                    $(".product-more2").append(data.product_detail);

                    slno();
                  
                }


            });

        });
        /**/



        /*delete*/ 
        $("body").on('click', '.delete_btn', function(){ 
            
            if (!confirm('Are you absolutely sure you want to delete?')) return false;
            var id = $(this).data('id');
            $.ajax({

                url : "<?php echo base_url(); ?>Crm/DeliverNote/Delete",

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


         /*select modal section start*/ 
         $("body").on('click', '.cust_more_modal', function(){ 
            
           $('#SelectModal').modal('show');

           $('#DeliverNote').modal('hide');

        });
        /*###*/


       

        /*customer droup drown search*/
        $(".customer_sel").select2({
            placeholder: "Select Customer",
            theme : "default form-control-",
            dropdownParent: $('#DeliverNote'),
            ajax: {
                url: "<?= base_url(); ?>Crm/DeliverNote/FetchCustomers",
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



     

        /*product section start*/

        var max_fieldspp      = 30;

        var pp = 1;

        $("body").on('click', '.add_product2', function(){
          
            var pp = $('.prod_row').length
        
            if(pp < max_fieldspp){ 
            
                pp++;
                
                $(".product-more2").append("<tr class='prod_row'><td class='si_no'>"+pp+"</td><td style='width:20%'><select class='form-select add_prod' name='dpd_prod_det[]' required=''><option value='' selected disabled>Select Product Description</option><?php foreach($products as $prod){?><option value='<?php echo $prod->product_id;?>'><?php echo $prod->product_details;?></option><?php } ?></select></td><td><input type='text' name='dpd_unit[]' class='form-control ' required=''></td><td><input type='number' name='dpd_order_qty[]' class='form-control order_qty' required=''></td><td><input type='number' name='dpd_delivery_qty[]' class='form-control delivery_qty' required=''></td><td><input type='number' name='dpd_current_qty[]' class='form-control current_delivery' required=''></td><td class='remove-btnpp' colspan='6'><div class='remainpass'><i class='ri-close-line'></i>Remove</div></td></tr>");

            }

            slno();

            InitProductSelect2();

        });

        $(document).on("click", ".remove-btnpp", function() 
        {

            $(this).parent().remove();
            slno();
        });

        /**/


        /*serial no correction section start*/

        function slno(){

            var pp =1;

            $('body .prod_row').each(function() {

                $(this).find('.si_no').html('<td class="si_no">' + pp + '</td>');

                pp++;
            });

        }

        /*###*/



        /*product detail calculation*/


        /*limit quantity start*/


        $("body").on('keyup', '.delivery_qty , .current_delivery', function(){ 

            var dataSelect = $(this);

            var deliverySelectElement = dataSelect.closest('.prod_row').find('.delivery_qty');
            
            var delivery = parseFloat(deliverySelectElement.val()) || 0; // Convert to number, default to 0 if NaN

            var currentSelectElement = dataSelect.closest('.prod_row').find('.current_delivery');

            var current = parseFloat(currentSelectElement.val()) || 0; // Convert to number, default to 0 if NaN

            var total = delivery + current;

            var orderSelectElement = dataSelect.closest('.prod_row').find('.order_qty');

            var order = orderSelectElement.val();
           

            if(total > order)
            {   
                /*var deliveryNull = deliverySelectElement.val("");

                var $deliveryNullElement = dataSelect.closest('.prod_row').find('.delivery_qty');

                $deliveryNullElement.val(deliveryNull);*/   
                
                
                var currencyNull = currentSelectElement.val("");

                var $currencyNullElement = dataSelect.closest('.prod_row').find('.current_delivery');

                $currencyNullElement.val(currencyNull);  

                alertify.error('Delivery Qty + Current Delivery Should Not Exceed The Order Qty').delay(3).dismissOthers();
                
                

            }

           

        });


        /*limit quantity end*/



        /* Product Init Select 2 */


        function InitProductSelect2(){

            $(".add_prod:last").select2({
                placeholder: "Select Product",
                theme : "default form-control-",
                dropdownParent: $($('.add_prod:last').closest('.prod_row')),
                ajax: {
                    url: "<?= base_url(); ?>Crm/DeliverNote/FetchProducts",
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

        InitProductSelect2();


        /* ### */

      


    });



</script>