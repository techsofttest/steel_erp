<?php

namespace App\Controllers\Crm;

use App\Controllers\BaseController;


class SalesSummery extends BaseController
{
    
    



    //view page
    public function index()
    {   
        $data['customer_creation'] = $this->common_model->FetchAllOrder('crm_customer_creation','cc_id','desc');

        $data['sales_executive'] = $this->common_model->FetchAllOrder('executives_sales_executive','se_id','desc');
        
        $data['content'] = view('crm/sales-summery',$data);

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
            /*array(
                'table' => 'crm_customer_creation',
                'pk'    => 'cc_id',
                'fk'    => 'cci_customer',
            ),*/
           

        );
      
        //$data['result'] = $this->common_model->ReportFetchLimit('crm_credit_invoice','cci_customer','asc',$term,$start,$end,$joins,'cci_customer');
        
        $data['result'] = $this->common_model->ReportFetchLimit('crm_customer_creation','cc_id','asc',$term,$start,$end,$joins,'cc_customer_name');
       
        $data['total_count'] =count($data['result']);

        return json_encode($data);

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


        if(!empty($_GET['sales_executive']))
        {
            $sales_executive = $_GET['sales_executive'];
        }
        else
        {
            $sales_executive = "";
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
            array(
                'table' => 'crm_cash_invoice',
                'pk'    => 'ci_sales_order',
                'fk'    => 'so_id',
            ),
            array(
                'table' => 'crm_credit_invoice',
                'pk'    => 'cci_sales_order',
                'fk'    => 'so_id',
            ),
           

        );

        
       
        //$data['sales_data'] = $this->crm_modal->sales_summery($from_date,'so_date',$to_date,'',$data1,'so_customer',$data2,'so_sales_executive','','','','','crm_sales_orders',$joins,'so_reffer_no');
        
        $data['sales_data'] = $this->crm_modal->sales_summery($from_date,$to_date,$customer,$sales_executive);
        

        $data['sales_executive'] = $this->common_model->FetchAllOrder('executives_sales_executive','se_id','desc');
        
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
           $this->Pdf($data['sales_data'],$data['from_dates'],$data['to_dates']);
           
        }
        

        $data['customer_creation'] = $this->common_model->FetchAllOrder('crm_customer_creation','cc_id','desc');

        $data['content'] = view('crm/sales-summery',$data);
        
        return view('crm/report-module-search',$data);
      
      
    }


    public function Pdf($sales_data,$from_date,$to_date)
    {   
        
        if(!empty($sales_data)){

            $title = "SQR";

            $total_amount = 0 ;
            $pdf_data ="";
            foreach($sales_data as $sale_data){
                $new_date = date('d-M-Y',strtotime($sale_data->date));
               
                $pdf_data .="<tr>
                                <td style='border-top: 2px solid' width='40px'>{$new_date}</td>
                                <td style='border-top: 2px solid' width='100px' align='center'>{$sale_data->reference}</td>
                                <td style='border-top: 2px solid' width='100px'>{$sale_data->customer_name}</td>
                                <td style='border-top: 2px solid' width='100px' align='center'>{$sale_data->sales_order}</td>
                                <td style='border-top: 2px solid' width='100px' align='center'>{$sale_data->sales_lpo}</td>
                                <td style='border-top: 2px solid' width='100px' align='center'>{$sale_data->sales_exec}</td>
                                <td style='border-top: 2px solid' width='100px' align='right'>".format_currency($sale_data->amount)."</td>";
                               

                                $total_amount =  $sale_data->amount + $total_amount;

                               
                                
                          


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


            $mpdf->SetTitle('Sales Summery Report'); // Set the title

          

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
            <td align="right"><h3>Sales Summery Report</h3></td>
        
            </tr>
        
            </table>

           
        
            <table  width="100%" style="margin-top:2px;border-collapse: collapse; border-spacing: 0;border-top:2px solid;">
            
        
            <tr>
            
                <th align="center" width="40px">Date</th>
            
                <th align="center" width="100px">Invoice Ref.</th>
            
                <th align="center" width="100px">Customer</th>
            
                <th align="center" width="100px">Sales Order Ref.</th>

                <th align="center" width="100px">Lpo Ref.</th>

                <th align="center" width="100px">Sales Executive</th>

                <th align="center" width="100px">Amount</th>


                

            
            </tr>

             
            '.$pdf_data.'

             
            <tr>
            
                <td style="border-top: 2px solid" width="40px"></td>
                <td style="border-top: 2px solid" width="100px"></td>
                <td style="border-top: 2px solid" width="100px"></td>
                <td style="border-top: 2px solid" width="100px"></td>
                <td style="border-top: 2px solid" width="100px"></td>
                <td style="border-top: 2px solid" width="100px"></td>
                <td style="border-top: 2px solid" width="100px" align="right">'.format_currency($total_amount).'</td>";
            
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
