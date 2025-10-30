<?php

namespace App\Controllers\Crm;

use App\Controllers\BaseController;


class SalesQuotAnalysisReport extends BaseController
{
    
    



    //view page
    public function index()
    {   
        $data['customer_creation'] = $this->common_model->FetchAllOrder('crm_customer_creation','cc_id','desc');

        $data['products_data'] = $this->common_model->FetchAllOrder('crm_products','product_id','desc');

        $data['sales_executive_data'] = $this->common_model->FetchAllOrder('executives_sales_executive','se_id','desc');
        
        $data['content'] = view('crm/sales-quot-analysis-report',$data);

        return view('crm/report-module',$data);

    }


    public function FetchCustomer()
    {

        $page= !empty($_GET['page']) ? $_GET['page'] : 0;
        $term = !empty($_GET['term']) ? $_GET['term'] : "";
        $resultCount = 10;
        $end = ($page - 1) * $resultCount;       
        $start = $end + $resultCount;
      
        $data['result'] = $this->common_model->FetchAllLimit('crm_customer_creation','cc_customer_name','asc',$term,$start,$end);

        $data['total_count'] = count($data['result']);

        return json_encode($data);

    }

    public function FetchProducts()
    {

        $page= !empty($_GET['page']) ? $_GET['page'] : 0;
        $term = !empty($_GET['term']) ? $_GET['term'] : "";
        $resultCount = 10;
        $end = ($page - 1) * $resultCount;       
        $start = $end + $resultCount;
      
        $data['result'] = $this->common_model->FetchAllLimit('crm_products','product_details','asc',$term,$start,$end);

        $data['total_count'] = count($data['result']);

        return json_encode($data);

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
        

      

        //$data['quotation_data'] = $this->crm_modal->sales_quot_analysis($from_date,'qd_date',$to_date,'',$data1,'qd_customer',$data2,'qd_sales_executive',$data3,'qpd_product_description','','','crm_quotation_details',$joins,'qd_reffer_no',$joins1,'qpd_quotation_details','crm_quotation_product_details');  
        

        $data['quotation_data'] = $this->crm_modal->sales_quot_analysis($from_date,'qd_date',$to_date,'',$data1,'qd_customer',$data2,'qd_sales_executive',$data3,'qpd_product_description');  
        


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
            $this->Pdf($data['quotation_data'],$data['from_dates'],$data['to_dates']);
        }

        $data['customer_creation'] = $this->common_model->FetchAllOrder('crm_customer_creation','cc_id','desc');

        $data['products_data'] = $this->common_model->FetchAllOrder('crm_products','product_id','desc');

        $data['sales_executive'] = $this->common_model->FetchAllOrder('executives_sales_executive','se_id','desc');
        
        $data['sales_executive_data'] = $this->common_model->FetchAllOrder('executives_sales_executive','se_id','desc');
       
        $data['content'] = view('crm/sales-quot-analysis-report',$data);

      

        return view('crm/report-module-search',$data);
        
    }

    

    public function Pdf($quotation_data, $from_date, $to_date)
    {

        if (!empty($quotation_data)) {

            if (ob_get_length()) ob_end_clean();

            $pdf_data = "";
            $quot_prod_total = 0;
            $sales_prod_total = 0;
            $diff_total = 0;
            $quot_diff_total = 0;

            foreach ($quotation_data as $quot_data) {
                $new_date = !empty($quot_data->qd_date) ? date('d-M-Y', strtotime($quot_data->qd_date)) : '';

                $pdf_data .= "
                    <tr>
                        <td class='text-center' width='7%'>$new_date</td>
                        <td class='text-center' width='8%'>{$quot_data->qd_reffer_no}</td>
                        <td width='15%'>{$quot_data->cc_customer_name}</td>
                        <td width='10%'>{$quot_data->se_name}</td>
                        <td colspan='8' class='p-0'>
                            <table width='100%'>
                ";

                if (!empty($quot_data->quotation_product)) {
                    foreach ($quot_data->quotation_product as $quot_prod) {
                        $quot_rate = format_currency($quot_prod->qpd_rate);
                        $quot_disc = format_currency($quot_prod->qpd_discount);
                        $quot_amount = format_currency($quot_prod->qpd_amount);

                        $pdf_data .= "
                            <tr style='background: unset; border-bottom: hidden !important;'>
                                <td width='30%'>{$quot_prod->product_details}</td>
                                <td align='center' width='8%'>{$quot_prod->qpd_quantity}</td>
                                <td align='right' width='10%'>{$quot_rate}</td>
                                <td align='center' width='10%'>{$quot_disc}</td>
                                <td align='right' width='12%'>{$quot_amount}</td>
                                <td colspan='3' class='p-0'>
                                    <table width='100%'>
                        ";

                        $quot_prod_total += $quot_prod->qpd_amount;

                        if (!empty($quot_prod->sales_orders)) {

                            foreach ($quot_prod->sales_orders as $sal_ord) {
                                $sales_amount = format_currency($sal_ord->spd_amount);
                                $diff = $quot_prod->qpd_amount - $sal_ord->spd_amount;
                                $sales_prod_total += $sal_ord->spd_amount;
                                $diff_total += $diff;
                                $diff_formatted = format_currency($diff);

                                $pdf_data .= "
                                    <tr style='background: unset; border-bottom: hidden !important;'>
                                        <td align='center' width='33%'>{$sal_ord->so_reffer_no}</td>
                                        <td align='right'  width='33%'>{$sales_amount}</td>
                                        <td align='right'  width='34%'>{$diff_formatted}</td>
                                    </tr>
                                ";
                            }

                        } else {
                            
                            $pdf_data .= "
                                <tr style='background: unset; border-bottom: hidden !important;'>
                                    <td></td><td></td><td align='right'>{$quot_prod->qpd_amount}</td>
                                </tr>
                            ";
                            $quot_diff_total += $quot_prod->qpd_amount;
                        }

                        $final_diff_total = $diff_total + $quot_diff_total;

                        $pdf_data .= "
                                    </table>
                                </td>
                            </tr>
                        ";
                    }
                }

                $pdf_data .= "</table></td></tr>";
            }

            $dates = (empty($from_date) && empty($to_date)) ? "" : $from_date . " to " . $to_date;
            $title = "SQR";

            $mpdf = new \Mpdf\Mpdf([
                'format' => 'A4-L',
                'default_font_size' => 9,
                'margin_left' => 5,
                'margin_right' => 5,
                'margin_top' => 10,
                'margin_bottom' => 10,
                'default_font' => 'dejavusans'
            ]);

            // No AddPage() needed here
            $mpdf->SetHTMLHeader('');
            $mpdf->SetHTMLFooter('');

            $html = '
            <style>
                body { font-family: sans-serif; font-size: 10pt; margin: 0; padding: 0; }
                th, td { padding: 4px; font-size: 10px; border: none; vertical-align: top; }
                table { border-collapse: collapse; width: 100%; border-spacing: 0; }
                h3, p { margin: 0; padding: 0; }
            </style>

            <div style="margin-top:0;">
            <table width="100%">
                <tr>
                    <td>
                        <h3>Al Fuzail Engineering Services WLL</h3>
                        <p>Tel : +974 4460 4254, Fax : 4029 8994, email : engineering@alfuzailgroup.com</p>
                        <p>Post Box : 201978, Gate : 248, Street : 24, Industrial Area, Doha - Qatar</p>
                    </td>
                </tr>
            </table>

            <table width="100%" style="margin-top:5px;">
                <tr>
                    <td>Period : ' . $dates . '</td>
                    <td align="right"><h3>Sales Quotation Analysis Report</h3></td>
                </tr>
            </table>

            <table width="100%" style="font-size: 10px; margin-top:5px; border-top:2px solid #000;">
                <tr>
                    <th align="center" width="7%" style="border-top: 2px solid;">Date</th>
                    <th align="center" width="8%" style="border-top: 2px solid;">Quotation Ref.</th>
                    <th align="center" width="15%" style="border-top: 2px solid;">Customer</th>
                    <th align="center" width="10%" style="border-top: 2px solid;">Sales Executive</th>
                    <th colspan="8" width="60%" style="border-top: 2px solid;">
                        <table width="100%">
                            <tr>
                                <th align="center" width="30%">Product</th>
                                <th align="center" width="8%">Qty</th>
                                <th align="center" width="10%">Rate</th>
                                <th align="center" width="10%">Discount</th>
                                <th align="center" width="12%">Amount</th>
                                <th colspan="3" width="30%">
                                    <table width="100%">
                                        <tr>
                                            <th align="center" width="33%">Sales Order</th>
                                            <th align="center" width="33%">Amount</th>
                                            <th align="center" width="34%">Difference</th>
                                        </tr>
                                    </table>
                                </th>
                            </tr>
                        </table>
                    </th>
                </tr>
                ' . $pdf_data . '
                <tr>

                    <td style="border-top: 2px solid;" width="50px">Total</td>
                    <td style="border-top: 2px solid;" width="50px"></td>
                    <td style="border-top: 2px solid;" width="50px"></td>
                    <td style="border-top: 2px solid;" width="50px"></td>
                    <td colspan="8"  class="p-0" style="border-top: 2px solid">
                        <table>
                            <tr style="background: unset;border-bottom: hidden !important;">

                                <td  width="200"></td>
                                <td  width="40px"></td>
                                <td  width="80px"></td>
                                <td  width="80px" ></td>
                            
                                <td  width="100px" align="right"><b>'.format_currency($quot_prod_total).'</b></td>

                                <td colspan="3"  class="p-0">

                                    <table>

                                        <tr style="background: unset;border-bottom: hidden !important;">

                                            <td  width="100px"></td>
                                            <td  width="90px" align="right"><b>'.format_currency($sales_prod_total).'</b></td>
                                            <td  width="80px" align="right"><b>'.format_currency($final_diff_total).'</b></td>
                                        
                                        </tr>
                                    
                                    </table>
                                
                                </td>
                        
                            </tr>
                        
                        </table>
                    </td>
                
                </tr>
            </table>
            </div>
            ';

            $mpdf->WriteHTML($html);
            $mpdf->Output('SQR.pdf', \Mpdf\Output\Destination::INLINE);
            exit;
        }
    
    }





}