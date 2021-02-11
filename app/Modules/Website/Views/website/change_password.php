<div class="cryp_wrapper">
    <div class="form-content mt-4 mb-4">
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
        <div class="user-login form-design">
        <h3 class="mb-3"><?php echo display('change_password');?></h3>
        <?php echo form_open("change-password") ?>
            <div class="form-group">
                <label><?php echo display("enter_old_password") ?> <span class="text-danger">*</span></label>
                <input type="password" class="form-control" value="<?php echo (isset($set_old->old_pass)?$set_old->old_pass:'');?>" name="old_pass" placeholder="<?php echo display("enter_old_password") ?>">
            </div>
            <div class="form-group">
                <label><?php echo display("enter_new_password") ?> <span class="text-danger">*</span></label>
                <input type="password"  class="form-control" value="<?php echo (isset($set_old->new_pass)?$set_old->new_pass:'');?>" name="new_pass" placeholder="<?php echo display("enter_new_password") ?>">
            </div>
            <div class="form-group">
                <label><?php echo display("enter_confirm_password") ?> <span class="text-danger">*</span></label>
                <input type="password"  class="form-control" name="confirm_pass" value="<?php echo (isset($set_old->confirm_pass)?$set_old->confirm_pass:'');?>" placeholder="<?php echo display("enter_confirm_password") ?>">
            </div>
            
            <div class=" m-b-15">
                <button type="submit" class="btn btn-kingfisher-daisy"><?php echo display("change") ?></button>
                <a href="<?php echo base_url('profile');?>" class="btn btn-danger"><?php echo display('cancel')?></a>
            </div>
        <?php echo form_close();?>
        </div>
    </div>
</div>