<?php

namespace App\Controllers\Procurement;

use App\Controllers\BaseController;


class FixedAssetDisposal extends BaseController
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

        $totalRecords = $this->common_model->GetTotalRecords('pro_dispose_fixed_asset', 'dfs_id', 'DESC');


        ## Total number of records with filtering

        $searchColumns = array('dfs_description');

        $totalRecordwithFilter = $this->common_model->GetTotalRecordwithFilter('pro_dispose_fixed_asset', 'dfs_id', $searchValue, $searchColumns);

        ##Joins if any //Pass Joins as Multi dim array
        $joins = array(
            array(
                'table' => 'accounts_account_heads',
                'pk'    => 'ah_id',
                'fk'    => 'dfs_account_head',
            ),

        );
        ## Fetch records
        $records = $this->common_model->GetRecord('pro_dispose_fixed_asset', 'dfs_id', $searchValue, $searchColumns, $columnName, $columnSortOrder, $joins, $rowperpage, $start);

        $data = array();

        $i = 1;
        foreach ($records as $record) {
            $action = '<a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="' . $record->dfs_id . '" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a><a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="' . $record->dfs_id . '"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> Delete</a><a  href="javascript:void(0)" data-id="' . $record->dfs_id . '"  class="view view-color view_btn" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a>';

            $data[] = array(
                "dfs_id"               => $i,
                'dfs_description'      => $record->dfs_description,
                'dfs_account_head'     => $record->ah_account_name,
                'dfs_date_dispose'    => date('d-M-Y', strtotime($record->dfs_date_dispose)),
                'dfs_sale_price'    =>  format_currency($record->dfs_sales_price),
                'dfs_profit'    =>  format_currency($record->dfs_profit),
                "action"         => $action,
            );
            $i++;
        }

        ## Response
        $response = array(
            "draw"                 => intval($draw),
            "iTotalRecords"        => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData"               => $data,
            "token"                => csrf_hash() // New token hash
        );

        //return $this->response->setJSON($response);

        echo json_encode($response);

        exit;

        /*pagination end*/
    }



    //search droup drown (accountid)
    public function FetchTypes()
    {

        $page = !empty($_GET['page']) ? $_GET['page'] : 0;
        $term = !empty($_GET['term']) ? $_GET['term'] : "";

        $resultCount = 10;
        $end = ($page - 1) * $resultCount;
        $start = $end + $resultCount;


        $data['result'] = $this->common_model->FetchAllLimit('accounts_account_heads', 'ah_account_name', 'asc', $term, $start, $end);

        $data['total_count'] = count($data['result']);


        return json_encode($data);
    }


    //search droup drown (accountid)
    public function FetchDebitAcc()
    {

        $page = !empty($_GET['page']) ? $_GET['page'] : 0;
        $term = !empty($_GET['term']) ? $_GET['term'] : "";
        $resultCount = 10;
        $end = ($page - 1) * $resultCount;
        $start = $end + $resultCount;

        $data['result'] = $this->common_model->FetchAllLimit('accounts_charts_of_accounts', 'ca_name', 'asc', $term, $start, $end);

        $data['total_count'] = count($data['result']);

        return json_encode($data);
    }


    public function FetchFixedAsset()
    {

        $page = !empty($_GET['page']) ? $_GET['page'] : 0;
        $term = !empty($_GET['term']) ? $_GET['term'] : "";
        $resultCount = 10;
        $end = ($page - 1) * $resultCount;
        $start = $end + $resultCount;

        $data['result'] = $this->common_model->FetchAllLimit('pro_create_fixed_asset', 'cfs_description', 'asc', $term, $start, $end);

        $data['total_count'] = count($data['result']);

        return json_encode($data);
    }

    // search droup drown (product description)
    public function FetchProdDes()
    {

        $page = !empty($_GET['page']) ? $_GET['page'] : 0;
        $term = !empty($_GET['term']) ? $_GET['term'] : "";
        $resultCount = 10;
        $end = ($page - 1) * $resultCount;
        $start = $end + $resultCount;

        $data['result'] = $this->common_model->FetchAllLimit('crm_products', 'product_details', 'asc', $term, $start, $end);

        $data['total_count'] = count($data['result']);

        return json_encode($data);
    }


    //view page
    public function index()
    {
        $data['material_received']   = $this->common_model->FetchAllOrder('pro_material_received_note', 'mrn_id', 'desc');

        $data['charts_of_account']   = $this->common_model->FetchAllOrder('accounts_charts_of_accounts', 'ca_id', 'desc');

        $data['content'] = view('procurement/fixed_asset_disposal', $data);

        return view('procurement/pro-module', $data);
    }


    // add account head
    public function Add()
    {
        $db = \Config\Database::connect();
        
        // Ensure dfs_jv_id column exists
        if (!$db->fieldExists('dfs_jv_id', 'pro_dispose_fixed_asset')) {
            $forge = \Config\Database::forge();
            $forge->addColumn('pro_dispose_fixed_asset', [
                'dfs_jv_id' => [
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                    'null' => true,
                    'default' => null,
                ]
            ]);
        }

        $insert_data = $this->request->getPost();

        if (isset($insert_data['total_receipt_amount'])) {
            unset($insert_data['total_receipt_amount']);
        }
        if (isset($insert_data['dfs_sales_price'])) {
            $insert_data['dfs_sales_price'] = str_replace(',', '', $insert_data['dfs_sales_price']);
        }
        if (isset($insert_data['dfs_asset_amount'])) {
            $insert_data['dfs_asset_amount'] = str_replace(',', '', $insert_data['dfs_asset_amount']);
        }
        if (isset($insert_data['dfs_asset_balance'])) {
            $insert_data['dfs_asset_balance'] = str_replace(',', '', $insert_data['dfs_asset_balance']);
        }
        if (isset($insert_data['dfs_profit'])) {
            $insert_data['dfs_profit'] = str_replace(',', '', $insert_data['dfs_profit']);
        }
        if (isset($insert_data['dfs_depreciation'])) {
            $insert_data['dfs_depreciation'] = str_replace(['%', ','], '', $insert_data['dfs_depreciation']);
        }

        if (!empty($this->request->getPost('dfs_date_dispose'))) {
            $raw_dispose = str_replace('/', '-', $this->request->getPost('dfs_date_dispose'));
            $time = strtotime($raw_dispose);
            $insert_data['dfs_date_dispose'] = $time ? date('Y-m-d', $time) : date('Y-m-d');
        }
        if (!empty($this->request->getPost('dfs_acquired_date'))) {
            $raw_acq = str_replace('/', '-', $this->request->getPost('dfs_acquired_date'));
            $time = strtotime($raw_acq);
            $insert_data['dfs_acquired_date'] = $time ? date('Y-m-d', $time) : null;
        }

        // Filter to only columns that actually exist in the table
        $allowed_fields = $db->getFieldNames('pro_dispose_fixed_asset');
        $filtered_data = [];
        foreach ($insert_data as $key => $val) {
            if (in_array($key, $allowed_fields)) {
                $filtered_data[$key] = $val;
            }
        }

        $id = $this->common_model->InsertData('pro_dispose_fixed_asset', $filtered_data);

        if (!is_numeric($id) || $id <= 0) {
            log_message('error', 'InsertData error in FixedAssetDisposal::Add: ' . json_encode($id));
            echo json_encode(['status' => 'error', 'message' => 'Database error inserting disposal record.']);
            exit;
        }

        echo json_encode(['status' => 'success', 'id' => $id]);
        exit;
    }

    public function AddToJvRows()
    {
        $credit_acc_id = $this->request->getPost('dfs_credit_account');
        $debit_acc_id = $this->request->getPost('dfs_debit_account');

        $credit_acc = !empty($credit_acc_id) ? $this->common_model->SingleRow('accounts_charts_of_accounts', ['ca_id' => $credit_acc_id]) : null;
        $debit_acc = !empty($debit_acc_id) ? $this->common_model->SingleRow('accounts_charts_of_accounts', ['ca_id' => $debit_acc_id]) : null;

        $sale_price = floatval(str_replace(',', '', $this->request->getPost('dfs_sales_price') ?? 0));
        $profit = floatval(str_replace(',', '', $this->request->getPost('dfs_profit') ?? 0));
        $asset_amount = floatval(str_replace(',', '', $this->request->getPost('dfs_asset_amount') ?? 0));
        $asset_balance = floatval(str_replace(',', '', $this->request->getPost('dfs_asset_balance') ?? 0));

        $jv_amount = 0;
        if ($sale_price > 0) {
            $jv_amount = $sale_price;
        } elseif ($profit != 0) {
            $jv_amount = abs($profit);
        } elseif ($asset_balance > 0) {
            $jv_amount = $asset_balance;
        } elseif ($asset_amount > 0) {
            $jv_amount = $asset_amount;
        }

        $dispose_record = $this->common_model->SingleRow('pro_dispose_fixed_asset', ['dfs_id' => $this->request->getPost('ID')]);
        if (!empty($dispose_record) && !empty($dispose_record->dfs_date_dispose)) {
            $data['dep_date'] = date('d-M-Y', strtotime($dispose_record->dfs_date_dispose));
        } else {
            $raw_date = $this->request->getPost('dfs_date_dispose');
            $data['dep_date'] = !empty($raw_date) ? date('d-M-Y', strtotime($raw_date)) : date('d-M-Y');
        }

        $debit_name = $debit_acc ? $debit_acc->ca_name : 'GI Account';
        $credit_name = $credit_acc ? $credit_acc->ca_name : 'Credit Account';

        $data['jv_rows'] = "";
        $data['total_credit'] = $data['total_debit'] = $jv_amount;

        $j = 1;
        $data['jv_rows'] .= '
        <tr class="jv_row">
            <th class="sl_no"> ' . $j . ' </th>
            <th class="select2_parent" width="35%"> 
                <input type="text" class="form-control" name="jv_account[]" value="' . htmlspecialchars($debit_name) . '" readonly>
            </th>
            <th class="p-0"><input name="jv_debit[]" type="number" step="0.01" class="form-control debit_amount text-end" value="' . $jv_amount . '" readonly></th>
            <th class="p-0"><input name="jv_credit[]" type="number" class="form-control credit_amount" readonly></th>
            <th><input name="jv_remarks[]" type="text" class="form-control" ></th>
        </tr>';

        $j++;

        $data['jv_rows'] .= '
        <tr class="jv_row">
            <th class="sl_no"> ' . $j . ' </th>
            <th class="select2_parent" width="35%"> 
                <input type="text" class="form-control" name="jv_account[]" value="' . htmlspecialchars($credit_name) . '" readonly>
            </th>
            <th class="p-0"><input name="jv_debit[]" type="number" step="0.01" class="form-control debit_amount" readonly></th>
            <th class="p-0"><input name="jv_credit[]" type="number" class="form-control credit_amount text-end" value="' . $jv_amount . '" readonly></th>
            <th><input name="jv_remarks[]" type="text" class="form-control" ></th>
        </tr>';

        $data['jv_rows'] .= '
        <tr class="no-border">
            <td colspan="" align="right" class="no-border"></td>
            <td colspan="" align="right">Total</td>
            <th id="total_amount_debit_disp" class="text-end">' . htmlspecialchars($jv_amount) . '</th>
            <th id="total_amount_credit_disp" class="text-end">' . htmlspecialchars($jv_amount) . '</th>
            <input type="hidden" id="total_amount_inp" name="total_amount" value="' . $jv_amount . '">
            <input type="hidden" id="total_amount_debit" name="total_debit" value="' . $jv_amount . '">
            <input type="hidden" id="total_amount_credit" name="total_credit" value="' . $jv_amount . '">
            <input type="hidden" id="dfs_id" name="dfs_id" value="' . $this->request->getPost('ID') . '">
        </tr>';

        echo json_encode($data);
        exit;
    }

    public function AddJournalVoucher()
    {
        $jv_date = date('Y-m-d', strtotime($this->request->getPost('jv_date')));
        $jv_year = date('Y', strtotime($jv_date));

        $juid = $this->common_model->FetchNextId('accounts_journal_vouchers', 'jv_voucher_no', "JV-{$jv_year}-", '');

        $insert_journal['jv_voucher_no'] = $juid;
        $insert_journal['jv_date'] = $jv_date;
        $insert_journal['jv_debit_total'] = $this->request->getPost('total_debit');
        $insert_journal['jv_credit_total'] = $this->request->getPost('total_credit');
        $insert_journal['jv_added_date'] = date('Y-m-d');

        $journal_id = $this->common_model->InsertData('accounts_journal_vouchers', $insert_journal);

        $dfs_id = $this->request->getPost('dfs_id');
        if (!empty($dfs_id)) {
            $db = \Config\Database::connect();
            if ($db->fieldExists('dfs_jv_id', 'pro_dispose_fixed_asset')) {
                $this->common_model->EditData(['dfs_jv_id' => $juid], ['dfs_id' => $dfs_id], 'pro_dispose_fixed_asset');
            }
        }

        // Insert Journal invoices
        if ($this->request->getPost('jv_account')) {
            for ($ji = 0; $ji < count($this->request->getPost('jv_account')); $ji++) {
                $account = $this->request->getPost('jv_account')[$ji];
                $account_data = $this->common_model->SingleRow('accounts_charts_of_accounts', array('ca_name' => $account));
                $account_id = 0;
                if (!empty($account_data))
                    $account_id = $account_data->ca_id;

                $debit = !empty($this->request->getPost('jv_debit')[$ji]) ? $this->request->getPost('jv_debit')[$ji] : 0;
                $credit = !empty($this->request->getPost('jv_credit')[$ji]) ? $this->request->getPost('jv_credit')[$ji] : 0;
                $narration = $this->request->getPost('jv_remarks')[$ji] ?? '';

                $insert_journal_invoice['ji_voucher_id'] = $journal_id;
                $insert_journal_invoice['ji_account'] = $account_id;
                $insert_journal_invoice['ji_debit'] = $debit;
                $insert_journal_invoice['ji_credit'] = $credit;
                $insert_journal_invoice['ji_narration'] = $narration;

                $this->common_model->InsertData('accounts_journal_invoices', $insert_journal_invoice);
            }
        }

        $return['msg'] = "Added to journal";
        $return['status'] = 1;
        $return['journal_id'] = $journal_id;

        echo json_encode($return);
        exit;
    }

    public function FillData()
    {
        $fixed = $this->request->getPost('Fixed');

        // Define condition for query
        $cond = ['cfs_id' => $fixed];

        // Joins array for fetching related data
        $joins = array(
            array(
                'table' => 'accounts_account_heads',
                'pk'    => 'ah_id',
                'fk'    => 'cfs_account_head',
            )
        );

        // Fetch the fixed asset data
        $data['fixedasset'] = $asset = $this->common_model->SingleRowJoin('pro_create_fixed_asset', $cond, $joins);

        $fixed_asset_bal = floatval($this->pro_model->FixedAssetBalance($fixed)); // Get the fixed asset balance
        $fixed_asset_depr = floatval($data['fixedasset']->cfs_depreciation); // Get the depreciation percentage
        
        // Add the depreciation percentage of the asset balance to the balance itself
        $data['asset_balance'] = number_format($fixed_asset_bal + ($fixed_asset_bal * $fixed_asset_depr / 100), 2);
        

        $fixed_amount = $this->pro_model->FetchFixedPurchases($asset->cfs_account_id);

        $asset_det = '';

        $asset_det .= '<tr>
                                <td> 1 </td>
                                <td><input type="text" name="dfs_description" value="' . $asset->cfs_description . '" class="form-control"  readonly></td>
                                <td><input type="text" name="dfs_acquired_date" value="' . $asset->cfs_acquired_date . '" class="form-control"  readonly></td>
                                <td><input type="text" name="dfs_asset_amount" value="' . format_currency($fixed_amount) . '" class="form-control add_asset_amt rt-inp"  readonly></td>
                                <td><input type="text" name="dfs_depreciation" value="' . preg_replace('/[^0-9.]/', '', $asset->cfs_depreciation) . '%" class="form-control rt-inp"  readonly></td>
                                <td><input type="text" name="dfs_sales_price" value="" class="form-control add_sale_price rt-inp dec-inp" autocomplete="off" ></td>
                                <td><input type="text" name="dfs_profit" value="" class="form-control add_profit rt-inp"  readonly></td>
                            </tr>';



        $data['total_Sec'] ='<tbody>
            <tr>             
                <td align="right" class="total_label amount_in_words_add">Total</td>
                <input type="hidden" id="total_amount_val" name="total_receipt_amount" val="">
                <td  id="total_amount" class="rt-inp"><input type="text" name="" class="edit_total_prod form-control text-end rt-inp" readonly value=""></td>
            </tr>      
        </tbody>';

        // $asset_det .= '<tr>
        //     <td colspan="1"></td>
        //     <td colspan="2" align="left" class="amount_in_words_add"></td>
        //     <td align="right" colspan="3">Total</td>
        //     <input type="hidden" id="total_amount_val" val="">
        //     <th id="total_amount"></th>
        // </tr>';
        

        // Set fixed_asset key in the response data
        $data['asset_det'] = $asset_det;


        // Return the data as a JSON response
        echo json_encode($data);
    }



    public function Date()
    {
        $date = $this->request->getPost('Date');

        $your_date = strtotime("1 day", strtotime($date));

        $data['increment_date_date'] = date("d-M-Y", $your_date);

        echo json_encode($data);
    }





    public function FetchReference()
    {

        $uid = $this->common_model->FetchNextId('pro_purchase_return', "PR");

        echo $uid;
    }


    public function FetchProduct()
    {

        $purchase_return = $this->common_model->SingleRow('pro_purchase_voucher', array('pv_id' => $this->request->getPost('ID')));

        /*$joins = array(
            
            array(
                'table' => 'crm_products',
                'pk'    => 'product_id',
                'fk'    => 'pop_prod_desc',
            ),
           

        );*/

        //$products = $this->common_model->FetchWhereJoin('pro_purchase_order_product',array('pop_purchase_order' => $purchase_order->po_id),$joins);

        $products = $this->common_model->FetchWhere('pro_purchase_voucher_prod', array('pvp_reffer_id' => $purchase_return->pv_id));


        $i = 1;

        $data['product_detail'] = "";

        foreach ($products as $prod) {

            $data['product_detail'] .= '<tr class="" id="' . $prod->pvp_id . '">
                                            
                                            <td class="si_no">' . $i . '</td>
                                            <td><input type="text" name="" value="' . $prod->pvp_prod_dec . '" class="form-control"  readonly></td>
                                            <td><input type="number" name="" value="' . $prod->pvp_qty . '"  class="form-control order_qty" readonly></td>
                                            <td><input type="checkbox" name="" id="' . $prod->pvp_id . '"  onclick="handleCheckboxChange(this)" class="prod_checkmark"></td>
                                          
                                        </tr>';
            $i++;
        }

        echo json_encode($data);
    }



    public function FetchInvoice()
    {
        $purchase_id  = $this->request->getPost('ID');

        $purchase_return = $this->common_model->SingleRow('pro_purchase_return', array('pr_id' => $purchase_id));

        $purchase_return->pr_vendor_name;
    }


    public function View()
    {
        $cond = array('dfs_id' => $this->request->getPost('ID'));

        $data['assetdisposed'] = $this->common_model->SingleRow('pro_dispose_fixed_asset', $cond);

        echo json_encode($data);
    }




    public function Edit()
    {
        
        $data['msg'] = "";

        $data['status'] ="";

        $adminId = session('admin_id'); 

        $segment1 = service('uri')->getSegment(1);

        $segment2 = service('uri')->getSegment(2);

        $check_module = $this->common_model->CheckModule($adminId,$segment1,$segment2);

        if($check_module->up_edit == 0){
           
            $data['msg'] = "Access Denied: You do not have permission for this Action";
        
            $data['status'] = 0;

            echo json_encode($data);

            exit();

        }
        
        
        $cond = array('dfs_id' => $this->request->getPost('ID'));

        $data['assetdisposed'] = $this->common_model->SingleRow('pro_dispose_fixed_asset', $cond);

    

        echo json_encode($data);
    }




    public function Update()
    {
        $cfs_id = $this->request->getPost('dfs_id');

        $cond = array('dfs_id' => $this->request->getPost('dfs_id'));

        $update_data['dfs_date_dispose'] = date('Y-m-d', strtotime($this->request->getPost('dfs_date_dispose')));
        $update_data['dfs_acquired_date'] = date('Y-m-d', strtotime($this->request->getPost('dfs_acquired_date')));

        $update_data = $this->request->getPost();


        // Check if the 'account_id' key exists before unsetting it
        if (array_key_exists('dfs_id', $update_data)) {
            unset($update_data['dfs_id']);
        }

        $update_data['dfs_acquired_date'] =  date('Y-m-d', strtotime($this->request->getPost('dfs_acquired_date')));


         $this->common_model->EditData($update_data, $cond, 'pro_dispose_fixed_asset');



    }



    public function Delete()
    {
        $adminId = session('admin_id');

        $segment1 = service('uri')->getSegment(1);

        $segment2 = service('uri')->getSegment(2);

        $check_module = $this->common_model->CheckModule($adminId,$segment1,$segment2);

        if(!empty($check_module) && isset($check_module->up_delete) && $check_module->up_delete == 0){

           $data['status'] = 0;
           
           $data['msg'] ="Access Denied: You do not have permission for this Action";

           echo json_encode($data);

           exit();
        }

        $id = $this->request->getPost('ID');

        // Fetch the disposal record to check for JV
        $dispose_record = $this->common_model->SingleRow('pro_dispose_fixed_asset', ['dfs_id' => $id]);

        if ($dispose_record && !empty($dispose_record->dfs_jv_id)) {
            // Check if the JV actually exists in the database
            $jv_exists = $this->common_model->SingleRow('accounts_journal_vouchers', ['jv_voucher_no' => $dispose_record->dfs_jv_id]);

            if ($jv_exists) {
                $data['status'] = 0;
                $data['msg'] = "Please delete {$dispose_record->dfs_jv_id} to remove!";
                echo json_encode($data);
                exit();
            }
        }

        $this->common_model->DeleteData('pro_dispose_fixed_asset', array('dfs_id' => $id));

        $data['status'] = 1;

        $data['msg'] = "Data Deleted Successfully";

        echo json_encode($data);
        exit();
    }


    public function AddAccess(){
        
        $data['status'] = "";

        $data['msg'] ="";

        $adminId = session('admin_id'); 

        $segment1 = service('uri')->getSegment(1);

        $segment2 = service('uri')->getSegment(2);

        $check_module = $this->common_model->CheckModule($adminId,$segment1,$segment2);

        if($check_module->up_add == 0){
           
            $data['status'] = 0 ;

            $data['msg'] ="Access Denied: You do not have permission for this Action";
 

        }
        

        echo json_encode($data); 
    }
}
