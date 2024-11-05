<?php

namespace App\Controllers\Crm;

use App\Controllers\BaseController;


class Products extends BaseController
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
       
        $totalRecords = $this->common_model->GetTotalRecords('crm_products','product_id ','DESC');
 
        ## Total number of records with filtering
       
        $searchColumns = array('product_code');

        $totalRecordwithFilter = $this->common_model->GetTotalRecordwithFilter('crm_products','product_id',$searchValue,$searchColumns);
    
        ##Joins if any //Pass Joins as Multi dim array
        $joins = array(
            array(
                'table' => 'crm_product_heads',
                'pk' => 'ph_id',
                'fk' => 'product_product_head',
                ),
    
        );
        ## Fetch records
        $records = $this->common_model->GetRecord('crm_products','product_id',$searchValue,$searchColumns,$columnName,$columnSortOrder,$joins,$rowperpage,$start);
    
        $data = array();

        $i=1;
        foreach($records as $record ){
            $action = '<a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->product_id .'" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a><a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->product_id .'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> Delete</a>';
           
           $data[] = array( 
              "product_id"=>$i,
              'product_code' => $record->product_code,
              'product_details' => $record->product_details,
              'product_product_head' => $record->ph_product_head,
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



    public function FetchTypes()
    {

        $page= !empty($_GET['page']) ? $_GET['page'] : 0;
        $term = !empty($_GET['term']) ? $_GET['term'] : "";
        $resultCount = 10;
        $end = ($page - 1) * $resultCount;       
        $start = $end + $resultCount;
      
        $data['result'] = $this->common_model->FetchAllLimit('crm_product_heads','ph_product_head','asc',$term,$start,$end);

        $data['total_count'] =count($data['result']);

        return json_encode($data);

    }

    //view page
    public function index()
    {   
        
        $data['content'] = view('crm/products');

        return view('crm/crm-module',$data);

    }


    // add account head
    Public function Add()
    {   
        
        $insert_data = $this->request->getPost();

        $ph_code = $this->common_model->CheckData('crm_products','product_details',trim($insert_data['product_details']));
        
        if(empty($ph_code))
        {
            $insert_data['product_added_by'] = 0; 

            $insert_data['product_added_date'] = date('Y-m-d'); 

            $id = $this->common_model->InsertData('crm_products',$insert_data);

            $data['status'] = "true";
        }
        else
        {
            $data['status'] = "false";
        }

        echo json_encode($data);

    }


    //account head modal 
    public function Edit()
    {
        
        $cond = array('product_id' => $this->request->getPost('ID'));

        $product_head = $this->common_model->FetchAllOrder('crm_product_heads','ph_id','asc');

        $product = $this->common_model->SingleRow('crm_products',$cond);

        $data['product_code'] = $product->product_code;

        $data['product_name'] = $product->product_details;
        
        $data['prod_head_out'] ="";
        foreach ($product_head as $prod_head) {
            $data['prod_head_out'] .= '<option value="' . $prod_head->ph_id. '"'; 
        
            // Check if the current product head is selected
            if ($prod_head->ph_id == $product->product_product_head){
                $data['prod_head_out'] .= ' selected'; 
            }
        
            $data['prod_head_out'] .= '>' . $prod_head->ph_product_head . '</option>';
        }

        echo json_encode($data);

    }


    // update account head 
    public function Update()
    {   
        $cond = array('product_id' => $this->request->getPost('product_id'));
        
        $update_data = $this->request->getPost(); 

        $product_name = $this->common_model->CheckDataWhere('crm_products','product_details',trim($update_data['product_details']),trim($this->request->getPost('product_id')),'product_id');
       

        // Check if the 'account_id' key exists before unsetting it
        if (array_key_exists('product_id', $update_data)) 
        {
            unset($update_data['product_id']);
        }  
        
        if(empty($product_name))
        {   
            
            $update_data['product_modified_date'] = date('Y-m-d'); 

            $this->common_model->EditData($update_data,$cond,'crm_products');

            $data['status'] ="true";
        }
        else
        {
           $data['status'] = "false";
        }

        echo json_encode($data);
       
    }

    //delete account head
    public function Delete()
    {
        $cond = array('product_id' => $this->request->getPost('ID'));
 
        $this->common_model->DeleteData('crm_products',$cond);
    
    }


    public function Code()
    {
        if(!empty($_POST))
        {
        $cond2 = array('product_product_head' => $this->request->getPost('ID'));

        $product_head = $this->common_model->FetchWhere('crm_products',$cond2);

        if(empty($product_head))
        {   
            $cond = array('ph_id' => $this->request->getPost('ID'));

            $single_product_head = $this->common_model->SingleRow('crm_product_heads',$cond);

            $data['product_head_code'] =  $single_product_head->ph_code.'0001';
 
        }

        else
        {   
            
            $prod_head = $this->common_model->FetchWhereLimit($this->request->getPost('ID'),'product_product_head','product_code','DESC','crm_products',0,1);
           
            $prod_head_data = $prod_head->product_code;
            
            // Extract numeric part
            $numeric_part = preg_replace('/[^0-9]/', '', $prod_head_data);

            // Increment numeric part
            $numeric_part++;

            // Format back into the string
            $data['product_head_code'] = substr($prod_head_data, 0, strlen($prod_head_data) - strlen($numeric_part)) . str_pad($numeric_part, strlen($numeric_part), '0', STR_PAD_LEFT);
          
        }

        echo json_encode($data);
    }

    }


    //edit code
    public function EditCode()
    {  

        $cond3 = array('product_id' => $this->request->getPost('ProdID'));

        $prod_data = $this->common_model->SingleRow('crm_products',$cond3);
        
       

        $cond2 = array('product_product_head' => $this->request->getPost('ID'));

        $product_head = $this->common_model->FetchWhere('crm_products',$cond2);

        if(empty($product_head))
        {
            $cond = array('ph_id' => $this->request->getPost('ID'));

            $single_product_head = $this->common_model->SingleRow('crm_product_heads',$cond);

            $data['product_head_code'] =  $single_product_head->ph_code.'0001';

 
        }

      
        else
        {   
           
            $prod_head = $this->common_model->FetchWhereLimit($this->request->getPost('ID'),'product_product_head','product_code','DESC','crm_products',0,1);
            
            $prod_head_data = $prod_head->product_code;
            
            $prod_check_data = $this->common_model->CheckTwiceCond('crm_products',$cond3,$cond2);
           
              
          
            if(!empty($prod_check_data))
            {
               
                $data['product_head_code'] =  $prod_data->product_code;
                
            }

            else
            {
              
                // Extract numeric part
                $numeric_part = preg_replace('/[^0-9]/', '', $prod_head_data);

                // Increment numeric part
                $numeric_part++;

                // Format back into the string
                $data['product_head_code'] = substr($prod_head_data, 0, strlen($prod_head_data) - strlen($numeric_part)) . str_pad($numeric_part, strlen($numeric_part), '0', STR_PAD_LEFT);
                
            }
           
        }

        echo json_encode($data);

    }





}
