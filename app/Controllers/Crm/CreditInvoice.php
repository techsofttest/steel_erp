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
       
        $searchColumns = array('cci_reffer_no','cc_customer_name');

        ##Joins if any //Pass Joins as Multi dim array
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
           
        );

        $totalRecordwithFilter = $this->common_model->GetTotalRecordwithFilter('crm_credit_invoice','cci_id',$searchValue,$searchColumns,'',$joins);
    
        
        ## Fetch records
        $records = $this->common_model->GetRecord('crm_credit_invoice','cci_id',$searchValue,$searchColumns,$columnName,$columnSortOrder,$joins,$rowperpage,$start);
    
        $data = array();

        $i=1;
        foreach($records as $record ){
            $action = '<a  href="javascript:void(0)" data-id="'.$record->cci_id.'"  class="view view-color view_btn" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-fill"></i></a>
            <a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="Edit"  data-id="'.$record->cci_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i></a>
            <a href="javascript:void(0)" data-id="'.$record->cci_id.'"  class="print_color" title="Preview"><i class="ri-file-pdf-2-line " aria-hidden="true"></i></a>
            <a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->cci_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i></a>';
           
           $data[] = array( 
              'cci_id'            => $i,
              'cci_reffer_no'     => $record->cci_reffer_no,
              'cci_date'          => date('d-M-Y',strtotime($record->cci_date)),
              'cci_customer'      => $record->cc_customer_name,
              'cci_sales_order'   => $record->so_reffer_no,
              'cci_total_amount'  => format_currency($record->cci_total_amount),
              'action'            => $action,
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

        $data['total_count'] = count($data['result']);

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
        
        $data['status_invoice'] = $this->common_model->FetchAllOrder('master_status_invoice','msi_id','desc');

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


    public function CreditAccount()
    {

        $page= !empty($_GET['page']) ? $_GET['page'] : 0;
        $term = !empty($_GET['term']) ? $_GET['term'] : "";
        $resultCount = 10;
        $end = ($page - 1) * $resultCount;       
        $start = $end + $resultCount;
      
        $data['result'] = $this->common_model->FetchAllLimit('accounts_charts_of_accounts','ca_name','asc',$term,$start,$end);

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
         
        if(empty($this->request->getPost('cci_id')))
        {   
            //$uid = $this->common_model->FetchNextId('crm_credit_invoice',"CRN");
            
           // $credit_invoices = $this->common_model->FetchWhere('steel_accounts_receipts',array('cci_reffer_no' => $this->request->getPost('cci_reffer_no')));

            //if(empty($credit_invoices))
            //{
                $uid = $this->FetchReference("r");

                $insert_data = [

                    'cci_reffer_no'      => $uid,
        
                    'cci_date'           => date('Y-m-d',strtotime($this->request->getPost('cci_date'))),
        
                    'cci_customer'       => $this->request->getPost('cci_customer'),
        
                    'cci_sales_order'    => $this->request->getPost('cci_sales_order'),
        
                    'cci_lpo_reff'       => $this->request->getPost('cci_lpo_reff'),
        
                    'cci_contact_person' => $this->request->getPost('cci_contact_person'),
        
                    'cci_payment_term'   => $this->request->getPost('cci_payment_term'),
        
                    'cci_project'        => $this->request->getPost('cci_project'),
        
                    'cci_total_amount'   => $this->request->getPost('cci_total_amount'),
        
                    'cci_credit_account' => $this->request->getPost('ci_credit_account'),

                    'cci_advance_amount' => $this->request->getPost('cci_advance_amount'),
        
                    'cci_added_by'       => 0,
        
                    'cci_added_date'   => date('Y-m-d'),
        
                ];

                $credit_invoice_id = $this->common_model->InsertData('crm_credit_invoice',$insert_data);
            //}


        }
        else
        {
            $update_data = [

                'cci_reffer_no'      => $this->request->getPost('cci_reffer_no'),
    
                'cci_date'           => date('Y-m-d',strtotime($this->request->getPost('cci_date'))),
    
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

            
            $credit_invoice_data = $this->common_model->SingleRow('crm_credit_invoice',array('cci_id' => $credit_invoice_id));

            //Add To Transactions
    
            $credit_trans_data['tran_reference'] = $credit_invoice_data->cci_reffer_no;

            $credit_trans_data['tran_account'] = $credit_invoice_data->cci_credit_account;

            $credit_trans_data['tran_credit'] = $credit_invoice_data->cci_total_amount;

            $credit_trans_data['tran_type'] = "Credit Invoice";

            $this->common_model->InsertData('master_transactions',$credit_trans_data);
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
                    $delivery_note = $this->common_model->SingleRow('crm_delivery_note',array('dn_reffer_no' => $_POST['ipd_delivery'][$j]));
                    
                    $contact_detail  	= array(  

                        'ipd_prod_detl'        =>  $_POST['ipd_prod_detl'][$j],
                        'ipd_unit'             =>  $_POST['ipd_unit'][$j],
                        'ipd_quantity'         =>  $_POST['ipd_quantity'][$j],
                        'ipd_rate'             =>  $_POST['ipd_rate'][$j],
                        'ipd_discount'         =>  $_POST['ipd_discount'][$j],
                        'ipd_amount'           =>  $_POST['ipd_amount'][$j],
                        'ipd_prod_id'          =>  $_POST['sales_order_product'][$j],
                        'ipd_delivery_prod_id' =>  $_POST['delivery_prod_id'][$j],
                        'ipd_credit_invoice'   =>  $credit_invoice_id,
                        'ipd_delivery_id'      =>  $delivery_note->dn_id,
    
                    );
                
                    
                    $id = $this->common_model->InsertData('crm_credit_invoice_prod_det',$contact_detail);

                    $this->common_model->EditData(array('ipd_reffer_no'=> "CRNP00".$id),array('ipd_id'=> $id),'crm_credit_invoice_prod_det');

                    
                    $this->common_model->EditData(array('cci_delivery_id'=>$_POST['delivery_id'][$j]),array('cci_id'=>$credit_invoice_id),'crm_credit_invoice');
                   
                    
                    $cond = array('dpd_id' => $_POST['delivery_prod_id'][$j]);

                    $update_data1 = array('dpd_invoice_flag' => 1);

                    $this->common_model->EditData($update_data1,$cond,'crm_delivery_product_details');
    
                    //$pod_data1 = $this->common_model->FetchWhere('crm_sales_product_details',array('spd_sales_order' => $_POST['sales_order'][$j]));
                    
                    //$pod_data2 = $this->common_model->CheckTwiceCond1('crm_sales_product_details',array('spd_sales_order' => $_POST['sales_order'][$j]),array('spd_deliver_flag' => 1));
                        
                    $delivery_data = $this->common_model->SingleRow('crm_delivery_product_details',array('dpd_id' => $_POST['delivery_prod_id'][$j]));
                   
                    $pod_data1 = $this->common_model->FetchWhere('crm_delivery_product_details',array('dpd_sales_ref_id' => $delivery_data->dpd_sales_ref_id));
                    
                    $pod_data2 = $this->common_model->CheckTwiceCond1('crm_delivery_product_details',array('dpd_sales_ref_id' => $delivery_data->dpd_sales_ref_id),array('dpd_invoice_flag' => 1));
                   
                    if(count($pod_data1) == count($pod_data2))
                    {
                        $update_data3 = array('so_credit_status' => 1);

                        $this->common_model->EditData($update_data3,array('so_id' => $_POST['sales_order'][$j]),'crm_sales_orders');
                    }
 
  
                } 
            }

            //
            $credit_inv_data = $this->common_model->SingleRow('crm_credit_invoice',array('cci_id' => $credit_invoice_id));
            
           

            $charts_of_accounts = $this->common_model->SingleRow('accounts_charts_of_accounts',array('ca_customer' => $credit_inv_data->cci_customer));
            
            

            $receipts = $this->common_model->FetchWhere('steel_accounts_receipts',array('r_debit_account' => $charts_of_accounts->ca_id));
            
            if(!empty($_POST['print_btn']))
            {
                
                //$data['print'] =  base_url() . 'Crm/CreditInvoice/Pdf/' . urlencode($credit_invoice_id);

                $data['print'] =  $credit_invoice_id;

            }

            $data['adjustment_data'] = "";

            if(!empty($receipts))
            {

                foreach($receipts as $receipt)
                {
                    $data['adjustment_data'] .= "
                    <tr>
                        <td>1</td>
                        <td><input type='date' name='' value='".$receipt->r_date."' class='form-control' readonly></td>
                        <td><input type='text' name='' value='".$receipt->r_ref_no."' class='form-control' readonly></td>
                        <td><input type='text' name='' value='".$receipt->r_amount."' class='form-control' readonly></td>
                        <td><input type='text' name='' value='' class='form-control' required></td>
                        <td><input type='checkbox' name='' value='' class='' required></td>
                    </tr>
                    ";
                }

                $data['advance_status'] = "true";
            }
            else
            {
                $data['advance_status'] = "false";
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

            $data['contact_person']    = $credit_invoice->contact_person;

            $data['total_amount'] = '<tr>
               
                <td align="right" class="total_label">Total</td>
                <td class=""><input type="text" value="'.format_currency($credit_invoice->cci_total_amount).'" class="form-control text-end" readonly></td>
                
            </tr><tr>
               
                <td align="right" class="total_label">Advance Amount</td>
                <td class=""><input type="text" value="'.format_currency($credit_invoice->cci_advance_amount).'" class="form-control text-end" readonly></td>
                
            </tr>';

            //product section 
            
            $joins1 = array(
                array(
                    'table' => 'crm_products',
                    'pk'    => 'product_id',
                    'fk'    => 'ipd_prod_detl',
                ),
                array(
                    'table' => 'crm_delivery_note',
                    'pk'    => 'dn_id',
                    'fk'    => 'ipd_delivery_id',
                ),
    
            );

            $delivery_prod_details = $this->common_model->FetchWhereJoin('crm_credit_invoice_prod_det', array('ipd_credit_invoice' => $this->request->getPost('ID')),$joins1);
            
            $i=1;

            $data['product_detail'] ="";
            foreach($delivery_prod_details as $delivery_prod){
                $data['product_detail'] .='<tr class="prod_row delivery_note_remove" id="'.$delivery_prod->ipd_id.'">
                                                
                                                <td class="si_no">'.$i.'</td>
                                                <td class="text-center">'.$delivery_prod->dn_reffer_no.'</td>
                                                <td style="text-align:left;">'.$delivery_prod->product_details.'</td>
                                                <td class="text-center">'.$delivery_prod->ipd_unit.'</td>
                                                <td class="text-center">'.format_currency($delivery_prod->ipd_quantity).'</td>
                                                <td class="text-end">'.format_currency($delivery_prod->ipd_rate).'</td>
                                                <td class="text-center">'.format_currency($delivery_prod->ipd_discount).'</td>
                                                <td class="text-end">'.format_currency($delivery_prod->ipd_amount).'</td>
                                              
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
        $cond = array('so_customer' => $this->request->getPost('ID'));

        $cond3 = array('so_credit_status'=>0);

        $sales_orders = $this->common_model->FetchCreditSales('crm_sales_orders',$cond,$cond3);

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

            'cci_date'           => date('Y-m-d',strtotime($this->request->getPost('cci_date'))),

            'cci_customer'       => $this->request->getPost('cci_customer'),

            'cci_lpo_reff'       => $this->request->getPost('cci_lpo_reff'),

            'cci_contact_person' => $this->request->getPost('cci_contact_person'),

            'cci_payment_term'   => $this->request->getPost('cci_payment_term'),

            'cci_project'        => $this->request->getPost('cci_project'),

            //'cci_total_amount'   => $this->request->getPost('cci_total_amount'),

            'cci_credit_account' => $this->request->getPost('ci_credit_account'),


        ];


        
        $this->common_model->EditData($update_data, array('cci_id' => $this->request->getPost('cci_id')), 'crm_credit_invoice');
    
       
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


        $cond = array('cci_id' => $this->request->getPost('ID'));

        $credit_invoice = $this->common_model->SingleRow('crm_credit_invoice', $cond);

        $sales_return = $this->common_model->fetchWhere('crm_sales_return',array('sr_invoice' => $credit_invoice->cci_reffer_no));
        
        if(empty($sales_return))
        {  
            
            $credit_invoice_prod = $this->common_model->FetchWhere('crm_credit_invoice_prod_det',array('ipd_credit_invoice' => $credit_invoice->cci_id));
             
            foreach($credit_invoice_prod as $credit_inv_prod)
            {
                $this->common_model->EditData(array('dpd_invoice_flag' => 0),array('dpd_id'=>$credit_inv_prod->ipd_delivery_prod_id),'crm_delivery_product_details');
            }
            
            $this->common_model->EditData(array('so_credit_status' => 0),array('so_id' => $credit_invoice->cci_sales_order),'crm_sales_orders');
            
            $this->common_model->DeleteData('crm_credit_invoice',$cond);

            $this->common_model->DeleteData('master_transactions',array('tran_reference'=> $credit_invoice->cci_reffer_no));
            
            $cond1 = array('ipd_credit_invoice' => $credit_invoice->cci_id);
     
            $this->common_model->DeleteData('crm_credit_invoice_prod_det',$cond1);

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
            $cond = array('so_id' => $sales_id = $this->request->getPost('ID'));

            $sales_order = $this->common_model->SingleRow('crm_sales_orders',$cond);

            $data['so_lpo'] = $sales_order->so_lpo;

            $data['so_contact_person'] = $sales_order->so_contact_person;

            $data['so_project'] = $sales_order->so_project;

            $data['so_payment_term'] = $sales_order->so_payment_term;

            $cond2 = array('contact_customer_creation' => $this->request->getPost('custID'));

            $contact_details = $this->common_model->FetchWhere('crm_contact_details',$cond2);

            $data['sales_order_advance'] = $this->common_model->FetchSum('accounts_receipts_sales_orders','rso_receipt_amount',array('rso_sales_order' => $sales_id,'rso_status' => 0));


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

            
                
                if(!empty($delivery_notes)){

                    foreach($delivery_notes as $del_note){

                        /* orginal one = <td>
                        <select class="form-select ipd_prod_detl " required>';
                                    
                        foreach($products as $prod){
                            $data['product_detail'] .='<option value="'.$prod->product_id.'"'; 
                            if($prod->product_id == $del_note->dpd_prod_det){ $data['product_detail'] .= "selected"; }
                            $data['product_detail'] .='>'.$prod->product_details.'</option>';
                            }
                        $data['product_detail'] .= '</select>
                    </td>*/

                    /*$data_selected_prod = '<td>
                    <select class="form-select ipd_prod_detl " required>';
                                
                    foreach($products as $prod){
                        $data['product_detail'] .='<option value="'.$prod->product_id.'"'; 
                        if($prod->product_id == $del_note->dpd_prod_det){ $data['product_detail'] .= "selected"; }
                        $data['product_detail'] .='>'.$prod->product_details.'</option>';
                        }
                    $data['product_detail'] .= '</select>
                </td>';*/

                /*$data_selected_prod = '
                <select class="form-select ipd_prod_detl " required>';
                            
                foreach($products as $prod){
                    $data_selected_prod  .='<option value="'.$prod->product_id.'"'; 
                    if($prod->product_id == $del_note->dpd_prod_det){ $data_selected_prod  .= "selected"; }
                    $data_selected_prod  .='>'.$prod->product_details.'</option>';
                    }
                    $data_selected_prod  .= '</select>
            ';*/

            
		 $options_product = '<option value="'.$del_note->product_id.'" selected>'.$del_note->product_details.'</option>';
        
                                
                   


                        $data['product_detail'] .='<tr class="prod_row " id="'.$del_note->dn_id.'" style="text-align:center">
                                                        <td class="si_no text-center">'.$i.'</td>
                                                        <td class="product_select2_edit" style="text-align: left !important;">'.$options_product.' </td>
                                                        <td style="padding: 0px !important;">'.$del_note->dn_reffer_no.'</td>
                                                        <td><input type="text"  value="'.$del_note->dpd_current_qty	.'" class="form-control text-center" required></td>
                                                        <td><input type="checkbox" name="product_select[]" id="'.$del_note->dpd_id.'"  onclick="handleCheckboxChange(this)" class="prod_checkmark text-center"></td>
                                                      
                                                    </tr>';
                                                        $i++;
                    }

                    $data["prod_status"] = "true" ;

                }
                else
                {
                    $cond3 = array('cci_id' => $this->request->getPost('CreditInvoiceID'));
 
                    $this->common_model->DeleteData('crm_credit_invoice',$cond3);

                    $data["prod_status"] = "false" ;
                }

            

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

            $data['total_amount'] = '<tr>
                
                <td align="right" class="total_label">Total</td>
                <td><input type="text" value="'.format_currency($credit_invoice->cci_total_amount).'" class="form-control text-end" readonly></td>
                
            </tr>
            <tr>
                
                <td align="right" class="total_label">Advance Amount</td>
                <td><input type="text" value="'.format_currency($credit_invoice->cci_advance_amount).'" class="form-control text-end" readonly></td>
                
            </tr>
            ';
        


            // customer craetion
            $customer_creation = $this->common_model->FetchAllOrder('crm_customer_creation','cc_id','desc');

            $data['customer'] ="";
            foreach($customer_creation as $cus_creation)
            {
                if ($cus_creation->cc_id  == $credit_invoice->cci_customer)
                {
                    $data['customer'] .= '<option value="' .$cus_creation->cc_id.'"'; 
                    // Check if the current product head is selected
                    $data['customer'] .= ' selected'; 
                    $data['customer'] .= '>' . $cus_creation->cc_customer_name .'</option>';

                }

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

            //$contact_data   = $this->common_model->FetchAllOrder('crm_contact_details','contact_id','desc');

            $contact_data = $this->common_model->FetchWhere('crm_contact_details',array('contact_customer_creation'=>$credit_invoice->cci_customer));


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
                array(
                    'table' => 'crm_delivery_note',
                    'pk'    => 'dn_id',
                    'fk'    => 'ipd_delivery_id',
                ),
    
            );

            $delivery_prod_details = $this->common_model->FetchWhereJoin('crm_credit_invoice_prod_det', array('ipd_credit_invoice' => $this->request->getPost('ID')),$joins1);
            
            // $products = $this->common_model->FetchAllOrder('crm_products', 'product_id', 'desc');

            $i=1;

            $data['product_detail'] ="";
            foreach($delivery_prod_details as $delivery_prod){
                $data['product_detail'] .='<tr class="prod_row delivery_note_remove" id="'.$delivery_prod->ipd_id.'">
                                                <td class="si_no  text-center">'.$i.'</td>
                                                <td class="text-center">'.$delivery_prod->dn_reffer_no.'</td>
                                                <td style="text-align:left;">'.$delivery_prod->product_details.'</td>
                                                <td class"text-center">'.$delivery_prod->ipd_unit.'</td>
                                                <td class="text-center">'.format_currency($delivery_prod->ipd_quantity).'</td>
                                                <td class="text-end">'.format_currency($delivery_prod->ipd_rate).'</td>
                                                <td class="text-center">'.format_currency($delivery_prod->ipd_discount).'</td>
                                                <td class="text-end">'.format_currency($delivery_prod->ipd_amount).'</td>
                                                
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

                    $multipleValue = $sales_det->spd_rate * $sales_det->dpd_current_qty;

                    $perAmount = ($sales_det->spd_discount/100) * $multipleValue;

                    $orginalPrice = $multipleValue - $perAmount;

                    $amount = number_format((float)$orginalPrice, 2, '.', '');  // Outputs -> 105.00

                    
                    /*<select class="form-select ser_product_det" name="ipd_prod_detl[]" required>';
                    foreach($products as $prod){
                        $data['product_detail'] .='<option value="'.$prod->product_id.'"'; 
                        if($prod->product_id == $sales_det->spd_product_details){ $data['product_detail'] .= "selected"; }
                        $data['product_detail'] .='>'.$prod->product_details.'</option>';
                        }
                $data['product_detail'] .= '</select>*/

                    $options_products = '<option value="'.$sales_det->product_id.'" selected>'.$sales_det->product_details.'</option>';
                    

                    $data['product_detail'] .='<tr class="prod_row delivery_note_remove" id="'.$sales_det->spd_id.'">
                                                    <td class="si_no"><input type="text" name="ipd_delivery[]" value ="'.$sales_det->dn_reffer_no.'" class="form-control  text-center" readonly></td>
                                                    <td style="text-align: left;">
                                                        <select class="form-select ser_product_det product_select2_edit" name="ipd_prod_detl[]" required>'.$options_products.'</select>
                                                    </td>
                                                    <td><input type="text" name="ipd_unit[]" value="'.$sales_det->spd_unit.'" class="form-control  text-center" readonly></td>
                                                    <td><input type="number" name="ipd_quantity[]" value="'.$sales_det->dpd_current_qty.'"  class="form-control order_qty  text-center" readonly></td>
                                                    <td><input type="number" name="ipd_rate[]" value="'.$sales_det->spd_rate.'"  class="form-control delivery_qty  text-end" readonly ></td>
                                                    <td><input type="number" name="ipd_discount[]"  value="'.$sales_det->spd_discount.'" class="form-control current_delivery  text-center" readonly></td>
                                                    <td><input type="number" name="ipd_amount[]"  value="'.$amount.'" class="form-control amount_clz_id  text-end" readonly></td>
                                                    <input type ="hidden" name="delivery_prod_id[]" value="'.$sales_det->dpd_id.'">
                                                    <input type ="hidden" name="delivery_id[]" value="'.$sales_det->dpd_delivery_id.'">
                                                    <input type ="hidden" name="sales_order[]" value="'.$sales_det->dn_sales_order_num.'">
                                                    <input type ="hidden" name="sales_order_product[]" value="'.$sales_det->spd_id.'">
                                                </tr>';
                                                    
                                                    } $i++;
            }

            // Output JSON encoded data
            echo json_encode($data);
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

            $uid = $this->common_model->FetchNextId('crm_credit_invoice','cci_reffer_no',"CRINV-{$year}-",$year);

            if($type=="e")
            echo $uid;
            else
            {
            return $uid;
            }

        }


        public function EditProduct()
        {
            $cond = array('ipd_id' => $this->request->getPost('ID'));

            $prod_det = $this->common_model->SingleRow('crm_credit_invoice_prod_det',$cond);

            $products = $this->common_model->FetchAllOrder('crm_products','product_id','desc');

            $data['prod_details'] ="";
            
                $data['prod_details'] .='<tr class="edit_prod_row">
                <td>1</td>
            
                <td><select class="form-select droup_product" name="ipd_prod_detl" required>';
                        
                    foreach($products as $prod){
                        $data['prod_details'] .='<option value="'.$prod->product_id.'" '; 
                        if($prod->product_id == $prod_det->ipd_prod_detl){ $data['prod_details'] .= "selected"; }
                        $data['prod_details'] .='>'.$prod->product_details.'</option>';
                    }
						
            $data['prod_details'] .='</select></td>

            <td><input type="text" name="ipd_unit"  value="'.$prod_det->ipd_unit.'" class="form-control " required></td>
            <td> <input type="text" name="ipd_quantity" value="'.$prod_det->ipd_quantity.'" class="form-control edit_prod_qty" required></td>
            <td> <input type="text" name="ipd_rate" value="'.$prod_det->ipd_rate.'" class="form-control edit_prod_rate" required></td>
            <td> <input type="text" name="ipd_discount" value="'.$prod_det->ipd_discount.'" class="form-control edit_prod_discount" required></td>
            <td> <input type="text" name="ipd_amount" value="'.$prod_det->ipd_amount.'" class="form-control edit_prod_amount" readonly></td>
           <input type="hidden" name="ipd_id" class="edit_prod_id" value="'.$prod_det->ipd_id.'">
           </tr>'; 

            echo json_encode($data); 
        }


        public function UpdateProduct()
        {   
            $cond = array('ipd_id' => $this->request->getPost('ipd_id'));
    
            $update_data = $this->request->getPost();
    
            if (array_key_exists('ipd_id', $update_data)) 
            {
                unset($update_data['ipd_id']);
            }    
            
            $this->common_model->EditData($update_data,$cond,'crm_credit_invoice_prod_det');
    
            $prod_det = $this->common_model->SingleRow('crm_credit_invoice_prod_det',$cond);
            
            $data['credit_invoice'] = $prod_det->ipd_credit_invoice;
    
    
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
                        'fk'    => 'ipd_prod_detl',
                    ),
                   
                );

                $product_details = $this->common_model->FetchWhereJoin('crm_credit_invoice_prod_det',array('ipd_credit_invoice'=>$id),$joins1);
                    
                
                $pdf_data = "";
                $k =1;
                foreach($product_details as $prod_det)
                {   
                    $rate = format_currency($prod_det->ipd_rate);

                    $amount = format_currency($prod_det->ipd_amount);
    
                    $disc = number_format($prod_det->ipd_discount, 2);


                    $pdf_data .= '<tr><td align="center">'.$k.'</td>';

                    $pdf_data .= '<td align="left">'.$prod_det->product_details.'</td>';

                    $pdf_data .= '<td align="center">'.$prod_det->ipd_quantity.'</td>';

                    $pdf_data .= '<td align="center">'.$prod_det->ipd_unit.'</td>';

                    $pdf_data .= '<td align="right">'.$rate.'</td>';

                    $pdf_data .= '<td align="center" style="color: red";><i>'.$disc.'</i></td>';

                    $pdf_data .= '<td align="right">'.$amount.'</td></tr>';

                $k++;
                }

                $join =  array(
                    
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
                

                $credit_invoice = $this->common_model->SingleRowJoin('crm_credit_invoice',array('cci_id'=>$id),$join);

                $joins1 = array(

                    array(
                        'table' => 'master_country',
                        'pk'    => 'country_id',
                        'fk'    => 'cc_country',
                    ),
                    
                );
    
                $customers = $this->common_model->SingleRowJoin('crm_customer_creation',array('cc_id' => $credit_invoice->cci_customer),$joins1);
                
                $credit_prod = $this->common_model->SingleRow('crm_credit_invoice_prod_det',array('ipd_credit_invoice'=>$id));

                $credit_prod_id = $credit_prod->ipd_delivery_prod_id;

                $delivery_prod_id = $this->common_model->SingleRow('crm_delivery_product_details',array('dpd_id' =>$credit_prod_id));

                //$delivery_reffer_id = $this->common_model->SingleRow('crm_delivery_note',array('dn_id' =>$delivery_prod_id->dpd_delivery_id));

                $delivery_reffer_id = $this->common_model->FetchWhere('crm_delivery_note',array('dn_id' =>$delivery_prod_id->dpd_delivery_id));

                $del_data = [];

               foreach($delivery_reffer_id as $del_reff){
                

                      // $del_data .= "'.$del_reff->dn_reffer_no.'";

                    $del_data[]  =  $del_reff->dn_reffer_no;
               }

               $del_data_string = implode(", ", $del_data); 

                 
                $date = date('d-M-Y',strtotime($credit_invoice->cci_date));

                $title = 'CRN - '.$credit_invoice->cci_reffer_no;

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
            
            
                <table width="100%" style="margin-top:60px;">
                
                <tr width="100%">
                <td width="9%"></td>
                <td >Date : '.$date.'</td>
                <td>'.$credit_invoice->cci_reffer_no.'</td>
                <td align="right"><h2>Credit Note</h2></td>
            
                </tr>
            
                </table>

            <table  width="100%" style="margin-top:2px;border-top:1px solid;">
        
                <tr>
                
                    <td > </td>
                    
                    <td >'.$credit_invoice->cc_customer_name.'</td>
                
                </tr>
        
        
            <tr>
            
            <td>Customer</td>
            
                
            <td >Tel : '.$credit_invoice->cc_telephone.', Fax : '.$credit_invoice->cc_fax.', Email : '.$credit_invoice->cc_email.'</td>
            
            </tr>
        
        
            <tr>
            
            <td ></td>
            
            <td >Post Box : '.$credit_invoice->cc_post_box.' , '.$customers->country_name.'</td>
            
            </tr>
        
        
            <tr>
            
            <td >Attention</td>
            
            <td > '.$credit_invoice->contact_person.' - '.$credit_invoice->contact_designation.', Mobile:-'.$credit_invoice->contact_mobile.', Email: - '.$credit_invoice->contact_email.'</td>
            
            </tr>
        
        
            </table>
    
               
            
            <table  width="100%" style="margin-top:2px;border-collapse: collapse; border-spacing: 0;border-top:1px solid;line-height: 18px;">
                
            
                <tr>
                
                    <th align="center" style="border-bottom:1px solid;" width="8%">Item No</th>
                
                    <th align="center" style="border-bottom:1px solid;" width="47%">Description</th>
                
                    <th align="center" style="border-bottom:1px solid;">Qty</th>
                
                    <th align="center" style="border-bottom:1px solid;">Unit</th>
                
                    <th align="center" style="border-bottom:1px solid;">Rate</th>
        
                    <th align="center" style="border-bottom:1px solid;">Disc%</th>
        
                    <th align="center" style="border-bottom:1px solid;">Amount</th>
        
                
                </tr>


                '.$pdf_data.'
    
                 
                
            </table>';
            
            $footer = '
        
                <table style="border-bottom:1px solid;width:100%">
                
                    <tr>
                        <td></td>

                        <td>IBAN : QA97CBQA000000004570407137001</td>

                        <td style="font-weight: bold;width: 18%;">Total Invoice value</td>
            
                        <td>'.format_currency($credit_invoice->cci_total_amount).'</td>
                    
                        
                
                    </tr>
    
                    <tr>
        
                        <td>Bank Details</td>
                    
                        <td>Commercial Bank of Qatar, Industrial Area Branch, Doha - Qatar</td>

                    
                    </tr>


                    <tr>
        
                        <td></td>
                    
                        <td>SWIFT : CBQAQAQA</td>
                       
                        <td></td>
            
                        <td></td>
                    
                    </tr>
    
    
                    <tr>
        
                        <td>Amount in words</td>
                    
                        <td style="width: 60%;">'.currency_to_words($credit_invoice->cci_total_amount).'</td>
            
                        
                    
                    </tr>
    
                </table>
    
    
               <table>
               
                    <tr>
                        <td style="width:15%">Invoice Terms</td>

                        <td style="width:15%">LPO Ref</td>

                        <td style="width:30%">'.$credit_invoice->cci_lpo_reff.'</td>

                       <td style="width:10%">Payment:</td>

                        <td>'.$credit_invoice->cci_payment_term.'</td>
                    
                    </tr>


                    <tr>
                        
                        <td style="width:15%"></td>
                        <td style="width:15%">Project:</td>
                        <td style="width:30%">'.$credit_invoice->cci_project.'</td>
                        <td style="width:10%">Invoice:</td>
                        <td>'.$credit_invoice->cci_reffer_no.'</td>
                    
                    </tr>


                    <tr>
                        
                        <td style="width:15%"></td>
                        <td style="width:15%">Sales Order:</td>
                        <td style="width:30%">'.$credit_invoice->so_reffer_no.'</td>
                        <td style="width:10%">DN No:</td>
                        <td>'.$del_data_string.'</td>
                
                    </tr>
                
               </table>
    
    
                <table style="border-top:1px solid;">
    
                <tr>
                
                    <td><i>Received by: </i></td>

                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    
                    <td><i>Prepared by:</i></td>

                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    
                    <td><i>Finance Dept:</i></td>

                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    
                    <td><i>Workshop Manager</i></td>
    
                  
    
                </tr>
    
                
                </table>';
            
                //echo $html . $footer;

                $mpdf->WriteHTML($html);
                $mpdf->SetFooter($footer);
                $this->response->setHeader('Content-Type', 'application/pdf');
                $mpdf->Output($title . '.pdf', 'I');
            
            }
    
           
        }
        

    


}
