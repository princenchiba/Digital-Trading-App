<?php
namespace App\Modules\Settings\Controllers;

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
use App\Models\Common_model;
use App\Modules\Settings\Models\Settings_model;
use App\Libraries\UploadImage;
use App\Libraries\Sms_lib;
class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['form', 'url','lang',];
	protected $db;
	protected $validation;
	protected $settings_model;
	protected $email;
	protected $pager;
	protected $imageupload;
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
		$this->session 		  	= \Config\Services::session();
		$this->validation 		= \Config\Services::validation();
		$this->pager 			= \Config\Services::pager();
		$this->template   		= new Template(); 
		$this->common_model     = new Common_model(); 
		$this->Settings_model 	= new Settings_model();
		$this->sms_lib   		= new Sms_lib(); 
		$this->imageupload      = new UploadImage();
		$this->db 				= db_connect();
		$this->dbforge 		  	= \Config\Database::forge();
	}
}
