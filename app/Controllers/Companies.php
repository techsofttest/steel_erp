<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Companies extends BaseController
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




    


    public function index()
    {


        $joins = array(

            array(
                'table' => 'master_companies',
                'pk'  => 'comp_id',
                'fk'  => 'user_company',
            )

        );

        $data['companies'] = $this->common_model->FetchWhereJoin('users',array(),$joins);

        return view('companies',$data);

    }


    public function View()
    {


        if($this->request->getPost())
        {

           $id = $this->request->getPost('id');

           $cond = array('comp_id' => $id);

           $data['company'] = $this->common_model->SingleRow('master_companies',$cond);

           $partners = $this->common_model->FetchWhereJoin('master_company_partners',array('part_company' => $id),array());

           

           $data['partners']="";

           foreach($partners as $partner)
           {

            $data['partners'].= "

            <tr>

            <td>{$partner->part_name}</td>
            
            <td>{$partner->part_nationality}</td>

            <td><a href='".base_url()."public/uploads/Companies/{$partner->part_qid}' data-lightbox='image'><img style='object-fit:contain;height:100px;width:100px;' src='".base_url()."public/uploads/Companies/{$partner->part_qid}'></a></td>
            
            <td><a href='".base_url()."public/uploads/Companies/{$partner->part_signature}' data-lightbox='image'><img style='object-fit:contain;height:100px;width:100px;' src='".base_url()."public/uploads/Companies/{$partner->part_signature}'></a></td>


            </tr>

            ";

           }

           echo json_encode($data);

        }


    }


    public function Edit()
    {

        if($this->request->getPost())
        {

           $id = $this->request->getPost('id');                                                                                 

           $cond = array('comp_id' => $id);

           $data['company'] = $this->common_model->SingleRow('master_companies',$cond);

           $partners = $this->common_model->FetchWhereJoin('master_company_partners',array('part_company' => $id),array());


           $data['partners']="";

           foreach($partners as $partner)
           {

            $data['partners'].= "

            <tr>

            <td>{$partner->part_name}</td>
            
            <td>{$partner->part_nationality}</td>

            <td><img style='object-fit:contain;height:100px;width:100px;' src='".base_url()."public/uploads/Companies/{$partner->part_qid}'></td>
            
            <td><img style='object-fit:contain;height:100px;width:100px;' src='".base_url()."public/uploads/Companies/{$partner->part_signature}'></td>

            <td>
            
            <a onclick=\"return confirm('Delete this partner?');\" href='javascript:void(0);' data-id='{$partner->part_id}' class='btn btn-danger delete_partner'>Delete</a>

            </td>

            
            </tr>

            ";

           }

           echo json_encode($data);

        }
    

    }



    public function Update()
    {


        if($this->request->getPost())
        {


        $id = $this->request->getPost('company_id');

        $cond = array('comp_id' => $id);

        $update_data['comp_name'] = $this->request->getPost('comp_name');

        $update_data['comp_cr_no'] = $this->request->getPost('comp_cr_no');

        $update_data['comp_trade_licence_number'] = $this->request->getPost('comp_trade_licence_number');

        $update_data['comp_est_id'] = $this->request->getPost('comp_est_id');

        $update_data['comp_tax_card_no'] = $this->request->getPost('comp_tax_card_no');

        $update_data['comp_paid_up_cap'] = $this->request->getPost('comp_paid_up_cap');

        $update_data['comp_city'] = $this->request->getPost('comp_city');

        $update_data['comp_country'] = $this->request->getPost('comp_country');


        $this->common_model->EditData($update_data,$cond,'master_companies');
        
        

        for($i=0;$i<count($this->request->getPost('part_name'));$i++)
        {

        if(!empty($this->request->getPost('part_name')[$i]))
        {

        $part_data['part_name'] = $this->request->getPost('part_name')[$i];

        $part_data['part_nationality'] = $this->request->getPost('part_nationality')[$i];

        $part_data['part_company'] = $id;

        if ($_FILES['part_qid']['name'][$i] !== '') {

            $rand		=	rand();

			$fPath 		=	'partnerid'.$rand.'_'.$_FILES['part_qid']['name'][$i];

            $tmp_name 	= 	$_FILES['part_qid']['tmp_name'][$i];

            $part_data['part_qid'] = $fPath;
      
            move_uploaded_file($tmp_name,"uploads/Companies/".$fPath);

        }

        if ($_FILES['part_signature']['name'][$i] !== '') {

            $rand		=	rand();

			$sPath 		=	'signature'.$rand.'_'.$_FILES['part_signature']['name'][$i];

            $tmp_name 	= 	$_FILES['part_signature']['tmp_name'][$i];

            $part_data['part_signature'] = $sPath;
      
            move_uploaded_file($tmp_name,"uploads/Companies/".$sPath);

        }
        
        $this->common_model->InsertData('master_company_partners',$part_data);

        }

    }

        }


    }


    public function DeletePartner()
    {


        if($_POST)
        {

        $id = $this->request->getPost('id');


        $this->common_model->DeleteData('master_company_partners',array('part_id' => $id));



        }





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



        // Function to handle file upload
        public function uploadFile($fieldName, $uploadPath)
        {
            $file = $this->request->getFile($fieldName);

            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move($uploadPath, $newName);
                return $newName;
            }
    
            return null;
        }

   



}
