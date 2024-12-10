<div class="tab-content text-muted">
								
    <div class="tab-pane active" id="nav-crm-top-1-1" role="tabpanel">
                    
        <div class="row">
            
            <div class="col-lg-12">
               
                <!-- Tab panes -->
                <div class="tab-content text-muted">
                    <!--product head tab--> 
                    <div class="tab-pane active" id="arrow-1" role="tabpanel">



                        <!--add product  modal content start-->
                        
                        <?= $this->include('crm/add_product_modal') ?>

                        <!--add product modal content end-->
                        

                        <!--view section start-->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">View Products</h4>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#AddProdModal" class="btn btn-primary py-1 add_model_btn">Add</button>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <table id="DataTable" class="table table-bordered table-striped delTable display dataTable">
                                            <thead>
                                                <tr>
                                                    <th class="no-sort">Sl no</th>
                                                    <th>Code</th>
                                                    <th>Product Name</th>
                                                    <th>Product Head</th>
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
                        
                        <!--view section end-->

                    </div>
                    <!--###-->


                    

                    
                </div>
                    
                    
                    
            </div>
                    
        </div>
                    
                    
    </div>
                    
    
                        
</div>


<!--Edit Modal section start-->
<div class="modal fade" id="EditProdModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form  class="Dashboard-form class" id="update_prod_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
        
                                <div class="card-body">
                                                            
                                    <div class="live-preview">
                                                                    
                                        <!-- Single Row Start -->

                                        <div class="row align-items-center mb-2">

                                            <div class="col-col-md-3 col-lg-3">

                                                <label for="basiInput" class="form-label">Product Name</label>

                                            </div>

                                            <div class="col-col-md-9 col-lg-9">

                                                <input type="text"   name="product_details" class="form-control edit_product_name" required>

                                            </div>

                                        </div>

                                        <!-- ### -->


                                        <!-- Single Row Start -->

                                        <div class="row align-items-center mb-2">

                                            <div class="col-col-md-3 col-lg-3">

                                                <label for="basiInput" class="form-label">Product Head</label>

                                            </div>

                                            <div class="col-col-md-9 col-lg-9">

                                                <select class="form-select edit_product_head_select product_head edit_product_head"  name="product_product_head" required></select>

                                            </div>

                                        </div>

                                        <!-- ### -->


                                        <!-- Single Row Start -->

                                        <div class="row align-items-center mb-2">

                                            <div class="col-col-md-3 col-lg-3">

                                                <label for="basiInput" class="form-label">Code</label>

                                            </div>

                                            <div class="col-col-md-9 col-lg-9">

                                                <input type="text"   name="product_code"  class="form-control edit_produt_code" required readonly>

                                            </div>

                                            <input type="hidden" name="product_id" class="prod_id">

                                        </div>

                                        <!-- ### -->
                                                             
                                    </div>
                
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button  class="btn btn btn-success">Save</button>
                </div>
            </div>
        </form>

    </div>
</div>


<!--Edit modal section end-->


<script>

    document.addEventListener("DOMContentLoaded", function(event) { 
    
        
        /*edit*/ 
        $("body").on('click', '.edit_btn', function(){ 
            var id = $(this).data('id');
            
            $.ajax({

                url : "<?php echo base_url(); ?>Crm/Products/Edit",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {   
                    var data = JSON.parse(data);

                    console.log(data.product_details);

                    $(".edit_produt_code").val(data.product_code);

                    $(".edit_product_name").val(data.product_name);

                    $(".edit_product_head").html(data.prod_head_out);

                    $('#EditProdModal').modal('show');
                    
                    $(".prod_id").val(id);
                    
                }


            });
            
            
        });
        /*####*/




        /*update*/
        
        $(function() {
            $('#update_prod_form').validate({
                rules: {
                    required: 'required',
                    
                },
                messages: {
                    required: 'This field is required',
                    
                },
                errorPlacement: function(error, element) {} ,
                submitHandler: function(form) {
                    $.ajax({
                        url: "<?php echo base_url(); ?>Crm/Products/Update",
                        method: "POST",
                        data: $(form).serialize(),
                        success: function(data) {
                            var data = JSON.parse(data);
                            if(data.status === "true")
                            {
                                alertify.success('Duplicate Product Name').delay(2).dismissOthers();
                                $('#EditProdModal').modal('hide');
                                datatable.ajax.reload(null,false);
                            }
                            else
                            {
                                alertify.error('Duplicate Product Name').delay(3).dismissOthers();
                                
                               
                            }
                            
                        }
                    });
                    return false; // prevent the form from submitting
                }
            });
        });


        /*###*/


        /*fetch code section start*/


        $("body").on('change', '.edit_product_head', function(){ 

            var id = $(this).val();

            var prod_id = $('.prod_id').val();
 

            console.log(prod_id);

            $.ajax({

                url : "<?php echo base_url(); ?>Crm/Products/EditCode",

                method : "POST",

                data: {ID: id,
                       ProdID: prod_id,
                       
                },

                success:function(data)
                {   
                    var data = JSON.parse(data);

                    //$(".product_code").val(data.product_head_code);

                   $(".edit_produt_code").val(data.product_head_code);
                
                    
                }


            });

        });


        /*#####*/

        


        


        /*delete*/ 
        $("body").on('click', '.delete_btn', function(){ 
            
            if (!confirm('Are you absolutely sure you want to delete?')) return false;
            var id = $(this).data('id');
            $.ajax({

                url : "<?php echo base_url(); ?>Crm/Products/Delete",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {   
                    var data = JSON.parse(data);
                      
                    if(data.status === "true"){
                        
                        alertify.error('Data Deleted Successfully').delay(2).dismissOthers();

                        datatable.ajax.reload(null,false);

                    }else{

                        alertify.error('Data In Use. Can\'t Be Delete').delay(2).dismissOthers();
                    } 
                    
                }


            });

        });
        /*###*/





        /*data table start*/ 

        function initializeDataTable() {

            datatable = $('#DataTable').DataTable({
            'stateSave': true,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': 
            {
                'url': "<?php echo base_url(); ?>Crm/Products/FetchData",
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
                { data: 'product_id' },
                { data: 'product_code' },
                { data: 'product_details'},
                { data: 'product_product_head'},
                { data: 'action'},
                
               ]
    
            });
        }

        $(document).ready(function () {
            initializeDataTable();
        });
        /*###*/


        


         /*droupdrown*/
        $(".edit_product_head_select").select2({
        placeholder: "Select Product Head",
        theme : "default form-control-",
        dropdownParent: $('#EditProdModal'),
        ajax: {
                url: "<?= base_url(); ?>Crm/Products/FetchTypes",
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
                        results: $.map(data.result, function (item) { return {id: item.ph_id, text: item.ph_product_head}}),
                        pagination: {
                        // THE `10` SHOULD BE SAME AS `$resultCount FROM PHP, it is the number of records to fetch from table` 
                            more: (page * 10) <= data.total_count
                        }
                    };
                },              
            }
        })
        /*###*/


        /*modal close trigger*/

        $('#AddProdModal').on('hidden.bs.modal', function () {
            
            $(this).find('form').trigger('reset');

            //$('.product_head').val('').trigger('change');

        })
        
        /*####*/



    });

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
            if(!isSelect2Request)
            {   
                alertify.error('Something went wrong. Please try again later').delay(3).dismissOthers();
            }
        });


    });





</script>