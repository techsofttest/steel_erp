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
            //
        }

      


    }

    
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        
    }
}

?>