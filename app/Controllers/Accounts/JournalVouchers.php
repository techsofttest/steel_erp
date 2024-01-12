<?php

namespace App\Controllers\Accounts;

use App\Controllers\BaseController;


class JournalVouchers extends BaseController
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
       
        $totalRecords = $this->common_model->GetTotalRecords('accounts_journal_vouchers','jv_id','DESC');
 
        ## Total number of records with filtering
         $searchColumns = array('jv_voucher_no');

        
        $totalRecordwithFilter = $this->common_model->GetTotalRecordwithFilter('accounts_journal_vouchers','jv_id',$searchValue,$searchColumns);
        
        ##Joins if any //Pass Joins as Multi dim array
        $joins = array(
          
        );
        ## Fetch records
        
        $records = $this->common_model->GetRecord('accounts_journal_vouchers','jv_id',$searchValue,$searchColumns,$columnName,$columnSortOrder,$joins,$rowperpage,$start);
       
 
        $data = array();
        
        $i=1;
        foreach($records as $record ){
            $action = '<a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->jv_id .'" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a><a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->jv_id .'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> Delete</a><a  href="javascript:void(0)" class="view view-color jv_view" data-jvview="'.$record->jv_id .'" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a>';
           
           $data[] = array( 
              "jv_id"=>$i,
              "jv_voucher_date"=>date('d-m-Y',strtotime($record->jv_date)),
              "jv_voucher_no"=>$record->jv_voucher_no,
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
    

    public function FetchTypes()
    {

        $page= !empty($_GET['page']) ? $_GET['page'] : 0;
        $term = !empty($_GET['term']) ? $_GET['term'] : "";
        $resultCount = 10;
        $end = ($page - 1) * $resultCount;       
        $start = $end + $resultCount;
      
        $data['result'] = $this->common_model->FetchAllLimit('crm_sales_order','so_order_no','asc',$term,$start,$end);

        $data['total_count'] =count($data['result']);

        return json_encode($data);

    }


    public function AccountFetchTypes()
    {

        $page= !empty($_GET['page']) ? $_GET['page'] : 0;
        $term = !empty($_GET['term']) ? $_GET['term'] : "";
        $resultCount = 10;
        $end = ($page - 1) * $resultCount;       
        $start = $end + $resultCount;
      
        $data['result'] = $this->common_model->FetchAllLimit('accounts_account_types','at_name','asc',$term,$start,$end);

        $data['total_count'] =count($data['result']);

        return json_encode($data);

    }



    //view page
    public function index()
    {  
        
        $data['accounts'] = $this->common_model->FetchAllOrder('accounts_charts_of_accounts','ca_name','asc');

        $data['sales_orders'] = $this->common_model->FetchAllOrder('crm_sales_orders','so_id','desc');

        $data['content'] = view('accounts/journal-vouchers',$data);

        return view('accounts/accounts-module',$data);

        
    }




    // add
    Public function Add()
    {   

        $insert_data['jv_added_by'] = 0; 

        $insert_data['jv_added_date'] = date('Y-m-d'); 

        $insert_data['jv_date'] = date('Y-m-d',strtotime($this->request->getPost('jv_date')));

        $insert_data['jv_total'] = $this->request->getPost('jv_total');

        $id = $this->common_model->InsertData('accounts_journal_vouchers',$insert_data);


        for($i=0;$i<count($this->request->getPost('jv_sale_invoice'));$i++)
        {

            $sales_invoice = $_POST['jv_sale_invoice'][$i];

            $account = $_POST['jv_account'][$i];

            $debit = $_POST['jv_debit'][$i];

            $credit = $_POST['jv_credit'][$i];

            $remarks = $_POST['jv_remarks'][$i];


            $insert_invoice['ji_sales_order_id'] =  $sales_invoice;

            $insert_invoice['ji_account'] = $account;

            $insert_invoice['ji_debit'] = $debit;

            $insert_invoice['ji_credit'] = $credit;

            $insert_invoice['ji_narration'] = $remarks;

            $insert_invoice['ji_voucher_id'] = $id;

            $this->common_model->InsertData('accounts_journal_invoices',$insert_invoice);


        }

        $jv_no = 'JV'.str_pad($id, 7, '0', STR_PAD_LEFT);
        
        $cond = array('jv_id' => $id);

        $update_data['jv_voucher_no'] = $jv_no;

        $this->common_model->EditData($update_data,$cond,'accounts_journal_vouchers');

    }


    //view
    public function View()
    {
        
        $cond = array('jv_id' => $this->request->getPost('jv_id'));

        $joins = array(
            array(
                'table' => 'accounts_account_type',
                'pk' => 'at_id',
                'fk' => 'jv_account',
                ),
            array(
                'table' => 'crm_sales_order',
                'pk' => 'so_id',
                'fk' => 'jv_sales_order_id',
            ),
        );

        $journal_voucher = $this->common_model->SingleRowJoin('accounts_journal_voucher',$cond,$joins);

        $data['jv_voucher_no']      = $journal_voucher->jv_voucher_no;

        $data['jv_voucher_date']    = date('d-m-Y',strtotime($journal_voucher->jv_voucher_date));

        $data['jv_sales_order_id']  = $journal_voucher->so_order_no;

        $data['jv_account']         = $journal_voucher->at_name;

        $data['jv_debit']           = $journal_voucher->jv_debit;

        $data['jv_credit']          = $journal_voucher->jv_credit;

        $data['jv_narration']       = $journal_voucher->jv_narration;

        echo json_encode($data);
    }




    //Edit 
    public function Edit()
    {
        
        $cond = array('jv_id' => $this->request->getPost('ID'));

        

        $joins = array(
            array(
                'table' => 'accounts_account_type',
                'pk' => 'at_id',
                'fk' => 'jv_account',
                ),
            array(
                'table' => 'crm_sales_order',
                'pk' => 'so_id',
                'fk' => 'jv_sales_order_id',
            ),
        );

        $fetch_data = $this->common_model->SingleRowJoin('accounts_journal_voucher',$cond,$joins);

        $sales_order = $this->common_model->FetchAllOrder('crm_sales_order','so_id','desc');

        $accounts_type = $this->common_model->FetchAllOrder('accounts_account_type','at_id','desc');

        $data['jv_voucher_no']     = $fetch_data->jv_voucher_no;

        $data['jv_voucher_date']   = $fetch_data->jv_voucher_date;

        $data['jv_debit']          = $fetch_data->jv_debit;

        $data['jv_credit']         = $fetch_data->jv_credit;

        $data['jv_narration']      = $fetch_data->jv_narration;
         
        $data['order'] ="";

        foreach($sales_order as $order)
        {
            $data['order'] .='<option value='.$order->so_id.'';
            if($order->so_id == $fetch_data->jv_sales_order_id){
            $data['order'] .=    " selected ";}
            $data['order'] .='>' .$order->so_order_no. '</option>'; 
        }
        
        $data['account']="";
        
        foreach($accounts_type as $type)
        {
            $data['account'] .='<option value='.$type->at_id.'';
            if($type->at_id == $fetch_data->jv_account){
            $data['account'] .= " selected ";}
            $data['account'] .= '>'.$type->at_name.'</option>';
            
        }

        echo json_encode($data);
    }



   // update 
    public function Update()
    {    
        $cond = array('jv_id' => $this->request->getPost('jv_id'));
        
        $update_data = $this->request->getPost(); 

        // Check if the 'account_id' key exists before unsetting it
        if (array_key_exists('jv_id', $update_data)) 
        {
             unset($update_data['jv_id']);
        }       

        $update_data['jv_added_by'] = 0; 

        $update_data['jv_modify_date'] = date('Y-m-d'); 



        $this->common_model->EditData($update_data,$cond,'accounts_journal_voucher');
       
    }



    
    //delete 
    public function Delete()
    {
        $cond = array('jv_id' => $this->request->getPost('ID'));

        $this->common_model->DeleteData('accounts_journal_voucher',$cond);

        
    }

    //fetch order
    public function FetchOrder()
    {
        $cond = array('so_id' => $this->request->getPost('ID'));
        $fetch_data = $this->common_model->SingleRow('crm_sales_order',$cond);
        $data['order_no'] = $fetch_data->so_order_no;

        echo json_encode($data);
        
    }



}
