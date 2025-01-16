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
        $joins = array();
        ## Fetch records
        $records = $this->common_model->GetRecord('hr_rp_renewals','rpr_id',$searchValue,$searchColumns,$columnName,$columnSortOrder,$joins,$rowperpage,$start);
    
        $data = array();

        $i=1;

        foreach($records as $record ){

        //$action = '<a  href="javascript:void(0)" class="edit edit-color view_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->pr_id.'" data-original-title="Edit"><i class="ri-eye-fill"></i> View</a> <a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->ts_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a> <a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->ts_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> Delete</a>';
           
        $action='<a  href="javascript:void(0)" class="edit edit-color view_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->rpr_id.'" data-original-title=""><i class="ri-eye-fill"></i></a> 
        <a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->rpr_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i></a>';

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

            $gl_balance = $this->report_model->FetchGlBalance($date_from="", $date_to="", $account_head="", $account_type="", $account, $time_frame="",$range_from="",$range_to="");
        
            $data['current_balance'] = $gl_balance['balance'];

            $data['emp_row'] = "";

            $data['total_amount'] = 0;

            $slno = 0;

            foreach($employees as $emp)
            {

                $slno++;
                
               

                $expiry_date = date('Y-m-d',strtotime($emp->emp_qatar_id_expiry));


                // Convert dates to DateTime objects
                $expiryDateObj = new \DateTime($expiry_date);
                $currentDateObj = new \DateTime($date);

                // Calculate the difference in days
                $daysDifference = $expiryDateObj->diff($currentDateObj)->days;

                // Determine whether the expiry date is in the past or future
                if ($expiryDateObj < $currentDateObj) {
                    // If expiry date is in the past, consider the days difference as negative
                    $daysDifference = -$daysDifference;
                }

                // Calculate Entitlement
                $entitlement = 365 - $daysDifference;
                if ($entitlement < 0) {
                    $entitlement = 0;
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
                    

                    <td>{$slno}</td>
                    
                    <td>{$emp->emp_uid}</td>

                    <td>{$emp->emp_name}</td>

                    <td>{$emp->emp_qatar_id_no}</td>

                    <td>".date('d M Y',strtotime($emp->emp_date_of_join))."</td>

                    <td>".date('d M Y',strtotime($emp->emp_qatar_id_expiry))."</td>

                    <td align='right'>1,220.00</td>
                    
                    <td>".$entitlement."</td>

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

            $gl_balance = $this->report_model->FetchGlBalance($date_from="", $date_to="", $account_head="", $account_type="", $credit_account, $time_frame="",$range_from="",$range_to="");
        
            $data['current_balance'] = $gl_balance['balance'];

            $data['emp_row'] = "";

            $data['total_amount'] = 0;

            $insert_emp_data = [];

            foreach($employees as $emp)
            {


                $expiry_date = date('Y-m-d',strtotime($emp->emp_qatar_id_expiry));


                // Convert dates to DateTime objects
                $expiryDateObj = new \DateTime($expiry_date);
                $currentDateObj = new \DateTime($date);

                // Calculate the difference in days
                $daysDifference = $expiryDateObj->diff($currentDateObj)->days;

                // Determine whether the expiry date is in the past or future
                if ($expiryDateObj < $currentDateObj) {
                    // If expiry date is in the past, consider the days difference as negative
                    $daysDifference = -$daysDifference;
                }

                // Calculate Entitlement
                $entitlement = 365 - $daysDifference;
                if ($entitlement < 0) {
                    $entitlement = 0;
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


                $data['total_amount']+=number_format((float)$amount,2,'.','');



                /*

                $data['total_amount']+=number_format((float)$amount,2,'.','');

                $insert_emp_data['vpe_vacation_due_from'][$emp->emp_id] = $vacation_pay_due_date;

                $insert_emp_data['vpe_basic_salary'][$emp->emp_id] = $emp->emp_basic_salary ?? "";

                $insert_emp_data['vpe_days_per_year'][$emp->emp_id] = $days_per_year;

                $insert_emp_data['vpe_entitlement'][$emp->emp_id] = $entitlement;

                $insert_emp_data['vpe_amount'][$emp->emp_id] = $amount;

                $insert_emp_data['vpe_emp_id'][$emp->emp_id] = $emp->emp_id;

                */

            }

            $jv_sl=0;

            $data['total_amount'] = number_format((float)$data['total_amount'],2,'.','');


            //Insert Vacation Travel

            $insert_rp['rpr_date'] =  $date;

            $insert_rp['rpr_credit_account'] =  $debit_account;

            $insert_rp['rpr_debit_account'] = $credit_account;

            $insert_rp['rpr_current_balance'] = 0;
        
            $insert_rp['rpr_total'] = $data['total_amount'];
        

        //Insert Journal voucher


        $juid = $this->common_model->FetchNextId('accounts_journal_vouchers',"JV-{$this->data['accounting_year']}-");

        $insert_journal['jv_voucher_no'] = $juid;

        $insert_journal['jv_date'] = date('Y-m-d',strtotime($formData['jv_date']));

        $insert_journal['jv_debit_total'] = $data['total_amount'];

        $insert_journal['jv_credit_total'] = $data['total_amount'];

        $insert_journal['jv_added_date'] = date('Y-m-d');

        $journal_id = $this->common_model->InsertData('accounts_journal_vouchers',$insert_journal);

        $vp_id = $this->common_model->InsertData('hr_rp_renewals',$insert_rp);


        //Insert employee details

        /*
        foreach ($insert_emp_data['vpe_emp_id'] as $emp_id => $value) {
            $vp_emp_data = [];
            
            foreach ($insert_emp_data as $column => $values) {
                $vp_emp_data[$column] = $values[$emp_id];
            }
        
            // Insert the data for this employee
            $this->common_model->InsertData('hr_vacation_pay_employees', $vp_emp_data);
        }
        */
       

        

        $this->common_model->EditData(array('rpr_jv_id' => $journal_id),array('rpr_id' => $vp_id),'hr_rp_renewals');

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

        $vacation_pay = $this->hr_model->FetchVTSingle($id);

        $vacation_travel->vt_date = date('d M Y',strtotime($vacation_travel->vt_date));

        echo json_encode($vacation_travel);
    
        }

    }



    public function Delete()
    {

    $id = $this->request->getPost('id');

    $cond = array('rpr_id' => $id);
    
    $rpr = $this->common_model->SingleRow('hr_rp_renewals',$cond);

    $this->common_model->DeleteData('hr_rp_renewals',$cond);

    //$this->common_model->DeleteData('hr_vacation_pay_employees',array('vpe_vp_id' => $id));

    $jv_cond = array('jv_id' => $rpr->rpr_jv_id);

    $this->common_model->DeleteData('accounts_journal_vouchers',$jv_cond);

    $this->common_model->DeleteData('accounts_journal_invoices',array('ji_voucher_id' => $rpr->rpr_jv_id));


    }













   


}