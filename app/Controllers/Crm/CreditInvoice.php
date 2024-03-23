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
        if(empty($this->request->getPost('cci_id')))
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
    
                'cci_credit_account' => $this->request->getPost('ci_credit_account'),
    
                'cci_added_by'       => 0,
    
                'cci_added_date'   => date('Y-m-d'),
     
            ];

            $credit_invoice_id = $this->common_model->InsertData('crm_credit_invoice',$insert_data);
        }
        else
        {
            $update_data = [

                'cci_reffer_no'      => $this->request->getPost('cci_reffer_no'),
    
                'cci_date'           => $this->request->getPost('cci_date'),
    
                'cci_customer'       => $this->request->getPost('cci_customer'),
    
                'cci_sales_order'    => $this->request->getPost('cci_sales_order'),
    
                'cci_lpo_reff'       => $this->request->getPost('cci_lpo_reff'),
    
                'cci_contact_person' => $this->request->getPost('cci_contact_person'),
    
                'cci_payment_term'   => $this->request->getPost('cci_payment_term'),
    
                'cci_project'        => $this->request->getPost('cci_project'),
    
                'cci_total_amount'   => $this->request->getPost('cci_total_amount'),
    
                'cci_credit_account' => $this->request->getPost('ci_credit_account'),
    
                'cci_added_by'       => 0,
    
                'cci_added_date'   => date('Y-m-d'),
     
            ];

            $this->common_model->EditData($update_data, array('cci_id' => $this->request->getPost('cci_id')), 'crm_credit_invoice');
            
            $credit_invoice_id = $this->request->getPost('cci_id');
        }
        

        $credit_invoice_data = $this->common_model->SingleRow('crm_credit_invoice',array('cci_id' => $credit_invoice_id));

        $data['sales_order'] = $credit_invoice_data->cci_sales_order; 

        $data['credit_invoice_id'] = $credit_invoice_id;

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

                    $cond = array('dpd_id' => $_POST['delivery_prod_id'][$j]);

                    $update_data1 = array('dpd_invoice_flag' => 1);

                    $this->common_model->EditData($update_data1,$cond,'crm_delivery_product_details');

                    $cond2 = array('dn_sales_order_num' => $_POST['sales_order'][$j]);
                    
                    $joins = array(
            
                        array(
                            'table' => 'crm_delivery_note',
                            'pk'    => 'dn_id',
                            'fk'    => 'dpd_delivery_id',
                        ),
        
                    );

                    $delivery_note_prod = $this->common_model->FetchWhereJoin('crm_delivery_product_details',$cond2,$joins);

                    $cond3 =  array('dpd_invoice_flag' => 1);

                    $delivery_note_prod1 =  $this->common_model->CheckTwiceCond1('crm_delivery_product_details',$cond2,$cond3);
                    
                    if(count($delivery_note_prod)  == count($delivery_note_prod1))
                    {   

                        $update_data2 = array('dn_invoice_flag' => 1);
                        
                        $this->common_model->EditData($update_data2,array('dn_id' => $credit_invoice_id),'crm_delivery_note');
                       
                    }
                    else
                    {
                      
                    }

                } 
            }
		}


        echo json_encode($data);


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
        
        $cond = array('cci_id' => $this->request->getPost('ID'));

            $joins = array(
            
                array(
                    'table' => 'crm_customer_creation',
                    'pk'    => 'cc_id',
                    'fk'    => 'cci_customer',
                ),

                array(
                    'table' => 'crm_sales_orders',
                    'pk'    => 'so_id',
                    'fk'    => 'cci_sales_order',
                ),
                array(
                    'table' => 'crm_contact_details',
                    'pk'    => 'contact_id',
                    'fk'    => 'cci_contact_person',
                ),

                array(
                    'table' => 'accounts_charts_of_accounts',
                    'pk'    => 'ca_id',
                    'fk'    => 'cci_credit_account',
                ),

            );

            $credit_invoice = $this->common_model->SingleRowJoin('crm_credit_invoice',$cond,$joins);

            $data['reffer_no']         = $credit_invoice->cci_reffer_no;

            $data['date']              = date('d-M-Y',strtotime($credit_invoice->cci_date));

            $data['lpo_reff']          = $credit_invoice->cci_lpo_reff;

            $data['sales_order']       = $credit_invoice->so_reffer_no;

            $data['payment_term']      = $credit_invoice->cci_payment_term;

            $data['project']           = $credit_invoice->cci_project;

            $data['credit_invoice_id'] = $credit_invoice->cci_id;

            $data['customer']          = $credit_invoice->cc_customer_name;

            $data['charts_account']    = $credit_invoice->ca_name;

            $data['sales_order']       = $credit_invoice->cci_sales_order;

            $data['contact_person']    = $credit_invoice->contact_person;

            //product section 
            
            $joins1 = array(
                array(
                    'table' => 'crm_products',
                    'pk'    => 'product_id',
                    'fk'    => 'ipd_prod_detl',
                ),
    
            );

            $delivery_prod_details = $this->common_model->FetchWhereJoin('crm_credit_invoice_prod_det', array('ipd_credit_invoice' => $this->request->getPost('ID')),$joins1);
            
            $i=1;

            $data['product_detail'] ="";
            foreach($delivery_prod_details as $delivery_prod){
                $data['product_detail'] .='<tr class="prod_row delivery_note_remove" id="'.$delivery_prod->ipd_id.'">
                                                <td class="si_no">'.$i.'</td>
                                                <td>'.$delivery_prod->product_details.'</td>
                                                <td>'.$delivery_prod->ipd_unit.'</td>
                                                <td>'.$delivery_prod->ipd_quantity.'</td>
                                                <td>'.$delivery_prod->ipd_rate.'</td>
                                                <td>'.$delivery_prod->ipd_discount.'</td>
                                                <td>'.$delivery_prod->ipd_amount.'</td>
                                              
                                            </tr>';
                                                    $i++;

                                                    }

          

           

            //image section start
            
            /*$data['image_table']="";

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
            }*/

            echo json_encode($data);
    }


    public function SalesOrder()
    {
        $cond = array('dn_customer' => $this->request->getPost('ID'));
        
        //$sales_orders = $this->common_model->FetchWhere('crm_sales_orders',$cond);

        $joins = array(
            
            array(
                'table' => 'crm_sales_orders',
                'pk'    => 'so_id',
                'fk'    => 'dn_sales_order_num',
            ),
        );

        $sales_orders = $this->common_model->FetchDataByGroup('crm_delivery_note','dn_sales_order_num',$cond,$joins);
        
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
        $cond = array('cci_id' => $this->request->getPost('cci_id'));

        $delivery_note = $this->common_model->SingleRow('crm_credit_invoice',$cond);

        $update_data = [

            'cci_date'           => $this->request->getPost('cci_date'),

            'cci_customer'       => $this->request->getPost('cci_customer'),


            'cci_lpo_reff'       => $this->request->getPost('cci_lpo_reff'),

            'cci_contact_person' => $this->request->getPost('cci_contact_person'),

            'cci_payment_term'   => $this->request->getPost('cci_payment_term'),

            'cci_project'        => $this->request->getPost('cci_project'),

            'cci_total_amount'   => $this->request->getPost('cci_total_amount'),

            'cci_credit_account' => $this->request->getPost('ci_credit_account'),


        ];


        
        $this->common_model->EditData($update_data, array('cci_id' => $this->request->getPost('cci_id')), 'crm_credit_invoice');
    
       
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



            echo json_encode($data);

        }


        public function AddProduct()
        {
            $cond1 = array('dn_sales_order_num' => $this->request->getPost('ID'));

            $cond2 = array('dpd_invoice_flag' => 0);

            //$sales_order_details = $this->common_model->FetchProd('crm_sales_product_details',$cond1,array('spd_deliver_flag'=>0));
            
            $joins = array(
                array(
                    'table' => 'crm_delivery_product_details',
                    'pk'    => 'dpd_delivery_id',
                    'fk'    => 'dn_id',
                ),
    
            );



            $delivery_notes = $this->common_model->FetchCreditProd('crm_delivery_note',$cond1,$cond2,$joins);


            $products = $this->common_model->FetchAllOrder('crm_products','product_id','desc');

            $i = 1; 
            
            $data['product_detail'] ="";

            foreach($delivery_notes as $del_note){
                $data['product_detail'] .='<tr class="prod_row " id="'.$del_note->dn_id.'">
                                                <td class="si_no">'.$i.'</td>
                                                <td>
                                                    <select class="form-select ipd_prod_detl" required>';
                                                                
                                                    foreach($products as $prod){
                                                        $data['product_detail'] .='<option value="'.$prod->product_id.'"'; 
                                                        if($prod->product_id == $del_note->dpd_prod_det){ $data['product_detail'] .= "selected"; }
                                                        $data['product_detail'] .='>'.$prod->product_details.'</option>';
                                                        }
                                                    $data['product_detail'] .= '</select>
                                                </td>
                                                    <td><input type="text"  value="'.$del_note->dn_reffer_no.'" class="form-control" required></td>
                                                    <td><input type="checkbox" name="product_select[]" id="'.$del_note->dpd_id.'"  onclick="handleCheckboxChange(this)" class="prod_checkmark"></td>
                                                   
                                                    
                                                </tr>';
                                                $i++;
            }

            echo json_encode($data);
                      

        }


        public function Edit()
        {
            $cond = array('cci_id' => $this->request->getPost('ID'));

            $joins = array(
            
                array(
                    'table' => 'crm_customer_creation',
                    'pk'    => 'cc_id',
                    'fk'    => 'cci_customer',
                ),

                array(
                    'table' => 'crm_sales_orders',
                    'pk'    => 'so_id',
                    'fk'    => 'cci_sales_order',
                ),
                array(
                    'table' => 'crm_contact_details',
                    'pk'    => 'contact_id',
                    'fk'    => 'cci_contact_person',
                ),

            );

            $credit_invoice = $this->common_model->SingleRowJoin('crm_credit_invoice',$cond,$joins);

            $data['reffer_no']         = $credit_invoice->cci_reffer_no;

            $data['date']              = date('d-M-Y',strtotime($credit_invoice->cci_date));

            $data['lpo_reff']          = $credit_invoice->cci_lpo_reff;

            $data['sales_order']       = $credit_invoice->so_reffer_no;

            $data['payment_term']      = $credit_invoice->cci_payment_term;

            $data['project']           = $credit_invoice->cci_project;

            $data['credit_invoice_id'] = $credit_invoice->cci_id;


            // customer craetion
            $customer_creation = $this->common_model->FetchAllOrder('crm_customer_creation','cc_id','desc');

            $data['customer'] ="";
            foreach($customer_creation as $cus_creation)
            {
                $data['customer'] .= '<option value="' .$cus_creation->cc_id.'"'; 
            
                // Check if the current product head is selected
                if ($cus_creation->cc_id  == $credit_invoice->cci_customer)
                {
                    $data['customer'] .= ' selected'; 
                }
            
                $data['customer'] .= '>' . $cus_creation->cc_customer_name .'</option>';

            }


            //credit account
            $charts_of_account = $this->common_model->FetchAllOrder('accounts_charts_of_accounts','ca_id','desc');

            $data['charts_account'] ="";
            foreach($charts_of_account as $charts_account)
            {
                $data['charts_account'] .= '<option value="' .$charts_account->ca_id.'"'; 
            
                // Check if the current product head is selected
                if ($charts_account->ca_id  == $credit_invoice->cci_credit_account)
                {
                    $data['charts_account'] .= ' selected'; 
                }
            
                $data['charts_account'] .= '>' . $charts_account->ca_name .'</option>';

            }

            /**/


             //sales orders
             $sales_orders = $this->common_model->FetchAllOrder('crm_sales_orders','so_id','desc');
             

            //contact person

            $contact_data   = $this->common_model->FetchAllOrder('crm_contact_details','contact_id','desc');

            $data['contact_person'] ="";

            foreach($contact_data as $cont_data)
            {
                $data['contact_person'] .= '<option value="' .$cont_data->contact_id .'"'; 
            
                // Check if the current product head is selected
                if ($cont_data->contact_id   == $credit_invoice->cci_contact_person)
                {
                    $data['contact_person'] .= ' selected'; 
                }
            
                $data['contact_person'] .= '>' . $cont_data->contact_person.'</option>';
            }

            $joins1 = array(
                array(
                    'table' => 'crm_products',
                    'pk'    => 'product_id',
                    'fk'    => 'ipd_prod_detl',
                ),
    
            );

            $delivery_prod_details = $this->common_model->FetchWhereJoin('crm_credit_invoice_prod_det', array('ipd_credit_invoice' => $this->request->getPost('ID')),$joins1);
            
           // $products = $this->common_model->FetchAllOrder('crm_products', 'product_id', 'desc');

            $i=1;

            $data['product_detail'] ="";
            foreach($delivery_prod_details as $delivery_prod){
                $data['product_detail'] .='<tr class="prod_row delivery_note_remove" id="'.$delivery_prod->ipd_id.'">
                                                <td class="si_no">'.$i.'</td>
                                                <td>'.$delivery_prod->product_details.'</td>
                                                <td>'.$delivery_prod->ipd_unit.'</td>
                                                <td>'.$delivery_prod->ipd_quantity.'</td>
                                                <td>'.$delivery_prod->ipd_rate.'</td>
                                                <td>'.$delivery_prod->ipd_discount.'</td>
                                                <td>'.$delivery_prod->ipd_amount.'</td>
                                              
                                            </tr>';
                                                    $i++;

                                                    }

            //image section start
            
            /*$data['image_table']="";

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
            }*/

            echo json_encode($data);

        }


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
                $cond = array('dpd_id' => $number);

                $joins = array(
                
                    array(
                            'table' => 'crm_sales_product_details',
                            'pk'    => 'spd_id',
                            'fk'    => 'dpd_so_id',
                    ),
                    array(
                        'table' => 'crm_delivery_note',
                        'pk'    => 'dn_id',
                        'fk'    => 'dpd_delivery_id',
                    ),
                    array(
                        'table' => 'crm_products',
                        'pk'    => 'product_id',
                        'fk'    => 'dpd_prod_det',
                    )
                );

                $sales_order_details = $this->common_model->FetchWherejoin('crm_delivery_product_details',$cond,$joins);
                $products = $this->common_model->FetchAllOrder('crm_products', 'product_id', 'desc');

                foreach($sales_order_details as $sales_det){
                    $data['product_detail'] .='<tr class="prod_row delivery_note_remove" id="'.$sales_det->spd_id.'">
                                                    <td class="si_no">'.$sales_det->dn_reffer_no.'</td>
                                                    <td>
                                                        <select class="form-select ser_product_det" name="ipd_prod_detl[]" required>';
                                                            foreach($products as $prod){
                                                                $data['product_detail'] .='<option value="'.$prod->product_id.'"'; 
                                                                if($prod->product_id == $sales_det->spd_product_details){ $data['product_detail'] .= "selected"; }
                                                                $data['product_detail'] .='>'.$prod->product_details.'</option>';
                                                                }
                                                        $data['product_detail'] .= '</select>
                                                    </td>
                                                    <td><input type="text" name="ipd_unit[]" value="'.$sales_det->spd_unit.'" class="form-control" readonly></td>
                                                    <td><input type="number" name="ipd_quantity[]" value="'.$sales_det->spd_quantity.'"  class="form-control order_qty" readonly></td>
                                                    <td><input type="number" name="ipd_rate[]" value="'.$sales_det->spd_rate.'"  class="form-control delivery_qty" readonly ></td>
                                                    <td><input type="number" name="ipd_discount[]"  value="'.$sales_det->spd_discount.'" class="form-control current_delivery" readonly></td>
                                                    <td><input type="number" name="ipd_amount[]"  value="'.$sales_det->spd_amount.'" class="form-control amount_clz_id" readonly></td>
                                                    <input type ="hidden" name="delivery_prod_id[]" value="'.$sales_det->dpd_id.'">
                                                    <input type ="hidden" name="sales_order[]" value="'.$sales_det->dn_sales_order_num.'">
                                                </tr>';
                                                    
                                                    } $i++;
            }

            // Output JSON encoded data
            echo json_encode($data);
        }

        


      
     
    


}
