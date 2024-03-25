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



    //General Ledger Report Start

    public function FetchGLReceipts($date_from,$date_to,$account_head,$account_type,$account,$time_frame)
    {

        $query = $this->db->table('accounts_receipts');

        $query->join('crm_customer_creation','crm_customer_creation.cc_id=accounts_receipts.r_debit_account','left');

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

        $query->join('crm_customer_creation','crm_customer_creation.cc_id=accounts_payments.pay_credit_account','left');

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

    // General Ledger Report End







    //Statement Of Accounts Start


    public function SOAReceipts($date_from,$date_to,$account)
    {

        $query = $this->db->table('accounts_receipts');

        $query->join('crm_customer_creation','crm_customer_creation.cc_id=accounts_receipts.r_debit_account','left');

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

        $query->join('crm_customer_creation','crm_customer_creation.cc_id=accounts_payments.pay_credit_account','left');

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
    
            $query->join('crm_customer_creation','crm_customer_creation.cc_id=accounts_receipts.r_debit_account','left');
    
            $query->join('accounts_account_heads','accounts_account_heads.ah_id=crm_customer_creation.cc_account_head','left');
    
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
    
            $query->join('crm_customer_creation','crm_customer_creation.cc_id=accounts_payments.pay_credit_account','left');
    
            $query->join('accounts_account_heads','accounts_account_heads.ah_id=crm_customer_creation.cc_account_head','left');
    
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






        
           //Profit Loss Account Start



           public function FetchPLAccount()
           {
              
           $query = $this->db->table('accounts_account_heads');
   
           $query->orderBy('ah_account_name','asc');
   
           $result = $query->get()->getResult();
   
   
           $i=0;

           foreach($result as $res)
           {
   
           $cond = array('ca_account_type' => $res->ah_id);

           $result[$i]->Charts= $this->FetchWhere('accounts_charts_of_accounts',$cond);

           $i++;
   
           }
           
           return $result;
   
           }
   
           //Profit Loss Account End



     




}

