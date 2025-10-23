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
        line-height: 1.5;
    }
    .modal-dialog{
        width: 500px;
        margin: auto;
    }
    .adjust_width {
    width: 86%;
}

    .Dashboard-form .form-select {
    border: 1px solid #434343 !important;
    margin-bottom: 0px;
    background: #f5f5f56e;
    height: 40px;
    width: 100%;
    border-radius: 4px;
}

.travelerinfo td {
    color: black;
    vertical-align: middle;
}

/* Custom styles for the table */
    .delTable th, .delTable td {
        /* Ensure padding doesn't affect fixed width calculation unexpectedly */
        padding-left: 8px; /* Adjust as needed */
        padding-right: 8px; /* Adjust as needed */
        vertical-align: top; /* Align content to the top */
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
                        <div class="modal fade" id="MaterialRequesitionReport" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <!--<form  class="Dashboard-form class" id="sales_quot_report_form">-->
                                <form method="GET"
                                    action="<?php echo base_url(); ?>Procurement/MaterialRecReport/GetData"
                                    target="_blank" class="Dashboard-form class" id="add_form">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Material Received Note Report
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
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
                                                                    $from_date = $_GET['form_date'];
                                                                } else {
                                                                    $from_date = "";
                                                                }
                                                                if (!empty($_GET['to_date'])) {
                                                                    $to_date = $_GET['to_date'];
                                                                } else {
                                                                    $to_date = "";
                                                                }
                                                                if (!empty($_GET['sales_order'])) {
                                                                    $customer = $_GET['sales_order'];
                                                                } else {
                                                                    $customer = "";
                                                                }
                                                                //    if(!empty($_GET['sales_executive']))
                                                                //    {
                                                                //         $sales_executive = $_GET['sales_executive'];
                                                                //    }
                                                                //    else
                                                                //    {
                                                                //         $sales_executive ="";
                                                                //    }
                                                                if (!empty($_GET['product'])) {
                                                                    $product = $_GET['product'];
                                                                } else {
                                                                    $product = "";
                                                                }

                                                                ?>


                                                                <div class="mt-4">
                                                                    <table
                                                                        class="table table-bordered table-striped delTable">
                                                                        <thead class="travelerinfo contact_tbody">
                                            
                                                                            <tr>
                                                                                
                                                                                <td class="text-center center_padding" style="display: flex;align-items: center;margin-top: 15px;">From</td>
                                                                                <td ><input type="date" style="" name="form_date" id="from_date_id" onclick="this.showPicker();" class="form-control "></td>
                                                                                <td style="width: 10% !important;display: flex;align-items: center;justify-content: center;" class="center_padding">To</td>
                                                                                <td>
                                                                                    <input type="date" name="to_date" id="to_date_id" onclick="this.showPicker();" class="form-control ">
                                                                                </td>

                                                                            </tr>

                                                                        </thead>


                                                                        <tbody class="travelerinfo">

                                                                            <tr>
                                                                            <td style="width: 30%;" class="center_padding">Vendor</>
                                                                                <td style="width: 70%;"  colspan="4">
                                                                                    <select
                                                                                        class="form-select customer_clz"
                                                                                        name="vendor">
                                                                                        <option value="" selected
                                                                                            disabled>Select Vendor
                                                                                        </option>
                                                                                        <?php foreach ($vendors as $vendor) { ?>
                                                                                            <option
                                                                                                value="<?php echo $vendor->cc_id ?>">
                                                                                                <?php echo $vendor->cc_customer_name; ?>
                                                                                            </option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>


                                                                            <tr>
                                                                            <td style="width: 30%;" class="center_padding">Sales Order</td>
                                                                            <td style="width: 70%;"  colspan="4">
                                                                                    <select
                                                                                        class="form-select value='' customer_clz"
                                                                                        name="sales_order">
                                                                                        <option value="" selected
                                                                                            disabled>Select Sales Order
                                                                                        </option>
                                                                                        <?php foreach ($sales_orders as $sales_order) { ?>
                                                                                            <option
                                                                                                value="<?php echo $sales_order->so_id ?>">
                                                                                                <?php echo $sales_order->so_reffer_no; ?>
                                                                                            </option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </td>
                                                                            
                                                                            </tr>

                                                                            <tr>
                                                                            <td style="width: 30%;" class="center_padding">Product</td>
                                                                            <td style="width: 70%;"  colspan="4">
                                                                                    <select class="form-select" value=""
                                                                                        name="product">
                                                                                        <option value="" selected
                                                                                            disabled>Select Porduct
                                                                                        </option>
                                                                                        <?php foreach ($products as $product) { ?>
                                                                                            <option
                                                                                                value="<?php echo $product->product_id; ?>">
                                                                                                <?php echo $product->product_details; ?>
                                                                                            </option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </td>
                                                                               
                                                                            </tr>

                                                                               <tr>
                                                                            <td style="width: 30%;" class="center_padding">Pending</td>                                                                           
                                                                                <td> <input class="" type="checkbox" value="pending" name="pending"></td>                                                                            
                                                                            </tr>
                                                                            <tr>
                                                                            <td style="width: 30%;" class="center_padding">Linked</td>
                                                                                <td> <input class="" type="checkbox" value="linked" name="linked"></td>                                                                                   
                                                                            </tr>


                                                                        </tbody>


                                                                    </table>
                                                                </div>

                                                             





                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                            </div>
                                        </div>


                                        <div class="modal-footer justify-content-center">
                                            <button class="btn btn btn-success submit_btn" type="submit">Search</button>
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
                                        <h4 class="card-title mb-0 flex-grow-1"
                                            style="text-align: center;font-weight: 600;color: black; margin-right:-16%">
                                            Material Received Note Report</h4>

                                        <form method="POST" target="_blank">
                                            <input type="hidden" name="pdf" value="1">
                                            <button type="submit" class="pdf_button report_button">PDF</button>
                                        </form>


                                        <button class="excel_button report_button" type="submit">Excel</button>


                                        <form method="POST" action="" target="_blank">
                                            <input type="hidden" name="pdf" value="1">
                                            <button class="print_button report_button" type="submit">Print</button>
                                        </form>

                                        <!-- <form method="POST" action="" target="_blank">
                                            <input type="hidden" name="excel" value="1"> -->
                                        <button class="email_button report_button" type="submit"
                                            id="email_button">Email</button>
                                        <!-- </form> -->

                                        <button type="button" data-bs-toggle="modal" id="clear_data"
                                            data-bs-target="#SalesQuotReport"
                                            class="btn btn-primary py-1 search-btn">Search</button>
                                    </div><!-- end card header -->
                                    <div class="card-body table-responsive divcontainer" style=" overflow:scroll">
                                        <table style="table-layout:fixed;" id="DataTable"
                                            class="table table-bordered table-striped delTable display dataTable">
                                            <thead>
                                                <tr>
                                                    <th class="no-sort text-center"
                                                        style="white-space: nowrap;width:60px">Sl no</th>
                                                    <th class="text-center" style="white-space: nowrap;width:70px">Date
                                                    </th>
                                                    <th class="text-center" style="white-space: nowrap;width:100px">MRN
                                                        Ref</th>
                                                    <th class="" style="white-space: nowrap;width:300px">
                                                        Vendor</th>
                                                    <th class="text-center" style="white-space: nowrap;width:100px">
                                                        Purchase Order</th>
                                                    <th class="text-center" style="white-space: nowrap;width:100px">
                                                        Vendor DN Ref</th>
                                                    <th class="text-end" style="white-space: nowrap;width:80px">Amount
                                                    </th>
                                                    <th style="white-space: nowrap;width:500px">Product</th>
                                                    <th class="text-center" style="white-space: nowrap;width:80px">Quantity
                                                    </th>
                                                    <th class="text-end" style="white-space: nowrap;width:80px">Rate
                                                    </th>
                                                    <th class="text-end" style="white-space: nowrap;width:80px">Discount
                                                    </th>
                                                    <th class="text-end" style="white-space: nowrap;width:80px">Amount
                                                    </th>
                                                </tr>
                                            </thead>

                                            <tbody class="tbody_data">
                                                <?php
                                                if (!empty($material_requesition)) {
                                                    $i = 1;
                                                    $total = $mr_total = 0; 
                                                    foreach ($material_requesition as $material_req) { ?>

                                                        <tr>

                                                            <td class="text-center" style="white-space: nowrap;width:60px">
                                                                <?php echo $i; ?></td>
                                                            <td class="text-center" style="white-space: nowrap;width:70px">
                                                                <?php echo date('d-M-Y', strtotime($material_req->mrn_date)); ?></td>
                                                            <td class="text-center" style="white-space: nowrap;width:100px">
                                                               <a href="<?php echo base_url().'Procurement/MaterialReceivedNote?view_so=' . $material_req->mrn_id; ?>" target="_blank"><?php echo $material_req->mrn_reffer; ?></a></td>

                                                            <td class="" style="width:300px"><?php foreach ($vendors as $vendor) {
                                                                echo $material_req->mrn_vendor_name == $vendor->cc_id ? $vendor->cc_customer_name : '';
                                                            } ?>
                                                            </td>

                                                            <td class="text-center" style="white-space: nowrap;width:100px">
                                                               <a href="<?php echo base_url().'Procurement/PurchaseOrder?view_so=' . $material_req->po_id; ?>" target="_blank"> <?php echo $material_req->po_reffer_no; ?></td>

                                                            <td class="text-center" style="white-space: nowrap;width:100px">
                                                                <?php echo $material_req->mrn_delivery_note; ?></td>

                                                            <td colspan="6" align="left" class="p-0">
                                                                <table>
                                                                    <?php $tot_amt = 0;$k=0; 
                                                                    foreach ($material_req->product_orders as $orders) { $k++;  ?>

                                                                        <tr
                                                                            style="background: unset;border-bottom: hidden !important;">
                                                                            <td class="text-end rotate"
                                                                                style="white-space: nowrap;width:80px">
                                                                                <?php if($k==1){ $tot_amt = 0;
                                                                                foreach ($material_req->product_orders as $ord) { ?>
                                                                                    <?php $tot_amt += $ord->rnp_amount; ?>
                                                                                <?php }
                                                                                echo format_currency($tot_amt);
                                                                                $total += $tot_amt; } ?>
                                                                            </td>

                                                                            <td class="rotate" style="width:500px">
                                                                                <?php echo $orders->product_details; ?><br>
                                                                            </td>
                                                                            <td class="text-center rotate"
                                                                                style="white-space: nowrap;width:80px">
                                                                                <?php echo format_currency($orders->rnp_current_delivery); ?><br>
                                                                            </td>

                                                                            <td class="text-end rotate"
                                                                                style="white-space: nowrap;width:80px">
                                                                                <?php echo format_currency($orders->pop_rate); ?><br>
                                                                            </td>

                                                                            <td class="text-end rotate"
                                                                                style="white-space: nowrap;width:80px">
                                                                                <?php echo format_currency($orders->pop_discount ?? 0); ?>%<br>
                                                                            </td>

                                                                            <td class="text-end rotate"
                                                                                style="white-space: nowrap;width:80px">
                                                                                <?php echo format_currency($orders->rnp_amount);
                                                                                $mr_total += $orders->rnp_amount ?><br>
                                                                            </td>

                                                                        </tr>
                                                                    <?php } ?>
                                                                </table>
                                                            </td>

                                                        </tr>
                                                        <?php $i++;
                                                    } ?>

                                                    <tr>
                                                        <th style="white-space: nowrap;width:40px"></th>
                                                        <th style="white-space: nowrap;width:70px"></th>
                                                        <th style="white-space: nowrap;width:100px"></th>
                                                        <th style="white-space: nowrap;width:300px"></th>
                                                        <th style="white-space: nowrap;width:100px"></th>
                                                        <th style="white-space: nowrap;width:100px"></th>
                                                        <th class="text-end" style="white-space: nowrap;width:100px">
                                                            <?php echo format_currency($total); ?></th>
                                                        <th style="white-space: nowrap;width:400px"></th>
                                                        <th style="white-space: nowrap;width:70px"></th>
                                                        <th style="white-space: nowrap;width:70px"></th>
                                                        <th style="white-space: nowrap;width:70px"></th>
                                                        <th class="text-end" style="white-space: nowrap;width:100px">
                                                            <?php echo format_currency($mr_total); ?></th>
                                                    </tr>

                                                    <?php
                                                } ?>

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




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



<script>
    document.addEventListener("DOMContentLoaded", function (event) {

        /*modal open start*/
        <?php if (empty($_GET)): ?>

            $(window).on('load', function () {

                $('#MaterialRequesitionReport').modal('show');
            });

        <?php endif; ?>

        /*modal open end*/


        /* customer droup drown */
        $(".droup_sales").select2({
            placeholder: "Select Customer",
            theme: "default form-control- customer_width",
            dropdownParent: $('#MaterialRequesitionReport'),

            ajax: {
                url: "<?= base_url(); ?>Procurement/MaterialReqReport/FetchTypes",
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
                processResults: function (data, params) {
                    var page = params.page || 1;
                    return {
                        results: $.map(data.result, function (item) {
                            return {
                                id: item.so_id,
                                text: item.so_reffer_no
                            }
                        }),
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

        $("body").on('change', '.customer_clz', function () {


            var id = $(this).val();


            $.ajax({

                url: "<?php echo base_url(); ?>Procurement/MaterialReqReport/FetchData",

                method: "POST",

                data: {
                    ID: id
                },

                success: function (data) {
                    var data = JSON.parse(data);

                    //console.log(data.prod_details);
                    $('.executive_clz').html(data.quot_det);

                    $('.product_clz').html(data.quot_prod);

                }


            });
        });

        /*####*/

        /*form submit start*/

        $(".submit_btn").on('click', function () {

            /* $('#SalesQuotReport').modal("hide");

             $('#add_form')[0].reset();

             $('.customer_clz option').remove();

             $('.executive_clz option').remove();

             $('.product_clz option').remove();*/


        });


        /*#####*/


        $(".search-btn").on('click', function () {

            $('#MaterialRequesitionReport').modal('show');
        });




        $(document).ready(function () {
            $(".excel_button").click(
                function () {
                    tableToExcel('DataTable', 'Material Recieved Note Report', 'Material Recieved Note Report');
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
                base64Conversion = function (s) {
                    return window.btoa(unescape(encodeURIComponent(s)))
                },
                formatExcelData = function (s, c) {
                    return s.replace(/{(\w+)}/g, function (m, p) {
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
    // Close modal when form is submitted
    document.getElementById('add_form').addEventListener('submit', function (e) {
        // Close the modal after the form is submitted
        $('#MaterialRequesitionReport').modal('hide');
    });
</script>


<script>
    document.getElementById("email_button").addEventListener("click", function () {
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
                var subject = encodeURIComponent("Material Recieved Note Report");
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