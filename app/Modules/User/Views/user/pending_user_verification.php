<div class="card">
    <div class="card-body">
        <div class="row">
        	<div class="col-sm-7 col-md-7">
                <div class="card-header">
                    <div class="cart-title">
                        <h5>Upload Document For Profile Verification</h5>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 card-body">
                    <?php echo form_open_multipart("admin/user/pending-user-verification/$user->user_id") ?>
    				<?php echo form_hidden('user_id', $user->user_id) ?>
                	<div class="form-group row">
                        <label for="cid" class="col-sm-4 example-text-input font-weight-600">Verification Type</label>
                        <div class="col-sm-8">
                            <?php echo esc($user->verify_type) ?>
                        </div>
                    </div>
                	<div class="form-group row">
                        <label for="cid" class="col-sm-4 font-weight-600">Name</label>
                        <div class="col-sm-8">
                            <?php echo esc($user->first_name) ?></span>
                        </div>
                    </div>
                	<div class="form-group row">
                        <label for="cid" class="col-sm-4 font-weight-600">Surname</label>
                        <div class="col-sm-8">
                            <?php echo esc($user->last_name) ?></span>
                        </div>
                    </div>
                	<div class="form-group row">
                        <label for="cid" class="col-sm-4 font-weight-600">Gender</label>
                        <div class="col-sm-8">
                            <?php echo ($user->gender==1)?'Male':'Female' ?></span>
                        </div>
                    </div>
                	<div class="form-group row">
                        <label for="cid" class="col-sm-4 font-weight-600">NID</label>
                        <div class="col-sm-8">
                            <?php echo esc($user->id_number) ?>
                        </div>
                    </div>
                	<div class="form-group row">
                        <label for="cid" class="col-sm-4 font-weight-600">Doc I</label>
                        <div class="col-sm-8">
                        <?php if ($user->document1) { ?>
                            <img width="50" height="50" src="<?php echo base_url(esc($user->document1)); ?>" class="img-responsive"/>
                            <a href="<?php echo base_url($user->document1); ?>" class="btn btn-success" download="<?php echo $user->first_name."_".$user->user_id."_1"; ?>">Download File</a>
                        <?php } ?>
                        </div>
                    </div>
                	<div class="form-group row">
                        <label for="cid" class="col-sm-4 font-weight-600">Doc II</label>
                        <div class="col-sm-8">
                        <?php if ($user->document2) { ?>
                            <img width="50" height="50" src="<?php echo base_url(esc($user->document2)); ?>" class="img-responsive"/>
                            <a href="<?php echo base_url($user->document2); ?>" class="btn btn-success" download="<?php echo $user->first_name."_".$user->user_id."_2"; ?>">Download File</a>	
                        <?php } ?>
                        </div>
                    </div>
                	<div class="form-group row">
                        <label for="cid" class="col-sm-4 font-weight-600">Upload Document</label>
                        <div class="col-sm-8">
                            <?php 
                                $date = date_create($user->date);
                                echo date_format($date,"jS F Y");  
                            ?>
                        </div>
                    </div>
                	<div class="form-group row">
                        <label for="cid" class="col-sm-4 font-weight-600">Status</label>
                        <div class="col-sm-8">
                        	<h5>
                            <?php if ($user->verified == 0) { echo "Not Submited"; } ?>
                            <?php if ($user->verified == 1) { echo "Verified"; } ?>
                            <?php if ($user->verified == 2) { echo "Cancel"; } ?>
                            <?php if ($user->verified == 3) { echo "Processing"; } ?>
                            </h5>
                        </div>
                    </div>

                    <?php if ($user->verified==3) { ?>
					<div>
                        <button type="submit" name="cancel" class="btn btn-primary" ><?php echo display("cancel") ?></button>
                        <button type="submit" name="approve" class="btn btn-success">Approve</button>
                    </div>
                    <?php } ?>

                    <?php echo form_close() ?>
                </div>
            </div>
            <div class="col-sm-5 col-md-5">
                <div class="card-header">
                    <div class="cart-title">
                        <h5><?php echo display('user_info') ?></h5>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-2">
                    <div class="form-group row">
                        <label for="cid" class="col-sm-4 font-weight-600"><?php echo display('user_id') ?></label>
                        <div class="col-sm-8">
                            <?php echo esc($user->user_id) ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cid" class="col-sm-4 font-weight-600"><?php echo display('referral_id') ?></label>
                        <div class="col-sm-8">
                            <?php echo esc($user->referral_id) ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cid" class="col-sm-4 font-weight-600"><?php echo display('language') ?></label>
                        <div class="col-sm-8">
                            <?php echo esc($user->language) ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cid" class="col-sm-4 font-weight-600"><?php echo display('firstname') ?></label>
                        <div class="col-sm-8">
                            <?php echo esc($user->first_name) ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cid" class="col-sm-4 font-weight-600"><?php echo display('lastname') ?></label>
                        <div class="col-sm-8">
                            <?php echo esc($user->last_name) ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cid" class="col-sm-4 font-weight-600"><?php echo display('email') ?></label>
                        <div class="col-sm-8">
                            <?php echo esc($user->email) ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cid" class="col-sm-4 font-weight-600"><?php echo display('mobile') ?></label>
                        <div class="col-sm-8">
                            <?php echo esc($user->phone) ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cid" class="col-sm-4 font-weight-600"><?php echo display('registered_ip') ?></label>
                        <div class="col-sm-8">
                            <?php echo esc($user->ip) ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cid" class="col-sm-4 font-weight-600"><?php echo display('status') ?></label>
                        <div class="col-sm-8">
                            <?php echo ($user->status==1)?display('active'):display('inactive'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cid" class="col-sm-4 font-weight-600">Registered Date</label>
                        <div class="col-sm-8">
                            <?php 
                                $date = date_create($user->created);
                                echo date_format($date,"jS F Y");  
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>