<?php namespace App\Modules\Website\Controllers;
	class PaymentCallbackController extends BaseController
	{

		public function bitcoin_confirm($orderid = null){

			// Bitcoin Tranction log
			$payment_type 	= $this->session->userdata('payment_type');
			$paymentID 		= $this->session->userdata('paymentID');
			$deposit      	= $this->db->select('*')->from('crypto_payments')->where('orderID', $orderid)->get()->row();

			if ($payment_type == 'deposit' && $deposit) {
				$userinfo = $this->web_model->retriveUserInfo();

				// Affilition Bonus
				$this->refferalbonus($deposit->amount,$deposit->coinLabel,$userinfo->user_id);

				$set        = $this->common_model->findById('sms_email_send_setup',array('method' => 'email'));
				$setsms     = $this->common_model->findById('sms_email_send_setup',array('method' => 'sms'));
				$appSetting = $this->common_model->findById('setting',array('setting_id' => 1));

				if($set->deposit != NULL){
				    #----------------------------
				    #      email verify smtp
				    #----------------------------

					$getPost = array(
						'amount' => $deposit->coinLabel.' '.$deposit->amount,
					);

					$config_var = array( 
                        'template_name' => 'deposit_success',
                        'template_lang' => $this->master->langSet() == 'english'?'en':'fr',
                    );
                    $message    = $this->common_model->email_msg_generate($config_var, $getPost);
                    $send_email = array(
                        'title'         => $appSetting->title,
                        'to'            => $userinfo->email,
                        'subject'       => $message['subject'],
                        'message'       => $message['message'],
                    );

                    $code_send = $this->common_model->send_email($send_email);
                }

                if($setsms->deposit != NULL){

					if($send_email){
						$n = array(
							'user_id'           => $userinfo->user_id,
							'subject'           => $message['subject'],
							'notification_type' => 'deposit',
							'details'           => $message['message'],
							'date'              => date('Y-m-d h:i:s'),
							'status'            => '0'
						);
						$this->db->insert('notifications',$n);    
					}

					$template = array( 

						'name'   => $this->session->get('fullname'),
						'amount' => $deposit->coinLabel." ".$deposit->amount,
						'date'   => date('d F Y')
					);

					$config_var = array( 
                        'template_name' => 'deposit_success',
                        'template_lang' => $this->master->langSet() == 'english'?'en':'fr',
                    );
                    $message    = $this->common_model->sms_msg_generate($config_var, $template);
                    $send_sms = array(
                        'to'        => $userinfo->phone,
                        'template'  => $message['message'],
                    );
				    #------------------------------
				    #   SMS Sending
				    #------------------------------
					if (@$userinfo->phone) {
						$send_sms = $this->sms_lib->send($send_sms);

					} else {

						$this->session->setFlashdata('exception', display('there_is_no_phone_number'));
					}

					if(@$send_sms){
						$message_data = array(
							'sender_id'   => 1,
							'receiver_id' => @$userinfo->user_id,
							'subject' 	  => $message['subject'],
							'message' 	  => $message['message'],
							'datetime' 	  => date('Y-m-d h:i:s'),
						);
						$this->db->insert('message',$message_data);    
					}
				}
				unset($_SESSION['payment_type']);
				unset($_SESSION['deposit']);

				$this->session->setFlashdata('message', display('payment_successfully'));
				return redirect()->to(base_url('/balances'));
				//here remove deposit_confirm method because it was commmented

			}elseif ($payment_type == 'buy') {
				# code...

			}elseif ($payment_type == 'sell') {
				# code...

			}else {
				# code...

			}

		}

		public function bitcoin_cancel(){

			

		}
	    //Bitcoin Callback
		public function bitcoin(){

		}

		public function payeer_confirm(){

			$request = $this->request->get();

			$payment_type = $this->session->userdata('payment_type');


			// Payeer Tranction log
			$this->payment_model->payeerPaymentLog($request);

			if ($payment_type == 'deposit') {
				$this->deposit_confirm();

			}elseif ($payment_type == 'buy') {
				# code...

			}elseif ($payment_type == 'sell') {
				# code...

			}else {
				# code...

			}

		}

		public function payeer_cancel(){

			$this->session->set_flashdata('exception', display('payment_cancel'));
			redirect(base_url());
		}

		public function paypal_confirm(){

			

			if (isset($_GET['paymentId'])) {

				
				$gateway = $this->common_model->findById('payment_gateway', array('identity' => 'PayPal', 'status' => 1));

				if ($gateway) {
					require APPPATH.'Libraries/paypal/vendor/autoload.php';

		            // After Step 1
					$apiContext = new \PayPal\Rest\ApiContext(
						new \PayPal\Auth\OAuthTokenCredential(
	                        @$gateway->public_key,     // ClientID
	                        @$gateway->private_key     // ClientSecret
	                    )
					);

		            // Step 2.1 : Between Step 2 and Step 3
					$apiContext->setConfig(
						array(
							'mode' => @$gateway->secret_key,
							'log.LogEnabled' => true,
							'log.FileName' => 'PayPal.log',
							'log.LogLevel' => 'FINE'
						)
					);

		            // Get payment object by passing paymentId
					$paymentId = $_GET['paymentId'];

					$payment = \PayPal\Api\Payment::get($paymentId, $apiContext);
					$payerId = $_GET['PayerID'];

		            // Execute payment with payer id
					$execution = new \PayPal\Api\PaymentExecution();
					$execution->setPayerId($payerId);

					try {
		              // Execute payment
						$result = $payment->execute($execution, $apiContext);

						$subtotal = $payment->transactions[0]->related_resources[0]->sale->amount->details->subtotal;


						if ($result) {
							
							$payment_type = $this->session->get('payment_type');

							if ($payment_type == 'deposit') {

								$deposit = $this->session->get('deposit');
								unset($_SESSION['deposit']);
								
								$sdata['deposit']   = (object)$userdata = array(
									'user_id'        => @$deposit->user_id,
									'currency_symbol'=> @$deposit->currency_symbol,
									'amount'         => @$subtotal - $deposit->fees_amount,
									'method_id'      => @$deposit->method_id,
									'fees_amount'    => @$deposit->fees_amount,
									'comment'        => @$deposit->comment,
									'status'         => 1,
									'deposit_date'   => @$deposit->deposit_date,
									'ip'             => @$deposit->ip,
								);

								$deposit = $this->session->set($sdata);
								
								$response = $this->deposit_confirm();
								if($response == 1){
									return redirect()->to(base_url('/balances'));
								} else if($response == 2){
									return redirect()->to(base_url('/deposit'));
								}

							}elseif ($payment_type == 'buy') {
								# code...

							}elseif ($payment_type == 'sell') {
								# code...

							}else {
								# code...

							}
						}


					} catch (PayPal\Exception\PayPalConnectionException $ex) {
						echo $ex->getCode();
						echo $ex->getData();
						die($ex);

					} catch (Exception $ex) {
						die($ex);

					}
				}

			}

		}


		public function paypal_cancel(){

			$this->session->setFlashdata('exception', "Payment Canceled/Faild");
			return redirect()->to(base_url());
		}

		private function errorAndDie($error_msg,$cp_debug_email) {

			if (!empty($cp_debug_email)) { 
				$report = 'Error: '.$error_msg."\n\n"; 
				$report .= "getPost Data\n\n"; 
				foreach ($_getPost as $k => $v) { 
					$report .= "|$k| = |$v|\n"; 
				} 
				mail($cp_debug_email, 'CoinPayments IPN Error', $report); 
			} 
			die('IPN Error: '.$error_msg);

		} 


		public function conipayment_confirm(){


			$gateway = $this->db->table('payment_gateway')->select('*')->where('identity', 'coinpayment')->where('status', 1)->get()->getRow();

			if (is_string($gateway->data) && is_array(json_decode($gateway->data, FILTER_SANITIZE_STRING)) && (json_last_error() == JSON_ERROR_NONE) ? true : false) {

				$data 			= json_decode(@$gateway->data, FILTER_SANITIZE_STRING);
				$cp_merchant_id = @$data['marcent_id'];
				$cp_ipn_secret 	= @$data['ipn_secret'];
				$debug_active	= @$data['debuging_active'];
				$debug_email 	= @$data['debug_email'];

			} else {

				$cp_merchant_id = "";
				$cp_ipn_secret 	= "";
				$debug_active	= "";
				$debug_email 	= "";
			}

			$order_currency	= $this->request->getPost("currency1");
			$amount1 		= number_format((float)($this->request->getPost("amount1")), 8, '.', '');
			$order_total 	= $amount1;

			$feesamount 	= !empty($this->request->getPost("custom"))?$this->request->getPost("custom"):0;
			$depositAmount	= $amount1-$feesamount;

			$reg = array(

				'amount1'			=>$this->request->getPost("amount1", FILTER_SANITIZE_STRING),
				'amount2'			=>$this->request->getPost("amount2", FILTER_SANITIZE_STRING),
				'buyer_name'		=>$this->request->getPost("buyer_name", FILTER_SANITIZE_STRING),
				'currency1'			=>$this->request->getPost("currency1", FILTER_SANITIZE_STRING),
				'currency2'			=>$this->request->getPost("currency2", FILTER_SANITIZE_STRING),
				'fee'				=>$this->request->getPost("fee", FILTER_SANITIZE_STRING),
				'ipn_id'			=>$this->request->getPost("ipn_id", FILTER_SANITIZE_STRING),
				'ipn_mode'			=>$this->request->getPost("ipn_mode", FILTER_SANITIZE_STRING),
				'ipn_type'			=>$this->request->getPost("ipn_type", FILTER_SANITIZE_STRING),
				'ipn_version'		=>$this->request->getPost("ipn_version", FILTER_SANITIZE_STRING),
				'merchant'			=>$this->request->getPost("merchant", FILTER_SANITIZE_STRING),
				'received_amount'	=>$this->request->getPost("received_amount", FILTER_SANITIZE_STRING),
				'received_confirms'	=>$this->request->getPost("received_confirms", FILTER_SANITIZE_STRING),
				'status'			=>$this->request->getPost("status", FILTER_SANITIZE_STRING),
				'status_text'		=>$this->request->getPost("status_text", FILTER_SANITIZE_STRING),
				'txn_id'			=>$this->request->getPost("txn_id", FILTER_SANITIZE_STRING)
			);

			$date 			= new DateTime();
			$deposit_date 	= $date->format('Y-m-d H:i:s');
			$wheredata 		= "txn_id='".$this->request->getPost("txn_id")."' AND user_id!=''";
			$instantdata	= $this->db->table("coinpayments_payments")->select("*")->where($wheredata)->get()->getRow();

			$dbt_deposit_data 		= array(

				'user_id'			=> @$instantdata->user_id,
				'currency_symbol'	=> @$this->request->getPost("currency2", FILTER_SANITIZE_STRING),
				'amount'         	=> @$this->request->getPost("amount2", FILTER_SANITIZE_STRING),
				'method_id'      	=> @$gateway->identity,
				'fees_amount'    	=> @$feesamount,
				'comment'        	=> @$this->request->getPost("txn_id", FILTER_SANITIZE_STRING),
				'status'         	=> 0,
				'deposit_date'   	=> @$deposit_date,
				'ip'             	=> @$this->request->getipAddress()

			);

			if (!$this->request->getPost("ipn_mode", FILTER_SANITIZE_STRING) || $this->request->getPost("ipn_mode", FILTER_SANITIZE_STRING)!= 'hmac') { 

				if($debug_active==1){
					$this->errorAndDie('IPN Mode is not HMAC',$debug_email);
				}
			}

			if (!$this->request->server("HTTP_HMAC") || empty($this->request->server("HTTP_HMAC"))) { 

				if($debug_active==1){
					$this->errorAndDie('No HMAC signature sent.',$debug_email);
				}
			} 

			$request = file_get_contents('php://request'); 
			if ($request === FALSE || empty($request)) {

				if($debug_active==1){
					$this->errorAndDie('Error reading getPost data',$debug_email);
				}
			} 

			if (!$this->request->getPost("merchant", FILTER_SANITIZE_STRING) || $this->request->getPost("merchant", FILTER_SANITIZE_STRING) != trim($cp_merchant_id)) {

				if($debug_active==1){
					$this->errorAndDie('No or incorrect Merchant ID passed',$debug_email);
				}
			} 

			$hmac = hash_hmac("sha512", $request, trim($cp_ipn_secret)); 
			if (!hash_equals($hmac, $this->request->server("HTTP_HMAC"))) { 

				if($debug_active==1){
					$this->errorAndDie('HMAC signature does not match',$debug_email);
				}
			}

			$txn_id 		= $this->request->getPost("txn_id", FILTER_SANITIZE_STRING); 
			$item_name 		= $this->request->getPost("item_name", FILTER_SANITIZE_STRING); 
			$item_number	= $this->request->getPost("item_number", FILTER_SANITIZE_STRING);
			$amount1 		= number_format((float)($this->request->getPost("amount1", FILTER_SANITIZE_STRING)),8, '.', '');
			$amount2 		= number_format((float)($this->request->getPost("amount2", FILTER_SANITIZE_STRING)),8, '.', '');
			$currency1 		= $this->request->getPost("currency1", FILTER_SANITIZE_STRING); 
			$currency2 		= $this->request->getPost("currency2", FILTER_SANITIZE_STRING); 
			$status 		= intval($this->request->getPost("status", FILTER_SANITIZE_STRING)); 
			$status_text 	= $this->request->getPost("status_text", FILTER_SANITIZE_STRING);

			if ($currency1 != $order_currency) {

				if($debug_active==1){
					$this->errorAndDie('Original currency mismatch!',$debug_email);
				}
			}

			if ($amount1 < $order_total) {

				if($debug_active==1){
					$this->errorAndDie('Amount is less than order total!',$debug_email);
				}
			} 

			if ($status >= 100 || $status == 2) {

				$dbt_deposit_check = $this->db->table("dbt_deposit")->select('*')->where("user_id",@$instantdata->user_id)->where("comment",$this->request->getPost("txn_id"))->where("status",1)->get()->getRow();

				if(empty(@$dbt_deposit_check)){

					$this->common_model->save('coinpayments_payments', $reg);
					
					$balance_add = array(
						'user_id'           => @$instantdata->user_id,
						'currency_symbol'   => @$this->request->getPost("currency2", FILTER_SANITIZE_STRING), 
						'amount'           	=> $depositAmount,
						'last_update' 		=> @$deposit_date,
					);

					$deposit_balance 	= $this->web_model->coinpayments_balanceAdd($balance_add);;

					if ($deposit_balance) {
						
						$depositdata = array(
							'user_id'            => @$instantdata->user_id,
							'balance_id'         => @$deposit_balance,
							'currency_symbol'    => @$this->request->getPost("currency2", FILTER_SANITIZE_STRING),
							'transaction_type'   => 'DEPOSIT',
							'transaction_amount' => $depositAmount,
							'transaction_fees' 	 => $feesamount,
							'ip'                 => @$this->request->getipAddress(),
							'date'               => @$deposit_date
						);

						$this->web_model->balancelog($depositdata);
					}

					$date 			= new \DateTime();
					$deposit_date 	= $date->format('Y-m-d H:i:s');

					$confirmdeposit = array(

						'depositdate'		=> $deposit_date,
						'user_id'			=>@$instantdata->user_id,
						'comment'			=>@$txn_id,
						'currency_symbol'	=>@$currency2
					);
					//confirm deposite data update start
					$updatedatacoin = array(
			            'deposit_date'  =>$confirmdeposit['depositdate'],
			            'approved_date' =>$confirmdeposit['depositdate'],
			            'status'        =>1
			        );

			        $wheredatacoin = array(
			            'user_id'           =>$confirmdeposit['user_id'],
			            'comment'           =>$confirmdeposit['comment'],
			            'currency_symbol'   =>$confirmdeposit['currency_symbol']
			        );
			        $this->common_model->update('dbt_deposit', $updatedata, $wheredatacoin);
			        //confirm deposite data update start

					$this->refferalbonus(@$this->request->getPost("amount2"),@$this->request->getPost("currency2"),@$instantdata->user_id);
				}
			}
			else if ($status < 0) {

				$this->common_model->save('coinpayments_payments', $reg);

				if($status==-1){
					$this->coinpayments_cancel();
				}
			}
			else {

				$this->common_model->save('coinpayments_payments', $reg);

				$dbt_deposit = $this->db->table("dbt_deposit")->select('*')->where("comment",$this->request->getPost("txn_id"))->get()->getRow();
				if(!$dbt_deposit){
					$this->common_model->save('dbt_deposit', $dbt_deposit_data);
				}
			}
		}

		public function coinpayments_cancel(){

			$this->session->setFlashdata('exception', "Payment Canceled/Failed");
		}

		//akhono hoyni
		public function conipayment_withdraw()
		{
			$gateway = $this->db->select('*')->from('payment_gateway')->where('identity', 'coinpayment')->where('status', 1)->get()->row();

			if (is_string($gateway->data) && is_array(json_decode($gateway->data, FILTER_SANITIZE_STRING)) && (json_last_error() == JSON_ERROR_NONE) ? true : false) {

				$data 			= json_decode(@$gateway->data, FILTER_SANITIZE_STRING);
				$cp_merchant_id = @$data['marcent_id'];
				$cp_ipn_secret 	= @$data['ipn_secret'];
				$debug_active	= @$data['debuging_active'];
				$debug_email 	= @$data['debug_email'];
			} else {

				$cp_merchant_id = "";
				$cp_ipn_secret 	= "";
				$debug_active	= "";
				$debug_email 	= "";
			}

			if (!$this->request->getPost("ipn_mode", FILTER_SANITIZE_STRING) || $this->request->getPost("ipn_mode", FILTER_SANITIZE_STRING)!= 'hmac') { 

				if($debug_active==1){
					$this->errorAndDie('IPN Mode is not HMAC',$debug_email);
				}
			}

			if (!$this->request->server("HTTP_HMAC") || empty($this->request->server("HTTP_HMAC"))){ 

				if($debug_active==1){
					$this->errorAndDie('No HMAC signature sent.',$debug_email);
				}
			} 

			$request = file_get_contents('php://request'); 
			if ($request === FALSE || empty($request)) {

				if($debug_active==1){
					$this->errorAndDie('Error reading getPost data',$debug_email);
				}
			} 

			if (!$this->request->getPost("merchant") || $this->request->getPost("merchant") != trim($cp_merchant_id)) {

				if($debug_active==1){
					$this->errorAndDie('No or incorrect Merchant ID passed',$debug_email);
				}
			}

			$hmac = hash_hmac("sha512", $request, trim($cp_ipn_secret)); 
			if (!hash_equals($hmac, $this->request->server("HTTP_HMAC"))) { 

				if($debug_active==1){
					$this->errorAndDie('HMAC signature does not match',$debug_email);
				}
			}

			$status 	 = intval($this->request->getPost("status", FILTER_SANITIZE_STRING)); 
			$status_text = $this->request->getPost("status_text", FILTER_SANITIZE_STRING);

			if ($status >= 100 || $status == 2) {
				
				$set_status  = 1;
				$wheredata 	 = "txn_id='".$this->request->getPost("id")."' AND user_id!=''";
				$instantdata = $this->db->select("*")->from("coinpayments_payments")->where($wheredata)->get()->row();
				$user_id     = $instantdata->user_id;

				$dbt_withdraw_check = $this->db->select('*')->from("dbt_withdraw")->where("user_id",@$instantdata->user_id)->where("comment",$this->request->getPost("id", FILTER_SANITIZE_STRING))->where("status",1)->get()->num_rows();

				if(@$dbt_withdraw_check == 0){

					$data = array(
						'success_date' 	=>date('Y-m-d h:i:s'),
						'status' 		=> $set_status,
					);

					$wheredata = array(

						'user_id' =>$user_id,
						'comment' =>$this->request->getPost('id')
					);

					$this->db->where($wheredata)->update('dbt_withdraw', $data);

					$t_data     = $this->db->select('*')->from('dbt_withdraw')->where($wheredata)->get()->row();

					$userinfo   =  $this->db->select('*')->from('dbt_user')->where('user_id', $user_id)->get()->row();

					$set        = $this->common_model->findById('sms_email_send_setup',array('method' => 'email'));
					$setsms     = $this->common_model->findById('sms_email_send_setup',array('method' => 'sms'));
					$appSetting = $this->common_model->findById('setting',array('setting_id' => 1));

					$reg = array(

						'amount1'			=>$this->request->getPost("amount", FILTER_SANITIZE_STRING),
						'amount2'			=>$this->request->getPost("amount", FILTER_SANITIZE_STRING),
						'buyer_name'		=>'',
						'currency1'			=>$this->request->getPost("currency", FILTER_SANITIZE_STRING),
						'currency2'			=>$this->request->getPost("currency", FILTER_SANITIZE_STRING),
						'fee'				=>'',
						'ipn_id'			=>$this->request->getPost("ipn_id", FILTER_SANITIZE_STRING),
						'ipn_mode'			=>$this->request->getPost("ipn_mode", FILTER_SANITIZE_STRING),
						'ipn_type'			=>$this->request->getPost("ipn_type", FILTER_SANITIZE_STRING),
						'ipn_version'		=>$this->request->getPost("ipn_version", FILTER_SANITIZE_STRING),
						'merchant'			=>$this->request->getPost("merchant", FILTER_SANITIZE_STRING),
						'received_amount'	=>'',
						'received_confirms'	=>'',
						'status'			=>$this->request->getPost("status", FILTER_SANITIZE_STRING),
						'status_text'		=>$this->request->getPost("status_text", FILTER_SANITIZE_STRING),
						'txn_id'			=>$this->request->getPost("txn_id", FILTER_SANITIZE_STRING)

					);

					$this->payment_model->coinpaymentsPaymentLog($reg);

					$withdrawamount = $this->request->getPost("amount", FILTER_SANITIZE_STRING);


					if($set->withdraw != NULL){

						$check_user_balance = $this->db->select('*')->from('dbt_balance')->where('user_id', $user_id)->where('currency_symbol', $this->request->getPost('currency'))->get()->row();
						$new_balance = $check_user_balance->balance-$withdrawamount;


						$this->db->set('balance', $new_balance)->where('user_id', $user_id)->where('currency_symbol', $this->request->getPost('currency'))->update("dbt_balance");

			            //User Financial Log
						if ($check_user_balance) {

							$depositdata = array(
								'user_id'            => $user_id,
								'balance_id'         => $check_user_balance->id,
								'currency_symbol'    => $t_data->currency_symbol,
								'transaction_type'   => 'WITHDRAW',
								'transaction_amount' => $t_data->amount,
								'transaction_fees'   => $t_data->fees_amount,
								'ip'                 => $t_data->ip,
								'date'               => $t_data->request_date
							);

							$this->payment_model->balancelog($depositdata);

						}

			            #----------------------------
			            #      email verify smtp
			            #----------------------------
						$getPost = array(
							'amount'        => $t_data->amount,
							'new_balance'   => $new_balance,
						);
						
						$config_var = array( 
	                        'template_name' => 'withdraw_success',
	                        'template_lang' => $this->master->langSet() == 'english'?'en':'fr',
	                    );
	                    $message    = $this->common_model->email_msg_generate($config_var, $getPost);
	                    $send_email = array(
	                        'title'         => $appSetting->title,
	                        'to'            => $this->session->get('email'),
	                        'subject'       => $message['subject'],
	                        'message'       => $message['message'],
	                    );

	                    $send = $this->common_model->send_email($send_email);
						
						if($send){
							$n = array(
								'user_id'                => $user_id,
								'subject'                => $message['subject'],
								'notification_type'      => 'withdraw',
								'details'                =>$message['message'],
								'date'                   => date('Y-m-d h:i:s'),
								'status'                 => '0'
							);
							$this->db->insert('notifications',$n);    
						}
					}
					if($setsms->withdraw != NULL){

			            #----------------------------
			            #      Sms verify
			            #----------------------------

						$template = array( 
							'name'      => $userinfo->first_name." ".$userinfo->last_name,
							'amount'    => $t_data->amount,
							'new_balance' => $new_balance,
							'date'      => date('d F Y')
						);

						$config_var = array( 
	                        'template_name' => 'withdraw_success',
	                        'template_lang' => $this->master->langSet() == 'english'?'en':'fr',
	                    );
	                    $message  = $this->common_model->sms_msg_generate($config_var, $template);
	                    $send_sms = array(
	                        'to'        => $userinfo->phone,
	                        'subject'   => $message['subject'],
	                        'template'  => $message['message'],
	                    );

						if (@$userinfo->phone) {
							$send_sms = $this->sms_lib->send($send_sms);

						} else {

							$this->session->setFlashdata('exception', display('there_is_no_phone_number'));
						}
						
						if(@$send_sms){
							$message_data = array(
								'sender_id'   => 1,
								'receiver_id' => $userinfo->user_id,
								'subject' 	  => $message['subject'],
								'message' 	  => $message['message'],
								'datetime' 	  => date('Y-m-d h:i:s'),
							);
							$this->db->insert('message', $message_data);
						}
					}
				}
			}
		}


		public function stripe_confirm(){

			$token   = $this->request->getPost('stripeToken');
			$email   = $this->request->getPost('stripeEmail', FILTER_SANITIZE_STRING);
			$deposit = $this->session->get('deposit');
			$gateway = $this->common_model->findById('payment_gateway', array('identity' => 'stripe', 'status' => 1));

			
			if ($gateway) {

				require_once APPPATH.'Libraries/stripe/vendor/autoload.php';

				$stripe = array(
					"secret_key"      => @$gateway->private_key,
					"publishable_key" => @$gateway->public_key
				);

				\Stripe\Stripe::setApiKey($stripe['secret_key']);

				$customer = \Stripe\Customer::create(array(
					'email' => $email,
					'source'  => $token
				));

				$charge = \Stripe\Charge::create(array(
					'customer' => $customer->id,
					'amount'   => round(($deposit->amount+@$deposit->fees_amount)*100),
					'currency' => 'usd'
				));


				if ($charge) {

					$payment_type = $this->session->get('payment_type');

					
					if ($payment_type == 'deposit') {	    		

						$response = $this->deposit_confirm();
						if($response == 1){

							return redirect()->to(base_url('/balances'));

						} else if($response == 2){
							return redirect()->to(base_url('/deposit'));
						}

					}elseif ($payment_type == 'buy') {
						# code...

					}elseif ($payment_type == 'sell') {
						# code...

					}else {
						# code...

					}
				}
			}

		}


		public function stripe_cancel(){

			$this->session->setFlashdata('exception', "Payment Canceled/Failed");
			return redirect()->to(base_url("customer"));

		}


		public function phone_confirm(){

			$payment_type = $this->session->get('payment_type');

			if ($payment_type == 'deposit') {
				
				$payment_type = $this->session->get('payment_type');
				$deposit 	  = $this->session->get('deposit');	    	

		    	//Store Data On Deposit
				if ($this->common_model->save_return_id('dbt_deposit', (array)$deposit)) {

					unset($_SESSION['payment_type']);
					$this->session->setFlashdata('message', "Wait for Confirmation");
					return redirect()->to(base_url('balances'));

				} else {
					unset($_SESSION['payment_type']);
					$this->session->setFlashdata('exception', display('please_try_again'));
					return redirect()->to(base_url('deposit'));

				}

			}elseif ($payment_type == 'buy') {
				# code...

			}elseif ($payment_type == 'sell') {
				# code...

			}else {
				# code...

			}

			unset($_SESSION[$payment_type]);

			$this->session->setFlashdata('message', display('payment_successfully'));
			return redirect()->to(base_url());

		}

		public function phone_cancel(){

			$this->session->setFlashdata('exception', "Payment Canceled/Faild");
			return redirect()->to(base_url());    	
		}


		public function token_confirm(){

			$payment_type = $this->session->get('payment_type');

			if ($payment_type == 'deposit') {
				
				$payment_type = $this->session->get('payment_type');
				$deposit 	  = $this->session->get('deposit');	    	

		    	//Store Data On Deposit
		    	$response_id = $this->common_model->save_return_id('dbt_deposit', (array)$deposit);

				if ($response_id) {

					unset($_SESSION['payment_type']);
					$this->session->setFlashdata('message', "Wait for Confirmation");
					return redirect()->to(base_url('balances'));

				} else {

					unset($_SESSION['payment_type']);
					$this->session->setFlashdata('exception', display('please_try_again'));
					return redirect()->to(base_url('balances'));
				}

			}elseif ($payment_type == 'buy') {
				# code...

			}elseif ($payment_type == 'sell') {
				# code...

			}else {
				# code...

			}

			unset($_SESSION['payment_type']);
			$this->session->setFlashdata('message', display('payment_successfully'));
			return redirect()->to(base_url('deposit'));
		}

		public function token_cancel(){

			$this->session->setFlashdata('exception', "Payment Canceled/Faild");
			return redirect()->to(base_url());   	
		}


		public function bank_confirm(){

			$payment_type = $this->session->get('payment_type');

			if ($payment_type == 'deposit') {
				
				$payment_type = $this->session->get('payment_type');
				$deposit = $this->session->get('deposit');	    	

		    	//Store Data On Deposit
				if ($this->common_model->save('dbt_deposit', (array)$deposit)) {

					unset($_SESSION['payment_type']);
					$this->session->setFlashdata('message', "Wait for Confirmation");
					return redirect()->to(base_url('balances'));

				} else {
					unset($_SESSION['payment_type']);
					$this->session->setFlashdata('exception', display('please_try_again'));
					return redirect()->to(base_url('deposit'));
				}

			}elseif ($payment_type == 'buy') {
				# code...

			}elseif ($payment_type == 'sell') {
				# code...

			}else {
				# code...

			}

			unset($_SESSION['payment_type']);
			$this->session->set_flashdata('message', display('payment_successfully'));
			return redirect()->to(base_url('balances'));


		}

		public function bank_cancel(){

			$this->session->setFlashdata('exception', "Payment Canceled/Faild");
			return redirect()->to(base_url());
		}

		private function deposit_confirm(){

			$payment_type = $this->session->get('payment_type');
			$deposit      = $this->session->get('deposit');

	    	//Update session
			$deposit->status = 1;//needed it
			unset($_SESSION['deposit']);

			$sql = "SELECT * FROM `dbt_deposit` WHERE user_id='".$deposit->user_id."' AND currency_symbol='".$deposit->currency_symbol."' AND amount	='".$deposit->amount."' AND fees_amount='".$deposit->fees_amount."' AND deposit_date='".$deposit->deposit_date."'";
        	$same_payment = $this->db->query($sql, [])->getRow();
	    	//Find same payment
			
	    	//Store Data On Deposit
			if (!$same_payment) {
				
				$userinfo = $this->common_model->findById('dbt_user', array('user_id' => $this->session->get('user_id')));

				$datadeposit = array(
						'user_id'        	=> $deposit->user_id,
						'currency_symbol'	=> $deposit->currency_symbol,
						'method_id'   		=> $deposit->method_id,
						'amount' 			=> $deposit->amount,
						'fees_amount'   	=> $deposit->fees_amount,
						'status'            => $deposit->status,
						'deposit_date'      => $deposit->deposit_date,
						'ip'               	=> $deposit->ip
					);
				$this->common_model->save('dbt_deposit', $datadeposit);

	    		//User Balance Add
				$deposit_balance = $this->web_model->balanceAdd($deposit);

	    		//User Financial Log
				if ($deposit_balance) {
					
					$depositdata = array(
						'user_id'            => $deposit->user_id,
						'balance_id'         => $deposit_balance,
						'currency_symbol'    => $deposit->currency_symbol,
						'transaction_type'   => 'DEPOSIT',
						'transaction_amount' => $deposit->amount,
						'transaction_fees'   => $deposit->fees_amount,
						'ip'                 => $deposit->ip,
						'date'               => $deposit->deposit_date
					);

					$this->common_model->save('dbt_balance_log', $depositdata);
				}

				// Affilition Bonus
				$this->refferalbonus($deposit->amount,$deposit->currency_symbol,$userinfo->user_id);
				$set = $this->common_model->findById('sms_email_send_setup', array('method' => 'email'));
				$setsms = $this->common_model->findById('sms_email_send_setup', array('method' => 'sms'));
				$appSetting = $this->common_model->findById('setting', array());

				if($set->deposit != NULL){
				    #----------------------------
				    #      email verify smtp
				    #----------------------------
					$getPost = array(
						'amount' => $deposit->currency_symbol." ".$deposit->amount,
					);
					
					$config_var = array( 
                        'template_name' => 'deposit_success',
                        'template_lang' => $this->master->langSet() == 'english'?'en':'fr',
                    );
                    $message    = $this->common_model->email_msg_generate($config_var, $getPost);
                    $send_email = array(
                        'title'   => $appSetting->title,
                        'to'      => $this->session->get('email'),
                        'subject' => $message['subject'],
                        'message' => $message['message'],
                    );

                    $send_email = $this->common_model->send_email($send_email);

					if($send_email){
						$n = array(
							'user_id'           => $this->session->get('user_id'),
							'subject'           => $message['subject'],
							'notification_type' => 'deposit',
							'details'           => $message['message'],
							'date'              => date('Y-m-d h:i:s'),
							'status'            => '0'
						);
						$this->common_model->save('notifications',$n);    
					}
				}

				if($setsms->deposit != NULL){

					$template = array( 

						'name'   => $this->session->get('fullname'),
						'amount' => $deposit->currency_symbol." ".$deposit->amount,
						'date'   => date('d F Y')
					);

					$config_var = array( 
                        'template_name' => 'deposit_success',
                        'template_lang' => $this->master->langSet() == 'english'?'en':'fr',
                    );
                    $message    = $this->common_model->sms_msg_generate($config_var, $template);
                    $send_sms = array(
                        'to'       => $userinfo->phone,
                        'template' => $message['message'],
                    );
				    #------------------------------
				    #   SMS Sending
				    #------------------------------
					if (@$userinfo->phone) {
						$send_sms = $this->sms_lib->send($send_sms);

					} else {
						$this->session->setFlashdata('exception', display('there_is_no_phone_number'));
					}

					if(@$send_sms){
						$message_data = array(
							'sender_id'   => 1,
							'receiver_id' => $this->session->get('user_id'),
							'subject' 	  => 'Deposit',
							'message' 	  => $message['message'],
							'datetime' 	  => date('Y-m-d h:i:s'),
						);
						$this->common_model->save('message',$message_data);    
					}
				}
				unset($_SESSION['payment_type']);
				$this->session->setFlashdata('message', display('payment_successfully'));
				
				return 1; 

			} else {

				unset($_SESSION['payment_type']);
				$this->session->setFlashdata('exception', display('please_try_again'));
			
				return 2; 
			}
		}

		private function refferalbonus($amount="",$currency_symbol="",$user_id="")
		{
			$reffereldata = $this->common_model->findById('dbt_user', array('user_id' => $user_id));

			if($reffereldata->referral_id){
				$refferId = $reffereldata->referral_id;
				$rcommission = $this->common_model->findById('earnings', array('user_id' => $refferId, 'Purchaser_id' => $user_id, 'earning_type' => 'REFERRAL'));
				if(empty($rcommission)){
					$commissioninfo = $this->db->table('dbt_affiliation')->select('*')->where('status',1)->get();
					//here now problem may be
					if(!empty($commissioninfo)){
						$commission = $commissioninfo->getRow();
						$camount    = 0;
						if($commission->type=="PERCENT"){
							$camount = number_format(($amount*$commission->commission)/100,8);
						}
						else{
							$camount = number_format($commission->commission,8);
						}
						$commissiondata = array(
							'user_id'       => $refferId,
							'Purchaser_id'  => $user_id,
							'earning_type'  => 'REFERRAL',
							'amount'        => $camount,
							'date'          => date('Y-m-d'),
						);
						$this->common_model->save('earnings',$commissiondata);

						$balanceId 		= "";
						$checkbalance 	= $this->common_model->findById('dbt_balance', array('user_id' => $refferId, 'currency_symbol' => $currency_symbol));
						if($checkbalance){

							$totalbalance= $checkbalance->balance+$camount;
							$balanceId 	 = $checkbalance->id;
							$balancedata = array(
								'balance'       =>$totalbalance,
								'last_update'   =>date('Y-m-d H:i:s'),
							);
							
							$this->common_model->update('dbt_balance', $balancedata, array('user_id' => $refferId, 'currency_symbol' => $currency_symbol));

						} else {

							$balancedata = array(
								'user_id'    		=>$refferId,
								'currency_symbol' 	=>$currency_symbol,
								'balance'    		=>$camount,
								'last_update'		=>date('Y-m-d H:i:s')
							);
							$balanceId = $this->common_model->save_return_id("dbt_balance",$balancedata);
						}

						$depositdata = array(
							'user_id'            => $refferId,
							'balance_id'         => $balanceId,
							'currency_symbol'    => $currency_symbol,
							'transaction_type'   => 'REFERRAL',
							'transaction_amount' => $camount,
							'transaction_fees'   => 0,
							'ip'                 => $this->request->getipAddress(),
							'date'               => date('Y-m-d H:i:s')
						);

						$this->common_model->save('dbt_balance_log', $depositdata);
					}
				}
			}
		}
	}
?>