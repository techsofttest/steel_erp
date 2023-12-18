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
                                        
                                <!--<div class="col-col-md-4 col-lg-4">
                                    <div>
                                        <label for="labelInput" class="form-label">Sales order No</label>
                                        <select class="form-select" id="sales_order_id"  name="jv_sales_order_id" required>
                                            <option value="" selected disabled>Select Sales order No</option>
                                            <?php foreach($sales_order as $order){?> 
                                                <option value="<?php echo $order->so_id;?>"><?php echo $order->so_order_no;?></option>
                                            <?php } ?>


                                        </select>
                                    </div>
                                </div>--->

                                <div class="col-col-md-4 col-lg-4">
                                    <div>
                                        <label for="labelInput" class="form-label">Sales order No</label>
                                        <select class="form-select sales_order_select" id="sales_order_id"  name="jv_sales_order_id" required>
                                           

                                        </select>
                                    </div>
                                </div>

                                <!--end col-->
                                <div class="col-col-md-4 col-lg-4">
                                    <div>
                                        <label for="labelInput" class="form-label">Account</label>
                                        <select class="form-select account_select" name="jv_account" required>
                                           
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

                <!--table start-->

                <div class="card-body" style="display:none" id="order_table_id">
                    <table id="datatable" class="table table-bordered table-striped delTable">
                        
                        <thead>
                            <tr>
                                <th class="no-sort">Sl no</th>
                                <th>Sales order No</th>
                                <th>Date</th>
                                <th>Customer </th>
                                <th>LPO reference </th>
                                <th>Quotation Ref</th>
                            </tr>
                        </thead>

                        <tbody>
                        
                            <tr>
                                <td>1</td>
                                <td id="parent_order_id"></td>
                                <td>10-12-2023</td>
                                <td>Test Customer</td>
                                <td>Test Lpo reference</td>
                                <td>Test Quotation Ref</td>
                            </td>
                            
                        
                        </tbody>
           
                    </table>
                                    
                </div>
                <!--table end-->

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
                    <table id="DataTable" class="table table-bordered table-striped delTable display dataTable">
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
                                                <input type="text" id="voucher_no_id" value="" name="" class="form-control" readonly>
                                            </div>
                                        </div>
                                    
                                        <div class="col-col-md-6 col-lg-6">
                                            <div>
                                                <label for="basiInput" class="form-label">Date</label>
                                                <input type="text" id="voucher_date_id" value="" name="" class="form-control" readonly>
                                            </div>
                                        </div>
                                      
                                        <div class="col-col-md-6 col-lg-6">
                                            <div>
                                                <label for="basiInput" class="form-label">Sales order No</label>
                                                <input type="text" id="voucher_order" value="" name="" class="form-control" readonly>
                                            </div>
                                        </div>
                                      

                                        <div class="col-col-md-6 col-lg-6">
                                            <div>
                                                <label for="basiInput" class="form-label">Account</label>
                                                <input type="text" id="voucher_account" value="" name="" class="form-control" readonly>
                                            </div>
                                        </div>
                                       

                                        <div class="col-col-md-6 col-lg-6">
                                            <div>
                                                <label for="basiInput" class="form-label">Debit</label>
                                                <input type="text" id="voucher_debit" value="" name="" class="form-control" readonly>
                                            </div>
                                        </div>
                                       

                                        <div class="col-col-md-6 col-lg-6">
                                            <div>
                                                <label for="basiInput" class="form-label">Credit</label>
                                                <input type="text" id="voucher_credit" value="" name="" class="form-control" readonly>
                                            </div>
                                        </div>
                                       

                                        <div class="col-col-md-6 col-lg-12">
                                            <div>
                                                <label for="basiInput" class="form-label">Narration</label>
                                                <input type="text" id="voucher_narration" value="" name="" class="form-control" readonly>
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
                                                <div class="col-col-md-6 col-lg-6">
                                                    <div>
                                                        <label for="basiInput" class="form-label">Voucher No</label>
                                                        <input type="text" id="edit_vouch_no_id" value="" name="" class="form-control" readonly>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-col-md-6 col-lg-6">
                                                    <div>
                                                        <label for="basiInput" class="form-label">Date</label>
                                                        <input type="date" id="edit_vouch_date" onclick="this.showPicker()" value="" name="jv_voucher_date" class="form-control" required>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                               
                                                <div class="col-col-md-6 col-lg-6">
                                                    <div>
                                                        <label for="basiInput" class="form-label">Sales order No</label>
                                                       
                                                        <select class="form-select" id="edit_vouch_order"  name="jv_sales_order_id" required></select>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                               
                                                <div class="col-col-md-6 col-lg-6">
                                                    <div>
                                                        <label for="basiInput" class="form-label">Account</label>
                                                        <select id="edit_vouch_account" class="form-select" name="jv_account" required></select>
                                                    </div>
                                                </div>


                                                <!--end col-->
                                                <div class="col-col-md-6 col-lg-6">
                                                    <div>
                                                        <label for="basiInput" class="form-label">Debit</label>
                                                        <input type="number" id="edit_vouch_debit" value="" name="jv_debit" class="form-control" required>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-col-md-6 col-lg-6">
                                                    <div>
                                                        <label for="basiInput" class="form-label">Credit</label>
                                                        <input type="number" id="edit_vouch_credit" value="" name="jv_credit" class="form-control" required>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-col-md-6 col-lg-12">
                                                    <div>
                                                        <label for="basiInput" class="form-label">Narration</label>
                                                        <input type="text" id="edit_vouch_narration" value="" name="jv_narration" class="form-control" required>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <input type="hidden" name="jv_id" id="edit_vouch_id" value="">
                                                
                                            
                                                
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
                            alertify.success('Data Added Successfully').delay(2).dismissOthers();
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
                   
                   $("#voucher_no_id").val(jsonData.jv_voucher_no);

                    $("#voucher_date_id").val(jsonData.jv_voucher_date);

                    $("#voucher_order").val(jsonData.jv_sales_order_id);

                    $("#voucher_account").val(jsonData.jv_account);

                    $("#voucher_debit").val(jsonData.jv_debit);

                    $("#voucher_credit").val(jsonData.jv_credit);

                    $("#voucher_narration").val(jsonData.jv_narration);

                    $('#ViewModal').modal('show');
                    
                   
                    
                }


            });
            
            
        });
        /*####*/


        /*account head modal start*/ 
        $("body").on('click', '.edit_btn', function(){ 
            var id = $(this).data('id');
           
            $.ajax({

                url : "<?php echo base_url(); ?>Accounts/JournalVoucher/Edit",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {   
                    var data = JSON.parse(data);

                    console.log(data.order);

                    $('#edit_vouch_no_id').val(data.jv_voucher_no);

                    $('#edit_vouch_date').val(data.jv_voucher_date)

                    $('#edit_vouch_order').html(data.order)

                    $('#edit_vouch_account').html(data.account)
                    
                    $('#edit_vouch_debit').val(data.jv_debit)
                    
                    $('#edit_vouch_credit').val(data.jv_credit)
                    
                    $('#edit_vouch_narration').val(data.jv_narration)

                    $('#EditModal').modal('show');
                    
                    $("#edit_vouch_id").val(id);
                    
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
                        url: "<?php echo base_url(); ?>Accounts/JournalVoucher/Update",
                        method: "POST",
                        data: $(form).serialize(),
                        success: function(data) {
                            
                            alertify.success('Data Updated Successfully').delay(2).dismissOthers();
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

                url : "<?php echo base_url(); ?>Accounts/JournalVoucher/Delete",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {
                    alertify.success('Data Delete Successfully').delay(2).dismissOthers();

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
        


        /*sales order on change*/
        $("#sales_order_id").on('change', function(){
            var id =  $(this).val();
            
            $.ajax({

                url : "<?php echo base_url(); ?>Accounts/JournalVoucher/FetchOrder",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {
                    var data = JSON.parse(data);
                    console.log(data);
                    $('#parent_order_id').html(data.order_no);

                    $("#order_table_id").css("display",'block');
                }

            });

            
            
        });
        /*###*/

        /*sales order droupdrown*/
        $(".sales_order_select").select2({
        placeholder: "Sales order No",
        theme : "default form-control-",
        ajax: {
                url: "<?= base_url(); ?>Accounts/JournalVoucher/FetchTypes",
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
                        results: $.map(data.result, function (item) { return {id: item.so_id, text: item.so_order_no}}),
                        pagination: {
                        // THE `10` SHOULD BE SAME AS `$resultCount FROM PHP, it is the number of records to fetch from table` 
                            more: (page * 10) <= data.total_count
                        }
                    };
                },              
            }
        })
        /*###*/




         /*account  droupdrown*/
         $(".account_select").select2({
        placeholder: "Sales order No",
        theme : "default form-control-",
        ajax: {
                url: "<?= base_url(); ?>Accounts/JournalVoucher/AccountFetchTypes",
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
                        results: $.map(data.result, function (item) { return {id: item.at_id, text: item.at_name}}),
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