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
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="border_preview">
                        <?php echo form_open_multipart('admin/setting/app-setting','class="form-inner"') ?>

                        <input type="hidden" name="setting_id" value="<?php echo $setting->setting_id; ?>">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="title" class="col-sm-4 col-form-label font-weight-600"><?php echo display('application_title') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <input name="title" type="text" class="form-control" id="title" placeholder="<?php echo display('application_title') ?>" value="<?php echo esc($setting->title) ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="description" class="col-sm-4 col-form-label font-weight-600"><?php echo display('address') ?></label>
                                    <div class="col-sm-8">
                                        <input name="description" type="text" class="form-control" id="description" placeholder="<?php echo display('address') ?>"  value="<?php echo htmlspecialchars_decode(
                                        $setting->description) ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-4 col-form-label font-weight-600"><?php echo display('email')?></label>
                                    <div class="col-sm-8">
                                        <input name="email" type="text" class="form-control" id="email" placeholder="<?php echo display('email')?>"  value="<?php echo esc($setting->email) ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="phone" class="col-sm-4 col-form-label font-weight-600"><?php echo display('phone') ?></label>
                                    <div class="col-sm-8">
                                        <input name="phone" type="text" class="form-control" id="phone" placeholder="<?php echo display('phone') ?>"  value="<?php echo esc($setting->phone) ?>" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="time_zone" class="col-sm-4 col-form-label font-weight-600"><?php echo display('time_zone') ?>  <i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <select id="time_zone" name="time_zone" class="form-control">
                                            <option value=""><?php echo display('select_option') ?></option>
                                            <?php foreach (timezone_identifiers_list() as $value) { ?>
                                                <option value="<?php echo esc($value) ?>" <?php echo (($setting->time_zone==$value)?'selected':null) ?>><?php echo esc($value) ?></option>";
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="office_time" class="col-sm-4 col-form-label font-weight-600"><?php echo display('office_time') ?></label>
                                    <div class="col-sm-8">
                                        <textarea name="office_time" class="form-control"  placeholder="<?php echo display('office_time') ?>" maxlength="255" rows="5"><?php echo htmlspecialchars_decode($setting->office_time) ?></textarea>
                                    </div>
                                </div> 

                                <div class="form-group row">
                                    <label for="footer_text" class="col-sm-4 col-form-label font-weight-600"><?php echo display('footer_text') ?></label>
                                    <div class="col-sm-8">
                                        <textarea name="footer_text" class="form-control"  placeholder="Footer Text" maxlength="140" rows="5"><?php echo esc($setting->footer_text) ?></textarea>
                                    </div>
                                </div> 
                            </div>
                            <div class="col-sm-6">
                                <?php if(!empty($setting->favicon)) {  ?>
                                    <div class="form-group row">
                                        <label for="faviconPreview" class="col-sm-4 col-form-label font-weight-600"></label>
                                        <div class="col-sm-8">
                                            <img src="<?php echo base_url($setting->favicon) ?>" alt="Favicon" class="img-thumbnail" />
                                        </div>
                                    </div>
                                <?php } ?>

                                <div class="form-group row">
                                    <label for="favicon" class="col-sm-4 col-form-label font-weight-600"><?php echo display('favicon') ?> </label>
                                    <div class="col-sm-8">
                                        <input type="file" name="favicon" id="favicon">
                                        <span class="mention-text">32x32px(jpg, jpeg, png, gif, ico)</span>
                                        <input type="hidden" name="old_favicon" value="<?php echo esc($setting->favicon) ?>">
                                    </div>
                                </div>
                                <!-- if setting logo is already uploaded -->
                                <?php if(!empty($setting->logo)) {  ?>
                                    <div class="form-group row">
                                        <label for="logoPreview" class="col-sm-4 col-form-label font-weight-600"></label>
                                        <div class="col-sm-8">
                                            <img src="<?php echo base_url(esc($setting->logo)) ?>" alt="Picture" class="img-thumbnail" />
                                        </div>
                                    </div>
                                <?php } ?>

                                <div class="form-group row">
                                    <label for="logo" class="col-sm-4 col-form-label font-weight-600"><?php echo display('dashboard_logo') ?></label>
                                    <div class="col-sm-8">
                                        <input type="file" name="logo" id="logo">
                                        <span class="mention-text">147x50px(jpg, jpeg, png, gif, ico)</span>
                                        <input type="hidden" name="old_logo" value="<?php echo esc($setting->logo) ?>">
                                    </div>
                                </div>


                                <!-- if setting Web logo is already uploaded -->
                                <?php if(!empty($setting->logo_web)) {  ?>
                                    <div class="form-group row">
                                        <label for="logoPreview" class="col-sm-4 col-form-label font-weight-600"></label>
                                        <div class="col-sm-8">
                                            <img src="<?php echo base_url(esc($setting->logo_web)) ?>" alt="Picture" class="img-thumbnail" />
                                        </div>
                                    </div>
                                <?php } ?>

                                <div class="form-group row">
                                    <label for="logo_web" class="col-sm-4 col-form-label font-weight-600"><?php echo display('logo_web') ?></label>
                                    <div class="col-sm-8">
                                        <input type="file" name="logo_web" id="logo_web">
                                        <span class="mention-text">147x50px(jpg, jpeg, png, gif, ico)</span>
                                        <input type="hidden" name="old_web_logo" value="<?php echo esc($setting->logo_web) ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="footer_text" class="col-sm-4 col-form-label font-weight-600"><?php echo display('language') ?></label>
                                    <div class="col-sm-8">
                                        <?php echo form_dropdown('language',$languageList,$setting->language, 'class="form-control"') ?>
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label for="left_to_right" class="col-sm-4 col-form-label font-weight-600"><?php echo display('admin_align') ?></label>
                                    <div class="col-sm-8">
                                        <?php echo form_dropdown('site_align', array('LTR' => display('left_to_right'), 'RTL' => display('right_to_left')) ,$setting->site_align, 'class="form-control"') ?>
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label for="latitude" class="col-sm-4 col-form-label font-weight-600"><?php echo display('latitudelongitude') ?></label>
                                    <div class="col-sm-8">
                                        <input name="latitude" type="text" class="form-control" id="latitude" placeholder="<?php echo display('latitudelongitude') ?>"  value="<?php echo esc($setting->latitude) ?>" >
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="footer_text" class="col-sm-2 col-form-label font-weight-600"></label>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-success"><?php echo display('save') ?></button>
                            </div>
                        </div>
                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
