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

    public function SingleRowCol($table,$col,$cond)
    {
        return $this->db
        ->table($table)
        ->select($col)
        ->where($cond)
        ->get()
        ->getRow();
    }

    public function SingleRow($table,$cond)
    {
        return $this->db
        ->table($table)
        ->where($cond)
        ->get()
        ->getRow();
    }

    public function SingleRowArray($table,$cond)
    {
        return $this->db
        ->table($table)
        ->where($cond)
        ->get()
        ->getRowArray();
    }


    public function SingleRowJoin($table,$cond,$joins)
    {
        $query= $this->db->table($table)
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

        $result = $query->get()->getRow();

        return $result;

    }



    public function SingleRowAliasJoin($table,$cond,$joins)
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



    public function CountWhere($table,$cond)
    {
        $query = $this->db->table($table)
        ->where($cond)
        ->get();
        return $query->getNumRows();

    }



    //Fetch Where

    public function FetchWhere($table,$cond)
    {
        $query = $this->db->table($table)
        ->where($cond)
        ->get();
        return $query->getResult();

    }


    //Fetch Sum Of Coloumn Where


    public function FetchSum($table,$column,$cond="")
    {
        $query = $this->db->table($table);

        $query->selectSum($column);

        if($cond !="")
        {
        $query->where($cond);
        }

        $result = $query->get()->getRow();

        return $result->$column;
        
    }



    public function FetchMax($table,$column,$cond="")
    {

        $query = $this->db->table($table);

        $query->selectMax($column);

        if($cond !="")
        {
            $query->where($cond);
        }

        $result = $query->get()->getRow();

        return $result->$column;

    }



    //Account Head Id Increment

    public function FetchNextHeadId($id)
    {

        $ah_query = $this->db->table('accounts_account_heads');

        $ah_query->select('ah_head_id');

        $ah_query->where('ah_id',$id);

        $ah_result = $ah_query->get()->getRow();


        $ca_query = $this->db->table('accounts_charts_of_accounts');

        $ca_query->selectMax('ca_account_id');

        $ca_query->where('ca_account_type',$id);
       
        $ca_result = $ca_query->get()->getRow();


        if(!empty($ca_result->ca_account_id))

        {

        $head_id = $ca_result->ca_account_id;

        }

        else
        {

        $head_id = $ah_result->ah_head_id;

        }

        $head_id++;

        return $head_id;

    }








    //Fetch where Join
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
    //Fetch where limit
    public function FetchWhereLimit($id,$coloum_id,$order_key,$order,$table,$end,$start)
    {
        return $this->db
        ->table($table)
        ->select('*')
        ->where($coloum_id,$id)
        ->limit($end,$start)
        ->orderBy($order_key,$order)
        ->get()
        ->getRow();
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


    public function FetchAllOrderLimit($table,$order_key,$order,$end,$start)
    {

        return $this->db
        ->table($table)
        ->select('*')
        ->limit($end,$start)
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

    //report  select two droup drown
    /*public function ReportFetchLimit($table, $order_key, $order, $term, $end, $start, $joins = [])
    {
        $query = $this->db->table($table)->select('*');

        foreach ($joins as $join) {
            $query->join($join['table'], $join['table'] . '.' . $join['pk'] . ' = ' . $table . '.' . $join['fk'], 'left');
        }

        $query->like($order_key, $term)
            ->limit($end, $start)
            ->orderBy($order_key, $order);

        return $query->get()->getResult();
    }*/


    public function ReportFetchLimit($table, $order_key, $order, $term, $end, $start,$joins = [],$group_by)
    {
        $query = $this->db->table($table)->select('*');

        foreach ($joins as $join) {
            $query->join($join['table'], $join['table'] . '.' . $join['pk'] . ' = ' . $table . '.' . $join['fk'], 'left');
        }

        $query->like($order_key, $term)
            ->limit($end, $start)
            ->orderBy($order_key, $order)
            ->groupBy($group_by);


        return $query->get()->getResult();
    }


    /*public function ReportFetchLimit($table, $order_key, $order, $term, $end, $start, $group_by, $joins = [])
    {
        $query = $this->db->table($table)->select('*');
    
        foreach ($joins as $join) {
            $query->join($join['table'], $join['table'] . '.' . $join['pk'] . ' = ' . $table . '.' . $join['fk'], 'left');
        }
    
        $query->like($order_key, $term)
              ->limit($end, $start)
              ->orderBy($order_key, $order);
    
        if (!empty($group_by)) {
            // Ensure $group_by is an array
            if (!is_array($group_by)) {
                $group_by = [$group_by];
            }
    
            foreach ($group_by as $group) {
                // Check if $group is a valid column name
                if (is_string($group) && strpos($group, '.') !== false) {
                    $query->groupBy($group);
                }
            }
        }
    
        return $query->get()->getResult();
    }*/
    


    


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

        foreach($searchColoum as $col)
        {
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

    public function FetchCustomerCreation($table,$joins)
    {
        $query= $this->db->table($table);

        if(!empty($joins))
        {
            foreach($joins as $join)
            {
                $query->join($join['table'], ''.$join['table'].'.'.$join['pk'].' = '.$table.'.'.$join['fk'].'', 'left');
            }
        }
        $query->groupBy('cc_id');
        
        $result = $query->get()->getResult();

        return $result;
    }

   
    //For Next Autoincrement

    public function FetchNextId($table,$prefix)
    {

        $query = $this->db->query('SHOW TABLE STATUS WHERE `name` LIKE "'. $this->db->getPrefix().''.$table.'";');

        $row = $query->getRow();

        $id = $row->Auto_increment;

        $uid = $prefix.str_pad($id, 7, '0', STR_PAD_LEFT);

        return $uid;

    }

    //check data alread in table

    public function CheckData($table,$coloum1,$data1)
    {
        return $this->db
        ->table($table)
        ->where($coloum1,$data1)
        ->get()
        ->getResult();
    }

    //check data alread in table expect select one
    
    public function CheckDataWhere($table,$coloum1,$data1,$id,$id_coloum)
    {
       return $this->db
       //$this->db
        ->table($table)
        ->whereNotIn($id_coloum,(array)$id)
        ->where($coloum1,$data1)
        ->get()
        //echo $this->db->getLastQuery();
        //exit();
        ->getResult();
    }
          

   
 
    /*fetch enquiry in quot*/

   

    public function FetchEnquiryInQuot($id)
    {
        $query = $this->db->table('crm_enquiry')

        ->select('*')

        ->where('enquiry_customer', $id)

        ->join('crm_quotation_details', 'crm_enquiry.enquiry_id = crm_quotation_details.qd_enq_ref', 'left')

        ->groupStart()

            ->where('crm_quotation_details.qd_enq_ref IS NULL') // Include rows where qd_enq_ref is NULL
            
            ->orWhere('crm_enquiry.enquiry_id NOT IN (SELECT qd_enq_ref FROM '.$this->db->getPrefix().'crm_quotation_details)')

        ->groupEnd()

        ->get();

        return $query->getResult();
    }



    /*Edit Fetch enquiry in  quot*/
    
    /*public function EditEnquiryInQuot($id,$enquiry_id)
    {
        $query = $this->db->table('crm_enquiry')

        ->select('*')

        ->whereNotIn('enquiry_id' ,(array)$enquiry_id)

        ->where('enquiry_customer', $id)

        ->join('crm_quotation_details', 'crm_enquiry.enquiry_id = crm_quotation_details.qd_enq_ref', 'left')

        ->groupStart()

            ->where('crm_quotation_details.qd_enq_ref IS NULL') // Include rows where qd_enq_ref is NULL
            
            ->orWhere('crm_enquiry.enquiry_id NOT IN (SELECT qd_enq_ref FROM '.$this->db->getPrefix().'crm_quotation_details)')

        ->groupEnd()

        ->get();


        return $query->getResult();
    }*/



    /*####*/




    /*fetch Quot in sales order*/
    
    /*public function FetcQuotInSales($id)
    {
        $query = $this->db->table('crm_quotation_details')
        
        ->select('*')

        ->where('qd_customer',$id)

        ->where('crm_quotation_details.qd_id  NOT IN (SELECT so_quotation_ref FROM '.$this->db->getPrefix().'crm_sales_orders)')

        ->get();

        //echo $this->db->getLastQuery(); exit();

        return $query->getResult();
    }*/


    public function FetcQuotInSales($id)
    {
        $query = $this->db->table('crm_quotation_details')
        
        ->select('*')

        ->where('qd_customer',$id)

        ->where('crm_quotation_details.qd_id  NOT IN (SELECT so_quotation_ref FROM '.$this->db->getPrefix().'crm_sales_orders)')

        ->get();

        //echo $this->db->getLastQuery(); exit();
        
        return $query->getResult();
    }



    /*####*/

    /*fetch  sales order  which are not in cash invoice(in deliverynote and cash invoice)*/

    public function FetchSalesInCashInvoice($id)
    {
        $query = $this->db->table('crm_sales_orders')
        
        ->select('*')

        ->where('so_customer',$id)

        ->where('crm_sales_orders.so_id  NOT IN (SELECT ci_sales_order FROM '.$this->db->getPrefix().'crm_cash_invoice)')

        ->get();

        return $query->getResult();
    }

    /*###*/


    /**/
    public  function FetchSalesOrder($table,$cond,$cond2)
    {
        $query = $this->db->table($table)
        
        ->select('*')

        ->where($cond)

        ->where($cond2)

        ->get();

        return $query->getResult();
    }

     
    /**/


    public function FetchProd($table, $cond, $cond2, $joins)
   {
        $query = $this->db->table($table)
            ->select('*')
            ->where($cond)
            ->where($cond2);

        if (!empty($joins)) {
            foreach ($joins as $join) {
                $query->join($join['table'], '' . $join['table'] . '.' . $join['pk'] . ' = ' . $table . '.' . $join['fk'], 'left');
            }
        }

        $result = $query->get()->getResult();
        
        //echo $this->db->getLastQuery(); exit();


        return $result;
    }


    public function FetchProdData($table,$cond,$cond2)
    {
        $query = $this->db->table($table)
        
        ->select('*')

        ->where($cond)

        ->where($cond2)

        ->get();

        return $query->getResult();
    }


    //check date
    
    public function CheckDate($from_date,$from_date_col,$to_date,$to_date_col,$customer,$customer_col,$sales_executive,$sales_executive_col,$product,$prod_col,$sales_order,$sales_order_col,$table,$joins,$group_by_col)
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

        
        if (!empty($customer)) {
            $query->like($customer_col, $customer);
        }

        
        if (!empty($sales_executive)) {
            $query->like($sales_executive_col, $sales_executive);
        }

        if(!empty($product))
        {    
            //$query->like($prod_col, $product);
            $query->like($join['table'] . '.' . $prod_col, $product);
        }

        if(!empty($sales_order))
        {
          
            $query->like($sales_order_col, $sales_order);
        }

        
        if(!empty($join))
        {
            $query->groupBy($table. '.' . $group_by_col);

        }
       
        $result = $query->get()->getResult();

        //echo $this->db->getLastQuery(); exit();

        return $result;

    }


    public function FetchWhereUniqueJoin($table,$cond,$joins,$group_coloum)
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
        $query->groupBy($group_coloum);

        $result = $query->get()->getResult();

        return $result;
    }
    

    //fetch product by customer

    //for sales quotation

    public function FetchProductByCustomer($table,$id)
    {
        $query = $this->db->table($table)
                      ->select('*')
                      ->where('qd_customer', $id)
                      ->get();

        $result = $query->getResult();

        $i = 0;

        foreach ($result as $quotation_details) {
            $result[$i]->product_details = $this->product_details($quotation_details->qd_id);
            $i++;
        }

        return $result;
    }



    public function product_details($pid)
    {
        $query = $this->db->table('crm_quotation_product_details')
                        ->select('*')
                        ->where('qpd_quotation_details', $pid)
                        ->join('crm_products', 'crm_products.product_id = crm_quotation_product_details.qpd_product_description', 'left')
                        ->groupBy('crm_quotation_product_details.qpd_product_description') 
                        ->get();

                     
                       
        return $query->getResult();
    }


    //fetch sales orders 
    
    public function FetchSalesProdByCustomer($table,$id)
    {
        $query = $this->db->table($table)
                      ->select('*')
                      ->where('so_customer', $id)
                      ->get();

        $result = $query->getResult();

        $i = 0;

        foreach ($result as $quotation_details) {
            $result[$i]->sales_prod_details = $this->sales_prod_details($quotation_details->so_id);
            $i++;
        }

        return $result;
    }



    public function sales_prod_details($pid)
    {
        $query = $this->db->table('crm_sales_product_details')
                        ->select('*')
                        ->where('spd_sales_order', $pid)
                        ->join('crm_products', 'crm_products.product_id = crm_sales_product_details.spd_product_details', 'left')
                        ->groupBy('crm_sales_product_details.spd_product_details') 
                        ->get();
                        //echo $this->db->getLastQuery();  exit();             
                        return $query->getResult();
    }
    
    // fetch delivery note

    public function FetchDeliveryProdByCustomer($table,$id)
    {
        $query = $this->db->table($table)
                      ->select('*')
                      ->where('dn_customer', $id)
                      ->get();

        $result = $query->getResult();

        $i = 0;

        foreach ($result as $delivery_details) {
            $result[$i]->delivery_prod_details = $this->delivery_prod_details($delivery_details->dn_id);
            $i++;
        }

        return $result;
    }



    public function delivery_prod_details($pid)
    {
        $query = $this->db->table('crm_delivery_product_details')
                        ->select('*')
                        ->where('dpd_delivery_id', $pid)
                        ->join('crm_products', 'crm_products.product_id = crm_delivery_product_details.dpd_prod_det', 'left')
                        ->groupBy('crm_delivery_product_details.dpd_prod_det') 
                        ->get();
                       
                        return $query->getResult();
    }


    //invoice report

    public function FetchCreditProdByCustomer($table,$id)
    {
        $query = $this->db->table($table)
        ->select('*')
        ->where('cci_customer', $id)
        ->get();

        $result = $query->getResult();

        $i = 0;

        foreach ($result as $credit_details) {
        $result[$i]->credit_prod_details = $this->credit_prod_details($credit_details->cci_id);
        $i++;
        }

        return $result; 

    }

    public function credit_prod_details($pid)
    {
        $query = $this->db->table('crm_credit_invoice_prod_det')
                        ->select('*')
                        ->where('ipd_credit_invoice', $pid)
                        ->join('crm_products', 'crm_products.product_id = crm_credit_invoice_prod_det.ipd_prod_detl', 'left')
                        ->groupBy('crm_credit_invoice_prod_det.ipd_prod_detl') 
                        ->get();
                        return $query->getResult();
    }

    /*###fetch product by customer end##*/


    /*public function FetcQuotWhere($id)
    {
        $query = $this->db->table('crm_quotation_details')
        
        ->select('*')

        ->where('qd_customer',$id)

        //->whereNotIn('so_reffer_no',(array)$id)

        //->where('crm_quotation_details.qd_id  NOT IN (SELECT so_quotation_ref FROM '.$this->db->getPrefix().'crm_sales_orders)')
        ->where('crm_quotation_details.qd_id', 'NOT IN', function($query) use ($id) {
            $query->select('so_quotation_ref')
                  ->from($this->db->getPrefix().'crm_sales_orders')
                  ->whereNotIn('so_reffer_no', (array)$id);
        })
        ->get();

        echo $this->db->getLastQuery();

        exit();

        return $query->getResult();
    }*/


    /*public function FetcQuotWhere($id)
    {
        $query = $this->db->table('crm_quotation_details')
        
        ->select('*')

        ->where('qd_customer',$id)

        ->whereNotIn('qd_id', function($query) use ($id) {
            $query->select('so_quotation_ref')
                ->from($this->db->getPrefix().'crm_sales_orders')
                ->whereNotIn('so_reffer_no', (array)$id);
        })
        ->get();

        echo $this->db->getLastQuery();

        exit();

        return $query->getResult();
    }*/


    public function CheckTwiceCond($table,$cond1,$cond2)
    {
        $query = $this->db->table($table)
        
        ->select('*')

        ->where($cond1)

        ->where($cond2)

        ->get();

        return $query->getRow();
 
    }



    public function CheckTwiceCond1($table,$cond1,$cond2)
    {
        $query = $this->db->table($table)
        
        ->select('*')

        ->where($cond1)

        ->where($cond2)

        ->get();

        return $query->getResult();
 
    }


    public function TwiceCondWithNot($table,$cond1,$cond2,$joins,$id_coloum,$id)
    {
        $query = $this->db->table($table)
        
        ->select('*')

        ->whereNotIn($id_coloum,(array)$id)

        ->where($cond1)

        ->where($cond2);

        if(!empty($joins))
			
        foreach($joins as $join)
        {
            $query->join($join['table'], ''.$join['table'].'.'.$join['pk'].' = '.$table.'.'.$join['fk'].'', 'left');
        }

        $result = $query->get()->getRow();

        echo $this->db->getLastQuery();

        exit();


        //return $query->getRow();
    }


    /*public function EditFetchProd($table, $cond, $cond2, $joins,$id,$id_coloum)
    
    {
        $query = $this->db->table($table)
        ->select('*')
        ->whereNotIn($id_coloum,(array)$id)
        ->where($cond)
        ->where($cond2);

        if (!empty($joins)) {
            foreach ($joins as $join) {
                $query->join($join['table'], '' . $join['table'] . '.' . $join['pk'] . ' = ' . $table . '.' . $join['fk'], 'left');
            }
        }

        $result = $query->get()->getResult();

        echo $this->db->getLastQuery();

        exit();

        //return $result;
    }*/


    public function EditFetchProd($table, $cond, $cond2, $joins,$id,$id_coloum)
    {
        $query = $this->db->table($table)
        ->select('*')
        ->whereNotIn($id_coloum,(array)$id)
        ->where($cond)
        ->where($cond2);

        if (!empty($joins)) {
            foreach ($joins as $join) {
                $query->join($join['table'], '' . $join['table'] . '.' . $join['pk'] . ' = ' . $table . '.' . $join['fk'], 'left');
            }
        }

        $result = $query->get()->getResult();


        return $result;
    }


   /* public function FetchDataByGroup($table,$groupBy,$cond,$cond2,$joins)
    {
        $query = $this->db->table($table)
        
        ->select('*')

        ->where($cond);

        if(!empty($cond2))
        {
            ->where($cond2)
        }

        ->groupBy($groupBy);

        if (!empty($joins)) {
            foreach ($joins as $join) {
                $query->join($join['table'], '' . $join['table'] . '.' . $join['pk'] . ' = ' . $table . '.' . $join['fk'], 'left');
            }
        }

        $result = $query->get()->getResult();
        
       //echo $this->db->getLastQuery(); exit();

        return $result;
    }*/


    public function FetchDataByGroup($table, $groupBy, $cond, $cond2, $joins)
    {
        $query = $this->db->table($table)
            ->select('*')
            ->where($cond);

        if (!empty($cond2)) {
            $query->where($cond2);
        }

        $query->groupBy($groupBy);

        if (!empty($joins)) {
            foreach ($joins as $join) {
                $query->join($join['table'], '' . $join['table'] . '.' . $join['pk'] . ' = ' . $table . '.' . $join['fk'], 'left');
            }
        }

        $result = $query->get()->getResult();
      
        return $result;
    }



    public function FetchCreditProd($table,$cond,$cond2,$joins)
    {
        $query = $this->db->table($table)

        ->where($cond)

        ->where($cond2);

        //->groupBy('crm_delivery_note.dn_reffer_no');

        //->groupBy($group_coloum);

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
       
        $result = $query->get()->getResult();
        
        //echo $this->db->getLastQuery(); exit();

        return $result;

    }

    public function FetchCreditSales($table,$cond,$cond2)
    {
        $query = $this->db->table('crm_sales_orders')
        
        ->select('*')

        ->where($cond)

        ->where($cond2)

        ->where('crm_sales_orders.so_id IN (SELECT dn_sales_order_num FROM '.$this->db->getPrefix().'crm_delivery_note)')

        ->get();

        return $query->getResult();
    }

    public function FetchPerformaClaim($cond,$id_coloum,$id)
    {
        $query = $this->db->table('crm_proforma_invoices')
        
        ->select('*')

        ->whereNotIn($id_coloum,(array)$id)

        ->where($cond)

        ->get();

        return $query->getResult();
    }


    /**/
    public  function FetchSalesReturns($table,$cond,$cond2,$cond3)
    {
        $query = $this->db->table($table)
        
        ->select('*')

        ->where($cond)

        ->where($cond2)

        ->where($cond3)

        ->get();

        return $query->getResult();
    }

    /**/


    public function FetchReturnJoin($table,$cond,$cond2,$joins)
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

        $query->where($cond2);
       
        $result = $query->get()->getResult();
        //echo $this->db->getLastQuery(); exit();

        return $result;

    }
    
   



}

