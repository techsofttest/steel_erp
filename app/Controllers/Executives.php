<?php

namespace App\Controllers;

use App\Controllers\BaseController;


class Executives extends BaseController
{

    public function __construct()
    {
       
        // Check if the user is not logged in
        if (!session()->get('admin_login')) {
            // Redirect to the login page if not logged in
            return redirect()->to('Login');
        }

    }


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
       
        $totalRecords = $this->common_model->GetTotalRecords('executives_sales_executive','se_id','DESC');
 
        ## Total number of records with filtering
        $searchColumns = array('se_name');

        $totalRecordwithFilter = $this->common_model->GetTotalRecordwithFilter('executives_sales_executive','se_id',$searchValue,$searchColumns);
    
    
        ##Joins if any //Pass Joins as Multi dim array
        $joins = array(
           
        );
        
        ## Fetch records
        $records = $this->common_model->GetRecord('executives_sales_executive','se_id',$searchValue,$searchColumns,$columnName,$columnSortOrder,$joins,$rowperpage,$start);
        
        $data = array();
        
        $i=1;
        foreach($records as $record ){
           $action = '<a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->se_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a><a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->se_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> Delete</a>';
           
           $data[] = array( 
              "se_id" => $i,
              "se_name"=>$record->se_name,
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
        $data['account_types'] = $this->common_model->FetchAllOrder('accounts_account_types','at_id','asc');

        return view('executives',$data);

    }


    // add account head
    Public function Add()
    {   

        $name = $this->request->getPost('name');

        $insert_data = $this->request->getPost();

        $id = $this->common_model->InsertData('executives_sales_executive',$insert_data);

        $data['status'] = 1;

        echo json_encode($data);

    }


    //account head modal 
    public function Edit()
    {
        
        $cond = array('se_id' => $this->request->getPost('ID'));

        $account_type = $this->common_model->SingleRow('executives_sales_executive',$cond);

        $data = $account_type;

        echo json_encode($data);
    }



    // update account head 
    public function Update()
    {    
        $cond = array('se_id' => $this->request->getPost('se_id'));
        
        $update_data = $this->request->getPost(); 

        // Check if the 'account_id' key exists before unsetting it
        if (array_key_exists('se_id', $update_data)) 
        {
             unset($update_data['se_id']);
        }       

        $this->common_model->EditData($update_data,$cond,'executives_sales_executive');
       
    }



     //delete account head
     public function Delete()
     {
         $cond = array('se_id' => $this->request->getPost('ID'));
 
         $this->common_model->DeleteData('executives_sales_executive',$cond);
 
     }





}