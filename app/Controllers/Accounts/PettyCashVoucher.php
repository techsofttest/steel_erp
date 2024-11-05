<?php

namespace App\Controllers\Accounts;

use App\Controllers\BaseController;


class PettyCashVoucher extends BaseController
{
    

    public function FetchData()
    {

        /*pagination start*/
        $request = service('request');
        $postData = $request->getPost();
        $dtpostData = $postData['data'];
        $response = array();
 
        ## Read value
        $draw = $dtpostData['draw'];
        $start = $dtpostData['start'];
        $rowperpage = $dtpostData['length']; // Rows display per page
        $columnIndex = $dtpostData['order'][0]['column']; // Column index
        $columnName = $dtpostData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $dtpostData['order'][0]['dir']; // asc or desc
        $searchValue = $dtpostData['search']['value']; // Search value

        // Check if the current sort order is 'asc', then set it to 'desc'
        if ($columnSortOrder === 'asc') {
            $columnSortOrder = 'desc';
        } 

 
        ## Total number of records without filtering
       
        $totalRecords = $this->common_model->GetTotalRecords('accounts_petty_cash_voucher','pcv_id','DESC');
 
        ## Total number of records with filtering
         $searchColumns = array('pcv_voucher_no');

        
        $totalRecordwithFilter = $this->common_model->GetTotalRecordwithFilter('accounts_petty_cash_voucher','pcv_id',$searchValue,$searchColumns);
        
        ##Joins if any //Pass Joins as Multi dim array
        $joins = array(
            array(
                'table' => 'accounts_charts_of_accounts',
                'pk' => 'ca_id',
                'fk' => 'pcv_credit_account',
                ),
        );
        ## Fetch records
        
        $records = $this->common_model->GetRecord('accounts_petty_cash_voucher','pcv_id',$searchValue,$searchColumns,$columnName,$columnSortOrder,$joins,$rowperpage,$start);
       
        $data = array();
        
        $i=1;
        foreach($records as $record ){
            $action = '<a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->pcv_id .'" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a><a href="javascript:void(0)" class="delete delete-color delete_btn d-none" data-toggle="tooltip" data-id="'.$record->pcv_id .'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> Delete</a><a  href="javascript:void(0)" class="view view-color view_btn" data-id="'.$record->pcv_id .'" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a>';
           
           $data[] = array( 
              "pcv_id"=>$i,
              "pcv_voucher_no"=>$record->pcv_voucher_no,
              "pcv_date"=>date('d-F-Y',strtotime($record->pcv_date)),
              "pcv_credit_account"=>$record->ca_name,
              "action" =>$action,
           );
           $i++; 
        }
 
        ## Response
        $response = array(
         "draw" => intval($draw),
         "iTotalRecords" => $totalRecords,
         "iTotalDisplayRecords" => $totalRecordwithFilter,
         "aaData" => $data,
         "token" => csrf_hash() // New token hash
        );
 
        //return $this->response->setJSON($response);

        echo json_encode($response);

        exit;

        /*pagination end*/
    } 

     
    public function FetchTypes()
    {

        $page= !empty($_GET['page']) ? $_GET['page'] : 0;
        $term = !empty($_GET['term']) ? $_GET['term'] : "";
        $resultCount = 10;
        $end = ($page - 1) * $resultCount;       
        $start = $end + $resultCount;
      
        $data['result'] = $this->common_model->FetchAllLimit('crm_sales_order','so_order_no','asc',$term,$start,$end);

        $data['total_count'] =count($data['result']);

        return json_encode($data);

    }

    //view page
    public function index()
    {  

        $data = array();

        $data['r_methods'] = $this->common_model->FetchAllOrder('master_receipt_method','rm_name','asc');
       
        $data['accounts'] = $this->common_model->FetchAllOrder('accounts_charts_of_accounts','ca_name','asc');

        $data['sales_orders'] = $this->common_model->FetchAllOrder('crm_sales_orders','so_id','desc');

        //$data['customers'] = $this->common_model->FetchAllOrder('crm_customer_creation','cc_customer_name','asc');

        $data['content'] = view('accounts/petty-cash-voucher',$data);

        return view('accounts/accounts-module',$data);

        
    }




    // add
    Public function Add()
    {   

        $insert_data['pcv_date'] = date('Y-m-d',strtotime($this->request->getPost('pcv_date')));

        $insert_data['pcv_credit_account'] = $this->request->getPost('pcv_credit_account');

        $insert_data['pcv_total'] = $this->request->getPost('total_amount'); 

        $insert_data['pcv_pay_method'] = $this->request->getPost('pcv_pay_method');

        $insert_data['pcv_added_by'] = 0; 

        $insert_data['pcv_added_date'] = date('Y-m-d'); 


        if(empty($this->request->getPost('pcv_id')))

        {

        $id = $this->common_model->InsertData('accounts_petty_cash_voucher',$insert_data);

        }

        else
        {
        
        $id = $this->request->getPost('pcv_id');

        $pcv_cond = array('pcv_id' => $id);

        $this->common_model->EditData($insert_data,$pcv_cond,'accounts_petty_cash_voucher');

        }

        $pcv_no = 'PCV'.str_pad($id, 7, '0', STR_PAD_LEFT);
        
        $cond = array('pcv_id' => $id);

        $update_data['pcv_voucher_no'] = $pcv_no;

        $this->common_model->EditData($update_data,$cond,'accounts_petty_cash_voucher');
        
        for($i=0;$i<count($this->request->getPost('pcv_sale_invoice'));$i++)
        {

            $check_credit = $this->common_model->SingleRow('accounts_petty_cash_debits',array('pci_voucher_id' => $id,'pci_debit_account' => $_POST['pcv_debit'][$i]));


            $sales_invoice = $_POST['pcv_sale_invoice'][$i];

            $account = $_POST['pcv_account'][$i];

            $amount = $_POST['pcv_debit'][$i];

            $remarks = $_POST['pcv_remarks'][$i];


            $insert_invoice['pci_sales_order'] =  $sales_invoice;

            $insert_invoice['pci_debit_account'] = $account;

            $insert_invoice['pci_amount'] = $amount;

            $insert_invoice['pci_narration'] = $remarks;

            $insert_invoice['pci_voucher_id'] = $id;


            if(empty($check_credit))
            {
            $this->common_model->InsertData('accounts_petty_cash_debits',$insert_invoice);
            }
            else
            {
            $this->common_model->EditData($insert_invoice,array('pci_id' => $check_credit->pci_id),'accounts_petty_cash_debits');
            }

           

        }

    
       
    }




    public function FetchReference()
    {

    $uid = $this->common_model->FetchNextId('accounts_petty_cash_voucher',"PCV");

    echo $uid;

    }




    //view
    public function View()
    {
        
        $cond = array('jv_id' => $this->request->getPost('jv_id'));

        $joins = array(
            array(
                'table' => 'accounts_account_type',
                'pk' => 'at_id',
                'fk' => 'jv_account',
                ),
            array(
                'table' => 'crm_sales_order',
                'pk' => 'so_id',
                'fk' => 'jv_sales_order_id',
            ),
        );

        $journal_voucher = $this->common_model->SingleRowJoin('accounts_journal_voucher',$cond,$joins);

        $data['jv_voucher_no']      = $journal_voucher->jv_voucher_no;

        $data['jv_voucher_date']    = date('d-m-Y',strtotime($journal_voucher->jv_voucher_date));

        $data['jv_sales_order_id']  = $journal_voucher->so_order_no;

        $data['jv_account']         = $journal_voucher->at_name;

        $data['jv_debit']           = $journal_voucher->jv_debit;

        $data['jv_credit']          = $journal_voucher->jv_credit;

        $data['jv_narration']       = $journal_voucher->jv_narration;

        echo json_encode($data);
    }




    //Edit 
    public function Edit()
    {
        
        $cond = array('pcv_id' => $this->request->getPost('id'));

        $joins = array(

            array(
                'table' => 'accounts_charts_of_accounts',
                'pk' => 'ca_id',
                'fk' => 'pcv_credit_account',
                ),

        );

        $data['pcv'] = $this->common_model->SingleRowJoin('accounts_petty_cash_voucher',$cond,$joins);


        $customers = $this->common_model->FetchAllOrder('accounts_charts_of_accounts','ca_name','asc');


        $debit_cond = array('pci_voucher_id' => $data['pcv']->pcv_id);
    
        $debit_joins = array(
            array(
            'table' => 'accounts_charts_of_accounts',
            'pk' => 'ca_id',
            'fk' => 'pci_debit_account',
            ),
            array(
             'table' => 'crm_sales_orders',
             'pk' => 'so_id',
             'fk' => 'pci_sales_order'
            ),
        );    

        $debits = $this->common_model->FetchWhereJoin('accounts_petty_cash_debits',$debit_cond,$debit_joins);

        $data['debit'] = "";

        $dd='';

        foreach($customers as $cus) { 

        $dd.='<option value="'.$cus->ca_id.'">'.$cus->ca_name.'</option>';

        }


    foreach($debits as $debit)
    {

        $data['debit'] .='
        <tr class="view_debit" id="view'.$debit->pci_id.'">
        <input type="hidden" id="debit_id_edit" name="debit_id" value="'.$debit->pci_id.'">


        <td>

        <p class="view">'.$debit->so_reffer_no.'</p>

        <select style="display:none;" class="edit form-control" name="c_name">

        <option value="'.$debit->ca_id.'" selected hidden>'.$debit->ca_name.'</option>

        '.$dd.'
        
        </select>
       
        </td>



        <td>

        <p class="view">'.$debit->ca_name.'</p>

        <select style="display:none;" class="edit form-control" name="c_name">

        <option value="'.$debit->ca_id.'" selected>'.$debit->ca_name.'</option>

        '.$dd.'
        
        </select>
       
        </td>



        <td>
        
        <p class="view">'.$debit->pci_amount.'</p>

        <input style="display:none;" class="edit form-control" type="number" name="amount" value="'.$debit->pci_amount.'">
        
        </td>


        <td>

         <p class="view">'.$debit->pci_narration.'</p>

         <input style="display:none;" class="edit form-control" type="text" name="remarks" value="'.$debit->pci_narration.'">
        
        </td>


        <td>
        
        <div class="view">
        <a href="javascript:void(0);" class="edit_invoice btn btn-primary" data-id="'.$debit->pci_id.'">Edit</a>
        
        <a href="javascript:void(0);" class="view_linked btn btn-warning" data-id="'.$debit->pci_id.'">Linked</a>
        </div>

        <div class="edit" style="display:none;">
        
        <button class="btn btn-success update_invoice_btn" type="button">Update</button>

        <button class="btn btn-danger cancel_invoice_btn" data-id="'.$debit->pci_id.'" type="button">Cancel</button>

        </div>

        </td>

        </tr>

        ';

    }



        echo json_encode($data);
    }



   // update 
    public function Update()
    {    

        $cond = array('pcv_id' => $this->request->getPost('pcv_id'));
        
        $update_data['pcv_date'] = date('Y-m-d',strtotime($this->request->getPost('pcv_date'))); 

        $update_data['pcv_pay_method'] = $this->request->getPost('pcv_pay_method');

        $update_data['pcv_credit_account'] = $this->request->getPost('pcv_credit_account');

        $update_data['pcv_modify_date'] = date('Y-m-d'); 

        $this->common_model->EditData($update_data,$cond,'accounts_petty_cash_voucher');
       
    }




    public function UpdateDebitDetails()
    {

        if($_POST)
        {

        $id = $this->request->getPost('d_id');

        $cond = array('pci_id' => $id);

        $debit_account = $this->request->getPost('d_account');

        $amount = $this->request->getPost('d_amount');

        $narration = $this->request->getPost('d_narration');


        $update_data['pci_debit_account'] = $debit_account;

        $update_data['pci_amount'] = $amount;

        $update_data['pci_narration'] = $narration;
    
        $this->common_model->EditData($update_data,$cond,'accounts_petty_cash_debits');

        $this->FetchDebitData($id);

        }

    }





    public function FetchDebitData($id)
    {


    $invoice_cond = array('pci_id' => $id);

    $data['inv_id'] =  $id;

    $invoice_joins = array(
        array(
            'table' => 'crm_customer_creation',
            'pk' => 'cc_id',
            'fk' => 'pci_debit_account',
            ),
    );    

    $debit = $this->common_model->SingleRowJoin('accounts_petty_cash_debits',$invoice_cond,$invoice_joins);

    //Recalculate Total

    $pcv_id = $debit->pci_voucher_id;

    $all_debits = $this->common_model->FetchWhere('accounts_petty_cash_debits',array('pci_voucher_id' => $pcv_id));

    $total = 0;

    foreach($all_debits as $deb_tot)
    {

    $total = $total+=$deb_tot->pci_amount;

    }

    $payment_data['pcv_total'] = $total;

    $payment_cond['pcv_id'] = $pcv_id;

    $this->common_model->EditData($payment_data,$payment_cond,'accounts_petty_cash_voucher');

    $data['total'] = $total;

    //

    $customers = $this->common_model->FetchAllOrder('crm_customer_creation','cc_customer_name','asc');

    $dd='';

    foreach($customers as $cus) { 

       $dd.='<option value="'.$cus->cc_id.'">'.$cus->cc_customer_name.'</option>';

    }


    $data['debit'] ="";

    $data['debit'] .='
    
    <input type="hidden" id="debit_id_edit" name="debit_id" value="'.$debit->pci_id.'">


    <td>

    <p class="view">'.$debit->cc_customer_name.'</p>

    <select style="display:none;" class="edit form-control" name="c_name">

    <option value="'.$debit->cc_id.'" selected hidden>'.$debit->cc_customer_name.'</option>

    '.$dd.'
    
    </select>
   
    </td>



    <td>

    <p class="view">'.$debit->cc_customer_name.'</p>

    <select style="display:none;" class="edit form-control" name="c_name">

    <option value="'.$debit->cc_id.'" selected>'.$debit->cc_customer_name.'</option>

    '.$dd.'
    
    </select>
   
    </td>



    <td>
    
    <p class="view">'.$debit->pci_amount.'</p>

    <input style="display:none;" class="edit form-control" type="number" name="amount" value="'.$debit->pci_amount.'">
    
    </td>


    <td>

     <p class="view">'.$debit->pci_narration.'</p>

     <input style="display:none;" class="edit form-control" type="text" name="remarks" value="'.$debit->pci_narration.'">
    
    </td>


    <td>
    
    <div class="view">
    <a href="javascript:void(0);" class="edit_invoice btn btn-primary" data-id="'.$debit->pci_id.'">Edit</a>
    
    <a href="javascript:void(0);" class="view_linked btn btn-warning" data-id="'.$debit->pci_id.'">Linked</a>
    </div>

    <div class="edit" style="display:none;">
    
    <button class="btn btn-success update_invoice_btn" type="button">Update</button>

    <button class="btn btn-danger cancel_invoice_btn" data-id="'.$debit->pci_id.'" type="button">Cancel</button>

    </div>

    </td>

    ';


    echo json_encode($data);


    }












    
    //delete 
    public function Delete()
    {
        $cond = array('pcv_id' => $this->request->getPost('id'));

        $this->common_model->DeleteData('accounts_petty_cash_debits',array('pci_voucher_id' => $this->request->getPost('ID')));

        $this->common_model->DeleteData('accounts_petty_cash_voucher',$cond);

    }

    //fetch order
    public function FetchOrder()
    {
        $cond = array('so_id' => $this->request->getPost('ID'));
        $fetch_data = $this->common_model->SingleRow('crm_sales_order',$cond);
        $data['order_no'] = $fetch_data->so_order_no;

        echo json_encode($data);
        
    }




    
    public function FetchInvoices()
    {

    if($_POST)
    {

    $ac_id = $this->request->getPost('id');


    $joins = array(
           
    );

    $customer = $this->common_model->SingleRowJoin('crm_customer_creation',array('cc_id' => $ac_id),$joins);

    $cond = array('pf_customer' => $customer->cc_id);

    $invoices = $this->common_model->FetchWhere('crm_proforma_invoices',$cond);
   
    $data['status']=0;

    $data['invoices']="";

    $sl =0;
    foreach($invoices as $inv)
    {
    $sl++;
    $data['invoices'].='<tr id="'.$inv->pf_id.'">
    <input type="hidden" name="credit_account_invoice[]" value="'.$ac_id.'">
    <th>'.$sl.'</th>
    <th>'.date('d-m-Y',strtotime($inv->pf_date)).'</th>
    <th>'.$inv->pf_reffer_no.'</th>
    <th><input class="form-control" name="inv_lpo_ref[]" type="text" value="'.$inv->pf_lpo_ref.'" required></th>
    <th>'.$inv->pf_total_amount.'</th>
    <th><input class="form-control" name="inv_receipt_amount[]" type="number"></th>
    <th><input type="checkbox" name="invoice_selected[]" value="'.$inv->pf_id.'"></th>
    </tr>';

    $data['status']=1;

    }

    echo json_encode($data);

    }


    }







 











    public function Print($id=""){

        if($id=="")
        $id = 1;
    
        $cond = array('pcv_id' => $id);
    
         ##Joins if any //Pass Joins as Multi dim array
    
         $joins = array(
    
        );
    
        $pcv = $this->common_model->SingleRowJoin('accounts_petty_cash_voucher',$cond,$joins);
    
        $total_amount = 25000.00;
    
    
        $joins_inv = array(
    
            array(
                'table' => 'crm_sales_orders',
                'pk' => 'so_id',
                'fk' => 'pci_sales_order',
               ),
    
    
               array(
                'table' => 'accounts_charts_of_accounts',
                'pk' => 'ca_id',
                'fk' => 'pci_debit_account',
                ),
    
        );
    
        $orders = $this->common_model->FetchWhereJoin('accounts_petty_cash_debits',array('pci_voucher_id'=>$id),$joins_inv);
    
    
        $orders_sec ="";


        for($i=0;$i<=4;$i++)
        {


        $orders_sec .='
        
            <tr style="border-bottom:3px solid;">
            
            <td align="left">None</td>
        
            <td align="left">4500</td>
        
            <td align="left">Cost - Fabrication</td>
        
            <td align="right">12,000.00</td>
        
            </tr>
        
        ';


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
            
            <td align="right"><h3>Petty Cash Voucher</h3></td>
        
            </tr>
        
            </table>
        
        
            <table  width="100%" style="margin-top:2px;border-top:3px solid;border-bottom:3px solid;">
        
            <tr>
            
            <td width="50%">
            
            Reference : PCV00001
            
            </td>
            
            
            </tr>
        
        
            <tr>
            
            <td width="50%">
            
            Date : '.date('d-m-Y',strtotime("20-10-2024")).'
            
            </td>
            
         
            </tr>
        
        
            <tr>
            
            <td width="50%">
            
            Division : Al Fuzail Engineering Services
            
            </td>
            
            
            </tr>
        
        
        
            
            </table>
        
        
        
        
            <table  width="100%" style="margin-top:2px;">
            
        
            <tr  style="border-bottom:3px solid;">
            
            <th align="left">Sales Order No</th>
        
            <th align="left">Account No</th>
        
            <th align="left">Account Description</th>
        
            <th align="left">Amount</th>
        
            </tr>
        
        
        
    
            '.$orders_sec.'
            
    
            
            </table>
        
            ';
        
           
           
            $footer = '
    
            <table width="100%">

            
            <tr>
            
            <td colpsan="5" align="left"><b>Amount : '.currency_to_words($total_amount).'</b></td>
        
            <td colspan="1" align="right" style="text-align:right;"><b>'.format_currency($total_amount).'</b></td>
        
            </tr>

        
            </table>
        
        
            <table>
            
            <tr>
        
            <td width="25%" style="padding-right:60px;">Prepared by : (print)</th>
        
            <td width="25%" style="padding-right:60px;">Received by:</td>
        
            <td width="25%" style="padding-right:60px;">Finance Manager</td>
        
            <td width="25%" style="padding-right:60px;">CEO</td>
        
            </tr>
        
            </table>
    
            ';
    
        
            
            $mpdf->WriteHTML($html);
            $mpdf->SetFooter($footer);
            $this->response->setHeader('Content-Type', 'application/pdf');
            $mpdf->Output();
        
            }








    










}
