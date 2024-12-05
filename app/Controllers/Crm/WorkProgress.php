<?php

namespace App\Controllers\Crm;

use App\Controllers\BaseController;


class WorkProgress extends BaseController
{
    
    



    //view page
    public function index()
    {   
        $data['customer_creation'] = $this->common_model->FetchAllOrder('crm_customer_creation','cc_id','desc');

        $data['products_data'] = $this->common_model->FetchAllOrder('crm_products','product_id','desc');

        $data['sales_executive_data'] = $this->common_model->FetchAllOrder('executives_sales_executive','se_id','desc');
        
        $data['content'] = view('crm/work-progress',$data);

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

        $data['work_progress'] = $this->crm_modal->PurchaseVoucher($from_date,'	pv_date');  
        

        if(!empty($from_date))
        {
            $data['from_dates'] = date('d-M-Y',strtotime($from_date));
        }
        else
        {
            $data['from_dates'] ="";
        } 
        

     

        if(!empty($_POST['pdf']) || (isset($_GET['action']) && $_GET['action'] == "Print"))
        {
            $this->Pdf($data['work_progress'],$data['from_dates']);
        }

        $data['customer_creation'] = $this->common_model->FetchAllOrder('crm_customer_creation','cc_id','desc');

        $data['products_data'] = $this->common_model->FetchAllOrder('crm_products','product_id','desc');

        $data['sales_executive'] = $this->common_model->FetchAllOrder('executives_sales_executive','se_id','desc');
        
        $data['sales_executive_data'] = $this->common_model->FetchAllOrder('executives_sales_executive','se_id','desc');
       
        $data['content'] = view('crm/work-progress',$data);

      

        return view('crm/report-module-search',$data);
        
    }



    public function Pdf($work_progress,$from_date)
    {   
       
        if(!empty($work_progress))
        {   
            $pdf_data = "";
            $total_amount = 0; 

            foreach($work_progress as $work_prog){

                $hasData = false;
                foreach ($work_prog->purchase_voucher_prod as $pur_vou_prod) {
                    if (!empty($pur_vou_prod->purchase_sales_order)) {
                        $hasData = true;
                        break;
                    }
                }

                if (!$hasData) {
                    // Skip this iteration if all purchase_sales_order are empty
                    continue;
                }

                $pdf_data .="<tr>
                                <td  style='width:150px;border-top: 2px solid' align='center'>{$work_prog->pv_reffer_id}</td>
                                <td  style='width:200px;border-top: 2px solid' align='center'>{$work_prog->ven_name}</td>
                                <td  style='width:200px;border-top: 2px solid' align='center'>{$work_prog->pv_vendor_inv}</td>
                                <td colspan='2'  class='p-0' style='border-top: 2px solid'>
                                    <table>";

                                        foreach ($work_prog->purchase_voucher_prod as $pur_vou_prod) {
                                            
                                            $pur_vou_amount = format_currency($pur_vou_prod->pvp_amount);
                                            
                                            $total_amount  = $pur_vou_prod->pvp_amount + $total_amount;

                                            $pdf_data .="<tr style='background: unset;border-bottom: hidden !important;'>";

                                            if (!empty($pur_vou_prod->purchase_sales_order)) {

                                                foreach ($pur_vou_prod->purchase_sales_order as $pur_sales_ord) {
                                                            
                                                    $pdf_data .="<td  style='width:150px' align='center'>{$pur_sales_ord->so_reffer_no}</td>";
                                                
                                                }
                                                
                                                $pdf_data .="<td  style='width:100px;' align='right'>{$pur_vou_amount}</td>";
                                            }

                                            $pdf_data .="</tr>";
                                        }
                                

                                    $pdf_data .= "</table>
                                    
                                </td>";

                                
                                

                $pdf_data .="</tr>";
                            
            
                
            }




            
            if(empty($from_date)  )
            {
             
               $dates = "";
            }
            else
            {
               $dates = $from_date;
            }

            $title = "SQR";

           // $mpdf = new \Mpdf\Mpdf();

           
           $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
           $fontDirs = $defaultConfig['fontDir'];

           $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
           $fontData = $defaultFontConfig['fontdata'];


           $mpdf = new \Mpdf\Mpdf([
            'format' => 'Letter', // Custom page size in millimeters
            //'format' => [300, 600], // Width: 300mm, Height: 600mm (custom large page)
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
                
        
        
       
        

            

            $mpdf->SetTitle('Work In Progress'); // Set the title

            //$sales_amount = format_currency($sales_amount);
            
            //$sales_diff_amount = format_currency($sales_diff_amount);


           // $total_quot_amount = format_currency($total_quot_amount);

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
            <td align="right"><h3>Work In Progress</h3></td>
        
            </tr>
        
            </table>

           
        
            <table  width="100%" style="margin-top:2px;border-collapse: collapse; border-spacing: 0;border-top:2px solid;">
            
        
            <tr>
            
            <th align="center" width="150px" style="border-top: 2px solid">Purchase Voucher</th>
        
            <th align="center" width="200px" style="border-top: 2px solid">Vendor</th>
        
            <th align="center" width="200px" style="border-top: 2px solid">Vendor Invoice Reff</th>
        
            <th align="center" width="150px" style="border-top: 2px solid">Sales Order Reff</th>

            <th align="center" width="100px" style="border-top: 2px solid">Amount</th>

           
            

            

         
            </tr>

             
            '.$pdf_data.'

            <tr>

                <td style="border-top: 2px solid;" width="150px">Total</td>
                <td style="border-top: 2px solid;" width="200px"></td>
                <td style="border-top: 2px solid;" width="200px"></td>
                <td colspan="2"  class="p-0" style="border-top: 2px solid">
                    <table>
                      
                       <tr style="background: unset;border-bottom: hidden !important;">
                            <td style="" width="150px"></td>
                            <td style="" align="right" width="100px">'.format_currency($total_amount).'</td>
                    
                        </tr>
                    
                    </table>
                    
                </td>
                
               
                
            
            </tr>
            
            </table>


        
            ';
           //echo $html; exit();
        
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