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






    public function FetchGLTransactions($date_from, $date_to, $account_head, $account_type, $account, $time_frame,$range_from,$range_to)
{
    $receipt_table = "{$this->db->getPrefix()}accounts_receipts";
    $payment_table = "{$this->db->getPrefix()}accounts_payments";
    $cash_invoice_table = "{$this->db->getPrefix()}crm_cash_invoice";
    $credit_invoice_table = "{$this->db->getPrefix()}crm_credit_invoice";
    $journal_table = "{$this->db->getPrefix()}accounts_journal_invoices";
    $pcv_table = "{$this->db->getPrefix()}accounts_petty_cash_voucher";
    $sr_table = "{$this->db->getPrefix()}crm_sales_return";



    $query = "";

   
    /*

    $query = "(SELECT 
                    {$receipt_table}.r_id AS id, 
                    {$receipt_table}.r_ref_no AS reference, 
                    {$this->db->getPrefix()}accounts_account_heads.ah_head_id as head_id,
                    {$receipt_table}.r_date AS transaction_date,
                    {$receipt_table}.r_amount AS credit_amount,
                    NULL AS debit_amount,
                    'Receipt' as voucher_type,
                    {$this->db->getPrefix()}accounts_charts_of_accounts.ca_id AS account_id,
                    {$this->db->getPrefix()}accounts_charts_of_accounts.ca_name AS account_name
                FROM {$this->db->getPrefix()}accounts_receipts
                LEFT JOIN {$this->db->getPrefix()}accounts_charts_of_accounts ON {$this->db->getPrefix()}accounts_charts_of_accounts.ca_id = {$receipt_table}.r_debit_account
                LEFT JOIN {$this->db->getPrefix()}crm_customer_creation ON {$this->db->getPrefix()}crm_customer_creation.cc_id = {$this->db->getPrefix()}accounts_charts_of_accounts.ca_customer
                LEFT JOIN {$this->db->getPrefix()}accounts_account_heads ON {$this->db->getPrefix()}accounts_account_heads.ah_id = {$this->db->getPrefix()}accounts_charts_of_accounts.ca_account_type
                LEFT JOIN {$this->db->getPrefix()}accounts_account_types ON {$this->db->getPrefix()}accounts_account_types.at_id = {$this->db->getPrefix()}accounts_account_heads.ah_id
                ";

                if(!empty($time_frame) || !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to))
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

    */



    //)
    //UNION ALL 

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
            LEFT JOIN {$this->db->getPrefix()}accounts_charts_of_accounts ON {$this->db->getPrefix()}accounts_charts_of_accounts.ca_id = {$payment_table}.pay_credit_account
            LEFT JOIN {$this->db->getPrefix()}crm_customer_creation ON {$this->db->getPrefix()}crm_customer_creation.cc_id = {$this->db->getPrefix()}accounts_charts_of_accounts.ca_customer
            LEFT JOIN {$this->db->getPrefix()}accounts_account_heads ON {$this->db->getPrefix()}accounts_account_heads.ah_id = {$this->db->getPrefix()}accounts_charts_of_accounts.ca_account_type
            LEFT JOIN {$this->db->getPrefix()}accounts_account_types ON {$this->db->getPrefix()}accounts_account_types.at_id = {$this->db->getPrefix()}accounts_account_heads.ah_id
             ";

 

    
             if(!empty($time_frame) || !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to))
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


if(!empty($time_frame) || !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to))
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
        NULL AS credit_amount,
        {$cash_invoice_table}.ci_total_amount AS debit_amount,
        'Cash Invoice' as voucher_type,
        {$this->db->getPrefix()}accounts_charts_of_accounts.ca_id AS account_id,
        {$this->db->getPrefix()}accounts_charts_of_accounts.ca_name AS account_name
    FROM {$this->db->getPrefix()}crm_cash_invoice
    LEFT JOIN {$this->db->getPrefix()}accounts_charts_of_accounts ON {$this->db->getPrefix()}accounts_charts_of_accounts.ca_customer = {$cash_invoice_table}.ci_customer    
    LEFT JOIN {$this->db->getPrefix()}accounts_account_heads ON {$this->db->getPrefix()}accounts_account_heads.ah_id = {$this->db->getPrefix()}accounts_charts_of_accounts.ca_account_type
    LEFT JOIN {$this->db->getPrefix()}accounts_account_types ON {$this->db->getPrefix()}accounts_account_types.at_id = {$this->db->getPrefix()}accounts_account_heads.ah_id
    LEFT JOIN {$this->db->getPrefix()}accounts_charts_of_accounts AS ca_credit_account ON ca_credit_account.ca_customer = {$cash_invoice_table}.ci_customer
     ";


if(!empty($time_frame) || !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to))
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


if(!empty($time_frame) || !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to))
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
    NULL AS credit_amount,
    {$credit_invoice_table}.cci_total_amount AS debit_amount,
    'Credit Invoice' as voucher_type,
    {$this->db->getPrefix()}accounts_charts_of_accounts.ca_id AS account_id,
    {$this->db->getPrefix()}accounts_charts_of_accounts.ca_name AS account_name
FROM {$this->db->getPrefix()}crm_credit_invoice
LEFT JOIN {$this->db->getPrefix()}accounts_charts_of_accounts ON {$this->db->getPrefix()}accounts_charts_of_accounts.ca_customer = {$credit_invoice_table}.cci_customer
LEFT JOIN {$this->db->getPrefix()}accounts_account_heads ON {$this->db->getPrefix()}accounts_account_heads.ah_id = {$this->db->getPrefix()}accounts_charts_of_accounts.ca_account_type
LEFT JOIN {$this->db->getPrefix()}accounts_account_types ON {$this->db->getPrefix()}accounts_account_types.at_id = {$this->db->getPrefix()}accounts_account_heads.ah_id
LEFT JOIN {$this->db->getPrefix()}accounts_charts_of_accounts AS ca_credit_account ON ca_credit_account.ca_customer = {$credit_invoice_table}.cci_customer
 ";


if(!empty($time_frame) || !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to))
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
LEFT JOIN {$this->db->getPrefix()}accounts_account_heads ON {$this->db->getPrefix()}accounts_account_heads.ah_id = {$this->db->getPrefix()}accounts_charts_of_accounts.ca_account_type
LEFT JOIN {$this->db->getPrefix()}accounts_account_types ON {$this->db->getPrefix()}accounts_account_types.at_id = {$this->db->getPrefix()}accounts_account_heads.ah_id
 ";


if(!empty($time_frame) || !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to))
{

$query .= "WHERE ";

}

if ($time_frame != "") {
if ($time_frame == "Range") {
if ($date_from != "") {
    $query .= "{$journal_table}.jv_date >= '{$date_from}' ";
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


if(!empty($time_frame) || !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to))
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
$query .= "YEAR({$pcv_table}.pcv_date) = YEAR(CURRENT_DATE())";
}
}

if ($account_head != "") {
if ($time_frame != "" || $date_from != "" || $date_to != "") {
$query .= "AND ";
}
$query .= "{$this->db->getPrefix()}accounts_account_heads.ah_id = {$account_head} ";
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

//Petty Cash Voucher End




//Sales Return Start

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
 ";

if(!empty($time_frame) || !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to))
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
$query .= "YEAR({$sr_table}.sr_date = YEAR(CURRENT_DATE()) AND MONTH({$sr_table}.sr_date) = MONTH(CURRENT_DATE()) ";
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

if(!empty($time_frame) || !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to))
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
$query .= "YEAR({$pr_table}.pr_date = YEAR(CURRENT_DATE()) AND MONTH({$pr_table}.pr_date) = MONTH(CURRENT_DATE()) ";
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








//Fetch Receipt Invoices


/*

$ri_table = "{$this->db->getPrefix()}accounts_receipt_invoices";

$query .= "UNION ALL 
(SELECT 
{$ri_table}.ri_id AS id, 
{$receipt_table}.r_ref_no AS reference, 
{$this->db->getPrefix()}accounts_account_heads.ah_head_id as head_id,
{$receipt_table}.r_date AS transaction_date,
$ri_table.ri_amount AS credit_amount,
NULL AS debit_amount,
'Receipt Invoice Test' as voucher_type,
{$this->db->getPrefix()}accounts_charts_of_accounts.ca_id AS account_id,
{$this->db->getPrefix()}accounts_charts_of_accounts.ca_name AS account_name
FROM $ri_table
LEFT JOIN {$this->db->getPrefix()}accounts_receipts ON {$receipt_table}.r_id = {$ri_table}.ri_receipt
LEFT JOIN {$this->db->getPrefix()}accounts_receipt_invoice_data ON {$this->db->getPrefix()}accounts_receipt_invoice_data.rid_receipt_invoice = {$this->db->getPrefix()}accounts_receipt_invoices.ri_id
LEFT JOIN {$this->db->getPrefix()}accounts_charts_of_accounts ON {$this->db->getPrefix()}accounts_charts_of_accounts.ca_id = {$this->db->getPrefix()}accounts_receipts.r_debit_account
JOIN {$this->db->getPrefix()}accounts_charts_of_accounts AS credit_account_receipt ON credit_account_receipt.ca_id = {$this->db->getPrefix()}accounts_receipt_invoices.ri_credit_account
LEFT JOIN {$this->db->getPrefix()}crm_customer_creation ON {$this->db->getPrefix()}crm_customer_creation.cc_id = credit_account_receipt.ca_customer
LEFT JOIN {$this->db->getPrefix()}accounts_account_heads ON {$this->db->getPrefix()}accounts_account_heads.ah_id = credit_account_receipt.ca_account_type
LEFT JOIN {$this->db->getPrefix()}accounts_account_types ON {$this->db->getPrefix()}accounts_account_types.at_id = {$this->db->getPrefix()}accounts_account_heads.ah_id
";
//
//

if(!empty($time_frame) || !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to))
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

//$query .="GROUP BY {$this->db->getPrefix()}accounts_receipt_invoices.ri_id";

$query .= ")";


*/



//






//{$receipt_table}.r_amount AS credit_amount,
//{$receipt_table}.r_amount AS credit_amount,

/*
$query .= "UNION ALL 
(SELECT 
{$receipt_table}.r_id AS id, 
{$receipt_table}.r_ref_no AS reference, 
{$this->db->getPrefix()}accounts_account_heads.ah_head_id as head_id,
{$receipt_table}.r_date AS transaction_date,
{$this->db->getPrefix()}accounts_receipt_invoices.ri_amount AS credit_amount,
NULL AS debit_amount,
'Receipt Invoice' as voucher_type,
{$this->db->getPrefix()}accounts_charts_of_accounts.ca_id AS account_id,
{$this->db->getPrefix()}accounts_charts_of_accounts.ca_name AS account_name
FROM {$this->db->getPrefix()}accounts_receipts
JOIN {$this->db->getPrefix()}accounts_receipt_invoices ON {$this->db->getPrefix()}accounts_receipt_invoices.ri_receipt = {$receipt_table}.r_id 
JOIN {$this->db->getPrefix()}accounts_receipt_invoice_data ON {$this->db->getPrefix()}accounts_receipt_invoice_data.rid_receipt_invoice = {$this->db->getPrefix()}accounts_receipt_invoices.ri_id
LEFT JOIN {$this->db->getPrefix()}accounts_charts_of_accounts ON {$this->db->getPrefix()}accounts_charts_of_accounts.ca_id = {$this->db->getPrefix()}accounts_receipts.r_debit_account
JOIN {$this->db->getPrefix()}accounts_charts_of_accounts AS credit_account_receipt ON credit_account_receipt.ca_id = {$this->db->getPrefix()}accounts_receipt_invoices.ri_credit_account
LEFT JOIN {$this->db->getPrefix()}crm_customer_creation ON {$this->db->getPrefix()}crm_customer_creation.cc_id = credit_account_receipt.ca_customer
LEFT JOIN {$this->db->getPrefix()}accounts_account_heads ON {$this->db->getPrefix()}accounts_account_heads.ah_id = credit_account_receipt.ca_account_type
LEFT JOIN {$this->db->getPrefix()}accounts_account_types ON {$this->db->getPrefix()}accounts_account_types.at_id = {$this->db->getPrefix()}accounts_account_heads.ah_id
";
//
//

if(!empty($time_frame) || !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to))
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

$query .="GROUP BY {$this->db->getPrefix()}accounts_receipt_invoices.ri_id";

$query .= ")";

*/




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

if(!empty($time_frame) || !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to))
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

$query .="GROUP BY {$this->db->getPrefix()}accounts_receipt_invoices.ri_id";

$query .= ")";




//Receipt Debit Account Select

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

if(!empty($time_frame) || !empty($account_head) || !empty($account) || !empty($range_from) || !empty($range_to))
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

$query .="GROUP BY {$this->db->getPrefix()}accounts_receipt_invoices.ri_id";

$query .= ")";














$query .= " ORDER BY transaction_date ASC,id ASC";


    //echo $query; exit;

    
    $result = $this->db->query($query)->getResult();

    //  $query = $this->db->getLastQuery();
    //  echo (string)$query;
    //  exit;

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

    $receipt_table = "{$this->db->getPrefix()}accounts_receipts";

    $payment_table = "{$this->db->getPrefix()}accounts_payments";


    if($date_from !="")
    {
      $r_date_from_cond = "{$receipt_table}.r_date >= {$date_from})";
      
      $p_date_from_cond = "{$payment_table}.pay_date >= {$date_from}";

    }

    else
    {
        $r_date_from_cond = "1=1";
        $p_date_from_cond = "1=1";
    }


    if($date_to !="")
    {
       $r_date_to_cond = "{$receipt_table}.r_date <= {$date_to}";

       $p_date_to_cond = "{$payment_table}.pay_date <= {$date_to}";

    }

    else
    {
        $r_date_to_cond = "1=1";
        $p_date_to_cond = "1=1";
    }

    if($account !="")
    {

        $r_account_cond = "{$receipt_table}.r_debit_account = {$account}";

        $p_account_cond = "{$payment_table}.pay_credit_account = {$account}";

    }
    else
    {

        $r_account_cond = "1=1";

        $p_account_cond = "1=1";

    }


    $sql = 'SELECT * FROM (
            (SELECT '.$receipt_table.'.r_id AS id, '.$receipt_table.'.r_ref_no AS reference, '.$receipt_table.'.r_date AS voucher_date,'.$receipt_table.'.r_amount as debit_amount, NULL as credit_amount FROM '.$this->db->getPrefix().'accounts_receipts WHERE ('.$r_account_cond.') AND ('.$r_date_from_cond .') AND ('.$r_date_to_cond.'))UNION ALL
            (SELECT '.$payment_table.'.pay_id AS id,'.$payment_table.'.pay_ref_no as reference,'.$payment_table.'.pay_date AS voucher_date,NULL as debit_amount,'.$payment_table.'.pay_amount as credit_amount FROM '.$this->db->getPrefix().'accounts_payments WHERE ('.$p_account_cond.') AND ('.$p_date_from_cond.') AND ('.$p_date_to_cond.'))
        ) results 
        ORDER BY voucher_date ASC';

    $query = $this->db->query($sql);

    $result = $query->getResult();


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




        public function AgedRPTransactions($date_from,$account_head,$account_type,$account)
        {

            $receipt_table = "{$this->db->getPrefix()}accounts_receipts";
            $payment_table = "{$this->db->getPrefix()}accounts_payments";
        
            $query = "(SELECT 
                            {$receipt_table}.r_id AS id, 
                            {$receipt_table}.r_ref_no AS reference, 
                            {$receipt_table}.r_date AS transaction_date,
                            NULL AS credit_amount,
                            {$receipt_table}.r_method AS cheque,
                            {$receipt_table}.r_amount AS debit_amount,
                            {$this->db->getPrefix()}accounts_charts_of_accounts.ca_id AS account_id,
                            {$this->db->getPrefix()}accounts_charts_of_accounts.ca_name AS account_name
                        FROM {$this->db->getPrefix()}accounts_receipts
                        LEFT JOIN {$this->db->getPrefix()}accounts_charts_of_accounts ON {$this->db->getPrefix()}accounts_charts_of_accounts.ca_id = {$receipt_table}.r_debit_account
                        LEFT JOIN {$this->db->getPrefix()}crm_customer_creation ON {$this->db->getPrefix()}crm_customer_creation.cc_id = {$this->db->getPrefix()}accounts_charts_of_accounts.ca_customer
                        LEFT JOIN {$this->db->getPrefix()}accounts_account_heads ON {$this->db->getPrefix()}accounts_account_heads.ah_id = {$this->db->getPrefix()}crm_customer_creation.cc_account_head
                        LEFT JOIN {$this->db->getPrefix()}accounts_account_types ON {$this->db->getPrefix()}accounts_account_types.at_id = {$this->db->getPrefix()}accounts_account_heads.ah_id
                        ";
        
                        if(!empty($date_from) || !empty($account_head) || !empty($account))
                        {
                            $query .= "WHERE ";
                        }


            if ($date_from != "") {
                $query .= "{$receipt_table}.r_date >= '{$date_from}' ";
            }
        
        
            if ($account_head != "") {
                if ($date_from != "") {
                    $query .= "AND ";
                }
                $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_id = {$account_head} ";
            }
        
            if ($account_type != "") {
                if ($account_head != "" || $date_from != "") {
                    $query .= "AND ";
                }
                $query .= "{$this->db->getPrefix()}accounts_account_types.at_id = {$account_type} ";
            }
        
            if ($account != "") {
                if ($account_head != "" || $account_type != "" || $date_from != "") {
                    $query .= "AND ";
                }
                $query .= "{$receipt_table}.r_debit_account = {$account} ";
            }
        
            $query .= ")
                    UNION ALL 
                    (SELECT 
                        {$payment_table}.pay_id AS id,
                        {$payment_table}.pay_ref_no AS reference,
                        {$payment_table}.pay_date AS transaction_date,
                        {$payment_table}.pay_amount AS credit_amount,
                        {$payment_table}.pay_method AS cheque,
                        NULL AS debit_amount,
                        {$this->db->getPrefix()}accounts_charts_of_accounts.ca_id AS account_id,
                        {$this->db->getPrefix()}accounts_charts_of_accounts.ca_name AS account_name
                    FROM {$this->db->getPrefix()}accounts_payments
                    LEFT JOIN {$this->db->getPrefix()}accounts_charts_of_accounts ON {$this->db->getPrefix()}accounts_charts_of_accounts.ca_id = {$payment_table}.pay_credit_account
                    LEFT JOIN {$this->db->getPrefix()}crm_customer_creation ON {$this->db->getPrefix()}crm_customer_creation.cc_id = {$this->db->getPrefix()}accounts_charts_of_accounts.ca_customer
                    LEFT JOIN {$this->db->getPrefix()}accounts_account_heads ON {$this->db->getPrefix()}accounts_account_heads.ah_id = {$this->db->getPrefix()}crm_customer_creation.cc_account_head
                    LEFT JOIN {$this->db->getPrefix()}accounts_account_types ON {$this->db->getPrefix()}accounts_account_types.at_id = {$this->db->getPrefix()}accounts_account_heads.ah_id
                     ";
        
        
            if(!empty($date_from) || !empty($account_head) || !empty($account))
            {
        
                $query .= "WHERE ";
        
            }

            if ($date_from != "") {
                $query .= "{$payment_table}.pay_date >= '{$date_from}' ";
            }
        
            if ($account_head != "") {
                if ($date_from != "") {
                    $query .= "AND ";
                }
                $query .= "{$this->db->getPrefix()}accounts_account_heads.ah_id = {$account_head} ";
            }
        
            if ($account != "") {
                if ($account_head != "" || $account_type != ""  || $date_from != "") {
                    $query .= "AND ";
                }
                $query .= "{$payment_table}.pay_credit_account = {$account} ";
        
            }
        
            $query .= ")";
        
            $query .= " ORDER BY transaction_date ASC";
        
            $result = $this->db->query($query)->getResult();
        
            return $result;

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


        
           //Profit Loss Account Start

           public function FetchPLAccount($date_from,$date_to)
           {
              
           $query = $this->db->table('accounts_account_heads');
   
           $query->orderBy('ah_account_name','asc');
   
           $result = $query->get()->getResult();
   
   
           $i=0;

           foreach($result as $res)
           {
   
           $cond = array('ca_account_type' => $res->ah_id);

           //$result[$i]->Charts= $this->FetchWhere('accounts_charts_of_accounts',$cond);

           $result[$i]->Charts= $this->FetchPLYTDTotal($cond,$date_from,$date_to);

           $i++;
   
           }
           
        //    echo "<pre>";

        //    print_r($result);
           
        //    echo "</pre>";

        //    exit;

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

        public function RPSummery($account,$date)
        {
        
        $query = $this->db->table('crm_customer_creation');

        $query->join('accounts_charts_of_accounts','accounts_charts_of_accounts.ca_id=crm_customer_creation.cc_id','left');

        if($account!="")
        {
        $query->where('cc_account_head',$account);
        }
        
        $query->groupBy('crm_customer_creation.cc_id');

        $query->orderBy('cc_customer_name','asc');

        $result = $query->get()->getResult();

        $i=0;

        foreach($result as $res)
        {

        $result[$i]->Receivables = $this->FetchSum('crm_cash_invoice','ci_total_amount',array('ci_customer' => $res->cc_id,'ci_paid_status' => 0,'ci_date<=' => $date));

        $result[$i]->ThirtyDays = $this->RPDated($res->cc_id,$date,"0","30");

        $result[$i]->SixtyDays = $this->RPDated($res->cc_id,$date,"31","60");

        $result[$i]->NinetyDays = $this->RPDated($res->cc_id,$date,"61","90");

        $result[$i]->AboveNinetyDays = $this->RPDated($res->cc_id,$date,"90","above");

        $i++;

        }

        return $result;

        // echo "<pre>";

        // print_r($result);

        // exit;


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

     




}

