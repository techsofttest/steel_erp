<?php

namespace App\Controllers\Procurement;

use App\Controllers\BaseController;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class LPO_MRNReport extends BaseController
{

    //view page
    public function index()
    {
        //$data['customer_creation'] = $this->common_model->FetchAllOrder('crm_customer_creation','cc_id','desc');

        //$data['sales_executive'] = $this->common_model->FetchAllOrder('executives_sales_executive','se_id','desc');

        $data['vendors'] = $this->common_model->FetchAllOrder('crm_customer_creation', 'cc_id', 'desc');

        $cond = array('so_deliver_flag' => 0);

        $data['sales_orders'] = $this->common_model->FetchWhere('crm_sales_orders', $cond);

        $data['chart_acc'] = $this->common_model->FetchAllOrder('accounts_charts_of_accounts', 'ca_name', 'asc');

        $data['products'] = $this->common_model->FetchAllOrder('crm_products', 'product_id', 'desc');

        $data['content'] = view('procurement/lpo_mrn_report', $data);

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
        // ... (Your existing variable setup for $data1, $data2 etc. remains the same) ...

        // [Existing variable setup code omitted for brevity]
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

        // ... (Your existing $joins and $joins1 arrays remain the same) ...
        $joins = array(
            array('table' => 'pro_purchase_order', 'pk' => 'po_id', 'fk' => 'pop_purchase_order'),
            array('table' => 'crm_products', 'pk' => 'product_id', 'fk' => 'pop_prod_desc'),
            array('table' => 'pro_material_received_note_prod', 'pk' => 'rnp_purchase_prod_id', 'fk' => 'pop_id'),
            array('table' => 'pro_material_received_note', 'pk' => 'mrn_purchase_order', 'fk' => 'pop_purchase_order'),
        );

        $joins1 = array(
            array('table' => 'crm_sales_orders', 'pk' => 'so_id', 'fk' => 'pop_sales_order'),
            array('table' => 'pro_material_received_note_prod', 'pk' => 'rnp_purchase_prod_id', 'fk' => 'pop_id'),
            array('table' => 'pro_material_received_note', 'pk' => 'mrn_purchase_order', 'fk' => 'pop_purchase_order'),
        );

        // 1. Fetch the relevant Purchase Orders
        $data['purchase_order'] = $this->pro_model->LPO_MRNCheckData($from_date, 'po_date', $to_date, '', $data1, 'po_vendor_name', $data2, 'pop_sales_order', $data5, 'pop_prod_desc', $data3, 'po_reffer_no', 'steel_pro_purchase_order_product', $joins, 'pop_purchase_order', $joins1);

        $new_order = [];

        foreach ($data['purchase_order'] as $orders) {

            // Fetch the PO details
            $pvs = $this->common_model->SingleRow('pro_purchase_order', ['po_id' => $orders->po_id]);

            if ($pvs && isset($pvs->po_id) && $pvs->po_id != '') {

                $joins2 = array(
                    array('table' => 'crm_products', 'pk' => 'product_id', 'fk' => 'pop_prod_desc'),
                    array('table' => 'crm_sales_orders', 'pk' => 'so_id', 'fk' => 'pop_sales_order'),
                    array('table' => 'pro_material_received_note_prod', 'pk' => 'rnp_purchase_prod_id', 'fk' => 'pop_id'),
                );

                // --- KEY CHANGE HERE ---

                // 1. Define the base condition (match the PO ID)
                $product_condition = ['pop_purchase_order' => $pvs->po_id];

                // 2. If User selected a Sales Order ($data2), apply it to the product fetch
                if (!empty($data2)) {
                    $product_condition['pop_sales_order'] = $data2;
                }

                // 3. (Optional) If User selected a Product ($data5), apply that too so you don't get other items
                if (!empty($data5)) {
                    $product_condition['pop_prod_desc'] = $data5;
                }

                // 4. Pass the specific $product_condition instead of just the PO ID
                $pvps = $this->pro_model->FetchWhereJoinBy('pro_purchase_order_product', $product_condition, $joins2, 'pop_id');

                // -----------------------

                if ($pvps) {
                    $orders->product_orders = $pvps;

                    // Only add the PO to the final list if it actually has products matching the filter
                    $new_order[] = $orders;
                } else {
                    $orders->product_orders = [];
                    // You might want to skip adding to $new_order if empty, depending on your requirement
                    // $new_order[] = $orders; 
                }
            }
        }

        $data['purchase_order'] = $new_order;


        // ... (The rest of your existing logic for $lpo_ref, $data6, $data7, view rendering etc.) ...

        $lpo_ref = $this->request->getPost('lpo_ref');

        if ($data6 != "" || $data7 != "") {
            // ... [Rest of your pending/linked logic remains unchanged] ...
            // Be careful: since we filtered $new_order above, this loop processes the cleaner data
            $filteredPO = [];
            foreach ($data['purchase_order'] as $po) {
                // ... copy your existing logic here ...
                if (empty($po->product_orders)) {
                    continue;
                }

                $productMap = [];
                foreach ($po->product_orders as $prod) {
                    // ... existing calculation ...
                    $pid = $prod->pop_id;
                    if (!isset($productMap[$pid])) {
                        $productMap[$pid] = [
                            'product' => $prod,
                            'po_qty'  => (float) $prod->pop_qty,
                            'mrn_qty' => 0,
                        ];
                    }
                    if (isset($prod->rnp_current_delivery)) {
                        $productMap[$pid]['mrn_qty'] += (float) $prod->rnp_current_delivery;
                    }
                }

                $finalProducts = [];
                foreach ($productMap as $item) {
                    // ... existing logic ...
                    $poQty  = $item['po_qty'];
                    $mrnQty = $item['mrn_qty'];
                    $isLinked = ($mrnQty >= $poQty);
                    $isPending = ($mrnQty < $poQty);

                    if ($data6 != "" && $data7 != "") {
                        $finalProducts[] = $item['product'];
                        continue;
                    }
                    if ($data6 != "" && $isPending) {
                        $finalProducts[] = $item['product'];
                    }
                    if ($data7 != "" && $isLinked) {
                        $finalProducts[] = $item['product'];
                    }
                }

                if (!empty($finalProducts)) {
                    $po->product_orders = array_values($finalProducts);
                    $filteredPO[] = $po;
                }
            }
            $data['purchase_order'] = array_values($filteredPO);
        }

        // ... [Rest of your date formatting and view loading] ...

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

        $data['vendors'] = $this->common_model->FetchAllOrder('crm_customer_creation', 'cc_id', 'desc');
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

        $data['content'] = view('procurement/lpo_mrn_report', $data);
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
        $sales_orders = $this->pro_model->FetchWhereJoinBy('pro_purchase_order_product', ['pop_purchase_order' => $lpo_ref], $joins1, 'pop_sales_order');

        echo json_encode($sales_orders); // Return data as JSON response
    }



    public function Pdf($purchase_order, $from_date, $to_date)
    {
        if (!empty($purchase_order)) {

            // 1. Initialize Totals
            $total_po_main_amount = 0;
            $total_mr_amount = 0;
            $total_po_amount_product_received = 0;
            $total_difference = 0;

            $pdf_rows = "";
            $sl_no = 1;

            // Define the border style from your original code
            $border_style = "border-top: 2px solid";

            foreach ($purchase_order as $order_data) {

                // Get Vendor Name
                $vendor = $this->common_model->SingleRow('crm_customer_creation', ['cc_id' => $order_data->po_vendor_name]);
                $vendor_name = $vendor ? $vendor->cc_customer_name : '';
                $po_date = date('d-m-Y', strtotime($order_data->po_date));

                // Accumulate Main PO Amount
                $total_po_main_amount += $order_data->po_amount;

                $product_details = $order_data->product_orders;

                if (empty($product_details)) {
                    $product_details = [new stdClass()];
                }

                $row_count = 0;

                foreach ($product_details as $prod_del) {
                    $row_count++;

                    // Determine Logic: Is this the first row of the PO?
                    $is_first = ($row_count == 1);

                    // Set Border: Only the first row of a PO gets the top border
                    $current_border = $is_first ? $border_style : "";

                    // Prepare Variables
                    $so_ref = isset($prod_del->so_reffer_no) ? $prod_del->so_reffer_no : '';
                    $prod_name = isset($prod_del->product_details) ? $prod_del->product_details : '';
                    $qty = isset($prod_del->pop_qty) ? $prod_del->pop_qty : 0;
                    $rate = isset($prod_del->pop_rate) ? $prod_del->pop_rate : 0;
                    $disc = isset($prod_del->pop_discount) ? $prod_del->pop_discount : 0;

                    $pop_amount = isset($prod_del->pop_amount) ? $prod_del->pop_amount : 0;
                    $rnp_amount = isset($prod_del->rnp_amount) ? $prod_del->rnp_amount : 0;

                    // Calculate Difference (Product Amount - MRN Amount)
                    $diff = $pop_amount - $rnp_amount;

                    // Accumulate Totals
                    $total_mr_amount += $pop_amount;
                    $total_po_amount_product_received += $rnp_amount;
                    $total_difference += $diff;

                    $pdf_rows .= '<tr>';

                    // 1. Sl No
                    $pdf_rows .= '<td style="' . $current_border . '">' . ($is_first ? $sl_no : '') . '</td>';

                    // 2. Date
                    $pdf_rows .= '<td style="' . $current_border . '">' . ($is_first ? $po_date : '') . '</td>';

                    // 3. PO Ref
                    $pdf_rows .= '<td style="' . $current_border . '">' . ($is_first ? $order_data->po_reffer_no : '') . '</td>';

                    // 4. Vendor
                    $pdf_rows .= '<td style="' . $current_border . '">' . ($is_first ? $vendor_name : '') . '</td>';

                    // 5. SO Ref
                    $pdf_rows .= '<td style="' . $current_border . '">' . $so_ref . '</td>';

                    // 6. Amount PO (Align Right)
                    $pdf_rows .= '<td style="text-align:right; ' . $current_border . '">' . ($is_first ? format_currency($order_data->po_amount) : '') . '</td>';

                    // 7. Product
                    $pdf_rows .= '<td style="' . $current_border . '">' . $prod_name . '</td>';

                    // 8. Quantity
                    $pdf_rows .= '<td style="text-align:right; ' . $current_border . '">' . format_currency($qty) . '</td>';

                    // 9. Rate
                    $pdf_rows .= '<td style="text-align:right; ' . $current_border . '">' . format_currency($rate) . '</td>';

                    // 10. Discount
                    $pdf_rows .= '<td style="text-align:right; ' . $current_border . '">' . format_currency($disc) . '</td>';

                    // 11. Amount (Product)
                    $pdf_rows .= '<td style="text-align:right; ' . $current_border . '">' . format_currency($pop_amount) . '</td>';

                    // 12. Amount (MRN)
                    $pdf_rows .= '<td style="text-align:right; ' . $current_border . '">' . format_currency($rnp_amount) . '</td>';

                    // 13. Difference
                    $pdf_rows .= '<td style="text-align:right; ' . $current_border . '">' . format_currency($diff) . '</td>';

                    $pdf_rows .= '</tr>';
                }
                $sl_no++;
            }

            if (empty($from_date) && empty($to_date)) {
                $dates = "";
            } else {
                $dates = $from_date . " to " . $to_date;
            }

            $title = "SQR"; // Kept original title variable

            $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
            $fontDirs = $defaultConfig['fontDir'];
            $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
            $fontData = $defaultFontConfig['fontdata'];

            $mpdf = new \Mpdf\Mpdf([
                'format' => 'Letter-L',
                'default_font_size' => 9, // Kept original font size
                'margin_left' => 5,
                'margin_right' => 5,
                'autoPageBreak' => true,
                'fontDir' => array_merge($fontDirs, [__DIR__ . '/fonts']),
                'fontdata' => $fontData + [
                    'bentonsans' => [
                        'R' => 'OpenSans-Regular.ttf',
                        'B' => 'OpenSans-Bold.ttf',
                    ],
                ],
                'default_font' => 'bentonsans'
            ]);

            $mpdf->SetTitle('Purchase Order to Material Received Note Report');

            // Restored Original CSS and Header Structure
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
        .dec_width {
            width:30%
        }
        .disc_color {
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
                <td align="right"><h2>Purchase Order to Material Recieved Note Report</h2></td>
            </tr>
        </table>
        
        <table width="100%" style="margin-top:2px;border-collapse: collapse; border-spacing: 0;border-top:2px solid;">
        
        <tr>
            <th align="center">Sl No</th>
            <th align="center">Date</th>
            <th align="center">PO Ref</th>
            <th align="left">Vendor</th>
            <th align="center">SO Ref</th>
            <th align="right">Amt (PO)</th>
            <th align="left">Product</th>
            <th align="right">Qty</th>
            <th align="right">Rate</th>
            <th align="right">Disc</th>
            <th align="right">Amt (Prod)</th>
            <th align="right">Amt (MRN)</th>
            <th align="right">Diff</th>
        </tr>

        ' . $pdf_rows . '

        <tr>
            <td style="border-top: 2px solid;">Total</td>
            <td style="border-top: 2px solid;"></td>
            <td style="border-top: 2px solid;"></td>
            <td style="border-top: 2px solid;"></td>
            <td style="border-top: 2px solid;"></td>
            <td style="border-top: 2px solid; text-align:right;">' .  format_currency($total_po_main_amount) . '</td>
            <td style="border-top: 2px solid;"></td>
            <td style="border-top: 2px solid;"></td>
            <td style="border-top: 2px solid;"></td>
            <td style="border-top: 2px solid;"></td>
            <td style="border-top: 2px solid; text-align:right;">' . format_currency($total_mr_amount) . '</td>
            <td style="border-top: 2px solid; text-align:right;">' . format_currency($total_po_amount_product_received) . '</td>
            <td style="border-top: 2px solid; text-align:right;">' . format_currency($total_difference) . '</td>
        </tr>    
       
        </table>
        ';

            $mpdf->WriteHTML($html);
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





    public function FetchVendors()
    {

        $page = !empty($_GET['page']) ? $_GET['page'] : 0;
        $term = !empty($_GET['term']) ? $_GET['term'] : "";
        $resultCount = 10;
        $end = ($page - 1) * $resultCount;
        $start = $end + $resultCount;

        $data['result'] = $this->common_model->FetchAllLimit('crm_customer_creation', 'cc_customer_name', 'asc', $term, $start, $end);

        $data['total_count'] = count($data['result']);

        return json_encode($data);
    }

    public function FetchLpoRef()
    {

        $page = !empty($_GET['page']) ? $_GET['page'] : 0;
        $term = !empty($_GET['term']) ? $_GET['term'] : "";
        $vendor_id = !empty($_GET['vendor_id']) ? $_GET['vendor_id'] : "";
        if ($vendor_id == "") {
            $resultCount = 10;
            $end = ($page - 1) * $resultCount;
            $start = $end + $resultCount;
            $data['result'] = $this->common_model->FetchAllLimit('pro_purchase_order', 'po_reffer_no', 'asc', $term, $start, $end);
        } else {
            $cond = array('po_vendor_name' => $vendor_id);
            $joins1 = array(
                /*array(
                    'table' => 'crm_customer_creation',
                    'pk'    => 'cc_id',
                    'fk'    => 'so_customer',
                ),*/);
            $data['result'] = $this->pro_model->FetchLikeJoinBy('pro_purchase_order', $cond, 'po_reffer_no', $term, $joins1, 'po_reffer_no');
        }
        $data['total_count'] = count($data['result']);
        return json_encode($data);
    }

    public function FetchSalesOrder()
    {

        $page = !empty($_GET['page']) ? $_GET['page'] : 0;
        $term = !empty($_GET['term']) ? $_GET['term'] : "";
        $lpo_ref = !empty($_GET['lpo_ref']) ? $_GET['lpo_ref'] : "";
        $lpo_ref_no = !empty($_GET['lpo_ref_no']) ? $_GET['lpo_ref_no'] : "";
        if ($lpo_ref == "") {
            $resultCount = 10;
            $end = ($page - 1) * $resultCount;
            $start = $end + $resultCount;
            $data['result'] = $this->common_model->FetchAllLimit('crm_sales_orders', 'so_reffer_no', 'asc', $term, $start, $end);
        } else {
            $cond = array('pop_purchase_order' => $lpo_ref_no);
            $joins1 = array(
                array(
                    'table' => 'crm_sales_orders',
                    'pk'    => 'so_id',
                    'fk'    => 'pop_sales_order',
                ),

            );
            $data['result'] = $this->pro_model->FetchLikeJoinBy('pro_purchase_order_product', $cond, 'so_reffer_no', $term, $joins1, 'pop_sales_order');
        }
        $data['total_count'] = count($data['result']);
        return json_encode($data);
    }


    public function FetchProducts()
    {
        $salesorder = $this->request->getPost('salesorder');
        $purchaseorder = $this->request->getPost('purchaseorder');

        $term = !empty($this->request->getVar('term')) ? $this->request->getVar('term') : "";
        $page = !empty($this->request->getVar('page')) ? $this->request->getVar('page') : 0;

        $resultCount = 10;
        $end = ($page - 1) * $resultCount;
        $start = $end + $resultCount;



        if ($salesorder != '') {
            $page  = max(1, (int) $this->request->getVar('page'));
            $limit = 10;
            $offset = ($page - 1) * $limit;

            $data['result'] = $this->pro_model
                ->FetchDistinctProductsBySalesOrder($salesorder, $term, $limit, $offset);

            $data['total_count'] = 10; // or real count query

        } elseif ($purchaseorder != '') {
            $data['result'] = $this->pro_model->FetchDistinctProductsByPurchaseOrder($purchaseorder, $term);
        } else {
            $data['result'] = $this->common_model->FetchAllLimit('crm_products', 'product_details', 'asc', $term, $start, $end);
        }

        $data['total_count'] = count($data['result']);

        return json_encode($data);
    }
}
