<?php

namespace App\Controllers\Accounts;

use App\Controllers\BaseController;


class ChartsOfAccounts extends BaseController
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
       
        $totalRecords = $this->common_model->GetTotalRecords('accounts_charts_of_accounts','ca_id','DESC');
 
        ## Total number of records with filtering
       
        $searchColumns = array('ca_name','ca_account_id');

        $totalRecordwithFilter = $this->common_model->GetTotalRecordwithFilter('accounts_charts_of_accounts','ca_id',$searchValue,$searchColumns);
    
        ##Joins if any //Pass Joins as Multi dim array
        $joins = array(
           
            array(
            'table' => 'accounts_account_types',
            'pk' => 'at_id',
            'fk' => 'ca_account_type',
            ),

        );
        ## Fetch records
        $records = $this->common_model->GetRecord('accounts_charts_of_accounts','ca_id',$searchValue,$searchColumns,$columnName,$columnSortOrder,$joins,$rowperpage,$start);
    
        $data = array();

        $i=1;
        foreach($records as $record ){
            $action = '<a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->ca_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a><a href="javascript:void(0)" class="delete delete-color acctype_delete" data-toggle="tooltip" data-acctypedel="'.$record->ca_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> Delete</a>';
           
           $data[] = array( 
              "ca_id"=>$i,
              'at_name' => $record->at_name,
              'ca_account_id' => $record->ca_account_id,
              "ca_name"=>$record->ca_name,
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



    /*
    public function FetchTypes()
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
    */




    //view page
    public function index()
    {   

        $data['account_types'] = $this->common_model->FetchAllOrder('accounts_account_types','at_name','asc');

        $data['content'] = view('accounts/chart-of-accounts',$data);

        return view('accounts/accounts-module',$data);
    }


    // add account head
    Public function Add()
    {   

        $insert_data = $_POST;

        $id = $this->common_model->InsertData('accounts_charts_of_accounts',$insert_data);

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

    //delete account head
    public function Delete()
    {
        $cond = array('at_id' => $this->request->getPost('account_id'));

        $this->common_model->DeleteData('accounts_account_types',$cond);

      
    }



}
