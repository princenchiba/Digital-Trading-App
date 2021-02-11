<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd ">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2><?php echo (!empty(esc($title))?esc($title):null) ?></h2>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <?php 
                    echo form_open_multipart("backend/dashboard/setting/update_sender") ?>
                    <div class="col-md-6">
                       <fieldset>
                            <legend> <?php echo display('email_notification_settings');?> </legend>
                            <div class="checkbox">
                                <input id="checkbox1" type="checkbox" value="1" <?php echo (esc($email->deposit)!=NULL?'checked':'')?> name="deposit">
                                <label for="checkbox1"><?php echo display('deposit');?></label>
                            </div>
                            <div class="checkbox checkbox-primary">
                                <input id="checkbox2" type="checkbox" value="1" <?php echo (esc($email->transfer)!=NULL?'checked':'')?> name="transfer">
                                <label for="checkbox2"><?php echo display('transfer');?></label>
                            </div>
                            <div class="checkbox checkbox-success">
                                <input id="checkbox3" type="checkbox" value="1" <?php echo (esc($email->payout)!=NULL?'checked':'')?>  name="payout">
                                <label for="checkbox3"><?php echo display('payout');?></label>
                            </div>
                            <div class="checkbox checkbox-info">
                                <input id="checkbox4" type="checkbox" value="1" <?php echo (esc($email->commission)!=NULL?'checked':'')?> name="commission">
                                <label for="checkbox4"><?php echo display('commissin');?></label>
                            </div>
                            <div class="checkbox checkbox-warning">
                                <input id="checkbox5" type="checkbox" value="1" <?php echo (esc($email->team_bonnus)!=NULL?'checked':'')?>  name="team_bonnus">
                                <label for="checkbox5"><?php echo display('team_bonnus');?></label>
                            </div>
                            <div class="checkbox checkbox-danger">
                                <input id="checkbox6" type="checkbox" value="1" <?php echo (esc($email->withdraw)!=NULL?'checked':'')?>  name="withdraw">
                                <label for="checkbox6"><?php echo display('withdraw');?></label>
                            </div>
                            <input type="hidden" name="email" value="email">

                        </fieldset>
                        <button type="submit" class="btn btn-success"><?php echo display("save") ?></button>
                    </div>
                    <?php echo form_close() ?>
                    <?php 
                    echo form_open_multipart("backend/dashboard/setting/update_sender") ?>
                    <div class="col-md-6">
                        <fieldset>
                            <legend> <?php echo display('sms_sending');?>  </legend>
                            <div class="checkbox">
                                <input id="checkbox7" type="checkbox" value="1" <?php echo (esc($sms->deposit)!=NULL?'checked':'')?> name="deposit">
                                <label for="checkbox7"><?php echo display('deposit');?></label>
                            </div>
                            <div class="checkbox checkbox-primary">
                                <input id="checkbox8" type="checkbox" value="1" <?php echo (esc($sms->transfer)!=NULL?'checked':'')?> name="transfer">
                                <label for="checkbox8"><?php echo display('transfer');?></label>
                            </div>
                            <div class="checkbox checkbox-success">
                                <input id="checkbox9" type="checkbox" value="1" <?php echo (esc($sms->payout)!=NULL?'checked':'')?> name="payout">
                                <label for="checkbox9"><?php echo display('payout');?></label>
                            </div>
                            <div class="checkbox checkbox-info">
                                <input id="checkbox10" type="checkbox" value="1" <?php echo (esc($sms->commission)!=NULL?'checked':'')?> name="commission">
                                <label for="checkbox10"><?php echo display('commission');?></label>
                            </div>
                            <div class="checkbox checkbox-warning">
                                <input id="checkbox11" type="checkbox" value="1" <?php echo (esc($sms->team_bonnus)!=NULL?'checked':'')?> name="team_bonnus">
                                <label for="checkbox11"><?php echo display('team_bonnus');?></label>
                            </div>
                            <div class="checkbox checkbox-danger">
                                <input id="checkbox12" type="checkbox" value="1" <?php echo (esc($sms->withdraw)!=NULL?'checked':'')?> name="withdraw">
                                <label for="checkbox12"><?php echo display('withdraw');?></label>
                            </div>
                            <input type="hidden" name="sms" value="sms">
                        </fieldset>
                        <button type="submit" class="btn btn-success"><?php echo display("save") ?></button>
                    </div>
                    </div>
                    <?php echo form_close() ?>
                </div> 
            </div>
        </div>
    </div>
</div>




