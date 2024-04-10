<?php

namespace App\Controllers\Crm;

use App\Controllers\BaseController;


class SalesOrderToDn extends BaseController
{
    
    



    //view page
    public function index()
    {   
        $data['customer_creation'] = $this->common_model->FetchAllOrder('crm_customer_creation','cc_id','desc');

        $data['sales_executive'] = $this->common_model->FetchAllOrder('executives_sales_executive','se_id','desc');
        
        $data['content'] = view('crm/sales-order_to_dn',$data);

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
            array(
                'table' => 'crm_customer_creation',
                'pk'    => 'cc_id',
                'fk'    => 'so_customer',
            ),
           

        );
      
        $data['result'] = $this->common_model->ReportFetchLimit('crm_sales_orders','so_customer','asc',$term,$start,$end,$joins,'so_customer');
    
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
        /*$from_date       = date('Y-m-d',strtotime($this->request->getPost('form_date')));

        $to_date         = date('Y-m-d',strtotime($this->request->getPost('to_date')));

        $customer        = trim($this->request->getPost('customer'));

        $sales_order     = trim($this->request->getPost('sales_order'));

        $sales_executive = trim($this->request->getPost('sales_executive'));

        $product         = trim($this->request->getPost('product'));

       
        $joins = array(
            array(
                'table' => 'crm_sales_product_details',
                'pk'    => 'spd_sales_order',
                'fk'    => 'dn_id',
            ),
           

        );

      
        $sales_order = $this->common_model->CheckDate($from_date,'dn_id',$to_date,'',$customer,'dn_customer',$sales_executive,'so_sales_executive',$product,'spd_product_details',$sales_order,'so_reffer_no','crm_sales_orders',$joins);
        
       

        $data['product_data'] =""; 

        if(!empty($sales_order))
        {

            $data['status'] ="true";

            $i=1;
            foreach($sales_order as $sales)
            {   
                
                $data['product_data'] .='<tr>
                <td>'.$i.'</td>
                <td>'.$sales->so_reffer_no.'</td>
                <td>'.$sales->so_date.'</td>
                <td>
                    <a href="javascript:void(0)" class="report_icon report_icon_excel"   data-toggle="tooltip" data-placement="top" title="edit"  data-original-title="Edit"><i class="ri-file-excel-fill"></i>Excel</a>
                    <a href="javascript:void(0)" class="report_icon report_icon_pdf" data-toggle="tooltip" data-placement="top" title="Delete"><i class="ri-file-pdf-fill"></i>Pdf</a>
                    <a href="javascript:void(0)" class="report_icon report_icon_mail" data-toggle="tooltip" data-placement="top" title="Delete"><i class="ri-mail-open-fill"></i>Email</a>
                                
                </td>
                </tr>';
                $i++; 

            }
        }
        else
        {
            $data['status'] ="False";
        }

        echo json_encode($data);*/

        $from_date       = date('Y-m-d',strtotime($this->request->getPost('form_date')));

        $to_date         = date('Y-m-d',strtotime($this->request->getPost('to_date')));

        $customer        = trim($this->request->getPost('customer'));

        $sales_executive = trim($this->request->getPost('sales_executive'));

        $product         = trim($this->request->getPost('product'));

        $sales_order     = trim($this->request->getPost('sales_order'));

       
        $joins = array(
            array(
                'table' => 'crm_sales_product_details',
                'pk'    => 'spd_sales_order',
                'fk'    => 'so_id',
            ),
           

        );

      
        $sales_order = $this->common_model->CheckDate($from_date,'so_date',$to_date,'',$customer,'	so_customer',$sales_executive,'so_sales_executive',$product,'spd_product_details',$sales_order,'so_reffer_no','crm_sales_orders',$joins,'so_reffer_no');
        
       

        $data['product_data'] =""; 

       if(!empty($sales_order)){

            $data['status'] ="true";

            
            
            $i=1;
            foreach($sales_order as $sales)
            {   
                
                $data['product_data'] .='<tr>
                <td>'.$i.'</td>
                <td>'.$sales->so_reffer_no.'</td>
                <td>'.$sales->so_date.'</td>
                <td>
                    <a href="javascript:void(0)" class="report_icon report_icon_excel"   data-toggle="tooltip" data-placement="top" title="edit"  data-original-title="Edit"><i class="ri-file-excel-fill"></i>Excel</a>
                    <a href="javascript:void(0)" class="report_icon report_icon_pdf" data-toggle="tooltip" data-placement="top" title="Delete"><i class="ri-file-pdf-fill"></i>Pdf</a>
                    <a href="javascript:void(0)" class="report_icon report_icon_mail" data-toggle="tooltip" data-placement="top" title="Delete"><i class="ri-mail-open-fill"></i>Email</a>
                </td>
                </tr>';
                $i++; 
            }
        }
        else
        {
            $data['status'] ="False";
        }

        echo json_encode($data);
      
    }








}
