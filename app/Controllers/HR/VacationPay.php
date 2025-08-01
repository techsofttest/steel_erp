<?php

namespace App\Controllers\HR;

use App\Controllers\BaseController;


class VacationPay extends BaseController
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
       
        $totalRecords = $this->common_model->GetTotalRecords('hr_vacation_pay','vp_id','DESC');
 
        ## Total number of records with filtering
       
        $searchColumns = array('vp_id');

        $totalRecordwithFilter = $this->common_model->GetTotalRecordwithFilter('hr_vacation_pay','vp_id',$searchValue,$searchColumns);
    
        ##Joins if any //Pass Joins as Multi dim array
        $joins = array();
        ## Fetch records
        $records = $this->common_model->GetRecord('hr_vacation_pay','vp_id',$searchValue,$searchColumns,$columnName,$columnSortOrder,$joins,$rowperpage,$start);
    
        $data = array();

        $i=1;

        foreach($records as $record ){

        //$action = '<a  href="javascript:void(0)" class="edit edit-color view_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->pr_id.'" data-original-title="Edit"><i class="ri-eye-fill"></i> View</a> <a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->ts_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a> <a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->ts_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> Delete</a>';
           
        $action='<a  href="javascript:void(0)" class="edit edit-color view_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->vp_id.'" data-original-title=""><i class="ri-eye-fill"></i> </a> 
        <a href="javascript:void(0);" data-id="'.$record->vp_id.'" class="print_color" title="Print"><i class="ri-file-pdf-2-line " aria-hidden="true"></i></a>
        <a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->vp_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> </a>';

        $credit_data = $this->common_model->SingleRow('accounts_charts_of_accounts',array('ca_id' => $record->vp_credit_account));

        $credit_account = "";
        if(!empty($credit_data))
        $credit_account = $credit_data->ca_name;

        $debit_data = $this->common_model->SingleRow('accounts_charts_of_accounts',array('ca_id' => $record->vp_debit_account));

        $debit_account = "";
        if(!empty($debit_data))
        $debit_account = $debit_data->ca_name;

        $data[] = array( 
              "vp_id"=>$i,
              "vp_date" => date('d M Y',strtotime($record->vp_date)),
              "vp_debit_account" => $debit_account,
              "vp_credit_account" => $credit_account,
              "vp_total" => $record->vp_total,
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

            $account = $this->request->getPost('account');

            $debit_account = $this->request->getPost('debit_account');

            $date = date('Y-m-d',strtotime($this->request->getPost('date')));

            $credit_account_data = $this->common_model->SingleRow('accounts_charts_of_accounts',array('ca_id' => $account));

            $debit_account_data = $this->common_model->SingleRow('accounts_charts_of_accounts',array('ca_id' => $debit_account));

            $employees = $this->common_model->FetchWhere('hr_employees',array('emp_status' => 'Active'));

            //$account_ledger = $this->report_model->FetchGlBalance($date_from="", $date_to="", $account_head="", $account_type="", $account, $time_frame="",$range_from="",$range_to="");
        
            $account_ledger = $this->report_model->FetchGLTransactions($date_from="",$date="",$account_head="",$account_type="",$account,$time_frame="",$range_from="",$range_to="");

            $total_credit = array_sum(array_column($account_ledger,'credit_amount'));

            $total_debit = array_sum(array_column($account_ledger,'debit_amount'));

            $gl_balance = number_format($total_debit-$total_credit,2,'.','');

            $data['current_balance'] = abs($gl_balance);

            $data['emp_row'] = "";

            $data['total_amount'] = 0;

            $slno = 0;

            foreach($employees as $emp)
            {

                $slno++;
                
                $date1 = new \DateTime($emp->emp_date_of_join);
                $date2 = new \DateTime($date);
                $interval = $date1->diff($date2);
                $total_years = $interval->y;


                $vacation_pay_due_date_format = new \DateTime($emp->emp_vacation_pay_due_from);

                $selected_date_format = new \DateTime($date);


                $days_per_year = $this->calculateLeave($date,$emp->emp_date_of_join);

                $vacation_pay_due_date = date('Y-m-d',strtotime($emp->emp_vacation_pay_due_from. "+ 1 day"));

                $interval = $vacation_pay_due_date_format->diff($selected_date_format);

                $diff = $interval->days;

                $diff++;

                //Entitlement Calc
                //$diff = abs(strtotime($date) - strtotime($vacation_pay_due_date));

                $entitlement = $diff*$days_per_year/365;

                $entitlement = number_format($entitlement,2,'.');

                $amount = $emp->emp_basic_salary*12/365*$entitlement; 


                $data['emp_row'] .="
                
                    <tr>

                    <input type='hidden' name='emp_id[]' value='{$emp->emp_id}'>
                    <input type='hidden' name='vacation_due[]' value='{$emp->emp_vacation_pay_due_from}'>
                    <input type='hidden' name='basic_salary[]' value='{$emp->emp_basic_salary}'>
                    <input type='hidden' name='days_per_year[]' value='{$days_per_year}'>
                    <input type='hidden' name='entitlement[]' value='{$entitlement}'>
                    <input type='hidden' name='amount[]' value='{$amount}'>
                    

                    <td class='text-center'>{$slno}</td>
                    
                    <td class='text-center'>{$emp->emp_uid}</td>

                    <td class='text-start'>{$emp->emp_name}</td>

                    <td class='text-center'>".date('d M Y',strtotime($emp->emp_date_of_join))."</td>

                    <td class='text-center'>".date('d M Y',strtotime($emp->emp_vacation_pay_due_from))."</td>

                    <td class='text-end'>".format_currency($emp->emp_basic_salary)."</td>

                    <td class='text-center'>{$days_per_year}</td>

                    <td class='text-center'>{$entitlement}</td>

                    <td class='text-end'>".number_format((float)$amount,2,'.','')."</td>

                    </tr>
                
                ";
                
                $data['total_amount']+=number_format((float)$amount,2,'.','');

            }

            $jv_sl=0;

            $data['total_amount'] = number_format((float)$data['total_amount'],2,'.','');

            $data['jv_total'] = $data['total_amount']-$data['current_balance'];

            $data['jv_total'] = number_format((float)$data['jv_total'],2,'.','');

            $data['jv_rows'] ='';

            $data['jv_rows'] .='

              <tr class="jv_row">

                                        <th class="sl_no">'.++$jv_sl.'</th>

                                        <th class="select2_parent" width="35%"> 
                                            
                                        <input type="hidden" name="jv_account[]" value="'.$debit_account_data->ca_id.'">

                                        <input type="text" class="form-control"  value="'.$debit_account_data->ca_name.'" readonly>

                                        </th>
                                        
                                        <th><input name="jv_remarks[]" type="text" class="form-control" ></th>

                                        <th><input name="jv_debit[]" type="number" step="0.01" class="form-control" value="'.$data['jv_total'].'" readonly></th>

                                        <th><input name="jv_credit[]" type="number" class="form-control credit_amount" readonly></th>

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

                                        <th><input name="jv_debit[]" type="number" step="0.01" class="form-control" value="" readonly></th>

                                        <th><input name="jv_credit[]" type="number" class="form-control credit_amount" value="'.$data['jv_total'].'" readonly></th>

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

       return view('hr/vacation_pay',$data);

    }






    public function calculateLeave($curDate, $joinDate) {
        // Define the leave limits
        $leaveAllowedBefore5Years = 21;
        $leaveAllowedAfter5Years = 28;
    
        // Parse dates
        $currentDate = new \DateTime($curDate);
        $joinDate = new \DateTime($joinDate);
    
        // Calculate the 5-year anniversary
        $dateAfter5Years = clone $joinDate;
        $dateAfter5Years->add(new \DateInterval('P5Y'));
    
        // Calculate the 6-year anniversary
        $dateAfter6Years = clone $joinDate;
        $dateAfter6Years->add(new \DateInterval('P6Y'));
    
        // Case 1: Less than or equal to 5 years
        if ($currentDate < $dateAfter5Years) {
            return $leaveAllowedBefore5Years;
        }
    
        // Case 2: 6 or more years
        if ($currentDate >= $dateAfter6Years) {
            return $leaveAllowedAfter5Years;
        }
    
        // Case 3: Between 5 and 6 years
        $daysWorkedAfter5Years = $dateAfter5Years->diff($currentDate)->days; // Days worked after 5 years
        $totalDaysInYear = 365; // Assuming non-leap year
    
        // Proportional leave calculation
        $leave = $leaveAllowedBefore5Years + 
                 (($daysWorkedAfter5Years / $totalDaysInYear) * ($leaveAllowedAfter5Years - $leaveAllowedBefore5Years));
    
        return round($leave); // Round to 2 decimal places
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

            $date = date('Y-m-d',strtotime($this->request->getPost('date')));

            $credit_account_data = $this->common_model->SingleRow('accounts_charts_of_accounts',array('ca_id' => $credit_account));

            $debit_account_data = $this->common_model->SingleRow('accounts_charts_of_accounts',array('ca_id' => $debit_account));

            $employees = $this->common_model->FetchWhere('hr_employees',array('emp_status' => 'Active'));

            $account_ledger = $this->report_model->FetchGLTransactions($date_from="",$date_to="",$account_head="",$account_type="",$credit_account,$time_frame="",$range_from="",$range_to="");

            $total_credit = array_sum(array_column($account_ledger,'credit_amount'));

            $total_debit = array_sum(array_column($account_ledger,'debit_amount'));

            $gl_balance = number_format($total_debit-$total_credit,2,'.','');

            $data['current_balance'] = abs($gl_balance);

            $data['emp_row'] = "";

            $data['total_amount'] = 0;

            $insert_emp_data = [];

            foreach($employees as $emp)
            {

                $total_years = abs(strtotime($emp->emp_date_of_join) - strtotime($date));

                $total_years = floor($total_years / (365*60*60*24));


                $days_per_year = $this->calculateLeave($date,$emp->emp_date_of_join);


                $vacation_pay_due_date = date('Y-m-d',strtotime($emp->emp_vacation_pay_due_from. "+ 1 day"));

                //Entitlement Calc
                /*
                $diff = abs(strtotime($date) - strtotime($vacation_pay_due_date));

                $years = floor($diff / (365*60*60*24));
                $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

                $entitlement = $days*$days_per_year/365;

                $entitlement = number_format($entitlement,2,'.');
                */


                $date1 = new \DateTime($emp->emp_date_of_join);
                $date2 = new \DateTime($date);
                $interval = $date1->diff($date2);
                $total_years = $interval->y;


                $vacation_pay_due_date_format = new \DateTime($emp->emp_vacation_pay_due_from);

                $selected_date_format = new \DateTime($date);


                $days_per_year = $this->calculateLeave($date,$emp->emp_date_of_join);

                $vacation_pay_due_date = date('Y-m-d',strtotime($emp->emp_vacation_pay_due_from. "+ 1 day"));

                $interval = $vacation_pay_due_date_format->diff($selected_date_format);

                $diff = $interval->days;

                $diff++;

                //Entitlement Calc
                //$diff = abs(strtotime($date) - strtotime($vacation_pay_due_date));

                $entitlement = $diff*$days_per_year/365;

                $entitlement = number_format($entitlement,2,'.');



                $amount = $emp->emp_basic_salary*12/365*$entitlement;

                $data['total_amount']+=number_format((float)$amount,2,'.','');

                $insert_emp_data['vpe_vacation_due_from'][$emp->emp_id] = $vacation_pay_due_date;

                $insert_emp_data['vpe_basic_salary'][$emp->emp_id] = $emp->emp_basic_salary ?? "";

                $insert_emp_data['vpe_days_per_year'][$emp->emp_id] = $days_per_year;

                $insert_emp_data['vpe_entitlement'][$emp->emp_id] = $entitlement;

                $insert_emp_data['vpe_amount'][$emp->emp_id] = $amount;

                $insert_emp_data['vpe_emp_id'][$emp->emp_id] = $emp->emp_id;

            }

            $jv_sl=0;

            $data['total_amount'] = number_format((float)$data['total_amount'],2,'.','');



            //Insert Vacation Travel

            $insert_vacation_pay['vp_date'] =  $date;

            $insert_vacation_pay['vp_debit_account'] =  $debit_account;

            $insert_vacation_pay['vp_credit_account'] = $credit_account;

            $insert_vacation_pay['vp_current_balance'] = $data['current_balance'];
        
            $insert_vacation_pay['vp_total'] = $data['total_amount'];
        

        //Insert Journal voucher
       
        $insert_journal['jv_voucher_no'] = $jvid;

        $insert_journal['jv_date'] = date('Y-m-d',strtotime($formData['jv_date']));

        $insert_journal['jv_debit_total'] = $data['total_amount'];

        $insert_journal['jv_credit_total'] = $data['total_amount'];

        $insert_journal['jv_added_date'] = date('Y-m-d');

        $journal_id = $this->common_model->InsertData('accounts_journal_vouchers',$insert_journal);

        $vp_id = $this->common_model->InsertData('hr_vacation_pay',$insert_vacation_pay);


        //Insert employee details
        foreach ($insert_emp_data['vpe_emp_id'] as $emp_id => $value) {
            $vp_emp_data = [];
            
            foreach ($insert_emp_data as $column => $values) {
                $vp_emp_data[$column] = $values[$emp_id];
            }

            $vp_emp_data['vpe_vp_id'] = $vp_id;
        
            // Insert the data for this employee
            $this->common_model->InsertData('hr_vacation_pay_employees', $vp_emp_data);
        }
       

        $this->common_model->EditData(array('vp_jv_id' => $journal_id),array('vp_id' => $vp_id),'hr_vacation_pay');

        //Insert Journal invoices

            for ($ji = 0; $ji < count($formData['jv_account']); $ji++) {
                $account = $formData['jv_account'][$ji];
                $debit = !empty($formData['jv_debit'][$ji]) ? $formData['jv_debit'][$ji] : 0;
                $credit = !empty($formData['jv_credit'][$ji]) ? $formData['jv_credit'][$ji] : 0;
                $narration = $formData['jv_remarks'][$ji] ?? '';

                $insert_journal_invoice = [
                    'ji_voucher_id' => $journal_id,
                    'ji_account' => $account,
                    'ji_debit' => $debit,
                    'ji_credit' => $credit,
                    'ji_narration' => $narration
                ];

            $this->common_model->InsertData('accounts_journal_invoices', $insert_journal_invoice);

            }

        $return['msg'] = "Added to journal";

        $return['status'] = 1;

        }

        echo json_encode($return);


    }







    public function View()
    {

        $this->hr_model = new \App\Models\HRModel();

        if($this->request->getPost('vp_id'))
        {

        $id = $this->request->getPost('vp_id');

        $vacation_pay = $this->hr_model->FetchVPaySingle($id);

        $vacation_pay->vp_date = date('d M Y',strtotime($vacation_pay->vp_date));

        $vacation_pay->vp_employees = "";

        $io=1;

        foreach($vacation_pay->employees as $emp){

        $vacation_pay->vp_employees .='
        
        <tr>
        
        <td class="text-end">'.$io.'</td>

        <td class="text-end">'.$emp->emp_uid.'</td>

        <td class="text-end">'.$emp->emp_name.'</td>

        <td class="text-end">'.date('d M Y',strtotime($emp->emp_date_of_join)).'</td>

        <td class="text-end">'.date('d M Y',strtotime($emp->vpe_vacation_due_from)).'</td>

        <td class="text-end">'.$emp->vpe_basic_salary.'</td>

        <td class="text-end">'.$emp->vpe_days_per_year.'</td>

        <td class="text-end">'.$emp->vpe_entitlement.'</td>

        <td class="text-end">'.$emp->vpe_amount.'</td>
        
        </tr>
        
        ';

        $io++;
        

        }

        echo json_encode($vacation_pay);
    
        }

    }



    public function Delete()
    {

    $id = $this->request->getPost('id');

    $cond = array('vp_id' => $id);
    
    $vp = $this->common_model->SingleRow('hr_vacation_pay',$cond);

    $this->common_model->DeleteData('hr_vacation_pay',$cond);

    $this->common_model->DeleteData('hr_vacation_pay_employees',array('vpe_vp_id' => $id));

    $jv_cond = array('jv_id' => $vp->vp_jv_id);

    $this->common_model->DeleteData('accounts_journal_vouchers',$jv_cond);

    $this->common_model->DeleteData('accounts_journal_invoices',array('ji_voucher_id' => $vp->vp_jv_id));


    }






    public function Print($id)
    {

    $this->hr_model = new \App\Models\HRModel();

    $vp_data = $this->hr_model->FetchVPaySingle($id);

    $vp_emp ='';

    $sl=1;

    foreach($vp_data->employees as $emp)
    {

    $vp_emp .='
    
    <tr>

    <td align="center">'.$sl.'</td>

    <td align="center">'.$emp->emp_uid.'</td>

    <td align="left">'.$emp->emp_name.'</td>

    <td align="center">'.$emp->emp_nationality.'</td>

    <td align="center">'.date('d-M-Y',strtotime($emp->emp_date_of_join)).'</td>

    <td align="center">'.$emp->emp_qatar_id_no.'</td>

    <td align="center">'.date('d-M-Y',strtotime($emp->vpe_vacation_due_from)).'</td>

    <td align="right">'.format_currency($emp->vpe_basic_salary).'</td>

    <td align="center">'.$emp->vpe_days_per_year.'</td>

    <td align="center">'.$emp->vpe_entitlement.'</td>

    <td align="right">'.format_currency($emp->vpe_amount).'</td>

    </tr>

    ';

    $sl++;

    }


    $vp_emp .='
    
    <tr style="border:0px solid;">

    <td style="border:0px solid;color:red" colspan="11" align="right">'.format_currency($vp_data->vp_total).'</td>

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

<td align="center">VACATION PAY ACCRUAL - Al Fuzail Engineering Services WLL</td>

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
  <th align="center">Vacation Due From</th>
  <th align="center">Basic Salary</th>
  <th align="center">Days/Year</th>
  <th align="center">Entitlement</th>
  <th align="center">Amount - Qr</th>
</tr>



'.$vp_emp.'




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