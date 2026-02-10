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

        $data['vendors'] = $this->common_model->FetchAllOrder('crm_customer_creation', 'cc_id', 'desc');

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
        // ... [Your existing standard filters for Date, Vendor, etc. remain unchanged] ...
        if (!empty($_GET['form_date'])) { $from_date = $_GET['form_date']; } else { $from_date = ""; }
        if (!empty($_GET['to_date'])) { $to_date = $_GET['to_date']; } else { $to_date = ""; }
        if (!empty($_GET['vendor'])) { $data1 = $_GET['vendor']; } else { $data1 = ""; }
        if (!empty($_GET['sales_order'])) { $data2 = $_GET['sales_order']; } else { $data2 = ""; }
        if (!empty($_GET['lpo_ref'])) { $data3 = $_GET['lpo_ref']; } else { $data3 = ""; }
        if (!empty($_GET['product'])) { $data5 = $_GET['product']; } else { $data5 = ""; }
        if (!empty($_GET['pending'])) { $data6 = $_GET['pending']; } else { $data6 = ""; }
        if (!empty($_GET['linked'])) { $data7 = $_GET['linked']; } else { $data7 = ""; }

        $joins = array(
            array('table' => 'pro_purchase_order', 'pk' => 'po_id', 'fk' => 'pop_purchase_order'),
            array('table' => 'crm_sales_orders', 'pk' => 'so_id', 'fk' => 'pop_sales_order'),
            array('table' => 'crm_products', 'pk' => 'product_id', 'fk' => 'pop_prod_desc'),
            array('table' => 'pro_material_received_note', 'pk' => 'mrn_purchase_order', 'fk' => 'pop_purchase_order'),
            array('table' => 'pro_material_received_note_prod', 'pk' => 'rnp_purchase_prod_id', 'fk' => 'pop_id'),
        );

        $joins1 = array(
            array('table' => 'crm_products', 'pk' => 'product_id', 'fk' => 'pop_prod_desc'),
            array('table' => 'crm_sales_orders', 'pk' => 'so_id', 'fk' => 'pop_sales_order'),
        );

        // Fetch Base PO Data
        $data['purchase_order'] = $this->pro_model->LPO_PVCheckData($from_date, 'po_date', $to_date, '', $data1, 'po_vendor_name', $data2, 'pop_sales_order', $data5, 'pop_prod_desc', $data3, 'po_reffer_no', 'steel_pro_purchase_order_product', $joins, 'pop_purchase_order', $joins1);

        $new_order = [];

        foreach ($data['purchase_order'] as $orders) {

            // 1. Fetch all Vouchers for this PO
            $pvs = $this->common_model->FetchWhere('pro_purchase_voucher', ['pv_purchase_order' => $orders->po_id]);

            $voucher_sum = 0;

            // 2. Sum up the Voucher Amounts
            if (!empty($pvs)) {
                foreach ($pvs as $pv) {
                    // REPLACE 'pv_total_amount' with your actual voucher total column (e.g., pv_grand_total)
                    $voucher_sum += (float)$pv->pv_total; 
                }
            }

            // 3. Get PO Total Amount
            // REPLACE 'po_total_amount' with your actual PO total column (e.g., po_grand_total)
            $po_total = (float)$orders->po_amount; 

            // 4. Calculate Balance
            // We use a small buffer (0.5) to handle floating point rounding differences
            $balance = $po_total - $voucher_sum;

            // If Balance is <= 0 (or close to 0), it is Fully Linked.
            // If Balance is > 0, it is Pending.
            $is_fully_linked = ($balance <= 0.5);

            // 5. Attach data to object (Avoid array_merge for cleaner structure)
            $orders->vouchers = $pvs; // Attach the list of vouchers
            $orders->is_fully_linked = $is_fully_linked; // Status flag
            $orders->balance_amount = $balance; // For debugging/display

            $new_order[] = $orders;
        }

        $data['purchase_order'] = $new_order;

        // ---------------------------------------------------------
        // FILTERING LOGIC
        // ---------------------------------------------------------
        if ($data6 != "" || $data7 != "") {

            $filterdata = [];

            foreach ($data['purchase_order'] as $item) {

                // CASE 1: Both Checked -> Show All
                if ($data6 != "" && $data7 != "") {
                    $filterdata[] = $item;
                }
                // CASE 2: Pending Checked ($data6) -> Show only if NOT fully linked
                elseif ($data6 != "") {
                    if (!$item->is_fully_linked) {
                        $filterdata[] = $item;
                    }
                }
                // CASE 3: Linked Checked ($data7) -> Show only if fully linked
                elseif ($data7 != "") {
                    if ($item->is_fully_linked) {
                        $filterdata[] = $item;
                    }
                }
            }

            $data['purchase_order'] = $filterdata;
        }

        // ... [Rest of your standard view loading code] ...
        if (!empty($from_date)) { $data['from_dates'] = date('d-M-Y', strtotime($from_date)); } else { $data['from_dates'] = ""; }
        if (!empty($to_date)) { $data['to_dates'] = date('d-M-Y', strtotime($to_date)); } else { $data['to_dates'] = ""; }

        $cond = array('so_deliver_flag' => 0);
        $data['vendors'] = $this->common_model->FetchAllOrder('crm_customer_creation', 'cc_id', 'desc');
        $data['sales_orders'] = $this->common_model->FetchWhere('crm_sales_orders', $cond);
        $data['chart_acc'] = $this->common_model->FetchAllOrder('accounts_charts_of_accounts', 'ca_name', 'asc');
        $data['products'] = $this->common_model->FetchAllOrder('crm_products', 'product_id', 'desc');

        if (!empty($_POST['pdf'])) { $this->Pdf($data['purchase_order'], $data['from_dates'], $data['to_dates']); }
        if (!empty($_POST['excel'])) { $this->Excel($data['purchase_order']); }

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
        $sales_orders = $this->pro_model->FetchWhereJoinBy('pro_purchase_order_product', ['pop_purchase_order' => $lpo_ref], $joins1, 'pop_sales_order');

        echo json_encode($sales_orders); // Return data as JSON response
    }




 public function Pdf($purchase_order, $from_date, $to_date)
{
    if (!empty($purchase_order)) {

        // 1. Initialize Grand Totals
        $grand_total_po_amt = 0;   // Sum of PO Amounts
        $grand_total_prod_amt = 0; // Sum of Product Amounts
        $grand_total_pv_amt = 0;   // Sum of PV Amounts
        $grand_total_balance = 0;  // Sum of Balances

        $pdf_rows = "";
        $sl_no = 1;

        // Border styling variable
        $border_style = "border-top: 2px solid";

        foreach ($purchase_order as $order_data) {

            // --- Pre-calculation per PO ---
            $vendor = $this->common_model->SingleRow('crm_customer_creation', ['cc_id' => $order_data->po_vendor_name]);
            $vendor_name = $vendor ? $vendor->cc_customer_name : '';
            $po_date = date('d-M-Y', strtotime($order_data->po_date));

            // Calculate Totals for this specific PO
            $current_po_prod_total = 0;
            $current_po_pv_total = 0;

            // Sum Product Amounts
            if (!empty($order_data->product_orders)) {
                foreach ($order_data->product_orders as $p) {
                    $current_po_prod_total += $p->pop_amount;
                }
            }

            // Sum Voucher Amounts
            if (!empty($order_data->vouchers)) {
                foreach ($order_data->vouchers as $v) {
                    $current_po_pv_total += $v->pv_total; // Based on your HTML logic ($v->pv_total)
                }
            }

            $current_po_balance = $current_po_prod_total - $current_po_pv_total;

            // Update Grand Totals
            $grand_total_po_amt += $order_data->po_amount;
            $grand_total_prod_amt += $current_po_prod_total;
            $grand_total_pv_amt += $current_po_pv_total;
            $grand_total_balance += $current_po_balance;

            // --- Row Generation ---
            $product_details = $order_data->product_orders;
            if (empty($product_details)) {
                $product_details = [new stdClass()]; // Ensure at least one row prints if no products
            }

            $row_count = 0;
            foreach ($product_details as $prod_del) {
                $row_count++;
                $is_first = ($row_count == 1); // Identify the first row to show Parent Data

                // Border: Solid for first row of PO, None/Light for subsequent rows
                $current_border = $is_first ? $border_style : "";

                // Product Variables
                $so_ref = isset($prod_del->so_reffer_no) ? $prod_del->so_reffer_no : '';
                $prod_name = isset($prod_del->product_details) ? $prod_del->product_details : '';
                $qty = isset($prod_del->pop_qty) ? $prod_del->pop_qty : 0;
                $rate = isset($prod_del->pop_rate) ? $prod_del->pop_rate : 0;
                $disc = isset($prod_del->pop_discount) ? $prod_del->pop_discount : 0;
                $pop_amount = isset($prod_del->pop_amount) ? $prod_del->pop_amount : 0;

                $pdf_rows .= '<tr>';

                // 1. Sl no (Parent)
                $pdf_rows .= '<td align="center" style="'.$current_border.'">' . ($is_first ? $sl_no : '') . '</td>';

                // 2. Date (Parent)
                $pdf_rows .= '<td align="center" style="'.$current_border.'">' . ($is_first ? $po_date : '') . '</td>';

                // 3. PO Ref (Parent)
                $pdf_rows .= '<td align="center" style="'.$current_border.'">' . ($is_first ? $order_data->po_reffer_no : '') . '</td>';

                // 4. Vendor (Parent)
                $pdf_rows .= '<td align="left" style="'.$current_border.'">' . ($is_first ? $vendor_name : '') . '</td>';

                // 5. SO Ref (Product Level)
                $pdf_rows .= '<td align="center" style="'.$current_border.'">' . $so_ref . '</td>';

                // 6. Vendor Inv Ref (Parent/Product Mix - User HTML puts it in nested table, but it's a PO field usually)
                $pdf_rows .= '<td align="center" style="'.$current_border.'">' . ($is_first ? ($order_data->po_vendor_ref ?? '') : '') . '</td>';

                // 7. Amount PO (Parent)
                $pdf_rows .= '<td align="right" style="'.$current_border.'">' . ($is_first ? format_currency($order_data->po_amount) : '') . '</td>';

                // 8. Product (Product Level)
                $pdf_rows .= '<td align="left" style="'.$current_border.'">' . $prod_name . '</td>';

                // 9. Quantity (Product Level)
                $pdf_rows .= '<td align="center" style="'.$current_border.'">' . format_currency($qty) . '</td>';

                // 10. Rate (Product Level)
                $pdf_rows .= '<td align="right" style="'.$current_border.'">' . format_currency($rate) . '</td>';

                // 11. Discount (Product Level)
                $pdf_rows .= '<td align="right" style="'.$current_border.'">' . format_currency($disc) . '%</td>';

                // 12. Amount Product (Product Level)
                $pdf_rows .= '<td align="right" style="'.$current_border.'">' . format_currency($pop_amount) . '</td>';

                // 13. Amount PV (Parent Sum - Displayed on First Row)
                $pdf_rows .= '<td align="right" style="'.$current_border.'">' . ($is_first ? format_currency($current_po_pv_total) : '') . '</td>';

                // 14. Balance (Parent Calculation - Displayed on First Row)
                $pdf_rows .= '<td align="right" style="'.$current_border.'">' . ($is_first ? format_currency($current_po_balance) : '') . '</td>';

                $pdf_rows .= '</tr>';
            }
            $sl_no++;
        }

        // --- PDF Setup ---

        if (empty($from_date) && empty($to_date)) {
            $dates = "";
        } else {
            $dates = $from_date . " to " . $to_date;
        }

        $title = "Purchase_Order_to_Voucher_Report";

        $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];
        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];

        $mpdf = new \Mpdf\Mpdf([
            'format' => 'Letter-L',
            'default_font_size' => 9,
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

        $mpdf->SetTitle('Purchase Order to Purchase Voucher Report');

        // Styles and HTML Structure
        $html = '
        <style>
        th, td {
            padding-top: 10px;
            padding-bottom: 10px;
            padding-left: 5px;
            padding-right: 5px;
            font-size: 12px;
            vertical-align: top;
        }
        th {
            border-bottom :2px solid;
            text-align: center; 
            font-weight: bold;
        }
        p {
            font-size: 12px;
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

        <table width="100%" style="margin-top:2px;border-collapse: collapse; border-spacing: 0;border-top:2px solid;">
            <thead>
                <tr>
                    <th align="center" width="4%">Sl</th>
                    <th align="center" width="7%">Date</th>
                    <th align="center" width="8%">PO Ref</th>
                    <th align="left"   width="12%">Vendor</th>
                    <th align="center" width="7%">SO Ref</th>
                    <th align="center" width="7%">Ven. Inv</th>
                    <th align="right"  width="7%">Amt<br>(PO)</th>
                    <th align="left"   width="15%">Product</th>
                    <th align="center" width="4%">Qty</th>
                    <th align="right"  width="5%">Rate</th>
                    <th align="right"  width="5%">Disc</th>
                    <th align="right"  width="7%">Amt<br>(Prod)</th>
                    <th align="right"  width="7%">Amt<br>(PV)</th>
                    <th align="right"  width="7%">Balance</th>
                </tr>
            </thead>
            <tbody>
                ' . $pdf_rows . '
                
                <tr>
                    <td style="border-top: 2px solid; font-weight:bold;" colspan="4" align="right">Total</td>
                    <td style="border-top: 2px solid;"></td>
                    <td style="border-top: 2px solid;"></td>
                    <td style="border-top: 2px solid; text-align:right; font-weight:bold;">' . format_currency($grand_total_po_amt) . '</td>
                    <td style="border-top: 2px solid;"></td>
                    <td style="border-top: 2px solid;"></td>
                    <td style="border-top: 2px solid;"></td>
                    <td style="border-top: 2px solid;"></td>
                    <td style="border-top: 2px solid; text-align:right; font-weight:bold;">' . format_currency($grand_total_prod_amt) . '</td>
                    <td style="border-top: 2px solid; text-align:right; font-weight:bold;">' . format_currency($grand_total_pv_amt) . '</td>
                    <td style="border-top: 2px solid; text-align:right; font-weight:bold;">' . format_currency($grand_total_balance) . '</td>
                </tr>    
            </tbody>
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
        if ($lpo_ref == "") {
            $resultCount = 10;
            $end = ($page - 1) * $resultCount;
            $start = $end + $resultCount;
            $data['result'] = $this->common_model->FetchAllLimit('crm_sales_orders', 'so_reffer_no', 'asc', $term, $start, $end);
        } else {
            $cond = array('pop_purchase_order' => $lpo_ref);
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
