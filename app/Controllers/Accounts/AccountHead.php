<?php

namespace App\Controllers\Accounts;

use App\Controllers\BaseController;

class AccountHead extends BaseController
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
       
        $totalRecords = $this->common_model->GetTotalRecords('accounts_account_heads','ah_id','DESC');
 
        ## Total number of records with filtering
        $searchColumns = array('ah_account_name');

        $totalRecordwithFilter = $this->common_model->GetTotalRecordwithFilter('accounts_account_heads','ah_id',$searchValue,$searchColumns);
    
    
        ##Joins if any //Pass Joins as Multi dim array
        $joins = array(
            array(
                'table' => 'accounts_account_types',
                'pk' => 'at_id',
                'fk' => 'ah_account_type',
                )
           
        );
        
        ## Fetch records
        $records = $this->common_model->GetRecord('accounts_account_heads','ah_id',$searchValue,$searchColumns,$columnName,$columnSortOrder,$joins,$rowperpage,$start);
        
        $data = array();
        
        $i=1;
        foreach($records as $record ){
            $action = '
            <a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="Edit"  data-id="'.$record->ah_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i></a>
            <a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->ah_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i></a>';
           
           $data[] = array( 
              "ah_head_id"=>$record->ah_head_id,
              "ah_account_name"=>$record->ah_account_name,
              "ah_account_type"=>$record->at_name,
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
        $data['account_types'] = $this->common_model->FetchAllOrder('accounts_account_types','at_name','asc');

        $data['content'] = view('accounts/account-head',$data);

        return view('accounts/accounts-module',$data);

    }


    // add account head
    Public function Add()
    {   

        $a_id = $this->request->getPost('ah_head_id');

        $a_name = $this->request->getPost('ah_account_name');


        $id_check = $this->common_model->SingleRow('accounts_account_heads',array('ah_head_id' => $a_id));

        $name_check = $this->common_model->SingleRow('accounts_account_heads',array('ah_account_name' => $a_name));


        if(!empty($id_check))
        {

        $data['message'] = "Duplicate Id";
        $data['status']=0;
        
        }
        else if(!empty($name_check))
        {

        $data['message'] = "Duplicate Name";
        $data['status']=0;

        }

        else{
        
        $data['status']=1;
        
        $insert_data = $this->request->getPost();

        $insert_data['ah_added_by'] = 0; 

        $insert_data['ah_added_date'] = date('Y-m-d'); 

        $id = $this->common_model->InsertData('accounts_account_heads',$insert_data);

        }

        echo json_encode($data);

    }


    //account head modal 
    public function Edit()
    {
        
        $data['msg'] = "";

        $data['status'] ="";

        $adminId = session('admin_id'); 

        $segment1 = service('uri')->getSegment(1);

        $segment2 = service('uri')->getSegment(2);

        $check_module = $this->common_model->CheckModule($adminId,$segment1,$segment2);

        if($check_module->up_edit == 0){
           
            $data['msg'] = "Access Denied: You do not have permission for this Action";
        
            $data['status'] = 0;

            echo json_encode($data);

            exit();

        }
        
        $cond = array('ah_id' => $this->request->getPost('ID'));

        $account_type = $this->common_model->SingleRow('accounts_account_heads',$cond);

        $data = $account_type;

        echo json_encode($data);
    }


    // update account head 
    public function Update()
    {    
        $cond = array('ah_id' => $this->request->getPost('ah_id'));
        
        $update_data = $this->request->getPost(); 

        // Check if the 'account_id' key exists before unsetting it
        if (array_key_exists('ah_id', $update_data)) 
        {
             unset($update_data['ah_id']);
        }       

        $update_data['ah_modified_date'] = date('Y-m-d'); 

        $this->common_model->EditData($update_data,$cond,'accounts_account_heads');
       
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
        
        $cond = array('ah_id' => $this->request->getPost('ID'));
 
        $this->common_model->DeleteData('accounts_account_heads',$cond);

        $data['status'] =1;

        $data['msg'] ="Data Deleted Successfully";

        echo json_encode($data);
 
    }



     //Common For Select 2 Dropdown

    public function FetchHeads($where="")
    {

        $page= !empty($_GET['page']) ? $_GET['page'] : 0;
        $term = !empty($_GET['term']) ? $_GET['term'] : "";
        $resultCount = 10;
        $end = ($page - 1) * $resultCount;       
        $start = $end + $resultCount;

        if($term !="")
        $where="ah_account_name LIKE '%$term%'";

        $data['result'] = $this->common_model->FetchWhereArrayLimit('accounts_account_heads','ah_account_name','asc',$where,$end,$start);
      
        //$data['result'] = $this->common_model->FetchAllLimit('accounts_charts_of_accounts','ca_name','asc',$term,$start,$end);

        $data['total_count'] = count($data['result']);

        return json_encode($data);

    }




    public function FetchTypes($where="")
    {

        $page= !empty($_GET['page']) ? $_GET['page'] : 0;
        $term = !empty($_GET['term']) ? $_GET['term'] : "";
        $resultCount = 10;
        $end = ($page - 1) * $resultCount;       
        $start = $end + $resultCount;

        if($term !="")
        $where="at_name LIKE '%$term%'";

        $data['result'] = $this->common_model->FetchWhereArrayLimit('accounts_account_types','at_name','asc',$where,$end,$start);
      
        //$data['result'] = $this->common_model->FetchAllLimit('accounts_charts_of_accounts','ca_name','asc',$term,$start,$end);

        $data['total_count'] = count($data['result']);

        return json_encode($data);

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





}