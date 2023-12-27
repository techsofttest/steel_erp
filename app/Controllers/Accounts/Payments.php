<?php

namespace App\Controllers\Accounts;

use App\Controllers\BaseController;


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
       
        $totalRecords = $this->common_model->GetTotalRecords('accounts_payments','pay_id','DESC');
 
        ## Total number of records with filtering
       
        $searchColumns = array('pay_ref_no');

        $totalRecordwithFilter = $this->common_model->GetTotalRecordwithFilter('accounts_payments','pay_id',$searchValue,$searchColumns);
    
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
        $records = $this->common_model->GetRecord('accounts_payments','pay_id',$searchValue,$searchColumns,$columnName,$columnSortOrder,$joins,$rowperpage,$start);
    
        $data = array();

        $i=1;
        foreach($records as $record ){

           $action = '<a  href="javascript:void(0)" class="edit edit-color view_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->pay_id.'" data-original-title="Edit"><i class="ri-eye-fill"></i> View</a> <a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->pay_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a> <a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->pay_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> Delete</a>';
           
           $data[] = array( 
              "pay_id"=>$i,
              'date' => date('d-m-Y',strtotime($record->pay_date)),
              "pay_ref_no" => $record->pay_ref_no,
              'pay_method' => $record->rm_name,
              "bank"=> $record->bank_name,
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

        $data['p_methods'] = $this->common_model->FetchAllOrder('master_receipt_method','rm_name','asc'); 

        $data['banks'] = $this->common_model->FetchAllOrder('master_banks','bank_name','asc');

        $data['accounts'] = $this->common_model->FetchAllOrder('accounts_charts_of_accounts','ca_name','asc');
        
        $data['collectors'] = $this->common_model->FetchAllOrder('master_collectors','col_name','asc');

        $data['customers'] = $this->common_model->FetchAllOrder('crm_customer_creation','cc_customer_name','asc');

        $data['content'] = view('accounts/payments',$data);

        return view('accounts/accounts-module',$data);
    }


    // add account head
        Public function Add()
        {   

        $insert_data['pay_date'] = date('Y-m-d',strtotime($this->request->getPost('p_date')));

        $insert_data['pay_credit_account'] = $this->request->getPost('p_credit_account');

        $insert_data['pay_method'] = $this->request->getPost('p_method');

        $insert_data['pay_amount'] = $this->request->getPost('p_amount');

        if(!empty($this->request->getPost('p_method')==1))
        {

        $insert_data['pay_cheque_no'] = $this->request->getPost('p_cheque_no');

        $insert_data['pay_cheque_date'] = date('Y-m-d',strtotime($this->request->getpost('p_cheque_date')));

        }

        $insert_data['pay_bank'] = $this->request->getPost('p_bank');

        $insert_data['pay_debit_account'] = $this->request->getPost('p_debit_account');

        $insert_data['pay_total'] = $this->request->getPost('p_amount');

        $insert_data['pay_added_by'] = 1;

        $insert_data['pay_added_date'] = date('Y-m-d');

        /*
        if ($_FILES['file']['name'] !== '') {
            $ccAttachCrFileName = $this->uploadFile('file','uploads/Payments');
            $update_data['file'] = $ccAttachCrFileName;
        }
        */


        $id = $this->common_model->InsertData('accounts_payments',$insert_data);


        //Add invoices
        for($i=0;$i<count($this->request->getPost('so_id'));$i++)
        {

        $inv_id = $_POST['so_id'][$i];

        $inv_remarks = $_POST['so_remarks'][$i];

        $insert_inv_data['pi_payment'] = $id;

        $insert_inv_data['pi_invoice'] = $inv_id;

        $insert_inv_data['pi_remarks'] = $inv_remarks;

        $this->common_model->InsertData('accounts_payment_invoices',$insert_inv_data);

        }



        $p_ref_no = 'PAY'.str_pad($id, 7, '0', STR_PAD_LEFT);
        
        $cond = array('pay_id' => $id);

        $update_data['pay_ref_no'] = $p_ref_no;

        $this->common_model->EditData($update_data,$cond,'accounts_payments');

    }

    //refresh table with ajax
 
    //account head modal 
    public function Edit()
    {
        
        $cond = array('ca_id' => $this->request->getPost('id'));

         ##Joins if any //Pass Joins as Multi dim array
         $joins = array(
           
            array(
            'table' => 'accounts_account_types',
            'pk' => 'at_id',
            'fk' => 'ca_account_type',
            ),

        );

        $data = $this->common_model->SingleRowJoin('accounts_charts_of_accounts',$cond,$joins);

        echo json_encode($data);

    }

   // update account head 
    public function Update()
    {    
        $cond = array('ca_id' => $this->request->getPost('id'));

        $update_data = $this->request->getPost(); 

        // Check if the 'account_id' key exists before unsetting it
        if (array_key_exists('id', $update_data)) 
        {
             unset($update_data['id']);
        }       

        $update_data['ca_modify_date'] = date('Y-m-d'); 

        $this->common_model->EditData($update_data,$cond,'accounts_charts_of_accounts');
        
      

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

        array(
            'table' => 'accounts_charts_of_accounts',
            'pk' => 'ca_id',
            'fk' => 'pay_debit_account',
            ),



    );

    $data['payment'] = $this->common_model->SingleRowJoin('accounts_payments',$cond,$joins);

    $joins_inv = array(
        
        array(
        'table' => 'crm_sales_orders',
        'pk' => 'so_id',
        'fk' => 'pi_invoice',
        ),

    );

    $invoices = $this->common_model->FetchWhereJoin('accounts_payment_invoices',array('pi_payment'=>$id),$joins_inv);

    $data['invoices'] ="";

    foreach($invoices as $invoice)
    {

    $data['invoices'] .="<tr><td>".date('d-m-Y',strtotime($invoice->so_date))."</td><td>{$invoice->so_order_no}</td><td>{$invoice->pi_remarks}</td><td>{$invoice->so_total}</td></tr>";
    
    }

    echo json_encode($data);


    }









    //delete account head
    public function Delete()
    {
        $cond = array('pay_id' => $this->request->getPost('id'));

        $this->common_model->DeleteData('accounts_payments',$cond);

      
    }




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









}
