<?php

namespace App\Controllers\Accounts;

use App\Controllers\BaseController;

use NumberToWords\NumberToWords;


class JournalVouchers extends BaseController
{
    

    public function FetchData()
    {

        /*pagination start*/
        $request = service('request');
        $postData = $request->getPost();
        $dtpostData = $postData['data'];
        $response = array();
 
        ## Read value
        $draw = $dtpostData['draw'];
        $start = $dtpostData['start'];
        $rowperpage = $dtpostData['length']; // Rows display per page
        $columnIndex = $dtpostData['order'][0]['column']; // Column index
        $columnName = $dtpostData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $dtpostData['order'][0]['dir']; // asc or desc
        $searchValue = $dtpostData['search']['value']; // Search value

        // Check if the current sort order is 'asc', then set it to 'desc'
        if ($columnSortOrder === 'asc') {
            $columnSortOrder = 'desc';
        } 

        ## Total number of records without filtering
       
        $totalRecords = $this->common_model->GetTotalRecords('accounts_journal_vouchers','jv_id','DESC');
 
        ## Total number of records with filtering
        $searchColumns = array('jv_voucher_no');
        
        $totalRecordwithFilter = $this->common_model->GetTotalRecordwithFilter('accounts_journal_vouchers','jv_id',$searchValue,$searchColumns);
        
        ##Joins if any //Pass Joins as Multi dim array
        $joins = array(
          
        );
        ## Fetch records
        
        $records = $this->common_model->GetRecord('accounts_journal_vouchers','jv_id',$searchValue,$searchColumns,$columnName,$columnSortOrder,$joins,$rowperpage,$start);
       
        $data = array();
        
        $i=1;
        foreach($records as $record ){
            $action = '
            <a href="javascript:void(0)" class="view view-color jv_view" data-jvview="'.$record->jv_id .'" data-toggle="tooltip" data-placement="top" title="View" ><i class="ri-eye-fill"></i></a>
            <a href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="Edit"  data-id="'.$record->jv_id .'"><i class="ri-pencil-fill"></i></a>
            <a href="'.base_url().'Accounts/JournalVouchers/Print/'.$record->jv_id.'" target="_blank" class="print_color" title="Print"><i class="ri-file-pdf-2-line " aria-hidden="true"></i></a>
            <a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->jv_id .'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i></a>
            ';
           
           $data[] = array( 
              "jv_id"=>$i,
              "jv_voucher_no"=>$record->jv_voucher_no,
              "jv_voucher_date"=>date('d M Y',strtotime($record->jv_date)),
              "jv_debit_total" => format_currency($record->jv_debit_total),
              "jv_credit_total" => format_currency($record->jv_debit_total),
              "action" =>$action,
           );
           $i++; 

        }
 
        ## Response
        $response = array(
         "draw" => intval($draw),
         "iTotalRecords" => $totalRecords,
         "iTotalDisplayRecords" => $totalRecordwithFilter,
         "aaData" => $data,
         "token" => csrf_hash() // New token hash
        );
 
        //return $this->response->setJSON($response);

        echo json_encode($response);

        exit;

        /*pagination end*/
    } 
    

    public function FetchTypes()
    {

        $page= !empty($_GET['page']) ? $_GET['page'] : 0;
        $term = !empty($_GET['term']) ? $_GET['term'] : "";
        $resultCount = 10;
        $end = ($page - 1) * $resultCount;       
        $start = $end + $resultCount;
      
        $data['result'] = $this->common_model->FetchAllLimit('crm_sales_order','so_order_no','asc',$term,$start,$end);

        $data['total_count'] =count($data['result']);

        return json_encode($data);

    }


    public function AccountFetchTypes()
    {

        $page= !empty($_GET['page']) ? $_GET['page'] : 0;
        $term = !empty($_GET['term']) ? $_GET['term'] : "";
        $resultCount = 10;
        $end = ($page - 1) * $resultCount;       
        $start = $end + $resultCount;
      
        $data['result'] = $this->common_model->FetchAllLimit('accounts_account_types','at_name','asc',$term,$start,$end);

        $data['total_count'] =count($data['result']);

        return json_encode($data);

    }



    //view page
    public function index()
    {  
        
        $data = array();

        //$data['accounts'] = $this->common_model->FetchAllOrder('accounts_charts_of_accounts','ca_name','asc');

        //$data['sales_orders'] = $this->common_model->FetchAllOrder('crm_sales_orders','so_id','desc');

        $data['content'] = view('accounts/journal-vouchers',$data);

        return view('accounts/accounts-module',$data);

        
    }



    public function FetchReference($type="e")
    {

    $uid = $this->common_model->FetchNextId('accounts_journal_vouchers',"JV-{$this->data['accounting_year']}-");

    if($type=="e")
    {
    echo $uid;
    }
    else
    {
    return $uid;
    }

    }




    // add
    Public function Add()
    {   


        $insert_data['jv_voucher_no'] = $this->request->getPost('jv_voucher_no');

        $juid_check = $this->common_model->SingleRow('accounts_journal_vouchers',array('jv_voucher_no' => $insert_data['jv_voucher_no']));

        if(!empty($juid_check))
        {
            $return['status'] = 0;        
            $return['error'] ="Duplicate Reference Number!";        
            echo json_encode($return);        
            exit;        
        }

        for($i=0;$i<count($this->request->getPost('jv_invoice'));$i++)
        {
        
            if(empty($_POST['jv_account'][$i]))
            {
                $return['status'] = 0;        
                $return['error'] ="Enter account!";        
                echo json_encode($return);        
                exit; 

            }

        }


        $insert_data['jv_added_by'] = 0; 

        $insert_data['jv_added_date'] = date('Y-m-d'); 

        $insert_data['jv_voucher_no'] = $this->request->getPost('jv_voucher_no');

        $insert_data['jv_date'] = date('Y-m-d',strtotime($this->request->getPost('jv_date')));

        $insert_data['jv_credit_total'] = array_sum($_POST['jv_credit']);

        $insert_data['jv_debit_total'] = array_sum($_POST['jv_debit']); 


        if($insert_data['jv_credit_total'] != $insert_data['jv_debit_total'])
        {

            $return['status'] = 0;        
            $return['error'] ="Credit and debit must be same!";        
            echo json_encode($return);        
            exit; 

        }




        $id = $this->common_model->InsertData('accounts_journal_vouchers',$insert_data);


        for($i=0;$i<count($this->request->getPost('jv_invoice'));$i++)
        {
            $sales_invoice = $_POST['jv_sale_invoice'][$i] ?? null;

            $account = $_POST['jv_account'][$i];

            $debit = $_POST['jv_debit'][$i] ?? null;

            $credit = $_POST['jv_credit'][$i] ?? null;

            $remarks = $_POST['jv_remarks'][$i] ?? null;


            if( (!empty($debit)) || (!empty($credit)))
            {

            $insert_invoice['ji_sales_order_id'] =  $sales_invoice;

            $insert_invoice['ji_account'] = $account;

            $insert_invoice['ji_debit'] = $debit;

            $insert_invoice['ji_credit'] = $credit;

            $insert_invoice['ji_narration'] = $remarks;

            $insert_invoice['ji_voucher_id'] = $id;

            $this->common_model->InsertData('accounts_journal_invoices',$insert_invoice);

            }

        }

        $return['status'] = 1;

        echo json_encode($return);    

        //$jv_no = $this->FetchReference("r");
        

    }


    //view
    public function View()
    {
        
        $cond = array('jv_id' => $this->request->getPost('jv_id'));

        $joins = array(
        
        );

        $data['jv'] = $this->common_model->SingleRowJoin('accounts_journal_vouchers',$cond,$joins);

        $invoice_cond = array('ji_voucher_id' => $data['jv']->jv_id);

        $invoice_joins=array(

            array(


                'table' => 'crm_sales_orders',
                'pk' => 'so_id',
                'fk' => 'ji_sales_order_id',
                ),

            array(
                'table' => 'accounts_charts_of_accounts',
                'pk' => 'ca_id',
                'fk' => 'ji_account',

            ),

        );

        $invoices = $this->common_model->FetchWhereJoin('accounts_journal_invoices',$invoice_cond,$invoice_joins);

        $data['invoices'] = "";

        $i=0;

        foreach($invoices as $invoice)
        {
        $i++;

        if($invoice->ji_sales_order_id==0)
        {
        $sales_order = "None";
        }
        else
        {
        $sales_order = $invoice->so_reffer_no;
        }

        if(empty($invoice->ji_debit) || $invoice->ji_debit==0)
        {
        
        $debit_amount = "-";

        }

        else
        {

        $debit_amount = format_currency($invoice->ji_debit);

        }



        if(empty($invoice->ji_credit) || $invoice->ji_credit==0)
        {
        
        $credit_amount = "-";

        }

        else
        {

        $credit_amount = format_currency($invoice->ji_credit);

        }

        
        $data['invoices'] .= "<tr>
            
        <td>".$i."</td>
        <td>".$sales_order."</td>
        <td>".$invoice->ca_name."</td>
        <td>".$invoice->ji_narration."</td>
        <td class='text-end'>".$debit_amount."</td>
        <td class='text-end'>".$credit_amount."</td>
    
        </tr>";


        }



        echo json_encode($data);
    }




    //Edit 
    public function Edit()
    {
        
        $sales_orders = $this->common_model->FetchAllOrder('crm_sales_orders','so_id','desc');

        $cond = array('jv_id' => $this->request->getPost('jv_id'));

        $joins = array(
        
        );

        $data['jv'] = $this->common_model->SingleRowJoin('accounts_journal_vouchers',$cond,$joins);

       

        $invoice_cond = array('ji_voucher_id' => $data['jv']->jv_id);

        $invoice_joins=array(

            array(
                'table' => 'crm_sales_orders',
                'pk' => 'so_id',
                'fk' => 'ji_sales_order_id',
                ),

                array(
                    'table' => 'accounts_charts_of_accounts',
                    'pk' => 'ca_id',
                    'fk' => 'ji_account',
                    ),

        );

        $invoices = $this->common_model->FetchWhereJoin('accounts_journal_invoices',$invoice_cond,$invoice_joins);

        $data['invoices'] = "";

        $i=0;

        foreach($invoices as $invoice)
        {
        $i++;

        if($invoice->ji_sales_order_id==0)
        {
        $sales_order = "None";
        }
        else
        {
        $sales_order = $invoice->so_reffer_no;
        }

        if(empty($invoice->ji_debit) || $invoice->ji_debit==0)
        {
        
        $debit_amount = 0;

        }

        else
        {

        $debit_amount = $invoice->ji_debit;

        }



        if(empty($invoice->ji_credit) || $invoice->ji_credit==0)
        {
        
        $credit_amount = 0;

        }

        else
        {

        $credit_amount = $invoice->ji_credit;

        }


        $no_so="selected";

        $options = "";

        $options .='
        
        <option value="'.$invoice->so_id.'" selected>'.$invoice->so_reffer_no.'</option>

        ';

        $options_account = '
        <option value="'.$invoice->ca_id.'" selected>'.$invoice->ca_name.'</option>
        ';
       

        $data['invoices'] .= "<tr class=\"so_row_edit\">

        <td>".$i."
        <input type=\"hidden\" name=\"jv_invoice_id[]\" value=\"".$invoice->ji_id."\">
        </td>

        <td class=\"so_select2_parent_edit\" width='20%'>
        
        <select name=\"jv_sale_invoice[]\" class=\"form-control so_select2_edit\">
        
        ".$options."
        
        </select>
        
        </td>

        <td class=\"select2_parent_edit\" width='35%'>

        <select name=\"jv_account[]\" class=\"form-control account_select2_edit\">
        
        ".$options_account."
        
        </select>
        
        </td>
        
        <td><input name=\"jv_remarks[]\" type=\"text\"  class=\"form-control\" value=\"".$invoice->ji_narration."\" ></td>
        <td><input name=\"jv_debit[]\" type=\"number\" step='0.01' class=\"form-control debit_amount_edit\" value=\"".$debit_amount."\"></td>
        <td><input name=\"jv_credit[]\" type=\"number\" step='0.01' class=\"form-control credit_amount_edit\" value=\"".$credit_amount."\" ></td>
      
        </tr>";


        }

        echo json_encode($data);

    
    }



    // update 
    public function Update()
    {    
     
        $id = $this->request->getPost('jv_id');

        $update_data['jv_date'] = date('Y-m-d',strtotime($this->request->getPost('jv_date')));

        $update_data['jv_credit_total'] = array_sum($_POST['jv_credit']);

        $update_data['jv_debit_total'] = array_sum($_POST['jv_debit']);

        if($update_data['jv_credit_total'] != $update_data['jv_debit_total'])
        {

            $return['status'] = 0;        
            $return['error'] ="Credit and debit must be same!";        
            echo json_encode($return);        
            exit; 


        }
        

        $this->common_model->EditData($update_data,array('jv_id' => $id),'accounts_journal_vouchers');


        for($i=0;$i<count($this->request->getPost('jv_sale_invoice'));$i++)
        {

            $invoice_id = $_POST['jv_invoice_id'][$i];

            $sales_invoice = $_POST['jv_sale_invoice'][$i];

            $account = $_POST['jv_account'][$i];

            $debit = $_POST['jv_debit'][$i];

            $credit = $_POST['jv_credit'][$i];

            $remarks = $_POST['jv_remarks'][$i];

            $update_invoice['ji_sales_order_id'] =  $sales_invoice;

            $update_invoice['ji_account'] = $account;

            $update_invoice['ji_debit'] = $debit;

            $update_invoice['ji_credit'] = $credit;

            $update_invoice['ji_narration'] = $remarks;

            $update_invoice['ji_voucher_id'] = $id;

            $this->common_model->EditData($update_invoice,array('ji_id' => $invoice_id),'accounts_journal_invoices');


        }


        $return['status'] = 1;

        echo json_encode($return);



       
    }



    
    //delete 
    public function Delete()
    {
        $cond = array('jv_id' => $this->request->getPost('id'));

        $this->common_model->DeleteData('accounts_journal_vouchers',$cond);

        $cond_invoices = array('ji_voucher_id' => $this->request->getPost('id'));

        $this->common_model->DeleteData('accounts_journal_invoices',$cond_invoices);
        
    }

    //fetch order
    public function FetchOrder()
    {
        $cond = array('so_id' => $this->request->getPost('ID'));
        $fetch_data = $this->common_model->SingleRow('crm_sales_order',$cond);
        $data['order_no'] = $fetch_data->so_order_no;
        echo json_encode($data);
        
    }



    public function FetchSalesOrders($where="")
    {

        $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
        $term = !empty($_GET['term']) ? $_GET['term'] : "";
        $resultCount = 10; // Number of records per page
        $offset = ($page - 1) * $resultCount; // Calculate the offset (starting index)
    
        // Build the WHERE clause for filtering
        if (!empty($term)) {
            $where = "so_reffer_no LIKE '%$term%'";
        }
    
        // Fetch paginated results
        $data['result'] = $this->common_model->FetchWhereArrayLimit(
            'crm_sales_orders', 
            'so_reffer_no', 
            'asc', 
            $where, 
            $resultCount,  // Limit (number of records per page)
            $offset        // Offset (starting record index)
        );
    
        // Count the total matching records for pagination
        $data['total_count'] = $this->common_model->CountWhere('crm_sales_orders', $where);
    
        // Return the data as JSON
        return $this->response->setJSON($data);

    }







    public function Print($id=""){

    if($id=="")
    $id = 27;

    $cond = array('jv_id' => $id);

     ##Joins if any //Pass Joins as Multi dim array

     $joins = array(

    );

    $jv = $this->common_model->SingleRowJoin('accounts_journal_vouchers',$cond,$joins);

    //$total_amount = NumberToWords::transformNumber('en',$jv->jv_total); // outputs "fifty dollars ninety nine cents"

    $total_amount = $jv->jv_debit_total;

    $joins_inv = array(

        array(
            'table' => 'crm_sales_orders',
            'pk' => 'so_id',
            'fk' => 'ji_sales_order_id',
           ),


           array(
            'table' => 'accounts_charts_of_accounts',
            'pk' => 'ca_id',
            'fk' => 'ji_account',
            ),


    );

    $orders = $this->common_model->FetchWhereJoin('accounts_journal_invoices',array('ji_voucher_id'=>$id),$joins_inv);

    $orders_sec ="";

    foreach($orders as $order)
    {

    $debit="";

    $credit="";

    $sales_order ="None";

    if($order->ji_sales_order_id!=0)
    {
    $sales_order = $order->so_order_no;
    }

    if($order->ji_debit>0)
    {
    $debit =$order->ji_debit;
    }

    if($order->ji_credit>0)
    {
    $credit = $order->ji_credit;
    }

    $orders_sec .='<tr>
    
    <td>'.$sales_order.'</td>

    <td>'.$order->ca_account_id.'</td>
    
    <td>'.$order->ji_narration.'</td>

    <td align="right">'.format_currency((float)$debit).'</td>

    <td align="right">'.format_currency((float)$credit).'</td>

    </tr>';


    }



        $mpdf = new \Mpdf\Mpdf([
            'format' => 'Letter',
            'default_font_size' => 9, 
            'margin_left' => 5, 
            'margin_right' => 5, 
        ]);
    
        $html ='
    
        <style>
        th, td {
            padding-top: 5px;
            padding-bottom: 5px;
            padding-left: 5px;
            padding-right: 5px;
          }

        table.border-bottom td
        {
        border-bottom:1px solid !important;
        }



        </style>
    
        <table>
        
        <tr>
        
        <td>
    
        <h3>Al Fuzail Engineering Services WLL</h3>
        <p>Tel : +974 4460 4254, Fax : 4029 8994, email : engineering@alfuzailgroup.com</p>
        <p>Post Box : 201978, Gate : 248, Street : 24, Industrial Area, Doha - Qatar</p>
        
        
        </td>
        
        </tr>
    
        </table>
    
    
    
        <table width="100%" style="margin-top:10px;">
        
    
        <tr width="100%">
        
        <td align="right"><h3>Journal Voucher</h3></td>
    
        </tr>
    
        </table>
    
    
        <table  width="100%" style="margin-top:1px;border-top:2px solid;border-bottom:1px solid;">
    
        <tr>
        
        <td width="50%">
        
        Reference : '.$jv->jv_voucher_no.'
        
        </td>
        
        
        </tr>
    
    
        <tr>
        
        <td width="50%">
        
        Date : '.date('d-m-Y',strtotime($jv->jv_date)).'
        
        </td>
        
     
        </tr>
    
    
        <tr>
        
        <td width="50%">
        
        Division : Al Fuzail Engineering Services
        
        </td>
        
        
        </tr>
    
    
    
        
        </table>
    
    
    
    
        <table  width="100%" style="margin-top:2px;">
        
    
        <tr class="border-bottom">
        
        <td align="left" style="border-bottom:1px solid !important;">Sales Order No</td>
    
        <td align="left" style="border-bottom:1px solid !important;">Account No</td>
    
        <td align="left" style="border-bottom:1px solid !important;">Account Description</td>
    
        <td align="left" style="border-bottom:1px solid !important;">Debit</td>
    
        <td align="left" style="border-bottom:1px solid !important;">Credit</td>
    
        </tr>
    
    
    

        '.$orders_sec.'
        

        
        </table>
    
        ';
    
       
       
        $footer = '

        <table width="100%">
        
        <tr>
        
        <td colpsan="5" align="center"><b>Amount : '.currency_to_words($total_amount).'</b></td>
    
        <td colspan="1" align="right" style="text-align:right;"><b>'.format_currency($total_amount).'</b></td>
    
        </tr>
    
        </table>
    
    
        <table>
        
        <tr>
    
        <td width="25%" style="padding-right:60px;">Prepared by : (print)</td>
    
        <td width="25%" style="padding-right:60px;">Received by:</td>
    
        <td width="25%" style="padding-right:60px;">Finance Manager</td>
    
        <td width="25%" style="padding-right:60px;">CEO</td>
    
        </tr>
    
        </table>

        ';

    
        
        $mpdf->WriteHTML($html);
        $mpdf->SetFooter($footer);
        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output();
    
        }








}
