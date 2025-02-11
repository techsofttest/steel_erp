<!--Start Account head -->

<style>
    .cheque_sec {
        display: flex;
    }

    .cheque_sec_view {
        display: none;
    }
</style>





<!-- View Modal -->


<div class="modal fade" id="ViewModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">View Petty Cash Voucher</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


                <div class="row">


                    <div class="col-lg-12">
                        <div class="card">

                            <div class="card-body">
                                <div class="live-preview">

                                    <div class="row align-items-end">



                                        <table class="table table-bordered">


                                            <tbody id="view_receipt_body">


                                                <tr>


                                                    <td>Reference</td>

                                                    <th id="view_reference"></th>


                                                    <td>Payment Method</td>

                                                    <th id="view_payment_method"></th>


                                                </tr>



                                                <tr>

                                                    <td>Credit Account</td>

                                                    <th id="view_debit_account"></th>

                                                    <td class="view_cheque_sec">Cheque No</td>

                                                    <th class="view_cheque_sec" id="view_cheque_no"></th>


                                                </tr>



                                                <tr>

                                                    <td>Date</td>

                                                    <th id="view_date"></th>


                                                    <td>Bank</td>


                                                    <th id="view_bank"></th>


                                                </tr>
                                               

                                                <tr class="view_cheque_sec">

                                                    <td>Cheque Date</td>

                                                    <th id="view_cheque_date"></th>

                                                    <td>Cheque File</td>

                                                    <th id="view_cheque_file">

                                                    </th>

                                                </tr>




                                            </tbody>

                            <tr>

                                <th colspan="5" style="text-align: center;font-size: 15px;">Invoices</th>

                            </tr>


                                            <tbody>


                                                <tr>

                                                <th>Account</th>

                                                <th>Type</th>

                                                <th>Invoice</th>

                                                <th>Narration</th>

                                                <th class="text-end">Amount</th>

                                                </tr>

                                            </tbody>

                                            <tbody id="view_payment_invoices">


                                            </tbody>


                                            <tfoot>

                                            <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="text-end">Total Payment : </td>
                                            <td class='text-end' style=""><b><span id="total_payment_amount_view"></span></b></td>
                                            </tr>

                                            </tfoot>


                                        </table>

                                      

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


    </div>


</div>
</div>

<!-- ######### -->













<!-- Invoices Seletion Modal -->


<div class="modal fade" id="InvoicesModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form method="POST" class="Dashboard-form class" id="invoices_add">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Select Invoices</h5>
                    <button type="button" class="btn-close" data-bs-target="#AddModal" data-bs-toggle="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <input type="hidden" name="credit_id" value="">

                    <div class="row">


                        <div class="col-lg-12">

                            <div class="card">

                                <div class="card-body">

                                    <div class="live-preview">

                                        <div class="row align-items-end">

                                            <div class="col-col-md-12 col-lg-12">

                                                <div class="row align-items-center">

                                                    <div class="col-lg-10 add_more_container p-0">

                                                        <table class="table table-bordered">


                                                            <thead>
                                                                <tr>
                                                                    <th>Sl No</th>
                                                                    <th>Date</th>
                                                                    <th>Invoice No</th>
                                                                    <th>LPO Ref</th>
                                                                    <th>Amount</th>
                                                                    <th>Payment</th>
                                                                    <th>Tick</th>
                                                                </tr>
                                                            </thead>


                                                            <tbody id="invoices_sec">


                                                            </tbody>



                                                            <tr>
                                                                <td>Total</td>

                                                                <td class="invoice_total"></td>

                                                                <td>Adjusted</td>

                                                                <td class="invoice_adjusted"></td>

                                                                <td>Balance</td>

                                                                <td class="invoice_balance"></td>
                                                            </tr>



                                                        </table>

                                                    </div>



                                                    <div class="col-lg-2">


                                                        <button type="button" class="w-100" id="add_poadvance_btn">Advance</button>

                                                        <button id="fifo_add" class="w-100" type="button">FIFO</button>

                                                        <button class="w-100" type="submit">Save</button>



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
                <button type="button" class="btn btn-secondary" data-bs-target="#AddModal" data-bs-toggle="modal">Cancel</button>
                <button type="submit" class="btn btn btn-success">Add</button>
            </div> -->

            </div>
        </form>

    </div>
</div>



<!-- ### -->






<div class="tab-pane active" id="border-nav-1" role="tabpanel">


    <!-- Add Modal -->


    <div class="modal fade" id="AddModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form class="Dashboard-form class" id="add_form">

                <input type="hidden" id="added_id" name="p_id" autocomplete="off">
                <input id="add_saved" value="no" type="hidden">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Petty Cash Voucher</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">


                        <div class="row">


                            <div class="col-lg-12">
                                <div class="card">

                                    <div class="card-body">
                                        <div class="live-preview">

                                            <div class="row align-items-start no_margin_rows">





                                                <!-- Section 1 -->

                                                <div class="col-lg-6">




                                                    <div class="row align-items-center mb-2">

                                                        <div class="col-col-md-3 col-lg-3">

                                                            <label for="basiInput" class="form-label">Reference</label>
                                                        </div>

                                                        <div class="col-col-md-9 col-lg-9">

                                                            <input type="text" name="pay_ref_no" id="uid" class="form-control" required>

                                                        </div>

                                                    </div>



                                                    <div class="row align-items-center mb-2">

                                                        <div class="col-col-md-3 col-lg-3">

                                                            <label for="basiInput" class="form-label">Date</label>
                                                        </div>

                                                        <div class="col-col-md-9 col-lg-9">

                                                            <input type="text" name="p_date" class="form-control datepicker_ap" required readonly>

                                                        </div>

                                                    </div>




                                                    <div class="row align-items-center mb-2">

                                                        <div class="col-col-md-3 col-lg-3">

                                                            <label for="basiInput" class="form-label">Credit Account</label>

                                                        </div>


                                                        <div class="col-col-md-9 col-lg-9 select2_parent">


                                                            <select class="form-control add_credit_account_select2" name="p_credit_account" required>


                                                            </select>


                                                        </div>


                                                    </div>




                                                    <div class="row align-items-center mb-2 cheque_sec d-none">

                                                        <div class="col-col-md-3 col-lg-3">

                                                            <label for="basiInput" class="form-label">Cheque Copy</label>

                                                        </div>

                                                        <div class="col-col-md-9 col-lg-9">

                                                            <input type="file" name="p_cheque_copy" class="form-control">

                                                        </div>

                                                    </div>







                                                </div> <!-- Section 1 End -->



                                                <div class="col-lg-6">



                                                    <div class="row align-items-center mb-2">

                                                        <div class="col-col-md-3 col-lg-3">

                                                            <label for="basiInput" class="form-label">Payment Method</label>

                                                        </div>


                                                        <div class="col-col-md-9 col-lg-9">

                                                            <select name="p_method" class="form-control" id="" required>

                                                                <option value="">Select Payment Method</option>

                                                                <?php foreach ($p_methods as $r_method) { ?>

                                                                    <option value="<?= $r_method->rm_id; ?>"><?= $r_method->rm_name; ?></option>

                                                                <?php } ?>

                                                            </select>


                                                        </div>

                                                    </div>



                                                    <div class="row align-items-center mb-2 cheque_sec d-none">


                                                        <div class="col-col-md-3 col-lg-3">
                                                            <label for="basiInput" class="form-label">Cheque Number</label>
                                                        </div>

                                                        <div class="col-col-md-9 col-lg-9">
                                                            <input type="text" name="p_cheque_no" class="form-control" required>
                                                        </div>
                                                    </div>


                                                    <div class="row align-items-center mb-2 cheque_sec d-none">


                                                        <div class="col-col-md-3 col-lg-3">

                                                            <label for="basiInput" class="form-label">Cheque Date</label>






                                                        </div>


                                                        <div class="col-col-md-9 col-lg-9">

                                                            <input type="text" name="p_cheque_date" class="form-control datepicker" required readonly>

                                                        </div>

                                                    </div>



                                                    <div class="row align-items-center mb-2 d-none" id="bank_sec_add">

                                                        <div class="col-col-md-3 col-lg-3">

                                                            <label for="basiInput" class="form-label">Bank</label>

                                                        </div>

                                                        <div class="col-col-md-9 col-lg-9">

                                                            <select name="p_bank" class="form-control" required>

                                                                <option value="">Select Bank</option>
                                                                <?php foreach ($banks as $a_bank) { ?>
                                                                    <option value="<?= $a_bank->bank_id ?>"><?= $a_bank->bank_name ?></option>
                                                                <?php } ?>

                                                            </select>

                                                        </div>

                                                    </div>




                                                </div> <!-- -->


                                                <input id="total_amount_val" type="hidden" name="p_amount" class="form-control" value="">


                                                <div class="col-col-md-12 col-lg-12 add_more_container">


                                                    <table class="table table-bordered" style="overflow-y:scroll;">

                                                        <thead>
                                                            <tr>
                                                                <th>Sl No</th>
                                                                <th>Sales Order</th>
                                                                <th>Debit Account</th>
                                                                <th>Amount</th>
                                                                <th>Link</th>
                                                                <th>Narration</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                        </thead>


                                                        <tbody id="sel_invoices">

                                                            <tr class="invoice_row">


                                                                <td width="5%">

                                                                    <input class="credit_sl_no form-control" type="number" name="credit_sl_no[]" value="1" readonly>



                                                                </td>

                                                                


                                                                <td width="20%" class="so_select2_parent_add">

                                                                    <select class="form-control sales_order so_select2_add" name="p_sales_order[]">

                                                                    </select>

                                                                </td>



                                                                <td width="35%">

                                                                    <select class="form-control debit_account debit_account_select2" name="p_debit_account[]">

                                                                    </select>

                                                                </td>


                                                                <td>

                                                                    <input class="form-control credit_amount" data-max="" type="number" name="inv_amount[]">

                                                                </td>


                                                                <td>
                                                                    <a class="btn btn-primary add_invoices" href="javascript:void(0);">Click</a>
                                                                </td>

                                                                <td>

                                                                    <input class="form-control credit_narration" type="text" name="narration[]" />

                                                                </td>


                                                                <td> <a href="javascript:void(0);" class="del_elem" style="display:none;"><i class='ri-close-line'></i></a></td>


                                                            </tr>


                                                            <tr>

                                                                <td colspan="7">

                                                                    <div class="col-lg-12 text-center">

                                                                        <a class="add_more" href="javascript:void(0);"><span class=""><i class="ri-add-circle-line"></i>Add More</span></a>

                                                                    </div>

                                                                </td>

                                                            </tr>


                                                        </tbody>





                                                        <tr>

                                                         

                                                            <td align="right" colspan="6">Total</td>


                                                            <th id="total_amount">0</th>


                                                        </tr>


                                                    </table>


                                                </div>



                                            </div>
                                            <!--end row-->



                                            <div class="row">


<div class="col-lg-12 text-end">


    <div style="">
        <table class="table table-bordered table-striped enq_tab_submit menu">

            <!--
            <tr>
                <td><button class="submit_btn">Print</button></td>
                <td><button class="submit_btn">Email</button></td>
            </tr>
            -->
            <tr>

                <button class="btn btn-success submit_btn once_form_submit" name="main_submit" type="submit">Save</button>
                <!--<td><button class="submit_btn">PDF</button></td>-->
            </tr>
        </table>
    </div>


</div>


</div>



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



    <!-- ### -->




    <!-- View Modal -->


    <div class="modal fade" id="AddPOAdvanceModal" aria-hidden="true">

        <div class="modal-dialog modal-xl">

            <form class="" class="Dashboard-form class" id="add_po_advance_form">

                <div class="modal-content">
                    <div class="modal-header">
                        <!--<h5 class="modal-title" id="exampleModalLabel">Sales Orders</h5>-->
                        <button type="button" class="btn-close" data-bs-toggle="modal" data-bs-target="#InvoicesModal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">


                        <div class="row">


                            <div class="col-lg-12">
                                <div class="card">

                                    <div class="card-body">
                                        <div class="live-preview">

                                            <div class="row align-items-end">


                                                <div class="col-col-md-12 col-lg-12 add_more_container">

                                                    <table class="table table-bordered" style="overflow-y:scroll;">

                                                        <thead>
                                                            <tr>
                                                                <th>Sl No</th>
                                                                <th>Purchase Order</th>
                                                                <th>LPO Ref</th>
                                                                <th>Amount</th>
                                                                <th>Payment</th>
                                                            </tr>
                                                        </thead>


                                                        <tbody id="purchase_order_add">


                                                        </tbody>


                                                        <tbody> 

                                                        <tr>
                                                                <td>Total</td>

                                                                <td class="invoice_total"></td>

                                                                <td>Adjusted</td>

                                                                <td class="invoice_adjusted"></td>

                                                                <td>Balance</td>

                                                                <td class="invoice_balance"></td>
                                                        </tr>

                                                        </tbody>




                                                    </table>



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


                    <div class="modal-footer justify-content-center">

                        <button type="submit" class="btn btn btn-success">Save</button>
                    </div>


                </div>

            </form>

        </div>
    </div>


    <!-- ## -->














    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">View Petty Cash Vouchers</h4>
                    <button type="button"   class="add_model_btn btn btn-primary py-1">Add</button>
                </div><!-- end card header -->
                <div class="card-body" id="account_type_id">
                    <!-- CSRF token -->
                    <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <table id="accountTable" class="table table-bordered table-striped delTable display dataTable">
                        <thead>
                            <tr>
                                <th class="no-sort">Sl no</th>
                                <th>Reference</th>
                                <th>Date</th>
                                <th>Method</th>
                                <th>Bank</th>
                                <th>Amount</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>


                        </tbody>

                    </table>

                </div>
            </div>
        </div>
        <!--end col-->
    </div>


</div>


<!--end Account  Head-->




<!--Edit Modal section start-->
<div class="modal fade" id="EditModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form id="edit_form" class="Dashboard-form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Petty Cash Voucher</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row">



                        <div class="col-lg-12">
                            <div class="card">

                                <div class="card-body">
                                    <div class="live-preview">

                                        <div class="row align-items-start no_margin_rows">





                                            <!-- Section 1 -->

                                            <div class="col-lg-6">




                                                <div class="row align-items-center mb-2">

                                                    <div class="col-col-md-3 col-lg-3">

                                                        <label for="basiInput" class="form-label">Reference</label>

                                                    </div>

                                                    <div class="col-col-md-9 col-lg-9">

                                                        <input type="text" id="uid_edit" class="form-control" readonly>

                                                        <input type="hidden" id="p_id_edit" name="p_id" value="">

                                                    </div>

                                                </div>



                                                <div class="row align-items-center mb-2">

                                                    <div class="col-col-md-3 col-lg-3">

                                                        <label for="basiInput" class="form-label">Date</label>
                                                    </div>

                                                    <div class="col-col-md-9 col-lg-9">

                                                        <input type="text" id="p_date_edit" name="p_date" class="form-control datepicker_ap" required readonly>

                                                    </div>

                                                </div>



                                                <div class="row align-items-center mb-2">

                                                    <div class="col-col-md-3 col-lg-3">

                                                        <label for="basiInput" class="form-label">Credit Account</label>

                                                    </div>


                                                    <div class="col-col-md-9 col-lg-9 select2_parent">

                                                        <!--
                            <select class="form-control edit_credit_account_select2" id="p_credit_account_edit" name="p_credit_account">

                            <option value="">Select Credit Account</option>

                            </select>
                            -->

                                                        <input class="form-control" id="p_credit_account_edit" readonly>


                                                    </div>


                                                </div>



                                                <div class="row align-items-center mb-2 cheque_file_sec cheque_sec d-none">

                                                    <div class="col-col-md-3 col-lg-3">

                                                        <label for="basiInput" class="form-label">Cheque File</label>

                                                    </div>

                                                    <div class="col-col-md-9 col-lg-9">

                                                        <a class="" target="_blank" id="cheque_file_view" href="javascript:void(0);">View</a>

                                                    </div>

                                                </div>



                                                <div class="row align-items-center mb-2 cheque_sec cheque_file_edit_sec d-none">

                                                    <div class="col-col-md-3 col-lg-3">

                                                        <label for="basiInput" class="form-label">Update Cheque Copy</label>

                                                    </div>

                                                    <div class="col-col-md-9 col-lg-9">

                                                        <input type="file" name="p_cheque_copy" class="form-control">

                                                    </div>

                                                </div>







                                            </div> <!-- Section 1 End -->



                                            <div class="col-lg-6">



                                                <div class="row align-items-center mb-2">

                                                    <div class="col-col-md-3 col-lg-3">

                                                        <label for="basiInput" class="form-label">Payment Method</label>

                                                    </div>


                                                    <div class="col-col-md-9 col-lg-9">

                                                        <select id="p_method_edit" name="p_method" class="form-control" required>

                                                            <option value="">Select Payment Method</option>

                                                            <?php foreach ($p_methods as $r_method) { ?>

                                                                <option value="<?= $r_method->rm_id; ?>"><?= $r_method->rm_name; ?></option>

                                                            <?php } ?>

                                                        </select>


                                                    </div>

                                                </div>



                                                <div class="row align-items-center mb-2 cheque_sec d-none">


                                                    <div class="col-col-md-3 col-lg-3">
                                                        <label for="basiInput" class="form-label">Cheque Number</label>
                                                    </div>

                                                    <div class="col-col-md-9 col-lg-9">
                                                        <input type="text" name="p_cheque_no" class="form-control">
                                                    </div>
                                                </div>


                                                <div class="row align-items-center mb-2 cheque_sec d-none">


                                                    <div class="col-col-md-3 col-lg-3">

                                                        <label for="basiInput" class="form-label">Cheque Date</label>

                                                    </div>


                                                    <div class="col-col-md-9 col-lg-9">

                                                        <input type="text" name="p_cheque_date" class="form-control datepicker" readonly>

                                                    </div>


                                                </div>



                                                <div class="row align-items-center mb-2 bank_sec_edit" id="bank_sec_edit">


                                                    <div class="col-col-md-3 col-lg-3">

                                                        <label for="basiInput" class="form-label">Bank</label>

                                                    </div>

                                                    <div class="col-col-md-9 col-lg-9">

                                                        <select id="p_bank_edit" name="p_bank" class="form-control" required>

                                                            <option value="">Select Bank</option>
                                                            <?php foreach ($banks as $a_bank) { ?>
                                                                <option value="<?= $a_bank->bank_id ?>"><?= $a_bank->bank_name ?></option>
                                                            <?php } ?>

                                                        </select>

                                                    </div>

                                                </div>


                                            </div> <!-- -->



                                            <input type="hidden" name="p_amount" class="form-control" value="">


                                            <div class="col-col-md-12 col-lg-12 add_more_container">


                                                <table class="table table-bordered" style="overflow-y:scroll;">

                                                    <thead>
                                                        <tr>
                                                            <th>Account</th>
                                                            <th>Type</th>
                                                            <th>Invoice</th>
                                                            <th>Narration</th>
                                                            <th>Amount</th>
                                                        </tr>
                                                    </thead>



                                                    <tbody id="sel_invoices_edit">



                                                    </tbody>



                                                </table>


                                            <div class="col-lg-12">

                                            <div style="" class="text-end">
                                                    <button class=" btn btn-success once_form_submit" type="submit">Update</button>
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



            </div>
        </form>

    </div>
</div>

<!--Edit modal section end-->



<!-- Invoices Seletion Modal -->


<div class="modal fade" id="EditInvoiceModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form method="POST" class="Dashboard-form class" id="invoices_edit">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Select Invoices</h5>
                    <button type="button" class="btn-close" data-bs-target="#EditModal" data-bs-toggle="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <input type="hidden" name="credit_id" value="">

                    <div class="row">


                        <div class="col-lg-12">

                            <div class="card">

                                <div class="card-body">

                                    <div class="live-preview">

                                        <div class="row align-items-end">

                                            <div class="col-col-md-12 col-lg-12">

                                                <div class="row align-items-center">

                                                    <div class="col-lg-10">

                                                        <table class="table table-bordered">


                                                            <thead>
                                                                <tr>
                                                                    <th>Sl No</th>
                                                                    <th>Date</th>
                                                                    <th>Invoice No</th>
                                                                    <th>LPO Ref</th>
                                                                    <th>Amount</th>
                                                                    <th>Payment</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>


                                                            <tbody id="invoice_detail_edit">

                                                            </tbody>


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
                <button type="button" class="btn btn-secondary" data-bs-target="#AddModal" data-bs-toggle="modal">Cancel</button>
                <button type="submit" class="btn btn btn-success">Add</button>
            </div> -->

            </div>
        </form>

    </div>
</div>


<!-- ### -->











<!-- <script src="<?php echo base_url(); ?>public/assets/js/jquery.num2words.js"></script> -->


<script> 
    var LinkTotal = 0;

    var LinkAdjusted = 0;

    var balance = 0;

    document.addEventListener("DOMContentLoaded", function(event) {


        /*account head add section*/

        $(function() {
            $('#add_form').validate({
                rules: {
                    required: 'required',
                },
                messages: {
                    required: 'This field is required',

                },
                errorPlacement: function(error, element) {},
                submitHandler: function(form) {

                    var submitButtonName = $(this.submitButton).attr("name");

                    var formData = new FormData(form);

                    $.ajax({
                        url: "<?php echo base_url(); ?>Accounts/PettyCashVoucher/Add",
                        method: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            //$('#add_form')[0].reset();
                            //$('#AddModal').modal('hide');

                            var data = JSON.parse(data);
                            //console.log(data.status);
                            if (data.status == 0) {
                                alertify.error(data.error).delay(3).dismissOthers();
                                return false;
                            }

                            $('#added_id').val(data.id);


                            if (submitButtonName == "main_submit") {
                                $('#AddModal').modal('hide');
                                alertify.success('Data Added Successfully').delay(3).dismissOthers();
                            }

                            //datatable.ajax.reload( null, false )

                            datatable.ajax.reload(null, false);
                        }

                    });
                    return false; // prevent the form from submitting
                }
            });
        });

        /*###*/




        /*account head modal start*/



        $("body").on('click', '.edit_btn', function() {

            var id = $(this).data('id');


            $("#EditModal :input").prop("disabled", false);

            $('#EditModal .submit_btn').show();

            $('#EditModal .edit_invoice').show();

            $('#EditModal .view_linked').show();

            $('#EditModal .edit_add_debit').show();

            $('#EditModal input[name=p_cheque_copy]').val('');

            $('#EditModal .cheque_file_edit_sec').removeClass("d-none");

            $.ajax({

                url: "<?php echo base_url(); ?>Accounts/PettyCashVoucher/Edit",
                method: "POST",
                data: {
                    id: id
                },

                success: function(data) {
                    
                        var data = JSON.parse(data);

                        if(data.status === 0){

                            alertify.error(data.msg).delay(3).dismissOthers();

                        }else{

                            InitAccountsSelect2('.debit_account_select2', '.invoice_row');

                            $('#uid_edit').val(data.pcv.pcv_voucher_no);

                            $('#p_id_edit').val(data.pcv.pcv_id);

                            $('#p_credit_account_edit').val(data.pcv.ca_name);

                            $('#p_method_edit').val(data.pcv.pcv_pay_method);

                            if (data.pcv.pcv_pay_method == "1") {
                                $('#EditModal .cheque_sec').removeClass("d-none");
                            } else {
                                $('#EditModal .cheque_sec').addClass("d-none");
                            }

                            if (data.pcv.pcv_pay_method == "1") {

                                $('.cheque_sec').removeClass("d-none");

                                $('.cheque_file_sec').removeClass("d-none");

                                $('#EditModal input[name=p_cheque_no]').val(data.pcv.pcv_cheque_no);

                                $('#EditModal input[name=p_cheque_date]').val(FormatDate(data.pcv.pcv_cheque_date));

                            if (data.pay.pay_cheque_copy != null) {
                                $('#EditModal #cheque_file_view').attr('href', '<?= base_url(); ?>uploads/PettyCashVoucher/' + data.pcv.pcv_cheque_copy + '');
                            } else {
                                $('.cheque_file_sec').addClass("d-none");
                            }

                            } else {

                                $('.cheque_sec').addClass("d-none");

                                $('.cheque_file_sec').addClass("d-none");

                            }


                            if (data.pcv.pcv_pay_method = "2") {

                            $('#EditModal .bank_sec_edit').addClass("d-none");

                            $('#p_bank_edit').val("");

                            $('#p_bank_edit').removeAttr("required");

                            } else {

                            $('#EditModal .bank_sec_edit').removeClass("d-none");

                            $('#p_bank_edit').attr("required", true);

                            }



                            $('#p_date_edit').val(data.pcv.pcv_date);

                            $('#p_bank_edit').val(data.pcv.pcv_bank);

                            $('#total_amount_edit').html(data.pcv.pcv_total);

                            //$('#sel_invoices_edit').html(data.debit);

                            $('#sel_invoices_edit').html(data.invoices);

                            $('#EditModal').modal('show');
                            
                        }

                       

                   
                }


            });






        });
        /*####*/



        //Change Receipt Method 

        $("body").on('change', '#p_method_edit', function() {

        var method = $(this).val();

        if (method == 2) {

            $('#EditModal .bank_sec_edit').addClass("d-none");

            $('#p_bank_edit').removeAttr("required");

        } else {

            $('#EditModal .bank_sec_edit').removeClass("d-none");

            $('#p_bank_edit').attr("required", true);

        }


        if (method == "1") {

            $('.cheque_sec').removeClass("d-none");

            $('.cheque_file_sec').removeClass("d-none");

            $('#EditModal .cheque_file_edit_sec').removeClass("d-none");

            $('.r_cheque_edit').attr("required", true);

        } else {

            $('.cheque_sec').addClass("d-none");

            $('.cheque_file_sec').addClass("d-none");

            $('.r_cheque_edit').removeAttr("required");

        }




        });

        //###






        $("body").on('click', '.view_btn', function() {


            var id = $(this).data('id');

            $.ajax({

                url: "<?php echo base_url(); ?>Accounts/PettyCashVoucher/View",

                method: "POST",

                data: {
                    id: id
                },

                success: function(data) {

                    if (data) {

                        var data = JSON.parse(data);

                        $('#view_reference').html(data.pay.pcv_voucher_no);

                        $('#view_date').html(FormatDate(data.pay.pcv_date));

                        $('#view_payment_method').html(data.pay.rm_name);

                        $('#view_debit_account').html(data.pay.ca_name);

                        $('#view_payment_invoices').html(data.invoices);


                        if (data.pay.pcv_pay_method == "1") {

                        $('.view_cheque_sec').removeClass("d-none");

                        if ((data.pay.pcv_cheque_copy != "") && (data.pay.pcv_cheque_copy != null) ) {
                            
                            $('#view_cheque_file').html('<a href="<?= base_url(); ?>uploads/PettyCashVoucher/' + data.pay.pcv_cheque_copy + '" target="_blank">View </a>');
                        } else {
                            $('#view_cheque_file').html("-");
                        }

                        $('#view_cheque_no').html(data.pay.pcv_cheque_no);

                        $('#view_cheque_date').html(data.pay.pcv_cheque_date);

                        } else {

                        $('.view_cheque_sec').addClass("d-none");

                        }
                        

                        if (data.pay.pcv_pay_method == "2") {
                            $('#view_bank').html('-');
                        } else {
                            $('#view_bank').html(data.pay.bank_name);
                        }

                        $('#total_payment_amount_view').html(data.pay.total_amount);


                        $('#ViewModal').modal('show');


                    } else {
                        alertify.error('Something went wrong!').delay(8).dismissOthers();
                    }

                }


            });


        });

        /*####*/



        /* Fetch Invoices */

        $("body").on('click', '.add_invoices', function() {

            var parent = $(this).closest('tr');

            var c_account = parent.find('.debit_account');

            // console.log(c_account.val());

            var c_amount = parent.find('.credit_amount');

            if (c_account.val() == "") {

                alertify.error('Select Debit Account!').delay(3).dismissOthers();

                return false;

            }


            if (c_amount.val() == "") {

                alertify.error('Enter Amount!').delay(3).dismissOthers();

                c_amount.focus();

                return false;

            }

            //var id=1;


            /*
            if (!$("#add_form").valid()) {
                alertify.error('Fill required fields!').delay(3).dismissOthers();
                return false;
            }
                */


            /*
            if ($('#added_id').val() == '') {
                $('#add_form').submit();

                if (!$("#add_form").valid()) {
                    alertify.error('Fill required fields!').delay(3).dismissOthers();
                    return false;
                }

            }
                */


            /*
            var checkValueInterval = setInterval(function() {
                if ($('#added_id').val() !== '') {
                    clearInterval(checkValueInterval);
            */


            var pid = $('#added_id').val();

            var id = c_account.val(); //Customer_ID

            var credit_date = parent.find('.credit_date').val();

            var credit_amount = parent.find('.credit_amount').val();

            var credit_narration = parent.find('.credit_narration').val();


            $.ajax({

                url: "<?php echo base_url(); ?>Accounts/PettyCashVoucher/FetchInvoices",

                method: "POST",

                data: {
                    id: id,
                    cdate: credit_date,
                    camount: credit_amount,
                    cnarration: credit_narration,
                    pid: pid
                },

                dataType: "json",

                success: function(data) {

                    if (data.status == 0) {
                        alertify.error('No Invoices Found!').delay(3).dismissOthers();

                        $('#AddModal').modal('show');

                        return false;
                    }

                    $('#invoices_sec').hide().html(data.invoices).fadeIn(200);

                    $('#AddModal').modal('hide');

                    $('#fifo_add').attr('data-total', credit_amount);

                    $('body #fifo_add').data('total', credit_amount);

                    $('body #add_poadvance_btn').data('vendor', data.vendor_id);

                    $('body #add_poadvance_btn').attr('data-vendor',data.vendor_id);

                    $('body #add_poadvance_btn').data('debitid', data.pd_id);

                    $('body #add_poadvance_btn').attr('data-debitid',data.pd_id);


                    $('#InvoicesModal').modal('show');

                    $('.invoice_total').html(credit_amount);

                    $('.invoice_adjusted').html('0');

                    $('.invoice_balance').html('0');

                }


            });


            /*
        } else {
                    //console.log('No'); // Logging for debugging purposes
                }
            }, 100);
            */


        });

        /*##*/



        $('body').on('click', '#fifo_add', function() {

            var total = $(this).attr('data-total');

            $('.invoice_receipt_amount').each(function() {

                parent = $(this).closest('tr');

                invoice_total = parent.find('.invoice_total_amount').val();

                var fill_amount = Math.min(total, invoice_total);

                parent.find('.invoice_receipt_amount').val(fill_amount);

                total -= fill_amount;

            });


        });






        /* Edit Invoice Start */

        $("body").on('click', '.edit_invoice', function() {

            var id = $(this).data('id');

            $('#view' + id + '').find('.edit').show();

            $('#view' + id + '').find('.view').hide();

            $('#pd_id_edit').val(id);

            $.ajax({

                url: "<?php echo base_url(); ?>Accounts/Payments/EditInvoice",

                method: "POST",

                data: {
                    inv_id: id
                },

                success: function(data) {
                    var data = JSON.parse(data);

                    $('#ri_date_edit').val(data.ri.ri_date);

                    $('#ri_credit_account_edit').val(data.ri.ri_credit_account);

                    $('#ri_amount_edit').val(data.ri.ri_amount);

                    $('#ri_remarks_edit').val(data.ri.ri_remarks);

                }

            });

            //$('#EditModal').modal('hide');

            //$('#InvoiceEditModal').modal('show');

        });




        //Cancel Credit Edit

        $('body').on('click', '.cancel_invoice_btn', function() {

            var id = $(this).data('id');

            $('#view' + id + '').find('.edit').hide();

            $('#view' + id + '').find('.view').show();

        });


        //



        /*cost calculation add more*/

        var max_fieldcost = 30;

        var cc = $('.invoice_row').length;

        $("body").on('click', '.add_more', function() {

            var cc = $('.invoice_row').length;

            if (cc < max_fieldcost) {

                cc++;
                //$(".cost_cal").append("<div class='row cost_cal_row'><div class='col-md-3 col-lg-3'><label for='basicInput' class='form-label'>Material / Services</label><select id='quotation_material' class='form-control quotation_material_clz'><option value='' selected disabled>Select Material / Services</option></select></div><div class='col-md-3 col-lg-3'><label for='basiInput' class='form-label'>Qty</label><input type='number' name='qd_qty' class='form-control cost_qty' required></div><div class='col-md-3 col-lg-3'><label for='basicInput' class='form-label'>Rate</label><input type='number' name='qd_rate' class='form-control cost_rate' required></div><div class='col-md-3 col-lg-3'><label for='basicInput' class='form-label'>Amount</label><input readonly type='number' name='qd_amount' class='form-control cost_amount' required style='width:95%'></div><div class='remove-cost'><div class='remainpass cost_remove'><i class='ri-close-line'></i></div></div></div>");

                var $clone = $('.invoice_row:first').clone();

                $clone.find("input").val("");

                $clone.find("select").val("");

                $clone.find(".debit_account_select2").val('');

                $clone.find(".debit_account_select2").removeAttr('data-select2-id');

                $clone.find(".so_select2_add").val('');

                $clone.find(".so_select2_add").removeAttr('data-select2-id');

                $clone.find('.select2').remove();

                $clone.find(".sl_no").html(cc);

                $clone.find(".del_elem").show();

                //$clone.find('.credit_sl_no').val('2');

                $clone.insertAfter('.invoice_row:last');

                slno();

                InitAccountsSelect2('.debit_account_select2', '.invoice_row');

                SOSelect2();


            }

        });



        $(document).on("click", ".del_elem", function() {
            $(this).closest('.invoice_row').remove();
            cc--;
            //totalCalcutate();                                                                           
            //grossCalculate();
            slno();
        });

        /**/


        function slno() {

            var pp = 1;

            $('body .invoice_row').each(function() {

                $(this).find('.credit_sl_no').val(pp);

                pp++;

            });

        }







        /*account head update*/
        $(document).ready(function() {
            $('#edit_form').submit(function(e) {

                e.preventDefault();

                $.ajax({

                    url: "<?php echo base_url(); ?>Accounts/PettyCashVoucher/Update",

                    method: "POST",

                    //data : $('#edit_form').serialize(),

                    data: new FormData(document.getElementById("edit_form")),

                    processData: false,

                    contentType: false,

                    success: function(data) {

                        var data = JSON.parse(data);

                        if (data.status == 0) {

                            alertify.error(data.msg).delay(3).dismissOthers();

                            return false;

                        }

                        $('#EditModal').modal('hide');

                        alertify.success('Data Updated Successfully').delay(8).dismissOthers();

                        datatable.ajax.reload(null, false);
                    }


                });
            });
        });
        /*###*/



        $('#AddModal .btn-close').click(function() {

            //$('#AddModal').on('hidden.bs.modal', function () {

            var stat = $('#AddModal #add_saved').val();

            if (stat == "no") {
                if ($('#added_id').val() != "") {

                    var id = $('#added_id').val();

                    $.ajax({

                        url: "<?php echo base_url(); ?>Accounts/Payments/Delete",

                        method: "POST",

                        data: {
                            id: id
                        },

                        success: function(data) {
                            //alertify.success('Data Deleted Successfully').delay(8).dismissOthers();

                            datatable.ajax.reload(null, false)
                        }
                    })

                }
            }

        })



        /*account head delete*/
        $("body").on('click', '.delete_btn', function() {

            if (!confirm('Are you absolutely sure you want to delete?')) return;
            var id = $(this).data('id');
            $.ajax({

                url: "<?php echo base_url(); ?>Accounts/PettyCashVoucher/Delete",

                method: "POST",

                data: {
                    id: id
                },

                success: function(data) {

                    var data = JSON.parse(data);
                    
                    if(data.status === 1){
                        
                        alertify.success(data.msg).delay(2).dismissOthers();

                        datatable.ajax.reload(null,false);
 
                    } else{

                        alertify.error(data.msg).delay(2).dismissOthers();
                    } 
                }


            });

        });
        /*###*/



        /*data table start*/


        function initializeDataTable() {


            datatable = $('#accountTable').DataTable({
                'stateSave': true,
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url': "<?php echo base_url(); ?>Accounts/PettyCashVoucher/FetchData",
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
                        data: 'pcv_id'
                    },
                    {
                        data: 'pcv_voucher_no'
                    },
                    {
                        data: 'pcv_date'
                    },
                    {
                        data: 'pcv_pay_method'
                    },
                    {
                        data: 'bank_name'
                    },
                    {
                        data: 'pcv_total'
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





        /* If Cheque  */

        $('select[name=p_method]').change(function() {

            if ($(this).children(':selected').text() == "Cheque") {
                $('.cheque_sec').removeClass("d-none");
            } else {
                $('.cheque_sec').addClass("d-none");
            }

            if ($(this).children(':selected').text() == "Cash") {
                $('#bank_sec_add').addClass("d-none");

            } else {
                $('#bank_sec_add').removeClass("d-none");
            }

            if($(this).children(':selected').val() == "")
            {
                $('#bank_sec_add').addClass("d-none");
            }

        });






        /* ### */



        /* Show Invoices after reference */


        $('input[name=amount]').focusout(function() {


            $('#AddModal').modal('hide');
            $('#InvoicesModal').modal('show');


        });


        /* ### */






        $('#sales_order_add').submit(function(e) {

            e.preventDefault();

            alertify.success('Saved!').delay(3).dismissOthers();

            $('#SalesOrderModal').modal('hide');

            $('#AddModal').modal('show');


        });





        /* Sales Order  */

        $("body").on('click', '.lpo_add_more', function() {

            var cc = $('.lpo_row').length;

            if (cc < 30) {

                cc++;

                var $clone = $('.lpo_row:first').clone();

                $clone.find("input").val("");

                $clone.find("select").val("");

                $clone.find(".lpo_slno").html(cc);

                $clone.find(".lpo_del_elem").show();

                $clone.insertAfter('.lpo_row:last');

            }

        });


        $(document).on("click", ".lpo_del_elem", function() {
            $(this).closest('.lpo_row').remove();
            cc--;
            //totalCalcutate();                                                                           
            //grossCalculate();
        });

        /**/

        function lpo_slno() {

            var pp = 1;

            $('body .lpo_row').each(function() {

                $(this).find('.lpo_slno').html('<td class="si_no">' + pp + '</td>');

                pp++;

            });

        }


        /* ### */





        $("body").on('submit', '#invoices_add', function(e) {

            e.preventDefault();

            var total = parseFloat($('#fifo_add').data('total')) || 0;

            var invoice_total = 0.00;

            $('.invoice_receipt_amount').each(function() {

                parent = $(this).closest('tr');

                invoice_total += parseFloat(parent.find('.invoice_receipt_amount').val()) || 0;

            })

            $('.po_advance_amount').each(function() {

                parent = $(this).closest('tr');

                invoice_total += parseFloat(parent.find('.po_advance_amount').val()) || 0;

            })

            if (invoice_total > total) {

                alertify.error('Amount should not be greater than credit amount!').delay(3).dismissOthers();

                return false;

            }


            if (invoice_total < total) {

                alertify.error('Total payment amount should be adjusted!').delay(3).dismissOthers();

                return false;

            }

            $('#invoices_add').serialize();

            $.ajax({

                url: "<?php echo base_url(); ?>Accounts/PettyCashVoucher/AddInvoices",

                method: "POST",

                data: $(this).serialize(),

                success: function(data) {

                    alertify.success('Saved!').delay(3).dismissOthers();

                    $('#InvoicesModal').modal('hide');

                    $('#AddModal').modal('show');

                }

            });


        });





        $('.add_model_btn').click(function() {

            $('#added_id').val('');

            $('#add_saved').val("no");

            $('#total_amount').html('0.00');

            $('#total_amount_val').val('0.00');

            $('#add_form')[0].reset();

            //$('.add_credit_account_select2').val('').trigger('change');

            $('.add_credit_account_select2').val('').trigger('change');

            $('.debit_account_select2').val('').trigger('change');


            $('.invoice_row').not(':first').remove();

            InitAccountsSelect2('.debit_account_select2', '.invoice_row');

            $.ajax({

                url : "<?php echo base_url(); ?>Accounts/PettyCashVoucher/AddAccess",

                method : "POST",

                success:function(data)
                {

                    var data = JSON.parse(data);

                    if(data.status === 0){
                    
                        alertify.error(data.msg).delay(3).dismissOthers();

                    }
                    else{

                        $('#AddModal').modal('show');

                    }
                    

                }

            });

            $.ajax({

                url: "<?php echo base_url(); ?>Accounts/PettyCashVoucher/FetchReference",

                method: "GET",

                success: function(data) {

                    $('#uid').val(data);

                }

            });


            $.ajax({

            url: "<?php echo base_url(); ?>Accounts/PettyCashVoucher/ResetSess",

            method: "GET",

            success: function() {
            }
            })


        });


       

        $(document).on('input change', '.invoice_receipt_amount,.po_advance_amount',function(event) {
            // Debugging: Check if the function is called and with correct element
       

            event = event || window.event;

            parent = $(this).closest('tr');

            var receipt_total = parseFloat($('#fifo_add').data('total')) || 0; // Initial balance
            var max_receipt = parseFloat(parent.find('.invoice_total_amount').val()) || 0;

            var val = parseFloat($(this).val()) || 0; // Current value entered
            var max = parseFloat($(this).attr('data-max')) || max_receipt; // Use data-max for proper validation

          

            // Ensure the value doesn't exceed the maximum allowed for the field
            /*
            if (val > max) {
                $(this).val(max);
                $(this).trigger('change');
                val = max; // Set val to max for further calculations
            }
            */

            // Calculate the total of all other fields
            var sum = 0;
            $('.invoice_receipt_amount').each(function() {
                if (this !== event.target) {
                    sum += parseFloat($(this).val()) || 0;
                }
            });

           

            // If the sum plus the current value exceeds the initial balance
            if (sum + val > receipt_total) {
                // Adjust the current field value so the sum equals the receipt_total
                val = receipt_total - sum;
                $(this).val(val).trigger('change');
            }

          
            // Handle the checkbox based on the value entered
            if (max_receipt != val) {
                parent.find('.invoice_add_check').prop('checked', false);
            } else {
                parent.find('.invoice_add_check').prop('checked', true);
            }

            // Update balance and other totals if necessary
            CalcBalance();
        });






        function CalcBalance() {

            LinkAdjusted = 0;
            // alert();

            balance = 0;

           

            $('body .invoice_receipt_amount').each(function() {

                LinkAdjusted += parseFloat($(this).val()) || 0;

            });

            LinkTotal = parseFloat($('.credit_amount').val()) || 0;


             $('body .po_advance_amount').each(function() {

                LinkAdjusted += parseFloat($(this).val()) || 0;

             });

            //alert('link total : '+LinkTotal+' | Link Adjusted : '+LinkAdjusted)

            balance = LinkTotal - LinkAdjusted;

            balance = Math.max(0, balance);

            $('.invoice_balance').html(balance);



            if (LinkAdjusted > LinkTotal) {

                LinkAdjusted = LinkTotal;

            }

            //  alert(balance + '|' + LinkAdjusted);


            $('.invoice_adjusted').html(LinkAdjusted);


          //  alert(balance);

        }

        if (balance < LinkAdjusted) {

            //return false;

        } else {

            //return true;    

        }




        function CalcBalanceEdit() {

            LinkAdjusted = 0;

            balance = 0;

            $('#InvoicesLinkEditModal .invoice_receipt_amount').each(function() {

                LinkAdjusted += parseFloat($(this).val()) || 0;

            });


            $('body .so_receipt_amount').each(function() {

                LinkAdjusted += parseFloat($(this).val()) || 0;

            });

            balance = LinkTotal - LinkAdjusted;


            balance = Math.max(0, balance);

            $('.invoice_balance_edit').html(balance);

            $('.invoice_adjusted_edit').html(LinkAdjusted);

        }




        // $("body").on('change', '.invoice_add_check', function() {

        //     parent = $(this).closest('tr');

        //     var total = $('#fifo_add').data('total');

        //     if ($(this).prop('checked') == true)

        //     {

        //         var total_amount = parent.find('.invoice_total_amount').val();

        //         var fill_amount = Math.min(total, total_amount);

        //         parent.find('.invoice_receipt_amount').val(fill_amount);

        //     } else {

        //         parent.find('.invoice_receipt_amount').val(0);

        //     }

        //     $('.invoice_receipt_amount').trigger('change');


        // });

        $(document).on('change', '.invoice_add_check', function(event) {

            parent = $(this).closest('tr');

            // Parse the total and total_amount as floats to ensure numeric comparison
            var total = parseFloat($('#fifo_add').data('total')) || 0;
            var total_amount = parseFloat(parent.find('.invoice_total_amount').val()) || 0;

             console.log(total + ' | ' + total_amount);

            // If total is less than total_amount, uncheck the box and prevent the default action
            if (total < total_amount) {
                //console.log("point 1");

                // Uncheck the checkbox
                $(this).prop('checked', false);

                // Prevent the default action
                event.preventDefault();
                return false;
            }

            // If the checkbox is checked
            if($(this).prop('checked') == true) {
               // console.log("point 2");

                // Fill the amount with the minimum between total and total_amount
                var fill_amount = Math.min(total, total_amount);
                parent.find('.invoice_receipt_amount').val(fill_amount);

                // Trigger the change event on the receipt amount
                parent.find('.invoice_receipt_amount').trigger('change');

            }else{
               // console.log("point 3");

                // If unchecked, set the receipt amount to 0
                parent.find('.invoice_receipt_amount').val(0);

                // Trigger the change event on the receipt amount
                parent.find('.invoice_receipt_amount').trigger('change');
            }

        });




        $("body").on('keyup', '.credit_amount', function() {

            value = parseFloat($(this).val()) || 0;

            max = parseFloat($(this).attr('data-max')) || 0;



            /*
            if ((max != "") && (value > max)) {

                alertify.error('Cannot be greater than pending amounts!').delay(3).dismissOthers();

                $(this).val(max);

            }



            if (max == "") {

                alertify.error('No pending amount to debit!').delay(3).dismissOthers();

                $(this).val(max);

            }
            */


            TotalAmount();

        });




        //Update Invoices

        $('body').on('click', '.update_invoice_btn', function() {

            var id = $(this).data('id');

            parent = $(this).closest('.view_debit');

            var debit_id = parent.find('input[name=debit_id]').val();

            var date = parent.find('input[name=date]').val();

            var debit_account = parent.find('select[name=c_name]').val();

            var amount = parent.find('input[name=amount]').val();

            var narration = parent.find('input[name=remarks]').val();

            $.ajax({

                url: "<?php echo base_url(); ?>Accounts/Payments/UpdateDebitDetails",

                method: "POST",

                data: {
                    d_id: debit_id,
                    d_date: date,
                    d_account: debit_account,
                    d_amount: amount,
                    d_narration: narration
                },

                success: function(data) {

                    var data = JSON.parse(data);

                    $('#view' + data.inv_id + '').html(data.debit);

                    $('#total_amount_edit').html(data.total);

                    $('#view' + data.inv_id + '').find('.edit').hide();

                    $('#view' + data.inv_id + '').find('.view').fadeIn(200);

                }
            });

        });

        //#########


        //Cancel Credit Edit

        $('body').on('click', '.cancel_invoice_btn', function() {

            var id = $(this).data('id');

            $('#view' + id + '').find('.edit').hide();

            $('#view' + id + '').find('.view').fadeIn(200);

        });





        $("body").on('click', '.del_debit', function() {

            if (!confirm('Delete this debit?')) {
                return false;
            }

            var id = $(this).data('id');

            $.ajax({

                url: "<?php echo base_url(); ?>Accounts/Payments/DeleteDebit",

                method: "POST",

                data: {
                    id: id
                },

                success: function(data) {

                    var data = JSON.parse(data);

                    $('#view' + id + '').fadeOut(300).remove();

                    $('#total_amount_edit').html(data.total);

                    alertify.error('Data Deleted Successfully').delay(3).dismissOthers();

                }

            });


        });









        //




        //New Edit



        //Linked Edit View


        $('body').on('click', '.edit_invoice_add', function() {

            var pid = $('#p_id_edit').val();

            var parent = $(this).closest('.edit_add_debit');

            var date = parent.find('.debit_date').val();

            var account = parent.find('.debit_account').val();


            var amount = parent.find('.debit_amount').val();

            var narration = parent.find('.debit_narration').val();

            if ((date == "") || (account == "") || (amount == "")) {

                alertify.error('Fill required fields').delay(3).dismissOthers();

                return false;

            }

            $.ajax({

                url: "<?php echo base_url(); ?>Accounts/Payments/EditAddDebit",

                method: "POST",

                data: {
                    pid: pid,
                    date: date,
                    account: account,
                    amount: amount,
                    narration: narration
                },

                success: function(data) {

                    var data = JSON.parse(data);

                    $('#sel_invoices_edit').append(data.debit);

                    $('#total_amount_edit').html(data.total);

                    parent.find(':input').val('');

                }
            });


        });





        /* Accounts Init Select 2 */

        function InitAccountsSelect2(classname, parent) {
            $('body ' + classname + ':last').select2({
                placeholder: "Select Account",
                theme: "default form-control-",
                dropdownParent: $($('' + classname + ':last').closest('' + parent + '')),
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
        }


        InitAccountsSelect2('.add_credit_account_select2', '.select2_parent');

        InitAccountsSelect2('.edit_credit_account_select2', '.select2_parent');

        InitAccountsSelect2('.debit_account_select2', '.invoice_row');

        /* ### */


        function SOSelect2() {
                           
                           $('.so_select2_add:last').select2({
                               placeholder: "Select Sales Order", // This is the placeholder
                               theme: "default form-control-",
                               dropdownParent: $($('.so_select2_parent_add:last').closest('.invoice_row')),
                               allowClear: true, // Allows clearing the selection
                               ajax: {
                                   url: "<?= base_url(); ?>Accounts/JournalVouchers/FetchSalesOrders",
                                   dataType: 'json',
                                   delay: 250,
                                   cache: false,
                                   minimumInputLength: 1,
                                   data: function(params) {
                                       return {
                                           term: params.term,
                                           page: params.page || 1,
                                       };
                                   },
                                   processResults: function(data, params) {
                                       var page = params.page || 1;
                                       return {
                                           results: [
                                               { id: null, text: "Select Sales Order" }, // Default null option
                                               ...$.map(data.result, function(item) {
                                                   return {
                                                       id: item.so_id,
                                                       text: item.so_reffer_no
                                                   };
                                               })
                                           ],
                                           pagination: {
                                               more: (page * 10) <= data.total_count
                                           }
                                       };
                                   },
                               }
                           });
                          
                       }
                       SOSelect2();




        /* Select 2 Remove Validation On Change */
        $(".add_credit_account_select2").on("change", function(e) {
            $(this).parent().find(".error").removeClass("error");
        });
        /*###*/




        $('body').on('click', '#add_poadvance_btn', function() {

            var vendor_id = $(this).sdata('vendor');

            var debit_id = $(this).data('debitid');

            //parent = $(this).closest('.invoice_row');

            //var parent = $(this).closest('.invoice_row');

            $.ajax({

                url: "<?php echo base_url(); ?>Accounts/Payments/FetchPOAdvance",

                method: "POST",

                data: {
                    vendor: vendor_id,
                    d_id : debit_id
                },

                success: function(data) {

                    var data = JSON.parse(data);

                    $('#InvoicesModal').modal('hide');

                    $('#AddPOAdvanceModal').modal('show');

                    $('#purchase_order_add').html(data.po_rows);

                }

            });




        });




        $("body").on('submit', '#add_po_advance_form', function(e) {

                    e.preventDefault();

                    $('#add_po_advance_form').serialize();

                    $.ajax({

                        url: "<?php echo base_url(); ?>Accounts/PettyCashVoucher/AddPoAdvance",

                        method: "POST",

                        data: $(this).serialize(),

                        success: function(data) {

                            alertify.success('Saved!').delay(3).dismissOthers();

                            $('#AddPOAdvanceModal').modal('hide');

                            alertify.success('Saved!').delay(3).dismissOthers();

                            $('#InvoicesModal').modal('show');

                        }

                    });


                    });






    });











    function TotalAmount() {

        var total = 0;

        $('body .credit_amount').each(function() {
            var sub_tot = parseFloat($(this).val());

            total += parseFloat(sub_tot.toFixed(2)) || 0;
            //total = Number(total).toFixed(2)
        });

        total = total.toFixed(2);

        $('#total_amount').html(total);

        $('#total_amount_val').val(total);


        var resultQuotation = total;

        $(".sales_quotation_amount_in_word").text(resultQuotation);

        $(".sales_quotation_amount_in_word_val").val(resultQuotation);


    }
</script>