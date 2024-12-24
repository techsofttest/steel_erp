<?php  $uri = new \CodeIgniter\HTTP\URI(current_url());?>

<ul class="nav nav-pills nav-custom-outline nav-primary mb-3" role="tablist">


    <li class="nav-item waves-effect waves-light">
        <a class="nav-link <?php if($uri->getSegment(3)=="Employees") {echo "active" ;} ?>" href="<?= base_url(); ?>HR/Employees" >Employee</a>
    </li>

    <li class="nav-item waves-effect waves-light">
        <a class="nav-link <?php if($uri->getSegment(3)=="Timesheets") {echo "active" ;} ?>" href="<?= base_url(); ?>HR/Timesheets">Timesheet</a>
    </li>

    <li class="nav-item waves-effect waves-light">
        <a class="nav-link <?php if($uri->getSegment(3)=="Payroll") {echo "active" ;} ?>" href="<?= base_url(); ?>HR/Payroll">Payroll</a>
    </li>

    <li class="nav-item waves-effect waves-light">
        <a class="nav-link <?php if($uri->getSegment(3)=="VacationTravel") {echo "active" ;} ?>" href="<?= base_url(); ?>HR/VacationTravel">Vacation Travel</a>
    </li>


    <li class="nav-item waves-effect waves-light">
        <a class="nav-link <?php if($uri->getSegment(3)=="Indemnity") {echo "active" ;} ?>" href="<?= base_url(); ?>HR/Indemnity">Indemnity</a>
    </li>
  

</ul>