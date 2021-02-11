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
                <div class="row">
                    <div class="col-md-8"> 
                        <?php echo form_open_multipart("admin/setting/template-update") ?>
                        <?php echo form_hidden('id',$template->id) ?>
                        <div class="form-group row">
                            <label for="subject_en" class="col-sm-3 col-form-label font-weight-600"><?php echo display('template_type');?></label>
                            <div class="col-sm-9 pt10">
                               <b><?php echo $template->sms_or_email ?></b>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="subject_en" class="col-sm-3 col-form-label font-weight-600"><?php echo display('subject_english');?><i class="text-danger">*</i></label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="subject_en" required><?php echo $template->subject_en ?></textarea>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="subject_fr" class="col-sm-3 col-form-label font-weight-600"><?php echo display('subject_french');?><i class="text-danger">*</i></label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="subject_fr" required><?php echo $template->subject_fr ?></textarea>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="template_en" class="col-sm-3 col-form-label font-weight-600"><?php echo display('template-english'); ?><i class="text-danger">*</i></label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="template_en" required><?php echo $template->template_en ?></textarea>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="template_fr" class="col-sm-3 col-form-label font-weight-600"><?php echo display('template-french');?><i class="text-danger">*</i></label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="template_fr" required><?php echo $template->template_fr ?></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email_charset" class="col-sm-3 col-form-label font-weight-600"></label>
                            <div class="col-sm-9">
                               <button type="submit" class="btn btn-success"><?php echo display("save") ?></button>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                    <div class="col-md-4"> 
                        <div>
                           Note: Use these text on message and emmail template where you want to use this type of data in your message.<br>
                            %fullname%<br>
                            %amount%<br>
                            %balance%<br>
                            %new_balance%<br>
                            %receiver_id%<br>
                            %user_id%<br>
                            %stage%<br>
                            %date%<br>
                            %verify_code%
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>
