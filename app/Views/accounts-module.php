<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">



<head>

    <meta charset="utf-8" />
    <title><?php echo site_title//Defined in app/constants ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />
    <meta content="" name="author" />
    
       
        <!--header section start-->

        <?php echo view('includes/header');?>

        <!--header section end-->
          
        <!--sidebar section start-->

        <?php echo view('includes/sidebar'); ?>

        <!--sidebar section end-->



        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">


 <ul class="nav nav-pills nav-custom-outline nav-primary mb-3" role="tablist">
                                        <li class="nav-item waves-effect waves-light">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#border-nav-1" role="tab">Account Head</a>
                                        </li>
                                        <li class="nav-item waves-effect waves-light">
                                            <a class="nav-link" data-bs-toggle="tab" href="#border-nav-2" role="tab">Charts of Accounts</a>
                                        </li>
                                        <li class="nav-item waves-effect waves-light">
                                            <a class="nav-link" data-bs-toggle="tab" href="#border-nav-3" role="tab">Receipt</a>
                                        </li>
                                        <li class="nav-item waves-effect waves-light">
                                            <a class="nav-link" data-bs-toggle="tab" href="#border-nav-4" role="tab">Payment</a>
                                        </li>
										   <li class="nav-item waves-effect waves-light">
                                            <a class="nav-link" data-bs-toggle="tab" href="#border-nav-5" role="tab">Journal Voucher</a>
                                        </li>
										   <li class="nav-item waves-effect waves-light">
                                            <a class="nav-link" data-bs-toggle="tab" href="#border-nav-6" role="tab">Petty cash voucher</a>
                                        </li>
										  <li class="nav-item waves-effect waves-light">
                                            <a class="nav-link" data-bs-toggle="tab" href="#border-nav-7" role="tab">Reports</a>
                                        </li>
                                    </ul>
									
								
                                    
                                
									  <div class="tab-content text-muted">
                                       

<!--Start Account col-->
										
										
                                       
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
                                    <table id="" class="table table-bordered table-striped delTable">
                                        <thead>
                                            <tr>
                                                <th class="no-sort">Sl no</th>
                                                
                                                
                                                <th>Account Type</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            
                                            <?php $i=1; foreach($account_head as $acc_head){?> 
                                            
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                
                                            
                                                <td><?php echo $acc_head->at_name;?></td>
                                                <td>
                                                    
                                                    <a  href="javascript:void(0)" class="edit edit-color acctype_edit" data-toggle="tooltip" data-placement="top" title="edit"  data-acctype=<?php echo $acc_head->at_id;?> data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a>
                                                    <!--<a href="" class="delete delete-color" data-toggle="tooltip"  data-placement="top" title="Delete" onclick="return confirm('Are you absolutely sure you want to delete?');"><i  class="ri-delete-bin-fill"></i> Delete</a>-->
                                                    <a href="javascript:void(0)" class="delete delete-color acctype_delete" data-toggle="tooltip" data-acctypedel=<?php echo $acc_head->at_id;?>  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> Delete</a>
                                                </td>
                                            </tr>
                                            
                                            <?php $i++;} ?>
                                            
                                        
                                        </tbody>
           
                                    </table>
                                    
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                    </div>

                                          
                                        </div>
										
										
										
										
										
										
										
										
<!--end Account  col-->
										
<!--Start Chart col-->
										
										
                                        <div class="tab-pane" id="border-nav-2" role="tabpanel">
                                            <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Add Charts of Accounts</h4>
                                    
                                </div><!-- end card header -->
                                <div class="card-body">
                                    <div class="live-preview">
									<form action="#" method="post" class="Dashboard-form">
                                        <div class="row align-items-end">
                                            <div class="col-col-md-4 col-lg-4">
                                                <div>
                                                    <label for="basiInput" class="form-label">Account Name</label>
                                                    <input type="text"  name="aname" class="form-control " required>
                                                </div>
                                            </div>
                                            <!--end col-->
                                             <div class="col-col-md-4 col-lg-4">
                                                <div>
                                                    <label for="labelInput" class="form-label">Account Type</label>
                                                    <select class="form-select " name="atype" required>
                                                    <option selected="" >Select Account Type </option>
                                                    <option value="1">Accounts Receivable</option>
 <option value="2">Cash</option>
 <option value="3">Cost of Sales</option>
 <option value="4">Expenses</option>
 <option value="5">Fixed Assets</option>
 <option value="6">Inventory</option>
 <option value="7">Other Assets</option>
 <option value="8">Other Current Assets</option>
 <option value="9">Accounts Payable</option>
 <option value="10">Accumulated Depreciation</option>
 <option value="11">Equity Doesn’t Close</option>
 <option value="12"> Equity Retained Earnings</option>
 <option value="13">Income</option>
 <option value="14">Long Term Liabilities</option>
 <option value="15">Provisions & Accruals</option>
 <option value="16">Other Current Liabilities</option>

                                                </select>
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
                                    <h4 class="card-title mb-0 flex-grow-1">View Charts of Accounts</h4>
                                    
                                </div><!-- end card header -->
                                <div class="card-body">
                                    <table id="datatable" class="table table-bordered table-striped delTable">
             <thead>
                <tr>
                  <th class="no-sort">Sl no</th>
                  <th> Account ID</th>
                  <th>Account Name</th>
                  <th>Account Type</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              
              
				  <tr >
                  <td>1</td>
                  <td>1010</td>
                  <td>Bibin Sabu </td>
                  <td>Accounts Receivable</td>
                 <td><a  href="" class="edit edit-color" data-toggle="tooltip" data-placement="top" title="edit" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a>
                    <a href="" class="delete delete-color" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you absolutely sure you want to delete?');"><i  class="ri-delete-bin-fill"></i> Delete</a>
					<a  href="" class="view view-color" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a>
					</td>
                </tr>
				
				  <tr >
                  <td>2</td>
                  <td>1012</td>
                  <td>Bibin Sabu </td>
                  <td>Accounts Receivable</td>
                <td><a  href="" class="edit edit-color" data-toggle="tooltip" data-placement="top" title="edit" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a>
                    <a href="" class="delete delete-color" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you absolutely sure you want to delete?');"><i  class="ri-delete-bin-fill"></i> Delete</a>
					<a  href="" class="view view-color" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a>
					</td>
                </tr>
				  <tr >
                  <td>3</td>
                  <td>1013</td>
                  <td>Bibin Sabu </td>
                  <td>Accounts Receivable</td>
                 <td><a  href="" class="edit edit-color" data-toggle="tooltip" data-placement="top" title="edit" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a>
                    <a href="" class="delete delete-color" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you absolutely sure you want to delete?');"><i  class="ri-delete-bin-fill"></i> Delete</a>
					<a  href="" class="view view-color" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a>
					</td>
                </tr>
				  <tr >
                  <td>4</td>
                  <td>1014</td>
                  <td>Bibin Sabu </td>
                  <td>Accounts Receivable</td>
                <td><a  href="" class="edit edit-color" data-toggle="tooltip" data-placement="top" title="edit" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a>
                    <a href="" class="delete delete-color" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you absolutely sure you want to delete?');"><i  class="ri-delete-bin-fill"></i> Delete</a>
					<a  href="" class="view view-color" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a>
					</td>
                </tr>
                <tr >
                  <td>5</td>
                  <td>1015</td>
                  <td>Ajil Sabu </td>
                  <td>Accounts Receivable</td>
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
										
										
										
										
										
										
										
										
<!--end Chart  col-->
										
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
              
                
				  <tr >
                  <td>1</td>
                  <td>1011</td>
				    <td>10-12-2023</td>
                  <td>Savings </td>
                  <td>213</td>
                 <td><a  href="" class="edit edit-color" data-toggle="tooltip" data-placement="top" title="edit" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a>
                    <a href="" class="delete delete-color" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you absolutely sure you want to delete?');"><i  class="ri-delete-bin-fill"></i> Delete</a>
					<a  href="" class="view view-color" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a>
					</td>
                </tr>
				  <tr >
                  <td>2</td>
                  <td>1012</td>
                    <td>10-12-2023</td>
                  <td>Savings </td>
                  <td>213</td>
                <td><a  href="" class="edit edit-color" data-toggle="tooltip" data-placement="top" title="edit" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a>
                    <a href="" class="delete delete-color" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you absolutely sure you want to delete?');"><i  class="ri-delete-bin-fill"></i> Delete</a>
					<a  href="" class="view view-color" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a>
					</td>
                </tr>
				  <tr >
                  <td>3</td>
                  <td>1013</td>
                   <td>10-12-2023</td>
                  <td>Savings </td>
                  <td>213</td>
                 <td><a  href="" class="edit edit-color" data-toggle="tooltip" data-placement="top" title="edit" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a>
                    <a href="" class="delete delete-color" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you absolutely sure you want to delete?');"><i  class="ri-delete-bin-fill"></i> Delete</a>
					<a  href="" class="view view-color" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a>
					</td>
                </tr>
				  <tr >
                  <td>4</td>
                  <td>1014</td>
                    <td>10-12-2023</td>
                  <td>Savings </td>
                  <td>213</td>
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
										
										
<!--end Receipt col-->
<!--Start Payment  col-->
                                        <div class="tab-pane" id="border-nav-4" role="tabpanel">
                                              <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Add Payment</h4>
                                    
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
                                                    <label for="basiInput" class="form-label">Credit Account</label>
                                                    <input type="text"  name="" class="form-control " required>
                                                </div>
                                            </div>
											
                                            <!--end col-->
                                             <div class="col-col-md-4 col-lg-4">
                                                <div>
                                                    <label for="labelInput" class="form-label">Payment method</label>
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
                                                    <label for="labelInput" class="form-label">Debit Account</label>
                                                   <input type="text"  name="" class="form-control " required>
                                                </div>
                                            </div>
                                            <!--end col-->
											 <div class="col-col-md-4 col-lg-4">
                                                <div>
                                                    <label for="labelInput" class="form-label">Amount</label>
                                                   <input type="text"  name="" class="form-control " required>
                                                </div>
                                            </div>
                                            <!--end col-->
											 <div class="col-col-md-4 col-lg-4">
                                                <div>
                                                    <label for="labelInput" class="form-label">Invoices</label>
                                                    <select class="form-select " name="" required>
                                                    <option selected="" >Select Invoices </option>
                                                   


                                                </select>
                                                </div>
                                            </div>
                                            <!--end col-->
											<div class="col-col-md-4 col-lg-4">
                                                <div>
                                                    <label for="labelInput" class="form-label"> Narration</label>
                                                     <input type="text" name="" class="form-control " required="">
                                                </div>
                                            </div>
											 <!--end col-->
											 <div class="col-col-md-4 col-lg-4">
                                                <div>
                                                    <label for="labelInput" class="form-label"> Total</label>
                                                     <input type="text" name="" readonly="" value="100" class="form-control " required="">
                                                </div>
                                            </div>
											 <!--end col-->
											 
											 <div class="col-col-md-4 col-lg-4">
                                                <div>
                                                    <label for="labelInput" class="form-label"> Amount in Words</label>
                                                     <input type="text" name="" class="form-control " required="">
                                                </div>
                                            </div>
											  <!--end col-->
											  
											  
											  <div class="col-col-md-4 col-lg-4">
                                                <div>
                                                    <label for="labelInput" class="form-label"> Print Cheque</label>
                                                     <input type="text" name="" class="form-control " required="">
                                                </div>
                                            </div>
											   <!--end col-->
											   
											   <div class="col-col-md-4 col-lg-4">
                                                <div>
                                                    <label for="labelInput" class="form-label"> Attach cheque copy</label>
                                                     <input type="file" name="" class="form-control " required="">
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
                                    <h4 class="card-title mb-0 flex-grow-1">View Payment</h4>
                                    
                                </div><!-- end card header -->
                                <div class="card-body">
                                    <table id="datatable" class="table table-bordered table-striped delTable">
             <thead>
                <tr>
                  <th class="no-sort">Sl no</th>
                  <th> Reference Number</th>
                  <th>Date</th>
                  <th>Credit Account</th>
				  <th> Payment method</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              
                
				  <tr >
                  <td>1</td>
                  <td>1011</td>
				    <td>10-12-2023</td>
                  <td>Savings </td>
                  <td>Cheque</td>
                <td><a  href="" class="edit edit-color" data-toggle="tooltip" data-placement="top" title="edit" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a>
                    <a href="" class="delete delete-color" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you absolutely sure you want to delete?');"><i  class="ri-delete-bin-fill"></i> Delete</a>
					<a  href="" class="view view-color" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a>
					</td>
                </tr>
				  <tr >
                  <td>2</td>
                  <td>1012</td>
                    <td>10-12-2023</td>
                  <td>Savings </td>
                  <td>Cheque</td>
               <td><a  href="" class="edit edit-color" data-toggle="tooltip" data-placement="top" title="edit" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a>
                    <a href="" class="delete delete-color" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you absolutely sure you want to delete?');"><i  class="ri-delete-bin-fill"></i> Delete</a>
					<a  href="" class="view view-color" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a>
					</td>
                </tr>
				  <tr >
                  <td>3</td>
                  <td>1013</td>
                   <td>10-12-2023</td>
                  <td>Savings </td>
                  <td>Cheque</td>
                <td><a  href="" class="edit edit-color" data-toggle="tooltip" data-placement="top" title="edit" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a>
                    <a href="" class="delete delete-color" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you absolutely sure you want to delete?');"><i  class="ri-delete-bin-fill"></i> Delete</a>
					<a  href="" class="view view-color" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a>
					</td>
                </tr>
				  <tr >
                  <td>4</td>
                  <td>1014</td>
                    <td>10-12-2023</td>
                  <td>Savings </td>
                  <td>Cheque</td>
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
										
										
<!--end Payment col-->
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
                                                    <label for="labelInput" class="form-label">Sales order No</label>
                                                    <select class="form-select " name="" required>
                                                    <option selected="" >Select  </option>
                                                    <option value="1">1   </option>
 <option value="2">2 </option>
 <option value="3">3 </option>
 <option value="4">4</option>


                                                </select>
                                                </div>
                                            </div>
                                            <!--end col-->
											<div class="col-col-md-4 col-lg-4">
                                                <div>
                                                    <label for="labelInput" class="form-label">Account</label>
                                                    <select class="form-select " name="" required>
                                                    <option selected="" >Select  </option>
                                                    


                                                </select>
                                                </div>
                                            </div>
                                            <!--end col-->
											  <div class="col-col-md-4 col-lg-4">
                                                <div>
                                                    <label for="basiInput" class="form-label">Debit</label>
                                                    <input type="text"  name="" class="form-control " required>
                                                </div>
                                            </div>
                                            <!--end col-->
											   <div class="col-col-md-4 col-lg-4">
                                                <div>
                                                    <label for="basiInput" class="form-label">Credit</label>
                                                    <input type="text"  name="" class="form-control " required>
                                                </div>
                                            </div>
                                            <!--end col-->
											  <div class="col-col-md-4 col-lg-4">
                                                <div>
                                                    <label for="basiInput" class="form-label">Narration</label>
                                                    <input type="text"  name="" class="form-control " required>
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
									<form action="#" method="post" class="Dashboard-form">
                                        <div class="row align-items-end">
										 <div class="col-col-md-4 col-lg-4">
                                                <div>
                                                    <label for="basiInput" class="form-label">Date</label>
                                                    <input type="date"  name="" class="form-control " required>
                                                </div>
                                            </div>
											    <!--end col-->
                                            <div class="col-col-md-4 col-lg-4">
                                                <div>
                                                    <label for="basiInput" class="form-label">Credit Account</label>
                                                    <select class="form-select " name="" required>
                                                    <option selected="" >Select  </option>
                                                


                                                </select>
                                                </div>
                                            </div>
											    <!--end col-->
											 <div class="col-col-md-4 col-lg-4">
                                                <div>
                                                    <label for="basiInput" class="form-label">Sales order No</label>
                                                    <select class="form-select " name="" required>
                                                    <option selected="" >Select  </option>
                                                


                                                </select>
                                                </div>
                                            </div>
                                            <!--end col-->
                                          <div class="col-col-md-4 col-lg-4">
                                                <div>
                                                    <label for="basiInput" class="form-label">Debit Account</label>
                                                    <select class="form-select " name="" required>
                                                    <option selected="" >Select  </option>
                                                


                                                </select>
                                                </div>
                                            </div>
											    <!--end col-->
												 <div class="col-col-md-4 col-lg-4">
                                                <div>
                                                    <label for="labelInput" class="form-label"> Amount </label>
                                                     <input type="text" name="" class="form-control " required="">
                                                </div>
                                            </div>
											  <!--end col-->
											 <div class="col-col-md-4 col-lg-4">
                                                <div>
                                                    <label for="labelInput" class="form-label"> Narration</label>
                                                     <input type="text" name="" class="form-control " required="">
                                                </div>
                                            </div>
											 <!--end col-->
											 <div class="col-col-md-4 col-lg-4">
                                                <div>
                                                    <label for="labelInput" class="form-label"> Total</label>
                                                     <input type="text" name=""  class="form-control " required="">
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
              
                
				  <tr >
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
				  <tr >
                  <td>2</td>
                  <td>1012</td>
                    <td>10-12-2023</td>
                  <td>Savings </td>
                  <td>212</td>
                <td><a  href="" class="edit edit-color" data-toggle="tooltip" data-placement="top" title="edit" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a>
                    <a href="" class="delete delete-color" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you absolutely sure you want to delete?');"><i  class="ri-delete-bin-fill"></i> Delete</a>
					<a  href="" class="view view-color" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a>
					</td>
                </tr>
				  <tr >
                  <td>3</td>
                  <td>1013</td>
                   <td>10-12-2023</td>
                  <td>Savings </td>
                  <td>213</td>
                 <td><a  href="" class="edit edit-color" data-toggle="tooltip" data-placement="top" title="edit" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a>
                    <a href="" class="delete delete-color" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you absolutely sure you want to delete?');"><i  class="ri-delete-bin-fill"></i> Delete</a>
					<a  href="" class="view view-color" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a>
					</td>
                </tr>
				  <tr >
                  <td>4</td>
                  <td>1014</td>
                    <td>10-12-2023</td>
                  <td>Savings </td>
                  <td>214</td>
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

<!--end Report col-->
 <div class="tab-pane " id="border-nav-7" role="tabpanel">
										
										 <div class="row">
  <div class="col-lg-12">
  
  <div class="card">
                                <div class="card-body">
                           <ul class="nav nav-tabs nav-border-top nav-border-top-primary mb-3" role="tablist">
                                        <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#nav-border-top-1-1" role="tab" aria-selected="true">Ledger </a></li>
                                        <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#nav-border-top-1-2" role="tab" aria-selected="false">Trial Balance, Profit & Loss, Balance Sheet</a> </li>
<li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#nav-border-top-1-3" role="tab" aria-selected="false">Fixed Asset Schedule</a> </li>
<li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#nav-border-top-1-4" role="tab" aria-selected="false">Accounts Receivable/Payable Summery</a> </li>
<li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#nav-border-top-1-5" role="tab" aria-selected="false">Customer/Vendor Statement</a> </li>
<li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#nav-border-top-1-6" role="tab" aria-selected="false">Ages Receivables/Payables</a> </li>
<li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#nav-border-top-1-7" role="tab" aria-selected="false">Bank reconciliation</a> </li>
<li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#nav-border-top-1-8" role="tab" aria-selected="false">Bank reconciliation statement</a> </li>
<li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#nav-border-top-1-9" role="tab" aria-selected="false">Year end transaction</a> </li>


                                     

									
                                     
                                    </ul>
									  </div>
										    </div>
											  </div>
											    </div>
									
									
									
									<div class="tab-content text-muted">
                                        <div class="tab-pane active" id="nav-border-top-1-1" role="tabpanel">
										<div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Add Ledger</h4>
                                    
                                </div><!-- end card header -->
                                <div class="card-body">
                                    <div class="live-preview">
									<form action="#" method="post" class="Dashboard-form">
                                        <div class="row align-items-end">
										 <div class="col-col-md-4 col-lg-4">
                                                <div>
                                                    <label for="basiInput" class="form-label">Select Account</label>
                                                   <select class="form-select " name="" required="">
                                                    <option selected="">Select  </option>
                                                


                                                </select>
                                                </div>
                                            </div>
											    <!--end col-->
                                            <div class="col-col-md-4 col-lg-4">
                                                <div>
                                                    <label for="basiInput" class="form-label">Date range</label>
													
													<div class="row">
													<div class="col-lg-6 col-md-6">
													 <input type="date" name="" class="form-control " required="">
													</div>
													<div class="col-lg-6 col-md-6">
													 <input type="date" name="" class="form-control " required="">
													</div>
													
													</div>
                                              
                                                </div>
                                            </div>
											    <!--end col-->
											 <div class="col-col-md-4 col-lg-4">
                                                <div>
                                                    <label for="basiInput" class="form-label">Date</label>
                                                   <input type="date" name="" class="form-control " required="">
                                                </div>
                                            </div>
                                            <!--end col-->
											 <div class="col-col-md-4 col-lg-4">
                                                <div>
                                                    <label for="basiInput" class="form-label">Voucher No</label>
                                                  <input type="text" name="" class="form-control " required="">
                                                </div>
                                            </div>
											    <!--end col-->
												 <div class="col-col-md-4 col-lg-4">
                                                <div>
                                                    <label for="basiInput" class="form-label">Voucher Type</label>
                                                  <input type="text" name="" class="form-control " required="">
                                                </div>
                                            </div>
											    <!--end col-->
                                        
												 <div class="col-col-md-4 col-lg-4">
                                                <div>
                                                    <label for="labelInput" class="form-label"> Related Account </label>
                                                     <input type="text" name="" class="form-control " required="">
                                                </div>
                                            </div>
											  <!--end col-->
											 <div class="col-col-md-4 col-lg-4">
                                                <div>
                                                    <label for="labelInput" class="form-label"> Debit</label>
                                                     <input type="text" name="" class="form-control " required="">
                                                </div>
                                            </div>
											 <!--end col-->
											 <div class="col-col-md-4 col-lg-4">
                                                <div>
                                                    <label for="labelInput" class="form-label"> Credit</label>
                                                     <input type="text" name="" class="form-control " required="">
                                                </div>
                                            </div>
											 <!--end col-->
											 
											 <div class="col-col-md-4 col-lg-4">
                                                <div>
                                                    <label for="labelInput" class="form-label"> Balance </label>
                                                     <input type="text" name="" class="form-control " required="">
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
                                    <h4 class="card-title mb-0 flex-grow-1">View Ledger</h4>
                                    
                                </div><!-- end card header -->
                                <div class="card-body">
                                    <table id="datatable" class="table table-bordered table-striped delTable">
             <thead>
                <tr>
                  <th class="no-sort">Sl no</th>
                  <th> Account</th>
                  <th>Date range</th>
				  <th>Date </th>
                  <th>Voucher No</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              
                <tr>
                  <td>1</td>
                  <td>Savings</td>
                  <td>10-12-2023 - 12-12-2023 </td>
                  <td>12-12-2023</td>
				   <td>1</td>
                 <td><a  href="" class="edit edit-color" data-toggle="tooltip" data-placement="top" title="edit" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a>
                    <a href="" class="delete delete-color" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you absolutely sure you want to delete?');"><i  class="ri-delete-bin-fill"></i> Delete</a>
					<a  href="" class="view view-color" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a>
					</td>
                </tr>
				
				  <tr>
                  <td>2</td>
                  <td>Savings</td>
                  <td>10-12-2023 - 12-12-2023 </td>
                  <td>12-12-2023</td>
				   <td>1</td>
                 <td><a  href="" class="edit edit-color" data-toggle="tooltip" data-placement="top" title="edit" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a>
                    <a href="" class="delete delete-color" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you absolutely sure you want to delete?');"><i  class="ri-delete-bin-fill"></i> Delete</a>
					<a  href="" class="view view-color" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a>
					</td>
                </tr>
				  <tr>
                  <td>3</td>
                 <td>Savings</td>
                  <td>10-12-2023 - 12-12-2023 </td>
                  <td>12-12-2023</td>
				   <td>1</td>
                <td><a  href="" class="edit edit-color" data-toggle="tooltip" data-placement="top" title="edit" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a>
                    <a href="" class="delete delete-color" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you absolutely sure you want to delete?');"><i  class="ri-delete-bin-fill"></i> Delete</a>
					<a  href="" class="view view-color" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a>
					</td>
                </tr>
				  <tr>
                  <td>4</td>
               <td>Savings</td>
                  <td>10-12-2023 - 12-12-2023 </td>
                  <td>12-12-2023</td>
				   <td>1</td>
               <td><a  href="" class="edit edit-color" data-toggle="tooltip" data-placement="top" title="edit" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a>
                    <a href="" class="delete delete-color" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you absolutely sure you want to delete?');"><i  class="ri-delete-bin-fill"></i> Delete</a>
					<a  href="" class="view view-color" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a>
					</td>
                </tr>
				  <tr>
                  <td>5</td>
                  <td>Savings</td>
                  <td>10-12-2023 - 12-12-2023 </td>
                  <td>12-12-2023</td>
				   <td>1</td>
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
										
										
                                        <div class="tab-pane" id="nav-border-top-1-2" role="tabpanel">
										<div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Add Trial Balance, Profit & Loss, Balance Sheet</h4>
                                    
                                </div><!-- end card header -->
                                <div class="card-body">
                                    <div class="live-preview">
									<form action="#" method="post" class="Dashboard-form">
                                        <div class="row align-items-end">
                                           <div class="col-col-md-4 col-lg-4">
                                                <div>
                                                    <label for="basiInput" class="form-label">Date range</label>
													
													<div class="row">
													<div class="col-lg-6 col-md-6">
													 <input type="date" name="" class="form-control " required="">
													</div>
													<div class="col-lg-6 col-md-6">
													 <input type="date" name="" class="form-control " required="">
													</div>
													
													</div>
                                              
                                                </div>
                                            </div>
											
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
                                    <h4 class="card-title mb-0 flex-grow-1">View Trial Balance, Profit & Loss, Balance Sheet</h4>
                                    
                                </div><!-- end card header -->
                                <div class="card-body">
                                    <table id="datatable" class="table table-bordered table-striped delTable">
             <thead>
                <tr>
                  <th class="no-sort">Sl no</th>
                  <th>date range</th>
                  <th>Account</th>
                  <th> Beginning Balance</th>
				   <th> Debit Change</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              
                <tr>
                  <td>1</td>
                 <td>10-12-2023 - 12-12-2023 </td>
                  <td>Doha Bank 222-247380-01-10-00 </td>
                  <td>738.51</td>
				   <td>(500.00)</td>
                <td><a  href="" class="edit edit-color" data-toggle="tooltip" data-placement="top" title="edit" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a>
                    <a href="" class="delete delete-color" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you absolutely sure you want to delete?');"><i  class="ri-delete-bin-fill"></i> Delete</a>
					<a  href="" class="view view-color" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a>
					</td>
                </tr>
				
				  <tr>
                  <td>2</td>
                  <td>10-12-2023 - 12-12-2023 </td>
                 <td>Doha Bank 222-247380-01-10-00 </td>
                  <td>738.51</td>
				   <td>(500.00)</td>
               <td><a  href="" class="edit edit-color" data-toggle="tooltip" data-placement="top" title="edit" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a>
                    <a href="" class="delete delete-color" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you absolutely sure you want to delete?');"><i  class="ri-delete-bin-fill"></i> Delete</a>
					<a  href="" class="view view-color" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a>
					</td>
                </tr>
				  <tr>
                  <td>3</td>
                 <td>10-12-2023 - 12-12-2023 </td>
                  <td>Doha Bank 222-247380-01-10-00 </td>
                  <td>738.51</td>
				   <td>(500.00)</td>
                 <td><a  href="" class="edit edit-color" data-toggle="tooltip" data-placement="top" title="edit" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a>
                    <a href="" class="delete delete-color" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you absolutely sure you want to delete?');"><i  class="ri-delete-bin-fill"></i> Delete</a>
					<a  href="" class="view view-color" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a>
					</td>
                </tr>
				  <tr>
                  <td>4</td>
                  <td>10-12-2023 - 12-12-2023 </td>
                 <td>Doha Bank 222-247380-01-10-00 </td>
                  <td>738.51</td>
				   <td>(500.00)</td>
                <td><a  href="" class="edit edit-color" data-toggle="tooltip" data-placement="top" title="edit" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a>
                    <a href="" class="delete delete-color" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you absolutely sure you want to delete?');"><i  class="ri-delete-bin-fill"></i> Delete</a>
					<a  href="" class="view view-color" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a>
					</td>
                </tr>
				  <tr>
                  <td>5</td>
                <td>10-12-2023 - 12-12-2023 </td>
                  <td>Doha Bank 222-247380-01-10-00 </td>
                  <td>738.51</td>
				   <td>(500.00)</td>
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
									  
	 <div class="tab-pane" id="nav-border-top-1-3" role="tabpanel">

                                      

									  </div>
									   <div class="tab-pane" id="nav-border-top-1-4" role="tabpanel">
									   <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Add Accounts Receivable/Payable Summery </h4>
                                    
                                </div><!-- end card header -->
                                <div class="card-body">
                                    <div class="live-preview">
									<form action="#" method="post" class="Dashboard-form">
                                        <div class="row align-items-end">
                                           
                                             <div class="col-col-md-4 col-lg-4">
                                                <div>
                                                    <label for="labelInput" disabled="" class="form-label"> Account Type</label>
                                                    <select class="form-select" name="atype" required="">
                                                    <option selected="">Select </option>
                                                   

                                                </select>
                                                </div>
                                            </div>
                                            <!--end col-->
											 <div class="col-col-md-4 col-lg-4">
                                                <div>
                                                    <label for="basiInput" class="form-label">Date</label>
                                                    <input type="date" name="" class="form-control " required="">
                                                </div>
                                            </div>
                                            <!--end col-->
											 <div class="col-col-md-4 col-lg-4">
                                                <div>
                                                    <label for="basiInput" class="form-label">Select</label>
                                                    <select class="form-select" name="" required="">
                                                  
                                                   <option selected="">Receivable </option>
												   <option selected="">Payable </option>
												   <option selected="">Both </option>

                                                </select>
                                                </div>
                                            </div>
                                            <!--end col-->
											 <!--end col-->
											 <div class="col-col-md-4 col-lg-4">
                                                <div>
                                                    <label for="basiInput" class="form-label">Customer/Vendor Name</label>
                                                    <input type="text" name="" class="form-control " required="">
                                                </div>
                                            </div>
                                            <!--end col-->
											 <div class="col-col-md-4 col-lg-4">
                                                <div>
                                                    <label for="basiInput" class="form-label">Balance</label>
                                                    <input type="text" name="" class="form-control " required="">
                                                </div>
                                            </div>
                                            <!--end col-->
											 <div class="col-col-md-4 col-lg-4">
                                                <div>
                                                    <label for="basiInput" class="form-label">Age Analysis</label>
                                                    <input type="text" name="" class="form-control " required="">
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
                                    <h4 class="card-title mb-0 flex-grow-1">View Accounts Receivable/Payable Summery</h4>
                                    
                                </div><!-- end card header -->
                                <div class="card-body">
                                    <table id="datatable" class="table table-bordered table-striped delTable">
             <thead>
                <tr>
                  <th class="no-sort">Sl no</th>
                 
                  <th>Account Type</th>
                  <th>Date </th>
				   <th>Receivable / Payable / Both </th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              
              
				  <tr>
                  <td>1</td>
                 
                 
                  <td>Accounts Receivable</td>
				   <td>10-12-2023 </td>
				   <td> Receivable</td>
                  <td><a href="" class="edit edit-color" data-toggle="tooltip" data-placement="top" title="edit" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a>
                    <a href="" class="delete delete-color" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you absolutely sure you want to delete?');"><i class="ri-delete-bin-fill"></i> Delete</a>
					<a href="" class="view view-color" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a>
					</td>
                </tr>
				
				  <tr>
                 
                  <td>2</td>
                  <td>Accounts Receivable</td>
				   <td>10-12-2023 </td>
				   <td> Receivable</td>
                 <td><a href="" class="edit edit-color" data-toggle="tooltip" data-placement="top" title="edit" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a>
                    <a href="" class="delete delete-color" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you absolutely sure you want to delete?');"><i class="ri-delete-bin-fill"></i> Delete</a>
					<a href="" class="view view-color" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a>
					</td>
                </tr>
				  <tr>
                  
                  <td>3</td>
                 <td>Accounts Receivable</td>
				   <td>10-12-2023 </td>
				   <td> Receivable</td>
                <td><a href="" class="edit edit-color" data-toggle="tooltip" data-placement="top" title="edit" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a>
                    <a href="" class="delete delete-color" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you absolutely sure you want to delete?');"><i class="ri-delete-bin-fill"></i> Delete</a>
					<a href="" class="view view-color" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a>
					</td>
                </tr>
				  <tr>
                 
                  <td>4</td>
                 <td>Accounts Receivable</td>
				   <td>10-12-2023 </td>
				   <td> Receivable</td>
                 <td><a href="" class="edit edit-color" data-toggle="tooltip" data-placement="top" title="edit" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a>
                    <a href="" class="delete delete-color" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you absolutely sure you want to delete?');"><i class="ri-delete-bin-fill"></i> Delete</a>
					<a href="" class="view view-color" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a>
					</td>
                </tr>
                <tr>
                  
                  <td>5</td>
                <td>Accounts Receivable</td>
				   <td>10-12-2023 </td>
				   <td> Receivable</td>
                 <td><a href="" class="edit edit-color" data-toggle="tooltip" data-placement="top" title="edit" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a>
                    <a href="" class="delete delete-color" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you absolutely sure you want to delete?');"><i class="ri-delete-bin-fill"></i> Delete</a>
					<a href="" class="view view-color" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a>
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
									  <div class="tab-pane" id="nav-border-top-1-5" role="tabpanel">
									   
									   
									   </div>
									   <div class="tab-pane" id="nav-border-top-1-6" role="tabpanel">
									   
									   
									   </div>

                                       
                                     
                                    </div><!-- end tab -->
                                           
                                        </div>
										
										
<!--end Reports col-->





										
										
										
										
										
                                      
                                    </div>
                   

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

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

            <!--footer section start-->

            <?php echo view('includes/footer'); ?>

            <!--footer section end-->



            <!---add account type section start-->

            <script>
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
            </script>

            <!--add account type section end-->


            <!--account type modal section start--> 
            <script>

                
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

            </script>
            <!--account type modal section end-->

            <!--account type edit section start-->

            <script>
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
            </script>

            <!--account type edit section end-->


            <!--account type delete section start-->

            <script>
                
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
            </script>

            <!--accoiunt type delete section end-->
            
	
	
	
</body>



</html>