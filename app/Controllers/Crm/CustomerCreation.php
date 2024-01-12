<?php

namespace App\Controllers\Crm;

use App\Controllers\BaseController;


class CustomerCreation extends BaseController
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
       
        $totalRecords = $this->common_model->GetTotalRecords('crm_customer_creation','cc_id','DESC');
 
        ## Total number of records with filtering
       
        $searchColumns = array('cc_customer_name','cc_account_id');

        $totalRecordwithFilter = $this->common_model->GetTotalRecordwithFilter('crm_customer_creation','cc_id',$searchValue,$searchColumns);
    
        ##Joins if any //Pass Joins as Multi dim array
        $joins = array(
            
        );
        ## Fetch records
        $records = $this->common_model->GetRecord('crm_customer_creation','cc_id',$searchValue,$searchColumns,$columnName,$columnSortOrder,$joins,$rowperpage,$start);
    
        $data = array();

        $i=1;
        foreach($records as $record ){
            $action = '<a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->cc_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a><a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->cc_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> Delete</a><a  href="javascript:void(0)" data-id="'.$record->cc_id.'"  class="view view-color view_btn" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a>';
           
           $data[] = array( 
              "cc_id"=>$i,
              'cc_customer_name' => $record->cc_customer_name,
              'cc_post_box'      => $record->cc_post_box,
              'cc_telephone'     => $record->cc_telephone,
              "action"           => $action,
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

    //search droup drown (accountid)
    public function FetchTypes()
    {

        $page= !empty($_GET['page']) ? $_GET['page'] : 0;
        $term = !empty($_GET['term']) ? $_GET['term'] : "";
        $resultCount = 10;
        $end = ($page - 1) * $resultCount;       
        $start = $end + $resultCount;
      
        $data['result'] = $this->common_model->FetchAllLimit('accounts_charts_of_accounts','ca_name','asc',$term,$start,$end);

        $data['total_count'] =count($data['result']);

        return json_encode($data);

    }



    //search droup drown (GL account Type)
    public function FetchTypes1()
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
        $data['charts_accounts'] = $this->common_model->FetchAllOrder('accounts_charts_of_accounts','ca_id','desc');
        
        $data['accounts_type'] = $this->common_model->FetchAllOrder('accounts_account_types','at_id','desc');

        $data['content'] = view('crm/customer-creation',$data);

        return view('crm/crm-module',$data);

    }


    // add account head
    Public function Add()
    {   
        
        $insert_data = $this->request->getPost();

        $insert_data['cc_added_by'] = 0; 

        $insert_data['cc_added_date'] = date('Y-m-d'); 

        $id = $this->common_model->InsertData('crm_customer_creation',$insert_data);

        $data['customer_creation_id'] = $id;

        echo json_encode($data);

    }

    public function AddTab2()
    {
        $insert_data = $this->request->getPost();
        if($_POST){
	        if(!empty($_POST['contact_person']))
			{
			    $count =  count($_POST['contact_person']);
					
				if($count!=0)
			    {  
					for($j=0;$j<=$count-1;$j++)
					{
							
					    $insert_data  	= array(  
							'contact_person'            =>  $_POST['contact_person'][$j],
							'contact_designation'       =>  $_POST['contact_designation'][$j],
							'contact_mobile'            =>  $_POST['contact_mobile'][$j],
						    'contact_email'             =>  $_POST['contact_email'][$j],
                            'contact_customer_creation' =>  $_POST['contact_customer_creation'],
	  
					    );
					
							
				        $id = $this->common_model->InsertData('crm_contact_details',$insert_data);
				
				    } 
				}
			}
			
			
        }
        

       
    }



    public function AddTab3()
    {
    $cond = array('cc_id' => $this->request->getPost('customer_creation'));
    $update_data = $this->request->getPost();

    if (array_key_exists('customer_creation', $update_data)) {
        unset($update_data['customer_creation']);
    }

    // Remove unnecessary unset statements for date fields

    $update_data['cc_expiry_date'] = date('Y-m-d', strtotime($this->request->getPost("cc_expiry_date")));
    $update_data['cc_est_expiry_date'] = date('Y-m-d', strtotime($this->request->getPost("cc_est_expiry_date")));
    $update_data['cc_id_card_expiry_date'] = date('Y-m-d', strtotime($this->request->getPost("cc_id_card_expiry_date")));

    // Handle file upload
    if ($_FILES['cc_attach_cr']['name'] !== '') {
        $ccAttachCrFileName = $this->uploadFile('cc_attach_cr','uploads/CustomerCreation');
        $update_data['cc_attach_cr'] = $ccAttachCrFileName;
    }

    if ($_FILES['cc_est_attach_card']['name'] !== '') {
        $ccAttachCrFileName = $this->uploadFile('cc_est_attach_card','uploads/CustomerCreation');
        $update_data['cc_est_attach_card'] = $ccAttachCrFileName;
    }

    if ($_FILES['cc_id_card']['name'] !== '') {
        $ccAttachCrFileName = $this->uploadFile('cc_id_card','uploads/CustomerCreation');
        $update_data['cc_id_card'] = $ccAttachCrFileName;
    }


    $this->common_model->EditData($update_data, $cond, 'crm_customer_creation');
}

// Function to handle file upload
private function uploadFile($fieldName, $uploadPath)
{
    $file = $this->request->getFile($fieldName);

    if ($file->isValid() && !$file->hasMoved()) {
        $newName = $file->getRandomName();
        $file->move($uploadPath, $newName);
        return $newName;
    }

    return null;
}



    //account head modal 
    public function View()
    {
        
        $cond = array('cc_id' => $this->request->getPost('ID'));

        $cond1 = array('contact_customer_creation' => $this->request->getPost('ID'));

        $joins = array(
           
            array(
            'table' => 'accounts_charts_of_accounts',
            'pk'    => 'ca_id',
            'fk'    => 'cc_account_id',
            ),
            array(
            'table' => 'accounts_account_types',
            'pk'    => 'at_id',
            'fk'    => 'cc_account_type',
            ),

        );

        $cus_creation = $this->common_model->SingleRowJoin('crm_customer_creation',$cond,$joins);

        

        $contact_details = $this->common_model->FetchWhere('crm_contact_details',$cond1);

        $charts_accounts = $this->common_model->FetchAllOrder('accounts_charts_of_accounts','ca_id','desc');

        $account_types = $this->common_model->FetchAllOrder('accounts_account_types','at_id','desc');
        
        $data['cc_customer_name'] = $cus_creation->cc_customer_name;

        $data['cc_post_box']      = $cus_creation->cc_post_box;

        $data['cc_telephone']     = $cus_creation->cc_telephone;

        $data['cc_fax'] = $cus_creation->cc_fax;

        $data['cc_email'] = $cus_creation->cc_email;

        $data['cc_credit_term'] = $cus_creation->cc_credit_term;

        $data['cc_credit_period'] = $cus_creation->cc_credit_period;

        $data['cc_credit_limit'] = $cus_creation->cc_credit_limit;

        $data['cc_cr_number'] = $cus_creation->cc_cr_number;

        $data['cc_expiry_date'] = $cus_creation->cc_expiry_date;

        $data['cc_est_card_no'] = $cus_creation->cc_est_card_no;

        $data['cc_est_expiry_date'] = $cus_creation->cc_est_expiry_date;

        $data['cc_est_signatory_name'] = $cus_creation->cc_est_signatory_name	;

        $data['cc_card_number'] = $cus_creation->cc_card_number;

        $data['cc_id_card_expiry_date'] = $cus_creation->cc_id_card_expiry_date;

        $data['ca_account_id'] = $cus_creation->ca_account_id;

        $data['cc_account_type'] = $cus_creation->at_name;


        $data['acc_type'] ="";

        foreach($account_types as $account)
        {
            $data['acc_type'] .='<option value='.$account->at_id.'';
            if($account->at_id  == $cus_creation->cc_account_type){
            $data['acc_type'] .=    " selected ";}
            $data['acc_type'] .='>' .$account->at_name. '</option>'; 
        }
       
       
         
        $i=1;
        $data['contact'] ='<table  class="table table-bordered table-striped delTable"><tbody class="travelerinfo"><tr><td >No</td><td>Contact Person </td><td>Designation</td><td>Mobile</td><td>Email</td></tr>';

        foreach($contact_details as $contact)
        {
            $data['contact'] .='<tr>
            <td>'.$i.'</td>
            <td><input type="text"   value='.$contact->contact_person.' class="form-control " readonly></td>
            <td><input type="text"   value='.$contact->contact_designation.' class="form-control " readonly></td>
            <td><input type="text"   value='.$contact->contact_mobile.' class="form-control " readonly></td>
            <td> <input type="email" value='.$contact->contact_email.' class="form-control " readonly></td>
            </tr>'; 
            $i++;  
        }
        
        $data['contact'] .= '</tbody></table>';

        $data['attach_cr'] = '<a href="' . base_url('uploads/CustomerCreation/' . $cus_creation->cc_attach_cr) . '" target="_blank">View</a>';  

        $data['attach_est_card'] = '<a href="' . base_url('uploads/CustomerCreation/' . $cus_creation->cc_est_attach_card) . '" target="_blank">View</a>';  
        
        $data['attach_id_card'] = '<a href="' . base_url('uploads/CustomerCreation/' . $cus_creation->cc_id_card) . '" target="_blank">View</a>';  

        
        echo json_encode($data);
    }



    
    public function Edit()
    {
        $cond = array('cc_id' => $this->request->getPost('ID'));

        $customer_creation = $this->common_model->SingleRow('crm_customer_creation',$cond);

        $charts_accounts = $this->common_model->FetchAllOrder('accounts_charts_of_accounts','ca_id','desc');

        $account_types = $this->common_model->FetchAllOrder('accounts_account_types','at_id','desc');

        $cond1 = array('contact_customer_creation' => $this->request->getPost('ID'));

        $contact_details = $this->common_model->FetchWhere('crm_contact_details',$cond1);

        $data['cc_customer_name']        = $customer_creation->cc_customer_name;

        $data['cc_post_box']             = $customer_creation->cc_post_box;

        $data['cc_telephone']            = $customer_creation->cc_telephone;

        $data['cc_fax']                  = $customer_creation->cc_fax;

        $data['cc_email']                = $customer_creation->cc_email;

        $data['cc_credit_term']          = $customer_creation->cc_credit_term;

        $data['cc_credit_period']        = $customer_creation->cc_credit_period;

        $data['cc_credit_limit']         = $customer_creation->cc_credit_limit;

        $data['cc_cr_number']            = $customer_creation->cc_cr_number;

        $data['cc_expiry_date']          = $customer_creation->cc_expiry_date;

        $data['cc_est_card_no']          = $customer_creation->cc_est_card_no;

        $data['cc_est_expiry_date']      = $customer_creation->cc_est_expiry_date;

        $data['cc_est_signatory_name']   = $customer_creation->cc_est_signatory_name;

        $data['cc_card_number']          = $customer_creation->cc_card_number;

        $data['cc_id_card_expiry_date']  = $customer_creation->cc_id_card_expiry_date;

        $data['cc_id']  = $customer_creation->cc_id;

        $data['account_type_out'] ="";

        foreach($account_types as $account_type)
        {
            $data['account_type_out'] .= '<option value="' .$account_type->at_id. '"'; 
        
            // Check if the current product head is selected
            if ($account_type->at_id == $customer_creation->cc_account_type)
            {
                $data['account_type_out'] .= ' selected'; 
            }
        
            $data['account_type_out'] .= '>' . $account_type->at_name . '</option>';
        }


        $data['chart_account_type'] ="";

        foreach($charts_accounts as $chart_account)
        {
            $data['chart_account_type'] .= '<option value="' .$chart_account->ca_id. '"'; 
        
            // Check if the current product head is selected
            if ($chart_account->ca_id == $customer_creation->cc_account_id)
            {
                $data['chart_account_type'] .= ' selected'; 
            }
        
            $data['chart_account_type'] .= '>' . $chart_account->ca_account_id . '</option>';
        }

        $i=1;
        $data['contact'] ='<table  class="table table-bordered table-striped delTable"><tbody class="travelerinfo"><tr><td >No</td><td>Contact Person </td><td>Designation</td><td>Mobile</td><td>Email</td><td>Action</td></tr>';

        foreach($contact_details as $contact)
        {
            $data['contact'] .='<tr id="'.$contact->contact_id.'">
            <td>'.$i.'</td>
            <td><input type="text"   value='.$contact->contact_person.' class="form-control " readonly></td>
            <td><input type="text"   value='.$contact->contact_designation.' class="form-control " readonly></td>
            <td><input type="text"   value='.$contact->contact_mobile.' class="form-control " readonly></td>
            <td> <input type="email" value='.$contact->contact_email.' class="form-control " readonly></td>
            <td class="row_remove" data-id="'.$contact->contact_id.'"><i class="ri-close-line"></i>Remove</td>
            </tr>'; 
            $i++;  
        }
        
        $data['contact'] .= '</tbody> <tbody class="person-more" class="travelerinfo"></tbody></table><div class="edit_add_more_div"><span class="edit_add_more add_person"><i class="ri-add-circle-line"></i>Add More</span></div>';
        
        echo json_encode($data);
    }


    public function UpdateTab1()
    {
        $cond = array('cc_id' => $this->request->getPost('cc_id'));
        
        $update_data = $this->request->getPost(); 

        // Check if the 'account_id' key exists before unsetting it
        if (array_key_exists('cc_id', $update_data)) 
        {
             unset($update_data['cc_id']);
        }       

        $update_data['cc_modified_date'] = date('Y-m-d'); 

        $this->common_model->EditData($update_data,$cond,'crm_customer_creation');
    }


    // update account head 
    public function Update()
    {    
        $cond = array('at_id' => $this->request->getPost('account_id'));
        
        $update_data = $this->request->getPost(); 

        // Check if the 'account_id' key exists before unsetting it
        if (array_key_exists('account_id', $update_data)) 
        {
             unset($update_data['account_id']);
        }       

        $update_data['at_added_by'] = 0; 

        $update_data['at_modify_date'] = date('Y-m-d'); 



        $this->common_model->EditData($update_data,$cond,'accounts_account_types');
       
    }
    
    //delete contact details
    public function DeleteContact()
    {
        $cond = array('contact_id' => $this->request->getPost('ID'));
 
        $this->common_model->DeleteData('crm_contact_details',$cond);

        
    }

    //delete account head
    public function Delete()
    {
        $cond = array('cc_id' => $this->request->getPost('ID'));
 
        $this->common_model->DeleteData('crm_customer_creation',$cond);
 
        $cond1 = array('contact_customer_creation' => $this->request->getPost('ID'));

        $this->common_model->DeleteData('crm_contact_details',$cond1);
    }





}
