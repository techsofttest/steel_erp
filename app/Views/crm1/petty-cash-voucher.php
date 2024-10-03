<!--Start Petty cash voucher  col-->
<div class="tab-pane" id="border-nav-6" role="tabpanel">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Add Petty cash voucher</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
						<form action="#" method="post" class="Dashboard-form" id="add_form">
                            <div class="row align-items-end">
							    <div class="col-col-md-4 col-lg-4">
                                    <div>
                                        <label for="basiInput" class="form-label">Date</label>
                                        <input type="date" onclick="this.showPicker()"  name="pcv_date" class="form-control " required>
                                    </div>
                                </div>
								<!--end col-->
                                <div class="col-col-md-4 col-lg-4">
                                    <div>
                                        <label for="basiInput" class="form-label">Credit Account</label>
                                        <select class="form-select " name="" required>
                                            <option selected="" >Select</option>
                                        </select>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-col-md-4 col-lg-4">
                                    <div>
                                        <label for="basiInput" class="form-label">Sales order No</label>
                                        <select class="form-select order_select" name="pcv_credit_acount_id" required></select>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-col-md-4 col-lg-4">
                                    <div>
                                        <label for="basiInput" class="form-label">Debit Account</label>
                                        <select class="form-select " name="" required>
                                            <option selected="" >Select</option>
                                        </select>
                                    </div>
                                </div>
								<!--end col-->
								<div class="col-col-md-4 col-lg-4">
                                    <div>
                                        <label for="labelInput" class="form-label"> Amount </label>
                                        <input type="text" name="pcv_amount" class="form-control " required="">
                                    </div>
                                </div>
								<!--end col-->
								<div class="col-col-md-4 col-lg-4">
                                    <div>
                                        <label for="labelInput" class="form-label"> Narration</label>
                                        <input type="text" name="pcv_narration" class="form-control" required="">
                                    </div>
                                </div>
								<!--end col-->
								<div class="col-col-md-4 col-lg-4">
                                    <div>
                                        <label for="labelInput" class="form-label">Total</label>
                                        <input type="text" name="pcv_total"  class="form-control" required="">
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
                    <h4 class="card-title mb-0 flex-grow-1">View Petty cash voucher</h4>
                    
                </div><!-- end card header -->
                <div class="card-body">
                    <table id="datatable" class="table table-bordered table-striped delTable">
                        
                        <thead>
                            <tr>
                                <th class="no-sort">Sl no</th>
                                <th> Voucher No</th>
                                <th>Date</th>
                                <th>Credit Account</th>
                                <th> Sales order No</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                         
                            <tr>
                                <td>1</td>
                                <td>1011</td>
                                    <td>10-12-2023</td>
                                <td>Savings </td>
                                <td>211</td>
                                <td><a  href="" class="edit edit-color" data-toggle="tooltip" data-placement="top" title="edit" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a>
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
										
										
<!--end Petty cash voucher col-->

<script>
    document.addEventListener("DOMContentLoaded", function(event){

        /*add*/
        $(function() {
            $('#add_form').validate({
                
                rules: {
                    required: 'required',
                    
                },
                messages: {
                    required: 'This field is required',
                    
                },
                submitHandler: function(form){
                    $.ajax({
                        url: "<?php echo base_url(); ?>Accounts/PettyCashVoucher/Add",
                        method: "POST",
                        data: $(form).serialize(),
                        success: function(data){
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


        /*sales order  droupdrown*/
         $(".order_select").select2({
        placeholder: "Sales order No",
        theme : "default form-control-",
        ajax: {
                url: "<?= base_url(); ?>Accounts/PettyCashVoucher/FetchTypes",
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
                processResults: function(data, params){
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

    });
</script>

