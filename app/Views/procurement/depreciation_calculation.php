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

    .input_length {
        width: 95% !important;
    }

    .add_contact {
        position: absolute;
        right: 32px;
        top: -16px;
        font-size: 25px;
        color: #ff0000b5;
    }

    .input_length2 {
        width: 93%;
    }

    .input_length3 {
        width: 12%;
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
                        <div class="modal fade" id="AddDepreciationModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <form class="Dashboard-form class" id="AddDepreciation" data_fill="false">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Depreciation Calculation</h5>
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
                                                                        <label for="basicInput" class="form-label">Account Head</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <select class="form-select account_head_select account_head_clz" name="dpc_account_head" required></select>

                                                                    </div>

                                                                </div>

                                                            </div>


                                                            <!-- ### -->


                                                            <!-- Single Row Start -->

                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">

                                                                        <label for="basicInput" class="form-label">Date</label>

                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="dpc_acquired_date" class="form-control mr_date datepicker" required>
                                                                    </div>




                                                                </div>

                                                            </div>

                                                            <!-- ### -->





                                                            <!-- Single Row Start -->


                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basiInput" class="form-label">Current Balance</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="dpc_amount" class="form-control currentbalance " readonly required>
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

                                                                        <label for="basicInput" class="form-label">Debit Account</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <select class="form-select add_assigned_to debit_account_select" id="debit_account_select" name="dpc_debit_account" readonly required>
                                                                            <option value="" selected disabled>Debit Account</option>
                                                                            <?php
                                                                            foreach ($charts_of_account as $chart_account) {
                                                                            ?>
                                                                                <option value="<?php echo $chart_account->ca_id; ?>"><?php echo $chart_account->ca_name; ?></option>
                                                                            <?php
                                                                            }
                                                                            ?>

                                                                        </select>
                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <!-- ### -->

                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Credit Account</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <select class="form-select add_assigned_to debit_account_select" id="credit_account_select" name="dpc_credit_account" readonly required>
                                                                            <option value="" selected disabled>Credit Account</option>
                                                                            <?php
                                                                            foreach ($charts_of_account as $chart_account) {
                                                                            ?>
                                                                                <option value="<?php echo $chart_account->ca_id; ?>"><?php echo $chart_account->ca_name; ?></option>
                                                                            <?php
                                                                            }
                                                                            ?>

                                                                        </select>
                                                                    </div>

                                                                </div>

                                                            </div>
                                                            <!-- ### -->




                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Depreciation</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="dpc_depreciation" id="depriciation_input" class="form-control add_payment_term depriciation_input" value="" readonly required>
                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <!-- ### -->





                                                        </div>

                                                    </div>



                                                </div>
                                                <div class="row">

                                                    <div class="mt-4">
                                                        <table class="table table-bordered table-striped delTable selected_table" style="display: none;">
                                                            <tbody class="travelerinfo">

                                                                <tr>
                                                                    <td>Sl</td>
                                                                    <td>Description</td>
                                                                    <td>Date Acquired</td>
                                                                    <td>Amount</td>
                                                                    <td>Depreciation</td>
                                                                    <td>Entitlement</td>
                                                                    <td>Depreciation</td>
                                                                </tr>

                                                            </tbody>

                                                            <tbody class="travelerinfo product-more2 assets-body"></tbody>

                                                        </table>
                                                    </div>

                                                </div>


                                                <div style="float: right;">
                                                    <table class="table table-bordered table-striped enq_tab_submit menu">
                                                        <tbody>
                                                            <tr>
                                                                <td><button type="submit" id="save_to_jv_btn">Generate JV</button></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>



                                            </div>



                                        </div>


                                        <!-- <div class="modal-footer justify-content-center">
                                            <button class="btn btn btn-success" type="submit">Save</button>
                                        </div> -->

                                    </div>
                                </form>

                            </div>
                        </div>


                        <!--####-->


                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">View Depreciation Calculation</h4>
                                        <button type="button"   class="btn btn-primary py-1 add_model_btn">Add</button>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <table id="DataTable" class="table table-bordered table-striped delTable display dataTable">

                                            <thead>
                                                <tr>
                                                    <th class="no-sort">Sl no</th>
                                                    <th>Account head</th>
                                                    <th>Acquired Date</th>
                                                    <th>Amount</th>
                                                    <th>Depreciation</th>
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



<!--payment modal start-->


<div class="modal fade" id="paymentModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form class="Dashboard-form class" id="">
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
                                        <td>Date</td>
                                        <td>Invoice Ref</td>
                                        <td>Amount</td>
                                        <td>Adjustment</td>
                                        <td>Tick</td>
                                    </tr>


                                </thead>

                                <tbody class="travelerinfo">
                                    <tr class="" id="">

                                        <td class="">1</td>
                                        <td><input type="text" name="" value="" class="form-control" readonly></td>
                                        <td><input type="text" name="" value="" class="form-control" readonly></td>
                                        <td><input type="number" name="" value="" class="form-control" readonly></td>
                                        <td><input type="number" name="" value="" class="form-control" readonly></td>
                                        <td><input type="checkbox" name="" onclick="handleCheckboxChange(this)" class="prod_checkmark"></td>

                                    </tr>
                                </tbody>


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



<!--payment modal end-->




<!--vendor modal start-->

<?= $this->include('procurement/add_vendor') ?>

<!--vendor modal end-->




<!---view modal start--->

<div class="modal fade" id="ViewModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form class="Dashboard-form class" id="">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Deperication Calculation</h5>
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
                                                <label for="basicInput" class="form-label">Account Head</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <select class="form-select account_head_select account_head_clz view_acc_head" name="dpc_account_head" required></select>

                                            </div>

                                        </div>

                                    </div>


                                    <!-- ### -->


                                    <!-- Single Row Start -->

                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2">

                                            <div class="col-col-md-3 col-lg-3">

                                                <label for="basicInput" class="form-label">Date</label>

                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="text" name="dpc_acquired_date" class="form-control view_acq_date " required>
                                            </div>




                                        </div>

                                    </div>

                                    <!-- ### -->





                                    <!-- Single Row Start -->


                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basiInput" class="form-label">Current Balance</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="text" name="dpc_amount" class="form-control view_currentbalance " readonly required>
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

                                                <label for="basicInput" class="form-label">Debit Account</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <select class="form-select add_assigned_to debit_account_select view_debit_account_select" name="dpc_debit_account" readonly required>
                                                    <option value="" selected disabled>Debit Account</option>
                                                    <?php
                                                    foreach ($charts_of_account as $chart_account) {
                                                    ?>
                                                        <option value="<?php echo $chart_account->ca_id; ?>"><?php echo $chart_account->ca_name; ?></option>
                                                    <?php
                                                    }
                                                    ?>

                                                </select>
                                            </div>

                                        </div>

                                    </div>

                                    <!-- ### -->

                                    <!-- Single Row Start -->
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Credit Account</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <select class="form-select add_assigned_to debit_account_select view_credit_account_select" name="dpc_credit_account" readonly required>
                                                    <option value="" selected disabled>Credit Account</option>
                                                    <?php
                                                    foreach ($charts_of_account as $chart_account) {
                                                    ?>
                                                        <option value="<?php echo $chart_account->ca_id; ?>"><?php echo $chart_account->ca_name; ?></option>
                                                    <?php
                                                    }
                                                    ?>

                                                </select>
                                            </div>

                                        </div>

                                    </div>
                                    <!-- ### -->




                                    <!-- Single Row Start -->
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Depreciation</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="text" name="dpc_depreciation" class="form-control add_payment_term view_depriciation_input" value="" readonly required>
                                            </div>

                                        </div>

                                    </div>

                                    <!-- ### -->

                                </div>

                            </div>

                        </div>
                        <div class="row">

                            <div class="mt-4">
                                <table class="table table-bordered table-striped delTable view_selected_table" style="display: none;">
                                    <tbody class="travelerinfo">

                                        <tr>
                                            <td>Sl</td>
                                            <td>Description</td>
                                            <td>Date Acquired</td>
                                            <td>Amount</td>
                                            <td>Depreciation</td>
                                            <td>Entitlement</td>
                                            <td>Depreciation</td>
                                        </tr>

                                    </tbody>

                                    <tbody class="travelerinfo product-more2 view-assets-body"></tbody>

                                </table>
                            </div>

                        </div>





                    </div>

                </div>



            </div>
        </form>

    </div>
</div>

<!--view modal end-->

<!--edit section start-->

<div class="modal fade" id="EditModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form class="Dashboard-form class" id="edit_modal_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Depreciation Calculation</h5>
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
                                                <label for="basicInput" class="form-label">Account Head</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <select class="form-select account_head_clz edit_acc_head" name="dpc_account_head" required></select>

                                            </div>

                                        </div>

                                    </div>


                                    <!-- ### -->


                                    <!-- Single Row Start -->

                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2">

                                            <div class="col-col-md-3 col-lg-3">

                                                <label for="basicInput" class="form-label">Date</label>

                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="text" name="dpc_acquired_date" class="form-control edit_acq_date datepicker" required>
                                            </div>




                                        </div>

                                    </div>

                                    <!-- ### -->





                                    <!-- Single Row Start -->


                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basiInput" class="form-label">Current Balance</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="text" name="dpc_amount" class="form-control edit_currentbalance " readonly>
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

                                                <label for="basicInput" class="form-label">Debit Account</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <select class="form-select add_assigned_to debit_account_select2 edit_debit_account_select" name="dpc_debit_account" readonly required>
                                                    <option value="" selected disabled>Debit Account</option>
                                                    <?php
                                                    foreach ($charts_of_account as $chart_account) {
                                                    ?>
                                                        <option value="<?php echo $chart_account->ca_id; ?>"><?php echo $chart_account->ca_name; ?></option>
                                                    <?php
                                                    }
                                                    ?>

                                                </select>
                                            </div>

                                        </div>

                                    </div>

                                    <!-- ### -->

                                    <!-- Single Row Start -->
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Credit Account</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <select class="form-select add_assigned_to debit_account_select2 edit_credit_account_select" name="dpc_credit_account" readonly required>
                                                    <option value="" selected disabled>Credit Account</option>
                                                    <?php
                                                    foreach ($charts_of_account as $chart_account) {
                                                    ?>
                                                        <option value="<?php echo $chart_account->ca_id; ?>"><?php echo $chart_account->ca_name; ?></option>
                                                    <?php
                                                    }
                                                    ?>

                                                </select>
                                            </div>

                                        </div>

                                    </div>
                                    <!-- ### -->




                                    <!-- Single Row Start -->
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Depreciation</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="text" name="dpc_depreciation" class="form-control add_payment_term edit_depriciation_input" value="" readonly required>
                                            </div>

                                        </div>

                                    </div>

                                    <!-- ### -->

                                </div>

                            </div>

                        </div>
                        <div class="row">

                            <div class="mt-4">
                                <table class="table table-bordered table-striped delTable edit_selected_table" style="display: none;">
                                    <tbody class="travelerinfo">

                                        <tr>
                                            <td>Sl</td>
                                            <td>Description</td>
                                            <td>Date Acquired</td>
                                            <td>Amount</td>
                                            <td>Depreciation</td>
                                            <td>Entitlement</td>
                                            <td>Depreciation</td>
                                        </tr>

                                    </tbody>

                                    <tbody class="travelerinfo product-more2 edit-assets-body"></tbody>

                                </table>
                            </div>

                        </div>





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

<!-- Journal Voucher Modal Start -->


<!-- Add Modal -->


<div class="modal fade" id="AddToJournalModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form class="Dashboard-form class" id="add_journal_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Generate Journal Voucher</h5>
                    <button type="button" class="btn-close" data-bs-toggle="modal" data-bs-target="#AddModal" aria-label="Close"></button>
                </div>
                <div class="modal-body">


                    <div class="row">


                        <div class="col-lg-12">
                            <div class="card">

                                <div class="card-body">
                                    <div class="live-preview">

                                        <div class="row align-items-start justify-content-start">

                                            <div class="col-lg-6">

                                                <div class="row align-items-center mb-2">


                                                    <div class="col-col-md-3 col-lg-3">

                                                        <label for="basiInput" class="form-label">Reference</label>

                                                    </div>


                                                    <div class="col-col-md-9 col-lg-9">

                                                        <input type="text" id="uid" class="form-control" >

                                                    </div>

                                                </div>


                                                <div class="row align-items-center mb-2">

                                                    <div class="col-col-md-3 col-lg-3">

                                                        <label for="basiInput" class="form-label">Date</label>

                                                    </div>

                                                    <div class="col-col-md-9 col-lg-9">

                                                        <input type="text" name="jv_date" class="form-control datepicker_ap" value="<?= date('d M Y') ?>" required>

                                                    </div>

                                                </div>


                                            </div>


                                            <div class="col-col-md-12 col-lg-12">


                                                <table class="table table-bordered" style="overflow-y:scroll;">

                                                    <thead>
                                                        <tr>
                                                            <th>Sl No</th>
                                                            <th>Account</th>
                                                            <th>Narration</th>
                                                            <th>Debit</th>
                                                            <th>Credit</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody id="jv_rows">

                                                    </tbody>





                                                </table>


                                            </div>


                                            <div class="row">


                                                <div class="col-lg-12 text-center">


                                                    <div style="">
                                                        <table class="table table-bordered table-striped enq_tab_submit menu">

                                                            <!--
            <tr>
                <td><button class="submit_btn">Print</button></td>
                <td><button class="submit_btn">Email</button></td>
            </tr>
            -->
                                                            <tr>

                                                                <button class="btn btn-success submit_btn" name="" type="submit">Save</button>
                                                                <!--<td><button class="submit_btn">PDF</button></td>-->
                                                            </tr>
                                                        </table>
                                                    </div>


                                                </div>


                                            </div>




                                        </div>
                                        <!--end row-->

                                    </div>

                                </div>



                            </div>
                        </div>

                        <!--end col-->
                    </div>

                </div>
                <!-- <div class="modal-footer justify-content-center">
                <button  class="btn btn btn-success">Save</button>
            </div> -->

            </div>
        </form>

    </div>
</div>



<!-- Journal Voucher End -->



<script>
    document.addEventListener("DOMContentLoaded", function(event) {

        /* Add section start */
        $(function() {
            var form = $('#AddDepreciation');
            var insertedId = null; // To store the ID of the inserted record
            var isSecondModalSuccess = false; // Flag to determine if second modal was successful

            form.validate({
                rules: {
                    dpc_account_head: 'required',
                    dpc_acquired_date: 'required',
                    dpc_amount: 'required',
                    dpc_debit_account: 'required',
                    dpc_credit_account: 'required',
                    dpc_depreciation: 'required',
                },
                messages: {
                    dpc_account_head: 'This field is required',
                    dpc_acquired_date: 'This field is required',
                    dpc_amount: 'This field is required',
                    dpc_debit_account: 'This field is required',
                    dpc_credit_account: 'This field is required',
                    dpc_depreciation: 'This field is required',
                },
                submitHandler: function(currentForm) {
                    var formData = new FormData(currentForm);
                    var creditAccount = $('#credit_account_select').val();
                    var debitAccount = $('#debit_account_select').val();
                    var depreciation = $('#total_amount').text();

                    $.ajax({
                        url: "<?php echo base_url(); ?>Procurement/DepreciationCalculation/Add",
                        method: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response.status === 'success') {
                                insertedId = response.id; // Store the inserted record ID
                                datatable.ajax.reload(null, false);
                                $('#AddDepreciationModal').modal('hide');
                                alertify.success('Data Added Successfully');

                                // Fetch additional data for the second modal
                                $.ajax({
                                    url: "<?php echo base_url(); ?>Accounts/JournalVouchers/FetchReference",
                                    method: "GET",
                                    success: function(response) {
                                        $('#uid').val(response);
                                    },
                                });

                                $.ajax({
                                    url: "<?php echo base_url(); ?>Procurement/DepreciationCalculation/AddToJvRows",
                                    method: "POST",
                                    data: {
                                        cfs_credit_account: creditAccount,
                                        cfs_debit_account: debitAccount,
                                        depreciation: depreciation,
                                        ID: insertedId,
                                    },
                                    success: function(response) {
                                        $('#AddToJournalModal').modal('show');

                                        if (response) {
                                            var data = JSON.parse(response);
                                            $('#jv_rows').html(data.jv_rows);
                                            $('#total_amount_debit').val(data.total_debit);
                                            $('#total_amount_credit').val(data.total_credit);
                                        }
                                    },
                                });
                            }
                        },
                        error: function() {
                            alertify.error('Error saving data');
                        },
                    });

                    return false;
                },
            });

            // Handle the second modal form submission
            $('#add_journal_form').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    url: "<?php echo base_url(); ?>Procurement/DepreciationCalculation/AddJournalVoucher",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(data) {
                        var response = JSON.parse(data);

                        if (response.status == 1) {
                            alertify.success(response.msg).delay(3).dismissOthers();

                            isSecondModalSuccess = true; // Mark as successful
                            datatable.ajax.reload(null, false);

                            // Close all modals
                            $('#AddToJournalModal').modal('hide');
                            $('#AddDepreciationModal').modal('hide');
                        }
                    },
                    error: function() {
                        alertify.error('Error submitting journal voucher.');
                    },
                });
            });

            // Handle second modal close
            $('#AddToJournalModal').on('hidden.bs.modal', function() {
                if (!isSecondModalSuccess && insertedId !== null) {
                    // Reopen the first modal if the second modal submission was not successful
                    $('#AddDepreciationModal').modal('show');

                    // Trigger delete operation for the inserted record
                    $.ajax({
                        url: "<?php echo base_url(); ?>Procurement/DepreciationCalculation/Delete",
                        method: "POST",
                        data: {
                            ID: insertedId
                        },
                        success: function(response) {
                            datatable.ajax.reload(null, false);
                            alertify.error('Record deleted due to incomplete operation.');
                            insertedId = null; // Reset the stored ID
                        },
                        error: function() {
                            alertify.error('Error deleting the record.');
                        },
                    });
                }

                // Reset success flag
                isSecondModalSuccess = false;
            });
        });
        /* ##### */



        /* account head  search droup drown start*/

        $(".account_head_select").select2({
            placeholder: "Select Account Name",
            theme: "default form-control-",
            dropdownParent: $('#AddDepreciationModal'),
            ajax: {
                url: "<?= base_url(); ?>Procurement/DepreciationCalculation/FetchTypes",
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
                            // THE `10` SHOULD BE SAME AS `$resultCount FROM PHP, it is the number of records to fetch from table` 
                            more: (page * 10) <= data.total_count
                        }
                    };
                },
            }
        })

        $(".edit_acc_head").select2({
            placeholder: "Select Account Name",
            theme: "default form-control-",
            dropdownParent: $('#EditModal'),
            ajax: {
                url: "<?= base_url(); ?>Procurement/DepreciationCalculation/FetchTypes",
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
                            // THE `10` SHOULD BE SAME AS `$resultCount FROM PHP, it is the number of records to fetch from table` 
                            more: (page * 10) <= data.total_count
                        }
                    };
                },
            }
        })

        // Initialize Select2 for the .view_acc_head select field
        $(".view_acc_head").select2({
            placeholder: "Select Account Name",
            theme: "default form-control-",
            dropdownParent: $('#ViewModal'),
            ajax: {
                url: "<?= base_url(); ?>Procurement/DepreciationCalculation/FetchTypes",
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
                            };
                        }),
                        pagination: {
                            more: (page * 10) <= data.total_count // Handle pagination if needed
                        }
                    };
                },
            }
        });



        /*###*/
        $(".debit_account_select").select2({
            placeholder: "Select Account Name",
            theme: "default form-control-",
            dropdownParent: $('#AddDepreciationModal'),
            ajax: {
                url: "<?= base_url(); ?>Procurement/DepreciationCalculation/FetchDebitAcc",
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
                            // THE `10` SHOULD BE SAME AS `$resultCount FROM PHP, it is the number of records to fetch from table` 
                            more: (page * 10) <= data.total_count
                        }
                    };
                },
            }
        })

        $(".debit_account_select2").select2({
            placeholder: "Select Account Name",
            theme: "default form-control-",
            dropdownParent: $('#EditModal'),
            ajax: {
                url: "<?= base_url(); ?>Procurement/DepreciationCalculation/FetchDebitAcc",
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
                            // THE `10` SHOULD BE SAME AS `$resultCount FROM PHP, it is the number of records to fetch from table` 
                            more: (page * 10) <= data.total_count
                        }
                    };
                },
            }
        })




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


        // Function to trigger AJAX if both date and account head are valid
        // Trigger function when either date or account head changes
        function triggerDepreciationCalculation() {
            var date = $('.mr_date').val() || new Date().toISOString().slice(0, 10);
            // Get the selected date
            var accountHead = $('.account_head_select').val(); // Get the selected account head

            // Check if both fields have values
            if (accountHead) {
                $.ajax({
                    url: "<?php echo base_url(); ?>Procurement/DepreciationCalculation/Date",
                    method: "POST",
                    data: {
                        AccountHead: accountHead,
                        Date: date
                    },
                    success: function(data) {
                        var parsedData = JSON.parse(data);

                        $('.depriciation_input').val('');



                        // Update fields based on the response
                        if (parsedData.fixedasset) {
                            // Do something with parsedData.fixedasset, if needed
                            var fixedasset = parsedData.fixedasset;

                            $('#debit_account_select').val(fixedasset.cfs_debit_account).trigger('change');
                            $('#credit_account_select').val(fixedasset.cfs_credit_account).trigger('change');


                            if (fixedasset.cfs_depreciation) {
                                $('.depriciation_input').val(fixedasset.cfs_depreciation);
                            } else {
                                $('.depriciation_input').val('');
                            }

                        }
                        if (parsedData.hasOwnProperty('acchead_balance')) {
                            // Do something with the account head balance, even if it's 0
                            // alert(parsedData.acchead_balance);
                            $('.currentbalance').val(parsedData.acchead_balance);
                        }


                        if (parsedData.fixed_asset && parsedData.fixed_asset != '') {
                            // Display the table by selecting the correct class for the table
                            $('.selected_table').css('display', 'block');

                            // Populate the table's body with the data received from `fixed_asset`
                            $('.assets-body').html(parsedData.fixed_asset);
                        }




                    }
                });
            }
        }

        // Bind event handlers

        $('.mr_date').on('change', triggerDepreciationCalculation);

        $('.account_head_select').on('change', triggerDepreciationCalculation);






        /*Time Frame section end*/



        /*material recived not section start*/


        /*$("body").on('change', '.material_received_note', function(){ 
	        
            var date = $(this).val();
 
 
            $.ajax({
 
                url : "<?php echo base_url(); ?>Procurement/PurchaseVoucher/FetchPurchase",
 
                method : "POST",
 
                data: {Date: date},
 
                success:function(data)
                {   
                    var data = JSON.parse(data);
                 
                    $('.time_frame_date').val(data.increment_date_date)
                 
                     
                }
 
 
            });
 
 
        });*/


        /*material receivec not section end*/


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






        /*data table start*/

        function initializeDataTable() {

            datatable = $('#DataTable').DataTable({
                'stateSave': true,
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url': "<?php echo base_url(); ?>Procurement/DepreciationCalculation/FetchData",
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
                        data: 'dpc_id'
                    },
                    {
                        data: 'dpc_account_head'
                    },
                    {
                        data: 'dpc_acquired_date'
                    },
                    {
                        data: 'dpc_amount'
                    },
                    {
                        data: 'dpc_depreciation'
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

            // Reset the form
            $('#AddDepreciation')[0].reset();

            // Clear select fields
            $('#AddDepreciation select').val('').trigger('change'); // Reset selects

            // Clear dynamically populated fields (e.g., from server-side response)
            $('#AddDepreciation').find('input[type="text"], textarea').val(''); // Clear text inputs and textareas
            $('#AddDepreciation').find('input[type="number"]').val(''); // Clear number inputs
            $('#AddDepreciation').find('.fixed_asset').html(''); // Assuming fixed_asset is dynamically loaded HTML

            $.ajax({

                url : "<?php echo base_url(); ?>Procurement/DepreciationCalculation/AddAccess",

                method : "POST",

                success:function(data)
                {

                    var data = JSON.parse(data);

                    if(data.status === 0){
                    
                        alertify.error(data.msg).delay(3).dismissOthers();

                    }
                    else{

                        $('#AddDepreciationModal').modal('show');

                    }
                    

                }

            })


            // $.ajax({

            //     url: "<?php echo base_url(); ?>Procurement/PurchaseReturn/FetchReference",

            //     method: "GET",

            //     success: function(data) {

            //         $('#pr_id').val(data);

            //     }
            // });

        });

        /*####*/


        /*customer droup drown search*/
        $(".select_vendor").select2({
            placeholder: "Select Vendor Name",
            theme: "default form-control- customer_width input_length3",
            dropdownParent: $('#AddPurchaseReturn'),
            ajax: {
                url: "<?= base_url(); ?>Procurement/PurchaseReturn/FetchTypes",
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


        /*$("body").on('click', '.cust_more_modal', function()
        { 
            if(!$("#purchase_form").valid())
            {
                alertify.error('Fill required fields!').delay(3).dismissOthers();
                return false;
            }

            if($('#purchase_form').attr('data-submit')=='false')
            {

             $('#purchase_form').submit();

                if(!$("#purchase_form").valid())
                {
                alertify.error('Fill required fields!').delay(3).dismissOthers();
                return false;
                }

            }

            var formData = new FormData($('#purchase_form')[0]);
            var image = $('.image_file').prop('files')[0]; // Get the file from input field
            formData.append('pr_file', image); // Append the file to FormData object

           

            $.ajax({
                        url: "<?php echo base_url(); ?>Procurement/PurchaseReturn/Add",
                        method: "POST",
                        data: formData,
                        processData: false, // Don't process the data
                        contentType: false, // Don't set content type
                        success: function(data) {

                            var data = JSON.parse(data);

                            var purchase_voucher_id = data.purchase_voucher_id;

                            $('.hidden_purchase_voucher_id').val(purchase_voucher_id);

                            var purchase_id = data.purchase_order;

                            $('#AddPurchaseVoucher').modal('hide');

                            $('#SelectProduct').modal('show');

                           
                            $.ajax({

                                url : "<?php echo base_url(); ?>Procurement/PurchaseVoucher/FetchProduct",

                                method : "POST",

                                data: {ID: purchase_id},
                                
                                success:function(data)
                                {   
                                    var data = JSON.parse(data);

                                    $(".select_prod_add").html(data.product_detail);
                         
                                }  

                            });
 
                            
                        }

                    });

        });*/


        /*#######*/


        /*prod modal submit start*/

        $("body").on('click', '.prod_modal_submit', function() {

            var selectId = $('#select_prod_id').val();

            $.ajax({

                url: "<?php echo base_url(); ?>Procurement/PurchaseReturn/SelectedProduct",

                method: "POST",

                data: {
                    ID: selectId
                },

                success: function(data) {

                    var data = JSON.parse(data);

                    $('.product-more2').html(data.product_detail);

                    $('#SelectProduct').modal("hide");

                    $('#AddPurchaseReturn').modal("show");

                    $('.selected_table').show();

                    checkedIds.length = 0;

                    $('#purchase_form').attr('data_fill', 'true');

                }

            });
        });


        /*prod modal submit end*/

        /*calculation section start*/

        $("body").on('keyup', '.add_discount', function() {

            var $discountSelect = $(this);

            var discount = parseInt($discountSelect.closest('.add_prod_row').find('.add_discount').val()) || 0;

            var $discountSelectElement = $discountSelect.closest('.add_prod_row').find('.add_prod_rate');

            var rate = $discountSelectElement.val();

            var $quantitySelectElement = $discountSelect.closest('.add_prod_row').find('.add_prod_qty');

            var quantity = parseInt($quantitySelectElement.val()) || 0;

            var parsedRate = parseFloat(rate);

            var parsedQuantity = quantity;

            var multipliedTotal = parsedRate * parsedQuantity;

            var per_amount = (discount / 100) * multipliedTotal;

            var orginalPrice = multipliedTotal - per_amount;

            var orginalPrice = orginalPrice.toFixed(2); //For showing 1000.00 instead of 1000 if no decimal present

            var $amountElement = $discountSelect.closest('.add_prod_row').find('.add_prod_amount');

            $amountElement.val(orginalPrice);

        });

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

                url: "<?php echo base_url(); ?>Procurement/PurchaseReturn/VendorInv",

                method: "POST",

                data: {
                    ID: Id
                },

                success: function(data) {

                    var data = JSON.parse(data);

                    console.log(data.vendor_inv)

                    $('.vendor_inv_ref').html(data.vendor_inv);

                }

            });
        });

        /*###*/



        /*fetch data by vendor inv */

        $("body").on('change', '.vendor_inv_ref', function() {

            var id = $('.vendor_inv_ref').val();



            $.ajax({

                url: "<?php echo base_url(); ?>Procurement/PurchaseReturn/FetchContact",

                method: "POST",

                data: {
                    ID: id
                },

                success: function(data) {

                    var data = JSON.parse(data);

                    $('.add_contact_person').val(data.contact_person);

                    $('.add_payment_term').val(data.payment_term);

                }

            });
        });

        /*###*/



        /*add product start*/

        $("body").on('click', '.add_more_icon', function() {
            if (!$("#purchase_form").valid()) {
                alertify.error('Fill required fields!').delay(3).dismissOthers();
                return false;
            }

            if ($('#purchase_form').attr('data-submit') == 'false') {

                $('#purchase_form').submit();

                if (!$("#purchase_form").valid()) {
                    alertify.error('Fill required fields!').delay(3).dismissOthers();
                    return false;
                }

            }

            var formData = new FormData($('#purchase_form')[0]);
            var image = $('.image_file').prop('files')[0]; // Get the file from input field
            formData.append('image', image); // Append the file to FormData object

            $.ajax({
                url: "<?php echo base_url(); ?>Procurement/PurchaseReturn/Add",
                method: "POST",
                data: formData,
                processData: false, // Don't process the data
                contentType: false, // Don't set content type
                success: function(data) {

                    var data = JSON.parse(data);

                    var purchase_return_id = data.purchase_return_id;

                    $('.hidden_purchase_return_id').val(purchase_return_id);

                    var vendor_inv_ref = data.vendor_inv_ref;

                    $('#AddPurchaseReturn').modal('hide');

                    $('#SelectProduct').modal('show');


                    $.ajax({

                        url: "<?php echo base_url(); ?>Procurement/PurchaseReturn/FetchProduct",

                        method: "POST",

                        data: {
                            ID: vendor_inv_ref
                        },

                        success: function(data) {
                            var data = JSON.parse(data);

                            $(".select_prod_add").html(data.product_detail);

                        }

                    });


                }

            });

        });


        /*#####*/






        /*add section end*/




        /*view section start*/

        $("body").on('click', '.view_btn', function() {
            var id = $(this).data('id');

            // Fetch the view data
            $.ajax({
                url: "<?php echo base_url(); ?>Procurement/DepreciationCalculation/View",
                method: "POST",
                data: {
                    ID: id
                },
                success: function(response) {
                    var data = JSON.parse(response);

                    // Fetch the options for Select2 before trying to set the value
                    $.ajax({
                        url: "<?= base_url(); ?>Procurement/DepreciationCalculation/FetchTypes",
                        method: "GET",
                        dataType: 'json',
                        success: function(fetchResponse) {
                            // Clear and append new options
                            var select = $('.view_acc_head');
                            select.empty(); // Clear existing options

                            // Populate select options
                            $.each(fetchResponse.result, function(index, item) {
                                var option = new Option(item.ah_account_name, item.ah_id, false, false);
                                select.append(option);
                            });

                            // Set the selected option
                            if (data.account_head) {
                                select.val(data.account_head).trigger('change'); // Set the value and trigger Select2 update
                            }

                            // Disable the Select2 dropdown
                            select.prop('disabled', true).trigger('change'); // Disable it

                            // Set other form fields
                            $('.view_acq_date').val(data.acquired_date);
                            $('.view_currentbalance').val(data.balance_amt);
                            $('.view_debit_account_select').val(data.debit_account).trigger('change');
                            $('.view_credit_account_select').val(data.credit_account).trigger('change');
                            $('.view_depriciation_input').val(data.depreciation);

                            if (data.depreciation_det != '') {
                                $('.view-assets-body').html(data.depreciation_det)
                                $('.view_selected_table').css('display', 'block');

                            }
                            // Show the modal
                            $('#ViewModal').modal("show");
                        }
                    });
                }
            });
        });



        $("body").on('click', '.edit_btn', function() {

            var id = $(this).data('id');

            $.ajax({

                url: "<?php echo base_url(); ?>Procurement/DepreciationCalculation/Edit",

                method: "POST",

                data: {
                    ID: id
                },

                success: function(response) {
                    var data = JSON.parse(response);

                    if(data.status === 0){

                        alertify.error(data.msg).delay(3).dismissOthers();
                    }
                    else{

                        // Fetch the options for Select2 before trying to set the value
                        $.ajax({
                            url: "<?= base_url(); ?>Procurement/DepreciationCalculation/FetchTypes",
                            method: "GET",
                            dataType: 'json',
                            success: function(fetchResponse) {
                                // Clear and append new options
                                var select = $('.edit_acc_head');
                                select.empty(); // Clear existing options

                                // Populate select options
                                $.each(fetchResponse.result, function(index, item) {
                                    var option = new Option(item.ah_account_name, item.ah_id, false, false);
                                    select.append(option);
                                });

                                // Set the selected option
                                if (data.account_head) {
                                    select.val(data.account_head).trigger('change'); // Set the value and trigger Select2 update
                                }

                                // Disable the Select2 dropdown
                                // select.prop('disabled', true).trigger('change'); // Disable it

                                // Set other form fields
                                $('.edit_acq_date').val(data.acquired_date);
                                $('.edit_currentbalance').val(data.balance_amt);
                                $('.edit_debit_account_select').val(data.debit_account).trigger('change');
                                $('.edit_credit_account_select').val(data.credit_account).trigger('change');
                                $('.edit_depriciation_input').val(data.depreciation);

                                $('.edit_debit_account_select').prop('disabled', true).trigger('change');
                                $('.edit_credit_account_select').prop('disabled', true).trigger('change');

                                if (data.depreciation_det != '') {
                                    $('.edit-assets-body').html(data.depreciation_det)
                                    $('.edit_selected_table').css('display', 'block');

                                }
                                // Show the modal
                                $('#EditModal').modal("show");
                            }
                        });
                    }

                }

            });

        });




        /*view section end*/


        $("body").on('click', '.delete_btn', function() {

            var id = $(this).data('id');

            var rowToDelete = $(this).closest('tr');

            $.ajax({

                url: "<?php echo base_url(); ?>Procurement/DepreciationCalculation/Delete",

                method: "POST",

                data: {
                    ID: id
                },

                success: function(data) {

                    var data = JSON.parse(data);

                    if(data.status === 1){

                        rowToDelete.fadeOut(500, function() {

                            $(this).remove();

                            alertify.error(data.msg).delay(3).dismissOthers();

                            datatable.ajax.reload(null, false);

                        });


                    }else{

                        alertify.error(data.msg).delay(2).dismissOthers();
                    }

                    

                }

            });

        });


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


    /*checkbox section end*/
</script>