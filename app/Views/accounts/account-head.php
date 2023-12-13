<!--Start Account head -->
									
<div class="tab-pane active" id="border-nav-1" role="tabpanel">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Add Account Head </h4>
                    
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <form  class="Dashboard-form class" id="account_head_form">
                    
                            <div class="row align-items-end">
                                <div class="col-col-md-4 col-lg-4">
                                    <div>
                                        <label for="basiInput" class="form-label">Account Type</label>
                                        <input type="text" id="account_type_inp"  name="aname" class="form-control">
                                    </div>
                                </div>
                                
                                
                                <div class="col-col-md-4 col-lg-4">
                                    <div class="Btn-dasform">
                                        <button type="submit" name="submit" class="btn btn-primary waves-effect waves-light">Save</button>
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
                    <table id="userTable" class="table table-bordered table-striped delTable display dataTable">
                        <thead>
                            <tr>
                                <th class="no-sort">Sl no</th>
                                <th>Account Type</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            
                            <?php /*$i=1; foreach($account_head as $acc_head){?> 
                            
                            <tr>
                                <td><?php echo $i; ?></td>
                                
                            
                                <td><?php echo $acc_head->at_name;?></td>
                                <td>
                                    
                                    <a  href="javascript:void(0)" class="edit edit-color acctype_edit" data-toggle="tooltip" data-placement="top" title="edit"  data-acctype=<?php echo $acc_head->at_id;?> data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a>
                                    <!--<a href="" class="delete delete-color" data-toggle="tooltip"  data-placement="top" title="Delete" onclick="return confirm('Are you absolutely sure you want to delete?');"><i  class="ri-delete-bin-fill"></i> Delete</a>-->
                                    <a href="javascript:void(0)" class="delete delete-color acctype_delete" data-toggle="tooltip" data-acctypedel=<?php echo $acc_head->at_id;?>  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> Delete</a>
                                </td>
                            </tr>
                            
                            <?php $i++;} */?>
                            
                        
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
                    <form action="#" id="account_head_edit_form" class="Dashboard-form">
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
                                                                    <input type="text" id="modal_account_type" value="" name="edit_aname" class="form-control " >
                                                                </div>
                                                            </div>
                                                            <!--end col-->
                                                            <input type="hidden" name="account_id" id="modal_acc_type_id" value="">
                                                            
                                                        
                                                            
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


             <!---add account type section start-->

             <script>
                document.addEventListener("DOMContentLoaded", function(event) { 

                $(document).ready(function(){
                    $('#account_head_form').submit(function(e){
                        e.preventDefault();
                        if( ($('input[name="aname"]').val()==""))
                        {
                            alertify.error('Fill required fields').delay(4).dismissOthers();
                            return false;
                        }
                        $.ajax({

                            url : "<?php echo base_url(); ?>Accounts/AccountHead/Add",

                            method : "POST",

                            data : $('#account_head_form').serialize(),

                            success:function(data)
                            {
                                var data = JSON.parse(data);

                                $("#account_type_id").html(data.output);

                                $('#account_type_id').css('display', 'block');

                                $("#account_type_inp").val('');

                                alertify.success('Account Head Added Successfully').delay(8).dismissOthers();
                            }


                        });
                        
                    });
                });
            

            
            

                
                $("body").on('click', '.acctype_edit', function(){ 
                    var acctype = $(this).data('acctype');
                    //alert(acctype);
                    $.ajax({

                        url : "<?php echo base_url(); ?>Accounts/AccountHead/HeadEdit",

                        method : "POST",

                        data: {account_id: acctype},

                        success:function(data)
                        {   
                            var data = JSON.parse(data);

                            $("#modal_account_type").val(data.account_type);

                            $('#EditModal').modal('show');
                            
                            $("#modal_acc_type_id").val(acctype);
                            
                        }


                    });
                   
                  
                });

           
           

           
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
                                var data = JSON.parse(data);

                                $("#account_type_id").html(data.output);

                                $('#account_type_id').css('display', 'block');

                                $('#EditModal').modal('hide');

                                alertify.success('Account Head Edit Successfully').delay(8).dismissOthers();
                            }


                        });
                    });
                });
            

            

           
                
                $("body").on('click', '.acctype_delete', function(){ 
                    
                    if (!confirm('Are you absolutely sure you want to delete?')) return;
                    var acctype = $(this).data('acctypedel');
                    $.ajax({

                        url : "<?php echo base_url(); ?>Accounts/AccountHead/Delete",

                        method : "POST",

                        data: {account_id: acctype},

                        success:function(data)
                        {
                            var data = JSON.parse(data);

                            $("#account_type_id").html(data.output);

                            $('#account_type_id').css('display', 'block');

                            alertify.success('Account Head Delete Successfully').delay(8).dismissOthers();
                        }


                    });

                });
            

           

             
            $(document).ready(function(){
            $('#userTable').DataTable({
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url':"<?php echo base_url(); ?>Accounts/AccountHead/FetchData",
                    'data': function(data){
                    // CSRF Hash
                    var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
                    var csrfHash = $('.txt_csrfname').val(); // CSRF hash

                    return {
                    data: data,
                    [csrfName]: csrfHash, // CSRF Token
                    };
                    },
                    dataSrc: function(data){
                    // Update token hash
                    $('.txt_csrfname').val(data.token);

                    // Datatable data
                    return data.aaData;
                    }
                },
                'columns': [
                    { data: 'at_id' },
                    { data: 'at_name' },
                    { data: 'at_added_by' },
                   
                ]
            });
        });

    });
   </script>
            <!--data table script  end-->

            
