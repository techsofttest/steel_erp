<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use Config\Database;

class Auth extends BaseController
{


    public function index()
    {

        if (session()->get('admin_login')==true) 
        {

         return redirect()->to('Home');

        }
        
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
                    'admin_name'    => $user->first_name." ".$user->last_name,
                    'admin_username'=> $user->user_name,
                    'admin_id'      => $user->user_id,
                    'admin_role'    => $user->user_role,
                    'admin_company' => $user->user_company,
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
            'admin_company',
            'admin_login',
            'admin_name'
        ];

        $this->session->remove($admin_data);
      
        $this->session->setFlashdata('error','Logged Out');

        return redirect()->to('Login');
        

    }





    protected function changeDatabase($dbName)
    {
        // Check if the database name is valid
        $dbConfig = config('Database');
        $dbConfig->default['database'] = $dbName;
        $db = Database::connect($dbConfig->default);
        return $db;

    }











}

?>
