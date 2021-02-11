<?php namespace App\Modules\Website\Controllers;

class Ajaxload extends BaseController 
{
	
/*
|---------------------------------
|   Fees Load and deposit amount 
|---------------------------------
*/
    public function fees_load()
    {   
        $amount      = $this->request->getPost('amount', FILTER_SANITIZE_STRING); 
        $level       = $this->request->getPost('level', FILTER_SANITIZE_STRING); 
        $crypto_coin = $this->request->getPost('crypto_coin', FILTER_SANITIZE_STRING); 

        $result = $this->common_model->findById('dbt_fees', array('level' => $level, 'currency_symbol' => $crypto_coin));

        $fees = ($amount/100)*(float)@$result->fees;
        $new_amount = (float)@$amount-(float)@$fees;
        echo json_encode(array('fees'=> @$fees,'amount'=> @$new_amount));    
    }

/*
|---------------------------------
|   check reciver user Id
|---------------------------------
*/
    public function checke_reciver_id()
    {   
        $receiver_id = $this->request->getPost('receiver_id'); 
        $result = $this->common_model->findById('dbt_user', array('user_id' => $receiver_id));
        if(!empty($result)){
           echo '1';
        }
    }

/*
|---------------------------------
|   check reciver user Id
|---------------------------------
*/
    public function walletid()
    {   
        $method      = $this->request->getPost('method', FILTER_SANITIZE_STRING); 
        $user_id     = $this->session->get('user_id'); 
        $crypto_coin = $this->request->getPost('crypto_coin', FILTER_SANITIZE_STRING); 
        $result = $this->common_model->findById('dbt_payout_method', array('method' => $method, 'currency_symbol' => $crypto_coin, 'user_id' => $user_id));
        echo json_encode($result);
    }
}
