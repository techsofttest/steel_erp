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
            $action = '<a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->so_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a><a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->so_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> Delete</a><a  href="javascript:void(0)" data-id="'.$record->so_id.'"  class="view view-color view_btn" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a><a href="'.base_url().'CRM/SalesOrder/Print/'.$record->so_id.'" target="_blank" class="print_color"><i class="ri-file-pdf-2-line " aria-hidden="true"></i>Print</a>';
           
           $data[] = array( 
              "so_id"            =>$i,
              'so_reffer_no'      => $record->so_reffer_no,
              'so_date'          => date('d-m-Y',strtotime($record->so_date)),
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
        
       /* $joins = array(
            array(
                'table' => 'crm_customer_creation',
                'pk'    => 'cc_id',
                'fk'    => 'so_customer',
            ),
           

        );*/
      
       // $data['result'] = $this->common_model->ReportFetchLimit('crm_sales_orders','so_customer','asc',$term,$start,$end,$joins,'so_customer');
    

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
       
        /*$joins = array(
            array(
                'table' => 'crm_customer_creation',
                'pk'    => 'cc_id',
                'fk'    => 'qd_customer',
            ),
           

        );*/

        //$data['customer_creation'] = $this->common_model->FetchCustomerCreation('crm_quotation_details',$joins);
        
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
        
        $insert_data = [

            'so_reffer_no'              => $this->request->getPost('so_reffer_no'),

            'so_date'                   => date('Y-m-d',strtotime($this->request->getPost('so_date'))),

            'so_customer'               => $this->request->getPost('so_customer'),

            'so_quotation_ref'          => $this->request->getPost('so_quotation_ref'),

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

        $sales_order_id = $this->common_model->InsertData('crm_sales_orders',$insert_data);


        /*product table section start*/

        if(!empty($_POST['spd_unit']))
        {
            $count =  count($_POST['spd_unit']);
            
            if($count!=0)
            {  
                for($j=0;$j<=$count-1;$j++)
                {   
                    

                    $prod_data  	= array(  
                        
                        'spd_product_details'   =>  $_POST['spd_product_details'][$j],
                        'spd_unit'              =>  $_POST['spd_unit'][$j],
                        'spd_quantity'          =>  $_POST['spd_quantity'][$j],
                        'spd_rate'              =>  $_POST['spd_rate'][$j],
                        'spd_discount'          =>  $_POST['spd_discount'][$j],
                        'spd_amount'            =>  $_POST['spd_amount'][$j],
                        'spd_sales_order'       =>  $sales_order_id,
    
                    );
                
                    $id = $this->common_model->InsertData('crm_sales_product_details',$prod_data);
            
                } 
            }
        }

        /*####*/



    }




    public function ContactPerson()
    {
        $cond = array('contact_customer_creation' => $this->request->getPost('ID'));

        $contact_details = $this->common_model->FetchWhere('crm_contact_details',$cond);

        $cond1 = array('qd_customer' => $this->request->getPost('ID'));

        //$quotation_details = $this->common_model->FetchWhere('crm_quotation_details',$cond1);
       
        $quotation_details = $this->common_model->FetcQuotInSales($this->request->getPost('ID'));

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


    public function QuotationRef()
    {
        $cond = array('qd_id' => $this->request->getPost('ID'));

        $cond1 = array('qpd_quotation_details' => $this->request->getPost('ID'));

        $sales_executive = $this->common_model->FetchAllOrder('executives_sales_executive','se_id','desc');

        $cond2 = array('contact_customer_creation' => $this->request->getPost('quotID'));

       
        $contact_person = $this->common_model->FetchWhere('crm_contact_details',$cond2);
        
        
        $joins1 = array(
            array(
                'table' => 'crm_products',
                'pk'    => 'product_id',
                'fk'    => 'qpd_product_description',
            ),
           

        );

        $product_details_data = $this->common_model->FetchWhereJoin('crm_quotation_product_details',$cond1,$joins1);
        
        $products = $this->common_model->FetchAllOrder('crm_products','product_id','desc');

         
        $data['prod_details'] ='';
        $i =1; 
        foreach($product_details_data as $prod_det)
        {   
            $prod_det->qpd_amount;

            $data['prod_details'] .='<tr class="prod_row2 sales_remove" id="'.$prod_det->qpd_id.'">
            <td class="si_no2">'.$i.'</td>
            <td style="width:20%">
                <select class="form-select droup_product add_prod" name="spd_product_details[]" required>';
                    
                    foreach($products as $prod){
                        $data['prod_details'] .='<option value="'.$prod->product_id.'" '; 
                        if($prod->product_id == $prod_det->qpd_product_description){ $data['prod_details'] .= "selected"; }
                        $data['prod_details'] .='>'.$prod->product_details.'</option>';
                    }
            $data['prod_details'] .='</select>
            </td>
            <td><input type="text"  name="spd_unit[]"  value="'.$prod_det->qpd_unit.'" class="form-control " required></td>
            <td> <input type="text" name="spd_quantity[]" value="'.$prod_det->qpd_quantity.'" class="form-control qtn_clz_id"  required></td>
            <td> <input type="text" name="spd_rate[]"  class="form-control rate_clz_id" required></td>
            <td> <input type="text" name="spd_discount[]"  class="form-control discount_clz_id" required></td>
            <td> <input type="text" name="spd_amount[]"  class="form-control amount_clz_id" required></td>
            <td class="row_remove remove-btnpp" data-id="'.$prod_det->qpd_id.'"><i class="ri-close-line"></i>Remove</td>
            </tr>'; 
            $i++; 
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



        //$data['qd_payment_term'] =  $quotation_details->qd_payment_term;

        $data['qd_delivery_term']   =  $quotation_details->dt_name;

        $data['qd_project'] =  $quotation_details->qd_project;

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
        $cond = array('so_id' => $this->request->getPost('ID'));
 
        $this->common_model->DeleteData('crm_sales_orders',$cond);

        $cond1 = array('spd_sales_order' => $this->request->getPost('ID'));
 
        $this->common_model->DeleteData('crm_sales_product_details',$cond1);
 
         
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

        $sales_order     = $this->common_model->SingleRow('crm_sales_orders',$cond1);

        $customer_creation = $this->common_model->FetchAllOrder('crm_customer_creation','cc_id','desc');

        $quotation_details = $this->common_model->FetchAllOrder('crm_quotation_details','qd_id','desc');

        //$quotation_details = $this->common_model->FetcQuotWhere($sales_order->so_reffer_no);

      
        $data['reff_no']         = $sales_order->so_reffer_no;

        $data['date']            = $sales_order->so_date;

        $data['lpo']             = $sales_order->so_lpo;

        $data['sales_executive'] = $sales_order->so_sales_executive;

        $data['payment_term']    = $sales_order->so_payment_term;

        $data['delivery_term']   = $sales_order->so_delivery_term;

        $data['project']         = $sales_order->so_project;

        $data['so_id']         = $sales_order->so_id;



        $data['customer_creation'] ="";

        // customer craetion
        foreach($customer_creation as $cus_creation)
        {
            $data['customer_creation'] .= '<option value="' .$cus_creation->cc_id.'"'; 
        
            // Check if the current product head is selected
            if ($cus_creation->cc_id  == $sales_order->so_customer)
            {
                $data['customer_creation'] .= ' selected'; 
            }
        
            $data['customer_creation'] .= '>' . $cus_creation->cc_customer_name .'</option>';
        }

        //quotation_details
        
        $data['quotation'] ="";

        foreach($quotation_details as $quot_det)
        {
            $data['quotation'] .= '<option value="' .$quot_det->qd_id. '"'; 
        
            // Check if the current product head is selected
            if ($quot_det->qd_id  == $sales_order->so_quotation_ref)
            {
                $data['quotation'] .= ' selected'; 
            }
        
            $data['quotation'] .= '>' . $quot_det->	qd_reffer_no. '</option>';
        }

        //contact_person
        /*$data['contact'] ="";

        foreach($quotation_details as $quot_det)
        {
            $data['quotation'] .= '<option value="' .$quot_det->qd_id. '"'; 
        
            // Check if the current product head is selected
            if ($quot_det->qd_id  == $sales_order->so_quotation_ref)
            {
                $data['quotation'] .= ' selected'; 
            }
        
            $data['quotation'] .= '>' . $quot_det->	qd_reffer_no. '</option>';
        }*/

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

        $data['date']           = $sales_order->so_date;

        $data['customer']       = $sales_order->cc_customer_name;

        $data['quot_ref']       = $sales_order->qd_reffer_no;

        $data['lpo']            = $sales_order->so_lpo;

        $data['sales_exec']     = $sales_order->se_name;

        $data['contact_person'] = $sales_order->contact_person;

        $data['payment_term']   = $sales_order->so_payment_term;

        $data['delivery_term']  = $sales_order->so_delivery_term;

        $data['project']        = $sales_order->so_project;

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
        
        //$products = $this->common_model->FetchAllOrder('crm_products','product_id','desc');

        $data['prod_details'] ='';
        $i =1; 
        foreach($product_details_data as $prod_det)
        {   
            //$prod_det->qpd_amount;

            $data['prod_details'] .='<tr class="prod_row2 sales_remove" id="'.$prod_det->spd_id.'">
            <td class="si_no2">'.$i.'</td>
            <td><input type="text"  name="spd_unit[]"  value="'.$prod_det->product_details.'" class="form-control " readonly></td>
            <td><input type="text"  name="spd_unit[]"  value="'.$prod_det->spd_unit.'" class="form-control " readonly></td>
            <td> <input type="text" name="spd_quantity[]" value="'.$prod_det->spd_quantity.'" class="form-control qtn_clz_id"  readonly></td>
            <td> <input type="text" name="spd_rate[]" value="'.$prod_det->spd_rate.'" class="form-control rate_clz_id" readonly></td>
            <td> <input type="text" name="spd_discount[]" value="'.$prod_det->spd_discount.'" class="form-control discount_clz_id" readonly></td>
            <td> <input type="text" name="spd_amount[]" value="'.$prod_det->spd_amount.'"  class="form-control amount_clz_id" readonly></td>
          
            </tr>'; 
            $i++; 
        }
        
        //table section end



        echo json_encode($data);


    }


    public function AddProduct()
    {
        $id = $this->common_model->InsertData('crm_products',$insert_data);
    }



    public function Print($id){

        $cond= array('so_id' => $id);

        $joins = array(
           
            array(
                'table' => 'crm_customer_creation',
                'pk'    => 'cc_id',
                'fk'    => 'so_customer',
            ),
           
        );
        
        $sales_order = $this->common_model->SingleRowJoin('crm_sales_orders',$cond,$joins);

        if(!empty($sales_order)){

            $sales_order->so_id;

            $cond1 = array('spd_sales_order' => $sales_order->so_id);

            $product_details = $this->common_model->FetchWhere('crm_sales_product_details',$cond1);

            $i =1;
            foreach($product_details as $prod_det)
            {
                $item_no = "{$sales_order->so_order_no}"; 

                $si = "{$i}";

                $prod_desc = "{$prod_det->spd_product_details}";

                $prod_qty = "{$prod_det->spd_quantity}";

                $prod_unit = "{$prod_det->spd_unit}";

                $prod_rate = "{$prod_det->spd_rate}";

                $prod_discount = "{$prod_det->spd_discount}";

                $prod_amount = "{$prod_det->spd_amount}";

            
            }
            $i++;
            $mpdf = new \Mpdf\Mpdf();

        
        
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
        
            <h2>Al Fuzail Engineering Services WLL</h2>
            <div><p class="paragraph-spacing">Tel : +974 4460 4254, Fax : 4029 8994, email : engineering@alfuzailgroup.com</p></div>
            <p>Post Box : 201978, Gate : 248, Street : 24, Industrial Area, Doha - Qatar</p>
            
            
            </td>
            
            </tr>
        
            </table>
        
        
        
            <table width="100%" style="margin-top:10px;">
            
        
            <tr width="100%">
            <td>Date:31-Jul-2016</td>
            <td>Sales Order No.:03562</td>
            <td align="right"><h3>Sales Order</h3></td>
        
            </tr>
        
            </table>
        
        
            <table  width="100%" style="margin-top:2px;border-top:2px solid;border-bottom:2px solid;">
        
            <tr>
            
            <td > </td>
            
            <td >'.$sales_order->cc_customer_name.'</td>
            
            </tr>
        
        
            <tr>
            
            <td >Customer</td>
            
                
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
        
        
        
        
            <table  width="100%" style="margin-top:2px;border-collapse: collapse; border-spacing: 0;">
            
        
            <tr>
            
            <th align="left" style="border-bottom: 2px solid;">Item No.</th>
        
            <th align="left" style="border-bottom: 2px solid;">Description</th>
        
            <th align="left" style="border-bottom: 2px solid;">Qty</th>
        
            <th align="left" style="border-bottom: 2px solid;">Unit</th>
        
            <th align="left" style="border-bottom: 2px solid;">Rate</th>

            <th align="left" style="border-bottom: 2px solid;">Disc %</th>

            <th align="left" style="border-bottom: 2px solid;">Amount</th>
        
            
            </tr>

            
        
            <tr>
            
            <td>'.$si.'-'.$item_no.'</td>
        
            <td>'.$prod_desc.'</td>
        
            <td>'.$prod_qty.'</td>
        
            <td>'.$prod_unit.'</td>
        
            <td>'.$prod_rate.'</td>
        
            <td>'.$prod_discount.'</td>

            <td>'.$prod_amount.'</td>
            
            </tr>

            
            </table>
        
            ';
        
            $footer = '
        
            <table style="border-bottom:1px solid">
            
            <tr>
            
            <td>Promised Date</td>
        
            <td>15-Aug-2016</td>

            <td>Gross Total</td>

            <td>2,445.00</td>
        
            </tr>

            <tr>

            <td>Promised Date</td>
        
            <td></td>

            <td>Less. Special Discount</td>

            <td>122.25</td>
            
            </tr>


            <tr>

            <td>Amount in words</td>
        
            <td>Two thousand three hundred twenty two & seventy five Dirhams onl</td>

            <td>Net Quote Value</td>

            <td>2,322.75</td>
            
            </tr>

            </table>


            <table>
            
            <tr>
                <td style="width:20%">Order Terms</td>

                <td style="width:20%">LPO Reference</td>

                <td style="width:20%">Verbal</td>

                <td style="width:20%">Payment:</td>

                <td style="width:20%">Cash on delivery</td>
                
            </tr>

            <tr>
                <td style="width:20%"></td>

                <td style="width:20%">Quote Reference</td>

                <td style="width:20%">02462</td>

                <td style="width:20%">Delivery</td>

                <td style="width:20%">Ex-works</td>

            </tr>
            
            </table>


            <table style="border-top:1px solid">

            <tr>
            
                <td>Antony Raphel - Production In-charge</td>

                <td></td>

                <td></td>

                <td></td>

                <td></td>

                <td></td>

                <td></td>
                
                <td></td>

                <td></td>

            

            
                <td>Justin Jose - Operations Manager</td>

            </tr>


            <tr>

                <td>Mob : +974 6688 5418, antony@alfuzailgroup.com</td>

                <td></td>

                <td></td>

                <td></td>

                <td></td>

                <td></td>

                <td></td>

                <td></td>

                <td></td>

            

                

                <td>Mob : +974 3381 6185, justin@alfuzailgroup.com</td>
            
            </tr>
            
            
            </table>
        
        
        
            ';
        
            
            $mpdf->WriteHTML($html);
            $mpdf->SetFooter($footer);
            $this->response->setHeader('Content-Type', 'application/pdf');
            $mpdf->Output();

        }


    
    }
    


}
