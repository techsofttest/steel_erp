										
<!--Start Receipt  col-->
<div class="tab-pane" id="border-nav-3" role="tabpanel">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Add Receipt</h4>
                                    
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
						<form action="#" method="post" class="Dashboard-form">
                            <div class="row align-items-end">
							    <div class="col-col-md-4 col-lg-4">
                                    <div>
                                        <label for="basiInput" class="form-label">Date</label>
                                        <input type="date"  name="" class="form-control " required>
                                    </div>
                                </div>
                                <div class="col-col-md-4 col-lg-4">
                                    <div>
                                        <label for="basiInput" class="form-label">Debit Account</label>
                                        <input type="text"  name="" class="form-control " required>
                                    </div>
                                </div>
                                <div class="col-col-md-4 col-lg-4">
                                    <div>
                                        <label for="basiInput" class="form-label">Receipt Number</label>
                                        <input type="text"  name="" class="form-control " required>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-col-md-4 col-lg-4">
                                    <div>
                                        <label for="labelInput" class="form-label">Receipt method</label>
                                        <select class="form-select " name="" required>
                                            <option selected="" >Select Receipt method </option>
                                            <option value="1">Cheque   </option>
                                            <option value="2">Cash </option>
                                            <option value="3">Transfer </option>
                                            <option value="4">L/C</option>
                                        </select>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-col-md-4 col-lg-4">
                                    <div>
                                        <label for="basiInput" class="form-label">Cheque Number</label>
                                        <input type="text"  name="" class="form-control " required>
                                    </div>
                                </div>
                                <!--end col-->
                                    <div class="col-col-md-4 col-lg-4">
                                    <div>
                                        <label for="basiInput" class="form-label">Cheque Date</label>
                                        <input type="date"  name="" class="form-control " required>
                                    </div>
                                </div>
                                <!--end col-->
                                    <div class="col-col-md-4 col-lg-4">
                                    <div>
                                        <label for="labelInput" class="form-label">Bank</label>
                                        <select class="form-select " name="" required>
                                        <option selected="" >Select Bank </option>
                                        


                                    </select>
                                    </div>
                                </div>
                                <!--end col-->
                                    <div class="col-col-md-4 col-lg-4">
                                    <div>
                                        <label for="labelInput" class="form-label">Collected by</label>
                                        <select class="form-select " name="" required>
                                        <option selected="" >Select</option>
                                        


                                    </select>
                                    </div>
                                </div>
                                <!--end col-->
                                    <div class="col-col-md-4 col-lg-4">
                                    <div>
                                        <label for="labelInput" class="form-label">Credit Account</label>
                                        <select class="form-select " name="" required>
                                        <option selected="" >Select</option>
                                        


                                    </select>
                                    </div>
                                </div>
                                <!--end col-->
                                    <div class="col-col-md-4 col-lg-4">
                                    <div>
                                        <label for="labelInput" class="form-label"> Amount</label>
                                            <input type="text"  name="" class="form-control " required>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-col-md-4 col-lg-4">
                                    <div>
                                        <label for="labelInput" class="form-label">Invoices</label>
                                        <select class="form-select " name="" required>
                                        <option selected="" >Select</option>
                                        


                                    </select>
                                    </div>
                                </div>
                                <!--end col-->
                                    <div class="col-col-md-4 col-lg-4">
                                    <div>
                                        <label for="labelInput" class="form-label"> Narration</label>
                                            <input type="text"  name="" class="form-control " required>
                                    </div>
                                </div>
                                <!--end col-->
                                    <div class="col-col-md-4 col-lg-4">
                                    <div>
                                        <label for="labelInput" class="form-label"> Total</label>
                                            <input type="text"  name="" readonly value="100"  class="form-control " required>
                                    </div>
                                </div>
                                <!--end col-->
                                    <div class="col-col-md-4 col-lg-4">
                                    <div>
                                        <label for="labelInput" class="form-label"> Amount in Words</label>
                                            <input type="text"  name="" class="form-control " required>
                                    </div>
                                </div>
                                <!--end col-->
                                    <div class="col-col-md-4 col-lg-4">
                                    <div>
                                        <label for="labelInput" class="form-label"> Attach cheque copy</label>
                                            <input type="file"  name="" class="form-control " required>
                                    </div>
                                </div>
                                <!--end col-->
								<div class="col-col-md-4 col-lg-4">
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
                    <h4 class="card-title mb-0 flex-grow-1">View Receipt</h4>
                                    
                </div><!-- end card header -->
                <div class="card-body">
                    <table id="datatable" class="table table-bordered table-striped delTable">
                        <thead>
                            <tr>
                                <th class="no-sort">Sl no</th>
                                <th> Reference Number</th>
                                <th>Date</th>
                                <th>Debit Account</th>
                                <th> Receipt Number</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                         
                        <tbody>
                            
                            <tr>
                                <td>1</td>
                                <td>1011</td>
				                <td>10-12-2023</td>
                                <td>Savings </td>
                                <td>213</td>
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
										
<!--end Receipt col-->