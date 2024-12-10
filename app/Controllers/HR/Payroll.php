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
       
        $totalRecords = $this->common_model->GetTotalRecords('hr_timesheets','ts_id','DESC');
 
        ## Total number of records with filtering
       
        $searchColumns = array('ts_id');

        $totalRecordwithFilter = $this->common_model->GetTotalRecordwithFilter('hr_timesheets','ts_id',$searchValue,$searchColumns);
    
        ##Joins if any //Pass Joins as Multi dim array
        $joins = array(
           
            array(
            'table' => 'hr_employees',
            'pk' => 'emp_id',
            'fk' => 'ts_emp_id',
            ),


        );
        ## Fetch records
        $records = $this->common_model->GetRecord('hr_timesheets','ts_id',$searchValue,$searchColumns,$columnName,$columnSortOrder,$joins,$rowperpage,$start);
    
        $data = array();

        $i=1;

        foreach($records as $record ){

        $monthName = date('F', mktime(0, 0, 0, $record->ts_month, 10)); // March

        $action = '<a  href="javascript:void(0)" class="edit edit-color view_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->ts_id.'" data-original-title="Edit"><i class="ri-eye-fill"></i> View</a> <a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->ts_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a> <a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->ts_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> Delete</a>';
           
           $data[] = array( 
              "ts_id"=>$i,
              "employee_id" => $record->emp_uid,
              "employee_name" => $record->emp_name,
              "month" => $monthName,
              "year" => $record->ts_year,
              "working_days" => $record->ts_working_days,
              "total_salary" => $record->ts_cur_month_salary,
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

        if($ts->emp_division==2)
        {
        //staff_salary 
        $staff_salary+= $ts->ts_cur_month_basic_salary;
        }


        if($ts->emp_division==1)
        {
        $salaries_wages+=$ts->ts_cur_month_basic_salary;
        }

        $ot = $ts->ts_cur_month_normal_ot+$ts->ts_cur_month_friday_ot;

        $leave = $ts->ts_cur_month_leave+$ts->ts_cur_month_unpaid_leave+$ts->ts_current_month_vacation;

        $basic_salary+=$ts->ts_cur_month_basic_salary;

        $total_ot+=$ot;

        $total_leave+=$leave;

        $house_rent_allow+=$ts->ts_house_rent_allowance;

        $transport_allow+=$ts->ts_transportation_allowance;

        $telephone_allow+=$ts->ts_telephone_allowance;

        $food_allow+=$ts->ts_food_allowance;

        $other_allow+=$ts->ts_other_allowance;

        $total_salary+=$ts->ts_cur_month_salary;

        $data['table'] .='

            <tr class="emp_row">

                        <td>'.$ts->emp_name.'</td>

                        <td>'.$ts->div_name.'</td>

                        <td class="text-end">'.format_currency($ts->ts_cur_month_basic_salary).'</td>

                        <td class="text-end">'.format_currency($leave).'</td>

                        <td class="text-end">'.format_currency($ot).'</td>

                        <td class="text-end">'.format_currency($ts->ts_house_rent_allowance).'</td>

                        <td class="text-end">'.format_currency($ts->ts_transportation_allowance).'</td>

                        <td class="text-end">'.format_currency($ts->ts_telephone_allowance).'</td>

                        <td class="text-end">'.format_currency($ts->ts_food_allowance).'</td>

                        <td class="text-end">'.format_currency($ts->ts_other_allowance).'</td>

                        <td class="text-end">'.format_currency($ts->ts_cur_month_salary).'</td>

                        

                        </tr>

                        ';


        }


        $data['table'] .='
        
         <tr>

                        <th colspan="2">Total</th>

                        <th class="text-end">'.format_currency($basic_salary).'</th>

                        <th class="text-end">'.format_currency($total_leave).'</th>

                        <th class="text-end">'.format_currency($total_ot).'</th>

                        <th class="text-end">'.format_currency($house_rent_allow).'</th>

                        <th class="text-end">'.format_currency($transport_allow).'</th>

                        <th class="text-end">'.format_currency($telephone_allow).'</th>

                        <th class="text-end">'.format_currency($food_allow).'</th>

                        <th class="text-end">'.format_currency($other_allow).'</th>

                        <th class="text-end">'.format_currency($total_salary).'</th>

                        </tr>
        ';


        $data['staff_salary']= format_currency($staff_salary);

        $data['salaries_wages']= format_currency($salaries_wages);

        $data['total_ot'] = format_currency($total_ot);

        $data['hra'] = format_currency($house_rent_allow);

        $data['transport_allow'] = format_currency($transport_allow);

        $data['tel_allow'] = format_currency($telephone_allow);

        $data['food_allow'] = format_currency($food_allow);

        $data['other_allow'] = format_currency($other_allow);

        $data['total_salary'] = format_currency($total_salary);

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

            foreach($timesheets as $ts)
            {

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

                    if($ts->emp_division==2)
                    {
                    //staff_salary 
                    $staff_salary+= $ts->ts_cur_month_basic_salary;
                    }


                    if($ts->emp_division==1)
                    {
                    $salaries_wages+=$ts->ts_cur_month_basic_salary;
                    }

                    $ot = $ts->ts_cur_month_normal_ot+$ts->ts_cur_month_friday_ot;

                    $leave = $ts->ts_cur_month_leave+$ts->ts_cur_month_unpaid_leave+$ts->ts_current_month_vacation;

                    $basic_salary+=$ts->ts_cur_month_basic_salary;

                    $total_ot+=$ot;

                    $total_leave+=$leave;

                    $house_rent_allow+=$ts->ts_house_rent_allowance;

                    $transport_allow+=$ts->ts_transportation_allowance;

                    $telephone_allow+=$ts->ts_telephone_allowance;

                    $food_allow+=$ts->ts_food_allowance;

                    $other_allow+=$ts->ts_other_allowance;

                    $total_salary+=$ts->ts_cur_month_salary;

            }




        }


            $data['jv_rows'] = "";

            $data['total_credit'] = 0;

            $data['total_debit'] = $staff_salary+$salaries_wages+$total_ot+$house_rent_allow+$transport_allow+$telephone_allow+$food_allow+$other_allow;

            $jv_sl=0;


            
            $data['jv_rows'] .='

              <tr class="jv_row">

                                        <th class="sl_no">'.++$jv_sl.'</th>

                                        <th class="select2_parent" width="35%"> 
                                            
                                        <input type="text" class="form-control" name="jv_account" value="Staff Salary" readonly>

                                        </th>
                                        
                                        <th><input name="jv_remarks[]" type="text" class="form-control" ></th>

                                        <th><input name="jv_debit[]" type="number" step="0.01" class="form-control debit_amount" value="'.$staff_salary.'" readonly></th>

                                        <th><input name="jv_credit[]" type="number" class="form-control credit_amount" readonly></th>

            </tr>

            
            ';


            $data['jv_rows'] .='

            <tr class="jv_row">

                                      <th class="sl_no">'.++$jv_sl.'</th>

                                      <th class="select2_parent" width="35%"> 
                                          
                                      <input type="text" class="form-control" name="jv_account" value="Salaries And Wages" readonly>

                                      </th>
                                      
                                      <th><input name="jv_remarks[]" type="text" class="form-control" ></th>

                                      <th><input name="jv_debit[]" type="number" step="0.01" class="form-control debit_amount" value="'.$salaries_wages.'" readonly ></th>

                                      <th><input name="jv_credit[]" type="number" class="form-control credit_amount" readonly></th>

          </tr>

          
          ';


          $data['jv_rows'] .='

            <tr class="jv_row">

                                      <th class="sl_no">'.++$jv_sl.'</th>

                                      <th class="select2_parent" width="35%"> 
                                          
                                      <input type="text" class="form-control" name="jv_account" value="Overtime" readonly>

                                      </th>
                                      
                                      <th><input name="jv_remarks[]" type="text" class="form-control" ></th>

                                      <th><input name="jv_debit[]" type="number" step="0.01" class="form-control debit_amount" value="'.$total_ot.'" readonly></th>

                                      <th><input name="jv_credit[]" type="number" class="form-control credit_amount" readonly></th>

          </tr>
          
          ';



          $data['jv_rows'] .='

            <tr class="jv_row">

                                      <th class="sl_no">'.++$jv_sl.'</th>

                                      <th class="select2_parent" width="35%"> 
                                          
                                      <input type="text" class="form-control" name="jv_account" value="House Rent Allowance" readonly>

                                      </th>
                                      
                                      <th><input name="jv_remarks[]" type="text" class="form-control" ></th>

                                      <th><input name="jv_debit[]" type="number" step="0.01" class="form-control debit_amount" value="'.$house_rent_allow.'" readonly></th>

                                      <th><input name="jv_credit[]" type="number" class="form-control credit_amount" readonly></th>

          </tr>
          
          ';



          $data['jv_rows'] .='

          <tr class="jv_row">

                                    <th class="sl_no">'.++$jv_sl.'</th>

                                    <th class="select2_parent" width="35%"> 
                                        
                                    <input type="text" class="form-control" name="jv_account" value="Transportation Allowance" readonly>

                                    </th>
                                    
                                    <th><input name="jv_remarks[]" type="text" class="form-control" ></th>

                                    <th><input name="jv_debit[]" type="number" step="0.01" class="form-control debit_amount" value="'.$transport_allow.'" readonly></th>

                                    <th><input name="jv_credit[]" type="number" class="form-control credit_amount" readonly></th>

        </tr>
        
        ';

        $data['jv_rows'] .='

        <tr class="jv_row">

                                  <th class="sl_no">'.++$jv_sl.'</th>

                                  <th class="select2_parent" width="35%"> 
                                      
                                  <input type="text" class="form-control" name="jv_account" value="Telephone Allowance" readonly>

                                  </th>
                                  
                                  <th><input name="jv_remarks[]" type="text" class="form-control" value=""></th>

                                  <th><input name="jv_debit[]" type="number" step="0.01" class="form-control debit_amount" value="'.$telephone_allow.'" readonly></th>

                                  <th><input name="jv_credit[]" type="number" class="form-control credit_amount" readonly></th>

      </tr>
      
      ';


      $data['jv_rows'] .='

      <tr class="jv_row">

                                <th class="sl_no">'.++$jv_sl.'</th>

                                <th class="select2_parent" width="35%"> 
                                    
                                <input type="text" class="form-control" name="jv_account" value="Food Allowance" readonly>

                                </th>
                                
                                <th><input name="jv_remarks[]" type="text" class="form-control" ></th>

                                <th><input name="jv_debit[]" type="number" step="0.01" class="form-control debit_amount" value="'.$food_allow.'" readonly></th>

                                <th><input name="jv_credit[]" type="number" class="form-control credit_amount" readonly></th>

    </tr>
    
    ';



    $data['jv_rows'] .='

      <tr class="jv_row">

                                <th class="sl_no">'.++$jv_sl.'</th>

                                <th class="select2_parent" width="35%"> 
                                    
                                <input type="text" class="form-control" name="jv_account" value="Other Allowance" readonly>

                                </th>
                                
                                <th><input name="jv_remarks[]" type="text" class="form-control" ></th>

                                <th><input name="jv_debit[]" type="number" step="0.01" class="form-control debit_amount" value="'.$other_allow.'" readonly></th>

                                <th><input name="jv_credit[]" type="number" class="form-control credit_amount" readonly></th>

    </tr>
    
    ';




     //Employee Credit Journal

     

     foreach($timesheets as $ts)
            {

    $data['total_credit'] = $data['total_credit']+=$ts->ts_cur_month_salary;

     $emp_journal .='
            
    <tr class="jv_row">

                               <th class="sl_no">'.++$jv_sl.'</th>

                               <th class="select2_parent" width="35%"> 
                                   
                               <input type="text" class="form-control" name="jv_account" value="'.$ts->emp_name.'" readonly>

                               </th>
                               
                               <th><input name="jv_remarks[]" type="text" class="form-control" value="Salary : '.date("M Y",strtotime(date("01-{$month}-{$year} "))).'"></th>

                               <th><input name="jv_debit[]" type="number" step="0.01" class="form-control debit_amount" value="" readonly></th>

                               <th><input name="jv_credit[]" type="number" class="form-control credit_amount" value="'.$ts->ts_cur_month_salary.'" readonly></th>

    </tr>

   ';

            }

    $data['jv_rows'].=$emp_journal;



        return json_encode($data);


        }


    }


    public function AddPayroll()
    {


        if($this->request->getPost())

        {

            

        }






    }





   


}