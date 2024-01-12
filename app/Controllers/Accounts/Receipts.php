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

 
        ## Total number of records without filtering
       
        $totalRecords = $this->common_model->GetTotalRecords('accounts_receipts','r_id','DESC');
 
        ## Total number of records with filtering
       
        $searchColumns = array('r_number');

        $totalRecordwithFilter = $this->common_model->GetTotalRecordwithFilter('accounts_receipts','r_id',$searchValue,$searchColumns);
    
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
        $records = $this->common_model->GetRecord('accounts_receipts','r_id',$searchValue,$searchColumns,$columnName,$columnSortOrder,$joins,$rowperpage,$start);
    
        $data = array();

        $i=1;
        foreach($records as $record ){

           $action = '<a  href="javascript:void(0)" class="edit edit-color view_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->r_id.'" data-original-title="Edit"><i class="ri-eye-fill"></i> View</a> <a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->r_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a> <a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->r_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> Delete</a>';
           
           $data[] = array( 
              "r_id"=>$i,
              "receipt_no" => $record->r_number,
              "reference" => $record->r_ref_no,
              'date' => date('d-m-Y',strtotime($record->r_date)),
              'receipt_method' => $record->rm_name,
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

        $data['r_methods'] = $this->common_model->FetchAllOrder('master_receipt_method','rm_name','asc');

        $data['banks'] = $this->common_model->FetchAllOrder('master_banks','bank_name','asc');

        $data['accounts'] = $this->common_model->FetchAllOrder('accounts_charts_of_accounts','ca_name','asc');

        $data['collectors'] = $this->common_model->FetchAllOrder('master_collectors','col_name','asc');

        $data['customers'] = $this->common_model->FetchAllOrder('crm_customer_creation','cc_customer_name','asc');

        $data['content'] = view('accounts/receipts',$data);

        return view('accounts/accounts-module',$data);
    }


    // add account head
    Public function Add()
    {   

        $insert_data['r_date'] = $this->request->getPost('r_date');

        $insert_data['r_debit_account'] = $this->request->getPost('r_debit_account');

        $insert_data['r_number'] = $this->request->getPost('r_receipt_no');

        $insert_data['r_method'] = $this->request->getPost('r_method');

        if(!empty($this->request->getPost('r_method')==1))
        {

        $insert_data['r_cheque_no'] = $this->request->getPost('r_cheque_no');

        $insert_data['r_cheque_date'] = date('Y-m-d',strtotime($this->request->getpost('r_cheque_date')));

        }

        $insert_data['r_collected_by'] = $this->request->getPost('r_collected_by');

        $insert_data['r_bank'] = $this->request->getPost('r_bank');

        $insert_data['r_credit_account'] = $this->request->getPost('r_credit_account');

        $insert_data['r_amount'] = $this->request->getPost('r_amount');

        $insert_data['r_added_by'] = 1;

        $insert_data['r_added_date'] = date('Y-m-d');

        $id = $this->common_model->InsertData('accounts_receipts',$insert_data);

        //Add invoices
        for($i=0;$i<count($this->request->getPost('pf_id'));$i++)
        {

        $inv_id = $_POST['pf_id'][$i];

        $inv_remarks = $_POST['pf_remarks'][$i];

        $insert_inv_data['ri_receipt'] = $id;

        $insert_inv_data['ri_invoice'] = $inv_id;

        $insert_inv_data['ri_remarks'] = $inv_remarks;

        $this->common_model->InsertData('accounts_receipt_invoices',$insert_inv_data);

        }
        
        $r_ref_no = 'REC'.str_pad($id, 7, '0', STR_PAD_LEFT);

        $cond = array('r_id' => $id);

        $update_data['r_ref_no'] = $r_ref_no;

        $this->common_model->EditData($update_data,$cond,'accounts_receipts');

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
        
        /*
        
        */
      

    }




    public function View()
    {

    $id = $this->request->getPost('id');

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

    $data['receipt'] = $this->common_model->SingleRowJoin('accounts_receipts',$cond,$joins);

    $joins_inv = array(
        
        array(
        'table' => 'crm_proforma_invoices',
        'pk' => 'pf_id',
        'fk' => 'ri_invoice',
        ),

    );

    $invoices = $this->common_model->FetchWhereJoin('accounts_receipt_invoices',array('ri_receipt'=>$id),$joins_inv);

    $data['invoices'] ="";

    foreach($invoices as $invoice)
    {

    $data['invoices'] .="<tr><td>".date('d-m-Y',strtotime($invoice->pf_date))."</td><td>{$invoice->pf_uid}</td><td>{$invoice->ri_remarks}</td><td>{$invoice->pf_total_cost}</td></tr>";
    
    }

    echo json_encode($data);

    }









    //delete account head
    public function Delete()
    {
        $cond = array('r_id' => $this->request->getPost('id'));

        $this->common_model->DeleteData('accounts_receipts',$cond);

      
    }





    public function FetchInvoices()
    {

    if($_POST)
    {

    $ac_id = $this->request->getPost('id');

    $joins = array(
           
    );

    $customer = $this->common_model->SingleRowJoin('crm_customer_creation',array('cc_account_id' => $ac_id),$joins);

    $cond = array('pf_customer' => $customer->cc_id);

    $invoices = $this->common_model->FetchWhere('crm_proforma_invoices',$cond);

    $data="";

    foreach($invoices as $inv)
    {

    $data.='<tr id="'.$inv->pf_id.'">
    <th class="checkbx"><input type="checkbox" name="invoice_selected[]" value="'.$inv->pf_id.'"></th>
    <th>'.date('d-m-Y',strtotime($inv->pf_date)).'</th>
    <th>'.$inv->pf_uid.'</th>
    <th>'.$inv->pf_total_cost.'</th>
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

    $invoice = $this->common_model->SingleRowArray('crm_proforma_invoices',array('pf_id' => $inv));

    $data['html'][] = $invoice;

    $data['total'] = $invoice['pf_total_cost']+$data['total'];

    }

   
    echo json_encode($data);

    }



    }


    


    public function Print(){


    $mpdf = new \Mpdf\Mpdf();

    $html ='

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
    
    <td align="right"><h3>Receipt Voucher</h3></td>

    </tr>

    </table>


    <table  width="100%" style="margin-top:2px;border-top:3px solid;border-bottom:3px solid;">

    <tr>
    
    <td width="50%">
    
    Reference : RV-2020-0418
    
    </td>
    
        
    <td width="50%" align="right">
    
    Received By : Cheque

    </td>
    
    </tr>


    <tr>
    
    <td width="50%">
    
    Date : RV-2020-0418
    
    </td>
    
        
    <td width="50%" align="right">
    
    Cheque : 90289
    </td>
    
    </tr>


    <tr>
    
    <td width="50%">
    
    Debit Account : RV-2020-0418
    
    </td>
    
        
    <td width="50%" align="right">
    
    Date : 10-02-2923
    </td>
    
    </tr>


    <tr>
    
    <td width="50%">
    
    Receipt No : RV-2020-0418
    
    </td>
    
        
    <td width="50%" align="right">
    
    Bank : 10-02-2923

    </td>
    
    </tr>



    <tr>
    
    <td width="50%">
    
    Division No : RV-2020-0418
    
    </td>
    
        
    <td width="50%" align="right">
    
    Collected By : Faisel
    
    </td>
    
    </tr>


    
    </table>




    <table  width="100%" style="margin-top:2px;">
    

    <tr  style="border-bottom:3px solid;">
    
    <th align="left">Credit Account</th>

    <th align="left">Reference</th>

    <th align="left">Invoice Date</th>

    <th align="left">Invoice Amount</th>

    <th align="left">Due Date</th>

    <th align="left">Payment</th>

    </tr>



    <tr>


    
    <td>SAB Trading Co</td>

    <td>Ref123</td>

    <td>10-01-2024</td>

    <td>1350</td>

    <td>15-01-2024</td>

    <td>2500</td>
    
    </tr>


    <tr>
    
    <td>SAB Trading Co</td>

    <td>Ref123</td>

    <td>10-01-2024</td>

    <td>1350</td>

    <td>15-01-2024</td>

    <td>2500</td>
    
    </tr>


    <tr>
    
    <td>SAB Trading Co</td>

    <td>Ref123</td>

    <td>10-01-2024</td>

    <td>1350</td>

    <td>15-01-2024</td>

    <td>2500</td>
    
    </tr>
    
    </table>

    ';

    $footer = '

    <table>
    
    <tr>
    
    <td>Amount : Qatari Riyals Twenty seven thousand five hundred only</td>

    <td>27,500</td>

    </tr>

    </table>


    <table>
    
    <tr>

    <th style="padding-right:50px;">Prepared by : (print)</th>

    <th style="padding-right:50px;">Received by:</th>

    <th style="padding-right:50px;">Finance Manager</th>

    <th style="padding-right:50px;">CEO</th>

    </tr>

    </table>


    ';

    
    $mpdf->WriteHTML($html);
    $mpdf->SetFooter($footer);
    $this->response->setHeader('Content-Type', 'application/pdf');
    $mpdf->Output();

    }









}
