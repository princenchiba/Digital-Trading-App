<?php namespace App\Libraries;
use App\Models\Common_model;
use App\Views\view_css;

class Home_layout {
	public function __construct()
    {
        $this->session 	= session();
        $this->db 		= db_connect();
        $this->uri 		= current_url(true);
        $this->common_model 		= new Common_model();
    }
	public function master($data){

		$data['settings'] 	= $this->setting_data();
		$data['session']	= session();
		$data['lang']      	= $this->langSet();
		$data['web_language'] = $this->common_model->findById('web_language', array('id' => 1));
		$data['query_pair'] = $this->common_model->findById('dbt_coinpair', array('status' => 1));
       
		$data['segments'] = $this->uri->getSegments();
		$data['userinfo'] = $this->user_data();
		$data['social_link'] = $this->common_model->findAll('web_social_link', array('status' => 1), 'id', 'asc');
		$data['category'] = $this->common_model->findAll('web_category', array('status' => 1), 'position_serial', 'asc');

		$theme           	= $this->common_model->findById('dbt_theme', array('status' => 1));
        $data['addTemplate']= $this->common_model->findById('themes', array('status' => 1));

        $data['theme']   	= json_decode($theme->settings);
        $data['css_page']	= view('view_css', $data);

		return view('website/'.$data['addTemplate']->name.'/index', $data);
	}

	public function setting_data(){
		$builder = $this->db->table('setting')->get()->getRow(); 
		return $builder;
	}

	public function user_data(){
		$builder = $this->db->table('dbt_user')->where('user_id', $this->session->get('user_id'))->get()->getRow(); 
		return $builder;
	}


	/******************************
    * Language Set For User
    ******************************/
    public function langSet(){

        $lang = "";
        $user_id = $this->session->get('user_id');
        if ($user_id != "") {
            $ulang = $this->common_model->findById('dbt_user', array('user_id' => $user_id));

            if (@$ulang->language != 'english') {
                $lang    ='french';
                $newdata = array('lang' => 'french');
                $this->session->set($newdata);

            } else {

                $lang    ='english';
                $newdata = array('lang'  => 'french');
                $this->session->set($newdata);
            }

        } else {
        
            $alang = $this->common_model->findById('setting', array());
            if ($alang->language=='french') {
                $lang   ='french';
                $newdata = array('lang'  => 'french');
                $this->session->set($newdata);
            }else{
                if ($this->session->lang=='french') {

                    $lang ='french';

                } else {
                    $lang ='english';
                }

            }

        }
        return $lang;
    }
}
