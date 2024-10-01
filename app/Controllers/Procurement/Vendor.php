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
            $action = '<a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->ven_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a><a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->ven_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> Delete</a><a href="javascript:void(0)" data-id="'.$record->ven_id.'" class="view view-color view_btn" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a>';
            
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

        if(!empty($this->request->getPost("ven_cr_expiry")))
        {
            $update_data['ven_cr_expiry']  = date('Y-m-d', strtotime($this->request->getPost("ven_cr_expiry")));
        }
        else
        {
            $update_data['ven_cr_expiry']  = "";
        }


        if(!empty($this->request->getPost("ven_est_expiry")))
        {
            $update_data['ven_est_expiry'] = date('Y-m-d', strtotime($this->request->getPost("ven_est_expiry")));
        }
        else
        {
            $update_data['ven_est_expiry']  = "";
        }


        if(!empty($this->request->getPost("ven_qid_expiry")))
        {
            $update_data['ven_qid_expiry'] = date('Y-m-d', strtotime($this->request->getPost("ven_qid_expiry")));
        }
        else
        {
            $update_data['ven_qid_expiry'] = "";
        }
        
  
        
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
        $join =  array(
                    
            array(
                'table' => 'accounts_account_heads',
                'pk'    => 'ah_id',
                'fk'    => 'ven_account_head',
            ),


        );

        $vendor = $this->common_model->SingleRowJoin('pro_vendor', array('ven_id' => $this->request->getPost('ID')),$join);

        $data['vendor_name']   = $vendor->ven_name;

        $data['account_name']  = $vendor->ah_account_name;

        $data['account_id']    = $vendor->ven_account_id;

        $data['post_box']      = $vendor->ven_post_box;

        $data['telephone']     = $vendor->ven_telephone;

        $data['fax']           = $vendor->ven_fax;

        $data['email']         = $vendor->ven_email;

        $data['credit_term']   = $vendor->ven_credit_term;

        $data['credit_period'] = $vendor->ven_credit_period;

        $data['credit_limit']  = $vendor->ven_credit_limit;

        $data['vendor_id']  = $vendor->ven_id;

        //office document 

        $data['cr_no']  = $vendor->ven_cr_no;

        if($vendor->ven_cr_expiry == "0000-00-00")
        {
            $data['cr_expiry'] =""; 
        }
        else
        {
            $data['cr_expiry']  = date('d-M-Y',strtotime($vendor->ven_cr_expiry));
        }
        

        $data['est_id']  = $vendor->ven_est_id;

        if($vendor->ven_est_expiry == "0000-00-00")
        {
            $data['est_id_expiry'] = "";
        }
        else
        {
            $data['est_id_expiry']  = date('d-M-Y',strtotime($vendor->ven_est_expiry));
        }
        

        $data['signature_name']  = $vendor->ven_signature_name;

        $data['qid_no']  = $vendor->ven_qid_no;

        if($vendor->ven_qid_expiry == "0000-00-00")
        {
            $data['qid_expiry'] = "";
        }
        else
        {
            $data['qid_expiry']  = date('d-M-Y',strtotime($vendor->ven_qid_expiry));
        }
        


        //image section start

        if(!empty($vendor->ven_cr_attach))
        {
            $data['ven_cr_attach'] = '<a href="' . base_url('uploads/Vendor/' . $vendor->ven_cr_attach) . '" target="_blank">View</a>';  
        }
        else
        {
            $data['ven_cr_attach'] = "";
        }

        if(!empty($vendor->ven_est_attach))
        {
            $data['ven_est_attach'] = '<a href="' . base_url('uploads/Vendor/' . $vendor->ven_est_attach) . '" target="_blank">View</a>';  
        }
        else
        {
            $data['ven_est_attach'] = "";
        }



        if(!empty($vendor->	ven_qid_attach))
        {
            $data['ven_qid_attach'] = '<a href="' . base_url('uploads/Vendor/' . $vendor->ven_qid_attach) . '" target="_blank">View</a>';  
        }
        else
        {
            $data['ven_qid_attach'] = "";
        }

         
        $contact_data = $this->common_model->FetchWhere('pro_contact',array('pro_con_vendor' => $this->request->getPost('ID')));
        
       
        $i = 1;

        $data['contact'] = "";
        foreach($contact_data as $contact){

            $data['contact'] .='<tr class="prod_row_edit" id="'.$contact->pro_con_id.'">
            <td class="si_no_edit">'.$i.'</td>
            <td><input type="text" name="contact_person[]"  value="'.$contact->pro_con_person.'" class="form-control" readonly></td>
            <td><input type="text" name="contact_designation[]"  value="'.$contact->pro_con_designation.'" class="form-control" readonly></td>
            <td><input type="text" name="contact_mobile[]"  value="'.$contact->pro_con_mobile.'" class="form-control" readonly></td>
            <td> <input type="email" name="contact_email[]" value="'.$contact->pro_con_email.'" class="form-control" readonly></td>
            <td class="row_remove delete_contact" data-id="'.$contact->pro_con_id.'"><i class="ri-close-line"></i>Remove</td>
            <td class="row_contact_edit row_edit" data-id="'.$contact->pro_con_id.'"><i class="ri-pencil-fill"></i>Edit</td>
           
            </tr>
            <input type="hidden" class="edit_con_ven_id" value="'.$contact->pro_con_vendor.'">
            
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
                'fk'    => 'ven_account_head',
            ),


        );

        $vendor = $this->common_model->SingleRowJoin('pro_vendor', array('ven_id' => $this->request->getPost('ID')),$join);

        $data['vendor_name']   = $vendor->ven_name;

        $data['account_name']  = $vendor->ah_account_name;

        $data['account_id']    = $vendor->ven_account_id;

        $data['post_box']      = $vendor->ven_post_box;

        $data['telephone']     = $vendor->ven_telephone;

        $data['fax']           = $vendor->ven_fax;

        $data['email']         = $vendor->ven_email;

        $data['credit_term']   = $vendor->ven_credit_term;

        $data['credit_period'] = $vendor->ven_credit_period;

        $data['credit_limit']  = $vendor->ven_credit_limit;

        //office document 

        $data['cr_no']  = $vendor->ven_cr_no;

        $data['est_id']  = $vendor->ven_est_id;

        $data['signature_name']  = $vendor->ven_signature_name;

        $data['qid_no']  = $vendor->ven_qid_no;

        

         
        $contact_data = $this->common_model->FetchWhere('pro_contact',array('pro_con_vendor' => $this->request->getPost('ID')));
        
       
        $i = 1;

        $data['contact'] = "";
        foreach($contact_data as $contact){


            $data['contact'] .='<tr class="edit_prod_row" id="'.$contact->pro_con_id.'">
            <td class="si_no1">'.$i.'</td>
            <td><input type="text" name="contact_person[]"  value="'.$contact->pro_con_person.'" class="form-control" readonly></td>
            <td><input type="text" name="contact_designation[]"  value="'.$contact->pro_con_designation.'" class="form-control" readonly></td>
            <td><input type="text" name="contact_mobile[]"  value="'.$contact->pro_con_mobile.'" class="form-control" readonly></td>
            <td> <input type="email" name="contact_email[]" value="'.$contact->pro_con_email.'" class="form-control" readonly></td>
           
            </tr>
            <input type="hidden" class="contact_cust" value="">
            '; 
            $i++; 
            
            
            //date section start

            if($vendor->ven_cr_expiry == "0000-00-00")
            {
                $data['cr_expiry'] ="";
            }
            else
            {
                $data['cr_expiry']  = date('d-M-Y',strtotime($vendor->ven_cr_expiry));
            }


            if($vendor->ven_est_expiry == "0000-00-00")
            {
                $data['est_id_expiry'] ="";
            }
            else
            {
                $data['est_id_expiry']  = date('d-M-Y',strtotime($vendor->ven_est_expiry));
            }


            if($vendor->ven_qid_expiry == "0000-00-00")
            {
                $data['qid_expiry'] ="";
            }
            else
            {
                $data['qid_expiry']  = date('d-M-Y',strtotime($vendor->ven_qid_expiry));
            }
            



            //image section start

            if(!empty($vendor->ven_cr_attach))
            {
                $data['ven_cr_attach'] = '<a href="' . base_url('uploads/Vendor/' . $vendor->ven_cr_attach) . '" target="_blank">View</a>';  
            }
            else
            {
                $data['ven_cr_attach'] = "";
            }



            if(!empty($vendor->ven_est_attach))
            {
                $data['ven_est_attach'] = '<a href="' . base_url('uploads/Vendor/' . $vendor->ven_est_attach) . '" target="_blank">View</a>';  
            }
            else
            {
                $data['ven_est_attach'] = "";
            }



            if(!empty($vendor->	ven_qid_attach))
            {
                $data['ven_qid_attach'] = '<a href="' . base_url('uploads/Vendor/' . $vendor->ven_qid_attach) . '" target="_blank">View</a>';  
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
        $contact_edit = $this->common_model->SingleRow('pro_contact',array('pro_con_id' => $this->request->getPost('ID')));
        
        $data['contact'] ='<tr class="edit_prod_row" id="'.$contact_edit->pro_con_id.'">
            <td><input type="text" name="pro_con_person"  value="'.$contact_edit->pro_con_person.'" class="form-control" required></td>
            <td><input type="text" name="pro_con_designation"  value="'.$contact_edit->pro_con_designation.'" class="form-control" required></td>
            <td><input type="text" name="pro_con_mobile"  value="'.$contact_edit->pro_con_mobile.'" class="form-control edit_contact" required></td>
            <td> <input type="email" name="pro_con_email" value="'.$contact_edit->pro_con_email.'" class="form-control" required></td>
            </tr>
            <input type="hidden" class="contact_cust" name="pro_con_id" value="'.$contact_edit->pro_con_id.'">
            '; 

        echo json_encode($data);

    }


    public function UpdateContact()
    {
        $cond = array('pro_con_id' => $this->request->getPost('pro_con_id'));
        
        $update_data = $this->request->getPost();

        // Check if the 'account_id' key exists before unsetting it
        if (array_key_exists('pro_con_id', $update_data)) 
        {
            unset($update_data['pro_con_id']);
        } 
        if (array_key_exists('pro_con_vendor', $update_data)) 
        {
            unset($update_data['pro_con_vendor']);
        }   
        
	    $this->common_model->EditData($update_data,$cond,'pro_contact');


    }


    public function DeleteContact()
    {
        $cond = array('pro_con_id' => $this->request->getPost('ID'));
 
        $this->common_model->DeleteData('pro_contact',$cond);

    }


    public function Update()
    {
        $cond = array('ven_id' => $this->request->getPost('ven_id'));
        
        $update_data = $this->request->getPost();

        // Check if the 'account_id' key exists before unsetting it
        if (array_key_exists('ven_id', $update_data)) 
        {
            unset($update_data['ven_id']);
        } 

        if (array_key_exists('ven_account_head', $update_data)) 
        {
            unset($update_data['ven_account_head']);
        } 

        if (array_key_exists('ven_account_id', $update_data)) 
        {
            unset($update_data['ven_account_id']);
        } 
       
	    $this->common_model->EditData($update_data,$cond,'pro_vendor');

        $charts_of_account = $this->common_model->SingleRow('accounts_charts_of_accounts',array('ca_customer' => $this->request->getPost('ven_id')),array('ca_type' => 'VENDOR'));
        
        $this->common_model->EditData(array('ca_name' => $this->request->getPost('ven_name')),array('ca_id' => $charts_of_account->ca_id),'accounts_charts_of_accounts');

        
    }


    public function EditAddContact()
    {
        $insert_data = $this->request->getPost();
        
        $id = $this->common_model->InsertData('pro_contact',$insert_data);

    }

    public function EditTab3()
    {
        $cond = array('ven_id' => $this->request->getPost('ven_id'));
        
        $official_doc = $this->common_model->SingleRow('pro_vendor',$cond);
        
        $update_data = $this->request->getPost();

        if(!empty($this->request->getPost("ven_cr_expiry")))
        {
            $update_data['ven_cr_expiry']  = date('Y-m-d', strtotime($this->request->getPost("ven_cr_expiry")));
        }
        else
        {
            $update_data['ven_cr_expiry']  = "";
        }


        if(!empty($this->request->getPost("ven_est_expiry")))
        {
            $update_data['ven_est_expiry'] = date('Y-m-d', strtotime($this->request->getPost("ven_est_expiry")));
        }
        else
        {
            $update_data['ven_est_expiry']  = "";
        }


        if(!empty($this->request->getPost("ven_qid_expiry")))
        {
            $update_data['ven_qid_expiry'] = date('Y-m-d', strtotime($this->request->getPost("ven_qid_expiry")));
        }
        else
        {
            $update_data['ven_qid_expiry'] = "";
        }


        // Handle file upload
        if (isset($_FILES['ven_cr_attach']) && $_FILES['ven_cr_attach']['name'] !== '') {
            
               
            if($this->request->getFile('ven_cr_attach') != '' ){ 
               
                if(!empty($official_doc->ven_cr_attach))
                {
                    $previousImagePath = 'uploads/Vendor/' .$official_doc->ven_cr_attach;
                
                    if (file_exists($previousImagePath)) {
                        unlink($previousImagePath);
                    }
                }
            }
            
            // Upload the new image
            $ccAttachCrFileName = $this->uploadFile('ven_cr_attach', 'uploads/Vendor');
        
            // Update the data with the new image filename
            $update_data['ven_cr_attach'] = $ccAttachCrFileName;
        }



        if (isset($_FILES['ven_est_attach']) && $_FILES['ven_est_attach']['name'] !== '') {
            
               
            if($this->request->getFile('ven_est_attach') != '' ){ 
                
                if(!empty($official_doc->ven_est_attach))
                {
                    $previousImagePath1 = 'uploads/Vendor/' .$official_doc->ven_est_attach;
                
                    if (file_exists($previousImagePath1)) {
                        unlink($previousImagePath1);
                    }
                }
            }
            
            // Upload the new image
            $ccEstIdFileName = $this->uploadFile('ven_est_attach', 'uploads/Vendor');
        
            // Update the data with the new image filename
            $update_data['ven_est_attach'] = $ccEstIdFileName;
        }



        if (isset($_FILES['ven_qid_attach']) && $_FILES['ven_qid_attach']['name'] !== '') {
            
               
            if($this->request->getFile('ven_qid_attach') != '' ){ 
               
                if(!empty($official_doc->ven_qid_attach))
                {
                    $previousImagePath2 = 'uploads/Vendor/' .$official_doc->ven_qid_attach;
                
                    if (file_exists($previousImagePath2)) {
                        unlink($previousImagePath2);
                    }
                }    
            }
            
            // Upload the new image
            $qidAttachFileName = $this->uploadFile('ven_qid_attach', 'uploads/Vendor');
        
            // Update the data with the new image filename
            $update_data['ven_qid_attach'] = $qidAttachFileName;
        }



        

        // Check if the 'account_id' key exists before unsetting it
        if (array_key_exists('ven_id', $update_data)) 
        {
            unset($update_data['ven_id']);
        } 

       
	    $this->common_model->EditData($update_data,$cond,'pro_vendor');
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
        $official_doc = $this->common_model->SingleRow('pro_vendor',array('ven_id' => $this->request->getPost('ID')));
        
        if(!empty($official_doc->ven_cr_attach)){
            
            $previousImagePath = 'uploads/Vendor/' .$official_doc->ven_cr_attach;

            if (file_exists($previousImagePath)) {
                unlink($previousImagePath);
            }

        }


        if(!empty($official_doc->ven_est_attach))
        {
            $previousImagePath2 = 'uploads/Vendor/' .$official_doc->ven_est_attach;

            if (file_exists($previousImagePath2)) {
                unlink($previousImagePath2);
            }
        }



        if(!empty($official_doc->ven_qid_attach))
        {
            $previousImagePath3 = 'uploads/Vendor/' .$official_doc->ven_qid_attach;

            if (file_exists($previousImagePath3)) {
                unlink($previousImagePath3);
            }
        }

        $purchase_order = $this->common_model->FetchWhere('pro_purchase_order',array('po_vendor_name' => $this->request->getPost('ID')));

        if(empty($purchase_order)){

            $this->common_model->DeleteData('pro_vendor',array('ven_id' => $this->request->getPost('ID')));

            $this->common_model->DeleteData('pro_contact',array('pro_con_vendor' => $this->request->getPost('ID')));
        
            $data['status'] = "true"; 
        }
        else{

            $data['status'] ="false";
        }
        

        echo json_encode($data);
        
    }
 



}
