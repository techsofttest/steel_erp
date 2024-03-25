<footer class="footer">
    <div class="container-fluid">
		<div class="row">
            <div class="col-sm-6">
                <script>document.write(new Date().getFullYear())</script> © Al Fuzail Engineering Services WLL.
            </div>
            <div class="col-sm-6">
                <div class="text-sm-end d-none d-sm-block">
                    Web Designed By Techsoft
                </div>
            </div>
        </div>
    </div>
</footer>
</div>
</div>
   
    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->




    <!-- JAVASCRIPT -->
	<script src="<?php echo base_url(); ?>public/assets/code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>
   
    <script src="<?php echo base_url(); ?>public/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    
    <script src="<?php echo base_url(); ?>public/assets/libs/simplebar/simplebar.min.js"></script>

    <!--
    <script src="<?php echo base_url(); ?>public/assets/libs/node-waves/waves.min.js"></script>
    <script src="<?php echo base_url(); ?>public/assets/libs/feather-icons/feather.min.js"></script>
    <script src="<?php echo base_url(); ?>public/assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    -->

     <!-- <script src="assets/js/plugins.js"></script>-->

    <!-- apexcharts -->
    <!--
    <script src="<?php echo base_url(); ?>public/assets/libs/apexcharts/apexcharts.min.js"></script>
    -->

    <!-- Vector map-->
    <!--
    <script src="<?php echo base_url(); ?>public/assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
    <script src="<?php echo base_url(); ?>public/assets/libs/jsvectormap/maps/world-merc.js"></script>
    -->

    <!--Swiper slider js-->
    <!--
    <script src="<?php echo base_url(); ?>public/assets/libs/swiper/swiper-bundle.min.js"></script>
    -->


    <script src="<?php echo base_url(); ?>public/assets/libs/feather-icons/feather.min.js"></script>

    <script src="<?php echo base_url(); ?>public/assets/libs/node-waves/waves.min.js"></script>

    <!-- App js -->
    <script src="<?php echo base_url(); ?>public/assets/js/app.js"></script>
	
    <!-- Datatable JS -->
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

    <!--jquery validate-->
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

    <script src="<?php echo base_url(); ?>public/assets/js/select2.min.js"></script>
    

    <!-- Notification Alerts -->

    <script src="<?php echo base_url(); ?>public/assets/js/alertify.min.js"></script> 


    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.8.5/js/standalone/selectize.min.js"></script>
   
    <script src="https://cdn.jsdelivr.net/npm/number-to-words"></script>

    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
   

    <script>



    
        function FormatDate(rawDate)
        {

        var dateObj = new Date(rawDate);

        // Array to convert month number to month name
        var monthNames = ["January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
        ];

        // Format the date
        var formattedDate = ('0' + dateObj.getDate()).slice(-2) + '-' + monthNames[dateObj.getMonth()] + '-' + dateObj.getFullYear();

        return formattedDate;

        }
       

        $(document).ready(function(){
            $('.datepicker').datepicker({
                dateFormat: "dd-MM-yy" // Specify the date format as "dd-MM-yy"
               
               
            });

            $('body').on('focus',".datepicker", function(){

            $(this).datepicker({ dateFormat: "dd-MM-yy" });

            $(this).attr("autocomplete", "off");

            });

            


        });



        function MinMax(el) {
            if (el.value != "") {
                if (parseInt(el.value) < parseInt(el.min)) {
                el.value = el.min;
                }
                if (parseInt(el.value) > parseInt(el.max)) {
                el.value = el.max;
                }
            }
        }


    </script>



    <script>
    alertify.set('notifier','position', 'top-center');
    </script>


    <?php


    if(session()->getFlashdata('alert'))

    {
    $alert = session()->getFlashdata('alert');
    $type = $alert['type'];
    $msg = $alert['msg'];

    ?>

    <script>
    
    <?php if($type=="success") { ?>

    alertify.success('<?php echo $msg; ?>').delay(8).dismissOthers();

    <?php } ?>

    <?php if($type=="error") { ?>
    alertify.error('<?php echo $msg; ?>').delay(8).dismissOthers();
    <?php } ?>




    </script>


    <?php } ?>

    <!-- ### -->