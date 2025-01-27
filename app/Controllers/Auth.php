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
        
        $attempt = $this->session->get('attempt') ?? 0;

        // Get the lock time and current time
        $lockTime = $this->session->get('lock_time');
        $currentTime = time();

        // Check if lock period has expired (5 minutes = 300 seconds)
        if ($lockTime && ($currentTime - $lockTime) >= 300) {
            // Reset attempts and lock time after 5 minutes
            $this->session->remove('attempt');
            $this->session->remove('lock_time');
            $attempt = 0; // Reset local variable as well
        }

        // Check if input is still locked
        if ($lockTime && ($currentTime - $lockTime) < 300) {
            $remainingTime = 300 - ($currentTime - $lockTime); // Calculate remaining lock time
            $this->session->setFlashdata('error', 'Too many failed attempts. Please try again later.');
            return redirect()->to('Login');
        }

       
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
                

                // Increment the attempt counter
                $attempt++;
                $this->session->set('attempt', $attempt);

                // Check if attempts exceed 5
                if ($attempt >= 5) {

                    // Set lock time if not already set
                    if (!$lockTime) {
                        $this->session->set('lock_time', $currentTime); // Store current timestamp
                    }

                    // Set flash message and redirect
                    $this->session->setFlashdata('error', 'Too many failed attempts. Please try again later.');
                    return redirect()->to('Login');

                }

                // Set flash error message for incorrect login
                $this->session->setFlashdata('error', 'Incorrect username/password');
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
