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
       
        $searchColumns = array('qd_quotation_number');

        $totalRecordwithFilter = $this->common_model->GetTotalRecordwithFilter('crm_quotation_details','qd_id',$searchValue,$searchColumns);
    
        ##Joins if any //Pass Joins as Multi dim array
        $joins = array(
            array(
                'table' => 'crm_customer_creation',
                'pk'    => 'cc_id',
                'fk'    => 'qd_customer',
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
              'qd_quotation_number' => $record->qd_quotation_number,
              'qd_date'             => date('d-m-Y',strtotime($record->qd_date)),
              'qd_customer'         => $record->cc_customer_name,
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



    public function FetchTypes1()
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

        $data['content'] = view('crm/sales-quotation',$data);

        return view('crm/crm-module',$data);

    }


    // add account head
    Public function Add()
    {   
        
        $insert_data = $this->request->getPost();

        $insert_data['qd_added_by'] = 0; 

        $insert_data['qd_added_date'] = date('Y-m-d'); 

        $id = $this->common_model->InsertData('crm_quotation_details',$insert_data);

        $data['qd_id'] = $id;
        
        $p_ref_no = 'SQ'.str_pad($id, 7, '0', STR_PAD_LEFT);
        
        $cond = array('qd_id' => $id);

        $update_data['qd_quotation_number'] = $p_ref_no;

        $this->common_model->EditData($update_data,$cond,'crm_quotation_details');

        echo json_encode($data);

    }

    public function AddTab2()
    {
        //$insert_data = $this->request->getPost();
        if($_POST)
        {
	        if(!empty($_POST['qpd_unit']))
			{
			    $count =  count($_POST['qpd_unit']);
					
				if($count!=0)
			    {  
					for($j=0;$j<=$count-1;$j++)
					{
							
					    $insert_data  	= array(  
							'qpd_serial_no'            =>  $_POST['qpd_serial_no'][$j],
							'qpd_product_description'  =>  $_POST['qpd_product_description'][$j],
							'qpd_unit'                 =>  $_POST['qpd_unit'][$j],
						    'qpd_quantity'             =>  $_POST['qpd_quantity'][$j],
                            'qpd_rate'                 =>  $_POST['qpd_rate'][$j],
                            'qpd_discount'             =>  $_POST['qpd_discount'][$j],
                            'qpd_amount'               =>  $_POST['qpd_amount'][$j],
                            'qpd_quotation_details'    =>  $_POST['qpd_quotation_details'],
	  
					    );
					
						
				        $id = $this->common_model->InsertData('crm_quotation_product_details',$insert_data);
				
				    } 
				}
			}
			
			
        }
     
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
         

        $data['qd_quotation_number']  = $quotation_details->qd_quotation_number;

        $data['qd_date']              = $quotation_details->qd_date;

        $data['qd_payment_term']      = $quotation_details->qd_payment_term;

        $data['qd_delivery_term']     = $quotation_details->qd_delivery_term;

        $data['qd_validity']          = $quotation_details->qd_validity;

        $data['qd_project']           = $quotation_details->qd_project;

        $data['qd_enquiry_reference'] = $quotation_details->qd_enquiry_reference;

        $data['qd_customer']          = $quotation_details->cc_customer_name;

        $data['qd_contact_person']    = $quotation_details->contact_person;

        $data['qd_sales_executive']   = $quotation_details->se_name;

        $data['qd_delivery_term']     = $quotation_details->dt_name;

        $data['qd_materials']         = $quotation_details->qd_materials;

        $data['qd_qty']               = $quotation_details->qd_qty;

        $data['qd_rate']              = $quotation_details->qd_rate;

        $data['qd_amount']            = $quotation_details->qd_amount;

        $data['qd_cost_of_sale']      = $quotation_details->qd_cost_of_sale;

        $data['qd_gross_profit']      = $quotation_details->qd_gross_profit;

        $data['qd_direct']      = $quotation_details->qd_direct;


         
        
        $data['prod_details'] ='<table  class="table table-bordered table-striped delTable"><tbody class="travelerinfo"><tr><td >
        Serial No.</td><td>Product Description</td><td>Unit</td><td>Quantity</td><td>Rate</td><td>Discount</td><td>Amount</td></tr>';

        foreach($product_details_data as $prod_det)
        {
            $data['prod_details'] .='<tr>
            <td><input type="text"   value="'.$prod_det->qpd_serial_no.'" class="form-control " readonly></td>
            <td><input type="text"   value="'.$prod_det->product_details.'" class="form-control " readonly></td>
            <td><input type="text"   value="'.$prod_det->qpd_unit.'" class="form-control " readonly></td>
            <td> <input type="text" value="'.$prod_det->qpd_quantity.'" class="form-control " readonly></td>
            <td> <input type="text" value="'.$prod_det->qpd_rate.'" class="form-control " readonly></td>
            <td> <input type="text" value="'.$prod_det->qpd_discount.'" class="form-control " readonly></td>
            <td> <input type="text" value="'.$prod_det->qpd_amount.'" class="form-control " readonly></td>
            </tr>'; 
             
        }
        
        $data['prod_details'] .= '</tbody></table>';

        
        echo json_encode($data);
    }


    public function ContactPerson()
    {
        $cond = array('contact_customer_creation' => $this->request->getPost('ID'));

        $contact_details = $this->common_model->FetchWhere('crm_contact_details',$cond);

        
        $cond1 = array('cc_id' => $this->request->getPost('ID'));

        $customer_creation = $this->common_model->SingleRow('crm_customer_creation',$cond1);

        
        $data['customer_name'] ="";

        $data['customer_name'] ='<option value="" selected disabled>Select  Contact Person</option>';

        foreach($contact_details as $con_det)
        {
            $data['customer_name'] .='<option value='.$con_det->contact_id.'';
           
            $data['customer_name'] .='>' .$con_det->contact_person. '</option>'; 
        }

        $data['cc_credit_term'] = $customer_creation->cc_credit_term;

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


    //fetch inquiry
    public function FetchEnquiry()
    {   
       
        $cond = array('enquiry_id' => $this->request->getPost('ID'));

        $enquiry = $this->common_model->SingleRow('crm_enquiry',$cond);
       
        $cond1 = array('pd_customer_details' => $this->request->getPost('ID'));

        $product_detail = $this->common_model->FetchWhere('crm_product_detail',$cond1);

        $products = $this->common_model->FetchAllOrder('crm_products','product_id','desc');
       
        
        $data['contact_person'] = $enquiry->enquiry_contact_person;

        $data['sales_executive'] = $enquiry->enquiry_sales_executive;

        $data['enquiry_validity'] = $enquiry->enquiry_validity;

        $data['enquiry_project'] = $enquiry->enquiry_project;

        $data['enquiry_enq_referance'] = $enquiry->enquiry_enq_referance;

        $data['product_detail'] = '<table class="table table-bordered table-striped delTable"><tbody class="travelerinfo"><tr><td>Serial No.</td><td>Product Description</td><td>Unit</td><td>Quantity</td><td>Rate</td><td>Discount(%)</td><td>Amount</td><td>Action</td></tr>'; 
        
        $i=1;
        foreach($product_detail as $prod_det){

        $data['product_detail'] .= '<tr class="prod_row">
                                        <td><input type="number" name="qpd_serial_no[]" value="'.$i.'" class="form-control non_border_input" style="style="border:none"" required></td>
                                        <td>
                                            <select class="form-select droup_product" name="qpd_product_description[]" required>
                                                <option selected>Select Product Description</option>';
                                                foreach($products as $prod){
                                                    $data['product_detail'] .='<option value="'.$prod->product_id.'" '; 
                                                    if($prod->product_id == $prod_det->pd_id){ $data['product_detail'] .= "selected"; }
                                                    $data['product_detail'] .='>'.$prod->product_details.'</option>';
                                                }
                                            $data['product_detail'] .='</select>
                                        </td>
                                        <td><input type="text" name="qpd_unit[]" value="'.$prod_det->pd_unit.'" class="form-control" required></td>
                                        <td><input type="number" name="qpd_quantity[]" value="'.$prod_det->pd_quantity.'" class="form-control qtn_clz_id" required></td>
                                        <td><input type="number" name="qpd_rate[]"  class="form-control rate_clz_id" required></td>
                                        <td><input type="number" name="qpd_discount[]"  class="form-control discount_clz_id" required></td>
                                        <td><input type="number" name="qpd_amount[]" class="form-control amount_clz_id" readonly></td>
                                        <td class="row_remove" data-id="'.$prod_det->pd_id.'"><i class="ri-close-line"></i>Remove</td>
                                    </tr>';
        $i++;
        }
        
        $data['product_detail'] .= '</tbody><tbody class="travelerinfo product-more2"></tbody></table><div class="edit_add_more_div"><span class="edit_add_more add_product2"><i class="ri-add-circle-line"></i>Add More</span></div><input type="hidden" name="qpd_quotation_details" class="quotation_details_id"><div class="modal-footer justify-content-center"><button class="btn btn btn-success">Save</button></div>';

        echo json_encode($data);
       
    }



    //delete contact details
    public function DeleteContact()
    {
        $cond = array('pd_id' => $this->request->getPost('ID'));
 
        $this->common_model->DeleteData('crm_product_detail',$cond);

        
    }





}
