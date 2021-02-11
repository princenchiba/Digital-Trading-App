<?php $request = \Config\Services::request(); ?>
<div class="col-lg-4 offset-lg-4 form-content mt-4 mb-4">
    <div class="mb-4 form-design">
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
        <h3 class="user-login-title mb-3"><?php echo display('transfer');?></h3>
        <?php echo form_open('transfer', array('name'=>'transfer_form', 'id'=>'transfer'));?>
        <div class="form-group">
           <label for="crypto_coin" class="col-form-label">Coin/Dollar</label>
           <select class="form-control basic-single" name="crypto_coin" id="crypto_coin" required>
              <option><?php echo display('select_option');?></option>
              <?php foreach ($coin_list as $key => $value) {  ?>
              <option value="<?php echo $value->symbol; ?>" <?php echo (esc($value->symbol) == $request->uri->setSilent()->getSegment(2))?'selected':'' ?> ><?php echo esc($value->full_name); ?></option>
              <?php } ?>
           </select>
        </div>
        <div class="form-group">
           <label for="receiver_id" class=""><?php echo display('reciver_account')?></label>
           <div class="input-group">
              <input class="form-control" onblur="ReciverChack(this.value)" name="receiver_id" type="text" id="receiver_id" placeholder="<?php echo display('user_id')?>" required>
              <div class="input-group-append">
                 <span class="input-group-text" id="receiver_alert"><i class="fas fa-check"></i></span>
              </div>
           </div>
        </div>
        <div class="form-group">
           <label for="amount" class=""><?php echo display('amount')?></label>
           <input class="form-control" name="amount" step="any" min="0" type="number" required id="amount">
        </div>
        <div class="form-group">
           <label for="comments" class=""><?php echo display('comment')?></label>
           <textarea class="form-control" name="comments" id="comments" rows="3"></textarea>
        </div>
        <div class="form-group row align-items-center">
           <label for="p_name" class="col-sm-4"><?php echo display('otp_send_to')?></label>
           <div class="col-sm-8">
              <div class="custom-control custom-radio custom-control-inline">
                 <input type="radio" id="inlineRadio1" value="1" name="varify_media" class="custom-control-input">
                 <label class="custom-control-label" for="inlineRadio1"><?php echo display('sms')?></label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                 <input type="radio" id="inlineRadio2" value="2" name="varify_media" class="custom-control-input">
                 <label class="custom-control-label" for="inlineRadio2"><?php echo display('email')?></label>
              </div>
           </div>
        </div>
        <button type="submit" class="btn btn-kingfisher-daisy"><?php echo display('transfer')?></button>
        <a href="<?php echo htmlspecialchars_decode(base_url());?>" class="btn btn-danger"><?php echo display('cancel')?></a>
        <?php echo form_close();?>
    </div>
</div>
     