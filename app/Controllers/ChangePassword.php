<?php

namespace App\Controllers;

use App\Controllers\BaseController;
//use CodeIgniter\HTTP\RequestInterface;
//use CodeIgniter\HTTP\ResponseInterface;
//use Psr\Log\LoggerInterface;

class ChangePassword extends BaseController
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
        
        $data=array();

        if($this->request->getPost())
        {

        $username = session()->get('admin_username');

        $password = sha1($this->request->getPost('old_pass'));

        $user = $this->common_model->GetProfile($username,$password);

        if(!empty($user))
        {

        $admin_id = session()->get('admin_id');

        $new_pass = sha1($this->request->getPost('new_pass'));

        $update_data['user_password'] = $new_pass;

        $update_cond['user_id'] = $admin_id;

        $this->common_model->EditData($update_data,$update_cond,'users');

        //' $data['status'] = 1;

        // $data['msg'] = "Password change successful!";

        $this->session->setFlashdata('success','Password change successful');

        return redirect()->to('ChangePassword');

        }

        else
        {

        $this->session->setFlashdata('error','Password incorrect');

        return redirect()->to('ChangePassword');

        // $data['status'] = 0;

        // $data['msg'] = "Password is incorrect!";

        }

        echo json_encode($data);
        
        }

        

        return view('change_password',$data);

    }



}
