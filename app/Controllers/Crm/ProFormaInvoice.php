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
       
        $searchColumns = array('pf_uid');

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
            $action = '<a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->pf_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a><a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->pf_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> Delete</a><a  href="javascript:void(0)" data-id="'.$record->pf_id.'"  class="view view-color view_btn" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a>';
           
           $data[] = array( 
              'pf_id'           => $i,
              'pf_uid'          => $record->pf_uid,
              'pf_date'         => date('d-m-Y',strtotime($record->pf_date)),
              'pf_customer'     => $record->cc_customer_name,
              'pf_sales_order'  => $record->so_order_no,
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

        if (array_key_exists('pf_total_cost', $insert_data)) 
        {
             unset($update_data['pf_total_cost']);
        } 

        $insert_data['pf_added_by'] = 0; 

        $insert_data['pf_added_on'] = date('Y-m-d'); 

        $id = $this->common_model->InsertData('crm_proforma_invoices',$insert_data);

        $data['pf_id'] = $id;

        $p_ref_no = 'PINV'.str_pad($id, 7, '0', STR_PAD_LEFT);
        
        $cond = array('pf_id' => $id);

        $update_data['pf_uid'] = $p_ref_no;

        $this->common_model->EditData($update_data,$cond,'crm_proforma_invoices');

        echo json_encode($data);

    }

    public function AddTab2()
    {
         

        if($_POST){

	        if(!empty($_POST['pp_product_det']))
			{
			    $count =  count($_POST['pp_product_det']);
					
				if($count!=0)
			    {  
					for($j=0;$j<=$count-1;$j++)
					{
							
					    $insert_data  	= array(  
							
							'pp_product_det'   =>   $_POST['pp_product_det'][$j],
							'pp_unit'           =>  $_POST['pp_unit'][$j],
						    'pp_quantity'       =>  $_POST['pp_quantity'][$j],
                            'pp_rate'           =>  $_POST['pp_rate'][$j],
                            'pp_discount'       =>  $_POST['pp_discount'][$j],
                            'pp_amount'         =>  $_POST['pp_amount'][$j],
                            'pp_current_claim'  =>  $_POST['pp_current_claim'][$j],
                            'pp_proforma'       =>  $_POST['pp_proforma'],
	  
					    );

				         $this->common_model->InsertData('crm_proforma_product',$insert_data);
                      
                        
				
				    } 
				}

                   
			}


            $cond = array('pf_id' => $_POST['pp_proforma']);

            $update_data['pf_total_cost'] = $_POST['pf_total_cost'];

            $this->common_model->EditData($update_data,$cond,'crm_proforma_invoices');
			
			
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
         $cond = array('at_id' => $this->request->getPost('ID'));
 
         $this->common_model->DeleteData('accounts_account_types',$cond);
 
         
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
           $data['saleorder_output'] .= '</tbody><tbody id="product-more" class="travelerinfo"></tbody><tr><td colspan="9" style="text-align: center;"><span id="total_cost_id"></span></td></tr></table><div class="edit_add_more_div"><span class="edit_add_more add_product"><i class="ri-add-circle-line"></i>Add More</span></div><input type="hidden" name="pp_proforma" class="pf_id_clz"><input type="hidden" name="pf_total_cost">';
        
        
            echo json_encode($data);

        }


        //delete contact details
        public function DeleteContact()
        {
            //$cond = array('pp_id' => $this->request->getPost('ID'));
 
           // $this->common_model->DeleteData('crm_proforma_product',$cond);

        }

     
    


}
