<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;


class CrmReportModel extends Model
{

    protected $db;

    public function CheckData($from_date,$from_date_col,$to_date,$to_date_col,$data1,$data1_col,$data2,$data2_col,$data3,$data3_col,$data4,$data4_col,$table,$joins,$group_by_col,$joins1,$second_col,$second_table)
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
        
        //return $result;

      

        $i = 0;
        foreach ($result as $res) {
            $cond_user = [$second_col => $res->qd_id];
            $result[$i]->quotation_product = $this->FetchWhereJoin($second_table, $cond_user,$joins1);
            $i++;
        }

        return $result;
 

    }


    public function SalesOrderCheckData($from_date,$from_date_col,$to_date,$to_date_col,$data1,$data1_col,$data2,$data2_col,$data3,$data3_col,$data4,$data4_col,$table,$joins,$group_by_col,$joins1,$second_col,$second_table)
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
        
        //return $result;
        
       
      

        $i = 0;
        foreach ($result as $res) {
            $cond_user = [$second_col => $res->so_id];
             $result[$i]->sales_product = $this->FetchWhereJoin($second_table,$cond_user,$joins1);
            
            $i++;
        }

        return $result;

    }

    /*sales order to dn/ cash invoice*/ 
    public function SalesOrderToDeliveryNote($from_date,$from_date_col,$to_date,$to_date_col,$data1,$data1_col,$data2,$data2_col,$data3,$data3_col,$data4,$data4_col,$table,$joins,$group_by_col,$joins1,$second_col,$second_table)
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

       // $query->groupBy('crm_delivery_note.dn_id');
        
        
        $result = $query->get()->getResult();
        
        //return $result;

        $joins1 = array(
            array(
                'table' => 'crm_products',
                'pk'    => 'product_id',
                'fk'    => 'spd_product_details',
            ),
        );

        $i = 0;
        foreach ($result as $res) {
            $cond_user = [$second_col => $res->so_id];

            $result[$i]->sales_products = $this->FetchWhereJoin($second_table,$cond_user,$joins1);

            $result[$i]->sales_deliverys = $this->FetchDeliver('crm_delivery_note',array('dn_sales_order_num' => $res->so_id));
            
            $result[$i]->sales_cash_invoice = $this->FetchCash('crm_cash_invoice',array('ci_sales_order' => $res->so_id));
            
            $i++;
        }

        return $result;

    }
    
    public function FetchDeliver($table,$cond)
    {
        $query = $this->db->table($table)
        ->where($cond);
        //$query->groupBy('crm_delivery_note.dn_id');
        //->get();
       
        //return $query->getResult();
        //$results = $query->getResult();

        $results = $query->get()->getResult();

        $joins2 = array(
            array(
                'table' => 'crm_products',
                'pk'    => 'product_id',
                'fk'    => 'dpd_prod_det',
            ),
        );

        $i=0;
        foreach($results as $result){
          $cond_user = ['dpd_delivery_id' => $result->dn_id];
          $results[$i]->sales_delivery_prod = $this->FetchWhereJoin('crm_delivery_product_details',$cond_user,$joins2);
          $i++;
        }
        
        return $results;
    }

    public function FetchCash($table,$cond)
    {
        $query = $this->db->table($table)
        ->where($cond)
        ->get();
       
        $results = $query->getResult();

        $joins3 = array(
            array(
                'table' => 'crm_products',
                'pk'    => 'product_id',
                'fk'    => 'cipd_prod_det',
            ),
        );

        $i=0;
        foreach($results as $result){
          $cond_user = ['cipd_cash_invoice' => $result->ci_id];
          $results[$i]->cash_product = $this->FetchWhereJoin('crm_cash_invoice_prod_det',$cond_user,$joins3);
          $i++;
        }
        
        return $results;
    }

    /**/

    
    public function DeliveryCheckData($from_date,$from_date_col,$to_date,$to_date_col,$data1,$data1_col,$data2,$data2_col,$data3,$data3_col,$data4,$data4_col,$table,$joins,$group_by_col,$joins1,$second_col,$second_table)
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
        
        //return $result;

        $i = 0;
        foreach ($result as $res) {
            $cond_user = [$second_col => $res->dn_id];
            $result[$i]->delivery_product = $this->FetchWhereJoin($second_table,$cond_user,$joins1);
            $i++;
        }

        return $result;

    }


    public function FetchWhereJoin($table,$cond,$joins)
    {
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
       
        $result = $query->get()->getResult();
        //echo $this->db->getLastQuery(); exit();

        return $result;

    }
    
    /*sales quotation analysis report*/
    
    public function sales_quot_analysis($from_date,$from_date_col,$to_date,$to_date_col,$data1,$data1_col,$data2,$data2_col,$data3,$data3_col,$data4,$data4_col,$table,$joins,$group_by_col,$joins1,$second_col,$second_table)
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
        
        //return $result;

        $i = 0;
        foreach ($result as $res) {
            $cond_user = [$second_col => $res->qd_id];
            $result[$i]->quotation_product = $this->FetchWhereJoin($second_table,$cond_user,$joins1);
            $result[$i]->sales_orders = $this->FetchSalesOrder(array('so_quotation_ref'=>$res->qd_id));
            $i++;
        }

        return $result;
    }


    

    
    public function FetchSalesOrder($cond)
    {
        $query = $this->db->table('crm_sales_orders')
        ->where($cond);
        
        $results = $query->get()->getResult();

        $joins1 = array(
            array(
                'table' => 'crm_products',
                'pk'    => 'product_id',
                'fk'    => 'spd_product_details',
            ),

        );

        $i = 0;
        foreach ($results as $res) {
            
            $cond_user1 = ['spd_sales_order' => $res->so_id];
            $results[$i]->sales_product = $this->FetchWhereJoin('crm_sales_product_details',$cond_user1,$joins1);
           
            $i++;
        }

        return $results;
 
    }

    /*###*/


    public function FetchWhere($table,$cond)
    {
        $query = $this->db->table($table)
        ->where($cond)
        ->get();
        return $query->getResult();

    }

    public function SingleRow($table,$cond)
    {
        return $this->db
        ->table($table)
        ->where($cond)
        ->get()
        ->getRow();
    }


    /*DN to credit invoice report*/

    public function dn_to_credit_invoice($from_date,$from_date_col,$to_date,$to_date_col,$data1,$data1_col,$data2,$data2_col,$data3,$data3_col,$data4,$data4_col,$table,$joins,$group_by_col)
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
        
        //return $result;

        $joins1 = array(
            array(
                'table' => 'crm_products',
                'pk'    => 'product_id',
                'fk'    => 'dpd_prod_det',
            ),
        );

        $i = 0;
        foreach ($result as $res) {
            $cond_user = ['dpd_delivery_id' => $res->dn_id];

            $result[$i]->delivery_products = $this->FetchWhereJoin('crm_delivery_product_details',$cond_user,$joins1);

            $result[$i]->credit_invoices = $this->FetchCredit('crm_credit_invoice',array('cci_delivery_id' => $res->dn_id));
            

            
            $i++;
        }

        return $result;
    }

    public function FetchCredit($table,$cond)
    {
        $query = $this->db->table($table)
        ->where($cond);
        
        $results = $query->get()->getResult();
        
        $joins2 = array(
            array(
                'table' => 'crm_products',
                'pk'    => 'product_id',
                'fk'    => 'ipd_prod_detl',
            ),
        );

        $i=0;
        foreach($results as $result){
          $cond_user = ['ipd_credit_invoice' => $result->cci_id];
          $results[$i]->invoices_product = $this->FetchWhereJoin('crm_credit_invoice_prod_det',$cond_user,$joins2);
          $i++;
        }
        
        return $results;
    }
    
    /**/


    /*Backlog section start*/
    //public function FetchBacklog($from_date,$from_date_col,$to_date,$to_date_col,$data1,$data1_col,$data2,$data2_col,$data3,$data3_col,$data4,$data4_col,$table,$joins,$group_by_col,$joins1,$second_col,$second_table)

    public function FetchBacklog($from_date,$from_date_col,$to_date,$to_date_col,$data1,$data1_col,$data2,$data2_col,$data3,$data3_col,$data4,$data4_col,$table,$joins,$group_by_col)
    {   
        $query = $this->db->table($table)
        ->select('*');
        
        if(!empty($joins))
        {
            foreach($joins as $join) 
            {
                $query->join($join['table'], $join['table'] . '.' . $join['pk'] . ' = ' . $table . '.' . $join['fk'], 'left');
            }
        }

        $query->where('crm_delivery_note.dn_invoice_flag', 0);  

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

       

        $i = 0;
        foreach ($result as $res) {
            $cond_user = ['dn_sales_order_num' => $res->so_id];

            $result[$i]->sales_delivery   = $this->FetchWhere('crm_delivery_note',array('dn_sales_order_num' => $res->so_id));
            
            $result[$i]->cash_invoiced    = $this->FetchWhere('crm_cash_invoice',array('ci_sales_order' => $res->so_id));

            $result[$i]->credit_invoiced  = $this->FetchWhere('crm_credit_invoice',array('cci_sales_order' => $res->so_id));
   
            $i++;
        }

        return $result;

    }

    /**/



    /*job profitability*/
    public function job_profitability($from_date,$from_date_col,$to_date,$to_date_col,$data1,$data1_col,$data2,$data2_col,$data3,$data3_col,$data4,$data4_col,$table,$joins,$group_by_col)
    { 
    $query = $this->db->table($table)
        ->select('*');
        
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

        $i = 0;

        foreach ($result as $res) {
            
            $result[$i]->cash_invoices   = $this->FetchWhere('crm_cash_invoice',array('ci_sales_order' => $res->so_id));
            
            $result[$i]->credit_invoiced = $this->FetchWhere('crm_credit_invoice',array('cci_sales_order' => $res->so_id));

   
            $i++;
        }

        return $result;

    }

    /**/




    /*invoice report section start*/

    public function invoice_report($from_date,$from_date_col,$to_date,$to_date_col,$data1,$data1_col,$data2,$data2_col,$data3,$data3_col,$data4,$data4_col,$table,$joins,$group_by_col)
    {
        $query = $this->db->table($table)
        ->select('*');
        
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
        
        //return $result;

        $joins1 = array(
            array(
                'table' => 'crm_products',
                'pk'    => 'product_id',
                'fk'    => 'spd_product_details',
            ),
        );

        $i = 0;

        foreach ($result as $res) {
            $cond_user = ['spd_sales_order' => $res->so_id];

            $result[$i]->sales_products   = $this->FetchWhereJoin('crm_sales_product_details',$cond_user,$joins1);
            
            $result[$i]->credit_invoice   = $this->FetchWhere('crm_credit_invoice',array('cci_sales_order' => $res->so_id));

            $result[$i]->delivery_note    = $this->FetchWhere('crm_delivery_note',array('dn_sales_order_num' => $res->so_id));

            $result[$i]->cash_invoice    = $this->FetchWhere('crm_cash_invoice',array('ci_sales_order' => $res->so_id));


            //$result[$i]->performa_invoice  = $this->FetchWhere('crm_proforma_invoices',array('pf_sales_order' => $res->dn_sales_order_num));
            

            
            $i++;
        }

        return $result;
    }

    /*####*/


    /*sales summer report*/

    public function sales_summery($from_date,$from_date_col,$to_date,$to_date_col,$data1,$data1_col,$data2,$data2_col,$data3,$data3_col,$data4,$data4_col,$table,$joins,$group_by_col)
    {
        $query = $this->db->table($table)
        ->select('*');
        
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

        $joins1 = array(
            array(
                'table' => 'crm_products',
                'pk'    => 'product_id',
                'fk'    => 'dpd_prod_det',
            ),
        );

        $i = 0;

        foreach ($result as $res) {
            $cond_user = ['dpd_delivery_id' => $res->dn_id];
 
            $result[$i]->credit_invoice    = $this->FetchWhere('crm_credit_invoice',array('cci_delivery_id' => $res->dn_id));

            $result[$i]->performa_invoice  = $this->FetchWhere('crm_proforma_invoices',array('pf_sales_order' => $res->dn_sales_order_num));
            
          
            
            $i++;
        }

        return $result;
    }


    /*#####*/

    public function CheckTwiceCond1($table,$cond1,$cond2)
    {
        $query = $this->db->table($table)
        
        ->select('*')

        ->where($cond1)

        ->where($cond2)

        ->get();

        return $query->getResult();
 
    }


   

   

}

