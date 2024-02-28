<?php

namespace App\Controllers\Crm;

use App\Controllers\BaseController;


class InvoiceReport extends BaseController
{
    
    



    //view page
    public function index()
    {   
        $data['customer_creation'] = $this->common_model->FetchAllOrder('crm_customer_creation','cc_id','desc');

        $data['sales_executive'] = $this->common_model->FetchAllOrder('executives_sales_executive','se_id','desc');
        
        $data['content'] = view('crm/invoice_report',$data);

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
                'fk'    => 'cci_customer',
            ),
           

        );
      
        $data['result'] = $this->common_model->ReportFetchLimit('crm_credit_invoice','cci_customer','asc',$term,$start,$end,$joins,'cci_customer');
    
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

        //fetch delivery note ref

        /*$joins1 =  array();

        $delivery_notes = $this->common_model->FetchWhereUniqueJoin('crm_delivery_note',$cond,$joins1,'dn_reffer_no');
        
        $data['delivier_note'] ='<option value="" selected disabled>Select Delivery Note</option>';

        foreach($delivery_notes as $delivery_note)
        {
            $data['delivier_note'] .='<option value='.$delivery_note->dn_id.'>'.$delivery_note->dn_reffer_no.'</option>';
            
        }*/

        
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
            else 
            {
                $data['credit_prod'] .= '<option value="">No Product Details Available</option>';
            }
        }



        echo json_encode($data);

    }


    //fetch data
    public function GetData()
    {
        $from_date       = date('Y-m-d',strtotime($this->request->getPost('form_date')));

        $to_date         = date('Y-m-d',strtotime($this->request->getPost('to_date')));

        $customer        = trim($this->request->getPost('customer_clz'));

        $sales_order    = trim($this->request->getPost('sales_order'));

        $product        = trim($this->request->getPost('product'));

       
        $joins = array(
            array(
                'table' => 'crm_credit_invoice_prod_det',
                'pk'    => 'ipd_credit_invoice',
                'fk'    => 'cci_id',
            ),
           

        );

      
        $invoice_report = $this->common_model->CheckDate($from_date,'cci_date',$to_date,'',$customer,'cci_customer','','',$product,'ipd_prod_detl',$sales_order,'cci_sales_order','crm_credit_invoice',$joins);
        
       

        $data['product_data'] =""; 

       if(!empty($invoice_report)){

            $data['status'] ="true";

            
            
            $i=1;
            foreach($invoice_report as $inv_report)
            {   
                
                $data['product_data'] .='<tr>
                <td>'.$i.'</td>
                <td>'.$inv_report->cci_reffer_no.'</td>
                <td>'.$inv_report->cci_date.'</td>
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
