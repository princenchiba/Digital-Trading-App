<?php
namespace App\Modules\Backend\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;
use App\Libraries\Template;
use App\Libraries\Sms_lib;
use App\Models\M_crud;
use App\Modules\Backend\Models\AuthModel;
use App\Modules\Backend\Models\UserModel;
use App\Modules\Backend\Models\Permission_model;
use App\Modules\Backend\Models\Language_model;
use App\Modules\Backend\Models\Phrase_model;
use App\Modules\Backend\Models\Dashboard_model;
class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['form', 'url','lang', 'captcha'];
	protected $db;
	protected $validation;
	protected $dashboard_model;
	protected $email;
	protected $sms_lib;
   
	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		$this->session 		  	 = \Config\Services::session();
		$this->validation 		 = \Config\Services::validation();
		$this->sms_lib   		 = new Sms_lib(); 
		$this->template   		 = new Template(); 
		$this->M_crud     		 = new M_crud(); 
		$this->userModel  		 = new UserModel();
		$this->auth_model 		 = new AuthModel(); 
		$this->permission_model  = new Permission_model();
		$this->language_model 	 = new Language_model();
		$this->phrase_Model      = new Phrase_model();
		$this->dashboard_model   = new Dashboard_model();
		$this->db 				 = db_connect();
	}
}
