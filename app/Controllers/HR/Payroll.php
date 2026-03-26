<?php

namespace App\Controllers\HR;

use App\Controllers\BaseController;


class Payroll extends BaseController
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
       
        $totalRecords = $this->common_model->GetTotalRecords('hr_payrolls','pr_id','DESC');
 
        ## Total number of records with filtering
       
        $searchColumns = array('pr_id');

        $totalRecordwithFilter = $this->common_model->GetTotalRecordwithFilter('hr_payrolls','pr_id',$searchValue,$searchColumns);
    
        ##Joins if any //Pass Joins as Multi dim array
        $joins = array(

              array(
            'table' => 'accounts_journal_vouchers',
            'pk' => 'jv_id',
            'fk' => 'pr_journal_id',
            ),

        );
        ## Fetch records
        $records = $this->common_model->GetRecord('hr_payrolls','pr_id',$searchValue,$searchColumns,$columnName,$columnSortOrder,$joins,$rowperpage,$start);
    
        $data = array();

        $i=1;

        foreach($records as $record ){

        //$action = '<a  href="javascript:void(0)" class="edit edit-color view_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->pr_id.'" data-original-title="Edit"><i class="ri-eye-fill"></i> View</a> <a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->ts_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a> <a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->ts_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> Delete</a>';
           
        $action='<a  href="javascript:void(0)" class="edit edit-color view_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->pr_id.'" data-original-title="Edit"><i class="ri-eye-fill"></i> </a> 
        <a href="javascript:void(0);" data-id="'.$record->pr_id.'" class="print_color" title="Print"><i class="ri-file-pdf-2-line " aria-hidden="true"></i> </a>
        <a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->pr_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> </a>';

        $data[] = array( 
              "pr_id"=>$i,
              "pr_month" => date('M Y',strtotime("1-{$record->pr_month}-{$record->pr_year}")),
              "total_salary" => format_currency($record->pr_total_salary),
              "jv" => $record->jv_voucher_no,
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
     
             $page= !empty($_GET['page']) ? $_GET['page'] : 0;
             $term = !empty($_GET['term']) ? $_GET['term'] : "";
             $resultCount = 10;
             $end = ($page - 1) * $resultCount;       
             $start = $end + $resultCount;
           
             $data['result'] = $this->common_model->FetchAllLimit('hr_employees','emp_name','asc',$term,$start,$end);
     
             $data['total_count'] =count($data['result']);
     
             return json_encode($data);
     
         }


    //End





    //view page

    public function index()
    {   
        
        $data['divisions'] = $this->common_model->FetchAllOrder('hr_divisions','div_name','asc');

        $data['mops'] = $this->common_model->FetchAllOrder('hr_mode_of_pay','mop_title','asc');

        $data['months'] = array(
        1 => "January",
        2 => "February",
        3 => "March",
        4 => "April",
        5 => "May",
        6 => "June",
        7 => "July",
        8 => "August",
        9 => "September",
        10 => "October",
        11 => "November",
        12 => "December");

        return view('hr/payroll',$data);

    }




    public function FetchTimesheets()
    {

        $this->hr_model = new \App\Models\HRModel();

        if($_POST)
        {

        $month = $this->request->getPost('month');

        $year = $this->request->getPost('year');

        $payroll_check = $this->common_model->SingleRow('hr_payrolls',array('pr_year' => $year,'pr_month' => $month));

        if(!empty($payroll_check))
        {

        $data['msg'] = "Payroll already added!";
        $data['status']=0;

        echo json_encode($data);

        exit;

        }

        $joins = array(

            array(
                'table' => 'hr_employees',
                'pk' => 'emp_id',
                'fk' => 'ts_emp_id',
                ), 

            array(
                'table' => 'hr_divisions',
                'pk' => 'div_id',
                'fk' => 'emp_division',
                'table2' => 'hr_employees',
                ), 

        );

        $timesheets = $this->hr_model->FetchTimesheets($month,$year,$joins);

        if(!empty($timesheets))
        {
        $data['status']=1;
        }
        else
        {
        $data['msg'] = "No timesheets found!";
        $data['status']=0;
        }

        $data['table'] ="";

        $data['table'] .='
        <input type="hidden" id="payroll_month" name="month" value="'.$month.'">
         <input type="hidden" id="payroll_year" name="year" value="'.$year.'">
        ';

        //Salary And Deductions
        $basic_salary=0;
        $total_leave=0;
        $total_ot=0;

        //Allowances
        $house_rent_allow=0;
        $transport_allow=0;
        $telephone_allow=0;
        $food_allow=0;
        $other_allow=0;
        $total_salary=0;

        $staff_salary=0;
        $salaries_wages=0;

        foreach($timesheets as $ts)
        {


        $ot = $ts->ts_cur_month_normal_ot+$ts->ts_cur_month_friday_ot;

        $leave = $ts->ts_cur_month_leave+$ts->ts_cur_month_unpaid_leave+$ts->ts_current_month_vacation;


        if($ts->emp_division==2)
        {
        //staff_salary 
        $staff_salary+= $ts->ts_cur_month_basic_salary+$ts->ts_food_allowance+$ts->ts_other_allowance-$leave;
        }


        if($ts->emp_division==1)
        {
        $salaries_wages+=$ts->ts_cur_month_basic_salary+$ts->ts_food_allowance+$ts->ts_other_allowance-$leave;
        }

        $ot = $ts->ts_cur_month_normal_ot+$ts->ts_cur_month_friday_ot;

        $leave = $ts->ts_cur_month_leave+$ts->ts_cur_month_unpaid_leave+$ts->ts_current_month_vacation;

        $basic_salary+=$ts->ts_cur_month_basic_salary+$ts->ts_food_allowance+$ts->ts_other_allowance;

        $total_ot+=$ot;

        $total_leave+=$leave;

        $house_rent_allow+=$ts->ts_house_rent_allowance;

        $transport_allow+=$ts->ts_transportation_allowance;

        $telephone_allow+=$ts->ts_telephone_allowance;

        //$food_allow+=$ts->ts_food_allowance;

        //$other_allow+=$ts->ts_other_allowance;

        $total_salary+=$ts->ts_cur_month_salary;

        $data['table'] .='

            <tr class="emp_row">

                        <td class="text-center">'.$ts->emp_uid.'</td>

                        <td class="text-center">'.$ts->emp_name.'</td>

                        <td class="text-center">'.$ts->div_name.'</td>

                        <td class="text-end">'.format_currency(round($ts->ts_cur_month_basic_salary+$ts->ts_food_allowance+$ts->ts_other_allowance, 2)).'</td>

                        <td class="text-end">'.format_currency(round($leave, 2)).'</td>

                        <td class="text-end">'.format_currency(round($ot, 2)).'</td>

                        <td class="text-end">'.format_currency(round($ts->ts_house_rent_allowance, 2)).'</td>

                        <td class="text-end">'.format_currency(round($ts->ts_transportation_allowance, 2)).'</td>

                        <td class="text-end">'.format_currency(round($ts->ts_telephone_allowance, 2)).'</td>

                        <td class="text-end">'.format_currency(round($ts->ts_cur_month_salary, 2)).'</td>


                        </tr>

                        ';

        }


        $data['table'] .='
        
         <tr>

                        <th colspan="3">Total</th>

                        <th class="text-end">'.format_currency(round($basic_salary, 2)).'</th>

                        <th class="text-end">'.format_currency(round($total_leave, 2)).'</th>

                        <th class="text-end">'.format_currency(round($total_ot, 2)).'</th>

                        <th class="text-end">'.format_currency(round($house_rent_allow, 2)).'</th>

                        <th class="text-end">'.format_currency(round($transport_allow, 2)).'</th>

                        <th class="text-end">'.format_currency(round($telephone_allow, 2)).'</th>

                        <th class="text-end">'.format_currency(round($total_salary, 2)).'</th>

                        </tr>
        ';


        $data['staff_salary']= format_currency(round($staff_salary));

        $data['salaries_wages']= format_currency(round($salaries_wages));

        $data['total_ot'] = format_currency(round($total_ot));

        $data['hra'] = format_currency(round($house_rent_allow));

        $data['transport_allow'] = format_currency(round($transport_allow));

        $data['tel_allow'] = format_currency(round($telephone_allow));

        //$data['food_allow'] = format_currency(round($food_allow, 2));

        //$data['other_allow'] = format_currency(round($other_allow, 2));

        $data['total_salary'] = format_currency(round($total_salary));

        echo json_encode($data);

        }


        





    }





    public function AddToJvRows()
    {

        $this->hr_model = new \App\Models\HRModel();

        if($this->request->getPost('p_month') && $this->request->getPost('p_year'))
        {


            $month = $this->request->getPost('p_month');

            $year = $this->request->getPost('p_year');


            $joins = array(

                array(
                    'table' => 'hr_employees',
                    'pk' => 'emp_id',
                    'fk' => 'ts_emp_id',
                    ), 
    
                array(
                    'table' => 'hr_divisions',
                    'pk' => 'div_id',
                    'fk' => 'emp_division',
                    'table2' => 'hr_employees',
                    ), 
    
            );
    
            $timesheets = $this->hr_model->FetchTimesheets($month,$year,$joins);

            $emp_journal ="";



             //Salary And Deductions
             $basic_salary=0;
             $total_leave=0;
             $total_ot=0;

             //Allowances
             $house_rent_allow=0;
             $transport_allow=0;
             $telephone_allow=0;
             //$food_allow=0;
             //$other_allow=0;
             $total_salary=0;

             $staff_salary=0;
             $salaries_wages=0;



            foreach($timesheets as $ts)
            {
                

                    // foreach($timesheets as $ts)
                    // {


                    $ot = $ts->ts_cur_month_normal_ot+$ts->ts_cur_month_friday_ot;

                    $leave = $ts->ts_cur_month_leave+$ts->ts_cur_month_unpaid_leave+$ts->ts_current_month_vacation;
    
                    $basic_salary+=$ts->ts_cur_month_basic_salary-$leave;

                    $ts_basic_salary = $ts->ts_cur_month_basic_salary+$ts->ts_food_allowance+$ts->ts_other_allowance-$leave;

                    if($ts->emp_division==2)
                    {
                    //staff_salary 
                    $staff_salary+= $ts_basic_salary;
                    }

                    if($ts->emp_division==1)
                    {
                    $salaries_wages+=$ts_basic_salary;
                    }

                    $total_ot+=$ot;

                    $total_leave+=$leave;

                    $house_rent_allow+=$ts->ts_house_rent_allowance;

                    $transport_allow+=$ts->ts_transportation_allowance;

                    $telephone_allow+=$ts->ts_telephone_allowance;

                    //$food_allow+=$ts->ts_food_allowance;

                    //$other_allow+=$ts->ts_other_allowance;

                    $total_salary+=$ts->ts_cur_month_salary;

           // }




        }

            $staff_salary     = round($staff_salary);
            $salaries_wages   = round($salaries_wages);
            $total_ot         = round($total_ot);
            $house_rent_allow = round($house_rent_allow);
            $transport_allow  = round($transport_allow);
            $telephone_allow  = round($telephone_allow);


            $data['jv_rows'] = "";

            $data['total_credit'] = 0;

            $data['total_debit'] = $staff_salary+$salaries_wages+$total_ot+$house_rent_allow+$transport_allow+$telephone_allow;

            $data['total_debit'] = format_currency($data['total_debit']);

            $jv_sl=0;

            $data['jv_rows'] .='
            <input type="hidden" name="pr_year" value="'.$year.'">
            <input type="hidden" name="pr_month" value="'.$month.'">
            ';
            
            $data['jv_rows'] .='

              <tr class="jv_row">

                                        <th class="sl_no">'.++$jv_sl.'</th>

                                        <th class="select2_parent" width="35%"> 
                                            
                                        <input type="text" class="form-control" name="jv_account[]" value="Staff Salary" readonly>

                                        </th>
                                        
                                        

                                        <th width="10%"><input name="jv_debit[]" type="text" class="text-end number_format form-control debit_amount" value="'.format_currency($staff_salary).'" readonly></th>

                                        <th width="10%"><input name="jv_credit[]" type="number" class="text-end form-control credit_amount" readonly></th>

                                        <th><input name="jv_remarks[]" type="text" class="form-control" ></th>

            </tr>

            
            ';


            $data['jv_rows'] .='

            <tr class="jv_row">

                                      <th class="sl_no">'.++$jv_sl.'</th>

                                      <th class="select2_parent" width="35%"> 
                                          
                                      <input type="text" class="form-control" name="jv_account[]" value="Salaries & Wages" readonly>

                                      </th>
                                      
                                      

                                      <th width="10%"><input name="jv_debit[]" type="text" step="0.01" class="text-end number_format form-control debit_amount" value="'.format_currency($salaries_wages).'" readonly ></th>

                                      <th width="10%"><input name="jv_credit[]" type="number" class="text-end form-control credit_amount" readonly></th>

                                      <th><input name="jv_remarks[]" type="text" class="form-control" ></th>

          </tr>

          
          ';


          $data['jv_rows'] .='

            <tr class="jv_row">

                                      <th class="sl_no">'.++$jv_sl.'</th>

                                      <th class="select2_parent" width="35%"> 
                                          
                                      <input type="text" class="form-control" name="jv_account[]" value="Overtime Charges" readonly>

                                      </th>
                                      
                                     

                                      <th width="10%"><input name="jv_debit[]" type="text" step="0.01" class="text-end number_format form-control debit_amount" value="'.format_currency($total_ot).'" readonly></th>

                                      <th width="10%"><input name="jv_credit[]" type="number" class="text-end form-control credit_amount" readonly></th>

                                      <th><input name="jv_remarks[]" type="text" class="form-control" ></th>

          </tr>
          
          ';




          if(!empty($house_rent_allow))

          {

          $data['jv_rows'] .='

            <tr class="jv_row">

                                      <th class="sl_no">'.++$jv_sl.'</th>

                                      <th class="select2_parent" width="35%"> 
                                          
                                      <input type="text" class="form-control" name="jv_account[]" value="House Rent Allowance" readonly>

                                      </th>
                                      
                                      <th width="10%"><input name="jv_debit[]" type="text" step="0.01" class="text-end number_format form-control debit_amount" value="'.format_currency($house_rent_allow).'" readonly></th>

                                      <th width="10%"><input name="jv_credit[]" type="number" class="text-end form-control credit_amount" readonly></th>

                                      <th><input name="jv_remarks[]" type="text" class="form-control" ></th>

          </tr>
          
          ';

          }






          if(!empty($transport_allow))

          {

          $data['jv_rows'] .='

          <tr class="jv_row">

                                    <th class="sl_no">'.++$jv_sl.'</th>

                                    <th class="select2_parent" width="35%"> 
                                        
                                    <input type="text" class="form-control" name="jv_account[]" value="Transportation Allowance" readonly>

                                    </th>
                                    
                                    <th width="10%"><input name="jv_debit[]" type="text" step="0.01" class="text-end form-control number_format debit_amount" value="'.format_currency($transport_allow).'" readonly></th>

                                    <th width="10%"><input name="jv_credit[]" type="number" class="text-end form-control credit_amount" readonly></th>

                                    <th><input name="jv_remarks[]" type="text" class="form-control" ></th>

        </tr>
        

        ';


        }




        if(!empty($telephone_allow))


        {

        $data['jv_rows'] .='

        <tr class="jv_row">

                                  <th class="sl_no">'.++$jv_sl.'</th>

                                  <th class="select2_parent" width="35%"> 
                                      
                                  <input type="text" class="form-control" name="jv_account[]" value="Telephone Allowance" readonly>

                                  </th>
                                  
                                  <th width="10%"><input name="jv_debit[]" type="text" step="0.01" class="text-end number_format form-control debit_amount" value="'.format_currency($telephone_allow).'" readonly></th>

                                  <th width="10%"><input name="jv_credit[]" type="number" class="text-end form-control credit_amount" readonly></th>

                                  <th><input name="jv_remarks[]" type="text" class="form-control" value=""></th>

      </tr>
      
      ';

        }




        /*
    if(!empty($food_allow))

    {

      $data['jv_rows'] .='

      <tr class="jv_row">

                                <th class="sl_no">'.++$jv_sl.'</th>

                                <th class="select2_parent" width="35%"> 
                                    
                                <input type="text" class="form-control" name="jv_account[]" value="Food Allowance" readonly>

                                </th>
                                
                                <th><input name="jv_remarks[]" type="text" class="form-control" ></th>

                                <th><input name="jv_debit[]" type="number" step="0.01" class="form-control debit_amount" value="'.$food_allow.'" readonly></th>

                                <th><input name="jv_credit[]" type="number" class="form-control credit_amount" readonly></th>

    </tr>
    
    ';

    }



    if(!empty($other_allow))

    {

    $data['jv_rows'] .='

      <tr class="jv_row">

                                <th class="sl_no">'.++$jv_sl.'</th>

                                <th class="select2_parent" width="35%"> 
                                    
                                <input type="text" class="form-control" name="jv_account[]" value="Other Allowance" readonly>

                                </th>
                                
                                <th><input name="jv_remarks[]" type="text" class="form-control" ></th>

                                <th><input name="jv_debit[]" type="number" step="0.01" class="form-control debit_amount" value="'.$other_allow.'" readonly></th>

                                <th><input name="jv_credit[]" type="number" class="form-control credit_amount" readonly></th>

    </tr>
    
    ';

    }
    */


     //Employee Credit Journal
     

    foreach($timesheets as $ts)

            {

    $data['total_credit'] = $data['total_credit']+=$ts->ts_cur_month_salary;

    $emp_journal .='
            
    <tr class="jv_row">

                               <th class="sl_no">'.++$jv_sl.'</th>

                               <th class="select2_parent" width="35%"> 
                                   
                               <input type="text" class="form-control" name="jv_account[]" value="'.$ts->emp_name.'" readonly>

                               </th>
                               
                               <th width="10%"><input name="jv_debit[]" type="number" step="0.01" class="text-end form-control debit_amount" value="" readonly></th>

                               <th width="10%"><input name="jv_credit[]" type="text" class="text-end form-control number_format credit_amount" value="'.format_currency($ts->ts_cur_month_salary).'" readonly></th>

                               <th><input name="jv_remarks[]" type="text" class="form-control" value="Salary : '.date("M Y",strtotime(date("01-{$month}-{$year} "))).'"></th>

    </tr>

   ';

            }

    $data['total_credit'] = format_currency($data['total_credit']);

    $data['jv_rows'].=$emp_journal;
            


        return json_encode($data);


        }


    }


    public function AddPayrollJournal()
    {

        $this->hr_model = new \App\Models\HRModel();

        if($this->request->getPost())

        {

        $month = $this->request->getPost('pr_month');

        $year = $this->request->getPost('pr_year');


        $payroll_check = $this->common_model->SingleRow('hr_payrolls',array('pr_year' => $year,'pr_month' => $month));

        if(!empty($payroll_check))
        {

        $data['msg'] = "Payroll already added!";
        $data['status']=0;

        echo json_encode($data);

        exit;

        }


        $jv_credit_arr = $this->request->getPost('jv_credit'); // array of credit values
        $jv_debit_arr  = $this->request->getPost('jv_debit');  // array of debit values

        // Remove commas from each value and convert to float
        $jv_credit_arr = array_map(function($v){ return floatval(str_replace(",", "", $v)); }, $jv_credit_arr);
        $jv_debit_arr  = array_map(function($v){ return floatval(str_replace(",", "", $v)); }, $jv_debit_arr);

        // Sum the arrays
        $jv_total_credit = array_sum($jv_credit_arr);
        $jv_total_debit  = array_sum($jv_debit_arr);



        //$jv_total_credit = array_sum(str_replace(",","",$this->request->getPost('jv_credit')));

        //$jv_total_debit = array_sum(str_replace(",","",$this->request->getPost('jv_debit')));


        if($jv_total_credit!=$jv_total_debit)
        {
            
        $data['msg'] = "Debit and credit must be same!";
        $data['status']=0;
        echo json_encode($data);
        exit;

        }


        
        $joins = array(

            array(
                'table' => 'hr_employees',
                'pk' => 'emp_id',
                'fk' => 'ts_emp_id',
                ), 

            array(
                'table' => 'hr_divisions',
                'pk' => 'div_id',
                'fk' => 'emp_division',
                'table2' => 'hr_employees',
                ), 

        );

        //Add To Payroll Table

        $timesheets = $this->hr_model->FetchTimesheets($month,$year,$joins);

            $emp_journal ="";

           

                    //Salary And Deductions
                    /*
                    $basic_salary=0;
                    $total_leave=0;
                    $total_ot=0;

                    //Allowances
                    $house_rent_allow=0;
                    $transport_allow=0;
                    $telephone_allow=0;
                    //$food_allow=0;
                    //$other_allow=0;
                    $total_salary=0;

                    $staff_salary=0;
                    $salaries_wages=0;

                    foreach($timesheets as $ts)
                    {

                    if($ts->emp_division==2)
                    {
                    //staff_salary 
                    $staff_salary+= $ts->ts_cur_month_basic_salary+$ts->ts_food_allowance+$ts->ts_other_allowance;
                    }


                    if($ts->emp_division==1)
                    {
                    $salaries_wages+=$ts->ts_cur_month_basic_salary+$ts->ts_food_allowance+$ts->ts_other_allowance;
                    }

                    $ot = $ts->ts_cur_month_normal_ot+$ts->ts_cur_month_friday_ot;

                    $leave = $ts->ts_cur_month_leave+$ts->ts_cur_month_unpaid_leave+$ts->ts_current_month_vacation;

                    $basic_salary+=$ts->ts_cur_month_basic_salary+$ts->ts_food_allowance+$ts->ts_other_allowance-$leave;

                    $total_ot+=$ot;

                    $total_leave+=$leave;

                    $house_rent_allow+=$ts->ts_house_rent_allowance;

                    $transport_allow+=$ts->ts_transportation_allowance;

                    $telephone_allow+=$ts->ts_telephone_allowance;

                    //$food_allow+=$ts->ts_food_allowance;

                    //$other_allow+=$ts->ts_other_allowance;

                    $total_salary+=$ts->ts_cur_month_salary+$ts->ts_food_allowance+$ts->ts_other_allowance;

                    }
                    */


                    $basic_salary=0;
                    $total_leave=0;
                    $total_ot=0;

                    $house_rent_allow=0;
                    $transport_allow=0;
                    $telephone_allow=0;

                    $total_salary=0;

                    $staff_salary=0;
                    $salaries_wages=0;

                    foreach($timesheets as $ts)
                    {

                        $ot = $ts->ts_cur_month_normal_ot + $ts->ts_cur_month_friday_ot;

                        $leave = $ts->ts_cur_month_leave
                                + $ts->ts_cur_month_unpaid_leave
                                + $ts->ts_current_month_vacation;

                        $ts_basic_salary = $ts->ts_cur_month_basic_salary
                                        + $ts->ts_food_allowance
                                        + $ts->ts_other_allowance
                                        - $leave;

                        if($ts->emp_division==2)
                        {
                            $staff_salary += $ts_basic_salary;
                        }

                        if($ts->emp_division==1)
                        {
                            $salaries_wages += $ts_basic_salary;
                        }

                        $basic_salary += $ts_basic_salary;

                        $total_ot += $ot;

                        $total_leave += $leave;

                        $house_rent_allow += $ts->ts_house_rent_allowance;

                        $transport_allow += $ts->ts_transportation_allowance;

                        $telephone_allow += $ts->ts_telephone_allowance;

                        $total_salary += $ts->ts_cur_month_salary;
                    }
       

        $insert_payroll['pr_month'] = $month;
        $insert_payroll['pr_year'] = $year;
        $insert_payroll['pr_month'] = $month;
        $insert_payroll['pr_year'] = $year;
        $insert_payroll['pr_basic_salary'] = $basic_salary;
        $insert_payroll['pr_leave'] = $total_leave;
        $insert_payroll['pr_overtime'] = $total_ot;
        $insert_payroll['pr_hra'] = $house_rent_allow; // House Rent Allowance
        $insert_payroll['pr_transport_allow'] = $transport_allow; // Transportation Allowance
        $insert_payroll['pr_telephone_allow'] = $telephone_allow; // Telephone Allowance
        //$insert_payroll['pr_food_allow'] = $food_allow; // Food Allowance
        //$insert_payroll['pr_other_allow'] = $other_allow; // Other Allowance
        $insert_payroll['pr_total_salary'] = $total_salary;
        $insert_payroll['pr_added_date'] = date('Y-m-d H:i:s'); // Current date and time

        

        /// End



        //Insert Journal voucher

        //$juid = $this->common_model->FetchNextId('accounts_journal_vouchers',"JV-{$this->data['accounting_year']}-");

        $juid = $this->request->getPost('juid');

        $insert_journal['jv_voucher_no'] = $juid;

        $insert_journal['jv_date'] = date('Y-m-d',strtotime($this->request->getPost('jv_date')));

        $insert_journal['jv_debit_total'] = str_replace(",","",$this->request->getPost('total_debit'));

        $insert_journal['jv_credit_total'] = str_replace(",","",$this->request->getPost('total_credit'));

        $insert_journal['jv_added_date'] = date('Y-m-d');

        $journal_id = $this->common_model->InsertData('accounts_journal_vouchers',$insert_journal);

        $payroll_id = $this->common_model->InsertData('hr_payrolls',$insert_payroll);

        $this->common_model->EditData(array('pr_journal_id' => $journal_id),array('pr_id' => $payroll_id),'hr_payrolls');

        //Insert Journal invoices

        for($ji=0;$ji<count($this->request->getPost('jv_account'));$ji++){

        $account = $this->request->getPost('jv_account')[$ji];

        $account_data = $this->common_model->SingleRow('accounts_charts_of_accounts',array('ca_name' => $account));

        $account_id = 0;

        if(!empty($account_data))
        $account_id = $account_data->ca_id;

        $debit = !empty($this->request->getPost('jv_debit')[$ji]) ? $this->request->getPost('jv_debit')[$ji] : 0;
        $credit = !empty($this->request->getPost('jv_credit')[$ji]) ? $this->request->getPost('jv_credit')[$ji] : 0;
        $narration = $this->request->getPost('jv_remarks')[$ji];
        
        $insert_journal_invoice['ji_voucher_id'] = $journal_id;
        //$insert_journal_invoice['ji_sales_order_id'] = ''; // Populate if needed
        $insert_journal_invoice['ji_account'] = $account_id;
        $insert_journal_invoice['ji_debit'] = str_replace(",","",$debit);
        $insert_journal_invoice['ji_credit'] = str_replace(",","",$credit);
        $insert_journal_invoice['ji_narration'] = $narration;

        $this->common_model->InsertData('accounts_journal_invoices',$insert_journal_invoice);

        }

        $return['msg'] = "Added to journal";

        $return['status'] = 1;

        $return['insert_id'] = $payroll_id;
        
        $return['journal_id'] = $journal_id;

        }

        echo json_encode($return);


    }







    public function View()
    {

        if($this->request->getPost('pr_id'))
        {

        $id = $this->request->getPost('pr_id');

        //$payroll = $this->common_model->SingleRow('hr_payrolls',array('pr_id' => $id));

        //$payroll->pr_month = date("F", mktime(0, 0, 0, $payroll->pr_month, 10)); // e.g., "1" -> "January"

       //$payroll->pr_added_date = date('d M Y', strtotime($payroll->pr_added_date));


    $this->hr_model = new \App\Models\HRModel();

    $pr = $this->common_model->SingleRow('hr_payrolls',array('pr_id' => $id));
    $month = $pr->pr_month;        
    $year = $pr->pr_year;

    $joins = array(

        array(
            'table' => 'hr_employees',
            'pk' => 'emp_id',
            'fk' => 'ts_emp_id',
            ), 

        array(
            'table' => 'hr_divisions',
            'pk' => 'div_id',
            'fk' => 'emp_division',
            'table2' => 'hr_employees',
            ), 

    );

    $timesheets = $this->hr_model->FetchTimesheets($month,$year,$joins);


    $timesheet_rows = "";


    $ts_sl = 1;

    foreach($timesheets as $ts)
    {

    $timesheet_rows .= '
    
    <tr>
    

    <td align="center">'.$ts_sl.'</td>

    <td align="center">'.$ts->emp_uid.'</td>

    <td align="left">'.$ts->emp_name.'</td>

    <td align="center">'.$ts->emp_qatar_id_no.'</td>

    <td align="center">'.$ts->emp_passport_no.'</td>

    <td align="center">'.$ts->emp_designation.'</td>

    <td align="center">'.date('d-M-Y', strtotime($ts->emp_date_of_join)).'</td>

    <td align="center">'.$ts->div_name.'</td>

    <td class="text-end">'.format_currency($ts->ts_cur_month_basic_salary).'</td>




    <td class="text-end">'.$ts->ts_leave+$ts->ts_unpaid_leave+$ts->ts_vacation+$ts->ts_medical_leave.'</td>

    <td class="text-end">'.$ts->ts_medical_leave.'</td>

    <td class="text-end">'.$ts->ts_leave+$ts->ts_unpaid_leave.'</td>

    <td class="text-end">'.$ts->ts_vacation.'</td>

    <td class="text-end">'.format_currency($ts->ts_cur_month_leave+$ts->ts_cur_month_unpaid_leave+$ts->ts_current_month_vacation).'</td>



    <td class="text-end">'.$ts->ts_normal_ot.'</td>

    <td class="text-end">'.format_currency($ts->ts_cur_month_normal_ot).'</td>


     <td class="text-end">'.$ts->ts_friday_ot.'</td>

    <td class="text-end">'.format_currency($ts->ts_cur_month_friday_ot).'</td>

    <td class="text-end">'.format_currency($ts->ts_house_rent_allowance).'</td>

    <td class="text-end">'.format_currency($ts->ts_transportation_allowance).'</td>

    <td class="text-end">'.format_currency($ts->ts_telephone_allowance).'</td>

    <td class="text-end">'.format_currency($ts->ts_food_allowance).'</td>

    <td class="text-end">'.format_currency($ts->ts_other_allowance).'</td>

    <td class="text-end">'.format_currency($ts->ts_cur_month_salary).'</td>

    <td class="text-end">'.format_currency($ts->ts_cur_month_salary).'</td>


    </tr>

    ';

    $ts_sl++;

    }




    $timesheet_rows .= '
    
    <tr class="no-border-table">
    

    <td></td>

    <td></td>

    <td></td>

    <td></td>

    <td></td>

    <td></td>

    <td></td>

    <td></td>

    <td class="text-end">'.format_currency($pr->pr_basic_salary).'</td>




    <td class="text-end"></td>

    <td class="text-end"></td>

    <td class="text-end"></td>

    <td class="text-end"></td>

    <td class="text-end">'.format_currency($pr->pr_leave).'</td>



    <td class="text-end"></td>

    <td class="text-end">'.format_currency($pr->pr_overtime).'</td>


     <td class="text-end"></td>

    <td class="text-end">'.format_currency($pr->pr_overtime).'</td>

    <td class="text-end">'.format_currency($pr->pr_hra).'</td>

    <td class="text-end">'.format_currency($pr->pr_transport_allow).'</td>

    <td class="text-end">'.format_currency($pr->pr_telephone_allow).'</td>

    <td class="text-end">'.format_currency($pr->pr_food_allow).'</td>

    <td class="text-end">'.format_currency($pr->pr_other_allow).'</td>

    <td class="text-end">'.format_currency($pr->pr_total_salary).'</td>

    <td class="text-end">'.format_currency($pr->pr_total_salary).'</td>


    </tr>

    ';

        
    return $timesheet_rows;
    
    }

    }



    public function Delete()
    {

        $adminId = session('admin_id');

        $segment1 = service('uri')->getSegment(1);

        $segment2 = service('uri')->getSegment(2);

        $check_module = $this->common_model->CheckModule($adminId,$segment1,$segment2);

        if($check_module->up_delete == 0){

           $data['status'] = 0;
           
           $data['msg'] ="Access Denied: You do not have permission for this Action";

           echo json_encode($data);

           exit();
        }
    
    
    
        $id = $this->request->getPost('id');


        $cond = array('pr_id' => $id);
        
        $payroll = $this->common_model->SingleRow('hr_payrolls',$cond);


        $jv_cond = array('jv_id' => $payroll->pr_journal_id);

        //CHeck Journal
        
        $journal_check = $this->common_model->SingleRow('accounts_journal_vouchers',$jv_cond);

        if(!empty($journal_check))
        {

        $data['status'] = 0;

        $data['msg'] ="Please delete ".$journal_check->jv_voucher_no." to remove this payroll!";

        echo json_encode($data);

        exit;

        }


        $this->common_model->DeleteData('hr_payrolls',$cond);

        //$this->common_model->DeleteData('accounts_journal_vouchers',$jv_cond);

        //$this->common_model->DeleteData('accounts_journal_invoices',array('ji_voucher_id' => $payroll->pr_journal_id));

        $data['status'] = 1;

        $data['msg'] ="Data Deleted Successfully";

        echo json_encode($data);


    }



    public function AddAccess(){
        
        $data['status'] = "";

        $data['msg'] ="";

        $adminId = session('admin_id'); 

        $segment1 = service('uri')->getSegment(1);

        $segment2 = service('uri')->getSegment(2);

        $check_module = $this->common_model->CheckModule($adminId,$segment1,$segment2);

        if($check_module->up_add == 0){
           
            $data['status'] = 0 ;

            $data['msg'] ="Access Denied: You do not have permission for this Action";
 

        }
        

        echo json_encode($data); 
    }









    public function Print($id){

    
    $this->hr_model = new \App\Models\HRModel();

    $pr = $this->common_model->SingleRow('hr_payrolls',array('pr_id' => $id));
    $month = $pr->pr_month;        
    $year = $pr->pr_year;

    $joins = array(

        array(
            'table' => 'hr_employees',
            'pk' => 'emp_id',
            'fk' => 'ts_emp_id',
            ), 

        array(
            'table' => 'hr_divisions',
            'pk' => 'div_id',
            'fk' => 'emp_division',
            'table2' => 'hr_employees',
            ), 

    );

    $timesheets = $this->hr_model->FetchTimesheets($month,$year,$joins);


    $timesheet_rows = "";


    $ts_sl = 1;

    foreach($timesheets as $ts)
    {

    $timesheet_rows .= '
    
    <tr>
    

    <td align="center">'.$ts_sl.'</td>

    <td align="center">'.$ts->emp_uid.'</td>

    <td align="left">'.$ts->emp_name.'</td>

    <td align="center">'.$ts->emp_qatar_id_no.'</td>

    <td align="center">'.$ts->emp_passport_no.'</td>

    <td align="center">'.$ts->emp_designation.'</td>

    <td align="center">'.date('d-M-Y', strtotime($ts->emp_date_of_join)).'</td>

    <td align="center">'.$ts->div_name.'</td>

    <td class="text-end">'.format_currency($ts->ts_cur_month_basic_salary).'</td>




    <td class="text-end">'.$ts->ts_leave+$ts->ts_unpaid_leave+$ts->ts_vacation+$ts->ts_medical_leave.'</td>

    <td class="text-end">'.$ts->ts_medical_leave.'</td>

    <td class="text-end">'.$ts->ts_leave+$ts->ts_unpaid_leave.'</td>

    <td class="text-end">'.$ts->ts_vacation.'</td>

    <td class="text-end">'.format_currency($ts->ts_cur_month_leave+$ts->ts_cur_month_unpaid_leave+$ts->ts_current_month_vacation).'</td>



    <td class="text-end">'.$ts->ts_normal_ot.'</td>

    <td class="text-end">'.format_currency($ts->ts_cur_month_normal_ot).'</td>


     <td class="text-end">'.$ts->ts_friday_ot.'</td>

    <td class="text-end">'.format_currency($ts->ts_cur_month_friday_ot).'</td>

    <td class="text-end">'.format_currency($ts->ts_house_rent_allowance).'</td>

    <td class="text-end">'.format_currency($ts->ts_transportation_allowance).'</td>

    <td class="text-end">'.format_currency($ts->ts_telephone_allowance).'</td>

    <td class="text-end">'.format_currency($ts->ts_food_allowance).'</td>

    <td class="text-end">'.format_currency($ts->ts_other_allowance).'</td>

    <td class="text-end">'.format_currency($ts->ts_cur_month_salary).'</td>

    <td class="text-end">'.format_currency($ts->ts_cur_month_salary).'</td>


    </tr>

    ';

    $ts_sl++;

    }




    $timesheet_rows .= '
    
    <tr class="no-border-table">
    

    <td></td>

    <td></td>

    <td></td>

    <td></td>

    <td></td>

    <td></td>

    <td></td>

    <td></td>

    <td class="text-end">'.format_currency($pr->pr_basic_salary).'</td>




    <td class="text-end"></td>

    <td class="text-end"></td>

    <td class="text-end"></td>

    <td class="text-end"></td>

    <td class="text-end">'.format_currency($pr->pr_leave).'</td>



    <td class="text-end"></td>

    <td class="text-end">'.format_currency($pr->pr_overtime).'</td>


     <td class="text-end"></td>

    <td class="text-end">'.format_currency($pr->pr_overtime).'</td>

    <td class="text-end">'.format_currency($pr->pr_hra).'</td>

    <td class="text-end">'.format_currency($pr->pr_transport_allow).'</td>

    <td class="text-end">'.format_currency($pr->pr_telephone_allow).'</td>

    <td class="text-end">'.format_currency($pr->pr_food_allow).'</td>

    <td class="text-end">'.format_currency($pr->pr_other_allow).'</td>

    <td class="text-end">'.format_currency($pr->pr_total_salary).'</td>

    <td class="text-end">'.format_currency($pr->pr_total_salary).'</td>


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
        /*'fontDir' => array_merge($fontDirs, [
            __DIR__ . '/fonts'
        ]),
        'fontdata' => $fontData + [
            'bentonsans' => [
                'R' => 'FreeSerif.ttf',
                'B' => 'FreeSerifBold.ttf',
            ],
        ],
        'default_font' => 'bentonsans'*/
        
    ]);


    $html ='

    <html lang="en">
    <head>
  
    <style>
    body {
      margin: 40px;
      font-size:6px;
    }
    h2 {
      text-align: center;
    }
    .logo-text {
      font-size: 25px;
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
      margin-top: 10px;
    }

    tr
    {
    border: 1px solid #000;
    }
    
    td
    {
    border-right: 1px solid #000;
    border-left: 1px solid #000;
    }

    th, td {
      padding: 2px;
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
    background:#a8a8a8;
    }

    .head th
    {
    border-right: 1px solid #999;
    text-align:center;
    }

    .header_tr th
    {
    border-right: 1px solid #000;
    padding:3px 4px;
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

    </style>
    </head>


        <body>


        <table style="margin-top:20px;" class="no-border-table">

         <tr class="" style="padding:0px; margin:0px;">

        <td style="padding:0px; margin:0px;" width="50%" align="center" style="font-size:8px"></td>

        <td style="padding:0px; margin:0px;" width="50%" align="center" style="font-size:8px"></td>

        </tr>

        <tr class="" style="padding:0px; margin:0px;">

        <td style="padding:0px; margin:0px;" width="50%" align="center" style="font-size:8px"><b>Staff salary for '.date('M',strtotime($month)).' '.date('Y',strtotime($year)).'</b></td>

        <td style="padding:0px; margin:0px;" width="50%" align="center" style="font-size:8px"><b>Al Fuzail Engineering Services</b></td>

        </tr>

        </table>

         
        <table style="margin-top:0px">

          <tr class="header_tr">
            <th rowspan="2" style="padding:7px">Sl</th>
            <th rowspan="2" style="width:40px;">Employee ID</th>
            <th rowspan="2" style="width:120px;">Name</th>
            <th rowspan="2">QID/Visa</th>
            <th rowspan="2">Passport</th>
            <th rowspan="2">Position</th>
            <th rowspan="2">DOJ</th>
            <th rowspan="2">Department</th>
            <th rowspan="2">Basic Salary</th>

            <!-- Leave group -->
            <th colspan="5">Leave</th>

            <!-- Overtime group -->
            <th colspan="2">Overtime</th>

            <!-- Friday OT group -->
            <th colspan="2">OT Friday</th>

            <th rowspan="2">HRA</th>
            <th rowspan="2">Transp Allowance</th>
            <th rowspan="2">Tel Allowance</th>
            <th rowspan="2">Food Allowance</th>
            <th rowspan="2">Other Allowance</th>
            <th rowspan="2">Total Salary (Qr)</th>
            <th rowspan="2">Net Salary (Qr)</th>
        </tr>

        <tr class="header_tr">

            <!-- Leave subcolumns -->
            <th>Days</th>
            <th>ML</th>
            <th>NL</th>
            <th>Vac</th>
            <th>Amount</th>

            <!-- Overtime subcolumns -->
            <th>Hours</th>
            <th>Amount</th>

            <!-- Friday OT subcolumns -->
            <th>Hours</th>
            <th>Amount</th>

        </tr>

       '.$timesheet_rows.'



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