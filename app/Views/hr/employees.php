<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">



<head>

    <meta charset="utf-8" />
    <title><?php echo site_title//Defined in app/constants ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />
    <meta content="" name="author" />




    <style>

        #ViewModal th
        {
            color:#000000b5 !important;
        }

        #ViewModal td
        {
            color:black !important;
            font-weight:600;
        }

        .sec_btn,.sec_btn_edit
        {

        background: none;
        padding: 10px;

        }

        .sec_btn.active,.sec_btn_edit.active
        {

        background:#e0dbdb !important;

        }

       

    </style>
    
       
    <!--header section start-->

    <?php echo view('includes/header');?>

    <!--header section end-->


        
    <!--sidebar section start-->

    <?php echo view('includes/sidebar'); ?>

    <!--sidebar section end-->

    
    <!-- Vertical Overlay-->
    <div class="vertical-overlay"></div>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                
                <!--tab menu section start--> 

                <?php echo view('hr/sub_header');?>  

				<!--tab menu section end-->			
                                    
                <div class="tab-content text-muted">
                                       

                
                
                <section id="ajax_container">




									
<div class="tab-pane active" id="border-nav-1" role="tabpanel">


    <!-- Add Modal -->


    <div class="modal fade" id="AddModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
            
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


            <div class="row align-items-center">

            <div class="col-6 mx-auto text-center">

            <button class="sec_btn active" data-sec="employee_sec">Employee</button>
            
            <button class="sec_btn" data-sec="salary_sec">Salary</button>
            
            <button class="sec_btn" data-sec="document_sec">Documents</button>

            </div>

            </div>


    <div class="row">


<div class="col-lg-12">
    
    <div class="card">
       
        <div class="card-body">

            <div class="live-preview">


                    <form  class="Dashboard-form class add_form" data-empid="" id="add_form">
                    <input class="added_id" type="hidden" name="emp_id" value="" autocomplete="off">
            
                    <div class="row align-items-start form_sec" id="employee_sec">

                    <!-- Section 1 -->

                    <div class="col-lg-6">



                    <div class="row align-items-center mb-2">

                    <div class="col-col-md-3 col-lg-3">

                    <label for="basiInput" class="form-label">Employee Name</label>

                    </div>

                    <div class="col-col-md-9 col-lg-9">

                    <input type="text" name="employee_name"  class="form-control" required>

                    </div>

                    </div>



                    <div class="row align-items-center mb-2" id="add_ah_parent">

                    <div class="col-col-md-3 col-lg-3">
                        <label for="basicInput" class="form-label">Account Head</label>
                    </div>

                    <div class="col-col-md-9 col-lg-9">
                        <select class="form-select  account_head_clz add_account_head_select" name="account_head"  required>


                        </select>
                        
                    </div>

                    </div> 
                    



                    <div class="row align-items-center mb-2">

                    <div class="col-col-md-3 col-lg-3">
                           
                            <label for="basiInput" class="form-label">Account Id</label>

                    </div>

                        <div class="col-col-md-9 col-lg-9">

                        <input type="text" name="account_id" value="" class="form-control account_id" required readonly>

                        </div>

                        </div>



                        <div class="row align-items-center mb-2">

                        <div class="col-col-md-3 col-lg-3">

                            <label for="basiInput" class="form-label">Employee ID</label>
                            <!--<input type="text"  name="r_debit_account" class="form-control" required>-->

                        </div>


                        <div class="col-col-md-9 col-lg-9">

                        <input id="employee_id_check" type="text" class="form-control" name="employee_id" required>

                        </div>


                        </div> 




                         <div class="row align-items-center mb-2">

                            <div class="col-col-md-3 col-lg-3">

                            <label for="basiInput" class="form-label">Date of Join</label>
                            
                         </div>

                        <div class="col-col-md-9 col-lg-9">

                        <input type="text"  name="date_of_join" class="form-control datepicker" required reaonly autocomplete="off">

                        </div>

                        </div>



                        <div class="row align-items-center mb-2">

                        <div class="col-col-md-3 col-lg-3">

                        <label for="basiInput" class="form-label">Designation</label>

                        </div>

                        <div class="col-col-md-9 col-lg-9">

                        <input type="text"  name="designation" class="form-control" required>

                        </div>

                        </div>



                        <div class="row align-items-center mb-2">

                        <div class="col-col-md-3 col-lg-3">

                        <label for="basiInput" class="form-label">Nationality</label>

                        </div>

                        <div class="col-col-md-9 col-lg-9">

                        <input type="text" name="nationality" class="form-control" required>

                        </div>

                        </div>



                    </div> <!-- Section 1 end -->



                    <div class="col-lg-6">

                    <div class="row align-items-center mb-2">

                    <div class="col-col-md-3 col-lg-3">

                    <label for="basiInput" class="form-label">Contact Number</label>

                    </div>

                    <div class="col-col-md-9 col-lg-9">

                    <input type="text"  name="contact_number" class="form-control" required>

                    </div>

                    </div>




                    <div class="row align-items-center mb-2">

                <div class="col-col-md-3 col-lg-3">

                <label for="basiInput" class="form-label">Home Country Contact</label>

                </div>

                <div class="col-col-md-9 col-lg-9">

                <input type="text"  name="country_contact" class="form-control" required>

                </div>

                </div>





                <div class="row align-items-center mb-2">

                <div class="col-col-md-3 col-lg-3">

                <label for="basiInput" class="form-label">Picture</label>

                </div>

                <div class="col-col-md-9 col-lg-9">

                <input type="file"  name="photo" class="form-control" required>

                </div>

                </div>





                <div class="row align-items-center mb-2">

                <div class="col-col-md-3 col-lg-3">

                <label for="basiInput" class="form-label">Division</label>

                </div>

                <div class="col-col-md-9 col-lg-9">

                <select class="form-control" name="division" required>

                <option value="">Select Division</option>

                <?php foreach($divisions as $division){ ?>

                    <option value="<?= $division->div_id; ?>"><?= $division->div_name; ?></option>

                <?php } ?>

                </select>

                </div>

                </div>





                <div class="row align-items-center mb-2">

                    <div class="col-col-md-3 col-lg-3">

                    <label for="basiInput" class="form-label">Status</label>

                    </div>

                    <div class="col-col-md-9 col-lg-9">

                    <select class="form-control" name="status" required>

                    <option value="">Select Status</option>

                    <option value="Active">Active</option>

                    <option value="Resigned">Resigned</option>

                    <option value="Terminated">Terminated</option>

                    </select>

                    </div>

                </div>




                  

                    </div>




                    <div class="row">



                    <div class="col-lg-6">


                    </div>


                    <div class="col-lg-6">


                    <div style="float: right;">
                                                <table class="table table-bordered table-striped enq_tab_submit menu">
                                                
                                                    <tr>
                                                        <td><button class="submit_btn" type="submit">Save</button></td>
                                                
                                                    </tr>
                                                    
                                                </table>
                    </div>


                    </div>


                    </div>



       
                    </div>

                    </form>





                    <!-- Salary Section Start  -->


                    <form  class="Dashboard-form class add_form" data-empid="" id="salary_add_form">

                    <input class="added_id" type="hidden" name="emp_id" value="" autocomplete="off">

                    <div class="row align-items-start form_sec" id="salary_sec" style="display:none;">

                    <div class="col-lg-6">

                        <div class="row align-items-center mb-2">

                        <div class="col-col-md-3 col-lg-3">

                        <label for="basiInput" class="form-label">Basic Salary</label>

                        </div>

                        <div class="col-col-md-9 col-lg-9">

                        <input type="number"  name="basic_salary" class="form-control sal_calc" step=".01" min="0" required>

                        </div>

                        </div>


                        <div class="row align-items-center mb-2">

                        <div class="col-col-md-3 col-lg-3">

                        <label for="basiInput" class="form-label">House Rent Allowance</label>

                        </div>

                        <div class="col-col-md-9 col-lg-9">

                        <input type="number"  name="house_rent_allow" class="form-control sal_calc" step=".01" min="0" required>

                        </div>

                        </div>


                        <div class="row align-items-center mb-2">

                        <div class="col-col-md-3 col-lg-3">

                        <label for="basiInput" class="form-label">Transportation Allowance</label>

                        </div>

                        <div class="col-col-md-9 col-lg-9">

                        <input type="number"  name="transport_allow" class="form-control sal_calc" step=".01" min="0" required>

                        </div>

                        </div>


                        <div class="row align-items-center mb-2">

                        <div class="col-col-md-3 col-lg-3">

                        <label for="basiInput" class="form-label">Telephone Allowance</label>

                        </div>

                        <div class="col-col-md-9 col-lg-9">

                        <input type="number"  name="telephone_allow" class="form-control sal_calc" step=".01" min="0" required>

                        </div>

                        </div>


                        <div class="row align-items-center mb-2">

                        <div class="col-col-md-3 col-lg-3">

                        <label for="basiInput" class="form-label">Food Allowance</label>

                        </div>

                        <div class="col-col-md-9 col-lg-9">

                        <input type="number"  name="food_allowance" class="form-control sal_calc" step=".01" min="0" required>

                        </div>

                        </div>


                        <div class="row align-items-center mb-2">

                        <div class="col-col-md-3 col-lg-3">

                        <label for="basiInput" class="form-label">Other Allowance</label>

                        </div>

                        <div class="col-col-md-9 col-lg-9">

                        <input type="number"  name="other_allow" class="form-control sal_calc" step=".01" min="0" required>

                        </div>

                        </div>


                        <div class="row align-items-center mb-2">

                        <div class="col-col-md-3 col-lg-3">

                        <label for="basiInput" class="form-label">Total Salary</label>

                        </div>

                        <div class="col-col-md-9 col-lg-9">

                        <input id="add_total_salary" type="number"  name="total_salary" class="form-control" step=".01" min="0" required readonly>

                        </div>

                        </div>



                    </div>


                    <div class="col-lg-6">

                        <div class="row align-items-center mb-2">

                        <div class="col-col-md-3 col-lg-3">

                        <label for="basiInput" class="form-label">Mode Of Payment</label>

                        </div>

                        <div class="col-col-md-9 col-lg-9">

                        <select id="mop_add" class="form-control" name="mode_of_payment" required>

                        <option value="" >Select Mode Of Payment</option>

                        <?php foreach($mops as $mop){ ?>

                            <option value="<?= $mop->mop_id; ?>" ><?= $mop->mop_title; ?></option>

                        <?php } ?>


                        </select>

                        </div>

                        </div>




                        <div class="row align-items-center mb-2 bank_sec_add" style="display:none;">

                        <div class="col-col-md-3 col-lg-3">

                        <label for="basiInput" class="form-label">Account Number</label>

                        </div>

                        <div class="col-col-md-9 col-lg-9">

                        <input type="text" name="account_number" class="form-control">

                        </div>

                        </div>



                        <div class="row align-items-center mb-2 bank_sec_add" style="display:none;">

                        <div class="col-col-md-3 col-lg-3">

                        <label for="basiInput" class="form-label">Bank</label>

                        </div>

                        <div class="col-col-md-9 col-lg-9">

                        <input type="text" name="bank_name" class="form-control">

                        </div>

                        </div>



                        <div class="row align-items-center mb-2">

                        <div class="col-col-md-3 col-lg-3">

                        <label for="basiInput" class="form-label">Air Ticket Per Year</label>

                        </div>

                        <div class="col-col-md-9 col-lg-9">

                        <input type="text"  name="air_ticket_per_year" class="form-control" required>

                        </div>

                        </div>



                        <div class="row align-items-center mb-2">

                        <div class="col-col-md-3 col-lg-3">

                        <label for="basiInput" class="form-label">Budgeted Ticket Amount</label>

                        </div>

                        <div class="col-col-md-9 col-lg-9">

                        <input type="text"  name="budgeted_air_ticket" class="form-control" required>

                        </div>

                        </div>



                        <div class="row align-items-center mb-2">

                        <div class="col-col-md-3 col-lg-3">

                        <label for="basiInput" class="form-label">Vacation Taken</label>

                        </div>

                        <div class="col-col-md-9 col-lg-9">

                        <input type="number"  name="vacation_taken" class="form-control" required>

                        </div>

                        </div>



                        <div class="row align-items-center mb-2">

                        <div class="col-col-md-3 col-lg-3">

                        <label for="basiInput" class="form-label">Air Ticket Due From</label>

                        </div>

                        <div class="col-col-md-9 col-lg-9">

                        <input type="date" onclick="this.showPicker();" name="air_ticket_due_from" class="form-control" required>

                        </div>


                        </div>



                        <div class="row align-items-center mb-2">

                        <div class="col-col-md-3 col-lg-3">

                        <label for="basiInput" class="form-label">Vacation Pay Due From</label>

                        </div>

                        <div class="col-col-md-9 col-lg-9">

                        <input type="date" onclick="this.showPicker();" name="vacation_pay_due_from" class="form-control" required>

                        </div>

                        </div>



                        <div class="row align-items-center mb-2">

                        <div class="col-col-md-3 col-lg-3">

                        <label for="basiInput" class="form-label">Indemnity Advance</label>

                        </div>

                        <div class="col-col-md-9 col-lg-9">

                        <input type="number" step="0.01" name="indemnity_advance" class="form-control" required>

                        </div>

                        </div>



                        <div class="row align-items-center mb-2">

                        <div class="col-col-md-3 col-lg-3">

                        <label for="basiInput" class="form-label">ID Charges Deduction</label>

                        </div>

                        <div class="col-col-md-9 col-lg-9">

                        <input type="number" step="0.01" name="id_charges_deduction" class="form-control" required>

                        </div>

                        </div>



                        





                    </div>





                            <div class="row">



                            <div class="col-lg-6">


                            </div>


                            <div class="col-lg-6">


                            <div style="float: right;">
                                                        <table class="table table-bordered table-striped enq_tab_submit menu">
                                                        
                                                            <tr>
                                                                <td><button class="submit_btn" type="submit">Save</button></td>
                                                        
                                                            </tr>
                                                            
                                                        </table>
                            </div>


                            </div>


                            </div>







                    </div>



                </form>


                <!-- Salary Section End  -->











                <!-- Document Section Start  -->


                <form  class="Dashboard-form class add_form" data-empid="" id="document_add_form">

<input class="added_id" type="hidden" name="emp_id" value="" autocomplete="off">

    <div class="row align-items-start form_sec" id="document_sec" style="display:none;">

    <div class="col-lg-12">

    <div class="row align-items-center mb-2">

    <div class="col-col-md-3 col-lg-3">

    <label for="basiInput" class="form-label">Passport Number & Expiry</label>

    </div>

    <div class="col-col-md-3 col-lg-3">

    <input type="text"  name="passport_no" class="form-control" placeholder="Passport Number"  required>

    </div>

    <div class="col-col-md-3 col-lg-3">

    <input type="text"  name="passport_expiry" class="form-control datepicker" placeholder="Passport Expiry" required readonly>

    </div>


    <div class="col-col-md-3 col-lg-3">

    <input type="file"  name="passport_file" class="form-control" required>

    </div>

    </div>




<div class="row align-items-center mb-2">

<div class="col-col-md-3 col-lg-3">

<label for="basiInput" class="form-label">Visa Number & Expiry</label>

</div>

<div class="col-col-md-3 col-lg-3">

<input type="text"  name="visa_no" class="form-control" placeholder="Visa Number"  required>

</div>

<div class="col-col-md-3 col-lg-3">

<input type="text"  name="visa_expiry" class="form-control datepicker" placeholder="Visa Expiry" required readonly>

</div>


<div class="col-col-md-3 col-lg-3">

<input placeholder="Visa File" type="file"  name="visa_file" class="form-control" required>

</div>

</div>







<div class="row align-items-center mb-2">

<div class="col-col-md-3 col-lg-3">

<label for="basiInput" class="form-label">Qatar ID & Expiry</label>

</div>

<div class="col-col-md-3 col-lg-3">

<input type="text"  name="qatar_id" class="form-control" placeholder="Qatar ID"  required>

</div>

<div class="col-col-md-3 col-lg-3">

<input type="text"  name="qid_expiry" class="form-control datepicker" placeholder="Qatar ID Expiry" required readonly>

</div>


<div class="col-col-md-3 col-lg-3">

<input placeholder="Qatar ID File" type="file"  name="qid_file" class="form-control" required>

</div>

</div>



<div class="row align-items-center justify-content-start mb-2">

<div class="col-col-md-3 col-lg-3">

<label for="basiInput" class="form-label">Contract & Expiry</label>

</div>

<div class="col-col-md-3 col-lg-3">

<input type="text"  name="contract_expiry" class="form-control datepicker" placeholder="Contract Expiry" required readonly>

</div>


<div class="col-col-md-3 col-lg-3">

<input placeholder="Contract File" type="file"  name="contract_file" class="form-control" required>

</div>

</div>


   

        </div>



        <div class="row">



        <div class="col-lg-6">


        </div>


        <div class="col-lg-6">


        <div style="float: right;">
                                    <table class="table table-bordered table-striped enq_tab_submit menu">
                                    
                                        <tr>
                                            <td><button class="submit_btn" type="submit">Save</button></td>
                                    
                                        </tr>
                                        
                                    </table>
        </div>


        </div>


        </div>







</div>



</form>


        <!-- Document Section End  -->













                        
                        
                    </div>
                    <!--end row-->








                
            </div>
            
        </div>
    </div>
</div>

<!--end col-->
</div>

</div>
            <!--                                    
            <div class="modal-footer justify-content-center">
                <button  class="btn btn btn-success">Save</button>
            </div>
            -->

        </div>
        </form>

    </div>
</div>

 <!-- Add Modal End -->






 <!-- View Modal Start -->

   <div class="modal fade" id="ViewModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
            
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body mx-5">



    <div class="row">
        

    <table class="table table-bordered">

            <tbody>

            <tr>

            <th colspan="5" style="font-size:20px;font-weight:bold;text-align:center">Employee Details</th>

            </tr>

            <tr>

            <td colspan="2" id="view_employee_id" valign="middle" style="font-size:35px;"></td>

            <td colspan="2" id="view_name" valign="middle" style="font-size:35px;"></td>

            <td colspan="" align="right">

            <img id="view_image" src="" height="150" width="150">

            </td>


            </tr>

         
            <tr>

            <th>Contact Number</th>

            <td colspan="2" id="view_contact_no"></td>


            <th>Home Country Contact</th>

            <td colspan="2" id="view_home_contact"></td>


            </tr>




            <tr>

            <th>Division</th>

<td colspan="2" id="view_division"></td>


            <th>Date Of Join</th>

            <td colspan="2"  id="view_doj"></td>


            </tr>


            <tr>

            <th>Designation</th>

            <td colspan="2"  id="view_designation"></td>


            <th>Nationality</th>

            <td colspan="2" id="view_nationality"></td>


            </tr>




            <tr>

                        
            <th colspan="5" style="font-size:20px;font-weight:bold;text-align:center">Salary Details</th>
                    

            </tr>




            <tr>

            <th>Basic Salary</th>

            <td colspan="2" id="view_basic_salary"></td>


            <th>Mode Of Payment</th>

            <td colspan="2" id="view_mop"></td>


            </tr>


            <tr>

            <th>House Rent Allowance</th>

            <td colspan="2" id="view_hra"></td>


            <th>Account Number</th>

            <td colspan="2" id="view_account_no"></td>


            </tr>


            <tr>

            <th>Transportation Allowance</th>

            <td colspan="2" id="view_transport_allow"></td>


            <th>Bank</th>

            <td colspan="2" id="view_bank"></td>


            </tr>


            <tr>

            <th>Telephone Allowance</th>

            <td colspan="2" id="view_tel_allow"></td>


            <th>Air Ticket Per Year</th>

            <td colspan="2" id="view_air_ticket"></td>


            </tr>


            <tr>

            <th>Food Allowance</th>

            <td colspan="2" id="view_food_allowance"></td>


            <th>Budgeted Ticket Amount</th>

            <td colspan="2" id="view_budgeted_ticket_amount"></td>


            </tr>





            <tr>

            <th>Vacation Taken</th>

            <td colspan="2" id="view_vacation_taken"></td>


            <th>Air Ticket Due From</th>

            <td colspan="2" id="view_air_ticket_due_from"></td>


            </tr>



            <tr>

            <th>Vacation Pay Due From</th>

            <td colspan="2" id="view_vacation_pay_due_from"></td>

            <th>Indemnity Advance</th>

            <td colspan="2" id="view_indemnity_advance"></td>

            </tr>





           <tr>

            <th>Other Allowance</th>

            <td colspan="2" id="view_other_allowance"></td>


            <th>Total Salary</th>

            <td colspan="2" id="view_total_salary"></td>


            </tr>



            <tr>

            <th colspan="5" style="font-size:20px;font-weight:bold;text-align:center">Documents</th>

            </tr>


                <tr>

                    <th>Passport No</th>

                    <td colspan="2" id="view_passport_no"></td>

                    <th>Passport File</th>

                    <td colspan="2" id="">

                    <a href="" id="view_passport_file" target="_blank">View</a>

                    </td>


                </tr>


                <tr>

                <th>Passport Expiry</th>

                <td colspan="2" id="view_passport_expiry">

                    

                </td>

                </tr>



                <tr>

                <th>Visa Number</th>

                <td colspan="2" id="view_visa_no"></td>


                <th>Visa File</th>

                <td colspan="2" id="">
                    <a href="" id="view_visa_file" target="_blank">View</a>
                </td>


                </tr>


                <tr>

                <th>Visa Expiry</th>

                <td colspan="2" id="view_visa_expiry"></td>

                
                </td>


                </tr>


                <tr>

                <th>Qatar ID Number</th>

                <td colspan="2" id="view_qid_no"></td>


                <th>Qatar ID File</th>

                <td colspan="2" id="">
                    <a href="" id="view_qatar_id_file" target="_blank">View</a>
                </td>

                </tr>



                <tr>

                <th>Qatar ID Expiry</th>

                <td colspan="2" id="view_qid_expiry"></td>


                </tr>


                <tr>

                <th>Contract</th>

                <td colspan="2" id="">

                <a href="" id="view_contract" target="_blank">View</a>

                </td>

                <th>Contract Expiry</th>

                <td colspan="2" id="view_contract_expiry"></td>

                </tr>



            </tbody>


    </table>














    </div>

<!--end col-->
</div>

</div>
            <!--                                    
            <div class="modal-footer justify-content-center">
                <button  class="btn btn btn-success">Save</button>
            </div>
            -->

        </div>
        </form>

    </div>
</div>


 <!-- View Modal End -->





    <!-- ### -->

    
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">View Employees</h4>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#AddModal" class="btn btn-primary py-1 add_model_btn">Add</button>
                </div><!-- end card header -->
                <div class="card-body" id="account_type_id">
                        <!-- CSRF token --> 
                    <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <table id="accountTable" class="table table-bordered table-striped delTable display dataTable">
                        <thead>
                            <tr>
                                <th class="no-sort">Sl no</th>
                                <th>Employee ID</th>
                                <th>Name</th>
                                <th>Division</th>
                                <th>Designation</th>
                                <th>Date Of Join</th>
                                <th>Contract Expiry</th>
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
    <div class="modal-dialog modal-xl">
            
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


            <div class="row align-items-center">

            <div class="col-6 mx-auto text-center">

            <button class="sec_btn_edit active" data-sec="employee_sec_edit">Employee</button>
            
            <button class="sec_btn_edit" data-sec="salary_sec_edit">Salary</button>
            
            <button class="sec_btn_edit" data-sec="document_sec_edit">Documents</button>

            </div>

            </div>


    <div class="row">


<div class="col-lg-12">
    
    <div class="card">
       
        <div class="card-body">

            <div class="live-preview">


                    <form  class="Dashboard-form class edit_form" data-empid="" id="edit_form" enctype="multipart/form-data">

                    <input class="edit_id" type="hidden" name="emp_id" value="" autocomplete="off">
            
                    <div class="row align-items-start form_sec_edit" id="employee_sec_edit">

                    <!-- Section 1 -->

                    <div class="col-lg-6">



                    <div class="row align-items-center mb-2">

                    <div class="col-col-md-3 col-lg-3">

                    <label for="basiInput" class="form-label">Employee Name</label>

                    </div>

                    <div class="col-col-md-9 col-lg-9">

                    <input type="text" id="emp_name_edit" name="employee_name"  class="form-control" required>

                    </div>

                    </div>


                    <div class="row align-items-center mb-2">

                    <div class="col-col-md-3 col-lg-3">

                        <label for="basiInput" class="form-label">Employee ID</label>
                        <!--<input type="text"  name="r_debit_account" class="form-control" required>-->

                    </div>


                    <div class="col-col-md-9 col-lg-9">

                    <input id="employee_id_check_edit" type="text" class="form-control" name="employee_id" required>

                    </div>


                    </div> 




                    <div class="row align-items-center mb-2">

                    <div class="col-col-md-3 col-lg-3">

                    <label for="basiInput" class="form-label">Date of Join</label>
                    
                    </div>

                    <div class="col-col-md-9 col-lg-9">

                    <input type="text" id="emp_doj_edit"  name="date_of_join" class="form-control datepicker" required reaonly autocomplete="off">

                    </div>

                    </div>



                        <div class="row align-items-center mb-2">

                        <div class="col-col-md-3 col-lg-3">

                        <label for="basiInput" class="form-label">Designation</label>

                        </div>

                        <div class="col-col-md-9 col-lg-9">

                        <input type="text" id="emp_designation_edit"  name="designation" class="form-control" required>

                        </div>

                        </div>



                        <div class="row align-items-center mb-2">

                        <div class="col-col-md-3 col-lg-3">

                        <label for="basiInput" class="form-label">Nationality</label>

                        </div>

                        <div class="col-col-md-9 col-lg-9">

                        <input type="text" id="emp_nationality_edit" name="nationality" class="form-control" required>

                        </div>

                        </div>



                    </div> <!-- Section 1 end -->



                    <div class="col-lg-6">

                    <div class="row align-items-center mb-2">

                    <div class="col-col-md-3 col-lg-3">

                    <label for="basiInput" class="form-label">Contact Number</label>

                    </div>

                    <div class="col-col-md-9 col-lg-9">

                    <input type="text" id="emp_contact_no_edit"  name="contact_number" class="form-control" required>

                    </div>

                    </div>




                    <div class="row align-items-center mb-2">

                <div class="col-col-md-3 col-lg-3">

                <label for="basiInput" class="form-label">Home Country Contact</label>

                </div>

                <div class="col-col-md-9 col-lg-9">

                <input type="text" id="emp_home_contact_no_edit"  name="country_contact" class="form-control" required>

                </div>

                </div>





                <div class="row align-items-center mb-2">

                <div class="col-col-md-3 col-lg-3">

                <label for="basiInput" class="form-label">Update Picture</label>

                </div>

                <div class="col-col-md-9 col-lg-9">

                <input type="file"  name="photo" class="form-control">

                </div>

                </div>





                <div class="row align-items-center mb-2">

                <div class="col-col-md-3 col-lg-3">

                <label for="basiInput" class="form-label">Division</label>

                </div>

                <div class="col-col-md-9 col-lg-9">

                <select class="form-control" id="emp_division_edit" name="division" required>

                <option value="">Select Division</option>

                <?php foreach($divisions as $division){ ?>

                <option value="<?= $division->div_id; ?>"><?= $division->div_name; ?></option>

                <?php } ?>

                </select>

                </div>

                </div>



                <div class="row align-items-center mb-2">

                <div class="col-col-md-3 col-lg-3">

                <label for="basiInput" class="form-label">Status</label>

                </div>

                <div class="col-col-md-9 col-lg-9">

                <select class="form-control" id="emp_status_edit" name="status" required>

                <option value="">Select Status</option>

                <option value="Active">Active</option>

                <option value="Resigned">Resigned</option>

                <option value="Terminated">Terminated</option>

                

                </select>

                </div>

                </div>




                  

                    </div>




                    <div class="row">



                    <div class="col-lg-6">


                    </div>


                    <div class="col-lg-6">


                    <div style="float: right;">
                                                <table class="table table-bordered table-striped enq_tab_submit menu">
                                                
                                                    <tr>
                                                    
                                                    <td><button class="submit_btn" type="submit">Update</button></td>
                                                
                                                    </tr>
                                                    
                                                </table>
                    </div>


                    </div>


                    </div>



       
                    </div>

                    </form>



                    <!-- Salary Section Start  -->


                    <form  class="Dashboard-form class add_form" data-empid="" id="salary_edit_form">

                    <input class="edit_id" type="hidden" name="emp_id" value="" autocomplete="off">

                    <div class="row align-items-start form_sec_edit" id="salary_sec_edit" style="display:none;">

                    <div class="col-lg-6">

                        <div class="row align-items-center mb-2">

                        <div class="col-col-md-3 col-lg-3">

                        <label for="basiInput" class="form-label">Basic Salary</label>

                        </div>

                        <div class="col-col-md-9 col-lg-9">

                        <input id="basic_salary_edit" type="number"  name="basic_salary" class="form-control sal_calc_edit" step=".01" min="0" required>

                        </div>

                        </div>


                        <div class="row align-items-center mb-2">

                        <div class="col-col-md-3 col-lg-3">

                        <label for="basiInput" class="form-label">House Rent Allowance</label>

                        </div>

                        <div class="col-col-md-9 col-lg-9">

                        <input id="hra_edit" type="number"  name="house_rent_allow" class="form-control sal_calc_edit" step=".01" min="0" required>

                        </div>

                        </div>


                        <div class="row align-items-center mb-2">

                        <div class="col-col-md-3 col-lg-3">

                        <label for="basiInput" class="form-label">Transportation Allowance</label>

                        </div>

                        <div class="col-col-md-9 col-lg-9">

                        <input id="transport_allow_edit" type="number"  name="transport_allow" class="form-control sal_calc_edit" step=".01" min="0" required>

                        </div>

                        </div>


                        <div class="row align-items-center mb-2">

                        <div class="col-col-md-3 col-lg-3">

                        <label for="basiInput" class="form-label">Telephone Allowance</label>

                        </div>

                        <div class="col-col-md-9 col-lg-9">

                        <input type="number" id="telephone_allow_edit"  name="telephone_allow" class="form-control sal_calc_edit" step=".01" min="0" required>

                        </div>

                        </div>


                        <div class="row align-items-center mb-2">

                        <div class="col-col-md-3 col-lg-3">

                        <label for="basiInput" class="form-label">Food Allowance</label>

                        </div>

                        <div class="col-col-md-9 col-lg-9">

                        <input type="number" id="food_allowance_edit"  name="food_allowance" class="form-control sal_calc_edit" step=".01" min="0" required>

                        </div>

                        </div>


                        <div class="row align-items-center mb-2">

                        <div class="col-col-md-3 col-lg-3">

                        <label for="basiInput" class="form-label">Other Allowance</label>

                        </div>

                        <div class="col-col-md-9 col-lg-9">

                        <input type="number" id="other_allowance_edit"  name="other_allow" class="form-control sal_calc_edit" step=".01" min="0" required>

                        </div>

                        </div>


                        <div class="row align-items-center mb-2">

                        <div class="col-col-md-3 col-lg-3">

                        <label for="basiInput" class="form-label">Total Salary</label>

                        </div>

                        <div class="col-col-md-9 col-lg-9">

                        <input id="edit_total_salary" type="number"  name="total_salary" class="form-control" step=".01" min="0" required readonly>

                        </div>

                        </div>



                    </div>


                    <div class="col-lg-6">

                        <div class="row align-items-center mb-2">

                        <div class="col-col-md-3 col-lg-3">

                        <label for="basiInput" class="form-label">Mode Of Payment</label>

                        </div>

                        <div class="col-col-md-9 col-lg-9">

                        <select id="mop_edit" class="form-control" name="mode_of_payment" required>

                        <option value="" >Select Mode Of Payment</option>

                        <?php foreach($mops as $mop){ ?>

                            <option value="<?= $mop->mop_id; ?>" ><?= $mop->mop_title; ?></option>

                        <?php } ?>


                        </select>

                        </div>

                        </div>



                        <div class="row align-items-center mb-2 edit_bank_sec" style="display:none">

                        <div class="col-col-md-3 col-lg-3">

                        <label for="basiInput" class="form-label">Account Number</label>

                        </div>

                        <div class="col-col-md-9 col-lg-9">

                        <input id="account_no_edit" type="text" name="account_number" class="form-control">

                        </div>

                        </div>



                        <div class="row align-items-center mb-2 edit_bank_sec" style="display:none">

                        <div class="col-col-md-3 col-lg-3">

                        <label for="basiInput" class="form-label">Bank</label>

                        </div>

                        <div class="col-col-md-9 col-lg-9">

                        <input id="bank_edit" type="text" name="bank_name" class="form-control">

                        </div>

                        </div>



                        <div class="row align-items-center mb-2">

                        <div class="col-col-md-3 col-lg-3">

                        <label for="basiInput" class="form-label">Air Ticket Per Year</label>

                        </div>

                        <div class="col-col-md-9 col-lg-9">

                        <input id="air_ticket_per_year_edit" type="text"  name="air_ticket_per_year" class="form-control" required>

                        </div>

                        </div>



                        <div class="row align-items-center mb-2">

                        <div class="col-col-md-3 col-lg-3">

                        <label for="basiInput" class="form-label">Budgeted Ticket Amount</label>

                        </div>

                        <div class="col-col-md-9 col-lg-9">

                        <input id="budgeted_air_ticket_edit" type="text"  name="budgeted_air_ticket" class="form-control" required>

                        </div>

                        </div>



                        <div class="row align-items-center mb-2">

                        <div class="col-col-md-3 col-lg-3">

                        <label for="basiInput" class="form-label">Vacation Taken</label>

                        </div>

                        <div class="col-col-md-9 col-lg-9">

                        <input id="vacation_taken_edit" type="text"  name="vacation_taken" class="form-control" required>

                        </div>

                        </div>



                        <div class="row align-items-center mb-2">

                        <div class="col-col-md-3 col-lg-3">

                        <label for="basiInput" class="form-label">Air Ticket Due From</label>

                        </div>

                        <div class="col-col-md-9 col-lg-9">

                        <input id="air_ticket_due_edit" type="date" onclick="this.showPicker();"  name="air_ticket_due_from" class="form-control" required>

                        </div>

                        </div>



                        <div class="row align-items-center mb-2">

                        <div class="col-col-md-3 col-lg-3">

                        <label for="basiInput" class="form-label">Vacation Pay Due From</label>

                        </div>

                        <div class="col-col-md-9 col-lg-9">

                        <input id="vacation_pay_due_edit"type="date" onclick="this.showPicker();"  name="vacation_pay_due_from" class="form-control" required>

                        </div>

                        </div>


                        <div class="row align-items-center mb-2">

                        <div class="col-col-md-3 col-lg-3">

                        <label for="basiInput" class="form-label">Indemnity Advance</label>

                        </div>

                        <div class="col-col-md-9 col-lg-9">

                        <input id="indemnity_advance_edit" type="text"  name="indemnity_advance" class="form-control" required>

                        </div>

                        </div>


                    </div>





                            <div class="row">



                            <div class="col-lg-6">


                            </div>


                            <div class="col-lg-6">


                            <div style="float: right;">
                                                        <table class="table table-bordered table-striped enq_tab_submit menu">
                                                        
                                                            <tr>
                                                                <td><button class="submit_btn" type="submit">Update</button></td>
                                                        
                                                            </tr>
                                                            
                                                        </table>
                            </div>


                            </div>


                            </div>







                    </div>



                </form>


                <!-- Salary Section End  -->











                <!-- Document Section Start  -->


                <form  class="Dashboard-form class edit_form" data-empid="" id="document_edit_form">

                <input class="edit_id" type="hidden" name="emp_id" value="" autocomplete="off">

        <div class="row align-items-start form_sec_edit" id="document_sec_edit" style="display:none;">

    <div class="col-lg-12">

    <div class="row align-items-center mb-2">

    <div class="col-col-md-3 col-lg-3">

    <label for="basiInput" class="form-label">Passport Number & Expiry</label>

    </div>

    <div class="col-col-md-3 col-lg-3">

    <input type="text" id="passport_no_edit"  name="passport_no" class="form-control" placeholder="Passport Number"  required>

    </div>

    <div class="col-col-md-3 col-lg-3">

    <input type="text" id="passport_expiry_edit"  name="passport_expiry" class="form-control datepicker" placeholder="Passport Expiry" required readonly>

    </div>


    <div class="col-col-md-3 col-lg-3">

    <input type="file" id="passport_file_edit"  name="passport_file" class="form-control">

    </div>

    </div>




<div class="row align-items-center mb-2">

<div class="col-col-md-3 col-lg-3">

<label for="basiInput" class="form-label">Visa Number & Expiry</label>

</div>

<div class="col-col-md-3 col-lg-3">

<input type="text" id="visa_no_edit"  name="visa_no" class="form-control" placeholder="Visa Number"  required>

</div>

<div class="col-col-md-3 col-lg-3">

<input type="text" id="visa_expiry_edit"  name="visa_expiry" class="form-control datepicker" placeholder="Visa Expiry" required readonly>

</div>


<div class="col-col-md-3 col-lg-3">

<input placeholder="Visa File" type="file"  name="visa_file" class="form-control">

</div>

</div>







<div class="row align-items-center mb-2">

<div class="col-col-md-3 col-lg-3">

<label for="basiInput" class="form-label">Qatar ID & Expiry</label>

</div>

<div class="col-col-md-3 col-lg-3">

<input type="text" id="qatar_id_edit"  name="qatar_id" class="form-control" placeholder="Qatar ID"  required>

</div>

<div class="col-col-md-3 col-lg-3">

<input type="text" id="qatar_id_expiry_edit"  name="qid_expiry" class="form-control datepicker" placeholder="Qatar ID Expiry" required readonly>

</div>


<div class="col-col-md-3 col-lg-3">

<input placeholder="Qatar ID File" type="file"  name="qid_file" class="form-control">

</div>

</div>



<div class="row align-items-center justify-content-start mb-2">

<div class="col-col-md-3 col-lg-3">

<label for="basiInput" class="form-label">Contract & Expiry</label>

</div>

<div class="col-col-md-3 col-lg-3">

<input type="text" id="contract_expiry_edit" name="contract_expiry" class="form-control datepicker" placeholder="Contract Expiry" required readonly>

</div>


<div class="col-col-md-3 col-lg-3">

<input placeholder="Contract File" type="file"  name="contract_file" class="form-control">

</div>

</div>


   

        </div>



        <div class="row">



        <div class="col-lg-6">


        </div>


        <div class="col-lg-6">


        <div style="float: right;">
                                    <table class="table table-bordered table-striped enq_tab_submit menu">
                                    
                                        <tr>
                                            <td><button class="submit_btn" type="submit">Update</button></td>
                                    
                                        </tr>
                                        
                                    </table>
        </div>


        </div>


        </div>







</div>



</form>


        <!-- Document Section End  -->













                        
                        
                    </div>
                    <!--end row-->








                
            </div>
            
        </div>
    </div>
</div>

<!--end col-->
</div>

</div>
            <!--                                    
            <div class="modal-footer justify-content-center">
                <button  class="btn btn btn-success">Save</button>
            </div>
            -->

        </div>
        </form>

    </div>
</div>





<!--Edit modal section end-->





</section>
						

										
										
</div>
       

</div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->


<!--footer section start-->

<?php echo view('includes/footer'); ?>

<!--footer section end-->    

<script>

     document.addEventListener("DOMContentLoaded", function(event) { 
    

        $('.sec_btn').click(function(){

        $('.sec_btn').removeClass('active');

        var sec = $(this).data('sec');

        $(this).addClass('active');

        $('.form_sec').hide();

        $('#'+sec+'').show();

        });


        $('.sec_btn_edit').click(function(){

        $('.sec_btn_edit').removeClass('active');

        var sec = $(this).data('sec');

        $(this).addClass('active');

        $('.form_sec_edit').hide();

        $('#'+sec+'').show();

        });






        $('.sal_calc').on('input', function() {

        let total = 0;
        $('.sal_calc').each(function() {
            // Parse the value as a float and add to total
            total += parseFloat($(this).val()) || 0;
        });
        // Set the total in the input with ID add_total_salary
        $('#add_total_salary').val(total.toFixed(2));


        });



        $('.sal_calc_edit').on('input', function() {

        let total = 0;
        $('.sal_calc_edit').each(function() {
            // Parse the value as a float and add to total
            total += parseFloat($(this).val()) || 0;
        });
        // Set the total in the input with ID add_total_salary
        $('#edit_total_salary').val(total.toFixed(2));


        });





        $('#mop_add').change(function(){

            if($(this).val()!="1")
                {
                $('.bank_sec_add').show();
                }
                else
                {
                $('.bank_sec_add').hide();
            } 

        })



        $('#mop_edit').change(function(){

        if($(this).val()!="1")
            {
            $('.edit_bank_sec').show();
            }
            else
            {
            $('.edit_bank_sec').hide();
        } 

        })


                        




        /* Main Add */    
   
        $(function() {
            $('#add_form').validate({
                rules: {
                    required: 'required',
                    employee_id: {
                    required:true,
                    remote:{
                        url:"<?= base_url() ?>HR/Employees/EmpNoCheck",
                        type:'POST',
                        async:false,
                        data:
                        {
                           emp_no : function()
                          {
                            return $('#employee_id_check').val();
                        }
                        },
                    }
                    }
                },
                messages: {
                    required: '',
                    employee_id: {
                    remote:"Duplicate employee id",
                    required:""
                    },
                },
                errorPlacement: function(error, element) {
                    if (element.attr("name") == "employee_id") {
                    error.insertAfter(element);
                    }
                } ,
                submitHandler: function(form) {

                    var formData = new FormData(form);

                    $.ajax({
                        url: "<?php echo base_url(); ?>HR/Employees/Add",
                        method: "POST",
                        //data: $(form).serialize(),
                        data:formData,
                        processData: false, 
                        contentType: false,
                        success: function(data) 
                        {
                       
                            alertify.success('Data Added Successfully').delay(3).dismissOthers();
                            $('#add_form').attr('data-empid',data);
                            $('.added_id').val(data);
                            $('#employee_sec').hide();
                            $('#salary_sec').show();
                            datatable.ajax.reload( null, false)

                        }
                       
                    });
                    return false; // prevent the form from submitting
                }
            });
        });

        /*###*/




        /* Salary Add*/

        $(function() {
            $('#salary_add_form').validate({
                rules: {
                    required: 'required',
                },
                messages: {
                    required: 'This field is required',
                },
                errorPlacement: function(error, element) {} ,
                submitHandler: function(form) {


                    if($('.added_id').val()=="")
                    {

                    alertify.error('Add employee details first!').delay(3).dismissOthers();

                    return false;

                    }


                    var formData = new FormData(form);

                    $.ajax({
                        url: "<?php echo base_url(); ?>HR/Employees/AddSalary",
                        method: "POST",
                        data: $(form).serialize(),
                        success: function(data) 
                        {
                       
                            alertify.success('Data Saved Successfully').delay(3).dismissOthers();
                            //$('#add_form').attr('data-empid',data);
                            //$('.added_id').val(data);
                            $('#salary_sec').hide();
                            $('#document_sec').show();
                            datatable.ajax.reload( null, false)

                        }
                       
                    });

                    return false; // prevent the form from submitting
                }
            });
        });


        /* #######  */





         /* Salary Add*/

         $(function() {
            $('#document_add_form').validate({
                rules: {
                    required: 'required',
                },
                messages: {
                    required: 'This field is required',
                },
                errorPlacement: function(error, element) {} ,
                submitHandler: function(form) {


                    if($('.added_id').val()=="")
                    {

                    alertify.error('Add employee details first!').delay(3).dismissOthers();

                    return false;

                    }

                    var formData = new FormData(form);
                    

                    $.ajax({
                        url: "<?php echo base_url(); ?>HR/Employees/AddDocuments",
                        method: "POST",
                        //data: $(form).serialize(),
                        data:formData,
                        processData: false, 
                        contentType: false,
                        success: function(data) 
                        {
                       
                            alertify.success('Data Saved Successfully').delay(3).dismissOthers();
                            //$('#add_form').attr('data-empid',data);
                            //$('.added_id').val(data);
                            $('#AddModal').modal('hide');
                            datatable.ajax.reload( null, false)

                        }
                       
                    });
                    return false; // prevent the form from submitting
                }
            });
        });


        /* #######  */






        /*account head modal start*/ 

        $("body").on('click', '.edit_btn', function(){ 

            var id = $(this).data('id');

            $.ajax({

                url : "<?php echo base_url(); ?>HR/Employees/Edit",

                method : "POST",

                data: {emp_id: id},

                success:function(data)
                {   
                    if(data)
                    {
                    var data = JSON.parse(data);

                    $('#EditModal .edit_id').val(data.emp.emp_id);

                    $('#emp_name_edit').val(data.emp.emp_name);

                    $('#employee_id_check_edit').val(data.emp.emp_uid);
                  
                    $('#emp_doj_edit').val(FormatDate(data.emp.emp_date_of_join));

                    $('#emp_designation_edit').val(data.emp.emp_designation);

                    $('#emp_nationality_edit').val(data.emp.emp_nationality);

                    $('#emp_contact_no_edit').val(data.emp.emp_contact_no);

                    $('#emp_home_contact_no_edit').val(data.emp.emp_home_contact_no);

                    $('#emp_division_edit').val(data.emp.emp_division);


                    //Salary Sec


                    $('#basic_salary_edit').val(data.emp.emp_basic_salary);

                    $('#hra_edit').val(data.emp.emp_house_rent_allow);

                    $('#transport_allow_edit').val(data.emp.emp_transport_allow);

                    $('#telephone_allow_edit').val(data.emp.emp_tel_allow);

                    $('#food_allowance_edit').val(data.emp.emp_food_allow);

                    $('#other_allowance_edit').val(data.emp.emp_other_allow);

                    $('#edit_total_salary').val(data.emp.emp_total_salary);

                    $('#mop_edit').val(data.emp.emp_mode_of_payment);

                    if(data.emp.emp_mode_of_payment!=1)
                    {
                    $('.edit_bank_sec').show();

                    $('#account_no_edit').val(data.emp.emp_account_number);

                    $('#bank_edit').val(data.emp.emp_bank);

                    }
                    else
                    {
                    $('.edit_bank_sec').hide();

                    $('#account_no_edit').val('');

                    $('#bank_edit').val('');

                    }

                    $('#vacation_taken_edit').val(data.emp.emp_vacation_taken);

                    $('#air_ticket_due_edit').val(data.emp.emp_air_ticket_due_from);

                    $('#vacation_pay_due_edit').val(data.emp.emp_vacation_pay_due_from);

                    $('#indemnity_advance_edit').val(data.emp.emp_indemnity_advance);


                    $('#air_ticket_per_year_edit').val(data.emp.emp_air_ticket_per_year);

                    $('#budgeted_air_ticket_edit').val(data.emp.emp_budgeted_ticket_amount);


                    //Doc Sec

                    $('#passport_no_edit').val(data.emp.emp_passport_no);

                    if(data.emp.emp_passport_expiry!=null)
                    {
                    $('#passport_expiry_edit').val(FormatDate(data.emp.emp_passport_expiry));
                    }
                    else
                    {
                    $('#passport_expiry_edit').val('').datepicker("refresh"); 
                    }

                    $('#passport_no_edit').val(data.emp.emp_passport_no);

                    $('#visa_no_edit').val(data.emp.emp_visa_no);

                    if(data.emp.emp_visa_expiry!=null)
                    {
                    $('#visa_expiry_edit').val(FormatDate(data.emp.emp_visa_expiry));
                    }
                    else
                    {
                    $('#visa_expiry_edit').val("").datepicker("refresh"); ;
                    }

                    $('#qatar_id_edit').val(data.emp.emp_qatar_id_no);


                    if(data.emp.emp_qatar_id_expiry!=null)
                    {
                    $('#qatar_id_expiry_edit').val(FormatDate(data.emp.emp_qatar_id_expiry));
                    }
                    else
                    {
                    $('#qatar_id_expiry_edit').val("").datepicker("refresh");
                    }

                    if(data.emp.emp_contract_expiry!=null)
                    {
                    $('#contract_expiry_edit').val(FormatDate(data.emp.emp_contract_expiry));
                    }
                    else
                    {
                    
                    $('#contract_expiry_edit').val('').datepicker("refresh");
                    }

                    $('#EditModal').modal('show');


                
                    }
                    else
                    {
                    alertify.error('Something went wrong!').delay(8).dismissOthers();  
                    }
                    
                }


            });
            
            
        });







        /*####*/


           /*account head modal start*/ 
           $("body").on('click', '.view_btn', function(){

                var id = $(this).data('id');

                $.ajax({

                    url : "<?php echo base_url(); ?>HR/Employees/View",

                    method : "POST",

                    data: {emp_id: id},

                    success:function(data)
                    {   
                        var data = JSON.parse(data);
                        if(data)
                        {

                        $('#view_name').html(data.employee.emp_name);

                        $('#view_contact_no').html(data.employee.emp_contact_no);

                        $('#view_home_contact').html(data.employee.emp_home_contact_no);

                        $('#view_division').html(data.employee.div_name);

                        $('#view_employee_id').html(data.employee.emp_uid);

                        $('#view_doj').html(data.employee.emp_doj);

                        $('#view_designation').html(data.employee.emp_designation);

                        $('#view_nationality').html(data.employee.emp_nationality);

                        //Salary 

                        $('#view_basic_salary').html(formatNumber(data.employee.emp_basic_salary));

                        $('#view_mop').html(data.employee.mop_title);

                        $('#view_hra').html(data.employee.emp_house_rent_allow);


                        if(data.employee.mop_id!=1)

                        {

                        $('#view_account_no').html(data.employee.emp_account_number);

                        $('#view_bank').html(data.employee.emp_bank);

                        }
                        else
                        {
                        
                        $('#view_account_no').html('-');

                        $('#view_bank').html('-');

                        }


                        $('#view_transport_allow').html(formatNumber(data.employee.emp_transport_allow));

                        

                        $('#view_tel_allow').html(formatNumber(data.employee.emp_tel_allow));

                        $('#view_food_allowance').html(formatNumber(data.employee.emp_food_allow));

                        $('#view_budgeted_ticket_amount').html(formatNumber(data.employee.emp_budgeted_ticket_amount));

                        $('#view_air_ticket').html(data.employee.emp_air_ticket_per_year);

                        $('#view_other_allowance').html(formatNumber(data.employee.emp_other_allow));

                        $('#view_vacation_taken').html(data.employee.emp_vacation_taken);

                        $('#view_air_ticket_due_from').html(data.employee.emp_air_ticket_due_from);

                        $('#view_vacation_pay_due_from').html(data.employee.emp_vacation_pay_due_from);

                        $('#view_indemnity_advance').html(formatNumber(data.employee.emp_indemnity_advance));

                        $('#view_total_salary').html(formatNumber(data.employee.emp_total_salary));



                        //


                        //Documents
                        if(data.employee.emp_picture != "")
                        {
                        $('#view_image').attr('src','<?= base_url(); ?>public/uploads/Employees/'+data.employee.emp_picture+'');
                        }

                        $('#view_passport_no').html(data.employee.emp_passport_no);

                        $('#view_passport_expiry').html(FormatDate(data.employee.emp_passport_expiry));

                        $('#view_passport_file').attr('href','<?= base_url(); ?>public/uploads/Employees/'+data.employee.emp_passport_file+'');

                        $('#view_visa_no').html(data.employee.emp_visa_no);

                        $('#view_visa_no').html(data.employee.emp_visa_no);

                        $('#view_visa_file').attr('href','<?= base_url(); ?>public/uploads/Employees/'+data.employee.emp_visa_file+'');

                        $('#view_visa_expiry').html(FormatDate(data.employee.emp_visa_expiry));

                        $('#view_qid_no').html(data.employee.emp_qatar_id_no);

                        $('#view_qatar_id_file').attr('href','<?= base_url(); ?>public/uploads/Employees/'+data.employee.emp_qatar_id_file+'');

                        $('#view_qid_expiry').html(FormatDate(data.employee.emp_qatar_id_expiry));

                        $('#view_contract').attr('href','<?= base_url(); ?>public/uploads/Employees/'+data.employee.emp_contract_file+'');

                        $('#view_contract_expiry').html(FormatDate(data.employee.emp_contract_expiry));
          
                        //


                        
                        $('#ViewModal').modal('show');

                        
                        }

                }


                });
              
            
            
        });
        /*####*/


        /*account head update*/
        $(document).ready(function(){
            $('#edit_form').submit(function(e){

                e.preventDefault();

                var formData = new FormData($('#edit_form').get(0));
                
                $.ajax({

                    url : "<?php echo base_url(); ?>HR/Employees/Update",

                    method : "POST",

                    data: formData,
                    contentType: false,
                    processData: false,

                    success:function(data)
                    {
                        
                        $('#EditModal').modal('hide');

                        alertify.success('Data Updated Successfully').delay(5).dismissOthers();

                        datatable.ajax.reload( null, false );
                    }


                });
            });
        });
        /*###*/



        

        /* Salary Edit*/

        $(function() {
            $('#salary_edit_form').validate({
                rules: {
                    required: 'required',
                },
                messages: {
                    required: 'This field is required',
                },
                errorPlacement: function(error, element) {} ,
                submitHandler: function(form) {


                    var formData = new FormData(form);

                    $.ajax({
                        url: "<?php echo base_url(); ?>HR/Employees/UpdateSalary",
                        method: "POST",
                        data: $(form).serialize(),
                        success: function(data) 
                        {
                       
                            alertify.success('Data Saved Successfully').delay(3).dismissOthers();
                            //$('#add_form').attr('data-empid',data);
                            //$('.added_id').val(data);
                            datatable.ajax.reload( null, false)

                        }
                       
                    });

                    return false; // prevent the form from submitting
                }
            });
        });


        /* #######  */



          /*account head update*/
          $(document).ready(function(){
            $('#document_edit_form').submit(function(e){

                e.preventDefault();

                var formData = new FormData($('#document_edit_form').get(0));
                
                $.ajax({

                    url : "<?php echo base_url(); ?>HR/Employees/UpdateDocuments",

                    method : "POST",

                    data: formData,
                    contentType: false,
                    processData: false,

                    success:function(data)
                    {
                        
                        $('#EditModal').modal('hide');

                        alertify.success('Data Updated Successfully').delay(5).dismissOthers();

                        datatable.ajax.reload( null, false );
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

                url : "<?php echo base_url(); ?>HR/Employees/Delete",

                method : "POST",

                data: {id: id},

                success:function(data)
                {
                    alertify.success('Data Deleted Successfully').delay(8).dismissOthers();

                    datatable.ajax.reload( null, false )
                }


            });

        });
        /*###*/



        /*data table start*/ 


        function initializeDataTable() {

            /*
            if ($.fn.DataTable.isDataTable("#accountTable")) {
                $('#accountTable').DataTable().clear().destroy();
            }
            */

            datatable = $('#accountTable').DataTable({
                'stateSave': true,
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url': "<?php echo base_url(); ?>HR/Employees/FetchData",
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
                    { data: 'emp_id' },
                    { data : "employee_id"},
                    { data : "employee_name" },
                    { data: 'division' },
                    { data : 'designation'},
                    { data : 'date_of_join'},
                    { data: 'contract_expiry'},
                    { data: 'action' },
                ]
                
           });
        }

        $(document).ready(function () {
            initializeDataTable();
        });
        /*###*/




        $('.add_model_btn').click(function(){


            $('.added_id').val('');

            $('#add_form')[0].reset();

            $('.add_form')[0].reset();

           

            });


          
        
        $(".add_account_head_select").select2({
        placeholder: "Select Account Head",
        theme : "default form-control-",
        dropdownParent: $('#add_ah_parent'),
        ajax: {
                url: "<?= base_url(); ?>HR/Employees/FetchTypes",
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
                   
                    var page = params.page || 1;
                    return {
                        results: $.map(data.result, function (item) { return {id: item.ah_id, text: item.ah_account_name}}),
                        pagination: {
                        // THE `10` SHOULD BE SAME AS `$resultCount FROM PHP, it is the number of records to fetch from table` 
                            more: (page * 10) <= data.total_count
                        }
                    };
                },              
            }
        })

        /*###*/





        /*create account id by account head*/ 
         
        $('.add_account_head_select').on('change', function() {
          

          var id = $(this).val();

          $.ajax({

              url : "<?php echo base_url(); ?>HR/Employees/Code",

              method : "POST",

              data: {ID: id},

              success:function(data)
              {   
                  var data = JSON.parse(data);
                  
                  $(".account_id").val(data.account_id);
                  
                   
              }


          });
         
           
      });

      /*####*/







     
    });





    function formatNumber(num) {
    // Convert number to string
    let numStr = num.toString();

    // Split into integer and decimal parts (if any)
    let parts = numStr.split(".");
    let integerPart = parts[0];
    let decimalPart = parts.length > 1 ? '.' + parts[1] : '';

    // Use regex to format the integer part
    let lastThreeDigits = integerPart.slice(-3);
    let otherDigits = integerPart.slice(0, -3);

    if (otherDigits) {
        lastThreeDigits = ',' + lastThreeDigits;
    }

    // Insert commas in the rest of the number
    let formattedInteger = otherDigits.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThreeDigits;

    return formattedInteger + decimalPart;
}

// Example usage
let formattedNumber = formatNumber(100000);
console.log(formattedNumber); // Output: "1,00,000"




      


</script>



	
</body>



</html>









            
