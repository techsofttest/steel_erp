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

    public function FetchAllOrderJoin($table, $order_key, $order, $joins, $group_by_col)
    {

        $query = $this->db
            ->table($table)
            ->select('*')
            ->orderBy($order_key, $order);
        if (!empty($joins))
            foreach ($joins as $join) {
                $query->join($join['table'], '' . $join['table'] . '.' . $join['pk'] . ' = ' . $table . '.' . $join['fk'] . '', 'left');
            }

        $query->groupBy($table . '.' . $group_by_col);

        $result = $query->get()->getResult();

        return $result;

        //->get()
        //->getResult();
    }

    //purchase voucher own query
    public function PurchaseVoucher($table, $joins, $vendorId)
    {

        $query = $this->db
            ->table($table)
            ->select('*')
            ->where('mrn_status', 0)
            ->where('mrn_vendor_name', $vendorId);
        if (!empty($joins))
            foreach ($joins as $join) {
                $query->join($join['table'], '' . $join['table'] . '.' . $join['pk'] . ' = ' . $table . '.' . $join['fk'] . '', 'left');
            }


        $query->groupBy('pro_material_received_note' . '.' . 'mrn_purchase_order');

        $result = $query->get()->getResult();


        // echo $this->db->getLastQuery(); exit();



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
    public function FetchWhereJoin($table, $cond, $joins)
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

    public function PendingVoucherCheckData($from_date, $from_date_col, $to_date, $to_date_col, $data1, $data1_col, $data2, $data2_col, $data3, $data3_col, $data4, $data4_col, $table, $joins, $group_by_col, $joins1)
    {
        $query = $this->db->table($table)->select('*');

        // Join additional tables if specified
        if (!empty($joins)) {
            foreach ($joins as $join) {
                if (isset($join['table'], $join['pk'], $join['fk'])) {
                    $query->join($join['table'], $join['table'] . '.' . $join['pk'] . ' = ' . $table . '.' . $join['fk'], 'left');
                }
            }
        }

        // Check if `pv_status` column exists in `pro_purchase_voucher` table
        $fields = $this->db->getFieldData('pro_purchase_voucher');
        $hasPvStatus = array_search('pv_status', array_column($fields, 'name')) !== false;

        // Filter for `pv_status` values 0, 1 or NULL if the column exists
        if ($hasPvStatus) {
            $query->groupStart()
                ->whereIn('pro_purchase_voucher.pv_status', ['0', '1'])
                ->orWhere('pro_purchase_voucher.pv_status', null)  // Include records where pv_status is NULL
                ->groupEnd();
        }

        // Apply date filters
        if (!empty($from_date)) {
            $query->where($from_date_col . ' >=', $from_date);
        }

        if (!empty($to_date)) {
            $query->where($to_date_col . ' <=', $to_date);
        }

        // Apply additional filters
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

        // Group by clause
        if (!empty($group_by_col)) {
            $query->groupBy($table . '.' . $group_by_col);
        }

        $result = $query->get()->getResult();

        // Loop through results to fetch related data if necessary
        // foreach ($result as $index => $res) {
        //     $cond_user = ['pvp_reffer_id' => $res->pvp_reffer_id];
        //     $result[$index]->product_orders = $this->FetchWhereJoin($table, $cond_user, $joins1);
        // }

        return $result;
    }




    //Fetch All By Order

    public function FetchWhereOrder($table, $cond, $order_key, $order)
    {

        return $this->db
            ->table($table)
            ->where($cond)
            ->select('*')
            ->orderBy($order_key, $order)
            ->get()
            ->getResult();
    }

    public function CreditBalance($id, $date_from = '', $date_to = '')
    {        
        // Fetch the transactions using the provided parameters
        $transactions = $this->FetchGLTransactions(
            $date_from,
            $date_to,
            $account_head = "",
            $account_type = "",
            $account = $id,
            $time_frame = "",
            $range_from = "",
            $range_to = ""
        );
    
        // Initialize beginning balance
        $begining_balance = 0;
    
        // Calculate totals
        $total_credit = array_sum(array_column($transactions, 'credit_amount'));
        $total_debit = array_sum(array_column($transactions, 'debit_amount'));
        $net_change = $total_debit - $total_credit;
    
        // Calculate ending balance
        $ending_balance = $begining_balance + $net_change;
    
        // Prepare result as an object (using stdClass)
        $result = new \stdClass();
        $result->transactions = $transactions;
        $result->begining_balance = $begining_balance;
        $result->total_credit = $total_credit;
        $result->total_debit = $total_debit;
        $result->net_change = $net_change;
        $result->ending_balance = $ending_balance;
    
        // Return the result object
        return $result;
    }
    


    public function FetchGLTransactions($date_from, $date_to, $account_head, $account_type, $account, $time_frame, $range_from, $range_to)
    {
        
        $receipt_table = "{$this->db->getPrefix()}accounts_receipts";
        $payment_table = "{$this->db->getPrefix()}accounts_payments";
        $cash_invoice_table = "{$this->db->getPrefix()}crm_cash_invoice";
        $credit_invoice_table = "{$this->db->getPrefix()}crm_credit_invoice";
        $journal_table = "{$this->db->getPrefix()}accounts_journal_invoices";
        $pcv_table = "{$this->db->getPrefix()}accounts_petty_cash_voucher";
        $sr_table = "{$this->db->getPrefix()}crm_sales_return";
        $pv_table = "{$this->db->getPrefix()}pro_purchase_voucher";


        $query = "";


        $query .= "
                (SELECT
                    {$payment_table}.pay_id AS id,
                    {$payment_table}.pay_ref_no AS reference,
                    {$this->db->getPrefix()}accounts_account_heads.ah_head_id as head_id,
                    {$payment_table}.pay_date AS transaction_date,
                    {$payment_table}.pay_amount AS credit_amount,
                    NULL AS debit_amount,
                    'Payment' as voucher_type,
                    {$this->db->getPrefix()}accounts_charts_of_accounts.ca_id AS account_id,
                    {$this->db->getPrefix()}accounts_charts_of_accounts.ca_name AS account_name
                FROM {$this->db->getPrefix()}accounts_payments
                LEFT JOIN {$this->db->getPrefix()}accounts_payment_debit ON {$this->db->getPrefix()}accounts_payment_debit.pd_payment = {$payment_table}.pay_id
                LEFT JOIN {$this->db->getPrefix()}accounts_payment_debit_invoices ON {$this->db->getPrefix()}accounts_payment_debit_invoices.pdi_debit_id = {$this->db->getPrefix()}accounts_payment_debit.pd_id
                LEFT JOIN {$this->db->getPrefix()}accounts_charts_of_accounts ON {$this->db->getPrefix()}accounts_charts_of_accounts.ca_id = {$this->db->getPrefix()}accounts_payment_debit.pd_debit_account
                LEFT JOIN {$this->db->getPrefix()}accounts_charts_of_accounts AS credit_account_receipt ON credit_account_receipt.ca_id = {$this->db->getPrefix()}accounts_payments.pay_credit_account
                LEFT JOIN {$this->db->getPrefix()}crm_customer_creation ON {$this->db->getPrefix()}crm_customer_creation.cc_id = {$this->db->getPrefix()}accounts_charts_of_accounts.ca_customer
                LEFT JOIN {$this->db->getPrefix()}accounts_account_heads ON {$this->db->getPrefix()}accounts_account_heads.ah_id = {$this->db->getPrefix()}accounts_charts_of_accounts.ca_account_type
                LEFT JOIN {$this->db->getPrefix()}accounts_account_types ON {$this->db->getPrefix()}accounts_account_types.at_id = {$this->db->getPrefix()}accounts_account_heads.ah_id
                 ";


        if (!empty($time_frame) || $account_type != "" ||  !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to)) {

            $query .= "WHERE ";
        }

        if ($time_frame != "") {
            if ($time_frame == "Range") {
                if ($date_from != "") {
                    $query .= "{$payment_table}.pay_date >= '{$date_from}' ";
                }

                if ($date_to != "") {
                    if ($date_from != "") {
                        $query .= "AND ";
                    }
                    $query .= "{$payment_table}.pay_date <= '{$date_to}' ";
                }
            } elseif ($time_frame == "Month") {
                $query .= "YEAR({$payment_table}.pay_date) = YEAR(CURRENT_DATE()) AND MONTH({$payment_table}.pay_date) = MONTH(CURRENT_DATE()) ";
            } elseif ($time_frame == "Year") {
                $query .= "YEAR({$payment_table}.pay_date) = YEAR(CURRENT_DATE()) ";
            }
        }

        if ($account_head != "") {
            if ($time_frame != "" || $date_from != "" || $date_to != "") {
                $query .= "AND ";
            }
            $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_id = {$account_head} ";
        }

        if ($account_type != "") {
            if ($account_head != "" || $time_frame != "") {
                $query .= "AND ";
            }
            $query .= "{$this->db->getPrefix()}accounts_account_types.at_id = {$account_type} ";
        }


        if ($account != "") {
            if ($account_head != "" || $account_type != "" || $time_frame != "" || $date_from != "" || $date_to != "") {
                $query .= "AND ";
            }
            $query .= "{$payment_table}.pay_credit_account = {$account} ";
        }

        if ($range_from != "") {

            if ($account_head != "" || $account_type != "" || $time_frame != "") {
                $query .= "AND ";
            }

            $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_head_id >= {$range_from} ";
        }

        if ($range_to != "") {

            if ($account_head != "" || $account_type != "" || $time_frame != "" || $range_from != "") {
                $query .= "AND ";
            }

            $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_head_id <= {$range_to} ";
        }

        $query .= "GROUP BY {$this->db->getPrefix()}accounts_payment_debit.pd_id";

        $query .= ")";


        //Payment Debit

        $query .= "UNION ALL
                (SELECT 
                    {$payment_table}.pay_id AS id,
                    {$payment_table}.pay_ref_no AS reference,
                    {$this->db->getPrefix()}accounts_account_heads.ah_head_id as head_id,
                    {$payment_table}.pay_date AS transaction_date,
                    NULL AS credit_amount,
                    {$payment_table}.pay_amount AS debit_amount,
                    'Payment' as voucher_type,
                    {$this->db->getPrefix()}accounts_charts_of_accounts.ca_id AS account_id,
                    {$this->db->getPrefix()}accounts_charts_of_accounts.ca_name AS account_name
                FROM {$this->db->getPrefix()}accounts_payments 
                LEFT JOIN {$this->db->getPrefix()}accounts_payment_debit ON {$this->db->getPrefix()}accounts_payment_debit.pd_payment = {$payment_table}.pay_id
                LEFT JOIN {$this->db->getPrefix()}accounts_payment_debit_invoices ON {$this->db->getPrefix()}accounts_payment_debit_invoices.pdi_debit_id = {$this->db->getPrefix()}accounts_payment_debit.pd_id
                LEFT JOIN {$this->db->getPrefix()}accounts_charts_of_accounts ON {$this->db->getPrefix()}accounts_charts_of_accounts.ca_id = {$this->db->getPrefix()}accounts_payments.pay_credit_account
                LEFT JOIN {$this->db->getPrefix()}accounts_charts_of_accounts AS credit_account_receipt ON credit_account_receipt.ca_id = {$this->db->getPrefix()}accounts_payment_debit.pd_debit_account
                LEFT JOIN {$this->db->getPrefix()}crm_customer_creation ON {$this->db->getPrefix()}crm_customer_creation.cc_id = {$this->db->getPrefix()}accounts_charts_of_accounts.ca_customer
                LEFT JOIN {$this->db->getPrefix()}accounts_account_heads ON {$this->db->getPrefix()}accounts_account_heads.ah_id = {$this->db->getPrefix()}accounts_charts_of_accounts.ca_account_type
                LEFT JOIN {$this->db->getPrefix()}accounts_account_types ON {$this->db->getPrefix()}accounts_account_types.at_id = {$this->db->getPrefix()}accounts_account_heads.ah_id
                ";




        if (!empty($time_frame) || $account_type != "" ||  !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to)) {

            $query .= "WHERE ";
        }

        if ($time_frame != "") {
            if ($time_frame == "Range") {
                if ($date_from != "") {
                    $query .= "{$payment_table}.pay_date >= '{$date_from}' ";
                }

                if ($date_to != "") {
                    if ($date_from != "") {
                        $query .= "AND ";
                    }
                    $query .= "{$payment_table}.pay_date <= '{$date_to}' ";
                }
            } elseif ($time_frame == "Month") {
                $query .= "YEAR({$payment_table}.pay_date) = YEAR(CURRENT_DATE()) AND MONTH({$payment_table}.pay_date) = MONTH(CURRENT_DATE()) ";
            } elseif ($time_frame == "Year") {
                $query .= "YEAR({$payment_table}.pay_date) = YEAR(CURRENT_DATE()) ";
            }
        }

        if ($account_head != "") {
            if ($time_frame != "" || $date_from != "" || $date_to != "") {
                $query .= "AND ";
            }
            $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_id = {$account_head} ";
        }

        if ($account_type != "") {
            if ($account_head != "" || $time_frame != "") {
                $query .= "AND ";
            }
            $query .= "{$this->db->getPrefix()}accounts_account_types.at_id = {$account_type} ";
        }


        if ($account != "") {
            if ($account_head != "" || $account_type != "" || $time_frame != "" || $date_from != "" || $date_to != "") {
                $query .= "AND ";
            }

            //$query .= "{$payment_table}.pay_credit_account = {$account} ";

            $query .= "credit_account_receipt.ca_id = {$account} ";
        }

        if ($range_from != "") {

            if ($account_head != "" || $account_type != "" || $time_frame != "") {
                $query .= "AND ";
            }

            $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_head_id >= {$range_from} ";
        }

        if ($range_to != "") {

            if ($account_head != "" || $account_type != "" || $time_frame != "" || $range_from != "") {
                $query .= "AND ";
            }

            $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_head_id <= {$range_to} ";
        }

        $query .= "GROUP BY {$this->db->getPrefix()}accounts_payments.pay_id";

        $query .= ")";



        //


        //Cash Invoice Select Start

        $query .= "UNION ALL 
        (SELECT 
            {$cash_invoice_table}.ci_id  AS id,
            {$cash_invoice_table}.ci_reffer_no AS reference,
            {$this->db->getPrefix()}accounts_account_heads.ah_head_id as head_id,
            {$cash_invoice_table}.ci_date AS transaction_date,
            NULL AS credit_amount,
            {$cash_invoice_table}.ci_total_amount AS debit_amount,
            'Cash Invoice' as voucher_type,
            {$this->db->getPrefix()}accounts_charts_of_accounts.ca_id AS account_id,
            {$this->db->getPrefix()}accounts_charts_of_accounts.ca_name AS account_name
        FROM {$this->db->getPrefix()}crm_cash_invoice
        LEFT JOIN {$this->db->getPrefix()}accounts_charts_of_accounts ON {$this->db->getPrefix()}accounts_charts_of_accounts.ca_id = {$cash_invoice_table}.ci_credit_account
        LEFT JOIN {$this->db->getPrefix()}accounts_account_heads ON {$this->db->getPrefix()}accounts_account_heads.ah_id = {$this->db->getPrefix()}accounts_charts_of_accounts.ca_account_type
        LEFT JOIN {$this->db->getPrefix()}accounts_account_types ON {$this->db->getPrefix()}accounts_account_types.at_id = {$this->db->getPrefix()}accounts_account_heads.ah_id
        LEFT JOIN {$this->db->getPrefix()}accounts_charts_of_accounts AS ca_credit_account ON ca_credit_account.ca_customer = {$cash_invoice_table}.ci_customer
         ";


        if (!empty($time_frame) || $account_type != "" ||  !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to)) {

            $query .= "WHERE ";
        }

        if ($time_frame != "") {
            if ($time_frame == "Range") {
                if ($date_from != "") {
                    $query .= "{$cash_invoice_table}.ci_date >= '{$date_from}' ";
                }

                if ($date_to != "") {
                    if ($date_from != "") {
                        $query .= "AND ";
                    }
                    $query .= "{$cash_invoice_table}.ci_date <= '{$date_to}' ";
                }
            } elseif ($time_frame == "Month") {
                $query .= "YEAR({$cash_invoice_table}.ci_date) = YEAR(CURRENT_DATE()) AND MONTH({$cash_invoice_table}.ci_date) = MONTH(CURRENT_DATE()) ";
            } elseif ($time_frame == "Year") {
                $query .= "YEAR({$cash_invoice_table}.ci_date) = YEAR(CURRENT_DATE())";
            }
        }

        if ($account_head != "") {
            if ($time_frame != "" || $date_from != "" || $date_to != "") {
                $query .= "AND ";
            }
            $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_id = {$account_head} ";
        }

        if ($account_type != "") {
            if ($account_head != "" || $time_frame != "") {
                $query .= "AND ";
            }
            $query .= "{$this->db->getPrefix()}accounts_account_types.at_id = {$account_type} ";
        }


        if ($account != "") {
            if ($account_head != "" || $account_type != "" || $time_frame != "" || $date_from != "" || $date_to != "") {
                $query .= "AND ";
            }
            //$query .= "{$cash_invoice_table}.ci_credit_account = {$account} ";

            //$query .= "{$this->db->getPrefix()}accounts_charts_of_accounts.ca_id = {$account} ";

            $query .= "ca_credit_account.ca_id = {$account} ";
        }

        if ($range_from != "") {

            if ($account_head != "" || $account_type != "" || $time_frame != "") {
                $query .= "AND ";
            }

            $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_head_id >= {$range_from} ";
        }

        if ($range_to != "") {

            if ($account_head != "" || $account_type != "" || $time_frame != "" || $range_from != "") {
                $query .= "AND ";
            }

            $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_head_id <= {$range_to} ";
        }


        $query .= ")";




        //Cash Invoice Credit Account Select

        $query .= "UNION ALL 
        (SELECT 
            {$cash_invoice_table}.ci_id  AS id,
            {$cash_invoice_table}.ci_reffer_no AS reference,
            {$this->db->getPrefix()}accounts_account_heads.ah_head_id as head_id,
            {$cash_invoice_table}.ci_date AS transaction_date,
            {$cash_invoice_table}.ci_total_amount AS credit_amount,
            NULL AS debit_amount,
            'Cash Invoice' as voucher_type,
            {$this->db->getPrefix()}accounts_charts_of_accounts.ca_id AS account_id,
            {$this->db->getPrefix()}accounts_charts_of_accounts.ca_name AS account_name
        FROM {$this->db->getPrefix()}crm_cash_invoice
        LEFT JOIN {$this->db->getPrefix()}accounts_charts_of_accounts ON {$this->db->getPrefix()}accounts_charts_of_accounts.ca_customer = {$cash_invoice_table}.ci_customer    
        LEFT JOIN {$this->db->getPrefix()}accounts_account_heads ON {$this->db->getPrefix()}accounts_account_heads.ah_id = {$this->db->getPrefix()}accounts_charts_of_accounts.ca_account_type
        LEFT JOIN {$this->db->getPrefix()}accounts_account_types ON {$this->db->getPrefix()}accounts_account_types.at_id = {$this->db->getPrefix()}accounts_account_heads.ah_id
        LEFT JOIN {$this->db->getPrefix()}accounts_charts_of_accounts AS ca_credit_account ON ca_credit_account.ca_customer = {$cash_invoice_table}.ci_customer
         ";


        if (!empty($time_frame) || $account_type != "" ||  !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to)) {

            $query .= "WHERE ";
        }

        if ($time_frame != "") {
            if ($time_frame == "Range") {
                if ($date_from != "") {
                    $query .= "{$cash_invoice_table}.ci_date >= '{$date_from}' ";
                }

                if ($date_to != "") {
                    if ($date_from != "") {
                        $query .= "AND ";
                    }
                    $query .= "{$cash_invoice_table}.ci_date <= '{$date_to}' ";
                }
            } elseif ($time_frame == "Month") {
                $query .= "YEAR({$cash_invoice_table}.ci_date) = YEAR(CURRENT_DATE()) AND MONTH({$cash_invoice_table}.ci_date) = MONTH(CURRENT_DATE()) ";
            } elseif ($time_frame == "Year") {
                $query .= "YEAR({$cash_invoice_table}.ci_date) = YEAR(CURRENT_DATE())";
            }
        }

        if ($account_head != "") {
            if ($time_frame != "" || $date_from != "" || $date_to != "") {
                $query .= "AND ";
            }
            $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_id = {$account_head} ";
        }

        if ($account_type != "") {
            if ($account_head != "" || $time_frame != "") {
                $query .= "AND ";
            }
            $query .= "{$this->db->getPrefix()}accounts_account_types.at_id = {$account_type} ";
        }


        if ($account != "") {
            if ($account_head != "" || $account_type != "" || $time_frame != "" || $date_from != "" || $date_to != "") {
                $query .= "AND ";
            }

            $query .= "{$cash_invoice_table}.ci_credit_account = {$account} ";
        }

        if ($range_from != "") {

            if ($account_head != "" || $account_type != "" || $time_frame != "") {
                $query .= "AND ";
            }

            $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_head_id >= {$range_from} ";
        }

        if ($range_to != "") {

            if ($account_head != "" || $account_type != "" || $time_frame != "" || $range_from != "") {
                $query .= "AND ";
            }

            $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_head_id <= {$range_to} ";
        }


        $query .= ")";





        //Cash Invoice Select End




        //Credit Invoice Select Start

        $query .= "UNION ALL 
    (SELECT 
        {$credit_invoice_table}.cci_id   AS id,
        {$credit_invoice_table}.cci_reffer_no AS reference,
        {$this->db->getPrefix()}accounts_account_heads.ah_head_id as head_id,
        {$credit_invoice_table}.cci_date AS transaction_date,
        NULL AS credit_amount,
        {$credit_invoice_table}.cci_total_amount AS debit_amount,
        'Credit Invoice' as voucher_type,
        {$this->db->getPrefix()}accounts_charts_of_accounts.ca_id AS account_id,
        {$this->db->getPrefix()}accounts_charts_of_accounts.ca_name AS account_name
    FROM {$this->db->getPrefix()}crm_credit_invoice
    LEFT JOIN {$this->db->getPrefix()}accounts_charts_of_accounts ON {$this->db->getPrefix()}accounts_charts_of_accounts.ca_id = {$credit_invoice_table}.cci_credit_account
    LEFT JOIN {$this->db->getPrefix()}accounts_account_heads ON {$this->db->getPrefix()}accounts_account_heads.ah_id = {$this->db->getPrefix()}accounts_charts_of_accounts.ca_account_type
    LEFT JOIN {$this->db->getPrefix()}accounts_account_types ON {$this->db->getPrefix()}accounts_account_types.at_id = {$this->db->getPrefix()}accounts_account_heads.ah_id
    LEFT JOIN {$this->db->getPrefix()}accounts_charts_of_accounts AS ca_credit_account ON ca_credit_account.ca_customer = {$credit_invoice_table}.cci_customer
     ";


        if (!empty($time_frame) || $account_type != "" ||  !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to)) {

            $query .= "WHERE ";
        }

        if ($time_frame != "") {
            if ($time_frame == "Range") {
                if ($date_from != "") {
                    $query .= "{$credit_invoice_table}.cci_date >= '{$date_from}' ";
                }

                if ($date_to != "") {
                    if ($date_from != "") {
                        $query .= "AND ";
                    }
                    $query .= "{$credit_invoice_table}.cci_date <= '{$date_to}' ";
                }
            } elseif ($time_frame == "Month") {
                $query .= "YEAR({$credit_invoice_table}.cci_date) = YEAR(CURRENT_DATE()) AND MONTH({$credit_invoice_table}.cci_date) = MONTH(CURRENT_DATE()) ";
            } elseif ($time_frame == "Year") {
                $query .= "YEAR({$credit_invoice_table}.cci_date) = YEAR(CURRENT_DATE())";
            }
        }

        if ($account_head != "") {
            if ($time_frame != "" || $date_from != "" || $date_to != "") {
                $query .= "AND ";
            }
            $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_id = {$account_head} ";
        }


        if ($account_type != "") {
            if ($account_head != "" || $time_frame != "") {
                $query .= "AND ";
            }
            $query .= "{$this->db->getPrefix()}accounts_account_types.at_id = {$account_type} ";
        }



        if ($account != "") {
            if ($account_head != "" || $account_type != "" || $time_frame != "" || $date_from != "" || $date_to != "") {
                $query .= "AND ";
            }

            //$query .= "{$credit_invoice_table}.cci_credit_account = {$account} ";
            //$query .= "{$this->db->getPrefix()}accounts_charts_of_accounts.ca_id = {$account} ";
            $query .= "ca_credit_account.ca_id = {$account} ";
        }

        if ($range_from != "") {

            if ($account_head != "" || $account_type != "" || $time_frame != "") {
                $query .= "AND ";
            }

            $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_head_id >= {$range_from} ";
        }

        if ($range_to != "") {

            if ($account_head != "" || $account_type != "" || $time_frame != "" || $range_from != "") {
                $query .= "AND ";
            }

            $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_head_id <= {$range_to} ";
        }


        $query .= ")";



        //Credit Invoice Credit Account Fetch


        $query .= "UNION ALL 
    (SELECT 
        {$credit_invoice_table}.cci_id   AS id,
        {$credit_invoice_table}.cci_reffer_no AS reference,
        {$this->db->getPrefix()}accounts_account_heads.ah_head_id as head_id,
        {$credit_invoice_table}.cci_date AS transaction_date,
        {$credit_invoice_table}.cci_total_amount AS credit_amount,
        NULL AS debit_amount,
        'Credit Invoice' as voucher_type,
        {$this->db->getPrefix()}accounts_charts_of_accounts.ca_id AS account_id,
        {$this->db->getPrefix()}accounts_charts_of_accounts.ca_name AS account_name
    FROM {$this->db->getPrefix()}crm_credit_invoice
    LEFT JOIN {$this->db->getPrefix()}accounts_charts_of_accounts ON {$this->db->getPrefix()}accounts_charts_of_accounts.ca_customer = {$credit_invoice_table}.cci_customer
    LEFT JOIN {$this->db->getPrefix()}accounts_account_heads ON {$this->db->getPrefix()}accounts_account_heads.ah_id = {$this->db->getPrefix()}accounts_charts_of_accounts.ca_account_type
    LEFT JOIN {$this->db->getPrefix()}accounts_account_types ON {$this->db->getPrefix()}accounts_account_types.at_id = {$this->db->getPrefix()}accounts_account_heads.ah_id
    LEFT JOIN {$this->db->getPrefix()}accounts_charts_of_accounts AS ca_credit_account ON ca_credit_account.ca_customer = {$credit_invoice_table}.cci_customer
     ";


        if (!empty($time_frame) || $account_type != "" ||  !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to)) {

            $query .= "WHERE ";
        }

        if ($time_frame != "") {
            if ($time_frame == "Range") {
                if ($date_from != "") {
                    $query .= "{$credit_invoice_table}.cci_date >= '{$date_from}' ";
                }

                if ($date_to != "") {
                    if ($date_from != "") {
                        $query .= "AND ";
                    }
                    $query .= "{$credit_invoice_table}.cci_date <= '{$date_to}' ";
                }
            } elseif ($time_frame == "Month") {
                $query .= "YEAR({$credit_invoice_table}.cci_date) = YEAR(CURRENT_DATE()) AND MONTH({$credit_invoice_table}.cci_date) = MONTH(CURRENT_DATE()) ";
            } elseif ($time_frame == "Year") {
                $query .= "YEAR({$credit_invoice_table}.cci_date) = YEAR(CURRENT_DATE())";
            }
        }

        if ($account_head != "") {
            if ($time_frame != "" || $date_from != "" || $date_to != "") {
                $query .= "AND ";
            }
            $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_id = {$account_head} ";
        }

        if ($account_type != "") {
            if ($account_head != "" || $time_frame != "") {
                $query .= "AND ";
            }
            $query .= "{$this->db->getPrefix()}accounts_account_types.at_id = {$account_type} ";
        }


        if ($account != "") {
            if ($account_head != "" || $account_type != "" || $time_frame != "" || $date_from != "" || $date_to != "") {
                $query .= "AND ";
            }

            $query .= "{$credit_invoice_table}.cci_credit_account = {$account} ";
        }

        if ($range_from != "") {

            if ($account_head != "" || $account_type != "" || $time_frame != "") {
                $query .= "AND ";
            }

            $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_head_id >= {$range_from} ";
        }

        if ($range_to != "") {

            if ($account_head != "" || $account_type != "" || $time_frame != "" || $range_from != "") {
                $query .= "AND ";
            }

            $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_head_id <= {$range_to} ";
        }


        $query .= ")";






        //Credit Invoice Select End




        //Journal Start



        $query .= "UNION ALL 
    (SELECT 
        {$journal_table}.ji_id AS id,
        {$this->db->getPrefix()}accounts_journal_vouchers.jv_voucher_no AS reference,
        {$this->db->getPrefix()}accounts_account_heads.ah_head_id as head_id,
        {$this->db->getPrefix()}accounts_journal_vouchers.jv_date AS transaction_date,
         {$journal_table}.ji_credit AS credit_amount,
         {$journal_table}.ji_debit AS debit_amount,
        'Journal Voucher' as voucher_type,
        {$this->db->getPrefix()}accounts_charts_of_accounts.ca_id AS account_id,
        {$this->db->getPrefix()}accounts_charts_of_accounts.ca_name AS account_name
    FROM {$this->db->getPrefix()}accounts_journal_invoices
    LEFT JOIN {$this->db->getPrefix()}accounts_journal_vouchers ON {$this->db->getPrefix()}accounts_journal_vouchers.jv_id = {$this->db->getPrefix()}accounts_journal_invoices.ji_voucher_id
    LEFT JOIN {$this->db->getPrefix()}accounts_charts_of_accounts ON {$this->db->getPrefix()}accounts_charts_of_accounts.ca_id = {$journal_table}.ji_account
    LEFT JOIN {$this->db->getPrefix()}accounts_charts_of_accounts AS journal_account ON journal_account.ca_id = {$journal_table}.ji_account
    LEFT JOIN {$this->db->getPrefix()}accounts_account_heads ON {$this->db->getPrefix()}accounts_account_heads.ah_id = {$this->db->getPrefix()}accounts_charts_of_accounts.ca_account_type
    LEFT JOIN {$this->db->getPrefix()}accounts_account_types ON {$this->db->getPrefix()}accounts_account_types.at_id = {$this->db->getPrefix()}accounts_account_heads.ah_id
     ";


        if (!empty($time_frame) || $account_type != "" ||  !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to)) {

            $query .= "WHERE ";
        }

        if ($time_frame != "") {
            if ($time_frame == "Range") {
                if ($date_from != "") {
                    $query .= "{$this->db->getPrefix()}accounts_journal_vouchers.jv_date >= '{$date_from}' ";
                }

                if ($date_to != "") {
                    if ($date_from != "") {
                        $query .= "AND ";
                    }
                    $query .= "{$this->db->getPrefix()}accounts_journal_vouchers.jv_date <= '{$date_to}' ";
                }
            } elseif ($time_frame == "Month") {
                $query .= "YEAR({$this->db->getPrefix()}accounts_journal_vouchers.jv_date) = YEAR(CURRENT_DATE()) AND MONTH({$this->db->getPrefix()}accounts_journal_vouchers.jv_date) = MONTH(CURRENT_DATE()) ";
            } elseif ($time_frame == "Year") {
                $query .= "YEAR({$this->db->getPrefix()}accounts_journal_vouchers.jv_date) = YEAR(CURRENT_DATE())";
            }
        }

        if ($account_head != "") {
            if ($time_frame != "" || $date_from != "" || $date_to != "") {
                $query .= "AND ";
            }
            $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_id = {$account_head} ";
        }

        if ($account_type != "") {
            if ($account_head != "" || $time_frame != "") {
                $query .= "AND ";
            }
            $query .= "{$this->db->getPrefix()}accounts_account_types.at_id = {$account_type} ";
        }


        if ($account != "") {
            if ($account_head != "" || $account_type != "" || $time_frame != "" || $date_from != "" || $date_to != "") {
                $query .= "AND ";
            }
            //$query .= "{$credit_invoice_table}.cci_credit_account = {$account} ";
            $query .= "{$this->db->getPrefix()}accounts_charts_of_accounts.ca_id = {$account} ";
        }

        if ($range_from != "") {

            if ($account_head != "" || $account_type != "" || $time_frame != "") {
                $query .= "AND ";
            }

            $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_head_id >= {$range_from} ";
        }

        if ($range_to != "") {

            if ($account_head != "" || $account_type != "" || $time_frame != "" || $range_from != "") {
                $query .= "AND ";
            }

            $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_head_id <= {$range_to} ";
        }


        $query .= ")";



        //Journal End






        //Petty Cash Voucher Start

        $query .= "UNION ALL 
    (SELECT 
        {$pcv_table}.pcv_id AS id,
        {$pcv_table}.pcv_voucher_no AS reference,
        {$this->db->getPrefix()}accounts_account_heads.ah_head_id as head_id,
        {$pcv_table}.pcv_date AS transaction_date,
        {$pcv_table}.pcv_total AS credit_amount,
        NULL AS debit_amount,
        'Petty Cash Voucher' as voucher_type,
        {$this->db->getPrefix()}accounts_charts_of_accounts.ca_id AS account_id,
        {$this->db->getPrefix()}accounts_charts_of_accounts.ca_name AS account_name
    FROM {$this->db->getPrefix()}accounts_petty_cash_voucher
    
    LEFT JOIN {$this->db->getPrefix()}accounts_charts_of_accounts ON {$this->db->getPrefix()}accounts_charts_of_accounts.ca_id = {$pcv_table}.pcv_credit_account
    LEFT JOIN {$this->db->getPrefix()}accounts_account_heads ON {$this->db->getPrefix()}accounts_account_heads.ah_id = {$this->db->getPrefix()}accounts_charts_of_accounts.ca_account_type
    LEFT JOIN {$this->db->getPrefix()}accounts_account_types ON {$this->db->getPrefix()}accounts_account_types.at_id = {$this->db->getPrefix()}accounts_account_heads.ah_id
     ";


        if (!empty($time_frame) || $account_type != "" ||  !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to)) {

            $query .= "WHERE ";
        }

        if ($time_frame != "") {
            if ($time_frame == "Range") {
                if ($date_from != "") {
                    $query .= "{$pcv_table}.pcv_date >= '{$date_from}' ";
                }

                if ($date_to != "") {
                    if ($date_from != "") {
                        $query .= "AND ";
                    }
                    $query .= "{$pcv_table}.pcv_date <= '{$date_to}' ";
                }
            } elseif ($time_frame == "Month") {
                $query .= "YEAR({$pcv_table}.pcv_date) = YEAR(CURRENT_DATE()) AND MONTH({$pcv_table}.pcv_date) = MONTH(CURRENT_DATE()) ";
            } elseif ($time_frame == "Year") {
                $query .= "YEAR({$pcv_table}.pcv_date) = YEAR(CURRENT_DATE())";
            }
        }

        if ($account_head != "") {
            if ($time_frame != "" || $date_from != "" || $date_to != "") {
                $query .= "AND ";
            }
            $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_id = {$account_head} ";
        }


        if ($account_type != "") {
            if ($account_head != "" || $time_frame != "") {
                $query .= "AND ";
            }
            $query .= "{$this->db->getPrefix()}accounts_account_types.at_id = {$account_type} ";
        }

        if ($account != "") {
            if ($account_head != "" || $account_type != "" || $time_frame != "" || $date_from != "" || $date_to != "") {
                $query .= "AND ";
            }

            //$query .= "{$credit_invoice_table}.cci_credit_account = {$account} ";
            $query .= "{$this->db->getPrefix()}accounts_charts_of_accounts.ca_id = {$account} ";
        }

        if ($range_from != "") {

            if ($account_head != "" || $account_type != "" || $time_frame != "") {
                $query .= "AND ";
            }

            $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_head_id >= {$range_from} ";
        }

        if ($range_to != "") {

            if ($account_head != "" || $account_type != "" || $time_frame != "" || $range_from != "") {
                $query .= "AND ";
            }

            $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_head_id <= {$range_to} ";
        }


        $query .= ")";

        //Petty Cash Voucher End




        //Sales Return Start

        $query .= "UNION ALL 
    (SELECT 
        {$sr_table}.sr_id AS id,
        {$sr_table}.sr_reffer_no AS reference,
        {$this->db->getPrefix()}accounts_account_heads.ah_head_id as head_id,
        {$sr_table}.sr_date AS transaction_date,
        NULL AS credit_amount,
        {$sr_table}.sr_total AS debit_amount,
        'Sales Return' as voucher_type,
        {$this->db->getPrefix()}accounts_charts_of_accounts.ca_id AS account_id,
        {$this->db->getPrefix()}accounts_charts_of_accounts.ca_name AS account_name
        FROM {$sr_table}
    
    LEFT JOIN {$this->db->getPrefix()}accounts_charts_of_accounts ON {$this->db->getPrefix()}accounts_charts_of_accounts.ca_customer = {$sr_table}.sr_customer
    LEFT JOIN {$this->db->getPrefix()}accounts_account_heads ON {$this->db->getPrefix()}accounts_account_heads.ah_id = {$this->db->getPrefix()}accounts_charts_of_accounts.ca_account_type
    LEFT JOIN {$this->db->getPrefix()}accounts_account_types ON {$this->db->getPrefix()}accounts_account_types.at_id = {$this->db->getPrefix()}accounts_account_heads.ah_id
    LEFT JOIN {$this->db->getPrefix()}accounts_charts_of_accounts AS ca_credit_account ON ca_credit_account.ca_name = {$sr_table}.sr_credit_account
    ";

        if (!empty($time_frame) || $account_type != "" ||  !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to)) {

            $query .= "WHERE ";
        }

        if ($time_frame != "") {
            if ($time_frame == "Range") {
                if ($date_from != "") {
                    $query .= "{$sr_table}.sr_date >= '{$date_from}' ";
                }

                if ($date_to != "") {
                    if ($date_from != "") {
                        $query .= "AND ";
                    }
                    $query .= "{$sr_table}.sr_date <= '{$date_to}' ";
                }
            } elseif ($time_frame == "Month") {
                $query .= "YEAR({$sr_table}.sr_date) = YEAR(CURRENT_DATE()) AND MONTH({$sr_table}.sr_date) = MONTH(CURRENT_DATE()) ";
            } elseif ($time_frame == "Year") {
                $query .= "YEAR({$sr_table}.sr_date) = YEAR(CURRENT_DATE())";
            }
        }

        if ($account_head != "") {
            if ($time_frame != "" || $date_from != "" || $date_to != "") {
                $query .= "AND ";
            }
            $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_id = {$account_head} ";
        }

        if ($account_type != "") {
            if ($account_head != "" || $time_frame != "") {
                $query .= "AND ";
            }
            $query .= "{$this->db->getPrefix()}accounts_account_types.at_id = {$account_type} ";
        }


        if ($account != "") {
            if ($account_head != "" || $account_type != "" || $time_frame != "" || $date_from != "" || $date_to != "") {
                $query .= "AND ";
            }

            //$query .= "{$credit_invoice_table}.cci_credit_account = {$account} ";
            //$query .= "{$this->db->getPrefix()}accounts_charts_of_accounts.ca_id = {$account} ";

            $query .= "ca_credit_account.ca_id = {$account} ";
        }

        if ($range_from != "") {

            if ($account_head != "" || $account_type != "" || $time_frame != "") {
                $query .= "AND ";
            }

            $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_head_id >= {$range_from} ";
        }

        if ($range_to != "") {

            if ($account_head != "" || $account_type != "" || $time_frame != "" || $range_from != "") {
                $query .= "AND ";
            }

            $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_head_id <= {$range_to} ";
        }


        $query .= ")";



        //Sales Return Debit


        $query .= "UNION ALL 
    (SELECT 
        {$sr_table}.sr_id AS id,
        {$sr_table}.sr_reffer_no AS reference,
        {$this->db->getPrefix()}accounts_account_heads.ah_head_id as head_id,
        {$sr_table}.sr_date AS transaction_date,
        {$sr_table}.sr_total AS credit_amount,
        NULL AS debit_amount,
        'Sales Return' as voucher_type,
        {$this->db->getPrefix()}accounts_charts_of_accounts.ca_id AS account_id,
        {$this->db->getPrefix()}accounts_charts_of_accounts.ca_name AS account_name
        FROM {$sr_table}
    
    LEFT JOIN {$this->db->getPrefix()}accounts_charts_of_accounts ON {$this->db->getPrefix()}accounts_charts_of_accounts.ca_name = {$sr_table}.sr_credit_account
    LEFT JOIN {$this->db->getPrefix()}accounts_account_heads ON {$this->db->getPrefix()}accounts_account_heads.ah_id = {$this->db->getPrefix()}accounts_charts_of_accounts.ca_account_type
    LEFT JOIN {$this->db->getPrefix()}accounts_account_types ON {$this->db->getPrefix()}accounts_account_types.at_id = {$this->db->getPrefix()}accounts_account_heads.ah_id
    LEFT JOIN {$this->db->getPrefix()}accounts_charts_of_accounts AS ca_credit_account ON ca_credit_account.ca_customer = {$sr_table}.sr_customer
    ";

        if (!empty($time_frame) || $account_type != "" ||  !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to)) {

            $query .= "WHERE ";
        }

        if ($time_frame != "") {
            if ($time_frame == "Range") {
                if ($date_from != "") {
                    $query .= "{$sr_table}.sr_date >= '{$date_from}' ";
                }

                if ($date_to != "") {
                    if ($date_from != "") {
                        $query .= "AND ";
                    }
                    $query .= "{$sr_table}.sr_date <= '{$date_to}' ";
                }
            } elseif ($time_frame == "Month") {
                $query .= "YEAR({$sr_table}.sr_date) = YEAR(CURRENT_DATE()) AND MONTH({$sr_table}.sr_date) = MONTH(CURRENT_DATE()) ";
            } elseif ($time_frame == "Year") {
                $query .= "YEAR({$sr_table}.sr_date) = YEAR(CURRENT_DATE())";
            }
        }

        if ($account_head != "") {
            if ($time_frame != "" || $date_from != "" || $date_to != "") {
                $query .= "AND ";
            }
            $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_id = {$account_head} ";
        }

        if ($account_type != "") {
            if ($account_head != "" || $time_frame != "") {
                $query .= "AND ";
            }
            $query .= "{$this->db->getPrefix()}accounts_account_types.at_id = {$account_type} ";
        }


        if ($account != "") {
            if ($account_head != "" || $account_type != "" || $time_frame != "" || $date_from != "" || $date_to != "") {
                $query .= "AND ";
            }

            //$query .= "{$credit_invoice_table}.cci_credit_account = {$account} ";
            //$query .= "{$this->db->getPrefix()}accounts_charts_of_accounts.ca_id = {$account} ";

            $query .= "ca_credit_account.ca_id = {$account} ";
        }

        if ($range_from != "") {

            if ($account_head != "" || $account_type != "" || $time_frame != "") {
                $query .= "AND ";
            }

            $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_head_id >= {$range_from} ";
        }

        if ($range_to != "") {

            if ($account_head != "" || $account_type != "" || $time_frame != "" || $range_from != "") {
                $query .= "AND ";
            }

            $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_head_id <= {$range_to} ";
        }


        $query .= ")";



        //Sales Return End





        //Purchase Return Start

        $pr_table = "{$this->db->getPrefix()}pro_purchase_return";

        $query .= "UNION ALL 
    (SELECT 
        {$pr_table}.pr_id AS id,
        {$pr_table}.pr_reffer_id AS reference,
        {$this->db->getPrefix()}accounts_account_heads.ah_head_id as head_id,
        {$pr_table}.pr_date AS transaction_date,
        {$pr_table}.pr_total_amount AS credit_amount,
        NULL AS debit_amount,
        'Purchase Return' as voucher_type,
        {$this->db->getPrefix()}accounts_charts_of_accounts.ca_id AS account_id,
        {$this->db->getPrefix()}accounts_charts_of_accounts.ca_name AS account_name
        FROM {$pr_table}
    
    LEFT JOIN {$this->db->getPrefix()}accounts_charts_of_accounts ON {$this->db->getPrefix()}accounts_charts_of_accounts.ca_customer = {$pr_table}.pr_vendor_name
    LEFT JOIN {$this->db->getPrefix()}accounts_account_heads ON {$this->db->getPrefix()}accounts_account_heads.ah_id = {$this->db->getPrefix()}accounts_charts_of_accounts.ca_account_type
    LEFT JOIN {$this->db->getPrefix()}accounts_account_types ON {$this->db->getPrefix()}accounts_account_types.at_id = {$this->db->getPrefix()}accounts_account_heads.ah_id
     ";

        if (!empty($time_frame) || $account_type != "" ||  !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to)) {

            $query .= "WHERE ";
        }

        if ($time_frame != "") {
            if ($time_frame == "Range") {
                if ($date_from != "") {
                    $query .= "{$pr_table}.pr_date >= '{$date_from}' ";
                }

                if ($date_to != "") {
                    if ($date_from != "") {
                        $query .= "AND ";
                    }
                    $query .= "{$pr_table}.pr_date <= '{$date_to}' ";
                }
            } elseif ($time_frame == "Month") {
                $query .= "YEAR({$pr_table}.pr_date) = YEAR(CURRENT_DATE()) AND MONTH({$pr_table}.pr_date) = MONTH(CURRENT_DATE()) ";
            } elseif ($time_frame == "Year") {
                $query .= "YEAR({$pr_table}.pr_date) = YEAR(CURRENT_DATE())";
            }
        }

        if ($account_head != "") {
            if ($time_frame != "" || $date_from != "" || $date_to != "") {
                $query .= "AND ";
            }
            $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_id = {$account_head} ";
        }

        if ($account_type != "") {
            if ($account_head != "" || $time_frame != "") {
                $query .= "AND ";
            }
            $query .= "{$this->db->getPrefix()}accounts_account_types.at_id = {$account_type} ";
        }


        if ($account != "") {
            if ($account_head != "" || $account_type != "" || $time_frame != "" || $date_from != "" || $date_to != "") {
                $query .= "AND ";
            }

            //$query .= "{$credit_invoice_table}.cci_credit_account = {$account} ";
            $query .= "{$this->db->getPrefix()}accounts_charts_of_accounts.ca_id = {$account} ";
        }

        if ($range_from != "") {

            if ($account_head != "" || $account_type != "" || $time_frame != "") {
                $query .= "AND ";
            }

            $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_head_id >= {$range_from} ";
        }

        if ($range_to != "") {

            if ($account_head != "" || $account_type != "" || $time_frame != "" || $range_from != "") {
                $query .= "AND ";
            }

            $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_head_id <= {$range_to} ";
        }

        $query .= ")";

        //Purchase Return End




        //Purchase Voucher Debit


        $query .= "UNION ALL 
    (SELECT 
    {$pv_table}.pv_id AS id, 
    {$pv_table}.pv_reffer_id AS reference, 
    {$this->db->getPrefix()}accounts_account_heads.ah_head_id as head_id,
    {$pv_table}.pv_date AS transaction_date,
    NULL AS credit_amount,
    {$this->db->getPrefix()}pro_purchase_voucher_prod.pvp_amount AS debit_amount,
    'Purchase Voucher' as voucher_type,
    {$this->db->getPrefix()}accounts_charts_of_accounts.ca_id AS account_id,
    {$this->db->getPrefix()}accounts_charts_of_accounts.ca_name AS account_name
    FROM {$this->db->getPrefix()}pro_purchase_voucher
    LEFT JOIN {$this->db->getPrefix()}pro_purchase_voucher_prod ON {$this->db->getPrefix()}pro_purchase_voucher_prod.pvp_reffer_id = {$pv_table}.pv_id 
    LEFT JOIN {$this->db->getPrefix()}accounts_charts_of_accounts ON {$this->db->getPrefix()}accounts_charts_of_accounts.ca_customer = {$pv_table}.pv_vendor_name AND {$this->db->getPrefix()}accounts_charts_of_accounts.ca_type = 'VENDOR'
    LEFT JOIN {$this->db->getPrefix()}pro_purchase_order ON {$this->db->getPrefix()}pro_purchase_order.po_id = {$pv_table}.pv_purchase_order 
    LEFT JOIN {$this->db->getPrefix()}accounts_charts_of_accounts AS debit_account_pv ON debit_account_pv.ca_id = {$this->db->getPrefix()}pro_purchase_voucher_prod.pvp_debit  
    LEFT JOIN {$this->db->getPrefix()}accounts_account_heads ON {$this->db->getPrefix()}accounts_account_heads.ah_id = debit_account_pv.ca_account_type
    LEFT JOIN {$this->db->getPrefix()}accounts_account_types ON {$this->db->getPrefix()}accounts_account_types.at_id = {$this->db->getPrefix()}accounts_account_heads.ah_id
    ";
        //
        //

        if (!empty($time_frame) || $account_type != "" || !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to)) {

            $query .= "WHERE ";
        }
        //Documentations are for the weak.
        if ($time_frame != "") {
            if ($time_frame == "Range") {
                if ($date_from != "") {
                    $query .= "{$pv_table}.	pv_date >= '{$date_from}' ";
                }

                if ($date_to != "") {
                    if ($date_from != "") {
                        $query .= "AND ";
                    }
                    $query .= "{$pv_table}.pv_date <= '{$date_to}' ";
                }
            } elseif ($time_frame == "Month") {
                $query .= "YEAR({$pv_table}.pv_date) = YEAR(CURRENT_DATE()) AND MONTH({$pv_table}.pv_date) = MONTH(CURRENT_DATE()) ";
            } elseif ($time_frame == "Year") {
                $query .= "YEAR({$pv_table}.pv_date) = YEAR(CURRENT_DATE()) ";
            }
        }

        if ($account_head != "") {
            if ($time_frame != "") {
                $query .= "AND ";
            }
            $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_id = {$account_head} ";
        }


        if ($account_type != "") {
            if ($account_head != "" || $time_frame != "") {
                $query .= "AND ";
            }
            $query .= "{$this->db->getPrefix()}accounts_account_types.at_id = {$account_type} ";
        }



        if ($account != "") {
            if ($account_head != "" || $account_type != "" || $time_frame != "") {
                $query .= "AND ";
            }

            $query .= "debit_account_pv.ca_id = {$account} ";
        }

        if ($range_from != "") {

            if ($account_head != "" || $account_type != "" || $time_frame != "") {
                $query .= "AND ";
            }

            $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_head_id >= {$range_from} ";
        }

        if ($range_to != "") {

            if ($account_head != "" || $account_type != "" || $time_frame != "" || $range_from != "") {
                $query .= "AND ";
            }

            $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_head_id <= {$range_to} ";
        }

        $query .= "GROUP BY {$this->db->getPrefix()}pro_purchase_voucher_prod.pvp_reffer_id";

        $query .= ")";






        //Purchase Voucher Credit

        $query .= "UNION ALL 
    (SELECT 
    {$pv_table}.pv_id AS id, 
    {$pv_table}.pv_reffer_id AS reference, 
    {$this->db->getPrefix()}accounts_account_heads.ah_head_id as head_id,
    {$pv_table}.pv_date AS transaction_date,
    {$this->db->getPrefix()}pro_purchase_voucher_prod.pvp_amount AS credit_amount,
    NULL AS debit_amount,
    'Purchase Voucher' as voucher_type,
    {$this->db->getPrefix()}accounts_charts_of_accounts.ca_id AS account_id,
    {$this->db->getPrefix()}accounts_charts_of_accounts.ca_name AS account_name
    FROM {$this->db->getPrefix()}pro_purchase_voucher
    LEFT JOIN {$this->db->getPrefix()}pro_purchase_voucher_prod ON {$this->db->getPrefix()}pro_purchase_voucher_prod.pvp_reffer_id = {$pv_table}.pv_id 
    LEFT JOIN {$this->db->getPrefix()}accounts_charts_of_accounts ON {$this->db->getPrefix()}accounts_charts_of_accounts.ca_id = {$this->db->getPrefix()}pro_purchase_voucher_prod.pvp_debit  
    LEFT JOIN {$this->db->getPrefix()}pro_purchase_order ON {$this->db->getPrefix()}pro_purchase_order.po_id = {$pv_table}.pv_purchase_order
    LEFT JOIN {$this->db->getPrefix()}accounts_charts_of_accounts AS credit_account_pv ON credit_account_pv.ca_customer = {$pv_table}.pv_vendor_name AND credit_account_pv.ca_type = 'VENDOR'
    LEFT JOIN {$this->db->getPrefix()}accounts_account_heads ON {$this->db->getPrefix()}accounts_account_heads.ah_id = credit_account_pv.ca_account_type
    LEFT JOIN {$this->db->getPrefix()}accounts_account_types ON {$this->db->getPrefix()}accounts_account_types.at_id = {$this->db->getPrefix()}accounts_account_heads.ah_id
    ";
        //
        //

        if (!empty($time_frame) || $account_type != "" || !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to)) {

            $query .= "WHERE ";
        }
        //Documentations are for the weak.
        if ($time_frame != "") {
            if ($time_frame == "Range") {
                if ($date_from != "") {
                    $query .= "{$pv_table}.	pv_date >= '{$date_from}' ";
                }

                if ($date_to != "") {
                    if ($date_from != "") {
                        $query .= "AND ";
                    }
                    $query .= "{$pv_table}.pv_date <= '{$date_to}' ";
                }
            } elseif ($time_frame == "Month") {
                $query .= "YEAR({$pv_table}.pv_date) = YEAR(CURRENT_DATE()) AND MONTH({$pv_table}.pv_date) = MONTH(CURRENT_DATE()) ";
            } elseif ($time_frame == "Year") {
                $query .= "YEAR({$pv_table}.pv_date) = YEAR(CURRENT_DATE()) ";
            }
        }

        if ($account_head != "") {
            if ($time_frame != "") {
                $query .= "AND ";
            }
            $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_id = {$account_head} ";
        }



        if ($account_type != "") {
            if ($account_head != "" || $time_frame != "") {
                $query .= "AND ";
            }
            $query .= "{$this->db->getPrefix()}accounts_account_types.at_id = {$account_type} ";
        }

        if ($account != "") {
            if ($account_head != "" || $account_type != "" || $time_frame != "") {
                $query .= "AND ";
            }

            $query .= "credit_account_pv.ca_id = {$account} ";
        }

        if ($range_from != "") {

            if ($account_head != "" || $account_type != "" || $time_frame != "") {
                $query .= "AND ";
            }

            $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_head_id >= {$range_from} ";
        }

        if ($range_to != "") {

            if ($account_head != "" || $account_type != "" || $time_frame != "" || $range_from != "") {
                $query .= "AND ";
            }

            $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_head_id <= {$range_to} ";
        }

        //$query .="GROUP BY {$this->db->getPrefix()}pro_purchase_voucher_prod.pvp_reffer_id";

        $query .= ")";






        //Fetch Invoices All New

        $query .= "UNION ALL 
    (SELECT 
    {$receipt_table}.r_id AS id, 
    {$receipt_table}.r_ref_no AS reference, 
    {$this->db->getPrefix()}accounts_account_heads.ah_head_id as head_id,
    {$receipt_table}.r_date AS transaction_date,
    {$this->db->getPrefix()}accounts_receipt_invoices.ri_amount AS credit_amount,
    NULL AS debit_amount,
    'Receipt' as voucher_type,
        {$this->db->getPrefix()}accounts_charts_of_accounts.ca_id AS account_id,
        {$this->db->getPrefix()}accounts_charts_of_accounts.ca_name AS account_name
        FROM {$this->db->getPrefix()}accounts_receipts
    LEFT JOIN {$this->db->getPrefix()}accounts_receipt_invoices ON {$this->db->getPrefix()}accounts_receipt_invoices.ri_receipt = {$receipt_table}.r_id 
    LEFT JOIN {$this->db->getPrefix()}accounts_receipt_invoice_data ON {$this->db->getPrefix()}accounts_receipt_invoice_data.rid_receipt_invoice = {$this->db->getPrefix()}accounts_receipt_invoices.ri_id
    LEFT JOIN {$this->db->getPrefix()}accounts_charts_of_accounts ON {$this->db->getPrefix()}accounts_charts_of_accounts.ca_id = {$this->db->getPrefix()}accounts_receipts.r_debit_account
    LEFT JOIN {$this->db->getPrefix()}accounts_charts_of_accounts AS credit_account_receipt ON credit_account_receipt.ca_id = {$this->db->getPrefix()}accounts_receipt_invoices.ri_credit_account
    LEFT JOIN {$this->db->getPrefix()}crm_customer_creation ON {$this->db->getPrefix()}crm_customer_creation.cc_id = credit_account_receipt.ca_customer
    LEFT JOIN {$this->db->getPrefix()}accounts_account_heads ON {$this->db->getPrefix()}accounts_account_heads.ah_id = credit_account_receipt.ca_account_type
    LEFT JOIN {$this->db->getPrefix()}accounts_account_types ON {$this->db->getPrefix()}accounts_account_types.at_id = {$this->db->getPrefix()}accounts_account_heads.ah_id
    ";

        //
        //

        if (!empty($time_frame) || $account_type != "" || !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to)) {

            $query .= "WHERE ";
        }
        //Documentations are for the weak.
        if ($time_frame != "") {
            if ($time_frame == "Range") {
                if ($date_from != "") {
                    $query .= "{$receipt_table}.r_date >= '{$date_from}' ";
                }

                if ($date_to != "") {
                    if ($date_from != "") {
                        $query .= "AND ";
                    }
                    $query .= "{$receipt_table}.r_date <= '{$date_to}' ";
                }
            } elseif ($time_frame == "Month") {
                $query .= "YEAR({$receipt_table}.r_date) = YEAR(CURRENT_DATE()) AND MONTH({$receipt_table}.r_date) = MONTH(CURRENT_DATE()) ";
            } elseif ($time_frame == "Year") {
                $query .= "YEAR({$receipt_table}.r_date) = YEAR(CURRENT_DATE()) ";
            }
        }

        if ($account_head != "") {
            if ($time_frame != "") {
                $query .= "AND ";
            }
            $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_id = {$account_head} ";
        }


        if ($account_type != "") {
            if ($account_head != "" || $time_frame != "") {
                $query .= "AND ";
            }
            $query .= "{$this->db->getPrefix()}accounts_account_types.at_id = {$account_type} ";
        }

        if ($account != "") {
            if ($account_head != "" || $account_type != "" || $time_frame != "") {
                $query .= "AND ";
            }
            //$query .= "{$this->db->getPrefix()}accounts_receipt_invoices.ri_credit_account = {$account} ";
            $query .= "credit_account_receipt.ca_id = {$account} ";
        }

        if ($range_from != "") {

            if ($account_head != "" || $account_type != "" || $time_frame != "") {
                $query .= "AND ";
            }

            $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_head_id >= {$range_from} ";
        }

        if ($range_to != "") {

            if ($account_head != "" || $account_type != "" || $time_frame != "" || $range_from != "") {
                $query .= "AND ";
            }

            $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_head_id <= {$range_to} ";
        }

        $query .= "AND {$this->db->getPrefix()}accounts_receipt_invoices.ri_amount>1 ";

        $query .= "GROUP BY {$this->db->getPrefix()}accounts_receipt_invoices.ri_id";

        $query .= ")";



        //Discount Receipt Fetch 

        $query .= "UNION ALL 
    (SELECT 
    {$receipt_table}.r_id AS id, 
    {$receipt_table}.r_ref_no AS reference, 
    {$this->db->getPrefix()}accounts_account_heads.ah_head_id as head_id,
    {$receipt_table}.r_date AS transaction_date,
    {$this->db->getPrefix()}accounts_receipt_invoices.ri_amount AS credit_amount,
    NULL AS debit_amount,
    'Receipt' as voucher_type,
        {$this->db->getPrefix()}accounts_charts_of_accounts.ca_id AS account_id,
        {$this->db->getPrefix()}accounts_charts_of_accounts.ca_name AS account_name
        FROM {$this->db->getPrefix()}accounts_receipts
    LEFT JOIN {$this->db->getPrefix()}accounts_receipt_invoices ON {$this->db->getPrefix()}accounts_receipt_invoices.ri_receipt = {$receipt_table}.r_id 
    LEFT JOIN {$this->db->getPrefix()}accounts_receipt_invoice_data ON {$this->db->getPrefix()}accounts_receipt_invoice_data.rid_receipt_invoice = {$this->db->getPrefix()}accounts_receipt_invoices.ri_id
    LEFT JOIN {$this->db->getPrefix()}accounts_charts_of_accounts ON {$this->db->getPrefix()}accounts_charts_of_accounts.ca_id = {$this->db->getPrefix()}accounts_receipts.r_debit_account
    LEFT JOIN {$this->db->getPrefix()}accounts_charts_of_accounts AS credit_account_receipt ON credit_account_receipt.ca_id = {$this->db->getPrefix()}accounts_receipt_invoices.ri_credit_account
    LEFT JOIN {$this->db->getPrefix()}crm_customer_creation ON {$this->db->getPrefix()}crm_customer_creation.cc_id = credit_account_receipt.ca_customer
    LEFT JOIN {$this->db->getPrefix()}accounts_account_heads ON {$this->db->getPrefix()}accounts_account_heads.ah_id = credit_account_receipt.ca_account_type
    LEFT JOIN {$this->db->getPrefix()}accounts_account_types ON {$this->db->getPrefix()}accounts_account_types.at_id = {$this->db->getPrefix()}accounts_account_heads.ah_id
    ";

        //
        //

        if (!empty($time_frame) || $account_type != "" || !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to)) {

            $query .= "WHERE ";
        }



        //Documentations are for the weak.
        if ($time_frame != "") {
            if ($time_frame == "Range") {
                if ($date_from != "") {
                    $query .= "{$receipt_table}.r_date >= '{$date_from}' ";
                }

                if ($date_to != "") {
                    if ($date_from != "") {
                        $query .= "AND ";
                    }
                    $query .= "{$receipt_table}.r_date <= '{$date_to}' ";
                }
            } elseif ($time_frame == "Month") {
                $query .= "YEAR({$receipt_table}.r_date) = YEAR(CURRENT_DATE()) AND MONTH({$receipt_table}.r_date) = MONTH(CURRENT_DATE()) ";
            } elseif ($time_frame == "Year") {
                $query .= "YEAR({$receipt_table}.r_date) = YEAR(CURRENT_DATE()) ";
            }
        }

        if ($account_head != "") {
            if ($time_frame != "") {
                $query .= "AND ";
            }
            $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_id = {$account_head} ";
        }


        if ($account_type != "") {
            if ($account_head != "" || $time_frame != "") {
                $query .= "AND ";
            }
            $query .= "{$this->db->getPrefix()}accounts_account_types.at_id = {$account_type} ";
        }

        if ($account != "") {
            if ($account_head != "" || $account_type != "" || $time_frame != "") {
                $query .= "AND ";
            }
            //$query .= "{$this->db->getPrefix()}accounts_receipt_invoices.ri_credit_account = {$account} ";
            $query .= "credit_account_receipt.ca_id = {$account} ";
        }

        if ($range_from != "") {

            if ($account_head != "" || $account_type != "" || $time_frame != "") {
                $query .= "AND ";
            }

            $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_head_id >= {$range_from} ";
        }

        if ($range_to != "") {

            if ($account_head != "" || $account_type != "" || $time_frame != "" || $range_from != "") {
                $query .= "AND ";
            }

            $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_head_id <= {$range_to} ";
        }

        $query .= "AND {$this->db->getPrefix()}accounts_receipt_invoices.ri_amount<1 ";

        $query .= "GROUP BY {$this->db->getPrefix()}accounts_receipt_invoices.ri_id";

        $query .= ")";



        //








        //Receipt Debit Account Select

        $query .= "UNION ALL 
    (SELECT 
    {$receipt_table}.r_id AS id, 
    {$receipt_table}.r_ref_no AS reference, 
    {$this->db->getPrefix()}accounts_account_heads.ah_head_id as head_id,
    {$receipt_table}.r_date AS transaction_date,
    NULL AS credit_amount,
    {$this->db->getPrefix()}accounts_receipt_invoices.ri_amount AS debit_amount,
    'Receipt' as voucher_type,
    {$this->db->getPrefix()}accounts_charts_of_accounts.ca_id AS account_id,
    {$this->db->getPrefix()}accounts_charts_of_accounts.ca_name AS account_name
    FROM {$this->db->getPrefix()}accounts_receipts
    LEFT JOIN {$this->db->getPrefix()}accounts_receipt_invoices ON {$this->db->getPrefix()}accounts_receipt_invoices.ri_receipt = {$receipt_table}.r_id 
    LEFT JOIN {$this->db->getPrefix()}accounts_receipt_invoice_data ON {$this->db->getPrefix()}accounts_receipt_invoice_data.rid_receipt_invoice = {$this->db->getPrefix()}accounts_receipt_invoices.ri_id
    LEFT JOIN {$this->db->getPrefix()}accounts_charts_of_accounts ON {$this->db->getPrefix()}accounts_charts_of_accounts.ca_id = {$this->db->getPrefix()}accounts_receipt_invoices.ri_credit_account
    LEFT JOIN {$this->db->getPrefix()}accounts_charts_of_accounts AS credit_account_receipt ON credit_account_receipt.ca_id = {$this->db->getPrefix()}accounts_receipt_invoices.ri_credit_account
    LEFT JOIN {$this->db->getPrefix()}crm_customer_creation ON {$this->db->getPrefix()}crm_customer_creation.cc_id = credit_account_receipt.ca_customer
    LEFT JOIN {$this->db->getPrefix()}accounts_account_heads ON {$this->db->getPrefix()}accounts_account_heads.ah_id = credit_account_receipt.ca_account_type
    LEFT JOIN {$this->db->getPrefix()}accounts_account_types ON {$this->db->getPrefix()}accounts_account_types.at_id = {$this->db->getPrefix()}accounts_account_heads.ah_id
    ";
        //
        //

        if (!empty($time_frame) || $account_type != "" || !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to)) {

            $query .= "WHERE ";
        }
        //Documentations are for the weak.
        if ($time_frame != "") {
            if ($time_frame == "Range") {
                if ($date_from != "") {
                    $query .= "{$receipt_table}.r_date >= '{$date_from}' ";
                }

                if ($date_to != "") {
                    if ($date_from != "") {
                        $query .= "AND ";
                    }
                    $query .= "{$receipt_table}.r_date <= '{$date_to}' ";
                }
            } elseif ($time_frame == "Month") {
                $query .= "YEAR({$receipt_table}.r_date) = YEAR(CURRENT_DATE()) AND MONTH({$receipt_table}.r_date) = MONTH(CURRENT_DATE()) ";
            } elseif ($time_frame == "Year") {
                $query .= "YEAR({$receipt_table}.r_date) = YEAR(CURRENT_DATE()) ";
            }
        }

        if ($account_head != "") {
            if ($time_frame != "") {
                $query .= "AND ";
            }
            $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_id = {$account_head} ";
        }

        if ($account_type != "") {
            if ($account_head != "" || $time_frame != "") {
                $query .= "AND ";
            }
            $query .= "{$this->db->getPrefix()}accounts_account_types.at_id = {$account_type} ";
        }

        if ($account != "") {
            if ($account_head != "" || $account_type != "" || $time_frame != "") {
                $query .= "AND ";
            }

            $query .= "{$receipt_table}.r_debit_account = {$account} ";
            //$query .= "credit_account_receipt.ca_id = {$account} ";

        }

        if ($range_from != "") {

            if ($account_head != "" || $account_type != "" || $time_frame != "") {
                $query .= "AND ";
            }

            $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_head_id >= {$range_from} ";
        }

        if ($range_to != "") {

            if ($account_head != "" || $account_type != "" || $time_frame != "" || $range_from != "") {
                $query .= "AND ";
            }

            $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_head_id <= {$range_to} ";
        }

        $query .= "AND {$this->db->getPrefix()}accounts_receipt_invoices.ri_amount>0 ";

        $query .= "GROUP BY {$this->db->getPrefix()}accounts_receipt_invoices.ri_id";

        $query .= ")";


        //$account_head != "" || $account_type != ""

        if ($account_head != "") {
            $query .= " ORDER BY account_name ASC";
        } else {
            $query .= " ORDER BY transaction_date ASC,id ASC";
        }


        //echo $query; exit;

        $result = $this->db->query($query)->getResult();

        //  $query = $this->db->getLastQuery();
        //  echo (string)$query;
        //  exit;

        return $result;
    }
}
