<?php

namespace App\Controllers\Crm;

use App\Controllers\BaseController;


class CashInvoice extends BaseController
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
       
        $totalRecords = $this->common_model->GetTotalRecords('crm_cash_invoice','ci_id','DESC');
 
        ## Total number of records with filtering
       
        $searchColumns = array('ci_reffer_no');

        $totalRecordwithFilter = $this->common_model->GetTotalRecordwithFilter('crm_cash_invoice','ci_id',$searchValue,$searchColumns);
    
        ##Joins if any //Pass Joins as Multi dim array
        $joins = array(
            array(
                'table' => 'crm_customer_creation',
                'pk'    => 'cc_id',
                'fk'    => 'ci_customer',
            ),
           
        );
        ## Fetch records
        $records = $this->common_model->GetRecord('crm_cash_invoice','ci_id',$searchValue,$searchColumns,$columnName,$columnSortOrder,$joins,$rowperpage,$start);
    
        $data = array();

        $i=1;
        foreach($records as $record ){
            $action = '<a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->ci_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a><a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->ci_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> Delete</a><a  href="javascript:void(0)" data-id="'.$record->ci_id.'"  class="view view-color view_btn" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a>';
           
           $data[] = array( 
              'ci_id'        => $i,
              'ci_reffer_no' => $record->ci_reffer_no,
              'ci_date'      => date('d-m-Y',strtotime($record->ci_date)),
              'ci_customer'  => $record->ci_customer,
              'action'       => $action,
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

        $data['sales_executive'] = $this->common_model->FetchAllOrder('executives_sales_executive','se_id','desc');
        
        $data['products'] = $this->common_model->FetchAllOrder('crm_products','product_id','desc');

        $data['employees'] = $this->common_model->FetchAllOrder('employees','employees_id','desc');

        $data['charts_of_accounts'] = $this->common_model->FetchAllOrder('accounts_charts_of_accounts','ca_id','desc');

        $data['customer_creation'] = $this->common_model->FetchAllOrder('crm_customer_creation','cc_id','desc');
        
        $data['cash_invoice'] = $this->common_model->FetchAllOrder('master_cash_invoice_status','cis_id ','desc');
        
        $data['cash_invoice_id'] = $this->common_model->FetchNextId('crm_cash_invoice','CIN'); 

        $data['content'] = view('crm/cash-invoice',$data);

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

            'ci_reffer_no'       => $this->request->getPost('ci_reffer_no'),

            'ci_date'            => $this->request->getPost('ci_date'),

            'ci_customer'        => $this->request->getPost('ci_customer'),

            'ci_sales_order'     => $this->request->getPost('ci_sales_order'),

            'ci_lpo_reff'        => $this->request->getPost('ci_lpo_reff'),

            'ci_contact_person'  => $this->request->getPost('ci_contact_person'),

            'ci_payment_term'    => $this->request->getPost('ci_payment_term'),

            'ci_project'         => $this->request->getPost('ci_project'),

            'ci_credit_account'  => $this->request->getPost('ci_credit_account'),

            'ci_addded_by'       => 0,

            'ci_added_date'      => date('Y-m-d'),

        ];

        $cash_invoice = $this->common_model->InsertData('crm_cash_invoice',$insert_data);

        if(!empty($_POST['cipd_prod_det']))
		{
            $count =  count($_POST['cipd_prod_det']);
                
            if($count!=0)
            {  
                for($j=0;$j<=$count-1;$j++)
                {
                        
                    $product_data  	= array(  
                        
                        'cipd_prod_det'      =>  $_POST['cipd_prod_det'][$j],
                        'cipd_unit'          =>  $_POST['cipd_unit'][$j],
                        'cipd_qtn'           =>  $_POST['cipd_qtn'][$j],
                        'cipd_rate'          =>  $_POST['cipd_rate'][$j],
                        'cipd_discount'      =>  $_POST['cipd_discount'][$j],
                        'cipd_amount'        =>  $_POST['cipd_amount'][$j],
                        'cipd_cash_invoice' =>  $cash_invoice,
                        
                    );

                    $this->common_model->InsertData('crm_cash_invoice_prod_det',$product_data);
                    
                } 
            }

                   
		}


        

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
        
        $sales_orders = $this->common_model->FetchSalesInCashInvoice($this->request->getPost('ID'));

        $data['sales_order'] ="";

        $data['sales_order'] ='<option value="" selected disabled>Select Sales Order Number</option>';

        foreach($sales_orders as $sales_order)
        {
            $data['sales_order'] .='<option value='.$sales_order->so_id.'';
           
            $data['sales_order'] .='>' .$sales_order->so_reffer_no. '</option>'; 
        }


        $cond2 = array('contact_customer_creation' => $this->request->getPost('ID'));
        
        $contact_details = $this->common_model->FetchWhere('crm_contact_details',$cond2);

        $data['contact_details'] = '<option>Select Contact Person</option>'; 
       
        foreach($contact_details as $cont_det)
        {
            $data['contact_details'] .='<option value='.$cont_det->contact_id.'>'.$cont_det->contact_person.'</option>';
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
        $cond = array('ci_id' => $this->request->getPost('ID'));
 
        $this->common_model->DeleteData('crm_cash_invoice',$cond);

        $cond1 = array('ci_id' => $this->request->getPost('ID'));
 
        $this->common_model->DeleteData('cipd_cash_invoice',$cond1);
 
         
     }


     public function FetchSalesOrder()
     {
        $cond = array('so_id' => $this->request->getPost('id'));

        $sales_order = $this->common_model->SingleRow('crm_sales_orders',$cond);

        $cond1 =  array('spd_sales_order'=> $sales_order->so_id);

        $sales_prod_det = $this->common_model->FetchWhere('crm_sales_product_details',$cond1);

        $products = $this->common_model->FetchAllOrder('crm_products','product_id','desc');

        $data['saleorder_output'] ='';

        $data['saleorder_output'] .= '<table class="table table-bordered table-striped delTable"><tbody class="travelerinfo"><tr><td>Serial No.</td><td>Product Description</td><td>Unit</td><td>Quantity</td><td>Rate</td><td>Discount(%)</td><td>Amount</td><td>Current Claim</td><td>Action</td></tr>';
        
        $i=1;
        
        foreach($sales_prod_det as $prod_det){

            $data['saleorder_output'] .= '<tr class="prod_row" id="'.$prod_det->spd_id.'">
                                            <td>'.$i.'</td>
                                            <td>
                                                <select class="form-select" name="pp_product_det[]" required>';
                                                
                                                foreach($products as $prod){

                                                    $data['saleorder_output'] .= '<option value="'.$prod->product_id.'"';
                                                    if($prod->product_id  == $prod_det->spd_product_details){  $data['saleorder_output'] .= "selected"; }
                                                    $data['saleorder_output'] .='>'.$prod->product_details.'</option>';
                                                }  

                   $data['saleorder_output'] .=  '</select>
                                            </td>
                                            <td><input type="text" name="pp_unit[]" value="'.$prod_det->spd_unit.'" class="form-control" required></td>
                                            <td><input type="number" name="pp_quantity[]" value="'.$prod_det->spd_quantity.'" class="form-control qtn_clz_id" required></td>
                                            <td><input type="number" name="pp_rate[]" value="'.$prod_det->spd_rate.'" class="form-control rate_clz_id" required></td>
                                            <td><input type="number" name="pp_discount[]" value="'.$prod_det->spd_discount.'" class="form-control discount_clz_id" required></td>
                                            <td><input type="number" name="pp_amount[]" value="'.$prod_det->spd_amount.'" class="form-control amount_clz_id" required></td>
                                            <td><input type="text" name="pp_current_claim[]" class="form-control" required></td>
                                            <td class="row_remove" data-id="'.$prod_det->spd_id .'"><i class="ri-close-line"></i>Remove</td>
                                        </tr>';
                                        $i++;
                                    }
           $data['saleorder_output'] .= '</tbody><tbody id="product-more" class="travelerinfo"></tbody><tr><td colspan="9" style="text-align: center;"><span id="total_cost_id"></span></td></tr></table><div class="edit_add_more_div"><span class="edit_add_more add_product"><i class="ri-add-circle-line"></i>Add More</span></div>';
        
        
            echo json_encode($data);

        }


        public function FetchSalesData()
        {
            $cond = array('so_id' => $this->request->getPost('ID'));

            $sales_order = $this->common_model->SingleRow('crm_sales_orders',$cond);

            $cond1 = array('spd_sales_order' => $this->request->getPost('ID'));

            $sales_order_details = $this->common_model->FetchWhere('crm_sales_product_details',$cond1);

            $products = $this->common_model->FetchAllOrder('crm_products','product_id','desc');

            $data['so_lpo'] = $sales_order->so_lpo;

            $data['so_payment_term'] = $sales_order->so_payment_term;

            $data['so_project'] = $sales_order->so_project;

            $cond2 = array('contact_customer_creation' => $this->request->getPost('custID'));
           
            $contact_details = $this->common_model->FetchWhere('crm_contact_details',$cond2);

            $data['contact_detail'] = ""; 

            foreach($contact_details as $cont_det)
            {
                $data['contact_detail'] .='<option value='.$cont_det->contact_id.'';
                if($cont_det->contact_id == $sales_order->so_contact_person){ $data['contact_detail'] .=' selected';}
                $data['contact_detail'] .='>'.$cont_det->contact_person.'</option>';
            }
 
            /*product detail section start*/

            $data['product_detail'] ='';

            $i = 1;

            foreach($sales_order_details as $sales_det){
            $data['product_detail'] .='<tr class="prod_row cash_invoice_remove"  id="'.$sales_det->spd_id.'">
                                            <td class="si_no">'.$i.'</td>
                                            <td>
                                                <select class="form-select ser_product_det" name="cipd_prod_det[]" required>';
                                                            
                                                foreach($products as $prod){
                                                    $data['product_detail'] .='<option value="'.$prod->product_id.'"'; 
                                                    if($prod->product_id == $sales_det->spd_product_details){ $data['product_detail'] .= "selected"; }
                                                    $data['product_detail'] .='>'.$prod->product_details.'</option>';
                                                }
                                                $data['product_detail'] .= '</select>

                                            </td>
                                            <td><input type="text"   name="cipd_unit[]" value="'.$sales_det->spd_unit.'" class="form-control" required></td>
                                            <td><input type="number" name="cipd_qtn[]" value="'.$sales_det->spd_quantity.'"  class="form-control real_qty" required></td>
                                            <td><input type="number" name="cipd_rate[]" value="'.$sales_det->spd_rate.'"  class="form-control rate_clz_id" required></td>
                                            <td><input type="number" name="cipd_discount[]" value="'.$sales_det->spd_discount.'"  class="form-control discount_clz_id" required></td>
                                            <td><input type="number" name="cipd_amount[]" value="'.$sales_det->spd_amount.'"  class="form-control discount_clz_id" required></td>
                                            <td class="row_remove remove-btnpp" data-id="'.$sales_det->spd_id.'"><i class="ri-close-line"></i>Remove</td>
                                            
                                        </tr>';
                                                
                                        $i++;
            }

            /*#####*/


            /*select table section start*/

            $data['select_table'] ="";

            foreach($sales_order_details as $sales_det){
            
            $i=1;    

            $data['select_table'] .='<tr>
                                        <td class="si_no">'.$i.'</td>
                                        <td>
                                            <select class="form-select ser_product_det" name="cipd_prod_det[]" required>';
                                                        
                                            foreach($products as $prod){
                                                $data['select_table'] .='<option value="'.$prod->product_id.'"'; 
                                                if($prod->product_id == $sales_det->spd_product_details){ $data['product_detail'] .= "selected"; }
                                                $data['select_table'] .='>'.$prod->product_details.'</option>';
                                            }
                                            $data['select_table'] .= '</select>

                                    </td>
                                    <td><input type="text" name="dpd_unit[]" value="'.$sales_det->spd_unit.'"  class="form-control" required></td>
                                    <td><input type="text" name="dpd_unit[]" value="'.$sales_det->spd_quantity.'"  class="form-control" required></td>
                                    <td><input type="checkbox" name="dpd_unit[]"  class="" required></td>
            
                                        </tr>';

                                        $i++;
            }                            

            /*#####*/

            echo json_encode($data);

        }


        //delete contact details
        public function DeleteContact()
        {
            //$cond = array('pp_id' => $this->request->getPost('ID'));
 
           // $this->common_model->DeleteData('crm_proforma_product',$cond);

        }

     
    


}
