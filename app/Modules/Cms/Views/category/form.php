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
                        <?php echo form_open_multipart("admin/cms/add-category/$category->cat_id") ?>
                        <?php echo form_hidden('cat_id', @$category->cat_id) ?> 

                        <div class="form-group row">
                            <label for="cat_name_en" class="col-sm-4 font-weight-600"><?php echo display('cat_name_en') ?><i class="text-danger">*</i></label>
                            <div class="col-sm-8">
                                <input name="cat_name_en" value="<?php echo esc($category->cat_name_en) ?>" class="form-control" placeholder="<?php echo display('cat_name_en') ?>" type="text" id="cat_name_en">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cat_name_en" class="col-sm-4 font-weight-600"><?php echo display('cat_name')." ".esc($web_language->name) ?></label>
                            <div class="col-sm-8">
                                <input name="cat_name_fr" value="<?php echo esc($category->cat_name_fr) ?>" class="form-control" placeholder="<?php echo display('cat_name')." ".esc($web_language->name) ?>" type="text" id="cat_name_fr">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="parent_id" class="col-sm-4 font-weight-600"><?php echo display('parent_cat') ?></label>
                            <div class="col-sm-8">
                                <select class="form-control basic-single" name="parent_id">
                                    <option value="0"><?php echo display('parent_cat') ?></option>
                                    <?php foreach ($parent_cat as $key => $value) { ?>
                                        <option value="<?php echo $value->cat_id; ?>" <?php echo ($category->parent_id==$value->cat_id)?'Selected':'' ?>><?php echo esc($value->cat_name_en); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cat_image" class="col-sm-4 font-weight-600"><?php echo display('image') ?></label>
                            <div class="col-sm-8">
                                <input name="cat_image" value="<?php echo $category->cat_image ?>" class="form-control" placeholder="<?php echo display('image') ?>" type="file" id="cat_image">
                                <input type="hidden" name="cat_image_old" value="<?php echo $category->cat_image ?>">
                                <span class="text-danger">400 x 40px (png,jpg,gif,ico)</span><br>
                                <?php if (!empty($category->cat_image)) { ?>
                                    <img src="<?php echo base_url($category->cat_image) ?>" width="150">
                                <?php } ?>                            
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cat_title1_en" class="col-sm-4 font-weight-600"><?php echo display('cat_title_en') ?></label>
                            <div class="col-sm-8">
                                <input name="cat_title1_en" value="<?php echo $category->cat_title1_en ?>" class="form-control" placeholder="<?php echo display('cat_title_en') ?>" type="text" id="cat_title1_en">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cat_title1_fr" class="col-sm-4 font-weight-600"><?php echo display('cat_title')." ".esc($web_language->name) ?></label>
                            <div class="col-sm-8">
                                <input name="cat_title1_fr" value="<?php echo esc($category->cat_title1_fr) ?>" class="form-control" placeholder="<?php echo display('cat_title')." ".esc($web_language->name) ?>" type="text" id="cat_title1_fr">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cat_title2_en" class="col-sm-4 font-weight-600"><?php echo display('cat_title_en') ?></label>
                            <div class="col-sm-8">
                                <input name="cat_title2_en" value="<?php echo esc($category->cat_title2_en) ?>" class="form-control" placeholder="<?php echo display('cat_title_en') ?>" type="text" id="cat_title2_en">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cat_title2_fr" class="col-sm-4 font-weight-600"><?php echo display('cat_title')." ".esc($web_language->name) ?></label>
                            <div class="col-sm-8">
                                <input name="cat_title2_fr" value="<?php echo esc($category->cat_title2_fr) ?>" class="form-control" placeholder="<?php echo display('cat_title')." ".esc($web_language->name) ?>" type="text" id="cat_title2_fr">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="menu" class="col-sm-4 font-weight-600"><?php echo display('menu') ?></label>
                            <div class="col-sm-8">
                                <label class="radio-inline">
                                    <?php echo form_radio('menu', '2', (($category->menu==2)?true:false)); ?>Footer Menu
                                </label>
                                <label class="radio-inline">
                                    <?php echo form_radio('menu', '0', (($category->menu==0 || $category->menu==null)?true:false) ); ?>Not Menu
                                </label> 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-sm-4 font-weight-600"><?php echo display('status') ?></label>
                            <div class="col-sm-8">
                                <label class="radio-inline">
                                    <?php echo form_radio('status', '1', (($category->status==1 || $category->status==null)?true:false)); ?>Active
                                </label>
                                <label class="radio-inline">
                                    <?php echo form_radio('status', '0', (($category->status=="0")?true:false) ); ?>Inactive
                                </label> 
                            </div>
                        </div>
                        <div class="row">
                            <label for="cat_title2_fr" class="col-sm-4 font-weight-600">&nbsp;</label>
                            <div class="col-sm-8">
                                <a href="<?php echo base_url('admin'); ?>" class="btn btn-primary  w-md m-b-5"><?php echo display("cancel") ?></a>
                                <button type="submit" class="btn btn-success  w-md m-b-5"><?php echo $category->cat_id?display("update"):display("create") ?></button>
                            </div>
                        </div>
                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- summernote css -->
<link href="<?php echo base_url(); ?>/assets/plugins/summernote/summernote.css" rel="stylesheet" type="text/css"/>
<!-- summernote js -->
<script src="<?php echo base_url(); ?>/assets/plugins/summernote/summernote.min.js" type="text/javascript"></script>
<!-- Third Party Scripts(used by this page)-->
<script src="<?php echo base_url('/assets/plugins/select2/dist/js/select2.min.js') ?>"></script>
<script src="<?php echo base_url('/assets/dist/js/pages/demo.select2.js') ?>"></script>
<!-- Third Party Scripts(used by this page)-->
<script src="<?php echo base_url('/assets/plugins/ckeditor/ckeditor.js') ?>"></script>
<!--Page Active Scripts(used by this page)-->
<script src="<?php echo base_url('/assets/plugins/ckeditor/ckeditor.active.js') ?>"></script>