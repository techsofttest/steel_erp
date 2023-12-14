<?php

namespace App\Controllers\Accounts;

use App\Controllers\BaseController;


class JournalVoucher extends BaseController
{
    

    public function FetchData()
    {

        $searchValue = "Cash";

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
       
        $totalRecords = $this->common_model->GetTotalRecords('accounts_journal_voucher','jv_id','DESC');
 
        ## Total number of records with filtering
       
        $totalRecordwithFilter = $this->common_model->GetTotalRecordwithFilter('accounts_journal_voucher','jv_id',$searchValue,'jv_voucher_no');
        
        ##Joins if any //Pass Joins as Multi dim array
        $joins = array();
        ## Fetch records
        
        $records = $this->common_model->GetRecord('accounts_journal_voucher','jv_id',$searchValue,'jv_voucher_no',$columnName,$columnSortOrder,$joins,$rowperpage,$start);
       
 
        $data = array();
        
        $i=1;
        foreach($records as $record ){
            $action = '<a  href="javascript:void(0)" class="edit edit-color acctype_edit" data-toggle="tooltip" data-placement="top" title="edit"  data-acctype="'.$record->jv_id .'" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a><a href="javascript:void(0)" class="delete delete-color acctype_delete" data-toggle="tooltip" data-acctypedel="'.$record->jv_id .'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> Delete</a><a  href="javascript:void(0)" class="view view-color jv_view" data-jvview="'.$record->jv_id .'" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a>';
           
           $data[] = array( 
              "jv_id"=>$i,
              "jv_voucher_no"=>$record->jv_voucher_no,
              "jv_voucher_date"=>date('d-m-Y',strtotime($record->jv_voucher_date)),
              "jv_sales_order_id"=>$record->jv_sales_order_id,
              "jv_account"=>$record->jv_account,
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
        $data['accounts_type'] = $this->common_model->FetchAllOrder('accounts_account_type','at_id','desc'); 

        $data['sales_order'] = $this->common_model->FetchAllOrder('crm_sales_order','so_id','desc');

        $data['content'] = view('accounts/journal-voucher',$data);

        return view('accounts/accounts-module',$data);

        
       
    }




    // add account head
    Public function Add()
    {   
        
        $insert_data = [
            
            'jv_voucher_date'   => $this->request->getPost('jv_date'),

            'jv_sales_order_id' => $this->request->getPost('jv_order'),

            'jv_account'        => $this->request->getPost('jv_account'),

            'jv_debit'          => $this->request->getPost('jv_debit'),

            'jv_credit'         => $this->request->getPost('jv_credit'),

            'jv_narration'      => $this->request->getPost('jv_narration'),

            'jv_added_by'       => 0,

            'jv_added_date'     => date('Y-m-d'),


        ];

        helper('journal_voucher_helper');
        $journal_voucher_id = $this->common_model->InsertData('accounts_journal_voucher',$insert_data);
       
        $voucher_no = journal_voucher($journal_voucher_id,'JV');

      
        $this->common_model->EditData(array('jv_voucher_no' => $voucher_no),array('jv_id' => $journal_voucher_id),'accounts_journal_voucher');
        
    }


    //account head modal 
    public function View()
    {
        
        $cond = array('jv_id' => $this->request->getPost('jv_id'));

        $journal_voucher = $this->common_model->SingleRow('accounts_journal_voucher',$cond);

                         
        $data['jv_voucher_no']      = $journal_voucher->jv_voucher_no;

        $data['jv_voucher_date']    = $journal_voucher->jv_voucher_date;

        $data['jv_sales_order_id']  = $journal_voucher->jv_sales_order_id;

        $data['jv_account']         = $journal_voucher->jv_account;

        $data['jv_debit']           = $journal_voucher->jv_debit;

        $data['jv_credit']          = $journal_voucher->jv_credit;

        $data['jv_narration']       = $journal_voucher->jv_narration;

        echo json_encode($data);
    }




    //account head modal 
    public function HeadEdit()
    {
        
        $cond = array('at_id' => $this->request->getPost('account_id'));

        $account_type = $this->common_model->SingleRow('accounts_account_type',$cond);

        $data['account_type'] = $account_type->at_name;

        echo json_encode($data);
    }



   // update account head 
    public function Update()
    {    
        $cond = array('at_id' => $this->request->getPost('account_id'));

        $update_data = [
            
            'at_name'       => $this->request->getPost('edit_aname'),

            'at_added_by'   => 0,

            'at_modify_date' => date('Y-m-d'),


        ];

        $this->common_model->EditData($update_data,$cond,'accounts_account_type');
        
        

    }



    
    //delete account head
    public function Delete()
    {
        $cond = array('at_id' => $this->request->getPost('account_id'));

        $this->common_model->DeleteData('accounts_account_type',$cond);

        
    }



}
