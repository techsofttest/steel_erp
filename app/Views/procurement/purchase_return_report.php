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

    #DataTable {
        table-layout: fixed;
        width:100%;
        margin: unset
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

.nested-table td{
    vertical-align: middle;
}


.select2.select2-container{   
    padding-top: 5px !important;
}


.select2-selection__rendered {
    white-space: wrap !important;  /* prevent weird line breaks */
    text-overflow: ellipsis;
    overflow: hidden;
}

span.select2.customer_width, span.select2{
    width:100% !important;
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
                        <div class="modal fade" id="PurchaseReturnReport" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <!--<form  class="Dashboard-form class" id="sales_quot_report_form">-->
                                <form method="GET" action="<?php echo base_url(); ?>Procurement/PurchaseReturnReport/GetData" target="_blank" class="Dashboard-form class" id="add_form">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Purchase Return Report</h5>
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

                                                                if (!empty($_GET['lpo_ref'])) {
                                                                    $customer = $_GET['lpo_ref'];
                                                                } else {
                                                                    $customer = "";
                                                                }

                                                                if (!empty($_GET['gl_account'])) {
                                                                    $customer = $_GET['gl_account'];
                                                                } else {
                                                                    $customer = "";
                                                                }


                                                                if (!empty($_GET['product'])) {
                                                                    $product =  $_GET['product'];
                                                                } else {
                                                                    $product = "";
                                                                }

                                                                ?>


                                                                <div class="mt-4">
                                                                    <table class="table table-bordered table-striped delTable">
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
                                                                            <td style="width: 30%;" class="center_padding">Vendor</td>
                                                                            <td style="width: 70%;"  colspan="4">
                                                                                    <select class="form-select vendor_dropdown" id="vendor" name="vendor">
                                                                                        <option value="" selected disabled>Select Vendor</option>
                                                                                        <?php foreach ($vendors as $vendor) { ?>
                                                                                            <option value="<?php echo $vendor->cc_id; ?>"><?php echo $vendor->cc_customer_name; ?></option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                            <!-- <tr>
                                                                            <td style="width: 30%;" class="center_padding">Lpo Ref</td>
                                                                            <td style="width: 70%;"  colspan="4">
                                                                                    <select class="form-select lpo_ref" id="lpo_ref" name="lpo_ref" >
                                                                                        <option value="" selected disabled>Select Lpo ref</option>
                                                                                    </select>
                                                                                </td>
                                                                            </tr> -->
                                                                            <tr>
                                                                            <td style="width: 30%;" class="center_padding">Sales Order</td>
                                                                            <td style="width: 70%;"  colspan="4">
                                                                                    <select class="form-select sales_order" id="sales_order" name="sales_order" >
                                                                                        <option value="" selected disabled>Select Sales Order</option>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                            <td style="width: 30%;" class="center_padding">GL Account</td>
                                                                            <td style="width: 70%;"  colspan="4">
                                                                                    <select class="form-select gl_acc_clz" name="gl_account">
                                                                                        <option value="" selected disabled>Select GL Account</option>
                                                                                        <?php foreach ($chart_acc as $charts) { ?>
                                                                                            <option value="<?php echo $charts->ca_id ?>"><?php echo $charts->ca_name; ?></option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </td>                                                                               
                                                                            </tr>
                                                                            <tr>
                                                                            <td style="width: 30%;" class="center_padding">Product</td>
                                                                            <td style="width: 70%;"  colspan="4">
                                                                                    <select class="form-select product_clz" value="" name="product">
                                                                                        <option value="" selected disabled>Select product</option>
                                                                                        <?php foreach ($products as $product) { ?>
                                                                                            <option value="<?php echo $product->product_details; ?>"><?php echo $product->product_details; ?></option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </td>                                                                            
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>

                                                                <!--table section end-->

                                                                <!--<div style="float: right;">
                                                                    <table class="table table-bordered table-striped enq_tab_submit menu">
                                                                        <tr>
                                                                           
                                                                            <td><button type="submit">View</button></td>
                                                                        </tr>
                                                                        <tr>
                                                                            
                                                                        </tr>
                                                                    </table>
                                                                </div>--->





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
<?php if (!empty($_GET)) { ?>   
                        <div class="row">
                            <div class="col-lg-12" style="padding: 0px;">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1" style="text-align: center;font-weight: 600;color: black; margin-right:-15%"> Purchase Return Reports</h4>

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
                                        <button class="email_button report_button" type="submit" id="email_button">Email</button>
                                        <!-- </form> -->

                                        <button type="button" data-bs-toggle="modal" id="clear_data" data-bs-target="#SalesQuotReport" class="btn btn-primary py-1 search-btn">Search</button>
                                    </div><!-- end card header -->
                                    <div class="card-body table-responsive divcontainer" style=" overflow-x:scroll;">
                                        <table id="DataTable" class="table table-bordered table-striped delTable display dataTable">
                                            <thead>
                                                <tr>
                                                    <th class="no-sort text-center" style="white-space: nowrap;width:60px">Sl no</th>
                                                    <th class="text-center" style="white-space: nowrap;width:70px">Date</th>
                                                    <th class="text-center" style="white-space: nowrap;width:100px">Vendor Ref</th>
                                                    <th class="" style="white-space: nowrap;width:300px">Vendor</th>
                                                    <th class="text-center" style="white-space: nowrap;width:100px">Vendor Invoice Ref</th>
                                                    <th class="text-center" style="white-space: nowrap;width:100px">Purchase Order Ref</th>
                                                    
                                                    <th class="text-end" style="white-space: nowrap;width:80px">Amount</th>
                                                </tr>
                                            </thead>

                                            <tbody class="tbody_data">
                                                <?php
                                                if (!empty($purchase_order)) {
                                                    $i = 1;
                                                    $total = 0;
                                                    foreach ($purchase_order as $pur_order) { ?>
                                                        <tr>
                                                            <td class="text-center" style="width:60px"><?php echo $i; ?></td>
                                                            <td class="text-center" style="width:70px"><?php echo date('d-M-Y', strtotime($pur_order->pr_date)); ?></td>
                                                            <td class="text-center" style="width:100px">
                                                                 <a href="<?php echo base_url().'Procurement/PurchaseReturn?view_so=' . $pur_order->pr_id; ?>" target="_blank"> 
                                                                    <?php echo $pur_order->pr_vendor_reff ?? ''; ?></a>
                                                            </td>
                                                            <td class="" style="white-space: nowrap;width:300px"><?php foreach ($vendors as $vendor) {
                                                                                                                        echo $pur_order->pr_vendor_name == $vendor->cc_id ? $vendor->cc_customer_name : '';  } ?>
                                                            </td>

                                                            <td class="text-center" style="width:100px"><?php echo $pur_order->pr_vendor_reff; ?></td>
                                                            
                                                            <td class="text-center" style="width:100px">
                                                                 <a href="<?php echo base_url().'Procurement/PurchaseOrder?view_so=' . $pur_order->po_id; ?>" target="_blank"> 
                                                                    <?php echo $pur_order->po_reffer_no ?? ''; ?>
                                                            </a></td>
                                                            
                                                            <td class="text-end" style="width:80px"><?php echo format_currency($pur_order->pr_total_amount); $total +=$pur_order->pr_total_amount; ?></td>
                                                        </tr>

                                                <?php $i++;
                                                    } ?>
                                                    <tr>
                                                     <th>Total</th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>                                                        
                                                            <th class="text-end"><?php echo format_currency($total); ?></th>
                                                            </tr>
                                              <?php   } ?>
  
                                                           
                                                        
                                            </tbody>

                                        </table>

                                    </div>
                                </div>
                            </div>

                            <?php } ?>
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


<script src="<?php echo base_url(); ?>public/assets/js/select2.min.js"></script>


<?php /*
<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        $(document).ready(function() {
            // When the 'Vendor' dropdown is changed
            $('#vendor').change(function() {
                var vendorId = $(this).val();

                // Send AJAX request to get Lpo Ref based on Vendor
                $.ajax({
                    url: '<?php echo base_url(); ?>Procurement/PurchaseReturnReport/fetch_lpo_ref', // URL to fetch Lpo Ref (e.g., controller function)
                    method: 'POST',
                    data: {
                        vendor_id: vendorId
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('#lpo_ref').prop('disabled', false); // Enable Lpo Ref dropdown
                        $('#lpo_ref').html('<option value="" selected disabled>Select Lpo ref</option>'); // Reset Lpo Ref dropdown
                        $.each(response, function(index, lpoRef) {
                            $('#lpo_ref').append('<option value="' + lpoRef.po_id + '">' + lpoRef.po_reffer_no + '</option>');
                        });
                    }
                });
            });

            // When the 'Lpo Ref' dropdown is changed
            $('#lpo_ref').change(function() {
                var lpoRef = $(this).val();

                // Send AJAX request to get Sales Orders based on Lpo Ref
                $.ajax({
                    url: '<?php echo base_url(); ?>Procurement/PurchaseReturnReport/fetch_sales_order', // URL to fetch Sales Orders (e.g., controller function)
                    method: 'POST',
                    data: {
                        lpo_ref: lpoRef
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('#sales_order').prop('disabled', false); // Enable Sales Order dropdown
                        $('#sales_order').html('<option value="" selected disabled>Select Sales Order</option>'); // Reset Sales Order dropdown
                        $.each(response, function(index, salesOrder) {
                            $('#sales_order').append('<option value="' + salesOrder.so_id + '">' + salesOrder.so_reffer_no + '</option>');
                        });
                    }
                });
            });
        });
    });
</script>

*/?>


<script>
    document.addEventListener("DOMContentLoaded", function(event) {

        /*modal open start*/
        <?php if (empty($_GET)): ?>

            $(window).on('load', function() {

                $('#PurchaseReturnReport').modal('show');
            });

        <?php endif; ?>

        /*modal open end*/


        /* customer droup drown */
        $(".droup_sales").select2({
            placeholder: "Select Customer",
            theme: "default form-control- customer_width",
            dropdownParent: $('#PurchaseReturnReport'),

            ajax: {
                url: "<?= base_url(); ?>Procurement/MaterialReqReport/FetchTypes",
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

        $("body").on('change', '.customer_clz', function() {


            var id = $(this).val();


            $.ajax({

                url: "<?php echo base_url(); ?>Procurement/MaterialReqReport/FetchData",

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

        /*form submit start*/

        $(".submit_btn").on('click', function() {

            /* $('#SalesQuotReport').modal("hide");

             $('#add_form')[0].reset();

             $('.customer_clz option').remove();

             $('.executive_clz option').remove();

             $('.product_clz option').remove();*/


        });


        /*#####*/



        $(".search-btn").on('click', function() {

            $('#PurchaseReturnReport').modal('show');
        });


        $(document).ready(function() {
            $(".excel_button").click(
                function() {
                    tableToExcel('DataTable', ' Purchase Return Report', 'Purchase Return Report');
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




                // ======================

         /*Vendor dropdown search*/
        $(".vendor_dropdown").select2({
            placeholder: "Select Vendor",
            theme: "default form-control- customer_width",
            dropdownParent: $('#PurchaseReturnReport'),
            ajax: {
                url: "<?= base_url(); ?>Procurement/PurchaseReturnReport/FetchVendors",
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
                                id: item.cc_id,
                                text: $.trim(item.cc_customer_name)  // <--- trim whitespace here
                            };
                        }),
                        pagination: {
                            more: (page * 10) <= data.total_count
                        }
                    };
                }

            }

        })

        /* product dropdown search */
        $(".product_clz").select2({
            placeholder: "Select Product",
            theme: "default form-control- customer_width",
            dropdownParent: $('#PurchaseReturnReport'),
            ajax: {
                url: "<?= base_url(); ?>Procurement/PurchaseReturnReport/FetchProducts",
                type: "POST", // ✅ Make sure this is POST since controller expects POST
                dataType: 'json',
                delay: 250,
                cache: false,
                minimumInputLength: 1,
                allowClear: true,
                data: function (params) {
                    return {
                        term: params.term,
                        page: params.page || 1,
                        salesorder: $('.sales_order').val() // ✅ send inside data function
                    };
                },
                processResults: function (data, params) {
                    var page = params.page || 1;
                    return {
                        results: $.map(data.result, function (item) {
                            return { id: item.product_id, text: item.product_details };
                        }),
                        pagination: {
                            more: (page * 10) <= data.total_count
                        }
                    };
                },
            }
        });

        $(".lpo_ref").select2({
            placeholder: "Select LPO Ref",
            theme: "default form-control- customer_width",
            dropdownParent: $('#PurchaseReturnReport'),
            ajax: {
                url: "<?= base_url(); ?>Procurement/PurchaseReturnReport/FetchLpoRef",
                dataType: 'json',
                delay: 250,
                cache: false,
                minimumInputLength: 1,
                allowClear: true,
                data: function (params) {
                    return {
                        vendor_id: $('.vendor_dropdown').val(),
                        term: params.term,
                        page: params.page || 1,
                    };
                },
                processResults: function (data, params) {
                    var page = params.page || 1;
                    return {
                        results: $.map(data.result, function (item) {
                            return {
                                id: item.po_id,
                                text: $.trim(item.po_reffer_no)  // <--- trim whitespace here
                            };
                        }),
                        pagination: {
                            more: (page * 10) <= data.total_count
                        }
                    };
                }

            }

        })




        /*product droup drown search*/
        $(".sales_order").select2({
            placeholder: "Select Sales Order",
            theme: "default form-control- customer_width",
            dropdownParent: $('#PurchaseReturnReport'),
            ajax: {
                url: "<?= base_url(); ?>Procurement/PurchaseReturnReport/FetchSalesOrder",
                dataType: 'json',
                delay: 250,
                cache: false,
                minimumInputLength: 1,
                allowClear: true,
                data: function (params) {
                    return {
                        lpo_ref: $('.lpo_ref').val(),
                        term: params.term,
                        page: params.page || 1,
                    };
                },
                processResults: function (data, params) {
                    var page = params.page || 1;
                    return {
                        results: $.map(data.result, function (item) {
                            return {
                                id: item.so_reffer_no,
                                text: $.trim(item.so_reffer_no)  // <--- trim whitespace here
                            };
                        }),
                        pagination: {
                            more: (page * 10) <= data.total_count
                        }
                    };
                }

            }

        })


             /*customer droup drown search*/
        $(".gl_acc_clz").select2({
            placeholder: "Select GL Account",
            theme : "default form-control- customer_width",
            dropdownParent: $('#PurchaseReturnReport'),
            ajax: {
                url: "<?= base_url(); ?>Procurement/PurchaseReturnReport/FetchGLAccounts",
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
                    //console.log(data);
                    //NO NEED TO PARSE DATA `processResults` automatically parse it
                    //var c = JSON.parse(data);
                    //console.log(data);
                    var page = params.page || 1;
                    return {
                        results: $.map(data.result, function (item) { return {id: item.ca_id, text: item.ca_name}}),
                        pagination: {
                        // THE `10` SHOULD BE SAME AS `$resultCount FROM PHP, it is the number of records to fetch from table` 
                            more: (page * 10) <= data.total_count
                        }
                    };
                },              
            }         
        })
        /*###*/

       
    });
</script>

<script>
    document.getElementById('add_form').addEventListener('submit', function(e) {
        // Close the modal after the form is submitted
        $('#PurchaseReturnReport').modal('hide');
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
                var subject = encodeURIComponent("Purchase Return Report");
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