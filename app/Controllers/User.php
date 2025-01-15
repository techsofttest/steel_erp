<?php

namespace App\Controllers;

use App\Controllers\BaseController;


class User extends BaseController
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
       
        $totalRecords = $this->common_model->GetTotalRecords('steel_users','user_id','DESC');
 
        ## Total number of records with filtering
       
        $searchColumns = array('user_name');

        $totalRecordwithFilter = $this->common_model->GetTotalRecordwithFilter('steel_users','user_id',$searchValue,$searchColumns);
    
        ##Joins if any //Pass Joins as Multi dim array
        $joins = array(
           
            
        );
        ## Fetch records
        $records = $this->common_model->GetRecord('steel_users','user_id',$searchValue,$searchColumns,$columnName,$columnSortOrder,$joins,$rowperpage,$start);
    
        $data = array();

        $i=1;
        foreach($records as $record){

           
            $action = ' S
            <a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="Edit"  data-id="'.$record->user_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i></a>
            <a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->user_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i></a>
           ';

          
           
           $data[] = array( 
              "user_id"       => $i,
              'user_name'     => $record->user_name,
              'action'        => $action,
             
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
        $data['customer_creation'] = $this->common_model->FetchAllOrder('crm_customer_creation','cc_id','desc');

        $data['sales_executive'] = $this->common_model->FetchAllOrder('executives_sales_executive','se_id','desc');
        
        $data['products'] = $this->common_model->FetchAllOrder('crm_products','product_id','desc');

        $data['employees'] = $this->common_model->FetchAllOrder('employees','employees_id','desc');

        $data['enquiry_id'] = $this->common_model->FetchNextId('crm_enquiry','ENQ');
        
        return view('user',$data);

    }

    public function FetchDetails(){
        
        $userId = $this->request->getPost('ID');

        $user_data = $this->common_model->FetchUserDet($userId);

        print_r($user_data); exit();

        $i=1;

        $data['user_details'] = '';

            foreach($user_data as $user){

            $data['user_details'] .='<tr>
                <td>'.$i.'</td>
                <td>'.$user->user_name.'</td>';
                if($user->up_permission == 1){

                    $data['user_details'] .='<td>Yes</td>';
                }
              
            $data['user_details'] .='</tr>'; 

            }

            $i++;  
        

        echo json_encode($data);
        

    }


    public function ChangePassword()
    {

        if($this->request->getPost('user_id') != session()->get('admin_id'))
        {

            $cond = array('user_id' => $this->request->getPost('user_id'));

            $update_data['user_password'] = sha1($this->request->getPost('user_password')); 

            // Check if the 'account_id' key exists before unsetting it
            if (array_key_exists('user_id', $update_data)) 
            {
                unset($update_data['user_id']);
            }       

            $this->common_model->EditData($update_data,$cond,'users');

        }


    }




}
