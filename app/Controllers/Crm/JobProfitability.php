<?php

namespace App\Controllers\Crm;

use App\Controllers\BaseController;


class JobProfitability extends BaseController
{
    
    



    //view page
    public function index()
    {   
        $data['customer_creation'] = $this->common_model->FetchAllOrder('crm_customer_creation','cc_id','desc');

        $data['sales_executive'] = $this->common_model->FetchAllOrder('executives_sales_executive','se_id','desc');
        
        $data['content'] = view('crm/job_profitability',$data);

        return view('crm/report-module',$data);

    }


    //customer droupdrown
    /*public function FetchTypes()
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
                'fk'    => 'so_customer',
            ),
           

        );
        
        $data['result'] = $this->common_model->ReportFetchLimit('crm_sales_orders','so_customer','asc',$term,$start,$end,$joins);
 
        $data['total_count'] =count($data['result']);

        return json_encode($data);

    }*/

    public function FetchTypes()
    {

        $page= !empty($_GET['page']) ? $_GET['page'] : 0;
        $term = !empty($_GET['term']) ? $_GET['term'] : "";
        $resultCount = 10;
        $end = ($page - 1) * $resultCount;       
        $start = $end + $resultCount;

        $joins = array(
            /*array(
                'table' => 'crm_customer_creation',
                'pk'    => 'cc_id',
                'fk'    => 'so_customer',
            ),*/
           

        );
      
        $data['result'] = $this->common_model->ReportFetchLimit('crm_customer_creation','cc_id','asc',$term,$start,$end,$joins,'cc_customer_name');
    
        $data['total_count'] =count($data['result']);

        return json_encode($data);

    }



    




    //fetch executive by customer
    public function FetchData()
    {    
        //fetch sales order
        $cond = array('so_customer'=>$this->request->getPost('ID'));

        $joins1 = array();


        $sales_refference = $this->common_model->FetchWhereUniqueJoin('crm_sales_orders',$cond,$joins1,'so_reffer_no');
        
        $data['sales_reff'] = '<option value="" selected disabled>Select Order Ref</option>';

        foreach($sales_refference as $sales_reff)
        {
            $data['sales_reff'] .='<option value='.$sales_reff->so_id.'>'.$sales_reff->so_reffer_no.'</option>';
            
        }

        //fetch executive
       
        $joins = array(
            array(
                'table' => 'executives_sales_executive',
                'pk'    => 'se_id',
                'fk'    => 'so_sales_executive',
            ),
           

        );


        $quotation_details = $this->common_model->FetchWhereUniqueJoin('crm_sales_orders',$cond,$joins,'so_sales_executive');
       

        $data['quot_det'] = "<option value='' selected disabled>Select Sales Executive</option>"; 

        foreach($quotation_details as $quot_det)
        {
            $data['quot_det'] .='<option value='.$quot_det->se_id.'>'.$quot_det->se_name.'</option>';
            
        }


        //fetch product

        $product_data = $this->common_model->FetchSalesProdByCustomer('crm_sales_orders',$this->request->getPost('ID'));
        
        $data['quot_prod'] = "<option value='' selected> Select Product</option>";
        $uniqueProductIds = []; // Array to store unique product IDs

        foreach ($product_data as $prod_data) {
            // Check if product_details array is not empty
            if (!empty($prod_data->sales_prod_details)) {
                foreach ($prod_data->sales_prod_details as $sales_prod_det) {
                    // Check if the product ID is not already processed
                    if (!in_array($sales_prod_det->product_id, $uniqueProductIds)) {
                        // Add the product ID to the array of unique IDs
                        $uniqueProductIds[] = $sales_prod_det->product_id;
                        // Add the option for this product to the dropdown
                        $option_value = $sales_prod_det->product_id;
                        $option_text = $sales_prod_det->product_details;
                        $data['quot_prod'] .= '<option value="' . $option_value . '">' . $option_text . '</option>';
                    }
                }
            } else {
                $data['quot_prod'] .= '<option value="">No Product Details Available</option>';
            }
        }



        echo json_encode($data);

    }


    //fetch data
    public function GetData()
    {    
        if(!empty($_GET["form_date"]))
        {
            $from_date = $_GET["form_date"];
        }
        else
        {
            $from_date = "";
        }

        if(!empty($_GET["to_date"]))
        {
            $to_date = $_GET["to_date"];
        }
        else
        {
            $to_date = "";
        }

        if(!empty($_GET["customer"]))
        {
            $data1 = $_GET["customer"];
        }
        else
        {
            $data1 = "";
        }

        if(!empty($_GET["sales_order"]))
        {
            $data2 = $_GET["sales_order"];
        }
        else
        {
            $data2 = "";
        }


        if(!empty($_GET["sales_executive"]))
        {
            $data3 = $_GET["sales_executive"];
        }
        else
        {
            $data3 = "";
        }


        $joins = array(
            array(
                'table' => 'crm_customer_creation',
                'pk'    => 'cc_id',
                'fk'    => 'so_customer',
            ),
            array(
                'table' => 'executives_sales_executive',
                'pk'    => 'se_id',
                'fk'    => 'so_sales_executive',
            ),
        );

      
       
        $data['sales_orders'] = $this->crm_modal->job_profitability($from_date,'so_date',$to_date,'',$data1,'so_customer',$data2,'so_reffer_no',$data3,'so_sales_executive','','','crm_sales_orders',$joins,'so_reffer_no');  
        
        if(!empty($from_date))
        {
            $data['from_dates'] = date('d-M-Y',strtotime($from_date));
        }
        else
        {
            $data['from_dates'] ="";
        } 
        

        if(!empty($to_date))
        {
            $data['to_dates'] = date('d-M-Y',strtotime($to_date));
        }
        else
        {
            $data['to_dates'] = "";
        }
        
        $data['content'] = view('crm/job_profitability',$data);
 
        return view('crm/report-module-search',$data);
      
    }




}
