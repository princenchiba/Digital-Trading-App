<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fs-17 font-weight-600 mb-0"><?php echo display('sms_gateway_setup');?></h6>
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
                    <div class="col-sm-12">
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
                </div> 
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fs-17 font-weight-600 mb-0"><?php echo display('check_your_sms_gateway');?></h6>
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
                    <div class="col-md-12"> 
                        <?php echo form_open_multipart("admin/setting/test-sms") ?>
                        <div class="form-group row">
                            <label for="mobile_num" class="col-sm-3 col-form-label"><?php echo display('mobile_no');?>. <i class="text-danger">*</i></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="mobile_num" id="mobile_num" placeholder="e. 88xxxxxxxx">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="test_message" class="col-sm-3 col-form-label"><?php echo display('message');?> <i class="text-danger">*</i></label>
                            <div class="col-sm-9">
                                <textarea rows="5" class="form-control" name="test_message" id="test_message" placeholder="Test Message"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">&nbsp;</label>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-success"><?php echo display("send") ?></button>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>