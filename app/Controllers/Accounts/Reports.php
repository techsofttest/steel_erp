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

        $account_name = "";

        if($filter_type=="Account" && !empty($this->request->getGet('filter_account')))
        {

        $account = $this->request->getGet('filter_account');

        $data['account_name'] = $this->common_model->SingleRowJoin('accounts_charts_of_accounts',array('ca_id' => $account),array())->ca_name;

        if(!empty($data['account_name']))
        {
        $account_name = $data['account_name'];
        }

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
            $data['open_balance'] = 0;
        }
        
        //$start_date = date('Y-m-d',strtotime('01-01-2024'));


        //$end_date = date('Y-m-d',strtotime('04-02-2024'));


        //$data['payments'] = $this->report_model->FetchGLPayments($start_date,$end_date,$account_head,$account_type,$account,$time_frame);


        //$data['receipts'] = $this->report_model->FetchGLReceipts($start_date,$end_date,$account_head,$account_type,$account,$time_frame);

        //$data['open_balance'] =$this->report_model->FetchGlOpenBalance($start_date,$end_date,$account_head,$account_type,$account,$time_frame);


       //$data['vouchers']=$this->report_model->FetchGLTransactions($start_date,$end_date,$account_head,$account_type,$account,$time_frame,$range_from,$range_to);

        


        $data['vouchers']=$this->report_model->FetchGLTransactions($start_date,$end_date,$account_head,$account_type,$account,$time_frame,$range_from,$range_to);

       
        
        //Gen PDF

        if (!empty($_POST['pdf']) || (isset($_GET['action']) && $_GET['action'] == "Print")) 
        {
        
                if(!empty($data['vouchers']))
                {   
                    $pdf_data = "";

                    $total_debit = 0;

                    $total_credit = 0;

                    $balance = 0;

                    foreach($data['vouchers'] as $vc)
                    {   

                        if($vc->debit_amount<1){ $vc->debit_amount = NULL; }

                        if($vc->credit_amount<1){ $vc->credit_amount = NULL; }

                        $q=1;

                        $border="border-top: 2px solid";
                       
                        $total_debit = $total_debit + $vc->debit_amount;

                        $total_credit = $total_credit + $vc->credit_amount;
        
                        $new_date = date('d-M-Y',strtotime($vc->transaction_date));
        
                        $pdf_data .= "<tr align='center'><td >{$new_date}</td>";

                        $pdf_data .= "<td align='center'>{$vc->reference}</td>";

                        $pdf_data .= "<td align='center'>{$vc->voucher_type}</td>";
        
                        $pdf_data .= "<td >{$vc->account_name}</td>";


                    


                        if($vc->debit_amount !="") { 

                        $debit_am = format_currency($vc->debit_amount);

                        $balance = $balance+$vc->debit_amount; 

                        $total_debit = $total_debit+$vc->debit_amount;

                        } else if($vc->credit_amount<0) {

                        $debit_am = format_currency($vc->credit_amount); 

                        $balance = $balance-$vc->credit_amount;

                        $total_debit = $total_debit+$vc->credit_amount;
                            
                        }
                        else
                        {
                        $debit_am="";
                        }

                        $pdf_data .= "<td align='right' >{$debit_am}</td>";


                        if($vc->credit_amount !="" && $vc->credit_amount>0) {

                            $credit_am = format_currency($vc->credit_amount);

                            $balance = $balance-$vc->credit_amount; 

                            $total_credit = $total_credit+$vc->credit_amount;

                        } else {

                            $credit_am ="";

                        }
        
                        $pdf_data .= "<td align='right'>{$credit_am}</td>";
                        
                        $pdf_data .= "<td  align='right'>(".format_currency($balance).")</td>";
                        
                        $pdf_data .="</tr>";
                       
                        
                    }
        
                    if(empty($start_date) && empty($end_date))
                    {
                     
                       $dates = "-";
                    }
                    else
                    {
                       $dates = date('d-F-Y',strtotime($start_date)) . " to " . date('d-F-Y',strtotime($end_date));
                    }
        
                    
        
                    $title = "General Ledger Report ".date('d-M-Y')."";
        
                    $mpdf = new \Mpdf\Mpdf(
        
                        [
                            'format' => 'A4', // Set page size to A3
                            'margin_left' => 5,
                            'margin_right' => 5,
                            'margin_top' => 10,
                            'margin_bottom' => 10,
                            'margin_header' => 5,
                            'margin_footer' => 5,
                        ]
                    );
        
                 
        
                    $mpdf->SetTitle('General Ledger Report'); // Set the title
        
                    $html ='
                
                    <style>
                    th, td {
                        padding-top: 5px;
                        padding-bottom: 5px;
                        padding-left: 10px;
                        padding-right: 10px;
                        font-size: 12px;
                    }
                    p{
                        
                        font-size: 12px;
        
                    }
                    .dec_width
                    {
                        width:30%
                    }
                    .disc_color
                    {
                        color:red;
                    }
                    
                    </style>
                
                    <table>
                    
                    <tr>
                    
                    
                
                    <td>
                
                    <h2>Al Fuzail Engineering Services WLL</h2>
                    <div><p class="paragraph-spacing">Tel : +974 4460 4254, Fax : 4029 8994, email : engineering@alfuzailgroup.com</p></div>
                    <p>Post Box : 201978, Gate : 248, Street : 24, Industrial Area, Doha - Qatar</p>
                    
                    
                    </td>
                    
                    </tr>
                
                    </table>
                
                
                
                    <table width="100%" style="margin-top:5px;">
                    
                
                    <tr width="100%">

                    <td width="100%" colspan="5" align="right"><h2>General Ledger</h2></td>
                
                    <hr style="height:3px;border:none;color:#333;background-color:#333;margin-top:0">

                    </tr>


                    <tr width="100%">

                    <td width="15%">
                    Account : 
                    </td>

                    <td>

                    '.$account_name.'

                    </td>

                    </tr>



                    <tr width="100%">

                    <td width="15%">
                    Period :
                    </td>

                    <td >
                    
                    '.$dates.'

                    </td>

                    </tr>


                    <tr width="100%">

                    <td width="15%">
                    Division :    
                    </td>

                    <td>
                    
                    Al Fuzail

                    </td>

                    </tr>



                
                    </table>
                   
                
                    <table  width="100%" style="margin-top:1px;border-collapse: collapse; border-spacing: 0;border-top:2px solid;">
                    
                
                    <tr>
                    
                    <td align="center">Date</td>
                
                    <td align="center">Voucher No</td>
                
                    <td align="center">Voucher Type</td>
                
                    <td align="left">Related Account</td>
                
                    <td align="right">Debit Amt</td>
        
                    <td align="right">Credit Amt</td>
        
                    <td align="right">Balance</td>
        
                    </tr>


                   

                    <tr>


                    <td align="left" style="border-top: 2px solid"></td>
                
                    <td align="left" style="border-top: 2px solid"> </td>
                
                    <td align="left" style="border-top: 2px solid"></td>
                
                    <td align="left" style="border-top: 2px solid">Beginning Balance</td>
                
                    <td align="right" style="border-top: 2px solid"></td>
        
                    <td align="right" style="border-top: 2px solid"></td>
        
                    <td align="right" style="border-top: 2px solid">0.00</td>
                    
                    
                    </tr>
                    



                     
                    '.$pdf_data.'
        
                    <tr>
                        <td style="border-top: 2px solid;"></td>
                        <td style="border-top: 2px solid;"></td>
                        <td style="border-top: 2px solid;"></td>
                        <td style="border-top: 2px solid;"><b>Ending Balance</b></td>
                        <td align="right" style="border-top: 2px solid;"><b>'.format_currency($total_debit).'</b></td>
                        <td align="right" style="border-top: 2px solid;"><b>'.format_currency($total_credit).'</b></td>
                        <td align="right" style="border-top: 2px solid;"><b>'.format_currency($balance).'</b></td>
                        
                    </tr>    
                   
                    
                    </table>
        
        
                
                    ';
                
                    //$footer = '';
                
                    
                    $mpdf->WriteHTML($html);
                   
                   // $mpdf->SetFooter($footer);

                    $this->response->setHeader('Content-Type', 'application/pdf');

                    $mpdf->Output($title . '.pdf', 'I');

                    exit();
                
                }
        
               

        }


        //



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

        //$data['post_dated_cheques'] = $this->report_model->SOAPostDatedCheques($start_date,$end_date,$account);

        $account = $this->common_model->SingleRow('accounts_charts_of_accounts',array('ca_id' => $account))->ca_name;

        //$data['payments'] = $this->report_model->SOAPayments($start_date,$end_date,$account);

        //$data['receipts'] = $this->report_model->SOAReceipts($start_date,$end_date,$account);


        $data['content'] = view('accounts/statement_of_accounts',$data);


        if(!empty($_POST['pdf']))
        {

            $balance =0;

            $total_credit=number_format(0,2);

            $total_debit=number_format(0,2);

            $pdf_data ="";


            if(empty($start_date) && empty($end_date))
            {
                
                $dates = "-";
            }
            else
            {
                $dates = date('d-F-Y',strtotime($start_date)) . " to " . date('d-F-Y',strtotime($end_date));
            }



            foreach($data['vouchers'] as $vc){ 

                if(!empty($vc->debit_amount)) { $vc->debit_amount = $vc->debit_amount;  } else{ $vc->debit_amount = ""; }

                if(!empty($vc->credit_amount)) { $vc->credit_amount = $vc->credit_amount;  } else{ $vc->credit_amount = ""; }


                

                if(!empty($vc->debit_amount))
                {
                $balance = $balance-$vc->debit_amount;  
                }
                else
                {
                $balance = $balance+$vc->credit_amount;    
                }

               

                $pdf_data .='

                <tr>
                
                <td align="">'.$vc->reference.'</td>
                
                <td align="right">'.date('d-m-Y',strtotime($vc->voucher_date)).'</td>
                
                <td align="right">'.$vc->debit_amount.'</td>
                
                <td align="right">'.$vc->credit_amount.'</td>
                
                <td align="right">
                
                '.$balance.'
                
                </td>

                </tr>
                ';

                if(!empty($vc->credit_amount)){
                $total_credit = $total_credit+$vc->credit_amount;
                }

                if(!empty($vc->debit_amount)){
                $total_debit = $total_debit+$vc->debit_amount;
                }

                } 
           
    
                
    
                $title = "GLR";
    
                $mpdf = new \Mpdf\Mpdf(
    
                    [
                        'format' => 'A3', // Set page size to A3
                        'margin_left' => 15,
                        'margin_right' => 15,
                        'margin_top' => 16,
                        'margin_bottom' => 16,
                        'margin_header' => 9,
                        'margin_footer' => 9,
                    ]
                );
    
    
                if(empty($start_date) && empty($end_date))
                {
                 
                   $dates = "";
                }
                else
                {
                   $dates = date('d-F-Y',strtotime($start_date)) . " to " . date('d-F-Y',strtotime($end_date));
                }
    
             
    
                $mpdf->SetTitle('Statements Of Accounts'); // Set the title
    
                $html ='
            
                <style>

                .content-table th 
                {
                border-top: 1px solid rgba(100,100,100, .3);
                }

                .content-table td 
                {
                border-top: 1px solid rgba(100,100,100, .3);
                }


                th, td {
                    padding-top: 10px;
                    padding-bottom: 10px;
                    padding-left: 5px;
                    padding-right: 5px;
                    font-size: 12px;
                }
                p{
                    
                    font-size: 12px;
    
                }
                .dec_width
                {
                    width:30%
                }
                .disc_color
                {
                    color:red;
                }
                
                </style>
            
                <table>
                
                <tr>
                
            
                <td>
            
                <h3>Al Fuzail Engineering Services WLL</h3>
                <div><p class="paragraph-spacing">Tel : +974 4460 4254, Fax : 4029 8994, email : engineering@alfuzailgroup.com</p></div>
                <p>Post Box : 201978, Gate : 248, Street : 24, Industrial Area, Doha - Qatar</p>
                
                
                </td>
                
                </tr>
            
                </table>
            
            
            
                <table width="100%" style="margin-top:10px;">
                
            
                <tr width="100%">
                <td align="right"><h3>Statements Of Accounts</h3></td>
            
                <hr>
    
                </tr>


                <tr width="100%">
    
                <td>
                Customer : '.$account.' 
                </td>
    
                </tr>

                

                <tr width="100%">
    
                <td>
                Attention : Accounts Department
                </td>
    
                </tr>
    
    
                <tr width="100%">
    
                <td>
                Period : '.$dates.'
                </td>
    
                </tr>
    
    
                
    
            
                </table>
               
            
                <table class="content-table"  width="100%" style="margin-top:2px;border-collapse: collapse; border-spacing: 0;border-top:2px solid;">
                
            
                <tr>
                
              
                <th align="left">Voucher Number</th>
            
                <th align="right">Date</th>
    
                <th align="right">Debit Amount</th>
    
                <th align="right">Credit Amount</th>
    
                <th align="right">Balance</th>
    
                </tr>
    
                 
                '.$pdf_data.'
    
                <tr >
                
                <th></th>

                <th align=""></th>
            
                <th align="right">'.format_currency($total_debit).'</th>
            
                <th align="right">'.format_currency($total_credit).'</th>

                <th align=""></th>
                
    
                </tr>
    
    
                
                </table>
    
    
            
                ';
            
                //$footer = '';
            
                
                $mpdf->WriteHTML($html);
               
               // $mpdf->SetFooter($footer);
                $this->response->setHeader('Content-Type', 'application/pdf');
                $mpdf->Output($title . '.pdf', 'I');
    
        }



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



        if (!empty($_POST['pdf']) || (isset($_GET['action']) && $_GET['action'] == "Print")) 
        {


            if(!empty($data['c_accounts']))
            {   
                $pdf_data = "";

                $total_debit = 0;

                $total_credit = 0;

                $total_deb=number_format(0,2);

                $total_cred=number_format(0,2);

                foreach($data['c_accounts'] as $account)
                {   
                    $q=1;

                    $border="border-top: 2px solid";

                    $total_deb = $total_deb+ $account->total_debit;

                    $total_cred = $total_cred + $account->total_credit; 


                   $pdf_data .="";

    
                    $pdf_data .= "<tr><td >{$account->ca_name}</td>";

                    if(empty ($account->start_balance))
                    {
                    $start_balance = 0.00;
                    }
                    else
                    {
                    $start_balance = $account->start_balance;
                    }

                    $pdf_data .= "<td  align='right'>{$start_balance}</td>";
    
                    $pdf_data .= "<td  align='right'>".format_currency($account->total_debit)."</td>";

                    $pdf_data .= "<td  align='right'>".format_currency($account->total_credit)."</td>";

                    $pdf_data .= "<td  align='right'>".$account->net_change."</td>";

                    $pdf_data .= "<td  align='right'>".$account->balance   ."</td>";

                    $pdf_data .="</tr>";
                   
                    
                }




                $pdf_data .='
                <tr class="no-sort">
                        <td align=""><b style="font-size:20px;">Total</b></td>
                        <td align="right"><b>(0.00)</b></td>
                        <td align="right"><b>'.$total_deb.'</b></td>
                        <td align="right"><b>'.$total_cred.'</b></td>
                        <td align="right"><b>0.00</b></td>
                        <td align="right"><b>0.00</b></td>
                </tr>';


    
                if(empty($date_from) && empty($date_to))
                {
                 
                   $dates = "-";
                }
                else
                {
                   $dates = date('d-F-Y',strtotime($date_from)) ." to ". date('d-F-Y',strtotime($date_to));
                }

                
    
                $title = "Trial Balance Report ".date('d-M-Y')."";
    
                $mpdf = new \Mpdf\Mpdf(
    
                    [
                        'format' => 'A4', // Set page size to A3
                        'margin_left' => 5,
                        'margin_right' => 5,
                        'margin_top' => 10,
                        'margin_bottom' => 10,
                        'margin_header' => 5,
                        'margin_footer' => 5,
                    ]
                );
    
             
    
                $mpdf->SetTitle('Trial Balance Report'); // Set the title
    
                $html ='
            
                <style>
                th, td {
                    padding-top: 5px;
                    padding-bottom: 5px;
                    padding-left: 5px;
                    padding-right: 5px;
                    font-size: 12px;
                }
                p{
                    
                    font-size: 12px;
    
                }
                .dec_width
                {
                    width:30%
                }
                .disc_color
                {
                    color:red;
                }
                
                </style>
            
                <table>
                
                <tr>
                
                
            
                <td>
            
                <h2>Al Fuzail Engineering Services WLL</h2>
                <div><p class="paragraph-spacing">Tel : +974 4460 4254, Fax : 4029 8994, email : engineering@alfuzailgroup.com</p></div>
                <p>Post Box : 201978, Gate : 248, Street : 24, Industrial Area, Doha - Qatar</p>
                
                
                </td>
                
                </tr>
            
                </table>
            
            
            
                <table width="100%" style="margin-top:5px;">
                
            
                <tr width="100%">

                <td colspan="5" align="right">
                <h2>Trial Balance</h2>
                </td>
            
                <hr style="height:3px;border:none;color:#333;background-color:#333;margin-top:0">

                </tr>


                <tr width="100%">

                <td width="15%">
                Period : 
                </td>

                <td>'.$dates.'</td>

                </tr>


                <tr width="100%">

                <td width="15%">
                Division :
                </td>

                <td align="left">Al Fuzail</td>

                </tr>

            
                </table>
               
            
                <table  width="100%" style="margin-top:2px;border-collapse: collapse; border-spacing: 0;border-top:2px solid;">
                
            
                <tr>
                
                <td align="right" style="border-bottom: 1px solid">Account</td>
            
                <td align="right" style="border-bottom: 1px solid">Begining Balance</td>
            
                <td align="right" style="border-bottom: 1px solid">Debit Change</td>
            
                <td align="right" style="border-bottom: 1px solid">Credit Change</td>
            
                <td align="right" style="border-bottom: 1px solid">Net Change</td>
    
                <td align="right" style="border-bottom: 1px solid">Ending Balance</td>
    
                </tr>

                 
                '.$pdf_data.'

                <tr>
                
                <th align="left"></th>
            
                <th align="left"></th>
            
                <th align="left"></th>
            
                <th align="left"></th>
            
                <th align="right"></th>
    
                <th align="right"></th>
    
                </tr>


                </table>
    
                ';
            
                //$footer = '';
            
                $mpdf->SetJS('this.print();');
                
                $mpdf->WriteHTML($html);
               
               // $mpdf->SetFooter($footer);

                $this->response->setHeader('Content-Type', 'application/pdf');

                $mpdf->Output($title . '.pdf', 'I');

                exit();

                
            
        }

        }



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

        if(empty($date_to))
        {
        $data['month_year'] ="";
        }

        $data['account_heads'] = $this->report_model->FetchPLAccount($date_from,$date_to);


        $data['content'] = view('accounts/pl_account_report',$data);

        if (!empty($_POST['pdf']) || (isset($_GET['action']) && $_GET['action'] == "Print")) 
        {


            $total_credit=0;

            $grand_total_ytd = 0;

            if(!empty($data['account_heads']))
            {   
                $pdf_data = "";

                $total_debit = 0;

                $total_credit = 0;

                foreach($data['account_heads'] as $ah)
                {   

                    $total_ytd = number_format(0,2); 
                    $total_first_month = number_format(0,2); 
                    foreach($ah->Charts as $ca)
                    {
                    $total_ytd = $total_ytd+$ca->ytd_total;
                    $grand_total_ytd = $grand_total_ytd + $ca->ytd_total;

                    $total_first_month = $total_first_month + $ca->tran_total;

                    }


                    $q=1;

                    $border="border-top: 2px solid";
    
                    $pdf_data .= "<tr style='border-top: 2px solid'>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>

                                            </tr>

                                            <tr style=''>

                                            <th style=''><b style='font-size:11px;text-decoration:underline'>".$ah->ah_account_name."</b></th>
                                           
                                            <td style=''></td>
                                            <td style=''></td>
                                            <td style=''></td>
                                            <td style=''></td>
                                            
                                            </tr>";


                                            $total_perc = 0;
                                            $total_fm_perc=0;
                                            foreach($ah->Charts as $ca)
                                            {

                                            if($ca->ytd_total>0)
                                            {
                                            $perc = number_format(($ca->ytd_total/$total_ytd)*100,2);
                                            } else
                                            {
                                            $perc=0;
                                            }

                                            if($ca->tran_total>0)
                                            {
                                            $fm_perc= number_format(($ca->tran_total/$total_first_month)*100,2);
                                            }
                                            else
                                            {
                                            $fm_perc=0;
                                            }

                 

                    $pdf_data .= "<tr style=''>

                                <td style=''>".$ca->ca_name."</td>";
                                

                                if(isset($ca->tran_total))
                                {
                                    $ca_tran_total = $ca->tran_total;
                                }
                                else
                                {
                                    $ca_tran_total=0;
                                }

                                $pdf_data .= "<td style='' align='right'>".$ca_tran_total."</td>
                                <td style='' align='right'>".$fm_perc." %</td>
                                <td style='' align='right'>".$ca->ytd_total."</td>
                                <td style='' align='right'>".$perc." %</td>
                                </tr>";

                                $total_perc = $total_perc+$perc;
                                $total_fm_perc=$total_fm_perc+$fm_perc;

                            }

                            $pdf_data .=' <tr style="">
                                        <th style="border-top: 2px solid" align="center"><b style="font-size:11px;">Total '.$ah->ah_account_name.'</b></th>
                                        <td style="border-top: 2px solid" align="right">'. $total_first_month.'</td>
                                        <td style="border-top: 2px solid" align="right">'.$total_fm_perc.' %</td>
                                        <td style="border-top: 2px solid" align="right">'.$total_ytd.'</td>
                                        <td style="border-top: 2px solid" align="right">'.$total_perc.' %</td>
                                        </tr>';
                    
                            }
    
                if(empty($date_from) && empty($date_to))
                {
                 
                   $dates = "";
                }
                else
                {
                   $dates = date('d M Y',strtotime($date_from)) . " to " . date('d M Y',strtotime($date_to));
                }


                $from_date_pdf = "";

                $to_date_pdf = "";

                if(!empty($from_date))
                {
                $from_date_pdf = $from_date;
                }

                if(!empty($to_date))
                {
                $to_date_pdf = $to_date;
                }
    
                
    
                $title = "GLR";
    
                $mpdf = new \Mpdf\Mpdf(
    
                    [
                        'format' => 'A4', // Set page size to A3
                        'margin_left' => 5,
                        'margin_right' => 5,
                        'margin_top' => 10,
                        'margin_bottom' => 10,
                        'margin_header' => 5,
                        'margin_footer' => 5,
                    ]
                );


                /*


                */
    
             
    
                $mpdf->SetTitle('Profit Loss Accounts Report'); // Set the title
    
                $html ='
            
                <style>
                th, td {
                    padding-top: 5px;
                    padding-bottom: 5px;
                    padding-left: 5px;
                    padding-right: 5px;
                    font-size: 12px;
                }
                p{
                    
                    font-size: 12px;
    
                }
                .dec_width
                {
                    width:30%
                }
                .disc_color
                {
                    color:red;
                }
                
                </style>
            
                <table>
                
                <tr>
                
            
                <td>
            
                <h2>Al Fuzail Engineering Services WLL</h2>
                <div><p class="paragraph-spacing">Tel : +974 4460 4254, Fax : 4029 8994, email : engineering@alfuzailgroup.com</p></div>
                <p>Post Box : 201978, Gate : 248, Street : 24, Industrial Area, Doha - Qatar</p>
                
                
                </td>
                
                </tr>
            
                </table>
            
            
            
                <table width="100%" style="margin-top:2px;">
                
            
                <tr width="100%">

                <td align="right" colspan="5"><h2>Income Statement</h2></td>
            
                <hr style="height:3px;border:none;color:#333;background-color:#333;margin-top:0">

                </tr>


                <tr width="100%">

                <td width="15%">
                Period :
                </td>

                <td> '.$dates.'</td>

                </tr>


                <tr width="100%">

                <td width="15%">
                Division : 
                </td>

                <td>
                Al Fuzail
                </td>

                </tr>

            
                </table>
               
            
                <table  width="100%" style="margin-top:2px;border-collapse: collapse; border-spacing: 0;border-top:2px solid;">
                
            
                <tr>
                
                <td align="center" style="border-bottom:1px solid;">Description</td>
            
                <td align="right" style="border-bottom:1px solid;"></td>
            
                <td align="right" style="border-bottom:1px solid;"></td>
            
                <td align="right" style="border-bottom:1px solid;">Year To date</td>
    
                <td align="right" style="border-bottom:1px solid;"></td>

                
    
                </tr>

                 
                '.$pdf_data.'

                <tr>
                
                <th align="left"></th>
            
                <th align="left"></th>
            
                <th align="left"></th>
            
                <th align="left"></th>
            
                <th align="right"></th>
    
                <th align="right"></th>
    
                </tr>


               
                
                </table>
    
    
            
                ';
            
                //$footer = '';
            
                
                $mpdf->WriteHTML($html);
               
               // $mpdf->SetFooter($footer);
                $this->response->setHeader('Content-Type', 'application/pdf');
                $mpdf->Output($title . '.pdf', 'I');
            
        }



        }

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


    if (!empty($_POST['pdf']) || (isset($_GET['action']) && $_GET['action'] == "Print")) 
    {


        if(!empty($start_date))
        {
        $date_pdf = date('d-F-Y',strtotime($start_date));
        }
        else{
        $date_pdf="-";
        }

        $pdf_data ="";

        $total_rec    = number_format(0,2);

            $total_thirty = number_format(0,2);

            $total_sixty  = number_format(0,2);
            
            $total_ninety = number_format(0,2);

            $total_above = number_format(0,2);

            foreach($data['all_accounts'] as $ac) {
                
            $grand_total = 0;

            $grand_total = $ac->ThirtyDays+$ac->SixtyDays+$ac->NinetyDays+$ac->AboveNinetyDays;


            if(empty($ac->ThirtyDays))
            {
            $ac_30 = "---";
            }
            else
            {
            $ac_30 = $ac->ThirtyDays;
            }

            if(empty($ac->SixtyDays))
            {
            $ac_60 ="---";
            }
            else
            {
            $ac_60 = $ac->SixtyDays;    
            }

            if(empty($ac->NinetyDays))
            {
            $ac_90 ="---";
            }
            else
            {
            $ac_90 = $ac->NinetyDays;    
            }

            if(empty($ac->AboveNinetyDays))
            {
            $ac_a90 ="---";
            }
            else
            {
            $ac_a90 = $ac->AboveNinetyDays;    
            }

            $pdf_data .='
            
            <tr> 
                <td align="left" class="border-top">'.$ac->cc_customer_name.'</td>
                <td align="right" class="border-top">'.format_currency($grand_total).'</td>
                <td align="right" class="border-top">'.$ac_30.'</td>
                <td align="right" class="border-top">'.$ac_60.'</td>
                <td align="right" class="border-top">'.$ac_90.'</td>
                <td align="right" class="border-top">'.$ac_a90.'</td>
            </tr>

            ';


            if($grand_total>0)
            {
            $total_rec = $total_rec+$grand_total;
            }

            $total_thirty = $total_thirty+$ac->ThirtyDays;
           
            $total_sixty  =  $total_sixty+$ac->SixtyDays;
            
            $total_ninety = $total_ninety+$ac->NinetyDays;

            $total_above = $total_above+$ac->AboveNinetyDays;
        }   


        $pdf_footer='

        <tfoot>

        <tr class="no-sort">
       
        <td class="border-top"><b style="font-size:20px;" align="right">Total</b></td>
        <td align="right" class="border-top"><b>'.format_currency($total_rec).'</b></td>
        <td align="right" class="border-top"><b>'.format_currency($total_thirty).'</b></td>
        <td align="right" class="border-top"><b>'.format_currency($total_sixty).'</b></td>
        <td align="right" class="border-top"><b>'.format_currency($total_ninety).'</b></td>
        <td align="right" class="border-top"><b>'.format_currency($total_above).'</b></td>

        </tfoot>
        ';




            

            $title = "GLR";

            $mpdf = new \Mpdf\Mpdf(

                [
                    'format' => 'A4', // Set page size to A3
                    'margin_left' => 5,
                    'margin_right' => 5,
                    'margin_top' => 10,
                    'margin_bottom' => 10,
                    'margin_header' => 5,
                    'margin_footer' => 5,
                ]
            );


            if(empty($start_date) && empty($end_date))
            {
             
               $dates = "";
            }
            else
            {
               $dates = date('d M Y',strtotime($start_date));
            }

         

            $mpdf->SetTitle('Receivables Payables Summery'); // Set the title

            $html ='
        
            <style>
            .border-top
            {
            border-top: 1px solid rgba(100,100,100, .3);
            }
            th, td {
                padding-top: 5px;
                padding-bottom: 5px;
                padding-left: 5px;
                padding-right: 5px;
                font-size: 12px;
            }
            p{
                
                font-size: 12px;

            }
            .dec_width
            {
                width:30%
            }
            .disc_color
            {
                color:red;
            }
            
            </style>
        
            <table>
            
            <tr>
            
        
            <td>
        
            <h2>Al Fuzail Engineering Services WLL</h2>
            <div><p class="paragraph-spacing">Tel : +974 4460 4254, Fax : 4029 8994, email : engineering@alfuzailgroup.com</p></div>
            <p>Post Box : 201978, Gate : 248, Street : 24, Industrial Area, Doha - Qatar</p>
            
            
            </td>
            
            </tr>
        
            </table>
        
        
        
            <table width="100%" style="margin-top:10px;">
            
        
            <tr width="100%">
            <td align="right" colspan="5"><h2>Receivables / Payables Summery</h2></td>
        
           <hr style="height:3px;border:none;color:#333;background-color:#333;margin-top:0">

            </tr>


            <tr width="100%">

            <td width="15%">
            Period : 
            </td>

            <td >
            
            '.$dates.'

            </td>

            </tr>


            <tr width="100%">

            <td width="15%">
            Division : 
            </td>

            <td>
            
            Al Fuzail

            </td>



            </tr>

        
            </table>
           
        
            <table  width="100%" style="margin-top:2px;border-collapse: collapse; border-spacing: 0;border-top:2px solid;">
            
        
            <tr>
            
          
            <td align="center">Name Of Customer</td>
        
            <td align="right">Amount</td>

            <td align="right">0-30 Days</td>

            <td align="right">31-60 Days</td>

            <td align="right">61-90 Days</td>

            <td align="right">Above 90 Days</td>

            </tr>

             
            '.$pdf_data.'

            <tr>
            
            <th align="left"></th>
        
            <th align="left"></th>
        
            <th align="left"></th>
            

            </tr>


            '.$pdf_footer.'
           
            
            </table>


        
            ';
        
            //$footer = '';
        
            
            $mpdf->WriteHTML($html);
           
           // $mpdf->SetFooter($footer);
            $this->response->setHeader('Content-Type', 'application/pdf');
            $mpdf->Output($title . '.pdf', 'I');

            exit;

    }


    
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

        $border="border-top: 2px solid";

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


        if($time_frame=="CurrentYear")
            {

            $start_date = date("Y-01-01", strtotime("date(Y-m-d)"));

            //$date_to = date("Y-12-t", strtotime($today));

            $end_date = date("Y-m-d");

            }


        if($time_frame=="LastYear")
        {

        $start_date = date("Y-01-01", strtotime("last year January 1st"));

        //$date_to = date("Y-12-t", strtotime($today));

        $end_date = date("Y-m-d",strtotime(("last year December 31st")));

        }


        //Fetch Balance Sheets

        $data['account_heads'] = $this->report_model->BalanceSheet($time_frame,$start_date,$end_date);

        //Fetch Next Balance Sheet For Validation


        if (!empty($_POST['pdf']) || (isset($_GET['action']) && $_GET['action'] == "Print")) 
        {

            $pdf_data ="";

            foreach($data['account_heads'] as $ah){

            $pdf_data .='<tr>

                <td style="text-decoration:underline" align="center"><b>' .$ah->ah_account_name.'</b></td>

                <td style=""> </td>

                <td style=""></td>
                
                </tr>';

            $total_bal = number_format(0,2);

            foreach($ah->Charts as $ca){ 
            $total_bal = $ca->balance + $total_bal;
            }

            $total_perc = 0;

                    foreach($ah->Charts as $ca){ 
                    
                    if($ca->balance>0)
                    {
                    $perc = ($ca->balance/$total_bal)*100;
                    } else
                    {
                    $perc=0;
                    }
                    $total_perc= $total_perc+$perc;


                $pdf_data .='

                    <tr>

                    <td  style="">'.$ca->ca_name.'</td>

                    <td align="right" style="">'.format_currency($ca->balance).'</td>

                    <td align="right" style="">'.number_format($perc,2).' %</td>


                    </tr>';

                    
               } 


                $pdf_data .='
                <tr>

              

                <td align="center" style="'.$border.'">Total '.$ah->ah_account_name.'</td>

                <td style="'.$border.'" align="right">'.format_currency($total_bal).'</td>

                <td style="'.$border.'"  align="right">'.number_format($total_perc,2).' %</td>

                </tr>


                <tr>

                

                <td></td>

                <td></td>

                <td></td>

                </tr>
                ';
    


                
    
                
    
                $title = "Balance Sheet Report ".date('d M Y')."";
    
                $mpdf = new \Mpdf\Mpdf(
    
                    [
                        'format' => 'A4', // Set page size to A3
                        'margin_left' => 5,
                        'margin_right' => 5,
                        'margin_top' => 10,
                        'margin_bottom' => 10,
                        'margin_header' => 5,
                        'margin_footer' => 5,
                    ]
                );


                if(empty($start_date) && empty($end_date))
                {
                 
                   $dates = "";
                }
                else
                {
                   $dates = date('d-F-Y',strtotime($start_date)) . " to " . date('d-F-Y',strtotime($end_date));
                }
    
             
    
                $mpdf->SetTitle('Balance Sheet Report'); // Set the title
    
                $html ='
            
                <style>
                th, td {
                    padding-top: 5px;
                    padding-bottom: 5px;
                    padding-left: 5px;
                    padding-right: 5px;
                    font-size: 12px;
                }
                p{
                    
                    font-size: 12px;
    
                }
                .dec_width
                {
                    width:30%
                }
                .disc_color
                {
                    color:red;
                }
                
                </style>
            
                <table>
                
                <tr>
                
            
                <td>
            
                <h2>Al Fuzail Engineering Services WLL</h2>
                <div><p class="paragraph-spacing">Tel : +974 4460 4254, Fax : 4029 8994, email : engineering@alfuzailgroup.com</p></div>
                <p>Post Box : 201978, Gate : 248, Street : 24, Industrial Area, Doha - Qatar</p>
                
                
                </td>
                
                </tr>
            
                </table>
            
            
            
                <table width="100%" style="margin-top:2px;">
                
            
                <tr width="100%">

                <td colspan="5" align="right"><h2>Balance Sheet</h2></td>
            
                <hr style="height:3px;border:none;color:#333;background-color:#333;margin-top:0">

                </tr>


                <tr width="100%">

                <td width="15%">
                Period : 
                </td>

                <td>
                
                '.$dates.'

                </td>

                </tr>



                <tr width="100%">

                <td width="15%">
                Division : 
                </td>

                <td>
                Al Fuzail
                </td>


                </tr>

            
                </table>
               
            
                <table  width="100%" style="margin-top:2px;border-collapse: collapse; border-spacing: 0;border-top:2px solid;">
                
            
                <tr>
              
                <td align="center" style="border-bottom:1px solid">Assets</td>
            
                <td align="center" style="border-bottom:1px solid">Amount</td>
    
                <td align="right" style="border-bottom:1px solid">%</td>

    
                </tr>

                 
                '.$pdf_data.'

                <tr>
                
                <th align=""></th>
            
                <th align=""></th>
            
                <th align=""></th>
                
    
                </tr>


               
                
                </table>
    
    
            
                ';
            
                //$footer = '';
            
                
                $mpdf->WriteHTML($html);
               
               // $mpdf->SetFooter($footer);
                $this->response->setHeader('Content-Type', 'application/pdf');
                $mpdf->Output($title . '.pdf', 'I');

                exit();


        }

    }


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
