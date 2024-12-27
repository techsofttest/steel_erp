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
            $query->where($data1_col, $data1);
        }

        if (!empty($data2)) {
            $query->where($data2_col, $data2);
        }

        if (!empty($data3)) {
            $query->where($data3_col, $data3);
        }

        if (!empty($data4)) {
            $query->where($data4_col, $data4);
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
            $query->where($data1_col, $data1);
        }

        if (!empty($data2)) {
            $query->like($data2_col, $data2);
        }

        if (!empty($data3)) {
            $query->where($data3_col, $data3);
        }

        if (!empty($data4)) {
            $query->where($data4_col, $data4);
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
            $query->where($data1_col, $data1);
        }

        if (!empty($data2)) {
            $query->like($data2_col, $data2);
        }

        if (!empty($data3)) {
            $query->where($data3_col, $data3);
        }

        if (!empty($data4)) {
            $query->where($data4_col, $data4);
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

            $result[$i]->sales_products = $this->FetchProdSales($second_table,$cond_user,$joins1);

            
            
            $i++;
        }

        return $result;

    }


    public function FetchProdSales($table,$cond,$joins){
         
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

        //$query->groupBy($table. '.' . 'spd_product_details');
    
        $result = $query->get()->getResult();
        $j=0;   
        foreach($result as $prod){

        $sales_prod_id = $prod->spd_id;
 
        $result[$j]->cashinvoice = $this->FetchTotalAmount('crm_cash_invoice_prod_det','cipd_amount',array('cipd_sales_prod' =>$sales_prod_id));
        
       
        $result[$j]->deliverynote = $this->FetchTotalAmount('crm_delivery_product_details','dpd_total_amount',array('dpd_so_id' =>$sales_prod_id));
        
        $result[$j]->totaldelivered = $result[$j]->deliverynote + $result[$j]->cashinvoice;

        $j++;

        }
        

	    return $result;

    }


    public function FetchTotalAmount($table,$column,$cond){

        $query = $this->db->table($table);

        $query->selectSum($column);

        if($cond !="")
        {
        $query->where($cond);
        }

        $result = $query->get()->getRow()->$column;

        return $result;
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
            $query->where($data1_col, $data1);
        }

        if (!empty($data2)) {
            $query->like($data2_col, $data2);
        }

        if (!empty($data3)) {
            $query->where($data3_col, $data3);
        }

        if (!empty($data4)) {
            $query->where($data4_col, $data4);
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
    
    /*public function sales_quot_analysis($from_date,$from_date_col,$to_date,$to_date_col,$data1,$data1_col,$data2,$data2_col,$data3,$data3_col,$data4,$data4_col,$table,$joins,$group_by_col,$joins1,$second_col,$second_table)
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

        $i = 0;
        foreach ($result as $res) {
            $cond_user = [$second_col => $res->qd_id];
            $result[$i]->quotation_product = $this->FetchQuotAnalysis($second_table,$cond_user);
            $result[$i]->sales_orders = $this->FetchSalesOrder(array('so_quotation_ref'=>$res->qd_id));
            $i++;
        }

        return $result;
    }
    

    public function FetchQuotAnalysis($table,$cond_user){

        $query = $this->db->table($table);

        $query->where($cond_user);

        $query->join('crm_products','crm_products.product_id=crm_quotation_product_details.qpd_product_description','left');
        
        $query->join('crm_quotation_details','crm_quotation_details.qd_id=crm_quotation_product_details.qpd_quotation_details','left');
        
        $query->join('crm_sales_orders','crm_sales_orders.so_quotation_ref =crm_quotation_details.qd_id','left');

        $query->join('crm_sales_product_details','crm_sales_product_details.spd_sales_order =crm_sales_orders.so_id','left');

        $query->groupBy(['crm_products.product_id', 'crm_sales_orders.so_reffer_no']);

        
       
        $result = $query->get()->getResult();
        //echo $this->db->getLastQuery(); exit();

        return $result;

    }*/


    public function sales_quot_analysis($from_date,$from_date_col,$to_date,$to_date_col,$data1,$data1_col,$data2,$data2_col,$data3,$data3_col)
    {
        $query = $this->db->table('crm_quotation_details')
        ->select('*');

        $query->join('crm_customer_creation','crm_customer_creation.cc_id=crm_quotation_details.qd_customer','left');

        $query->join('executives_sales_executive','executives_sales_executive.se_id=crm_quotation_details.qd_sales_executive','left');
        
        if(!empty($data3)){
            
            $query->join('crm_quotation_product_details','crm_quotation_product_details.qpd_quotation_details =crm_quotation_details.qd_id','left');
        } 
       
        if (!empty($from_date)) {
           
            $query->where($from_date_col.' >=', $from_date);
        }

        if (!empty($to_date)) {
           
            $query->where($from_date_col . ' <=', $to_date);
        }

        if (!empty($data1)) {
            $query->where($data1_col, $data1);
        }

        if (!empty($data2)) {
            $query->where($data2_col, $data2);
        }

        if (!empty($data3)) {
            $query->where($data3_col, $data3);
        }

        $result = $query->get()->getResult();
        
      

       

        $i = 0;
        foreach ($result as $res) {
            
            $result[$i]->quotation_product = $this->SalesQuotAnalysis('crm_quotation_product_details',array('qpd_quotation_details' => $res->qd_id));
           
            $i++;
        }


        
        return $result;
    }
    

    public function SalesQuotAnalysis($table,$cond){
         
        $query = $this->db->table($table)
        ->where($cond);
        
        $query->join('crm_products','crm_products.product_id=crm_quotation_product_details.qpd_product_description','left');

        $results = $query->get()->getResult();

        $j = 0;

        foreach ($results as $res) {
            
            $results[$j]->sales_orders = $this->FetchSalesOrder(array('spd_quot_prod_id'=>$res->qpd_id));
 
            $j++;
        }
        
        

        return $results;
        
    }

    
    public function FetchSalesOrder($cond)
    {
        $query = $this->db->table('crm_sales_product_details')
        ->where($cond);
        
        $query->join('crm_sales_orders','crm_sales_orders.so_id =crm_sales_product_details.spd_sales_order','left');

        $results = $query->get()->getResult();
       

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


   

   // public function dn_to_credit_invoice($from_date,$from_date_col,$to_date,$to_date_col,$data1,$data1_col,$data2,$data2_col,$data3,$data3_col,$data4,$data4_col,$table,$joins,$group_by_col)
                                        //($from_date,'dn_date',$to_date,'',$data1,'dn_customer',$data2,'dn_sales_order_num',$data3,'dn_id',$data4.'dpd_prod_det');
    public function dn_to_credit_invoice($from_date,$from_date_col,$to_date,$to_date_col,$data1,$data1_col,$data2,$data2_col,$data3,$data3_col,$data4,$data4_col)
    {
        $query = $this->db->table('crm_delivery_note')
        ->select('*');

        $query->join('crm_customer_creation','crm_customer_creation.cc_id=crm_delivery_note.dn_customer','left');

        $query->join('crm_sales_orders','crm_sales_orders.so_id =crm_delivery_note.dn_sales_order_num','left');

        if(!empty($data4)){
           
            $query->join('crm_delivery_product_details','crm_delivery_product_details.dpd_delivery_id = crm_delivery_note.dn_id','left');

        }

        
        if (!empty($from_date)) {
           
            $query->where($from_date_col.' >=', $from_date);
        }

        if (!empty($to_date)) {
           
            $query->where($from_date_col . ' <=', $to_date);
        }

        if (!empty($data1)) {
            $query->where($data1_col, $data1);
        }

        if (!empty($data2)) {
            $query->like($data2_col, $data2);
        }

        if (!empty($data3)) {
            $query->where($data3_col, $data3);
        }

        if (!empty($data4)) {
            $query->where($data4_col, $data4);
        }

       

        $result = $query->get()->getResult();
        
        //return $result;

       

        $i = 0;
        foreach ($result as $res) {

            $cond_user = ['dpd_delivery_id' => $res->dn_id];

            $result[$i]->delivery_products = $this->FetchDeliveredProd('crm_delivery_product_details',$cond_user);

            //$result[$i]->credit_invoices = $this->FetchCredit('crm_credit_invoice',array('cci_delivery_id' => $res->dn_id));
            
            $i++;
        }

        return $result;
    }

    public function FetchDeliveredProd($table,$cond){

        $query = $this->db->table($table)
        ->where($cond);
        
        $query->join('crm_products','crm_products.product_id  = crm_delivery_product_details.dpd_prod_det','left');


        $results = $query->get()->getResult();
        
        $joins = array(
            array(
                'table' => 'crm_credit_invoice',
                'pk'    => 'cci_id',
                'fk'    => 'ipd_credit_invoice',
            ),
        );

        $i=0;
        foreach($results as $result){
          
          $results[$i]->invoices = $this->FetchWhereJoin('crm_credit_invoice_prod_det',array('ipd_delivery_prod_id' => $result->dpd_id),$joins);
          $i++;
        }
        
        return $results;
    }
    
    /**/


    /*Backlog section start*/
    
    /*public function FetchBacklog($from_date,$from_date_col,$to_date,$to_date_col,$data1,$data1_col,$data2,$data2_col,$data3,$data3_col,$data4,$data4_col,$table,$joins,$group_by_col)
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

    }*/

    
    public function FetchBacklog($from_date,$from_date_col,$to_date,$to_date_col,$data1,$data1_col,$data2,$data2_col){
         
        $query = $this->db->table('crm_sales_orders')
        ->select('*');

        if (!empty($from_date)) {
           
            $query->where($from_date_col.' >=', $from_date);
        }

        if (!empty($to_date)) {
           
            $query->where($from_date_col . ' <=', $to_date);
        }

        if (!empty($data1)) {
            $query->where($data1_col, $data1);
        }

        if (!empty($data2)) {
            $query->like($data2_col, $data2);
        }
        
        $query->join('crm_customer_creation','crm_customer_creation.cc_id=crm_sales_orders.so_customer','left');

        $query->join('executives_sales_executive','executives_sales_executive.se_id =crm_sales_orders.so_sales_executive','left');

        $result = $query->get()->getResult();
        
        $i = 0;
        foreach ($result as $res) {
          

            $result[$i]->delivery_note   = $this->FetchWhere('crm_delivery_note',array('dn_sales_order_num' => $res->so_id));
            
            $result[$i]->cash_invoiced    = $this->FetchWhere('crm_cash_invoice',array('ci_sales_order' => $res->so_id));

            $result[$i]->credit_invoiced  = $this->FetchWhere('crm_credit_invoice',array('cci_sales_order' => $res->so_id));
   
            $i++;
        }



        return $result;

    }
    /**/



    /*job profitability*/
    /*public function job_profitability($from_date,$from_date_col,$to_date,$to_date_col,$data1,$data1_col,$data2,$data2_col,$data3,$data3_col,$data4,$data4_col,$table,$joins,$group_by_col)
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

    }*/

    public function job_profitability($from_date,$from_date_col,$to_date,$to_date_col,$data1,$data1_col,$data2,$data2_col,$data3,$data3_col){

        $query = $this->db->table('crm_sales_orders')

        ->select('*');

        $query->join('crm_customer_creation','crm_customer_creation.cc_id=crm_sales_orders.so_customer','left');

        $query->join('executives_sales_executive','executives_sales_executive.se_id =crm_sales_orders.so_sales_executive','left');

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

        $result = $query->get()->getResult();


        $i = 0;

        foreach ($result as $res) {
            
            $result[$i]->purchase_vouchers      = $this->FetchPurchaseVoucher('pro_purchase_voucher_prod',array('pvp_sales_order' => $res->so_reffer_no));

            $result[$i]->purchase_return_prod   = $this->FetchPurchaseReturnProd('pro_purchase_return_prod',array('prp_sales_order' => $res->so_reffer_no));

            $result[$i]->petty_cash             = $this->FetchPettyCash('accounts_petty_cash_debits',array('pci_sales_order' => $res->so_id));

            $result[$i]->journal_voucher        = $this->FetchJournalVoucher('accounts_journal_invoices',array('ji_sales_order_id' => $res->so_id));
           
            $i++;
        }

        return $result;
     
    }


    public function FetchPurchaseVoucher($table,$cond){
 
        $query = $this->db->table($table)

        ->select('*')

        ->where($cond);

        $query->join('pro_purchase_voucher','pro_purchase_voucher.pv_id =pro_purchase_voucher_prod.pvp_reffer_id','left');

        $query->groupBy('pro_purchase_voucher.pv_reffer_id');

        $result = $query->get()->getResult();

        return $result;

    }


    public function FetchPurchaseReturnProd($table,$cond){
          
        $query = $this->db->table($table)

        ->select('*')

        ->where($cond);

        $query->join('pro_purchase_return','pro_purchase_return.pr_id =pro_purchase_return_prod.prp_purchase_return_id','left');

        $query->groupBy('pro_purchase_return.pr_reffer_id');

        $result = $query->get()->getResult();

        return $result;

    }

    public function FetchPettyCash($table,$cond){
         
        $query = $this->db->table($table)

        ->select('*')

        ->where($cond);

        $query->join('accounts_petty_cash_voucher','accounts_petty_cash_voucher.pcv_id = accounts_petty_cash_debits.pci_voucher_id','left');

        $query->groupBy('accounts_petty_cash_voucher.pcv_voucher_no');

        $result = $query->get()->getResult();

        return $result;

    }


    public function FetchJournalVoucher ($table,$cond){
        
        $query = $this->db->table($table)

        ->select('*')

        ->where($cond);

        $query->join('accounts_journal_vouchers','accounts_journal_vouchers.jv_id = accounts_journal_invoices.ji_voucher_id','left');

        $query->groupBy('accounts_journal_vouchers.jv_voucher_no');

        $result = $query->get()->getResult();

        return $result;

    }

    /**/




    /*invoice report section start*/

    /*public function invoice_report($from_date,$from_date_col,$to_date,$to_date_col,$data1,$data1_col,$data2,$data2_col,$data3,$data3_col,$data4,$data4_col,$table,$joins,$group_by_col)
    
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

            $i++;
        }

        return $result;
    }*/

    /*####*/
    

    public function return_report($from_date,$from_date_col,$to_date,$to_date_col,$data1,$data1_col,$data2,$data2_col,$data3,$data3_col)
   
    {
        $query = $this->db->table('crm_sales_return')
        ->select('*');

        $query->join('crm_customer_creation','crm_customer_creation.cc_id=crm_sales_return.sr_customer','left');

        $query->join('crm_sales_orders','crm_sales_orders.so_id=crm_sales_return.sr_sales_order','left');

        $query->join('executives_sales_executive','executives_sales_executive.se_id=crm_sales_orders.so_sales_executive','left');

       
        if(!empty($data3)){
            
            $query->join('crm_sales_return_prod_det','crm_sales_return_prod_det.srp_sales_return =crm_sales_return.sr_id','left');
        }
       
        if (!empty($from_date)) {
           
            $query->where($from_date_col.' >=', $from_date);
        }

        if (!empty($to_date)) {
           
            $query->where($from_date_col . ' <=', $to_date);
        }

        if (!empty($data1)) {
            $query->where($data1_col, $data1);
        }

        if (!empty($data2)) {
            $query->like($data2_col, $data2);
        }

        if (!empty($data3)) {
            $query->where($data3_col, $data3);
        }

        $result = $query->get()->getResult();
        
        $i = 0;
        foreach ($result as $res) {
            
            $result[$i]->return_product = $this->return_prod('crm_sales_return_prod_det',array('srp_sales_return' => $res->sr_id));
           
            $i++;
        }


        
        return $result;
    }

    public function return_prod($table,$cond){

        $query = $this->db->table($table)
        ->where($cond);
        $query->join('crm_products','crm_products.product_id=crm_sales_return_prod_det.srp_prod_det','left');
        
        $results = $query->get()->getResult();
        
        return $results;
    }

   
    public function invoice_report($from_date,$to_date,$customer,$sales_order_data,$product_data)
    {
        $cash_invoice = "{$this->db->getPrefix()}crm_cash_invoice";
        $credit_invoice = "{$this->db->getPrefix()}crm_credit_invoice";
        $customer_creation = "{$this->db->getPrefix()}crm_customer_creation";
        $sales_executive = "{$this->db->getPrefix()}executives_sales_executive";
        $sales_order = "{$this->db->getPrefix()}crm_sales_orders";
        $delivery_note = "{$this->db->getPrefix()}crm_delivery_note";
        $cash_invoice_prod = "{$this->db->getPrefix()}crm_cash_invoice_prod_det";
        $credit_invoice_prod = "{$this->db->getPrefix()}crm_credit_invoice_prod_det";
        $products = "{$this->db->getPrefix()}crm_products";
        $sales_return = "{$this->db->getPrefix()}crm_sales_return";
        $sales_return_prod = "{$this->db->getPrefix()}crm_sales_return_prod_det";


        // Base query
        $query = "SELECT * FROM (
            (SELECT 
                {$cash_invoice}.ci_date AS date,
                {$cash_invoice}.ci_reffer_no AS reference,
                {$cash_invoice}.ci_id  AS reffer_id,
                'cash invoice' as link,
                'cash invoice' as amount_check,
                {$customer_creation}.cc_customer_name as customer_name,
                {$customer_creation}.cc_id  AS customer_id,
                null as delivery_reff,
                null as delivery_id,
                {$sales_order}.so_reffer_no as sales_order,
                {$sales_order}.so_id as so_id,
                {$sales_order}.so_lpo as sales_lpo,
                {$products}.product_details  as product,
                {$products}.product_id  as product_id,
                {$cash_invoice_prod}.cipd_qtn  as quantity,
                {$cash_invoice_prod}.cipd_rate  as rate,
                {$cash_invoice_prod}.cipd_discount  as discount,
                {$cash_invoice_prod}.cipd_amount  as prod_amount,
                {$cash_invoice}.ci_total_amount AS amount
            FROM {$cash_invoice}
            LEFT JOIN {$customer_creation} 
                ON {$customer_creation}.cc_id = {$cash_invoice}.ci_customer
            LEFT JOIN {$sales_order} 
                ON {$sales_order}.so_id = {$cash_invoice}.ci_sales_order
            LEFT JOIN {$cash_invoice_prod} 
                ON {$cash_invoice_prod}.cipd_cash_invoice  = {$cash_invoice}.ci_id
            LEFT JOIN {$products} 
                ON {$products}.product_id  = {$cash_invoice_prod}.cipd_prod_det
            
            
            )

            UNION ALL 
            (SELECT 
                {$credit_invoice}.cci_date AS date,
                {$credit_invoice}.cci_reffer_no AS reference,
                {$credit_invoice}.cci_id  AS reffer_id,
                'credit invoice' as link,
                'credit invoice' as amount_check,
                {$customer_creation}.cc_customer_name as customer_name,
                {$customer_creation}.cc_id  AS customer_id,
                {$delivery_note}.dn_reffer_no  as delivery_reff,
                {$delivery_note}.dn_id  as delivery_id,
                {$sales_order}.so_reffer_no as sales_order,
                {$sales_order}.so_id as so_id,
                {$sales_order}.so_lpo as sales_lpo,
                {$products}.product_details  as product,
                {$products}.product_id  as product_id,
                {$credit_invoice_prod}.ipd_quantity  as quantity,
                {$credit_invoice_prod}.ipd_rate  as rate,
                {$credit_invoice_prod}.ipd_discount  as discount,
                {$credit_invoice_prod}.ipd_amount  as prod_amount,
                {$credit_invoice}.cci_total_amount AS amount
            FROM {$credit_invoice}
            LEFT JOIN {$customer_creation} 
                ON {$customer_creation}.cc_id = {$credit_invoice}.cci_customer
            LEFT JOIN {$delivery_note} 
                ON {$delivery_note}.dn_id = {$credit_invoice}.cci_delivery_id
            LEFT JOIN {$sales_order} 
                ON {$sales_order}.so_id = {$credit_invoice}.cci_sales_order
            LEFT JOIN {$credit_invoice_prod} 
                ON {$credit_invoice_prod}.ipd_credit_invoice  = {$credit_invoice}.cci_id 
            LEFT JOIN {$products} 
                ON {$products}.product_id  = {$credit_invoice_prod}.ipd_prod_detl
            
           
            )
            
            UNION ALL 
            (SELECT 
                {$sales_return}.sr_date AS date,
                {$sales_return}.sr_reffer_no AS reference,
                {$sales_return}.sr_id   AS reffer_id,
                'sales return' as link,
                'sales return' as amount_check,
                {$customer_creation}.cc_customer_name as customer_name,
                {$customer_creation}.cc_id  AS customer_id,
                null as delivery_reff,
                null as delivery_id,
                {$sales_order}.so_reffer_no as sales_order,
                {$sales_order}.so_id as so_id,
                {$sales_order}.so_lpo as sales_lpo,
                {$products}.product_details  as product,
                {$products}.product_id  as product_id,
                {$sales_return_prod}.srp_quantity  as quantity,
                {$sales_return_prod}.srp_rate  as rate,
                {$sales_return_prod}.srp_discount  as discount,
                {$sales_return_prod}.srp_amount  as prod_amount,
                {$sales_return}.sr_total AS amount
            FROM {$sales_return}
            LEFT JOIN {$customer_creation} 
                ON {$customer_creation}.cc_id = {$sales_return}.sr_customer
            LEFT JOIN {$sales_order} 
                ON {$sales_order}.so_id = {$sales_return}.sr_sales_order
            LEFT JOIN {$sales_return_prod} 
                ON {$sales_return_prod}.srp_sales_return  = {$sales_return}.sr_id  
            LEFT JOIN {$products} 
                ON {$products}.product_id  = {$sales_return_prod}.srp_prod_det
            
           
            )
            
        ) AS combined_results";
    
        // Prepare conditions
        $conditions = [];
    
       
        if (!empty($from_date) && !empty($to_date)) {

            $conditions[] = "(combined_results.date BETWEEN '{$from_date}' AND '{$to_date}')";
        }
    
       
        if (!empty($customer)) {

            $conditions[] = "combined_results.customer_id = '{$customer}'";

        }
    
       
        if (!empty($sales_order)) {

            $conditions[] = "combined_results.so_id LIKE '%{$sales_order_data}%'";
        }
        
        
        if (!empty($product_data)) {

            $conditions[] = "combined_results.product_id = '{$product_data}'";
        }

    
       
        if (!empty($conditions)) {

            $query .= " WHERE " . implode(" AND ", $conditions);
        }
    
        // Order by date
        $query .= " ORDER BY combined_results.date,combined_results.reference";
    
        // Execute the query
        $result = $this->db->query($query)->getResult();
    
        return $result;
    }


  


    public function sales_summery($from_date, $to_date, $customer, $sales_executive_data)
    {
        $cash_invoice = "{$this->db->getPrefix()}crm_cash_invoice";
        $credit_invoice = "{$this->db->getPrefix()}crm_credit_invoice";
        $customer_creation = "{$this->db->getPrefix()}crm_customer_creation";
        $sales_executive = "{$this->db->getPrefix()}executives_sales_executive";
        $sales_order = "{$this->db->getPrefix()}crm_sales_orders";
        $sales_return = "{$this->db->getPrefix()}crm_sales_return";
    
        // Base query
        $query = "SELECT * FROM (
            (SELECT 
                {$cash_invoice}.ci_date AS date,
                {$cash_invoice}.ci_reffer_no AS reference,
                {$cash_invoice}.ci_id AS reffer_id,
                'cash invoice' as link,
                'cash invoice' as amount_check,
                {$customer_creation}.cc_customer_name as customer_name,
                {$customer_creation}.cc_id  AS customer_id,
                {$sales_order}.so_reffer_no as sales_order,
                {$sales_order}.so_id  as sales_order_id,
                {$sales_order}.so_lpo as sales_lpo,
                {$sales_executive}.se_name as sales_exec,
                {$sales_executive}.se_id  as sales_exec_id,
                {$cash_invoice}.ci_total_amount AS amount
            FROM {$cash_invoice}
            LEFT JOIN {$customer_creation} 
                ON {$customer_creation}.cc_id = {$cash_invoice}.ci_customer
            LEFT JOIN {$sales_order} 
                ON {$sales_order}.so_id = {$cash_invoice}.ci_sales_order
            LEFT JOIN {$sales_executive} 
                ON {$sales_executive}.se_id = {$sales_order}.so_sales_executive
            )
             UNION ALL 
            (SELECT 
                {$credit_invoice}.cci_date AS date,
                {$credit_invoice}.cci_reffer_no AS reference,
                {$credit_invoice}.cci_id  AS reffer_id,
                'credit invoice' as link,
                'credit invoice' as amount_check,
                {$customer_creation}.cc_customer_name as customer_name,
                {$customer_creation}.cc_id  AS customer_id,
                {$sales_order}.so_reffer_no as sales_order,
                {$sales_order}.so_id  as sales_order_id,
                {$sales_order}.so_lpo as sales_lpo,
                {$sales_executive}.se_name as sales_exec,
                {$sales_executive}.se_id  as sales_exec_id,
                {$credit_invoice}.cci_total_amount AS amount
            FROM {$credit_invoice}
            LEFT JOIN {$customer_creation} 
                ON {$customer_creation}.cc_id = {$credit_invoice}.cci_customer
            LEFT JOIN {$sales_order} 
                ON {$sales_order}.so_id = {$credit_invoice}.cci_sales_order
            LEFT JOIN {$sales_executive} 
                ON {$sales_executive}.se_id = {$sales_order}.so_sales_executive
            )
            UNION ALL 
            (SELECT 
                {$sales_return}.sr_date AS date,
                {$sales_return}.sr_reffer_no AS reference,
                {$sales_return}.sr_id   AS reffer_id,
                'sales return' as link,
                'sales return' as amount_check,
                {$customer_creation}.cc_customer_name as customer_name,
                {$customer_creation}.cc_id  AS customer_id,
                {$sales_order}.so_reffer_no as sales_order,
                {$sales_order}.so_id  as sales_order_id,
                {$sales_order}.so_lpo as sales_lpo,
                {$sales_executive}.se_name as sales_exec,
                {$sales_executive}.se_id  as sales_exec_id,
                {$sales_return}.sr_total AS amount
            FROM {$sales_return}
            LEFT JOIN {$customer_creation} 
                ON {$customer_creation}.cc_id = {$sales_return}.sr_customer
            LEFT JOIN {$sales_order} 
                ON {$sales_order}.so_id = {$sales_return}.sr_sales_order
            LEFT JOIN {$sales_executive} 
                ON {$sales_executive}.se_id = {$sales_order}.so_sales_executive
            )
        ) AS combined_results";
    
        // Prepare conditions
        $conditions = [];
    
        // Date filter
        if (!empty($from_date) && !empty($to_date)) {

            $conditions[] = "(combined_results.date BETWEEN '{$from_date}' AND '{$to_date}')";
        }
    
        // Customer filter
        if (!empty($customer)) {

            $conditions[] = "combined_results.customer_id = '{$customer}'";

        }
    
        // Sales Executive filter
        if (!empty($sales_executive_data)) {

            $conditions[] = "combined_results.sales_exec_id LIKE '%{$sales_executive_data}%'";
        }
    
        // Append conditions to the query if any exist
        if (!empty($conditions)) {

            $query .= " WHERE " . implode(" AND ", $conditions);
        }
    
        // Order by date
        $query .= " ORDER BY combined_results.date";
    
        // Execute the query
        $result = $this->db->query($query)->getResult();
    
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

    public function PurchaseVoucher($from_date,$from_date_col){

        $query = $this->db->table('pro_purchase_voucher')
        
        ->select('*');

        $query->join('pro_vendor','pro_vendor.ven_id=pro_purchase_voucher.pv_vendor_name','left');

        if (!empty($from_date)) {
           
            $query->where($from_date_col.' >=', $from_date)
            ->where($from_date_col . ' <', date('Y-m-d', strtotime($from_date . ' +1 day'))); // Exclude records after the date
        }
        
        
        $result = $query->get()->getResult();

        $i = 0;

        foreach ($result as $res) {
            
            $result[$i]->purchase_voucher_prod   = $this->purchase_voucher_prod('pro_purchase_voucher_prod',array('pvp_reffer_id' => $res->pv_id));
            
            $i++;
        }

        return $result;

    }


    public function purchase_voucher_prod($table,$cond){
         
        $query = $this->db->table($table)
        
        ->where($cond);
        
        $results = $query->get()->getResult();
           
        $j = 0;

        foreach($results as $res){

            $results[$j]->purchase_sales_order   = $this->purchase_sales_order('crm_sales_orders',array('so_reffer_no' => $res->pvp_sales_order));
            
            $j++;

        }
        
        
        return $results;

    }

    public function purchase_sales_order($table,$cond){

       $subQuery = $this->db->table('crm_delivery_note')

        ->select('dn_sales_order_num');

        $subQuery1 = $this->db->table('crm_cash_invoice')

        ->select('ci_sales_order');
        
        $query = $this->db->table($table)
        
        ->where($cond);

        $query->whereNotIn('crm_sales_orders.so_id', $subQuery);

        $query->whereNotIn('crm_sales_orders.so_id', $subQuery1);

        $results = $query->get()->getResult();

       // echo $this->db->getLastQuery(); exit();

        return $results;

    }


   

   

}

