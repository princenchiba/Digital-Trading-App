<?php 
    $this->db = db_connect(); 
    helper('filesystem');
?>
<link href="<?php echo base_url('app/Modules/Addon/assets/css/style.css'); ?>" rel="stylesheet" type="text/css"/>
<!-- Add new customer start -->

        <?php view('template/messages'); ?>

         <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="fs-17 font-weight-600 mb-0"><?php echo (!empty($title)?$title:null) ?></h6>
                            </div>
                            <div class="text-right">
                                <div class="actions">
                                    <a href="<?php echo base_url('admin/addon/download_module')?>" class="btn btn-success m-b-5 m-r-2"><i class="ti-download"> </i> <?php echo display('download')?></a>
                                    <a href="" class="action-item"><i class="ti-reload"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>            
                    <div class="card-body">
                        <?php echo form_open_multipart("admin/addon/upload") ?>
                            <div class="row">
                                <div class="col-sm-3">
                                    <label><?php echo display('purchase_key');?> <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" data-placement="bottom" title="Enter Envato purchase key or Bdtask purchase key"></span></label>
                                    <input type="text" name="purchase_key" placeholder="<?php echo display('purchase_key') ?>" class="form-control" required/>
                                </div>

                                <div class="col-sm-3">
                                    <label class="form-label" for="module"><?php echo display('module') ?> (.zip | .rar | .gz)</label>
                                    <input type="file" name="module" class="form-control" required>
                                </div> 
                                <div class="col-sm-1">
                                    <label class="form-label" for="">&nbsp;</label>
                                    <div class="pull-left overwrite">
                                        <input type="checkbox" name="overwrite"  value="false" id="overwrite"> <label for="overwrite"><?php echo display("overwrite") ?></label>
                                    </div>
                                </div>
                                <div class="col-sm-1 themeupload">
                                    <label class="form-label" for="">&nbsp;</label>
                                    <button type="submit" class="btn btn-success pt10"><?php echo display('add_module') ?></button>
                                </div> 
                            </div>
                        <?php echo form_close() ?>
                            <hr/>

                            <div class="row">
                                <?php if(!empty($live_modules)){
                                    foreach ($live_modules as $livemod) {

                                        if(!in_array($livemod->identity, $downloaded)){
                                 ?>

                                 <div class="col-md-4 addonsbox">
                                    <div class="thumbnail">
                                        <div class="addon_img">
                                            <img src="<?php echo (!empty($livemod->thumb)?$livemod->thumb:NO_IMAGE) ?>" alt="" class="mod_thumb_img">
                                        </div>
                                      <div class="caption">
                                        <h3><span class="addon_title"> <?php echo esc($livemod->module_name); ?></span>

                                        <span class="price addon_price">$<?php echo number_format($livemod->price,2); ?></span>

                                        </h3>
                                        <p class="caption_desc"><?php echo $livemod->short_description; ?></p>
                                        <p>
                                            <a href="<?php echo $livemod->payment_url; ?>" target="_blank" role="button"  class="btn btn-success" ><?php echo display('buy_now') ?></a>
                                        </p>

                                      </div>
                                    </div>
                                </div>

                                <?php } } } ?>
                                <!-- lan list of downloaded module without Default Modules -->
                                <?php
                                $path = 'app/Modules/';
                                $map  = directory_map($path);
                                $def_mods = ['Admin','Autoupdate','Backend','Cms','Exchange','Finance', 'Dashboard','Settings','Trade','User', 'Website','Addon'];
                                if (is_array($map))
                                //extract each directory 
                                foreach ($map as $key => $value) {
                                    $key = str_replace("\\", '/', $key);
                                    $mod = str_replace("/", '', $key);
                                    
                                    //chek directory is not default modules
                                    if ($value != "index.html" && !in_array($mod, $def_mods)) {
                                        // set the default config path
                                        $file = $path.$key.'config/config.php';
                                        $image = $path.$key.'assets/images/thumbnail.jpg';
                                        $css  = $path.$key.'assets/css/style.css';
                                        $js   = $path.$key.'assets/js/script.js';
                                        $db   = $path.$key.'assets/data/database.sql';
                                        $delMod = ((!is_array($value) && $value!='index.html')?$value:(is_array($value)?$mod:null)); 
                                        //check database.sql and config.php 
                                        if (file_exists($file) && file_exists($db) && file_exists($image)) {
                                            @include($file);
                                        //check the setting of config.php
                                        if (isset($HmvcConfig[$mod])
                                            && is_array($HmvcConfig[$mod])
                                            && array_key_exists('_title', $HmvcConfig[$mod])
                                            && $HmvcConfig[$mod]['_title'] != ''
                                            && array_key_exists('_database', $HmvcConfig[$mod])
                                            && array_key_exists('_description', $HmvcConfig[$mod]) 
                                            && $HmvcConfig[$mod]['_description'] != ''
                                            ) {

                                            
                                        ?>
                                        <!-- lan module information -->
                                        <div class="col-md-4 addonsbox">
                                            <?php 
                                                //form to module 
                                                echo form_open('admin/addon/install');
                                                echo form_hidden('name',$HmvcConfig[$mod]['_title']);
                                                echo form_hidden('image',$image);
                                                echo form_hidden('directory',$mod);
                                                echo form_hidden('description',$HmvcConfig[$mod]['_description']);
                                            ?>
                                            <div class="thumbnail">
                                                <div class="addon_img">
                                              <img src="<?php echo base_url('app/modules/'.$mod.'/assets/images/thumbnail.jpg') ?>" alt="" class="mod_thumb_img">
                                            </div>
                                              <div class="caption">
                                                <h3><?php echo esc(($HmvcConfig[$mod]['_title']!=null)?$HmvcConfig[$mod]['_title']:null) ?></h3>
                                                <p class="caption_desc"><?php echo esc(($HmvcConfig[$mod]['_description']!=null)?$HmvcConfig[$mod]['_description']:null) ?></p>
                                                <p>
                                                    <?php 
                                                    $rows = null;
                                                    $rows = $this->db->table('module')->select("*")
                                                        ->where('directory', $mod);
                                                    if ($rows->countAll() > 0) { 
                                                    ?>
                                                    <a onclick="return confirm('<?php echo display("are_you_sure") ?>')"  href="<?php echo base_url("module/module/uninstall/$delMod") ?>" class="btn btn-danger"><?php echo display("uninstall") ?></a> 
                                                    <?php } else {
                                                            
                                                        if(isset($HmvcConfig[$mod]['_zip_download']) && !empty($HmvcConfig[$mod]['_zip_download'])){

                                                        ?>
                                                         <a onclick="return confirm('<?php echo display("are_you_sure") ?>')"  class="btn btn-success" href="<?php echo base_url($mod.'/zip_download?module='.$mod.'&is_download=yes&downloadas=zip&downloadid='.md5('BDT'.$mod)) ?>" ><?php echo display("download") ?></a>  

                                                        <?php  } else { ?>

                                                        <button onclick="return confirm('<?php echo display("are_you_sure") ?>')" type="submit" class="btn btn-success" role="button"><?php echo display("install") ?></button>  
                                                    <?php } } ?>
                                                    <a  href="<?php echo base_url("admin/addon/uninstall/$delMod/delete") ?>" type="submit" class="btn btn-danger delete_item"><?php echo display("delete") ?></a>
                                                </p>
                                              </div>
                                            </div>
                                        </div>
                                        <?php 
                                            echo form_close();
                                        } else {
                                        ?>
                                         <!-- if module config.php configuration missing -->
                                        <div class="col-md-4  addonsbox">
                                            <div class="thumbnail">
                                                <h3><?php echo display("invalid_module") ?> "<?php echo $mod ?>" </h3>
                                                <div class="caption text-danger">
                                                    <h4>Missing config.php</h4> 
                                                    <ul class="pl_10">
                                                    <?php 
                                                    if (isset($HmvcConfig[$mod])) {
                                                        if (!array_key_exists('_title', $HmvcConfig[$mod]) || $HmvcConfig[$mod]['_title'] == null) {
                                                            echo '<li>$HmvcConfig["'.$mod.'"]["_title"]</li>';
                                                        }      
                                                        if (!array_key_exists('_description', $HmvcConfig[$mod]) || $HmvcConfig[$mod]['_description'] == null) {
                                                            echo '<li>$HmvcConfig["'.$mod.'"]["_description"]</li>';
                                                        }   
                                                    } else {
                                                        echo '<li>$HmvcConfig["'.$mod.'"] is not define</li>';
                                                    }
                                                    ?>

                                                        <li></li>
                                                    </ul>
                                                </div>
                                                <p><a  href="<?php echo base_url("module/module/uninstall/$delMod/delete") ?>" type="submit" class="btn btn-danger delete_item"><?php echo display("delete") ?></a></p>
                                              </div>
                                            </div>
                                        <?php

                                            }
                                            // ends of check the setting of config.php

                                        } else { 
                                        ?>
                                        <!-- if module config.php or database.sql is not found -->
                                        <div class="col-md-4  addonsbox">
                                            <div class="thumbnail"> 
                                                <h3><?php echo display("invalid_module") ?> "<?php echo $delMod ?>"</h3>
                                                <div class="caption text-danger">
                                                    <h4>Missing</h4> 
                                                    <ul class="pl_10">
                                                        <?php 
                                                        if (!file_exists($file)) {
                                                            echo "<li>config/config.php</li>";
                                                        } 
                                                        if (!file_exists($db)) {
                                                            echo "<li>assets/data/database.sql</li>";
                                                        }  
                                                        if (!file_exists($image)) {
                                                            echo "<li>assets/images/thumbnail.jpg</li>";
                                                        } 
                                                        if (!file_exists($css)) {
                                                            echo "<li>assets/css/style.css</li>";
                                                        } 
                                                        if (!file_exists($js)) {
                                                            echo "<li>assets/js/script.js</li>";
                                                        }    
                                                        ?> 
                                                    </ul>
                                                </div>
                                                <p><a  href="<?php echo base_url("admin/addon/uninstall/$delMod/delete") ?>" type="submit" class="btn btn-danger delete_item"><?php echo display("delete") ?></a></p>
                                            </div>
                                        </div>   
                                <?php 
                                        }
                                    }
                                }   
                                ?>
                        </div> 
                             
                    </div> 
                </div>
            </div>
        </div>
 
<script src="<?php echo base_url().'/app/Modules/Addon/assets/ajaxs/addons/module.js' ?>"></script>
<script src="<?php echo base_url().'/app/Modules/Addon/assets/ajaxs/addons/sweetalert/sweetalert.min.js' ?>"></script>

