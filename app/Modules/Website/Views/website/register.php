<div class="cryp_wrapper">
    <div class="form-content register">
        <div class="row">
            <div class="col-md-12">
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
            </div>
        </div>
        <h3 class="user-login-title form-title"><?php echo display('account_register') ?></h3>
        <div class="user-login form-design">
            <?php echo form_open('register','id="registerForm" name="registerForm" onsubmit="return validateForm()" '); ?>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="f_name"><?php echo display('name') ?> <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="f_name" name="rf_name" placeholder="Name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email"><?php echo display('email') ?> <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="email" name="remail" placeholder="example@mail.com" onkeydown="checkEmail()" >
                    </div>
                </div>
                <div class="form-row password_valid">
                    <div class="form-group col-md-6">
                        <label for="pass"><?php echo display('password') ?> <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="pass" name="rpass" placeholder="Password" onkeyup="strongPassword()" >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="r_pass"><?php echo display('confirm_password') ?> <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="r_pass" name="rr_pass" placeholder="Password" onkeyup="rePassword()" >
                    </div>
                    <div id="message">
                      <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                      <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                      <p id="special" class="invalid">A <b>special</b></p>
                      <p id="number" class="invalid">A <b>number</b></p>
                      <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                    </div>
            
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="accept_terms" name="raccept_terms" value="ptConfirm" >
                        <label class="custom-control-label" for="accept_terms"> <?php echo display('your_password_at_global_crypto_are_encrypted_and_secured'); ?></label>
                    </div>
                </div>                       
                <button type="submit" class="btn btn-block btn-kingfisher-daisy"><?php echo display('submit') ?></button>
            <?php echo form_close() ?>
        </div>
    </div>
</div>
