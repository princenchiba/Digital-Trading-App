<div class="cryp_wrapper">
    <div class="profile-verify mt-4 mb-4">
        <div class="user-login form-design">
            <h3 class="user-login-title mb-4"><?php echo display('verify_profile');?></h3>
            <?php echo form_open_multipart("profile-verify") ?>
                <div class="form-group row">
                    <label for="verify_type" class="col-md-4 col-form-label"><?php echo display('verify_type') ?> <i class="text-danger">*</i></label>
                    <div class="col-md-8">
                        <select class="custom-select" name="verify_type" id="verify_type">
                            <option selected value=""><?php echo display('select_option') ?></option>
                            <option value="passport"><?php echo display('passport') ?></option>
                            <option value="driving_license"><?php echo display('drivers_license') ?></option>
                            <option value="nid"><?php echo display('government_issued_id_card') ?></option>
                        </select>
                    </div>
                </div>                        
                <div class="form-group row">
                    <label for="first_name" class="col-md-4 col-form-label"><?php echo display('given_name') ?> <i class="text-danger">*</i></label>
                    <div class="col-md-8">
                        <input name="first_name" type="text" class="form-control" id="first_name" placeholder="" value="" required="">
                    </div>
                </div>                        
                <div class="form-group row">
                    <label for="last_name" class="col-md-4 col-form-label"><?php echo display('surname') ?> <i class="text-danger">*</i></label>
                    <div class="col-md-8">
                        <input name="last_name" type="text" class="form-control" id="last_name" placeholder="" value="" required="">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="id_number" class="col-md-4 col-form-label"><?php echo display('passport_nid_license_number') ?> <i class="text-danger">*</i></label>
                    <div class="col-md-8">
                        <input name="id_number" type="text" class="form-control" id="id_number" placeholder="<?php echo display('passport_nid_license_number') ?>" value="" required="">
                    </div>
                </div>   
                <fieldset class="form-group">
                    <div class="row">
                        <legend class="col-form-label col-sm-4 pt-0"><?php echo display('gender') ?></legend>
                        <div class="col-sm-8">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline1" name="gender" value="1" class="custom-control-input">
                                <label class="custom-control-label" for="customRadioInline1"><?php echo display('male') ?></label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline2" name="gender" value="2" class="custom-control-input">
                                <label class="custom-control-label" for="customRadioInline2"><?php echo display('female') ?></label>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <span id="verify_field"></span>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-kingfisher-daisy"><?php echo display('submit') ?></button>
                    </div>
                </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>