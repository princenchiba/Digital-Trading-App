<div class="row">
    <!-- alert message -->
    <?php if ($this->session->flashdata('message') != null) {  ?>
    <div class="alert alert-info alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php echo $this->session->flashdata('message'); ?>
    </div> 
    <?php } ?>
        
    <?php if ($this->session->flashdata('exception') != null) {  ?>
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php echo $this->session->flashdata('exception'); ?>
    </div>
    <?php } ?>
        
    <?php if (validation_errors()) {  ?>
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php echo validation_errors(); ?>
    </div>
    <?php } ?> 
</div>
<div class="form-body">
    <div class="form-content login">
        <h3 class="user-login-title"><?php echo display('auth_code'); ?></h3>
        <div class="user-login">
            <?php echo form_open('home/login_verify','id="loginverifyFrom" '); ?>
                <div class="form-group">
                    <label for="e_name"><i class="fas fa-barcode"></i><?php echo display('auth_code'); ?></label>
                    <input type="text" class="form-control" id="token" name="token" aria-describedby="token" placeholder="123 456" required>
                    <small id="e_nameHelp" class="form-text text-muted"><?php echo display('scan_this_barcode_using'); ?><a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2"><?php echo display('google_authentication'); ?></a></small>
                </div>
                <button type="submit" class="btn btn-kingfisher-daisy"><?php echo display('submit'); ?></button>
            <?php echo form_close();?>
        </div>
    </div>
</div>