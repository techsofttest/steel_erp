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
        /*$from_date       = date('Y-m-d',strtotime($this->request->getPost('form_date')));

        $to_date         = date('Y-m-d',strtotime($this->request->getPost('to_date')));

        $customer        = trim($this->request->getPost('customer'));

        $sales_executive = trim($this->request->getPost('sales_executive'));

        $product         = trim($this->request->getPost('product'));*/

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

        $data['quotation_data'] = $this->crm_modal->CheckData($from_date,'qd_date',$to_date,'',$data1,'qd_customer',$data2,'qd_sales_executive',$data3,'qpd_product_description','','','crm_quotation_details',$joins,'qd_reffer_no');  
        
        if(!empty($_POST['pdf']))
        {
            $this->Pdf($data['quotation_data']);
        }
        

        $data['content'] = view('crm/sales-quot-analysis-report',$data);

        return view('crm/report-module',$data);

       
      
    }



    public function Pdf($quotation_data)
    {   
        if(!empty($quotation_data))
        {   
            $pdf_data = "";

            $joins1 = array(
            
                array(
                    'table' => 'crm_products',
                    'pk'    => 'product_id',
                    'fk'    => 'qpd_product_description',
                ),
               
                
            );

            
            $total_amount = 0;
            foreach($quotation_data as $quot_data)
            {   
                $q=1;
                $border="border-top: 2px solid";
                $product_details = $this->common_model->FetchWhereJoin('crm_quotation_product_details',array('qpd_quotation_details'=>$quot_data->qd_id),$joins1);
                
                $total_amount = $total_amount + $quot_data->qd_sales_amount;

                $new_date = date('d-m-Y',strtotime($quot_data->qd_date));

                $pdf_data .= "<tr><td style='border-top: 2px solid'>{$new_date}</td>";

                $pdf_data .= "<td style='border-top: 2px solid'>{$quot_data->qd_reffer_no}</td>";

                $pdf_data .= "<td style='border-top: 2px solid'>{$quot_data->cc_customer_name}</td>";
                
                $pdf_data .= "<td style='border-top: 2px solid'>{$quot_data->se_name}</td>";

                $pdf_data .= "<td style='border-top: 2px solid'>{$quot_data->qd_sales_amount}</td>";
                
                
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
                    }

                    

                    $pdf_data .= "<td style='";
                    if ($q == 1) {
                    
                        $pdf_data .= $border;
                    }
                    $pdf_data .= "'>{$prod_del->product_details}</td>";

                    $pdf_data .= "<td style='";
                    if ($q == 1) {
                    
                        $pdf_data .= $border;
                    }
                    $pdf_data .= "'>{$prod_del->qpd_unit}</td>";

                    $pdf_data .= "<td style='";
                    if ($q == 1) {
                    
                        $pdf_data .= $border;
                    }
                    $pdf_data .= "'>{$prod_del->qpd_rate}</td>";

                    $pdf_data .= "<td style='";
                    if ($q == 1) {
                    
                        $pdf_data .= $border;
                    }
                    $pdf_data .= "'>{$prod_del->qpd_amount}</td>";

                    
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
            $mpdf = new \Mpdf\Mpdf();

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
            <td>Period : 01 Sep 2020 to 03 Sep 2020</td>
            <td align="right"><h3>Sales Quotation Report</h3></td>
        
            </tr>
        
            </table>

           
        
            <table  width="100%" style="margin-top:2px;border-collapse: collapse; border-spacing: 0;border-top:2px solid;">
            
        
            <tr>
            
            <th align="left">Date</th>
        
            <th align="left">Quotation Ref.</th>
        
            <th align="left">Customer</th>
        
            <th align="left">Sales Executive</th>
        
            <th align="left">Amount</th>

            <th align="left">Product</th>

            <th align="left">Quantity</th>

            <th align="left">Rate</th>

            <th align="left">Amount</th>
        
            
            </tr>

             
            '.$pdf_data.'

            <tr>
                <td style="border-top: 2px solid;">Total</td>
                <td style="border-top: 2px solid;"></td>
                <td style="border-top: 2px solid;"></td>
                <td style="border-top: 2px solid;"></td>
                <td style="border-top: 2px solid;">'.$total_amount.'</td>
                <td style="border-top: 2px solid;"></td>
                <td style="border-top: 2px solid;"></td>
                <td style="border-top: 2px solid;"></td>
                <td style="border-top: 2px solid;">'.$total_amount.'</td>
            </tr>    
           
            
            </table>


        
            ';
        
            //$footer = '';
        
            
            $mpdf->WriteHTML($html);
           // $mpdf->SetFooter($footer);
            $this->response->setHeader('Content-Type', 'application/pdf');
            $mpdf->Output();
        
        }

       
    }








}
