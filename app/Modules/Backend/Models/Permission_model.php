<?php namespace App\Modules\Backend\Models;

class Permission_model
{
    
     public function __construct()
    {
        $this->db = db_connect();
    }
	public function permission_list()
    {
         return $this->db->table('module')
                        ->select("*")
                        ->where('status', 1)
                        ->get()
                        ->getResultArray();
	}
    public function module_list2()
    {
          return $this->db->table('module')
                        ->select("*")
                        ->where('status', 1)
                        ->get()
                        ->getResult();
    }
    public function user_count()
    {
           $role_number = $this->db->table('sec_role')
                        ->select("count(id) as total_role")
                        ->get()
                        ->getRow();

       return   $role_number->total_role;
    }

	public function role_list()
    {
     return $this->db->table('sec_role')
                    ->select("*")
                    ->get()
                    ->getResultArray();
	}
    public function user()
    {
       return $this->db->table('user')
                    ->select("*")
                    ->get()
                    ->getResultArray();
    }
    public function create($data = array())
    {
	        $dexitrole = $this->db->table('role_permission');
            $dexitrole->where('role_id', $data[0]['role_id']);
            $dexitrole->delete();
            $role = $this->db->table('role_permission');
		return $role->insertBatch($data);
	}
    public function role_create($postData = array())
    {
        $add_role = $this->db->table('sec_userrole');
        return  $add_role->insert($postData);
    }
    public function insert_user_entry($data = array())
    {
       
        $role = $this->db->table('sec_role');
          $role->insert($data);
        return $insert_id = $this->db->insertID();
    }
    public function userdata_editdata($id)
    {
        return $this->db->table('sec_role')
                    ->select("*")
                    ->where('id',$id)
                    ->get()
                    ->getResultArray();
    }
    public function update_role($data,$id)
    {
             $query = $this->db->table('sec_role');   
             $query->where('id', $id);
             return $query->update($data); 
    }
    public function delete_role($id)
    {
            $dlt_role = $this->db->table('sec_role');
            $dlt_role->where('id', $id);
     return $dlt_role->delete();
    }
    public function delete_role_permission($id)
    {
            $dlt_permission = $this->db->table('role_permission');
            $dlt_permission->where('role_id', $id);
     return $dlt_permission->delete();
    }
    public function module()
    {
       return $this->db->table('module')
                    ->select("*")
                    ->get()
                    ->getResult();
    }
    public function role($id = null)
    {
             return $this->db->table('sec_role')
                    ->select("*")
                    ->where('id',$id)
                    ->get()
                    ->getResult();
    }
    public function role_edit($id = null)
    {
             return $this->db->table('role_permission')
                    ->select("role_permission.*,sub_module.name")
                    ->join('sub_module','sub_module.id=role_permission.fk_module_id')
                    ->where('role_permission.role_id',$id)
                    ->get()
                    ->getResult();
    }
    public function role_update($data,$id){
           $query = $this->db->table('sec_role');   
             $query->where('id', $id);
             return $query->update($data);
    }
    public function moduleinfo($id)
    {
   return $this->db->table('module')
                    ->select("*")
                    ->where('id',$id)
                    ->where('status',1)
                    ->get()
                    ->getRow();
    }
    //module list
    public function module_list()
    {
      return $this->db->table('module')
                    ->select("*")
                    ->get()
                    ->getResult();
    }
    // menu info id wise
    public function menuinfo($id)
    {
         return $this->db->table('sub_module')
                    ->select("*")
                    ->where('id',$id)
                    ->where('status',1)
                    ->get()
                    ->getRow();
    }

      public function insert_module($data = array())
    {
       
        $module = $this->db->table('module');
         return $module->insert($data);
        
    }

      public function update_menu($data)
    {
             $query = $this->db->table('sub_module');   
             $query->where('id', $data['id']);
             return $query->update($data); 
    }

      public function insert_menu($data = array())
    {
       
        $module = $this->db->table('sub_module');
         return $module->insert($data);
        
    }

}