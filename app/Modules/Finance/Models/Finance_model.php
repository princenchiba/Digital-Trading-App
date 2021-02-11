<?php namespace App\Modules\Finance\Models;

class Finance_model
{
	
	public function __construct()
    {
        $this->db = db_connect();
    }

  public function credit_info($id = null) {

    return $batchdata = $this->db->table('dbt_deposit')
                          ->select('dbt_deposit.*, dbt_user.first_name, dbt_user.last_name, dbt_user.phone, dbt_user.email')
                          ->join('dbt_user', 'dbt_user.user_id = dbt_deposit.user_id', 'LEFT')
                          ->where('dbt_deposit.id', $id)
                          ->where('dbt_deposit.status', 1)
                          ->get()
                          ->getRow();
	 }
}