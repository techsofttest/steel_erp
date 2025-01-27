<?php

namespace App\Controllers\Procurement;

use App\Controllers\BaseController;


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PendingPurchaseVoucherReport extends BaseController
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

        $data['content'] = view('procurement/pending_purchase_voucher_report', $data);

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

        if (!empty($_GET['gl_account'])) {
            $data4 = $_GET['gl_account'];
        } else {
            $data4 = "";
        }



        if (!empty($_GET['product'])) {
            $data5 = $_GET['product'];
        } else {
            $data5 = "";
        }




        $joins = array(

            array(
                'table' => 'pro_purchase_voucher',
                'pk'    => 'pv_purchase_order',
                'fk'    => 'po_id',
            ),


            // array(
            //     'table' => 'pro_material_received_note_prod',
            //     'pk'    => 'rnp_purchase_id',
            //     'fk'    => 'po_id',
            // ),

        );



        $joins1 = array(
            array(
                'table' => 'crm_products',
                'pk'    => 'product_details',
                'fk'    => 'pvp_prod_dec',
            ),
        );

        $data['purchase_order'] = $this->pro_model->PendingVoucherCheckData($from_date, 'po_date', $to_date, '', $data1, 'po_vendor_name', $data3, 'po_id', $data4, 'po_vendor_name', '', '', 'steel_pro_purchase_order', $joins, 'po_id', '');

        $new_order = [];

        foreach ($data['purchase_order'] as $orders) {
        
            // Fetch the associated MRN products
            $nrps = $this->common_model->FetchWhere('pro_material_received_note_prod', ['rnp_purchase_id' => $orders->po_id]);
        
            // Create a copy of the $orders object
            $merged_order = $orders;
        
            // Check if $nrps contains any products
            if (!empty($nrps)) {
                // Append the fetched products as a sub-array called 'received_products'
                $merged_order->received_products = $nrps;
            } else {
                // If no products are found, set 'received_products' as an empty array to avoid errors
                $merged_order->received_products = [];
            }
        
            // Append the merged order data to the $new_order array
            $new_order[] = $merged_order;
        }
        
        // Update the data array with the merged orders
        $data['purchase_order'] = $new_order;
        
        if ($data5 != "" || $data2 != "") {
            $filterdata = [];
        
            foreach ($data['purchase_order'] as $order) {
                // Filter 'received_products' within each order based on $data5 or $data2
                $filtered_received_products = $order->received_products;
        
                if ($data5 != "") {
                    $filtered_received_products = array_filter($filtered_received_products, function ($item) use ($data5) {
                        return $item->rnp_product_desc == $data5;
                    });
                }
        
                if ($data2 != "") {
                    $filtered_received_products = array_filter($filtered_received_products, function ($item) use ($data2) {
                        return $item->rnp_sales_order == $data2;
                    });
                }
        
                // If there are matching received products, update the order with them
                if (!empty($filtered_received_products)) {
                    $order->received_products = $filtered_received_products;
                    $filterdata[] = $order;
                }
            }
        
            // Update the data array with the filtered orders
            $data['purchase_order'] = $filterdata;
        }
        


        // echo '<pre>';
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

        $data['content'] = view('procurement/pending_purchase_voucher_report', $data);

        return view('crm/report-module-search', $data);
    }


    public function Pdf($purchase_order, $from_date, $to_date)
    {


        if (!empty($purchase_order)) {
            $pdf_data = "";

            $joins1 = array(

                array(
                    'table' => 'crm_products',
                    'pk'    => 'product_id',
                    'fk'    => 'pop_prod_desc',
                ),

            );

            $total_amount = $total_recieved = $total_balance = $total_booked = 0;
            foreach ($purchase_order as $order_data) {
                $q = 1;
                $border = "border-top: 2px solid";
                // $product_details = $order_data->product_orders;

                $total_amount = $total_amount + $order_data->po_amount;

                $total_recieved += $order_data->pv_paid;

                $booked_note = 0; foreach ($order_data->received_products as $notes) {
                    $booked_note += $notes->rnp_amount ;
                 //   print_r($notes);
                 } 
                $total_booked += $booked_note;

                $total_balance += $order_data->po_amount - $order_data->pv_paid;

                $vendor = $this->common_model->SingleRow('crm_customer_creation', ['cc_id' => $order_data->po_vendor_name]);



                $new_date = date('d-m-Y', strtotime($order_data->po_date));

                $pdf_data .= "<tr><td style='border-top: 2px solid'>{$new_date}</td>";

                $pdf_data .= "<td style='border-top: 2px solid'>{$order_data->po_reffer_no}</td>";

                $pdf_data .= "<td style='border-top: 2px solid'>{$vendor->cc_customer_name}</td>";

                $pdf_data .= "<td style='border-top: 2px solid;text-align:right;'>".format_currency($order_data->po_amount)."</td>";

                $pdf_data .= "<td style='border-top: 2px solid;text-align:right;'>".format_currency($booked_note)."</td>";

                $pdf_data .= "<td style='border-top: 2px solid;text-align:right;'>".format_currency($order_data->pv_paid ?? 0)."</td>";
                

                $pdf_data .= "<td style='border-top: 2px solid;text-align:right;'>" . (format_currency($order_data->po_amount - $order_data->pv_paid)) . "</td>";


                if ($q != 1) {

                    $pdf_data .= "</tr>";
                }
                // foreach ($product_details as $prod_del) {


                //     if ($q != 1) {

                //         $pdf_data .= "<tr>";

                //         $pdf_data .= "<tr><td style=''></td>";

                //         $pdf_data .= "<td style=''></td>";

                //         $pdf_data .= "<td style=''></td>";
                //         $pdf_data .= "<td style=''></td>";

                //         $pdf_data .= "<td style=''></td>";

                //         $pdf_data .= "<td style=''></td>";
                //     }




                //     if ($q != 1) {
                //         $pdf_data .= "</tr>";
                //     }

                //     $q++;
                // }

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



            $mpdf->SetTitle('Pending Purchase Voucher Report'); // Set the title

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
            <td align="right"><h2>Pending Purchase Voucher Report</h2></td>
        
            </tr>
        
            </table>
            
          

           
        
            <table  width="100%" style="margin-top:2px;border-collapse: collapse; border-spacing: 0;border-top:2px solid;">
            
        
            <tr>
            
            <th align="left">Date</th>
        
            <th align="left">Purchase Order Ref.</th>
        
            <th align="left">Vendor</th>
        
            <th align="right">Amount</th>

            <th align="right">Recieved</th>

            <th align="right">Booked</th>

            <th align="right">Balance</th>
        
            
            </tr>

               
            ' . $pdf_data . '

            <tr>
                <td style="border-top: 2px solid;">Total</td>
                <td style="border-top: 2px solid;"></td>
                <td style="border-top: 2px solid;"></td>
                <td style="border-top: 2px solid;text-align:right;">' . format_currency($total_amount) . '</td>
                <td style="border-top: 2px solid;text-align:right;">' . format_currency($total_booked). '</td>
                <td style="border-top: 2px solid;text-align:right;">' . format_currency($total_recieved) . '</td>
                <td style="border-top: 2px solid;text-align:right;">' . format_currency($total_balance) . '</td>
                
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
