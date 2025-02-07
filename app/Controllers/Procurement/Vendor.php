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
       
        $totalRecords = $this->common_model->GetTotalRecords('crm_customer_creation','cc_id','DESC');
 
        ## Total number of records with filtering
       
        $searchColumns = array('cc_customer_name','cc_email');

        $totalRecordwithFilter = $this->common_model->GetTotalRecordwithFilter('crm_customer_creation','cc_id',$searchValue,$searchColumns);
    
        ##Joins if any //Pass Joins as Multi dim array
        $joins = array();
        ## Fetch records
        $records = $this->common_model->GetRecord('crm_customer_creation','cc_id',$searchValue,$searchColumns,$columnName,$columnSortOrder,$joins,$rowperpage,$start,array('cc_status' => 1));
        
        $data = array();

        $i=1;
        foreach($records as $record ){
            $action = '
            <a href="javascript:void(0)" data-id="'.$record->cc_id.'" class="view view-color view_btn" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-fill"></i></a>
            <a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="Edit"  data-id="'.$record->cc_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i></a>
            <a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->cc_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i></a>
            ';
            
            $data[] = array( 
              "cc_id"              =>$i,
              'cc_customer_name'   =>$record->cc_customer_name,
              'cc_post_box'        =>$record->cc_post_box,
              'cc_telephone'       =>$record->cc_telephone,
              "action"             =>$action,
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

        $insert_data  	= array(  
							
            'cc_customer_name'     =>  $_POST['ven_name'],
            'cc_account_head'      =>  $_POST['ven_account_head'],
            'cc_account_id'        =>  $_POST['ven_account_id'],
            'cc_post_box'          =>  $_POST['ven_post_box'],
            'cc_telephone'         =>  $_POST['ven_telephone'],
            'cc_fax'               =>  $_POST['ven_fax'],
            'cc_email'             =>  $_POST['ven_email'],
            'cc_credit_term'       =>  $_POST['ven_credit_term'],
            'cc_credit_period'     =>  $_POST['ven_credit_period'],
            'cc_credit_limit'      =>  $_POST['ven_credit_limit'],
            'cc_status'            =>  1,
            

        );

        $id = $this->common_model->InsertData('crm_customer_creation',$insert_data);


       // $id = $this->common_model->InsertData('pro_vendor',$insert_data);

        $data['vendor_id'] = $id;

        $coa_data['ca_name'] = $this->request->getPost('ven_name');

        $coa_data['ca_account_type'] = $this->request->getPost('ven_account_head');

        $coa_data['ca_customer'] = $id;

        $coa_data['ca_account_id'] = $this->request->getPost('ven_account_id');

        $coa_data['ca_type'] = "VENDOR";

        $this->common_model->InsertData('accounts_charts_of_accounts',$coa_data);

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
							
                            'contact_person'              =>  $_POST['pro_con_person'][$j],
							'contact_designation'         =>  $_POST['pro_con_designation'][$j],
							'contact_mobile'              =>  $_POST['pro_con_mobile'][$j],
						    'contact_email'               =>  $_POST['pro_con_email'][$j],
                            'contact_customer_creation'   =>  $_POST['pro_con_vendor'],
	  
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

        if(!empty($this->request->getPost("cc_cr_expiry")))
        {
            $update_data['cc_cr_expiry']  = date('Y-m-d', strtotime($this->request->getPost("cc_cr_expiry")));
        }
        else
        {
            $update_data['cc_cr_expiry']  = "";
        }


        if(!empty($this->request->getPost("cc_est_id_expery")))
        {
            $update_data['cc_est_id_expery'] = date('Y-m-d', strtotime($this->request->getPost("cc_est_id_expery")));
        }
        else
        {
            $update_data['cc_est_id_expery']  = "";
        }


        if(!empty($this->request->getPost("cc_qid_expiry")))
        {
            $update_data['cc_qid_expiry'] = date('Y-m-d', strtotime($this->request->getPost("cc_qid_expiry")));
        }
        else
        {
            $update_data['cc_qid_expiry'] = "";
        }
        
  
        
        // Handle file upload
        if ($_FILES['cc_attach_cr']['name'] !== '') {
            $ccAttachCrFileName = $this->uploadFile('cc_attach_cr','uploads/Vendor');
            $update_data['cc_attach_cr'] = $ccAttachCrFileName;
        }

        if ($_FILES['cc_est_id_attach']['name'] !== '') {
            $ccAttachCrFileName = $this->uploadFile('cc_est_id_attach','uploads/Vendor');
            $update_data['cc_est_id_attach'] = $ccAttachCrFileName;
        }

        if ($_FILES['cc_qid_attach']['name'] !== '') {
            $ccAttachCrFileName = $this->uploadFile('cc_qid_attach','uploads/Vendor');
            $update_data['cc_qid_attach'] = $ccAttachCrFileName;
        }


        $this->common_model->EditData($update_data, $cond, 'crm_customer_creation');
    }





    //search droup drown (accountid)
    public function FetchTypes()
    {

        $page= !empty($_GET['page']) ? $_GET['page'] : 0;
        $term = !empty($_GET['term']) ? $_GET['term'] : "";
        $resultCount = 10;
        $end = ($page - 1) * $resultCount;       
        $start = $end + $resultCount;
      
        $data['result'] = $this->common_model->FetchAllLimit('accounts_account_heads','ah_account_name','asc',$term,$start,$end);

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
        
        
        $join =  array(
                    
            array(
                'table' => 'accounts_account_heads',
                'pk'    => 'ah_id',
                'fk'    => 'cc_account_head',
            ),


        );

        $vendor = $this->common_model->SingleRowJoin('crm_customer_creation', array('cc_id' => $this->request->getPost('ID')),$join);

        $data['vendor_name']   = $vendor->cc_customer_name;

        $data['account_name']  = $vendor->ah_account_name;

        $data['account_id']    = $vendor->cc_account_id;

        $data['post_box']      = $vendor->cc_post_box;

        $data['telephone']     = $vendor->cc_telephone;

        $data['fax']           = $vendor->cc_fax;

        $data['email']         = $vendor->cc_email;

        $data['credit_term']   = $vendor->cc_credit_term;

        $data['credit_period'] = $vendor->cc_credit_period;

        $data['credit_limit']  = $vendor->cc_credit_limit;

        $data['vendor_id']     = $vendor->cc_id;

        //office document 

        $data['cr_no']  = $vendor->cc_cr_number;

        if($vendor->cc_cr_expiry == "0000-00-00")
        {
            $data['cr_expiry'] =""; 
        }
        else
        {
            $data['cr_expiry']  = date('d-M-Y',strtotime($vendor->cc_cr_expiry));
        }
        

        $data['est_id']  = $vendor->cc_est_id;

        if($vendor->cc_est_id_expery == "0000-00-00")
        {
            $data['est_id_expiry'] = "";
        }
        else
        {
            $data['est_id_expiry']  = date('d-M-Y',strtotime($vendor->cc_est_id_expery));
        }
        

        $data['signature_name']  = $vendor->cc_signatory_name;

        $data['qid_no']  = $vendor->cc_qid_number;

        if($vendor->cc_qid_expiry == "0000-00-00")
        {
            $data['qid_expiry'] = "";
        }
        else
        {
            $data['qid_expiry']  = date('d-M-Y',strtotime($vendor->cc_qid_expiry));
        }
        


        //image section start

        if(!empty($vendor->cc_attach_cr))
        {
            $data['ven_cr_attach'] = '<a href="' . base_url('uploads/Vendor/' . $vendor->cc_attach_cr) . '" target="_blank">View</a>';  
        }
        else
        {
            $data['ven_cr_attach'] = "";
        }

        if(!empty($vendor->cc_est_id_attach))
        {
            $data['ven_est_attach'] = '<a href="' . base_url('uploads/Vendor/' . $vendor->cc_est_id_attach) . '" target="_blank">View</a>';  
        }
        else
        {
            $data['ven_est_attach'] = "";
        }



        if(!empty($vendor->cc_qid_attach))
        {
            $data['ven_qid_attach'] = '<a href="' . base_url('uploads/Vendor/' . $vendor->cc_qid_attach) . '" target="_blank">View</a>';  
        }
        else
        {
            $data['ven_qid_attach'] = "";
        }

         
        $contact_data = $this->common_model->FetchWhere('crm_contact_details',array('contact_customer_creation' => $this->request->getPost('ID')));
        
       
        $i = 1;

        $data['contact'] = "";
        foreach($contact_data as $contact){

            $data['contact'] .='<tr class="prod_row_edit" id="'.$contact->contact_id .'">
            <td class="si_no_edit text-center"  style="padding:10px 10px;">'.$i.'</td>
            <td><input type="text" name="contact_person[]"  value="'.$contact->contact_person.'" class="form-control text-center" readonly></td>
            <td><input type="text" name="contact_designation[]"  value="'.$contact->contact_designation.'" class="form-control text-center" readonly></td>
            <td><input type="text" name="contact_mobile[]"  value="'.$contact->contact_mobile.'" class="form-control text-center" readonly></td>
            <td> <input type="email" name="contact_email[]" value="'.$contact->contact_email.'" class="form-control text-center" readonly></td>
            <td class="row_remove delete_contact" data-id="'.$contact->contact_id .'"><i class="ri-close-line"></i></td>
            <td class="row_contact_edit row_edit" data-id="'.$contact->contact_id .'"><i class="ri-pencil-fill"></i></td>
           
            </tr>
            <input type="hidden" class="edit_con_ven_id" value="'.$contact->contact_customer_creation.'">
            
            '; 
            $i++;  

            
        }


        echo json_encode($data);


       
    
    }


    public function View()
    {
        $join =  array(
                    
            array(
                'table' => 'accounts_account_heads',
                'pk'    => 'ah_id',
                'fk'    => 'cc_account_head',
            ),


        );

        $vendor = $this->common_model->SingleRowJoin('crm_customer_creation', array('cc_id' => $this->request->getPost('ID')),$join);

        $data['vendor_name']   = $vendor->cc_customer_name;

        $data['account_name']  = $vendor->ah_account_name;

        $data['account_id']    = $vendor->cc_account_id;

        $data['post_box']      = $vendor->cc_post_box;

        $data['telephone']     = $vendor->cc_telephone;

        $data['fax']           = $vendor->cc_fax;

        $data['email']         = $vendor->cc_email;

        $data['credit_term']   = $vendor->cc_credit_term;

        $data['credit_period'] = $vendor->cc_credit_period;

        $data['credit_limit']  = $vendor->cc_credit_limit;

        //office document 

        $data['cr_no']  = $vendor->cc_cr_number;

        $data['est_id']  = $vendor->cc_est_id;

        $data['signature_name']  = $vendor->cc_signatory_name;

        $data['qid_no']  = $vendor->cc_qid_number;

        

         
        $contact_data = $this->common_model->FetchWhere('crm_contact_details',array('contact_customer_creation' => $this->request->getPost('ID')));
        
       
        $i = 1;

        $data['contact'] = "";
        foreach($contact_data as $contact){


            $data['contact'] .='<tr class="edit_prod_row" id="'.$contact->contact_id.'">
            <td class="si_no1 text-center" style="padding:10px 10px;">'.$i.'</td>
            <td><input type="text" name="contact_person[]"  value="'.$contact->contact_person.'" class="form-control text-center" readonly></td>
            <td><input type="text" name="contact_designation[]"  value="'.$contact->contact_designation.'" class="form-control text-center" readonly></td>
            <td><input type="text" name="contact_mobile[]"  value="'.$contact->contact_mobile.'" class="form-control text-center" readonly></td>
            <td> <input type="email" name="contact_email[]" value="'.$contact->	contact_email.'" class="form-control text-center" readonly></td>
           
            </tr>
            <input type="hidden" class="contact_cust" value="">
            '; 
            $i++; 
            
            
            //date section start

            if($vendor->cc_cr_expiry == "0000-00-00")
            {
                $data['cr_expiry'] ="";
            }
            else
            {
                $data['cr_expiry']  = date('d-M-Y',strtotime($vendor->cc_cr_expiry));
            }


            if($vendor->cc_est_id_expery == "0000-00-00")
            {
                $data['est_id_expiry'] ="";
            }
            else
            {
                $data['est_id_expiry']  = date('d-M-Y',strtotime($vendor->cc_est_id_expery));
            }


            if($vendor->cc_qid_expiry == "0000-00-00")
            {
                $data['qid_expiry'] ="";
            }
            else
            {
                $data['qid_expiry']  = date('d-M-Y',strtotime($vendor->cc_qid_expiry));
            }
            



            //image section start

            if(!empty($vendor->cc_attach_cr))
            {
                $data['ven_cr_attach'] = '<a href="' . base_url('uploads/Vendor/' . $vendor->cc_attach_cr) . '" target="_blank">View</a>';  
            }
            else
            {
                $data['ven_cr_attach'] = "";
            }



            if(!empty($vendor->cc_est_id_attach))
            {
                $data['ven_est_attach'] = '<a href="' . base_url('uploads/Vendor/' . $vendor->cc_est_id_attach) . '" target="_blank">View</a>';  
            }
            else
            {
                $data['ven_est_attach'] = "";
            }



            if(!empty($vendor->cc_qid_attach))
            {
                $data['ven_qid_attach'] = '<a href="' . base_url('uploads/Vendor/' . $vendor->cc_qid_attach) . '" target="_blank">View</a>';  
            }
            else
            {
                $data['ven_qid_attach'] = "";
            }




        }

        echo json_encode($data);
    }
    
    public function ContactEdit()
    {
        $contact_edit = $this->common_model->SingleRow('crm_contact_details',array('contact_id' => $this->request->getPost('ID')));
        
        $data['contact'] ='<tr class="edit_prod_row text-center" id="'.$contact_edit->contact_id .'">
            <td><input type="text" name="contact_person"  value="'.$contact_edit->contact_person .'" class="form-control text-center" required></td>
            <td><input type="text" name="contact_designation"  value="'.$contact_edit->contact_designation .'" class="form-control text-center" required></td>
            <td><input type="text" name="contact_mobile"  value="'.$contact_edit->contact_mobile .'" class="form-control edit_contact text-center" required></td>
            <td> <input type="email" name="contact_email" value="'.$contact_edit->contact_email .'" class="form-control text-center" required></td>
            </tr>
            <input type="hidden" class="contact_cust" name="contact_id" value="'.$contact_edit->contact_id.'">
            '; 

        echo json_encode($data);

    }


    public function UpdateContact()
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


    }


    public function DeleteContact()
    {
        $cond = array('contact_id' => $this->request->getPost('ID'));
 
        $this->common_model->DeleteData('crm_contact_details',$cond);

    }


    public function Update()
    {
        $cond = array('cc_id' => $this->request->getPost('cc_id'));
        
        $update_data = $this->request->getPost();

        // Check if the 'account_id' key exists before unsetting it
        if (array_key_exists('cc_id', $update_data)) 
        {
            unset($update_data['cc_id']);
        } 

        if (array_key_exists('cc_account_head', $update_data)) 
        {
            unset($update_data['cc_account_head']);
        } 

        if (array_key_exists('cc_account_id', $update_data)) 
        {
            unset($update_data['cc_account_id']);
        } 
       
	    $this->common_model->EditData($update_data,$cond,'crm_customer_creation');

        $charts_of_account = $this->common_model->SingleRow('accounts_charts_of_accounts',array('ca_customer' => $this->request->getPost('cc_id')),array('ca_type' => 'VENDOR'));
        
        $this->common_model->EditData(array('ca_name' => $this->request->getPost('cc_customer_name')),array('ca_customer' => $this->request->getPost('cc_id'),'ca_type' => 'VENDOR'),'accounts_charts_of_accounts');

        
    }


    public function EditAddContact()
    {
        $insert_data = $this->request->getPost();
        
        $id = $this->common_model->InsertData('crm_contact_details',$insert_data);

    }

    public function EditTab3()
    {
        $cond = array('cc_id' => $this->request->getPost('cc_id'));
        
        $official_doc = $this->common_model->SingleRow('crm_customer_creation',$cond);
        
        $update_data = $this->request->getPost();

        if(!empty($this->request->getPost("cc_cr_expiry")))
        {
            $update_data['cc_cr_expiry']  = date('Y-m-d', strtotime($this->request->getPost("cc_cr_expiry")));
        }
        else
        {
            $update_data['cc_cr_expiry']  = "";
        }


        if(!empty($this->request->getPost("cc_est_id_expery")))
        {
            $update_data['cc_est_id_expery'] = date('Y-m-d', strtotime($this->request->getPost("cc_est_id_expery")));
        }
        else
        {
            $update_data['cc_est_id_expery']  = "";
        }


        if(!empty($this->request->getPost("cc_qid_expiry")))
        {
            $update_data['cc_qid_expiry'] = date('Y-m-d', strtotime($this->request->getPost("cc_qid_expiry")));
        }
        else
        {
            $update_data['cc_qid_expiry'] = "";
        }


        // Handle file upload
        if (isset($_FILES['cc_attach_cr']) && $_FILES['cc_attach_cr']['name'] !== '') {
            
               
            if($this->request->getFile('cc_attach_cr') != '' ){ 
               
                if(!empty($official_doc->cc_attach_cr))
                {
                    $previousImagePath = 'uploads/Vendor/' .$official_doc->cc_attach_cr;
                
                    if (file_exists($previousImagePath)) {
                        unlink($previousImagePath);
                    }
                }
            }
            
            // Upload the new image
            $ccAttachCrFileName = $this->uploadFile('cc_attach_cr', 'uploads/Vendor');
        
            // Update the data with the new image filename
            $update_data['cc_attach_cr'] = $ccAttachCrFileName;
        }



        if (isset($_FILES['cc_est_id_attach']) && $_FILES['cc_est_id_attach']['name'] !== '') {
            
               
            if($this->request->getFile('cc_est_id_attach') != '' ){ 
                
                if(!empty($official_doc->cc_est_id_attach))
                {
                    $previousImagePath1 = 'uploads/Vendor/' .$official_doc->cc_est_id_attach;
                
                    if (file_exists($previousImagePath1)) {
                        unlink($previousImagePath1);
                    }
                }
            }
            
            // Upload the new image
            $ccEstIdFileName = $this->uploadFile('cc_est_id_attach', 'uploads/Vendor');
        
            // Update the data with the new image filename
            $update_data['cc_est_id_attach'] = $ccEstIdFileName;
        }



        if (isset($_FILES['cc_qid_attach']) && $_FILES['cc_qid_attach']['name'] !== '') {
            
               
            if($this->request->getFile('cc_qid_attach') != '' ){ 
               
                if(!empty($official_doc->cc_qid_attach))
                {
                    $previousImagePath2 = 'uploads/Vendor/' .$official_doc->cc_qid_attach;
                
                    if (file_exists($previousImagePath2)) {
                        unlink($previousImagePath2);
                    }
                }    
            }
            
            // Upload the new image
            $qidAttachFileName = $this->uploadFile('cc_qid_attach', 'uploads/Vendor');
        
            // Update the data with the new image filename
            $update_data['cc_qid_attach'] = $qidAttachFileName;
        }



        

        // Check if the 'account_id' key exists before unsetting it
        if (array_key_exists('cc_id', $update_data)) 
        {
            unset($update_data['cc_id']);
        } 

       
	    $this->common_model->EditData($update_data,$cond,'crm_customer_creation');
    }



    // Function to handle file upload
    public function uploadFile($fieldName, $uploadPath)
    {
        $file = $this->request->getFile($fieldName);

        if($file === null){

            // Debugging output
            echo('No file uploaded or incorrect field name');
           
        }
 
        if ($file->isValid() && !$file->hasMoved()) 
        {
            $newName = $file->getRandomName();
            $file->move($uploadPath, $newName);
            return $newName;
        }
 
        return null;

    }


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
        
        $id = $this->request->getPost('ID');

        $official_doc = $this->common_model->SingleRow('crm_customer_creation',array('cc_id' => $this->request->getPost('ID')));
        
        if(!empty($official_doc->cc_attach_cr)){
            
            $previousImagePath = 'uploads/Vendor/' .$official_doc->cc_attach_cr;

            if (file_exists($previousImagePath)) {
                unlink($previousImagePath);
            }

        }


        if(!empty($official_doc->cc_est_id_attach))
        {
            $previousImagePath2 = 'uploads/Vendor/' .$official_doc->cc_est_id_attach;

            if (file_exists($previousImagePath2)) {
                unlink($previousImagePath2);
            }
        }



        if(!empty($official_doc->cc_qid_attach))
        {
            $previousImagePath3 = 'uploads/Vendor/' .$official_doc->cc_qid_attach;

            if (file_exists($previousImagePath3)) {
                unlink($previousImagePath3);
            }
        }

        $purchase_order = $this->common_model->FetchWhere('pro_purchase_order',array('po_vendor_name' => $this->request->getPost('ID')));

        

        if(empty($purchase_order)){

            $this->common_model->DeleteData('crm_customer_creation',array('cc_id' => $this->request->getPost('ID')));

            $this->common_model->DeleteData('crm_contact_details',array('contact_id' => $this->request->getPost('ID')));

            $coa_cond['ca_customer'] = $id;

            $coa_cond['ca_type'] = "VENDOR";

            

            $this->common_model->DeleteData('accounts_charts_of_accounts',$coa_cond);
        
            $data['status'] = 1; 

            $data['msg'] ="Data Deleted Successfully";
        }
        else{

            $data['status'] = 0;

            $data['msg'] ="Data In Use. Cannot Delete";
        }
        

        echo json_encode($data);
        
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
