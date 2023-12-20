<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class CommonModel extends Model
{

    protected $db;

   

    //Admin Authentication

    public function GetProfile($username,$password)
    {
        return $this->db
        ->table('users')
        ->where(['user_name'=>$username])
        ->where(['user_password'=>$password])
        ->get()
        ->getRow();
    }




    // add data
    public function InsertData($table, $data)
    {
        $inserted = $this->db->table($table)->insert($data);

        if (!$inserted) 
        {
            // Handle the error
            $error = $this->db->error();
            return $error; // or throw an exception, log the error, etc.
        }

        return $this->db->insertID();
    }


    
    //Edit Data 

    public function EditData($data,$cond,$table)
    {

        return $this->db
        ->table($table)
        ->where($cond)
        ->set($data)
        ->update();

    }


    //Delete Data

    public function DeleteData($table,$cond)
    {

        $this->db
        ->table($table)
        ->where($cond)
        ->delete();
    }




    //Fetch Single 

    public function SingleRow($table,$cond)
    {
        return $this->db
        ->table($table)
        ->where($cond)
        ->get()
        ->getRow();
    }


    public function SingleRowJoin($table,$cond,$joins)
    {
        $query= $this->db->table($table)
        ->where($cond);

        if(!empty($joins))
        foreach($joins as $join)
    {
        $query->join($join['table'], ''.$join['table'].'.'.$join['pk'].' = '.$table.'.'.$join['fk'].'', 'left');
    }

        $result = $query->get()->getRow();

        return $result;

    }




    //Fetch Where

    public function FetchWhere($table,$cond)
    {
        $query = $this->db->table($table)
        ->where($cond)
        ->get();
        return $query->getResult();

    }

    //Fetch where Join
    public function FetchWhereJoin($table,$cond,$join)
    {
        $query = $this->db->table($table)
        ->where($cond);

        if(!empty($joins))
        
        foreach($joins as $join)
        {
            $query->join($join['table'], ''.$join['table'].'.'.$join['pk'].' = '.$table.'.'.$join['fk'].'', 'left');
        }
       
        $result = $query->get()->getResult();

        return $result;

    }



    //Fetch All 

    public function FetchAll($table)
    {
        return $this->db
        ->table($table)
        ->get()
        ->getResult();    
    }



    //Fetch All By Order

    public function FetchAllOrder($table,$order_key,$order)
    {

        return $this->db
        ->table($table)
        ->select('*')
        ->orderBy($order_key, $order)
        ->get()
        ->getResult();
    }



    //For Select 2 Dropdown

    public function FetchAllLimit($table,$order_key,$order,$term,$end,$start)
    {
      
        return $this->db
        ->table($table)
        ->select('*')
        ->like($order_key,$term)
        ->limit($end,$start)
        ->orderBy($order_key, $order)
        ->get()
        ->getResult();
        
    }




    // create slug
    public function createSlug($name,$slug_name,$table)
    {
        helper('text'); // Load the text helper for url_title function
      
        $slug = url_title(strtolower($name), '-', true);
        
        $count = 0;
        $temp_slug = $slug;
        
        while (true) 
        {
           
            $query = $this->db
               ->table($table) 
               ->where([$slug_name =>$temp_slug])
                ->get();
                  

            if ($query->getNumRows() == 0) {
                break;
            }

            $count++;
            $temp_slug = $slug . '-' . $count;
        }
        
        return $temp_slug;
    }


    //change slug

    public function ChangeSlug($name,$id,$id_name,$slug_name,$table)
    {   
        $count = 0;
        $name = url_title($name, '-', true); // Convert spaces to dashes
        $slug_data = $name; // Create temp name
        while (true) {
            $query = $this->db->table($table)
                              ->select('*')
                              ->where($slug_name, $slug_data)
                              ->where(''.$id_name.' !=', $id) // Test temp name
                              ->get();
    
            if ($query->getNumRows() == 0) {
                break;
            }
    
            $slug_data = $name . '-' . (++$count); // Recreate new temp name
        }
        
        return $slug_data;
    }


    public function GetTotalRecords($table,$coloum)
    {  
        return $this->db
        ->table($table)
        ->select($coloum)
        ->countAllResults();
    }

    public function GetTotalRecordwithFilter($table,$coloum,$searchValue,$searchColoum)
    {
         $query = $this->db
        ->table($table)
        ->select($coloum);

        foreach($searchColoum as $col){
        $query->orLike($col, $searchValue);
        }

        return $query->countAllResults();
 
        
    }


    public function GetRecord($table,$coloum,$searchValue,$searchColoum,$columnName,$columnSortOrder="",$joins,$rowperpage,$start)
    {


        $query = $this->db->table($table)
        ->select('*');

        foreach($searchColoum as $col){
        $query->orLike($col, $searchValue);
        }

        $query->orderBy($columnName,$columnSortOrder);

        if(!empty($joins))
        {
            foreach($joins as $join)
            {
    
            $query->join($join['table'], ''.$join['table'].'.'.$join['pk'].' = '.$table.'.'.$join['fk'].'', 'left');
    
            }
        }
        $query->limit($rowperpage,$start);

        $result = $query->get()->getResult();

        return $result;
       
    }
    
    

 

  



}

