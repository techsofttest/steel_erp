<?php

namespace App\Controllers\Procurement;

use App\Controllers\BaseController;


class PurchaseOrder extends BaseController
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
       
        $totalRecords = $this->common_model->GetTotalRecords('pro_purchase_order','po_id','DESC');
 
        ## Total number of records with filtering
       
        $searchColumns = array('po_reffer_no');

        $totalRecordwithFilter = $this->common_model->GetTotalRecordwithFilter('pro_purchase_order','po_id',$searchValue,$searchColumns);
    
        ##Joins if any //Pass Joins as Multi dim array
        $joins = array(

            array(
                'table' => 'pro_material_requisition',
                'pk'    => 'mr_id',
                'fk'    => 'po_mrn_reff',
            ), 
           
        );
        ## Fetch records
        $records = $this->common_model->GetRecord('pro_purchase_order','po_id',$searchValue,$searchColumns,$columnName,$columnSortOrder,$joins,$rowperpage,$start);
    
        $data = array();

        $i=1;
        foreach($records as $record ){
            $action = '<a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->po_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a><a href="javascript:void(0)" class="delete delete-color delete_btn" style="display:none;" data-toggle="tooltip" data-id="'.$record->po_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> Delete</a><a  href="javascript:void(0)" data-id="'.$record->po_id.'"  class="view view-color view_btn" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a>';
           
           $data[] = array( 
              "po_id"         => $i,
              'po_reffer_no'  => $record->po_reffer_no,
              'po_mrn_reff'   => $record->mr_reffer_no,
              'po_date'       => date('d-m-Y',strtotime($record->po_date)),
              "action"        => $action,
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
       
        $data['products'] = $this->common_model->FetchAllOrder('crm_products','product_id','desc');

        $data['material_requisition'] = $this->common_model->FetchNextId('pro_material_requisition','MR');
 
        $cond = array('so_deliver_flag' => 0);

        $data['sales_orders'] = $this->common_model->FetchWhere('crm_sales_orders',$cond);

        $cond2 = array('mr_pur_status' => 0);

        $data['material_reqisition'] = $this->common_model->FetchWhere('pro_material_requisition',$cond2);

        $data['content'] = view('procurement/purchase-order',$data);

        return view('procurement/pro-module',$data);

    }


    // add account head
    Public function Add()
    {   
        
        if(empty($this->request->getPost('po_id')))
        {   
            $uid = $this->common_model->FetchNextId('pro_purchase_order',"PO");

            $insert_data = [

                'po_reffer_no'       => $uid,

                'po_date'            => date('Y-m-d',strtotime($this->request->getPost('po_date'))),

                'po_vendor_name'     => $this->request->getPost('po_vendor_name'),

                'po_contact_person'  => $this->request->getPost('po_contact_person'),

                'po_mrn_reff'        => $this->request->getPost('po_mrn_reff'),

                'po_payment_term'    => $this->request->getPost('po_payment_term'),

                'po_delivery_date'   => date('Y-m-d',strtotime($this->request->getPost('po_delivery_date'))),

                'po_vendor_ref'      => $this->request->getPost('po_vendor_ref'),

                'po_added_by'        => 0,

                'po_added_date'      => date('Y-m-d'),

            ];

           
            
            /*if (isset($_FILES['po_file']) && $_FILES['po_file']['name'] !== '') {
                
                // Upload the new image
                $attachFileName = $this->uploadFile('po_file', 'uploads/PurchaseOrder');
            
                // Update the data with the new image filename
                $insert_data['po_file'] = $attachFileName;

                
            }*/

            if ($_FILES['po_file']['name'] !== '') {
                $ccAttachCrFileName = $this->uploadFile('po_file','uploads/PurchaseOrder');
                $update_data['po_file'] = $ccAttachCrFileName;
            }

            $purchase_id = $this->common_model->InsertData('pro_purchase_order',$insert_data);

            $data['purchase_id'] = $purchase_id;

            $data['mrn_reff_id'] = $this->request->getPost('po_mrn_reff');
        }
        else
        {   
            
            $updated_data = [

                'po_reffer_no'       => $this->request->getPost('po_reffer_no'),

                'po_date'            => date('Y-m-d',strtotime($this->request->getPost('po_date'))),

                'po_vendor_name'     => $this->request->getPost('po_vendor_name'),

                'po_contact_person'  => $this->request->getPost('po_contact_person'),

                'po_mrn_reff'        => $this->request->getPost('po_mrn_reff'),

                'po_payment_term'    => $this->request->getPost('po_payment_term'),

                'po_delivery_date'   => date('Y-m-d',strtotime($this->request->getPost('po_delivery_date'))),

                'po_vendor_ref'      => $this->request->getPost('po_vendor_ref'),

                'po_amount'          => $this->request->getPost('po_amount'),

                'po_added_by'        => 0,

                'po_added_date'      => date('Y-m-d'),

            ];
            
            if (isset($_FILES['po_file']) && $_FILES['po_file']['name'] !== '') {
                
                // Upload the new image
                $attachFileName = $this->uploadFile('po_file', 'uploads/PurchaseOrder');
            
                // Update the data with the new image filename
                $updated_data['po_file'] = $attachFileName;

                
            }

            $this->common_model->EditData($updated_data, array('po_id' => $this->request->getPost('po_id')),'pro_purchase_order');
            
            $purchase_id = $this->request->getPost('po_id');


            if(!empty($_POST['pop_qty']))
		    {    
                $count =  count($_POST['pop_qty']);
                
                if($count!=0)
                {  
                
                    for($j=0;$j<=$count-1;$j++)
                    {
                    
                    
                        $insert_data  	= array(  
                            
                            'pop_sales_order'           =>  $_POST['pop_sales_order'][$j],
                            'pop_prod_desc'             =>  $_POST['pop_prod_desc'][$j],
                            'pop_unit'                  =>  $_POST['pop_unit'][$j],
                            'pop_qty'                   =>  $_POST['pop_qty'][$j],
                            'pop_rate'                  =>  $_POST['pop_rate'][$j],
                            'pop_discount'              =>  $_POST['pop_discount'][$j],
                            'pop_amount'                =>  $_POST['pop_amount'][$j],
                            'pop_material_req_prod_id'  =>  $_POST['material_req_prod_id'][$j],
                            'pop_purchase_order'        =>  $purchase_id,
                            'pop_delivered_order'       =>  0,
                            
                        );

                        $this->common_model->InsertData('pro_purchase_order_product',$insert_data);

                        $this->common_model->EditData(array('mrp_pur_status' => 1), array('mrp_id' =>$_POST['material_req_prod_id'][$j]), 'pro_material_requisition_prod');
                        
                        $material_req_prod1 = $this->common_model->FetchWhere('pro_material_requisition_prod' ,array('mrp_mr_id' => $_POST['material_req'][$j]));
                        
                        $material_req_prod2 = $this->common_model->FetchSalesOrder('pro_material_requisition_prod' ,array('mrp_mr_id' => $_POST['material_req'][$j]),array('mrp_pur_status' => 1));
                        
                        if(count($material_req_prod1) == count($material_req_prod2)){
                           
                            $this->common_model->EditData(array('mr_pur_status' => 1), array('mr_id' =>$_POST['material_req'][$j]), 'pro_material_requisition');
                        }

                    } 
                }
      
		    }

            $data['purchase_id'] = "";

            $data['mrn_reff_id'] = "";
  
        }

       

        echo json_encode($data);
  

    }
    

    public function Date()
    {
        $date = $this->request->getPost('Date');

        $your_date = strtotime("1 day", strtotime($date));
     
        $data['increment_date_date'] = date("d-M-Y", $your_date);

        echo json_encode($data);
    }


    public function FetchTypes()
    {

        $page= !empty($_GET['page']) ? $_GET['page'] : 0;
        $term = !empty($_GET['term']) ? $_GET['term'] : "";
        $resultCount = 10;
        $end = ($page - 1) * $resultCount;       
        $start = $end + $resultCount;
      
        $data['result'] = $this->common_model->FetchAllLimit('steel_pro_vendor','ven_name','asc',$term,$start,$end);
      

        $data['total_count'] =count($data['result']);

        return json_encode($data);

    }

    public function vendorFetch()
    {
        $vendor = $this->common_model->SingleRow('pro_vendor',array('ven_id' => $this->request->getPost('ID')));

        $vendor_contacts = $this->common_model->FetchWhere('pro_contact',array('pro_con_vendor' => $this->request->getPost('ID')));
        
        $data['condact_data'] = '<option value="" selected disabled>Select Contact Person</option>';
        
        foreach($vendor_contacts as $ven_contact)
        {
            $data['condact_data'] .='<option value='.$ven_contact->pro_con_id.'>'.$ven_contact->pro_con_person.'</option>';
        }
        
        $data['payment_term']= $vendor->ven_credit_term;

        return json_encode($data);
    }


    public function FetchReference()
    {
    
        $data['uid'] = $this->common_model->FetchNextId('pro_purchase_order',"PO");

        $cond2 = array('mr_pur_status' => 0);

        $material_reqisition = $this->common_model->FetchWhere('pro_material_requisition',$cond2);

        $data['mrn'] = "<option value='' selected disabled>Select MRN Ref</option>";

        foreach($material_reqisition as $matetial_resq)
        {
            $data['mrn'] .="<option value='".$matetial_resq->mr_id."'>".$matetial_resq->mr_reffer_no."</option>";
        }

       // echo $uid;

       echo json_encode($data);
    
    }


    public function FetchProduct()
    {
        $cond1 = array('mrp_mr_id' => $this->request->getPost('ID'));
        
        $joins = array(

            array(
                'table' => 'crm_products',
                'pk'    => 'product_id',
                'fk'    => 'mrp_product_desc',
            ),
            array(
                'table' => 'crm_sales_orders',
                'pk'    => 'so_id',
                'fk'    => 'mrp_sales_order',
            ),

        );

        $products = $this->common_model->FetchProd('pro_material_requisition_prod',$cond1,array('mrp_pur_status'=>0),$joins);


        $i = 1; 
        
        $data['product_details'] ="";

        foreach($products as $prod){

            $data['product_details'] .='<tr class="" id="'.$prod->mrp_id.'">
                                            <td class="si_no">'.$i.'</td>
                                            <td><input type="text" name="dpd_prod_det[]" value="'.$prod->product_details.'" class="form-control"  readonly></td>
                                            <td><input type="text" name="dpd_unit[]" value="'.$prod->mrp_unit.'" class="form-control" readonly></td>
                                            <td><input type="number" name="dpd_order_qty[]" value="'.$prod->mrp_qty.'"  class="form-control order_qty" readonly></td>
                                            <td><input type="checkbox" name="product_select[]" id="'.$prod->mrp_id.'"  onclick="handleCheckboxChange(this)" class="prod_checkmark"></td>
                                               
                                        </tr>';
                                            $i++;
        }

        //print_r($data['product_details']);
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
            $cond = array('mrp_id' => $number);

            $joins1 = array(
                array(
                    'table' => 'crm_products',
                    'pk'    => 'product_id',
                    'fk'    => 'mrp_product_desc',
                ),
                array(
                    'table' => 'crm_sales_orders',
                    'pk'    => 'so_id',
                    'fk'    => 'mrp_sales_order',
                ),
    
            );

            $products = $this->common_model->FetchWhereJoin('pro_material_requisition_prod',$cond,$joins1);

            //$products = $this->common_model->FetchAllOrder('crm_products', 'product_id', 'desc');

            
            foreach($products as $product){
                $data['product_detail'] .='<tr class="add_prod_row add_prod_remove" id="'.$product->mrp_id.'">
                                            <td class="si_no">'.$i.'</td>
                                            <td><input type="text" name="" value="'.$product->so_reffer_no.'" class="form-control" readonly></td>
                                            <td><input type="text" name="" value="'.$product->product_details.'" class="form-control" readonly></td>
                                            <td><input type="text" name="pop_unit[]" value="'.$product->mrp_unit.'" class="form-control" readonly></td>
                                            <td><input type="number" name="pop_qty[]" value="'.$product->mrp_qty.'"  class="form-control add_prod_qty" readonly></td>
                                            <td><input type="number" name="pop_rate[]" value=""  class="form-control add_prod_rate" required></td>
                                            <td><input type="number" name="pop_discount[]" value=""  class="form-control add_discount" min="0" max="100" onkeyup="MinMax(this)" required></td>
                                            <td><input type="number" name="pop_amount[]" value=""  class="form-control add_prod_amount" readonly></td>
                                            <input type="hidden" name="pop_sales_order[]" value="'.$product->so_id.'" class="form-control" readonly>
                                            <input type="hidden" name="pop_prod_desc[]" value="'.$product->mrp_product_desc.'">
                                            <input type="hidden" name="material_req_prod_id[]" value="'.$product->mrp_id.'">
                                            <input type="hidden" name="material_req[]" value="'.$product->mrp_mr_id.'">
                                                 
                                                    
                                                </tr>';
                                                
                                                } $i++;

            
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

    public function View(){

        $join =  array(
            
            array(
                'table' => 'pro_vendor',
                'pk'    => 'ven_id',
                'fk'    => 'po_vendor_name',
            ),

            array(
                'table' => 'pro_contact',
                'pk'    => 'pro_con_id',
                'fk'    => 'po_contact_person',
            ),

            array(
                'table' => 'pro_material_requisition',
                'pk'    => 'mr_id',
                'fk'    => 'po_mrn_reff',
            ),

        );
        
        //$cond = array('po_id' => $this->request->getPost('ID'));

        $material_requisition = $this->common_model->SingleRowJoin('pro_purchase_order', array('po_id' => $this->request->getPost('ID')),$join);
        
        $data['reffer_no'] = $material_requisition->po_reffer_no;

        $data['date'] = date('d-M-Y',strtotime($material_requisition->po_date));

        $data['vendor_name'] = $material_requisition->ven_name;

        $data['contact_person'] = $material_requisition->pro_con_person;

        $data['mrn_reff'] = $material_requisition->mr_reffer_no;

        $data['payment_term'] = $material_requisition->po_payment_term;

        $data['delivery_date'] = date('d-M-Y',strtotime($material_requisition->po_delivery_date));

        $data['vendor_ref'] = $material_requisition->po_vendor_ref;

        $data['total_amount'] = $material_requisition->po_amount;



        $join =  array(
            
            array(
                'table' => 'crm_sales_orders',
                'pk'    => 'so_id',
                'fk'    => 'pop_sales_order',
            ),

            array(
                'table' => 'crm_products',
                'pk'    => 'product_id',
                'fk'    => 'pop_prod_desc',
            ),

            
        );

        $purchase_order_product = $this->common_model->FetchWhereJoin('pro_purchase_order_product',array('pop_purchase_order' => $this->request->getPost('ID')),$join);
        
        $i=1;

        $data['sales_order'] = '';

        foreach($purchase_order_product as $pur_order_prod)
        {
            $data['sales_order'] .= '<tr class="edit_prod_row" id="'.$pur_order_prod->pop_id.'">
            <td class="si_no1">'.$i.'</td>
            <td><input type="text" name=""  value="'.$pur_order_prod->so_reffer_no.'" class="form-control" readonly></td>
            <td><input type="text" name=""  value="'.$pur_order_prod->product_details.'" class="form-control" readonly></td>
            <td><input type="text" name=""  value="'.$pur_order_prod->pop_unit.'" class="form-control" readonly></td>
            <td> <input type="text" name="" value="'.$pur_order_prod->pop_qty.'" class="form-control" readonly></td>
            <td> <input type="text" name="" value="'.$pur_order_prod->pop_rate.'" class="form-control" readonly></td>
            <td> <input type="text" name="" value="'.$pur_order_prod->pop_discount.'" class="form-control" readonly></td>
            <td> <input type="text" name="" value="'.$pur_order_prod->pop_amount.'" class="form-control" readonly></td>
            </tr>
            ';
            $i++; 
        }


        if(!empty($material_requisition->po_file))
	    {
            $data['image_table'] ='
            <table id="" class="table table-bordered table-striped delTable display dataTable" style="border: 1px solid #9E9E9E;width: 50%">
                <thead>
                    <tr>
                        <th class="cust_img_rgt_border">File Name</th>
                        <th class="cust_img_rgt_border">Download</th>
                        
                    </tr>
                <thead>
                <tbody>
                    <tr>
                        <td class="cust_img_rgt_border edit_file_name" >'.$material_requisition->po_file.'</td>
                        <td class="cust_img_rgt_border edit_file_attach"><a href="'.base_url('uploads/PurchaseOrder/' .$material_requisition->po_file).'" target="_blank">View</a></td>
                        
                    </tr>
                </tbody>
            </table>';
	    }


        echo json_encode($data);
    }


    public function Edit(){

        $join =  array(
            
            array(
                'table' => 'pro_material_requisition',
                'pk'    => 'mr_id',
                'fk'    => 'po_mrn_reff',
            ),

           
        );

        $purchase_order = $this->common_model->SingleRowJoin('pro_purchase_order', array('po_id' => $this->request->getPost('ID')),$join);
        
        $data['reffer_no'] = $purchase_order->po_reffer_no;

        $data['mrn_reff_id'] = $purchase_order->po_mrn_reff;

        $data['date'] = date('d-M-Y',strtotime($purchase_order->po_date));

        $data['material_req'] = $purchase_order->mr_reffer_no;

       
        //fetch vendor

        $vendors = $this->common_model->FetchAllOrder('pro_vendor','ven_id','desc');

        $data['vendor_name'] = '';

        foreach($vendors as $vendor)
        {  
            
            $data['vendor_name'] .= '<option value="' .$vendor->ven_id.'"'; 

            if($purchase_order->po_vendor_name == $vendor->ven_id)
            {
                $data['vendor_name'] .= ' selected'; 
            }

		    $data['vendor_name'] .= '>' . $vendor->ven_name.'</option>';
        }



        //fetch contact
        
        $contacts = $this->common_model->FetchWhere('pro_contact',array('pro_con_vendor' => $purchase_order->po_vendor_name));

        $data['contact_person'] = '';

        foreach($contacts as $contact)
        {  
            
            $data['contact_person'] .= '<option value="' .$contact->pro_con_id.'"'; 

            if($purchase_order->po_contact_person == $contact->pro_con_id)
            {
                $data['contact_person'] .= ' selected'; 
            }

		    $data['contact_person'] .= '>' . $contact->pro_con_person.'</option>';
        }



        $data['payment_term'] = $purchase_order->po_payment_term;

        $data['delivery_date'] = date('d-M-Y',strtotime($purchase_order->po_delivery_date));

        $data['vendor_ref'] = $purchase_order->po_vendor_ref;

        $data['purchase_id'] = $purchase_order->po_id;

        $data['po_amount'] = $purchase_order->po_amount;

        $join =  array(
            
            array(
                'table' => 'crm_sales_orders',
                'pk'    => 'so_id',
                'fk'    => 'pop_sales_order',
            ),

            array(
                'table' => 'crm_products',
                'pk'    => 'product_id',
                'fk'    => 'pop_prod_desc',
            ),

            
        );

        $purchase_order_product = $this->common_model->FetchWhereJoin('pro_purchase_order_product',array('pop_purchase_order' => $this->request->getPost('ID')),$join);
        
       

        $i=1;

        $data['sales_order'] = "";

        foreach($purchase_order_product as $pur_order_prod)
        {
            $data['sales_order'] .= '<tr class="edit_prod_row" id="'.$pur_order_prod->pop_id.'">
            <td class="si_no1 delete_sino">'.$i.'</td>
            <td><input type="text" name=""  value="'.$pur_order_prod->so_reffer_no.'" class="form-control" readonly></td>
            <td><input type="text" name=""  value="'.$pur_order_prod->product_details.'" class="form-control" readonly></td>
            <td><input type="text" name=""  value="'.$pur_order_prod->pop_unit.'" class="form-control" readonly></td>
            <td> <input type="text" name="" value="'.$pur_order_prod->pop_qty.'" class="form-control" readonly></td>
            <td> <input type="text" name="" value="'.$pur_order_prod->pop_rate.'" class="form-control" readonly></td>
            <td> <input type="text" name="" value="'.$pur_order_prod->pop_discount.'" class="form-control" readonly></td>
            <td> <input type="text" name="" value="'.$pur_order_prod->pop_amount.'" class="form-control edit_amount" readonly></td>
            <td style="width:15%">
                <a href="javascript:void(0)" class="delete delete-color sales_delete" data-id="'.$pur_order_prod->pop_id.'"  data-toggle="tooltip" data-placement="top" title="Delete"><i class="ri-delete-bin-fill"></i> Delete</a>
            </td>
            </tr>
            ';
            $i++; 
        }


        if(!empty($purchase_order->po_file))
        {
            $data['image_table'] ='
            <table id="" class="table table-bordered table-striped delTable display dataTable" style="border: 1px solid #9E9E9E;width: 50%">
                <thead>
                    <tr>
                        <th class="cust_img_rgt_border">File Name</th>
                        <th class="cust_img_rgt_border">Download</th>
                        <th class="cust_img_rgt_border">Update</th>
                    </tr>
                <thead>
                <tbody>
                    <tr>
                        <td class="cust_img_rgt_border edit_file_name" >'. $purchase_order->po_file.'</td>
                        <td class="cust_img_rgt_border edit_file_attach"><a href="'.base_url('uploads/PurchaseOrder/' .$purchase_order->po_file).'" target="_blank">View</a></td>
                        <td class="cust_img_rgt_border" ><input type="file" name="po_file"></td>
                    </tr>
                </tbody>
             </table>';
        }

       

        echo json_encode($data);
    }

    public function Update()
    {
        
        $cond = array('po_id' => $this->request->getPost('po_id'));

        $purchase_order = $this->common_model->SingleRow('pro_purchase_order',$cond);
                
        $update_data = $this->request->getPost();

        
        // Check if the 'account_id' key exists before unsetting it
        if (array_key_exists('po_id', $update_data)) 
        {
            unset($update_data['po_id']);
        }  

        $update_data['po_date'] =  date('Y-m-d',strtotime($this->request->getPost('po_date')));

        $update_data['po_delivery_date'] =  date('Y-m-d',strtotime($this->request->getPost('po_delivery_date')));

       // Handle file upload
	    if (isset($_FILES['po_file']) && $_FILES['po_file']['name'] !== '') {
		
		
            if($this->request->getFile('po_file') != '' ){ 
            
                $previousImagePath = 'uploads/PurchaseOrder/' .$purchase_order->po_file;
            
                if (file_exists($previousImagePath)) {
                    unlink($previousImagePath);
                }
            }
		
		    // Upload the new image
		    $AttachFileName = $this->uploadFile('po_file', 'uploads/PurchaseOrder');
	
		    // Update the data with the new image filename
		    $update_data['po_file'] = $AttachFileName;
	    }


        $this->common_model->EditData($update_data, array('po_id' => $this->request->getPost('po_id')), 'pro_purchase_order');
        
    }


    public function DeleteSales()
    { 
        $data['status'] = 0;

        $cond = array('pop_id' => $this->request->getPost('ID'));

        $pur_order_prod = $this->common_model->SingleRow('pro_purchase_order_product',$cond);

        $this->common_model->EditData(array('mrp_pur_status' => 0), array('mrp_id' => $pur_order_prod->pop_material_req_prod_id),'pro_material_requisition_prod');
        
        $material = $this->common_model->FetchWhere('pro_material_requisition_prod',array('mrp_id' => $pur_order_prod->pop_material_req_prod_id));
        
        $material_cond = $this->common_model->CheckTwiceCond1('pro_material_requisition_prod',array('mrp_id' => $pur_order_prod->pop_material_req_prod_id),array('mrp_pur_status' =>0));
        
        $material_req = $this->common_model->SingleRow('pro_material_requisition_prod',array('mrp_id' => $pur_order_prod->pop_material_req_prod_id));
        

        if(count($material) == count($material_cond))
        {
           
            $this->common_model->EditData(array('mr_pur_status' => 0), array('mr_id' => $material_req->mrp_mr_id),'pro_material_requisition');
          
        }

        //delete purchase order 
        $pur_prod_count = $this->common_model->FetchWhere('pro_purchase_order_product',array('pop_purchase_order' => $pur_order_prod->pop_purchase_order));

        if(count($pur_prod_count) == 1)
        {   
           
            $this->common_model->DeleteData('pro_purchase_order',array('po_id' => $pur_order_prod->pop_purchase_order));
            
            $data['status'] = "true";
        }
        else
        {
            $data["status"] = "false";
        }
       
        $this->common_model->DeleteData('pro_purchase_order_product',$cond);

        $pur_order_amount = $this->common_model->FetchWhere('pro_purchase_order_product',array('pop_purchase_order' => $pur_order_prod->pop_purchase_order));
        
       

        $total_amount = 0; 

        foreach($pur_order_amount as $pur_ord_amont)
        {
            $total_amount = $pur_ord_amont->pop_amount + $total_amount;
        }

        $this->common_model->EditData(array('po_amount' => $total_amount), array('po_id' => $pur_order_prod->pop_purchase_order),'pro_purchase_order');
          
        $purchase_order_prod = $this->common_model->FetchWhere('pro_purchase_order_product',array('pop_purchase_order' => $pur_order_prod->pop_purchase_order));
        
        
        $data['total_amount'] =  number_format($total_amount,2);

       /* if(empty($purchase_order_prod))
        {
           $this->common_model->DeleteData('pro_purchase_order', array('po_id' => $pur_order_prod->pop_purchase_order));
           
           $data['status'] = "true";  
        }
        else
        {
            $data['status'] = "false";
        }*/


        echo json_encode($data);
        
       
    }


    public function Delete()
    {
        $cond = array('po_id' => $this->request->getPost('ID'));

        $purchase = $this->common_model->SingleRow('pro_purchase_order',$cond);

        $this->common_model->EditData(array('mrp_pur_status' => 0), array('mrp_mr_id' => $purchase->po_mrn_reff),'pro_material_requisition_prod');
        
        $this->common_model->EditData(array('mr_pur_status' => 0), array('mr_id' => $purchase->po_mrn_reff),'pro_material_requisition');
        
        $material_received = $this->common_model->FetchWhere('pro_material_received_note',array('mrn_purchase_order' => $this->request->getPost('ID')));
        
        if(empty($material_received)){
           
            $this->common_model->DeleteData('pro_purchase_order_product', array('pop_purchase_order' => $this->request->getPost('ID')));
        
            $this->common_model->DeleteData('pro_purchase_order',$cond);

            $data['status'] ="true";

        }
        else{

            $data['status'] ="false";
        }

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




 
 

}
