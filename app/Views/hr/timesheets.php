<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">



<head>

    <meta charset="utf-8" />
    <title><?php echo site_title//Defined in app/constants ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />
    <meta content="" name="author" />
    
    
    
    <style>

.table td.fit, 
.table th.fit {
   white-space: nowrap;
   width: 1%;
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


<!--Start Account head -->


<!-- View Modal -->


<div class="modal fade" id="ViewModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    
    <div class="modal-dialog modal-xl">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">View Timesheets</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


    <div class="row">


<div class="col-lg-12">
    <div class="card">
       
        <div class="card-body">
            <div class="live-preview">
            
                    <div class="row align-items-end">


                    <table class="table table-bordered">

                        <h2>Timesheet Details<h2>

                    <tbody>

                        <tr>

                        <td>Employee Name</td>

                        <td id="emp_name_view"></td>

                        </tr>

                        
                        <tr>

                        <td>Month</td>

                        <td id="month_view"></td>

                        </tr>

                        
                        <tr>

                        <td>Year</td>

                        <td id="year_view"></td>

                        </tr>

                    </tbody>

                </table>





                        <table class="table table-bordered">

                        
                        <h3>Monthly Data</h3>


                        <thead>


                        <th>Date</th>

                        <th>Day</th>

                        <th>Day Type</th>

                        <th>Time In</th>

                        <th>Time Out</th>

                        <th>Total Hours</th>

                        <th>Normal Hours</th>

                        <th>Normal OT</th>

                        <th>Friday OT</th>



                        </thead>

                        <tbody id="days_row">

                        </tbody>
                            

                    </table>





                    <table class="table table-bordered">


                    
                    </table>



                        
                        
                    </div>
                    <!--end row-->
                
            </div>
            
        </div>
    </div>
</div>

<!--end col-->
</div>

</div>
           

        </div>
     

    </div>
</div>



<!-- ######### -->






									
<div class="tab-pane active" id="border-nav-1" role="tabpanel">

    <!-- Add Modal -->


    <div class="modal fade" id="AddModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
            
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Timesheet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


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

                    <div class="col-col-md-9 col-lg-9" id="add_te_parent">

                   <select class="form-control add_te" name="employee" required>


                   </select>

                    </div>

                    </div>



                    <div class="row align-items-center mb-2" id="add_ah_parent">

                    <div class="col-col-md-3 col-lg-3">
                        <label for="basicInput" class="form-label">Month</label>
                    </div>

                    <div class="col-col-md-4 col-lg-4">
                       
                    <select class="form-select " name="month"  required>
                    
                    <?php foreach($months as $key=>$month){ ?>
                    <option value="<?= $key ?>"><?= $month ?></option>
                    <?php } ?>

                    </select>
                        
                    </div>


                    <div class="col-col-md-4 col-lg-4">
                       
                    <select class="form-select " name="year"  required>


                    <?php for($m=2000;$m<=date('Y');$m++){ ?>

                    <option value="<?= $m ?>" <?php if($m==date('Y')) { echo "selected"; }  ?>><?= $m ?></option>

                    <?php } ?>


                    </select>

                        
                    </div>


                    </div> 
                    

                    </div> <!-- Section 1 end -->


                        <div class="col-lg-6">


                        </div>


                        <div class="col-lg-6">


                        <div style="float: right;">
                                                    <table class="table table-bordered table-striped enq_tab_submit menu">
                                                    
                                                        <tr>
                                                            <td><button class="submit_btn" type="submit">Record</button></td>
                                                    
                                                        </tr>
                                                        
                                                    </table>
                        </div>


                        </div>


                        </div>




       
                    </div>

                    </form>






                    
                    <form  class="Dashboard-form class add_form" data-empid="" id="timesheet_add_form">

                    <input class="" id="timesheet_emp_id" type="hidden" name="emp_id" value="" autocomplete="off">

                    <div class="row align-items-start form_sec" id="timesheet_sec" style="display:none;">

                    <div class="col-lg-12">


                        <table class="table table-bordered">

                        <tr>

                        <th>Date</th>

                        <th>Day</th>

                        <th>Day Type</th>

                        <th>Time In</th>

                        <th>Time Out</th>

                        <th>Total Hours</th>

                        <th>Normal Hours</th>

                        <th>Normal Overtime</th>

                        <th>Friday OT</th>

                        </tr>

                        <tbody id="month_days_row">


                        </tbody>

                        </table>





                        <div class="row align-items-center mb-2">


<div class="col-lg-4">

    <div class="row align-items-center mb-2">

    <div class="col-col-md-3 col-lg-3">

    <label for="basiInput" class="form-label">Working Days</label>

    </div>

    <div class="col-col-md-9 col-lg-9">

    <input id="working_days" type="number" value="0" name="total_working_days" class="form-control" step=".01" min="0" required readonly>

    </div>

    </div>



    <div class="row align-items-center mb-2">

    <div class="col-col-md-3 col-lg-3">

    <label for="basiInput" class="form-label">Public Holiday</label>

    </div>

    <div class="col-col-md-9 col-lg-9">

    <input id="public_holiday" type="number" value="0"  name="total_public_holidays" class="form-control" step=".01" min="0" required readonly>

    </div>

    </div>


    <div class="row align-items-center mb-2">

    <div class="col-col-md-3 col-lg-3">

    <label for="basiInput" class="form-label">Leave</label>

    </div>

    <div class="col-col-md-9 col-lg-9">

    <input id="leave" type="number" value="0"  name="total_leaves" class="form-control" step=".01" min="0" required readonly>

    </div>

    </div>


    <!-- Unpaid leave sec -->

    <div class="row align-items-center mb-2">

    <div class="col-col-md-3 col-lg-3">

    <label for="basiInput" class="form-label">Unpaid Leave</label>

    </div>

    <div class="col-col-md-9 col-lg-9">

    <input id="unpaid_leave" type="number" value="0"  name="total_unpaid_leaves" class="form-control" step=".01" min="0" required readonly>

    </div>

    </div>



    <div class="row align-items-center mb-2">

    <div class="col-col-md-3 col-lg-3">

    <label for="basiInput" class="form-label">Medical Leave</label>

    </div>

    <div class="col-col-md-9 col-lg-9">

    <input id="medical_leave" type="number" value="0"  name="total_medical_leaves" class="form-control" step=".01" min="0" required readonly>

    </div>

    </div>


    <div class="row align-items-center mb-2">

    <div class="col-col-md-3 col-lg-3">

    <label for="basiInput" class="form-label">Normal OT</label>

    </div>

    <div class="col-col-md-9 col-lg-9">

    <input id="normal_ot" type="number" value="0"  name="total_normal_ot" class="form-control" step=".01" min="0" required readonly>

    </div>

    </div>



    <div class="row align-items-center mb-2">

    <div class="col-col-md-3 col-lg-3">

    <label for="basiInput" class="form-label">Friday OT</label>

    </div>

    <div class="col-col-md-9 col-lg-9">

    <input id="friday_ot" type="number" value="0"  name="total_friday_ot" class="form-control" step=".01" min="0" required readonly>

    </div>

    </div>




</div>




<!-- Sec 1 End -->




<!-- Sec2 Start -->



<div class="col-lg-4">

                        
<div class="row align-items-center mb-2">

<div class="col-col-md-3 col-lg-3">

<label for="basiInput" class="form-label">Basic Salary</label>

</div>

<div class="col-col-md-9 col-lg-9">

<input type="number" id="emp_basic_salary"  name="basic_salary" class="form-control" step=".01" min="0" readonly>

</div>

</div>


<div class="row align-items-center mb-2">

<div class="col-col-md-3 col-lg-3">

<label for="basiInput" class="form-label">House Rent Allowance</label>

</div>

<div class="col-col-md-9 col-lg-9">

<input type="number" id="emp_rent_allowance"  name="house_rent_allow" class="form-control" step=".01" min="0" readonly>

</div>

</div>


<div class="row align-items-center mb-2">

<div class="col-col-md-3 col-lg-3">

<label for="basiInput" class="form-label">Transportation Allowance</label>

</div>

<div class="col-col-md-9 col-lg-9">

<input type="number" id="emp_transp_allowance"  name="transport_allow" class="form-control" step=".01" min="0" readonly>

</div>

</div>


<div class="row align-items-center mb-2">

<div class="col-col-md-3 col-lg-3">

<label for="basiInput" class="form-label">Telephone Allowance</label>

</div>

<div class="col-col-md-9 col-lg-9">

<input type="number" id="emp_telephone_allowance"  name="telephone_allow" class="form-control" step=".01" min="0" readonly>

</div>

</div>


<div class="row align-items-center mb-2">

<div class="col-col-md-3 col-lg-3">

<label for="basiInput" class="form-label">Food Allowance</label>

</div>

<div class="col-col-md-9 col-lg-9">

<input type="number" id="emp_food_allowance"  name="food_allowance" class="form-control" step=".01" min="0" readonly>

</div>

</div>


<div class="row align-items-center mb-2">

<div class="col-col-md-3 col-lg-3">

<label for="basiInput" class="form-label">Other Allowance</label>

</div>

<div class="col-col-md-9 col-lg-9">

<input type="number" id="emp_other_allowance"  name="other_allow" class="form-control" step=".01" min="0" readonly>

</div>

</div>


<div class="row align-items-center mb-2">

<div class="col-col-md-3 col-lg-3">

<label for="basiInput" class="form-label">Total Hourly Salary</label>

</div>

<div class="col-col-md-9 col-lg-9">

<input id="add_hourly_salary" type="number"  name="total_salary" class="form-control" min="0" readonly>

</div>

</div>


<div class="row align-items-center mb-2">

<div class="col-col-md-3 col-lg-3">

<label for="basiInput" class="form-label">Total Monthly Salary</label>

</div>

<div class="col-col-md-9 col-lg-9">

<input id="add_total_salary" type="number"  name="total_salary" class="form-control" step=".01" min="0" readonly>

</div>

</div>


</div>


<!-- Sec 2 End -->





<!-- Sec 3 Start -->

<div class="col-lg-4">



<div class="row align-items-center mb-2">

<div class="col-col-md-3 col-lg-3">

<label for="basiInput" class="form-label">Leave</label>

</div>

<div class="col-col-md-9 col-lg-9">

<input id="leave_total_amount" type="number"  name="total_leave_salary" class="form-control" step=".01" min="0" readonly>

</div>

</div>





<div class="row align-items-center mb-2">

<div class="col-col-md-3 col-lg-3">

<label for="basiInput" class="form-label">Unpaid Leave</label>

</div>

<div class="col-col-md-9 col-lg-9">

<input id="" type="number"  name="total_unpaid_leave_salary" class="form-control" step=".01" min="0"  readonly>

</div>

</div>




<div class="row align-items-center mb-2">

<div class="col-col-md-3 col-lg-3">

<label for="basiInput" class="form-label">Medical Leave</label>

</div>

<div class="col-col-md-9 col-lg-9">

<input id="" type="number"  name="total_medical_leave_salary" class="form-control" step=".01" min="0" readonly>

</div>

</div>



<div class="row align-items-center mb-2">

<div class="col-col-md-3 col-lg-3">

<label for="basiInput" class="form-label">Normal OT</label>

</div>

<div class="col-col-md-9 col-lg-9">

<input id="total_normal_ot_salary" type="number"  name="total_normal_ot_salary" class="form-control" step=".01" min="0"  readonly>

</div>

</div>



<div class="row align-items-center mb-2">

<div class="col-col-md-3 col-lg-3">

<label for="basiInput" class="form-label">Friday OT</label>

</div>

<div class="col-col-md-9 col-lg-9">

<input id="total_friday_ot_salary" type="number"  name="total_friday_ot_salary" class="form-control" step=".01" min="0"  readonly>

</div>

</div>




<div class="row align-items-center mb-2">

<div class="col-col-md-3 col-lg-3">

<label for="basiInput" class="form-label">Salary (Selected Month)</label>

</div>

<div class="col-col-md-9 col-lg-9">

<input id="total_month_salary" type="number"  name="total_month_salary" class="form-control" step=".01" min="0" readonly>

</div>

</div>






</div>

<!-- Sec 3 End -->


                       

                        





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




 <!-- Edit Modal Start -->


 <div class="modal fade" id="EditModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
            
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Timesheet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


    <div class="row">


<div class="col-lg-12">
    
    <div class="card">
       
        <div class="card-body">

            <div class="live-preview">

                    <form  class="Dashboard-form class edit_form" data-empid="" id="edit_form">
                    <input class="edit_id" type="hidden" name="emp_id" value="" autocomplete="off">
            
                    <div class="row align-items-start form_sec" id="employee_edit_sec">

                    <!-- Section 1 -->

                    <div class="col-lg-6">



                    <div class="row align-items-center mb-2">

                    <div class="col-col-md-3 col-lg-3">

                    <label for="basiInput" class="form-label">Employee Name</label>

                    </div>

                    <div class="col-col-md-9 col-lg-9" id="add_te_parent">

                   <select class="form-control add_te" name="employee" required>


                   </select>

                    </div>

                    </div>



                    <div class="row align-items-center mb-2" id="edit_ah_parent">

                    <div class="col-col-md-3 col-lg-3">
                        <label for="basicInput" class="form-label">Month</label>
                    </div>

                    <div class="col-col-md-4 col-lg-4">
                       
                    <select class="form-select " name="month"  required>
                    
                    <?php foreach($months as $key=>$month){ ?>
                    <option value="<?= $key ?>"><?= $month ?></option>
                    <?php } ?>

                    </select>
                        
                    </div>


                    <div class="col-col-md-4 col-lg-4">
                       
                    <select class="form-select " name="year"  required>


                    <?php for($m=2000;$m<=date('Y');$m++){ ?>

                    <option value="<?= $m ?>" <?php if($m==date('Y')) { echo "selected"; }  ?>><?= $m ?></option>

                    <?php } ?>


                    </select>

                        
                    </div>


                    </div> 
                    

                    </div> <!-- Section 1 end -->


                        <div class="col-lg-6">


                        </div>


                        <div class="col-lg-6">


                        <div style="float: right;">
                                                    <table class="table table-bordered table-striped enq_tab_submit menu">
                                                    
                                                        <tr>
                                                            <td><button class="submit_btn" type="submit">Record</button></td>
                                                    
                                                        </tr>
                                                        
                                                    </table>
                        </div>


                        </div>


                        </div>




       
                    </div>

                    </form>






                    
                    <form  class="Dashboard-form class add_form" data-empid="" id="timesheet_edit_form">

                    <input class="" id="timesheet_edit_emp_id" type="hidden" name="emp_id" value="" autocomplete="off">

                    <div class="row align-items-start form_sec" id="timesheet_edit_sec">

                    <div class="col-lg-12">


                        <table class="table table-bordered">

                        <tr>

                        <th>Date</th>

                        <th>Day</th>

                        <th>Day Type</th>

                        <th>Time In</th>

                        <th>Time Out</th>

                        <th>Total Hours</th>

                        <th>Normal Hours</th>

                        <th>Normal Overtime</th>

                        <th>Friday OT</th>

                        </tr>

                        <tbody id="month_days_row_edit">


                        </tbody>

                        </table>





                        <div class="row align-items-center mb-2">


<div class="col-lg-4">

    <div class="row align-items-center mb-2">

    <div class="col-col-md-3 col-lg-3">

    <label for="basiInput" class="form-label">Working Days</label>

    </div>

    <div class="col-col-md-9 col-lg-9">

    <input id="working_days_edit" type="number" value="0" name="total_working_days" class="form-control" step=".01" min="0" required readonly>

    </div>

    </div>



    <div class="row align-items-center mb-2">

    <div class="col-col-md-3 col-lg-3">

    <label for="basiInput" class="form-label">Public Holiday</label>

    </div>

    <div class="col-col-md-9 col-lg-9">

    <input id="public_holiday_edit" type="number" value="0"  name="total_public_holidays" class="form-control" step=".01" min="0" required readonly>

    </div>

    </div>


    <div class="row align-items-center mb-2">

    <div class="col-col-md-3 col-lg-3">

    <label for="basiInput" class="form-label">Leave</label>

    </div>

    <div class="col-col-md-9 col-lg-9">

    <input id="leave_edit" type="number" value="0"  name="total_leaves" class="form-control" step=".01" min="0" required readonly>

    </div>

    </div>


    <!-- Unpaid leave sec -->

    <div class="row align-items-center mb-2">

    <div class="col-col-md-3 col-lg-3">

    <label for="basiInput" class="form-label">Unpaid Leave</label>

    </div>

    <div class="col-col-md-9 col-lg-9">

    <input id="unpaid_leave_edit" type="number" value="0"  name="total_unpaid_leaves" class="form-control" step=".01" min="0" required readonly>

    </div>

    </div>



    <div class="row align-items-center mb-2">

    <div class="col-col-md-3 col-lg-3">

    <label for="basiInput" class="form-label">Medical Leave</label>

    </div>

    <div class="col-col-md-9 col-lg-9">

    <input id="medical_leave_edit" type="number" value="0"  name="total_medical_leaves" class="form-control" step=".01" min="0" required readonly>

    </div>

    </div>


    <div class="row align-items-center mb-2">

    <div class="col-col-md-3 col-lg-3">

    <label for="basiInput" class="form-label">Normal OT</label>

    </div>

    <div class="col-col-md-9 col-lg-9">

    <input id="normal_ot_edit" type="number" value="0"  name="total_normal_ot" class="form-control" step=".01" min="0" required readonly>

    </div>

    </div>



    <div class="row align-items-center mb-2">

    <div class="col-col-md-3 col-lg-3">

    <label for="basiInput" class="form-label">Friday OT</label>

    </div>

    <div class="col-col-md-9 col-lg-9">

    <input id="friday_ot_edit" type="number" value="0"  name="total_friday_ot" class="form-control" step=".01" min="0" required readonly>

    </div>

    </div>




</div>




<!-- Sec 1 End -->




<!-- Sec2 Start -->



<div class="col-lg-4">

                        
<div class="row align-items-center mb-2">

<div class="col-col-md-3 col-lg-3">

<label for="basiInput" class="form-label">Basic Salary</label>

</div>

<div class="col-col-md-9 col-lg-9">

<input type="number" id="emp_basic_salary_edit"  name="basic_salary" class="form-control" step=".01" min="0" readonly>

</div>

</div>


<div class="row align-items-center mb-2">

<div class="col-col-md-3 col-lg-3">

<label for="basiInput" class="form-label">House Rent Allowance</label>

</div>

<div class="col-col-md-9 col-lg-9">

<input type="number" id="emp_rent_allowance_edit"  name="house_rent_allow" class="form-control" step=".01" min="0" readonly>

</div>

</div>


<div class="row align-items-center mb-2">

<div class="col-col-md-3 col-lg-3">

<label for="basiInput" class="form-label">Transportation Allowance</label>

</div>

<div class="col-col-md-9 col-lg-9">

<input type="number" id="emp_transp_allowance_edit"  name="transport_allow" class="form-control" step=".01" min="0" readonly>

</div>

</div>


<div class="row align-items-center mb-2">

<div class="col-col-md-3 col-lg-3">

<label for="basiInput" class="form-label">Telephone Allowance</label>

</div>

<div class="col-col-md-9 col-lg-9">

<input type="number" id="emp_telephone_allowance_edit"  name="telephone_allow" class="form-control" step=".01" min="0" readonly>

</div>

</div>


<div class="row align-items-center mb-2">

<div class="col-col-md-3 col-lg-3">

<label for="basiInput" class="form-label">Food Allowance</label>

</div>

<div class="col-col-md-9 col-lg-9">

<input type="number" id="emp_food_allowance_edit"  name="food_allowance" class="form-control" step=".01" min="0" readonly>

</div>

</div>


<div class="row align-items-center mb-2">

<div class="col-col-md-3 col-lg-3">

<label for="basiInput" class="form-label">Other Allowance</label>

</div>

<div class="col-col-md-9 col-lg-9">

<input type="number" id="emp_other_allowance_edit"  name="other_allow" class="form-control" step=".01" min="0" readonly>

</div>

</div>


<div class="row align-items-center mb-2">

<div class="col-col-md-3 col-lg-3">

<label for="basiInput" class="form-label">Total Hourly Salary</label>

</div>

<div class="col-col-md-9 col-lg-9">

<input id="edit_hourly_salary" type="number"  name="total_salary" class="form-control" min="0" readonly>

</div>

</div>


<div class="row align-items-center mb-2">

<div class="col-col-md-3 col-lg-3">

<label for="basiInput" class="form-label">Total Monthly Salary</label>

</div>

<div class="col-col-md-9 col-lg-9">

<input id="edit_total_salary" type="number"  name="total_salary" class="form-control" step=".01" min="0" readonly>

</div>

</div>


</div>


<!-- Sec 2 End -->





<!-- Sec 3 Start -->

<div class="col-lg-4">



<div class="row align-items-center mb-2">

<div class="col-col-md-3 col-lg-3">

<label for="basiInput" class="form-label">Leave</label>

</div>

<div class="col-col-md-9 col-lg-9">

<input id="edit_leave_total_amount" type="number"  name="total_leave_salary" class="form-control" step=".01" min="0" readonly>

</div>

</div>





<div class="row align-items-center mb-2">

<div class="col-col-md-3 col-lg-3">

<label for="basiInput" class="form-label">Unpaid Leave</label>

</div>

<div class="col-col-md-9 col-lg-9">

<input id="" type="number"  name="total_unpaid_leave_salary" class="form-control" step=".01" min="0"  readonly>

</div>

</div>




<div class="row align-items-center mb-2">

<div class="col-col-md-3 col-lg-3">

<label for="basiInput" class="form-label">Medical Leave</label>

</div>

<div class="col-col-md-9 col-lg-9">

<input id="" type="number"  name="total_medical_leave_salary" class="form-control" step=".01" min="0" readonly>

</div>

</div>



<div class="row align-items-center mb-2">

<div class="col-col-md-3 col-lg-3">

<label for="basiInput" class="form-label">Normal OT</label>

</div>

<div class="col-col-md-9 col-lg-9">

<input id="edit_total_normal_ot_salary" type="number"  name="total_normal_ot_salary" class="form-control" step=".01" min="0"  readonly>

</div>

</div>



<div class="row align-items-center mb-2">

<div class="col-col-md-3 col-lg-3">

<label for="basiInput" class="form-label">Friday OT</label>

</div>

<div class="col-col-md-9 col-lg-9">

<input id="edit_total_friday_ot_salary" type="number"  name="total_friday_ot_salary" class="form-control" step=".01" min="0"  readonly>

</div>

</div>




<div class="row align-items-center mb-2">

<div class="col-col-md-3 col-lg-3">

<label for="basiInput" class="form-label">Salary (Selected Month)</label>

</div>

<div class="col-col-md-9 col-lg-9">

<input id="edit_total_month_salary" type="number"  name="total_month_salary" class="form-control" step=".01" min="0" readonly>

</div>

</div>






</div>

<!-- Sec 3 End -->


                       

                        





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



 <!-- Edit Modal End -->





    <!-- ### -->

    
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">View Timesheets</h4>
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







</section>
						

										
										
</div>
       

</div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->


<!--footer section start-->

<?php echo view('includes/footer'); ?>


<script src="<?= base_url(); ?>public/assets/js/differenceHours.js"></script>

<!--footer section end-->    

<script>


     document.addEventListener("DOMContentLoaded", function(event) { 
    

        $('.sec_btn').click(function(){

        var sec = $(this).data('sec');

        $('.form_sec').hide();

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





        /* Main Add */    
   
        $(function() {
            $('#add_form').validate({
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
                        url: "<?php echo base_url(); ?>HR/Timesheets/FetchDays",
                        method: "POST",
                        //data: $(form).serialize(),
                        data:formData,
                        processData: false, 
                        contentType: false,
                        success: function(data) 
                        {

                            var data = JSON.parse(data);

                            if(data.status==0)
                            {
                             alertify.error(data.msg).delay(3).dismissOthers();    
                             return false;
                            }
                       
                            alertify.success('Fill details of the month').delay(3).dismissOthers();
                            // $('#add_form').attr('data-empid',data);
                            //$('.added_id').val(data);
                            $('#month_days_row').html(data.table);

                            $('#add_form').validate().form();

                            $('#timesheet_sec').show();

                            $('#timesheet_emp_id').val(data.emp_det.emp_id);

                            $('#emp_basic_salary').val(data.emp_det.emp_basic_salary);

                            $('#emp_rent_allowance').val(data.emp_det.emp_house_rent_allow);

                            $('#emp_transp_allowance').val(data.emp_det.emp_transport_allow);

                            $('#emp_telephone_allowance').val(data.emp_det.emp_tel_allow);

                            $('#emp_food_allowance').val(data.emp_det.emp_food_allow);

                            $('#emp_other_allowance').val(data.emp_det.emp_other_allow);

                            $('#add_hourly_salary').val(data.hour_salary);
                            
                            $('#add_total_salary').val(data.emp_det.emp_total_salary);


                            $('#working_days').val(0);

                            $('#public_holiday').val(0);

                            $('#leave').val(0);

                            $('#unpaid_leave').val(0);

                            $('#medical_leave').val(0);



                            datatable.ajax.reload( null, false)

                        }
                       
                    });
                    return false; // prevent the form from submitting
                }
            });
        });

        /*###*/





        $(function() {
          
            $('#timesheet_add_form').validate({
            
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
                        url: "<?php echo base_url(); ?>HR/Timesheets/Add",
                        method: "POST",
                        //data: $(form).serialize(),
                        data:formData,
                        processData: false, 
                        contentType: false,
                        success: function(data) 
                        {
                            var data = JSON.parse(data);

                            if(data.status==0)
                            {
                             alertify.error(data.msg).delay(3).dismissOthers();    
                             return false;
                            }
                            
                            alertify.success('Data Added Successfully').delay(3).dismissOthers();

                            datatable.ajax.reload( null, false);

                            $('#AddModal').modal('hide');

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

                url : "<?php echo base_url(); ?>HR/Timesheets/Edit",

                method : "POST",

                data: {ts_id: id},

                success:function(data)
                {   
                    if(data)
                    {
                    var data = JSON.parse(data);

                    $('#month_days_row_edit').html(data.month_table);

                    $('#working_days_edit').val(data.ts.ts_working_days);

                    $('#public_holiday_edit').val(data.ts.ts_public_holidays);

                    $('#leave_edit').val(data.ts.ts_leave);

                    $('#unpaid_leave_edit').val(data.ts.ts_unpaid_leave);

                    $('#medical_leave_edit').val(data.ts.ts_medical_leave);

                    $('#normal_ot_edit').val(data.ts.normal_ot_edit);

                    $('#friday_ot_edit').val(data.ts.ts_friday_ot);



                    
                    $('#EditModal').modal('show');

                    }
                    
                    
                }


            });
            
            
        });
        /*####*/


           /*account head modal start*/ 
           $("body").on('click', '.view_btn', function(){

                var id = $(this).data('id');

                $.ajax({

                    url : "<?php echo base_url(); ?>HR/Timesheets/View",

                    method : "POST",

                    data: {ts_id: id},

                    success:function(data)
                    {   
                    
                    var data = JSON.parse(data);

                    $('#emp_name_view').html(data.ts.emp_name);

                    $('#month_view').html(data.ts.month);

                    $('#year_view').html(data.ts.ts_year);

                    $('#days_row').html(data.ts_days);

                    $('#ViewModal').modal('show');


                    }


                });
              
            
            
        });
        /*####*/


       



        /*account head delete*/ 
        $("body").on('click', '.delete_btn', function(){ 
            
            if (!confirm('Are you absolutely sure you want to delete?')) return;
            var id = $(this).data('id');
            $.ajax({

                url : "<?php echo base_url(); ?>HR/Timesheets/Delete",

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
                    'url': "<?php echo base_url(); ?>HR/Timesheets/FetchData",
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
                    { data: 'ts_id' },
                    { data : "employee_id"},
                    { data : "employee_name" },
                    { data: 'month' },
                    { data : 'year'},
                    { data : 'working_days'},
                    { data: 'total_salary'},
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


          
        
        $(".add_te").select2({
        placeholder: "Select Employee",
        theme : "default form-control-",
        dropdownParent: $('#add_te_parent'),
        ajax: {
                url: "<?= base_url(); ?>HR/Timesheets/FetchEmployees",
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
                        results: $.map(data.result, function (item) { return {id: item.emp_id, text: item.emp_name}}),
                        pagination: {
                        // THE `10` SHOULD BE SAME AS `$resultCount FROM PHP, it is the number of records to fetch from table` 
                            more: (page * 10) <= data.total_count
                        }
                    };
                },              
            }
        })

        /*###*/




      
        $("body").on('input', '.time_to1', function(){ 

        var parent = $(this).closest('.day_row');

        var time1 = parent.find(".time_from").val().split(':');
        
        var time2 = parent.find(".time_to").val().split(':');

        var hours1 = parseInt(time1[0], 10), 
             hours2 = parseInt(time2[0], 10),
             mins1 = parseInt(time1[1], 10),
             mins2 = parseInt(time2[1], 10);

        /*
         var hours = hours2 - hours1, mins = 0;
         if(hours < 0) hours = 24 + hours;
         if(mins2 >= mins1) {
             mins = mins2 - mins1;
         }
         else {
             mins = (mins2 + 60) - mins1;
             hours--;
         }
         mins = mins / 60; // take percentage in 60
         hours += mins;
         hours = hours.toFixed(2);
         //$(".Hours").val(hours);
         */

       // Get the values of time_from and time_to inputs
        var timeFrom = parent.find(".time_from").val();
        var timeTo = parent.find(".time_to").val();

        // Parse the time values into hours and minutes
        var fromHours = parseInt(timeFrom.split(':')[0]);
        var fromMinutes = parseInt(timeFrom.split(':')[1]);
        var toHours = parseInt(timeTo.split(':')[0]);
        var toMinutes = parseInt(timeTo.split(':')[1]);

        // Calculate the difference in minutes
        var diffMinutes = (toHours * 60 + toMinutes) - (fromHours * 60 + fromMinutes);

        // Convert minutes difference into hours and remaining minutes
        var hours = Math.floor(diffMinutes / 60);
        var minutes = diffMinutes % 60;

        var formattedHours = hours + (minutes / 60);

        // Display the total hours and minutes in the .total_hours input
        parent.find('.total_hours').val(formattedHours.toFixed(2));

         //console.log(hours);

        });



        $("body").on('input change', '.time_to', function(){

            var parent = $(this).closest('.day_row');

            var time1 = parent.find(".time_from").val().split(':');

            var time2 = parent.find(".time_to").val().split(':');

            var elem = parent.find('.total_hours');

            let hours;
            let minute;

        if (parseInt(time1[0]) < parseInt(time2[0]) && parseInt(time1[1]) < parseInt(time2[1])) {

            //As for the addition, the subtraction is carried out separately, column by column.
            hours = parseInt(time2[0]) - parseInt(time1[0]);
            minute =   parseInt(time2[1]) - parseInt(time1[1]);

            // alert(time1[0]);

            // alert(time2[0]);

            let _hours = '';
            let _minute = '';

            if (hours < 10) {
                _hours ='0' + hours;
            } else {
                _hours = hours;
            }

            if (minute < 10) {
                _minute = '0' + minute;
            } else {
                _minute = minute;
            }

            elem.val(_hours +'.'+ _minute +'')


        }else if (parseInt(time2[0]) > parseInt(time1[0])) {
            if (parseInt(time2[1]) < parseInt(time1[1])) {

                // As before we subtract column by column ... and we realize that it's impossible because our minute in second hour is greater than our minute in first hour
                // We will transform 1 hour in 60 minutes
                let _hours = parseInt(time2[0]) - 1;
                let _minute = parseInt(time2[1]) + 60;
                let final_hours = '';
                let final_min = '';

                hours = _hours - parseInt(time1[0]);
                minute = _minute - parseInt(time1[1]);

                if (hours < 10) {
                    final_hours = '0' + hours;
                } else {
                    final_hours = hours;
                }

                if (minute < 10) {
                    final_min = '0' + minute;
                } else {
                    final_min = minute;
                }
                elem.val(final_hours + '.' + final_min)
            }

            if (parseInt(time2[1]) === parseInt(time1[1])) {
                hours = parseInt(time2[0]) - parseInt(time1[0]);
                let final_hours = '';

                if (hours < 10) {
                    final_hours = '0' + hours;
                } else {
                    final_hours = hours;
                }

                elem.val(final_hours + '.' + '00')
            }

        }else if (parseInt(time1[0]) > parseInt(time2[0])) {
            let first_hour_only_hour = parseInt(time1[0]);
            let second_hour_only_hour = parseInt(time2[0]);

            let first_hour_only_min = parseInt(time1[1]);
            let second_hour_only_min = parseInt(time2[1]);

            let tmp_hour = 24 - first_hour_only_hour;
            let tmp_ttl_hour = tmp_hour + second_hour_only_hour;

            let tmp_ttl_min = first_hour_only_min + second_hour_only_min;
            let tmp_new_hour = 0;
            let tmp_new_min_mod = 0;

            let _hours = '';
            let _min = '';

            if (tmp_ttl_min > 59) {
                tmp_new_hour = parseInt(tmp_ttl_min/60);
                tmp_new_min_mod = tmp_ttl_min%60;

                tmp_ttl_hour += tmp_new_hour;
            } else {
                tmp_new_min_mod = tmp_ttl_min
            }

            if (tmp_ttl_hour < 10) {
                _hours = '0' + tmp_ttl_hour;
            } else {
                _hours = tmp_ttl_hour
            }

            if (tmp_new_min_mod < 10) {
                _min = '0' + tmp_new_min_mod
            } else {
                _min = tmp_new_min_mod
            }

            elem.val(_hours + '.' + _min)
        } else if (parseInt(time1[0]) === parseInt(time2[0])) {
            hours = '00';
            let minute = 0;
            if (parseInt(time1[1]) < parseInt(time2[1])) {
                minute = parseInt(time2[1]) - parseInt(time1[1]);
            }

            if (minute < 10) {
                elem.val(hours + '.0' + minute)
            } else  {
                elem.val(hours + '.' + minute)
            }
        }else if (parseInt(time1[0]) === 0 && parseInt(time1[1]) === 0) {
            hours = parseInt(time2[0]);
            minute = parseInt(time2[1]);

            if (hours === 0) {
                elem.val('00.' + minute)
            }else if (minute === 0){
                if (hours < 10) {
                    elem.val('0' + hours + '.00');
                }else {
                    elem.val(hours + '.00');
                }
            }else {
                elem.val(hours + '.' + minute)
            }
        }



        });
       





        $("body").on('change', '.day_type', function(){
            
            parent = $(this).closest('.day_row');

            leave = 0;

            medical_leave = 0;

            public_holidays = 0;

            unpaid_leave = 0;

            working_days = 0;

            per_day_salary = $('#add_total_salary').val()/30;

            leave_amount = 0;

            parent.find('.time_from').val('').trigger('change');

            parent.find('.time_to').val('').trigger('change');

            if($(this).val()=="1")
            {

            parent.find('input').attr('required',true);

            parent.find('.time_from').removeAttr('readonly');

            parent.find('.time_to').removeAttr('readonly');

            }   
            else
            {

            parent.find('input').removeAttr('required');

            parent.find('.time_from').attr('readonly',true);

            parent.find('.time_to').attr('readonly',true);

            parent.find('.total_hours').val(0);

            parent.find('.normal_hours').val(0);

            parent.find('.normal_ot').val(0);

            parent.find('.friday_ot').val(0);

            }


            $('body .day_type').each(function(i, obj) {

                if($(this).val()== 1)
                {
                
                working_days++;

         
                //$(this).children("option").filter(":selected").text();

                }

                else
                {

               

                }

                if($(this).val() ==2)
                {
                public_holidays++;
                }

                if($(this).val() ==3)
                {
                
                leave++;

                leave_amount = leave_amount+=per_day_salary;

                $('#leave_total_amount').val(leave_amount.toFixed(2));


                }

                if($(this).val() ==4)
                {
                unpaid_leave++;
                }

                if($(this).val() ==5)
                {

                medical_leave++;

                }

                
            });


            
            $('#working_days').val(working_days);

            $('#public_holiday').val(public_holidays);

            $('#leave').val(leave);

            $('#unpaid_leave').val(unpaid_leave);

            $('#medical_leave').val(medical_leave);

            salary_calc();


        });




        $("body").on('change', '.normal_ot', function(){

            var total_normal_ot_hours = 0;

            var total_normal_ot_days = 0;
            
            $('body .normal_ot').each(function(i, obj) {

            ot = parseFloat($(this).val())||0;

            if(ot>0)
            {

            total_normal_ot_days++;

            }

            total_normal_ot_hours = total_normal_ot_hours + ot;

            });

            $('#normal_ot').val(total_normal_ot_days);

            //salary_calc();


        });


        $("body").on('change', '.friday_ot', function(){

        var total_friday_ot_hours = 0;

        var total_friday_ot_days = 0;

        $('body .friday_ot').each(function(i, obj) {

        friday_ot = parseFloat($(this).val())||0;

        if(friday_ot>0)
            {

                total_friday_ot_days++;

            }

        total_friday_ot_hours = total_friday_ot_hours + friday_ot;

        });

        $('#friday_ot').val(total_friday_ot_days);

        //salary_calc();

        });





        /*
        $("body").on('change keyup', '.total_hours', function(){

            salary_calc();

        });
        */




        $("body").on('change keyup', '.normal_ot,.normal_hours,.friday_ot', function(){

         var parent = $(this).closest('.day_row');

         var total_hours = parent.find('.total_hours').val();

         if(total_hours<1)
         {

        alertify.error('Enter total hours first!').delay(3).dismissOthers();
        
        parent.find('.total_hours').focus();

        $(this).val('');

        return false;

         }

         else
         {

            var normal_hours = parseFloat(parent.find('.normal_hours').val())||0;

            var normal_ot = parseFloat(parent.find('.normal_ot').val())||0;

            var friday_ot = parseFloat(parent.find('.friday_ot').val())||0;

            //var entered_val = $(this).val();

            var total = normal_hours+normal_ot+friday_ot;

            if(total_hours<total)
            {
              alertify.error('Total Hours exceeded!').delay(3).dismissOthers();
              $(this).val('');
              return false;
            }
            

         }

         salary_calc();

    
        });







        function salary_calc()
        {

        var hourly_salary = parseFloat($('#add_hourly_salary').val())||0;

        var total_normal_ot = 0;

        var total_friday_ot= 0;

        var total_hours_month = 0;

        var total_salary_month = 0;

        var total_leave = 0;

        var total_unpaid_leave=0;

        var total_medical_leave = 0;

        //Normal Ot Calculation Start

        $('.normal_ot').each(function(){

        total_normal_ot+=parseFloat($(this).val())||0;

        });
        
        var total_normal_ot_salary = total_normal_ot*hourly_salary;

        $('#total_normal_ot_salary').val(total_normal_ot_salary.toFixed(2));

        //Normal OT Calculation End


        //Friday OT Calcualation Start

        $('.friday_ot').each(function(){

        total_friday_ot+=parseFloat($(this).val())||0;

        });

        total_friday_ot_salary = total_friday_ot*hourly_salary;

        $('#total_friday_ot_salary').val(total_friday_ot_salary.toFixed(2));

        //Friday OT Calculation End



         //Calculate Total Salary Start

        $('.total_hours').each(function(){

        total_hours_month+=parseFloat($(this).val())||0;

        });


        //Paid Leave

        total_paid_leave = parseFloat($('#leave_total_amount').val())||0;


        total_salary_month = total_hours_month*hourly_salary;

        total_salary_month = total_paid_leave+total_salary_month;


        $('#total_month_salary').val(total_salary_month.toFixed(2));

        //Calculate Total Salary End


        }




        


    
    });



</script>



	
</body>



</html>









            
