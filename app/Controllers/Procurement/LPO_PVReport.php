<?php

namespace App\Controllers\Procurement;

use App\Controllers\BaseController;


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class LPO_PVReport extends BaseController
{

    //view page
    public function index()
    {
        //$data['customer_creation'] = $this->common_model->FetchAllOrder('crm_customer_creation','cc_id','desc');

        //$data['sales_executive'] = $this->common_model->FetchAllOrder('executives_sales_executive','se_id','desc');

        $data['vendors'] = $this->common_model->FetchAllOrder('pro_vendor', 'ven_id', 'desc');

        $cond = array('so_deliver_flag' => 0);

        $data['sales_orders'] = $this->common_model->FetchWhere('crm_sales_orders', $cond);

        $data['chart_acc'] = $this->common_model->FetchAllOrder('accounts_charts_of_accounts', 'ca_name', 'asc');

        $data['products'] = $this->common_model->FetchAllOrder('crm_products', 'product_id', 'desc');

        $data['content'] = view('procurement/lpo_pv_report', $data);

        return view('procurement/report-module', $data);
    }


    //customer droupdrown
    public function FetchTypes()
    {

        $page = !empty($_GET['page']) ? $_GET['page'] : 0;
        $term = !empty($_GET['term']) ? $_GET['term'] : "";
        $resultCount = 10;
        $end = ($page - 1) * $resultCount;
        $start = $end + $resultCount;

        $data['result'] = $this->common_model->FetchAllLimit('crm_sales_orders', 'so_reffer_no', 'asc', $term, $start, $end);


        $data['total_count'] = count($data['result']);

        return json_encode($data);
    }


    //fetch executive by customer
    public function FetchData()
    {
        //fetch executive
        $cond = array('qd_customer' => $this->request->getPost('ID'));

        $joins = array(
            array(
                'table' => 'executives_sales_executive',
                'pk'    => 'se_id',
                'fk'    => 'qd_sales_executive',
            ),


        );


        $quotation_details = $this->common_model->FetchWhereUniqueJoin('crm_quotation_details', $cond, $joins, 'se_id');


        $data['quot_det'] = "<option value='' selected disabled>Select Sales Executive</option>";

        foreach ($quotation_details as $quot_det) {
            $data['quot_det'] .= '<option value=' . $quot_det->se_id . '>' . $quot_det->se_name . '</option>';
        }

        //fetch product

        $product_data = $this->common_model->FetchProductByCustomer('crm_quotation_details', $this->request->getPost('ID'));

        $data['quot_prod'] = "<option value='' selected>Select Product</option>";
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


        if (!empty($_GET['form_date'])) {
            $from_date = $_GET['form_date'];
        } else {
            $from_date = "";
        }



        if (!empty($_GET['to_date'])) {
            $to_date = $_GET['to_date'];
        } else {
            $to_date = "";
        }

        if (!empty($_GET['vendor'])) {
            $data1 = $_GET['vendor'];
        } else {
            $data1 = "";
        }



        if (!empty($_GET['sales_order'])) {
            $data2 = $_GET['sales_order'];
        } else {
            $data2 = "";
        }

        if (!empty($_GET['lpo_ref'])) {
            $data3 = $_GET['lpo_ref'];
        } else {
            $data3 = "";
        }

        if (!empty($_GET['product'])) {
            $data5 = $_GET['product'];
        } else {
            $data5 = "";
        }



        if (!empty($_GET['pending'])) {
            $data6 = $_GET['pending'];
        } else {
            $data6 = "";
        }



        if (!empty($_GET['linked'])) {
            $data7 = $_GET['linked'];
        } else {
            $data7 = "";
        }




        $joins = array(

            array(
                'table' => 'pro_purchase_order',
                'pk'    => 'po_id',
                'fk'    => 'pop_purchase_order',
            ),
            array(
                'table' => 'crm_sales_orders',
                'pk'    => 'so_id',
                'fk'    => 'pop_sales_order',
            ),
            array(
                'table' => 'crm_products',
                'pk'    => 'product_id',
                'fk'    => 'pop_prod_desc',
            ),

            array(
                'table' => 'pro_material_received_note',
                'pk'    => 'mrn_purchase_order',
                'fk'    => 'pop_purchase_order',
            ),
            array(
                'table' => 'pro_material_received_note_prod',
                'pk'    => 'rnp_purchase_prod_id',
                'fk'    => 'pop_id',
            ),

        );


        $joins1 = array(
            array(
                'table' => 'crm_products',
                'pk'    => 'product_id',
                'fk'    => 'pop_prod_desc',
            ),
            array(
                'table' => 'crm_sales_orders',
                'pk'    => 'so_id',
                'fk'    => 'pop_sales_order',
            ),
        );

        //$data['quotation_data'] = $this->pro_model->CheckData($from_date,'mr_date',$to_date,'',$data1,'	mrp_sales_order',$data2,'mrp_product_desc','','','','','pro_material_requisition_prod',$joins,'mrp_id',$joins1,'mrp_mr_id','pro_material_requisition_prod');  

        // $data['purchase_order'] = $this->pro_model->CheckData($from_date,'mrn_date',$to_date,'',$data1,'mrn_vendor_name',$data2,'rnp_sales_order',$data5,'rnp_product_desc','','','steel_pro_material_received_note_prod',$joins,'rnp_id',$joins1);  

        $data['purchase_order'] = $this->pro_model->LPO_PVCheckData($from_date, 'po_date', $to_date, '', $data1, 'po_vendor_name', $data2, 'pop_sales_order', $data5, 'pop_prod_desc', $data3, 'po_reffer_no', 'steel_pro_purchase_order_product', $joins, 'pop_purchase_order', $joins1);


        $new_order = [];

        foreach ($data['purchase_order'] as $orders) {

            // Fetch the MRN record
            $pvs = $this->common_model->SingleRow('pro_purchase_voucher', ['pv_purchase_order' => $orders->po_reffer_no]);

            // Check if the record exists before accessing properties
            if ($pvs && isset($pvs->pv_id) && $pvs->pv_id != '') {
                $pvps = $this->pro_model->FetchWhereOrder('pro_purchase_voucher_prod', ['pvp_reffer_id' => $pvs->pv_id], 'pvp_id', 'desc');
                $pvs->voucher_prod = $pvps;
            }

            // Merge the $orders and $pvs arrays, then cast the result back to an object
            $new_order[] = (object) array_merge((array)$orders, (array)$pvs);
        }


        $data['purchase_order'] = $new_order;

        if ($data6 != "" || $data7 != "") {

            if ($data6 != "") {
                // Filter the array to remove instances where 'mrn_id' is empty
                $filterdata = array_filter($data['purchase_order'], function ($item) {
                    return empty($item->pv_id);
                });
            }

            if ($data7 != "") {
                // Filter the array to remove instances where 'mrn_id' is empty
                $filterdata = array_filter($data['purchase_order'], function ($item) {
                    return !empty($item->pv_id);
                });
            }

            if ($data7 != "" && $data6 != "") {
                // Filter the array to remove instances where 'mrn_id' is empty
                $filterdata = $data['purchase_order'];
            }


            $data['purchase_order'] = $filterdata;
        }

        // echo '<pre>';
        // // print_r($new_order);
        // print_r($data['purchase_order']);
        // echo '</pre>';
        // exit();


        if (!empty($from_date)) {
            $data['from_dates'] = date('d-M-Y', strtotime($from_date));
        } else {
            $data['from_dates'] = "";
        }


        if (!empty($to_date)) {
            $data['to_dates'] = date('d-M-Y', strtotime($to_date));
        } else {
            $data['to_dates'] = "";
        }

        $cond = array('so_deliver_flag' => 0);

        $data['vendors'] = $this->common_model->FetchAllOrder('pro_vendor', 'ven_id', 'desc');

        $cond = array('so_deliver_flag' => 0);

        $data['sales_orders'] = $this->common_model->FetchWhere('crm_sales_orders', $cond);

        $data['chart_acc'] = $this->common_model->FetchAllOrder('accounts_charts_of_accounts', 'ca_name', 'asc');

        $data['products'] = $this->common_model->FetchAllOrder('crm_products', 'product_id', 'desc');

        if (!empty($_POST['pdf'])) {
            $this->Pdf($data['purchase_order'], $data['from_dates'], $data['to_dates']);
        }

        if (!empty($_POST['excel'])) {
            $this->Excel($data['purchase_order']);
        }

        $data['content'] = view('procurement/lpo_pv_report', $data);

        return view('crm/report-module-search', $data);
    }


    // Fetch Lpo Ref based on Vendor ID
    public function fetch_lpo_ref()
    {
        $vendor_id = $this->request->getPost('vendor_id');

        // Get Lpo Ref data from the database based on vendor_id
        $p_returns = $this->common_model->FetchWhere('pro_purchase_order', ['po_vendor_name' => $vendor_id]);

        echo json_encode($p_returns); // Return data as JSON response
    }

    // Fetch Sales Orders based on Lpo Ref
    public function fetch_sales_order()
    {
        $lpo_ref = $this->request->getPost('lpo_ref');


        $joins1 = array(

            array(
                'table' => 'crm_sales_orders',
                'pk'    => 'so_id',
                'fk'    => 'pop_sales_order',
            ),


        );

        // Get Sales Order data from the database based on lpo_ref
        $sales_orders = $this->common_model->FetchWhereJoin('pro_purchase_order_product', ['pop_purchase_order' => $lpo_ref], $joins1);

        echo json_encode($sales_orders); // Return data as JSON response
    }




    public function Pdf($purchase_order, $from_date, $to_date)
    {
        // echo '<pre>'; print_r($purchase_order);exit;

        if (!empty($purchase_order)) {
            $pdf_data = "";

            $joins1 = array(

                array(
                    'table' => 'crm_products',
                    'pk'    => 'product_id',
                    'fk'    => 'pop_prod_desc',
                ),

            );

            $total_amount =  $po_amt = $pop_amt = $rnp_amt = $diff_amt = 0;
            foreach ($purchase_order as $order_data) {
                $q = 1;
                $border = "border-top: 2px solid";
                //  $product_details = $order_data->product_orders;

                // ===========================
                $product_orders = $order_data->product_orders;
                $voucher_prod = $order_data->voucher_prod ?? [];

                $product_details = [];
                $max_count = max(count($product_orders), count($voucher_prod));

                // Loop through the arrays
                for ($i = 0; $i < $max_count; $i++) {
                    $merged_obj = new \stdClass();

                    if (isset($product_orders[$i])) {
                        // Add properties from product_orders
                        foreach ($product_orders[$i] as $key => $value) {
                            $merged_obj->$key = $value;
                        }
                    }

                    if (isset($voucher_prod[$i])) {
                        // Add/overwrite properties from voucher_prod
                        foreach ($voucher_prod[$i] as $key => $value) {
                            $merged_obj->$key = $value;
                        }
                    }

                    // Add the merged object to the result array
                    $product_details[] = $merged_obj;
                }

                // Result is in $merged_product_details
                // =========================

                // $mrn_amount = 0;
                // 
                // foreach ($product_details as $prod_del) {
                //     $mrn_amount += $prod_del->rnp_amount;
                // }
                $po_amt += $order_data->po_amount;
                // $total_amount = $total_amount + $mrn_amount;

                $vendor = $this->common_model->SingleRow('pro_vendor', ['ven_id' => $order_data->po_vendor_name]);

                // echo '<pre>';
                // print_r($product_details);
                // exit;

                $new_date = date('d-m-Y', strtotime($order_data->po_date));

                $pdf_data .= "<tr><td style='border-top: 2px solid'>{$new_date}</td>";

                $pdf_data .= "<td style='border-top: 2px solid'>{$order_data->po_reffer_no}</td>";

                $pdf_data .= "<td style='border-top: 2px solid'>{$vendor->ven_name}</td>";

                $pdf_data .= "<td style='border-top: 2px solid'>{$order_data->mrn_reffer}</td>";





                if ($q != 1) {

                    $pdf_data .= "</tr>";
                }
                foreach ($product_details as $prod_del) {
                    if ($q != 1) {

                        $pdf_data .= "<tr>";

                        $pdf_data .= "<tr><td style=''></td>";

                        $pdf_data .= "<td style=''></td>";

                        $pdf_data .= "<td style=''></td>";

                        $pdf_data .= "<td style=''></td>";
                    }




                    $pdf_data .= "<td style='";
                    if ($q == 1) {

                        $pdf_data .= $border;
                    }
                    $pdf_data .= "'>{$prod_del->so_reffer_no}</td>";


                    $pdf_data .= "<td style='";
                    if ($q == 1) {

                        $pdf_data .= $border;
                        $pdf_data .= "'>{$order_data->po_vendor_ref}</td>";
                    } else {
                        $pdf_data .= "'></td>";
                    }




                    $pdf_data .= "<td style='text-align:right;";
                    if ($q == 1) {

                        $pdf_data .= $border;
                        $pdf_data .= "'>".format_currency($order_data->po_amount)."</td>";
                    } else {
                        $pdf_data .= "'></td>";
                    }



                    $pdf_data .= "<td style='";
                    if ($q == 1) {

                        $pdf_data .= $border;
                    }
                    $pdf_data .= "'>{$prod_del->product_details}</td>";

                    $pdf_data .= "<td style='text-align:right;";
                    if ($q == 1) {

                        $pdf_data .= $border;
                    }
                    $pdf_data .= "'>{$prod_del->pop_qty}</td>";

                    $pdf_data .= "<td style='text-align:right;";
                    if ($q == 1) {

                        $pdf_data .= $border;
                    }
                    $pdf_data .= "'>".(format_currency($prod_del->pop_rate))."</td>";

                    $pdf_data .= "<td style='text-align:right;";
                    if ($q == 1) {

                        $pdf_data .= $border;
                    }
                    $pdf_data .= "'>".format_currency($prod_del->pop_amount)."</td>";
                    $pop_amt += $prod_del->pop_amount;

                    $pdf_data .= "<td style='";
                    if ($q == 1) {

                        $pdf_data .= $border;
                        $pdf_data .= "'>" . ($order_data->pv_vendor_inv ?? 0) . "</td>";
                    } else {
                        $pdf_data .= "'></td>";
                    }



                    $pdf_data .= "<td style='text-align:right;";
                    if ($q == 1) {

                        $pdf_data .= $border;
                    }
                    $pdf_data .= "'>" . ($prod_del->pvp_qty ?? 0) . "</td>";


                    $pdf_data .= "<td style='text-align:right;";
                    if ($q == 1) {

                        $pdf_data .= $border;
                    }
                    $pdf_data .= "'>" . format_currency(($prod_del->pvp_rate ?? 0)) . "</td>";

                    $pdf_data .= "<td style='text-align:right;";
                    if ($q == 1) {

                        $pdf_data .= $border;
                    }
                    $pdf_data .= "'>" . (format_currency($prod_del->pvp_amount ?? 0)) . "</td>";
                    $rnp_amt += $prod_del->pvp_amount ?? 0;

                    $pdf_data .= "<td style='text-align:right;";
                    if ($q == 1) {

                        $pdf_data .= $border;
                    }
                    $pdf_data .= "'>" . (format_currency($prod_del->pop_amount - ($prod_del->pvp_amount ?? 0))) . "</td>";
                    $diff_amt += $prod_del->pop_amount - ($prod_del->pvp_amount ?? 0);

                    // 

                    if ($q != 1) {
                        $pdf_data .= "</tr>";
                    }

                    $q++;
                }

                if ($q == 1) {
                    $pdf_data .= "</tr>";
                }

                // $pdf_data .="</tr>";




            }

            if (empty($from_date) && empty($to_date)) {

                $dates = "";
            } else {
                $dates = $from_date . " to " . $to_date;
            }



            $title = "SQR";

            $mpdf = new \Mpdf\Mpdf(

                [
                    'format' => 'A3', // Set page size to A3
                    'margin_left' => 15,
                    'margin_right' => 15,
                    'margin_top' => 16,
                    'margin_bottom' => 16,
                    'margin_header' => 9,
                    'margin_footer' => 9,
                ]
            );



            $mpdf->SetTitle('Purchase Order to Purchase Voucher Report'); // Set the title

            $html = '
        
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
            <td>Period : ' . $dates . '</td>
            <td align="right"><h2>Purchase Order to Purchase Voucher Report</h2></td>
        
            </tr>
        
            </table>
            
          

           
        
            <table  width="100%" style="margin-top:2px;border-collapse: collapse; border-spacing: 0;border-top:2px solid;">
            
        
            <tr>
            
            <th align="left">Date</th>
        
            <th align="left">Purchase Order Ref.</th>
        
            <th align="left">Vendor</th>
        
            <th align="left">MRN Ref</th>
        
            <th align="left">Sales Order Ref</th>

            <th align="left">Vendor Inv Ref</th>

            <th align="right">Amount</th>

            <th align="left">Product</th>

            <th align="right">Quantity</th>

            <th align="right">Rate</th>

            <th align="right">Amount</th>

            <th align="left">Vendor Inv Ref</th>

            <th align="right">Quantity</th>
        
            <th align="right">Rate</th>
            
            <th align="right">Amount</th>

            <th align="right">Balance</th>

            </tr>

               
            ' . $pdf_data . '

            <tr>
                <td style="border-top: 2px solid;">Total</td>
                <td style="border-top: 2px solid;"></td>
                <td style="border-top: 2px solid;"></td>
                <td style="border-top: 2px solid;"></td>    
                <td style="border-top: 2px solid;"></td>
                <td style="border-top: 2px solid;"></td>               
                <td style="border-top: 2px solid; text-align:right;">' .  format_currency($po_amt) . '</td>
                <td style="border-top: 2px solid;"></td>
                <td style="border-top: 2px solid;"></td>
                <td style="border-top: 2px solid;"></td>
                <td style="border-top: 2px solid; text-align:right;">' . format_currency($pop_amt) . '</td>
                <td style="border-top: 2px solid;"></td>
                <td style="border-top: 2px solid;"></td>
                <td style="border-top: 2px solid;"></td>
                <td style="border-top: 2px solid; text-align:right;">' . format_currency($rnp_amt) . '</td>
                <td style="border-top: 2px solid; text-align:right;">' . format_currency($diff_amt) . '</td>
                
            </tr>    
           
            
            </table>


        
            ';

            $footer = '';


            $mpdf->WriteHTML($html);

            // $mpdf->SetFooter($footer);
            $this->response->setHeader('Content-Type', 'application/pdf');
            $mpdf->Output($title . '.pdf', 'I');
        }
    }

    public function Excel($quotation_data)
    {
        // Create a new PhpSpreadsheet object
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();


        // Set table columns
        $table_columns = array(
            "Date",
            "Quotation Ref",
            "Customer",
            "Sales Executive",
            "Amount",
            "Product",
            "Quantity",
            //"Rate",
            //"Amount"
        );

        $column = 'A'; // Start from column A
        $excel_row = 1;

        // Set the company information
        $sheet->setCellValue($column . $excel_row, 'Al Fuzail Enginnering Service WLL');
        // Get cell style
        $style = $sheet->getStyle($column . $excel_row);

        // Modify font size
        $style->getFont()->setSize(20); // Change the size to your desired value

        // Or modify boldness
        $style->getFont()->setBold(true); // Set bold
        $excel_row++;

        $sheet->setCellValue($column . $excel_row, 'Tel : +974 4460 4254, Fax : 4029 8994, email : engineering@alfuzailgroup.com');
        $excel_row++;
        $sheet->setCellValue($column . $excel_row, 'Post Box : 201978, Gate : 248, Street : 24, Industrial Area, Doha - Qatar');
        $excel_row++;

        // Set the cell value
        $cellValue = 'Period : 01 Sep 2020 to 03 Sep 2020       Sales Quotation Report';

        // Create a rich text object
        $richText = new \PhpOffice\PhpSpreadsheet\RichText\RichText();

        // Set the first part of the text with one style
        $textRun1 = $richText->createTextRun('Period : 01 Sep 2020 to 03 Sep 2020');
        $textRun1->getFont()->setSize(12); // Change the size to your desired value for the period

        // Add space between the two parts of the text
        $richText->createText('        ');

        // Set the second part of the text with another style
        $textRun2 = $richText->createTextRun('Sales Quotation Report');
        $textRun2->getFont()->setBold(true); // Set bold for the second part

        // Set the rich text object as the cell value
        $sheet->setCellValue($column . $excel_row, $richText);

        $excel_row++;


        // Set padding and alignment for table columns
        $cellRange = 'A' . $excel_row . ':' . $column . ($excel_row + count($table_columns) - 1);
        $sheet->getStyle($cellRange)->getAlignment()->setWrapText(true); // Enable text wrapping
        $sheet->getStyle($cellRange)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // Center vertically
        $sheet->getStyle($cellRange)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); // Center horizontally
        $sheet->getStyle($cellRange)->getAlignment()->setIndent(1); // Increase the indentation
        $sheet->getRowDimension($excel_row)->setRowHeight(30); // Change the height value to adjust the vertical space


        // Loop to display table columns
        foreach ($table_columns as $field) {
            $sheet->setCellValue($column . $excel_row, $field);
            $column++; // Move to the next column for each field
        }

        $excel_row++; // Move to the next row for quotation data

        // Reset column index for data population
        $column = 'A';

        // Set padding and alignment for quotation data
        $cellRange = 'A' . $excel_row . ':' . $column . ($excel_row + count($quotation_data) - 1);
        $sheet->getStyle($cellRange)->getAlignment()->setWrapText(true); // Enable text wrapping
        $sheet->getStyle($cellRange)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // Center vertically
        $sheet->getStyle($cellRange)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); // Center horizontally
        $sheet->getStyle($cellRange)->getAlignment()->setIndent(1); // Increase the indentation


        $joins1 = array(

            array(
                'table' => 'crm_products',
                'pk'    => 'product_id',
                'fk'    => 'qpd_product_description',
            ),


        );

        // Populate quotation data
        foreach ($quotation_data as $quot_data) {

            $product_details = $this->common_model->FetchWhereJoin('crm_quotation_product_details', array('qpd_quotation_details' => $quot_data->qd_id), $joins1);

            $sheet->setCellValue($column . $excel_row, $quot_data->qd_date);
            $sheet->setCellValue(++$column . $excel_row, $quot_data->qd_reffer_no);
            $sheet->setCellValue(++$column . $excel_row, $quot_data->cc_customer_name);
            $sheet->setCellValue(++$column . $excel_row, $quot_data->se_name);
            $sheet->setCellValue(++$column . $excel_row, $quot_data->qd_sales_amount);

            //$column++;
            echo $column . $excel_row;

            echo ++$column . ++$excel_row;


            //$column++;
            //echo $column;


            $j = 1;
            $k = 1;
            //$excel_row++;
            //echo $excel_row;

            foreach ($product_details as $prod_del) {

                if ($j != 1) {
                    //$column++;
                }

                $sheet->setCellValue($column . $excel_row, $prod_del->product_details);

                $j++;
            }

            /*
            foreach($product_details as $prod_del)
            {   
                 
                if($j == 1) 
                
                { 
                    $col1 = $column; $excel1 = $excel_row;
                }

                else{
                    $col1 = ++$column; $excel1 = $excel_row;
                }

                echo $col1 . $excel1;
               
                $sheet->setCellValue($col1 . $excel1, $prod_del->product_details);

                 $j++;
            }

            foreach($product_details as $prod_del)
            {   

                if($k == 1)

                //if(1 == 2)
                
                { 
                    
                $col2 =  $column; $excel2 = $excel_row;
                
                }

                else{
                    $col2 = ++$column; $excel2 = $excel_row;
                }
               
                $sheet->setCellValue($col2 . $excel2, $prod_del->qpd_unit);
               
                $k++;


            }

            */




            // Increase row height to add vertical space
            //$sheet->getRowDimension($excel_row)->setRowHeight(30); // Change the height value to adjust the vertical space

            //$sheet->getColumnDimension($column)->setWidth(20); // Change 20 to your desired width

            // Reset column index for the next row
            $column = 'A';
            //$excel_row++; // Move to the next row 

            //echo "<br><br>";
        }



        exit;

        // Instantiate the Xlsx writer
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

        // Set HTTP headers to indicate Excel download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Excel.xlsx"');
        header('Cache-Control: max-age=0');

        // Clear output buffer
        ob_end_clean();

        // Save the Excel file to output
        $writer->save('php://output');
    }
}
