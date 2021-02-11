<?php namespace App\Modules\User\Models;

class User_model
{
	
	public function __construct()
  {
    $this->db = db_connect();
    $this->request = \Config\Services::request();
  }

  var $table = 'dbt_user';
  var $column_order = array(null, 'user_id','first_name','last_name','username','email','phone','referral_id','language','country','city','address','ip'); //set column field database for datatable orderable
  var $column_search = array('user_id','first_name','last_name','username','email','phone','referral_id','language','country','city','address','ip'); //set column field database for datatable searchable 
  var $order = array('id' => 'desc'); // default order 

  function get_datatables()
  { 
    
    $builder = $this->db->table('dbt_user');
    
    $i = 0;
    foreach ($this->column_search as $item) // loop column 
    {

      if($_POST['search']['value']) // if datatable send POST for search
      {


        if($i===0) // first loop
        {
          $builder->groupStart(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
          $builder->like($item, $_POST['search']['value']);
        }
        else
        {
          $builder->orLike($item, $_POST['search']['value']);
        }

        if(count($this->column_search) - 1 == $i) //last loop
          $builder->groupEnd(); //close bracket
        }
        $i++;
      }

    if(isset($_POST['order'])) // here order processing
    {
      $builder->orderBy($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    } 
    else if(isset($this->order))
    {
      $order = $this->order;
      $builder->orderBy(key($order), $order[key($order)]);
    }
    if($this->request->getvar('length') != -1)
      $builder->limit($this->request->getvar('length'), $this->request->getvar('start'));
    $query = $builder->get();
    return $query->getResult();
  }

  function count_filtered()
  {
    $query = $this->db->table('dbt_user');
    $this->get_datatables();
    return $query->countAllResults();
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

  public function checkUserAllBalance($user_id = null)
  {
    return $this->db->table('dbt_balance balance')
    ->select('*')
    ->join('dbt_cryptocoin coin', 'coin.symbol = balance.currency_symbol', 'left')
    ->where('balance.user_id', $user_id)
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

  public function userBalanceLog($user_id = null)
  {
    return $this->db->table('dbt_balance_log balancelog')
    ->select('*')
    ->join('dbt_cryptocoin coin', 'balancelog.currency_symbol = coin.symbol')
    ->where('user_id', $user_id)
    ->orderBy('transaction_type', 'desc')
    ->get()
    ->getResult();
  }

  function ajax_trade_fetch_details($limit, $start, $user_id)
  {
    $output = '';
    $query = $this->db->table('dbt_biding bidmaster')
    ->select('bidmaster.*, biddetail.bid_type as bid_type1, biddetail.bid_price as bid_price1, biddetail.market_symbol as market_symbol1, biddetail.complete_amount as complete_amount1, biddetail.success_time as success_time1, biddetail.complete_qty, biddetail.complete_amount, biddetail.success_time')
    ->join('dbt_biding_log biddetail', 'biddetail.bid_id = bidmaster.id', 'left')
    ->where('bidmaster.user_id', $user_id)
    ->limit($limit, $start)
    ->get();
    $output .= '
    <table id="example" class="table table-bordered table-striped">
    <tr>
    <th>Trade</th>
    <th>Rate</th>
    <th>Required QTY</th>
    <th>Available QTY</th>
    <th>Required Amount</th>
    <th>Available Amount</th>
    <th>Market</th>
    <th>Open</th>
    <th>Complete QTY</th>
    <th>Complete Amount</th>
    <th>Trade Time</th>
    <th>Status</th>
    </tr>
    ';

    foreach($query->getResult() as $row)
    {
      $status = $row->status==0?"<p class='label-warning text-white text-center'>Canceled</p>":($row->status==1?"<p class='label-success text-white text-center'>Completed</p>":"<p class='label-primary text-white text-center'>Running</p>");

      $output .= "<tr>
      <td>".$row->bid_type."</td>
      <td>".$row->bid_price."</td>
      <td>".$row->bid_qty."</td>
      <td>".$row->bid_qty_available."</td>
      <td>".$row->total_amount."</td>
      <td>".$row->amount_available."</td>
      <td>".$row->market_symbol."</td>
      <td>".$row->open_order."</td>
      <td>".$row->complete_qty."</td>
      <td>".$row->complete_amount."</td>
      <td>".$row->success_time."</td>
      <td class='d-flex'>".$status."</td>
      </tr>";
    }
    $output .= '</table>';
    return $output;
  }
}