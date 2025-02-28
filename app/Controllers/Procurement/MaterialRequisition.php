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
            $action = ' <a  href="javascript:void(0)" data-id="'.$record->mr_id.'"  class="view view-color view_btn" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-fill"></i></a>
            <a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="Edit"  data-id="'.$record->mr_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i></a>
            <a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->mr_id.'"   data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i></a>
           ';
           
           $data[] = array( 
              "mr_id"         => $i,
              'mr_reffer_no'  => $record->mr_reffer_no,
              'mr_date'       => date('d-M-Y',strtotime($record->mr_date)),
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
    public function FetchProd()
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

        $cond = array('so_deliver_flag' => 0);

        $data['sales_orders'] = $this->common_model->FetchWhere('crm_sales_orders',$cond);
        
        $data['content'] = view('procurement/material-requisition',$data);

        return view('procurement/pro-module',$data);

    }


    // add account head
    public function Add()
    {   

        $uid = $this->FetchReference("r");
        
        $insert_data = [
                
            'mr_reffer_no'     => $uid,

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


   
    
    public function FetchReference($type="e",$year="")
    {   

        if($year=="")
        {
        $year = $this->data['accounting_year'];
        }
        else
        {
        $year = date('Y',strtotime($year));
        }

        $uid = $this->common_model->FetchNextId('pro_material_requisition','mr_reffer_no',"MR-{$year}-",$year);

        if($type=="e")
        echo $uid;
        else
        {
        return $uid;
        }

    }
	


    public function FetchProdDes(){

        $sales_order_details = $this->common_model->FetchAllOrder('crm_products','product_id','desc');

        $data['product'] = "<option value='' selected disabled>Select Product Description</option>";

        foreach($sales_order_details as $sales_order){
             
            $data['product'] .="<option value='".$sales_order->product_id."'>".$sales_order->product_details."</option>";
        }

        echo json_encode($data);
    }


    public function View()
    {
        $join =  array(
                    
            array(
                'table' => 'employees',
                'pk'    => 'employees_id',
                'fk'    => 'mr_assigned_to',
            ),


        );

        $material_requisition = $this->common_model->SingleRowJoin('pro_material_requisition', array('mr_id' => $this->request->getPost('ID')),$join);
        
        $data['reffer_no']       = $material_requisition->mr_reffer_no;

        $data['mr_date']         = date('d-M-Y',strtotime($material_requisition->mr_date));

        $data['mr_time_frame']   = date('d-M-Y',strtotime($material_requisition->mr_time_frame));

        $data['mr_assigned_to']  = $material_requisition->employees_name;


        $joins = array(
            array(
                'table' => 'crm_sales_orders',
                'pk'    => 'so_id',
                'fk'    => 'mrp_sales_order',
            ),
            array(
                'table' => 'crm_products',
                'pk'    => 'product_id',
                'fk'    => 'mrp_product_desc',
            ),

        );


        $material_requisition = $this->common_model->FetchWhereJoin('pro_material_requisition_prod',array('mrp_mr_id' => $this->request->getPost('ID')),$joins);
       
        $i = 1; 

        $data['sales_order'] = "";


        foreach($material_requisition as $mat_req)
        {
            $data['sales_order'] .= '<tr class="" id="'.$mat_req->mrp_id.'">
            <td class="si_no1 text-center" >'.$i.'</td>
            <td class="text-center">'.$mat_req->so_reffer_no.'</td>
            <td style="text-align: left;">'.$mat_req->product_details.'</td>
            <td class="text-center">'.$mat_req->mrp_unit.'</td>
            <td class="text-center">'.$mat_req->mrp_qty.'</td>
            </tr>
            ';
            $i++; 
        }


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
                'table' => 'employees',
                'pk'    => 'employees_id',
                'fk'    => 'mr_assigned_to',
            ),

        );

        $employess = $this->common_model->FetchAllOrder('steel_employees','employees_id','desc');

        $material_requisition = $this->common_model->SingleRowJoin('pro_material_requisition', array('mr_id' => $this->request->getPost('ID')),$join);
        
        $data['reffer_no']               = $material_requisition->mr_reffer_no;

        $data['mr_date']                 = date('d-M-Y',strtotime($material_requisition->mr_date));

        $data['mr_time_frame']           = date('d-M-Y',strtotime($material_requisition->mr_time_frame));

        $data['material_requisition_id'] = $material_requisition->mr_id;

        $data['mr_assigned_to']  = '<option value="" selected disabled>Select Assigned To</option>';

        foreach($employess as $employ)
        {  
            
                $data['mr_assigned_to'] .= '<option value="' .$employ->employees_id.'"'; 

                if($material_requisition->mr_assigned_to == $employ->employees_id)
                {
                    $data['mr_assigned_to'] .= ' selected'; 
                }

                $data['mr_assigned_to'] .= '>' . $employ->employees_name .'</option>';
            

            
        }

        $joins = array(
            array(
                'table' => 'crm_sales_orders',
                'pk'    => 'so_id',
                'fk'    => 'mrp_sales_order',
            ),
            array(
                'table' => 'crm_products',
                'pk'    => 'product_id',
                'fk'    => 'mrp_product_desc',
            ),

        );


        $material_requisition = $this->common_model->FetchWhereJoin('pro_material_requisition_prod',array('mrp_mr_id' => $this->request->getPost('ID')),$joins);
       
        $i = 1; 

        $data['sales_order'] = "";


        foreach($material_requisition as $mat_req)
        {
            $data['sales_order'] .= '<tr class="edit_prod_row" id="'.$mat_req->mrp_id.'">
            <td class="si_no_edit text-center">'.$i.'</td>
            <td class="text-center">'.$mat_req->so_reffer_no.'</td>
            <td style="text-align: left;">'.$mat_req->product_details.'</td>
            <td class="text-center">'.$mat_req->mrp_unit.'</td>
            <td class="text-center">'.$mat_req->mrp_qty.'</td>
            <td class="text-center">
                <a href="javascript:void(0)" class="edit edit-color edit_sales_btn" data-id="'.$mat_req->mrp_id.'" data-toggle="tooltip" data-placement="top" title="edit" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a>
	            <a href="javascript:void(0)" class="delete delete-color delete_sales_btn" data-id="'.$mat_req->mrp_id.'" data-toggle="tooltip" data-placement="top" title="Delete"><i class="ri-delete-bin-fill"></i> Delete</a>
            </td>
            
            </tr>
            ';
            $i++; 
        }

       


        echo json_encode($data);

    }

    public function EditSalesOrder()
    {
       
        $join =  array(
                    
            array(
                'table' => 'crm_sales_orders',
                'pk'    => 'so_id',
                'fk'    => 'mrp_sales_order',
            ),

            array(
                'table' => 'crm_products',
                'pk'    => 'product_id',
                'fk'    => 'mrp_product_desc',
            ),


        );

        $cond = array('so_deliver_flag' => 0);

        $sales_orders = $this->common_model->FetchWhere('crm_sales_orders',$cond);

       

        $material_requisition = $this->common_model->SingleRowJoin('pro_material_requisition_prod', array('mrp_id' => $this->request->getPost('ID')),$join);
        
        $joins = array(
            array(
                'table' => 'crm_products',
                'pk'    => 'product_id',
                'fk'    => 'spd_product_details',
            ),
         
        );

        //$products = $this->common_model->FetchWherejoin('crm_sales_product_details',array('spd_sales_order' => $material_requisition->mrp_sales_order),$joins);

        /*<select class="form-select edit_prod_desc" name="mrp_product_desc" required>';
                            
        foreach($products as $prod){
            $data['sales_order'] .='<option value="'.$prod->product_id .'" '; 
            if($prod->product_id == $material_requisition->mrp_product_desc){ $data['sales_order'] .= "selected"; }
            $data['sales_order'] .='>'.$prod->product_details.'</option>';
        }
    $data['sales_order'] .='</select>*/

    $options_product = '<option value="'.$material_requisition->product_id.'" selected>'.$material_requisition->product_details.'</option>';

        $products = $this->common_model->FetchAllOrder('crm_products','product_id','desc');

        $data['sales_order'] ='<tr class="" id="'.$material_requisition->mrp_id.'">

      
       

         

       <td class="text-center">
        
            <select class="form-select edit_sales_order" name="mrp_sales_order" required>';
                            
                    foreach($sales_orders as $sales){
                        $data['sales_order'] .='<option value="'.$sales->so_id.'" '; 
                        if($sales->so_id == $material_requisition->mrp_sales_order){ $data['sales_order'] .= "selected"; }
                        $data['sales_order'] .='>'.$sales->so_reffer_no.'</option>';
                    }
                $data['sales_order'] .='</select>
        
        </td>
        
        <td class="prod_desc_data" style="text-align: left;">
              <select class="form-select edit_prod_desc product_select2_edit" name="mrp_product_desc" required>'.$options_product.'</select>
            
        </td>

        <td class="text-center"><input type="text" name="mrp_unit"  value="'.$material_requisition->mrp_unit.'" class="form-control edit_contact text-center" required></td>
        <td class="text-center"> <input type="number" name="mrp_qty" value="'.$material_requisition->mrp_qty.'" class="form-control text-center" required></td>
        </tr>
        <input type="hidden" class="contact_cust" name="mrp_id" value="'.$material_requisition->mrp_id.'">
        '; 

        

        echo json_encode($data);
        
    }

    public function UpdateSalesOrder()
    {   
        $cond = array('mrp_id' => $this->request->getPost('mrp_id'));
        
        $update_data = $this->request->getPost();

        // Check if the 'account_id' key exists before unsetting it
        if (array_key_exists('mrp_id', $update_data)) 
        {
            unset($update_data['mrp_id']);
        }    
        
        $this->common_model->EditData($update_data,$cond,'pro_material_requisition_prod');

        $material_req_prod = $this->common_model->SingleRow('pro_material_requisition_prod',array('mrp_id' => $this->request->getPost('mrp_id')));
        
        $data['material_requisition_id'] = $material_req_prod->mrp_mr_id;

        echo json_encode($data);

    }

    public function DeleteSalesOrder()
    {
        $cond = array('mrp_id' => $this->request->getPost('ID'));

        $this->common_model->DeleteData('pro_material_requisition_prod',$cond);
    }

    

    public function InsertSalesOrder()
    {
        $insert_data = $this->request->getPost();

        $id = $this->common_model->InsertData('pro_material_requisition_prod',$insert_data);

        $mat_req_prod = $this->common_model->SingleRow('pro_material_requisition_prod',array('mrp_id' => $id));
        
        $data['mat_req_id'] = $mat_req_prod->mrp_mr_id;

        echo json_encode($data);
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

        
        $cond = array('mr_id' => $this->request->getPost('ID'));

        $purchase_order = $this->common_model->FetchWhere('pro_purchase_order',array('po_mrn_reff' => $this->request->getPost('ID')));
        
        if(empty($purchase_order))
        {
            $this->common_model->DeleteData('pro_material_requisition',$cond);

            $this->common_model->DeleteData('pro_material_requisition_prod',array('mrp_mr_id' => $this->request->getPost('ID')));
            
            $data['status'] = 1;

            $data['msg'] ="Data Deleted Successfully";
        }
        else
        {
            $data['status'] = 0;

            $data['msg'] ="Data In Use. Cannot Delete";
        }

        echo json_encode($data);

       
    }


    public function Update()
    {
        $update_data = [

            'mr_reffer_no'    => $this->request->getPost('mr_reffer_no'),
            
            'mr_date'         => date('Y-m-d',strtotime($this->request->getPost('mr_date'))),

            'mr_time_frame'   => date('Y-m-d',strtotime($this->request->getPost('mr_time_frame'))),

            'mr_assigned_to'  => $this->request->getPost('mr_assigned_to'),

        ];

        $this->common_model->EditData($update_data, array('mr_id' => $this->request->getPost('mr_id')), 'pro_material_requisition');
       
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


    public function Pdf(){

        if(!empty($id))
        {   
            $joins1 = array(
            
                array(
                    'table' => 'crm_products',
                    'pk'    => 'product_id',
                    'fk'    => 'spd_product_details',
                ),
               
                
            );

            $product_details = $this->common_model->FetchWhereJoin('crm_sales_product_details',array('spd_sales_order'=>$id),$joins1);
                
            
            $pdf_data = "";

            foreach($product_details as $prod_det)
            {
                $pdf_data .= '<tr><td align="left">'.$prod_det->product_code.'</td>';

                $pdf_data .= '<td align="left">'.$prod_det->product_details.'</td>';

                $pdf_data .= '<td align="left">'.$prod_det->spd_quantity.'</td>';

                $pdf_data .= '<td align="left">'.$prod_det->spd_unit.'</td>';

                $pdf_data .= '<td align="left">'.$prod_det->spd_rate.'</td>';

                $pdf_data .= '<td align="left" style="color: red";>'.$prod_det->spd_discount.'</td>';

                $pdf_data .= '<td align="left">'.$prod_det->spd_amount.'</td></tr>';
            }

            $join =  array(
                
                array(
                    'table' => 'crm_customer_creation',
                    'pk'    => 'cc_id',
                    'fk'    => 'so_customer',
                ),

                array(
                    'table' => 'crm_quotation_details',
                    'pk'    => 'qd_id',
                    'fk'    => 'so_quotation_ref',
                ),

               
            );
            

            $sales_order = $this->common_model->SingleRowJoin('crm_sales_orders',array('so_id'=>$id),$join);
            
            $date = date('d-M-Y',strtotime($sales_order->so_date));

            $delivery_date = date('d-M-Y',strtotime($sales_order->so_delivery_term));

            $title = 'SO - '.$sales_order->so_reffer_no;

            $mpdf = new \Mpdf\Mpdf();

            $mpdf->SetTitle($title); // Set the title

            $html ='
        
            <style>
            th, td {
                padding-top: 10px;
                padding-bottom: 10px;
                padding-left: 5px;
                padding-right: 5px;
                font-size: 12px;
            }
            p{
                
                font-size: 12px;

            }
            .dec_width
            {
                width:30%
            }
            .disc_color
            {
                color:red;
            }
            
            </style>
        
           
            <table>
        
                <tr>
                    
                    <td style="height:100px;width:100px"><img src="'.base_url().'public/assets/images/logo-sm.png" alt=""></td>
        
                    <td>
                
                    <h3>Al Fuzail Engineering Services WLL</h3>
                    <p>Tel : +974 4460 4254, Fax : 4029 8994, email : engineering@alfuzailgroup.com</p>
                    <p>Post Box : 201978, Gate : 248, Street : 24, Industrial Area, Doha - Qatar</p>
                    
                    
                    </td>
                
                </tr>
        
            </table>
        
        
            <table width="100%" style="margin-top:10px;">
            
        
            <tr width="100%">
            <td>Date : '.$date.'</td>
            <td>Sales Order No : '.$sales_order->so_reffer_no.'</td>
            <td align="right"><h2>Sales Order</h2></td>
        
            </tr>
        
            </table>

        <table  width="100%" style="margin-top:2px;border-top:2px solid;">
    
            <tr>
            
                <td > </td>
                
                <td >'.$sales_order->cc_customer_name.'</td>
            
            </tr>
    
    
        <tr>
        
        <td>Customer</td>
        
            
        <td >Tel : '.$sales_order->cc_telephone.', Fax : '.$sales_order->cc_fax.', Email : '.$sales_order->cc_email.'</td>
        
        </tr>
    
    
        <tr>
        
        <td ></td>
        
        <td >Post Box : -, Doha - '.$sales_order->cc_post_box.'</td>
        
        </tr>
    
    
        <tr>
        
        <td >Attention</td>
        
        <td >Mr. Johnson - Manager, Mobile: -, Email: -</td>
        
        </tr>
    
    
        </table>

           
        
        <table  width="100%" style="margin-top:2px;border-collapse: collapse; border-spacing: 0;border-top:2px solid;">
            
        
            <tr>
            
                <th align="left" style="border-bottom:2px solid;">Item No</th>
            
                <th align="left" style="border-bottom:2px solid;">Description</th>
            
                <th align="left" style="border-bottom:2px solid;">Qty</th>
            
                <th align="left" style="border-bottom:2px solid;">Unit</th>
            
                <th align="left" style="border-bottom:2px solid;">Rate</th>
    
                <th align="left" style="border-bottom:2px solid;">Disc%</th>
    
                <th align="left" style="border-bottom:2px solid;">Amount</th>
    
            
            </tr>


            '.$pdf_data.'

             
            
        </table>';
        
        $footer = '
    
            <table style="border-bottom:2px solid">
            
                <tr>
                    <td>Promised Date</td>

                    <td>'.$delivery_date.'</td>

                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
        
                    <td>Gross Total</td>
        
                    <td>'.$sales_order->so_amount_total.'</td>
            
                </tr>

                <tr>
    
                    <td>Notes</td>
                
                    <td></td>
                    
                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
        
                    <td>Less. Special Discount</td>
        
                    <td>-------</td>
                
                </tr>


                


                <tr>
    
                    <td>Amount in words</td>
                
                    <td>----------------------------------</td>

                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
        
                    <td style="font-weight: bold;">Net Invoice Value</td>
        
                    <td>-----</td>
                
                </tr>

            </table>


            <table>
            
            <tr>
                <td style="width:20%">Order Terms</td>

                <td style="width:20%">LPO Reference</td>

                <td style="width:20%">Verbal</td>

                <td style="width:10%"></td>

                <td style="width:10%">Payment:</td>

                <td style="width:20%">Cash on delivery</td>
                
            </tr>

            <tr>
                <td style="width:20%"></td>

                <td style="width:20%">Quote Reference</td>

                <td style="width:20%">'.$sales_order->qd_reffer_no.'</td>

                <td style="width:10%"></td>

                <td style="width:10%">Delivery</td>

                <td style="width:20%">Ex-works</td>

            </tr>
            
            </table>


            <table style="border-top:2px solid;">

            <tr>
            
               <td>Antony Raphel - Production In-charge</td>
               <td></td><td></td><td></td><td></td><td></td><td></td>
               <td>Justin Jose - Operations Manager</td>
              

            </tr>


            <tr>
            
                <td>Mob : +974 6688 5418, antony@alfuzailgroup.com</td>
                <td></td><td></td><td></td><td></td><td></td><td></td>
                <td>Mob : +974 3381 6185, justin@alfuzailgroup.com</td>
           

            </tr>


            
            
            
            </table>
        
        
        
            ';
        
            
            $mpdf->WriteHTML($html);
            $mpdf->SetFooter($footer);
            $this->response->setHeader('Content-Type', 'application/pdf');
            $mpdf->Output($title . '.pdf', 'I');
        
        }

    }



}
