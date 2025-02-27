
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

    .table-bordered tr{

        border-bottom: unset !important;
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
                        <div class="modal fade" id="WorkinProgress" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <!--<form  class="Dashboard-form class" id="sales_quot_report_form">-->
                                <form method="GET" action="<?php echo base_url(); ?>Crm/WorkProgress/GetData" target="_blank" id="add_form" class="Dashboard-form class">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Work In Progress Report</h5>
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
                                                                        
                                                                        <tbody class="travelerinfo">

                                                                            <tr>
                                                                                <td>As on</td>
                                                                                <td><input type="date" name="form_date" id="from_date_id" value="" onclick="this.showPicker();" class="form-control"></td>
                                                                                
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
                                        <h4 class="card-title mb-0 flex-grow-1" style="text-align: center;font-weight: 600;color: black; margin-right:-18%">Work In Progress<?php if (!empty($from_dates) && !empty($to_dates)) { ?>(<?php echo $from_dates; ?> To <?php echo $to_dates; ?>)<?php } ?></h4>

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

                                        <button type="button" data-bs-toggle="modal" id="clear_data" data-bs-target="#WorkinProgress" class="btn btn-primary py-1">Search</button>
                                    </div><!-- end card header -->
                                    <div class="card-body table-responsive divcontainer" style="overflow-x:scroll">
                                        <table style="table-layout:fixed;" id="DataTable" class="table table-bordered table-striped delTable display dataTable">
                                            <thead>
                                                <tr>
                                                    <th class="no-sort text-center" style="white-space: nowrap;width:20px">Sl no</th>
                                                    <th class="text-center" style="white-space: nowrap;width:100px">Purchase Voucher</th>
                                                    <th class="text-center" style="white-space: nowrap;width:200px">Vendor</th>
                                                    <th class="text-center" style="white-space: nowrap;width:300px">Vendor Invoice Reff</th>
                                                    <th class="text-center" style="white-space: nowrap;width:100px">Sales Order Reff</th>
                                                    <th class="text-center" style="width:100px">Amount</th>
                            

                                                </tr>
                                            </thead>

                                            <tbody class="tbody_data">
                                                <?php if (!empty($work_progress)) {  
                                                    $i = 1;
                                                    $total_amount = 0; 
                                                    foreach ($work_progress as $work_prog) { 
                                                    // Check if all purchase_sales_order arrays are empty
                                                    $hasData = false;
                                                    foreach ($work_prog->purchase_voucher_prod as $pur_vou_prod) {
                                                        if (!empty($pur_vou_prod->purchase_sales_order)) {
                                                            $hasData = true;
                                                            break;
                                                        }
                                                    }

                                                    if (!$hasData) {
                                                        // Skip this iteration if all purchase_sales_order are empty
                                                        continue;
                                                    }
                                                ?>
                                                <tr>
                                                    <td class="text-center" style="white-space: nowrap;width:20px"><?php echo $i; ?></td>
                                                    
                                                    <td class="text-center" style="white-space: nowrap;width:100px">
                                                        <a href="<?php echo base_url(); ?>Procurement/PurchaseVoucher?view_po=<?php echo $work_prog->pv_id; ?>" target="_blank">
                                                            <?php echo $work_prog->pv_reffer_id; ?>
                                                        </a>
                                                    </td>
                                                    <td class="text-center" style="white-space: nowrap;width:200px"><?php echo $work_prog->ven_name; ?></td>
                                                    <td class="text-center" style="white-space: nowrap;width:300px"><?php echo $work_prog->	pv_vendor_inv; ?></td>
                                                    <td colspan="2" align="left" class="p-0">
                                                        <table>
                                                            <?php foreach ($work_prog->purchase_voucher_prod as $pur_vou_prod) { ?>
                                                                <tr style="background: unset;border-bottom: hidden !important;">
                                                                    <?php if (!empty($pur_vou_prod->purchase_sales_order)) {
                                                                        foreach ($pur_vou_prod->purchase_sales_order as $pur_sales_ord) { ?>
                                                                            <td class="text-center" style="white-space: nowrap;width:100px"><?php echo $pur_sales_ord->so_reffer_no; ?></td>
                                                                        <?php } ?>
                                                                        <td class="text-end" style="white-space: nowrap;width:100px"><?php echo format_currency($pur_vou_prod->pvp_amount); ?></td>
                                                                    <?php     $total_amount = $pur_vou_prod->pvp_amount+ $total_amount; } ?>
                                                                </tr>
                                                            <?php } ?>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <?php 
                                                    $i++; 
                                                } ?>
                                                <tr>
                                                    <td align="center">Total</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                   
                                                   
                                                    
                                                    <td class="text-end"><b><?php echo format_currency($total_amount); ?></b></td>
                                                </tr>
                                            <?php } ?>


                       

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
                $('#WorkinProgress').modal('show');
            });

        <?php endif; ?>

        /*modal open end*/


        

        /*print button section start*/
        $('body').on('click','.print_button',function(e){
              
            // Open the PDF generation script in a new window
            var pdfWindow = window.open('<?= base_url()."Crm/WorkProgress/GetData/?".$_SERVER['QUERY_STRING']?>&action=Print', '_blank');

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
                    tableToExcel('DataTable', 'Work In Progress', 'Work In Progress');
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