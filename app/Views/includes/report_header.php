<?php  $uri = new \CodeIgniter\HTTP\URI(current_url());?>
<!-- App favicon -->
<link rel="shortcut icon" href="<?php echo base_url(); ?>public/assets/images/favicon.png">

<!-- jsvectormap css -->
<link href="<?php echo base_url(); ?>public/assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css" />

<!--Swiper slider css-->
<!--
<link href="<?php echo base_url(); ?>public/assets/libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css" />
-->

<!-- Layout config Js -->
<!--
<script src="<?php echo base_url(); ?>public/assets/js/layout.js"></script>
-->

<!-- Bootstrap Css -->
<link href="<?php echo base_url(); ?>public/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="<?php echo base_url(); ?>public/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="<?php echo base_url(); ?>public/assets/css/app.min.css" rel="stylesheet" type="text/css" />
<!-- custom Css-->
<link href="<?php echo base_url(); ?>public/assets/css/custom.min.css" rel="stylesheet" type="text/css" />

<!--<link href="<?php echo base_url(); ?>public/assets/js/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />--->

<!--alertify css-->
<link href="<?php echo base_url(); ?>public/assets/css/alertify.min.css" rel="stylesheet">

<link href="<?php echo base_url(); ?>public/assets/css/alertify.default.min.css" rel="stylesheet">

<link href="<?php echo base_url(); ?>public/assets/css/select2.min.css" rel="stylesheet">

<!-- Datatable CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css"/>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.8.5/css/selectize.default.css"/>

<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">

<script src="<?php echo base_url(); ?>public/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="<?php echo base_url(); ?>public/assets/code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>


<style>





.print_button {
    background: blueviolet;
    border: blueviolet;
}

.email_button {
    background: dodgerblue;
    border: dodgerblue;
}


    /* Form Validation */
    label.error 
    {
        color: red;
    }

    .error ~ .select2 .select2-selection__rendered 
    {
        border: 1px solid red !important;
    }


    .form-control:focus
    {
        border:1px solid !important;
    }

   
    /* For Select 2 Dropdown */

    
    .select2-container {
    vertical-align: unset !important;
    /*height: calc(1.5em + 1rem + calc(var(--vz-border-width) * 2)) !important;*/
    height:unset !important;
    }

    .select2-container--default .select2-selection--single {
    background-color: unset !important;
    border: unset !important;  
    border-radius: 4px; 
    }

    .select2-container--open {
    z-index: 9999999
    }
    
    .form-control.error {
    border: 1px solid red !important;
    }

    .form-select.error {
    border: 1px solid red !important;
    }

    .form-control-
    {
      
        line-height: 1.5;
        /*appearance: none;*/
        background-color: var(--vz-input-bg-custom);
        border: unset;
        border-bottom: 1px solid #0000003b;
        border-radius: 0px;
        margin-bottom: 5px;
    }

    .tecs span 
    {
        color: green;
        cursor: pointer;
    }
    .remainpass
    {
        color: var(--theme-color);
        cursor: pointer;
    }
    .travelerinfo td
    {
        color: black;
    }
    .tab_attachment_head h5
    {
        color: black;
        font-weight: 500;
        margin-top: 12px;
        margin-bottom: 25px;
    }
    .view_tab_cond td
    {
        /*width: 50%;*/
    }
    


    /* New Form Styles */

    .btn-close{
    right: 10px;
    position: absolute;
    }

    .card-header .btn {
    --vz-btn-line-height: 1.2 !important;
    }
 

    .Dashboard-form label {
    color: black;
    font-size: 12px;
    }


    .form-control
    {
       padding:0.3rem 0.3rem 0.3rem 0.3rem !important;
    }

    .form-select{
    padding: 0.3rem 2.7rem 0.3rem 0.3rem !important;
    }

    :root {
    --vz-modal-header-padding: 0.25rem 0.25rem !important;
    }

    .btn {
    --vz-btn-line-height: 0.9 !important;
    }

    .modal-body {
    padding-top: 10px !important;
    padding-bottom: 19px !important;
    }

    .modal-header {
    justify-content:center !important;
    padding: 1rem 1rem 0rem 1rem !important;

    }

    .live-preview .row
    {

    justify-content:center;

    }

    .modal-footer
    {
    justify-content:center;
    padding-top: 4px !important;
    padding-bottom: 4px !important;

    }
    .row_remove
    {
        color: red !important;
        cursor: pointer;
    }
    .edit_add_more_div
    {
        text-align: center;
        padding-bottom: 18px;
        
    }
    .add_more_icon
    {
        cursor: pointer;
       
        
    }
    
    .remove-cost
    {
        position: relative;
        top: -37px;
        left: 1093px;
    }
    
    .non_border_input 
    {
        border: 0;
        outline: none;
    }

    #total_cost_id
    {
        font-size: 17px;
        color: black;
    }
   
    .divider 
    {
        border-bottom: 1px solid #eee3e3;
        margin: 15px 0px;
    }
    .print_color i
    {
        color:red;
    }
    .row_edit
    {
        
        color: green !important;
        cursor: pointer;
    }
    .cust_img_text_stl
    {
      
        color: black !important;
        font-weight: 300 !important;
    }
    /* ##### */

    /*crm report icons*/
    .report_icon i
    {
        font-size: 18px;
    }

    .report_icon 
    {
        margin-right: 2px;
    }
    
    .report_icon_excel i
    {
        color: green;
    }

    .report_icon_pdf i
    {
        color:red;
    }

    .report_icon_mail i
    {
        color: dodgerblue;
    }
    .table
    {
        --vz-table-striped-bg: unset;
    }
    /*######*/



    /* New Layout Input Style */

.Dashboard-form .form-control {
border: unset;
border-bottom: 1px solid #0000003b;
border-radius: 0px;
margin-bottom: 5px;
}

.Dashboard-form .form-select {
margin-bottom:5px;
border: unset;
border-bottom: 1px solid #0000003b;
border-radius: 0px;
}

.Dashboard-form label {
margin: 0;

}

.card-seprate_divider{
    border-top: 1px solid #f4f4f4;
    margin-bottom: 20px;
}
.sub_heading{
    display: flex;
    align-items: center;
    justify-content: flex-end;
    margin-top: -16px
}
.sub_heading_text{
    padding: 8px 11px;
    margin-right: 10px;
}
.sub_heading_btn {
    background: #d3d3d347;
    color: #405189;
    border-radius: 5px;
    border: unset;
    
}
.border_top{
    border-top: 3px solid #405189 !important;  
}


.enq_tab_submit button
{
    border: unset;
    background: unset;
}
     
table {
    width: 100%;
}
table.menu {
    width: auto;
    margin-right: 0px;
    border: 1px solid;
   
}
table.menu td{
    padding: 10px 30px;
    border: 1px solid;
    
    --vz-table-bg-type: var(--vz-table-striped-bg);
}
.sub_heading_btn{
    color: #000000ba;
    
   
}


.table-bordered tr
    {
    border-bottom: 1px solid #0000003b !important;
    border: unset;
    }

    .table-bordered tbody, td, tfoot, th, thead, tr
    {

    border:unset;

}
.select2-container
{
    color: black;
    font-weight: 500;
}

.cust_img_rgt_border
{
    border-right: 1px solid #9E9E9E;
}



/* Global Ajax Loader */

#overlay{	
  position: fixed;
  top: 0;
  z-index: 9999;
  width: 100%;
  height:100%;
  display: none;
  background: rgba(0,0,0,0.6);
}
.cv-spinner {
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;  
}
.spinner {
  width: 40px;
  height: 40px;
  border: 4px #ddd solid;
  border-top: 4px #2e93e6 solid;
  border-radius: 50%;
  animation: sp-anime 0.8s infinite linear;
}
@keyframes sp-anime {
  100% { 
    transform: rotate(360deg); 
  }
}



/* Datatable Alignment For Currency */
/*
.ReportTable>table.tfoot th, table.tfoot td,table.dataTable thead th, table.dataTable thead td{
    text-align: end;
}

.ReportTable>.table-bordered tr {
    text-align: end;
}

.ReportTable>thead th, thead td,table.dataTable tfoot td,table.dataTable tfoot th {
    text-align: end;
}
    */


/* ## */


/* ##### */





</style>

</head>

<body>


<div id="overlay">
  <div class="cv-spinner">
    <span class="spinner"></span>
  </div>
</div>



<!-- Begin page -->
<div id="layout-wrapper">
    <!---<header id="page-topbar">
        <div class="layout-width">
            <div class="navbar-header">
                <div class="d-flex">
                    

                    <div class="navbar-brand-box horizontal-logo">
                        
                        <a href="<?= base_url(); ?>" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="<?php echo base_url(); ?>public/assets/images/logo.png" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="<?php echo base_url(); ?>public/assets/images/logo.png" alt="" height="17">
                            </span>
                        </a>

                        <a href="<?= base_url(); ?>" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="<?php echo base_url(); ?>public/assets/images/logo.png" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="<?php echo base_url(); ?>public/assets/images/logo.png" alt="" height="17">
                            </span>
                        </a>

                    </div>

                    <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
                        <span class="hamburger-icon">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </button>

                    
                    <form class="app-search d-none">
                        <div class="position-relative">
                            <input type="text" class="form-control" placeholder="Search..." autocomplete="off" id="search-options" value="">
                            <span class="mdi mdi-magnify search-widget-icon"></span>
                            <span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none" id="search-close-options"></span>
                            <span id="search-dropdown"></span>
                        </div>
                        
                    </form>
                </div>

                <div class="d-flex align-items-center">

                

                    <div class="ms-1 header-item d-none d-sm-flex">
                        <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" data-toggle="fullscreen">
                            <i class='bx bx-fullscreen fs-22'></i>
                        </button>
                    </div>

                

                

                    <div class="dropdown ms-sm-3 header-item topbar-user">
                        <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="d-flex align-items-center">
                                <img class="rounded-circle header-profile-user" src="<?php echo base_url(); ?>public/assets/images/users/user-dummy-img.jpg" alt="Header Avatar">
                                <span class="text-start ms-xl-2">
                                    <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text"><?php echo !empty(session()->get('admin_name')) ? session()->get('admin_name') : "Admin" ?></span>
                                </span>
                            </span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            
                            <h6 class="dropdown-header">Welcome <?php echo !empty(session()->get('admin_name')) ? session()->get('admin_name') : "Admin" ?>!</h6>
                            <a class="dropdown-item" href="<?php echo base_url(); ?>ChangePassword"><i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Change Password</span></a>
                        
                            <a class="dropdown-item" href="<?= base_url(); ?>Logout" onclick="return confirm('Are you sure you want to logout?')"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Logout</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>-->