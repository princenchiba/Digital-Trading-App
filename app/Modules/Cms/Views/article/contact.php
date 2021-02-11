<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="border_preview">
                <?php echo form_open_multipart("admin/cms/contact") ?>
                <?php echo form_hidden('article_id', $article->article_id) ?> 
                    <div class="form-group row">
                        <label for="headline_en" class="col-sm-2 font-weight-600"><?php echo display('headline_en') ?><i class="text-danger">*</i></label>
                        <div class="col-sm-10">
                            <input name="headline_en" value="<?php echo htmlspecialchars($article->headline_en) ?>" class="form-control" placeholder="<?php echo display('headline_en') ?>" type="text" id="headline_en">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="headline_fr" class="col-sm-2 font-weight-600"><?php echo display('headline')." ".esc($web_language->name) ?></label>
                        <div class="col-sm-10">
                            <input name="headline_fr" value="<?php echo htmlspecialchars($article->headline_fr)." ".esc($web_language->name) ?>" class="form-control" placeholder="<?php echo display('headline_fr') ?>" type="text" id="headline_fr">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="article1_en" class="col-sm-2 font-weight-600"><?php echo display('address') ?></label>
                        <div class="col-sm-10">
                            <textarea name="article1_en" class="form-control editor" placeholder="<?php echo display('address') ?>" type="text" id="article1_en"><?php echo htmlspecialchars($article->article1_en) ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="article1_fr" class="col-sm-2 font-weight-600"><?php echo display('phone') ?></label>
                        <div class="col-sm-10">
                            <textarea id="ckeditor" name="article1_fr" class="form-control editor" placeholder="<?php echo display('phone') ?>" type="text" id="article1_fr"><?php echo htmlspecialchars($article->article1_fr) ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="article2_en" class="col-sm-2 font-weight-600"><?php echo display('office_time') ?></label>
                        <div class="col-sm-10">
                            <textarea id="ckeditor2" name="article2_en" class="form-control editor" placeholder="<?php echo display('office_time') ?>" type="text" id="article2_en"><?php echo htmlspecialchars(@$article->article2_en) ?></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 font-weight-600">&nbsp;</label>
                        <div class="col-sm-9 col-sm-offset-3">
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