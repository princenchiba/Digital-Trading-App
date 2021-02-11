<?php namespace App\Modules\Dashboard\Controllers;

use CodeIgniter\Controller;
use App\Libraries\Template;
class Language extends BaseController
{

    private $table         = 'language';
    private $phrase        = 'phrase';
    private $setting_table = 'setting';
    private $default_lang  = 'english';

    public function index()
    {
        $data['title']     = "Language List";
        $data['module']    = "dashboard";
        $data['page']      = "language/main";
        $data['languages'] = $this->language_model->languages();
         return $this->template->layout($data);
    }

    public function phrase()
    {
        $data["phrases"]   = $this->phrase_Model->paginate(10);
        $data['page_num']  = $this->request->getGet('page');
        $data['total_phrase'] = $this->count_phrase();
        $data["pager"]     = $this->phrase_Model->pager;
        $data['title']     = "Language List";
        $data['module']    = "dashboard";
        $data['page']      = "language/phrase";
        return $this->template->layout($data);
    }
 
    public function addLanguage()
    { 
        helper(['form','url']);
        $language = preg_replace('/[^a-zA-Z0-9_]/', '', $this->request->getVar('language'));
        $language = strtolower($language);

        if (!empty($language)) {
            if (!$this->db->fieldExists($language, $this->table)) {
                $this->dbforge->addColumn($this->table, [
                    $language => [
                        'type' => 'TEXT'
                    ]
                ]); 
                $this->session->setFlashdata('message', 'Language added successfully');
               return redirect()->route('dashboard/language');
            } 
        } else {
            $this->session->setFlashdata('exception', 'Please try again');
        }

         return redirect()->route('dashboard/language');
    }

    public function editPhrase($language = null)
    { 
        $data['title']     = "Edit Phrase";
        $data['module']    = "dashboard";
        $data['page']      = "language/phrase_edit";
        $data['language']  = $language;
        $data['phrases']   = $this->language_model->phrases($language);
         return $this->template->layout($data);
    }

    public function CheckLabelList(){
        $postData = $this->request->getVar();
        $data = $this->language_model->getPhrases($postData);
        echo json_encode($data);
    } 

    public function addPhrase() {  

        $lang = $this->request->getVar('phrase'); 

        if (sizeof($lang) > 0) {

            if ($this->db->tableExists('language')) {

                if ($this->db->fieldExists('phrase', 'language')) {

                    foreach ($lang as $value) {

                        $value = preg_replace('/[^a-zA-Z0-9_]/', '', $value);
                        $value = strtolower($value);

                        if (!empty($value)) {
                           
                            $builder = $this->db->table('language');
                            $builder->selectCount('id');
                            $builder->where('phrase',$value);
                            $query = $builder->get(); 
                            $result = $query->getRow();
                            if ($result->id == 0) { 
                                $data = array(
                                    'phrase' =>$value,
                                );
                                $builder->insert($data);
                                $this->session->setFlashdata('message', 'Phrase added successfully');
                            } else {
                                $this->session->setFlashdata('exception', 'Phrase already exists!');
                            }
                        }   
                    }  
                    return  redirect()->to(base_url('/dashboard/phrases/'));
                }  
            }
        } 
        $this->session->setFlashdata('exception', 'Please try again');
        return  redirect()->to(base_url('/dashboard/phrases/'));
    }
 
    public function phrases($offset=null, $limit=null)
    {
        if ($this->db->tableExists($this->table)) {

            if ($this->db->fieldExists($this->phrase, $this->table)) {

                return $this->db->order_by($this->phrase,'asc')
                    ->limit($offset, $limit)
                    ->get($this->table)
                    ->result();
            }  
        } 
        return false;
    }

    public function addLebel() { 
        helper(['form','url']);
        $language = $this->request->getVar('language_name');
        $phrase   = $this->request->getVar('phrase');
        $lang     = $this->request->getVar('lang');
        if (!empty($language)) {

            if ($this->db->tableExists('language')) {

                if ($this->db->fieldExists($language, 'language')) {

                    if (sizeof($phrase) > 0)
                    for ($i = 0; $i < sizeof($phrase); $i++) {
                       
                        $builder =  $this->db->table('language'); 
                        $builder->set($language, $lang[$i]);
                        $builder->where('phrase', $phrase[$i]);
                        $builder->update();
                    }  
                    $this->session->setFlashdata('message', 'Label added successfully!');
                    return  redirect()->to(base_url('/dashboard/edit_phrase/'.$language));
                }  
            }
        } 

        $this->session->setFlashdata('exception', 'Please try again');
           return  redirect()->to(base_url('/dashboard/edit_phrase/'.$language));
    }
    public function count_phrase(){
        $builder = $this->db->table('language'); 
        $builder->select('count(id) as total');
        $query = $builder->get(); 
         $result = $query->getRow(); 
        return $result;
    }
}



 