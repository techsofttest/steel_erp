<!--Start Account head -->
									
<div class="tab-pane active" id="border-nav-1" role="tabpanel">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Add Charts Of Account </h4>
                    
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <form  class="Dashboard-form class" id="add_form">
                    
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
                                        
                                        <select class="form-control" required>

                                        <option value="1">Test</option>

                                        </select>

                                    </div>
                                </div>
                                
                                
                                <div class="col-col-md-4 col-lg-4">
                                    <div class="Btn-dasform">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
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
                    <table id="accountTable" class="table table-bordered table-striped delTable display dataTable">
                        <thead>
                            <tr>
                                <th class="no-sort">Sl no</th>
                                <th>Type</th>
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
<div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="#" id="account_head_edit_form" class="Dashboard-form">
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
                                                        
                                                        <select class="form-control" name="ca_account_type">

                                                            <option value=""></option>

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
                            alertify.success('Charts Of Account Added Successfully').delay(8).dismissOthers();
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

            alert(id);

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
            $('#account_head_edit_form').submit(function(e){
                
                e.preventDefault();
                
                if( ($('input[name="edit_aname"]').val()==""))
                {
                    alertify.error('Fill required fields').delay(4).dismissOthers();
                    return false;
                }
                $.ajax({

                    url : "<?php echo base_url(); ?>Accounts/AccountHead/Update",

                    method : "POST",

                    data : $('#account_head_edit_form').serialize(),

                    success:function(data)
                    {
                        
                        $('#EditModal').modal('hide');

                        alertify.success('Account Head Edit Successfully').delay(8).dismissOthers();

                        initializeDataTable()
                    }


                });
            });
        });
        /*###*/




        /*account head delete*/ 
        $("body").on('click', '.acctype_delete', function(){ 
            
            if (!confirm('Are you absolutely sure you want to delete?')) return;
            var acctype = $(this).data('acctypedel');
            $.ajax({

                url : "<?php echo base_url(); ?>Accounts/AccountHead/Delete",

                method : "POST",

                data: {account_id: acctype},

                success:function(data)
                {
                    alertify.success('Account Head Delete Successfully').delay(8).dismissOthers();

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
            
            
