<?php

namespace App\Controllers\HR;

use App\Controllers\BaseController;

use NumberToWords\NumberToWords;


class TimeSheets extends BaseController
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

        $action = '<a  href="javascript:void(0)" class="edit edit-color view_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->ts_id.'" data-original-title="Edit"><i class="ri-eye-fill"></i> View</a> <!--<a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->ts_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a>--> <a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->ts_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> Delete</a>';
           
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

        return view('hr/timesheets',$data);

    }




    public function FetchDays()
    {


        if($_POST)
        {

        $daytypes = $this->common_model->FetchAllOrder('hr_daytypes','dt_name','asc');

        $employee = $this->request->getPost('employee');

        $month = $this->request->getPost('month');

        $year = $this->request->getPost('year');

        $timesheet_cond = array(

            'ts_emp_id' => $employee,

            'ts_year' => $year,

            'ts_month' => $month
            
        );

        $ts_check = $this->common_model->SingleRow('hr_timesheets',$timesheet_cond);

        if(!empty($ts_check))
        {
        $data['status']=0;
        $data['msg'] ="Timesheet already added";
        echo json_encode($data);
        exit;
        }
        else
        {
        $data['status']=1;
        }

        $data['emp_det'] = $this->common_model->SingleRowJoin('hr_employees',$cond=array('emp_id' => $employee),$joins=array());

        $data['day_salary'] = $data['emp_det']->emp_total_salary/30;

        $data['hour_salary'] = number_format($data['day_salary']/8,2,'.'," ");

        $list=array();

        $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        for($d=1; $d<=$days; $d++)
        {
        $time=mktime(12, 0, 0, $month, $d, $year);          
        if (date('m', $time)==$month)       
        $item=array();
        $item['date']=date('d-F-Y', $time);
        $item['day']=date('D', $time);
        $list[]=$item;
        }

        $data['table'] ="";

        $data['table1'] ="";

        $daytype_select ="";

        $data['table'] .='
        <input type="hidden" name="month" value="'.$month.'">
         <input type="hidden" name="year" value="'.$year.'">
          <input type="hidden" name="employee" value="'.$employee.'">
        ';

        

        foreach($list as $date)
        {

        $daytype_select ="";

            foreach($daytypes as $dt)
            {

            $select ="";
            if( ($dt->dt_id=="1") && ($date["day"] != "Fri"))
            {
            $select="selected";
            }
            else if(( $dt->dt_id=="6") && ($date["day"] == "Fri"))
            {

            $select="selected";

            }
            

            $daytype_select .= '<option '.$select.' value="'.$dt->dt_id.'">'.$dt->dt_name.'</option>';

            }


        // Test Mode
        /*
        $data['table1'] .='

            <tr class="day_row">

                        <td>'.$date["date"].'</td>

                        <td>'.$date["day"].'</td>

                        <td>

                        <input type="hidden" name="date[]" value="'.$date["date"].'">

                        <input type="hidden" name="day[]" value="'.$date["day"].'">

                        <select class="day_type form-control" name="day_type[]" required>
                        
                        <option value="">Select Day Type</option>

                        '.$daytype_select.'

                        </select>
                        
                        </td>

                        <td><input class="form-control time_from" name="time_from[]" value="09:00" onclick="this.showPicker();" type="time" required></td>

                        <td><input class="form-control time_to" name="time_to[]" value="17:00" onclick="this.showPicker();" type="time" required></td>

                        <td><input class="form-control total_hours" name="total_hours[]" value="8" type="text" required></td>

                        <td><input class="form-control normal_hours" type="number" value="8" name="normal_hours[]"></td>

                        <td><input class="form-control normal_ot" type="number" name="normal_ot[]" ></td>

                        <td><input class="form-control friday_ot" type="number" name="friday_ot[]" ></td>

                        </tr>

                        '; */


                        $data['table'] .='

                        <tr class="day_row '.$date["date"].'">

                        <td width="15%">'.$date["date"].'</td>

                        <td width="10%">'.$date["day"].'</td>

                        <td width="15%">

                        <input type="hidden" name="date[]" value="'.$date["date"].'">

                        <input type="hidden" name="day[]" value="'.$date["day"].'">

                        <select class="day_type form-control" name="day_type[]" required>
                        
                        <option value="">Select Day Type</option>

                        '.$daytype_select.'

                        </select>
                        
                        </td>

                        <td width="10%"><input class="form-control time_from" name="time_from[]" value="" maxlength="5" type="text" oninput="formatTime(this)"   required ></td>

                        <td width="10%"><input class="form-control time_to" name="time_to[]" value="" type="text" maxlength="5"  oninput="formatTime(this)" required ></td>

                        <td width="10%"><input class="form-control total_hours" name="total_hours[]" value="0" type="text" required readonly></td>

                        <td width="10%"><input class="form-control normal_hours" type="number" value="0" name="normal_hours[]" readonly></td>

                        <td width="10%"><input class="form-control normal_ot" type="number" name="normal_ot[]" value="0" readonly></td>

                        <td width="10%"><input class="form-control friday_ot" type="number" name="friday_ot[]" value="0" readonly></td>

                        </tr>

                        ';


        }


        echo json_encode($data);


        }


        





    }







    // add account head
    Public function Add()
    {   

        //print_r($_POST);

        //Insert into timesheet main

        $insert_data['ts_emp_id'] = $this->request->getPost('emp_id');

        $insert_data['ts_year'] = $this->request->getPost('year');

        $insert_data['ts_month'] = $this->request->getPost('month');


        $timesheet_cond = array(

            'ts_emp_id' =>$insert_data['ts_emp_id'],

            'ts_year' => $insert_data['ts_year'],

            'ts_month' => $insert_data['ts_month']
            
        );

        $ts_check = $this->common_model->SingleRow('hr_timesheets',$timesheet_cond);

        if(!empty($ts_check))
        {

            $data['status']=0;
            $data['msg'] ="Timesheet already added";
            echo json_encode($data);
            exit;

        }

        else
        {

            $data['status']=1;

        }



        //Validation For Days

        for($d=0;$d<count($_POST['day_type']);$d++){

            $check['td_date'] = date('Y-m-d',strtotime($this->request->getPost('date')[$d]));
    
            $check['td_day'] = $this->request->getPost('day')[$d];
    
            $check['td_daytype'] = $this->request->getPost('day_type')[$d];
    
            $check['td_time_in'] = $this->request->getPost('time_from')[$d];
    
            $check['td_time_out'] = $this->request->getPost('time_to')[$d];
    
            $check['td_total_hours'] = $this->request->getPost('total_hours')[$d];
    
            $check['td_normal_hours'] = $this->request->getPost('normal_hours')[$d];
    
            $check['td_normal_ot'] = $this->request->getPost('normal_ot')[$d];
    
            $check['td_friday_ot'] = $this->request->getPost('friday_ot')[$d];


            if((empty($check['td_daytype'])))
            {
                $data['status']=0;
                $data['msg'] ="Fill all day types to continue!";
                echo json_encode($data);
                exit;
            }


            if(($check['td_daytype'] == 1) || ($check['td_daytype'] == 2) || ($check['td_daytype'] == 6))
            {

            if((empty($check['td_time_in'])) || (empty($check['td_time_out'])) || (empty($check['td_total_hours'])) )
            {

                $data['status']=0;
                $data['row'] = $this->request->getPost('date')[$d];
                $data['msg'] ="Enter data for ".date('d M Y',strtotime($check['td_date']))."!";
                echo json_encode($data);
                exit;

            }


            if((empty($check['td_normal_hours'])) )
            {
            
                $data['status']=0;
                $data['row'] = $this->request->getPost('date')[$d];
                $data['msg'] ="Enter data for ".date('d M Y',strtotime($check['td_date']))."!";
                echo json_encode($data);
                exit;

            }






            }


        }




        $insert_data['ts_working_days'] = $this->request->getPost('total_working_days'); 

        $insert_data['ts_public_holidays'] = $this->request->getPost('total_public_holidays'); 

        $insert_data['ts_leave'] = $this->request->getPost('total_leaves');

        $insert_data['ts_unpaid_leave'] = $this->request->getPost('total_unpaid_leaves');

        $insert_data['ts_medical_leave'] = $this->request->getPost('total_medical_leaves');

        $insert_data['ts_normal_ot'] = $this->request->getPost('total_normal_ot');

        $insert_data['ts_friday_ot'] = $this->request->getPost('total_friday_ot');

        $insert_data['ts_basic_salary'] = $this->request->getPost('basic_salary');

        $insert_data['ts_house_rent_allowance'] = $this->request->getPost('house_rent_allow');

        $insert_data['ts_transportation_allowance'] = $this->request->getPost('transport_allow');

        $insert_data['ts_telephone_allowance'] = $this->request->getPost('telephone_allow');

        $insert_data['ts_food_allowance'] = $this->request->getPost('food_allowance');

        $insert_data['ts_other_allowance'] = $this->request->getPost('other_allow');

        $insert_data['ts_monthly_salary'] = $this->request->getPost('total_salary');


        $insert_data['ts_cur_month_leave'] = $this->request->getPost('total_leave_salary');

        $insert_data['ts_cur_month_normal_ot'] = $this->request->getPost('total_normal_ot_salary');

        $insert_data['ts_cur_month_friday_ot'] = $this->request->getPost('total_friday_ot_salary');

        $insert_data['ts_cur_month_salary'] = $this->request->getPost('total_month_salary');


        $ts_id = $this->common_model->InsertData('hr_timesheets',$insert_data);


        //Insert Into Timesheed Data Table

        for($d=0;$d<count($_POST['day_type']);$d++){

        $insert_tsd['td_tsid_fk'] = $ts_id;
        
        $insert_tsd['td_date'] = date('Y-m-d',strtotime($this->request->getPost('date')[$d]));

        $insert_tsd['td_day'] = $this->request->getPost('day')[$d];

        $insert_tsd['td_daytype'] = $this->request->getPost('day_type')[$d];

        $insert_tsd['td_time_in'] = $this->request->getPost('time_from')[$d];

        $insert_tsd['td_time_out'] = $this->request->getPost('time_to')[$d];

        $insert_tsd['td_total_hours'] = $this->request->getPost('total_hours')[$d];

        $insert_tsd['td_normal_hours'] = $this->request->getPost('normal_hours')[$d];

        $insert_tsd['td_normal_ot'] = $this->request->getPost('normal_ot')[$d];

        $insert_tsd['td_friday_ot'] = $this->request->getPost('friday_ot')[$d];

        $this->common_model->InsertData('hr_timesheet_data',$insert_tsd);

        }


        echo json_encode($data);
        

    }

    //refresh table with ajax








    public function Edit()
    {

    $this->hr_model = new \App\Models\HRModel();

    $id = $this->request->getPost('ts_id');

    $timesheet_cond = array('ts_id' => $id);

    $data['ts'] = $this->hr_model->FetchSingleTimesheet($id);


    $data['month_table'] ="";


    $daytypes = $this->common_model->FetchAllOrder('hr_daytypes','dt_name','asc');

    $daytype_select="";

    

    foreach($data['ts']->days as $day)
    {

    foreach($daytypes as $dt)
    {
    $select="";
    if($day->td_daytype==$dt->dt_id)
    {
    $select="selected";
    }

    $daytype_select .= '<option value="'.$dt->dt_id.'" '.$select.'>'.$dt->dt_name.'</option>';
    
    }

    $data['month_table'] .='

        <tr class="day_row">

        <td>'.date('d-M-Y',strtotime($day->td_date)).'</td>

        <td>'.$day->td_day.'</td>

        <td>

        <input type="hidden" name="date[]" value="'.date('d-M-Y',strtotime($day->td_date)).'">

        <input type="hidden" name="day[]" value="'.$day->td_day.'">

        <select class="day_type form-control" name="day_type[]" required>
        
        <option value="">Select Day Type</option>

        '.$daytype_select.'

        </select>
        
        </td>

        <td><input class="form-control time_from" name="time_from[]" value="'.$day->td_time_in.'" onclick="this.showPicker();" type="time" required></td>

        <td><input class="form-control time_to" name="time_to[]" value="'.$day->td_time_out.'" onclick="this.showPicker();" type="time" required></td>

        <td><input class="form-control total_hours" name="total_hours[]" value="'.$day->td_total_hours.'" type="text" required></td>

        <td><input class="form-control normal_hours" type="number" value="'.$day->td_normal_hours.'" name="normal_hours[]"></td>

        <td><input class="form-control normal_ot" type="number" name="normal_ot[]" value="'.$day->td_normal_ot.'" ></td>

        <td><input class="form-control friday_ot" type="number" name="friday_ot[]" value="'.$day->td_friday_ot.'" ></td>

        </tr>

        ';



    }
    


    echo json_encode($data);

    }











    public function View()
    {
        $this->hr_model = new \App\Models\HRModel();

        $id = $this->request->getPost('ts_id');

        $timesheet_cond = array('ts_id' => $id);

        $data['ts'] = $this->hr_model->FetchSingleTimesheet($id);

        // Format the DateTime object to retrieve the full month name
        $data['ts']->month = date('F', mktime(0, 0, 0, $data['ts']->ts_month, 10));

        $data['ts_days'] ="";   

        $total_hours=0;

        $total_normal_hours=0;

        $total_normal_ot=0;

        $total_friday_ot=0;

        foreach($data['ts']->days as $ts)
        {
           //$date = date("d-M-Y,strtotime($ts->td_date)");

           $ti="-";
           $to="-";
           if($ts->td_daytype==1)
           {
            $ti = date('h:i a',strtotime($ts->td_time_in));
            $to  = date('h:i a',strtotime($ts->td_time_out));
           }

           $data['ts_days'] .='
           <tr>
           
           <td>'.date('d-M-Y',strtotime($ts->td_date)).'</td>

           <td>'.$ts->td_day.'</td>

           <td>'.$ts->dt_name.'</td>

           <td>'.$ti.'</td>

           <td>'.$to.'</td>

           <td>'.(empty($ts->td_total_hours) ? "-" : $ts->td_total_hours).'</td>

           <td>'.(empty($ts->td_normal_hours) ? "-" : $ts->td_normal_hours).'</td>

           <td>'.(empty($ts->td_normal_ot) ? "-" : $ts->td_normal_ot).'</td>

           <td>'.(empty($ts->td_friday_ot) ? "-" : $ts->td_friday_ot).'</td>

           </tr>
           ';

           $total_hours+=$ts->td_total_hours;

           $total_normal_hours+=$ts->td_normal_hours;

           $total_normal_ot+=$ts->td_normal_ot;

           $total_friday_ot+=$ts->td_friday_ot;

        }


        $data['ts_days'] .='
           <tr>
           
           <td></td>

           <td></td>

           <td></td>

           <td></td>

           <td></td>

           <td><b>'.$total_hours.'</b></td>

           <td><b>'.$total_normal_hours.'</b></td>

           <td><b>'.$total_normal_ot.'</b></td>

           <td><b>'.$total_friday_ot.'</b></td>

           </tr>
           ';





        echo json_encode($data);


    }




    public function Delete()
    {

        $cond = array('ts_id' => $this->request->getPost('id'));

        $ts_data_cond = array('td_tsid_fk' => $this->request->getPost('id'));
        
        $this->common_model->DeleteData('hr_timesheet_data',$ts_data_cond);

        $this->common_model->DeleteData('hr_timesheets',$cond);

    }









 



}
