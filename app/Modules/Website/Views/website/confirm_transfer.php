<div class="cryp_wrapper">
  <div class="container">
      <div class="row mt-4 mb-4">
          <?php 
              $data = json_decode($v->data);
          ?>
          <div class="col-lg-6 offset-lg-3 form-content">
              <div class="confirm-transfer form-design">
                  <?php   $att = array('name'=>'verify', 'id'=>'transfer_confirm'); echo form_open('#',$att); ?>
                  <dl class="row">
                    <dt class="col-6"><?php echo display('receiver_name')?></dt>
                    <dd class="col-6"><?php echo esc($user->first_name).' '. esc($user->last_name);?></dd>

                    <dt class="col-6"><?php echo display('email');?></dt>
                    <dd class="col-6"><?php echo esc($user->email);?></dd>

                    <dt class="col-6"><?php echo display('user_id');?></dt>
                    <dd class="col-6"><?php echo esc($user->user_id);?></dd>

                    <dt class="col-6"><?php echo display('transfer_amount');?></dt>
                    <dd class="col-6"><?php echo esc($data->currency_symbol).' '.esc($data->amount);?></dd>

                    <dt class="col-6"><?php echo display('fees');?></dt>
                    <dd class="col-6"><?php echo esc($data->fees); ?></dd>

                    <dt class="col-6"><?php echo display('enter_verify_code');?></dt>
                    <dd class="col-6"><input class="form-control" type="text" name="code" id="code"></dd>
                  </dl>
                  <div class="text-center">
                      <button type="button" onclick="transfer('<?php echo $v->id;?>');" class="btn btn-kingfisher-daisy"><?php echo display('confirm') ?></button>
                      <button type="button" class="btn btn-danger"><?php echo display('cancle') ?></button>
                  </div>
                  <?php echo form_close();?>
              </div>    
          </div>
      </div>
  </div>
</div>

