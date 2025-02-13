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



        
         /* Report Full Page No Scroll */

	 header
        {

        display:none;

        }

        footer
        {

        display:none;

        }

        .page-content
        {

        padding:5px 0px;

        }

        .main-content
        {
            margin:15px !important;
        }


        /* #### */


       

    </style>


   

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">

            







<div class="tab-content text-muted">
								
    <div class="tab-pane active" id="nav-crm-top-1-1" role="tabpanel">
                    
        <div class="row">
            
            <div class="col-lg-12">
                
                <!-- Tab panes -->
                <div class="tab-content text-muted">
                    <!--product head tab--> 
                    <div class="tab-pane active" id="arrow-1" role="tabpanel">
                        
                        
                        <!--sales rout report modal start-->
                        <div class="modal fade" id="SalesQuotReport" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <form method="GET" target="<?php if(empty($_GET)) { echo "_blank"; } ?>" class="Dashboard-form class">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">General Ledger</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="card">
        
                                                        <div class="card-body">
                                                            <div class="live-preview">

                                                              <!--table section start-->


                                                                <div class="mt-4">


                                                                    <table class="table table-bordered table-striped delTable">
                                                                        <thead class="travelerinfo contact_tbody">


                                                                            <tr>
                                                                                <td>Select</td>
                                                                               
                                                                                <td>

                                                                                    <select class="form-control" name="filter_type" id="filter_type">
                                                                                        
                                                                                        <option value="">Select Account</option>

                                                                                        <option value="Account">Account</option>
                                                                                       
                                                                                        <option value="Account_Head">Account Head</option>

                                                                                        <option value="Account_Type">Account Type</option>
                                                                                        
                                                                                    </select>

                                                                                </td>
                                                                            
                                                                            </tr>




                                                                            <tr id="Account" style="display:none;" class="account_parent">

                                                                            <td>Account</td>

                                                                            <td>

                                                                            <select class="form-control account_select2_common" name="filter_account">


                                                                            </select>

                                                                            </td>


                                                                            </tr>




                                                                            <tr id="Account_Head" style="display:none;" class="head_parent">

                                                                            <td>Account Head</td>

                                                                            <td>

                                                                            <select class="form-control head_select2_common" name="filter_account_head">


                                                                            </select>

                                                                            </td>

                                                                            </tr>





                                                                            <tr id="Account_Type" style="display:none;" class="type_parent">

                                                                            <td>Account Type</td>

                                                                            <td>

                                                                            <select class="form-control type_select2_common" name="filter_account_type">

                                                                          
                                                                            </select>

                                                                            </td>


                                                                            </tr>







                                                                            <tr>


                                                                            <td>Time Frame</td>

                                                                            <td>

                                                                                <select class="form-control" id="filter_range" name="filter_timeframe">
                                                                                        
                                                                                        <option value="">Select Time</option>

                                                                                        <option value="Range">Range</option>

                                                                                        <option value="Month">Current Month</option>

                                                                                        <option value="Year">Current Year</option>
                                                                                       
                                                                                        
                                                                                </select>



                                                                            </td>


                                                                            </tr>



                                                                            <tr id="range_picker">


                                                                            <td>Date From</td>

                                                                            <td>
                                                                            <input class="form-control datepicker" type="text"  name="start_date" readonly disabled/>
                                                                            </td>


                                                                            <td class="text-center">Date To</td>

                                                                            <td>
                                                                            <input class="form-control datepicker" type="text"  name="end_date" readonly disabled/>
                                                                            </td>


                                                                            </tr>



                                                                            <tr>

                                                                            <td>Range From</td>

                                                                            <td>
                                                                            
                                                                            <select class="form-control" name="range_from">

                                                                            <option value="">Select Range From</option>

                                                                            <?php foreach($account_heads_filter as $ahf){ ?>

                                                                            <option value="<?php echo $ahf->ah_head_id; ?>"><?php echo $ahf->ah_head_id; ?></option>

                                                                            <?php } ?>

                                                                            </select>

                                                                            </td>

                                                                            <td class="text-center">Range To</td>

                                                                            <td>
                                                                            
                                                                            <select class="form-control" name="range_to">

                                                                            <option value="">Select Range To</option>

                                                                            <?php foreach($account_heads_filter as $ahf){ ?>

                                                                            <option value="<?php echo $ahf->ah_head_id; ?>"><?php echo $ahf->ah_head_id; ?></option>

                                                                            <?php } ?>

                                                                            </select>

                                                                            </td>

                                                                            </tr>

                                                                            
                                                                        
                                                                        </thead>
                                                                     
                                                                    
                                                                    
                                                                     </table>
                                                                </div>

                                                                <!--table section end-->

                                                                <div style="float: right;">
                                                                    <table class="table table-bordered table-striped enq_tab_submit menu">
                                                                        <tr>
                                                                            <td><a href="<?= base_url(); ?>Accounts/Reports/Ledger">Clear</a></td>
                                                                            <!--<td><button>Excel</button></td>
                                                                            <td><button>PDF</button></td>
                                                                            <td><button>Email</button></td>-->
                                                                            <td><button type="submit" data-bs-toggle="modal" aria-label="Close">View</button></td>
                                                                        </tr>
                                                                        <tr>
                                                                            
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                                
                                                                
                                                                

                    
                                                            </div>
                
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                            </div>
                                        </div>
                                        
                                    </div>
                                </form>

                            </div>
                        </div>

                        <!--####-->


                      


                        <!--datatable section start-->

                        <div class="row">

                            
                            <div class="col-lg-12">


                                <div class="card">


                                <?php if(!empty($account_name)) { ?>

                                    <div class="col-lg-12 my-3 text-center">

                                        <h5>Account : <?php echo $account_name; ?></h5>

                                    </div>                       

                                <?php } ?>



                                <div class="card-header align-items-center d-flex">

                                        <h4 class="card-title mb-0 flex-grow-1" style="text-align: center;font-weight: 600;color: black;">View General Ledger Report <?php if(!empty($from_dates) && !empty($to_dates)){?>(<?php echo $from_dates;?> To <?php echo $to_dates;?>)<?php } ?></h4>
                                        
                                        <?php if(!empty($_GET)) { ?>
                                        
                                        <form method="POST"  target="_blank">
                                            <input type="hidden" name="pdf" value="1">
                                            <button type="submit"  class="pdf_button report_button" >PDF</button>
                                        </form>
                                      

                                            <button id="btnExport" class="excel_button report_button" type="submit">Excel</button>
                                       
                                        <!-- <form method="POST" action="" target="_blank">
                                            <input type="hidden" name="pdf" value="1"> -->
                                            <button class="print_button report_button" type="button">Print</button>
                                        <!-- </form> -->

                                        
                                            
                                        <button id="email_button" class="email_button report_button" type="submit">Email</button>
                                        
                                        
                                        <?php } ?>

                                        <button type="submit" data-bs-toggle="modal" id="clear_data" data-bs-target="#SalesQuotReport" class="btn btn-primary py-1">Search</button>
                                    
                                    
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <table id="DataTable1" class="ReportTable table table-bordered table-striped delTable display dataTable">
                                            
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Voucher Number</th>
                                                    <th>Voucher Type</th>
                                                    <th>Related Account</th>
                                                    <th class="text-end">Debit Amount</th>
                                                    <th class="text-end">Credit Amount</th>
                                                    <th class="text-end">Balance</th>
                                                </tr>
                                            </thead>
                                            
                                            <tbody class="tbody_data">

                                            <?php
                                            
                                            if(!empty($open_balance))
                                            {
                                            $balance=$open_balance;
                                            }
                                            else
                                            {
                                            $balance=0;
                                            }

                                            ?>


                                            <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="text-end"><b>Opening Balance</b></td>
                                            <td class="text-end"><?= format_currency($balance); ?></td>
                                            </tr>


                                            <?php 
                                            $total_credit=0;
                                            $total_debit=0;
                                            $year="";
                                            $year_change=false;
                                            $counter=0;
                                            $account_heading = "";

                                            foreach($vouchers as $vc){ 
                                                
                                            if( ($year!="" && $year!=date('Y',strtotime($vc->transaction_date))) && $counter!=0)
                                            {
                                            $year=date('Y',strtotime($vc->transaction_date));
                                            $year_change=true;
                                            }
                                            $year = date('Y',strtotime($vc->transaction_date));


                                            if($vc->voucher_type=="Journal Voucher")
                                            {
                                            if($vc->debit_amount<1){ $vc->debit_amount = NULL; }
                                            if($vc->credit_amount<1){ $vc->credit_amount = NULL; }
                                            }

                                            $counter++;
                                            ?>

                                            <?php if($year_change==true){ ?>


                                            <tr class="no-sort">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="text-end"><b>Ending Balance</b></td>
                                            <td class="text-end"><b ></b></td> 
                                            
                                            <td class="text-end"><b ><?= format_currency($balance); ?></b></td>
                                            </tr>


                                            <tr class="no-sort">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="text-end"><b>Opening Balance</b></td>
                                            <td class="text-end"><b ></b></td> 
                                            
                                            <td class="text-end"><b ><?= format_currency($balance); ?></b></td>
                                            </tr>


                                            <?php 
                                            $year_change=false;
                                            } 
                                            ?>


                                            <?php

                                            if($account_heading != $vc->account_name)
                                            {
                                           
                                            if(empty($_GET['filter_account'])){

                                          
                                            ?>


                                            <tr class="no-sort">
                                            <td><b style="font-size:23px;"><?= $vc->account_name ?></b></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="text-end"></td>
                                            <td class="text-end"></td> 
                                            
                                            <td class="text-end"></td>
                                            </tr>


                                            <?php 
                                            $account_heading = $vc->account_name;
                                            } 
                                            }
                                            
                                            ?>


                                            <tr>
                                           
                                            <td><?php echo date('d-M-Y',strtotime($vc->transaction_date)); ?></td>

                                            <td>
                                            <?php if(($vc->voucher_type=="Receipt")){
                                             $href="Accounts/Receipts";
                                             } 
                                             else if($vc->voucher_type=="Cash Invoice")
                                             {
                                             $href="Crm/CashInvoice";
                                             }
                                             else if($vc->voucher_type=="Credit Invoice")
                                             {
                                             $href="Crm/CreditInvoice";
                                             }
                                             else if($vc->voucher_type=="Payment")
                                             {
                                             $href="Accounts/Payments";
                                             }
                                             else if($vc->voucher_type=="Sales Return")
                                             {
                                             $href="Crm/SalesReturn";
                                             }
                                             else
                                             {
                                             $href="";
                                             }
                                             ?>
                                            <a target="_blank" href="<?= base_url(); ?><?= $href ?>?view=<?= $vc->id; ?>">
                                            <?= $vc->reference; ?>
                                              </a>
                                        
                                            </td>

                                            <td>

                                               <?= $vc->voucher_type; ?>

                                            </td>

                                            <td><?= $vc->account_name; ?></td>

                                            <td class="currency_format1 text-end">

                                               <?php if($vc->debit_amount !="" && $vc->debit_amount>0) { 

                                                echo  format_currency($vc->debit_amount);

                                                $vc->debit_amount === "" ? "" : $vc->debit_amount;

                                                $total_debit = (float)$total_debit+(float)$vc->debit_amount;

                                               } else if($vc->credit_amount<0) {
                                                
                                                echo  format_currency(abs($vc->credit_amount)); 

                                                $vc->credit_amount === "" ? "" : $vc->credit_amount;

                                                $total_debit=(float)$total_debit+(float)abs($vc->credit_amount);

                                                
                                               } ?>
                                            
                                            </td>

                                            <td class="currency_format1 text-end"> 
                                                
                                               <?php if($vc->credit_amount !="" && $vc->credit_amount>0) { 

                                                echo  format_currency($vc->credit_amount); 

                                                $total_credit=$total_credit+$vc->credit_amount;
                                                
                                               } else if($vc->debit_amount<0) {
                                                
                                                echo  format_currency(abs($vc->debit_amount));

                                                $vc->debit_amount === "" ? "" : $vc->debit_amount;

                                                $total_credit = (float)$total_credit+(float)abs($vc->debit_amount);

                                                } ?></td>

                                            <td class="currency_format1 text-end">
                                            
                                              <?php
                                                
                                                if(!empty($vc->debit_amount))
                                                {
                                                $vc->debit_amount === "" ? "" : $vc->debit_amount;
                                                
                                                $balance = (float)$balance+(float)$vc->debit_amount;
                                                
                                                }
                                                else
                                                {
                                                $vc->credit_amount === "" ? "" : $vc->credit_amount;
                                                $balance = (float)$balance-(float)$vc->credit_amount; 
                                                }

                                                echo format_currency($balance);

                                              ?>
                                              
                                            
                                            </td>


                                           </tr>


                                            <?php } ?>



                                            </tbody>



                                            <tfoot>

                                            <tr class="no-sort">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="text-end"><b><?= format_currency($total_debit); ?></b></td>
                                            <td class="text-end"><b ><?= format_currency($total_credit); ?></b></td> 
                                            
                                            <td class="text-end"><b ><?= format_currency($balance); ?></b></td>
                                            </tr>

                                            </tfoot>



                                        </table>
                
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                        </div>

                        <!---datatable section end-->

                    </div>
                    <!--###-->


                   

                    
                </div>
                    
                    
                    
            </div>
                    
        </div>
                    
                    
    </div>
                    
    
                        
</div>



</div>
<!-- End Page-content -->











<!--footer section start-->

<?php echo view('includes/footer'); ?>

<!--footer section end-->




</body>



</html>






<script>



    document.addEventListener("DOMContentLoaded", function(event) { 




        //Search Modal Fns Start


        $('#filter_type').change(function(){

        var type = $(this).val();

        $('#Account').hide();

        $('#Account_Head').hide();

        $('#Account_Type').hide();

        $('#'+type+'').show();


        });



        //Search Modal Fns End







        /*modal open start*/

        <?php /* if(empty($_GET)){ ?>
        $(window).on('load', function() {
            $('#SalesQuotReport').modal('show');
        });
        <?php } */ ?>



        /*
        $('#filter_range').change(function(){

        var val = $(this).val();

        if(val !="Range")
        {
        $('.datepicker').attr('disabled',true);

            if(val=="Month")
            {
                var date = new Date();
                var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
                var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);

                $('input[name=start_date]').val(firstDay);
                $('input[name=end_date]').val(firstDay);

            }

            if(val=="Year")
            {

            

            }

        }
        else
        {
        $('.datepicker').attr('disabled',false);    
        }

        });

        */

       
        
        
        
        /*modal open end*/


         /* customer droup drown */
         $(".droup_customer").select2({
            placeholder: "Select Customer",
            theme : "default form-control- customer_width",
            dropdownParent: $('#SalesQuotReport'),

            ajax: {
                url: "<?= base_url(); ?>Crm/SalesQuotReport/FetchTypes",
                dataType: 'json',
                delay: 250,
                cache: false,
                minimumInputLength: 1,
                allowClear: true,
                data: function (params) {
                    return {
                        term: params.term,
                        page: params.page || 1,
                    };
                },
                processResults: function(data, params) {
                    var page = params.page || 1;
                    return {
                        results: $.map(data.result, function (item) { return {id: item.cc_id, text: item.cc_customer_name}}),
                        pagination: {
                        // THE `10` SHOULD BE SAME AS `$resultCount FROM PHP, it is the number of records to fetch from table` 
                            more: (page * 10) <= data.total_count
                        }
                    };
                },              
            }
        })
        /**/

        /*fetch  sales executive by  customer*/   

        $("body").on('change', '.customer_clz', function(){ 


            var id = $(this).val();


            $.ajax({

                url : "<?php echo base_url(); ?>Crm/SalesQuotReport/FetchData",

                method : "POST",

                data:{ID: id},

                success:function(data)
                {   
                    var data = JSON.parse(data);

                    //console.log(data.prod_details);
                    $('.executive_clz').html(data.quot_det);
                    
                    $('.product_clz').html(data.quot_prod);

                }


            });
        });
        
        /*####*/

        /*quot report form submit*/
        $(function() {
            var form = $('#sales_quot_report_form');
            
            form.validate({
                rules: {
                    required: 'required',
                },
                messages: {
                    required: 'This field is required',
                },
                errorPlacement: function(error, element) {} ,
                submitHandler: function(currentForm) {

                 
                    // Submit the form for the current tab
                    $.ajax({
                        url: "<?php echo base_url(); ?>Crm/SalesQuotReport/GetData",
                        method: "POST",
                        data: $(currentForm).serialize(),
                        success: function(data) {
                            var responseData = JSON.parse(data);

                            if(responseData.status ==='False')
                            {
                                alertify.error('No Data Found').delay(3).dismissOthers();
                            }
                         
                            $('.tbody_data').html(responseData.product_data);

                            $("#SalesQuotReport").modal('hide');

                            $('#sales_quot_report_form')[0].reset();

                            $('.customer_clz').val('').trigger('change');

                            $('.executive_clz').val('').trigger('change');

                            $('.product_clz').val('').trigger('change');

                            datatable.ajax.reload(null, false);

                            
                        
                        }
                    });
                }
            });
        });

        /*####*/



        $('#DataTable').DataTable( {
        responsive: true,
        ordering: false,
        paging: false,
        order: [[0, 'asc']]
        } );


        


    });




    
$(document).ready(function(){
    $("#btnExport").click(
                function () {
                    tableToExcel('DataTable1','General Ledger','General Ledger');
                }            
            );
    })
    function getIEVersion()
    // Returns the version of Windows Internet Explorer or a -1
    // (indicating the use of another browser).
    {
        var rv = -1; // Return value assumes failure.
        if (navigator.appName == 'Microsoft Internet Explorer') {
            var ua = navigator.userAgent;
            var re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
            if (re.exec(ua) != null)
                rv = parseFloat(RegExp.$1);
        }
        return rv;
    }
    
    function tableToExcel(table, sheetName, fileName) {
        
    
        var ua = window.navigator.userAgent;
        var msie = ua.indexOf("MSIE ");
        if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
        {
            return fnExcelReport(table, fileName);
        }
    
        var uri = 'data:application/vnd.ms-excel;base64,',
            templateData = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>',
            base64Conversion = function (s) { return window.btoa(unescape(encodeURIComponent(s))) },
            formatExcelData = function (s, c) { return s.replace(/{(\w+)}/g, function (m, p) { return c[p]; }) }
    
        $("tbody > tr[data-level='0']").show();
    
        if (!table.nodeType)
            table = document.getElementById(table)
    
        var ctx = { worksheet: sheetName || 'Worksheet', table: table.innerHTML }
    
        var element = document.createElement('a');
        element.setAttribute('href', 'data:application/vnd.ms-excel;base64,' + base64Conversion(formatExcelData(templateData, ctx)));
        element.setAttribute('download', fileName);
        element.style.display = 'none';
        document.body.appendChild(element);
        element.click();
        document.body.removeChild(element);
    
        $("tbody > tr[data-level='0']").hide();
    }
    
    function fnExcelReport(table, fileName) {
        
        var tab_text = "<table border='2px'>";
        var textRange;
    
        if (!table.nodeType)
            table = document.getElementById(table)
    
        $("tbody > tr[data-level='0']").show();
        tab_text =  tab_text + table.innerHTML;
    
        tab_text = tab_text + "</table>";
        tab_text = tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
        tab_text = tab_text.replace(/<img[^>]*>/gi, ""); // remove if u want images in your table
        tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params
    
        txtArea1.document.open("txt/html", "replace");
        txtArea1.document.write(tab_text);
        txtArea1.document.close();
        txtArea1.focus();
        sa = txtArea1.document.execCommand("SaveAs", false, fileName + ".xls");
        $("tbody > tr[data-level='0']").hide();
        return (sa);
    }
    
    
    





</script>



<script>


document.getElementById("email_button").addEventListener("click", function() {
    // Select the table element
    var range = document.createRange();
    range.selectNode(document.getElementById("DataTable"));
    window.getSelection().removeAllRanges();  // Clear any existing selections
    window.getSelection().addRange(range);    // Select the table content

    try {
        // Copy the selected content to clipboard
        var successful = document.execCommand('copy');
        if (successful) {
            // Alert to notify the user
            alertify.success("Table copied to clipboard! Please paste it in the email composer.");

            // Email subject and body message
            var subject = encodeURIComponent("General Ledger Report");
            var body = encodeURIComponent("Please paste the copied table here:\n\n");

            // Open the email composer
            window.location.href = "mailto:?subject=" + subject + "&body=" + body;

            // Optionally clear the selection after copying
            window.getSelection().removeAllRanges();
        } else {
            alertify.error("Failed to copy table.");
        }
    } catch (err) {
            alertify.error("Error in copying table: ", err);
    }
});




$('body').on('click','.print_button',function(e){
    
    // Open the PDF generation script in a new window

    var pdfWindow = window.open('<?= base_url()."Accounts/Reports/Ledger?".$_SERVER['QUERY_STRING']?>&action=Print', '_blank');

    // Automatically print when the PDF is loaded
    pdfWindow.onload = function() {
        pdfWindow.print();
    };

    });



    $('.account_select2').select2({
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




            $('.head_select2').select2({
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




            $('.type_select2').select2({
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






</script>








