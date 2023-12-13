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
 
        ## Total number of records without filtering
        /*$users = new Users();
        $totalRecords = $users->select('id')
                      ->countAllResults();*/
                      
        $totalRecords = $this->common_model->GetTotalRecords('accounts_account_type','at_id');
 
        ## Total number of records with filtering
        /*$totalRecordwithFilter = $users->select('id')
             ->orLike('name', $searchValue)
             ->orLike('email', $searchValue)
             ->orLike('city', $searchValue)
             ->countAllResults();*/

        $totalRecordwithFilter = $this->common_model->GetTotalRecordwithFilter('accounts_account_type','at_id',$searchValue,'at_name');
    
        ## Fetch records
        /*$records = $users->select('*')
             ->orLike('name', $searchValue)
             ->orLike('email', $searchValue)
             ->orLike('city', $searchValue)
             ->orderBy($columnName,$columnSortOrder)
             ->findAll($rowperpage, $start);*/
        
        $records = $this->common_model->GetRecord('accounts_account_type','at_id',$searchValue,'at_name',$columnName,$columnSortOrder,$rowperpage,$start);
    
 
        $data = array();
 
        foreach($records as $record ){
 
           $data[] = array( 
              "id"=>$record['at_id'],
              "name"=>$record['at_name'],
              "edit" => ""
           ); 
        }
 
        ## Response
        $response = array(
         "draw" => intval($draw),
         "iTotalRecords" => $totalRecords,
         "iTotalDisplayRecords" => $totalRecordwithFilter,
         "aaData" => $data,
         "token" => csrf_hash() // New token hash
        );
 
        return $this->response->setJSON($response);
        /*pagination end*/
    } 

    //view page
    public function index()
    {   

        $data['accounts_type'] = $this->common_model->FetchAll('accounts_account_type');

        $data['account_head'] = $this->common_model->FetchAllOrder('accounts_account_type','at_id','DESC');

        return view('accounts/accounts-module',$data);
    }


    // add account head
    Public function Add()
    {   
        
        $insert_data = [
            
            'at_name'       => $this->request->getPost('aname'),

            'at_added_by'   => 0,

            'at_added_date' => date('Y-m-d'),


        ];

        $id = $this->common_model->InsertData('accounts_account_type',$insert_data);

        $this->RefreshTable();

        
    }

    //refresh table with ajax
    public function RefreshTable()
    {
        $account_head = $this->common_model->FetchAllOrder('accounts_account_type','at_id','DESC');
        
        $data['output'] =' <table id="" class="table table-bordered table-striped delTable"><thead><tr><th class="no-sort">Sl no</th><th>Account Type</th><th>Actions</th></tr> </thead><tbody>';
        
        $i = 1;
        foreach ($account_head as $acc_head) 
        {
            $data['output'] .= '<tr><td>'.$i.'</td><td>'.$acc_head->at_name.'</td><td><a href="javascript:void(0)" class="edit edit-color acctype_edit" data-acctype="'.$acc_head->at_id.'"  data-toggle="tooltip" data-placement="top" title="edit" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a><a href="javascript:void(0)" class="delete delete-color acctype_delete" data-acctypedel="'.$acc_head->at_id.'" data-toggle="tooltip" data-placement="top" title="Delete"><i class="ri-delete-bin-fill"></i> Delete</a></td></tr>';
            $i++;
        }

        $data['output'] .='</tbody></table>';
        
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
        
        $this->RefreshTable();

    }

    //delete account head
    public function Delete()
    {
        $cond = array('at_id' => $this->request->getPost('account_id'));

        $this->common_model->DeleteData('accounts_account_type',$cond);

        $this->RefreshTable();
    }



}
