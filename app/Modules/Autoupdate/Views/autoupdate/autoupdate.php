<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fs-17 font-weight-600 mb-0"></h6>
                    </div>
                    <div class="text-right">
                        <div class="actions">
                            <a href="#" class="action-item"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
            <?php 
                
                if ($latest_version < $current_version) { 
            ?>
                <?php echo form_open_multipart("admin/autoupdate/update") ?>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <blink class="text-success text-center updatecss"><?php if(empty($exception_txt)) echo htmlspecialchars_decode($message_txt) ?></blink>
                            <blink class="text-waring text-center updatecss"><?php if(empty($message_txt)) echo htmlspecialchars_decode($exception_txt); ?></blink>
                            <div class="row">
                                <div class="col-sm-3">&nbsp;</div>
                                <div class="col-sm-3">
                                    <div class="alert alert-success text-center updatebox"><?php echo display('latest-version');?> <br>V-<?php echo esc($latest_version) ?></div>
                                </div> 
                                <div class="col-sm-3">
                                    <div class="alert alert-danger text-center updatebox"><?php echo display('current-version');?> <br>V-<?php echo esc($current_version) ?></div>
                                </div>
                                <div class="col-sm-3">&nbsp;</div>
                            </div>
                        </div>
                    </div>
                   
                    <div class="row">
                        <div class="form-group col-sm-3">&nbsp;</div>
                        <div class="form-group col-sm-6">
                            <p class="alert updatenote">note: strongly recomanded to backup your <b>SOURCE FILE</b> and <b>DATABASE</b> before update.</p>
                            <label>Licence/Purchase key <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="purchase_key">
                            <div class="mt-2">
                                <button type="submit" class="btn btn-success col-sm-offset-5 mt-2" onclick="return confirm('are you sure want to update?')"><i class="fa fa-wrench" aria-hidden="true"></i> <?php echo display('update'); ?></button>
                                <?php if($settings_info->update_notification == 1){ ?>
                                    <button type="button" class="btn btn-danger mt-2" onclick="cancel_upnotification(<?php echo $settings_info->setting_id ?>)"><i class="far fa-bell-slash"></i> <?php echo "Cancel Update Notification";?></button>
                                <?php } ?>
                                <a class="btn btn-warning mt-2 text-white" href="<?php echo base_url('admin/autoupdate/backup-database'); ?>"><i class="fas fa-database"></i> <?php echo "Backup Database";?></a>
                            </div>
                        </div>
                        <div class="form-group col-sm-3">&nbsp;</div>
                    </div> 
                    
                <?php echo form_close() ?>

                <?php } else {  ?>
                    <div class="row">
                        <div class="col-lg-4">&nbsp;</div>
                        <div class="col-lg-4 text-center">
                            <div class="alert alert-success text-center updatebox"><?php echo display('current-version');?> <br>V-<?php echo esc($current_version) ?></div>
                            <h2 class="text-center"><?php echo display('no-update-available'); ?></h2>
                        </div>
                        <div class="col-lg-4">&nbsp;</div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
