<?php

namespace App\Controllers\Crm;

use App\Controllers\BaseController;


class SalesReturn extends BaseController
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
       
        $totalRecords = $this->common_model->GetTotalRecords('crm_sales_return','sr_id','DESC');
 
        ## Total number of records with filtering
       
        $searchColumns = array('sr_reffer_no');

        $totalRecordwithFilter = $this->common_model->GetTotalRecordwithFilter('crm_sales_return','sr_id',$searchValue,$searchColumns);
    
        ##Joins if any //Pass Joins as Multi dim array
        $joins = array(
            array(
                'table' => 'crm_customer_creation',
                'pk'    => 'cc_id',
                'fk'    => 'sr_customer',
            ),
           
        );
        ## Fetch records
        $records = $this->common_model->GetRecord('crm_sales_return','sr_id',$searchValue,$searchColumns,$columnName,$columnSortOrder,$joins,$rowperpage,$start);
    
        $data = array();

        $i=1;
        foreach($records as $record ){
            $action = '<a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->sr_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a><a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->sr_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> Delete</a><a  href="javascript:void(0)" data-id="'.$record->sr_id.'"  class="view view-color view_btn" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a>';
           
           $data[] = array( 
              'sr_id'         => $i,
              'sr_reffer_no'  => $record->sr_reffer_no,
              'sr_date'       => date('d-m-Y',strtotime($record->sr_date)),
              'sr_customer'   => $record->cc_customer_name,
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

    //view page
    public function index()
    {   
        $data['customer_creation'] = $this->common_model->FetchAllOrder('crm_customer_creation','cc_id','desc');

        $data['sales_executive'] = $this->common_model->FetchAllOrder('executives_sales_executive','se_id','desc');
        
        $data['products'] = $this->common_model->FetchAllOrder('crm_products','product_id','desc');

        $data['employees'] = $this->common_model->FetchAllOrder('employees','employees_id','desc');

        $data['status_invoice'] = $this->common_model->FetchAllOrder('master_status_invoice','msi_id','desc');

        $data['credit_invoice'] = $this->common_model->FetchAllOrder('crm_credit_invoice','cci_id','desc');

        $data['content'] = view('crm/sales-return',$data);

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
        $insert_data = $this->request->getPost();

        $insert_data['sr_added_by'] = 0;
        
        $insert_data['sr_added_date'] = date('Y-m-d'); 

        $id = $this->common_model->InsertData('crm_sales_return',$insert_data);

        $data['sr_id'] = $id;

        $p_ref_no = 'SR'.str_pad($id, 7, '0', STR_PAD_LEFT);
        
        $cond = array('sr_id' => $id);

        $update_data['sr_reffer_no'] = $p_ref_no;

        $this->common_model->EditData($update_data,$cond,'crm_sales_return');

        echo json_encode($data);

    }



    public function AddTab2()
    {
         
        if($_POST)
        {

	        if(!empty($_POST['srp_prod_det']))
			{
			    $count =  count($_POST['srp_prod_det']);
					
				if($count!=0)
			    {  
					for($j=0;$j<=$count-1;$j++)
					{
							
					    $insert_data  	= array(  
							
							'srp_prod_det'     =>  $_POST['srp_prod_det'][$j],
							'srp_unit'         =>  $_POST['srp_unit'][$j],
						    'srp_quantity'     =>  $_POST['srp_quantity'][$j],
                            'srp_rate'         =>  $_POST['srp_rate'][$j],
                            'srp_discount'     =>  $_POST['srp_discount'][$j],
                            'srp_amount'       =>  $_POST['srp_amount'][$j],
                            'srp_sales_return' =>  $_POST['srp_sales_return'],
                          
					    );

				        $this->common_model->InsertData('crm_sales_return_prod_det',$insert_data);
                      
				    } 
				}

                   
			}

			
        }
        

    }
    


    public function AddTab3()
    {
        $cond = array('sr_id' => $this->request->getPost('sr_id'));
        $update_data = $this->request->getPost();

        if (array_key_exists('sr_id', $update_data)) {
            unset($update_data['sr_id']);
        }

       
        // Handle file upload
        if (isset($_FILES['sr_invoice_sale_return']) && $_FILES['sr_invoice_sale_return']['name'] !== '') {
            $CreditInvoiceFileName = $this->uploadFile('sr_invoice_sale_return', 'uploads/SaleReturn');
            $update_data['sr_invoice_sale_return'] = $CreditInvoiceFileName;
        }

        $this->common_model->EditData($update_data, $cond, 'crm_sales_return');
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
        $cond = array('so_customer' => $this->request->getPost('ID'));
        
        $sales_orders = $this->common_model->FetchWhere('crm_sales_orders',$cond);
        
        $data['sales_order'] ="";

        $data['sales_order'] ='<option value="" selected disabled>Select Sales Order Number</option>';

        foreach($sales_orders as $sales_order)
        {
            $data['sales_order'] .='<option value='.$sales_order->so_id.'';
           
            $data['sales_order'] .='>' .$sales_order->so_order_no. '</option>'; 
        }


        $cond1 = array('dn_customer' => $this->request->getPost('ID'));

        $delivery_note = $this->common_model->FetchWhere('crm_delivery_note',$cond1);
        
        $data['delivery_note'] ="";

        $data['delivery_note'] = '<option value="" selected disabled>Select Delivery Note No</option>'; 
        
        foreach($delivery_note as $del_note)
        {
            $data['delivery_note'] .='<option value='.$del_note->dn_id.'';
           
            $data['delivery_note'] .='>' .$del_note->dn_reffer_no. '</option>'; 
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
        $cond = array('sr_id' => $this->request->getPost('ID'));
 
        $this->common_model->DeleteData('crm_sales_return',$cond);


        $cond1 = array('srp_sales_return' => $this->request->getPost('ID'));
 
        $this->common_model->DeleteData('crm_sales_return_prod_det',$cond1);
 
         
     }





        public function FetchSalesData()
        {
            $cond = array('cci_id' => $this->request->getPost('ID'));

            $credit_invoice = $this->common_model->SingleRow('crm_credit_invoice',$cond);

            $charts_of_accounts = $this->common_model->FetchAllOrder('accounts_charts_of_accounts','ca_id','desc');
            
            $data['sales_account_output'] = '';

            foreach($charts_of_accounts as $chart_account)
            {
                
                $data['sales_account_output'] .='<option value='.$chart_account->ca_id.'';
                if($chart_account->ca_id  == $credit_invoice->cci_sales_account){
                $data['sales_account_output'] .=    " selected ";}
                $data['sales_account_output'] .='>' .$chart_account->ca_name. '</option>'; 
            }
            
            $sales_orders = $this->common_model->FetchAllOrder('crm_sales_orders','so_id','desc');
            
            $data['sales_order_output'] ='';

            foreach($sales_orders as $sale_order)
            {
                $data['sales_order_output'] .='<option value='.$sale_order->so_id.'';
                if($sale_order->so_id  == $credit_invoice->cci_sales_order){
                $data['sales_order_output'] .=    " selected ";}
                $data['sales_order_output'] .='>' .$sale_order->so_order_no. '</option>'; 
            }

            $data['cci_lpo_reff'] = $credit_invoice->cci_lpo_reff;

            

            $cond1 = array('ipd_credit_invoice' => $this->request->getPost('ID'));

            $product_details = $this->common_model->FetchWhere('crm_credit_invoice_prod_det',$cond1);

            //$products = $this->common_model->FetchAllOrder('crm_products','product_id','desc');

            $products = $this->common_model->FetchAllOrder('crm_products','product_id','desc');
            
            $data['sales_prod_det'] = '';

            $data['sales_prod_det'] .= '
                <table class="table table-bordered table-striped delTable">
                    <tbody class="travelerinfo">
                        <tr>
                            <td>Serial No.</td>
                            <td>Product Details</td>
                            <td>Unit</td>
                            <td>Quantity</td>
                            <td>Rate</td>
                            <td>Discount(%)</td>
                            <td>Amount</td>
                            <td>Action</td>
                        </tr>';

                        $i = 1;
                        foreach ($product_details as $prod_det) {
                            $data['sales_prod_det'] .= "
                                <tr class='prod_row' id='{$prod_det->ipd_id}'>
                                    <td>$i</td>
                                    <td>
                                        <select class='form-select' name='srp_prod_det[]' required>";
                                        foreach ($products as $prod) 
                                        {
                                            $data['sales_prod_det'] .= "<option value='{$prod->product_id}'";
                                            if ($prod->product_id == $prod_det->ipd_prod_detl) {
                                                $data['sales_prod_det'] .= " selected";
                                            }
                                            $data['sales_prod_det'] .= ">{$prod->product_details}</option>";
                                        }

                                        $data['sales_prod_det'] .= "
                                        </select>
                                    </td>
                                    <td><input type='text' name='srp_unit[]' value='{$prod_det->ipd_unit}' class='form-control' required></td>
                                    <td><input type='number' name='srp_quantity[]' value='{$prod_det->ipd_quantity}' class='form-control qtn_clz_id' required></td>
                                    <td><input type='number' name='srp_rate[]' value='{$prod_det->ipd_rate}' class='form-control rate_clz_id' required></td>
                                    <td><input type='number' name='srp_discount[]' value='{$prod_det->ipd_discount}' class='form-control discount_clz_id' required></td>
                                    <td><input type='number' name='srp_amount[]' value='{$prod_det->ipd_amount}' class='form-control amount_clz_id' required></td>
                                    <td class='row_remove' data-id='{$prod_det->ipd_id}'><i class='ri-close-line'></i>Remove</td>
                                
                                </tr>";
                                $i++;
                            }

                          

                            $data['sales_prod_det'] .= '</tbody>
                                                            <tbody class="product-more" class="travelerinfo"></tbody></table>
                                                            <div class="edit_add_more_div"><span class="edit_add_more add_product"><i class="ri-add-circle-line"></i>Add More</span></div>';
        
                                                        
            echo json_encode($data);
            $i++;
        }


        //delete contact details
        public function DeleteContact()
        {
            //$cond = array('pp_id' => $this->request->getPost('ID'));
 
           // $this->common_model->DeleteData('crm_proforma_product',$cond);

        }

     
    


}
