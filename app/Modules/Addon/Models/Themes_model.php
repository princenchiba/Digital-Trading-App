<?php  namespace App\Modules\Addon\Models;

class Themes_model  {
	public function __construct()
        {
            $this->db = db_connect();
            $this->session = \Config\Services::session();
        }

	public function store($name)
    {
        $data=[
            'name'=>$name,
            'status'=>0
        ];
        $builder=$this->db->table('themes');
        $builder->insert($data);
         return TRUE;
    }
    //get default theme
    public function get_theme()
    {
        $theme = $this->db->table('themes')->select('name')->where('status',1)->get()->getRow();

        return @$theme->name;
    }

    //get all theme
    public function get_themes()
    {
        $builder = $this->db->table('themes');
    	$builder->orderBy('status','desc');
        $themes = $builder->select('*')->get()->getResult();
        return $themes;
    }


	//New Theme Activation
	public function new_theme_activation($theme_name)
	{
		$this->db->trans_start();

		$this->db->update('themes', array('status' => 1), array('name' => $theme_name));

		$this->db->where('name !=', $theme_name);
		$this->db->update('themes', array('status' => 0));

		$this->db->trans_complete();

		if($this->db->trans_status() == FALSE){
			return FALSE;
		} else {
			return TRUE;
		}
	}

	// Get all themes ids
	public function get_installed_themes_ids()
	{
                $builder = $this->db->table('themes');
		$builder->select('name');
		$themes = $builder->get()->getResultArray();
		$theme_ids = array_column($themes, 'name');
		return $theme_ids;
	}
}