<?php

namespace App\Controllers\Crm;

use App\Controllers\BaseController;


class DnToCreditInvoice extends BaseController
{
    
    



    //view page
    public function index()
    {   
        $data['customer_creation'] = $this->common_model->FetchAllOrder('crm_customer_creation','cc_id','desc');

        $data['delivery_note_data'] = $this->common_model->FetchAllOrder('crm_delivery_note','dn_id','desc');

        $data['sales_orders_data'] = $this->common_model->FetchAllOrder('crm_sales_orders','so_id','desc');

        $data['products_data'] = $this->common_model->FetchAllOrder('crm_products','product_id','desc');

        $data['content'] = view('crm/dn_to_credit_invoice',$data);

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
    
        $data['total_count'] =count($data['result']);

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

        //fetch delivery note ref

        $joins1 =  array();

        $delivery_notes = $this->common_model->FetchWhereUniqueJoin('crm_delivery_note',$cond,$joins1,'dn_reffer_no');
        
        $data['delivier_note'] ='<option value="" selected disabled>Select Delivery Note</option>';

        foreach($delivery_notes as $delivery_note)
        {
            $data['delivier_note'] .='<option value='.$delivery_note->dn_id.'>'.$delivery_note->dn_reffer_no.'</option>';
            
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
            $data1 = "";
        }


        if(!empty($_GET['sales_order']))
        {
            $data2 = $_GET['sales_order'];
        }
        else
        {
            $data2 = "";
        }


        if(!empty($_GET['delivery_note']))
        {
            $data3 = $_GET['delivery_note'];
        }
        else
        {
            $data3 = "";
        }


        if(!empty($_GET['product']))
        {
            $data4 = $_GET['product'];
        }
        else
        {
            $data4 = "";
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

      

        $data['delivery_data'] = $this->crm_modal->dn_to_credit_invoice($from_date,'dn_date',$to_date,'',$data1,'dn_customer',$data2,'dn_sales_order_num',$data3,'dn_id',$data4,'dpd_prod_det','crm_delivery_note',$joins,'dn_reffer_no');
        
       //$data['delivery_data'] = $this->crm_modal->dn_to_credit_invoice($from_date,'dn_date',$to_date,'',$data1,'dn_customer',$data2,'dn_sales_order_num',$data3,'dn_id',$data4,'dpd_prod_det','crm_delivery_note',$joins,'dn_reffer_no',$joins1,'crm_delivery_product_details','dpd_prod_det');  
       
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
           $this->Pdf($data['delivery_data'],$data['from_dates'],$data['to_dates']);
       }
       
       $data['delivery_note_data'] = $this->common_model->FetchAllOrder('crm_delivery_note','dn_id','desc');

       $data['sales_orders_data'] = $this->common_model->FetchAllOrder('crm_sales_orders','so_id','desc');

       $data['products_data'] = $this->common_model->FetchAllOrder('crm_products','product_id','desc');
      
       $data['content'] = view('crm/dn_to_credit_invoice',$data);

       return view('crm/report-module-search',$data);
  
      
    }


    public function Pdf($delivery_data,$from_date,$to_date)
    {   
        
        if(!empty($delivery_data)){

            $title = "SQR";

            $pdf_data = "";
            $delivery_prod = 0;
            $invoice_amount = 0;
            $difference_amount = 0;
            foreach($delivery_data as $del_note){
                $new_date = date('d-M-Y',strtotime($del_note->dn_date));
                $total_sales_amount = format_currency($del_note->dn_total_amount);
                $pdf_data .="<tr>
                                <td style='border-top: 2px solid'>{$new_date}</td>
                                <td style='border-top: 2px solid'>{$del_note->dn_reffer_no}</td>
                                <td style='border-top: 2px solid'>{$del_note->cc_customer_name}</td>
                                <td style='border-top: 2px solid'>{$del_note->so_reffer_no}</td>
                                <td style='border-top: 2px solid'>{$del_note->dn_lpo_reference}</td>
                                <td style='border-top: 2px solid'>{$total_sales_amount}</td>
                                <td colspan='5' align='left' class='p-0' style='border-top: 2px solid'>
                                    <table>";
                                        foreach($del_note->delivery_products as $del_prod){
                                            $sales_amount = format_currency($del_prod->dpd_total_amount);

                                            $sales_rate = format_currency($del_prod->dpd_prod_rate);

                                            $sales_discount = format_currency($del_prod->dpd_prod_dicount);

                                            $pdf_data .="<tr  class='product-row'>
                                                            <td  width='100px' height='90px'>{$del_prod->product_details}</td>
                                                            <td  width='100px' align='center' height='90px'>{$del_prod->dpd_current_qty}</td>
                                                            <td  align='right' width='100px' height='90px'>{$sales_rate}</td>
                                                            <td align='right' width='100px' height='90px'>{$sales_discount}%</td>
                                                            <td align='right' width='100px' height='90px'>{$sales_amount}</td>
                                                        </tr>";
                                                        $delivery_prod  =  $del_prod->dpd_total_amount +  $delivery_prod;
                                        }
                                    $pdf_data .="</table>
                                </td>

                                <td colspan='6' align='left' class='p-0' style='border-top: 2px solid'>" ;
                                    if(!empty($del_note->credit_invoices)){
                                        $pdf_data .="<table>";
                                            foreach($del_note->credit_invoices as $credit_inv){
                                                $j=1;
                                                foreach($credit_inv->invoices_product as $inv_prod){ 

                                                    $pdf_data .="<tr style='background: unset;border-bottom: hidden !important;' class='invoice-row'>";
                                                        if($j==1){
                                                            $pdf_data .="<td width='100px' height='90px'>{$credit_inv->cci_reffer_no}</td>";
                                                        } else{
                                                            $pdf_data .="<td width='100px' height='90px'></td>";
                                                        }

                                                    $pdf_data .= "";
                                                                  if(!empty($credit_inv->invoices_product)){
                                                                    $pdf_data .= "<td width='100px'>----</td>";
                                                                  }
                                                                  
                                                    $pdf_data .= "</tr>";
                                                    $j++;
                                                }
                                            }
                                        $pdf_data .="</table>";
                                    } else{
                                        $pdf_data .="<table>";
                                                        foreach($del_note->delivery_products as $del_prod){

                                                        $pdf_data .="<tr class='invoice-row' style='background: unset;border-bottom: hidden !important;'>
                                                            
                                                        <td width='100px' height='90px'></td>
                                                        <td width='100px' height='90px'>{$del_prod->dpd_total_amount}</td>
                                                            
                                                        </tr>";

                                                        $difference_amount = $del_prod->dpd_total_amount + $difference_amount;
                                                         
                                                        }

                                        $pdf_data .="</table>"; 
                                    }
                                $pdf_data .="</td>


                              

                               



                            </tr>";

            }

            if(empty($from_date) && empty($to_date))
            {
             
               $dates = "";
            }
            else
            {
               $dates = $from_date . " to " . $to_date;
            }


            
           // $mpdf = new \Mpdf\Mpdf();
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


            $mpdf->SetTitle('Delivery Note to Credit Invoice Report'); // Set the title

            $delivery_prod = format_currency($delivery_prod);

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
            <td align="right"><h3>Delivery Note to Credit Invoice Report</h3></td>
        
            </tr>
        
            </table>

           
        
            <table  width="100%" style="margin-top:2px;border-collapse: collapse; border-spacing: 0;border-top:2px solid;">
            
        
            <tr>
            
                <th align="left">Date</th>

                <th align="left" width="100px">Delivery Note</th>

                <th align="left">Customer</th>
            
                <th align="left" width="100px">Sales Order </th>
            
                <th align="left" width="100px">LPO Ref</th>
            
                <th align="right">Amount</th>

                <th align="left">Product</th>

                <th align="center">Quantity</th>

                <th align="right" width="100px">Rate</th>

                <th align="right" width="100px">Discount</th>

                <th align="right" width="100px">Amount</th>

                <th align="left" width="100px">Invoice Ref</th>

                 <th align="left" width="100px">Difference</th>

            </tr>

             
            '.$pdf_data.'


            <tr>
                
                <td style="border-top: 2px solid;">Total</td>
                <td style="border-top: 2px solid;"></td>
                <td style="border-top: 2px solid;"></td>
                <td style="border-top: 2px solid;"></td>
                <td style="border-top: 2px solid;"></td>
                <td style="border-top: 2px solid;"><b>'.$delivery_prod.'</b></td>
                <td style="border-top: 2px solid;"></td>
                <td style="border-top: 2px solid;"></td>
                <td style="border-top: 2px solid;"></td>
                <td style="border-top: 2px solid;"></td>
                <td style="border-top: 2px solid;" align="right"><b>'.$delivery_prod.'</b></td>
                <td style="border-top: 2px solid;"></td>
                <td style="border-top: 2px solid;"></td>
                
                
            
            </tr> 



           
            
            </table>


        
            ';
        
            //$footer = '';
             
            //echo $html; exit();
            
            $mpdf->WriteHTML($html);
           // $mpdf->SetFooter($footer);
            $this->response->setHeader('Content-Type', 'application/pdf');
            $mpdf->Output($title . '.pdf', 'I');
        
        }

       
    }
   

    








}
