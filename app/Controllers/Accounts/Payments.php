<?php

namespace App\Controllers\Accounts;

use App\Controllers\BaseController;

use NumberToWords\NumberToWords;


class Payments extends BaseController
{


    public function FetchData()
    {

        /*pagination start*/
        $request = service('request');
        $postData = $request->getPost();
        $dtpostData = $postData['data'];
        $response = array();

        ## Read value
        $draw = $dtpostData['draw'];
        $start = $dtpostData['start'];
        $rowperpage = $dtpostData['length']; // Rows display per page
        $columnIndex = $dtpostData['order'][0]['column']; // Column index
        $columnName = $dtpostData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $dtpostData['order'][0]['dir']; // asc or desc
        $searchValue = $dtpostData['search']['value']; // Search value

        // Check if the current sort order is 'asc', then set it to 'desc'
        if ($columnSortOrder === 'asc') {
            $columnSortOrder = 'desc';
        }


        ## Total number of records without filtering

        $totalRecords = $this->common_model->GetTotalRecords('accounts_payments', 'pay_id', 'DESC');

        ## Total number of records with filtering

        $searchColumns = array('pay_ref_no');

        $totalRecordwithFilter = $this->common_model->GetTotalRecordwithFilter('accounts_payments', 'pay_id', $searchValue, $searchColumns);

        ##Joins if any //Pass Joins as Multi dim array
        $joins = array(

            array(
                'table' => 'master_receipt_method',
                'pk' => 'rm_id',
                'fk' => 'pay_method',
            ),

            array(
                'table' => 'master_banks',
                'pk' => 'bank_id',
                'fk' => 'pay_bank',
            ),

            /*
            array(
                'table' => 'accounts_charts_of_accounts',
                'pk' => 'ca_id',
                'fk' => 'pay_debit_account',
                ),
                */

        );
        ## Fetch records
        $records = $this->common_model->GetRecord('accounts_payments', 'pay_id', $searchValue, $searchColumns, $columnName, $columnSortOrder, $joins, $rowperpage, $start);

        $data = array();

        $i = 1;
        foreach ($records as $record) {

            $action = '<a  href="javascript:void(0)" class="edit edit-color view_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="' . $record->pay_id . '" data-original-title="Edit"><i class="ri-eye-fill"></i> View</a> <a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="' . $record->pay_id . '" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a> <a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="' . $record->pay_id . '"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> Delete</a>';

            $data[] = array(
                "pay_id" => $i,
                'date' => date('d-m-Y', strtotime($record->pay_date)),
                "pay_ref_no" => $record->pay_ref_no,
                'pay_method' => $record->rm_name,
                "bank" => $record->bank_name ?? "--",
                "action" => $action,
            );
            $i++;
        }

        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data,
            "token" => csrf_hash() // New token hash
        );

        //return $this->response->setJSON($response);

        echo json_encode($response);

        exit;

        /*pagination end*/
    }



    //view page
    public function index()
    {

        $data['p_methods'] = $this->common_model->FetchAllOrder('master_receipt_method', 'rm_name', 'asc');

        $data['banks'] = $this->common_model->FetchAllOrder('master_banks', 'bank_name', 'asc');

        $data['accounts'] = $this->common_model->FetchAllOrder('accounts_charts_of_accounts', 'ca_name', 'asc');

        $data['collectors'] = $this->common_model->FetchAllOrder('master_collectors', 'col_name', 'asc');

        $data['customers'] = $this->common_model->FetchAllOrder('crm_customer_creation', 'cc_customer_name', 'asc');

        $data['content'] = view('accounts/payments', $data);

        return view('accounts/accounts-module', $data);
    }


    public function Add()
    {
        if (empty($this->request->getPost('p_debit_account'))) {
            $return['status'] = 0;
            $return['error'] = "Enter debit details!";
        } else {
            $return['status'] = 1;

            $insert_data['pay_date'] = date('Y-m-d', strtotime($this->request->getPost('p_date')));
            $insert_data['pay_credit_account'] = $this->request->getPost('p_credit_account');
            $insert_data['pay_method'] = $this->request->getPost('p_method');
            $insert_data['pay_amount'] = $this->request->getPost('p_amount');

            if ($this->request->getPost('p_method') == "1") {
                $insert_data['pay_cheque_no'] = $this->request->getPost('p_cheque_no');
                $insert_data['pay_cheque_date'] = date('Y-m-d', strtotime($this->request->getPost('p_cheque_date')));
            }

            if ($this->request->getPost('p_method') != "2") {
                $insert_data['pay_bank'] = $this->request->getPost('p_bank');
            }

            if (empty($this->request->getPost('p_id'))) {
                // Insert new payment
                $insert_data['pay_added_by'] = 1;
                $insert_data['pay_added_date'] = date('Y-m-d');

                if ($_FILES['p_cheque_copy']['name'] !== '') {
                    $ccAttachCrFileName = $this->uploadFile('p_cheque_copy', 'uploads/Payments');
                    $update_data['pay_cheque_copy'] = $ccAttachCrFileName;
                }

                $id = $this->common_model->InsertData('accounts_payments', $insert_data);

                // Generate reference number for new payment
                $p_ref_no = 'PAY' . str_pad($id, 7, '0', STR_PAD_LEFT);

                $cond = array('pay_id' => $id);
                $update_data['pay_ref_no'] = $p_ref_no;

                $this->common_model->EditData($update_data, $cond, 'accounts_payments');

                // Add to Transactions
                $trans_data['tran_reference'] = $p_ref_no;
                $trans_data['tran_account'] = $insert_data['pay_credit_account'];
                $trans_data['tran_credit'] = $insert_data['pay_amount'];
                $trans_data['tran_type'] = "Payment";
                $this->common_model->InsertData('master_transactions', $trans_data);
            } else {
                // Update existing payment
                $id = $this->request->getPost('p_id');

                $p_cond = array('pay_id' => $id);
                $this->common_model->EditData($insert_data, $p_cond, 'accounts_payments');

                // Retrieve existing reference number
                $existing_payment = $this->common_model->SingleRow('accounts_payments', $p_cond);
                $p_ref_no = $existing_payment->pay_ref_no; // Fetch existing reference number
            }

            $return['id'] = $id;

            // Process debit accounts
            if (!empty($this->request->getPost('p_debit_account'))) {
                for ($i = 0; $i < count($this->request->getPost('p_debit_account')); $i++) {
                    $check_debit = $this->common_model->SingleRow('accounts_payment_debit', array('pd_payment' => $id, 'pd_debit_account' => $_POST['p_debit_account'][$i]));

                    $insert_inv_data['pd_payment'] = $id;
                    $insert_inv_data['pd_debit_account'] = $_POST['p_debit_account'][$i];
                    $insert_inv_data['pd_payment_amount'] = $_POST['inv_amount'][$i];
                    $insert_inv_data['pd_remarks'] = $_POST['narration'][$i];

                    // Add to Transactions
                    $debit_trans_data['tran_reference'] = $p_ref_no;
                    $debit_trans_data['tran_account'] = $_POST['p_debit_account'][$i];
                    $debit_trans_data['tran_debit'] = $insert_inv_data['pd_payment_amount'];
                    $debit_trans_data['tran_type'] = "Payment";

                    $this->common_model->InsertData('master_transactions', $debit_trans_data);

                    if (empty($check_debit)) {
                        $this->common_model->InsertData('accounts_payment_debit', $insert_inv_data);
                    } else {
                        $this->common_model->EditData($insert_inv_data, array('pd_id' => $check_debit->pd_id), 'accounts_payment_debit');
                    }
                }
            }
        }

        echo json_encode($return);
    }



    //##



    //refresh table with ajax

    //account head modal 
    public function Edit()
    {

        $cond = array('pay_id' => $this->request->getPost('id'));

        $joins = array(
            array(
                'table' => 'accounts_charts_of_accounts',
                'pk' => 'ca_id',
                'fk' => 'pay_credit_account',
            ),
        );

        $data['pay'] = $this->common_model->SingleRowJoin('accounts_payments', $cond, $joins);

        $customers = $this->common_model->FetchAllOrder('accounts_charts_of_accounts', 'ca_name', 'asc');


        $debit_cond = array('pd_payment' => $data['pay']->pay_id);

        $debit_joins = array(
            array(
                'table' => 'accounts_charts_of_accounts',
                'pk' => 'ca_id',
                'fk' => 'pd_debit_account',
            ),
        );

        $debits = $this->common_model->FetchWhereJoin('accounts_payment_debit', $debit_cond, $debit_joins);

        $data['debit'] = "";

        $dd = '';

        foreach ($customers as $cus) {

            $dd .= '<option value="' . $cus->ca_id . '">' . $cus->ca_name . '</option>';
        }


        foreach ($debits as $debit) {

            $data['debit'] .= '
        <tr class="view_debit" id="view' . $debit->pd_id . '">
        <input type="hidden" id="debit_id_edit" name="debit_id" value="' . $debit->pd_id . '">

       


        <td>

        <p class="view">' . $debit->ca_name . '</p>

        <select style="display:none;" class="edit form-control" name="c_name">

        <option value="' . $debit->ca_id . '" selected hidden>' . $debit->ca_name . '</option>

        ' . $dd . '
        
        </select>
       
        </td>


        <td>
        
        <p class="view">' . $debit->pd_payment_amount . '</p>

        <input style="display:none;" class="edit form-control" type="number" name="amount" value="' . $debit->pd_payment_amount . '">
        
        </td>


        <td>

         <p class="view">' . $debit->pd_remarks . '</p>

         <input style="display:none;" class="edit form-control" type="text" name="remarks" value="' . $debit->pd_remarks . '">
        
        </td>


        <td>
        
        <div class="view">

        <!--<a href="javascript:void(0);" class="edit_invoice btn btn-primary" data-id="' . $debit->pd_id . '">Edit</a>-->

        <!--<a href="javascript:void(0);" class="view_linked btn btn-warning" data-id="' . $debit->pd_id . '">Linked</a>-->

        <a href="javascript:void(0);" class="del_debit btn btn-danger" data-id="' . $debit->pd_id . '">Delete</a>

        </div>

        <div class="edit" style="display:none;">
        
        <button class="btn btn-success update_invoice_btn" type="button">Update</button>

        <button class="btn btn-danger cancel_invoice_btn" data-id="' . $debit->pd_id . '" type="button">Cancel</button>

        </div>

        </td>

        </tr>

        ';
        }


        echo json_encode($data);
    }



    // update account head 
    public function Update()
    {
        $cond = array('pay_id' => $this->request->getPost('p_id'));

        $update_data['pay_date'] = date('Y-m-d', strtotime($this->request->getPost('p_date')));

        //$update_data['pay_credit_account'] = $this->request->getPost('p_credit_account');

        $update_data['pay_method'] = $this->request->getPost('p_method');

        if ($this->request->getPost('p_method') == "1") {

            $update_data['pay_cheque_no'] = $this->request->getPost('p_cheque_no');

            $update_data['pay_cheque_date'] = date('Y-m-d', strtotime($this->request->getpost('p_cheque_date')));

            if ($_FILES['p_cheque_copy']['name'] !== '') {

                $ccAttachCrFileName = $this->uploadFile('p_cheque_copy', 'uploads/Payments');
                $update_data['pay_cheque_copy'] = $ccAttachCrFileName;
            }
        } else {

            $update_data['pay_cheque_no'] = NULL;

            $update_data['pay_cheque_date'] = NULL;
        }

        $update_data['pay_amount'] = $this->request->getPost('p_amount');

        $update_data['pay_bank'] = $this->request->getPost('p_bank');

        $this->common_model->EditData($update_data, $cond, 'accounts_payments');
    }





    public function UpdateDebitDetails()
    {

        if ($_POST) {

            $id = $this->request->getPost('d_id');

            $cond = array('pd_id' => $id);

            $date = date('Y-m-d', strtotime($this->request->getPost('d_date')));

            $debit_account = $this->request->getPost('d_account');

            $amount = $this->request->getPost('d_amount');

            $narration = $this->request->getPost('d_narration');

            $update_data['pd_debit_account'] = $debit_account;

            $update_data['pd_payment_amount'] = $amount;

            $update_data['pd_remarks'] = $narration;

            //$update_data['pd_date'] = $date;

            $this->common_model->EditData($update_data, $cond, 'accounts_payment_debit');

            $this->FetchDebitData($id);
        }
    }



    public function FetchDebitData($id, $tr = "")
    {

        $invoice_cond = array('pd_id' => $id);

        $data['inv_id'] =  $id;

        $invoice_joins = array(
            array(
                'table' => 'accounts_charts_of_accounts',
                'pk' => 'ca_id',
                'fk' => 'pd_debit_account',
            ),
        );

        $debit = $this->common_model->SingleRowJoin('accounts_payment_debit', $invoice_cond, $invoice_joins);

        //Recalculate Total

        $pay_id = $debit->pd_payment;

        $all_debits = $this->common_model->FetchWhere('accounts_payment_debit', array('pd_payment' => $pay_id));

        $total = 0;

        foreach ($all_debits as $deb_tot) {

            $total = $total += $deb_tot->pd_payment_amount;
        }

        $payment_data['pay_amount'] = $total;

        $payment_cond['pay_id'] = $pay_id;

        $this->common_model->EditData($payment_data, $payment_cond, 'accounts_payments');

        $data['total'] = $total;

        //

        $customers = $this->common_model->FetchAllOrder('accounts_charts_of_accounts', 'ca_name', 'asc');

        $dd = '';

        foreach ($customers as $cus) {

            $dd .= '<option value="' . $cus->ca_id . '">' . $cus->ca_name . '</option>';
        }


        $data['debit'] = "";


        if ($tr != "") {

            $data['debit'] .= '<tr class="view_debit" id="view' . $debit->pd_id . '">';
        }


        $data['debit'] .= '
   
    <input type="hidden" id="debit_id_edit" name="debit_id" value="' . $debit->pd_id . '">


    <td>

    <p class="view">' . $debit->ca_name . '</p>

    <select style="display:none;" class="edit form-control" name="c_name">

    <option value="' . $debit->ca_id . '" selected hidden>' . $debit->ca_name . '</option>

    ' . $dd . '
    
    </select>
   
    </td>


    <td>
    
    <p class="view">' . $debit->pd_payment_amount . '</p>

    <input style="display:none;" class="edit form-control" type="number" name="amount" value="' . $debit->pd_payment_amount . '">
    
    </td>


    <td>

     <p class="view">' . $debit->pd_remarks . '</p>

     <input style="display:none;" class="edit form-control" type="text" name="remarks" value="' . $debit->pd_remarks . '">
    
    </td>


    <td>
    
    <div class="view">
    <!--<a href="javascript:void(0);" class="edit_invoice btn btn-primary" data-id="' . $debit->pd_id . '">Edit</a>-->
    
    <a href="javascript:void(0);" class="view_linked btn btn-warning" data-id="' . $debit->pd_id . '">Linked</a>

    <a href="javascript:void(0);" class="del_debit btn btn-danger" data-id="' . $debit->pd_id . '">Delete</a>

    </div>

    <div class="edit" style="display:none;">
    
    <button class="btn btn-success update_invoice_btn" type="button">Update</button>

    <button class="btn btn-danger cancel_invoice_btn" data-id="' . $debit->pd_id . '" type="button">Cancel</button>

    </div>

    </td>

    ';

        if ($tr != "") {

            $data['debit'] .= "</tr>";
        }

        echo json_encode($data);
    }




    public function DeleteDebit()
    {

        if ($_POST) {

            $id = $this->request->getPost('id');

            $cond = array('pd_id' => $id);

            $payment = $this->common_model->SingleRow('accounts_payment_debit', $cond);

            $pay_id = $payment->pd_payment;


            $this->common_model->DeleteData('accounts_payment_debit', $cond);

            $cond_data = array('pdi_debit_id' => $id);

            $this->common_model->DeleteData('accounts_payment_debit_invoices', $cond_data);


            //Recalculate Total

            $all_debits = $this->common_model->FetchWhere('accounts_payment_debit', array('pd_payment' => $pay_id));

            $total = 0;

            foreach ($all_debits as $deb_tot) {

                $total = $total += $deb_tot->pd_payment_amount;
            }


            $pay_data['pay_amount'] = $total;

            $pay_cond['pay_id'] = $pay_id;

            $this->common_model->EditData($pay_data, $pay_cond, 'accounts_payments');

            $data['total'] = $total;

            echo json_encode($data);
        }
    }








    public function EditPfInvoice()
    {

        $cond = array('pdi_debit_id' => $this->request->getPost('id'));

        $joins = array(

            array(
                'table' => 'crm_proforma_invoices',
                'pk' => 'pf_id',
                'fk' => 'pdi_invoice',
            ),

        );


        $invoices = $this->common_model->FetchWhereJoin('accounts_payment_debit_invoices', $cond, $joins);

        $data['status'] = 0;

        $data['invoices'] = "";

        $sl = 0;
        foreach ($invoices as $inv) {
            $sl++;

            $data['invoices'] .=

                '
        <tr class="view_pf_invoice" id="edit_pf' . $inv->pdi_id . '">

        <input type="hidden" name="ri_id" value="' . $inv->pdi_id . '">

        <th>' . $sl . '</th>

        <th>

        <p class="">' . date('d-F-Y', strtotime($inv->pdi_date)) . '</p>

        </th>


        <th>

        <p class="">' . $inv->pf_reffer_no . '</p>

        </th>


        <th>

        <p class="view">' . $inv->pdi_lpo_ref . '</p>

        <input style="display:none;" class="form-control edit" name="lpo_ref" type="text" value="' . $inv->pdi_lpo_ref . '">
        
        </th>
        
        <th>
        
        <p class="">' . $inv->pf_total_amount . '</p>

        </th>

        <th>

        <p class="view">' . $inv->pdi_payment_amount . '</p>

        <input style="display:none;" class="form-control edit" name="inv_receipt_amount" type="number" value="' . $inv->pdi_payment_amount . '">
        
        </th>

        <th>

        <div class="view">

        <a href="javascript:void(0);" class="edit_pf_invoice btn btn-primary" data-id="' . $inv->pdi_id . '">Edit</a>
        
        </div>

        <div class="edit" style="display:none;">
        
        <button class="btn btn-success update_pf_invoice_btn" data-id="' . $inv->pdi_id . '" type="button">Update</button>

        <button class="btn btn-danger cancel_pf_invoice_btn" data-id="' . $inv->pdi_id . '" type="button">Cancel</button>

        </div>
        
        </th>

        </tr>';

            $data['status'] = 1;
        }

        echo json_encode($data);
    }



    public function UpdatePfDetails()
    {

        $id = $this->request->getPost('id');

        $cond = array('pdi_id' => $id);

        $update_data['pdi_lpo_ref'] = $this->request->getPost('lpo_ref');

        $update_data['pdi_payment_amount'] = $this->request->getPost('receipt_amount');

        $this->common_model->EditData($update_data, $cond, 'accounts_payment_debit_invoices');

        $this->FetchPfDetails($id);
    }



    public function FetchPfdetails($id)
    {

        $cond = array('pdi_id' => $id);

        $joins = array(

            array(
                'table' => 'crm_proforma_invoices',
                'pk' => 'pf_id',
                'fk' => 'pdi_invoice',
            ),

        );

        $inv = $this->common_model->SingleRowJoin('accounts_payment_debit_invoices', $cond, $joins);

        $sl = 1;

        $data['inv_id'] = $id;

        $data['invoices'] = "";

        $data['invoices'] .=

            '
        <input type="hidden" name="ri_id" value="' . $inv->pdi_id . '">

        <th>' . $sl . '</th>

        <th>

        <p class="">' . date('d-F-Y', strtotime($inv->pdi_date)) . '</p>

        </th>


        <th>

        <p class="">' . $inv->pf_reffer_no . '</p>

        </th>


        <th>

        <p class="view">' . $inv->pdi_lpo_ref . '</p>

        <input style="display:none;" class="form-control edit" name="lpo_ref" type="text" value="' . $inv->pdi_lpo_ref . '">
        
        </th>
    
        <th>
        
        <p class="">' . $inv->pf_total_amount . '</p>

        </th>

        <th>

        <p class="view">' . $inv->pdi_payment_amount . '</p>

        <input style="display:none;" class="form-control edit" name="inv_receipt_amount" type="number" value="' . $inv->pdi_payment_amount . '">
        
        </th>

        <th>

        <div class="view">

        <a href="javascript:void(0);" class="edit_pf_invoice btn btn-primary" data-id="' . $inv->pdi_id . '">Edit</a>
      
        </div>

        <div class="edit" style="display:none;">
        
        <button class="btn btn-success update_pf_invoice_btn" data-id="' . $inv->pdi_id . '" type="button">Update</button>

        <button class="btn btn-danger cancel_pf_invoice_btn" data-id="' . $inv->pdi_id . '" type="button">Cancel</button>

        </div>
        
        </th>

       ';

        echo json_encode($data);
    }

















    public function View()
    {

        $id = $this->request->getPost('id');

        $cond = array('pay_id' => $id);

        ##Joins if any //Pass Joins as Multi dim array
        $joins = array(

            array(
                'table' => 'master_receipt_method',
                'pk' => 'rm_id',
                'fk' => 'pay_method',
            ),

            array(
                'table' => 'master_banks',
                'pk' => 'bank_id',
                'fk' => 'pay_bank',
            ),

            array(
                'table' => 'accounts_charts_of_accounts',
                'pk' => 'ca_id',
                'fk' => 'pay_debit_account',
            ),

        );

        $data['payment'] = $this->common_model->SingleRowJoin('accounts_payments', $cond, $joins);

        $joins_inv = array(

            array(
                'table' => 'crm_proforma_invoices',
                'pk' => 'pf_id',
                'fk' => 'pi_invoice',
            ),

        );

        $invoices = $this->common_model->FetchWhereJoin('accounts_payment_invoices', array('pi_payment' => $id), $joins_inv);

        $data['invoices'] = "";

        foreach ($invoices as $invoice) {

            $data['invoices'] .= "<tr><td>" . date('d-F-Y', strtotime($invoice->pf_date)) . "</td><td>{$invoice->pf_reffer_no}</td><td>{$invoice->pi_remarks}</td><td>{$invoice->pf_total_amount}</td></tr>";
        }

        echo json_encode($data);
    }









    //delete account head
    public function Delete()
    {
        $cond = array('pay_id' => $this->request->getPost('id'));

        $payment = $this->common_model->SingleRow('accounts_payments', $cond);

        $this->common_model->DeleteData('accounts_payments', $cond);

        $cond_tran = array('tran_reference' => $payment->pay_ref_no);

        $this->common_model->DeleteData('master_transactions', $cond_tran);
    }



    /*

    public function FetchInvoices()
    {

    if($_POST)
    {

    $ac_id = $this->request->getPost('id');

    $joins = array(
           
    );

    $customer = $this->common_model->SingleRowJoin('crm_customer_creation',array('cc_account_id' => $ac_id),$joins);

    $cond = array('so_customer' => $customer->cc_id);

    $invoices = $this->common_model->FetchWhere('crm_sales_orders',$cond);

    $data="";

    foreach($invoices as $inv)
    {

    $data.='<tr id="'.$inv->so_id.'">
    <th class="checkbx"><input type="checkbox" name="invoice_selected[]" value="'.$inv->so_id.'"></th>
    <th>'.date('d-m-Y',strtotime($inv->so_date)).'</th>
    <th>'.$inv->so_order_no.'</th>
    <th>'.$inv->so_scheduled_date_of_delivery.'</th>
    <th>'.$inv->so_total.'</th>
    </tr>';

    }

    echo json_encode($data);


    }


    }



    public function SelectedInvoices()
    {

    if($_POST)
    {

    $data['total'] = 0;

    foreach($this->request->getPost('invoice_selected') as $inv)
    {

    $invoice = $this->common_model->SingleRowArray('crm_sales_orders',array('so_id' => $inv));

    $data['html'][] = $invoice;

    $data['total'] = $invoice['so_total']+$data['total'];

    }

   
    echo json_encode($data);

    }



    }

    */




    public function FetchInvoices()
    {

        if ($_POST) {

            $vendor_id = $this->request->getPost('id');


            $insert_data['pd_payment'] = $this->request->getPost('pid');

            $insert_data['pd_debit_account'] = $vendor_id;

            $insert_data['pd_payment_amount'] = $this->request->getPost('camount');

            $insert_data['pd_remarks'] = $this->request->getPost('cnarration');

            //$insert_data['ri_date'] = date('Y-m-d',strtotime($this->request->getPost('cdate')));

            $check_invoice = $this->common_model->SingleRow('accounts_payment_debit', array('pd_payment' => $insert_data['pd_payment'], 'pd_debit_account' => $insert_data['pd_debit_account']));

            if (empty($check_invoice)) {
                $pd_id = $this->common_model->InsertData('accounts_payment_debit', $insert_data);
            } else {

                $update_cond = array('pd_id' => $check_invoice->pd_id);

                $pd_id = $check_invoice->pd_id;

                $this->common_model->EditData($insert_data, $update_cond, 'accounts_payment_debit');
            }


            $joins = array(
                array(
                    'table' => 'pro_vendor',
                    'pk' => 'ven_id',
                    'fk' => 'ca_customer',
                ),
            );

            //$customer = $this->common_model->SingleRowJoin('crm_customer_creation',array('cc_id' => $ac_id),$joins);

            $customer = $this->common_model->SingleRowJoin('accounts_charts_of_accounts', array('ca_id' => $vendor_id), $joins);

            /*
    $cond = array('ci_customer' => $customer->cc_id);

    $invoices = $this->common_model->FetchUnpaidInvoices('crm_cash_invoice',$cond,'ci_paid_status');

    $data['status']=0;

    $data['invoices']="";

    $sl =0;


    foreach($invoices as $inv)
    {

    $sl++;

    $balance_amount = $inv->ci_total_amount - $inv->ci_paid_amount;

    $data['invoices'].='<tr id="'.$inv->ci_id.'">
    <input type="hidden" name="pay_debit_id[]" value="'.$pd_id.'">
    <input type="hidden" name="debit_account_invoice[]" value="'.$ac_id.'">
    <th>'.$sl.'</th>
    <th>'.date('d-m-Y',strtotime($inv->ci_date)).'</th>
    <th>'.$inv->ci_reffer_no.'</th>
    <th><input class="form-control" name="inv_lpo_ref[]" type="text" value="'.$inv->ci_reffer_no.'" required></th>
    
    <th>'.$balance_amount.'
    <input type="hidden" class="invoice_total_amount" name="total_amount" value="'.$balance_amount.'">
    </th>

    <th><input class="form-control invoice_receipt_amount" name="inv_receipt_amount[]" type="number"></th>
    
    <th><input class="invoice_add_check" type="checkbox" name="invoice_selected[]" value="'.$inv->ci_id.'"></th>
    </tr>';

    $data['status']=1;

    }

    */

            $data['status'] = 0;

            $data['invoices'] = "";

            $cond = array('pv_vendor_name' => $vendor_id);

            $purchase_vouchers = $this->account_model->FetchUnpaidPurchaseVoucher($vendor_id);

            $sl = 0;

            foreach ($purchase_vouchers as $pv) {

                $sl++;

                $balance_amount = $pv->pv_total - $pv->pv_paid;

                $data['invoices'] .= '<tr id="' . $pv->pv_id . '">

                 <input type="hidden" name="p_v_id[]" value="' . $pv->pv_id . '">
    <input type="hidden" name="pay_debit_id[]" value="' . $pd_id . '">
    <input type="hidden" name="debit_account_invoice[]" value="' . $vendor_id . '">
    <th>' . $sl . '</th>
    <th>' . date('d-m-Y', strtotime($pv->pv_date)) . '</th>
    <th>' . $pv->pv_reffer_id . '</th>
    <th><input class="form-control" name="inv_lpo_ref[]" type="text" value="' . $pv->pv_reffer_id . '" required></th>
    
    <th>' . $balance_amount . '
    <input type="hidden" class="invoice_total_amount" name="total_amount" value="' . $balance_amount . '">
    </th>

    <th><input class="form-control invoice_receipt_amount" maxlength="' . $balance_amount . '" data-max="'.$balance_amount.'" name="inv_receipt_amount[]" type="number"></th>
    
    <th><input class="invoice_add_check" type="checkbox" name="invoice_selected[]" value="' . $pv->pv_id . '"></th>
    </tr>';

                $data['status'] = 1;
            }

            echo json_encode($data);
        }
    }






    public function FetchPVAdvanceAdd()
    {

        if ($_POST) {

            $vendor_id = $this->request->getPost('id');

            $joins = array(
                array(
                    'table' => 'pro_vendor',
                    'pk' => 'ven_id',
                    'fk' => 'ca_customer',
                ),
            );

            $customer = $this->common_model->SingleRowJoin('accounts_charts_of_accounts', array('ca_id' => $vendor_id), $joins);

            $data['status'] = 0;

            $data['invoices'] = "";

            $cond = array('pv_vendor_name' => $vendor_id);

            $purchase_vouchers = $this->account_model->FetchUnpaidPurchaseVoucher($vendor_id);

            $sl = 0;

            foreach ($purchase_vouchers as $pv) {

                $sl++;

                $balance_amount = $pv->pv_total - $pv->pv_paid;

                $data['invoices'] .= '<tr id="' . $pv->pv_id . '">
    <input type="hidden" name="pay_debit_id[]" value="' . $pd_id . '">
    <input type="hidden" name="debit_account_invoice[]" value="' . $vendor_id . '">
    <th>' . $sl . '</th>
    <th>' . date('d-m-Y', strtotime($pv->pv_date)) . '</th>
    <th>' . $pv->pv_reffer_id . '</th>
    <th><input class="form-control" name="inv_lpo_ref[]" type="text" value="' . $pv->pv_reffer_id . '" required></th>
    
    <th>' . $balance_amount . '
    <input type="hidden" class="invoice_total_amount" name="total_amount" value="' . $balance_amount . '">
    </th>

    <th><input class="form-control invoice_receipt_amount" name="inv_receipt_amount[]" type="number"></th>
    
    <th><input class="invoice_add_check" type="checkbox" name="invoice_selected[]" value="' . $pv->pv_id . '"></th>
    </tr>';

                $data['status'] = 1;
            }

            echo json_encode($data);
        }
    }












    public function FetchReference()
    {

        $uid = $this->common_model->FetchNextId('accounts_payments', "PAY");

        echo $uid;
    }






    public function AddInvoices()
    {

        if ($_POST) {

            for ($i = 0; $i < count($this->request->getPost('inv_receipt_amount')); $i++) {

                $invoice_id = $this->request->getPost('p_v_id')[$i];

                $receipt_amount  = $this->request->getPost('inv_receipt_amount')[$i];

                // if(isset($this->request->getPost('invoice_selected')[$i]))

                // {

                $insert_data['pdi_debit_id'] = $this->request->getPost('pay_debit_id')[$i];

                $insert_data['pdi_invoice'] = $this->request->getPost('debit_account_invoice')[$i];

                $insert_data['pdi_lpo_ref'] = $this->request->getPost('inv_lpo_ref')[$i];

                $insert_data['pdi_payment_amount'] = $this->request->getPost('inv_receipt_amount')[$i];

                $check_invoice = $this->common_model->SingleRow('accounts_payment_debit_invoices', array('pdi_invoice' => $insert_data['pdi_invoice'], 'pdi_debit_id' => $insert_data['pdi_debit_id']));

                if (empty($check_invoice)) {
                    $pdi_id = $this->common_model->InsertData('accounts_payment_debit_invoices', $insert_data);
                } else {

                    $update_cond = array('pdi_id' => $check_invoice->pdi_id);

                    $pdi_id = $this->common_model->EditData($insert_data, $update_cond, 'accounts_payment_debit_invoices');
                }

                //}

                //  print_r($insert_data);

                if ($this->request->getPost('inv_receipt_amount')[$i] > 0) {


                    $pv_total = $this->common_model->SingleRowCol('pro_purchase_voucher', 'pv_total', array('pv_id' => $invoice_id));

                    $pv_paid = $this->common_model->SingleRowCol('pro_purchase_voucher', 'pv_paid', array('pv_id' => $invoice_id));

                    $pv_current_paid = $receipt_amount + $pv_paid->pv_paid;

                    if ($pv_total->pv_total == $pv_current_paid) {

                        $pay_status = 2;
                    } else if ($pv_current_paid > 0) {

                        $pay_status = 1;
                    } else {

                        $pay_status = 0;
                    }

                    $update_invoice['pv_paid'] = $pv_current_paid;

                    $update_invoice['pv_status'] = $pay_status;

                    $this->common_model->EditData($update_invoice, array('pv_id' => $invoice_id), 'pro_purchase_voucher');
                }
            }
            // exit;
        }
    }





    public function SelectedInvoices()
    {

        if ($_POST) {

            $data['total'] = 0;

            foreach ($this->request->getPost('invoice_selected') as $inv) {

                $invoice = $this->common_model->SingleRowArray('crm_proforma_invoices', array('pf_id' => $inv));

                $data['html'][] = $invoice;

                $data['total'] = $invoice['pf_total_amount'] + $data['total'];
            }


            echo json_encode($data);
        }
    }







    public function EditAddDebit()
    {

        if ($_POST) {

            $insert_data['pd_payment'] = $this->request->getPost('pid');

            //$insert_data['pd_date'] = date('Y-m-d',strtotime($this->request->getPost('date')));

            $insert_data['pd_debit_account'] = $this->request->getPost('account');

            $insert_data['pd_payment_amount'] = $this->request->getPost('amount');

            $insert_data['pd_remarks'] = $this->request->getPost('narration');

            $pid = $this->common_model->InsertData('accounts_payment_debit', $insert_data);

            $this->FetchDebitData($pid, 1);
        }
    }



    public function DebitTotal()
    {

        if ($_POST) {

            $vendor = $this->request->getPost('vendor');

            $debit_amount = $this->account_model->FetchMaxDebitAmount($vendor);

            echo $debit_amount;
        }
    }






    // Function to handle file upload
    private function uploadFile($fieldName, $uploadPath)
    {
        $file = $this->request->getFile($fieldName);

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move($uploadPath, $newName);
            return $newName;
        }

        return null;
    }




    public function Print()
    {

        $id = 10;

        $cond = array('pay_id' => $id);

        ##Joins if any //Pass Joins as Multi dim array
        $joins = array(

            array(
                'table' => 'master_receipt_method',
                'pk' => 'rm_id',
                'fk' => 'pay_method',
            ),

            array(
                'table' => 'master_banks',
                'pk' => 'bank_id',
                'fk' => 'pay_bank',
            ),

            array(
                'table' => 'accounts_charts_of_accounts',
                'pk' => 'ca_id',
                'fk' => 'pay_debit_account',
            ),

        );

        $payment = $this->common_model->SingleRowJoin('accounts_payments', $cond, $joins);


        $total_amount = NumberToWords::transformNumber('en', $payment->pay_total); // outputs "fifty dollars ninety nine cents"


        $joins_inv = array(

            array(
                'table' => 'crm_proforma_invoices',
                'pk' => 'pf_id',
                'fk' => 'pi_invoice',
            ),

            array(
                'table' => 'crm_customer_creation',
                'pk' => 'cc_id',
                'table2' => 'crm_proforma_invoices',
                'fk' => 'pf_customer',
            ),

        );

        $invoices = $this->common_model->FetchWhereJoin('accounts_payment_invoices', array('pi_payment' => $id), $joins_inv);



        $invoice_sec = "";

        $first = true;


        foreach ($invoices as $inv) {

            if ($first == true) {
                $cus_name = $inv->cc_customer_name;
            } else {
                $cus_name = "";
            }

            $invoice_sec .= "
    
    <tr>

    <td>{$cus_name}</td>

    <td>{$inv->pf_reffer_no}</td>

    <td>" . date('d-m-Y', strtotime($inv->pf_date)) . "</td>

    <td>{$inv->pf_total_amount}</td>

    <td>15-01-2024</td>

    <td>{$inv->pf_total_amount}</td>
    
    </tr>

    ";

            $first = false;
        }



        $mpdf = new \Mpdf\Mpdf([
            'format' => 'Letter',
            'default_font_size' => 9,
            'margin_left' => 5,
            'margin_right' => 5,
        ]);

        $html = '
    
        <style>
        th, td {
            padding-top: 10px;
            padding-bottom: 10px;
            padding-left: 5px;
            padding-right: 5px;
          }
        </style>
    
        <table>
        
        <tr>
        
        <td>
    
        <h3>Al Fuzail Engineering Services WLL</h3>
        <p>Tel : +974 4460 4254, Fax : 4029 8994, email : engineering@alfuzailgroup.com</p>
        <p>Post Box : 201978, Gate : 248, Street : 24, Industrial Area, Doha - Qatar</p>
        
        
        </td>
        
        </tr>
    
        </table>

    
        <table width="100%" style="margin-top:10px;">
        
        <tr width="100%">
        
        <td align="right"><h3>Payment Voucher</h3></td>
    
        </tr>
    
        </table>
    
    
        <table  width="100%" style="margin-top:2px;border-top:3px solid;border-bottom:3px solid;">
    
        <tr>
        
        <td width="50%">
        
        Reference : ' . $payment->pay_ref_no . '
        
        </td>
        
            
        <td width="50%" align="right">
        
        Paid By : Cheque
    
        </td>
        
        </tr>
    
    
        <tr>
        
        <td width="50%">
        
        Date : ' . date('d-m-Y', strtotime($payment->pay_date)) . '
        
        </td>
        
            
        <td width="50%" align="right">
        
        Cheque : 90289
        </td>
        
        </tr>
    
    
        <tr>
        
        <td width="50%">
        
        Credit Account : RV-2020-0418
        
        </td>
        
            
        <td width="50%" align="right">
        
        Date : 10-02-2923

        </td>
        
        </tr>
    
    
        <tr>
        
        <td width="50%">
        
        Division : RV-2020-0418
        
        </td>
        
            
        <td width="50%" align="right">
        
        Bank : 10-02-2923
    
        </td>
        
        </tr>
    
    
    
        
        </table>
    
    
    
    
        <table  width="100%" style="margin-top:2px;">
        
    
        <tr  style="border-bottom:3px solid;">
        
        <th align="left">Debit Account</th>
    
        <th align="left">Reference</th>
    
        <th align="left">Invoice Date</th>
    
        <th align="left">Invoice Amount</th>
    
        <th align="left">Due Date</th>
    
        <th align="left">Payment</th>
    
        </tr>
    
    
    
        ' . $invoice_sec . '
    
    
    
        <tr style="padding-top:20px;">
        
        <td colspan="5">Reallocation</td>
    
        <td>9000.00</td>
        
        </tr>
    
    
        <tr style="padding-top:20px;">
        
        <td colspan="5">Discount</td>
    
        <td>9000.00</td>
        
        </tr>
    
    
        
        </table>
    
        ';

        $footer = '

        <table width="100%">
        
        <tr>
        
        <td colpsan="5" align="left"><b>Amount : Qatari Riyals ' . $total_amount . ' Only</b></td>
    
        <td colspan="1" align="left" style="text-align:right;"><b>' . $payment->pay_total . '</b></td>
    
        </tr>
    
        </table>
    
    
        <table>
        
        <tr>
    
        <th width="25%" style="padding-right:60px;">Prepared by : (print)</th>
    
        <th width="25%" style="padding-right:60px;">Received by:</th>
    
        <th width="25%" style="padding-right:60px;">Finance Manager</th>
    
        <th width="25%" style="padding-right:60px;">CEO</th>
    
        </tr>
    
        </table>
    
        ';


        $mpdf->WriteHTML($html);
        $mpdf->SetFooter($footer);
        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output();
    }





    //Common For Select 2 Dropdown

    public function FetchAccounts()
    {

        $page = !empty($_GET['page']) ? $_GET['page'] : 0;
        $term = !empty($_GET['term']) ? $_GET['term'] : "";
        $resultCount = 10;
        $end = ($page - 1) * $resultCount;
        $start = $end + $resultCount;

        $where = array('ca_type' => 'VENDOR');

        $data['result'] = $this->account_model->FetchAllLimitWhere('accounts_charts_of_accounts', 'ca_name', 'asc', $where, $term, $end, $start);

        //$data['result'] = $this->common_model->FetchAllLimit('accounts_charts_of_accounts','ca_name','asc',$term,$start,$end);

        $data['total_count'] = count($data['result']);

        return json_encode($data);
    }
}
