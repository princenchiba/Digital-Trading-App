<div class="cryp_wrapper">
    <div class="form-content login mt-4 mb-4">
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
        <div class="user-login form-design">
        <h3 class="user-login-title"><?php echo display('account_login') ?></h3>
            <?php echo form_open('login','id="loginForm" '); ?>                        
            <div class="form-group">
                <label for="e_name"><i class="fas fa-user"></i><?php echo display('email_address');?></label>
                <input type="text" class="form-control" id="e_name" name="luseremail" aria-describedby="e_nameHelp" placeholder="Email" required>
                <small id="e_nameHelp" class="form-text text-muted"><?php echo display('we_never_share_your_email_with_anyone_else') ?></small>
            </div>
            <div class="form-group">
                <label for="pass"><i class="fas fa-lock"></i> <?php echo display('password') ?></label>
                <input type="password" class="form-control" id="pass" name="lpassword" placeholder="Password" required>
            </div>
            <div class="d-flex justify-content-between mb-3">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="rememberMe">
                    <label class="custom-control-label" for="rememberMe"> <?php echo display('remember_me') ?></label>
                </div>
                <div class="foreget-password">
                    <a href="#" data-toggle="modal" data-target="#exampleModal" class="forgot"><?php echo display('forgot_password') ?>?</a>
                </div>
            </div>
            <?php if ($security) { ?>                        
                <div class="form-group">
                    <?php echo $widget;?>
                    <?php echo $script;?>
                </div>
            <?php } ?>
            <button type="submit" class="btn btn-kingfisher-daisy"><?php echo display('submit') ?></button>
            <?php echo form_close();?>
        </div>
    </div>
</div>
<!-- Modal -->
<div id="forgotModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="user-login-title"><?php echo display('account_login') ?></h3>
                    <div class="user-login">
                        <?php echo form_open('forgotPassword','id="forgotPassword" '); ?>
                            <div class="form-group">
                                <label for="e_name"><i class="fas fa-user"></i><?php echo display('email') ?></label>
                                <input type="text" class="form-control" id="e_name" name="luseremail" aria-describedby="e_nameHelp" placeholder="example@mail.com" required>
                                <small id="e_nameHelp" class="form-text text-muted"><?php echo display('we_never_share_your_email_with_anyone_else') ?></small>
                            </div>
                            <?php
                            if ($security) {
                                ?>
                                <div class="form-group">
                                    <?php echo $widget;?>
                                    <?php echo $script;?>
                                </div>
                            <?php } ?>
                            <button type="submit" class="btn btn-kingfisher-daisy"><?php echo display('submit') ?></button>
                        <?php echo form_close();?>
                    </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <?php echo form_open('forgotPassword','id="forgotPassword" '); ?>
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><?php echo display('forgot_password') ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
             <div class="form-group">
                <label for="e_name"><i class="far fa-envelope"></i> <?php echo display('email') ?></label>
                <input type="text" class="form-control" id="e_name" name="luseremail" aria-describedby="e_nameHelp" placeholder="example@mail.com" required>
                <small id="e_nameHelp" class="form-text text-muted"><?php echo display('we_never_share_your_email_with_anyone_else') ?></small>
            </div>
            <?php
            if ($security) {
                ?>
                <div class="form-group">
                    <?php echo $widget;?>
                    <?php echo $script;?>
                </div>
            <?php } ?>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-kingfisher-daisy"><?php echo display('submit') ?></button>
          </div>
        </div>
    <?php echo form_close();?>
  </div>
</div>