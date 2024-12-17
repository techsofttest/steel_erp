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
                'dfs_sale_price'    => $record->dfs_sales_price,
                'dfs_profit'    => $record->dfs_profit,
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
        $insert_data = $this->request->getPost();



        $insert_data['dfs_date_dispose'] = date('Y-m-d', strtotime($this->request->getPost('dfs_date_dispose')));
        $insert_data['dfs_acquired_date'] = date('Y-m-d', strtotime($this->request->getPost('dfs_acquired_date')));

        $id = $this->common_model->InsertData('pro_dispose_fixed_asset', $insert_data);


        // $coa_data['ca_name'] = $this->request->getPost('cfs_description');

        // $coa_data['ca_account_type'] = $this->request->getPost('cfs_account_head');

        // $coa_data['ca_customer'] = $id;

        // $coa_data['ca_account_id'] = $this->request->getPost('cfs_account_id');

        // $coa_data['ca_type'] = "FIXED_ASSET";

        // $this->common_model->InsertData('accounts_charts_of_accounts',$coa_data);

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
                                <td><input type="text" name="dfs_asset_amount" value="' . $fixed_amount . '" class="form-control add_asset_amt"  readonly></td>
                                <td><input type="text" name="dfs_depreciation" value="' . preg_replace('/[^0-9.]/', '', $asset->cfs_depreciation) . '%" class="form-control"  readonly></td>
                                <td><input type="number" name="dfs_sales_price" value="" class="form-control add_sale_price"  ></td>
                                <td><input type="text" name="dfs_profit" value="" class="form-control add_profit"  readonly></td>
                            </tr>';


        $asset_det .= '<tr>
            <td colspan="1"></td>
            <td colspan="2" align="left" class="amount_in_words_add"></td>
            <td align="right" colspan="3">Total</td>
            <input type="hidden" id="total_amount_val" val="">
            <th id="total_amount"></th>
        </tr>';

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


        $this->common_model->DeleteData('pro_dispose_fixed_asset', array('dfs_id' => $this->request->getPost('ID')));

       // $this->common_model->DeleteData('accounts_charts_of_accounts', array('ca_customer' => $this->request->getPost('ID')));
    }
}
