<?php

namespace App\Controllers\Procurement;

use App\Controllers\BaseController;


class PurchaseReturn extends BaseController
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
       
        $totalRecords = $this->common_model->GetTotalRecords('pro_purchase_return','pr_id','DESC');
        
        
        ## Total number of records with filtering
       
        $searchColumns = array('pr_reffer_id');

        $totalRecordwithFilter = $this->common_model->GetTotalRecordwithFilter('pro_purchase_return','pr_id',$searchValue,$searchColumns);
    
        ##Joins if any //Pass Joins as Multi dim array
        $joins = array(
            
            array(
                'table' => 'pro_vendor',
                'pk'    => 'ven_id',
                'fk'    => 'pr_vendor_name',
            ),
           
        );
        ## Fetch records
        $records = $this->common_model->GetRecord('pro_purchase_return','pr_id',$searchValue,$searchColumns,$columnName,$columnSortOrder,$joins,$rowperpage,$start);
        
        

        $data = array();

        $i=1;
        foreach($records as $record ){
            $action = '<a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->pr_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a><a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->pr_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> Delete</a><a  href="javascript:void(0)" data-id="'.$record->pr_id.'"  class="view view-color view_btn" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a>';
           
           $data[] = array( 
              "pr_id"          => $i,
              'pr_reffer_id'   => $record->pr_reffer_id,
              'pr_vendor_name' => $record->ven_name,
              'pr_date'        => date('d-m-Y',strtotime($record->pr_date)),
              "action"         => $action,
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

        $data['content'] = view('procurement/purchase-return',$data);

        return view('procurement/pro-module',$data);

    }


    // add account head
    Public function Add()
    {   
        
        
        if(empty($this->request->getPost('pr_id')))
        {   
            $uid = $this->common_model->FetchNextId('pro_purchase_return',"PR");
             
            $insert_data = [

                'pr_reffer_id'       => $uid,

                'pr_date'            => date('Y-m-d',strtotime($this->request->getPost('pr_date'))),

                'pr_vendor_name'     => $this->request->getPost('pr_vendor_name'),

                'pr_vendor_inv'      => $this->request->getPost('pr_vendor_inv'),

                'pr_lpo'             => $this->request->getPost('pr_lpo'),

                'pr_contact_person'  => $this->request->getPost('pr_contact_person'),

                'pr_payment_term'    => $this->request->getPost('pr_payment_term'),

                'pr_added_by'        => 0,

                'pr_added_date'      => date('Y-m-d'),

            ];


            $purchase_return = $this->common_model->InsertData('pro_purchase_return',$insert_data);

            $data['purchase_return_id'] = $purchase_return;

            $data['vendor_inv_ref'] = $this->request->getPost('pr_vendor_inv');

            $data['vendor_id'] = $this->request->getPost('pr_vendor_name');

            
           
        }
        else
        {   
            $updated_data = [

               
               'pr_date'            => date('Y-m-d',strtotime($this->request->getPost('pr_date'))),

                'pr_vendor_name'     => $this->request->getPost('pr_vendor_name'),

                'pr_vendor_inv'      => $this->request->getPost('pr_vendor_inv'),

                'pr_lpo'             => $this->request->getPost('pr_lpo'),

                'pr_contact_person'  => $this->request->getPost('pr_contact_person'),

                'pr_payment_term'    => $this->request->getPost('pr_payment_term'),

                'pr_added_by'        => 0,

                'pr_added_date'      => date('Y-m-d'),


            ];

            
            $this->common_model->EditData($updated_data, array('pr_id' => $this->request->getPost('pr_id')),'pro_purchase_return');
            
            if(!empty($_POST['prp_sales_order']))
		    {    
                
                $count =  count($_POST['prp_sales_order']);
                
                if($count!=0)
                {  
                
                    for($j=0;$j<=$count-1;$j++)
                    {
                        
                        $insert_data  	= array(  
                            
                            'prp_sales_order'         =>  $_POST['prp_sales_order'][$j],
                            'prp_prod_desc'           =>  $_POST['prp_prod_desc'][$j],
                            'prp_debit'               =>  $_POST['prp_debit'][$j],
                            'prp_qty'                 =>  $_POST['prp_qty'][$j],
                            'prp_unit'                =>  $_POST['prp_unit'][$j],
                            'prp_rate'                =>  $_POST['prp_rate'][$j],
                            'prp_discount'            =>  $_POST['prp_discount'][$j],
                            'prp_amount'              =>  $_POST['prp_amount'][$j],
                            'prp_purchase_return_id'  =>  $this->request->getPost('pr_id'),
                        );

                        
                        $id = $this->common_model->InsertData('pro_purchase_return_prod',$insert_data);

                        $purchase_return_prod = $this->common_model->SingleRow('pro_purchase_return_prod',array('prp_id' => $id));
                        
                        $data['purchase_id'] = $purchase_return_prod->prp_purchase_return_id;

                        $purchase_return = $this->common_model->SingleRow('pro_purchase_return',array('pr_id' => $purchase_return_prod->prp_purchase_return_id));
                        
                        $this->common_model->EditData(array('pr_id' => $purchase_return_prod->prp_purchase_return_id), array('pr_total_amount' => $_POST['pr_total_amount']),'pro_purchase_return');
            
                        $data['vendor_id'] = $purchase_return->pr_vendor_name;
                        
                        $data['mrn_reff_id'] = "";
  

                        

                        
                    } 
                }
      
		    }
            

            
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
        $new_amount = 0;
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
            
            $j = 1;
            foreach($products as $product){

                $data['product_detail'] .='<tr class="add_prod_row add_prod_remove" id="'.$product->pvp_id.'">
                                            <td class="si_no">'.$j.'</td>
                                            <td><input type="text" name="prp_sales_order[]" value="'.$product->pvp_sales_order.'" class="form-control" readonly></td>
                                            <td><input type="text" name="prp_prod_desc[]" value="'.$product->pvp_prod_dec.'" class="form-control" readonly></td>
                                            <td><input type="text" name="prp_debit[]" value="'.$product->ca_name.'" class="form-control" readonly></td>
                                            <td><input type="number" name="prp_qty[]" value="'.$product->pvp_qty.'"  class="form-control add_prod_qty" readonly required></td>
                                            <td><input type="text" name="prp_unit[]" value="'.$product->pvp_unit.'" class="form-control" required readonly></td>
                                            <td><input type="text" name="prp_rate[]" value="'.$product->pvp_rate.'"  class="form-control add_prod_rate" required readonly></td>
                                            <td><input type="text" name="prp_discount[]" value="'.$product->pvp_discount.'"  class="form-control add_discount" required readonly></td>
                                            <td><input type="text" name="prp_amount[]" value="'.$product->pvp_amount.'"  class="form-control add_prod_amount" required readonly></td>
                                           
                                        </tr>';
 
                                    
                                     $j++;

                    $new_amount =    $new_amount += $product->pvp_amount;   
                    
                    //echo $new_amount."<br>"; 
                    
                                    
            }
            
           // echo $new_amount;
            
            //exit();
           
            $data['total_amount'] = $new_amount;

       
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
        $vendor_id  = $this->request->getPost('ID');

        $purchase_vouchers = $this->common_model->FetchWhere('pro_purchase_voucher',array('pv_vendor_name' => $vendor_id));
        $i=1;

        $data['product_detail'] = "";
        
        foreach($purchase_vouchers as $purchase_voucher)
        {
            
            $data['product_detail'] .='<tr class="" id="'.$purchase_voucher->pv_id.'">
                                            <td class="si_no">'.$i.'</td>
                                            <td><input type="text" name="" value="'.$purchase_voucher->pv_date.'" class="form-control"  readonly></td>
                                            <td><input type="text" name="" value="'.$purchase_voucher->pv_reffer_id.'" class="form-control" readonly></td>
                                            <td><input type="number" name="" value="6230"  class="form-control" readonly></td>
                                            <td><input type="number" name="" value="'.$purchase_voucher->pv_total.'"  class="form-control" readonly></td>
                                            <td><input type="checkbox" name=""  onclick="handleCheckboxChange(this)" class="prod_checkmark"></td>
                                        
                                        </tr>';
            $i++;
        }
        
        echo json_encode($data);
    }


    public function View()
    {
        $join =  array(
            
            array(
                'table' => 'pro_vendor',
                'pk'    => 'ven_id',
                'fk'    => 'pr_vendor_name',
            ),
            array(
                'table' => 'pro_purchase_voucher',
                'pk'    => 'pv_id',
                'fk'    => 'pr_vendor_inv',
            ),

        );


        $purchase_return = $this->common_model->SingleRowJoin('pro_purchase_return', array('pr_id' => $this->request->getPost('ID')),$join);
        
        
        $data['reffer_id']      = $purchase_return->pr_reffer_id;

        $data['date']           = date('d-M-Y',strtotime($purchase_return->pr_date));

        $data['vendor_name']    = $purchase_return->ven_name;

        $data['vendor_inv']     = $purchase_return->pv_vendor_inv;

        $data['lpo']            = $purchase_return->pr_lpo;

        $data['contact_person'] = $purchase_return->pr_contact_person;

        $data['payment_term']   = $purchase_return->pr_payment_term;

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

        //$purchase_order_product = $this->common_model->FetchWhereJoin('pro_purchase_return_prod',array('prp_purchase_return_id' => $this->request->getPost('ID')),$join);
        
        $purchase_return_prod = $this->common_model->FetchWhere('pro_purchase_return_prod',array('prp_purchase_return_id' => $this->request->getPost('ID')));
        
        $i=1;

        $data['purchase_return'] = '';

        foreach($purchase_return_prod as $pur_return_prod)
        {
            $data['purchase_return'] .= '<tr class="edit_prod_row" id="'.$pur_return_prod->prp_id.'">
            <td class="si_no1">'.$i.'</td>
            <td><input type="text" name=""  value="'.$pur_return_prod->prp_sales_order.'" class="form-control" readonly></td>
            <td><input type="text" name=""  value="'.$pur_return_prod->prp_prod_desc.'" class="form-control" readonly></td>
            <td> <input type="text" name="" value="'.$pur_return_prod->prp_debit.'" class="form-control" readonly></td>
            <td> <input type="text" name="" value="'.$pur_return_prod->prp_qty.'" class="form-control" readonly></td>
            <td> <input type="text" name="" value="'.$pur_return_prod->prp_unit.'" class="form-control" readonly></td>
            <td> <input type="text" name="" value="'.$pur_return_prod->prp_rate.'" class="form-control" readonly></td>
            <td> <input type="text" name="" value="'.$pur_return_prod->prp_discount.'" class="form-control" readonly></td>
            <td> <input type="text" name="" value="'.$pur_return_prod->prp_amount.'" class="form-control" readonly></td>
            </tr>
            ';
            $i++; 
        }


        echo json_encode($data);


    }
 

}
