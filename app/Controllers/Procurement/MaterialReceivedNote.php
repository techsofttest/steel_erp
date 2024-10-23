<?php

namespace App\Controllers\Procurement;

use App\Controllers\BaseController;


class MaterialReceivedNote extends BaseController
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
       
        $totalRecords = $this->common_model->GetTotalRecords('pro_material_received_note','mrn_id','DESC');
        
        
        ## Total number of records with filtering
       
        $searchColumns = array('mrn_reffer');

        $totalRecordwithFilter = $this->common_model->GetTotalRecordwithFilter('pro_material_received_note','mrn_id',$searchValue,$searchColumns);
    
        ##Joins if any //Pass Joins as Multi dim array
        $joins = array(
            
            array(
                'table' => 'pro_purchase_order',
                'pk'    => 'po_id',
                'fk'    => 'mrn_purchase_order',
            ), 
           
        );
        ## Fetch records
        $records = $this->common_model->GetRecord('pro_material_received_note','mrn_id',$searchValue,$searchColumns,$columnName,$columnSortOrder,$joins,$rowperpage,$start);
        
        

        $data = array();

        $i=1;
        foreach($records as $record ){
            $action = '<a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->mrn_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a><a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->mrn_id.'"  data-placement="top" style="display:none;" title="Delete"><i  class="ri-delete-bin-fill"></i> Delete</a><a  href="javascript:void(0)" data-id="'.$record->mrn_id.'"  class="view view-color view_btn" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a>';
           
           $data[] = array( 
              "mrn_id"      => $i,
              'mrn_reffer'  => $record->mrn_reffer,
              'mrn_purchase_order'  => $record->po_reffer_no,
              'mrn_date'    => date('d-m-Y',strtotime($record->mrn_date)),
              "action"      => $action,
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

        $data['material_requisition'] = $this->common_model->FetchNextId('pro_material_received_note','MRN');
 
        $cond = array('so_deliver_flag' => 0);

        //$data['sales_orders'] = $this->common_model->FetchWhere('crm_sales_orders',$cond);

        $data['content'] = view('procurement/material-received-note',$data);

        return view('procurement/pro-module',$data);

    }


    // add account head
    Public function Add()
    {   
        
        if(empty($this->request->getPost('received_id')))
        {
            $uid = $this->common_model->FetchNextId('pro_material_received_note',"MRN");
            
            $insert_data = [

                'mrn_reffer'          => $uid,

                'mrn_date'            => date('Y-m-d',strtotime($this->request->getPost('mrn_date'))),

                'mrn_vendor_name'     => $this->request->getPost('mrn_vendor_name'),

                'mrn_purchase_order'  => $this->request->getPost('mrn_purchase'),

                'mrn_delivery_note'   => $this->request->getPost('mrn_delivery_note'),

                'mrn_mr_reffer'       => $this->request->getPost('mr_reff'),

                'mrn_payment_term'    => $this->request->getPost('mrn_payment_term'),

                'mrn_added_by'        => 0,

                'mrn_added_date'      => date('Y-m-d'),

            ];
          

            
            if (isset($_FILES['mrn_file']) && $_FILES['mrn_file']['name'] !== '') {
                
                // Upload the new image
                $attachFileName = $this->uploadFile('mrn_file', 'uploads/MaterialReceived');
            
                // Update the data with the new image filename
                $insert_data['mrn_file'] = $attachFileName;
 
            }

            $material_received_id = $this->common_model->InsertData('pro_material_received_note',$insert_data);

            $data['material_received_id'] = $material_received_id;

            $material_received = $this->common_model->SingleRow('pro_material_received_note',array('mrn_id' => $material_received_id));

            $data['purchase_id'] =  $material_received->mrn_purchase_order;

            $data['mrn_recived_id'] =  $material_received_id;

            //$this->common_model->EditData(array('po_delivered_status' => 0), array('po_id' => $this->request->getPost('mrn_purchase')),'pro_purchase_order');


           // $data['mrn_reff_id'] = $this->request->getPost('po_mrn_reff');
        }
        else
        {
            $updated_data = [

                'mrn_reffer'          => $this->request->getPost('mrn_reffer_no'),

                'mrn_date'            => date('Y-m-d',strtotime($this->request->getPost('mrn_date'))),

                'mrn_vendor_name'     => $this->request->getPost('mrn_vendor_name'),

                'mrn_purchase_order'  => $this->request->getPost('mrn_purchase'),

                'mrn_delivery_note'   => $this->request->getPost('mrn_delivery_note'),

                'mrn_mr_reffer'       => $this->request->getPost('mr_reff'),

                'mrn_payment_term'    => $this->request->getPost('mrn_payment_term'),


            ];
            
          

            if (isset($_FILES['mrn_file']) && $_FILES['mrn_file']['name'] !== '') {
                
                // Upload the new image
                $attachFileName = $this->uploadFile('mrn_file', 'uploads/MaterialReceived');
            
                // Update the data with the new image filename
                $updated_data['mrn_file'] = $attachFileName;

                
            }

            $this->common_model->EditData($updated_data, array('mrn_id' => $this->request->getPost('received_id')),'pro_material_received_note');
            
            


            if(!empty($_POST['pop_qty']))
		    {    
                $count =  count($_POST['pop_qty']);
                
                if($count!=0)
                {  
                
                    for($j=0;$j<=$count-1;$j++)
                    {
                    
                        $new_delivery_qty = $_POST['current_qty'][$j] + $_POST['delivered_qty'][$j];

                        $multipliedTotal = $_POST['rate'][$j] *  $_POST['current_qty'][$j];

                        $per_amount = ($_POST['discount'][$j]/100)*$multipliedTotal;

                        $orginalPrice = $multipliedTotal - $per_amount;

                        $total_amount = number_format((float)$orginalPrice, 2, '.', '');  // Outputs -> 105.00

                        $insert_data  	= array(  
                            
                            'rnp_sales_order'            =>  $_POST['sales_order'][$j],
                            'rnp_product_desc'           =>  $_POST['prod_desc'][$j],
                            'rnp_unit'                   =>  $_POST['pop_unit'][$j],
                            'rnp_order_qty'              =>  $_POST['pop_qty'][$j],
                            'rnp_delivery_qty'           =>  $_POST['delivered_qty'][$j],
                            'rnp_current_delivery'       =>  $_POST['current_qty'][$j],
                            'rnp_material_received_note' =>  $this->request->getPost('received_id'),
                            'rnp_purchase_id'            =>  $_POST['purchase_org_id'][$j],
                            'rnp_purchase_prod_id'       =>  $_POST['purchase_id'][$j],
                            'rnp_discount'               =>  $_POST['discount'][$j],
                            'rnp_amount'                 =>  $total_amount,
                            'rnp_rate'                   =>  $_POST['rate'][$j],
                            
                        );


                        $this->common_model->InsertData('pro_material_received_note_prod',$insert_data);

                        
                        $this->common_model->EditData(array('pop_delivered_order' => $new_delivery_qty),array('pop_id' => $_POST['purchase_id'][$j]),'pro_purchase_order_product');
                        

                        $purchase_prod = $this->common_model->SingleRow('pro_purchase_order_product',array('pop_id' => $_POST['purchase_id'][$j]));
                        
                       if($purchase_prod->pop_qty == $purchase_prod->pop_delivered_order)
                        {
                            $this->common_model->EditData(array('pop_delivered_status' => 1),array('pop_id' => $_POST['purchase_id'][$j]),'pro_purchase_order_product');

                            
                        }


                        $prod_detail = $this->common_model->FetchWhere('pro_purchase_order_product',array('pop_purchase_order' => $purchase_prod->pop_purchase_order));

                        $prod_detail_flag = $this->common_model->FetchProdData('pro_purchase_order_product',array('pop_purchase_order' => $purchase_prod->pop_purchase_order),array('pop_delivered_status'=>1));
    

                        if(count($prod_detail) == count($prod_detail_flag))
                        {
                           $this->common_model->EditData(array('po_delivered_status' => 1),array('po_id' => $purchase_prod->pop_purchase_order),'pro_purchase_order');
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

    public function FetchPurchase()
    {
        $vendor_id  = $this->request->getPost('ID');

        //$purchases = $this->common_model->FetchWHere('pro_purchase_order',array('po_vendor_name' => $vendor_id));

        $purchases = $this->common_model->CheckTwiceCond1('pro_purchase_order',array('po_vendor_name' => $vendor_id),array('po_delivered_status' => 0));
        
        $data['pur_reff'] ="<option value='' selected disabled>Select Purchase</option>";

        foreach($purchases as $purchase){
            
            $data['pur_reff'] .="<option value='".$purchase->po_id."'>".$purchase->po_reffer_no."</option>";
           
        }
        
        echo json_encode($data);
    }


    public function FetchReference()
    {
    
        $uid = $this->common_model->FetchNextId('pro_material_received_note',"MRN");
    
        echo $uid;
    
    }


    public function FetchProduct()
    {   
       
    
        $cond1 = array('pop_purchase_order' => $this->request->getPost('ID'));
         
        $joins = array(
            
            array(
                'table' => 'crm_products',
                'pk'    => 'product_id',
                'fk'    => 'pop_prod_desc',
            ),
           

        );

        //$products = $this->common_model->FetchWhereJoin('pro_purchase_order_product',$cond1,$joins);

        $products = $this->common_model->FetchProd('pro_purchase_order_product',$cond1,array('pop_delivered_status'=>0),$joins);
         
       

        $i = 1; 
        
        $data['product_detail'] ="";

        foreach($products as $prod){

            $data['product_detail'] .='<tr class="" id="'.$prod->pop_id.'">
                                            
                                            <td class="si_no">'.$i.'</td>
                                            <td><input type="text" name="dpd_prod_det[]" value="'.$prod->product_details.'" class="form-control"  readonly></td>
                                            <td><input type="text" name="dpd_unit[]" value="'.$prod->pop_unit.'" class="form-control" readonly></td>
                                            <td><input type="number" name="dpd_order_qty[]" value="'.$prod->pop_qty.'"  class="form-control order_qty" readonly></td>
                                            <td><input type="checkbox" name="product_select[]" id="'.$prod->pop_id.'"  onclick="handleCheckboxChange(this)" class="prod_checkmark"></td>
                                          
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
            $cond = array('pop_id' => $number);

            $joins1 = array(
                array(
                    'table' => 'crm_products',
                    'pk'    => 'product_id',
                    'fk'    => 'pop_prod_desc',
                ),
                array(
                    'table' => 'crm_sales_orders',
                    'pk'    => 'so_id',
                    'fk'    => 'pop_sales_order',
                ),
               
    
            );

            $products = $this->common_model->FetchWhereJoin('pro_purchase_order_product',$cond,$joins1);

            

            
            foreach($products as $product){

                
               

                $data['product_detail'] .='<tr class="add_prod_row add_prod_remove" id="'.$product->pop_id.'">
                                            <td class="si_no">'.$i.'</td>
                                            <td><input type="text" name="sales_order[]" value="'.$product->so_reffer_no.'" class="form-control" readonly></td>
                                            <td><input type="text" name="prod_desc[]" value="'.$product->product_details.'" class="form-control" readonly></td>
                                            <td><input type="text" name="pop_unit[]" value="'.$product->pop_unit.'" class="form-control" required></td>
                                            <td><input type="number" name="pop_qty[]" value="'.$product->pop_qty.'"  class="form-control add_order_qty" readonly required></td>
                                            <td><input type="text" name="delivered_qty[]" value="'.$product->pop_delivered_order.'"  class="form-control add_delivery_qty" required readonly></td>
                                            <td><input type="text" name="current_qty[]" value=""  class="form-control add_current_qty" required></td>
                                            <td><input type="hidden" name="purchase_id[]" value="'.$product->pop_id.'"></td>
                                            <td><input type="hidden" name="purchase_org_id[]" value="'.$product->pop_purchase_order.'"></td>
                                            <td><input type="hidden" name="rate[]" value="'.$product->pop_rate.'"></td>
                                            td><input type="hidden" name="discount[]" value="'.$product->pop_discount.'"></td>
                                           
                                        </tr>';
 
                                    
                                     $i++;}

       
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


    public function View(){

        $join =  array(
            
            array(
                'table' => 'pro_vendor',
                'pk'    => 'ven_id',
                'fk'    => 'mrn_vendor_name',
            ),

            array(
                'table' => 'pro_purchase_order',
                'pk'    => 'po_id',
                'fk'    => 'mrn_purchase_order',
            ),

            

        );
        
        $material_received = $this->common_model->SingleRowJoin('pro_material_received_note', array('mrn_id' => $this->request->getPost('ID')),$join);
        
        $data['reffer_n0']      = $material_received->mrn_reffer;

        $data['date']           = date('d-M-Y',strtotime($material_received->mrn_date));

        $data['vendor_name']    = $material_received->ven_name;

        $data['purchase_order'] = $material_received->po_reffer_no;

        $data['delivery_note']  = $material_received->mrn_delivery_note;

        $data['mr_reffer']      = $material_received->mrn_mr_reffer;

        $data['payment_term']   = $material_received->mrn_payment_term;

       
        /*$join =  array(
            
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

            
        );*/

        //$purchase_order_product = $this->common_model->FetchWhereJoin('pro_purchase_order_product',array('pop_purchase_order' => $this->request->getPost('ID')),$join);
        
        $material_received_product = $this->common_model->FetchWhere('pro_material_received_note_prod',array('rnp_material_received_note' => $this->request->getPost('ID')));
        

        $i=1;

        $data['sales_order'] = '';

        foreach($material_received_product as $material_received_prod)
        {
            $data['sales_order'] .= '<tr class="edit_prod_row" id="'.$material_received_prod->rnp_id.'">
            <td class="si_no1">'.$i.'</td>
            <td><input type="text" name=""  value="'.$material_received_prod->rnp_sales_order.'" class="form-control" readonly></td>
            <td><input type="text" name=""  value="'.$material_received_prod->rnp_product_desc.'" class="form-control" readonly></td>
            <td><input type="text" name=""  value="'.$material_received_prod->rnp_unit.'" class="form-control" readonly></td>
            <td> <input type="text" name="" value="'.$material_received_prod->rnp_order_qty.'" class="form-control" readonly></td>
            <td> <input type="text" name="" value="'.$material_received_prod->rnp_current_delivery.'" class="form-control" readonly></td>
           </tr>
            ';
            $i++; 
        }

        if(!empty($material_received->mrn_file))
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
                        <td class="cust_img_rgt_border edit_file_name" >'.$material_received->mrn_file.'</td>
                        <td class="cust_img_rgt_border edit_file_attach"><a href="'.base_url('uploads/MaterialReceived/' .$material_received->mrn_file).'" target="_blank">View</a></td>
                        
                    </tr>
                </tbody>
            </table>';
	    }




        echo json_encode($data);
    }


    public function Edit(){
        
        $join =  array(
            
            array(
                'table' => 'pro_vendor',
                'pk'    => 'ven_id',
                'fk'    => 'mrn_vendor_name',
            ),

            array(
                'table' => 'pro_purchase_order',
                'pk'    => 'po_id',
                'fk'    => 'mrn_purchase_order',
            ),

            

        );
        
        $material_received = $this->common_model->SingleRowJoin('pro_material_received_note', array('mrn_id' => $this->request->getPost('ID')),$join);
        
        $data['reffer_n0']      = $material_received->mrn_reffer;

        $data['date']           = date('d-M-Y',strtotime($material_received->mrn_date));

        $data['vendor_name']    = $material_received->ven_name;

        $data['purchase_order'] = $material_received->po_reffer_no;

        $data['delivery_note']  = $material_received->mrn_delivery_note;

        $data['mr_reffer']      = $material_received->mrn_mr_reffer;

        $data['payment_term']   = $material_received->mrn_payment_term;

        $data['main_id']        = $material_received->mrn_id;

        
        $material_received_product = $this->common_model->FetchWhere('pro_material_received_note_prod',array('rnp_material_received_note' => $this->request->getPost('ID')));
        

        $i=1;

        $data['sales_order'] = "";

        foreach($material_received_product as $material_received_prod)
        {
            $data['sales_order'] .= '<tr class="edit_prod_row" id="'.$material_received_prod->rnp_id.'">
            <td class="si_no1">'.$i.'</td>
            <td><input type="text" name=""  value="'.$material_received_prod->rnp_sales_order.'" class="form-control" readonly></td>
            <td><input type="text" name=""  value="'.$material_received_prod->rnp_product_desc.'" class="form-control" readonly></td>
            <td><input type="text" name=""  value="'.$material_received_prod->rnp_unit.'" class="form-control" readonly></td>
            <td> <input type="text" name="" value="'.$material_received_prod->rnp_order_qty.'" class="form-control" readonly></td>
            <td> <input type="text" name="" value="'.$material_received_prod->rnp_current_delivery.'" class="form-control" readonly></td>
            
            <td> <input type="text" name="" value="'.$material_received_prod->rnp_amount.'" class="form-control" readonly></td>
           
            <td style="width:15%">
                <a href="javascript:void(0)" class="delete delete-color sales_delete" data-id="'.$material_received_prod->rnp_id.'"  data-toggle="tooltip" data-placement="top" title="Delete"><i class="ri-delete-bin-fill"></i> Delete</a>
            </td>
            </tr>
            ';
            $i++; 
        }

        if(!empty($material_received->mrn_file))
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
                        <td class="cust_img_rgt_border edit_file_name" >'. $material_received->mrn_file.'</td>
                        <td class="cust_img_rgt_border edit_file_attach"><a href="'.base_url('uploads/MaterialReceived/' .$material_received->mrn_file).'" target="_blank">View</a></td>
                        <td class="cust_img_rgt_border" ><input type="file" name="mrn_file"></td>
                    </tr>
                </tbody>
             </table>';
        }



        echo json_encode($data);
    }


    public function Update()
    {
        $cond = array('mrn_id' => $this->request->getPost('mrn_id'));

        $material_received = $this->common_model->SingleRow('pro_material_received_note',$cond);

        $update_data = $this->request->getPost();

        // Check if the 'account_id' key exists before unsetting it
        if (array_key_exists('mrn_id', $update_data)) 
        {
            unset($update_data['mrn_id']);
        }  
            
        $update_data['mrn_date'] =  date('Y-m-d',strtotime($this->request->getPost('mrn_date')));
        
        // Handle file upload
	    if (isset($_FILES['mrn_file']) && $_FILES['mrn_file']['name'] !== '') {
		
		
            if($this->request->getFile('mrn_file') != '' ){ 
            
                $previousImagePath = 'uploads/MaterialReceived/' .$material_received->mrn_file;
            
                if (file_exists($previousImagePath)) {
                    unlink($previousImagePath);
                }
            }
		
		    // Upload the new image
		    $AttachFileName = $this->uploadFile('mrn_file', 'uploads/MaterialReceived');
	
		    // Update the data with the new image filename
		    $update_data['mrn_file'] = $AttachFileName;
	    }

       

        $this->common_model->EditData($update_data, array('mrn_id' => $this->request->getPost('mrn_id')), 'pro_material_received_note');
        
    }


    public function DeleteSales()
    { 
        $cond = array('rnp_id' => $this->request->getPost('ID'));

        $material_received_prod = $this->common_model->SingleRow('pro_material_received_note_prod',$cond);

        $this->common_model->EditData(array('po_delivered_status' => 0), array('po_id' => $material_received_prod->rnp_purchase_id), 'pro_purchase_order');
        
        $purchase_order_product = $this->common_model->SingleRow('pro_purchase_order_product',array('pop_id' => $material_received_prod->rnp_purchase_prod_id));
        
        $new_delivery_qty = $purchase_order_product->pop_delivered_order -  $material_received_prod->rnp_current_delivery;
        
        $this->common_model->EditData(array('pop_delivered_order'=>$new_delivery_qty,'pop_delivered_status'=>0), array('pop_id' => $material_received_prod->rnp_purchase_prod_id), 'pro_purchase_order_product');
        
        $material_received_prod_all = $this->common_model->FetchWhere('pro_material_received_note_prod',array('rnp_material_received_note' => $material_received_prod->rnp_material_received_note));
        
        

        if(count($material_received_prod_all) == 1)
        {
            $this->common_model->DeleteData('pro_material_received_note',array('mrn_id' => $material_received_prod->rnp_material_received_note));
            
            $data['status'] = "true";
        }
        else
        {
            $data['status'] = "false";
        }

        $this->common_model->DeleteData('pro_material_received_note_prod',$cond); 

        echo json_encode($data);


    }


    public function Delete()
    {
        $cond = array('mrn_id' => $this->request->getPost('ID'));

        $material_received_note = $this->common_model->SingleRow('pro_material_received_note',$cond);

        $material_received_product = $this->common_model->FetchWhere('pro_material_received_note_prod',array('rnp_material_received_note' => $material_received_note->mrn_id));

        foreach($material_received_product as $material_received_prod)
        {
            $this->common_model->EditData(array('po_delivered_status' => 0), array('po_id' => $material_received_prod->rnp_purchase_id), 'pro_purchase_order');
            
            $purchase_order_product = $this->common_model->SingleRow('pro_purchase_order_product',array('pop_id' => $material_received_prod->rnp_purchase_prod_id));
            
            $new_delivery_qty = $purchase_order_product->pop_delivered_order -  $material_received_prod->rnp_current_delivery;
            
            $this->common_model->EditData(array('pop_delivered_order'=>$new_delivery_qty,'pop_delivered_status'=>0), array('pop_id' => $material_received_prod->rnp_purchase_prod_id), 'pro_purchase_order_product');
            
            $this->common_model->DeleteData('pro_material_received_note_prod',array('rnp_material_received_note' =>$material_received_prod->rnp_material_received_note)); 
        }

        if(!empty($material_received_note->mrn_file))
        {
            $previousImagePath = 'uploads/MaterialReceived/' .$material_received_note->mrn_file;
            
                if (file_exists($previousImagePath)) {
                    unlink($previousImagePath);
                }
        }

        $this->common_model->DeleteData('pro_material_received_note',$cond); 
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
