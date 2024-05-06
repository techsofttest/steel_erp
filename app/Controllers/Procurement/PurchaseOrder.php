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
           
        );
        ## Fetch records
        $records = $this->common_model->GetRecord('pro_purchase_order','po_id',$searchValue,$searchColumns,$columnName,$columnSortOrder,$joins,$rowperpage,$start);
    
        $data = array();

        $i=1;
        foreach($records as $record ){
            $action = '<a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->po_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a><a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->po_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> Delete</a><a  href="javascript:void(0)" data-id="'.$record->po_id.'"  class="view view-color view_btn" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a>';
           
           $data[] = array( 
              "po_id"         => $i,
              'po_reffer_no'  => $record->po_reffer_no,
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

        $cond2 = array('mr_purchase_status' => 0);

        $data['material_reqisition'] = $this->common_model->FetchWhere('pro_material_requisition',$cond2);
        
        $data['content'] = view('Procurement/purchase-order',$data);

        return view('procurement/pro-module',$data);

    }


    // add account head
    Public function Add()
    {   
        
        if(empty($this->request->getPost('po_id')))
        {
            $insert_data = [

                'po_reffer_no'       => $this->request->getPost('po_reffer_no'),

                'po_date'            => date('Y-m-d',strtotime($this->request->getPost('po_date'))),

                'po_vendor_name'     => $this->request->getPost('po_vendor_name'),

                'po_contact_person'  => $this->request->getPost('po_contact_person'),

                'po_mrn_reff'        => $this->request->getPost('po_mrn_reff'),

                'po_payment_term'    => $this->request->getPost('po_payment_term'),

                'po_delivery_date'   => $this->request->getPost('po_delivery_date'),

                'po_vendor_ref'      => $this->request->getPost('po_vendor_ref'),

                'po_added_by'        => 0,

                'po_added_date'      => date('Y-m-d'),

            ];
            
            if (isset($_FILES['po_file']) && $_FILES['po_file']['name'] !== '') {
                
                // Upload the new image
                $attachFileName = $this->uploadFile('po_file', 'uploads/DeliveryNote');
            
                // Update the data with the new image filename
                $insert_data['po_file'] = $attachFileName;

                
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

                'po_delivery_date'   => $this->request->getPost('po_delivery_date'),

                'po_vendor_ref'      => $this->request->getPost('po_vendor_ref'),

                'po_added_by'        => 0,

                'po_added_date'      => date('Y-m-d'),

            ];
            
            if (isset($_FILES['po_file']) && $_FILES['po_file']['name'] !== '') {
                
                // Upload the new image
                $attachFileName = $this->uploadFile('po_file', 'uploads/DeliveryNote');
            
                // Update the data with the new image filename
                $insert_data['po_file'] = $attachFileName;

                
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
                            
                            'pop_sales_order'  =>  $_POST['pop_sales_order'][$j],
                            'pop_prod_desc'    =>  $_POST['pop_prod_desc'][$j],
                            'pop_unit'         =>  $_POST['pop_unit'][$j],
                            'pop_qty'          =>  $_POST['pop_qty'][$j],
                            'pop_rate'         =>  $_POST['pop_rate'][$j],
                            'pop_discount'     =>  $_POST['pop_discount'][$j],
                            'pop_amount'       =>  $_POST['pop_amount'][$j],
                            'pop_purchase_order'  =>  $purchase_id,
                            
                        );

                        $this->common_model->InsertData('pro_purchase_order_product',$insert_data);

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
    
        $uid = $this->common_model->FetchNextId('pro_purchase_order',"PO");
    
        echo $uid;
    
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

        $products = $this->common_model->FetchWhereJoin('pro_material_requisition_prod',$cond1,$joins);


        $i = 1; 
        
        $data['product_detail'] ="";

        foreach($products as $prod){

            $data['product_detail'] .='<tr class="" id="'.$prod->mrp_id.'">
                                            <td class="si_no">'.$i.'</td>
                                            <td><input type="text" name="dpd_prod_det[]" value="'.$prod->product_details.'" class="form-control"  readonly></td>
                                            <td><input type="text" name="dpd_unit[]" value="'.$prod->mrp_unit.'" class="form-control" readonly></td>
                                            <td><input type="number" name="dpd_order_qty[]" value="'.$prod->mrp_qty.'"  class="form-control order_qty" readonly></td>
                                            <td><input type="checkbox" name="product_select[]" id="'.$prod->mrp_id.'"  onclick="handleCheckboxChange(this)" class="prod_checkmark"></td>
                                               
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
                                            <td><input type="text" name="pop_unit[]" value="" class="form-control" required></td>
                                            <td><input type="number" name="pop_qty[]" value=""  class="form-control add_prod_qty" required></td>
                                            <td><input type="number" name="pop_rate[]" value=""  class="form-control add_prod_rate" required></td>
                                            <td><input type="number" name="pop_discount[]" value=""  class="form-control add_discount" required></td>
                                            <td><input type="number" name="pop_amount[]" value=""  class="form-control add_prod_amount" readonly></td>
                                            <input type="hidden" name="pop_sales_order[]" value="'.$product->so_id.'" class="form-control" readonly>
                                            <input type="hidden" name="pop_prod_desc[]" value="'.$product->mrp_product_desc.'">
                                           
                                            
                                          
                                                    
                                                    
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
                        'pro_con_vendor'       =>  $_POST['new_vendor_hidden_id'][$j],
                      
                    );

                    $this->common_model->InsertData('pro_contact',$insert_data);

                } 
            }
    
        }   
    }
 

}
