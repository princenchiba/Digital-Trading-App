<?php namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\M_crud;
use App\Views;

class Adapter extends BaseController {

	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger){
        parent::initController($request, $response, $logger);
        $security 	 = \Config\Services::security();
       $this->response;
    }

	public function javascript()
	{

		$this->response->setStatusCode(200);
		$this->response->setContentType('Content-type: application/x-javascript', 'charset=utf8');
		$this->response->setHeader('Access-Controll-Allow-Headers', '*');
		$this->response->setHeader('Access-Controll-Allow-Methods', 'GET, POST, OPTIONS, PUT, DELETE');

		$data['settings'] = $this->M_crud->findById('setting', array('setting_id'=>1));

		$market_symbol = $this->request->getVar('market');
		if(!empty($market_symbol)){
			$symbol = $market_symbol;
		} else {
			$symbol = "LTC_BTC";
		}
		$data['market_details'] = $this->M_crud->findById("dbt_coinpair", array('status' => 1, "symbol" => $symbol));

		$data['fee_to']         = $this->M_crud->findById('dbt_fees', array('level' => "BUY", "currency_symbol" => @$data['market_details']->market_symbol));
		$data['fee_from']       = $this->M_crud->findById('dbt_fees', array('level' => "SELL", "currency_symbol" => @$data['market_details']->market_symbol));
		$coin    = $this->M_crud->get_all('dbt_cryptocoin', array('show_home' => 1), 'coin_position', 'asc');
	
		
		$coin_stream="";
        foreach ($coin as $coin_key => $coin_value) {
            $coin_stream .= "5~CCCAGG~".$coin_value->symbol."~USD,";
        }
        $data['coin_stream'] = rtrim($coin_stream, ',');
        $data['get_csrf_hash'] = csrf_hash();
        $data['csrf_token'] = csrf_token();

        $data['gateway'] = $this->M_crud->findById('payment_gateway', array('identity' => "phone", 'status' => 1));
        $gateway_bank = $this->M_crud->findById('payment_gateway', array('identity' => "bank", 'status' => 1));
		
		
		if(!empty($gateway_bank)){
		    $data['gateway_bank'] = $gateway_bank->public_key;
		}
	
		$sql = "SELECT REPLACE(english, \"'\", ' ') as english, REPLACE(french, \"'\", ' ') as french, phrase FROM language";
		
		$test1 = $this->db->query($sql, [])->getResult();

		$newarray = [];
        foreach ($test1 as $key => $value) {
            $newarray = array_merge($newarray,array($value->phrase => $value));
        }

		$data['language'] = json_encode($newarray);

		$theme   	   =  $this->M_crud->findById("dbt_theme", array('status' => 1));
		$data['theme'] = $theme->settings;

		$cryptoconfig 		= $this->M_crud->findById('external_api_setup', array('id'=>3));
        $apiData  			= json_decode($cryptoconfig->data);
        $data['crypto_key'] = $apiData->api_key;

		echo view('javascript',$data);
	}	
	public function css()
	{
		$this->response->setStatusCode(200);
		$this->response->setContentType('text/css');
		$this->response->setHeader('Access-Controll-Allow-Headers', '*');
		$this->response->setHeader('Access-Controll-Allow-Methods', 'GET, POST, OPTIONS, PUT, DELETE');
		
		$theme   	   = $this->M_crud->findById('dbt_theme', array('status' => 1));
		$data['theme'] = json_decode($theme->settings);

		echo view('view_css',$data);
	}
}