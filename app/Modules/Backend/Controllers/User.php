<?php namespace App\Modules\Dashboard\Controllers;
class User extends BaseController
{

    public function index()
    {
       if (!$this->session->get('isLogIn')){
        return redirect()->route('login');
    }

    $data['title']      = 'home';
    $data['module']     = "dashboard";
    $data['user']       = $this->userModel->findAll();
    $data['page']       = "user/user_list"; 
    return $this->template->layout($data);

}

public function add_user($id = null){
    $id = (!empty($id)?$id:$this->request->getVar('id'));
    $data = [];
    helper(['form','url']);
    $newName = '';
    if($img = $this->request->getFile('image'))
    {
        if ($img->isValid() && ! $img->hasMoved())
        {
            $newName = $img->getRandomName();
            $img->move('./assets/dist/img/user', $newName);

        }
    }
    $image_path = './assets/dist/img/user/'. ($newName?$newName:'');
    $old_image = $this->request->getVar('old_image');
    $old_password = $this->request->getVar('old_password');
    $data['user'] = (object)$userLevelData = array(
        'id'          => $this->request->getVar('id'),
        'firstname'   => $this->request->getVar('firstname'),
        'lastname'    => $this->request->getVar('lastname'),
        'email'       => $this->request->getVar('email'),
        'password'    => (!empty($this->request->getVar('password'))?md5($this->request->getVar('password')):$old_password),
        'about'       => $this->request->getVar('about'),
        'image'       => (!empty($newName)?$image_path:$old_image),
        'last_login'  => null,
        'last_logout' => null,
        'ip_address'  => null,
        'status'      => $this->request->getVar('status'),
        'is_admin'    => $this->request->getVar('is_admin')
    );

    if ($this->request->getMethod() == 'post') {
            //let's do the validation here
        if(empty($id)){
            $rules = [
                'firstname' => 'required|min_length[2]|max_length[20]',
                'lastname'  => 'required|min_length[3]|max_length[20]',
                'email'     => 'required|min_length[6]|max_length[50]|valid_email|is_unique[user.email]',
                'password' => 'required|min_length[8]|max_length[255]',

                
            ];
        }else{
           $rules = [
            'firstname' => 'required|min_length[2]|max_length[20]',
            'lastname'  => 'required|min_length[3]|max_length[20]',
            'email'     => 'required|min_length[6]|max_length[50]|valid_email',


        ];
    }

    if (! $this->validate($rules)) {
        $data['validation'] = $this->validator;
    }else{
     if(empty($id)){
        $this->userModel->save_user($userLevelData);
        $this->session->setFlashdata('message', 'Successful Save');
        return redirect()->route('user/user_list');

    }else{
       $this->userModel->update_user($userLevelData);
       $this->session->setFlashdata('message', 'Successful Updated');
       return redirect()->route('user/user_list');

   }

}
}

$data['module']     = "dashboard";
if(!empty($id)){
    $data['user']       = $this->userModel->singledata($id);
}
$data['page']       = "user/add_user"; 
return $this->template->layout($data);
}


public function delete_user($id = null)
{ 
    if ($this->userModel->delete_user($id)) {
        $this->session->setFlashdata('message', lan('successfully_deleted'));
    } else {
        $this->session->setFlashdata('exception', lan('please_try_again'));
    }

    return redirect()->route('user/user_list');
}

}
