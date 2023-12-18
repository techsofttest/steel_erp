<div class="tab-content text-muted">
								
    <div class="tab-pane active" id="nav-crm-top-1-1" role="tabpanel">
                    
        <div class="row">
            
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
        
                        <!-- Start Subtabs -->
                        <ul class="nav nav-pills arrow-navtabs nav-success bg-light mb-3" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link "  href="<?= base_url(); ?>Crm/ProductHead" role="tab">
                                    <span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
                                    <span class="d-none d-sm-block">Product Head</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active"  href="<?= base_url(); ?>Crm/Products" role="tab">
                                    <span class="d-block d-sm-none"><i class="mdi mdi-account"></i></span>
                                    <span class="d-none d-sm-block">Product</span>
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
                            <div class="modal-dialog modal-lg">
                                <form  class="Dashboard-form class" id="add_form">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="card">
        
                                                        <div class="card-body">
                                                            <div class="live-preview">
                                                                <div class="row align-items-end">
                                                                    <div class="col-col-md-4 col-lg-4">
                                                                        <div>
                                                                            <label for="basiInput" class="form-label">Code</label>
                                                                            <input type="text"   name="product_code" class="form-control" required>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-col-md-4 col-lg-4">
                                                                        <div>
                                                                            <label for="basiInput" class="form-label">Product Detail</label>
                                                                            <input type="text"   name="product_details" class="form-control" required>
                                                                        </div>
                                                                    </div>

                                                                    

                                                                    <div class="col-col-md-4 col-lg-4">
                                                                        <div>
                                                                            <label for="basiInput" class="form-label">Product Head</label>
                                                                            <select class="form-select product_head_select" name="product_product_head" required></select>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <!--end row-->
                    
                                                            </div>
                
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-center">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button  class="btn btn btn-success">Save</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>

                        <!--modal content end-->



                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">View Product Head</h4>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#AddModal" class="btn btn-primary py-1">Add</button>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <table id="DataTable" class="table table-bordered table-striped delTable display dataTable">
                                            <thead>
                                                <tr>
                                                    <th class="no-sort">Sl no</th>
                                                    <th>Code</th>
                                                    <th>Product Detail</th>
                                                    <th>Product Head</th>
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


<script>

    document.addEventListener("DOMContentLoaded", function(event) { 
    
        /*add section*/    
   
        $(function() {
            $('#add_form').validate({
                rules: {
                    required: 'required',
                    
                },
                messages: {
                    required: 'This field is required',
                    
                },
                submitHandler: function(form) {
                    $.ajax({
                        url: "<?php echo base_url(); ?>Crm/Products/Add",
                        method: "POST",
                        data: $(form).serialize(),
                        success: function(data) {
                            $('#add_form')[0].reset();
                            $('#AddModal').modal('hide');
                            alertify.success('Data Added Successfully').delay(3).dismissOthers();
                            datatable.ajax.reload( null, false )
                            
                        }
                       
                    });
                    return false; // prevent the form from submitting
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
        $(".product_head_select").select2({
        placeholder: "Product Head",
        theme : "default form-control-",
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
     

    });


</script>