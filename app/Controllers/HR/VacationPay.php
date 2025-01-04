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
           
        $action='<a  href="javascript:void(0)" class="edit edit-color view_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->vp_id.'" data-original-title=""><i class="ri-eye-fill"></i> View</a> <a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->vt_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i></a>';

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

            $employees = $this->common_model->FetchAll('hr_employees');

            $gl_balance = $this->report_model->FetchGlBalance($date_from="", $date_to="", $account_head="", $account_type="", $account, $time_frame="",$range_from="",$range_to="");
        
            $data['current_balance'] = $gl_balance['balance'];

            $data['emp_row'] = "";

            $data['total_amount'] = 0;

            $slno = 0;

            foreach($employees as $emp)
            {

                $slno++;
                
                $total_years = abs(strtotime($emp->emp_date_of_join) - strtotime($date));

                $total_years = floor($total_years / (365*60*60*24));


                $days_per_year = $this->calculateLeave($date,$emp->emp_date_of_join);


                $vacation_pay_due_date = date('Y-m-d',strtotime($emp->emp_vacation_pay_due_from. "+ 1 day"));

                //Entitlement Calc
                $diff = abs(strtotime($date) - strtotime($vacation_pay_due_date));

                $years = floor($diff / (365*60*60*24));
                $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

                $entitlement = $days*$days_per_year/365;

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
                    

                    <td>{$slno}</td>
                    
                    <td>{$emp->emp_uid}</td>

                    <td>{$emp->emp_name}</td>

                    <td>".date('d M Y',strtotime($emp->emp_date_of_join))." ({$total_years} Y)</td>

                    <td>".date('d M Y',strtotime($emp->emp_vacation_pay_due_from))."</td>

                    <td align='right'>".format_currency($emp->emp_basic_salary)."</td>

                    <td>{$days_per_year}</td>

                    <td>{$entitlement}</td>

                    <td class='text-end'>".number_format((float)$amount,2,'.','')."</td>

                    </tr>
                
                ";
                
                $data['total_amount']+=number_format((float)$amount,2,'.','');

            }

            $jv_sl=0;

            $data['total_amount'] = number_format((float)$data['total_amount'],2,'.','');

            $data['jv_rows'] ='';

            $data['jv_rows'] .='

              <tr class="jv_row">

                                        <th class="sl_no">'.++$jv_sl.'</th>

                                        <th class="select2_parent" width="35%"> 
                                            
                                        <input type="hidden" name="jv_account[]" value="'.$debit_account_data->ca_id.'">

                                        <input type="text" class="form-control"  value="'.$debit_account_data->ca_name.'" readonly>

                                        </th>
                                        
                                        <th><input name="jv_remarks[]" type="text" class="form-control" ></th>

                                        <th><input name="jv_debit[]" type="number" step="0.01" class="form-control" value="'.$data['total_amount'].'" readonly></th>

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

                                        <th><input name="jv_credit[]" type="number" class="form-control credit_amount" value="'.$data['total_amount'].'" readonly></th>

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

            $date = date('Y-m-d',strtotime($this->request->getPost('date')));

            $credit_account_data = $this->common_model->SingleRow('accounts_charts_of_accounts',array('ca_id' => $credit_account));

            $debit_account_data = $this->common_model->SingleRow('accounts_charts_of_accounts',array('ca_id' => $debit_account));

            $employees = $this->common_model->FetchAll('hr_employees');

            $gl_balance = $this->report_model->FetchGlBalance($date_from="", $date_to="", $account_head="", $account_type="", $credit_account, $time_frame="",$range_from="",$range_to="");
        
            $data['current_balance'] = $gl_balance['balance'];

            $data['emp_row'] = "";

            $data['total_amount'] = 0;

            foreach($employees as $emp)
            {

                $ticket_due_date = date('Y-m-d',strtotime($emp->emp_air_ticket_due_from. "+ 1 day"));

                $diff = abs(strtotime($ticket_due_date) - strtotime($date));

                $years = floor($diff / (365*60*60*24));
                $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

                $entitlement = $days;

                $amount = $emp->emp_budgeted_ticket_amount*$emp->emp_air_ticket_per_year*$entitlement;

                $amount = $amount/365;


                $data['total_amount']+=number_format((float)$amount,2,'.','');

            }

            $jv_sl=0;

            $data['total_amount'] = number_format((float)$data['total_amount'],2,'.','');



        //Insert Vacation Travel

        $insert_vacation_pay['vp_date'] =  $date;

        $insert_vacation_pay['vp_debit_account'] =  $debit_account;

        $insert_vacation_pay['vp_credit_account'] = $credit_account;

        $insert_vacation_pay['vp_current_balance'] = 0;
       
        $insert_vacation_pay['vp_total'] = $data['total_amount'];
        

        //Insert Journal voucher


        $juid = $this->common_model->FetchNextId('accounts_journal_vouchers',"JV-{$this->data['accounting_year']}-");

        $insert_journal['jv_voucher_no'] = $juid;

        $insert_journal['jv_date'] = date('Y-m-d',strtotime($formData['jv_date']));

        $insert_journal['jv_debit_total'] = $data['total_amount'];

        $insert_journal['jv_credit_total'] = $data['total_amount'];

        $insert_journal['jv_added_date'] = date('Y-m-d');

        $journal_id = $this->common_model->InsertData('accounts_journal_vouchers',$insert_journal);

        $vt_id = $this->common_model->InsertData('hr_vacation_travel',$insert_vacation_travel);

        $this->common_model->EditData(array('vt_jv_id' => $journal_id),array('vt_id' => $vt_id),'hr_vacation_travel');

        //Insert Journal invoices

            for ($ji = 0; $ji < count($formData['jv_account']); $ji++) {
                $account = $formData['jv_account'][$ji];
                $debit = !empty($formData['jv_debit'][$ji]) ? $formData['jv_debit'][$ji] : 0;
                $credit = !empty($formData['jv_credit'][$ji]) ? $formData['jv_credits'][$ji] : 0;
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

        if($this->request->getPost('vt_id'))
        {

        $id = $this->request->getPost('vt_id');

        $vacation_travel = $this->hr_model->FetchVTSingle($id);

        $vacation_travel->vt_date = date('d M Y',strtotime($vacation_travel->vt_date));

        echo json_encode($vacation_travel);
    
        }

    }



    public function Delete()
    {



    $id = $this->request->getPost('id');


    $cond = array('vt_id' => $id);
    
    $vt = $this->common_model->SingleRow('hr_vacation_travel',$cond);

    $this->common_model->DeleteData('hr_vacation_travel',$cond);

    $jv_cond = array('jv_id' => $vt->vt_jv_id);

    $this->common_model->DeleteData('accounts_journal_vouchers',$jv_cond);

    $this->common_model->DeleteData('accounts_journal_invoices',array('ji_voucher_id' => $vt->vt_jv_id));


    }













   


}