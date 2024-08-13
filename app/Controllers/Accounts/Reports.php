<?php 

namespace App\Controllers\Accounts;  

use App\Controllers\BaseController;


class Reports extends BaseController
{

    //view page

    public function Ledger()
    {   

        $data['account_heads'] = $this->common_model->FetchAllOrder('accounts_account_heads','ah_id','asc');

        $data['account_heads_filter'] = $this->common_model->FetchAllOrder('accounts_account_heads','ah_head_id','asc');
 
        $data['account_types'] = $this->common_model->FetchAllOrder('accounts_account_types','at_id','asc');
 
        $data['accounts'] = $this->common_model->FetchAllOrder('accounts_charts_of_accounts','ca_name','asc');
 
        $data['banks'] = $this->common_model->FetchAllOrder('master_banks','bank_name','asc'); 


        if(!empty($_GET))
        {

        $start_date = "";
        $end_date ="";

        $time_frame = $this->request->getGet('filter_timeframe');

        if($time_frame=="Range"){

        if(!empty($this->request->getGet('start_date')))
        {
         
        $start_date = date('Y-m-d',strtotime($this->request->getGet('start_date')));
        }

        if(!empty($this->request->getGet('end_date')))
        {
        $end_date = date('Y-m-d',strtotime($this->request->getGet('end_date')));
        }

        }


        $filter_type = $this->request->getGet('filter_type');

        $account_head="";

        if($filter_type=="Account_Head")
        {

        $account_head = $this->request->getGet('filter_account_head');

        }

        $account_type="";

        if($filter_type=="Account_Type")
        {

        $account_type = $this->request->getGet('filter_account_type');

        }

        $account = "";

        if($filter_type=="Account")
        {

        $account = $this->request->getGet('filter_account');

        }

        $range_from="";

        $range_to="";


        if(!empty($this->request->getGet('range_from')))
        {
            $range_from=$this->request->getGet('range_from'); 
        }

        if(!empty($this->request->getGet('range_to')))
        {
            $range_to = $this->request->getGet('range_to'); 
        }

        if(!empty($range_from) || !empty($range_to))
        {
            $data['open_balance'] =$this->report_model->FetchGlOpenBalance($start_date,$end_date,$account_head,$account_type,$account,$time_frame);
        }
        else
        {
            $data['open_balance'] =0;
        }
        
        //$start_date = date('Y-m-d',strtotime('01-01-2024'));


        //$end_date = date('Y-m-d',strtotime('04-02-2024'));


        //$data['payments'] = $this->report_model->FetchGLPayments($start_date,$end_date,$account_head,$account_type,$account,$time_frame);


        //$data['receipts'] = $this->report_model->FetchGLReceipts($start_date,$end_date,$account_head,$account_type,$account,$time_frame);

        //$data['open_balance'] =$this->report_model->FetchGlOpenBalance($start_date,$end_date,$account_head,$account_type,$account,$time_frame);

        $data['vouchers']=$this->report_model->FetchGLTransactions($start_date,$end_date,$account_head,$account_type,$account,$time_frame,$range_from,$range_to);

        return view('accounts/ledger_report',$data);

        }
        else
        {
        // $data['payments'] = array();

        // $data['receipts'] = array();

        $data['vouchers'] = array();

        $data['content'] = view('accounts/ledger_report_search',$data);

        return view('accounts/accounts-module',$data);


        }

      

    }


 

    public function StatementOfAccounts()
    {   

        $data['accounts'] = $this->common_model->FetchAllOrder('accounts_charts_of_accounts','ca_name','asc');

        if(!empty($_GET))
        {

        $start_date = "";
        $end_date ="";

 
        if(!empty($this->request->getGet('start_date')))
        {
        $start_date = date('Y-m-d',strtotime($this->request->getGet('start_date')));
        }

        if(!empty($this->request->getGet('end_date')))
        {
        $end_date = date('Y-m-d',strtotime($this->request->getGet('end_date')));
        }


        $account = "";

        if(!empty($this->request->getGet('filter_account')))
        {

        $account = $this->request->getGet('filter_account');

        }


        $data['vouchers'] = $this->report_model->SOAVouchers($start_date,$end_date,$account);

        $data['post_dated_cheques'] = $this->report_model->SOAPostDatedCheques($start_date,$end_date,$account);

        //$data['payments'] = $this->report_model->SOAPayments($start_date,$end_date,$account);

        //$data['receipts'] = $this->report_model->SOAReceipts($start_date,$end_date,$account);


        $data['content'] = view('accounts/statement_of_accounts',$data);

        return view('accounts/report-module',$data);

        
        }
        else
        {

        $data['vouchers'] = array();

        $data['post_dated_cheques'] = array();

        // $data['payments'] = array();

        // $data['receipts'] = array();

        

        $data['content'] = view('accounts/statement_of_accounts',$data);

        return view('accounts/accounts-module',$data);

        }


     

    }








    public function AgedRP()
    {   


        $data['account_heads'] = $this->common_model->FetchAllOrder('accounts_account_heads','ah_id','asc');

        $data['account_types'] = $this->common_model->FetchAllOrder('accounts_account_types','at_id','asc');
 
        $data['accounts'] = $this->common_model->FetchAllOrder('accounts_charts_of_accounts','ca_name','asc');

        if(!empty($_GET))
        {

        $start_date = "";
        $end_date ="";


        if(!empty($this->request->getGet('start_date')))
        {
        $start_date = date('Y-m-d',strtotime($this->request->getGet('start_date')));
        }

        $filter_type = $this->request->getGet('filter_type');

        $account_head="";

        if($filter_type=="Account_Head")
        {

        $account_head = $this->request->getGet('filter_account_head');

        }

        $account_type="";

        if($filter_type=="Account_Type")
        {

        $account_type = $this->request->getGet('filter_account_type');

        }

        $account = "";

        if($filter_type=="Account")
        {

        $account = $this->request->getGet('filter_account');

        }

        //$data['payments'] = $this->report_model->ARPPayments($start_date,$account_head,$account_type,$account);

        //$data['receipts'] = $this->report_model->ARPReceipts($start_date,$account_head,$account_type,$account);

        $data['transactions'] = $this->report_model->AgedRPTransactions($start_date,$account_head,$account_type,$account);

        $data['post_dated_cheques'] = $this->report_model->ARPReceiptPDC($start_date,$account_head,$account_type,$account);

        $data['c_balance'] = $this->report_model->AgedRPBalance($start_date,$account_head,$account_type,$account);

        //echo $data['c_balance']; exit;

        $data['content'] = view('accounts/aged_rp_reports',$data);

        return view('accounts/report-module',$data);

        }
        else
        {

        //$data['payments'] = array();

        //$data['receipts'] = array();

        $data['transactions'] = array();

        $data['post_dated_cheques'] = array();

        $data['c_balance'] = array();

        
        $data['content'] = view('accounts/aged_rp_reports',$data);

        return view('accounts/accounts-module',$data);

        }




    }







    public function TrialBalance()
    {   

        

        if(!empty($_GET))
        {

        $start_date = "";

        $end_date ="";


        if(!empty($this->request->getGet('start_date')))
        {   
        $start_date = date('Y-m-d',strtotime($this->request->getGet('start_date')));
        }

        if(!empty($this->request->getGet('end_date')))
        {
        $end_date = date('Y-m-d',strtotime($this->request->getGet('end_date')));
        }

        $time_frame = $this->request->getGet('filter_timeframe');

        $data['c_accounts'] =  $this->report_model->TrialBalance($time_frame,$start_date,$end_date);

        $date_from = $start_date;

        $date_to = $end_date;

        $today = date('Y-m-d');

            if($time_frame=="Month")
            {

                $date_from = date("Y-m-01", strtotime($today));

                $date_to = date("Y-m-t", strtotime($today));

            }

            if($time_frame=="Year")
            {

                $date_from = date("Y-01-01", strtotime($today));

                $date_to = date("Y-12-t", strtotime($today));

            }

           

        $data['final_credit'] = $this->report_model->FetchSum('master_transactions','tran_credit',array('tran_datetime>=' => $date_from,'tran_datetime<=' =>$date_to));

        $data['final_debit'] =  $this->report_model->FetchSum('master_transactions','tran_debit',array('tran_datetime>=' => $date_from,'tran_datetime<=' =>$date_to));
       
        
        $data['content'] = view('accounts/trail_balance_report',$data);

        return view('accounts/report-module',$data);


        }
        else
        {

        $data['c_accounts'] = array();

        $data['final_credit'] = 0;

        $data['final_debit'] = 0;


        $data['content'] = view('accounts/trail_balance_report',$data);

        return view('accounts/accounts-module',$data);


        }

     

    }




 
    
    public function PLAccount()
    {   



        /*

        foreach($test as $ah)
        {

        echo $ah->ah_account_name;

        echo "<br>----<br>Charts Of Accounts <br>";
    
            foreach($ah->Charts as $ca)
            {

            echo $ca->ca_name;

            }

        echo "-----"; echo"<br>";

        }

        exit;

        */



        if(!empty($_GET))
        {

         $start_date = "";

          $end_date ="";
    
    
            if(!empty($this->request->getGet('start_date')))
            {   
            $start_date = date('Y-m-d',strtotime($this->request->getGet('start_date')));
            }
    
            if(!empty($this->request->getGet('end_date')))
            {
            $end_date = date('Y-m-d',strtotime($this->request->getGet('end_date')));
            }
    
        $time_frame = $this->request->getGet('filter_timeframe');


        $date_from = $start_date;

        $date_to = $end_date;

        $today = date('Y-m-d');

            if($time_frame=="Month")
            {

                $date_from = date("Y-m-01", strtotime($today));

                $date_to = date("Y-m-t", strtotime($today));

            }

            if($time_frame=="Year")
            {

                $date_from = date("Y-01-01", strtotime($today));

                //$date_to = date("Y-12-t", strtotime($today));

                $date_to = date("Y-m-d");

            }


        $filter_type = $this->request->getGet('filter_type');

        $data['month_year'] = date('M Y',strtotime($date_to));

        $data['account_heads'] = $this->report_model->FetchPLAccount($date_from,$date_to);


        $data['content'] = view('accounts/pl_account_report',$data);


        return view('accounts/report-module',$data);


        }
        else
        {

        $data['month_year'] = "";

        $data['account_heads'] = array();

        $data['content'] = view('accounts/pl_account_report',$data);


        return view('accounts/accounts-module',$data);

        }
        

     


    }




    public function RPSummery()
    { 
 
    
    $data['accounts'] = $this->common_model->FetchAllOrder('accounts_account_heads','ah_account_name','asc');


    if($_GET)

    {

    $start_date = "";

    if(!empty($this->request->getGet('start_date')))
    {
    $start_date = date('Y-m-d',strtotime($this->request->getGet('start_date')));
    }

    $filter_account = $this->request->getGet('filter_account');

    $data['all_accounts'] = $this->report_model->RPSummery($filter_account,$start_date);

    
    $data['content'] = view('accounts/receivables_payable_summary_report',$data);

    return view('accounts/report-module',$data);

    }

    else
    {

    $data['all_accounts'] = array();

    
    $data['content'] = view('accounts/receivables_payable_summary_report',$data);

    return view('accounts/accounts-module',$data);

    }



    }








    public function BalanceSheet()
    {



        if(!empty($_GET))
        {

        $start_date = "";
        $end_date ="";

        $time_frame = $this->request->getGet('filter_timeframe');

        if($time_frame=="Range"){

        if(!empty($this->request->getGet('start_date')))
        {
        $start_date = date('Y-m-d',strtotime($this->request->getGet('start_date')));
        }

        if(!empty($this->request->getGet('end_date')))
        {
        $end_date = date('Y-m-d',strtotime($this->request->getGet('end_date')));
        }

        }

        else
        {

        
        
        $start_date="";

        $end_date="";
        

        }

        $data['account_heads'] = $this->report_model->BalanceSheet($time_frame,$start_date,$end_date);

        $data['content'] = view('accounts/balance_sheet_report',$data);

        return view('accounts/report-module',$data);

    }

    else
        {

        $data['account_heads'] = array();

        $data['content'] = view('accounts/balance_sheet_report',$data);

        return view('accounts/accounts-module',$data);
            
        }

        



    }




    public function Print(){

    $id =13;

    $cond = array('r_id' => $id);

    ##Joins if any //Pass Joins as Multi dim array
    $joins = array(
              
           array(
           'table' => 'master_receipt_method',
           'pk' => 'rm_id',
           'fk' => 'r_method',
           ),
   
           array(
           'table' => 'master_banks',
           'pk' => 'bank_id',
           'fk' => 'r_bank',
           ),
   
           array(
           'table' => 'accounts_charts_of_accounts',
           'pk' => 'ca_id',
           'fk' => 'r_debit_account',
           ),
   
           array(
           'table' => 'master_collectors',
           'pk' => 'col_id',
           'fk' => 'r_collected_by',
           ),
   
       );
   
    $receipt = $this->common_model->SingleRowJoin('accounts_receipts',$cond,$joins);


    $total_amount = NumberToWords::transformNumber('en',$receipt->r_amount); // outputs "fifty dollars ninety nine cents"
   
       $joins_inv = array(
           array(
           'table' => 'crm_proforma_invoices',
           'pk' => 'pf_id',
           'fk' => 'ri_invoice',
           ),

           array(
            'table' => 'crm_customer_creation',
            'pk' => 'cc_id',
            'table2' => 'crm_proforma_invoices',
            'fk' => 'pf_customer',
           ),
   
       );
   
    $invoices = $this->common_model->FetchWhereJoin('accounts_receipt_invoices',array('ri_receipt'=>$id),$joins_inv);
   

    $invoice_sec = "";

    $first = true;

    
    foreach($invoices as $inv)
    {

    if($first == true)
    {
        $cus_name = $inv->cc_customer_name;
    }
    else
    {
        $cus_name="";
    }

    $invoice_sec .="
    
    <tr>

    <td>{$cus_name}</td>

    <td>{$inv->pf_reffer_no}</td>

    <td>".date('d-m-Y',strtotime($inv->pf_date))."</td>

    <td>{$inv->pf_total_amount}</td>

    <td>15-01-2024</td>

    <td>{$inv->pf_total_amount}</td>
    
    </tr>

    ";

    $first = false;

    }



    $mpdf = new \Mpdf\Mpdf([
        'format' => 'Letter',
        'default_font_size' => 9, 
        'margin_left' => 5, 
        'margin_right' => 5, 
    ]);


    
    $html ='

    <style>
    th, td {
        padding-top: 10px;
        padding-bottom: 10px;
        padding-left: 5px;
        padding-right: 5px;
      }
    </style>

    <table>
    
    <tr>
    
    <td>

    <h3>Al Fuzail Engineering Services WLL</h3>
    <p>Tel : +974 4460 4254, Fax : 4029 8994, email : engineering@alfuzailgroup.com</p>
    <p>Post Box : 201978, Gate : 248, Street : 24, Industrial Area, Doha - Qatar</p>
    
    
    </td>
    
    </tr>

    </table>



    <table width="100%" style="margin-top:10px;">
    

    <tr width="100%">
    
    <td align="right"><h3>Receipt Voucher</h3></td>

    </tr>

    </table>


    <table  width="100%" style="margin-top:2px;border-top:3px solid;border-bottom:3px solid;">

    <tr>
    
    <td width="50%">
    
    Reference : '.$receipt->r_ref_no.'
    
    </td>
    
        
    <td width="50%" align="right">
    
    Received By : '.$receipt->rm_name.'

    </td>
    
    </tr>


    <tr>
    
    <td width="50%">
    
    Date : '.date('d-m-Y',strtotime($receipt->r_date)).'
    
    </td>
    
        
    <td width="50%" align="right">
    
    Cheque : 90289

    </td>
    
    </tr>


    <tr>
    
    <td width="50%">
    
    Debit Account : '.$receipt->ca_name.'
    
    </td>
    
        
    <td width="50%" align="right">
    
    Date : 10-02-2923

    </td>
    
    </tr>


    <tr>
    
    <td width="50%">
    
    Receipt No : '.$receipt->r_number.'
    
    </td>
    
        
    <td width="50%" align="right">
    
    Bank : '.$receipt->bank_name.'

    </td>
    
    </tr>



    <tr>
    
    <td width="50%">
    
    Division No : RV-2020-0418
    
    </td>
    
        
    <td width="50%" align="right">
    
    Collected By : '.$receipt->col_name.'
    
    </td>
    
    </tr>


    
    </table>




    <table  width="100%" style="margin-top:2px;">
    

    <tr  style="border-bottom:3px solid;">
    
    <th align="left">Credit Account</th>

    <th align="left">Reference</th>

    <th align="left">Invoice Date</th>

    <th align="left">Invoice Amount</th>

    <th align="left">Due Date</th>

    <th align="left">Payment</th>

    </tr>


   '.$invoice_sec.'


    <tr style="padding-top:20px;">
    
    <td colspan="5">Reallocation</td>

    <td>9000.00</td>
    
    </tr>


    <tr style="padding-top:20px;">
    
    <td colspan="5">Discount</td>

    <td>9000.00</td>
    
    </tr>

    </table>

    ';

    $footer = '

    <table width="100%">
    
    <tr>
    
    <td colpsan="5" align="left"><b>Amount : Qatari Riyals '.$total_amount.' Only</b></td>

    <td colspan="1" align="left" style="text-align:right;"><b>'.$receipt->r_amount.'</b></td>

    </tr>

    </table>


    <table>
    
    <tr>

    <th width="25%" style="padding-right:60px;">Prepared by : (print)</th>

    <th width="25%" style="padding-right:60px;">Received by:</th>

    <th width="25%" style="padding-right:60px;">Finance Manager</th>

    <th width="25%" style="padding-right:60px;">CEO</th>

    </tr>

    </table>


    ';

    
    $mpdf->WriteHTML($html);
    $mpdf->SetFooter($footer);
    $this->response->setHeader('Content-Type', 'application/pdf');
    $mpdf->Output();

    }











}
