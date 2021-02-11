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
                <?php echo form_open_multipart("admin/cms/add-page-content/$article->article_id") ?>
                <?php echo form_hidden('article_id', @$article->article_id) ?> 
                    <div class="form-group row">
                        <label for="headline_en" class="col-sm-2 col-form-label font-weight-600"><?php echo display('headline_en') ?><i class="text-danger">*</i></label>
                        <div class="col-sm-10">
                            <input name="headline_en" value="<?php echo strip_tags(@$article->headline_en) ?>"  class="form-control" placeholder="<?php echo display('headline_en') ?>" type="text" id="headline_en">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="headline_fr" class="col-sm-2 col-form-label font-weight-600"><?php echo display('headline')." ".esc($web_language->name) ?></label>
                        <div class="col-sm-10">
                            <input name="headline_fr" value="<?php echo strip_tags(@$article->headline_fr) ?>" class="form-control" placeholder="<?php echo display('headline')." ".esc($web_language->name) ?>" type="text" id="headline_fr">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="article_image" class="col-sm-2 col-form-label font-weight-600"><?php echo display('image') ?></label>
                        <div class="col-sm-10">
                            <input name="article_image" class="form-control" placeholder="<?php echo display('image') ?>" type="file" id="article_image">
                             <input type="hidden" name="article_image_old" value="<?php echo @$article->article_image ?>">
                             <?php if (!empty(@$article->article_image)) { ?>
                                <img src="<?php echo base_url('/'.$article->article_image) ?>" width="150">
                             <?php } ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="video" class="col-sm-2 col-form-label font-weight-600"><?php echo display('video') ?></label>
                        <div class="col-sm-10">
                            <input name="video" value="<?php echo strip_tags(@$article->video) ?>" class="form-control" placeholder="<?php echo display('video') ?>" type="text" id="video">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="article1_en" class="col-sm-2 col-form-label font-weight-600"><?php echo display('article_en') ?></label>
                        <div class="col-sm-10">
                            <textarea  id="ckeditor" name="article1_en" class="form-control editor" placeholder="<?php echo display('article_en') ?>" type="text" id="article1_en"><?php echo strip_tags(@$article->article1_en) ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="article1_fr" class="col-sm-2 col-form-label font-weight-600"><?php echo display('article')." ".esc($web_language->name) ?></label>
                        <div class="col-sm-10">
                            <textarea   id="ckeditor2" name="article1_fr" class="form-control" placeholder="<?php echo display('article')." ".$web_language->name ?>" type="text" id="article1_fr"><?php echo strip_tags(@$article->article1_fr) ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="article2_en" class="col-sm-2 col-form-label font-weight-600"><?php echo display('article_en') ?></label>
                        <div class="col-sm-10">
                            <textarea  id="ckeditor3" name="article2_en" class="form-control editor" placeholder="<?php echo display('article_en') ?>" type="text" id="article2_en"><?php echo strip_tags(@$article->article2_en) ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="article2_fr" class="col-sm-2 col-form-label font-weight-600"><?php echo display('article')." ".esc($web_language->name) ?></label>
                        <div class="col-sm-10">
                            <textarea   id="ckeditor4" name="article2_fr" class="form-control" placeholder="<?php echo display('article')." ".$web_language->name ?>" type="text" id="article2_fr"><?php echo strip_tags(@$article->article2_fr) ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cat_id" class="col-sm-2 col-form-label font-weight-600"><?php echo display('select_cat') ?><i class="text-danger">*</i></label>
                        <div class="col-sm-10">
                            <select class="form-control basic-single" name="cat_id">
                                <option value=""><?php echo display('select_cat') ?></option>
                                <?php foreach ($parent_cat as $key => $value) { ?>
                                    <option value="<?php echo $value->cat_id; ?>" <?php echo (@$article->cat_id==@$value->cat_id)?'Selected':'' ?>><?php echo esc(@$value->cat_name_en); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="position_serial" class="col-sm-2 col-form-label font-weight-600"><?php echo display('position_serial') ?><i class="text-danger">*</i></label>
                        <div class="col-sm-10">
                            <input name="position_serial" value="<?php echo @$article->position_serial ?>" class="form-control" placeholder="<?php echo display('position_serial') ?>" type="text" id="position_serial">
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label font-weight-600"></label>
                        <div class="col-sm-10">
                            <a href="<?php echo base_url('dashboard'); ?>" class="btn btn-primary  w-md m-b-5"><?php echo display("cancel") ?></a>
                            <button type="submit" class="btn btn-success  w-md m-b-5"><?php echo @$article->article_id?display("update"):display("create") ?></button>
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

 