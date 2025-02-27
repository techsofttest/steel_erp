<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;


/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{

    


    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['form','number','currency'];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * Constructor.
     */

    /* Common Model */
    public $common_model;

    public $report_model;

    public $crm_modal;

    public $pro_model;

    public $session;

    public $data;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        $this->account_model = new \App\Models\AccountsModel();

        $this->report_model = new \App\Models\ReportModel();

        $this->common_model = new \App\Models\CommonModel();

        $this->crm_modal  = new \App\Models\CrmReportModel();

        $this->pro_model = new \App\Models\ProcurementModel();

        $this->validation = \Config\Services::validation();

        $this->request = \Config\Services::request();

        $this->session = \Config\Services::session();

        $this->ap_model = new \App\Models\AccountPeriodModel();

        $this->data['accounting_year'] = $this->ap_model->CheckCurrentPeriod()->ap_year; 

        $this->data['accounting_month'] = $this->ap_model->CheckCurrentPeriod()->ap_month; 

        $adminId = session('admin_id'); // Retrieves 'admin_name' from the session

        // Fetch the  data and make it available to all views

        $joins = array(
            
            array(
                'table' => 'steel_permission',
                'pk'    => 'per_id ',
                'fk'    => 'up_permission',
            ),

        );

        
        $this->data['permissions'] = $this->common_model->FetchWhereJoin('user_permission',array('up_user_id' => $adminId),$joins); 

        $this->data['countryies'] = $this->common_model->FetchAllOrder('master_country','country_id','desc');

        // Share the data globally
        \Config\Services::renderer()->setData($this->data);



    }


   





}
