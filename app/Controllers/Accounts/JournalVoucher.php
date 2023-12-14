<?php

namespace App\Controllers\Accounts;

use App\Controllers\BaseController;


class JournalVoucher extends BaseController
{
    




    //view page
    public function index()
    {  
        $data['accounts_type'] = $this->common_model->FetchAllOrder('accounts_account_type','at_id','desc'); 

        $data['sales_order'] = $this->common_model->FetchAllOrder('crm_sales_order','so_id','desc');

        $data['content'] = view('accounts/journal-voucher',$data);

        return view('accounts/accounts-module',$data);

        
       
    }




    // add account head
    Public function Add()
    {   
        
        $insert_data = [
            
            'jv_voucher_date'   => $this->request->getPost('jv_date'),

            'jv_sales_order_id' => $this->request->getPost('jv_order'),

            'jv_account'        => $this->request->getPost('jv_account'),

            'jv_debit'          => $this->request->getPost('jv_debit'),

            'jv_credit'         => $this->request->getPost('jv_credit'),

            'jv_narration'      => $this->request->getPost('jv_narration'),

            'jv_added_by'       => 0,

            'jv_added_date'     => date('Y-m-d'),


        ];
        helper('my_helper');
        $journal_voucher_id = $this->common_model->InsertData('accounts_journal_voucher',$insert_data);
       
        $booking_name_id = journal_voucher($journal_voucher_id,'jv');

       //$this->Admin_model->update_all(array('booking_name_id' => $booking_name_id),array('booking_id' => $booking_id),'booking');
        

        $this->common_model->EditData(array('jv_voucher_no' => $booking_name_id),array('jv_id' => $journal_voucher_id),'accounts_journal_voucher');
        
    }




    //account head modal 
    public function HeadEdit()
    {
        
        $cond = array('at_id' => $this->request->getPost('account_id'));

        $account_type = $this->common_model->SingleRow('accounts_account_type',$cond);

        $data['account_type'] = $account_type->at_name;

        echo json_encode($data);
    }



   // update account head 
    public function Update()
    {    
        $cond = array('at_id' => $this->request->getPost('account_id'));

        $update_data = [
            
            'at_name'       => $this->request->getPost('edit_aname'),

            'at_added_by'   => 0,

            'at_modify_date' => date('Y-m-d'),


        ];

        $this->common_model->EditData($update_data,$cond,'accounts_account_type');
        
        

    }



    
    //delete account head
    public function Delete()
    {
        $cond = array('at_id' => $this->request->getPost('account_id'));

        $this->common_model->DeleteData('accounts_account_type',$cond);

        
    }



}
