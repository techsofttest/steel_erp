<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;


class ProcurementModel extends Model
{

    protected $db;

    public function FetchWhereJoinGp($table,$cond,$joins,$group_by_col){

        $query = $this->db->table($table);
        
        if(!empty($joins))

        foreach($joins as $join)
        {
            $table2 = $table;
            if(!empty($join['table2']))
            {
            $table2 = $join['table2'];
            }
            $query->join($join['table'], ''.$join['table'].'.'.$join['pk'].' = '.$table2.'.'.$join['fk'].'', 'left');
        }

        $query->where($cond);

        $query->groupBy($table. '.' . $group_by_col);
       
        $result = $query->get()->getResult();
        
        return $result;
    }

  
    public function FetchWhereNotIn($table,$cond,$id_coloum,$id)
    {
        $query = $this->db->table($table)
        
        ->select('*')

        ->whereNotIn($id_coloum,(array)$id)

        ->where($cond)

        ->get();

        //echo $this->db->getLastQuery();

        //exit();

        return $query->getResult();
    }
    
    

    public function CheckData($from_date,$from_date_col,$to_date,$to_date_col,$data1,$data1_col,$data2,$data2_col,$data3,$data3_col,$data4,$data4_col,$table,$joins,$group_by_col,$joins1)
    {   
        $query = $this->db->table($table)
        ->select('*');
        // Join additional tables if specified
        if(!empty($joins))
        {
            foreach($joins as $join) 
            {
                $query->join($join['table'], $join['table'] . '.' . $join['pk'] . ' = ' . $table . '.' . $join['fk'], 'left');
            }
        }

        if (!empty($from_date)) {
           
            $query->where($from_date_col.' >=', $from_date);
        }

        if (!empty($to_date)) {
           
            $query->where($from_date_col . ' <=', $to_date);
        }

        if (!empty($data1)) {
            $query->like($data1_col, $data1);
        }

        if (!empty($data2)) {
            $query->like($data2_col, $data2);
        }

        if (!empty($data3)) {
            $query->like($data3_col, $data3);
        }

        if (!empty($data4)) {
            $query->like($data4_col, $data4);
        }

        if(!empty($join))
        {
            $query->groupBy($table. '.' . $group_by_col);

        }
        
        
        $result = $query->get()->getResult();

        // Get the last executed query
        //echo $this->db->getLastQuery();
        
        //return $result;

      

        /*$i = 0;
        foreach ($result as $res) {
            $cond_user = [$second_col => $res->qd_id];
            $result[$i]->quotation_product = $this->FetchWhereJoin($second_table, $cond_user,$joins1);
            $i++;
        }*/

        return $result;
 

    }
  



}




