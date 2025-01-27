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
        $joins = array();
        ## Fetch records
        $records = $this->common_model->GetRecord('hr_indemnity','id_id',$searchValue,$searchColumns,$columnName,$columnSortOrder,$joins,$rowperpage,$start);
    
        $data = array();

        $i=1;

        foreach($records as $record ){

        //$action = '<a  href="javascript:void(0)" class="edit edit-color view_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->pr_id.'" data-original-title="Edit"><i class="ri-eye-fill"></i> View</a> <a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->ts_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a> <a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->ts_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> Delete</a>';
           
        $action='<a  href="javascript:void(0)" class="edit edit-color view_btn" data-toggle="tooltip" data-placement="top" title="Edit"  data-id="'.$record->id_id.'" data-original-title=""><i class="ri-eye-fill"></i> </a> 
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
              "vt_debit_account" => $debit_account,
              "vt_credit_account" => $credit_account,
              "vt_total" => $record->id_total,
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

                $diff = abs(strtotime($emp->emp_date_of_join)-strtotime($date));

                $years = floor($diff / (365*60*60*24));
                $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
 
                $entitlement = $days*21/365;
 
                $year_salary = $emp->emp_basic_salary*12;
 
                $indemnity = $year_salary/365*$entitlement;
 
                $amount = $emp->emp_budgeted_ticket_amount*$emp->emp_air_ticket_per_year*$entitlement;
 
                $amount = $amount/365;
                
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



        //Insert Vacation Travel

        $insert_indemnity['id_date'] =  $date;

        $insert_indemnity['id_debit_account'] =  $debit_account;

        $insert_indemnity['id_credit_account'] = $credit_account;

        $insert_indemnity['id_current_balance'] = $data['current_balance'];
       
        $insert_indemnity['id_total'] = $data['total_amount'];
        

        //Insert Journal voucher


        $juid = $this->common_model->FetchNextId('accounts_journal_vouchers',"JV-{$this->data['accounting_year']}-");

        $insert_journal['jv_voucher_no'] = $juid;

        $insert_journal['jv_date'] = date('Y-m-d',strtotime($this->request->getPost('jv_date')));

        $insert_journal['jv_debit_total'] = $data['total_amount'];

        $insert_journal['jv_credit_total'] = $data['total_amount'];

        $insert_journal['jv_added_date'] = date('Y-m-d');

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

           $ioo=0;
           foreach($employees as $emp)
           {

               $diff = abs(strtotime($emp->emp_date_of_join)-strtotime($date));

               $years = floor($diff / (365*60*60*24));
               $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
               $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

               $entitlement = $days*21/365;

               $year_salary = $emp->emp_basic_salary*12;

               $indemnity = $year_salary/365*$entitlement;

               $amount = $emp->emp_budgeted_ticket_amount*$emp->emp_air_ticket_per_year*$entitlement;

               $amount = $amount/365;

               

               $data['emp_row'] .="
               
                   <tr>

                   <td>".++$ioo."</td>
                   
                   <td>{$emp->emp_uid}</td>

                   <td>{$emp->emp_name}</td>

                   <td>{$emp->emp_basic_salary}</td>

                   <td>".date('d M Y',strtotime($emp->emp_date_of_join))."</td>

                   <td>{$entitlement}</td>

                   <td>{$indemnity}</td>

                   <td>{$emp->emp_indemnity_advance}</td>

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

        $io=0;

        foreach($indemnity->employees as $emp)
        {

            $indemnity->id_employees .= '
            <tr>
        
            <td class="text-end">'.++$io.'</td>
    
            <td class="text-end">'.$emp->emp_uid.'</td>
    
            <td class="text-end">'.$emp->emp_name.'</td>
    
            <td class="text-end">'.$emp->ide_basic_salary.'</td>
    
            <td class="text-end">'.date('d M Y',strtotime($emp->ide_date_of_join)).'</td>
    
            <td class="text-end">'.$emp->ide_entitlement.'</td>
    
            <td class="text-end">'.$emp->ide_indemnity.'</td>
    
            <td class="text-end">'.$emp->ide_advance.'</td>
    
            <td class="text-end">'.$emp->ide_amount.'</td>
            
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













   


}