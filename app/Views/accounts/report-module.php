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
                                       

                
                
                <section id="ajax_container">

                    <?php echo $content;?>
                    
                </section>

               
										

										
										
			</div>
                   

        </div>
                <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

            
    <!--footer section start-->

    <?php echo view('includes/footer'); ?>

    <!--footer section end-->



            
            
            
	
	
	
</body>



</html>