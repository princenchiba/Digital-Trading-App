<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                      <h6 class="fs-17 font-weight-600 mb-0"><?php echo (!empty($title)?esc($title):null) ?></h6>
                    </div>
                    <div class="text-right">
                        <div class="actions">
                            <a href=" " class="action-item"><i class="ti-reload"></i></a>
                        </div>
                    </div>
                </div>
            </div>            
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <?php echo form_open_multipart(base_url("admin/setting/update-sender")) ?>

                        <fieldset>
                           <legend> <?php echo display('email_notification_settings');?> </legend>
                            <div class="checkbox">
                               <input id="checkbox1" type="checkbox" value="0" <?php echo ($email->deposit!=NULL?'checked':'')?> name="deposit">
                               <label for="checkbox1"><?php echo display('deposit');?></label>
                           </div>
                           <div class="checkbox checkbox-primary">
                               <input id="checkbox2" type="checkbox" value="0" <?php echo ($email->transfer!=NULL?'checked':'')?> name="transfer">
                               <label for="checkbox2"><?php echo display('transfer');?></label>
                           </div>
                           <div class="checkbox checkbox-danger">
                               <input id="checkbox6" type="checkbox" value="0" <?php echo ($email->withdraw!=NULL?'checked':'')?>  name="withdraw">
                               <label for="checkbox6"><?php echo display('withdraw');?></label>
                           </div>
                           <input type="hidden" name="email" value="email">

                       </fieldset>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-success"><?php echo display("save") ?></button>
                        </div>
                    <?php echo form_close() ?>
                    </div>


                    <div class="col-sm-6 col-md-6 col-lg-6">
                         <?php 
                            echo form_open_multipart(base_url("admin/setting/update-sender")) ?>
                         <fieldset>
                            <legend> <?php echo display('sms_sending');?>  </legend>
                             <div class="checkbox">
                                <input id="checkbox7" type="checkbox" value="0" <?php echo ($sms->deposit!=NULL?'checked':'')?> name="deposit">
                                <label for="checkbox7"><?php echo display('deposit');?></label>
                            </div>
                            <div class="checkbox checkbox-primary">
                                <input id="checkbox8" type="checkbox" value="0" <?php echo ($sms->transfer!=NULL?'checked':'')?> name="transfer">
                                <label for="checkbox8"><?php echo display('transfer');?></label>
                            </div>
                            <div class="checkbox checkbox-danger">
                                <input id="checkbox12" type="checkbox" value="0" <?php echo ($sms->withdraw!=NULL?'checked':'')?> name="withdraw">
                                <label for="checkbox12"><?php echo display('withdraw');?></label>
                            </div>
                            <input type="hidden" name="sms" value="sms">
                        </fieldset>
                        <div class="mt-2">
                        <button type="submit" class="btn btn-success"><?php echo display("save") ?></button>
                        </div>
                     <?php echo form_close() ?>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>




 