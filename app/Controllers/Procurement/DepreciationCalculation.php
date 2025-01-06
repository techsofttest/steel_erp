<?php

namespace App\Controllers\Procurement;

use App\Controllers\BaseController;


class DepreciationCalculation extends BaseController
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

        $totalRecords = $this->common_model->GetTotalRecords('pro_depreciation_calculation', 'dpc_id', 'DESC');


        ## Total number of records with filtering

        $searchColumns = array('dpc_account_head');

        $totalRecordwithFilter = $this->common_model->GetTotalRecordwithFilter('pro_depreciation_calculation', 'dpc_id', $searchValue, $searchColumns);

        ##Joins if any //Pass Joins as Multi dim array
        $joins = array(
            array(
                'table' => 'accounts_account_heads',
                'pk'    => 'ah_id',
                'fk'    => 'dpc_account_head',
            ),

        );
        ## Fetch records
        $records = $this->common_model->GetRecord('pro_depreciation_calculation', 'dpc_id', $searchValue, $searchColumns, $columnName, $columnSortOrder, $joins, $rowperpage, $start);

        $data = array();

        $i = 1;
        foreach ($records as $record) {
            $action = '<a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="' . $record->dpc_id . '"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> Delete</a><a  href="javascript:void(0)" data-id="' . $record->dpc_id . '"  class="view view-color view_btn" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a>';

            // <a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="' . $record->dpc_id . '" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a>

            $data[] = array(
                "dpc_id"               => $i,
                'dpc_account_head'     => $record->ah_account_name,
                'dpc_acquired_date'    => date('d-M-Y', strtotime($record->dpc_acquired_date)),
                'dpc_amount'           => $record->dpc_amount,
                'dpc_depreciation'     => $record->dpc_depreciation,
                "action"               => $action,
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

        $data['content'] = view('procurement/depreciation_calculation', $data);

        return view('procurement/pro-module', $data);
    }


    // add account head
    public function Add()
    {
        $insert_data = [
            'dpc_acquired_date' => date('Y-m-d', strtotime($this->request->getPost('dpc_acquired_date'))),
            'dpc_account_head' => $this->request->getPost('dpc_account_head'),
            'dpc_debit_account' => $this->request->getPost('dpc_debit_account'),
            'dpc_credit_account' => $this->request->getPost('dpc_credit_account'),
            'dpc_amount' => $this->request->getPost('dpc_amount'),
            'dpc_depreciation' => $this->request->getPost('dpc_depreciation'),
        ];

        // Insert main data
        $id = $this->common_model->InsertData('pro_depreciation_calculation', $insert_data);

        // Insert detailed data
        for ($i = 0; $i < count($this->request->getPost('dpcd_acquired_date')); $i++) {
            $det_data = [
                'dpcd_acquired_date' => date('Y-m-d', strtotime($this->request->getPost('dpcd_acquired_date')[$i])),
                'dpcd_depreciation_id' => $id,
                'dpcd_asset_id' => $this->request->getPost('dpcd_asset_id')[$i],
                'dpcd_description' => $this->request->getPost('dpcd_description')[$i],
                'dpcd_amount' => $this->request->getPost('dpcd_amount')[$i],
                'dpcd_depreciation' => $this->request->getPost('dpcd_depreciation')[$i],
                'dpcd_entitlement' => $this->request->getPost('dpcd_entitlement')[$i],
                'dpcd_depreciation_amt' => $this->request->getPost('dpcd_depreciation_amt')[$i],
            ];

            $this->common_model->InsertData('pro_depreciation_det', $det_data);
        }

        // Return the inserted ID as a response
        return $this->response->setJSON(['status' => 'success', 'id' => $id]);
    }



    public function Date()
    {

        $acchead = $this->request->getPost('AccountHead');

        // Define condition for query
        $cond = ['cfs_account_head' => $acchead];

        // Joins array for fetching related data
        $joins = array(
            array(
                'table' => 'accounts_account_heads',
                'pk'    => 'ah_id',
                'fk'    => 'cfs_account_head',
            )
        );

        // Fetch the fixed asset data
        $data['fixedasset'] = $this->common_model->SingleRowJoin('pro_create_fixed_asset', $cond, $joins);

        // Fetch account head related charts of accounts
        // $chartsofacc = $this->common_model->FetchWhere('accounts_charts_of_accounts', ['ca_account_type' => $acchead]);

        // Calculate account head balance
        $acchead_balance = 0;

        $credit_balance = $this->pro_model->CreditBalance($data['fixedasset']->cfs_credit_account);

        $acchead_balance = $credit_balance->ending_balance;


        $data['acchead_balance'] = $acchead_balance;


        $cond = ['cfs_account_head' => $acchead];
        // Fetching fixed assets with the same condition
        $assets = $this->pro_model->FetchWhereOrder('pro_create_fixed_asset', $cond, 'cfs_id', 'desc');

        // Prepare the HTML for fixed assets rows
        $fixed_asset = '';
        $j = 1; // Start row count from 1

        $total_amt = 0;

        $sel_date = $this->request->getPost('Date'); // Assuming 'Date' is in 'Y-m-d' format

        foreach ($assets as $asset) {

            $fixed_amount = $this->pro_model->FetchFixedPurchases($asset->cfs_account_id) ?? 0;

            $fixed_amount = (float)$fixed_amount;
            $cfs_last_yr_depreciation = (float)$asset->cfs_last_yr_depreciation;

            $fixed_amount -= $cfs_last_yr_depreciation;




            // Ensure $sel_date is in year format (extract only the year part)
            $sel_year = date('Y-m-d', strtotime($sel_date));

            // Get the acquired year and set it to January 1st of that year

            // $acq_year = date('Y', strtotime($asset->cfs_acquired_date));

            $acq_year = date('Y', strtotime($sel_date));

            $acq_date = date('Y-m-d', strtotime($acq_year . '-01-01')); // January 1st of the acquired year

            // Calculate the difference in days between the two dates
            $diff_in_days = (strtotime($sel_date) - strtotime($acq_date)) / (60 * 60 * 24);

            // Output the difference in days
            $entitlement = $diff_in_days + 1;


            $acchead_balance = isset($fixed_amount) ? $fixed_amount : 0;

            $depreciation_percent = preg_replace('/[^0-9.]/', '', $asset->cfs_depreciation); // Remove non-numeric characters
            $depreciation = floatval($depreciation_percent) / 100; // Convert to float

            $depreciation_amount = round(floatval(($acchead_balance * $depreciation * $entitlement) / 365), 2);

            $total_amt += $depreciation_amount;

            $fixed_asset .= '<tr>
                                <td>' . $j . '</td>
                                 <input type="hidden" name="dpcd_asset_id[]" value="' . $asset->cfs_id . '" class="form-control"  readonly>
                                <td><input type="text" name="dpcd_description[]" value="' . $asset->cfs_description . '" class="form-control"  readonly></td>
                                <td><input type="text" name="dpcd_acquired_date[]" value="' . $asset->cfs_acquired_date . '" class="form-control"  readonly></td>
                                <td><input type="text" name="dpcd_amount[]" value="' . $fixed_amount . '" class="form-control"  readonly></td>
                                <td><input type="text" name="dpcd_depreciation[]" value="' . $depreciation_percent . '%" class="form-control"  readonly></td>
                                <td><input type="text" name="dpcd_entitlement[]" value="' . $entitlement . '" class="form-control"  readonly></td>
                                <td><input type="text" name="dpcd_depreciation_amt[]" value="' . $depreciation_amount . '" class="form-control"  readonly></td>
                            </tr>';
            $j++; // Increment row count
        }

        $fixed_asset .= '<tr>
            <td colspan="1"></td>
            <td colspan="2" align="left" class="amount_in_words_add"></td>
            <td align="right" colspan="3">Total</td>
            <input type="hidden" id="total_amount_val" name="total_receipt_amount" val="">
            <th id="total_amount"> ' . format_currency($total_amt) . '</th>
        </tr>';

        // Set fixed_asset key in the response data
        $data['fixed_asset'] = $fixed_asset;

        // exit;

        // Return the data as a JSON response
        echo json_encode($data);
    }



    public function FetchPurchase()
    {

        //purchase voucher

        $material_received_note = $this->common_model->SingleRow('pro_material_received_note', array('mrn_id' => $this->request->getPost('ID')));

        $purchase = $material_received_note->mrn_purchase_order;

        $data['delivery_note'] = $material_received_note->mrn_delivery_note;

        $data['payment_term'] = $material_received_note->mrn_payment_term;

        $purchase_data = $this->common_model->SingleRow('pro_purchase_order', array('po_id' => $purchase));

        $data['purchase_order'] = $purchase_data->po_reffer_no;



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


    public function SelectedProduct()
    {
        // Clean up received ID parameter
        $select_id = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $this->request->getPost('ID'));

        // Split cleaned ID parameter into an array of individual IDs
        $idsArray = explode(',', $select_id);

        $data['product_detail'] = "";

        // Fetch details for each selected product ID
        $i = 1;
        foreach ($idsArray as $number) {
            $cond = array('pvp_id' => $number);

            $joins1 = array(
                array(
                    'table' => 'accounts_charts_of_accounts',
                    'pk'    => 'ca_id',
                    'fk'    => 'pvp_debit',
                ),


            );

            //$products = $this->common_model->FetchWhereJoin('pro_purchase_order_product',$cond,$joins1);

            $products = $this->common_model->FetchWhereJoin('pro_purchase_voucher_prod', $cond, $joins1);

            $debit_accounts = $this->common_model->FetchAllOrder('accounts_charts_of_accounts', 'ca_id', 'desc');


            foreach ($products as $product) {

                $data['product_detail'] .= '<tr class="add_prod_row add_prod_remove" id="' . $product->pvp_id . '">
                                            <td class="si_no">' . $i . '</td>
                                            <td><input type="text" name="prp_sales_order[]" value="' . $product->pvp_sales_order . '" class="form-control" readonly></td>
                                            <td><input type="text" name="prp_prod_desc[]" value="' . $product->pvp_prod_dec . '" class="form-control" readonly></td>
                                            <td><input type="text" name="prp_debit[]" value="' . $product->ca_name . '" class="form-control" readonly></td>
                                            <td><input type="number" name="prp_qty[]" value="' . $product->pvp_qty . '"  class="form-control add_prod_qty" readonly required></td>
                                            <td><input type="text" name="prp_unit[]" value="' . $product->pvp_unit . '" class="form-control" required readonly></td>
                                            <td><input type="text" name="prp_rate[]" value="' . $product->pvp_rate . '"  class="form-control add_prod_rate" required readonly></td>
                                            <td><input type="text" name="prp_discount[]" value="' . $product->pvp_discount . '"  class="form-control add_discount" required readonly></td>
                                            <td><input type="text" name="prp_amount[]" value="' . $product->pvp_amount . '"  class="form-control add_prod_amount" required readonly></td>
                                           
                                        </tr>';


                $i++;
            }
        }

        // Output JSON encoded data
        echo json_encode($data);
    }


    public function AddContactDetails()
    {


        if (!empty($_POST['pro_con_person'])) {
            $count =  count($_POST['pro_con_person']);

            if ($count != 0) {

                for ($j = 0; $j <= $count - 1; $j++) {

                    $insert_data      = array(

                        'pro_con_person'       =>  $_POST['pro_con_person'][$j],
                        'pro_con_designation'  =>  $_POST['pro_con_designation'][$j],
                        'pro_con_mobile'       =>  $_POST['pro_con_mobile'][$j],
                        'pro_con_email'        =>  $_POST['pro_con_email'][$j],
                        'pro_con_vendor'       =>  $_POST['new_vendor_hidden_id'],

                    );

                    $this->common_model->InsertData('pro_contact', $insert_data);
                }
            }
        }
    }


    public function FetchPayment()
    {

        $purchase_id  = $this->request->getPost('ID');

        $joins = array(

            array(
                'table' => 'pro_material_requisition',
                'pk'    => 'mr_id',
                'fk'    => 'po_mrn_reff',
            ),

        );

        $purchases = $this->common_model->SingleRowJoin('pro_purchase_order', array('po_id' => $purchase_id), $joins);

        $data['payment_term'] = $purchases->po_payment_term;

        $data['mr_reff'] = $purchases->mr_reffer_no;

        echo json_encode($data);
    }


    public function VendorInv()
    {

        $purchase_voucher = $this->pro_model->FetchWhereNotIn('pro_purchase_voucher', array('pv_vendor_name' => $this->request->getPost('ID')), 'pv_status', '2');



        $data['vendor_inv'] = "";

        $data['vendor_inv'] = '<option value="" selected disabled>Vendor Inv Ref</option>';

        foreach ($purchase_voucher as $pur_vou) {
            $data['vendor_inv'] .= '<option value=' . $pur_vou->pv_id . '';

            $data['vendor_inv'] .= '>' . $pur_vou->pv_vendor_inv . '</option>';
        }


        echo json_encode($data);
    }

    public function FetchContact()
    {
        $joins = array(

            array(

                'table' => 'pro_contact',
                'pk'    => 'pro_con_id',
                'fk'    => 'pv_contact_person',
            ),

        );

        $purchase_voucher = $this->common_model->SingleRowJoin('pro_purchase_voucher', array('pv_id' => $this->request->getPost('ID')), $joins);

        $data['contact_person'] = $purchase_voucher->pro_con_person;

        $data['payment_term']   = $purchase_voucher->pv_payment_term;


        echo json_encode($data);
    }



    // Function to handle file upload
    public function uploadFile($fieldName, $uploadPath)
    {
        $file = $this->request->getFile($fieldName);

        if ($file === null) {

            // Debugging output
            echo ('No file uploaded or incorrect field name');
        }

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move($uploadPath, $newName);
            return $newName;
        }

        return null;
    }

    public function FetchInvoice()
    {
        $purchase_id  = $this->request->getPost('ID');

        $purchase_return = $this->common_model->SingleRow('pro_purchase_return', array('pr_id' => $purchase_id));

        $purchase_return->pr_vendor_name;
    }


    public function View()
    {


        $depreciation_calc = $this->common_model->SingleRow('pro_depreciation_calculation', array('dpc_id' => $this->request->getPost('ID')));


        $data['account_head']   = $depreciation_calc->dpc_account_head;

        $data['acquired_date']  = date('d-M-Y', strtotime($depreciation_calc->dpc_acquired_date));

        $data['balance_amt']    = $depreciation_calc->dpc_amount;

        $data['debit_account']  = $depreciation_calc->dpc_debit_account;

        $data['credit_account'] = $depreciation_calc->dpc_credit_account;

        $data['depreciation'] = $depreciation_calc->dpc_depreciation;



        // Fetch account head related charts of accounts
        $depreciation_det = $this->common_model->FetchWhere('pro_depreciation_det', ['dpcd_depreciation_id' => $this->request->getPost('ID')]);

        $dep_det = '';
        $j = 1;
        $total_amt = 0;
        foreach ($depreciation_det as $det) {

            $total_amt += $det->dpcd_depreciation_amt;

            $dep_det .= '<tr>
                                 <td>' . $j . '</td>
                                 <td><input type="text" name="" value="' . $det->dpcd_description . '" class="form-control"  readonly></td>
                                 <td><input type="text" name="" value="' . $det->dpcd_acquired_date . '" class="form-control"  readonly></td>
                                 <td><input type="text" name="" value="' . $det->dpcd_amount . '" class="form-control"  readonly></td>
                                 <td><input type="text" name="" value="' . $det->dpcd_depreciation . '%" class="form-control"  readonly></td>
                                 <td><input type="text" name="" value="' . $det->dpcd_entitlement . '" class="form-control"  readonly></td>
                                 <td><input type="text" name="" value="' . $det->dpcd_depreciation_amt .  '" class="form-control"  readonly></td>
                             </tr>';

            $j++; // Increment row count
        }


        $dep_det .= '<tr>
        <td colspan="1"></td>
        <td colspan="2" align="left" class="amount_in_words_add"></td>
        <td align="right" colspan="3">Total</td>
        <input type="hidden" id="total_amount_val" name="total_receipt_amount" val="">
        <th id="total_amount"> ' . format_currency($total_amt) . '</th>
    </tr>';

        // Set fixed_asset key in the response data
        $data['depreciation_det'] = $dep_det;



        echo json_encode($data);
    }


    public function AddToJvRows()
    {

        try {
            $credit_acc = $this->common_model->SingleRow('accounts_charts_of_accounts', ['ca_id' => $this->request->getPost('cfs_credit_account')]);
            $debit_acc = $this->common_model->SingleRow('accounts_charts_of_accounts', ['ca_id' => $this->request->getPost('cfs_debit_account')]);

            if (!$credit_acc || !$debit_acc) {
                // Return an error response if either account is not found
                return $this->response->setJSON(['status' => 'error', 'message' => 'Account not found']);
            }
        } catch (\Exception $e) {
            // Log the exception for debugging
            log_message('error', 'Error in AddToJvRows: ' . $e->getMessage());

            // Return an error response
            return $this->response->setJSON(['status' => 'error', 'message' => 'An error occurred']);
        }

        $emp_journal = "";

        $dep_amount = floatval($this->request->getPost('depreciation'));
        // echo $dep_amount;
        // exit;

        //     $joins = array(

        //         array(
        //             'table' => 'hr_employees',
        //             'pk' => 'emp_id',
        //             'fk' => 'ts_emp_id',
        //             ), 

        //         array(
        //             'table' => 'hr_divisions',
        //             'pk' => 'div_id',
        //             'fk' => 'emp_division',
        //             'table2' => 'hr_employees',
        //             ), 

        //     );

        $depreciation_det = $this->common_model->FetchWhere('pro_depreciation_det', ['dpcd_depreciation_id' => $this->request->getPost('ID')]);

        //     $emp_journal ="";

        //     foreach($timesheets as $ts)
        //     {

        //         //Salary And Deductions
        //             $basic_salary=0;
        //             $total_leave=0;
        //             $total_ot=0;

        //             //Allowances
        //             $house_rent_allow=0;
        //             $transport_allow=0;
        //             $telephone_allow=0;
        //             $food_allow=0;
        //             $other_allow=0;
        //             $total_salary=0;

        //             $staff_salary=0;
        //             $salaries_wages=0;

        //             foreach($timesheets as $ts)
        //             {

        //             if($ts->emp_division==2)
        //             {
        //             //staff_salary 
        //             $staff_salary+= $ts->ts_cur_month_basic_salary;
        //             }


        //             if($ts->emp_division==1)
        //             {
        //             $salaries_wages+=$ts->ts_cur_month_basic_salary;
        //             }

        //             $ot = $ts->ts_cur_month_normal_ot+$ts->ts_cur_month_friday_ot;

        //             $leave = $ts->ts_cur_month_leave+$ts->ts_cur_month_unpaid_leave+$ts->ts_current_month_vacation;

        //             $basic_salary+=$ts->ts_cur_month_basic_salary;

        //             $total_ot+=$ot;

        //             $total_leave+=$leave;

        //             $house_rent_allow+=$ts->ts_house_rent_allowance;

        //             $transport_allow+=$ts->ts_transportation_allowance;

        //             $telephone_allow+=$ts->ts_telephone_allowance;

        //             $food_allow+=$ts->ts_food_allowance;

        //             $other_allow+=$ts->ts_other_allowance;

        //             $total_salary+=$ts->ts_cur_month_salary;

        //     }




        // }

        $data['jv_rows'] = "";

        $data['total_credit'] =  $data['total_debit'] = 0;

        $j = 1;
        foreach ($depreciation_det as $dept) {


            $data['jv_rows'] .= '

        <tr class="jv_row">
                                  <th class="sl_no"> '.$j.' </th>
                                  <th class="select2_parent" width="35%"> 
                                  <input type="text" class="form-control" name="jv_account[]" value="' . $dept->dpcd_description . '" readonly>
                                  </th>
                                  <th><input name="jv_remarks[]" type="text" class="form-control" ></th>
                                  <th><input name="jv_debit[]" type="number" step="0.01" class="form-control debit_amount" value="' . $dept->dpcd_depreciation_amt . '" readonly></th>
                                  <th><input name="jv_credit[]" type="number" class="form-control credit_amount" readonly></th>
      </tr>
      ';
      
      $data['total_debit'] += $dept->dpcd_depreciation_amt;

      $j++;
        }






        $data['jv_rows'] .= '

      <tr class="jv_row">

                                <th class="sl_no"> '. $j.' </th>

                                <th class="select2_parent" width="35%"> 
                                    
                                <input type="text" class="form-control" name="jv_account[]" value="' . $credit_acc->ca_name . '" readonly>

                                </th>
                                
                                <th><input name="jv_remarks[]" type="text" class="form-control" ></th>

                                <th><input name="jv_debit[]" type="number" step="0.01" class="form-control debit_amount"  readonly></th>

                                <th><input name="jv_credit[]" type="number" class="form-control credit_amount" value="' . $dep_amount . '" readonly></th>

    </tr>
    
    ';

    $data['total_credit'] = $dep_amount;

        $data['jv_rows'] .= '
    <tr>
        <td colspan="3" align="right">Total</td>
        <th id="total_amount_debit_disp">' . htmlspecialchars($dep_amount) . '</th>
        <th id="total_amount_credit_disp">' . htmlspecialchars($dep_amount) . '</th>
        
        <input type="hidden" id="total_amount_inp" name="total_amount" value="' . $dep_amount . '">
        <input type="hidden" id="total_amount_debit" name="total_debit" value="">
        <input type="hidden" id="total_amount_credit" name="total_credit" value="">
    </tr>
';



        //Employee Credit Journal




        $data['jv_rows'] .= $emp_journal;



        return json_encode($data);
    }



    public function Delete()
    {
        $adminId = session('admin_id');

        $segment1 = service('uri')->getSegment(1);

        $segment2 = service('uri')->getSegment(2);

        $check_module = $this->common_model->CheckModule($adminId,$segment1,$segment2);

        if($check_module->up_delete == 0){

           $data['status'] = 0;
           
           $data['msg'] ="Access Denied: You do not have permission for this Action";

           echo json_encode($data);

           exit();
        }
        
        $cond = array('dpc_id' => $this->request->getPost('ID'));

        $this->common_model->DeleteData('pro_depreciation_calculation', $cond);

        $cond = array('dpcd_depreciation_id' => $this->request->getPost('ID'));

        $this->common_model->DeleteData('pro_depreciation_det', $cond);

        $data['status'] =1;

        $data['msg'] ="Data Deleted Successfully";

        echo json_encode($data);
    }


    public function Edit()
    {

        $depreciation_calc = $this->common_model->SingleRow('pro_depreciation_calculation', array('dpc_id' => $this->request->getPost('ID')));


        $data['account_head']   = $depreciation_calc->dpc_account_head;

        $data['acquired_date']  = date('d-M-Y', strtotime($depreciation_calc->dpc_acquired_date));

        $data['balance_amt']    = $depreciation_calc->dpc_amount;

        $data['debit_account']  = $depreciation_calc->dpc_debit_account;

        $data['credit_account'] = $depreciation_calc->dpc_credit_account;

        $data['depreciation'] = $depreciation_calc->dpc_depreciation;



        // Fetch account head related charts of accounts
        $depreciation_det = $this->common_model->FetchWhere('pro_depreciation_det', ['dpcd_depreciation_id' => $this->request->getPost('ID')]);

        $dep_det = '';
        $j = 1;
        foreach ($depreciation_det as $det) {



            $dep_det .= '<tr>
                                     <td>' . $j . '</td>
                                     <td><input type="text" name="" value="' . $det->dpcd_description . '" class="form-control"  readonly></td>
                                     <td><input type="text" name="" value="' . $det->dpcd_acquired_date . '" class="form-control"  readonly></td>
                                     <td><input type="text" name="" value="' . $det->dpcd_amount . '" class="form-control"  readonly></td>
                                     <td><input type="text" name="" value="' . $det->dpcd_depreciation . '%" class="form-control"  readonly></td>
                                     <td><input type="text" name="" value="' . $det->dpcd_entitlement . '" class="form-control"  readonly></td>
                                     <td><input type="text" name="" value="' . '' . '" class="form-control"  readonly></td>
                                 </tr>';

            $j++; // Increment row count
        }


        // Set fixed_asset key in the response data
        $data['depreciation_det'] = $dep_det;

        echo json_encode($data);
    }




    public function AddJournalVoucher()
    {

       
// echo $this->request->getPost('total_debit'). ' - debit total';

// echo $this->request->getPost('total_credit'). ' - credit total';

// exit;

        //Insert Journal voucher

        $juid = $this->common_model->FetchNextId('accounts_journal_vouchers', "JV-{$this->data['accounting_year']}-");

        $insert_journal['jv_voucher_no'] = $juid;

        $insert_journal['jv_date'] = date('Y-m-d', strtotime($this->request->getPost('jv_date')));

        $insert_journal['jv_debit_total'] = $this->request->getPost('total_debit');

        $insert_journal['jv_credit_total'] = $this->request->getPost('total_credit');

        $insert_journal['jv_added_date'] = date('Y-m-d');

        $journal_id = $this->common_model->InsertData('accounts_journal_vouchers', $insert_journal);


        //Insert Journal invoices

        for ($ji = 0; $ji < count($this->request->getPost('jv_account')); $ji++) {

            $account = $this->request->getPost('jv_account')[$ji];

            $account_data = $this->common_model->SingleRow('accounts_charts_of_accounts', array('ca_name' => $account));

            $account_id = 0;

            if (!empty($account_data))
                $account_id = $account_data->ca_id;

            $debit = !empty($this->request->getPost('jv_debit')[$ji]) ? $this->request->getPost('jv_debit')[$ji] : 0;
            $credit = !empty($this->request->getPost('jv_credit')[$ji]) ? $this->request->getPost('jv_credit')[$ji] : 0;
            $narration = $this->request->getPost('jv_remarks')[$ji];

            $insert_journal_invoice['ji_voucher_id'] = $journal_id;
            //$insert_journal_invoice['ji_sales_order_id'] = ''; // Populate if needed
            $insert_journal_invoice['ji_account'] = $account_id;
            $insert_journal_invoice['ji_debit'] = $debit;
            $insert_journal_invoice['ji_credit'] = $credit;
            $insert_journal_invoice['ji_narration'] = $narration;

            $this->common_model->InsertData('accounts_journal_invoices', $insert_journal_invoice);
        }

        $return['msg'] = "Added to journal";

        $return['status'] = 1;



        echo json_encode($return);
    }
}
