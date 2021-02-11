<?php namespace App\Controllers;

class Home extends BaseController
{
	
	public function index()
    {
       
        $data = [];

        $this->load->view('website/header', $data);     
        $this->load->view('website/index', $data);
        $this->load->view('website/footer', $data);
    }

    public function dafult_data(){

        $data['payment_gateway'] = $this->common_model->payment_gateway();
        $data['coin_list']       = $this->web_model->activeCoin();

        echo json_encode($data);
    }

    public function getStream()
    { 
        $cryptocoins = $this->db->select("Symbol")
                        ->from('cryptolist')
                        ->order_by('SortOrder', 'asc')
                        ->limit(200, 0)
                        ->get()
                        ->result();

        $coin_stream = array();
        foreach ($cryptocoins as $coin_key => $coin_value) {
            array_push($coin_stream, "5~CCCAGG~".$coin_value->Symbol."~USD");
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

        if (!$this->web_model->catidBySlug($this->uri->segment(1))) {
            redirect(base_url());
        }

        $data['title']      = $this->uri->segment(1);
        $cat_id             = $this->web_model->catidBySlug($this->uri->segment(1));
        $data['cat_info']   = $this->web_model->cat_info($this->uri->segment(1));
        $data['article']    = $this->web_model->article($this->web_model->catidBySlug($this->uri->segment(1))->cat_id);

        
        if ($this->uri->segment(1)=='faq') {
            $data['article']    = $this->web_model->article($cat_id->cat_id);
            $data['cat_info']   = $this->web_model->cat_info($this->uri->segment(1));

            $this->load->view('website/header', $data);     
            $this->load->view('website/faq', $data);
            $this->load->view('website/footer', $data);

        } else {

            $this->load->view('website/header', $data);
            $this->load->view('website/page', $data);
            $this->load->view('website/footer', $data);
        }        

    }

    public function contact()
    {


        $data['title']      = $this->uri->segment(1);
        $cat_id             = $this->web_model->catidBySlug($this->uri->segment(1));
        $data['article']    = $this->web_model->article($cat_id->cat_id);
        $data['cat_info']   = $this->web_model->cat_info($this->uri->segment(1));
        $map_api            = $this->web_model->findById('external_api_setup', array('id'=>2));
        $data['map_api']    = json_decode($map_api->data);

        $this->load->view('website/header', $data);     
        $this->load->view('website/contact', $data);
        $this->load->view('website/footer', $data);
        
    }

     //Ajax Contact Message Action
    public function contactMsg()
    {
        $appSetting = $this->common_model->get_setting();
        
        $data['fromName']       = $this->input->post('first_name', TRUE)." ".$this->input->post('last_name', TRUE);
        $data['from']           = $this->input->post('email', TRUE);
        $data['to']             = $appSetting->email;
        $data['subject']        = display('leave_us_a_message');
        $data['message']        = "<b>".display('phone').": </b>".$this->input->post('phone', TRUE)."<br><b>".display('company').": </b>".$this->input->post('company', TRUE)."<br><b>".display('message').": </b>".$this->input->post('comment', TRUE);

        $this->common_model->send_email($data);

    }

    public function settings(){
        $appSetting = $this->web_model->findById('setting', array());
        echo json_encode($appSetting);
    }
    //Ajax Chat Message Action
    public function ajaxMessageChat()
    {
        $message = $this->input->post('message', TRUE);

        $this->form_validation->set_rules('message', 'message','required|max_length[100]|trim');

        $data = array();
        if ($this->form_validation->run()) 
        {
            $data = array(
                'user_id'   =>  $this->session->userdata('user_id'),
                'message'   =>  $message,
                'datetime'  =>  date('Y-m-d H:i:s'),
            );
            $this->db->insert('dbt_chat', $data);
        }

        echo json_encode($data);
    }

    //Ajax Chat Message Action
    public function jsonMessageStream()
    {

        $message = $this->db->select('*')->from('dbt_chat')->order_by('datetime', 'desc')->limit(4)->get()->result();

        $messages = array();
        foreach ($message as $key => $value) {
            array_push($messages, array(
                'message'        => $value->message,
                'datetime'       => $value->datetime
                )
            );
        }
        echo json_encode($messages);
    }

    public function exchange()
    {

        $data['title'] = $this->uri->segment(1);

        $market_symbol          = $this->input->get('market', TRUE);
        $coin_symbol            = explode('_', $market_symbol);
        $data['coin_symbol']    = $coin_symbol;
        $data['adapter_symbol'] = $market_symbol;

        if (!$market_symbol) {
            $query_pair = $this->db->select('*')->from('dbt_coinpair')->where('status', 1)->order_by('id','asc')->get()->row(); 
            redirect(base_url("exchange/?market=$query_pair->symbol"));
        }

        $data['balance_to']     = $this->web_model->checkBalance($coin_symbol[1]);
        $data['fee_to']         = $this->web_model->checkFees('BUY', $coin_symbol[1]);
   
        $data['balance_from']   = $this->web_model->checkBalance($coin_symbol[0]);
        $data['fee_from']       = $this->web_model->checkFees('SELL', $coin_symbol[0]);
        $data['coin_markets']   = $this->web_model->coinMarkets();
        $data['coin_pairs']     = $this->web_model->coinPairs();

        $cat_id                 = $this->web_model->catidBySlug('notice');
        $data['notice']         = $this->web_model->tradeNotice($cat_id->cat_id, 3);
        $data['market_details'] = $this->web_model->marketDetails($market_symbol);

        @$cat_id = $this->web_model->catidBySlug('exchange');
        $data['article']        = $this->web_model->article(@$cat_id->cat_id);
        $data['news']           = $this->db->select("*")->from('web_news')->order_by('article_id', 'desc')->limit(4)->get()->result();
        $data['news_cat']       = $this->db->select("*")->from('web_category')->where('slug', 'news')->get()->row();

        $this->load->view('website/header', $data);     
        $this->load->view('website/exchange', $data);
        $this->load->view('website/footer', $data);

    }

    public function balances()
    {
        if (!($this->session->userdata('isLogIn') && $this->session->userdata('user_id')))
            redirect('login');

        $data['title']     = $this->uri->segment(1);
        $data['balances']  = $this->web_model->checkUserAllBalance1();
        $data['total']     = $this->web_model->checkUserAllBalance();
        $data['coin_list'] = $this->web_model->activeCoin();

        $this->load->view('website/header', $data);     
        $this->load->view('website/balances', $data);
        $this->load->view('website/footer', $data);

    }

    public function open_order()
    {
        if (!($this->session->userdata('isLogIn') && $this->session->userdata('user_id')))
            redirect('login');

        $data['title']           = $this->uri->segment(1);
        $data['open_trade']      = $this->web_model->openTrade();

        $this->load->view('website/header', $data);     
        $this->load->view('website/open_order', $data);
        $this->load->view('website/footer', $data);

    }

    public function complete_order()
    {
        if (!($this->session->userdata('isLogIn') && $this->session->userdata('user_id')))
            redirect('login');

        $data['title']           = $this->uri->segment(1);
        $data['complete_trade']  = $this->web_model->completeTrade();

        $this->load->view('website/header', $data);     
        $this->load->view('website/complete_order', $data);
        $this->load->view('website/footer', $data);

    }

    public function trade_history()
    {
        if (!($this->session->userdata('isLogIn') && $this->session->userdata('user_id')))
            redirect('login');

        $data['title']              = $this->uri->segment(1);
        $data['user_trade_history'] = $this->web_model->userTradeHistory();

       
        $this->load->view('website/header', $data);     
        $this->load->view('website/trade_history', $data);
        $this->load->view('website/footer', $data);

    }

    public function profile()
    {
        if (!($this->session->userdata('isLogIn') && $this->session->userdata('user_id')))
            redirect('login');

        $data['title']      = $this->uri->segment(1);
        $data['user_info']  = $this->web_model->retriveUserInfo();
        $data['user_log']   = $this->web_model->retriveUserlog();

        $this->load->view('website/header', $data);     
        $this->load->view('website/profile', $data);
        $this->load->view('website/footer', $data);

    }

    public function profile_verify()
    {
        if (!($this->session->userdata('isLogIn') && $this->session->userdata('user_id')))
            redirect('login');

        $data['title']  = $this->uri->segment(1);
        $date           = new DateTime();
        $submit_time    = $date->format('Y-m-d H:i:s');

        $this->form_validation->set_rules('verify_type', 'verify_type','required|trim');
        $this->form_validation->set_rules('first_name', display('firstname'),'required|max_length[20]|alpha_numeric_spaces|trim');
        $this->form_validation->set_rules('last_name', display('lastname'),'required|max_length[20]|alpha_numeric_spaces|trim');
        $this->form_validation->set_rules('gender', 'gender','required|trim');
        $this->form_validation->set_rules('id_number', display('id_numder'),'required|max_length[20]|alpha_numeric|trim');
        
        //From Validation Check
        if ($this->form_validation->run()) 
        {
            //Set Upload File Config 
            $config = [
                'upload_path'       => 'upload/documents/',
                'allowed_types'     => 'jpg|png|jpeg', 
                'overwrite'         => false,
                'maintain_ratio'    => true,
                'encrypt_name'      => true,
                'remove_spaces'     => true,
                'file_ext_tolower'  => true 
            ];

            $document1  = "";
            $document2  = "";

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('document1')) {  
                $data       = $this->upload->data();  
                $document1  = $config['upload_path'].$data['file_name'];

            }
            if ($this->upload->do_upload('document2')) {  
                $data       = $this->upload->data();  
                $document2  = $config['upload_path'].$data['file_name'];

            }


            $data['verify_info']   = (object)$verify_info = array(
                'user_id'     => $this->session->userdata('user_id'),
                'verify_type' => $this->input->post('verify_type', TRUE), 
                'first_name'  => $this->input->post('first_name', TRUE),
                'last_name'   => $this->input->post('last_name', TRUE),
                'gender'      => $this->input->post('gender', TRUE),
                'id_number'   => $this->input->post('id_number', TRUE),
                'document1'   => $document1,
                'document2'   => $document2,
                'date'        => $submit_time
            );

            if ($this->web_model->userVerifyDataStore($verify_info)) {

                //Update User table for Verify Processing
                $this->db->set('verified', '3')->where('user_id', $this->session->userdata('user_id'))->update("dbt_user");
                $this->session->set_flashdata('message', display('verification_is_being_processed'));

            } else {
                $this->session->set_flashdata('exception', display('please_try_again'));

            }

            redirect("profile");
        }

    
        $this->load->view('website/header', $data);     
        $this->load->view('website/profile_verify', $data);
        $this->load->view('website/footer', $data);

    }

    public function deposit($deposit_coin = null)
    {
        if (!($this->session->userdata('isLogIn') && $this->session->userdata('user_id')))
            redirect('login');

        if ($this->session->userdata('deposit')) {
            $this->session->unset_userdata('deposit');

        }

        $data['title'] = $this->uri->segment(1);

        $this->form_validation->set_rules('crypto_coin', display('cryptocoin'),'required|alpha_numeric|trim');
        $this->form_validation->set_rules('amount', display('amount'),'required|numeric|greater_than[0]|trim');
        $this->form_validation->set_rules('method', display('payment_method'),'required|alpha_numeric|trim');

        $date           = new DateTime();
        $deposit_date   = $date->format('Y-m-d H:i:s');

        if ($this->form_validation->run()) 
        {

            if ($this->input->post('method')=='phone') {
                $mobiledata =  array(
                    'om_name'         => $this->input->post('om_name', TRUE),
                    'om_mobile'       => $this->input->post('om_mobile', TRUE),
                    'transaction_no'  => $this->input->post('transaction_no', TRUE),
                    'idcard_no'       => $this->input->post('idcard_no', TRUE),
                );
                $comment = json_encode($mobiledata);

            }else if ($this->input->post('method')=='bank') {

                $user_id     = $this->session->userdata('user_id'); 
                $crypto_coin = $this->input->post('crypto_coin', TRUE); 
               
                $user_bank = $this->db->select('*')
                        ->from('dbt_payout_method')
                        ->where('method', 'bank')
                        ->where('currency_symbol', $crypto_coin)
                        ->where('user_id', $user_id)
                        ->get()
                        ->row();

                if ($user_bank) {                    
                    $jsondecode_bank = json_decode($user_bank->wallet_id, true);

                    //Set Upload File Config 
                    $config = [
                        'upload_path'       => 'upload/documents/',
                        'allowed_types'     => 'jpg|png|jpeg|pdf', 
                        'overwrite'         => false,
                        'maintain_ratio'    => true,
                        'encrypt_name'      => true,
                        'remove_spaces'     => true,
                        'file_ext_tolower'  => true 
                    ];

                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('document')) {  
                        $doc_data                       = $this->upload->data();  
                        $document['document']           = $config['upload_path'].$doc_data['file_name'];
                        $jsondecode_bank['document']    =   $document['document'];
                    }

                    $comment = json_encode($jsondecode_bank);

                } else {

                    $this->session->set_flashdata('exception', display('please_setup_your_bank_account'));
                    redirect('bank-setting');
                }

            } else {
                $comment = $this->input->post('comment', TRUE);

            }

            // check balance            
            $fees_val       = $this->web_model->checkFees('DEPOSIT', $this->input->post('crypto_coin', TRUE));
            //Fees in Percent
            $fees = ($this->input->post('amount', TRUE)/100)*@$fees_val->fees;

            $sdata['deposit']   = (object)$userdata = array(
                'user_id'        => $this->session->userdata('user_id'),
                'currency_symbol'=> $this->input->post('crypto_coin', TRUE),
                'amount'         => $this->input->post('amount', TRUE),
                'method_id'      => $this->input->post('method', TRUE),
                'fees_amount'    => $fees,
                'comment'        => $comment,
                'status'         => 0,
                'deposit_date'   => $deposit_date,
                'ip'             => $this->input->ip_address()
            );

            //Store Deposit Session Data
            $this->session->set_userdata($sdata);

            redirect("payment-process");
        }

        $data['payment_gateway'] = $this->common_model->payment_gateway();
        $data['coin_list']       = $this->web_model->activeCoin();

        $this->load->view('website/header', $data);     
        $this->load->view('website/deposit', $data);
        $this->load->view('website/footer', $data);

    }

    public function payment_process()
    {
        $data['deposit'] = $this->session->userdata('deposit');

        //Payment Type specify for callback (deposit/buy/sell etc )
        $this->session->set_userdata('payment_type', 'deposit');

        $method                 = $data['deposit']->method_id;
        $data['deposit_data']   = $this->payment->payment_process($data['deposit'], $method);

        if (!$data['deposit_data']) {
            $this->session->set_flashdata('exception', display('this_gateway_deactivated'));
            redirect('deposit');
        }

        $this->load->view('website/header', $data);     
        $this->load->view('website/payment_process', $data);
        $this->load->view('website/footer', $data);

    }

    public function withdraw($deposit_coin = null)
    {
        if (!($this->session->userdata('isLogIn') && $this->session->userdata('user_id')))
            redirect('login');

        $data['title'] = $this->uri->segment(1);

        $this->form_validation->set_rules('amount', display('amount'), 'required|numeric|greater_than[0]|trim'); 
        $this->form_validation->set_rules('crypto_coin', display('cryptocoin'), 'required|alpha_numeric|trim'); 
        $this->form_validation->set_rules('varify_media', display('otp_send_to'), 'required|trim');

        if($this->input->post('method')=='coinpayment' || $this->input->post('method')=='token')
        {
            $this->form_validation->set_rules('wallet_address', 'Your Address', 'required|max_length[50]|trim');

        }
        else{
            $this->form_validation->set_rules('walletid', display('wallet_id'), 'required|trim');

        } 


        if($this->form_validation->run()){

            $amount         = $this->input->post('amount', TRUE);
            $crypto_coin    = $this->input->post('crypto_coin', TRUE);
            $varify_media   = $this->input->post('varify_media', TRUE);
            $walletid       = $this->input->post('walletid', TRUE);

            $appSetting     = $this->common_model->get_setting();
            $varify_code    = $this->randomID();            
            $userinfo       = $this->web_model->retriveUserInfo();

            // check balance            
            $fees_val       = $this->web_model->checkFees('WITHDRAW', $crypto_coin);
            $balance        = $this->web_model->checkBalance($crypto_coin);

            //Fees in Percent
            $fees = ($amount/100)*@$fees_val->fees;

            $where = "WEEK(`request_date`) = WEEK(CURDATE()) AND YEAR(`request_date`) = YEAR(CURDATE()) AND MONTH(`request_date`) = MONTH(CURDATE()) AND currency_symbol = '".$crypto_coin."' AND status !=0";

            $balance7days = $this->db->select_sum('amount')->from('dbt_withdraw')->where($where)->where('user_id', $userinfo->user_id)->get()->row();

            //Withdraw Limit Check (VERIFIED/UNVERIFIED)
            if ($userinfo->verified==1){
                $trnSetup = $this->db->select('*')->from('dbt_transaction_setup')->where('trntype', 'WITHDRAW')->where('acctype', 'VERIFIED')->where('currency_symbol', $crypto_coin)->where('status', 1)->get()->row();
                if ($trnSetup) {
                    if (@$trnSetup->upper <= (@$balance7days->amount+$amount+@$fees)) {
                        $this->session->set_flashdata('exception', display('your_weekly_limit_exceeded'));
                        redirect('withdraw');
                    }
                }
                
            }else{
                $trnSetup = $this->db->select('*')->from('dbt_transaction_setup')->where('trntype', 'WITHDRAW')->where('acctype', 'UNVERIFIED')->where('currency_symbol', $crypto_coin)->where('status', 1)->get()->row();

                if ($trnSetup) {
                    if (@$trnSetup->upper <= (@$balance7days->amount+$amount+@$fees)) {
                        $this->session->set_flashdata('exception', display('your_weekly_limit_exceeded'));
                        redirect('withdraw');
                    }
                }
                
            }

            $pending_withdraw = $this->db->select('SUM(amount)+SUM(fees_amount) as amount',FALSE)->from('dbt_withdraw')->where('currency_symbol', $crypto_coin)->where('status', 2)->where('user_id', $userinfo->user_id)->get()->row();

            if((@$balance->balance-(float)@$pending_withdraw->amount) < ($amount+$fees) && ($amount+$fees)<0){

                $this->session->set_flashdata('exception', display('balance_is_unavailable'));
                redirect('withdraw');

            } else {

                if($varify_media==2){

                    /***************************
                    *      Email Verify SMTP
                    ***************************/
                    $post = array(
                        'title'      => $appSetting->title,
                        'subject'    => 'Withdraw Verification!',
                        'to'         => $this->session->userdata('email'),
                        'message'    => 'You Withdraw The Amount Is '.$crypto_coin." ".$this->input->post('amount', TRUE).'. The Verification Code is <h1>'.$varify_code.'</h1>',
                    );
                    $code_send = $this->common_model->send_email($post);

                } else {
                
                    /***************************
                    *      SMS Verify
                    ***************************/                 
                    $this->load->library('sms_lib');

                    $template = array( 
                        'name'       => $this->session->userdata('fullname'),
                        'amount'     => $this->input->post('amount', TRUE),
                        'crypto_coin'=> $this->input->post('crypto_coin', TRUE),
                        'code'       => $varify_code,
                        'date'       => date('d F Y')
                    );
                    
                    if (@$userinfo->phone) {
                        $code_send = $this->sms_lib->send(array(
                            'to'                => $userinfo->phone, 
                            'template'          => 'Hello! %name% You Withdraw The Amount Is %crypto_coin% %amount%, The Verification Code is %code% ', 
                            'template_config'   => $template, 
                        ));

                    }else{

                        $this->session->set_flashdata('exception', display('there_is_no_phone_number'));

                    }
                    
                }

                if(@$code_send!=NULL){

                    // GET withdraw fees
                    if($this->input->post('method')=='coinpayment' || $this->input->post('method')=='token'){
                        $wallet_id = $this->input->post('wallet_address', TRUE);
                    }
                    else{
                        $wallet_id = $this->input->post('walletid', TRUE);
                    }

                    $withdraw = array(
                        'user_id'         => $this->session->userdata('user_id'),
                        'wallet_id'       => $wallet_id,
                        'currency_symbol' => $this->input->post('crypto_coin', TRUE),
                        'amount'          => $this->input->post('amount', TRUE),
                        'method'          => $this->input->post('method', TRUE),
                        'fees_amount'     => $fees,
                        'comment'         => '',    
                        'request_date'    => date('Y-m-d H:i:s'),                    
                        'status'          => 2,                
                        'ip'              => $this->input->ip_address(),
                    );

                    $varify_data = array(
                        'ip_address'    => $this->input->ip_address(),
                        'user_id'       => $this->session->userdata('user_id'),
                        'session_id'    => $this->session->userdata('isLogIn'),
                        'verify_code'   => $varify_code,
                        'data'          => json_encode($withdraw)

                    );

                    $result = $this->web_model->verify($varify_data);
                    redirect('withdraw-confirm/'.$result['id']);

                }else{
                    $this->session->set_flashdata('exception', display('server_problem'));
                    redirect('withdraw');

                }

            }     

        }

        $data['payment_gateway'] = $this->common_model->payment_gateway();
        $data['coin_list'] = $this->web_model->activeCoin();


        $this->load->view('website/header', $data);     
        $this->load->view('website/withdraw', $data);
        $this->load->view('website/footer', $data);

    }

    public function withdraw_confirm($id = null){

        $data['v'] = $this->web_model->get_verify_data($id);

        if($data['v']!=NULL){
            $data['title']   = $this->uri->segment(1);
            
        } else {
            redirect('withdraw');

        }

        $this->load->view('website/header', $data);     
        $this->load->view('website/confirm_withdraw', $data);
        $this->load->view('website/footer', $data);
        

    }

    public function withdraw_verify()
    {

        $code   = $this->input->post('code', TRUE);
        $id     = $this->input->post('id', TRUE);

        // check verify code
        $data = $this->db->select('*')
            ->from('dbt_verify')
            ->where('verify_code',$code)
            ->where('id',$id)
            ->where('session_id',$this->session->userdata('isLogIn'))
            ->where('status',1)
            ->get()
            ->row();

        $userinfo = $this->web_model->retriveUserInfo();

        if($data!=NULL) {

            $t_data = ((array) json_decode($data->data));

            $this->db->set('status',0)
                ->where('id',$this->input->post('id', TRUE))
                ->where('session_id',$this->session->userdata('isLogIn'))
                ->update('dbt_verify');

            $wdstatus  = $this->web_model->coinpayment_withdraw();            
            if($t_data['method']== "coinpayment" && $wdstatus==1){      
                       
                $method = $t_data['method'];
                $withdraw_result = $this->payment->payment_withdraw($t_data,$method);

                if($withdraw_result['error']=='ok'){

                    $txn_id = $withdraw_result['result']['id'];
                    $t_data['comment'] = $txn_id;
                    $result = $this->web_model->withdraw($t_data);
                }
                else{
                    $this->session->set_flashdata("exception",$withdraw_result);
                }
            }
            else{
                $result = $this->web_model->withdraw($t_data);
            }

            $this->session->set_flashdata('message', display('withdraw_successfull'));
            echo $result['id'];

        } else {
            echo '';

        }
        
    }

    public function withdraw_details($id=NULL)
    {
        $user_id          = $this->session->userdata('user_id');
        $data['title']    = $this->uri->segment(1); 

        $data['my_info']  = $this->web_model->retriveUserInfo();
        $data['withdraw'] = $this->web_model->get_withdraw_by_id($id);

        $this->load->view('website/header', $data);     
        $this->load->view('website/withdraw_details', $data);
        $this->load->view('website/footer', $data); 

    }

    public function transfer()
    {
        if (!($this->session->userdata('isLogIn') && $this->session->userdata('user_id')))
            redirect('login');

        $data['title'] = $this->uri->segment(1);

        $this->form_validation->set_rules('receiver_id', display('receiver_id'), 'required|alpha_numeric|trim'); 
        $this->form_validation->set_rules('amount', display('amount'), 'required|numeric|greater_than[0]|trim'); 
        $this->form_validation->set_rules('varify_media', display('otp_send_to'), 'required|alpha_numeric|trim');  

        if($this->form_validation->run()){

            $crypto_coin    = $this->input->post('crypto_coin', TRUE);
            $varify_media   = $this->input->post('varify_media', TRUE);
            $receiver_id    = $this->input->post('receiver_id', TRUE);
            $amount         = $this->input->post('amount', TRUE);
            $varify_code    = $this->randomID();
            $existReceiver  = $this->web_model->checkUseridExist($receiver_id);

            if (!$existReceiver) {
                $this->session->set_flashdata('exception', display('receiver_not_valid'));
                redirect('transfer');
            }

            $appSetting     = $this->common_model->get_setting();
            $userinfo       = $this->web_model->retriveUserInfo();

            // check balance            
            $fees_val       = $this->web_model->checkFees('TRANSFER', $crypto_coin);
            $balance        = $this->web_model->checkBalance($crypto_coin);

            //Fees in Percent
            $fees = ($amount/100)*@$fees_val->fees;

            $where          = "WEEK(`date`) = WEEK(CURDATE()) AND YEAR(`date`) = YEAR(CURDATE()) AND MONTH(`date`) = MONTH(CURDATE())  AND currency_symbol = '".$crypto_coin."'";
            $balance7days   = $this->db->select_sum('amount')->from('dbt_transfer')->where($where)->where('sender_user_id', $userinfo->user_id)->get()->row();

            //Withdraw Limit Check (VERIFIED/UNVERIFIED)
            if ($userinfo->verified==1){
                $trnSetup = $this->db->select('*')->from('dbt_transaction_setup')->where('trntype', 'TRANSFER')->where('acctype', 'VERIFIED')->where('currency_symbol', $crypto_coin)->where('status', 1)->get()->row();
                if ($trnSetup) {
                    if (@$trnSetup->upper < (@$balance7days->amount+$amount+$fees)) {
                        $this->session->set_flashdata('exception', display('your_weekly_limit_exceeded'));
                        redirect('transfer');
                    }
                }
                
            }else{
                $trnSetup = $this->db->select('*')->from('dbt_transaction_setup')->where('trntype', 'TRANSFER')->where('acctype', 'UNVERIFIED')->where('currency_symbol', $crypto_coin)->where('status', 1)->get()->row();

                if ($trnSetup) {
                    if (@$trnSetup->upper < (@$balance7days->amount+$amount+$fees)) {
                        $this->session->set_flashdata('exception', display('your_weekly_limit_exceeded'));
                        redirect('transfer');
                    }
                }
                
            }

            $pending_withdraw = $this->db->select('SUM(amount)+SUM(fees_amount) as amount',FALSE)->from('dbt_withdraw')->where('currency_symbol', $crypto_coin)->where('status', 2)->where('user_id', $userinfo->user_id)->get()->row();

            if((@$balance->balance-(float)@$pending_withdraw->amount) < ($amount+$fees) && ($amount+$fees)<0){

                $this->session->set_flashdata('exception', display('balance_is_unavailable'));
                redirect('transfer');

            } else {
                
                if($varify_media==2){
                    /***************************
                    *   Email Verify SMTP
                    ***************************/
                    $post = array(
                        'title'             => $appSetting->title,
                        'subject'           => 'Transfer Verification!',
                        'to'                => $this->session->userdata('email'),
                        'message'           => 'You are about to transfar '.$crypto_coin.' '.$amount.' to the account '.$receiver_id.'. Your code is <h1>'.$varify_code.'</h1>',
                    );
                    $code_send = $this->common_model->send_email($post);

                } else {                    
                    /***************************
                    *   SMS Verify
                    ***************************/
                    $this->load->library('sms_lib');
                    $template = array( 
                        'name'          => $this->session->userdata('fullname'),
                        'amount'        => $amount,
                        'crypto_coin'    => $this->input->post('crypto_coin', TRUE),
                        'receiver_id'   => $receiver_id,
                        'code'          => $varify_code
                    );

                    if (@$userinfo->phone) {
                        $code_send = $this->sms_lib->send(array(
                            'to'                => $userinfo->phone, 
                            'template'          => 'You are about to transfar %crypto_coin% %amount%, to the account %receiver_id%, Your code is %code%',
                            'template_config'   => $template,
                        ));

                    }else{

                        $this->session->set_flashdata('exception', display('there_is_no_phone_number'));

                    }

                }


                if(@$code_send!=NULL){                    

                    $transfar = array(
                        'sender_user_id'    => trim($this->session->userdata('user_id')),
                        'receiver_user_id'  => trim($this->input->post('receiver_id', TRUE)),
                        'amount'            => $this->input->post('amount', TRUE),
                        'currency_symbol'   => $this->input->post('crypto_coin', TRUE),
                        'fees'              => $fees,
                        'request_ip'        => $this->input->ip_address(),
                        'date'              => date('Y-m-d H:i:s'),
                        'comments'          => $this->input->post('comments', TRUE),
                        'status'            => 1,

                    );

                    $varify_data = array(
                        'ip_address' => $this->input->ip_address(),
                        'user_id' => $this->session->userdata('user_id'),
                        'session_id' => $this->session->userdata('isLogIn'),
                        'verify_code' => $varify_code,
                        'data' => json_encode($transfar)

                    );

                    $result = $this->web_model->verify($varify_data);
                    redirect('transfer-confirm/'.$result['id']);
                    
                }else{

                    $this->session->set_flashdata('exception', display('server_problem'));
                    redirect('transfer');
                }
                
            }

        }

        
        $data['coin_list'] = $this->web_model->activeCoin();

        $this->load->view('website/header', $data);     
        $this->load->view('website/transfer', $data);
        $this->load->view('website/footer', $data);

    }

    // confirm_transfer
    public function transfer_confirm($id = null)
    {

        $data['v']    = $this->web_model->get_verify_data($id);
        $receiver_id  = json_decode($data['v']->data);
        $data['user'] = $this->db->select('*')->from('dbt_user')->where('user_id', $receiver_id->receiver_user_id)->get()->row();

        if($data['v']!=NULL){
            $data['title']   = $this->uri->segment(1);

        } else {
            redirect('transfer');

        }

        $this->load->view('website/header', $data);     
        $this->load->view('website/confirm_transfer', $data);
        $this->load->view('website/footer', $data);

    }

    public function transfer_verify()
    {


        $code = $this->input->post('code', TRUE);
        $id   = $this->input->post('id', TRUE);

        $data = $this->db->select('*')
            ->from('dbt_verify')
            ->where('verify_code', $code)
            ->where('id', $id)
            ->where('session_id', $this->session->userdata('isLogIn'))
            ->where('status', 1)
            ->get()
            ->row();

        $userinfo = $this->web_model->retriveUserInfo();

        if($data != NULL) {

            $t_data = ((array) json_decode($data->data));


            //Sender Balance Update
            $check_user_balance = $this->db->select('*')->from('dbt_balance')->where('user_id', $this->session->userdata('user_id'))->where('currency_symbol', $t_data['currency_symbol'])->get()->row();
            if(!empty($t_data['fees'])){

                $trfees = $t_data['fees'];
            } else {
                $trfees = 0;
            }

            $new_balance        = $check_user_balance->balance-($t_data['amount'] + $trfees);
            $this->db->set('balance', $new_balance)->where('user_id', $this->session->userdata('user_id'))->where('currency_symbol', $t_data['currency_symbol'])->update("dbt_balance");


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

            $this->payment_model->balancelog($transfertdata);

            //Recever Balance Update
            $check_recever_balance = $this->db->select('*')->from('dbt_balance')->where('user_id', $t_data['receiver_user_id'])->where('currency_symbol', $t_data['currency_symbol'])->get()->row();
            if ($check_recever_balance) {
                $new_balance_recever = @$check_recever_balance->balance+$t_data['amount'];
                $this->db->set('balance', $new_balance_recever)->where('user_id', $t_data['receiver_user_id'])->where('currency_symbol', $t_data['currency_symbol'])->update("dbt_balance");


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

                $this->payment_model->balancelog($receiveddata);


            }else{

                 $transfar_recever = array(
                            'user_id' => $t_data['receiver_user_id'],
                            'currency_symbol' => $t_data['currency_symbol'],
                            'balance' => $t_data['amount'],
                            'last_update' => date('Y-m-d H:i:s'),

                        );

                $recever_balance_id = $this->web_model->balanceAdd($transfar_recever);

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

                $this->payment_model->balancelog($receiveddata);

            }

            $result = $this->web_model->transfer($t_data);




            $appSetting = $this->common_model->get_setting();
            $set = $this->common_model->email_sms('email');

            $transections_data = array(
                'user_id'                   => $this->session->userdata('user_id'),
                'transection_category'      => 'TRANSFER',
                'releted_id'                => $result['id'],
                'amount'                    => $t_data['amount'],
                'comments'                  => $t_data['comments'],
                'transection_date_timestamp'=> date('Y-m-d H:i:s')
            );

            $transections_reciver_data = array(
                'user_id'                   => $t_data['receiver_user_id'],
                'transection_category'      => 'RECEIVED',
                'releted_id'                => $result['id'],
                'amount'                    => $t_data['amount'],
                'comments'                  => $t_data['comments'],
                'transection_date_timestamp'=> date('Y-m-d H:i:s')
            );

            $this->db->set('status',0)
                ->where('id', $id)
                ->where('session_id',$this->session->userdata('isLogIn'))
                ->update('dbt_verify');
           
            if($set->transfer != NULL){

                /***************************
                *   Email Verify SMTP
                ***************************/
                $post = array(
                    'title'           => $appSetting->title,
                    'subject'           => display('transfer'),
                    'to'                => $this->session->userdata('email'),
                    'message'           => 'You successfully transfer The amount '.@$t_data['currency_symbol'].' '.$t_data['amount'].' to the account '.$t_data['receiver_user_id'].'. Your new balance is '.$t_data['currency_symbol'].' '.$new_balance
                   
                );
                $send_email = $this->common_model->send_email($post);

                if($send_email){

                    $n = array(
                        'user_id'                => $this->session->userdata('user_id'),
                        'subject'                => display('transfer'),
                        'notification_type'      => 'TRANSFER',
                        'details'                => 'You successfully transfer The amount '.$t_data['currency_symbol'].' '.$t_data['amount'].' to the account '.$t_data['receiver_user_id'].'. Your new balance is '.$t_data['currency_symbol'].' '.$new_balance,
                        'date'                   => date('Y-m-d H:i:s'),
                        'status'                 => '0'
                    );
                    $this->db->insert('notifications',$n);    
                }

                /***************************
                *   SMS Verify
                ***************************/
                $template = array( 
                    'name'      => $this->session->userdata('fullname'),
                    'amount'    =>$t_data['amount'],
                    'new_balance'=>$new_balance,
                    'currency_symbol'=>$t_data['currency_symbol'],
                    'receiver_id'=>$t_data['receiver_user_id'],
                    'date'      => date('d F Y')
                );

                if (@$userinfo->phone) {
                    $send_sms = $this->sms_lib->send(array(
                        'to'              => $userinfo->phone, 
                        'subject'         => 'Transfer', 
                        'template'        => 'You successfully transfer the amount %currency_symbol% %amount% to the account %receiver_id%. Your balence is %currency_symbol% %new_balance%.', 
                        'template_config' => $template, 
                    ));

                }else{

                    $this->session->set_flashdata('exception', display('there_is_no_phone_number'));

                }

                if(@$send_sms){

                    $message_data = array(
                        'sender_id' =>1,
                        'receiver_id' => $this->session->userdata('user_id'),
                        'subject' => 'Transfer',
                        'message' => 'You successfully transfer the amount '.$t_data['currency_symbol'].' '.$t_data['amount'].' to the account '.$t_data['receiver_user_id'].'. Your new balance is '.$t_data['currency_symbol'].' '.$new_balance,
                        'datetime' => date('Y-m-d H:i:s'),
                    );

                    $this->db->insert('message',$message_data);    

                }
                

            }
            echo $id;

        } else {

            echo '';

        }
        
    }

    public function transfer_details($id=NULL)
    {

        $data['my_info']    = $this->web_model->retriveUserInfo();
        $data['v']          = $this->db->select('*')->from('dbt_verify')->where('id',$id)->where('session_id', $this->session->userdata('isLogIn'))->where('status', 0)->get()->row();

        if($data['v']!=NULL){
            $datas          = (json_decode($data['v']->data)); 
            $data['u']      = $this->db->select('user_id,first_name,last_name,email,phone')->from('dbt_user')->where('user_id',@$datas->receiver_user_id)->get()->row();

        }
        
        $this->load->view('website/header', $data);     
        $this->load->view('website/transfer_details', $data);
        $this->load->view('website/footer', $data); 
    }


    public function transactions()
    {
        if (!$this->session->userdata('isLogIn'))
            redirect('login');

        $data['title']           = $this->uri->segment(1);
        $data['balance_log']     = $this->web_model->balanceLog();


        $this->load->view('website/header', $data);     
        $this->load->view('website/transactions', $data);
        $this->load->view('website/footer', $data);

    }


    public function news()
    {

        $slug1 = $this->uri->segment(1);
        $slug2 = $this->uri->segment(2);
        $slug3 = $this->uri->segment(3);


        $data['title']              = $this->uri->segment(1);
        //For Coin Tricker
        $data['recentnews']         = $this->db->select("*")->from('web_news')->order_by('article_id', 'desc')->limit(3)->get()->result();

        if ($slug2=="" || $slug2==NULL || is_numeric($slug2)) {

            //All Category News with Pagination
            $cat_id     = $this->web_model->catidBySlug($slug1)->cat_id;
            if (!$cat_id) {
                redirect(base_url('news'));
            }
            $where_add  = $this->web_model->catidBySlug('news')->cat_id;

            /******************************
            * Pagination Start
            ******************************/
            $config["base_url"]         = base_url('news');
            $config["total_rows"]       = $this->db->count_all('web_news');
            $config["per_page"]         = 6;
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
            $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
            $data['news']           = $this->db->select("*")
                                        ->from('web_news')
                                        ->order_by('article_id', 'desc')
                                        ->limit($config["per_page"], $page)
                                        ->get()
                                        ->result();
            $data["links"]          = $this->pagination->create_links();
            /******************************
            * Pagination ends
            ******************************/

            $data['advertisement']  = $this->web_model->advertisement($where_add);
            $data['newscat']        = $this->web_model->newsCatListBySlug('news');
            $data['cat_info']       = $this->web_model->cat_info($slug1);
            $data['content']        = $this->load->view("website/sidebar", $data, true);


            $this->load->view('website/header', $data);     
            $this->load->view('website/news', $data);
            $this->load->view('website/footer', $data); 

        }
        elseif (($slug2!="" || !is_numeric($slug2)) && ($slug3=="" || $slug3==NULL)) {

            @$where_add  = $this->web_model->catidBySlug('news')->cat_id;

            //Slug Category News
            $cat_id     = $this->web_model->catidBySlug($slug2)->cat_id;
            if (!$cat_id) {
                redirect(base_url('news'));
            }
            /******************************
            * Pagination Start
            ******************************/
            $config["base_url"]         = base_url('news/'.$slug2);
            $config["total_rows"]       = $this->db->get_where('web_news', array('cat_id'=>$cat_id))->num_rows();
            $config["per_page"]         = 6;
            $config["uri_segment"]      = 3;
            $config["last_link"]        = "Last"; 
            $config["first_link"]       = "First"; 
            $config['next_link']        = '&#8702;';
            $config['prev_link']        = '&#8701;';  
            $config['full_tag_open']    = "<ul class='pagination'>";
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
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data['news']               = $this->db->select("*")
                                            ->from('web_news')
                                            ->where('cat_id', $cat_id)
                                            ->order_by('article_id', 'desc')
                                            ->limit($config["per_page"], $page)
                                            ->get()
                                            ->result();
            $data["links"]              = $this->pagination->create_links();
            /******************************
            * Pagination ends
            ******************************/

            $data['advertisement']      = $this->web_model->advertisement($where_add);
            @$data['newscat']           = $this->web_model->newsCatListBySlug('news');
            $data['cat_info']           = $this->web_model->cat_info($slug1);
            $data['content']            = $this->load->view("website/sidebar", $data, true);


            $this->load->view('website/header', $data);     
            $this->load->view('website/news', $data);
            $this->load->view('website/footer', $data);

        }
        elseif ($slug3=="" || $slug3==NULL || is_numeric($slug3)) {

            @$where_add  = $this->web_model->catidBySlug('news')->cat_id;

            //Slug Category News with Pagination
            $cat_id     = $this->web_model->catidBySlug($slug2)->cat_id;
            if (!$cat_id) {
                redirect(base_url('news'));
            }
            /******************************
            * Pagination Start
            ******************************/
            $config["base_url"]         = base_url('news');
            $config["total_rows"]       = $this->db->get_where('web_news', array('cat_id'=>$cat_id))->num_rows();
            $config["per_page"]         = 6;
            $config["uri_segment"]      = 2;
            $config["last_link"]        = "Last"; 
            $config["first_link"]       = "First"; 
            $config['next_link']        = '&#8702;';
            $config['prev_link']        = '&#8701;';  
            $config['full_tag_open']    = "<ul class='pagination'>";
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
            $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
            $data['news']           = $this->db->select("*")
                                        ->from('web_news')
                                        ->where('cat_id', $cat_id)
                                        ->order_by('article_id', 'desc')
                                        ->limit($config["per_page"], $page)
                                        ->get()
                                        ->result();
            $data["links"]          = $this->pagination->create_links();
            /******************************
            * Pagination ends
            ******************************/
            
            $data['advertisement']  = $this->web_model->advertisement($where_add);
            @$data['newscat']       = $this->web_model->newsCatListBySlug('news');
            $data['cat_info']       = $this->web_model->cat_info($slug1);
            $data['content']        = $this->load->view("website/sidebar", $data, true);


            $this->load->view('website/header', $data);     
            $this->load->view('website/news', $data);
            $this->load->view('website/footer', $data);

        }
        elseif ($slug3!="" || !is_numeric($slug3)) {
            //Slug Category News detail

            $where_add = $this->web_model->catidBySlug('news-details')->cat_id;
            $data['advertisement']  = $this->web_model->advertisement($where_add);

            @$data['newscat']       = $this->web_model->newsCatListBySlug('news');
            $data['article']        = $this->web_model->article($slug1);
            $data['cat_info']       = $this->web_model->cat_info($slug1);
            $data['news']           = $this->web_model->newsDetails($slug3);
            $data['content']        = $this->load->view("website/sidebar", $data, true);


            $this->load->view('website/header', $data);     
            $this->load->view('website/newsdetails', $data);
            $this->load->view('website/footer', $data);
            
        }
        
    }

    
    public function buy()
    {
        
        if ($this->session->userdata('isLogIn') && $this->session->userdata('user_id')){

            $coin_symbol        = explode('_', $this->input->post('market', TRUE));
            $market_symbol      = $this->input->post('market', TRUE);
            $rate               = $this->input->post('buypricing', TRUE);
            $qty                = $this->input->post('buyamount', TRUE);
            $user_id            = $this->session->userdata('user_id');

            //Check BUY fees
            $fees = $this->web_model->checkFees('BUY', $coin_symbol[1]);
            if ($fees) {
                $fees_amount = ($rate*$qty*$fees->fees)/100;
                $buyfees     = $fees->fees;

            } else {
                $fees_amount = 0;
                $buyfees     = 0;
            }

            //SELL fees
            $sellerfees = $this->web_model->checkFees('SELL', $coin_symbol[0]);
            if ($sellerfees) {
                $sellfees = $sellerfees->fees;

            } else {
                $sellfees = 0;
            }

            $amount_withoutfees = $rate * $qty;
            $amount_withfees    = $amount_withoutfees + $fees_amount;

            //Buy(BTC_USD) = C0_C1, BUY C0 vai C1
            $balance_c0         = $this->web_model->checkBalance($coin_symbol[0]);
            $balance_c1         = $this->web_model->checkBalance($coin_symbol[1]);


            //Pending Withdraw amoun sum
            $pending_withdraw = $this->db->select('SUM(amount)+SUM(fees_amount) as amount',FALSE)->from('dbt_withdraw')->where('currency_symbol', $coin_symbol[1])->where('status', 2)->where('user_id', $user_id)->get()->row();

            //Discut user withdraw pending balance
            $real_balance = (float)@$balance_c1->balance-(float)@$pending_withdraw->amount;


            if ($real_balance >= $amount_withfees && @$balance_c1->balance>0 && $amount_withfees>0) {

                $date       = new DateTime();
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
                if ($exchange_id = $this->web_model->tradeCreate($exchangedata)) {

                    $last_exchange = $this->web_model->single($exchange_id);

                    //User Balance Debit(-) C1
                    $this->web_model->balanceCredit($last_exchange, $coin_symbol[1]);

                    //After balance discut(-)
                    $balance = $this->web_model->checkBalance($coin_symbol[1]);

                    
                    //Search all SELL data
                    $where = "(bid_price <= '".$rate."' AND status = 2 AND bid_type = 'SELL' AND market_symbol = '".$market_symbol."')";                   
                    $sell_exchange_query = $this->db->select('*')->from('dbt_biding')->where($where)->order_by('open_order', 'asc')->get()->result();

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

                            $last_exchange   = $this->web_model->single($exchange_id);
                            if ($last_exchange->status==2) {

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
                                if($sellexchange->bid_qty_available-$last_exchange->bid_qty_available==0){
                                    $buyer_complete_qty_log = $last_exchange->bid_qty_available;
                                } else if($sellexchange->bid_qty_available-$last_exchange->bid_qty_available<=0){
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
                                $this->db->where('id', $exchange_id)->update("dbt_biding", $exchangebuydata);
                                $this->db->where('id', $sellexchange->id)->update("dbt_biding", $exchangeselldata);

                                //Adjustment Amount+Fees
                                if($last_exchange->bid_price>$sellexchange->bid_price){

                                    $totalexchanceqty = $buyer_complete_qty_log;

                                    $buyremeaningrate = $last_exchange->bid_price-$sellexchange->bid_price;
                                    $buyerbalence     = $buyremeaningrate*$totalexchanceqty;

                                    //Fees when Adjustment
                                    $returnfees     = 0;
                                    $byerfees       = ($totalexchanceqty*$last_exchange->bid_price*$buyfees)/100;
                                    $sellerrfees    = ($totalexchanceqty*$sellexchange->bid_price*$sellfees)/100;
                                    $buyerreturnfees= $byerfees-$sellerrfees;

                                    if($buyerreturnfees>0){
                                        $returnfees = $buyerreturnfees;

                                    }
                                    
                                    $buyeruserid      = $last_exchange->user_id;

                                    $balance_data = array(
                                        'user_id'    => $buyeruserid,
                                        'amount'     => $buyerbalence,
                                        'return_fees'=> $returnfees,
                                        'currency_symbol'=>$coin_symbol[1],
                                        'ip'         => $this->input->ip_address()
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
                                    'bid_id'          => $sellexchange->id,
                                    'bid_type'        => $sellexchange->bid_type,
                                    'complete_qty'    => $seller_complete_qty_log,
                                    'bid_price'       => $sellexchange->bid_price,
                                    'complete_amount' => $seller_complete_qty_log*$sellexchange->bid_price,
                                    'user_id'         => $sellexchange->user_id,
                                    'currency_symbol' => $sellexchange->currency_symbol,
                                    'market_symbol'   => $sellexchange->market_symbol,
                                    'success_time'    => $open_date,
                                    'fees_amount'     => $sellexchange->fees_amount,
                                    'available_amount'=> $sellexchange->bid_qty_available*$sellexchange->bid_price,
                                    'status'          => ($sellexchange->amount_available-($sellexchange->bid_qty_available*$sellexchange->bid_price)<=0)?1:2,
                                );

                                //Exchange Sell+Buy Log data
                                $this->db->insert('dbt_biding_log',$selltraderlog);
                                $this->db->insert('dbt_biding_log',$buytraderlog);


                                //Buy balance update
                                $buyer_balance = $this->db->select('*')->from('dbt_balance')->where('user_id', $last_exchange->user_id)->where('currency_symbol', $coin_symbol[0])->get()->row();

                                if (!$buyer_balance) {
                                    $user_balance = array(
                                        'user_id'           => $last_exchange->user_id, 
                                        'currency_symbol'   => $coin_symbol[0], 
                                        'balance'           => $buyer_complete_qty_log, 
                                        'last_update'       => $open_date, 
                                        );
                                    $this->db->insert('dbt_balance', $user_balance);

                                }else{
                                    $this->db->set('balance', $buyer_balance->balance+$buyer_complete_qty_log)->where('user_id', $last_exchange->user_id)->where('currency_symbol', $coin_symbol[0])->update("dbt_balance");
                                }


                                //Seller balance update
                                $check_seller_balance = $this->db->select('*')->from('dbt_balance')->where('user_id', $sellexchange->user_id)->where('currency_symbol', $coin_symbol[1])->get()->row();

                                if (!$check_seller_balance) {
                                    $user_balance = array(
                                        'user_id'           => $sellexchange->user_id, 
                                        'currency_symbol'   => $coin_symbol[1], 
                                        'balance'           => $buyer_complete_qty_log*$sellexchange->bid_price, 
                                        'last_update'       => $open_date, 
                                        );
                                    $this->db->insert('dbt_balance', $user_balance);

                                }else{

                                    $this->db->set('balance', $check_seller_balance->balance+($buyer_complete_qty_log*$sellexchange->bid_price))->where('user_id', $sellexchange->user_id)->where('currency_symbol', $coin_symbol[1])->update("dbt_balance");
                                }



                                //One Hour data
                                $where      = "(success_time >= DATE_SUB(NOW(), INTERVAL 1 hour) AND market_symbol = '".$last_exchange->market_symbol."')"; 
                                $where01    = "(bid_type='BUY' AND market_symbol = '".$last_exchange->market_symbol."')";
                                $where1     = "market_symbol = '".$last_exchange->market_symbol."'"; 
                                $where11    = "success_time >= DATE_SUB(NOW(), INTERVAL 1 hour) AND bid_type='BUY' AND market_symbol = '".$last_exchange->market_symbol."'"; 
                                $where2     = "(success_time >= DATE_SUB(DATE_SUB(NOW(), INTERVAL 1 hour), INTERVAL 1 hour)) AND (success_time <= DATE_SUB(NOW(), INTERVAL 1 hour) AND market_symbol = '".$last_exchange->market_symbol."')";

                                $h1_last_price_avg      = $this->db->select_avg('bid_price')->from('dbt_biding_log')->where($where11)->order_by('success_time', 'desc')->get()->row();
                                $pre1h_last_price       = $this->db->select('bid_price')->from('dbt_biding_log')->where($where2)->order_by('success_time', 'desc')->get()->row();
                                $pre1h_last_price_avg   = $this->db->select_avg('bid_price')->from('dbt_biding_log')->where($where2)->order_by('success_time', 'desc')->get()->row();
                                $total_coin_supply      = $this->db->select_sum('complete_qty')->from('dbt_biding_log')->where($where01)->order_by('success_time', 'desc')->get()->row();
                                $h1_coin_supply         = $this->db->select_sum('complete_qty')->from('dbt_biding_log')->where($where01)->order_by('success_time', 'desc')->get()->row();
                                $h1_bid_high_price      = $this->db->select_max('bid_price')->from('dbt_biding_log')->where($where)->order_by('success_time', 'desc')->get()->row();
                                $h1_bid_low_price       = $this->db->select_min('bid_price')->from('dbt_biding_log')->where($where)->order_by('success_time', 'desc')->get()->row();



                                //24 hours data
                                $where      = "(success_time >= DATE_SUB(NOW(), INTERVAL 24 hour) AND market_symbol = '".$last_exchange->market_symbol."')"; 
                                $where01    = "(bid_type='BUY' AND market_symbol = '".$last_exchange->market_symbol."')";
                                $where1     = "market_symbol = '".$last_exchange->market_symbol."'"; 
                                $where11    = "success_time >= DATE_SUB(NOW(), INTERVAL 24 hour) AND bid_type='BUY' AND market_symbol = '".$last_exchange->market_symbol."'"; 
                                $where2     = "(success_time >= DATE_SUB(DATE_SUB(NOW(), INTERVAL 24 hour), INTERVAL 24 hour)) AND (success_time <= DATE_SUB(NOW(), INTERVAL 24 hour) AND market_symbol = '".$last_exchange->market_symbol."')";

                                $h24_last_price_avg     = $this->db->select_avg('bid_price')->from('dbt_biding_log')->where($where11)->order_by('success_time', 'desc')->get()->row();
                                $pre24h_last_price      = $this->db->select('bid_price')->from('dbt_biding_log')->where($where2)->order_by('success_time', 'desc')->get()->row();
                                $pre24h_last_price_avg  = $this->db->select_avg('bid_price')->from('dbt_biding_log')->where($where2)->order_by('success_time', 'desc')->get()->row();
                                $total_coin_supply      = $this->db->select_sum('complete_qty')->from('dbt_biding_log')->where($where01)->order_by('success_time', 'desc')->get()->row();
                                $h24_coin_supply        = $this->db->select_sum('complete_qty')->from('dbt_biding_log')->where($where01)->order_by('success_time', 'desc')->get()->row();
                                $h24_bid_high_price     = $this->db->select_max('bid_price')->from('dbt_biding_log')->where($where)->order_by('success_time', 'desc')->get()->row();
                                $h24_bid_low_price      = $this->db->select_min('bid_price')->from('dbt_biding_log')->where($where)->order_by('success_time', 'desc')->get()->row();


                                if($h1_bid_high_price->bid_price==''){
                                    $high1 = $sellexchange->bid_price;

                                }else{

                                    if ($h1_bid_high_price->bid_price<$sellexchange->bid_price) {
                                        $high1 = $sellexchange->bid_price;

                                    }else{
                                        $high1 = $h1_bid_high_price->bid_price;

                                    }
                                }

                                if($h1_bid_low_price->bid_price==''){
                                    $low1 = $sellexchange->bid_price;

                                }else{

                                    if ($h1_bid_low_price->bid_price>$sellexchange->bid_price) {
                                        $low1 = $sellexchange->bid_price;

                                    }else{
                                        $low1 = $h1_bid_low_price->bid_price;

                                    }
                                }

                                //Price change value in up/down
                                $last_price_query = $this->db->select('*')->from('dbt_coinhistory')->where('market_symbol', $market_symbol)->order_by('date', 'desc')->get()->row();

                                if ($sellexchange->bid_price<@$last_price_query->last_price) {
                                    $price_change_1h = -($high1 - $low1);

                                }else{
                                    $price_change_1h = $high1 - $low1;

                                }


                                if($h24_bid_high_price->bid_price==''){
                                    $high24 = $sellexchange->bid_price;

                                }else{

                                    if ($h24_bid_high_price->bid_price<$sellexchange->bid_price) {
                                        $high24 = $sellexchange->bid_price;

                                    }else{
                                        $high24 = $h24_bid_high_price->bid_price;

                                    }
                                }

                                if($h24_bid_low_price->bid_price==''){
                                     $low24 = $sellexchange->bid_price;

                                }else{

                                    if ($h24_bid_low_price->bid_price>$sellexchange->bid_price) {
                                        $low24 = $sellexchange->bid_price;

                                    }else{
                                        $low24 = $h24_bid_low_price->bid_price;

                                    }
                                }

                                if ($sellexchange->bid_price<@$last_price_query->last_price) {
                                    $price_change_24h = -($high24 - $low24);

                                }else{
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

                                $this->db->insert('dbt_coinhistory', $coinhistory);

                            }
                            //Order running

                        }
                        //Order list in loop

                    }
                    //Check if any order availabe

                    $balance_update_c0 = $this->web_model->checkBalance($coin_symbol[0]);

                    echo json_encode(array('trades' => $last_exchange, 'balance' => @$balance->balance, 'balance_up_to' => @$balance_update_c0->balance));

                    
                }else{
                    echo 0;
                    //trade not submited

                }

            }else{
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

        if ($this->session->userdata('isLogIn') && $this->session->userdata('user_id')){

            $coin_symbol         = explode('_', $this->input->post('market', TRUE));
            $market_symbol       = $this->input->post('market', TRUE);
            $rate                = $this->input->post('sellpricing', TRUE);
            $qty                 = $this->input->post('sellamount', TRUE);
            $user_id             = $this->session->userdata('user_id');

            //Check SELL fees
            $fees = $this->web_model->checkFees('SELL', $coin_symbol[0]);
            if ($fees) {                
                $fees_amount = ($qty*$fees->fees)/100;
                $sellfees    = $fees->fees;

            } else {
                $fees_amount = 0;
                $sellfees    = 0;

            }


            //BUY fees
            $buyerfees = $this->web_model->checkFees('BUY', $coin_symbol[1]);
            if ($buyerfees) {
                $buyfees     = $buyerfees->fees;

            }else{
                $buyfees     = 0;

            }

            $amount_withoutfees = $qty;
            $amount_withfees    = $amount_withoutfees + $fees_amount;

            $balance_c0         = $this->web_model->checkBalance($coin_symbol[0]);
            $balance_c1         = $this->web_model->checkBalance($coin_symbol[1]);

            //Pending Withdraw amoun sum
            $pending_withdraw = $this->db->select('SUM(amount)+SUM(fees_amount) as amount',FALSE)->from('dbt_withdraw')->where('currency_symbol', $coin_symbol[0])->where('status', 2)->where('user_id', $user_id)->get()->row();

            //Discut user withdraw pending balance
            $real_balance = (float)@$balance_c0->balance-(float)@$pending_withdraw->amount;

            if (@$real_balance >= $amount_withfees && @$balance_c0->balance>0 && $amount_withfees>0) {

                $date       = new DateTime();
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
                if ($exchange_id = $this->web_model->tradeCreate($exchangedata)) {                   

                    $last_exchange   = $this->web_model->single($exchange_id);
                    //User Balance Debit(-) C0
                    $this->web_model->balanceDebit($last_exchange);
                    //After balance discut(-)
                    $balance = $this->web_model->checkBalance($coin_symbol[0]);


                    //Search all BUY data
                    $where              = "(bid_price >= '".$rate."' AND status = 2 AND bid_type = 'BUY' AND market_symbol = '".$market_symbol."')";                   
                    $buy_exchange_query = $this->db->select('*')->from('dbt_biding')->where($where)->order_by('open_order', 'asc')->get()->result();

                    if ($buy_exchange_query) {
                        foreach ($buy_exchange_query as $key => $buyexchange) {

                            $seller_available_qty        = 0;
                            $buyer_available_qty         = 0;
                            $buyer_amount_available      = 0;
                            $seller_amount_available     = 0;
                            $seller_amount_available_log = 0;
                            $seller_complete_qty_log     = 0;
                            $buyer_complete_qty_log      = 0;

                            $last_exchange   = $this->web_model->single($exchange_id);

                            if ($last_exchange->status == 2) {

                                //Seller+Buyer Quantity/Amount Complete/Available Master table
                                $seller_available_qty       = (($last_exchange->bid_qty_available-$buyexchange->bid_qty_available)<=0)?0:($last_exchange->bid_qty_available-$buyexchange->bid_qty_available);
                                $buyer_available_qty        = (($buyexchange->bid_qty_available-$last_exchange->bid_qty_available)<0)?0:$buyexchange->bid_qty_available-$last_exchange->bid_qty_available;
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
                                $this->db->where('id', $exchange_id)->update("dbt_biding", $exchangeselldata);
                                $this->db->where('id', $buyexchange->id)->update("dbt_biding", $exchangebuydata);


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
                                        'ip'             => $this->input->ip_address()
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
                                $this->db->insert('dbt_biding_log',$buytraderlog);
                                $this->db->insert('dbt_biding_log',$selltraderlog);


                                //Buy balance update
                                $check_user_balance = $this->db->select('*')->from('dbt_balance')->where('user_id', $buyexchange->user_id)->where('currency_symbol', $coin_symbol[0])->get()->row();

                                if (!$check_user_balance) {
                                    $user_balance = array(
                                        'user_id'           => $buyexchange->user_id, 
                                        'currency_symbol'   => $coin_symbol[0], 
                                        'balance'           => $seller_complete_qty_log, 
                                        'last_update'       => $open_date, 
                                        );
                                    $this->db->insert('dbt_balance', $user_balance);

                                } else {
                                    $this->db->set('balance', $check_user_balance->balance+$seller_complete_qty_log)->where('user_id', $buyexchange->user_id)->where('currency_symbol', $coin_symbol[0])->update("dbt_balance");
                                }

                                //Seller balance update
                                $check_seller_balance = $this->db->select('*')->from('dbt_balance')->where('user_id', $last_exchange->user_id)->where('currency_symbol', $coin_symbol[1])->get()->row();

                                if (!$check_seller_balance) {
                                    $user_balance = array(
                                        'user_id'           => $last_exchange->user_id, 
                                        'currency_symbol'   => $coin_symbol[1], 
                                        'balance'           => $seller_complete_qty_log*$last_exchange->bid_price, 
                                        'last_update'       => $open_date, 
                                    );
                                    $this->db->insert('dbt_balance', $user_balance);

                                } else {
                                    $this->db->set('balance', $check_seller_balance->balance+($seller_complete_qty_log*$last_exchange->bid_price))->where('user_id', $last_exchange->user_id)->where('currency_symbol', $coin_symbol[1])->update("dbt_balance");
                                }

                                $where      = "(success_time >= DATE_SUB(NOW(), INTERVAL 1 hour) AND market_symbol = '".$last_exchange->market_symbol."')"; 
                                $where01    = "(bid_type='BUY' AND market_symbol = '".$last_exchange->market_symbol."')"; 
                                $where1     = "market_symbol = '".$last_exchange->market_symbol."'"; 
                                $where11    = "success_time >= DATE_SUB(NOW(), INTERVAL 1 hour) AND bid_type='BUY' AND market_symbol = '".$last_exchange->market_symbol."'"; 
                                $where2     = "(success_time >= DATE_SUB(DATE_SUB(NOW(), INTERVAL 1 hour), INTERVAL 1 hour)) AND (success_time <= DATE_SUB(NOW(), INTERVAL 1 hour) AND market_symbol = '".$last_exchange->market_symbol."')";

                                $h1_last_price_avg      = $this->db->select_avg('bid_price')->from('dbt_biding_log')->where($where11)->order_by('success_time', 'desc')->get()->row();
                                $pre1h_last_price       = $this->db->select('bid_price')->from('dbt_biding_log')->where($where2)->order_by('success_time', 'desc')->get()->row();
                                $pre1h_last_price_avg   = $this->db->select_avg('bid_price')->from('dbt_biding_log')->where($where2)->order_by('success_time', 'desc')->get()->row();
                                $total_coin_supply      = $this->db->select_sum('complete_qty')->from('dbt_biding_log')->where($where01)->order_by('success_time', 'desc')->get()->row();
                                $h1_coin_supply         = $this->db->select_sum('complete_qty')->from('dbt_biding_log')->where($where01)->order_by('success_time', 'desc')->get()->row();
                                $h1_bid_high_price      = $this->db->select_max('bid_price')->from('dbt_biding_log')->where($where)->order_by('success_time', 'desc')->get()->row();
                                $h1_bid_low_price       = $this->db->select_min('bid_price')->from('dbt_biding_log')->where($where)->order_by('success_time', 'desc')->get()->row();




                                $where      = "(success_time >= DATE_SUB(NOW(), INTERVAL 24 hour) AND market_symbol = '".$last_exchange->market_symbol."')"; 
                                $where01    = "(bid_type='BUY' AND market_symbol = '".$last_exchange->market_symbol."')"; 
                                $where1     = "market_symbol = '".$last_exchange->market_symbol."'"; 
                                $where11    = "success_time >= DATE_SUB(NOW(), INTERVAL 24 hour) AND bid_type='BUY' AND market_symbol = '".$last_exchange->market_symbol."'"; 
                                $where2     = "(success_time >= DATE_SUB(DATE_SUB(NOW(), INTERVAL 24 hour), INTERVAL 24 hour)) AND (success_time <= DATE_SUB(NOW(), INTERVAL 24 hour) AND market_symbol = '".$last_exchange->market_symbol."')";


                                $h24_last_price_avg     = $this->db->select_avg('bid_price')->from('dbt_biding_log')->where($where11)->order_by('success_time', 'desc')->get()->row();
                                $pre24h_last_price      = $this->db->select('bid_price')->from('dbt_biding_log')->where($where2)->order_by('success_time', 'desc')->get()->row();
                                $pre24h_last_price_avg  = $this->db->select_avg('bid_price')->from('dbt_biding_log')->where($where2)->order_by('success_time', 'desc')->get()->row();
                                $h24_coin_supply        = $this->db->select_sum('complete_qty')->from('dbt_biding_log')->where($where01)->order_by('success_time', 'desc')->get()->row();
                                $h24_bid_high_price     = $this->db->select_max('bid_price')->from('dbt_biding_log')->where($where)->order_by('success_time', 'desc')->get()->row();
                                $h24_bid_low_price      = $this->db->select_min('bid_price')->from('dbt_biding_log')->where($where)->order_by('success_time', 'desc')->get()->row();

                                
                                if($h1_bid_high_price->bid_price==''){
                                    $high1 = $last_exchange->bid_price;

                                }else{

                                    if ($h1_bid_high_price->bid_price<$last_exchange->bid_price) {
                                        $high1 = $last_exchange->bid_price;

                                    }else{
                                        $high1 = $h1_bid_high_price->bid_price;

                                    }
                                }

                                if($h1_bid_low_price->bid_price==''){
                                    $low1 = $last_exchange->bid_price;

                                }else{

                                    if ($h1_bid_low_price->bid_price<$last_exchange->bid_price) {
                                        $low1 = $last_exchange->bid_price;

                                    }else{
                                        $low1 = $h1_bid_low_price->bid_price;

                                    }
                                }

                                //Price change value in up/down
                                $last_price_query = $this->db->select('*')->from('dbt_coinhistory')->where('market_symbol', $market_symbol)->order_by('date', 'desc')->get()->row();

                                if ($last_exchange->bid_price<@$last_price_query->last_price) {
                                    $price_change_1h = -($high1 - $low1);

                                }else{
                                     $price_change_1h = $high1 - $low1;

                                }
                                

                                if($h24_bid_high_price->bid_price==''){
                                    $high24 = $last_exchange->bid_price;

                                }else{

                                    if ($h24_bid_high_price->bid_price<$last_exchange->bid_price) {
                                        $high24 = $last_exchange->bid_price;

                                    }else{
                                        $high24 = $h24_bid_high_price->bid_price;

                                    }

                                }

                                if($h24_bid_low_price->bid_price==''){
                                    $low24 = $last_exchange->bid_price;

                                }else{

                                    if ($h24_bid_low_price->bid_price<$last_exchange->bid_price) {
                                        $low24 = $last_exchange->bid_price;

                                    }else{
                                        $low24 = $h24_bid_low_price->bid_price;

                                    }

                                }

                                if ($last_exchange->bid_price<@$last_price_query->last_price) {
                                    $price_change_24h = -($high24 - $low24);

                                }else{
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


                                $this->db->insert('dbt_coinhistory', $coinhistory);                                

                            }
                            //Order running

                        }
                        //Order list in loop

                    }
                    //Check if any order availabe

                    $balance_update_c1 = $this->web_model->checkBalance($coin_symbol[1]);


                    echo json_encode(array('trades' => $last_exchange, 'balance' => @$balance->balance, 'balance_up_to' => @$balance_update_c1->balance));

                    
                }else{
                    echo 0;
                    //trade not submited

                }

            }else{
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
        $orderdata = $this->web_model->single($id);

        if (@$this->session->userdata('user_id') != $orderdata->user_id){
            $this->session->set_flashdata('exception', display('there_is_no_order_for_cancel'));
            redirect("open-order");

        }else{

            $canceltrade = array(
                'status' => 0
            );

            $this->db->where('id', $id)->update("dbt_biding", $canceltrade);

            $currency_symbol = '';
            $refund_amount = '';
            if ($orderdata->bid_type == 'SELL') {
                $temp = explode("_", $orderdata->market_symbol);
                $currency_symbol = $temp[0];

                //With fees refund
                $percent = (($orderdata->bid_qty-$orderdata->bid_qty_available)*100)/$orderdata->bid_qty;
                $per_pending = 100 - $percent;
                $return_fees = ($per_pending*$orderdata->fees_amount)/100;
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


            $balance = $this->web_model->checkBalance($currency_symbol, $orderdata->user_id);

            //User Financial Log
            $tradecanceldata = array(
                'user_id'            => $orderdata->user_id,
                'balance_id'         => @$balance->id,
                'currency_symbol'    => $currency_symbol,
                'transaction_type'   => 'TRADE_CANCEL',
                'transaction_amount' => $refund_amount,
                'transaction_fees'   => 0,
                'ip'                 => $this->input->ip_address(),
                'date'               => date('Y-m-d H:i:s')
            );

            $this->payment_model->balancelog($tradecanceldata);

            $new_balance = @$balance->balance+($refund_amount);

            $this->db->set('balance', $new_balance)->where('user_id', $orderdata->user_id)->where('currency_symbol', $currency_symbol)->update("dbt_balance");

            $traderlog = array(
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

            $this->db->insert('dbt_biding_log', $traderlog);

            $this->session->set_flashdata('message', display('request_canceled'));
            redirect("open-order");
        }
    }

    public function coin_pairs()
    {
        $data = $this->web_model->coinPairs();
       echo json_encode(array('coin_pairs' => $data));

    }

    public function streamer()
    {
        $market_symbol = $this->input->get('market', TRUE);

        $trades = $this->db->query("SELECT *, SUM(`bid_qty_available`) as total_qty, SUM(`bid_qty_available`*`bid_price`) as total_price FROM dbt_biding WHERE `status`=2 AND `market_symbol`='".$market_symbol."' GROUP BY `id`, `market_symbol`, `bid_type`, `bid_price` ORDER BY `dbt_biding`.`bid_price` ASC")->result();

       echo json_encode(array('trades' => $trades));

    }


    public function streamer_buy()
    {
        $market_symbol = $this->input->get('market', TRUE);

        $trades = $this->db->query("SELECT *, SUM(`bid_qty_available`) as total_qty, SUM(`bid_qty_available`*`bid_price`) as total_price FROM dbt_biding WHERE `status`=2 AND `market_symbol`='".$market_symbol."'  AND `bid_type`='BUY' GROUP BY `id`,`market_symbol`, `bid_type`, `bid_price` ORDER BY `dbt_biding`.`bid_price` ASC")->result();

       echo json_encode(array('trades' => $trades));

    }

    public function streamer_sell()
    {
        $market_symbol = $this->input->get('market', TRUE);

        $trades = $this->db->query("SELECT *, SUM(`bid_qty_available`) as total_qty, SUM(`bid_qty_available`*`bid_price`) as total_price FROM dbt_biding WHERE `status`=2 AND `market_symbol`='".$market_symbol."' AND `bid_type`='SELL' GROUP BY `id`,`market_symbol`, `bid_type`, `bid_price` ORDER BY `dbt_biding`.`bid_price` DESC")->result();

       echo json_encode(array('trades' => $trades));
    }

    
    public function market_streamer()
    {
        $market_symbol = $this->input->get('market', TRUE);
        $coin_symbol = explode('_', $market_symbol);

        $tradesummery = $this->db->query("SELECT * FROM `dbt_coinhistory` INNER JOIN (SELECT `market_symbol`, MAX(`id`) AS maxid FROM `dbt_coinhistory` GROUP BY `id`,`market_symbol`) topid ON dbt_coinhistory.`market_symbol` = topid.`market_symbol` AND dbt_coinhistory.`id` = topid.`maxid`")->result();

        echo json_encode(array('marketstreamer' => $tradesummery));

    }
    public function tradehistory()
    {

        $market_symbol      = $this->input->get('market', TRUE);
        $tradehistory       = $this->web_model->tradeHistory($market_symbol);
        $coin_symbol        = explode('_', $market_symbol);
        $availablebuycoin   = $this->web_model->availableForBuy($market_symbol);
        $availablesellcoin  = $this->web_model->availableForSell($market_symbol);
        
        $coinhistory = $this->db->select('*')->from('dbt_coinhistory')->where('market_symbol', $market_symbol)->order_by('date', 'desc')->get()->row();

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

        $market_symbol = $this->input->get('market', TRUE);
        $coin_symbol   = explode('_', $market_symbol);
        
        $coinhistory   = $this->db->select('*')->from('dbt_coinhistory')->where('market_symbol', $market_symbol)->order_by('date', 'asc')->get()->result();

        echo json_encode($coinhistory);

    }

    public function market_depth()
    {

        $market_symbol = $this->input->get('market', TRUE);       

        $asks = array();
        $bids = array();

        $where       = "bid_type = 'SELL' AND market_symbol = '".$market_symbol."'"; 
        $coinhistory = $this->db->select('*')->from('dbt_biding_log')->where($where)->order_by('success_time', 'desc')->limit(100)->get()->result();
        $x = 0;
        $y = 0;
        foreach ($coinhistory as $key => $value) {
            array_push($asks, array($x,$y));
            $x = $value->bid_price;
            $y = $value->complete_qty;

        }

        $where = "bid_type = 'BUY' AND market_symbol = '".$market_symbol."'"; 
        $coinhistory = $this->db->select('*')->from('dbt_biding_log')->where($where)->order_by('success_time', 'desc')->limit(100)->get()->result();
        foreach ($coinhistory as $key => $value) {
            $x = $value->bid_price;
            $y = $value->complete_qty;
            array_push($bids, array($x,$y));

        }

        echo json_encode(
            array('asks' => $asks,
                  'bids'  => $bids,
            )
        );

    }

    //Ajax Sparkline Graph data JSON Formate
    public function coingraphdata($data1 = 0)
    {

        $cryptoconfig = $this->web_model->findById('external_api_setup', array('id'=>3));
        $apiData  = json_decode($cryptoconfig->data);
        $cryptocompage_api_key = $apiData->api_key;
       
        $per_page = 15;


        $data['cryptocoins']  = $this->db->select("symbol")->from('dbt_cryptocoin')->where('status', 1)->order_by('rank', 'asc')->limit($per_page, $data1)->get()->result();

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
        $data['title'] = $this->uri->segment(1);

        if ($this->session->userdata('isLogIn'))
            redirect(base_url());

        //Load Cookie For Store Referral ID
        $this->load->helper(array('cookie'));
        $ref=$this->input->get('ref', TRUE); 

        if (isset($ref) && ($ref!="")) {
            $user_id = $this->db->select('user_id')->where('user_id', $ref)->get('dbt_user')->row();
            if($user_id){
                set_cookie('referral_id', $ref, 86400*30);

            }
            else{
                $this->session->set_flashdata('exception', display('referral_id_is_invalid'));
                redirect("register");

            }
        }               

        //Load Helper For [user_id] Generate
        $this->load->helper('string');

        //Set Rules From validation
        $this->form_validation->set_rules('rf_name', display('firstname'), 'required|max_length[50]|trim');
        $this->form_validation->set_rules('remail', display('email'), "required|valid_email|max_length[100]|trim");
        $this->form_validation->set_rules('rpass', display('password'), 'required|min_length[8]|matches[rr_pass]|trim');
        $this->form_validation->set_rules('rr_pass', display('conf_password'), 'required|trim');
        $this->form_validation->set_rules('raccept_terms', display('accept_terms_privacy'), 'required|trim');

        //From Validation Check
        if ($this->form_validation->run()) {

            if (!$this->input->valid_ip($this->input->ip_address())){
                $this->session->set_flashdata('exception',  display('invalid_ip_address'));
                redirect("register");
            }

            //Generate User Id
            $userid = strtoupper(random_string('alnum', 6));

            while ( $this->web_model->checkUseridExist($userid) ) {
                $userid = strtoupper(random_string('alnum', 6));

            }
            
            if ($this->web_model->checkEmailExist($this->input->post('remail', TRUE))) {

                if ($this->web_model->accountStatusCheck($this->input->post('remail', TRUE)) == 0) {
                    $this->session->set_flashdata('exception',  display('please_activate_your_account'));
                    redirect("login");

                }
                elseif ($this->web_model->accountStatusCheck($this->input->post('remail', TRUE)) == 1) {
                    $this->session->set_flashdata('exception',  display('already_regsister'));
                    redirect("login");

                } 
                elseif ($this->web_model->accountStatusCheck($this->input->post('remail', TRUE)) == 2) {
                    $this->session->set_flashdata('exception',  display('this_account_is_now_pending'));
                    redirect("login");

                }  
                elseif ($this->web_model->accountStatusCheck($this->input->post('remail', TRUE)) == 3) {
                    $this->session->set_flashdata('exception',  display('this_account_is_suspend'));
                    redirect("register");

                }               

            }

            $dlanguage = $this->db->select('language')->get('setting')->row();

            $data = [
                'first_name'    => $this->input->post('rf_name', TRUE),
                'referral_id'   => $this->input->cookie('referral_id', TRUE), 
                'language'      => $dlanguage->language,
                'user_id'       => $userid,
                'email'         => $this->input->post('remail', TRUE),
                'password'      => md5($this->input->post('rpass', TRUE)),
                'password_reset_token' => md5($userid),
                'status'        => 0,
                'ip'            => $this->input->ip_address()
            ];

            if($this->web_model->registerUser($data)){
                $appSetting = $this->common_model->get_setting();

                $data['title']      = $appSetting->title;
                $data['to']         = $this->input->post('remail', TRUE);
                $data['subject']    = 'Account Activation';
                $data['message']    = "<br><b>Your account was created successfully, Please click on the link below to activate your account. </b><br> <a target='_blank' href='".base_url('activate-account/').md5($userid)."'>".base_url('activate-account/').md5($userid)."</a>";
                $this->common_model->send_email($data);

                $this->session->set_flashdata('message', display('account_create_active_link'));
                redirect("login");
            }

        }

        $this->load->view('website/header', $data);     
        $this->load->view('website/register', $data);
        $this->load->view('website/footer', $data);
        
    }

    public function login()
    {
        if ($this->session->userdata('isLogIn'))
            redirect(base_url());

        //Cookie initialize
        $this->load->helper(array('cookie'));
             
        $data['title']  = $this->uri->segment(1);
        $email          = $this->input->post('luseremail', TRUE);
        $password       = $this->input->post('lpassword');
        $passwordmd5    = md5($password);

        //Set Rules From validation
        $this->form_validation->set_rules('luseremail', display('email'), 'required|max_length[100]|trim');
        $this->form_validation->set_rules('lpassword', display('password'), 'required|max_length[32]|md5|trim');



        $security = $this->db->select('*')->from('dbt_security')->where('keyword','capture')->where('status', 1)->get()->row();
        if ($security) {
            //If  goggle capture enable
            $this->form_validation->set_rules('g-recaptcha-response', "Recaptcha", 'required|trim');
            $data = array(
                'widget' => $this->recaptcha->getWidget(),
                'script' => $this->recaptcha->getScriptTag(),
            );
        }

        //From Validation Check
        if ($this->form_validation->run())
        {
            $date        = new DateTime();
            $access_time = $date->format('Y-m-d H:i:s');

            $data['user'] = (object)$userData = array(
                'email'      => $email,
                'password'   => $passwordmd5
            );


            $security_login = $this->db->select('*')->from('dbt_security')->where('keyword','login')->where('status', 1)->get()->row();
            if ($security_login) {
                $security_login_decode = json_decode($security_login->data, TRUE);
            }
            

            //Check already try
            $cookie_count = get_cookie('wrong_loginx', TRUE);
            if ($cookie_count) {
                //30 min
                $this->session->set_flashdata('exception', "Try it after ".$security_login_decode['duration']." min");
                redirect(base_url('login'));
            }

            if ($this->web_model->checkEmailExist($email)) {

                $user_status = $this->web_model->accountStatusCheck($email);

                if ($user_status == 0) {
                    $this->session->set_flashdata('exception',  display('please_activate_your_account'));
                    redirect("login");

                }
                elseif ($user_status == 2) {
                    $this->session->set_flashdata('exception',  display('this_account_is_now_pending'));
                    redirect("login");

                }  
                elseif ($user_status == 3) {
                    $this->session->set_flashdata('exception',  display('this_account_is_suspend'));
                    redirect("login");

                }
                elseif ($user_status == 1) {

                    $user = $this->web_model->loginCheckUser($userData);

                    if($user) {
                        //Delete session and cookies wrong try
                        $this->session->unset_userdata('wrong_login');
                        delete_cookie('wrong_loginc');
                        delete_cookie('wrong_loginx');

                        $query = $this->db->select('googleauth')->from('dbt_user')->where('user_id',  $user->user_id)->get()->row();

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
                                'ip'           => $this->input->ip_address()
                            );

                            $this->session->set_userdata('userdata', $sData);
                            $this->session->set_userdata('userlogdata', $logData);
                            redirect(base_url('login-verify'));                               

                        } else {

                            $user_agent = array(
                                'device'     => $this->agent->browser(),
                                'browser'    => $this->agent->browser().' V-'.$this->agent->version(),
                                'platform'   => $this->agent->platform()
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
                                'ip'           => $this->input->ip_address()
                            );


                           $this->session->set_flashdata('message', '<script type="text/javascript">toastr.success("You Are Logged In Successfully!")</script>');


                            //Store data to session, log & Login
                            $this->session->set_userdata($sData);
                            $this->web_model->storeUserLogData($logData);
                            redirect(base_url());
                        }                            

                    }
                    else{

                        //Security module
                        $wrong_login = $this->session->userdata('wrong_login');

                        if ($wrong_login) {

                            $this->session->set_userdata('wrong_login', $wrong_login+1);
                            $wrong_login = $this->session->userdata('wrong_login');
    
                            if ($wrong_login%@$security_login_decode['wrong_try']==0) {

                                //database update ip/account deactive base on session
                                # code...

                                $cookie_count = get_cookie('wrong_loginc', TRUE);
                                if ($cookie_count) {
                                    $this->session->unset_userdata('wrong_login');
                                    //30 min
                                    set_cookie('wrong_loginc', $cookie_count+1, 3600*24);
                                    $cookie_count = get_cookie('wrong_loginc', TRUE);
                                    if ($cookie_count>=@$security_login_decode['ip_block']) {
                                        //database update ip/account deactive base on cookie
                                        $this->db->insert('dbt_blocklist', array('ip_mail' => $this->input->ip_address()));
                                    }

                                }else{
                                    $this->session->unset_userdata('wrong_login');
                                    //30 min
                                    set_cookie('wrong_loginc', 1, 3600*24);
                                    set_cookie('wrong_loginx', 1, 60*@$security_login_decode['duration']);

                                }

                                $this->session->set_flashdata('exception', "Try it after ".$security_login_decode['duration']." min");

                            }
                            
                        }else{

                            if ($security_login) {
                                if (1%@$security_login_decode['wrong_try']==0) {
                                    //database update ip/account deactive base on session
                                    # code...

                                    $cookie_count = get_cookie('wrong_loginc', TRUE);
                                    if ($cookie_count) {
                                        $this->session->unset_userdata('wrong_login');
                                        //1 day
                                        set_cookie('wrong_loginc', $cookie_count+1, 3600*24);
                                        $cookie_count = get_cookie('wrong_loginc', TRUE);

                                        if ($cookie_count>=@$security_login_decode['ip_block']) {
                                            //database update ip/account deactive base on cookie
                                            $this->db->insert('dbt_blocklist', array('ip_mail' => $this->input->ip_address()));
                                        }

                                    }else{
                                        $this->session->unset_userdata('wrong_login');
                                        //30 min
                                        set_cookie('wrong_loginc', 1, 3600*24);
                                        set_cookie('wrong_loginx', 1, 60*@$security_login_decode['duration']);

                                    }

                                    $cookie_count = get_cookie('wrong_loginc', TRUE);                                
                                    $this->session->set_flashdata('exception', "Try it after ".$security_login_decode['duration']." min");
                                
                                }else{
                                    $this->session->set_userdata('wrong_login', 1);

                                }
                            }                         

                        }
                        
                        $this->session->set_flashdata('exception', display('incorrect_email_password'));
                        redirect(base_url('login'));

                    }
                }
                else{
                    $this->session->set_flashdata('exception', display('something_wrong'));
                    redirect(base_url('login'));

                }

            }else{
                $this->session->set_flashdata('exception', display('incorrect_email_password'));
            }
            
        }

        $this->load->view('website/header', $data);     
        $this->load->view('website/login', $data);
        $this->load->view('website/footer', $data);

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

        if (!($this->session->userdata('isLogIn') && $this->session->userdata('user_id')))
            redirect('login');

             
        $data['title']  = $this->uri->segment(1);
        $user_id        = $this->session->userdata('user_id');

        $this->form_validation->set_rules('first_name', display('firstname'),'required|max_length[50]|trim');
        $this->form_validation->set_rules('email', display('email'), "required|valid_email|max_length[100]|callback_email_check[$user_id]|trim");
        $this->form_validation->set_rules('phone', display('phone'), "required|max_length[100]|callback_phone_check[$user_id]|trim");
        $this->form_validation->set_rules('password', display('password'),'required|max_length[32]|trim');


        if ($this->form_validation->run()) {

            $user   = $this->web_model->retriveUserInfo();
            if ($user->password != md5($this->input->post('password'))) {
                $this->session->set_flashdata('exception', display('password_missmatch'));
                redirect("edit-profile");
            }
            //set config 
            $config = [
                'upload_path'      => './upload/user/',
                'allowed_types'    => 'gif|jpg|png|jpeg', 
                'overwrite'        => false,
                'maintain_ratio'   => true,
                'encrypt_name'     => true,
                'remove_spaces'    => true,
                'file_ext_tolower' => true 
            ]; 
            $this->load->library('upload', $config);
     
            if ($this->upload->do_upload('image')) {  
                $data = $this->upload->data();  
                $image = $config['upload_path'].$data['file_name']; 

                $config['image_library']  = 'gd2';
                $config['source_image']   = $image;
                $config['create_thumb']   = false;
                $config['encrypt_name']   = TRUE;
                $config['width']          = 115;
                $config['height']         = 90;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                $this->session->set_flashdata('message', display("image_upload_successfully"));
            }

            $data['user'] = (object)$userData = array(
                'user_id'      => $user_id,
                'first_name'   => $this->input->post('first_name', TRUE),
                'last_name'    => $this->input->post('last_name', TRUE),
                'email'        => $this->input->post('email', TRUE),
                'phone'        => $this->input->post('phone', TRUE),
                'bio'          => $this->input->post('bio', TRUE),
                'image'        => (!empty($image)?$image:$this->input->post('old_image', TRUE)) 
            );

            if (empty($userData['image'])) {
                $this->session->set_flashdata('exception', $this->upload->display_errors()); 

            }

            if ($this->web_model->updateUser($userData)) 
            {
                $this->session->set_userdata(array(
                    'fullname' => $this->input->post('first_name', TRUE). ' ' .$this->input->post('last_name', TRUE),
                    'email'    => $this->input->post('email', TRUE),
                    'image'    => (!empty($image)?$image:$this->input->post('old_image', TRUE))
                ));
                $this->session->set_flashdata('message', display('update_successfully'));


            } else {
                $this->session->set_flashdata('exception',  display('please_try_again'));

            }
            redirect("edit-profile");

        }

        
        $data['user']   = $this->web_model->retriveUserInfo();

        $this->load->view('website/header', $data);     
        $this->load->view('website/edit_profile', $data);
        $this->load->view('website/footer', $data);

    }



    public function change_password(){

        if (!($this->session->userdata('isLogIn') && $this->session->userdata('user_id')))
            redirect('login');

        $data['title'] = $this->uri->segment(1);

        $this->form_validation->set_rules('old_pass', display('enter_old_password'), 'required|trim');
        $this->form_validation->set_rules('new_pass', display('enter_new_password'), 'required|max_length[32]|matches[confirm_pass]|trim');
        $this->form_validation->set_rules('confirm_pass', display('enter_confirm_password'), 'required|max_length[32]|trim');
        
        if ( $this->form_validation->run())
        {
            $oldpass = MD5($this->input->post('old_pass'));
            $new_pass['password'] = MD5($this->input->post('new_pass'));
            $query = $this->db->select('password')
                ->from('dbt_user')
                ->where('user_id',$this->session->userdata('user_id'))
                ->where('password',$oldpass)
                ->get()
                ->num_rows();

            if($query > 0) {

                $this->db->where('user_id',$this->session->userdata('user_id'))->update('dbt_user',$new_pass);
                $this->session->set_flashdata('message', display('password_change_successfull'));
                redirect('change-password');

            } else {
                $this->session->set_flashdata('exception',display('old_password_is_wrong'));
                redirect('change-password');

            }

        }
    
        $this->load->view('website/header', $data);     
        $this->load->view('website/change_password', $data);
        $this->load->view('website/footer', $data);

    }

    public function login_verify()
    {

        if ($this->session->userdata('isLogIn'))
            redirect(base_url());

        $data['title']      = $this->uri->segment(1);

        $userdata    = $this->session->userdata('userdata');
        $userlogdata = $this->session->userdata('userlogdata');

        // 2 factor authentication codes.
        $this->load->library('GoogleAuthenticator'); 

        $query = $this->db->select('googleauth')->from('dbt_user')->where('user_id',  $userdata['user_id'])->get()->row();
        $appSetting = $this->common_model->get_setting();

        $ga                 = new GoogleAuthenticator();
        $secret             = $query->googleauth;
        $qrCodeUrl          = $ga->getQRCodeGoogleUrl($appSetting->title, $secret);
        $data['qrCodeUrl']  = $qrCodeUrl;

        //Set Rules From validation
        $this->form_validation->set_rules('token', 'token', 'required|max_length[6]|trim');
        
        //From Validation Check
        if ($this->form_validation->run())
        {
            $oneCode = $this->input->post('token', TRUE);
          

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
                $this->session->unset_userdata('userdata');
                $this->session->unset_userdata('userlogdata');

                //Store data to session, log & Login
                $this->session->set_userdata($sData);
                $this->web_model->storeUserLogData($logData);
                redirect(base_url());

            } else {

                $this->session->set_flashdata('exception', display('invalid_authentication_code'));

            }
            
        }


        $this->load->view('website/header', $data);     
        $this->load->view('website/gauthlogin', $data);
        $this->load->view('website/footer', $data);

    }

    public function forgotPassword()
    {

        //Set Rules From validation
        $this->form_validation->set_rules('luseremail', display('email'),'required|valid_email|max_length[100]|trim');

        //From Validation Check
        if ($this->form_validation->run()) {
            $userdata = array(
                'email'       => $this->input->post('luseremail', TRUE),
            );

            $varify_code = $this->randomID();

            /******************************
            *  Email Verify
            ******************************/
            $appSetting = $this->common_model->get_setting();

            $post = array(
                'title'      => $appSetting->title,
                'subject'    => 'Password Reset Verification!',
                'to'         => $this->input->post('luseremail', TRUE),
                'message'    => 'The Verification Code is <h1>'.$varify_code.'</h1>'
            );

            //Send Mail Password Reset Verification
            $send = $this->common_model->send_email($post);
            
            if(isset($send)){

                $varify_data = array(

                    'ip_address'    => $this->input->ip_address(),
                    'user_id'       => $this->session->userdata('user_id'),
                    'session_id'    => $this->session->userdata('isLogIn'),
                    'verify_code'   => $varify_code,
                    'data'          => json_encode($userdata)
                );

                $this->db->insert('dbt_verify',$varify_data);
                $id = $this->db->insert_id();

                $this->session->set_flashdata('message', display('password_reset_code_send_check_your_email'));
                redirect("resetPassword");

            }
        }else{
            $this->session->set_flashdata('exception', display('email_required'));
            redirect('login');

        }

    }

    public function resetPassword()
    {   

        $data['title'] = $this->uri->segment(1);   

        $code        = $this->input->post('verificationcode', TRUE);
        $newpassword = $this->input->post('newpassword', TRUE);
        
        $chkdata = $this->db->select('*')
            ->from('dbt_verify')
            ->where('verify_code',$code)
            ->where('status', 1)
            ->get()
            ->row();

        //Set Rules From validation
        $this->form_validation->set_rules('verificationcode', display('enter_verify_code'),'required|max_length[10]|alpha_numeric|trim');
        $this->form_validation->set_rules('newpassword', display('password'),'required|min_length[8]|matches[r_pass]|trim');
        $this->form_validation->set_rules('r_pass', display('password'),'required|trim');


        $security = $this->db->select('*')->from('dbt_security')->where('keyword','capture')->where('status', 1)->get()->row();
        if ($security) {
            //If  goggle capture enable
            $this->form_validation->set_rules('g-recaptcha-response', "Recaptcha", 'required|trim');
            $data = array(
                'widget' => $this->recaptcha->getWidget(),
                'script' => $this->recaptcha->getScriptTag(),
            );
        }

        //From Validation Check
        if ($this->form_validation->run()) {
            if($chkdata!=NULL) {
                $p_data     = ((array) json_decode($chkdata->data));
                $password   = array('password' => md5($newpassword));
                $status     = array('status'   => 0);

                $this->db->where('verify_code',$code)->update('dbt_verify', $status);
                $this->db->where('email',$p_data['email'])->update('dbt_user', $password);

                $this->session->set_flashdata('message', display('password_changed'));
                redirect('login');

            }else{
                $this->session->set_flashdata('exception',display('wrong_try_activation'));
                redirect('resetPassword');
            }

        } else {

         
            $this->load->view('website/header', $data);     
            $this->load->view('website/passwordreset', $data);
            $this->load->view('website/footer', $data);
        }

    }

    public function googleauth()
    {

        if (!($this->session->userdata('isLogIn') && $this->session->userdata('user_id')))
            redirect('login');

        $data['title']      = $this->uri->segment(1);


        // 2 factor authentication codes.
        $this->load->library('GoogleAuthenticator');

        $ga = new GoogleAuthenticator();

        $query = $this->db->select('googleauth')->from('dbt_user')->where('user_id', $this->session->userdata('user_id'))->get()->row();
        $appSetting = $this->common_model->get_setting();

        if ($query->googleauth!='') {
            $secret = $query->googleauth;
            $data['btnenable'] = 0;

        }else{
            $secret = $ga->createSecret();
            $data['btnenable'] = 1;

        }
        
        $data['secret'] = $secret;

        $qrCodeUrl = $ga->getQRCodeGoogleUrl($appSetting->title, $secret);
        $data['qrCodeUrl'] = $qrCodeUrl;


        //Set Rules From validation
        $this->form_validation->set_rules('token', "token", 'required|max_length[6]|trim');
        $this->form_validation->set_rules('secret', "secret", 'required|max_length[16]|trim');
        
        //From Validation Check
        if ($this->form_validation->run())
        {

            if (isset($_POST['disable'])) {
                $oneCode = $this->input->post('token', TRUE);
                $secret = $query->googleauth;
                $checkResult = $ga->verifyCode($secret, $oneCode, 2);    // 2 = 2*30sec clock tolerance

                if ($checkResult) {
                    $secret = NULL;
                    $this->db->set('googleauth', $secret)->where('user_id', $this->session->userdata('user_id'))->update("dbt_user");
                    $this->session->set_flashdata('message', display('google_authenticator_disabled'));
                    redirect("profile");

                } else {

                    $this->session->set_flashdata('exception', display('invalid_authentication_code'));

                }
            }

            if (isset($_POST['enable'])) {
                $oneCode = $this->input->post('token', TRUE);
                $secret = $this->input->post('secret', TRUE);
                $checkResult = $ga->verifyCode($secret, $oneCode, 2);    // 2 = 2*30sec clock tolerance

                if ($checkResult) {
                    $this->db->set('googleauth', $secret)->where('user_id', $this->session->userdata('user_id'))->update("dbt_user");
                    $this->session->set_flashdata('message', display('google_authenticator_enabled'));
                    redirect("profile");

                } else {

                    $this->session->set_flashdata('exception', display('invalid_authentication_code'));

                }
            }
            
        }

      
        $this->load->view('website/header', $data);     
        $this->load->view('website/googleauthenticator', $data);
        $this->load->view('website/footer', $data);

    }

    public function activate_account($activecode=NULL){

        
        if ($activecode !=NULL || $activecode != '') {
            
           $user = $this->web_model->passwordtokenCheck($activecode);

            if ($user->status == 1){
                $this->session->set_flashdata('message', display('this_account_already_activated'));
                redirect("login");

            }elseif ($user->status == 2) {
                $this->session->set_flashdata('exception',  display('this_account_is_now_pending'));
                redirect("login");

            }elseif ($user->status == 3) {
                $this->session->set_flashdata('exception',  display('this_account_is_suspend'));
                redirect("login");

            }elseif ($user->status == 0) {
                $this->web_model->activeUserAccount($activecode);
                $this->session->set_flashdata('message', display('active_account'));
                redirect("login");
            }
            else{
                $this->session->set_flashdata('exception', display('something_wrong'));
                redirect(base_url('login'));

            }

        }
        else{
            $this->session->set_flashdata('exception', display('wrong_try_activation'));
            redirect("login");

        }
        
    }


    //Ajax Subscription Action
    public function subscribe()
    {
        $data = array();
        $data['email'] =  $this->input->post('subscribe_email', TRUE);
        
        $this->form_validation->set_rules('subscribe_email', display('email'),"required|valid_email|max_length[50]|trim");
        
        if ($this->form_validation->run()) {
            if($this->web_model->subscribe($data)){
                echo 1;
            }
            else{
                echo 2;
            }
        }else{
            echo 0;
        }

    }


    public function payout_setting($method=NULL)
    {   
        $wallet_id          = $this->input->post('wallet_id', TRUE);  
        $currency_symbol    = $this->input->post('currency_symbol', TRUE);  
        $currency_symbol1   = $this->input->post('currency_symbol1', TRUE);  
        $user_id            = $this->session->userdata('user_id');

        $data['bitcoin_btc']    = $this->db->select('*')->from('dbt_payout_method')->where('user_id',$user_id)->where('currency_symbol','BTC')->where('method','bitcoin')->get()->row();
        $data['bitcoin_bch']    = $this->db->select('*')->from('dbt_payout_method')->where('user_id',$user_id)->where('currency_symbol','BCH')->where('method','bitcoin')->get()->row();
        $data['bitcoin_ltc']    = $this->db->select('*')->from('dbt_payout_method')->where('user_id',$user_id)->where('currency_symbol','LTC')->where('method','bitcoin')->get()->row();
        $data['bitcoin_dash']   = $this->db->select('*')->from('dbt_payout_method')->where('user_id',$user_id)->where('currency_symbol','DASH')->where('method','bitcoin')->get()->row();
        $data['bitcoin_doge']   = $this->db->select('*')->from('dbt_payout_method')->where('user_id',$user_id)->where('currency_symbol','DOGE')->where('method','bitcoin')->get()->row();
        $data['bitcoin_spd']    = $this->db->select('*')->from('dbt_payout_method')->where('user_id',$user_id)->where('currency_symbol','SPD')->where('method','bitcoin')->get()->row();
        $data['bitcoin_rdd']    = $this->db->select('*')->from('dbt_payout_method')->where('user_id',$user_id)->where('currency_symbol','RDD')->where('method','bitcoin')->get()->row();
        $data['bitcoin_pot']    = $this->db->select('*')->from('dbt_payout_method')->where('user_id',$user_id)->where('currency_symbol','POT')->where('method','bitcoin')->get()->row();
        $data['bitcoin_ftc']    = $this->db->select('*')->from('dbt_payout_method')->where('user_id',$user_id)->where('currency_symbol','FTC')->where('method','bitcoin')->get()->row();
        $data['bitcoin_vtc']    = $this->db->select('*')->from('dbt_payout_method')->where('user_id',$user_id)->where('currency_symbol','VTC')->where('method','bitcoin')->get()->row();
        $data['bitcoin_ppc']    = $this->db->select('*')->from('dbt_payout_method')->where('user_id',$user_id)->where('currency_symbol','PPC')->where('method','bitcoin')->get()->row();
        $data['bitcoin_mue']    = $this->db->select('*')->from('dbt_payout_method')->where('user_id',$user_id)->where('currency_symbol','MUE')->where('method','bitcoin')->get()->row();
        $data['bitcoin_unit']   = $this->db->select('*')->from('dbt_payout_method')->where('user_id',$user_id)->where('currency_symbol','UNIT')->where('method','bitcoin')->get()->row();

        $data['payeer_btc'] = $this->db->select('*')->from('dbt_payout_method')->where('user_id',$user_id)->where('currency_symbol','BTC')->where('method','payeer')->get()->row();
        $data['payeer_usd'] = $this->db->select('*')->from('dbt_payout_method')->where('user_id',$user_id)->where('currency_symbol','USD')->where('method','payeer')->get()->row();
        
        $data['paypal'] = $this->db->select('*')->from('dbt_payout_method')->where('user_id',$user_id)->where('currency_symbol','USD')->where('method','paypal')->get()->row();
        $data['stripe'] = $this->db->select('*')->from('dbt_payout_method')->where('user_id',$user_id)->where('currency_symbol','USD')->where('method','stripe')->get()->row();
        $data['bank']   = $this->db->select('*')->from('dbt_payout_method')->where('user_id',$user_id)->where('currency_symbol','USD')->where('method','bank')->get()->row();
        $data['phone']  = $this->db->select('*')->from('dbt_payout_method')->where('user_id',$user_id)->where('currency_symbol','USD')->where('method','phone')->get()->row();


        if ($method=='bitcoin') {
            $this->form_validation->set_rules('wallet_id', "Gourl", 'required|alpha_numeric|max_length[50]|trim');
        }else if($method=='payeer'){
            $this->form_validation->set_rules('wallet_id', "Payeer", 'required|alpha_numeric|max_length[30]|trim');

        }else if($method=='paypal'){
            $this->form_validation->set_rules('wallet_id', "Paypal", 'required|valid_email|max_length[50]|trim');

        }else if($method=='stripe'){
            $this->form_validation->set_rules('wallet_id', "Stripe", 'required|max_length[50]|trim');

        }else if($method=='bank'){
            $this->form_validation->set_rules('wallet_id', "Bank", 'required|max_length[50]|trim');

        }else if($method=='phone'){
            $this->form_validation->set_rules('wallet_id', "Phone", 'required|numeric|max_length[15]|trim');

        }else{
            $this->form_validation->set_rules('wallet_id', "wallet_id", 'required|alpha_numeric|max_length[100]|trim');

        }
        
        
        //From Validation Check
        if ($this->form_validation->run())
        {
            if($method!=NULL) {
                $data = array('user_id' => $user_id,'method' => $method,'wallet_id' => $wallet_id,'currency_symbol' => $currency_symbol);
                $check = $this->db->select('*')->from('dbt_payout_method')->where('user_id',$user_id)->where('method',$method)->where('currency_symbol', $currency_symbol)->get()->row();

                if($check!=NULL) {
                   $this->db->where('user_id',$user_id)->where('method',$method)->where('currency_symbol', $currency_symbol)->update('dbt_payout_method',$data); 

                } else {
                    $this->db->insert('dbt_payout_method',$data); 

                }

                //Only Payeer Account
                if ($currency_symbol1) {
                    $data1  = array('user_id' => $user_id,'method' => $method,'wallet_id' => $wallet_id,'currency_symbol' => $currency_symbol1);
                    $check1 = $this->db->select('*')->from('dbt_payout_method')->where('user_id',$user_id)->where('method',$method)->where('currency_symbol', $currency_symbol1)->get()->row();

                    if($check1!=NULL) {
                       $this->db->where('user_id',$user_id)->where('method',$method)->where('currency_symbol', $currency_symbol1)->update('dbt_payout_method',$data1);

                    } else {
                        $this->db->insert('dbt_payout_method',$data1); 

                    }
                }

                $this->session->set_flashdata('message',display('update_successfully')); 
                redirect('payout-setting');

            }
        }

        $this->load->view('website/header', $data);     
        $this->load->view('website/payout_setting', $data);
        $this->load->view('website/footer', $data); 
    }


    public function bank_setting($method = NULL)
    {


        $user_id = $this->session->userdata('user_id');

        //Set Rules From validation
        $this->form_validation->set_rules('acc_name', display('account_name'), 'required|max_length[100]|trim');
        $this->form_validation->set_rules('acc_no', display('account_no'), 'required|max_length[100]|trim');
        $this->form_validation->set_rules('branch_name', display('branch_name'), 'required|max_length[100]|trim');
        $this->form_validation->set_rules('country', display('country'), 'required|max_length[100]|trim');
        $this->form_validation->set_rules('bank_name', display('bank_name'), 'required|max_length[100]|trim');

        //From Validation Check
        if ($this->form_validation->run())
        {

            $user_id        = $this->session->userdata('user_id');
            $currency_symbol= $this->input->post('currency_symbol', TRUE);
            $acc_name       = $this->input->post('acc_name', TRUE);
            $acc_no         = $this->input->post('acc_no', TRUE);
            $branch_name    = $this->input->post('branch_name', TRUE);
            $swift_code     = $this->input->post('swift_code', TRUE);
            $abn_no         = $this->input->post('abn_no', TRUE);
            $country        = $this->input->post('country', TRUE);
            $bank_name      = $this->input->post('bank_name', TRUE);

            $post_data = $this->input->post(NULL, TRUE);

            $wallet_id = json_encode($post_data);

            if($method != NULL) {
                $data = array('user_id'=>$user_id,'method'=> $method, 'wallet_id'=> $wallet_id, 'currency_symbol' => $currency_symbol);
                $check = $this->db->select('*')->from('dbt_payout_method')->where('user_id', $user_id)->where('method', $method)->where('currency_symbol', $currency_symbol)->get()->row();

                if($check != NULL) {
                   $this->db->where('user_id', $user_id)->where('method', $method)->where('currency_symbol', $currency_symbol)->update('dbt_payout_method', $data);

                } else {
                    $this->db->insert('dbt_payout_method', $data); 

                }

                $this->session->set_flashdata('message',display('update_successfully')); 
                redirect('bank-setting');

            }

        }
        
        $bank = $this->db->select('*')->from('dbt_payout_method')->where('user_id',$user_id)->where('currency_symbol', 'USD')->where('method','bank')->get()->row();

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

        $data['countrys'] = $this->db->select('*')->from('dbt_country')->get()->result();

        $this->load->view('website/header', $data);     
        $this->load->view('website/bank_setting', $data);
        $this->load->view('website/footer', $data); 
    }

    //Ajax Language Change
    public function langChange()
    {
        $newdata = array(
            'lang'  => $this->input->post('lang', TRUE)
        );        

        $user_id = $this->session->userdata('user_id');
        if ($user_id != "") {
            $data['language'] = $this->input->post('lang', TRUE);
            $this->db->where('user_id', $user_id);
            $this->db->update('dbt_user', $data);
        }
        else {
            $this->session->set_userdata($newdata);

        }
        
    }


    /******************************
    * Language Set For User
    ******************************/
    public function langSet(){

        $lang = "";
        $user_id = $this->session->userdata('user_id');
        if ($user_id!="") {
            $ulang = $this->db->select('language')->where('user_id', $user_id)->get('dbt_user')->row();
            if ($ulang->language!='english') {
                $lang    ='french';
                $newdata = array(
                    'lang'  => 'french'
                );
                $this->session->set_userdata($newdata);

            }
            else{
                $lang    ='english';
                $newdata = array(
                    'lang'  => 'french'
                );
                $this->session->set_userdata($newdata);
            }

        }
        else{
            $alang      = $this->db->select('language')->get('setting')->row();
            if ($alang->language=='french') {
                $lang   ='french';
                $newdata = array(
                    'lang'  => 'french'
                );
                $this->session->set_userdata($newdata);

            }else{
                if ($this->session->lang=='french') {
                    $lang ='french';

                }
                else{
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
