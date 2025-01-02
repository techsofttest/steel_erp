<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;


class ReportModel extends Model
{

    protected $db;




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



    public function FetchWhere($table,$cond)
    {
        $query = $this->db->table($table)
        ->where($cond)
        ->get();
        return $query->getResult();

    }   
    
    
    public function FetchWhereOrder($table,$cond,$order_col,$joins)
    {
        $query = $this->db->table($table)
        ->where($cond)
        ->orderBy($order_col,'asc')
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



    //General Ledger Report Start

    public function FetchGLReceipts($date_from,$date_to,$account_head,$account_type,$account,$time_frame)
    {

        $query = $this->db->table('accounts_receipts');

        $query->join('accounts_charts_of_accounts','accounts_charts_of_accounts.ca_id=accounts_receipts.r_debit_account','left');

        $query->join('crm_customer_creation','crm_customer_creation.cc_id=accounts_charts_of_accounts.ca_customer','left');

        $query->join('accounts_account_heads','accounts_account_heads.ah_id=crm_customer_creation.cc_account_head','left');

        $query->join('accounts_account_types','accounts_account_types.at_id=accounts_account_heads.ah_id','left');


        if($time_frame!="")
        {

            if($time_frame=="Range")
            {

        if($date_from!="")
        {
        $query->where('r_date>=',$date_from);
        }

        if($date_to!="")
        {
        $query->where('r_date<=',$date_to);
        }
            }

            if($time_frame=="Month")
            {

                $query->where('year(r_date)',date('Y'));
                $query->where('month(r_date)',date('m'));

            }

            if($time_frame=="Year")
            {

                $query->where('year(r_date)',date('Y'));

            }




        } 



        if($account_head!="")
        {
        $query->where('accounts_account_heads.ah_id',$account_head);
        }


        if($account_type!="")
        {
        $query->where('accounts_account_types.at_id',$account_type);
        }

        if($account!="")
        {
        $query->where('accounts_receipts.r_debit_account',$account);    
        }



        return $query->get()->getResult();

    }



    public function FetchGLPayments($date_from,$date_to,$account_head,$account_type,$account,$time_frame)
    {

        $query = $this->db->table('accounts_payments');

        $query->join('accounts_charts_of_accounts','accounts_charts_of_accounts.ca_id=accounts_payments.pay_credit_account','left');

        $query->join('crm_customer_creation','crm_customer_creation.cc_id=accounts_charts_of_accounts.ca_customer','left');

        $query->join('accounts_account_heads','accounts_account_heads.ah_id=crm_customer_creation.cc_account_head','left');

        $query->join('accounts_account_types','accounts_account_types.at_id=accounts_account_heads.ah_id','left');

        if($time_frame!="")
        {

        if($time_frame=="Range")
            {

        if($date_from!="")
        {
        $query->where('pay_date>=',$date_from);
        }

        if($date_to!="")
        {
        $query->where('pay_date<=',$date_to);
        }
            }

            if($time_frame=="Month")
            {

                $query->where('year(pay_date)',date('Y'));
                $query->where('month(pay_date)',date('m'));

            }

            if($time_frame=="Year")
            {

                $query->where('year(pay_date)',date('Y'));

            }




        }



        if($account_head!="")
        {
        $query->where('accounts_account_heads.ah_id',$account_head);
        }

        if($account!="")
        {
        $query->where('accounts_payments.pay_credit_account',$account);    
        }

        //$query->get();

        //echo $this->db->getLastQuery(); die;


        return $query->get()->getResult();

    }



    public function GetAccounts($head="",$type="")
    {

        $query = $this->db->table('accounts_charts_of_accounts');
        
        $query->select('*');

        $query->join('accounts_account_heads','accounts_account_heads.ah_id=accounts_charts_of_accounts.ca_account_type','left');

        $query->join('accounts_account_types','accounts_account_types.at_id=accounts_account_heads.ah_account_type','left');

        if($head !="")
        {

        $query->where('accounts_account_heads.ah_id',$head);

        }

        if($type !="")
        {

        $query->where('accounts_account_types.at_id',$type);

        }

        $result = $query->get()->getResult();

        return $result;


    }




    public function FetchGLTransactions($date_from, $date_to, $account_head, $account_type, $account, $time_frame,$range_from,$range_to)
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
                {$this->db->getPrefix()}accounts_payment_debit.pd_payment_amount AS credit_amount,
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

    
             if(!empty($time_frame) || $account_type !="" ||  !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to))
    {

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

    if($range_from !="")
    {

        if ($account_head != "" || $account_type != "" || $time_frame != "") {
            $query .= "AND ";
        }

        $query .="{$this->db->getPrefix()}accounts_account_heads.ah_head_id >= {$range_from} ";

    }

    if($range_to !="")
    {
    
        if ($account_head != "" || $account_type != "" || $time_frame != "" || $range_from !="") {
            $query .= "AND ";
        }

        $query .="{$this->db->getPrefix()}accounts_account_heads.ah_head_id <= {$range_to} ";

    }

    $query .="GROUP BY {$this->db->getPrefix()}accounts_payment_debit.pd_id";

    $query .= ")";


    //Payment Debit

            $query .= "UNION ALL
            (SELECT 
                {$payment_table}.pay_id AS id,
                {$payment_table}.pay_ref_no AS reference,
                {$this->db->getPrefix()}accounts_account_heads.ah_head_id as head_id,
                {$payment_table}.pay_date AS transaction_date,
                NULL AS credit_amount,
                {$this->db->getPrefix()}accounts_payment_debit.pd_payment_amount AS debit_amount,
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




            if(!empty($time_frame) || $account_type != "" ||  !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to))
        {

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

        if($range_from !="")
        {

        if ($account_head != "" || $account_type != "" || $time_frame != "") {
            $query .= "AND ";
        }

        $query .="{$this->db->getPrefix()}accounts_account_heads.ah_head_id >= {$range_from} ";

        }

        if($range_to !="")
        {

        if ($account_head != "" || $account_type != "" || $time_frame != "" || $range_from !="") {
            $query .= "AND ";
        }

        $query .="{$this->db->getPrefix()}accounts_account_heads.ah_head_id <= {$range_to} ";

        }

        $query .="GROUP BY {$this->db->getPrefix()}accounts_payments.pay_id";

        $query .= ")";
   
        

    // Payments End





    //Petty Cash Voucher


                $query .= "UNION ALL
                    (SELECT 
                    {$pcv_table}.pcv_id AS id,
                    {$pcv_table}.pcv_voucher_no AS reference,
                    {$this->db->getPrefix()}accounts_account_heads.ah_head_id as head_id,
                    {$pcv_table}.pcv_date AS transaction_date,
                    {$this->db->getPrefix()}accounts_petty_cash_debits.pci_amount AS credit_amount,
                    NULL AS debit_amount,                                                                                                                                                                           
                    'Petty Cash Voucher' as voucher_type,
                    {$this->db->getPrefix()}accounts_charts_of_accounts.ca_id AS account_id,
                    {$this->db->getPrefix()}accounts_charts_of_accounts.ca_name AS account_name
                FROM {$this->db->getPrefix()}accounts_petty_cash_voucher
                LEFT JOIN {$this->db->getPrefix()}accounts_petty_cash_debits ON {$this->db->getPrefix()}accounts_petty_cash_debits.pci_voucher_id = {$pcv_table}.pcv_id
                LEFT JOIN {$this->db->getPrefix()}accounts_petty_cash_debit_invoices ON {$this->db->getPrefix()}accounts_petty_cash_debit_invoices.pcdi_debit_id = {$this->db->getPrefix()}accounts_petty_cash_debits.pci_id
                LEFT JOIN {$this->db->getPrefix()}accounts_charts_of_accounts ON {$this->db->getPrefix()}accounts_charts_of_accounts.ca_id = {$this->db->getPrefix()}accounts_petty_cash_voucher.pcv_credit_account
                LEFT JOIN {$this->db->getPrefix()}accounts_charts_of_accounts AS credit_account_receipt ON credit_account_receipt.ca_id = {$this->db->getPrefix()}accounts_petty_cash_debits.pci_debit_account
                LEFT JOIN {$this->db->getPrefix()}crm_customer_creation ON {$this->db->getPrefix()}crm_customer_creation.cc_id = {$this->db->getPrefix()}accounts_charts_of_accounts.ca_customer
                LEFT JOIN {$this->db->getPrefix()}accounts_account_heads ON {$this->db->getPrefix()}accounts_account_heads.ah_id = {$this->db->getPrefix()}accounts_charts_of_accounts.ca_account_type
                LEFT JOIN {$this->db->getPrefix()}accounts_account_types ON {$this->db->getPrefix()}accounts_account_types.at_id = {$this->db->getPrefix()}accounts_account_heads.ah_id
                ";


                if(!empty($time_frame) || $account_type !="" ||  !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to))
            {

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
                $query .= "YEAR({$pcv_table}.pcv_date) = YEAR(CURRENT_DATE()) ";
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
            $query .= "credit_account_receipt.ca_id = {$account} ";

            }

            if($range_from !="")
            {

            if ($account_head != "" || $account_type != "" || $time_frame != "") {
                $query .= "AND ";
            }

            $query .="{$this->db->getPrefix()}accounts_account_heads.ah_head_id >= {$range_from} ";

            }

            if($range_to !="")
            {

            if ($account_head != "" || $account_type != "" || $time_frame != "" || $range_from !="") {
                $query .= "AND ";
            }

            $query .="{$this->db->getPrefix()}accounts_account_heads.ah_head_id <= {$range_to} ";

            }

            $query .="GROUP BY {$this->db->getPrefix()}accounts_petty_cash_debits.pci_id";

            $query .= ")";


            //Petty Cash Debit

                $query .= "UNION ALL
                (SELECT 
                    {$pcv_table}.pcv_id AS id,
                    {$pcv_table}.pcv_voucher_no AS reference,
                    {$this->db->getPrefix()}accounts_account_heads.ah_head_id as head_id,
                    {$pcv_table}.pcv_date AS transaction_date,
                NULL AS credit_amount,
                {$this->db->getPrefix()}accounts_petty_cash_debits.pci_amount AS debit_amount,
                'Petty Cash Voucher' as voucher_type,
                {$this->db->getPrefix()}accounts_charts_of_accounts.ca_id AS account_id,
                {$this->db->getPrefix()}accounts_charts_of_accounts.ca_name AS account_name
                FROM {$this->db->getPrefix()}accounts_petty_cash_voucher 
                LEFT JOIN {$this->db->getPrefix()}accounts_petty_cash_debits ON {$this->db->getPrefix()}accounts_petty_cash_debits.pci_voucher_id = {$pcv_table}.pcv_id
                LEFT JOIN {$this->db->getPrefix()}accounts_petty_cash_debit_invoices ON {$this->db->getPrefix()}accounts_petty_cash_debit_invoices.pcdi_debit_id = {$this->db->getPrefix()}accounts_petty_cash_debits.pci_id
                LEFT JOIN {$this->db->getPrefix()}accounts_charts_of_accounts ON {$this->db->getPrefix()}accounts_charts_of_accounts.ca_id = {$this->db->getPrefix()}accounts_petty_cash_debits.pci_debit_account
                LEFT JOIN {$this->db->getPrefix()}accounts_charts_of_accounts AS credit_account_receipt ON credit_account_receipt.ca_id = {$this->db->getPrefix()}accounts_petty_cash_debits.pci_debit_account
                LEFT JOIN {$this->db->getPrefix()}crm_customer_creation ON {$this->db->getPrefix()}crm_customer_creation.cc_id = {$this->db->getPrefix()}accounts_charts_of_accounts.ca_customer
                LEFT JOIN {$this->db->getPrefix()}accounts_account_heads ON {$this->db->getPrefix()}accounts_account_heads.ah_id = {$this->db->getPrefix()}accounts_charts_of_accounts.ca_account_type
                LEFT JOIN {$this->db->getPrefix()}accounts_account_types ON {$this->db->getPrefix()}accounts_account_types.at_id = {$this->db->getPrefix()}accounts_account_heads.ah_id
                ";




            if(!empty($time_frame) || $account_type != "" ||  !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to))
            {

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
                $query .= "YEAR({$pcv_table}.pcv_date) = YEAR(CURRENT_DATE()) ";
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

            $query .= "{$pcv_table}.pcv_credit_account = {$account} ";

            //$query .= "credit_account_receipt.ca_id = {$account} ";

            }

            if($range_from !="")
            {

            if ($account_head != "" || $account_type != "" || $time_frame != "") {
                $query .= "AND ";
            }

            $query .="{$this->db->getPrefix()}accounts_account_heads.ah_head_id >= {$range_from} ";

            }

            if($range_to !="")
            {

            if ($account_head != "" || $account_type != "" || $time_frame != "" || $range_from !="") {
                $query .= "AND ";
            }

            $query .="{$this->db->getPrefix()}accounts_account_heads.ah_head_id <= {$range_to}";

            }

            //$query .="GROUP BY {$this->db->getPrefix()}accounts_petty_cash_debits.pci_id";

            $query .= ")";


        //Petty Cash Voucher End




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


if(!empty($time_frame) || $account_type != "" ||  !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to))
{

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

if($range_from !="")
{

if ($account_head != "" || $account_type != "" || $time_frame != "") {
    $query .= "AND ";
}

$query .="{$this->db->getPrefix()}accounts_account_heads.ah_head_id >= {$range_from} ";

}

if($range_to !="")
{

if ($account_head != "" || $account_type != "" || $time_frame != "" || $range_from !="") {
    $query .= "AND ";
}

$query .="{$this->db->getPrefix()}accounts_account_heads.ah_head_id <= {$range_to} ";

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


if(!empty($time_frame) || $account_type != "" ||  !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to))
{

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

if($range_from !="")
{

if ($account_head != "" || $account_type != "" || $time_frame != "") {
    $query .= "AND ";
}

$query .="{$this->db->getPrefix()}accounts_account_heads.ah_head_id >= {$range_from} ";

}

if($range_to !="")
{

if ($account_head != "" || $account_type != "" || $time_frame != "" || $range_from !="") {
    $query .= "AND ";
}   

$query .="{$this->db->getPrefix()}accounts_account_heads.ah_head_id <= {$range_to} ";

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


if(!empty($time_frame) || $account_type != "" ||  !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to))
{

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

if($range_from !="")
{

if ($account_head != "" || $account_type != "" || $time_frame != "") {
$query .= "AND ";
}

$query .="{$this->db->getPrefix()}accounts_account_heads.ah_head_id >= {$range_from} ";

}

if($range_to !="")
{

if ($account_head != "" || $account_type != "" || $time_frame != "" || $range_from !="") {
$query .= "AND ";
}

$query .="{$this->db->getPrefix()}accounts_account_heads.ah_head_id <= {$range_to} ";

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


if(!empty($time_frame) || $account_type != "" ||  !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to))
{

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

if($range_from !="")
{

if ($account_head != "" || $account_type != "" || $time_frame != "") {
$query .= "AND ";
}

$query .="{$this->db->getPrefix()}accounts_account_heads.ah_head_id >= {$range_from} ";

}

if($range_to !="")
{

if ($account_head != "" || $account_type != "" || $time_frame != "" || $range_from !="") {
$query .= "AND ";
}

$query .="{$this->db->getPrefix()}accounts_account_heads.ah_head_id <= {$range_to} ";

}


$query .= ")";






//Credit Invoice Select End




//Journal Start

/*

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


if(!empty($time_frame) || $account_type != "" ||  !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to))
{

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

if($range_from !="")
{

if ($account_head != "" || $account_type != "" || $time_frame != "") {
$query .= "AND ";
}

$query .="{$this->db->getPrefix()}accounts_account_heads.ah_head_id >= {$range_from} ";

}

if($range_to !="")
{

if ($account_head != "" || $account_type != "" || $time_frame != "" || $range_from !="") {
$query .= "AND ";
}

$query .="{$this->db->getPrefix()}accounts_account_heads.ah_head_id <= {$range_to} ";

}


$query .= ")";

*/


$query .= "UNION ALL 
(SELECT 
    ji_id AS id,
    jv.jv_voucher_no AS reference,
    ah.ah_head_id AS head_id,
    jv.jv_date AS transaction_date,
    ji_credit AS credit_amount,
    ji_debit AS debit_amount,
    'Journal Voucher' AS voucher_type,
    ca.ca_id AS account_id,
    ca.ca_name AS account_name
FROM {$this->db->getPrefix()}accounts_journal_invoices AS ji
LEFT JOIN {$this->db->getPrefix()}accounts_journal_vouchers AS jv ON jv.jv_id = ji.ji_voucher_id
LEFT JOIN {$this->db->getPrefix()}accounts_charts_of_accounts AS ca ON ca.ca_id = ji.ji_account
LEFT JOIN {$this->db->getPrefix()}accounts_account_heads AS ah ON ah.ah_id = ca.ca_account_type
LEFT JOIN {$this->db->getPrefix()}accounts_account_types AS at ON at.at_id = ah.ah_id";


if (!empty($time_frame) || $account_type != "" || !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to)) {
    $query .= " WHERE ";
}


if ($time_frame != "") {
    if ($time_frame == "Range") {
        if ($date_from != "") {
            $query .= "jv.jv_date >= '{$date_from}' ";
        }

        if ($date_to != "") {
            if ($date_from != "") {
                $query .= "AND ";
            }
            $query .= "jv.jv_date <= '{$date_to}' ";
        }
    } elseif ($time_frame == "Month") {
        $query .= "YEAR(jv.jv_date) = YEAR(CURRENT_DATE()) 
            AND MONTH(jv.jv_date) = MONTH(CURRENT_DATE()) ";
    } elseif ($time_frame == "Year") {
        $query .= "YEAR(jv.jv_date) = YEAR(CURRENT_DATE())";
    }
}

if ($account_head != "") {
    if ($time_frame != "" || $date_from != "" || $date_to != "") {
        $query .= "AND ";
    }
    //$query .= "ah.ah_id = {$account_head} ";
   $query .= "ji.ji_voucher_id IN (    
        SELECT DISTINCT ji_inner.ji_voucher_id
        FROM {$this->db->getPrefix()}accounts_journal_invoices AS ji_inner
        LEFT JOIN {$this->db->getPrefix()}accounts_charts_of_accounts AS ca_head ON ca_head.ca_id = ji_inner.ji_account
        LEFT JOIN {$this->db->getPrefix()}accounts_account_heads AS ah_head ON ah_head.ah_id = ca_head.ca_account_type
        WHERE ah_head.ah_id = {$account_head}
    )
    AND ah.ah_id != {$account_head}";

}

if ($account_type != "") {
    if ($account_head != "" || $time_frame != "") {
        $query .= "AND ";
    }
    //$query .= "at.at_id = {$account_type} ";

    $query .= "ji.ji_voucher_id IN (    
        SELECT DISTINCT ji_voucher_id
        FROM {$this->db->getPrefix()}accounts_journal_invoices AS ji_inner
        LEFT JOIN {$this->db->getPrefix()}accounts_charts_of_accounts AS ca_type ON ca_type.ca_id = ji_inner.ji_account
        LEFT JOIN {$this->db->getPrefix()}accounts_account_heads AS ah_type ON ah_type.ah_id = ca_type.ca_account_type
        LEFT JOIN {$this->db->getPrefix()}accounts_account_types AS at_type ON at_type.at_id = ah_type.ah_id
        WHERE at_type.at_id = {$account_type}
    )
    AND ah.ah_id NOT IN (
        SELECT ah_head.ah_id
        FROM {$this->db->getPrefix()}accounts_account_heads AS ah_head
        WHERE ah_head.ah_id = {$account_type}
    )";

}

if ($account != "") {
    if ($account_head != "" || $account_type != "" || $time_frame != "" || $date_from != "" || $date_to != "") {
        $query .= "AND ";
    }
    //$query .= "{$this->db->getPrefix()}accounts_charts_of_accounts.ca_id = {$account} ";

    $query .= "ji.ji_voucher_id IN (    
            SELECT DISTINCT ji_voucher_id
            FROM {$this->db->getPrefix()}accounts_journal_invoices
            WHERE {$this->db->getPrefix()}accounts_journal_invoices.ji_account = {$account}
        )
        AND ji.ji_account != {$account}";

}

if ($range_from != "") {
    if ($account_head != "" || $account_type != "" || $time_frame != "") {
        $query .= "AND ";
    }
    $query .= "ah.ah_head_id >= {$range_from} ";
}

if ($range_to != "") {
    if ($account_head != "" || $account_type != "" || $time_frame != "" || $range_from != "") {
        $query .= "AND ";
    }
    $query .= "ah.ah_head_id <= {$range_to} ";
}

$query .= ")";

//Journal End




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

if(!empty($time_frame) || $account_type != "" ||  !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to))
{

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

if($range_from !="")
{

if ($account_head != "" || $account_type != "" || $time_frame != "") {
$query .= "AND ";
}

$query .="{$this->db->getPrefix()}accounts_account_heads.ah_head_id >= {$range_from} ";

}

if($range_to !="")
{

if ($account_head != "" || $account_type != "" || $time_frame != "" || $range_from !="") {
$query .= "AND ";
}

$query .="{$this->db->getPrefix()}accounts_account_heads.ah_head_id <= {$range_to} ";

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

if(!empty($time_frame) || $account_type != "" ||  !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to))
{

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

if($range_from !="")
{

if ($account_head != "" || $account_type != "" || $time_frame != "") {
$query .= "AND ";
}

$query .="{$this->db->getPrefix()}accounts_account_heads.ah_head_id >= {$range_from} ";

}

if($range_to !="")
{

if ($account_head != "" || $account_type != "" || $time_frame != "" || $range_from !="") {
$query .= "AND ";
}

$query .="{$this->db->getPrefix()}accounts_account_heads.ah_head_id <= {$range_to} ";

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

if(!empty($time_frame) || $account_type != "" ||  !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to))
{

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

if($range_from !="")
{

if ($account_head != "" || $account_type != "" || $time_frame != "") {
$query .= "AND ";
}

$query .="{$this->db->getPrefix()}accounts_account_heads.ah_head_id >= {$range_from} ";

}

if($range_to !="")
{

if ($account_head != "" || $account_type != "" || $time_frame != "" || $range_from !="") {
$query .= "AND ";
}

$query .="{$this->db->getPrefix()}accounts_account_heads.ah_head_id <= {$range_to} ";

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

if(!empty($time_frame) || $account_type != "" || !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to))
{

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

if($range_from !="")
{

if ($account_head != "" || $account_type != "" || $time_frame != "") {
$query .= "AND ";
}

$query .="{$this->db->getPrefix()}accounts_account_heads.ah_head_id >= {$range_from} ";

}

if($range_to !="")
{

if ($account_head != "" || $account_type != "" || $time_frame != "" || $range_from !="") {
$query .= "AND ";
}

$query .="{$this->db->getPrefix()}accounts_account_heads.ah_head_id <= {$range_to} ";

}

$query .="GROUP BY {$this->db->getPrefix()}pro_purchase_voucher_prod.pvp_reffer_id";

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

if(!empty($time_frame) || $account_type != "" || !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to))
{

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

if($range_from !="")
{

if ($account_head != "" || $account_type != "" || $time_frame != "") {
$query .= "AND ";
}

$query .="{$this->db->getPrefix()}accounts_account_heads.ah_head_id >= {$range_from} ";

}

if($range_to !="")
{

if ($account_head != "" || $account_type != "" || $time_frame != "" || $range_from !="") {
$query .= "AND ";
}

$query .="{$this->db->getPrefix()}accounts_account_heads.ah_head_id <= {$range_to} ";

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

if(!empty($time_frame) || $account_type !="" || !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to))
{   

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

if($range_from !="")
{

if ($account_head != "" || $account_type != "" || $time_frame != "") {
$query .= "AND ";
}

$query .="{$this->db->getPrefix()}accounts_account_heads.ah_head_id >= {$range_from} ";

}

if($range_to !="")
{

if ($account_head != "" || $account_type != "" || $time_frame != "" || $range_from !="") {
$query .= "AND ";
}

$query .="{$this->db->getPrefix()}accounts_account_heads.ah_head_id <= {$range_to} ";

}

$query .="AND {$this->db->getPrefix()}accounts_receipt_invoices.ri_amount>1 ";

$query .="GROUP BY {$this->db->getPrefix()}accounts_receipt_invoices.ri_id";

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

if(!empty($time_frame) || $account_type !="" || !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to))
{   

$query .= "WHERE ";

}


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

if($range_from !="")
{

if ($account_head != "" || $account_type != "" || $time_frame != "") {
$query .= "AND ";
}

$query .="{$this->db->getPrefix()}accounts_account_heads.ah_head_id >= {$range_from} ";

}

if($range_to !="")
{

if ($account_head != "" || $account_type != "" || $time_frame != "" || $range_from !="") {
$query .= "AND ";
}

$query .="{$this->db->getPrefix()}accounts_account_heads.ah_head_id <= {$range_to} ";

}

$query .="AND {$this->db->getPrefix()}accounts_receipt_invoices.ri_amount<1 ";

$query .="GROUP BY {$this->db->getPrefix()}accounts_receipt_invoices.ri_id";

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

if(!empty($time_frame) || $account_type != "" || !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to))
{

$query .= "WHERE ";

}

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

if($range_from !="")
{

if ($account_head != "" || $account_type != "" || $time_frame != "") {
$query .= "AND ";
}

$query .="{$this->db->getPrefix()}accounts_account_heads.ah_head_id >= {$range_from} ";

}

if($range_to !="")
{

if ($account_head != "" || $account_type != "" || $time_frame != "" || $range_from !="") {
$query .= "AND ";
}

$query .="{$this->db->getPrefix()}accounts_account_heads.ah_head_id <= {$range_to} ";

}

$query .="AND {$this->db->getPrefix()}accounts_receipt_invoices.ri_amount>0 ";

$query .="GROUP BY {$this->db->getPrefix()}accounts_receipt_invoices.ri_id";

$query .= ")";
 

//$account_head != "" || $account_type != ""

if($account_head != "")
{
$query .= " ORDER BY account_name ASC";
}
else{
$query .= " ORDER BY transaction_date ASC,id ASC";
}


    //echo $query; exit;
    
    $result = $this->db->query($query)->getResult();

    //  $query = $this->db->getLastQuery();
    //  echo (string)$query;
    //  exit;

    return $result;
}







public function FetchGlBalance($date_from, $date_to, $account_head="", $account_type="", $account, $time_frame="",$range_from="",$range_to="")
{

    $result = array();

    $transactions = $this->FetchGLTransactions($date_from, $date_to, $account_head="", $account_type="", $account, $time_frame="",$range_from="",$range_to="");

    $result['begining_balance'] = 0;

    $result['total_credit'] = array_sum(array_column($transactions,'credit_amount'));

    $result['total_debit'] = array_sum(array_column($transactions,'debit_amount'));

    $result['balance'] = $result['begining_balance'] + $result['total_debit'] - $result['total_credit'];

    return $result;

}










public function FetchGLCashInvoice()
{

$query = $this->db->table('crm_cash_invoice');

$query->select('*');

return $query->get()->getResult();


}




public function FetchGLOpenBalance($date_from, $date_to, $account_head, $account_type, $account, $time_frame)
    {

        $query = $this->db->table('master_transactions');

        //  $query = $this->db->query('SELECT SUM(tran_credit) - SUM(tran_debit) AS total_balance FROM '.$this->db->getPrefix().'master_transactions WHERE (tran_datetime<= CONVERT( \''.date("Y-m-d",strtotime($date_to)).'\' , DATETIME)) && (tran_account = '.$account.')');

        $query->select('SUM(tran_credit) - SUM(tran_debit) AS total_balance', FALSE);

        $query->join('accounts_charts_of_accounts','accounts_charts_of_accounts.ca_id=master_transactions.tran_account','left');

        $query->join('accounts_account_heads','accounts_account_heads.ah_id=accounts_charts_of_accounts.ca_account_type','left');

        $query->join('accounts_account_types','accounts_account_types.at_id=accounts_account_heads.ah_account_type','left');


        if($time_frame!="")
        {

        if($time_frame=="Range")
            {

        if($date_from!="")
        {
        $query->where('tran_datetime>=',$date_from);
        }

        if($date_to!="")
        {
        $query->where('tran_datetime<=',$date_to);
        }
            }

            if($time_frame=="Month")
            {

                $query->where('year(tran_datetime)',date('Y'));
                $query->where('month(tran_datetime)',date('m'));

            }

            if($time_frame=="Year")
            {

                $query->where('year(tran_datetime)',date('Y',strtotime("-1 year")));

            }


        }


        if($account_head!="")
        {
        $query->where('accounts_account_heads.ah_id',$account_head);
        }

        if($account!="")
        {
        $query->where('accounts_charts_of_accounts.ca_id',$account);    
        }

        $result = $query->get()->getRow();


        return $result->total_balance;

      

    }







    // General Ledger Report End







    //Statement Of Accounts Start


    public function SOAVouchers($date_from,$date_to,$account)
    {

    $payment_table = "{$this->db->getPrefix()}accounts_payments";

    $receipt_table = "{$this->db->getPrefix()}accounts_receipts";

    $pcv_table = "";

    $query = "";

    
    if(!empty($date_from))
    {

    $time_frame ="Range";

    }

    else
    {

    $time_frame ="";

    }


    $result['vouchers'] = $this->FetchGLTransactions($date_from,$date_to, $account_head="", $account_type="", $account, $time_frame,$range_from="",$range_to="");
  
                $query .= "
                (SELECT 
                    {$payment_table}.pay_id AS id,
                    {$payment_table}.pay_ref_no AS reference,
                    {$this->db->getPrefix()}accounts_account_heads.ah_head_id as head_id,
                    {$payment_table}.pay_date AS transaction_date,
                    {$payment_table}.pay_amount AS amount,
                    'Payment' as voucher_type,
                    {$payment_table}.pay_method as method,
                    {$payment_table}.pay_cheque_no as cheque_no,
                    {$payment_table}.pay_cheque_date as cheque_date,
                    {$payment_table}.pay_bank as bank,
                    {$this->db->getPrefix()}accounts_charts_of_accounts.ca_id AS account_id,
                    {$this->db->getPrefix()}accounts_charts_of_accounts.ca_name AS account_name
                FROM {$this->db->getPrefix()}accounts_payments
                LEFT JOIN {$this->db->getPrefix()}accounts_charts_of_accounts ON {$this->db->getPrefix()}accounts_charts_of_accounts.ca_id = {$payment_table}.pay_credit_account
                LEFT JOIN {$this->db->getPrefix()}accounts_account_heads ON {$this->db->getPrefix()}accounts_account_heads.ah_id = {$this->db->getPrefix()}accounts_charts_of_accounts.ca_account_type
                LEFT JOIN {$this->db->getPrefix()}accounts_account_types ON {$this->db->getPrefix()}accounts_account_types.at_id = {$this->db->getPrefix()}accounts_account_heads.ah_id
                ";


                $query .= "WHERE {$payment_table}.pay_method = 1 and ";

            //     if(!empty($time_frame) || $account_type !="" ||  !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to))
            // {

            // $query .= "WHERE ";

            // }

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
            $query .= "{$this->db->getPrefix()}
            .ah_id = {$account_head} ";
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

            if($range_from !="")
            {

            if ($account_head != "" || $account_type != "" || $time_frame != "") {
                $query .= "AND ";
            }

            $query .="{$this->db->getPrefix()}accounts_account_heads.ah_head_id >= {$range_from} ";

            }

            if($range_to !="")
            {

            if ($account_head != "" || $account_type != "" || $time_frame != "" || $range_from !="") {
                $query .= "AND ";
            }

            $query .="{$this->db->getPrefix()}accounts_account_heads.ah_head_id <= {$range_to} ";

            }

            


            $query .= ")";


           

                    

                $query .= "UNION ALL
                (SELECT 
                    {$receipt_table}.r_id AS id,
                    {$receipt_table}.r_ref_no AS reference,
                    {$this->db->getPrefix()}accounts_account_heads.ah_head_id as head_id,
                    {$receipt_table}.r_date AS transaction_date,
                    {$receipt_table}.r_amount AS amount,
                    'Receipt' as voucher_type,
                    {$receipt_table}.r_method as method,
                    {$receipt_table}.r_cheque_no as cheque_no,
                    {$receipt_table}.r_cheque_date as cheque_date,
                    {$receipt_table}.r_bank as bank,
                    {$this->db->getPrefix()}accounts_charts_of_accounts.ca_id AS account_id,
                    {$this->db->getPrefix()}accounts_charts_of_accounts.ca_name AS account_name
                FROM {$this->db->getPrefix()}accounts_receipts 
                LEFT JOIN {$this->db->getPrefix()}accounts_charts_of_accounts ON {$this->db->getPrefix()}accounts_charts_of_accounts.ca_id = {$receipt_table}.r_debit_account
                LEFT JOIN {$this->db->getPrefix()}crm_customer_creation ON {$this->db->getPrefix()}crm_customer_creation.cc_id = {$this->db->getPrefix()}accounts_charts_of_accounts.ca_customer
                LEFT JOIN {$this->db->getPrefix()}accounts_account_heads ON {$this->db->getPrefix()}accounts_account_heads.ah_id = {$this->db->getPrefix()}accounts_charts_of_accounts.ca_account_type
                LEFT JOIN {$this->db->getPrefix()}accounts_account_types ON {$this->db->getPrefix()}accounts_account_types.at_id = {$this->db->getPrefix()}accounts_account_heads.ah_id
                ";


                $query .= "WHERE {$receipt_table}.r_method = 1 and ";

            //     if(!empty($time_frame) || $account_type != "" ||  !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to))
            // {

            // $query .= "WHERE ";

            // }

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

            $query .= "{$receipt_table}.r_debit_account = {$account} ";

            }

            if($range_from !="")
            {

            if ($account_head != "" || $account_type != "" || $time_frame != "") {
                $query .= "AND ";
            }

            $query .="{$this->db->getPrefix()}accounts_account_heads.ah_head_id >= {$range_from} ";

            }

            if($range_to !="")
            {

            if ($account_head != "" || $account_type != "" || $time_frame != "" || $range_from !="") {
                $query .= "AND ";
            }

            $query .="{$this->db->getPrefix()}accounts_account_heads.ah_head_id <= {$range_to} ";

            }

            $query .= ")";



            $result['pdc'] = $this->db->query($query)->getResult();

            

            // echo "<pre>";

            //  print_r($result);

            //  echo "</pre>";

            //  exit;


            return $result;
    }


    
    public function SOAPostDatedCheques($date_from,$date_to,$account)
    {

        $query = $this->db->table('accounts_receipts');

        $query->where('r_method',1);

        $query->join('master_banks','master_banks.bank_id=accounts_receipts.r_bank','left');

        if($date_from!="")
        {
        $query->where('r_date>=',$date_from);
        }

        if($date_to!="")
        {
        $query->where('r_date<=',$date_to);
        }
        

        if($account!="")
        {
        $query->where('accounts_receipts.r_debit_account',$account);    
        }

        return $query->get()->getResult();

    }


    public function SOAReceipts($date_from,$date_to,$account)
    {

        $query = $this->db->table('accounts_receipts');

        $query->join('accounts_charts_of_accounts','accounts_charts_of_accounts.ca_id=accounts_receipts.r_debit_account','left');

        //$query->join('accounts_account_heads','accounts_account_heads.ah_id=crm_customer_creation.cc_account_head','left');

        //$query->join('accounts_account_types','accounts_account_types.at_id=accounts_account_heads.ah_id','left');

        if($date_from!="")
        {
        $query->where('r_date>=',$date_from);
        }

        if($date_to!="")
        {
        $query->where('r_date<=',$date_to);
        }
            

        if($account!="")
        {
        $query->where('accounts_receipts.r_debit_account',$account);    
        }



        return $query->get()->getResult();

    }



    public function SOAPayments($date_from,$date_to,$account)
    {

        $query = $this->db->table('accounts_payments');

        $query->join('accounts_charts_of_accounts','accounts_charts_of_accounts.ca_id=accounts_payments.pay_credit_account','left');

        //$query->join('accounts_account_heads','accounts_account_heads.ah_id=crm_customer_creation.cc_account_head','left');

        //$query->join('accounts_account_types','accounts_account_types.at_id=accounts_account_heads.ah_id','left');

        if($date_from!="")
        {
        $query->where('pay_date>=',$date_from);
        }

        if($date_to!="")
        {
        $query->where('pay_date<=',$date_to);
        }
           

        if($account!="")
        {
        $query->where('accounts_payments.pay_credit_account',$account);    
        }

        return $query->get()->getResult();

    }


        //Statement Of Accounts End




        //Aged RP Start




        public function AgedRPTransactions($date_to,$account_head,$account_type,$account)
        {   

            
        if(empty($date_to))
        {

        $date_to = date('Y-m-d');

        }


        /*
        $query = $this->db->table('accounts_charts_of_accounts');

        $query->join('accounts_account_heads','accounts_account_heads.ah_id=accounts_charts_of_accounts.ca_account_type','left');

        $query->join('accounts_account_types','accounts_account_types.at_id=accounts_account_heads.ah_account_type','left');

        $query->groupStart();

        $query->where('at_name',"Accounts Receivable");

        $query->orWhere('at_name',"Accounts Payable");

        $query->groupEnd();

        $query->orderBy('ca_name','asc');

        $result = $query->get()->getResult();

        */
        
        //$return = new \stdClass();


        /*
        $i=0;

        foreach($result as $res)
        {
        
        */

        $return = $this->FetchGLTransactions($date_from="",$date_to, $account_head="", $account_type="", $account, $time_frame="Range",$range_from="",$range_to="");
  
        /*
        $i++;
        }
        */

        return $return;

        }



        public function AgedRPBalance($date_from,$account_head,$account_type,$account)
        {

        $query= $this->db->table('master_transactions');

        $query->select('SUM(tran_credit) - SUM(tran_debit) AS total_balance', FALSE);

        $query->join('accounts_charts_of_accounts','accounts_charts_of_accounts.ca_id=master_transactions.tran_account','left');

        $query->join('accounts_account_heads','accounts_account_heads.ah_id=accounts_charts_of_accounts.ca_account_type','left');

        $query->join('accounts_account_types','accounts_account_types.at_id=accounts_account_heads.ah_account_type','left');

        
        if ($date_from != "") {
            
            $query->where('tran_datetime<=',$date_from);

        }


        if ($account_head != "") {
           
            $query->where('accounts_account_heads.ah_id',$account_head);

        }

        if ($account != "") {
           
            $query->where('accounts_charts_of_accounts.ca_id',$account);
    
        }

        $result =  $query->get()->getRow();


        return $result->total_balance;


        }







        public function ARPReceipts($date_from,$account_head,$account_type,$account)
        {
    
            $query = $this->db->table('accounts_receipts');
    
            $query->join('crm_customer_creation','crm_customer_creation.cc_id=accounts_receipts.r_debit_account','left');
    
            $query->join('accounts_account_heads','accounts_account_heads.ah_id=crm_customer_creation.cc_account_head','left');
    
            $query->join('accounts_account_types','accounts_account_types.at_id=accounts_account_heads.ah_id','left');
    
    
            if($date_from!="")
            {
            $query->where('r_date>=',$date_from);
            }
    

            if($account_head!="")
            {
            $query->where('accounts_account_heads.ah_id',$account_head);
            }
    
    
            if($account_type!="")
            {
            $query->where('accounts_account_types.at_id',$account_type);
            }
    
            if($account!="")
            {
            $query->where('accounts_receipts.r_debit_account',$account);    
            }
    
    
    
            return $query->get()->getResult();
    
        }



        public function ARPReceiptPDC($date_from,$account_head,$account_type,$account)
        {
    
            $query = $this->db->table('accounts_receipts');

            $query->where('r_method',1);

            $query->join('master_banks','master_banks.bank_id=accounts_receipts.r_bank','left');
    
            $query->join('accounts_charts_of_accounts','accounts_charts_of_accounts.ca_id=accounts_receipts.r_debit_account','left');
    
            $query->join('accounts_account_heads','accounts_account_heads.ah_id=accounts_charts_of_accounts.ca_account_type','left');
    
            $query->join('accounts_account_types','accounts_account_types.at_id=accounts_account_heads.ah_id','left');
    
    
            if($date_from!="")
            {
            $query->where('r_cheque_date>=',$date_from);
            }
    
            
            if($account_head!="")
            {
            $query->where('accounts_account_heads.ah_id',$account_head);
            }
    
    
            if($account_type!="")
            {
            $query->where('accounts_account_types.at_id',$account_type);
            }
    
            if($account!="")
            {
            $query->where('accounts_receipts.r_debit_account',$account);    
            }
    
    
    
            return $query->get()->getResult();
    
        }


    
    
    
        public function ARPPayments($date_from,$account_head,$account_type,$account)
        {
    
            $query = $this->db->table('accounts_payments');
    
            $query->join('accounts_charts_of_accounts','accounts_charts_of_accounts.ca_id=accounts_payments.pay_credit_account','left');
    
            $query->join('accounts_account_heads','accounts_account_heads.ah_id=accounts_charts_of_accounts.ca_account_type','left');
    
            $query->join('accounts_account_types','accounts_account_types.at_id=accounts_account_heads.ah_id','left');
    
    
            if($date_from!="")
            {
            $query->where('pay_date>=',$date_from);
            }
    
            if($account_head!="")
            {
            $query->where('accounts_account_heads.ah_id',$account_head);
            }
    
            if($account_head!="")
            {
            $query->where('accounts_account_heads.ah_id',$account_head);
            }
    
            if($account!="")
            {
            $query->where('accounts_payments.pay_credit_account',$account);    
            }
    
            //$query->get();
    
            //echo $this->db->getLastQuery(); die;
    
    
            return $query->get()->getResult();
    
        }


        //Aged RP End






        //Trial Balance Report


        /*
        public function TrialBalance($time_frame,$date_from,$date_to)
        {

        $today = date('Y-m-d');

        $query = $this->db->table('master_transactions');

        $query->join('accounts_charts_of_accounts','accounts_charts_of_accounts.ca_id=master_transactions.tran_account','left');

        $query->groupBy('master_transactions.tran_account');

        $query->orderBy('accounts_charts_of_accounts.ca_name','asc');

        if($time_frame!="")
        {

            if($time_frame=="Range")
            {
                if($date_from!="")
                {
                $query->where('tran_datetime>=',$date_from);
                }

                if($date_to!="")
                {
                $query->where('tran_datetime<=',$date_to);
                }
            }

            if($time_frame=="Month")
            {

                $date_from = date("Y-m-01", strtotime($today));

                $date_to = date("Y-m-t", strtotime($today));

                $query->where('tran_datetime>=',$date_from);
                $query->where('tran_datetime<=',$date_to);

            }

            if($time_frame=="Year")
            {

                $date_from = date("Y-01-01", strtotime($today));

                $date_to = date("Y-12-t", strtotime($today));

                $query->where('tran_datetime>=',$date_from);
                $query->where('tran_datetime<=',$date_to);

            }

        }

        $result = $query->get()->getResult();

        $i=0;

        foreach($result as $ac)
        {

        //$result[$i]->start_balance = $this->StartBalance($ac->tran_account,$date_from);

        $result[$i]->total_credit = $this->FetchSum('master_transactions','tran_credit',array('tran_account' => $ac->tran_account,'tran_datetime>=' => $date_from,'tran_datetime<=' =>$date_to));

        $result[$i]->total_debit = $this->FetchSum('master_transactions','tran_debit',array('tran_account' => $ac->tran_account,'tran_datetime>=' => $date_from,'tran_datetime<=' =>$date_to));

        $result[$i]->start_balance = $this->StartBalance($ac->tran_account,$date_from);

        $net_change = $result[$i]->total_credit-$result[$i]->total_debit;

        $balance = $result[$i]->total_credit-$result[$i]->total_debit+$result[$i]->start_balance;

        $result[$i]->balance = number_format($balance,2);
        
        $result[$i]->net_change = number_format($net_change,2);

        $i++;

        }

        // echo "<pre>";
        // print_r($result); exit;
        // echo "</pre>";

        return $result;

        }

        */



        public function TrialBalance($time_frame,$date_from,$date_to)
        {

            $query = $this->db->table('accounts_charts_of_accounts');  
            
            $query->orderBy('ca_name','asc');

            $result = $query->get()->getResult();

            $i=0;

            foreach($result as $res)
            {

            $id = $res->ca_id;

            //Cash invoice

            $result[$i]->transactions = $this->FetchGLTransactions($date_from, $date_to, $account_head="", $account_type="", $account=$id, $time_frame,$range_from="",$range_to="");

            $result[$i]->begining_balance = 0;

            $result[$i]->total_credit = array_sum(array_column($result[$i]->transactions,'credit_amount'));

            $result[$i]->total_debit = array_sum(array_column($result[$i]->transactions,'debit_amount'));

            $result[$i]->net_change = $result[$i]->total_debit-$result[$i]->total_credit;

            $result[$i]->ending_balance = $result[$i]->begining_balance + $result[$i]->net_change;

            $i++;

            }

            return $result;

        }
        
           //Profit Loss Account Start

           public function FetchPLAccount($timeframe,$date_from,$date_to)
           {
              
           $query = $this->db->table('accounts_charts_of_accounts');

           $query->join('accounts_account_heads','accounts_account_heads.ah_id=accounts_charts_of_accounts.ca_account_type','left');

           $query->join('accounts_account_types','accounts_account_types.at_id=accounts_account_heads.ah_account_type','left');

           $query->groupStart();

           $query->where('at_name',"Expenses");

           $query->orWhere('at_name',"Cost of Sales");

           $query->orWhere('at_name',"Income");

           $query->groupEnd();
   
           $query->orderBy('ca_name','asc');
   
           $result = $query->get()->getResult();
   
           $i=0;

           foreach($result as $res)
           {

            $id = $res->ca_id;

            $result[$i]->transactions_month = $this->FetchGLTransactions($date_from,$date_to, $account_head="", $account_type="", $account=$id, $timeframe,$range_from="",$range_to="");

            $result[$i]->begining_balance_month = 0;

            $result[$i]->total_credit_month = array_sum(array_column($result[$i]->transactions_month,'credit_amount'));

            $result[$i]->total_debit_month = array_sum(array_column($result[$i]->transactions_month,'debit_amount'));

            $result[$i]->net_change_month = $result[$i]->total_debit_month-$result[$i]->total_credit_month;

            $result[$i]->ending_balance_month = $result[$i]->begining_balance_month + $result[$i]->net_change_month;


            $date_year_from = date("Y-01-01", strtotime($date_from));

            $date_year_to = date("Y-12-t",strtotime($date_to));

            $result[$i]->transactions_year = $this->FetchGLTransactions($date_year_from,$date_year_to, $account_head="", $account_type="", $account=$id, $timeframe,$range_from="",$range_to="");

            $result[$i]->begining_balance_year = 0;

            $result[$i]->total_credit_year = array_sum(array_column($result[$i]->transactions_year,'credit_amount'));

            $result[$i]->total_debit_year = array_sum(array_column($result[$i]->transactions_year,'debit_amount'));

            $result[$i]->net_change_year = $result[$i]->total_debit_year-$result[$i]->total_credit_year;

            $result[$i]->ending_balance_year = $result[$i]->begining_balance_year + $result[$i]->net_change_year;

   
            $i++;
   
           }
           


           return $result;



   
           }




           public function FetchPLYTDTotal($cond,$date_from,$date_to)
           {

            $query = $this->db->table('accounts_charts_of_accounts');

            $query->where($cond);

            $query->orderBy('ca_name','asc');
   
            $result = $query->get()->getResult();

            $i=0;

            foreach($result as $ca){

            $query2 = $this->db->table('master_transactions');
        
            $query2->select('SUM(tran_credit) - SUM(tran_debit) AS total_balance', FALSE);

            $query2->where('tran_account',$ca->ca_id);

            $first_day_of_year = date('Y-m-d', strtotime('first day of january this year'));

            $query2->where('tran_datetime>=',$first_day_of_year);

            $tran_row = $query2->get()->getRow();

            $result[$i]->ytd_total = $tran_row->total_balance; 



            $query3 = $this->db->table('master_transactions');
        
            $query3->select('SUM(tran_credit) - SUM(tran_debit) AS total_balance', FALSE);

            $query3->where('tran_account',$ca->ca_id);

            $query3->where('tran_datetime>=',$date_from);

            $query3->where('tran_datetime<=',$date_to);

            $total_row = $query3->get()->getRow();

            $result[$i]->tran_total = $total_row->total_balance; 

            $result[$i]->month_year = date('m Y',strtotime($date_to));

            
            $i++;

            }

            return $result;

           }





   
           //Profit Loss Account End




           public function BalanceSheet($time_frame,$date_from,$date_to)
           {

            $today = date('Y-m-d');

            $query = $this->db->table('accounts_account_heads');

            $query->join('accounts_account_types','accounts_account_types.at_id=accounts_account_heads.ah_account_type','left');

            //Assets
            $query->where('accounts_account_types.at_name','Cash');

            $query->orWhere('accounts_account_types.at_name','Inventory');

            $query->orWhere('accounts_account_types.at_name','Accounts Receivable');

            $query->orWhere('accounts_account_types.at_name','Fixed Assets');    
            
            $query->orWhere('accounts_account_types.at_name','Accumulated Depreciation');  
            
            $query->orWhere('accounts_account_types.at_name','Other Current Assets');


            //Liability 
            $query->orWhere('accounts_account_types.at_name','Accounts Payable');
            
            $query->orWhere('accounts_account_types.at_name','Other Current Liablities');

            $query->orWhere('accounts_account_types.at_name','Provisions & Accurals');

            $query->orWhere('accounts_account_types.at_name','Long Term Liablities');

            $query->orWhere('accounts_account_types.at_name','Equity Doesn\'t Close');

            $query->orWhere('accounts_account_types.at_name','Equity Retained Earnings');


            $query->orderBy('ah_account_name','desc');

            $result = $query->get()->getResult();


            if($time_frame!="")
            {
    
                if($time_frame=="LastYear")
                {
    
                    $date_from = date("Y-01-01", strtotime("-1 year"));
    
                    $date_to = date("Y-12-t", strtotime($date_from));

                }
    
                if($time_frame=="CurrentYear")
                {
    
                    $date_from = date("Y-01-01", strtotime($today));

                    $date_to = date("Y-12-t", strtotime($today));

                }
    
            }
   
   
            $i=0;

            foreach($result as $res)
            {
   
            $result[$i]->Charts= $this->BalanceSheetCOA($res->ah_id,$date_from,$date_to);

            $i++;
   
            }


            return $result;




           }






            //Fetch Common Account Balance By Date                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          

            public function BalanceSheetCOA($ah_id,$date_from,$date_to)
            {


            $query = $this->db->table('accounts_charts_of_accounts');

            $query->where('ca_account_type',$ah_id);

            $query->orderBy('ca_name','asc');

            $result = $query->get()->getResult();

            
            $i=0;


            foreach($result as $res)

            {

             $query2 = $this->db->query('SELECT SUM(tran_credit) - SUM(tran_debit) AS total_balance FROM '.$this->db->getPrefix().'master_transactions WHERE (tran_datetime>= CONVERT( \''.date("Y-m-d",strtotime($date_from)).'\' , DATETIME)) && (tran_datetime<= CONVERT( \''.date("Y-m-d",strtotime($date_to)).'\' , DATETIME)) && (tran_account = '.$res->ca_id.')');
 
             // Fetch the result
             $result2 = $query2->getRow();

             $balance = 0.00;

             if($result2->total_balance>0)
             {
            
             $balance = $result2->total_balance;

             }
             
             $result[$i]->balance = $balance;

             $i++;

            }

            return $result;
 
            }





           //Fetch Common Account Balance By Date

           public function AccountBalance($account,$date_from,$date_to)
           {

            $query = $this->db->query('SELECT SUM(tran_credit) - SUM(tran_debit) AS total_balance FROM '.$this->db->getPrefix().'master_transactions WHERE (tran_datetime>= CONVERT( \''.date("Y-m-d",strtotime($date_from)).'\' , DATETIME)) && (tran_datetime<= CONVERT( \''.date("Y-m-d",strtotime($date_to)).'\' , DATETIME)) && (tran_account = '.$account.')');

            // Fetch the result
            $result = $query->getRow();

            // Return the total balance
            return $result->account_balance;


           }




           public function StartBalance($account,$date_to)
           {

            $query = $this->db->query('SELECT SUM(tran_credit) - SUM(tran_debit) AS total_balance FROM '.$this->db->getPrefix().'master_transactions WHERE (tran_datetime<= CONVERT( \''.date("Y-m-d",strtotime($date_to)).'\' , DATETIME)) && (tran_account = '.$account.')');

            // Fetch the result
            $result = $query->getRow();

            // Return the total balance
            return $result->total_balance;

           }






           public function TotalCredit()
           {


           }



        //Receivable Payable Summery

        public function RPSummery($account,$date,$type)
        {
        
        $query = $this->db->table('accounts_charts_of_accounts');

        $query->join('accounts_account_heads','accounts_account_heads.ah_id=accounts_charts_of_accounts.ca_account_type','left');

        $query->join('accounts_account_types','accounts_account_types.at_id=accounts_account_heads.ah_account_type','left');

        //$query->groupStart();

        if($account!="")
        $query->where('ah_id',$account);

        if($type=="receivable")
        $query->where('at_name',"Accounts Receivable");
        else
        $query->orWhere('at_name',"Accounts Payable");

        /*
        $query->where('at_name',"Expenses");

        $query->orWhere('at_name',"Cost of Sales");

        $query->orWhere('at_name',"Income");

        */

        //$query->groupEnd();

        $query->orderBy('ca_name','asc');

        $result = $query->get()->getResult();
        

        $i=0;

        foreach($result as $res)
        {

         $result[$i]->Receivables = $this->RPTotalDue($date,$res->ca_id); // $this->FetchSum('crm_cash_invoice','ci_total_amount',array('ci_customer' => $res->cc_id,'ci_paid_status' => 0,'ci_date<=' => $date));

         $result[$i]->ThirtyDays = $this->RPDueDated($res->ca_id,$date,"0","30");

         $result[$i]->SixtyDays = $this->RPDueDated($res->ca_id,$date,"31","60");

         $result[$i]->NinetyDays = $this->RPDueDated($res->ca_id,$date,"61","90");

         $result[$i]->AboveNinetyDays = $this->RPDueDated($res->ca_id,$date,"90","above");

        $i++;

        }

        return $result;

        // echo "<pre>";

        // print_r($result);

        // exit;


        }



        public function RPTotalDue($date,$account)
        {

        //Unpaid Purchase Voucher

        $query = $this->db->table('pro_purchase_voucher');

        $query->select('SUM(pv_total) - SUM(pv_paid) as pv_due');

        //$query = $this->db->query('SELECT SUM(pv_total) - SUM(pv_paid) AS total_balance FROM '.$this->db->getPrefix().'pro_purchase_voucher');

        //$result = $query->getRow();

        //echo $result->total_balance; exit;


        $query->join('pro_vendor','pro_vendor.ven_id=pro_purchase_voucher.pv_vendor_name','left');

        $query->join('accounts_charts_of_accounts','accounts_charts_of_accounts.ca_customer=pro_vendor.ven_id and accounts_charts_of_accounts,ca_type = "VENDOR"','left');

        $query->join('accounts_account_heads','accounts_account_heads.ah_id=accounts_charts_of_accounts.ca_account_type','left');

        if($account!="")
        $query->where('accounts_charts_of_accounts.ca_id',$account);

        
        if($date!="")
        $query->where('pv_date<=',$date);


        $pv_due = $query->get()->getRow()->pv_due;

        //echo $pv_due; exit;


        //Unpaid Cash Invoices

        $query = $this->db->table('crm_cash_invoice');

        $query->select('SUM(ci_total_amount) - SUM(ci_paid_amount) as ci_due');

        $query->join('crm_customer_creation','crm_customer_creation.cc_id=crm_cash_invoice.ci_customer','left');

        $query->join('accounts_charts_of_accounts','accounts_charts_of_accounts.ca_customer=crm_customer_creation.cc_id and accounts_charts_of_accounts,ca_type = "CUSTOMER"','left');

        $query->join('accounts_account_heads','accounts_account_heads.ah_id=accounts_charts_of_accounts.ca_account_type','left');

        if($account!="")
        $query->where('accounts_charts_of_accounts.ca_id',$account);

        //$query->where('ci_customer',$account);

        if($date!="")
        $query->where('ci_date<=',$date);

        $ci_due = $query->get()->getRow()->ci_due;

            
        //Unpaid Credit Invoices

        $query = $this->db->table('crm_credit_invoice');

        $query->select('SUM(cci_total_amount) - SUM(cci_paid_amount) as cr_due');

        $query->join('crm_customer_creation','crm_customer_creation.cc_id=crm_credit_invoice.cci_customer','left');

        $query->join('accounts_charts_of_accounts','accounts_charts_of_accounts.ca_customer=crm_customer_creation.cc_id and accounts_charts_of_accounts,ca_type = "CUSTOMER"','left');

        $query->join('accounts_account_heads','accounts_account_heads.ah_id=accounts_charts_of_accounts.ca_account_type','left');

        if($account!="")
        $query->where('accounts_charts_of_accounts.ca_id',$account);

        //$query->where('cci_customer',$account);

        if($date!="")
        $query->where('cci_date<=',$date);

        $cr_due = $query->get()->getRow()->cr_due;

        $total_due = $pv_due+$ci_due+$cr_due;


        return $total_due;

        }




        //Dated Total 30,60,90 etc

        public function RPDueDated($account,$date,$day_start,$day_end)
        {

        //Unpaid Purchase Voucher

        if($day_end != "above")
        {
        $start_date = date('Y-m-d',strtotime($date.'-'.$day_end.'days'));
        }

        $end_date = date('Y-m-d',strtotime($date.'-'.$day_start.'days'));


        $query = $this->db->table('pro_purchase_voucher');

        $query->select('SUM(pv_total) - SUM(pv_paid) as pv_due');

        //$query = $this->db->query('SELECT SUM(pv_total) - SUM(pv_paid) AS total_balance FROM '.$this->db->getPrefix().'pro_purchase_voucher');

        //$result = $query->getRow();

        //echo $result->total_balance; exit;


        $query->join('pro_vendor','pro_vendor.ven_id=pro_purchase_voucher.pv_vendor_name','left');

        $query->join('accounts_charts_of_accounts','accounts_charts_of_accounts.ca_customer=pro_vendor.ven_id and accounts_charts_of_accounts,ca_type = "VENDOR"','left');

        $query->join('accounts_account_heads','accounts_account_heads.ah_id=accounts_charts_of_accounts.ca_account_type','left');

        if($account!="")    
        $query->where('accounts_charts_of_accounts.ca_id',$account);

        if($day_end != "above")
        $query->where('pv_date>=',$start_date);


       
        $query->where('pv_date<=',$end_date);


        $pv_due = $query->get()->getRow()->pv_due;

        //echo $pv_due; exit;


        //Unpaid Cash Invoices

        $query = $this->db->table('crm_cash_invoice');

        $query->select('SUM(ci_total_amount) - SUM(ci_paid_amount) as ci_due');

        $query->join('crm_customer_creation','crm_customer_creation.cc_id=crm_cash_invoice.ci_customer','left');

        $query->join('accounts_charts_of_accounts','accounts_charts_of_accounts.ca_customer=crm_customer_creation.cc_id and accounts_charts_of_accounts,ca_type = "CUSTOMER"','left');

        $query->join('accounts_account_heads','accounts_account_heads.ah_id=accounts_charts_of_accounts.ca_account_type','left');

        if($account!="")
        $query->where('accounts_charts_of_accounts.ca_id',$account);

        //$query->where('ci_customer',$account);

        if($day_end != "above")
        $query->where('ci_date>=',$start_date);

        $query->where('ci_date<=',$end_date);

        $ci_due = $query->get()->getRow()->ci_due;

            
        //Unpaid Credit Invoices

        $query = $this->db->table('crm_credit_invoice');

        $query->select('SUM(cci_total_amount) - SUM(cci_paid_amount) as cr_due');

        $query->join('crm_customer_creation','crm_customer_creation.cc_id=crm_credit_invoice.cci_customer','left');

        $query->join('accounts_charts_of_accounts','accounts_charts_of_accounts.ca_customer=crm_customer_creation.cc_id and accounts_charts_of_accounts,ca_type = "CUSTOMER"','left');

        $query->join('accounts_account_heads','accounts_account_heads.ah_id=accounts_charts_of_accounts.ca_account_type','left');

        if($account!="")
        $query->where('accounts_charts_of_accounts.ca_id',$account);

        //$query->where('cci_customer',$account);

        if($day_end != "above")
        $query->where('cci_date>=',$start_date);

        $query->where('cci_date<=',$end_date);

        $cr_due = $query->get()->getRow()->cr_due;

        $total_due = $pv_due+$ci_due+$cr_due;


        return $total_due;

        }












        public function RPDated($account,$date,$day_start,$day_end)
        {

        if($day_end != "above")
        {
        $start_date = date('Y-m-d',strtotime($date.'-'.$day_end.'days'));
        }

        $end_date = date('Y-m-d',strtotime($date.'-'.$day_start.'days'));


        // echo "Start : {$start_date}";

        // echo "<br>";

        // echo "End : {$end_date}";

        // exit;

        $query = $this->db->table('crm_cash_invoice');

        $query->selectSum('ci_total_amount');

        $query->where('ci_customer',$account);

        $query->where('ci_date<=',$end_date);

        if($day_end != "above")
        {
        $query->where('ci_date>=',$start_date);
        }

        $result = $query->get()->getRow();

        return $result->ci_total_amount;


        }



        //


        
      public function AccountReceivable($cond="",$date)
      {
          $query = $this->db->table('crm_cash_invoice');
  
          $query->selectSum('ci_total_amount');

          $query->where('ci_customer',$res->cc_id);

          $query->where('ci_paid_status',0);
  
          if($cond !="")
          {
          $query->where($cond);
          }

          if($date !="")
          {
          $query->where('ci_date>=',$date);
          }
  
          $result = $query->get()->getRow();
  
          return $result->$column;
          
      }


      public function BankRec($id)
      {

      //$query->

      }


      public function FetchBRLastEBalance($account,$date)
      {

        $query = $this->db->table('accounts_bank_rec');

        $query->selectSum('br_unrec_diff');

        $query->where('br_account',$account);

        $query->where('br_date<=',$date);

        $return = $query->get()->getRow();

        if(!empty($return))
        {
            return $return->br_unrec_diff;
        }
        else
        {
            return 0;
        }

      }


      public function FetchBRLastBBalance($account,$date)
      {

        $query = $this->db->table('accounts_bank_rec');

        $query->select('br_bank_balance');

        $query->where('br_account',$account);

        $query->where('br_date<=',$date);

        $query->orderBy('br_id','desc');

        $return = $query->get()->getRow();

        if(!empty($return))
        {
            return $return->br_bank_balance;
        }
        else
        {
            return 0;
        }

        //return $query->get()->getRow()->;

      }




      public function FetchFixedAssetDepreciation($id)
      {

      $query = $this->db->table('pro_depreciation_calculation');

      $query->select('*');

      $query->join('pro_depreciation_det','pro_depreciation_det.dpcd_depreciation_id=pro_depreciation_calculation.dpc_id','left');

      $query->join('pro_create_fixed_asset','pro_create_fixed_asset.cfs_id=pro_depreciation_det.dpcd_asset_id','left');

      $query->where('pro_depreciation_det.dpcd_asset_id',$id);

      return $query->get()->getResult();

      }



      
      public function FixedAssets($account_type,$date)
      {

        $query = $this->db->table('accounts_account_heads');

        $query->select('*');

        //$this->db->join('accounts_account_heads','accounts_account_heads.ah_id=accounts_charts_of_accounts.ca_account_type','left');

        $query->join('accounts_account_types','accounts_account_types.at_id=accounts_account_heads.ah_account_type','left');

        $query->where('at_name',"Fixed Assets");

        $result =  $query->get()->getResult();

        $i=0;
        foreach($result as $res)
        {

        $result[$i]->items = $this->FetchFixedAssetDepreciation($res->ah_id);

        $i++;
        
        }

        return $result;

      }







     




}

