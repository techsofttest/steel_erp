<style>
    .select2.select2-container {
        width: 95% !important;
    }

    .cust_more_modal {
        /*position: absolute;
        left: 471px;
        padding: 0px 23px;
        z-index: 999;
        border: 1px solid black;
        border: 1px solid #0000003b;*/

        position: absolute;
        right: 32px;
        top: -16px;
        font-size: 25px;
        color: #ff0000b5;

    }

    span.select2.select_width {
        width: 70% !important;
    }

    .prod_add_more {
        position: absolute;
        left: 340px;
        padding: 4px 27px;
        z-index: 999;
        border: 1px solid black;
        border: 1px solid #0000003b;
    }

    .row_align {
        display: flex;
        align-items: center;
        justify-content: unset !important;
    }

    .add_new {
        position: absolute;
        left: 471px;
        padding: 2px 27px;
        z-index: 999;
        border: 1px solid black;
        border: 1px solid #0000003b;
    }

    .input_length {
        width: 95% !important;
    }

    .input_length2 {
        width: 18% !important;
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

                        <!--add enquiry modal start-->
                        <div class="modal fade" id="AddMaterialReceived" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <form class="Dashboard-form class" id="add_material_form" data_fill="false">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Material Received Note</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">

                                            <div class="live-preview">

                                                <div class="row">

                                                    <div class="col-lg-6">

                                                        <div class="row">
                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basiInput" class="form-label">Referance</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="mrn_reffer_no" id="mrn_id" class="form-control input_length" value="" required readonly>
                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <!-- ### -->


                                                            <!-- Single Row Start -->

                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basiInput" class="form-label">Date</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="mrn_date" class="form-control mr_date datepicker_ap input_length" required>
                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <!-- ### -->


                                                            <!-- Single Row Start -->

                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">

                                                                        <label for="basicInput" class="form-label">Vendor Name</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">

                                                                        <select class="form-select select_vendor add_vendor vendor_data" name="mrn_vendor_name" id="" required>

                                                                            <option value="" selected disabled>Select Customer</option>

                                                                        </select>
                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <!-- ### -->




                                                            <!-- Single Row Start -->

                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">

                                                                        <label for="basicInput" class="form-label">Purchase Order</label>

                                                                    </div>

                                                                    <div class="col-col-md-8 col-lg-8">

                                                                        <select class="form-select select_purchase" name="mrn_purchase" id="" required="" aria-required="true">

                                                                            <option value="" selected="" disabled="">Select MRN Ref</option>

                                                                        </select>

                                                                    </div>

                                                                    <div class="col-col-md-1 col-lg-1">

                                                                        <span class="add_more_icon cust_more_modal ri-add-box-fill" id="blink"></span>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <!-- ### -->




                                                        </div>

                                                    </div>


                                                    <div class="col-lg-6">

                                                        <div class="row">

                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Delivery Note</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="mrn_delivery_note" class="form-control " value="" required>
                                                                    </div>

                                                                </div>

                                                            </div>
                                                            <!-- ### -->

                                                            <!-- Single Row Start -->

                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">

                                                                        <label for="basicInput" class="form-label">MR Ref</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">

                                                                        <input type="text" name="mr_reff" class="form-control mr_ref" value="" required>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <!-- ### -->


                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Payment Term</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text " name="mrn_payment_term" class="form-control add_payment_term" value="" required>
                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <!-- ### -->





                                                            <input type="hidden" class="hidden_recived_id" name="received_id">



                                                        </div>

                                                    </div>



                                                </div>


                                                <!--table section start-->
                                                <div class="mt-4">
                                                    <table class="table table-bordered table-striped delTable selected_table" style="display:none;">
                                                        <tbody class="travelerinfo">

                                                            <tr>
                                                                <td>Serial No.</td>
                                                                <td>Sales Order Ref</td>
                                                                <td>Product Description</td>
                                                                <td>Unit</td>
                                                                <td>Order Qty</td>
                                                                <td>Delivery Qty</td>
                                                                <td>Current Delivery</td>
                                                            </tr>

                                                        </tbody>

                                                        <tbody class="travelerinfo product-more2"></tbody>

                                                    </table>
                                                </div>


                                                <div class="row">
                                                    <div class="col-lg-6">

                                                        <div class="row row_align mb-4">

                                                            <div class="col-lg-2">
                                                                <label for="basicInput" class="form-label">Attach</label>
                                                            </div>

                                                            <div class="col-lg-4">
                                                                <input type="file" name="mrn_file" Class="image_file" class="form-control">
                                                            </div>

                                                        </div>


                                                    </div>

                                                    <div class="col-lg-6"></div>

                                                </div>




                                                <!--table section end-->


                                            </div>



                                        </div>


                                        <div class="modal-footer justify-content-center">
                                            <button class="btn btn btn-success once_form_submit" type="submit">Save</button>
                                        </div>



                                    </div>
                                </form>

                            </div>
                        </div>


                        <!--####-->


                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">View Material Received Note</h4>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#AddMaterialReceived" class="btn btn-primary py-1 add_model_btn">Add</button>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <table id="DataTable" class="table table-bordered table-striped delTable display dataTable">

                                            <thead>
                                                <tr>
                                                    <th class="no-sort">Sl no</th>
                                                    <th>Reference</th>
                                                    <th>Purchase Order</th>
                                                    <th>Date</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>

                                            <tbody></tbody>

                                        </table>

                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                    </div>
                    <!--###-->





                </div>



            </div>

        </div>


    </div>



</div>

<!--view section start-->

<div class="modal fade" id="ViewModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form class="Dashboard-form class" id="">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Material Received Note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="live-preview">

                        <div class="row">

                            <div class="col-lg-6">

                                <div class="row">


                                    <!-- Single Row Start -->
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basiInput" class="form-label">Referance</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="text" name="" id="" class="form-control view_ref" readonly>
                                            </div>

                                        </div>

                                    </div>
                                    <!-- ### -->


                                    <!-- Single Row Start -->
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basiInput" class="form-label">Date</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="text" name="" class="form-control view_date" readonly>
                                            </div>

                                        </div>

                                    </div>

                                    <!-- ### -->


                                    <!-- Single Row Start -->

                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Vendor Name</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">

                                                <input type="text" name="" class="form-control view_vendor_name" readonly>

                                                </select>
                                            </div>

                                        </div>

                                    </div>

                                    <!-- ### -->



                                    <!-- Single Row Start -->


                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Purchase Order</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">

                                                <input type="text" name="" class="form-control view_contact_person" readonly>

                                            </div>

                                        </div>

                                    </div>


                                    <!-- ### -->
                                </div>

                            </div>


                            <div class="col-lg-6">

                                <div class="row">


                                    <!-- Single Row Start -->
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Delivery Note</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">

                                                <input type="text" name="" class="form-control view_mrn_ref" readonly>

                                            </div>

                                        </div>

                                    </div>

                                    <!-- ### -->



                                    <!-- Single Row Start -->
                                    <div class="col-lg-12">
                                        <div class="row align-items-center mb-2">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">MR Ref</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">

                                                <input type="text" name="" class="form-control view_payment_term" readonly>

                                            </div>

                                        </div>

                                    </div>
                                    <!-- ### -->


                                    <!-- Single Row Start -->
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Payment Term</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="text" name="" class="form-control view_delivery_date" readonly>
                                            </div>

                                        </div>

                                    </div>

                                    <!-- ### -->




                                </div>

                            </div>


                        </div>


                        <!--table section start-->
                        <div class="mt-4">
                            <table class="table table-bordered table-striped delTable">
                                <thead class="travelerinfo contact_tbody">
                                    <tr>
                                        <td>Serial No.</td>
                                        <td>Sales Order</td>
                                        <td>Product Description</td>
                                        <td>Unit</td>
                                        <td>Order Qty</td>
                                        <td>Delivered Qty</td>



                                    </tr>


                                </thead>

                                <tbody class="travelerinfo view_prod_data"></tbody>




                            </table>
                        </div>



                        <div class="row">
                            <div class="col-lg-6">

                                <div class="card-body view_image_table" style="float: inline-start;"></div>


                            </div>
                            <div class="col-lg-6"></div>

                        </div>

                        <!--table section end-->

                    </div>

                </div>

            </div>
        </form>

    </div>
</div>

<!--view section end-->



<!--edit section start-->

<div class="modal fade" id="EditModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form class="Dashboard-form class" id="edit_modal_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Material Received Note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="live-preview">

                        <div class="row">

                            <div class="col-lg-6">

                                <div class="row">
                                    <!-- Single Row Start -->
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basiInput" class="form-label">Referance</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="text" name="" class="form-control edit_reff" required readonly>
                                            </div>

                                        </div>

                                    </div>

                                    <!-- ### -->


                                    <!-- Single Row Start -->

                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basiInput" class="form-label">Date</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="text" name="mrn_date" class="form-control edit_date datepicker_ap" required>
                                            </div>

                                        </div>

                                    </div>

                                    <!-- ### -->


                                    <!-- Single Row Start -->
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Vendor Name</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="text" name="" class="form-control edit_vendor" required readonly>
                                            </div>



                                        </div>

                                    </div>

                                    <!-- ### -->


                                    <!-- Single Row Start -->

                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Purchase Order</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="text" name="" class="form-control edit_purchase" required readonly>
                                            </div>




                                        </div>

                                    </div>

                                    <!-- ### -->

                                </div>

                            </div>


                            <div class="col-lg-6">

                                <div class="row">

                                    <!-- Single Row Start -->

                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Delivery Note</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">

                                                <input type="text" name="mrn_delivery_note" class="form-control edit_delivery" value="" required>

                                            </div>

                                        </div>

                                    </div>

                                    <!-- ### -->

                                    <!-- Single Row Start -->

                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">MR Ref</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">

                                                <input type="text" name="" class="form-control edit_mr" value="" readonly>

                                            </div>

                                        </div>

                                    </div>

                                    <!-- ### -->

                                    <!-- Single Row Start -->
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Payment Term</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="text" name="" class="form-control  edit_payment_term" value="" required readonly>
                                            </div>

                                        </div>

                                    </div>

                                    <!-- ### -->


                                    <input type="hidden" name="mrn_id" class="edit_main_id">

                                    <!--<input type="hidden"   class="edit_mrn_reff_id">--->

                                    <!-- ### -->




                                </div>

                            </div>

                        </div>


                        <!--table section start-->
                        <div class="mt-4">
                            <table class="table table-bordered table-striped delTable">
                                <tbody class="travelerinfo">

                                    <tr>
                                        <td>Serial No.</td>
                                        <td>Sales Order Ref</td>
                                        <td>Product Description</td>
                                        <td>Unit</td>
                                        <td>Order Qty</td>
                                        <td>Delivered Qty</td>
                                        
                                    </tr>

                                </tbody>

                                <tbody class="edit_products"></tbody>


                            </table>
                        </div>

                        <!--table section end-->


                        <!--image section start--->


                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card-body edit_image_table"></div>
                            </div>
                            <div class="col-lg-6"></div>

                        </div>


                        <!--image section end-->

                    </div>

                </div>


                <div class="modal-footer justify-content-center">
                    <button class="btn btn btn-success" type="submit">Save</button>
                </div>

            </div>
        </form>

    </div>
</div>

<!--edit section end-->





<!--select modal section start-->

<div class="modal fade" id="SelectProduct" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form class="Dashboard-form class" id="selected_prod_form">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="live-preview">

                        <div class="mt-4">

                            <table class="table table-bordered table-striped delTable">

                                <thead class="travelerinfo contact_tbody">

                                    <tr>
                                        <td>Serial No.</td>
                                        <td>Product Description</td>
                                        <td>Unit</td>
                                        <td>Qty</td>
                                        <td>Tick</td>
                                    </tr>

                                </thead>

                                <tbody class="travelerinfo select_prod_add"></tbody>

                            </table>

                        </div>

                    </div>

                </div>

                <div class="modal-footer justify-content-center">

                    <input type="hidden" id="select_prod_id" name="select_prod_id" value="">
                    <span class="btn btn btn-success prod_modal_submit">Save</span>

                </div>

            </div>
        </form>

    </div>

</div>



<!--select  modal section end-->


<!--vendor modal start-->

<?= $this->include('procurement/add_vendor') ?>

<!--vendor modal end-->


<!--contact modal start-->

<?= $this->include('procurement/add_vendor_contact') ?>

<!--contact modal end-->


<script>
    document.addEventListener("DOMContentLoaded", function(event) {

        /*add section start*/

        /*add form*/
        $(function() {
            var form = $('#add_material_form');

            form.validate({
                rules: {
                    required: 'required',
                },
                messages: {
                    required: 'This field is required',
                },
                errorPlacement: function(error, element) {}, // To Hide Validation Messages
                submitHandler: function(currentForm) {

                    if ($('#add_material_form').attr('data_fill') == "true") {
                        var formData = new FormData(currentForm);
                        $('.once_form_submit').attr('disabled', true); // Disable this input.
                        // Submit the form for the current tab
                        $.ajax({
                            url: "<?php echo base_url(); ?>Procurement/MaterialReceivedNote/Add",
                            method: "POST",
                            //data: $(currentForm).serialize(),
                            data: formData,
                            processData: false, // Don't process the data
                            contentType: false, // Don't set content type
                            success: function(data) {

                                $('#AddMaterialReceived').modal('hide');

                                alertify.success('Data Added Successfully').delay(3).dismissOthers();

                                datatable.ajax.reload(null, false);


                            }
                        });

                    } else {
                        alertify.error('Please Select Products').delay(3).dismissOthers();


                        $('#blink').each(function() {
                            var elem = $(this);
                            refreshIntervalId = setInterval(function() {
                                if (elem.css('visibility') == 'hidden') {
                                    elem.css('visibility', 'visible');
                                } else {
                                    elem.css('visibility', 'hidden');
                                }
                            }, 200);
                        });

                        setTimeout(function() {
                            clearInterval(refreshIntervalId);

                        }, 1000)
                    }

                }
            });
        });


        /*#####*/









        /*Product Drop Down*/
        function InitSelect2() {
            $(".ser_product_det:last").select2({
                placeholder: "Select Product",
                theme: "default form-control- select_width",
                dropdownParent: $('#AddPurchaseOrder'),
                ajax: {
                    url: "<?= base_url(); ?>Procurement/MaterialRequisition/FetchProdDes",
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
                                    id: item.product_id,
                                    text: item.product_details
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
        }

        InitSelect2();

        /*###*/



        /*Time Frame section start*/


        $("body").on('change', '.mr_date', function() {

            var date = $(this).val();



            $.ajax({

                url: "<?php echo base_url(); ?>Procurement/MaterialRequisition/Date",

                method: "POST",

                data: {
                    Date: date
                },

                success: function(data) {
                    var data = JSON.parse(data);

                    $('.time_frame_date').val(data.increment_date_date)


                }


            });


        });



        /*Time Frame section end*/


        /*reset reff no*/

        $('.add_mr_form').click(function() {

            $('#add_enquiry_form')[0].reset();
            $('.ser_product_det').val('').trigger('change');
            $('.add_assigned_to').val('').trigger('change');
            $('.add_sales_order').val('').trigger('change');
            $('.mr_remove').remove();

            $.ajax({

                url: "<?php echo base_url(); ?>Procurement/MaterialRequisition/FetchReference",

                method: "GET",

                success: function(data) {
                    $('#mr_id').val(data);

                }

            });

        });

        /*####*/


        /*serial no correction section start*/

        function slno() {

            var pp = 1;

            $('body .prod_row').each(function() {

                $(this).find('.si_no').html(pp);



                pp++;

            });
        }

        /*###*/


        /*add section end*/



        /*view section start*/

        $("body").on('click', '.view_btn', function() {

            var id = $(this).data('id');

            $.ajax({

                url: "<?php echo base_url(); ?>Procurement/MaterialReceivedNote/View",

                method: "POST",

                data: {
                    ID: id
                },

                success: function(data) {

                    var data = JSON.parse(data);

                    $('.view_ref').val(data.reffer_n0);

                    $('.view_date').val(data.date);

                    $('.view_vendor_name').val(data.vendor_name);

                    $('.view_contact_person').val(data.purchase_order);

                    $('.view_mrn_ref').val(data.delivery_note);

                    $('.view_payment_term').val(data.mr_reffer);

                    $('.view_delivery_date').val(data.payment_term);

                    $('.view_prod_data').html(data.sales_order);

                    $('.view_image_table').html(data.image_table)

                    $('#ViewModal').modal("show");

                }

            });

        });

        /*view section end*/



        /*edit section start*/


        $("body").on('click', '.edit_btn', function() {

            var id = $(this).data('id');

            $.ajax({

                url: "<?php echo base_url(); ?>Procurement/MaterialReceivedNote/Edit",

                method: "POST",

                data: {
                    ID: id
                },

                success: function(data) {

                    var data = JSON.parse(data);

                    $('.edit_reff').val(data.reffer_n0);

                    $('.edit_date').val(data.date);

                    $('.edit_vendor').val(data.vendor_name);

                    $('.edit_purchase').val(data.purchase_order);

                    $('.edit_delivery').val(data.delivery_note);

                    $('.edit_mr').val(data.mr_reffer);

                    $('.edit_payment_term').val(data.payment_term);

                    $('.edit_main_id').val(data.main_id);

                    $('.edit_products').html(data.sales_order);

                    $('.edit_image_table').html(data.image_table);

                    $('#EditModal').modal("show");

                }

            });

        });


        /*add form*/
        $(function() {
            var form = $('#edit_modal_form');

            form.validate({
                rules: {
                    required: 'required',
                },
                messages: {
                    required: 'This field is required',
                },
                errorPlacement: function(error, element) {}, // To Hide Validation Messages
                submitHandler: function(currentForm) {
                    var formData = new FormData(currentForm);
                    // Submit the form for the current tab
                    $.ajax({
                        url: "<?php echo base_url(); ?>Procurement/MaterialReceivedNote/Update",
                        method: "POST",
                        //data: $(currentForm).serialize(),
                        data: formData,
                        processData: false, // Don't process the data
                        contentType: false, // Don't set content type
                        success: function(data) {

                            $('#EditModal').modal('hide');

                            alertify.success('Data Update Successfully').delay(3).dismissOthers();

                            datatable.ajax.reload(null, false);


                        }
                    });

                }
            });
        });

        /*#####*/



        /*delete section start*/

        $("body").on('click', '.sales_delete', function() {

            

            var id = $(this).data('id');

            var rowToDelete = $(this).closest('tr');

            $.ajax({

                url: "<?php echo base_url(); ?>Procurement/MaterialReceivedNote/DeleteSales",

                method: "POST",

                data: {
                    ID: id
                },

                success: function(data) {
                    var data = JSON.parse(data);

                    rowToDelete.fadeOut(500, function() {

                        $(this).remove();

                        alertify.error('Data Delete Successfully').delay(3).dismissOthers();

                        if (data.status === "true") {
                            $('#EditModal').modal('hide');
                        }

                        datatable.ajax.reload(null, false);
                    });

                }

            });

        });

        /*delete section end*/



        /*edit section end*/



        /*delete section start*/

        $("body").on('click', '.delete_btn', function() {

            if (!confirm('Are you absolutely sure you want to delete?')) return false;

            var id = $(this).data('id');

            var rowToDelete = $(this).closest('tr');

            $.ajax({

                url: "<?php echo base_url(); ?>Procurement/MaterialReceivedNote/Delete",

                method: "POST",

                data: {
                    ID: id
                },

                success: function(data) {

                    var data = JSON.parse(data);

                    if(data.status === "true"){

                        rowToDelete.fadeOut(500, function() {

                            $(this).remove();

                            alertify.error('Data Delete Successfully').delay(3).dismissOthers();



                            datatable.ajax.reload(null, false);
                        });

                    }else{

                        alertify.error("Data in Use Can't Be Delete").delay(3).dismissOthers();
                    }

                }

            });

        });

        /*delete section end*/




        /*data table start*/

        function initializeDataTable() {

            datatable = $('#DataTable').DataTable({
                'stateSave': true,
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url': "<?php echo base_url(); ?>Procurement/MaterialReceivedNote/FetchData",
                    'data': function(data) {
                        // CSRF Hash
                        var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
                        var csrfHash = $('.txt_csrfname').val(); // CSRF hash

                        return {
                            data: data,
                            [csrfName]: csrfHash, // CSRF Token
                        };
                    },
                    dataSrc: function(data) {
                        // Update token hash
                        $('.txt_csrfname').val(data.token);
                        // Datatable data
                        return data.aaData;
                    }
                },
                'columns': [{
                        data: 'mrn_id'
                    },
                    {
                        data: 'mrn_reffer'
                    },
                    {
                        data: 'mrn_purchase_order'
                    },
                    {
                        data: 'mrn_date'
                    },
                    {
                        data: 'action'
                    },

                ]

            });
        }

        $(document).ready(function() {
            initializeDataTable();
        });


        /*###*/


        /*reset reffer no*/
        $('.add_model_btn').click(function() {

            $('#add_material_form')[0].reset();
            $('.add_vendor').val('').trigger('change');
            $('#AddPurchaseOrder').modal('hide');
            $('.add_prod_remove').remove();
            $('.hidden_recived_id').val("");
            $('.once_form_submit').attr('disabled', false); // Disable this input.

            $.ajax({

                url: "<?php echo base_url(); ?>Procurement/MaterialReceivedNote/FetchReference",

                method: "GET",

                success: function(data) {

                    $('#mrn_id').val(data);

                }
            });

        });

        /*####*/


        /*customer droup drown search*/
        $(".select_vendor").select2({
            placeholder: "Select Vendor Name",
            theme: "default form-control- customer_width input_length2",
            dropdownParent: $('#AddMaterialReceived'),
            ajax: {
                url: "<?= base_url(); ?>Procurement/MaterialReceivedNote/FetchTypes",
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
                                id: item.ven_id,
                                text: item.ven_name
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
        /*###*/








        /*add selected product*/


        $("body").on('click', '.cust_more_modal', function() {
            if (!$("#add_material_form").valid()) {
                alertify.error('Fill required fields!').delay(3).dismissOthers();
                return false;
            }

            if ($('#add_material_form').attr('data-submit') == 'false') {

                $('#add_material_form').submit();

                if (!$("#add_material_form").valid()) {
                    alertify.error('Fill required fields!').delay(3).dismissOthers();
                    return false;
                }

            }

            var formData = new FormData($('#add_material_form')[0]);
            var image = $('.image_file').prop('files')[0]; // Get the file from input field
            formData.append('image', image); // Append the file to FormData object

            $.ajax({
                url: "<?php echo base_url(); ?>Procurement/MaterialReceivedNote/Add",
                method: "POST",
                data: formData,
                processData: false, // Don't process the data
                contentType: false, // Don't set content type
                success: function(data) {

                    var data = JSON.parse(data);

                    // var material_received = data.mrn_recived_id;

                    var purchase_id = data.purchase_id;

                    $('.hidden_recived_id').val(data.mrn_recived_id);

                    $('#SelectProduct').modal('show');

                    $('#AddMaterialReceived').modal('hide');


                    $.ajax({

                        url: "<?php echo base_url(); ?>Procurement/MaterialReceivedNote/FetchProduct",

                        method: "POST",

                        data: {
                            ID: purchase_id
                        },

                        success: function(data) {
                            var data = JSON.parse(data);

                            $(".select_prod_add").html(data.product_detail);

                        }

                    });


                }

            });

        });


        /*#######*/


        /*prod modal submit start*/

        $("body").on('click', '.prod_modal_submit', function() {

            var selectId = $('#select_prod_id').val();

            checked = $("input[type=checkbox]:checked").length;

            if (!checked) {
                alert("You must check at least one checkbox.");
                return false;
            }

            $.ajax({

                url: "<?php echo base_url(); ?>Procurement/MaterialReceivedNote/SelectedProduct",

                method: "POST",

                data: {
                    ID: selectId
                },

                success: function(data) {

                    var data = JSON.parse(data);

                    $('.product-more2').html(data.product_detail);

                    $('#SelectProduct').modal("hide");

                    $('#AddMaterialReceived').modal("show");

                    $('.selected_table').show();

                    checkedIds.length = 0;

                    $('#add_material_form').attr('data_fill', 'true');

                }

            });
        });


        /*prod modal submit end*/

        /*calculation section start*/

        /*$("body").on('keyup', '.add_discount, .add_prod_qty, .add_prod_rate', function(){ 

            var $discountSelect = $(this);

            var discount = parseInt($discountSelect.closest('.add_prod_row').find('.add_discount').val())||0;

            var $discountSelectElement = $discountSelect.closest('.add_prod_row').find('.add_prod_rate');

            var rate = $discountSelectElement.val();

            var $quantitySelectElement = $discountSelect.closest('.add_prod_row').find('.add_prod_qty');

            var quantity = parseInt($quantitySelectElement.val())||0;

            var parsedRate = parseFloat(rate);

            var parsedQuantity = quantity; 

            var multipliedTotal = parsedRate * parsedQuantity;

            var per_amount = (discount/100)*multipliedTotal;

            var orginalPrice = multipliedTotal - per_amount;

            var orginalPrice = orginalPrice.toFixed(2); //For showing 1000.00 instead of 1000 if no decimal present

            var $amountElement = $discountSelect.closest('.add_prod_row').find('.add_prod_amount');

            $amountElement.val(orginalPrice);

        });*/

        /*####*/



        /*add current delivery start*/

        $("body").on('keyup', '.add_current_qty', function() {


            var dataSelect = $(this);

            var deliverySelectElement = dataSelect.closest('.add_prod_row').find('.add_delivery_qty');

            var delivery = parseFloat(deliverySelectElement.val()) || 0; // Convert to number, default to 0 if NaN

            var currentSelectElement = dataSelect.closest('.add_prod_row').find('.add_current_qty');

            var current = parseFloat(currentSelectElement.val()) || 0; // Convert to number, default to 0 if NaN

            var total = delivery + current;

            var orderSelectElement = dataSelect.closest('.add_prod_row').find('.add_order_qty');

            var order = orderSelectElement.val();

            //var order = parseFloat(orderSelectElement.val()) || 0;




            if (total > order) {

                /*var currencyNull = currentSelectElement.val("");

                console.log(currencyNull);

                var $currencyNullElement = dataSelect.closest('.add_prod_row').find('.add_current_qty');

                $currencyNullElement.val(currencyNull);*/

                /**/

                currentSelectElement.val(""); // Set the value to an empty string
                var currencyNull = currentSelectElement.val(); // Get the current (now empty) value

                var $currencyNullElement = dataSelect.closest('.add_prod_row').find('.add_current_qty');
                $currencyNullElement.val(currencyNull); // Set the value of $currencyNullElement to the empty string


                /**/


                alertify.error('Delivery Qty + Current Delivery Should Not Exceed The Order Qty').delay(3).dismissOthers();

            }

        });


        /*add current delivery end*/


        /*vendor new modal start*/

        $("body").on('click', '.vendor_new_modal', function() {

            $('#AddPurchaseOrder').modal('hide');

            $('#AddVendor').modal('show');


        });

        /*vendor new modal end*/


        //trigger when form is submitted

        $("#add_office_form").submit(function(e) {

            $('#AddPurchaseOrder').modal('show');

            return false;

        });

        /*#####*/


        /*contact new modal start*/

        $("body").on('click', '.contact_new_modal', function() {

            var vendor = $('.add_vendor').val();

            if (vendor === null) {
                alertify.error('Please Select Vendor Name').delay(2).dismissOthers();
            } else {
                $('#AddNewContact').modal('show');

                $('#AddPurchaseOrder').modal('hide');

                $('.new_pro_con_vendor').val(vendor);
            }


        });


        /*contact new modal end*/


        /*fetch purchase order by vendor name*/

        $("body").on('change', '.vendor_data', function() {

            var Id = $('.vendor_data').val();

            $.ajax({

                url: "<?php echo base_url(); ?>Procurement/MaterialReceivedNote/FetchPurchase",

                method: "POST",

                data: {
                    ID: Id
                },

                success: function(data) {

                    var data = JSON.parse(data);

                    $('.select_purchase').html(data.pur_reff);


                }

            });
        });

        /*###*/


        /*fetch data by purchase order*/

        $("body").on('change', '.select_purchase', function() {

            var Id = $('.select_purchase').val();

            $.ajax({

                url: "<?php echo base_url(); ?>Procurement/MaterialReceivedNote/FetchPayment",

                method: "POST",

                data: {
                    ID: Id
                },

                success: function(data) {

                    var data = JSON.parse(data);

                    $('.add_payment_term').val(data.payment_term);

                    $('.mr_ref').val(data.mr_reff);


                }

            });
        });


        /*####*/





        /*add section end*/



    });



    /*checkbox section start*/

    var checkedIds = [];

    //checkedIds.splice(0)

    checkedIds.length = 0;


    // Check All function

    function checkAll(checkbox) {
        var checkboxes = document.getElementsByClassName('prod_checkmark');

        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = checkbox.checked;
            handleCheckboxChange(checkboxes[i]); // Update the array and modal form
        }
    }

    // Handle individual checkbox change
    function handleCheckboxChange(checkbox) {
        //checkedIds.length = 0;

        if (checkbox.checked) {
            // Add the ID to the array if checked
            checkedIds.push(checkbox.id);
        } else {
            // Remove the ID from the array if unchecked
            checkedIds = checkedIds.filter(id => id !== checkbox.id);
        }

        // Log the current state of checked IDs
        //console.log('Checked IDs: ', checkedIds);
        document.getElementById('select_prod_id').value = checkedIds.join(',');
    }


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


        $(document).ajaxSend(function(event, jqXHR, ajaxSettings) {
            if ((!isDataTableRequest(ajaxSettings)) && (!isSelect2Request(ajaxSettings)) && (!isSelect2Search(ajaxSettings))) {
                $("#overlay").fadeIn(300);
            }
        });


        $(document).ajaxComplete(function(event, jqXHR, ajaxSettings) {
            if ((!isDataTableRequest(ajaxSettings)) && (!isSelect2Request(ajaxSettings)) && (!isSelect2Search(ajaxSettings))) {
                $("#overlay").fadeOut(300);
            }
        });



        $(document).ajaxError(function() {
            if(!isSelect2Request)
            {   
                alertify.error('Something went wrong. Please try again later').delay(3).dismissOthers();
            }
        });


    });


    /*checkbox section end*/
</script>