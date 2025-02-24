<?php

namespace App\Controllers\Crm;

use App\Controllers\BaseController;


class ProFormaInvoice extends BaseController
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
       
        $totalRecords = $this->common_model->GetTotalRecords('crm_proforma_invoices','pf_id','DESC');
 
        ## Total number of records with filtering
       
        $searchColumns = array('pf_reffer_no');

        $totalRecordwithFilter = $this->common_model->GetTotalRecordwithFilter('crm_proforma_invoices','pf_id',$searchValue,$searchColumns);
    
        ##Joins if any //Pass Joins as Multi dim array
        $joins = array(
            array(
                'table' => 'crm_customer_creation',
                'pk'    => 'cc_id',
                'fk'    => 'pf_customer',
            ),
            array(
                'table' => 'crm_sales_orders',
                'pk'    => 'so_id',
                'fk'    => 'pf_sales_order',
            ),
        );
        ## Fetch records
        $records = $this->common_model->GetRecord('crm_proforma_invoices','pf_id',$searchValue,$searchColumns,$columnName,$columnSortOrder,$joins,$rowperpage,$start);
    
        $data = array();

        $i=1;
        foreach($records as $record ){
            
            $action = '<a  href="javascript:void(0)" data-id="'.$record->pf_id.'"  class="view view-color view_btn" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-fill"></i></a>
            <a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="Edit"  data-id="'.$record->pf_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i></a>
            <a href="javascript:void(0)" target="_blank" data-id="'.$record->pf_id.'" class="print_color" title="Print"><i class="ri-file-pdf-2-line " aria-hidden="true"></i></a>
            <a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->pf_id.'"   data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i></a>
            
            

            ';
           
            $data[] = array( 
              'pf_id'           => $i,
              'pf_reffer_no'    => $record->pf_reffer_no,
              'pf_date'         => date('d-M-Y',strtotime($record->pf_date)),
              'pf_customer'     => $record->cc_customer_name,
              'pf_sales_order'  => $record->so_reffer_no,
              'action'          => $action,
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
        $data['customer_creation'] = $this->common_model->FetchAllOrder('crm_customer_creation','cc_id','desc');

        $data['sales_executive'] = $this->common_model->FetchAllOrder('executives_sales_executive','se_id','desc');
        
        $data['products'] = $this->common_model->FetchAllOrder('crm_products','product_id','desc');

        $data['employees'] = $this->common_model->FetchAllOrder('employees','employees_id','desc');

        
        $data['contacts'] = $this->common_model->FetchAllOrder('crm_contact_details','contact_id','desc');
        
        $data['content'] = view('crm/pro-forma-invoice',$data);

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



    public function FetchOrders()
    {

        $id = $this->request->getPost('id');

       
        $where['so_customer'] = $id;

        $orders = $this->common_model->FetchWhere('crm_sales_orders',$where);

        $data['orders'] ="";

        $data['orders'] ='<option value="" selected disabled>Select Sales Order</option>';

        foreach($orders as $order)
        {
            $data['orders'] .='<option value='.$order->so_id.'';
           
            $data['orders'] .='>' .$order->so_reffer_no. '</option>'; 
        }

        $cond = array('contact_customer_creation' => $id);

        $contact_details = $this->common_model->FetchWhere('crm_contact_details',$cond);

        $data['contact_person'] ="";

        $data['contact_person'] ='<option value="" selected disabled>Select  Contact Person</option>';
    
        foreach($contact_details as $con_det)
        {
            $data['contact_person'] .='<option value='.$con_det->contact_id.'';
           
            $data['contact_person'] .='>' .$con_det->contact_person. '</option>'; 
        }

        //fetch payment terms

        $cond2 = array('cc_id' => $id);

        $customer = $this->common_model->SingleRow('crm_customer_creation',$cond2);
        
        

        $data['payment_terms'] = $customer->cc_credit_term;


        echo json_encode($data);



    }



    // add account head
    Public function Add()
    {   

        $return['print'] = "";

      

        $uid = $this->FetchReference("r");
        
        $insert_data = [

            'pf_reffer_no'              => $uid,

            'pf_date'                   => date('Y-m-d',strtotime($this->request->getPost('pf_date'))),

            'pf_customer'               => $this->request->getPost('pf_customer'),

            'pf_sales_order'            => $this->request->getPost('pf_sales_order'),

            'pf_lpo_ref'                => $this->request->getPost('pf_lpo_ref'),

            'pf_sales_executive'        => $this->request->getPost('pf_sales_executive'),

            'pf_contact_person'         => $this->request->getPost('pf_contact_person'),

            'pf_payment_terms'          => $this->request->getPost('pf_payment_terms'),

            'pf_delivery_terms'         => $this->request->getPost('pf_delivery_terms'),

            'pf_project'                => $this->request->getPost('pf_project'),

            'pf_total_amount'           => $this->request->getPost('pf_total_amount'),

            'pf_current_cliam'          => $this->request->getPost('pf_current_cliam'),

            'pf_current_claim_value'    => $this->request->getPost('pf_current_claim_value'),

            'pf_total_amount_in_words'  => $this->request->getPost('pf_total_amount_in_words'),

            'pf_added_by'               => 0,

            'pf_added_on'               => date('Y-m-d'),
        ];

        /*if ($_FILES['pf_file']['name'] !== '') 
		{   
           

            $AttachFileName = $this->uploadFile('pf_file','uploads/ProformaInvoice');
            $insert_data['pf_file'] = $AttachFileName;
        }*/

        $sales_order_id = $this->common_model->InsertData('crm_proforma_invoices',$insert_data);


        if(!empty($_POST['pp_product_det']))
        {
            $count =  count($_POST['pp_product_det']);
                
            if($count!=0)
            {  
                for($j=0;$j<=$count-1;$j++)
                {
                        
                    $insert_data  	= array(  
                        
                        'pp_product_det'    =>  $_POST['pp_product_det'][$j],
                        'pp_unit'           =>  $_POST['pp_unit'][$j],
                        'pp_quantity'       =>  $_POST['pp_quantity'][$j],
                        'pp_rate'           =>  $_POST['pp_rate'][$j],
                        'pp_discount'       =>  $_POST['pp_discount'][$j],
                        'pp_amount'         =>  $_POST['pp_amount'][$j],
                        'pp_proforma'       =>  $sales_order_id,
    
                    );

                    $this->common_model->InsertData('crm_proforma_product',$insert_data);

                    if(!empty($_POST['print_btn']))
                    {
                        //$return['print'] =  base_url() . 'Crm/ProFormaInvoice/Pdf/' . urlencode($sales_order_id);

                        $return['print'] =  $sales_order_id;
                    }
                    
                  
            
                } 
            }
      
        }

        echo json_encode($return);

    }

    public function uploadFile($fieldName, $uploadPath)
    {
        $file = $this->request->getFile($fieldName);

        if ($file->isValid() && !$file->hasMoved())
        {
            $newName = $file->getRandomName();
            $file->move($uploadPath, $newName);
            return $newName;
        }

        return null;
	}


    //account head modal 
    public function View()
    {
        
        $cond = array('pf_id' => $this->request->getPost('ID'));

        $joins = array(

            array(
                'table' => 'crm_customer_creation',
                'pk'    => 'cc_id',
                'fk'    => 'pf_customer',
            ),

            array(
                'table' => 'crm_sales_orders',
                'pk'    => 'so_id',
                'fk'    => 'pf_sales_order',
            ),

            array(
                'table' => 'executives_sales_executive',
                'pk'    => 'se_id',
                'fk'    => 'pf_sales_executive',
            ),
           
            array(
                'table' => 'crm_contact_details',
                'pk'    => 'contact_id',
                'fk'    => 'pf_contact_person',
            ),
           

        );

        $proforma = $this->common_model->SingleRowJoin('crm_proforma_invoices',$cond,$joins);

        $cond1 = array('pp_proforma' => $this->request->getPost('ID'));

        $joins1 = array(
            array(
                'table' => 'crm_products',
                'pk'    => 'product_id',
                'fk'    => 'pp_product_det',
            ),

        );

        $product_details_data = $this->common_model->FetchWhereJoin('crm_proforma_product',$cond1,$joins1);
         

        $data['reff_no']              = $proforma->pf_reffer_no;

        $data['date']                 = date('d-M-Y',strtotime($proforma->pf_date));

        $data['customer']             = $proforma->cc_customer_name;

        $data['sales_order']          = $proforma->so_reffer_no;

        $data['lpo_reff']             = $proforma->pf_lpo_ref;

        $data['sales_executive']      = $proforma->se_name;

        $data['contact_person']       = $proforma->contact_person;

        $data['payment_term']         = $proforma->pf_payment_terms;

        $data['delivery_term']        = date('d-M-Y',strtotime($proforma->pf_delivery_terms));

        $data['project']              = $proforma->pf_project;

        $data['total_amount']         = format_currency($proforma->pf_total_amount);

        $data['current_claim']        = format_currency($proforma->pf_current_cliam);

        $data['current_claim_value']  = format_currency($proforma->pf_current_claim_value);


        $data['prod_details'] ="";
      
        $i=1;  
        foreach($product_details_data as $prod_det)
        {
            $data['prod_details'] .='<tr>
            <td class="text-center">'.$i.'</td>
            <td>'.$prod_det->product_details.'</td>
            <td class="text-center">'.$prod_det->pp_unit.'</td>
            <td class="text-center">'.round($prod_det->pp_quantity).'</td>
            <td class="text-end">'.format_currency($prod_det->pp_rate).'</td>
            <td class="text-center">'.format_currency($prod_det->pp_discount).'</td>
            <td class="text-end">'.format_currency($prod_det->pp_amount).'</td>
            </tr>'; 

            $i++;
             
        }
        
        //image section start


        if(!empty($proforma->pf_file)){

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
                                    <td class="cust_img_rgt_border" >'. $proforma->pf_file.'</td>
                                    <td class="cust_img_rgt_border"><a href="'.base_url('uploads/ProformaInvoice/' . $proforma->pf_file).'" target="_blank">View</a></td>
                                </tr>
                            </tbody>
                        </table>';
       
        }
        
        echo json_encode($data);
    }


    public function ContactPerson()
    {
        $cond = array('contact_customer_creation' => $this->request->getPost('ID'));

        $contact_details = $this->common_model->FetchWhere('crm_contact_details',$cond);
        
        $data['customer_name'] ="";

        $data['customer_name'] ='<option value="" selected disabled>Select  Contact Person</option>';

        foreach($contact_details as $con_det)
        {
            $data['customer_name'] .='<option value='.$con_det->contact_id.'';
           
            $data['customer_name'] .='>' .$con_det->contact_person. '</option>'; 
        }

        echo json_encode($data);


    }


    // update account head 
    public function Update()
    {    
        
        $cond = array('pf_id' => $this->request->getPost('pf_id'));

        $proforma = $this->common_model->SingleRow('crm_proforma_invoices',$cond);

        $update_data = $this->request->getPost();


        
        if (array_key_exists('pf_date', $update_data)) 
        {
            unset($update_data['pf_date']);
            
        }   
        
        $update_data['pf_date'] = date('Y-m-d',strtotime($this->request->getPost('pf_date')));

        if (array_key_exists('pf_id', $update_data)) 
        {
            unset($update_data['pf_id']);
            
        }   
        
        // Handle file upload
        if (isset($_FILES['pf_file']) && $_FILES['pf_file']['name'] !== '') 
        {
            
               
            if($this->request->getFile('pf_file') != '' )
            { 
               
                $previousImagePath = 'uploads/ProformaInvoice/' .$proforma->pf_file;
               
                if (!empty($proforma->pf_file)) 
                {
                    unlink($previousImagePath);
                }
            }
            
            // Upload the new image
            $AttachFileName = $this->uploadFile('pf_file', 'uploads/ProformaInvoice');
        
            // Update the data with the new image filename
            $update_data['pf_file'] = $AttachFileName;
        }

        $this->common_model->EditData($update_data,$cond,'crm_proforma_invoices');

       
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

        $cond = array('pf_id' => $this->request->getPost('ID'));
 
        $this->common_model->DeleteData('crm_proforma_invoices',$cond);
            
        $cond1 = array('pp_proforma' => $this->request->getPost('ID'));

        $this->common_model->DeleteData('crm_proforma_product',$cond1);

        $data['status'] =1;

        $data['msg'] ="Data Deleted Successfully";

        echo json_encode($data);
    }




        public function SalesOrder()
        {
            $cond = array('so_id' => $this->request->getPost('ID'));

            $sales_order = $this->common_model->SingleRow('crm_sales_orders',$cond);

            $cond1 =  array('spd_sales_order'=> $sales_order->so_id);

            //$sales_prod_det = $this->common_model->FetchWhere('crm_sales_product_details',$cond1);

            $joins = array(
                array(
                    'table' => 'crm_products',
                    'pk'    => 'product_id',
                    'fk'    => 'spd_product_details',
                ),
                
    
            );

            $sales_prod_det = $this->common_model->FetchWhereJoin('crm_sales_product_details',$cond1,$joins);

            $products = $this->common_model->FetchAllOrder('crm_products','product_id','desc');
            
            
            
            $proforma_invoice = $this->common_model->FetchWhere('crm_proforma_invoices',array('pf_sales_order' => $this->request->getPost('ID')));
            
           

            $data['so_delivery_term'] = $sales_order->so_delivery_term;

            $data['so_project'] = $sales_order->so_project;

            $data['so_lpo'] = $sales_order->so_lpo;
            
            $cond2 = array('contact_customer_creation' => $this->request->getPost('cusID'));

            $contact_details = $this->common_model->FetchWhere('crm_contact_details',$cond2);
           
            $data['contact_person'] = "";

            foreach($contact_details as $con_det)
            {
                
                $data['contact_person'] .= '<option value=' . $con_det->contact_id;
                if ($con_det->contact_person == $sales_order->so_contact_person)
                {
                    $data['contact_person'] .= ' selected';
                }
                $data['contact_person'] .= '>' . $con_det->contact_person . '</option>';

                
            }

            $sales_executive = $this->common_model->FetchAllOrder('executives_sales_executive','se_id','desc');
           
            $data['sales_executive'] = "";

            foreach($sales_executive as $sales_execut)
            {
                $data['sales_executive'] .= '<option value=' . $sales_execut->se_id;
                if ($sales_execut->se_name == $sales_order->so_sales_executive)
                {
                    $data['sales_executive'] .= ' selected';
                }
                $data['sales_executive'] .= '>' . $sales_execut->se_name . '</option>';
            }

            //table section start

            /*<select class="form-select add_prod2" name="pp_product_det['.$j.']" required>';
                                                
            foreach($products as $prod){

                $data['sales_order_contact'] .= '<option value="'.$prod->product_id.'"';
                if($prod->product_id  == $prod_det->spd_product_details){  $data['sales_order_contact'] .= "selected"; }
                $data['sales_order_contact'] .='>'.$prod->product_details.'</option>';
            }  

            $data['sales_order_contact'] .=  '</select>*/

            $i=1;
            $j=0; 
            $data['sales_order_contact'] ='';
        
            foreach($sales_prod_det as $prod_det){

                $options_product = '<option value="'.$prod_det->product_id.'" selected>'.$prod_det->product_details.'</option>';
               

            $data['sales_order_contact'] .= '<tr class="prod_row performa_remove performa_row_lenght" id="'.$prod_det->spd_id.'">
                                            <td class="si_no text-center">'.$i.'</td>
                                            <td><select name="pp_product_det['.$j.']" class="form-control add_prod2">'.$options_product.'</select>
                                            </td>
                                            <td><input type="text"   name="pp_unit['.$j.']" value="'.$prod_det->spd_unit.'" class="form-control unit_clz_id text-center" required></td>
                                            <td><input type="number" name="pp_quantity['.$j.']" value="'.$prod_det->spd_quantity.'" class="form-control qtn_clz_id text-center" required></td>
                                            <td><input type="number" name="pp_rate['.$j.']" value="'.$prod_det->spd_rate.'" class="form-control rate_clz_id text-end" required></td>
                                            <td><input type="number" name="pp_discount['.$j.']" value="'.$prod_det->spd_discount.'" class="form-control discount_clz_id text-center" required></td>
                                            <td><input type="number" name="pp_amount['.$j.']" value="'.$prod_det->spd_amount.'" class="form-control amount_clz_id text-end" readonly></td>
                                            <td class="row_remove remove-btnpp text-center" data-id="'.$prod_det->spd_id .'" style="padding: 10px 10px;"><i class="ri-close-line"></i></td>
                                        </tr>';
                                        $i++;
                                        $j++;
                                    }
          
           

            //###

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
            
            $cond = array('pf_id' => $this->request->getPost('ID'));

            $joins = array(
                array(
                    'table' => 'crm_customer_creation',
                    'pk'    => 'cc_id',
                    'fk'    => 'pf_customer',
                ),
                array(
                    'table' => 'crm_sales_orders',
                    'pk'    => 'so_id',
                    'fk'    => 'pf_sales_order',
                ),
                array(
                    'table' => 'executives_sales_executive',
                    'pk'    => 'se_id',
                    'fk'    => 'pf_sales_executive',
                ),
            
                array(
                    'table' => 'crm_contact_details',
                    'pk'    => 'contact_id',
                    'fk'    => 'pf_contact_person',
                ),
            

            );

            $proforma = $this->common_model->SingleRowJoin('crm_proforma_invoices',$cond,$joins);

           

            $data['reff_no']              = $proforma->pf_reffer_no;

            $data['date']                 = date('d-M-Y',strtotime($proforma->pf_date));

            $data['lpo_reff']             = $proforma->pf_lpo_ref;

            $data['payment_term']         = $proforma->pf_payment_terms;

            $data['delivery_term']        = date('d-M-Y',strtotime($proforma->pf_delivery_terms));

            $data['project']              = $proforma->pf_project;

            $data['total_amount']         = format_currency($proforma->pf_total_amount);

            $data['current_claim']        = format_currency($proforma->pf_current_cliam);

            $data['current_claim_value']  = format_currency($proforma->pf_current_claim_value);

            $data['performa_id']          = $proforma->pf_id;

            

            // customer craetion

            $customer_creation = $this->common_model->FetchAllOrder('crm_customer_creation','cc_id','desc');

            $data['customer'] ="";
            foreach($customer_creation as $cus_creation)
            {
                
                if ($cus_creation->cc_id  == $proforma->pf_customer)
                {
                    $data['customer'] .= '<option value="' .$cus_creation->cc_id.'"'; 
                
                    // Check if the current product head is selected
                
                        $data['customer'] .= ' selected'; 
                    
                
                    $data['customer'] .= '>' . $cus_creation->cc_customer_name .'</option>';

                }

            }

            //sales orders
            
           
            $sales_orders = $this->common_model->FetchWhere('crm_sales_orders',array('so_id'=> $proforma->pf_sales_order));

            $data['sales_order'] ="";
            foreach($sales_orders as $sales_order)
            {
                $data['sales_order'] .= '<option value="' .$sales_order->so_id.'"'; 
            
                // Check if the current product head is selected
                if ($sales_order->so_id   == $proforma->pf_sales_order)
                {
                    $data['sales_order'] .= ' selected'; 
                }
            
                $data['sales_order'] .= '>' . $sales_order->so_reffer_no.'</option>';

            }


            //sales executive

            $sales_executive   = $this->common_model->FetchAllOrder('executives_sales_executive','se_id','desc');

            $data['sales_executive'] ="";
            foreach($sales_executive as $sales_exec)
            {
                $data['sales_executive'] .= '<option value="' .$sales_exec->se_id.'"'; 
            
                // Check if the current product head is selected
                if ($sales_exec->se_id  == $proforma->pf_sales_executive)
                {
                    $data['sales_executive'] .= ' selected'; 
                }
            
                $data['sales_executive'] .= '>' . $sales_exec->se_name.'</option>';
            }

            
            //contact person

            //$contact_data   = $this->common_model->FetchAllOrder('crm_contact_details','contact_id','desc');

            $contact_data = $this->common_model->FetchWhere('crm_contact_details',array('contact_customer_creation'=>$proforma->pf_customer));
      
            $data['contact_person'] ="";

            foreach($contact_data as $cont_data)
            {
                $data['contact_person'] .= '<option value="' .$cont_data->contact_id .'"'; 
            
                // Check if the current product head is selected
                if ($cont_data->contact_id   == $proforma->pf_contact_person)
                {
                    $data['contact_person'] .= ' selected'; 
                }
            
                $data['contact_person'] .= '>' . $cont_data->contact_person.'</option>';
            }

            //product section start

            $cond2 = array('pp_proforma' => $this->request->getPost('ID'));

            $joins1 = array(
                array(
                    'table' => 'crm_products',
                    'pk'    => 'product_id',
                    'fk'    => 'pp_product_det',
                ),
               
    
            );

            $product_details_data = $this->common_model->FetchWhereJoin('crm_proforma_product',$cond2,$joins1);


            $data['prod_details'] ='';

            $i =1; 

            foreach($product_details_data as $prod_det)
            {   
                

                $data['prod_details'] .='<tr class="prod_row2 performa_remove" id="'.$prod_det->pp_id.'">
                <td class="si_no2 text-center">'.$i.'</td>
                <td >'.$prod_det->product_details.'</td>
                <td class="text-center">'.$prod_det->pp_unit.'</td>
                <td class="text-center">'.round($prod_det->pp_quantity).'</td>
                <td class="text-end">'.format_currency($prod_det->pp_rate).'</td>
                <td class="text-center">'.format_currency($prod_det->pp_discount).'</td>
                <td class="text-end">'.format_currency($prod_det->pp_amount).'</td>
                <td class="text-center">
                    <a href="javascript:void(0)" class="edit edit-color edit_prod_btn" data-id="'.$prod_det->pp_id.'" data-toggle="tooltip" data-placement="top" title="edit" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a>
                    <a href="javascript:void(0)" class="delete delete-color delete_prod_btn" data-id="'.$prod_det->pp_id.'" data-toggle="tooltip" data-placement="top" title="Delete"><i class="ri-delete-bin-fill"></i> Delete</a>
                </td>
                </tr>'; 
                $i++; 
            }

            //image section start
            $data['image_table']="";

            if(!empty($proforma->pf_file))
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
                                            <td class="cust_img_rgt_border" >'. $proforma->pf_file.'</td>
                                            <td class="cust_img_rgt_border"><a href="'.base_url('uploads/ProformaInvoice/' . $proforma->pf_file).'" target="_blank">View</a></td>
                                            <td class="cust_img_rgt_border" ><input type="file" name="pf_file"></td>
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
                                                <input type="file" name="pf_file" class="form-control">
                                            </div>
                                        </div>
                ';
            }

            echo json_encode($data);
        }

        public function EditAddProd()
        {
            $insert_data = $this->request->getPost();

            $proforma_prod_id = $this->common_model->InsertData('crm_proforma_product',$insert_data);

            $cond = array('pp_id' => $proforma_prod_id);

            $single_prod = $this->common_model->SingleRow('crm_proforma_product',$cond);

            $cond2 = array('pp_proforma' => $single_prod->pp_proforma);

            $product_details  = $this->common_model->FetchWhere('crm_proforma_product',$cond2);

            $old_amount = 0;

            foreach($product_details as $prod_det)
            {
                $old_amount =  $old_amount + $prod_det->pp_amount;
            }
            
            $cond3 = array('pf_id'=>$single_prod->pp_proforma);
          
            $performa_data = $this->common_model->SingleRow('crm_proforma_invoices',$cond3);

            

            $claim = $performa_data->pf_current_cliam;

            $claim_value = ($claim/100)*$old_amount;

            $claim_value = number_format((float)$claim_value, 2, '.', '');  // Outputs -> 105.00


            $sales_update = array('pf_total_amount' => $old_amount,'pf_current_claim_value' => $claim_value);

            $this->common_model->EditData($sales_update,$cond3,'crm_proforma_invoices');
            
            $data['proforma_id'] = $single_prod->pp_proforma;
            
            echo json_encode($data); 
        }


        public function EditProduct()
        {
            $cond = array('pp_id' => $this->request->getPost('ID'));

            $joins = array(
            
                array(
                    'table' => 'crm_products',
                    'pk'    => 'product_id',
                    'fk'    => 'pp_product_det',
                ),
                
                
            );
    
            $proforma_prod = $this->common_model->SingleRowJoin('crm_proforma_product',$cond,$joins);

            $products = $this->common_model->FetchAllOrder('crm_products','product_id','desc');


            $data['product'] ="";

            /*foreach($products as $prod)
            {
                $data['product'] .= '<option value="' .$prod->product_id. '"'; 
            
                // Check if the current product head is selected
                if ($prod->product_id  == $proforma_prod->pp_product_det)
                {
                    $data['product'] .= ' selected'; 
                }
            
                $data['product'] .= '>' . $prod->product_details . '</option>';
            }*/

            $data['product'] = '<option value="'.$proforma_prod->product_id.'" selected>'.$proforma_prod->product_details.'</option>';



            $data['unit']     = $proforma_prod->pp_unit;

            $data['qty']      = round($proforma_prod->pp_quantity);
    
            $data['rate']     = $proforma_prod->pp_rate;
    
            $data['discount'] = $proforma_prod->pp_discount;

            $data['amount']   = $proforma_prod->pp_amount;
    
            echo json_encode($data);
        }


        public function UpdateProduct()
        {
            $cond = array('pp_id' => $this->request->getPost('pp_id'));

            $update_data = $this->request->getPost();

            if (array_key_exists('pp_id', $update_data)) 
            {
                unset($update_data['pp_id']);
            }  
            
            $this->common_model->EditData($update_data,$cond,'crm_proforma_product');
            
            $single_prod_det = $this->common_model->SingleRow('crm_proforma_product',$cond);

            $cond2 = array('pp_proforma'=>$single_prod_det->pp_proforma);

            $proforma_product = $this->common_model->FetchWhere('crm_proforma_product',$cond2);
            
            $old_amount = 0;

            foreach($proforma_product as $prod_det)
            {
                $old_amount =  $old_amount + $prod_det->pp_amount;
            }

            $cond3 = array('pf_id'=>$single_prod_det->pp_proforma);
          
            $performa_data = $this->common_model->SingleRow('crm_proforma_invoices',$cond3);


            $claim = $performa_data->pf_current_cliam;

            $claim_value = ($claim/100)*$old_amount;

            $claim_value = number_format((float)$claim_value, 2, '.', '');  // Outputs -> 105.00

            $sales_update = array('	pf_total_amount' => $old_amount,'pf_current_claim_value' => $claim_value);

            $this->common_model->EditData($sales_update,$cond3,'crm_proforma_invoices');
            
            $data['proforma_id'] = $single_prod_det->pp_proforma;

            echo json_encode($data); 
        }

        public function DeleteProduct()
        {
            $cond = array('pp_id' => $this->request->getPost('ID'));

            $performa_prod = $this->common_model->SingleRow('crm_proforma_product',$cond);

            $this->common_model->DeleteData('crm_proforma_product',$cond);

            $performa_product_amount = $this->common_model->FetchWhere('crm_proforma_product',array('pp_proforma' => $performa_prod->pp_proforma));
            
            $total_amount = 0;

            foreach($performa_product_amount as $performa_prod_amount)
            {
                $total_amount = $performa_prod_amount->	pp_amount + $total_amount;
            }

            $performa = $this->common_model->SingleRow('crm_proforma_invoices',array('pf_id' => $performa_prod->pp_proforma));

            $current_claim = $performa->pf_current_cliam;

            $current_claim_value = ($current_claim/100)*$total_amount;

            $update_data = array(
                
                'pf_total_amount'        => $total_amount,

                'pf_current_claim_value' => $current_claim_value

            );



            $this->common_model->EditData($update_data,array('pf_id' => $performa_prod->pp_proforma),'crm_proforma_invoices');

            //print_r($real_value); exit();

            //(current_claim/100)*amountTotal


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

            $uid = $this->common_model->FetchNextId('crm_proforma_invoices','pf_reffer_no',"PI-{$year}-",$year);

            if($type=="e")
                echo $uid;
            else
            {
                return $uid;
            }

        }
       
        public function Claim()
        {
            $cond = array('pf_sales_order' => $this->request->getPost('salesOrder'));

            $single_product_det = $this->common_model->FetchWhere('crm_proforma_invoices',$cond);

            if(!empty($single_product_det))
            {   
                $currentClaim = 0;

                foreach($single_product_det as $single_prod_det)
                {
                    $currentClaim  = $currentClaim + $single_prod_det->pf_current_cliam;
                }

                $currentClaim  =  100 - $currentClaim;

                $data['remaining_claim'] = $currentClaim;
            }
            else
            {
                $data['remaining_claim'] = "";
            }

           
            echo json_encode($data); 


        }


        public function EditClaim()
        {
            $cond = array('pf_sales_order' => $this->request->getPost('salesOrder'));

            $single_product_det = $this->common_model->FetchPerformaClaim($cond,'pf_reffer_no',$this->request->getPost('performaReff'));

            
            if(!empty($single_product_det))
            {   
                $currentClaim = 0;

                foreach($single_product_det as $single_prod_det)
                {
                    $currentClaim  = $currentClaim + $single_prod_det->pf_current_cliam;
                }

                $currentClaim  =  100 - $currentClaim;
                
                $data['remaining_claim'] = $currentClaim;
                
            }
            else
            {
                $data['remaining_claim'] = "";
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
                        'fk'    => 'pp_product_det',
                    ),
                   
                );

                $product_details = $this->common_model->FetchWhereJoin('crm_proforma_product',array('pp_proforma'=>$id),$joins1);
                   
                $pdf_data = "";
                 $k =1;
                foreach($product_details as $prod_det)
                {
                    $rate = format_currency($prod_det->pp_rate);

                    $amount = format_currency($prod_det->pp_amount);
    
                    $disc = number_format($prod_det->pp_discount, 2);
    

                    $pdf_data .= '<tr><td align="center">'.$k.'</td>';

                    $pdf_data .= '<td align="left">'.$prod_det->product_details.'</td>';

                    $pdf_data .= '<td align="center">'.$prod_det->pp_quantity.'</td>';

                    $pdf_data .= '<td align="center">'.$prod_det->pp_unit.'</td>';

                    $pdf_data .= '<td align="right">'.$rate.'</td>';

                    $pdf_data .= '<td align="center" style="color: red";><i>'.$disc.'</i></td>';

                    $pdf_data .= '<td align="right">'.$amount.'</td>';
                    
                    $k++;
                }

                $join =  array(
                    array(
                        'table' => 'crm_customer_creation',
                        'pk'    => 'cc_id',
                        'fk'    => 'pf_customer',
                    ),

                    array(
                        'table' => 'crm_sales_orders',
                        'pk'    => 'so_id',
                        'fk'    => 'pf_sales_order',
                    ),

                    array(
                        'table' => 'crm_contact_details',
                        'pk'    => 'contact_id',
                        'fk'    => 'pf_contact_person',
                    ),

                );
                

                $proforma_invoice = $this->common_model->SingleRowJoin('crm_proforma_invoices',array('pf_id'=>$id),$join);

                $date = date('d-M-Y',strtotime($proforma_invoice->pf_date));

                $title = 'PINV - '.$proforma_invoice->pf_reffer_no;

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
            
            
                <table width="100%" style="margin-top:90px;">
                
            
                <tr width="100%">
                <td width="9%"></td>
                <td>Date : '.$date.'</td>
                <td align="center" width="20%">'.$proforma_invoice->pf_reffer_no.'</td>
                <td align="right"><h2>Pro-forma Invoice</h2></td>
            
                </tr>
            
                </table>

            <table  width="100%" style="margin-top:2px;border-top:1px solid;">
        
                <tr>
                
                    <td > </td>
                    
                    <td >'.$proforma_invoice->cc_customer_name.'</td>
                
                </tr>
        
        
            <tr>
            
            <td>Customer</td>
            
                
            <td >Tel : '.$proforma_invoice->cc_telephone.', Fax : '.$proforma_invoice->cc_fax.', Email : '.$proforma_invoice->cc_email.'</td>
            
            </tr>
        
        
            <tr>
            
            <td ></td>
            
            <td >Post Box :  '.$proforma_invoice->cc_post_box.'</td>
            
            </tr>
        
        
            <tr>
            
            <td >Attention</td>
            
            <td >'.$proforma_invoice->contact_person.' - '.$proforma_invoice->contact_designation.', Mobile:-'.$proforma_invoice->contact_mobile.', Email: - '.$proforma_invoice->contact_email.'</td>
            
            </tr>
        
        
            </table>
    
               
            
            <table  width="100%" style="margin-top:2px;border-collapse: collapse; border-spacing: 0;border-top:1px solid;line-height: 18px;">
                
            
                <tr>
                
                    <th align="center" style="border-bottom:1px solid;" width="8%">Item No</th>
                
                    <th align="center" style="border-bottom:1px solid;" width="47%">Description</th>
                
                    <th align="center" style="border-bottom:1px solid;">Qty</th>
                
                    <th align="center" style="border-bottom:1px solid;">Unit</th>
        
                    <th align="center" style="border-bottom:1px solid;" width="10%">Rate</th>

                    <th align="center" style="border-bottom:1px solid;">Disc%</th>

                    <th align="center" style="border-bottom:1px solid;">Amount</th>
        
                 
                
                </tr>


                '.$pdf_data.'
    
                 
                
            </table>';
            
            $footer = '
        
                <table style="width:100%">
                
                    <tr>
                        <td></td>

                        <td>IBAN : QA97CBQA000000004570407137001</td>

                        <td style="width: 19%;">Net Order Value:</td>
            
                        <td>'.format_currency($proforma_invoice->pf_total_amount).'</td>
                    
                       
                
                    </tr>
    
                    <tr>
        
                        <td>Bank Details</td>
                    
                        <td>Commercial Bank of Qatar, Industrial Area Branch, Doha - Qatar</td>

                        <td style="font-weight: bold;">Current Claim- '.$proforma_invoice->pf_current_cliam.'%</td>

                        <td>'.format_currency($proforma_invoice->pf_current_claim_value).'</td>
                        
                       
                        
                    </tr>


                    <tr>
        
                        <td></td>
                    
                        <td>SWIFT : CBQAQAQA</td>

                        
            
                        
                       
                       
                    
                    </tr>
    
    
                    <tr style="width:100%";>
        
                        <td style="width: 15%;">Amount in words</td>
                    
                        <td style="width: 59%;">'.currency_to_words($proforma_invoice->pf_total_amount).'</td>
            
                        
                    
                    </tr>
    
                </table>
    
    
                <table style="border-top:1px solid; border-collapse: collapse; width: 100%;">
                
                <tr>
                    <td style="width:12%">Invoice Terms</td>
    
                    <td style="width:20%">LPO Ref:</td>
    
                    <td style="width:30%">'.$proforma_invoice->pf_lpo_ref.'</td>
    
                    <td style="width:10%">Payment:</td>
    
                    <td style="width:">'.$proforma_invoice->pf_payment_terms.'</td>
                    
                </tr>


                <tr>
                    <td style="width:12%"></td>
    
                    <td style="width:20%">Project:</td>
    
                    <td style="width:30%">'.$proforma_invoice->pf_project.'</td>
    
                    
                    
                </tr>
    
                <tr>
                    <td style="width:12%"></td>
    
                    <td style="width:20%">Sales Order:</td>
    
                    <td style="width:30%">'.$proforma_invoice->so_reffer_no.'</td>
    
                    <td style="width:10%"></td>
    
                    <td style="width:"></td>
    
                </tr>
                
                </table>
    
    
                <table style="border-top:1px solid; border-collapse: collapse; width: 100%;">
    
                <tr>
                
                    <td><i>Received by: </i></td>

                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    
                    <td><i>Prepared by:</i></td>

                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    
                    <td><i>Finance Dept:</i></td>

                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    
                    <td><i>Workshop Manager</i></td>
    
                  
    
                </tr>
    
    
                
                
                
                </table>
            
            
            
                ';
                
                //echo $html . $footer; exit();
                
                $mpdf->WriteHTML($html);
                $mpdf->SetFooter($footer);
                $this->response->setHeader('Content-Type', 'application/pdf');
                $mpdf->Output($title . '.pdf', 'I');
            
            }
    
           
        }



}
