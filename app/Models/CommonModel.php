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



    //Fetch Where

    public function FetchWhere($table,$cond)
    {
        $query = $this->db->table($table)
        ->where($cond)
        ->get();
        return $query->getResult();

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
        return $this->db
        ->table($table)
        ->select($coloum)
        ->orLike($searchColoum, $searchValue)
        ->countAllResults();
        
    }


    public function GetRecord($table,$coloum,$searchValue,$searchColoum,$columnName,$columnSortOrder,$rowperpage,$start)
    {
        return $this->db
        ->table($table)
        ->select($coloum)
        ->orLike($searchColoum, $searchValue)
        ->orderBy($columnName,$columnSortOrder)
        ->findAll($rowperpage, $start);
       
    }
    
    

 

  



}

