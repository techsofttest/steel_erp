<?php

namespace App\Controllers\Accounts;

use App\Controllers\BaseController;


class ChartsOfAccounts extends BaseController
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
       
        $totalRecords = $this->common_model->GetTotalRecords('accounts_charts_of_accounts','ca_id','DESC');
 
        ## Total number of records with filtering
       
        $searchColumns = array('ca_name','ca_account_id');

        $totalRecordwithFilter = $this->common_model->GetTotalRecordwithFilter('accounts_charts_of_accounts','ca_id',$searchValue,$searchColumns);
    
        ##Joins if any //Pass Joins as Multi dim array
        $joins = array(
            /*
            array(
            'table' => 'accounts_account_types',
            'pk' => 'at_id',
            'fk' => 'ca_account_type',
            ),
            */
            
            
            array(
                'table' => 'accounts_account_heads',
                'pk' => 'ah_id',
                'fk' => 'ca_account_type',
                ),

        );
        ## Fetch records
        $records = $this->common_model->GetRecord('accounts_charts_of_accounts','ca_id',$searchValue,$searchColumns,$columnName,$columnSortOrder,$joins,$rowperpage,$start);
    
        $data = array();

        $i=1;
        foreach($records as $record ){

            $action = '<a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->ca_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a><a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->ca_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> Delete</a>';
           
            if(!empty($record->ca_customer_id))
            {
            $customer = $record->cc_customer_name;
            }
            else
            {
            $customer="---";
            }

           $data[] = array( 
              "ca_id"=>$i,
              'at_name' => $record->ah_account_name,
              'ca_account_id' => $record->ca_account_id,
              "ca_name"=>$record->ca_name,
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



    /*
    public function FetchTypes()
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
    */




    //view page
    public function index()
    {   

       
        $data['account_heads'] = $this->common_model->FetchAllOrder('accounts_account_heads','ah_account_name','asc');

        $data['content'] = view('accounts/chart-of-accounts',$data);

        return view('accounts/accounts-module',$data);
    }





    // add account head
    Public function Add()
    {   

        $ca_id = $this->request->getPost('ca_account_id');

        $ca_name = $this->request->getPost('ca_name');

        $id_check = $this->common_model->SingleRow('accounts_charts_of_accounts',array('ca_account_id' => $ca_id));

        $name_check = $this->common_model->SingleRow('accounts_charts_of_accounts',array('ca_name' => $ca_name));


        if(!empty($id_check))
        {

        $data['message']="Duplicate Id";
        $data['status']=0;
        
        }

        else if(!empty($name_check))
        {

        $data['message']="Duplicate Name";
        $data['status']=0;

        }

        else{
        
        $data['status']=1;

        $insert_data = $_POST;

        $id = $this->common_model->InsertData('accounts_charts_of_accounts',$insert_data);

        }

        echo json_encode($data);

    }




    public function NextId()
    {

        if($_POST)
        {

            $head_id = $this->request->getPost('id');

            $next_id = $this->common_model->FetchNextHeadId($head_id);

            /*

            $head_row = $this->common_model->SingleRow('accounts_account_heads',array('ah_id' => $head_id));

            $next_id = $head_row->ah_head_id;

            $next_id++;

            $id_check = $this->common_model->SingleRow('accounts_charts_of_accounts',array('ca_account_id' => $next_id));

            while(!empty($id_check))
            {

            $next_id++; 

            $id_check = $this->common_model->SingleRow('accounts_charts_of_accounts',array('ca_account_id' => $next_id));

            }

            */
            
            echo $next_id;

        }
    

    }






    //refresh table with ajax
 
    //account head modal 
    public function Edit()
    {
        
        $cond = array('ca_id' => $this->request->getPost('id'));

         ##Joins if any //Pass Joins as Multi dim array
         $joins = array(
           
            array(
            'table' => 'accounts_account_heads',
            'pk' => 'ah_id',
            'fk' => 'ca_account_type',
            ),

        );

        $data = $this->common_model->SingleRowJoin('accounts_charts_of_accounts',$cond,$joins);

        echo json_encode($data);

    }

   // update account head 
    public function Update()
    {    
        $cond = array('ca_id' => $this->request->getPost('id'));

        $update_data = $this->request->getPost(); 

        // Check if the 'account_id' key exists before unsetting it
        if (array_key_exists('id', $update_data)) 
        {
             unset($update_data['id']);
        }       

        $update_data['ca_modify_date'] = date('Y-m-d'); 

        $this->common_model->EditData($update_data,$cond,'accounts_charts_of_accounts');
        
      

    }

    //delete account head
    public function Delete($coa_id="")


    {
        //Check 
        if($coa_id=="")
        {
        $coa_id = $this->request->getPost('id');
        }

        $receipts = $this->common_model->CountWhere('accounts_receipts',array('r_debit_account' => $coa_id));

        $payments = $this->common_model->CountWhere('accounts_payments',array('pay_credit_account' => $coa_id));

        $return['status'] = 0;

        if($receipts ==0 && $payments==0)

        {

        $cond = array('ca_id' => $this->request->getPost('id'));

        $this->common_model->DeleteData('accounts_charts_of_accounts',$cond);

        $tran_cond = array('tran_account' => $this->request->getPost('id'));

        $this->common_model->DeleteData('master_transactions',$tran_cond);

        $return['status'] = 1;

        }

        else
        {

        $return['status'] = 0;

        }


        echo json_encode($return);

      
    }






    //Common For Select 2 Dropdown

    public function FetchAccounts($where="")
    {

        $page= !empty($_GET['page']) ? $_GET['page'] : 0;
        $term = !empty($_GET['term']) ? $_GET['term'] : "";
        $resultCount = 10;
        $end = ($page - 1) * $resultCount;       
        $start = $end + $resultCount;

        $data['result'] = $this->common_model->FetchWhereArrayLimit('accounts_charts_of_accounts','ca_name','asc',$where,$end,$start);
      
        //$data['result'] = $this->common_model->FetchAllLimit('accounts_charts_of_accounts','ca_name','asc',$term,$start,$end);

        $data['total_count'] = count($data['result']);

        return json_encode($data);

    }









}
