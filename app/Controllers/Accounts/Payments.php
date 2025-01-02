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

            $action = '<a  href="javascript:void(0)" class="edit edit-color view_btn" data-toggle="tooltip" data-placement="top" title="View"  data-id="' . $record->pay_id . '"><i class="ri-eye-fill"></i></a> 
                       <a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="Edit"  data-id="' . $record->pay_id . '"><i class="ri-pencil-fill"></i></a>
                       <a href="'.base_url().'Accounts/Payments/Print/'.$record->pay_id.'" target="_blank" class="print_color"><i class="ri-file-pdf-2-line " aria-hidden="true" title="Print"></i></a>
                       <a href="javascript:void(0)" class="delete delete-color delete_btn d-none1" data-toggle="tooltip" data-id="' . $record->pay_id . '"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i></a>';

            $data[] = array(
                "pay_id" => $i,
                "pay_ref_no" => $record->pay_ref_no,
                'pay_date' => date('d-m-Y', strtotime($record->pay_date)),
                'pay_method' => $record->rm_name,
                "bank_name" => $record->bank_name ?? "-",
                "pay_amount" => format_currency($record->pay_amount),
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

        $puid = $this->request->getPost('pay_ref_no');

        $puid_check = $this->common_model->SingleRow('accounts_payments',array('pay_ref_no' => $puid));

                if(!empty($puid_check))
                {
                    $return['status'] = 0;        
                    $return['error'] ="Duplicate Reference Number!";        
                    echo json_encode($return);        
                    exit;        
                }


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
                $p_ref_no = $this->FetchReference("r");

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
                       $pay_debit_id = $this->common_model->InsertData('accounts_payment_debit', $insert_inv_data);
                    } else {
                       $pay_debit_id =  $this->common_model->EditData($insert_inv_data, array('pd_id' => $check_debit->pd_id), 'accounts_payment_debit');
                    }


                    //Add Payment Linked Purchase Voucher Start

                    $accountId = $insert_inv_data['pd_debit_account'];

                    $allLinked = $this->session->get('payment_linked') ?? [];

                    $thisAccountLinked=$allLinked[$accountId]?? null;


                    if(!empty($thisAccountLinked))
                    {

                        $linkedCount = count($thisAccountLinked['pv_id']);

                        for($li=0;$li<$linkedCount;$li++)
                        {

                        if($thisAccountLinked['inv_payment_amount'][$li]>0)

                        {

                        $lpo_ref = $thisAccountLinked['inv_lpo_ref'][$li] ?? null;


                        $insert_invoice_data['pdi_debit_id'] = $pay_debit_id;

                        $insert_invoice_data['pdi_invoice'] = $thisAccountLinked['pv_id'][$li];

                        $insert_invoice_data['pdi_lpo_ref'] = $lpo_ref;

                        $insert_invoice_data['pdi_payment_amount'] = $thisAccountLinked['inv_payment_amount'][$li];


                        $this->common_model->InsertData('accounts_payment_debit_invoices', $insert_invoice_data);
                    
                        $this->UpdateInvoicePaid($insert_invoice_data['pdi_invoice']);

                        }


                }

                    }


                    //Add Payment Linked Purchase Voucher End


                    //Add Payment Advances Start

                    $allAdvance = $this->session->get('payment_advance') ?? [];

                    $advanceData = $allAdvance[$accountId] ?? null;

                    if(!empty($advanceData))
                    {
                        $advanceCount = count($advanceData['po_id']);

                        for($pa=0;$pa<$advanceCount;$pa++)
                        {


                        if($advanceData['advance_amount'][$pa]>0)

                        {

                        $insert_poa_data['pa_debit_id'] = $pay_debit_id;

                        $insert_poa_data['pa_purchase_order'] = $advanceData['po_id'][$pa];

                        $insert_poa_data['pa_advance_amount'] = $advanceData['advance_amount'][$pa];

                        $this->common_model->InsertData('accounts_payment_advances', $insert_poa_data);

                        $this->UpdatePOAdvance($insert_poa_data['pa_purchase_order']);

                        }


                        }


                    }



                }



            }
        }

        echo json_encode($return);
    }



    public function UpdateInvoicePaid($id)
    {

    //Payments
    $cond_payment = array('pdi_invoice' => $id);

    $updated_invoice_payment = $this->common_model->FetchSum('accounts_payment_debit_invoices','pdi_payment_amount',$cond_payment);

    //Petty Cash
    $cond_petty = array('pcdi_invoice' => $id);

    $updated_invoice_petty = $this->common_model->FetchSum('accounts_petty_cash_debit_invoices','pcdi_payment_amount',$cond_petty);


    $advance_paid = $this->common_model->SingleRow('pro_purchase_voucher',array('pv_id' => $id))->pv_advance;

    $updated_invoice_paid = $updated_invoice_payment+$updated_invoice_petty+$advance_paid;

    $update_invoice['pv_paid'] = $updated_invoice_paid;

    $this->common_model->EditData($update_invoice,array('pv_id' => $id),'pro_purchase_voucher');

    }



    public function UpdatePOAdvance($id)
    {

    //Payment
    $cond_advance_total = array('pa_purchase_order' => $id);

    $updated_po_advance = $this->common_model->FetchSum('accounts_payment_advances','pa_advance_amount',$cond_advance_total);

    //Petty Cash
    $cond_petty_advance = array('pca_purchase_order' => $id);

    $updated_po_advance_petty = $this->common_model->FetchSum('accounts_petty_cash_advances','pca_advance_amount',$cond_petty_advance);

    $update_po['po_advance_paid'] = $updated_po_advance+$updated_po_advance_petty;

    $this->common_model->EditData($update_po,array('po_id' => $id),'pro_purchase_order');
    
    }



    public function PaymentTotal($id)
    {

    $cond_payment = array('pd_payment' => $id);

    $total = $this->common_model->FetchSum('accounts_payment_debit','pd_payment_amount',$cond_payment);

    $payment_data['pay_amount'] = $total;

    $payment_cond['pay_id'] = $id;

    $this->common_model->EditData($payment_data,$payment_cond,'accounts_payments');

    }





    public function ResetSess()
    {
        $this->session->remove('payment_linked'); 
        
        $this->session->remove('payment_advance');
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

        $data['invoices'] = "";

        $inv_ser=0;

        foreach($debits as $invoice)
        {

        $inv_ser++;

        $data['invoices'] .="<tr>

        <input type='hidden' name='pd_id[]' value='".$invoice->pd_id."'>
        <td>{$invoice->ca_name}</td>
        <td>Debit</td>
        <td>-</td>
        <td><input name='pay_inv_notes[]' type='text' value='{$invoice->pd_remarks}' class='form-control'></td>
        <td><input name='pay_inv_amount[]' type='number' step='0.01' value='".$invoice->pd_payment_amount."' class='form-control'></td>
        <!--<td><a href='javascript:void(0)' data-id='{$invoice->pd_id}' class='invoice_delete_btn'>Delete</a></td>-->
        </tr>";

        $debit_data_join = array(
           
            array(
            'table' => 'pro_purchase_voucher',
            'pk' => 'pv_id', 
            'fk' => 'pdi_invoice',
            ),
 
        );

        $debit_linked = $this->common_model->FetchWhereJoin('accounts_payment_debit_invoices',array('pdi_debit_id'=>$invoice->pd_id),$debit_data_join);



        foreach($debit_linked as $dl)
        {

            $max_payable = $this->InvoiceMaxAmount($dl->pv_id,$dl->pdi_payment_amount);

            $data['invoices'] .="<tr>

            <input type='hidden' name='linked_payment_id[$invoice->pd_id][]' value='".$dl->pdi_id."'>

            <input type='hidden' name='linked_pv_id[$invoice->pd_id][]' value='".$dl->pv_id."'>

            <td></td>

            <td>Linked</td>

            <td>{$dl->pv_reffer_id}</td>

            <td></td>

            <td><input name='linked_pv_paid[$invoice->pd_id][]' type='number' step='0.01' max='".$max_payable."' value='".$dl->pdi_payment_amount."' class='form-control'></td>
            
            <td></td>

            </tr>";

        }


        //Fetch PO Advance


        
            $po_advance_data_join = array(

                array(
                    'table' => 'pro_purchase_order',
                    'pk' => 'po_id',
                    'fk' => 'pa_purchase_order',
                    ),
        
            );
        


           $po_advances = $this->common_model->FetchWhereJoin('accounts_payment_advances',array('pa_debit_id'=>$invoice->pd_id),$po_advance_data_join);
        
            foreach($po_advances as $advance)
            {
        

            $max_po_payable = $this->MaxAdvanceAmount($advance->pa_purchase_order,$advance->pa_advance_amount);


            $remarks ="";

            if(!empty($advance->pa_remarks))
            {
            $remarks = "({$advance->pa_remarks})";
            }

            $data['invoices'] .="<tr>
            <td></td>

            <td>Advance</td>

            <td>".$advance->po_reffer_no."</td>

            <td></td>

            <td class=''>
            <input type='hidden' name='advance_invoice_id[$invoice->pd_id][]' value='".$advance->pa_id."'>
            <input type='hidden' name='advance_po_id[$invoice->pd_id][]' value='".$advance->pa_purchase_order."'>

            <input type='number' step='0.01' class='form-control' max='".$max_po_payable."' name='advance_payment_amount[$invoice->pd_id][]' value='".$advance->pa_advance_amount."'>
            
            </td>

            </tr>";
        
            }






        }





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




    public function InvoiceMaxAmount($id,$amount)
    {

        $cond_payment = array('pdi_invoice' => $id);

        $updated_invoice_payment = $this->common_model->FetchSum('accounts_payment_debit_invoices','pdi_payment_amount',$cond_payment);
    
        //Petty Cash
        $cond_petty = array('pcdi_invoice' => $id);
 
        $updated_invoice_petty = $this->common_model->FetchSum('accounts_petty_cash_debit_invoices','pcdi_payment_amount',$cond_petty);
 

        $advance_paid = $this->common_model->SingleRow('pro_purchase_voucher',array('pv_id' => $id))->pv_advance;
    
        $updated_invoice_paid = $updated_invoice_payment+$updated_invoice_petty+$advance_paid;
    
        $max_payable_amount = $updated_invoice_paid + $amount;

        return $max_payable_amount;

    }



    public function MaxAdvanceAmount($id,$amount)
    {

        $cond_advance_total = array('pa_purchase_order' => $id);

        $updated_po_advance = $this->common_model->FetchSum('accounts_payment_advances','pa_advance_amount',$cond_advance_total);

        $total_po_amount = $this->common_model->SingleRowCol('pro_purchase_order','po_amount',array('po_id' => $id))->po_amount; 

        //Petty Cash
        $cond_petty_advance = array('pca_purchase_order' => $id);

        $updated_po_advance_petty = $this->common_model->FetchSum('accounts_petty_cash_advances','pca_advance_amount',$cond_petty_advance);


        $balance_amount = $total_po_amount- $updated_po_advance;
    
        $max_payable_amount = $balance_amount+$amount;

        return $max_payable_amount;

    }







    // update account head 
    public function Update()
    {
        $cond = array('pay_id' => $pay_id = $this->request->getPost('p_id'));

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

        //$update_data['pay_amount'] = $this->request->getPost('p_amount');

        $update_data['pay_bank'] = $this->request->getPost('p_bank');

        for($in=0;$in<count($this->request->getPost('pd_id'));$in++)
        {

        $in_cond['pd_id'] = $this->request->getPost('pd_id')[$in];

        $in_data['pd_payment_amount'] = $this->request->getPost('pay_inv_amount')[$in];

        $in_data['pd_remarks'] = $this->request->getPost('pay_inv_notes')[$in];

        $this->common_model->EditData($in_data, $in_cond, 'accounts_payment_debit');

        }

        $this->common_model->EditData($update_data, $cond, 'accounts_payments');




        for($p=0;$p<(count($this->request->getPost('pd_id')));$p++)
        {

        $update_invoice_data['pd_payment_amount'] = $this->request->getPost('pay_inv_amount')[$p];

        $update_invoice_cond['pd_id'] = $this->request->getPost('pd_id')[$p];


        $total_linked_invoice=0;
        if(!empty($this->request->getPost('linked_pv_paid')[$update_invoice_cond['pd_id']]))
        $total_linked_invoice = array_sum($this->request->getPost('linked_pv_paid')[$update_invoice_cond['pd_id']]);


        $total_advance_amount=0;
        if(!empty($this->request->getPost('advance_payment_amount')[$update_invoice_cond['pd_id']]))
        $total_advance_amount=array_sum($this->request->getPost('advance_payment_amount')[$update_invoice_cond['pd_id']]);
        

        $total_invoices=$total_linked_invoice+$total_advance_amount;


        if($total_invoices!=$update_invoice_data['pd_payment_amount'])
        {

            $return['status'] = 0;

            $return['msg'] ="Total amount should be adjusted!";
    
            echo json_encode($return);
    
            exit;  

        }


        for($l=0;$l<(count($this->request->getPost('linked_pv_id')[$update_invoice_cond['pd_id']]));$l++)
        {

        $update_linked_cond = array('pdi_id' => $this->request->getPost('linked_payment_id')[$update_invoice_cond['pd_id']][$l]);

        $update_linked_amount = array('pdi_payment_amount' => $this->request->getPost('linked_pv_paid')[$update_invoice_cond['pd_id']][$l]);

        $this->common_model->EditData($update_linked_amount,$update_linked_cond,'accounts_payment_debit_invoices');

        $this->UpdateInvoicePaid($this->request->getPost('linked_pv_id')[$update_invoice_cond['pd_id']][$l]);

        }


        if(!empty($this->request->getPost('advance_po_id')[$update_invoice_cond['pd_id']]))
        {

        for($poa=0;$poa<count($this->request->getPost('advance_po_id')[$update_invoice_cond['pd_id']]);$poa++)
        {

        $update_poa_cond = array('pa_id' => $this->request->getPost('advance_invoice_id')[$update_invoice_cond['pd_id']]);

        $updated_amount = array('pa_advance_amount' => $this->request->getPost('advance_payment_amount')[$update_invoice_cond['pd_id']]);

        $po_id_advance = $this->request->getPost('advance_po_id')[$update_invoice_cond['pd_id']];

        $this->common_model->EditData($updated_amount,$update_poa_cond,'accounts_payment_advances');

        $this->UpdatePOAdvance($po_id_advance);

        }

        }

        
        $this->common_model->EditData($update_invoice_data,$update_invoice_cond,'accounts_payment_debit');

        }

        $this->PaymentTotal($pay_id);

        $return['status'] =1;

        echo json_encode($return);


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
                'fk' => 'pay_credit_account',
            ),

        );

        $data['invoices'] = "";

        $data['pay'] = $this->common_model->SingleRowJoin('accounts_payments', $cond, $joins);

        $data['pay']->total_amount = format_currency($data['pay']->pay_amount);

       

        $joins_inv = array(
           
            array(
                'table' => 'accounts_charts_of_accounts',
                'pk' => 'ca_id',
                'fk' => 'pd_debit_account',
            ),

            

        );

        $invoices = $this->common_model->FetchWhereJoin('accounts_payment_debit', array('pd_payment' => $id), $joins_inv);

        $invoice_sec = "";

        
        
        $isl=1;

        foreach ($invoices as $inv) {

            $invoice_sec .="";

           

            $joins_voucher = array(

                array(
                    'table' => 'pro_purchase_voucher',
                    'pk' => 'pv_id',
                    'fk' => 'pdi_invoice',
                ),

                array(

                    'table' => 'accounts_payment_debit',

                    'pk' => 'pd_id',

                    'fk' => 'pdi_debit_id',

                ),


            );

            $linked_voucher = $this->common_model->FetchWhereJoin('accounts_payment_debit_invoices', array('pdi_debit_id' => $inv->pd_id), $joins_voucher);

            $first = true;
            
            $isl++;

            if(!empty($linked_voucher))
            {

                if($first==true)
                {
                $account_name = $inv->ca_name;
                }
                else
                {
                $account_name = "";
                }


            foreach($linked_voucher as $lv){
                
            $data['invoices'] .= "<tr>
            
            <td>".$account_name."</td>

            <td>Linked</td>

            <td>".$lv->pv_reffer_id."</td>

            <td></td>

            <td class='text-end'>".format_currency($lv->pdi_payment_amount)."</td>

            
            </tr>";

            }

            $first=false;

            }



            //Advance

            $po_advance_data_join = array(

                array(
                    'table' => 'pro_purchase_order',
                    'pk' => 'po_id',
                    'fk' => 'pa_purchase_order',
                    ),
        
            );
            
            $po_advances = $this->common_model->FetchWhereJoin('accounts_payment_advances',array('pa_debit_id'=>$inv->pd_id),$po_advance_data_join);
        
            foreach($po_advances as $advance)
            {
        
            $remarks ="";

            if(!empty($advance->pa_remarks))
            {
            $remarks = "({$advance->pa_remarks})";
            }

            $data['invoices'] .="<tr>
            <td></td>
            <td>Advance</td>
            <td>".$advance->po_reffer_no." ".$remarks."</td>
            <td></td>
            <td class='text-end'>".format_currency($advance->pa_advance_amount)."</td>
            </tr>";
        
            }


            $data['invoices'] .="

            <tr>
            
            <td></td>

            <td>Credit</td>

            <td>-</td>

            <td>{$inv->pd_remarks}</td>

            <td class='text-end'><b>".format_currency($inv->pd_payment_amount)."</b></td>
            
            </tr>
            
            ";




        }


        //$invoices = $this->common_model->FetchWhereJoin('accounts_payment_invoices', array('pi_payment' => $id), $joins_inv);

        /* $data['invoices'] = "";

        foreach ($invoices as $invoice) {

            $data['invoices'] .= "<tr><td>" . date('d-F-Y', strtotime($invoice->pf_date)) . "</td><td>{$invoice->pf_reffer_no}</td><td>{$invoice->pi_remarks}</td><td>{$invoice->pf_total_amount}</td></tr>";
        }
            */

        echo json_encode($data);
    }









    //delete account head
    public function Delete()
    {
        $cond = array('pay_id' => $this->request->getPost('id'));

        $payment = $this->common_model->SingleRow('accounts_payments', $cond);


        $cond_invoices = array('pd_payment' => $this->request->getPost('id'));

        $invoices = $this->common_model->FetchWhere('accounts_payment_debit',$cond_invoices);


            foreach($invoices as $inv)
            {

            $invoice_datas = $this->common_model->FetchWhere('accounts_payment_debit_invoices',array('pdi_debit_id' => $inv->pd_id));

            $advance_datas = $this->common_model->FetchWhere('accounts_payment_advances',array('pa_debit_id' => $inv->pd_id));

            foreach($invoice_datas as $inv_data){

            $this->common_model->DeleteData('accounts_payment_debit_invoices',array('pdi_id'=>$inv_data->pdi_id));

            $this->UpdateInvoicePaid($inv_data->pdi_invoice);

            }


            foreach($advance_datas as $adv_data)
            {

            $cond_po = array('pa_id' => $adv_data->pa_id);

            $this->common_model->DeleteData('accounts_payment_advances',$cond_po);

            $this->UpdatePOAdvance($adv_data->pa_purchase_order);

            }

        }
        
        $this->common_model->DeleteData('accounts_payments', $cond);

        $this->common_model->DeleteData('accounts_payment_debit',$cond_invoices);

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

            /*
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


            $data['pd_id'] = $pd_id;

            */


            $joins = array(
                array(
                    'table' => 'pro_vendor',
                    'pk' => 'ven_id',
                    'fk' => 'ca_customer',
                ),
            );

            //$customer = $this->common_model->SingleRowJoin('crm_customer_creation',array('cc_id' => $ac_id),$joins);

            $customer = $this->common_model->SingleRowJoin('accounts_charts_of_accounts', array('ca_id' => $vendor_id), $joins);

            $data['status'] = 0;

            $data['invoices'] = "";

            $cond = array('pv_vendor_name' => $vendor_id);

            $purchase_vouchers = $this->account_model->FetchUnpaidPurchaseVoucher($vendor_id);

            $sl = 0;

            $data['vendor_id'] = $vendor_id;

            $data['invoices'] .= '<input type="hidden" name="account_id" value="' . $customer->ca_id. '">';

            foreach ($purchase_vouchers as $pv) {

            $sl++;

            $balance_amount = $pv->pv_total - $pv->pv_paid;

            $data['invoices'] .= '<tr id="' . $pv->pv_id . '">

            <input type="hidden" name="pv_id[]" value="' . $pv->pv_id . '">

            <input type="hidden" name="debit_account_invoice[]" value="' . $vendor_id . '">
            <th>' . $sl . '</th>
            <th>' . date('d-m-Y', strtotime($pv->pv_date)) . '</th>
            <th>' . $pv->pv_reffer_id . '</th>
            <th><input class="form-control" name="inv_lpo_ref[]" type="text" value="' . $pv->pv_reffer_id . '" required></th>
            
            <th>' . $balance_amount . '
            <input type="hidden" class="invoice_total_amount" name="total_amount" value="' . $balance_amount . '">
            </th>

            <th><input class="form-control invoice_receipt_amount" step="0.01" maxlength="' . $balance_amount . '" data-max="'.$balance_amount.'" name="inv_payment_amount[]" type="number"></th>
            
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












    public function FetchReference($type="e")
    {

        $uid = $this->common_model->FetchNextId('accounts_payments', "BPV-{$this->data['accounting_year']}-");
        if($type=="e")
        {
        echo $uid;
        }
        else
        {
        return $uid;
        }
    }






    /*
    public function AddInvoices()
    {

        if ($_POST) {

            for ($i = 0; $i < count($this->request->getPost('inv_receipt_amount')); $i++) {

                $invoice_id = $this->request->getPost('p_v_id')[$i];

                $receipt_amount  = $this->request->getPost('inv_receipt_amount')[$i];

                // if(isset($this->request->getPost('invoice_selected')[$i]))

                // {

                $insert_data['pdi_debit_id'] = $this->request->getPost('pay_debit_id')[$i];

                $insert_data['pdi_invoice'] = $this->request->getPost('p_v_id')[$i];

                $insert_data['pdi_lpo_ref'] = $this->request->getPost('inv_lpo_ref')[$i];

                $insert_data['pdi_payment_amount'] = $this->request->getPost('inv_receipt_amount')[$i];

                $check_invoice = $this->common_model->SingleRow('accounts_payment_debit_invoices', array('pdi_invoice' => $insert_data['pdi_invoice'], 'pdi_debit_id' => $insert_data['pdi_debit_id']));

                //if (empty($check_invoice)) {
                    $pdi_id = $this->common_model->InsertData('accounts_payment_debit_invoices', $insert_data);
                //} else {

                    //$update_cond = array('pdi_id' => $check_invoice->pdi_id);

                    //$pdi_id = $this->common_model->EditData($insert_data, $update_cond, 'accounts_payment_debit_invoices');
                //}

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
    */


    public function AddInvoices()
    {


        if ($this->request->getPost()) {

            $accountId = $this->request->getPost('account_id');

            $allLinked = $this->session->get('payment_linked') ?? [];

            // Add or update the data for this account
            $allLinked[$accountId] = $this->request->getPost();

            // Set the grouped session data
            $this->session->set('payment_linked', $allLinked);

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




    public function Print($id="")
    {

        if($id=="")
        {
            $id = 10;
        }

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
                'fk' => 'pay_credit_account',
            ),

        );

        $payment = $this->common_model->SingleRowJoin('accounts_payments', $cond, $joins);

        if ($payment->pay_method == "2") {
            $bank_name = "-";
        }
    
        else
        {
            $bank_name = $payment->bank_name;
        }
    
    
        $cheque_date = "-";
    
        $cheque_no = "-";
    
        if ($payment->pay_method == "1") {
    
            $cheque_date = date('d-F-Y',strtotime($payment->pay_cheque_date));
    
            $cheque_no =$payment->pay_cheque_no;
    
        }


        $total_amount = $payment->pay_amount; 


        $joins_inv = array(
           
            array(
                'table' => 'accounts_charts_of_accounts',
                'pk' => 'ca_id',
                'fk' => 'pd_debit_account',
            )

        );

        $invoices = $this->common_model->FetchWhereJoin('accounts_payment_debit', array('pd_payment' => $id), $joins_inv);

        $invoice_sec = "";

        $first = true;


        foreach ($invoices as $inv) {

            $joins_voucher = array(

                array(
                    'table' => 'pro_purchase_voucher',
                    'pk' => 'pv_id',
                    'fk' => 'pdi_invoice',
                )

            );

            $linked_voucher = $this->common_model->FetchWhereJoin('accounts_payment_debit_invoices', array('pdi_debit_id' => $inv->pd_id), $joins_voucher);



            foreach($linked_voucher as $lv){

            if ($first == true) {
                $cus_name = $inv->ca_name;
            } else {
                $cus_name = "";
            }


            $invoice_sec .= "
    
                    <tr>

                    <td>{$cus_name}</td>

                    <td>{$inv->pv_reffer_id}</td>

                    <td>" .date('d-F-Y', strtotime($inv->pv_date)). "</td>

                    <td>{$inv->pv_total}</td>

                    <td>-</td>

                    <td align='right'>{$inv->pd_payment_amount}</td>
                    
                    </tr>

            ";

            $first = false;

            }

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
            padding-top: 5px;
            padding-bottom: 5px;
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
        
        <td width="120px">
        
        Reference : 
        
        </td>


        <td width="120px">
        
        ' . $payment->pay_ref_no . '

        </td>



        <td></td>
        <td></td>
        
            
        <td width="120px" align="left">
        
        Paid By : 
    
        </td>

        <td width="120px">
        
        '.$payment->rm_name.'

        </td>
      
        
        </tr>
        

        <tr>

        
        <td>
        
        Date : 
        
        </td>


        <td>
        
        ' . date('d-m-Y', strtotime($payment->pay_date)) . '

        </td>


        <td></td>
        <td></td>

        
            
        <td align="left">
        
        Cheque : 

        </td>


        <td>
        
        '.$cheque_no.'
        
        </td>


        
        </tr>


      
    
    
        <tr>
        
        <td >
        
        Credit Account :
        
        </td>


        <td>

        </td>


        <td></td>
        <td></td>
        
            
        <td align="left">
        
        Cheque Date : 

        </td>
        
        </tr>



    
        <tr>

        
        <td >
        
        Division : 
        
        </td>


        <td>
        
        RV-2020-0418

        </td>


        <td></td>
        <td></td>

            
        <td  align="left">

        Bank : 
    
        </td>


        <td>
        

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
    
        <td>0.00</td>
        
        </tr>

    
        <tr style="padding-top:20px;">
        
        <td colspan="5">Discount</td>
    
        <td>0.00</td>
        
        </tr>
    
        
        </table>
    
        ';

        $footer = '

        <table width="100%">
        
        <tr>
        
        <td colpsan="5" align="center"><b>Amount : ' . currency_to_words($total_amount) . '</b></td>
    
        <td colspan="1" align="right" style="text-align:right;"><b>' . format_currency($payment->pay_amount) . '</b></td>
    
        </tr>
    
        </table>
    
    
        <table>
        
        <tr>
    
        <td width="25%" style="padding-right:60px;">Prepared by : (print)</td>
    
        <td width="25%" style="padding-right:60px;">Received by:</td>
    
        <td width="25%" style="padding-right:60px;">Finance Manager</td>
    
        <td width="25%" style="padding-right:60px;">CEO</td>
    
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

        //$where = array('ca_type' => 'VENDOR');

        $where = array();

        $data['result'] = $this->account_model->FetchAllLimitWhere('accounts_charts_of_accounts', 'ca_name', 'asc', $where, $term, $end, $start);

        //$data['result'] = $this->common_model->FetchAllLimit('accounts_charts_of_accounts','ca_name','asc',$term,$start,$end);

        $data['total_count'] = count($data['result']);

        return json_encode($data);
    }



    
    public function FetchPOAdvance()
    {


        if ($_POST) {

            $vendor_id = $this->request->getPost('vendor');


            $v_id = $this->common_model->SingleRow('accounts_charts_of_accounts',array('ca_type' => 'VENDOR','ca_id' => $vendor_id))->ca_customer;

            $purchase_orders = $this->common_model->FetchWhere('pro_purchase_order', array('po_vendor_name' => $v_id));

            $data['po_rows'] = "";

            $sl_no=1;

            $data['po_rows'] .='<input type="hidden" name="account_id" value="'.$vendor_id.'">';

            foreach($purchase_orders as $po)

            {

            $data['po_rows'] .='
            
            <tr>

            <input type="hidden" name="po_id[]" value="'.$po->po_id.'">
            
            <td>'.$sl_no++.'</td>

            <td>'.$po->po_reffer_no.'</td>

            <td>'.$po->po_vendor_ref.'</td>

            <td>'.format_currency($po->po_amount).'</td>

            <td><input class="form-control po_advance_amount" name="advance_amount[]" step="0.01" type="number"></td>

            </tr>
            
            ';


            }


            echo json_encode($data);

        }



    }




    /*
    public function AddPoAdvance()
    {

        if($_POST)
        {

            for($i=0;$i<count($this->request->getPost('debit_id'));$i++)

            {

            $insert_data['pa_debit_id'] = $this->request->getPost('debit_id')[$i];

            $insert_data['pa_purchase_order'] = $this->request->getPost('po_id')[$i];

            $insert_data['pa_advance_amount'] = $this->request->getPost('advance_amount')[$i];

            if($insert_data['pa_advance_amount']>0)

            {

            $id = $this->common_model->InsertData('accounts_payment_advances', $insert_data);

            }

            }


        }

    }
        */

        public function AddPoAdvance()
        {


        if($this->request->getPost())
        {

            $accountId = $this->request->getPost('account_id');

            $allAdvance = $this->session->get('payment_advance') ?? [];

            $allAdvance[$accountId] = $this->request->getPost();

            $this->session->set('payment_advance',$allAdvance);

        }


        }




}
