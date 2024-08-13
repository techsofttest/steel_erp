<?php

namespace App\Controllers\Crm;

use App\Controllers\BaseController;


class BackLog extends BaseController
{
    
    



    //view page
    public function index()
    {   
        
        $data['sales_executive'] = $this->common_model->FetchAllOrder('executives_sales_executive','se_id','desc');
        
        $data['content'] = view('crm/backlog',$data);

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

        $data['sales_executive'] = $this->common_model->FetchAllOrder('executives_sales_executive','se_id','desc');

        $data['sales_orders'] = $this->crm_modal->FetchBacklog($from_date,'so_date',$to_date,'',$data1,'so_customer',$data2,'so_reffer_no','','','','','crm_sales_orders',$joins,'so_reffer_no');  
        
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
            $this->Pdf($data['sales_orders'],$data['from_dates'],$data['to_dates']);
        }
        
        $data['content'] = view('crm/backlog',$data);
 
        return view('crm/report-module-search',$data);
    
    }


    public function Pdf($sales_orders,$from_date,$to_date)
    {   
        
        if(!empty($sales_orders))
        {   
            $pdf_data = "";
            $sales_total = 0;
            $delivered_total = 0;
            $invoice_total = 0;
            $balance_total = 0;
            foreach($sales_orders as $sales_order){
                
                $new_date = date('d-m-Y', strtotime($sales_order->so_date));

                $pdf_data .="<tr>
                                <td style='border-top: 2px solid'>{$new_date}</td>
                                <td style='border-top: 2px solid'>{$sales_order->so_reffer_no}</td>
                                <td style='border-top: 2px solid'>{$sales_order->cc_customer_name}</td>
                                <td style='border-top: 2px solid'>{$sales_order->so_lpo}</td>
                                <td style='border-top: 2px solid'>{$sales_order->se_name}</td>
                                <td style='border-top: 2px solid'>{$sales_order->so_amount_total}</td>";
                                
                                $sales_total = $sales_order->so_amount_total + $sales_total;
                                
                                $delivery_amount = 0;

                                foreach($sales_order->sales_delivery as $del){

                                    $delivery_amount =  $del->dn_total_amount + $delivery_amount;

                                    $delivered_total = $delivery_amount + $delivered_total;
                                }

                                if(!empty($sales_order->sales_delivery)){ 
                                    
                                    $pdf_data .="<td style='border-top: 2px solid'>{$delivery_amount}</td>";

                                } else{
                                    $pdf_data .="<td style='border-top: 2px solid'>---</td>";
                                }

                                $invoiced_amount = 0;

                                
                                foreach($sales_order->cash_invoiced as $cash_inv)
                                {
                                    $invoiced_amount =  $cash_inv->ci_total_amount + $invoiced_amount;

                                    $invoice_total =  $invoiced_amount + $invoice_total;
                                }

                                if(!empty($sales_order->cash_invoiced)){

                                    $pdf_data .="<td style='border-top: 2px solid'>{$invoiced_amount}</td>";

                                } else{

                                    $pdf_data .="<td style='border-top: 2px solid'>----</td>";
                                }

                                if(!empty($sales_order->sales_delivery)){
                                    
                                    $balance =  $sales_order->so_amount_total - $delivery_amount;

                                    $balance_total = $balance + $balance_total;
                                    
                                    $pdf_data .="<td style='border-top: 2px solid'>{$balance}</td>";

                                } else{

                                    $pdf_data .="<td style='border-top: 2px solid'>----</td>";
                                }
                               

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

            $title = "SQR";

           // $mpdf = new \Mpdf\Mpdf();

           $mpdf = new \Mpdf\Mpdf([
            'format' => [300, 400], // Custom page size in millimeters
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 10,
            'margin_bottom' => 10,
            ]);


            $mpdf->SetTitle('Backlog'); // Set the title

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
            <td align="right"><h3>Backlog</h3></td>
        
            </tr>
        
            </table>

           
        
            <table  width="100%" style="margin-top:2px;border-collapse: collapse; border-spacing: 0;border-top:2px solid;">
            
        
            <tr>
            
            <th align="left">Date</th>
        
            <th align="left">Sales Order</th>
        
            <th align="left">Customer</th>

            <th align="left">LPO Ref</th>
        
            <th align="left">Sales Executive</th>
        
            <th align="left">Amount</th>

            <th align="left">Delivered</th>

            <th align="left">Invoiced</th>

            <th align="left">Balance</th>
 
            
            </tr>

             
            '.$pdf_data.'


            <tr>
            
                <td style="border-top: 2px solid;">Total</td>
                <td style="border-top: 2px solid;"></td>
                <td style="border-top: 2px solid;"></td>
                <td style="border-top: 2px solid;"></td>
                <td style="border-top: 2px solid;"></td>
                <td style="border-top: 2px solid;">'.$sales_total.'</td>
                <td style="border-top: 2px solid;">'.$delivered_total.'</td>
                <td style="border-top: 2px solid;">'.$invoice_total.'</td>
                <td style="border-top: 2px solid;">'.$balance_total.'</td>
               
                
                
            
            </tr>


            
           
           
            
            </table>


        
            ';
        
            //$footer = '';
        
          
            $mpdf->WriteHTML($html);
           // $mpdf->SetFooter($footer);
            $this->response->setHeader('Content-Type', 'application/pdf');
            $mpdf->Output($title . '.pdf', 'I');
        
        }

       
    }





}
