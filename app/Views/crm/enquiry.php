<div class="tab-content text-muted">
								
    <div class="tab-pane active" id="nav-crm-top-1-1" role="tabpanel">
                    
        <div class="row">
            
            <div class="col-lg-12">
                
                <!-- Tab panes -->
                <div class="tab-content text-muted">
                    <!--product head tab--> 
                    <div class="tab-pane active" id="arrow-1" role="tabpanel">
                        
                        <!--add enquiry modal start-->
                        <div class="modal fade" id="Enquiry" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="add_form1">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Enquiry</h5>
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
                                                                        <input type="text" name="" class="form-control" required>
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
                                                                        <input type="date" name="enquiry_date" class="form-control" required>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 

                                                            <!-- Single Row Start -->
                                                            
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Customer</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <select class="form-select ser_customer" name="enquiry_customer" id="customer_id" required>
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
                                                                        <select class="form-select" name="enquiry_contact_person" id="contact_person_id" required>
                                                                            <option value="" selected disabled>Contact Person</option>
                                                                
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
                                                                        <label for="basicInput" class="form-label">Assigned To</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                    <select class="form-select" name="enquiry_employees" required>
                                                                        <option value="" selected disabled>Assigned To</option>
                                                                        <?php foreach($employees as $employ){?> 
                                                                            <option value="<?php echo $employ->employees_id;?>"><?php echo $employ->employees_name;?></option>
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
                                                                        <label for="basicInput" class="form-label">Source</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="" class="form-control" required>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 

                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Time Frame</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="date" name="" class="form-control" required>
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
                                                                        <input type="date" name="enquiry_project" class="form-control" required>
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
                                                                <td>Product Description</td>
                                                                <td>Unit</td>
                                                                <td>Quantity</td>
                                                                <td>Action</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 10%;"><input type="number" value="1" name="pd_serial_no[]" class="form-control" required readonly></td>
                                                                <td>
                                                                    <select class="form-select ser_product_det" name="pd_product_detail[]" required>
                                                                        <option selected>Select Product Description</option>
                                                                        <?php foreach($products as $prod){?>
                                                                            <option value="<?php echo $prod->product_id;?>"><?php echo $prod->product_details;?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
                                                                <td><input type="text" name="pd_unit[]" class="form-control" required></td>
                                                                <td><input type="number" name="pd_quantity[]" class="form-control" required></td>
                                                                <td><div class="tecs"><span id="add_product" class="add_icon"><i class="ri-add-circle-line"></i>Add </span></div></td>
                                                            </tr>
                                                        </tbody>
                                                        <tbody id="product-more" class="travelerinfo"></tbody>
                                                    </table>
                                                </div>


                                                <div style="float: right;">
                                                    <table class="table table-bordered table-striped enq_tab_submit">
                                                        <tr>
                                                            <td><button>Print</button></td>
                                                            <td><button>Email</button></td>
                                                        </tr>
                                                        <tr>
                                                            <td><button>Save</button></td>
                                                            <td><button>PDF</button></td>
                                                        </tr>
                                                    </table>
                                                </div>

                                                <!--table section end-->


                                            </div>  
                                            
                                            
                                             


					                           
						                    
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
                                        <h4 class="card-title mb-0 flex-grow-1">View Enquiry</h4>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#Enquiry" class="btn btn-primary py-1">Add</button>
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




<!--Edit modal section start-->

<div class="modal fade" id="EditModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <label for="basiInput" class="form-label">Date</label>
                                    <input type="date" name=""  class="form-control edit_enquiry_date" readonly>
                                </div>

                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Customer</label>
                                    <select class="form-control edit_enquiry_customer edit_ser_customer"></select>
                                </div>

                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Contact Person</label>
                                    <select class="form-select edit_enquiry_contact"></select>
                                  
                                </div>

                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Sales Executive</label>
                                    <select class="form-select edit_enquiry_sales"></select>
                                </div>

                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Validity</label>
                                    <input type="text" name="" class="form-control edit_enquiry_validity" readonly>
                                </div>

                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Project</label>
                                    <input type="text" name=""  class="form-control edit_enquiry_project" readonly>
                                </div>

                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Enquiry Reference</label>
                                    <input type="text" name=""  class="form-control edit_enquiry_reffe" readonly>
                                </div>

                                <div class="col-md-2 col-lg-2">
                                    <label for="basicInput" class="form-label">Assigned To</label>
                                    <select class="form-select edit_enquiry_employ"></select>
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

<!--Edit modal section end-->




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
                errorPlacement: function(error, element) {} , // To Hide Validation Messages
                submitHandler: function(currentForm) {
                    // Submit the form for the current tab
                    $.ajax({
                        url: "<?php echo base_url(); ?>Crm/Enquiry/Add",
                        method: "POST",
                        data: $(currentForm).serialize(),
                        success: function(data) {
                            var responseData = JSON.parse(data);
                            
                            $(".enquiry_id").val(responseData.enquiry_id);
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


        /* Select 2 Remove Validation On Change */
        $("select[name=enquiry_customer]").on("change",function(e) {
            $(this).parent().find(".error").removeClass("error");         
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
                errorPlacement: function(error, element) {} , // To Hide Validation Messages
                submitHandler: function(currentForm) {
                    // Submit the form for the current tab
                    $.ajax({
                        url: "<?php echo base_url(); ?>Crm/Enquiry/AddTab2",
                        method: "POST",
                        data: $(currentForm).serialize(),
                        success: function(data) {
                            $('#add_form1')[0].reset();
                            $('#add_form2')[0].reset();
                          
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
                'url': "<?php echo base_url(); ?>Crm/Enquiry/FetchData",
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
                { data: 'enquiry_id' },
                { data: 'enquiry_enq_number' },
                { data: 'enquiry_date'},
                { data: 'enquiry_customer'},
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

                url : "<?php echo base_url(); ?>Crm/Enquiry/ContactPerson",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {   
                    var data = JSON.parse(data);
                
                    $("#contact_person_id").html(data.customer_name);


                /*Apply Select 2 to  Added Product Drop Down*/
                $(".ser_product_det:last").select2({
                    placeholder: "Select Product",
                    theme : "default form-control-",
                    dropdownParent: $('#AddModal'),
                    ajax: {
                        url: "<?= base_url(); ?>Crm/Enquiry/FetchProdDes",
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
                /*###*/
                            
                    
                }


            });
        });


       

        var max_fieldspp  = 30;
        var pp = 1;
        $("#add_product").click(function(){

			if(pp < max_fieldspp){ 
			    pp++;
	            $("#product-more").append("<tr><td><input type='number' value="+pp+" name='pd_serial_no[]' class='form-control ' required='' readonly></td><td><select class='form-select ser_product_det' name='pd_product_detail[]' required=''><option value='' selected disabled>Select Product Description</option><?php foreach($products as $prod){?><option value='<?php echo $prod->product_id;?>'><?php echo $prod->product_details;?></option><?php } ?></select></td><td><input type='text' name='pd_unit[]' class='form-control ' required=''></td><td><input type='number' name='pd_quantity[]' class='form-control ' required=''></td><td class='remove-btnpp' colspan='6'><div class='remainpass'><i class='ri-close-line'></i>Remove</div></td></tr>");
                 /*customer droup drown search*/
                 InitSelect2();
			}
	    });

        $(document).on("click", ".remove-btnpp", function() 
        {
	        $(this).parent().remove();
	        pp--;
        });



        /*customer droup drown search*/
        $(".ser_customer").select2({
            placeholder: "Select Customer",
            theme : "default form-control-",
            dropdownParent: $('#AddModal'),
            ajax: {
                url: "<?= base_url(); ?>Crm/Enquiry/FetchCustomer",
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




        /*Edit customer droup drown search*/

        $(".edit_ser_customer").select2({
            placeholder: "Select Customer",
            theme : "default form-control-",
            dropdownParent: $('#EditModal'),
            ajax: {
                url: "<?= base_url(); ?>Crm/Enquiry/EditFetchCustomer",
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




          /*Product Drop Down*/
          function InitSelect2(){
          $(".ser_product_det:last").select2({
            placeholder: "Select Product",
            theme : "default form-control-",
            dropdownParent: $('#AddModal'),
            ajax: {
                url: "<?= base_url(); ?>Crm/Enquiry/FetchProdDes",
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


     

    });



</script>