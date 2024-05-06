<?php

namespace App\Controllers\Procurement;

use App\Controllers\BaseController;


class MaterialRequisition extends BaseController
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
       
        $totalRecords = $this->common_model->GetTotalRecords('pro_material_requisition','mr_id','DESC');
 
        ## Total number of records with filtering
       
        $searchColumns = array('mr_reffer_no');

        $totalRecordwithFilter = $this->common_model->GetTotalRecordwithFilter('pro_material_requisition','mr_id',$searchValue,$searchColumns);
    
        ##Joins if any //Pass Joins as Multi dim array
        $joins = array(
           
        );
        ## Fetch records
        $records = $this->common_model->GetRecord('pro_material_requisition','mr_id',$searchValue,$searchColumns,$columnName,$columnSortOrder,$joins,$rowperpage,$start);
    
        $data = array();

        $i=1;
        foreach($records as $record ){
            $action = '<a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->mr_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a><a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->mr_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> Delete</a><a  href="javascript:void(0)" data-id="'.$record->mr_id.'"  class="view view-color view_btn" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a>';
           
           $data[] = array( 
              "mr_id"         => $i,
              'mr_reffer_no'   => $record->mr_reffer_no,
              'mr_date'        => date('d-m-Y',strtotime($record->mr_date)),
               "action"        => $action,
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




    // search droup drown (product description)
    public function FetchProdDes()
    {

        $page= !empty($_GET['page']) ? $_GET['page'] : 0;
        $term = !empty($_GET['term']) ? $_GET['term'] : "";
        $resultCount = 10;
        $end = ($page - 1) * $resultCount;       
        $start = $end + $resultCount;
      
        $data['result'] = $this->common_model->FetchAllLimit('crm_products','product_details','asc',$term,$start,$end);

        $data['total_count'] = count($data['result']);

        return json_encode($data);

    }

    


    //view page
    public function index()
    {   
       
        $data['products'] = $this->common_model->FetchAllOrder('crm_products','product_id','desc');

        $data['employees'] = $this->common_model->FetchAllOrder('employees','employees_id','desc');

        $data['material_requisition'] = $this->common_model->FetchNextId('pro_material_requisition','MR');

        $cond = array('so_deliver_flag' => 0);

        $data['sales_orders'] = $this->common_model->FetchWhere('crm_sales_orders',$cond);
        
        $data['content'] = view('Procurement/material-requisition',$data);

        return view('procurement/pro-module',$data);

    }


    // add account head
    Public function Add()
    {   
        
        $insert_data = [
                
            'mr_reffer_no'     => $this->request->getPost('mr_reffer_no'),

            'mr_date'           => date('Y-m-d',strtotime($this->request->getPost('mr_date'))),

            'mr_time_frame'     => date('Y-m-d',strtotime($this->request->getPost('mr_time_frame'))),

            'mr_assigned_to'    => $this->request->getPost('mr_assigned_to'),

            'mr_added_by'       => 0,

            'mr_added_date'     => date("Y-m-d"),

        ];

        $mr_id = $this->common_model->InsertData('pro_material_requisition',$insert_data);
        
        if(!empty($_POST['mrp_sales_order']))
		{
			$count =  count($_POST['mrp_sales_order']);
					
			if($count!=0)
			{  
				for($j=0;$j<=$count-1;$j++)
				{
                  	
                    $product_data  	= array(  
                        
                        'mrp_sales_order'  =>  $_POST['mrp_sales_order'][$j],
                        'mrp_product_desc' =>  $_POST['mrp_product_desc'][$j],
                        'mrp_unit'         =>  $_POST['mrp_unit'][$j],
                        'mrp_qty'          =>  $_POST['mrp_qty'][$j],
                        'mrp_mr_id'        =>  $mr_id,
    
                    );
                
                    $id = $this->common_model->InsertData('pro_material_requisition_prod',$product_data);
				
				} 
			}
		} 

    }
    

    public function Date()
    {
        $date = $this->request->getPost('Date');

        $your_date = strtotime("1 day", strtotime($date));
     
        $data['increment_date_date'] = date("d-M-Y", $your_date);

        echo json_encode($data);
    }


    public function FetchReference()
    {
    
        $uid = $this->common_model->FetchNextId('pro_material_requisition',"MR");
    
        echo $uid;
    
    }
 


}
