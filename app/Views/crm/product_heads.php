

<div class="tab-content text-muted">
								
    <div class="tab-pane active" id="nav-crm-top-1-1" role="tabpanel">
                    
        <div class="row">
            
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
        
                        <!-- Start Subtabs -->
                        <ul class="nav nav-pills arrow-navtabs nav-success bg-light mb-3" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="<?= base_url(); ?>Crm/ProductHead" role="tab">
                                    <span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
                                    <span class="d-none d-sm-block">Product Head</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url(); ?>Crm/Products" role="tab">
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
                            <div class="modal-dialog">
                                <form  class="Dashboard-form class" id="add_form">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Product Head</h5>
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
                                                                        <label for="basiInput" class="form-label">Code</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="ph_code" class="form-control" required>
                                                                    </div>
                                                                            
                                                                </div> 
                                                                <!-- ### -->  
                                                                
                                                                <!--Single Row Start-->

                                                                <div class="row align-items-center mb-2">
                                                                    
                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basiInput" class="form-label">Product Head</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text"  name="ph_product_head" class="form-control" required>
                                                                    </div>
                                                                            
                                                                </div>


                                                                <!-- ## -->
                                                                    

                    
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


<!--Edit Modal section start-->
<div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="#" id="update_form" class="Dashboard-form">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Product Head</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                
                                <div class="card-body">
                                    <div class="live-preview">
                                        
                                            <div class="row align-items-end">

                                                <div class="col-col-md-6 col-lg-6">
                                                    <div>
                                                        <label for="basiInput" class="form-label">Code</label>
                                                        <input type="text" id="edit_prod_code" value="" name="ph_code" class="form-control" required>
                                                    </div>
                                                </div>


                                                <div class="col-col-md-6 col-lg-6">
                                                    <div>
                                                        <label for="basiInput" class="form-label">Product Head</label>
                                                        <input type="text" id="edit_product_head" value="" name="ph_product_head" class="form-control" required>
                                                    </div>
                                                </div>


                                               


                                                <!--end col-->
                                                <input type="hidden" name="ph_id" id="id" value="">
                                                
                                            
                                                
                                            </div>
                                            <!--end row-->
                                        
                                    </div>
                                        
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                
                    </div>
            <div class="modal-footer">
                <button type="submit" name="" class="btn btn btn-success">Save</button>
            </div>
        
        </form>

    </div>
</div>

<!--Edit modal section end-->



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
                errorPlacement: function(error, element) {} ,
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



        /*edit*/ 
        $("body").on('click', '.edit_btn', function(){ 
            var id = $(this).data('id');

            $.ajax({

                url : "<?php echo base_url(); ?>Crm/ProductHead/Edit",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {   
                    var data = JSON.parse(data);
                     
                    $("#edit_prod_code").val(data.product_code);

                    $("#edit_product_head").val(data.ph_product_head);

                    $('#EditModal').modal('show');
                    
                    $("#id").val(id);
                    
                }


            });
            
            
        });
        /*####*/



        /*update*/
        
        $(function() {
            $('#update_form').validate({
                rules: {
                    required: 'required',
                    
                },
                messages: {
                    required: 'This field is required',
                    
                },
                errorPlacement: function(error, element) {} ,
                submitHandler: function(form) {
                    $.ajax({
                        url: "<?php echo base_url(); ?>Crm/ProductHead/Update",
                        method: "POST",
                        data: $(form).serialize(),
                        success: function(data) {
                            
                            alertify.success('Data Updated Successfully').delay(2).dismissOthers();
                            $('#EditModal').modal('hide');
                            datatable.ajax.reload(null,false);
                        }
                    });
                    return false; // prevent the form from submitting
                }
            });
        });


        /*###*/



        /*delete*/ 
        $("body").on('click', '.delete_btn', function(){ 
            
            if (!confirm('Are you absolutely sure you want to delete?')) return false;
            var id = $(this).data('id');
            $.ajax({

                url : "<?php echo base_url(); ?>Crm/ProductHead/Delete",

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