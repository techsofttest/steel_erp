<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;


class AccountsModel extends Model
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



    //General Ledger Report Start

    public function FetchCreditAmount($account)
    {

    /*
    $query = $this->db->table('crm_cash_invoice');

    $query->select('SUM(ci_total_amount) - SUM(ci_paid_amount) AS ci_credit_total', FALSE);

    $query->join('accounts_charts_of_accounts','accounts_charts_of_accounts.ca_customer=crm_cash_invoice.ci_customer','left');

    $query->where('ca_id',$account);

    $result = $query->get()->getRow();

    return $result->ci_credit_total;
    */


    $query = $this->db->table('master_transactions');

    //  $query = $this->db->query('SELECT SUM(tran_credit) - SUM(tran_debit) AS total_balance FROM '.$this->db->getPrefix().'master_transactions WHERE (tran_datetime<= CONVERT( \''.date("Y-m-d",strtotime($date_to)).'\' , DATETIME)) && (tran_account = '.$account.')');

    $query->select('SUM(tran_credit) - SUM(tran_debit) AS total_balance', FALSE);

    $query->join('accounts_charts_of_accounts','accounts_charts_of_accounts.ca_id=master_transactions.tran_account','left');

    $query->join('accounts_account_heads','accounts_account_heads.ah_id=accounts_charts_of_accounts.ca_account_type','left');

    $query->join('accounts_account_types','accounts_account_types.at_id=accounts_account_heads.ah_account_type','left');

    
    if($account!="")
    {
    $query->where('accounts_charts_of_accounts.ca_id',$account);    
    }

    $result = $query->get()->getRow();


    if($result->total_balance>0)
    {
    return $result->total_balance;
    }
    else
    {
    return 0;
    }


    }

    //Aged RP Start




    public function FetchMaxCreditAmount($account)
    {

    
    $query = $this->db->table('crm_cash_invoice');

    $query->select('SUM(ci_total_amount) - SUM(ci_paid_amount) AS ci_credit_total', FALSE);

    $query->join('accounts_charts_of_accounts','accounts_charts_of_accounts.ca_customer=crm_cash_invoice.ci_customer','left');

    $query->where('ca_id',$account);

    $result = $query->get()->getRow();

    //echo $this->db->getLastQuery();

    $ci_total =  $result->ci_credit_total;

    $this->db->table('master_transactions');

    $query = $this->db->table('crm_credit_invoice');

    $query->select('SUM(cci_total_amount) - SUM(cci_paid_amount) AS cr_credit_total', FALSE);

    $query->join('accounts_charts_of_accounts','accounts_charts_of_accounts.ca_customer=crm_credit_invoice.cci_customer','left');

    $query->where('ca_id',$account);

    $result = $query->get()->getRow();

    //echo $this->db->getLastQuery(); exit;

    $cr_total =  $result->cr_credit_total;


    $total_creditable = $ci_total+$cr_total;

    if($total_creditable>0)
    {
    return $total_creditable;
    }
    else
    {
    return 0;
    }
    
    }




    






    public function FetchMaxDebitAmount($vendor)
    {
    
    $query = $this->db->table('pro_purchase_voucher');

    $query->select('SUM(pv_total) - SUM(pv_paid) AS debit_total', FALSE);
    
    $query->join('accounts_charts_of_accounts','accounts_charts_of_accounts.ca_customer=pro_purchase_voucher.pv_vendor_name','left');

    //$query->join('pro_vendor','pro_vendor.ven_id=pro_purchase_voucher.pv_vendor_name','left');
    
    $query->where('ca_id',$vendor);
    
    $result = $query->get()->getRow();

    $max = $result->debit_total;

    if($max>0)
    {
    return $max;
    }
    else
    {
    return 0;
    }


    }






    public function FetchUnpaidPurchaseVoucher($vendor)
    {
    $where_or = 'pv_status = 0 || 1';
    $query = $this->db->table('pro_purchase_voucher');
    $query->join('accounts_charts_of_accounts','accounts_charts_of_accounts.ca_customer=pro_purchase_voucher.pv_vendor_name','left');
    $query->where('accounts_charts_of_accounts.ca_id',$vendor);
    $query->groupStart();
    $query->where($where_or);
    $query->groupEnd();
    return $query->get()->getResult();
       
    }







}
