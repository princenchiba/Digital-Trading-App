<?php namespace App\Modules\Settings\Controllers;

class SettingController extends BaseController
{
    //check setting table row if not exists then insert a row
    public function check_setting()
    {
        if ($this->common_model->countRow('setting', array()) == 0) {
            $this->db->insert('setting',[
                'title'         => 'bdtask Treading System',
                'description'   => '123/A, Street, State-12345, Demo',
                'time_zone'     => 'Asia/Dhaka',
                'footer_text'   => '2018&copy;Copyright',
            ]);
        }
    }
  
    public function index(){


        $this->check_setting();
        #-------------validation start------------------#
        $this->validation->setRule('title',display('website_title'),'required|max_length[50]');
        $this->validation->setRule('description', display('address') ,'max_length[255]');
        $this->validation->setRule('email',display('email'),'max_length[100]|valid_email');
        $this->validation->setRule('phone',display('phone'),'max_length[20]');
        $this->validation->setRule('language',display('language'),'max_length[250]'); 
        $this->validation->setRule('footer_text',display('footer_text'),'max_length[255]'); 
        $this->validation->setRule('time_zone',display('time_zone'),'required|max_length[100]'); 
        #-------------validation end------------------#
        $this->validation->setRule('favicon', "Favicon", "ext_in[favicon,png,jpg,gif,ico]|is_image[favicon]");
        $this->validation->setRule('logo', display('dashboard_logo'), "ext_in[logo,png,jpg,gif,ico]|is_image[logo]");
        $this->validation->setRule('logo_web', display('dashboard_logo'), "ext_in[logo_web,png,jpg,gif,ico]|is_image[logo_web]");
      

        if($this->validation->withRequest($this->request)->run()){

            $logo_image_path = $this->imageupload->upload_image($this->request->getFile('logo'), 'upload/settings/', $this->request->getPost('old_logo'), 155, 50);

        } else {

            $logo_image_path = "";
        }
        if($this->validation->withRequest($this->request)->run()){

            $favicon_image_path = $this->imageupload->upload_image($this->request->getFile('favicon'), 'upload/settings/', $this->request->getPost('old_favicon'), 35, 35);

        } else {

            $favicon_image_path = "";
        }
        if($this->validation->withRequest($this->request)->run()){

            $logo_web_image_path = $this->imageupload->upload_image($this->request->getFile('logo_web'), 'upload/settings/', $this->request->getPost('old_web_logo'), 155, 50);

        } else {

            $logo_web_image_path = "";
        }

        $data['setting'] = (object)$postData = [
            
            'setting_id'  => $this->request->getPost('setting_id', FILTER_SANITIZE_STRING),
            'title'       => $this->request->getPost('title', FILTER_SANITIZE_STRING),
            'description' => $this->request->getPost('description', FILTER_SANITIZE_STRING),
            'email'       => $this->request->getPost('email', FILTER_SANITIZE_STRING),
            'phone'       => $this->request->getPost('phone', FILTER_SANITIZE_STRING),
            'logo'        => $logo_image_path,
            'logo_web'    => $logo_web_image_path,
            'favicon'     => $favicon_image_path,
            'language'    => $this->request->getPost('language', FILTER_SANITIZE_STRING), 
            'time_zone'   => $this->request->getPost('time_zone', FILTER_SANITIZE_STRING), 
            'site_align'  => $this->request->getPost('site_align', FILTER_SANITIZE_STRING), 
            'office_time' => $this->request->getPost('office_time', FILTER_SANITIZE_STRING), 
            'latitude'    => $this->request->getPost('latitude', FILTER_SANITIZE_STRING), 
            'footer_text' => $this->request->getPost('footer_text', FILTER_SANITIZE_STRING),
        ]; 

        if($this->request->getMethod() == 'post'){

            //From Validation Check
            if ($this->validation->withRequest($this->request)->run()) {

                if (empty($postData['setting_id'])) 
                {
                    if ($this->common_model->save('setting', $postData)) {
                        $this->session->setFlashdata('message', display('save_successfully'));

                    } else {
                        $this->session->setFlashdata('exception', display('please_try_again'));

                    }
                    return  redirect()->to(base_url('/admin/setting/app-setting'));

                } else {

                    if ($this->common_model->update('setting', $postData, array('setting_id' => $postData['setting_id']))) {
                        $this->session->setFlashdata('message', display('update_successfully'));

                    } else {
                        $this->session->setFlashdata('exception', display('please_try_again'));
                    }

                   return  redirect()->to(base_url('/admin/setting/app-setting'));

                }

            } else { 

                $this->session->setFlashdata("exception", $this->validation->listErrors());
                return  redirect()->to(base_url('/admin/setting/app-setting'));
            }

        } else {

            $data['languageList'] = $this->languageList(); 
            $data['setting']      = $this->common_model->findById('setting', array());

            $data['module'] = "Settings";
            $data['page']   = 'settings/setting'; 
            return $this->template->layout($data);
        }
    }

    public function languageList()
    { 
        if ($this->db->tableExists("language")) { 

            $fields = $this->db->getFielddata("language");
            $i = 1;
            foreach ($fields as $field)
            {  
                if ($i++ > 2)
                $result[$field->name] = ucfirst($field->name);
            }

            if (!empty($result)) return $result;
        } else {

            return false;
        }
    }


    public function security(){

        $data['title'] = display('application_setting');
        $this->check_setting();
        #-------------validation start------------------#
        $this->validation->setRule('site_key','Site Key','required|trim');
        $this->validation->setRule('secret_key','Secret Key','required|trim'); 
        #-------------validation end------------------#

        if($this->request->getMethod() == 'post'){

            //From Validation Check
            if ($this->validation->withRequest($this->request)->run()) {

                $site_key        = $this->request->getPost('site_key', FILTER_SANITIZE_STRING);
                $secret_key      = $this->request->getPost('secret_key', FILTER_SANITIZE_STRING);
                $capture_status  = $this->request->getPost('capture_status', FILTER_SANITIZE_STRING)==1?1:0;
                $capture_data = array(

                    'site_key'  =>$site_key,
                    'secret_key'=>$secret_key,
                );
                $capture_data = json_encode($capture_data);

                $this->common_model->update('dbt_security', array('status' => $capture_status), array('keyword' => 'capture'));

                $this->session->setFlashdata('message','Update Successfully!');
                return redirect()->route('admin/setting/security');

            } else { 

                $this->session->setFlashdata("exception", $this->validation->listErrors());
                return redirect()->route('admin/setting/security');
            }

        } else {

            $data['security']     = $this->db->table('dbt_security')->select('*')->get()->getResult();
            $data['url']          = "http://".$_SERVER["HTTP_HOST"].str_replace(basename($_SERVER["SCRIPT_NAME"]), "", $_SERVER["SCRIPT_NAME"]);
            $data['languageList'] = $this->languageList(); 
            $data['setting']      = $this->common_model->findById('setting', array());

            $data['module'] = "Settings";
            $data['page']   = 'settings/security'; 
            return $this->template->layout($data);
        }
    }


    public function blocklist(){


        $page_number      = (!empty($this->request->getVar('page'))?$this->request->getVar('page'):1);
        //findAll paramiter = where, limit, offset.
        $data['blocklist']  = $this->common_model->get_all('dbt_blocklist', array(),'id', 'desc', 20,($page_number-1)*20);
        $total            = $this->common_model->countRow('dbt_blocklist', array());
        $data['pager']    = $this->pager->makeLinks($page_number, 20, $total);


        $data['module'] = "Settings";
        $data['page']   = 'settings/blocklist'; 
        return $this->template->layout($data);
    }

    public function delete_block($id = null)
    { 
       
        if ($this->common_model->delete('dbt_blocklist', array('id' => $id))){
            $this->session->setFlashdata('message', display('delete_successfully'));
        } else {
            $this->session->setFlashdata('exception', display('please_try_again'));
        }
        return redirect()->route('admin/setting/block-list');
    }

    public function fees_settig(){

        $data['coins']     = $this->common_model->findAll('dbt_cryptocoin', array('status' => 1), 'rank', 'asc', 100, 0);
        $page_number      = (!empty($this->request->getVar('page'))?$this->request->getVar('page'):1);
        //findAll paramiter = where, limit, offset.
        $data['fees_data'] = $this->common_model->get_all('dbt_fees', array(),'id', 'desc', 20,($page_number-1)*20);
        $total             = $this->common_model->countRow('dbt_fees', array());
        $data['pager']     = $this->pager->makeLinks($page_number, 20, $total);

        $data['module'] = "Settings";
        $data['page']   = 'settings/fees_setting'; 
        return $this->template->layout($data);
    }

    public function fees_setting_save()
    {

        $this->validation->setRule('coin_id', "Coin Name",'required|trim|max_length[20]');
        $this->validation->setRule('level', "Level",'required|trim|max_length[20]');
        $this->validation->setRule('fees', "Fees Pecentage",'required|trim|max_length[20]');

        if ($this->validation->withRequest($this->request)->run()) {
      
            $check = $this->common_model->findById('dbt_fees', array('level' => $this->request->getPost('level'), 'currency_symbol' => $this->request->getPost('coin_id')));

            if(!empty($check)){
                $this->session->setFlashdata('exception', display('this_level_already_exist'));
                return redirect()->route('admin/setting/fees-setting');
            } else {
                $fees = array(
                    'level'=>$this->request->getPost('level', FILTER_SANITIZE_STRING),
                    'fees'=>$this->request->getPost('fees', FILTER_SANITIZE_STRING),
                    'currency_symbol'=>$this->request->getPost('coin_id', FILTER_SANITIZE_STRING),
                    'status'=>1,
                );
                $this->common_model->save('dbt_fees',$fees);
                $this->session->setFlashdata('message',display('fees_setting_successfully'));
                return redirect()->route('admin/setting/fees-setting');
            }
        } else {

            $this->session->setFlashdata("exception", $this->validation->listErrors());
            return redirect()->route('admin/setting/fees-setting');
        }
    }

    public function delete_fees_setting($id = null)
    { 
       
        if ($this->common_model->delete('dbt_fees', array('id' => $id))){
            $this->session->setFlashdata('message', display('delete_successfully'));
        } else {
            $this->session->setFlashdata('exception', display('please_try_again'));
        }
        return redirect()->route('admin/setting/fees-setting');
    }

    public function transaction_setup(){

        $page_number       = (!empty($this->request->getVar('page'))?$this->request->getVar('page'):1);
        $data['transaction_setup'] = $this->common_model->get_all('dbt_transaction_setup', array(),'id', 'asc', 25,($page_number-1)*25);
        $total             = $this->common_model->countRow('dbt_transaction_setup', array());
        $data['pager']     = $this->pager->makeLinks($page_number, 25, $total);
        $data['coins']     = $this->common_model->findAll('dbt_cryptocoin', array('status' => 1), 'rank', 'asc');

        $data['module'] = "Settings";
        $data['page']   = 'settings/transaction_setup'; 
        return $this->template->layout($data);
    }

    public function transaction_save()
    {

        $this->validation->setRule('currency_symbol', "Coin Name",'required|trim|max_length[20]');
        $this->validation->setRule('trntype', "Transaction Type",'required|trim|max_length[20]');
        $this->validation->setRule('acctype', "Account Type",'required|trim|max_length[50]');
        $this->validation->setRule('upper', "Limit Amount",'required|trim|max_length[50]');

        if ($this->validation->withRequest($this->request)->run()) {
       
                $check = $this->common_model->findById('dbt_transaction_setup', array('trntype' => $this->request->getPost('trntype'), 'acctype' => $this->request->getPost('acctype'), 'currency_symbol' => $this->request->getPost('currency_symbol')));

                if(!empty($check)){
                    $this->session->setFlashdata('exception', display('this_level_already_exist'));
                    return redirect()->route('admin/setting/transaction-setup');

                } else {

                    $fees = array(

                        'trntype'         => $this->request->getPost('trntype', FILTER_SANITIZE_STRING),
                        'acctype'         => $this->request->getPost('acctype', FILTER_SANITIZE_STRING),
                        'currency_symbol' => $this->request->getPost('currency_symbol', FILTER_SANITIZE_STRING),
                        'lower'           => 0,
                        'upper'           => $this->request->getPost('upper', FILTER_SANITIZE_STRING),
                        'duration'        => 7,
                        'status'          => 1
                    );

                    $this->common_model->save('dbt_transaction_setup',$fees);
                    $this->session->setFlashdata('message',display('save_successfully'));
                    return redirect()->route('admin/setting/transaction-setup');
                }
        } else {

                $this->session->setFlashdata("exception", $this->validation->listErrors());
                return redirect()->route('admin/setting/transaction-setup');
        }
    }

    public function delete_transaction($id = null)
    { 
       
        if ($this->common_model->delete('dbt_transaction_setup', array('id' => $id))){

            $this->session->setFlashdata('message', display('delete_successfully'));

        } else {

            $this->session->setFlashdata('exception', display('please_try_again'));
        }
        return redirect()->route('admin/setting/transaction-setup');
    }

    public function language(){

        $data['languages'] = $this->languageList();
      
        $data['module'] = "Settings";
        $data['page']   = 'language/main'; 
        return $this->template->layout($data);
    }

    public function addLanguage()
    { 
        $language = preg_replace('/[^a-zA-Z0-9_]/', '', $this->request->getPost('language',FILTER_SANITIZE_STRING));
        $language = strtolower($language);

        if (!empty($language)) {

            if (!$this->db->fieldExists($language, "language")) {

                $this->dbforge->addColumn("language", [
                    $language => [
                        'type' => 'TEXT'
                    ]
                ]); 

                $this->session->setFlashdata('message', 'Language added successfully');
                return redirect()->route('admin/setting/language');

            } 

        } else {

            $this->session->setFlashdata('exception', 'Please try again');

        }
        return redirect()->route('admin/setting/language');
    }

    public function phrase(){


        $page_number      = (!empty($this->request->getVar('page'))?$this->request->getVar('page'):1);
        //findAll paramiter = where, limit, offset.
        $data['phrases']  = $this->common_model->get_all('language', array(),'id', 'desc', 20,($page_number-1)*20);
        $total            = $this->common_model->countRow('language', array());
        $data['pager']    = $this->pager->makeLinks($page_number, 20, $total);


        $data['module'] = "Settings";
        $data['page']   = 'language/phrase'; 
        return $this->template->layout($data);
    }

    public function addPhrase() {  

        $lang = $this->request->getPost('phrase', FILTER_SANITIZE_STRING); 

        if (sizeof($lang) > 0) {

            if ($this->db->tableExists("language")) {

                if ($this->db->fieldExists("phrase", "language")) {

                    foreach ($lang as $value) {

                        $value = preg_replace('/[^a-zA-Z0-9_]/', '', $value);
                        $value = strtolower($value);

                        if (!empty($value)) {
                            
                            $num_rows = $this->common_model->findById('language', array('phrase' => $value));

                            if (empty($num_rows)) { 

                                $this->common_model->save('language',['phrase' => $value]); 
                                $this->session->setFlashdata('message', 'Phrase added successfully');

                            } else {

                                $this->session->setFlashdata('exception', 'Phrase already exists!');
                            }
                        }   
                    }  

                    return redirect()->route('admin/setting/phrase');
                }  
            }
        } 

        $this->session->setFlashdata('exception', 'Please try again');
        return redirect()->route('admin/setting/phrase');
    }

    public function editPhrase($language = null){


        $page_number      = (!empty($this->request->getVar('page'))?$this->request->getVar('page'):1);
        //findAll paramiter = where, limit, offset.
        $data['phrases']  = $this->common_model->get_all('language', array(),'id', 'asc', 20,($page_number-1)*20);

        $total            = $this->common_model->countRow('language', array());
        $data['pager']    = $this->pager->makeLinks($page_number, 20, $total);

        $data['search_result']  = "";
        $data['search_lang_id'] = "";

        if($this->session->get('search_lang_id') != null){

            $data['search_lang_id'] = $search_lang_id = $this->session->get('search_lang_id');
            $data['search_result']  = $this->common_model->findById('language', array('id' =>$search_lang_id));
        }

        $data['language'] = $language;
        $data['module'] = "Settings";
        $data['page']   = 'language/phrase_edit'; 
        return $this->template->layout($data);
    }

    public function search($segment="")
    {
        
        $this->validation->setRule('search_box', "Search box",'required|trim|max_length[200]');
        if ($this->validation->withRequest($this->request)->run()) {

            $search_box = $this->request->getPost('search_box',FILTER_SANITIZE_STRING);

            $languagedata = $this->db->getFieldData('language');
            $search       = 0;

            foreach ($languagedata as $key => $value) {

                if($key == 0){

                    continue;
                }
                
                $search_result = $this->common_model->findById('language', array('phrase' => $search_box));

                if($search_result){

                    $search = $search_result->id;
                    break;
                }
            }

            if($search != 0){

                $this->session->setFlashdata('search_lang_id', $search);
                $this->session->setFlashdata('message', "We find your searching language");

            } else {

                $this->session->setFlashdata('exception', "Sorry, we couldn't find and language for '".$search_box."'");
            }

        } else {

            $this->session->setFlashdata('exception', validation_errors());
        }

        return redirect()->to(base_url("/admin/setting/edit-phrase/".$segment));
    }

    public function addLebel() { 

        $language = $this->request->getPost('language', FILTER_SANITIZE_STRING);
        $phrase   = $this->request->getPost('phrase', FILTER_SANITIZE_STRING);
        $lang     = $this->request->getPost('lang', FILTER_SANITIZE_STRING);

        if (!empty($language)) {

            if ($this->db->tableExists('language')) {

                if ($this->db->fieldExists($language, 'language')) {

                    if (sizeof($phrase) > 0)

                    for ($i = 0; $i < sizeof($phrase); $i++) {

                        $datau = array($language => $lang[$i]);
                        $this->common_model->update('language', $datau, array('phrase' => $phrase[$i]));
                    }  

                    $this->session->setFlashdata('message', display('label_added_successfully'));
                    return redirect()->to(base_url("/admin/setting/edit-phrase/".$language));
                }  
            }
        } 

        $this->session->setFlashdata('exception', 'Please try again');
        return redirect()->to(base_url("/admin/setting/edit-phrase/".$language));
    }

    public function payment_gateway(){

        $data['payment_gateway'] = $this->common_model->findAll('payment_gateway', array(), 'id', 'asc', 15, 0);

        $data['module'] = "Settings";
        $data['page']   = 'payment_gateway/list'; 
        return $this->template->layout($data);
    }


    public function update_payment_gateway($id = null)
    { 
        $data['title']  = display('add_payment_gateway');
        $data_value = "";

        if ($this->request->getPost('identity')=='bitcoin') {

            $this->validation->setRule('status', display('status'),'required|max_length[10]');
            
            $public_key = serialize(array(

                $this->request->getPost('key1', FILTER_SANITIZE_STRING)  => $this->request->getPost('public_key', FILTER_SANITIZE_STRING),
                $this->request->getPost('key2', FILTER_SANITIZE_STRING)  => $this->request->getPost('public_key2', FILTER_SANITIZE_STRING),
                $this->request->getPost('key3', FILTER_SANITIZE_STRING)  => $this->request->getPost('public_key3', FILTER_SANITIZE_STRING),
                $this->request->getPost('key4', FILTER_SANITIZE_STRING)  => $this->request->getPost('public_key4', FILTER_SANITIZE_STRING),
                $this->request->getPost('key5', FILTER_SANITIZE_STRING)  => $this->request->getPost('public_key5', FILTER_SANITIZE_STRING),
                $this->request->getPost('key6', FILTER_SANITIZE_STRING)  => $this->request->getPost('public_key6', FILTER_SANITIZE_STRING),
                $this->request->getPost('key7', FILTER_SANITIZE_STRING)  => $this->request->getPost('public_key7', FILTER_SANITIZE_STRING),
                $this->request->getPost('key8', FILTER_SANITIZE_STRING)  => $this->request->getPost('public_key8', FILTER_SANITIZE_STRING),
                $this->request->getPost('key9', FILTER_SANITIZE_STRING)  => $this->request->getPost('public_key9', FILTER_SANITIZE_STRING),
                $this->request->getPost('key10', FILTER_SANITIZE_STRING) => $this->request->getPost('public_key10', FILTER_SANITIZE_STRING),
                $this->request->getPost('key11', FILTER_SANITIZE_STRING) => $this->request->getPost('public_key11', FILTER_SANITIZE_STRING),
                $this->request->getPost('key12', FILTER_SANITIZE_STRING) => $this->request->getPost('public_key12', FILTER_SANITIZE_STRING),
                $this->request->getPost('key13', FILTER_SANITIZE_STRING) => $this->request->getPost('public_key13', FILTER_SANITIZE_STRING)

            ));

            $private_key = serialize(array(

                $this->request->getPost('key1', FILTER_SANITIZE_STRING)  => $this->request->getPost('private_key', FILTER_SANITIZE_STRING),
                $this->request->getPost('key2', FILTER_SANITIZE_STRING)  => $this->request->getPost('private_key2', FILTER_SANITIZE_STRING),
                $this->request->getPost('key3', FILTER_SANITIZE_STRING)  => $this->request->getPost('private_key3', FILTER_SANITIZE_STRING),
                $this->request->getPost('key4', FILTER_SANITIZE_STRING)  => $this->request->getPost('private_key4', FILTER_SANITIZE_STRING),
                $this->request->getPost('key5', FILTER_SANITIZE_STRING)  => $this->request->getPost('private_key5', FILTER_SANITIZE_STRING),
                $this->request->getPost('key6', FILTER_SANITIZE_STRING)  => $this->request->getPost('private_key6', FILTER_SANITIZE_STRING),
                $this->request->getPost('key7', FILTER_SANITIZE_STRING)  => $this->request->getPost('private_key7', FILTER_SANITIZE_STRING),
                $this->request->getPost('key8', FILTER_SANITIZE_STRING)  => $this->request->getPost('private_key8', FILTER_SANITIZE_STRING),
                $this->request->getPost('key9', FILTER_SANITIZE_STRING)  => $this->request->getPost('private_key9', FILTER_SANITIZE_STRING),
                $this->request->getPost('key10', FILTER_SANITIZE_STRING) => $this->request->getPost('private_key10', FILTER_SANITIZE_STRING),
                $this->request->getPost('key11', FILTER_SANITIZE_STRING) => $this->request->getPost('private_key11', FILTER_SANITIZE_STRING),
                $this->request->getPost('key12', FILTER_SANITIZE_STRING) => $this->request->getPost('private_key12', FILTER_SANITIZE_STRING),
                $this->request->getPost('key13', FILTER_SANITIZE_STRING) => $this->request->getPost('private_key13', FILTER_SANITIZE_STRING)

            ));


        } elseif ($this->request->getPost('identity')=='bank'){

            $this->validation->setRule('acc_name', display('account_name'), 'required|trim');
            $this->validation->setRule('acc_no', display('account_no'), 'required|trim');
            $this->validation->setRule('branch_name', display('branch_name'), 'required|trim');
            $this->validation->setRule('country', display('country'), 'required|trim');
            $this->validation->setRule('bank_name', display('bank_name'), 'required|trim');


            $acc_name       = $this->request->getPost('acc_name', FILTER_SANITIZE_STRING);
            $acc_no         = $this->request->getPost('acc_no', FILTER_SANITIZE_STRING);
            $branch_name    = $this->request->getPost('branch_name', FILTER_SANITIZE_STRING);
            $swift_code     = $this->request->getPost('swift_code', FILTER_SANITIZE_STRING);
            $abn_no         = $this->request->getPost('abn_no', FILTER_SANITIZE_STRING);
            $country        = $this->request->getPost('country', FILTER_SANITIZE_STRING);
            $bank_name      = $this->request->getPost('bank_name', FILTER_SANITIZE_STRING);

            $post_data = $this->request->getPost();

            $public_key = json_encode($post_data);
            $private_key = $this->request->getPost('private_key', FILTER_SANITIZE_STRING);


        } elseif ($this->request->getPost('identity', FILTER_SANITIZE_STRING)=='coinpayment'){

            $this->validation->setRule('public_key', display('public_key'),'required|max_length[1000]');
            $this->validation->setRule('private_key', display('private_key'),'required|max_length[1000]');
            $this->validation->setRule('mercent_id', display('mercent_id'), 'required|trim');
            $this->validation->setRule('ipn_secret', display('ipn_secret'), 'required|trim');
            $this->validation->setRule('debug_email', display('debug_email'),'required|trim');
            $this->validation->setRule('coinpayment_wtdraw', 'Withdraw','required|trim');

            $public_key         = $this->request->getPost('public_key', FILTER_SANITIZE_STRING);
            $private_key        = $this->request->getPost('private_key', FILTER_SANITIZE_STRING);
            $mercent_id         = $this->request->getPost('mercent_id', FILTER_SANITIZE_STRING);
            $ipn_secret         = $this->request->getPost('ipn_secret', FILTER_SANITIZE_STRING);
            $debug_email        = $this->request->getPost('debug_email', FILTER_SANITIZE_STRING);
            $coinpayment_wtdraw = $this->request->getPost('coinpayment_wtdraw', FILTER_SANITIZE_STRING);
            
            if($this->request->getPost('debuging_active', FILTER_SANITIZE_STRING)){

                $debuging_active = 1;

            } else {

                $debuging_active = 0;
            }

            $post_data = array(

                'marcent_id'        => $mercent_id,
                'ipn_secret'        => $ipn_secret,
                'debug_email'       => $debug_email,
                'debuging_active'   => $debuging_active,
                'withdraw'          => $coinpayment_wtdraw
            );

            $data_value = json_encode($post_data);

        } else {
            $this->validation->setRule('public_key', display('public_key'),'required|max_length[1000]');
            $this->validation->setRule('private_key', display('private_key'),'required|max_length[1000]');

            $public_key  = $this->request->getPost('public_key', FILTER_SANITIZE_STRING);
            $private_key = $this->request->getPost('private_key', FILTER_SANITIZE_STRING);
        }

        $data['payment_gateway']    = (object)$userdata = array(

            'id'            => $this->request->getPost('id', FILTER_SANITIZE_STRING),
            'agent'         => $this->request->getPost('agent', FILTER_SANITIZE_STRING),
            'public_key'    => $public_key,
            'private_key'   => $private_key,
            'secret_key'    => $this->request->getPost('secret_key', FILTER_SANITIZE_STRING),
            'data'          => $data_value,
            'status'        => $this->request->getPost('status', FILTER_SANITIZE_STRING)
        );

        if($this->request->getMethod() == 'post'){

            if ($this->validation->withRequest($this->request)->run())
            {

                if ($this->common_model->update('payment_gateway', $userdata, array('id' => $id))) {

                    $this->session->setFlashdata('message', display('update_successfully'));

                } else {

                    $this->session->setFlashdata('exception', display('please_try_again'));
                }

                return redirect()->to(base_url("/admin/setting/update-gateway/".$id));

            } else {

                $this->session->setFlashdata("exception", $this->validation->listErrors());
            }
        }

        if(!empty($id)) {

            $data['payment_gateway']   = $this->common_model->findById('payment_gateway', array('id' => $id));
        }

        $data['countrys'] = $this->common_model->findAll('dbt_country', array(), 'id', 'asc', 300, 0);

        $data['module'] = "Settings";
        $data['page']   = 'payment_gateway/form'; 
        return $this->template->layout($data);
    }


    public function affiliation()
    {  
        
        $this->validation->setRule('commission', display('commission'),'max_length[100]|required|trim');
        $this->validation->setRule('type', display('type'),'max_length[11]|required|trim');
        $this->validation->setRule('status', display('status'),'max_length[1]|required|trim');

        $data['affiliation'] = (object)$userdata = array(

            'id'            => $this->request->getPost('id', FILTER_SANITIZE_STRING),
            'commission'    => $this->request->getPost('commission', FILTER_SANITIZE_STRING),
            'type'          => $this->request->getPost('type', FILTER_SANITIZE_STRING),
            'status'        => $this->request->getPost('status', FILTER_SANITIZE_STRING)
        );
        
        if($this->request->getMethod() == 'post'){

            if ($this->validation->withRequest($this->request)->run())
            {

                if ($this->common_model->update('dbt_affiliation', $userdata, array('id' => 1))) {

                    $this->session->setFlashdata('message', display('update_successfully'));

                } else {

                    $this->session->setFlashdata('exception', display('please_try_again'));
                }

                return redirect()->to(base_url("/admin/setting/affiliation"));

            } else {

                $this->session->setFlashdata("exception", $this->validation->listErrors());
            }
        }

        $data['affiliation'] = $this->common_model->findById('dbt_affiliation', array('id' => 1));
        $data['module'] = "Settings";
        $data['page']   = 'affiliation/affiliation'; 
        return $this->template->layout($data);
    }


    public function extrnal_api_list(){

        $page_number   = (!empty($this->request->getVar('page'))?$this->request->getVar('page'):1);
        //findAll paramiter = where, limit, offset.
        $data['apis']  = $this->common_model->get_all('external_api_setup', array(),'id', 'asc', 20,($page_number-1)*20);
        $total         = $this->common_model->countRow('external_api_setup', array());
        $data['pager'] = $this->pager->makeLinks($page_number, 20, $total);


        $data['module'] = "Settings";
        $data['page']   = 'external_api/list'; 
        return $this->template->layout($data);
    }

    public function update_external_api($id = null)
    { 

        $this->validation->setRule('name', display('name'),'required|max_length[50]');
        $this->validation->setRule('api_key', 'API Key','required|max_length[100]');

        $data['apis'] = (object)$userdata = array(

            'id'     => $this->request->getPost('id',FILTER_SANITIZE_STRING),
            'name'   => $this->request->getPost('name',FILTER_SANITIZE_STRING),
            'data'   => json_encode(array('api_key'=> $this->request->getPost('api_key',FILTER_SANITIZE_STRING))),
            'status' => $this->request->getPost('status',FILTER_SANITIZE_STRING)

        );

        if($this->request->getMethod() == 'post'){

            if($this->validation->withRequest($this->request)->run())
            {

                $dataupdate = $this->common_model->update('external_api_setup', $userdata, array('id' => $id));
                if ($dataupdate) {

                    $this->session->setFlashdata('message', display('update_successfully'));

                } else {

                    $this->session->setFlashdata('exception', display('please_try_again'));
                }

                return redirect()->to(base_url("/admin/setting/update-external-api/".$id));

            } else {

                $this->session->setFlashdata("exception", $this->validation->listErrors()); 
                return redirect()->to(base_url("/admin/setting/update-external-api/".$id)); 

            }

        } else {

            if(!empty($id)) {

                $data['apis']  = $this->common_model->findById('external_api_setup', array('id' => $id));
            } 
        }

        $data['module'] = "Settings";
        $data['page']   = 'external_api/form'; 
        return $this->template->layout($data);
    }

    /*
    |----------------------------
    |   email Gateway
    |----------------------------
    */   
    public function email_gateway()
    {

        $data['email']  = $this->common_model->findById('email_sms_gateway', array('es_id' => 2));
       
        $data['module'] = "Settings";
        $data['page']   = 'settings/email_gateway'; 
        return $this->template->layout($data);
    }

    /*
    |----------------------------
    |   SMS Gateway
    |----------------------------
    */   
    public function sms_gateway()
    {

        $data['sms']    = $this->common_model->findById('email_sms_gateway', array('es_id' => 1));

        $data['module'] = "Settings";
        $data['page']   = 'settings/sms_gateway'; 
        return $this->template->layout($data);
    }

    public function getemailsmsgateway()
    {
        $sms = $this->common_model->findById('email_sms_gateway', array('es_id' => 1));
        echo json_encode($sms);
    }

    public function update_sms_gateway()
    {
        $sms = $this->request->getPost('es_id', FILTER_SANITIZE_STRING);
        $pass = '';
        $password = $this->common_model->findById('email_sms_gateway', array('es_id' => 2));
        
        if($password->password == base64_decode($this->request->getPost('password', FILTER_SANITIZE_STRING))){

           $pass = $password->password;
           
        } else {

            $pass = $this->request->getPost('password', FILTER_SANITIZE_STRING);
        }

        $data = array(

            'gatewayname' => $this->request->getPost('gatewayname', FILTER_SANITIZE_STRING),
            'title'       => $this->request->getPost('title', FILTER_SANITIZE_STRING),
            'host'        => $this->request->getPost('host', FILTER_SANITIZE_STRING),
            'user'        => $this->request->getPost('user', FILTER_SANITIZE_STRING),
            'userid'      => $this->request->getPost('userid', FILTER_SANITIZE_STRING),
            'password'    => $pass,
            'api'         => $this->request->getPost('api', FILTER_SANITIZE_STRING)
        );

        $this->common_model->update('email_sms_gateway', $data, array('es_id' => $sms));     
        $this->session->setFlashdata('message',display('update_successfully'));
        return redirect()->to(base_url("/admin/setting/sms-gateway")); 
    }

    public function update_email_gateway()
    {
        $email = $this->request->getPost('es_id', FILTER_SANITIZE_STRING);
        $pass = '';
        $password = $this->common_model->findById('email_sms_gateway', array('es_id' => 2));
        
        if($password->password == base64_decode($this->request->getPost('email_password', FILTER_SANITIZE_STRING))){

           $pass = $password->password;

        } else {

            $pass = $this->request->getPost('email_password', FILTER_SANITIZE_STRING);
        }

        $data = array(

            'title'     =>$this->request->getPost('email_title', FILTER_SANITIZE_STRING),
            'protocol'  =>$this->request->getPost('email_protocol', FILTER_SANITIZE_STRING),
            'host'      =>$this->request->getPost('email_host', FILTER_SANITIZE_STRING),
            'port'      =>$this->request->getPost('email_port', FILTER_SANITIZE_STRING),
            'user'      =>$this->request->getPost('email_user', FILTER_SANITIZE_STRING),
            'password'  =>$pass,
            'mailtype'  =>$this->request->getPost('email_mailtype', FILTER_SANITIZE_STRING),
            'charset'   =>$this->request->getPost('email_charset', FILTER_SANITIZE_STRING)
        );

        $this->common_model->update('email_sms_gateway', $data, array('es_id' => $email));
        $this->session->setFlashdata('message',display('update_successfully'));
        return redirect()->to(base_url("/admin/setting/email-gateway")); 
    }

    /*
|----------------------------
|   Email Testing Action
|----------------------------
*/ 
    public function test_email()
    {
        $this->validation->setRule('email_to','Email','required|valid_email');
        $this->validation->setRule('email_sub','Subject','required');
        $this->validation->setRule('email_message','Message','required');


        if($this->validation->withRequest($this->request)->run()){

            $post = array(
                'title'    => "Test Email Gateway",
                'subject'  => $this->request->getPost('email_sub'),
                'to'       => $this->request->getPost('email_to'),
                'message'  => $this->request->getPost('email_message'),
            );

            $code_send = $this->common_model->send_email($post);

            if($code_send == 1){

                $this->session->setFlashdata('message','Email Send Successfully!');

            } else {

                $this->session->setFlashdata('exception',"Email Send Fail, Please check your gateway!");
            }

        } else {

            $this->session->setFlashdata("exception", $this->validation->listErrors());
        }

        return redirect()->to(base_url("/admin/setting/email-gateway")); 
    }

    public function test_sms()
    {

        $this->validation->setRule('mobile_num','Mobile Number','required|trim');
        $this->validation->setRule('test_message','Test SMS','required');

       if($this->validation->withRequest($this->request)->run()){

            #----------------------------
            #      SMS Test
            #----------------------------
        
            $mobile_num     = $this->request->getPost('mobile_num');
            $test_message   = $this->request->getPost('test_message');

            if ($mobile_num) {

                try {

                    $smssend = $this->sms_lib->send(array(
                        'to'        => $mobile_num, 
                        'template'  => $test_message
                    ));
                }
                catch (exception $e) {
                    $this->session->setFlashdata('exception',"Please Set Your SMS Gateway Information!");
                }


                if (is_string($smssend) && is_array(json_decode($smssend, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false) {

                    $smsdata = json_decode($smssend,true);

                    if($smsdata['status']){



                        $this->session->setFlashdata('message',$smsdata['message']);

                    } else {

                        $this->session->setFlashdata('exception',$smsdata['message']);
                    }
                } else {

                    $this->session->setFlashdata('message',$smssend);
                }

            } else {

                $this->session->setFlashdata('exception', "There is no Phone number!!!");

            }

        } else {

            $this->session->setFlashdata("exception", $this->validation->listErrors());
        }

        return redirect()->to(base_url("/admin/setting/sms-gateway")); 
    }

    public function email_sms_template_list()
    {

        $data['template_list'] = $this->common_model->findAll('dbt_sms_email_template', array(), 'id', 'asc');
       
        $data['module'] = "Settings";
        $data['page']   = 'email_sms_template/list'; 
        return $this->template->layout($data);
    }

    public function template_update($id = null){

       if($this->request->getMethod() == 'post'){

            $this->validation->setRule('subject_en', 'subject-english', 'required|max_length[200]|trim');
            $this->validation->setRule('subject_fr', 'subject-french','required|max_length[200]|trim');
            $this->validation->setRule('template_en', display('template-english'),'required|max_length[400]');
            $this->validation->setRule('template_fr', display('template-french') ,'required|max_length[400]');

            if($this->validation->withRequest($this->request)->run())
            {

                $sid = $this->request->getPost('id');

                $datasave = array(
                    'subject_en'  => $this->request->getPost('subject_en', FILTER_SANITIZE_STRING),
                    'subject_fr'  => $this->request->getPost('subject_fr', FILTER_SANITIZE_STRING),
                    'template_en' => $this->request->getPost('template_en', FILTER_SANITIZE_STRING),
                    'template_fr' => $this->request->getPost('template_fr', FILTER_SANITIZE_STRING),
                );
               
                $this->common_model->update('dbt_sms_email_template', $datasave, array('id' => $sid));     
                $this->session->setFlashdata('message',display('update_successfully'));

            } else {

                $this->session->setFlashdata("exception", $this->validation->listErrors());
            }

            return redirect()->to(base_url("/admin/setting/email-sms-template")); 
        }

        $data['template'] = $this->common_model->findById('dbt_sms_email_template', array('id' => $id));
        $data['module'] = "Settings";
        $data['page']   = 'email_sms_template/form'; 
        return $this->template->layout($data);
    }

    #-----------------------------------
    #Email Sms Setting View
    #-----------------------------------
    public function email_sms_setting()
    {

        $whereemail=array(
                'method' => 'email'
        );
        $data['email']=$this->common_model->findById('sms_email_send_setup',$whereemail);
        $wheresms=array(
            'method' => 'sms'
        );
        $data['sms']=$this->common_model->findById('sms_email_send_setup',$wheresms);
       
        $data['module'] = "Settings";
        $data['page']   = 'settings/email_and_sms_setting'; 
        return $this->template->layout($data);
    }

    public function update_sender()
    {
        $this->validation->setRule('email', display('email'),'alpha_space');
        $this->validation->setRule('sms', display('sms'),'alpha_space');
        $this->validation->setRule('deposit', display('deposit'),'numeric|permit_empty');
        $this->validation->setRule('transfer', display('transfer'),'numeric|permit_empty');
        $this->validation->setRule('withdraw', display('withdraw'),'numeric|permit_empty');
       
        if($this->validation->withRequest($this->request)->run())
        {
            $email = $this->request->getVar('email');
            $sms   = $this->request->getVar('sms');

            if($email!=NULL){
                $data = array(
                    'deposit' =>$this->request->getVar('deposit',FILTER_SANITIZE_STRING),
                    'transfer' =>$this->request->getVar('transfer',FILTER_SANITIZE_STRING),
                    'withdraw' =>$this->request->getVar('withdraw',FILTER_SANITIZE_STRING),
                );
                $where=array(
                    'method'    =>$email
                );
                $this->common_model->update('sms_email_send_setup',$data, $where);
            }

            if($sms!=NULL){
                $data = array(
                    'deposit'       =>$this->request->getVar('deposit',FILTER_SANITIZE_STRING),
                    'transfer'      =>$this->request->getVar('transfer',FILTER_SANITIZE_STRING),
                    'withdraw'      =>$this->request->getVar('withdraw',FILTER_SANITIZE_STRING),
                );
                $where=array(
                    'method'    => $sms
                );
                $this->common_model->update('sms_email_send_setup',$data, $where);
                $this->session->setflashdata('message',display('update_successfully'));
            }
        }else {
            $error=$this->validation->listErrors();
            if($this->request->getMethod() == "post"){
                $this->session->setFlashdata('exception', $error);
            }
        }
        
        return  redirect()->to(base_url('admin/setting/email-sms-settings'));
                
    }
}
