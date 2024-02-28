<?php

namespace App\Controllers\Crm;

use App\Controllers\BaseController;


class SalesQuotation extends BaseController
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
       
        $totalRecords = $this->common_model->GetTotalRecords('crm_quotation_details','qd_id','DESC');
 
        ## Total number of records with filtering
       
        $searchColumns = array('qd_reffer_no');

        $totalRecordwithFilter = $this->common_model->GetTotalRecordwithFilter('crm_quotation_details','qd_id',$searchValue,$searchColumns);
    
        ##Joins if any //Pass Joins as Multi dim array
        $joins = array(
            array(
                'table' => 'crm_customer_creation',
                'pk'    => 'cc_id',
                'fk'    => 'qd_customer',
            ),

            array(
                'table' => 'crm_enquiry',
                'pk'    => 'enquiry_id',
                'fk'    => 'qd_enq_ref',
            )

        );
        ## Fetch records
        $records = $this->common_model->GetRecord('crm_quotation_details','qd_id',$searchValue,$searchColumns,$columnName,$columnSortOrder,$joins,$rowperpage,$start);
    
        $data = array();

        $i=1;
        foreach($records as $record ){
            $action = '<a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->qd_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a><a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->qd_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> Delete</a><a  href="javascript:void(0)" data-id="'.$record->qd_id.'"  class="view view-color view_btn" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a>';
           
           $data[] = array( 
              "qd_id"               =>$i,
              'qd_reffer_no'        => $record->qd_reffer_no,
              'qd_date'             => date('d-m-Y',strtotime($record->qd_date)),
              'qd_customer'         => $record->cc_customer_name,
              'qd_enquiry'          => $record->enquiry_reff,
              "action"              => $action,
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

    public function FetchCostMetal()
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

        $data['delivery_term'] = $this->common_model->FetchAllOrder('master_delivery_term','dt_id','desc');

        //$data['delivery_term'] = $this->common_model->FetchAllOrder('crm_products','product_details','desc');
        
        $data['product_head'] = $this->common_model->FetchAllOrder('crm_product_heads','ph_id','desc');

        $data['sales_quotation_id'] = $this->common_model->FetchNextId('crm_quotation_details','SQ');

        $data['content'] = view('crm/sales-quotation',$data);

        return view('crm/crm-module',$data);

    }


    // add account head
    Public function Add()
    {   
       
        $insert_data = [

            'qd_reffer_no'                  => $this->request->getPost('qd_reffer_no'),

            'qd_date'                       => date('Y-m-d',strtotime($this->request->getPost('qd_date'))),

            'qd_customer'                   => $this->request->getPost('qd_customer'),

            'qd_enq_ref'                    => $this->request->getPost('qd_enq_ref'),

            'qd_validity'                   => $this->request->getPost('qd_validity'),

            'qd_sales_executive'            => $this->request->getPost('qd_sales_executive'),

            'qd_contact_person'             => $this->request->getPost('qd_contact_person'),

            'qd_payment_term'               => $this->request->getPost('qd_payment_term'),

            'qd_delivery_term'              => $this->request->getPost('qd_delivery_term'),

            'qd_project'                    => $this->request->getPost('qd_project'),

            'qd_sales_quot_amount_in_words' => $this->request->getPost('qd_sales_quot_amount_in_words'),

            'qd_sales_amount'               => $this->request->getPost('qd_sales_amount'),

            'qd_added_by'                   => 0,
        ];

        $data['quotation_id'] = $this->common_model->InsertData('crm_quotation_details',$insert_data);

        if(!empty($_POST['qpd_product_description']))
        {
            $count =  count($_POST['qpd_product_description']);
                
            if($count!=0)
            {  
                for($j=0;$j<=$count-1;$j++)
                {
                        
                    $insert_data  	= array(  
                        
                        'qpd_product_description'  =>  $_POST['qpd_product_description'][$j],
                        'qpd_unit'                 =>  $_POST['qpd_unit'][$j],
                        'qpd_quantity'             =>  $_POST['qpd_quantity'][$j],
                        'qpd_rate'                 =>  $_POST['qpd_rate'][$j],
                        'qpd_discount'             =>  $_POST['qpd_discount'][$j],
                        'qpd_amount'               =>  $_POST['qpd_amount'][$j],
                        'qpd_quotation_details'    =>  $data['quotation_id'],
    
                    );
                
                    
                    $id = $this->common_model->InsertData('crm_quotation_product_details',$insert_data);
            
                } 
            }
        }

        echo json_encode($data);

    }

  
    public function AddTab2()
    {   
        

        if(!empty($_POST['qc_material']))
        {
            $count =  count($_POST['qc_material']);

            $quotation = $_POST['qc_quotation_id'];
                
            if($count!=0)
            {  
                for($j=0;$j<=$count-1;$j++)
                {
                        
                    $insert_data  	= array(  
                        
                        'qc_material'            =>  $_POST['qc_material'][$j],
                        'qc_unit'                =>  $_POST['qc_unit'][$j],
                        'qc_qty'                 =>  $_POST['qc_qty'][$j],
                        'qc_rate'               =>  $_POST['qc_rate'][$j],
                        'qc_amount'              =>  $_POST['qc_amount'][$j],
                        'qc_quotation_id'      =>  $quotation,
    
                    );
                
                    
                    $id = $this->common_model->InsertData('crm_quotation_cost_calculation',$insert_data);
            
                } 
            }

            $cond = array('qd_id'=>$quotation);

            

            $update_data = [
                'qd_cost_amount'           => $this->request->getPost('qd_cost_amount'),
                'qd_cost_amount_in_words'  => $this->request->getPost('qd_cost_amount_in_words'),
                'qd_percentage'            => $this->request->getPost('qd_percentage'),
            ];


            $this->common_model->EditData($update_data,$cond,'crm_quotation_details');
            
           
        }
         
        $joins = array(
            array(
                'table' => 'crm_customer_creation',
                'pk'    => 'cc_id',
                'fk'    => 'qd_customer',
            ),
            array(
                'table' => 'crm_enquiry',
                'pk'    => 'enquiry_id',
                'fk'    => 'qd_enq_ref',
            ),
            array(
                'table' => 'executives_sales_executive',
                'pk'    => 'se_id',
                'fk'    => 'qd_sales_executive',
            ),
            array(
                'table' => 'crm_contact_details',
                'pk'    => 'contact_id',
                'fk'    => 'qd_contact_person',
            ),
            array(
                'table' => 'master_delivery_term',
                'pk'    => 'dt_id',
                'fk'    => 'qd_delivery_term',
            ),
           

        );


        $quotation_details = $this->common_model->SingleRowJoin('crm_quotation_details',$cond,$joins);


        $data['reffer_no'] = $quotation_details->qd_reffer_no;

        $data['date'] = $quotation_details->qd_date;

        $data['customer'] = $quotation_details->cc_customer_name;

        $data['enquiry_ref'] = $quotation_details->enquiry_reff;

        $data['validity'] = $quotation_details->qd_validity;

        $data['sales_executive'] = $quotation_details->se_name;

        $data['contact_person'] = $quotation_details->contact_person;

        $data['payment_term'] = $quotation_details->qd_payment_term;

        $data['delivery_term'] = $quotation_details->dt_name;

        $data['project'] = $quotation_details->qd_project;


        $cond2 = array('qpd_quotation_details'=>$quotation);

        $joins2 = array(
            array(
                'table' => 'crm_products',
                'pk'    => 'product_id',
                'fk'    => 'qpd_product_description',
            ),
           

        );

        $product_details = $this->common_model->FetchWhere('crm_quotation_product_details',$cond2);

        
        $data['view_product'] = "";

       
            
            $i=1;
            foreach($product_details as $prod_det)
            {

            $data['view_product'] .=  '<tr>
                <td style="width: 10%;">'.$i.'</td>
                <td><input type="text"  value="'.$prod_det->qpd_unit.'" class="form-control" readonly></td>
                <td><input type="number" value="'.$prod_det->qpd_quantity.'" class="form-control" readonly></td>
                <td><input type="number"  value="'.$prod_det->qpd_rate.'" class="form-control" readonly></td>
                <td><input type="number" value="'.$prod_det->qpd_discount.'" class="form-control" readonly></td>
                <td><input type="number"  value="'.$prod_det->qpd_amount.'" class="form-control" readonly></td>
                
            </tr>';
            $i++;
        }


        
  
        echo json_encode($data);
    }



    public function AddTab3()
    {
        $cond = array('qd_id' => $this->request->getPost('qd_id'));

        $update_data = $this->request->getPost();

        $count = count($_POST['quotation_material']);

        for($i=0;$i<$count;$i++)
        {

            $insert_data['qc_quotation_id'] = $_POST['qd_id'];

            $insert_data['qc_material']=$_POST['quotation_material'][$i];

            $insert_data['qc_qty'] = $_POST['qc_qty'];

            $insert_data['qc_rate'] = $_POST['qc_qty'];

            $insert_data['qc_amount'] = $_POST['qc_amount'];

            $this->common_model->InsertData('crm_quotation_cost_calculation',$insert_data);

        }
        
    }



    public function EnquiryId()
    {
        $cond = array('enquiry_customer' => $this->request->getPost('ID'));

        $customer_enquiry = $this->common_model->FetchWhere('crm_enquiry',$cond);
        
        $data['enquiry_output'] = '<option value="" selected disabled>Select Enquiry Number</option>';

        foreach($customer_enquiry as $cust_enq)
        {
            $data['enquiry_output'] .= '<option value="'.$cust_enq->enquiry_id.'">'.$cust_enq->enquiry_enq_number.'</option>'; 
        }

        echo json_encode($data);
         
    }




    //account head modal 
    public function View()
    {
        
        $cond = array('qd_id' => $this->request->getPost('ID'));

        

        $joins = array(
            array(
                'table' => 'executives_sales_executive',
                'pk'    => 'se_id',
                'fk'    => 'qd_sales_executive',
            ),
            array(
                'table' => 'crm_customer_creation',
                'pk'    => 'cc_id',
                'fk'    => 'qd_customer',
            ),
            array(
                'table' => 'crm_contact_details',
                'pk'    => 'contact_id',
                'fk'    => 'qd_contact_person',
            ),
            array(
                'table' => 'master_delivery_term',
                'pk'    => 'dt_id',
                'fk'    => 'qd_delivery_term',
            )


        );

        $quotation_details = $this->common_model->SingleRowJoin('crm_quotation_details',$cond,$joins);

        $cond1 = array('qpd_quotation_details' => $this->request->getPost('ID'));

        $joins1 = array(
            array(
                'table' => 'crm_products',
                'pk'    => 'product_id',
                'fk'    => 'qpd_product_description',
            ),
        );

        $product_details_data = $this->common_model->FetchWhereJoin('crm_quotation_product_details',$cond1,$joins1);
         

        $data['reffer_no']  = $quotation_details->qd_reffer_no;

        $data['date']              = $quotation_details->qd_date;

        $data['customer_name']          = $quotation_details->cc_customer_name;

        $data['qd_enquiry_reference'] = $quotation_details->qd_enq_ref;

        $data['qd_validity']          = $quotation_details->qd_validity;

        $data['qd_sales_executive']   = $quotation_details->se_name;

        $data['qd_contact_person']    = $quotation_details->contact_person;

        $data['qd_payment_term']      = $quotation_details->qd_payment_term;

        $data['qd_delivery_term']     = $quotation_details->qd_delivery_term;

        $data['qd_project']           = $quotation_details->qd_project;

       

       

        

        

        /*$data['qd_delivery_term']     = $quotation_details->dt_name;

        $data['qd_materials']         = $quotation_details->qd_materials;

        $data['qd_qty']               = $quotation_details->qd_qty;

        $data['qd_rate']              = $quotation_details->qd_rate;

        $data['qd_amount']            = $quotation_details->qd_amount;

        $data['qd_cost_of_sale']      = $quotation_details->qd_cost_of_sale;

        $data['qd_gross_profit']      = $quotation_details->qd_gross_profit;

        $data['qd_direct']      = $quotation_details->qd_direct;*/


         
        
        /*$data['prod_details'] ='<table  class="table table-bordered table-striped delTable"><tbody class="travelerinfo"><tr><td >
        Serial No.</td><td>Product Description</td><td>Unit</td><td>Quantity</td><td>Rate</td><td>Discount</td><td>Amount</td></tr>';

        foreach($product_details_data as $prod_det)
        {
            $data['prod_details'] .='<tr>
            <td><input type="text"  value="'.$prod_det->qpd_serial_no.'" class="form-control " readonly></td>
            <td><input type="text"  value="'.$prod_det->product_details.'" class="form-control " readonly></td>
            <td><input type="text"  value="'.$prod_det->qpd_unit.'" class="form-control " readonly></td>
            <td> <input type="text" value="'.$prod_det->qpd_quantity.'" class="form-control " readonly></td>
            <td> <input type="text" value="'.$prod_det->qpd_rate.'" class="form-control " readonly></td>
            <td> <input type="text" value="'.$prod_det->qpd_discount.'" class="form-control " readonly></td>
            <td> <input type="text" value="'.$prod_det->qpd_amount.'" class="form-control " readonly></td>
            </tr>'; 
             
        }
        
        $data['prod_details'] .= '</tbody></table>';*/

        
        echo json_encode($data);
    }


    public function ContactPerson()
    {
        $cond = array('contact_customer_creation' => $this->request->getPost('ID'));

       

        $cond1 = array('cc_id' => $this->request->getPost('ID'));

        $customer_creation = $this->common_model->SingleRow('crm_customer_creation',$cond1);

        $cond2 = array('enquiry_customer' => $this->request->getPost('ID'));

        $single_enquiry = $this->common_model->SingleRow('crm_enquiry',$cond2);

       
        $data['cc_credit_term'] = $customer_creation->cc_credit_term;


        //new
       

        $contact_details = $this->common_model->FetchWhere('crm_contact_details',$cond);		

 
        $data['customer_person'] ="";

        $data['customer_person'] ='<option value="" selected disabled>Select  Contact Person</option>';

        foreach($contact_details as $con_det)
        {
            
            
            $data['customer_person'] .='<option value='.$con_det->contact_id.'>'.$con_det->contact_person.'</option>';
        }


        $enquiry_customer = $this->common_model->FetchEnquiryInQuot($this->request->getPost('ID'));

        $data['enquiry_customer'] = "";
        $data['enquiry_customer'] ='<option value="" selected disabled>Selected Enquiry</option>';  

        foreach($enquiry_customer as $enq_cust)
        {
            $data['enquiry_customer'] .='<option value='.$enq_cust->enquiry_id.'';
           
            $data['enquiry_customer'] .='>' .$enq_cust->enquiry_reff. '</option>'; 
        }

        echo json_encode($data);


    }

    public function ProjectEnquiry()
    {
        $cond = array('enquiry_contact_person' => $this->request->getPost('ID'));

        $enquiry = $this->common_model->SingleRow('crm_enquiry',$cond);

        if(!empty($enquiry))
        {
            $data['enquiry_project']        = $enquiry->enquiry_project;

            $data['enquiry_enq_referance']  = $enquiry->enquiry_enq_referance;
        }
        else
        {
            $data['enquiry_project']        = "";

            $data['enquiry_enq_referance']  = "";
        }
       
        echo json_encode($data);
    }


    // update account head 
   /* public function Update()
    {    
        
        $cond = array('at_id' => $this->request->getPost('account_id'));
        
        $update_data = $this->request->getPost();
        
        print_r($update_data); exit();

        // Check if the 'account_id' key exists before unsetting it
        if (array_key_exists('account_id', $update_data)) 
        {
            unset($update_data['account_id']);
        }  
        
        //print_r($this->request->getPost('qd_date')); exit();
        
        $update_data['qd_date'] = date('Y-m-d',strtotime($this->request->getPost('qd_date'))); 

        $update_data['at_added_by'] = 0; 

        $update_data['at_modify_date'] = date('Y-m-d'); 
        
        $this->common_model->EditData($update_data,$cond,'accounts_account_types');
       
    }*/




    //delete contact details
    public function DeleteContact()
    {
        $cond = array('pd_id' => $this->request->getPost('ID'));
 
        $this->common_model->DeleteData('crm_quotation_details',$cond);

        
    }


    public function Delete()
    {
        $cond = array('qd_id' => $this->request->getPost('ID'));
 
        $this->common_model->DeleteData('crm_quotation_details',$cond);

        $cond1 = array('qpd_quotation_details' => $this->request->getPost('ID'));
 
        $this->common_model->DeleteData('crm_quotation_product_details',$cond1);


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


    public function FetchProject()
    {
        
        $cond = array('enquiry_id' => $this->request->getPost('ID'));

        $enquiry = $this->common_model->SingleRow('crm_enquiry',$cond);

        $data['enquiry_project'] = $enquiry->enquiry_project;

        $cond1 = array('pd_enquiry_id' => $this->request->getPost('ID'));

        $product_details = $this->common_model->FetchWhere('crm_product_detail',$cond1);

        $products = $this->common_model->FetchAllOrder('crm_products','product_id','desc');

        $cond2 = array('contact_customer_creation' => $this->request->getPost('custID'));

        $contact_details = $this->common_model->FetchWhere('crm_contact_details',$cond2);
        
        $data['customer_person'] ="";

        $data['customer_person'] ='<option value="" selected disabled>Select  Contact Person</option>';

        foreach($contact_details as $con_det)
        {
            
            
            $data['customer_person'] .='<option  value='.$con_det->contact_id.'';
           if($con_det->contact_id  == $enquiry->enquiry_contact_person){
            $data['customer_person'] .=    " selected ";}
           
            $data['customer_person'] .='>' .$con_det->contact_person. '</option>';

        }
        
        $data['product_detail'] = "";

       
            
            $i=1;
            foreach($product_details as $prod_det)
            {

            $data['product_detail'] .=  '<tr class="prod_row enq_remove" id="'.$prod_det->pd_id.'">
                <td style="width: 10%;" class="si_no">'.$i.'</td>
                <td style="width:20%">
                    <select class="form-select droup_product add_prod" name="qpd_product_description[]" required>';
                    
                        foreach($products as $prod){
                            $data['product_detail'] .='<option value="'.$prod->product_id.'" '; 
                            if($prod->product_id == $prod_det->pd_product_detail){ $data['product_detail'] .= "selected"; }
                            $data['product_detail'] .='>'.$prod->product_details.'</option>';
                        }
                    $data['product_detail'] .='</select>
                </td>
                <td><input type="text" name="qpd_unit[]" value="'.$prod_det->pd_unit.'" class="form-control" required></td>
                <td><input type="number" name="qpd_quantity[]" value="'.$prod_det->pd_quantity.'" class="form-control qtn_clz_id" required></td>
                <td><input type="number" name="qpd_rate[]"  class="form-control rate_clz_id" required></td>
                <td><input type="number" name="qpd_discount[]"  class="form-control discount_clz_id" required></td>
                <td><input type="number" name="qpd_amount[]" class="form-control amount_clz_id" readonly></td>
                <td class="remove-btnpp row_remove" data-id="'.$prod_det->pd_id.'"><i class="ri-close-line"></i>Remove</td>
            </tr>';
            $i++;
        }



        echo json_encode($data);


    }


    public function Edit()
    {
        $cond = array('qd_id' => $this->request->getPost('ID'));

        $joins = array(
            
            array(
                'table' => 'crm_customer_creation',
                'pk'    => 'cc_id',
                'fk'    => 'qd_customer',
            ),
            array(
                'table' => 'executives_sales_executive',
                'pk'    => 'se_id',
                'fk'    => 'qd_sales_executive',
            ),
          
            array(
                'table' => 'crm_enquiry',
                'pk'    => 'enquiry_id',
                'fk'    => 'qd_enq_ref',
            ),
           
            
        );

        $quotation_details = $this->common_model->SingleRowJoin('crm_quotation_details',$cond,$joins);

        $customer_creation = $this->common_model->FetchAllOrder('crm_customer_creation','cc_id','desc');

        $sales_executive = $this->common_model->FetchAllOrder('executives_sales_executive','se_id','desc');

        $delivery_term = $this->common_model->FetchAllOrder('master_delivery_term','dt_id','desc');

       

        $cond3 = array('contact_customer_creation'=>$quotation_details->qd_customer);

        $quot_contact_det = $this->common_model->FetchWhere('crm_contact_details',$cond3);

        $data['reffer_no']      = $quotation_details->qd_reffer_no;

        $data['date']           = date('d-M-Y',strtotime($quotation_details->qd_date));

        
        $data['customer_creation'] ="";

        foreach($customer_creation as $cus_creation)
        {
            $data['customer_creation'] .= '<option value="' .$cus_creation->cc_id. '"'; 
        
            // Check if the current product head is selected
            if ($cus_creation->cc_id  == $quotation_details->qd_customer)
            {
                $data['customer_creation'] .= ' selected'; 
            }
        
            $data['customer_creation'] .= '>' . $cus_creation->cc_customer_name . '</option>';
        }


        $data['enquiry_ref'] ="";

        

        $data['enquiry_ref'] .= '<option value="' .$quotation_details->enquiry_id. '"'; 
        
        // Check if the current product head is selected
           
        $data['enquiry_ref'] .= '>' . $quotation_details->enquiry_reff . '</option>';
      


        $data['validity']       = $quotation_details->qd_validity;

        

        $data['sales_exec'] ="";

        foreach($sales_executive as $sale_exec)
        {
            $data['sales_exec'] .= '<option value="' .$sale_exec->se_id. '"'; 
        
            // Check if the current product head is selected
            if ($sale_exec->se_id   == $quotation_details->qd_sales_executive)
            {
                $data['sales_exec'] .= ' selected'; 
            }
        
            $data['sales_exec'] .= '>' . $sale_exec->se_name . '</option>';
        }


        $data['contact_person']  ="";
        foreach($quot_contact_det as $quot_cont)
        {
            $data['contact_person'] .= '<option value="' .$quot_cont->contact_id. '"'; 
        
            // Check if the current product head is selected
            if ($quot_cont->contact_id   == $quotation_details->qd_contact_person)
            {
                $data['contact_person'] .= ' selected'; 
            }
        
            $data['contact_person'] .= '>' . $quot_cont->contact_person . '</option>';
        }


        $data['delivery_term']  ="";


        foreach($delivery_term as $del_term)
        {
            $data['delivery_term'] .= '<option value="' .$del_term->dt_id. '"'; 
        
            // Check if the current product head is selected
            if ($del_term->dt_id   == $quotation_details->qd_delivery_term)
            {
                $data['delivery_term'] .= ' selected'; 
            }
        
            $data['delivery_term'] .= '>' . $del_term->dt_name. '</option>';
        }


        $data['payment_term']   = $quotation_details->qd_payment_term;

        $single_delevery_term = [
            'qd_delivery_term' => $quotation_details->qd_delivery_term // This is just an example, replace it with actual data
        ];

       
        $data['project']           = $quotation_details->qd_project;

        $data['quot_total_amount'] = $quotation_details->qd_sales_amount;

        $data['quot_percentage']   = $quotation_details->qd_percentage;


        //product detail table section start
        
        $cond1 = array('qpd_quotation_details' => $quotation_details->qd_id);

        $joins1 = array(
            array(
                'table' => 'crm_products',
                'pk'    => 'product_id',
                'fk'    => 'qpd_product_description',
            ),
        );

        $product_details_data = $this->common_model->FetchWhereJoin('crm_quotation_product_details',$cond1,$joins1);
        
        $i=1;
        $data['prod_details'] ="";
        foreach($product_details_data as $prod_det)
        {
            $data['prod_details'] .='<tr class="edit_add_prod_row">
            <td class="edit_add_prod_si_no"><input type="text"  value="'.$i.'" class="form-control " readonly></td>
            <td><input type="text"  value="'.$prod_det->product_details.'" class="form-control " readonly></td>
            <td><input type="text"  value="'.$prod_det->qpd_unit.'" class="form-control " readonly></td>
            <td> <input type="text" value="'.$prod_det->qpd_quantity.'" class="form-control " readonly></td>
            <td> <input type="text" value="'.$prod_det->qpd_rate.'" class="form-control " readonly></td>
            <td> <input type="text" value="'.$prod_det->qpd_discount.'" class="form-control " readonly></td>
            <td> <input type="text" value="'.$prod_det->qpd_amount.'" class="form-control edit_prod_total_amount" readonly></td>
            <td style="width:15%">
                <a href="javascript:void(0)" class="edit edit-color edit_prod_btn" data-id="'.$prod_det->qpd_id.'" data-toggle="tooltip" data-placement="top" title="edit" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a>
	            <a href="javascript:void(0)" class="delete delete-color delete_prod_btn" data-id="'.$prod_det->qpd_id.'" data-toggle="tooltip" data-placement="top" title="Delete"><i class="ri-delete-bin-fill"></i> Delete</a>
            </td>
            </tr>'; 

            $i++;   
        }



        //cost calculation table start

        $cond2 = array('qc_quotation_id' => $quotation_details->qd_id);

        $joins2 = array(
            array(
                'table' => 'crm_products',
                'pk'    => 'product_id',
                'fk'    => 'qc_material',
            ),
        );

        $cost_product_detail = $this->common_model->FetchWhereJoin('crm_quotation_cost_calculation',$cond2,$joins2);
      

        $j = 1;
        $data['cost_prod_det'] ="";
        foreach($cost_product_detail as $cost_prod)
        {
            $data['cost_prod_det'] .='<tr class="edt_cost_row">
            <td class="edit_cost_si_no">'.$j.'</td>
            <td><input type="text" value="'.$cost_prod->product_details.'" class="form-control" readonly></td>
            <td><input type="text" value="'.$cost_prod->qc_unit.'" class="form-control" readonly></td>
            <td><input type="text" value="'.$cost_prod->qc_qty.'" class="form-control" readonly></td>
            <td><a href="javascript:void(0)">click</a></td>
            <td><input type="text" value="'.$cost_prod->qc_rate.'" class="form-control" readonly></td>
            <td><input type="text" value="'.$cost_prod->qc_amount.'" class="form-control edit_cal_amount" readonly></td>
            <td style="width:15%">
                <a href="javascript:void(0)" class="edit edit-color edit_cost_cal_btn" data-id="'.$cost_prod->qc_id.'" data-toggle="tooltip" data-placement="top" title="edit" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a>
	            <a href="javascript:void(0)" class="delete delete-color delete_cost_cal_btn" data-id="'.$cost_prod->qc_id.'" data-toggle="tooltip" data-placement="top" title="Delete"><i class="ri-delete-bin-fill"></i> Delete</a>
            </td>
            </tr>'; 

            $j++;   
        }


        $data['cost_amount']       = $quotation_details->qd_cost_amount;

      
        echo json_encode($data);


    }


    //Edit contact person

    public function EditContactPerson()
    {
        $cond = array('contact_customer_creation' => $this->request->getPost('ID'));
        
        
       
        $enquiry_cust = $this->common_model->FetchEnquiryInQuot($this->request->getPost('ID'));

       // $enquiry_data = $this->common_model->SingleRow('crm_enquiry',array('enquiry_id' =>$this->request->getPost('EnquiryId')));
          
       $quotation_details = $this->common_model->SingleRow('crm_quotation_details',array('qd_id' =>$this->request->getPost('QuotId')));
        
       
        
       $enquiry_data = $this->common_model->SingleRow('crm_enquiry',array('enquiry_id' =>$quotation_details->qd_enq_ref));
        

        /*$cus="";
       
        if(!empty($enquiry_data->enquiry_customer)){
            $cus = $enquiry_data->enquiry_customer;
        } 
        else
        {
           
        }

      

        $cus = $enquiry_data->enquiry_customer;*/
       
        if($this->request->getPost('ID') == $enquiry_data->enquiry_customer)
        {
           

            $data['enquiry_ref'] ='<option value='.$enquiry_data->enquiry_id.'>'.$enquiry_data->enquiry_reff.'</option>';  
            //echo "not empty";
        }
        else
        {   
           

            $data['enquiry_ref'] ='<option value="" selected disabled>Selected Enquiry</option>'; 
            //echo "empty";
        }
	   
        //$data['enquiry_ref'] ='<option value="" selected disabled>Selected Enquiry</option>';  

        foreach($enquiry_cust as $enq_cust)
        {
            $data['enquiry_ref'] .='<option value='.$enq_cust->enquiry_id.'';
        
            $data['enquiry_ref'] .='>' .$enq_cust->enquiry_reff. '</option>'; 
        }



        $contact_details = $this->common_model->FetchWhere('crm_contact_details',$cond);

        $data['contact_person'] ="";
        
        $data['contact_person'] .="<option value='' selected disabled>Select Contact Person</option>";
        
        foreach($contact_details as $con_det)
        {
            $data['contact_person'] .='<option value='.$con_det->contact_id.'>'.$con_det->contact_person.'</option>';
        }


        echo json_encode($data);
    }


    public function EditCostCal()
    {
        $cond = array('qc_id' => $this->request->getPost('ID'));

        $joins = array(
            
            array(
                'table' => 'crm_products',
                'pk'    => 'product_id',
                'fk'    => 'qc_material',
            ),
            
            
        );

        $cost_cal = $this->common_model->SingleRowJoin('crm_quotation_cost_calculation',$cond,$joins);

        $products = $this->common_model->FetchAllOrder('crm_products','product_id','desc');

        $data['material'] ="";

        foreach($products as $prod)
        {
            $data['material'] .= '<option value="' .$prod->product_id. '"'; 
        
            // Check if the current product head is selected
            if ($prod->product_id  == $cost_cal->product_details)
            {
                $data['material'] .= ' selected'; 
            }
        
            $data['material'] .= '>' . $prod->	product_details . '</option>';
        }

        //$data['material'] = $cost_cal->product_details;

        $data['unit'] = $cost_cal->qc_unit;

        $data['qty'] = $cost_cal->qc_qty;

        $data['rate'] = $cost_cal->qc_rate;

        $data['amount'] = $cost_cal->qc_amount;

        echo json_encode($data);

    }


    public function UpdateCostCal()
    {
        $cond = array('qc_id' => $this->request->getPost('qc_id'));
        
        $update_data = $this->request->getPost();
        
        // Check if the 'account_id' key exists before unsetting it
        if (array_key_exists('qc_id', $update_data)) 
        {
            unset($update_data['qc_id']);
        }    
        
        $this->common_model->EditData($update_data,$cond,'crm_quotation_cost_calculation');

        $single_cost_cal = $this->common_model->SingleRow('crm_quotation_cost_calculation',$cond);

        $cond2 = array('qc_quotation_id'=>$single_cost_cal->qc_quotation_id);

        $cost_calculation = $this->common_model->FetchWhere('crm_quotation_cost_calculation',$cond2);
        
        $old_amount = 0;

        foreach($cost_calculation as $cost_cal)
        {
            $old_amount =  $old_amount + $cost_cal->qc_amount;
        }

        
        
        $quotation_update = array('qd_cost_amount' => $old_amount);

        $cond3 = array('qd_id'=>$single_cost_cal->qc_quotation_id);

        $this->common_model->EditData($quotation_update,$cond3,'crm_quotation_details');


        $data['quot_id']  =  $single_cost_cal->qc_quotation_id;
       
        $this->UpdatePercentage($single_cost_cal->qc_quotation_id);

        echo json_encode($data);  
 
    }


    public function EditAddCostCal()
    {
        $insert_data = $this->request->getPost();

        $quot_det = $this->common_model->InsertData('crm_quotation_cost_calculation',$insert_data);

        $cond = array('qc_id'=> $quot_det);

        $single_cost_cal = $this->common_model->SingleRow('crm_quotation_cost_calculation',$cond);

        $quot_id = $single_cost_cal->qc_quotation_id;

        $cond2 = array('qc_quotation_id' => $quot_id);

        $cost_calculation = $this->common_model->FetchWhere('crm_quotation_cost_calculation',$cond2);

        

        $old_amount = 0;

        foreach($cost_calculation as $cost_cal)
        {
            $old_amount =  $old_amount + $cost_cal->qc_amount;
        }
        
        $quotation_update = array('qd_cost_amount' => $old_amount);

        $cond3 = array('qd_id'=>$single_cost_cal->qc_quotation_id);

        $this->common_model->EditData($quotation_update,$cond3,'crm_quotation_details');


        $data['quot_id']  =  $single_cost_cal->qc_quotation_id;

        $this->UpdatePercentage($single_cost_cal->qc_quotation_id);

        echo json_encode($data); 


    }


    public function DeleteCostCal()
    {
        $cond = array('qc_id' => $this->request->getPost('ID'));
 
        $this->common_model->DeleteData('crm_quotation_cost_calculation',$cond);
    }


    public function EditProdDet()
    {
        $cond = array('qpd_id ' => $this->request->getPost('ID'));

       
        $products = $this->common_model->FetchAllOrder('crm_products','product_id','desc');

        $prod_det = $this->common_model->SingleRow('crm_quotation_product_details',$cond);
        
        
        $data['prod_details'] ="";
        
            $data['prod_details'] .='<tr class="edit_prod_row">
            <td>1</td>
           
            <td><select class="form-select droup_product" name="qpd_product_description" required>';
                    
                foreach($products as $prod){
                    $data['prod_details'] .='<option value="'.$prod->product_id.'" '; 
                    if($prod->product_id == $prod_det->qpd_product_description){ $data['prod_details'] .= "selected"; }
                    $data['prod_details'] .='>'.$prod->product_details.'</option>';
                }
						
            $data['prod_details'] .='</select></td>

            <td><input type="text" name="qpd_unit"  value="'.$prod_det->qpd_unit.'" class="form-control " required></td>
            <td> <input type="text" name="qpd_quantity" value="'.$prod_det->qpd_quantity.'" class="form-control edit_prod_qty" required></td>
            <td> <input type="text" name="qpd_rate" value="'.$prod_det->qpd_rate.'" class="form-control edit_prod_rate" required></td>
            <td> <input type="text" name="qpd_discount" value="'.$prod_det->qpd_discount.'" class="form-control edit_prod_dis" required></td>
            <td> <input type="text" name="qpd_amount" value="'.$prod_det->qpd_amount.'" class="form-control edit_prod_amount" readonly></td>
           <input type="hidden" name="qpd_id" value="'.$prod_det->qpd_id.'">
            </tr>'; 

       
        echo json_encode($data); 

    }

    public function UpdateProd()
    {
      
        $cond = array('qpd_id' => $this->request->getPost('qpd_id'));
        
        $update_data = $this->request->getPost();

        // Check if the 'account_id' key exists before unsetting it
        if (array_key_exists('qpd_id', $update_data)) 
        {
            unset($update_data['qpd_id']);
        }    
        
        $this->common_model->EditData($update_data,$cond,'crm_quotation_product_details');

        $cond2 = array('qpd_id'=>$this->request->getPost('qpd_id'));

        $single_prod  = $this->common_model->SingleRow('crm_quotation_product_details',$cond2);


        $cond2 = array('qpd_quotation_details' => $single_prod->qpd_quotation_details);

        $product_details = $this->common_model->FetchWhere('crm_quotation_product_details',$cond2);
        
        $old_amount = 0;

        foreach($product_details as $prod_det)
        {
            $old_amount =  $old_amount + $prod_det->qpd_amount;
        }

        $quotation_update = array('qd_sales_amount' => $old_amount);

        $cond3 = array('qd_id'=>$single_prod->qpd_quotation_details);

        $this->common_model->EditData($quotation_update,$cond3,'crm_quotation_details');

        $data['quotation_id']  =  $single_prod->qpd_quotation_details;

        $this->UpdatePercentage($single_prod->qpd_quotation_details);

        echo json_encode($data); 
    }

    public function EditAddProd()
    {   

        $insert_data = $this->request->getPost();

        $quot_det = $this->common_model->InsertData('crm_quotation_product_details',$insert_data);

        $cond = array('qpd_id' => $quot_det);

        $single_prod = $this->common_model->SingleRow('crm_quotation_product_details',$cond);

        $cond2 = array('qpd_quotation_details' => $single_prod->qpd_quotation_details);

        $product_details  = $this->common_model->FetchWhere('crm_quotation_product_details',$cond2);

        

        $old_amount = 0;

        foreach($product_details as $prod_det)
        {
            $old_amount =  $old_amount + $prod_det->qpd_amount;
        }

        $quotation_update = array('qd_sales_amount' => $old_amount);

        $cond3 = array('qd_id'=>$single_prod->qpd_quotation_details);

        $this->common_model->EditData($quotation_update,$cond3,'crm_quotation_details');

        $data['quotation_id']  =  $single_prod->qpd_quotation_details;

        $this->UpdatePercentage($single_prod->qpd_quotation_details);

        echo json_encode($data); 



    }

    public function UpdatePercentage($quot_id)
    {
       $cond = array('qd_id' => $quot_id);

       $single_prod  = $this->common_model->SingleRow('crm_quotation_details',$cond);
       
       $sales_amount = $single_prod->qd_sales_amount;

       $cost_amount = $single_prod->qd_cost_amount;

       $result = $cost_amount / $sales_amount;

       $percentage = $result * 100;
       
       $percentage = number_format((float)$percentage, 2, '.', '');  // Outputs -> 105.00

       $data = array('qd_percentage' => $percentage);

        $cond2 = array('qd_id' => $quot_id);

        $this->common_model->EditData($data,$cond2,'crm_quotation_details');


    }


     public function DeleteProdDet()
     {
        $cond = array('qpd_id' => $this->request->getPost('ID'));
 
        $this->common_model->DeleteData('crm_quotation_product_details',$cond);
     }


    public function UpdateTab()
    {
        $updated_data = [

            'qd_reffer_no'         => $this->request->getPost('qd_reffer_no'),

            'qd_date'              => date('Y-m-d',strtotime($this->request->getPost('qd_date'))),

            'qd_customer'          => $this->request->getPost('qd_customer'),

            'qd_enq_ref'           => $this->request->getPost('qd_enq_ref'),

            'qd_validity'          => $this->request->getPost('qd_validity'),

            'qd_sales_executive'   => $this->request->getPost('qd_sales_executive'),

            'qd_contact_person'    => $this->request->getPost('qd_contact_person'),

            'qd_payment_term'      => $this->request->getPost('qd_payment_term'),

            'qd_delivery_term'     => $this->request->getPost('qd_delivery_term'),

            'qd_project'           => $this->request->getPost('qd_project'),

            'qd_modified_date'     => date('Y-m-d'),
            
        ];

        $cond2 = array('qd_id' => $this->request->getPost('qd_id'));

        $this->common_model->EditData($updated_data,$cond2,'crm_quotation_details');

        $data['qd_id']  =  $this->request->getPost('qd_id');

        echo json_encode($data); 

    }



    public function Print($id){

        $mpdf = new \Mpdf\Mpdf();

        
        $cond = array('qd_id' => $id);

        
        $joins = array(
            
            array(
                'table' => 'crm_customer_creation',
                'pk'    => 'cc_id',
                'fk'    => 'qd_customer',
            ),
            array(
                'table' => 'executives_sales_executive',
                'pk'    => 'se_id',
                'fk'    => 'qd_sales_executive',
            ),
           
            
        );

        $quotation = $this->common_model->SingleRowJoin('crm_quotation_details',$cond,$joins);
        
        $cond1 = array('qpd_quotation_details' => $quotation->qd_id);

        $joins1 = array(
            
            array(
                'table' => 'crm_products',
                'pk'    => 'product_id',
                'fk'    => 'qpd_product_description',
            ),
           
            
        );

        $quotation_details = $this->common_model->FetchWhereJoin('crm_quotation_product_details',$cond1,$joins1);
        
        

        foreach($quotation_details as $quot_det)
        {
            $prod_det ="{$quot_det->product_details}";

            
        }

        $html ='
    
        <style>

        th, td {
            padding-top: 10px;
            padding-bottom: 10px;
            padding-left: 5px;
            padding-right: 5px;
            font-size:12px;
        }
        </style>
    
        <table>
        
        <tr>
        
        <td>
    
        <h3>Al Fuzail Engineering Services WLL</h3>
        <p>Tel : +974 4460 4254, Fax : 4029 8994, email : engineering@alfuzailgroup.com</p>
        <p>Post Box : 201978, Gate : 248, Street : 24, Industrial Area, Doha - Qatar</p>
        
        
        </td>
        
        </tr>
    
        </table>
    
    
    
        <table width="100%" style="margin-top:10px;">
        
    
        <tr width="100%">
        
        <td>Period : 01 Sep 2020 to 03 Sep 2020</td>

        <td align="right"><h3>Sales Quotation Report</h3></td>
    
        </tr>
    
        </table>
    
    
    
        <table  width="100%" style="margin-top:2px;border-top:2px solid;border-collapse: collapse; border-spacing: 0;">
        
    
        <tr  style="border-bottom:3px solid;">
        
        <th align="left">Date</th>
    
        <th align="left">Quotation Ref.</th>
    
        <th align="left">Customer</th>
    
        <th align="left">Sales Executive</th>
    
        <th align="left">Amount</th>
    
        <th align="left">Product</th>

        <th align="left">Quantity</th>

        <th align="left">Rate</th>

        <th align="left">Amount</th>
    
        </tr>
    
    
    
        <tr>
    
    
        
        <td style="border-bottom:2px solid">'.$quotation->qd_date.'</td>
    
        <td style="border-bottom:2px solid">'.$quotation->qd_quotation_number.'</td>
    
        <td style="border-bottom:2px solid">'.$quotation->cc_customer_name.'</td>
    
        <td style="border-bottom:2px solid">'.$quotation->se_name.'</td>
    
        <td style="border-bottom:2px solid">2500</td>
    
        <td style="border-bottom:2px solid">'.$prod_det.'</td>

        <td style="border-bottom:2px solid">2</td>

        <td style="border-bottom:2px solid">4,600.00</td>

        <td style="border-bottom:2px solid">6,265.00</td>
        
        </tr>

        <tr>
        
            <td>Total</td>

            <td></td>

            <td></td>

            <td></td>

            <td>864,925.00</td>

            <td></td>

            <td></td>

            <td></td>

            <td>864,925.00</td>
        
        </tr>
    
    
        
        </table>

       
    
        ';
    
        $footer = '';
    
        
        $mpdf->WriteHTML($html);
        $mpdf->SetFooter($footer);
        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output();
    
        }



}
