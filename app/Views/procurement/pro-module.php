<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Al Fuzail Engineering Services WLL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />
    <meta content="" name="author" />
   
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



            <!--sub header section start-->

            <?php echo view('crm/sub_header');?>

            <!--sub header section end-->


				<div class="tab-content text-muted">
                                       
                    <div class="tab-pane active" id="crm-nav-1" role="tabpanel">

					<!--crm sub header start--->
                                    
                    <?php echo view('crm/pro_sub_header');?>

                    <!--crm sub header end-->
									
					
                    <!---product detail section start--->
                    
                    <?php echo $content;?>

                    <!--product detill section end-->



                                           
                </div>
										
										

                                    
            </div>
										
										
										
		</div>
										
	</div>
										
										
	</div>
										
							
                                       
    </div><!-- end tab -->
                                           
    </div>

    </div>
                     
     </div>
    <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

            
    <!--footer section start-->

    <?php echo view('includes/footer');?> 

    <!--footer section end-->
	
	


</body>



</html>