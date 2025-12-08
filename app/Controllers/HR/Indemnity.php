<?php

namespace App\Controllers\HR;

use App\Controllers\BaseController;


class Indemnity extends BaseController
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
       
        $totalRecords = $this->common_model->GetTotalRecords('hr_indemnity','id_id','DESC');
 
        ## Total number of records with filtering
       
        $searchColumns = array('id_id');

        $totalRecordwithFilter = $this->common_model->GetTotalRecordwithFilter('hr_indemnity','id_id',$searchValue,$searchColumns);
    
        ##Joins if any //Pass Joins as Multi dim array
        $joins = array(
            array(
            'table' => 'accounts_journal_vouchers',
            'pk' => 'jv_id',
            'fk' => 'id_jv_id',
            )
        );
        ## Fetch records
        $records = $this->common_model->GetRecord('hr_indemnity','id_id',$searchValue,$searchColumns,$columnName,$columnSortOrder,$joins,$rowperpage,$start);
    
        $data = array();

        $i=1;

        foreach($records as $record ){

        //$action = '<a  href="javascript:void(0)" class="edit edit-color view_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->pr_id.'" data-original-title="Edit"><i class="ri-eye-fill"></i> View</a> <a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->ts_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a> <a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->ts_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> Delete</a>';
           
        $action='<a  href="javascript:void(0)" class="edit edit-color view_btn" data-toggle="tooltip" data-placement="top" title="Edit"  data-id="'.$record->id_id.'" data-original-title=""><i class="ri-eye-fill"></i> </a> 
        <a href="javascript:void(0);" data-id="'.$record->id_id.'" class="print_color" title="Print"><i class="ri-file-pdf-2-line " aria-hidden="true"></i></a>
        <a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->id_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> </a>';

        $credit_data = $this->common_model->SingleRow('accounts_charts_of_accounts',array('ca_id' => $record->id_credit_account));

        $credit_account = "";
        if(!empty($credit_data))
        $credit_account = $credit_data->ca_name;

        $debit_data = $this->common_model->SingleRow('accounts_charts_of_accounts',array('ca_id' => $record->id_debit_account));

        $debit_account = "";
        if(!empty($debit_data))
        $debit_account = $debit_data->ca_name;

        $data[] = array( 
              "id_id"=>$i,
              "vt_date" => date('d M Y',strtotime($record->id_date)),
              "jv" => $record->jv_voucher_no,
              "vt_debit_account" => $debit_account,
              "vt_credit_account" => $credit_account,
              "vt_total" => format_currency($record->id_total),
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






    public function AddJournal()
    {

        $this->hr_model = new \App\Models\HRModel();

        if($this->request->getPost())

        {
        
            //$serializedData = $this->request->getPost('journal_form');
            //$formData = [];
            //parse_str($serializedData, $formData);

            $credit_account = $this->request->getPost('credit_account');

            $debit_account = $this->request->getPost('debit_account');

            $date = date('Y-m-d',strtotime($this->request->getPost('date')));

            $credit_account_data = $this->common_model->SingleRow('accounts_charts_of_accounts',array('ca_id' => $credit_account));

            $debit_account_data = $this->common_model->SingleRow('accounts_charts_of_accounts',array('ca_id' => $debit_account));

            $employees = $this->common_model->FetchAll('hr_employees');

            $account_ledger = $this->report_model->FetchGLTransactions($date_from="",$date_to="",$account_head="",$account_type="",$credit_account,$time_frame="",$range_from="",$range_to="");

            $total_credit = array_sum(array_column($account_ledger,'credit_amount'));

            $total_debit = array_sum(array_column($account_ledger,'debit_amount'));

            $gl_balance = number_format($total_debit-$total_credit,2,'.','');

            $data['current_balance'] = abs($gl_balance);

            $data['emp_row'] = "";

            $data['total_amount'] = 0;

            foreach($employees as $emp)
            {

               $doj = strtotime($emp->emp_date_of_join);
               $selected_date = strtotime($date); // e.g., '2025-07-31'

               $diff_in_seconds = abs($selected_date - $doj);

                // Total number of days
               $total_days = floor($diff_in_seconds / (60 * 60 * 24));

               // Entitlement calculation
               $entitlement = ($total_days * 21) / 365;

               $entitlement = round($entitlement,2);

               $year_salary = $emp->emp_basic_salary*12;

               $indemnity = $year_salary/365*$entitlement;

               //$amount = $emp->emp_budgeted_ticket_amount*$emp->emp_air_ticket_per_year*$entitlement;

               //$amount = $amount/365;

               $amount = $indemnity-$emp->emp_indemnity_advance;

                
                $data['total_amount']+=number_format((float)$amount,2,'.','');

                $insert_emp_arr['ide_emp_id'][$emp->emp_id] = $emp->emp_id;
                $insert_emp_arr['ide_basic_salary'][$emp->emp_id] = $emp->emp_basic_salary ?? "2025-01-01";
                $insert_emp_arr['ide_date_of_join'][$emp->emp_id] = $emp->emp_date_of_join ?? 0;
                $insert_emp_arr['ide_entitlement'][$emp->emp_id] = $entitlement ?? 0;
                $insert_emp_arr['ide_indemnity'][$emp->emp_id] = $indemnity;                                                                                                                          
                $insert_emp_arr['ide_advance'][$emp->emp_id] = $emp->emp_indemnity_advance;
                $insert_emp_arr['ide_amount'][$emp->emp_id] = $amount;


            }

            $jv_sl=0;

            $data['total_amount'] = number_format((float)$data['total_amount'],2,'.','');

            $data['total_amount'] = round($data['total_amount']);

            $data['jv_total'] = $data['total_amount']-$data['current_balance'];

            $data['jv_total'] = round($data['jv_total']);



        //Insert Vacation Travel

        $insert_indemnity['id_date'] =  $date;

        $insert_indemnity['id_debit_account'] =  $debit_account;

        $insert_indemnity['id_credit_account'] = $credit_account;

        $insert_indemnity['id_current_balance'] = $data['current_balance'];
       
        $insert_indemnity['id_total'] = str_replace(",","",$data['total_amount']);
        

        //Insert Journal voucher


        $juid = $this->request->getPost('juid');

        $insert_journal['jv_voucher_no'] = $juid;

        $insert_journal['jv_date'] = date('Y-m-d',strtotime($this->request->getPost('jv_date')));

        $insert_journal['jv_debit_total'] = $data['jv_total'];

        $insert_journal['jv_credit_total'] = $data['jv_total'];

        $insert_journal['jv_added_date'] = date('Y-m-d');

        //print_r($insert_journal); exit;

        $journal_id = $this->common_model->InsertData('accounts_journal_vouchers',$insert_journal);

        $indem_id = $this->common_model->InsertData('hr_indemnity',$insert_indemnity);


        //Insert idemnity employees

        foreach ($insert_emp_arr['ide_emp_id'] as $emp_id)
        {

            $insert_emp_data['ide_emp_id'] = $insert_emp_arr['ide_emp_id'][$emp_id];
            $insert_emp_data['ide_basic_salary']= $insert_emp_arr['ide_basic_salary'][$emp_id];
            $insert_emp_data['ide_date_of_join'] = $insert_emp_arr['ide_date_of_join'][$emp_id];
            $insert_emp_data['ide_entitlement'] = $insert_emp_arr['ide_entitlement'][$emp_id];
            $insert_emp_data['ide_indemnity'] = $insert_emp_arr['ide_indemnity'][$emp_id];
            $insert_emp_data['ide_advance'] = $insert_emp_arr['ide_advance'][$emp_id];
            $insert_emp_data['ide_amount'] = $insert_emp_arr['ide_amount'][$emp_id];
            $insert_emp_data['ide_main_id'] = $indem_id;
        
            $this->common_model->InsertData('hr_indemnity_employees',$insert_emp_data);

        }


        $this->common_model->EditData(array('id_jv_id' => $journal_id),array('id_id' => $indem_id),'hr_indemnity');

        //Insert Journal invoices
        
            for ($ji = 0; $ji < count($_POST['jv_account']); $ji++) {
                $account = $_POST['jv_account'][$ji];
                $debit = !empty($_POST['jv_debit'][$ji]) ? $_POST['jv_debit'][$ji] : 0;
                $credit = !empty($_POST['jv_credit'][$ji]) ? $_POST['jv_credit'][$ji] : 0;
                $narration = $_POST['jv_remarks'][$ji] ?? '';

                $insert_journal_invoice = [
                    'ji_voucher_id' => $journal_id,
                    'ji_account' => $account,
                    'ji_debit' => str_replace(",","",$debit),
                    'ji_credit' => str_replace(",","",$credit),
                    'ji_narration' => $narration
                ];

                $this->common_model->InsertData('accounts_journal_invoices', $insert_journal_invoice);

            }

        $return['msg'] = "Added to journal";

        $return['status'] = 1;

        $return['insert_id'] = $indem_id;

        }

        echo json_encode($return);

    }










        //Fetch Employees

        public function FetchEmployees()
        {

           $account = $this->request->getPost('account');

           $debit_account = $this->request->getPost('debit_account');

           $date = date('Y-m-d',strtotime($this->request->getPost('date')));

           $credit_account_data = $this->common_model->SingleRow('accounts_charts_of_accounts',array('ca_id' => $account));

           $debit_account_data = $this->common_model->SingleRow('accounts_charts_of_accounts',array('ca_id' => $debit_account));

           $employees = $this->common_model->FetchAll('hr_employees');

           //$gl_balance = $this->report_model->FetchGlBalance($date_from="", $date_to="", $account_head="", $account_type="", $account, $time_frame="",$range_from="",$range_to="");
       
           $account_ledger = $this->report_model->FetchGLTransactions($date_from="",$date_ledger="",$account_head="",$account_type="",$account,$time_frame="",$range_from="",$range_to="");

           $total_credit = array_sum(array_column($account_ledger,'credit_amount'));

           $total_debit = array_sum(array_column($account_ledger,'debit_amount'));

           $gl_balance = number_format($total_debit-$total_credit,2,'.','');

           $data['current_balance'] = abs($gl_balance);

           $data['current_balance_view'] = format_currency($data['current_balance']);

           $data['emp_row'] = "";

           $data['total_amount'] = 0;

           $ioo=0;
           foreach($employees as $emp)
           {

               /*
               $diff = abs(strtotime($emp->emp_date_of_join)-strtotime($date));

               $years = floor($diff / (365*60*60*24));
               $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
               $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

               $entitlement = $days*21/365;
               */

               $doj = strtotime($emp->emp_date_of_join);
               $selected_date = strtotime($date); // e.g., '2025-07-31'

               $diff_in_seconds = abs($selected_date - $doj);

                // Total number of days
               $total_days = floor($diff_in_seconds / (60 * 60 * 24));

               // Entitlement calculation
               $entitlement = ($total_days * 21) / 365;

               $entitlement = round($entitlement,2);

               $year_salary = $emp->emp_basic_salary*12;

               $indemnity = $year_salary/365*$entitlement;

               //$amount = $emp->emp_budgeted_ticket_amount*$emp->emp_air_ticket_per_year*$entitlement;

               //$amount = $amount/365;

               $amount = $indemnity-$emp->emp_indemnity_advance;


               $data['emp_row'] .="
               
                   <tr>

                   <td>".++$ioo."</td>
                   
                   <td>{$emp->emp_uid}</td>

                   <td>{$emp->emp_name}</td>

                   <td class='text-end'>".format_currency($emp->emp_basic_salary)."</td>

                   <td>".date('d M Y',strtotime($emp->emp_date_of_join))."</td>

                   <td class='text-end'>{$entitlement}</td>

                   <td class='text-end'>".format_currency($indemnity)."</td>

                   <td class='text-end'>{$emp->emp_indemnity_advance}</td>

                   <td class='text-end'>".format_currency($amount)."</td>

                   </tr>
               
               ";
               
               $data['total_amount']+=number_format((float)$amount,2,'.','');

           }

           $jv_sl=0;

           $data['total_amount'] = number_format((float)$data['total_amount'],2,'.','');

           $data['total_amount'] = round($data['total_amount']);

           $data['jv_total'] = $data['total_amount']-$data['current_balance'];

           //$data['jv_total'] = number_format((float)$data['jv_total'],2,'.','');

           $data['jv_total'] = round($data['jv_total']);

           $data['jv_total_view'] = format_currency($data['jv_total']);

           $data['jv_rows'] ='';

           $data['jv_rows'] .='

             <tr class="jv_row">

                                       <th class="sl_no">'.++$jv_sl.'</th>

                                       <th class="select2_parent" width="35%"> 
                                           
                                       <input type="hidden" name="jv_account[]" value="'.$debit_account_data->ca_id.'">

                                       <input type="text" class="form-control"  value="'.$debit_account_data->ca_name.'" readonly>

                                       </th>
                                       
                                       <th><input name="jv_remarks[]" type="text" class="form-control" ></th>

                                       <th><input name="jv_debit[]" type="text" class="form-control text-end" value="'.format_currency($data['jv_total']).'" readonly></th>

                                       <th><input name="jv_credit[]" type="text" class="form-control text-end credit_amount" readonly></th>

           </tr>

           
           ';


           $data['jv_rows'] .='

             <tr class="jv_row">

                                       <th class="sl_no">'.++$jv_sl.'</th>

                                       <th class="select2_parent" width="35%"> 
                                           
                                       <input type="hidden" name="jv_account[]" value="'.$credit_account_data->ca_id.'">

                                       <input type="text" class="form-control"  value="'.$credit_account_data->ca_name.'" readonly>

                                       </th>
                                       
                                       <th><input name="jv_remarks[]" type="text" class="form-control" ></th>

                                       <th><input name="jv_debit[]" type="text"  class="form-control text-end" value="" readonly></th>

                                       <th><input name="jv_credit[]" type="text" class="form-control credit_amount text-end" value="'.format_currency($data['jv_total']).'" readonly></th>

           </tr>

           
           ';


           $data['status'] = 1;

            return json_encode($data);
    
        }

    //End





    //view page

    public function index()
    {   
        

       $data['sup'] = array();

        return view('hr/indemnity',$data);

    }





    public function View()
    {

        $this->hr_model = new \App\Models\HRModel();

        if($this->request->getPost('id_id'))
        {

        $id = $this->request->getPost('id_id');

        $indemnity = $this->hr_model->FetchIDSingle($id);

        $indemnity->id_date = date('d M Y',strtotime($indemnity->id_date));

        $indemnity->id_employees = "";

        $indemnity->id_total = format_currency($indemnity->id_total);

        $io=0;

        foreach($indemnity->employees as $emp)
        {

            $indemnity->id_employees .= '
            <tr>
        
            <td class="text-center">'.++$io.'</td>
    
            <td class="text-center">'.$emp->emp_uid.'</td>
    
            <td class="text-start">'.$emp->emp_name.'</td>
    
            <td class="text-end">'.format_currency($emp->ide_basic_salary).'</td>
    
            <td class="text-center">'.date('d M Y',strtotime($emp->ide_date_of_join)).'</td>
    
            <td class="text-center">'.$emp->ide_entitlement.'</td>
    
            <td class="text-end">'.format_currency($emp->ide_indemnity).'</td>
    
            <td class="text-end">'.format_currency($emp->ide_advance).'</td>
    
            <td class="text-end">'.format_currency($emp->ide_indemnity-$emp->ide_advance).'</td>
            
            </tr>'
            ;
            

        }



        echo json_encode($indemnity);
    
        }

    }



    public function Delete()
    {

    $id = $this->request->getPost('id');

    $cond = array('id_id' => $id);
    
    $indemnity = $this->common_model->SingleRow('hr_indemnity',$cond);

    $this->common_model->DeleteData('hr_indemnity',$cond);

    $this->common_model->DeleteData('hr_indemnity_employees',array('ide_main_id' => $id));
    
    $jv_cond = array('jv_id' => $indemnity->id_jv_id);

    $this->common_model->DeleteData('accounts_journal_vouchers',$jv_cond);

    $this->common_model->DeleteData('accounts_journal_invoices',array('ji_voucher_id' => $indemnity->id_jv_id));


    }





    public function Print($id)
    {

    $this->hr_model = new \App\Models\HRModel();

    $id_data = $this->hr_model->FetchIDSingle($id);

    $id_emp ='';

    $sl=1;

    $advance_total = 0;

    $balance_total = 0;

    foreach($id_data->employees as $emp)
    {

    $id_emp .='
    
    <tr>

    <td align="center">'.$sl.'</td>

    <td align="center">'.$emp->emp_uid.'</td>

    <td align="left">'.$emp->emp_name.'</td>

    <td align="center">'.$emp->emp_nationality.'</td>

    <td align="center">'.date('d-M-Y',strtotime($emp->emp_date_of_join)).'</td>

    <td align="center">'.$emp->emp_qatar_id_no.'</td>

    <td align="right">'.format_currency($emp->ide_basic_salary).'</td>

    <td align="center">21</td>

    <td align="center">'.$emp->ide_entitlement.'</td>

    <td align="right">'.format_currency($emp->ide_indemnity).'</td>

    <td align="right">'.format_currency($emp->ide_advance).'</td>

    <td align="right">'.format_currency($emp->ide_amount).'</td>

    </tr>

    ';

    $advance_total += (float)$emp->ide_advance;

    $balance_total += ((float)$emp->ide_amount-(float)$emp->ide_advance);

    $sl++;

    }


   

    $id_emp .='
    
    <tr style="border:0px solid;">

    <td style="border:0px solid;" colspan="9"></td>

    <td style="border:0px solid;color:red" align="right">'.format_currency($id_data->id_total).'</td>

    <td style="border:0px solid;color:red" align="right">'.format_currency($advance_total).'</td> 

    <td style="border:0px solid;color:red" align="right">'.format_currency($balance_total).'</td>

    </tr>
    
    ';

   
    $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
    $fontDirs = $defaultConfig['fontDir'];

    $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
    $fontData = $defaultFontConfig['fontdata'];


    $mpdf = new \Mpdf\Mpdf([
        'format' => 'A4-L',
        'default_font_size' => 9, 
        'margin_left' => 5, 
        'margin_right' => 5,
        'margin_top' => 2,
        'fontDir' => array_merge($fontDirs, [
            __DIR__ . '/fonts'
        ]),
        'fontdata' => $fontData + [
            'bentonsans' => [
                'R' => 'FreeSerif.ttf',
                'B' => 'FreeSerifBold.ttf',
            ],
        ],
        'default_font' => 'bentonsans'
        
    ]);



    $html ='

    <html lang="en">

    <head>
  
    <style>

    body {
      font-family: bentonsans, sans-serif;
      margin: 40px;
      font-size:9px;
    }
    h2 {
      text-align: center;
    }
    .logo-text {
      font-size: 23px;
      margin: 0;
      color:grey;
    }

    p
    {
    
    }

    .seperator {
      border: 0;
      height: 2px;
      background: #999;
      margin-top: 10px;
    }
    
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 3px;
    }

    tr
    {
    border: 1px solid #999;
    }
    
    td
    {
    border-right: 1px solid #999;
    border-left: 1px solid #999;
    }

    th
    {
    border-right: 1px solid #999;
    border-left: 1px solid #999;
    }

    th, td {
      padding: 2px 2px;
      text-align: left;
    }

    .basic-info th, .basic-info td{
      padding: 2px;
      text-align: left;
    }


    .no-border-r
    {
    border-right: 0px solid #999;
    }

    .no-border-l
    {
    border-left: 0px solid #999;
    }

    .no-border-y
    {
    border-top: 0px solid #999;
    border-bottom: 0px solid #999;
    }

    .no-border
    {
    border-right: 0px solid #999;
    border-left: 0px solid #999;
    }

    .no-border-table
    {
    border:0px;
    }


    .no-border-table tr, .no-border-table td, .no-border-table th
    {
    border-right: 0px solid #999;
    border-left: 0px solid #999;
    border-top: 0px solid #999;
    border-bottom: 0px solid #999;
    border:0px;
    }
    
    .head
    {
    background:#f2f2f2;
    }

    .head th
    {
    border-right: 1px solid #999;
    text-align:center;
    }

    .section-title {
      font-weight: bold;
      margin-top: 30px;
      font-size: 1.1em;
    }

    .no-border {
      border: none !important;
    }


    .account-details td,.signature-sec td
    {
    
    height:100px;

    }

    .signature-section td {
      height: 80px;
      vertical-align: bottom;
      text-align: center;
    }


    .footer {
      text-align: center;
      margin-top: 50px;
      font-size: 0.9em;
    }

    .my-3{
    margin-top:3px;
    margin-bottom:3px;
    background:white;
    border-color:white;
    }

  </style>
</head>
<body>


<table class="no-border-table">

<tr>

<td align="center">INDEMNITY ACCRUAL - Al Fuzail Engineering Services WLL</td>

</tr>

</table>


<table>

<tr>
  <th align="center">SL #</th>
  <th align="center">Employee ID</th>
  <th align="center">Name</th>
  <th align="center">Nationality</th>
  <th align="center">D O J</th>
  <th align="center">QID/Visa</th>
  <th align="center">Basic Salary</th>
  <th align="center">Days/Year</th>
  <th align="center">Entitlement</th>
  <th align="center">Amount - Qr</th>
  <th align="center">Payment</th>
  <th align="center">Balance</th>
</tr>



'.$id_emp.'




</table>





</body>
</html>
    
    
    ';



    $footer="";

    $mpdf->falseBoldWeight = 0;

    $mpdf->WriteHTML($html);
    $mpdf->SetFooter($footer);

    $this->response->setHeader('Content-Type', 'application/pdf');

    $mpdf->Output();

    

    }












   


}