<?php

namespace App\Controllers\Accounts;

use App\Controllers\BaseController;


class Receipts extends BaseController
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

        //$mpdf->debug = true; simply true
        ##For Getting Only Logged In Admin Added Records

        $cond = array();

        ## Total number of records without filtering
       
        $totalRecords = $this->common_model->GetTotalRecords('accounts_receipts','r_id',$cond);
 
        ## Total number of records with filtering
       
        $searchColumns = array('r_number','r_id');

        $totalRecordwithFilter = $this->common_model->GetTotalRecordwithFilter('accounts_receipts','r_id',$searchValue,$searchColumns,$cond);
    
        ##Joins if any //Pass Joins as Multi dim array
        $joins = array(
           
            array(
            'table' => 'master_receipt_method',
            'pk' => 'rm_id',
            'fk' => 'r_method',
            ),

            array(
                'table' => 'master_banks',
                'pk' => 'bank_id',
                'fk' => 'r_bank',
                ),
            /*
            array(
                'table' => 'accounts_charts_of_accounts',
                'pk' => 'ca_id',
                'fk' => 'r_debit_account',
                ),
            */

        );
        ## Fetch records
        $records = $this->common_model->GetRecord('accounts_receipts','r_id',$searchValue,$searchColumns,$columnName,$columnSortOrder,$joins,$rowperpage,$start,$cond);
    
        $data = array();

        $i=1;
        foreach($records as $record ){

           //$action = '<a  href="javascript:void(0)" class="edit edit-color view_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->r_id.'" data-original-title="Edit"><i class="ri-eye-fill"></i> View</a> <a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->r_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a><a href="'.base_url().'Accounts/Receipts/Print/'.$record->r_id.'" target="_blank" class="print_color"><i class="ri-file-pdf-2-line " aria-hidden="true"></i>Print </a><a href="javascript:void(0)" class="d-none delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->r_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> Delete</a>';

           $action = '<a  href="javascript:void(0)" class="edit edit-color view_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->r_id.'" data-original-title="Edit"><i class="ri-eye-fill"></i> View</a> <a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->r_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a><a href="javascript:void(0);" data-id="'.$record->r_id.'" class="print_color"><i class="ri-file-pdf-2-line " aria-hidden="true"></i>Print </a><a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->r_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> Delete</a>';
           
           $data[] = array( 
              "r_id"=>$i,
              "receipt_no" => $record->r_number,
              "reference" => $record->r_ref_no,
              'date' => date('d-m-Y',strtotime($record->r_date)),
              'receipt_method' => $record->rm_name,
              "bank"=> $record->bank_name ?? "--",
              "action" =>$action,
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

        $data['r_methods'] = $this->common_model->FetchAllOrder('master_receipt_method','rm_name','asc');

        $data['banks'] = $this->common_model->FetchAllOrder('master_banks','bank_name','asc');

        //$data['accounts'] = $this->common_model->FetchAllOrder('accounts_charts_of_accounts','ca_name','asc');

        $data['collectors'] = $this->common_model->FetchAllOrder('master_collectors','col_name','asc');

        $data['customers'] = $this->common_model->FetchAllOrder('crm_customer_creation','cc_customer_name','asc');

        //$data['customers'] = $this->common_model->FetchAllOrder('accounts_charts_of_accounts','ca_name','asc');

        $data['sales_orders'] = $this->common_model->FetchAllOrder('crm_sales_orders','so_id','asc');

        $data['content'] = view('accounts/receipts',$data);

        return view('accounts/accounts-module',$data);

    }


    // 




    //Main Receipt Add Start

    Public function Add()
    {   

        // print_r($_POST); 

        // exit;

        if(empty($this->request->getPost('r_credit_account')))
        {

        $return['status'] = 0;

        $return['error'] ="Enter credit details!";

        }

        else{

        $return['status'] = 1;

        $insert_data['r_date'] = date('Y-m-d',strtotime($this->request->getPost('r_date')));

        $insert_data['r_debit_account'] = $this->request->getPost('r_debit_account');
        
        $insert_data['r_method'] = $this->request->getPost('r_method');

        if(!empty($this->request->getPost('r_method')==1))
        {

        $insert_data['r_cheque_no'] = $this->request->getPost('r_cheque_no');

        $insert_data['r_cheque_date'] = date('Y-m-d',strtotime($this->request->getpost('r_cheque_date')));

        }

        if ($_FILES['r_cheque_copy']['name'] !== '') {
            $attachment_name = $this->uploadFile('r_cheque_copy','uploads/Receipts');
            $insert_data['r_cheque_copy'] = $attachment_name;
        }


        $insert_data['r_collected_by'] = $this->request->getPost('r_collected_by');


        if(!empty($this->request->getPost('r_method')!=2))
        {
        $insert_data['r_bank'] = $this->request->getPost('r_bank');
        }


        $insert_data['r_amount'] = $this->request->getPost('total_receipt_amount');


        if(empty($this->request->getPost('r_id')))

        {   

                $insert_data['r_number'] = str_replace(" ","",$this->request->getPost('r_receipt_no'));
                //Check Duplicate Receipt Number
                
                if(!empty($this->request->getPost('r_receipt_no')))
                {
                $r_no_check = $this->common_model->SingleRow('accounts_receipts',array('r_number' => $insert_data['r_number']));

                if(!empty($r_no_check))
                {
                    $return['status'] = 0;        
                    $return['error'] ="Duplicate Receipt Number!";        
                    echo json_encode($return);        
                    exit;        
                }
            }
                

        $insert_data['r_added_by'] = 1;

        $insert_data['r_added_date'] = date('Y-m-d');

        $id = $this->common_model->InsertData('accounts_receipts',$insert_data);
        
        }

        else
        {

        $id = $this->request->getPost('r_id');

        $r_cond = array('r_id' => $this->request->getPost('r_id'));

        $this->common_model->EditData($insert_data,$r_cond,'accounts_receipts');

        }

        //$r_ref_no = 'REC'.str_pad($id, 7, '0', STR_PAD_LEFT);

        $r_ref_no = $this->FetchReference("r");

        $cond = array('r_id' => $id);

        $update_data['r_ref_no'] = $r_ref_no;

        $this->common_model->EditData($update_data,$cond,'accounts_receipts');


        //Add invoices

        /*
        if(!empty($this->request->getPost('pf_id')))
        {

        for($i=0;$i<count($this->request->getPost('pf_id'));$i++)
        {

        $inv_id = $_POST['pf_id'][$i];

        $inv_remarks = $_POST['pf_remarks'][$i];

        $insert_inv_data['ri_receipt'] = $id;

        $insert_inv_data['ri_invoice'] = $inv_id;

        $insert_inv_data['ri_remarks'] = $inv_remarks;

        $this->common_model->InsertData('accounts_receipt_invoices',$insert_inv_data);
        }
        }
        */

        if(!empty($this->request->getPost('r_credit_account')))
        {

            // Find the total of negative values
            $negativeTotal = array_sum(array_filter($_POST['inv_amount'], fn($value) => $value < 0));
            
            for($i=0;$i<count($this->request->getPost('inv_amount'));$i++)
            {

                //$check_credit = $this->common_model->SingleRow('accounts_receipt_invoices',array('ri_receipt' => $id,'ri_credit_account' => $_POST['r_credit_account'][$i]));

                $insert_inv_data['ri_receipt'] = $id;

                //$insert_inv_data['ri_date'] = $_POST['inv_date'][$i];

                $insert_inv_data['ri_credit_account'] = $_POST['r_credit_account'][$i];

                if($_POST['inv_amount'][$i]>0)
                {
                $_POST['inv_amount'][$i] = $_POST['inv_amount'][$i] - abs($negativeTotal);
                }
                
                $insert_inv_data['ri_amount'] = $_POST['inv_amount'][$i];

                if((empty($insert_inv_data['ri_amount'])) || empty($insert_inv_data['ri_credit_account']))
                {

                    $return['status'] = 0;

                    $return['error'] ="Enter Credit Account And Amount!";

                    echo json_encode($return);

                    exit;
                    

                }


                $insert_inv_data['ri_remarks'] = $_POST['narration'][$i];


                //Add To Transactions

                $credit_trans_data['tran_reference'] = $r_ref_no;

                $credit_trans_data['tran_account'] = $insert_inv_data['ri_credit_account'];

                $credit_trans_data['tran_credit'] = $insert_inv_data['ri_amount'];

                $credit_trans_data['tran_type'] = "Receipt";

                $this->common_model->InsertData('master_transactions',$credit_trans_data);



                if(empty($check_credit))
                {
                $receipt_invoice_id = $this->common_model->InsertData('accounts_receipt_invoices',$insert_inv_data);
                }
                else
                {
                $receipt_invoice_id =$this->common_model->EditData($insert_inv_data,array('ri_id' => $check_credit->ri_id),'accounts_receipt_invoices');
                }


                $accountId = $insert_inv_data['ri_credit_account'];

                // Retrieve the session data for 'receipt_linked'
                $allLinked = $this->session->get('receipt_linked') ?? [];

                $accountData = $allLinked[$accountId] ?? null;


                if (isset($accountData)) {

                    $arrayCount = count($accountData['type']); 

                    // Loop through all the values in the arrays
                    for ($li = 0; $li < $arrayCount; $li++) {
                        $type = $accountData['type'][$li] ?? null;
                        $creditAccountInvoice = $accountData['credit_account_invoice'][$li] ?? null;
                        $invReceiptAmount = $accountData['inv_receipt_amount'][$li] ?? null;
                        $invLpoRef = $accountData['inv_lpo_ref'][$li] ?? null;
                
                        // Prepare the data for insertion
                        $insert_invoice_data['rid_receipt_invoice'] = $receipt_invoice_id;
                        $insert_invoice_data['rid_invoice'] = $creditAccountInvoice;
                        $insert_invoice_data['rid_lpo_ref'] = $invLpoRef;
                        $insert_invoice_data['rid_receipt'] = $invReceiptAmount;
                        $insert_invoice_data['rid_invoice_type'] = $type;
                
                        // Insert to invoice data table
                        $this->common_model->InsertData('accounts_receipt_invoice_data', $insert_invoice_data);

                        //Update Invoice Paid Amount
                        $this->UpdateInvoicePaid($insert_invoice_data['rid_invoice'],$insert_invoice_data['rid_invoice_type']);

                        


                    }

                }
                

            }

            //Insert Data

        }
        
        //Add To Transactions

        $trans_data['tran_reference'] = $r_ref_no;

        $trans_data['tran_account'] = $insert_data['r_debit_account'];

        $trans_data['tran_debit'] = $insert_data['r_amount'];

        $trans_data['tran_type'] = "Receipt";

        $this->common_model->InsertData('master_transactions',$trans_data);

        $return['id']=$id;

        $this->session->remove('receipt_linked');

        }

        echo json_encode($return);

    }




    public function UpdateInvoicePaid($id,$type)
    {

    $cond_receipt = array('rid_invoice' => $id,'rid_invoice_type' => $type);

    $updated_invoice_receipt = $this->common_model->FetchSum('accounts_receipt_invoice_data','rid_receipt',$cond_receipt);

    if($type=="cash_invoice")

    {
  
    $advance_paid = $this->common_model->SingleRowCol('crm_cash_invoice','ci_advance_amount',array('ci_id' => $id))->ci_advance_amount;

    $updated_invoice_paid = $updated_invoice_receipt+$advance_paid;

    $update_invoice['ci_paid_amount'] = $updated_invoice_paid;

    $this->common_model->EditData($update_invoice,array('ci_id' => $id),'crm_cash_invoice');

    }


    }





    public function ResetSess()
    {
        $this->session->remove('receipt_linked');  
    }


    //Main Receipt Add End


     //Fetch Invoice And Add Credit Start



     public function FetchInvoices()
     {
 
     if($_POST)
     {
 
     $ac_id = $this->request->getPost('id');
 
     $rid = $this->request->getPost('rid');
 
     $reciept_amount = $this->request->getPost('camount');


     if(empty($ac_id))
     {
 
         $data['status']= 0 ;
 
         $data['msg'] = "Please select account!";
 
         echo json_encode($data);
 
         exit;
 
     }

 
     if($reciept_amount<1)
     {
 
         $data['status']= 0 ;
 
         $data['msg'] = "Please enter amount!";
 
         echo json_encode($data);
 
         exit;
 
     }
 
     
     /*

      $insert_data['ri_receipt'] = $this->request->getPost('rid');
 
      $insert_data['ri_credit_account'] = $ac_id;
 
      $insert_data['ri_amount'] = $this->request->getPost('camount');
 
      $insert_data['ri_remarks'] = $this->request->getPost('cnarration');
 
      //$insert_data['ri_date'] = date('Y-m-d',strtotime($this->request->getPost('cdate')));
 
     $check_invoice = $this->common_model->SingleRow('accounts_receipt_invoices',array('ri_receipt' => $insert_data['ri_receipt'],'ri_credit_account' => $insert_data['ri_credit_account']));
 
     if(empty($check_invoice))
     { 
     $ri_id = $this->common_model->InsertData('accounts_receipt_invoices',$insert_data);
     }
 
     else
     {
 
     $update_cond = array('ri_id' => $check_invoice->ri_id);
 
     $ri_id = $check_invoice->ri_id;
 
     $this->common_model->EditData($insert_data,$update_cond,'accounts_receipt_invoices');
 
     }

     */
     
 
     //$rid =1;
 
     $joins = array(
         array(
             'table' => 'crm_customer_creation',
             'pk' => 'cc_id',
             'fk' => 'ca_customer',
             ),
     );
 
     //$customer = $this->common_model->SingleRowJoin('crm_customer_creation',array('cc_id' => $ac_id),$joins);
 
     $customer = $this->common_model->SingleRowJoin('accounts_charts_of_accounts',array('ca_id' => $ac_id),$joins);
 
     //$cond = array('pf_customer' => $customer->cc_id);   
 
     //$invoices = $this->common_model->FetchWhere('crm_proforma_invoices',$cond);
 
     $cond = array('ci_customer' => $customer->cc_id);
     
     $invoices = $this->common_model->FetchUnpaidInvoices('crm_cash_invoice',$cond,'ci_paid_status');
    
     $data['status']=0;
 
     $data['msg'] = "No invoices found!";
 
     $data['invoices']="";
 
     $data['invoices'] .='<input type="hidden" id="total_amount_invoice" value="'.$reciept_amount.'">';
 
     //$data['invoices'] .='<input type="hidden" id="add_receipt_invoice_id" value="'.$ri_id.'">';

     $data['invoices'] .='<input type="hidden" name="account_id" id="add_receipt_invoice_customer" value="'.$ac_id.'">';

     $sl =0; 
     foreach($invoices as $inv)
     {
     $sl++;
     $sales_return_amount = 0;

     $remaining_amount = $inv->ci_total_amount - $inv->ci_paid_amount;

     $sr = $this->account_model->FetchSalesReturnAmount($inv->ci_reffer_no);

     if(!empty($sr))
     {
        $sales_return_amount = $sr;
     }

     $remaining_amount = $remaining_amount - $sales_return_amount;

     $remaining_amount = max($remaining_amount,0);   

     if($remaining_amount !=0 ){
     
     $data['invoices'].='<tr id="'.$inv->ci_id.'">
     
     <input type="hidden" name="type[]" value="cash_invoice">
     <input type="hidden" name="credit_account_invoice[]" value="'.$inv->ci_id.'">
     <th>'.$sl.'</th>
     <th>'.date('d-m-Y',strtotime($inv->ci_date)).'</th>
     <th>'.$inv->ci_reffer_no.'</th>
     <th><input class="form-control" name="inv_lpo_ref[]" type="text" value="'.$inv->ci_lpo_reff.'" required></th>
     <th>'.$remaining_amount.'
     <input type="hidden" class="invoice_total_amount" name="total_amount" value="'.$remaining_amount.'">
     </th>
     <th><input class="form-control invoice_receipt_amount" name="inv_receipt_amount[]" maxlength="'.$remaining_amount.'" data-max="'.$remaining_amount.'" type="number" value="0"></th>
     
     <th>
     <input class="invoice_add_check" type="checkbox" name="invoice_selected[]" value="'.$inv->ci_id.'">
     </th>
     </tr>';
    
    }

     $data['status']=1;
 
     }

 
     $credit_cond = array('cci_customer' => $customer->cc_id);
     $invoices_credit = $this->common_model->FetchUnpaidInvoices('crm_credit_invoice',$credit_cond,'cci_paid_status');
 
     $sl = 0; 
     foreach($invoices_credit as $inv)
     {
     $sl++;

     $remaining_amount = $inv->cci_total_amount - $inv->cci_paid_amount;

     $sales_return_amount = 0;

     $sr = $this->account_model->FetchSalesReturnAmount($inv->cci_reffer_no);

     if(!empty($sr))
     {
      $sales_return_amount = $sr;
     }

     $remaining_amount = $remaining_amount - $sales_return_amount;

     $remaining_amount = max($remaining_amount,0);
     
     $data['invoices'].='<tr id="'.$inv->cci_id.'">
     <input type="hidden" name="type[]" value="credit_invoice">
     <input type="hidden" name="credit_account_invoice[]" value="'.$inv->cci_id.'">
     <th>'.$sl.'</th>
     <th>'.date('d-m-Y',strtotime($inv->cci_date)).'</th>
     <th>'.$inv->cci_reffer_no.'</th>
     <th><input class="form-control" name="inv_lpo_ref[]" type="text" value="'.$inv->cci_lpo_reff.'" required></th>
     <th>'.$remaining_amount.'
     <input type="hidden" class="invoice_total_amount" name="total_amount" value="'.$remaining_amount.'">
     </th>
     <th><input class="form-control invoice_receipt_amount" name="inv_receipt_amount[]" maxlength="'.$remaining_amount.'" type="number" value="0"></th>
    
     <th>
     <input class="invoice_add_check" type="checkbox" name="invoice_selected[]" value="'.$inv->cci_total_amount.'">
     </th>
     </tr>';
 
     $data['status']=1;
 
     }

     //$this->RecalculateReceipt($rid);
 
     echo json_encode($data);
 
     }
 
     }
 
 
     //Fetch Invoice And Add Credit End




    //Invoice Add Start

    /*
    public function AddInvoices()
    {

        if($_POST)
        {

            $rid = $this->request->getPost('receipt_id')[0];
          
            $cond_receipt = array('rid_receipt_invoice' => $rid);

            $this->common_model->DeleteData('accounts_receipt_invoice_data',$cond_receipt);

            for($i=0;$i<count($this->request->getPost('inv_receipt_amount'));$i++)
            {

                $type = $this->request->getPost('type')[$i];

                $invoice_id = $this->request->getPost('credit_account_invoice')[$i];

                $receipt_amount  = $this->request->getPost('inv_receipt_amount')[$i];
    
                //echo $this->request->getPost('receipt_id')[$i]; exit;

                $insert_data['rid_receipt_invoice'] = $this->request->getPost('receipt_id')[$i];
    
                $insert_data['rid_invoice'] = $invoice_id;
    
                $insert_data['rid_lpo_ref'] = $this->request->getPost('inv_lpo_ref')[$i];
    
                $insert_data['rid_receipt'] = $this->request->getPost('inv_receipt_amount')[$i];
    
                $insert_data['rid_invoice_type'] = $type;
    
                $check_invoice = $this->common_model->SingleRow('accounts_receipt_invoice_data',array('rid_receipt_invoice' => $insert_data['rid_receipt_invoice'],'rid_invoice' => $insert_data['rid_invoice']));
    
                if(empty($check_invoice))
                {                   
                        if($this->request->getPost('inv_receipt_amount')[$i]>0)
                        {
                            $rid = $this->common_model->InsertData('accounts_receipt_invoice_data',$insert_data);
                        }
                }
                else
                {
    
                $update_cond = array('rid_id' => $check_invoice->rid_id);
    
                $rid =$this->common_model->EditData($insert_data,$update_cond,'accounts_receipt_invoice_data');
    
                }



            if($this->request->getPost('inv_receipt_amount')[$i]>0)

            {

            if($type=="cash_invoice")

            {
          
            $invoice_total = $this->common_model->SingleRowCol('crm_cash_invoice','ci_total_amount',array('ci_id' => $invoice_id));

            $ci_invoice_paid = $this->common_model->SingleRowCol('crm_cash_invoice','ci_paid_amount',array('ci_id' => $invoice_id));
            
            $ci_current_paid = $receipt_amount+$ci_invoice_paid->ci_paid_amount;

            if($invoice_total->ci_total_amount==$ci_current_paid)
            {

            $pay_status = 2;

            }
            else if($ci_current_paid>0)
            {

            $pay_status = 1;

            }
            else
            {
            
            $pay_status = 0;

            }

            $update_invoice['ci_paid_amount'] = $ci_current_paid;

            $update_invoice['ci_paid_status'] = $pay_status;
            
            $this->common_model->EditData($update_invoice,array('ci_id' => $invoice_id),'crm_cash_invoice');

            }

        else
        {


            $invoice_total   = $this->common_model->SingleRowCol('crm_credit_invoice','cci_total_amount',array('cci_id' => $invoice_id));

            $cr_invoice_paid = $this->common_model->SingleRowCol('crm_credit_invoice','cci_paid_amount',array('cci_id' => $invoice_id));
            
            $cr_current_paid = $receipt_amount+$cr_invoice_paid->cci_paid_amount;

            if($invoice_total->cci_total_amount==$cr_current_paid)
            {

            $pay_status = 2;

            }
            else if($cr_current_paid>0)
            {

            $pay_status = 1;

            }
            else
            {
            
            $pay_status = 0;

            }

            $update_cr_invoice['cci_paid_amount'] = $cr_current_paid;

            $update_cr_invoice['cci_paid_status'] = $pay_status;
            
            $this->common_model->EditData($update_cr_invoice,array('cci_id' => $invoice_id),'crm_credit_invoice');
            

        }


    }

            



            }

        }


    }
    
    */


    public function AddInvoices()
    {

            if ($this->request->getPost()) {

                $accountId = $this->request->getPost('account_id');

                $allLinked = $this->session->get('receipt_linked') ?? [];

                // Add or update the data for this account
                $allLinked[$accountId] = $this->request->getPost();

                // Set the grouped session data
                $this->session->set('receipt_linked', $allLinked);

            }

    }

    //Invoice Add End





    //Fetch Sales Orders Advance (Add Receipt) Start




    public function FetchSalesOrdersAdd()
    {

        if($_POST)
        {

        $customer = $this->request->getPost('c_id');

        $credit_id = $this->request->getPost('creditid');

        $sales_orders = $this->account_model->FetchAdvanceSalesOrder($customer);

        $data['status'] = 0;

        $data['so_rows'] ="";

        $sl=0;

        foreach($sales_orders as $so)
        {

        
        $advance_paid = $this->account_model->SalesAdvancePaid($so->so_id);

        $balance_total = $so->so_amount_total-$advance_paid;

        $sl++;

        $data['so_rows'] .='<tr>
        
        <input type="hidden" name="so_credit_id[]" value="'.$credit_id.'">

        <input type="hidden" name="so_id[]" value="'.$so->so_id.'">

        <td>
        '.$sl.'
        </td>

        <td>
        '.$so->so_reffer_no.'
        </td>

        <td>
        '.$so->ca_name.'
        </td>

        <td>
        '.$balance_total.'
        </td>

        <td>
        <input type="number" class="form-control so_receipt_amount" maxlength="'.$balance_total.'" name="so_receipt_amount[]">
        </td>


        <td>
        <input type="checkbox" class="add_so_advance_tick" >
        </td>


        
        </tr>';

        $data['status'] = 1;

        }
        

        echo json_encode($data);

        }


    }


    //Fetch Sales Orders Advance (Add Receipt) End




    //Add Sales Order Advance Start


    public function AddSalesOrderAdvance()
    {

        if($_POST)
        {

            for($i=0;$i<count($this->request->getPost('so_id'));$i++)
            {

                $insert_data['rso_sales_order'] = $this->request->getPost('so_id')[$i];

                $insert_data['rso_receipt_amount'] = $this->request->getPost('so_receipt_amount')[$i];

                $insert_data['rso_credit_id'] = $this->request->getPost('so_credit_id')[$i];

                $check_so = $this->common_model->SingleRow('accounts_receipts_sales_orders',array('rso_credit_id' => $insert_data['rso_credit_id'],'rso_sales_order' => $insert_data['rso_sales_order']));
 
                //Update sales order table //so_advance_paid

                //Current so 

                $so_row = $this->common_model->SingleRow('crm_sales_orders',array('so_id' => $insert_data['rso_sales_order']));
                
                $current_advance = $so_row->so_advance_paid;

                $total_amount = $so_row->so_amount_total;

                $new_advance = (float)$current_advance + (float)$insert_data['rso_receipt_amount'];

                if($new_advance==$total_amount)
                {
                $so_status = 2;
                }
                else
                {
                $so_status  = 1;
                }


                
                if(empty($check_so))
                {
                $ri_id = $this->common_model->InsertData('accounts_receipts_sales_orders',$insert_data);
                }
            
                else
                {
            
                $update_cond = array('rso_id' => $check_so->rso_id);
            
                $ri_id = $check_so->rso_id;
            
                $this->common_model->EditData($insert_data,$update_cond,'accounts_receipts_sales_orders');
            
                }

                //Update sales order
                $update_data_so['so_advance_paid'] = $new_advance;

                $update_data_so['so_pay_status'] = $so_status;

                $update_cond_so['so_id']= $insert_data['rso_sales_order'];

                $this->common_model->EditData($update_data_so,$update_cond_so,'crm_sales_orders');

            }   


        }


        
  

    }



    //Add Sales Order Advance End






    public function UpdateInvoices()
    {



        if($_POST)
        {

            for($i=0;$i<count($this->request->getPost('inv_receipt_amount'));$i++)
            {

            // if(isset($this->request->getPost('invoice_selected')[$i]))

            // {

            if($this->request->getPost('inv_receipt_amount')[$i]>0)

            {
                
            $insert_data['rid_receipt_invoice'] = $this->request->getPost('receipt_id')[$i];

            $insert_data['rid_invoice'] = $this->request->getPost('credit_account_invoice')[$i];

            $insert_data['rid_lpo_ref'] = $this->request->getPost('inv_lpo_ref')[$i];

            $insert_data['rid_receipt'] = $this->request->getPost('inv_receipt_amount')[$i];

        
            $check_invoice = $this->common_model->SingleRow('accounts_receipt_invoice_data',array('rid_receipt_invoice' => $insert_data['rid_receipt_invoice'],'rid_invoice' => $insert_data['rid_invoice']));

            if(empty($check_invoice))
            {
            $rid = $this->common_model->InsertData('accounts_receipt_invoice_data',$insert_data);
            }

            else
            {

            $update_cond = array('rid_id' => $check_invoice->rid_id);

            $rid =$this->common_model->EditData($insert_data,$update_cond,'accounts_receipt_invoice_data');

            }



             }

            

            }

        }


        
    }





    





    public function FetchSalesOrders()
    {

    if($_POST)
    {


        $id = $this->request->getPost('so_id');

        $joins = array(

            array(
                'table' => 'crm_customer_creation',
                'pk' => 'cc_id',
                'fk' => 'so_customer',
                ), 

        );
    
        $data = $this->common_model->SingleRowJoin('crm_sales_orders',array('so_id' => $id),$joins);

        return json_encode($data);

    }


    }



    public function AddAdvanceSalesOrder()
    {


        if($_POST)
        {


            for($i=0;$i<=count($this->request->getPost('so_select'));$i++)
            {

                if(!empty($this->request->getPost('so_select')[$i]))
                {

                    $so_id = $this->request->getPost('so_select')[$i];

                    $so_receipt = $this->request->getPost('so_reciept')[$i];
                    
                    $update_cond['so_id'] = $so_id;

                    $update_data['so_advance_paid'] = $so_receipt;

                    $this->common_model->EditData($update_data,$update_cond,'crm_sales_orders');

                }


            }
            

        


        }


    }







 
    //account head modal 
    public function Edit()
    {
        
        $cond = array('r_id' => $this->request->getPost('r_id'));

         ##Joins if any //Pass Joins as Multi dim array
        $joins = array(
        array(
          'table' => 'accounts_charts_of_accounts',
          'pk' => 'ca_id',
          'fk' => 'r_debit_account',
        )
        );

        $data['rc'] = $this->common_model->SingleRowJoin('accounts_receipts',$cond,$joins);


        $data['rc']->r_date = date('d-F-Y',strtotime($data['rc']->r_date));

        $invoice_cond = array('ri_receipt' => $data['rc']->r_id);

        
        $invoice_joins = array(
            array(
            'table' => 'accounts_charts_of_accounts',
            'pk' => 'ca_id',
            'fk' => 'ri_credit_account',
            ),
        ); 
        

        $invoices = $this->common_model->FetchWhereJoin('accounts_receipt_invoices',$invoice_cond,$invoice_joins);



        //$customers = $this->common_model->FetchAllOrder('crm_customer_creation','cc_customer_name','asc');

        //$coa = $this->common_model->FetchAllOrder('accounts_charts_of_accounts','ca_name','asc');

        /*

        $data['invoices'] = "";

        $dd='';

        foreach($coa as $cus) { 

           $dd.='<option value="'.$cus->ca_id.'">'.$cus->ca_name.'</option>';

        }


        $sl=1;

        foreach($invoices as $invoice)
        {

            $data['invoices'] .='
            <tr class="view_credit" id="view'.$invoice->ri_id.'">
            <input type="hidden" name="credit_id" value="'.$invoice->ri_id.'">

            <td class="sl_no_edit">'.$sl.'</td>


            <td>

            <p class="view">'.$invoice->ca_name.'</p>

            <select style="display:none;" class="edit form-control" name="c_name">

            <option value="'.$invoice->ca_id.'" selected hidden>'.$invoice->ca_name.'</option>

            '.$dd.'
            
            </select>
           
            </td>


            <td>
            
            <p class="view">'.$invoice->ri_amount.'</p>

            <input style="display:none;" class="edit form-control" type="number" name="amount" value="'.$invoice->ri_amount.'">
            
            </td>


            <td>

             <p class="view">'.$invoice->ri_remarks.'</p>

             <input style="display:none;" class="edit form-control" type="text" name="remarks" value="'.$invoice->ri_remarks.'">
            
            </td>


            <!--
            <td>
            
            <div class="view">-->

            <!--<a href="javascript:void(0);" class="edit_invoice btn btn-primary" data-id="'.$invoice->ri_id.'">Edit</a>-->

            <!--<a href="javascript:void(0);" class="edit_linked btn btn-warning" data-rid="'.$invoice->ri_id.'" data-id="'.$invoice->ca_id.'">Linked</a>-->

            <!--
            <a href="javascript:void(0);" class="del_credit btn btn-danger" data-id="'.$invoice->ri_id.'">Delete</a>

            </div>

            <div class="edit" style="display:none;">
            
            <button class="btn btn-success update_invoice_btn" data-id="'.$invoice->ri_id.'" type="button">Update</button>

            <button class="btn btn-danger cancel_invoice_btn" data-id="'.$invoice->ri_id.'" type="button">Cancel</button>

            </div>

            </td>

            </tr>
            -->

            ';

            $sl++;

        }

        */



    $data['invoices'] ="";

    $inv_ser = 0;

    foreach($invoices as $invoice)
    {

    $inv_ser++;

    $inv_data_join = array(
           
           array(
           'table' => 'crm_credit_invoice',
           'pk' => 'cci_id', 
           'fk' => 'rid_invoice',
           ),

           array(
            'table' => 'crm_cash_invoice',
            'pk' => 'ci_id',
            'fk' => 'rid_invoice',
            ),
       );

    $invoice_datas = $this->common_model->FetchWhereJoin('accounts_receipt_invoice_data',array('rid_receipt_invoice'=>$invoice->ri_id),$inv_data_join);


    //Main Invoices

    $data['invoices'] .="<tr>
    <input type='hidden' name='rec_inv_id[]' value='".$invoice->ri_id."'>
    <td>{$inv_ser}</td>
    <td>{$invoice->ca_name}</td>
    <td><input name='rec_inv_amount[]' type='text' value='".$invoice->ri_amount."' class='form-control'></td>
    <td><input name='rec_inv_notes[]' type='text' value='{$invoice->ri_remarks}' class='form-control'></td>
    <td><a href='javascript:void(0)' data-id='{$invoice->ri_id}' class='invoice_delete_btn'>Delete</a></td>
    </tr>";

    

    #ri_credit_account	
    
    if(!empty($invoice_datas))
    {
       //$data['invoices'] .='<th></th><th colspan="3" style="text-align: left;font-size: 13px;">Linked</th>';
    }

    foreach($invoice_datas as $inv_data)
    {
        // Initialize a common date variable
        $invoiceDate = isset($inv_data->ci_date) ? $inv_data->ci_date : $inv_data->cci_date;
        $refNumber = isset($inv_data->ci_reffer_no) ? $inv_data->ci_reffer_no : $inv_data->cci_reffer_no;

        // Sanitize dynamic values for safer rendering
        $ridId = htmlspecialchars($inv_data->rid_id, ENT_QUOTES, 'UTF-8');
        $ridReceipt = htmlspecialchars($inv_data->rid_receipt, ENT_QUOTES, 'UTF-8');
        $formattedDate = htmlspecialchars(date('d M Y', strtotime($invoiceDate)), ENT_QUOTES, 'UTF-8');
        $refNumberEscaped = htmlspecialchars($refNumber, ENT_QUOTES, 'UTF-8');

        // Build the table row
        $data['invoices'] .= "
        <tr>
            <td class='text-end'><i class='ri-links-line'></i></td>
            <td>{$formattedDate}</td>
            <td>
                <input type='hidden' name='linked_invoice_id[$invoice->ri_id][]' value='{$invoice->ri_id}'>
                <input type='hidden' name='linked_receipt_id[$invoice->ri_id][]' value='{$ridId}'>
                <input name='linked_receipt_amount[$invoice->ri_id][]' class='form-control' type='number' step='0.01' value='{$ridReceipt}'>
            </td>
            <td>{$refNumberEscaped}</td>
            <td></td>
        </tr>";

    }


    $so_advance_data_join = array(

        array(
            'table' => 'crm_sales_orders',
            'pk' => 'so_id',
            'fk' => 'rso_sales_order',
            ),

    );
    
    $so_advances = $this->common_model->FetchWhereJoin('accounts_receipts_sales_orders',array('rso_credit_id'=>$invoice->ri_id),$so_advance_data_join);

    foreach($so_advances as $advance)
    {

    $data['invoices'] .="<tr>
    <td></td>
    <td>Advance</td>ed
    <td>".$advance->so_reffer_no."</td>
    
    <td>".$advance->rso_receipt_amount."</td><td></td></tr>";

    }

    }


        echo json_encode($data);

    }



    public function DeleteCredit()
    {

        if($_POST)
        {

        $id = $this->request->getPost('id');

        $cond_receipt = array('ri_id' => $id);


        $invoice = $this->common_model->SingleRow('accounts_receipt_invoices',$cond_receipt);

        $receipt_id = $invoice->ri_receipt;


        $this->common_model->DeleteData('accounts_receipt_invoices',$cond_receipt);

        $cond_data = array('rid_receipt_invoice' => $id);

        $this->common_model->DeleteData('accounts_receipt_invoice_data',$cond_data);

        

        $all_credits = $this->common_model->FetchWhere('accounts_receipt_invoices',array('ri_receipt' => $receipt_id));

        $total = 0;

        foreach($all_credits as $credit)
        {

        $total = $total+=$credit->ri_amount;

        }
        

        $receipt_data['r_amount'] = $total;

        $receipt_cond['r_id'] = $receipt_id;

        $this->common_model->EditData($receipt_data,$receipt_cond,'accounts_receipts');

        $data['total'] = $total;

        echo json_encode($data);

        }


    }




    public function UpdateCreditDetails()
    {

        if($_POST)

        {

        $id = $this->request->getPost('c_id');

        $cond = array('ri_id' => $id);

        //$date = date('Y-m-d',strtotime($this->request->getPost('c_date')));

        $credit_account = $this->request->getPost('c_account');

        $amount = $this->request->getPost('c_amount');

        $narration = $this->request->getPost('c_narration');


        $update_data['ri_credit_account'] = $credit_account;

        $update_data['ri_amount'] = $amount;

        $update_data['ri_remarks'] = $narration;
        
        //$update_data['ri_date'] = $date;

        $this->common_model->EditData($update_data,$cond,'accounts_receipt_invoices');

        $this->FetchCreditData($id);

        }

    }




        // update account head 
        public function Update()
        {    


        $r_id = $this->request->getPost('r_id');

        $cond = array('r_id' => $this->request->getPost('r_id'));

        $update_data['r_date'] = date('Y-m-d',strtotime($this->request->getPost('r_date')));

        //$update_data['r_debit_account'] = $this->request->getPost('r_debit_account');

        $update_data['r_number'] = str_replace(" ","",$this->request->getPost('r_receipt_no'));

                
        //Check Duplicate Receipt Number
                
        $r_no_check = $this->common_model->SingleRow('accounts_receipts',array('r_number' => $update_data['r_number']));

        if((!empty($r_no_check)) && ($r_id != $r_no_check->r_id))
        {

        $return['status'] = 0;

        $return['msg'] ="Duplicate Receipt Number!";

        echo json_encode($return);

        exit;

        }


        $update_data['r_method'] = $this->request->getPost('r_method');


        if($this->request->getPost('r_method')=="1")
        {

        $update_data['r_cheque_no'] = $this->request->getPost('r_cheque_no');

        $update_data['r_cheque_date'] = date('Y-m-d',strtotime($this->request->getpost('r_cheque_date')));

        if ($_FILES['r_cheque_copy']['name'] !== '') {
            $attachment_name = $this->uploadFile('r_cheque_copy','uploads/Receipts');
            $update_data['r_cheque_copy'] = $attachment_name;
        }

        }
        else
        {

        $update_data['r_cheque_no'] =NULL;

        $update_data['r_cheque_date'] =NULL;

        }

        if($this->request->getPost('r_method')=="2")
        {
        $update_data['r_bank'] = "";
        }
        else
        {
        $update_data['r_bank'] = $this->request->getPost('r_bank');
        }

        $update_data['r_collected_by'] = $this->request->getPost('r_collected_by');

        //$update_data['r_bank'] = $this->request->getPost('r_bank');

        $update_data['r_credit_account'] = $this->request->getPost('r_credit_account');


        $update_data['r_amount'] = array_sum($_POST['rec_inv_amount']);


        $this->common_model->EditData($update_data,$cond,'accounts_receipts');


        //Update Receipt Invoices


        //Check Total Credit
        


        for($r=0;$r<(count($this->request->getPost('rec_inv_id')));$r++)
        {

            $update_invoice_data['ri_amount'] = $this->request->getPost('rec_inv_amount')[$r];

            $update_invoice_cond['ri_id'] = $this->request->getPost('rec_inv_id')[$r];

            if(count($this->request->getPost('linked_receipt_id')[$update_invoice_cond['ri_id']]))
            $total_linked_invoice = array_sum($this->request->getPost('linked_receipt_amount')[$update_invoice_cond['ri_id']]);

            if($total_linked_invoice!=$update_invoice_data['ri_amount'])
            {

                $return['status'] = 0;

                $return['msg'] ="Total amount should be adjusted!";
        
                echo json_encode($return);
        
                exit;   

            }


            for($u=0;$u<(count($this->request->getPost('linked_receipt_id')[$update_invoice_cond['ri_id']]));$u++)
            {

                $update_invoice_data_cond = array('rid_id' => $this->request->getPost('linked_receipt_id')[$update_invoice_cond['ri_id']][$u]);

                $old_invoice_data = $this->common_model->SingleRow('accounts_receipt_invoice_data',$update_invoice_data_cond);

                $new_amount =  $this->request->getPost('linked_receipt_amount')[$update_invoice_cond['ri_id']][$u];

                $revert_invoice_amount = $old_invoice_data->rid_receipt;

                //Update invoice table
                if($old_invoice_data->rid_invoice_type=="cash_invoice")
                {

                $cash_invoice_cond = array('ci_id' => $old_invoice_data->rid_invoice);

                $inv_row = $this->common_model->SingleRow('crm_cash_invoice',$cash_invoice_cond);

                
                $this->common_model->EditData(array('rid_receipt' => $new_amount),$update_invoice_data_cond,'accounts_receipt_invoice_data');

                $all_linked_cond = array('rid_invoice_type' => 'cash_invoice','rid_invoice' => $old_invoice_data->rid_invoice);
                $all_linked_invoices = $this->common_model->FetchWhere('accounts_receipt_invoice_data',$all_linked_cond); 

                $update_cash_invoice_data['ci_paid_amount'] = array_sum(array_column($all_linked_invoices,'rid_receipt'));

                $this->common_model->EditData($update_cash_invoice_data,$cash_invoice_cond,'crm_cash_invoice');

                }

                else if($old_invoice_data->rid_invoice_type=="credit_invoice")
                {

                $credit_invoice_cond = array('cci_id' => $old_invoice_data->rid_invoice);

                $inv_row = $this->common_model->SingleRow('crm_credit_invoice',$cash_invoice_cond);

                
                $this->common_model->EditData(array('rid_receipt' => $new_amount),$update_invoice_data_cond,'accounts_receipt_invoice_data');

                $all_linked_cond = array('rid_invoice_type' => 'credit_invoice','rid_invoice' => $old_invoice_data->rid_invoice);
                $all_linked_invoices = $this->common_model->FetchWhere('accounts_receipt_invoice_data',$all_linked_cond); 

                $update_credit_invoice_data['cci_paid_amount'] = array_sum(array_column($all_linked_invoices,'rid_receipt'));

                $this->common_model->EditData($update_credit_invoice_data,$credit_invoice_cond,'crm_credit_invoice');

                }


            }

            

            $this->common_model->EditData($update_invoice_data,$update_invoice_cond,'accounts_receipt_invoices');

        }





        $return['status'] =1;

        echo json_encode($return);

    }




    public function View()
    {

    $id = $this->request->getPost('r_id');
    $cond = array('r_id' => $id);

     ##Joins if any //Pass Joins as Multi dim array
     $joins = array(
           
        array(
        'table' => 'master_receipt_method',
        'pk' => 'rm_id',
        'fk' => 'r_method',
        ),

        array(
        'table' => 'master_banks',
        'pk' => 'bank_id',
        'fk' => 'r_bank',
        ),

        array(
        'table' => 'accounts_charts_of_accounts',
        'pk' => 'ca_id',
        'fk' => 'r_debit_account',
        ),

        array(
        'table' => 'master_collectors',
        'pk' => 'col_id',
        'fk' => 'r_collected_by',
        ),

    );

    $data['rc'] = $this->common_model->SingleRowJoin('accounts_receipts',$cond,$joins);

    $data['rc']->r_date = date('d-F-Y',strtotime($data['rc']->r_date));

    $data['rc']->cheque_date = date('d-F-Y',strtotime($data['rc']->r_cheque_date));

    $invoice_cond = array('ri_receipt' => $data['rc']->r_id);

     $invoice_joins = array(
            array(
            'table' => 'accounts_charts_of_accounts',
            'pk' => 'ca_id',
            'fk' => 'ri_credit_account',
            ),
        ); 
        

    $invoices = $this->common_model->FetchWhereJoin('accounts_receipt_invoices',$invoice_cond,$invoice_joins);

   

    $data['invoices'] ="";

    $inv_ser = 0;

    foreach($invoices as $invoice)
    {

    $inv_ser++;

    $inv_data_join = array(
           
           array(
           'table' => 'crm_credit_invoice',
           'pk' => 'cci_id', 
           'fk' => 'rid_invoice',
           ),

           array(
            'table' => 'crm_cash_invoice',
            'pk' => 'ci_id',
            'fk' => 'rid_invoice',
            ),
   
       );

    $invoice_datas = $this->common_model->FetchWhereJoin('accounts_receipt_invoice_data',array('rid_receipt_invoice'=>$invoice->ri_id),$inv_data_join);

     $data['invoices'] .="<tr>
    <td>{$inv_ser}</td>
    <td>{$invoice->ca_name}</td>
    <td>".format_currency($invoice->ri_amount)."</td>
    <td>{$invoice->ri_remarks}</td>
    </tr>";


    /* Custom var */





    /* Custp, wat */
  

    
    if(empty($data['invoices']))
    {
    
    $data['msg'] = $mdf;

    }

    if(!empty($invoice_datas))
    {
       $data['invoices'] .='<th></th><th colspan="3" style="text-align: left;
                            font-size: 13px;">Linked</th>';
    }




    foreach($invoice_datas as $inv_data)
    {
        if($inv_data->rid_invoice_type=="cash_invoice")
        {
        $data['invoices'] .="<tr>
        <td></td>
        <td>".date('d-F-Y',strtotime($inv_data->ci_date))."</td>
        <td>{$inv_data->ci_reffer_no}</td><td>".format_currency($inv_data->rid_receipt)."</td></tr>";
        }
        else
        {
        $data['invoices'] .="<tr>
        <td></td>
        <td>".date('d M Y',strtotime($inv_data->cci_date))."</td>
        <td>{$inv_data->cci_reffer_no}</td><td>".format_currency($inv_data->rid_receipt)."</td></tr>";
        }

    } 




    $so_advance_data_join = array(

        array(
            'table' => 'crm_sales_orders',
            'pk' => 'so_id',
            'fk' => 'rso_sales_order',
            ),

    );
    
    $so_advances = $this->common_model->FetchWhereJoin('accounts_receipts_sales_orders',array('rso_credit_id'=>$invoice->ri_id),$so_advance_data_join);

    foreach($so_advances as $advance)
    {

    $data['invoices'] .="<tr>
    <td></td>
    <td>Advance</td><td>".$advance->so_reffer_no." (".$advance->rso_remarks.")</td><td>".$advance->rso_receipt_amount."</td></tr>";

    }

    }

    echo json_encode($data);

    }









    //delete account head
    public function Delete()
    {
        //Fetch Receipt
        $cond = array('r_id' => $this->request->getPost('id'));
        $receipt = $this->common_model->SingleRow('accounts_receipts',$cond);

        $cond_receipt = array('ri_receipt' => $this->request->getPost('id'));

        $invoices = $this->common_model->FetchWhere('accounts_receipt_invoices',$cond_receipt);

        foreach($invoices as $inv)
        {



            $main_id = $inv->ri_id;

            //Fetch Invoice Data

            $invoice_data = $this->common_model->FetchWhere('accounts_receipt_invoice_data',array('rid_receipt_invoice' => $main_id));

            foreach($invoice_data as $inv_data)
            { 


                $this->UpdateInvoicePaid($inv_data->rid_invoice,$inv_data->rid_invoice_type);

                //Fetch invoice Column row

                /*
                if($inv_data->rid_invoice_type=="cash_invoice")
                {

                

                $cash_invoice_cond = array('ci_id' => $inv_data->rid_invoice);

                $invoice_row = $this->common_model->SingleRow('crm_cash_invoice',$cash_invoice_cond);

                //Recalculate Paid Amount And Change Status

                if(!empty($invoice_row))

                {
                
                $receipt_paid = $inv_data->rid_receipt;

                $invoice_paid = $invoice_row->ci_paid_amount;

                max($invoice_paid,0);

                $updated_paid = $invoice_paid-$receipt_paid;

                $updated_paid = max($updated_paid,0);
                

                    if($updated_paid>0)
                    {

                    $pay_status = 1;

                    }
                    else
                    {
                    
                    $pay_status = 0;

                    }

                    $update_invoice['ci_paid_amount'] = $updated_paid;

                    $update_invoice['ci_paid_status'] = $pay_status;
                    
                    $this->common_model->EditData($update_invoice,$cash_invoice_cond,'crm_cash_invoice');

                }


                }
                else if($inv_data->rid_invoice_type=="credit_invoice")
                {

                $credit_invoice_cond = array('cci_id' => $inv_data->rid_invoice);

                $invoice_row = $this->common_model->SingleRow('crm_credit_invoice',$credit_invoice_cond);


                if(!empty($invoice_row))

                {

                //Recalculate Paid Amount And Change Status
                
                $receipt_cr_paid = $inv_data->rid_receipt;

                $invoice_cr_paid = $invoice_row->cci_paid_amount;

                max($invoice_cr_paid,0);

                $updated_cr_paid = $invoice_cr_paid-$receipt_cr_paid;

                $updated_cr_paid = max($updated_cr_paid,0);
                

                    if($updated_cr_paid>0)
                    {

                    $pay_cr_status = 1;

                    }
                    else
                    {
                    
                    $pay_cr_status = 0;

                    }

                    $update_cr_invoice['cci_paid_amount'] = $updated_cr_paid;

                    $update_cr_invoice['cci_paid_status'] = $pay_cr_status;
                    
                    $this->common_model->EditData($update_cr_invoice,$credit_invoice_cond,'crm_credit_invoice');

                }

                }

                */

                $cond_so = array('rso_credit_id' => $inv_data->rid_id);
                $this->common_model->DeleteData('accounts_receipts_sales_orders',$cond_so);

                //Delete From Invoice Data Table
                $this->common_model->DeleteData('accounts_receipt_invoice_data',array('rid_id' => $inv_data->rid_id));

            }


        }

        $this->common_model->DeleteData('accounts_receipts',$cond);

        $this->common_model->DeleteData('accounts_receipt_invoices',$cond_receipt);

        

        // $cond_tran = array('tran_reference' => $receipt->r_ref_no);
        // $this->common_model->DeleteData('master_transactions',$cond_tran);
      
    }




    public function DeleteInvoiceOnly()
    {

        if($_POST)
        {

            $main_id = $this->request->getPost('inv_id');

            $receipt_id = $this->request->getPost('rid');

            //Fetch Invoice Data

            $invoice_data = $this->common_model->FetchWhere('accounts_receipt_invoice_data',array('rid_receipt_invoice' => $main_id));

            foreach($invoice_data as $inv_data)
            { 

                //Fetch invoice Column row
                if($inv_data->rid_invoice_type=="cash_invoice")
                {

                $cash_invoice_cond = array('ci_id' => $inv_data->rid_invoice);

                $invoice_row = $this->common_model->SingleRow('crm_cash_invoice',$cash_invoice_cond);

                //Recalculate Paid Amount And Change Status

                if(!empty($invoice_row))

                {
                
                $receipt_paid = $inv_data->rid_receipt;

                $invoice_paid = $invoice_row->ci_paid_amount;

                max($invoice_paid,0);

                $updated_paid = $invoice_paid-$receipt_paid;

                $updated_paid = max($updated_paid,0);
                

                    if($updated_paid>0)
                    {

                    $pay_status = 1;

                    }
                    else
                    {
                    
                    $pay_status = 0;

                    }

                    $update_invoice['ci_paid_amount'] = $updated_paid;

                    $update_invoice['ci_paid_status'] = $pay_status;
                    
                    $this->common_model->EditData($update_invoice,$cash_invoice_cond,'crm_cash_invoice');

                }


                }
                else if($inv_data->rid_invoice_type=="credit_invoice")
                {

                $credit_invoice_cond = array('cci_id' => $inv_data->rid_invoice);

                $invoice_row = $this->common_model->SingleRow('crm_credit_invoice',$credit_invoice_cond);


                if(!empty($invoice_row))

                {

                //Recalculate Paid Amount And Change Status
                
                $receipt_cr_paid = $inv_data->rid_receipt;

                $invoice_cr_paid = $invoice_row->cci_paid_amount;

                max($invoice_cr_paid,0);

                $updated_cr_paid = $invoice_cr_paid-$receipt_cr_paid;

                $updated_cr_paid = max($updated_cr_paid,0);
                

                    if($updated_cr_paid>0)
                    {

                    $pay_cr_status = 1;

                    }
                    else
                    {
                    
                    $pay_cr_status = 0;

                    }

                    $update_cr_invoice['cci_paid_amount'] = $updated_cr_paid;

                    $update_cr_invoice['cci_paid_status'] = $pay_cr_status;
                    
                    $this->common_model->EditData($update_cr_invoice,$credit_invoice_cond,'crm_credit_invoice');

                }

                }

                

                $cond_so = array('rso_credit_id' => $inv_data->rid_id);
                $this->common_model->DeleteData('accounts_receipts_sales_orders',$cond_so);

                //Delete From Invoice Data Table
                $this->common_model->DeleteData('accounts_receipt_invoice_data',array('rid_id' => $inv_data->rid_id));

            }

            $this->common_model->DeleteData('accounts_receipt_invoices',array('ri_id' => $main_id));

            
            $this->FetchEditInvoices($receipt_id);

            $this->RecalculateReceipt($receipt_id);

    }
        

    }



    public function RecalculateReceipt($id)
    {

    $invoice_cond = array('ri_receipt' => $id);

    $invoices = $this->common_model->FetchWhere('accounts_receipt_invoices',$invoice_cond);

    $receipt_total = 0;

    foreach($invoices as $invoice)
    {

    $receipt_total = $receipt_total += $invoice->ri_amount;

    }

    $update_cond = array('r_id' => $id);

    $update_data['r_amount'] = $receipt_total;

    $this->common_model->EditData($update_data,$update_cond,'accounts_receipts');

    return $receipt_total;

    }




    public function FetchEditInvoices($receipt_id)
    {


        
        $invoice_cond = array('ri_receipt' => $receipt_id);
        
        $invoice_joins = array(
            array(
            'table' => 'accounts_charts_of_accounts',
            'pk' => 'ca_id',
            'fk' => 'ri_credit_account',
            ),
        ); 
        

        $invoices = $this->common_model->FetchWhereJoin('accounts_receipt_invoices',$invoice_cond,$invoice_joins);


        $data['invoices'] ="";

        $inv_ser = 0;
    
        foreach($invoices as $invoice)
        {
    
        $inv_ser++;
    
        $inv_data_join = array(
               
               array(
               'table' => 'crm_credit_invoice',
               'pk' => 'cci_id', 
               'fk' => 'rid_invoice',
               ),
    
               array(
                'table' => 'crm_cash_invoice',
                'pk' => 'ci_id',
                'fk' => 'rid_invoice',
                ),
       
           );
    
        $invoice_datas = $this->common_model->FetchWhereJoin('accounts_receipt_invoice_data',array('rid_receipt_invoice'=>$invoice->ri_id),$inv_data_join);
    
        $data['invoices'] .="<tr><td>{$inv_ser}</td><td>{$invoice->ca_name}</td><td>{$invoice->ri_amount}</td><td>{$invoice->ri_remarks}</td><td><a href='javascript:void(0)' data-id='{$invoice->ri_id}' class='invoice_delete_btn'>Delete</a></td></tr>";
        
        if(!empty($invoice_datas))
        {
           $data['invoices'] .='<th></th><th colspan="3" style="text-align: left;
                                font-size: 13px;">Linked</th>';
        }


        if(!empty($data_of_bank))
        {

            $bank_name="DBJ";

        }
        elseif($data_of_bank=="")
        {
        
            $bank_name="No Bank Selected";
            
        }
        else
        {

            $bank_name="Tha Bank";

            $bank_aod = $os;

        }



    
        foreach($invoice_datas as $inv_data)
        {
            if($inv_data->rid_invoice_type=="cash_invoice")
            {
            $data['invoices'] .="<tr>
            <td></td>
            <td>".date('d-F-Y',strtotime($inv_data->ci_date))."</td>
            <td>{$inv_data->ci_reffer_no}</td>
            <td>{$inv_data->rid_receipt}</td>
            <td></td>
            </tr>";
            }
            else
            {
            $data['invoices'] .="<tr>
            <td></td>
            <td>".date('d-F-Y',strtotime($inv_data->cci_date))."</td>
            <td>{$inv_data->cci_reffer_no}</td>
            <td>{$inv_data->rid_receipt}</td
            ><td></td>
            </tr>";
            }
    
        }


         
    
    
        $so_advance_data_join = array(
    
            array(
                'table' => 'crm_sales_orders',
                'pk' => 'so_id',
                'fk' => 'rso_sales_order',
                ),
    
        );
        
        $so_advances = $this->common_model->FetchWhereJoin('accounts_receipts_sales_orders',array('rso_credit_id'=>$invoice->ri_id),$so_advance_data_join);
    
        foreach($so_advances as $advance)
        {
    
        $data['invoices'] .="<tr><td></td><td>Advance</td><td>".$advance->so_reffer_no."</td><td>".$advance->rso_receipt_amount."</td><td></td></tr>";
    
        }
    
        }
        

    echo json_encode($data);



    }





    



    public function EditLinked1()
    {


        if($_POST)
        {

        $id = $this->request->getPost('id'); 

        $rid = $this->request->getPost('r_id');


        $joins = array(
           
        );
    
        //$customer = $this->common_model->SingleRowJoin('crm_customer_creation',array('cc_id' => $id),$joins);

        $customer = $this->common_model->SingleRowJoin('accounts_charts_of_accounts',array('ca_id' => $id),$joins);

        $cond = array('pf_customer' => $customer->ca_id);
    
        $invoices = $this->common_model->FetchWhere('crm_proforma_invoices',$cond);
       
        $data['status']=0;
    
        $data['invoices']="";
    
        $sl =0;
        foreach($invoices as $inv)
        {
        $sl++;
        $data['invoices'].='<tr id="'.$inv->pf_id.'">
        <input type="hidden" name="receipt_id[]" value="'.$rid.'">
        <input type="hidden" name="credit_account_invoice[]" value="'.$id.'">
        <th>'.$sl.'</th>
        <th>'.date('d-m-Y',strtotime($inv->pf_date)).'</th>
        <th>'.$inv->pf_reffer_no.'</th>
        <th><input class="form-control" name="inv_lpo_ref[]" type="text" value="'.$inv->pf_lpo_ref.'" required></th>
        <th>'.$inv->pf_total_amount.'</th>
        <th><input class="form-control" name="inv_receipt_amount[]" type="number"></th>
        <th><input type="checkbox" name="invoice_selected[]" value="'.$inv->pf_id.'"></th>
        </tr>';
    
        $data['status']=1;
    
        }
    
        echo json_encode($data);

        }




    }




    public function EditLinked()
    {

        if($_POST)
        {

        $id = $this->request->getPost('id'); 

        $rid = $this->request->getPost('r_id');

        $joins = array(
            
            array(
                'table' => 'crm_cash_invoice',
                'pk' => 'ci_id',
                'fk' => 'rid_invoice',
                ),

        );
    
        //$customer = $this->common_model->SingleRowJoin('crm_customer_creation',array('cc_id' => $id),$joins);

        $invoices = $this->common_model->SingleRowJoin('accounts_receipt_invoice_data',array('rid_receipt_invoice' => $id),$joins);

        //$cond = array('pf_customer' => $customer->ca_id);
    
        //$invoices = $this->common_model->FetchWhere('crm_proforma_invoices',$cond);
       
        $data['status']=0;
    
        $data['invoices']="";

        $sl_no=0;
        foreach($invoices as $invoice)
        {
        $sl_no++;

        $data['invoices'].='<tr>
        
        </tr>
        ';




        }


    
        $sl =0;
        foreach($invoices as $inv)
        {
        $sl++;
        $data['invoices'].='<tr id="'.$inv->pf_id.'">
        <input type="hidden" name="receipt_id[]" value="'.$rid.'">
        <input type="hidden" name="credit_account_invoice[]" value="'.$id.'">
        <th>'.$sl.'</th>
        <th>'.date('d-m-Y',strtotime($inv->pf_date)).'</th>
        <th>'.$inv->pf_reffer_no.'</th>
        <th><input class="form-control" name="inv_lpo_ref[]" type="text" value="'.$inv->pf_lpo_ref.'" required></th>
        <th>'.$inv->pf_total_amount.'</th>
        <th><input class="form-control" name="inv_receipt_amount[]" type="number"></th>
        <th><input type="checkbox" name="invoice_selected[]" value="'.$inv->pf_id.'"></th>
        </tr>';
    
        $data['status']=1;
    
        }
    
        echo json_encode($data);

        }




    }






    public function EditAddcredit()
    {

        if($_POST)
        {

        $insert_data['ri_receipt'] = $this->request->getPost('receipt_id');

        //$insert_data['ri_date'] = date('Y-m-d',strtotime($this->request->getPost('credit_date')));

        $insert_data['ri_credit_account'] = $this->request->getPost('credit_account');
        
        $insert_data['ri_amount'] = $this->request->getPost('credit_amount');
        
        $insert_data['ri_remarks'] = $this->request->getPost('narration');

        $rid = $this->common_model->InsertData('accounts_receipt_invoices',$insert_data);

        $this->FetchCreditData($rid,1);
            
        }


    }








    public function EditPfInvoice()
     {

        $cond = array('rid_receipt_invoice' => $this->request->getPost('id'));

        $joins = array(

            array(
            'table' => 'crm_proforma_invoices',
            'pk' => 'pf_id',
            'fk' => 'rid_invoice',
            ),
    
        );


        $invoices = $this->common_model->FetchWhereJoin('accounts_receipt_invoice_data',$cond,$joins);
       
        $data['status']=0;
    
        $data['invoices']="";
    
        $sl =0;
        foreach($invoices as $inv)
        {
        $sl++;

        $data['invoices'].=
        
        '
        <tr class="view_pf_invoice" id="edit_pf'.$inv->rid_id.'">

        <input type="hidden" name="ri_id" value="'.$inv->rid_id.'">

        <th>'.$sl.'</th>

        <th>

        <p class="">'.date('d-m-Y',strtotime($inv->pf_date)).'</p>

        </th>


        <th>

        <p class="">'.$inv->pf_reffer_no.'</p>

        </th>


        <th>

        <p class="view">'.$inv->pf_lpo_ref.'</p>

        <input style="display:none;" class="form-control edit" name="lpo_ref" type="text" value="'.$inv->pf_lpo_ref.'">
        
        </th>
        
        <th>
        
        <p class="">'.$inv->pf_total_amount.'</p>

        </th>

        <th>

        <p class="view">'.$inv->rid_receipt.'</p>

        <input style="display:none;" class="form-control edit" name="inv_receipt_amount" type="number" value="'.$inv->rid_receipt.'">
        
        </th>

        <th>

        <div class="view">

        <a href="javascript:void(0);" class="edit_pf_invoice btn btn-primary" data-id="'.$inv->rid_id.'">Edit</a>
        
        </div>

        <div class="edit" style="display:none;">
        
        <button class="btn btn-success update_pf_invoice_btn" data-id="'.$inv->rid_id.'" type="button">Update</button>

        <button class="btn btn-danger cancel_pf_invoice_btn" data-id="'.$inv->rid_id.'" type="button">Cancel</button>

        </div>
        
        </th>

        </tr>'
        
        ;
    
        $data['status']=1;
    
        }
    
        echo json_encode($data);
    

    }



    public function UpdatePfDetails()
    {

    $id = $this->request->getPost('id');

    $cond = array('rid_id' => $id);

    $update_data['rid_lpo_ref'] = $this->request->getPost('lpo_ref');

    $update_data['rid_receipt'] = $this->request->getPost('receipt_amount');

    $this->common_model->EditData($update_data,$cond,'accounts_receipt_invoice_data');

    $this->FetchPfDetails($id);

    }



    public function FetchPfdetails($id)
    {

    $cond = array('rid_id' => $id);

    $joins = array(

        array(
        'table' => 'crm_proforma_invoices',
        'pk' => 'pf_id',
        'fk' => 'rid_invoice',
        ),

    );

    $inv = $this->common_model->SingleRowJoin('accounts_receipt_invoice_data',$cond,$joins);

    $sl = 1;

    $data['inv_id'] = $id ;

    $data['invoices'] = "";

    $data['invoices'].=
        
        '
        <input type="hidden" name="ri_id" value="'.$inv->rid_id.'">

        <th>'.$sl.'</th>

        <th>

        <p class="">'.date('d-m-Y',strtotime($inv->pf_date)).'</p>

        </th>


        <th>

        <p class="">'.$inv->pf_reffer_no.'</p>

        </th>


        <th>

        <p class="view">'.$inv->rid_lpo_ref.'</p>

        <input style="display:none;" class="form-control edit" name="lpo_ref" type="text" value="'.$inv->rid_lpo_ref.'">
        
        </th>
    
        <th>
        
        <p class="">'.$inv->pf_total_amount.'</p>

        </th>

        <th>

        <p class="view">'.$inv->rid_receipt.'</p>

        <input style="display:none;" class="form-control edit" name="inv_receipt_amount" type="number" value="'.$inv->rid_receipt.'">
        
        </th>

        <th>

        <div class="view">

        <a href="javascript:void(0);" class="edit_pf_invoice btn btn-primary" data-id="'.$inv->rid_id.'">Edit</a>
        
        </div>

        <div class="edit" style="display:none;">
        
        <button class="btn btn-success update_pf_invoice_btn" data-id="'.$inv->rid_id.'" type="button">Update</button>

        <button class="btn btn-danger cancel_pf_invoice_btn" data-id="'.$inv->rid_id.'" type="button">Cancel</button>

        </div>
        
        </th>

       '
        ;


        echo json_encode($data);


    }









    public function FetchCreditData($id,$tr="")
    {

    $invoice_cond = array('ri_id' => $id); 

    $data['inv_id'] =  $id;

    $invoice_joins = array(
        array(
        'table' => 'accounts_charts_of_accounts',
        'pk' => 'ca_id',
        'fk' => 'ri_credit_account',
        ),
    );    

    $invoice = $this->common_model->SingleRowJoin('accounts_receipt_invoices',$invoice_cond,$invoice_joins);


    //Recalculate Total

    $receipt_id = $invoice->ri_receipt;


    $all_credits = $this->common_model->FetchWhere('accounts_receipt_invoices',array('ri_receipt' => $receipt_id));

    $total = 0;

    foreach($all_credits as $credit)
    {

    $total = $total+=$credit->ri_amount;

    }

    $receipt_data['r_amount'] = $total;

    $receipt_cond['r_id'] = $receipt_id;

    $this->common_model->EditData($receipt_data,$receipt_cond,'accounts_receipts');

    $data['total'] = $total;

    //



    $customers = $this->common_model->FetchAllOrder('accounts_charts_of_accounts','ca_name','asc');

    $dd='';

    foreach($customers as $cus) { 

       $dd.='<option value="'.$cus->ca_id.'">'.$cus->ca_name.'</option>';

    }


    $data['invoices'] ="";

    if($tr!="")
    {
    $data['invoices'] ='<tr class="view_credit" id="view'.$invoice->ri_id.'">';  
    }

    $data['invoices'] .='
   
    <input type="hidden" name="credit_id" value="'.$invoice->ri_id.'">

    <td class="sl_no_edit_invoice">

    </td>

    <td>

    <p class="view">'.$invoice->ca_name.'</p>

    <select style="display:none;" class="edit form-control" name="c_name">

    <option value="'.$invoice->ca_id.'" selected hidden>'.$invoice->ca_name.'</option>

    '.$dd.'
    
    </select>
   
    </td>


    <td>
    
    <p class="view">'.$invoice->ri_amount.'</p>

    <input style="display:none;" class="edit form-control" type="number" name="amount" value="'.$invoice->ri_amount.'">
    
    </td>


    <td>

     <p class="view">'.$invoice->ri_remarks.'</p>

     <input style="display:none;" class="edit form-control" type="text" name="remarks" value="'.$invoice->ri_remarks.'">
    
    </td>


    <td>
    
    <div class="view">
    
    <!--<a href="javascript:void(0);" class="edit_invoice btn btn-primary" data-id="'.$invoice->ri_id.'">Edit</a>-->
    
    <!--<a href="javascript:void(0);" class="edit_linked btn btn-warning" data-rid="'.$invoice->ri_id.'" data-id="'.$invoice->ca_id.'">Linked</a>-->
   
    <a href="javascript:void(0);" class="del_credit btn btn-danger" data-id="'.$invoice->ri_id.'">Delete</a>
   
    </div>

    <div class="edit" style="display:none;">
    
    <button class="btn btn-success update_invoice_btn" data-id="'.$invoice->ri_id.'" type="button">Update</button>

    <button class="btn btn-danger cancel_invoice_btn" data-id="'.$invoice->ri_id.'" type="button">Cancel</button>

    </div>

    </td>

    ';

    if($tr!="")
    {
    
    $data['invoices'] .='</tr>';

    }

    echo json_encode($data); 

    }







    public function EditInvoice()
    {

  
    $id = $this->request->getPost('inv_id');
  
    $joins =array(

        array(
            'table' => 'crm_customer_creation',
            'pk' => 'cc_id',
            'fk' => 'ri_credit_account',
            ),

    );

    $cond = array('ri_id' => $id);

    $data['ri'] = $this->common_model->SingleRowJoin('accounts_receipt_invoices',$cond,$joins);

    echo json_encode($data);

    }



    public function UpdateInvoice()
    {

    $id = $this->request->getPost('receipt_id');

    $cond = array('ri_id' => $id);

    //$update_data['ri_date'] = $this->request->getPost('ri_date');

    $update_data['ri_credit_account'] = $this->request->getPost('ri_credit_account');

    $update_data['ri_amount'] = $this->request->getPost('ri_amount');

    $update_data['ri_remarks'] = $this->request->getPost('ri_remarks');

    $this->common_model->EditData($update_data,$cond,'accounts_receipt_invoices');
    
    }











    public function SelectedInvoices()
    {

    if($_POST)
    {

    $data['total'] = 0;

    foreach($this->request->getPost('invoice_selected') as $inv)
    {

    $invoice = $this->common_model->SingleRowArray('crm_proforma_invoices',array('pf_id' => $inv));

    $data['html'][] = $invoice;

    $data['total'] = $invoice['pf_total_amount']+$data['total'];

    }

   
    echo json_encode($data);

    }

    }




    public function FetchReference($type="e")
    {

    $uid = $this->common_model->FetchNextId('accounts_receipts',"RV-{$this->data['accounting_year']}-");

    if($type=="e")
    echo $uid;
    else
    {
    return $uid;
    }

    }


    


    public function Print($id=""){

    if($id==""){
    $id =1;
    }



    $cond = array('r_id' => $id);

    ##Joins if any //Pass Joins as Multi dim array
    $joins = array(
              
           array(
           'table' => 'master_receipt_method',
           'pk' => 'rm_id',
           'fk' => 'r_method',
           ),
   
           array(
           'table' => 'master_banks',
           'pk' => 'bank_id',
           'fk' => 'r_bank',
           ),
   
           array(
           'table' => 'accounts_charts_of_accounts',
           'pk' => 'ca_id',
           'fk' => 'r_debit_account',
           ),
   
           array(
           'table' => 'master_collectors',
           'pk' => 'col_id',
           'fk' => 'r_collected_by',
           ),
   
       );

   
    $receipt = $this->common_model->SingleRowJoin('accounts_receipts',$cond,$joins);


    if ($receipt->r_method == "2") {
        $bank_name = "-";
    }

    else
    {
        $bank_name = $receipt->bank_name;
    }


    $cheque_date = "-";

    $cheque_no = "-";

    if ($receipt->r_method == "1") {

        $cheque_date = date('d-F-Y',strtotime($receipt->r_cheque_date));

        $cheque_no =$receipt->r_cheque_no;

    }


    $invoice_cond = array('ri_receipt' => $receipt->r_id);

    $invoice_joins = array(
        array(
        'table' => 'accounts_charts_of_accounts',
        'pk' => 'ca_id',
        'fk' => 'ri_credit_account',
        ),
    ); 

    $invoices = $this->common_model->FetchWhereJoin('accounts_receipt_invoices',$invoice_cond,$invoice_joins);

    $data['invoices'] ="";

    $inv_ser = 0;

    $invoice_datas = array();

    foreach($invoices as $invoice)
    {


    $inv_ser++;

    $inv_data_join = array(
           
           array(
           'table' => 'crm_credit_invoice',
           'pk' => 'cci_id', 
           'fk' => 'rid_invoice',
           ),

           array(
            'table' => 'crm_cash_invoice',
            'pk' => 'ci_id',
            'fk' => 'rid_invoice',
            ),

       );

    

    $invoice_datas = $this->common_model->FetchWhereJoin('accounts_receipt_invoice_data',array('rid_receipt_invoice'=>$invoice->ri_id),$inv_data_join);

    }

    $total_amount = $receipt->r_amount;
   
    $joins_inv = array(
           
    );
   
    $invoices = $this->common_model->FetchWhereJoin('accounts_receipt_invoices',array('ri_receipt'=>$id),$joins_inv);
   

    $invoice_sec = "";

    $first = true;

    
    foreach($invoice_datas as $inv)
    {

    if($first == true)
    {
        //$cus_name = $inv->cc_customer_name;
        $cus_name = $invoice->ca_name;
    }
    else
    {
        $cus_name="";
    }

    $inv_refer = "";

    $inv_date = "";

    $inv_amount = "";

    if(!empty($inv->ci_reffer_no))
    {

        $inv_refer = $inv->ci_reffer_no;

        $inv_date = $inv->ci_date;

        $inv_amount = $inv->cci_total_amount;

    

    }
    else if(!empty($inv->cci_reffer_no))
    {

        $inv_refer = $inv->cci_reffer_no;

        $inv_date = $inv->cci_date;

    }


    $invoice_sec .="
    
    <tr>

    <td align='left'>{$cus_name}</td>

    <td align='center'>{$inv_refer}</td>

    <td align='center'>".date('d-M-Y',strtotime($inv_date))."</td>

    <td align='right'></td>

    <td align='center'>-</td>

    <td align='right'>".format_currency($inv->rid_receipt)."</td>
    
    </tr>

    ";

    $first = false;

    }


    $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
    $fontDirs = $defaultConfig['fontDir'];

    $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
    $fontData = $defaultFontConfig['fontdata'];


    $mpdf = new \Mpdf\Mpdf([
        'format' => 'Letter',
        'default_font_size' => 9, 
        'margin_left' => 5, 
        'margin_right' => 5,
        'fontDir' => array_merge($fontDirs, [
            __DIR__ . '/fonts'
        ]),
        'fontdata' => $fontData + [
            'bentonsans' => [
                'R' => 'FreeSerif.ttf',
                'B' => 'FreeSerifBold.ttf',
            ],
        ],
        'default_font' => 'bentonsans'
        
    ]);


    
    $html ='
    
    <style>
    table
    {
    font-family:"font-family: "freeserif";" !important;
    }

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
    
    <td align="right"><h3>Receipt Voucher</h3></td>

    </tr>

    </table>


    <table  width="100%" style="margin-top:2px;border-top:3px solid;border-bottom:3px solid;overflow:wrap">


    <tr width="100%">
    
    <td width="120px" style="">
    
    Reference :   
    
    </td>


    <td align="left" width="120px" style="text-align:left">
    
    '.$receipt->r_ref_no.'

    </td>


    <td></td>

    <td></td>

    
    <td width="120px" align="left">
    
    Received By : 

    </td>


    <td width="120px">

    '.$receipt->rm_name.'

    
    </td>



    </tr>




    <tr>
    
    <td width="120px">
    
    Date : 
    
    </td>


    <td width="120px">

    '.date('d-F-Y',strtotime($receipt->r_date)).'

    </td>


    <td></td>

    <td></td>

    
    <td width="120px">
    
    Cheque : 

    </td>


    <td width="120px">

    '.$cheque_no.'

    </td>




    </tr>


    

    <tr>
    
    <td >
    
    Debit Account : 
    
    </td>


    <td>
    
    '.$receipt->ca_name.'
    
    </td>
    

    <td></td>

    <td></td>

        
    <td  align="left">
    
    Date :

    </td>

    <td>
    
    '.$cheque_date.'

    </td>
    
    
    </tr>



    <tr>


    <td >
    
    Receipt No : 
    
    </td>


    <td>
    
    '.$receipt->r_number.'

    </td>


    <td></td>

    <td></td>
    
        
    <td align="left">
    
    Bank : 

    </td>


    <td>
    
    '.$bank_name.'

    </td>


    
    </tr>


    

    <tr>
    
    <td >
    
    Division No : 
    
    </td>

    <td>
    
    Al Fuzail
    
    </td>


    <td></td>
    <td></td>
    
        
    <td align="left">
    
    Collected By : 
    
    </td>

    
    <td>
    
    '.$receipt->col_name.'

    </td>
    
    </tr>

   

  


    
    </table>




    <table  width="100%" style="margin-top:2px;">
    

    <tr style="border-bottom:2px solid;border-top:2px solid;">
    
    <td align="center" style="border-bottom:2px solid;">Credit Account</td>

    <td align="center" style="border-bottom:2px solid;">Reference</td>

    <td align="center" style="border-bottom:2px solid;">Invoice Date</td>

    <td align="right" style="border-bottom:2px solid;">Invoice Amount</td>

    <td align="center" style="border-bottom:2px solid;">Due Date</td>

    <td align="right" style="border-bottom:2px solid;">Payment</td>

    </tr>


   '.$invoice_sec.'


    <tr style="padding-top:20px;">
    
   
    <td align="left">Reallocation</td>

    <td align="center"></td>

    <td align="center"></td>

    <td align="right"></td>

    <td align="center"></td>

    <td align="right">0.00</td>

    
    </tr>



     <tr style="padding-top:20px;">
    
   
    <td align="left">Discount</td>

    <td align="center"></td>

    <td align="center"></td>

    <td align="right"></td>

    <td align="center"></td>

    <td align="right">0.00</td>

    
    </tr>


    

    </table>

    ';

    $footer = '

    <table width="100%">
    
    <tr>
    
    <td colpsan="5" align="center"><b>Amount : '.currency_to_words($total_amount).'</b></td>

    <td colspan="1" align="right" style="text-align:right;"><b>'.format_currency($receipt->r_amount).'</b></td>

    </tr>

    </table>


    <table>
    
    <tr>

    <td width="25%" align="center" style="padding-right:60px;">Prepared by : (print)</td>

    <td width="25%" align="center" style="padding-right:60px;">Received by:</td>

    <td width="25%" align="center" style="padding-right:60px;">Finance Manager</td>

    <td width="25%" align="center" style="padding-right:60px;">CEO</td>

    </tr>

    </table>


    ';

    $mpdf->falseBoldWeight = 0;


    $mpdf->WriteHTML($html);
    $mpdf->SetFooter($footer);

    $this->response->setHeader('Content-Type', 'application/pdf');


    // Output the PDF inline to a variable
    /*
    $pdfContent = $mpdf->Output('', 'S'); // 'S' returns the PDF as a string

    // Encode the PDF content to base64
    $pdfBase64 = base64_encode($pdfContent);

    // Create a data URI for the PDF
    $dataUri = 'data:application/pdf;base64,' . $pdfBase64;

    // Output a JavaScript snippet to open the PDF in a new tab and print it
    echo "
    <script>
        var pdfWindow = window.open('about:blank');
        pdfWindow.document.write('<iframe src=\"{$dataUri}\" style=\"width:100%; height:100%;\" frameborder=\"0\"></iframe>');
        pdfWindow.document.close();
        pdfWindow.onload = function() {
            pdfWindow.print();
        };
    </script>
";

    */


    $mpdf->Output();

    }



    // Function to handle file upload
    public function uploadFile($fieldName, $uploadPath)
    {
        $file = $this->request->getFile($fieldName);

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move($uploadPath, $newName);
            return $newName;
        }

        return null;
    }






    public function CreditTotal()
    {

    if($_POST)
    {

    $account = $this->request->getPost('account');

    $credit_amount = $this->account_model->FetchMaxCreditAmount($account);

    echo $credit_amount;

    }


    }



    public function ReceiptNoCheck()
    {

    if($_POST)
    {

    $rno = $this->request->getPost('receipt_no');

    $cond = array('r_number' => $rno);

    $check = $this->common_model->CountWhere('accounts_receipts',$cond);

    if($check>0)
    {

    echo 'false'; 

    }
    else
    {

    echo 'true';

    }

    }

    }




}
