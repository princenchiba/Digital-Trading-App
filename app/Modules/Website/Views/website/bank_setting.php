        <div class="payout-content">
            <div class="container">
                <div class="row">
                    
                    <div class="col-lg-6 offset-lg-3 form-content mt-4 mb-4">
                    <!-- alert message -->
                    <?php if ($session->get('message') != null) {  ?>
                    <div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php echo $session->get('message'); ?>
                    </div> 
                    <?php } ?>
                        
                    <?php if ($session->get('exception') != null) {  ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php echo $session->get('exception'); ?>
                    </div>
                    <?php } ?>
                   
                    <!-- /.alert message -->
                        <div class="mb-4 form-design">  
                            <h3 class="user-login-title mb-3"><?php echo display('bank_setting');?></h3>
                            <?php echo form_open('bank-setting/bank');?>
                                <input class="form-control" name="currency_symbol" value="USD" type="hidden">

                                <div class="form-group row">
                                    <label for="acc_name" class="col-md-4 col-form-label"><?php echo display('account_name') ?><i class="text-danger">*</i></label>
                                    <div class="col-md-8">
                                        <input name="acc_name" type="text" class="form-control" id="acc_name" value="<?php echo  esc(@$acc_name); ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="acc_no" class="col-md-4 col-form-label"><?php echo display('account_no') ?><i class="text-danger">*</i></label>
                                    <div class="col-md-8">
                                        <input name="acc_no" type="text" class="form-control" id="acc_no" value="<?php echo esc(@$acc_no); ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="branch_name" class="col-md-4 col-form-label"><?php echo display('branch_name') ?><i class="text-danger">*</i></label>
                                    <div class="col-md-8">
                                        <input name="branch_name" type="text" class="form-control" id="branch_name" value="<?php echo esc(@$branch_name); ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="swift_code" class="col-md-4 col-form-label"><?php echo display('swift_code') ?></label>
                                    <div class="col-md-8">
                                        <input name="swift_code" type="text" class="form-control" id="swift_code" value="<?php echo esc(@$swift_code); ?>" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="abn_no" class="col-md-4 col-form-label"><?php echo display('abn_no') ?></label>
                                    <div class="col-md-8">
                                        <input name="abn_no" type="text" class="form-control" id="abn_no" value="<?php echo esc(@$abn_no); ?>" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="country" class="col-md-4 col-form-label"><?php echo display('country') ?><i class="text-danger">*</i></label>
                                    <div class="col-md-8">
                                        <select class="custom-select" name="country" id="country">
                                            <option><?php echo display('select_option');?></option>
                                            <?php foreach ($countrys as $key => $value) { ?>
                                                <option value="<?php echo $value->iso ?>" <?php echo $value->iso==@$country?'selected':null ?> ><?php echo esc($value->nicename) ?></option>
                                            <?php } ?>                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="bank_name" class="col-md-4 col-form-label"><?php echo display('bank_name') ?><i class="text-danger">*</i></label>
                                    <div class="col-md-8">
                                        <input name="bank_name" type="text" class="form-control" id="bank_name" value="<?php echo esc( @$bank_name); ?>" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-kingfisher-daisy float-right"><?php echo display("update") ?></button>
                                    </div>
                                </div>

                            <?php echo form_close();?>
                        </div>   
                    </div>

                </div>
            </div>
        </div>