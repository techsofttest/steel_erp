<?php

namespace App\Controllers\Crm;

use App\Controllers\BaseController;


class SalesReturnReport extends BaseController
{
    
    



    //view page
    public function index()
    {   
        $data['products'] = $this->common_model->FetchAllOrder('crm_products','product_id','desc');

        $data['sales_orders'] = $this->common_model->FetchAllOrder('crm_sales_orders','so_id','desc');
        
        $data['content'] = view('crm/sales_return_report',$data);

        return view('crm/report-module',$data);

    }


    //customer droupdrown
    public function FetchTypes()
    {

        $page= !empty($_GET['page']) ? $_GET['page'] : 0;
        $term = !empty($_GET['term']) ? $_GET['term'] : "";
        $resultCount = 10;
        $end = ($page - 1) * $resultCount;       
        $start = $end + $resultCount;

        $joins = array(
            array(
                'table' => 'crm_customer_creation',
                'pk'    => 'cc_id',
                'fk'    => 'sr_customer',
            ),
           

        );
      
        $data['result'] = $this->common_model->ReportFetchLimit('crm_sales_return','sr_customer','asc',$term,$start,$end,$joins,'sr_customer');
    
        $data['total_count'] =count($data['result']);

        return json_encode($data);

    }



    


    //fetch executive by customer
    public function FetchData()
    {    
        //fetch sales order
        $cond = array('cci_customer'=>$this->request->getPost('ID'));

        $joins = array(

            array(
                'table' => 'crm_sales_orders',
                'pk'    => 'so_id',
                'fk'    => 'cci_sales_order',
            ),
        );


        $sales_refference = $this->common_model->FetchWhereUniqueJoin('crm_credit_invoice',$cond,$joins,'cci_sales_order');
        
        $data['sales_reff'] = '<option value="" selected disabled>Select Order Ref</option>';

        foreach($sales_refference as $sales_reff)
        {
            $data['sales_reff'] .='<option value='.$sales_reff->so_id.'>'.$sales_reff->so_reffer_no.'</option>';
            
        }

        

        
        //fetch product

        $product_data = $this->common_model->FetchCreditProdByCustomer('crm_credit_invoice',$this->request->getPost('ID'));
        
        $data['credit_prod'] = "<option value='' selected> Select Product</option>";
        $uniqueProductIds = []; // Array to store unique product IDs

        foreach ($product_data as $prod_data) {
            // Check if product_details array is not empty
            if (!empty($prod_data->credit_prod_details)) {
                foreach ($prod_data->credit_prod_details as $credit_prod_det) {
                    // Check if the product ID is not already processed
                    if (!in_array($credit_prod_det->product_id, $uniqueProductIds)) {
                        // Add the product ID to the array of unique IDs
                        $uniqueProductIds[] = $credit_prod_det->product_id;
                        // Add the option for this product to the dropdown
                        $option_value = $credit_prod_det->product_id;
                        $option_text = $credit_prod_det->product_details;
                        $data['credit_prod'] .= '<option value="' . $option_value . '">' . $option_text . '</option>';
                    }
                }
            } 
            /*else 
            {
                $data['credit_prod'] .= '<option value="">No Product Details Available</option>';
            }*/
        }



        echo json_encode($data);

    }


    //fetch data
    public function GetData()
    {
       
        if(!empty($_GET['form_date']))
        {
            $from_date = $_GET['form_date'];
        }
        else
        {
            $from_date = "";
        }

        if(!empty($_GET['to_date']))
        {
            $to_date = $_GET['to_date'];
        }
        else
        {
            $to_date = "";
        }

        if(!empty($_GET['customer']))
        {
            $customer = $_GET['customer'];
        }
        else
        {
            $customer = "";
        }

        if(!empty($_GET['sales_order']))
        {
            $sales_order = $_GET['sales_order'];
        }
        else
        {
            $sales_order = "";
        }

        if(!empty($_GET['product']))
        {
            $product = $_GET['product'];
        }
        else
        {
            $product = "";
        }

        
        $data['invoice_reports'] = $this->crm_modal->return_report($from_date,'sr_date',$to_date,'',$customer,'sr_customer',$sales_order,'sr_sales_order',$product,'srp_prod_det');  
        
        $data['products'] = $this->common_model->FetchAllOrder('crm_products','product_id','desc');

        $data['sales_orders'] = $this->common_model->FetchAllOrder('crm_sales_orders','so_id','desc');

        $data['content'] = view('crm/sales_return_report',$data);

        return view('crm/report-module-search',$data);


        echo json_encode($data);
       
      
    }





}
