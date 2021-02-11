<div class="password_change-content">
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
    <h3 class="mb-3"><?php echo display('reset_your_password');?></h3>
    <?php echo form_open('resetPassword','id="resetPassword" novalidate'); ?>
        <div class="form-group">
            <input class="form-control" name="verificationcode" id="verificationcode" placeholder="Verification code" type="password" autocomplete="off">
        </div>
         <div class="form-group">
            <input class="form-control" name="newpassword" id="newpassword" placeholder="New Password" type="password" autocomplete="off">
            <div id="message">
                <p id="letter" class="invalid">A <b> lowercase</b> letter</p>
                <p id="capital" class="invalid">A <b> capital (uppercase)</b> letter</p>
                <p id="special" class="invalid">A <b> special</b></p>
                <p id="number" class="invalid">A <b> number</b></p>
                <p id="length" class="invalid">Minimum <b> 8 characters</b></p>
            </div>
        </div>
        <div class="form-group">
            <input class="form-control" name="r_pass" id="r_pass" placeholder="<?php echo display('conf_password'); ?>" type="password" onkeyup="rePassword()" >
        </div>
        <?php if($security) { ?>                        
        <div class="form-group" width="100%">
            <?php echo $widget; ?>
            <?php echo $script; ?>
        </div>
        <?php } ?>        
        <div class="m-b-15">
           <button type="submit" class="btn btn-success btn-block"><?php echo display('reset_your_password') ?></button>
        </div>
    <?php echo form_close();?>
</div>
