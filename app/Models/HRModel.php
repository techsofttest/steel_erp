<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;


class HRModel extends Model
{

    protected $db;



    public function FetchWhereLimit($table,$order_key,$order,$term,$end,$start,$cond)
    {

        $query = $this->db
        ->table($table);
        $query->select('*');

        if($cond !="")
        {

        $query->where($cond);

        }

        $query->like($order_key,$term)
        ->limit($end,$start)->orderBy($order_key, $order);
        
        $result = $query->get()->getResult();

        return $result;


    }


    public function FetchTimesheets($month,$year,$joins)
    {
        $query= $this->db->table('hr_timesheets')
        ->where('ts_year',$year)
        ->where('ts_month',$month);

        if(!empty($joins))
        foreach($joins as $join)
    {
        $table2 = 'hr_timesheets';
        if(!empty($join['table2']))
        {
        $table2 = $join['table2'];
        }
        $query->join($join['table'], ''.$join['table'].'.'.$join['pk'].' = '.$table2.'.'.$join['fk'].'', 'left');
    }

        $query->orderBy('hr_employees.emp_uid','ASC');

        $result = $query->get()->getResult();

        return $result;

    }






    public function FetchSingleTimesheet($id)
    {
        $query = $this->db->table('hr_timesheets')
        ->select('*')
        ->where('ts_id', $id)
        ->join('hr_employees','hr_employees.emp_id=hr_timesheets.ts_emp_id','left')
        ->join('hr_divisions','hr_divisions.div_id=hr_employees.emp_division','left')
        
        ->get();

        $result = $query->getRow();

        $result->days = $this->FetchTimesheetDays($id);
        
        return $result; 

    }


    public function FetchTimesheetDays($id)
    {

        $query = $this->db->table('hr_timesheet_data')
        ->select('*')
        ->where('td_tsid_fk',$id)
        ->join('hr_daytypes','hr_daytypes.dt_id=hr_timesheet_data.td_daytype','left')
        ->get();

        $result = $query->getResult();

        return $result;

    }



    public function FetchVTSingle($id)
    {
        $query = $this->db->table('hr_vacation_travel')
            ->select('hr_vacation_travel.*, debit_account.ca_name AS debit_account_name, credit_account.ca_name AS credit_account_name') // Select specific columns
            ->where('vt_id', $id)
            ->join('accounts_charts_of_accounts AS debit_account', 'debit_account.ca_id = hr_vacation_travel.vt_debit_account', 'left')
            ->join('accounts_charts_of_accounts AS credit_account', 'credit_account.ca_id = hr_vacation_travel.vt_credit_account', 'left');
        
        $result = $query->get()->getRow();

      
        $emp_query = $this->db->table('hr_vacation_travel_employees');
        $emp_query->where('vte_main_id',$id);
        $emp_query->join('hr_employees','hr_employees.emp_id = hr_vacation_travel_employees.vte_emp_id','left');
        $emp_query->orderBy('emp_uid','asc');
        $emp_result = $emp_query->get()->getResult();

        $result->employees = $emp_result;
    
        return $result;
    }



    public function FetchVPaySingle($id)
    {
    
        $query = $this->db->table('hr_vacation_pay')
            ->select('hr_vacation_pay.*, debit_account.ca_name AS debit_account_name, credit_account.ca_name AS credit_account_name') // Select specific columns
            ->where('vp_id', $id)
            ->join('accounts_charts_of_accounts AS debit_account', 'debit_account.ca_id = hr_vacation_pay.vp_debit_account', 'left')
            ->join('accounts_charts_of_accounts AS credit_account', 'credit_account.ca_id = hr_vacation_pay.vp_credit_account', 'left');
        
        $result = $query->get()->getRow();

      
        $emp_query = $this->db->table('hr_vacation_pay_employees');
        $emp_query->where('vpe_vp_id',$id);
        $emp_query->join('hr_employees','hr_employees.emp_id = hr_vacation_pay_employees.vpe_emp_id','left');
        $emp_query->orderBy('emp_uid','asc');
        $emp_result = $emp_query->get()->getResult();

        $result->employees = $emp_result;
    
        return $result;

    }




    public function FetchIDSingle($id)
    {
        $query = $this->db->table('hr_indemnity')
            ->select('hr_indemnity.*, debit_account.ca_name AS debit_account_name, credit_account.ca_name AS credit_account_name') // Select specific columns
            ->where('id_id', $id)
            ->join('accounts_charts_of_accounts AS debit_account', 'debit_account.ca_id = hr_indemnity.id_debit_account', 'left')
            ->join('accounts_charts_of_accounts AS credit_account', 'credit_account.ca_id = hr_indemnity.id_credit_account', 'left');
        
        $result = $query->get()->getRow();

        $emp_query = $this->db->table('hr_indemnity_employees');
        $emp_query->where('ide_main_id',$id);
        $emp_query->join('hr_employees','hr_employees.emp_id = hr_indemnity_employees.ide_emp_id','left');
        $emp_query->orderBy('emp_uid','asc');
        $emp_result = $emp_query->get()->getResult();

        $result->employees = $emp_result;
    
        return $result;
    }


    public function FetchRPSingle($id)
    {
        $query = $this->db->table('hr_rp_renewals')
            ->select('hr_rp_renewals.*, debit_account.ca_name AS debit_account_name, credit_account.ca_name AS credit_account_name') // Select specific columns
            ->where('rpr_id', $id)
            ->join('accounts_charts_of_accounts AS debit_account', 'debit_account.ca_id = hr_rp_renewals.rpr_debit_account', 'left')
            ->join('accounts_charts_of_accounts AS credit_account', 'credit_account.ca_id = hr_rp_renewals.rpr_credit_account', 'left');
        
        $result = $query->get()->getRow();

        $emp_query = $this->db->table('hr_rp_renewals_employees');
        $emp_query->where('rr_main_id',$id);
        $emp_query->join('hr_employees','hr_employees.emp_id = hr_rp_renewals_employees.rr_emp_id','left');
        $emp_query->orderBy('emp_uid','asc');
        $emp_result = $emp_query->get()->getResult();

        $result->employees = $emp_result;
    
        return $result;
    }




}
