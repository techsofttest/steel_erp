<?php

namespace App\Models;

use Codeigniter\Model;
use Codeigniter\Database\ConnectionInterface;

class AccountPeriodModel extends Model
{

    protected $db;

    
    public function CheckCurrentPeriod()
    {
        return $this->db
            ->table('master_accounting_period')
            ->orderBy('ap_year','desc')
            ->get()
            ->getRow();

    }




}

