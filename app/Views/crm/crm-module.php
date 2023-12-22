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
                                    
                    <?php echo view('crm/crm_sub_header');?>

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
	
	
<script type='text/javascript'>
/*var max_fieldss      = 30;
var y = 1;

 $("#add_person").click(function(){

				if(y < max_fieldss){ //max input box allowed
					y++;
	        $("#person-more").append("<tr><td>"+y+"</td><td><input type='text' name='contact_person[]' class='form-control ' required></td><td><input type='text' name='contact_designation[]' class='form-control ' required></td><td><input type='text' name='contact_mobile[]' class='form-control ' required></td><td><input type='email' name='contact_email[]' class='form-control ' required></td><td class='remove-btnnp' colspan='6'><div class='remainpass'><i class='ri-close-line'></i>Remove</div></td>");
	 
				}
	  });

  $(document).on("click", ".remove-btnnp", function() 

  {
	 
	  $(this).parent().remove();
	    y--;
  });*/

  
</script>

<!--<script type='text/javascript'>
var max_fieldsp      = 30;
var p = 1;

 $("#add_product").click(function(){

				if(p < max_fieldsp){ //max input box allowed
					p++;
	  $("#product-more").append("<tr><td><input type='text' name='' class='form-control ' required=''></td><td><select class='form-select' name='' required=''><option selected=''>Select</option></select></td><td><input type='text' name='' class='form-control ' required=''></td><td><input type='text' name='' class='form-control ' required=''></td><td class='remove-btnp' colspan='6'><div class='remainpass'><i class='ri-close-line'></i>Remove</div></td>");

				}
	  });

  $(document).on("click", ".remove-btnp", function() 

  {
	 
	  $(this).parent().remove();
	    p--;
  });

  
</script>--->

<!--<script type='text/javascript'>
var max_fieldspp      = 30;
var pp = 1;

 $("#add_product2").click(function(){

				if(pp < max_fieldspp){ 
					pp++;
	  $("#product-more2").append("<tr><td><input type='text' name='' class='form-control ' required=''></td><td><select class='form-select' name='' required=''><option selected=''>Select</option></select></td><td><input type='text' name='' class='form-control ' required=''></td><td><input type='text' name='' class='form-control ' required=''></td><td><input type='text' name='' class='form-control ' required=''></td><td><input type='text' name='' class='form-control ' required=''></td><td><input type='text' name='' class='form-control ' required=''></td><td class='remove-btnpp' colspan='6'><div class='remainpass'><i class='ri-close-line'></i>Remove</div></td>");

				}
	  });

  $(document).on("click", ".remove-btnpp", function() 

  {
	 
	  $(this).parent().remove();
	    pp--;
  });

  
</script>--->
</body>



</html>