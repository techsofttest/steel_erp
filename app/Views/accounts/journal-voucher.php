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
						<form action="#" class="Dashboard-form" id="journal_voucher_form">
                            <div class="row align-items-end">
								<div class="col-col-md-4 col-lg-4">
                                    <div>
                                        <label for="basiInput" class="form-label">Date</label>
                                        <input type="date" onclick="this.showPicker();"  name="jv_date" class="form-control" required>
                                    </div>
                                </div>
                                        
                                <div class="col-col-md-4 col-lg-4">
                                    <div>
                                        <label for="labelInput" class="form-label">Sales order No</label>
                                        <select class="form-select " name="jv_order" required>
                                            <option value="" selected disabled>Select Sales order No</option>
                                            <?php foreach($sales_order as $order){?> 
                                                <option value="1"><?php echo $order->so_order_no;?></option>
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
                                            <?php foreach($accounts_type as $account_type)?>
                                            <option value="<?php echo $account_type->at_id;?>"><?php echo $account_type->at_name;?></option>
                                        </select>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-col-md-4 col-lg-4">
                                    <div>
                                        <label for="basiInput" class="form-label" >Debit</label>
                                        <input type="text"  name="jv_debit" class="form-control" required>
                                    </div>
                                </div>
                                <!--end col-->
                                    <div class="col-col-md-4 col-lg-4">
                                    <div>
                                        <label for="basiInput" class="form-label">Credit</label>
                                        <input type="text"  name="jv_credit" class="form-control" required>
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
                                    <h4 class="card-title mb-0 flex-grow-1">View Journal Voucher</h4>
                                    
                                </div><!-- end card header -->
                                <div class="card-body">
                                    <table id="datatable" class="table table-bordered table-striped delTable">
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
              
                
				  <tr >
                  <td>1</td>
                  <td>1011</td>
				    <td>10-12-2023</td>
					  <td>211</td>
                  <td>Savings </td>
                
                <td><a  href="" class="edit edit-color" data-toggle="tooltip" data-placement="top" title="edit" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a>
                    <a href="" class="delete delete-color" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you absolutely sure you want to delete?');"><i  class="ri-delete-bin-fill"></i> Delete</a>
					<a  href="" class="view view-color" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a>
					</td>
                </tr>
				  <tr >
                  <td>2</td>
                  <td>1012</td>
                    <td>10-12-2023</td>
					    <td>212</td>
                  <td>Savings </td>
              
<td><a  href="" class="edit edit-color" data-toggle="tooltip" data-placement="top" title="edit" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a>
                    <a href="" class="delete delete-color" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you absolutely sure you want to delete?');"><i  class="ri-delete-bin-fill"></i> Delete</a>
					<a  href="" class="view view-color" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a>
					</td>
                </tr>
				  <tr >
                  <td>3</td>
                  <td>1013</td>
                   <td>10-12-2023</td>
				   <td>213</td>
                  <td>Savings </td>
                  
                <td><a  href="" class="edit edit-color" data-toggle="tooltip" data-placement="top" title="edit" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a>
                    <a href="" class="delete delete-color" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you absolutely sure you want to delete?');"><i  class="ri-delete-bin-fill"></i> Delete</a>
					<a  href="" class="view view-color" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a>
					</td>
                </tr>
				  <tr >
                  <td>4</td>
                  <td>1014</td>
                    <td>10-12-2023</td>
					<td>214</td>
                  <td>Savings </td>
                  
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
										
										
<!--end Journal col-->



<script>
    document.addEventListener("DOMContentLoaded", function(event){
        $(function() {
            $('#journal_voucher_form').validate({
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
                            $('#journal_voucher_form')[0].reset();
                            alertify.success('Journal Voucher Added Successfully').delay(8).dismissOthers();
                        }
                    });
                    return false; // prevent the form from submitting
                }
            });
        });
    });
</script>