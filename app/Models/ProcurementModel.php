<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;


class ProcurementModel extends Model
{

    protected $db;

    public function FetchWhereJoinGp($table, $cond, $joins, $group_by_col)
    {

        $query = $this->db->table($table);

        if (!empty($joins))

            foreach ($joins as $join) {
                $table2 = $table;
                if (!empty($join['table2'])) {
                    $table2 = $join['table2'];
                }
                $query->join($join['table'], '' . $join['table'] . '.' . $join['pk'] . ' = ' . $table2 . '.' . $join['fk'] . '', 'left');
            }

        $query->where($cond);

        $query->groupBy($table . '.' . $group_by_col);

        $result = $query->get()->getResult();

        return $result;
    }


    public function FetchWhereNotIn($table, $cond, $id_coloum, $id)
    {
        $query = $this->db->table($table)

            ->select('*')

            ->whereNotIn($id_coloum, (array)$id)

            ->where($cond)

            ->get();

        //echo $this->db->getLastQuery();

        //exit();

        return $query->getResult();
    }




    // NewAddition
    public function AccHeadBalance($account)
    {
        // Ensure the account and date are sanitized or properly escaped to prevent SQL injection
        $account = $this->db->escape($account);


        // Create the SQL query
        $query = $this->db->query(
            '
                SELECT 
                    SUM(tran_credit) - SUM(tran_debit) AS total_balance 
                FROM 
                    ' . $this->db->getPrefix() . 'master_transactions 
                WHERE                    
                    tran_account = ' . $account
        );

        // Fetch the result
        $result = $query->getRow();

        // Return the total balance if the result exists, otherwise return 0
        return $result ? $result->total_balance : 0;
    }




    public function FetchFixedPurchases($vendor)
    {
        // Select the table and columns
        $query = $this->db->table('pro_purchase_voucher');

        // Summing pv_total from the pro_purchase_voucher
        $query->select('SUM(pvp_amount) AS total', FALSE);

        // Joining pro_purchase_voucher_prod table
        $query->join('pro_purchase_voucher_prod', 'pro_purchase_voucher_prod.pvp_reffer_id = pro_purchase_voucher.pv_id', 'left');

        // Joining accounts_charts_of_accounts table
        $query->join('accounts_charts_of_accounts', 'accounts_charts_of_accounts.ca_id = pro_purchase_voucher_prod.pvp_debit', 'left');

        // Filtering by vendor ID
        $query->where('ca_account_id', $vendor);

        // Get the result row
        $result = $query->get()->getRow();

        // Handling potential null results
        $max = isset($result->total) ? $result->total : 0;

        // Debugging: Show the last query for verification
        // echo $this->db->getLastQuery();
        // exit;

        // Return the max total or 0 if no valid result
        return $max > 0 ? $max : 0;
    }

    public function FetchAllOrderJoin($table,$order_key,$order,$joins,$group_by_col){
           
        $query= $this->db
        ->table($table)
        ->select('*')
        ->orderBy($order_key, $order);
        if(!empty($joins))
        foreach($joins as $join)
        {
            $query->join($join['table'], ''.$join['table'].'.'.$join['pk'].' = '.$table.'.'.$join['fk'].'', 'left');
        }

        $query->groupBy($table . '.' . $group_by_col);

        $result = $query->get()->getResult();

        return $result;

        //->get()
        //->getResult();
    }

        // NewAddition
        public function FixedAssetBalance($account)
        {
            // Ensure the account and date are sanitized or properly escaped to prevent SQL injection
            $account = $this->db->escape($account);
    
    
            // Create the SQL query
            $query = $this->db->query(
                '
                    SELECT 
                        SUM(dpcd_depreciation_amt) AS total_balance 
                    FROM 
                        ' . $this->db->getPrefix() . 'pro_depreciation_det 
                    WHERE                    
                        dpcd_asset_id = ' . $account
            );
    
            // Fetch the result
            $result = $query->getRow();
    
            // Return the total balance if the result exists, otherwise return 0
            return $result ? $result->total_balance : 0;
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



    public function CheckData($from_date, $from_date_col, $to_date, $to_date_col, $data1, $data1_col, $data2, $data2_col, $data3, $data3_col, $data4, $data4_col, $table, $joins, $group_by_col, $joins1)
    {
        $query = $this->db->table($table)
            ->select('*');
        // Join additional tables if specified
        if (!empty($joins)) {
            foreach ($joins as $join) {
                $query->join($join['table'], $join['table'] . '.' . $join['pk'] . ' = ' . $table . '.' . $join['fk'], 'left');
            }
        }

        if (!empty($from_date)) {

            $query->where($from_date_col . ' >=', $from_date);
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

        if (!empty($join)) {
            $query->groupBy($table . '.' . $group_by_col);
        }


        $result = $query->get()->getResult();

        // Get the last executed query
        //echo $this->db->getLastQuery();

        //return $result;

        $i = 0;
        foreach ($result as $res) {
            $cond_user = ['pop_purchase_order' => $res->pop_purchase_order];
        
            // Create the query using the Query Builder
            $query = $this->db->table($table)->where($cond_user); 
        
            // Echo the compiled select query without executing it

            $result[$i]->product_orders = $this->FetchWhereJoin($table, $cond_user, $joins1);

            // echo $this->db->getLastQuery();  // Will show the query without executing it
            // exit;

            $i++;
        }
        
        
        return $result;
    }


    public function MaterialReqCheckData($from_date, $from_date_col, $to_date, $to_date_col, $data1, $data1_col, $data2, $data2_col, $data3, $data3_col, $data4, $data4_col, $table, $joins, $group_by_col, $joins1)
    {
        $query = $this->db->table($table)
            ->select('*');
        // Join additional tables if specified
        if (!empty($joins)) {
            foreach ($joins as $join) {
                $query->join($join['table'], $join['table'] . '.' . $join['pk'] . ' = ' . $table . '.' . $join['fk'], 'left');
            }
        }

        if (!empty($from_date)) {

            $query->where($from_date_col . ' >=', $from_date);
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

        if (!empty($join)) {
            $query->groupBy($table . '.' . $group_by_col);
        }


        $result = $query->get()->getResult();

        // Get the last executed query
        //echo $this->db->getLastQuery();

        //return $result;

        $i = 0;
        foreach ($result as $res) {
            $cond_user = ['mrp_mr_id' => $res->mrp_mr_id];
        
            // Create the query using the Query Builder
            $query = $this->db->table($table)->where($cond_user); 
        
            // Echo the compiled select query without executing it

            $result[$i]->product_orders = $this->FetchWhereJoin($table, $cond_user, $joins1);

            // echo $this->db->getLastQuery();  // Will show the query without executing it
            // exit;

            $i++;
        }
        
        
        return $result;
    }


    public function MaterialRecCheckData($from_date, $from_date_col, $to_date, $to_date_col, $data1, $data1_col, $data2, $data2_col, $data3, $data3_col, $data4, $data4_col, $table, $joins, $group_by_col, $joins1)
    {
        $query = $this->db->table($table)
            ->select('*');
        // Join additional tables if specified
        if (!empty($joins)) {
            foreach ($joins as $join) {
                $query->join($join['table'], $join['table'] . '.' . $join['pk'] . ' = ' . $table . '.' . $join['fk'], 'left');
            }
        }

        if (!empty($from_date)) {

            $query->where($from_date_col . ' >=', $from_date);
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

        if (!empty($join)) {
            $query->groupBy($table . '.' . $group_by_col);
        }


        $result = $query->get()->getResult();

        // Get the last executed query
        //echo $this->db->getLastQuery();

        //return $result;

        $i = 0;
        foreach ($result as $res) {
            $cond_user = ['rnp_material_received_note' => $res->rnp_material_received_note];
        
            // Create the query using the Query Builder
            $query = $this->db->table($table)->where($cond_user); 
        
            // Echo the compiled select query without executing it

            $result[$i]->product_orders = $this->FetchWhereJoin($table, $cond_user, $joins1);

            // echo $this->db->getLastQuery();  // Will show the query without executing it
            // exit;

            $i++;
        }
        
        
        return $result;
    }

    
    public function VoucherCheckData($from_date, $from_date_col, $to_date, $to_date_col, $data1, $data1_col, $data2, $data2_col, $data3, $data3_col, $data4, $data4_col, $data5, $data5_col, $table, $joins, $group_by_col, $joins1)
    {
        $query = $this->db->table($table)
            ->select('*');
        // Join additional tables if specified
        if (!empty($joins)) {
            foreach ($joins as $join) {
                $query->join($join['table'], $join['table'] . '.' . $join['pk'] . ' = ' . $table . '.' . $join['fk'], 'left');
            }
        }

        if (!empty($from_date)) {

            $query->where($from_date_col . ' >=', $from_date);
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

        if (!empty($data5)) {
            $query->like($data5_col, $data5);
        }

        if (!empty($join)) {
            $query->groupBy($table . '.' . $group_by_col);
        }


        $result = $query->get()->getResult();

        // Get the last executed query
        //echo $this->db->getLastQuery();

        //return $result;

        $i = 0;
        foreach ($result as $res) {
            $cond_user = ['pvp_reffer_id' => $res->pvp_reffer_id];
        
            // Create the query using the Query Builder
            $query = $this->db->table($table)->where($cond_user); 
        
            // Echo the compiled select query without executing it

            $result[$i]->product_orders = $this->FetchWhereJoin($table, $cond_user, $joins1);

            // echo $this->db->getLastQuery();  // Will show the query without executing it
            // exit;

            $i++;
        }
        
        
        return $result;
    }

        
    public function ReturnCheckData($from_date, $from_date_col, $to_date, $to_date_col, $data1, $data1_col, $data2, $data2_col, $data3, $data3_col, $data4, $data4_col, $table, $joins, $group_by_col, $joins1)
    {
        $query = $this->db->table($table)
            ->select('*');
        // Join additional tables if specified
        if (!empty($joins)) {
            foreach ($joins as $join) {
                $query->join($join['table'], $join['table'] . '.' . $join['pk'] . ' = ' . $table . '.' . $join['fk'], 'left');
            }
        }

        if (!empty($from_date)) {

            $query->where($from_date_col . ' >=', $from_date);
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

        if (!empty($join)) {
            $query->groupBy($table . '.' . $group_by_col);
        }


        $result = $query->get()->getResult();

        // Get the last executed query
        //echo $this->db->getLastQuery();

        //return $result;

        $i = 0;
        foreach ($result as $res) {
            $cond_user = ['prp_purchase_return_id' => $res->prp_purchase_return_id];
        
            // Create the query using the Query Builder
            $query = $this->db->table($table)->where($cond_user); 
        
            // Echo the compiled select query without executing it

            $result[$i]->product_orders = $this->FetchWhereJoin($table, $cond_user, $joins1);

            // echo $this->db->getLastQuery();  // Will show the query without executing it
            // exit;

            $i++;
        }
        
        
        return $result;
    }



    public function LPO_MRNCheckData($from_date, $from_date_col, $to_date, $to_date_col, $data1, $data1_col, $data2, $data2_col, $data3, $data3_col, $data4, $data4_col, $table, $joins, $group_by_col, $joins1)
    {
        $query = $this->db->table($table)
            ->select('*');
        // Join additional tables if specified
        if (!empty($joins)) {
            foreach ($joins as $join) {
                $query->join($join['table'], $join['table'] . '.' . $join['pk'] . ' = ' . $table . '.' . $join['fk'], 'left');
            }
        }

        if (!empty($from_date)) {

            $query->where($from_date_col . ' >=', $from_date);
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

        if (!empty($join)) {
            $query->groupBy($table . '.' . $group_by_col);
        }

        //$query->groupBy('crm_sales_orders.so_id');

        $result = $query->get()->getResult();

        // Get the last executed query
        //echo $this->db->getLastQuery();

        //return $result;

        // $i = 0;
        // foreach ($result as $res) {
        //     $cond_user = ['pop_purchase_order' => $res->pop_purchase_order];
        
        //     // Create the query using the Query Builder
        //     $query = $this->db->table($table)
        //     ->where($cond_user)
        //     ->groupBy('pop_id') // This should work as expected
        //     ->get();

        
        //     // Echo the compiled select query without executing it

        //     $result[$i]->product_orders = $this->FetchWhereJoin($table, $cond_user, $joins1);

        //     // echo $this->db->getLastQuery();  // Will show the query without executing it
        //     // exit;

        //     $i++;
        // }
        
        
        return $result;
    }



    public function MRN_PVCheckData($from_date, $from_date_col, $to_date, $to_date_col, $data1, $data1_col, $data2, $data2_col, $data3, $data3_col, $data4, $data4_col, $table, $joins, $group_by_col, $joins1)
    {
        $query = $this->db->table($table)
            ->select('*');
        // Join additional tables if specified
        if (!empty($joins)) {
            foreach ($joins as $join) {
                $query->join($join['table'], $join['table'] . '.' . $join['pk'] . ' = ' . $table . '.' . $join['fk'], 'left');
            }
        }

        if (!empty($from_date)) {

            $query->where($from_date_col . ' >=', $from_date);
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

        if (!empty($join)) {
            $query->groupBy($table . '.' . $group_by_col);
        }


        $result = $query->get()->getResult();

        // Get the last executed query
        //echo $this->db->getLastQuery();

        //return $result;

        $i = 0;
        foreach ($result as $res) {
            $cond_user = ['rnp_material_received_note' => $res->rnp_material_received_note];
        
            // Create the query using the Query Builder
            $query = $this->db->table($table)->where($cond_user); 
        
            // Echo the compiled select query without executing it

            $result[$i]->product_orders = $this->FetchWhereJoin($table, $cond_user, $joins1);

            // echo $this->db->getLastQuery();  // Will show the query without executing it
            // exit;

            $i++;
        }
        
        
        return $result;
    }


    
    public function LPO_PVCheckData($from_date, $from_date_col, $to_date, $to_date_col, $data1, $data1_col, $data2, $data2_col, $data3, $data3_col, $data4, $data4_col, $table, $joins, $group_by_col, $joins1)
    {
        $query = $this->db->table($table)
            ->select('*');
        // Join additional tables if specified
        if (!empty($joins)) {
            foreach ($joins as $join) {
                $query->join($join['table'], $join['table'] . '.' . $join['pk'] . ' = ' . $table . '.' . $join['fk'], 'left');
            }
        }

        if (!empty($from_date)) {

            $query->where($from_date_col . ' >=', $from_date);
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

        if (!empty($join)) {
            $query->groupBy($table . '.' . $group_by_col);
        }


        $result = $query->get()->getResult();

        // Get the last executed query
        //echo $this->db->getLastQuery();

        //return $result;

        $i = 0;
        foreach ($result as $res) {
            $cond_user = ['pop_purchase_order' => $res->pop_purchase_order];
        
            // Create the query using the Query Builder
            $query = $this->db->table($table)->where($cond_user); 
        
            // Echo the compiled select query without executing it

            $result[$i]->product_orders = $this->FetchWhereJoin($table, $cond_user, $joins1);

            // echo $this->db->getLastQuery();  // Will show the query without executing it
            // exit;

            $i++;
        }
        
        
        return $result;
    }


    public function PendingVoucherCheckData($from_date, $from_date_col, $to_date, $to_date_col, $data1, $data1_col, $data2, $data2_col, $data3, $data3_col, $data4, $data4_col,  $table, $joins, $group_by_col, $joins1)
    {
        $query = $this->db->table($table)
            ->select('*');
        // Join additional tables if specified
        if (!empty($joins)) {
            foreach ($joins as $join) {
                $query->join($join['table'], $join['table'] . '.' . $join['pk'] . ' = ' . $table . '.' . $join['fk'], 'left');
            }
        }

        if (!empty($from_date)) {

            $query->where($from_date_col . ' >=', $from_date);
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
            $query->where($data3_col, $data3);
        }

        if (!empty($data4)) {
            $query->like($data4_col, $data4);
        }

        // if (!empty($data5)) {
        //     $query->like($data5_col, $data5);
        // }


        if (!empty($join) && $group_by_col != '') {
            $query->groupBy($table . '.' . $group_by_col);
        }

        // $query->whereIn('pv_status', [0,1]);

        $result = $query->get()->getResult();

        // Get the last executed query
        //echo $this->db->getLastQuery();

        //return $result;

        // $i = 0;
        // foreach ($result as $res) {
        //     $cond_user = ['pvp_reffer_id' => $res->pvp_reffer_id];
        
        //     // Create the query using the Query Builder
        //     $query = $this->db->table($table)->where($cond_user); 
        
        //     // Echo the compiled select query without executing it

        //     $result[$i]->product_orders = $this->FetchWhereJoin($table, $cond_user, $joins1);

        //     // echo $this->db->getLastQuery();  // Will show the query without executing it
        //     // exit;

        //     $i++;
        // }
        
        
        return $result;
    }


        //Fetch All By Order

        public function FetchWhereOrder($table,$cond,$order_key,$order)
        {
    
            return $this->db
            ->table($table)
            ->where($cond)
            ->select('*')
            ->orderBy($order_key, $order)
            ->get()
            ->getResult();
        }



}
