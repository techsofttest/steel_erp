<?php

namespace App\Controllers\Accounts;

use App\Controllers\BaseController;


class AccountHead extends BaseController
{

    
    public function index()
    {   
        $data['accounts_type'] = $this->common_model->FetchAll('accounts_account_type');

        $data['account_head'] = $this->common_model->FetchAllOrder('accounts_account_type','at_id','DESC');

        return view('accounts-module',$data);
    }



    Public function Add()
    {   
        
        if ($this->request->getMethod() === 'post') 
        {
            $insert_data = [
                
                'at_name'       => $this->request->getPost('aname'),

                'at_added_by'   => 0,

                'at_added_date' => date('Y-m-d'),


            ];

            $id = $this->common_model->InsertData('accounts_account_type',$insert_data);

            $accounts_type = $this->common_model->FetchAll('accounts_account_type');
            $i=1; 
            foreach($accounts_type as $account_type){

            $data['output'] =  '<tr><td> echo "'.$i.'"</td>
                        <td>echo "'.$account_type->at_name.'" </td>
                        <td><a  href="" class="edit edit-color" data-toggle="tooltip" data-placement="top" title="edit" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a>
                            <a href="" class="delete delete-color" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm("Are you absolutely sure you want to delete?");"><i  class="ri-delete-bin-fill"></i> Delete</a>
                            <a  href="#" data-bs-toggle="modal" data-bs-target="#ViewModal" class="view view-color" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="ri-eye-2-line"></i> View</a>
                            
                        </td></tr>';
                       
          
            }

            echo json_encode($data);

        }
    }




}
