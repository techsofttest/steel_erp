<?php

namespace App\Controllers\Procurement;

use App\Controllers\BaseController;


class FixedAssetCreation extends BaseController
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
       
        $totalRecords = $this->common_model->GetTotalRecords('pro_create_fixed_asset','cfs_id','DESC');
        
        
        ## Total number of records with filtering
       
        $searchColumns = array('cfs_description');

        $totalRecordwithFilter = $this->common_model->GetTotalRecordwithFilter('pro_create_fixed_asset','cfs_id',$searchValue,$searchColumns);
    
        ##Joins if any //Pass Joins as Multi dim array
        $joins = array(
            array(
                'table' => 'accounts_account_heads',
                'pk'    => 'ah_id',
                'fk'    => 'cfs_account_head',
            ),
            
        );
        ## Fetch records
        $records = $this->common_model->GetRecord('pro_create_fixed_asset','cfs_id',$searchValue,$searchColumns,$columnName,$columnSortOrder,$joins,$rowperpage,$start);
        
        $data = array();

        $i=1;
        foreach($records as $record ){
            $action = '<a  href="javascript:void(0)" data-id="'.$record->cfs_id.'"  class="view view-color view_btn" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-fill"></i></a>
            <a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="Edit"  data-id="'.$record->cfs_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i></a>
            <a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->cfs_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i></a>
           ';
           
           $data[] = array( 
              "cfs_id"               => $i,
              'cfs_description'      => $record->cfs_description,
              'cfs_account_head'     => $record->ah_account_name,
              'cfs_account_id'       => $record->cfs_account_id,
              'cfs_acquired_date'    => date('d-M-Y',strtotime($record->cfs_acquired_date)),
              "action"               => $action,
           );
           $i++; 
        }
 
        ## Response
        $response = array(
         "draw"                 => intval($draw),
         "iTotalRecords"        => $totalRecords,
         "iTotalDisplayRecords" => $totalRecordwithFilter,
         "aaData"               => $data,
         "token"                => csrf_hash() // New token hash
        );
 
        //return $this->response->setJSON($response);

        echo json_encode($response);

        exit;

        /*pagination end*/
    } 



    //search droup drown (accountid)
    public function FetchTypes()
    {
 
        $page= !empty($_GET['page']) ? $_GET['page'] : 0;
        $term = !empty($_GET['term']) ? $_GET['term'] : "";

        $resultCount = 10;
        $end = ($page - 1) * $resultCount;       
        $start = $end + $resultCount;
       

        $data['result'] = $this->common_model->FetchAllLimit('accounts_account_heads','ah_account_name','asc',$term,$start,$end);
 
        $data['total_count'] =count($data['result']);
 

        return json_encode($data);
 
    }
 

        //search droup drown (accountid)
        public function FetchDebitAcc()
        {
     
            $page= !empty($_GET['page']) ? $_GET['page'] : 0;
            $term = !empty($_GET['term']) ? $_GET['term'] : "";
            $resultCount = 10;
            $end = ($page - 1) * $resultCount;       
            $start = $end + $resultCount;
           
            $data['result'] = $this->common_model->FetchAllLimit('accounts_charts_of_accounts','ca_name','asc',$term,$start,$end);
     
            $data['total_count'] = count($data['result']);
     
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
        $data['material_received']   = $this->common_model->FetchAllOrder('pro_material_received_note','mrn_id','desc');
        
        $data['charts_of_account']   = $this->common_model->FetchAllOrder('accounts_charts_of_accounts','ca_id','desc');

        $data['content'] = view('procurement/fixed_asset_creation',$data);

        return view('procurement/pro-module',$data);

    }


    // add account head
    Public function Add()
    {   
        $insert_data = $this->request->getPost();

            // Check if the 'account_id' key exists before unsetting it
            if (array_key_exists('cfs_acquired_date', $insert_data)) 
            {
                unset($insert_data['cfs_acquired_date']);
            }
            
            $insert_data['cfs_acquired_date'] = date('Y-m-d',strtotime($this->request->getPost('cfs_acquired_date')));
         
            // Handle file upload
            if ($_FILES['cfs_attact']['name'] !== '') 
		    {   
                $soAttachFileName = $this->uploadFile('cfs_attact','uploads/FixedAsset');
                $insert_data['cfs_attact'] = $soAttachFileName;
            }


            $id = $this->common_model->InsertData('pro_create_fixed_asset',$insert_data);


            $coa_data['ca_name'] = $this->request->getPost('cfs_description');

            $coa_data['ca_account_type'] = $this->request->getPost('cfs_account_head');

            $coa_data['ca_customer'] = $id;

            $coa_data['ca_account_id'] = $this->request->getPost('cfs_account_id');

            $coa_data['ca_type'] = "FIXED_ASSET";

            $this->common_model->InsertData('accounts_charts_of_accounts',$coa_data);

    }
    

    public function Date()
    {
        $date = $this->request->getPost('Date');

        $your_date = strtotime("1 day", strtotime($date));
     
        $data['increment_date_date'] = date("d-M-Y", $your_date);

        echo json_encode($data);
    }


   

    /*public function FetchPurchase()
    {

        $page= !empty($_GET['page']) ? $_GET['page'] : 0;
        $term = !empty($_GET['term']) ? $_GET['term'] : "";
        $resultCount = 10;
        $end = ($page - 1) * $resultCount;       
        $start = $end + $resultCount;
      
        $data['result'] = $this->common_model->FetchAllLimit('steel_pro_purchase_order','po_reffer_no','asc',$term,$start,$end);
        
        

        $data['total_count'] =count($data['result']);

        return json_encode($data);

    }*/

    public function ContactPerson()
    {
        $vendor_id  = $this->request->getPost('ID');

        $joins = array(
            array(
                'table' => 'pro_purchase_order',
                'pk'    => 'po_id',
                'fk'    => 'mrn_purchase_order',
            ),

        );

        
        //contact person
        
        $contacts = $this->common_model->FetchWhere('pro_contact',array('pro_con_vendor' => $this->request->getPost('ID')));
        
       

        $data['condact_data'] = '<option value="" selected disabled>Select Contact Person</option>';
        
        foreach($contacts as $ven_contact)
        {
            $data['condact_data'] .='<option value='.$ven_contact->pro_con_id.'>'.$ven_contact->pro_con_person.'</option>';
        }
        
        echo json_encode($data);
    }



    public function FetchPurchase()
    {
       
        //purchase voucher
        
        $material_received_note = $this->common_model->SingleRow('pro_material_received_note',array('mrn_id' => $this->request->getPost('ID')));
        
        $purchase = $material_received_note->mrn_purchase_order;

        $data['delivery_note'] = $material_received_note->mrn_delivery_note;

        $data['payment_term'] = $material_received_note->mrn_payment_term;

        $purchase_data = $this->common_model->SingleRow('pro_purchase_order',array('po_id'=>$purchase));

        $data['purchase_order'] = $purchase_data->po_reffer_no;
        
       
        
        echo json_encode($data);
    }


    


    public function FetchReference()
    {
    
        $uid = $this->common_model->FetchNextId('pro_purchase_return',"PR");
    
        echo $uid;
    
    }


    public function FetchProduct()
    {   
       
        $purchase_return = $this->common_model->SingleRow('pro_purchase_voucher',array('pv_id' => $this->request->getPost('ID')));
        
        /*$joins = array(
            
            array(
                'table' => 'crm_products',
                'pk'    => 'product_id',
                'fk'    => 'pop_prod_desc',
            ),
           

        );*/

        //$products = $this->common_model->FetchWhereJoin('pro_purchase_order_product',array('pop_purchase_order' => $purchase_order->po_id),$joins);
       
        $products = $this->common_model->FetchWhere('pro_purchase_voucher_prod',array('pvp_reffer_id' => $purchase_return->pv_id));
        

        $i = 1; 
        
        $data['product_detail'] ="";

        foreach($products as $prod){

            $data['product_detail'] .='<tr class="" id="'.$prod->pvp_id.'">
                                            
                                            <td class="si_no">'.$i.'</td>
                                            <td><input type="text" name="" value="'.$prod->pvp_prod_dec.'" class="form-control"  readonly></td>
                                            <td><input type="number" name="" value="'.$prod->pvp_qty.'"  class="form-control order_qty" readonly></td>
                                            <td><input type="checkbox" name="" id="'.$prod->pvp_id.'"  onclick="handleCheckboxChange(this)" class="prod_checkmark"></td>
                                          
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

        // Fetch details for each selected product ID
        $i = 1;  
        foreach ($idsArray as $number) 
        {
            $cond = array('pvp_id' => $number);

            $joins1 = array(
                array(
                    'table' => 'accounts_charts_of_accounts',
                    'pk'    => 'ca_id',
                    'fk'    => 'pvp_debit',
                ),
               
              
            );

            //$products = $this->common_model->FetchWhereJoin('pro_purchase_order_product',$cond,$joins1);

            $products = $this->common_model->FetchWhereJoin('pro_purchase_voucher_prod',$cond,$joins1);

            $debit_accounts = $this->common_model->FetchAllOrder('accounts_charts_of_accounts','ca_id','desc');    

            
            foreach($products as $product){

                $data['product_detail'] .='<tr class="add_prod_row add_prod_remove" id="'.$product->pvp_id.'">
                                            <td class="si_no">'.$i.'</td>
                                            <td><input type="text" name="prp_sales_order[]" value="'.$product->pvp_sales_order.'" class="form-control" readonly></td>
                                            <td><input type="text" name="prp_prod_desc[]" value="'.$product->pvp_prod_dec.'" class="form-control" readonly></td>
                                            <td><input type="text" name="prp_debit[]" value="'.$product->ca_name.'" class="form-control" readonly></td>
                                            <td><input type="number" name="prp_qty[]" value="'.$product->pvp_qty.'"  class="form-control add_prod_qty" readonly required></td>
                                            <td><input type="text" name="prp_unit[]" value="'.$product->pvp_unit.'" class="form-control" required readonly></td>
                                            <td><input type="text" name="prp_rate[]" value="'.$product->pvp_rate.'"  class="form-control add_prod_rate" required readonly></td>
                                            <td><input type="text" name="prp_discount[]" value="'.$product->pvp_discount.'"  class="form-control add_discount" required readonly></td>
                                            <td><input type="text" name="prp_amount[]" value="'.$product->pvp_amount.'"  class="form-control add_prod_amount" required readonly></td>
                                           
                                        </tr>';
 
                                    
                                     $i++;
                                    
            }

       
        }

        // Output JSON encoded data
        echo json_encode($data);

    }


    public function AddContactDetails()
    {   
        

        if(!empty($_POST['pro_con_person']))
        {    
            $count =  count($_POST['pro_con_person']);
            
            if($count!=0)
            {  
            
                for($j=0;$j<=$count-1;$j++)
                {
                
                    $insert_data  	= array(  
                        
                        'pro_con_person'       =>  $_POST['pro_con_person'][$j],
                        'pro_con_designation'  =>  $_POST['pro_con_designation'][$j],
                        'pro_con_mobile'       =>  $_POST['pro_con_mobile'][$j],
                        'pro_con_email'        =>  $_POST['pro_con_email'][$j],
                        'pro_con_vendor'       =>  $_POST['new_vendor_hidden_id'],
                      
                    );

                    $this->common_model->InsertData('pro_contact',$insert_data);

                } 
            }
    
        }   
    }


    public function FetchPayment(){
        
        $purchase_id  = $this->request->getPost('ID');

        $joins = array(

            array(
                'table' => 'pro_material_requisition',
                'pk'    => 'mr_id',
                'fk'    => 'po_mrn_reff',
            ),
            
        );

        $purchases = $this->common_model->SingleRowJoin('pro_purchase_order',array('po_id' => $purchase_id),$joins);

        $data['payment_term'] = $purchases->po_payment_term;

        $data['mr_reff'] = $purchases->mr_reffer_no;
       
        echo json_encode($data);
        
    }


    public function VendorInv()
    {   
      
        $purchase_voucher = $this->pro_model->FetchWhereNotIn('pro_purchase_voucher',array('pv_vendor_name' => $this->request->getPost('ID')),'pv_status','2');
         
      

        $data['vendor_inv'] ="";

        $data['vendor_inv'] ='<option value="" selected disabled>Vendor Inv Ref</option>';

        foreach($purchase_voucher as $pur_vou)
        {
            $data['vendor_inv'] .='<option value='.$pur_vou->pv_id.'';
           
            $data['vendor_inv'] .='>' .$pur_vou->pv_vendor_inv. '</option>'; 
        }
        

        echo json_encode($data);
        
    }

    public function FetchContact()
    {   
        $joins = array(

            array(

                'table' => 'pro_contact',
                'pk'    => 'pro_con_id',
                'fk'    => 'pv_contact_person',
            ),
            
        );

        $purchase_voucher = $this->common_model->SingleRowJoin('pro_purchase_voucher',array('pv_id' => $this->request->getPost('ID')),$joins);
        
        $data['contact_person'] = $purchase_voucher->pro_con_person;

        $data['payment_term']   = $purchase_voucher->pv_payment_term;


        echo json_encode($data);
    }



    // Function to handle file upload
    public function uploadFile($fieldName, $uploadPath)
    {
        $file = $this->request->getFile($fieldName);
 
        if($file === null){
 
            // Debugging output
            echo('No file uploaded or incorrect field name');
            
        }
  
        if ($file->isValid() && !$file->hasMoved()) 
        {
            $newName = $file->getRandomName();
            $file->move($uploadPath, $newName);
            return $newName;
        }
  
         return null;
 
    }

    public function FetchInvoice()
    {
        $purchase_id  = $this->request->getPost('ID');

        $purchase_return = $this->common_model->SingleRow('pro_purchase_return',array('pr_id' => $purchase_id));

        $purchase_return->pr_vendor_name;
    }


    public function View()
    {
        $join =  array(            
            array(
                'table' => 'accounts_account_heads',
                'pk'    => 'ah_id',
                'fk'    => 'cfs_account_head',
            ),         
        );
        $fixedCredit1 = $this->common_model->SingleRowJoin('pro_create_fixed_asset', array('cfs_id' => $this->request->getPost('ID')),$join);
        

        $join =  array(           
            array(
                'table' => 'accounts_charts_of_accounts',
                'pk'    => 'ca_id',
                'fk'    => 'cfs_debit_account',
            ),       
        );
        $fixedCredit2 = $this->common_model->SingleRowJoin('pro_create_fixed_asset', array('cfs_id' => $this->request->getPost('ID')),$join);
        

        $join =  array(        
            array(
                'table' => 'accounts_charts_of_accounts',
                'pk'    => 'ca_id',
                'fk'    => 'cfs_credit_account',
            ),
        );
        $fixedCredit3 = $this->common_model->SingleRowJoin('pro_create_fixed_asset', array('cfs_id' => $this->request->getPost('ID')),$join);
        
        
        $data['description']      = $fixedCredit1->cfs_description;

        $data['date']           = date('d-M-Y',strtotime($fixedCredit1->cfs_acquired_date));

        $data['account_id']    = $fixedCredit1->cfs_account_id;

        $data['account_head']     = $fixedCredit1->ah_account_name;

        $data['debit_account']   = $fixedCredit2->ca_name;

        $data['credit_account'] = $fixedCredit3->ca_name;

        $data['depreciation']   = $fixedCredit1->cfs_depreciation;

        $data['last_yr_depreciation']    = $fixedCredit1->cfs_last_yr_depreciation;
        

        $data['attach']   = $fixedCredit1->cfs_attact != '' ? base_url().'public/uploads/FixedAsset/'.$fixedCredit1->cfs_attact : '';
       

        echo json_encode($data);


    }
 


    
    public function Edit(){
        
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
        
        $join =  array(            
            array(
                'table' => 'accounts_account_heads',
                'pk'    => 'ah_id',
                'fk'    => 'cfs_account_head',
            ),         
        );
        $fixedCredit1 = $this->common_model->SingleRowJoin('pro_create_fixed_asset', array('cfs_id' => $this->request->getPost('ID')),$join);
        

        $join =  array(           
            array(
                'table' => 'accounts_charts_of_accounts',
                'pk'    => 'ca_id',
                'fk'    => 'cfs_debit_account',
            ),       
        );
        $fixedCredit2 = $this->common_model->SingleRowJoin('pro_create_fixed_asset', array('cfs_id' => $this->request->getPost('ID')),$join);
        

        $join =  array(        
            array(
                'table' => 'accounts_charts_of_accounts',
                'pk'    => 'ca_id',
                'fk'    => 'cfs_credit_account',
            ),
        );
        $fixedCredit3 = $this->common_model->SingleRowJoin('pro_create_fixed_asset', array('cfs_id' => $this->request->getPost('ID')),$join);
        
        
        $data['cfsid']      = $fixedCredit1->cfs_id;

        $data['description']      = $fixedCredit1->cfs_description;

        $data['date']           = date('d-M-Y',strtotime($fixedCredit1->cfs_acquired_date));

        $data['account_id']    = $fixedCredit1->cfs_account_id;

        $data['last_yr_depreciation']    = $fixedCredit1->cfs_last_yr_depreciation;


        $data['account_head']     = '';

        $heads = $this->common_model->FetchAllOrder('accounts_account_heads','ah_id','desc');

        foreach($heads as $head)
        {  
            
            $data['account_head'] .= '<option value="' .$head->ah_id.'"'; 

            if($fixedCredit1->cfs_account_head == $head->ah_id)
            {
                $data['account_head'] .= ' selected'; 
            }

		    $data['account_head'] .= '>' . $head->ah_account_name.'</option>';
        }


        $data['debit_account']   = '';
        $data['credit_account'] = '';

        $charts_acc = $this->common_model->FetchAllOrder('accounts_charts_of_accounts','ca_id','desc');

        foreach($charts_acc as $charts)
        {  
            
            $data['debit_account'] .= '<option value="' .$charts->ca_id.'"'; 

            if($fixedCredit2->ca_id == $charts->ca_id)
            {
                $data['debit_account'] .= ' selected'; 
            }

		    $data['debit_account'] .= '>' . $charts->ca_name.'</option>';
        }

        foreach($charts_acc as $charts)
        {  
            
            $data['credit_account'] .= '<option value="' .$charts->ca_id.'"'; 

            if($fixedCredit3->ca_id == $charts->ca_id)
            {
                $data['credit_account'] .= ' selected'; 
            }

		    $data['credit_account'] .= '>' . $charts->ca_name.'</option>';
        }


        $data['depreciation']   = $fixedCredit1->cfs_depreciation;

        $data['attach']   = $fixedCredit1->cfs_attact != '' ? base_url().'public/uploads/FixedAsset/'.$fixedCredit1->cfs_attact : '';
       

        echo json_encode($data);
    }




    public function Update()
    {
        $cfs_id =$this->request->getPost('cfs_id');
        
        $cond = array('cfs_id' => $this->request->getPost('cfs_id'));

        $fixedasset = $this->common_model->SingleRow('pro_create_fixed_asset',$cond);
                
        $update_data = $this->request->getPost();

        
        // Check if the 'account_id' key exists before unsetting it
        if (array_key_exists('cfs_id', $update_data)) 
        {
            unset($update_data['cfs_id']);
        }  

        $update_data['cfs_acquired_date'] =  date('Y-m-d',strtotime($this->request->getPost('cfs_acquired_date')));


       // Handle file upload
	    if (isset($_FILES['cfs_attact']) && $_FILES['cfs_attact']['name'] !== '') {
				
            if($this->request->getFile('cfs_attact') != '' ){
            
                $previousImagePath = 'uploads/FixesAsset/' .$fixedasset->cfs_attact;
            
                if (file_exists($previousImagePath)) {
                    unlink($previousImagePath);
                }

            }
		
		    // Upload the new image
		    $AttachFileName = $this->uploadFile('cfs_attact', 'uploads/FixesAsset');
	
		    // Update the data with the new image filename
		    $update_data['cfs_attact'] = $AttachFileName;
	    }


        $this->common_model->EditData($update_data, array('cfs_id' => $this->request->getPost('cfs_id')), 'pro_create_fixed_asset');
        

        // ============================================================

        $coa_data['ca_name'] = $this->request->getPost('cfs_description');

        $coa_data['ca_account_type'] = $this->request->getPost('cfs_account_head');

        $coa_data['ca_account_id'] = $this->request->getPost('cfs_account_id');

        $coa_data['ca_type'] = "FIXED_ASSET";

        $this->common_model->EditData($coa_data,['ca_customer' => $cfs_id],'accounts_charts_of_accounts');

    }



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
   
          
        $this->common_model->DeleteData('pro_create_fixed_asset', array('cfs_id' => $this->request->getPost('ID')));

        $this->common_model->DeleteData('accounts_charts_of_accounts', array('ca_customer' => $this->request->getPost('ID')));
        
        $data['status'] =1;
        
        $data['msg'] ="Data Deleted Successfully";

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
