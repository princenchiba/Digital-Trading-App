<?php namespace App\Modules\Dashboard\Controllers;

class Permission extends BaseController
{

    //Permission form
    public function index()
    {

        $data['title']     = 'Create permission';
        $data['account']   = $this->permission_model->permission_list();
        $data['user_list'] = $this->permission_model->user_list();
        $data['module']    = "dashboard";
        $data['page']      = "permission/permission_form"; 
        return $this->template->layout($data); 
    }

    public function create()

    {

        $data['title'] = lan('add_role_permission');
        $data = array(
            'type' => $this->request->getVar('role_id'),
        );
        $insert_id    = $this->permission_model->insert_user_entry($data);
        $fk_module_id = $this->request->getVar('fk_module_id');
        $create       = $this->request->getVar('create');
        $read         = $this->request->getVar('read');
        $update       = $this->request->getVar('update');
        $delete       = $this->request->getVar('delete');


        $new_array = array();
        for ($m = 0; $m < sizeof($fk_module_id); $m++) {
            for ($i = 0; $i < sizeof($fk_module_id[$m]); $i++) {
                for ($j = 0; $j < sizeof($fk_module_id[$m][$i]); $j++) {
                    $dataStore = array(
                        'role_id' => $insert_id,
                        'fk_module_id' => $fk_module_id[$m][$i][$j],
                        'create' => (!empty($create[$m][$i][$j]) ? $create[$m][$i][$j] : 0),
                        'read' =>   (!empty($read[$m][$i][$j]) ? $read[$m][$i][$j] : 0),
                        'update' => (!empty($update[$m][$i][$j]) ? $update[$m][$i][$j] : 0),
                        'delete' => (!empty($delete[$m][$i][$j]) ? $delete[$m][$i][$j] : 0),
                    );
                    array_push($new_array, $dataStore);
                }
            }
        }

        /*-----------------------------------*/
            if ($this->permission_model->create($new_array)) {
                $id = $this->db->insertID();
                $this->session->setFlashdata('message', 'Successfully Saved');
            }
            else {
                $this->session->setFlashdata('exception', lan('please_try_again'));
            }
          
             return redirect()->route('role/add_role');
    }

    public function user_assign()
    {
        $data['title']     = 'User assign role';
        $data['user']      = $this->permission_model->user();
        $data['role_list'] = $this->permission_model->role_list();
        $data['module']    = "dashboard";
        $data['page']      = "permission/assign_form"; 
        return $this->template->layout($data);
    }

    public function assing_roleuser()
    {
        $data['title'] = lan('list_Role_setup');
        #-------------------------------#
          $rules = [
                'user_id'  => 'required|max_length[250]',
                'user_type' => 'required',
                
            ];

        $user_id     = $this->request->getVar('user_id');
        $roleid      = $this->request->getVar('user_type');
        $create_by   = session('id');
        $create_date = date('Y-m-d h:i:s');
        #-------------------------------#
        $data['role_data'] = (Object)$postData = array(
            'id'         => $this->request->getVar('id'),
            'user_id'    => $user_id,
            'roleid'     => $roleid,
            'createby'   => $create_by,
            'createdate' => $create_date
        );
        if (! $this->validate($rules)) {
        $data['validation']= $this->validator;
        $data['user']      = $this->permission_model->user();
        $data['role_list'] = $this->permission_model->role_list();
        $data['module']    = "dashboard";
        $data['page']      = "permission/assign_form"; 
        return $this->template->layout($data);
            }else{
          
                if ($this->permission_model->role_create($postData)) {
                    $this->session->setFlashdata('message', lan('successfully_inserted'));
                   
                } else {
          $this->session->setFlashdata('exception', lan('please_try_again'));

                }
               
                return redirect()->route('role/assign_role');

         

        } 
    }

    public function select_to_rol($id)
    {
           $role_reult =  $this->db->table('sec_userrole')
                    ->select("sec_role.*,sec_userrole.*")
                    ->join('sec_role', 'sec_userrole.roleid=sec_role.id')
                    ->where('sec_userrole.user_id', $id)
                    ->groupBy('sec_role.type')
                    ->get()
                    ->getResult();
        if ($role_reult) {
            $html = "";
            $html .= "<table id=\"dataTableExample2\" class=\"table table-bordered table-striped table-hover\">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Role_name</th>
                            </tr>
                        </thead>
                       <tbody>";
            $i = 1;
            foreach ($role_reult as $key => $role) {
                $html .= "<tr>
                                <td>$i</td>
                                <td>$role->type</td>
                            </tr>";
                $i++;
            }
            $html .= "</tbody>
                    </table>";
        }
        echo json_encode($html);
    }

    public function add_role()
    {
        $data['title']     = 'Create role name';
        $data['accounts']  = $this->permission_model->permission_list();
        $data['module']    = "dashboard";
        $data['page']      = "permission/role_form"; 
        return $this->template->layout($data);
    }


        public function role_list(){
        $data['title']      = 'Role List';
        $data['user_count'] = $this->permission_model->user_count();
        $data['user_list']  = $this->permission_model->role_list();
        $data['module']     = "dashboard";
        $data['page']       = "permission/role_view_form"; 
        return $this->template->layout($data);
    }
    public function insert_role_user(){
        $data = array(
            'type' => $this->request->getVar('type'),
        );

        $this->permission_model->insert_user_entry($data);
    }

 



    public function role_delete($id){
        $role=$this->permission_model->delete_role($id);
        $role_per=$this->permission_model->delete_role_permission($id);
             $data=array(
                 'role'     => $role,
                 'role_per' => $role_per
             );

        if($data){
            $this->session->setFlashdata(array('message' => lan('successfully_deleted')));
        }
        else{
            $this->session->setFlashdata('exception', lan('please_try_again'));
        }
        return redirect()->route('role/role_list');
    }
    public function edit_role($id){
        $data['title']         = 'Edit Role';
        $data['role']          = $this->permission_model->role($id);
        $data['modules']       = $this->permission_model->module();
        $data['role_detail']   = $this->permission_model->role_edit($id);
        $data['module']        = "dashboard";
        $data['page']          = "permission/editroleform"; 
        return $this->template->layout($data);
    }

    public function update(){
        $id = $this->request->getVar('rid');
        $data = array(
            'type' => $this->request->getVar('role_id'),
            'id'   => $this->request->getVar('rid'),
        );
        $this->permission_model->role_update($data,$id);
        $fk_module_id = $this->request->getVar('fk_module_id');
        $create       = $this->request->getVar('create');
        $read         = $this->request->getVar('read');
        $update       = $this->request->getVar('update');
        $delete       = $this->request->getVar('delete');


        $new_array = array();
        for ($m = 0; $m < sizeof($fk_module_id); $m++) {
            for ($i = 0; $i < sizeof($fk_module_id[$m]); $i++) {
                for ($j = 0; $j < sizeof($fk_module_id[$m][$i]); $j++) {
                    $dataStore = array(
                        'role_id' =>$this->request->getVar('rid'),
                        'fk_module_id' => $fk_module_id[$m][$i][$j],
                        'create' => (!empty($create[$m][$i][$j]) ? $create[$m][$i][$j] : 0),
                        'read'   =>   (!empty($read[$m][$i][$j]) ? $read[$m][$i][$j] : 0),
                        'update' => (!empty($update[$m][$i][$j]) ? $update[$m][$i][$j] : 0),
                        'delete' => (!empty($delete[$m][$i][$j]) ? $delete[$m][$i][$j] : 0),
                    );
                    array_push($new_array, $dataStore);
                }
            }
        }
        if($this->permission_model->create($new_array)){
            
            $this->session->setFlashdata('message', lan('successfully_updated'));
        }
        else{
            $this->session->setFlashdata('exception', lan('please_try_again'));
        }
        return redirect()->route('role/role_list');
    }
    public function module_form($id = null){
    if(!empty($id)){
    $data['title']      = 'Module Update';
    }else{
    $data['title']      = 'Add Module';}
    $data['moduleinfo'] = $this->permission_model->moduleinfo($id);
    $data['module']     = "dashboard";
    $data['page']       = "permission/add_module"; 
    return $this->template->layout($data);
    }

     public function add_module(){
    $data = [
   'id'          => $this->request->getVar('id'),
   'name'        => $this->request->getVar('module_name'),
   'description' => null,
   'image'       => null,
   'directory'   => null,
   'status'      => 1,
    ];
    if(!empty($this->request->getVar('id'))){
            $query = $this->db->table('module');   
            $query->where('id', $this->request->getVar('id'));
            $query->update($data); 

          $this->session->setFlashdata(array('message' => lan('successfully_updated')));

          return redirect()->route('role/add_module');
    }else{
        $this->permission_model->insert_module($data);

         $this->session->setFlashdata(array('message' => lan('successfully_inserted')));

         return redirect()->route('role/add_module');
    }

    }
    //Menu add 
    public function menu_form($id = null){
    if(!empty($id)){
    $data['title']       = 'Menu Update';
    }else{
    $data['title']       = 'Add Menu';}
    $data['module_list'] = $this->permission_model->module_list($id);
    $data['menuinfo']    = $this->permission_model->menuinfo($id);
    $data['module']      = "dashboard";
    $data['page']        = "permission/add_menu"; 
    return $this->template->layout($data);    
    }
    // menu submit info
    public function add_menu(){
     $data = [
   'id'          => $this->request->getVar('id'),
   'mid'         => $this->request->getVar('module_id'),
   'name'        => $this->request->getVar('menu_name'),
   'description' => null,
   'image'       => null,
   'directory'   => $this->request->getVar('menu_name'),
   'status'      => 1,
    ];
    if(!empty($this->request->getVar('id'))){
            $this->permission_model->update_menu($data);
          $this->session->setFlashdata(array('message' => lan('successfully_updated')));
           return redirect()->route('role/add_menu');
    }else{
         $this->permission_model->insert_menu($data);
         $this->session->setFlashdata(array('message' => lan('successfully_inserted')));
          return redirect()->route('role/add_menu');
    }   
    }
}