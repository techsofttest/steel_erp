<!--Start Account head -->
									
<div class="tab-pane active" id="border-nav-1" role="tabpanel">


    <!-- Add Modal -->


    <div class="modal fade" id="AddModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
            <form  class="Dashboard-form class" id="add_form">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Chart Of Account</h5>
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
                                <label for="basiInput" class="form-label">Account Id</label>
                                <input type="text"   name="ca_account_id" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-col-md-4 col-lg-4">
                            <div>
                                <label for="basiInput" class="form-label">Account Name</label>
                                <input type="text"  name="ca_name" class="form-control" required>
                            </div>
                        </div>


                        <div class="col-col-md-4 col-lg-4">
                            <div>
                                <label for="basiInput" class="form-label">Account Type</label>
                                
                                <select name="ca_account_type" class="account_type_select_add form-control" required>

                                <option value="">Select Account Type</option>

                                <?php foreach($account_types as $ac_type){ ?>

                                <option value="<?= $ac_type->at_id; ?>"><?= $ac_type->at_name; ?></option>

                                <?php } ?>

                                </select>

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






    <!-- ### -->




   
    
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">View Charts Of Accounts</h4>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#AddModal" class="btn btn-primary py-1">Add</button>
                </div><!-- end card header -->
                <div class="card-body" id="account_type_id">
                        <!-- CSRF token --> 
                    <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <table id="accountTable" class="table table-bordered table-striped delTable display dataTable">
                        <thead>
                            <tr>
                                <th class="no-sort">Sl no</th>
                                <th>Type</th>
                                <th>Account ID</th>
                                <th>Name</th>
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
<div class="modal fade" id="EditModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="#" id="edit_form" class="Dashboard-form">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Charts Of Account</h5>
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
                                                        <label for="basiInput" class="form-label">Account ID</label>
                                                        <input type="text" id="edit_account_id" value="" name="ca_account_id" class="form-control">
                                                    </div>

                                                    <div>
                                                        <label for="basiInput" class="form-label">Account Name</label>
                                                        <input type="text" id="edit_account_name" value="" name="ca_name" class="form-control">
                                                    </div>

                                                    <div>
                                                        <label for="basiInput" class="form-label">Account Type</label>
                                                        
                                                        <select id="edit_account_type" class="form-control account_type_select_edit" name="ca_account_type">

                                                        <?php foreach($account_types as $ac_type){ ?>

                                                        <option value="<?= $ac_type->at_id; ?>"><?= $ac_type->at_name; ?></option>

                                                        <?php } ?>

                                                        </select>

                                                    </div>



                                                </div>

                                                <!--end col-->

                                                <input type="hidden" name="id" id="ca_id" value="">
                                                
                                                
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
                <button type="submit" name="submit" class="btn btn btn-success">Submit</button>
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
                        url: "<?php echo base_url(); ?>Accounts/ChartsOfAccounts/Add",
                        method: "POST",
                        data: $(form).serialize(),
                        success: function(data) {
                            $('#add_form')[0].reset();
                            $('#AddModal').modal('hide');
                            alertify.success('Charts Of Account Added Successfully').delay(3).dismissOthers();
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

                url : "<?php echo base_url(); ?>Accounts/ChartsOfAccounts/Edit",

                method : "POST",

                data: {id: id},

                success:function(data)
                {   
                    if(data)
                    {
                    var data = JSON.parse(data);

                    $("#edit_account_id").val(data.ca_account_id);

                    $("#edit_account_name").val(data.ca_name);

                    $('#edit_account_type').val(data.ca_account_type);

                    $('#EditModal').modal('show');
                    
                    $("#ca_id").val(id);
                    }
                    else
                    {
                    alertify.error('Something went wrong!').delay(8).dismissOthers();  
                    }
                    
                }


            });
            
            
        });
        /*####*/



        /*account head update*/
        $(document).ready(function(){
            $('#edit_form').submit(function(e){

                e.preventDefault();
                
                $.ajax({

                    url : "<?php echo base_url(); ?>Accounts/ChartsOfAccounts/Update",

                    method : "POST",

                    data : $('#edit_form').serialize(),

                    success:function(data)
                    {
                        
                        $('#EditModal').modal('hide');

                        alertify.success('Charts Of Account Updated Successfully').delay(8).dismissOthers();

                        initializeDataTable()
                    }


                });
            });
        });
        /*###*/




        /*account head delete*/ 
        $("body").on('click', '.delete_btn', function(){ 
            
            if (!confirm('Are you absolutely sure you want to delete?')) return;
            var id = $(this).data('id');
            $.ajax({

                url : "<?php echo base_url(); ?>Accounts/ChartOfAccounts/Delete",

                method : "POST",

                data: {id: id},

                success:function(data)
                {
                    alertify.success('Chart Of Account Deleted Successfully').delay(8).dismissOthers();

                    initializeDataTable()
                }


            });

        });
        /*###*/



        /*data table start*/ 


        function initializeDataTable() {
            $('#accountTable').DataTable().clear().destroy();
            $('#accountTable').DataTable({
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url': "<?php echo base_url(); ?>Accounts/ChartsOfAccounts/FetchData",
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
                    { data: 'ca_id' },
                    { data: 'at_name' },
                    { data : 'ca_account_id'},
                    { data: 'ca_name' },
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

            
