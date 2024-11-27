<?php

namespace App\Controllers\Crm;

use App\Controllers\BaseController;


class InvoiceReport extends BaseController
{
    
    



    //view page
    public function index()
    {   
        $data['customer_creation'] = $this->common_model->FetchAllOrder('crm_customer_creation','cc_id','desc');

        $data['sales_executive'] = $this->common_model->FetchAllOrder('executives_sales_executive','se_id','desc');

        $data['sales_orders_data'] = $this->common_model->FetchAllOrder('crm_sales_orders','so_id','desc');

        $data['products_data'] = $this->common_model->FetchAllOrder('crm_products','product_id','desc');
        
        $data['content'] = view('crm/invoice_report',$data);

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

       $joins = array(
        
            array(
                'table' => 'crm_customer_creation',
                'pk'    => 'cc_id',
                'fk'    => 'so_customer',
            ),
            array(
                'table' => 'crm_delivery_note',
                'pk'    => 'dn_sales_order_num',
                'fk'    => 'so_id',
            ),
          

        );

       //$data['sales_orders'] = $this->crm_modal->invoice_report($from_date,'so_date',$to_date,'',$data1,'so_customer',$data2,'so_id',$data3,'spd_product_details','','','crm_sales_orders','so_reffer_no');
        
       $data['sales_orders'] = $this->crm_modal->invoice_report($from_date,$to_date,$customer,$sales_order,$product);
        
      

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

        $data['sales_orders_data'] = $this->common_model->FetchAllOrder('crm_sales_orders','so_id','desc');

        $data['products_data'] = $this->common_model->FetchAllOrder('crm_products','product_id','desc');


        $data['content'] = view('crm/invoice_report',$data);

        return view('crm/report-module-search',$data);

    }


    public function Pdf($sales_orders,$from_date,$to_date)
    {   
        
        if(!empty($sales_orders)){

            $title = "SQR";

            $sales_total = 0;
            $invoice_total = 0;
            $pdf_data ="";
            foreach($sales_orders as $sale_data){
                $new_date = date('d-M-Y',strtotime($sale_data->date));
               
                $pdf_data .="<tr>
                                <td style='border-top: 2px solid' width='40px'>{$new_date}</td>
                                <td style='border-top: 2px solid' width='100px'>{$sale_data->reference}</td>
                                <td style='border-top: 2px solid' width='100px'>{$sale_data->customer_name}</td>
                                <td style='border-top: 2px solid' width='100px'>{$sale_data->delivery_reff}</td>
                                <td style='border-top: 2px solid' width='120px'>{$sale_data->sales_order}</td>
                                <td style='border-top: 2px solid' width='80px'>{$sale_data->sales_lpo}</td>
                                <td style='border-top: 2px solid' width='80px' align='right'>".format_currency($sale_data->amount)."</td>
                                <td style='border-top: 2px solid' width='100px'>{$sale_data->product}</td>
                                <td style='border-top: 2px solid' width='80px' align='center'>{$sale_data->quantity}</td>
                                <td style='border-top: 2px solid' width='8px' align='right'>{$sale_data->rate}</td>
                                <td style='border-top: 2px solid' width='80px' align='center'>{$sale_data->discount}%</td>
                                <td style='border-top: 2px solid' width='80px' align='right'>".format_currency($sale_data->prod_amount)."</td>";
                               
                                $invoice_total =  $sale_data->prod_amount + $invoice_total; 

                                $sales_total =  $sale_data->amount + $sales_total;
                              
                          


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


            $mpdf->SetTitle('Invoice Report'); // Set the title

          

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
            <td align="right"><h3>Invoice Report</h3></td>
        
            </tr>
        
            </table>

           
        
            <table  width="100%" style="margin-top:2px;border-collapse: collapse; border-spacing: 0;border-top:2px solid;">
            
        
            <tr>
            
                <th align="ceneter" width="40px">Date</th>
            
                <th align="ceneter" width="100px">Invoice Ref.</th>
            
                <th align="ceneter" width="100px">Customer</th>
            
                <th align="ceneter" width="100px">Delivery Note Ref.</th>
            
                <th align="ceneter" width="120px">Sales Order Ref.</th>

                <th align="ceneter" width="80px">Lpo Ref.</th>

                <th align="ceneter" width="80px">Amount</th>

                <th align="ceneter" width="100px">Product</th>

                <th align="ceneter" width="80px">Quantity</th>

                <th align="ceneter" width="80px">Rate</th>

                <th align="ceneter" width="80px">Discount</th>

                <th align="ceneter" width="80px">Amount</th>


                

            
            </tr>

             
            '.$pdf_data.'


            <tr>

                <td style="border-top: 2px solid;" width="40px">Total</td>

                <td style="border-top: 2px solid;" width="100px"></td>

                <td style="border-top: 2px solid;" width="100px"></td>

                <td style="border-top: 2px solid;" width="100px"></td>

                <td style="border-top: 2px solid;" width="120px"></td>

                <td style="border-top: 2px solid;" width="80px"></td>

                <td style="border-top: 2px solid;" width="80px" align="right">'.format_currency($sales_total).'</b></td>

                <td style="border-top: 2px solid;" width="100px"></td>

                <td style="border-top: 2px solid;" width="80px"></td>

                <td style="border-top: 2px solid;" width="80px"></td>

                <td style="border-top: 2px solid;" width="80px"></td>
                
                <td style="border-top: 2px solid;" width="80px">'.format_currency($invoice_total).'</td>



                
            
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
