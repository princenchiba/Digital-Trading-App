<?php
/*
 * @System      : Software Addon Module
 * @developer   : Md.Mamun Khan Sabuj
 * @E-mail      : mamun.sabuj24@gmail.com
 * @datetime    : 10-10-2020
 * @version     : Version 1.0
 */

namespace App\Modules\Addon\Controllers;
helper('inflector');
class Theme extends BaseController {

  private $theme_tbl = 'themes';
  private $theme_location = APPPATH.'Views/website/';

  public function index()
  {
    $active_theme = $this->themes_model->get_theme();
    $themes = $this->themes_model->get_themes();

    $installed_themes = $this->themes_model->get_installed_themes_ids();
    $json_theme = $this->addons_model->search_available_themes();

    $new_items = [];
    if(!empty($json_theme)){
      $new_items = json_decode($json_theme);
  }
  $data = array(
      'title'       => display('themes'), 
      'active_theme' => $active_theme,
      'themes' => $themes,
      'new_items' => $new_items,
      'installed' => $installed_themes
  );

  $data['title']  = display('theme_list');
  $data['module'] = "Addon";
  $data['page']   = 'theme/list'; 
  return $this->template->layout($data);
}

public function active_theme($name)
{
    $builder=$this->db->table('themes');
    $activedata = array('status' => 1);
    $deactivedata = array('status' => 0);
    $builder->where('name', $name)->update($activedata);
    $builder->where('name !=', $name)->update($deactivedata);
    $this->session->setFlashdata('message', display('theme_active_successfully'));
    return redirect()->to(base_url('admin/addon/theme'));

}

    #------------------------------------
    # To upload new theme
    #------------------------------------
public function upload_new_theme()
{
  $this->validation->setRule('purchase_key', display('purchase_key'), 'required');
  $this->validation->setRule('theme_name', display('theme_name'), 'required');
  $this->validation->setRule('new_theme', display('upload'), 'uploaded[new_theme]|ext_in[new_theme,zip]');

  if ($this->validation->withRequest($this->request)->run()) {

    $purchase_key = trim($this->request->getVar('purchase_key',FILTER_SANITIZE_STRING));
    $theme_name = trim($this->request->getVar('theme_name',FILTER_SANITIZE_STRING));

    $getdata = "item=theme&purchase_key=".$purchase_key;

            // Check purchase key 
    $response = $this->addons_model->verify_zip_upload($getdata);

    if(!empty($response) && ($response->status == 'valid')) {
        $filename = $_FILES["new_theme"]["name"];
        $source = $_FILES["new_theme"]["tmp_name"];
        $type = $_FILES["new_theme"]["type"];
        $target_dir = 'app/Views/website/';

                // naming for theme
        if ($theme_name !== '') {
            $dir = underscore(strtolower($theme_name));
            $target_dir = 'app/Views/website/';
        }

        ini_set('memory_limit', '800M');
        ini_set('upload_max_filesize', '800M');
        ini_set('post_max_size', '800M');
        ini_set('max_input_time', 3600);
        ini_set('max_execution_time', 3600);

        $file = '';
        if($file = $this->request->getFile('new_theme', FILTER_SANITIZE_STRING))
        {
            if ($file->isValid() && ! $file->hasMoved())
            {
              $file->move($target_dir,$dir);
              $name = explode(".", $filename);
              $zip = new \ZipArchive();
              $x = $zip->open($target_dir.$dir);
              if ($x === true) {
                        $zip->extractTo($target_dir); // place in the directory with same name
                        
                        $zip->close();
                        @unlink($target_dir.$dir); // delete zip file
                        chmod($target_dir . $name[0], 0777); //change uploaded file permission
                        $this->themes_model->store($name[0]); //insert store name into database
                        $sdata['message'] = display("theme_uploaded_successfully");
                    } else {
                        $sdata['exception'] = display("there_was_a_problem_with_the_upload");
                    }
                    $this->session->setFlashdata($sdata);
                    return redirect()->to(base_url('admin/addon/theme'));

                } else {

                    $sdata['exception'] = display("there_was_a_problem_with_the_upload");
                    $this->session->setFlashdata($sdata);
                    return redirect()->to(base_url('admin/addon/theme'));
                }     
            }

        } else {
            $this->session->setFlashdata('exception',display("invalid_purchase_key"));
            return redirect()->to(base_url('admin/addon/theme'));
        }
    }

    $this->session->setFlashdata('exception',$this->validation->listErrors());
    return redirect()->to(base_url('admin/addon/theme'));
}


    // Unzip Files
private function unzip_files($zip_file)
{

    $path = pathinfo( realpath( $zip_file ), PATHINFO_DIRNAME );

    $zip = new \ZipArchive;
    $res = $zip->open($zip_file);
    if ($res === TRUE) {
        $zip->extractTo( $path );
        $zip->close();
    }
    return $res;
}

    // Download Theme
public function download_theme(){

    $data['title'] = display('themes');
    $data['module'] = "Addon";
    $data['page']   = 'theme/download'; 
    return $this->template->layout($data);
}

    // Verify Theme Purchase
public function verify_theme_download() 
{

    $purchase_key = trim($this->request->getVar('purchase_key',FILTER_SANITIZE_STRING));

    if(!empty($purchase_key)){

        $getdata = "item=theme&purchase_key=".$purchase_key;

        $result = $this->addons_model->purchase_new_theme($getdata);

        if ($result->status == 'valid') {

          $filename = "New_theme_".time().'.zip';
          $destination = $this->theme_location.$filename;
          $copydata = copy($result->download_url, $destination);

          if($copydata) 
          {
                    // unzip files
            $unzip = $this->unzip_files($destination);
            if($unzip) {
                unlink($destination);

                $tdata = array(
                    'name' => $result->identity,
                    'status' => 0
                );
                $result = $this->db->table($this->theme_tbl)->insert($tdata);

                if($result){
                    $this->session->setFlashdata('message', display('downloaded_successfully'));
                    echo TRUE;
                    exit();
                }
            }
        }
    } 
} 
$this->session->setFlashdata('error_message', display('failed_try_again'));
echo false;
}


    // Recursivly Delete a whole directory
private function delete_dir($dirPath)
{
  $dir = opendir($dirPath);
  while (false !== ($file = readdir($dir))) {
    if (($file != '.') && ($file != '..')) {
      if (is_dir($dirPath . '/' . $file)) {
        $this->delete_dir($dirPath . '/' . $file);
    } else {
        unlink($dirPath . '/' . $file);
    }
}
}
closedir($dir);
rmdir($dirPath);
return true;
}

    // Theme Delete
public function theme_delete($theme_name=null)
{

    $result = false;
    if(!empty($theme_name)){

      $where = array(
        'name' => $theme_name
    );
      $result = $this->db->table('themes')->where($where)->delete();
      if($result){
        $theme_path = $this->theme_location.$theme_name;
        $this->delete_dir($theme_path);
    }
}
$this->session->setFlashdata('message',display('delete_Successfully'));
return redirect()->to(base_url('admin/addon/theme'));
}
}