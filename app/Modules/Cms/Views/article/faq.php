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
                <?php echo form_open_multipart("admin/cms/add-faq/$article->article_id") ?>
                <?php echo form_hidden('article_id', $article->article_id) ?> 
                    <div class="form-group row">
                        <label for="headline_en" class="col-sm-2 font-weight-600"><?php echo display('question_en') ?><i class="text-danger">*</i></label>
                        <div class="col-sm-10">
                            <input name="headline_en" value="<?php echo htmlspecialchars($article->headline_en) ?>" class="form-control" placeholder="<?php echo display('question_en') ?>" type="text" id="headline_en">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="headline_fr" class="col-sm-2 font-weight-600"><?php echo display('question')." ".$web_language->name ?></label>
                        <div class="col-sm-10">
                            <input name="headline_fr" value="<?php echo htmlspecialchars($article->headline_fr) ?>" class="form-control" placeholder="<?php echo display('question')." ".$web_language->name ?>" type="text" id="headline_fr">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="article1_en" class="col-sm-2 font-weight-600"><?php echo display('answer_en') ?><i class="text-danger">*</i></label>
                        <div class="col-sm-10">
                            <textarea id="ckeditor" name="article1_en" class="form-control editor" placeholder="<?php echo display('answer_en') ?>" type="text"><?php echo htmlspecialchars($article->article1_en) ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="article1_fr" class="col-sm-2 font-weight-600"><?php echo display('answer')." ".$web_language->name ?></label>
                        <div class="col-sm-10">
                            <textarea id="ckeditor2" name="article1_fr" class="form-control" placeholder="<?php echo display('answer')." ".$web_language->name ?>" type="text"><?php echo htmlspecialchars($article->article1_fr) ?></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 font-weight-600">&nbsp;</label>
                        <div class="col-sm-10">
                            <a href="<?php echo base_url('admin'); ?>" class="btn btn-primary  w-md m-b-5"><?php echo display("cancel") ?></a>
                            <button type="submit" class="btn btn-success  w-md m-b-5"><?php echo $article->article_id?display("update"):display("create") ?></button>
                        </div>
                    </div>
                <?php echo form_close() ?>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Third Party Scripts(used by this page)-->
<script src="<?php echo base_url('/assets/plugins/ckeditor/ckeditor.js') ?>"></script>
<!--Page Active Scripts(used by this page)-->
<script src="<?php echo base_url('/assets/plugins/ckeditor/ckeditor.active.js') ?>"></script>