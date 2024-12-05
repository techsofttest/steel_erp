<?php

namespace App\Controllers;

use App\Controllers\BaseController;
//use CodeIgniter\HTTP\RequestInterface;
//use CodeIgniter\HTTP\ResponseInterface;
//use Psr\Log\LoggerInterface;

class Home extends BaseController
{

    public function __construct()
    {
        $this->checkSession();

        // Check if the user is not logged in
        if (!session()->get('admin_login')) {
            // Redirect to the login page if not logged in
            return redirect()->to('Login');
        }

    }

    protected function checkSession()
    {
        if (!session()->get('loggedIn')) {
            return redirect()->to('/login');
        }
        
    }


    


    public function index()
    {

        $this->ap_model = new \App\Models\AccountPeriodModel();

        if((!empty($_GET['action'])) && ($_GET['action']=="save"))
        {

        $new_year = $this->request->getGet('ac_year');

        $new_month = $this->request->getGet('ac_month');

        //Check if year is less
        $current_period = $this->ap_model->CheckCurrentPeriod();

        //If exists check if accounting period is greater
        if(!empty($current_period->ap_year))
        {

        if($new_year<$current_period->ap_year)
        {

        $this->session->setFlashdata('error','Cannot set year prior to current accounting period');
        return redirect()->to('Home');
        exit;
        
        }

        if($new_month<$current_period->ap_month)
        {
            
        $this->session->setFlashdata('error','Cannot set year prior to current accounting period');
        return redirect()->to('Home');
        exit;

        }


        }

        $update_year['ap_year'] = $new_year;
        $update_year['ap_month'] = $new_month;
        $update_year['ap_update_date'] = date('Y-m-d');

        $this->common_model->EditData($update_year,array('ap_id' => 1),'master_accounting_period');

        $this->session->setFlashdata('success','Accounting period changed!');

        return redirect()->to('Home');
        
        }
        

        if( (!empty($_GET['action'])) && ($_GET['action']=="search"))
        {

        $year = $_GET['ac_year'];

        $month = $_GET['ac_month'];

        // Ensure the month is a two-digit format
        if (strlen($month) < 2) {
            $month = '0' . $month;
        }

        // Create the start and end dates for the specified month and year
        $month_date_from = date("Y-m-01", strtotime("$year-$month-01"));
        $month_date_to = date("Y-m-t", strtotime("$year-$month-01"));

        // Create the start and end dates for the specified year
        $year_date_from = date("Y-01-01", strtotime("$year-01-01"));
        $year_date_to = date("Y-m-t", strtotime("$year-$month-01"));

        }

        else
        {

            $today = date('Y-m-d');

            $month_date_from = date("Y-m-01", strtotime($today));
    
            $month_date_to = date("Y-m-t", strtotime($today));
    
            
            $year_date_from = date("Y-01-01", strtotime($today));
    
            $year_date_to = date("Y-12-t", strtotime($today));

        }

  
        $this->dash_model = new \App\Models\DashboardModel();

        $data['products']=$this->common_model->FetchAllOrderLimit('crm_products','product_id','desc',5,0);

        $data['customers']=$this->common_model->FetchAllOrderLimit('crm_customer_creation','cc_id','desc',5,0);



        $data['sales_orders_month'] = $this->dash_model->SumWhereDates('crm_sales_orders','so_amount_total',array(),'so_date',$month_date_from,$month_date_to);

        $data['sales_orders_year'] = $this->dash_model->SumWhereDates('crm_sales_orders','so_amount_total',array(),'so_date',$year_date_from,$year_date_to);


        $delivery_month_total = $this->dash_model->SumWhereDates('crm_delivery_note','dn_total_amount',array(),'dn_date',$month_date_from,$month_date_to);

        $cash_month_total = $this->dash_model->SumWhereDates('crm_cash_invoice','ci_total_amount',array(),'ci_date',$month_date_from,$month_date_to);

        $data['delivery_month'] = $delivery_month_total+$cash_month_total;


        $delivery_year_total = $this->dash_model->SumWhereDates('crm_delivery_note','dn_total_amount',array(),'dn_date',$year_date_from,$year_date_to);

        $cash_year_total = $this->dash_model->SumWhereDates('crm_cash_invoice','ci_total_amount',array(),'ci_date',$year_date_from,$year_date_to);

        $data['delivery_year'] = $delivery_year_total+$cash_year_total;


        $data['sales_month'] = $this->dash_model->InvoiceTotals($month_date_from,$month_date_to);

        $data['sales_year'] = $this->dash_model->InvoiceTotals($year_date_from,$year_date_to);


        $data['customers_count'] = $this->common_model->CountWhere('crm_customer_creation',array());

        $data['enquiry_count'] = $this->common_model->CountWhere('crm_enquiry',array());


        //FetchAllOrderLimit($table,$order_key,$order,$end,$start)

       // $data['pfa_quotations'] = $this->common_model->FetchAllOrderLimit('crm_quotation_details','qd_id','desc',5,0);


       $data['pfa_quotations'] = $this->dash_model->PFAQuotation();

       $data['pfa_delivery'] = $this->dash_model->PFADelivery();

       //$data['pfa_delivery'] = array();

       $data['pfa_delivery_due'] = $this->dash_model->PFADeliveryDue();

        return view('index',$data);

    }





    public function LockAP()
    {
        

    }





    public function ChangePassword()
    {



    }



   



}
