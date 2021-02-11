<?php namespace App\Modules\Addon\Models;

class Module_model  {
        
    public function __construct()
    {
        $this->db = db_connect();
    }
	public function create($data = array())
	{
        $builder = $this->db->table('module');
		return $builder->insert($data);
	}

	public function read()
	{
		return $this->db->select('*')
			->from('module')
			->get()
			->result();
	}

	public function single($id = null)
	{
		return $this->db->select('*')
			->from('module')
			->where('id', $id)
			->get()
			->row();
	}

	public function update($data = array())
	{
		return $this->db->where('id', $data["id"])
			->update("module", $data);
	}

	public function delete($id = null)
	{
		$this->db->where('id', $id)
			->delete("module");
		$this->db->where('fk_module_id', $id)
			->delete("module_permission");
		return true;
	}

	public function delete_by_directory($directory = null)
	{
        $builder = $this->db->table('module');
		$row = $builder->select('id')->where('directory', $directory);
		if ($row->countAllResults() > 0) {
			$id = $builder->get()->getRow()->id;
			$builder->where('id', $id)
				->delete();
			return true;
		} else {
			return false;
		}
	}
 
	public function dropdown()
	{
		$data = $this->db->select('id,name')
			->from("module")
			->where('status', 1)
			->order_by('name','asc')
			->get()
			->result();
		$list = array();
		if (!empty($data)) {
			foreach($data as $value)
				$list[$value->id] = $value->name;
			return $list;
		} else {
			return false; 
		}
	}
 

}
