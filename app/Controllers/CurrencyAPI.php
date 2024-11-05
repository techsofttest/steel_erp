<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class CurrencyAPI extends BaseController
{

    public function __construct()
    {
       
        // Check if the user is not logged in
        if (!session()->get('admin_login')) {
            // Redirect to the login page if not logged in
            return redirect()->to('Login');
        }

        if (session()->get('admin_role')!= 1) {
            // Redirect to the login page if not logged in
            return redirect()->to('Login');
        }

    }




    



    public function FormatCurrency()
    {

        $currency = $this->request->getPost('currency');

        $currency = format_currency($currency);

        echo $currency;

        exit;

    }


    public function ChangePassword()
    {

        if($this->request->getPost('user_id') != session()->get('admin_id'))

        {

        $cond = array('user_id' => $this->request->getPost('user_id'));
        
        $update_data['user_password'] = sha1($this->request->getPost('user_password')); 

        // Check if the 'account_id' key exists before unsetting it
        if (array_key_exists('user_id', $update_data)) 
        {
             unset($update_data['user_id']);
        }       

        $this->common_model->EditData($update_data,$cond,'users');

        }


    }



   



}
