<!--Start Journal  col-->
<div class="tab-pane" id="border-nav-5" role="tabpanel">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Add Journal Voucher</h4>
                    
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
						<form action="#" class="Dashboard-form" id="add_form">
                            <div class="row align-items-end">
								<div class="col-col-md-4 col-lg-4">
                                    <div>
                                        <label for="basiInput" class="form-label">Date</label>
                                        <input type="date" onclick="this.showPicker();"  name="jv_voucher_date" class="form-control" required>
                                    </div>
                                </div>
                                        
                                <div class="col-col-md-4 col-lg-4">
                                    <div>
                                        <label for="labelInput" class="form-label">Sales order No</label>
                                        <select class="form-select " name="jv_sales_order_id" required>
                                            <option value="" selected disabled>Select Sales order No</option>
                                            <?php foreach($sales_order as $order){?> 
                                                <option value="<?php echo $order->so_id;?>"><?php echo $order->so_order_no;?></option>
                                            <?php } ?>


                                        </select>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-col-md-4 col-lg-4">
                                    <div>
                                        <label for="labelInput" class="form-label">Account</label>
                                        <select class="form-select" name="jv_account" required>
                                            <option value="" selected disabled>Select Account </option>
                                            <?php foreach($accounts_type as $account_type){?> 
                                            <option value="<?php echo $account_type->at_id;?>"><?php echo $account_type->at_name;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-col-md-4 col-lg-4">
                                    <div>
                                        <label for="basiInput" class="form-label" >Debit</label>
                                        <input type="number"  name="jv_debit" class="form-control" required>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-col-md-4 col-lg-4">
                                    <div>
                                        <label for="basiInput" class="form-label">Credit</label>
                                        <input type="number"  name="jv_credit" class="form-control" required>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-col-md-4 col-lg-4">
                                    <div>
                                        <label for="basiInput" class="form-label">Narration</label>
                                        <input type="text"  name="jv_narration" class="form-control" required>
                                    </div>
                                </div>
                                <!--end col-->
								<div class="col-col-md-4 col-lg-4">
											
									<div class="Btn-dasform">
											<button type="submit" name="" class="btn btn-primary waves-effect waves-light">Save</button>
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
                    <h4 class="card-title mb-0 flex-grow-1">View Journal Voucher</h4>
                
                </div><!-- end card header -->
                <div class="card-body">
                    <!-- CSRF token --> 
                    <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <table id="jv_table" class="table table-bordered table-striped delTable display dataTable">
                        <thead>
                            <tr>
                            <th class="no-sort">Sl no</th>
                            <th> Voucher No</th>
                            <th>Date</th>
                            <th>Sales order No</th>
                            <th> Account </th>
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
										
<!--end Journal col-->


<!--view Modal section start-->
<div class="modal fade" id="ViewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="#" id="account_head_edit_form" class="Dashboard-form">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">View Journal Voucher</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            
                            <div class="card-body">
                                <div class="live-preview">
                                    
                                    <div class="row align-items-end ">
                                        
                                        <div class="col-col-md-6 col-lg-6">
                                            <div>
                                                <label for="basiInput" class="form-label">Voucher No</label>
                                                <input type="text" id="voucher_no_id" value="" name="edit_aname" class="form-control">
                                            </div>
                                        </div>
                                    
                                        <div class="col-col-md-6 col-lg-6">
                                            <div>
                                                <label for="basiInput" class="form-label">Date</label>
                                                <input type="text" id="voucher_date_id" value="" name="edit_aname" class="form-control " >
                                            </div>
                                        </div>
                                      
                                        <div class="col-col-md-6 col-lg-6">
                                            <div>
                                                <label for="basiInput" class="form-label">Sales order No</label>
                                                <input type="text" id="voucher_order" value="" name="edit_aname" class="form-control " >
                                            </div>
                                        </div>
                                      

                                        <div class="col-col-md-6 col-lg-6">
                                            <div>
                                                <label for="basiInput" class="form-label">Account</label>
                                                <input type="text" id="voucher_account" value="" name="edit_aname" class="form-control " >
                                            </div>
                                        </div>
                                       

                                        <div class="col-col-md-6 col-lg-6">
                                            <div>
                                                <label for="basiInput" class="form-label">Debit</label>
                                                <input type="text" id="voucher_debit" value="" name="edit_aname" class="form-control " >
                                            </div>
                                        </div>
                                       

                                        <div class="col-col-md-6 col-lg-6">
                                            <div>
                                                <label for="basiInput" class="form-label">Credit</label>
                                                <input type="text" id="voucher_credit" value="" name="edit_aname" class="form-control " >
                                            </div>
                                        </div>
                                       

                                        <div class="col-col-md-6 col-lg-12">
                                            <div>
                                                <label for="basiInput" class="form-label">Narration</label>
                                                <input type="text" id="voucher_narration" value="" name="edit_aname" class="form-control " >
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="submit" class="btn btn btn-success">Submit</button>
            </div>
        </div>
        </form>

    </div>
</div>

<!--view modal section end-->



<script>
    document.addEventListener("DOMContentLoaded", function(event){
        
        /*add JournalVoucher*/
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
                        url: "<?php echo base_url(); ?>Accounts/JournalVoucher/Add",
                        method: "POST",
                        data: $(form).serialize(),
                        success: function(data) {
                            $('#add_form')[0].reset();
                            alertify.success('Journal Voucher Added Successfully').delay(2).dismissOthers();
                            initializeDataTable()
                        }
                    });
                    return false; // prevent the form from submitting
                }
            });
        });
        /*####*/



        /*view journal voucher start*/ 
        $("body").on('click', '.jv_view', function(){ 
            var jv_id = $(this).data('jvview');
            
            $.ajax({

                url : "<?php echo base_url(); ?>Accounts/JournalVoucher/View",

                method : "POST",

                data: {jv_id : jv_id},

                success:function(data)
                {   
                    var jsonData = JSON.parse(data);
                    console.log(jsonData.jv_voucher_no)
                    //$(".view_modal_tb").html(htmlContent);
                      
                    $("#voucher_no_id").val(jsonData.jv_voucher_no);

                    $("#voucher_date_id").val(jsonData.jv_voucher_date);

                    $("#voucher_order").val(jsonData.jv_sales_order_id);

                    $("#voucher_account").val(jsonData.jv_account);

                    $("#voucher_debit").val(jsonData.jv_debit);

                    $("#voucher_credit").val(jsonData.jv_credit);

                    $("#voucher_narration").val(jsonData.jv_narration);

                    $('#ViewModal').modal('show');
                    
                    //$("#modal_acc_type_id").val(acctype);
                    
                }


            });
            
            
        });
        /*####*/


        /*data table start*/ 
        function initializeDataTable() {
            $('#jv_table').DataTable().clear().destroy();
            $('#jv_table').DataTable({
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url': "<?php echo base_url(); ?>Accounts/JournalVoucher/FetchData",
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
                    { data: 'jv_id' },
                    { data: 'jv_voucher_no' },
                    { data: 'jv_voucher_date' },
                    { data: 'jv_sales_order_id' },
                    { data: 'jv_account' },
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