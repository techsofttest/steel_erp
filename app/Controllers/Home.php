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
        return view('index');
    }



   



}
