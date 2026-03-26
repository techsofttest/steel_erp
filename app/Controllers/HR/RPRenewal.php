<?php

namespace App\Controllers\HR;

use App\Controllers\BaseController;


class RPRenewal extends BaseController
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
       
        $totalRecords = $this->common_model->GetTotalRecords('hr_rp_renewals','rpr_id','DESC');
 
        ## Total number of records with filtering
       
        $searchColumns = array('rpr_id');

        $totalRecordwithFilter = $this->common_model->GetTotalRecordwithFilter('hr_rp_renewals','rpr_id',$searchValue,$searchColumns);
    
        ##Joins if any //Pass Joins as Multi dim array
        $joins = array(
            array(
            'table' => 'accounts_journal_vouchers',
            'pk' => 'jv_id',
            'fk' => 'rpr_jv_id',
            )
        );

        ## Fetch records
        $records = $this->common_model->GetRecord('hr_rp_renewals','rpr_id',$searchValue,$searchColumns,$columnName,$columnSortOrder,$joins,$rowperpage,$start);
    
        $data = array();

        $i=1;

        foreach($records as $record ){

        //$action = '<a  href="javascript:void(0)" class="edit edit-color view_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->pr_id.'" data-original-title="Edit"><i class="ri-eye-fill"></i> View</a> <a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->ts_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a> <a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->ts_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> Delete</a>';
           
        $action='<a  href="javascript:void(0)" class="edit edit-color view_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->rpr_id.'" data-original-title=""><i class="ri-eye-fill"></i> </a> 
        <a href="javascript:void(0);" data-id="'.$record->rpr_id.'" class="print_color" title="Print"><i class="ri-file-pdf-2-line " aria-hidden="true"></i></a>
        <a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->rpr_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> </a>';

        $credit_data = $this->common_model->SingleRow('accounts_charts_of_accounts',array('ca_id' => $record->rpr_credit_account));

        $credit_account = "";
        if(!empty($credit_data))
        $credit_account = $credit_data->ca_name;

        $debit_data = $this->common_model->SingleRow('accounts_charts_of_accounts',array('ca_id' => $record->rpr_debit_account));

        $debit_account = "";
        if(!empty($debit_data))
        $debit_account = $debit_data->ca_name;

        $data[] = array( 
              "rpr_id"=>$i,
              "rpr_date" => date('d M Y',strtotime($record->rpr_date)),
              "jv" => $record->jv_voucher_no,
              "rpr_credit_account" => $debit_account,
              "rpr_debit_account" => $credit_account,
              "rpr_total" => $record->rpr_total,
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

            //$gl_balance = $this->report_model->FetchGlBalance($date_from="", $date_to="", $account_head="", $account_type="", $account, $time_frame="",$range_from="",$range_to="");
        
            $account_ledger = $this->report_model->FetchGLTransactions($date_from="",$date_l="",$account_head="",$account_type="",$account,$time_frame="",$range_from="",$range_to="");

            $total_credit = array_sum(array_column($account_ledger,'credit_amount'));

            $total_debit = array_sum(array_column($account_ledger,'debit_amount'));

            $gl_balance = number_format($total_debit-$total_credit,2,'.','');

            $data['current_balance'] = abs($gl_balance);

            $data['current_balance_view'] = format_currency($data['current_balance']);

            $data['emp_row'] = "";

            $data['total_amount'] = 0;

            $slno = 0;

            foreach($employees as $emp)
            {

                $slno++;
                
               

                $expiry_date = date('Y-m-d',strtotime($emp->emp_qatar_id_expiry));


               $expiry_date_f = new \DateTime($expiry_date);    // '2025-10-15'
                $selected_date = new \DateTime($date);           // '2025-07-31'

                // Calculate the exact difference in days
                $interval = $selected_date->diff($expiry_date_f);
                $days_between = $interval->format('%a');

                // If expiry is in the past
                if ($expiry_date_f < $selected_date) {
                    $entitlement = 0;
                } else {
                    $entitlement = 365 - $days_between;
                    if ($entitlement < 0) {
                        $entitlement = 0;
                    }
                }


                // Calculate Amount
                $defaultAmount = 1220;
                if ($entitlement > 365) {
                    $amount = $defaultAmount;
                } else {
                    $amount = ($defaultAmount / 365) * $entitlement;
                }


                //Entitlement Calc
                $diff = abs(strtotime($date) - strtotime($expiry_date));

                $years = floor($diff / (365*60*60*24));
                $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));




                $data['emp_row'] .="
                
                    <tr>

                    <input type='hidden' name='emp_id[]' value='{$emp->emp_id}'>
                    <input type='hidden' name='qid_number[]' value='{$emp->emp_qatar_id_no}'>
                    <input type='hidden' name='id_expiry_date[]' value='{$emp->emp_qatar_id_expiry}'>
                    <input type='hidden' name='entitlement[]' value='{$entitlement}'>
                    <input type='hidden' name='amount[]' value='{$amount}'>
                    

                    <td class='text-center'>{$slno}</td>
                    
                    <td class='text-center'>{$emp->emp_uid}</td>

                    <td class='text-start'>{$emp->emp_name}</td>

                    <td class='text-center'>{$emp->emp_qatar_id_no}</td>

                    <td class='text-center'>".date('d M Y',strtotime($emp->emp_date_of_join))."</td>

                    <td class='text-center'>".date('d M Y',strtotime($emp->emp_qatar_id_expiry))."</td>

                    <td class='text-end'>1,220.00</td>
                    
                    <td class='text-end'>".$entitlement."</td>

                    <td class='text-end'>".number_format((float)$amount,2,'.','')."</td>

                    </tr>
                
                ";
                
                $data['total_amount']+=number_format((float)$amount,2,'.','');


            }

            $jv_sl=0;

            $data['total_amount'] = round($data['total_amount']);

            $data['total_amount'] = number_format((float)$data['total_amount'],2,'.','');

            $data['jv_total'] = $data['total_amount']-$data['current_balance'];

            $data['jv_total'] = round($data['jv_total']) ;

            //$data['jv_total'] = number_format((float)$data['jv_total'],2,'.','');

            $data['jv_total'] = format_currency($data['jv_total']);

            $data['jv_rows'] ='';

            $data['jv_rows'] .='

              <tr class="jv_row">

                                        <th class="sl_no">'.++$jv_sl.'</th>

                                        <th class="select2_parent" width="35%"> 
                                            
                                        <input type="hidden" name="jv_account[]" value="'.$debit_account_data->ca_id.'">

                                        <input type="text" class="form-control"  value="'.$debit_account_data->ca_name.'" readonly>

                                        </th>
                                        
                                        <th><input name="jv_debit[]" type="text" class="form-control text-end" value="'.$data['jv_total'].'" readonly></th>

                                        <th><input name="jv_credit[]" type="text" class="form-control credit_amount text-end" readonly></th>

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
                                        
                                        

                                        <th><input name="jv_debit[]" type="text" class="form-control text-end" value="" readonly></th>

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

       return view('hr/rp_renewal',$data);

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

            $date = date('Y-m-d',strtotime($this->request->getPost('date')));

            $credit_account_data = $this->common_model->SingleRow('accounts_charts_of_accounts',array('ca_id' => $credit_account));

            $debit_account_data = $this->common_model->SingleRow('accounts_charts_of_accounts',array('ca_id' => $debit_account));

            $employees = $this->common_model->FetchWhere('hr_employees',array('emp_status' => 'Active'));

            //$gl_balance = $this->report_model->FetchGlBalance($date_from="", $date_to="", $account_head="", $account_type="", $credit_account, $time_frame="",$range_from="",$range_to="");
        
            $account_ledger = $this->report_model->FetchGLTransactions($date_from="",$date_to="",$account_head="",$account_type="", $credit_account,$time_frame="",$range_from="",$range_to="");

            $total_credit = array_sum(array_column($account_ledger,'credit_amount'));

            $total_debit = array_sum(array_column($account_ledger,'debit_amount'));

            $gl_balance = number_format($total_debit-$total_credit,2,'.','');

            $data['current_balance'] = abs($gl_balance);

            $data['emp_row'] = "";

            $data['total_amount'] = 0;

            $insert_emp_data = [];

            foreach($employees as $emp)
            {

                $expiry_date = date('Y-m-d',strtotime($emp->emp_qatar_id_expiry));

                $expiry_date_f = new \DateTime($expiry_date);    // '2025-10-15'
                $selected_date = new \DateTime($date);           // '2025-07-31'

                // Calculate the exact difference in days
                $interval = $selected_date->diff($expiry_date_f);
                $days_between = $interval->format('%a');

                // If expiry is in the past
                if ($expiry_date_f < $selected_date) {
                    $entitlement = 0;
                } else {
                    $entitlement = 365 - $days_between;
                    if ($entitlement < 0) {
                        $entitlement = 0;
                    }
                }


                // Calculate Amount
                $defaultAmount = 1220;
                if ($entitlement > 365) {
                    $amount = $defaultAmount;
                } else {
                    $amount = ($defaultAmount / 365) * $entitlement;
                }


                //Entitlement Calc
                $diff = abs(strtotime($date) - strtotime($expiry_date));

                $years = floor($diff / (365*60*60*24));
                $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

                $charges = 1220;

                $data['total_amount']+=number_format((float)$amount,2,'.','');

                $insert_emp_arr['rr_emp_id'][$emp->emp_id] = $emp->emp_id;
                $insert_emp_arr['rr_id_expiry_date'][$emp->emp_id] = $emp->emp_qatar_id_expiry;
                $insert_emp_arr['rr_charges'][$emp->emp_id] = $charges;
                $insert_emp_arr['rr_entitlement'][$emp->emp_id] = $entitlement;
                $insert_emp_arr['rr_amount'][$emp->emp_id] = $amount;   

            }

            $jv_sl=0;

            $data['total_amount'] = round($data['total_amount']);

            $data['jv_total'] = $data['total_amount']-$data['current_balance'];

            $data['jv_total'] = round($data['jv_total']);


            //Insert Vacation Travel

            $insert_rp['rpr_date'] =  $date;

            $insert_rp['rpr_credit_account'] =  $debit_account;

            $insert_rp['rpr_debit_account'] = $credit_account;

            $insert_rp['rpr_current_balance'] = $data['current_balance'];
        
            $insert_rp['rpr_total'] = $data['total_amount'];
        

        //Insert Journal voucher


        $juid = $this->request->getPost('juid');

        $insert_journal['jv_voucher_no'] = $juid;

        $insert_journal['jv_date'] = date('Y-m-d',strtotime($this->request->getPost('jv_date')));

        $insert_journal['jv_debit_total'] = $data['total_amount'];

        $insert_journal['jv_credit_total'] = $data['total_amount'];

        $insert_journal['jv_added_date'] = date('Y-m-d');

        $journal_id = $this->common_model->InsertData('accounts_journal_vouchers',$insert_journal);

        $rp_id = $this->common_model->InsertData('hr_rp_renewals',$insert_rp);


        //Insert employee details

       //Insert idemnity employees

       foreach ($insert_emp_arr['rr_emp_id'] as $emp_id)
       {

           $insert_emp_data['rr_id_expiry_date'] = $insert_emp_arr['rr_id_expiry_date'][$emp_id];
           $insert_emp_data['rr_charges'] = $insert_emp_arr['rr_charges'][$emp_id];
           $insert_emp_data['rr_entitlement'] = $insert_emp_arr['rr_entitlement'][$emp_id];
           $insert_emp_data['rr_amount'] = $insert_emp_arr['rr_amount'][$emp_id];
           $insert_emp_data['rr_emp_id'] = $insert_emp_arr['rr_emp_id'][$emp_id];
           $insert_emp_data['rr_main_id'] = $rp_id;
       
           $this->common_model->InsertData('hr_rp_renewals_employees',$insert_emp_data);

       }
       

        

        $this->common_model->EditData(array('rpr_jv_id' => $journal_id),array('rpr_id' => $rp_id),'hr_rp_renewals');

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

        $return['insert_id'] = $rp_id;

        $return['journal_id'] = $journal_id;

        }

        echo json_encode($return);


    }







    public function View()
    {

        $this->hr_model = new \App\Models\HRModel();

        if($this->request->getPost('rpr_id'))
        {

        $id = $this->request->getPost('rpr_id');

        $rp = $this->hr_model->FetchRPSingle($id);

        $rp->rpr_date = date('d M Y',strtotime($rp->rpr_date));

        $rp->rp_employees = "";

        $io=0;

        foreach($rp->employees as $emp)
        {

            $rp->rp_employees .= '
            <tr>
        
            <td class="text-end">'.++$io.'</td>
    
            <td class="text-end">'.$emp->emp_uid.'</td>
    
            <td class="text-end">'.$emp->emp_name.'</td>
    
            <td class="text-end">'.$emp->emp_qatar_id_no.'</td>
    
            <td class="text-end">'.date('d M Y',strtotime($emp->emp_date_of_join)).'</td>
    
            <td class="text-end">'.date('d M Y',strtotime($emp->rr_id_expiry_date)).'</td>
    
            <td class="text-end">'.format_currency($emp->rr_charges).'</td>
    
            <td class="text-end">'.format_currency($emp->rr_entitlement).'</td>
    
            <td class="text-end">'.format_currency($emp->rr_amount).'</td>
            
            </tr>'
            ;
            


        }

        echo json_encode($rp);
    
        }

    }



    public function Delete()
    {

    $id = $this->request->getPost('id');

    $cond = array('rpr_id' => $id);
    
    $rpr = $this->common_model->SingleRow('hr_rp_renewals',$cond);


    $jv_cond = array('jv_id' => $rpr->rpr_jv_id);

    $journal_check = $this->common_model->SingleRow('accounts_journal_vouchers',$jv_cond);

    if(!empty($journal_check))
    {

        $data['status'] = 0;

        $data['msg'] ="Please delete ".$journal_check->jv_voucher_no." to remove!";

        echo json_encode($data);

        exit;

    }


    $this->common_model->DeleteData('hr_rp_renewals',$cond);

    $this->common_model->DeleteData('hr_rp_renewals_employees',array('rr_main_id' => $id));

    

    //$this->common_model->DeleteData('accounts_journal_vouchers',$jv_cond);

    //$this->common_model->DeleteData('accounts_journal_invoices',array('ji_voucher_id' => $rpr->rpr_jv_id));

    $data['status'] = 1;

    $data['msg'] ="Data deleted successfully!";

    echo json_encode($data);


    }






    public function Print($id)
    {

      

    $this->hr_model = new \App\Models\HRModel();

    $rp_data = $this->hr_model->FetchRPSingle($id);

    $rp_emp ='';

    $sl=1;
 
    foreach($rp_data->employees as $emp)
    {

    $rp_emp .='
    
    <tr>

    <td align="center">'.$sl.'</td>

    <td align="center">'.$emp->emp_uid.'</td>

    <td align="left">'.$emp->emp_name.'</td>

    <td align="center">'.$emp->emp_nationality.'</td>

    <td align="center">'.date('d-M-Y',strtotime($emp->emp_date_of_join)).'</td>

    <td align="center">'.$emp->emp_qatar_id_no.'</td>

    <td align="right">'.format_currency($emp->emp_id_charges_deduction).'</td>

    <td align="center">'.date('d-M-Y',strtotime($emp->rr_id_expiry_date)).'</td>

    <td align="right">'.format_currency($emp->rr_charges).'</td>

    <td>'.$emp->rr_entitlement.'</td>

    <td align="right">'.format_currency($emp->rr_amount).'</td>

    </tr>

    ';

    $sl++;

    }

    $rp_emp .='
    
    <tr style="border:0px solid;">

    <td style="border:0px solid;color:red" colspan="11" align="right">'.format_currency($rp_data->rpr_total).'</td>

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
       /* 'fontDir' => array_merge($fontDirs, [
            __DIR__ . '/fonts'
        ]),
        'fontdata' => $fontData + [
            'bentonsans' => [
                'R' => 'FreeSerif.ttf',
                'B' => 'FreeSerifBold.ttf',
            ],
        ],
        'default_font' => 'bentonsans' */
        
    ]);



    $html ='

    <html lang="en">

    <head>
  
    <style>

    body {
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
    text-align:center;
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

<td align="center">RP RENEWAL ACCRUAL - Al Fuzail Engineering Services WLL</td>

</tr>

</table>


<table>

<tr>
  <th align="center">SL #</th>
  <th align="center">Employee ID</th>
  <th align="center">Name</th>
  <th align="center">Nationality</th>
  <th align="center">D O J</th>
  <th align="center">QID / Visa</th>
  <th align="center">ID Deduction</th>
  <th align="center">ID Expiry</th>
  <th align="center">RP Charges</th>
  <th align="center">Days</th>
  <th align="center">Amount (QR)</th>
</tr>



'.$rp_emp.'




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