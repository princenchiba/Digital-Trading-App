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

            $capture_status = 1;
           
            if(!empty($security)){
                foreach ($security as $key => $value) {
                    if(!empty($value->data)){
                        $jsondata = json_decode($value->data,true);
                    }
                    switch ($value->keyword) {
                        case 'url':
                            $baseurl     = $value->status==1?$jsondata['url']:base_url();
                            $url_status  = $value->status;
                            $checkstatus = $url_status==1?"checked":null;
                            break;
                        case 'login':
                            $try_duration = $jsondata['duration'];
                            $wrong_try    = $jsondata['wrong_try'];
                            $ip_block     = $jsondata['ip_block'];
                            $login_status = $value->status;
                            $logincheckstatus = $login_status==1?'checked':null;
                            break;
                        case 'https':
                            $cookie_secure = $jsondata['cookie_secure'];
                            $cookie_http   = $jsondata['cookie_http'];
                            $cookie_secure_status = $jsondata['cookie_secure']==1?'checked':null;
                            $cookie_http_status   = $jsondata['cookie_http']==1?'checked':null;
                            break;
                        case 'xss_filter':
                            $xss_filter = $value->status;
                            $xss_filter_status = $xss_filter==1?'checked':null;
                            break;
                        case 'csrf_token':
                            $csrf_token = $value->status;
                            $csrf_token_status = $csrf_token==1?'checked':null;
                            break;
                        case 'capture':
                            $site_key       = $jsondata['site_key'];
                            $secret_key     = $jsondata['secret_key'];
                            $capture_status = $value->status;
                            $capturechecked = $value->status==1?'checked':null;
                            break;
                    }
                }
            }
        ?>
    <?php echo form_open_multipart('admin/setting/security') ?>

        <div class="form-group row">
            <label class="font-weight-600 col-sm-3 text-right"><?php echo display('google_captcha');?> <i class="text-danger">*</i></label>
            <div class="input-group col-sm-4">
                <input type="text" name="site_key" value="<?php echo esc($site_key); ?>" placeholder="Site key" class="form-control" id="site_key" required>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" data-toggle="tooltip" data-original-title="Site key for google capture"><span class="fa fa-question-circle"></span></button>
                </div>
            </div>
            <div class="input-group col-sm-1">
                <input type="checkbox" name="capture_status" id="capture_status" value="<?php echo esc($capture_status); ?>" <?php echo esc($capturechecked); ?> data-toggle="toggle">
            </div>
            <div class="col-sm-4"><a target="_blank" href="https://www.google.com/recaptcha/admin/create"><?php echo display('add_captcha_at_your_domain');?></a></div>
            <div class="col-sm-3"></div>

            <div class="input-group col-sm-4 mt-4">
                <input type="text" name="secret_key" value="<?php echo esc($secret_key); ?>" placeholder="Secret key" class="form-control" id="secret_key" required>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" data-toggle="tooltip" data-original-title="Secret key for google capture"><span class="fa fa-question-circle"></span></button>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="capture" class="col-sm-3 col-form-label font-weight-600"></label>
            <div class="col-md-4 col-md-offset-3">
                <button type="submit" class="btn btn-success  w-md m-b-5"><?php echo display('update') ?></button>
            </div>
        </div>
    <?php echo form_close() ?>
    </div>
</div>
