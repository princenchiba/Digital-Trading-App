<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2><?php echo esc((!empty($title)?$title:null)) ?></h2>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <?php

                        $baseurl        = $url;
                        $url_status     = 1;
                        $try_duration   = 30;
                        $wrong_try      = 3;
                        $ip_block       = 3;
                        $cookie_secure  = 1;
                        $cookie_http    = 1;
                        $xss_filter     = 1;
                        $csrf_token     = 1;
                        $capture_status = 1;
                        $login_status   = 1;
                        $site_key       = "";
                        $secret_key     = "";
                        $checkstatus    = "checked";
                        $cookie_secure_status = "checked";
                        $cookie_http_status   = "checked";
                        $xss_filter_status    = "checked";
                        $csrf_token_status    = "checked";
                        $capturechecked       = "checked";
                        $logincheckstatus     = "checked"; 

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
                    <div class="col-md-9 col-sm-12">

                        <?php echo form_open_multipart('backend/dashboard/security') ?>

                            <div class="form-group row">
                                <label for="url" class="col-xs-3 col-form-label"><?php echo display('url') ?>(Secure server)<i class="text-danger">*</i></label>
                                <div class="col-xs-6">
                                    <input type="text" name="url" class="form-control" value="<?php echo htmlspecialchars_decode($baseurl); ?>" id="url" readonly> <i class="question-mark fa fa-question-circle" data-toggle="tooltip" data-original-title="If SSL is active.then on this option for https url."></i>
                                </div>
                                <div class="col-xs-2">
                                    <input type="checkbox" name="url_status" id="url_status" value="<?php echo esc($url_status); ?>" <?php echo esc($checkstatus); ?> data-toggle="toggle">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="login" class="col-xs-3 col-form-label"><?php echo display('login') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-2">
                                    <input type="number" name="try_duration" value="<?php echo $try_duration; ?>" placeholder="Duration" class="form-control" id="try_duration" required> <i class="question-mark fa fa-question-circle" data-toggle="tooltip" data-original-title="Temporary block to login(Duration in minute)."></i>
                                </div>
                                <div class="col-xs-2">
                                    <input type="number" name="wrong_try" value="<?php echo esc($wrong_try); ?>" placeholder="Wrong Try" class="form-control" id="wrong_try" required> <i class="question-mark fa fa-question-circle" data-toggle="tooltip" data-original-title="Wrong password try limit before temporary block.(Number)"></i>
                                </div>
                                <div class="col-xs-2">
                                    <input type="number" name="ip_block" value="<?php echo esc($ip_block); ?>" placeholder="" class="form-control" id="ip_block" required> <i class="question-mark fa fa-question-circle" data-toggle="tooltip" data-original-title="How many times(Temporary block) give chance and block user IP.(Number)"></i>
                                </div>
                                <div class="col-xs-2">
                                    <input type="checkbox" name="login_status" id="login_status" value="<?php echo esc($login_status); ?>" <?php echo esc($logincheckstatus); ?> data-toggle="toggle">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="cookie_secure" class="col-xs-3 col-form-label">Cookie secure<i class="text-danger">*</i></label>
                                <div class="col-xs-2">
                                    <input type="checkbox" name="cookie_secure" id="cookie_secure" value="<?php echo esc($cookie_secure); ?>" <?php echo esc($cookie_secure_status); ?> data-toggle="toggle"> <i class="question-mark-p fa fa-question-circle" data-toggle="tooltip" data-original-title="Cookie will only be set if a secure HTTPS connection exists."></i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="cookie_http" class="col-xs-3 col-form-label">Cookie http<i class="text-danger">*</i></label>
                                <div class="col-xs-2">
                                    <input type="checkbox" name="cookie_http" id="cookie_http" value="<?php echo ($cookie_http); ?>" <?php echo ($cookie_http_status); ?> data-toggle="toggle"> <i class="question-mark-p fa fa-question-circle" data-toggle="tooltip" data-original-title="Cookie will only be accessible via HTTP(S) (no javascript)"></i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="xss_filter" class="col-xs-3 col-form-label">XSS Filter<i class="text-danger">*</i></label>
                                <div class="col-xs-2">
                                    <input type="checkbox" name="xss_filter" id="xss_filter" value="<?php echo esc($xss_filter); ?>" <?php echo esc($xss_filter_status); ?> data-toggle="toggle"> <i class="question-mark-p fa fa-question-circle" data-toggle="tooltip" data-original-title="Cookie will only be accessible via HTTP(S) (no javascript)"></i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="csrf_token_alow" class="col-xs-3 col-form-label">CSRF Token<i class="text-danger">*</i></label>
                                <div class="col-xs-2">
                                    <input type="checkbox" name="csrf_token_alow" id="csrf_token_alow" value="<?php echo esc($csrf_token); ?>" <?php echo esc($csrf_token_status); ?> data-toggle="toggle"> <i class="question-mark-p fa fa-question-circle" data-toggle="tooltip" data-original-title="Enables a CSRF cookie token to be set. When set to TRUE, token will be checked on a submitted form. If you are accepting user data, it is strongly recommended CSRF protection be enabled."></i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="capture" class="col-xs-3 col-form-label">Capture<i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <div class="form-group row">
                                        <div class="col-xs-8">
                                            <input type="text" name="site_key" value="<?php echo esc($site_key); ?>" placeholder="Site key" class="form-control" id="site_key" required> <i class="question-mark fa fa-question-circle" data-toggle="tooltip" data-original-title="Site key for google capture"></i>
                                        </div>
                                        <div class="col-xs-2">
                                            <input type="checkbox" name="capture_status" id="capture_status" value="<?php echo esc($capture_status); ?>" <?php echo esc($capturechecked); ?> data-toggle="toggle">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-xs-8">
                                            <input type="text" name="secret_key" value="<?php echo esc($secret_key); ?>" placeholder="Secret key" class="form-control" id="secret_key" required> <i class="question-mark fa fa-question-circle" data-toggle="tooltip" data-original-title="Secret key for google capture"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4 col-md-offset-3">
                                    <button type="submit" class="btn btn-success  w-md m-b-5"><?php echo display('update') ?></button>
                                </div>
                            </div>
                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
