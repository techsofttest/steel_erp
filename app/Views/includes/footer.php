<footer class="footer">
    <div class="container-fluid">
		<div class="row">
            <div class="col-sm-6">
                <script>document.write(new Date().getFullYear())</script> © Al Fuzail Engineering Services WLL.
            </div>
            <div class="col-sm-6">
                <div class="text-sm-end d-none d-sm-block">
                    Web Desined By Techsoft
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



    <!-- Modal -->
    <div class="modal fade" id="ViewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View Account Head</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                
                                <div class="card-body">
                                    <div class="live-preview">
                                        <form action="#" method="post" class="Dashboard-form">
                                            <div class="row align-items-end">
                                                <div class="col-col-md-6 col-lg-6">
                                                    <div>
                                                        <label for="basiInput" class="form-label">Account Name</label>
                                                        <input type="text" readonly value="Bibin Sabu" name="aname" class="form-control " >
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-col-md-6 col-lg-6">
                                                    <div>
                                                        <label for="labelInput" disabled="" class="form-label">Account Type</label>
                                                        <input type="text" name="aname" readonly value="Accounts Receivable" class="form-control " >
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                
                                                
                                            
                                                
                                            </div>
                                            <!--end row-->
                                        </form>
                                    </div>
                                        
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Print</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
	<script src="<?php echo base_url(); ?>public/assets/code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>public/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>public/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="<?php echo base_url(); ?>public/assets/libs/node-waves/waves.min.js"></script>
    <script src="<?php echo base_url(); ?>public/assets/libs/feather-icons/feather.min.js"></script>
    <script src="<?php echo base_url(); ?>public/assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
     <!-- <script src="assets/js/plugins.js"></script>-->

    <!-- apexcharts -->
    <script src="<?php echo base_url(); ?>public/assets/libs/apexcharts/apexcharts.min.js"></script>

    <!-- Vector map-->
    <script src="<?php echo base_url(); ?>public/assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
    <script src="<?php echo base_url(); ?>public/assets/libs/jsvectormap/maps/world-merc.js"></script>

    <!--Swiper slider js-->
    <script src="<?php echo base_url(); ?>public/assets/libs/swiper/swiper-bundle.min.js"></script>

    <!-- Dashboard init -->
    <script src="<?php echo base_url(); ?>public/assets/js/pages/dashboard-ecommerce.init.js"></script>

    <!-- App js -->
    <script src="<?php echo base_url(); ?>public/assets/js/app.js"></script>
	<script src="<?php echo base_url(); ?>public/assets/js/datatables/jquery.dataTables.min.js" ></script>
    <script src="<?php echo base_url(); ?>public/assets/js/datatables/dataTables.bootstrap.min.js" ></script>


    <!-- Notification Alerts -->

    <script src="<?php echo base_url(); ?>public/assets/js/alertify.min.js"></script> 
   

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