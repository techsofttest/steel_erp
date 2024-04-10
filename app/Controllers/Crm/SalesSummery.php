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
        $from_date       = date('Y-m-d',strtotime($this->request->getPost('form_date')));

        $to_date         = date('Y-m-d',strtotime($this->request->getPost('to_date')));

        $customer        = trim($this->request->getPost('customer'));

        $sales_executive    = trim($this->request->getPost('sales_executive'));

        $joins = array(
          

        );

      
        $backlogs = $this->common_model->CheckDate($from_date,'so_date',$to_date,'',$customer,'so_customer',$sales_executive,'so_sales_executive','','','','','crm_sales_orders',$joins,'so_reffer_no');
        
        $data['product_data'] =""; 

       if(!empty($backlogs)){

            $data['status'] ="true";

            
            
            $i=1;
            foreach($backlogs as $backlog)
            {   
                
                $data['product_data'] .='<tr>
                <td>'.$i.'</td>
                <td>'.$backlog->so_reffer_no.'</td>
                <td>'.$backlog->so_date.'</td>
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
