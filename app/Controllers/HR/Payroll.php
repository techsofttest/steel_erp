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
        <input type="hidden" name="month" value="'.$month.'">
         <input type="hidden" name="year" value="'.$year.'">
        ';

        $basic_salary=0;
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
        $staff_salary+= $ts->ts_basic_salary;
        }


        if($ts->emp_division==1)
        {
        $salaries_wages+=$ts->ts_basic_salary;
        }


        $basic_salary+=$ts->ts_basic_salary;

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

                        <td>'.$ts->ts_basic_salary.'</td>

                        <td>0.00</td>

                        <td>0.00</td>

                        <td>'.$ts->ts_house_rent_allowance.'</td>

                        <td>'.$ts->ts_transportation_allowance.'</td>

                        <td>'.$ts->ts_telephone_allowance.'</td>

                        <td>'.$ts->ts_food_allowance.'</td>

                        <td>'.$ts->ts_other_allowance.'</td>

                        <td>'.$ts->ts_cur_month_salary.'</td>

                        

                        </tr>

                        ';


        }


        $data['table'] .='
        
         <tr>

                        <th colspan="2">Total</th>

                        <th>'.$basic_salary.'</th>

                        <th>0.00</th>

                        <th>0.00</th>

                        <th>'.$house_rent_allow.'</th>

                        <th>'.$transport_allow.'</th>

                        <th>'.$food_allow.'</th>

                        <th>'.$other_allow.'</th>

                        <th>0.00</th>

                        </tr>
        ';


        $data['staff_salary']=$staff_salary;

        $data['salaries_wages']=$salaries_wages;

        $data['hra'] = $house_rent_allow;

        $data['transport_allow'] = $transport_allow;

        $data['tel_allow'] = $telephone_allow;

        $data['food_allow'] = $food_allow;

        $data['other_allow'] = $other_allow;

        $data['total_salary'] = $total_salary;

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


        $insert_data['ts_cur_month_normal_ot'] = $this->request->getPost('total_normal_ot_salary');

        $insert_data['ts_cur_month_friday_ot'] = $this->request->getPost('total_friday_ot_salary');

        $insert_data['ts_cur_month_salary'] = $this->request->getPost('total_month_salary');


        $ts_id = $this->common_model->InsertData('hr_timesheets',$insert_data);


        //Insert Into Timesheed Data Table

        for($d=0;$d<=count($_POST['day_type']);$d++){

        $insert_tsd['td_tsid_fk'] = $ts_id;
        
        $insert_tsd['td_date'] = date('Y-m-d');

        $insert_tsd['td_day'] = "WW";

        $insert_tsd['td_daytype'] = $this->request->getPost('day_type')[$d];

        $insert_tsd['td_time_in'] = $this->request->getPost('time_from')[$d];

        $insert_tsd['td_time_out'] = $this->request->getPost('time_to')[$d];

        $insert_tsd['td_total_hours'] = $this->request->getPost('total_hours')[$d];

        $insert_tsd['td_normal_hours'] = $this->request->getPost('normal_hours')[$d];

        $insert_tsd['td_normal_ot'] = $this->request->getPost('normal_ot')[$d];

        $insert_tsd['td_friday_ot'] = $this->request->getPost('friday_ot')[$d];

        $this->common_model->InsertData('hr_timesheet_data',$insert_tsd);

        }




        //


        /*
        if(empty($this->request->getPost('emp_id')))

        {

        //$insert_data['r_added_by'] = 1;

        //$insert_data['r_added_date'] = date('Y-m-d');

        $id = $this->common_model->InsertData('hr_employees',$insert_data);
        
        }

        else
        {

        $id = $this->request->getPost('emp_id');

        $emp_cond = array('emp_id' => $this->request->getPost('emp_id'));

        $this->common_model->EditData($insert_data,$emp_cond,'hr_employees');

        }

        */
        


        // $r_ref_no = 'REC'.str_pad($id, 7, '0', STR_PAD_LEFT);

        // $cond = array('r_id' => $id);

        // $update_data['r_ref_no'] = $r_ref_no;

        // $this->common_model->EditData($update_data,$cond,'accounts_receipts');


        echo $id;

    }

    //refresh table with ajax


    public function AddSalary()
    {

        if($_POST)
        {

            $id = $this->request->getPost('emp_id');

            $update_data['emp_basic_salary'] = $this->request->getPost('basic_salary');
            $update_data['emp_house_rent_allow'] = $this->request->getPost('house_rent_allow');
            $update_data['emp_transport_allow'] = $this->request->getPost('transport_allow');
            $update_data['emp_tel_allow'] = $this->request->getPost('telephone_allow');
            $update_data['emp_food_allow'] = $this->request->getPost('food_allowance');
            $update_data['emp_other_allow'] = $this->request->getPost('other_allow');
            $update_data['emp_total_salary'] = $this->request->getPost('total_salary');
            $update_data['emp_mode_of_payment'] = $this->request->getPost('mode_of_payment');
            $update_data['emp_account_number'] = $this->request->getPost('account_number');
            $update_data['emp_bank'] = $this->request->getPost('bank_name');
            $update_data['emp_air_ticket_per_year'] = $this->request->getPost('air_ticket_per_year');
            $update_data['emp_budgeted_ticket_amount'] = $this->request->getPost('budgeted_air_ticket');

            $emp_cond = array('emp_id' => $id);

            $this->common_model->EditData($update_data,$emp_cond,'hr_employees');

        }



    }



    public function AddDocuments()

    {

        if($_POST)
        {

            $id = $this->request->getPost('emp_id');

            $update_data['emp_passport_no'] = $this->request->getPost('passport_no');
            $update_data['emp_passport_expiry'] = date('Y-m-d',strtotime($this->request->getPost('passport_expiry')));
            $update_data['emp_visa_no'] = $this->request->getPost('visa_no');
            $update_data['emp_visa_expiry'] = date('Y-m-d',strtotime($this->request->getPost('visa_expiry')));
            $update_data['emp_qatar_id_no'] = $this->request->getPost('qatar_id');
            $update_data['emp_qatar_id_expiry'] = date('Y-m-d',strtotime($this->request->getPost('qid_expiry')));
            $update_data['emp_contract_expiry'] = date('Y-m-d',strtotime($this->request->getPost('contract_expiry')));

            $emp_cond = array('emp_id' => $id);
            
            $this->common_model->EditData($update_data,$emp_cond,'hr_employees');

        }

    }







    public function AddInvoices()
    {


        if($_POST)
        {

            $rid = $this->request->getPost('receipt_id')[0];

            $cond_receipt = array('rid_receipt_invoice' => $rid);

            $this->common_model->DeleteData('accounts_receipt_invoice_data',$cond_receipt);

            for($i=0;$i<count($this->request->getPost('inv_receipt_amount'));$i++)
            {

            // if(isset($this->request->getPost('invoice_selected')[$i]))

            // {

            if($this->request->getPost('inv_receipt_amount')[$i]>0)

            {

            $invoice_id = $this->request->getPost('credit_account_invoice')[$i];

            $receipt_amount = $this->request->getPost('inv_receipt_amount')[$i];

            $insert_data['rid_receipt_invoice'] = $this->request->getPost('receipt_id')[$i];

            $insert_data['rid_invoice'] = $invoice_id;

            $insert_data['rid_lpo_ref'] = $this->request->getPost('inv_lpo_ref')[$i];

            $insert_data['rid_receipt'] = $this->request->getPost('inv_receipt_amount')[$i];

        
            $check_invoice = $this->common_model->SingleRow('accounts_receipt_invoice_data',array('rid_receipt_invoice' => $insert_data['rid_receipt_invoice'],'rid_invoice' => $insert_data['rid_invoice']));

            if(empty($check_invoice))
            {
            $rid = $this->common_model->InsertData('accounts_receipt_invoice_data',$insert_data);
            }

            else
            {

            $update_cond = array('rid_id' => $check_invoice->rid_id);

            $rid =$this->common_model->EditData($insert_data,$update_cond,'accounts_receipt_invoice_data');

            }

            $invoice_total = $this->common_model->SingleRowCol('crm_cash_invoice','ci_total_amount',array('ci_id' => $invoice_id));

            
            if($invoice_total->ci_total_amount==$receipt_amount)
            {

            $pay_status = 2;

            }
            else if($receipt_amount>0)
            {

            $pay_status = 1;

            }
            else
            {
            
            $pay_status = 0;

            }

            $update_invoice['ci_paid_amount'] = $receipt_amount;

            $update_invoice['ci_paid_status'] = $pay_status;
            
            $this->common_model->EditData($update_invoice,array('ci_id' => $invoice_id),'crm_cash_invoice');

            }

            



            }

        }





    }




    public function UpdateInvoices()
    {



        if($_POST)
        {

            for($i=0;$i<count($this->request->getPost('inv_receipt_amount'));$i++)
            {

            // if(isset($this->request->getPost('invoice_selected')[$i]))

            // {

            if($this->request->getPost('inv_receipt_amount')[$i]>0)

            {
                
            $insert_data['rid_receipt_invoice'] = $this->request->getPost('receipt_id')[$i];

            $insert_data['rid_invoice'] = $this->request->getPost('credit_account_invoice')[$i];

            $insert_data['rid_lpo_ref'] = $this->request->getPost('inv_lpo_ref')[$i];

            $insert_data['rid_receipt'] = $this->request->getPost('inv_receipt_amount')[$i];

        
            $check_invoice = $this->common_model->SingleRow('accounts_receipt_invoice_data',array('rid_receipt_invoice' => $insert_data['rid_receipt_invoice'],'rid_invoice' => $insert_data['rid_invoice']));

            if(empty($check_invoice))
            {
            $rid = $this->common_model->InsertData('accounts_receipt_invoice_data',$insert_data);
            }

            else
            {

            $update_cond = array('rid_id' => $check_invoice->rid_id);

            $rid =$this->common_model->EditData($insert_data,$update_cond,'accounts_receipt_invoice_data');

            }



             }

            

            }

        }


        
    }








    public function FetchSalesOrders()
    {

    if($_POST)
    {


        $id = $this->request->getPost('so_id');

        $joins = array(

            array(
                'table' => 'crm_customer_creation',
                'pk' => 'cc_id',
                'fk' => 'so_customer',
                ), 

        );
    
        $data = $this->common_model->SingleRowJoin('crm_sales_orders',array('so_id' => $id),$joins);

        return json_encode($data);

    }


    }



    public function AddAdvanceSalesOrder()
    {


        if($_POST)
        {


            for($i=0;$i<=count($this->request->getPost('so_select'));$i++)
            {

                if(!empty($this->request->getPost('so_select')[$i]))
                {

                    $so_id = $this->request->getPost('so_select')[$i];

                    $so_receipt = $this->request->getPost('so_reciept')[$i];
                    
                    $update_cond['so_id'] = $so_id;

                    $update_data['so_advance_paid'] = $so_receipt;

                    $this->common_model->EditData($update_data,$update_cond,'crm_sales_orders');

                }


            }
            

        


        }


    }







 
    //account head modal 
    public function Edit()
    {
        
        $cond = array('r_id' => $this->request->getPost('r_id'));

         ##Joins if any //Pass Joins as Multi dim array
        $joins = array(
        array(
          'table' => 'accounts_charts_of_accounts',
          'pk' => 'ca_id',
          'fk' => 'r_debit_account',
        )
        );

        $data['rc'] = $this->common_model->SingleRowJoin('accounts_receipts',$cond,$joins);

        $data['rc']->r_date = date('d-F-Y',strtotime($data['rc']->r_date));

        $invoice_cond = array('ri_receipt' => $data['rc']->r_id);

        
        $invoice_joins = array(
            array(
            'table' => 'accounts_charts_of_accounts',
            'pk' => 'ca_id',
            'fk' => 'ri_credit_account',
            ),
        ); 
        

        $invoices = $this->common_model->FetchWhereJoin('accounts_receipt_invoices',$invoice_cond,$invoice_joins);

        //$customers = $this->common_model->FetchAllOrder('crm_customer_creation','cc_customer_name','asc');

        $coa = $this->common_model->FetchAllOrder('accounts_charts_of_accounts','ca_name','asc');

        $data['invoices'] = "";

        $dd='';

        foreach($coa as $cus) { 

           $dd.='<option value="'.$cus->ca_id.'">'.$cus->ca_name.'</option>';

        }


        $sl=1;

        foreach($invoices as $invoice)
        {

            $data['invoices'] .='
            <tr class="view_credit" id="view'.$invoice->ri_id.'">
            <input type="hidden" name="credit_id" value="'.$invoice->ri_id.'">

            <td>'.$sl.'</td>


            <td>

            <p class="view">'.$invoice->ca_name.'</p>

            <select style="display:none;" class="edit form-control" name="c_name">

            <option value="'.$invoice->ca_id.'" selected hidden>'.$invoice->ca_name.'</option>

            '.$dd.'
            
            </select>
           
            </td>


            <td>
            
            <p class="view">'.$invoice->ri_amount.'</p>

            <input style="display:none;" class="edit form-control" type="number" name="amount" value="'.$invoice->ri_amount.'">
            
            </td>


            <td>

             <p class="view">'.$invoice->ri_remarks.'</p>

             <input style="display:none;" class="edit form-control" type="text" name="remarks" value="'.$invoice->ri_remarks.'">
            
            </td>


            <td>
            
            <div class="view">

            <!--<a href="javascript:void(0);" class="edit_invoice btn btn-primary" data-id="'.$invoice->ri_id.'">Edit</a>-->

            <a href="javascript:void(0);" class="edit_linked btn btn-warning" data-rid="'.$invoice->ri_id.'" data-id="'.$invoice->ca_id.'">Linked</a>

            <a href="javascript:void(0);" class="del_credit btn btn-danger" data-id="'.$invoice->ri_id.'">Delete</a>

            </div>

            <div class="edit" style="display:none;">
            
            <button class="btn btn-success update_invoice_btn" data-id="'.$invoice->ri_id.'" type="button">Update</button>

            <button class="btn btn-danger cancel_invoice_btn" data-id="'.$invoice->ri_id.'" type="button">Cancel</button>

            </div>

            </td>

            </tr>

            ';

            $sl++;

        }

        echo json_encode($data);

    }



    public function DeleteCredit()
    {

        if($_POST)
        {

        $id = $this->request->getPost('id');

        $cond_receipt = array('ri_id' => $id);


        $invoice = $this->common_model->SingleRow('accounts_receipt_invoices',$cond_receipt);

        $receipt_id = $invoice->ri_receipt;


        $this->common_model->DeleteData('accounts_receipt_invoices',$cond_receipt);

        $cond_data = array('rid_receipt_invoice' => $id);

        $this->common_model->DeleteData('accounts_receipt_invoice_data',$cond_data);

        

        $all_credits = $this->common_model->FetchWhere('accounts_receipt_invoices',array('ri_receipt' => $receipt_id));

        $total = 0;

        foreach($all_credits as $credit)
        {

        $total = $total+=$credit->ri_amount;

        }
        

        $receipt_data['r_amount'] = $total;

        $receipt_cond['r_id'] = $receipt_id;

        $this->common_model->EditData($receipt_data,$receipt_cond,'accounts_receipts');

        $data['total'] = $total;

        echo json_encode($data);

        }


    }




    public function UpdateCreditDetails()
    {

        if($_POST)

        {

        $id = $this->request->getPost('c_id');

        $cond = array('ri_id' => $id);

        //$date = date('Y-m-d',strtotime($this->request->getPost('c_date')));

        $credit_account = $this->request->getPost('c_account');

        $amount = $this->request->getPost('c_amount');

        $narration = $this->request->getPost('c_narration');


        $update_data['ri_credit_account'] = $credit_account;

        $update_data['ri_amount'] = $amount;

        $update_data['ri_remarks'] = $narration;
        
        //$update_data['ri_date'] = $date;

        $this->common_model->EditData($update_data,$cond,'accounts_receipt_invoices');

        $this->FetchCreditData($id);

        }

    }




        // update account head 
        public function Update()
        {    

        $cond = array('r_id' => $this->request->getPost('r_id'));

        $update_data['r_date'] = date('Y-m-d',strtotime($this->request->getPost('r_date')));

        //$update_data['r_debit_account'] = $this->request->getPost('r_debit_account');

        $update_data['r_number'] = $this->request->getPost('r_receipt_no');

        $update_data['r_method'] = $this->request->getPost('r_method');

        if($this->request->getPost('r_method')=="1")
        {

        $update_data['r_cheque_no'] = $this->request->getPost('r_cheque_no');

        $update_data['r_cheque_date'] = date('Y-m-d',strtotime($this->request->getpost('r_cheque_date')));

        if ($_FILES['r_cheque_copy']['name'] !== '') {
            $attachment_name = $this->uploadFile('r_cheque_copy','uploads/Receipts');
            $update_data['r_cheque_copy'] = $attachment_name;
        }

        }
        else
        {

        $insert_data['r_cheque_no'] ="";

        $insert_data['r_cheque_date'] ="";

        }

        $update_data['r_collected_by'] = $this->request->getPost('r_collected_by');

        $update_data['r_bank'] = $this->request->getPost('r_bank');

        $update_data['r_credit_account'] = $this->request->getPost('r_credit_account');

        $this->common_model->EditData($update_data,$cond,'accounts_receipts');
       

    }




    public function View()
    {

    $id = $this->request->getPost('id');

    $cond = array('ts_id' => $id);

     ##Joins if any //Pass Joins as Multi dim array
     $joins = array(
           
        array(
        'table' => 'master_receipt_method',
        'pk' => 'rm_id',
        'fk' => 'r_method',
        ),

    );

    $data['receipt'] = $this->common_model->SingleRowJoin('accounts_receipts',$cond,$joins);

    $joins_inv = array(

        array(
            'table' => 'crm_customer_creation',
            'pk' => 'cc_id',
            'fk' => 'ri_credit_account',
            ),
    
    );

    $invoices = $this->common_model->FetchWhereJoin('accounts_receipt_invoices',array('ri_receipt'=>$id),$joins_inv);

    $data['invoices'] ="";

    foreach($invoices as $invoice)
    {

    $data['invoices'] .="<tr><td></td><td>{$invoice->cc_customer_name}</td><td>{$invoice->ri_remarks}</td><td>{$invoice->ri_amount}</td></tr>";
    
    }

    echo json_encode($data);

    }









    //delete account head
    public function Delete()
    {

        $ts_data_cond['td_tsid_fk'] = $this->request->getPost('id');

        $this->common_model->DeleteData('hr_timesheet_data',$ts_data_cond);


        $cond = array('ts_id' => $this->request->getPost('id'));

        $this->common_model->DeleteData('hr_timesheets',$cond);
      
    }





    public function FetchInvoices()
    {

    if($_POST)
    {

    $ac_id = $this->request->getPost('id');

    $insert_data['ri_receipt'] = $this->request->getPost('rid');

    $insert_data['ri_credit_account'] = $ac_id;

    $insert_data['ri_amount'] = $this->request->getPost('camount');

    $insert_data['ri_remarks'] = $this->request->getPost('cnarration');

    //$insert_data['ri_date'] = date('Y-m-d',strtotime($this->request->getPost('cdate')));

    $check_invoice = $this->common_model->SingleRow('accounts_receipt_invoices',array('ri_receipt' => $insert_data['ri_receipt'],'ri_credit_account' => $insert_data['ri_credit_account']));

    if(empty($check_invoice))
    {
    $rid = $this->common_model->InsertData('accounts_receipt_invoices',$insert_data);
    }

    else
    {

    $update_cond = array('ri_id' => $check_invoice->ri_id);

    $rid = $check_invoice->ri_id;

    $this->common_model->EditData($insert_data,$update_cond,'accounts_receipt_invoices');

    }

    //$rid =1;

    $joins = array(
        array(
            'table' => 'crm_customer_creation',
            'pk' => 'cc_id',
            'fk' => 'ca_customer',
            ),
    );

    //$customer = $this->common_model->SingleRowJoin('crm_customer_creation',array('cc_id' => $ac_id),$joins);

    $customer = $this->common_model->SingleRowJoin('accounts_charts_of_accounts',array('ca_id' => $ac_id),$joins);

    //$cond = array('pf_customer' => $customer->cc_id);   

    //$invoices = $this->common_model->FetchWhere('crm_proforma_invoices',$cond);

    $cond = array('ci_customer' => $customer->cc_id,'ci_paid_status' => 0);
    
    $invoices = $this->common_model->FetchWhere('crm_cash_invoice',$cond);
   
    $data['status']=0;

    $data['invoices']="";

    $data['invoices'] .='<input type="hidden" id="total_amount" value="'.$insert_data['ri_amount'].'">';

    $sl =0; 
    foreach($invoices as $inv)
    {
    $sl++;
    $remaining_amount = $inv->ci_total_amount - $inv->ci_paid_amount;
    $data['invoices'].='<tr id="'.$inv->ci_id.'">
    <input type="hidden" name="receipt_id[]" value="'.$rid.'">
    <input type="hidden" name="credit_account_invoice[]" value="'.$inv->ci_id.'">
    <th>'.$sl.'</th>
    <th>'.date('d-m-Y',strtotime($inv->ci_date)).'</th>
    <th>'.$inv->ci_reffer_no.'</th>
    <th><input class="form-control" name="inv_lpo_ref[]" type="text" value="'.$inv->ci_lpo_reff.'" required></th>
    <th>'.$remaining_amount.'
    <input type="hidden" class="invoice_total_amount" name="total_amount" value="'.$remaining_amount.'">
    </th>
    <th><input class="form-control invoice_receipt_amount" name="inv_receipt_amount[]" type="number" value="0"></th>
    <th>
    <input class="invoice_add_check" type="checkbox" name="invoice_selected[]" value="'.$inv->ci_id.'">
    </th>
    </tr>';

    $data['status']=1;

    }

    echo json_encode($data);

    }


    }



    public function EditLinked()
    {


        if($_POST)
        {

        $id = $this->request->getPost('id'); 

        $rid = $this->request->getPost('r_id');


        $joins = array(
           
        );
    
        //$customer = $this->common_model->SingleRowJoin('crm_customer_creation',array('cc_id' => $id),$joins);

        $customer = $this->common_model->SingleRowJoin('accounts_charts_of_accounts',array('ca_id' => $id),$joins);

        $cond = array('pf_customer' => $customer->ca_id);
    
        $invoices = $this->common_model->FetchWhere('crm_proforma_invoices',$cond);
       
        $data['status']=0;
    
        $data['invoices']="";
    
        $sl =0;
        foreach($invoices as $inv)
        {
        $sl++;
        $data['invoices'].='<tr id="'.$inv->pf_id.'">
        <input type="hidden" name="receipt_id[]" value="'.$rid.'">
        <input type="hidden" name="credi                                                                                                                                                                                                                                                                                                                                                                                                                                                                            t_account_invoice[]" value="'.$id.'">
        <th>'.$sl.'</th>
        <th>'.date('d-m-Y',strtotime($inv->pf_date)).'</th>
        <th>'.$inv->pf_reffer_no.'</th>
        <th><input class="form-control" name="inv_lpo_ref[]" type="text" value="'.$inv->pf_lpo_ref.'" required></th>
        <th>'.$inv->pf_total_amount.'</th>
        <th><input class="form-control" name="inv_receipt_amount[]" type="number"></th>
        <th><input type="checkbox" name="invoice_selected[]" value="'.$inv->pf_id.'"></th>
        </tr>';
    
        $data['status']=1;
    
        }
    
        echo json_encode($data);

        }




    }




    public function EditAddcredit()
    {

        if($_POST)
        {

        $insert_data['ri_receipt'] = $this->request->getPost('receipt_id');

        //$insert_data['ri_date'] = date('Y-m-d',strtotime($this->request->getPost('credit_date')));

        $insert_data['ri_credit_account'] = $this->request->getPost('credit_account');
        
        $insert_data['ri_amount'] = $this->request->getPost('credit_amount');
        
        $insert_data['ri_remarks'] = $this->request->getPost('narration');

        $rid = $this->common_model->InsertData('accounts_receipt_invoices',$insert_data);

        $this->FetchCreditData($rid,1);
            
        }


    }








    public function EditPfInvoice()
     {

        $cond = array('rid_receipt_invoice' => $this->request->getPost('id'));

        $joins = array(

            array(
            'table' => 'crm_proforma_invoices',
            'pk' => 'pf_id',
            'fk' => 'rid_invoice',
            ),
    
        );


        $invoices = $this->common_model->FetchWhereJoin('accounts_receipt_invoice_data',$cond,$joins);
       
        $data['status']=0;
    
        $data['invoices']="";
    
        $sl =0;
        foreach($invoices as $inv)
        {
        $sl++;

        $data['invoices'].=
        
        '
        <tr class="view_pf_invoice" id="edit_pf'.$inv->rid_id.'">

        <input type="hidden" name="ri_id" value="'.$inv->rid_id.'">

        <th>'.$sl.'</th>

        <th>

        <p class="">'.date('d-m-Y',strtotime($inv->pf_date)).'</p>

        </th>


        <th>

        <p class="">'.$inv->pf_reffer_no.'</p>

        </th>


        <th>

        <p class="view">'.$inv->pf_lpo_ref.'</p>

        <input style="display:none;" class="form-control edit" name="lpo_ref" type="text" value="'.$inv->pf_lpo_ref.'">
        
        </th>
        
        <th>
        
        <p class="">'.$inv->pf_total_amount.'</p>

        </th>

        <th>

        <p class="view">'.$inv->rid_receipt.'</p>

        <input style="display:none;" class="form-control edit" name="inv_receipt_amount" type="number" value="'.$inv->rid_receipt.'">
        
        </th>

        <th>

        <div class="view">

        <a href="javascript:void(0);" class="edit_pf_invoice btn btn-primary" data-id="'.$inv->rid_id.'">Edit</a>
        
        </div>

        <div class="edit" style="display:none;">
        
        <button class="btn btn-success update_pf_invoice_btn" data-id="'.$inv->rid_id.'" type="button">Update</button>

        <button class="btn btn-danger cancel_pf_invoice_btn" data-id="'.$inv->rid_id.'" type="button">Cancel</button>

        </div>
        
        </th>

        </tr>'
        
        ;
    
        $data['status']=1;
    
        }
    
        echo json_encode($data);
    

    }



    public function UpdatePfDetails()
    {

    $id = $this->request->getPost('id');

    $cond = array('rid_id' => $id);

    $update_data['rid_lpo_ref'] = $this->request->getPost('lpo_ref');

    $update_data['rid_receipt'] = $this->request->getPost('receipt_amount');

    $this->common_model->EditData($update_data,$cond,'accounts_receipt_invoice_data');

    $this->FetchPfDetails($id);

    }



    public function FetchPfdetails($id)
    {

    $cond = array('rid_id' => $id);

    $joins = array(

        array(
        'table' => 'crm_proforma_invoices',
        'pk' => 'pf_id',
        'fk' => 'rid_invoice',
        ),

    );

    $inv = $this->common_model->SingleRowJoin('accounts_receipt_invoice_data',$cond,$joins);

    $sl = 1;

    $data['inv_id'] = $id ;

    $data['invoices'] = "";

    $data['invoices'].=
        
        '
        <input type="hidden" name="ri_id" value="'.$inv->rid_id.'">

        <th>'.$sl.'</th>

        <th>

        <p class="">'.date('d-m-Y',strtotime($inv->pf_date)).'</p>

        </th>


        <th>

        <p class="">'.$inv->pf_reffer_no.'</p>

        </th>


        <th>

        <p class="view">'.$inv->rid_lpo_ref.'</p>

        <input style="display:none;" class="form-control edit" name="lpo_ref" type="text" value="'.$inv->rid_lpo_ref.'">
        
        </th>
    
        <th>
        
        <p class="">'.$inv->pf_total_amount.'</p>

        </th>

        <th>

        <p class="view">'.$inv->rid_receipt.'</p>

        <input style="display:none;" class="form-control edit" name="inv_receipt_amount" type="number" value="'.$inv->rid_receipt.'">
        
        </th>

        <th>

        <div class="view">

        <a href="javascript:void(0);" class="edit_pf_invoice btn btn-primary" data-id="'.$inv->rid_id.'">Edit</a>
        
        </div>

        <div class="edit" style="display:none;">
        
        <button class="btn btn-success update_pf_invoice_btn" data-id="'.$inv->rid_id.'" type="button">Update</button>

        <button class="btn btn-danger cancel_pf_invoice_btn" data-id="'.$inv->rid_id.'" type="button">Cancel</button>

        </div>
        
        </th>

       '
        ;


        echo json_encode($data);


    }









    public function FetchCreditData($id,$tr="")
    {

    $invoice_cond = array('ri_id' => $id); 

    $data['inv_id'] =  $id;

    $invoice_joins = array(
        array(
        'table' => 'accounts_charts_of_accounts',
        'pk' => 'ca_id',
        'fk' => 'ri_credit_account',
        ),
    );    

    $invoice = $this->common_model->SingleRowJoin('accounts_receipt_invoices',$invoice_cond,$invoice_joins);


    //Recalculate Total

    $receipt_id = $invoice->ri_receipt;


    $all_credits = $this->common_model->FetchWhere('accounts_receipt_invoices',array('ri_receipt' => $receipt_id));

    $total = 0;

    foreach($all_credits as $credit)
    {

    $total = $total+=$credit->ri_amount;

    }

    $receipt_data['r_amount'] = $total;

    $receipt_cond['r_id'] = $receipt_id;

    $this->common_model->EditData($receipt_data,$receipt_cond,'accounts_receipts');

    $data['total'] = $total;

    //



    $customers = $this->common_model->FetchAllOrder('accounts_charts_of_accounts','ca_name','asc');

    $dd='';

    foreach($customers as $cus) { 

       $dd.='<option value="'.$cus->ca_id.'">'.$cus->ca_name.'</option>';

    }


    $data['invoices'] ="";

    if($tr!="")
    {
    $data['invoices'] ='<tr class="view_credit" id="view'.$invoice->ri_id.'">';  
    }

    $data['invoices'] .='
   
    <input type="hidden" name="credit_id" value="'.$invoice->ri_id.'">

    <td>

    

    </td>

    <td>

    <p class="view">'.$invoice->ca_name.'</p>

    <select style="display:none;" class="edit form-control" name="c_name">

    <option value="'.$invoice->ca_id.'" selected hidden>'.$invoice->ca_name.'</option>

    '.$dd.'
    
    </select>
   
    </td>


    <td>
    
    <p class="view">'.$invoice->ri_amount.'</p>

    <input style="display:none;" class="edit form-control" type="number" name="amount" value="'.$invoice->ri_amount.'">
    
    </td>


    <td>

     <p class="view">'.$invoice->ri_remarks.'</p>

     <input style="display:none;" class="edit form-control" type="text" name="remarks" value="'.$invoice->ri_remarks.'">
    
    </td>


    <td>
    
    <div class="view">
    
    <!--<a href="javascript:void(0);" class="edit_invoice btn btn-primary" data-id="'.$invoice->ri_id.'">Edit</a>-->
    
    <a href="javascript:void(0);" class="edit_linked btn btn-warning" data-rid="'.$invoice->ri_id.'" data-id="'.$invoice->ca_id.'">Linked</a>
   
    <a href="javascript:void(0);" class="del_credit btn btn-danger" data-id="'.$invoice->ri_id.'">Delete</a>
   
    </div>

    <div class="edit" style="display:none;">
    
    <button class="btn btn-success update_invoice_btn" data-id="'.$invoice->ri_id.'" type="button">Update</button>

    <button class="btn btn-danger cancel_invoice_btn" data-id="'.$invoice->ri_id.'" type="button">Cancel</button>

    </div>

    </td>

    ';

    if($tr!="")
    {
    
    $data['invoices'] .='</tr>';

    }

    echo json_encode($data); 

    }







    public function EditInvoice()
    {

  
    $id = $this->request->getPost('inv_id');
  
    $joins =array(

        array(
            'table' => 'crm_customer_creation',
            'pk' => 'cc_id',
            'fk' => 'ri_credit_account',
            ),

    );

    $cond = array('ri_id' => $id);

    $data['ri'] = $this->common_model->SingleRowJoin('accounts_receipt_invoices',$cond,$joins);

    echo json_encode($data);

    }



    public function UpdateInvoice()
    {

    $id = $this->request->getPost('receipt_id');

    $cond = array('ri_id' => $id);

    //$update_data['ri_date'] = $this->request->getPost('ri_date');

    $update_data['ri_credit_account'] = $this->request->getPost('ri_credit_account');

    $update_data['ri_amount'] = $this->request->getPost('ri_amount');

    $update_data['ri_remarks'] = $this->request->getPost('ri_remarks');

    $this->common_model->EditData($update_data,$cond,'accounts_receipt_invoices');
    
    }











    public function SelectedInvoices()
    {

    if($_POST)
    {

    $data['total'] = 0;

    foreach($this->request->getPost('invoice_selected') as $inv)
    {

    $invoice = $this->common_model->SingleRowArray('crm_proforma_invoices',array('pf_id' => $inv));

    $data['html'][] = $invoice;

    $data['total'] = $invoice['pf_total_amount']+$data['total'];

    }

   
    echo json_encode($data);

    }

    }




    public function FetchReference()
    {

    $uid = $this->common_model->FetchNextId('accounts_receipts',"REC");

    echo $uid;

    }


    


    public function Print(){

    $id =13;

    $cond = array('r_id' => $id);

    ##Joins if any //Pass Joins as Multi dim array
    $joins = array(
              
           array(
           'table' => 'master_receipt_method',
           'pk' => 'rm_id',
           'fk' => 'r_method',
           ),
   
           array(
           'table' => 'master_banks',
           'pk' => 'bank_id',
           'fk' => 'r_bank',
           ),
   
           array(
           'table' => 'accounts_charts_of_accounts',
           'pk' => 'ca_id',
           'fk' => 'r_debit_account',
           ),
   
           array(
           'table' => 'master_collectors',
           'pk' => 'col_id',
           'fk' => 'r_collected_by',
           ),
   
       );
   
    $receipt = $this->common_model->SingleRowJoin('accounts_receipts',$cond,$joins);


    $total_amount = NumberToWords::transformNumber('en',$receipt->r_amount); // outputs "fifty dollars ninety nine cents"
   
       $joins_inv = array(
           array(
           'table' => 'crm_proforma_invoices',
           'pk' => 'pf_id',
           'fk' => 'ri_invoice',
           ),

           array(
            'table' => 'crm_customer_creation',
            'pk' => 'cc_id',
            'table2' => 'crm_proforma_invoices',
            'fk' => 'pf_customer',
           ),
   
       );
   
    $invoices = $this->common_model->FetchWhereJoin('accounts_receipt_invoices',array('ri_receipt'=>$id),$joins_inv);
   

    $invoice_sec = "";

    $first = true;

    
    foreach($invoices as $inv)
    {

    if($first == true)
    {
        $cus_name = $inv->cc_customer_name;
    }
    else
    {
        $cus_name="";
    }

    $invoice_sec .="
    
    <tr>

    <td>{$cus_name}</td>

    <td>{$inv->pf_reffer_no}</td>

    <td>".date('d-m-Y',strtotime($inv->pf_date))."</td>

    <td>{$inv->pf_total_amount}</td>

    <td>15-01-2024</td>

    <td>{$inv->pf_total_amount}</td>
    
    </tr>

    ";

    $first = false;

    }



    $mpdf = new \Mpdf\Mpdf([
        'format' => 'Letter',
        'default_font_size' => 9, 
        'margin_left' => 5, 
        'margin_right' => 5, 
    ]);


    
    $html ='

    <style>
    th, td {
        padding-top: 10px;
        padding-bottom: 10px;
        padding-left: 5px;
        padding-right: 5px;
      }
    </style>

    <table>
    
    <tr>
    
    <td>

    <h3>Al Fuzail Engineering Services WLL</h3>
    <p>Tel : +974 4460 4254, Fax : 4029 8994, email : engineering@alfuzailgroup.com</p>
    <p>Post Box : 201978, Gate : 248, Street : 24, Industrial Area, Doha - Qatar</p>
    
    
    </td>
    
    </tr>

    </table>



    <table width="100%" style="margin-top:10px;">
    

    <tr width="100%">
    
    <td align="right"><h3>Receipt Voucher</h3></td>

    </tr>

    </table>


    <table  width="100%" style="margin-top:2px;border-top:3px solid;border-bottom:3px solid;">

    <tr>
    
    <td width="50%">
    
    Reference : '.$receipt->r_ref_no.'
    
    </td>
    
        
    <td width="50%" align="right">
    
    Received By : '.$receipt->rm_name.'

    </td>
    
    </tr>


    <tr>
    
    <td width="50%">
    
    Date : '.date('d-m-Y',strtotime($receipt->r_date)).'
    
    </td>
    
        
    <td width="50%" align="right">
    
    Cheque : 90289

    </td>
    
    </tr>


    <tr>
    
    <td width="50%">
    
    Debit Account : '.$receipt->ca_name.'
    
    </td>
    
        
    <td width="50%" align="right">
    
    Date : 10-02-2923

    </td>
    
    </tr>


    <tr>
    
    <td width="50%">
    
    Receipt No : '.$receipt->r_number.'
    
    </td>
    
        
    <td width="50%" align="right">
    
    Bank : '.$receipt->bank_name.'

    </td>
    
    </tr>



    <tr>
    
    <td width="50%">
    
    Division No : RV-2020-0418
    
    </td>
    
        
    <td width="50%" align="right">
    
    Collected By : '.$receipt->col_name.'
    
    </td>
    
    </tr>


    
    </table>




    <table  width="100%" style="margin-top:2px;">
    

    <tr  style="border-bottom:3px solid;">
    
    <th align="left">Credit Account</th>

    <th align="left">Reference</th>

    <th align="left">Invoice Date</th>

    <th align="left">Invoice Amount</th>

    <th align="left">Due Date</th>

    <th align="left">Payment</th>

    </tr>


   '.$invoice_sec.'


    <tr style="padding-top:20px;">
    
    <td colspan="5">Reallocation</td>

    <td>9000.00</td>
    
    </tr>


    <tr style="padding-top:20px;">
    
    <td colspan="5">Discount</td>

    <td>9000.00</td>
    
    </tr>

    </table>

    ';

    $footer = '

    <table width="100%">
    
    <tr>
    
    <td colpsan="5" align="left"><b>Amount : Qatari Riyals '.$total_amount.' Only</b></td>

    <td colspan="1" align="left" style="text-align:right;"><b>'.$receipt->r_amount.'</b></td>

    </tr>

    </table>


    <table>
    
    <tr>

    <th width="25%" style="padding-right:60px;">Prepared by : (print)</th>

    <th width="25%" style="padding-right:60px;">Received by:</th>

    <th width="25%" style="padding-right:60px;">Finance Manager</th>

    <th width="25%" style="padding-right:60px;">CEO</th>

    </tr>

    </table>


    ';

    
    $mpdf->WriteHTML($html);
    $mpdf->SetFooter($footer);
    $this->response->setHeader('Content-Type', 'application/pdf');
    $mpdf->Output();

    }







    // Function to handle file upload
    public function uploadFile($fieldName, $uploadPath)
    {
        $file = $this->request->getFile($fieldName);

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move($uploadPath, $newName);
            return $newName;
        }

        return null;
    }



       //search droup drown (accountid)
       public function FetchTypes()
       {
   
           $page= !empty($_GET['page']) ? $_GET['page'] : 0;
           $term = !empty($_GET['term']) ? $_GET['term'] : "";
           $resultCount = 10;
           $end = ($page - 1) * $resultCount;       
           $start = $end + $resultCount;
         
           $data['result'] = $this->common_model->FetchAllLimit('accounts_account_heads','ah_head_id','asc',$term,$start,$end);
   
           $data['total_count'] =count($data['result']);
   
           return json_encode($data);
   
       }


       public function Code()
    {
        
        $cond2 = array('cc_account_head' => $this->request->getPost('ID'));

        $id = $this->request->getPost('ID');

        $data['account_id'] = $this->common_model->FetchNextHeadId($id);

        echo json_encode($data);

    }



}
