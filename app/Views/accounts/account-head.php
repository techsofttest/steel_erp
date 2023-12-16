<!--Start Account head -->
									
<div class="tab-pane active" id="border-nav-1" role="tabpanel">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Add Account Head </h4>
                    
                </div><!-- end card header -->
                <div class="card-body add_sec" style="display:none;">
                    <div class="live-preview">
                        <form  class="Dashboard-form class" id="add_form">
                    
                            <div class="row align-items-end">
                               <div class="col-col-md-4 col-lg-4">
                                    <div>
                                        <label for="basiInput" class="form-label">Account Name</label>
                                        <input type="text" id="account_type_inp"  name="ah_account_name" class="form-control" required>
                                        
                                    </div>
                                </div>
                                <div class="col-col-md-4 col-lg-4">
                                    <div>
                                        <label for="basiInput" class="form-label">Account Type</label>
                                        
                                        <select class="form-select" name="ah_account_type" required>
                                            <option value="" selected disabled>Select Account Type</option>
                                            <?php foreach($account_types as $account_type){?> 
                                                <option value="<?php echo $account_type->at_id;?>"><?php echo $account_type->at_name;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                
                                
                                <div class="col-col-md-4 col-lg-4">
                                    <div class="Btn-dasform">
                                        <button type="submit"  class="btn btn-primary waves-effect waves-light">Save</button>
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
                    <h4 class="card-title mb-0 flex-grow-1">View Account Head</h4>
                </div><!-- end card header -->
                <div class="card-body" id="account_type_id">
                        <!-- CSRF token --> 
                    <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <table id="DataTable" class="table table-bordered table-striped delTable display dataTable">
                        <thead>
                            <tr>
                                <th class="no-sort">Sl no</th>
                                <th>Account Name</th>
                                <th>Account Type</th>
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

										
<!--end Account  Head-->




<!--Edit Modal section start-->
<div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="#" id="update_form" class="Dashboard-form">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Account Head</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                
                                <div class="card-body">
                                    <div class="live-preview">
                                        
                                            <div class="row align-items-end">
                                                <div class="col-col-md-6 col-lg-12">
                                                    <div>
                                                        <label for="basiInput" class="form-label">Account Type</label>
                                                        <input type="text" id="htmlContent" value="" name="at_name" class="form-control " required>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <input type="hidden" name="account_id" id="id" value="">
                                                
                                            
                                                
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
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="" class="btn btn btn-success">Submit</button>
            </div>
        </div>
        </form>

    </div>
</div>

<!--Edit modal section end-->


            

<script>
    document.addEventListener("DOMContentLoaded", function(event) { 
    
        /*account head add section*/  

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
                        url: "<?php echo base_url(); ?>Accounts/AccountHead/Add",
                        method: "POST",
                        data: $(form).serialize(),
                        success: function(data) {
                            $('#add_form')[0].reset();
                            alertify.success('Account Head Added Successfully').delay(2).dismissOthers();
                            initializeDataTable()
                        }
                    });
                    return false; // prevent the form from submitting
                }
            });
        });

        
        /*###*/


        /*account head modal start*/ 
        $("body").on('click', '.edit_btn', function(){ 
            var id = $(this).data('id');
            
            $.ajax({

                url : "<?php echo base_url(); ?>Accounts/AccountHead/Edit",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {   
                    var data = JSON.parse(data);

                    $("#htmlContent").val(data.account_type);

                    $('#EditModal').modal('show');
                    
                    $("#id").val(id);
                    
                }


            });
            
            
        });
        /*####*/


        /*account head update*/
        
        $(function() {
            $('#update_form').validate({
                rules: {
                    required: 'required',
                    
                },
                messages: {
                    required: 'This field is required',
                    
                },
                submitHandler: function(form) {
                    $.ajax({
                        url: "<?php echo base_url(); ?>Accounts/AccountHead/Update",
                        method: "POST",
                        data: $(form).serialize(),
                        success: function(data) {
                            
                            alertify.success('Account Head Update Successfully').delay(2).dismissOthers();
                            $('#EditModal').modal('hide');
                            initializeDataTable()
                        }
                    });
                    return false; // prevent the form from submitting
                }
            });
        });


        /*###*/


        /*account head delete*/ 
        $("body").on('click', '.delete_btn', function(){ 
            
            if (!confirm('Are you absolutely sure you want to delete?')) return false;
            var id = $(this).data('id');
            $.ajax({

                url : "<?php echo base_url(); ?>Accounts/AccountHead/Delete",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {
                    alertify.success('Account Head Delete Successfully').delay(2).dismissOthers();

                    initializeDataTable()
                }


            });

        });
        /*###*/


        /*data table start*/ 
        function initializeDataTable() {
            $('#DataTable').DataTable().clear().destroy();
            $('#DataTable').DataTable({
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url': "<?php echo base_url(); ?>Accounts/AccountHead/FetchData",
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
                    { data: 'ah_id' },
                    { data: 'ah_account_name' },
                    { data: 'ah_account_type' },
                    { data: 'action' },
                ]
                
            });
        }

        $(document).ready(function () {
            initializeDataTable();
        });
        /*###*/




       

   

    });


</script>
            
            
