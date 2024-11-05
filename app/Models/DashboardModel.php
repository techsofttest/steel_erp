<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;


class DashboardModel extends Model
{

    protected $db;




    public function CountWhereDates($table,$cond,$date_col,$date_from,$date_to)
    {

        $query = $this->db->table($table);

        $query->where("$date_col>=",$date_from);

        $query->where("$date_col<=",$date_to);

        if($cond !="")
        {
        $query->where($cond);
        }

        return $query->get()->getNumRows();

    }



    public function SumWhereDates($table,$column,$cond,$date_col,$date_from,$date_to)
    {

        $query = $this->db->table($table);

        $query->selectSum($column);

        $query->where("$date_col>=",$date_from);

        $query->where("$date_col<=",$date_to);

        if($cond !="")
        {
        $query->where($cond);
        }

        $result = $query->get()->getRow();

        return $result->$column;

    }



    public function InvoiceTotals($date_from,$date_to)
    {

        $query = $this->db->table('crm_cash_invoice');

        $query->selectSum('ci_total_amount');

        $query->where("ci_date>=",$date_from);

        $query->where("ci_date<=",$date_to);

        $result = $query->get()->getRow();

        $cash_invoice_total = $result->ci_total_amount;


        $query = $this->db->table('crm_credit_invoice');

        $query->selectSum('cci_total_amount');

        $query->where("cci_date>=",$date_from);

        $query->where("cci_date<=",$date_to);
       
        $result = $query->get()->getRow();

        $credit_invoice_total = $result->cci_total_amount;


        $query = $this->db->table('crm_sales_return');

        $query->selectSum('sr_total');

        $query->where("sr_date>=",$date_from);

        $query->where("sr_date<=",$date_to);
       
        $result = $query->get()->getRow();

        $sr_total = $result->sr_total;


        $invoice_total = $cash_invoice_total+$credit_invoice_total-$sr_total;

        return $invoice_total;


    }

    




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




    public function FetchWhereJoinOrder($table,$cond,$joins,$order_col,$order,$limit)
    {
        $query = $this->db->table($table)
        
        ->where($cond);

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

        $query->limit($limit,0);

        $query->orderBy($order_col,$order);

        $result = $query->get()->getResult();

        return $result;
    }



    public function PFAQuotation()
    {

        $query = $this->db->table('crm_enquiry');

        //NOT EXISTS ( SELECT 1 FROM steel_crm_quotation_details q WHERE q.qd_enq_ref = e.enquiry_id

        $query->where('NOT EXISTS ( SELECT 1 FROM '.$this->db->getPrefix().'crm_quotation_details q WHERE q.qd_enq_ref = '.$this->db->getPrefix().'crm_enquiry.enquiry_id)','', FALSE);

        $query->join('crm_customer_creation','crm_customer_creation.cc_id=crm_enquiry.enquiry_customer','left');

        $query->orderBy('enquiry_id','asc');

        $result = $query->get()->getResult();

        //echo $this->db->getLastQuery(); exit();


        return $result;

    }



    public function PFADelivery()
    {

        $query = $this->db->table('crm_sales_orders');
        
        $query->where('crm_sales_orders.so_id  NOT IN (SELECT dn_sales_order_num FROM '.$this->db->getPrefix().'crm_delivery_note)');

        $query->where('crm_sales_orders.so_id  NOT IN (SELECT ci_sales_order FROM '.$this->db->getPrefix().'crm_cash_invoice)');

        //$query->select('DISTINCT '.$this->db->getPrefix().'crm_sales_orders.so_id');
        

        // First "NOT IN" condition for `dn_sales_order_num` from `crm_delivery_note`


        $query->join('crm_customer_creation','crm_customer_creation.cc_id=crm_sales_orders.so_customer','left');
    
        $query->groupBy('crm_sales_orders.so_id');

        $query->where('so_delivery_term<=',date('Y-m-d',strtotime('-1 day')));

        $query->orderBy('so_id','asc');

        $result = $query->get()->getResult();

        return $result;

    }


    public function PFADeliveryDue()
    {

        $query = $this->db->table('crm_sales_orders');

        $query->where('crm_sales_orders.so_id IN (SELECT dn_sales_order_num FROM '.$this->db->getPrefix().'crm_delivery_note)');

        $query->where('so_delivery_term<=',date('Y-m-d',strtotime('-1 day')));

        $query->where('so_deliver_flag',0);

        $query->join('crm_customer_creation','crm_customer_creation.cc_id=crm_sales_orders.so_customer','left');

        //$query->select('DISTINCT '.$this->db->getPrefix().'crm_sales_orders.so_id');
    
        $query->groupBy('crm_sales_orders.so_id');

        $query->orderBy('so_id','asc');

        $result = $query->get()->getResult();

        return $result;

    }




    

  
}
