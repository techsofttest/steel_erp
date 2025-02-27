

<div class="tab-content text-muted">
								
    <div class="tab-pane active" id="nav-crm-top-1-1" role="tabpanel">
                    
        <div class="row">
            
            <div class="col-lg-12">
                
                <!-- Tab panes -->
                <div class="tab-content text-muted">
                    <!--product head tab--> 
                    <div class="tab-pane active" id="arrow-1" role="tabpanel">
                        
                        <!--Product detail modal content start-->
                        <div class="modal fade" id="AddProductHead" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form  class="Dashboard-form class" id="add_product_head_form">
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
                                                                <div class="row align-items-center mb-2 margin_zero">
                                                                    
                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basiInput" class="form-label">Code</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="ph_code" class="form-control" required>
                                                                    </div>
                                                                            
                                                                </div> 
                                                                <!-- ### -->  
                                                                
                                                                <!--Single Row Start-->

                                                                <div class="row align-items-center mb-2 margin_zero">
                                                                    
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
                                            <button  class="btn btn btn-success ">Save</button>
                                            
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>

                        <!--Product detail modal content end-->

                        
                        <!--view product in data table section start-->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">View Product Head</h4>
                                        <button type="button"  class="btn btn-primary py-1  add_model_btn">Add</button>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <table id="DataTable" class="table table-bordered table-striped delTable display dataTable">
                                            <thead>
                                                <tr>
                                                    <th class="no-sort">Sl no</th>
                                                    <th>Code</th>
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

                        <!--view product in data table section end--->

                    </div>
                    <!--###-->


                </div>
                    
                    
                    
            </div>
                    
        </div>
                    
                    
    </div>
                    
    
                        
</div>


<!--Edit Modal section start-->
<div class="modal fade" id="EditProductHead" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form  class="Dashboard-form class" id="update_product_head_form">
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
                                        <div class="row align-items-center mb-2 margin_zero">
                                            
                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basiInput" class="form-label">Code</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="text" name="ph_code"  class="form-control edit_prod_code " required>
                                            </div>
                                                    
                                        </div> 
                                        <!-- ### -->  
                                        
                                        <!--Single Row Start-->

                                        <div class="row align-items-center mb-2 margin_zero">
                                            
                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basiInput"  class="form-label">Product Head</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="text"   name="ph_product_head" class="form-control edit_product_head" required>
                                            </div>
                                              <input type="hidden" name="ph_id" class="prod_head_id">      
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


<!--Edit modal section end-->



<script>

    document.addEventListener("DOMContentLoaded", function(event) { 
    
       
         /*add section*/    
        $(function() {
            $('#add_product_head_form').validate({
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
                        success: function(data) 
                        {
                            var data = JSON.parse(data);
                           
                            
                            
                            if(data.status === "true")
                            {   
                               
                                $('#add_product_head_form')[0].reset();
                                $('#AddProductHead').modal('hide')
                                alertify.success('Data Added Successfully').delay(3).dismissOthers();
                                datatable.ajax.reload( null, false )
                                

                            }
                            else
                            {
                                alertify.error('Duplicate Data').delay(3).dismissOthers();
                               
                            }

                        }
                       
                    });
                    return false; // prevent the form from submitting
                }
            });
        });

        /*###*/


        /*add button start*/

        $("body").on('click', '.add_model_btn', function(){ 

            $.ajax({

                url : "<?php echo base_url(); ?>Crm/ProductHead/AddAccess",

                method : "POST",

                success:function(data)
                {

                    var data = JSON.parse(data);

                    if(data.status === 0){
                    
                        alertify.error(data.msg).delay(3).dismissOthers();

                    }
                    else{

                        $('#AddProductHead').modal('show');

                    }
                    

                }

            });

        });


        /*add button end*/



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

                    if(data.status === 0){

                        alertify.error(data.msg).delay(3).dismissOthers();

                    

                    }
                    else{

                        $(".edit_prod_code").val(data.product_code);

                        $(".edit_product_head").val(data.ph_product_head);

                        $('#EditProductHead').modal('show');

                        $(".prod_head_id").val(id);

                        
                    } 
                   
                    
                }

            });
          
        });
        /*####*/



        /*update*/
        
        $(function() {
            $('#update_product_head_form').validate({
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
                            var data = JSON.parse(data);
                            console.log(data);
                            if(data.status === "true")
                            {
                                alertify.success('Data Update Successfully').delay(3).dismissOthers();
                                $('#EditProductHead').modal('hide');
                                datatable.ajax.reload(null,false)
                            }
                            else
                            {
                                alertify.error('Duplicate Data').delay(3).dismissOthers();
                                
                            }
                          
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
                    var data = JSON.parse(data);
                    
                    if(data.status === 1){
                        
                        alertify.success(data.msg).delay(2).dismissOthers();

                        datatable.ajax.reload(null,false);
 
                    } else{

                        alertify.error(data.msg).delay(2).dismissOthers();
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
                { data :'ph_product_head'},
                { data :'action'},
                
               ]
    
            });
        }

        $(document).ready(function () {
            initializeDataTable();
        });
        /*###*/


        /*modal close trigger*/

        $('#AddProductHead').on('hidden.bs.modal', function () {
            
            $(this).find('form').trigger('reset');
            
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