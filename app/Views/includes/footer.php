<footer class="footer">
    <div class="container-fluid">
		<div class="row">
            <div class="col-sm-6">
                <?= date('Y'); ?> © Al Fuzail Engineering Services WLL.
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

   
    <script src="<?php echo base_url(); ?>public/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    

    <!--<script src="<?php echo base_url(); ?>public/assets/libs/simplebar/simplebar.min.js"></script>-->


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
   


    <!-- <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script> -->



    <script src="<?php echo base_url(); ?>public/assets/js/jquery-ui.min.js"></script>

    

    <script>
       
       //document.addEventListener('contextmenu', event => event.preventDefault());
        //$('.add_model_btn').click(function(){

        function currency_format(orginalPrice){

           var myObject = new Object();

           var price = orginalPrice;

           var decimals = 2;
            

            $.ajax({

                url : "<?php echo base_url(); ?>Crm/SalesQuotation/CurrencyFormat",

                method : "POST",

                data: {Price: price,Decimals: decimals},


                success:function(data)
                {

                   // $('#sqid').val(data);

                   console.log(data);

                   var myObject = data

                   //return data;

                   return myObject;

                }

            });

        };


    </script>

    
   


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
       

        /*$(document).ready(function(){
            $('.datepicker').datepicker({
                dateFormat: "dd-MM-yy" // Specify the date format as "dd-MM-yy"
               
               
            });

            $('body').on('focus',".datepicker", function(){

            $(this).datepicker({ dateFormat: "dd-MM-yy" });

            $(this).attr("autocomplete", "off");

            }).on('change', function() {
                    $(this).valid();  // triggers the validation test
                    // '$(this)' refers to '$("#datepicker")'
        
                });


        });*/

        $(document).ready(function(){
            $('.datepicker').datepicker({
                dateFormat: "dd-M-yy", // Specify the date format as "dd-MM-yy"
                changeMonth: true, 
                changeYear: true, 
                yearRange: "-20:+15"
            }).on('change', function() {
                    $(this).valid();  // triggers the validation test
                    // '$(this)' refers to '$("#datepicker")'
                });
            $('body').on('focus',".datepicker", function(){
                $(this).datepicker({ dateFormat: "dd-M-yy" });
                $(this).attr("autocomplete", "off");
            })
        });


        
        
        /* Restrictd Datepicker */

        $(document).ready(function(){
            $('.datepicker_ap').datepicker({
                dateFormat: "dd-M-yy", 
                changeMonth: true,
                changeYear: true, 
                yearRange: "0:+1",
                minDate: new Date(<?= $accounting_year ?>, <?= $accounting_month-1 ?>, 1) 
            }).on('change', function() {
                    $(this).valid();  
                });
            $('body').on('focus',".datepicker_ap", function(){
            $(this).datepicker({ dateFormat: "dd-M-yy" });
            $(this).attr("autocomplete", "off");
            })
        });


        /* #### */



        $("#departure-date, #return-date").datepicker({

            beforeShow: function (input, instance) {
             
                $(instance.dpDiv).addClass("my-datepicker");
            },
          
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


        $('#filter_range').change(function(){

        var val = $(this).val();

        if(val !="Range")
        {

        //$('.datepicker').attr('disabled',true);

        if(val=="Month")
            {
                var date = new Date();
                var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
                var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);

                $('input[name=start_date]').val(FormatDate(firstDay));
                $('input[name=end_date]').val(FormatDate(lastDay));

            }

        if(val=="Year")
        {
            var date = new Date();
            var firstDay = new Date(date.getFullYear(), 0, 1); // First day of current year
            var lastDay = new Date(date.getFullYear(), 11, 31);

            $('input[name=start_date]').val(FormatDate(firstDay));
            $('input[name=end_date]').val(FormatDate(lastDay));

        }

        if(val=="Range")
        {
            $('input[name=start_date]').val('');
            $('input[name=end_date]').val('');
        }

        }


        });


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

    alertify.success('<?php echo $msg; ?>').delay(5).dismissOthers();

    <?php } ?>

    <?php if($type=="error") { ?>
    alertify.error('<?php echo $msg; ?>').delay(5).dismissOthers();
    <?php } ?>




    </script>



    <?php } ?>

    <!-- ### -->





   <script>
    

        

        $(document).ready(function() {


            
            $(document).on('input', 'input[type="number"][max]', function () {
            const max = parseFloat($(this).attr('max'), 10);
            const value = parseFloat($(this).val(), 10);

            if (value > max) {
                $(this).val(max);
            }
            });
            





            parent = $('body #AddModal');
            const $inputs = parent.find('input,select, button,.select2-hidden-accessible');
            const $form = $('#add_form');

            //console.log($inputs);

            /*
            $inputs.on('keydown', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault();

                    const $currentInput = $(this);

                    if ($currentInput.is('[type="submit"]')) {
                        $form.submit();
                    } else {
                        const currentIndex = $inputs.index($currentInput);
                        const $nextInput = $inputs.eq(currentIndex + 1);
                        if ($nextInput.length) {
                            $nextInput.focus();
                            if($nextInput.prop('nodeName')=="SELECT")
                            {
                            $nextInput.attr('size',6);
                            }
                        }
                    }
                    
                }
            });
            */

            

            $inputs.on('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();

        const $currentInput = $(this);

        if ($currentInput.is('[type="submit"]')) {
            $form.submit();
        } else {
            let currentIndex = $inputs.index($currentInput);
            let $nextInput;

            do {
                currentIndex = (currentIndex + 1) % $inputs.length; // wrap around to the start
                $nextInput = $inputs.eq(currentIndex);
            } while ($nextInput.is(':disabled') || $nextInput.prop('readonly'));

            $nextInput.focus();

            // if ($nextInput.prop('nodeName') === "SELECT") {
            //     $nextInput.attr('size', 6);
            // }
        }
    }
});



            


            $('select').on('focus', function() {
                $(this).click();
            });



            $(document).on('keypress',function(e) {
            if(e.which == 43) {
                //e.preventDefault();
               $('.add_more').trigger('click');
            }
            });



            $(document).on("select2:open", () => {
            document.querySelector(".select2-container--open .select2-search__field").focus()
            })


            /*
            $('.select2-hidden-accessible').on("select2:selecting", function(e) { 
            // what you would like to happen

            const $currentInput = $(this);

            let currentIndex = $inputs.index($currentInput);
            let $nextInput;

            //$(this).select2('close');

            currentIndex = (currentIndex + 1) % $inputs.length; // wrap around to the start
            $nextInput = $inputs.eq(currentIndex);

            //alert($nextInput.attr("name"));

            $nextInput.focus();

            //e.preventDefault();

           
            });
            */

            $('.debit_account_select2').on('select2:select', function(e) {

            $('#receipt_no').focus();

            });


            $('.credit_account_select2').on('select2:select', function(e) {

            parent = $(this).closest('.invoice_row');

            nextelem = parent.find('.credit_amount');

            nextelem.focus();

            }); 


            //Disable modal on backdrop click

            $('.modal').modal({
                        backdrop: 'static',
                        keyboard: true, 
                        show: true
            }); 


            $("form").bind("keypress", function(e) {
            if (e.keyCode == 13) {
                return false;
            }
            });





            $('.account_select2_common').select2({
                placeholder: "Select Account",
                theme: "default form-control-",
                dropdownParent: $('.account_parent'),
                ajax: {
                    url: "<?= base_url(); ?>Accounts/ChartsOfAccounts/FetchAccounts",
                    dataType: 'json',
                    delay: 250,
                    cache: false,
                    minimumInputLength: 1,
                    allowClear: true,
                    data: function(params) {
                        return {
                            term: params.term,
                            page: params.page || 1,
                        };
                    },
                    processResults: function(data, params) {

                        var page = params.page || 1;
                        return {
                            results: $.map(data.result, function(item) {
                                return {
                                    id: item.ca_id,
                                    text: item.ca_name
                                }
                            }),
                            pagination: {
                                more: (page * 10) <= data.total_count
                            }
                        };
                    },
                }
            })




            $('.head_select2_common').select2({
                placeholder: "Select Account Head",
                theme: "default form-control-",
                dropdownParent: $('.head_parent'),
                ajax: {
                    url: "<?= base_url(); ?>Accounts/AccountHead/FetchHeads",
                    dataType: 'json',
                    delay: 250,
                    cache: false,
                    minimumInputLength: 1,
                    allowClear: true,
                    data: function(params) {
                        return {
                            term: params.term,
                            page: params.page || 1,
                        };
                    },
                    processResults: function(data, params) {

                        var page = params.page || 1;
                        return {
                            results: $.map(data.result, function(item) {
                                return {
                                    id: item.ah_id,
                                    text: item.ah_account_name
                                }
                            }),
                            pagination: {
                                more: (page * 10) <= data.total_count
                            }
                        };
                    },
                }
            })




            $('.type_select2_common').select2({
                placeholder: "Select Account Type",
                theme: "default form-control-",
                dropdownParent: $('.type_parent'),
                ajax: {
                    url: "<?= base_url(); ?>Accounts/AccountHead/FetchTypes",
                    dataType: 'json',
                    delay: 250,
                    cache: false,
                    minimumInputLength: 1,
                    allowClear: true,
                    data: function(params) {
                        return {
                            term: params.term,
                            page: params.page || 1,
                        };
                    },
                    processResults: function(data, params) {

                        var page = params.page || 1;
                        return {
                            results: $.map(data.result, function(item) {
                                return {
                                    id: item.at_id,
                                    text: item.at_name
                                }
                            }),
                            pagination: {
                                more: (page * 10) <= data.total_count
                            }
                        };
                    },
                }
            })







       


        /*$("body").on('click', '.edit_btn', function(){ 
            
            var adminId = "<?= session('admin_id') ?>";

            var url = window.location.href;

            var segments = url.split('/');

            var segment1 = segments[4]; 

            var segment2 = segments[5];


            $.ajax({

                url : "<?php echo base_url(); ?>Crm/ProductHead/CheckModule",

                method : "POST",

                data: {ID: adminId,
                       segment1:segment1,
                       segment2:segment2,
                       
                },

                success:function(data)
                {   
                    var data = JSON.parse(data);

                    if(data.status_edit==="true")
                    {   
                        
                        alertify.error('Access Denied: You do not have permission for this action').delay(3).dismissOthers();

                        $('.modal').remove();            // Remove modal elements
                        $('.modal-backdrop').remove();   // Remove backdrops
                        $('body').removeClass('modal-open'); 

                        return false;
                    }

                   

                }

            });

        });*/


        /*$("body").on('click', '.add_model_btn', function(){ 
            
            var adminId = "<?= session('admin_id') ?>";

            var url = window.location.href;

            var segments = url.split('/');

            var segment1 = segments[4]; 

            var segment2 = segments[5];


            $.ajax({

                url : "<?php echo base_url(); ?>Crm/ProductHead/CheckModule",

                method : "POST",

                data: {ID: adminId,
                       segment1:segment1,
                       segment2:segment2,
                       
                },

                success:function(data)
                {   
                    var data = JSON.parse(data);

                    if(data.status_add==="true")
                    {   
                        
                        alertify.error('Access Denied: You do not have permission for this action').delay(3).dismissOthers();
                        $('.modal').remove();            
                        $('.modal-backdrop').remove();   
                        $('body').removeClass('modal-open'); 
                        return false;
                    }


                }

            });

        });*/


      
      
        













            


        });


        /*$("body").on('click', '.delete_btn', function(e) {
       
       var adminId = "<?= session('admin_id') ?>";
       var url = window.location.href;
       var segments = url.split('/');
       var segment1 = segments[4];
       var segment2 = segments[5];

       $.ajax({
           url: "<?php echo base_url(); ?>Crm/ProductHead/CheckModule",
           method: "POST",
           data: {
               ID: adminId,
               segment1: segment1,
               segment2: segment2
           },
           success: function(data) {
               var responseData = JSON.parse(data);

               if (responseData.status_delete === "true") {
                   
                   alertify.error('Access Denied: You do not have permission for this action').delay(3).dismissOthers();
                   
                   e.preventDefault();
                  e.stopImmediatePropagation();   

                   return false;
               }

               
           }
       });
   });*/


         /*
        
        document.addEventListener("DOMContentLoaded", function(event) { 

            function isDataTableRequest(ajaxSettings) {
            // Check for DataTables-specific URL or any other pattern
            return ajaxSettings.url && ajaxSettings.url.includes('/FetchData');
            }

            function isSelect2Request(ajaxSettings) {
            // Check for specific data or parameters in Select2 requests
            return ajaxSettings.url && ajaxSettings.url.includes('term='); // Adjust based on actual request data
            }

            
            function isSelect2Search(ajaxSettings) {
            // Check for specific data or parameters in Select2 requests
            return ajaxSettings.url && ajaxSettings.url.includes('page='); // Adjust based on actual request data
            }


            $(document).ajaxSend(function(event, jqXHR, ajaxSettings){
                if ((!isDataTableRequest(ajaxSettings)) && (!isSelect2Request(ajaxSettings)) && (!isSelect2Search(ajaxSettings)) ) {
                $("#overlay").fadeIn(300);
                }
            });

            
            $(document).ajaxComplete(function(event, jqXHR, ajaxSettings){
                if ((!isDataTableRequest(ajaxSettings)) && (!isSelect2Request(ajaxSettings))  && (!isSelect2Search(ajaxSettings)) ) {
                $("#overlay").fadeOut(300);
                }
            });


            
            $(document).ajaxError(function(){
                alertify.error('Something went wrong. Please try again later').delay(5).dismissOthers();
            });

        });

        */


        /*
        $(document).ready(function() {
        $.datepicker.setDefaults({
            minDate: new Date(<?= $accounting_year ?>, <?= $accounting_month-1 ?>, 1) 
        });
        });
        */



        

        
   
    </script>
