<?php

namespace App\Controllers;

use App\Controllers\BaseController;
//use CodeIgniter\HTTP\RequestInterface;
//use CodeIgniter\HTTP\ResponseInterface;
//use Psr\Log\LoggerInterface;

class Companies extends BaseController
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

        $this->dash_model = new \App\Models\DashboardModel();

        $data['companies'] = $this->common_model->FetchAll('master_companies');

        print_r($data['companies']);

        exit;

        return view('index',$data);

    }



   



}
