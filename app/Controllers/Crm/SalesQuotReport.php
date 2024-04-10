<?php

namespace App\Controllers\Crm;

use App\Controllers\BaseController;


class SalesQuotReport extends BaseController
{
    
    



    //view page
    public function index()
    {   
        $data['customer_creation'] = $this->common_model->FetchAllOrder('crm_customer_creation','cc_id','desc');

        $data['sales_executive'] = $this->common_model->FetchAllOrder('executives_sales_executive','se_id','desc');
        
        $data['content'] = view('crm/sales-quot_report',$data);

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
                'fk'    => 'qd_customer',
            ),
           

        );
      
        $data['result'] = $this->common_model->ReportFetchLimit('crm_quotation_details','qd_customer','asc',$term,$start,$end,$joins,'qd_customer');
    
        $data['total_count'] =count($data['result']);

        return json_encode($data);

    }


    //fetch executive by customer
    public function FetchData()
    {
        //fetch executive
        $cond = array('qd_customer'=>$this->request->getPost('ID'));

        $joins = array(
            array(
                'table' => 'executives_sales_executive',
                'pk'    => 'se_id',
                'fk'    => 'qd_sales_executive',
            ),
           

        );


        $quotation_details = $this->common_model->FetchWhereUniqueJoin('crm_quotation_details',$cond,$joins,'se_id');
       

        $data['quot_det'] = "<option value='' selected disabled>Select Sales Executive</option>"; 

        foreach($quotation_details as $quot_det)
        {
            $data['quot_det'] .='<option value='.$quot_det->se_id.'>'.$quot_det->se_name.'</option>';
            
        }

        //fetch product

        $product_data = $this->common_model->FetchProductByCustomer('crm_quotation_details',$this->request->getPost('ID'));
        
        $data['quot_prod'] = "<option value='' selected>Select Product</option>";
        $uniqueProductIds = []; // Array to store unique product IDs


        

        foreach ($product_data as $prod_data) {
            // Check if product_details array is not empty
            if (!empty($prod_data->product_details)) {
                foreach ($prod_data->product_details as $product_detail) {
                    // Check if the product ID is not already processed
                    if (!in_array($product_detail->product_id, $uniqueProductIds)) {
                        // Add the product ID to the array of unique IDs
                        $uniqueProductIds[] = $product_detail->product_id;
                        // Add the option for this product to the dropdown
                        $option_value = $product_detail->product_id;
                        $option_text = $product_detail->product_details;
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
        $from_date       = date('Y-m-d',strtotime($this->request->getPost('form_date')));

        $to_date         = date('Y-m-d',strtotime($this->request->getPost('to_date')));

        $customer        = trim($this->request->getPost('customer'));

        $sales_executive = trim($this->request->getPost('sales_executive'));

        $product         = trim($this->request->getPost('product'));


        $joins = array(
            
            array(
                'table' => 'crm_quotation_product_details',
                'pk'    => 'qpd_quotation_details',
                'fk'    => 'qd_id ',
            ),
           /* array(
                'table' => 'crm_customer_creation',
                'pk'    => 'cc_id',
                'fk'    => 'qd_customer',
            ),*/
           

        );

       
        $single_quots = $this->common_model->CheckDate($from_date,'qd_date',$to_date,'',$customer,'qd_customer',$sales_executive,'qd_sales_executive',$product,'qpd_product_description','','','crm_quotation_details',$joins,'qd_reffer_no');
        
        $data['product_data'] =""; 

        if(!empty($single_quots))
        {

            $data['status'] ="true";

            $i=1;
            foreach($single_quots as $single_quot)
            {   
                
                $data['product_data'] .='<tr>
                <td>'.$i.'</td>
                <td>'.$single_quot->qd_reffer_no.'</td>
                <td>'.$single_quot->qd_date.'</td>
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


    public function pdf()
    {

    }








}
