<div class="profile-header">
    <div id="author-header">
        <img src="<?php echo base_url("assets/website/img/author-header.jpg") ?>" alt="">
    </div>
    <div class="container text-center">
        <div class="author-avatar">
            <img src="<?php echo esc($user_info->image)==''?base_url("assets/website/img/img-user.png"):esc(base_url($user_info->image)) ?>" alt="<?php echo esc($user_info->first_name); ?>">
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3 form-design">
                <h3 class="author-name"><?php echo esc($user_info->first_name); ?> <?php echo esc($user_info->last_name); ?></h3>
                <p><?php echo esc($user_info->bio); ?></p>

                  <div class="form-group row">
                    <label for="inputPassword" class="col-sm-3 col-form-label"><?php echo display('affiliate_url');?></label>
                    <div class="col-sm-9">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="copyed" aria-label="Recipient's username" aria-describedby="button-addon2" value="<?php echo base_url()?>/register?ref=<?php echo $session->get('user_id')?>">
                            <div class="input-group-append">
                                <button class=" btn btn-kingfisher-daisy" type="button" onclick="copyFunction()"><?php echo display('copy');?></button>
                            </div>
                        </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>
</div>
<!-- /.End of profile header -->
<div class="profile-info">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-4">
                <div class="bio-info">
                    <dl class="dl-horizontal">
                        <!-- remove from here 2factor authentication -->
                        <dt><?php echo display('user_id') ?> :</dt>
                        <dd><?php echo esc($user_info->user_id); ?></dd>
                        <dt><?php echo display('firstname') ?> :</dt>
                        <dd><?php echo esc($user_info->first_name); ?></dd>
                        <dt><?php echo display('lastname') ?> :</dt>
                        <dd><?php echo esc($user_info->last_name); ?></dd>
                        <dt><?php echo display('email') ?> :</dt>
                        <dd><?php echo esc($user_info->email); ?></dd>
                        <dt><?php echo display('phone') ?> :</dt>
                        <dd><?php echo esc($user_info->phone); ?></dd>
                        <dt><?php echo display('referral_id') ?> :</dt>
                        <dd><?php echo esc($user_info->referral_id); ?></dd>
                        <dt><?php echo display('language') ?></dt>
                        <dd><?php echo esc($user_info->language); ?></dd>
                        <dt><?php echo display('address') ?> :</dt>
                        <dd><?php echo esc($user_info->address); ?></dd>
                        <dt><?php echo display('verify') ?></dt>
                        <dd><?php echo (esc($user_info->verified) == 0)?"<a href='".base_url('profile-verify')."'>Verify Account</a>":((esc($user_info->verified) == 1)?"<span class='verify-color'>Verified</span>":(($user_info->verified==2)?"<span class='verify-cancel'>Cancel</span>":"<span class='verify-processing'>Processing</span>")); ?></dd>
                        <dt><?php echo display('account_created') ?> :</dt>
                        <dd><?php $date=date_create($user_info->created); echo date_format($date,"jS F Y"); ?></dd>
                        <dt><?php echo display('registered_ip') ?> :</dt>
                        <dd><?php echo esc($user_info->ip); ?></dd>
                        <dt><a class="btn btn-kingfisher-daisy" href="<?php echo base_url("edit-profile") ?>" class="btn btn-kingfisher-daisy"><?php echo display('edit_profile') ?></a></dt>
                        <dd><a class="btn btn-kingfisher-daisy" href="<?php echo base_url("change-password") ?>" class="btn btn-kingfisher-daisy"><?php echo display('change_password') ?></a></dd>
                    </dl>
                </div>
            </div>
            <div class="col-md-6 col-lg-8">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr  class="table-bg">
                                <th scope="col"><?php echo display('access_time') ?></th>
                                <th scope="col"><?php echo display('log_type');?></th>
                                <th scope="col"><?php echo display('user_agent') ?></th>
                                <th scope="col"><?php echo display('user_id') ?></th>
                                <th scope="col"><?php echo display('ip') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($user_log as $key => $value) { ?>
                            <tr>
                                <th><?php $date=date_create($value->access_time); echo date_format($date,"jS F Y"); ?></th>
                                <td><?php echo esc($value->log_type); ?></td>
                                <td><?php $user_agent = json_decode($value->user_agent, true); echo " Browser: ".esc($user_agent['browser'])." <br>Platform: ".esc($user_agent['platform']) ?></td>
                                <td><?php echo esc($value->user_id); ?></td>
                                <td><?php echo esc($value->ip); ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>