<?php
namespace App\Modules\Addon\Controllers;

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
use App\Modules\Addon\Models\Themes_model;
use App\Modules\Addon\Models\Addons_model;
use App\Modules\Addon\Models\Module_model;
use App\Modules\Addon\Libraries\Unzip;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['form', 'url','lang_helper'];
   
	/**
	 * Constructor.
	 */
    protected $imagelibrary;
    protected $sms_lib;
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
                
        //Calling Libraries
        $this->session = \Config\Services::session();
        $this->parser = \Config\Services::parser();
        $this->db = db_connect();
        $this->validation     =  \Config\Services::validation();
		$this->uri = service('uri','<?php echo base_url(); ?>');
        $this->agent = $this->request->getUserAgent();
        //calling Model
        $this->template         = new Template(); 
        $this->themes_model     = new Themes_model(); 
        $this->addons_model     = new Addons_model();
        $this->module_model     = new Module_model();
        $this->unzip            = new Unzip();

	}

}
