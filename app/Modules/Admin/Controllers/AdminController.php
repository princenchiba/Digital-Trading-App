<?php namespace App\Modules\Admin\Controllers;

class AdminController extends BaseController
{
    public function index(){


        $page_number      = (!empty($this->request->getVar('page'))?$this->request->getVar('page'):1);
        $data['admin']    = $this->common_model->get_all('admin', array(), 'id','asc',20,($page_number-1)*20);
        $total            = $this->common_model->countRow('admin');
        $data['pager']    = $this->pager->makeLinks($page_number, 20, $total);

        $data['module'] = "Admin";
        $data['page']   = 'admin/list'; 
        return $this->template->layout($data);
    }

    public function form($id = null)
    { 
        
        $this->validation->setRule('firstname', display('firstname'),'required|max_length[50]');
        $this->validation->setRule('lastname', display('lastname'),'required|max_length[50]');
         $this->validation->setRule('image', display('image'), 'ext_in[image,png,jpg,gif,ico]|is_image[image]');

        if (!empty($id)) {   
            $this->validation->setRule('email', display('email'), "required|valid_email|max_length[100]");
           
        } else {
            $this->validation->setRule('email', display('email'),'required|valid_email|is_unique[admin.email]|max_length[100]');
           
        }
        $this->validation->setRule('about', display('about'),'max_length[1000]');
        $this->validation->setRule('status', display('status'),'required|max_length[1]');
        if($this->validation->withRequest($this->request)->run()){
            $image_path = $this->imageupload->upload_image($this->request->getFile('image'), 'upload/dashboard', $this->request->getPost('old_image'), 115, 90);

        } else {

            $image_path = "";
        }

        $existingData = $this->common_model->findById('admin', array('id' => $id));

        if(!empty($this->request->getPost('password'))){
            $newpassword = md5($this->request->getPost('password'));
        } else if(empty($existingData)){
            $this->validation->setRule('password', display('password'),'required|max_length[32]|md5');
            $newpassword = md5($this->request->getPost('password'));
        } else {
            $newpassword = $existingData->password;
        }
        
        $data['admin'] = (object)$adminLevelData = array(

            'firstname'   => $this->request->getPost('firstname', FILTER_SANITIZE_STRING),
            'lastname'    => $this->request->getPost('lastname', FILTER_SANITIZE_STRING),
            'email'       => $this->request->getPost('email', FILTER_SANITIZE_STRING),
            'password'    => $newpassword,
            'about'       => $this->request->getPost('about',FILTER_SANITIZE_STRING),
            'image'       => $image_path,
            'last_login'  => null,
            'last_logout' => null,
            'ip_address'  => null,
            'status'      => $this->request->getPost('status', FILTER_SANITIZE_STRING),
            'is_admin'    => 2
        );

        if($this->request->getMethod() == 'post'){
            $emailExists = $this->email_check($this->request->getPost('email'), $id);
            if($emailExists == 1){
              $this->session->setFlashdata("exception", "This E-mail Already Registered, Please Use Another E-mail!");
                return  redirect()->to(base_url('/admin/admin-list'));  
            }

            if ($this->validation->withRequest($this->request)->run()) 
            {
                
                if (empty($this->request->getPost('id'))) {
                    if ($this->common_model->save('admin', $adminLevelData)) {
                        $this->session->setFlashdata('message', display('save_successfully'));
                    } else {
                        $this->session->setFlashdata('exception', display('please_try_again'));
                    }
                   return  redirect()->to(base_url('/admin/add-admin'));
                } else {
                    if ($this->common_model->update('admin', $adminLevelData, array('id' => $id))) {
                        $this->session->setFlashdata('message', display('update_successfully'));
                    } else {
                        $this->session->setFlashdata('exception', display('please_try_again'));
                    }
                    return  redirect()->to(base_url('/admin/edit-admin/'.$id));
                }
            } else { 
                $this->session->setFlashdata("exception", $this->validation->listErrors());
                return  redirect()->to(base_url('/admin/add-admin'));
            }
        } else {

            if(!empty($id)) {
                $data['admin']   = $this->common_model->findById('admin', array('id' => $id));
            }

            $data['module'] = "Admin";
            $data['page']   = 'admin/form'; 
            return $this->template->layout($data);
        }
    }

    public function email_check($email, $id)
    { 
      
        $emailExists = $this->common_model->findById('admin', array('email'=>$email, 'id !=' => $id));
        if (!empty($emailExists)) {
            return 1;
        } else {
            return 0;
        }
    }

    public function phone_check($phone, $id)
    { 
      
        $emailExists = $this->common_model->findById('dbt_user', array('phone'=>$phone, 'id' => $id));
        if (!empty($emailExists)) {
            return false;
        } else {
            return true;
        }
    }

    /*
    |----------------------------------------------
    |        id genaretor
    |----------------------------------------------     
    */
    public function randomID($mode = 2, $len = 6)
    {
        $result = "";
        if($mode == 1):
            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        elseif($mode == 2):
            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        elseif($mode == 3):
            $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        elseif($mode == 4):
            $chars = "0123456789";
        endif;

        $charArray = str_split($chars);
        for($i = 0; $i < $len; $i++) {
                $randItem = array_rand($charArray);
                $result .="".$charArray[$randItem];
        }
        return $result;
    }

    public function delete($id = null)
    { 
       
        if ($this->common_model->delete('admin', array('id' => $id))){
            $this->session->setFlashdata('message', display('delete_successfully'));
        } else {
            $this->session->setFlashdata('exception', display('please_try_again'));
        }
        return redirect()->route('admin/admin-list');
    }
}
