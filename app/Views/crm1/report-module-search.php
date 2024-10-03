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
    
    <style>
        #page-topbar{
            width: 100%;
            left: unset;
        }
        .main-content{
            margin-left: unset;
        }
        .footer{
            left: unset;
            width: 100%;
        }
        .pdf_button {
            background: red;
            border: red;
        }
        .report_button {
            margin-right: 14px;
            color: white;
            padding: 3px 11px;
            border-radius: 4px;
        }
        .excel_button {
            background: green;
            border: green;
        }
        .email_button{
            background: dodgerblue;
            border: dodgerblue;
        }
        .print_button{
            background: blueviolet;
            border: blueviolet;
        }
    </style>
     
 

    <!-- Vertical Overlay-->
    <div class="vertical-overlay"></div>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
                
            <div class="container-fluid">




				<div class="tab-content text-muted">
                                       
                    <div class="tab-pane active" id="crm-nav-1" role="tabpanel">

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