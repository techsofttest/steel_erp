<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;


class CompanyModel extends Model
{

    protected $db;



     //Fetch where Join
     public function FetchCompanies()
     {
        $query = $this->db->table('master_companies');
 
        $result = $query->get()->getResult();
 
        return $result;
 
     }



   





    

  
}
