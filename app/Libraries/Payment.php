<?php namespace App\Libraries;
use App\Models\Common_model;
use App\Libraries\cryptobox\lib\cryptobox;


class Payment
{

    public function __construct()
    {
        $this->session  = session();
        $this->db       = db_connect();
        $this->uri      = current_url(true);
        $this->common_model = new Common_model();
    }
    
    public function payment_process($sdata, $method=NULL){

        $gateway = $this->common_model->findById('payment_gateway', array('identity' => $method, 'status' => 1));
        
        if ($method=='bitcoin') {            

            /********************************
            * GoUrl Cryptocurrency Payment API
            *********************************/
            if ($gateway) {

                $coin = 'bitcoin';
                if($sdata->currency_symbol=='BCH'){
                    $coin = 'bitcoincash';
                }elseif($sdata->currency_symbol=='LTC'){
                    $coin = 'litecoin';
                }elseif($sdata->currency_symbol=='DASH'){
                    $coin = 'dash';
                }elseif($sdata->currency_symbol=='DOGE'){
                    $coin = 'dogecoin';
                }elseif($sdata->currency_symbol=='SPD'){
                    $coin = 'speedcoin';
                }elseif($sdata->currency_symbol=='RDD'){
                    $coin = 'reddcoin';
                }elseif($sdata->currency_symbol=='POT'){
                    $coin = 'potcoin';
                }elseif($sdata->currency_symbol=='FTC'){
                    $coin = 'feathercoin';
                }elseif($sdata->currency_symbol=='VTC'){
                    $coin = 'vertcoin';
                }elseif($sdata->currency_symbol=='PPC'){
                    $coin = 'peercoin';
                }elseif($sdata->currency_symbol=='MUE'){
                    $coin = 'monetaryunit';
                }elseif($sdata->currency_symbol=='UNIT'){
                    $coin = 'universalcurrency';
                }else{
                    $coin = 'bitcoin';
                }


                /**
                 * @category    Main Example - Custom Payment Box ((json, bootstrap4, mobile friendly, white label product, your own logo)    
                 * @package     GoUrl Cryptocurrency Payment API
                 * copyright    (c) 2014-2018 Delta Consultants
                 * @desc        GoUrl Crypto Payment Box Example (json, bootstrap4, mobile friendly, optional - free White Label Product - Bitcoin/altcoin Payments with your own logo and all payment requests through your server, open source)
                 * @crypto      Supported Cryptocoins - Bitcoin, BitcoinCash, Litecoin, Dash, Dogecoin, Speedcoin, Reddcoin, Potcoin, Feathercoin, Vertcoin, Peercoin, MonetaryUnit, UniversalCurrency
                 * @website     https://gourl.io/bitcoin-payment-gateway-api.html#p8
                 * @live_demo   https://gourl.io/lib/examples/example_customize_box.php
                 * @note    You can delete folders - 'Examples', 'Screenshots' from this archive
                 */ 
                    

                /********************** NOTE - 2018 YEAR *******************************************************************************/ 
                /*****                                                                                                             *****/ 
                /*****     This is NEW 2018 latest Bitcoin Payment Box Example  (mobile friendly JSON payment box)                 *****/ 
                /*****                                                                                                             *****/ 
                /*****     You can generate php payment box code online - https://gourl.io/lib/examples/example_customize_box.php  *****/
                /*****         White Label Product - https://gourl.io/lib/test/example_customize_box.php?method=curl&logo=custom   *****/
                /*****         Light Theme - https://gourl.io/lib/examples/example_customize_box.php?theme=black                   *****/
                /*****         Black Theme - https://gourl.io/lib/examples/example_customize_box.php?theme=default             *****/
                /*****         Your Own Logo - https://gourl.io/lib/examples/example_customize_box.php?theme=default&logo=custom   *****/
                /*****                                                                                                             *****/ 
                /***********************************************************************************************************************/

                    
                    
                // Change path to your files
                // --------------------------------------
                DEFINE("CRYPTOBOX_PHP_FILES_PATH", site_url('/gourl/lib/'));         // path to directory with files: cryptobox.class.php / cryptobox.callback.php / cryptobox.newpayment.php; 
                                                                    // cryptobox.newpayment.php will be automatically call through ajax/php two times - payment received/confirmed
                DEFINE("CRYPTOBOX_IMG_FILES_PATH", site_url('gourl/images/'));      // path to directory with coin image files (directory 'images' by default)
                DEFINE("CRYPTOBOX_JS_FILES_PATH", site_url('gourl/js/'));           // path to directory with files: ajax.min.js/support.min.js
                
                
                // Change values below
                // --------------------------------------
                DEFINE("CRYPTOBOX_LANGUAGE_HTMLID", "alang");   // any value; customize - language selection list html id; change it to any other - for example 'aa';   default 'alang'
                DEFINE("CRYPTOBOX_COINS_HTMLID", "acoin");      // any value;  customize - coins selection list html id; change it to any other - for example 'bb'; default 'acoin'
                DEFINE("CRYPTOBOX_PREFIX_HTMLID", "acrypto_");  // any value; prefix for all html elements; change it to any other - for example 'cc';  default 'acrypto_'
                


                
                // Open Source Bitcoin Payment Library
                // ---------------------------------------------------------------
                require FCPATH."gourl/lib/cryptobox.class.php";
                    
                    /*********************************************************/
                    /****  PAYMENT BOX CONFIGURATION VARIABLES  ****/
                    /*********************************************************/
                    
                    // IMPORTANT: Please read description of options here - https://gourl.io/api-php.html#options
                    
                    $userID         = $sdata->user_id;     // place your registered userID or md5(userID) here (user1, user7, uo43DC, etc).
                                                      // You can use php $_SESSION["userABC"] for store userID, amount, etc
                                                      // You don't need to use userID for unregistered website visitors - $userID = "";
                                                      // if userID is empty, system will autogenerate userID and save it in cookies
                    $userFormat     = "COOKIE";       // save userID in cookies (or you can use IPADDRESS, SESSION, MANUAL)
                    $orderID        = "inv".$sdata->user_id.time().'_'.(float)@$sdata->fees_amount;    // invoice #000383
                    $amountUSD      = (float)@$sdata->amount + (float)@$sdata->fees_amount;           // invoice amount - 0.12 USD; or you can use - $amountUSD = convert_currency_live("EUR", "USD", 22.37); // convert 22.37EUR to USD
                    
                    $period                 = "NOEXPIRY";     // one time payment, not expiry
                    $def_language           = "en";           // default Language in payment box
                    $data['def_language']   = "en";
                    $def_coin               = $coin;      // default Coin in payment box
                    $data['def_coin']       = $coin;
                    
                    
                    
                    // List of coins that you accept for payments
                    //$coins = array('bitcoin', 'bitcoincash', 'litecoin', 'dash', 'dogecoin', 'speedcoin', 'reddcoin', 'potcoin', 'feathercoin', 'vertcoin', 'peercoin', 'monetaryunit', 'universalcurrency');


                    $coins = array($coin);  // for example, accept payments in bitcoin, bitcoincash, litecoin, dash, speedcoin 
                    $data['coins'] = array($coin); 

                    // Create record for each your coin - https://gourl.io/editrecord/coin_boxes/0 ; and get free gourl keys
                    // It is not bitcoin wallet private keys! Place GoUrl Public/Private keys below for all coins which you accept

                    $pub_key = unserialize($gateway->public_key);
                    $pri_key = unserialize($gateway->private_key);
                    $pub_val = '';
                    $piv_val = '';
                    foreach ($pub_key as $key => $value) { 
                        if ($coin == $key && $value!='') $pub_val = $value;

                    }
                    foreach ($pri_key as $key => $value) { 
                        if ($coin == $key && $value!='') $piv_val = $value;

                    }

                             
                    // Demo Keys; for tests (example - 5 coins)
                    $all_keys = array(  $coin => array( "public_key" => $pub_val,  
                                                        "private_key" => $piv_val));

                    //  IMPORTANT: Add in file /lib/cryptobox.config.php your database settings and your gourl.io coin private keys (need for Instant Payment Notifications) -
                    /* if you use demo keys above, please add to /lib/cryptobox.config.php - 
                        $cryptobox_private_keys = array("25654AAo79c3Bitcoin77BTCPRV0JG7w3jg0Tc5Pfi34U8o5JE", 
                                    "25656AAeOGaPBitcoincash77BCHPRV8quZcxPwfEc93ArGB6D", "25657AAOwwzoLitecoin77LTCPRV7hmp8s3ew6pwgOMgxMq81F", 
                                    "25658AAo79c3Dash77DASHPRVG7w3jg0Tc5Pfi34U8o5JEiTss", "20116AA36hi8Speedcoin77SPDPRVNOwjzYNqVn4Sn5XOwMI2c");
                        Also create table "crypto_payments" in your database, sql code - https://github.com/cryptoapi/Payment-Gateway#mysql-table
                        Instruction - https://gourl.io/api-php.html         
                    */                 
                    
                    
                    
                    
                    // Re-test - all gourl public/private keys
                    $def_coin = strtolower($def_coin);
                    if (!in_array($def_coin, $coins)) $coins[] = $def_coin;  
                    foreach($coins as $v)
                    {
                        if (!isset($all_keys[$v]["public_key"]) || !isset($all_keys[$v]["private_key"])) die("Please add your public/private keys for '$v' in \$all_keys variable");
                        elseif (!strpos($all_keys[$v]["public_key"], "PUB"))  die("Invalid public key for '$v' in \$all_keys variable");
                        elseif (!strpos($all_keys[$v]["private_key"], "PRV")) die("Invalid private key for '$v' in \$all_keys variable");
                        elseif (strpos(CRYPTOBOX_PRIVATE_KEYS, $all_keys[$v]["private_key"]) === false) 
                                die("Please add your private key for '$v' in variable \$cryptobox_private_keys, file /lib/cryptobox.config.php.");
                    }
                    
                    // Current selected coin by user
                    $coinName = cryptobox_selcoin($coins, $def_coin);
                    
                    // Current Coin public/private keys
                    $public_key  = $all_keys[$coinName]["public_key"];
                    $private_key = $all_keys[$coinName]["private_key"];
                    
                    /** PAYMENT BOX **/
                    $options = array(
                        "public_key"    => $public_key,
                        "private_key"   => $private_key,
                        "webdev_key"    => "DEV1124G19CFB313A993D68G453342148", 
                        "orderID"       => $orderID,
                        "userID"        => $userID,
                        "userFormat"    => $userFormat,
                        "amount"        => $amountUSD,
                        "amountUSD"     => 0,
                        "period"        => $period,
                        "language"      => $def_language
                    );

                    // Initialise Payment Class
                    $box = new \Cryptobox ($options);

                    $data['box'] = $box;

                    // coin name
                    $coinName = $box->coin_name();


                    // php code end :)
                    // ---------------------
                    
                    // NOW PLACE IN FILE "lib/cryptobox.newpayment.php", function cryptobox_new_payment(..) YOUR ACTIONS -
                    // WHEN PAYMENT RECEIVED (update database, send confirmation email, update user membership, etc)
                    // IPN function cryptobox_new_payment(..) will automatically appear for each new payment two times - payment received and payment confirmed
                    // Read more - https://gourl.io/api-php.html#ipn

                    //require_once(FCPATH . "gourl/lib/cryptobox.newpayment.php" );    



                    $order = $box->get_json_values();

                    $data['coinImageSize'] = 70;
                    $data['qrcodeSize'] = 200;
                    $data['show_languages'] = true;
                    $data['logoimg_path'] = "default";
                    $data['resultimg_path'] = "default";
                    $data['resultimgSize'] = 250;
                    $data['redirect'] = base_url("payment_callback/bitcoin_confirm/".@$order['order']);
                    $data['method'] = "ajax";
                    $data['debug'] = false;

                    // Text above payment box
                    $data['custom_text']  = "";


                return $data;

            }
            else{
                return false;

            }

        }
        else if ($method=='payeer') {

            /******************************
            * Payeer Payment Gateway API
            ******************************/
            if ( $gateway ) {
                $date = new \DateTime();
                $invoice = $date->getTimestamp();
                $comment = $invoice;

                $data['m_shop']     = @$gateway->public_key;
                $data['m_orderid']  = $invoice;;
                $data['m_amount']   = number_format((float)@$sdata->amount+(float)@$sdata->fees_amount, 2, '.', '');
                $data['m_curr']     = $sdata->currency_symbol;
                $data['m_desc']     = base64_encode($comment);
                $data['m_key']      = @$gateway->private_key;

                $arHash = array(
                    $data['m_shop'],
                    $data['m_orderid'],
                    $data['m_amount'],
                    $data['m_curr'],
                    $data['m_desc']
                );

                $arHash[] = $data['m_key'];

                $data['sign'] = strtoupper(hash('sha256', implode(':', $arHash)));

                return $data;
            }
            else{
                return false;
            }

        }
        else if ($method=='paypal') {

            /******************************
            * Paypal Payment Gateway API
            ******************************/
            if ( $gateway ) {

                require APPPATH.'Libraries/paypal/vendor/autoload.php';

                // After Step 1
                $apiContext = new \PayPal\Rest\ApiContext(
                    new \PayPal\Auth\OAuthTokenCredential(
                        @$gateway->public_key,     // ClientID
                        @$gateway->private_key     // ClientSecret
                    )
                );

                // Step 2.1 : Between Step 1 and Step 2
                $apiContext->setConfig(
                    array(
                        'mode' => @$gateway->secret_key,
                        'log.LogEnabled' => true,
                        'log.FileName' => 'PayPal.log',
                        'log.LogLevel' => 'FINE'
                    )
                );

                // After Step 2
                $payer = new \PayPal\Api\Payer();
                $payer->setPaymentMethod('paypal');

                $item1 = new \PayPal\Api\Item();
                $item1->setName('setName');
                $item1->setCurrency('USD');
                $item1->setQuantity(1);
                $item1->setPrice((float)@$sdata->amount+(float)@$sdata->fees_amount);

                $itemList = new \PayPal\Api\ItemList();
                $itemList->setItems(array($item1));

                $amount = new \PayPal\Api\Amount();
                $amount->setCurrency("USD");
                $amount->setTotal((float)@$sdata->amount+(float)@$sdata->fees_amount);

                $transaction = new \PayPal\Api\Transaction();
                $transaction->setAmount($amount);
                $transaction->setItemList($itemList);
                $transaction->setDescription('Description');

                $redirectUrls = new \PayPal\Api\RedirectUrls();
                $redirectUrls->setReturnUrl(base_url('payment_callback/paypal_confirm'))->setCancelUrl(base_url('payment_callback/paypal_cancel'));

                $payment = new \PayPal\Api\Payment();
                $payment->setIntent('sale')
                    ->setPayer($payer)
                    ->setTransactions(array($transaction))
                    ->setRedirectUrls($redirectUrls);

     
                // After Step 3
                try {
                    $payment->create($apiContext);                

                    $data['payment']     =  $payment;
                    $data['approval_url']=  $payment->getApprovalLink();

                }
                catch (\PayPal\Exception\PayPalConnectionException $ex) {
                    // This will print the detailed information on the exception.
                    //REALLY HELPFUL FOR DEBUGGING
                    echo $ex->getData();
                    echo $ex->getData();
                }

                return $data;

            }
            else{
                return false;

            }

        }
        else if ($method=='coinpayment') {

            /******************************
            * CoinPayments Gateway API
            ******************************/
            if ( $gateway ) {

                $user_id = $this->session->get('user_id');
                $userinfo = $this->db->table('dbt_user')->select('*')->where('user_id',$user_id)->get()->getRow();

                $check = array(
                    'amount1'   =>$sdata->amount+(float)@$sdata->fees_amount,
                    'amount2'   =>$sdata->amount+(float)@$sdata->fees_amount,
                    'ipn_type'  =>'deposit',
                    'currency1' =>$sdata->currency_symbol,
                    'currency2' =>$sdata->currency_symbol,
                    'user_id'   =>$user_id
                );

                $query          = $this->db->table('coinpayments_payments')->select('*')->where($check)->get();
                $countrow       = $this->common_model->countRow('coinpayments_payments', $check);
                $coinpaydata    = $query->getRow();

                if($countrow>0){

                    $querytnxid = $this->db->table('coinpayments_payments')->select('*')->where('txn_id',$coinpaydata->txn_id)->get();

                    $counttnxidrow  = $querytnxid->num_rows();
                    $lastrow        = $querytnxid->last_row();

                    if($counttnxidrow>1){

                        if($lastrow->status==0){

                            return json_decode($coinpaydata->status_text,true);

                        }
                        else{

                            $coinpayment = array(
                                "private_key"   =>@$gateway->private_key,
                                "public_key"    =>@$gateway->public_key
                            );

                            $public_key     =$coinpayment['public_key']; 
                            $private_key    =$coinpayment['private_key']; 

                            $req = array(
                                "version"   =>1,
                                "cmd"       =>"create_transaction",
                                "amount"    =>number_format((float)($sdata->amount)+(float)(@$sdata->fees_amount),8, '.', ''),
                                "currency1" =>$sdata->currency_symbol,
                                "currency2" =>$sdata->currency_symbol,
                                "buyer_email"=>@$userinfo->email,
                                "custom"    =>$sdata->fees_amount,
                                "ipn_url"   =>base_url("payment_callback/conipayment_confirm"),
                                "key"       =>$public_key,
                                "format"    =>'json',
                            );

                            $post_data = http_build_query($req, '', '&');

                            $hmac = hash_hmac('sha512', $post_data, $private_key); 

                            static $ch = NULL; 
                            if ($ch === NULL) { 
                                $ch = curl_init('https://www.coinpayments.net/api.php'); 
                                curl_setopt($ch, CURLOPT_FAILONERROR, TRUE); 
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
                            }
                            curl_setopt($ch, CURLOPT_HTTPHEADER, array('HMAC: '.$hmac)); 
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data); 
                             
                            $data = curl_exec($ch);

                            if ($data !== FALSE) { 
                                if (PHP_INT_SIZE < 8 && version_compare(PHP_VERSION, '5.4.0') >= 0) {

                                    $dec = json_decode($data, TRUE, 512, JSON_BIGINT_AS_STRING);

                                }
                                else { 

                                    $dec = json_decode($data, TRUE); 

                                } 
                                if ($dec !== NULL && count($dec)) {

                                    if($dec['error']=="ok"){

                                        $reg = array(

                                        'currency1'         =>$sdata->currency_symbol,
                                        'currency2'         =>$sdata->currency_symbol,
                                        'amount1'           =>@$dec['result']['amount'],
                                        'amount2'           =>@$dec['result']['amount'],
                                        'ipn_type'          =>'deposit',
                                        'status_text'       =>json_encode(@$dec),
                                        'txn_id'            =>@$dec['result']['txn_id'],
                                        'user_id'           =>$user_id

                                        );

                                        $this->common_model->insert("coinpayments_payments",$reg);

                                        return $dec;
                                    }
                                    else{

                                        $this->session->setFlashdata("exception",@$dec['error']);
                                        redirect("deposit");
                                    }
                                } 
                                else { 

                                    return array('error' => 'Unable to parse JSON result ('.json_last_error().')'); 

                                } 
                            }
                            else { 

                                return array('error' => 'cURL error: '.curl_error($ch));

                            }

                        }

                    }
                    else{

                        return json_decode($coinpaydata->status_text,true);

                    }

                }
                else{

                    $coinpayment = array(
                        "private_key"   =>@$gateway->private_key,
                        "public_key"    =>@$gateway->public_key
                    );

                    $public_key     =$coinpayment['public_key']; 
                    $private_key    =$coinpayment['private_key']; 

                    $req = array(
                        "version"   =>1,
                        "cmd"       =>"create_transaction",
                        "amount"    =>number_format((float)($sdata->amount)+(float)(@$sdata->fees_amount),8, '.', ''),
                        "currency1" =>$sdata->currency_symbol,
                        "currency2" =>$sdata->currency_symbol,
                        "buyer_email"=>@$userinfo->email,
                        "custom"    =>$sdata->fees_amount,
                        "ipn_url"   =>base_url("payment_callback/conipayment_confirm"),
                        "key"       =>$public_key,
                        "format"    =>'json',
                    );

                    $post_data = http_build_query($req, '', '&');

                    $hmac = hash_hmac('sha512', $post_data, $private_key); 

                    static $ch = NULL; 
                    if ($ch === NULL) { 
                        $ch = curl_init('https://www.coinpayments.net/api.php'); 
                        curl_setopt($ch, CURLOPT_FAILONERROR, TRUE); 
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
                    }
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array('HMAC: '.$hmac)); 
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data); 
                     
                    $data = curl_exec($ch);

                    if ($data !== FALSE) { 
                        if (PHP_INT_SIZE < 8 && version_compare(PHP_VERSION, '5.4.0') >= 0) {

                            $dec = json_decode($data, TRUE, 512, JSON_BIGINT_AS_STRING);

                        }
                        else { 

                            $dec = json_decode($data, TRUE); 

                        } 
                        if ($dec !== NULL && count($dec)) {

                            if($dec['error']=="ok"){

                                $reg = array(

                                'currency1'         =>$sdata->currency_symbol,
                                'currency2'         =>$sdata->currency_symbol,
                                'amount1'           =>@$dec['result']['amount'],
                                'amount2'           =>@$dec['result']['amount'],
                                'ipn_type'          =>'deposit',
                                'status_text'       =>json_encode(@$dec),
                                'txn_id'            =>@$dec['result']['txn_id'],
                                'user_id'           =>$user_id

                                );

                                $this->common_model->insert("coinpayments_payments",$reg);

                                return $dec;
                            } else {

                                $this->session->setFlashdata("exception",@$dec['error']);
                                redirect("deposit");
                            }

                        } 
                        else { 

                            return array('error' => 'Unable to parse JSON result ('.json_last_error().')'); 

                        } 
                    }
                    else { 

                        return array('error' => 'cURL error: '.curl_error($ch));

                    }

                }

            }
            else{
                
                return false;

            }

        }
        else if ($method=='token') {

            /******************************
            * Token Gateway API
            ******************************/
            if ( $gateway ) {

                $data['approval_url'] = base_url('payment_callback/token_confirm');
                $data['cancel_url'] = base_url('payment_callback/token_cancel');

                return $data;

            }
            else{

                return false;

            }
        }
        else if ($method == 'stripe') {

            /******************************
            * Stripe Payment Gateway API
            ******************************/
            if ($gateway) {
              
                require_once APPPATH.'Libraries/stripe/vendor/autoload.php';
                // Use below for direct download installation

                $stripe = array(
                  "secret_key"      => @$gateway->private_key,
                  "publishable_key" => @$gateway->public_key
                );

                \Stripe\Stripe::setApiKey($stripe['secret_key']);

                $data['description']= @$gateway->agent;
                $data['stripe']     = $stripe;

                
                return $data;

            }
            else{
                return false;

            }

        }
        else if($method=='phone'){

            /******************************
            * Mobile Payment (Manual)
            ******************************/            
            if ( $gateway ) {

                $data['approval_url'] = base_url('payment_callback/phone_confirm');

                return $data;

            }
            else{

                return false;

            }

        }
        else if($method=='bank'){

            /******************************
            * Bank Payment (Manual)
            ******************************/            
            if ( $gateway ) {

                $data['approval_url'] = base_url('payment_callback/bank_confirm');

                return $data;

            }
            else{

                return false;

            }

        }

    }

    public function payment_withdraw($wdata,$method = NULL)
    {

        $gateway = $this->common_model->findById('payment_gateway', array('identity' => $method, 'status' => 1));

        $user_id = $this->session->get('user_id');

        if($method == "coinpayment"){

            $coinpayment = array(    
                "private_key"   =>@$gateway->private_key,
                "public_key"    =>@$gateway->public_key
            );

            $public_key     = $coinpayment['public_key']; 
            $private_key    = $coinpayment['private_key']; 

            $req = array(
                "version"       =>1,
                "cmd"           =>"create_withdrawal",
                "amount"        =>number_format((float)($wdata['amount']),8, '.', ''),
                "currency"      =>$wdata['currency_symbol'],
                "address"       =>$wdata['wallet_id'],
                "auto_confirm"  =>1,
                "ipn_url"       =>base_url("payment_callback/conipayment_withdraw"),
                "key"           =>$public_key
            );

            $post_data = http_build_query($req, '', '&');

            $hmac = hash_hmac('sha512', $post_data, $private_key); 

            static $ch = NULL; 
            if ($ch === NULL) { 
                $ch = curl_init('https://www.coinpayments.net/api.php'); 
                curl_setopt($ch, CURLOPT_FAILONERROR, TRUE); 
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
            }
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('HMAC: '.$hmac)); 
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data); 
             
            $data = curl_exec($ch);

            if ($data !== FALSE) { 
                if (PHP_INT_SIZE < 8 && version_compare(PHP_VERSION, '5.4.0') >= 0) {

                    $dec = json_decode($data, TRUE, 512, JSON_BIGINT_AS_STRING);

                }
                else { 

                    $dec = json_decode($data, TRUE); 

                } 
                if ($dec !== NULL && count($dec)) {

                    if($dec['error']=='ok')
                    {
                        $reg = array(

                        'currency1'         =>$wdata['currency_symbol'],
                        'currency2'         =>$wdata['currency_symbol'],
                        'amount1'           =>@$dec['result']['amount'],
                        'amount2'           =>@$dec['result']['amount'],
                        'status_text'       =>json_encode(@$dec),
                        'txn_id'            =>@$dec['result']['id'],
                        'user_id'           =>$user_id
                        );
                        $this->common_model->insert("coinpayments_payments",$reg);

                        return $dec;

                    }
                    else{
                        return $dec['error'];
                    }

                } 
                else { 

                    return array('error' => 'Unable to parse JSON result ('.json_last_error().')'); 

                } 
            }
            else { 

                return array('error' => 'cURL error: '.curl_error($ch));

            }
          
        }

    }

    public function payment_confirm(){
  

    }
}