<?php
namespace App\Modules\Website\Controllers;

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
use App\Libraries\Home_layout;
use App\Libraries\Sms_lib;
use App\Libraries\GoogleAuthenticator\GoogleAuthenticator;
use App\Libraries\Payment;
use App\Models\M_crud;
use App\Models\Common_model;
use App\Modules\Website\Models\Web_model;
use App\Libraries\UploadImage;
use App\Libraries\Recaptcha;
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
	protected $user_model;
	protected $email;
	protected $sms_lib;
	protected $pager;
	protected $payment;
	protected $imageupload;
	protected $ga;
	protected $recaptcha;

   
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
		$this->session 		    = \Config\Services::session();
		$this->validation 		= \Config\Services::validation();
		$this->pager 			= \Config\Services::pager();
		$this->sms_lib   		= new Sms_lib(); 
		$this->master   		= new Home_layout(); 
		$this->payment   		= new Payment(); 
		$this->M_crud     		= new M_crud(); 
		$this->common_model   	= new Common_model(); 
		$this->web_model     	= new Web_model();
		$this->imageupload      = new UploadImage();
		$this->ga       		= new GoogleAuthenticator();
		$this->recaptcha       	= new Recaptcha();
		$this->db 				= db_connect();
	}

}
