<div class="cryp_wrapper">
    <div class="row form-content mt-4 mb-4">
        <div class="col-lg-12 form-design">
            <h3 class="user-login-title"><?php echo display('edit_profile') ?></h3>
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
            <?php echo form_open_multipart("edit-profile") ?>
            <?php echo form_hidden('user_id', esc($user->user_id)) ?>
            <div class="form-group">
                <label for="first_name"><?php echo display('firstname') ?> <span class="text-danger">*</span></label>
                <input name="first_name" class="form-control" type="text" placeholder="First Name" id="first_name"  value="<?php echo esc($user->first_name) ?>" required>
            </div>
            <div class="form-group">
                <label for="last_name"><?php echo display('lastname') ?> <span class="text-danger">*</span></label>
                <input name="last_name" class="form-control" type="text" placeholder="Last Name" id="last_name" value="<?php echo esc($user->last_name) ?>" required>
            </div>
            <div class="form-group">
                <label for="email"><?php echo display('email') ?> <span class="text-danger">*</span></label>
                <input name="email" class="form-control" type="email" placeholder="Email Address" id="email" value="<?php echo esc($user->email) ?>" required>
            </div> 
            <div class="form-group">
                <label for="phone"><?php echo display('phone') ?> <span class="text-danger">*</span></label>
                <input name="phone" class="form-control" type="text" placeholder="" id="phone" value="<?php echo esc($user->phone) ?>">
            </div> 
            <div class="form-group">
                <label for="password"><?php echo display('password') ?> <span class="text-danger">*</span></label>
                <input name="password" class="form-control" type="password" placeholder="Password" id="password">
            </div>
            <div class="form-group">
                <label for="bio"><?php echo display('about') ?></label>
                <textarea name="bio" placeholder="About" class="form-control" id="bio"><?php echo esc($user->bio) ?></textarea>
            </div>
            <div class="form-group row">
                <label for="preview" class="col-md-3"><?php echo display('preview') ?></label>
                <div class="col-md-9">
                    <img src="<?php echo base_url(!empty($user->image)?$user->image: "assets/images/icons/user.png") ?>" class="img-thumbnail" width="125" height="100">
                    <input type="hidden" name="old_image" value="<?php echo esc($user->image) ?>">
                </div> 
            </div> 
            <div class="form-group row">
                <label for="image" class="col-md-3"><?php echo display('image') ?></label>
                <div class="col-md-9">
                    <input type="file" name="image" id="image" aria-describedby="fileHelp">
                    <small id="fileHelp" class="text-muted"></small>
                    <span class="text-danger">80x80 px(jpg, jpeg, png, gif, ico)</span>
                </div>
            </div> 
            <div class="form-group">
                <button type="submit" class="btn btn-kingfisher-daisy"><?php echo display('save') ?></button>
                <a href="<?php echo base_url();?>" class="btn btn-danger"><?php echo display('cancel') ?></a>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>
  