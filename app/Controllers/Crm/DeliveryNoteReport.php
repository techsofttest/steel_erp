<?php

namespace App\Controllers\Crm;

use App\Controllers\BaseController;


class DeliveryNoteReport extends BaseController
{
    
    



    //view page
    public function index()
    {   
        $data['customer_creation'] = $this->common_model->FetchAllOrder('crm_customer_creation','cc_id','desc');

        $data['sales_orders_data'] = $this->common_model->FetchAllOrder('crm_sales_orders','so_id','desc');

        $data['products_data'] = $this->common_model->FetchAllOrder('crm_products','product_id','desc');
        
        $data['content'] = view('crm/delivery_note_report',$data);

        return view('crm/report-module',$data);

    }


    //customer droupdrown
    public function FetchTypes()
    {
        $page= !empty($_GET['page']) ? $_GET['page'] : 0;
        $term = !empty($_GET['term']) ? $_GET['term'] : "";
        $resultCount = 10;
        $end = ($page - 1) * $resultCount;       
        $start = $end + $resultCount;

        $joins = array(
            
            array(
                'table' => 'crm_customer_creation',
                'pk'    => 'cc_id',
                'fk'    => 'dn_customer',
            ),
        
        );
      
        $data['result'] = $this->common_model->ReportFetchLimit('crm_delivery_note','dn_customer','asc',$term,$start,$end,$joins,'dn_customer');
    
        $data['total_count'] = count($data['result']);

        return json_encode($data);

    }



    




    //fetch executive by customer
    public function FetchData()
    {    
        //fetch sales order
        $cond = array('dn_customer'=>$this->request->getPost('ID'));

        $joins = array(

            array(
                'table' => 'crm_sales_orders',
                'pk'    => 'so_id',
                'fk'    => 'dn_sales_order_num',
            ),
        );


        $sales_refference = $this->common_model->FetchWhereUniqueJoin('crm_delivery_note',$cond,$joins,'dn_sales_order_num');
        
       
        
        $data['sales_reff'] = '<option value="" selected disabled>Select Order Ref</option>';

        foreach($sales_refference as $sales_reff)
        {
            $data['sales_reff'] .='<option value='.$sales_reff->so_id.'>'.$sales_reff->so_reffer_no.'</option>';
            
        }

        
        //fetch product

        $product_data = $this->common_model->FetchDeliveryProdByCustomer('crm_delivery_note',$this->request->getPost('ID'));
        
        $data['quot_prod'] = "<option value='' selected> Select Product</option>";
        $uniqueProductIds = []; // Array to store unique product IDs

        foreach ($product_data as $prod_data) {
            // Check if product_details array is not empty
            if (!empty($prod_data->delivery_prod_details)) {
                foreach ($prod_data->delivery_prod_details as $delivery_prod_det) {
                    // Check if the product ID is not already processed
                    if (!in_array($delivery_prod_det->product_id, $uniqueProductIds)) {
                        // Add the product ID to the array of unique IDs
                        $uniqueProductIds[] = $delivery_prod_det->product_id;
                        // Add the option for this product to the dropdown
                        $option_value = $delivery_prod_det->product_id;
                        $option_text = $delivery_prod_det->product_details;
                        $data['quot_prod'] .= '<option value="' . $option_value . '">' . $option_text . '</option>';
                    }
                }
            } 
            /*else 
            {
                $data['quot_prod'] .= '<option value="">No Product Details Available</option>';
            }*/
        }



        echo json_encode($data);

    }


    //fetch data
    public function GetData()
    {   
        if(!empty($_GET['form_date']))
        {
            $from_date = $_GET['form_date'];
        }
        else
        {
            $from_date = "";
        }
        if(!empty($_GET['to_date']))
        {
            $to_date = $_GET['to_date'];
        }
        else
        {
            $to_date = "";
        }
        if(!empty($_GET['customer']))
        {
            $data1 = $_GET['customer'];
        }
        else
        {
            $data1 ="";
        }
        if(!empty($_GET['sales_order']))
        {
            $data2 = $_GET['sales_order'];
        }
        else
        {
            $data2 ="";
        }
        if(!empty($_GET['product']))
        {
            $data3 =  $_GET['product'];
        }
        else
        {
            $data3 ="";
        }
       

       
        $joins = array(
            array(
                'table' => 'crm_delivery_product_details',
                'pk'    => 'dpd_delivery_id',
                'fk'    => 'dn_id',
            ),
            array(
                'table' => 'crm_customer_creation',
                'pk'    => 'cc_id',
                'fk'    => 'dn_customer',
            ),
            array(
                'table' => 'crm_sales_orders',
                'pk'    => 'so_id',
                'fk'    => 'dn_sales_order_num',
            ),
        );


        $joins1 = array(
            array(
                'table' => 'crm_products',
                'pk'    => 'product_id',
                'fk'    => 'dpd_prod_det',
            ),

           
        );

       
       $data['delivery_note'] = $this->crm_modal->DeliveryCheckData($from_date,'dn_date',$to_date,'',$data1,'dn_customer',$data2,'dn_sales_order_num',$data3,'dpd_prod_det','','','crm_delivery_note',$joins,'dn_reffer_no',$joins1,'dpd_delivery_id','crm_delivery_product_details');  
       
       if(!empty($from_date))
        {
            $data['from_dates'] = date('d-M-Y',strtotime($from_date));
        }
        else
        {
            $data['from_dates'] ="";
        } 
        

        if(!empty($to_date))
        {
            $data['to_dates'] = date('d-M-Y',strtotime($to_date));
        }
        else
        {
            $data['to_dates'] = "";
        }

       if(!empty($_POST['pdf']))
       {   
           $this->Pdf($data['delivery_note'],$data['from_dates'],$data['to_dates']);
       }

       $data['sales_orders_data'] = $this->common_model->FetchAllOrder('crm_sales_orders','so_id','desc');

       $data['products_data'] = $this->common_model->FetchAllOrder('crm_products','product_id','desc');

       $data['content'] = view('crm/delivery_note_report',$data);

       return view('crm/report-module-search',$data);
       
      
    }


    public function Pdf($delivery_note,$from_date,$to_date)
    {   
       
        if(!empty($delivery_note))
        {   
            $pdf_data = "";

            $joins1 = array(
            
                array(
                    'table' => 'crm_products',
                    'pk'    => 'product_id',
                    'fk'    => 'dpd_prod_det',
                ),
               
                
            );

            
            $total_amount = 0;
            foreach($delivery_note as $del_note)
            {   
                $q=1;
                $border="border-top: 2px solid";

                $product_details = $this->common_model->FetchWhereJoin('crm_delivery_product_details',array('dpd_delivery_id'=>$del_note->dn_id),$joins1);
                
                $total_amount = $total_amount + $del_note->dn_total_amount;

                $sales_amount = format_currency($del_note->dn_total_amount);

                $new_date = date('d-m-Y',strtotime($del_note->dn_date));

                $pdf_data .= "<tr><td style='border-top: 2px solid'>{$new_date}</td>";

                $pdf_data .= "<td style='border-top: 2px solid'>{$del_note->dn_reffer_no}</td>";

                $pdf_data .= "<td style='border-top: 2px solid'>{$del_note->cc_customer_name}</td>";
                
                $pdf_data .= "<td style='border-top: 2px solid'>{$del_note->so_reffer_no}</td>";

                $pdf_data .= "<td style='border-top: 2px solid'>{$del_note->dn_lpo_reference}</td>";

                $pdf_data .= "<td style='border-top: 2px solid' align='right'>{$sales_amount}</td>";
                
                
                if($q!=1){
                     
                    $pdf_data .="</tr>";
                }
                foreach($product_details as $prod_del)
                {
                    if($q!=1){

                        $pdf_data .="<tr>";

                        $pdf_data .= "<tr><td style=''></td>";

                        $pdf_data .= "<td style=''></td>";

                        $pdf_data .= "<td style=''></td>";
                        
                        $pdf_data .= "<td style=''></td>";

                        $pdf_data .= "<td style=''></td>";

                        $pdf_data .= "<td style=''></td>";
                    }

                    

                    $pdf_data .= "<td style='";
                    if ($q == 1) {
                    
                        $pdf_data .= $border;
                    }
                    $pdf_data .= "'>{$prod_del->product_details}</td>";

                    $pdf_data .= "<td align='center' style='";
                    if ($q == 1) {
                    
                        $pdf_data .= $border;
                    }
                    $pdf_data .= "'>{$prod_del->dpd_current_qty}</td>";

                    $pdf_data .= "<td align='center' style='";
                    if ($q == 1) {
                    
                        $pdf_data .= $border;
                    }
                    $pdf_data .= "'>{$prod_del->dpd_delivery_qty}</td>";

                    $pdf_data .= "<td align='right' style='";
                    if ($q == 1) {
                    
                        $pdf_data .= $border;
                    }
                    
                    $delivery_date = format_currency($prod_del->dpd_prod_rate);

                    $pdf_data .= "'>{$delivery_date}</td>";


                    $pdf_data .= "<td align='right' style='";

                    $discount_amount = format_currency($prod_del->dpd_prod_dicount);

                    if ($q == 1) {
                    
                        $pdf_data .= $border;
                    }
                    $pdf_data .= "'>{$discount_amount}%</td>";

                    
                    
                    $pdf_data .= "<td align='right' style='";

                    
                    $delivery_amount = format_currency($prod_del->dpd_total_amount);

                    if ($q == 1) {
                    
                        $pdf_data .= $border;
                    }
                    $pdf_data .= "'>{$delivery_amount}</td>";

                    
                    if($q!=1)
                    {
                        $pdf_data .="</tr>";
                    }

                    $q++;

                }
                
                if($q==1)
                {
                    $pdf_data .="</tr>";
                }

               // $pdf_data .="</tr>";
                 
                
               
                
            }

            if(empty($from_date) && empty($to_date))
            {
             
               $dates = "";
            }
            else
            {
               $dates = $from_date . " to " . $to_date;
            }

            $title = "SQR";

            $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
            $fontDirs = $defaultConfig['fontDir'];
 
            $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
            $fontData = $defaultFontConfig['fontdata'];
 
 
            $mpdf = new \Mpdf\Mpdf([
             'format' => 'Letter', // Custom page size in millimeters
             'default_font_size' => 9, 
             'margin_left' => 5, 
             'margin_right' => 5,
             'fontDir' => array_merge($fontDirs, [
                 __DIR__ . '/fonts'
             ]),
             'fontdata' => $fontData + [
                 'bentonsans' => [
                   
                     'R' => 'OpenSans-Regular.ttf',
                     'B' => 'OpenSans-Bold.ttf',
                 ],
             ],
             'default_font' => 'bentonsans'
             
         ]);

            $mpdf->SetTitle('Delivery Note Report'); // Set the title

            $total_amount = format_currency($total_amount);

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
            
            
        
            <td>
        
            <h3>Al Fuzail Engineering Services WLL</h3>
            <div><p class="paragraph-spacing">Tel : +974 4460 4254, Fax : 4029 8994, email : engineering@alfuzailgroup.com</p></div>
            <p>Post Box : 201978, Gate : 248, Street : 24, Industrial Area, Doha - Qatar</p>
            
            
            </td>
            
            </tr>
        
            </table>
        
        
        
            <table width="100%" style="margin-top:10px;">
            
        
            <tr width="100%">
            <td>Period : '.$dates.'</td>
            <td align="right"><h3>Delivery Note Report</h3></td>
        
            </tr>
        
            </table>

           
        
            <table  width="100%" style="margin-top:2px;border-collapse: collapse; border-spacing: 0;border-top:2px solid;">
            
        
            <tr>
            
            <th align="left">Date</th>
        
            <th align="left" width="100px">Delivery Note.</th>
        
            <th align="left">Customer</th>
        
            <th align="left" width="100px">Sales Order </th>
        
            <th align="left" width="70px">LPO Ref</th>

            <th align="right">Amount</th>

            <th align="left">Product</th>

            <th align="left" width="90px">Qty Ordered</th>

            <th align="left" width="95px">Qty Delivered</th>

            <th align="center">Rate</th>

            <th align="right">Discount</th>
            
            <th align="right">Amount</th>
        
            
            </tr>

             
            '.$pdf_data.'

            <tr>
                <td style="border-top: 2px solid;">Total</td>
                <td style="border-top: 2px solid;"></td>
                <td style="border-top: 2px solid;"></td>
                <td style="border-top: 2px solid;"></td>
                <td style="border-top: 2px solid;"></td>
                <td style="border-top: 2px solid;"><b>'.$total_amount.'</b></td>
                <td style="border-top: 2px solid;"></td>
                <td style="border-top: 2px solid;"></td>
                <td style="border-top: 2px solid;"></td>
                <td style="border-top: 2px solid;"></td>
                <td style="border-top: 2px solid;" ></td>
                <td style="border-top: 2px solid;"><b>'.$total_amount.'</b></td>
                
            </tr>    
           
            
            </table>


        
            ';
        
            //$footer = '';
        
            
            $mpdf->WriteHTML($html);
           // $mpdf->SetFooter($footer);
            $this->response->setHeader('Content-Type', 'application/pdf');
            $mpdf->Output($title . '.pdf', 'I');

            exit();
        
        }

       
    }





}