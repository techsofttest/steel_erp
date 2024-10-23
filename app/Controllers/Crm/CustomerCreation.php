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
      
        $data['result'] = $this->common_model->FetchAllLimit('accounts_account_heads','ah_account_name','asc',$term,$end,$start);

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

        $coa_data['ca_name'] = $this->request->getPost('cc_customer_name');

        $coa_data['ca_account_type'] = $this->request->getPost('cc_account_head');

        $coa_data['ca_customer'] = $id;

        $coa_data['ca_account_id'] = $this->request->getPost('cc_account_id');

        $coa_data['ca_type'] = "CUSTOMER";

        $this->common_model->InsertData('accounts_charts_of_accounts',$coa_data);

        echo json_encode($data);

    }


    public function AddTab2()
    {
        

        if($_POST)
        {
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
        $cond = array('cc_id' => $this->request->getPost('cc_id'));
        $update_data = $this->request->getPost();

        if (array_key_exists('customer_creation', $update_data)) {
            unset($update_data['customer_creation']);
        }

        if(!empty($this->request->getPost("cc_cr_expiry")))
        {
            $update_data['cc_cr_expiry'] = date('Y-m-d', strtotime($this->request->getPost("cc_cr_expiry")));
        }
        else
        {
            $update_data['cc_cr_expiry'] =""; 
        }


        if(!empty($this->request->getPost("cc_est_id_expery")))
        {
            $update_data['cc_est_id_expery'] = date('Y-m-d', strtotime($this->request->getPost("cc_est_id_expery")));
        }
        else
        {
            $update_data['cc_est_id_expery'] ="";
        }

        if(!empty($this->request->getPost("cc_qid_expiry"))){
        
            $update_data['cc_qid_expiry'] = date('Y-m-d', strtotime($this->request->getPost("cc_qid_expiry")));
        }
        else
        {
            $update_data['cc_qid_expiry'] = "";
        }


        // Handle file upload
        if ($_FILES['cc_attach_cr']['name'] !== '') {
            $ccAttachCrFileName = $this->uploadFile('cc_attach_cr','uploads/CustomerCreation');
            $update_data['cc_attach_cr'] = $ccAttachCrFileName;
        }

        if ($_FILES['cc_est_id_attach']['name'] !== '') {
            $ccAttachCrFileName = $this->uploadFile('cc_est_id_attach','uploads/CustomerCreation');
            $update_data['cc_est_id_attach'] = $ccAttachCrFileName;
        }

        if ($_FILES['cc_qid_attach']['name'] !== '') {
            $ccAttachCrFileName = $this->uploadFile('cc_qid_attach','uploads/CustomerCreation');
            $update_data['cc_qid_attach'] = $ccAttachCrFileName;
        }


        $this->common_model->EditData($update_data, $cond, 'crm_customer_creation');
    }



    

    // Function to handle file upload
    public function uploadFile($fieldName, $uploadPath)
    {
        $file = $this->request->getFile($fieldName);

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move($uploadPath, $newName);
            return $newName;
        }

        return null;
    }


    


    //update tab1
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

        $data['customer_creation_id'] = $this->request->getPost('cc_id');
       

       echo json_encode($data);
    }



    //update tab3

    public function UpdateTab3()
    {
        $cond = array('cc_id' => $this->request->getPost('cc_id'));

        $customer_creation = $this->common_model->SingleRow('crm_customer_creation',$cond);
         
        
        $update_data = $this->request->getPost();

       
      
        if (array_key_exists('cc_id', $update_data)) {
            unset($update_data['cc_id']);
        }

        
        $update_data['cc_cr_expiry'] = date('Y-m-d', strtotime($this->request->getPost("cc_cr_expiry")));
        $update_data['cc_est_id_expery'] = date('Y-m-d', strtotime($this->request->getPost("cc_est_id_expery")));
        $update_data['cc_qid_expiry'] = date('Y-m-d', strtotime($this->request->getPost("cc_qid_expiry")));

        // Handle file upload
        if (isset($_FILES['cc_attach_cr']) && $_FILES['cc_attach_cr']['name'] !== '') {
            
               
            if($this->request->getFile('cc_attach_cr') != '' ){ 
               
                $previousImagePath = 'uploads/CustomerCreation/' .$customer_creation->cc_attach_cr;
               
                if (file_exists($previousImagePath)) {
                    unlink($previousImagePath);
                }
            }
            
            // Upload the new image
            $ccAttachCrFileName = $this->uploadFile('cc_attach_cr', 'uploads/CustomerCreation');
        
            // Update the data with the new image filename
            $update_data['cc_attach_cr'] = $ccAttachCrFileName;
        }



        
        // Handle file upload for 'cc_est_attach_card'
        if (isset($_FILES['cc_est_id_attach']) && $_FILES['cc_est_id_attach']['name'] !== '') {
            
               
            if($this->request->getFile('cc_est_id_attach') != '' ){ 
               
                $estPreviousImagePath = 'uploads/CustomerCreation/' .$customer_creation->cc_est_id_attach;
               
                if (file_exists($estPreviousImagePath)) {
                    unlink($estPreviousImagePath);
                }
            }
            
            // Upload the new image
            $ccEstIdAttachFileName = $this->uploadFile('cc_est_id_attach', 'uploads/CustomerCreation');
        
            // Update the data with the new image filename
            $update_data['cc_est_id_attach'] = $ccEstIdAttachFileName;
        }


        
        // Handle file upload for 'cc_id_card'
        if (isset($_FILES['cc_qid_attach']) && $_FILES['cc_qid_attach']['name'] !== '') {
            
               
            if($this->request->getFile('cc_qid_attach') != '' ){ 
               
                $qidPreviousImagePath = 'uploads/CustomerCreation/' .$customer_creation->cc_qid_attach;
               
                if (file_exists($qidPreviousImagePath)) {
                    unlink($qidPreviousImagePath);
                }
            }
            
            // Upload the new image
            $ccQidAttachFileName = $this->uploadFile('cc_qid_attach', 'uploads/CustomerCreation');
        
            // Update the data with the new image filename
            $update_data['cc_qid_attach'] = $ccQidAttachFileName;
        }




        $this->common_model->EditData($update_data, $cond, 'crm_customer_creation');
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
            'table' => 'accounts_account_heads',
            'pk'    => 'ah_id',
            'fk'    => 'cc_account_head',
            ),

        );

        $cus_creation = $this->common_model->SingleRowJoin('crm_customer_creation',$cond,$joins);

        $contact_details = $this->common_model->FetchWhere('crm_contact_details',$cond1);

        $charts_accounts = $this->common_model->FetchAllOrder('accounts_charts_of_accounts','ca_id','desc');

        $account_types = $this->common_model->FetchAllOrder('accounts_account_types','at_id','desc');
        
        $data['customer_name']      = $cus_creation->cc_customer_name;

        $data['account_name']       = $cus_creation->ah_account_name;

        $data['account_id']         = $cus_creation->cc_account_id;

        $data['post_box']           = $cus_creation->cc_post_box;

        $data['cc_fax']             = $cus_creation->cc_fax;

        $data['phone']              = $cus_creation->cc_telephone;

        $data['fax']                = $cus_creation->cc_fax;

        $data['email']              = $cus_creation->cc_email;

        $data['credit_term']        = $cus_creation->cc_credit_term;

        $data['credit_period']      = $cus_creation->cc_credit_period;

        $data['credit_limit']       = $cus_creation->cc_credit_limit;
       
        $data['signatory_name']     = $cus_creation->cc_signatory_name;

        

        if($cus_creation->cc_qid_expiry == "0000-00-00")
        {
            $cus_creation->cc_qid_expiry ="";
        }
        else
        {
            $data['qid_expiry'] = date('d-M-Y',strtotime($cus_creation->cc_qid_expiry));
        }
        if(!empty($cus_creation->cc_qid_number))
        {
            $data['qid_number']  = $cus_creation->cc_qid_number;
        }
        else
        {
            $data['qid_number'] ="";
        }
        if($cus_creation->cc_est_id_expery == "0000-00-00")
        {
            $data['est_id_expery'] ="";
        }
        else
        {
            $data['est_id_expery']  = date('d-M-Y',strtotime($cus_creation->cc_est_id_expery));
        }
        if(!empty($cus_creation->cc_est_id))
        {
            $data['est_id'] = $cus_creation->cc_est_id;
        }
        else
        {
            $data['est_id'] ="";
        }
        if($cus_creation->cc_cr_expiry == "0000-00-00")
        {
            $data['cr_expiry'] ="";
        }
        else
        {
            $data['cr_expiry']  = date('d-M-Y',strtotime($cus_creation->cc_cr_expiry));
        }

        if(!empty($cus_creation->cc_cr_number))
        {
            $data['cr_num'] = $cus_creation->cc_cr_number;
        }
        else
        {
            $data['cr_num']  ="";
        }
        
        if(!empty($cus_creation->cc_attach_cr))
        {
            $data['cc_attach_cr'] = '<a href="' . base_url('uploads/CustomerCreation/' . $cus_creation->cc_attach_cr) . '" target="_blank">View</a>';  
        }
        else
        {
            $data['cc_attach_cr'] = "";
        }
        if(!empty($cus_creation->cc_est_id_attach))
        {
            $data['cc_est_id_attach'] = '<a href="' . base_url('uploads/CustomerCreation/' . $cus_creation->cc_est_id_attach) . '" target="_blank">View</a>';  
        }
        else
        {
            $data['cc_est_id_attach'] = "";
        }
        if($cus_creation->cc_qid_attach)
        {
            $data['cc_qid_attach'] = '<a href="' . base_url('uploads/CustomerCreation/' . $cus_creation->cc_qid_attach) . '" target="_blank">View</a>';  
        }
        else
        {
            $data['cc_qid_attach'] = "";
        }
         
         
        $i=1;
       
        $data['contact'] ='';

        foreach($contact_details as $contact)
        {
            $data['contact'] .='<tr class="prod_row">
            <td class="si_no">'.$i.'</td>
            <td><input type="text"   value="'.$contact->contact_person.'" class="form-control" readonly></td>
            <td><input type="text"   value="'.$contact->contact_designation.'" class="form-control" readonly></td>
            <td><input type="text"   value="'.$contact->contact_mobile.'" class="form-control" readonly></td>
            <td> <input type="email" value="'.$contact->contact_email.'" class="form-control" readonly></td>
            </tr>'; 
            $i++;  
        }
        
       
        
        echo json_encode($data);
    }



    
    public function Edit()
    {
        $cond = array('cc_id' => $this->request->getPost('ID'));

        $customer_creation = $this->common_model->SingleRow('crm_customer_creation',$cond);

        $account_heads = $this->common_model->FetchAllOrder('accounts_account_heads','ah_id','desc');

        $charts_accounts = $this->common_model->FetchAllOrder('accounts_charts_of_accounts','ca_id','desc');

        $account_types = $this->common_model->FetchAllOrder('accounts_account_types','at_id','desc');

        $cond1 = array('contact_customer_creation' => $this->request->getPost('ID'));

        $contact_details = $this->common_model->FetchWhere('crm_contact_details',$cond1);

        $customer_creation_id = $this->request->getPost('ID');

        $data['customer_name']    = $customer_creation->cc_customer_name;

        $data['account_id']       = $customer_creation->cc_account_id;

        $data['post_box']         = $customer_creation->cc_post_box;

        $data['telephone']        = $customer_creation->cc_telephone;

        $data['fax']              = $customer_creation->cc_fax;

        $data['email']            = $customer_creation->cc_email;

        $data['credit_term']      = $customer_creation->cc_credit_term;

        $data['credit_period']    = $customer_creation->cc_credit_period;

        $data['credit_limit']     = $customer_creation->cc_credit_limit;

        $data['cust_id']          = $customer_creation->cc_id;

        $data['signatory_name']   = $customer_creation->cc_signatory_name;
        
        if(!empty($customer_creation->cc_qid_number))
        {
            $data['qid_number'] = $customer_creation->cc_qid_number;
        }
        else
        {
            $data['qid_number'] ="";
        }
        if(!empty($customer_creation->cc_est_id))
        {
            $data['est_id'] = $customer_creation->cc_est_id;
        }
        else
        {
            $data['est_id'] ="";
        }
        if(!empty($customer_creation->cc_cr_number))
        {
            $data['cr_no']  = $customer_creation->cc_cr_number;
        }
        else
        {
            $data['cr_no'] ="";
        }
        if($customer_creation->cc_cr_expiry == "0000-00-00")
        {
            $data['cr_expiry']  = "";
        }
        else
        {
            $data['cr_expiry']  = date('d-M-Y',strtotime($customer_creation->cc_cr_expiry));
        }
        if($customer_creation->cc_est_id_expery == "0000-00-00")
        {
            $data['est_id_expery'] ="";
        }
        else
        {
            $data['est_id_expery'] = date('d-M-Y',strtotime($customer_creation->cc_est_id_expery));
        }
        if($customer_creation->cc_qid_expiry == "0000-00-00")
        {
            $data['qid_expiry'] ="";
        }
        else
        {
            $data['qid_expiry']  = date('d-M-Y',strtotime($customer_creation->cc_qid_expiry));
        }
        /*image section start*/

       
        $data['cc_attach_cr'] = "<a href='" . base_url('uploads/CustomerCreation/' . $customer_creation->cc_attach_cr) . "' target='_blank'>";
        if (!empty($customer_creation->cc_attach_cr)) {
            $data['cc_attach_cr'] .= 'view';
        }
        
        $data['cc_attach_cr'] .= "</a>";
        

       
        $data['cc_est_id_attach'] = "<a href='" . base_url('uploads/CustomerCreation/' . $customer_creation->cc_est_id_attach) . "' target='_blank'>";
        if(!empty($customer_creation->cc_est_id_attach)){

            $data['cc_est_id_attach'] .= 'view';
        }
        $data['cc_est_id_attach'] .="</a>";  
	 

	    
        $data['cc_qid_attach'] = "<a href='" . base_url('uploads/CustomerCreation/' . $customer_creation->cc_qid_attach) . "' target='_blank'>";
        if(!empty($customer_creation->cc_qid_attach)){

            $data['cc_qid_attach'] .='view';
        }
        $data['cc_qid_attach'] .="</a>";  
	 

        /*image section end*/
       


        
        $data['account_head'] ="";

        foreach($account_heads as $account_head)
        {
             
        
            // Check if the current product head is selected
            if ($account_head->ah_id == $customer_creation->cc_account_head)
            {
                $data['account_head'] .= '<option value="' .$account_head->ah_id. '"';
                $data['account_head'] .= ' selected'; 
                $data['account_head'] .= '>' . $account_head->ah_account_name . '</option>';
            }
        
            
        }



        /*contact table start*/

        $i=1;
        $data['contact'] ="";
        foreach($contact_details as $contact)
        {
            $data['contact'] .='<tr class="edit_prod_row" id="'.$contact->contact_id.'">
            <td class="si_no1">'.$i.'</td>
            <td><input type="text" name="contact_person[]"  value="'.$contact->contact_person.'" class="form-control" readonly></td>
            <td><input type="text" name="contact_designation[]"  value="'.$contact->contact_designation.'" class="form-control" readonly></td>
            <td><input type="text" name="contact_mobile[]"  value="'.$contact->contact_mobile.'" class="form-control" readonly></td>
            <td> <input type="email" name="contact_email[]" value="'.$contact->contact_email.'" class="form-control" readonly></td>
            <td class="row_remove delete_contact" data-id="'.$contact->contact_id.'"><i class="ri-close-line"></i>Remove</td>
            <td class="row_contact_edit row_edit" data-id="'.$contact->contact_id.'"><i class="ri-pencil-fill"></i>Edit</td>
           
            </tr>
            <input type="hidden" class="contact_cust" value="'.$contact->contact_customer_creation.'">
            '; 
            $i++;  

        }
       

        echo json_encode($data);
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

        $customer_id = $this->request->getPost('ID');

        $cond = array('cc_id' => $this->request->getPost('ID'));

        $cus_creation = $this->common_model->SingleRow('crm_customer_creation',$cond);

        $cond1 = array('contact_customer_creation' => $this->request->getPost('ID'));

        $cond2 = array('enquiry_customer' => $this->request->getPost('ID'));

        $enquiry = $this->common_model->FetchWhere('crm_enquiry',$cond2);

        $cond3  = array('qd_customer' => $this->request->getPost('ID'));

        $quotation = $this->common_model->FetchWhere('crm_quotation_details',$cond3);

        $cond4 = array('so_customer' => $this->request->getPost('ID'));

        $qsales_order = $this->common_model->FetchWhere('crm_sales_orders',$cond4);


        $coa_cond = array('ca_customer' => $customer_id);

        $charts_of_account = $this->common_model->SingleRow('accounts_charts_of_accounts',$coa_cond);

        if(!empty($charts_of_account))

        {

        $receipt_cond = array('r_debit_account' => $charts_of_account->ca_id);

        $receipts = $this->common_model->FetchWhere('accounts_receipts',$receipt_cond);

        $payment_cond = array('pay_credit_account' => $charts_of_account->ca_id);

        $payments = $this->common_model->FetchWhere('accounts_payments',$payment_cond);


        $petty_cond = array('pcv_credit_account' => $charts_of_account->ca_id);

        $pcv = $this->common_model->FetchWhere('accounts_petty_cash_voucher',$petty_cond);

        }



        if(empty($enquiry) && empty($quotation) && empty($qsales_order) && empty($receipts) && empty($payments) && empty($pcv)){

            @unlink('uploads/CustomerCreation/'.$cus_creation->cc_attach_cr);

            @unlink('uploads/CustomerCreation/'.$cus_creation->cc_est_attach_card);

            @unlink('uploads/CustomerCreation/'.$cus_creation->cc_id_card);
    
            $this->common_model->DeleteData('crm_customer_creation',$cond);
    
            $this->common_model->DeleteData('crm_contact_details',$cond1);

            //Delete Charts Of Accounts


            $this->common_model->DeleteData('accounts_charts_of_accounts',$coa_cond);

            $data['status'] = "true"; 
        
        }
        else
        {
            $data['status'] = "false"; 
        }

        //delete enquiry
        
        //$enquiry = $this->common_model->SingleRow('crm_enquiry',$cond2);

        /*if(!empty($enquiry))
        {
           
            $enquiry_id = $enquiry->enquiry_id;

            $cond3 = array('pd_enquiry_id' =>  $enquiry_id);
            
            $this->common_model->DeleteData('crm_enquiry',$cond2);

            $this->common_model->DeleteData('crm_product_detail',$cond3);

        }*/

        echo json_encode($data);

    }

    //add contact (in edit)

    public function AddContact()
    {
        $insert_data = $this->request->getPost();

        $id = $this->common_model->InsertData('crm_contact_details',$insert_data);

       // echo json_encode($data);
    }


    public function Code()
    {
        
        $cond2 = array('cc_account_head' => $this->request->getPost('ID'));

        $id = $this->request->getPost('ID');

        if(empty($id))
        {
            return false; 

            exit();
        }

        $data['account_id'] = $this->common_model->FetchNextHeadId($id);

        /*

        $customer_creation = $this->common_model->FetchWhere('crm_customer_creation',$cond2);


        $cond3 = array('cc_id' => $this->request->getPost('custID'));


        if(empty($customer_creation))
        {   
           
            $cond = array('ah_id' => $this->request->getPost('ID'));

            $single_account_head = $this->common_model->SingleRow('accounts_account_heads',$cond);

            $data['account_id'] =  ++$single_account_head->ah_head_id;
          
            
        }

        else
        {   
          
            $cust_creat = $this->common_model->FetchWhereLimit($this->request->getPost('ID'),'cc_account_head','cc_account_id','DESC','crm_customer_creation',0,1);
            
            $cust_check_data = $this->common_model->CheckTwiceCond('crm_customer_creation',$cond2,$cond3);

            if(!empty($cust_check_data))
            {
                $data['account_id'] = $cust_check_data->cc_account_id;
            }
            else
            {

                $cust_creat_data = $cust_creat->cc_account_id;

                $data['account_id'] = ++$cust_creat_data;

            }
           
        }

        */

        echo json_encode($data);

    }

    public function FetchSingleContact()
    {
        $cond = array('contact_id' => $this->request->getPost('ID'));
        
        $single_contact = $this->common_model->SingleRow('crm_contact_details',$cond);
         
        $data['single_contact'] = "";
        
        $data['single_contact'] .='<tr>
                                    <td>1</td>
                                    <td><input type=text"  name="contact_person" class="form-control" value="'.$single_contact->contact_person.'" required></td>
                                    <td><input type="text" name="contact_designation" class="form-control" value="'.$single_contact->contact_designation.'" required></td>
                                    <td><input type="text" name="contact_mobile" class="form-control cond_telephone" value="'.$single_contact->contact_mobile.'" required></td>
                                    <td><input type="text" name="contact_email" class="form-control" value="'.$single_contact->contact_email.'" required></td>
	                                <input type="hidden"   name="contact_id" value='.$single_contact->contact_id.'>
                                </tr>';
  
        echo json_encode($data);

    }


    public function UpdateSingleContact()
    {
        $cond = array('contact_id' => $this->request->getPost('contact_id'));
        
        
        $update_data = $this->request->getPost();

       

   
        // Check if the 'account_id' key exists before unsetting it
        if (array_key_exists('contact_id', $update_data)) 
        {
             unset($update_data['contact_id']);
        }    
        
        if (array_key_exists('contact_customer_creation', $update_data)) 
        {
             unset($update_data['contact_customer_creation']);
        }   

       

        $this->common_model->EditData($update_data,$cond,'crm_contact_details');

        $single_contact = $this->common_model->SingleRow('crm_contact_details',$cond);

        $data['customer_creation_id'] = $single_contact->contact_customer_creation; 


        echo json_encode($data);
    }


    public function AddSingleContact()
    {
        $insert_data = $this->request->getPost();

        $this->common_model->InsertData('crm_contact_details',$insert_data);

        $data['cust_id'] = $this->request->getPost('contact_customer_creation');
        
        echo json_encode($data);
        
    }




}
