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
                <?php echo form_open_multipart("admin/cms/add-slider/$slider->id") ?>
                <?php echo form_hidden('id', @$slider->id) ?> 
                    <div class="form-group row">
                        <label for="slider_h1_en" class="col-sm-4 col-form-label font-weight-600"><?php echo display('slider_title_engnilsh');?><i class="text-danger">*</i></label>
                        <div class="col-sm-8">
                            <input name="slider_h1_en" value="<?php echo htmlspecialchars($slider->slider_h1_en); ?>" class="form-control" type="text" id="slider_h1_en">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="slider_h1_fr" class="col-sm-4 col-form-label font-weight-600"><?php echo display('slider_h1')." ".esc($web_language->name) ?></label>
                        <div class="col-sm-8">
                            <input name="slider_h1_fr" value="<?php echo $slider->slider_h1_fr ?>" class="form-control" type="text" id="slider_h1_fr">
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="slider_h2_en" class="col-sm-4 col-form-label font-weight-600"><?php echo display('sub_title_english');?></label>
                        <div class="col-sm-8">
                            <input name="slider_h2_en" value="<?php echo htmlspecialchars($slider->slider_h2_en); ?>" class="form-control" type="text" id="slider_h2_en">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="slider_h2_fr" class="col-sm-4 col-form-label font-weight-600"><?php echo display('slider_h2')." ".esc($web_language->name) ?></label>
                        <div class="col-sm-8">
                            <input name="slider_h2_fr" value="<?php echo htmlspecialchars($slider->slider_h2_fr); ?>" class="form-control" type="text" id="slider_h2_fr">
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="slider_h3_en" class="col-sm-4 col-form-label font-weight-600"><?php echo display('button_text') ?></label>
                        <div class="col-sm-8">
                            <input name="slider_h3_en" value="<?php echo htmlspecialchars($slider->slider_h3_en); ?>" class="form-control" type="text" id="slider_h3_en">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="slider_h3_fr" class="col-sm-4 col-form-label font-weight-600"><?php echo display('slider_h3')." ".esc($web_language->name) ?></label>
                        <div class="col-sm-8">
                            <input name="slider_h3_fr" value="<?php echo htmlspecialchars($slider->slider_h3_fr); ?>" class="form-control" type="text" id="slider_h3_fr">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="custom_url" class="col-sm-4 col-form-label font-weight-600"><?php echo display('url') ?></label>
                        <div class="col-sm-8">
                            <input name="custom_url" value="<?php echo htmlspecialchars_decode($slider->custom_url); ?>" class="form-control" type="text" id="custom_url">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="slider_img" class="col-sm-4 col-form-label font-weight-600"><?php echo display('image') ?></label>
                        <div class="col-sm-8">
                            <input name="slider_img" class="form-control" placeholder="<?php echo display('image') ?>" type="file" id="slider_img">
                            <span class="text-danger">1200x800 px(jpg, jpeg, png, gif, ico)</span><br>
                            <input type="hidden" name="slider_img_old" value="<?php echo $slider->slider_img ?>">
                            <?php if (!empty($slider->slider_img)) { ?>
                                <img src="<?php echo base_url().esc($slider->slider_img) ?>" width="450">
                            <?php } ?>                            
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-sm-4 col-form-label font-weight-600"><?php echo display('status') ?></label>
                        <div class="col-sm-8 pt10">
                            <label class="radio-inline">
                                <?php echo form_radio('status', '1', (($slider->status==1 || $slider->status==null)?true:false)); ?><?php echo display('active') ?>
                             </label>
                            <label class="radio-inline">
                                <?php echo form_radio('status', '0', (($slider->status=="0")?true:false) ); ?><?php echo display('inactive') ?>
                             </label> 
                        </div>
                    </div>
                    <div class="row">
                          <label for="status" class="col-sm-4 col-form-label font-weight-600"></label>
                        <div class="col-sm-8">
                            <a href="<?php echo base_url('admin'); ?>" class="btn btn-primary  w-md m-b-5"><?php echo display("cancel") ?></a>
                            <button type="submit" class="btn btn-success  w-md m-b-5"><?php echo $slider->id?display("update"):display("create") ?></button>
                        </div>
                    </div>
                <?php echo form_close() ?>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

 