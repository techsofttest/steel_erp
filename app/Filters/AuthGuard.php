<?php 
namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthGuard implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {

        // Logic to be executed before the controller runs
       
        // Check if the user is not logged in
         
       
        if (session()->get('admin_login')!=true) 
        {
          
            /*$session_data = session()->get('admin_login');
            print_r($session_data);
            exit();*/
            //echo "login";
            
            //echo "login"; exit();

            return redirect()->to('Login'); // Adjust the path as needed

        }
        else
        {
            $this->common_model = model('App\Models\CommonModel'); // Replace 'CommonModel' with the actual model name

            $adminId = session('admin_id'); // Retrieves 'admin_name' from the session

       
            // Fetch the  data and make it available to all views

            $joins = array(
                array(
                    'table' => 'steel_permission',
                    'pk'    => 'per_id ',
                    'fk'    => 'up_permission',
                ),

            );

            $permissions_data = $this->common_model->FetchWhereJoin('user_permission',array('up_user_id' => $adminId),$joins); 
            
            

            $permissionsArray = array_map(function($permission) {
                return $permission->per_module;
            }, $permissions_data);

            // Get the current URI segment
            $segment = service('uri')->getSegment(1);

            // Check if the user has permission to access the "Accounts" module
            if ($segment == "Accounts" && !in_array('Accounts', $permissionsArray)) {
                
                session()->setFlashdata('error', 'Access Denied: You do not have permission to access this page.');
            
                return redirect()->to(base_url());  
            }


            if ($segment == "Crm" && !in_array('Crm', $permissionsArray)) {
                
                session()->setFlashdata('error', 'Access Denied: You do not have permission to access this page.');
            
                return redirect()->to(base_url());  
            }


            if ($segment == "Procurement" && !in_array('Procurement', $permissionsArray)) {
                
                session()->setFlashdata('error', 'Access Denied: You do not have permission to access this page.');
            
                return redirect()->to(base_url());  
            }


            if ($segment == "HR" && !in_array('HR', $permissionsArray)) {
                
                session()->setFlashdata('error', 'Access Denied: You do not have permission to access this page.');
            
                return redirect()->to(base_url());  
            }
            
           
            

        }

      


    }

    
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        
    }
}

?>