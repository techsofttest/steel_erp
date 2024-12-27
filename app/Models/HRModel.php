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



}
