<?php namespace App\Modules\Website\Controllers;
use App\Views\views_css;
use App\Modules\Website\Views\sidebar;

class HomeController extends BaseController
{
	
	public function index()
    {

        $cat_id             = $this->common_model->findById('web_category', array('slug' => "home", 'status' => 1)); 
        $data['slider']     = $this->common_model->findAll('web_slider', array('status' => 1), 'id', 'desc');
        $data['article']    = $this->common_model->get_all('web_article',array('cat_id' => @$cat_id->cat_id), 'position_serial', 'asc', 0, 12);
        $data['coin']       = $this->common_model->findAll('dbt_cryptocoin', array('show_home' => 1), 'coin_position', 'asc');

        $data['module'] = "Website";
        $data['page']   = 'website/index'; 
        return $this->master->master($data);
    }

    public function dafult_data(){

        $data['payment_gateway'] = $this->common_model->findAll('payment_gateway', array('status' => 1), 'id', 'asc');
        $data['coin_list']       = $this->common_model->findAll('dbt_cryptocoin', array('status' => 1), 'rank', 'asc');
        echo json_encode($data);
    }

    public function getStream()
    { 
      
        $cryptocoins = $this->common_model->get_all('dbt_cryptocoin', array(), 'coin_position', 'desc', 0, 50);
        $coin_stream = array();

        foreach ($cryptocoins as $coin_key => $coin_value) {

            array_push($coin_stream, "5~CCCAGG~".$coin_value->symbol."~USD");

        }

        echo json_encode($coin_stream);
    }

    public function coinmarket()
    {

        $cat_id = $this->web_model->catidBySlug($this->uri->segment(1));

        //Language setting
        $data['lang']           = $this->langSet();        

        $data['title']          = $this->uri->segment(1);
        $data['article']        = $this->web_model->article($cat_id->cat_id);
        $data['cat_info']       = $this->web_model->cat_info($this->uri->segment(1));

        /******************************
        * Pagination Start
        ******************************/
        $config["base_url"]         = base_url('coinmarket/');
        $config["total_rows"]       = $this->db->count_all('cryptolist');
        $config["per_page"]         = 15;
        $config["uri_segment"]      = 2;
        $config["last_link"]        = "Last"; 
        $config["first_link"]       = "First"; 
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';  
        $config['full_tag_open']    = "<ul class='pagination col-xs pull-right'>";
        $config['full_tag_close']   = "</ul>";
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']    = '</li>';
        $config['cur_tag_open']     = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close']    = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open']    = "<li>";
        $config['next_tag_close']   = "</li>";
        $config['prev_tag_open']    = "<li>";
        $config['prev_tagl_close']  = "</li>";
        $config['first_tag_open']   = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open']    = "<li>";
        $config['last_tagl_close']  = "</li>";
        /* ends of bootstrap */
        $this->pagination->initialize($config);
        $page   = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $data['cryptocoins']    = $this->web_model->cryptoCoin($config["per_page"], $page);
        $data["links"]          = $this->pagination->create_links();

        /******************************
        * Pagination ends
        ******************************/

        $this->load->view('website/header', $data);     
        $this->load->view('website/coinmarket', $data);
        $this->load->view('website/footer', $data);
        
    }


    public function page()
    {

        $checkId = $this->common_model->findById('web_category', array('slug' => $this->request->uri->getSegment(2), 'status' => 1));

        if (empty($this->common_model->findById('web_category', array('slug' => $this->request->uri->getSegment(2), 'status' => 1)))) {
          return redirect()->to(base_url());
        }

        $cat_id  = $this->common_model->findById('web_category', array('slug' => $this->request->uri->getSegment(2), 'status' => 1));
        $data['cat_info']   = $this->common_model->findById('web_category', array('slug' => $this->request->uri->getSegment(2), 'status' => 1));
        $data['article']    = $this->common_model->get_all('web_article', array('cat_id' => $data['cat_info']->cat_id), 'article_id', 'asc', 12, 0);

        if ($this->request->uri->getSegment(2) == 'faq') {

            $data['module'] = "Website";
            $data['page']   = 'website/faq'; 
            return $this->master->master($data);

        } else {
        
            $data['module'] = "Website";
            $data['page']   = 'website/page'; 
            return $this->master->master($data);
        }        
    }

    public function contact()
    {

        $data['db'] =  db_connect();

        $data['settings'] = $this->common_model->findById('setting', array());
        $map_api          = $this->common_model->findById('external_api_setup', array('id'=>2));
        $data['map_api']  = json_decode($map_api->data);
  
        $data['module'] = "Website";
        $data['page']   = 'website/contact'; 
        return $this->master->master($data);
    }

     //Ajax Contact Message Action
    public function contactMsg()
    {
        $appSetting = $this->common_model->findById('setting', array());
        
        $data['fromName']       = $this->request->getPost('first_name', FILTER_SANITIZE_STRING)." ".$this->request->getPost('last_name', FILTER_SANITIZE_STRING);
        $data['from']           = $this->request->getPost('email', FILTER_SANITIZE_STRING);
        $data['title']          = "User Message";
        $data['to']             = $appSetting->email;
        $data['subject']        = display('leave_us_a_message');
       $data['message']         = "<b>".display('name').": </b>".$data['fromName']."<br><b>".display('email').": </b>".$data['from']."<br><b>".display('phone').": </b>".$this->input->post('phone', TRUE)."<br><b>".display('company').": </b>".$this->input->post('company', TRUE)."<br><b>".display('message').": </b>".$this->input->post('comment', TRUE);

        $this->common_model->send_email($data);

    }

    public function settings(){
        $appSetting = $this->common_model->findById('setting', array());
        echo json_encode($appSetting);
    }
    //Ajax Chat Message Action
    public function ajaxMessageChat()
    {
        $message = $this->request->getPost('message', FILTER_SANITIZE_STRING);

        $this->validation->setRule('message', 'message','required|max_length[100]|trim');

        $data = array();
        if ($this->validation->withRequest($this->request)->run()) 
        {
            $data['messageInfo'] = array(
                'user_id'   =>  $this->session->get('user_id'),
                'message'   =>  $message,
                'datetime'  =>  date('Y-m-d H:i:s'),
            );
            $data['userInfo'] = $this->common_model->findById('dbt_user', array('user_id' => $this->session->get('user_id')));
            $this->common_model->save('dbt_chat', $data['messageInfo']);
        }

        if(!empty($data)){
            echo json_encode($data);
        } else {
            echo 2;
        }
    }

    //Ajax Chat Message Action
    public function jsonMessageStream()
    {

        //$message = $this->db->table('dbt_chat')->select('*')->orderBy('datetime', 'desc')->limit(10)->get()->getResult();
        $message = $this->web_model->autoLoadChat($this->session->get('user_id'));

        $messages = array();

        foreach ($message as $key => $value) {

            array_push($messages, array(

                'message'  => $value->message,
                'datetime' => $value->datetime,
                'image'    => $value->image

                )
            );
        }

        echo json_encode($messages);
    }

    public function exchange_page()
    {

        $data = array();

        $data['db']             =  db_connect();
        $data['session']        =  \Config\Services::session();
        $data['lang']           = $this->langSet();
        $data['web_language']   = $this->common_model->findById('web_language', array('id' => 1));
        $data['settings']       = $this->common_model->findById('setting', array());
        $data['userinfo']       = $this->common_model->findById('dbt_user', array('user_id' => $this->session->get('user_id')));
        $market_symbol          = $this->request->getVar('market', FILTER_SANITIZE_STRING);
        $data['market_symbol']  = $this->request->getVar('market', FILTER_SANITIZE_STRING);
        $coin_symbol            = explode('_', $market_symbol);
        $data['coin_symbol']    = $coin_symbol;
        $data['adapter_symbol'] = $market_symbol;

        if (!$market_symbol) {

           $query_pair = $this->db->table('dbt_coinpair')->select('*')->where('status', 1)->orderBy('id','asc')->get()->getRow(); 
           return redirect()->to(base_url("exchange/?market=".@$query_pair->symbol));
        }

        $data['balance_to']     = $this->common_model->findById('dbt_balance', array('user_id' => $this->session->get('user_id'), 'currency_symbol' =>$coin_symbol[1]));
        $data['fee_to']         = $this->common_model->findById('dbt_fees', array('level' => 'BUY', 'currency_symbol' => $coin_symbol[1]));
        $data['balance_from']   = $this->common_model->findById('dbt_balance', array('user_id' => $this->session->get('user_id'), 'currency_symbol' =>$coin_symbol[0]));
        $data['fee_from']       = $this->common_model->findById('dbt_fees', array('level' => 'SELL', 'currency_symbol' => $coin_symbol[0]));
        $data['coin_markets']   = $this->common_model->findAll('dbt_market', array('status' => 1), 'id','asc');
        $data['coin_pairs']     = $this->common_model->findAll('dbt_coinpair', array('status' => 1),  'id','desc');
        $cat_id                 = $this->web_model->catidBySlug('notice');
        $data['notice']         = $this->common_model->get_all('web_article', array('cat_id' => $cat_id->cat_id),'article_id', 'desc', 3, 0);
        $data['market_details'] = $this->common_model->findById('dbt_coinpair', array('symbol' => $market_symbol, 'status' => 1));

        @$cat_id = $this->web_model->catidBySlug('exchange');
        $data['article']        = $this->web_model->article(@$cat_id->cat_id);
        $data['news']           = $this->db->table('web_news')->select("*")->orderBy('article_id', 'desc')->limit(7)->get()->getResult();

        $data['news_cat']       = $this->db->table('web_category')->select("*")->where('slug', 'news')->get()->getRow();

        return view("App\Modules\Website\Views\website/exchange_theme", $data);

    }

    public function balances()
    {
        if(empty($this->session->get('user_id')))
            return redirect()->to('login');

        $data['balances'] = $this->common_model->findAll('dbt_balance', array('user_id' => $this->session->get('user_id')), 'id', 'desc');
        $data['total']    = $this->web_model->checkUserAllBalance($this->session->get('user_id'));
        $page_number      = (!empty($this->request->getVar('page'))?$this->request->getVar('page'):1);
        //findAll paramiter = where, limit, offset.
        $data['coin_list']= $this->common_model->get_all('dbt_cryptocoin', array('status' => 1), 'id', 'asc', 10,($page_number-1)*10);
        $total            = $this->common_model->countRow('dbt_cryptocoin', array('status' => 1));
        $data['pager']    = $this->pager->makeLinks($page_number, 10, $total);


        $data['module']    = "Website";
        $data['page']      = 'website/balances'; 
        return $this->master->master($data);

    }

    public function open_order()
    {
        if(empty($this->session->get('user_id')))
            return redirect()->to('login');

        $data['title']       = "Open Trade";
        $data['open_trade']  = $this->common_model->findAll('dbt_biding', array('user_id' => $this->session->get('user_id'), 'status' => 2), 'id', 'desc');

        $data['module'] = "Website";
        $data['page']   = 'website/open_order'; 
        return $this->master->master($data);

    }

    public function complete_order()
    {

        if(empty($this->session->get('user_id')))
            return redirect()->to('login');

        $data['title']           = "Complete Order";
        $data['complete_trade']  = $this->common_model->findAll('dbt_biding', array('user_id' => $this->session->get('user_id'), 'status' => 1), 'id', 'desc');

        $data['module'] = "Website";
        $data['page']   = 'website/complete_order'; 
        return $this->master->master($data);

    }

    public function trade_history()
    {
        if(empty($this->session->get('user_id')))
            return redirect()->to('login');

        $data['title']              = "Trade History";
        $data['user_trade_history'] = $this->web_model->userTradeHistory($this->session->get('user_id'));

        $data['module'] = "Website";
        $data['page']   = 'website/trade_history'; 
        return $this->master->master($data);
    }

    public function profile()
    {
        if(empty($this->session->get('user_id')))
            return redirect()->to('login');

        $data['title']      = "Profile";
        $data['user_info']  = $this->common_model->findById('dbt_user', array('user_id' => $this->session->get('user_id')));
        $data['user_log']   = $this->common_model->get_all('dbt_user_log', array('user_id' => $this->session->get('user_id')), "log_id", 'desc', 10, 0);
       
        $data['module']     = "Website";
        $data['page']       = 'website/profile'; 
        return $this->master->master($data);

    }

    public function profile_verify()
    {
        if(empty($this->session->get('user_id')))
            return redirect()->to('login');

        $data['title']  = "Profile Verify";
        $date           = new \DateTime();
        $submit_time    = $date->format('Y-m-d H:i:s');

        $this->validation->setRule('verify_type', 'verify_type','required|trim');
        $this->validation->setRule('first_name', display('firstname'),'required|max_length[20]|trim');
        $this->validation->setRule('last_name', display('lastname'),'required|max_length[20]|trim');
        $this->validation->setRule('gender', 'gender','required|trim');
        $this->validation->setRule('id_number', display('id_numder'),'required|max_length[20]|alpha_numeric|trim');

       
        //From Validation Check
        if($this->request->getMethod() == 'post'){

            $checkVerifyStatus = $this->common_model->findById('dbt_user', array('user_id' => $this->session->get('user_id')));

            if($checkVerifyStatus->verified == 3){ 

                $this->session->setFlashdata('exception', '<script type="text/javascript">toastr.warning("Your verification already processing!")</script>');
                return redirect()->to(base_url("profile"));

            } else {

                if(!empty($this->request->getFile('document1'))){
                    $this->validation->setRule('document1', display('image'), 'ext_in[document1,png,jpg,gif,ico]|is_image[document1]');
                }
                if(!empty($this->request->getFile('document2'))){
                    $this->validation->setRule('document2', display('image'), 'ext_in[document2,png,jpg,gif,ico]|is_image[document2]');
                }

                if($this->validation->withRequest($this->request)->run() && $this->request->getFile('document1')){

                    $document1 = $this->imageupload->upload_image($this->request->getFile('document1'), 'upload/documents/', $this->request->getPost('document1'), 500, 500);
                } else {
                    $document1 = "";
                }

                if($this->validation->withRequest($this->request)->run() && $this->request->getFile('document2')){

                    $document2 = $this->imageupload->upload_image($this->request->getFile('document2'), 'upload/documents/', $this->request->getPost('document2'), 500, 500);
                } else {
                    $document2 = "";
                }
                
                if ($this->validation->withRequest($this->request)->run()) 
                {

                    $data['verify_info']   = (object)$verify_info = array(
                        'user_id'     => $this->session->get('user_id'),
                        'verify_type' => $this->request->getPost('verify_type', FILTER_SANITIZE_STRING), 
                        'first_name'  => $this->request->getPost('first_name', FILTER_SANITIZE_STRING),
                        'last_name'   => $this->request->getPost('last_name', FILTER_SANITIZE_STRING),
                        'gender'      => $this->request->getPost('gender', FILTER_SANITIZE_STRING),
                        'id_number'   => $this->request->getPost('id_number', FILTER_SANITIZE_STRING),
                        'document1'   => $document1,
                        'document2'   => $document2,
                        'date'        => $submit_time
                    );

                    if ($this->common_model->save('dbt_user_verify_doc', $verify_info)) {

                        //Update User table for Verify Processing
                        $this->common_model->update('dbt_user', array('verified' => 3), array('user_id' => $this->session->get('user_id')));
                        $this->session->setFlashdata('message', '<script type="text/javascript">toastr.success("Verification is being processed!")</script>');

                    } else {
                        $this->session->setFlashdata('exception', display('please_try_again'));

                    }

                    return redirect()->to(base_url("profile"));
                } else {

                    $this->session->setFlashdata("exception", $this->validation->listErrors());
                }
            }
        }

        $data['module'] = "Website";
        $data['page']   = 'website/profile_verify'; 
        return $this->master->master($data);

    }

    public function deposit($deposit_coin = null)
    {

        if(empty($this->session->get('user_id')))
            return redirect()->to('login');

        if ($this->session->get('deposit')) {
            unset($_SESSION['deposit']);
        }

        $document = $this->request->getFile('document');

        $this->validation->setRule('crypto_coin', display('cryptocoin'),'required|alpha_numeric|trim');
        $this->validation->setRule('amount', display('amount'),'required|numeric|greater_than[0]|trim');
        $this->validation->setRule('method', display('payment_method'),'required|alpha_numeric|trim');

        if($this->request->getMethod() == 'post' && !empty(@$document)){
            $this->validation->setRule('document', "This Document", 'ext_in[document,png,jpg,gif,ico,pdf,word,txt]');
        }

        $deposit_date   = date('Y-m-d H:i:s');
        if($this->request->getMethod() == 'post'){

            if ($this->validation->withRequest($this->request)->run()) 
            {
                
                if ($this->request->getPost('method')=='phone') {
                    $mobiledata =  array(
                        'om_name'         => $this->request->getPost('om_name', FILTER_SANITIZE_STRING),
                        'om_mobile'       => $this->request->getPost('om_mobile', FILTER_SANITIZE_STRING),
                        'transaction_no'  => $this->request->getPost('transaction_no', FILTER_SANITIZE_STRING),
                        'idcard_no'       => $this->request->getPost('idcard_no', FILTER_SANITIZE_STRING),
                    );
                    $comment = json_encode($mobiledata);

                }else if ($this->request->getPost('method')=='bank') {

                    $user_id     = $this->session->get('user_id'); 
                    $crypto_coin = $this->request->getPost('crypto_coin', FILTER_SANITIZE_STRING); 

                    $user_bank = $this->common_model->findById('dbt_payout_method', array('method' => 'bank', 'currency_symbol' => $crypto_coin, 'user_id' => $user_id));

                    if ($user_bank) {                    
                        $jsondecode_bank = json_decode($user_bank->wallet_id, true);

                        $filePath = $this->imageupload->doUpload('upload/documents/', $this->request->getFile('document'));
                        
                        $jsondecode_bank['document'] = $filePath;

                        $comment = json_encode($jsondecode_bank);

                    } else {

                        $this->session->setFlashdata('exception', display('please_setup_your_bank_account'));
                        return  redirect()->to(base_url('bank-setting'));
                    }

                } else {

                    $comment = $this->request->getPost('comment', FILTER_SANITIZE_STRING);
                }

                // check balance            
                $fees_val = $this->common_model->findById('dbt_fees', array('level' => "DEPOSIT", 'currency_symbol' => $this->request->getPost('crypto_coin')));
                //Fees in Percent
                $fees = ($this->request->getPost('amount', FILTER_SANITIZE_STRING)/100)*@$fees_val->fees;

                $sdata['deposit']   = (object)$userdata = array(

                    'user_id'        => $this->session->get('user_id'),
                    'currency_symbol'=> $this->request->getPost('crypto_coin', FILTER_SANITIZE_STRING),
                    'amount'         => $this->request->getPost('amount', FILTER_SANITIZE_STRING),
                    'method_id'      => $this->request->getPost('method', FILTER_SANITIZE_STRING),
                    'fees_amount'    => $fees,
                    'comment'        => $comment,
                    'status'         => 0,
                    'deposit_date'   => $deposit_date,
                    'ip'             => $this->request->getIPAddress()
                );

                //Store Deposit Session Data
                $this->session->set($sdata);
                return  redirect()->to(base_url('payment-process'));
            } else {
                 $this->session->setFlashdata("exception", $this->validation->listErrors());
            }
        }

        $data['payment_gateway'] = $this->common_model->findAll('payment_gateway', array('status' => 1), 'id', 'asc');
        $data['coin_list']       = $this->common_model->findAll('dbt_cryptocoin', array('status' => 1), 'rank', 'asc');

        $data['module']    = "Website";
        $data['page']      = 'website/deposit'; 
        return $this->master->master($data);

    }

    public function payment_process()
    {
        $data['deposit'] = $this->session->get('deposit');

        //Payment Type specify for callback (deposit/buy/sell etc )
        $this->session->set('payment_type', 'deposit');

        $method                 = $data['deposit']->method_id;
        $data['deposit_data']   = $this->payment->payment_process($data['deposit'], $method);


        if (!$data['deposit_data']) {
            $this->session->setFlashdata('exception', display('this_gateway_deactivated'));
            return  redirect()->to(base_url('deposit'));
        }
        if($data['deposit']->method_id == "token"){
            
            $data['gateway'] = $this->common_model->findById('payment_gateway', array('identity' => 'token', 'status' => 1)); 
        }

        $data['module']    = "Website";
        $data['page']      = 'website/payment_process'; 
        return $this->master->master($data);

    }

    public function withdraw($deposit_coin = null)
    {
        if(empty($this->session->get('user_id')))
            return redirect()->to('login');

        $this->validation->setRule('amount', display('amount'), 'required|numeric|greater_than[0]|trim'); 
        $this->validation->setRule('crypto_coin', display('cryptocoin'), 'required|alpha_numeric|trim'); 
        $this->validation->setRule('varify_media', display('otp_send_to'), 'required|trim');

        if($this->request->getPost('method') == 'coinpayment' || $this->request->getPost('method') == 'token')
        {
            $this->validation->setRule('wallet_address', 'Your Address', 'required|max_length[50]|trim');
        } else {

            $this->validation->setRule('walletid', display('wallet_id'), 'required|trim');
        } 

        if($this->request->getMethod() == 'post'){

            if ($this->validation->withRequest($this->request)->run()){ 

                $amount         = $this->request->getPost('amount', FILTER_SANITIZE_STRING);
                $crypto_coin    = $this->request->getPost('crypto_coin', FILTER_SANITIZE_STRING);
                $varify_media   = $this->request->getPost('varify_media', FILTER_SANITIZE_STRING);
                $walletid       = $this->request->getPost('walletid');

                $appSetting     = $this->common_model->findById('setting', array());
                $varify_code    = $this->randomID();            
                $userinfo       = $this->common_model->findById('dbt_user', array('user_id' => $this->session->get('user_id')));

                // check balance            
                $fees_val = $this->common_model->findById('dbt_fees', array('level' => 'WITHDRAW', 'currency_symbol' => $crypto_coin));
                $balance  = $this->common_model->findById('dbt_balance', array('user_id' => $this->session->get('user_id'), 'currency_symbol' => $crypto_coin));

                //Fees in Percent
                $fees = ($amount/100) * @$fees_val->fees;

                $where = "WEEK(`request_date`) = WEEK(CURDATE()) AND YEAR(`request_date`) = YEAR(CURDATE()) AND MONTH(`request_date`) = MONTH(CURDATE()) AND currency_symbol = '".$crypto_coin."' AND status !=0";
                
                $balance7days = $this->db->table('dbt_withdraw')->select('sum(amount)')->where($where)->where('user_id', $userinfo->user_id)->get()->GetRow();

                //Withdraw Limit Check (VERIFIED/UNVERIFIED)

                if ($userinfo->verified == 1){
                    
                    $trnSetup = $this->common_model->findById('dbt_transaction_setup', array('trntype' => 'WITHDRAW', 'acctype' => 'VERIFIED', 'currency_symbol' => $crypto_coin, 'status' => 1));
                    if ($trnSetup) {
                        if (@$trnSetup->upper <= (@$balance7days->amount+$amount+@$fees)) {
                            $this->session->setFlashdata('exception', display('your_weekly_limit_exceeded'));

                            return  redirect()->to(base_url('withdraw'));
                        }
                    }
                    
                } else {
                    
                    $trnSetup = $this->common_model->findById('dbt_transaction_setup', array('trntype' => 'WITHDRAW', 'acctype' => 'UNVERIFIED', 'currency_symbol' => $crypto_coin, 'status' => 1));

                    if ($trnSetup) {
                        if (@$trnSetup->upper <= (@$balance7days->amount+$amount+@$fees)) {
                            $this->session->setFlashdata('exception', display('your_weekly_limit_exceeded'));
                            return  redirect()->to(base_url('withdraw'));
                        }
                    }
                    
                }
                
                $pending_withdraw = $this->db->table('dbt_withdraw')->select('SUM(amount)+SUM(fees_amount) as amount',FALSE)->where('status', 2)->where('user_id', $userinfo->user_id)->where('currency_symbol', $crypto_coin)->get()->getRow();

                $available_balance = ((float)@$pending_withdraw->amount + $amount + $fees);

                if(@$balance->balance < @$available_balance){

                   $this->session->setFlashdata('exception', display('balance_is_unavailable'));
                   return  redirect()->to(base_url('withdraw'));

                } else {

                    if($varify_media == 2){

                        /***************************
                        *      Email Verify SMTP
                        ***************************/
                        $post = array(
                            'title'        => $appSetting->title,
                            'to'           => $this->session->get('email'),
                            'amount'       => $crypto_coin." ".$this->request->getPost('amount'),
                            'varify_code'  => $varify_code
                        );
                    
                        $config_var = array( 
                            'template_name' => 'withdraw_verification',
                            'template_lang' => $this->langSet() == 'english'?'en':'fr',
                        );
                        $message    = $this->common_model->email_msg_generate($config_var, $post);
                        $send_email = array(
                            'title'         => $appSetting->title,
                            'to'            => $this->session->get('email'),
                            'subject'       => $message['subject'],
                            'message'       => $message['message'],
                        );

                        $code_send = $this->common_model->send_email($send_email);

                    } else {
                    
                        /***************************
                        *      SMS Verify
                        ***************************/ 

                        $template = array( 
                            'amount'        => $this->request->getPost('crypto_coin')." ".$this->request->getPost('amount', FILTER_SANITIZE_STRING),
                            'varify_code'   => $varify_code
                        );

                        $config_var = array( 
                            'template_name' => 'withdraw_verification',
                            'template_lang' => $this->langSet() == 'english'?'en':'fr',
                        );
                        $message    = $this->common_model->sms_msg_generate($config_var, $template);

                        $send_sms = array(
                            'to'        => $userinfo->phone,
                            'template'  => $message['message'],
                        );
                        
                        if (@$userinfo->phone) {

                           $code_send = $this->sms_lib->send($send_sms);
                        } else {

                            $this->session->setFlashdata('exception', display('there_is_no_phone_number'));
                        }
                        
                    }

                    if(@$code_send != NULL){

                        // GET withdraw fees
                        if($this->request->getPost('method')=='coinpayment' || $this->request->getPost('method')=='token'){
                            $wallet_id = $this->request->getPost('wallet_address');
                        } else {
                            $wallet_id = $this->request->getPost('walletid');
                        }

                        $withdraw = array(
                            'user_id'         => $this->session->get('user_id'),
                            'wallet_id'       => $wallet_id,
                            'currency_symbol' => $this->request->getPost('crypto_coin', FILTER_SANITIZE_STRING),
                            'amount'          => $this->request->getPost('amount', FILTER_SANITIZE_STRING),
                            'method'          => $this->request->getPost('method', FILTER_SANITIZE_STRING),
                            'fees_amount'     => $fees,
                            'comment'         => '',    
                            'request_date'    => date('Y-m-d H:i:s'),                    
                            'status'          => 2,                
                            'ip'              => $this->request->getIPAddress(),
                        );

                        $varify_data = array(
                            'ip_address'    => $this->request->getIPAddress(),
                            'user_id'       => $this->session->get('user_id'),
                            'session_id'    => $this->session->get('isLogIn'),
                            'verify_code'   => $varify_code,
                            'data'          => json_encode($withdraw)
                        );

                        $result = $this->common_model->save_return_id('dbt_verify', $varify_data);

                        return  redirect()->to(base_url('withdraw-confirm/'.$result));

                    } else {
                        $this->session->setFlashdata('exception', display('server_problem'));
                        return  redirect()->to(base_url('withdraw'));
                    }

                }     
            } else {

                $this->session->setFlashdata("exception", $this->validation->listErrors());
            }
        }

        $data['payment_gateway'] = $this->common_model->findAll('payment_gateway', array('status' => 1), 'id', 'asc');
        $data['coin_list']       = $this->common_model->findAll('dbt_cryptocoin', array('status' => 1), 'rank', 'asc');

        $data['module']    = "Website";
        $data['page']      = 'website/withdraw'; 
        return $this->master->master($data);

    }

    public function withdraw_confirm($id = null){

        $data['v'] = $this->common_model->findById('dbt_verify', array('id' => $id, 'session_id' => $this->session->get('isLogIn')));

        if($data['v'] != NULL){

            $data['title'] = "withdraw confirm";
            
        } else {

            return redirect()->to(base_url('withdraw'));
        }

        $data['module'] = "Website";
        $data['page']   = 'website/confirm_withdraw'; 
        return $this->master->master($data);
    }

    public function withdraw_verify()
    {

        $code   = $this->request->getPost('code', FILTER_SANITIZE_STRING);
        $id     = $this->request->getPost('id', FILTER_SANITIZE_STRING);

        $data = $this->common_model->findById('dbt_verify', array('verify_code' => $code, 'id' => $id, 'session_id' => $this->session->get('isLogIn'), 'status' => 1));

        $userinfo = $this->common_model->findById('dbt_user', array('user_id' => $this->session->get('user_id')));

        if($data != NULL) {

            $t_data = ((array) json_decode($data->data));

            $udata['status'] = 0;

            $this->common_model->update('dbt_verify', $udata, array('id' => $this->request->getPost('id', FILTER_SANITIZE_STRING), 'session_id' => $this->session->get('isLogIn'))); 

            $wdstatus  = $this->web_model->coinpayment_withdraw(); 
           
            if($t_data['method'] == "coinpayment" && $wdstatus == 1){      
                       
                $method = $t_data['method'];
                $withdraw_result = $this->payment->payment_withdraw($t_data,$method);

                if($withdraw_result['error']=='ok'){

                    $txn_id = $withdraw_result['result']['id'];
                    $t_data['comment'] = $txn_id;
                    $result = $this->common_model->save_return_id('dbt_withdraw', $t_data);

                } else {

                    $this->session->setFlashdata("exception",$withdraw_result);
                }

            } else {

                $result = $this->common_model->save_return_id('dbt_withdraw', $t_data);
            }

            $this->session->setFlashdata('message', display('withdraw_successfull'));
            echo $result;

        } else {

            echo '';

        }
    }

    public function withdraw_details($id = NULL)
    {
        $user_id          = $this->session->get('user_id');
        $data['my_info']  = $this->common_model->findById('dbt_user', array('user_id' => $user_id));
        $data['withdraw'] = $this->common_model->findById('dbt_withdraw', array('id' => $id,'user_id' => $user_id));
       
        $data['module'] = "Website";
        $data['page']   = 'website/withdraw_details'; 
        return $this->master->master($data);
    }

    public function transfer()
    {

       if(empty($this->session->get('user_id')))
            return redirect()->to('login');

        $this->validation->setRule('receiver_id', display('receiver_id'), 'required|alpha_numeric|trim'); 
        $this->validation->setRule('amount', display('amount'), 'required|numeric|greater_than[0]|trim'); 
        $this->validation->setRule('varify_media', display('otp_send_to'), 'required|alpha_numeric|trim');  

        if($this->validation->withRequest($this->request)->run()){

            $crypto_coin    = $this->request->getPost('crypto_coin', FILTER_SANITIZE_STRING);
            $varify_media   = $this->request->getPost('varify_media', FILTER_SANITIZE_STRING);
            $receiver_id    = $this->request->getPost('receiver_id', FILTER_SANITIZE_STRING);
            $amount         = $this->request->getPost('amount', FILTER_SANITIZE_STRING);
            $varify_code    = $this->randomID();

            $existReceiver  = $this->common_model->findById('dbt_user', array('user_id' => $receiver_id));
           
            if (empty($existReceiver)) {

               $this->session->setFlashdata('exception', display('receiver_not_valid'));
               return redirect()->to(base_url('transfer'));
            }

            $appSetting = $this->common_model->findById('setting', array());
            $userinfo   = $this->common_model->findById('dbt_user', array('user_id' => $this->session->get('user_id')));

            // check balance            
            $fees_val   = $this->common_model->findById('dbt_fees', array('level' => 'TRANSFER', 'currency_symbol' => $crypto_coin));
            $balance    = $this->common_model->findById('dbt_balance', array('user_id' => $this->session->get('user_id'), 'currency_symbol' => $crypto_coin));

            //Fees in Percent
            $fees = ($amount/100)*@$fees_val->fees;

            $where = "WEEK(`date`) = WEEK(CURDATE()) AND YEAR(`date`) = YEAR(CURDATE()) AND MONTH(`date`) = MONTH(CURDATE())  AND currency_symbol = '".$crypto_coin."'";

            $balance7days = $this->db->table('dbt_transfer')->select('sum(amount)')->where($where)->where('sender_user_id', $userinfo->user_id)->get()->GetRow();

            //Withdraw Limit Check (VERIFIED/UNVERIFIED)
            if ($userinfo->verified == 1){
               
                $trnSetup = $this->db->table('dbt_transaction_setup')->select('*')->where('trntype', 'TRANSFER')->where('acctype', 'VERIFIED')->where('currency_symbol', $crypto_coin)->where('status', 1)->get()->GetRow();
                if ($trnSetup) {
                    if (@$trnSetup->upper < (@$balance7days->amount+$amount+$fees)) {
                        $this->session->setFlashdata('exception', display('your_weekly_limit_exceeded'));
                       return redirect()->to(base_url('transfer'));
                    }
                }
                
            } else {
               
                $trnSetup = $this->db->table('dbt_transaction_setup')->select('*')->where('trntype', 'TRANSFER')->where('acctype', 'UNVERIFIED')->where('currency_symbol', $crypto_coin)->where('status', 1)->get()->GetRow();

                if ($trnSetup) {
                    if (@$trnSetup->upper < (@$balance7days->amount+$amount+$fees)) {
                        $this->session->setFlashdata('exception', display('your_weekly_limit_exceeded'));
                        return redirect()->to(base_url('transfer'));
                    }
                }
            }
          
            $pending_withdraw = $this->db->table('dbt_withdraw')->select('SUM(amount)+SUM(fees_amount) as amount',FALSE)->where('currency_symbol', $crypto_coin)->where('status', 2)->where('user_id', $userinfo->user_id)->get()->GetRow();

            if((@$balance->balance-(float)@$pending_withdraw->amount) < ($amount+$fees) && ($amount+$fees)<0){

                $this->session->setFlashdata('exception', display('balance_is_unavailable'));
                return redirect()->to(base_url('transfer'));

            } else {
                
                if($varify_media == 2){
                    /***************************
                    *   Email Verify SMTP
                    ***************************/
                    $post = array(
                        'title'        => $appSetting->title,
                        'to'           => $this->session->get('email'),
                        'amount'       => $crypto_coin." ".$amount,
                        'receiver_id'  => $receiver_id,
                        'varify_code'  => $varify_code
                    );
                    
                    $config_var = array( 
                        'template_name' => 'transfer_verification',
                        'template_lang' => $this->langSet() == 'english'?'en':'fr',
                    );
                    $message    = $this->common_model->email_msg_generate($config_var, $post);
                    $send_email = array(
                        'title'         => $appSetting->title,
                        'to'            => $this->session->get('email'),
                        'subject'       => $message['subject'],
                        'message'       => $message['message'],
                    );

                    $code_send = $this->common_model->send_email($send_email);

                } else {                    
                    /***************************
                    *   SMS Verify
                    ***************************/
                    $template = array( 
                        'name'          => $this->session->get('fullname'),
                        'amount'        => $this->request->getPost('crypto_coin')." ".$amount,
                        'receiver_id'   => $receiver_id,
                        'code'          => $varify_code
                    );

                    $config_var = array( 
                        'template_name' => 'transfer_verification',
                        'template_lang' => $this->langSet() == 'english'?'en':'fr',
                    );
                    $message    = $this->common_model->sms_msg_generate($config_var, $template);
                    $send_sms = array(
                        'to'        => $userinfo->phone,
                        'template'  => $message['message'],
                    );

                    if (@$userinfo->phone) {

                       $code_send = $this->sms_lib->send($send_sms);

                    } else {

                        $this->session->setFlashdata('exception', display('there_is_no_phone_number'));
                    }
                }

                if(@$code_send != NULL){                    

                    $transfar = array(
                        'sender_user_id'    => trim($this->session->get('user_id')),
                        'receiver_user_id'  => trim($this->request->getPost('receiver_id', FILTER_SANITIZE_STRING)),
                        'amount'            => $this->request->getPost('amount', FILTER_SANITIZE_STRING),
                        'currency_symbol'   => $this->request->getPost('crypto_coin', FILTER_SANITIZE_STRING),
                        'fees'              => $fees,
                        'request_ip'        => $this->request->getipAddress(),
                        'date'              => date('Y-m-d H:i:s'),
                        'comments'          => $this->request->getPost('comments', FILTER_SANITIZE_STRING),
                        'status'            => 1,
                    );

                    $varify_data = array(

                        'ip_address'    => $this->request->getipAddress(),
                        'user_id'       => $this->session->get('user_id'),
                        'session_id'    => $this->session->get('isLogIn'),
                        'verify_code'   => $varify_code,
                        'data'          => json_encode($transfar)
                    );

                    $result = $this->common_model->save_return_id('dbt_verify', $varify_data);
                    return redirect()->to(base_url('transfer-confirm/'.$result));

                } else {

                    $this->session->setFlashdata('exception', display('server_problem'));
                    return redirect()->to(base_url('transfer'));
                }
            }
        }
        $data['coin_list'] = $this->common_model->findAll('dbt_cryptocoin', array('status' => 1), 'rank', 'asc');
        $data['module']    = "Website";
        $data['page']      = 'website/transfer'; 
        return $this->master->master($data);
    }

    // confirm_transfer
    public function transfer_confirm($id = null)
    {

        $data['v']    = $this->common_model->findById('dbt_verify', array('id' => $id, 'session_id' => $this->session->get('isLogIn')));
        $receiver_id  = json_decode($data['v']->data);
        $data['user'] = $this->common_model->findById('dbt_user', array('user_id' => $receiver_id->receiver_user_id));

        if($data['v'] != NULL){

            $data['title']   = "Transfer";

        } else {

            return redirect()->to(base_url('transfer'));
        }

        $data['module']    = "Website";
        $data['page']      = 'website/confirm_transfer'; 
        return $this->master->master($data);
    }

    public function transfer_verify()
    {


        $code = $this->request->getPost('code', FILTER_SANITIZE_STRING);
        $id   = $this->request->getPost('id', FILTER_SANITIZE_STRING);

        $data = $this->common_model->findById('dbt_verify', array('verify_code' => $code, 'id' => $id, 'session_id' => $this->session->get('isLogIn'), 'status' => 1));

        $userinfo = $this->common_model->findById('dbt_user', array('user_id' => $this->session->get('user_id')));

        if($data != NULL) {

            $t_data = ((array) json_decode($data->data));
         
            $check_user_balance = $this->common_model->findById('dbt_balance', array('user_id' => $this->session->get('user_id'), 'currency_symbol' => $t_data['currency_symbol']));
        
            if(!empty($t_data['fees'])){

                $trfees = $t_data['fees'];

            } else {

                $trfees = 0;
            }

            $new_balance      = $check_user_balance->balance-($t_data['amount'] + $trfees);
            $udata['balance'] = $new_balance;
            
            $this->common_model->update('dbt_balance', $udata, array('user_id' => $this->session->get('user_id'), 'currency_symbol' => $t_data['currency_symbol']));

            //User Financial Log
            $transfertdata = array(
                'user_id'            => $t_data['sender_user_id'],
                'balance_id'         => $check_user_balance->id,
                'currency_symbol'    => $t_data['currency_symbol'],
                'transaction_type'   => 'TRANSFER',
                'transaction_amount' => $t_data['amount'],
                'transaction_fees'   => $t_data['fees'],
                'ip'                 => $t_data['request_ip'],
                'date'               => $t_data['date']
            );

            $this->common_model->save('dbt_balance_log', $transfertdata);

            //Recever Balance Update
            $check_recever_balance = $this->common_model->findById('dbt_balance', array('user_id' => $t_data['receiver_user_id'], 'currency_symbol' => $t_data['currency_symbol']));

            if ($check_recever_balance) {

                $new_balance_recever = @$check_recever_balance->balance+$t_data['amount'];
                $datau['balance']    = $new_balance_recever;

                $this->common_model->update('dbt_balance', $datau, array('user_id' => $t_data['receiver_user_id'], 'currency_symbol' => $t_data['currency_symbol']));
                //Recever Financial Log
                $receiveddata = array(
                    'user_id'            => $t_data['receiver_user_id'],
                    'balance_id'         => $check_recever_balance->id,
                    'currency_symbol'    => $t_data['currency_symbol'],
                    'transaction_type'   => 'RECEIVED',
                    'transaction_amount' => $t_data['amount'],
                    'transaction_fees'   => $t_data['fees'],
                    'ip'                 => $t_data['request_ip'],
                    'date'               => $t_data['date']
                );

                $this->common_model->save('dbt_balance_log', $receiveddata);

            } else {

                $transfar_recever = array(

                    'user_id'         => $t_data['receiver_user_id'],
                    'currency_symbol' => $t_data['currency_symbol'],
                    'balance'         => $t_data['amount'],
                    'last_update'     => date('Y-m-d H:i:s'),
                );

                $recever_balance_id = $this->common_model->save_return_id('dbt_balance', $transfar_recever);

                //Recever Financial Log
                $receiveddata = array(
                    'user_id'            => $t_data['receiver_user_id'],
                    'balance_id'         => $recever_balance_id,
                    'currency_symbol'    => $t_data['currency_symbol'],
                    'transaction_type'   => 'RECEIVED',
                    'transaction_amount' => $t_data['amount'],
                    'transaction_fees'   => $t_data['fees'],
                    'ip'                 => $t_data['request_ip'],
                    'date'               => $t_data['date']
                );

                $this->common_model->save('dbt_balance_log', $receiveddata);
            }

            $result = $this->common_model->save_return_id('dbt_transfer', $t_data);

            $appSetting = $this->common_model->findById('setting', array());
            $setsms     = $this->common_model->findById('sms_email_send_setup',array('method' => 'sms'));
            $set        = $this->common_model->findById('sms_email_send_setup',array('method' => 'email'));


            $transections_data = array(
                'user_id'                   => $this->session->get('user_id'),
                'transection_category'      => 'TRANSFER',
                'releted_id'                => $result,
                'amount'                    => $t_data['amount'],
                'comments'                  => $t_data['comments'],
                'transection_date_timestamp'=> date('Y-m-d H:i:s')
            );

            $transections_reciver_data = array(
                'user_id'                   => $t_data['receiver_user_id'],
                'transection_category'      => 'RECEIVED',
                'releted_id'                => $result,
                'amount'                    => $t_data['amount'],
                'comments'                  => $t_data['comments'],
                'transection_date_timestamp'=> date('Y-m-d H:i:s')
            );

            $this->common_model->update('dbt_verify', array('status' => 0), array('id' => $id, 'session_id' => $this->session->get('isLogIn')));
           
            if($set->transfer != NULL){

                /***************************
                *   Email Verify SMTP
                ***************************/
                $post = array(
                    'title'       => $appSetting->title,
                    'to'          => $this->session->get('email'),
                    'amount'      => @$t_data['currency_symbol'].' '.$t_data['amount'],
                    'receiver_id' => $t_data['receiver_user_id'],
                    'new_balance' => $t_data['currency_symbol'].' '.$new_balance
                );

                $config_var = array( 
                    'template_name' => 'transfer_success',
                    'template_lang' => $this->langSet() == 'english'?'en':'fr',
                );
                $message    = $this->common_model->email_msg_generate($config_var, $post);
                $text_email = array(
                    'title'   => $appSetting->title,
                    'to'      => $this->session->get('email'),
                    'subject' => $message['subject'],
                    'message' => $message['message'],
                );

                $send_email = $this->common_model->send_email($text_email);

                if($send_email){

                    $n = array(
                        'user_id'           => $this->session->get('user_id'),
                        'subject'           => $message['subject'],
                        'notification_type' => 'TRANSFER',
                        'details'           => $message['message'],
                        'date'              => date('Y-m-d H:i:s'),
                        'status'            => '0'
                    );  
                    $this->common_model->save('notifications',$n);    
                }
            }
            if($setsms->transfer != NULL){

                /***************************
                *   SMS Verify
                ***************************/
                
                //uper example code
                $template = array( 
                    'name'            => $this->session->get('fullname'),
                    'amount'          => $t_data['currency_symbol']." ".$t_data['amount'],
                    'new_balance'     => $t_data['currency_symbol']." ".$new_balance,
                    'currency_symbol' => $t_data['currency_symbol'],
                    'receiver_id'     => $t_data['receiver_user_id'],
                    'date'            => date('d F Y')
                );

                $config_var = array( 
                    'template_name' => 'transfer_success',
                    'template_lang' => $this->langSet() == 'english'?'en':'fr',
                );
                $message    = $this->common_model->sms_msg_generate($config_var, $template);
                $send_sms = array(
                    'to'        => $userinfo->phone,
                    'template'  => $message['message'],
                );

                if (@$userinfo->phone) {
                   
                    $send_sms = $this->sms_lib->send($send_sms);

                } else {
                    $this->session->setFlashdata('exception', display('there_is_no_phone_number'));
                }

                if(@$send_sms){

                    $message_data = array(

                        'sender_id'   =>1,
                        'receiver_id' => $this->session->get('user_id'),
                        'subject'     => 'Transfer',
                        'message'     => $message['message'],
                        'datetime'    => date('Y-m-d H:i:s'),
                    );   
                    $this->common_model->save('message',$message_data);    
                }
            }

            echo $id;

        } else {

            echo '';
        }
    }

    public function transfer_details($id=NULL)
    {
        if (!$this->session->get('isLogIn'))
           return redirect()->to(base_url('login'));

        $data['my_info'] = $this->common_model->findById('dbt_user', array('user_id' => $this->session->get('user_id')));
        $data['v']       = $this->common_model->findById('dbt_verify', array('id' => $id, 'session_id' => $this->session->get('isLogIn'), 'status' => 0));

        if($data['v'] != NULL){

            $datas      = (json_decode($data['v']->data)); 
            $data['u']  = $this->common_model->findById('dbt_user', array('user_id' => @$datas->receiver_user_id));
        }
        
        $data['module'] = "Website";
        $data['page']   = 'website/transfer_details'; 
        return $this->master->master($data);
    }

    public function transactions()
    {
        if (empty($this->session->get('user_id')))
           return redirect()->to(base_url('login'));

        $data['title']       = "Transactions";
        $page_number         = (!empty($this->request->getVar('page'))?$this->request->getVar('page'):1);
        $data['balance_log'] = $this->web_model->get_all_transactions(array('user_id' => $this->session->get('user_id')), 10,($page_number-1)*10);
        $total               = $this->common_model->countRow('dbt_balance_log', array('user_id' => $this->session->get('user_id')));
        $data['pager']       = $this->pager->makeLinks($page_number, 10, $total);

        $data['module']      = "Website";
        $data['page']        = 'website/transactions'; 
        return $this->master->master($data);
    }


    public function news()
    {

        $data['db'] =  db_connect();
        $data['social_link'] = $this->common_model->findAll('web_social_link', array('status' => 1), 'id', 'asc');

        $slug1 = $this->request->uri->setSilent()->getSegment(1);
        $slug2 = $this->request->uri->setSilent()->getSegment(2);
        $slug3 = $this->request->uri->setSilent()->getSegment(3);

        //For Coin Tricker
        $data['recentnews']  = $this->common_model->get_all('web_news', array(), 'article_id', 'desc', 3, 0);

        if ($slug2 == "" || $slug2 == NULL || is_numeric($slug2)) {

            //All Category News with Pagination
            $cat_id     = $this->web_model->catidBySlug($slug1)->cat_id;
            if (!$cat_id) {
                redirect(base_url('news'));
            }
            $where_add  = $this->web_model->catidBySlug('news')->cat_id;

            /******************************
            * Pagination Start
            ******************************/
           
            $page_number      = (!empty($this->request->getVar('page'))?$this->request->getVar('page'):1);
            //findAll paramiter = where, limit, offset.
            $data['news'] = $this->common_model->get_all('web_news', array(), 'article_id', 'desc', 10,($page_number-1)*10);
            $total            = $this->common_model->countRow('web_news', array());
            $data['pager']    = $this->pager->makeLinks($page_number, 10, $total);
            /******************************
            * Pagination ends
            ******************************/

            $data['advertisement']  = $this->common_model->get_all('advertisement', array('page' => $where_add, 'status' => 1), 'id', 'desc', 12, 0);
            
            $data['newscat']        = $this->web_model->newsCatListBySlug('news');
            $data['cat_info']       = $this->web_model->cat_info($slug1);

            $data['module']         = "Website";
            $data['page']           = 'website/news'; 
            $data['content']        = view('App\Modules\Website\Views\website\sidebar', $data);
            return $this->master->master($data);

        } elseif (($slug2 != "" || !is_numeric($slug2)) && ($slug3 == "" || $slug3 == NULL)) {

            @$where_add  = $this->web_model->catidBySlug('news')->cat_id;

            //Slug Category News
            $cat_id     = $this->web_model->catidBySlug($slug2)->cat_id;

            if (!$cat_id) {

              return  redirect()->to(base_url('news'));

            }
            /******************************
            * Pagination Start
            ******************************/
            $page_number      = (!empty($this->request->getVar('page'))?$this->request->getVar('page'):1);
            //findAll paramiter = where, limit, offset.
            $data['news']     = $this->common_model->get_all('web_news', array(), 'article_id', 'desc', 10,($page_number-1)*10);
            $total            = $this->common_model->countRow('web_news', array());
            $data['pager']    = $this->pager->makeLinks($page_number, 10, $total);
            /******************************
            * Pagination ends
            ******************************/

            $data['advertisement']  = $this->common_model->get_all('advertisement', array('page' => $where_add, 'status' => 1), 'id', 'desc', 12, 0);
            $data['newscat']        = $this->common_model->get_all('web_category', array('parent_id' => $cat_id), 'cat_id', 'desc', 100, 0);
            $data['cat_info']       = $this->web_model->cat_info($slug1);

            $data['module']         = "Website";
            $data['page']           = 'website/news'; 
            $data['content']        = view('App\Modules\Website\Views\website\sidebar', $data);
            return $this->master->master($data);

        }
        elseif ($slug3 == "" || $slug3 == NULL || is_numeric($slug3)) {

            @$where_add  = $this->web_model->catidBySlug('news')->cat_id;

            //Slug Category News with Pagination
            $cat_id     = $this->web_model->catidBySlug($slug2)->cat_id;

            if (!$cat_id) {

                redirect(base_url('news'));
            }
            /******************************
            * Pagination Start
            ******************************/
            $page_number      = (!empty($this->request->getVar('page'))?$this->request->getVar('page'):1);
            //findAll paramiter = where, limit, offset.
            $data['news']     = $this->common_model->get_all('web_news', array('status' => 1), 'article_id', 'desc', 10,($page_number-1)*10);
            $total            = $this->common_model->countRow('web_news', array());
            $data['pager']    = $this->pager->makeLinks($page_number, 10, $total);
            /******************************
            * Pagination ends
            ******************************/
            
            $data['advertisement']  = $this->common_model->get_all('advertisement', array('page' => $where_add, 'status' => 1), 'article_id', 'desc', 12, 0);
            $data['newscat']        = $this->common_model->get_all('web_category', array('parent_id' => $cat_id->cat_id, 'status' => 1), 'cat_id', 'desc', 100, 0);
            $data['cat_info']       = $this->web_model->cat_info($slug1);

            $data['module']         = "Website";
            $data['page']           = 'website/news'; 
            $data['content']        = view('App\Modules\Website\Views\website\sidebar', $data);
            return $this->master->master($data);

        }
        elseif ($slug3 != "" || !is_numeric($slug3)) {
            //Slug Category News detail

            $where_add = $this->web_model->catidBySlug('news-details')->cat_id;
            $data['advertisement']  = $this->web_model->advertisement($where_add);

            @$data['newscat']       = $this->web_model->newsCatListBySlug('news');
            $data['article']        = $this->web_model->article($slug1);
            $data['cat_info']       = $this->web_model->cat_info($slug1);
            $data['news']           = $this->common_model->findById('web_news', array('slug' => $slug3));

            $data['module']         = "Website";
            $data['page']           = 'website/newsdetails'; 
            $data['content']        = view('App\Modules\Website\Views\website\sidebar', $data);
            return $this->master->master($data);
        }
        
    }

    
    public function buy()
    {
        
        if ($this->session->get('isLogIn') && $this->session->get('user_id')){

            $coin_symbol    = explode('_', $this->request->getPost('market', FILTER_SANITIZE_STRING));
            $market_symbol  = $this->request->getPost('market', FILTER_SANITIZE_STRING);
            $rate           = $this->request->getPost('buypricing', FILTER_SANITIZE_STRING);
            $qty            = $this->request->getPost('buyamount', FILTER_SANITIZE_STRING);
            $user_id        = $this->session->get('user_id');

            //Check BUY fees
            $fees = $this->common_model->findById('dbt_fees', array('level' => 'BUY', 'currency_symbol' => $coin_symbol[1]));
            if ($fees) {

                $fees_amount = ($rate * $qty * $fees->fees)/100;
                $buyfees     = $fees->fees;

            } else {

                $fees_amount = 0;
                $buyfees     = 0;
            }

            //SELL fees
            $sellerfees = $this->common_model->findById('dbt_fees', array('level' => 'SELL', 'currency_symbol' => $coin_symbol[0]));

            if ($sellerfees) {

                $sellfees = $sellerfees->fees;

            } else {

                $sellfees = 0;
            }

            $amount_withoutfees = $rate * $qty;
            $amount_withfees    = $amount_withoutfees + $fees_amount;

            //Buy(BTC_USD) = C0_C1, BUY C0 vai C1
            $balance_c0         = $this->common_model->findById('dbt_balance', array('user_id' => $this->session->get('user_id'), 'currency_symbol' => $coin_symbol[0]));
            $balance_c1         = $this->common_model->findById('dbt_balance', array('user_id' => $this->session->get('user_id'), 'currency_symbol' => $coin_symbol[1]));

            //Pending Withdraw amoun sum
            $pending_withdraw = $this->db->table('dbt_withdraw')->select('SUM(amount)+SUM(fees_amount) as amount',FALSE)->where('currency_symbol', $coin_symbol[1])->where('status', 2)->where('user_id', $user_id)->get()->getRow();

            //Discut user withdraw pending balance
            $real_balance = (float)@$balance_c1->balance-(float)@$pending_withdraw->amount;

            if ($real_balance >= $amount_withfees && @$balance_c1->balance > 0 && $amount_withfees > 0) {

                $date       = new \DateTime();
                $open_date  = $date->format('Y-m-d H:i:s');
                
                $tdata['TRADES']   = (object)$exchangedata = array(
                    'bid_type'          => 'BUY',
                    'bid_price'         => $rate,
                    'bid_qty'           => $qty,
                    'bid_qty_available' => $qty,
                    'total_amount'      => $amount_withoutfees,
                    'amount_available'  => $amount_withoutfees,
                    'currency_symbol'   => $coin_symbol[0],
                    'market_symbol'     => $market_symbol,
                    'user_id'           => $user_id,
                    'open_order'        => $open_date,
                    'fees_amount'       => $fees_amount,
                    'status'            => 2
                );

                //Exchange Data Insert
                $exchange_id = $this->common_model->save_return_id('dbt_biding', $exchangedata);
                if ($exchange_id) {
                   
                    $last_exchange = $this->common_model->findById('dbt_biding', array('id' => $exchange_id));
                    //User Balance Debit(-) C1
                    $this->web_model->balanceCredit($last_exchange, $coin_symbol[1]);

                    //After balance discut(-)
                    $balance = $this->common_model->findById('dbt_balance', array('user_id' => $this->session->get('user_id'), 'currency_symbol' => $coin_symbol[1]));

                    //Search all SELL data
                    $where = "(bid_price <= '".$rate."' AND status = 2 AND bid_type = 'SELL' AND market_symbol = '".$market_symbol."')";                   
                    $sell_exchange_query = $this->db->table('dbt_biding')->select('*')->where($where)->orderBy('open_order', 'asc')->get()->getResult();

                    //Check if any order availabe
                    if ($sell_exchange_query) {
                        foreach ($sell_exchange_query as $key => $sellexchange) {
                            $seller_available_qty       = 0;
                            $buyer_available_qty        = 0;
                            $buyer_amount_available     = 0;
                            $seller_amount_available    = 0;
                            $seller_complete_qty_log    = 0;
                            $buyer_complete_qty_log     = 0;
                            $buyer_amount_available_log = 0;
                            $seller_complete_qty_log    = 0;

                            $last_exchange   = $this->common_model->findById('dbt_biding',array('id' => $exchange_id));

                            if ($last_exchange->status == 2) {

                                //Seller+Buyer Quantity/Amount Complete/Available Master table
                                if(($sellexchange->bid_qty_available-$last_exchange->bid_qty_available) < 0){

                                    $seller_available_qty = 0;

                                } else {

                                    $seller_available_qty = $sellexchange->bid_qty_available-$last_exchange->bid_qty_available;
                                }
                                
                                $buyer_available_qty   = (($last_exchange->bid_qty_available-$sellexchange->bid_qty_available)<=0)?0:($last_exchange->bid_qty_available-$sellexchange->bid_qty_available);

                                $buyer_amount_available = ($last_exchange->amount_available-($sellexchange->bid_qty_available*$sellexchange->bid_price)<=0)?0:($last_exchange->amount_available-($sellexchange->bid_qty_available*$sellexchange->bid_price));
                                $seller_amount_available = ((($sellexchange->bid_qty_available-$last_exchange->bid_qty_available)<0)?0:$sellexchange->bid_qty_available-$last_exchange->bid_qty_available)*$sellexchange->bid_price;

                                // Seller+Buyer Quantity Complete log table
                                if($sellexchange->bid_qty_available-$last_exchange->bid_qty_available == 0){

                                    $buyer_complete_qty_log = $last_exchange->bid_qty_available;

                                } else if($sellexchange->bid_qty_available-$last_exchange->bid_qty_available <= 0){

                                    $buyer_complete_qty_log = $sellexchange->bid_qty_available;

                                } else {

                                    $buyer_complete_qty_log = $last_exchange->bid_qty_available;
                                }
                               

                                $buyer_amount_available_log = ($last_exchange->amount_available-($last_exchange->bid_qty_available*$sellexchange->bid_price)<=0)?0:($last_exchange->amount_available-($last_exchange->bid_qty_available*$sellexchange->bid_price));

                                if($sellexchange->bid_qty_available-$last_exchange->bid_qty_available==0){

                                    $seller_complete_qty_log = $last_exchange->bid_qty_available;

                                } else if($sellexchange->bid_qty_available-$last_exchange->bid_qty_available<=0){

                                    $seller_complete_qty_log = $sellexchange->bid_qty_available;

                                } else {

                                    $seller_complete_qty_log = $last_exchange->bid_qty_available;
                                }
                            
                               //Exchange Data =>Buy 
                               $exchangebuydata = array(
                                    'bid_qty_available'  => $buyer_available_qty,
                                    'amount_available'   => $buyer_amount_available, //Balance added buy account
                                    'status'             => (($last_exchange->bid_qty_available-$sellexchange->bid_qty_available)<=0)?1:2,
                                );

                                //Exchange Data =>Sell
                                $exchangeselldata  = array(
                                    'bid_qty_available'  => $seller_available_qty,
                                    'amount_available'   => $seller_amount_available, //Balance added seller account
                                    'status'             => (($sellexchange->bid_qty_available-$last_exchange->bid_qty_available)<=0)?1:2,
                                );

                                //Exchange Sell+Buy Update                               
                                $this->common_model->update('dbt_biding', $exchangebuydata, array('id' => $exchange_id));
                                $this->common_model->update('dbt_biding', $exchangeselldata, array('id' => $sellexchange->id));

                                //Adjustment Amount+Fees
                                if($last_exchange->bid_price > $sellexchange->bid_price){

                                    $totalexchanceqty = $buyer_complete_qty_log;
                                    $buyremeaningrate = $last_exchange->bid_price-$sellexchange->bid_price;
                                    $buyerbalence     = $buyremeaningrate*$totalexchanceqty;

                                    //Fees when Adjustment
                                    $returnfees        = 0;
                                    $byerfees          = ($totalexchanceqty*$last_exchange->bid_price*$buyfees)/100;
                                    $sellerrfees       = ($totalexchanceqty*$sellexchange->bid_price*$sellfees)/100;
                                    $buyerreturnfees   = $byerfees-$sellerrfees;

                                    if($buyerreturnfees > 0){

                                        $returnfees = $buyerreturnfees;
                                    }
                                    
                                    $buyeruserid  = $last_exchange->user_id;

                                    $balance_data = array(

                                        'user_id'           => $buyeruserid,
                                        'amount'            => $buyerbalence,
                                        'return_fees'       => $returnfees,
                                        'currency_symbol'   => $coin_symbol[1],
                                        'ip'                => $this->request->getipAddress()
                                    );

                                    $this->web_model->balanceReturn($balance_data);
                                }

                                //Exchange Log Data =>Buyer
                                $buytraderlog = array(

                                    'bid_id'          => $last_exchange->id,
                                    'bid_type'        => $last_exchange->bid_type,
                                    'complete_qty'    => $buyer_complete_qty_log,
                                    'bid_price'       => $sellexchange->bid_price,
                                    'complete_amount' => $buyer_complete_qty_log*$sellexchange->bid_price,
                                    'user_id'         => $last_exchange->user_id,
                                    'currency_symbol' => $last_exchange->currency_symbol,
                                    'market_symbol'   => $last_exchange->market_symbol,
                                    'success_time'    => $open_date,
                                    'fees_amount'     => $last_exchange->fees_amount,
                                    'available_amount'=> $buyer_amount_available_log,
                                    'status'          => ($last_exchange->amount_available-($last_exchange->bid_qty_available*$sellexchange->bid_price)<=0)?1:2,
                                );

                                // Exchange Log Data =>Seller
                                $selltraderlog = array(

                                    'bid_id'            => $sellexchange->id,
                                    'bid_type'          => $sellexchange->bid_type,
                                    'complete_qty'      => $seller_complete_qty_log,
                                    'bid_price'         => $sellexchange->bid_price,
                                    'complete_amount'   => $seller_complete_qty_log*$sellexchange->bid_price,
                                    'user_id'           => $sellexchange->user_id,
                                    'currency_symbol'   => $sellexchange->currency_symbol,
                                    'market_symbol'     => $sellexchange->market_symbol,
                                    'success_time'      => $open_date,
                                    'fees_amount'       => $sellexchange->fees_amount,
                                    'available_amount'  => $sellexchange->bid_qty_available*$sellexchange->bid_price,
                                    'status'            => ($sellexchange->amount_available-($sellexchange->bid_qty_available*$sellexchange->bid_price)<=0)?1:2,
                                );

                                //Exchange Sell+Buy Log data
                                $this->common_model->save('dbt_biding_log',$selltraderlog);
                                $this->common_model->save('dbt_biding_log',$buytraderlog);

                                //Buy balance update
                                $buyer_balance = $this->db->table('dbt_balance')->select('*')->where('user_id', $last_exchange->user_id)->where('currency_symbol', $coin_symbol[0])->get()->getRow();

                                if (!$buyer_balance) {

                                    $user_balance = array(

                                        'user_id'           => $last_exchange->user_id, 
                                        'currency_symbol'   => $coin_symbol[0], 
                                        'balance'           => $buyer_complete_qty_log, 
                                        'last_update'       => $open_date, 

                                        );

                                    $this->common_model->save('dbt_balance', $user_balance);

                                } else {
                                    
                                    $this->common_model->update('dbt_balance', array('balance' => $buyer_balance->balance+$buyer_complete_qty_log), array('user_id' => $last_exchange->user_id, 'currency_symbol' => $coin_symbol[0]));
                                }

                                //Seller balance update
                                $check_seller_balance = $this->db->table('dbt_balance')->select('*')->where('user_id', $sellexchange->user_id)->where('currency_symbol', $coin_symbol[1])->get()->getRow();

                                if (!$check_seller_balance) {

                                    $user_balance = array(

                                        'user_id'           => $sellexchange->user_id, 
                                        'currency_symbol'   => $coin_symbol[1], 
                                        'balance'           => $buyer_complete_qty_log*$sellexchange->bid_price, 
                                        'last_update'       => $open_date, 

                                    );
                                    $this->common_model->save('dbt_balance', $user_balance);

                                } else {

                                  $this->common_model->update('dbt_balance', array('balance' => $check_seller_balance->balance+($buyer_complete_qty_log*$sellexchange->bid_price)), array('user_id' => $sellexchange->user_id, 'currency_symbol' => $coin_symbol[1]));
                                }

                                //One Hour data
                                $where      = "(success_time >= DATE_SUB(NOW(), INTERVAL 1 hour) AND market_symbol = '".$last_exchange->market_symbol."')"; 
                                $where01    = "(bid_type='BUY' AND market_symbol = '".$last_exchange->market_symbol."')";
                                $where1     = "market_symbol = '".$last_exchange->market_symbol."'"; 
                                $where11    = "success_time >= DATE_SUB(NOW(), INTERVAL 1 hour) AND bid_type='BUY' AND market_symbol = '".$last_exchange->market_symbol."'"; 
                                $where2     = "(success_time >= DATE_SUB(DATE_SUB(NOW(), INTERVAL 1 hour), INTERVAL 1 hour)) AND (success_time <= DATE_SUB(NOW(), INTERVAL 1 hour) AND market_symbol = '".$last_exchange->market_symbol."')";

                                $h1_last_price_avg      = $this->db->table('dbt_biding_log')->select('avg(bid_price)')->where($where11)->orderBy('success_time', 'desc')->get()->getRow();
                                $pre1h_last_price       = $this->db->table('dbt_biding_log')->select('bid_price')->where($where2)->orderBy('success_time', 'desc')->get()->getRow();
                                $pre1h_last_price_avg   = $this->db->table('dbt_biding_log')->select('avg(bid_price)')->where($where2)->orderBy('success_time', 'desc')->get()->getRow();
                                $total_coin_supply      = $this->db->table('dbt_biding_log')->select('sum(complete_qty)')->where($where01)->orderBy('success_time', 'desc')->get()->getRow();
                                $h1_coin_supply         = $this->db->table('dbt_biding_log')->selectSum('complete_qty')->where($where01)->orderBy('success_time', 'desc')->get()->getRow();
                                $h1_bid_high_price      = $this->db->table('dbt_biding_log')->selectMax('bid_price')->where($where)->orderBy('success_time', 'desc')->get()->getRow();
                                $h1_bid_low_price       = $this->db->table('dbt_biding_log')->selectMin('bid_price')->where($where)->orderBy('success_time', 'desc')->get()->getRow();

                                //24 hours data
                                $where      = "(success_time >= DATE_SUB(NOW(), INTERVAL 24 hour) AND market_symbol = '".$last_exchange->market_symbol."')";
                                $where01    = "(bid_type='BUY' AND market_symbol = '".$last_exchange->market_symbol."')";
                                $where1     = "market_symbol = '".$last_exchange->market_symbol."'"; 
                                $where11    = "success_time >= DATE_SUB(NOW(), INTERVAL 24 hour) AND bid_type='BUY' AND market_symbol = '".$last_exchange->market_symbol."'"; 
                                $where2     = "(success_time >= DATE_SUB(DATE_SUB(NOW(), INTERVAL 24 hour), INTERVAL 24 hour)) AND (success_time <= DATE_SUB(NOW(), INTERVAL 24 hour) AND market_symbol = '".$last_exchange->market_symbol."')";

                                $h24_last_price_avg     = $this->db->table('dbt_biding_log')->selectAvg('bid_price')->where($where11)->orderBy('success_time', 'desc')->get()->getRow();
                                $pre24h_last_price      = $this->db->table('dbt_biding_log')->select('bid_price')->where($where2)->orderBy('success_time', 'desc')->get()->getRow();
                                $pre24h_last_price_avg  = $this->db->table('dbt_biding_log')->selectAvg('bid_price')->where($where2)->orderBy('success_time', 'desc')->get()->getRow();
                                $total_coin_supply      = $this->db->table('dbt_biding_log')->selectSum('complete_qty')->where($where01)->orderBy('success_time', 'desc')->get()->getRow();
                                $h24_coin_supply        = $this->db->table('dbt_biding_log')->selectSum('complete_qty')->where($where01)->orderBy('success_time', 'desc')->get()->getRow();
                                $h24_bid_high_price     = $this->db->table('dbt_biding_log')->selectMax('bid_price')->where($where)->orderBy('success_time', 'desc')->get()->getRow();
                                $h24_bid_low_price      = $this->db->table('dbt_biding_log')->selectMin('bid_price')->where($where)->orderBy('success_time', 'desc')->get()->getRow();

                                if($h1_bid_high_price->bid_price == ''){

                                    $high1 = $sellexchange->bid_price;

                                } else {

                                    if ($h1_bid_high_price->bid_price<$sellexchange->bid_price) {

                                        $high1 = $sellexchange->bid_price;
                                    } else {

                                        $high1 = $h1_bid_high_price->bid_price;
                                    }
                                }

                                if($h1_bid_low_price->bid_price==''){

                                    $low1 = $sellexchange->bid_price;

                                } else {

                                    if ($h1_bid_low_price->bid_price>$sellexchange->bid_price) {

                                        $low1 = $sellexchange->bid_price;
                                    } else {

                                        $low1 = $h1_bid_low_price->bid_price;
                                    }
                                }

                                //Price change value in up/down
                                $last_price_query = $this->db->table('dbt_coinhistory')->select('*')->where('market_symbol', $market_symbol)->orderBy('date', 'desc')->get()->getRow();

                                if ($sellexchange->bid_price<@$last_price_query->last_price) {
                                    $price_change_1h = -($high1 - $low1);

                                } else {
                                    $price_change_1h = $high1 - $low1;

                                }


                                if($h24_bid_high_price->bid_price==''){

                                    $high24 = $sellexchange->bid_price;

                                } else {

                                    if ($h24_bid_high_price->bid_price<$sellexchange->bid_price) {

                                        $high24 = $sellexchange->bid_price;

                                    } else {

                                        $high24 = $h24_bid_high_price->bid_price;
                                    }
                                }

                                if($h24_bid_low_price->bid_price == ''){

                                     $low24 = $sellexchange->bid_price;

                                } else {

                                    if ($h24_bid_low_price->bid_price>$sellexchange->bid_price) {

                                        $low24 = $sellexchange->bid_price;

                                    } else {

                                        $low24 = $h24_bid_low_price->bid_price;
                                    }
                                }

                                if ($sellexchange->bid_price<@$last_price_query->last_price) {

                                    $price_change_24h = -($high24 - $low24);

                                } else {

                                    $price_change_24h = $high24 - $low24;
                                }

                                $coinhistory = array(
                                    'coin_symbol'       => $last_exchange->currency_symbol,
                                    'market_symbol'     => $last_exchange->market_symbol,
                                    'last_price'        => $sellexchange->bid_price,
                                    'total_coin_supply' => @$buyer_complete_qty_log+@$total_coin_supply->complete_qty,
                                    'price_high_1h'     => ($h1_bid_high_price->bid_price=='')?$sellexchange->bid_price:(($h1_bid_high_price->bid_price<$sellexchange->bid_price)?$sellexchange->bid_price:$h1_bid_high_price->bid_price),
                                    'price_low_1h'      => ($h1_bid_low_price->bid_price=='')?$sellexchange->bid_price:(($h1_bid_low_price->bid_price>$sellexchange->bid_price)?$sellexchange->bid_price:$h1_bid_low_price->bid_price),
                                    'price_change_1h'   => ($price_change_1h=='')?0:$price_change_1h,
                                    'volume_1h'         => ($h1_coin_supply->complete_qty=='')?0:$h1_coin_supply->complete_qty,

                                    'price_high_24h'     => ($h24_bid_high_price->bid_price=='')?$sellexchange->bid_price:(($h24_bid_high_price->bid_price<$sellexchange->bid_price)?$sellexchange->bid_price:$h24_bid_high_price->bid_price),
                                    'price_low_24h'      => ($h24_bid_low_price->bid_price=='')?$sellexchange->bid_price:(($h24_bid_low_price->bid_price>$sellexchange->bid_price)?$sellexchange->bid_price:$h24_bid_low_price->bid_price),
                                    'price_change_24h'   => ($price_change_24h=='')?0:$price_change_24h,
                                    'volume_24h'         => ($h24_coin_supply->complete_qty=='')?0:$h24_coin_supply->complete_qty,

                                    'open'              => $last_exchange->bid_price,
                                    'close'             => $sellexchange->bid_price,
                                    'volumefrom'        => @$buyer_complete_qty_log+@$total_coin_supply->complete_qty,
                                    'volumeto'          => ($h24_coin_supply->complete_qty=='')?0:$h24_coin_supply->complete_qty,
                                    'date'              => $open_date,
                                );

                                $this->common_model->save('dbt_coinhistory', $coinhistory);

                            }
                            //Order running

                        }
                        //Order list in loop

                    }
                    //Check if any order availabe

                    $balance_update_c0 = $this->common_model->findById('dbt_balance', array('user_id' => $this->session->get('user_id'), 'currency_symbol' => $coin_symbol[0]));

                    echo json_encode(array('trades' => $last_exchange, 'balance' => @$balance->balance, 'balance_up_to' => @$balance_update_c0->balance));

                    
                } else {

                    echo 0;
                    //trade not submited
                }

            } else {

                echo 2;
                //Insufficent Balance
            }

        } else {
          
            echo 1;
            //login requred
        }

    }

    public function sell()
    {


        if ($this->session->get('isLogIn') && $this->session->get('user_id')){

            $coin_symbol   = explode('_', $this->request->getPost('market', FILTER_SANITIZE_STRING));
            $market_symbol = $this->request->getPost('market', FILTER_SANITIZE_STRING);
            $rate          = $this->request->getPost('sellpricing', FILTER_SANITIZE_STRING);
            $qty           = $this->request->getPost('sellamount', FILTER_SANITIZE_STRING);
            $user_id       = $this->session->get('user_id');

            //Check SELL fees
            $fees = $this->common_model->findById('dbt_fees', array('level'=> 'SELL', 'currency_symbol' => $coin_symbol[0]));
            if ($fees) { 

                $fees_amount = ($qty*$fees->fees)/100;
                $sellfees    = $fees->fees;

            } else {

                $fees_amount = 0;
                $sellfees    = 0;

            }

            //BUY fees
            $buyerfees = $this->common_model->findById('dbt_fees', array('level'=> 'BUY', 'currency_symbol' => $coin_symbol[1]));

            if ($buyerfees) {

                $buyfees     = $buyerfees->fees;

            } else {

                $buyfees     = 0;
            }

            $amount_withoutfees = $qty;
            $amount_withfees    = $amount_withoutfees + $fees_amount;

            $balance_c0         = $this->common_model->findById('dbt_balance', array('user_id' => $this->session->get('user_id'), 'currency_symbol' => $coin_symbol[0]));
           
            $balance_c1         = $this->common_model->findById('dbt_balance', array('user_id' => $this->session->get('user_id'), 'currency_symbol' => $coin_symbol[1]));

            //Pending Withdraw amoun sum
            $pending_withdraw = $this->db->table('dbt_withdraw')->select('SUM(amount)+SUM(fees_amount) as amount',FALSE)->where('currency_symbol', $coin_symbol[0])->where('status', 2)->where('user_id', $user_id)->get()->getRow();

            //Discut user withdraw pending balance
            $real_balance = (float)@$balance_c0->balance-(float)@$pending_withdraw->amount;

     

            if (@$real_balance >= $amount_withfees && @$balance_c0->balance>0 && $amount_withfees>0) {

                $date       = new \DateTime();
                $open_date  = $date->format('Y-m-d H:i:s');

                $tdata['TRADES']   = (object)$exchangedata = array(

                    'bid_type'          => 'SELL',
                    'bid_price'         => $rate,
                    'bid_qty'           => $qty,
                    'bid_qty_available' => $qty,
                    'total_amount'      => $rate*$qty,
                    'amount_available'  => $rate*$qty,
                    'currency_symbol'   => $coin_symbol[0],
                    'market_symbol'     => $market_symbol,
                    'user_id'           => $user_id,
                    'open_order'        => $open_date,
                    'fees_amount'       => $fees_amount,
                    'status'            => 2
                );

                //Exchange Data Insert
                $exchange_id = $this->common_model->save_return_id('dbt_biding', $exchangedata);
                if ($exchange_id) {                   

                    $last_exchange   = $this->common_model->findById('dbt_biding', array('id' => $exchange_id));
                    //User Balance Debit(-) C0
                    $this->web_model->balanceDebit($last_exchange);
                    //After balance discut(-)
                    $balance = $this->common_model->findById('dbt_balance', array('user_id' => $this->session->get('user_id'),'currency_symbol' => $coin_symbol[0]));

                    //Search all BUY data
                    $where              = "(bid_price >= '".$rate."' AND status = 2 AND bid_type = 'BUY' AND market_symbol = '".$market_symbol."')";       
                    $buy_exchange_query = $this->db->table('dbt_biding')->select('*')->where($where)->orderBy('open_order', 'asc')->get()->getResult();

                    if ($buy_exchange_query) {

                        foreach ($buy_exchange_query as $key => $buyexchange) {

                            $seller_available_qty        = 0;
                            $buyer_available_qty         = 0;
                            $buyer_amount_available      = 0;
                            $seller_amount_available     = 0;
                            $seller_amount_available_log = 0;
                            $seller_complete_qty_log     = 0;
                            $buyer_complete_qty_log      = 0;

                            $last_exchange   = $this->common_model->findById('dbt_biding', array('id' => $exchange_id));


                            if ($last_exchange->status == 2) {

                                //Seller+Buyer Quantity/Amount Complete/Available Master table

                                $seller_available_qty       = (($last_exchange->bid_qty_available - $buyexchange->bid_qty_available)<=0)?0:($last_exchange->bid_qty_available-$buyexchange->bid_qty_available);

                                $buyer_available_qty        = (($buyexchange->bid_qty_available - $last_exchange->bid_qty_available)<0)?0:$buyexchange->bid_qty_available-$last_exchange->bid_qty_available;

                                $buyer_amount_available     = ((($buyexchange->bid_qty_available-$last_exchange->bid_qty_available)<0)?0:$buyexchange->bid_qty_available-$last_exchange->bid_qty_available)*$last_exchange->bid_price;

                                $seller_amount_available    = ($last_exchange->amount_available-($buyexchange->bid_qty_available*$last_exchange->bid_price)<=0)?0:($last_exchange->amount_available-($buyexchange->bid_qty_available*$last_exchange->bid_price));
                                $seller_amount_available_log = ($last_exchange->amount_available-($last_exchange->bid_qty_available*$last_exchange->bid_price)<=0)?0:($last_exchange->amount_available-($last_exchange->bid_qty_available*$last_exchange->bid_price));

                                // Seller+Buyer Quantity Complete log table
                                if($buyexchange->bid_qty_available-$last_exchange->bid_qty_available==0){

                                    $seller_complete_qty_log = $last_exchange->bid_qty_available;

                                } else if($buyexchange->bid_qty_available-$last_exchange->bid_qty_available<=0){

                                    $seller_complete_qty_log = $buyexchange->bid_qty_available;

                                } else {

                                    $seller_complete_qty_log = $last_exchange->bid_qty_available;
                                }
                               
                                if($buyexchange->bid_qty_available-$last_exchange->bid_qty_available==0){

                                    $buyer_complete_qty_log = $last_exchange->bid_qty_available;

                                } else if($buyexchange->bid_qty_available-$last_exchange->bid_qty_available<=0){

                                    $buyer_complete_qty_log = $buyexchange->bid_qty_available;

                                } else {

                                    $buyer_complete_qty_log = $last_exchange->bid_qty_available;
                                }
                               
                                //Exchange Data =>Sell
                               $exchangeselldata = array(
                                    'bid_qty_available'  => $seller_available_qty,
                                    'amount_available'   => $seller_amount_available, //Balance added SELL account
                                    'status'             => (($last_exchange->bid_qty_available-$buyexchange->bid_qty_available)<=0)?1:2,
                                );

                               //Exchange Data =>Buy 
                               $exchangebuydata  = array(
                                    'bid_qty_available'  => $buyer_available_qty,
                                    'amount_available'   => $buyer_amount_available, //Balance added BUY account
                                    'status'             => (($buyexchange->bid_qty_available-$last_exchange->bid_qty_available)<=0)?1:2,
                                );

                               //Exchange Sell+Buy Update  
                               $this->common_model->update('dbt_biding', $exchangeselldata, array('id' => $exchange_id));
                               $this->common_model->update('dbt_biding', $exchangebuydata, array('id' => $buyexchange->id));


                                //Adjustment Amount+Fees
                                if($buyexchange->bid_price>$last_exchange->bid_price){

                                    $totalexchanceqty = $buyer_complete_qty_log;
                                    $buyremeaningrate = $buyexchange->bid_price-$last_exchange->bid_price;
                                    $buyerbalence     = $buyremeaningrate*$totalexchanceqty;

                                    //Fees when Adjustment
                                    $returnfees     = 0;
                                    $byerfees       = ($totalexchanceqty*$buyexchange->bid_price*$buyfees)/100;
                                    $sellerrfees    = ($totalexchanceqty*$last_exchange->bid_price*$sellfees)/100;

                                    $buyerreturnfees= $byerfees-$sellerrfees;

                                    if($buyerreturnfees>0){

                                        $returnfees = $buyerreturnfees;
                                    }
                                    
                                    $buyeruserid      = $buyexchange->user_id;

                                    $balance_data = array(
                                        'user_id'        => $buyeruserid,
                                        'amount'         => $buyerbalence,
                                        'return_fees'    => $returnfees,
                                        'currency_symbol'=>$coin_symbol[1],
                                        'ip'             => $this->request->getipAddress()
                                    );

                                    $this->web_model->balanceReturn($balance_data);

                                }

                                //Exchange Log Data =>Seller
                                $selltraderlog = array(
                                    'bid_id'          => $last_exchange->id,
                                    'bid_type'        => $last_exchange->bid_type,
                                    'complete_qty'    => $seller_complete_qty_log,
                                    'bid_price'       => $last_exchange->bid_price,
                                    'complete_amount' => $seller_complete_qty_log*$last_exchange->bid_price,
                                    'user_id'         => $last_exchange->user_id,
                                    'currency_symbol' => $last_exchange->currency_symbol,
                                    'market_symbol'   => $market_symbol,
                                    'success_time'    => $open_date,
                                    'fees_amount'     => $last_exchange->fees_amount,
                                    'available_amount'=> $seller_amount_available_log,
                                    'status'          => ($last_exchange->amount_available-($last_exchange->bid_qty_available*$last_exchange->bid_price)<=0)?1:2,
                                );

                                // Exchange Log Data =>Buyer 
                               $buytraderlog = array(
                                    'bid_id'          => $buyexchange->id,
                                    'bid_type'        => $buyexchange->bid_type,
                                    'complete_qty'    => $buyer_complete_qty_log,
                                    'bid_price'       => $last_exchange->bid_price,
                                    'complete_amount' => $buyer_complete_qty_log*$last_exchange->bid_price,
                                    'user_id'         => $buyexchange->user_id,
                                    'currency_symbol' => $buyexchange->currency_symbol,
                                    'market_symbol'   => $market_symbol,
                                    'success_time'    => $open_date,
                                    'fees_amount'     => $buyexchange->fees_amount,
                                    'available_amount'=> $buyexchange->bid_qty_available*$last_exchange->bid_price,
                                    'status'          => ($buyexchange->amount_available-($buyexchange->bid_qty_available*$last_exchange->bid_price)<=0)?1:2,
                                );

                                //Exchange Sell+Buy Log data
                                $this->common_model->save('dbt_biding_log',$buytraderlog);
                                $this->common_model->save('dbt_biding_log',$selltraderlog);


                                //Buy balance update
                                $check_user_balance = $this->db->table('dbt_balance')->select('*')->where('user_id', $buyexchange->user_id)->where('currency_symbol', $coin_symbol[0])->get()->getRow();


                                if (!$check_user_balance) {
                                    $user_balance = array(
                                        'user_id'           => $buyexchange->user_id, 
                                        'currency_symbol'   => $coin_symbol[0], 
                                        'balance'           => $seller_complete_qty_log, 
                                        'last_update'       => $open_date, 
                                        );
                                    $this->common_model->save('dbt_balance', $user_balance);

                                } else {
                                    
                                    $this->common_model->update('dbt_balance', array('balance' => $check_user_balance->balance+$seller_complete_qty_log) ,array('user_id' => $buyexchange->user_id, 'currency_symbol' => $coin_symbol[0]));
                                }  

                              
                                //Seller balance update
                                $check_seller_balance = $this->db->table('dbt_balance')->select('*')->where('user_id', $last_exchange->user_id)->where('currency_symbol', $coin_symbol[1])->get()->getRow();

                                if (!$check_seller_balance) {
                                    $user_balance = array(
                                        'user_id'           => $last_exchange->user_id, 
                                        'currency_symbol'   => $coin_symbol[1], 
                                        'balance'           => $seller_complete_qty_log*$last_exchange->bid_price, 
                                        'last_update'       => $open_date, 
                                    );
                                    $this->common_model->save('dbt_balance', $user_balance);

                                } else {
                                    
                                    $this->common_model->update('dbt_balance', array('balance' => $check_seller_balance->balance+($seller_complete_qty_log*$last_exchange->bid_price)), array('user_id' => $last_exchange->user_id, 'currency_symbol' => $coin_symbol[1]));
                                }

                                //next day her now start

                                $where      = "(success_time >= DATE_SUB(NOW(), INTERVAL 1 hour) AND market_symbol = '".$last_exchange->market_symbol."')"; 
                                $where01    = "(bid_type='BUY' AND market_symbol = '".$last_exchange->market_symbol."')"; 
                                $where1     = "market_symbol = '".$last_exchange->market_symbol."'"; 
                                $where11    = "success_time >= DATE_SUB(NOW(), INTERVAL 1 hour) AND bid_type='BUY' AND market_symbol = '".$last_exchange->market_symbol."'"; 
                                $where2     = "(success_time >= DATE_SUB(DATE_SUB(NOW(), INTERVAL 1 hour), INTERVAL 1 hour)) AND (success_time <= DATE_SUB(NOW(), INTERVAL 1 hour) AND market_symbol = '".$last_exchange->market_symbol."')";

                                $h1_last_price_avg      = $this->db->table('dbt_biding_log')->select('avg(bid_price)')->where($where11)->orderBy('success_time', 'desc')->get()->getRow();
                                $pre1h_last_price       = $this->db->table('dbt_biding_log')->select('bid_price')->where($where2)->orderBy('success_time', 'desc')->get()->getRow();
                                $pre1h_last_price_avg   = $this->db->table('dbt_biding_log')->select('avg(bid_price)')->where($where2)->orderBy('success_time', 'desc')->get()->getRow();
                                $total_coin_supply      = $this->db->table('dbt_biding_log')->selectSum('complete_qty')->where($where01)->orderBy('success_time', 'desc')->get()->getRow();
                                $h1_coin_supply         = $this->db->table('dbt_biding_log')->selectSum('complete_qty')->where($where01)->orderBy('success_time', 'desc')->get()->getRow();
                                $h1_bid_high_price      = $this->db->table('dbt_biding_log')->selectMax('bid_price')->where($where)->orderBy('success_time', 'desc')->get()->getRow();

                                $h1_bid_low_price       = $this->db->table('dbt_biding_log')->selectMin('bid_price')->where($where)->orderBy('success_time', 'desc')->get()->getRow();

                                $where      = "(success_time >= DATE_SUB(NOW(), INTERVAL 24 hour) AND market_symbol = '".$last_exchange->market_symbol."')"; 
                                $where01    = "(bid_type='BUY' AND market_symbol = '".$last_exchange->market_symbol."')"; 
                                $where1     = "market_symbol = '".$last_exchange->market_symbol."'"; 
                                $where11    = "success_time >= DATE_SUB(NOW(), INTERVAL 24 hour) AND bid_type='BUY' AND market_symbol = '".$last_exchange->market_symbol."'"; 
                                $where2     = "(success_time >= DATE_SUB(DATE_SUB(NOW(), INTERVAL 24 hour), INTERVAL 24 hour)) AND (success_time <= DATE_SUB(NOW(), INTERVAL 24 hour) AND market_symbol = '".$last_exchange->market_symbol."')";


                                $h24_last_price_avg     = $this->db->table('dbt_biding_log')->select('avg(bid_price)')->where($where11)->orderBy('success_time', 'desc')->get()->getRow();
                                $pre24h_last_price      = $this->db->table('dbt_biding_log')->select('bid_price')->where($where2)->orderBy('success_time', 'desc')->get()->getRow();
                                $pre24h_last_price_avg  = $this->db->table('dbt_biding_log')->select('avg(bid_price)')->where($where2)->orderBy('success_time', 'desc')->get()->getRow();
                                $h24_coin_supply        = $this->db->table('dbt_biding_log')->selectSum('complete_qty')->where($where01)->orderBy('success_time', 'desc')->get()->getRow();
                                $h24_bid_high_price     = $this->db->table('dbt_biding_log')->selectMax('bid_price')->where($where)->orderBy('success_time', 'desc')->get()->getRow();
                                $h24_bid_low_price      = $this->db->table('dbt_biding_log')->selectMin('bid_price')->where($where)->orderBy('success_time', 'desc')->get()->getRow();

                                if($h1_bid_high_price->bid_price == ''){
                                    $high1 = $last_exchange->bid_price;

                                } else {

                                    if ($h1_bid_high_price->bid_price < $last_exchange->bid_price) {

                                        $high1 = $last_exchange->bid_price;
                                    } else {

                                        $high1 = $h1_bid_high_price->bid_price;
                                    }
                                }

                                if($h1_bid_low_price->bid_price == ''){

                                    $low1 = $last_exchange->bid_price;

                                } else {

                                    if ($h1_bid_low_price->bid_price < $last_exchange->bid_price) {

                                        $low1 = $last_exchange->bid_price;

                                    } else {

                                        $low1 = $h1_bid_low_price->bid_price;

                                    }
                                }

                                //Price change value in up/down
                                $last_price_query = $this->db->table('dbt_coinhistory')->select('*')->where('market_symbol', $market_symbol)->orderBy('date', 'desc')->get()->getRow();

                                if ($last_exchange->bid_price < @$last_price_query->last_price) {

                                    $price_change_1h = -($high1 - $low1);

                                } else {

                                     $price_change_1h = $high1 - $low1;
                                }
                                

                                if($h24_bid_high_price->bid_price == ''){

                                    $high24 = $last_exchange->bid_price;

                                } else {

                                    if ($h24_bid_high_price->bid_price<$last_exchange->bid_price) {

                                        $high24 = $last_exchange->bid_price;

                                    } else {

                                        $high24 = $h24_bid_high_price->bid_price;
                                    }

                                }

                                if($h24_bid_low_price->bid_price == ''){

                                    $low24 = $last_exchange->bid_price;

                                } else {

                                    if ($h24_bid_low_price->bid_price<$last_exchange->bid_price) {

                                        $low24 = $last_exchange->bid_price;

                                    } else {

                                        $low24 = $h24_bid_low_price->bid_price;
                                    }
                                }

                                if ($last_exchange->bid_price<@$last_price_query->last_price){

                                    $price_change_24h = -($high24 - $low24);

                                } else {

                                    $price_change_24h = $high24 - $low24;
                                }

                                $coinhistory = array(

                                    'coin_symbol'       => $last_exchange->currency_symbol,
                                    'market_symbol'     => $last_exchange->market_symbol,
                                    'last_price'        => $last_exchange->bid_price,
                                    'total_coin_supply' => @$seller_complete_qty_log+@$total_coin_supply->complete_qty,
                                    'price_high_1h'     => ($h1_bid_high_price->bid_price=='')?$last_exchange->bid_price:(($h1_bid_high_price->bid_price<$last_exchange->bid_price)?$last_exchange->bid_price:$h1_bid_high_price->bid_price),
                                    'price_low_1h'      => ($h1_bid_low_price->bid_price=='')?$last_exchange->bid_price:(($h1_bid_low_price->bid_price>$last_exchange->bid_price)?$last_exchange->bid_price:$h1_bid_low_price->bid_price),
                                    'price_change_1h'   => ($price_change_1h=='')?0:$price_change_1h,
                                    'volume_1h'         => ($h1_coin_supply->complete_qty=='')?0:$h1_coin_supply->complete_qty,
                                    'price_high_24h'    => ($h24_bid_high_price->bid_price=='')?$last_exchange->bid_price:(($h24_bid_high_price->bid_price<$last_exchange->bid_price)?$last_exchange->bid_price:$h24_bid_high_price->bid_price),
                                    'price_low_24h'     => ($h24_bid_low_price->bid_price=='')?$last_exchange->bid_price:(($h24_bid_low_price->bid_price>$last_exchange->bid_price)?$last_exchange->bid_price:$h24_bid_low_price->bid_price),
                                    'price_change_24h'  => ($price_change_24h=='')?0:$price_change_24h,
                                    'volume_24h'        => ($h24_coin_supply->complete_qty=='')?0:$h24_coin_supply->complete_qty,
                                    'open'              => $last_exchange->bid_price,
                                    'close'             => $last_exchange->bid_price,
                                    'volumefrom'        => @$seller_complete_qty_log+@$total_coin_supply->complete_qty,
                                    'volumeto'          => ($h24_coin_supply->complete_qty=='')?0:$h24_coin_supply->complete_qty,
                                    'date'              => $open_date,
                                );

                                $this->common_model->save('dbt_coinhistory', $coinhistory);                                
                            }
                            //Order running
                        }
                        //Order list in loop
                    }
                    //Check if any order availabe

                    $balance_update_c1 = $this->common_model->findById('dbt_balance', array('user_id' => $this->session->get('user_id'), 'currency_symbol' => $coin_symbol[1]));
                    echo json_encode(array('trades' => $last_exchange, 'balance' => @$balance->balance, 'balance_up_to' => @$balance_update_c1->balance));

                } else {

                    echo 0;
                    //trade not submited
                }

            } else {

                echo 2;
                //Insufficent Balance
            }

        } else {

            echo 1;
            //login requred
        }
    }

    public function order_cancel($id = null)
    {

        $orderdata = $this->common_model->findById('dbt_biding', array('id' => $id));

        if (@$this->session->get('user_id') != $orderdata->user_id){

           $this->session->setFlashdata('exception', display('there_is_no_order_for_cancel'));
           return redirect()->to(base_url("open-order"));

        } else {

            $canceltrade = array(
                'status' => 0
            );

            $this->common_model->update('dbt_biding', $canceltrade, array('id' => $id));

            $currency_symbol = '';
            $refund_amount   = '';

            if ($orderdata->bid_type == 'SELL') {

                $temp = explode("_", $orderdata->market_symbol);
                $currency_symbol = $temp[0];

                //With fees refund
                $percent       = (($orderdata->bid_qty-$orderdata->bid_qty_available)*100)/$orderdata->bid_qty;
                $per_pending   = 100 - $percent;
                $return_fees   = ($per_pending*$orderdata->fees_amount)/100;
                $refund_amount = $orderdata->bid_qty_available + $return_fees;

            } else {
                
                $temp            = explode("_", $orderdata->market_symbol);
                $currency_symbol = $temp[1];

                $percent     = (($orderdata->bid_qty-$orderdata->bid_qty_available)*$orderdata->bid_price*100)/($orderdata->bid_qty*$orderdata->bid_price);
                $per_pending = 100 - $percent;
                $return_fees = ($per_pending*$orderdata->fees_amount)/100;

                //With fees refund
                $refund_amount = ($orderdata->bid_qty_available*$orderdata->bid_price) + $return_fees;
            }

            $balance = $this->common_model->findById('dbt_balance', array('currency_symbol' => $currency_symbol, 'user_id' => $orderdata->user_id));
            //User Financial Log
            $tradecanceldata = array(

                'user_id'            => $orderdata->user_id,
                'balance_id'         => @$balance->id,
                'currency_symbol'    => $currency_symbol,
                'transaction_type'   => 'TRADE_CANCEL',
                'transaction_amount' => $refund_amount,
                'transaction_fees'   => 0,
                'ip'                 => $this->request->getipAddress(),
                'date'               => date('Y-m-d H:i:s')
            );

            $this->common_model->save('dbt_balance_log', $tradecanceldata);

            $new_balance = @$balance->balance+($refund_amount);

            $this->common_model->update('dbt_balance', array('balance' => $new_balance), array('user_id' => $orderdata->user_id, 'currency_symbol' => $currency_symbol));

            $traderlog = array(

                'bid_id'          => $id,
                'bid_type'        => $orderdata->bid_type,
                'complete_qty'    => $orderdata->bid_qty_available,
                'bid_price'       => $orderdata->bid_price,
                'complete_amount' => $refund_amount,
                'user_id'         => $orderdata->user_id,
                'currency_symbol' => $orderdata->currency_symbol,
                'market_symbol'   => $orderdata->market_symbol,
                'success_time'    => date('Y-m-d H:i:s'),
                'fees_amount'     => 0,
                'available_amount'=> 0,
                'status'          => 0,
            );

            $this->common_model->save('dbt_biding_log', $traderlog);

            $this->session->setFlashdata('message', display('request_canceled'));
            return redirect()->to(base_url("open-order"));
        }
    }

    public function coin_pairs()
    {
        $data = $this->common_model->findAll('dbt_coinpair', array('status' => 1), 'symbol', 'asc');
        echo json_encode(array('coin_pairs' => $data));
    }

    public function streamer()
    {
        $market_symbol = $this->input->get('market', TRUE);

        $trades = $this->db->query("SELECT *, SUM(`bid_qty_available`) as total_qty, SUM(`bid_qty_available`*`bid_price`) as total_price FROM dbt_biding WHERE `status`=2 AND `market_symbol`='".$market_symbol."' GROUP BY `id`, `market_symbol`, `bid_type`, `bid_price` ORDER BY `dbt_biding`.`bid_price` ASC")->getResult();

       echo json_encode(array('trades' => $trades));
    }


    public function streamer_buy()
    {
        $market_symbol = $this->request->getVar('market', FILTER_SANITIZE_STRING);

        $sql = "SELECT *, SUM(`bid_qty_available`) as total_qty, SUM(`bid_qty_available`*`bid_price`) as total_price FROM dbt_biding WHERE `status`=2 AND `market_symbol`='".$market_symbol."'  AND `bid_type`='BUY' GROUP BY `id`,`market_symbol`, `bid_type`, `bid_price` ORDER BY `dbt_biding`.`bid_price` ASC";
        $trades = $this->db->query($sql, [])->getResult();

        echo json_encode(array('trades' => $trades));
    }

    public function streamer_sell()
    {
        $market_symbol = $this->request->getVar('market', FILTER_SANITIZE_STRING);

        $sql = "SELECT *, SUM(`bid_qty_available`) as total_qty, SUM(`bid_qty_available`*`bid_price`) as total_price FROM dbt_biding WHERE `status`=2 AND `market_symbol`='".$market_symbol."' AND `bid_type`='SELL' GROUP BY `id`,`market_symbol`, `bid_type`, `bid_price` ORDER BY `dbt_biding`.`bid_price` DESC";
        $trades = $this->db->query($sql, [])->getResult();

        echo json_encode(array('trades' => $trades));
    }

    
    public function market_streamer()
    {
        $market_symbol = $this->request->getVar('market', FILTER_SANITIZE_STRING);
        $coin_symbol = explode('_', $market_symbol);

         $sql = "SELECT * FROM `dbt_coinhistory` INNER JOIN (SELECT `market_symbol`, MAX(`id`) AS maxid FROM `dbt_coinhistory` GROUP BY `id`,`market_symbol`) topid ON dbt_coinhistory.`market_symbol` = topid.`market_symbol` AND dbt_coinhistory.`id` = topid.`maxid`";
        $tradesummery =$this->db->query($sql, [])->getResult();

        echo json_encode(array('marketstreamer' => $tradesummery));

    }
    public function tradehistory()
    {

        $market_symbol      = $this->request->getVar('market', FILTER_SANITIZE_STRING);
        $tradehistory       = $this->common_model->findAll('dbt_biding_log', array('market_symbol' => $market_symbol), 'log_id', 'asc');
        $coin_symbol        = explode('_', $market_symbol);
        $availablebuycoin   = $this->web_model->availableForBuy($market_symbol);
        $availablesellcoin  = $this->web_model->availableForSell($market_symbol);
        $coinhistory        = $this->db->table('dbt_coinhistory')->select('*')->where('market_symbol', $market_symbol)->orderBy('date', 'desc')->get()->getRow();

        echo json_encode(
            array('tradehistory'        => @$tradehistory,
                'coinhistory'           => @$coinhistory,
                'available_buy_coin'    => @$availablebuycoin,
                'available_sell_coin'   => @$availablesellcoin,
            )
        );
    }

    public function tradecharthistory()
    {

        $market_symbol = $this->request->getVar('market', FILTER_SANITIZE_STRING);
        $coin_symbol   = explode('_', $market_symbol);
        $coinhistory   = $this->db->table('dbt_coinhistory')->select('*')->where('market_symbol', $market_symbol)->orderBy('date', 'asc')->get()->getResult();
        echo json_encode($coinhistory);
    }

    public function market_depth()
    {

        $market_symbol = $this->request->getVar('market', FILTER_SANITIZE_STRING);       

        $asks = array();
        $bids = array();

        $where       = "bid_type = 'SELL' AND market_symbol = '".$market_symbol."'"; 
        $coinhistory = $this->db->table('dbt_biding_log')->select('*')->where($where)->orderBy('success_time', 'desc')->limit(100)->get()->getResult();
        $x = 0;
        $y = 0;
        foreach ($coinhistory as $key => $value) {
            array_push($asks, array($x,$y));
            $x = $value->bid_price;
            $y = $value->complete_qty;

        }

        $where = "bid_type = 'BUY' AND market_symbol = '".$market_symbol."'"; 
        $coinhistory = $this->db->table('dbt_biding_log')->select('*')->where($where)->orderBy('success_time', 'desc')->limit(100)->get()->getResult();
        foreach ($coinhistory as $key => $value) {
            $x = $value->bid_price;
            $y = $value->complete_qty;
            array_push($bids, array($x,$y));
        }

        echo json_encode(
            array('asks' => $asks,
                  'bids' => $bids,
            )
        );

    }

    //Ajax Sparkline Graph data JSON Formate
    public function coingraphdata($data1 = 0)
    {

        $cryptoconfig = $this->common_model->findById('external_api_setup', array('id'=>3));
        $apiData  = json_decode($cryptoconfig->data);
        $cryptocompage_api_key = $apiData->api_key;
       
        $per_page = 15;

        $data['cryptocoins']  = $this->common_model->findAll('dbt_cryptocoin', array('show_home' => 1, 'status' => 1), 'rank', 'asc');

        foreach ($data['cryptocoins'] as $key => $value) {            

            $test1      = file_get_contents('https://min-api.cryptocompare.com/data/histoday?fsym='.$value->symbol.'&tsym=USD&limit=15&api_key='.$apiData->api_key, true);

            $history1   = json_decode($test1, true);

            $data24h[$value->symbol]="";
            foreach ($history1['Data'] as $h_key => $h_value) { 

                $data24h[$value->symbol] .= $h_value['low'].",".$h_value['high'].",";
            }
            $data24h[$value->symbol] = rtrim($data24h[$value->symbol], ',');    
        }
        echo json_encode($data24h);
    }


    public function register()
    {
        
        //Load Cookie For Store Referral ID
        helper(array('cookie'));
        $ref = $this->request->getVar('ref', FILTER_SANITIZE_STRING); 

        if (isset($ref) && ($ref != "")) {

            $user_id = $this->common_model->findById('dbt_user', array('user_id' => $ref));

            if($user_id){

                set_cookie('referral_id', $ref, 86400*30);

            } else {

                $this->session->setFlashdata('exception', display('referral_id_is_invalid'));
                return redirect()->to(base_url('register'));
            }
        }               

        //Load Helper For [user_id] Generate
        helper('text');

        //Set Rules From validation
        $this->validation->setRule('rf_name', display('firstname'), 'required|max_length[50]|trim');
        $this->validation->setRule('remail', display('email'), "required|valid_email|max_length[100]|trim");
        $this->validation->setRule('rpass', display('password'), 'required|min_length[8]|matches[rr_pass]|trim');
        $this->validation->setRule('rr_pass', display('conf_password'), 'required|trim');
        $this->validation->setRule('raccept_terms', display('accept_terms_privacy'), 'required|trim');

        if($this->request->getMethod() == 'post'){
            //From Validation Check
            if ($this->validation->withRequest($this->request)->run()) {

                if (!$this->request->isValidIP($this->request->getipAddress())){

                    $this->session->setFlashdata('exception',  display('invalid_ip_address'));
                    return redirect()->to(base_url('register'));
                }

                //Generate User Id
                $userid = strtoupper(random_string('alnum', 6));

                while ( $this->common_model->findById('dbt_user', array('user_id'=>$userid))) {

                    $userid = strtoupper(random_string('alnum', 6));
                }
                
                if ($this->common_model->findById('dbt_user', array('email' => $this->request->getPost('remail')))){

                    $checkStatus = $this->common_model->findById('dbt_user', array('email' => $this->request->getPost('remail')));

                    if ($checkStatus->status == 0) {

                        $this->session->setFlashdata('exception',  display('please_activate_your_account'));
                        return  redirect()->to(base_url('login'));

                    } elseif ($checkStatus->status == 1) {

                        $this->session->setFlashdata('exception',  display('already_regsister'));
                        return  redirect()->to(base_url('login'));

                    } elseif ($checkStatus->status == 2) {

                        $this->session->setFlashdata('exception',  display('this_account_is_now_pending'));
                        return  redirect()->to(base_url('login'));

                    } elseif ($checkStatus->status == 3) {

                        $this->session->setFlashdata('exception',  display('this_account_is_suspend'));
                        return  redirect()->to(base_url('register'));
                    }               
                }
               
                $dlanguage = $this->common_model->findById('setting', array());

                $data = [
                    'first_name'    => $this->request->getPost('rf_name', FILTER_SANITIZE_STRING),
                    'referral_id'   => $this->request->getCookie('referral_id', FILTER_SANITIZE_STRING), 
                    'language'      => $dlanguage->language,
                    'user_id'       => $userid,
                    'email'         => $this->request->getPost('remail', FILTER_SANITIZE_STRING),
                    'password'      => md5($this->request->getPost('rpass', FILTER_SANITIZE_STRING)),
                    'password_reset_token' => md5($userid),
                    'status'        => 0,
                    'ip'            => $this->request->getipAddress(),
                    'created_date'  => date("Y-m-d H:i:s"),
                    'created'       => date("Y-m-d H:i:s")
                ];

                if($this->common_model->save('dbt_user', $data)){

                    $appSetting = $this->common_model->findById('setting', array());
                    $email_theme = $this->common_model->findById('dbt_sms_email_template', array('id' => 12));

                    if($this->langSet() == 'english'){

                        $theme_message = @$email_theme->template_en;
                        $theme_subject = @$email_theme->subject_en;

                    } else { 

                        $theme_message = @$email_theme->template_fr; 
                        $theme_subject = @$email_theme->subject_fr;
                    }

                    $data['title']      = $appSetting->title;
                    $data['to']         = $this->request->getPost('remail', FILTER_SANITIZE_STRING);
                    $data['subject']    = $theme_subject;
                    $data['url']        = "<a target='_blank' href='".base_url()."/activate-account/".md5($userid)."'>".base_url()."/activate-account/".md5($userid)."</a>";
                    $data['message']    = $theme_message;
                    $this->common_model->send_email_theme($data);
                    $this->session->setFlashdata('message', display('account_create_active_link'));
                    return  redirect()->to(base_url('login'));
                }

            } else {

                $this->session->setFlashdata('exception', $this->validation->listErrors());
            }
        }

        $data['module']    = "Website";
        $data['page']      = 'website/register'; 
        return $this->master->master($data);
        
    }

    public function login()
    {
        if(!empty($this->session->get('user_id'))){
            return  redirect()->to(base_url());
        }
        //Cookie initialize
        helper(array('cookie'));
             
        $email          = $this->request->getPost('luseremail', FILTER_SANITIZE_STRING);
        $password       = $this->request->getPost('lpassword', FILTER_SANITIZE_STRING);
        $passwordmd5    = md5($password);

        //Set Rules From validation
        $this->validation->setRule('luseremail', display('email'),   'required|max_length[100]|trim');
        $this->validation->setRule('lpassword', display('password'), 'required|max_length[32]|md5|trim');

        $security         = $this->common_model->findById('dbt_security', array('keyword' => 'capture', 'status' => 1));
        $data['security'] = $this->common_model->findById('dbt_security', array('keyword' => 'capture', 'status' => 1));

        if ($security) {
            //If  goggle capture enable
            $this->validation->setRule('g-recaptcha-response', "Recaptcha", 'required|trim');

            $data = array(

                'widget' => $this->recaptcha->getWidget(),
                'script' => $this->recaptcha->getScriptTag(),
            );
        }

        //From Validation Check
        if ($this->validation->withRequest($this->request)->run())
        {
            //if admin login at-first logout him
            if($this->session->get('isLogIn') && $this->session->get('isAdmin')){

               $this->session->remove('isLogIn');
               $this->session->remove('isAdmin');
            }

            $access_time = date('Y-m-d H:i:s');

            $data['user'] = (object)$userData = array(

                'email'    => $email,
                'password' => $passwordmd5
            );

            $security_login = $this->common_model->findById('dbt_security', array('keyword' => 'login', 'status' => 1));
            if ($security_login) {

                $security_login_decode = json_decode($security_login->data, FILTER_SANITIZE_STRING);
            }
            
            //Check already try
            $cookie_count = get_cookie('wrong_loginx', TRUE);
           
            if ($cookie_count) {
                //30 min
                $this->session->setFlashdata('exception', "Try it after ".$security_login_decode['duration']." min");
                return  redirect()->to(base_url('/login'));
            }
            $existEmail = $this->common_model->findById('dbt_user', array('email' => $email));
            if ($existEmail) {

                if ($existEmail->status == 0) {

                    $this->session->setFlashdata('exception',  display('please_activate_your_account'));
                    return  redirect()->to(base_url('/login'));

                } elseif ($existEmail->status == 2) {

                    $this->session->setFlashdata('exception',  display('this_account_is_now_pending'));
                    return  redirect()->to(base_url('/login'));

                } elseif ($existEmail->status == 3) {

                    $this->session->setFlashdata('exception',  display('this_account_is_suspend'));
                    return  redirect()->to(base_url('/login'));

                } elseif ($existEmail->status == 1) {

                    $where = "(email ='".$userData['email']."' OR username = '".$userData['email']."') AND password = '".$userData['password']."'";
                    $user  = $this->common_model->findById('dbt_user', $where);

                    if($user) {
                        //Delete session and cookies wrong try
                        unset($_SESSION['wrong_login']);
                        delete_cookie('wrong_loginc');
                        delete_cookie('wrong_loginx');
                       
                  
                        $query = $this->common_model->findById('dbt_user', array('user_id' => $user->user_id));

                        if ($query->googleauth != '') {

                            $user_agent = array(

                                'device'     => $this->agent->browser(),
                                'browser'    => $this->agent->browser().' V-'.$this->agent->version(),
                                'platform'   => $this->agent->platform()
                            );

                            $sData = array(

                                'id'          => $user->id,
                                'user_id'     => $user->user_id,
                                'fullname'    => $user->first_name.' '.$user->last_name,
                                'email'       => $user->email
                            );
                            $logData = array(

                                'log_type'     => 'login',
                                'access_time'  => $access_time,
                                'user_agent'   => json_encode($user_agent),
                                'user_id'      => $user->user_id,
                                'ip'           => $this->request->getIPAddress()
                            );

                            $this->session->set('userdata', $sData);
                            $this->session->set('userlogdata', $logData);
                            return  redirect()->to(base_url('login-verify'));                              

                        } else {

                            $agent = $this->request->getUserAgent();
                            $user_agent = array(
                                'device'     => $agent->getBrowser(),
                                'browser'    => $agent->getBrowser().' V-'.$agent->getVersion(),
                                'platform'   => $agent->getPlatform()
                            );

                            $sData = array(

                                'isLogIn'     => true,
                                'id'          => $user->id,
                                'user_id'     => $user->user_id,
                                'fullname'    => $user->first_name.' '.$user->last_name,
                                'email'       => $user->email
                            );
                            $logData = array(

                                'log_type'     => 'login',
                                'access_time'  => $access_time,
                                'user_agent'   => json_encode($user_agent),
                                'user_id'      => $user->user_id,
                                'ip'           => $this->request->getIPAddress()
                            );

                           $this->session->setFlashdata('message', '<script type="text/javascript">toastr.success("You Are Logged In Successfully!")</script>');
                            //Store data to session, log & Login
                            $this->session->set($sData);
                            $this->common_model->save('dbt_user_log', $logData);
                            return  redirect()->to(base_url(''));
                        }                            

                    } else {

                        //Security module
                        $wrong_login = $this->session->get('wrong_login');

                        if ($wrong_login) {

                            $this->session->set('wrong_login', $wrong_login+1);
                            $wrong_login = $this->session->get('wrong_login');
    
                            if ($wrong_login%@$security_login_decode['wrong_try'] == 0) {

                                //database update ip/account deactive base on session
                                # code...

                                $cookie_count = get_cookie('wrong_loginc', TRUE);
                                if ($cookie_count) {
                                    
                                    unset($_SESSION['wrong_login']);
                                    //30 min
                                    set_cookie('wrong_loginc', $cookie_count+1, 3600*24);
                                    $cookie_count = get_cookie('wrong_loginc', TRUE);
                                    if ($cookie_count >= @$security_login_decode['ip_block']) {
                                        //database update ip/account deactive base on cookie
                                        $this->db->insert('dbt_blocklist', array('ip_mail' => $this->input->ip_address()));
                                    }

                                } else {

                                    unset($_SESSION['wrong_login']);
                                    //30 min
                                    set_cookie('wrong_loginc', 1, 3600*24);
                                    set_cookie('wrong_loginx', 1, 60*@$security_login_decode['duration']);
                                }

                                $this->session->setFlashdata('exception', "Try it after ".$security_login_decode['duration']." min");
                            }
                            
                        } else {

                            if ($security_login) {

                                if (1%@$security_login_decode['wrong_try'] == 0) {
                                    //database update ip/account deactive base on session
                                    # code...

                                    $cookie_count = get_cookie('wrong_loginc', TRUE);
                                    if ($cookie_count) {
                                        
                                        unset($_SESSION['wrong_login']);
                                        //1 day
                                        set_cookie('wrong_loginc', $cookie_count+1, 3600*24);
                                        $cookie_count = get_cookie('wrong_loginc', TRUE);

                                        if ($cookie_count >= @$security_login_decode['ip_block']) {
                                            //database update ip/account deactive base on cookie
                                            $this->db->insert('dbt_blocklist', array('ip_mail' => $this->input->ip_address()));
                                        }

                                    } else {
                                        unset($_SESSION['wrong_login']);
                                        //30 min
                                        set_cookie('wrong_loginc', 1, 3600*24);
                                        set_cookie('wrong_loginx', 1, 60*@$security_login_decode['duration']);

                                    }

                                    $cookie_count = get_cookie('wrong_loginc', TRUE);                                
                                    $this->session->setFlashdata('exception', "Try it after ".$security_login_decode['duration']." min");
                                
                                } else {
                                    
                                    $this->session->set('wrong_login', 1);

                                }
                            }                         
                        }
                        
                        $this->session->setFlashdata('exception', display('incorrect_email_password'));
                        return  redirect()->to(base_url('login'));
                    }

                } else {

                    $this->session->setFlashdata('exception', display('something_wrong'));
                    return  redirect()->to(base_url('login'));
                }

            } else {

                $this->session->setFlashdata('exception', display('incorrect_email_password'));
            }
            
        }
        $data['security']  = $this->common_model->findById('dbt_security', array('keyword' => 'capture', 'status' => 1));
        $data['module']    = "Website";
        $data['page']      = 'website/login'; 
        return $this->master->master($data);
    }

    public function email_check($email, $user_id)
    {

        $emailExists = $this->db->select('*')
            ->where('email', $email) 
            ->where_not_in('user_id',$user_id) 
            ->get('dbt_user')
            ->num_rows();

        if ($emailExists > 0) {
            $this->form_validation->set_message('email', 'The {field} is already registered.');
            return false;

        } else {

            return true;
        }
    }

    public function phone_check($phone, $user_id)
    { 
        $emailExists = $this->db->select('phone')
            ->where('phone', $phone) 
            ->where_not_in('user_id',$user_id) 
            ->get('dbt_user')
            ->num_rows();
            
        if ($emailExists > 0) {
            $this->form_validation->set_message('phone_check', 'The {field} is already registered.');
            return false;
        } else {
            return true;
        }
    }


    public function edit_profile()
    {

        if(empty($this->session->get('user_id')))
            return redirect()->to('login');

             
        $data['title']  = "Edit Profile";
        $user_id        = $this->session->get('user_id');

        $this->validation->setRule('first_name', display('firstname'),'required|max_length[50]|trim');
        $this->validation->setRule('email', display('email'), "required|valid_email|max_length[100]|trim");
        $this->validation->setRule('phone', display('phone'), "required|max_length[100]|trim");
        $this->validation->setRule('password', display('password'),'required|max_length[32]|trim');

        if(!empty($this->request->getFile('image'))){

            $this->validation->setRule('image', display('image'), 'ext_in[image,png,jpg,gif,ico]|is_image[image]');
        }

        if($this->validation->withRequest($this->request)->run()){

            $image = $this->imageupload->upload_image($this->request->getFile('image'), 'upload/user/', $this->request->getPost('old_image'), 80, 80);

        } else {

            $image = "";
        }

        $checkEmail = $this->common_model->findById('dbt_user', array('email' => $this->request->getPost('email'), 'user_id !=' => $user_id));
        $checkPhone = $this->common_model->findById('dbt_user', array('phone' => $this->request->getPost('phone'), 'user_id !=' => $user_id));

        if($this->request->getMethod() == 'post'){

            if(!empty($checkEmail)){

                $this->session->setFlashdata('exception', "This E-mail Already Registered!");
                return redirect()->to(base_url("edit-profile"));
            }

            if(!empty($checkPhone)){

                $this->session->setFlashdata('exception', "This Phone Already Used!");
                return redirect()->to(base_url("edit-profile"));
            }

            if ($this->validation->withRequest($this->request)->run()) {

                $user   =  $this->common_model->findById('dbt_user', array('user_id' => $this->session->get('user_id')));
                if ($user->password != md5($this->request->getPost('password'))) {
                    $this->session->setFlashdata('exception', display('password_missmatch'));
                    return redirect()->to(base_url("edit-profile"));
                }
               
                $data['user'] = (object)$userData = array(

                    'user_id'      => $user_id,
                    'first_name'   => $this->request->getPost('first_name', FILTER_SANITIZE_STRING),
                    'last_name'    => $this->request->getPost('last_name', FILTER_SANITIZE_STRING),
                    'email'        => $this->request->getPost('email', FILTER_SANITIZE_STRING),
                    'phone'        => $this->request->getPost('phone', FILTER_SANITIZE_STRING),
                    'bio'          => $this->request->getPost('bio', FILTER_SANITIZE_STRING),
                    'image'        => $image
                );


                if ($this->common_model->update('dbt_user', $userData, array('user_id' => $user_id))) 
                {
                    $this->session->set(array(
                        'fullname' => $this->request->getPost('first_name', FILTER_SANITIZE_STRING). ' ' .$this->request->getPost('last_name', FILTER_SANITIZE_STRING),
                        'email'    => $this->request->getPost('email', FILTER_SANITIZE_STRING),
                        'image'    => $image
                    ));
                    $this->session->setFlashdata('message', display('update_successfully'));

                } else {

                    $this->session->setFlashdata('exception',  display('please_try_again'));

                }
               return redirect()->to(base_url("edit-profile"));

            } else {

                $this->session->setFlashdata("exception", $this->validation->listErrors());
            }
        }

        $data['user']   = $this->common_model->findById('dbt_user', array('user_id' => $this->session->get('user_id')));
        $data['module'] = "Website";
        $data['page']   = 'website/edit_profile'; 
        return $this->master->master($data);
    }



    public function change_password(){

        if(empty($this->session->get('user_id')))
            return redirect()->to('login');

        $data['title'] = "Change Password";

        $this->validation->setRule('old_pass', display('enter_old_password'), 'required|trim');
        $this->validation->setRule('new_pass', display('enter_new_password'), 'required|max_length[32]|matches[confirm_pass]|trim');
        $this->validation->setRule('confirm_pass', display('enter_confirm_password'), 'required|max_length[32]|trim');
        
        if($this->request->getMethod() == 'post'){

            if ( $this->validation->withRequest($this->request)->run())
            {
                $oldpass = MD5($this->request->getPost('old_pass'));
               
                $new_pass['password'] = MD5($this->request->getPost('new_pass'));
                $query = $this->common_model->findById('dbt_user', array('user_id' => $this->session->get('user_id'), 'password' => $oldpass));
                
                if(!empty($query)) {

                    $this->common_model->update('dbt_user', $new_pass, array('user_id' => $this->session->get('user_id')));
                    $this->session->setFlashdata('message', display('password_change_successfull'));
                    return redirect()->to(base_url('change-password'));

                } else {

                    $this->session->setFlashdata('exception',display('old_password_is_wrong'));
                    return redirect()->to(base_url('change-password'));
                }

            } else {

                $this->session->setFlashdata("exception", $this->validation->listErrors());
            }
        }
    
        $data['module'] = "Website";
        $data['page']   = 'website/change_password'; 
        return $this->master->master($data);

    }

    public function login_verify()
    {

        if ($this->session->get('isLogIn'))
           return redirect()->to('login');

        $data['title'] = "2 Factor Authentication";

        $userdata    = $this->session->get('userdata');
        $userlogdata = $this->session->get('userlogdata');

        // 2 factor authentication codes.
        $this->load->library('GoogleAuthenticator'); 

        $query      = $this->db->select('googleauth')->from('dbt_user')->where('user_id',  $userdata['user_id'])->get()->row();
        $appSetting = $this->common_model->get_setting();

        $ga                 = new GoogleAuthenticator();
        $secret             = $query->googleauth;
        $qrCodeUrl          = $ga->getQRCodeGoogleUrl($appSetting->title, $secret);
        $data['qrCodeUrl']  = $qrCodeUrl;

        //Set Rules From validation
        $this->validation->setRule('token', 'token', 'required|max_length[6]|trim');
        
        //From Validation Check
        if ($this->validation->withRequest($this->request)->run())
        {
            $oneCode = $this->request->getPost('token', FILTER_SANITIZE_STRING);
          

            $checkResult = $ga->verifyCode($secret, $oneCode, 2);    // 2 = 2*30sec clock tolerance
            if ($checkResult) {
                $user_agent = array(

                    'device'     => $this->agent->browser(),
                    'browser'    => $this->agent->browser().' V-'.$this->agent->version(),
                    'platform'   => $this->agent->platform()
                );

                $sData = array(

                    'isLogIn'     => true,
                    'id'          => $userdata['id'],
                    'user_id'     => $userdata['user_id'],
                    'fullname'    => $userdata['fullname'],
                    'email'       => $userdata['email']
                );

                $logData = array(

                    'log_type'     => 'login',
                    'access_time'  => $userlogdata['access_time'],
                    'user_agent'   => json_encode($user_agent),
                    'user_id'      => $userlogdata['user_id'],
                    'ip'           => $userlogdata['ip']
                );

                //Unset session, log & Login
                unset($_SESSION['userdata']);
                unset($_SESSION['userlogdata']);

                //Store data to session, log & Login
                $this->session->set($sData);
                $this->common_model->save('dbt_user_log', $logData);
                return redirect()->to(base_url());

            } else {

                $this->session->setFlashdata('exception', display('invalid_authentication_code'));

            }
        }

        $data['module'] = "Website";
        $data['page']   = 'website/gauthlogin'; 
        return $this->master->master($data);
    }

    public function forgotPassword()
    {

        //Set Rules From validation
        $this->validation->setRule('luseremail', display('email'),'required|valid_email|max_length[100]|trim');

        //From Validation Check
        if ($this->validation->withRequest($this->request)->run()){

            $accountCheck = $this->common_model->findById('dbt_user',  array('email' => $this->request->getPost('luseremail')));


            if(!empty($accountCheck->email)){

                $userdata = array(

                    'email' => $this->request->getPost('luseremail', FILTER_SANITIZE_EMAIL),
                );

                $varify_code = $this->randomID();

                /******************************
                *  Email Verify
                ******************************/
                $appSetting = $this->common_model->findById('setting', array());
                $email_theme = $this->common_model->findById('dbt_sms_email_template', array('id' => 9));

                if($this->langSet() == 'english'){

                    $theme_message = @$email_theme->template_en;
                    $theme_subject = @$email_theme->subject_en;

                } else { 

                    $theme_message = @$email_theme->template_fr; 
                    $theme_subject = @$email_theme->subject_fr;
                }

                $post = array(

                    'title'      => $appSetting->title,
                    'subject'    => $theme_subject,
                    'to'         => $this->request->getPost('luseremail', FILTER_SANITIZE_STRING),
                    'varify_code'=> $varify_code,
                    'message'    => $theme_message,
                );

                //Send Mail Password Reset Verification
                $send = $this->common_model->send_email_theme($post);

                if(isset($send)){

                    $varify_data = array(

                        'ip_address'    => $this->request->getipAddress(),
                        'user_id'       => $this->session->get('user_id'),
                        'session_id'    => $this->session->get('isLogIn'),
                        'verify_code'   => $varify_code,
                        'data'          => json_encode($userdata)
                    );

                    $id = $this->common_model->save_return_id('dbt_verify',$varify_data);

                    $this->session->setFlashdata('message', display('password_reset_code_send_check_your_email'));
                    return redirect()->to('resetPassword');
                }

            } else {

                $this->session->setFlashdata('exception', "Your account has not found, Please try again!");
                return redirect()->to('login');
            }

        } else {

            $this->session->setFlashdata('exception', display('email_required'));
            return redirect()->to('login');

        }

    }

    public function resetPassword()
    {   


        $code        = $this->request->getPost('verificationcode', FILTER_SANITIZE_STRING);
        $newpassword = $this->request->getPost('newpassword', FILTER_SANITIZE_STRING);
   
        $chkdata = $this->common_model->findById('dbt_verify', array('verify_code' => $code, 'status' => 1));

        //Set Rules From validation
        $this->validation->setRule('verificationcode', display('enter_verify_code'),'required|max_length[10]|alpha_numeric|trim');
        $this->validation->setRule('newpassword', display('password'),'required|min_length[8]|matches[r_pass]|trim');
        $this->validation->setRule('r_pass', display('password'),'required|trim');

        $security = $this->common_model->findById('dbt_security', array('keyword' => 'capture', 'status' => 1));

        if ($security) {
            //If  goggle capture enable
            $this->validation->setRule('g-recaptcha-response', "Recaptcha", 'required|trim');
            $data = array(

                'widget' => $this->recaptcha->getWidget(),
                'script' => $this->recaptcha->getScriptTag(),
            );
        }
        if($this->request->getMethod() == 'post'){
            //From Validation Check
            if ($this->validation->withRequest($this->request)->run()) {

                if($chkdata!=NULL) {

                    $p_data     = ((array) json_decode($chkdata->data));
                    $password   = array('password' => md5($newpassword));
                    $status     = array('status'   => 0);

                    $this->common_model->update('dbt_verify', $status, array('verify_code' => $code));
                    $this->common_model->update('dbt_user', $password, array('email' => $p_data['email']));

                    $this->session->setFlashdata('message', display('password_changed'));
                    return redirect()->to(base_url('login'));

                } else {

                    $this->session->setFlashdata('exception',display('wrong_try_activation'));
                    return redirect()->to(base_url('resetPassword'));
                }

            } else {

                $this->session->setFlashdata('exception', $this->validation->listErrors());
            }
        }

        $data['security'] = $this->common_model->findById('dbt_security', array('keyword' => 'capture', 'status' => 1));
        $data['module'] = "Website";
        $data['page']   = 'website/passwordreset'; 
        return $this->master->master($data);

    }

    public function googleauth()
    {

        if(empty($this->session->get('user_id')))
            return redirect()->to('login');

        $data['title'] = "2 Factor Authentication";

        // 2 factor authentication codes.
        $query = $this->common_model->findById('dbt_user', array('user_id' => $this->session->get('user_id')));
        $appSetting = $this->common_model->findById('setting', array());
   
        if ($query->googleauth!='') {

            $secret = $query->googleauth;
            $data['btnenable'] = 0;

        } else {

            $secret = $this->ga->createSecret();
            $data['btnenable'] = 1;

        }
        
        $data['secret'] = $secret;

        $qrCodeUrl = $this->ga->getQRCodeGoogleUrl($appSetting->title, $secret);
        $data['qrCodeUrl'] = $qrCodeUrl;


        //Set Rules From validation
        $this->validation->setRule('token', "token", 'required|max_length[6]|trim');
        $this->validation->setRule('secret', "secret", 'required|max_length[16]|trim');
        
        if($this->request->getMethod() == 'post'){
            //From Validation Check
            if ($this->validation->withRequest($this->request)->run())
            {

                if (isset($_POST['disable'])) {

                    $oneCode = $this->request->getPost('token', FILTER_SANITIZE_STRING);
                    $secret = $query->googleauth;
                    $checkResult = $this->ga->verifyCode($secret, $oneCode, 2);
                    // 2 = 2*30sec clock tolerance

                    if ($checkResult) {

                        $secret = NULL;
                      
                        $this->common_model->update('dbt_user', array('googleauth' => $secret), array('user_id' => $this->session->get('user_id')));
                        $this->session->setFlashdata('message', display('google_authenticator_disabled'));
                        return redirect()->to(base_url("profile"));

                    } else {

                        $this->session->setFlashdata('exception', display('invalid_authentication_code'));
                    }
                }

                if (isset($_POST['enable'])) {

                    $oneCode = $this->request->getPost('token', FILTER_SANITIZE_STRING);
                    $secret = $this->request->getPost('secret', FILTER_SANITIZE_STRING);
                    $checkResult = $this->ga->verifyCode($secret, $oneCode, 2);    // 2 = 2*30sec clock tolerance

                    if ($checkResult){

                        $this->common_model->update('dbt_user', array('googleauth' => $secret), array('user_id' => $this->session->get('user_id')));
                        $this->session->setFlashdata('message', display('google_authenticator_enabled'));
                        return redirect()->to(base_url("profile"));

                    } else {

                        $this->session->setFlashdata('exception', display('invalid_authentication_code'));
                    }
                }
                
            } else {

                $this->session->setFlashdata('exception', $this->validation->listErrors());
            }
        }

        $data['module'] = "Website";
        $data['page']   = 'website/googleauthenticator'; 
        return $this->master->master($data);
    }

    public function activate_account($activecode=NULL){
        
        if ($activecode != NULL || $activecode != '') {
            
            $user = $this->common_model->findById('dbt_user', array('password_reset_token' => $activecode));

            if ($user->status == 1){

                $this->session->setFlashdata('message', display('this_account_already_activated'));
                return  redirect()->to(base_url('/login'));

            } elseif ($user->status == 2) {

                $this->session->setFlashdata('exception',  display('this_account_is_now_pending'));
                return  redirect()->to(base_url('/login'));

            } elseif ($user->status == 3) {

                $this->session->setFlashdata('exception',  display('this_account_is_suspend'));
                return  redirect()->to(base_url('/login'));

            } elseif ($user->status == 0) {

                $this->common_model->update('dbt_user', array('status' => 1), array('password_reset_token' => $activecode));
                $this->session->setFlashdata('message', display('active_account'));
                return  redirect()->to(base_url('/login'));

            } else {

                $this->session->setFlashdata('exception', display('something_wrong'));
                return  redirect()->to(base_url('/login'));
            }

        } else {

            $this->session->setFlashdata('exception', display('wrong_try_activation'));
            return  redirect()->to(base_url('/login'));
        }
    }

    //Ajax Subscription Action
    public function subscribe()
    {
        $data = array();
        $data['email'] =  $this->request->getPost('subscribe_email', FILTER_SANITIZE_STRING);
        
        $this->validation->setRule('subscribe_email', display('email'),"required|valid_email|max_length[50]|trim");
        
        if ($this->validation->withRequest($this->request)->run()){

            if($this->common_model->save('web_subscriber', $data)){

                echo 1;

            } else {

                echo 2;
            }
        } else {

            echo 0;
        }
    }

    public function payout_setting($method = NULL)
    {   
        if(empty($this->session->get('user_id')))
            return redirect()->to('login');

        $wallet_id          = $this->request->getPost('wallet_id', FILTER_SANITIZE_STRING);  
        $currency_symbol    = $this->request->getPost('currency_symbol', FILTER_SANITIZE_STRING);  
        $currency_symbol1   = $this->request->getPost('currency_symbol1', FILTER_SANITIZE_STRING);  
        $user_id            = $this->session->get('user_id');

        $data['bitcoin_btc']    = $this->common_model->findById('dbt_payout_method', array('user_id' => $user_id, 'currency_symbol' => 'BTC', 'method' => 'bitcoin'));
        $data['bitcoin_bch']    = $this->common_model->findById('dbt_payout_method', array('user_id' => $user_id, 'currency_symbol' => 'BCH', 'method' => 'bitcoin'));
        $data['bitcoin_ltc']    = $this->common_model->findById('dbt_payout_method', array('user_id' => $user_id, 'currency_symbol' => 'LTC', 'method' => 'bitcoin'));
        $data['bitcoin_dash']   = $this->common_model->findById('dbt_payout_method', array('user_id' => $user_id, 'currency_symbol' => 'DASH', 'method' => 'bitcoin'));
        $data['bitcoin_doge']   = $this->common_model->findById('dbt_payout_method', array('user_id' => $user_id, 'currency_symbol' => 'DOGE', 'method' => 'bitcoin'));
        $data['bitcoin_spd']    = $this->common_model->findById('dbt_payout_method', array('user_id' => $user_id, 'currency_symbol' => 'SPD', 'method' => 'bitcoin'));
        $data['bitcoin_rdd']    = $this->common_model->findById('dbt_payout_method', array('user_id' => $user_id, 'currency_symbol' => 'RDD', 'method' => 'bitcoin'));
        $data['bitcoin_pot']    = $this->common_model->findById('dbt_payout_method', array('user_id' => $user_id, 'currency_symbol' => 'POT', 'method' => 'bitcoin'));
        $data['bitcoin_ftc']    = $this->common_model->findById('dbt_payout_method', array('user_id' => $user_id, 'currency_symbol' => 'FTC', 'method' => 'bitcoin'));
        $data['bitcoin_vtc']    = $this->common_model->findById('dbt_payout_method', array('user_id' => $user_id, 'currency_symbol' => 'VTC', 'method' => 'bitcoin'));
        $data['bitcoin_ppc']    = $this->common_model->findById('dbt_payout_method', array('user_id' => $user_id, 'currency_symbol' => 'PPC', 'method' => 'bitcoin'));
        $data['bitcoin_mue']    = $this->common_model->findById('dbt_payout_method', array('user_id' => $user_id, 'currency_symbol' => 'MUE', 'method' => 'bitcoin'));
        $data['bitcoin_unit']   = $this->common_model->findById('dbt_payout_method', array('user_id' => $user_id, 'currency_symbol' => 'UNIT', 'method' => 'bitcoin'));
        $data['payeer_btc']     = $this->common_model->findById('dbt_payout_method', array('user_id' => $user_id, 'currency_symbol' => 'BTC', 'method' => 'payeer'));
        $data['paypal']         = $this->common_model->findById('dbt_payout_method', array('user_id' => $user_id, 'currency_symbol' => 'USD', 'method' => 'paypal'));
        $data['stripe']         = $this->common_model->findById('dbt_payout_method', array('user_id' => $user_id, 'currency_symbol' => 'USD', 'method' => 'stripe'));
        $data['bank']           = $this->common_model->findById('dbt_payout_method', array('user_id' => $user_id, 'currency_symbol' => 'USD', 'method' => 'bank'));
        $data['phone']          = $this->common_model->findById('dbt_payout_method', array('user_id' => $user_id, 'currency_symbol' => 'USD', 'method' => 'phone'));
        
        if ($method == 'bitcoin') {
            $this->validation->setRule('wallet_id', "Gourl", 'required|alpha_numeric|max_length[50]|trim');
        }else if($method == 'payeer'){
            $this->validation->setRule('wallet_id', "Payeer", 'required|alpha_numeric|max_length[30]|trim');

        }else if($method == 'paypal'){
            $this->validation->setRule('wallet_id', "Paypal", 'required|valid_email|max_length[50]|trim');

        }else if($method == 'stripe'){
            $this->validation->setRule('wallet_id', "Stripe", 'required|max_length[50]|trim');

        }else if($method == 'bank'){
            $this->validation->setRule('wallet_id', "Bank", 'required|max_length[50]|trim');

        }else if($method == 'phone'){
            $this->validation->setRule('wallet_id', "Phone", 'required|numeric|max_length[15]|trim');

        } else {
            $this->validation->setRule('wallet_id', "wallet_id", 'required|alpha_numeric|max_length[100]|trim');
        }
        
        //From Validation Check
        if($this->request->getMethod() == 'post'){

            if ($this->validation->withRequest($this->request)->run())
            {
                if($method != NULL) {
                    $data = array('user_id' => $user_id,'method' => $method,'wallet_id' => $wallet_id,'currency_symbol' => $currency_symbol);
                    $check = $this->common_model->findById('dbt_payout_method', array('user_id' => $user_id, 'method' => $method, 'currency_symbol' => $currency_symbol));

                    if($check != NULL) {
                     
                       $this->common_model->update('dbt_payout_method', $data, array('user_id' => $user_id, 'method' => $method, 'currency_symbol' => $currency_symbol));

                    } else {

                        $this->common_model->save('dbt_payout_method',$data); 
                    }

                    //Only Payeer Account
                    if ($currency_symbol1) {

                        $data1  = array('user_id' => $user_id,'method' => $method,'wallet_id' => $wallet_id,'currency_symbol' => $currency_symbol1);
                     
                        $check1 = $this->common_model->findById('dbt_payout_method',$data1);

                        if($check1 != NULL) {
                           
                           $this->common_model->update('dbt_payout_method', $data1, array('user_id' => $userid, 'method' => $method, 'currency_symbol' => $currency_symbol1));
                        } else {

                            $this->common_model->save('dbt_payout_method',$data1); 
                        }
                    }

                    $this->session->setFlashdata('message',display('update_successfully')); 
                    return redirect()->to(base_url('payout-setting'));
                }
            } else {

                $this->session->setFlashdata("exception", $this->validation->listErrors());
            }
        }

        $data['module'] = "Website";
        $data['page']   = 'website/payout_setting'; 
        return $this->master->master($data);
    }


    public function bank_setting($method = NULL)
    {
        if(empty($this->session->get('user_id')))
            return redirect()->to('login');
        
        $user_id = $this->session->get('user_id');

        //Set Rules From validation
        $this->validation->setRule('acc_name', display('account_name'), 'required|max_length[100]|trim');
        $this->validation->setRule('acc_no', display('account_no'), 'required|max_length[100]|trim');
        $this->validation->setRule('branch_name', display('branch_name'), 'required|max_length[100]|trim');
        $this->validation->setRule('country', display('country'), 'required|max_length[100]|trim');
        $this->validation->setRule('bank_name', display('bank_name'), 'required|max_length[100]|trim');

        if($this->request->getMethod() == 'post'){
        //From Validation Check
            if ($this->validation->withRequest($this->request)->run())
            {

                $user_id        = $this->session->get('user_id');
                $currency_symbol= $this->request->getPost('currency_symbol', FILTER_SANITIZE_STRING);
                $acc_name       = $this->request->getPost('acc_name', FILTER_SANITIZE_STRING);
                $acc_no         = $this->request->getPost('acc_no', FILTER_SANITIZE_STRING);
                $branch_name    = $this->request->getPost('branch_name', FILTER_SANITIZE_STRING);
                $swift_code     = $this->request->getPost('swift_code', FILTER_SANITIZE_STRING);
                $abn_no         = $this->request->getPost('abn_no', FILTER_SANITIZE_STRING);
                $country        = $this->request->getPost('country', FILTER_SANITIZE_STRING);
                $bank_name      = $this->request->getPost('bank_name', FILTER_SANITIZE_STRING);

                $post_data = $this->request->getPost(NULL, FILTER_SANITIZE_STRING);

                $wallet_id = json_encode($post_data);

                if($method != NULL) {

                    $data  = array('user_id'=>$user_id,'method'=> $method, 'wallet_id'=> $wallet_id, 'currency_symbol' => $currency_symbol);
                    $check = $this->common_model->findById('dbt_payout_method', array('user_id' => $user_id, 'method' => $method, 'currency_symbol' => $currency_symbol));

                    if($check != NULL) {
                       
                       $this->common_model->update('dbt_payout_method', $data, array('user_id' => $user_id, 'method' => $method, 'currency_symbol' => $currency_symbol));

                    } else {

                        $this->common_model->save('dbt_payout_method', $data); 
                    }

                    $this->session->setFlashdata('message',display('update_successfully')); 
                    return redirect()->to(base_url('bank-setting'));
                }

            } else {

                $this->session->setFlashdata("exception", $this->validation->listErrors());
            }
        }

        $bank = $this->common_model->findById('dbt_payout_method', array('user_id' => $user_id, 'currency_symbol' => 'usd', 'method' => 'bank'));

        if ($bank) {

            $jsonbank = $bank->wallet_id;
            $json_decode_bank = json_decode($jsonbank, true);

            $data['acc_name']     = @$json_decode_bank['acc_name'];
            $data['acc_no']       = @$json_decode_bank['acc_no'];
            $data['branch_name']  = @$json_decode_bank['branch_name'];
            $data['swift_code']   = @$json_decode_bank['swift_code'];
            $data['abn_no']       = @$json_decode_bank['abn_no'];
            $data['country']      = @$json_decode_bank['country'];
            $data['bank_name']    = @$json_decode_bank['bank_name'];
        }

        $data['countrys'] = $this->common_model->findAll('dbt_country', array(), 'id', 'asc');

        $data['module'] = "Website";
        $data['page']   = 'website/bank_setting'; 
        return $this->master->master($data);
    }

    //Ajax Language Change
    public function langChange()
    {
        $newdata = array(
            'lang'  => $this->request->getPost('lang', FILTER_SANITIZE_STRING)
        );        

        $user_id = $this->session->get('user_id');
        if ($user_id != "") {
            $data['language'] = $this->request->getPost('lang', FILTER_SANITIZE_STRING);
            if($this->common_model->update('dbt_user', $data, array('user_id' => $user_id))){
                echo 1;
            } else {
                echo 2;
            }
        } else {
            $this->session->set($newdata);
        }
    }


    /******************************
    * Language Set For User
    ******************************/
    public function langSet(){

        $lang = "";
        $user_id = $this->session->get('user_id');

        if ($user_id!="") {

            $ulang = $this->db->table('dbt_user')->select('language')->where('user_id', $user_id)->get()->getRow();

            if ($ulang->language != 'english') {

                $lang    ='french';
                $newdata = array(
                    'lang'  => 'french'
                );
                $this->session->set($newdata);

            } else {
                $lang    ='english';
                $newdata = array(
                    'lang'  => 'french'
                );
                $this->session->set($newdata);
            }

        } else {

            $alang      = $this->common_model->findById('setting', array());

            if ($alang->language=='french') {

                $lang    ='french';
                $newdata = array(
                    'lang'  => 'french'
                );
                $this->session->set($newdata);

            } else {

                if ($this->session->lang=='french'){

                    $lang ='french';

                } else {

                    $lang ='english';
                }

            }

        }
        return $lang;
    }

    public function fees_load($amount=null,$method=null,$level,$coin=null)
    {   

        $result = $this->db->select('*')
            ->from('dbt_fees')
            ->where('level', $level)
            ->where('currency_symbol', $coin)
            ->get()
            ->row();

        return $fees = ($amount/100)*$result->fees;
        
    }

    /*
    |----------------------------
    | Get news details
    |----------------------------
    */
    public function news_details()
    {
        $newsId = $this->request->getPost('newsId');
        $result = $this->common_model->findById('web_news',  array('article_id' => $newsId));
        echo json_encode($result);
    }

    public function randomID($mode = 2, $len = 6)
    {
        $result = "";

        if($mode == 1):
            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        elseif($mode == 2):
            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        elseif($mode == 3):
            $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        elseif($mode == 4):
            $chars = "0123456789";
        endif;

        $charArray = str_split($chars);

        for($i = 0; $i < $len; $i++) {

            $randItem = array_rand($charArray);
            $result .="".$charArray[$randItem];
        }
        return $result;
    }

	//--------------------------------------------------------------------
}
