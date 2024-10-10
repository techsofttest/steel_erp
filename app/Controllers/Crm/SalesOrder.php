<?php

namespace App\Controllers\Crm;

use App\Controllers\BaseController;


class SalesOrder extends BaseController
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
       
        $totalRecords = $this->common_model->GetTotalRecords('crm_sales_orders','so_id','DESC');
 
        ## Total number of records with filtering
       
        $searchColumns = array('so_reffer_no');

        $totalRecordwithFilter = $this->common_model->GetTotalRecordwithFilter('crm_sales_orders','so_id',$searchValue,$searchColumns);
    
        ##Joins if any //Pass Joins as Multi dim array
        $joins = array(
            array(
                'table' => 'crm_customer_creation',
                'pk'    => 'cc_id',
                'fk'    => 'so_customer',
            ),
            array(
                'table' => 'crm_quotation_details',
                'pk'    => 'qd_id',
                'fk'    => 'so_quotation_ref',
            )
        );
        ## Fetch records
        $records = $this->common_model->GetRecord('crm_sales_orders','so_id',$searchValue,$searchColumns,$columnName,$columnSortOrder,$joins,$rowperpage,$start);
    
        $data = array();

        $i=1;
        foreach($records as $record ){
            $action = '<a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->so_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a><a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->so_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> Delete</a><a  href="javascript:void(0)" data-id="'.$record->so_id.'"  class="view view-color view_btn" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a><a href="'.base_url().'Crm/SalesOrder/Pdf/'.$record->so_id.'" target="_blank" class="print_color"><i class="ri-file-pdf-2-line " aria-hidden="true"></i>Print</a>';
             
            if(!empty($record->so_edit_reff_no))
            {
               $reffer_num = $record->so_reffer_no . "(" . $record->so_edit_reff_no . ")";
            }
            else
            {
                $reffer_num = $record->so_reffer_no;
            }


           $data[] = array( 
              "so_id"            =>$i,
              'so_reffer_no'      => $reffer_num,
              'so_date'          => date('d-M-Y',strtotime($record->so_date)),
              'so_customer'      => $record->cc_customer_name,
              'so_quotation_ref' => $record->qd_reffer_no,
              "action"           => $action,
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




    //view page
    public function index()
    {   
        
        $data['customer_creation'] = $this->common_model->FetchAllOrder('crm_customer_creation','cc_id','desc');

        $data['sales_executive'] = $this->common_model->FetchAllOrder('executives_sales_executive','se_id','desc');
        
        
        $data['products'] = $this->common_model->FetchAllOrder('crm_products','product_id','desc');

     
        $data['contacts'] = $this->common_model->FetchAllOrder('crm_contact_details','contact_id','desc');
        
        $data['sales_order_id'] = $this->common_model->FetchNextId('crm_sales_orders','SO');

        $data['content'] = view('crm/sales-order',$data);

        return view('crm/crm-module',$data);

    }


    // add account head
    Public function Add()
    {   
        $return['print'] = "";

        if(!empty($this->request->getPost('so_quotation_ref')))
        {
            $quotation_ref = $this->request->getPost('so_quotation_ref');
        }
        else
        {
            $quotation_ref =0;
        }
        

        $insert_data = [

            'so_reffer_no'              => $this->request->getPost('so_reffer_no'),

            'so_date'                   => date('Y-m-d',strtotime($this->request->getPost('so_date'))),

            'so_customer'               => $this->request->getPost('so_customer'),

            'so_quotation_ref'          => $quotation_ref,

            'so_lpo'                    => $this->request->getPost('so_lpo'),

            'so_sales_executive'        => $this->request->getPost('so_sales_executive'),

            'so_contact_person'         => $this->request->getPost('so_contact_person'),

            'so_payment_term'           => $this->request->getPost('so_payment_term'),

            'so_delivery_term'          => date('Y-m-d',strtotime($this->request->getPost('so_delivery_term'))),

            'so_project'                => $this->request->getPost('so_project'),

            'so_amount_total'           => $this->request->getPost('so_amount_total'),

            'so_amount_total_in_words'  => $this->request->getPost('so_amount_total_in_words'),

            'so_added_date'             => date('Y-m-d'),
        ];

        // Handle file upload
        if ($_FILES['so_file']['name'] !== '') 
		{   
           

            $soAttachFileName = $this->uploadFile('so_file','uploads/SalesOrder');
            $insert_data['so_file'] = $soAttachFileName;
        }

        $sales_order_id = $this->common_model->InsertData('crm_sales_orders',$insert_data);



        /*product table section start*/

        if(!empty($_POST['spd_unit']))
        {
            $count =  count($_POST['spd_unit']);
            
            if($count!=0)
            {  
                for($j=0;$j<=$count-1;$j++)
                {   
                    if(!empty($_POST['quot_prod_id'][$j]))
                    {
                       $quot_prod_id = $_POST['quot_prod_id'][$j];
                    }
                    else
                    {
                        $quot_prod_id = 0;
                    }

                    $prod_data  	= array(  
                        
                        'spd_product_details'   =>  $_POST['spd_product_details'][$j],
                        'spd_unit'              =>  $_POST['spd_unit'][$j],
                        'spd_quantity'          =>  $_POST['spd_quantity'][$j],
                        'spd_rate'              =>  $_POST['spd_rate'][$j],
                        'spd_discount'          =>  $_POST['spd_discount'][$j],
                        'spd_amount'            =>  $_POST['spd_amount'][$j],
                        'spd_quot_prod_id'      =>  $quot_prod_id,
                        'spd_sales_order'       =>  $sales_order_id,
    
                    );
                
                    $id = $this->common_model->InsertData('crm_sales_product_details',$prod_data);

                    if(!empty($_POST['quot_prod_id'][$j]))
                    {
                    
                        $updated_data = array('qpd_status'=>1);
                        
                        $this->common_model->EditData($updated_data,array('qpd_id' => $_POST['quot_prod_id'][$j]),'crm_quotation_product_details');
                        
                        $product_detail = $this->common_model->FetchWhere('crm_quotation_product_details',array('qpd_quotation_details' => $_POST['quotation_id'][$j]));
                        
                        $product_details = $this->common_model->CheckTwiceCond1('crm_quotation_product_details',array('qpd_quotation_details' => $_POST['quotation_id'][$j]),array('qpd_status'=>1));
                       
                        
                        if(count($product_detail) == count($product_details))
                        {
                            $updated_data2 = array('qd_status'=>1);

                            $this->common_model->EditData($updated_data2,array('qd_id' => $_POST['quotation_id'][$j]),'crm_quotation_details');
                        
                        }

                    }


                    if(!empty($_POST['print_btn']))
                    {
                       
                        $return['print'] =  base_url() . 'Crm/SalesOrder/Pdf/' . urlencode($sales_order_id);

                    }
                    
                   
            
                } 
            }
        }
        
         echo json_encode($return);
        /*####*/

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




    public function ContactPerson()
    {
        $cond = array('contact_customer_creation' => $this->request->getPost('ID'));

        $contact_details = $this->common_model->FetchWhere('crm_contact_details',$cond);

        $cond1 = array('qd_customer' => $this->request->getPost('ID'));

        //$quotation_details = $this->common_model->FetcQuotInSales($this->request->getPost('ID'));

        $quotation_details = $this->common_model->CheckTwiceCond1('crm_quotation_details',array('qd_customer' => $this->request->getPost('ID')),array('qd_status'=>0));
        
        $data['quotation_det'] ="";
        
        $data['quotation_det'] ='<option value="" selected disabled>Select Quotation Ref</option>';

        foreach($quotation_details as $quot_det)
        {
            $data['quotation_det'] .='<option value='.$quot_det->qd_id.'';
           
            $data['quotation_det'] .='>' .$quot_det->qd_reffer_no. '</option>'; 
        }


        $data['customer_name'] ="";

        $data['customer_name'] ='<option value="" selected disabled>Select  Contact Person</option>';

        foreach($contact_details as $con_det)
        {
            $data['customer_name'] .='<option value='.$con_det->contact_id.'';
           
            $data['customer_name'] .='>' .$con_det->contact_person. '</option>'; 
        }
        
        //credit term
        $cond2 = array('cc_id' => $this->request->getPost('ID'));

        $payment_term = $this->common_model->SingleRow('crm_customer_creation',$cond2);

        $data['credit_term'] = $payment_term->cc_credit_term;
        
        echo json_encode($data);


    }

    //common fun for add and edit
    public function QuotationRef()
    {
        $cond = array('qd_id' => $this->request->getPost('ID'));

        $cond1 = array('qpd_quotation_details' => $this->request->getPost('ID'));

        $sales_executive = $this->common_model->FetchAllOrder('executives_sales_executive','se_id','desc');

        $cond2 = array('contact_customer_creation' => $this->request->getPost('quotID'));
        
        $contact_person = $this->common_model->FetchWhere('crm_contact_details',$cond2);

        
        /*$joins1 = array(
            array(
                'table' => 'crm_products',
                'pk'    => 'product_id',
                'fk'    => 'qpd_product_description',
            ),
           

        );

        $product_details_data = $this->common_model->FetchWhereJoin('crm_quotation_product_details',$cond1,$joins1);*/

        $product_details_data = $this->common_model->CheckTwiceCond1('crm_quotation_product_details',$cond1,array('qpd_status'=>0));

        $products = $this->common_model->FetchAllOrder('crm_products','product_id','desc');

         
        $data['prod_details'] ='';
        $i =1; 
        $si=0;
        foreach($product_details_data as $prod_det)
        {   
            $prod_det->qpd_amount;

            $data['prod_details'] .='<tr class="prod_row2 sales_remove sales_row_leng" id="'.$prod_det->qpd_id.'">
            <td class="si_no2">'.$i.'</td>
            <td style="width:40%">
                <select class="form-select droup_product add_prod" name="spd_product_details['.$si.']" required>';
                    
                    foreach($products as $prod){
                        $data['prod_details'] .='<option value="'.$prod->product_id.'" '; 
                        if($prod->product_id == $prod_det->qpd_product_description){ $data['prod_details'] .= "selected"; }
                        $data['prod_details'] .='>'.$prod->product_details.'</option>';
                    }
            $data['prod_details'] .='</select>
            </td>
            <td><input type="text"  name="spd_unit['.$si.']"  value="'.$prod_det->qpd_unit.'" class="form-control unit_clz_id" required></td>
            <td> <input type="text" name="spd_quantity['.$si.']" value="'.$prod_det->qpd_quantity.'" class="form-control qtn_clz_id"  required></td>
            <td> <input type="text" name="spd_rate['.$si.']"  class="form-control rate_clz_id" required></td>
            <td> <input type="text" name="spd_discount['.$si.']" min="0" max="100" onkeyup="MinMax(this)"  class="form-control discount_clz_id" required></td>
            <td> <input type="text" name="spd_amount['.$si.']"  class="form-control amount_clz_id" readonly></td>
            <input type="hidden" name="quot_prod_id['.$si.']" value="'.$prod_det->qpd_id.'">
            <input type="hidden" name="quotation_id['.$si.']" value="'.$prod_det->qpd_quotation_details.'">
            <td class="row_remove remove-btnpp" data-id="'.$prod_det->qpd_id.'"><i class="ri-close-line"></i>Remove</td>
            </tr>'; 
            $i++;
            $si++; 
        }
       
        /**/


        $joins = array(
           
            
            
            array(
                'table' => 'master_delivery_term',
                'pk'    => 'dt_id',
                'fk'    => 'qd_delivery_term',
            )


        );

        $quotation_details = $this->common_model->SingleRowJoin('crm_quotation_details',$cond,$joins);

        
        
        
        $data['qd_sales_executive'] = "";

        foreach($sales_executive as $sales_excu)
        {
            $data['qd_sales_executive'] .= '<option value='.$sales_excu->se_id.'';
            if($sales_excu->se_id == $quotation_details->qd_sales_executive){$data['qd_sales_executive'] .= " selected";}
            $data['qd_sales_executive'] .='>'.$sales_excu->se_name.'</option>';
        }

      
        $data['contact_person'] = '';

        foreach($contact_person as $cont_per)
        {
           
            $data['contact_person'] .= '<option value='.$cont_per->contact_id.'';
            if($cont_per->contact_id == $quotation_details->qd_contact_person){  $data['contact_person'] .= " selected"; }
            $data['contact_person'] .='>'.$cont_per->contact_person.'</option>';
        }
       

        $data['qd_delivery_term']   =  $quotation_details->dt_name;

        $data['qd_project'] =  $quotation_details->qd_project;

        echo json_encode($data);

    }


    // update account head 
    /*public function Update()
    {   
        $cond = array('so_id' => $this->request->getPost('so_id'));

        $sales_order = $this->common_model->SingleRow('crm_sales_orders',$cond);
        

        if (empty($sales_order->so_edit_flag)) 
        {
            $output = $this->request->getPost('so_reffer_no') . "-ERP-" . strrev($this->request->getPost('so_reffer_no'));
            
        }
        else
        {
            $output = $this->request->getPost('so_reffer_no');
            
        }
        
        
       

       $update_data = [

        'so_reffer_no'              => $output,

        'so_date'                   => date('Y-m-d',strtotime($this->request->getPost('so_date'))),

        'so_customer'               => $this->request->getPost('so_customer'),

        'so_quotation_ref'          => $this->request->getPost('so_quotation_ref'),

        'so_lpo'                    => $this->request->getPost('so_lpo'),

        'so_sales_executive'        => $this->request->getPost('so_sales_executive'),

        'so_contact_person'         => $this->request->getPost('so_contact_person'),

        'so_payment_term'           => $this->request->getPost('so_payment_term'),

        'so_delivery_term'          => date('Y-m-d',strtotime($this->request->getPost('so_delivery_term'))),

        'so_project'                => $this->request->getPost('so_project'),

        'so_edit_flag'              => 1,

        
        ];

        // Handle file upload
        if (isset($_FILES['so_file']) && $_FILES['so_file']['name'] !== '') {
            
            
            if($this->request->getFile('so_file') != '' ){ 
            
                $previousImagePath = 'uploads/SalesOrder/' .$sales_order->so_file;
            
                if (file_exists($previousImagePath)) {
                    unlink($previousImagePath);
                }
            }
            
            // Upload the new image
            $AttachFileName = $this->uploadFile('so_file', 'uploads/SalesOrder');
        
            // Update the data with the new image filename
            $update_data['so_file'] = $AttachFileName;
        }

        $this->common_model->EditData($update_data,$cond,'crm_sales_orders');
       
    }*/


    public function Update()
    {   
        $cond = array('so_id' => $this->request->getPost('so_id'));

        /*$sales_order = $this->common_model->SingleRow('crm_sales_orders',$cond);
        
        $sales_flag = ++$sales_order->so_edit_flag;
        
        $output = $this->request->getPost('so_reffer_no') . "-REV-" ."0". $sales_flag;*/


       $update_data = [

        'so_date'                   => date('Y-m-d',strtotime($this->request->getPost('so_date'))),

        'so_customer'               => $this->request->getPost('so_customer'),

        'so_quotation_ref'          => $this->request->getPost('so_quotation_ref'),

        'so_lpo'                    => $this->request->getPost('so_lpo'),

        'so_sales_executive'        => $this->request->getPost('so_sales_executive'),

        'so_contact_person'         => $this->request->getPost('so_contact_person'),

        'so_payment_term'           => $this->request->getPost('so_payment_term'),

        'so_delivery_term'          => date('Y-m-d',strtotime($this->request->getPost('so_delivery_term'))),

        'so_project'                => $this->request->getPost('so_project'),

        //'so_edit_flag'              => $sales_flag,

        //'so_edit_reff_no'           => $output,

        
        ];

            // Handle file upload
            if (isset($_FILES['so_file']) && $_FILES['so_file']['name'] !== '') {
                
                
                if($this->request->getFile('so_file') != '' ){ 
                
                    $previousImagePath = 'uploads/SalesOrder/' .$sales_order->so_file;
                
                    if (file_exists($previousImagePath)) {
                        unlink($previousImagePath);
                    }
                }
                
                // Upload the new image
                $AttachFileName = $this->uploadFile('so_file', 'uploads/SalesOrder');
            
                // Update the data with the new image filename
                $update_data['so_file'] = $AttachFileName;
            }

        $this->common_model->EditData($update_data,$cond,'crm_sales_orders');
       
    }




    //delete account head
    public function Delete()
    {
        $cond = array('so_id' => $this->request->getPost('ID'));

        $delivery_note = $this->common_model->SingleRow('crm_delivery_note',array('dn_sales_order_num' => $this->request->getPost('ID')));
        
        $cash_invoice = $this->common_model->SingleRow('crm_cash_invoice',array('ci_sales_order' => $this->request->getPost('ID')));
        
        

        if((empty($delivery_note)) && (empty($cash_invoice)))
        {
            //change status in quotation and product table
           
            $sales_order = $this->common_model->SingleRow('crm_sales_orders',array('so_id' => $this->request->getPost('ID')));
            
            $quotation_id = $sales_order->so_quotation_ref;

            $sales_order_id = $sales_order->so_id;

            $updated_data = array('qd_status'=>0);

            $this->common_model->EditData($updated_data,array('qd_id' => $quotation_id),'crm_quotation_details');
            
            $sales_products = $this->common_model->FetchWhere('crm_sales_product_details',array('spd_sales_order' => $sales_order_id));
            
            foreach($sales_products as $sale_prod)
            {
                
                $prod_update = array('qpd_status'=>0);

                $this->common_model->EditData($prod_update,array('qpd_id' => $sale_prod->spd_quot_prod_id),'crm_quotation_product_details');

            }
            

            //pro-forma invoice
            
            $proforma_data = $this->common_model->FetchWhere('crm_proforma_invoices',array('pf_sales_order' => $this->request->getPost('ID')));

            foreach($proforma_data as $proforma)
            {
                $cond2 = array('pp_proforma' => $proforma->pf_id);

                $this->common_model->DeleteData('crm_proforma_product',$cond2);
            }
  
            $this->common_model->DeleteData('crm_proforma_invoices',array('pf_sales_order' => $this->request->getPost('ID')));
              
            //delete sales order

            $this->common_model->DeleteData('crm_sales_orders',$cond);

            $cond1 = array('spd_sales_order' => $this->request->getPost('ID'));
    
            $this->common_model->DeleteData('crm_sales_product_details',$cond1);

            $data['status'] = "true";

        }
        else
        { 

          
            
            $data['status'] = "false";
        }
       
        echo json_encode($data);

         
    }


    //delete contact details
    public function DeleteContact()
    {
        $cond = array('qpd_id' => $this->request->getPost('ID'));
 
        $this->common_model->DeleteData('crm_quotation_product_details',$cond);

        
    }



    public function FetchProduct()
    {
        $product_head = $this->common_model->FetchAllOrder('crm_products','product_id','asc');

        $data["product_head_out"] = "";
        
        foreach($product_head as $prod_head)
        {
        
            $data["product_head_out"] .= '<option value="'.$prod_head->product_id.'">'.$prod_head->product_details.'</option>';

        } 
        
        echo json_encode($data);

    }


    public function Edit()
    {
        $cond1 = array('so_id' => $this->request->getPost('ID'));

        $joins = array(
           
            array(
                'table' => 'crm_quotation_details',
                'pk'    => 'qd_id',
                'fk'    => 'so_quotation_ref',
            ),
           
        );	

        $sales_order       = $this->common_model->SingleRowJoin('crm_sales_orders',$cond1,$joins);

        $customer_creation = $this->common_model->FetchAllOrder('crm_customer_creation','cc_id','desc');

        $sales_executive   = $this->common_model->FetchAllOrder('executives_sales_executive','se_id','desc');

        $data['reff_no']         = $sales_order->so_reffer_no;

        $data['date']            = date('d-M-Y',strtotime($sales_order->so_date));

        $data['lpo']             = $sales_order->so_lpo;

        $data['payment_term']    = $sales_order->so_payment_term;

        $data['delivery_term']   = date('d-M-Y',strtotime($sales_order->so_delivery_term));

        $data['project']         = $sales_order->so_project;

        $data['so_id']           = $sales_order->so_id;

        $data['amount_total']    = $sales_order->so_amount_total;

        $data['file_name']       = $sales_order->so_file;

        $data['file_attach']     = '<a href="' . base_url('uploads/SalesOrder/' . $sales_order->so_file) . '" target="_blank">View</a>';  


        $data['customer_creation'] ="";

        // customer craetion
        foreach($customer_creation as $cus_creation)
        {
            
            if ($cus_creation->cc_id  == $sales_order->so_customer)
            {
                $data['customer_creation'] .= '<option value="' .$cus_creation->cc_id.'"'; 
                $data['customer_creation'] .= ' selected'; 
                $data['customer_creation'] .= '>' . $cus_creation->cc_customer_name .'</option>';
            }
        
           
        }

        //quotation_details
        
        $data['quotation'] ="";

        $data['quotation'] .='<option value="'.$sales_order->qd_id.'">'.$sales_order->qd_reffer_no.'</option>';

        
        //sales executive
        $data['sales_executive'] ="";
        foreach($sales_executive as $sales_exec)
        {
            $data['sales_executive'] .= '<option value="' .$sales_exec->se_id.'"'; 
        
            // Check if the current product head is selected
            if ($sales_exec->se_id  == $sales_order->so_sales_executive)
            {
                $data['sales_executive'] .= ' selected'; 
            }
        
            $data['sales_executive'] .= '>' . $sales_exec->se_name.'</option>';
        }

        //contact person

        //$contact_data   = $this->common_model->FetchAllOrder('crm_contact_details','contact_id','desc');

        //$cond3 = array('contact_customer_creation'=>$quotation_details->qd_customer);

        $contact_data = $this->common_model->FetchWhere('crm_contact_details',array('contact_customer_creation'=>$sales_order->so_customer));
      
        $data['contact_person'] ="";

        foreach($contact_data as $cont_data)
        {
            $data['contact_person'] .= '<option value="' .$cont_data->contact_id .'"'; 
        
            // Check if the current product head is selected
            if ($cont_data->contact_id   == $sales_order->so_contact_person)
            {
                $data['contact_person'] .= ' selected'; 
            }
        
            $data['contact_person'] .= '>' . $cont_data->contact_person.'</option>';
        }


        //product section start

        $cond2 = array('spd_sales_order' => $this->request->getPost('ID'));

        $joins1 = array(
            array(
                'table' => 'crm_products',
                'pk'    => 'product_id',
                'fk'    => 'spd_product_details	',
            ),
           

        );

        $product_details_data = $this->common_model->FetchWhereJoin('crm_sales_product_details',$cond2,$joins1);
       

        $data['prod_details'] ='';

        $i =1; 

        foreach($product_details_data as $prod_det)
        {   
            

            $data['prod_details'] .='<tr class="prod_row2 sales_remove edit_product_row" id="'.$prod_det->spd_id.'">
            <td class="delete_sino">'.$i.'</td>
            <td style="width:34%"><input type="text"   value="'.$prod_det->product_details.'" class="form-control " readonly></td></td>
            <td><input type="text"  value="'.$prod_det->spd_unit.'" class="form-control" readonly></td>
            <td> <input type="text" value="'.$prod_det->spd_quantity.'" class="form-control"  readonly></td>
            <td> <input type="text" value="'.$prod_det->spd_rate.'"  class="form-control" readonly></td>
            <td> <input type="text" value="'.$prod_det->spd_discount.'" class="form-control" readonly></td>
            <td> <input type="text" value="'.$prod_det->spd_amount.'" class="form-control edit_product_amount" readonly></td>
            <td style="width:15%">
                <a href="javascript:void(0)" class="edit edit-color product_edit"  data-id="'.$prod_det->spd_id.'" data-toggle="tooltip" data-placement="top" title="edit" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a>
		        <a href="javascript:void(0)" class="delete delete-color product_delete" data-id="'.$prod_det->spd_id.'"  data-toggle="tooltip" data-placement="top" title="Delete"><i class="ri-delete-bin-fill"></i> Delete</a>
            </td>
            </tr>'; 
            $i++; 
        }

        //image section start
        $data['image_table']="";

            if(!empty($sales_order->so_file))
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
                                            <td class="cust_img_rgt_border edit_file_name" >'. $sales_order->so_file.'</td>
                                            <td class="cust_img_rgt_border edit_file_attach"><a href="'.base_url('uploads/SalesOrder/' .$sales_order->so_file).'" target="_blank">View</a></td>
                                            <td class="cust_img_rgt_border" ><input type="file" name="so_file"></td>
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
                                                <input type="file" name="so_file" class="form-control">
                                            </div>
                                        </div>
                ';
            }

        
       
        echo json_encode($data);

    }


    Public function View()
    {
        
        $cond = array('so_id' => $this->request->getPost('ID'));

        $joins = array(
	   
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

            array(
                'table' => 'executives_sales_executive',
                'pk'    => 'se_id',
                'fk'    => 'so_sales_executive',
            ),

            array(
                'table' => 'crm_contact_details',
                'pk'    => 'contact_id',
                'fk'    => 'so_contact_person',
            ),
           
        );

        $sales_order  = $this->common_model->SingleRowJoin('crm_sales_orders',$cond,$joins);

        $data['reff_no']        = $sales_order->so_reffer_no;

        $data['date']           = date('d-M-Y',strtotime($sales_order->so_date));

        $data['customer']       = $sales_order->cc_customer_name;

        $data['quot_ref']       = $sales_order->qd_reffer_no;

        $data['lpo']            = $sales_order->so_lpo;

        $data['sales_exec']     = $sales_order->se_name;

        $data['contact_person'] = $sales_order->contact_person;

        $data['payment_term']   = $sales_order->so_payment_term;

        $data['delivery_term']  = date('d-M-Y',strtotime($sales_order->so_delivery_term));

        $data['project']        = $sales_order->so_project;

        $data['file_name']      = $sales_order->so_file;
        
        $data['total_amount']      = $sales_order->so_amount_total;
        
        $data['file_attach'] = '<a href="' . base_url('uploads/SalesOrder/' . $sales_order->so_file) . '" target="_blank">View</a>';  


        //table section start
        
        $cond1 = array('spd_sales_order' => $this->request->getPost('ID'));

        $joins1 = array(
            
            array(
                'table' => 'crm_products',
                'pk'    => 'product_id',
                'fk'    => 'spd_product_details',
            ),
           

        );

        $product_details_data = $this->common_model->FetchWhereJoin('crm_sales_product_details',$cond1,$joins1);
        
       
        $data['prod_details'] ='';
        $i =1; 
        foreach($product_details_data as $prod_det)
        {   
           

            $data['prod_details'] .='<tr class="prod_row2 sales_remove" id="'.$prod_det->spd_id.'">
            <td class="si_no2">'.$i.'</td>
            <td style="width:40%"><input type="text"  name="spd_unit[]"  value="'.$prod_det->product_details.'" class="form-control " readonly></td>
            <td><input type="text"  name="spd_unit[]"  value="'.$prod_det->spd_unit.'" class="form-control " readonly></td>
            <td> <input type="text" name="spd_quantity[]" value="'.$prod_det->spd_quantity.'" class="form-control qtn_clz_id"  readonly></td>
            <td> <input type="text" name="spd_rate[]" value="'.$prod_det->spd_rate.'" class="form-control rate_clz_id" readonly></td>
            <td> <input type="text" name="spd_discount[]" value="'.$prod_det->spd_discount.'" class="form-control discount_clz_id" readonly></td>
            <td> <input type="text" name="spd_amount[]" value="'.$prod_det->spd_amount.'"  class="form-control amount_clz_id" readonly></td>
          
            </tr>'; 
            $i++; 
        }
        
        //table section end


        //image section start
        $data['image_table']="";

            if(!empty($sales_order->so_file))
            {
            
                $data['image_table'] ='<table id="" class="table table-bordered table-striped delTable display dataTable" style="border: 1px solid #9E9E9E;width: 50%">
                                    <thead>
                                        <tr>
                                            <th class="cust_img_rgt_border">File Name</th>
                                            <th class="cust_img_rgt_border">Download</th>
                                            
                                        </tr>
                                    <thead>
                                    <tbody>
                                        <tr>
                                            <td class="cust_img_rgt_border view_file_name" >'. $sales_order->so_file.'</td>
                                            <td class="cust_img_rgt_border view_file_attach"><a href="'.base_url('uploads/SalesOrder/' .$sales_order->so_file).'" target="_blank">View</a></td>
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
                                                <input type="file" name="so_file" class="form-control">
                                            </div>
                                        </div>
                ';
            }



        echo json_encode($data);


    }



    public function EditQuotRef()
    {
        $cond = array('contact_customer_creation' => $this->request->getPost('ID'));

        $contact_details = $this->common_model->FetchWhere('crm_contact_details',$cond);

        $quotation_details = $this->common_model->FetcQuotInSales($this->request->getPost('ID'));

        

        $cond1 =  array('so_id' => $this->request->getPost('SalesOrder'));

        $joins1 = array(

            array(
                
                'table' => 'crm_quotation_details',
                'pk'    => 'qd_id',
                'fk'    => 'so_quotation_ref',
            ),
           
        );
        
        $sales_order     = $this->common_model->SingleRowJoin('crm_sales_orders',$cond1,$joins1);

        $cond2 = array('so_customer' => $this->request->getPost('ID'));

        $check_data = $this->common_model->CheckTwiceCond('crm_sales_orders',$cond1,$cond2);


        if(!empty($check_data))
        {   
            $data['quotation_det'] ='<option value="" selected disabled>Select Quotation</option>';
            $data['quotation_det'] .='<option value="'.$sales_order->qd_id.'">'.$sales_order->qd_reffer_no.'</option>';
        }
        else
        {
            $data['quotation_det'] ='<option value="" selected disabled>Select Quotation</option>';
        }
        
        
        

        foreach($quotation_details as $quot_det)
        {
            $data['quotation_det'] .='<option value='.$quot_det->qd_id.'';
           
            $data['quotation_det'] .='>' .$quot_det->qd_reffer_no. '</option>'; 
        }

        


        echo json_encode($data);
    }

    public function EditAddProd()
    {
        $insert_data = $this->request->getPost();

       

        $sales_det = $this->common_model->InsertData('crm_sales_product_details',$insert_data);

        $cond = array('spd_id' => $sales_det);

        $single_prod = $this->common_model->SingleRow('crm_sales_product_details',$cond);

        $cond2 = array('spd_sales_order' => $single_prod->spd_sales_order);

        $product_details  = $this->common_model->FetchWhere('crm_sales_product_details',$cond2);

        $old_amount = 0;

        foreach($product_details as $prod_det)
        {
            $old_amount =  $old_amount + $prod_det->spd_amount;
        }

        $sales_update = array('so_amount_total' => $old_amount);

        $cond3 = array('so_id'=>$single_prod->spd_sales_order);

        $this->common_model->EditData($sales_update,$cond3,'crm_sales_orders');

        $data['sales_order_id']  =  $single_prod->spd_sales_order;

        echo json_encode($data); 
  
    }


    public function FetchReference()
	{

		$uid = $this->common_model->FetchNextId('crm_sales_orders',"SO");
	
		echo $uid;

	}


    public function EditProduct()
    {
        $cond = array('spd_id' => $this->request->getPost('ID'));

        $prod_det = $this->common_model->SingleRow('crm_sales_product_details',$cond);

        $products = $this->common_model->FetchAllOrder('crm_products','product_id','desc');

        $data['prod_details'] ="";
        
            $data['prod_details'] .='<tr class="edit_prod_row">
            <td>1</td>
           
            <td style="width:34%"><select class="form-select droup_product" name="spd_product_details	" required>';
                    
                foreach($products as $prod){
                    $data['prod_details'] .='<option value="'.$prod->product_id.'" '; 
                    if($prod->product_id == $prod_det->spd_product_details){ $data['prod_details'] .= "selected"; }
                    $data['prod_details'] .='>'.$prod->product_details.'</option>';
                }
						
            $data['prod_details'] .='</select></td>

            <td><input type="text" name="spd_unit"  value="'.$prod_det->spd_unit.'" class="form-control " required></td>
            <td> <input type="text" name="spd_quantity" value="'.$prod_det->spd_quantity.'" class="form-control edit_prod_qty" required></td>
            <td> <input type="text" name="spd_rate" value="'.$prod_det->spd_rate.'" class="form-control edit_prod_rate" required></td>
            <td> <input type="text" name="spd_discount" min="0" max="100" onkeyup="MinMax(this)" value="'.$prod_det->spd_discount.'" class="form-control edit_prod_discount" required></td>
            <td> <input type="text" name="spd_amount" value="'.$prod_det->spd_amount.'" class="form-control edit_prod_amount" readonly></td>
           <input type="hidden" name="spd_id" class="edit_prod_id" value="'.$prod_det->spd_id.'">
           </tr>'; 

            echo json_encode($data); 
    }

    public function UpdateProduct()
    {   
        $cond = array('spd_id' => $this->request->getPost('spd_id'));

        
        $update_data = $this->request->getPost();

        if (array_key_exists('spd_id', $update_data)) 
        {
            unset($update_data['spd_id']);
        }    
        $update_data['spd_deliver_flag'] =0;

        $this->common_model->EditData($update_data,$cond,'crm_sales_product_details');


        $prod_det = $this->common_model->SingleRow('crm_sales_product_details',$cond);
        
        $data['sales_order_id'] = $prod_det->spd_sales_order;


        //update delivery product table
        
        $delivery_products = $this->common_model->FetchWhere('crm_delivery_product_details',array('dpd_so_id'=>$this->request->getPost('spd_id')));
        
       if(!empty($delivery_products))
       {
            foreach($delivery_products as $del_prod)
            {
                  $update_data2['dpd_order_qty']  = $prod_det->spd_quantity;

                  $this->common_model->EditData($update_data2,array('dpd_id'=>$del_prod->dpd_id),'crm_delivery_product_details');

            }
            
           // $update_data3['spd_deliver_flag'] = "0";
            
            //$this->common_model->EditData($update_data3,array('spd_id'=>$prod_det->spd_id),'crm_sales_product_details');

            $update_data4['so_deliver_flag'] = "0";
            
            $this->common_model->EditData($update_data4,array('so_id'=>$prod_det->spd_sales_order),'crm_sales_orders');
       }


            


       //calculation 

        $product_cond = $this->common_model->FetchWhere('crm_sales_product_details',array('spd_sales_order'=>$prod_det->spd_sales_order));
        
        $this->TotalCalculation($product_cond,array('so_id' => $prod_det->spd_sales_order));


        echo json_encode($data);
       
    }

    public function DeleteProdDet()
    {
        $cond = array('spd_id' => $this->request->getPost('ID'));

        $prod_det = $this->common_model->SingleRow('crm_sales_product_details',$cond);

        $this->common_model->DeleteData('crm_sales_product_details',$cond);
        
        $this->common_model->EditData(array('qpd_status' => 0),array('qpd_id' => $prod_det->spd_quot_prod_id),'crm_quotation_product_details');

        $product_cond = $this->common_model->FetchWhere('crm_sales_product_details',array('spd_sales_order'=>$prod_det->spd_sales_order));
        
        $this->TotalCalculation($product_cond,array('so_id' => $prod_det->spd_sales_order));
    }


    public function TotalCalculation($product_cond,$cond)
    {
        $old_amount = 0;

        foreach($product_cond as $prod_cond)
        {
            $old_amount =  $old_amount + $prod_cond->spd_amount;
        }

        $total_amount = number_format((float)$old_amount, 2, '.', '');  // Outputs -> 105.00

        $sales_update = array('so_amount_total' => $total_amount);

        $this->common_model->EditData($sales_update,$cond,'crm_sales_orders');
    }


     public function GetProd()
     {
       
        $delivery_prod = $this->common_model->SingleRow('crm_delivery_product_details',array('dpd_so_id' => $this->request->getPost('prodID')));
        

        $sales_prod_det = $this->common_model->SingleRow('crm_sales_product_details',array('spd_id' => $this->request->getPost('prodID')));
        

        if(!empty($delivery_prod))
        {
            $data['old_qty'] = $sales_prod_det->spd_quantity;
            
            $data['status'] ="true";
        }
        else
        {
            $data['old_qty'] ="";
            
            $data['status'] = "false";
 
        }
        
       
        echo json_encode($data);
    
    }
    
    /*public function CheckPrice()
    {
        $product_data = $this->common_model->FetchWhere('crm_cash_invoice_prod_det',$cond);
        
        foreach($product_data as $prod_data)
        {
            $prod_data->spd_quantity;
        }

       
    }*/
    
    public function CheckPrice()
    {
        $cond = array('spd_id' => $this->request->getPost('prodID'));

        $sales_prod_det = $this->common_model->SingleRow('crm_sales_product_details',$cond);
        
        
    }

    public function GetProdRate()
    {
        $cash_invoice  = $this->common_model->SingleRow('crm_cash_invoice_prod_det',array('cipd_sales_prod' => $this->request->getPost('prodID')));
        
        $credit_invoice = $this->common_model->SingleRow('crm_credit_invoice_prod_det',array('ipd_prod_id' => $this->request->getPost('prodID')));
        
        $sales_prod = $this->common_model->SingleRow('crm_sales_product_details',array('spd_id' => $this->request->getPost('prodID')));

        if(empty($cash_invoice) && empty($credit_invoice))
        {
            $data['product_status'] = "true";

            
        }
        else
        {
            $data['product_status'] = "false";
        }

        $data['prod_rate']  = $sales_prod->spd_rate;

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
