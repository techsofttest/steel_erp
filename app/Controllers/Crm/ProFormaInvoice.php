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
            
            $action = '<a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->pf_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a><a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->pf_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> Delete</a><a  href="javascript:void(0)" data-id="'.$record->pf_id.'"  class="view view-color view_btn" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a><a href="'.base_url().'CRM/ProFormaInvoice/Print/'.$record->pf_id.'" target="_blank" class="print_color"><i class="ri-file-pdf-2-line " aria-hidden="true"></i>Print</a>';
           
           $data[] = array( 
              'pf_id'           => $i,
              'pf_reffer_no'    => $record->pf_reffer_no,
              'pf_date'         => date('d-m-Y',strtotime($record->pf_date)),
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

        $data['performa_invoice_id'] = $this->common_model->FetchNextId('crm_proforma_invoices','PINV');

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
        $insert_data = [

            'pf_reffer_no'              => $this->request->getPost('pf_reffer_no'),

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

        if ($_FILES['pf_file']['name'] !== '') 
		{   
           

            $AttachFileName = $this->uploadFile('pf_file','uploads/ProformaInvoice');
            $insert_data['pf_file'] = $AttachFileName;
        }

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
                    
                    
            
                } 
            }

                
        }

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

        $data['total_amount']         = $proforma->pf_total_amount;

        $data['current_claim']        = $proforma->pf_current_cliam;

        $data['current_claim_value']  = $proforma->pf_current_claim_value;


        $data['prod_details'] ="";
      
        $i=1;  
        foreach($product_details_data as $prod_det)
        {
            $data['prod_details'] .='<tr>
            <td>'.$i.'</td>
            <td><input type="text"  value="'.$prod_det->product_details.'" class="form-control " readonly></td>
            <td><input type="text"  value="'.$prod_det->pp_unit.'" class="form-control " readonly></td>
            <td> <input type="text" value="'.$prod_det->pp_quantity.'" class="form-control " readonly></td>
            <td> <input type="text" value="'.$prod_det->pp_rate.'" class="form-control " readonly></td>
            <td> <input type="text" value="'.$prod_det->pp_discount.'" class="form-control " readonly></td>
            <td> <input type="text" value="'.$prod_det->pp_amount.'" class="form-control " readonly></td>
            </tr>'; 
             
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
               
                if (file_exists($previousImagePath)) 
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
        $cond = array('pf_id' => $this->request->getPost('ID'));
 
        $this->common_model->DeleteData('crm_proforma_invoices',$cond);
        
        $cond1 = array('pp_proforma' => $this->request->getPost('ID'));
 
        $this->common_model->DeleteData('crm_proforma_product',$cond1);
  
     }




        public function SalesOrder()
        {
            $cond = array('so_id' => $this->request->getPost('ID'));

            $sales_order = $this->common_model->SingleRow('crm_sales_orders',$cond);

            $cond1 =  array('spd_sales_order'=> $sales_order->so_id);

            $sales_prod_det = $this->common_model->FetchWhere('crm_sales_product_details',$cond1);

            $products = $this->common_model->FetchAllOrder('crm_products','product_id','desc');


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

            $i=1;

            $data['sales_order_contact'] ='';
        
            foreach($sales_prod_det as $prod_det){

            $data['sales_order_contact'] .= '<tr class="prod_row performa_remove" id="'.$prod_det->spd_id.'">
                                            <td class="si_no">'.$i.'</td>
                                            <td style="width:20%">
                                                <select class="form-select" name="pp_product_det[]" required>';
                                                
                                                foreach($products as $prod){

                                                    $data['sales_order_contact'] .= '<option value="'.$prod->product_id.'"';
                                                    if($prod->product_id  == $prod_det->spd_product_details){  $data['sales_order_contact'] .= "selected"; }
                                                    $data['sales_order_contact'] .='>'.$prod->product_details.'</option>';
                                                }  

                   $data['sales_order_contact'] .=  '</select>
                                            </td>
                                            <td><input type="text"   name="pp_unit[]" value="'.$prod_det->spd_unit.'" class="form-control" required></td>
                                            <td><input type="number" name="pp_quantity[]" value="'.$prod_det->spd_quantity.'" class="form-control qtn_clz_id" required></td>
                                            <td><input type="number" name="pp_rate[]" value="'.$prod_det->spd_rate.'" class="form-control rate_clz_id" required></td>
                                            <td><input type="number" name="pp_discount[]" value="'.$prod_det->spd_discount.'" class="form-control discount_clz_id" required></td>
                                            <td><input type="number" name="pp_amount[]" value="'.$prod_det->spd_amount.'" class="form-control amount_clz_id" required></td>
                                            <td class="row_remove remove-btnpp" data-id="'.$prod_det->spd_id .'"><i class="ri-close-line"></i>Remove</td>
                                        </tr>';
                                        $i++;
                                    }
          
           

            //###

            echo json_encode($data);

        }


        public function Edit()
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

           

            $data['reff_no']              = $proforma->pf_reffer_no;

            $data['date']                 = date('d-M-Y',strtotime($proforma->pf_date));

            $data['lpo_reff']             = $proforma->pf_lpo_ref;

            $data['payment_term']         = $proforma->pf_payment_terms;

            $data['delivery_term']        = date('d-M-Y',strtotime($proforma->pf_delivery_terms));

            $data['project']              = $proforma->pf_project;

            $data['total_amount']         = $proforma->pf_total_amount;

            $data['current_claim']        = $proforma->pf_current_cliam;

            $data['current_claim_value']  = $proforma->pf_current_claim_value;

            $data['performa_id']          = $proforma->pf_id;

            

            // customer craetion

            $customer_creation = $this->common_model->FetchAllOrder('crm_customer_creation','cc_id','desc');

            $data['customer'] ="";
            foreach($customer_creation as $cus_creation)
            {
                $data['customer'] .= '<option value="' .$cus_creation->cc_id.'"'; 
            
                // Check if the current product head is selected
                if ($cus_creation->cc_id  == $proforma->pf_customer)
                {
                    $data['customer'] .= ' selected'; 
                }
            
                $data['customer'] .= '>' . $cus_creation->cc_customer_name .'</option>';

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

            $contact_data   = $this->common_model->FetchAllOrder('crm_contact_details','contact_id','desc');

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
                <td class="si_no2">'.$i.'</td>
                <td style="width:20%"><input type="text"   value="'.$prod_det->product_details.'" class="form-control " readonly></td></td>
                <td><input type="text"  value="'.$prod_det->pp_unit.'" class="form-control" readonly></td>
                <td> <input type="text" value="'.$prod_det->pp_quantity.'" class="form-control"  readonly></td>
                <td> <input type="text" value="'.$prod_det->pp_rate.'"  class="form-control" readonly></td>
                <td> <input type="text" value="'.$prod_det->pp_discount.'" class="form-control" readonly></td>
                <td> <input type="text" value="'.$prod_det->pp_amount.'" class="form-control edit_total_amount" readonly></td>
                <td style="width: 13%;">
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

            foreach($products as $prod)
            {
                $data['product'] .= '<option value="' .$prod->product_id. '"'; 
            
                // Check if the current product head is selected
                if ($prod->product_id  == $proforma_prod->pp_product_det)
                {
                    $data['product'] .= ' selected'; 
                }
            
                $data['product'] .= '>' . $prod->product_details . '</option>';
            }

            $data['unit']     = $proforma_prod->pp_unit;

            $data['qty']      = $proforma_prod->pp_quantity;
    
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

            $this->common_model->DeleteData('crm_proforma_product',$cond);
        }


        public function FetchReference()
        {
    
            $uid = $this->common_model->FetchNextId('crm_proforma_invoices',"PINV");
        
            echo $uid;
    
        }
       



        public function Print($id){

            $cond = array('pf_id' => $id);

            $joins = array(
                
                array(
                    'table' => 'crm_customer_creation',
                    'pk'    => 'cc_id',
                    'fk'    => 'pf_customer',
                )
    
            );
             
            $proforma = $this->common_model->SingleRowJoin('crm_proforma_invoices',$cond,$joins);

            $cond1 = array('pp_proforma' => $proforma->pf_id);

            $joins1 = array(
                
                
    
            );

          

            $product_detail ="";

            $proforma_products = $this->common_model->FetchWhereJoin('crm_proforma_product',$cond1,$joins1);
            
            $i =1;
            foreach($proforma_products as $proforma_prod)
            {
               
                $product_detail .= '<tr>
        
                <td>'.$proforma->pf_uid.'</td>
            
                <td>'.$proforma_prod->pp_product_det.'</td>
            
                <td>'.$proforma_prod->pp_quantity.'</td>
            
                <td>'.$proforma_prod->pp_unit.'</td>
            
                <td>'.$proforma_prod->pp_rate.'</td>
            
                <td class="disc_color">'.$proforma_prod->pp_discount.'</td>
    
                <td>'.$proforma_prod->pp_amount.'</td>
                
                </tr>';

                $i++;
            }



            $mpdf = new \Mpdf\Mpdf();
        
            $html ='
        
            <style>
            th, td {
                padding-top: 10px;
                padding-bottom: 10px;
                padding-left: 5px;
                padding-right: 5px;
                font-size:12px;
              }
            .disc_color
            {
                color:red;
            }
            </style>
        
            <table>
            
            <tr>
            
            <td>
        
            
            </td>
            
            </tr>
        
            </table>
        
        
        
            <table width="100%" style="margin-top:10px;">
            
        
            <tr width="100%">

            <td align="left">Date:'.$proforma->pf_date.'</td>

            <td align="right">Invoice No:'.$proforma->pf_uid.'</td>
            
            <td align="right"><h3>Pro-forma Invoice</h3></td>
        
            </tr>
        
            </table>
        
        
            <table  width="100%" style="margin-top:2px;border-top:3px solid;border-bottom:3px solid;">
        
            <tr>
            
                <td></td>
                
                <td>'.$proforma->cc_customer_name.'</td>
            
            </tr>


            <tr>
                 
                <td>Customer</td>

                <td>Tel : '.$proforma->cc_telephone.', Fax : '.$proforma->cc_fax.', Email : '.$proforma->cc_email.' <br> Post Box : -, '.$proforma->cc_post_box.'</td>
            
            </tr>


            <tr>
            
                <td>Attention</td>

                <td>Mr. Johnson - Manager, Mobile: -, Email: -</td>
            
            </tr>

            
            </table>
        
        
        
        
            <table  width="100%" style="margin-top:2px;">
            
        
            <tr  style="border-bottom:3px solid;">
            
            <th align="left">Item No.</th>
        
            <th align="left">Description</th>
        
            <th align="left">Qty</th>
        
            <th align="left">Unit</th>
        
            <th align="left">Rate</th>
        
            <th align="left">Disc %</th>

            <th align="left">Amount</th>
        
            </tr>
        
        
        
            '.$product_detail.'
        
        
            
            </table>
        
            ';
        
            $footer = '
        
            <table style="border-collapse: collapse; border-spacing: 0;" width="100%">
            
            <tr>

            <td></td>
            
            <td>IBAN : QA97CBQA000000004570407137001</td>
        
            <td>Gross Total</td>

            <td>2,445.00</td>
        
            </tr>


            <tr>
            
               <td>Bank Details</td>

               <td>Commercial Bank of Qatar, Industrial Area Branch, Doha - Qatar<br>SWIFT : CBQAQAQA</td>

               <td>Less. Special Discount<br>Net Order Value </td>

               <td>122.25<br>2,322.75</td>

            </tr>


            <tr>
            
                <td >Amount in <br> words</td>

                <td >Qatar Riyals One thousand one hundred sixty one & thirty eight Dirhams only</td>

                <td >Current Claim - 50%</td>

                <td >1,161.38</td>
            
            </tr>


            <tr>
            
                <td style="border-top:1px solid;"></td>

                <td style="border-top:1px solid;">LPO Ref.</td>

                <td style="border-top:1px solid;">Waiting for PO </td>

                <td style="border-top:1px solid;">Payment:</td>

                <td style="border-top:1px solid;">Cash on delivery</td>
                
            
            </tr>


            <tr>
            
                <td>Invoice Terms</td>

                <td>Project:</td>

                <td></td>

                <td>Delivery:</td>

                <td>Ex- Factory</td>
            
            </tr>


            <tr>
            
                <td style="border-bottom:1px solid;"></td>

                <td style="border-bottom:1px solid;">Sales Order:</td>

                <td style="border-bottom:1px solid;">03455</td>

                <td style="border-bottom:1px solid;"></td>

                <td style="border-bottom:1px solid;"></td>
            
            </tr>


        
            </table>


            <table style="border-bottom:1px solid" width="100%">
            
                <tr>
                    <td>Received by:</td>

                    <td>Prepared by: </td>

                    <td>Finance Dept:</td>

                    <td>Workshop Manager</td>

                </tr>
            
            </table>
        
        
            
        
        
            ';
        
            
            $mpdf->WriteHTML($html);
            $mpdf->SetFooter($footer);
            $this->response->setHeader('Content-Type', 'application/pdf');
            $mpdf->Output();
        
        }


     
    


}
