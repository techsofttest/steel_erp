<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Auth extends BaseController
{


    public function index()
    {
      
        return view('login');
    }
	
	
	public function Check()
	{   
       
		if($this->request->getMethod() === 'post')
        {
            
            $validate = $this->validate([
                'user_name' => 'required',
                'password' => 'required'
            ]);

            if(!$validate)
            {

                $this->session->setFlashdata('error','Please enter username & password');

                return redirect()->to('Login');

            }
            
            $username = $this->request->getPost('user_name');

            $password = sha1($this->request->getPost('password'));

            $user = $this->common_model->GetProfile($username,$password);

            if($user)
            {
                
                $admin_data = [
                    'admin_username'=> $user->user_name,
                    'admin_id'      => $user->user_id,
                    'admin_role'    => $user->user_role,
                    'admin_login'   => true,
                ];
                
                $this->session->set($admin_data);

                return redirect()->to('Home');
                
            }

            else
            {

                $this->session->setFlashdata('error','Incorrect username/password');

                return redirect()->to('Login');

            }



        }
		
		
	}



    public function Logout()
    {

        $admin_data = [
            'admin_username',
            'admin_id',
            'admin_role',
            'admin_login',
        ];

        $this->session->remove($admin_data);
      
        $this->session->setFlashdata('error','Logged Out');

        return redirect()->to('Login');
        
    }



}

?>
