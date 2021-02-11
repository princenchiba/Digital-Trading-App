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
class Module extends BaseController
{

    public function index()
    {

        $modulesnames = $this
            ->addons_model
            ->get_downloaded_modules();
        $json_module = $this
            ->addons_model
            ->search_available_modules();

        $live_modules = [];
        if (!empty($json_module))
        {
            $live_modules = json_decode($json_module);
        }

        $data['live_modules'] = $live_modules;
        $data['downloaded'] = $modulesnames;

        $data['title'] = display('module_list');
        $data['module'] = "Addon";
        $data['page'] = 'module/list';
        return $this
            ->template
            ->layout($data);
    }

    public function upload()
    {

        $this
            ->validation
            ->setRule('purchase_key', display('purchase_key') , 'required');
        $this
            ->validation
            ->setRule('module', display('module') , 'uploaded[module]|ext_in[module,zip,rar,gz]');

        if ($this
            ->validation
            ->withRequest($this->request)
            ->run())
        {

            $purchase_key = trim($this
                ->request
                ->getPost('purchase_key', FILTER_SANITIZE_STRING));

            $getdata = "item=module&purchase_key=" . $purchase_key;

            // Check purchase key
            $response = $this
                ->addons_model
                ->verify_zip_upload($getdata);

            if (!empty($response) && ($response->status == 'valid'))
            {

                $config['upload_path'] = 'app/Modules/';

                $overwrite = $this
                    ->request
                    ->getVar('overwrite', FILTER_SANITIZE_STRING);
                $overwrite = (($overwrite != null) ? $overwrite : false);
                if ($file = $this
                    ->request
                    ->getFile('module', FILTER_SANITIZE_STRING))
                {
                    if ($file->isValid() && !$file->hasMoved())
                    {
                        $fileName = underscore(strtolower($file->getName()));
                        $file->move($config['upload_path'], $fileName);
                        $name = explode(".", $fileName);
                        $filePath = $config['upload_path'] . $fileName;

                        $result = $this
                            ->unzip
                            ->extract($filePath, $config['upload_path'], true, $overwrite);
                        if ($result->status)
                        {
                            $this
                                ->themes_model
                                ->store($name[0]); //insert store name into database
                            $this
                                ->session
                                ->setFlashdata('message', display("theme_uploaded_successfully"));
                        }
                        else
                        {
                            $this
                                ->session
                                ->setFlashdata('exception', display("there_was_a_problem_with_the_upload"));
                        }
                    }
                    else
                    {
                        $this
                            ->session
                            ->setFlashdata('exception', display("invalid_purchase_key"));

                    }
                    return redirect()
                        ->to(base_url('admin/addon'));
                }
                else
                {
                    $this
                        ->session
                        ->setFlashdata('exception', display("invalid_purchase_key"));
                }
                return redirect()
                    ->to(base_url('admin/addon'));
            }
            else
            {
                $this
                    ->session
                    ->setFlashdata('exception', display("invalid_purchase_key"));

                return redirect()
                    ->to(base_url('admin/addon'));
            }
        }

        $this
            ->session
            ->setFlashdata('exception', $this
            ->validation
            ->listErrors());
        return redirect()
            ->to(base_url('admin/addon'));
    }

    public function install()
    {
        $this
            ->validation
            ->setRule('name', display('module_name') , 'required|max_length[50]');
        $this
            ->validation
            ->setRule('description', display('description') , 'max_length[50]');
        $this
            ->validation
            ->setRule('image', display('image') , 'max_length[100]');
        $this
            ->validation
            ->setRules(['directory' => 'required|max_length[100]|is_unique[module.directory]'], ['directory' => ['is_unique' => 'The %s is already installed']]);

        /*-----------------------------------*/
        $directory = $this
            ->request
            ->getVar('directory');

        /*-----------ADD TO MODULE--------------*/
        $moduleData = array(
            'id' => $this
                ->request
                ->getVar('id', FILTER_SANITIZE_STRING) ,
            'name' => $this
                ->request
                ->getVar('name', FILTER_SANITIZE_STRING) ,
            'description' => $this
                ->request
                ->getVar('description') ,
            'image' => $this
                ->request
                ->getVar('image', FILTER_SANITIZE_STRING) ,
            'directory' => $directory,
            'status' => 1
        );
        /*-----------------------------------*/
        if ($this
            ->validation
            ->withRequest($this->request)
            ->run())
        {

            /*----------MODULE INSTALL------------*/
            // IMPORT DATABASE
            $dbPath = APPPATH . 'modules/' . $directory . '/assets/data/database.sql';
            $configPath = APPPATH . 'modules/' . $directory . '/config/config.php';
            if (file_exists($dbPath) && file_exists($configPath))
            {
                $isi_file = file_get_contents($dbPath);
                $string_query = rtrim($isi_file, "\n;");
                $array_query = explode(";", $string_query);
                $newQuery = null;
                $succe = array();
                $error = null;
                $sl = 1;

                @include ($configPath);

                if (($HmvcConfig[$directory]["_database"] === true) && !empty($HmvcConfig[$directory]["_tables"]) && is_array($HmvcConfig[$directory]["_tables"]) && sizeof($HmvcConfig[$directory]["_tables"]) > 0)
                {

                    // Tables data
                    foreach ($HmvcConfig[$directory]["_tables"] as $key => $table)
                    {

                        foreach ($array_query as $key2 => $query)
                        {

                            if (is_int(strpos($query, "`$table`")))
                            {
                                $succe[] = $table;
                                $newQuery .= $query . ";";
                                unset($HmvcConfig[$directory]["_tables"][$key]);
                                unset($array_query[$key2]);
                                break;
                            }
                            else
                            {
                                $error .= "`$table`";
                                unset($HmvcConfig[$directory]["_tables"][$key]);
                                break;
                            }
                        }
                    }

                    if (strlen($error) > 0)
                    {
                        $this
                            ->session
                            ->setFlashdata('exception', $error . display('tables_are_not_available_in_database'));
                        return redirect()->to(base_url("admin/addon"));
                    }
                    else
                    {
                        $n_query = rtrim($newQuery, "\n;");
                        $n_query = explode(";", $n_query);
                        $i = 0;
                        foreach ($n_query as $sql)
                        {
                            if (!$this
                                ->db
                                ->tableExists($succe[$i++]))
                            {
                                $this
                                    ->db
                                    ->query("SET FOREIGN_KEY_CHECKS = 0");
                                $this
                                    ->db
                                    ->query($sql);
                                $this
                                    ->db
                                    ->query("SET FOREIGN_KEY_CHECKS = 1");
                            }
                        }

                        /*----------ADD TO MODULE ------------*/
                        if ($this
                            ->module_model
                            ->create($moduleData))
                        {
                            // add a install flag
                            @file_put_contents(APPPATH . 'modules/' . $directory . '/assets/data/env', date('d-m-Y'));

                            $this
                                ->session
                                ->setFlashdata('message', display('module_added_successfully'));
                        }
                        else
                        {
                            $this
                                ->session
                                ->setFlashdata('exception', display('please_try_again'));
                        }
                    }
                }
                else if ($HmvcConfig[$directory]["_database"] === false)
                {
                    /*----------ADD TO MODULE ------------*/
                    if ($this
                        ->module_model
                        ->create($moduleData))
                    {
                        // add a install flag
                        @file_put_contents(APPPATH . 'modules/' . $directory . '/assets/data/env', date('d-m-Y'));

                        $this
                            ->session
                            ->setFlashdata('message', display('module_added_successfully'));
                    }
                    else
                    {
                        $this
                            ->session
                            ->setFlashdata('exception', display('please_try_again'));
                    }
                }
                else
                {
                    $this
                        ->session
                        ->setFlashdata('exception', display('no_tables_are_registered_in_config'));
                }

                // Data insert/update into existing table
                if ($HmvcConfig[$directory]["_extra_query"] === true)
                {
                    $extra_query = APPPATH . 'modules\\' . $directory . '\assets\data\install.sql';
                    if (file_exists($extra_query))
                    {

                        $equery_file = file_get_contents($extra_query);
                        $equery_string = trim($equery_file);

                        if (!empty($equery_string))
                        {

                            $equery_list = explode(";", $equery_string);
                            $this
                                ->db
                                ->transStart();
                            foreach ($equery_list as $equery_item)
                            {
                                if (!empty($equery_item))
                                {
                                    $this
                                        ->db
                                        ->query($equery_item);
                                }
                            }
                            $this
                                ->db
                                ->transComplete();
                        }
                    }
                }

            }
            else
            {
                $this
                    ->session
                    ->setFlashdata('exception', display('please_try_again'));
            }
            return redirect()
                ->to(base_url("admin/addon"));

        }
        else
        {
            $this
                ->session
                ->setFlashdata('exception', $this
                ->validation
                ->listErrors());
        }
        return redirect()
            ->to(base_url("admin/addon"));
    }

    // Uninstall Module
    public function uninstall($dirPath = null, $action = null)
    {

        $directory = $dirPath;
        $basePath = "app/Modules/";
        $dirPath = $basePath . urldecode($dirPath);

        if (is_dir($dirPath) && $dirPath != $basePath)
        {

            /*-------DELETE MODULE DATABASE---------*/
            $configPath = APPPATH . 'Modules/' . $directory . '/config/config.php';

            if (file_exists($configPath))
            {

                @include ($configPath);

                if (!empty($HmvcConfig[$directory]["_tables"]) && is_array($HmvcConfig[$directory]["_tables"]) && sizeof($HmvcConfig[$directory]["_tables"]) > 0)
                {

                    foreach ($HmvcConfig[$directory]["_tables"] as $table)
                    {
                        if ($this
                            ->db
                            ->tableExists($table))
                        {
                            $this
                                ->db
                                ->query("DROP TABLE `$table`");
                        }
                    }
                }
            }

            // Uninstall Extra query
            if ($HmvcConfig[$directory]["_extra_query"] === true)
            {

                $extra_query = APPPATH . 'modules/' . $directory . '/assets/data/uninstall.sql';
                if (file_exists($extra_query) && file_exists($configPath))
                {

                    $equery_file = file_get_contents($extra_query);
                    $equery_string = trim($equery_file);

                    if (!empty($equery_string))
                    {

                        $equery_list = explode(";", $equery_string);
                        $this
                            ->db
                            ->transStart();
                        foreach ($equery_list as $equery_item)
                        {
                            if (!empty($equery_item))
                            {
                                $this
                                    ->db
                                    ->query($equery_item);
                            }
                        }
                        $this
                            ->db
                            ->transComplete();
                    }
                }
            }

            if ($action == "delete")
            {
                $this->delete_dir($dirPath);
            }
            /*-------DELETE FROM MODULE LIST---------*/
            $this
                ->module_model
                ->delete_by_directory($directory);
            //delete the install flag
            if (file_exists(APPPATH . 'modules/' . $directory . '/assets/data/env')) @unlink(APPPATH . 'modules/' . $directory . '/assets/data/env');

            $this
                ->session
                ->setFlashdata('message', display('delete_successfully'));

        }
        else if (is_file($dirPath) && $dirPath != $basePath)
        {

            if (unlink($dirPath))
            {
                $this
                    ->session
                    ->setFlashdata('message', display('delete_successfully'));
            }
            else
            {
                $this
                    ->session
                    ->setFlashdata('exception', display('please_try_again'));
            }
        }
        else
        {
            $this
                ->session
                ->setFlashdata('exception', display('please_try_again'));
        }

        return redirect()
            ->to($_SERVER['HTTP_REFERER']);
    }

    // Change Module Status
    public function status($id = null, $action = null)
    {
        $action = ($action == 'active' ? 1 : 0);

        $data = array(
            'id' => $id,
            'status' => $action
        );

        if ($this
            ->module_model
            ->update($data))
        {
            $this
                ->session
                ->setFlashdata('message', display('update_successfully'));
        }
        else
        {
            $this
                ->session
                ->setFlashdata('exception', display('please_try_again'));
        }

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function delete_dir($dirPath)
    {

        $dir = opendir($dirPath);
        while (false !== ($file = readdir($dir)))
        {
            if (($file != '.') && ($file != '..'))
            {
                if (is_dir($dirPath . '/' . $file))
                {
                    $this->delete_dir($dirPath . '/' . $file);
                }
                else
                {
                    unlink($dirPath . '/' . $file);
                }
            }
        }
        closedir($dir);
        rmdir($dirPath);
        return true;
    }

    // Download Module
    public function download_module()
    {

        $data = array(
            'title' => display('download')
        );

        $data['module'] = "Addon";
        $data['page'] = 'module/download';
        return $this
            ->template
            ->layout($data);

    }

    // Unzip Files
    private function unzip_files($zip_file)
    {

        $path = pathinfo(realpath($zip_file) , PATHINFO_DIRNAME);

        $zip = new \ZipArchive;
        $res = $zip->open($zip_file);
        if ($res === true)
        {
            $zip->extractTo($path);
            $zip->close();
        }
        return $res;

    }

    // Verify Module
    public function verify_download_request()
    {

        $purchase_key = $this
            ->request
            ->getVar('purchase_key', FILTER_SANITIZE_STRING);
        $itemtype = $this
            ->request
            ->getVar('itemtype', FILTER_SANITIZE_STRING);

        if (!empty($purchase_key) && !empty($itemtype))
        {

            $getdata = "item=module&purchase_key=" . trim($purchase_key);

            $result = $this
                ->addons_model
                ->send_download_request($getdata);

            if ($result->status == 'valid')
            {

                $filename = "New_module_" . time() . '.zip';
                $destination = APPPATH . 'modules/' . $filename;
                $copydata = copy($result->download_url, $destination);

                if ($copydata)
                {
                    // unzip files
                    $unzip = $this->unzip_files($destination);
                    if ($unzip)
                    {
                        unlink($destination);
                        // Module Json File
                        $this
                            ->session
                            ->setFlashdata('message', "Downloaded Successfully");
                        echo true;
                        exit();

                    }

                }
            }
        }
        $this
            ->session
            ->setFlashdata('exception', "Invalid Request");
        echo false;

    }
}

