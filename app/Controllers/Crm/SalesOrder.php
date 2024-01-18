<?php

namespace App\Controllers\Crm;

use App\Controllers\BaseController;


class SalesOrder extends BaseController
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
       
        $totalRecords = $this->common_model->GetTotalRecords('crm_sales_orders','so_id','DESC');
 
        ## Total number of records with filtering
       
        $searchColumns = array('so_order_no');

        $totalRecordwithFilter = $this->common_model->GetTotalRecordwithFilter('crm_sales_orders','so_id',$searchValue,$searchColumns);
    
        ##Joins if any //Pass Joins as Multi dim array
        $joins = array(
            array(
                'table' => 'crm_customer_creation',
                'pk'    => 'cc_id',
                'fk'    => 'so_customer',
            ),
            array(
                'table' => 'crm_quotation_details',
                'pk'    => 'qd_id',
                'fk'    => 'so_quotation_ref',
            )
        );
        ## Fetch records
        $records = $this->common_model->GetRecord('crm_sales_orders','so_id',$searchValue,$searchColumns,$columnName,$columnSortOrder,$joins,$rowperpage,$start);
    
        $data = array();

        $i=1;
        foreach($records as $record ){
            $action = '<a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->so_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a><a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->so_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> Delete</a><a  href="javascript:void(0)" data-id="'.$record->so_id.'"  class="view view-color view_btn" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a><a href="'.base_url().'CRM/SalesOrder/Print/'.$record->so_id.'" target="_blank" class="print_color"><i class="ri-file-pdf-2-line " aria-hidden="true"></i>Print</a>';
           
           $data[] = array( 
              "so_id"            =>$i,
              'so_order_no'      => $record->so_order_no,
              'so_date'          => date('d-m-Y',strtotime($record->so_date)),
              'so_customer'      => $record->cc_customer_name,
              'so_quotation_ref' => $record->qd_quotation_number,
              "action"           => $action,
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

    //view page
    public function index()
    {   
       
        $joins = array(
            array(
                'table' => 'crm_customer_creation',
                'pk'    => 'cc_id',
                'fk'    => 'qd_customer',
            ),
           

        );

        $data['customer_creation'] = $this->common_model->FetchCustomerCreation('crm_quotation_details',$joins);

        $data['sales_executive'] = $this->common_model->FetchAllOrder('executives_sales_executive','se_id','desc');
        
        $data['products'] = $this->common_model->FetchAllOrder('crm_products','product_id','desc');

        $data['delivery_term'] = $this->common_model->FetchAllOrder('master_delivery_term','dt_id','desc');

        $data['product_head'] = $this->common_model->FetchAllOrder('crm_product_heads','ph_id','desc');

        $data['content'] = view('crm/sales-order',$data);

        return view('crm/crm-module',$data);

    }


    // add account head
    Public function Add()
    {   
        
        $insert_data = $this->request->getPost();

        $insert_data['so_added_by'] = 0; 

        $insert_data['so_added_date'] = date('Y-m-d'); 

        $id = $this->common_model->InsertData('crm_sales_orders',$insert_data);

        $data['so_id'] = $id;

        $p_ref_no = 'SO'.str_pad($id, 7, '0', STR_PAD_LEFT);
        
        $cond = array('so_id' => $id);

        $update_data['so_order_no'] = $p_ref_no;

        $this->common_model->EditData($update_data,$cond,'crm_sales_orders');

        echo json_encode($data);

    }

    public function AddTab2()
    {
        $insert_data = $this->request->getPost();
        if($_POST){
	        if(!empty($_POST['spd_unit']))
			{
			    $count =  count($_POST['spd_unit']);
				
				if($count!=0)
			    {  
					for($j=0;$j<=$count-1;$j++)
					{   /*convert number to words*/
                        $number  = $_POST['spd_amount'][$j];
                        $no = floor($number);
                        $hundred = null;
                        $digits_1 = strlen($no); //to find lenght of the number
                        $i = 0;
                        // Numbers can stored in array format
                        $str = array();

                        $words = array('0' => '', '1' => 'One', '2' => 'Two',
                        '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
                        '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
                        '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
                        '13' => 'Thirteen', '14' => 'Fourteen',
                        '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
                        '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
                        '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
                        '60' => 'Sixty', '70' => 'Seventy',
                        '80' => 'Eighty', '90' => 'Ninety');
                        $digits = array('', 'Hundred', 'Thousand', 'lakh', 'Crore');
                        while ($i < $digits_1)
                        {
                            $divider = ($i == 2) ? 10 : 100;
                            //Round numbers down to the nearest integer
                            $number =floor($no % $divider);
                            $no = floor($no / $divider);
                            $i +=($divider == 10) ? 1 : 2;

                            if ($number)
                            {
                            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                            $str [] = ($number < 21) ? $words[$number] . " " .
                            $digits[$counter] .
                            $plural . " " .
                            $hundred: $words[floor($number / 10) * 10]. " " .
                            $words[$number % 10] . " ".
                            $digits[$counter] . $plural . " " .
                            $hundred;
                            }
                            else $str[] = null;
                        }
                        $str = array_reverse($str);
                        $result = implode('', $str); //Join array elements with a string
                        /**/
                        

					    $insert_data  	= array(  
							
							'spd_product_details'   =>  $_POST['spd_product_details'][$j],
							'spd_unit'              =>  $_POST['spd_unit'][$j],
						    'spd_quantity'          =>  $_POST['spd_quantity'][$j],
                            'spd_rate'              =>  $_POST['spd_rate'][$j],
                            'spd_discount'          =>  $_POST['spd_discount'][$j],
                            'spd_amount'            =>  $_POST['spd_amount'][$j],
                            'spd_amount_in_words'   =>  $result,
                            'spd_sales_order'       =>  $_POST['spd_sales_order'],
	  
					    );
					
						
				        $id = $this->common_model->InsertData('crm_sales_product_details',$insert_data);
				
				    } 
				}
			}
			
			
        }
        

       
    }



    public function AddTab3()
    {
        $cond = array('so_id' => $this->request->getPost('so_id'));
        $update_data = $this->request->getPost();
        //print_r($update_data); exit();
        if (array_key_exists('so_id', $update_data)) {
            unset($update_data['so_id']);
        }

        
        // Handle file upload
        if (isset($_FILES['so_lpo_and_drawing']) && $_FILES['so_lpo_and_drawing']['name'] !== '') {
            $ccAttachCrFileName = $this->uploadFile('so_lpo_and_drawing', 'uploads/SalesOrder');
            $update_data['so_lpo_and_drawing'] = $ccAttachCrFileName;
        }

        $this->common_model->EditData($update_data, $cond, 'crm_sales_orders');
    }
    
    // Function to handle file upload
    private function uploadFile($fieldName, $uploadPath)
    {
        $file = $this->request->getFile($fieldName);

        if ($file->isValid() && !$file->hasMoved()) 
        {
            $newName = $file->getRandomName();
            $file->move($uploadPath, $newName);
            return $newName;
        }

        return null;
    }



  




    //account head modal 
    public function View()
    {
        
        $cond = array('so_id' => $this->request->getPost('ID'));

        

        $joins = array(
           
            array(
                'table' => 'crm_customer_creation',
                'pk'    => 'cc_id',
                'fk'    => 'so_customer',
            ),
            array(
                'table' => 'crm_quotation_details',
                'pk'    => 'qd_id',
                'fk'    => 'so_quotation_ref',
            )


        );

        $sales_orders = $this->common_model->SingleRowJoin('crm_sales_orders',$cond,$joins);


        $cond1 = array('spd_sales_order' => $this->request->getPost('ID'));

        $product_details_data = $this->common_model->FetchWhere('crm_sales_product_details',$cond1);
         

        $data['so_order_no']                   = $sales_orders->so_order_no;

         $data['so_date']                      = $sales_orders->so_date;

        $data['cc_customer_name']              = $sales_orders->cc_customer_name;

        $data['so_lpo']                        = $sales_orders->so_lpo;

        $data['qd_quotation_number']           = $sales_orders->qd_quotation_number;

        $data['so_contact_person']             = $sales_orders->so_contact_person;

        $data['so_sales_executive']            = $sales_orders->so_sales_executive;

        $data['so_payment_term']               = $sales_orders->so_payment_term;

        $data['so_delivery_term']              = $sales_orders->so_delivery_term;

        $data['so_project']                    = $sales_orders->so_project;

        $data['so_scheduled_date_of_delivery'] = $sales_orders->so_scheduled_date_of_delivery;


       


         
        
        $data['prod_details'] ='<table  class="table table-bordered table-striped delTable"><tbody class="travelerinfo"><tr><td >
        Serial No.</td><td>Product Description</td><td>Unit</td><td>Quantity</td><td>Rate</td><td>Discount</td><td>Amount</td><td>Amount In Words</td></tr>';

        foreach($product_details_data as $prod_det)
        {
            $data['prod_details'] .='<tr>
            <td><input type="text"   value="'.$prod_det->spd_serial_no.'" class="form-control " readonly></td>
            <td><input type="text"   value="'.$prod_det->spd_product_details.'" class="form-control " readonly></td>
            <td><input type="text"   value="'.$prod_det->spd_unit.'" class="form-control " readonly></td>
            <td> <input type="text" value="'.$prod_det->spd_quantity.'" class="form-control " readonly></td>
            <td> <input type="text" value="'.$prod_det->spd_rate.'" class="form-control " readonly></td>
            <td> <input type="text" value="'.$prod_det->spd_discount.'" class="form-control " readonly></td>
            <td> <input type="text" value="'.$prod_det->spd_amount.'" class="form-control " readonly></td>
            <td> <input type="text" value="'.$prod_det->spd_amount_in_words.'" class="form-control " readonly></td>
            </tr>'; 
             
        }
        
        $data['prod_details'] .= '</tbody></table>';

        $data['lpo_and_drawing'] = '<a href="' . base_url('uploads/SalesOrder/' . $sales_orders->so_lpo_and_drawing) . '" target="_blank">View</a>';  


        
        echo json_encode($data);
    }


    public function ContactPerson()
    {
        $cond = array('contact_customer_creation' => $this->request->getPost('ID'));

        $contact_details = $this->common_model->FetchWhere('crm_contact_details',$cond);

        $cond1 = array('qd_customer' => $this->request->getPost('ID'));

        $quotation_details = $this->common_model->FetchWhere('crm_quotation_details',$cond1);

        $data['quotation_det'] ="";
        
        $data['quotation_det'] ='<option value="" selected disabled>Select Quotation Ref</option>';

        foreach($quotation_details as $quot_det)
        {
            $data['quotation_det'] .='<option value='.$quot_det->qd_id.'';
           
            $data['quotation_det'] .='>' .$quot_det->qd_quotation_number. '</option>'; 
        }


        $data['customer_name'] ="";

        $data['customer_name'] ='<option value="" selected disabled>Select  Contact Person</option>';

        foreach($contact_details as $con_det)
        {
            $data['customer_name'] .='<option value='.$con_det->contact_id.'';
           
            $data['customer_name'] .='>' .$con_det->contact_person. '</option>'; 
        }

        echo json_encode($data);


    }


    public function QuotationRef()
    {
        $cond = array('qd_id' => $this->request->getPost('ID'));

        $cond1 = array('qpd_quotation_details' => $this->request->getPost('ID'));

        $joins1 = array(
            array(
                'table' => 'crm_products',
                'pk'    => 'product_id',
                'fk'    => 'qpd_product_description',
            ),
           

        );

        $product_details_data = $this->common_model->FetchWhereJoin('crm_quotation_product_details',$cond1,$joins1);
        
        $products = $this->common_model->FetchAllOrder('crm_products','product_id','desc');

         
        $data['prod_details'] ='<table  class="table table-bordered table-striped delTable"><tbody class="travelerinfo"><tr><td >
        Serial No.</td><td>Product Description &nbsp <span class="edit_add_more product_modal"><i class="ri-add-circle-line"></i></span></td><td>Unit</td><td>Quantity</td><td>Rate</td><td>Discount</td><td>Amount</td><td>Action</td></tr>';

        foreach($product_details_data as $prod_det)
        {   
            $prod_det->qpd_amount;

            $data['prod_details'] .='<tr class="prod_row" id="'.$prod_det->qpd_id.'">
            <td><input type="text"  name="spd_serial_no[]"  value="'.$prod_det->qpd_serial_no.'" class="form-control non_border_input" readonly></td>
            <td style="width:20%">
                <select class="form-select droup_product add_prod" name="spd_product_details[]" required>';
                    
                    foreach($products as $prod){
                        $data['prod_details'] .='<option value="'.$prod->product_id.'" '; 
                        if($prod->product_id == $prod_det->qpd_product_description){ $data['prod_details'] .= "selected"; }
                        $data['prod_details'] .='>'.$prod->product_details.'</option>';
                    }
            $data['prod_details'] .='</select>
            </td>
            <td><input type="text"  name="spd_unit[]"  value="'.$prod_det->qpd_unit.'" class="form-control " required></td>
            <td> <input type="text" name="spd_quantity[]" value="'.$prod_det->qpd_quantity.'" class="form-control qtn_clz_id"  required></td>
            <td> <input type="text" name="spd_rate[]" value="'.$prod_det->qpd_rate.'" class="form-control rate_clz_id" required></td>
            <td> <input type="text" name="spd_discount[]" value="'.$prod_det->qpd_discount.'" class="form-control discount_clz_id" required></td>
            <td> <input type="text" name="spd_amount[]" value="'.$prod_det->qpd_amount.'" class="form-control amount_clz_id" required></td>
            <td class="row_remove" data-id="'.$prod_det->qpd_id.'"><i class="ri-close-line"></i>Remove</td>
            </tr>'; 
             
        }
        
        $data['prod_details'] .= '</tbody><tbody class="travelerinfo product-more2"></tbody></table><div class="edit_add_more_div"><span class="edit_add_more add_product2"><i class="ri-add-circle-line"></i>Add More</span></div>';

        /**/


        $joins = array(
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
            )


        );

        $quotation_details = $this->common_model->SingleRowJoin('crm_quotation_details',$cond,$joins);

        $data['qd_contact_person']  =  $quotation_details->contact_person;

        $data['qd_sales_executive'] =  $quotation_details->se_name;

        $data['qd_payment_term'] =  $quotation_details->qd_payment_term;

        $data['qd_delivery_term']   =  $quotation_details->dt_name;

        $data['qd_project'] =  $quotation_details->qd_project;

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
        $cond = array('so_id' => $this->request->getPost('ID'));
 
        $this->common_model->DeleteData('crm_sales_orders',$cond);

        $cond1 = array('spd_sales_order' => $this->request->getPost('ID'));
 
        $this->common_model->DeleteData('crm_sales_product_details',$cond1);
 
         
    }


    //delete contact details
    public function DeleteContact()
    {
        $cond = array('qpd_id' => $this->request->getPost('ID'));
 
        $this->common_model->DeleteData('crm_quotation_product_details',$cond);

        
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



    public function Print($id){

        $cond= array('so_id' => $id);

        $joins = array(
           
            array(
                'table' => 'crm_customer_creation',
                'pk'    => 'cc_id',
                'fk'    => 'so_customer',
            ),
           
        );
        
        $sales_order = $this->common_model->SingleRowJoin('crm_sales_orders',$cond,$joins);

        if(!empty($sales_order)){

            $sales_order->so_id;

            $cond1 = array('spd_sales_order' => $sales_order->so_id);

            $product_details = $this->common_model->FetchWhere('crm_sales_product_details',$cond1);

            $i =1;
            foreach($product_details as $prod_det)
            {
                $item_no = "{$sales_order->so_order_no}"; 

                $si = "{$i}";

                $prod_desc = "{$prod_det->spd_product_details}";

                $prod_qty = "{$prod_det->spd_quantity}";

                $prod_unit = "{$prod_det->spd_unit}";

                $prod_rate = "{$prod_det->spd_rate}";

                $prod_discount = "{$prod_det->spd_discount}";

                $prod_amount = "{$prod_det->spd_amount}";

            
            }
            $i++;
            $mpdf = new \Mpdf\Mpdf();

        
        
            $html ='
        
            <style>
            th, td {
                padding-top: 10px;
                padding-bottom: 10px;
                padding-left: 5px;
                padding-right: 5px;
                font-size: 12px;
            }
            p{
                
                font-size: 12px;

            }
            .dec_width
            {
                width:30%
            }
            .disc_color
            {
                color:red;
            }
            
            </style>
        
            <table>
            
            <tr>
            
            <td style="height:100px;width:100px"><img src="'.base_url().'public/assets/images/logo-sm.png" alt=""></td>
        
            <td>
        
            <h2>Al Fuzail Engineering Services WLL</h2>
            <div><p class="paragraph-spacing">Tel : +974 4460 4254, Fax : 4029 8994, email : engineering@alfuzailgroup.com</p></div>
            <p>Post Box : 201978, Gate : 248, Street : 24, Industrial Area, Doha - Qatar</p>
            
            
            </td>
            
            </tr>
        
            </table>
        
        
        
            <table width="100%" style="margin-top:10px;">
            
        
            <tr width="100%">
            <td>Date:31-Jul-2016</td>
            <td>Sales Order No.:03562</td>
            <td align="right"><h3>Sales Order</h3></td>
        
            </tr>
        
            </table>
        
        
            <table  width="100%" style="margin-top:2px;border-top:2px solid;border-bottom:2px solid;">
        
            <tr>
            
            <td > </td>
            
            <td >'.$sales_order->cc_customer_name.'</td>
            
            </tr>
        
        
            <tr>
            
            <td >Customer</td>
            
                
            <td >Tel : '.$sales_order->cc_telephone.', Fax : '.$sales_order->cc_fax.', Email : '.$sales_order->cc_email.'</td>
            
            </tr>
        
        
            <tr>
            
            <td ></td>
            
            <td >Post Box : -, Doha - '.$sales_order->cc_post_box.'</td>
            
            </tr>
        
        
            <tr>
            
            <td >Attention</td>
            
            <td >Mr. Johnson - Manager, Mobile: -, Email: -</td>
            
            </tr>
        
        
            </table>
        
        
        
        
            <table  width="100%" style="margin-top:2px;border-collapse: collapse; border-spacing: 0;">
            
        
            <tr>
            
            <th align="left" style="border-bottom: 2px solid;">Item No.</th>
        
            <th align="left" style="border-bottom: 2px solid;">Description</th>
        
            <th align="left" style="border-bottom: 2px solid;">Qty</th>
        
            <th align="left" style="border-bottom: 2px solid;">Unit</th>
        
            <th align="left" style="border-bottom: 2px solid;">Rate</th>

            <th align="left" style="border-bottom: 2px solid;">Disc %</th>

            <th align="left" style="border-bottom: 2px solid;">Amount</th>
        
            
            </tr>

            
        
            <tr>
            
            <td>'.$si.'-'.$item_no.'</td>
        
            <td>'.$prod_desc.'</td>
        
            <td>'.$prod_qty.'</td>
        
            <td>'.$prod_unit.'</td>
        
            <td>'.$prod_rate.'</td>
        
            <td>'.$prod_discount.'</td>

            <td>'.$prod_amount.'</td>
            
            </tr>

            
            </table>
        
            ';
        
            $footer = '
        
            <table style="border-bottom:1px solid">
            
            <tr>
            
            <td>Promised Date</td>
        
            <td>15-Aug-2016</td>

            <td>Gross Total</td>

            <td>2,445.00</td>
        
            </tr>

            <tr>

            <td>Promised Date</td>
        
            <td></td>

            <td>Less. Special Discount</td>

            <td>122.25</td>
            
            </tr>


            <tr>

            <td>Amount in words</td>
        
            <td>Two thousand three hundred twenty two & seventy five Dirhams onl</td>

            <td>Net Quote Value</td>

            <td>2,322.75</td>
            
            </tr>

            </table>


            <table>
            
            <tr>
                <td style="width:20%">Order Terms</td>

                <td style="width:20%">LPO Reference</td>

                <td style="width:20%">Verbal</td>

                <td style="width:20%">Payment:</td>

                <td style="width:20%">Cash on delivery</td>
                
            </tr>

            <tr>
                <td style="width:20%"></td>

                <td style="width:20%">Quote Reference</td>

                <td style="width:20%">02462</td>

                <td style="width:20%">Delivery</td>

                <td style="width:20%">Ex-works</td>

            </tr>
            
            </table>


            <table style="border-top:1px solid">

            <tr>
            
                <td>Antony Raphel - Production In-charge</td>

                <td></td>

                <td></td>

                <td></td>

                <td></td>

                <td></td>

                <td></td>
                
                <td></td>

                <td></td>

            

            
                <td>Justin Jose - Operations Manager</td>

            </tr>


            <tr>

                <td>Mob : +974 6688 5418, antony@alfuzailgroup.com</td>

                <td></td>

                <td></td>

                <td></td>

                <td></td>

                <td></td>

                <td></td>

                <td></td>

                <td></td>

            

                

                <td>Mob : +974 3381 6185, justin@alfuzailgroup.com</td>
            
            </tr>
            
            
            </table>
        
        
        
            ';
        
            
            $mpdf->WriteHTML($html);
            $mpdf->SetFooter($footer);
            $this->response->setHeader('Content-Type', 'application/pdf');
            $mpdf->Output();

        }


    
    }
    





}
