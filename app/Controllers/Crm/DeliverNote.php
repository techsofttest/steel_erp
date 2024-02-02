<?php

namespace App\Controllers\Crm;

use App\Controllers\BaseController;


class DeliverNote extends BaseController
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
       
        $totalRecords = $this->common_model->GetTotalRecords('crm_delivery_note','dn_id','DESC');
 
        ## Total number of records with filtering
       
        $searchColumns = array('dn_reffer_no');

        $totalRecordwithFilter = $this->common_model->GetTotalRecordwithFilter('crm_delivery_note','dn_id',$searchValue,$searchColumns);
    
        ##Joins if any //Pass Joins as Multi dim array
        $joins = array(
            array(
                'table' => 'crm_customer_creation',
                'pk'    => 'cc_id',
                'fk'    => 'dn_customer',
            ),
           
        );
        ## Fetch records
        $records = $this->common_model->GetRecord('crm_delivery_note','dn_id',$searchValue,$searchColumns,$columnName,$columnSortOrder,$joins,$rowperpage,$start);
    
        $data = array();

        $i=1;
        foreach($records as $record ){
            $action = '<a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->dn_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a><a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->dn_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> Delete</a><a  href="javascript:void(0)" data-id="'.$record->dn_id.'"  class="view view-color view_btn" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a>';
           
           $data[] = array( 
              'dn_id'         => $i,
              'dn_reffer_no'  => $record->dn_reffer_no,
              'dn_date'       => date('d-m-Y',strtotime($record->dn_date)),
              'dn_customer'   => $record->cc_customer_name,
              'action'        => $action,
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


    public function FetchProducts()
    {

        $page= !empty($_GET['page']) ? $_GET['page'] : 0;
        $term = !empty($_GET['term']) ? $_GET['term'] : "";
        $resultCount = 10;
        $end = ($page - 1) * $resultCount;       
        $start = $end + $resultCount;
      
        $data['result'] = $this->common_model->FetchAllLimit('crm_products','product_details','asc',$term,$start,$end);

        $data['total_count'] =count($data['result']);

        return json_encode($data);

    }

    //view page
    public function index()
    {   
        $data['customer_creation'] = $this->common_model->FetchAllOrder('crm_customer_creation','cc_id','desc');

        //$data['sales_executive'] = $this->common_model->FetchAllOrder('executives_sales_executive','se_id','desc');
        
        $data['products'] = $this->common_model->FetchAllOrder('crm_products','product_id','desc');

        $data['employees'] = $this->common_model->FetchAllOrder('employees','employees_id','desc');

        $data['delivery_note_id'] = $this->common_model->FetchNextId('crm_delivery_note','DN');

        $data['content'] = view('crm/delivernote',$data);

        return view('crm/crm-module',$data);

    }



    public function FetchCustomers()
    {

        $page= !empty($_GET['page']) ? $_GET['page'] : 0;
        $term = !empty($_GET['term']) ? $_GET['term'] : "";
        $resultCount = 10;
        $end = ($page - 1) * $resultCount;       
        $start = $end + $resultCount;
      
        $data['result'] = $this->common_model->FetchAllLimit('crm_customer_creation','cc_customer_name','asc',$term,$start,$end);

        $data['total_count'] =count($data['result']);

        return json_encode($data);

    }



    public function FetchOrders()
    {

        $id = $this->request->getPost('id');

        $where['so_customer'] = $id;

        $orders = $this->common_model->FetchWhere('crm_sales_orders',$where);

        $data['orders'] ="";

        $data['orders'] ='<option value="" selected disabled>Select  Contact Person</option>';

        foreach($orders as $order)
        {
            $data['orders'] .='<option value='.$order->so_id.'';
           
            $data['orders'] .='>' .$order->so_order_no. '</option>'; 
        }

        echo json_encode($data);

    }




    // add account head
    Public function Add()
    {   
        

        $insert_data = [

            'dn_reffer_no'        => $this->request->getPost('dn_reffer_no'),

            'dn_date'             => $this->request->getPost('dn_date'),

            'dn_customer'         => $this->request->getPost('dn_customer'),

            'dn_sales_order_num'  => $this->request->getPost('dn_sales_order_num'),

            'dn_lpo_reference'    => $this->request->getPost('dn_lpo_reference'),

            'dn_conact_person'    => $this->request->getPost('dn_conact_person'),

            'dn_payment_terms'    => $this->request->getPost('dn_payment_terms'),

            'dn_project'          => $this->request->getPost('dn_project'),

            'dn_added_by'         => 0,

            'dn_added_date'       => date('Y-m-d'),

        ];

        $delivery_note = $this->common_model->InsertData('crm_delivery_note',$insert_data);


        if(!empty($_POST['dpd_prod_det']))
		{
            $count =  count($_POST['dpd_prod_det']);
                
            if($count!=0)
            {  
                for($j=0;$j<=$count-1;$j++)
                {
                        
                    $insert_data  	= array(  
                        
                        'dpd_prod_det'     =>  $_POST['dpd_prod_det'][$j],
                        'dpd_unit'         =>  $_POST['dpd_unit'][$j],
                        'dpd_order_qty'    =>  $_POST['dpd_order_qty'][$j],
                        'dpd_delivery_qty' =>  $_POST['dpd_delivery_qty'][$j],
                        'dpd_current_qty'  =>  $_POST['dpd_current_qty'][$j],
                        'dpd_delivery_id'  =>  $delivery_note,
                        
                    );

                    $this->common_model->InsertData('crm_delivery_product_details',$insert_data);
                    
                } 
            }

                   
		}



    }



 
    


    public function AddTab3()
    {
        $cond = array('dn_id' => $this->request->getPost('dn_id'));
        $update_data = $this->request->getPost();

        if (array_key_exists('dn_id', $update_data)) {
            unset($update_data['dn_id']);
        }

       
        // Handle file upload
        if (isset($_FILES['dn_signed_delivery_note']) && $_FILES['dn_signed_delivery_note']['name'] !== '') {
            $DeliveryNoteFileName = $this->uploadFile('dn_signed_delivery_note', 'uploads/DeliveryNote');
            $update_data['dn_signed_delivery_note'] = $DeliveryNoteFileName;
        }

        $this->common_model->EditData($update_data, $cond, 'crm_delivery_note');
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
        
        $cond = array('enquiry_id' => $this->request->getPost('ID'));

        $joins = array(
            array(
                'table' => 'executives_sales_executive',
                'pk'    => 'se_id',
                'fk'    => 'enquiry_sales_executive',
            ),
            array(
                'table' => 'crm_customer_creation',
                'pk'    => 'cc_id',
                'fk'    => 'enquiry_customer',
            ),
            array(
                'table' => 'crm_contact_details',
                'pk'    => 'contact_id',
                'fk'    => 'enquiry_contact_person',
            ),
            array(
                'table' => 'employees',
                'pk'    => 'employees_id',
                'fk'    => 'enquiry_employees',
            ),

        );

        $enquiry = $this->common_model->SingleRowJoin('crm_enquiry',$cond,$joins);

        $cond1 = array('pd_customer_details' => $this->request->getPost('ID'));

        $joins1 = array(
            array(
                'table' => 'crm_products',
                'pk'    => 'product_id',
                'fk'    => 'pd_product_detail',
            ),

        );

        $product_details_data = $this->common_model->FetchWhereJoin('crm_product_detail',$cond1,$joins1);
         

        $data['enquiry_enq_number'] = $enquiry->enquiry_enq_number;

        $data['enquiry_date']      = $enquiry->enquiry_date;

        $data['enquiry_validity'] = $enquiry->enquiry_validity;

        $data['enquiry_project'] = $enquiry->enquiry_project;

        $data['enquiry_enq_referance'] = $enquiry->enquiry_enq_referance;

        $data['sales_executive'] = $enquiry->se_name;

        $data['customer_creation'] = $enquiry->cc_customer_name;

        $data['contact_details'] = $enquiry->contact_person;

        $data['enquiry_employees'] = $enquiry->employees_name;


         
        
        $data['prod_details'] ='<table  class="table table-bordered table-striped delTable"><tbody class="travelerinfo"><tr><td >
        Serial No.</td><td>Product Description</td><td>Unit</td><td>Quantity</td></tr>';

        foreach($product_details_data as $prod_det)
        {
            $data['prod_details'] .='<tr>
            <td><input type="text"   value="'.$prod_det->pd_serial_no.'" class="form-control " readonly></td>
            <td><input type="text"   value="'.$prod_det->product_details.'" class="form-control " readonly></td>
            <td><input type="text"   value="'.$prod_det->pd_unit.'" class="form-control " readonly></td>
            <td> <input type="email" value="'.$prod_det->pd_quantity.'" class="form-control " readonly></td>
            </tr>'; 
             
        }
        
        $data['prod_details'] .= '</tbody></table>';

        
        echo json_encode($data);
    }


    public function SalesOrder()
    {
        //$cond = array('so_customer' => $this->request->getPost('ID'));

        //$sales_orders = $this->common_model->FetchWhere('crm_sales_orders',$cond);

        $sales_orders = $this->common_model->FetchSalesInCashInvoice($this->request->getPost('ID'));
        
        //$data['sales_order'] ="";

        $data['sales_order'] ='<option value="" selected disabled>Select Sales Order Number</option>';

        foreach($sales_orders as $sales_order)
        {
            $data['sales_order'] .='<option value='.$sales_order->so_id.'';
           
            $data['sales_order'] .='>' .$sales_order->so_reffer_no. '</option>'; 
        }
        
        
        
        $cond2 = array('contact_customer_creation' => $this->request->getPost('ID'));

        $contact_details = $this->common_model->FetchWhere('crm_contact_details',$cond2);
       
        $data['contact_person'] = "<option value='' selected disabled>Select Contact Person</option>";
       
        foreach($contact_details as $con_det)
        {
            
           $data['contact_person'] .= '<option value='.$con_det->contact_id.'>'.$con_det->contact_person.'</option>';
        }

        
        echo json_encode($data);


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

     //delete account head
     public function Delete()
     {
         $cond = array('dn_id' => $this->request->getPost('ID'));
 
         $this->common_model->DeleteData('crm_delivery_note',$cond);


         $cond1 = array('dpd_delivery_id' => $this->request->getPost('ID'));
 
         $this->common_model->DeleteData('crm_delivery_product_details',$cond1);
 
         
     }





        public function FetchSalesData()
        {
            $cond = array('so_id' => $this->request->getPost('ID'));

            $sales_order = $this->common_model->SingleRow('crm_sales_orders',$cond);

            $cond1 = array('spd_sales_order' => $this->request->getPost('ID'));

            $sales_order_details = $this->common_model->FetchWhere('crm_sales_product_details',$cond1);

            $products = $this->common_model->FetchAllOrder('crm_products','product_id','desc');

            $cond2 = array('contact_customer_creation' => $this->request->getPost('custID'));

            $contact_details = $this->common_model->FetchWhere('crm_contact_details',$cond2);

            
           
            $data['contact_person'] = "";

            foreach($contact_details as $con_det)
            {
                
                $data['contact_person'] .= '<option value=' .$con_det->contact_id;
                if ($con_det->contact_id == $sales_order->so_contact_person)
                {
                    $data['contact_person'] .= ' selected';
                }
                $data['contact_person'] .= '>' . $con_det->contact_person . '</option>';

                
            }


            

            $data['so_lpo'] = $sales_order->so_lpo;

            $data['so_payment_term'] = $sales_order->so_payment_term;

            $data['so_project'] = $sales_order->so_project;

            $data['product_detail'] ='';
            
           
            $i = 1;  
            foreach($sales_order_details as $sales_det){
                $data['product_detail'] .='<tr class="prod_row delivery_note_remove" id="'.$sales_det->spd_id.'">
                                                <td class="si_no">'.$i.'</td>
                                                <td>
                                                    <select class="form-select ser_product_det" name="dpd_prod_det[]" required>';
                                                                
                                                    foreach($products as $prod){
                                                        $data['product_detail'] .='<option value="'.$prod->product_id.'"'; 
                                                        if($prod->product_id == $sales_det->spd_product_details){ $data['product_detail'] .= "selected"; }
                                                        $data['product_detail'] .='>'.$prod->product_details.'</option>';
                                                        }
                                                    $data['product_detail'] .= '</select>
                                                </td>
                                                    <td><input type="text" name="dpd_unit[]" value="'.$sales_det->spd_unit.'" class="form-control" required></td>
                                                    <td><input type="number" name="dpd_order_qty[]" value="'.$sales_det->spd_quantity.'"  class="form-control order_qty" required></td>
                                                    <td><input type="number" name="dpd_delivery_qty[]"  class="form-control delivery_qty" required></td>
                                                    <td><input type="number" name="dpd_current_qty[]"  class="form-control current_delivery" required></td>
                                                    <td class="row_remove remove-btnpp" data-id="'.$sales_det->spd_id.'"><i class="ri-close-line"></i>Remove</td>
                                                    
                                                </tr>';
                                                $i++;
                                                }


                                      
                                          
                                             

            echo json_encode($data);

        }


        //delete contact details
        public function DeleteContact()
        {
            //$cond = array('pp_id' => $this->request->getPost('ID'));
 
           // $this->common_model->DeleteData('crm_proforma_product',$cond);

        }

    

}
