<?php

namespace App\Controllers\Crm;

use App\Controllers\BaseController;


class CreditInvoice extends BaseController
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
       
        $totalRecords = $this->common_model->GetTotalRecords('crm_credit_invoice','cci_id','DESC');
 
        ## Total number of records with filtering
       
        $searchColumns = array('cci_reffer_no');

        $totalRecordwithFilter = $this->common_model->GetTotalRecordwithFilter('crm_credit_invoice','cci_id',$searchValue,$searchColumns);
    
        ##Joins if any //Pass Joins as Multi dim array
        $joins = array(
            array(
                'table' => 'crm_customer_creation',
                'pk'    => 'cc_id',
                'fk'    => 'cci_customer',
            ),
           
        );
        ## Fetch records
        $records = $this->common_model->GetRecord('crm_credit_invoice','cci_id',$searchValue,$searchColumns,$columnName,$columnSortOrder,$joins,$rowperpage,$start);
    
        $data = array();

        $i=1;
        foreach($records as $record ){
            $action = '<a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->cci_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a><a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->cci_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> Delete</a><a  href="javascript:void(0)" data-id="'.$record->cci_id.'"  class="view view-color view_btn" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a>';
           
           $data[] = array( 
              'cci_id'         => $i,
              'cci_reffer_no'  => $record->cci_reffer_no,
              'cci_date'       => date('d-m-Y',strtotime($record->cci_date)),
              'cci_customer'   => $record->cc_customer_name,
              'action'         => $action,
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

        $data['charts_of_accounts'] = $this->common_model->FetchAllOrder('accounts_charts_of_accounts','ca_id','desc');
        
        $data['status_invoice'] = $this->common_model->FetchAllOrder('master_status_invoice','msi_id','desc');

        $data['credit_invoice_id'] = $this->common_model->FetchNextId('crm_credit_invoice','CINV'); 

        $data['content'] = view('crm/credit-invoice',$data);

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

            'cci_reffer_no'      => $this->request->getPost('cci_reffer_no'),

            'cci_date'           => $this->request->getPost('cci_date'),

            'cci_customer'       => $this->request->getPost('cci_customer'),

            'cci_sales_order'    => $this->request->getPost('cci_sales_order'),

            'cci_lpo_reff'       => $this->request->getPost('cci_lpo_reff'),

            'cci_contact_person' => $this->request->getPost('cci_contact_person'),

            'cci_payment_term'   => $this->request->getPost('cci_payment_term'),

            'cci_project'        => $this->request->getPost('cci_project'),

            'cci_total_amount'   => $this->request->getPost('cci_total_amount'),

            'cci_added_by'       => 0,

            'cci_added_date'   => date('Y-m-d'),
 
        ];

        $credit_invoice_id = $this->common_model->InsertData('crm_credit_invoice',$insert_data);

        if(!empty($_POST['ipd_prod_detl']))
		{
            $count =  count($_POST['ipd_prod_detl']);
                
            if($count!=0)
            {  
                for($j=0;$j<=$count-1;$j++)
                {
                        
                    $contact_detail  	= array(  

                        'ipd_prod_detl'      =>  $_POST['ipd_prod_detl'][$j],
                        'ipd_unit'           =>  $_POST['ipd_unit'][$j],
                        'ipd_quantity'       =>  $_POST['ipd_quantity'][$j],
                        'ipd_rate'           =>  $_POST['ipd_rate'][$j],
                        'ipd_discount'       =>  $_POST['ipd_discount'][$j],
                        'ipd_amount'         =>  $_POST['ipd_amount'][$j],
                        'ipd_credit_invoice' =>  $credit_invoice_id,
    
                    );
                
                    
                    $id = $this->common_model->InsertData('crm_credit_invoice_prod_det',$contact_detail);
            
                } 
            }
		} 


    }



    public function AddTab2()
    {
         
        if($_POST)
        {

	        if(!empty($_POST['ipd_prod_detl']))
			{
			    $count =  count($_POST['ipd_prod_detl']);
					
				if($count!=0)
			    {  
					for($j=0;$j<=$count-1;$j++)
					{
							
					    $insert_data  	= array(  
							
							'ipd_delivery_note'  =>  $_POST['ipd_delivery_note'][$j],
							'ipd_prod_detl'      =>  $_POST['ipd_prod_detl'][$j],
						    'ipd_unit'           =>  $_POST['ipd_unit'][$j],
                            'ipd_quantity'       =>  $_POST['ipd_quantity'][$j],
                            'ipd_rate'           =>  $_POST['ipd_rate'][$j],
                            'ipd_discount'       =>  $_POST['ipd_discount'][$j],
                            'ipd_amount'         =>  $_POST['ipd_amount'][$j],
                            'ipd_credit_invoice' =>  $_POST['ipd_credit_invoice'],
                          
					    );

				        $this->common_model->InsertData('crm_credit_invoice_prod_det',$insert_data);
                      
				    } 
				}

                   
			}

			
        }
        

    }
    


    public function AddTab3()
    {
        $cond = array('cci_id' => $this->request->getPost('cci_id'));
        $update_data = $this->request->getPost();

        if (array_key_exists('cci_id', $update_data)) {
            unset($update_data['cci_id']);
        }

       
        // Handle file upload
        if (isset($_FILES['cci_signed_credit']) && $_FILES['cci_signed_credit']['name'] !== '') {
            $CreditInvoiceFileName = $this->uploadFile('cci_signed_credit', 'uploads/CreditInvoice');
            $update_data['cci_signed_credit'] = $CreditInvoiceFileName;
        }

        $this->common_model->EditData($update_data, $cond, 'crm_credit_invoice');
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
           
            $data['sales_order'] .='>' .$sales_order->so_reffer_no. '</option>'; 
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


        /*contact person */

        $cond2 = array('contact_customer_creation' => $this->request->getPost('ID'));

        $contact_details = $this->common_model->FetchWhere('crm_contact_details',$cond2);
    
        $data['contact_person'] = "<option value ='' selected disabled>Select Contact Person</option>";
    
        foreach($contact_details as $con_det)
        {
            
            $data['contact_person'] .= '<option value=' .$con_det->contact_id;
          
            $data['contact_person'] .= '>' . $con_det->contact_person . '</option>';
    
            
        }


        /*#####*/


        


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
        $cond = array('cci_id' => $this->request->getPost('ID'));
 
        $this->common_model->DeleteData('crm_credit_invoice',$cond);


        $cond1 = array('ipd_credit_invoice' => $this->request->getPost('ID'));
 
        $this->common_model->DeleteData('crm_credit_invoice_prod_det',$cond1);
 
         
     }





        public function FetchSalesData()
        {
            $cond = array('so_id' => $this->request->getPost('ID'));

            $sales_order = $this->common_model->SingleRow('crm_sales_orders',$cond);

            $data['so_lpo'] = $sales_order->so_lpo;

            $data['so_contact_person'] = $sales_order->so_contact_person;

            $data['so_project'] = $sales_order->so_project;

            $data['so_payment_term'] = $sales_order->so_payment_term;

            $cond2 = array('contact_customer_creation' => $this->request->getPost('custID'));

            $contact_details = $this->common_model->FetchWhere('crm_contact_details',$cond2);

            $data['contact_person'] = "<option value ='' selected disabled>Select Contact Person</option>";

            foreach($contact_details as $con_det)
            {
                
                $data['contact_person'] .= '<option value=' .$con_det->contact_id;
                if ($con_det->contact_id == $sales_order->so_contact_person)
                {
                    $data['contact_person'] .= ' selected';
                }
                $data['contact_person'] .= '>' . $con_det->contact_person . '</option>';

                
            }



            /*product detail start*/

            $cond3 = array('spd_sales_order' => $this->request->getPost('ID'));

            $sales_order_details = $this->common_model->FetchWhere('crm_sales_product_details',$cond3);
        
            $products = $this->common_model->FetchAllOrder('crm_products','product_id','desc');

            $i = 1; 
            
            $data['product_detail'] = "";

            foreach($sales_order_details as $sales_det){

            $data['product_detail'] .='<tr class="prod_row credit_invoice_remove" id="'.$sales_det->spd_id.'">
                                            <td class="si_no">'.$i.'</td>
                                            <td>
                                                <select class="form-select ser_product_det" name="ipd_prod_detl[]" required>';
                                                            
                                                foreach($products as $prod){
                                                    $data['product_detail'] .='<option value="'.$prod->product_id.'"'; 
                                                    if($prod->product_id == $sales_det->spd_product_details){ $data['product_detail'] .= "selected"; }
                                                    $data['product_detail'] .='>'.$prod->product_details.'</option>';
                                                    }
                                                $data['product_detail'] .= '</select>
                                            </td>
                                            <td><input type="text" name="ipd_unit[]" value="'.$sales_det->spd_unit.'" class="form-control" required></td>
                                            <td><input type="number" name="ipd_quantity[]" value="'.$sales_det->spd_quantity.'"  class="form-control qtn_clz_id" required></td>
                                            <td><input type="number" name="ipd_rate[]" value="'.$sales_det->spd_rate.'"  class="form-control rate_clz_id"  required></td>
                                            <td><input type="number" name="ipd_discount[]" value="'.$sales_det->spd_discount.'" class="form-control discount_clz_id" required></td>
                                            <td><input type="number" name="ipd_amount[]" value="'.$sales_det->spd_amount.'" class="form-control amount_clz_id" required></td>
                                            <td class="row_remove remove-btnpp" data-id="'.$sales_det->spd_id.'"><i class="ri-close-line"></i>Remove</td>
                                            
                                        </tr>';
                                        $i++;
								}


            /*####*/







            /*$cond3 = array('so_id' => $delivery_note->dn_sales_order_num);
            
            $sales_orders = $this->common_model->SingleRow('crm_sales_orders',$cond3);

            $data['dn_lpo_reference'] = $delivery_note->dn_lpo_reference;

            $data['dn_conact_person'] = $delivery_note->dn_conact_person;

            $data['dn_project'] = $delivery_note->dn_project;

            $cond1 = array('dn_id' => $this->request->getPost('ID'));

            $sales_order_details = $this->common_model->FetchWhere('crm_delivery_note',$cond1);

            $products = $this->common_model->FetchAllOrder('crm_products','product_id','desc');*/

            echo json_encode($data);

        }


      
     
    


}
