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
                    <div class="col-sm-6">
                        <?php echo form_open_multipart("admin/setting/update-sms-gateway") ?>
                        <?php echo form_hidden('es_id',$sms->es_id) ?>
                        <div class="form-group row">
                            <label for="gatewayname" class="col-sm-3 col-form-label font-weight-600">Gateway <i class="text-danger">*</i></label>
                            <div class="col-sm-9">
                                <select class="form-control basic-single" name="gatewayname" id="gatewayname" required>
                                    <option>Select Option</option>
                                    <option value="budgetsms" <?php echo (esc($sms->gatewayname)=="budgetsms")?'Selected':'' ?> >BudgetSMS</option>
                                    <option value="infobip" <?php echo (esc($sms->gatewayname)=="infobip")?'Selected':'' ?>>Infobip</option>
                                    <option value="nexmo" <?php echo (esc($sms->gatewayname)=="nexmo")?'Selected':'' ?>>Nexmo</option>
                                </select>
                            </div>
                        </div>                        
                        <div class="form-group row">
                            <label for="title" class="col-sm-3 col-form-label font-weight-600"><?php echo display('title') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-9">
                                <input name="title" type="text" class="form-control" id="title" placeholder="<?php echo display('title') ?>" value="<?php echo esc($sms->title) ?>" required>
                            </div>
                        </div>
                        <span id="sms_field"> </span>
                         <div class="form-group row">
                            <label for="title" class="col-sm-3 col-form-label font-weight-600"></label>
                            <div class="col-sm-9">
                               <button type="submit" class="btn btn-success"><?php echo display("save") ?></button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="title" class="col-sm-3 col-form-label font-weight-600"></label>
                            <div class="col-sm-9">
                                <br>
                                <br>
                                <p>For SMS Gateway Use  <a href="https://www.budgetsms.net" target="_blank"><b>budgetsms</b></a>/<a href="https://www.infobip.com" target="_blank"><b>infobip</b></a>/<a href="https://www.nexmo.com" target="_blank"><b>nexmo</b></a></p>
                            </div>
                        </div>
                        <?php echo form_close() ?>
                    </div>
                    
                    <div class="col-md-6"> 
                        <?php echo form_open_multipart("admin/setting/update-email-gateway") ?>
                        <?php echo form_hidden('es_id',$email->es_id) ?>
                        <div class="form-group row">
                            <label for="email_title" class="col-sm-3 col-form-label font-weight-600"><?php echo display('title') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-9">
                                <input name="email_title" type="text" class="form-control" id="email_title" placeholder="<?php echo display('title') ?>" value="<?php echo esc($email->title) ?>" required>
                            </div>
                        </div>                                         
                        <div class="form-group row">
                            <label for="email_protocol" class="col-sm-3 col-form-label font-weight-600"><?php echo display('protocol') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-9">
                                <input name="email_protocol" type="text" class="form-control" id="email_protocol" placeholder="<?php echo display('protocol') ?>" value="<?php echo esc($email->protocol) ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email_host" class="col-sm-3 col-form-label font-weight-600"><?php echo display('host') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-9">
                                <input name="email_host" type="text" class="form-control" id="email_host" placeholder="<?php echo display('host') ?>" value="<?php echo htmlspecialchars_decode($email->host) ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email_port" class="col-sm-3 col-form-label font-weight-600"><?php echo display('port') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-9">
                                <input name="email_port" type="text" class="form-control" id="email_port" placeholder="<?php echo display('port') ?>" value="<?php echo esc($email->port) ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email_user" class="col-sm-3 col-form-label font-weight-600"><?php echo display('username') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-9">
                                <input name="email_user" type="text" class="form-control" id="email_user" placeholder="<?php echo display('username') ?>" value="<?php echo esc($email->user) ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email_password" class="col-sm-3 col-form-label font-weight-600"><?php echo display('password') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-9">
                                <input name="email_password" type="password" class="form-control" id="email_password" placeholder="<?php echo display('password') ?>" value="<?php echo base64_encode($email->password) ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email_mailtype" class="col-sm-3 col-form-label font-weight-600"><?php echo display('mail_type') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-9">
                                <input name="email_mailtype" type="text" class="form-control" id="email_mailtype" placeholder="<?php echo display('mail_type') ?>" value="<?php echo esc($email->mailtype) ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email_charset" class="col-sm-3 col-form-label font-weight-600"><?php echo display('charset') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-9">
                                <input name="email_charset" type="text" class="form-control" id="email_charset" placeholder="<?php echo display('charset') ?>" value="<?php echo esc($email->charset) ?>" required>
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
                </div> 
            </div>
        </div>
    </div>
</div>