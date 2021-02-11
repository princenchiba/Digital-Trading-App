<?php namespace App\Modules\User\Controllers;

class UserController extends BaseController
{
    
    public function index(){


        $page_number      = (!empty($this->request->getVar('page'))?$this->request->getVar('page'):1);
        $data['deposit']  = $this->common_model->get_all('dbt_deposit', array(), 'id','desc',20,($page_number-1)*20);
        $total            = $this->common_model->countRow('dbt_deposit');
        $data['pager']    = $this->pager->makeLinks($page_number, 20, $total);

        $data['module'] = "User";
        $data['page']   = 'user/list'; 
        return $this->template->layout($data);
    }

    public function ajax_list(){
        $list = $this->user_model->get_datatables();
    
        $data = array();
        $no = $this->request->getvar('start');
        foreach ($list as $users) {
          $no++;
          $row = array();
            $row[] = $no;
            $row[] = '<a href="'.base_url("admin/user/user-details/$users->id").'">'.$users->user_id.'</a>';
            $row[] = '<a href="'.base_url("admin/user/user-details/$users->id").'">'.$users->first_name." ".$users->last_name.'</a>';
            $row[] = '<a href="'.base_url("admin/user/user-details/$users->id").'">'.$users->referral_id.'</a>';
            $row[] = $users->email;
            $row[] = $users->phone;
            $row[] = '<a href="'.base_url("admin/user/edit-user/$users->id").'"'.' class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="hvr-buzz-out far fa-edit"></i></a>  '.(($users->status==1)?'<button class="btn btn-success btn-sm">Active</button>':(($users->status==2)?'<button class="btn btn-danger btn-sm">Pending</button>':(($users->status==3)?'<button class="btn btn-danger btn-sm">Suspend</button>':'<button class="btn btn-warning btn-sm">Deactive</button>'))).'  '.(($users->verified==1)?'<button class="btn btn-success btn-sm">verified</button>':(($users->verified==2)?'<button class="btn btn-danger btn-sm">Cancel</button>':(($users->verified==3)?'<a href='.base_url("admin/user/pending-user-verification/$users->user_id").' class="btn btn-info btn-sm" data-toggle="tooltip">Requested</a>':'<button class="btn btn-danger btn-sm">Not Verified</button>')));
            $data[] = $row;
        }

        $output = array(
            "draw"            => intval($this->request->getvar('draw')),
            "recordsTotal"    => $this->common_model->countRow('dbt_user', array()),
            "recordsFiltered" => $this->user_model->count_filtered(),
            "data"            => $data,
          );
        //output to json format
        echo json_encode($output);
    }

    public function pending_user_verification_list(){

        $page_number      = (!empty($this->request->getVar('page'))?$this->request->getVar('page'):1);
        $data['users']    = $this->common_model->get_all('dbt_user', array('verified' => 3), 'id','asc',20,($page_number-1)*20);
        $total            = $this->common_model->countRow('dbt_user');
        $data['pager']    = $this->pager->makeLinks($page_number, 20, $total);

        $data['module'] = "User";
        $data['page']   = 'user/pending_user_verification_list'; 
        return $this->template->layout($data);
    }

    public function subscriber_list(){

        $page_number        = (!empty($this->request->getVar('page'))?$this->request->getVar('page'):1);
        $data['subscriber'] = $this->common_model->get_all('web_subscriber', array(), '','',20,($page_number-1)*20);
        $total              = $this->common_model->countRow('web_subscriber');
        $data['pager']      = $this->pager->makeLinks($page_number, 20, $total);

        $data['module'] = "User";
        $data['page']   = 'user/subscribelist'; 
        return $this->template->layout($data);
    }

    public function pending_user_verification($user_id = null)
    {
        $data['title']  = "Pending User verify";
        $data['user']   = $this->user_model->singleUserVerifyDoc($user_id);

        $rules = array('user_id' =>'required|trim',);

        if ($this->validate($rules, $rules)) 
        {

            if (isset($_POST['cancel'])) {
                
                $c_data = (object)$cdata = array('verified' => 2);
                $update_verify = $this->common_model->update('dbt_user', $c_data, array('user_id' => $this->request->getPost('user_id')));

                if ($update_verify) {

                    $this->session->setFlashdata('message', display('save_successfully'));
                    return  redirect()->to(base_url('/admin/user/pending-user-verification/'.$user_id));

                } else {

                    $this->session->setFlashdata('exception', display('please_try_again'));
                    return  redirect()->to(base_url('/admin/user/pending-user-verification/'.$user_id));

                }
            }

            if (isset($_POST['approve'])) {
                
                $c_data = (object)$cdata = array('verified' => 1);
                $update_verify = $this->common_model->update('dbt_user', $c_data, array('user_id' => $this->request->getPost('user_id')));

                if ($update_verify) {

                    $this->session->setFlashdata('message', display('save_successfully'));
                    return  redirect()->to(base_url('/admin/user/pending-user-verification/'.$user_id));

                } else {

                    $this->session->setFlashdata('exception', display('please_try_again'));
                    return  redirect()->to(base_url('/admin/user/pending-user-verification/'.$user_id));

                }
            }
        }

        $data['module'] = "User";
        $data['page']   = 'user/pending_user_verification'; 
        return $this->template->layout($data);
    }

    public function form($id = null)
    { 

        $this->validation->setRule('first_name', display('firstname'),'required|max_length[50]');        

        if (!empty($id)) {   
            $this->validation->setRule('email', display('email'), "required|valid_email|max_length[100]|trim"); 
            $this->validation->setRule('mobile', display('mobile'),"required|max_length[100]");
        } else {
            $this->validation->setRule('email', display('email'),'required|valid_email|is_unique[dbt_user.email]|max_length[100]');
            $this->validation->setRule('mobile', display('mobile'),'required|is_unique[dbt_user.phone]|max_length[100]');
        }
        $this->validation->setRule('status', display('status'),'required|max_length[1]');

        $existingData = $this->common_model->findById('dbt_user', array('id' => $id));

        if(!empty($this->request->getPost('password',FILTER_SANITIZE_STRING))){
            $this->validation->setRule('password', display('password'),'required|min_length[6]|max_length[32]|md5');
            $this->validation->setRule('conf_password', display('conf_password'),'required|min_length[6]|max_length[32]|md5|matches[password]');
            $newpassword = md5($this->request->getPost('password',FILTER_SANITIZE_STRING));
        } else if(empty($existingData)){
            $this->validation->setRule('password', display('password'),'required|min_length[6]|max_length[32]|md5');
            $this->validation->setRule('conf_password', display('conf_password'),'required|min_length[6]|max_length[32]|md5|matches[password]');
            $newpassword = md5($this->request->getPost('password',FILTER_SANITIZE_STRING));
        } else {
            $newpassword = $existingData->password;
        }

        if (empty($id))
        { 
            $data['user'] = (object)$userdata = array(
                'id'          => $this->request->getPost('id', FILTER_SANITIZE_STRING),
                'user_id'     => $this->randomID(),
                'referral_id' => $this->request->getPost('referral_id', FILTER_SANITIZE_STRING),
                'first_name'  => $this->request->getPost('first_name', FILTER_SANITIZE_STRING),
                'last_name'   => $this->request->getPost('last_name', FILTER_SANITIZE_STRING),
                'email'       => $this->request->getPost('email', FILTER_SANITIZE_STRING),
                'password'    => $newpassword,
                'phone'       => $this->request->getPost('mobile', FILTER_SANITIZE_STRING),
                'ip'          => $this->request->getipAddress(),
                'status'      => $this->request->getPost('status', FILTER_SANITIZE_STRING),
                'created_date'=> date("Y-m-d H:i:s"),
            );
        } else {
            $data['user'] = (object)$userdata = array(
                'id'          => $this->request->getPost('id', FILTER_SANITIZE_STRING),
                'user_id'     => $this->request->getPost('user_id', FILTER_SANITIZE_STRING),
                'first_name'  => $this->request->getPost('first_name', FILTER_SANITIZE_STRING),
                'last_name'   => $this->request->getPost('last_name', FILTER_SANITIZE_STRING),
                'email'       => $this->request->getPost('email', FILTER_SANITIZE_STRING),
                'password'    => $newpassword,
                'phone'       => $this->request->getPost('mobile', FILTER_SANITIZE_STRING),
                'ip'          => $this->request->getipAddress(),
                'status'      => $this->request->getPost('status', FILTER_SANITIZE_STRING),
            );
        }

        if($this->request->getMethod() == 'post'){

            $existemail = $this->email_check($this->request->getPost('email'), $id);
            $existphone = $this->phone_check($this->request->getPost('mobile'), $id);

            if($existemail == 0){
                $this->session->setFlashdata('exception',"This Email Already Registered, Please Use Another E-mail!");
                return redirect()->route('admin/user/user-list');
            }

            if($existphone == 0){
                $this->session->setFlashdata('exception',"This Mobile Number Already Registered, Please Use Another Mobile Number!");
                return redirect()->route('admin/user/user-list');
            }

            if ($this->validation->withRequest($this->request)->run()) 
            {

                if (empty($id)) 
                {
                    if ($this->common_model->save('dbt_user', $userdata)) {
                        $this->session->setFlashdata('message', display('save_successfully'));
                    } else {
                        $this->session->setFlashdata('exception', display('please_try_again'));
                    }
                    return redirect()->route('admin/user/user-list');
                } else {
                    if ($this->common_model->update('dbt_user',$userdata, array('id' => $id))) {
                        $this->session->setFlashdata('message', display('update_successfully'));
                    } else {
                        $this->session->setFlashdata('exception', display('please_try_again'));
                    }
                    return redirect()->route('admin/user/user-list');
                }

            } else { 
                $this->session->setFlashdata("exception", $this->validation->listErrors());

                if(!empty($id)){

                    return redirect()->to(base_url('admin/user/edit-user/'.$id));

                } else {

                    return redirect()->route('admin/user/user-list');
                }
               
            }
        } else {

            if(!empty($id)) {
                $data['title'] = display('edit_user');
                $data['user']   = $this->common_model->findById('dbt_user', array('id' => $id));
            }

            $data['module'] = "User";
            $data['page']   = 'user/form'; 
            return $this->template->layout($data);
        }
    }

    public function email_check($email, $id)
    { 
      
        $emailExists = $this->common_model->findById('dbt_user', array('email'=>$email, 'id !=' => $id));
        if (!empty($emailExists)) {
            return false;
        } else {
            return true;
        }
    }

    public function phone_check($phone, $id)
    { 
      
        $phoneExist = $this->common_model->findById('dbt_user', array('phone'=>$phone, 'id !=' => $id));
        if (!empty($phoneExist)) {
            return false;
        } else {
            return true;
        }
    }

    public function user_details($id = null)
    { 
      
        if(!empty($id)) {
            $data['user']    = $this->common_model->findById('dbt_user',array('id' => $id));
            $data['balance'] = $this->user_model->checkUserAllBalance($data['user']->user_id);

            $data['user_trade_history'] = $this->user_model->userTradeHistory($data['user']->user_id);
            $data['user_balanceLog']    = $this->user_model->userBalanceLog($data['user']->user_id);
        } else {
            $user_id = $this->request->getPost('user_id');

            $data['user']            = $this->common_model->findById('dbt_user', array('user_id' => $user_id));
            $data['balance']         = $this->user_model->checkUserAllBalance($user_id);
            $data['user_balanceLog'] = $this->user_model->userBalanceLog($user_id);
        }

        $data['module'] = "User";
        $data['page']   = 'user/search_user'; 
        return $this->template->layout($data);
    }


    function ajax_tradelist()
    {
        $uri = current_url(true);
        $segemt = $uri->getSegments();
        $user_id = $this->request->uri->setSilent()->getSegment(4);

        $total_rows = $this->db->table('dbt_biding bidmaster')
            ->select('bidmaster.*, biddetail.bid_type as bid_type1, biddetail.bid_price as bid_price1, biddetail.market_symbol as market_symbol1, biddetail.complete_amount as complete_amount1, biddetail.success_time as success_time1, biddetail.complete_qty, biddetail.complete_amount, biddetail.success_time')
            ->join('dbt_biding_log biddetail', 'biddetail.bid_id = bidmaster.id', 'left')
            ->where('bidmaster.user_id', $user_id)
            ->get()
            ->getResult();

        $page_number      = (!empty($this->request->getVar('page'))?$this->request->getVar('page'):1);
        $total            = count($total_rows);
        $data['pager']    = $this->pager->makeLinks($page_number, 50, $total);

        $output = array(
            'pagination_link' => $data['pager'],
            'country_table'   => $this->user_model->ajax_trade_fetch_details(50, $page_number, $user_id)
        );
        echo json_encode($output);
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
}
