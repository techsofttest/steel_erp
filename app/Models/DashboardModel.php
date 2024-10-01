<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;


class DashboardModel extends Model
{

    protected $db;



    public function MonthlyCount($table,$coloum)
    {
        $month = date('m');
        return $this->db
        ->table($table)
        ->select($coloum)
        ->where('month('.$coloum.')',$month)
        ->countAllResults();

    }




    public function ReceiptTotalToday()
    {

      $query = $this->db
       ->table('accounts_receipts')
       ->selectSum('r_amount')
       ->where('r_date',date('Y-m-d'));

       $result = $query->get()->getRow();
      
       return $result->r_amount;

    }



    public function SalesOrdersToday()
    {

        $query = $this->db
        ->table('crm_sales_orders')
        ->selectSum('so_amount_total')
        ->where('so_date',date('Y-m-d'));
        //$result = $query->countAllResults();
        //return $result;

        $result = $query->get()->getRow();
      
        return $result->so_amount_total;

    }



    public function PurchaseOrdersToday()
    {

        $query = $this->db
        ->table('pro_purchase_order')
        ->selectSum('po_amount')
        ->where('po_date',date('Y-m-d'));
        $result = $query->get()->getRow();
      
        return $result->po_amount;

    }




    public function TotalEmployees()
    {


        $query = $this->db
        ->table('crm_sales_orders')
        ->selectSum('so_amount_total')
        ->where('so_date',date('Y-m-d'));
        //$result = $query->countAllResults();
        //return $result;

        $result = $query->get()->getRow();
      
        return $result->so_amount_total;
        
    }


  
}
