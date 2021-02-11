<?php namespace App\Models;

class M_crud
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


		$email = $this->findById('email_sms_gateway', array('es_id' => 2));
		
		//SMTP & mail configuration
		$config = array(
		    'protocol'  => $email->protocol,
		    'smtp_host' => $email->host,
		    'smtp_port' => $email->port,
		    'smtp_user' => $email->user,
		    'smtp_pass' => $email->password,
		    'mailtype'  => $email->mailtype,
		    'charset'   => $email->charset,
		    'newline'   => "\r\n"
		);

		//Email content
		$htmlContent = $post['message'];
		$inemail->setTo($post['to']);
		$inemail->setFrom($email->user ,$post['title']);
		$inemail->setSubject($post['subject']);
		$inemail->setMessage($htmlContent);

		//Send email
		if($inemail->send()){

			return 1;
		} else {

			return 0;
		}
	}

}