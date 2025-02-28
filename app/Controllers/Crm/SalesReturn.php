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
            array(
                'table' => 'crm_sales_orders',
                'pk'    => 'so_id',
                'fk'    => 'sr_sales_order',
            ),
           
        );
        ## Fetch records
        $records = $this->common_model->GetRecord('crm_sales_return','sr_id',$searchValue,$searchColumns,$columnName,$columnSortOrder,$joins,$rowperpage,$start);
    
        $data = array();

        $i=1;
        foreach($records as $record ){
            
            $action = '<a  href="javascript:void(0)" data-id="'.$record->sr_id.'"  class="view view-color view_btn" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-fill"></i></a>
            <a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="Edit"  data-id="'.$record->sr_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i></a>
            <a href="javascript:void(0)" class="delete delete-color delete_btn"  data-toggle="tooltip" data-id="'.$record->sr_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i></a>';
           
            $data[] = array( 
              'sr_id'           => $i,
              'sr_reffer_no'    => $record->sr_reffer_no,
              'sr_date'         => date('d-M-Y',strtotime($record->sr_date)),
              'sr_customer'     => $record->cc_customer_name,
              'sr_sales_order'  => $record->so_reffer_no,
              'sr_invoice'      => $record->sr_invoice,
              'sr_total'        => $record->sr_total,
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
        
        $data['cash_invoice']        = $this->common_model->FetchAllOrder('master_cash_invoice_status','cis_id','desc');
        
        

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

        if(empty($this->request->getPost('sr_id')))
        {
            //$uid = $this->common_model->FetchNextId('crm_sales_return',"SR");

            $uid = $this->FetchReference("r");


            $insert_data = [

                'sr_reffer_no'       => $uid,

                'sr_date'            => date('Y-m-d',strtotime($this->request->getPost('sr_date'))),

                'sr_customer'        => $this->request->getPost('sr_customer'),

                'sr_invoice'         => $this->request->getPost('sr_cash_invoice'),

                'sr_lpo_reff'        => $this->request->getPost('sr_lpo_reff'),

                'sr_contact_person'  => $this->request->getPost('sr_contact_person'),

                'sr_payment_term'    => $this->request->getPost('sr_payment_term'),

                'sr_project'         => $this->request->getPost('sr_project'),

                'sr_credit_account'  => $this->request->getPost('sr_credit_account'),

                'sr_sales_order'     => $this->request->getPost('sales_order'),

                'sr_added_by'        => 0,

                'sr_added_date'      => date('Y-m-d'),

            ];

            if (isset($_FILES['ci_file']) && $_FILES['ci_file']['name'] !== '') {
                    
                // Upload the new image
                $attachFileName = $this->uploadFile('ci_file', 'uploads/CashInvoice');

            
                // Update the data with the new image filename
                $insert_data['ci_file'] = $attachFileName;
    
            }

            $sales_return_id = $this->common_model->InsertData('crm_sales_return',$insert_data);
            
           

        }
        else
        {
            $update_data = [

                'sr_reffer_no'       => $this->request->getPost('sr_reffer_no'),

                'sr_date'            => date('Y-m-d',strtotime($this->request->getPost('sr_date'))),

                'sr_customer'        => $this->request->getPost('sr_customer'),

                'sr_invoice'         => $this->request->getPost('sr_cash_invoice'),

                'sr_lpo_reff'        => $this->request->getPost('sr_lpo_reff'),

                'sr_contact_person'  => $this->request->getPost('sr_contact_person'),

                'sr_payment_term'    => $this->request->getPost('sr_payment_term'),

                'sr_project'         => $this->request->getPost('sr_project'),

                'sr_credit_account'  => $this->request->getPost('sr_credit_account'),

                'sr_sales_order'  => $this->request->getPost('sales_order'),

                'sr_total'           => $this->request->getPost('sr_total'),

            ];

            if (isset($_FILES['ci_file']) && $_FILES['ci_file']['name'] !== '') {
                
                // Upload the new image
                $attachFileName = $this->uploadFile('ci_file', 'uploads/CashInvoice');
            
                // Update the data with the new image filename
                $update_data['ci_file'] = $attachFileName;
            }

            $this->common_model->EditData($update_data, array('sr_id' => $this->request->getPost('sr_id')), 'crm_sales_return');
            
            $sales_return_id = $this->request->getPost('sr_id');

        }

        $sales_return_id = $this->common_model->SingleRow('crm_sales_return',array('sr_id' => $sales_return_id));

        $data['cash_invoice'] = $sales_return_id->sr_invoice;

        $data["cash_return_id"] = $sales_return_id->sr_id;
      
      
        if(!empty($_POST['srp_unit']))
		{
            $count =  count($_POST['srp_unit']);

            if($count!=0)
            {  
                for($j=0;$j<=$count-1;$j++)
                {
                        
                    $product_data  	= array(  
                        
                        'srp_prod_det'       =>  $_POST['srp_prod_det'][$j],
                        'srp_unit'           =>  $_POST['srp_unit'][$j],
                        'srp_quantity'       =>  $_POST['srp_quantity'][$j],
                        'srp_rate'           =>  $_POST['srp_rate'][$j],
                        'srp_discount'       =>  $_POST['srp_discount'][$j],
                        'srp_amount'         =>  $_POST['srp_amount'][$j],
                        'srp_prod_reff_name' =>  $_POST['reffer_id'][$j],
                        'srp_sales_return'   =>  $sales_return_id->sr_id
                        
                    );

                    $prod_insert_id = $this->common_model->InsertData('crm_sales_return_prod_det',$product_data);

                    if(!empty($_POST['cash_id'][$j]))
                    {
                        
                        $cash_prod_single = $this->common_model->SingleRow('crm_cash_invoice_prod_det',array('cipd_id' => $_POST['cash_id'][$j]));
                        
                        $this->common_model->EditData(array('cipd_delivered_qty'=> $cash_prod_single->cipd_delivered_qty + $_POST['srp_quantity'][$j]),array('cipd_id'=>  $_POST['cash_id'][$j]),'crm_cash_invoice_prod_det');
                        
                        $cash_product = $this->common_model->SingleRow('crm_cash_invoice_prod_det',array('cipd_id' => $_POST['cash_id'][$j]));
                        
                        $total_qty = $cash_product->cipd_qtn;
                        
                        $current_qty = $cash_product->cipd_delivered_qty;

                        if($total_qty  == $current_qty)
                        {
                            $this->common_model->EditData(array('cipd_status'=>1),array('cipd_id'=>$_POST['cash_id'][$j]),'crm_cash_invoice_prod_det');

                        }
                                                
                        $cash_data = $this->common_model->FetchWhere('crm_cash_invoice_prod_det',array('cipd_cash_invoice'=>$_POST['cash_main_table'][$j]));
                        
                        
                        $cash_datas = $this->common_model->CheckTwiceCond1('crm_cash_invoice_prod_det',array('cipd_cash_invoice'=>$_POST['cash_main_table'][$j]),array('cipd_status' => 1));
                         
                       

                        if(count($cash_data) == count($cash_datas))
                        {
                            $this->common_model->EditData(array('ci_status'=>1),array('ci_id'=>$_POST['cash_main_table'][$j]),'crm_cash_invoice');
                        }


                       
                       
                       
                    }

                    if(!empty($_POST['credit_id'][$j]))
                    {
                        $credit_prod_single = $this->common_model->SingleRow('crm_credit_invoice_prod_det',array('ipd_id' => $_POST['credit_id'][$j]));
                        
                        $this->common_model->EditData(array('ipd_delivered_qty'=> $credit_prod_single->ipd_delivered_qty + $_POST['srp_quantity'][$j]),array('ipd_id'=>  $_POST['credit_id'][$j]),'crm_credit_invoice_prod_det');
		                
                        $credit_product = $this->common_model->SingleRow('crm_credit_invoice_prod_det',array('ipd_id' => $_POST['credit_id'][$j]));
		
                        $total_qty = $credit_product->ipd_quantity;
                        
                        $current_qty = $credit_product->ipd_delivered_qty;

                        if($total_qty  == $current_qty)
                        {
                            //$this->common_model->EditData(array('cipd_status'=>1),array('cipd_id'=>$_POST['cash_id'][$j]),'crm_cash_invoice_prod_det');
                            
                            $this->common_model->EditData(array('ipd_status'=>1),array('ipd_id'=>$_POST['credit_id'][$j]),'crm_credit_invoice_prod_det');
                        
                        }
                        
                        
                        
                       
                        $credit_invoice = $this->common_model->FetchWhere('crm_credit_invoice_prod_det',array('ipd_credit_invoice'=>$_POST['credit_main_table'][$j]));
                        
                        $credit_invoices = $this->common_model->CheckTwiceCond1('crm_credit_invoice_prod_det',array('ipd_credit_invoice'=>$_POST['credit_main_table'][$j]),array('ipd_status' => 1));
                         
                        if(count($credit_invoice) == count($credit_invoices))
                        {
                            $this->common_model->EditData(array('cci_status'=>1),array('cci_id'=>$_POST['credit_main_table'][$j]),'crm_credit_invoice');
                        }

                       
                    }

                
                    
                } 
            }

            $cash_invoices = $this->common_model->FetchWhere('crm_cash_invoice',array('ci_customer' => $this->request->getPost('sr_customer')));
            
            $credit_invoices = $this->common_model->FetchWhere('crm_credit_invoice',array('cci_customer' => $this->request->getPost('sr_customer')));
            
            $sales_order_data = $this->common_model->SingleRow('crm_sales_orders',array('so_id' => $this->request->getPost('sales_order')));
                
            if($sales_order_data->so_advance_paid > 0)
            {

                if(!empty($cash_invoices))
                {  
                    $data['adjustment_data'] = "";

                    foreach($cash_invoices as $cash_invoice)
                    {
                            $data['adjustment_data'] .= "
                                <tr>
                                    <td>1</td>
                                    <td><input type='date' name='' value='".$cash_invoice->ci_date."' class='form-control' readonly></td>
                                    <td><input type='text' name='' value='".$cash_invoice->ci_reffer_no."' class='form-control' readonly></td>
                                    <td><input type='text' name='' value='".$cash_invoice->ci_total_amount."' class='form-control' readonly></td>
                                    <td><input type='text' name='' value='' class='form-control' required></td>
                                    <td><input type='checkbox' name='' value='' class='' required></td>
                                </tr>
                                ";
                    }
                
                }


                if(!empty($credit_invoices))
                {
                    $data['adjustment_data'] =""; 
                    
                    foreach($credit_invoices as $credit_invoice)
                    {
                        $data['adjustment_data'] .= "
                        <tr>
                            <td>1</td>
                            <td><input type='date' name='' value='".$credit_invoice->cci_date."' class='form-control' readonly></td>
                            <td><input type='text' name='' value='".$credit_invoice->cci_reffer_no."' class='form-control' readonly></td>
                            <td><input type='text' name='' value='".$credit_invoice->cci_total_amount."' class='form-control' readonly></td>
                            <td><input type='text' name='' value='' class='form-control' required></td>
                            <td><input type='checkbox' name='' value='' class='' required></td>
                        </tr>
                        ";
                    }
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




    //account head modal 
    public function View()
    {
        
        $cond = array('sr_id' => $this->request->getPost('ID'));

        $joins = array(
            
            array(
                'table' => 'crm_customer_creation',
                'pk'    => 'cc_id',
                'fk'    => 'sr_customer',
            ),

            /*array(
                'table' => 'crm_sales_orders',
                'pk'    => 'so_id',
                'fk'    => 'sr_sales_order',
            ),*/
            array(
                'table' => 'crm_contact_details',
                'pk'    => 'contact_id',
                'fk'    => 'sr_contact_person',
            ),
            array(
                'table' => 'accounts_charts_of_accounts',
                'pk'    => 'ca_id',
                'fk'    => 'sr_credit_account',
            ),

        );

        $cash_invoice = $this->common_model->SingleRowJoin('crm_sales_return',$cond,$joins);

        
        $data['reffer_no']      = $cash_invoice->sr_reffer_no;

        $data['date']           = date('d-M-Y',strtotime($cash_invoice->sr_date));

        $data['customer']       = $cash_invoice->cc_customer_name;

        $data['sales_order']    = $cash_invoice->sr_invoice;

        $data['lpo_reff']       = $cash_invoice->sr_lpo_reff;

        $data['contact_person'] = $cash_invoice->contact_person;

        $data['payment_term']   = $cash_invoice->sr_payment_term;

        $data['project']        = $cash_invoice->sr_project;

        $data['credit_account'] = $cash_invoice->sr_credit_account;


       


        //product table

        $cond1 = array('srp_sales_return' => $this->request->getPost('ID'));

        $joins1 = array(
            array(
                'table' => 'crm_products',
                'pk'    => 'product_id',
                'fk'    => 'srp_prod_det',
            ),

        );

        $product_details_data = $this->common_model->FetchWhereJoin('crm_sales_return_prod_det',$cond1,$joins1);
         
       
        
        $i=1;  

        $data['prod_details']= "";
        foreach($product_details_data as $prod_det)
        {
            $data['prod_details'] .='<tr>
            <td>'.$i.'</td>
            <td style="text-align: left;">'.$prod_det->product_details.'</td>
            <td><input type="text" value="'.$prod_det->srp_unit.'" class="form-control text-center" readonly></td>
            <td><input type="text" value="'.format_currency($prod_det->srp_quantity).'" class="form-control text-center" readonly></td>
            <td><input type="text" value="'.format_currency($prod_det->srp_rate).'" class="form-control text-end" readonly></td>
            <td><input type="text" value="'.format_currency($prod_det->srp_discount).'" class="form-control text-center" readonly></td>
            <td><input type="text" value="'.format_currency($prod_det->srp_amount).'" class="form-control text-end" readonly></td>
            </tr>'; 
             $i++;
        }


        //image section start

        /*$data['image_table']="";

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

            }*/
            




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
        $cond = array('ci_customer' => $this->request->getPost('ID'));

        $cash_invoices = $this->common_model->FetchSalesReturns1('crm_cash_invoice',$cond,array('ci_status'=>0));

        
        $credit_invoices = $this->common_model->FetchSalesReturns2('crm_credit_invoice',array('cci_customer' => $this->request->getPost('ID')),array('cci_paid_status'=>0),array('cci_status'=>0));
        
        
        $data['invoice_no'] ='<option value="" selected disabled>Select Unpaid Invoices</option>';


        foreach($cash_invoices as $cash_invoice)
        {   
            
            $data['invoice_no'] .='<option value='.$cash_invoice->ci_reffer_no.'';
           
            $data['invoice_no'] .='>' .$cash_invoice->ci_reffer_no. '</option>'; 
        }

        foreach($credit_invoices as $credit_invoice)
        {
            $data['invoice_no'] .='<option value='.$credit_invoice->cci_reffer_no.'';
           
            $data['invoice_no'] .='>' .$credit_invoice->cci_reffer_no. '</option>';
        }
       
        
        $cond2 = array('contact_customer_creation' => $this->request->getPost('ID'));

        $contact_details = $this->common_model->FetchWhere('crm_contact_details',$cond2);
       
        $data['contact_person'] = "<option value='' selected disabled>Select Contact Person</option>";
       
        foreach($contact_details as $con_det)
        {
            
           $data['contact_person'] .= '<option value='.$con_det->contact_id.'>'.$con_det->contact_person.'</option>';
        }
        
        //payment terms
        $cond3 = array('cc_id' => $this->request->getPost('ID')); 

        $customer_creation = $this->common_model->SingleRow('crm_customer_creation',$cond3);
        
        $data['payment_term'] = $customer_creation->cc_credit_term;

        echo json_encode($data);

    }


    // update account head 
    public function Update()
    {    
        /*$cond = array('at_id' => $this->request->getPost('account_id'));
        
        $update_data = $this->request->getPost(); 

        // Check if the 'account_id' key exists before unsetting it
        if (array_key_exists('account_id', $update_data)) 
        {
             unset($update_data['account_id']);
        }       

        $update_data['at_added_by'] = 0; 

        $update_data['at_modify_date'] = date('Y-m-d'); 



        $this->common_model->EditData($update_data,$cond,'accounts_account_types');*/

        //$cond = array('ci_id' => $this->request->getPost('ci_id'));

       // $delivery_note = $this->common_model->SingleRow('crm_cash_invoice',$cond);

        $update_data = [

            'sr_date'            => date('Y-m-d',strtotime($this->request->getPost('ci_date'))),

            'sr_customer'        => $this->request->getPost('ci_customer'),

            'sr_lpo_reff'        => $this->request->getPost('ci_lpo_reff'),

            'sr_contact_person'  => $this->request->getPost('ci_contact_person'),

            'sr_payment_term'    => $this->request->getPost('ci_payment_term'),

            'sr_project'         => $this->request->getPost('ci_project'),

        ];

        $this->common_model->EditData($update_data, array('sr_id' => $this->request->getPost('ci_id')), 'crm_sales_return');


       
    }

     //delete account head
     public function Delete()
     {
        $data['status'] = "";
           
        $data['msg'] ="";

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
        
        
        $cond = array('sr_id' => $this->request->getPost('ID'));
        
        $sales_return = $this->common_model->SingleRow('crm_sales_return',$cond);
        
        $sales_return_prod = $this->common_model->SingleRow('crm_sales_return_prod_det',array('srp_sales_return' => $sales_return->sr_id));
        
        $sales_return_prod_all = $this->common_model->FetchWhere('crm_sales_return_prod_det',array('srp_sales_return' => $sales_return->sr_id));
        
        
        foreach($sales_return_prod_all as $sales_ret_prod)
        {   
           
            $cash_invoice_product = $this->common_model->FetchWhere('crm_cash_invoice_prod_det',array('cipd_reffer_no' => $sales_ret_prod->srp_prod_reff_name));
            
            $credit_invoice_product = $this->common_model->FetchWhere('crm_credit_invoice_prod_det',array('ipd_reffer_no' => $sales_ret_prod->srp_prod_reff_name));
            
            if(!empty($credit_invoice_product))
            {
                foreach($credit_invoice_product as $credit_inv_prod)
                {
                    $current_qty = $credit_inv_prod->ipd_delivered_qty - $sales_ret_prod->srp_quantity;
                
                    $this->common_model->EditData(array('ipd_delivered_qty' => $current_qty,'ipd_status' => 0), array('ipd_reffer_no' => $sales_ret_prod->srp_prod_reff_name), 'crm_credit_invoice_prod_det');
                
                    $this->common_model->EditData(array('cci_status' => 0), array('cci_id' =>$credit_inv_prod->ipd_credit_invoice), 'crm_credit_invoice');
                    
                }

                $data['status'] =1;

                $data['msg'] ="Data Deleted Successfully";
            }
            else
            {
                $data['status'] = 0;

                $data['msg'] ="Data In Use. Cannot Delete";
            }

            if(!empty($cash_invoice_product))
            {
                foreach($cash_invoice_product as $cash_inv_prod)
                {
                    $current_qty = $cash_inv_prod->cipd_delivered_qty - $sales_ret_prod->srp_quantity;
                
                    $this->common_model->EditData(array('cipd_delivered_qty' => $current_qty,'cipd_status' => 0), array('cipd_reffer_no' => $sales_ret_prod->srp_prod_reff_name), 'crm_cash_invoice_prod_det');
                
                    $this->common_model->EditData(array('ci_status' => 0), array('ci_id' =>$cash_inv_prod->cipd_cash_invoice), 'crm_cash_invoice');
                    
                }

                $data['status'] =1;

                $data['msg'] ="Data Deleted Successfully";
            }
            else
            {
                $data['status'] = 0;

                $data['msg'] ="Data In Use. Cannot Delete";
            }
            
           
            
        }
         
        if(!empty($sales_return->sr_id)){
       
            $this->common_model->DeleteData('crm_sales_return_prod_det',array('srp_sales_return' => $sales_return->sr_id));

            $this->common_model->DeleteData('crm_sales_return',$cond);

            $data['status'] =1;

            $data['msg'] ="Data Deleted Successfully";

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
                                            <td class="row_remove" data-id="'.$prod_det->spd_id.'"><i class="ri-close-line"></i>Remove</td>
                                        </tr>';
                                        $i++;
        }
            $data['saleorder_output'] .= '</tbody><tbody id="product-more" class="travelerinfo"></tbody><tr><td colspan="9" style="text-align: center;"><span id="total_cost_id"></span></td></tr></table><div class="edit_add_more_div"><span class="edit_add_more add_product"><i class="ri-add-circle-line"></i>Add More</span></div>';
        
        
            echo json_encode($data);

        }


        public function FetchSalesData()
        {
            $cond = array('ci_reffer_no' => $this->request->getPost('ID'));

            $joins = array(
           
                array(
                    'table' => 'accounts_charts_of_accounts',
                    'pk'    => 'ca_id',
                    'fk'    => 'ci_credit_account',
                )
    
            );

            $cash_invoice = $this->common_model->SingleRowJoin('crm_cash_invoice',$cond,$joins);
            
           

            $products = $this->common_model->FetchAllOrder('crm_products','product_id','desc');

            $cond2 = array('contact_customer_creation' => $this->request->getPost('custID'));
           
            $contact_details = $this->common_model->FetchWhere('crm_contact_details',$cond2);
           
            if(!empty($cash_invoice))
            {
           
                $data['ci_lpo'] = $cash_invoice->ci_lpo_reff;

                $data['ci_project'] = $cash_invoice->ci_project;

                $data['ci_payment_term'] = $cash_invoice->ci_payment_term;

                $data['sales_order'] = $cash_invoice->ci_sales_order;

                

                //$data['contact_detail'] = ""; 

                $data['debit_account'] = $cash_invoice->ca_name;

                /*foreach($contact_details as $cont_det)
                {
                    $data['contact_detail'] .='<option value='.$cont_det->contact_id.'';
                    if($cont_det->contact_id == $cash_invoice->ci_contact_person){ $data['contact_detail'] .=' selected';}
                    $data['contact_detail'] .='>'.$cont_det->contact_person.'</option>';
                }*/

            }

            $joins2 = array(
           
                array(
                    'table' => 'accounts_charts_of_accounts',
                    'pk'    => 'ca_id',
                    'fk'    => 'cci_credit_account',
                )
    
            );

            $credit_invoice = $this->common_model->SingleRowjoin('crm_credit_invoice',array('cci_reffer_no' => $this->request->getPost('ID')),$joins2);
            
            
            if(!empty($credit_invoice))
            {
                $data['ci_lpo'] = $credit_invoice->cci_lpo_reff;

                $data['ci_project'] = $credit_invoice->cci_project;

                $data['ci_payment_term'] = $credit_invoice->cci_payment_term;

                $data['sales_order'] = $credit_invoice->cci_sales_order;
                

                $data['debit_account'] = $credit_invoice->ca_name;

                foreach($contact_details as $cont_det)
                {   
                    $data['contact_detail'] = ""; 

                    $data['contact_detail'] .='<option value='.$cont_det->contact_id.'';
                    if($cont_det->contact_id == $credit_invoice->cci_contact_person){ $data['contact_detail'] .=' selected';}
                    $data['contact_detail'] .='>'.$cont_det->contact_person.'</option>';
                }
            }


            echo json_encode($data);

        }


        //delete contact details
        public function DeleteContact()
        {
            //$cond = array('pp_id' => $this->request->getPost('ID'));
 
           // $this->common_model->DeleteData('crm_proforma_product',$cond);

        }


        /*public function AddProduct()
        {
            $cond1 = array('cipd_cash_invoice' => $this->request->getPost('cashInvoice'));
            
            $joins = array(
                array(
                    'table' => 'crm_products',
                    'pk'    => 'product_id',
                    'fk'    => 'cipd_prod_det',
                ),
    
            );

            $cash_invoice_product = $this->common_model->FetchWhereJoin('crm_cash_invoice_prod_det',$cond1,$joins);
             
            //print_r($cash_invoice_product); exit();
          
            $i = 1; 
            
            $data['product_detail'] ="";

            

            foreach($cash_invoice_product as $cash_invoice_prod){

                $data['product_detail'] .='<tr class="prod_row select_prod_remove" id="'.$cash_invoice_prod->cipd_id.'">
                                                <td class="si_no">'.$i.'</td>
                                                <td><input type="text" name="dpd_prod_det[]" value="'.$cash_invoice_prod->product_details.'" class="form-control"  readonly></td>
                                            
                                                <td><input type="number" name="dpd_order_qty[]" value="'.$cash_invoice_prod->cipd_qtn.'"  class="form-control order_qty" readonly></td>
                                                <td><input type="checkbox" name="product_select[]" id="'.$cash_invoice_prod->cipd_id .'"  onclick="handleCheckboxChange(this)" class="prod_checkmark"></td>
                                                
                                            </tr>';
                                                $i++;
            }

        

            echo json_encode($data);
                      

        }*/

        public function AddProduct()
        {
            $cond1 = array('ci_reffer_no' => $this->request->getPost('cashInvoice'));

            $cond2 = array('cci_reffer_no' => $this->request->getPost('cashInvoice'));
            
            $joins = array(
                array(
                    'table' => 'crm_products',
                    'pk'    => 'product_id',
                    'fk'    => 'cipd_prod_det',
                ),
                array(
                    'table' => 'crm_cash_invoice',
                    'pk'    => 'ci_id',
                    'fk'    => 'cipd_cash_invoice',
                ),
               
    
            );

            $joins2 = array(
                array(
                    'table' => 'crm_products',
                    'pk'    => 'product_id',
                    'fk'    => 'ipd_prod_detl',
                ),
                array(
                    'table' => 'crm_credit_invoice',
                    'pk'    => 'cci_id',
                    'fk'    => 'ipd_credit_invoice',
                ),
               

    
            );

            //$cash_invoice_product = $this->common_model->FetchWhereJoin('crm_cash_invoice_prod_det',$cond1,$joins);

            $cash_invoice_product = $this->common_model->FetchReturnJoin('crm_cash_invoice_prod_det',$cond1,array('cipd_status'=>0),$joins);
            
            $credit_invoice_product = $this->common_model->FetchReturnJoin('crm_credit_invoice_prod_det',$cond2,array('ipd_status'=>0),$joins2);

             
            $i = 1; 
            
            $data['product_detail'] ="";

            if(!empty($cash_invoice_product))
            {
                foreach($cash_invoice_product as $cash_invoice_prod)
                {

                    $data['product_detail'] .='<tr class="prod_row select_prod_remove" id="'.$cash_invoice_prod->cipd_id.'">
                                                <td class="si_no text-center">'.$i.'</td>
                                                <td style="text-align: left;">'.$cash_invoice_prod->product_details.'</td>
                                                <td class="text-center"><input type="number" name="dpd_order_qty[]" value="'.$cash_invoice_prod->cipd_qtn.'"  class="form-control order_qty text-center" readonly></td>
                                                <td class="text-center"><input type="checkbox"  name="product_select[]" id="'.$cash_invoice_prod->cipd_reffer_no.'"  onclick="handleCheckboxChange(this)" class="prod_checkmark text-center"></td>
                                                
                                            </tr>';
                                                $i++;
                }

            }

            if(!empty($credit_invoice_product))
            {
                foreach($credit_invoice_product as $credit_invoice_prod)
                {

                    $data['product_detail'] .='<tr class="prod_row select_prod_remove" id="'.$credit_invoice_prod->ipd_id.'">
                                                <td class="si_no text-center">'.$i.'</td>
                                                
                                                <td style="text-align: left;">'.$credit_invoice_prod->product_details.'</td>
                                            
                                                <td class="text-center"><input type="number" name="dpd_order_qty[]" value="'.$credit_invoice_prod->ipd_quantity.'"  class="form-control order_qty text-center" readonly></td>
                                                <td class="text-center"><input type="checkbox" name="product_select[]" id="'.$credit_invoice_prod->ipd_reffer_no.'"  onclick="handleCheckboxChange(this)" class="prod_checkmark text-center"></td>
                                                
                                            </tr>';
                                                $i++;
                }
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

            // Fetch details for each selected product ID
            $i = 1; 
            $new_amount = 0; 
            foreach ($idsArray as $number) 
            {
                $cond = array('cipd_reffer_no' => $number);
                
                $cond2 = array('ipd_reffer_no' => $number);

                $joins = array(
                    array(
                        'table' => 'crm_products',
                        'pk'    => 'product_id',
                        'fk'    => 'cipd_prod_det',
                    ),
        
                );

                $joins2 = array(
                    array(
                        'table' => 'crm_products',
                        'pk'    => 'product_id',
                        'fk'    => 'ipd_prod_detl',
                    ),
        
                );

                //$sales_order_details = $this->common_model->FetchWhere('crm_sales_product_details', $cond);

                $sales_order_details = $this->common_model->FetchWhereJoin('crm_cash_invoice_prod_det',$cond,$joins);

                $sales_order_details2 = $this->common_model->FetchWhereJoin('crm_credit_invoice_prod_det',$cond2,$joins2);

                $products = $this->common_model->FetchAllOrder('crm_products', 'product_id', 'desc');

                if(!empty($sales_order_details))
                {
                    foreach($sales_order_details as $sales_det)
                    {   
                        $qty = $sales_det->cipd_qtn - $sales_det->cipd_delivered_qty;

                        $data['product_detail'] .='<tr class="prod_row sales_return_remove" id="'.$sales_det->cipd_id.'">
                                                        <td class="si_no text-center">'.$i.'</td>
                                                        <td style="text-align:left">'.$sales_det->product_details.'</td>
                                                        <td><input type="text"   name="srp_unit[]" value="'.$sales_det->cipd_unit.'" class="form-control text-center" readonly></td>
                                                        <td><input type="number" name="srp_quantity[]" value="'.$qty.'"  class="form-control qtn_clz_id text-center" required></td>
                                                        <td><input type="number" name="srp_rate[]" value="'.$sales_det->cipd_rate.'"  class="form-control rate_clz_id text-end"  readonly></td>
                                                        <td><input type="number" name="srp_discount[]" value="'.$sales_det->cipd_discount.'" class="form-control discount_clz_id text-center" readonly></td>
                                                        <td><input type="number" name="srp_amount[]" value="'.$sales_det->cipd_amount.'" class="form-control amount_clz_id text-end" required readonly></td>
                                                        <input type="hidden" name="srp_prod_det[]" value="'.$sales_det->product_id.'">
                                                        <input type="hidden" name="cash_id[]" value="'.$sales_det->cipd_id.'"> 
                                                        <input type="hidden" name="cash_main_table[]" value="'.$sales_det->cipd_cash_invoice.'">
                                                        <input type="hidden" name="reffer_id[]" value="'.$sales_det->cipd_reffer_no.'" class="ret_cash_inv_reff"> 
                                                        
                                                    </tr>';

                        $new_amount =    $new_amount += $sales_det->cipd_amount;   
                                                        
                    }

                    $data['total_amount'] = $new_amount;
                }

                if(!empty($sales_order_details2))
                {
                    foreach($sales_order_details2 as $sale_det)
                    {
                        $new_qty = $sale_det->ipd_quantity - $sale_det->ipd_delivered_qty;

                        $data['product_detail'] .='<tr class="prod_row sales_return_remove" id="'.$sale_det->ipd_id.'">
                                                        <td class="si_no text-center">'.$i.'</td>
                                                        <td style="text-align:left">'.$sale_det->product_details.'</td>
                                                        <td><input type="text"   name="srp_unit[]" value="'.$sale_det->ipd_unit.'" class="form-control text-center" readonly></td>
                                                        <td><input type="number" name="srp_quantity[]" value="'.$new_qty.'"  class="form-control qtn_clz_id text-center" required></td>
                                                        <td><input type="number" name="srp_rate[]" value="'.$sale_det->ipd_rate.'"  class="form-control rate_clz_id text-end"  readonly></td>
                                                        <td><input type="number" name="srp_discount[]" value="'.$sale_det->ipd_discount.'" class="form-control discount_clz_id text-center" readonly></td>
                                                        <td><input type="number" name="srp_amount[]" value="'.$sale_det->ipd_amount.'" class="form-control amount_clz_id text-end" required readonly></td>
                                                        <input type="hidden" name="srp_prod_det[]" value="'.$sale_det->product_id.'">
                                                        <input type="hidden" name="credit_id[]" value="'.$sale_det->ipd_id.'"> 
                                                        <input type="hidden" name="credit_main_table[]" value="'.$sale_det->ipd_credit_invoice.'">  
                                                        <input type="hidden" name="reffer_id[]" value="'.$sale_det->ipd_reffer_no.'" class="ret_cash_inv_reff"> 
                                                    </tr>';

                                                    $new_amount =    $new_amount += $sale_det->ipd_amount;   
                                                        
                    }

                    $data['total_amount'] = $new_amount;
                }


                
                $i++;
            }

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
        
            $uid = $this->common_model->FetchNextId('crm_sales_return','sr_reffer_no',"SR-{$year}-",$year);
        
            if($type=="e")
            echo $uid;
            else
            {
            return $uid;
            }
    
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

            $cond = array('sr_id' => $this->request->getPost('ID'));
    
            $joins = array(
                
                array(
                    'table' => 'crm_customer_creation',
                    'pk'    => 'cc_id',
                    'fk'    => 'sr_customer',
                ),
                /*array(
                    'table' => 'crm_sales_orders',
                    'pk'    => 'so_id',
                    'fk'    => 'sr_sales_order',
                ),*/
                array(
                    'table' => 'crm_contact_details',
                    'pk'    => 'contact_id',
                    'fk'    => 'sr_contact_person',
                ),
                array(
                    'table' => 'accounts_charts_of_accounts',
                    'pk'    => 'ca_id',
                    'fk'    => 'sr_credit_account',
                ),
    
            );
    
            $cash_invoice = $this->common_model->SingleRowJoin('crm_sales_return',$cond,$joins);
    
            
            $data['reffer_no']       = $cash_invoice->sr_reffer_no;
    
            $data['date']            = date('d-M-Y',strtotime($cash_invoice->sr_date));
    
            $data['lpo_reff']        = $cash_invoice->sr_lpo_reff;
    
            $data['contact_person']  = $cash_invoice->sr_contact_person;
    
            $data['payment_term']    = $cash_invoice->sr_payment_term;
    
            $data['project']         = $cash_invoice->sr_project;
    
            $data['credit_account']  = $cash_invoice->sr_credit_account;

            $data['cash_invoice_id'] = $cash_invoice->sr_id;

            $data['invoice_no'] = $cash_invoice->sr_invoice;

            // customer craetion
            $customer_creation = $this->common_model->FetchAllOrder('crm_customer_creation','cc_id','desc');

            $data['customer'] ="";

            foreach($customer_creation as $cus_creation)
            {
                if ($cus_creation->cc_id  == $cash_invoice->sr_customer)
                {
                    $data['customer'] .= '<option value="' .$cus_creation->cc_id.'"'; 
                    $data['customer'] .= ' selected'; 
                    $data['customer'] .= '>' . $cus_creation->cc_customer_name .'</option>';

                }

            }

              

            //contact person
            $contact_data = $this->common_model->FetchWhere('crm_contact_details',array('contact_customer_creation'=>$cash_invoice->sr_customer));
          
            //$contact_data   = $this->common_model->FetchAllOrder('crm_contact_details','contact_id','desc');

            $data['contact_person'] ="";

            foreach($contact_data as $cont_data)
            {
                
                $data['contact_person'] .= '<option value="' .$cont_data->contact_id .'"'; 

                if ($cont_data->contact_id   == $cash_invoice->sr_contact_person)
                {
            
                    $data['contact_person'] .= ' selected'; 

                }
                
                    $data['contact_person'] .= '>' . $cont_data->contact_person.'</option>';

                
            }
            
           



    
    
            //product table
    
            $cond1 = array('srp_sales_return' => $this->request->getPost('ID'));
    
            $joins1 = array(
                array(
                    'table' => 'crm_products',
                    'pk'    => 'product_id',
                    'fk'    => 'srp_prod_det',
                ),
    
            );
    
            $product_details_data = $this->common_model->FetchWhereJoin('crm_sales_return_prod_det',$cond1,$joins1);
             
           
            $i=1;  
    
            $data['prod_details']= "";
            foreach($product_details_data as $prod_det)
            {
                $data['prod_details'] .='<tr class="delete_cash_invoice">
                <td class="text-center">'.$i.'</td>
                <td style="text-align: left;">'.$prod_det->product_details.'</td>
                <td><input type="text"  value="'.$prod_det->srp_unit.'" class="form-control text-center" readonly></td>
                <td><input type="text" value="'.format_currency($prod_det->srp_quantity).'" class="form-control text-center" readonly></td>
                <td><input type="text" value="'.format_currency($prod_det->srp_rate).'" class="form-control text-end" readonly></td>
                <td><input type="text" value="'.format_currency($prod_det->srp_discount).'" class="form-control text-center" readonly></td>
                <td><input type="text" value="'.format_currency($prod_det->srp_amount).'" class="form-control text-end" readonly></td>
                
                </tr>'; 
                 $i++;
            }

             //action link (edit and delete)
            /*<td style="width: 15%;">
            <a href="javascript:void(0)" style="display:none" class="edit edit-color product_edit" data-id="'.$prod_det->srp_id.'" data-toggle="tooltip" data-placement="top" title="edit"  data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a>
            <a href="javascript:void(0)" style="display:none" class="delete delete-color product_delete" data-id="'.$prod_det->srp_id.'" data-toggle="tooltip" data-id="349" data-placement="top" title="Delete"><i class="ri-delete-bin-fill"></i> Delete</a>
            </td>*/
    
    
        


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

            foreach($cash_product_details as $cash_prod)
            {

                $new_qty = $cash_prod->spd_quantity - $cash_prod->spd_delivered_qty;
                
                $data['product_detail'] .='<tr class="prod_row select_prod_remove edit_select_div" id="'.$cash_prod->spd_id.'">
                                                <td class="si_no">'.$i.'</td>
                                                <td><input type="text"  value="'.$cash_prod->product_details.'" class="form-control"  readonly></td>
                                                <td><input type="text" name="cipd_unit[]" value="'.$cash_prod->spd_unit.'"  class="form-control" readonly></td>
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
                            'cipd_cash_invoice' =>  $_POST['cash_invoice_id'],
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

                        

                    }

                  
                } 

                
            }

            echo json_encode($data);

          
		}



        public function DeleteProduct()
        {
            $cash_invoice_prod = $this->common_model->SingleRow('crm_cash_invoice_prod_det',array('cipd_id' => $this->request->getPost('ProdID')));
          
            $qty = $cash_invoice_prod->cipd_qtn;
           
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


            echo json_encode($data);



        }
        

        public function EditProduct()
        {
            $cond = array('srp_id' => $this->request->getPost('ID'));

            $invoice_no = $this->request->getPost('invoiceNo');
 
            $prod_det = $this->common_model->SingleRow('crm_sales_return_prod_det',$cond);

            $products = $this->common_model->FetchAllOrder('crm_products','product_id','desc');

            $data['prod_details'] ="";
            
                $data['prod_details'] .='<tr class="edit_prod_row">
                <td>1</td>
            
                <td><select class="form-select droup_product" name="srp_prod_det" required>';
                        
                    foreach($products as $prod){
                        $data['prod_details'] .='<option value="'.$prod->product_id.'" '; 
                        if($prod->product_id == $prod_det->srp_prod_det){ $data['prod_details'] .= "selected"; }
                        $data['prod_details'] .='>'.$prod->product_details.'</option>';
                    }
                            
                $data['prod_details'] .='</select></td>

                <td><input type="text" name="srp_unit"  value="'.$prod_det->srp_unit.'" class="form-control " required></td>
                <td> <input type="text" name="srp_quantity" value="'.$prod_det->srp_quantity.'" class="form-control edit_prod_qty" required></td>
                <td> <input type="text" name="srp_rate" value="'.$prod_det->srp_rate.'" class="form-control edit_prod_rate" required></td>
                <td> <input type="text" name="srp_discount" value="'.$prod_det->srp_discount.'" class="form-control edit_prod_discount" required></td>
                <td> <input type="text" name="srp_amount" value="'.$prod_det->srp_amount.'" class="form-control edit_prod_amount" readonly></td>
                <input type="hidden" name="srp_id" class="edit_prod_id" value="'.$prod_det->srp_id.'">
                
            </tr>'; 

            echo json_encode($data); 
        }


        public function UpdateProduct()
        {   
            $cond = array('srp_id' => $this->request->getPost('srp_id'));
            
            $update_data = $this->request->getPost();

            if (array_key_exists('srp_id', $update_data)) 
            {
                unset($update_data['srp_id']);
            }
            
            $this->common_model->EditData($update_data,$cond,'crm_sales_return_prod_det');
             
            $prod_det = $this->common_model->SingleRow('crm_sales_return_prod_det',$cond);
            
            

            $data['srp_sales_return'] = $prod_det->srp_sales_return;
            
            //$this->common_model->SingleRow('crm_sales_return_prod_det',array('srp_prod_reff_name' => $prod_det->srp_prod_reff_name));

            $single_cash = $this->common_model->SingleRow('crm_cash_invoice_prod_det',array('cipd_reffer_no' => $prod_det->srp_prod_reff_name));
            
            if(!empty($single_cash))
            {
                //$delivered_qty = $single_cash->cipd_delivered_qty + $prod_det->srp_unit;
                
                $delivered_qty = intval($single_cash->cipd_delivered_qty) + intval($prod_det->srp_unit);


                $this->common_model->EditData(array('cipd_delivered_qty' => $delivered_qty),array('cipd_reffer_no' => $prod_det->srp_prod_reff_name),'crm_cash_invoice_prod_det');
                 
            }

            echo json_encode($data);
       
        }

        public function DeleteProdDet()
        {
            $cond = array('srp_id' => $this->request->getPost('ID'));

            
            $sales_return_product = $this->common_model->SingleRow('crm_sales_return_prod_det',$cond);
            
            $this->common_model->DeleteData('crm_sales_return_prod_det',$cond);
            
            $cash_invoice_prod = $this->common_model->SingleRow('crm_cash_invoice_prod_det',array('cipd_reffer_no' => $sales_return_product->srp_prod_reff_name));
            
            $credit_invoice_prod = $this->common_model->SingleRow('crm_credit_invoice_prod_det',array('ipd_reffer_no' => $sales_return_product->srp_prod_reff_name));
            

            $count_sales_ret = $this->common_model->FetchWhere('crm_sales_return_prod_det',array('srp_sales_return' => $sales_return_product->srp_sales_return));
            
            if(count($count_sales_ret) == 0 )
                {
                    $this->common_model->DeleteData('crm_sales_return',array('sr_id' => $sales_return_product->srp_sales_return));
                    
                    $data['return_status'] = "true";
                }
                else
                {
                    $data['return_status'] = "false";
                }
            
            
            if(!empty($cash_invoice_prod))
            {   
                
                
                $this->common_model->EditData(array('ci_status' => 0),array('ci_id' => $cash_invoice_prod->cipd_cash_invoice),'crm_cash_invoice');
               
                $current_qty = $cash_invoice_prod->cipd_delivered_qty	- $sales_return_product->srp_quantity;
                
                $this->common_model->EditData(array('cipd_delivered_qty' => $current_qty,'cipd_status' => 0),array('cipd_reffer_no' => $sales_return_product->srp_prod_reff_name),'crm_cash_invoice_prod_det');
             
            }

            if(!empty($credit_invoice_prod))
            {   
                

                $this->common_model->EditData(array('cci_status' => 0),array('cci_id ' => $credit_invoice_prod->ipd_credit_invoice),'crm_credit_invoice');
                
                $current_qty = $credit_invoice_prod->ipd_delivered_qty	- $sales_return_product->srp_quantity;
               

                $this->common_model->EditData(array('ipd_delivered_qty' => $current_qty,'ipd_status' => 0),array('ipd_reffer_no' => $sales_return_product->srp_prod_reff_name),'crm_credit_invoice_prod_det');
                
                
            }


            echo json_encode($data);

            
            
        }


        public function CheckQty()
        {
            $cond = array('srp_id' => $this->request->getPost('prodId'));
            
            $sales_prod_data = $this->common_model->SingleRow('crm_sales_return_prod_det',$cond);
            
            $credit_invoice = $this->common_model->SingleRow('crm_credit_invoice_prod_det',array('ipd_reffer_no' =>  $sales_prod_data->srp_prod_reff_name));

            $cash_invoice = $this->common_model->SingleRow('crm_cash_invoice_prod_det',array('cipd_reffer_no' =>  $sales_prod_data->srp_prod_reff_name));
            
            $sales_return = $this->common_model->FetchWhere('crm_sales_return_prod_det',array('srp_prod_reff_name' => $sales_prod_data->srp_prod_reff_name));
               
            $total_qty = 0; 

            foreach($sales_return as $sales_ret)
            {
               $total_qty = $sales_ret->srp_quantity + $total_qty;

            }

            $new_qty = $total_qty -  $sales_prod_data->srp_quantity;
           

            if(!empty($credit_invoice))
            {   
               
                $data['srp_quantity'] = $credit_invoice->ipd_quantity - $new_qty;
            }

            if(!empty($cash_invoice))
            {
               
                $data['srp_quantity'] = $cash_invoice->cipd_qtn - $new_qty;
            }

           
            echo json_encode($data);

        }



        public function ProdQty()
        {  
            $data['total_qty'] = "";

            $cond = array('cipd_reffer_no' => $this->request->getPost('refferID'));
             
            $cash_invoice_prod = $this->common_model->SingleRow('crm_cash_invoice_prod_det',$cond);

            $cond1 = array('ipd_reffer_no' => $this->request->getPost('refferID'));
             
            $credit_invoice_prod = $this->common_model->SingleRow('crm_credit_invoice_prod_det',$cond1);

            

            if(!empty($cash_invoice_prod))
            {
                $data['total_qty'] = $cash_invoice_prod->cipd_qtn - $cash_invoice_prod->cipd_delivered_qty;
            }

            if(!empty($credit_invoice_prod))
            {
                $data['total_qty'] = $credit_invoice_prod->ipd_quantity - $credit_invoice_prod->ipd_delivered_qty;
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

       
    


     
    


}
