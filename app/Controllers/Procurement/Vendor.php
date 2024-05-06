<?php

namespace App\Controllers\Procurement;

use App\Controllers\BaseController;


class Vendor extends BaseController
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
       
        $totalRecords = $this->common_model->GetTotalRecords('pro_vendor','ven_id','DESC');
 
        ## Total number of records with filtering
       
        $searchColumns = array('ven_name','ven_email');

        $totalRecordwithFilter = $this->common_model->GetTotalRecordwithFilter('pro_vendor','ven_id',$searchValue,$searchColumns);
    
        ##Joins if any //Pass Joins as Multi dim array
        $joins = array();
        ## Fetch records
        $records = $this->common_model->GetRecord('pro_vendor','ven_id',$searchValue,$searchColumns,$columnName,$columnSortOrder,$joins,$rowperpage,$start);
        
        $data = array();

        $i=1;
        foreach($records as $record ){
            $action = '<a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->ven_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a><a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->ven_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> Delete</a>';
           
           $data[] = array( 
              "ven_id"        =>$i,
              'ven_name'      =>$record->ven_name,
              'ven_post_box'  =>$record->ven_post_box,
              'ven_telephone' =>$record->ven_telephone,
              "action"        =>$action,
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
       
        $data['content'] = view('procurement/vendor');

        return view('procurement/pro-module',$data);

    }


    // add account head
    Public function Add()
    {   
        
        $insert_data = $this->request->getPost();

        $insert_data['ven_added_by'] = 0; 

        $insert_data['ven_added_date'] = date('Y-m-d'); 

        $id = $this->common_model->InsertData('pro_vendor',$insert_data);

        $data['vendor_id'] = $id;

        /*$coa_data['ca_name'] = $this->request->getPost('cc_customer_name');

        $coa_data['ca_account_type'] = $this->request->getPost('cc_account_head');

        $coa_data['ca_customer'] = $id;

        $this->common_model->InsertData('accounts_charts_of_accounts',$coa_data);*/

        echo json_encode($data);
 

    }

    public function AddTab2()
    {
       
        if($_POST)
        {
	        if(!empty($_POST['pro_con_person']))
			{
			    $count =  count($_POST['pro_con_person']);
					
				if($count!=0)
			    {  
					for($j=0;$j<=$count-1;$j++)
					{
							
					    $insert_data  	= array(  
							
                            'pro_con_person'       =>  $_POST['pro_con_person'][$j],
							'pro_con_designation'  =>  $_POST['pro_con_designation'][$j],
							'pro_con_mobile'       =>  $_POST['pro_con_mobile'][$j],
						    'pro_con_email'        =>  $_POST['pro_con_email'][$j],
                            'pro_con_vendor'       =>  $_POST['pro_con_vendor'],
	  
					    );

				        $id = $this->common_model->InsertData('pro_contact',$insert_data);
				
				    } 
				}
			}
			
			
        }
      
    }


    public function AddTab3()
    {
        $cond = array('ven_id' => $this->request->getPost('ven_id'));

        $update_data = $this->request->getPost();

        /*if (array_key_exists('customer_creation', $update_data)) {
            unset($update_data['customer_creation']);
        }*/

        // Remove unnecessary unset statements for date fields
       
        $update_data['ven_cr_expiry']  = date('Y-m-d', strtotime($this->request->getPost("ven_cr_expiry")));

        $update_data['ven_est_expiry'] = date('Y-m-d', strtotime($this->request->getPost("ven_est_expiry")));

        $update_data['ven_qid_expiry'] = date('Y-m-d', strtotime($this->request->getPost("ven_qid_expiry")));

        // Handle file upload
        if ($_FILES['ven_cr_attach']['name'] !== '') {
            $ccAttachCrFileName = $this->uploadFile('ven_cr_attach','uploads/Vendor');
            $update_data['ven_cr_attach'] = $ccAttachCrFileName;
        }

        if ($_FILES['ven_est_attach']['name'] !== '') {
            $ccAttachCrFileName = $this->uploadFile('ven_est_attach','uploads/Vendor');
            $update_data['ven_est_attach'] = $ccAttachCrFileName;
        }

        if ($_FILES['ven_qid_attach']['name'] !== '') {
            $ccAttachCrFileName = $this->uploadFile('ven_qid_attach','uploads/Vendor');
            $update_data['ven_qid_attach'] = $ccAttachCrFileName;
        }


        $this->common_model->EditData($update_data, $cond, 'steel_pro_vendor');
    }



    // Function to handle file upload
    public function uploadFile($fieldName, $uploadPath)
    {
        $file = $this->request->getFile($fieldName);

        if ($file->isValid() && !$file->hasMoved()) 
        {
            $newName = $file->getRandomName();
            $file->move($uploadPath, $newName);
            return $newName;
        }

        return null;
    }


   

    


    //search droup drown (accountid)
    public function FetchTypes()
    {

        $page= !empty($_GET['page']) ? $_GET['page'] : 0;
        $term = !empty($_GET['term']) ? $_GET['term'] : "";
        $resultCount = 10;
        $end = ($page - 1) * $resultCount;       
        $start = $end + $resultCount;
      
        $data['result'] = $this->common_model->FetchAllLimit('accounts_account_heads','ah_head_id','asc',$term,$start,$end);

        $data['total_count'] = count($data['result']);

        return json_encode($data);

    }

    public function Code()
    {
        
        $cond2 = array('cc_account_head' => $this->request->getPost('ID'));

        $id = $this->request->getPost('ID');

        $data['account_id'] = $this->common_model->FetchNextHeadId($id);

        echo json_encode($data);

    }



}
