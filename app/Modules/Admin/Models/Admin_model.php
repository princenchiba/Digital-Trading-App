<?php namespace App\Modules\Admin\Models;

class Admin_model
{
	
	public function __construct()
  {
    $this->db = db_connect();
  }
  
  public function singleUserVerifyDoc($user_id = null)
  {
    
    return $batchdata = $this->db->table('dbt_user')
          ->select('*')
          ->join('dbt_user_verify_doc', 'dbt_user_verify_doc.user_id = dbt_user.user_id', 'LEFT')
          ->where('dbt_user_verify_doc.user_id', $user_id)
          ->get()
          ->getRow();
  }
}