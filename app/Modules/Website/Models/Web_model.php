<?php namespace App\Modules\Website\Models;

class Web_model
{
	
	public function __construct()
  {
    $this->db = db_connect();
  }
  public function save($table, $data=[]){
      $builder = $this->db->table($table);
      return  $builder->insert($data);
  }
  public function update($table, $data, $where = array()){
    return $resutl = $this->db->table($table)
                  ->set($data)
                  ->where($where)
                  ->update();
  }
  public function checkUserAllBalance($user_id = null)
  {

    return $batchdata = $this->db->table('dbt_balance as balance')
          ->select('*')
          ->join('dbt_cryptocoin as coin', 'coin.symbol = balance.currency_symbol', 'LEFT')
          ->where('balance.user_id', $user_id)
          ->get()
          ->getResult();
  }

  //Add User Balance
  public function balanceAdd($data = array()){
 
    $check_user_balance = $this->db->table('dbt_balance')
                  ->where('user_id', $data->user_id)
                  ->where('currency_symbol', $data->currency_symbol)
                  ->get()
                  ->getRow();

      if ($check_user_balance) {

          $updatebalance = array(
              'balance'     => $data->amount+$check_user_balance->balance,
          );

          $this->db->table('dbt_balance')
                  ->set($updatebalance)
                  ->where('user_id', $data->user_id)
                  ->where('currency_symbol', $data->currency_symbol)
                  ->update();

          return  $check_user_balance->id;

      } else {

          $insertbalance = array(
              'user_id'         => $data->user_id,
              'currency_id'     => 0,
              'currency_symbol' => $data->currency_symbol,
              'balance'         => $data->amount,
              'last_update'     => date('Y-m-d h:i:s'),
          );

          $builder = $this->db->table('dbt_balance');
          $builder->insert($insertbalance);
          return $this->db->insertID();
    }
  }

  public function balanceLog($user = null)
  {
    return $batchdata = $this->db->table('dbt_balance_log as balancelog')
          ->select('*')
          ->join('dbt_cryptocoin as coin', 'coin.symbol = balancelog.currency_symbol', 'LEFT')
          ->where('balancelog.user_id', $user)
          ->orderBy('transaction_type', 'desc')
          ->get()
          ->getResult();
  }
  public function get_all_transactions($user = null, $limit = 0, $offset = 0)
  {
    return $batchdata = $this->db->table('dbt_balance_log as balancelog')
          ->select('*')
          ->join('dbt_cryptocoin as coin', 'coin.symbol = balancelog.currency_symbol', 'LEFT')
          ->where('balancelog.user_id', $user)
          ->orderBy('transaction_type', 'desc')
          ->limit($limit,$offset)
          ->get()
          ->getResult();
  }

  public function userTradeHistory($user_id = null)
  {
    return $this->db->table('dbt_biding bidmaster')
      ->select('bidmaster.*, biddetail.bid_type as bid_type1, biddetail.bid_price as bid_price1, biddetail.market_symbol as market_symbol1, biddetail.complete_amount as complete_amount1, biddetail.success_time as success_time1, biddetail.complete_qty, biddetail.complete_amount, biddetail.success_time')
      ->join('dbt_biding_log biddetail', 'biddetail.bid_id = bidmaster.id', 'left')
      ->where('bidmaster.user_id', $user_id)
      ->get()
      ->getResult();
  
  }

  public function coinpayment_withdraw()
  {
    $data = $this->db->table('payment_gateway')
          ->select('data')
          ->where('id',8)
          ->get()
          ->getRow();

    $data_tbl = json_decode($data->data,true);
    $withdraw = $data_tbl['withdraw'];

    return $withdraw;
  }

  public function catidBySlug($slug=NULL){

    return $this->db->table('web_category')
      ->select("cat_id")
      ->where('slug', $slug)
      ->where('status', 1)
      ->get()
      ->getRow();
  }

  public function cat_info($slug=NULL){
    return $this->db->table('web_category')
      ->select('*')
      ->where('slug', $slug)
      ->where('status', 1)
      ->get()
      ->getRow();
  }

  public function article($id=NULL, $limit=NULL){
    return $this->db->table("web_article")
      ->select('*')
      ->where('cat_id', $id)
      ->orderBy('position_serial', 'asc')
      ->limit($limit)
      ->get()
      ->getResult();
  }

  public function advertisement($id=NULL){
    return $this->db->table("advertisement")
      ->select('*')
      ->where('page', $id)
      ->where('status', 1)
      ->orderBy('serial_position', 'asc')
      ->get()
      ->getResult();
  }

  public function newsCatListBySlug($slug=NULL)
  {  
    $cat_id = $this->db->table('web_category')->select('cat_id')->where('slug', $slug)->get()->getRow();

    return $this->db->table('web_category')
      ->select('*')
      ->where('status', 1)
      ->orderBy('cat_id', 'desc')
      ->where('parent_id', $cat_id->cat_id)
      ->get()
      ->getResult();
  }

  public function availableForBuy($key)
  {
    $sum = $this->db->table('dbt_biding')
      ->select('SUM(bid_qty_available)')
      ->where('bid_type', 'BUY')
      ->where('market_symbol', $key)
      ->where('status', 2)
      ->get()
      ->getRow();
    return $sum;
  }

  public function availableForSell($key)
  {
    $sum = $this->db->table('dbt_biding')
      ->select('SUM(bid_qty_available)')
      ->where('bid_type', 'SELL')
      ->where('market_symbol', $key)
      ->where('status', 2)
      ->get()
      ->getRow();
    return $sum;
  }

  public function balanceDebit($data = array())
  {
    $check_user_balance = $this->db->table('dbt_balance')->select('*')->where('user_id', $data->user_id)->where('currency_symbol', $data->currency_symbol)->get()->getRow();

    $updatebalance = array(
            'balance'     => $check_user_balance->balance-($data->bid_qty+$data->fees_amount),
        );
    return $this->update('dbt_balance', $updatebalance, array('user_id' => $data->user_id, 'currency_symbol' => $data->currency_symbol));
  }


  public function balanceCredit($data = array(), $coin_symbol)
  {
    $check_user_balance = $this->db->table('dbt_balance')->select('*')->where('user_id', $data->user_id)->where('currency_symbol', $coin_symbol)->get()->getRow();

    $updatebalance = array(
            'balance'     => @$check_user_balance->balance-(@$data->total_amount+@$data->fees_amount),
        );

    return $this->update('dbt_balance', $updatebalance, array('user_id' => $data->user_id, 'currency_symbol' => $coin_symbol));
  }

  //Return Balance
  public function balanceReturn($data = array()){

    $balance = $this->db->table('dbt_balance')->select('*')->where('user_id', $data['user_id'])->where('currency_symbol',$data['currency_symbol'])->get()->getRow();

    $updatebalance = array(
            'balance'     => $balance->balance+$data['amount']+$data['return_fees'],
        );

        $this->update('dbt_balance', $updatebalance, array('user_id' => $data['user_id'], 'currency_symbol' => $data['currency_symbol']));
        
        $logdata = array(

          'balance_id'        => $balance->id,
          'user_id'           => $data['user_id'],
          'currency_symbol'   => $data['currency_symbol'],
          'transaction_type'  => 'ADJUSTMENT',
          'transaction_amount'=> $data['amount'],
          'transaction_fees'  => $data['return_fees'],
          'ip'                => $data['ip'],
          'date'              => date('Y-m-d H:i:s')
        );

        $this->save("dbt_balance_log",$logdata);
  }

  public function coinpayments_balanceAdd($data = array()){

        $check_user_balance = $this->db->table('dbt_balance')->select('*')->where('user_id', $data['user_id'])->where('currency_symbol', $data['currency_symbol'])->get()->getRow();
        
        if ($check_user_balance) {

            $updatebalance = array(
                'balance'     => $data['amount']+$check_user_balance->balance,
            );
            $this->db->table('dbt_balance')->set($updatebalance)->where('user_id', $data['user_id'])->where('currency_symbol', $data['currency_symbol'])->update();
            return  $check_user_balance->id;
        } else {

            $insertbalance = array(
                'user_id'         => $data['user_id'],
                'currency_id'     => 0,
                'currency_symbol' => $data['currency_symbol'],
                'balance'         => $data['amount'],
                'last_update'     => date('Y-m-d h:i:s'),
            );

            $builder = $this->db->table('dbt_balance');
            $builder->insert($insertbalance);
            return $this->db->insertID();
        }
  }

  public function autoLoadChat($user_id = null)
  {

    return $autoLoadChat = $this->db->table('dbt_chat')
          ->select('dbt_chat.message, dbt_chat.datetime, dbt_user.image')
          ->join('dbt_user', 'dbt_user.user_id = dbt_chat.user_id', 'LEFT')
          ->orderBy('datetime desc')
          ->limit(10,0)
          ->get()
          ->getResult();
  }

}