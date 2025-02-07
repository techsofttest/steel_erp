<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;


class AccountsModel extends Model
{

    protected $db;


    public function SingleRowJoin($table, $cond, $joins)
    {
        $query = $this->db->table($table)
            ->where($cond);

        if (!empty($joins))
            foreach ($joins as $join) {
                $table2 = $table;
                if (!empty($join['table2'])) {
                    $table2 = $join['table2'];
                }
                $query->join($join['table'], '' . $join['table'] . '.' . $join['pk'] . ' = ' . $table2 . '.' . $join['fk'] . '', 'left');
            }

        $result = $query->get()->getRow();

        return $result;
    }



    public function SingleRowAliasJoin($table, $cond, $joins)
    {
        $query = $this->db->table($table)
            ->where($cond);

        if (!empty($joins))
            foreach ($joins as $join) {
                $query->join($join['table'], '' . $join['table'] . '.' . $join['pk'] . ' = ' . $table . '.' . $join['fk'] . '', 'left');
            }

        $result = $query->get()->getRow();

        return $result;
    }



    public function FetchWhere($table, $cond)
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

        $query->join('accounts_charts_of_accounts', 'accounts_charts_of_accounts.ca_id=master_transactions.tran_account', 'left');

        $query->join('accounts_account_heads', 'accounts_account_heads.ah_id=accounts_charts_of_accounts.ca_account_type', 'left');

        $query->join('accounts_account_types', 'accounts_account_types.at_id=accounts_account_heads.ah_account_type', 'left');


        if ($account != "") {
            $query->where('accounts_charts_of_accounts.ca_id', $account);
        }

        $result = $query->get()->getRow();


        if ($result->total_balance > 0) {
            return $result->total_balance;
        } else {
            return 0;
        }
    }

    //Aged RP Start




    // public function FetchMaxCreditAmount($account)
    // {


    // $query = $this->db->table('crm_cash_invoice');

    // $query->select('SUM(ci_total_amount) - SUM(ci_paid_amount) AS ci_credit_total', FALSE);

    // $query->join('accounts_charts_of_accounts','accounts_charts_of_accounts.ca_customer=crm_cash_invoice.ci_customer','left');

    // $query->where('ca_id',$account);

    // $result = $query->get()->getRow();

    // //echo $this->db->getLastQuery();

    // $ci_total =  $result->ci_credit_total;

    // $this->db->table('master_transactions');

    // $query = $this->db->table('crm_credit_invoice');

    // $query->select('SUM(cci_total_amount) - SUM(cci_paid_amount) AS cr_credit_total', FALSE);

    // $query->join('accounts_charts_of_accounts','accounts_charts_of_accounts.ca_customer=crm_credit_invoice.cci_customer','left');

    // $query->where('ca_id',$account);

    // $result = $query->get()->getRow();

    // //echo $this->db->getLastQuery(); exit;

    // $cr_total =  $result->cr_credit_total;


    // $total_creditable = $ci_total+$cr_total;

    // if($total_creditable>0)
    // {
    // return $total_creditable;
    // }
    // else
    // {
    // return 0;
    // }

    // }




    public function FetchMaxCreditAmount($account)
    {


        $query = $this->db->table('crm_cash_invoice');

        $query->select('SUM(ci_total_amount) - SUM(ci_paid_amount) AS ci_credit_total , SUM(steel_crm_sales_return_prod_det.srp_amount) AS srp_amount', FALSE);

        $query->join('accounts_charts_of_accounts', 'accounts_charts_of_accounts.ca_customer=crm_cash_invoice.ci_customer', 'left');

        $query->join('crm_sales_return', 'crm_sales_return.sr_invoice = crm_cash_invoice.ci_reffer_no', 'left');

        $query->join('crm_sales_return_prod_det', 'crm_sales_return_prod_det.srp_sales_return = crm_sales_return.sr_id', 'left');

        $query->where('ca_id', $account);

        $result = $query->get()->getRow();

        // echo $this->db->error();exit;

        $ci_total =  $result->ci_credit_total - $result->srp_amount;



        $this->db->table('master_transactions');

        $query = $this->db->table('crm_credit_invoice');

        $query->select('SUM(cci_total_amount) - SUM(cci_paid_amount) AS cr_credit_total , SUM(steel_crm_sales_return_prod_det.srp_amount) AS srp_amount ', FALSE);

        $query->join('accounts_charts_of_accounts', 'accounts_charts_of_accounts.ca_customer=crm_credit_invoice.cci_customer', 'left');

        $query->join('crm_sales_return', 'crm_sales_return.sr_invoice = crm_credit_invoice.cci_reffer_no', 'left');

        $query->join('crm_sales_return_prod_det', 'crm_sales_return_prod_det.srp_sales_return = crm_sales_return.sr_id', 'left');

        $query->where('ca_id', $account);

        $result = $query->get()->getRow();

        //echo $this->db->getLastQuery(); exit;

        // echo $result->cr_credit_total.' | '.$result->srp_amount;
        $cr_total =  $result->cr_credit_total - $result->srp_amount;


        $total_creditable = $ci_total + $cr_total;

        if ($total_creditable > 0) {
            return $total_creditable;
        } else {
            return 0;
        }
    }










    public function FetchMaxDebitAmount($vendor)
    {
        $query = $this->db->table('pro_purchase_voucher');

        $query->select('SUM(pv_total) - SUM(pv_paid) AS debit_total', FALSE);

        $query->join('accounts_charts_of_accounts', 'accounts_charts_of_accounts.ca_customer=pro_purchase_voucher.pv_vendor_name', 'left');

        // $query->join('pro_vendor','pro_vendor.ven_id=pro_purchase_voucher.pv_vendor_name','left');

        $query->where('ca_id', $vendor);

        $result = $query->get()->getRow();

        $max = $result->debit_total;

        //echo $max; exit;    

        if ($max > 0) {
            return $max;
        } else {
            return 0;
        }
    }


    public function FetchUnpaidPurchaseVoucher($vendor)
    {
        // Status conditions: 0 = unpaid, 1 = partially paid
        $query = $this->db->table('pro_purchase_voucher');

        // Join the accounts_charts_of_accounts table to fetch vendor information
        $query->join('accounts_charts_of_accounts', 'accounts_charts_of_accounts.ca_customer = pro_purchase_voucher.pv_vendor_name', 'left');

        // Where condition to match the vendor
        $query->where('accounts_charts_of_accounts.ca_id', $vendor);

        // Grouping to apply the OR condition for pv_status
        $query->groupStart()
            ->where('pv_status', 0)
            ->orWhere('pv_status', 1)
            ->groupEnd();

        // Fetch and return the results
        

        return $query->get()->getResult();
    }



    public function FetchEnquiryInQuot($id)
    {
        $query = $this->db->table('crm_enquiry')

            ->select('*')

            ->where('enquiry_customer', $id)

            ->join('crm_quotation_details', 'crm_enquiry.enquiry_id = crm_quotation_details.qd_enq_ref', 'left')

            ->groupStart()

            ->where('crm_quotation_details.qd_enq_ref IS NULL') // Include rows where qd_enq_ref is NULL

            ->orWhere('crm_enquiry.enquiry_id NOT IN (SELECT qd_enq_ref FROM ' . $this->db->getPrefix() . 'crm_quotation_details)')

            ->groupEnd()

            ->get();

        return $query->getResult();
    }


    public function FetchAdvanceSalesOrder($cid)
    {

        $query = $this->db->table('crm_sales_orders')

            ->select('*')

            ->join('accounts_charts_of_accounts', 'accounts_charts_of_accounts.ca_customer=crm_sales_orders.so_customer', 'left')

            ->where('accounts_charts_of_accounts.ca_id', $cid)

            ->where('so_deliver_flag',0)

            ->groupStart()

            ->where('crm_sales_orders.so_id NOT IN (SELECT ci_sales_order FROM ' . $this->db->getPrefix() . 'crm_cash_invoice)')

            ->where('crm_sales_orders.so_id NOT IN (SELECT cci_sales_order FROM ' . $this->db->getPrefix() . 'crm_credit_invoice)')

            ->groupEnd()

            ->get();

        return $query->getResult();
    }



    public function FetchAllLimitWhere($table, $order_key, $order, $where, $term, $end, $start)
    {

        return $this->db
            ->table($table)
            ->select('*')
            ->where($where)
            ->like($order_key, $term)
            ->limit($end, $start)
            ->orderBy($order_key, $order)
            ->get()
            ->getResult();
    }


    public function FetchSalesReturnAmount($inv_ref)
    {

        $query = $this->db->table('crm_sales_return');

        $query->join('steel_crm_sales_return_prod_det', 'steel_crm_sales_return_prod_det.srp_sales_return = crm_sales_return.sr_id', 'left');

        $query->selectSum('srp_amount');

        $query->where('sr_invoice', $inv_ref);

        $result = $query->get()->getRow();

        return $result->srp_amount;
    }




    public function SalesAdvancePaid($id)
    {

    $query = $this->db->table('accounts_receipts_sales_orders');

    $query->selectSum('rso_receipt_amount');

    $query->where('rso_sales_order', $id);

    $result = $query->get()->getRow()->rso_receipt_amount;

    return $result;

    }





}
