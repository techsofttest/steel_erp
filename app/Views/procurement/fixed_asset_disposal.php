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
                        <div class="modal fade" id="AddFixedAssetDisposal" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <form class="Dashboard-form class" id="AddAssetDisposal" data_fill="false">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Fixed Asset Displosal</h5>
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
                                                                        <select class="form-select account_head_select add_account_head_select account_head_clz" name="dfs_account_head" required></select>

                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <!-- ### -->


                                                            <!-- Single Row Start -->

                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">


                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Fixed Asset</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <select class="form-select fixed_asset_select" name="dfs_fixed_asset" required></select>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <!-- ### -->


                                                            <!-- Single Row Start -->

                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">

                                                                        <label for="basicInput" class="form-label"> Date</label>

                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="dfs_date_dispose" class="form-control mr_date datepicker" required>
                                                                    </div>




                                                                </div>

                                                            </div>

                                                            <!-- ### -->



                                                        </div>

                                                    </div>


                                                    <div class="col-lg-6">

                                                        <div class="row">


                                                            <!-- ### -->

                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Credit Account</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <select class="form-select asset_credit_acc debit_account_select" name="dfs_credit_account" required>
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
                                                                        <label for="basicInput" class="form-label">Current Balance</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="dfs_asset_balance" class="form-control add_current_balance" value="" required>
                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <!-- ### -->


                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">GI Account</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <select class="form-select add_assigned_to debit_account_select" name="dfs_debit_account" required>
                                                                            <option value="" selected disabled>GI Account</option>
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
                                                                    <td>Sales Price</td>
                                                                    <td>Profit/Loss</td>
                                                                </tr>

                                                            </tbody>

                                                            <tbody class="travelerinfo product-more2 view-assets-body"></tbody>

                                                        </table>
                                                    </div>

                                                </div>

                                                <div style="float: right;">
                                                <table class="table table-bordered table-striped enq_tab_submit menu">
                                                    <tbody><tr>
                                                        <td><button type="submit">Generate JV</button></td>                                                     
                                                    </tr>
                                                </tbody></table>
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
                                        <h4 class="card-title mb-0 flex-grow-1">View Fixed Asset Disposal</h4>
                                        <button type="button"  class="btn btn-primary py-1 add_model_btn">Add</button>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <table id="DataTable" class="table table-bordered table-striped delTable display dataTable">

                                            <thead>
                                                <tr>
                                                    <th class="no-sort">Sl no</th>
                                                    <th>Description</th>
                                                    <th>Account Head</th>
                                                    <th>Date of Dispose</th>
                                                    <th>Sale Price</th>
                                                    <th>Profit/Lose</th>
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
<?= $this->include('procurement/edit_vendor') ?>

<!--vendor modal end-->



<!---view modal start--->

<div class="modal fade" id="ViewModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form class="Dashboard-form class" id="">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Fixed Asset Disposal</h5>
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
                                                <select class="form-select  view_account_head_select account_head_clz" name="dfs_account_head" required></select>

                                            </div>
                                        </div>

                                    </div>

                                    <!-- ### -->


                                    <!-- Single Row Start -->

                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2">


                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Fixed Asset</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <select class="form-select fixed_asset_select view_fixed_asset_select" name="dfs_fixed_asset" required></select>

                                            </div>

                                        </div>

                                    </div>

                                    <!-- ### -->


                                    <!-- Single Row Start -->

                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2">

                                            <div class="col-col-md-3 col-lg-3">

                                                <label for="basicInput" class="form-label"> Date</label>

                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="text" name="dfs_date_dispose" class="form-control mr_date  view_dispose_date" readonly required>
                                            </div>




                                        </div>

                                    </div>

                                    <!-- ### -->



                                </div>

                            </div>


                            <div class="col-lg-6">

                                <div class="row">


                                    <!-- ### -->

                                    <!-- Single Row Start -->
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Credit Account</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <select class="form-select view_credit_acc debit_account_select" name="dfs_credit_account" required>
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
                                                <label for="basicInput" class="form-label">Current Balance</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="text" name="dfs_asset_balance" class="form-control view_current_balance" value="" readonly required>
                                            </div>

                                        </div>

                                    </div>

                                    <!-- ### -->


                                    <!-- Single Row Start -->
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">GI Account</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <select class="form-select add_assigned_to debit_account_select view_gi_account" name="dfs_debit_account" required>
                                                    <option value="" selected disabled>GI Account</option>
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

                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="mt-4">
                                <table class="table table-bordered table-striped delTable view-dispose-table">
                                    <tbody class="travelerinfo">

                                        <tr>
                                            <td>Sl</td>
                                            <td>Description</td>
                                            <td>Date Acquired</td>
                                            <td>Amount</td>
                                            <td>Depreciation</td>
                                            <td>Sales Price</td>
                                            <td>Profit/Loss</td>
                                        </tr>

                                    </tbody>

                                    <tbody class="travelerinfo product-more2 view-dispose-body">

                                        <tr>
                                            <td> 1 </td>
                                            <td><input type="text" name="dfs_description" class="form-control view_description" readonly></td>
                                            <td><input type="text" name="dfs_acquired_date" class="form-control view_acquired_date" readonly></td>
                                            <td><input type="text" name="dfs_asset_amount" class="form-control view_asset_amt" readonly></td>
                                            <td><input type="text" name="dfs_depreciation" class="form-control view_depreciation" readonly></td>
                                            <td><input type="number" name="dfs_sales_price" value="" class="form-control view_sale_price" readonly></td>
                                            <td><input type="text" name="dfs_profit" value="" class="form-control view_profit" readonly></td>
                                        </tr>

                                        <tr>
                                            <td colspan="1"></td>
                                            <td colspan="2" align="left" class="amount_in_words_add"></td>
                                            <td align="right" colspan="3">Total</td>
                                            <input type="hidden" id="view_total_amount_val" val="">
                                            <th id="view_total_amount"></th>
                                        </tr>


                                    </tbody>

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
                    <h5 class="modal-title" id="exampleModalLabel">Fixed Asset Disposal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    <input type="hidden" name="dfs_id" id="" class="form-control edit_id">

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
                                                <select class="form-select  edit_account_head_select account_head_select account_head_clz" name="dfs_account_head" required></select>

                                            </div>
                                        </div>

                                    </div>

                                    <!-- ### -->


                                    <!-- Single Row Start -->

                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Fixed Asset</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <select class="form-select fixed_asset_select edit_fixed_asset_select" name="dfs_fixed_asset" required></select>

                                            </div>

                                        </div>

                                    </div>

                                    <!-- ### -->


                                    <!-- Single Row Start -->

                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2">

                                            <div class="col-col-md-3 col-lg-3">

                                                <label for="basicInput" class="form-label"> Date</label>

                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="text" name="dfs_date_dispose" class="form-control mr_date  edit_dispose_date" readonly required>
                                            </div>




                                        </div>

                                    </div>

                                    <!-- ### -->



                                </div>

                            </div>


                            <div class="col-lg-6">

                                <div class="row">


                                    <!-- ### -->

                                    <!-- Single Row Start -->
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Credit Account</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <select class="form-select edit_credit_acc asset_credit_acc edit_debit_account_select" name="dfs_credit_account" required>
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
                                                <label for="basicInput" class="form-label">Current Balance</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="text" name="dfs_asset_balance" class="form-control edit_current_balance add_current_balance" value="" readonly required>
                                            </div>

                                        </div>

                                    </div>

                                    <!-- ### -->


                                    <!-- Single Row Start -->
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">GI Account</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <select class="form-select  edit_debit_account_select  edit_gi_account add_assigned_to debit_account_select" name="dfs_debit_account" required>
                                                    <option value="" selected disabled>GI Account</option>
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

                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="mt-4">
                                <table class="table table-bordered table-striped delTable edit-dispose-table view_selected_table" style="display:none">
                                    <tbody class="travelerinfo">

                                        <tr>
                                            <td>Sl</td>
                                            <td>Description</td>
                                            <td>Date Acquired</td>
                                            <td>Amount</td>
                                            <td>Depreciation</td>
                                            <td>Sales Price</td>
                                            <td>Profit/Loss</td>
                                        </tr>

                                    </tbody>

                                    <tbody class="travelerinfo product-more2 edit-assets-body">


                                        <tr>
                                            <td> 1 </td>
                                            <td><input type="text" name="dfs_description" class="form-control edit_description" readonly></td>
                                            <td><input type="text" name="dfs_acquired_date" class="form-control edit_acquired_date" readonly></td>
                                            <td><input type="text" name="dfs_asset_amount" class="form-control edit_asset_amt" readonly></td>
                                            <td><input type="text" name="dfs_depreciation" class="form-control edit_depreciation" readonly></td>
                                            <td><input type="number" name="dfs_sales_price" value="" class="form-control edit_sale_price"></td>
                                            <td><input type="text" name="dfs_profit" value="" class="form-control edit_profit" readonly></td>
                                        </tr>

                                        <tr>
                                            <td colspan="1"></td>
                                            <td colspan="2" align="left" class="amount_in_words_add"></td>
                                            <td align="right" colspan="3">Total</td>
                                            <input type="hidden" id="edit_total_amount_val" val="">
                                            <th id="edit_total_amount"></th>
                                        </tr>

                                    </tbody>

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



<script>
    document.addEventListener("DOMContentLoaded", function(event) {

        /*add section start*/

        /*add form*/
        $(function() {
            var form = $('#AddAssetDisposal');

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
                        url: "<?php echo base_url(); ?>Procurement/FixedAssetDisposal/Add",
                        method: "POST",
                        data: formData,
                        processData: false, // Don't process the data
                        contentType: false, // Don't set content type
                        //data: $(currentForm).serialize(),
                        success: function(data) {

                            $('#AddFixedAssetDisposal').modal('hide');

                            alertify.success('Data Added Successfully').delay(3).dismissOthers();

                            datatable.ajax.reload(null, false);

                        }
                    });


                }
            });
        });


        /*#####*/




        /* account head  search droup drown start*/

        $(".account_head_select").select2({
            placeholder: "Select Account Name",
            theme: "default form-control-",
            dropdownParent: $('#AddFixedAssetDisposal'),
            ajax: {
                url: "<?= base_url(); ?>Procurement/FixedAssetDisposal/FetchTypes",
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




        $(".edit_account_head_select").select2({
            placeholder: "Select Account Name",
            theme: "default form-control-",
            dropdownParent: $('#EditModal'),
            ajax: {
                url: "<?= base_url(); ?>Procurement/FixedAssetDisposal/FetchTypes",
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


        // Capture acc_head value

        $(".fixed_asset_select").select2({
            placeholder: "Select Assets",
            theme: "default form-control-",
            dropdownParent: $('#AddFixedAssetDisposal'),

            ajax: {
                url: "<?= base_url(); ?>Procurement/FixedAssetDisposal/FetchFixedAsset",
                dataType: 'json',
                delay: 250,
                cache: false,
                minimumInputLength: 1,
                allowClear: true,
                data: function(params) {
                    return {
                        term: params.term, // Search term
                        page: params.page || 1 // Pagination
                    };
                },
                processResults: function(data, params) {
                    var page = params.page || 1;
                    var acc_head = $('.add_account_head_select').val();

                    // Filter results where acc_head matches cfs_account_head
                    var filteredResults = $.map(data.result, function(item) {
                        if (item.cfs_account_head == acc_head) {
                            return {
                                id: item.cfs_id,
                                text: item.cfs_description
                            };
                        }
                        // If it doesn't match, return nothing (null)
                        return null;
                    });

                    return {
                        results: filteredResults,
                        pagination: {
                            more: (page * 10) <= data.total_count // Handle pagination
                        }
                    };
                }
            }
        });


        $(".edit_fixed_asset_select").select2({
            placeholder: "Select Assets",
            theme: "default form-control-",
            dropdownParent: $('#EditModal'),

            ajax: {
                url: "<?= base_url(); ?>Procurement/FixedAssetDisposal/FetchFixedAsset",
                dataType: 'json',
                delay: 250,
                cache: false,
                minimumInputLength: 1,
                allowClear: true,
                data: function(params) {
                    return {
                        term: params.term, // Search term
                        page: params.page || 1 // Pagination
                    };
                },
                processResults: function(data, params) {
                    var page = params.page || 1;
                    var acc_head = $('.edit_account_head_select').val();

                    // Filter results where acc_head matches cfs_account_head
                    var filteredResults = $.map(data.result, function(item) {
                        if (item.cfs_account_head == acc_head) {
                            return {
                                id: item.cfs_id,
                                text: item.cfs_description
                            };
                        }
                        // If it doesn't match, return nothing (null)
                        return null;
                    });

                    return {
                        results: filteredResults,
                        pagination: {
                            more: (page * 10) <= data.total_count // Handle pagination
                        }
                    };
                }
            }
        })


        $(".debit_account_select").select2({
            placeholder: "Select Account Name",
            theme: "default form-control-",
            dropdownParent: $('#AddFixedAssetDisposal'),
            ajax: {
                url: "<?= base_url(); ?>Procurement/FixedAssetDisposal/FetchDebitAcc",
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


        $(".edit_debit_account_select").select2({
            placeholder: "Select Account Name",
            theme: "default form-control-",
            dropdownParent: $('#EditModal'),
            ajax: {
                url: "<?= base_url(); ?>Procurement/FixedAssetDisposal/FetchDebitAcc",
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


        /*###*/




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






        $("body").on('change', '.fixed_asset_select', function() {

            var fixed_asset = $(this).val();

            $.ajax({

                url: "<?php echo base_url(); ?>Procurement/FixedAssetDisposal/FillData",

                method: "POST",

                data: {
                    Fixed: fixed_asset
                },

                success: function(data) {
                    var data = JSON.parse(data);
                    var fixedData = data.fixedasset;

                    $('.add_current_balance').val(data.asset_balance);
                    $('.asset_credit_acc').val(fixedData.cfs_credit_account).trigger('change');

                    // $('.edit_gi_account').val(null).trigger('change');

                    // $('.view-assets-body').html('');

                    if (data.asset_det != '') {
                        $('.view-assets-body').html(data.asset_det);
                        $('.view_selected_table').css('display', 'block');

                    }
                }
            });

        });

        // Define the round function
        function round(value, decimals) {
            return Number(Math.round(value + 'e' + decimals) + 'e-' + decimals);
        }

        // Define the floatVal function
        function floatVal(value) {
            return parseFloat(value) || 0; // Ensures valid float, defaults to 0 if invalid
        }

        // jQuery event listener
        $("body").on('input', '.add_sale_price', function() {

            var sale_price = $(this).val(); // Get sale price from input

            var amt = $('.add_asset_amt').val(); // Get asset amount from input

            var depric = $('.add_current_balance').val(); // Get depreciation from input

            var profit = round(floatVal(sale_price) - (floatVal(amt) - floatVal(depric)), 2); // Calculate profit

            $('.add_profit').val(profit); // Update profit input field

            $('#total_amount_val').val(profit); // Update hidden total amount input

            $('#total_amount').text(profit); // Update displayed total amount

        });


        // jQuery event listener
        $("body").on('input', '.edit_sale_price', function() {

            var sale_price = $(this).val(); // Get sale price from input

            var amt = $('.edit_asset_amt').val(); // Get asset amount from input

            var depric = $('.edit_current_balance').val(); // Get depreciation from input

            var profit = round(floatVal(sale_price) - (floatVal(amt) - floatVal(depric)), 2); // Calculate profit

            $('.edit_profit').val(profit); // Update profit input field

            $('#edit_total_amount_val').val(profit); // Update hidden total amount input

            $('#edit_total_amount').text(profit); // Update displayed total amount

        });

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
                    'url': "<?php echo base_url(); ?>Procurement/FixedAssetDisposal/FetchData",
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
                        data: 'dfs_id'
                    },
                    {
                        data: 'dfs_description'
                    },
                    {
                        data: 'dfs_account_head'
                    },
                    {
                        data: 'dfs_date_dispose'
                    },
                    {
                        data: 'dfs_sale_price'
                    },
                    {
                        data: 'dfs_profit'
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



        $('.add_model_btn').click(function() {
            // Reset the form fields (inputs, selects, etc.)
            $('#AddAssetDisposal')[0].reset();

            // Reset select2 elements to their placeholder
            $('#AddAssetDisposal').find('.form-select ').val(null).trigger('change');

            // Clear any input type="checkbox" or type="radio" specifically
            $('#AddAssetDisposal').find('input[type="checkbox"], input[type="radio"]').prop('checked', false);

            // Clear any input fields that may not be covered by form reset (e.g. custom input types)
            $('#AddAssetDisposal').find('input[type="text"], input[type="number"], input[type="email"], textarea').val('');


            // Reset custom elements like date pickers, if any
            $('#AddAssetDisposal').find('.datepicker').datepicker('setDate', null);

            // Clear out any dynamically added fields (if you have dynamic form fields)
            $('#AddAssetDisposal').find('.view_selected_table').css('display', 'none'); // Example, adjust if needed

            $.ajax({

                url : "<?php echo base_url(); ?>Procurement/FixedAssetDisposal/AddAccess",

                method : "POST",

                success:function(data)
                {

                    var data = JSON.parse(data);

                    if(data.status === 0){
                    
                        alertify.error(data.msg).delay(3).dismissOthers();

                    }
                    else{

                        $('#AddFixedAssetDisposal').modal('show');

                    }
                    

                }

            });

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







        /*view section start*/

        $("body").on('click', '.view_btn', function() {
            var id = $(this).data('id');

            // Fetch the view data
            $.ajax({
                url: "<?php echo base_url(); ?>Procurement/FixedAssetDisposal/View",
                method: "POST",
                data: {
                    ID: id
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    var assetDisposed = data.assetdisposed;

                    // Set other form fields
                    $('.view_description').val(assetDisposed.dfs_description);
                    $('.view_acquired_date').val(assetDisposed.dfs_acquired_date);
                    $('.view_asset_amt').val(assetDisposed.dfs_asset_amount);
                    $('.view_depreciation').val(assetDisposed.dfs_depreciation);
                    $('.view_sale_price').val(assetDisposed.dfs_sales_price);
                    $('.view_profit').val(assetDisposed.dfs_profit);
                    $('#view_total_amount').text(assetDisposed.dfs_profit);
                    $('.view_dispose_date').val(assetDisposed.dfs_date_dispose);
                    $('.view_current_balance').val(assetDisposed.dfs_asset_balance);

                    // Fetch and populate account head Select2
                    $.ajax({
                        url: "<?= base_url(); ?>Procurement/FixedAssetDisposal/FetchTypes",
                        method: "GET",
                        dataType: 'json',
                        success: function(fetchResponse) {
                            var selectAccountHead = $('.view_account_head_select');
                            selectAccountHead.empty(); // Clear existing options

                            // Populate select options for account head
                            $.each(fetchResponse.result, function(index, item) {
                                var option = new Option(item.ah_account_name, item.ah_id, false, false);
                                selectAccountHead.append(option);
                            });

                            // Set the selected value and trigger the Select2 update
                            if (assetDisposed.dfs_account_head) {
                                selectAccountHead.val(assetDisposed.dfs_account_head).trigger('change');
                            }
                            selectAccountHead.prop('disabled', true).trigger('change'); // Disable it
                        }


                    });

                    // Fetch and populate fixed asset Select2
                    $.ajax({
                        url: "<?= base_url(); ?>Procurement/FixedAssetDisposal/FetchFixedAsset",
                        method: "GET",
                        dataType: 'json',
                        success: function(fetchResponse) {
                            var selectFixedAsset = $('.view_fixed_asset_select');
                            selectFixedAsset.empty(); // Clear existing options

                            // Populate select options for fixed asset
                            $.each(fetchResponse.result, function(index, item) {
                                var option = new Option(item.cfs_description, item.cfs_id, false, false);
                                selectFixedAsset.append(option);
                            });

                            // Set the selected value and trigger the Select2 update
                            if (assetDisposed.dfs_fixed_asset) {
                                selectFixedAsset.val(assetDisposed.dfs_fixed_asset).trigger('change');
                            }
                            selectFixedAsset.prop('disabled', true).trigger('change'); // Disable it
                        }
                    });

                    // Set other select fields that don't require fetching new options
                    $('.view_credit_acc').val(assetDisposed.dfs_credit_account).trigger('change');
                    $('.view_gi_account').val(assetDisposed.dfs_debit_account).trigger('change');



                    // Show the modal after all fields are set
                    $('#ViewModal').modal("show");
                }
            });
        });



        /*view section end*/


        /*edit section start*/


        $("body").on('click', '.edit_btn', function() {

            var id = $(this).data('id');

            $.ajax({

                url: "<?php echo base_url(); ?>Procurement/FixedAssetDisposal/Edit",

                method: "POST",

                data: {
                    ID: id
                },

                success: function(response) {
                    var data = JSON.parse(response);
                    var assetDisposed = data.assetdisposed;

                    if(data.status === 0){

                        alertify.error(data.msg).delay(3).dismissOthers();

                    }else{
                       
                        // Set other form fields
                        $('.edit_id').val(assetDisposed.dfs_id);
                        $('.edit_description').val(assetDisposed.dfs_description);
                        $('.edit_acquired_date').val(assetDisposed.dfs_acquired_date);
                        $('.edit_asset_amt').val(assetDisposed.dfs_asset_amount);
                        $('.edit_depreciation').val(assetDisposed.dfs_depreciation);
                        $('.edit_sale_price').val(assetDisposed.dfs_sales_price);
                        $('.edit_profit').val(assetDisposed.dfs_profit);
                        $('#edit_total_amount').text(assetDisposed.dfs_profit);
                        $('.edit_dispose_date').val(assetDisposed.dfs_date_dispose);
                        $('.edit_current_balance').val(assetDisposed.dfs_asset_balance);

                        // Fetch and populate account head Select2
                        $.ajax({
                            url: "<?= base_url(); ?>Procurement/FixedAssetDisposal/FetchTypes",
                            method: "GET",
                            dataType: 'json',
                            success: function(fetchResponse) {
                                var selectAccountHead = $('.edit_account_head_select');
                                selectAccountHead.empty(); // Clear existing options

                                // Populate select options for account head
                                $.each(fetchResponse.result, function(index, item) {
                                    var option = new Option(item.ah_account_name, item.ah_id, false, false);
                                    selectAccountHead.append(option);
                                });

                                // Set the selected value and trigger the Select2 update
                                if (assetDisposed.dfs_account_head) {
                                    selectAccountHead.val(assetDisposed.dfs_account_head).trigger('change');
                                }

                            }


                        });

                        // Fetch and populate fixed asset Select2
                        $.ajax({
                            url: "<?= base_url(); ?>Procurement/FixedAssetDisposal/FetchFixedAsset",
                            method: "GET",
                            dataType: 'json',
                            success: function(fetchResponse) {
                                var selectFixedAsset = $('.edit_fixed_asset_select');
                                selectFixedAsset.empty(); // Clear existing options

                                // Populate select options for fixed asset
                                $.each(fetchResponse.result, function(index, item) {
                                    var option = new Option(item.cfs_description, item.cfs_id, false, false);
                                    selectFixedAsset.append(option);
                                });

                                // Set the selected value and trigger the Select2 update
                                if (assetDisposed.dfs_fixed_asset) {
                                    selectFixedAsset.val(assetDisposed.dfs_fixed_asset).trigger('change');
                                }
                            }
                        });

                        // Set other select fields that don't require fetching new options
                        $('.edit_credit_acc').val(assetDisposed.dfs_credit_account).trigger('change');
                        $('.edit_gi_account').val(assetDisposed.dfs_debit_account).trigger('change');



                        // Show the modal after all fields are set
                        $('#EditModal').modal("show");

                    }

                    
                }

            });

        });


        /*delete section start*/

        $("body").on('click', '.delete_btn', function() {

            var id = $(this).data('id');

            var rowToDelete = $(this).closest('tr');

            $.ajax({

                url: "<?php echo base_url(); ?>Procurement/FixedAssetDisposal/Delete",

                method: "POST",

                data: {
                    ID: id
                },

                success: function(data) {
                    //var data = JSON.parse(data);
                    
                    if(data.status === 1){

                        rowToDelete.fadeOut(500, function() {

                            $(this).remove();

                            alertify.success(data.msg).delay(2).dismissOthers();

                            datatable.ajax.reload(null, false);
                        });

                    }
                    else{

                        alertify.error(data.msg).delay(2).dismissOthers();
                    } 

                    

                }

            });

        });

        /*delete section end*/



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
                        url: "<?php echo base_url(); ?>Procurement/FixedAssetDisposal/Update",
                        method: "POST",
                        data: formData,
                        processData: false, // Don't process the data
                        contentType: false, // Don't set content type
                        success: function(data) {

                            $('#EditModal').modal('hide');

                            alertify.success('Data Added Successfully').delay(3).dismissOthers();

                            datatable.ajax.reload(null, false);

                        }
                    });


                }
            });
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