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
            array(
                'table' => 'crm_sales_orders',
                'pk'    => 'so_id',
                'fk'    => 'ci_sales_order',
            ),
           
        );
        ## Fetch records
        $records = $this->common_model->GetRecord('crm_cash_invoice','ci_id',$searchValue,$searchColumns,$columnName,$columnSortOrder,$joins,$rowperpage,$start);
    
        $data = array();

        $i=1;
        foreach($records as $record ){
            $action = '<a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->ci_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i></a><a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->ci_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i></a><a  href="javascript:void(0)" data-id="'.$record->ci_id.'"  class="view view-color view_btn" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i></a>
            <a href="javascript:void(0)" data-id="'.$record->ci_id.'" class="print_color" title="Preview"><i class="ri-file-pdf-2-line " aria-hidden="true"></i></a>
            ';
           
           $data[] = array( 
              'ci_id'           => $i,
              'ci_reffer_no'    => $record->ci_reffer_no,
              'ci_date'         => date('d-M-Y',strtotime($record->ci_date)),
              'ci_customer'     => $record->cc_customer_name,
              'ci_sales_order'  => $record->so_reffer_no,
              'ci_total_amount' => $record->ci_total_amount,
              'ci_paid_amount'  => $record->ci_paid_amount,
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
        $data['customer_creation']   = $this->common_model->FetchAllOrder('crm_customer_creation','cc_id','desc');

        $data['sales_executive']     = $this->common_model->FetchAllOrder('executives_sales_executive','se_id','desc');
        
        $data['products']            = $this->common_model->FetchAllOrder('crm_products','product_id','desc');

        $data['employees']           = $this->common_model->FetchAllOrder('employees','employees_id','desc');

        $data['charts_of_accounts']  = $this->common_model->FetchAllOrder('accounts_charts_of_accounts','ca_id','desc');

        $data['customer_creation']   = $this->common_model->FetchAllOrder('crm_customer_creation','cc_id','desc');
        
        $data['cash_invoice']        = $this->common_model->FetchAllOrder('master_cash_invoice_status','cis_id ','desc');
        
       

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

        //$this->request->getPost('spd_sales_order');

        $data['print'] = "";
       
        if(empty($this->request->getPost('ci_id')))
        {
            //$uid = $this->common_model->FetchNextId('crm_cash_invoice',"CIN");

            $cash_invoice_data = $this->common_model->FetchWhere('crm_cash_invoice',array('ci_reffer_no' => $this->request->getPost('ci_reffer_no')));

            if(empty($cash_invoice_data))
            {

                $insert_data = [

                    'ci_reffer_no'       => $this->request->getPost('ci_reffer_no'),

                    'ci_date'            => date('Y-m-d',strtotime($this->request->getPost('ci_date'))),

                    'ci_customer'        => $this->request->getPost('ci_customer'),

                    'ci_sales_order'     => $this->request->getPost('ci_sales_order'),

                    'ci_lpo_reff'        => $this->request->getPost('ci_lpo_reff'),

                    'ci_contact_person'  => $this->request->getPost('ci_contact_person'),

                    'ci_payment_term'    => $this->request->getPost('ci_payment_term'),

                    'ci_project'         => $this->request->getPost('ci_project'),

                    'ci_credit_account'  => $this->request->getPost('ci_credit_account'),

                    'ci_addded_by'       => 0,

                    'ci_added_date'      => date('Y-m-d'),

                    'ci_paid_status'     => 0,

                ];

                if (isset($_FILES['ci_file']) && $_FILES['ci_file']['name'] !== '') {
                        
                    // Upload the new image
                    $attachFileName = $this->uploadFile('ci_file', 'uploads/CashInvoice');

                
                    // Update the data with the new image filename
                    $insert_data['ci_file'] = $attachFileName;
        
                }

            

                $cash_invoice_id = $this->common_model->InsertData('crm_cash_invoice',$insert_data);

                $cash_invoice = $this->common_model->SingleRow('crm_cash_invoice',array('ci_id' => $cash_invoice_id));
                
                $data['sales_order'] = $cash_invoice->ci_sales_order;

                $data["cash_invoice"] = $cash_invoice_id;

                $data['status']  = "true";

            }
            else{

                $data['status']  = "false";
            }
            
           

        }
        else
        {   
            $cash_invoice_data = $this->common_model->CheckDataWhere('crm_cash_invoice','ci_reffer_no',trim($this->request->getPost('ci_reffer_no')),trim($this->request->getPost('ci_id')),'ci_id');
            
            if(empty($cash_invoice_data)){

                $update_data = [

                    'ci_reffer_no'       => $this->request->getPost('ci_reffer_no'),

                    'ci_date'            => date('Y-m-d',strtotime($this->request->getPost('ci_date'))),

                    'ci_customer'        => $this->request->getPost('ci_customer'),

                    'ci_sales_order'     => $this->request->getPost('ci_sales_order'),

                    'ci_lpo_reff'        => $this->request->getPost('ci_lpo_reff'),

                    'ci_contact_person'  => $this->request->getPost('ci_contact_person'),

                    'ci_payment_term'    => $this->request->getPost('ci_payment_term'),

                    'ci_project'         => $this->request->getPost('ci_project'),

                    'ci_credit_account'  => $this->request->getPost('ci_credit_account'),

                    'ci_total_amount'  => $this->request->getPost('ci_total_amount'),

                    'ci_advance_amount'  => $this->request->getPost('ci_advance_amount'),

                    'ci_paid_amount'  => $this->request->getPost('ci_advance_amount'),

                ];

                if (isset($_FILES['ci_file']) && $_FILES['ci_file']['name'] !== '') {
                    
                    // Upload the new image
                    $attachFileName = $this->uploadFile('ci_file', 'uploads/CashInvoice');
                
                    // Update the data with the new image filename
                    $update_data['ci_file'] = $attachFileName;
                }

                $this->common_model->EditData($update_data, array('ci_id' => $this->request->getPost('ci_id')), 'crm_cash_invoice');
                
                $cash_invoice_id = $this->request->getPost('ci_id');

                $cash_invoicess = $this->common_model->SingleRow('crm_cash_invoice',array('ci_id' => $cash_invoice_id));

                //Add To Transactions
        
                $credit_trans_data['tran_reference'] = $cash_invoicess->ci_reffer_no;

                $credit_trans_data['tran_account'] = $cash_invoicess->ci_credit_account;

                $credit_trans_data['tran_credit'] = $cash_invoicess->ci_total_amount;

                $credit_trans_data['tran_type'] = "Cash Invoice";

                $this->common_model->InsertData('master_transactions',$credit_trans_data);


                $cash_invoice = $this->common_model->SingleRow('crm_cash_invoice',array('ci_id' => $cash_invoice_id));

                $data['sales_order'] = $cash_invoice->ci_sales_order;

                $data["cash_invoice"] = $cash_invoice_id;


                if(!empty($_POST['cipd_unit']))
                {
                    $count =  count($_POST['cipd_unit']);
                        
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
                                'cipd_sales_prod'    =>  $_POST['cipd_sales_prod'][$j],
                                'cipd_cash_invoice'  =>  $cash_invoice_id,
                                
                            
                                
                            );

        
                            $product_insert = $this->common_model->InsertData('crm_cash_invoice_prod_det',$product_data);
        
                        
        
                            $this->common_model->EditData(array('cipd_reffer_no'=>"CINP00".$product_insert),array('cipd_id' => $product_insert),'crm_cash_invoice_prod_det');
        
        
                            //$update_data =  array('spd_delivered_qty' => $_POST['cipd_qtn'][$j]);
        
                            
                            $cond = array('spd_id' => $_POST['cipd_sales_prod'][$j]); 
                            
                            $sales_prod_old = $this->common_model->SingleRow('crm_sales_product_details',$cond);
        
                            $cash_invoice = $sales_prod_old->spd_cash_invoice + $_POST['cipd_qtn'][$j];
                            
                            $new_delivery_qty = $sales_prod_old->spd_delivered_qty + $_POST['cipd_qtn'][$j];
        
                            $update_data =  array('spd_delivered_qty' => $new_delivery_qty,'spd_cash_invoice' => $cash_invoice);
        
                            $this->common_model->EditData($update_data,$cond,'crm_sales_product_details');
        
                            $sales_prod = $this->common_model->SingleRow('crm_sales_product_details',$cond);
        
                            if($sales_prod->spd_quantity == $sales_prod->spd_delivered_qty)
                            {
                                $cond2 = array('spd_id' => $_POST['cipd_sales_prod'][$j]);
        
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
        
                            $pod_data1 = $this->common_model->FetchWhere('crm_sales_product_details',array('spd_sales_order' => $_POST['sales_order_id'][$j]));
                            
                            $pod_data2 = $this->common_model->CheckTwiceCond1('crm_sales_product_details',array('spd_sales_order' => $_POST['sales_order_id'][$j]),array('spd_deliver_flag' => 1));
                            
                            if(count($pod_data1) == count($pod_data2))
                            {
                                $update_data3 = array('so_credit_status' => 1);
        
                                $this->common_model->EditData($update_data3,array('so_id' => $_POST['sales_order_id'][$j]),'crm_sales_orders');
                            }
        
                        } 
                    }
                    
                    $cash_inv_data = $this->common_model->SingleRow('crm_cash_invoice',array('ci_id' => $cash_invoice_id));
        
                    $charts_of_accounts = $this->common_model->SingleRow('accounts_charts_of_accounts',array('ca_customer' => $cash_inv_data->ci_customer));
                    
                    //$receipts = $this->common_model->FetchWhere('steel_accounts_receipts',array('r_debit_account' => $charts_of_accounts->ca_id));
                    
                    //Update Receipt Advance 
                    $advance_cond = array('rso_sales_order' => $cash_inv_data->ci_sales_order);

                    $advance_data = array('rso_remarks' => "Adjusted - ".$cash_inv_data->ci_reffer_no,'rso_status' => 1);

                    $this->common_model->EditData($advance_data,$advance_cond,'accounts_receipts_sales_orders');

                    if(!empty($_POST['print_btn']))
                    {
                        
                        $data['print'] =  base_url() . 'Crm/CashInvoice/Pdf/' . urlencode($cash_invoice_id);

                        //$data['print'] =  $cash_invoice_id;
        
                    }
        
                
                    /*
        
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
        
                        $data['advance_status'] ="true"; 
                    }
                    else
                    {
                        $data['advance_status'] ="false"; 
                    }
                    */
            
                }

                $data['status'] = "true";

            }

           
            else{

                $data['status'] = "false";
            }
            

        }
        

        echo json_encode($data);


    }




    //account head modal 
    public function View()
    {
        
        $cond = array('ci_id' => $this->request->getPost('ID'));

        $joins = array(
            
            array(
                'table' => 'crm_customer_creation',
                'pk'    => 'cc_id',
                'fk'    => 'ci_customer',
            ),

            array(
                'table' => 'crm_sales_orders',
                'pk'    => 'so_id',
                'fk'    => 'ci_sales_order',
            ),
            array(
                'table' => 'crm_contact_details',
                'pk'    => 'contact_id',
                'fk'    => 'ci_contact_person',
            ),
            array(
                'table' => 'accounts_charts_of_accounts',
                'pk'    => 'ca_id',
                'fk'    => 'ci_credit_account',
            ),

        );

        $cash_invoice = $this->common_model->SingleRowJoin('crm_cash_invoice',$cond,$joins);

        
        $data['reffer_no']      = $cash_invoice->ci_reffer_no;

        $data['date']           = date('d-M-Y',strtotime($cash_invoice->ci_date));

        $data['customer']       = $cash_invoice->cc_customer_name;

        $data['sales_order']    = $cash_invoice->so_reffer_no;

        $data['lpo_reff']       = $cash_invoice->ci_lpo_reff;

        $data['contact_person'] = $cash_invoice->contact_person;

        $data['payment_term']   = $cash_invoice->ci_payment_term;

        $data['project']        = $cash_invoice->ci_project;

        $data['credit_account'] = $cash_invoice->ca_name;

        $total_amount = format_currency($cash_invoice->ci_total_amount);

        $data['total_amount'] = '<tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Total</td>
            <td><input type="text" value="'.$total_amount.'" class="form-control text-end" readonly></td>
            
        </tr> ';

        //product table

        $cond1 = array('cipd_cash_invoice' => $this->request->getPost('ID'));

        $joins1 = array(
            array(
                'table' => 'crm_products',
                'pk'    => 'product_id',
                'fk'    => 'cipd_prod_det',
            ),

        );

        $product_details_data = $this->common_model->FetchWhereJoin('crm_cash_invoice_prod_det',$cond1,$joins1);
         

        $i=1;  

        $data['prod_details']= "";
        foreach($product_details_data as $prod_det)
        {   
            $rate = format_currency($prod_det->cipd_rate);

            $discount = format_currency($prod_det->cipd_discount);

            $amount  = format_currency($prod_det->cipd_amount);

            $data['prod_details'] .='<tr>
            <td>'.$i.'</td>
            <td style="width:40%"><input type="text" value="'.$prod_det->product_details.'" class="form-control " readonly></td>
            <td><input type="text" value="'.$prod_det->cipd_unit.'" class="form-control text-center" readonly></td>
            <td><input type="text" value="'.$prod_det->cipd_qtn.'" class="form-control text-center" readonly></td>
            <td><input type="text" value="'.$rate.'" class="form-control text-center" readonly></td>
            <td><input type="text" value="'.$discount.'" class="form-control text-center" readonly></td>
            <td><input type="text" value="'.$amount.'" class="form-control text-end" readonly></td>
            </tr>'; 
             $i++;
        }


        //image section start

        $data['image_table']="";

            if(!empty($cash_invoice->ci_file))
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
                                            <td class="cust_img_rgt_border view_file_name" >'. $cash_invoice->ci_file.'</td>
                                            <td class="cust_img_rgt_border view_file_attach"><a href="'.base_url('uploads/CashInvoice/' .$cash_invoice->ci_file).'" target="_blank">View</a></td>
                                        </tr>
                                    </tbody>
                                </table>';

            }
            




        //$data['enquiry_employees'] = $cash_invoice->employees_name;


         
        
        /*$data['prod_details'] ='<table  class="table table-bordered table-striped delTable"><tbody class="travelerinfo"><tr><td >
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
        
        $data['prod_details'] .= '</tbody></table>';*/


      
        
        echo json_encode($data);
    }


    public function SalesOrder()
    {
        
        //$sales_orders = $this->common_model->FetchSalesInCashInvoice($this->request->getPost('ID'));
        $cond = array('so_customer' => $this->request->getPost('ID')); 
        $sales_orders = $this->common_model->FetchSalesOrder('crm_sales_orders',$cond,array('so_deliver_flag'=>0));

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

        $cond3 = array('cc_id' => $this->request->getPost('ID'));

        $customer_creation = $this->common_model->SingleRow('crm_customer_creation',$cond3); 
        
        $data['credit_term'] = $customer_creation->cc_credit_term;
       
        echo json_encode($data);

    }


    // update account head 
    public function Update()
    {    
        $cash_invoice_data = $this->common_model->CheckDataWhere('crm_cash_invoice','ci_reffer_no',trim($this->request->getPost('ci_reffer_no')),trim($this->request->getPost('ci_id')),'ci_id');
         
        if(empty($cash_invoice_data))
        {
        
            $update_data = [
                
                'ci_reffer_no'       => $this->request->getPost('ci_reffer_no'),

                'ci_date'            => date('Y-m-d',strtotime($this->request->getPost('ci_date'))),

                'ci_customer'        => $this->request->getPost('ci_customer'),

                'ci_lpo_reff'        => $this->request->getPost('ci_lpo_reff'),

                'ci_contact_person'  => $this->request->getPost('ci_contact_person'),

                'ci_payment_term'    => $this->request->getPost('ci_payment_term'),

                'ci_project'         => $this->request->getPost('ci_project'),

            ];

            $this->common_model->EditData($update_data, array('ci_id' => $this->request->getPost('ci_id')), 'crm_cash_invoice');

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
        
        $cond = array('ci_id' => $this->request->getPost('ID'));

        $cash_invoice = $this->common_model->SingleRow('crm_cash_invoice',$cond);

        $sales_return = $this->common_model->fetchWhere('crm_sales_return',array('sr_invoice'=>$cash_invoice->ci_reffer_no));
        
        if(empty($sales_return))
        {
            $update_data = ['so_deliver_flag' => 0];

            $this->common_model->EditData($update_data, array('so_id' => $cash_invoice->ci_sales_order),'crm_sales_orders');
            
            $cash_invoice_id = $cash_invoice->ci_id;

            $cond2 = array('cipd_cash_invoice' => $cash_invoice_id);

            $joins = array(
                
                array(
                    'table' => 'crm_sales_product_details',
                    'pk'    => 'spd_id',
                    'fk'    => 'cipd_sales_prod',
                ),

            );

            $cash_product_det = $this->common_model->FetchWhereJoin('crm_cash_invoice_prod_det',$cond2,$joins);

            
            foreach($cash_product_det as $cash_prod_det)
            {   
                $sales_order_prod = $this->common_model->SingleRow('crm_sales_product_details',array('spd_id' => $cash_prod_det->cipd_sales_prod));

                if(!empty($sales_order_prod )){

                    $update_data1 = [

                        'spd_deliver_flag' => 0,

                        'spd_delivered_qty' => $sales_order_prod->spd_delivered_qty - $cash_prod_det->cipd_qtn,

                        'spd_cash_invoice' => $sales_order_prod->spd_delivered_qty - $cash_prod_det->cipd_qtn,

                    ];

                    $this->common_model->EditData($update_data1,array('spd_id' => $cash_prod_det->cipd_sales_prod),'crm_sales_product_details');

                }

            }

            $this->common_model->DeleteData('crm_cash_invoice',$cond);

            $this->common_model->DeleteData('master_transactions',array('tran_reference' => $cash_invoice->ci_reffer_no));

            $cond1 = array('cipd_cash_invoice' => $this->request->getPost('ID'));
    
            $this->common_model->DeleteData('crm_cash_invoice_prod_det',$cond1);

            $data['status'] = "true"; 
        }
        else
        {
           $data["status"] = "false";
        }

        echo json_encode($data);
 
         
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
            $cond = array('so_id' => $sales_id = $this->request->getPost('ID'));

            $sales_order = $this->common_model->SingleRow('crm_sales_orders',$cond);

            $cond1 = array('spd_sales_order' => $this->request->getPost('ID'));

            $sales_order_details = $this->common_model->FetchWhere('crm_sales_product_details',$cond1);

            //$total_amount =  $this->common_model->FetchSum('crm_sales_product_details','spd_amount',$cond1);

            $data['sales_order_advance'] = $this->common_model->FetchSum('accounts_receipts_sales_orders','rso_receipt_amount',array('rso_sales_order' => $sales_id,'rso_status' => 0));

            //$data['sales_order_advance'] = format_currency(1000);

            $products = $this->common_model->FetchAllOrder('crm_products','product_id','desc');

            $data['so_lpo'] = $sales_order->so_lpo;

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

            $total_amount = 0;

            foreach($sales_order_details as $sales_det){
                  
              $qty =   $sales_det->spd_quantity;
              $current_qty = $sales_det->spd_delivered_qty;

              $remaining_qty = $qty - $current_qty;

             

               

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
                                                <td><input type="number" name="cipd_qtn[]" value="'.$remaining_qty.'"  class="form-control qtn_clz_id" required></td>
                                                <td><input type="number" name="cipd_rate[]" value="'.$sales_det->spd_rate.'"  class="form-control rate_clz_id" required></td>
                                                <td><input type="number" name="cipd_discount[]" value="'.$sales_det->spd_discount.'"  class="form-control discount_clz_id" required></td>
                                                <td><input type="number" name="cipd_amount[]" value="'.$sales_det->spd_amount.'"  class="form-control amount_clz_id" required></td>
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


        public function AddProduct()
        {
            $cond = array('spd_sales_order' => $this->request->getPost('ID'));

            
            /*$invoice_product = $this->common_model->FetchWhere('crm_cash_invoice_prod_det',array('cipd_cash_invoice' => $this->request->getPost('cashInvoice')));
            
           // print_r($invoice_product); exit();

            $invoice_prod_array = [];
            foreach($invoice_product as $invoice_prod)
            {
                $invoice_prod_array[] = $invoice_prod->cipd_sales_prod;
            }


            $joins = array(
                array(
                    'table' => 'crm_products',
                    'pk'    => 'product_id',
                    'fk'    => 'spd_product_details',
                ),
                
    
            );


            $sales_order_details = $this->common_model->EditFetchProd('crm_sales_product_details',$cond,array('spd_deliver_flag'=>0),$joins,$invoice_prod_array,'spd_id');
            */
           // print_r($sales_order_details); exit();


            //$sales_order_details = $this->common_model->CheckTwiceCond1('crm_sales_product_details',$cond,array('spd_deliver_flag'=>0));
            
            $joins = array(
                array(
                    'table' => 'crm_products',
                    'pk'    => 'product_id',
                    'fk'    => 'spd_product_details',
                ),
    
            );

            $sales_order_details = $this->common_model->FetchProd('crm_sales_product_details',$cond,array('spd_deliver_flag'=>0),$joins);
            
            //print_r(count($sales_order_details)); exit();
            //print_r($sales_order_details); exit();
      
            $products = $this->common_model->FetchAllOrder('crm_products','product_id','desc');
            
            $i = 1; 
            $data['product_detail'] =""; 
            foreach($sales_order_details as $sales_det){
               
                $new_qty = $sales_det->spd_quantity - $sales_det->spd_delivered_qty;

                $data['product_detail'] .='<tr class="prod_row delivery_note_remove" id="'.$sales_det->spd_id.'">
                                                <td class="si_no">'.$i.'</td>
                                               
                                                <td style="width:40%"><input type="text" name="dpd_prod_det[]" value="'.$sales_det->product_details.'" class="form-control" readonly></td>
                                                <td><input type="text" name="dpd_unit[]" value="'.$sales_det->spd_unit.'" class="form-control" readonly></td>
                                                <td><input type="number" name="dpd_order_qty[]" value="'.$new_qty.'"  class="form-control order_qty" readonly></td>
                                                <td><input type="checkbox" name="product_select[]" id="'.$sales_det->spd_id.'"  onclick="handleCheckboxChange(this)" class="prod_checkmark"></td>
                                                    
                                                    
                                                </tr>';
                                                $i++;
                                                }

            echo json_encode($data);
                      

        }



        public function SelectedProduct()
        {
            // Clean up received ID parameter
            $select_id = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $this->request->getPost('ID'));

            // Split cleaned ID parameter into an array of individual IDs
            $idsArray = explode(',', $select_id);

            $data['product_detail'] = "";

            $total_amount = 0;

            // Fetch details for each selected product ID
            $i = 1;  
            foreach ($idsArray as $number) 
            {
                $cond = array('spd_id' => $number);

                $joins = array(
                    array(
                        'table' => 'crm_products',
                        'pk'    => 'product_id',
                        'fk'    => 'spd_product_details',
                    ),
                     
                );

                //$sales_order_details = $this->common_model->FetchWhere('crm_sales_product_details', $cond);

                $sales_order_details = $this->common_model->FetchProd('crm_sales_product_details',$cond,array('spd_deliver_flag'=>0),$joins);
            

                $products = $this->common_model->FetchAllOrder('crm_products', 'product_id', 'desc');

               

                foreach($sales_order_details as $sales_det){

                    $current_qty = $sales_det->spd_quantity - $sales_det->spd_delivered_qty;
                    
                    $multipleValue = $sales_det->spd_rate * $current_qty;

                    $perAmount = ($sales_det->spd_discount/100) * $multipleValue;

                    $orginalPrice = $multipleValue - $perAmount;

                    $amount = number_format((float)$orginalPrice, 2, '.', '');  // Outputs -> 105.00
                    
                    $total_amount = $amount + $total_amount;

                    

                    $data['product_detail'] .='<tr class="prod_row cash_invoice_remove" id="'.$sales_det->spd_id.'">
                                                        <td class="si_no">'.$i.'</td>
                                                        <td style="width:40%"><input type="text" name="" value="'.$sales_det->product_details.'" class="form-control" readonly></td>
                                                        <td><input type="text" name="cipd_unit[]" value="'.$sales_det->spd_unit.'" class="form-control" readonly></td>
                                                        <td><input type="number" name="cipd_qtn[]" value="'.$current_qty.'"  class="form-control qtn_clz_id" ></td>
                                                        <td><input type="number" name="cipd_rate[]" value="'.$sales_det->spd_rate.'"  class="form-control rate_clz_id"  readonly></td>
                                                        <td><input type="number" name="cipd_discount[]" value="'.$sales_det->spd_discount.'" class="form-control discount_clz_id" readonly></td>
                                                        <td><input type="number" name="cipd_amount[]" value="'.$amount.'" class="form-control amount_clz_id" required readonly></td>
                                                        <input type="hidden" name="cipd_prod_det[]" value="'.$sales_det->product_id.'">
                                                        <input type="hidden" class="selected_sales_prod" name="cipd_sales_prod[]" value="'.$sales_det->spd_id.'">
                                                        <input type="hidden" name="sales_order_id[]" value="'.$sales_det->spd_sales_order.'">
                                                </tr>';
                                                    
                                                    } $i++;
            }

            $total_amount = number_format((float)$total_amount, 2, '.', '');  // Outputs -> 105.00
            
            $data['total_amount'] = $total_amount;

            // Output JSON encoded data
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


       
        public function FetchReference($type="e")
        {
    
            $uid = $this->common_model->FetchNextId('crm_cash_invoice',"CAINV-{$this->data['accounting_year']}-");
    
            if($type=="e")
                echo $uid;
            else
            {
                return $uid;
            }
    
        }


        public function Edit()
        {
            
            $cond = array('ci_id' => $this->request->getPost('ID'));
    
            $joins = array(
                
                array(
                    'table' => 'crm_customer_creation',
                    'pk'    => 'cc_id',
                    'fk'    => 'ci_customer',
                ),
    
                array(
                    'table' => 'crm_sales_orders',
                    'pk'    => 'so_id',
                    'fk'    => 'ci_sales_order',
                ),
                array(
                    'table' => 'crm_contact_details',
                    'pk'    => 'contact_id',
                    'fk'    => 'ci_contact_person',
                ),
                array(
                    'table' => 'accounts_charts_of_accounts',
                    'pk'    => 'ca_id',
                    'fk'    => 'ci_credit_account',
                ),
    
            );
    
            $cash_invoice = $this->common_model->SingleRowJoin('crm_cash_invoice',$cond,$joins);
    
            
            $data['reffer_no']       = $cash_invoice->ci_reffer_no;
    
            $data['date']            = date('d-M-Y',strtotime($cash_invoice->ci_date));
    
            $data['lpo_reff']        = $cash_invoice->ci_lpo_reff;
    
            $data['contact_person']  = $cash_invoice->contact_person;
    
            $data['payment_term']    = $cash_invoice->ci_payment_term;
    
            $data['project']         = $cash_invoice->ci_project;
    
            $data['credit_account']  = $cash_invoice->ca_name;

            $data['cash_invoice_id'] = $cash_invoice->ci_id;
             
            $total_amount = format_currency($cash_invoice->ci_total_amount);

            $data['total_amount'] = '<tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>Total</td>
                <td class=""><input type="text" value="'.$total_amount.'" class="form-control " readonly></td>
                
            </tr> ';


            // customer craetion
            $customer_creation = $this->common_model->FetchAllOrder('crm_customer_creation','cc_id','desc');

            $data['customer'] ="";

            foreach($customer_creation as $cus_creation)
            {
                if ($cus_creation->cc_id  == $cash_invoice->ci_customer)
                {
                
                    $data['customer'] .= '<option value="' .$cus_creation->cc_id.'"'; 
                    $data['customer'] .= ' selected'; 
                    $data['customer'] .= '>' . $cus_creation->cc_customer_name .'</option>';

                }

            }

              

            //sales orders
            
            $sales_orders = $this->common_model->FetchWhere('crm_sales_orders',array('so_id'=> $cash_invoice->ci_sales_order));

            $data['sales_order'] ="";
            
            foreach($sales_orders as $sales_order)
            {
                $data['sales_order'] .= '<option value="' .$sales_order->so_id.'"'; 
            
                // Check if the current product head is selected
                if ($sales_order->so_id   == $cash_invoice->ci_sales_order)
                {
                    $data['sales_order'] .= ' selected'; 
                }
            
                $data['sales_order'] .= '>' . $sales_order->so_reffer_no.'</option>';

            }

            //contact person

            //$contact_data   = $this->common_model->FetchAllOrder('crm_contact_details','contact_id','desc');

            $contact_data = $this->common_model->FetchWhere('crm_contact_details',array('contact_customer_creation'=>$cash_invoice->ci_customer));

            $data['contact_person'] ="";

            foreach($contact_data as $cont_data)
            {
                $data['contact_person'] .= '<option value="' .$cont_data->contact_id .'"'; 
            
                // Check if the current product head is selected
                if ($cont_data->contact_id   == $cash_invoice->ci_contact_person)
                {
                    $data['contact_person'] .= ' selected'; 
                }
            
                $data['contact_person'] .= '>' . $cont_data->contact_person.'</option>';
            }


            //credit account

            $charts_of_account   = $this->common_model->FetchAllOrder('accounts_charts_of_accounts','ca_id','desc');

            $data['charts_of_account'] ="";

            foreach($charts_of_account as $charts_account)
            {
                $data['charts_of_account'] .= '<option value="' .$charts_account->ca_id .'"'; 
            
                // Check if the current product head is selected
                if ($charts_account->ca_id   == $cash_invoice->ci_credit_account)
                {
                    $data['charts_of_account'] .= ' selected'; 
                }
            
                $data['charts_of_account'] .= '>' . $charts_account->ca_name.'</option>';
            }

    
    
            //product table
    
            $cond1 = array('cipd_cash_invoice' => $this->request->getPost('ID'));
    
            $joins1 = array(
                array(
                    'table' => 'crm_products',
                    'pk'    => 'product_id',
                    'fk'    => 'cipd_prod_det',
                ),
    
            );
    
            $product_details_data = $this->common_model->FetchWhereJoin('crm_cash_invoice_prod_det',$cond1,$joins1);
             
           
            $i=1;  
    
            $data['prod_details']= "";
            foreach($product_details_data as $prod_det)
            {   
                $rate = format_currency($prod_det->cipd_rate);

                $discount = format_currency($prod_det->cipd_discount);

                $amount = format_currency($prod_det->cipd_amount);

                $data['prod_details'] .='<tr class="delete_cash_invoice">
                <td>'.$i.'</td>
                <td style="width:40%"><input type="text"  value="'.$prod_det->product_details.'" class="form-control " readonly></td>
                <td><input type="text"  value="'.$prod_det->cipd_unit.'" class="form-control " readonly></td>
                <td><input type="text" value="'.$prod_det->cipd_qtn.'" class="form-control " readonly></td>
                <td><input type="text" value="'.$rate.'" class="form-control " readonly></td>
                <td style="width:10px"><input type="text" value="'.$discount.'" class="form-control " readonly></td>
                <td><input type="text" value="'.$amount.'" class="form-control " readonly></td>
                <td style="width:15%"><a href="javascript:void(0)" class="delete delete-color del_prod_remove" data-id="215" data-toggle="tooltip" data-placement="top" title="Delete"><i class="ri-delete-bin-fill"></i> Delete</a></td>
                <input type="hidden" value="'.$prod_det->cipd_cash_invoice.'" class="edit_ci_prod_id">
                <input type="hidden" value="'.$prod_det->cipd_id.'" class="hidden_cash_prod_id">
                </tr>'; 
                 $i++;
            }
    
    
        //image section start

        $data['image_table']="";

        if(!empty($cash_invoice->ci_file))
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
                                        <td class="cust_img_rgt_border view_file_name" >'. $cash_invoice->ci_file.'</td>
                                        <td class="cust_img_rgt_border view_file_attach"><a href="'.base_url('uploads/CashInvoice/' .$cash_invoice->ci_file).'" target="_blank">View</a></td>
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
                                            <input type="file" name="" class="form-control">
                                        </div>
                                    </div>
            ';
        }


        //add more


        
        $crm_sales_product_details = $this->common_model->FetchWhere('crm_sales_product_details',array('spd_sales_order'=>$cash_invoice->ci_sales_order));
                
                
        if(count($crm_sales_product_details)!=count($product_details_data))
        {
           $data['add_more'] ="";

           $data['add_more'] .='<tr>
                            <td colspan="8" align="center" class="tecs">
                                <span class="add_icon add_more_product"><i class="ri-add-circle-line"></i>Add </span>
                            <td>
                        </tr>';
        }



            echo json_encode($data);
        }



        public function EditAddProduct()
        {   
            $cond1 = array('spd_sales_order' => $this->request->getPost('orderID'));

            $cash_product = $this->common_model->FetchWhere('crm_cash_invoice_prod_det',array('cipd_cash_invoice' => $this->request->getPost('cashInvoiceId')));
            
            $cash_prod_array = [];
            foreach($cash_product as $cash_prod)
            {
                $cash_prod_array[] = $cash_prod->cipd_sales_prod;
            }

           
            $cash_invoice_id = $this->request->getPost('cashInvoiceId');

            //array('dpd_id' => $this->request->getPost('prodID'));
            
            $joins = array(
                array(
                    'table' => 'crm_products',
                    'pk'    => 'product_id',
                    'fk'    => 'spd_product_details',
                ),
                
    
            );

            //$sales_order_details = $this->common_model->EditFetchProd('crm_sales_product_details',$cond1,array('spd_deliver_flag'=>0),$joins,$delivery_prod_id->dpd_so_id,'spd_id');
            

            $cash_product_details = $this->common_model->EditFetchProd('crm_sales_product_details',$cond1,array('spd_deliver_flag'=>0),$joins,$cash_prod_array,'spd_id');
            

            $i = 1; 
            
            $data['product_detail'] ="";

            foreach($cash_product_details as $cash_prod){

                $new_qty = $cash_prod->spd_quantity - $cash_prod->spd_delivered_qty;
                
                $data['product_detail'] .='<tr class="prod_row select_prod_remove edit_select_div" id="'.$cash_prod->spd_id.'">
                                                <td class="si_no">'.$i.'</td>
                                                <td><input type="text"  value="'.$cash_prod->product_details.'" class="form-control"  readonly></td>
                                                <td><input type="text" name="cipd_unit[]" value="'.$cash_prod->spd_unit.'" class="form-control" readonly></td>
                                                <td><input type="number" name="cipd_qtn[]" value="'.$new_qty.'"  class="form-control edit_order_qty" readonly></td>
                                               
                                               
                                                <td><input type="checkbox" name="sales_prod_id['.$cash_prod->spd_id.']" value="'.$cash_prod->spd_id.'"></td>
                                                
                                                <input type="hidden" name="sales_prod_id2[]" value="'.$cash_prod->spd_id.'">
                                                <input type="hidden" name="cipd_prod_det[]" value="'.$cash_prod->product_id.'">
                                                <input type="hidden" name="cipd_rate[]" value="'.$cash_prod->spd_rate.'">
                                                <input type="hidden" name="cipd_discount[]" value="'.$cash_prod->spd_discount.'">    
                                            </tr>
                                           <input type="hidden" name="cash_invoice_id" value="'.$cash_invoice_id.'">
                                         
                                            ';
                                                $i++;
            }

            

            echo json_encode($data);
        }


        public function UpdatedProduct()
        {
          
            if(!empty($_POST['cipd_qtn']))
		   {    
                $count =  count($_POST['cipd_qtn']);
               
          
                for($j = 0; $j < $count; $j++) 
                {    
                   

                   if(!empty($_POST['sales_prod_id'][$_POST['sales_prod_id2'][$j]]))
                   {
                   
                        
                       
                       $multipleValue = $_POST['cipd_rate'][$j] * $_POST['cipd_qtn'][$j];
                       
                       $perAmount = ($_POST['cipd_discount'][$j]/100) * $multipleValue;

                       $orginalPrice = $multipleValue - $perAmount;

                       $amount = number_format((float)$orginalPrice, 2, '.', '');  // Outputs -> 105.00

                    
                        
                        $insert_data  	= array(  
                            
                            'cipd_prod_det'     =>  $_POST['cipd_prod_det'][$j],
                            'cipd_unit'         =>  $_POST['cipd_unit'][$j],
                            'cipd_qtn'          =>  $_POST['cipd_qtn'][$j],
                            'cipd_sales_prod'   =>  $_POST['sales_prod_id2'][$j],
                            'cipd_rate'         =>  $_POST['cipd_rate'][$j],
                            'cipd_discount'     =>  $_POST['cipd_discount'][$j],
                            'cipd_cash_invoice' => $_POST['cash_invoice_id'],
                            'cipd_amount'       =>  $amount,
                            
                        );


                        

                        $this->common_model->InsertData('crm_cash_invoice_prod_det',$insert_data);

                        $cond = array('spd_id' => $_POST['sales_prod_id2'][$j]); 

                        $sales_prod2 = $this->common_model->SingleRow('crm_sales_product_details',$cond);

                        $new_qty = $sales_prod2->spd_delivered_qty + $_POST['cipd_qtn'][$j];

                        $update_data =  array('spd_delivered_qty' => $new_qty);
                        
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
                        
                        $cash_prod_array = [];
                        foreach($prod_detail as $prod_det)
                        {
                            
                            $cash_prod_array[] = $this->common_model->FetchWhere('crm_cash_invoice_prod_det',array('cipd_sales_prod'=>$prod_det->spd_id));
                        }

                        if(count($prod_detail)!=count($cash_prod_array))
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


                        $data['cash_invoice_id'] = $_POST['cash_invoice_id'];

                        $cash_invoice_prod_det = $this->common_model->FetchWhere('crm_cash_invoice_prod_det',array('cipd_cash_invoice' => $_POST['cash_invoice_id']));
                        
                        $total_amount = 0; 

                        foreach($cash_invoice_prod_det as $cash_inv_prod_det)
                        {
                            $total_amount = $cash_inv_prod_det->cipd_amount + $total_amount ;
                        }
                         
                        $this->common_model->EditData(array('ci_total_amount'=> $total_amount),array('ci_id' =>$_POST['cash_invoice_id']),'crm_cash_invoice');
                        
                       

                        $data['total_amount'] = '<tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Total</td>
                            <td class=""><input type="text" value="'.$total_amount.'" class="form-control " readonly></td>
                            
                        </tr> ';

                    }

                  
                } 

                
            }

            echo json_encode($data);

          
		}



        public function DeleteProduct()
        {
            $cash_invoice_prod = $this->common_model->SingleRow('crm_cash_invoice_prod_det',array('cipd_id' => $this->request->getPost('ProdID')));
          
            $qty = $cash_invoice_prod->cipd_qtn;

            $cash_invoice_id = $cash_invoice_prod->cipd_cash_invoice;
           
            $sales_prod_id   = $cash_invoice_prod->cipd_sales_prod;
            
            $sales_prod_data = $this->common_model->SingleRow('crm_sales_product_details',array('spd_id' => $sales_prod_id));
            
            $new_qty = $sales_prod_data->spd_delivered_qty - $qty;


            $update_data = array(

                'spd_delivered_qty' =>$new_qty,

                'spd_deliver_flag' =>0,
            );


            $this->common_model->EditData($update_data,array('spd_id' => $sales_prod_id), 'crm_sales_product_details');
            
            $update['so_deliver_flag'] = 0;

            $this->common_model->EditData($update,array('so_id' => $sales_prod_data->spd_sales_order), 'crm_sales_orders');
            
            $this->common_model->DeleteData('crm_cash_invoice_prod_det',array('cipd_id' => $this->request->getPost('ProdID')));
            
            $data['cash_invoice'] = $cash_invoice_prod->cipd_cash_invoice;

            $cash_invoice_prod_data = $this->common_model->FetchWhere('crm_cash_invoice_prod_det',array('cipd_cash_invoice' => $cash_invoice_prod->cipd_cash_invoice));
            
           
           
            $data["add_more"] = "";

                   $data['add_more'] .='<tr>
                                    <td colspan="8" align="center" class="tecs">
                                        <span class="add_icon add_more_product"><i class="ri-add-circle-line"></i>Add </span>
                                    <td>
                                </tr>';

            if(empty($cash_invoice_prod_data))
            {
                $this->common_model->DeleteData('crm_cash_invoice',array('ci_id' => $cash_invoice_prod->cipd_cash_invoice));
                $data['status'] = "True";
            }
            
           

           $cash_invoice_prod_where = $this->common_model->FetchWhere('crm_cash_invoice_prod_det',array('cipd_cash_invoice' => $cash_invoice_id));
           

           $total_amount = 0;

           foreach($cash_invoice_prod_where as $cash_invoice)
           {
                $total_amount = $cash_invoice->cipd_amount + $total_amount;
           }

         
           $this->common_model->EditData(array('ci_total_amount' => $total_amount),array('ci_id' => $cash_invoice_id), 'crm_cash_invoice');
            
           $data['total_amount'] = '<tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>Total</td>
                <td class=""><input type="text" value="'. $total_amount.'" class="form-control " readonly></td>
                
            </tr> ';

            echo json_encode($data);



        }
        
        public function qtyCheck()
        {
           $qty = $this->request->getPost('QTY');

           //$product_id = $this->request->getPost('selectProdId');

           $sales_prod_data = $this->common_model->SingleRow('crm_sales_product_details',array('spd_id' => $this->request->getPost('selectProdId')));
           
           

           $data['delivery_qty'] = $sales_prod_data->spd_quantity  - $sales_prod_data->spd_delivered_qty ;

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
                        'fk'    => 'cipd_prod_det',
                    ),
                   
                    
                );

                $product_details = $this->common_model->FetchWhereJoin('crm_cash_invoice_prod_det',array('cipd_cash_invoice'=>$id),$joins1);
                    
                
                $pdf_data = "";

                foreach($product_details as $prod_det)
                {   
                    $rate = format_currency($prod_det->cipd_rate);

                    $amount = format_currency($prod_det->cipd_amount);
    
                    $disc = number_format($prod_det->cipd_discount, 2);


                    $pdf_data .= '<tr><td align="left">'.$prod_det->product_code.'</td>';

                    $pdf_data .= '<td align="left">'.$prod_det->product_details.'</td>';

                    $pdf_data .= '<td align="left">'.$prod_det->cipd_qtn.'</td>';

                    $pdf_data .= '<td align="left">'.$prod_det->cipd_unit.'</td>';

                    $pdf_data .= '<td align="right">'.$rate.'</td>';

                    $pdf_data .= '<td align="center" style="color: red";><i>'.$disc.'</i></td>';

                    $pdf_data .= '<td align="right">'.$amount.'</td></tr>';
                }

                $join =  array(

                    array(
                        'table' => 'crm_customer_creation',
                        'pk'    => 'cc_id',
                        'fk'    => 'ci_customer',
                    ),

                    array(
                        'table' => 'crm_sales_orders',
                        'pk'    => 'so_id',
                        'fk'    => 'ci_sales_order',
                    ),
                );
                

                $cash_invoice = $this->common_model->SingleRowJoin('crm_cash_invoice',array('ci_id'=>$id),$join);

                // Set the title of the PDF
                $title = 'CIN - '.$cash_invoice->ci_reffer_no;
               
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
                    
                    font-size: 10px;
    
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
            
            
                <table width="100%" style="margin-top:10px;">
                
            
                <tr width="100%">
                <td width="10%"></td>
                <td>Date : '.$cash_invoice->ci_date.'</td>
                <td>Invoice No : '.$cash_invoice->ci_reffer_no.'</td>
                <td align="right"><h2>Cash Invoice</h2></td>
            
                </tr>
            
                </table>

            <table  width="100%" style="margin-top:2px;border-top:2px solid;">
        
                <tr>
                
                    <td > </td>
                    
                    <td >'.$cash_invoice->cc_customer_name.'</td>
                
                </tr>
        
        
            <tr>
            
            <td>Customer</td>
            
                
            <td >Tel : '.$cash_invoice->cc_telephone.', Fax : '.$cash_invoice->cc_fax.', Email : '.$cash_invoice->cc_email.'</td>
            
            </tr>
        
        
            <tr>
            
            <td ></td>
            
            <td >Post Box : -, Doha - '.$cash_invoice->cc_post_box.'</td>
            
            </tr>
        
        
            <tr>
            
            <td >Attention</td>
            
            <td >Mr. Johnson - Manager, Mobile: -, Email: -</td>
            
            </tr>
        
        
            </table>
    
               
            
            <table  width="100%" style="margin-top:2px;border-collapse: collapse; border-spacing: 0;border-top:2px solid;">
                
            
                <tr>
                
                    <th align="left" style="border-bottom:2px solid;">Item No</th>
                
                    <th align="left" style="border-bottom:2px solid;" width="40%">Description</th>
                
                    <th align="left" style="border-bottom:2px solid;">Qty</th>
                
                    <th align="left" style="border-bottom:2px solid;">Unit</th>
                
                    <th align="center" style="border-bottom:2px solid;">Rate</th>
        
                    <th align="center" style="border-bottom:2px solid;">Disc%</th>
        
                    <th align="center" style="border-bottom:2px solid;">Amount</th>
        
                
                </tr>


                '.$pdf_data.'
    
                 
                
            </table>';
            
            $footer = '
        
                <table style="border-bottom:2px solid">
                
                    <tr>
                        <td></td>

                        <td>IBAN : QA97CBQA000000004570407137001</td>
                    
                        <td>Gross Total</td>
            
                        <td>'.$cash_invoice->ci_total_amount.'</td>
                
                    </tr>
    
                    <tr>
        
                        <td>Bank Details</td>
                    
                        <td>Commercial Bank of Qatar, Industrial Area Branch, Doha - Qatar</td>
                       
                        <td>Less. Special Discount</td>
            
                        <td>-------</td>
                    
                    </tr>


                    <tr>
        
                        <td></td>
                    
                        <td>SWIFT : CBQAQAQA</td>
                       
                        <td></td>
            
                        <td></td>
                    
                    </tr>
    
    
                    <tr>
        
                        <td>Amount in words</td>
                    
                        <td>----------------------------------</td>
            
                        <td style="font-weight: bold;">Net Invoice Value</td>
            
                        <td>-----</td>
                    
                    </tr>
    
                </table>
    
    
                <table>
                
                <tr>
                    <td style="width:15%">Invoice Terms</td>
    
                    <td style="width:20%">Project:</td>
    
                    <td style="width:30%">-</td>
    
                    <td style="width:12%">Payment:</td>
    
                    <td>Cash on delivery</td>
                    
                </tr>
    
                <tr>
                    <td style="width:15%"></td>
    
                    <td style="width:20%">Sales Order:</td>
    
                    <td style="width:30%">'.$cash_invoice->so_reffer_no.'</td>
    
                    <td style="width:12%">Delivery</td>
    
                    <td >Ex-works</td>
    
                </tr>
                
                </table>
    
    
                <table style="border-top:2px solid;">
    
                <tr>
                
                    <td><i>Received by:</i></td>

                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    
                    <td><i>Prepared by:</i></td>

                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    
                    <td><i>Finance Dept:</i></td>

                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    
                    <td><i>Workshop Manager</i></td>
    
                  
    
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