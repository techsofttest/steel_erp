<?php

namespace App\Controllers\Crm;

use App\Controllers\BaseController;


class SalesSummery extends BaseController
{
    
    



    //view page
    public function index()
    {   
        
        $data['sales_executive'] = $this->common_model->FetchAllOrder('executives_sales_executive','se_id','desc');
        
        $data['content'] = view('crm/sales-summery',$data);

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
            /*array(
                'table' => 'crm_customer_creation',
                'pk'    => 'cc_id',
                'fk'    => 'cci_customer',
            ),*/
           

        );
      
        //$data['result'] = $this->common_model->ReportFetchLimit('crm_credit_invoice','cci_customer','asc',$term,$start,$end,$joins,'cci_customer');
        
        $data['result'] = $this->common_model->ReportFetchLimit('crm_customer_creation','cc_id','asc',$term,$start,$end,$joins,'cc_customer_name');
       
        $data['total_count'] =count($data['result']);

        return json_encode($data);

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
            $data1 = $_GET['customer'];
        }
        else
        {
            $data1 = "";
        }


        if(!empty($_GET['sales_executive']))
        {
            $data2 = $_GET['sales_executive'];
        }
        else
        {
            $data2 = "";
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

        
        //$data['delivery_data'] = $this->crm_modal->sales_summery($from_date,'dn_date',$to_date,'',$data1,'dn_customer','','','','','','','crm_delivery_note',$joins,'dn_reffer_no');
        
        $data['sales_data'] = $this->crm_modal->sales_summery($from_date,'so_date',$to_date,'',$data1,'so_customer',$data2,'so_sales_executive','','','','','crm_sales_orders',$joins,'so_reffer_no');
        

        $data['sales_executive'] = $this->common_model->FetchAllOrder('executives_sales_executive','se_id','desc');
        
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
        
        $data['content'] = view('crm/sales-summery',$data);
        
        return view('crm/report-module-search',$data);
      
      
    }




}
