<?php namespace App\Modules\Backend\Models;

class UserModel
{
	
	 public function __construct()
    {
        $this->db = db_connect();
    }

    public function findAll(int $limit = 12, int $offset = 0)
    {
        $builder = $this->db->table('user');
		$builder->select("*,CONCAT_WS(' ',firstname, lastname) AS fullname");
		
        $builder->limit($limit, $offset);
         $query   = $builder->get(); 
		return $query->getResult();

      
    }

    public function singledata($id){
        $builder = $this->db->table('user')
                             ->where('id', $id)
                             ->get()
                             ->getRow(); 
		return $builder;


    }

    public function save_user($data=[]){
        $builder = $this->db->table('user');
        return  $builder->insert($data);
    }

    public function update_user($data=[]){
     $query = $this->db->table('user');   
     $query->where('id', $data['id']);
     return $query->update($data);   
    }

    public function delete_user($id){
            $builder = $this->db->table('user');
            $builder->where('id', $id);
     return $builder->delete();
    }

   
}