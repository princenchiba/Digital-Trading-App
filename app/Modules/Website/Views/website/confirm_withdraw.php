<div class="cryp_wrapper">
  <div class="container">
      <div class="row mt-4 mb-4">
          <?php 
            $data = json_decode($v->data);
          ?>
          <div class="col-lg-6 offset-lg-3 form-content">
              <div class="confirm-withdraw form-design">
                  <?php   $att = array('name'=>'verify','id'=>'confirm_withdraw'); echo form_open('#',$att); ?>
                  <dl class="row">
                    <dt class="col-6"><?php echo display('amount');?></dt>
                    <dd class="col-6"><?php echo esc($data->currency_symbol) .' '.esc($data->amount);?></dd>

                    <dt class="col-6"><?php echo display('payment_method');?></dt>
                    <dd class="col-6"><?php echo esc($data->method);?></dd>

                    <dt class="col-6"><?php echo display('fees');?></dt>
                    <dd class="col-6"><?php echo esc($data->fees_amount);?></dd>

                    <dt class="col-6"><?php echo display('enter_verify_code');?></dt>
                    <dd class="col-6"><input class="form-control" type="text" name="code" id="code"></dd>
                  </dl>
                      <div class="text-center">
                          <button type="button" onclick="withdraw('<?php echo $v->id;?>');" class="btn btn-kingfisher-daisy"><?php echo display('confirm') ?></button>
                          <a href="<?php echo base_url(); ?>" class="btn btn-danger"><?php echo display('cancel') ?></a>
                      </div>
                      <?php echo form_close();?>
              </div>
          </div>
      </div>
  </div>
</div>
