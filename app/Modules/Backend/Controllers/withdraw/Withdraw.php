<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Withdraw extends CI_Controller {
 	
 	public function __construct()
 	{
 		parent::__construct();
 		$this->load->model(array(
 			'backend/withdraw/withdraw_model',
            'common_model',
            'payment_model',
 		));
 		
 		if (!$this->session->userdata('isAdmin')) 
        redirect('logout');
 		
		if (!$this->session->userdata('isLogin') 
			&& !$this->session->userdata('isAdmin'))
			redirect('admin');
 	}
 
	public function withdraw_list()
	{  
		$data['title'] = display('withdraw_list');
 		//pagination starts
        $config["base_url"]         = base_url('backend/withdraw/withdraw/withdraw_list');
        $config["total_rows"]       = $this->db->count_all('dbt_withdraw');
        $config["per_page"]         = 25;
        $config["uri_segment"]      = 5;
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
        $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
        $data['withdraw'] = $this->withdraw_model->read($config["per_page"], $page);
        $data["links"]    = $this->pagination->create_links();
        //pagination ends  
		$data['content']  = $this->load->view("backend/withdraw/withdraw_list", $data, true);
		$this->load->view("backend/layout/main_wrapper", $data);
	}

	public function pending_withdraw()
	{
		$data['title'] = display('pending_withdraw');
        //pagination starts
        $config["base_url"]         = base_url('backend/withdraw/withdraw/pending_withdraw');
        $config["total_rows"]       = $this->db->get_where('dbt_withdraw', array('status'=>2))->num_rows();
        $config["per_page"]         = 25;
        $config["uri_segment"]      = 5;
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
        $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
        $data['withdraw'] = $this->db->select('*')->from('dbt_withdraw')
                                     ->where('status',2)
                                     ->limit($config["per_page"], $page)
                                     ->get()
                                     ->result();
        $data["links"] = $this->pagination->create_links();
        //pagination ends
		$data['content'] = $this->load->view("backend/withdraw/pending_withdraw", $data, true);
		$this->load->view("backend/layout/main_wrapper", $data);
	}


	public function confirm_withdraw()
	{
		$set_status   = 1;
		$user_id      = $_GET['user_id'];
		$id           = $_GET['id'];
		$data         = array(
			'success_date' =>date('Y-m-d h:i:s'),
			'status' => $set_status,
		);

        $this->db->where('id', $id)->where('user_id', $user_id)->update('dbt_withdraw', $data);

        $t_data     = $this->db->select('*')->from('dbt_withdraw')->where('id', $id)->where('user_id', $user_id)->get()->row();

        $userinfo   =  $this->db->select('*')->from('dbt_user')->where('user_id', $user_id)->get()->row();
		

        $set        = $this->common_model->email_sms('email');
        $appSetting = $this->common_model->get_setting();


        $check_user_balance = $this->db->select('*')->from('dbt_balance')->where('user_id', $user_id)->where('currency_symbol', $t_data->currency_symbol)->get()->row();
        $new_balance = $check_user_balance->balance-($t_data->amount+$t_data->fees_amount);

        $this->db->set('balance', $new_balance)->where('user_id', $user_id)->where('currency_symbol', $t_data->currency_symbol)->update("dbt_balance");
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
        $post = array(
            'title'             => $appSetting->title,
            'subject'           => 'Withdraw',
            'to'                => $this->session->userdata('email'),
            'message'           => 'You successfully withdraw the amount Is '.$t_data->amount.'. from your account. Your new balance is '.$new_balance,
        );
        $send = $this->common_model->send_email($post);
        
        if($send){
                $n = array(
                'user_id'                => $user_id,
                'subject'                => display('withdraw'),
                'notification_type'      => 'withdraw',
                'details'                => 'You successfully withdraw the amount Is '.$t_data->amount.'. from your account. Your new balance is '.$new_balance,
                'date'                   => date('Y-m-d h:i:s'),
                'status'                 => '0'
            );
            $this->db->insert('notifications',$n);    
        }

        #----------------------------
        #      Sms verify
        #----------------------------
            
        $this->load->library('sms_lib');

            $template = array( 
                'name'          => $userinfo->first_name." ".$userinfo->last_name,
                'amount'        => $t_data->amount,
                'new_balance'   => $new_balance,
                'date'          => date('d F Y')
            );

        if (@$userinfo->phone) {
            $send_sms = $this->sms_lib->send(array(
                'to'              => $userinfo->phone, 
                'subject'         => 'Withdraw',
                'template'        => 'You successfully withdraw the amount is %amount% from your account. Your new balance is %new_balance%', 
                'template_config' => $template, 
            ));

        } else {
            $this->session->set_flashdata('exception', display('there_is_no_phone_number'));
        }
                
        if(@$send_sms){
            $message_data = array(
                'sender_id'   => 1,
                'receiver_id' => $userinfo->user_id,
                'subject'     => 'Withdraw',
                'message'     => 'You successfully withdraw the amount is '.$t_data->amount.'. from your account. Your new balance is '.$new_balance,
                'datetime'    => date('Y-m-d h:i:s'),
            );

            $this->db->insert('message', $message_data);
        }
		redirect('backend/withdraw/withdraw/withdraw_list');
	}


    public function cancel_withdraw()
    {
        $set_status = 0;
        $user_id    = $_GET['user_id'];
        $id         = $_GET['id'];

        $data = array(
            'cancel_date' =>date('Y-m-d h:i:s'),
            'status'      => $set_status,
        );

        $this->db->where('id',$id)
                 ->where('user_id',$user_id)
                 ->update('dbt_withdraw',$data);
        redirect('backend/withdraw/withdraw/withdraw_list');
    }
}