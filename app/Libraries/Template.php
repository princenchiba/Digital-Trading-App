<?php namespace app\Libraries;
use App\Libraries\Permission;
define('UPDATE_INFO_URL','https://update.bdtask.com/tradebox/autoupdate/update_info');
class Template {
	public function __construct()
    {
        $this->session 	  = session();
        $this->db 		  = db_connect();
        $this->uri 		  = current_url(true);
    }
	public function layout($data){
		if ( @fopen("https://update.bdtask.com", "r") ) 
        {
           $max_version = file_get_contents(UPDATE_INFO_URL);

        } else {

        	$max_version = $this->current_version();

        } 
      	$data['max_version']     = $max_version;
        $data['current_version'] = $this->current_version();


		$data['settings'] 	   = $this->setting_data();
		$data['settings_info'] = $this->setting_data();
		$data['segments'] 	   = $this->uri->getSegments();
		return view('template/layout', $data);
	}

	public function setting_data(){
		$builder = $this->db->table('setting')->get()->getRow(); 
		return $builder;
	}

	private function current_version(){

        //Current Version
        $product_version = '';
        $path = FCPATH.'system/Security/lic.php'; 
        if (file_exists($path)) {
            
            // Open the file
            $whitefile = file_get_contents($path);

            $file = fopen($path, "r");
            $i    = 0;
            $product_version_tmp = array();
            $product_key_tmp = array();
            while (!feof($file)) {
                $line_of_text = fgets($file);

                if (strstr($line_of_text, 'product_version')  && $i==0) {
                    $product_version_tmp = explode('=', strstr($line_of_text, 'product_version'));
                    $i++;
                }                
            }
            fclose($file);

            $product_version = trim(@$product_version_tmp[1]);
            $product_version = ltrim(@$product_version, '\'');
            $product_version = rtrim(@$product_version, '\';');

            return @$product_version;
            
        } else {
            //file is not exists
            return false;
        }
    }

}
