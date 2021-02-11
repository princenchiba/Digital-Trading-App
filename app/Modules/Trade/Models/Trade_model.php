<?php namespace App\Modules\Trade\Models;

class Trade_model
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

  public function get_trade_history($limit = 0, $offset = 0) {

    return $batchdata = $this->db->table('dbt_biding')
                          ->select('dbt_biding.*, dbt_biding_log.bid_type, dbt_biding_log.bid_price, dbt_biding_log.market_symbol, dbt_biding_log.complete_amount, dbt_biding_log.success_time, dbt_biding_log.complete_qty, dbt_biding_log.complete_amount, dbt_biding_log.success_time')
                          ->join('dbt_biding_log', 'dbt_biding_log.bid_id = dbt_biding.id', 'LEFT')
                          ->orderBy('id', 'asc')
                          ->limit($limit, $offset)
                          ->get()
                          ->getResult();
  }

}