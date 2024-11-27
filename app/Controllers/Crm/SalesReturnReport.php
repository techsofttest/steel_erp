<?php

namespace App\Controllers\Crm;

use App\Controllers\BaseController;


class SalesReturnReport extends BaseController
{
    
    



    //view page
    public function index()
    {   
        $data['customer_creation'] = $this->common_model->FetchAllOrder('crm_customer_creation','cc_id','desc');

        $data['products'] = $this->common_model->FetchAllOrder('crm_products','product_id','desc');

        $data['sales_orders'] = $this->common_model->FetchAllOrder('crm_sales_orders','so_id','desc');
        
        $data['content'] = view('crm/sales_return_report',$data);

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
                'fk'    => 'sr_customer',
            ),
           

        );
      
        $data['result'] = $this->common_model->ReportFetchLimit('crm_sales_return','sr_customer','asc',$term,$start,$end,$joins,'sr_customer');
    
        $data['total_count'] =count($data['result']);

        return json_encode($data);

    }



    


    //fetch executive by customer
    public function FetchData()
    {    
        //fetch sales order
        $cond = array('cci_customer'=>$this->request->getPost('ID'));

        $joins = array(

            array(
                'table' => 'crm_sales_orders',
                'pk'    => 'so_id',
                'fk'    => 'cci_sales_order',
            ),
        );


        $sales_refference = $this->common_model->FetchWhereUniqueJoin('crm_credit_invoice',$cond,$joins,'cci_sales_order');
        
        $data['sales_reff'] = '<option value="" selected disabled>Select Order Ref</option>';

        foreach($sales_refference as $sales_reff)
        {
            $data['sales_reff'] .='<option value='.$sales_reff->so_id.'>'.$sales_reff->so_reffer_no.'</option>';
            
        }

        

        
        //fetch product

        $product_data = $this->common_model->FetchCreditProdByCustomer('crm_credit_invoice',$this->request->getPost('ID'));
        
        $data['credit_prod'] = "<option value='' selected> Select Product</option>";
        $uniqueProductIds = []; // Array to store unique product IDs

        foreach ($product_data as $prod_data) {
            // Check if product_details array is not empty
            if (!empty($prod_data->credit_prod_details)) {
                foreach ($prod_data->credit_prod_details as $credit_prod_det) {
                    // Check if the product ID is not already processed
                    if (!in_array($credit_prod_det->product_id, $uniqueProductIds)) {
                        // Add the product ID to the array of unique IDs
                        $uniqueProductIds[] = $credit_prod_det->product_id;
                        // Add the option for this product to the dropdown
                        $option_value = $credit_prod_det->product_id;
                        $option_text = $credit_prod_det->product_details;
                        $data['credit_prod'] .= '<option value="' . $option_value . '">' . $option_text . '</option>';
                    }
                }
            } 
            /*else 
            {
                $data['credit_prod'] .= '<option value="">No Product Details Available</option>';
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
            $customer = $_GET['customer'];
        }
        else
        {
            $customer = "";
        }

        if(!empty($_GET['sales_order']))
        {
            $sales_order = $_GET['sales_order'];
        }
        else
        {
            $sales_order = "";
        }

        if(!empty($_GET['product']))
        {
            $product = $_GET['product'];
        }
        else
        {
            $product = "";
        }

         
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

        $data['invoice_reports'] = $this->crm_modal->return_report($from_date,'sr_date',$to_date,'',$customer,'sr_customer',$sales_order,'sr_sales_order',$product,'srp_prod_det');  
        
        if(!empty($_POST['pdf']) || (isset($_GET['action']) && $_GET['action'] == "Print"))
        {
           $this->Pdf($data['invoice_reports'],$data['from_dates'],$data['to_dates']);
        }
        
        $data['customer_creation'] = $this->common_model->FetchAllOrder('crm_customer_creation','cc_id','desc');

        $data['products'] = $this->common_model->FetchAllOrder('crm_products','product_id','desc');

        $data['sales_orders'] = $this->common_model->FetchAllOrder('crm_sales_orders','so_id','desc');

        $data['content'] = view('crm/sales_return_report',$data);

        return view('crm/report-module-search',$data);


        echo json_encode($data);
       
      
    }


    public function Pdf($invoice_reports,$from_date,$to_date)
    {   
        
        if(!empty($invoice_reports)){

            $title = "SQR";

            $sales_prod_amount = 0; 
            $sales_return_rate = 0;  
            $return_prod_amount = 0;
            $pdf_data ="";
            foreach($invoice_reports as $inv_rep){
                $new_date = date('d-M-Y',strtotime($inv_rep->sr_date));
               
                $pdf_data .="<tr>
                                <td style='border-top: 2px solid' width='40px'>{$new_date}</td>
                                <td style='border-top: 2px solid' width='100px'>{$inv_rep->sr_reffer_no}</td>
                                <td style='border-top: 2px solid' width='100px'>{$inv_rep->cc_customer_name}</td>
                                <td style='border-top: 2px solid' width='80px'>{$inv_rep->sr_invoice}</td>
                                <td style='border-top: 2px solid' width='100px'>{$inv_rep->so_reffer_no}</td>
                                <td style='border-top: 2px solid' width='80px'>{$inv_rep->sr_lpo_reff}</td>
                                <td style='border-top: 2px solid' width='80px'>{$inv_rep->se_name}</td>
                                <td style='border-top: 2px solid' width='100px' align='right'>{$inv_rep->so_amount_total}</td>";

                                $sales_prod_amount = $inv_rep->so_amount_total + $sales_prod_amount;

                                $pdf_data .="<td colspan='5' style='border-top: 2px solid'>
                                                <table>";

                                                foreach($inv_rep->return_product as $ret_prod){

                                                    $pdf_data .="<tr>
                                                    
                                                                    <td width='100px'>{$ret_prod->product_details}</td>
                                                                    <td  width='70px' align='center'>{$ret_prod->srp_quantity}</td>
                                                                    <td width='80px' align='right'>".format_currency($ret_prod->srp_rate)."</td>
                                                                    <td width='80px' align='center'>".format_currency($ret_prod->srp_discount)."</td>
                                                                    <td width='100px' align='right'>".format_currency($ret_prod->srp_amount)."</td>
                                                                   
                                                                   
                                                                    ";

                                                    
                                                    $pdf_data .="</tr>";

                                                    $sales_return_rate =  $ret_prod->srp_rate + $sales_return_rate;   $return_prod_amount = $ret_prod->srp_amount + $return_prod_amount;
                                                }

                                                $pdf_data .="</table>
                                            </td>";
                                
                        


                $pdf_data .="</tr>";

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
            
                <th align="ceneter" width="40px">Date</th>
            
                <th align="ceneter" width="100px">Sales Return</th>
            
                <th align="ceneter" width="100px">Customer</th>
            
                <th align="ceneter" width="80px">Invoice Ref</th>
            
                <th align="ceneter" width="100px">Sales Order.</th>

                <th align="ceneter" width="80px">Lpo Ref.</th>

                <th align="ceneter" width="80px">Sales Executive</th>

                <th align="ceneter" width="100px">Amount</th>

                <th colspan="5">
                   
                    <table>
                      
                        <tr>
                           
                            <th align="ceneter" width="100px">Product</th>

                            <th align="ceneter" width="70px">Quantity</th>

                            <th align="ceneter" width="80px">Rate</th>

                            <th align="ceneter" width="80px">Discount</th>

                            <th align="ceneter" width="100px">Amount</th>

                        
                        </tr>
                    
                    </table>
                
                </th>

                

                

            
            </tr>

             
            '.$pdf_data.'

              
            <tr>

                <td style="border-top: 2px solid" width="40px">Total</td>
                <td style="border-top: 2px solid" width="100px"></td>
                <td style="border-top: 2px solid" width="100px"></td>
                <td style="border-top: 2px solid" width="80px"></td>
                <td style="border-top: 2px solid" width="100px"></td>
                <td style="border-top: 2px solid" width="80px"></td>
                <td style="border-top: 2px solid" width="80px"></td>
                <td style="border-top: 2px solid" width="100px" align="right"><b>'.format_currency($sales_prod_amount).'</b></td>
                <td colspan="5" style="border-top: 2px solid">

                    <table>
                          
                        <tr>
                                                    
                            <td width="100px"></td>
                            <td  width="70px"></td>
                            <td width="80px" align="right"><b>'.format_currency($sales_return_rate).'</b></td>
                            <td width="80px"></td>
                            <td width="100px" align="right"><b>'.format_currency($return_prod_amount).'</b></td>

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
        
        }

       
    }





}
