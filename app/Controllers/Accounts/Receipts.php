<?php

namespace App\Controllers\Accounts;

use App\Controllers\BaseController;

use NumberToWords\NumberToWords;


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

        $data['sales_orders'] = $this->common_model->FetchAllOrder('crm_sales_orders','so_id','asc');

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

        $insert_data['r_amount'] = $this->request->getPost('total_receipt_amount');

        if(!empty($this->request->getPost('r_method')==1))
        {

        $insert_data['r_cheque_no'] = $this->request->getPost('r_cheque_no');

        $insert_data['r_cheque_date'] = date('Y-m-d',strtotime($this->request->getpost('r_cheque_date')));

        }

        $insert_data['r_collected_by'] = $this->request->getPost('r_collected_by');

        $insert_data['r_bank'] = $this->request->getPost('r_bank');

        $insert_data['r_amount'] = $this->request->getPost('total_receipt_amount');

        $insert_data['r_added_by'] = 1;

        $insert_data['r_added_date'] = date('Y-m-d');

        $id = $this->common_model->InsertData('accounts_receipts',$insert_data);

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

            for($i=0;$i<count($this->request->getPost('r_credit_account'));$i++)
            {

                $insert_inv_data['ri_receipt'] = $id;

                $insert_inv_data['ri_date'] = $_POST['inv_date'][$i];

                $insert_inv_data['ri_credit_account'] = $_POST['r_credit_account'][$i];
                
                $insert_inv_data['ri_amount'] = $_POST['inv_amount'][$i];

                $insert_inv_data['ri_remarks'] = $_POST['narration'][$i];
                
                $this->common_model->InsertData('accounts_receipt_invoices',$insert_inv_data);

            }

        }


        

        
        $r_ref_no = 'REC'.str_pad($id, 7, '0', STR_PAD_LEFT);

        $cond = array('r_id' => $id);

        $update_data['r_ref_no'] = $r_ref_no;

        $this->common_model->EditData($update_data,$cond,'accounts_receipts');

        echo $id;

    }

    //refresh table with ajax







    public function AddInvoices()
    {


        if($_POST)
        {

            for($i=0;$i<count($this->request->getPost('inv_receipt_amount'));$i++)
            {

            if(isset($this->request->getPost('invoice_selected')[$i]))

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




    public function UpdateInvoices()
    {



        if($_POST)
        {

            for($i=0;$i<count($this->request->getPost('inv_receipt_amount'));$i++)
            {

            if(isset($this->request->getPost('invoice_selected')[$i]))

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







 
    //account head modal 
    public function Edit()
    {
        
        $cond = array('r_id' => $this->request->getPost('r_id'));

         ##Joins if any //Pass Joins as Multi dim array
        $joins = array(
        
        );

        $data['rc'] = $this->common_model->SingleRowJoin('accounts_receipts',$cond,$joins);

        $invoice_cond = array('ri_receipt' => $data['rc']->r_id);

        $invoice_joins = array(
            array(
            'table' => 'crm_customer_creation',
            'pk' => 'cc_id',
            'fk' => 'ri_credit_account',
            ),
        );    

        $invoices = $this->common_model->FetchWhereJoin('accounts_receipt_invoices',$invoice_cond,$invoice_joins);

        $customers = $this->common_model->FetchAllOrder('crm_customer_creation','cc_customer_name','asc');

        $data['invoices'] = "";

        $dd='';

        foreach($customers as $cus) { 

           $dd.='<option value="'.$cus->cc_id.'">'.$cus->cc_customer_name.'</option>';

        }


        foreach($invoices as $invoice)
        {

            $data['invoices'] .='
            <tr class="view_credit" id="view'.$invoice->ri_id.'">
            <input type="hidden" name="credit_id" value="'.$invoice->ri_id.'">

            <td>

            <p class="view">'.date('d-m-Y',strtotime($invoice->ri_date)).'</p>

            <input style="display:none;" class="edit form-control" type="date" name="date" value="'.date('Y-m-d',strtotime($invoice->ri_date)).'">

            </td>


            <td>

            <p class="view">'.$invoice->cc_customer_name.'</p>

            <select style="display:none;" class="edit form-control" name="c_name">

            <option value="'.$invoice->cc_id.'" selected>'.$invoice->cc_customer_name.'</option>

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
            <a href="javascript:void(0);" class="edit_invoice btn btn-primary" data-id="'.$invoice->ri_id.'">Edit</a>
            
            <a href="javascript:void(0);" class="view_linked btn btn-warning" data-id="'.$invoice->ri_id.'">Linked</a>
            </div>

            <div class="edit" style="display:none;">
            
            <button class="btn btn-success update_invoice_btn" type="button">Update</button>

            <button class="btn btn-danger cancel_invoice_btn" data-id="'.$invoice->ri_id.'" type="button">Cancel</button>

            </div>

            </td>

            </tr>

            ';

        }

        echo json_encode($data);

    }



    public function UpdateCreditDetails()
    {

        if($_POST)
        {

        $id = $this->request->getPost('c_id');

        $cond = array('ri_id' => $id);

        $date = date('Y-m-d',strtotime($this->request->getPost('c_date')));

        $credit_account = $this->request->getPost('c_account');

        $amount = $this->request->getPost('c_amount');

        $narration = $this->request->getPost('c_narration');


        $update_data['ri_credit_account'] = $credit_account;

        $update_data['ri_amount'] = $amount;

        $update_data['ri_remarks'] = $narration;
        
        $update_data['ri_date'] = $date;

        $this->common_model->EditData($update_data,$cond,'accounts_receipt_invoices');

        $this->FetchCreditData($id);

        }

    }




   // update account head 
        public function Update()
        {    

        $cond = array('r_id' => $this->request->getPost('r_id'));

        $update_data['r_date'] = $this->request->getPost('r_date');

        $update_data['r_debit_account'] = $this->request->getPost('r_debit_account');

        $update_data['r_number'] = $this->request->getPost('r_receipt_no');

        $update_data['r_method'] = $this->request->getPost('r_method');

        $update_data['r_collected_by'] = $this->request->getPost('r_collected_by');

        $update_data['r_bank'] = $this->request->getPost('r_bank');

        $update_data['r_credit_account'] = $this->request->getPost('r_credit_account');

        $this->common_model->EditData($update_data,$cond,'accounts_receipts');
       

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

    $data['invoices'] .="<tr><td>".date('d-m-Y',strtotime($invoice->pf_date))."</td><td>{$invoice->pf_reffer_no}</td><td>{$invoice->ri_remarks}</td><td>{$invoice->pf_total_amount}</td></tr>";
    
    }

    echo json_encode($data);

    }









    //delete account head
    public function Delete()
    {

        $cond = array('r_id' => $this->request->getPost('id'));

        $this->common_model->DeleteData('accounts_receipts',$cond);

        $cond_receipt = array('ri_receipt' => $this->request->getPost('id'));

        $this->common_model->DeleteData('accounts_receipt_invoices',$cond_receipt);

        $cond_so = array('rso_receipt' => $this->request->getPost('id'));

        $this->common_model->DeleteData('accounts_receipts_sales_orders',$cond_so);

      
    }





    public function FetchInvoices()
    {

    if($_POST)
    {

    $ac_id = $this->request->getPost('id');

    $insert_data['ri_receipt'] = $this->request->getPost('rid');

    $insert_data['ri_credit_account'] = $ac_id;

    $insert_data['ri_amount'] = $this->request->getPost('camount');

    $insert_data['ri_remarks'] = $this->request->getPost('cnarration');

    $insert_data['ri_date'] = date('Y-m-d',strtotime($this->request->getPost('cdate')));

    $check_invoice = $this->common_model->SingleRow('accounts_receipt_invoices',array('ri_receipt' => $insert_data['ri_receipt'],'ri_credit_account' => $insert_data['ri_credit_account']));

    if(empty($check_invoice))
    {
    $rid = $this->common_model->InsertData('accounts_receipt_invoices',$insert_data);
    }

    else
    {

    $update_cond = array('ri_id' => $check_invoice->ri_id);

    $rid =$this->common_model->EditData($insert_data,$update_cond,'accounts_receipt_invoices');

    }


    //$rid =1;

    $joins = array(
           
    );

    $customer = $this->common_model->SingleRowJoin('crm_customer_creation',array('cc_id' => $ac_id),$joins);

    $cond = array('pf_customer' => $customer->cc_id);

    $invoices = $this->common_model->FetchWhere('crm_proforma_invoices',$cond);
   
    $data['status']=0;

    $data['invoices']="";

    $sl =0;
    foreach($invoices as $inv)
    {
    $sl++;
    $data['invoices'].='<tr id="'.$inv->pf_id.'">
    <input type="hidden" name="receipt_id[]" value="'.$rid.'">
    <input type="hidden" name="credit_account_invoice[]" value="'.$ac_id.'">
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
        
        <a href="javascript:void(0);" class="view_pf_linked btn btn-warning" data-id="'.$inv->rid_id.'">Linked</a>

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









    public function FetchCreditData($id)
    {

    $invoice_cond = array('ri_id' => $id); 

    $data['inv_id'] =  $id;

    $invoice_joins = array(
        array(
        'table' => 'crm_customer_creation',
        'pk' => 'cc_id',
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



    $customers = $this->common_model->FetchAllOrder('crm_customer_creation','cc_customer_name','asc');

    $dd='';

    foreach($customers as $cus) { 

       $dd.='<option value="'.$cus->cc_id.'">'.$cus->cc_customer_name.'</option>';

    }


    $data['invoices'] ="";

    $data['invoices'] .='
   
    <input type="hidden" name="credit_id" value="'.$invoice->ri_id.'">

    <td>

    <p class="view">'.date('d-m-Y',strtotime($invoice->ri_date)).'</p>

    <input style="display:none;" class="edit form-control" type="date" name="date" value="'.date('Y-m-d',strtotime($invoice->ri_date)).'">

    </td>


    <td>

    <p class="view">'.$invoice->cc_customer_name.'</p>

    <select style="display:none;" class="edit form-control" name="c_name">

    <option value="'.$invoice->cc_id.'" selected hidden>'.$invoice->cc_customer_name.'</option>

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
    <a href="javascript:void(0);" class="edit_invoice btn btn-primary" data-id="'.$invoice->ri_id.'">Edit</a>
    
    <a href="javascript:void(0);" class="view_linked btn btn-warning" data-id="'.$invoice->ri_id.'">Linked</a>
    </div>

    <div class="edit" style="display:none;">
    
    <button class="btn btn-success update_invoice_btn" type="button">Update</button>

    <button class="btn btn-danger cancel_invoice_btn" data-id="'.$invoice->ri_id.'" type="button">Cancel</button>

    </div>

    </td>

    ';


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

    $update_data['ri_date'] = $this->request->getPost('ri_date');

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




    public function FetchReference()
    {

    $uid = $this->common_model->FetchNextId('accounts_receipts',"REC");

    echo $uid;

    }


    


    public function Print(){

    $id =13;

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


    $total_amount = NumberToWords::transformNumber('en',$receipt->r_amount); // outputs "fifty dollars ninety nine cents"
   
       $joins_inv = array(
           array(
           'table' => 'crm_proforma_invoices',
           'pk' => 'pf_id',
           'fk' => 'ri_invoice',
           ),

           array(
            'table' => 'crm_customer_creation',
            'pk' => 'cc_id',
            'table2' => 'crm_proforma_invoices',
            'fk' => 'pf_customer',
           ),
   
       );
   
    $invoices = $this->common_model->FetchWhereJoin('accounts_receipt_invoices',array('ri_receipt'=>$id),$joins_inv);
   

    $invoice_sec = "";

    $first = true;

    
    foreach($invoices as $inv)
    {

    if($first == true)
    {
        $cus_name = $inv->cc_customer_name;
    }
    else
    {
        $cus_name="";
    }

    $invoice_sec .="
    
    <tr>

    <td>{$cus_name}</td>

    <td>{$inv->pf_reffer_no}</td>

    <td>".date('d-m-Y',strtotime($inv->pf_date))."</td>

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
    
    Reference : '.$receipt->r_ref_no.'
    
    </td>
    
        
    <td width="50%" align="right">
    
    Received By : '.$receipt->rm_name.'

    </td>
    
    </tr>


    <tr>
    
    <td width="50%">
    
    Date : '.date('d-m-Y',strtotime($receipt->r_date)).'
    
    </td>
    
        
    <td width="50%" align="right">
    
    Cheque : 90289

    </td>
    
    </tr>


    <tr>
    
    <td width="50%">
    
    Debit Account : '.$receipt->ca_name.'
    
    </td>
    
        
    <td width="50%" align="right">
    
    Date : 10-02-2923

    </td>
    
    </tr>


    <tr>
    
    <td width="50%">
    
    Receipt No : '.$receipt->r_number.'
    
    </td>
    
        
    <td width="50%" align="right">
    
    Bank : '.$receipt->bank_name.'

    </td>
    
    </tr>



    <tr>
    
    <td width="50%">
    
    Division No : RV-2020-0418
    
    </td>
    
        
    <td width="50%" align="right">
    
    Collected By : '.$receipt->col_name.'
    
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


   '.$invoice_sec.'


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
    
    <td colpsan="5" align="left"><b>Amount : Qatari Riyals '.$total_amount.' Only</b></td>

    <td colspan="1" align="left" style="text-align:right;"><b>'.$receipt->r_amount.'</b></td>

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











}
