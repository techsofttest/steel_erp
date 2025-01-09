<?php  $uri = new \CodeIgniter\HTTP\URI(current_url());?>

<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">

        <!-- Dark Logo-->
        <a href="<?= base_url(); ?>" class="logo logo-dark">
            <span class="logo-sm">
                <img src="<?php echo base_url(); ?>public/assets/images/logo.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?php echo base_url(); ?>public/assets/images/logo.png" alt="" height="17">
            </span>
        </a>

        <!-- Light Logo-->
        <a href="<?= base_url(); ?>" class="logo logo-light">
            <span class="logo-sm">
                <img src="<?php echo base_url(); ?>public/assets/images/logo.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?php echo base_url(); ?>public/assets/images/logo.png" alt="" height="100">
            </span>
        </a>

        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
				
        <!--
		<div  class="row dashbaord-items">
			<div  class="col-4"><small >Sales</small><h6 ></h6></div>
			    <div  class="col-4"><small >Order</small><h6 ></h6></div>
			        <div  class="col-4"><small >Revenue</small><h6 ></h6></div>
			    </div>

        -->


            </div>
			

            <div id="scrollbar">
                <div class="container-fluid">

                    <div id="two-column-menu"></div>
                    
                        <ul class="navbar-nav" id="navbar-nav">
                      
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?= base_url(); ?>"   >
                                    <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboard</span>
                                </a>
                                
                            </li> <!-- end Dashboard Menu -->
                            
                            
                            <?php


                               
                               
                                $permissionsArray = array_map(function($permission) {
                                    return $permission->per_module;
                                }, $permissions);
                                
                                if(in_array('Accounts', $permissionsArray)){ ?> 
                                
                                    <li class="nav-item">

                                        <a class="nav-link menu-link <?php if($uri->getSegment(2)=="Accounts") {echo "active" ;} ?>" href="<?= base_url() ?>Accounts/AccountHead">
                                            <i class="ri-pie-chart-line"></i> <span data-key="t-accounts">Accounts Module</span>
                                        </a>

                                    </li>
                                
                                <?php } 


                                if (in_array('Crm', $permissionsArray)) { ?> 

                                    <li class="nav-item">
                                    
                                        <a class="nav-link menu-link <?php if($uri->getSegment(2)=="Crm") {echo "active" ;} ?>" href="<?= base_url() ?>Crm/ProductHead" >
                                            <i class="ri-compasses-2-line"></i> <span data-key="t-crm">CRM Module</span>
                                        </a>
                        
                                    </li>


                                <?php }  
                                
                                

                                if(in_array('Procurement', $permissionsArray)){ ?> 

                                    <li class="nav-item">

                                        <a class="nav-link menu-link <?php if($uri->getSegment(2)=="Procurement") {echo "active" ;} ?>" href="<?php echo base_url();?>Procurement/Vendor" >
                                            <i class="ri-map-pin-line"></i> <span data-key="t-procurement">Procurement Module</span>
                                        </a>

                                    </li>

                                <?php } 

                                if(in_array('HR', $permissionsArray)){ ?> 

                                    <li class="nav-item">

                                        <a class="nav-link menu-link <?php if($uri->getSegment(2)=="HR") {echo "active" ;} ?>" href="<?php echo base_url();?>HR/Employees" >
                                            <i class="ri-stack-line"></i> <span data-key="t-human">Human Resource</span>
                                        </a>

                                    </li>

                                
                                <?php }
                                
                                ?>

                                <?php

                                    if(session()->get('admin_role')==1){ ?>


                                        <li class="nav-item">

                                        <a class="nav-link menu-link <?php if($uri->getSegment(2)=="User") {echo "active" ;} ?>" href="<?php echo base_url();?>User" >
                                            <i class="ri-user-3-fill"></i> <span data-key="t-human">User</span>
                                        </a>

                                        </li>


                                <?php }  ?>
                                
                                
                                
                                
                                

                                
                            

						
						    <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-components">Pages</span></li>


                            <?php  
                            if(session()->get('admin_role')==1)

                            {

                            ?>

                            <li class="nav-item">
                                <a class="nav-link menu-link <?php if($uri->getSegment(2)=="Companies") {echo "active" ;} ?>" href="<?php echo base_url(); ?>Companies" >
                                    <i class="ri-layout-grid-line"></i> <span data-key="t-company">Company</span>
                                </a>
                                
                            </li>

                            <?php } ?>

                            

                            <li class="nav-item">
                                <a class="nav-link menu-link <?php if($uri->getSegment(2)=="Executives") {echo "active" ;} ?>" href="<?php echo base_url(); ?>Executives">
                                    <i class="ri-file-list-3-line"></i> <span data-key="t-executives">Executives</span>
                                </a>
                                
                            </li>



                            <li class="nav-item">
                                <a onclick="return confirm('Are you sure you want to logout?')" class="nav-link menu-link" href="<?= base_url(); ?>Logout" >
                                    <i class="ri-account-circle-line"></i> <span data-key="t-crm">Logout</span>
                                </a>
                            
                            </li>
						
						    <br><br>

                        </ul>
                    </div>
                <!-- Sidebar -->
                </div>

            <div class="sidebar-background"></div>
        </div>