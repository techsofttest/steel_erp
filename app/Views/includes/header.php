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

<style>
    label.error 
    {
        color: red;
    }

    /* For Select 2 Dropdown */

    
    .select2-container {
    vertical-align: unset !important;
    height: calc(1.5em + 1rem + calc(var(--vz-border-width) * 2)) !important;
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
    border: 1px solid red;
    }

    .form-control-
    {
        margin-bottom:10px;
        /*padding: 0.5rem 0.9rem;*/
        line-height: 1.5;
        /*appearance: none;*/
        background-color: var(--vz-input-bg-custom);
        border: var(--vz-border-width) solid var(--vz-input-border-custom);
        border-radius: var(--vz-border-radius);
    }

    .tecs span 
    {
        color: green;
    }
    .remainpass
    {
        color: var(--theme-color);
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
    padding-bottom: 0px !important;
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




    /* ##### */
     

    
</style>

</head>

<body>

<!-- Begin page -->
<div id="layout-wrapper">
    <header id="page-topbar">
        <div class="layout-width">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
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

                    <!-- App Search-->
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

                

                    <div class="dropdown topbar-head-dropdown ms-1 header-item" id="notificationDropdown">
                        <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                            <i class='bx bx-bell fs-22'></i>
                            <span class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">4<span class="visually-hidden">unread messages</span></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">

                            <div class="dropdown-head bg-primary bg-pattern rounded-top">
                                <div class="p-3">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0 fs-16 fw-semibold text-white"> Notifications </h6>
                                        </div>
                                        <div class="col-auto dropdown-tabs">
                                            <span class="badge bg-light-subtle text-body fs-13"> 4 New</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="px-2 pt-2">
                                    <ul class="nav nav-tabs dropdown-tabs nav-tabs-custom" data-dropdown-tabs="true" id="notificationItemsTab" role="tablist">
                                        <li class="nav-item waves-effect waves-light">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#all-noti-tab" role="tab" aria-selected="true">
                                                All (4)
                                            </a>
                                        </li>
                                    

                                    </ul>
                                </div>

                            </div>

                            <div class="tab-content position-relative" id="notificationItemsTabContent">
                                <div class="tab-pane fade show active py-2 ps-2" id="all-noti-tab" role="tabpanel">
                                    <div data-simplebar style="max-height: 300px;" class="pe-2">
                                        <div class="text-reset notification-item d-block dropdown-item position-relative">
                                            <div class="d-flex">
                                                <div class="avatar-xs me-3 flex-shrink-0">
                                                    <span class="avatar-title bg-info-subtle text-info rounded-circle fs-16">
                                                        <i class="bx bx-badge-check"></i>
                                                    </span>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <a href="#!" class="stretched-link">
                                                        <h6 class="mt-0 mb-2 lh-base">Your <b>Elite</b> author Graphic
                                                            Optimization <span class="text-secondary">reward</span> is
                                                            ready!
                                                        </h6>
                                                    </a>
                                                    <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                        <span><i class="mdi mdi-clock-outline"></i> Just 30 sec ago</span>
                                                    </p>
                                                </div>
                                                <div class="px-2 fs-15">
                                                    <div class="form-check notification-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="all-notification-check01">
                                                        <label class="form-check-label" for="all-notification-check01"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-reset notification-item d-block dropdown-item position-relative">
                                            <div class="d-flex">
                                                <img src="<?php echo base_url(); ?>public/assets/images/users/avatar-2.jpg" class="me-3 rounded-circle avatar-xs flex-shrink-0" alt="user-pic">
                                                <div class="flex-grow-1">
                                                    <a href="#!" class="stretched-link">
                                                        <h6 class="mt-0 mb-1 fs-13 fw-semibold">Angela Bernier</h6>
                                                    </a>
                                                    <div class="fs-13 text-muted">
                                                        <p class="mb-1">Answered to your comment on the cash flow forecast's
                                                            graph 🔔.</p>
                                                    </div>
                                                    <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                        <span><i class="mdi mdi-clock-outline"></i> 48 min ago</span>
                                                    </p>
                                                </div>
                                                <div class="px-2 fs-15">
                                                    <div class="form-check notification-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="all-notification-check02">
                                                        <label class="form-check-label" for="all-notification-check02"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-reset notification-item d-block dropdown-item position-relative">
                                            <div class="d-flex">
                                                <div class="avatar-xs me-3 flex-shrink-0">
                                                    <span class="avatar-title bg-danger-subtle text-danger rounded-circle fs-16">
                                                        <i class='bx bx-message-square-dots'></i>
                                                    </span>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <a href="#!" class="stretched-link">
                                                        <h6 class="mt-0 mb-2 fs-13 lh-base">You have received <b class="text-success">20</b> new messages in the conversation
                                                        </h6>
                                                    </a>
                                                    <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                        <span><i class="mdi mdi-clock-outline"></i> 2 hrs ago</span>
                                                    </p>
                                                </div>
                                                <div class="px-2 fs-15">
                                                    <div class="form-check notification-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="all-notification-check03">
                                                        <label class="form-check-label" for="all-notification-check03"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-reset notification-item d-block dropdown-item position-relative">
                                            <div class="d-flex">
                                                <img src="<?php echo base_url(); ?>public/assets/images/users/avatar-8.jpg" class="me-3 rounded-circle avatar-xs flex-shrink-0" alt="user-pic">
                                                <div class="flex-grow-1">
                                                    <a href="#!" class="stretched-link">
                                                        <h6 class="mt-0 mb-1 fs-13 fw-semibold">Maureen Gibson</h6>
                                                    </a>
                                                    <div class="fs-13 text-muted">
                                                        <p class="mb-1">We talked about a project on linkedin.</p>
                                                    </div>
                                                    <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                        <span><i class="mdi mdi-clock-outline"></i> 4 hrs ago</span>
                                                    </p>
                                                </div>
                                                <div class="px-2 fs-15">
                                                    <div class="form-check notification-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="all-notification-check04">
                                                        <label class="form-check-label" for="all-notification-check04"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    
                                    </div>

                                </div>

                                
                                
                            </div>
                        </div>
                    </div>

                    <div class="dropdown ms-sm-3 header-item topbar-user">
                        <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="d-flex align-items-center">
                                <img class="rounded-circle header-profile-user" src="<?php echo base_url(); ?>public/assets/images/users/avatar-1.jpg" alt="Header Avatar">
                                <span class="text-start ms-xl-2">
                                    <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">Anna Adame</span>
                                    <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text">Admin</span>
                                </span>
                            </span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <h6 class="dropdown-header">Welcome Anna!</h6>
                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Password Reset</span></a>
                        
                            <a class="dropdown-item" href="<?= base_url(); ?>Logout" onclick="return confirm('Are you sure you want to logout?')"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Logout</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>