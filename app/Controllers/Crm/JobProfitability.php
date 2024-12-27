<?php

namespace App\Controllers\Crm;

use App\Controllers\BaseController;


class JobProfitability extends BaseController
{
    
    



    //view page
    public function index()
    {   
        $data['customer_creation'] = $this->common_model->FetchAllOrder('crm_customer_creation','cc_id','desc');

        $data['sales_orders_data'] = $this->common_model->FetchAllOrder('crm_sales_orders','so_id','desc');

        $data['sales_executive'] = $this->common_model->FetchAllOrder('executives_sales_executive','se_id','desc');
        
        $data['content'] = view('crm/job_profitability',$data);

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
            /*array(
                'table' => 'crm_customer_creation',
                'pk'    => 'cc_id',
                'fk'    => 'so_customer',
            ),*/
           

        );
      
        $data['result'] = $this->common_model->ReportFetchLimit('crm_customer_creation','cc_id','asc',$term,$start,$end,$joins,'cc_customer_name');
    
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
        if(!empty($_GET["form_date"]))
        {
            $from_date = $_GET["form_date"];
        }
        else
        {
            $from_date = "";
        }

        if(!empty($_GET["to_date"]))
        {
            $to_date = $_GET["to_date"];
        }
        else
        {
            $to_date = "";
        }

        if(!empty($_GET["customer"]))
        {
            $data1 = $_GET["customer"];
        }
        else
        {
            $data1 = "";
        }

        if(!empty($_GET["sales_order"]))
        {
            $data2 = $_GET["sales_order"];
        }
        else
        {
            $data2 = "";
        }


        if(!empty($_GET["sales_executive"]))
        {
            $data3 = $_GET["sales_executive"];
        }
        else
        {
            $data3 = "";
        }


        $joins = array(
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
        );

      
       
        //$data['sales_orders'] = $this->crm_modal->job_profitability($from_date,'so_date',$to_date,'',$data1,'so_customer',$data2,'so_reffer_no',$data3,'so_sales_executive','','','crm_sales_orders',$joins,'so_reffer_no');  
        
        
        $data['sales_orders'] = $this->crm_modal->job_profitability($from_date,'so_date',$to_date,'',$data1,'so_customer',$data2,'so_reffer_no',$data3,'so_sales_executive');  

        
        

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

        $data['sales_executive'] = $this->common_model->FetchAllOrder('executives_sales_executive','se_id','desc');
        
        $data['content'] = view('crm/job_profitability',$data);
 
        return view('crm/report-module-search',$data);
      
    }



    
    public function Pdf($sales_orders,$from_date,$to_date)
    {   
        
        if(!empty($sales_orders)){

            $title = "SQR";

            

            $expenses1 = 0;
            $expenses2 = 0;
            $expenses3 = 0;
            $expenses4 = 0;
            $expenses5 = 0;

            $gross_profit1 = 0;
            $gross_profit2 = 0;
            $gross_profit3 = 0;
            $gross_profit4 = 0;
            $gross_profit5 = 0;

            $percentage1 = 0;
            $percentage2 = 0;
            $percentage3 = 0;
            $percentage4 = 0;
            $percentage5 = 0;

            $revenue =0 ;
            
            
            $pdf_data ="";
            foreach($sales_orders as $sale_data){
                $new_date = date('d-M-Y',strtotime($sale_data->so_date));
               
                $pdf_data .="<tr>
                                <td style='border-top: 2px solid' width='40px'>{$new_date}</td>
                                <td style='border-top: 2px solid' width='100px'>{$sale_data->so_reffer_no}</td>\
                                <td style='border-top: 2px solid' width='100px'>{$sale_data->cc_customer_name}</td>
                                <td colspan='1' align='left' class='p-0' style='border-top: 2px solid'>
                                    <table>";
                                    
                                    if(!empty($sale_data->purchase_vouchers)){
                                                                
                                        foreach ($sale_data->purchase_vouchers as $pur_vouch) {
                                            $pdf_data .="<tr><td  width='100px'>{$pur_vouch->pv_reffer_id}</td></tr>";
                                        }
                                    
                                    }

                                    if(!empty($sale_data->purchase_return_prod)){

                                        foreach($sale_data->purchase_return_prod as $pv_prod){
                                            
                                            $pdf_data .="<tr><td  width='100px'>{$pv_prod->pr_reffer_id}</td></tr>";
                                        }
                                    }

                                    $pdf_data .="</table>

                                
                                </td>

                                <td style='border-top: 2px solid' width='100px'>{$sale_data->so_lpo}</td>

                                <td style='border-top: 2px solid' width='100px'>{$sale_data->se_name}</td>

                                <td style='border-top: 2px solid' width='100px' align='right'> " . (is_numeric($sale_data->so_amount_total) ? format_currency($sale_data->so_amount_total) : 'N/A') . "</td>";
                               

                                $revenue = $sale_data->so_amount_total + $revenue;

                                $pdf_data .="<td colspan='3' align='left' class='p-0' style='border-top: 2px solid'>
                                     
                                    <table>";
                                    
                                    if(!empty($sale_data->purchase_vouchers)){
                                                                
                                        foreach ($sale_data->purchase_vouchers as $pur_vouch) { 

                                            $expenses1  = $pur_vouch->pvp_amount + $expenses1;
                                                                    
                                            $gross_profit =  $sale_data->so_amount_total - $pur_vouch->pvp_amount; 
                                             
                                            $pdf_data .= "<tr>
                                                            
                                                            <td width='100px' align='right'>" . (is_numeric($pur_vouch->pvp_amount) ? format_currency($pur_vouch->pvp_amount) : 'N/A') . "</td>
                                                            <td width='100px' align='right'>" . (is_numeric($gross_profit) ? format_currency($gross_profit) : 'N/A') . "</td>";
                                                            
                                                            $gross_profit1 =  $gross_profit +   $gross_profit1; 

                                                            $percentage = $gross_profit * 100;

                                                            $percentage1 =  $percentage +  $percentage1;

                                                            $pdf_data .= "<td width='100px' align='right'>" . (is_numeric($percentage) ? format_currency($percentage) : 'N/A') . "</td>";

                                            
                                            $pdf_data .= "</tr>";
                                        }
                                    }



                                    if(!empty($sale_data->purchase_return_prod)){
                                                                
                                        foreach ($sale_data->purchase_return_prod as $pv_prod) { 

                                            $expenses2  = $pv_prod->prp_rate + $expenses2;
                                                                    
                                            $gross_profit =  $sale_data->so_amount_total - $pv_prod->prp_rate;
                                                                            
                                            $gross_profit2 =  $gross_profit +   $gross_profit2; 
                                                                            
                                             
                                            $pdf_data .= "<tr>
                                                            
                                                            <td width='100px' align='right'>" . (is_numeric($pv_prod->prp_rate) ? format_currency($pv_prod->prp_rate) : 'N/A') . "</td>
                                                            <td width='100px' align='right'>" . (is_numeric($gross_profit) ? format_currency($gross_profit) : 'N/A') . "</td>";
                                                            
                                                            $percentage = $gross_profit * 100;
                                                                          
                                                            $percentage2 =  $percentage +  $percentage2;


                                                            $pdf_data .= "<td width='100px' align='right'>" . (is_numeric($percentage) ? format_currency($percentage) : 'N/A') . "</td>";

                                            
                                            $pdf_data .= "</tr>";
                                        }
                                    }



                                    if(!empty($sale_data->petty_cash)){
                                                                
                                        foreach ($sale_data->petty_cash as $p_cash) { 

                                            $expenses3  = $p_cash->pci_amount + $expenses3;

                                            $gross_profit =  $sale_data->so_amount_total - $p_cash->pci_amount; 

                                            $gross_profit3 =  $gross_profit +   $gross_profit3;
                                                                            
                                             
                                            $pdf_data .= "<tr>
                                                            
                                                            <td width='100px' align='right'>" . (is_numeric($p_cash->pci_amount) ? format_currency($p_cash->pci_amount) : 'N/A') . "</td>
                                                            <td width='100px' align='right'>" . (is_numeric($gross_profit) ? format_currency($gross_profit) : 'N/A') . "</td>";
                                                            
                                                            $percentage = $gross_profit * 100;

                                                            $percentage3 =  $percentage + $percentage3;


                                                            $pdf_data .= "<td width='100px' align='right'>" . (is_numeric($percentage) ? format_currency($percentage) : 'N/A') . "</td>";

                                            
                                            $pdf_data .= "</tr>";
                                        }
                                    }


                                    if(!empty($sale_data->journal_voucher)){
                                                                
                                        foreach ($sale_data->journal_voucher as $jour_vouch) { 

                                          
                                            $pdf_data .= "<tr>";
                                                           
                                                            

                                                            if(!empty($jour_vouch->ji_debit)){

                                                                $pdf_data .="<td width='100px' align='right'>" . (is_numeric($jour_vouch->ji_debit) ? format_currency($jour_vouch->ji_debit) : 'N/A') . "</td>";

                                                                $expenses4  = $jour_vouch->ji_debit + $expenses4;
                                                                          
                                                                $gross_profit =  $sale_data->so_amount_total - $jour_vouch->ji_debit;
                                                                
                                                                $gross_profit4 =  $gross_profit +   $gross_profit4;

                                                                $pdf_data .="<td width='100px' align='right'>" . (is_numeric($gross_profit) ? format_currency($gross_profit) : 'N/A') . "</td>";

                                                                $percentage = $gross_profit * 100;

                                                                $percentage4 =  $percentage +  $percentage4;

                                                                $pdf_data .="<td width='100px' align='right'>" . (is_numeric($percentage) ? format_currency($percentage) : 'N/A') . "</td>";

                                                            }

                                                            elseif($jour_vouch->ji_credit){

                                                                $pdf_data .="<td width='100px' align='right'>" . (is_numeric($jour_vouch->ji_credit) ? format_currency($jour_vouch->ji_credit) : 'N/A') . "</td>";
                                                                
                                                                $expenses5  = $jour_vouch->ji_credit + $expenses5;

                                                                $gross_profit =  $sale_data->so_amount_total - $jour_vouch->ji_credit;

                                                                $gross_profit5 =  $gross_profit +   $gross_profit5;

                                                                $pdf_data .="<td width='100px' align='right'>" . (is_numeric($gross_profit) ? format_currency($gross_profit) : 'N/A') . "</td>";
                                                                
                                                                $percentage5 = $gross_profit * 100; 

                                                                $percentage5 =  $percentage +  $percentage5;

                                                                $pdf_data .="<td width='100px' align='right'>" . (is_numeric($percentage) ? format_currency($percentage) : 'N/A') . "</td>";

                                                            }

                                                           

                                            
                                            $pdf_data .= "</tr>";
                                        }
                                    }

                                    $expenses =  $expenses1 + $expenses2 + $expenses3 + $expenses4 + $expenses5;

                                    $total_gross_profit = $gross_profit1 +  $gross_profit2 +  $gross_profit3 + $gross_profit4 +  $gross_profit5;
                                    
                                    $total_percentage =  $percentage1 + $percentage2 + $percentage3 + $percentage4 + $percentage5;

                                    
                                    $pdf_data .="</table>
                                
                                </td>

                                ";

                               
                               
                              
                          


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


            $mpdf->SetTitle('Job Profitability'); // Set the title

          

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
            <td align="right"><h3>Job Profitability</h3></td>
        
            </tr>
        
            </table>

           
        
            <table  width="100%" style="margin-top:2px;border-collapse: collapse; border-spacing: 0;border-top:2px solid;">
            
        
            <tr>
            
                <th align="center" width="40px">Date</th>
            
                <th align="center" width="100px">Sales Order Ref</th>
            
                <th align="center" width="100px">Customer Name</th>
            
                <th align="center" width="100px">Invoice Ref.</th>
            
                <th align="center" width="120px">LPO Ref</th>

                <th align="center" width="80px">Sales Executive</th>

                <th align="right" width="80px">Revenue</th>

                <th align="right" width="100px">Expenses</th>

                <th align="right" width="80px">Gross Profit</th>

                <th align="right" width="80px">%</th>

            
            </tr>

             
            '.$pdf_data.'


            <tr>

                <td style="border-top: 2px solid;" width="40px">Total</td>

                <td style="border-top: 2px solid;" width="100px"></td>

                <td style="border-top: 2px solid;" width="100px"></td>

                <td style="border-top: 2px solid;" width="100px"></td>

                <td style="border-top: 2px solid;" width="120px"></td>

                <td style="border-top: 2px solid;" width="80px"></td>
                
                <td style="border-top: 2px solid;" width="80px" align="right"><b>'.format_currency($revenue).'</b></td>

                <td style="border-top: 2px solid;" width="80px" align="right"><b>'.format_currency($expenses).'</b></td>

                <td style="border-top: 2px solid;" width="80px" align="right"><b>'.format_currency($total_gross_profit).'</b></td>

                <td style="border-top: 2px solid;" width="80px" align="right"><b>'.format_currency($total_percentage).'</b></td>

            
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
