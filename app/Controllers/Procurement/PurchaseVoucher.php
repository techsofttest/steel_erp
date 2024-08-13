<?php

namespace App\Controllers\Procurement;

use App\Controllers\BaseController;


class PurchaseVoucher extends BaseController
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
       
        $totalRecords = $this->common_model->GetTotalRecords('pro_purchase_voucher','pv_id','DESC');
        
        
        ## Total number of records with filtering
       
        $searchColumns = array('pv_reffer_id');

        $totalRecordwithFilter = $this->common_model->GetTotalRecordwithFilter('pro_purchase_voucher','pv_id',$searchValue,$searchColumns);
    
        ##Joins if any //Pass Joins as Multi dim array
        $joins = array(
            
           
        );
        ## Fetch records
        $records = $this->common_model->GetRecord('pro_purchase_voucher','pv_id',$searchValue,$searchColumns,$columnName,$columnSortOrder,$joins,$rowperpage,$start);
        
        

        $data = array();

        $i=1;
        foreach($records as $record ){
            $action = '<a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->pv_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a><a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->pv_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> Delete</a><a  href="javascript:void(0)" data-id="'.$record->pv_id.'"  class="view view-color view_btn" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a>';
           
           $data[] = array( 
              "pv_id"             => $i,
              'pv_reffer_id'      => $record->pv_reffer_id,
              'pv_purchase_order' => $record->pv_purchase_order,
              'pv_date'           => date('d-m-Y',strtotime($record->pv_date)),
              "action"            => $action,
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
        $data['material_received']   = $this->common_model->FetchAllOrder('pro_material_received_note','mrn_id','desc');       

        $data['content'] = view('procurement/purchase-voucher',$data);

        return view('procurement/pro-module',$data);

    }


    // add account head
    Public function Add()
    {   
        
        if(empty($this->request->getPost('purchase_voucher_id')))
        {
            $insert_data = [

                'pv_reffer_id'       => $this->request->getPost('purchase_reffer_no'),

                'pv_date'            => date('Y-m-d',strtotime($this->request->getPost('purchase_date'))),

                'pv_vendor_name'     => $this->request->getPost('purchase_vendor_name'),

                'pv_contact_person'  => $this->request->getPost('purchase_contact_person'),

                'pv_mrn'             => $this->request->getPost('pruchase_mrn'),

                'pv_purchase_order'  => $this->request->getPost('purchase_order'),

                'pv_vendor_inv'      => $this->request->getPost('purchase_vendor'),

                'pv_delivery_note'   => $this->request->getPost('purchase_delivery_note'),

                'pv_payment_term'    => $this->request->getPost('purchase_payment_term'),

                'pv_added_by'        => 0,

                'pv_added_date'      => date('Y-m-d'),

            ];

           

            $purchase_voucher = $this->common_model->InsertData('pro_purchase_voucher',$insert_data);

            $data['purchase_voucher_id'] = $purchase_voucher;

            $this->common_model->singleRow('pro_material_received_note',array('mrn_id' => $purchase_voucher));

            /*$material_received = $this->common_model->SingleRow('pro_material_received_note',array('mrn_id' => $material_received_id));

            $data['purchase_id'] =  $material_received->mrn_purchase_order;

            $data['mrn_recived_id'] =  $material_received_id;*/

           
        }
        else
        {   
            $updated_data = [

                'pv_reffer_id'       => $this->request->getPost('purchase_reffer_no'),

                'pv_date'            => date('Y-m-d',strtotime($this->request->getPost('purchase_date'))),

                'pv_vendor_name'     => $this->request->getPost('purchase_vendor_name'),

                'pv_contact_person'  => $this->request->getPost('purchase_contact_person'),

                'pv_mrn'             => $this->request->getPost('pruchase_mrn'),

                'pv_purchase_order'  => $this->request->getPost('purchase_order'),

                'pv_vendor_inv'      => $this->request->getPost('purchase_vendor'),

                'pv_delivery_note'   => $this->request->getPost('purchase_delivery_note'),

                'pv_payment_term'    => $this->request->getPost('purchase_payment_term'),

                'pv_added_by'        => 0,

                'pv_added_date'      => date('Y-m-d'),


            ];

            
            $this->common_model->EditData($updated_data, array('pv_id' => $this->request->getPost('purchase_voucher_id')),'pro_purchase_voucher');
            
            if(!empty($_POST['pvp_discount']))
		    {    
                
                $count =  count($_POST['pvp_discount']);
                
                if($count!=0)
                {  
                
                    for($j=0;$j<=$count-1;$j++)
                    {
                        
                        $insert_data  	= array(  
                            
                            'pvp_sales_order'  =>  $_POST['pvp_sales_order'][$j],
                            'pvp_prod_dec'     =>  $_POST['pvp_product_desc'][$j],
                            'pvp_debit'        =>  $_POST['debit_account'][$j],
                            'pvp_qty'          =>  $_POST['pvp_qty'][$j],
                            'pvp_unit'         =>  $_POST['pvp_unit'][$j],
                            'pvp_rate'         =>  $_POST['pvp_rate'][$j],
                            'pvp_discount'     =>  $_POST['pvp_discount'][$j],
                            'pvp_amount'       =>  $_POST['pvp_amount'][$j],
                            'pvp_reffer_id'    =>  $this->request->getPost('purchase_voucher_id'),
                        );

                        
                        $this->common_model->InsertData('pro_purchase_voucher_prod',$insert_data);

                        
                        
                    } 
                }
      
		    }
            

            $data['purchase_id'] = "";

            $data['mrn_reff_id'] = "";
  
        }


        $data['purchase_order'] = $this->request->getPost('purchase_order');

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
    
        $uid = $this->common_model->FetchNextId('pro_purchase_voucher',"PV");
    
        echo $uid;
    
    }


    public function FetchProduct()
    {   
       
        $purchase_order = $this->common_model->SingleRow('pro_purchase_order',array('po_reffer_no' => $this->request->getPost('ID')));
 
       /* $joins = array(
            
            array(
                'table' => 'crm_products',
                'pk'    => 'product_id',
                'fk'    => 'rnp_product_desc',
            ),
           

        );*/

        //$products = $this->common_model->FetchWhereJoin('pro_purchase_order_product',array('pop_purchase_order' => $purchase_order->po_id),$joins);
        
        $purchase_order = $this->common_model->SingleRow('pro_purchase_order_product',array('pop_purchase_order' => $purchase_order->po_id));
        
       // $purchase_order = $this->common_model->SingleRow('pro_purchase_order_product',array('pop_purchase_order' => $purchase_order->pop_purchase_order));
        
       
        $products = $this->common_model->FetchWhere('pro_material_received_note_prod',array('rnp_purchase_id' => $purchase_order->pop_purchase_order));

        

        $i = 1; 
        
        $data['product_detail'] ="";

        foreach($products as $prod){

            $data['product_detail'] .='<tr class="" id="'.$prod->rnp_id.'">
                                            
                                            <td class="si_no">'.$i.'</td>
                                            <td><input type="text" name="dpd_prod_det[]" value="'.$prod->rnp_product_desc.'" class="form-control"  readonly></td>
                                            <td><input type="text" name="dpd_unit[]" value="'.$prod->rnp_unit.'" class="form-control" readonly></td>
                                            <td><input type="number" name="dpd_order_qty[]" value="'.$prod->rnp_current_delivery.'"  class="form-control order_qty" readonly></td>
                                            <td><input type="checkbox" name="product_select[]" id="'.$prod->rnp_id.'"  onclick="handleCheckboxChange(this)" class="prod_checkmark"></td>
                                          
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
            $cond = array('rnp_id' => $number);

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

            //$products = $this->common_model->FetchWhereJoin('pro_purchase_order_product',$cond,$joins1);

            $products = $this->common_model->FetchWhere('pro_material_received_note_prod',$cond);

            $debit_accounts = $this->common_model->FetchAllOrder('accounts_charts_of_accounts','ca_id','desc');    

            
            foreach($products as $product){

                $data['product_detail'] .='<tr class="add_prod_row add_prod_remove" id="'.$product->rnp_id.'">
                                            <td class="si_no">'.$i.'</td>
                                            <td><input type="text" name="pvp_sales_order[]" value="'.$product->rnp_sales_order.'" class="form-control" readonly></td>
                                            <td><input type="text" name="pvp_product_desc[]" value="'.$product->rnp_product_desc.'" class="form-control" readonly></td>
                                            <td>
                                               <select class="form-select" name="debit_account" required>
                                                   <option value="" selected disabled>Select Debit</option>';
                                                   foreach($debit_accounts as $debit_account){

                                                      $data['product_detail'] .='<option value="'.$debit_account->ca_id .'">'.$debit_account->ca_name.'</option>';

                                                   }
                        $data['product_detail'] .='</select>
                                            </td>
                                            <td><input type="number" name="pvp_qty[]" value="'.$product->rnp_current_delivery.'"  class="form-control add_prod_qty" readonly required></td>
                                            <td><input type="text" name="pvp_unit[]" value="'.$product->rnp_unit.'" class="form-control" required readonly></td>
                                            <td><input type="text" name="pvp_rate[]" value="'.$product->rnp_amount.'"  class="form-control add_prod_rate" required ></td>
                                            <td><input type="text" name="pvp_discount[]" value=""  class="form-control add_discount" required ></td>
                                            <td><input type="text" name="pvp_amount[]" value="'.$product->rnp_amount.'"  class="form-control add_prod_amount" required readonly></td>
                                           
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


   
 

}
