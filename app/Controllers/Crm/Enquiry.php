<?php

namespace App\Controllers\Crm;

use App\Controllers\BaseController;


class Enquiry extends BaseController
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
       
        $totalRecords = $this->common_model->GetTotalRecords('crm_enquiry','enquiry_id','DESC');
 
        ## Total number of records with filtering
       
        $searchColumns = array('enquiry_reff');

        $totalRecordwithFilter = $this->common_model->GetTotalRecordwithFilter('crm_enquiry','enquiry_id',$searchValue,$searchColumns);
    
        ##Joins if any //Pass Joins as Multi dim array
        $joins = array(
            array(
                'table' => 'crm_customer_creation',
                'pk'    => 'cc_id',
                'fk'    => 'enquiry_customer',
            )
        );
        ## Fetch records
        $records = $this->common_model->GetRecord('crm_enquiry','enquiry_id',$searchValue,$searchColumns,$columnName,$columnSortOrder,$joins,$rowperpage,$start);
    
        $data = array();

        $i=1;
        foreach($records as $record ){
            $action = '<a  href="javascript:void(0)" data-id="'.$record->enquiry_id.'"  class="view view-color view_btn" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-fill"></i></a>
            <a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="Edit"  data-id="'.$record->enquiry_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i></a>
            <a href="javascript:void(0)" class="delete delete-color delete_btn"  data-toggle="tooltip" data-id="'.$record->enquiry_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> </a>';
           
           $data[] = array( 
              "enquiry_id"         =>$i,
              'enquiry_reff'       => $record->enquiry_reff,
              'enquiry_date'       => date('d-M-Y',strtotime($record->enquiry_date)),
              'enquiry_customer'   => $record->cc_customer_name,
              "action"             => $action,
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


    // search droup drown (customer)
    public function FetchCustomer()
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


    
    public function EditFetchCustomer()
    {

        $page= !empty($_GET['page']) ? $_GET['page'] : 0;
        $term = !empty($_GET['term']) ? $_GET['term'] : "";
        $resultCount = 10;
        $end = ($page - 1) * $resultCount;       
        $start = $end + $resultCount;
      
        $data['result'] = $this->common_model->FetchAllLimit('crm_customer_creation','cc_customer_name','asc',$term,$start,$end);
        
        $enquiry = $this->common_model->FetchAllOrder('crm_enquiry','enquiry_id','desc');

        $data['enquiry_customer'] = $enquiry->enquiry_customer;
        
        $data['total_count'] =count($data['result']);

        return json_encode($data);

    }



    // search droup drown (product description)
    public function FetchProdDes()
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

        $data['enquiry_id'] = $this->common_model->FetchNextId('crm_enquiry','ENQ');
        
      
        $data['content'] = view('crm/enquiry',$data);

        return view('crm/crm-module',$data);

    }


    // add account head
    Public function Add()
    {   
            $uid = $this->FetchReference("r");
            
            $insert_data = [
                    
                'enquiry_reff'           => $uid,

                'enquiry_date'           => date('Y-m-d',strtotime($this->request->getPost('enquiry_date'))),

                'enquiry_customer'       => $this->request->getPost('enquiry_customer'),

                'enquiry_contact_person' => $this->request->getPost('enquiry_contact_person'),

                'enquiry_assign_to'      => $this->request->getPost('enquiry_assign_to'),

                'enquiry_source'         => $this->request->getPost('enquiry_source'),

                'enquiry_time_frame'     => date('Y-m-d',strtotime($this->request->getPost('enquiry_time_frame'))),

                'enquiry_project'        => $this->request->getPost('enquiry_project'),

                'enquiry_added_by'       => 0,

                'enquiry_added_date'     => date("Y-m-d"),

            ];

            $enquiry_id = $this->common_model->InsertData('crm_enquiry',$insert_data);
        
        
            if(!empty($_POST['pd_product_detail']))
            {
                $count =  count($_POST['pd_product_detail']);
                        
                if($count!=0)
                {  
                    for($j=0;$j<=$count-1;$j++)
                    {
                                
                        $insert_data  	= array(  
                            
                            'pd_product_detail'       =>  $_POST['pd_product_detail'][$j],
                            'pd_unit'                 =>  $_POST['pd_unit'][$j],
                            'pd_quantity'             =>  $_POST['pd_quantity'][$j],
                            'pd_enquiry_id'           =>  $enquiry_id,
        
                        );
                    
                        $id = $this->common_model->InsertData('crm_product_detail',$insert_data);
                    
                    } 
                }
            } 




    }

 
    //account head modal 
    public function View()
    {
        
        $cond = array('enquiry_id' => $this->request->getPost('ID'));

        $joins = array(
          
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
                'fk'    => 'enquiry_assign_to',
            ),

        );

        $enquiry = $this->common_model->SingleRowJoin('crm_enquiry',$cond,$joins);

        $cond1 = array('pd_enquiry_id' => $this->request->getPost('ID'));

        $joins1 = array(
            array(
                'table' => 'crm_products',
                'pk'    => 'product_id',
                'fk'    => 'pd_product_detail',
            ),
            

        );

        $product_details_data = $this->common_model->FetchWhereJoin('crm_product_detail',$cond1,$joins1);
         

        $data['enquiry_reff']       = $enquiry->enquiry_reff;

        $data['enquiry_date']       = date('d-M-Y',strtotime($enquiry->enquiry_date));

        $data['cc_customer_name']   = $enquiry->cc_customer_name;

        $data['contact_person']     = $enquiry->contact_person;

        $data['enquiry_assign_to']  = $enquiry->employees_name;

        $data['enquiry_source']     = $enquiry->enquiry_source;

        $data['enquiry_time_frame'] = date('d-M-Y',strtotime($enquiry->enquiry_time_frame));

        $data['enquiry_project']    = $enquiry->enquiry_project;

        $data['prod_details'] = "";
        
        $i=1;

        foreach($product_details_data as $prod_det)
        {
            $data['prod_details'] .='<tr>
            <td><input type="text"   value="'.$i.'" class="form-control" readonly></td>
            <td style="width:40%"><input type="text"   value="'.$prod_det->product_details.'" class="form-control" readonly></td>
            <td><input type="text"   value="'.$prod_det->pd_unit.'" class="form-control" readonly></td>
            <td> <input type="email" value="'.$prod_det->pd_quantity.'" class="form-control" readonly></td>
            </tr>'; 

            $i++;  
        }
        
       
        
        echo json_encode($data);
    }


    public function ContactPerson()
    {
        $cond = array('contact_customer_creation' => $this->request->getPost('ID'));

        $contact_details = $this->common_model->FetchWhere('crm_contact_details',$cond);
        
        $data['customer_name'] ="";

        $data['customer_name'] ='<option value="" selected disabled>Select Contact Person</option>';

        foreach($contact_details as $con_det)
        {
            $data['customer_name'] .='<option class="droup_color" value='.$con_det->contact_id.'';
           
            $data['customer_name'] .='>' .$con_det->contact_person. '</option>'; 
        }

        echo json_encode($data);


    }


    // update account head 
    public function UpdateTab()
    {    
        $cond = array('enquiry_id' => $this->request->getPost('enquiry_id'));
        
        $update_data = $this->request->getPost(); 

        // Check if the 'account_id' key exists before unsetting it
        if (array_key_exists('enquiry_id', $update_data)) 
        {
             unset($update_data['enquiry_id']);
        }    
        
        $update_data['enquiry_date'] = date('Y-m-d',strtotime($this->request->getPost('enquiry_date')));

        $update_data['enquiry_time_frame'] = date('Y-m-d',strtotime($this->request->getPost('enquiry_time_frame')));

        $update_data['enquiry_modified'] = date('Y-m-d'); 

        $this->common_model->EditData($update_data,$cond,'crm_enquiry');
        
        $data['enquiry_id']  = $this->request->getPost('enquiry_id');

        echo json_encode($data);

       
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

        $quotation_reff = $this->common_model->SingleRow('crm_quotation_details',array('qd_enq_ref' => $this->request->getPost('ID')));
        
        if(empty($quotation_reff))
        {
            $cond = array('enquiry_id' => $this->request->getPost('ID'));

            $this->common_model->DeleteData('crm_enquiry',$cond);
    
            $cond = array('pd_enquiry_id' => $this->request->getPost('ID'));
    
            $this->common_model->DeleteData('crm_product_detail',$cond);

            $data['status'] = 1;

            $data['msg'] = "Data Deleted Successfully";
        }
        else
        {
            $data['status'] = 0;
            
            $data['msg'] ="Data In Use. Cannot Delete";
        }

        echo json_encode($data);

    }


    //fetch data form edit
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


        $cond = array('enquiry_id' => $this->request->getPost('ID'));

        $enquiry = $this->common_model->SingleRow('crm_enquiry',$cond);

        $cond1 = array('pd_enquiry_id' => $this->request->getPost('ID'));

        $joins1 = array(
            array(
                'table' => 'crm_products',
                'pk'    => 'product_id',
                'fk'    => 'pd_product_detail',
            ),
            

        );

        $product_details_data = $this->common_model->FetchWhereJoin('crm_product_detail',$cond1,$joins1);

        $customer_creation = $this->common_model->FetchAllOrder('crm_customer_creation','cc_id','desc');

        $cond2 = array('contact_customer_creation'=>$enquiry->enquiry_customer);

        $contact_details = $this->common_model->FetchWhere('crm_contact_details',$cond2);


        $employes = $this->common_model->FetchAllOrder('employees','employees_id','desc');
         
        $data['enquiry_reff']       = $enquiry->enquiry_reff;

        $data['enquiry_date']       = date('d-M-Y',strtotime($enquiry->enquiry_date));

        $data['enquiry_source']     = $enquiry->enquiry_source;

        $data['enquiry_time_frame'] = date('d-M-Y',strtotime($enquiry->enquiry_time_frame));

        $data['enquiry_project']    = $enquiry->enquiry_project;

        $data['enquiry_id']    = $enquiry->enquiry_id;


        $data['customer_creation'] ="";

        foreach($customer_creation as $cus_creation)
        {   
            if ($cus_creation->cc_id  == $enquiry->enquiry_customer)
            {
                $data['customer_creation'] .= '<option value="' .$cus_creation->cc_id. '"'; 
            
                // Check if the current product head is selected
                
                    $data['customer_creation'] .= ' selected'; 
                
            
                $data['customer_creation'] .= '>' . $cus_creation->cc_customer_name . '</option>';

            }
        }


        $data['contact_person'] ="";

        foreach($contact_details as $cont_det)
        {
            $data['contact_person'] .= '<option value="' .$cont_det->contact_id. '"'; 
        
            // Check if the current product head is selected
            if ($cont_det->contact_id   == $enquiry->enquiry_contact_person)
            {
                $data['contact_person'] .= ' selected'; 
            }
        
            $data['contact_person'] .= '>' . $cont_det->contact_person. '</option>';
        }


        $data['assigned_to'] ="";

        foreach($employes as $employ)
        {
            $data['assigned_to'] .= '<option value="' .$employ->employees_id . '"'; 
        
            // Check if the current product head is selected
            if ($employ->employees_id    == $enquiry->enquiry_assign_to)
            {
                $data['assigned_to'] .= ' selected'; 
            }
        
            $data['assigned_to'] .= '>' . $employ->employees_name. '</option>';
        }

         
        $data['prod_details'] = "";
        
        $i=1;

        foreach($product_details_data as $prod_det)
        {
            $data['prod_details'] .='<tr class="prod_row1">
            <td class="si_no1">'.$i.'</td>
            <td>'.$prod_det->product_details.'</td>R
            <td>'.$prod_det->pd_unit.'</td>
            <td>'.$prod_det->pd_quantity.'</td>
            <td>
                <a href="javascript:void(0)" class="edit edit-color edit_prod_btn" data-id="'.$prod_det->pd_id.'" data-toggle="tooltip" data-placement="top" title="edit" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a>
	            <a href="javascript:void(0)" class="delete delete-color delete_prod_btn" data-id="'.$prod_det->pd_id.'" data-toggle="tooltip"  data-placement="top" title="Delete"><i class="ri-delete-bin-fill"></i> Delete</a>
            </td>
            </tr>'; 

            $i++;  
        }
        
       
        echo json_encode($data);

    }



    public function AddContactDetails()
    {
        $insert_data = $this->request->getPost();

        $cond = array('contact_customer_creation' => $this->request->getPost('contact_customer_creation'));

        $id = $this->common_model->InsertData('crm_contact_details',$insert_data);

        $contact_details = $this->common_model->FetchWhere('crm_contact_details',$cond);

        $data['contact_person'] ="<option value='' selected disabled>Select Contact Person</option>";

        foreach($contact_details as $cont_det)
        {
            $data['contact_person'] .='<option value='.$cont_det->contact_id.'';
           
            $data['contact_person'] .='>' .$cont_det->contact_person. '</option>'; 
        }
        

        echo json_encode($data);
    }

    public function EnquiryDate()
    {
        $date = $this->request->getPost('Date');

        $your_date = strtotime("1 day", strtotime($date));
     
        $data['increment_date_date'] = date("d-M-Y", $your_date);

        echo json_encode($data);
    }

    public function FetchSingleProd()
    {
        $cond = array('pd_id' => $this->request->getPost('ID'));

        $joins = array(
            array(
                'table' => 'crm_products',
                'pk'    => 'product_id',
                'fk'    => 'pd_product_detail',
            ),
            

        );

        $prod_det = $this->common_model->SingleRowJoin('crm_product_detail',$cond,$joins);

        $products = $this->common_model->FetchAllOrder('crm_products','product_id','desc');

       

        $data['prod_details'] ="";  

       
            $data['prod_details'] .='<tr>
            <td><input type="text"   value="1" class="form-control " readonly></td>
            <td> 
                    <select class="form-select" name="pd_product_detail" required>';
                            
                    foreach($products as $prod){
                        $data['prod_details'] .='<option class="droup_color" value="'.$prod->product_id.'" '; 
                        if($prod->product_id == $prod_det->pd_product_detail){ $data['prod_details'] .= "selected"; }
                        $data['prod_details'] .='>'.$prod->product_details.'</option>';
                    }
                $data['prod_details'] .='</select>
            </td>

            <td><input type="text" name="pd_unit"  value="'.$prod_det->pd_unit.'" class="form-control " required></td>
            <td> <input type="number" name="pd_quantity" value="'.$prod_det->pd_quantity.'" class="form-control " required></td>
            <input type="hidden" name="pd_id" value="'.$prod_det->pd_id .'">
            </tr>'; 

          
       
		
        echo json_encode($data);

        
    }


    //update single product

    public function UpdateSingleEnquiry()
    {
        $cond = array('pd_id' => $this->request->getPost('pd_id'));
        
        $update_data = $this->request->getPost();

        // Check if the 'account_id' key exists before unsetting it
        if (array_key_exists('pd_id', $update_data)) 
        {
            unset($update_data['pd_id']);
        }    
        
        $this->common_model->EditData($update_data,$cond,'crm_product_detail');

        $single_product = $this->common_model->SingleRow('crm_product_detail',$cond);

        $data['enquiry_id'] = $single_product->pd_enquiry_id; 

        echo json_encode($data);  
 
    }

    //delete single Product

    public function DeleteProduct()
    {
        $cond = array('pd_id' => $this->request->getPost('ID'));
 
        $this->common_model->DeleteData('crm_product_detail',$cond);
    }


    //edit add single product

    public function AddSingleProduct()
    {
        $insert_data = $this->request->getPost();

        $prod_det = $this->common_model->InsertData('crm_product_detail',$insert_data);

        $cond  = array('pd_id' => $prod_det);
        
        $enquiry_prod = $this->common_model->SingleRow('crm_product_detail',$cond);

        $data['enquiry_id'] = $enquiry_prod->pd_enquiry_id;

        echo json_encode($data);
    }


    public function FetchContact()
    {
        $cond = array('contact_customer_creation' => $this->request->getPost('custID'));
        
        $contact_details = $this->common_model->FetchWhere('crm_contact_details',$cond);

       
        
        $data['contact_person'] ="<option value='' selected disabled>Select Contact Person</option>";

        foreach($contact_details as $cont_det)
        {   
          
                $data['contact_person'] .= '<option value="' .$cont_det->contact_id . '"'; 
            
            
                $data['contact_person'] .= '>' . $cont_det->contact_person. '</option>';
            
        }

        echo json_encode($data);


    }



    public function FetchReference($type="e")
    {

        $uid = $this->common_model->FetchNextId('crm_enquiry',"ENQ-{$this->data['accounting_year']}-");

        if($type=="e")
            echo $uid;
        else
        {
            return $uid;
        }

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
