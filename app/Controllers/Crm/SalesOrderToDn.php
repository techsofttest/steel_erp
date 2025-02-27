<?php

namespace App\Controllers\Crm;

use App\Controllers\BaseController;


class SalesOrderToDn extends BaseController
{
    
    



    //view page
    public function index()
    {   
        $data['customer_creation'] = $this->common_model->FetchAllOrder('crm_customer_creation','cc_id','desc');

        $data['sales_executives'] = $this->common_model->FetchAllOrder('executives_sales_executive','se_id','desc');

        $data['sales_orders_data'] = $this->common_model->FetchAllOrder('crm_sales_orders','so_id','desc');

        $data['products_data'] = $this->common_model->FetchAllOrder('crm_products','product_id','desc');
        
        $data['content'] = view('crm/sales-order_to_dn',$data);

        return view('crm/report-module',$data);

    }


    //customer droupdrown
    /*public function FetchTypes()
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
                'fk'    => 'so_customer',
            ),
           

        );
        
        $data['result'] = $this->common_model->ReportFetchLimit('crm_sales_orders','so_customer','asc',$term,$start,$end,$joins);
 
        $data['total_count'] =count($data['result']);

        return json_encode($data);

    }*/

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
                'fk'    => 'so_customer',
            ),
           

        );
      
        $data['result'] = $this->common_model->ReportFetchLimit('crm_sales_orders','so_customer','asc',$term,$start,$end,$joins,'so_customer');
    
        $data['total_count'] =count($data['result']);

        return json_encode($data);

    }



    




    //fetch executive by customer
    public function FetchData()
    {    
        //fetch sales order
        $cond = array('so_customer'=>$this->request->getPost('ID'));

        $joins1 = array();


        $sales_refference = $this->common_model->FetchWhereUniqueJoin('crm_sales_orders',$cond,$joins1,'so_reffer_no');
        
        $data['sales_reff'] = '<option value="" selected disabled>Select Order Ref</option>';

        foreach($sales_refference as $sales_reff)
        {
            $data['sales_reff'] .='<option value='.$sales_reff->so_id.'>'.$sales_reff->so_reffer_no.'</option>';
            
        }

        //fetch executive
       
        $joins = array(
            array(
                'table' => 'executives_sales_executive',
                'pk'    => 'se_id',
                'fk'    => 'so_sales_executive',
            ),
           

        );


        $quotation_details = $this->common_model->FetchWhereUniqueJoin('crm_sales_orders',$cond,$joins,'so_sales_executive');
       

        $data['quot_det'] = "<option value='' selected disabled>Select Sales Executive</option>"; 

        foreach($quotation_details as $quot_det)
        {
            $data['quot_det'] .='<option value='.$quot_det->se_id.'>'.$quot_det->se_name.'</option>';
            
        }


        //fetch product

        $product_data = $this->common_model->FetchSalesProdByCustomer('crm_sales_orders',$this->request->getPost('ID'));
        
        $data['quot_prod'] = "<option value='' selected> Select Product</option>";
        $uniqueProductIds = []; // Array to store unique product IDs

        foreach ($product_data as $prod_data) {
            // Check if product_details array is not empty
            if (!empty($prod_data->sales_prod_details)) {
                foreach ($prod_data->sales_prod_details as $sales_prod_det) {
                    // Check if the product ID is not already processed
                    if (!in_array($sales_prod_det->product_id, $uniqueProductIds)) {
                        // Add the product ID to the array of unique IDs
                        $uniqueProductIds[] = $sales_prod_det->product_id;
                        // Add the option for this product to the dropdown
                        $option_value = $sales_prod_det->product_id;
                        $option_text = $sales_prod_det->product_details;
                        $data['quot_prod'] .= '<option value="' . $option_value . '">' . $option_text . '</option>';
                    }
                }
            } else {
                $data['quot_prod'] .= '<option value="">No Product Details Available</option>';
            }
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
        if(!empty($_GET['sales_order_ref']))
        {
            $data2 = $_GET['sales_order_ref'];
        }
        else
        {
            $data2 ="";
        }
        if(!empty($_GET['sales_executive']))
        {
            $data3 =  $_GET['sales_executive'];
        }
        else
        {
            $data3 ="";
        }
        if(!empty($_GET['product']))
        {
            $data4 =$_GET['product'];
        }
        else
        {
            $data4 = "";
        }


        $joins = array(
            
            array(
                'table' => 'crm_sales_product_details',
                'pk'    => 'spd_sales_order',
                'fk'    => 'so_id',
            ),

            array(
                'table' => 'crm_customer_creation',
                'pk'    => 'cc_id',
                'fk'    => 'so_customer',
            ),
            array(
                'table' => 'executives_sales_executive',
                'pk'    => 'se_id',
                'fk'    => 'so_sales_executive',
            ),
            array(
                'table' => 'crm_delivery_note',
                'pk'    => 'dn_sales_order_num',
                'fk'    => 'so_id',
            ),
         
        );

        $joins1 = array(
            array(
                'table' => 'crm_products',
                'pk'    => 'product_id',
                'fk'    => 'spd_product_details',
            ),
        );
      
       $data['sales_orders'] = $this->crm_modal->SalesOrderToDeliveryNote($from_date,'so_date',$to_date,'',$data1,'so_customer',$data2,'so_reffer_no',$data3,'so_sales_executive',$data4,'spd_product_details','crm_sales_orders',$joins,'so_reffer_no',$joins1,'spd_sales_order','crm_sales_product_details');  
       
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


        if(!empty($_POST['pdf']) || (isset($_GET['action']) && $_GET['action'] == "Print"))
       {   
           $this->Pdf($data['sales_orders'],$data['from_dates'],$data['to_dates']);
       }

       $data['customer_creation'] = $this->common_model->FetchAllOrder('crm_customer_creation','cc_id','desc');

       $data['sales_executives'] = $this->common_model->FetchAllOrder('executives_sales_executive','se_id','desc');

        $data['sales_orders_data'] = $this->common_model->FetchAllOrder('crm_sales_orders','so_id','desc');

        $data['products_data'] = $this->common_model->FetchAllOrder('crm_products','product_id','desc');
       
       $data['content'] = view('crm/sales-order_to_dn',$data);

       return view('crm/report-module-search',$data);

    
    }


    public function Pdf($sales_orders,$from_date,$to_date)
    {   
        
        if(!empty($sales_orders))
        {   
            $pdf_data = "";
            
            $i=1;
            $total_amount = 0;
            $total_amount1 = 0;
            $total_amount2 = 0;
            $delivery_amount = 0;
            foreach($sales_orders as $sales_order){

                
                $sales_order_amount = format_currency($sales_order->so_amount_total);

                $new_date = date('d-m-Y', strtotime($sales_order->so_date));
                $pdf_data .= "<tr>
                                <td style='border-top: 2px solid' width='40px'>{$new_date}</td>
                                <td style='border-top: 2px solid' width='100px'>{$sales_order->so_reffer_no}</td>
                                <td style='border-top: 2px solid' width='100px'>{$sales_order->cc_customer_name}</td>
                                <td style='border-top: 2px solid' width='80px'>{$sales_order->so_lpo}</td>
                                <td style='border-top: 2px solid' width='80px'>{$sales_order->se_name}</td>
                                <td style='border-top: 2px solid' align='right' width='80px'>{$sales_order_amount}</td>";
                                
                                $total_amount = $sales_order->so_amount_total + $total_amount;
                                
                                $pdf_data .= "<td colspan='3' align='left' class='p-0' style='border-top: 2px solid'>
                                    <table>";
                                        foreach ($sales_order->sales_products as $sales_prod) 
                                        {   
                                            $delivered_amount = format_currency($sales_prod->totaldelivered);

                                            $pdf_data .= "<tr style='background: unset;border-bottom: hidden !important;'>

                                                            <td class='rotate' width='200px'>{$sales_prod->product_details}</td>

                                                            <td class='rotate' width='80px' style='text-align: right;'>{$delivered_amount}</td>";

                                                            $final_amount = $sales_prod->spd_amount -  $sales_prod->totaldelivered;

                                                            $total_amount2 = $final_amount + $total_amount2;

                                                            if(!empty($final_amount)){

                                                                $final_amount = format_currency($final_amount);

                                                                $pdf_data .= "<td class='rotate' align='right' width='80px' align='right'>{$final_amount}</td>";


                                                            } else{

                                                                $pdf_data .= "<td class='rotate' align='right' width='80px' align='right'>0.00</td>";

                                                            }


                                            
                                            
                                            $pdf_data .= "</tr>";
                                        }
                                    
                                    $pdf_data .= "</table>
                                
                                </td>";



                $pdf_data .= "</tr>";
                                
               

            $i++; 
        
            }


            if(empty($from_date) && empty($to_date))
            {
             
               $dates = "";
            }
            else
            {
               $dates = $from_date . " to " . $to_date;
            }

            $title = "SOTODN";

           // $mpdf = new \Mpdf\Mpdf();

           $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
           $fontDirs = $defaultConfig['fontDir'];

           $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
           $fontData = $defaultFontConfig['fontdata'];


           $mpdf = new \Mpdf\Mpdf([
            'format' => 'Letter', 
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

           
            $mpdf->SetTitle('Sales Order - Delivery / Cash Invoice Analysis'); // Set the title

           

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
            <td align="right"><h3>Sales Order - Delivery / Cash Invoice Analysis</h3></td>
        
            </tr>
        
            </table>

           
        
            <table  width="100%" style="margin-top:2px;border-collapse: collapse; border-spacing: 0;border-top:2px solid;">
            
        
            <tr>
            
            <th align="left" width="40px" style="border-top: 2px solid">Date</th>
        
            <th align="left" width="100px" style="border-top: 2px solid">Sales Order</th>
        
            <th align="left" width="100px" style="border-top: 2px solid">Customer</th>

            <th align="left" width="80px" style="border-top: 2px solid">LPO Ref</th>
        
            <th align="left" width="80px" style="border-top: 2px solid">Sales Executive</th>
        
            <th align="right" width="80px" style="border-top: 2px solid">Amount</th>

            <th colspan="3"  class="p-0" style="border-top: 2px solid">

               <table>
                    <tr>
                        <th align="center" width="200px">Product</th>

                        <th align="right" width="80px">Delivered</th>

                        <th align="right" width="80px">Difference</th>

                    </tr>
               </table>
            
            </th>


            
          
            
            </tr>

             
            '.$pdf_data.'

            <tr>

                <td style="border-top: 2px solid;" width="40px">Total</td>
                <td style="border-top: 2px solid;" width="100px"></td>
                <td style="border-top: 2px solid;" width="100px"></td>
                <td style="border-top: 2px solid;" width="80px"></td>
                <td style="border-top: 2px solid;" width="80px"></td>
                <td style="border-top: 2px solid;text-align: right" width="80px">'.$total_amount.'</td>
              
                <td colspan="3"  class="p-0" style="border-top: 2px solid">
                    <table>
                       <tr style="background: unset;border-bottom: hidden !important;">

                            <td  width="200px"></td>
                            <td  width="80px"></td>
                            <td  width="80px" style="text-align: right;">'.$total_amount2.'</td>
                           
                            
                       
                       </tr>
                    
                    </table>
                </td>
                
            
            </tr>


            

           
           
            
            </table>


        
            ';
        
            //$footer = '';
        
           //echo $html; exit();
            
            $mpdf->WriteHTML($html);
           // $mpdf->SetFooter($footer);
            $this->response->setHeader('Content-Type', 'application/pdf');
            $mpdf->Output($title . '.pdf', 'I');

            exit();
        
        }

       
    }


    

  







}
