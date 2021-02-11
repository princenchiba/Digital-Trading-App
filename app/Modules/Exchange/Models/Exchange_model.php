<?php namespace App\Modules\Exchange\Models;

/*
  |----------------------------------------------
  |   Datatable Ajax data Pagination+Search
  |----------------------------------------------     
*/
class Exchange_model
{

	public function __construct()
  {
    $this->db = db_connect();
    $this->request = \Config\Services::request();
  }

  var $table = 'dbt_cryptocoin';
  var $column_order = array(null, 'cid', 'symbol', 'coin_name', 'full_name', 'algorithm', 'rank', 'show_home', 'coin_position'); //set column field database for datatable orderable
  var $column_search = array('cid', 'symbol', 'coin_name', 'full_name', 'algorithm', 'rank', 'show_home', 'coin_position'); //set column field database for datatable searchable 
  var $order = array('rank' => 'asc'); // default order 
 
 
  function get_datatables()
  { 
    $builder = $this->db->table('dbt_cryptocoin');
    
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
    $query = $this->db->table('dbt_cryptocoin');
    $this->get_datatables();
    return $query->countAllResults();
  }
}