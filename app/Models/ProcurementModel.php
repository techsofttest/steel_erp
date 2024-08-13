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

}

