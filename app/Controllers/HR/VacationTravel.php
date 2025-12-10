<?php

namespace App\Controllers\HR;

use App\Controllers\BaseController;

use DateTime;

class VacationTravel extends BaseController
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
       
        $totalRecords = $this->common_model->GetTotalRecords('hr_vacation_travel','vt_id','DESC');
 
        ## Total number of records with filtering
       
        $searchColumns = array('vt_id');

        $totalRecordwithFilter = $this->common_model->GetTotalRecordwithFilter('hr_vacation_travel','vt_id',$searchValue,$searchColumns);
    
        ##Joins if any //Pass Joins as Multi dim array 
        $joins = array();
        ## Fetch records
        $records = $this->common_model->GetRecord('hr_vacation_travel','vt_id',$searchValue,$searchColumns,$columnName,$columnSortOrder,$joins,$rowperpage,$start);
    
        $data = array();

        $i=1;

        foreach($records as $record ){

        //$action = '<a  href="javascript:void(0)" class="edit edit-color view_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->pr_id.'" data-original-title="Edit"><i class="ri-eye-fill"></i> View</a> <a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->ts_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a> <a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->ts_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> Delete</a>';
           
        $action='<a  href="javascript:void(0)" class="edit edit-color view_btn" data-toggle="tooltip" data-placement="top" title="View"  data-id="'.$record->vt_id.'" data-original-title=""><i class="ri-eye-fill"></i> </a>
        <a href="javascript:void(0);" data-id="'.$record->vt_id.'" class="print_color" title="Print"><i class="ri-file-pdf-2-line " aria-hidden="true"></i></a>
        <a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->vt_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> </a>';

        $credit_data = $this->common_model->SingleRow('accounts_charts_of_accounts',array('ca_id' => $record->vt_credit_account));

        $credit_account = "";
        if(!empty($credit_data))
        $credit_account = $credit_data->ca_name;

        $debit_data = $this->common_model->SingleRow('accounts_charts_of_accounts',array('ca_id' => $record->vt_debit_account));

        $debit_account = "";
        if(!empty($debit_data))
        $debit_account = $debit_data->ca_name;

        $data[] = array( 
              "vt_id"=>$i,
              "vt_date" => date('d M Y',strtotime($record->vt_date)),
              "vt_debit_account" => $debit_account,
              "vt_credit_account" => $credit_account,
              "vt_total" => format_currency($record->vt_total),
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





    //Fetch Employees

         public function FetchEmployees()
         {

            $this->hr_model = new \App\Models\HRModel();

            $account = $this->request->getPost('account');

            $debit_account = $this->request->getPost('debit_account');

            $date = date('Y-m-d',strtotime($this->request->getPost('date')));

            //echo $date; exit;
            
            $credit_account_data = $this->common_model->SingleRow('accounts_charts_of_accounts',array('ca_id' => $account));

            $debit_account_data = $this->common_model->SingleRow('accounts_charts_of_accounts',array('ca_id' => $debit_account));

            $employees = $this->common_model->FetchAll('hr_employees');

            //$gl_balance = $this->report_model->FetchGlBalance($date_from="", $date_to="", $account_head="", $account_type="", $account, $time_frame="",$range_from="",$range_to="");
        
            $account_ledger = $this->report_model->FetchGLTransactions($date_from="",$date_to="",$account_head="",$account_type="",$account,$time_frame="",$range_from="",$range_to="");

            $total_credit = array_sum(array_column($account_ledger,'credit_amount'));

            $total_debit = array_sum(array_column($account_ledger,'debit_amount'));

            //Nothing 

            $gl_balance = number_format($total_debit-$total_credit,2,'.','');

            $data['current_balance'] = abs($gl_balance);

            $data['current_balance_view'] = format_currency($data['current_balance']);

            $data['emp_row'] = "";

            $data['total_amount'] = 0;

            $data['total_amount_view'] = 0;

            $slno=0;

            foreach($employees as $emp)
            {

                $slno++;


                $total_vacations = $this->hr_model->FetchVacationTotal($date,$emp->emp_id);

                $total_vacations = $total_vacations+$emp->emp_vacation_taken;


                //$ticket_due_date_format = new DateTime($emp->emp_air_ticket_due_from);

                //$selected_date_format = new DateTime($date);

                //$interval = $ticket_due_date_format->diff($selected_date_format);

                //$diff = $interval->days;

                //$diff = abs(strtotime($ticket_due_date) - strtotime($date));

                //$years = floor($diff / (365*60*60*24));
                //$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                //$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

                $diff = (int)(abs(strtotime($date) - strtotime($emp->emp_air_ticket_due_from)) / 86400);
                
                $entitlement = $diff + 1; // 286

                //$entitlement = $diff+1;

                $amount = $emp->emp_budgeted_ticket_amount*$emp->emp_air_ticket_per_year*$entitlement;

                $amount = $amount/365;

                //$amount = round($amount);
                                

                $data['emp_row'] .="
                
                    <tr>

                    <td class='text-center'>{$slno}</td>
                    
                    <td class='text-center'>{$emp->emp_uid}</td>

                    <td class='text-start'>{$emp->emp_name}</td>

                    <td class='text-center'>".date('d M Y',strtotime($emp->emp_air_ticket_due_from))."</td>

                    <td align='right'>".format_currency($emp->emp_budgeted_ticket_amount)."</td>

                    <td class='text-center'>{$emp->emp_air_ticket_per_year}</td>

                    <td class='text-center'>{$total_vacations}</td>

                    <td class='text-center'>{$entitlement}</td>

                    <td class='text-end'>".format_currency($amount)."</td>

                    </tr>
                
                ";
                
                $data['total_amount']+=number_format((float)$amount,2,'.','');

            }

            $jv_sl=0;

            $data['total_amount'] = number_format((float)$data['total_amount'],2,'.','');

            $data['total_amount'] = round($data['total_amount']);

            $data['total_amount_view'] = format_currency($data['total_amount']);

            $data['jv_total'] = $data['total_amount']-$data['current_balance'];

            $data['jv_total'] =  number_format((float)$data['jv_total'],2,'.','');

            $data['jv_total'] = format_currency($data['jv_total']);

            $data['jv_rows'] ='';

            $data['jv_rows'] .='

              <tr class="jv_row">

                                        <th class="sl_no">'.++$jv_sl.'</th>

                                        <th class="select2_parent" width="35%"> 
                                            
                                        <input type="hidden" name="jv_account[]" value="'.$debit_account_data->ca_id.'">

                                        <input type="text" class="form-control"  value="'.$debit_account_data->ca_name.'" readonly>

                                        </th>
                                        
                                        

                                        <th><input name="jv_debit[]" type="text" step="0.01" class="form-control text-end" value="'.$data['jv_total'].'" readonly></th>

                                        <th><input name="jv_credit[]" type="text" class="form-control text-end credit_amount" readonly></th>

                                        <th><input name="jv_remarks[]" type="text" class="form-control" ></th>

            </tr>

            
            ';


            $data['jv_rows'] .='

            <tr class="jv_row">

                                        <th class="sl_no">'.++$jv_sl.'</th>

                                        <th class="select2_parent" width="35%"> 
                                            
                                        <input type="hidden" name="jv_account[]" value="'.$credit_account_data->ca_id.'">

                                        <input type="text" class="form-control"  value="'.$credit_account_data->ca_name.'" readonly>

                                        </th>
                                        
                                        

                                        <th><input name="jv_debit[]" type="text" step="0.01" class="form-control text-end" value="" readonly></th>

                                        <th><input name="jv_credit[]" type="text" class="form-control credit_amount text-end" value="'.$data['jv_total'].'" readonly></th>

                                        <th><input name="jv_remarks[]" type="text" class="form-control" ></th>

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

       return view('hr/vacation_travel',$data);

    }



    public function AddJournal()
    {

        $this->hr_model = new \App\Models\HRModel();

        if($this->request->getPost())

        {
        
            $serializedData = $this->request->getPost('journal_form');  
            $formData = [];
            parse_str($serializedData, $formData);

            $credit_account = $this->request->getPost('credit_account');

            $debit_account = $this->request->getPost('debit_account');

            $jvid = $formData['jv_uid'];

            $dfull = date('Y-m-d',strtotime($this->request->getPost('date')));

            $year = date('Y',strtotime($this->request->getPost('date')));

            $credit_account_data = $this->common_model->SingleRow('accounts_charts_of_accounts',array('ca_id' => $credit_account));

            $debit_account_data = $this->common_model->SingleRow('accounts_charts_of_accounts',array('ca_id' => $debit_account));

            $employees = $this->common_model->FetchAll('hr_employees');

            //$gl_balance = $this->report_model->FetchGlBalance($date_from="", $date_to="", $account_head="", $account_type="", $credit_account, $time_frame="",$range_from="",$range_to="");
        
            $account_ledger = $this->report_model->FetchGLTransactions($date_from="",$date_to="",$account_head="",$account_type="",$debit_account,$time_frame="",$range_from="",$range_to="");

            $total_credit = array_sum(array_column($account_ledger,'credit_amount'));

            $total_debit = array_sum(array_column($account_ledger,'debit_amount'));

            $gl_balance = number_format($total_debit-$total_credit,2,'.','');
            
            $data['current_balance'] = abs($gl_balance);

            $data['emp_row'] = "";

            $data['total_amount'] = 0;

            foreach($employees as $emp)
            {

                $total_vacations = $this->hr_model->FetchVacationTotal($dfull,$emp->emp_id);

                $total_vacations = $total_vacations+$emp->emp_vacation_taken;

                //$ticket_due_date = date('Y-m-d',strtotime($emp->emp_air_ticket_due_from));


                //$ticket_due_date_format = new DateTime($ticket_due_date);

                //$selected_date_format = new DateTime($date);

                //$interval = $ticket_due_date_format->diff($selected_date_format);

                //$diff = $interval->days;

                //$entitlement = $diff;

                //$from = new DateTime($emp->emp_air_ticket_due_from); // Vacation Due From
                //$to   = new DateTime($date); // Selected Report Date

                //$interval = $from->diff($to);

                // Excel formula: (to - from) + 1
                //$entitlement = $interval->days + 1;

                $diff = (int)(abs(strtotime($dfull) - strtotime($emp->emp_air_ticket_due_from)) / 86400);
                
                $entitlement = $diff + 1;

                $amount = $emp->emp_budgeted_ticket_amount*$emp->emp_air_ticket_per_year*$entitlement;

                $amount = $amount/365;


                $data['total_amount']+=number_format((float)$amount,2,'.','');

                //$insert_emp_data['vte_main_id'] = '';
                $insert_emp_arr['vte_emp_id'][$emp->emp_id] = $emp->emp_id;
                $insert_emp_arr['vte_ticket_due_from'][$emp->emp_id] = $emp->emp_air_ticket_due_from ?? "2025-01-01";
                $insert_emp_arr['vte_ticket_rate'][$emp->emp_id] = $emp->emp_budgeted_ticket_amount ?? 0;
                $insert_emp_arr['vte_ticket_per_year'][$emp->emp_id] = $emp->emp_air_ticket_per_year ?? 0;
                $insert_emp_arr['vte_utilization'][$emp->emp_id] = $total_vacations;                                                                                                                          
                $insert_emp_arr['vte_entitlement'][$emp->emp_id] = $entitlement;
                $insert_emp_arr['vte_amount'][$emp->emp_id] = $amount;

            }

            $jv_sl=0;

            $data['total_amount'] = number_format((float)$data['total_amount'],2,'.','');


            $data['total_amount'] = round($data['total_amount']);


        //Insert Vacation Travel

        $insert_vacation_travel['vt_date'] =  $dfull;

        $insert_vacation_travel['vt_debit_account'] =  $debit_account;

        $insert_vacation_travel['vt_credit_account'] = $credit_account;

        $insert_vacation_travel['vt_current_balance'] = $data['current_balance'];
       
        $insert_vacation_travel['vt_total'] = $data['total_amount'];
        

        //Insert Journal voucher
        
        //$juid = $this->common_model->FetchNextId('accounts_journal_vouchers','jv_voucher_no',"JV-{$year}-",$year);

        $insert_journal['jv_voucher_no'] = $jvid;

        $insert_journal['jv_date'] = date('Y-m-d',strtotime($formData['jv_date']));

        $insert_journal['jv_debit_total'] = $data['total_amount'];

        $insert_journal['jv_credit_total'] = $data['total_amount'];


        $insert_journal['jv_added_date'] = date('Y-m-d');

        $journal_id = $this->common_model->InsertData('accounts_journal_vouchers',$insert_journal);

        $vt_id = $this->common_model->InsertData('hr_vacation_travel',$insert_vacation_travel);


        foreach ($insert_emp_arr['vte_emp_id'] as $emp_id)
        {

            $insert_emp_data['vte_emp_id'] = $insert_emp_arr['vte_emp_id'][$emp_id];
            $insert_emp_data['vte_ticket_due_from']= $insert_emp_arr['vte_ticket_due_from'][$emp_id];
            $insert_emp_data['vte_ticket_rate'] = $insert_emp_arr['vte_ticket_rate'][$emp_id];
            $insert_emp_data['vte_ticket_per_year'] = $insert_emp_arr['vte_ticket_per_year'][$emp_id];
            $insert_emp_data['vte_utilization'] = $insert_emp_arr['vte_utilization'][$emp_id];
            $insert_emp_data['vte_entitlement'] = $insert_emp_arr['vte_entitlement'][$emp_id];
            $insert_emp_data['vte_amount'] = $insert_emp_arr['vte_amount'][$emp_id];
            $insert_emp_data['vte_main_id'] = $vt_id;
        
            $this->common_model->InsertData('hr_vacation_travel_employees',$insert_emp_data);

        }




        $this->common_model->EditData(array('vt_jv_id' => $journal_id),array('vt_id' => $vt_id),'hr_vacation_travel');

        //Insert Journal invoices

            for ($ji = 0; $ji < count($formData['jv_account']); $ji++) {
                $account = $formData['jv_account'][$ji];
                $debit = !empty($formData['jv_debit'][$ji]) ? $formData['jv_debit'][$ji] : 0;
                $credit = !empty($formData['jv_credit'][$ji]) ? $formData['jv_credit'][$ji] : 0;
                $narration = $formData['jv_remarks'][$ji] ?? '';

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

        $return['insert_id'] = $vt_id;

        }

        echo json_encode($return);


    }







    public function View()
    {

        $this->hr_model = new \App\Models\HRModel();

        if($this->request->getPost('vt_id'))
        {

        $id = $this->request->getPost('vt_id');

        $vacation_travel = $this->hr_model->FetchVTSingle($id);

        $vacation_travel->vt_date = date('d M Y',strtotime($vacation_travel->vt_date));

        $vacation_travel->vt_employees = "";

        $io = 1;

        foreach($vacation_travel->employees as $emp)
        {

        $vacation_travel->vt_employees .='
        
        <tr>
        
        <td class="text-center">'.$io.'</td>

        <td class="text-center">'.$emp->emp_uid.'</td>

        <td class="text-start">'.$emp->emp_name.'</td>

        <td class="text-center">'.date('d M Y',strtotime($emp->vte_ticket_due_from)).'</td>

        <td class="text-end">'.format_currency($emp->vte_ticket_rate).'</td>

        <td class="text-center">'.$emp->vte_ticket_per_year.'</td>

        <td class="text-center">'.$emp->vte_utilization.'</td>

        <td class="text-center">'.$emp->vte_entitlement.'</td>

        <td class="text-end">'.format_currency($emp->vte_amount).'</td>
        
        </tr>
        
        ';

        $io++;

        }



        echo json_encode($vacation_travel);
    
        }

    }



    public function Delete()
    {



    $id = $this->request->getPost('id');


    $cond = array('vt_id' => $id);
    
    $vt = $this->common_model->SingleRow('hr_vacation_travel',$cond);

    

    //Delete VT Emp Tables

    $jv_cond = array('jv_id' => $vt->vt_jv_id);

    $journal_check = $this->common_model->SingleRow('accounts_journal_vouchers',$jv_cond);

    if(!empty($journal_check))
        {

        $data['status'] = 0;

        $data['msg'] ="Please delete ".$journal_check->jv_voucher_no." to remove!";

        echo json_encode($data);

        exit;

    }

    $this->common_model->DeleteData('hr_vacation_travel',$cond);

    $this->common_model->DeleteData('hr_vacation_travel_employees',array('vte_main_id'=> $id));

    $data['status'] = 1;

    $data['msg'] ="Data deleted successfully!";

    echo json_encode($data);

    //$this->common_model->DeleteData('accounts_journal_vouchers',$jv_cond);

    //$this->common_model->DeleteData('accounts_journal_invoices',array('ji_voucher_id' => $vt->vt_jv_id));



    }






    public function Print($id){

    $this->hr_model = new \App\Models\HRModel();


    $vt_data = $this->hr_model->FetchVTPrint($id);



    $vt_emp ='';


    $sl=1;

    foreach($vt_data->employees as $emp)
    {


    $vt_emp .='
    

    <tr>

    <td align="center">'.$sl.'</td>

    <td align="center">'.$emp->emp_uid.'</td>

    <td align="left">'.$emp->emp_name.'</td>

    <td align="center">'.$emp->emp_nationality.'</td>

    <td align="center">'.$emp->emp_designation.'</td>

    <td align="center">'.date('d-M-Y',strtotime($emp->emp_date_of_join)).'</td>

    <td align="center">'.$emp->emp_qatar_id_no.'</td>

    <td align="center">'.$emp->emp_passport_no.'</td>

    <td align="center">'.$emp->emp_contact_no.'</td>

    <td align="center">'.date('d-M-Y',strtotime($emp->emp_air_ticket_due_from)).'</td>

    <td align="right">'.format_currency($emp->emp_budgeted_ticket_amount).'</td>

    <td align="center">'.$emp->vte_utilization.'</td>

    <td align="center">'.$emp->vte_ticket_per_year.'</td>

    <td align="center">'.$emp->vte_entitlement.'</td>

    <td align="right">'.format_currency($emp->vte_amount).'</td>

    </tr>

    ';


    $sl++;

    }

    $vt_emp .='
    
    <tr style="border:0px solid;">

    <td style="border:0px solid;color:red" colspan="15" align="right">'.format_currency($vt_data->vt_total).'</td>

    </tr>
    
    ';

   
    $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
    $fontDirs = $defaultConfig['fontDir'];

    $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
    $fontData = $defaultFontConfig['fontdata'];


    $mpdf = new \Mpdf\Mpdf([
        'format' => 'A4-L',
        'default_font_size' => 7, 
        'margin_left' => 5, 
        'margin_right' => 5,
        'margin_top' => 2,
        /*'fontDir' => array_merge($fontDirs, [
            __DIR__ . '/fonts'
        ]),
        'fontdata' => $fontData + [
            'bentonsans' => [
                'R' => 'FreeSerif.ttf',
                'B' => 'FreeSerifBold.ttf',
            ],
        ],
        'default_font' => 'bentonsans'
        */
    ]);



    $html ='

    <html lang="en">

    <head>
  
    <style>

    body {
      margin: 40px;
      font-size:7px;
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
    text-align:center;
    border-right: 1px solid #999;
    border-left: 1px solid #999;
    }

    th, td {
      padding: 2px 5px;
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

<td align="center">VACATION TRAVEL ACCRUAL - Al Fuzail Engineering Services WLL</td>

</tr>

</table>


<table>


<tr>

<th align="center">Sl</th>

<th align="center">Emp ID</th>

<th align="center" style="width:130px;">Name</th>

<th align="center">Nationality</th>

<th align="center" style="width:130px;">Designation</th>

<th align="center">D O J</th>

<th align="center">QID / Visa</th>

<th align="center">Passport</th>

<th align="center">Contact</th>

<th align="center">Vacation Due</th>

<th align="center">Ticket Rate</th>

<th align="center">Utilised</th>

<th align="center">Ticket/Year</th>

<th align="center">Entitlement</th>

<th align="center">Amount - Qr</th>


</tr>


'.$vt_emp.'


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