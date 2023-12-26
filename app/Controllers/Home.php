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

        $data['products']=$this->common_model->FetchAllOrderLimit('crm_products','product_id','desc',5,0);

        $data['customers']=$this->common_model->FetchAllOrderLimit('crm_customer_creation','cc_id','desc',5,0);

        $data['sales_count'] = $this->common_model->CountWhere('crm_sales_orders',array());

        $data['customers_count'] = $this->common_model->CountWhere('crm_customer_creation',array());

        $data['enquiry_count'] = $this->common_model->CountWhere('crm_enquiry',array());

        return view('index',$data);

    }



   



}
