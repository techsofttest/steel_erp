<?php

namespace App\Controllers\Crm;

use App\Controllers\BaseController;


class ProductHead extends BaseController
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
       
        $totalRecords = $this->common_model->GetTotalRecords('crm_product_heads','ph_id','DESC');
 
        ## Total number of records with filtering
       
        $searchColumns = array('ph_code','ph_product_head');

        $totalRecordwithFilter = $this->common_model->GetTotalRecordwithFilter('crm_product_heads','ph_id',$searchValue,$searchColumns);
    
        ##Joins if any //Pass Joins as Multi dim array
        $joins = array();
        ## Fetch records
        $records = $this->common_model->GetRecord('crm_product_heads','ph_id',$searchValue,$searchColumns,$columnName,$columnSortOrder,$joins,$rowperpage,$start);
    
        $data = array();

        $i=1;
        foreach($records as $record ){
            $action = '<a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->ph_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a><a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->ph_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> Delete</a>';
           
           $data[] = array( 
              "ph_id"=>$i,
              'ph_code' => $record->ph_code,
              'ph_product_head' => $record->ph_product_head,
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
       
        $data['content'] = view('crm/product_heads');

        return view('crm/crm-module',$data);

    }


    // add account head
    Public function Add()
    {   
        
        $insert_data = $this->request->getPost();

        $insert_data['ph_added_by'] = 0; 

        $insert_data['ph_added_date'] = date('Y-m-d'); 

        $id = $this->common_model->InsertData('crm_product_heads',$insert_data);

    }


    //account head modal 
    public function Edit()
    {
        
        $cond = array('ph_id' => $this->request->getPost('ID'));

        $product_head = $this->common_model->SingleRow('crm_product_heads',$cond);

        $data['product_code'] = $product_head->ph_code;

        $data['ph_product_head'] = $product_head->ph_product_head;

        echo json_encode($data);
    }


    // update account head 
    public function Update()
    {    
        $cond = array('ph_id' => $this->request->getPost('ph_id'));
        
        $update_data = $this->request->getPost(); 

        // Check if the 'account_id' key exists before unsetting it
        if (array_key_exists('ph_id', $update_data)) 
        {
             unset($update_data['ph_id']);
        }       

        
        $update_data['ph_modified_date'] = date('Y-m-d'); 

        $this->common_model->EditData($update_data,$cond,'crm_product_heads');
       
    }

     //delete account head
     public function Delete()
     {
         $cond = array('ph_id' => $this->request->getPost('ID'));
 
         $this->common_model->DeleteData('crm_product_heads',$cond);
 
         
     }





}
