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
            
            array(
                'table' => 'pro_purchase_order',
                'pk'    => 'po_id',
                'fk'    => 'pv_purchase_order',
            ),

           
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
              'pv_purchase_order' => $record->po_reffer_no,
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
        $data['sales_orders']   = $this->common_model->FetchAllOrder('crm_sales_orders','so_id','desc');   

        $data['debit_accounts'] = $this->common_model->FetchAllOrder('accounts_charts_of_accounts','ca_id','desc');    

        $data['products'] = $this->common_model->FetchAllOrder('crm_products','product_id','desc');    
            
        $data['products'] = $this->common_model->FetchAllOrder('crm_products','product_id','desc');
        
        $join =  array(
            
            array(
                'table' => 'pro_purchase_order',
                'pk'    => 'po_id',
                'fk'    => 'mrn_purchase_order',
            ),

         
        );

        //$data['material_received']   = $this->pro_model->FetchAllOrderJoin('pro_material_received_note','mrn_id','desc',$join,'mrn_purchase_order',array('mrn_status' => 0));   
        
       // $data['material_received']   = $this->pro_model->PurchaseVoucher('pro_material_received_note',$join); 

       
        
        $data['content'] = view('procurement/purchase-voucher',$data);

        return view('procurement/pro-module',$data);

    }


    // add account head
    Public function Add()
    {   
        

        $purchase_order = "";

        if(empty($this->request->getPost('purchase_voucher_id')))
        {   
            //$uid = $this->common_model->FetchNextId('pro_purchase_voucher',"PV");

            $uid = $this->FetchReference("r");

            if(!empty($this->request->getPost('purchase_order')))
            {
                $purchase_order = $this->request->getPost('purchase_order');
            }
            else
            {
                $purchase_order = "";
            }

            $insert_data = [

                'pv_reffer_id'       => $uid,

                'pv_date'            => date('Y-m-d',strtotime($this->request->getPost('purchase_date'))),

                'pv_vendor_name'     => $this->request->getPost('purchase_vendor_name'),

                'pv_contact_person'  => $this->request->getPost('purchase_contact_person'),

                'pv_purchase_order'  => $purchase_order,

                'pv_vendor_inv'      => $this->request->getPost('purchase_vendor'),

                'pv_delivery_note'   => $this->request->getPost('purchase_delivery_note'),

                'pv_payment_term'    => $this->request->getPost('purchase_payment_term'),

                'pv_total'           => $this->request->getPost('total_vou_amount'),
                
                'pv_added_by'        => 0,

                'pv_added_date'      => date('Y-m-d'),

            ];

           

            $purchase_voucher = $this->common_model->InsertData('pro_purchase_voucher',$insert_data);

            $data['purchase_voucher_id'] = $purchase_voucher;

            $this->common_model->SingleRow('pro_material_received_note',array('mrn_id' => $purchase_voucher));

            $data['purchase_order'] = $purchase_order;

            /*$material_received = $this->common_model->SingleRow('pro_material_received_note',array('mrn_id' => $material_received_id));

            $data['purchase_id'] =  $material_received->mrn_purchase_order;

            $data['mrn_recived_id'] =  $material_received_id;*/


            // add product

            if(!empty($_POST['pvp_discount']))
		    {    
                
                $count =  count($_POST['pvp_discount']);
                
                if($count!=0)
                {  
                
                    for($j=0;$j<=$count-1;$j++)
                    {
                        if(!empty($_POST['pvp_sales_order'][$j])){

                            $sales_data = $_POST['pvp_sales_order'][$j];
                        } 
                        else{

                            $sales_data = "";
                        }

                        $insert_data2 = array(                              
                            
                            'pvp_sales_order'          =>  $sales_data,
                            'pvp_prod_dec'             =>  $_POST['pvp_product_desc'][$j],
                            'pvp_debit'                =>  $_POST['debit_account'][$j],
                            'pvp_qty'                  =>  $_POST['pvp_qty'][$j],
                            'pvp_unit'                 =>  $_POST['pvp_unit'][$j],
                            'pvp_rate'                 =>  $_POST['pvp_rate'][$j],
                            'pvp_discount'             =>  $_POST['pvp_discount'][$j],
                            'pvp_amount'               =>  $_POST['pvp_amount'][$j],
                            'pvp_reffer_id'            =>  $purchase_voucher,
                        );
                        
                        $prodID = $this->common_model->InsertData('pro_purchase_voucher_prod',$insert_data2);
                        
                        
                        
                        
                    } 
                }
      
		    }

           
        }

        else
        {   
            $updated_data = [

              

                'pv_date'            => date('Y-m-d',strtotime($this->request->getPost('purchase_date'))),

                'pv_vendor_name'     => $this->request->getPost('purchase_vendor_name'),

                'pv_contact_person'  => $this->request->getPost('purchase_contact_person'),

                'pv_purchase_order'  => $purchase_order = $this->request->getPost('purchase_order'),

                'pv_vendor_inv'      => $this->request->getPost('purchase_vendor'),

                'pv_delivery_note'   => $this->request->getPost('purchase_delivery_note'),

                'pv_payment_term'    => $this->request->getPost('purchase_payment_term'),

                'pv_total'           => $this->request->getPost('total_vou_amount'),

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
                        
                        $insert_data4 = array(                              
                            
                            'pvp_sales_order'          =>  $_POST['pvp_sales_order'][$j],
                            'pvp_prod_dec'             =>  $_POST['pvp_product_desc'][$j],
                            'pvp_debit'                =>  $_POST['debit_account'][$j],
                            'pvp_qty'                  =>  $_POST['pvp_qty'][$j],
                            'pvp_unit'                 =>  $_POST['pvp_unit'][$j],
                            'pvp_rate'                 =>  $_POST['pvp_rate'][$j],
                            'pvp_discount'             =>  $_POST['pvp_discount'][$j],
                            'pvp_amount'               =>  $_POST['pvp_amount'][$j],
                            'pvp_mat_rec_note_prod_id' =>  $_POST['rnp_id'][$j],
                            'pvp_mat_rec_id'           =>  $_POST['material_received_id'][$j],
                            'pvp_reffer_id'            =>  $this->request->getPost('purchase_voucher_id'),
                        );

                        
                        
                        $prodID = $this->common_model->InsertData('pro_purchase_voucher_prod',$insert_data4);
                        
                        $this->common_model->EditData(array('rnp_status' => 1), array('rnp_id' => $_POST['rnp_id'][$j]), 'pro_material_received_note_prod');

                        $material_req_prod_single = $this->common_model->SingleRow('pro_material_received_note_prod',array('rnp_material_received_note' => $_POST['material_received_id'][$j]));
                        
                        $material_req_prod1 = $this->common_model->FetchWhere('pro_material_received_note_prod' ,array('rnp_material_received_note' => $_POST['material_received_id'][$j]));
                        
                        $material_req_prod2 = $this->common_model->FetchSalesOrder('pro_material_received_note_prod' ,array('rnp_material_received_note' => $_POST['material_received_id'][$j]),array('rnp_status' => 1));
                        
                        if(count($material_req_prod1) == count($material_req_prod2)){
                          
                            $this->common_model->EditData(array('mrn_status' => 1), array('mrn_id' =>$_POST['material_received_id'][$j]), 'pro_material_received_note');
                        }

                        /*$material_req_prod3 = $this->common_model->FetchWhere('pro_material_received_note_prod' ,array('rnp_purchase_id' => $material_req_prod_single->rnp_purchase_id));

                        $material_req_prod4 = $this->common_model->CheckTwiceCond1('pro_material_received_note_prod' ,array('rnp_purchase_id' => $material_req_prod_single->rnp_purchase_id),array('rnp_status' => 1));
                        
                        if(count($material_req_prod3) == count($material_req_prod4))
                        {
                            $this->common_model->EditData(array('po_voucher_status' => 1), array('po_id' =>$material_req_prod_single->rnp_purchase_id), 'pro_purchase_order');
                        }*/
                        
                        
                    } 
                }
      
		    }
           

            $data['purchase_id'] = "";

            $data['mrn_reff_id'] = "";

            $data['purchase_order'] = "";
  
        }


        //$data['purchase_order'] = $this->request->getPost('purchase_order');

        //$purchase_order_row = $this->common_model->SingleRow('');

        $purchase_order_joins =array(

            array(
            
            'table' =>'pro_purchase_order',

            'pk' => 'po_id',

            'fk' => 'pa_purchase_order',

            )
            ,
            array(

            'table' => 'accounts_payment_debit',

            'pk' => 'pd_id',

            'fk' => 'pa_debit_id',

            ),

            array(

            'table' => 'accounts_payments',

            'pk' => 'pay_id',

            'table2' => 'accounts_payment_debit',

            'fk' => 'pd_payment',

            ),

        );

        $purchase_order_row = $this->common_model->FetchWhereJoin('accounts_payment_advances',array('pa_purchase_order' => $purchase_order),$purchase_order_joins);


        if(!empty($purchase_order_row))
        {

        $data['po_advance_status'] = true;

        $data['po_advance_row'] ="";

        $p=1;

        foreach($purchase_order_row as $p_o_r)
        {

            $data['po_advance_row'] .='
            
            <tr>

            <input type="hidden" name="po_advance_id[]" value="'.$p_o_r->pa_id.'">

            <input type="hidden" name="pv_id[]" value="'.$purchase_voucher.'">

            <td>'.$p++.'</td>
            
            <td>
            
            '.date("d-F-Y",strtotime($p_o_r->pay_date)).'
            
            </td>

            <td>'.$p_o_r->pay_ref_no.'</td>

            <td>'.format_currency($p_o_r->pa_advance_amount).'</td>

            <!--<td><input type="number" step="0.01" class="form-control" name="po_adjust_amount[]"></td>-->

            </tr>
            
            ';


        }


        }

        else
        {

        $data['po_advance_status'] = false;

        }


        echo json_encode($data);
  

    }





    //Add ADVANCE 


    public function AddAdvance()
    {

        if($_POST){


            for($i=0;$i<count($_POST['po_advance_id']);$i++)
            {

                $insert_data['pva_pv_id'] = $_POST['pv_id'][$i];

                $insert_data['pva_pay_advance_id'] = $_POST['po_advance_id'][$i];

                $insert_data['pva_amount'] = $_POST['po_adjust_amount'][$i];

                

                $check_advance = $this->common_model->SingleRow('pro_purchase_voucher',array('pva_pay_advance_id'=> $insert_data['pva_pay_advance_id'],'pva_pv_id' =>$insert_data['pva_pv_id']));

                if(empty($check_advance))
                {

                $this->common_model->InsertData('pro_purchase_voucher_adjusted',$insert_data);

                }
                else
                {
                
                $this->common_model->EditData(array('pva_id' => $check_advance->pva_id),$insert_data,'pro_purchase_voucher_adjusted');

                }
            

            }


        }

    }




    public function View(){
        
        $join =  array(
            
            array(
                'table' => 'pro_vendor',
                'pk'    => 'ven_id',
                'fk'    => 'pv_vendor_name',
            ),

           

            array(
                'table' => 'pro_purchase_order',
                'pk'    => 'po_id',
                'fk'    => 'pv_purchase_order',
            ),

            array(
                'table' => 'pro_contact',
                'pk'    => 'pro_con_id',
                'fk'    => 'pv_contact_person',
            ),


        );
        
        $purchase_voucher = $this->common_model->SingleRowJoin('pro_purchase_voucher', array('pv_id' => $this->request->getPost('ID')),$join);
        
        $data['reffer_id']       = $purchase_voucher->pv_reffer_id;

        $data['date']            = $purchase_voucher->pv_date;

        $data['vendor_name']     = $purchase_voucher->ven_name;

        $data['contact_person']  = $purchase_voucher->pro_con_person;

        $data['purchase_order']  = $purchase_voucher->po_reffer_no;

        $data['vendor_inv']      = $purchase_voucher->pv_vendor_inv;

        $data['delivery_note']   = $purchase_voucher->pv_delivery_note;

        $data['payment_term']    = $purchase_voucher->pv_payment_term;

        $data['total_amount']    = $purchase_voucher->pv_total;

        

        $join1 =  array(
            
            array(
                'table' => 'accounts_charts_of_accounts',
                'pk'    => 'ca_id',
                'fk'    => 'pvp_debit',
            ),


        );
        
        $purchase_voucher_product = $this->common_model->FetchWhereJoin('pro_purchase_voucher_prod',array('pvp_reffer_id' => $this->request->getPost('ID')),$join1);

        $i=1;

        $data['prod_desc'] = '';

        foreach($purchase_voucher_product as $pur_vou_prod)
        {
            $data['prod_desc'] .= '<tr class="edit_prod_row" id="'.$pur_vou_prod->pvp_id.'">
            <td class="si_no1">'.$i.'</td>
            <td><input type="text" name=""  value="'.$pur_vou_prod->pvp_sales_order.'" class="form-control" readonly></td>
            <td style="width:30%"><input type="text" name=""  value="'.$pur_vou_prod->pvp_prod_dec.'" class="form-control" readonly></td>
            <td> <input type="text" name="" value="'.$pur_vou_prod->ca_name.'" class="form-control" readonly></td>
            <td style="width:7%"> <input type="text" name="" value="'.$pur_vou_prod->pvp_qty.'" class="form-control" readonly></td>
            <td> <input type="text" name="" value="'.$pur_vou_prod->pvp_unit.'" class="form-control" readonly></td>
            <td> <input type="text" name="" value="'.$pur_vou_prod->pvp_rate.'" class="form-control" readonly></td>
            <td> <input type="text" name="" value="'.$pur_vou_prod->pvp_discount.'" class="form-control" readonly></td>
            <td> <input type="text" name="" value="'.$pur_vou_prod->pvp_amount.'" class="form-control" readonly></td>
            </tr>
            ';
            $i++; 
        }



        echo json_encode($data);
    }


    public function Edit()
    {
        $join =  array(
            
            array(
                'table' => 'pro_vendor',
                'pk'    => 'ven_id',
                'fk'    => 'pv_vendor_name',
            ),

            array(
                'table' => 'pro_purchase_order',
                'pk'    => 'po_id',
                'fk'    => 'pv_purchase_order',
            ),

            array(
                'table' => 'pro_contact',
                'pk'    => 'pro_con_id',
                'fk'    => 'pv_contact_person',
            ),

        );
        
        $purchase_voucher = $this->common_model->SingleRowJoin('pro_purchase_voucher', array('pv_id' => $this->request->getPost('ID')),$join);
        
        $data['reffer_id']       = $purchase_voucher->pv_reffer_id;

        $data['date']            = date('d-M-Y',strtotime($purchase_voucher->pv_date));

        $data['vendor_name']     = $purchase_voucher->ven_name;

        $data['contact_person']  = $purchase_voucher->pro_con_person;

        $data['purchase_order']  = $purchase_voucher->po_reffer_no;

        $data['vendor_inv']      = $purchase_voucher->pv_vendor_inv;

        $data['delivery_note']   = $purchase_voucher->pv_delivery_note;

        $data['payment_term']    = $purchase_voucher->pv_payment_term;

        $data['purchase_id']     = $purchase_voucher->pv_id;

        $data['total_amount']     = $purchase_voucher->pv_total;
        
        
        $join1 =  array(
            
            array(
                'table' => 'accounts_charts_of_accounts',
                'pk'    => 'ca_id',
                'fk'    => 'pvp_debit',
            ),


        );
        
        $purchase_voucher_product = $this->common_model->FetchWhereJoin('pro_purchase_voucher_prod',array('pvp_reffer_id' => $this->request->getPost('ID')),$join1);


        $i=1;

        $data['prod_desc'] = '';

        foreach($purchase_voucher_product as $pur_vou_prod)
        {
            $data['prod_desc'] .= '<tr class="edit_prod_row" id="'.$pur_vou_prod->pvp_id.'">
            <td><input type="text" name=""  value="'.$pur_vou_prod->pvp_sales_order.'" class="form-control" readonly></td>
            <td style="width:30%"><input type="text" name=""  value="'.$pur_vou_prod->pvp_prod_dec.'" class="form-control" readonly></td>
            <td> <input type="text" name="" value="'.$pur_vou_prod->ca_name.'" class="form-control" readonly></td>
            <td> <input type="text" name="" value="'.$pur_vou_prod->pvp_qty.'" class="form-control" readonly></td>
            <td> <input type="text" name="" value="'.$pur_vou_prod->pvp_unit.'" class="form-control" readonly></td>
            <td> <input type="text" name="" value="'.$pur_vou_prod->pvp_rate.'" class="form-control" readonly></td>
            <td> <input type="text" name="" value="'.$pur_vou_prod->pvp_discount.'" class="form-control" readonly></td>
            <td> <input type="text" name="" value="'.$pur_vou_prod->pvp_amount.'" class="form-control" readonly></td>
            <td style="width:0%"><a href="javascript:void(0)" style="display:none" class="delete delete-color product_delete_data" data-id="'.$pur_vou_prod->pvp_id.'" data-toggle="tooltip" data-placement="top" title="Delete"><i class="ri-delete-bin-fill"></i> Delete</a></td>
            </tr>
            ';
            $i++; 
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
        
        //payment term
        $vendor = $this->common_model->SingleRow('pro_vendor',array('ven_id' => $this->request->getPost('ID')));
        
        $data['payment_term'] = $vendor->ven_credit_term;
       

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


    


    


    public function FetchReference($type="e")
    {

        $uid = $this->common_model->FetchNextId('pro_purchase_voucher',"PV-{$this->data['accounting_year']}-");

        if($type=="e")
            echo $uid;
        else
        {
            return $uid;
        }

    }
	


    public function FetchProduct()
    {   
        
        $purchase_order = $this->common_model->SingleRow('pro_purchase_order',array('po_id' => $this->request->getPost('ID')));
        
        
       /* $joins = array(
            
            array(
                'table' => 'crm_products',
                'pk'    => 'product_id',
                'fk'    => 'rnp_product_desc',
            ),
           

        );*/

        //$products = $this->common_model->FetchWhereJoin('pro_purchase_order_product',array('pop_purchase_order' => $purchase_order->po_id),$joins);
        
      
       // $purchase_order = $this->common_model->SingleRow('pro_purchase_order_product',array('pop_purchase_order' => $purchase_order->pop_purchase_order));
        
       
        //$products = $this->common_model->FetchWhere('pro_material_received_note_prod',array('rnp_purchase_id' => $purchase_order->pop_purchase_order));
        
        //$purchase_order = $this->common_model->SingleRow('pro_purchase_order_product',array('pop_purchase_order' => $purchase_order->po_id));
        
        
        //$products = $this->common_model->FetchSalesOrder('pro_material_received_note_prod',array('rnp_purchase_id' => $purchase_order->pop_purchase_order),array('rnp_status' => 0));
        

        $joins = array(
            
            array(
                'table' => 'pro_material_received_note_prod',
                'pk'    => 'rnp_material_received_note',
                'fk'    => 'mrn_id',
            ),
           

        );

        $products = $this->common_model->TwiceCondWithJoin('pro_material_received_note',array('mrn_purchase_order' => $purchase_order->po_id),array('rnp_status' => 0),$joins);
        

        $i = 1; 
        
        $data['product_detail'] ="";

        foreach($products as $prod){

            $data['product_detail'] .='<tr class="" id="'.$prod->rnp_id.'">
                                            
                                            <td class="si_no">'.$i.'</td>
                                            <td><input type="text" name="dpd_prod_det[]" value="'.$prod->rnp_product_desc.'" class="form-control"  readonly></td>
                                            <td><input type="text" name="dpd_unit[]" value="'.$prod->mrn_reffer.'" class="form-control" readonly></td>
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
        $final_amount = 0;
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

                $data['product_detail'] .='<tr class="add_prod_row add_prod_remove prod_row quot_row_leng" id="'.$product->rnp_id.'">
                                            
                                            <td><input type="text" name="pvp_sales_order[]" value="'.$product->rnp_sales_order.'" class="form-control" readonly></td>
                                            <td style="width:30%"><input type="text" name="pvp_product_desc[]" value="'.$product->rnp_product_desc.'" class="form-control" readonly></td>
                                            <td>
                                               <select class="form-select" name="debit_account[]" required>
                                                   <option value="" selected disabled>Select Debit</option>';
                                                   foreach($debit_accounts as $debit_account){

                                                      $data['product_detail'] .='<option value="'.$debit_account->ca_id .'">'.$debit_account->ca_name.'</option>';

                                                   }
                        $data['product_detail'] .='</select>
                                            </td>
                                            <td><input type="number" name="pvp_qty[]" value="'.$product->rnp_current_delivery.'"  class="form-control add_prod_qty" readonly required></td>
                                            <td><input type="text" name="pvp_unit[]" value="'.$product->rnp_unit.'" class="form-control" required readonly></td>
                                            <td><input type="number" name="pvp_rate[]" value="'.$product->rnp_rate.'"  class="form-control add_prod_rate" required ></td>
                                            <td><input type="number" name="pvp_discount[]" value="'.$product->rnp_discount.'"  class="form-control add_discount" required ></td>
                                            <td><input type="amount" name="pvp_amount[]" value="'.$product->rnp_amount.'"  class="form-control add_prod_amount" required readonly></td>
                                            <input type="hidden" name="rnp_id[]" value="'.$product->rnp_id.'">
                                            <input type="hidden" name="material_received_id[]" value="'.$product->rnp_material_received_note.'">
                                        </tr>';
 
                                    
                                     $i++;

                    $final_amount = $product->rnp_amount + $final_amount; 

                    $data['final_amount'] = $final_amount;
                                    
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

        if($_POST)
        {
        
        $purchase_id  = $this->request->getPost('ID');

        $joins = array(

            array(
                'table' => 'pro_material_requisition',
                'pk'    => 'mr_id',
                'fk'    => 'po_mrn_reff',
            ),

            array(
                'table' => 'pro_contact',
                'pk'    => 'pro_con_id',
                'fk'    => 'po_contact_person',
            ),
            
        );

        $purchases = $this->common_model->SingleRowJoin('pro_purchase_order',array('po_id' => $purchase_id),$joins);

       

        $data['delivery_date']  = $purchases->po_delivery_date;

       

        $data['mr_reff'] = $purchases->mr_reffer_no;
       
        echo json_encode($data);

        }
        
    }


    public function DeleteProdDet()
    {
        $cond = array('pvp_id' => $this->request->getPost('ID'));

        $purchase_voucher_prod = $this->common_model->SingleRow('pro_purchase_voucher_prod',array('pvp_id' => $this->request->getPost('ID')));

        $this->common_model->DeleteData('pro_purchase_voucher_prod',$cond);

        $purchase_voucher_prod2 = $this->common_model->SingleRow('pro_purchase_voucher_prod',array('pvp_reffer_id' => $purchase_voucher_prod->pvp_reffer_id));
        
        $this->common_model->EditData(array('rnp_status' => 0), array('rnp_id' => $purchase_voucher_prod->pvp_mat_rec_note_prod_id), 'pro_material_received_note_prod');
       

        if(empty($purchase_voucher_prod2))
        {   
            $data['status']  = "true";

            $this->common_model->DeleteData('pro_purchase_voucher',array('pv_id' => $purchase_voucher_prod->pvp_reffer_id));

            $this->common_model->EditData(array('mrn_status' => 0), array('	mrn_id' => $purchase_voucher_prod->pvp_mat_rec_id), 'pro_material_received_note');
        }
        else
        {  
            $data['status'] = "false";
        }

        echo json_encode($data);

    }
    

    public function Delete()
    {
        $cond = array('pv_id' => $this->request->getPost('ID'));
 
        $this->common_model->DeleteData('pro_purchase_voucher',$cond);

        $cond2 = array('pvp_reffer_id' => $this->request->getPost('ID'));
 
        $this->common_model->DeleteData('pro_purchase_voucher_prod',$cond2);

        //$sales_order = $this->common_model->SingleRow('crm_sales_orders',array('pv_id' => $this->request->getPost('ID')));
        
        /*if(empty($sales_order))
        {   
            $quotation = $this->common_model->SingleRow('crm_quotation_details',array('qd_id' => $this->request->getPost('ID')));
            
            $enquiry_id = $quotation->qd_enq_ref;

            $quotation_id = $quotation->qd_id;

            $updated_data = array('enquiry_status'=>0);

            $this->common_model->EditData($updated_data,array('enquiry_id' => $enquiry_id),'crm_enquiry');
            
            $quotation_product = $this->common_model->FetchWhere('crm_quotation_product_details',array('qpd_quotation_details' => $quotation_id));
            
            foreach($quotation_product as $quot_prod)
            {
                
                $prod_update = array('pd_status'=>0);

                $this->common_model->EditData($prod_update,array('pd_id' => $quot_prod->qpd_enq_prod_id),'crm_product_detail');

            }
            
            $cond = array('qd_id' => $this->request->getPost('ID'));
 
            $this->common_model->DeleteData('crm_quotation_details',$cond);
    
            $cond1 = array('qpd_quotation_details' => $this->request->getPost('ID'));
     
            $this->common_model->DeleteData('crm_quotation_product_details',$cond1);
    
            $cond2 = array('qc_quotation_id' => $this->request->getPost('ID'));
     
            $this->common_model->DeleteData('crm_quotation_cost_calculation',$cond2);



            $data['status'] = "true";
    
        }*/
        /*else
        {
            $data['status'] = "false";
        }*/

        //echo json_encode($data);
    }


    public function PurchaseOrder()
    {
        $vendor_id =  $this->request->getPost('ID');
        
        $join =  array(
            
            array(
                'table' => 'pro_purchase_order',
                'pk'    => 'po_id',
                'fk'    => 'mrn_purchase_order',
            ),

         
        );

        $material_received  = $this->pro_model->PurchaseVoucher('pro_material_received_note',$join,$vendor_id);        
       
        $data['pur_reff'] = "<option value='' selected disabled>Select Purchase Order</option>";

        foreach($material_received as $mat_rec)
        {
            $data['pur_reff'] .="<option value='".$mat_rec->po_id."'>".$mat_rec->po_reffer_no."</option>";
	
        }


        echo json_encode($data);

    }


    public function Update()
    {
      

        $update_data = [

           

            'pv_date'            => date('Y-m-d',strtotime($this->request->getPost('pv_date'))),

            'pv_vendor_inv'      => $this->request->getPost('pv_vendor_inv'),

            'pv_delivery_note'   => $this->request->getPost('pv_delivery_note'),

            'pv_payment_term'    => $this->request->getPost('pv_payment_term'),

            

        ];
        
       
       

        $this->common_model->EditData($update_data, array('pv_id' => $this->request->getPost('pv_id')), 'pro_purchase_voucher');
        
    }


   
 

}
