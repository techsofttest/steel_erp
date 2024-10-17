<?php

namespace App\Controllers\Crm;

use App\Controllers\BaseController;


class SalesQuotAnalysisReport extends BaseController
{
    
    



    //view page
    public function index()
    {   
        $data['customer_creation'] = $this->common_model->FetchAllOrder('crm_customer_creation','cc_id','desc');

        $data['sales_executive'] = $this->common_model->FetchAllOrder('executives_sales_executive','se_id','desc');
        
        $data['content'] = view('crm/sales-quot-analysis-report',$data);

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
      
        //$data['result'] = $this->common_model->FetchAllLimit('crm_customer_creation','cc_customer_name','asc',$term,$start,$end);
        
        $joins = array(
            array(
                'table' => 'crm_customer_creation',
                'pk'    => 'cc_id',
                'fk'    => 'qd_customer',
            ),
           

        );
      
        $data['result'] = $this->common_model->ReportFetchLimit('crm_quotation_details','qd_customer','asc',$term,$start,$end,$joins,'qd_customer');
    
        $data['total_count'] =count($data['result']);

        return json_encode($data);

    }


    //fetch executive by customer
    public function FetchData()
    {
        //fetch executive
        $cond = array('qd_customer'=>$this->request->getPost('ID'));

        $joins = array(
            array(
                'table' => 'executives_sales_executive',
                'pk'    => 'se_id',
                'fk'    => 'qd_sales_executive',
            ),
           

        );


        $quotation_details = $this->common_model->FetchWhereUniqueJoin('crm_quotation_details',$cond,$joins,'se_id');
       

        $data['quot_det'] = "<option value='' selected disabled>Select Sales Executive</option>"; 

        foreach($quotation_details as $quot_det)
        {
            $data['quot_det'] .='<option value='.$quot_det->se_id.'>'.$quot_det->se_name.'</option>';
            
        }


        //fetch product

        $product_data = $this->common_model->FetchProductByCustomer('crm_quotation_details',$this->request->getPost('ID'));
        
        
       
        $data['quot_prod'] = "<option value='' selected> Select Product</option>";
        $uniqueProductIds = []; // Array to store unique product IDs

        foreach ($product_data as $prod_data) {
            // Check if product_details array is not empty
            if (!empty($prod_data->product_details)) {
                foreach ($prod_data->product_details as $product_detail) {
                    // Check if the product ID is not already processed
                    if (!in_array($product_detail->product_id, $uniqueProductIds)) {
                        // Add the product ID to the array of unique IDs
                        $uniqueProductIds[] = $product_detail->product_id;
                        // Add the option for this product to the dropdown
                        $option_value = $product_detail->product_id;
                        $option_text = $product_detail->product_details;
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
       
        //Filter 
         
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

        if(!empty($_GET['sales_executive']))
        {
            $data2 = $_GET['sales_executive'];
        }
        else
        {
            $data2 = "";
        }

        if(!empty($_GET['product']))
        {
            $data3 = $_GET['product'];
        }
        else
        {
            $data3 = "";
        }
        

        $joins = array(
            
            array(
                'table' => 'crm_quotation_product_details',
                'pk'    => 'qpd_quotation_details',
                'fk'    => 'qd_id ',
            ),
            array(
                'table' => 'crm_customer_creation',
                'pk'    => 'cc_id',
                'fk'    => 'qd_customer',
            ),
            array(
                'table' => 'executives_sales_executive',
                'pk'    => 'se_id',
                'fk'    => 'qd_sales_executive',
            ),
           
           

        );


        $joins1 = array(
            array(
                'table' => 'crm_products',
                'pk'    => 'product_id',
                'fk'    => 'qpd_product_description',
            ),
        );

        $data['quotation_data'] = $this->crm_modal->sales_quot_analysis($from_date,'qd_date',$to_date,'',$data1,'qd_customer',$data2,'qd_sales_executive',$data3,'qpd_product_description','','','crm_quotation_details',$joins,'qd_reffer_no',$joins1,'qpd_quotation_details','crm_quotation_product_details');  
        
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
            $this->Pdf($data['quotation_data'],$data['from_dates'],$data['to_dates']);
        }

       
        $data['content'] = view('crm/sales-quot-analysis-report',$data);

        return view('crm/report-module-search',$data);
        
    }



    public function Pdf($quotation_data,$from_date,$to_date)
    {   
       
        if(!empty($quotation_data))
        {   
            $pdf_data = "";
            $total_quot_amount = 0;
            $sales_amount = 0;
            $sales_diff_amount = 0;
            foreach($quotation_data as $quot_data){

                $new_date = date('d-M-Y', strtotime($quot_data->qd_date));
            
                $pdf_data .= "<tr><td style='border-top: 2px solid'>{$new_date}</td>";
                $pdf_data .= "<td style='border-top: 2px solid' width='100'>{$quot_data->qd_reffer_no}</td>";
                $pdf_data .= "<td style='border-top: 2px solid'>{$quot_data->cc_customer_name}</td>";
                $pdf_data .= "<td style='border-top: 2px solid' width='100'>{$quot_data->se_name}</td>";
               
                $pdf_data .= "<td colspan='5' align='left' class='p-0' style='border-top: 2px solid'><table>";

               

                foreach($quot_data->quotation_product as $quot_prod){
                    $pdf_data .= "<tr style='background: unset;border-bottom: hidden !important;'>";
                    $pdf_data .= "<td width='100px'>{$quot_prod->product_details}</td>";
                    $pdf_data .= "<td width='100px' align='right'>{$quot_prod->qpd_quantity}</td>";

                    $rate = format_currency($quot_prod->qpd_rate);

                    $amount = format_currency($quot_prod->qpd_amount);

                    $pdf_data .= "<td width='100px' align='right'>{$rate}</td>";
                    $pdf_data .= "<td width='100px' align='right'>{$quot_prod->qpd_discount}</td>";
                    $pdf_data .= "<td width='100px' align='right'>{$amount}</td>";
                    $pdf_data .= "</tr>";
                    
                    $total_quot_amount = $quot_prod->qpd_amount + $total_quot_amount;

                }
            
                $pdf_data .= "</table></td>";
            
                if(!empty($quot_data->sales_orders)){
                    $pdf_data .= "<td colspan='2' align='right' class='p-0' style='border-top: 2px solid'><table>";
            
                    foreach($quot_data->sales_orders as $sal_ord){
                        $pdf_data .= "<tr style='background: unset;border-bottom: hidden !important;'>";
                        $pdf_data .= "<td width='100px'>{$sal_ord->so_reffer_no}</td>";
            
                        $so_pro_count = 1;
                        if(!empty($sal_ord->sales_product)){
                            foreach($sal_ord->sales_product as $sales_prod){
                                if($so_pro_count == 1){
                                   
                                    $amount2 = format_currency($sales_prod->spd_amount);

                                    $pdf_data .= "<td width='100px'>{$amount2}</td>";
                                    
                                    $sales_amount = $sales_prod->spd_amount + $sales_amount;

                                    $pdf_data .= "</tr>";
                                } else {
                                    $amount2 = format_currency($sales_prod->spd_amount);
                                    $pdf_data .= "<tr align='right' style='background: unset;border-bottom: hidden !important;'>";
                                    $pdf_data .= "<td width='100px'></td>";
                                    
                                    
                                    $pdf_data .= "<td width='100px'>{$amount2}</td>";
                                    $pdf_data .= "</tr>";

                                    $sales_amount = $sales_prod->spd_amount + $sales_amount;
                                }
                                $so_pro_count++;
                            }
                        } else {
                            $pdf_data .= "</tr>";
                        }
                    }
            
                    $pdf_data .= "</table></td>";
                } else {
                    $pdf_data .= "<td style='border-top: 2px solid'></td>
                                  <td style='border-top: 2px solid'></td>
                                
                    ";
                }

                if(!empty($quot_data->sales_orders)){
                    $pdf_data .= "<td align='right' style='border-top: 2px solid'>---</td>";  
                }else{

                    $pdf_data .="<td align='right' style='border-top: 2px solid'>{$quot_data->qpd_amount}</td>";

                    $sales_diff_amount = format_currency($quot_data->qpd_amount + $sales_diff_amount);
                }
            
                $pdf_data .= "</tr>";
            }
            
            if(empty($from_date) && empty($to_dat))
            {
             
               $dates = "";
            }
            else
            {
               $dates = $from_date . " to " . $to_date;
            }

            $title = "SQR";

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
                
        
        
       
        

            

            $mpdf->SetTitle('Sales Quotation Report'); // Set the title

            $sales_amount = format_currency($sales_amount);


            $total_quot_amount = format_currency($total_quot_amount);

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
            <td align="right"><h3>Sales Quotation Report</h3></td>
        
            </tr>
        
            </table>

           
        
            <table  width="100%" style="margin-top:2px;border-collapse: collapse; border-spacing: 0;border-top:2px solid;">
            
        
            <tr>
            
            <th align="left">Date</th>
        
            <th align="left" width="100px">Quotation Ref.</th>
        
            <th align="left">Customer</th>
        
            <th align="left" width="103px">Sales Executive</th>
        
            <th align="left" width="100px">Product</th>

            <th align="right" width="100px">Quantity</th>

            <th align="right" width="100px">Rate</th>

            <th align="right" width="100px">Discount</th>

            <th align="right" width="100px">Amount</th>

            <th align="right" width="100px">Sales Order</th>

             <th align="right" width="100px">Amount</th>

            <th align="right">Difference</th>

            

         
            </tr>

             
            '.$pdf_data.'

            <tr>

                <td style="border-top: 2px solid;">Total</td>
                <td style="border-top: 2px solid;"></td>
                <td style="border-top: 2px solid;"></td>
                <td style="border-top: 2px solid;"></td>
                <td style="border-top: 2px solid;"></td>
                <td style="border-top: 2px solid;"></td>
                <td style="border-top: 2px solid;"></td>
                <td style="border-top: 2px solid;"></td>
                <td style="border-top: 2px solid;" align="right">'.$total_quot_amount.'</td>
                <td style="border-top: 2px solid;"></td>
                <td style="border-top: 2px solid;" align="right">'.$sales_amount.'</td>
                <td style="border-top: 2px solid;" align="right">'.$sales_diff_amount.'</td>
            
            </tr>   
           
            
            </table>


        
            ';
        
            $mpdf->WriteHTML($html);

            // Generate the PDF content
           // Generate the PDF content but do not output it immediately (use 'S' to return it as a string)
           
           /*$pdf_content = $mpdf->Output('', 'S'); // 'S' returns the PDF as a string

            // Set headers for inline display with the correct filename
            $this->response->setHeader('Content-Type', 'application/pdf');
            $this->response->setHeader('Content-Disposition', 'inline; filename="Sales_Quotation_Report.pdf"');
            $this->response->setHeader('Content-Length', strlen($pdf_content)); // Optional but helps ensure the browser knows the size

            // Send the response with the PDF content
            $this->response->setBody($pdf_content);
            $this->response->send();*/
            
            ob_clean();

            $this->response->setHeader('Content-Type', 'application/pdf');
            $mpdf->Output($title . '.pdf', 'I');

            exit();


    }
            

           

       
    }





}
