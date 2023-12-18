

<div class="tab-content text-muted">
								
    <div class="tab-pane active" id="nav-crm-top-1-1" role="tabpanel">
                    
        <div class="row">
            
            <div class="col-lg-12">
                
                <!-- Tab panes -->
                <div class="tab-content text-muted">
                    <!--product head tab--> 
                    <div class="tab-pane active" id="arrow-1" role="tabpanel">
                        
                        <!--modal content start-->
                        <div class="modal fade" id="AddModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form class="Dashboard-form class" id="add_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Customer Creation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-border-top-primary" role="tablist" style="margin-bottom: 20px;">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="tab1-tab" data-bs-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">Customer Details</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="tab2-tab" data-bs-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false">Tab 2</a>
                        </li>
                        <!-- Add more tabs as needed -->
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                            <!-- Tab 1 content goes here -->
                            <div class="row">
                                <div class="col-md-4 col-lg-4">
                                    <label for="basiInput" class="form-label">Customer Name</label>
                                    <input type="text" name="ph_code" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="basicInput" class="form-label">Account ID (Linked with GL)</label>
                                    <input type="text" name="ph_product_head" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="basicInput" class="form-label">Post Box</label>
                                    <input type="text" name="ph_product_head" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="basicInput" class="form-label">Telephone</label>
                                    <input type="text" name="ph_product_head" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="basicInput" class="form-label">Fax</label>
                                    <input type="text" name="ph_product_head" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="basicInput" class="form-label">Email</label>
                                    <input type="text" name="ph_product_head" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="basicInput" class="form-label">Credit Term</label>
                                    <input type="text" name="ph_product_head" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="basicInput" class="form-label">Credit Period (Days)</label>
                                    <input type="text" name="ph_product_head" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="basicInput" class="form-label">Credit Limit</label>
                                    <input type="text" name="ph_product_head" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="basicInput" class="form-label">GL Account Type</label>
                                    <!--<input type="text" name="ph_product_head" class="form-control" required>-->
                                    <select class="">
                                        <option>Select </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                            <!-- Tab 2 content goes here -->
                            <!-- Add your content for Tab 2 here -->
                        </div>
                        <!-- Add more tab panes as needed -->
                    </div>

                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn btn-success">Save</button>
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
                                                    <th> Code </th>
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


                    <!--product tab start-->

                    <div class="tab-pane" id="arrow-2" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">Add Product </h4>
                                    
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <div class="live-preview">
									        <form action="#" method="post" class="Dashboard-form">
                                                <div class="row align-items-end">
                                                    <!--end col-->
                                                    <div class="col-md-4 col-lg-4">
                                                        <div>
                                                            <label for="basiInput" class="form-label">Code</label>
                                                            <input type="text" name="" class="form-control " required="">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-md-4 col-lg-4">
                                                        <div>
                                                            <label for="labelInput" class="form-label"> Product Details </label>
                                                            <input type="text" name="" class="form-control " required="">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-md-4 col-lg-4">
                                                        <div>
                                                            <label for="basiInput" class="form-label">Product Head</label>
                                                            <select class="form-select" name="" required="">
                                                                <option selected="">Select </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-md-4 col-lg-4">
                                                        <div class="Btn-dasform">
                                                            <button type="button" name="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                                                        </div>
                                                    
                                                    </div>
                                                
                                                    
                                                </div>
                                                <!--end row-->
										    </form>
                                        </div>
                                    
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">View Product </h4>
                                    
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <table id="DataTable" class="table table-bordered table-striped delTable">
                                            <thead>
                                                <tr>
                                                    <th class="no-sort">Sl no</th>
                                                    <th> Code </th>
                                                    <th> Product Details </th>
                                                    <th>Product Head</th>
                                                    
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                
                                                <tr>
                                                    <td>1</td>
                                                    <td>p101</td>
                                                    <td>Lorem Ispum Dummy Text</td>
                                                    <td>Lorem Dummy </td>
                                                    <td>
                                                        <a  href="" class="edit edit-color" data-toggle="tooltip" data-placement="top" title="edit" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a>
                                                        <a href="" class="delete delete-color" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you absolutely sure you want to delete?');"><i  class="ri-delete-bin-fill"></i> Delete</a>
                                                        <a  href="" class="view view-color" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a>
                                                    
                                                    </td>
                                                </tr>
                    
                    
                    
                
                                            </tbody>
           
                                        </table>
                                    
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                    </div>  

                    <!--product tab end-->

                    
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
                        url: "<?php echo base_url(); ?>Crm/ProductHead/Add",
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
                'url': "<?php echo base_url(); ?>Crm/ProductHead/FetchData",
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
                { data: 'ph_id' },
                { data: 'ph_code' },
                { data : 'ph_product_head'},
                { data : 'action'},
                
               ]
    
            });
        }

        $(document).ready(function () {
            initializeDataTable();
        });
        /*###*/
     

    });


</script>