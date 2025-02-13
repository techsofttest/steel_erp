<?php 

namespace App\Controllers\Accounts;  

use App\Controllers\BaseController;


class Reports extends BaseController
{

    //view page
    
    public function Ledger()
    {   

        /**/

        $data['status'] = "";

        $data['msg'] ="";
        
        $adminId = session('admin_id'); 

        $segment1 = service('uri')->getSegment(1);

        $segment2 = service('uri')->getSegment(2);

        $check_module = $this->common_model->CheckModule($adminId,$segment1,$segment2);

        
            
            if($check_module->up_add == 0){
            
                $this->session->setFlashdata('error','Access Denied: You do not have permission for this Action');
              
                return redirect()->to('Home');
            }

        
        
        
       
        /**/

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
        
                        $pdf_data .= "<tr> <td align='center'>{$new_date}</td>";

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


                    $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
                    $fontDirs = $defaultConfig['fontDir'];
         
                    $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
                    $fontData = $defaultFontConfig['fontdata'];

        
                    $mpdf = new \Mpdf\Mpdf([
                        'format' => 'Letter', // Custom page size in millimeters
                        //'format' => [300, 600], // Width: 300mm, Height: 600mm (custom large page)
                        'default_font_size' => 9, 
                        'margin_left' => 5, 
                        'margin_right' => 5,
                        'fontDir' => array_merge($fontDirs, [
                            __DIR__ . '/fonts'
                        ]),
                        'fontdata' => $fontData + [
                            'bentonsans' => [
                              
                                'R' => 'OpenSans-Regular.ttf',
                                'B' => 'OpenSans-Bold.ttf',
                            ],
                        ],
                        'default_font' => 'bentonsans'
                        
                    ]);
        
                 
        
                    $mpdf->SetTitle('General Ledger Report'); // Set the title
        
                    $html ='
                
                    <style>
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
                
                
                
                    <table width="100%" style="margin-top:5px;">
                    
                
                    <tr width="100%">

                    <td width="100%" colspan="5" align="right"><h3>General Ledger</h3></td>
                
                    

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
                   
                
                    <table  width="100%" style="margin-top:2px;border-collapse: collapse; border-spacing: 0;border-top:2px solid;">
                    
                
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


 

    public function StatementOfAccounts1()
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


        if(!empty($account))
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
                $dates = date('d M Y',strtotime($start_date)) . " to " . date('d M Y',strtotime($end_date));
            }

            foreach($data['vouchers']['vouchers'] as $vc){ 

                
                //if(!empty($vc['debit_amount'])) { $vc['debit_amount'] = $vc['debit_amount'];  } else{ $vc['debit_amount'] = ""; }

                //if(!empty($vc['credit_amount'])) { $vc['credit_amount'] = $vc['credit_amount'];  } else{ $vc['credit_amount'] = ""; }



                // if(!empty($vc->debit_amount))
                // {
                // $balance = $balance-$vc->debit_amount;  
                // }
                // else
                // {
                // $balance = $balance+$vc->credit_amount;    
                // }

               

                $pdf_data .='

                <tr>
                
                <td align="">'.$vc->reference.'</td>
                
                <td align="center">'.date('d M Y',strtotime($vc->transaction_date)).'</td>
                
                <td align="right">'.format_currency($vc->debit_amount).'</td>
                
                <td align="right">'.format_currency($vc->credit_amount).'</td>
                
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
           
    
                
    
                $title = "Satement Of Accounts";
    
                $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
                $fontDirs = $defaultConfig['fontDir'];
     
                $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
                $fontData = $defaultFontConfig['fontdata'];

    
                $mpdf = new \Mpdf\Mpdf([
                    'format' => 'Letter', // Custom page size in millimeters
                    //'format' => [300, 600], // Width: 300mm, Height: 600mm (custom large page)
                    'default_font_size' => 9, 
                    'margin_left' => 5, 
                    'margin_right' => 5,
                    'fontDir' => array_merge($fontDirs, [
                        __DIR__ . '/fonts'
                    ]),
                    'fontdata' => $fontData + [
                        'bentonsans' => [
                          
                            'R' => 'OpenSans-Regular.ttf',
                            'B' => 'OpenSans-Bold.ttf',
                        ],
                    ],
                    'default_font' => 'bentonsans'
                    
                ]);
    
    
                if(empty($start_date) && empty($end_date))
                {
                 
                   $dates = "";
                }
                else
                {
                   $dates = date('d M Y',strtotime($start_date)) . " to " . date('d M Y',strtotime($end_date));
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
            
                <th align="center">Date</th>
    
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

        
        $data['vouchers']['vouchers'] = array();
            
        $data['vouchers']['pdc'] = array();

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
        $end_date = date('Y-m-d',strtotime($this->request->getGet('start_date')));
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

        $account_name="";

        if($filter_type=="Account")
        {

        $account = $this->request->getGet('filter_account');

        $cus_join = array(

            array(
                'table' => 'crm_customer_creation',
                'pk' => 'cc_id',
                'fk' => 'ca_customer',
              )

        );

        $data['account_name'] = $this->common_model->SingleRowJoin('accounts_charts_of_accounts',array('ca_id' => $account),$cus_join);

        $ac_name_pdf = "";

        if(!empty($data['account_name']))
        {

        $account_name = "{$data['account_name']->ca_name}<br>";

        if(!empty($data['account_name']->cc_telephone))
        $account_name .= "<br>Tel : {$data['account_name']->cc_telephone}";

        if(!empty($data['account_name']->cc_fax))
        $account_name .= ", Fax : {$data['account_name']->cc_fax}";

        if(!empty($data['account_name']->cc_fax))
        $account_name .=", Email : {$data['account_name']->cc_fax}";
                       
        }


        }


        $type="";
        if(!empty($this->request->getGet('ac_type')))
        {

        $type = $this->request->getGet('ac_type');

        }


        $adjust_type="";
        if(!empty($this->request->getGet('adjust_type')))
        {

        $adjust_type = $this->request->getGet('adjust_type');

        }

        
        //$data['payments'] = $this->report_model->ARPPayments($start_date,$account_head,$account_type,$account);

        //$data['receipts'] = $this->report_model->ARPReceipts($start_date,$account_head,$account_type,$account);

        $data['transactions'] = $this->report_model->AgedRPTransactions($start_date,$end_date,$account_head,$account_type,$account,$type,$adjust_type);

        $data['post_dated_cheques'] = $this->report_model->AgedRPPDC($start_date,$end_date,$account_head,$account_type,$account,$type,$adjust_type);

        //$data['c_balance'] = $this->report_model->AgedRPBalance($start_date,$account_head,$account_type,$account);

        $data['c_balance'] = 0;

        //echo $data['c_balance']; exit;



        if (!empty($_POST['pdf']) || (isset($_GET['action']) && $_GET['action'] == "Print")) 
        {

        
        
            if(!empty($data['transactions']))
            {   
                $pdf_data = "";

                $total_debit = 0;

                $total_credit = 0;

                $total_pdc = 0;

                $balance = 0;


                 // Initialize Aging Bucket Totals
                 $aging_totals = [
                    "30" => 0,
                    "60" => 0,
                    "90" => 0,
                    "90+" => 0
                ];


                foreach($data['transactions'] as $vc)
                {   


                    if(empty($start_date))
                    {

                    $start_date = date('Y-m-d');

                    }

                    $days_due = (strtotime(date($start_date)) - strtotime($vc->transaction_date)) / (60 * 60 * 24);
                                                    
                    // Determine Aging Bucket
                    if ($days_due <= 30) {
                        $aging_bucket = "30";
                    } elseif ($days_due <= 60) {
                        $aging_bucket = "60";
                    } elseif ($days_due <= 90) {
                        $aging_bucket = "90";
                    } else {
                        $aging_bucket = "90+";
                    }



                    $q=1;

                    $border="border-top: 2px solid";
                   
                    $total_debit = $total_debit + $vc->debit_amount;

                    $total_credit = $total_credit + $vc->credit_amount;

                    $total_pdc = $total_pdc + $vc->pdc_amount;
    
                    $new_date = date('d-M-Y',strtotime($vc->transaction_date));
    
                    $pdf_data .= "<tr ><td align='center'>{$vc->reference}</td>";

                    $pdf_data .= " <td align='center'>{$new_date}</td>";

                    $pdf_data .= "<td align='center'>{$vc->purchase_order}</td>";
                


                    if($vc->debit_amount !="") {     

                    $debit_am = format_currency($vc->debit_amount);

                    $balance = $balance+$vc->debit_amount; 

                    $total_debit = $total_debit+$vc->debit_amount;

                    $aging_totals[$aging_bucket] += $vc->debit_amount;


                    } else if($vc->credit_amount<0) {

                    $debit_am = format_currency($vc->credit_amount); 

                    $balance = $balance+$vc->credit_amount;

                    $total_debit = $total_debit+$vc->credit_amount;
                    
                        
                    }
                    else
                    {
                    $debit_am="";
                    }

                    $pdf_data .= "<td align='right' >{$debit_am}</td>";


                    if($vc->credit_amount !="" && $vc->credit_amount>0) {

                        $credit_am = format_currency($vc->credit_amount);

                        $balance = $balance+$vc->credit_amount; 

                        $total_credit = $total_credit+$vc->credit_amount;

                        $aging_totals[$aging_bucket] += $vc->credit_amount;

                    } else {

                        $credit_am ="";

                    }
    
                    $pdf_data .= "<td align='right'>{$credit_am}</td>";
                    
                    $pdf_data .= "<td align='right'>".format_currency($vc->pdc_amount)."</td>";


                    if(!empty($vc->pdc_amount))
                    {

                            $balance = $balance - $vc->pdc_amount;

                            $aging_totals[$aging_bucket] -= $vc->pdc_amount;

                            $total_pdc = $total_pdc + $vc->pdc_amount;

                    }


                    $pdf_data .= "<td  align='right'>(".format_currency($balance).")</td>";
                    
                    $pdf_data .="</tr>";
                   
                    
                }


                $pdf_data .="<tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                </tr>";

    
                if(empty($start_date) && empty($end_date))
                {
                 
                   $dates = "-";
                }
                else
                {
                   $dates = date('d-M-Y',strtotime($end_date));
                }
    
                
    
                $title = "Aged RP Report ".date('d-M-Y')."";


                $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
                $fontDirs = $defaultConfig['fontDir'];
     
                $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
                $fontData = $defaultFontConfig['fontdata'];

    
                $mpdf = new \Mpdf\Mpdf([
                    'format' => 'Letter', // Custom page size in millimeters
                    //'format' => [300, 600], // Width: 300mm, Height: 600mm (custom large page)
                    'default_font_size' => 9, 
                    'margin_left' => 5, 
                    'margin_right' => 5,
                    'fontDir' => array_merge($fontDirs, [
                        __DIR__ . '/fonts'
                    ]),
                    'fontdata' => $fontData + [
                        'bentonsans' => [
                          
                            'R' => 'OpenSans-Regular.ttf',
                            'B' => 'OpenSans-Bold.ttf',
                        ],
                    ],
                    'default_font' => 'bentonsans'
                    
                ]);
    
             
    
                $mpdf->SetTitle('Aged Receivables Payables Report'); // Set the title
    
                $html ='
            
                <style>
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
            
            
            
                <table width="100%" style="margin-top:5px;">
                
            
                <tr width="100%">

                <td width="100%" colspan="5" align="right"><h3>Aged Receivables Payables</h3></td>
            
                

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
               
            
                <table  width="100%" style="margin-top:2px;border-collapse: collapse; border-spacing: 0;border-top:2px solid;">
                
            
                <tr>
                
                <td align="center">Voucher No</td>

                <td align="center">Date</td>
            
                <td align="center">Purchase Order</td>
            
                <td align="right">Debit Amt</td>
    
                <td align="right">Credit Amt</td>

                <td align="right">PDC Allocation</td>
    
                <td align="right">Balance</td>
    
                </tr>


               

                <tr>

                <td align="left" style="border-top: 2px solid">Op. Balance</td>
            
                <td align="left" style="border-top: 2px solid"></td>
            
                <td align="left" style="border-top: 2px solid"></td>
            
                <td align="right" style="border-top: 2px solid"></td>
    
                <td align="right" style="border-top: 2px solid"></td>

                <td align="right" style="border-top: 2px solid"></td>
    
                <td align="right" style="border-top: 2px solid">-</td>
                
                </tr>
                
                '.$pdf_data.'
    
                <tr>

                    <td style="border-top: 2px solid;"></td>
                    <td style="border-top: 2px solid;"></td>
                    <td style="border-top: 2px solid;"></td>
                    <td align="right" style="border-top: 2px solid;"><b>'.format_currency($total_debit).'</b></td>
                    <td align="right" style="border-top: 2px solid;"><b>'.format_currency($total_credit).'</b></td>
                    <td align="right" style="border-top: 2px solid"><b>'.format_currency($total_pdc).'</b></td>
                    <td align="right" style="border-top: 2px solid;"><b>'.format_currency($balance).'</b></td>
                    
                </tr>    
               
                
                </table>
    
    
            
                ';


                $pdc_data = '<table width="100%" style="margin-top:5px;border-collapse: collapse; border-spacing: 0;">';
                
                $pdc_data .="
                <tr>
                <td colspan='6' align='center'>
                <b>Post Dated Cheque Details</b>
                </td>
                </tr>
                ";


                $pdc_data .='
                <tr>
                <td style="border-top: 2px solid;border-bottom: 2px solid;" align="center">Receipt No</td>
                <td style="border-top: 2px solid;border-bottom: 2px solid;" align="center">Receipt Date</td>
                <td style="border-top: 2px solid;border-bottom: 2px solid;" align="center">Cheque No</td>
                <td style="border-top: 2px solid;border-bottom: 2px solid;" align="center">Cheque Date</td>
                <td style="border-top: 2px solid;border-bottom: 2px solid;" align="center">Bank</td>
                <td style="border-top: 2px solid;border-bottom: 2px solid;" align="right">Amount</td>
                </tr>
                ';


                //Total 

               foreach($data['post_dated_cheques'] as $pdc){
                
               $pdc_data .='
                    <tr>

                        <td align="center">'.$pdc->reference.'</td>

                        <td align="center">'.date('d M Y',strtotime($pdc->transaction_date)).'</td>

                        <td align="center">'.$pdc->cheque_no.'</td>

                        <td align="center">'.date('d M Y',strtotime($pdc->cheque_date)).'</td>

                        <td align="center">'.$pdc->bank.'</td>

                        <td align="right">'.format_currency($pdc->amount).'</td>

                    </tr>';

                 } 

                $pdc_data .='
                <tr>
                <td style="border-top: 2px solid"></td>
                <td style="border-top: 2px solid"></td>
                <td style="border-top: 2px solid"></td>
                <td style="border-top: 2px solid"></td>
                <td style="border-top: 2px solid"></td>
                <td style="border-top: 2px solid"><b>'.format_currency(array_sum(array_column($data['post_dated_cheques'],'amount'))).'</b></td>
                </tr>
                ';


                $pdc_data .= "</table>";


                //Buckets
                $pdc_data .= '<table width="100%" style="border:2px solid;margin-top:5px;border-collapse:collapse;">';

                $pdc_data .="
                
                <tr>
                
                <td width='12.5%' style='border:2px solid;padding:5px;' align='center'>0-30 Days</td>

                <td width='12.5%' style='border:2px solid;padding:5px;' align='center'>".format_currency($aging_totals["30"])."</td>

                <td width='12.5%' style='border:2px solid;padding:5px;' align='center'>31-60 Days</td>

                <td width='12.5%' style='border:2px solid;padding:5px;' align='center'>".format_currency($aging_totals["60"])."</td>

                <td width='12.5%' style='border:2px solid;padding:5px;' align='center'>61-90 Days</td>

                <td width='12.5%' style='border:2px solid;padding:5px;' align='center'>".format_currency($aging_totals["90"])."</td>

                <td width='12.5%' style='border:2px solid;padding:5px;' align='center'>Above 90 Days</td>

                <td width='12.5%' style='border:2px solid;padding:5px;' align='center'>".format_currency($aging_totals["90+"])."</td>

                </tr>

                ";


                $pdc_data .= "</table>";


                $pdc_data .='
                
                <table width="100%" style="margin-top:10px;border-collapse:collapse;">

                <tr>
                
                <td style="border-top:2px solid;border-bottom:2px solid;" align="center">Net Amount Due : '.currency_to_words($balance).'</td>

                </tr>

                </table>

                ';


                $pdc_data .='
                
                <table width="100%" style="margin-top:10px;border-collapse:collapse;">

                <tr>
                
                <td style="border-right:2px solid;" align="right">Contact Person</td>

                <td>
                Mohammed Raphy, Chief Accountant<br><br>
                Mob : 7743 4520, Email : raphy@alfuzailgroup.com, accounts@alfuzailgroup.com
                </td>

                </tr>

                </table>

                ';


                $html .= $pdc_data;

                //echo $html; exit;
            
                //$footer = '';
            
                
                $mpdf->WriteHTML($html);
               
               // $mpdf->SetFooter($footer);

                $this->response->setHeader('Content-Type', 'application/pdf');

                $mpdf->Output($title . '.pdf', 'I');

                exit();
            
            }


        }
    
           




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





    public function StatementOfAccounts(){


           


        $data['account_heads'] = $this->common_model->FetchAllOrder('accounts_account_heads','ah_id','asc');

        $data['account_types'] = $this->common_model->FetchAllOrder('accounts_account_types','at_id','asc');
 
        $data['accounts'] = $this->common_model->FetchAllOrder('accounts_charts_of_accounts','ca_name','asc');

        if(!empty($_GET))
        {

        $start_date = "";
        $end_date =date('Y-m-d');


        if(!empty($this->request->getGet('start_date')))
        {
        $start_date = date('Y-m-d',strtotime($this->request->getGet('start_date')));
        }

        if(!empty($this->request->getGet('end_date')))
        {
        $end_date = date('Y-m-d',strtotime($this->request->getGet('end_date')));
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

        $account_name="";

        $filter_type="Account";

        if($filter_type=="Account")
        {

        $account = $this->request->getGet('filter_account');

        $cus_join = array(

            array(
                'table' => 'crm_customer_creation',
                'pk' => 'cc_id',
                'fk' => 'ca_customer',
              )

        );

        $data['account_name'] = $this->common_model->SingleRowJoin('accounts_charts_of_accounts',array('ca_id' => $account),$cus_join);

        $ac_name_pdf = "";

        if(!empty($data['account_name']))
        {
        
        $ac_name_pdf = "<br>{$data['account_name']->ca_name}";

        $account_name = "{$data['account_name']->ca_name}<br>";

        if(!empty($data['account_name']->cc_telephone))
        $account_name .= "<br>Tel : {$data['account_name']->cc_telephone}";

        if(!empty($data['account_name']->cc_fax))
        $account_name .= ", Fax : {$data['account_name']->cc_fax}";

        if(!empty($data['account_name']->cc_fax))
        $account_name .=", Email : {$data['account_name']->cc_fax}";
                       
        }


        }


        $type="";
        if(!empty($this->request->getGet('ac_type')))
        {

        $type = $this->request->getGet('ac_type');

        }


        $adjust_type="";
        if(!empty($this->request->getGet('adjust_type')))
        {

        $adjust_type = $this->request->getGet('adjust_type');

        }

        
        //$data['payments'] = $this->report_model->ARPPayments($start_date,$account_head,$account_type,$account);

        //$data['receipts'] = $this->report_model->ARPReceipts($start_date,$account_head,$account_type,$account);

        $data['transactions'] = $this->report_model->AgedRPTransactions($start_date,$end_date,$account_head,$account_type,$account,$type,$adjust_type);

        $data['post_dated_cheques'] = $this->report_model->AgedRPPDC($start_date,$end_date,$account_head,$account_type,$account,$type,$adjust_type);

        //$data['c_balance'] = $this->report_model->AgedRPBalance($start_date,$account_head,$account_type,$account);

        $data['c_balance'] = 0;

        //echo $data['c_balance']; exit;



        if (!empty($_POST['pdf']) || (isset($_GET['action']) && $_GET['action'] == "Print")) 
        {

        
        
            if(!empty($data['transactions']))
            {   
                $pdf_data = "";

                $total_debit = 0;

                $total_credit = 0;

                $total_pdc = 0;

                $balance = 0;


                 // Initialize Aging Bucket Totals
                 $aging_totals = [
                    "30" => 0,
                    "60" => 0,
                    "90" => 0,
                    "90+" => 0
                ];


                foreach($data['transactions'] as $vc)
                {   


                    if(empty($start_date))
                    {

                    $start_date = date('Y-m-d');

                    }
                          

                    $q=1;

                    $border="border-top: 2px solid";
                   
                    $total_debit = $total_debit + $vc->debit_amount;

                    $total_credit = $total_credit + $vc->credit_amount;

                    $total_pdc = $total_pdc + $vc->pdc_amount;
    
                    $new_date = date('d-M-Y',strtotime($vc->transaction_date));
    
                    $pdf_data .= "<tr ><td align='center'>{$vc->reference}</td>";

                    $pdf_data .= " <td align='center'>{$new_date}</td>";

                    $pdf_data .= "<td align='center'>{$vc->purchase_order}</td>";
                


                    if($vc->debit_amount !="") {     

                    $debit_am = format_currency($vc->debit_amount);

                    $balance = $balance+$vc->debit_amount; 

                    $total_debit = $total_debit+$vc->debit_amount;

                 

                    } else if($vc->credit_amount<0) {

                    $debit_am = format_currency($vc->credit_amount); 

                    $balance = $balance+$vc->credit_amount;

                    $total_debit = $total_debit+$vc->credit_amount;
                    
                        
                    }
                    else
                    {
                    $debit_am="";
                    }

                    $pdf_data .= "<td align='right' >{$debit_am}</td>";


                    if($vc->credit_amount !="" && $vc->credit_amount>0) {

                        $credit_am = format_currency($vc->credit_amount);

                        $balance = $balance+$vc->credit_amount; 

                        $total_credit = $total_credit+$vc->credit_amount;

                     
                    } else {

                        $credit_am ="";

                    }
    
                    $pdf_data .= "<td align='right'>{$credit_am}</td>";
                    

                    $pdf_data .= "<td  align='right'>(".format_currency($balance).")</td>";
                    
                    $pdf_data .="</tr>";
                   
                    
                }


                $pdf_data .="<tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                </tr>";

    
                if(empty($start_date) && empty($end_date))
                {
                 
                   $dates = "-";
                }
                else
                {
                   $dates = date('d-M-Y',strtotime($start_date)) . " to " . date('d-M-Y',strtotime($end_date));
                }
    
                
    
                $title = "Statement Of Account ".date('d-M-Y')."";


                $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
                $fontDirs = $defaultConfig['fontDir'];
     
                $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
                $fontData = $defaultFontConfig['fontdata'];

    
                $mpdf = new \Mpdf\Mpdf([
                    'format' => 'Letter', // Custom page size in millimeters
                    //'format' => [300, 600], // Width: 300mm, Height: 600mm (custom large page)
                    'default_font_size' => 9, 
                    'margin_left' => 5, 
                    'margin_right' => 5,
                    'fontDir' => array_merge($fontDirs, [
                        __DIR__ . '/fonts'
                    ]),
                    'fontdata' => $fontData + [
                        'bentonsans' => [
                          
                            'R' => 'OpenSans-Regular.ttf',
                            'B' => 'OpenSans-Bold.ttf',
                        ],
                    ],
                    'default_font' => 'bentonsans'
                    
                ]);
    
             
    
                $mpdf->SetTitle('Statement Of Account'); // Set the title
    
                $html ='
            
                <style>
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
            
            
            
                <table width="100%" style="margin-top:5px;">
                
            
                <tr width="100%">

                <td width="100%" colspan="5" align="right"><h3>Statement Of Account</h3></td>
            
                

                </tr>


                <tr width="100%">

                <td width="15%">
                Customer : 
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
               
            
                <table  width="100%" style="margin-top:2px;border-collapse: collapse; border-spacing: 0;border-top:2px solid;">
                
            
                <tr>
                
                <td align="center">Voucher No</td>

                <td align="center">Date</td>
            
                <td align="center">Purchase Order</td>
            
                <td align="right">Debit Amt</td>
    
                <td align="right">Credit Amt</td>

                <td align="right">Balance</td>
    
                </tr>


               

                <tr>

                <td align="left" style="border-top: 2px solid">Op. Balance</td>
            
                <td align="left" style="border-top: 2px solid"></td>
            
                <td align="left" style="border-top: 2px solid"></td>
            
                <td align="right" style="border-top: 2px solid"></td>
    
                <td align="right" style="border-top: 2px solid"></td>
    
                <td align="right" style="border-top: 2px solid">-</td>
                
                </tr>
                
                '.$pdf_data.'
    
                <tr>

                    <td style="border-top: 2px solid;"></td>
                    <td style="border-top: 2px solid;"></td>
                    <td style="border-top: 2px solid;"></td>
                    <td align="right" style="border-top: 2px solid;"><b>'.format_currency($total_debit).'</b></td>
                    <td align="right" style="border-top: 2px solid;"><b>'.format_currency($total_credit).'</b></td>
                    <td align="right" style="border-top: 2px solid;"><b>'.format_currency($balance).'</b></td>
                    
                </tr>    
               
                
                </table>
    
    
            
                ';


                $pdc_data = '<table width="100%" style="margin-top:5px;border-collapse: collapse; border-spacing: 0;">';
                
                $pdc_data .="
                <tr>
                <td colspan='6' align='center'>
                <b>Post Dated Cheque Details</b>
                </td>
                </tr>
                ";


                $pdc_data .='
                <tr>
                <td style="border-top: 2px solid;border-bottom: 2px solid;" align="center">Receipt No</td>
                <td style="border-top: 2px solid;border-bottom: 2px solid;" align="center">Receipt Date</td>
                <td style="border-top: 2px solid;border-bottom: 2px solid;" align="center">Cheque No</td>
                <td style="border-top: 2px solid;border-bottom: 2px solid;" align="center">Cheque Date</td>
                <td style="border-top: 2px solid;border-bottom: 2px solid;" align="center">Bank</td>
                <td style="border-top: 2px solid;border-bottom: 2px solid;" align="right">Amount</td>
                </tr>
                ';


                //Total 

               foreach($data['post_dated_cheques'] as $pdc){
                
               $pdc_data .='
                    <tr>

                        <td align="center">'.$pdc->reference.'</td>

                        <td align="center">'.date('d M Y',strtotime($pdc->transaction_date)).'</td>

                        <td align="center">'.$pdc->cheque_no.'</td>

                        <td align="center">'.date('d M Y',strtotime($pdc->cheque_date)).'</td>

                        <td align="center">'.$pdc->bank.'</td>

                        <td align="right">'.format_currency($pdc->amount).'</td>

                    </tr>';

                 } 

                $pdc_data .='
                <tr>
                <td style="border-top: 2px solid"></td>
                <td style="border-top: 2px solid"></td>
                <td style="border-top: 2px solid"></td>
                <td style="border-top: 2px solid"></td>
                <td style="border-top: 2px solid"></td>
                <td style="border-top: 2px solid"><b>'.format_currency(array_sum(array_column($data['post_dated_cheques'],'amount'))).'</b></td>
                </tr>
                ';


                $pdc_data .= "</table>";


                $pdc_data .='
                
                <table width="100%" style="margin-top:10px;border-collapse:collapse;">

                <tr>
                
                <td style="border-top:2px solid;border-bottom:2px solid;" align="center">Net Amount Due : '.currency_to_words($balance).'</td>

                </tr>

                </table>

                ';


                $pdc_data .='
                
                <table width="100%" style="margin-top:10px;border-collapse:collapse;">

                <tr>
                
                <td style="border-right:2px solid;" align="right">Contact Person</td>

                <td>
                Mohammed Raphy, Chief Accountant<br><br>
                Mob : 7743 4520, Email : raphy@alfuzailgroup.com, accounts@alfuzailgroup.com
                </td>

                </tr>

                </table>

                ';


                $html .= $pdc_data;

                //echo $html; exit;
            
                //$footer = '';
            
                
                $mpdf->WriteHTML($html);
               
               // $mpdf->SetFooter($footer);

                $this->response->setHeader('Content-Type', 'application/pdf');

                $mpdf->Output($title . '.pdf', 'I');

                exit();
            
            }


        }
    
           


        $data['content'] = view('accounts/statement_of_accounts',$data);

        return view('accounts/report-module',$data);

        }
        else
        {

        //$data['payments'] = array();

        //$data['receipts'] = array();

        $data['transactions'] = array();

        $data['post_dated_cheques'] = array();

        $data['c_balance'] = array();

        
        $data['content'] = view('accounts/statement_of_accounts',$data);

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

                    $pdf_data .= "<td  align='right'>".format_currency($account->net_change)."</td>";

                    $pdf_data .= "<td  align='right'>".format_currency($account->ending_balance)."</td>";

                    $pdf_data .="</tr>";
                   
                    
                }




                $pdf_data .='
                <tr class="no-sort">
                        <td align=""><b style="font-size:20px;">Total</b></td>
                        <td align="right"><b>(0.00)</b></td>
                        <td align="right"><b>'.format_currency($total_deb).'</b></td>
                        <td align="right"><b>'.format_currency($total_cred).'</b></td>
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


                $title = "General Ledger Report ".date('d-M-Y')."";


                $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
                $fontDirs = $defaultConfig['fontDir'];
     
                $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
                $fontData = $defaultFontConfig['fontdata'];
    
                $title = "Trial Balance Report ".date('d-M-Y')."";
    
                $mpdf = new \Mpdf\Mpdf([
                    'format' => 'Letter', // Custom page size in millimeters
                    //'format' => [300, 600], // Width: 300mm, Height: 600mm (custom large page)
                    'default_font_size' => 9, 
                    'margin_left' => 5, 
                    'margin_right' => 5,
                    'fontDir' => array_merge($fontDirs, [
                        __DIR__ . '/fonts'
                    ]),
                    'fontdata' => $fontData + [
                        'bentonsans' => [
                          
                            'R' => 'OpenSans-Regular.ttf',
                            'B' => 'OpenSans-Bold.ttf',
                        ],
                    ],
                    'default_font' => 'bentonsans'
                    
                ]);
             
    
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
            
                <h3>Al Fuzail Engineering Services WLL</h3>
                <div><p class="paragraph-spacing">Tel : +974 4460 4254, Fax : 4029 8994, email : engineering@alfuzailgroup.com</p></div>
                <p>Post Box : 201978, Gate : 248, Street : 24, Industrial Area, Doha - Qatar</p>
                
                
                </td>
                
                </tr>
            
                </table>
            
            
            
                <table width="100%" style="margin-top:5px;">
                
            
                <tr width="100%">

                <td colspan="5" align="right">
                <h3>Trial Balance</h3>
                </td>
            
                <!--<hr style="height:3px;border:none;color:#333;background-color:#333;margin-top:0">-->

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
                
                <td align="center" style="border-bottom: 1px solid">Account</td>
            
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

        $data['accounts'] = $this->report_model->FetchPLAccount($time_frame,$date_from,$date_to);


        $data['content'] = view('accounts/pl_account_report',$data);

        if (!empty($_POST['pdf']) || (isset($_GET['action']) && $_GET['action'] == "Print")) 
        {

$accounts = $data['accounts'];

            $revenue_accounts=[];

            foreach($accounts as $account)
            {
                if(empty($_GET['zero']))
                {
                if( ($account->ending_balance_month==0) && ($account->ending_balance_year==0))
                { 
                continue;
                }
                }

                if($account->at_name=="Income")
                {

                    $revenue_accounts[]=$account;  

                }

            }


            $cos_accounts = [];

            foreach($accounts as $account)
            {
                if(empty($_GET['zero']))
                {
                if( ($account->ending_balance_month==0) && ($account->ending_balance_year==0))
                { 
                continue;
                }
                }

                if($account->at_name=="Cost of Sales")
                {

                    $revenue_accounts[]=$account;  

                }

            }


            $expense_accounts = [];

            foreach($accounts as $account)
            {
                if(empty($_GET['zero']))
                {
                if( ($account->ending_balance_month==0) && ($account->ending_balance_year==0))
                { 
                continue;
                }
                }

                if($account->at_name=="Expenses")
                {

                    $expense_accounts[]=$account;  

                }

            }


            $total_credit=0;

            $grand_total_ytd = 0;

            if(!empty($data['accounts']))
            {   

$pdf_data = <<<EOD

<tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>

<tr>
    <th align="center" style="text-align:center;text-decoration:underline"><b style="font-size:14px;">Revenues</b></th>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>
EOD;

// Calculate Total Revenues
$total_revenue_month = array_sum(array_column($revenue_accounts, 'ending_balance_month'));
$total_revenue_year = array_sum(array_column($revenue_accounts, 'ending_balance_year'));

foreach ($revenue_accounts as $ra) {
    $month_perc = $total_revenue_month != 0 ? ($ra->ending_balance_month / $total_revenue_month * 100) : 0.00;
    $year_perc = $total_revenue_year != 0 ? ($ra->ending_balance_year / $total_revenue_year * 100) : 0.00;

    $pdf_data .= <<<EOD
<tr>
    <td style="text-align-left">{$ra->ca_name}</td>
    <td align="right">{$ra->ending_balance_month}</td>
    <td align="right">{$month_perc}</td>
    <td align="right">{$ra->ending_balance_year}</td>
    <td align="right">{$year_perc}</td>
</tr>
EOD;
}

$pdf_data .= <<<EOD
<tr>
    <th align="center" style="text-align:center"><b style="font-size:14px;">Total Revenues</b></th>
    <td class="text-end" align="right"><b>{$total_revenue_month}</b></td>
    <td class="text-end" align="right"><b>100.00</b></td>
    <td class="text-end" align="right"><b>{$total_revenue_year}</b></td>
    <td class="text-end" align="right"><b>100.00</b></td>
</tr>

<tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>

<tr>
    <th align="center" style="text-align:center;text-decoration:underline"><b style="font-size:14px;">Cost Of Sales</b></th>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>
EOD;

// Calculate Total Cost of Sales
$total_cos_month = array_sum(array_column($cos_accounts, 'ending_balance_month'));
$total_cos_year = array_sum(array_column($cos_accounts, 'ending_balance_year'));

foreach ($cos_accounts as $cosa) {
    $month_perc = $total_cos_month != 0 ? ($cosa->ending_balance_month / $total_cos_month * 100) : 0.00;
    $year_perc = $total_cos_year != 0 ? ($cosa->ending_balance_year / $total_cos_year * 100) : 0.00;

    $pdf_data .= <<<EOD
<tr>
    <td align="left">{$cosa->ca_name}</td>
    <td align="right">{$cosa->ending_balance_month}</td>
    <td align="right">{$month_perc}</td>
    <td align="right">{$cosa->ending_balance_year}</td>
    <td align="right">{$year_perc}</td>
</tr>
EOD;
}

$total_cos_month_perc = ($total_cos_month != 0 && $total_revenue_month != 0) ? ($total_cos_month / $total_revenue_month * 100) : 0.00;
$total_cos_year_perc = ($total_cos_year != 0 && $total_revenue_year != 0) ? ($total_cos_year / $total_revenue_year * 100) : 0.00;

$pdf_data .= <<<EOD
<tr>
    <th align="center" style="text-align:center"><b style="font-size:14px;">Total Cost Of Sales</b></th>
    <td class="text-end" align="right">{$total_cos_month}</td>
    <td class="text-end" align="right">{$total_cos_month_perc}</td>
    <td class="text-end" align="right">{$total_cos_year}</td>
    <td class="text-end" align="right">{$total_cos_year_perc}</td>
</tr>

<tr>
    <th align="center" style="text-align:center"><b style="font-size:14px;">Gross Profit</b></th>
EOD;

$gross_profit_month = $total_revenue_month - $total_cos_month;
$gross_profit_year = $total_revenue_year - $total_cos_year;

$gross_perc_month = ($total_revenue_month != 0) ? ($gross_profit_month / $total_revenue_month * 100) : 0.00;
$gross_perc_year = ($total_revenue_year != 0) ? ($gross_profit_year / $total_revenue_year * 100) : 0.00;

$pdf_data .= <<<EOD
    <td class="text-end" align="right" >{$gross_profit_month}</td>
    <td class="text-end" align="right">{$gross_perc_month}</td>
    <td class="text-end" align="right">{$gross_profit_year}</td>
    <td class="text-end" align="right">{$gross_perc_year}</td>
</tr>

<tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>

<tr>
    <th align="center" style="text-align:center;text-decoration:underline"><b style="font-size:14px;">Expenses</b></th>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>
EOD;

// Calculate Total Expenses
$total_expense_month = array_sum(array_column($expense_accounts, 'ending_balance_month'));
$total_expense_year = array_sum(array_column($expense_accounts, 'ending_balance_year'));

foreach ($expense_accounts as $ea) {
    $month_perc = $total_expense_month != 0 ? ($ea->ending_balance_month / $total_expense_month * 100) : 0.00;
    $year_perc = $total_expense_year != 0 ? ($ea->ending_balance_year / $total_expense_year * 100) : 0.00;

    $pdf_data .= <<<EOD
<tr>
    <td align="left">{$ea->ca_name}</td>
    <td align="right">{$ea->ending_balance_month}</td>
    <td align="right">{$month_perc}</td>
    <td align="right">{$ea->ending_balance_year}</td>
    <td align="right">{$year_perc}</td>
</tr>
EOD;
}

$total_expense_month_perc = ($total_expense_month != 0 && $total_revenue_month != 0) ? ($total_expense_month / $total_revenue_month * 100) : 0.00;
$total_expense_year_perc = ($total_expense_year != 0 && $total_revenue_year != 0) ? ($total_expense_year / $total_revenue_year * 100) : 0.00;

$pdf_data .= <<<EOD
<tr>
    <th align="center" style="text-align:center"><b style="font-size:14px;">Total Expenses</b></th>
    <td class="text-end" align="right">{$total_expense_month}</td>
    <td class="text-end" align="right">{$total_expense_month_perc}</td>
    <td class="text-end" align="right">{$total_expense_year}</td>
    <td class="text-end" align="right">{$total_expense_year_perc}</td>
</tr>
EOD;

// Calculate Net Profit
$net_profit_month = $gross_profit_month - $total_expense_month;
$net_profit_year = $gross_profit_year - $total_expense_year;

$net_profit_month_perc = $gross_perc_month - $total_expense_month_perc;
$net_profit_year_perc = $gross_perc_year - $total_expense_year_perc;

$pdf_data .= <<<EOD
<tr>
    <th align="center" style="text-align:center;"><b style="font-size:14px;">Net Profit</b></th>
    <td class="text-end" align="right">{$net_profit_month}</td>
    <td class="text-end" align="right">{$net_profit_month_perc}</td>
    <td class="text-end" align="right">{$net_profit_year}</td>
    <td class="text-end" align="right">{$net_profit_year_perc}</td>
</tr>
EOD;


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
    
                
    
                $title = "Profit Loss Account Report".date('d-M-Y')."";


                $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
                $fontDirs = $defaultConfig['fontDir'];
     
                $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
                $fontData = $defaultFontConfig['fontdata'];

    
                $mpdf = new \Mpdf\Mpdf([
                    'format' => 'Letter', // Custom page size in millimeters
                    //'format' => [300, 600], // Width: 300mm, Height: 600mm (custom large page)
                    'default_font_size' => 9, 
                    'margin_left' => 5, 
                    'margin_right' => 5,
                    'fontDir' => array_merge($fontDirs, [
                        __DIR__ . '/fonts'
                    ]),
                    'fontdata' => $fontData + [
                        'bentonsans' => [
                          
                            'R' => 'OpenSans-Regular.ttf',
                            'B' => 'OpenSans-Bold.ttf',
                        ],
                    ],
                    'default_font' => 'bentonsans'
                    
                ]);
    

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

                .text-end
                {
                text-align:right;
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
            
            
            
                <table width="100%" style="margin-top:2px;">
                
            
                <tr width="100%">

                <td align="right" colspan="5"><h3>Income Statement</h3></td>
            
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
                exit;
        }

        return view('accounts/report-module',$data);

        }
        else
        {

        $data['month_year'] = "";

        $data['accounts'] = array();

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

    $filter_type = $this->request->getGet('type');

    $data['all_accounts'] = $this->report_model->RPSummery($filter_account,$start_date,$filter_type);


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



        $totals = [
            'total_dues' => 0,
            '0_30_days' => 0,
            '31_60_days' => 0,
            '61_90_days' => 0,
            '90_plus_days' => 0
        ];

    


            foreach($data['all_accounts'] as $ac) {


            if (!isset($ac->Invoices)) {
                continue;
            
            }


            // Accumulate totals
            $totals['total_dues'] += $ac->Invoices->total_dues ?? 0;
            $totals['0_30_days'] += $ac->Invoices->{"0_30_days"} ?? 0;
            $totals['31_60_days'] += $ac->Invoices->{"31_60_days"} ?? 0;
            $totals['61_90_days'] += $ac->Invoices->{"61_90_days"} ?? 0;
            $totals['90_plus_days'] += $ac->Invoices->{"90_plus_days"} ?? 0;
                

            $pdf_data .='
            
            <tr> 
                <td align="left" class="border-top">'.$ac->ca_name.'</td>
                <td align="right" class="border-top">'.format_currency($ac->Invoices->total_dues).'</td>
                <td align="right" class="border-top">'.format_currency($ac->Invoices->{"0_30_days"}).'</td>
                <td align="right" class="border-top">'.format_currency($ac->Invoices->{"31_60_days"}).'</td>
                <td align="right" class="border-top">'.format_currency($ac->Invoices->{"61_90_days"}).'</td>
                <td align="right" class="border-top">'.format_currency($ac->Invoices->{"90_plus_days"}).'</td>
                
            </tr>

            ';

            
        }   


        $pdf_footer='

        <tfoot>

        <tr class="no-sort">
       
        <td class="border-top"><b style="font-size:20px;" align="right">Total</b></td>
        <td align="right" class="border-top"><b>'.format_currency($totals['total_dues']).'</b></td>
        <td align="right" class="border-top"><b>'.format_currency($totals['0_30_days']).'</b></td>
        <td align="right" class="border-top"><b>'.format_currency($totals['31_60_days']).'</b></td>
        <td align="right" class="border-top"><b>'.format_currency($totals['61_90_days']).'</b></td>
        <td align="right" class="border-top"><b>'.format_currency($totals['90_plus_days']).'</b></td>

        </tfoot>
        ';




            

        $title = "Receivable Payable Summary ".date('d-M-Y')."";


        $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];


        $mpdf = new \Mpdf\Mpdf([
            'format' => 'Letter', // Custom page size in millimeters
            //'format' => [300, 600], // Width: 300mm, Height: 600mm (custom large page)
            'default_font_size' => 9, 
            'margin_left' => 5, 
            'margin_right' => 5,
            'fontDir' => array_merge($fontDirs, [
                __DIR__ . '/fonts'
            ]),
            'fontdata' => $fontData + [
                'bentonsans' => [
                  
                    'R' => 'OpenSans-Regular.ttf',
                    'B' => 'OpenSans-Bold.ttf',
                ],
            ],
            'default_font' => 'bentonsans'
            
        ]);


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
        
            <h3>Al Fuzail Engineering Services WLL</h3>
            <div><p class="paragraph-spacing">Tel : +974 4460 4254, Fax : 4029 8994, email : engineering@alfuzailgroup.com</p></div>
            <p>Post Box : 201978, Gate : 248, Street : 24, Industrial Area, Doha - Qatar</p>
            
            
            </td>
            
            </tr>
        
            </table>
        
        
        
            <table width="100%" style="margin-top:10px;">
            
            <tr width="100%">

            <td align="right" colspan="5"><h3>Receivables / Payables Summery</h3></td>
        
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
    

                $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
                $fontDirs = $defaultConfig['fontDir'];
     
                $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
                $fontData = $defaultFontConfig['fontdata'];

    
                $mpdf = new \Mpdf\Mpdf([
                    'format' => 'Letter', // Custom page size in millimeters
                    //'format' => [300, 600], // Width: 300mm, Height: 600mm (custom large page)
                    'default_font_size' => 9, 
                    'margin_left' => 5, 
                    'margin_right' => 5,
                    'fontDir' => array_merge($fontDirs, [
                        __DIR__ . '/fonts'
                    ]),
                    'fontdata' => $fontData + [
                        'bentonsans' => [
                          
                            'R' => 'OpenSans-Regular.ttf',
                            'B' => 'OpenSans-Bold.ttf',
                        ],
                    ],
                    'default_font' => 'bentonsans'
                    
                ]);
    

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
            
                <h3>Al Fuzail Engineering Services WLL</h3>
                <div><p class="paragraph-spacing">Tel : +974 4460 4254, Fax : 4029 8994, email : engineering@alfuzailgroup.com</p></div>
                <p>Post Box : 201978, Gate : 248, Street : 24, Industrial Area, Doha - Qatar</p>
                
                
                </td>
                
                </tr>
            
                </table>
            
            
            
                <table width="100%" style="margin-top:2px;">
                
            
                <tr width="100%">

                <td colspan="5" align="right"><h3>Balance Sheet</h3></td>
            
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







    public function BankReconciliation()
    {

        $data['accounts'] = $this->common_model->FetchAllOrder('accounts_charts_of_accounts','ca_name','asc');

        $data['b_gl_balance'] = 0; //last rec ending //ledger o balance 

        $data['add_cash_receipt'] = 0;  //Total ledger debit

        $data['less_cash_dis'] = 0; //Less: Cash Disbursements : ledger total credit 

        $data['e_gl_balance'] = 0; //ob+debit-credit

        $data['e_bank_balance'] = 0;



        if(!empty($this->request->getGet()))
        {
            
            $filter_account = $this->request->getGet('filter_account');

            $filter_date = date('Y-m-d',strtotime($this->request->getGet('end_date')));

            $data['b_gl_balance'] = $this->report_model->FetchBRLastEBalance($filter_account,$filter_date);

            $data['e_bank_balance'] = $this->report_model->FetchBRLastBBalance($filter_account,$filter_date);

            //Fetch Ledger Details
            $data['transactions'] = $this->report_model->FetchGLTransactions($start_date="",$end_date=$filter_date,$account_head="",$account_type="",$account=$filter_account,$time_frame="Range",$range_from="",$range_to="");

            //$data['b_gl_balance'] = 0; //last rec ending //ledger o balance 

            $data['add_cash_receipt'] = array_sum(array_column($data['transactions'],'debit_amount'));  //Total ledger debit

            $data['less_cash_dis'] = array_sum(array_column($data['transactions'],'credit_amount')); //Less: Cash Disbursements : ledger total credit 

            $data['e_gl_balance'] = $data['b_gl_balance']+$data['add_cash_receipt']-$data['less_cash_dis'];//ob+debit-credit

            //$data['e_bank_balance'] = 0;   


            $keysToRemove = array();

            foreach($data['transactions'] as $key=>$trn)
            {

            $check_cond['brc_voucher_id'] = $trn->id;

            $check_cond['brc_voucher_type'] = $trn->voucher_type;

            $br_clear = $this->common_model->SingleRow('accounts_bank_rec_cleared',$check_cond); 

            if(!empty($br_clear))
            {

            $keysToRemove[] = $key;

            }
            
            }

            // Remove objects using the keys
            foreach ($keysToRemove as $key) {
            unset($data['transactions'][$key]);
            }

            $data['transactions'] = array_values($data['transactions']);

            $data['total_deposits'] = array_sum(array_column($data['transactions'],'debit_amount'));  

            $data['total_outstanding'] = array_sum(array_column($data['transactions'],'credit_amount')); 


            $date = $this->request->getGet('end_date');

            if(!empty($filter_account))
            $data['bank_account'] = $this->common_model->SingleRow('accounts_charts_of_accounts',array('ca_id' => $filter_account))->ca_name;

            




            if (!empty($_POST['pdf']) || (isset($_GET['action']) && $_GET['action'] == "Print")) 
        {

            $pdf_data ="";



            $pdf_data = '

<tbody>
    <tr>
        <td colspan="3">Beginning GL Balance</td>
        <td colspan="2" class="text-end" align="right">' . format_currency($data['b_gl_balance']) . '</td>
    </tr>
    <tr>
        <td colspan="3">Add: Cash Receipts</td>
        <td colspan="2" class="text-end" align="right">' . format_currency($data['add_cash_receipt']) . '</td>
    </tr>
    <tr>
        <td colspan="3">Less: Cash Disbursements</td>
        <td colspan="2" class="text-end" align="right">' . format_currency($data['less_cash_dis']) . '</td>
    </tr>
    <tr>
        <td colspan="3">Add (Less) Other</td>
        <td colspan="2" class="text-end" align="right"></td>
    </tr>
    <tr>
        <td colspan="3">Ending GL Balance</td>
        <td colspan="2" class="text-end" align="right">' . format_currency($data['e_gl_balance']) . '</td>
    </tr>
    <tr>
        <td colspan="3">Ending Bank Balance</td>
        <td colspan="2" class="text-end" align="right">' . format_currency($data['e_bank_balance']) . '</td>
    </tr>
    <tr>
        <td colspan="5"></td>
    </tr>
    <tr>
        <td colspan="5"><strong>Add back deposits in transit</strong></td>
    </tr>';

foreach ($data['transactions'] as $trn_debit) {
    if ($trn_debit->credit_amount < 1) {
        $pdf_data .= '
        <tr>
            <td>' . $trn_debit->account_name . '</td>
            <td>' . date('d M Y', strtotime($trn_debit->transaction_date)) . '</td>
            <td>' . $trn_debit->reference . '</td>
            <td colspan="2" class="text-end">' . format_currency($trn_debit->debit_amount) . '</td>
        </tr>';
    }
}

$pdf_data .= '
    <tr>
        <td colspan="3">Total deposits in transit</td>
        <td colspan="2" align="right"><b>'.format_currency($data['total_deposits']).'</b></td>
    </tr>
    <tr>
        <td colspan="5" align="right"></td>
    </tr>
    <tr>
        <td colspan="5"><strong>(Less) outstanding checks</strong></td>
    </tr>';

foreach ($data['transactions'] as $trn_credit) {
    if ($trn_credit->debit_amount < 1) {
        $pdf_data .= '
        <tr>
            <td>' . $trn_credit->account_name . '</td>
            <td>' . date('d M Y', strtotime($trn_credit->transaction_date)) . '</td>
            <td>' . $trn_credit->reference . '</td>
            <td colspan="2" class="text-end">' . format_currency($trn_credit->credit_amount) . '</td>
        </tr>';
    }
}

    $pdf_data .= '
        <tr>
            <td colspan="3"><b>Total outstanding checks</b></td>
            <td colspan="2" class="text-end" align="right"><b>'.format_currency($data['total_outstanding']).'</b></td>
        </tr>


        <tr>
        <td colspan="5" align="right"></td>
        </tr>

        <tr>
            <td colspan="3">Add (Less) Other</td>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td colspan="3">Total other</td>
            <td colspan="2">-</td>
        </tr>
        <tr>
            <td colspan="3">Unreconciled difference</td>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td colspan="3"><b>Ending GL Balance</b></td>
            <td colspan="2" class="text-end"></td>
        </tr>
    </tbody>';



            $title = "Bank Reconciliation Report ".date('d-M-Y')."";


                $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
                $fontDirs = $defaultConfig['fontDir'];
     
                $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
                $fontData = $defaultFontConfig['fontdata'];
    
                $title = "Trial Balance Report ".date('d-M-Y')."";
    
                $mpdf = new \Mpdf\Mpdf([
                    'format' => 'Letter', // Custom page size in millimeters
                    //'format' => [300, 600], // Width: 300mm, Height: 600mm (custom large page)
                    'default_font_size' => 9, 
                    'margin_left' => 5, 
                    'margin_right' => 5,
                    'fontDir' => array_merge($fontDirs, [
                        __DIR__ . '/fonts'
                    ]),
                    'fontdata' => $fontData + [
                        'bentonsans' => [
                          
                            'R' => 'OpenSans-Regular.ttf',
                            'B' => 'OpenSans-Bold.ttf',
                        ],
                    ],
                    'default_font' => 'bentonsans'
                    
                ]);
             

                $mpdf->SetTitle('Bank Reconciliation Statement'); // Set the title
                

                if(empty($start_date) && empty($end_date))
                {
                 
                   $dates = "";
                }
                else
                {
                   $dates = date('d M Y',strtotime($end_date));
                }


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
            
                <h3>Al Fuzail Engineering Services WLL</h3>
                <div><p class="paragraph-spacing">Tel : +974 4460 4254, Fax : 4029 8994, email : engineering@alfuzailgroup.com</p></div>
                <p>Post Box : 201978, Gate : 248, Street : 24, Industrial Area, Doha - Qatar</p>
                

                </td>
                
                </tr>
            
                </table>

            
                <table width="100%" style="margin-top:2px;">

            
                <tr width="100%">

                <td colspan="5" align="right"><h3>Bank Reconciliation Statement</h3></td>
            

                </tr>


                <tr width="100%">

                <td width="15%">
                Bank Name : 
                </td>

                <td align="left">
                '.$data['bank_account'].'
                </td>


                </tr>



                <tr width="100%">

                <td width="15%">
                Bank Statement Date : 
                </td>

                <td align="left">
                
                '.$dates.'

                </td>

                </tr>
               

            
                </table>
               
            
                <table  width="100%" style="margin-top:2px;border-collapse: collapse; border-spacing: 0;border-top:2px solid;">
                
                 
                '.$pdf_data.'

              
                
                </table>
            
                ';


                $mpdf->WriteHTML($html);
               

                $this->response->setHeader('Content-Type', 'application/pdf');

                $mpdf->Output($title . '.pdf', 'I');

                exit();


        }


            


            $data['content'] = view('accounts/bank_rec_report',$data);

            return view('accounts/report-module',$data); 

            }

            else
            {

            $data['transactions'] = array();

            $data['content'] = view('accounts/bank_rec_report',$data);

            return view('accounts/accounts-module',$data); 

            }

    
    }









    public function FixedAsset()
    {
    
    $data['account_heads'] = $this->common_model->FetchAllOrder('accounts_account_heads','ah_id','asc');

    $data['account_heads_filter'] = $this->common_model->FetchAllOrder('accounts_account_heads','ah_head_id','asc');
 
    $data['account_types'] = $this->common_model->FetchAllOrder('accounts_account_types','at_id','asc');


    if($_GET)

    {

    $data['accounts'] = $this->report_model->FixedAssets($account_type="",$date="");

    $accounts = $data['accounts'];



    if (!empty($_POST['pdf']) || (isset($_GET['action']) && $_GET['action'] == "Print")) 
        {

        $pdf_data ="";

           
        $pdf_data .= '
<thead>
    <tr>
        <th align="right" style="text-align:center;">Description</th>
        <th align="right" style="text-align:right;">Date Acquired</th>
        <th align="right" style="text-align:right;">Purchase Value</th>
        <th align="right" style="text-align:right;">Percentage</th>
        <th align="right" style="text-align:right;">Entitlement</th>
        <th align="right" style="text-align:right;">Depreciation</th>
        <th align="right" style="text-align:right;">Disposal</th>
        <th align="right" style="text-align:right;">WDV</th>
    </tr>
</thead>

<tbody class="tbody_data">';

foreach ($accounts as $account) {

    $total_depreciation = array_sum(array_map(function($item) {
        return $item->cfs_depreciation;
    }, $account->items));


    $pdf_data .= '
    <tr>
        <td colspan="8"><b>' . $account->ah_account_name . '</b></td>
    </tr>';

    foreach ($account->items as $it) {
        $pdf_data .= '
        <tr>
            <td>' . $it->cfs_description . '</td>
            <td style="text-align:right;">' . date('d M Y', strtotime($it->cfs_acquired_date)) . '</td>
            <td style="text-align:right;">95.37</td>
            <td style="text-align:right;">15%</td>
            <td style="text-align:right;">365</td>
            <td style="text-align:right;">'. $it->cfs_depreciation .'</td>
            <td style="text-align:right;"></td>
            <td style="text-align:right;">95.37</td>
        </tr>';
    }

    $pdf_data .= '
        <tr>
            <td></td>
            <td style="text-align:right;"></td>
            <td style="text-align:right;"></td>
            <td style="text-align:right;"></td>
            <td style="text-align:right;"></td>
            <td style="text-align:right;">'.$total_depreciation.'</td>
            <td style="text-align:right;"></td>
            <td style="text-align:right;"></td>
        </tr>';

}

$pdf_data .= '
</tbody>

<tfoot>
    <tr class="no-sort">
        <td></td>
        <td><b style="font-size:20px;"></b></td>
        <td style="text-align:right;"><b></b></td>
        <td align="right" style="text-align:right;"><b></b></td>
        <td align="right" style="text-align:right;"><b></b></td>
        <td style="text-align:right;"><b></b></td>
        <td></td>
        <td style="text-align:right;"><b></b></td>
    </tr>
</tfoot>';



                $title = "Fixed Asset Report ".date('d-M-Y')."";


                $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
                $fontDirs = $defaultConfig['fontDir'];
     
                $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
                $fontData = $defaultFontConfig['fontdata'];
    
                $title = "Trial Balance Report ".date('d-M-Y')."";
    
                $mpdf = new \Mpdf\Mpdf([
                    'format' => 'Letter', // Custom page size in millimeters
                    //'format' => [300, 600], // Width: 300mm, Height: 600mm (custom large page)
                    'default_font_size' => 9, 
                    'margin_left' => 5, 
                    'margin_right' => 5,
                    'fontDir' => array_merge($fontDirs, [
                        __DIR__ . '/fonts'
                    ]),
                    'fontdata' => $fontData + [
                        'bentonsans' => [
                          
                            'R' => 'OpenSans-Regular.ttf',
                            'B' => 'OpenSans-Bold.ttf',
                        ],
                    ],
                    'default_font' => 'bentonsans'
                    
                ]);
             

                $mpdf->SetTitle('Fixed Asset Report'); // Set the title
                

                if(empty($end_date))
                {
                 
                   $dates = "";
                }
                else
                {
                   $dates = date('d M Y',strtotime($end_date));
                }


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
            
                <h3>Al Fuzail Engineering Services WLL</h3>
                <div><p class="paragraph-spacing">Tel : +974 4460 4254, Fax : 4029 8994, email : engineering@alfuzailgroup.com</p></div>
                <p>Post Box : 201978, Gate : 248, Street : 24, Industrial Area, Doha - Qatar</p>
                

                </td>
                
                </tr>
            
                </table>

            
                <table width="100%" style="margin-top:2px;">

            
                <tr width="100%">

                <td colspan="5" align="right"><h3>Fixed Asset Report</h3></td>
            

                </tr>

                <tr width="100%">

                <td width="15%">
                Date : 
                </td>

                <td align="left">
                
                '.$dates.'

                </td>

                </tr>
               

            
                </table>
               
            
                <table  width="100%" style="margin-top:2px;border-collapse: collapse; border-spacing: 2;border-top:2px solid;">
                
                 
                '.$pdf_data.'

              
                
                </table>
            
                ';


                $mpdf->WriteHTML($html);

                $this->response->setHeader('Content-Type', 'application/pdf');

                $mpdf->Output($title . '.pdf', 'I');

                exit();


        }
 








    $data['content'] = view('accounts/fixed_asset_report',$data);

    return view('accounts/report-module',$data); 

    }

    else
    {

    $data['accounts'] = array();

    $data['content'] = view('accounts/fixed_asset_report',$data);
    
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
