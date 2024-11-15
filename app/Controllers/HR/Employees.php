<?php

namespace App\Controllers\HR;

use App\Controllers\BaseController;

use NumberToWords\NumberToWords;


class Employees extends BaseController
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
       
        $totalRecords = $this->common_model->GetTotalRecords('hr_employees','emp_id','DESC');
 
        ## Total number of records with filtering
       
        $searchColumns = array('emp_name');

        $totalRecordwithFilter = $this->common_model->GetTotalRecordwithFilter('hr_employees','emp_id',$searchValue,$searchColumns);
    
        ##Joins if any //Pass Joins as Multi dim array
        $joins = array(
           
            array(
            'table' => 'hr_divisions',
            'pk' => 'div_id',
            'fk' => 'emp_division',
            ),


        );
        ## Fetch records
        $records = $this->common_model->GetRecord('hr_employees','emp_id',$searchValue,$searchColumns,$columnName,$columnSortOrder,$joins,$rowperpage,$start);
    
        $data = array();

        $i=1;
        foreach($records as $record ){

           $action = '<a  href="javascript:void(0)" class="edit edit-color view_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->emp_id.'" data-original-title="Edit"><i class="ri-eye-fill"></i> View</a> <a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->emp_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a> <a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->emp_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> Delete</a>';
           
           $data[] = array( 
              "emp_id"=>$i,
              "employee_id" => $record->emp_uid,
              "employee_name" => $record->emp_name,
              'division' => $record->div_name,
              'designation' => $record->emp_designation,
              'date_of_join' => date('d-F-Y',strtotime($record->emp_date_of_join)),
              "contract_expiry"=>  date('d-F-Y',strtotime($record->emp_contract_expiry)),
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

        $data['divisions'] = $this->common_model->FetchAllOrder('hr_divisions','div_name','asc');

        $data['mops'] = $this->common_model->FetchAllOrder('hr_mode_of_pay','mop_title','asc');

        return view('hr/employees',$data);

    }


    // add account head
    Public function Add()
    {   

        $insert_data['emp_uid'] = $this->request->getPost('employee_id');

        $insert_data['emp_name'] = $this->request->getPost('employee_name');

        $insert_data['emp_account_head'] = $this->request->getPost('account_head');

        $insert_data['emp_date_of_join'] = date('Y-m-d',strtotime($this->request->getPost('date_of_join')));

        $insert_data['emp_designation'] = $this->request->getPost('designation');

        $insert_data['emp_nationality'] = $this->request->getPost('nationality');

        $insert_data['emp_contact_no'] = $this->request->getPost('contact_number');

        $insert_data['emp_home_contact_no'] = $this->request->getPost('country_contact');

        $insert_data['emp_division'] = $this->request->getPost('division');

        $insert_data['emp_status'] = $this->request->getPost('status');

        
        if ($_FILES['photo']['name'] !== '') {
            $attachment_name = $this->uploadFile($insert_data['emp_uid'],'photo','uploads/Employees');
            $insert_data['emp_picture'] = $attachment_name;
        }


        if(empty($this->request->getPost('emp_id')))

        {

        //$insert_data['r_added_by'] = 1;

        //$insert_data['r_added_date'] = date('Y-m-d');

        $id = $this->common_model->InsertData('hr_employees',$insert_data);
        
        }

        else
        {

        $id = $this->request->getPost('emp_id');

        $emp_cond = array('emp_id' => $this->request->getPost('emp_id'));

        $this->common_model->EditData($insert_data,$emp_cond,'hr_employees');

        }

        $coa_data['ca_name'] = $insert_data['emp_name'];

        $coa_data['ca_account_type'] = $insert_data['emp_account_head'];

        $coa_data['ca_customer'] = $id;

        $coa_data['ca_account_id'] = $this->request->getPost('account_id');

        $coa_data['ca_type'] = "EMPLOYEE";

        $this->common_model->InsertData('accounts_charts_of_accounts',$coa_data);

        echo $id;

    }

    //refresh table with ajax


    public function AddSalary()
    {

        if($_POST)
        {

            $id = $this->request->getPost('emp_id');

            $update_data['emp_basic_salary'] = $this->request->getPost('basic_salary');
            $update_data['emp_house_rent_allow'] = $this->request->getPost('house_rent_allow');
            $update_data['emp_transport_allow'] = $this->request->getPost('transport_allow');
            $update_data['emp_tel_allow'] = $this->request->getPost('telephone_allow');
            $update_data['emp_food_allow'] = $this->request->getPost('food_allowance');
            $update_data['emp_other_allow'] = $this->request->getPost('other_allow');

            $update_data['emp_total_salary'] = array_sum($update_data);

            //$update_data['emp_total_salary'] = $this->request->getPost('total_salary');
            
            $update_data['emp_mode_of_payment'] = $this->request->getPost('mode_of_payment');
            $update_data['emp_account_number'] = $this->request->getPost('account_number');
            $update_data['emp_bank'] = $this->request->getPost('bank_name');
            $update_data['emp_air_ticket_per_year'] = $this->request->getPost('air_ticket_per_year');
            $update_data['emp_budgeted_ticket_amount'] = $this->request->getPost('budgeted_air_ticket');

            
            $update_data['emp_vacation_taken'] = $this->request->getPost('vacation_taken');

            if(!empty($this->request->getPost('air_ticket_due_from')))
            $update_data['emp_air_ticket_due_from'] = date('Y-m-d',strtotime($this->request->getPost('air_ticket_due_from')));

            if(!empty($this->request->getPost('vacation_pay_due_from')))
            $update_data['emp_vacation_pay_due_from']= date('Y-m-d',strtotime($this->request->getPost('vacation_pay_due_from')));

            $update_data['emp_indemnity_advance']= $this->request->getPost('indemnity_advance');

            $update_data['emp_id_charges_deduction']= $this->request->getPost('id_charges_deduction');

            $emp_cond = array('emp_id' => $id);

            $this->common_model->EditData($update_data,$emp_cond,'hr_employees');

        }



    }



    public function AddDocuments()
    {

        if($_POST)
        {

            $id = $this->request->getPost('emp_id');

            $update_data['emp_passport_no'] = $this->request->getPost('passport_no');
            $update_data['emp_passport_expiry'] = date('Y-m-d',strtotime($this->request->getPost('passport_expiry')));
            $update_data['emp_visa_no'] = $this->request->getPost('visa_no');
            $update_data['emp_visa_expiry'] = date('Y-m-d',strtotime($this->request->getPost('visa_expiry')));
            $update_data['emp_qatar_id_no'] = $this->request->getPost('qatar_id');
            $update_data['emp_qatar_id_expiry'] = date('Y-m-d',strtotime($this->request->getPost('qid_expiry')));
            $update_data['emp_contract_expiry'] = date('Y-m-d',strtotime($this->request->getPost('contract_expiry')));

            if ($_FILES['passport_file']['name'] !== '') {
                $passport_file = $this->uploadFile($id,'passport_file','uploads/Employees/Documents');
                $update_data['emp_passport_file'] = $passport_file;
            }


            if ($_FILES['visa_file']['name'] !== '') {
                $visa_file = $this->uploadFile($id,'visa_file','uploads/Employees/Documents');
                $update_data['emp_visa_file'] = $visa_file;
            }


            if ($_FILES['qid_file']['name'] !== '') {
                $qid_file = $this->uploadFile($id,'qid_file','uploads/Employees/Documents');
                $update_data['emp_qatar_id_file'] = $qid_file;
            }

            if ($_FILES['contract_file']['name'] !== '') {
                $contract_file = $this->uploadFile($id,'contract_file','uploads/Employees/Documents');
                $update_data['emp_contract_file'] = $contract_file;
            }


            $update_data['emp_update_status'] = 1;
            

            $emp_cond = array('emp_id' => $id);
            
            $this->common_model->EditData($update_data,$emp_cond,'hr_employees');

        }

    }



 
    //account head modal 
    public function Edit()
    {
        
        $cond = array('emp_id' => $this->request->getPost('emp_id'));

         ##Joins if any //Pass Joins as Multi dim array
        $joins = array(
       /* array(
          'table' => 'accounts_charts_of_accounts',
          'pk' => 'ca_id',
          'fk' => 'r_debit_account',
        ) */
        );

        $data['emp'] = $this->common_model->SingleRowJoin('hr_employees',$cond,$joins);

        //$data['emp']->r_date = date('d-F-Y',strtotime($data['rc']->r_date));

        echo json_encode($data);

    }



        // update 
        public function Update()
        {    

        $cond = array('emp_id' => $id = $this->request->getPost('emp_id'));

        $insert_data['emp_uid'] = $this->request->getPost('employee_id');

        $insert_data['emp_name'] = $this->request->getPost('employee_name');

        $insert_data['emp_date_of_join'] = date('Y-m-d',strtotime($this->request->getPost('date_of_join')));

        $insert_data['emp_designation'] = $this->request->getPost('designation');

        $insert_data['emp_nationality'] = $this->request->getPost('nationality');

        $insert_data['emp_contact_no'] = $this->request->getPost('contact_number');

        $insert_data['emp_home_contact_no'] = $this->request->getPost('country_contact');

        $insert_data['emp_division'] = $this->request->getPost('division');


        if ($_FILES['photo']['name'] !== '') {
            $attachment_name = $this->uploadFile($insert_data['emp_uid'],'photo','uploads/Employees');
            $insert_data['emp_picture'] = $attachment_name;
        }


        $coa_data['ca_name'] = $insert_data['emp_name'];

        $cond_coa['ca_customer'] = $id;

        $cond_coa['ca_type'] ="EMPLOYEE";
        
        $this->common_model->EditData($insert_data,$cond,'hr_employees');

        $this->common_model->EditData($coa_data,$cond_coa,'accounts_charts_of_accounts');

    }



    
    public function UpdateSalary()
    {

        if($_POST)
        {

            $id = $this->request->getPost('emp_id');

            $update_data['emp_basic_salary'] = $this->request->getPost('basic_salary');
            $update_data['emp_house_rent_allow'] = $this->request->getPost('house_rent_allow');
            $update_data['emp_transport_allow'] = $this->request->getPost('transport_allow');
            $update_data['emp_tel_allow'] = $this->request->getPost('telephone_allow');
            $update_data['emp_food_allow'] = $this->request->getPost('food_allowance');
            $update_data['emp_other_allow'] = $this->request->getPost('other_allow');

            $update_data['emp_total_salary'] = array_sum($update_data);

            //$update_data['emp_total_salary'] = $this->request->getPost('total_salary');
            
            $update_data['emp_mode_of_payment'] = $this->request->getPost('mode_of_payment');
            $update_data['emp_account_number'] = $this->request->getPost('account_number');
            $update_data['emp_bank'] = $this->request->getPost('bank_name');
            $update_data['emp_air_ticket_per_year'] = $this->request->getPost('air_ticket_per_year');
            $update_data['emp_budgeted_ticket_amount'] = $this->request->getPost('budgeted_air_ticket');

            $update_data['emp_vacation_taken'] = $this->request->getPost('vacation_taken');

            if(!empty($this->request->getPost('air_ticket_due_from')))
            $update_data['emp_air_ticket_due_from'] = date('Y-m-d',strtotime($this->request->getPost('air_ticket_due_from')));

            if(!empty($this->request->getPost('vacation_pay_due_from')))
            $update_data['emp_vacation_pay_due_from']= date('Y-m-d',strtotime($this->request->getPost('vacation_pay_due_from')));

            $update_data['emp_indemnity_advance']= $this->request->getPost('indemnity_advance');
            

            $emp_cond = array('emp_id' => $id);

            $this->common_model->EditData($update_data,$emp_cond,'hr_employees');

        }



    }



    public function UpdateDocuments()
    {

        if($_POST)
        {

            $id = $this->request->getPost('emp_id');

            $update_data['emp_passport_no'] = $this->request->getPost('passport_no');
            $update_data['emp_passport_expiry'] = date('Y-m-d',strtotime($this->request->getPost('passport_expiry')));
            $update_data['emp_visa_no'] = $this->request->getPost('visa_no');
            $update_data['emp_visa_expiry'] = date('Y-m-d',strtotime($this->request->getPost('visa_expiry')));
            $update_data['emp_qatar_id_no'] = $this->request->getPost('qatar_id');
            $update_data['emp_qatar_id_expiry'] = date('Y-m-d',strtotime($this->request->getPost('qid_expiry')));
            $update_data['emp_contract_expiry'] = date('Y-m-d',strtotime($this->request->getPost('contract_expiry')));

            if ($_FILES['passport_file']['name'] !== '') {
                $passport_file = $this->uploadFile($id,'passport_file','uploads/Employees/Documents');
                $update_data['emp_passport_file'] = $passport_file;
            }


            if ($_FILES['visa_file']['name'] !== '') {
                $visa_file = $this->uploadFile($id,'visa_file','uploads/Employees/Documents');
                $update_data['emp_visa_file'] = $visa_file;
            }


            if ($_FILES['qid_file']['name'] !== '') {
                $qid_file = $this->uploadFile($id,'qid_file','uploads/Employees/Documents');
                $update_data['emp_qatar_id_file'] = $qid_file;
            }

            if ($_FILES['contract_file']['name'] !== '') {
                $contract_file = $this->uploadFile($id,'contract_file','uploads/Employees/Documents');
                $update_data['emp_contract_file'] = $contract_file;
            }

            $update_data['emp_update_status'] = 1;

            $emp_cond = array('emp_id' => $id);
            
            $this->common_model->EditData($update_data,$emp_cond,'hr_employees');

        }

    }







    public function View()
    {

    $id = $this->request->getPost('emp_id');

    $cond = array('emp_id' => $id);

     ##Joins if any //Pass Joins as Multi dim array
     $joins = array(
        array(
            'table' => 'hr_divisions',
            'pk' => 'div_id',
            'fk' => 'emp_division',
            ),
            array(
                'table' => 'hr_mode_of_pay',
                'pk' => 'mop_id',
                'fk' => 'emp_mode_of_payment',
                ),
     );

    $data['employee'] = $this->common_model->SingleRowJoin('hr_employees',$cond,$joins);

    $data['employee']->emp_doj = date('d-F-Y',strtotime($data['employee']->emp_date_of_join));

    if(!empty($data['employee']->emp_air_ticket_due_from))
    $data['employee']->emp_air_ticket_due_from = date('d-F-Y',strtotime($data['employee']->emp_air_ticket_due_from));

    if(!empty($data['employee']->emp_vacation_pay_due_from))
    $data['employee']->emp_vacation_pay_due_from = date('d-F-Y',strtotime($data['employee']->emp_vacation_pay_due_from));

    echo json_encode($data);

    }









    //delete account head
    public function Delete()
    {
        $cond = array('emp_id' => $this->request->getPost('id'));

        $this->common_model->DeleteData('hr_employees',$cond);

        $coa_cond = array('ca_customer' => $this->request->getPost('id'),'ca_type' => 'EMPLOYEE');

        $this->common_model->DeleteData('accounts_charts_of_accounts',$coa_cond);

      
    }





    public function FetchReference()
    {

    $uid = $this->common_model->FetchNextId('accounts_receipts',"REC");

    echo $uid;

    }


    // Function to handle file upload
    public function uploadFile($unique,$fieldName, $uploadPath)
    {
        $file = $this->request->getFile($fieldName);

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $unique.$file->getRandomName();
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
         
           $data['result'] = $this->common_model->FetchAllLimit('accounts_account_heads','ah_account_name','asc',$term,$end,$start);
   
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



    public function EmpNoCheck()
    {

        if($_POST)
        
        {

        $emp_uid = $this->request->getPost('emp_no');

        $cond = array('emp_uid' => $emp_uid);

        $check = $this->common_model->CountWhere('hr_employees',$cond);

        if($check>0)
        {

        echo 'false'; 

        }
        else
        {

        echo 'true';

        }

        }


    }



}
