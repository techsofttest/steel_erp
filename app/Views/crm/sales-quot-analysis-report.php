
<style>
    .divcontainer {
        overflow-x: scroll;
        overflow-y: auto;
        /* transform: rotateX(180deg); */
    }

    .divcontainer table {
        /* transform: rotateX(180deg); */
    }

    .table-responsive {
        width: 100%;
        display: block;
        overflow-x: scroll;
    }

    .rotate {
        /* transform: rotateX(180deg); */
    }

    #DataTable td {
        line-height: 1.0
    }

   
</style>

<div class="tab-content text-muted">

    <div class="tab-pane active" id="nav-crm-top-1-1" role="tabpanel">

        <div class="row">

            <div class="col-lg-12">

                <!-- Tab panes -->
                <div class="tab-content text-muted">
                    <!--product head tab-->
                    <div class="tab-pane active" id="arrow-1" role="tabpanel">


                        <!--sales rout report modal start-->
                        <div class="modal fade" id="SalesQuotAnalysisReport" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <!--<form  class="Dashboard-form class" id="sales_quot_report_form">-->
                                <form method="GET" action="<?php echo base_url(); ?>Crm/SalesQuotAnalysisReport/GetData" target="_blank" id="add_form" class="Dashboard-form class">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Sales Quotation Analysis Report</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="card">

                                                        <div class="card-body">
                                                            <div class="live-preview">

                                                                <!--table section start-->

                                                                <?php
                                                                if (!empty($_GET['form_date'])) {

                                                                    $form_date = $_GET['form_date'];
                                                                } else {

                                                                    $form_date = "";
                                                                }

                                                                if (!empty($_GET['to_date'])) {

                                                                    $to_date = $_GET['to_date'];
                                                                } else {

                                                                    $to_date = "";
                                                                }

                                                                if (!empty($_GET['customer'])) {

                                                                    $customer = $_GET['customer'];
                                                                } else {

                                                                    $customer = "";
                                                                }
                                                                if (!empty($_GET['product'])) {

                                                                    $product = $_GET['product'];
                                                                } else {

                                                                    $product = "";
                                                                }
                                                                if (!empty($_GET['sales_executive'])) {

                                                                    $sales_exec = $_GET['sales_executive'];
                                                                } else {

                                                                    $sales_exec = "";
                                                                }
                                                                ?>

                                                                <div class="mt-4">
                                                                    <table class="table table-bordered table-striped delTable">
                                                                        <thead class="travelerinfo contact_tbody">
                                                                            <tr>
                                                                                <td>Date</td>
                                                                                <td class="text-center">From</td>
                                                                                <td style="padding: 0px !important;"><input type="date" name="form_date" id="from_date_id" value="<?php echo $form_date; ?>" onclick="this.showPicker();" class="form-control"></td>
                                                                                <td style="width: 10% !important;text-align: center;">To</td>
                                                                                <td style="padding: 0px !important;"><input type="date" name="to_date" id="to_date_id" value="<?php echo $to_date; ?>" onclick="this.showPicker();" class="form-control"></td>

                                                                            </tr>


                                                                        </thead>


                                                                        <tbody class="travelerinfo">

                                                                            <tr>
                                                                                <td>Customer</td>
                                                                                <td><select class="form-select droup_customer  customer_clz" value='<?php echo $customer; ?>' name="customer">
                                                                                        <option value="" selected disabled>Select Customer</option>
                                                                                        <?php foreach($customer_creation as $cus_data){?>
                                                                                            <option value="<?php echo $cus_data->cc_id;?>" ><?php echo $cus_data->cc_customer_name;?></option>
                                                                                        <?php } ?>
                                                                                    </select></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                            </tr>


                                                                            <tr>
                                                                                <td>Product</td>
                                                                                <td>
                                                                                    <select class="form-select product_clz" value='<?php echo $product; ?>' name="product">
                                                                                        <option value="" selected disabled>Select Product</option>
                                                                                        <?php foreach($products_data as $prod_det){?> 

                                                                                            <option value="<?php echo $prod_det->product_id ;?>"><?php echo $prod_det->product_details;?></option>

                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>

                                                                            </tr>


                                                                            <tr>
                                                                                <td>Sales Executive</td>
                                                                                <td>
                                                                                    <select class="form-select executive_clz" value='<?php echo $sales_exec; ?>' name="sales_executive">
                                                                                        <option value="" selected disabled>Select Executive</option>
                                                                                        <?php foreach($sales_executive_data as $sales_exc){?> 
                                                                                           <option value="<?php echo $sales_exc->se_id;?>" ><?php echo $sales_exc->se_name;?></option>    
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                            </tr>


                                                                        </tbody>


                                                                    </table>
                                                                </div>

                                                                <!--table section end-->



                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                            </div>
                                        </div>


                                        <div class="modal-footer justify-content-center">
                                            <button class="btn btn btn-success submit_btn" data-bs-dismiss="modal" type="submit">Search</button>
                                        </div>


                                    </div>
                                </form>

                            </div>
                        </div>

                        <!--####-->





                        <!--datatable section start-->

                        <div class="row">
                            <div class="col-lg-12" style="padding: 0px;">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1" style="text-align: center;font-weight: 600;color: black; margin-right:-18%">Sales Quotation Analysis Report<?php if (!empty($from_dates) && !empty($to_dates)) { ?>(<?php echo $from_dates; ?> To <?php echo $to_dates; ?>)<?php } ?></h4>

                                        <form method="POST" action="" target="_blank">
                                            <input type="hidden" name="pdf" value="1">
                                            <button type="submit" class="pdf_button report_button">PDF</button>
                                        </form>

                                        <!-- <form method="POST" action="" target="_blank">
                                            <input type="hidden" name="excel" value="1"> -->
                                        <button class="excel_button report_button" type="submit">Excel</button>
                                        <!-- </form> -->


                                        <!--<form method="POST" action="" target="_blank">
                                            <input type="hidden" name="pdf" value="1">--->
                                            <button class="print_button report_button" type="submit">Print</button>
                                        <!--</form>--->

                                        <!-- <form method="POST" action="" target="_blank">
                                            <input type="hidden" name="excel" value="1"> -->
                                        <button class="email_button report_button" type="submit" id="email_button">Email</button>
                                        <!-- </form> -->

                                        <button type="button" data-bs-toggle="modal" id="clear_data" data-bs-target="#SalesQuotAnalysisReport" class="btn btn-primary py-1">Search</button>
                                    </div><!-- end card header -->
                                    <div class="card-body table-responsive divcontainer" style="overflow-x:scroll">
                                        <table style="table-layout:fixed;" id="DataTable" class="table table-bordered table-striped delTable display dataTable">
                                            <thead>
                                                <tr>
                                                    <th class="no-sort text-center" style="white-space: nowrap;width:40px">Sl no</th>
                                                    <th class="text-center" style="white-space: nowrap;width:70px">Date</th>
                                                    <th class="text-center" style="white-space: nowrap;width:100px">Quotation Ref</th>
                                                    <th class="text-center" style="white-space: nowrap;width:300px">Customer Name</th>
                                                    <th class="text-center" style="white-space: nowrap;width:100px">Sales Executive</th>
                                                    <th class="text-center" style="width:500px">Product</th>
                                                    <th class="text-center" style="width:80px;white-space: nowrap" >Quantity</th>
                                                    <th style="width:80px;white-space: nowrap" class="text-center">Rate</th>
                                                    <th style="width:80px;white-space: nowrap" class="text-center">Discount</th>
                                                    <th style="width:100px;white-space: nowrap" class="text-center">Amount</th>
                                                    <th class="text-center" style="width:150px;white-space: nowrap">Sales Order</th>
                                                    <th style="width:90px;white-space: nowrap" class="text-center">Amount</th>
                                                    <th style="width:80px;white-space: nowrap" class="text-center">Difference</th>
                                                </tr>
                                            </thead>

                                            <tbody class="tbody_data">
                                                <?php
                                                if (!empty($quotation_data)) {
                                                    $i = 1;
                                                    $quot_prod_total = 0;
                                                    $sales_prod_total = 0;
                                                    $diff_total = 0;
                                                    $quot_diff_total = 0;
                                                    foreach ($quotation_data as $quot_data) { ?>
                                                       
                                                    <tr>
                                                        <td class="text-center" style="white-space: nowrap;width:40px"><?php echo $i; ?></td>
                                                        <td class="text-center" style="white-space: nowrap;width:70px"><?php echo date('d-M-Y', strtotime($quot_data->qd_date)); ?></td>
                                                        <td class="text-center" style="white-space: nowrap;width:100px"><a href="<?php echo base_url(); ?>Crm/SalesQuotation?view_so=<?php echo $quot_data->qd_id; ?>" target="_blank"><?php echo $quot_data->qd_reffer_no; ?></a></td>
                                                        <td style="white-space: nowrap;width:300px"><?php echo $quot_data->cc_customer_name; ?></td>
                                                        <td class="text-center" style="white-space: nowrap;width:100px"><?php echo $quot_data->se_name; ?></td>




                                                        <td colspan="8" align="left" class="p-0">
                                                            <table>
                                                                <?php foreach ($quot_data->quotation_product as $quot_prod) { ?>
                                                                    
                                                                <tr style="background: unset;border-bottom: hidden !important;">
                                                                    <td class="rotate" style="width:500px"><?php echo $quot_prod->product_details; ?></td>
                                                                    <td class="rotate text-center" style="width:80px;"><?php echo $quot_prod->qpd_quantity; ?></td>
                                                                    <td class="rotate text-end" style="width:80px;"><?php echo format_currency($quot_prod->qpd_rate); ?></td>
                                                                    <td class="rotate text-end" style="width:80px;"><?php echo format_currency($quot_prod->qpd_discount); ?>%</td>
                                                                    <td class="rotate text-end" style="width:100px"><?php echo format_currency($quot_prod->qpd_amount);  ?>   </td>
                                                                    
                                                                    <?php $quot_prod_total = $quot_prod->qpd_amount + $quot_prod_total; ?>




                                                                    <td colspan="3" align="left" class="p-0">
                                                                        <table>
                                                                            <?php  if(!empty($quot_prod->sales_orders)){ foreach ($quot_prod->sales_orders as $sal_ord) { ?> 
                                                                               
                                                                                <tr style="background: unset;border-bottom: hidden !important;">
                                                                                    <td  class="rotate text-center" width="150px"><a href="<?php echo base_url(); ?>Crm/SalesOrder?view_so=<?php echo $sal_ord->so_id; ?>" target="_blank"><?php echo $sal_ord->so_reffer_no;?></a></td>
                                                                                    <td class="rotate text-end" width="90"><?php echo format_currency($sal_ord->spd_amount); ?> </td>
                                                                                    
                                                                                    <?php 

                                                                                        $diff = $quot_prod->qpd_amount - $sal_ord->spd_amount; 

                                                                                        $sales_prod_total = $sal_ord->spd_amount + $sales_prod_total;

                                                                                        $diff_total = $diff + $diff_total;
                                                                                        
                                                                                    ?>

                                                                                    <td class="rotate text-end" width="90"><?php echo format_currency($diff); ?></td>
                                                                                </tr>
                                                                            <?php  }  } else{ ?>
                                                                                                <tr style="background: unset;border-bottom: hidden !important;">
                                                                                                    <td width="80px"></td>
                                                                                                    <td width="90"></td>
                                                                                                    <td width="90" class="text-end"><?php echo format_currency($quot_prod->qpd_amount); ?></td>

                                                                                                </tr> 
                                                                                                <?php  $quot_diff_total  = $quot_prod->qpd_amount + $quot_diff_total; 
                                                                                            }  
                                                                                            
                                                                                            $final_diff_total = $diff_total + $quot_diff_total; ?>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                
                                                                <?php }   ?>
                                                                
                                                            </table>
                                                        </td>



                                                    </tr>

                                                    <?php $i++; } ?>

                                                    <tr>
                                                        <td align="center">Total</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td class="text-end"><b><?php echo format_currency($quot_prod_total); ?></b></td>
                                                        <td></td>
                                                        <td class="text-end"><b><?php echo format_currency($sales_prod_total) ?></b></td>
                                                        <td class="text-end"><b><?php echo format_currency($final_diff_total) ?></b></td>
                                                        
                                                     </tr>


                                                <?php  }  ?>

                       

                                            </tbody>

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







<script>
    document.addEventListener("DOMContentLoaded", function(event) {

        /*modal open start*/
        <?php if (empty($_GET)): ?>

            $(window).on('load', function() {
                $('#SalesQuotAnalysisReport').modal('show');
            });

        <?php endif; ?>

        /*modal open end*/


        

        /*print button section start*/
        $('body').on('click','.print_button',function(e){
              
            // Open the PDF generation script in a new window
            var pdfWindow = window.open('<?= base_url()."Crm/SalesQuotAnalysisReport/GetData/?".$_SERVER['QUERY_STRING']?>&action=Print', '_blank');

            // Automatically print when the PDF is loaded
            pdfWindow.onload = function() {
                pdfWindow.print();
            };

        });

        /*fetch  sales executive by  customer*/

        $("body").on('change', '.customer_clz', function() {


            var id = $(this).val();


            $.ajax({

                url: "<?php echo base_url(); ?>Crm/SalesQuotAnalysisReport/FetchData",

                method: "POST",

                data: {
                    ID: id
                },

                success: function(data) {
                    var data = JSON.parse(data);

                    //console.log(data.prod_details);
                    $('.executive_clz').html(data.quot_det);

                    $('.product_clz').html(data.quot_prod);

                }


            });
        });

        /*####*/


        /*clear data section start*/

        $('#clear_data').on('click', function() {

            $('#from_date_id').val("");

            $('#to_date_id').val("");

        });

        /*#####*/

        /*quot report form submit*/
        /*$(function() {
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

                           

                        
                        }
                    });
                }
            });
        });*/

        /*####*/


        /*form submit start*/

        $(".submit_btn").on('click', function() {

            /*$('#SalesQuotAnalysisReport').modal("hide");

            $('#add_form')[0].reset();

            $('.customer_clz option').remove();

            $('.executive_clz option').remove();

            $('.product_clz option').remove();*/


        });

        /*#####*/



        $(document).ready(function() {
            $(".excel_button").click(
                function() {
                    tableToExcel('DataTable', 'Sales Quotation Analysis Report', 'Sales Quotation Analysis Report');
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
            if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) // If Internet Explorer
            {
                return fnExcelReport(table, fileName);
            }

            var uri = 'data:application/vnd.ms-excel;base64,',
                templateData = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>',
                base64Conversion = function(s) {
                    return window.btoa(unescape(encodeURIComponent(s)))
                },
                formatExcelData = function(s, c) {
                    return s.replace(/{(\w+)}/g, function(m, p) {
                        return c[p];
                    })
                }

            $("tbody > tr[data-level='0']").show();

            if (!table.nodeType)
                table = document.getElementById(table)

            var ctx = {
                worksheet: sheetName || 'Worksheet',
                table: table.innerHTML
            }

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
            tab_text = tab_text + table.innerHTML;

            tab_text = tab_text + "</table>";
            tab_text = tab_text.replace(/<A[^>]*>|<\/A>/g, ""); //remove if u want links in your table
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

    });
</script>




<script>
    document.getElementById("email_button").addEventListener("click", function() {
        // Select the table element
        var range = document.createRange();
        range.selectNode(document.getElementById("DataTable"));
        window.getSelection().removeAllRanges(); // Clear any existing selections
        window.getSelection().addRange(range); // Select the table content

        try {
            // Copy the selected content to clipboard
            var successful = document.execCommand('copy');
            if (successful) {
                // Alert to notify the user
                alert("Table copied to clipboard! Please paste it in the email composer.");

                // Email subject and body message
                var subject = encodeURIComponent("Sales Quotation Analysis Report");
                var body = encodeURIComponent("Please paste the copied table here:\n\n");

                // Open the email composer
                window.location.href = "mailto:?subject=" + subject + "&body=" + body;

                // Optionally clear the selection after copying
                window.getSelection().removeAllRanges();
            } else {
                console.log("Failed to copy table.");
            }
        } catch (err) {
            console.error("Error in copying table: ", err);
        }
    });
</script>