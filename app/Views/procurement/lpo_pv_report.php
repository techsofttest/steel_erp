<div class="tab-content text-muted">

    <div class="tab-pane active" id="nav-crm-top-1-1" role="tabpanel">

        <div class="row">

            <div class="col-lg-12">

                <!-- Tab panes -->
                <div class="tab-content text-muted">
                    <!--product head tab-->
                    <div class="tab-pane active" id="arrow-1" role="tabpanel">


                        <!--sales rout report modal start-->
                        <div class="modal fade" id="MaterialRequesitionReport" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <!--<form  class="Dashboard-form class" id="sales_quot_report_form">-->
                                <form method="GET" action="<?php echo base_url(); ?>Procurement/LPO_PVReport/GetData" target="_blank" class="Dashboard-form class" id="add_form">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Purchase Order to Material Received Note Analysis </h5>
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
                                                                                <td>Date</td>
                                                                                <td class="text-center">From</td>
                                                                                <td><input type="date" name="form_date" id="from_date_id" value="<?php echo $from_date; ?>" onclick="this.showPicker();" class="form-control"></td>
                                                                                <td>To</td>
                                                                                <td><input type="date" name="to_date" id="to_date_id" value="<?php echo $to_date; ?>" onclick="this.showPicker();" class="form-control"></td>

                                                                            </tr>


                                                                        </thead>


                                                                        <tbody class="travelerinfo">

                                                                            <tr>
                                                                                <td>Vendor</td>
                                                                                <td>
                                                                                    <select class="form-select" id="vendor" name="vendor">
                                                                                        <option value="" selected disabled>Select Vendor</option>
                                                                                        <?php foreach ($vendors as $vendor) { ?>
                                                                                            <option value="<?php echo $vendor->ven_id; ?>"><?php echo $vendor->ven_name; ?></option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>

                                                                            <tr>
                                                                                <td>Lpo Ref</td>
                                                                                <td>
                                                                                    <select class="form-select" id="lpo_ref" name="lpo_ref" disabled>
                                                                                        <option value="" selected disabled>Select Lpo ref</option>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>

                                                                            <tr>
                                                                                <td>Sales Order</td>
                                                                                <td>
                                                                                    <select class="form-select" id="sales_order" name="sales_order" disabled>
                                                                                        <option value="" selected disabled>Select Sales Order</option>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>



                                                                            <tr>
                                                                                <td>Product</td>
                                                                                <td>
                                                                                    <select class="form-select" value="" name="product">
                                                                                        <option value="" selected disabled>Select product</option>
                                                                                        <?php foreach ($products as $product) { ?>
                                                                                            <option value="<?php echo $product->product_id; ?>"><?php echo $product->product_details; ?></option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                            </tr>

                                                                            <tr>
                                                                                <td></td>
                                                                                <td>
                                                                                    <table>
                                                                                        <tr>
                                                                                            <td style="width:33%">Pending</td>
                                                                                            <td> <input class="" type="checkbox" name="pending">
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                            </tr>

                                                                            <tr>
                                                                                <td></td>
                                                                                <td>
                                                                                    <table>
                                                                                        <tr>
                                                                                            <td style="width:33%">Linked </td>
                                                                                            <td> <input class="" type="checkbox" name="linked">
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                <td>

                                                                                </td>
                                                                                <td></td>
                                                                                <td></td>

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

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">View Material Received Note to Purchase Voucher Analysis </h4>

                                        <form method="POST" target="_blank">
                                            <input type="hidden" name="pdf" value="1">
                                            <button type="submit" class="pdf_button report_button">PDF</button>
                                        </form>

                                        <!-- <form method="POST" action="" target="_blank">
                                            <input type="hidden" name="excel" value="1">
                                            <button class="excel_button report_button" type="submit">Excel</button>
                                        </form> -->

                                        <form method="POST" action="" target="_blank">
                                            <input type="hidden" name="excel" value="1">
                                            <button class="print_button report_button" type="submit">Print</button>
                                        </form>

                                        <form method="POST" action="" target="_blank">
                                            <input type="hidden" name="excel" value="1">
                                            <button class="email_button report_button" type="submit">Email</button>
                                        </form>

                                        <button type="button" data-bs-toggle="modal" id="clear_data" data-bs-target="#SalesQuotReport" class="btn btn-primary py-1 search-btn">Search</button>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <table id="DataTable" class="table table-bordered table-striped delTable display dataTable">
                                            <thead>
                                                <tr>
                                                    <th class="no-sort">Sl no</th>
                                                    <th>Date</th>
                                                    <th>Purchase Order Ref</th>
                                                    <th>Vendor</th>
                                                    <th>MRN Ref</th>
                                                    <th>Sales Order Ref</th>
                                                    <th>Vendor Inv Ref</th>
                                                    <th>Amount</th>
                                                    <th>Product</th>
                                                    <th>Quantity</th>
                                                    <th>Rate</th>
                                                    <th>Amount</th>
                                                    <th>Vendor invoice Ref</th>
                                                    <th>Quantity</th>
                                                    <th>Rate</th>
                                                    <th>Amount</th>
                                                    <th>Balance</th>
                                                </tr>
                                            </thead>

                                            <tbody class="tbody_data">
                                                <?php
                                                if (!empty($purchase_order)) {
                                                    $i = 1;
                                                    $balance = $po_amount = $pv_amount = $tot_amount = 0;
                                                    foreach ($purchase_order as $pur_order) { ?>
                                                        <tr>
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo $pur_order->po_date; ?></td>
                                                            <td><?php echo $pur_order->po_reffer_no; ?></td>
                                                            <td><?php foreach ($vendors as $vendor) {
                                                                    echo $pur_order->po_vendor_name == $vendor->ven_id ? $vendor->ven_name : '';
                                                                } ?>
                                                            </td>
                                                            <td><?php echo $pur_order->mrn_reffer; ?></td>

                                                            <td><?php foreach ($pur_order->product_orders as $orders) { ?>
                                                                    <?php echo $orders->so_reffer_no; ?><br>
                                                                <?php } ?></td>


                                                            <td><?php echo $pur_order->po_vendor_ref; ?></td>
                                                            <td><?php echo $pur_order->po_amount;
                                                                $tot_amount += $pur_order->po_amount; ?></td>
                                                            <td><?php foreach ($pur_order->product_orders as $orders) { ?>
                                                                    <?php echo $orders->product_details; ?><br>
                                                                <?php } ?></td>
                                                            <td><?php foreach ($pur_order->product_orders as $orders) { ?>
                                                                    <?php echo $orders->pop_qty; ?><br>
                                                                <?php } ?></td>

                                                            <td><?php foreach ($pur_order->product_orders as $orders) { ?>
                                                                    <?php echo $orders->pop_rate; ?><br>
                                                                <?php } ?></td>
                                                            <td><?php foreach ($pur_order->product_orders as $orders) { ?>
                                                                    <?php echo $orders->pop_amount;
                                                                    $po_amount += $orders->pop_amount; ?><br>
                                                                <?php } ?></td>

                                                            <td><?php echo $pur_order->pv_vendor_inv ?? ''; ?></td>

                                                            <td><?php if (isset($pur_order->voucher_prod)) {
                                                                    foreach ($pur_order->voucher_prod as $orders) { ?>
                                                                        <?php echo $orders->pvp_qty; ?><br>
                                                                <?php }
                                                                } ?></td>

                                                            <td><?php if (isset($pur_order->voucher_prod)) {
                                                                    foreach ($pur_order->voucher_prod as $orders) { ?>
                                                                        <?php echo $orders->pvp_rate; ?><br>
                                                                <?php }
                                                                } ?></td>

                                                            <td><?php if (isset($pur_order->voucher_prod)) {
                                                                    foreach ($pur_order->voucher_prod as $orders) { ?>
                                                                        <?php echo $orders->pvp_amount;
                                                                        $pv_amount += $orders->pvp_amount; ?><br>
                                                                <?php }
                                                                } ?></td>

                                                            <td>
                                                                <?php
                                                                // Ensure the counts of product_orders and voucher_prod are the same
                                                                if (isset($pur_order->voucher_prod) && isset($pur_order->product_orders)) {
                                                                    $count = min(count($pur_order->product_orders), count($pur_order->voucher_prod));

                                                                    // Loop through both arrays simultaneously
                                                                    for ($i = 0; $i < $count; $i++) {
                                                                        $pop_amount = $pur_order->product_orders[$i]->pop_amount;
                                                                        $pvp_amount = $pur_order->voucher_prod[$i]->pvp_amount;
                                                                        $difference = $pop_amount - $pvp_amount;
                                                                        echo $difference . "<br>";

                                                                        $balance += $difference;
                                                                    }
                                                                }
                                                                ?>
                                                            </td>

                                                        </tr>

                                                    <?php $i++;
                                                    } ?>

                                                    <tr>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th><?php echo $tot_amount; ?></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th><?php echo $po_amount; ?></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th><?php echo $pv_amount; ?></th>
                                                        <th><?php echo $balance; ?></th>
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
        $(document).ready(function() {
            // When the 'Vendor' dropdown is changed
            $('#vendor').change(function() {
                var vendorId = $(this).val();

                // Send AJAX request to get Lpo Ref based on Vendor
                $.ajax({
                    url: '<?php echo base_url(); ?>Procurement/LPO_PVReport/fetch_lpo_ref', // URL to fetch Lpo Ref (e.g., controller function)
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
                    url: '<?php echo base_url(); ?>Procurement/LPO_PVReport/fetch_sales_order', // URL to fetch Sales Orders (e.g., controller function)
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


<script>
    document.addEventListener("DOMContentLoaded", function(event) {

        /*modal open start*/
        <?php if (empty($_GET)): ?>

            $(window).on('load', function() {

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

            $('#MaterialRequesitionReport').modal('show');
        });





    });
</script>