<?php

namespace App\Controllers\Accounts;

use App\Controllers\BaseController;

use NumberToWords\NumberToWords;


class BankRec extends BaseController
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
       
        $totalRecords = $this->common_model->GetTotalRecords('accounts_bank_rec','br_id','DESC');
 
        ## Total number of records with filtering
       
        $searchColumns = array('br_id');

        $totalRecordwithFilter = $this->common_model->GetTotalRecordwithFilter('accounts_bank_rec','br_id',$searchValue,$searchColumns);
    
        ##Joins if any //Pass Joins as Multi dim array
        
        $joins = array(
           
         
            array(
                'table' => 'accounts_charts_of_accounts',
                'pk' => 'ca_id',
                'fk' => 'br_account',
                ),
          

        );

        ## Fetch records
        $records = $this->common_model->GetRecord('accounts_bank_rec','r_id',$searchValue,$searchColumns,$columnName,$columnSortOrder,$joins,$rowperpage,$start);
    
        $data = array();

        $i=1;
        foreach($records as $record ){

           $action = '<a  href="javascript:void(0)" class="edit edit-color view_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->br_id.'" data-original-title="Edit"><i class="ri-eye-fill"></i> View</a> <!--<a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->br_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a>--> <a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->br_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> Delete</a>';
           
           $data[] = array( 
              "br_id"=>$i,
              "add_date" =>  date('d M Y',strtotime($record->br_added_date)),
              "account" => $record->ca_name,
              'br_date' => date('d M Y',strtotime($record->br_date)),
              'balance' => $record->br_bank_balance,
              "debit"=> $record->br_total_debit,
              "credit"=> $record->br_total_credit,
              "difference" => $record->br_unrec_diff,
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


    public function Dum()
    {

    $data['accounting_year'] = "This Year";


    if($data != "That year")
    {

    $data ="Do That";

    }


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

        $data['content'] = view('accounts/bank_rec',$data);


        return view('accounts/accounts-module',$data);


    }



    // add account head
    Public function Add()
    {   

        $insert_data['br_date'] = date('Y-m-d',strtotime($this->request->getPost('add_br_date')));

        $insert_data['br_gl_balance'] = $this->request->getPost('gl_balance');

        $insert_data['br_bank_balance'] = $this->request->getPost('bank_balance');

        $insert_data['br_total_debit'] = $this->request->getPost('total_debit');

        $insert_data['br_total_credit'] = $this->request->getPost('total_credit');

        $insert_data['br_unrec_diff'] = $this->request->getPost('rec_diff');

        $insert_data['br_account'] = $this->request->getPost('br_account');

        $total_tran = count($this->request->getPost('complete_tran_id'));

        if($total_tran==0)
        {

        $data['status'] = 0;

        $data['msg'] = "Select invoices to add";

        echo json_encode($data);

        exit;

        }


        //Check date

        $no_check = true;

        for($t=0;$t<$total_tran;$t++)
        {

            if($this->request->getPost('complete_check')[$t]==1)
            {

                if(empty($this->request->getPost('complete_date')[$t]))
                {

                    $data['status'] = 0;

                    $data['msg'] = "Add date for ".$this->request->getPost('reference')[$t]."";
            
                    echo json_encode($data);
            
                    exit;   

                }

            $no_check=false;
                
            }

        }

        if($no_check==true)
        {
            $data['status'] = 0;

            $data['msg'] = "Select invoices!";
    
            echo json_encode($data);
    
            exit;

        }

        
        if(empty($this->request->getPost('br_id')))

        {

        $insert_data['br_added_by'] = 1;

        $insert_data['br_added_date'] = date('Y-m-d');

        $id = $this->common_model->InsertData('accounts_bank_rec',$insert_data);
        
        }

        else
        {

        $id = $this->request->getPost('br_id');

        $br_cond = array('br_id' => $this->request->getPost('br_id'));

        $this->common_model->EditData($insert_data,$br_cond,'accounts_bank_rec');

        }

        $total_tran = count($this->request->getPost('complete_tran_id'));

        for($t=0;$t<$total_tran;$t++)
        {


            if(!empty($this->request->getPost('complete_check')[$t]))
            {

                $trn_id = $this->request->getPost('complete_tran_id')[$t];

                $trn_rec_date = $this->request->getPost('complete_date')[$t];

                $trn_update['tran_bank_status'] = 1;

                $trn_update['tran_rec_date'] = date('Y-m-d',strtotime($trn_rec_date));

                $trn_cond = array('tran_id' => $trn_id);

                //$this->common_model->EditData($trn_update,$trn_cond,'master_transactions');


                //Fetch transaction

                //$tran_row = $this->common_model->SingleRow('master_transactions',$trn_cond);

                $insert_brc['brc_rec_id'] = $id;

                $insert_brc['brc_voucher_id'] = $trn_id;

                $insert_brc['brc_reference'] = $this->request->getPost('reference')[$t];

                $insert_brc['brc_voucher_type'] = $this->request->getPost('voucher_type')[$t];

                $insert_brc['brc_credit'] = $this->request->getPost('credit_amount')[$t];

                $insert_brc['brc_debit'] = $this->request->getPost('debit_amount')[$t];

                $insert_brc['brc_clear_date'] = date('Y-m-d',strtotime($trn_rec_date));



                $this->common_model->InsertData('accounts_bank_rec_cleared',$insert_brc);


                /*

                 $check_brc_cond =  array(
                
                    'brc_rec_id' => $trn_id,

                    'brc_rec_id' => $id
                );

                $check_brc = $this->common_model->SingleRow('accounts_bank_rec_cleared',$check_brc_cond);

               
                if(!empty($check_brc))
                {


                  $this->common_model->EditData($insert_brc,array('brc_id' => $check_brc->brc_id),'accounts_bank_rec_cleared');

                }

                else
                {

                    $this->common_model->InsertData('accounts_bank_rec_cleared',$insert_brc);

                }
                
                */


                
            }

            



        }


        /*
        $r_ref_no = 'REC'.str_pad($id, 7, '0', STR_PAD_LEFT);

        $cond = array('r_id' => $id);

        $update_data['r_ref_no'] = $r_ref_no;

        $this->common_model->EditData($update_data,$cond,'accounts_receipts');
        */


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

        $data['status'] =1;

        echo json_encode($data);
        

    }

    //refresh table with ajax







    public function AddInvoices()
    {


        if($_POST)
        {

            $rid = $this->request->getPost('receipt_id')[0];

            $cond_receipt = array('rid_receipt_invoice' => $rid);

            $this->common_model->DeleteData('accounts_receipt_invoice_data',$cond_receipt);

            for($i=0;$i<count($this->request->getPost('inv_receipt_amount'));$i++)
            {

            // if(isset($this->request->getPost('invoice_selected')[$i]))

            // {

            if($this->request->getPost('inv_receipt_amount')[$i]>0)

            {

            $invoice_id = $this->request->getPost('credit_account_invoice')[$i];

            $receipt_amount = $this->request->getPost('inv_receipt_amount')[$i];

            $insert_data['rid_receipt_invoice'] = $this->request->getPost('receipt_id')[$i];

            $insert_data['rid_invoice'] = $invoice_id;

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

            $invoice_total = $this->common_model->SingleRowCol('crm_cash_invoice','ci_total_amount',array('ci_id' => $invoice_id));

            
            if($invoice_total->ci_total_amount==$receipt_amount)
            {

            $pay_status = 2;

            }
            else if($receipt_amount>0)
            {

            $pay_status = 1;

            }
            else
            {
            
            $pay_status = 0;

            }

            $update_invoice['ci_paid_amount'] = $receipt_amount;

            $update_invoice['ci_paid_status'] = $pay_status;
            
            $this->common_model->EditData($update_invoice,array('ci_id' => $invoice_id),'crm_cash_invoice');

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


 




 
    //account head modal 
    public function Edit()
    {
        

        $edit_id = $this->request->getPost('id');


        $cond = array('br_id' => $this->request->getPost('id'));

         ##Joins if any //Pass Joins as Multi dim array
        $joins = array(
        array(
          'table' => 'accounts_charts_of_accounts',
          'pk' => 'ca_id',
          'fk' => 'br_account',
        )
        );

        $data['br'] = $this->common_model->SingleRowJoin('accounts_bank_rec',$cond,$joins);

        $data['br']->br_date = date('d-F-Y',strtotime($data['br']->br_date));

        //$data['br']->transactions = "";

        //$account = $this->common_model->FetchBRAccount($data['br']->br_account,$data['br']->br_date);

        $account = $this->common_model->FetchBRC($edit_id);

            $data['transactions'] = "";

            $t=1;

            foreach($account as $tr)
            {
                
                $data['transactions'] .=  '<tr class="tran_row">

                <td>'.$t.'</td>

                <td>'.date('d-F-Y',strtotime("$tr->tran_datetime")).'</td>

                <td>'.$tr->tran_reference.'</td>

                <td>'.$tr->ca_name.'</td>

                <td>'.$tr->tran_debit.'</td>

                <td>'.$tr->tran_credit.'</td>

                <td class="status"><span class="btn btn-success">Cleared</span></td>

                <td><input class="form-control datepicker" type="text" name="complete_date[]" readonly value="'.date("d-F-Y",strtotime($tr->brc_clear_date)).'"></td>
            
                </tr>';

                $t++;

            }

            /*<td>
                <input type="hidden" name="complete_tran_id[]" value="'.$tr->tran_id.'">
                <input class="status_tick" type="checkbox" name="complete_check[]">
                </td>
                
            */

       // $invoice_cond = array('ri_receipt' => $data['rc']->r_id);
        
        $invoice_joins = array(
            array(
            'table' => 'accounts_charts_of_accounts',
            'pk' => 'ca_id',
            'fk' => 'ri_credit_account',
            ),
        ); 
        

       // $invoices = $this->common_model->FetchWhereJoin('accounts_receipt_invoices',$invoice_cond,$invoice_joins);

        //$customers = $this->common_model->FetchAllOrder('crm_customer_creation','cc_customer_name','asc');

        $coa = $this->common_model->FetchAllOrder('accounts_charts_of_accounts','ca_name','asc');

        $data['invoices'] = "";

        $dd='';

        foreach($coa as $cus) { 

           $dd.='<option value="'.$cus->ca_id.'">'.$cus->ca_name.'</option>';

        }


        $sl=1;

        /*

        foreach($invoices as $invoice)
        {

            $data['invoices'] .='
            <tr class="view_credit" id="view'.$invoice->ri_id.'">
            <input type="hidden" name="credit_id" value="'.$invoice->ri_id.'">

            <td>'.$sl.'</td>


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

            <a href="javascript:void(0);" class="edit_linked btn btn-warning" data-rid="'.$invoice->ri_id.'" data-id="'.$invoice->ca_id.'">Linked</a>

            <a href="javascript:void(0);" class="del_credit btn btn-danger" data-id="'.$invoice->ri_id.'">Delete</a>

            </div>

            <div class="edit" style="display:none;">
            
            <button class="btn btn-success update_invoice_btn" data-id="'.$invoice->ri_id.'" type="button">Update</button>

            <button class="btn btn-danger cancel_invoice_btn" data-id="'.$invoice->ri_id.'" type="button">Cancel</button>

            </div>

            </td>

            </tr>

            ';

            $sl++;

        }

        */



        echo json_encode($data);

    }







        // update account head  
        public function Update()
        {    

        $cond = array('br_id' => $this->request->getPost('br_id'));

        $update_data['br_date'] = date('Y-m-d',strtotime($this->request->getPost('br_date')));

        $update_data['br_bank_balance'] = $this->request->getPost('bank_balance');

        $update_data['br_unrec_diff'] = $this->request->getPost('rec_diff');

        $this->common_model->EditData($update_data,$cond,'accounts_bank_rec');

    }




    public function View()
    {

    $id = $this->request->getPost('br_id');

    $cond = array('br_id' => $id);

     ##Joins if any //Pass Joins as Multi dim array
     $joins = array(
           
        array(
        'table' => 'accounts_charts_of_accounts',
        'pk' => 'ca_id',
        'fk' => 'br_account',
        ),

    );

    $data['br'] = $this->common_model->SingleRowJoin('accounts_bank_rec',$cond,$joins);

    $data['rows'] = "";

    $cond_recon = array('brc_rec_id' => $id);

    $invoices = $this->common_model->FetchWhereJoin('accounts_bank_rec_cleared',$cond_recon,array());

    //accounts_bank_rec_cleared

    $i=1;
    foreach($invoices as $invoice)
    {

    $data['rows'].="<tr>";

    $data['rows'] .='
    <td>'.$i++.'</td>
    
    <td class="text-end">'.date('d M Y',strtotime($invoice->brc_clear_date)).'</td>
   
    <td class="text-end">'.$invoice->brc_reference.'</td>

    <td class="text-end">'.format_currency($invoice->brc_debit).'</td>  

    <td class="text-end">'.format_currency($invoice->brc_credit).'</td>

    </tr>
    
    ';

    
    }


    echo json_encode($data);

    }









    //delete account head
    public function Delete()
    {
        $adminId = session('admin_id');

        $segment1 = service('uri')->getSegment(1);

        $segment2 = service('uri')->getSegment(2);

        $check_module = $this->common_model->CheckModule($adminId,$segment1,$segment2);

        if($check_module->up_delete == 0){

           $data['status'] = 0;
           
           $data['msg'] ="Access Denied: You do not have permission for this Action";

           echo json_encode($data);

           exit();
        }
        
        
        $cond = array('br_id' => $id = $this->request->getPost('id'));

        //$receipt = $this->common_model->SingleRow('accounts_receipts',$cond);

        $this->common_model->DeleteData('accounts_bank_rec',$cond);

        $cond_rec = array('brc_rec_id' => $id);

        $this->common_model->DeleteData('accounts_bank_rec_cleared',$cond_rec);

        $data['status'] =1;

        $data['msg'] ="Data Deleted Successfully";

        echo json_encode($data);

    }

    public function AccountFetch()
    {

    if($_POST)
    {

    $id = $this->request->getPost('account_id');
    
    $date = $this->request->getPost('add_date');

    //$return['account'] = $this->common_model->FetchBRAccount($id,$date);

    $return['account_name'] = $this->common_model->SingleRow('accounts_charts_of_accounts',array('ca_id' => $id))->ca_name;

    $return['account'] = $this->report_model->FetchGLTransactions($date_from="",$date="",$account_head="",$account_type="",$account=$id,$time_frame="",$range_from="",$range_to="");

    // print_r($return['account']);

    // exit;

    $keysToRemove = array();

    foreach($return['account'] as $key=>$trn)
    {

    $check_cond['brc_voucher_id'] = $trn->id;

    $check_cond['brc_voucher_type'] = $trn->voucher_type;

    $br_clear = $this->common_model->SingleRow('accounts_bank_rec_cleared',$check_cond); 

    if(!empty($br_clear))
    {

    $keysToRemove[] = $key;

    }
    
    }

    // Remove objects using the keys
    foreach ($keysToRemove as $key) {
        unset($return['account'][$key]);
    }

    $return['account'] = array_values($return['account']);


    $return['transactions'] = "";

    $return['total_credit'] = array_sum(array_column($return['account'],'credit_amount'));

    $return['total_debit'] = array_sum(array_column($return['account'],'debit_amount'));

    $return['gl_balance'] = $return['total_debit']-$return['total_credit'];


    $t=1;
    $cb=0;

    foreach($return['account'] as $tr)
    {
    
    $debit_amount = format_currency($tr->debit_amount) ?: "";

    

        
    $return['transactions'] .=  '<tr class="tran_row">

        <td>'.$t.'
        <input type="hidden" name="voucher_type[]" value="'.$tr->voucher_type.'">
        <input type="hidden" name="reference[]" value="'.$tr->reference.'">
        </td>

        <td>'.date('d M Y',strtotime($tr->transaction_date)).'</td>

        <td>'.$tr->reference.'</td>

        <td>'.$tr->account_name.'</td>

        <td align="right">'.$debit_amount.'
        <input type="hidden" name="debit_amount[]" value="'.$tr->debit_amount.'">
        </td>

        <td align="right">'.format_currency($tr->credit_amount).'
        <input type="hidden" name="credit_amount[]" value="'.$tr->credit_amount.'">
        </td>

        <td class="status"><span class="btn btn-warning">Outstanding</span></td>

        <td>
        <input type="hidden" name="complete_tran_id[]" value="'.$tr->id.'">
        <input type="hidden" name="complete_check['.$cb.']" value="0" />
        <input class="status_tick" type="checkbox" name="complete_check['.$cb.']" value="1">
        </td>


        <td><input class="form-control datepicker" type="text" name="complete_date[]" readonly ></td>
       
        </tr>';

        $t++;
        $cb++;

    }


    echo json_encode($return);

    }


    }



    public function EditAccountFetch()
    {

    if($_POST)
    {

    $id = $this->request->getPost('account_id');
    
    $date = $this->request->getPost('add_date');

    $return['account'] = $this->common_model->FetchBRAccount($id,$date);

    $return['transactions'] = "";

    $t=1;
    $cb=0;

    foreach($return['account']['transactions'] as $tr)
    {
        
    $return['transactions'] .=  '<tr class="tran_row">

        <td>'.$t.'</td>

        <td>'.date('d-F-Y',strtotime("$tr->tran_datetime")).'</td>

        <td>'.$tr->tran_reference.'</td>

        <td>'.$tr->ca_name.'</td>

        <td>'.$tr->tran_debit.'</td>

        <td>'.$tr->tran_credit.'</td>

        <td class="status"><span class="btn btn-warning">Outstanding</span></td>

        <td>
        <input type="hidden" name="complete_tran_id[]" value="'.$tr->tran_id.'">
        <input class="status_tick" type="checkbox" name="complete_check['.$cb.']">
        </td>

        <td><input class="form-control datepicker" type="text" name="complete_date[]" readonly></td>
       
        </tr>';

        $t++;
        $cb++;

    }


    echo json_encode($return);

    }


    }





    public function AddAccess(){
        
        $data['status'] = "";

        $data['msg'] ="";

        $adminId = session('admin_id'); 

        $segment1 = service('uri')->getSegment(1);

        $segment2 = service('uri')->getSegment(2);

        $check_module = $this->common_model->CheckModule($adminId,$segment1,$segment2);

        if($check_module->up_add == 0){
           
            $data['status'] = 0 ;

            $data['msg'] ="Access Denied: You do not have permission for this Action";
 

        }
        

        echo json_encode($data); 
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










}
