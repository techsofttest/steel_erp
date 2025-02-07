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
       
        $searchColumns = array('dn_reffer_no','cc_customer_name');

         ##Joins if any //Pass Joins as Multi dim array
         $joins = array(
            array(
                'table' => 'crm_customer_creation',
                'pk'    => 'cc_id',
                'fk'    => 'dn_customer',
            ),
           
        );

        $totalRecordwithFilter = $this->common_model->GetTotalRecordwithFilter('crm_delivery_note','dn_id',$searchValue,$searchColumns,'',$joins);
    
       
        ## Fetch records
        $records = $this->common_model->GetRecord('crm_delivery_note','dn_id',$searchValue,$searchColumns,$columnName,$columnSortOrder,$joins,$rowperpage,$start);
    
        $data = array();

        $i=1;
        foreach($records as $record ){
            $action = '
            <a  href="javascript:void(0)" data-id="'.$record->dn_id.'"  class="view view-color view_btn" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-fill"></i></a>
            <a  href="javascript:void(0)" style="display: none;" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="Edit"  data-id="'.$record->dn_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i></a>
            <a href="javascript:void(0)" data-id="'.$record->dn_id.'" target="_blank" class="print_color" title="Print"><i class="ri-file-pdf-2-line " aria-hidden="true"></i></a>
            <a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->dn_id.'"   data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i></a>';
           
           $data[] = array( 
              'dn_id'         => $i,
              'dn_reffer_no'  => $record->dn_reffer_no,
              'dn_date'       => date('d-M-Y',strtotime($record->dn_date)),
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
        $data['print'] = "";
        
        
        if(empty($this->request->getPost('dn_id')))
        {
            
            //$uid = $this->common_model->FetchNextId('crm_delivery_note',"DN");

            $delivery_note_data = $this->common_model->FetchWhere('crm_delivery_note',array('dn_reffer_no' => $this->request->getPost('dn_reffer_no')));

            if(empty($delivery_note_data))
            {

                $insert_data = [

                    'dn_reffer_no'        => $this->request->getPost('dn_reffer_no'),

                    'dn_date'             => date('Y-m-d',strtotime($this->request->getPost('dn_date'))),

                    'dn_customer'         => $this->request->getPost('dn_customer'),

                    'dn_sales_order_num'  => $this->request->getPost('dn_sales_order_num'),

                    'dn_lpo_reference'    => $this->request->getPost('dn_lpo_reference'),

                    'dn_conact_person'    => $this->request->getPost('dn_conact_person'),

                    'dn_payment_terms'    => $this->request->getPost('dn_payment_terms'),

                    'dn_project'          => $this->request->getPost('dn_project'),

                    'dn_added_by'         => 0,

                    'dn_added_date'       => date('Y-m-d'),

                ];
                
            

                if (isset($_FILES['dn_file']) && $_FILES['dn_file']['name'] !== '') {
                    
                    // Upload the new image
                    $attachFileName = $this->uploadFile('dn_file', 'uploads/DeliveryNote');
                
                    // Update the data with the new image filename
                    $insert_data['dn_file'] = $attachFileName;

                    
                }

                $delivery_id = $this->common_model->InsertData('crm_delivery_note',$insert_data);

                $data['status'] = "true" ;

                $delivery = $this->common_model->SingleRow('crm_delivery_note',array('dn_id' => $delivery_id));

                $data['sales_order'] = $delivery->dn_sales_order_num;

                $data['delivery_id'] = $delivery_id;
            }
            else
            {

                $data['status'] = "false";
            } 
        }
        else
        {   
            //$sales_datas = $this->common_model->CheckTwiceCond('crm_delivery_note',array('dn_reffer_no' => $this->request->getPost('dn_reffer_no')),array('dn_id' => $this->request->getPost('dn_id')));
            
            $sales_datas = $this->common_model->CheckDataWhere('crm_delivery_note','dn_reffer_no',trim($this->request->getPost('dn_reffer_no')),trim($this->request->getPost('dn_id')),'dn_id');
           
            if(empty($sales_datas))
            {

                $update_data = [

                    'dn_reffer_no'        => $this->request->getPost('dn_reffer_no'),

                    'dn_date'             => date('Y-m-d',strtotime($this->request->getPost('dn_date'))),

                    'dn_customer'         => $this->request->getPost('dn_customer'),

                    'dn_sales_order_num'  => $this->request->getPost('dn_sales_order_num'),

                    'dn_lpo_reference'    => $this->request->getPost('dn_lpo_reference'),

                    'dn_conact_person'    => $this->request->getPost('dn_conact_person'),

                    'dn_payment_terms'    => $this->request->getPost('dn_payment_terms'),

                    'dn_project'          => $this->request->getPost('dn_project'),

                ];
                
                if (isset($_FILES['dn_file']) && $_FILES['dn_file']['name'] !== '') {
                    
                    // Upload the new image
                    $attachFileName = $this->uploadFile('dn_file', 'uploads/DeliveryNote');
                
                    // Update the data with the new image filename
                    $update_data['dn_file'] = $attachFileName;
                }

            

                $this->common_model->EditData($update_data, array('dn_id' => $this->request->getPost('dn_id')), 'crm_delivery_note');
                
                $delivery_id = $this->request->getPost('dn_id');

                

                $delivery = $this->common_model->SingleRow('crm_delivery_note',array('dn_id' => $delivery_id));

                $data['sales_order'] = $delivery->dn_sales_order_num;

                $data['delivery_id'] = $delivery_id;

                if(!empty($_POST['dpd_prod_det']))
		        {    
                    $count =  count($_POST['dpd_prod_det']);
                
                    if($count!=0)
                    {  
                        for($j=0;$j<=$count-1;$j++)
                        {
                            $delivery_qty = $_POST['dpd_delivery_qty'][$j]; 

                            $current_qty = $_POST['dpd_current_qty'][$j];

                            //$sales_prod_id = $_POST['sales_prod_id'];

                            $new_deli_qty =  $delivery_qty + $current_qty;
                            
                            $insert_data  	= array(  
                                
                                'dpd_prod_det'     =>  $_POST['dpd_prod_det'][$j],
                                'dpd_unit'         =>  $_POST['dpd_unit'][$j],
                                'dpd_order_qty'    =>  $_POST['dpd_order_qty'][$j],
                                'dpd_so_id'        =>  $_POST['sales_prod_id'][$j],
                                'dpd_total_amount' =>  $_POST['product_total'][$j],
                                'dpd_prod_rate'    =>  $_POST['dpd_rate_qty'][$j],
                                'dpd_prod_dicount' =>  $_POST['dicount'][$j],
                                'dpd_sales_ref_id' =>  $_POST['sales_order_id'][$j],
                                'dpd_delivery_qty' =>  $new_deli_qty,
                                'dpd_current_qty'  =>  $current_qty,
                                'dpd_delivery_id'  =>  $delivery_id,
                                
                            );

                        
                            

                            $this->common_model->InsertData('crm_delivery_product_details',$insert_data);

                        

                            $cond = array('spd_id' => $_POST['sales_prod_id'][$j]); 

                            $sales_prod1 = $this->common_model->SingleRow('crm_sales_product_details',$cond);


                            /**/
                        
                            $total_amount_update = array('dn_total_amount' => $_POST['total_prod_amount']);

                            $this->common_model->EditData($total_amount_update,array('dn_id' => $delivery_id),'crm_delivery_note');
                            
                            /**/

                            

                            $delivery_note_qty = $sales_prod1->spd_delivery_note + $current_qty;

                            $update_data =  array('spd_delivered_qty' => $new_deli_qty,'spd_delivery_note' =>$delivery_note_qty);
                            

                            $this->common_model->EditData($update_data,$cond,'crm_sales_product_details');


                            $sales_prod = $this->common_model->SingleRow('crm_sales_product_details',$cond);
                            
                            if($sales_prod->spd_quantity == $sales_prod->spd_delivered_qty)
                            {
                                $cond2 = array('spd_id' => $_POST['sales_prod_id'][$j]);

                                $update_data2 = array('spd_deliver_flag'=>1);

                                $this->common_model->EditData($update_data2,$cond2,'crm_sales_product_details');
                            }
                            
                            $cond3 = array('spd_sales_order'=>$sales_prod->spd_sales_order);

                            $prod_detail = $this->common_model->FetchWhere('crm_sales_product_details',$cond3);

                            $prod_detail_flag = $this->common_model->FetchProdData('crm_sales_product_details',$cond3,array('spd_deliver_flag'=>1));

                            if(count($prod_detail) == count($prod_detail_flag))
                            {
                                $cond4 = array('so_id' => $sales_prod->spd_sales_order);

                                $update_data4 = array('so_deliver_flag'=>1,);

                                $this->common_model->EditData($update_data4,$cond4,'crm_sales_orders');
                            }
                            
                            $update_data5 = array('so_credit_status'=>0,);

                            $this->common_model->EditData($update_data5,array('so_id' => $sales_prod->spd_sales_order),'crm_sales_orders');
                            
                            if(!empty($_POST['print_btn']))
                            {
                            
                               // $data['print'] =  base_url() . 'Crm/DeliverNote/Pdf/' . urlencode($delivery_id);

                               $data['print'] =  $delivery_id;

                            }
                        
                        } 
                    }

                   
		        }

                $data['status'] = "true" ;

            }
            else
            {

                $data['status'] = "false";
            } 


            
            
        }
       
        
        
       
        

        echo json_encode($data);


    }
    

    public function uploadFile($fieldName, $uploadPath)
    {
        $file = $this->request->getFile($fieldName);

        if ($file->isValid() && !$file->hasMoved()){
            $newName = $file->getRandomName();
            $file->move($uploadPath, $newName);
            return $newName;
        }

        return null;
    }


 

    /*public function AddTab3()
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
    }*/



    //account head modal 
    public function View()
    {
        
        $cond = array('dn_id' => $this->request->getPost('ID'));

        $joins = array(
          
            array(
                'table' => 'crm_customer_creation',
                'pk'    => 'cc_id',
                'fk'    => 'dn_customer',
            ),

            array(
                'table' => 'crm_sales_orders',
                'pk'    => 'so_id',
                'fk'    => 'dn_sales_order_num',
            ),
            array(
                'table' => 'crm_contact_details',
                'pk'    => 'contact_id',
                'fk'    => 'dn_conact_person',
            ),

        );

        $delivery_note = $this->common_model->SingleRowJoin('crm_delivery_note',$cond,$joins);

        $data['reffer_no']       = $delivery_note->dn_reffer_no;

        $data['date']            = date('d-M-Y',strtotime($delivery_note->dn_date));

        $data['customer']        = $delivery_note->cc_customer_name;

        $data['sales_order']     = $delivery_note->so_reffer_no;

        $data['lpo_reff']        = $delivery_note->dn_lpo_reference;

        $data['contact_person']  = $delivery_note->contact_person;

        $data['payment_term']   = $delivery_note->dn_payment_terms;

        $data['project']         = $delivery_note->dn_project;

      

       $cond1 = array('dpd_delivery_id' => $delivery_note->dn_id);

        $joins1 = array(
            array(
                'table' => 'crm_products',
                'pk'    => 'product_id',
                'fk'    => 'dpd_prod_det',
            ),

        );


       $product_details = $this->common_model->FetchWhereJoin('crm_delivery_product_details',$cond1,$joins1);

       $products = $this->common_model->FetchAllOrder('crm_products', 'product_id', 'desc');

       //product

       $data['product_detail'] ="";

       $i=1;

       foreach($product_details as $prod_det){
        $data['product_detail'] .='<tr class="prod_row delivery_note_remove" id="'.$prod_det->dpd_id.'">
                                        <td class="si_no text-center">'.$i.'</td>
                                        <td><input type ="" name="" value="'.$prod_det->product_details.'" class="form-control" readonly></td>
                                        <td><input type="text" name="dpd_unit[]" value="'.$prod_det->dpd_unit.'" class="form-control text-center" readonly></td>
                                        <td><input type="number" name="dpd_order_qty[]" value="'.$prod_det->dpd_order_qty.'"  class="form-control text-center" readonly></td>
                                        <td><input type="number" name="dpd_delivery_qty[]" value="'.$prod_det->dpd_current_qty.'"  class="form-control text-center" readonly ></td>
                                        
                                            
                                        </tr>';

                                        $i++;
                                        
                                        }


        //image 

        if(!empty($delivery_note->dn_file)){

            $data['image_table']="";

            $data['image_table'] ='<table id="" class="table table-bordered table-striped delTable display dataTable" style="border: 1px solid #9E9E9E;width: 50%">
                                <thead>
                                    <tr>
                                        <th class="cust_img_rgt_border">File Name</th>
                                        <th class="cust_img_rgt_border">Download</th>
                                    </tr>
                                <thead>
                                <tbody>
                                    <tr>
                                        <td class="cust_img_rgt_border" >'. $delivery_note->dn_file.'</td>
                                        <td class="cust_img_rgt_border"><a href="'.base_url('uploads/DeliveryNote/' . $delivery_note->dn_file).'" target="_blank">View</a></td>
                                    </tr>
                                </tbody>
                            </table>'; 

        }

      
        echo json_encode($data);
    }

   
    public function SalesOrder()
    {
        $cond = array('so_customer' => $this->request->getPost('ID'));

        //$sales_orders = $this->common_model->FetchWhere('crm_sales_orders',$cond);

        //$sales_orders = $this->common_model->FetchSalesInCashInvoice($this->request->getPost('ID'));

        $sales_orders = $this->common_model->FetchSalesOrder('crm_sales_orders',$cond,array('so_deliver_flag'=>0));
        
       // $sales_orders = $this->common_model->FetchSalesOrder($this->request->getPost('ID'));
        

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
        
        //payment terms
        $cond3 = array('cc_id' => $this->request->getPost('ID')); 

        $customer_creation = $this->common_model->SingleRow('crm_customer_creation',$cond3);
        
        $data['payment_term'] = $customer_creation->cc_credit_term;

        echo json_encode($data);


    }


    // update account head 
    public function Update()
    {    
        $cond = array('dn_id' => $this->request->getPost('dn_id'));

        $delivery_note = $this->common_model->SingleRow('crm_delivery_note',$cond);

       
        $sales_datas = $this->common_model->CheckDataWhere('crm_delivery_note','dn_reffer_no',$this->request->getPost('dn_reffer_no'),$this->request->getPost('dn_id'),'dn_id');
        
        if(empty($sales_datas)){

            $update_data = [
                
                'dn_reffer_no'        => $this->request->getPost('dn_reffer_no'),

                'dn_date'             => date('Y-m-d',strtotime($this->request->getPost('dn_date'))),

                'dn_customer'         => $this->request->getPost('dn_customer'),

                'dn_lpo_reference'    => $this->request->getPost('dn_lpo_reference'),

                'dn_conact_person'    => $this->request->getPost('dn_conact_person'),

                'dn_payment_terms'    => $this->request->getPost('dn_payment_terms'),

                'dn_project'          => $this->request->getPost('dn_project'),

            ];



            if (isset($_FILES['dn_file']) && $_FILES['dn_file']['name'] !== '') 
            {
                
                
                if($this->request->getFile('dn_file') != '' )
                { 
                
                    $previousImagePath = 'uploads/DeliveryNote/' .$delivery_note->dn_file;
                
                    if (!empty($delivery_note->dn_file)) 
                    {
                        unlink($previousImagePath);
                    }
                }
                
                // Upload the new image
                $AttachFileName = $this->uploadFile('dn_file', 'uploads/DeliveryNote');
            
                // Update the data with the new image filename
                $update_data['dn_file'] = $AttachFileName;
            }

            $this->common_model->EditData($update_data, array('dn_id' => $this->request->getPost('dn_id')), 'crm_delivery_note');

            $data['status'] = "true";

        }
        else{

            $data['status'] = "false";
        }

        echo json_encode($data);
    }

    //delete account head
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
        
        $cond = array('dn_id' => $this->request->getPost('ID'));

        $delivery_note = $this->common_model->SingleRow('crm_delivery_note',$cond);
         
        $credit_invoice = $this->common_model->FetchWhere('crm_credit_invoice',array('cci_sales_order'=> $delivery_note->dn_sales_order_num	));
        
        $joins = array(
            
            array(
                'table' => 'crm_cash_invoice',
                'pk'    => 'ci_id',
                'fk'    => 'sr_invoice',
            ),

        );

        $sales_return = $this->common_model->FetchWhereJoin('crm_sales_return',array('ci_sales_order'=> $delivery_note->dn_sales_order_num),$joins);
        
       

        if((empty($credit_invoice)) && (empty($sales_return))){

            $update_data = ['so_deliver_flag' => 0];
            
            $this->common_model->EditData($update_data, array('so_id' => $delivery_note->dn_sales_order_num),'crm_sales_orders');
            
            $delivery_id = $delivery_note->dn_id;

            $cond2 = array('dpd_delivery_id' => $delivery_id);

            $joins = array(
                array(
                    'table' => 'crm_sales_product_details',
                    'pk'    => 'spd_id',
                    'fk'    => 'dpd_so_id',
                ),

            );

            $delivery_prod_det = $this->common_model->FetchWhereJoin('crm_delivery_product_details',$cond2,$joins);
            
        
            foreach($delivery_prod_det as $del_prod_det)
            {
                $update_data1 = [

                    'spd_delivered_qty' => $del_prod_det->spd_delivered_qty - $del_prod_det->dpd_current_qty,
        
                    'spd_deliver_flag' => 0,
                ];

                $this->common_model->EditData($update_data1,array('spd_id' => $del_prod_det->dpd_so_id),'crm_sales_product_details');
            }


            $this->common_model->DeleteData('crm_delivery_note',$cond);

            $cond1 = array('dpd_delivery_id' => $this->request->getPost('ID'));
    
            $this->common_model->DeleteData('crm_delivery_product_details',$cond1);

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


        public function FetchSalesData()
        {
            $cond = array('so_id' => $this->request->getPost('ID'));

            $sales_order = $this->common_model->SingleRow('crm_sales_orders',$cond);

            $cond1 = array('spd_sales_order' => $this->request->getPost('ID'));

            $sales_order_details = $this->common_model->FetchProdData('crm_sales_product_details',$cond1,array('spd_deliver_flag'=>0));

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
                                                    <td><input type="number" name="dpd_delivery_qty[]" value="'.$sales_det->spd_delivered_qty.'"  class="form-control delivery_qty" readonly ></td>
                                                    <td><input type="number" name="dpd_current_qty[]"  class="form-control current_delivery" required></td>
                                                    <input type="hidden" name="sales_prod_id[]" value="'.$sales_det->spd_id.'" class="form-control" required>
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


        public function AddProduct()
        {
            $cond1 = array('spd_sales_order' => $this->request->getPost('ID'));
            
            $joins = array(
                array(
                    'table' => 'crm_products',
                    'pk'    => 'product_id',
                    'fk'    => 'spd_product_details',
                ),
    
            );

            $sales_order_details = $this->common_model->FetchProd('crm_sales_product_details',$cond1,array('spd_deliver_flag'=>0),$joins);
            

            $i = 1; 
            
            $data['product_detail'] ="";

            foreach($sales_order_details as $sales_det){

                $data['product_detail'] .='<tr class="prod_row select_prod_remove" id="'.$sales_det->spd_id.'">
                                                <td class="si_no">'.$i.'</td>
                                                <td style="width:40%"><input type="text" name="dpd_prod_det[]" value="'.$sales_det->product_details.'" class="form-control"  readonly></td>
                                                <td><input type="text" name="dpd_unit[]" value="'.$sales_det->spd_unit.'" class="form-control" readonly></td>
                                                <td><input type="number" name="dpd_order_qty[]" value="'.$sales_det->spd_quantity.'"  class="form-control order_qty" readonly></td>
                                                <td><input type="checkbox" name="product_select[]" id="'.$sales_det->spd_id.'"  onclick="handleCheckboxChange(this)" class="prod_checkmark" required></td>
                                                    
                                                    
                                                    
                                            </tr>';
                                                $i++;
            }

            echo json_encode($data);
                      

        }


        /*public function AddSelectedProd()
        {
            for($j=0;$j<count($this->request->getPost('dpd_current_qty'));$j++)
            {

                if(isset($this->request->getPost('product_select')[$j]))

                {

                    $delivery_qty = $_POST['dpd_delivery_qty'][$j]; 

                    $current_qty = $_POST['dpd_current_qty'][$j];
    
                    $new_deli_qty =  $delivery_qty + $current_qty;
                    
                    $insert_data  	= array(  
                        
                        'dpd_prod_det'     =>  $_POST['dpd_prod_det'][$j],
                        'dpd_unit'         =>  $_POST['dpd_unit'][$j],
                        'dpd_order_qty'    =>  $_POST['dpd_order_qty'][$j],
                        'dpd_delivery_qty' =>  $new_deli_qty,
                        'dpd_current_qty'  =>  $current_qty,
                        'dpd_delivery_id'  =>  $_POST['delivery_id'],
                        
                    );
    
                    $this->common_model->InsertData('crm_delivery_product_details',$insert_data);
    
                    $update_data =  array('spd_delivered_qty' => $new_deli_qty);
                    
                    $cond = array('spd_id' => $_POST['sales_prod_id'][$j]); 
    
                    $this->common_model->EditData($update_data,$cond,'crm_sales_product_details');
    
    
                    $sales_prod = $this->common_model->SingleRow('crm_sales_product_details',$cond);
                    
                    
                    
    
                    if($sales_prod->spd_quantity == $sales_prod->spd_delivered_qty)
                    {
                        $cond2 = array('spd_id' => $_POST['sales_prod_id'][$j]);
    
                        $update_data2 = array('spd_deliver_flag'=>1);
    
                        $this->common_model->EditData($update_data2,$cond2,'crm_sales_product_details');
                    }
                    
                    $cond3 = array('spd_sales_order'=>$sales_prod->spd_sales_order);
    
                    $prod_detail = $this->common_model->FetchWhere('crm_sales_product_details',$cond3);
    
                    $prod_detail_flag = $this->common_model->FetchProdData('crm_sales_product_details',$cond3,array('spd_deliver_flag'=>1));
    
                    if(count($prod_detail) == count($prod_detail_flag))
                    {
                        $cond4 = array('so_id' => $sales_prod->spd_sales_order);
    
                        $update_data4 = array('so_deliver_flag'=>1);
    
                        $this->common_model->EditData($update_data4,$cond4,'crm_sales_orders');
                    }

                }

            }
        }*/

       

        public function SelectedProduct()
        {
            // Clean up received ID parameter
            $select_id = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $this->request->getPost('ID'));

            // Split cleaned ID parameter into an array of individual IDs
            $idsArray = explode(',', $select_id);

            $data['product_detail'] = "";

            // Fetch details for each selected product ID
            $i = 1;  
            foreach ($idsArray as $number) 
            {
                $cond = array('spd_id' => $number);

                $joins1 = array(
                    array(
                        'table' => 'crm_products',
                        'pk'    => 'product_id',
                        'fk'    => 'spd_product_details',
                    ),
        
                );

                $sales_order_details = $this->common_model->FetchWhereJoin('crm_sales_product_details', $cond,$joins1);

                $products = $this->common_model->FetchAllOrder('crm_products', 'product_id', 'desc');

                
                foreach($sales_order_details as $sales_det){
                    $data['product_detail'] .='<tr class="prod_row delivery_note_remove" id="'.$sales_det->spd_id.'">
                                                <td class="si_no">'.$i.'</td>
                                                <td style="width:40%"><input type="text" name="" value="'.$sales_det->product_details.'" class="form-control" readonly></td>
                                                <input type="hidden" name="dpd_prod_det[]" value="'.$sales_det->product_id.'">
                                                <td><input type="text" name="dpd_unit[]" value="'.$sales_det->spd_unit.'" class="form-control" readonly></td>
                                                <td><input type="number" name="dpd_order_qty[]" value="'.$sales_det->spd_quantity.'"  class="form-control order_qty" readonly></td>
                                                <td><input type="number" name="dpd_delivery_qty[]" value="'.$sales_det->spd_delivered_qty.'"  class="form-control delivery_qty" readonly ></td>
                                                <td><input type="number" name="dpd_current_qty[]"  class="form-control current_delivery" required></td>
                                                <input type="hidden" name="sales_prod_id[]" value="'.$sales_det->spd_id.'" class="form-control" required>
                                                <input type="hidden" name="dpd_rate_qty[]" value="'.$sales_det->spd_rate.'" class="form-control rate_clz_id" required>
                                                <input type="hidden" name="dicount[]" value="'.$sales_det->spd_discount.'" class="form-control dicount_clz_id" required>
                                                <input type="hidden" name="product_total[]" value="" class="form-control del_product_total" required>
                                                <input type="hidden" name="sales_order_id[]" value="'.$sales_det->spd_sales_order.'" class="form-control" required>
                                                    
                                                        
                                                </tr>
                                                <input type="hidden" name="total_prod_amount" value="" class="total_prod_amount">
                                                    ';
                                                    
                                                    } $i++;

               
            }

            // Output JSON encoded data
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
            
            $cond = array('dn_id' => $this->request->getPost('ID'));

            $delivery_note = $this->common_model->SingleRow('crm_delivery_note',$cond);
         
            $credit_invoice = $this->common_model->FetchWhere('crm_credit_invoice',array('cci_sales_order'=> $delivery_note->dn_sales_order_num	));
        
            $joins5 = array(
                
                array(
                    'table' => 'crm_cash_invoice',
                    'pk'    => 'ci_id',
                    'fk'    => 'sr_invoice',
                ),

            );

            $sales_return = $this->common_model->FetchWhereJoin('crm_sales_return',array('ci_sales_order'=> $delivery_note->dn_sales_order_num),$joins5);
        
            if((empty($credit_invoice)) && (empty($sales_return)))
            {

                $joins = array(
                
                    array(
                        'table' => 'crm_customer_creation',
                        'pk'    => 'cc_id',
                        'fk'    => 'dn_customer',
                    ),

                    array(
                        'table' => 'crm_sales_orders',
                        'pk'    => 'so_id',
                        'fk'    => 'dn_sales_order_num',
                    ),
                    array(
                        'table' => 'crm_contact_details',
                        'pk'    => 'contact_id',
                        'fk'    => 'dn_conact_person',
                    ),

                );

                $delivery_note = $this->common_model->SingleRowJoin('crm_delivery_note',$cond,$joins);

                $data['reffer_no']       = $delivery_note->dn_reffer_no;

                $data['date']            = date('d-M-Y',strtotime($delivery_note->dn_date));

                $data['lpo_reff']        = $delivery_note->dn_lpo_reference;

                $data['sales_order']     = $delivery_note->so_reffer_no;

                $data['sales_order_id']     = $delivery_note->so_id;

                $data['payment_term']    = $delivery_note->dn_payment_terms;

                $data['project']         = $delivery_note->dn_project;

                $data['dn_id']           = $delivery_note->dn_id;


                // customer craetion
                $customer_creation = $this->common_model->FetchAllOrder('crm_customer_creation','cc_id','desc');

                $data['customer'] ="";
                foreach($customer_creation as $cus_creation)
                {
                    if ($cus_creation->cc_id  == $delivery_note->dn_customer)
                    {
                        $data['customer'] .= '<option value="' .$cus_creation->cc_id.'"'; 
                
                        // Check if the current product head is selected
                   
                        $data['customer'] .= ' selected'; 
                    
                        $data['customer'] .= '>' . $cus_creation->cc_customer_name .'</option>';
                    }

                }



                //contact person

                //$contact_data   = $this->common_model->FetchAllOrder('crm_contact_details','contact_id','desc');

                $contact_data = $this->common_model->FetchWhere('crm_contact_details',array('contact_customer_creation'=>$delivery_note->dn_customer));

                $data['contact_person'] ="";

                foreach($contact_data as $cont_data)
                {
                    $data['contact_person'] .= '<option value="' .$cont_data->contact_id .'"'; 
                
                    // Check if the current product head is selected
                    if ($cont_data->contact_id   == $delivery_note->so_contact_person)
                    {
                        $data['contact_person'] .= ' selected'; 
                    }
                
                    $data['contact_person'] .= '>' . $cont_data->contact_person.'</option>';
                }

                $joins1 = array(
                    array(
                        'table' => 'crm_products',
                        'pk'    => 'product_id',
                        'fk'    => 'dpd_prod_det',
                    ),
        
                );

                $delivery_prod_details = $this->common_model->FetchWhereJoin('crm_delivery_product_details', array('dpd_delivery_id' => $this->request->getPost('ID')),$joins1);
                
            // $products = $this->common_model->FetchAllOrder('crm_products', 'product_id', 'desc');

                $i=1;

                $data['product_detail'] ="";
                foreach($delivery_prod_details as $delivery_prod){
                    $data['product_detail'] .='<tr class="prod_row delivery_note_remove delete_delivery_data" id="'.$delivery_prod->dpd_id.'">
                                                    <td class="si_no">'.$i.'</td>
                                                    <td>'.$delivery_prod->product_details.'</td>
                                                    <td>'.$delivery_prod->dpd_unit.'</td>
                                                    <td>'.$delivery_prod->dpd_order_qty.'</td>
                                                    <td>'.$delivery_prod->dpd_current_qty.'</td>
                                                    <td><div class="remainpass del_prod_remove"><i class="ri-close-line"></i>Remove</div></td>                                                 
                                                    <input type="hidden" value="'.$delivery_prod->dpd_id.'"  class="hidden_del_prod_id">  
                                                </tr>';
                                                        $i++;

                                                        }

                /*display add more*/


                    /*$crm_sales_product_details = $this->common_model->SingleRow('crm_delivery_note',array('spd_sales_order'=>$delivery_note->dn_sales_order_num));

                    if(count($crm_sales_product_details) != $delivery_prod_details)
                    {

                    }  */

                    $crm_sales_product_details = $this->common_model->FetchWhere('crm_sales_product_details',array('spd_sales_order'=>$delivery_note->dn_sales_order_num));
                    
                    
                    if(count($crm_sales_product_details)!=count($delivery_prod_details))
                    {
                    $data['add_more'] ="";

                    $data['add_more'] .='<tr>
                                        <td colspan="8" align="center" class="tecs">
                                            <span class="add_icon add_more_product"><i class="ri-add-circle-line"></i>Add </span>
                                        <td>
                                    </tr>';
                    }
                    
                    


                /*****/


                //image section start
                
                $data['image_table']="";

                if(!empty($delivery_note->dn_file))
                {
                
                    $data['image_table'] ='<table id="" class="table table-bordered table-striped delTable display dataTable" style="border: 1px solid #9E9E9E;width: 50%">
                                        <thead>
                                            <tr>
                                                <th class="cust_img_rgt_border">File Name</th>
                                                <th class="cust_img_rgt_border">Download</th>
                                                <th class="cust_img_rgt_border">Update</th>
                                            </tr>
                                        <thead>
                                        <tbody>
                                            <tr>
                                                <td class="cust_img_rgt_border" >'.$delivery_note->dn_file.'</td>
                                                <td class="cust_img_rgt_border"><a href="'.base_url('uploads/DeliveryNote/' .$delivery_note->dn_file).'" target="_blank">View</a></td>
                                                <td class="cust_img_rgt_border" ><input type="file" name="dn_file"></td>
                                            </tr>
                                        </tbody>
                                    </table>';

                }
                else
                {
                    $data['image_table']='<div class="row row_align mb-4">
                                                <div class="col-lg-3">
                                                    <label for="basicInput" class="form-label">Attach</label>
                                                </div>
                                                <div class="col-lg-4">
                                                    <input type="file" name="dn_file" class="form-control">
                                                </div>
                                            </div>
                    ';
                }

                $data['status'] = 1;

            }
            else
            {
                $data['status'] = 0;
            }
            echo json_encode($data);

        }


        /*public function EditSalesOrder()
        {
            $cond = array('so_customer' => $this->request->getPost('ID'));

            $joins = array(
                array(
                    'table' => 'crm_delivery_note',
                    'pk'    => 'dn_customer',
                    'fk'    => 'so_customer',
                ),
            );

            $sales_orders = $this->common_model->TwiceCondWithNot('crm_sales_orders',$cond,array('so_deliver_flag'=>0),$joins,'dn_id',$this->request->getPost('deliveryId'));
        }*/


       


        public function FetchReference($type="e")
        {
    
            $uid = $this->common_model->FetchNextId('crm_delivery_note',"DN-{$this->data['accounting_year']}-");
        
            if($type=="e")
                echo $uid;
            else
            {
                return $uid;
            }
    
        }
        

        public function DeleteProduct()
        {
            $delivery_note = $this->common_model->SingleRow('crm_delivery_product_details',array('dpd_id' => $this->request->getPost('ProdID')));
            
           
            
            $qty = $delivery_note->dpd_current_qty;
           
            $sales_prod_id   = $delivery_note->dpd_so_id;
            
            $sales_prod_data = $this->common_model->SingleRow('crm_sales_product_details',array('spd_id' => $sales_prod_id));
            
            $new_qty = $sales_prod_data->spd_delivered_qty - $qty;


            $update_data = array(

                'spd_delivered_qty' =>$new_qty,

                'spd_deliver_flag' =>0,
            );


            $this->common_model->EditData($update_data,array('spd_id' => $sales_prod_id), 'crm_sales_product_details');
            
            $update['so_deliver_flag'] = 0;

            $this->common_model->EditData($update,array('so_id' => $sales_prod_data->spd_sales_order), 'crm_sales_orders');
            
            $this->common_model->DeleteData('crm_delivery_product_details',array('dpd_id' => $this->request->getPost('ProdID')));
            
            $data['delivery_id'] = $delivery_note->dpd_delivery_id;

            $delivery_prod_data = $this->common_model->FetchWhere('crm_delivery_product_details',array('dpd_delivery_id' => $delivery_note->dpd_delivery_id));
            
            /**/

            //$prod_delivery_id = $this->common_model->FetchWhere('crm_delivery_product_details', array('dpd_delivery_id' => $delivery_note->dpd_delivery_id));
            
            $delivery_total = [];
            
            foreach($delivery_prod_data as $prod_del)
            {
                $delivery_total[] = $prod_del->dpd_total_amount;
                
            }
            $this->common_model->EditData(array('dn_total_amount' => array_sum($delivery_total)),array('dn_id' => $delivery_note->dpd_delivery_id), 'crm_delivery_note');
            
            /**/
           
            $data["add_more"] = "";

                   $data['add_more'] .='<tr>
                                    <td colspan="8" align="center" class="tecs">
                                        <span class="add_icon add_more_product"><i class="ri-add-circle-line"></i>Add </span>
                                    <td>
                                </tr>';

            if(empty($delivery_prod_data))
            {
                $this->common_model->DeleteData('crm_delivery_note',array('dn_id' => $delivery_note->dpd_delivery_id));
                $data['status'] = "True";
            }


            echo json_encode($data);



        }


        public function EditAddProduct()
        {   
            $cond1 = array('spd_sales_order' => $this->request->getPost('orderID'));

            $delivery_product = $this->common_model->FetchWhere('crm_delivery_product_details',array('dpd_delivery_id' => $this->request->getPost('deliveryID')));
            
            $delivery_array = [];
            foreach($delivery_product as $del_prod)
            {
                $delivery_array[] = $del_prod->dpd_so_id;
            }

           
            $delivery_id = $this->request->getPost('deliveryID');

            //array('dpd_id' => $this->request->getPost('prodID'));
            
            $joins = array(
                array(
                    'table' => 'crm_products',
                    'pk'    => 'product_id',
                    'fk'    => 'spd_product_details',
                ),
                
    
            );

            //$sales_order_details = $this->common_model->EditFetchProd('crm_sales_product_details',$cond1,array('spd_deliver_flag'=>0),$joins,$delivery_prod_id->dpd_so_id,'spd_id');
            

            $sales_order_details = $this->common_model->EditFetchProd('crm_sales_product_details',$cond1,array('spd_deliver_flag'=>0),$joins,$delivery_array,'spd_id');
            
            

          

            $i = 1; 
            
            $data['product_detail'] ="";

            foreach($sales_order_details as $sales_det){
                
                $data['product_detail'] .='<tr class="prod_row select_prod_remove edit_select_div" id="'.$sales_det->spd_id.'">
                                                <td class="si_no">'.$i.'</td>
                                                <td><input type="text"  value="'.$sales_det->product_details.'" class="form-control"  readonly></td>
                                                <td><input type="text" name="dpd_unit[]" value="'.$sales_det->spd_unit.'" class="form-control" readonly></td>
                                                <td><input type="number" name="dpd_order_qty[]" value="'.$sales_det->spd_quantity.'"  class="form-control edit_order_qty" readonly></td>
                                                <td><input type="number" name="dpd_delivery_qty[]" value="'.$sales_det->spd_delivered_qty.'"  class="form-control edit_delivery_qty" readonly></td>
                                                <td><input type="number" name="dpd_current_qty[]"  class="form-control edit_current_qty"></td>
                                                
                                                <td><input type="checkbox" name="sales_prod_id['.$sales_det->spd_id.']" value="'.$sales_det->spd_id.'"></td>
                                                
                                                <input type="hidden" name="sales_prod_id2[]" value="'.$sales_det->spd_id.'">
                                                <input type="hidden" name="dpd_prod_det[]" value="'.$sales_det->product_id.'">
                                                <input type="hidden" name="dpd_prod_rate[]" value="'.$sales_det->spd_rate.'" class="edit_prod_rate">
                                                <input type="hidden" name="edit_prod_amount" value="" class="edit_prod_amount">   
                                            </tr>
                                            <input type="hidden" name="delivery_id" value="'.$delivery_id.'">
                                            <input type="hidden" name="edit_total_prod_amount" value="" class="edit_total_prod_amount">
                                           
                                            ';
                                                $i++;
            }

            

            echo json_encode($data);
        }


        public function UpdatedProduct()
        {
            
            if(!empty($_POST['dpd_order_qty']))
		   {    
                $count =  count($_POST['dpd_order_qty']);
               
          
                for($j = 0; $j < $count; $j++) 
                {    
                   

                   if(!empty($_POST['sales_prod_id'][$_POST['sales_prod_id2'][$j]]))
                   {
                   
                        $delivery_qty = $_POST['dpd_delivery_qty'][$j]; 

                        $current_qty = $_POST['dpd_current_qty'][$j];

                        
                        $delivery_qty = intval($delivery_qty);

                        $current_qty = intval($current_qty);

                        
                        $new_deli_qty = $delivery_qty + $current_qty;

                    
                        
                        $insert_data  	= array(  
                            
                            'dpd_prod_det'     =>  $_POST['dpd_prod_det'][$j],
                            'dpd_unit'         =>  $_POST['dpd_unit'][$j],
                            'dpd_order_qty'    =>  $_POST['dpd_order_qty'][$j],
                            'dpd_so_id'        =>  $_POST['sales_prod_id2'][$j],
                            'dpd_total_amount' =>  $_POST['edit_prod_amount'][$j],
                            'dpd_delivery_qty' =>  $new_deli_qty,
                            'dpd_current_qty'  =>  $current_qty,
                            'dpd_delivery_id'  =>  $_POST['delivery_id'],
                           
                            
                        );


                        

                        $this->common_model->InsertData('crm_delivery_product_details',$insert_data);

                        /**/

                        $total_amount_update = array('dn_total_amount' => $_POST['edit_total_prod_amount']);

                        $this->common_model->EditData($total_amount_update,array('dn_id' => $_POST['delivery_id']),'crm_delivery_note');
                      
                        /**/

                      
                        $update_data =  array('spd_delivered_qty' => $new_deli_qty);
                        
                        $cond = array('spd_id' => $_POST['sales_prod_id2'][$j]); 

                        $this->common_model->EditData($update_data,$cond,'crm_sales_product_details');


                        $sales_prod = $this->common_model->SingleRow('crm_sales_product_details',$cond);


                        if($sales_prod->spd_quantity == $sales_prod->spd_delivered_qty)
                        {
                            $cond2 = array('spd_id' => $_POST['sales_prod_id2'][$j]);

                            $update_data2 = array('spd_deliver_flag'=>1);

                            $this->common_model->EditData($update_data2,$cond2,'crm_sales_product_details');
                        }

                        $cond3 = array('spd_sales_order'=>$sales_prod->spd_sales_order);

                        $prod_detail = $this->common_model->FetchWhere('crm_sales_product_details',$cond3);

                        $prod_detail_flag = $this->common_model->FetchProdData('crm_sales_product_details',$cond3,array('spd_deliver_flag'=>1));

                        if(count($prod_detail) == count($prod_detail_flag))
                        {
                            $cond4 = array('so_id' => $sales_prod->spd_sales_order);

                            $update_data4 = array('so_deliver_flag'=>1);

                            $this->common_model->EditData($update_data4,$cond4,'crm_sales_orders');
                        }
                        
                        $delivery_prod_array = [];
                        foreach($prod_detail as $prod_det)
                        {
                            
                            $delivery_prod_array[] = $this->common_model->FetchWhere('crm_delivery_product_details',array('dpd_so_id'=>$prod_det->spd_id));
                        }

                        if(count($prod_detail)!=count($delivery_prod_array))
                        {
                            $data['add_more'] ="";

                            $data['add_more'] .='<tr>
                                                <td colspan="8" align="center" class="tecs">
                                                    <span class="add_icon add_more_product"><i class="ri-add-circle-line"></i>Add </span>
                                                <td>
                                            </tr>';
                        }
                        else
                        {
                            $data['add_more'] ="";

                        }


                        $data['delivery_id'] = $_POST['delivery_id'];

                        

                    }

                  
                } 

                
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
        

        public function Pdf($id)
        {   
            if(!empty($id))
            {   
              
                $joins1 = array(
                
                    array(
                        'table' => 'crm_products',
                        'pk'    => 'product_id',
                        'fk'    => 'dpd_prod_det',
                    ),
                   
                );

                $product_details = $this->common_model->FetchWhereJoin('crm_delivery_product_details',array('dpd_delivery_id'=>$id),$joins1);
                   
                $pdf_data = "";
                 $k=1;
                foreach($product_details as $prod_det)
                {
                    $pdf_data .= '<tr><td align="center">'.$k.'</td>';

                    $pdf_data .= '<td align="left">'.$prod_det->product_details.'</td>';

                    $pdf_data .= '<td align="center">'.$prod_det->dpd_unit.'</td>';

                    $pdf_data .= '<td align="center">'.$prod_det->dpd_order_qty.'</td>';

                    $pdf_data .= '<td align="center">'.$prod_det->dpd_current_qty.'</td>';

                    $k++;

                }

                $join =  array(
                    array(
                        'table' => 'crm_customer_creation',
                        'pk'    => 'cc_id',
                        'fk'    => 'dn_customer',
                    ),

                    array(
                        'table' => 'crm_sales_orders',
                        'pk'    => 'so_id',
                        'fk'    => 'dn_sales_order_num',
                    ),

                    array(
                        'table' => 'crm_contact_details',
                        'pk'    => 'contact_id',
                        'fk'    => 'dn_conact_person',
                    ),
    
                );
                

                $delivery_note = $this->common_model->SingleRowJoin('crm_delivery_note',array('dn_id'=>$id),$join);

                $date = date('d-M-Y',strtotime($delivery_note->dn_date));

                $title = 'DN-'.$delivery_note->dn_reffer_no;
                
                //$mpdf = new \Mpdf\Mpdf();

                $mpdf = new \Mpdf\Mpdf([
                    'margin_top' => 5,     // Reduce top margin
                    'margin_bottom' => 5,  // Reduce bottom margin
                    'margin_left' => 5,    // Reduce left margin
                    'margin_right' => 5,   // Reduce right margin
                ]);
                

                $mpdf->SetTitle($title); // Set the title
    
                $html ='
            
                <style>
            th, td {
                padding-top: 5px;
               
                padding-left: 5px;
                padding-right: 5px;
                font-size: 12px;
            }
            p{
                
                font-size: 12px;
                margin-bottom: 13px;

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
            
               
                <table><tr><td></td></tr></table>

                <table><tr><td></td></tr></table>

                <table><tr><td></td></tr></table>
               
                <table><tr><td></td></tr></table>
            
            
                <table width="100%" style="margin-top:100px;">
                
            
                <tr width="100%">
                <td width="10%"></td>
                <td width="20%">Date : '.$date.'</td>
                <td align="center">'.$delivery_note->dn_reffer_no.'</td>
                <td align="right"><h2>Delivery Note</h2></td>
            
                </tr>
            
                </table>

            <table  width="100%" style="margin-top:2px;border-top:1px solid;">
        
                <tr>
                
                    <td > </td>
                    
                    <td >'.$delivery_note->cc_customer_name.'</td>
                
                </tr>
        
        
            <tr>
            
            <td>Customer</td>
            
                
            <td >Tel : '.$delivery_note->cc_telephone.', Fax : '.$delivery_note->cc_fax.', Email : '.$delivery_note->cc_email.'</td>
            
            </tr>
        
        
            <tr>
            
            <td ></td>
            
            <td >Post Box : -, Doha - '.$delivery_note->cc_post_box.'</td>
            
            </tr>
        
        
            <tr>
            
            <td >Attention</td>
            
           <td >'.$delivery_note->contact_person.' - '.$delivery_note->contact_designation.', Mobile:-'.$delivery_note->contact_mobile.', Email: - '.$delivery_note->contact_email.'</td>
            
            </tr>
        
        
            </table>
    
               
            
            <table  width="100%" style="margin-top:2px;border-collapse: collapse; border-spacing: 0;border-top:1px solid;">
                
            
                <tr>
                
                    <th align="center" style="border-bottom:1px solid;">Item No</th>
                
                    <th align="center" style="border-bottom:1px solid;" width="60%">Description</th>
                
                    <th align="center" style="border-bottom:1px solid;">Unit</th>
                
                    <th align="center" style="border-bottom:1px solid;">Qty Ordered</th>
        
                    <th align="center" style="border-bottom:1px solid;">Delivery</th>
        
                 
                
                </tr>


                '.$pdf_data.'
    
                 
                
            </table>';
            
            $footer = '
        
                
    
    
                <table>
                
                <tr>
                    <td >Order Terms</td>
    
                    <td style="width:15%">LPO Ref:</td>
    
                    <td style="width:30%">'.$delivery_note->dn_lpo_reference.'</td>

                    <td style="width:12%">Payment:</td>
    
                    <td >'.$delivery_note->dn_payment_terms.'</td>
                    
                </tr>
    
                <tr>
                    <td ></td>
    
                    <td style="width:15%">Project:</td>
    
                    <td style="width:30%">'.$delivery_note->dn_project.'</td>

                    <td style="width:12%">Sales Order:</td>
    
                    <td >'.$delivery_note->so_reffer_no.'</td>
    
                </tr>
                
                </table>
    
    
                <table style="border-top:1px solid; border-collapse: collapse; width: 100%;">
    
                <tr>
                
                    <td><i>Received by: </i></td>

                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    
                   

                   
    
                    <td>Driver:</td>

                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    
    
                    <td><i>Store Keeper</i></td>
    
                  
    
                </tr>
    
    
                
                
                
                </table>
            
            
            
                ';
            
                //echo $html . $footer;

                $mpdf->WriteHTML($html);
                $mpdf->SetFooter($footer);
                $this->response->setHeader('Content-Type', 'application/pdf');
                $mpdf->Output($title . '.pdf', 'I');
            
            }
    
           
        }

        


}
