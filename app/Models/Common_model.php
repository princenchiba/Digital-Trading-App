<?php namespace App\Models;

class Common_model
{
	
	public function __construct()
    {
        $this->db = db_connect();
    }

    public function save($table, $data=[]){

        $builder = $this->db->table($table);
        return  $builder->insert($data);
    } 


    public function save_return_id($table, $data=[]){
        $builder = $this->db->table($table);
        $builder->insert($data);
        return $this->db->insertID();
    }

    public function update($table, $data, $where = array()){
 		return $resutl = $this->db->table($table)
 								  ->set($data)
							 	  ->where($where)
							 	  ->update();
    }

    public function delete($table, $where = array()){
 		return $resutl = $this->db->table($table)
							 	  ->where($where)
							 	  ->delete();
    }

    public function findById($table, $where = array()){
 		return $resutl = $this->db->table($table)
							 	  ->where($where)
							 	  ->get()
							 	  ->getRow(); 
    }

    public function countRow($table, $where = array()){
 		return $resutl = $this->db->table($table)
							 	  ->where($where)
							 	  ->countAllResults(); 
    }

    public function findAll($table, $where = array(), $serialized = null, $order = null){
     $builder = $this->db->table($table);
		        $builder->select('*');
		        $builder->where($where);
		        $builder->orderBy($serialized, $order);
		        $query=$builder->get();
		        return $data=$query->getResult();
  	}

	public function get_all($table, $where = array(), $serialized = null, $order = null, $limit = 0, $offset = 0){
     $builder = $this->db->table($table);
		        $builder->select('*');
		        $builder->where($where);
		        $builder->limit($limit,$offset);
		        $builder->orderBy($serialized, $order);
		        $query=$builder->get();
		        return $data=$query->getResult();
  	}

  	//Send email via SMTP server in CodeIgniter
	public function send_email($post=array()){

		$inemail = \Config\Services::email();


		$emailq = $this->findById('email_sms_gateway', array('es_id' => 2));

    $config['protocol'] = $emailq->protocol;
    $config['SMTPHost'] = $emailq->host;
    $config['SMTPPort'] = $emailq->port;
    $config['SMTPUser'] = $emailq->user;
    $config['SMTPPass'] = $emailq->password;
    $config['mailType'] = $emailq->mailtype;
    $config['charset']  = $emailq->charset;
    $config['wordWrap'] = TRUE;

    $inemail->initialize($config);
    //Email content
    $htmlContent = $post['message'];
    $inemail->setFrom($emailq->user, $post['title']);
    $inemail->setTo($post['to']);
    $inemail->setSubject($post['subject']);
    $inemail->setMessage($htmlContent);
    
		//Send email
		if($inemail->send()){
			return 1;
		} else {
			return 0;
		}
	}
    public function send_email_theme($post=array()){

        $inemail  = \Config\Services::email();

        $emailq   = $this->findById('email_sms_gateway', array('es_id' => 2));
        $template = $this->_template($post['message'], $post);

        $config = Array(
          'protocol' => $emailq->protocol,
          'SMTPHost' => $emailq->host,
          'SMTPPort' => $emailq->port,
          'SMTPUser' => $emailq->user,
          'SMTPPass' => $emailq->password,
          'mailType' => $emailq->mailtype,
          'charset' =>  $emailq->charset,
          'wordWrap' => TRUE,
          'crlf' => "\r\n",
          'newline' => "\r\n"
        );

        $inemail->initialize($config);
        //Email content
        $htmlContent = $template;
        $inemail->setFrom($emailq->user, $post['title']);
        $inemail->setTo($post['to']);
        $inemail->setSubject($post['subject']);
        $inemail->setMessage($htmlContent);

     
        //Send email
        if($inemail->send()){

            return 1;
        } else {

            return 0;
        }
    }

	//tareq vai added this code
	public function email_msg_generate($config = array(), $message_data = array()){

    $templateemail = $this->db->table('dbt_sms_email_template')->select('*')->where('template_name', @$config['template_name'])->where('sms_or_email', 'email')->get()->getRow();

      $message       = ($config['template_lang']=='en')?$templateemail->template_en:$templateemail->template_fr;

        if (is_array($message_data) && sizeof($message_data) > 0){
            $message = $this->_template($message, $message_data);
        }
    //Email content
    $htmlContent = $message;
    $subject    = ($config['template_lang']=='en')?$templateemail->subject_en:$templateemail->subject_fr;
    
    $data = array(
      'subject'  => $subject,
      'message'  => $message
    );
    return $data;
  }

  public function sms_msg_generate($config = array(), $message_data = array()){

    $templatesms = $this->db->table('dbt_sms_email_template')->select('*')->where('template_name', @$config['template_name'])->where('sms_or_email', 'sms')->get()->getRow();


      $message  = ($config['template_lang']=='en')?$templatesms->template_en:$templatesms->template_fr;
      $subject  = ($config['template_lang']=='en')?$templatesms->subject_en:$templatesms->subject_fr;
      
      if (is_array($message_data) && sizeof($message_data) > 0){

          $message = $this->_template($message, $message_data);
      }
      
      $data = array(

        'subject'  => $subject,
        'message'  => $message

      );
  	return $data;
  }

	private function _template($template = null, $data = array())
  {
      $newStr = $template;

      foreach ($data as $key => $value) {

        $newStr = str_replace("%$key%", $value, $newStr);
      } 
      return $newStr; 
  }
}