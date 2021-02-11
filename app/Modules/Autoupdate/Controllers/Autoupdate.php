<?php namespace App\Modules\Autoupdate\Controllers;
/**
 * UPDATE_URL           - set url to get update file. example: http://example.com/autoupdate 
 * UPDATE_INFO_URL      - set url to get letest version info. example: http://example.com/autoupdate/update_info
 * memory_limit         - customize your memory limit  (optional)
 * max_execution_time   - customize your max execution time (optional)
 * 
 * MIN_VERSION          - set minimum version(for checking update compatiable or not)
 * MAX_VERSION          - set maximum version(for checking update compatiable or not)
 * 
 * 
 * @System      : Autoupdate software(user-end)
 * @developer   : Md.Tareq Rahman
 * @E-mail      : tareq7500@gmail.com
 * @datetime    : 2019-03-18
 * @version     : Version 1.0.0
 * @filesource
 */

//defined('BASEPATH') OR exit('No direct script access allowed');

@ini_set('memory_limit', '100M');
@ini_set('max_execution_time', 300);
@ini_set("allow_url_fopen", 1);

if(@fopen("https://update.bdtask.com", "r")) 
{

    //Get Update file
    define('MIN_VERSION', file_get_contents('https://update.bdtask.com/tradebox/autoupdate/update_min_version'));
    //Get Update file
    define('MAX_VERSION', file_get_contents('https://update.bdtask.com/tradebox/autoupdate/update_max_version'));

    //Get Update file
    define('UPDATE_URL','https://update.bdtask.com/tradebox/autoupdate');
    // Get latest version info
    //define('UPDATE_INFO_URL','https://update.bdtask.com/tradebox/autoupdate/update_info');
    // CRM temporary path
    define('TEMP_FOLDER', FCPATH .'temp' . '/');
}

class Autoupdate extends BaseController
{
    private $tmp_update_dir;
    private $tmp_dir;

    public function index(){ 

     
        $data = array();

        if ( @fopen("https://update.bdtask.com", "r")) 
        {
          $data['latest_version']  = file_get_contents(UPDATE_INFO_URL);
        } else {
          $data['latest_version']  = $this->current_version();
        }

        $data['current_version'] = $this->current_version();

        //Checking update available or not
        if ($data['current_version'] == $data['latest_version']) {
            //Your Message
        }
        //compatible version 
        else if ($data['current_version'] >= MIN_VERSION && $data['current_version'] <= MAX_VERSION) {
            $data['message_txt'] = '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Update available';
        } else {
            $data['exception_txt'] = '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>Version 6.0 is available';
        }  
    
        $data['module'] = "Autoupdate";
        $data['page']   = 'autoupdate/autoupdate'; 
        return $this->template->layout($data);
    }

    public function update()
    {
        if (!$this->session->get('isLogIn')&& !$this->session->get('isAdmin'))
           return redirect()->route('admin/autoupdate/autoupdate');

        $purchase_key   = $this->request->getPost('purchase_key', FILTER_SANITIZE_STRING);      
        $purchase_key   = trim($purchase_key);
        $latest_version = file_get_contents(UPDATE_INFO_URL);
        $url            = UPDATE_URL;

        $this->validation->setRule('purchase_key', 'message','required|max_length[100]|trim');

        if ($this->validation->withRequest($this->request)->run()) {
            $product_version = $this->current_version();
            $product_key     = $this->product_key();
            $this->agent     = $this->request->getUserAgent();
        
            // Get The Zip File From Server
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_USERAGENT, $this->agent->getAgentString());
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//last
            curl_setopt($ch, CURLOPT_FAILONERROR, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_AUTOREFERER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 300);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_POSTFIELDS, [
                    'base_url'        => site_url(),
                    'running_version' => $product_version,
                    'purchase_key'    => $purchase_key,
                    'product_key'     => $product_key,
                    'user_ip'         => $this->request->getIpAddress(),
                    'server_ip'       => $_SERVER['SERVER_ADDR'],
                ]);

            $success = curl_exec($ch);
            $response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            curl_close($ch);
            $return_data = json_decode($success, true);
         
            if ($return_data['purchase_key'] == 'invalid' && $response_code == 200) {
                $this->session->setFlashdata('exception', 'Purchase key invalid.');

            } elseif ($return_data['purchase_key'] == 'valid' && $response_code == 200){
                $this->session->setFlashdata('message', 'Software updated successfully');
            }
        } else {
            $this->session->setFlashdata('exception', 'Purchase key required');          
        }
       return redirect()->route('admin/autoupdate/autoupdate');
    }

    public function updatenow()
    {
        $purchase_key   = $this->request->getPost('purchase_key', FILTER_SANITIZE_STRING);       
        $purchase_key   = trim($purchase_key);
        $latest_version = file_get_contents(UPDATE_INFO_URL);
        $url            = $this->request->getPost('update_url', FILTER_SANITIZE_STRING);
        //$url            =  'https://update.bdtask.com/tradebox/tradebox-v5.9.zip';

        $product_version = $this->current_version();
        $product_key     = $this->product_key();

        $tmp_dir = $this->get_temp_dir();
        if (!$tmp_dir || !is_writable($tmp_dir)) {
            $tmp_dir = TEMP_FOLDER;
        }

        $tmp_dir = rtrim($tmp_dir, '/') . '/';
        if (!is_writable($tmp_dir)) {
            header('HTTP/1.0 400');
            echo json_encode([
                "Temporary directory not writable - <b>$tmp_dir</b><br/>Please contact your hosting provider make this directory writable. The directory needs to be writable for the update files.",
                ]);
            die;
        }

        $this->tmp_dir        = $tmp_dir;
        $tmp_dir              = $tmp_dir . 'v' . $latest_version . '/';
        $this->tmp_update_dir = $tmp_dir;

        if (!is_dir($tmp_dir)) {
            mkdir($tmp_dir, 0755);
            fopen($tmp_dir . 'index.html', 'w');
        }

        $zipFile = $tmp_dir . $latest_version . '.zip'; // Local Zip File Path
        $zipResource = fopen($zipFile, 'w+');
        $this->agent          = $this->request->getUserAgent();

        // Get The Zip File From Server
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT,$this->agent->getAgentString());
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 300);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_FILE, $zipResource);
        curl_setopt($ch, CURLOPT_POSTFIELDS, [
                'base_url'        => site_url(),
                'running_version' => $product_version,
                'purchase_key'    => $purchase_key,
                'product_key'     => $product_key,
                'user_ip'         => $this->request->getIpAddress(),
                'server_ip'       => $_SERVER['SERVER_ADDR'],
            ]);

        $success = curl_exec($ch);
        if (!$success) {
            $this->clean_tmp_files();

            $response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if (curl_errno($ch)) {
                print "Error: " . curl_error($ch);

            }
        }

        curl_close($ch);

        $file_path = FCPATH;
        $zip = new \ZipArchive;
        if ($zip->open($zipFile) === true) {

            for( $i = 0; $i < $zip->numFiles; $i++ ){ 
                $stat = $zip->statIndex( $i ); 
                $sqlExist = explode('.', (basename($stat['name']).PHP_EOL ));

                if (isset($sqlExist[1]) && trim($sqlExist[1])=="sql") {
                    $file_path .= $stat['name'];
                }
            }

            if (!$zip->extractTo(FCPATH)) {
                header('HTTP/1.0 400 Bad error');
                echo json_encode([
                    'Failed to extract downloaded zip file',
                    ]);
            }else{
                $path = FCPATH.'system/Security/lic.php';  
                if (file_exists($path)) {
                    // Open the file
                    $whitefile = file_get_contents($path);
                    //set license key configuration
                    $new  = str_replace(@$product_version, @$latest_version, $whitefile);

                    // Write the new database.php file
                    $handle = fopen($path,'w+');

                    // Chmod the file, in case the user forgot
                    @chmod($path, 0777);

                    // Verify file permissions
                    if (is_writable($path)) {
                        // Write the file
                        if (fwrite($handle,$new)) {
                            @chmod($path,0755);

                            //Wait 5 seconds and install database
                            sleep(2);
                            $this->database(@$file_path);

                            return true;
                        } else {
                        //file not write
                            return false;
                        }
                    } else {
                        //file is not writeable
                        return false;
                    }
                } else {
                    //file is not exists
                    return false;
                }
            }

            $zip->close();

        } else {
            header('HTTP/1.0 400 Bad error');
            echo json_encode([
                'Failed to open downloaded zip file',
            ]);
        }

        $this->clean_tmp_files();
    }

    
   private function database($file_path = null)
    {
        $sql_contents = file_get_contents($file_path);
        $sql_contents = explode(";", $sql_contents);

        foreach($sql_contents as $query)
        {
            $pos = strpos($query, 'ci_sessions');
            if($pos == false)
            {
                $result = $this->db->query($query);
            }
            else
            {
                continue;
            }
        }

    }

    private function clean_tmp_files()
    {
        if (is_dir($this->tmp_update_dir)) {
            if (@!$this->delete_dir($this->tmp_update_dir)) {
                @rename($this->tmp_update_dir, $this->tmp_dir . 'delete_this_' . uniqid());
            }
        }
    }

    /**
     * Return server temporary directory
     * @return string
    **/
    private function get_temp_dir()
    {
        if (function_exists('sys_get_temp_dir')) {
            $temp = sys_get_temp_dir();
            if (@is_dir($temp) && is_writable($temp)) {
                return rtrim($temp, '/\\') . '/';
            }
        }

        $temp = ini_get('upload_tmp_dir');
        if (@is_dir($temp) && is_writable($temp)) {
            return rtrim($temp, '/\\') . '/';
        }

        $temp = TEMP_FOLDER;
        if (is_dir($temp) && is_writable($temp)) {
            return $temp;
        }

        return '/tmp/';
    }

    /**
     * Delete directory
     * @param  string $dirPath dir
     * @return boolean
    **/
    private function delete_dir($dirPath)
    {
        if (!is_dir($dirPath)) {
            throw new InvalidArgumentException("$dirPath must be a directory");
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                delete_dir($file);
            } else {
                unlink($file);
            }
        }
        if (rmdir($dirPath)) {
            return true;
        }

        return false;
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

    private function product_key(){

        //Current Version
        $product_key     = '';
        $path = FCPATH.'system/Security/lic.php';  
        if (file_exists($path)) {
            
            // Open the file
            $whitefile = file_get_contents($path);

            $file = fopen($path, "r");
            $j    = 0;
            $product_version_tmp = array();
            $product_key_tmp = array();
            while (!feof($file)) {
                $line_of_text = fgets($file);
 
                if (strstr($line_of_text, 'product_key') && $j==0) {
                    $product_key_tmp = explode('=', strstr($line_of_text, 'product_key'));
                    $j++;
                }                
            }
            fclose($file);

            $product_key = trim(@$product_key_tmp[1]);
            $product_key = ltrim(@$product_key, '\'');
            $product_key = rtrim(@$product_key, '\';');

            return @$product_key;
            
        } else {
            //file is not exists
            return false;
        }

    }

    public function cancel_notification()
    {    
        $id = $this->request->getVar('id');
        $data = array('update_notification' =>0 , );
        $query = $this->db->table('setting');   
        $query->where('setting_id', $id);
        $cancel_notification =  $query->update($data);

        if($cancel_notification){

            echo 1;

        } else {
            
            echo 0;
        }  
    }

    public function downloaded_database() {
        
        $db_name = 'backup' . '.sql';
       $this->dbutil =  (new \CodeIgniter\Database\Database())->loadUtils($this->db);
        $prefs = array(
            'format'   => 'sql',
            'filename' => 'backup.sql');
        $b         = $this->dbutil->backup($prefs);
        $save      = 'assets/data/backup/' . $db_name;
        helper(['filesystem','form','url','database','text','download']);
        $username  = $this->db->username;
        $backup    =  $b;
        write_file($save, $backup);
        force_download('./assets/data/backup/' . $db_name, NULL);
    }
}